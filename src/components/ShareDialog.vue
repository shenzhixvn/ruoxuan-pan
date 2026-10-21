<template>
  <el-dialog v-model="visible" title="创建分享链接" width="460px" @open="resetForm">
    <template v-if="!result">
      <el-form label-width="76px" label-position="left">
        <el-form-item label="分享名称">
          <el-input v-model="form.name" maxlength="40" show-word-limit placeholder="给这个分享起个名字" />
        </el-form-item>
        <el-form-item label="有效期">
          <el-radio-group v-model="form.expireDay">
            <el-radio-button :value="1">1 天</el-radio-button>
            <el-radio-button :value="7">7 天</el-radio-button>
            <el-radio-button :value="30">30 天</el-radio-button>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="文件">
          <div class="files">
            <el-tag v-for="item in records" :key="item.id" size="small" effect="plain">{{ item.fileName }}</el-tag>
          </div>
        </el-form-item>
      </el-form>
    </template>

    <template v-else>
      <el-result icon="success" title="分享创建成功" sub-title="把链接和提取码发给对方即可">
        <template #extra>
          <div class="share-box">
            <div class="share-row">
              <span class="label">链接</span>
              <el-input :model-value="result.url" readonly />
              <el-button type="primary" plain @click="copy(result.url)">复制</el-button>
            </div>
            <div class="share-row">
              <span class="label">提取码</span>
              <el-input :model-value="result.code" readonly class="code-input" />
              <el-button type="primary" plain @click="copy(result.code)">复制</el-button>
            </div>
            <div class="expire">有效期至：{{ result.expireTime || '—' }}</div>
          </div>
        </template>
      </el-result>
    </template>

    <template #footer>
      <el-button @click="visible = false">{{ result ? '完成' : '取消' }}</el-button>
      <el-button v-if="!result" type="primary" :loading="loading" @click="handleSubmit">创建分享</el-button>
    </template>
  </el-dialog>
</template>

<script setup>
import { computed, reactive, ref } from 'vue'
import { ElMessage } from 'element-plus'
import { shareFiles } from '@/api/disk'

const props = defineProps({
  modelValue: { type: Boolean, default: false },
  records: { type: Array, default: () => [] }
})

const emit = defineEmits(['update:modelValue', 'created'])

const visible = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

const loading = ref(false)
const result = ref(null)
const form = reactive({ name: '', expireDay: 7 })

function resetForm() {
  result.value = null
  form.expireDay = 7
  form.name = props.records.length === 1 ? props.records[0].fileName : `分享 ${props.records.length} 个文件`
}

async function handleSubmit() {
  if (!props.records.length) {
    ElMessage.warning('请先选择要分享的文件')
    return
  }
  if (!form.name.trim()) {
    ElMessage.warning('请填写分享名称')
    return
  }
  loading.value = true
  try {
    const data = await shareFiles(
      props.records.map((item) => item.id),
      { name: form.name.trim(), expireDay: form.expireDay, type: 1 }
    )
    result.value = data?.share || null
    emit('created')
  } finally {
    loading.value = false
  }
}

async function copy(text) {
  try {
    await navigator.clipboard.writeText(text)
    ElMessage.success('已复制到剪贴板')
  } catch (error) {
    ElMessage.warning('浏览器不允许自动复制，请手动选择复制')
  }
}
</script>

<style scoped>
.files {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.share-box {
  text-align: left;
  width: 100%;
}

.share-row {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
}

.share-row .label {
  width: 48px;
  font-size: 13px;
  color: var(--pan-text-weak);
  flex-shrink: 0;
}

.code-input {
  max-width: 140px;
}

.expire {
  font-size: 12px;
  color: var(--pan-text-weak);
}
</style>
