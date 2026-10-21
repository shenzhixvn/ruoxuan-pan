/** 字节格式化 */
export function formatBytes(bytes, digits = 2) {
  const size = Number(bytes)
  if (!size || size <= 0) return '0 B'
  const units = ['B', 'KB', 'MB', 'GB', 'TB']
  const index = Math.min(Math.floor(Math.log(size) / Math.log(1024)), units.length - 1)
  const value = size / Math.pow(1024, index)
  return `${index === 0 ? value : Number(value.toFixed(digits))} ${units[index]}`
}

/** 百分比（保留一位小数，0 也安全） */
export function percent(used, total) {
  if (!total || total <= 0) return 0
  return Math.min(100, Number(((used / total) * 100).toFixed(1)))
}

/** 从文件名中去掉扩展名（后端 rename 会自动补回扩展名） */
export function baseName(fileName = '') {
  const index = fileName.lastIndexOf('.')
  if (index <= 0) return fileName
  return fileName.slice(0, index)
}

/** 文件类型 -> 中文名 */
export const TYPE_NAMES = {
  image: '图片',
  video: '视频',
  audio: '音频',
  doc: '文档',
  other: '其它',
  dir: '文件夹'
}

export function typeName(record) {
  if (!record) return '-'
  if (record.isDir) return '文件夹'
  return record._typeName || TYPE_NAMES[record.type] || record.ext || '其它'
}

/** 根据后缀挑一个 Element Plus 图标名，便于表格里区分展示 */
export function fileIcon(record) {
  if (record.isDir) return 'Folder'
  const type = record.type
  if (type === 'image') return 'Picture'
  if (type === 'video') return 'VideoCamera'
  if (type === 'audio') return 'Headset'
  if (type === 'doc') return 'Document'
  const ext = (record.ext || '').toLowerCase()
  if (['zip', 'rar', '7z', 'gz', 'tar'].includes(ext)) return 'Files'
  return 'Document'
}

/** 时间展示，去掉秒 */
export function formatTime(value) {
  if (!value) return '-'
  return String(value).slice(0, 16)
}
