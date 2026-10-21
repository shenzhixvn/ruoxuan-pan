<template>
  <div class="page">
    <h2 class="page-title">我的分享</h2>
    <p class="page-subtitle">管理已创建的分享链接，过期后自动失效</p>

    <div class="toolbar">
      <el-button :icon="Refresh" circle :loading="loading" @click="load" />
      <span class="text-weak total">共 {{ total }} 条分享</span>
    </div>

    <div class="pan-card card">
      <el-table v-loading="loading" :data="records" row-key="id" empty-text=" ">
        <template #empty>
          <el-empty description="还没有创建过分享" :image-size="92">
            <el-button type="primary" @click="router.push('/files')">去文件管理创建</el-button>
          </el-empty>
        </template>

        <el-table-column label="分享名称" min-width="180">
          <template #default="{ row }">
            <div class="share-name">
              <el-icon><Share /></el-icon>
              <span>{{ row.name || '未命名分享' }}</span>
            </div>
          </template>
        </el-table-column>

        <el-table-column label="提取码" width="110">
          <template #default="{ row }">
            <el-tag effect="plain" type="warning">{{ row.code || '无' }}</el-tag>
          </template>
        </el-table-column>

        <el-table-column label="状态" width="100">
          <template #default="{ row }">
            <el-tag :type="statusType(row)" effect="light" size="small">{{ statusText(row) }}</el-tag>
          </template>
        </el-table-column>

        <el-table-column label="创建时间" width="160">
          <template #default="{ row }">
            <span class="text-weak">{{ formatTime(row.shareTime || row.created_at) }}</span>
          </template>
        </el-table-column>

        <el-table-column label="有效期至" width="160">
          <template #default="{ row }">
            <span class="text-weak">{{ formatTime(row.expireTime) }}</span>
          </template>
        </el-table-column>

        <el-table-column label="操作" width="190" align="right">
          <template #default="{ row }">
            <el-button text size="small" @click="copyLink(row)">复制链接</el-button>
            <el-button text size="small" type="danger" @click="handleDelete(row)">取消分享</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessage, ElMessageBox } from 'element-plus'
import { Refresh, Share } from '@element-plus/icons-vue'
import { deleteShares, listShares } from '@/api/share'
import { formatTime } from '@/utils/format'

const router = useRouter()
const loading = ref(false)
const records = ref([])
const total = ref(0)

function isExpired(row) {
  if (!row.expireTime) return false
  return new Date(row.expireTime.replace(/-/g, '/')).getTime() < Date.now()
}

function statusText(row) {
  if (row.status === 0) return '已取消'
  return isExpired(row) ? '已过期' : '生效中'
}

function statusType(row) {
  if (row.status === 0) return 'info'
  return isExpired(row) ? 'warning' : 'success'
}

async function load() {
  loading.value = true
  try {
    const data = await listShares({ page: 1, pageSize: 100 })
    records.value = data?.records || []
    total.value = Number(data?.total || 0)
  } finally {
    loading.value = false
  }
}

async function copyLink(row) {
  const text = `${row.url}${row.code ? `（提取码：${row.code}）` : ''}`
  try {
    await navigator.clipboard.writeText(text)
    ElMessage.success('链接已复制')
  } catch (error) {
    ElMessage.warning('浏览器不允许自动复制，请手动复制')
  }
}

async function handleDelete(row) {
  try {
    await ElMessageBox.confirm(`确定取消分享「${row.name || '未命名分享'}」吗？`, '取消分享', {
      confirmButtonText: '取消分享',
      cancelButtonText: '再想想',
      type: 'warning'
    })
  } catch (error) {
    return
  }
  await deleteShares(row.id)
  ElMessage.success('已取消分享')
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

.share-name {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #3b4664;
}
</style>
