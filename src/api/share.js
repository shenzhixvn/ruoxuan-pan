import request, { toForm } from './request'

/** 我的分享列表：data = { total, records } */
export function listShares({ page = 1, pageSize = 50 } = {}) {
  return request.get('/pan/disk_share/list', { params: { page, pageSize } })
}

/** 取消分享：实测入参为 ids（逗号分隔的分享记录 id） */
export function deleteShares(ids) {
  const value = Array.isArray(ids) ? ids.join(',') : String(ids)
  return request.post('/pan/disk_share/delete', toForm({ ids: value }))
}
