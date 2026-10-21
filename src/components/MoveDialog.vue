<template>
  <el-dialog v-model="visible" title="移动到" width="480px" @open="loadRoot">
    <div class="tip">选择目标文件夹，{{ count }} 个条目将被移动</div>
    <div class="tree-wrap">
      <el-tree
        ref="treeRef"
        :props="treeProps"
        :load="loadNode"
        lazy
        node-key="id"
        highlight-current
        :expand-on-click-node="false"
        @node-click="handleSelect"
      >
        <template #default="{ data }">
          <span class="node">
            <el-icon><Folder /></el-icon>
            <span>{{ data.fileName }}</span>
          </span>
        </template>
      </el-tree>
    </div>
    <template #footer>
      <el-button @click="visible = false">取消</el-button>
      <el-button type="primary" :loading="loading" @click="handleConfirm">移动到此处</el-button>
    </template>
  </el-dialog>
</template>

<script setup>
import { computed, ref } from 'vue'
import { ElMessage } from 'element-plus'
import { listFiles, moveFiles } from '@/api/disk'

const props = defineProps({
  modelValue: { type: Boolean, default: false },
  fileIds: { type: Array, default: () => [] },
  count: { type: Number, default: 0 },
  excludeIds: { type: Array, default: () => [] } // 被移动的文件夹自身，禁止作为目标
})

const emit = defineEmits(['update:modelValue', 'moved'])

const visible = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

const treeRef = ref(null)
const loading = ref(false)
const target = ref(null)

const treeProps = {
  label: 'fileName',
  isLeaf: false
}

const rootNode = { id: 0, fileName: '全部文件' }

function loadRoot() {
  target.value = rootNode
  // 懒加载树在打开时重建，保证目录数据新鲜
  if (treeRef.value) treeRef.value.setCurrentKey(0)
}

async function loadNode(node, resolve) {
  if (node.level === 0) {
    resolve([{ ...rootNode }])
    return
  }
  try {
    const data = await listFiles({ dirFileId: node.data.id, page: 1, pageSize: 100, searchType: 'dir' })
    const children = (data?.records || [])
      .filter((item) => item.isDir && !props.excludeIds.includes(item.id))
      .map((item) => ({ id: item.id, fileName: item.fileName }))
    resolve(children)
  } catch (error) {
    resolve([])
  }
}

function handleSelect(data) {
  target.value = data
}

async function handleConfirm() {
  if (!target.value) {
    ElMessage.warning('请选择目标文件夹')
    return
  }
  if (props.excludeIds.includes(target.value.id)) {
    ElMessage.warning('不能移动到自身')
    return
  }
  loading.value = true
  try {
    await moveFiles(props.fileIds, target.value.id)
    ElMessage.success('移动成功')
    visible.value = false
    emit('moved')
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.tip {
  font-size: 13px;
  color: var(--pan-text-weak);
  margin-bottom: 10px;
}

.tree-wrap {
  height: 280px;
  overflow: auto;
  border: 1px solid #eef1f8;
  border-radius: 10px;
  padding: 8px;
}

.node {
  display: flex;
  align-items: center;
  gap: 6px;
}
</style>
