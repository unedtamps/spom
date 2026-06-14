<script setup>
import { ref, computed } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import { useAuth } from '../../composables/useAuth'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  meme: { type: Object, required: true },
})

const { user } = useAuth()

const isOwner = computed(() => user.value?.id === props.meme.user_id)

const form = useForm({
  title: props.meme.title,
  image: null,
})

const newImagePreview = ref(null)

const onFileChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    form.image = file
    newImagePreview.value = URL.createObjectURL(file)
  }
}

const submit = () => {
  form.put(`/meme/${props.meme.id}`, {
    preserveScroll: true,
  })
}
</script>

<template>
  <div class="feeds">
    <div v-if="!isOwner" class="feed">
      <p>You are not the owner of this meme.</p>
      <button class="btn btn-second" @click="router.get('/home')">Go Back</button>
    </div>

    <div v-else class="feed">
      <h2>Edit Meme</h2>

      <div v-if="!newImagePreview" style="margin-top: 1rem; margin-bottom: 1rem;">
        <img :src="`/storage/meme/${meme.pics}`" alt="Current image" style="max-width: 100%; border-radius: 0.5rem;" />
      </div>

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
          <label for="image" style="display: block; margin-bottom: 0.25rem;">New Image (optional)</label>
          <input
            id="image"
            type="file"
            accept="image/*"
            @change="onFileChange"
          />
          <div v-if="form.errors.image" class="error">{{ form.errors.image }}</div>
        </div>

        <div v-if="newImagePreview" style="margin-bottom: 1rem;">
          <p style="margin-bottom: 0.25rem;"><small>New image preview:</small></p>
          <img :src="newImagePreview" alt="New preview" style="max-width: 100%; border-radius: 0.5rem;" />
        </div>

        <button
          type="submit"
          class="btn btn-primary"
          :disabled="form.processing"
        >
          {{ form.processing ? 'Updating...' : 'Update' }}
        </button>
      </form>
    </div>
  </div>
</template>
