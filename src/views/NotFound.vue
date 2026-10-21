<template>
  <div class="not-found">
    <div class="code">404</div>
    <p class="text">这个页面好像被移动或删除了</p>
    <el-button type="primary" @click="router.replace('/files')">回到文件管理</el-button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()
</script>

<style scoped>
.not-found {
  min-height: 70vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 12px;
  background: var(--pan-bg);
}

.code {
  font-size: 82px;
  font-weight: 700;
  letter-spacing: 6px;
  background: linear-gradient(135deg, #3550a3, #7f95e2);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.text {
  margin: 0 0 10px;
  color: var(--pan-text-weak);
}
</style>
