import { defineStore } from 'pinia'
import { getDiskInfo, listFiles } from '@/api/disk'
import { percent } from '@/utils/format'

/**
 * 文件列表 / 容量 store
 */
export const useFileStore = defineStore('file', {
  state: () => ({
    diskInfo: { panSizeLimit: 0, panSizeUsed: 0 },
    dirFileId: 0, // 当前目录 id，0 = 根目录
    records: [], // 文件 + 文件夹
    dirs: [], // 祖先目录链（含当前目录），用于面包屑
    total: 0,
    page: 1,
    pageSize: 20,
    hasMore: false,
    keyword: '',
    loading: false
  }),
  getters: {
    // 后端 records 混合了文件与文件夹，这里按需拆分
    folders: (state) => state.records.filter((item) => item.isDir),
    files: (state) => state.records.filter((item) => !item.isDir),
    // 后端无 keywords 搜索能力，按文件名做前端本地过滤
    visibleRecords: (state) => {
      const key = state.keyword.trim().toLowerCase()
      if (!key) return state.records
      return state.records.filter((item) => (item.fileName || '').toLowerCase().includes(key))
    },
    // 面包屑：根目录 + 祖先链（后端 dirs 已包含当前目录）
    breadcrumbs: (state) => [
      { id: 0, name: '全部文件' },
      ...state.dirs.map((dir) => ({ id: dir.id, name: dir.fileName }))
    ],
    currentDirName: (state) => {
      if (!state.dirFileId) return '全部文件'
      const current = state.dirs.find((dir) => dir.id === state.dirFileId)
      return current ? current.fileName : '全部文件'
    },
    usedPercent: (state) => percent(state.diskInfo.panSizeUsed, state.diskInfo.panSizeLimit),
    freeSize: (state) => Math.max(0, (state.diskInfo.panSizeLimit || 0) - (state.diskInfo.panSizeUsed || 0))
  },
  actions: {
    async fetchDiskInfo() {
      const data = await getDiskInfo()
      this.diskInfo = {
        panSizeLimit: Number(data?.panSizeLimit || 0),
        panSizeUsed: Number(data?.panSizeUsed || 0)
      }
      return this.diskInfo
    },
    async fetchList({ dirFileId = this.dirFileId, page = this.page, pageSize = this.pageSize } = {}) {
      this.loading = true
      try {
        const data = await listFiles({ dirFileId, page, pageSize })
        this.dirFileId = Number(dirFileId)
        this.page = Number(page)
        this.pageSize = Number(pageSize)
        this.records = data?.records || []
        this.dirs = data?.dirs || []
        this.total = Number(data?.total || 0)
        this.hasMore = !!data?.hasMore
        return data
      } finally {
        this.loading = false
      }
    },
    enterDir(dirFileId) {
      this.keyword = ''
      return this.fetchList({ dirFileId, page: 1 })
    },
    reset() {
      this.dirFileId = 0
      this.records = []
      this.dirs = []
      this.total = 0
      this.page = 1
      this.keyword = ''
    }
  }
})
