<script setup>
import { ref, computed } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { useAuth } from '../../composables/useAuth'

defineOptions({ layoutName: 'user' })

const props = defineProps({
  user: { type: Object, required: true },
  totalLikes: { type: Number, default: 0 },
})

const { user: authUser } = useAuth()

const isOwnProfile = computed(() => authUser.value?.id === props.user.id)

const form = useForm({
  pic: null,
})

const onFileChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    form.pic = file
    form.post('/profile-pic', {
      preserveScroll: true,
      onSuccess: () => {
        form.reset()
      },
    })
  }
}
</script>

<template>
  <div class="content">
    <div class="content__cover">
      <div class="content__bull">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <div class="content__avatar">
      <img :src="`/storage/profile/${user.profile_pic || 'profile.jpg'}`" alt="profile">
    </div>

    <div class="content__actions">
      <div></div>
      <div>
        <Link href="/home">
          <span>Back to Home</span>
        </Link>
      </div>
    </div>

    <div class="content__title">
      <h1>{{ user.name }}</h1>
      <span>@{{ user.username }}</span>
    </div>

    <div v-if="isOwnProfile" class="content__description" style="order: 5;">
      <label for="profile-pic-upload" style="cursor: pointer; color: var(--color-primary); font-weight: 500;">
        Change Profile Picture
      </label>
      <input
        id="profile-pic-upload"
        type="file"
        accept="image/*"
        style="display: none;"
        @change="onFileChange"
      >
    </div>

    <ul class="content__list">
      <li>
        <span>{{ user.detail?.meme_posted ?? 0 }}</span>
        Memes Posted
      </li>
      <li>
        <span>{{ user.detail?.origin_created ?? 0 }}</span>
        Origins Created
      </li>
      <li>
        <span>{{ user.detail?.origin_denied ?? 0 }}</span>
        Origins Denied
      </li>
      <li>
        <span>{{ user.detail?.origin_accepted ?? 0 }}</span>
        Origins Accepted
      </li>
      <li>
        <span>{{ user.detail?.meme_likes ?? 0 }}</span>
        Meme Likes Given
      </li>
      <li>
        <span>{{ totalLikes }}</span>
        Total Likes Received
      </li>
    </ul>
  </div>
</template>
