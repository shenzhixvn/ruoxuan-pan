import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/login',
    name: 'login',
    meta: { title: '登录', public: true },
    component: () => import('@/views/Login.vue')
  },
  {
    path: '/',
    component: () => import('@/components/Layout.vue'),
    redirect: '/files',
    children: [
      {
        path: 'files',
        name: 'files',
        meta: { title: '文件管理', icon: 'FolderOpened' },
        component: () => import('@/views/Files.vue')
      },
      {
        path: 'shares',
        name: 'shares',
        meta: { title: '我的分享', icon: 'Share' },
        component: () => import('@/views/Shares.vue')
      },
      {
        path: 'recycle',
        name: 'recycle',
        meta: { title: '回收站', icon: 'Delete' },
        component: () => import('@/views/Recycle.vue')
      },
      {
        path: 'dashboard',
        name: 'dashboard',
        meta: { title: '用量中心', icon: 'DataAnalysis' },
        component: () => import('@/views/Dashboard.vue')
      },
      {
        path: 'profile',
        name: 'profile',
        meta: { title: '个人中心', icon: 'User' },
        component: () => import('@/views/Profile.vue')
      }
    ]
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    meta: { title: '页面不存在', public: true },
    component: () => import('@/views/NotFound.vue')
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior: () => ({ top: 0 })
})

router.beforeEach((to) => {
  const auth = useAuthStore()
  document.title = `${to.meta.title || '网盘'} · 若萱云盘`

  if (!to.meta.public && !auth.loggedIn) {
    return {
      path: '/login',
      query: { redirect: to.fullPath }
    }
  }
  // 已登录时不再进登录页
  if (to.path === '/login' && auth.loggedIn) {
    return { path: '/files' }
  }
  return true
})

export default router
