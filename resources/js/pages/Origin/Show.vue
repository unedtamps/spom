<script setup>
import { Link } from '@inertiajs/vue3'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  origin: { type: Object, required: true },
})
</script>

<template>
  <div class="feeds">
    <div class="feed">
      <div class="head">
        <div>
          <h1>{{ origin.name }}</h1>
          <small class="text-muted">
            {{ new Date(origin.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric', hour: 'numeric', minute: '2-digit' }) }}
          </small>
        </div>
      </div>

      <div class="markdown-content" style="margin-top: 1rem;" v-html="origin.content_html"></div>

      <div v-if="origin.contributors && origin.contributors.length" style="margin-top: 1rem;">
        <h3 style="margin-bottom: 0.5rem;">Contributors</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
          <Link
            v-for="contributor in origin.contributors"
            :key="contributor.id"
            :href="`/user/${contributor.user_id}`"
            style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none;"
          >
            <div style="width: 2rem; height: 2rem; border-radius: 50%; overflow: hidden; flex-shrink: 0;">
              <img :src="`/storage/profile/${contributor.user?.profile_pic || 'profile.jpg'}`" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div>
              <small class="text-bold">{{ contributor.user?.name }}</small>
            </div>
          </Link>
        </div>
      </div>

      <div class="action-buttons" style="margin-top: 1rem;">
        <div class="interaction-button">
          <Link :href="`/origin/${origin.id}/edit`">
            <button class="btn btn-primary">Contribute</button>
          </Link>
          <Link href="/origin">
            <button class="btn btn-second">Back</button>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
