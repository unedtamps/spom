<script setup>
import { computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import { useAuth } from '../../composables/useAuth'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  meme: { type: Object, required: true },
})

const { user } = useAuth()

const isLiked = computed(() => {
  return props.meme.likesby?.some(l => l.user_id === user.value?.id) ?? false
})

const isOwner = computed(() => user.value?.id === props.meme.user_id)

const toggleLike = () => {
  router.post(`/meme/${props.meme.id}/like`, {}, { preserveScroll: true })
}
</script>

<template>
  <div class="feeds">
    <Link href="/home">
      <button class="btn btn-second" style="margin-bottom: 1rem;">Back</button>
    </Link>

    <div class="feed">
      <div class="head">
        <a :href="`/user/${meme.user_id}`">
          <div class="user">
            <div class="profile-photo">
              <img :src="`/storage/profile/${meme.user?.profile_pic || 'profile.jpg'}`" alt="">
            </div>
            <div class="info">
              <h3>{{ meme.user?.name }}</h3>
              <small>{{ new Date(meme.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric', hour: 'numeric', minute: '2-digit' }) }}</small>
            </div>
          </div>
        </a>
      </div>

      <div style="margin-top: 1rem;">
        <h1>{{ meme.title }}</h1>
      </div>

      <div class="photo">
        <img :src="`/storage/meme/${meme.pics}`" alt="">
      </div>

      <div class="action-buttons">
        <div class="interaction-button">
          <button class="btn btn-success" @click="toggleLike">
            {{ isLiked ? 'Liked' : 'Like' }}
          </button>
          <template v-if="isOwner">
            <button class="btn btn-logout" @click="router.delete(`/meme/${meme.id}`)">
              Delete
            </button>
            <Link :href="`/meme/${meme.id}/edit`">
              <button class="btn btn-second">Edit</button>
            </Link>
          </template>
        </div>
      </div>

      <div class="liked-by">
        <template v-for="(like, idx) in meme.likesby?.slice(0, 4)" :key="like.id">
          <span><img :src="`/storage/profile/${like.user?.profile_pic || 'profile.jpg'}`" alt=""></span>
        </template>
        <p>
          Liked by <b>{{ meme.likesby?.length ? meme.likesby[0].user?.name : 'nobody' }}</b>
          <template v-if="meme.likesby?.length > 1">
            and <b>{{ meme.likesby.length - 1 }} others</b>
          </template>
        </p>
      </div>
    </div>
  </div>
</template>
