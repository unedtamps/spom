<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  memes: { type: Object, default: () => ({ memes: [] }) },
})

const blurredImages = ref({})

const toggleBlur = (id) => {
  blurredImages.value[id] = !blurredImages.value[id]
}

const refresh = () => {
  router.get('/explore', {}, { preserveScroll: true })
}
</script>

<template>
  <div class="feeds">
    <div v-for="meme in memes.memes" :key="meme.postLink" class="feed">
      <div class="head">
        <div class="user">
          <div class="info">
            <h2>{{ meme.author }}</h2>
            <i>{{ meme.subreddit }}</i>
            <p>{{ meme.ups }} upvoted on reddit</p>
          </div>
        </div>
      </div>
      <div style="margin-top: 1rem;" class="meme-head">
        <h1>{{ meme.title }}</h1>
      </div>
      <div class="photo">
        <img
          :src="meme.url"
          :alt="meme.title"
          :style="{ filter: meme.nsfw && !blurredImages[meme.postLink] ? 'blur(20px)' : 'none', width: '100%' }"
        >
      </div>
      <button
        v-if="meme.nsfw"
        class="btn btn-logout"
        @click="toggleBlur(meme.postLink)"
      >
        {{ blurredImages[meme.postLink] ? 'Hide' : "I'm 18+" }}
      </button>
      <a :href="meme.postLink" target="_blank">
        <button class="btn btn-second">Source</button>
      </a>
    </div>
    <div style="margin: 1rem; display: flex; justify-content: center; align-items: center">
      <button class="btn btn-success" @click="refresh">Refresh</button>
    </div>
  </div>
</template>
