<script setup>
import { Link, router } from '@inertiajs/vue3'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  submission: { type: Object, required: true },
})

const approve = () => {
  router.post(`/origin-sub/${props.submission.id}/approve`)
}

const deny = () => {
  if (confirm('Are you sure you want to deny this submission?')) {
    router.delete(`/origin-sub/${props.submission.id}`)
  }
}
</script>

<template>
  <div class="feeds">
    <div class="feed">
      <div class="head">
        <div>
          <h1>{{ submission.name }}</h1>
          <small class="text-muted">
            {{ new Date(submission.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric', hour: 'numeric', minute: '2-digit' }) }}
          </small>
        </div>
      </div>

      <div style="margin-top: 0.5rem;">
        <small class="text-muted">Submitted by </small>
        <Link :href="`/user/${submission.user_id}`">
          <small class="text-bold">{{ submission.user?.name }}</small>
        </Link>
      </div>

      <div v-if="submission.origin" style="margin-top: 0.25rem;">
        <small class="text-muted">Contribution to </small>
        <Link :href="`/origin/${submission.origin.id}`">
          <small class="text-bold">{{ submission.origin.name }}</small>
        </Link>
      </div>

      <div class="markdown-content" style="margin-top: 1rem;" v-html="submission.content_html"></div>

      <div class="action-buttons" style="margin-top: 1rem;">
        <div class="interaction-button">
          <button class="btn btn-success" @click="approve">Approve</button>
          <button class="btn btn-logout" @click="deny">Deny</button>
          <Link href="/origin-sub">
            <button class="btn btn-second">Back</button>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
