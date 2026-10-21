<template>
  <div class="layout">
    <!-- 桌面端侧栏 -->
    <aside v-if="!isMobile" class="sidebar" :class="{ collapsed }">
      <div class="brand" @click="router.push('/files')">
        <span class="brand-logo">☁</span>
        <span v-show="!collapsed" class="brand-name">若萱云盘</span>
      </div>

      <el-menu
        :default-active="activeMenu"
        :collapse="collapsed"
        :collapse-transition="false"
        class="side-menu"
        background-color="transparent"
        text-color="#c7d0ea"
        active-text-color="#ffffff"
        router
      >
        <el-menu-item v-for="item in menus" :key="item.path" :index="item.path">
          <el-icon><component :is="item.icon" /></el-icon>
          <template #title>{{ item.title }}</template>
        </el-menu-item>
      </el-menu>

      <div class="sidebar-footer">
        <div v-show="!collapsed" class="quota">
          <div class="quota-head">
            <span>已用空间</span>
            <span>{{ usedText }}</span>
          </div>
          <el-progress
            :percentage="fileStore.usedPercent"
            :stroke-width="6"
            :show-text="false"
            color="#8fa6ff"
            trail-color="rgba(255,255,255,.18)"
          />
        </div>
      </div>
    </aside>

    <!-- 移动端抽屉菜单 -->
    <el-drawer v-model="drawerVisible" direction="ltr" size="230px" :with-header="false" class="mobile-drawer">
      <div class="drawer-inner">
        <div class="brand">
          <span class="brand-logo">☁</span>
          <span class="brand-name">若萱云盘</span>
        </div>
        <el-menu :default-active="activeMenu" class="side-menu" router @select="drawerVisible = false">
          <el-menu-item v-for="item in menus" :key="item.path" :index="item.path">
            <el-icon><component :is="item.icon" /></el-icon>
            <template #title>{{ item.title }}</template>
          </el-menu-item>
        </el-menu>
      </div>
    </el-drawer>

    <div class="main">
      <header class="topbar">
        <el-button text class="collapse-btn" @click="toggleSidebar">
          <el-icon :size="20"><Expand v-if="collapsed || isMobile" /><Fold v-else /></el-icon>
        </el-button>

        <div class="topbar-title">
          <span class="title">{{ route.meta.title || '文件管理' }}</span>
          <span class="subtitle">{{ subtitle }}</span>
        </div>

        <div class="topbar-right">
          <el-tag class="quota-tag" effect="plain" round>
            已用 {{ usedText }}
          </el-tag>

          <el-dropdown trigger="click" @command="handleCommand">
            <div class="user-chip">
              <div class="avatar">{{ auth.initial }}</div>
              <span class="username">{{ auth.displayName }}</span>
              <el-icon><ArrowDown /></el-icon>
            </div>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item command="profile">
                  <el-icon><User /></el-icon>个人中心
                </el-dropdown-item>
                <el-dropdown-item command="dashboard">
                  <el-icon><DataAnalysis /></el-icon>用量中心
                </el-dropdown-item>
                <el-dropdown-item command="logout" divided>
                  <el-icon><SwitchButton /></el-icon>退出登录
                </el-dropdown-item>
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </div>
      </header>

      <main class="content">
        <router-view v-slot="{ Component }">
          <transition name="fade-slide" mode="out-in">
            <component :is="Component" />
          </transition>
        </router-view>
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { ElMessageBox } from 'element-plus'
import { useAuthStore } from '@/stores/auth'
import { useFileStore } from '@/stores/file'
import { formatBytes } from '@/utils/format'

const route = useRoute()
const router = useRouter()
const auth = useAuthStore()
const fileStore = useFileStore()

const menus = [
  { path: '/files', title: '文件管理', icon: 'FolderOpened' },
  { path: '/shares', title: '我的分享', icon: 'Share' },
  { path: '/recycle', title: '回收站', icon: 'Delete' },
  { path: '/dashboard', title: '用量中心', icon: 'DataAnalysis' },
  { path: '/profile', title: '个人中心', icon: 'User' }
]

const collapsed = ref(false)
const drawerVisible = ref(false)
const isMobile = ref(false)

const activeMenu = computed(() => `/${route.path.split('/')[1] || 'files'}`)
const usedText = computed(() => `${formatBytes(fileStore.diskInfo.panSizeUsed)} / ${formatBytes(fileStore.diskInfo.panSizeLimit)}`)
const subtitle = computed(() => {
  if (route.name === 'files') return fileStore.currentDirName
  if (route.name === 'profile') return '账号与安全'
  if (route.name === 'dashboard') return '空间用量与文件构成'
  return '文件与链接管理'
})

function updateViewport() {
  isMobile.value = window.innerWidth <= 768
  if (!isMobile.value) drawerVisible.value = false
}

function toggleSidebar() {
  if (isMobile.value) drawerVisible.value = true
  else collapsed.value = !collapsed.value
}

async function handleCommand(command) {
  if (command === 'profile') router.push('/profile')
  if (command === 'dashboard') router.push('/dashboard')
  if (command === 'logout') {
    try {
      await ElMessageBox.confirm('确定要退出登录吗？', '退出登录', {
        confirmButtonText: '退出',
        cancelButtonText: '再想想',
        type: 'warning'
      })
    } catch (error) {
      return
    }
    await auth.logout()
    router.push('/login')
  }
}

onMounted(() => {
  updateViewport()
  window.addEventListener('resize', updateViewport)
  fileStore.fetchDiskInfo().catch(() => {})
})

onBeforeUnmount(() => window.removeEventListener('resize', updateViewport))
</script>

<style scoped>
.layout {
  display: flex;
  min-height: 100vh;
  background: var(--pan-bg);
}

/* 侧栏：深蓝/靛青渐变 */
.sidebar {
  width: 220px;
  display: flex;
  flex-direction: column;
  background: linear-gradient(170deg, var(--pan-sidebar-from), var(--pan-sidebar-to));
  color: #fff;
  transition: width 0.22s ease;
  position: sticky;
  top: 0;
  height: 100vh;
  flex-shrink: 0;
}

.sidebar.collapsed {
  width: 64px;
}

.brand {
  display: flex;
  align-items: center;
  gap: 10px;
  height: 64px;
  padding: 0 18px;
  cursor: pointer;
  flex-shrink: 0;
}

.brand-logo {
  font-size: 22px;
  line-height: 1;
}

.brand-name {
  font-size: 17px;
  font-weight: 600;
  letter-spacing: 1px;
  white-space: nowrap;
}

.side-menu {
  border-right: none;
  flex: 1;
  padding: 6px 8px;
}

.side-menu:not(.el-menu--collapse) {
  width: 100%;
}

.side-menu :deep(.el-menu-item) {
  height: 46px;
  border-radius: 10px;
  margin-bottom: 4px;
  color: #c7d0ea;
}

.side-menu :deep(.el-menu-item:hover) {
  background: rgba(255, 255, 255, 0.09);
  color: #fff;
}

.side-menu :deep(.el-menu-item.is-active) {
  background: linear-gradient(90deg, rgba(143, 166, 255, 0.34), rgba(143, 166, 255, 0.12));
  color: #fff;
  font-weight: 600;
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08);
}

.sidebar-footer {
  padding: 14px;
}

.quota {
  border-radius: 10px;
  padding: 10px 12px;
  background: rgba(255, 255, 255, 0.07);
}

.quota-head {
  display: flex;
  justify-content: space-between;
  font-size: 11px;
  color: #c7d0ea;
  margin-bottom: 8px;
}

/* 主区域 */
.main {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
}

.topbar {
  height: 64px;
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 0 20px;
  background: #fff;
  border-bottom: 1px solid #eceff7;
  position: sticky;
  top: 0;
  z-index: 10;
}

.collapse-btn {
  padding: 6px;
  color: #4a5470;
}

.topbar-title {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.title {
  font-size: 16px;
  font-weight: 600;
}

.subtitle {
  font-size: 12px;
  color: var(--pan-text-weak);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 380px;
}

.topbar-right {
  margin-left: auto;
  display: flex;
  align-items: center;
  gap: 12px;
}

.quota-tag {
  border-color: #dbe2f5;
  color: #4a5b8f;
  background: #f6f8ff;
}

.user-chip {
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  padding: 4px 8px 4px 4px;
  border-radius: 20px;
  transition: background 0.2s;
}

.user-chip:hover {
  background: #f2f5fd;
}

.avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4a63b8, #6f8ae0);
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}

.username {
  font-size: 14px;
  color: #333b52;
}

.content {
  flex: 1;
  min-width: 0;
}

/* 移动端抽屉 */
.drawer-inner {
  height: 100%;
  background: linear-gradient(170deg, var(--pan-sidebar-from), var(--pan-sidebar-to));
  display: flex;
  flex-direction: column;
}

.drawer-inner .side-menu :deep(.el-menu-item) {
  color: #c7d0ea;
}

:deep(.mobile-drawer .el-drawer__body) {
  padding: 0;
}

@media (max-width: 768px) {
  .topbar {
    height: 56px;
    padding: 0 10px;
    gap: 6px;
  }

  .quota-tag,
  .subtitle {
    display: none;
  }

  .username {
    display: none;
  }
}
</style>
