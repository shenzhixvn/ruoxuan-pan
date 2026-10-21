<template>
  <div class="page files-page">
    <!-- 工具条 -->
    <div class="toolbar">
      <el-button type="primary" :icon="FolderAdd" @click="openCreateDir">新建文件夹</el-button>
      <el-button :icon="Upload" @click="uploadVisible = true">上传文件</el-button>
      <el-button :icon="Refresh" circle :loading="fileStore.loading" @click="refresh" />

      <div class="spacer"></div>

      <el-input
        v-model="keyword"
        class="search"
        placeholder="搜索当前目录文件名"
        clearable
        :prefix-icon="Search"
      />
    </div>

    <!-- 批量操作栏 -->
    <div v-if="selection.length" class="batch-bar">
      <span class="count">已选 {{ selection.length }} 项</span>
      <el-button text type="primary" @click="handleBatchDownload">下载</el-button>
      <el-button text type="primary" @click="handleBatchShare">分享</el-button>
      <el-button text type="primary" @click="openMove(selection)">移动</el-button>
      <el-button text type="danger" @click="handleBatchDelete">删除</el-button>
      <el-button text @click="clearSelection">取消选择</el-button>
    </div>

    <!-- 面包屑 -->
    <div class="crumb-bar">
      <el-button v-if="fileStore.dirFileId" text :icon="Back" size="small" @click="goParent">上一级</el-button>
      <Breadcrumb :items="fileStore.breadcrumbs" @navigate="handleNavigate" />
      <span class="crumb-tip">{{ totalText }}</span>
    </div>

    <!-- 文件表格 -->
    <div class="pan-card table-card">
      <FileTable
        ref="tableRef"
        :records="displayRecords"
        :loading="fileStore.loading || searching"
        :empty-text="emptyText"
        @open="handleOpen"
        @selection-change="(rows) => (selection = rows)"
        @rename="openRename"
        @move="(row) => openMove([row])"
        @delete="handleDelete"
        @share="(row) => openShare([row])"
        @download="handleDownload"
      >
        <template #empty-extra>
          <div v-if="keyword" class="empty-actions">
            <el-button @click="keyword = ''">清空搜索</el-button>
          </div>
          <div v-else class="empty-actions">
            <el-button type="primary" :icon="Upload" @click="uploadVisible = true">上传文件</el-button>
            <el-button :icon="FolderAdd" @click="openCreateDir">新建文件夹</el-button>
          </div>
        </template>
      </FileTable>
    </div>

    <!-- 分页 -->
    <div v-if="!keyword && fileStore.total > fileStore.pageSize" class="pager">
      <el-pagination
        v-model:current-page="page"
        :page-size="fileStore.pageSize"
        :total="fileStore.total"
        :page-sizes="[20, 50, 100]"
        layout="total, sizes, prev, pager, next"
        background
        @current-change="handlePageChange"
        @size-change="handleSizeChange"
      />
    </div>

    <!-- 新建文件夹 -->
    <el-dialog v-model="createVisible" title="新建文件夹" width="400px">
      <el-input v-model="newDirName" maxlength="50" show-word-limit placeholder="请输入文件夹名称" @keyup.enter="handleCreateDir" />
      <template #footer>
        <el-button @click="createVisible = false">取消</el-button>
        <el-button type="primary" :loading="submitting" @click="handleCreateDir">创建</el-button>
      </template>
    </el-dialog>

    <!-- 重命名 -->
    <el-dialog v-model="renameVisible" title="重命名" width="400px">
      <el-input v-model="renameValue" maxlength="80" show-word-limit @keyup.enter="handleRename" />
      <div class="dialog-tip">文件扩展名由服务端自动保留（.<span class="mono">{{ renameExt || '无' }}</span>）</div>
      <template #footer>
        <el-button @click="renameVisible = false">取消</el-button>
        <el-button type="primary" :loading="submitting" @click="handleRename">确定</el-button>
      </template>
    </el-dialog>

    <!-- 上传 / 移动 / 分享 -->
    <UploadDialog
      v-model="uploadVisible"
      :dir-file-id="fileStore.dirFileId"
      :dir-name="fileStore.currentDirName"
      @uploaded="refresh"
    />
    <MoveDialog
      v-model="moveVisible"
      :file-ids="moveTargets.map((item) => item.id)"
      :count="moveTargets.length"
      :exclude-ids="moveTargets.filter((item) => item.isDir).map((item) => item.id)"
      @moved="refresh"
    />
    <ShareDialog v-model="shareVisible" :records="shareTargets" @created="refresh" />
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessage, ElMessageBox } from 'element-plus'
import { Back, FolderAdd, Refresh, Search, Upload } from '@element-plus/icons-vue'
import Breadcrumb from '@/components/Breadcrumb.vue'
import FileTable from '@/components/FileTable.vue'
import UploadDialog from '@/components/UploadDialog.vue'
import MoveDialog from '@/components/MoveDialog.vue'
import ShareDialog from '@/components/ShareDialog.vue'
import { createDir, deleteFiles, downloadUrl, listFiles, previewFile, renameFile } from '@/api/disk'
import { useFileStore } from '@/stores/file'
import { baseName } from '@/utils/format'

const router = useRouter()
const fileStore = useFileStore()

const tableRef = ref(null)
const selection = ref([])
const page = ref(1)
const keyword = ref('')
const searchRecords = ref(null)
const searching = ref(false)

const uploadVisible = ref(false)
const moveVisible = ref(false)
const shareVisible = ref(false)
const createVisible = ref(false)
const renameVisible = ref(false)
const submitting = ref(false)

const newDirName = ref('')
const renameValue = ref('')
const renameExt = ref('')
const renameTarget = ref(null)
const moveTargets = ref([])
const shareTargets = ref([])

const displayRecords = computed(() => {
  if (keyword.value.trim()) return searchRecords.value || []
  return fileStore.visibleRecords
})

const emptyText = computed(() => {
  if (keyword.value.trim()) return `没有找到包含「${keyword.value}」的文件`
  if (fileStore.dirFileId) return '这个文件夹是空的'
  return '网盘还是空的，先上传一个文件吧'
})

const totalText = computed(() => {
  if (keyword.value.trim()) return `搜索结果 ${displayRecords.value.length} 项`
  return `共 ${fileStore.total} 项（${fileStore.folders.length} 个文件夹 / ${fileStore.files.length} 个文件）`
})

function clearSelection() {
  selection.value = []
  tableRef.value?.clearSelection?.()
}

async function refresh() {
  await fileStore.fetchList({ dirFileId: fileStore.dirFileId, page: page.value, pageSize: fileStore.pageSize })
  fileStore.fetchDiskInfo().catch(() => {})
  if (keyword.value.trim()) fetchAllForSearch()
  clearSelection()
}

function handlePageChange(value) {
  page.value = value
  fileStore.fetchList({ dirFileId: fileStore.dirFileId, page: value, pageSize: fileStore.pageSize })
}

function handleSizeChange(size) {
  page.value = 1
  fileStore.fetchList({ dirFileId: fileStore.dirFileId, page: 1, pageSize: size })
}

function handleNavigate(dirFileId) {
  page.value = 1
  keyword.value = ''
  searchRecords.value = null
  fileStore.enterDir(dirFileId)
  clearSelection()
}

function goParent() {
  const crumbs = fileStore.breadcrumbs
  const parent = crumbs.length >= 2 ? crumbs[crumbs.length - 2] : { id: 0 }
  handleNavigate(parent.id)
}

async function handleOpen(row) {
  if (row.isDir) {
    handleNavigate(row.id)
    return
  }
  try {
    const data = await previewFile(row.id)
    const file = data?.file || row
    ElMessageBox.alert(
      `<div style="line-height:2;font-size:13px">
        <div><b>文件名：</b>${escapeHtml(file.fileName)}</div>
        <div><b>类型：</b>${escapeHtml(file.ext || '未知')}</div>
        <div><b>大小：</b>${escapeHtml(row._sizeFormat || '')}</div>
        <div><b>上传时间：</b>${escapeHtml(file.uploadTime || '-')}</div>
      </div>`,
      '文件信息',
      { dangerouslyUseHTMLString: true, confirmButtonText: '下载', cancelButtonText: '关闭' }
    )
      .then(() => handleDownload(row))
      .catch(() => {})
  } catch (error) {
    // 错误已由拦截器提示
  }
}

function escapeHtml(text) {
  return String(text ?? '').replace(/[&<>"']/g, (char) => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;'
  })[char])
}

function handleDownload(row) {
  const link = document.createElement('a')
  link.href = downloadUrl(row.id)
  link.target = '_blank'
  link.rel = 'noopener'
  document.body.appendChild(link)
  link.click()
  document.body.removeChild(link)
}

function handleBatchDownload() {
  if (!selection.value.length) return
  const fileIds = selection.value.filter((item) => !item.isDir).map((item) => item.id)
  if (!fileIds.length) {
    ElMessage.warning('只能下载文件，不能下载文件夹')
    return
  }
  handleDownload({ id: fileIds.join(',') })
}

function openCreateDir() {
  newDirName.value = ''
  createVisible.value = true
}

async function handleCreateDir() {
  const name = newDirName.value.trim()
  if (!name) {
    ElMessage.warning('请输入文件夹名称')
    return
  }
  submitting.value = true
  try {
    await createDir(fileStore.dirFileId, name)
    ElMessage.success('文件夹已创建')
    createVisible.value = false
    refresh()
  } finally {
    submitting.value = false
  }
}

function openRename(row) {
  renameTarget.value = row
  renameExt.value = row.isDir ? '' : row.ext || ''
  renameValue.value = row.isDir ? row.fileName : baseName(row.fileName)
  renameVisible.value = true
}

async function handleRename() {
  const value = renameValue.value.trim()
  if (!value) {
    ElMessage.warning('名称不能为空')
    return
  }
  submitting.value = true
  try {
    await renameFile(renameTarget.value.id, value)
    ElMessage.success('重命名成功')
    renameVisible.value = false
    refresh()
  } finally {
    submitting.value = false
  }
}

function openMove(rows) {
  if (!rows.length) return
  moveTargets.value = rows
  moveVisible.value = true
}

function openShare(rows) {
  const files = rows.filter((item) => !item.isDir)
  if (!files.length) {
    ElMessage.warning('文件夹暂不支持分享')
    return
  }
  shareTargets.value = files
  shareVisible.value = true
}

function handleBatchShare() {
  openShare(selection.value)
}

async function handleDelete(row) {
  await confirmDelete([row])
}

async function handleBatchDelete() {
  await confirmDelete(selection.value)
}

async function confirmDelete(rows) {
  if (!rows.length) return
  const names = rows.slice(0, 3).map((item) => item.fileName).join('、')
  const suffix = rows.length > 3 ? ` 等 ${rows.length} 项` : ''
  try {
    await ElMessageBox.confirm(`确定删除「${names}」${suffix}吗？删除后可在回收站找回。`, '删除确认', {
      confirmButtonText: '删除',
      cancelButtonText: '取消',
      type: 'warning'
    })
  } catch (error) {
    return
  }
  await deleteFiles(rows.map((item) => item.id))
  ElMessage.success('已移入回收站')
  if (rows.length === fileStore.records.length && page.value > 1) page.value -= 1
  refresh()
}

/** 后端无关键词搜索能力：进入搜索时把所有分页数据拉全，在前端过滤 */
async function fetchAllForSearch() {
  if (searching.value || !keyword.value.trim()) return
  searching.value = true
  try {
    const all = []
    let currentPage = 1
    for (;;) {
      const data = await listFiles({ dirFileId: fileStore.dirFileId, page: currentPage, pageSize: 100 })
      const records = data?.records || []
      all.push(...records)
      if (!data?.hasMore || currentPage >= 20 || records.length === 0) break
      currentPage += 1
    }
    const key = keyword.value.trim().toLowerCase()
    searchRecords.value = all.filter((item) => (item.fileName || '').toLowerCase().includes(key))
  } catch (error) {
    searchRecords.value = []
  } finally {
    searching.value = false
  }
}

watch(keyword, (value) => {
  if (!value.trim()) {
    searchRecords.value = null
    return
  }
  searchRecords.value = null
  fetchAllForSearch()
})

onMounted(() => {
  page.value = 1
  fileStore.fetchList({ dirFileId: 0, page: 1, pageSize: fileStore.pageSize })
  fileStore.fetchDiskInfo().catch(() => {})
})
</script>

<style scoped>
.files-page {
  display: flex;
  flex-direction: column;
  min-height: calc(100vh - 64px);
}

.search {
  width: 240px;
}

.batch-bar {
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 6px 12px;
  margin-bottom: 10px;
  border-radius: 10px;
  background: #eef3ff;
  border: 1px solid #dfe7fb;
  font-size: 13px;
}

.batch-bar .count {
  color: var(--pan-primary);
  font-weight: 600;
  margin-right: 8px;
}

.crumb-bar {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
  flex-wrap: wrap;
}

.crumb-tip {
  margin-left: auto;
  font-size: 12px;
  color: var(--pan-text-weak);
}

.table-card {
  padding: 8px;
  flex: 1;
  min-height: 420px;
}

.pager {
  display: flex;
  justify-content: flex-end;
  margin-top: 16px;
}

.empty-actions {
  display: flex;
  gap: 10px;
}

.dialog-tip {
  margin-top: 8px;
  font-size: 12px;
  color: var(--pan-text-weak);
}

@media (max-width: 768px) {
  .search {
    width: 100%;
  }

  .toolbar {
    gap: 8px;
  }

  .crumb-tip {
    display: none;
  }

  .table-card {
    min-height: 380px;
  }
}
</style>
