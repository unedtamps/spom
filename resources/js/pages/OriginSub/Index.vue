<script setup>
import { Link, router } from '@inertiajs/vue3'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  submissions: { type: Array, required: true },
  counts: { type: Object, required: true },
})

const approve = (id) => {
  router.post(`/origin-sub/${id}/approve`)
}

const deny = (id) => {
  if (confirm('Are you sure you want to deny this submission?')) {
    router.delete(`/origin-sub/${id}`)
  }
}
</script>

<template>
  <div>
    <div class="statistic" style="margin: 2rem auto; width: 90%;">
      <div class="stats">
        <div>{{ counts.total_memes }}</div>
        <small class="text-muted">Memes</small>
      </div>
      <div class="stats">
        <div>{{ counts.total_origins }}</div>
        <small class="text-muted">Origins</small>
      </div>
      <div class="stats">
        <div>{{ counts.total_submissions }}</div>
        <small class="text-muted">Submissions</small>
      </div>
      <div class="stats">
        <div>{{ counts.total_users }}</div>
        <small class="text-muted">Users</small>
      </div>
    </div>

    <div class="feeds">
      <div v-if="submissions.length === 0" class="feed">
        <p class="text-muted">No submissions found.</p>
      </div>

      <div v-for="sub in submissions" :key="sub.id" class="feed">
        <div class="head">
          <div>
            <h1>{{ sub.name }}</h1>
            <small class="text-muted">
              {{ new Date(sub.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric', hour: 'numeric', minute: '2-digit' }) }}
            </small>
          </div>
        </div>

        <div style="margin-top: 0.5rem;">
          <small class="text-muted">Submitted by </small>
          <Link :href="`/user/${sub.user_id}`">
            <small class="text-bold">{{ sub.user?.name }}</small>
          </Link>
        </div>

        <div v-if="sub.origin" style="margin-top: 0.25rem;">
          <small class="text-muted">Contribution to </small>
          <Link :href="`/origin/${sub.origin.id}`">
            <small class="text-bold">{{ sub.origin.name }}</small>
          </Link>
        </div>

        <div class="markdown-content" style="margin-top: 0.75rem;" v-html="sub.content_html"></div>

        <div class="action-buttons" style="margin-top: 0.75rem;">
          <div class="interaction-button">
            <button class="btn btn-success" @click="approve(sub.id)">Approve</button>
            <button class="btn btn-logout" @click="deny(sub.id)">Deny</button>
            <Link :href="`/origin-sub/${sub.id}`">
              <button class="btn btn-second">Details</button>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
