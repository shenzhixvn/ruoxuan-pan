<template>
  <el-dialog
    v-model="visible"
    :title="`上传到「${dirName || '全部文件'}」`"
    width="620px"
    :close-on-click-modal="false"
    class="upload-dialog"
    @closed="resetAll"
  >
    <el-upload
      drag
      multiple
      :auto-upload="false"
      :show-file-list="false"
      :accept="ACCEPT"
      :on-change="handleChange"
      class="drop-zone"
    >
      <el-icon class="drop-icon"><UploadFilled /></el-icon>
      <div class="drop-text">把文件拖到这里，或<em>点击选择</em></div>
      <div class="drop-tip">支持 jpg/png/gif/mp4/mkv/doc(x)/xls(x)/ppt(x)/pdf/txt/js/json，单文件最大 1GB</div>
      <div class="drop-tip">大文件自动按 1MB 分片上传（服务端 upload_max_filesize=2M）</div>
    </el-upload>

    <div v-if="tasks.length" class="task-list">
      <div class="task-head">
        <span>共 {{ tasks.length }} 个文件</span>
        <el-button text size="small" :disabled="uploading" @click="tasks = []">清空列表</el-button>
      </div>

      <div v-for="task in tasks" :key="task.uid" class="task">
        <el-icon class="task-icon" :class="task.status"><component :is="statusIcon(task.status)" /></el-icon>
        <div class="task-body">
          <div class="task-line">
            <span class="task-name" :title="task.name">{{ task.name }}</span>
            <span class="task-size">{{ formatBytes(task.size) }}</span>
          </div>
          <el-progress
            :percentage="task.percent"
            :status="progressStatus(task.status)"
            :stroke-width="6"
            :show-text="false"
          />
          <div class="task-msg" :class="task.status">{{ task.message }}</div>
        </div>
      </div>
    </div>

    <template #footer>
      <el-button :disabled="uploading" @click="visible = false">关闭</el-button>
      <el-button type="primary" :loading="uploading" :disabled="!pendingCount" @click="startUpload">
        开始上传{{ pendingCount ? `（${pendingCount}）` : '' }}
      </el-button>
    </template>
  </el-dialog>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { ElMessage } from 'element-plus'
import { uploadFile } from '@/utils/uploader'
import { formatBytes } from '@/utils/format'
import { listFiles } from '@/api/disk'
import { useFileStore } from '@/stores/file'

const props = defineProps({
  modelValue: { type: Boolean, default: false },
  dirFileId: { type: [Number, String], default: 0 },
  dirName: { type: String, default: '全部文件' }
})

const emit = defineEmits(['update:modelValue', 'uploaded'])
const fileStore = useFileStore()

const visible = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

const tasks = ref([])
const uploading = ref(false)
// 后端允许的后缀（DiskFileUtil::allExtensions）
const ACCEPT = '.jpg,.jpeg,.png,.gif,.mp4,.mkv,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.pdf,.js,.txt,.json'
const pendingCount = computed(() => tasks.value.filter((task) => task.status === 'ready' || task.status === 'error').length)

function statusIcon(status) {
  if (status === 'done') return 'CircleCheck'
  if (status === 'error') return 'CircleClose'
  if (status === 'hashing' || status === 'uploading') return 'Loading'
  return 'Document'
}

function progressStatus(status) {
  if (status === 'done') return 'success'
  if (status === 'error') return 'exception'
  return undefined
}

function handleChange(uploadFileItem) {
  const file = uploadFileItem.raw
  if (!file) return
  if (tasks.value.some((task) => task.uid === uploadFileItem.uid)) return
  tasks.value.push({
    uid: uploadFileItem.uid,
    file,
    name: file.name,
    size: file.size,
    percent: 0,
    status: 'ready',
    message: '等待上传'
  })
}

async function startUpload() {
  if (uploading.value) return
  const queue = tasks.value.filter((task) => task.status === 'ready' || task.status === 'error')
  if (!queue.length) return

  uploading.value = true
  let success = 0
  // 后端 pan_member_file 有 (memberUserId,pid,fileName) 唯一索引：
  // 同名文件（尤其是同内容秒传）会直接 500，所以上传前先查当前目录并自动重命名
  const existingNames = await fetchExistingNames()

  for (const task of queue) {
    if (!task.file.size) {
      task.status = 'error'
      task.message = '空文件无法上传'
      continue
    }

    let uploadName = task.name
    let renamed = false
    if (existingNames.has(uploadName)) {
      uploadName = makeUniqueName(uploadName, existingNames)
      task.name = uploadName
      renamed = true
    }
    existingNames.add(uploadName)

    try {
      task.status = 'hashing'
      task.message = renamed ? `同名文件已存在，自动重命名为「${uploadName}」` : '正在计算文件指纹…'
      task.percent = 0

      const result = await uploadFile(task.file, {
        dirFileId: Number(props.dirFileId) || 0,
        fileName: uploadName,
        onHashProgress: (value) => {
          task.percent = Math.min(10, Math.round(value / 10))
        },
        onProgress: (value) => {
          task.status = 'uploading'
          task.message = '上传中…'
          task.percent = Math.max(10, value)
        }
      })

      task.status = 'done'
      task.percent = 100
      task.message = result.instant ? '秒传成功（云端已存在相同文件）' : '上传成功'
      if (renamed) task.message += `，已重命名为「${uploadName}」`
      success += 1
    } catch (error) {
      task.status = 'error'
      task.message = error?.message || '上传失败'
    }
  }

  uploading.value = false
  if (success > 0) {
    ElMessage.success(`成功上传 ${success} 个文件`)
    emit('uploaded')
    fileStore.fetchDiskInfo().catch(() => {})
  }
}

/** 当前目录已有文件名（最多取 200 条） */
async function fetchExistingNames() {
  const names = new Set()
  try {
    const data = await listFiles({ dirFileId: Number(props.dirFileId) || 0, page: 1, pageSize: 200 })
    ;(data?.records || []).forEach((item) => {
      const name = item.fileName || item.name
      if (name) names.add(name)
    })
  } catch (error) {
    // 查询失败不阻断上传
  }
  return names
}

/** a.txt -> a (1).txt */
function makeUniqueName(name, used) {
  const dot = name.lastIndexOf('.')
  const base = dot > 0 ? name.slice(0, dot) : name
  const ext = dot > 0 ? name.slice(dot) : ''
  let index = 1
  let candidate = `${base} (${index})${ext}`
  while (used.has(candidate)) {
    index += 1
    candidate = `${base} (${index})${ext}`
  }
  return candidate
}

function resetAll() {
  if (uploading.value) return
  tasks.value = []
}

watch(
  () => props.modelValue,
  (value) => {
    if (value) tasks.value = []
  }
)
</script>

<style scoped>
.drop-zone :deep(.el-upload-dragger) {
  border-radius: 12px;
  border: 1.5px dashed #c3cee8;
  background: linear-gradient(180deg, #fbfcff, #f4f7ff);
  padding: 22px 12px;
  transition: all 0.2s;
}

.drop-zone :deep(.el-upload-dragger:hover) {
  border-color: var(--pan-primary-light);
  background: #f2f6ff;
}

.drop-icon {
  font-size: 34px;
  color: var(--pan-primary-light);
}

.drop-text {
  font-size: 14px;
  color: #4d5876;
  margin-top: 6px;
}

.drop-text em {
  color: var(--pan-primary);
  font-style: normal;
}

.drop-tip {
  font-size: 12px;
  color: #9aa3ba;
  margin-top: 6px;
}

.task-list {
  margin-top: 16px;
  max-height: 260px;
  overflow-y: auto;
}

.task-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  color: var(--pan-text-weak);
  margin-bottom: 6px;
}

.task {
  display: flex;
  gap: 10px;
  padding: 10px 4px;
  border-bottom: 1px dashed #eef1f8;
}

.task:last-child {
  border-bottom: none;
}

.task-icon {
  font-size: 18px;
  margin-top: 2px;
  color: #8b95ad;
}

.task-icon.done {
  color: #38a169;
}

.task-icon.error {
  color: #e05252;
}

.task-icon.hashing,
.task-icon.uploading {
  color: var(--pan-primary-light);
  animation: spin 1.2s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.task-body {
  flex: 1;
  min-width: 0;
}

.task-line {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  font-size: 13px;
  margin-bottom: 6px;
}

.task-name {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.task-size {
  color: var(--pan-text-weak);
  flex-shrink: 0;
  font-size: 12px;
}

.task-msg {
  font-size: 12px;
  color: #9aa3ba;
  margin-top: 4px;
}

.task-msg.done {
  color: #38a169;
}

.task-msg.error {
  color: #e05252;
}
</style>
