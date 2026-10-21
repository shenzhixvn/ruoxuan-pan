<template>
  <div class="file-table">
    <el-table
      ref="tableRef"
      v-loading="loading"
      :data="records"
      row-key="id"
      height="100%"
      :row-class-name="rowClass"
      @selection-change="handleSelectionChange"
      @row-dblclick="handleRowDblclick"
    >
      <el-table-column type="selection" width="46" :selectable="() => true" />

      <el-table-column label="名称" min-width="240">
        <template #default="{ row }">
          <div class="file-name" @click="handleOpen(row)">
            <el-icon :size="18" :class="['icon', row.isDir ? 'is-dir' : 'is-file']">
              <component :is="fileIcon(row)" />
            </el-icon>
            <span class="name-text" :title="row.fileName">{{ row.fileName }}</span>
          </div>
        </template>
      </el-table-column>

      <el-table-column label="大小" width="110" align="right">
        <template #default="{ row }">
          <span class="text-weak">{{ row.isDir ? '—' : row._sizeFormat || formatBytes(row.size) }}</span>
        </template>
      </el-table-column>

      <el-table-column label="类型" width="110">
        <template #default="{ row }">
          <el-tag size="small" effect="plain" :type="row.isDir ? 'warning' : 'info'">
            {{ typeName(row) }}
          </el-tag>
        </template>
      </el-table-column>

      <el-table-column label="修改时间" width="160">
        <template #default="{ row }">
          <span class="text-weak">{{ formatTime(row.uploadTime || row.updated_at) }}</span>
        </template>
      </el-table-column>

      <el-table-column label="操作" width="170" fixed="right" align="right">
        <template #default="{ row }">
          <el-button v-if="!row.isDir" text size="small" @click.stop="emit('download', row)">下载</el-button>
          <el-button v-if="!row.isDir" text size="small" @click.stop="emit('share', row)">分享</el-button>
          <el-dropdown trigger="click" @command="(cmd) => handleCommand(cmd, row)">
            <el-button text size="small" @click.stop>更多<el-icon class="el-icon--right"><ArrowDown /></el-icon></el-button>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item command="rename">
                  <el-icon><EditPen /></el-icon>重命名
                </el-dropdown-item>
                <el-dropdown-item command="move">
                  <el-icon><Rank /></el-icon>移动到
                </el-dropdown-item>
                <el-dropdown-item command="delete" divided>
                  <el-icon><Delete /></el-icon>删除
                </el-dropdown-item>
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </template>
      </el-table-column>

      <template #empty>
        <el-empty :description="emptyText" :image-size="92">
          <slot name="empty-extra" />
        </el-empty>
      </template>
    </el-table>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { fileIcon, formatBytes, formatTime, typeName } from '@/utils/format'

const props = defineProps({
  records: { type: Array, default: () => [] },
  loading: { type: Boolean, default: false },
  emptyText: { type: String, default: '这里还没有文件，先上传一个吧' }
})

const emit = defineEmits(['open', 'selection-change', 'rename', 'move', 'delete', 'share', 'download'])

function rowClass({ row }) {
  return row.isDir ? 'is-dir-row' : ''
}

function handleSelectionChange(rows) {
  emit('selection-change', rows)
}

function handleOpen(row) {
  emit('open', row)
}

// 双击：文件夹进入，文件预览
function handleRowDblclick(row) {
  emit('open', row)
}

function handleCommand(command, row) {
  emit(command, row)
}

const tableRef = ref(null)

// 供父组件清空选中（批量操作后调用）
function clearSelection() {
  tableRef.value && tableRef.value.clearSelection()
}

defineExpose({ clearSelection })
</script>

<style scoped>
.file-table {
  height: 100%;
  min-height: 320px;
}

.file-table :deep(.el-table) {
  --el-table-border-color: #eef1f8;
  --el-table-header-bg-color: #fafbff;
  --el-table-row-hover-bg-color: #f5f8ff;
  border-radius: 10px;
}

.file-table :deep(.el-table__row.is-dir-row) {
  cursor: pointer;
}

.file-table :deep(.el-table th.el-table__cell) {
  font-weight: 600;
  color: #6a748f;
  font-size: 13px;
}

.icon.is-dir {
  color: #f0b13c;
}

.icon.is-file {
  color: #6b83cf;
}
</style>
