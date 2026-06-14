<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import NavBar from '../components/NavBar.vue'
import SearchBar from '../components/SearchBar.vue'

const user = computed(() => usePage().props.auth.user)
</script>

<template>
  <nav>
    <div class="container">
      <h2 class="log">SPOM</h2>
      <SearchBar />
      <div class="create">
        <div class="profile-photo">
          <a :href="`/user/${user?.id}`">
            <img :src="`/storage/profile/${user?.profile_pic || 'profile.jpg'}`" alt="">
          </a>
        </div>
      </div>
    </div>
  </nav>
  <main>
    <div class="container">
      <NavBar />
      <div class="middle">
        <slot />
      </div>
    </div>
  </main>
</template>
