<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  pic: null,
})

const preview = ref(null)

const onFileChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    form.pic = file
    preview.value = URL.createObjectURL(file)
  }
}

const submit = () => {
  form.post('/meme', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      preview.value = null
    },
  })
}
</script>

<template>
  <form @submit.prevent="submit">
    <div class="feeds">
      <div class="feed">
        <label for="title">
          <h2 style="padding-left: 1rem; padding-bottom: 0">Title</h2>
          <input
            v-model="form.title"
            placeholder="Enter your title"
            id="title"
            class="input-meme"
            type="text"
          >
          <div v-if="form.errors.title" class="error-input">{{ form.errors.title }}</div>
        </label>

        <div class="input-image-meme" style="padding: 1rem 0rem 1rem 1rem">
          <label for="input-post-meme">
            <span style="font-size: 1.1rem"><i class="uil uil-image-plus"></i> Upload Meme</span>
          </label>
          <input id="input-post-meme" type="file" accept="image/*" @change="onFileChange">
          <div v-if="form.errors.pic" class="error-input">{{ form.errors.pic }}</div>
        </div>

        <div v-if="preview" class="input-result">
          <img :src="preview" alt="preview">
        </div>

        <button
          class="btn btn-primary"
          style="margin-top: 1rem; margin-bottom: 1rem; margin-left: 1rem"
          type="submit"
          :disabled="form.processing"
        >
          Submit
        </button>
      </div>
    </div>
  </form>
</template>
