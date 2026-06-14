<script setup>
import { computed } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { marked } from 'marked'
import MarkdownEditor from '../../components/MarkdownEditor.vue'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  origin: { type: Object, required: true },
})

const form = useForm({
  content: props.origin.content || '',
})

const renderedPreview = computed(() => {
  return form.content ? marked.parse(form.content) : ''
})

const renderedExisting = computed(() => {
  return props.origin.content_html || ''
})

const submit = () => {
  form.put(`/origin/${props.origin.id}`)
}
</script>

<template>
  <div class="feeds">
    <div class="feed">
      <h1>Contribute to {{ origin.name }}</h1>
      <small class="text-muted">Editing origin story</small>

      <div v-if="renderedExisting" style="margin-top: 1rem;">
        <label class="text-bold">Current Content</label>
        <div
          class="markdown-content"
          style="background: var(--color-light); padding: 1rem; border-radius: var(--card-border-radius); min-height: 3rem;"
          v-html="renderedExisting"
        ></div>
      </div>

      <form @submit.prevent="submit" class="form-input" style="margin-top: 1rem;">
        <div>
          <label class="text-bold">Name</label>
          <input
            :value="origin.name"
            type="text"
            class="input-name"
            readonly
            style="background: var(--color-light); cursor: not-allowed;"
          >
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
            {{ form.processing ? 'Submitting...' : 'Submit Contribution' }}
          </button>
          <Link :href="`/origin/${origin.id}`">
            <button type="button" class="btn btn-second">Cancel</button>
          </Link>
        </div>
      </form>
    </div>
  </div>
</template>
