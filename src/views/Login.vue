<template>
  <div class="login-page">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="login-card">
      <!-- 左侧品牌区 -->
      <section class="brand-panel">
        <div class="brand-top">
          <span class="logo">☁</span>
          <span class="brand-title">若萱云盘</span>
        </div>
        <h1 class="slogan">你的文件，<br />安全地放在云端</h1>
        <p class="desc">分片上传 · 断点续传 · 秒传去重 · 分享链接，课程实训版网盘前端。</p>
        <ul class="feature-list">
          <li><el-icon><FolderOpened /></el-icon>目录管理与拖拽上传</li>
          <li><el-icon><Share /></el-icon>一键生成分享链接与提取码</li>
          <li><el-icon><DataAnalysis /></el-icon>空间用量与文件类型统计</li>
        </ul>
        <div class="brand-foot">Vue 3 · Vite · Pinia · Element Plus</div>
      </section>

      <!-- 右侧表单区 -->
      <section class="form-panel">
        <h2 class="form-title">登录</h2>
        <p class="form-sub">使用网盘账号登录后开始管理文件</p>

        <el-alert
          v-if="errorText"
          :title="errorText"
          type="error"
          show-icon
          :closable="false"
          class="error-alert"
        />

        <el-form ref="formRef" :model="form" :rules="rules" label-position="top" @submit.prevent="handleLogin">
          <el-form-item label="账号" prop="username">
            <el-input v-model="form.username" size="large" placeholder="请输入账号" clearable :prefix-icon="User" />
          </el-form-item>

          <el-form-item label="密码" prop="password">
            <el-input
              v-model="form.password"
              size="large"
              type="password"
              show-password
              placeholder="请输入密码"
              :prefix-icon="Lock"
              @keyup.enter="handleLogin"
            />
          </el-form-item>

          <!-- 验证码兼容分支：后端当前未开启登录验证码，可手动展开 -->
          <el-form-item v-if="captchaVisible" label="验证码" prop="captcha">
            <div class="captcha-row">
              <el-input v-model="form.captcha" size="large" placeholder="请输入验证码" />
              <img v-if="captchaImage" :src="captchaImage" class="captcha-img" alt="验证码" @click="loadCaptcha" />
              <el-button v-else size="large" @click="loadCaptcha">获取</el-button>
            </div>
          </el-form-item>

          <div class="form-extra">
            <el-checkbox v-model="remember">记住账号</el-checkbox>
            <el-link type="primary" :underline="false" @click="toggleCaptcha">
              {{ captchaVisible ? '收起验证码' : '使用验证码登录' }}
            </el-link>
          </div>

          <el-button type="primary" size="large" class="submit" :loading="loading" @click="handleLogin">
            {{ loading ? '登录中…' : '登 录' }}
          </el-button>
        </el-form>

        <p class="hint">演示账号：demo / 123456</p>
      </section>
    </div>
  </div>
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { ElMessage } from 'element-plus'
import { Lock, User } from '@element-plus/icons-vue'
import { getLoginCaptcha } from '@/api/auth'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const route = useRoute()
const auth = useAuthStore()

const formRef = ref(null)
const loading = ref(false)
const errorText = ref('')
const remember = ref(true)
const captchaVisible = ref(false)
const captchaImage = ref('')

const form = reactive({
  username: localStorage.getItem('pan:lastUser') || 'demo',
  password: '',
  captcha: ''
})

const rules = {
  username: [{ required: true, message: '请输入账号', trigger: 'blur' }],
  password: [{ required: true, message: '请输入密码', trigger: 'blur' }]
}

async function loadCaptcha() {
  try {
    const data = await getLoginCaptcha()
    captchaImage.value = data?.image || ''
  } catch (error) {
    ElMessage.warning('验证码加载失败，可稍后重试')
  }
}

function toggleCaptcha() {
  captchaVisible.value = !captchaVisible.value
  if (captchaVisible.value && !captchaImage.value) loadCaptcha()
}

async function handleLogin() {
  if (loading.value) return
  errorText.value = ''
  const valid = await formRef.value?.validate().catch(() => false)
  if (!valid) return

  loading.value = true
  try {
    await auth.login(form.username.trim(), form.password, captchaVisible.value ? form.captcha : '')
    if (remember.value) localStorage.setItem('pan:lastUser', form.username.trim())
    else localStorage.removeItem('pan:lastUser')
    ElMessage.success('登录成功')
    const redirect = typeof route.query.redirect === 'string' ? route.query.redirect : '/files'
    router.replace(redirect.startsWith('/') ? redirect : '/files')
  } catch (error) {
    errorText.value = error?.message || '登录失败，请检查账号密码'
    form.password = ''
    if (captchaVisible.value) loadCaptcha()
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  if (auth.loggedIn) router.replace('/files')
})
</script>

<style scoped>
.login-page {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  background: radial-gradient(circle at 12% 18%, #e8eeff 0%, transparent 45%),
    radial-gradient(circle at 88% 78%, #e6f1ff 0%, transparent 42%), #eef2fb;
  overflow: hidden;
}

.blob {
  position: absolute;
  border-radius: 50%;
  filter: blur(50px);
  opacity: 0.55;
}

.blob-1 {
  width: 420px;
  height: 420px;
  background: #b9c8f5;
  top: -140px;
  left: -120px;
}

.blob-2 {
  width: 380px;
  height: 380px;
  background: #c9e0ff;
  bottom: -160px;
  right: -100px;
}

.login-card {
  position: relative;
  display: grid;
  grid-template-columns: 1.05fr 1fr;
  width: min(920px, 100%);
  min-height: 520px;
  border-radius: 20px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 26px 60px rgba(31, 45, 90, 0.18);
}

/* 左侧 */
.brand-panel {
  position: relative;
  padding: 42px 40px;
  color: #fff;
  background: linear-gradient(160deg, #1b2447 0%, #2b3f7d 55%, #3f57a3 100%);
  display: flex;
  flex-direction: column;
}

.brand-panel::after {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 80% 10%, rgba(255, 255, 255, 0.16), transparent 45%);
  pointer-events: none;
}

.brand-top {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 18px;
  font-weight: 600;
  letter-spacing: 1px;
}

.logo {
  font-size: 26px;
}

.slogan {
  margin: 54px 0 14px;
  font-size: 30px;
  line-height: 1.4;
  font-weight: 600;
  letter-spacing: 1px;
}

.desc {
  margin: 0 0 26px;
  font-size: 13px;
  line-height: 1.9;
  color: rgba(255, 255, 255, 0.72);
}

.feature-list {
  list-style: none;
  margin: 0;
  padding: 0;
  font-size: 13px;
  color: rgba(255, 255, 255, 0.86);
}

.feature-list li {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 14px;
}

.brand-foot {
  margin-top: auto;
  font-size: 12px;
  color: rgba(255, 255, 255, 0.45);
  letter-spacing: 0.5px;
}

/* 右侧 */
.form-panel {
  padding: 48px 44px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.form-title {
  margin: 0 0 6px;
  font-size: 24px;
  font-weight: 600;
}

.form-sub {
  margin: 0 0 20px;
  font-size: 13px;
  color: var(--pan-text-weak);
}

.error-alert {
  margin-bottom: 14px;
  border-radius: 10px;
}

.form-extra {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 4px 0 20px;
}

.submit {
  width: 100%;
  height: 44px;
  font-size: 15px;
  letter-spacing: 4px;
  border-radius: 10px;
  background: linear-gradient(135deg, #3d5bb5, #5473d1);
  border: none;
}

.submit:hover {
  background: linear-gradient(135deg, #3550a3, #4a68c6);
}

.hint {
  margin: 18px 0 0;
  text-align: center;
  font-size: 12px;
  color: #a6aec2;
}

.captcha-row {
  display: flex;
  gap: 10px;
  width: 100%;
}

.captcha-img {
  height: 40px;
  border-radius: 8px;
  cursor: pointer;
  border: 1px solid #e4e9f5;
}

@media (max-width: 860px) {
  .login-card {
    grid-template-columns: 1fr;
    min-height: auto;
  }

  .brand-panel {
    display: none;
  }

  .form-panel {
    padding: 34px 26px;
  }
}
</style>
