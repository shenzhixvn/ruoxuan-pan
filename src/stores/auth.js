import { defineStore } from 'pinia'
import { login as loginApi, logout as logoutApi } from '@/api/auth'

const STORAGE_KEY = 'pan:user'

/**
 * 认证 store
 * 后端为 Cookie Session，前端无法读取 httpOnly cookie，也没有「获取当前用户」接口，
 * 因此登录成功后把账号名缓存到 localStorage，作为登录态与页面展示依据。
 */
export const useAuthStore = defineStore('auth', {
  state: () => ({
    username: localStorage.getItem(STORAGE_KEY) || '',
    loggedIn: !!localStorage.getItem(STORAGE_KEY)
  }),
  getters: {
    displayName: (state) => state.username || '未登录',
    initial: (state) => (state.username ? state.username.slice(0, 1).toUpperCase() : '?')
  },
  actions: {
    async login(username, password, captcha) {
      await loginApi(username, password, captcha)
      this.username = username
      this.loggedIn = true
      localStorage.setItem(STORAGE_KEY, username)
    },
    async logout() {
      try {
        await logoutApi()
      } catch (error) {
        // 退出失败不阻断前端清理
      }
      this.clear()
    },
    clear() {
      this.username = ''
      this.loggedIn = false
      localStorage.removeItem(STORAGE_KEY)
    }
  }
})
