<script setup>
import { computed } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { marked } from 'marked'
import MarkdownEditor from '../../components/MarkdownEditor.vue'

defineOptions({ layoutName: 'app' })

const form = useForm({
  name: '',
  content: '',
})

const renderedPreview = computed(() => {
  return form.content ? marked.parse(form.content) : ''
})

const submit = () => {
  form.post('/origin')
}
</script>

<template>
  <div class="feeds">
    <div class="feed">
      <h1>Create Origin</h1>

      <form @submit.prevent="submit" class="form-input" style="margin-top: 1rem;">
        <div>
          <label class="text-bold">Name</label>
          <input
            v-model="form.name"
            type="text"
            class="input-name"
            placeholder="Origin name"
            required
          >
          <small v-if="form.errors.name" class="error-input">{{ form.errors.name }}</small>
        </div>

        <div>
          <label class="text-bold">Content (Markdown)</label>
          <MarkdownEditor v-model="form.content" />
          <small v-if="form.errors.content" class="error-input">{{ form.errors.content }}</small>
        </div>

        <div v-if="form.content">
          <label class="text-bold">Preview</label>
          <div
            class="markdown-content"
            style="background: var(--color-light); padding: 1rem; border-radius: var(--card-border-radius); min-height: 3rem;"
            v-html="renderedPreview"
          ></div>
        </div>

        <div class="interaction-button">
          <button type="submit" class="btn btn-primary" :disabled="form.processing">
            {{ form.processing ? 'Submitting...' : 'Submit' }}
          </button>
          <Link href="/origin">
            <button type="button" class="btn btn-second">Cancel</button>
          </Link>
        </div>
      </form>
    </div>
  </div>
</template>
