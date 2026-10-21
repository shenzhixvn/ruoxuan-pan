<template>
  <div class="page">
    <h2 class="page-title">个人中心</h2>
    <p class="page-subtitle">查看账号信息、空间用量与安全设置</p>

    <div class="profile-grid">
      <!-- 账号卡片 -->
      <div class="pan-card account-card">
        <div class="account-head">
          <div class="avatar-lg">{{ auth.initial }}</div>
          <div class="account-info">
            <div class="account-name">{{ auth.displayName }}</div>
            <div class="account-desc">普通用户 · 个人网盘</div>
          </div>
        </div>

        <el-descriptions :column="1" border class="account-desc-list">
          <el-descriptions-item label="登录账号">{{ auth.displayName }}</el-descriptions-item>
          <el-descriptions-item label="空间总量">{{ formatBytes(disk.panSizeLimit) }}</el-descriptions-item>
          <el-descriptions-item label="已用空间">{{ formatBytes(disk.panSizeUsed) }}</el-descriptions-item>
          <el-descriptions-item label="剩余空间">{{ formatBytes(freeSize) }}</el-descriptions-item>
        </el-descriptions>

        <div class="quota-block">
          <div class="quota-head">
            <span>空间使用率</span>
            <span>{{ usedPercent }}%</span>
          </div>
          <el-progress
            :percentage="usedPercent"
            :stroke-width="10"
            :color="usedPercent > 85 ? '#e05252' : '#5470c6'"
            :show-text="false"
          />
        </div>

        <el-button class="logout-btn" plain type="danger" :icon="SwitchButton" @click="handleLogout">
          退出登录
        </el-button>
      </div>

      <!-- 修改密码 -->
      <div class="pan-card password-card">
        <div class="card-title">
          <el-icon><Lock /></el-icon>
          <span>修改密码</span>
        </div>
        <p class="card-tip">修改后请使用新密码重新登录。</p>

        <el-alert v-if="errorText" :title="errorText" type="error" show-icon :closable="false" class="alert" />
        <el-alert v-if="successText" :title="successText" type="success" show-icon :closable="false" class="alert" />

        <el-form ref="formRef" :model="form" :rules="rules" label-position="top">
          <el-form-item label="当前密码" prop="passwordOld">
            <el-input v-model="form.passwordOld" type="password" show-password size="large" placeholder="请输入当前密码" />
          </el-form-item>
          <el-form-item label="新密码" prop="passwordNew">
            <el-input v-model="form.passwordNew" type="password" show-password size="large" placeholder="至少 6 位字符" />
          </el-form-item>
          <el-form-item label="确认新密码" prop="passwordRepeat">
            <el-input v-model="form.passwordRepeat" type="password" show-password size="large" placeholder="再次输入新密码" />
          </el-form-item>
          <el-button type="primary" size="large" class="submit-btn" :loading="submitting" @click="handleSubmit">
            保存修改
          </el-button>
        </el-form>

        <el-divider />

        <div class="tips">
          <div class="tips-title">说明</div>
          <ul>
            <li>接口：<span class="mono">POST /api/member_profile/password</span></li>
            <li>入参：<span class="mono">passwordOld / passwordNew / passwordRepeat</span>（实测）</li>
            <li>演示环境请谨慎修改 demo 账号密码，避免影响他人演示。</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { ElMessage, ElMessageBox } from 'element-plus'
import { Lock, SwitchButton } from '@element-plus/icons-vue'
import { changePassword } from '@/api/auth'
import { useAuthStore } from '@/stores/auth'
import { useFileStore } from '@/stores/file'
import { formatBytes } from '@/utils/format'

const router = useRouter()
const auth = useAuthStore()
const fileStore = useFileStore()

const formRef = ref(null)
const submitting = ref(false)
const errorText = ref('')
const successText = ref('')

const disk = computed(() => fileStore.diskInfo)
const usedPercent = computed(() => fileStore.usedPercent)
const freeSize = computed(() => fileStore.freeSize)

const form = reactive({ passwordOld: '', passwordNew: '', passwordRepeat: '' })

const rules = {
  passwordOld: [{ required: true, message: '请输入当前密码', trigger: 'blur' }],
  passwordNew: [
    { required: true, message: '请输入新密码', trigger: 'blur' },
    { min: 6, message: '密码至少 6 位', trigger: 'blur' }
  ],
  passwordRepeat: [
    { required: true, message: '请再次输入新密码', trigger: 'blur' },
    {
      validator: (rule, value, callback) => {
        if (value !== form.passwordNew) callback(new Error('两次输入的密码不一致'))
        else callback()
      },
      trigger: 'blur'
    }
  ]
}

async function handleSubmit() {
  errorText.value = ''
  successText.value = ''
  const valid = await formRef.value?.validate().catch(() => false)
  if (!valid) return

  submitting.value = true
  try {
    await changePassword({
      passwordOld: form.passwordOld,
      passwordNew: form.passwordNew,
      passwordRepeat: form.passwordRepeat
    })
    successText.value = '密码修改成功，请使用新密码重新登录'
    form.passwordOld = ''
    form.passwordNew = ''
    form.passwordRepeat = ''
    setTimeout(async () => {
      await auth.logout()
      router.push('/login')
    }, 1200)
  } catch (error) {
    errorText.value = error?.message || '密码修改失败'
  } finally {
    submitting.value = false
  }
}

async function handleLogout() {
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
  ElMessage.success('已退出登录')
  router.push('/login')
}

onMounted(() => {
  fileStore.fetchDiskInfo().catch(() => {})
})
</script>

<style scoped>
.profile-grid {
  display: grid;
  grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
  gap: 16px;
  align-items: start;
}

.account-card,
.password-card {
  padding: 22px;
}

.account-head {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 20px;
}

.avatar-lg {
  width: 58px;
  height: 58px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4a63b8, #7f95e2);
  color: #fff;
  font-size: 24px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 18px rgba(74, 99, 184, 0.28);
}

.account-name {
  font-size: 18px;
  font-weight: 600;
}

.account-desc {
  font-size: 12px;
  color: var(--pan-text-weak);
  margin-top: 2px;
}

.account-desc-list {
  margin-bottom: 18px;
}

.quota-block {
  margin-bottom: 20px;
}

.quota-head {
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  color: var(--pan-text-weak);
  margin-bottom: 8px;
}

.logout-btn {
  width: 100%;
}

.card-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 6px;
}

.card-tip {
  margin: 0 0 16px;
  font-size: 12px;
  color: var(--pan-text-weak);
}

.alert {
  margin-bottom: 14px;
  border-radius: 10px;
}

.submit-btn {
  width: 100%;
  margin-top: 4px;
}

.tips {
  font-size: 12px;
  color: var(--pan-text-weak);
}

.tips-title {
  font-weight: 600;
  margin-bottom: 6px;
  color: #5c6784;
}

.tips ul {
  margin: 0;
  padding-left: 18px;
  line-height: 1.9;
}

@media (max-width: 900px) {
  .profile-grid {
    grid-template-columns: 1fr;
  }
}
</style>
