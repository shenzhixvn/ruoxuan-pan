<template>
  <div class="page">
    <h2 class="page-title">回收站</h2>
    <p class="page-subtitle">删除的文件会先进入回收站，还原后可继续使用</p>

    <div class="toolbar">
      <el-button :icon="Refresh" circle :loading="loading" @click="load" />
      <el-button v-if="selection.length" type="primary" plain @click="handleRestore(selection)">批量还原</el-button>
      <el-button v-if="selection.length" type="danger" plain @click="handleDelete(selection)">批量彻底删除</el-button>
      <span class="text-weak total">共 {{ total }} 项</span>
    </div>

    <div class="pan-card card">
      <el-table
        v-loading="loading"
        :data="records"
        row-key="id"
        empty-text=" "
        @selection-change="(rows) => (selection = rows)"
      >
        <el-table-column type="selection" width="46" />

        <template #empty>
          <el-empty description="回收站是空的" :image-size="92" />
        </template>

        <el-table-column label="名称" min-width="200">
          <template #default="{ row }">
            <div class="recycle-name">
              <el-icon :class="row._isDir ? 'is-dir' : 'is-file'">
                <Folder v-if="row._isDir" /><Document v-else />
              </el-icon>
              <span>{{ row._name || '未知' }}</span>
            </div>
          </template>
        </el-table-column>

        <el-table-column label="类型" width="110">
          <template #default="{ row }">
            <el-tag size="small" effect="plain" :type="row._isDir ? 'warning' : 'info'">
              {{ row._isDir ? '文件夹' : '文件' }}
            </el-tag>
          </template>
        </el-table-column>

        <el-table-column label="删除时间" width="170">
          <template #default="{ row }">
            <span class="text-weak">{{ formatTime(row.deleteTime) }}</span>
          </template>
        </el-table-column>

        <el-table-column label="操作" width="190" align="right">
          <template #default="{ row }">
            <el-button text size="small" type="primary" @click="handleRestore([row])">还原</el-button>
            <el-button text size="small" type="danger" @click="handleDelete([row])">彻底删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { ElMessage, ElMessageBox } from 'element-plus'
import { Refresh } from '@element-plus/icons-vue'
import { deleteRecycle, listRecycle, restoreRecycle } from '@/api/recycle'
import { formatTime } from '@/utils/format'

const loading = ref(false)
const records = ref([])
const total = ref(0)
const selection = ref([])

async function load() {
  loading.value = true
  try {
    const data = await listRecycle({ page: 1, pageSize: 100 })
    records.value = data?.records || []
    total.value = Number(data?.total || 0)
    selection.value = []
  } finally {
    loading.value = false
  }
}

async function handleRestore(rows) {
  if (!rows.length) return
  // 实测：restore/delete 的入参是回收站记录 id（不是 memberFileId）
  await restoreRecycle(rows.map((item) => item.id))
  ElMessage.success(`已还原 ${rows.length} 项`)
  load()
}

async function handleDelete(rows) {
  if (!rows.length) return
  try {
    await ElMessageBox.confirm(
      `彻底删除后不可恢复，确定删除这 ${rows.length} 项吗？`,
      '彻底删除',
      { confirmButtonText: '彻底删除', cancelButtonText: '取消', type: 'warning' }
    )
  } catch (error) {
    return
  }
  await deleteRecycle(rows.map((item) => item.id))
  ElMessage.success('已彻底删除')
  load()
}

onMounted(load)
</script>

<style scoped>
.total {
  font-size: 13px;
}

.card {
  padding: 8px;
}

.recycle-name {
  display: flex;
  align-items: center;
  gap: 8px;
}

.recycle-name .is-dir {
  color: #f0b13c;
}

.recycle-name .is-file {
  color: #6b83cf;
}
</style>
