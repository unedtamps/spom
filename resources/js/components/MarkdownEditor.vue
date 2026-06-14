<script setup>
import { ref } from 'vue'

const props = defineProps({
  modelValue: { type: String, default: '' },
  placeholder: { type: String, default: 'Write in markdown... Drag & drop images here.' },
  rows: { type: Number, default: 10 },
})

const emit = defineEmits(['update:modelValue'])

const textarea = ref(null)
const uploading = ref(false)

const onInput = (e) => {
  emit('update:modelValue', e.target.value)
}

const getCsrfToken = () => {
  return document.querySelector('meta[name="csrf-token"]')?.content || ''
}

const insertAtCursor = (text) => {
  const el = textarea.value
  if (!el) return
  const start = el.selectionStart
  const end = el.selectionEnd
  const before = props.modelValue.substring(0, start)
  const after = props.modelValue.substring(end)
  emit('update:modelValue', before + text + after)
  // Set cursor position after inserted text
  setTimeout(() => {
    el.selectionStart = el.selectionEnd = start + text.length
    el.focus()
  }, 0)
}

const uploadFile = async (file) => {
  if (!file || !file.type.startsWith('image/')) return

  uploading.value = true
  try {
    const formData = new FormData()
    formData.append('image', file)
    formData.append('_token', getCsrfToken())

    const response = await fetch('/upload-image', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json',
      },
    })

    const data = await response.json()
    if (data.data?.filePath) {
      insertAtCursor(`![image](${data.data.filePath})`)
    }
  } catch (err) {
    console.error('Image upload failed:', err)
  } finally {
    uploading.value = false
  }
}

const onDrop = (e) => {
  const file = e.dataTransfer?.files[0]
  if (file) {
    uploadFile(file)
  }
}

const onPaste = (e) => {
  const items = e.clipboardData?.items
  if (!items) return
  for (const item of items) {
    if (item.type.startsWith('image/')) {
      e.preventDefault()
      const file = item.getAsFile()
      if (file) uploadFile(file)
      break
    }
  }
}
</script>

<template>
  <div style="position: relative;">
    <textarea
      ref="textarea"
      :value="modelValue"
      :placeholder="placeholder"
      :rows="rows"
      class="input-name"
      style="font-family: monospace; resize: vertical; width: 100%;"
      @input="onInput"
      @drop.prevent="onDrop"
      @dragover.prevent
      @paste="onPaste"
    ></textarea>
    <div v-if="uploading" style="
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: var(--color-primary);
      color: white;
      padding: 0.25rem 0.75rem;
      border-radius: 1rem;
      font-size: 0.75rem;
    ">
      Uploading...
    </div>
  </div>
</template>
