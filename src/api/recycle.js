import request, { toForm } from './request'

/** 回收站列表：data = { total, records } */
export function listRecycle({ page = 1, pageSize = 50 } = {}) {
  return request.get('/pan/disk_recycle/list', { params: { page, pageSize } })
}

/** 还原：实测入参为 ids（回收站记录 id，不是 memberFileId） */
export function restoreRecycle(ids) {
  const value = Array.isArray(ids) ? ids.join(',') : String(ids)
  return request.post('/pan/disk_recycle/restore', toForm({ ids: value }))
}

/** 彻底删除：实测入参为 ids（回收站记录 id） */
export function deleteRecycle(ids) {
  const value = Array.isArray(ids) ? ids.join(',') : String(ids)
  return request.post('/pan/disk_recycle/delete', toForm({ ids: value }))
}
