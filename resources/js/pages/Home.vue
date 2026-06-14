<script setup>
import { Link } from '@inertiajs/vue3'
import MemeCard from '../components/MemeCard.vue'
import CreateMemeForm from '../components/CreateMemeForm.vue'

defineOptions({ layoutName: 'app' })

const props = defineProps({
  memes: { type: Array, required: true },
  trending: { type: Array, default: () => [] },
  page: { type: Number, default: 0 },
})
</script>

<template>
  <div class="feeds">
    <CreateMemeForm />

    <div v-if="memes.length === 0" class="feed">
      <p>No memes to show.</p>
    </div>

    <MemeCard v-for="meme in memes" :key="meme.id" :meme="meme" />

    <div class="pagination">
      <Link v-if="page !== 0" :href="`/home?page=${page - 1}`">
        <button class="btn btn-second">Previous</button>
      </Link>
      <Link v-if="memes.length === 5" :href="`/home?page=${page + 1}`">
        <button class="btn btn-primary">Next</button>
      </Link>
    </div>
  </div>
</template>
