<script setup>
import { Link, router } from '@inertiajs/vue3'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  origins: { type: Array, required: true },
  page: { type: Number, default: 0 },
})

const goToPage = (p) => {
  router.get('/origin', { page: p }, { preserveScroll: true })
}
</script>

<template>
  <div class="feeds">
    <div v-if="origins.length === 0" class="feed">
      <p class="text-muted">No origins found.</p>
    </div>

    <div v-for="origin in origins" :key="origin.id" class="feed">
      <div class="head">
        <div>
          <h1>{{ origin.name }}</h1>
          <small class="text-muted">
            {{ new Date(origin.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' }) }}
          </small>
        </div>
      </div>

      <div class="markdown-content" v-html="origin.content_html"></div>

      <div v-if="origin.contributors && origin.contributors.length" style="margin-top: 0.75rem;">
        <small class="text-muted">Contributors:</small>
        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.25rem;">
          <Link
            v-for="contributor in origin.contributors"
            :key="contributor.id"
            :href="`/user/${contributor.user_id}`"
            style="display: flex; align-items: center; gap: 0.4rem; text-decoration: none;"
          >
            <div style="width: 1.5rem; height: 1.5rem; border-radius: 50%; overflow: hidden; flex-shrink: 0;">
              <img :src="`/storage/profile/${contributor.user?.profile_pic || 'profile.jpg'}`" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <small>{{ contributor.user?.name }}</small>
          </Link>
        </div>
      </div>

      <div class="action-buttons" style="margin-top: 0.75rem;">
        <div class="interaction-button">
          <Link :href="`/origin/${origin.id}/edit`">
            <button class="btn btn-primary">Contribute</button>
          </Link>
          <Link :href="`/origin/${origin.id}`">
            <button class="btn btn-second">Details</button>
          </Link>
        </div>
      </div>
    </div>

    <div class="pagination">
      <button class="btn btn-second" :disabled="page <= 0" @click="goToPage(page - 1)">
        Previous
      </button>
      <span class="text-muted" style="display: flex; align-items: center;">Page {{ page + 1 }}</span>
      <button class="btn btn-second" :disabled="origins.length < 5" @click="goToPage(page + 1)">
        Next
      </button>
    </div>
  </div>
</template>
