<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'

defineOptions({ layoutName: 'app' })

const form = useForm({
  title: '',
  image: null,
})

const imagePreview = ref(null)

const onFileChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    form.image = file
    imagePreview.value = URL.createObjectURL(file)
  }
}

const submit = () => {
  form.post('/meme', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      imagePreview.value = null
    },
  })
}
</script>

<template>
  <div class="feeds">
    <div class="feed">
      <h2>Create Meme</h2>

      <form @submit.prevent="submit" style="margin-top: 1rem;">
        <div style="margin-bottom: 1rem;">
          <label for="title" style="display: block; margin-bottom: 0.25rem;">Title</label>
          <input
            id="title"
            v-model="form.title"
            type="text"
            class="form-control"
            placeholder="Enter meme title"
          />
          <div v-if="form.errors.title" class="error">{{ form.errors.title }}</div>
        </div>

        <div style="margin-bottom: 1rem;">
          <label for="image" style="display: block; margin-bottom: 0.25rem;">Image</label>
          <input
            id="image"
            type="file"
            accept="image/*"
            @change="onFileChange"
          />
          <div v-if="form.errors.image" class="error">{{ form.errors.image }}</div>
        </div>

        <div v-if="imagePreview" style="margin-bottom: 1rem;">
          <img :src="imagePreview" alt="Preview" style="max-width: 100%; border-radius: 0.5rem;" />
        </div>

        <button
          type="submit"
          class="btn btn-primary"
          :disabled="form.processing"
        >
          {{ form.processing ? 'Uploading...' : 'Create' }}
        </button>
      </form>
    </div>
  </div>
</template>
