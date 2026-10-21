import request, { toForm } from './request'

/**
 * 网盘相关接口（全部为实测后的真实契约，详见 README）
 */

/** 磁盘容量：data = { panSizeLimit, panSizeUsed } */
export function getDiskInfo() {
  return request.get('/pan/disk_info')
}

/**
 * 目录列表
 * data = { total, records: [...], dirs: [...], hasMore }
 * 注意：records 同时包含文件与文件夹（isDir 区分）；dirs 是「祖先目录链（含当前目录）」，用于面包屑
 * 后端不支持 keywords 搜索，搜索由前端本地过滤实现
 */
export function listFiles({ dirFileId = 0, page = 1, pageSize = 20, fileType = '', searchType = '' } = {}) {
  return request.get('/pan/disk_file/list', {
    params: {
      dirFileId,
      page,
      pageSize,
      ...(fileType ? { fileType } : {}),
      ...(searchType ? { 'search[type]': searchType } : {})
    }
  })
}

/** 新建文件夹：data = { dirFileId } */
export function createDir(dirFileId, fileName) {
  return request.post('/pan/disk_file/create_dir', toForm({ dirFileId, fileName }))
}

/**
 * 重命名：fileId, fileName
 * 实测：后端会自动补回原扩展名，因此文件请传「不含扩展名的基础名」
 */
export function renameFile(fileId, fileName) {
  return request.post('/pan/disk_file/rename', toForm({ fileId, fileName }))
}

/** 批量删除（进回收站）：fileIds 用英文逗号分隔 */
export function deleteFiles(fileIds) {
  const ids = Array.isArray(fileIds) ? fileIds.join(',') : String(fileIds)
  return request.post('/pan/disk_file/delete', toForm({ fileIds: ids }))
}

/** 批量移动：fileIds 逗号分隔 + toDirFileId */
export function moveFiles(fileIds, toDirFileId) {
  const ids = Array.isArray(fileIds) ? fileIds.join(',') : String(fileIds)
  return request.post('/pan/disk_file/move', toForm({ fileIds: ids, toDirFileId }))
}

/** 创建分享：data = { share: { url, code, expireTime } } */
export function shareFiles(fileIds, { name, expireDay = 7, type = 1 } = {}) {
  const ids = Array.isArray(fileIds) ? fileIds.join(',') : String(fileIds)
  return request.post('/pan/disk_file/share', toForm({ fileIds: ids, name, expireDay, type }))
}

/** 预览信息：data = { file: {...} } */
export function previewFile(id) {
  return request.post('/pan/disk_file/preview', toForm({ id }))
}

/** 下载地址（文件流，交给浏览器处理） */
export function downloadUrl(fileIds) {
  const ids = Array.isArray(fileIds) ? fileIds.join(',') : String(fileIds)
  return `/api/pan/disk_file/download?fileIds=${encodeURIComponent(ids)}`
}

/** 上传 init（multipart/form-data） */
export function uploadInit(formData, config = {}) {
  return request.post('/pan/disk_upload', formData, {
    timeout: 0,
    ...config
  })
}

/** 上传分片（multipart/form-data），支持 onUploadProgress */
export function uploadChunk(formData, onUploadProgress, config = {}) {
  return request.post('/pan/disk_upload', formData, {
    timeout: 0,
    onUploadProgress,
    ...config
  })
}
