<template>
  <el-breadcrumb class="pan-breadcrumb" separator="/">
    <el-breadcrumb-item v-for="(item, index) in items" :key="item.id">
      <span
        class="crumb"
        :class="{ current: index === items.length - 1 }"
        @click="handleClick(item, index)"
      >
        <el-icon v-if="index === 0"><HomeFilled /></el-icon>
        <span>{{ item.name }}</span>
      </span>
    </el-breadcrumb-item>
  </el-breadcrumb>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  // [{ id, name }]，第一项为根目录
  items: {
    type: Array,
    default: () => [{ id: 0, name: '全部文件' }]
  }
})

const emit = defineEmits(['navigate'])

const safeItems = computed(() => (props.items && props.items.length ? props.items : [{ id: 0, name: '全部文件' }]))

function handleClick(item, index) {
  if (index === safeItems.value.length - 1) return
  emit('navigate', item.id)
}
</script>

<style scoped>
.pan-breadcrumb {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  font-size: 14px;
  line-height: 1.6;
}

.crumb {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  cursor: pointer;
  color: var(--pan-text-weak);
  transition: color 0.2s;
}

.crumb:hover {
  color: var(--pan-primary);
}

.crumb.current {
  color: var(--pan-text);
  font-weight: 600;
  cursor: default;
}
</style>
