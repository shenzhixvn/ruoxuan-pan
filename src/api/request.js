import axios from 'axios'
import { ElMessage } from 'element-plus'

/**
 * 统一 axios 封装
 * - baseURL: /api（与后端同源，nginx 转发到 pan-web:8088）
 * - withCredentials: 后端使用 Cookie Session 鉴权
 * - 响应拦截：code === 0 直接返回 data；code === 1001 跳登录；其它 code 统一 ElMessage 并 reject
 * - config.silent === true 时不弹全局提示（表单内联报错场景使用）
 */
const service = axios.create({
  baseURL: '/api',
  withCredentials: true,
  timeout: 120000
})

/** 把普通对象转成 application/x-www-form-urlencoded 参数 */
export function toForm(obj) {
  const params = new URLSearchParams()
  Object.entries(obj || {}).forEach(([key, value]) => {
    if (value === undefined || value === null) return
    params.append(key, typeof value === 'object' ? JSON.stringify(value) : String(value))
  })
  return params
}

let redirecting = false

function redirectToLogin(msg) {
  localStorage.removeItem('pan:user')
  if (redirecting) return
  redirecting = true
  ElMessage.error(msg || '登录已失效，请重新登录')
  const loginPath = `${import.meta.env.BASE_URL.replace(/\/$/, '')}/login`
  if (!window.location.pathname.startsWith(loginPath)) {
    const redirect = encodeURIComponent(window.location.pathname + window.location.search)
    window.location.href = `${loginPath}?redirect=${redirect}`
  }
  window.setTimeout(() => {
    redirecting = false
  }, 1500)
}

service.interceptors.response.use(
  (response) => {
    // 文件流等二进制响应原样返回
    if (response.config.responseType === 'blob' || response.data instanceof Blob) {
      return response
    }
    const res = response.data
    if (!res || typeof res !== 'object' || !('code' in res)) {
      if (!response.config.silent) ElMessage.error('服务返回数据格式异常')
      return Promise.reject(new Error('返回数据格式异常'))
    }
    if (res.code === 0) return res.data

    if (res.code === 1001) {
      redirectToLogin(res.msg)
      const err = new Error(res.msg || '请登录')
      err.code = res.code
      err.handled = true
      return Promise.reject(err)
    }

    const message = res.msg || '操作失败'
    if (!response.config.silent) ElMessage.error(message)
    const err = new Error(message)
    err.code = res.code
    err.handled = true
    return Promise.reject(err)
  },
  (error) => {
    if (axios.isCancel(error)) return Promise.reject(error)
    let message = '网络异常，请检查网络后重试'
    if (error.code === 'ECONNABORTED') message = '请求超时，请稍后重试'
    else if (error.response) {
      const status = error.response.status
      if (status === 401 || status === 403) message = '登录已失效，请重新登录'
      else if (status === 413) message = '文件分片过大，已被服务器拒绝'
      else if (status >= 500) message = '服务器开小差了，请稍后重试'
      else message = `请求失败（HTTP ${status}）`
    }
    if (!error.config?.silent) ElMessage.error(message)
    const err = new Error(message)
    err.handled = true
    return Promise.reject(err)
  }
)

export default service
