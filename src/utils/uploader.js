import SparkMD5 from 'spark-md5'
import { uploadChunk, uploadInit } from '@/api/disk'

/**
 * 分片上传实现（严格按后端真实协议）
 *
 * 1) init：multipart，action=init + name/type/lastModifiedDate/size/chunks/dirFileId/hash
 *    - 若该 hash 已存在于物理文件表，后端会「秒传」并返回 { uploadedChunks: [1..n] }（此时文件已入库）
 *    - 否则返回 { hash(服务端 token), chunkUploaded, path, fullPath }，chunkUploaded 可用于断点续传
 * 2) 分片：action=upload + 同一批字段 + chunk(0 起) + file
 *    - 未完成：返回值含 finished:false
 *    - 完成：返回 { data: { path, filename, size }, fullPath }
 *
 * 关键点：
 * - PHP upload_max_filesize = 2M，所以分片大小取 1MB，不能整文件直传
 * - init 与分片的字段必须完全一致（服务端用 md5(serialize(字段)) 定位上传 token）
 * - hash 必须是每个文件唯一的内容 MD5，否则会命中空 hash 的重复键报错
 */

export const CHUNK_SIZE = 1024 * 1024 // 1MB

/** 计算文件内容 MD5（分片读取，避免大文件占满内存） */
export function calcMd5(file, onProgress) {
  return new Promise((resolve, reject) => {
    const spark = new SparkMD5.ArrayBuffer()
    const reader = new FileReader()
    const total = Math.max(1, Math.ceil(file.size / CHUNK_SIZE))
    let current = 0

    const readNext = () => {
      const start = current * CHUNK_SIZE
      const end = Math.min(file.size, start + CHUNK_SIZE)
      reader.readAsArrayBuffer(file.slice(start, end))
    }

    reader.onload = (event) => {
      spark.append(event.target.result)
      current += 1
      if (onProgress) onProgress(Math.round((current / total) * 100))
      if (current < total) readNext()
      else resolve(spark.end())
    }
    reader.onerror = () => reject(new Error('读取文件失败'))
    if (file.size === 0) resolve(SparkMD5.ArrayBuffer.hash(new ArrayBuffer(0)))
    else readNext()
  })
}

function buildBaseFields(file, dirFileId, chunks, hash, fileName) {
  return {
    name: fileName || file.name,
    type: file.type || 'application/octet-stream',
    lastModifiedDate: String(file.lastModified || Date.now()),
    size: String(file.size),
    chunks: String(chunks),
    dirFileId: String(dirFileId || 0),
    hash
  }
}

function toFormData(fields) {
  const formData = new FormData()
  Object.entries(fields).forEach(([key, value]) => formData.append(key, value))
  return formData
}

/**
 * 上传单个文件
 * @param {File} file
 * @param {object} options { dirFileId, fileName, onHashProgress, onProgress }
 *   fileName：覆盖上传后的文件名（同名冲突时自动重命名用）
 * @returns {Promise<{instant:boolean, fullPath?:string, data?:object}>}
 */
export async function uploadFile(file, options = {}) {
  const { dirFileId = 0, fileName, onHashProgress, onProgress } = options
  const hash = await calcMd5(file, onHashProgress)
  const chunks = Math.max(1, Math.ceil(file.size / CHUNK_SIZE))
  const baseFields = buildBaseFields(file, dirFileId, chunks, hash, fileName)

  const initResult = await uploadInit(toFormData({ action: 'init', ...baseFields }))
  // 秒传：后端已把文件挂到当前目录，无需再传
  if (initResult && Array.isArray(initResult.uploadedChunks) && initResult.uploadedChunks.length > 0) {
    if (onProgress) onProgress(100)
    return { instant: true, ...initResult }
  }

  // 断点续传：init 返回服务端已收到的分片数
  const uploaded = Number(initResult?.chunkUploaded || 0)
  let result = null

  for (let index = uploaded; index < chunks; index += 1) {
    const start = index * CHUNK_SIZE
    const blob = file.slice(start, Math.min(file.size, start + CHUNK_SIZE))
    const formData = toFormData({
      action: 'upload',
      ...baseFields,
      chunk: String(index)
    })
    formData.append('file', blob, fileName || file.name)

    result = await uploadChunk(formData, (event) => {
      if (!onProgress) return
      const chunkRatio = event.total ? event.loaded / event.total : 0
      onProgress(Math.min(99, Math.round(((index + chunkRatio) / chunks) * 100)))
    })

    if (result && result.finished === false) continue
  }

  if (onProgress) onProgress(100)
  return { instant: false, ...(result || {}) }
}
