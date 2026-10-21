<template>
  <div class="page">
    <h2 class="page-title">用量中心</h2>
    <p class="page-subtitle">空间占用与文件构成一眼看清</p>

    <!-- 统计卡片 -->
    <div class="stat-grid">
      <div v-for="card in cards" :key="card.label" class="pan-card stat-card">
        <div class="stat-icon" :style="{ background: card.bg, color: card.color }">
          <el-icon :size="20"><component :is="card.icon" /></el-icon>
        </div>
        <div class="stat-body">
          <div class="stat-value">{{ card.value }}</div>
          <div class="stat-label">{{ card.label }}</div>
        </div>
      </div>
    </div>

    <div class="chart-grid">
      <div class="pan-card chart-card">
        <div class="chart-head">
          <span class="chart-title">存储用量</span>
          <el-tag size="small" effect="plain" :type="percentValue > 85 ? 'danger' : 'success'">
            已用 {{ percentValue }}%
          </el-tag>
        </div>
        <div ref="ringRef" v-loading="loading" class="chart chart-ring"></div>
        <div class="ring-legend">
          <div class="legend-item"><i class="dot used"></i>已用 {{ formatBytes(disk.panSizeUsed) }}</div>
          <div class="legend-item"><i class="dot free"></i>剩余 {{ formatBytes(freeSize) }}</div>
        </div>
      </div>

      <div class="pan-card chart-card">
        <div class="chart-head">
          <span class="chart-title">文件类型分布</span>
          <span class="text-weak chart-sub">共 {{ fileTotal }} 个文件</span>
        </div>
        <div ref="barRef" v-loading="loading" class="chart chart-bar"></div>
      </div>
    </div>

    <div class="pan-card hint-card">
      <el-icon><InfoFilled /></el-icon>
      <div>
        <div class="hint-title">统计说明</div>
        <div class="hint-text">
          容量数据来自 <span class="mono">GET /api/pan/disk_info</span>；文件类型分布由前端遍历各目录后聚合（后端未提供全局统计接口）。
          当前统计覆盖 {{ dirCount }} 个文件夹。
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, nextTick, onBeforeUnmount, onMounted, reactive, ref } from 'vue'
import * as echarts from 'echarts'
import { listFiles } from '@/api/disk'
import { useFileStore } from '@/stores/file'
import { TYPE_NAMES, formatBytes, percent } from '@/utils/format'

const fileStore = useFileStore()

const loading = ref(false)
const ringRef = ref(null)
const barRef = ref(null)
const dirCount = ref(0)
const fileTotal = ref(0)
const typeStats = ref([])

const disk = reactive({ panSizeUsed: 0, panSizeLimit: 0 })

let ringChart = null
let barChart = null

const percentValue = computed(() => percent(disk.panSizeUsed, disk.panSizeLimit))
const freeSize = computed(() => Math.max(0, disk.panSizeLimit - disk.panSizeUsed))

const cards = computed(() => [
  { label: '文件总数', value: fileTotal.value, icon: 'Document', bg: '#eef3ff', color: '#3550a3' },
  { label: '文件夹数', value: dirCount.value, icon: 'Folder', bg: '#fff6e6', color: '#c98a16' },
  { label: '已用空间', value: formatBytes(disk.panSizeUsed), icon: 'PieChart', bg: '#eafaf1', color: '#2f9e64' },
  { label: '剩余空间', value: formatBytes(freeSize.value), icon: 'Odometer', bg: '#f3eefe', color: '#7b57c9' }
])

const PALETTE = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#9a60b4']

function renderRing() {
  if (!ringRef.value) return
  if (!ringChart) ringChart = echarts.init(ringRef.value)
  ringChart.setOption({
    tooltip: {
      trigger: 'item',
      formatter: (params) => `${params.name}<br/>${formatBytes(params.value)}（${params.percent}%）`
    },
    series: [
      {
        name: '存储用量',
        type: 'pie',
        radius: ['60%', '80%'],
        avoidLabelOverlap: false,
        itemStyle: { borderRadius: 8, borderColor: '#fff', borderWidth: 3 },
        label: {
          show: true,
          position: 'center',
          formatter: () => `${percentValue.value}%\n已用`,
          fontSize: 16,
          lineHeight: 24,
          color: '#3b4664',
          fontWeight: 600
        },
        emphasis: { label: { show: true, fontSize: 18 } },
        labelLine: { show: false },
        data: [
          { value: disk.panSizeUsed, name: '已用', itemStyle: { color: '#5470c6' } },
          { value: freeSize.value, name: '剩余', itemStyle: { color: '#e8eefc' } }
        ]
      }
    ]
  })
}

function renderBar() {
  if (!barRef.value) return
  if (!barChart) barChart = echarts.init(barRef.value)
  const names = typeStats.value.map((item) => item.name)
  const values = typeStats.value.map((item) => item.count)
  barChart.setOption({
    tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
    grid: { left: 12, right: 24, top: 24, bottom: 12, containLabel: true },
    xAxis: {
      type: 'value',
      minInterval: 1,
      axisLine: { show: false },
      axisTick: { show: false },
      splitLine: { lineStyle: { color: '#eef1f8' } }
    },
    yAxis: {
      type: 'category',
      data: names,
      axisLine: { show: false },
      axisTick: { show: false },
      axisLabel: { color: '#5c6784' }
    },
    series: [
      {
        type: 'bar',
        data: values,
        barWidth: 16,
        itemStyle: {
          borderRadius: [0, 8, 8, 0],
          color: new echarts.graphic.LinearGradient(0, 0, 1, 0, [
            { offset: 0, color: '#7d95e0' },
            { offset: 1, color: '#4a66c0' }
          ])
        },
        label: { show: true, position: 'right', color: '#5c6784', fontSize: 12 }
      }
    ]
  })
}

/** 遍历所有目录聚合文件数据（后端无全局统计接口） */
async function loadStats() {
  loading.value = true
  try {
    await fileStore.fetchDiskInfo()
    disk.panSizeUsed = fileStore.diskInfo.panSizeUsed
    disk.panSizeLimit = fileStore.diskInfo.panSizeLimit

    const queue = [0]
    const counters = {}
    let files = 0
    let dirs = 0
    let guard = 0

    while (queue.length && guard < 60) {
      const dirFileId = queue.shift()
      guard += 1
      let page = 1
      for (;;) {
        const data = await listFiles({ dirFileId, page, pageSize: 100 })
        const records = data?.records || []
        records.forEach((item) => {
          if (item.isDir) {
            dirs += 1
            queue.push(item.id)
          } else {
            files += 1
            const key = item.type || 'other'
            counters[key] = (counters[key] || 0) + 1
          }
        })
        if (!data?.hasMore || page >= 20 || records.length === 0) break
        page += 1
      }
    }

    dirCount.value = dirs
    fileTotal.value = files
    typeStats.value = Object.entries(counters)
      .map(([key, count]) => ({ key, name: TYPE_NAMES[key] || key, count }))
      .sort((a, b) => b.count - a.count)

    if (!typeStats.value.length) {
      typeStats.value = [{ key: 'empty', name: '暂无文件', count: 0 }]
    }

    await nextTick()
    renderRing()
    renderBar()
  } finally {
    loading.value = false
  }
}

function handleResize() {
  ringChart && ringChart.resize()
  barChart && barChart.resize()
}

onMounted(() => {
  loadStats().catch(() => {})
  window.addEventListener('resize', handleResize)
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', handleResize)
  ringChart && ringChart.dispose()
  barChart && barChart.dispose()
  ringChart = null
  barChart = null
})
</script>

<style scoped>
.stat-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 16px;
  margin-bottom: 16px;
}

.stat-card {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 18px;
}

.stat-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.stat-value {
  font-size: 20px;
  font-weight: 600;
  line-height: 1.3;
}

.stat-label {
  font-size: 12px;
  color: var(--pan-text-weak);
}

.chart-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1.35fr);
  gap: 16px;
}

.chart-card {
  padding: 16px 18px 12px;
}

.chart-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 6px;
}

.chart-title {
  font-size: 15px;
  font-weight: 600;
}

.chart-sub {
  font-size: 12px;
}

.chart {
  width: 100%;
  height: 280px;
}

.ring-legend {
  display: flex;
  justify-content: center;
  gap: 20px;
  padding-bottom: 8px;
  font-size: 12px;
  color: var(--pan-text-weak);
}

.legend-item {
  display: flex;
  align-items: center;
  gap: 6px;
}

.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.dot.used {
  background: #5470c6;
}

.dot.free {
  background: #e8eefc;
}

.hint-card {
  display: flex;
  gap: 12px;
  margin-top: 16px;
  padding: 16px 18px;
  color: #5c6784;
  align-items: flex-start;
}

.hint-title {
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 4px;
}

.hint-text {
  font-size: 12px;
  line-height: 1.8;
  color: var(--pan-text-weak);
}

@media (max-width: 1100px) {
  .stat-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .chart-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 560px) {
  .stat-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  .chart {
    height: 240px;
  }
}
</style>
