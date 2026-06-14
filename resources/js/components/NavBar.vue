<script setup>
import { computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import { useAuth } from '../composables/useAuth'

const { user, isAdmin } = useAuth()

const logout = () => {
  if (confirm('Are you sure to logout?')) {
    router.post('/logout')
  }
}
</script>

<template>
  <div class="left">
    <Link :href="`/user/${user?.id}`" class="profile">
      <div class="profile-photo">
        <img :src="`/storage/profile/${user?.profile_pic || 'profile.jpg'}`" alt="">
      </div>
      <div class="handle">
        <h4>{{ user?.name }}</h4>
        <p class="text-muted">@{{ user?.username }}</p>
      </div>
    </Link>

    <div class="sidebar" id="mysidebar">
      <Link class="menu-item" href="/home" :class="{ active: $page.url === '/home' }">
        <span><i class="uil uil-home menus"></i></span>
        <h3>Home</h3>
      </Link>
      <Link class="menu-item" href="/origin" :class="{ active: /^\/origin(\/\d+)?$/.test($page.url) }">
        <span><i class="uil uil-book-alt menus"></i></span>
        <h3>Origin</h3>
      </Link>
      <Link class="menu-item" href="/explore" :class="{ active: $page.url === '/explore' }">
        <span><i class="uil uil-compass menus"></i></span>
        <h3>Explore</h3>
      </Link>
      <Link v-if="isAdmin" class="menu-item" href="/origin-sub" :class="{ active: $page.url.startsWith('/origin-sub') }">
        <span><i class="uil uil-envelope-download menus"></i></span>
        <h3>Submission</h3>
      </Link>
      <Link class="menu-item" :href="`/origin/create`" :class="{ active: $page.url === '/origin/create' }">
        <span><i class="uil uil-book-medical menus"></i></span>
        <h3>Add Origin</h3>
      </Link>
      <Link class="menu-item" href="/about" :class="{ active: $page.url === '/about' }">
        <span><i class="uil uil-books menus"></i></span>
        <h3>About</h3>
      </Link>

      <div class="menu-item" @click="logout" style="cursor: pointer">
        <span><i class="uil uil-signout"></i></span>
        <h3>Logout</h3>
      </div>
    </div>

    <div id="show-nav">
      <button class="togglebtn" @click="toggleNav">
        <span><i style="color: white;" class="uil uil-ellipsis-h"></i></span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    toggleNav() {
      const sidebar = document.getElementById('mysidebar')
      const isOpen = sidebar.style.width === '250px'
      sidebar.style.width = isOpen ? '0' : '250px'
      document.querySelectorAll('.menus').forEach(el => {
        el.style.marginLeft = isOpen ? '4rem' : '0rem'
      })
    },
  },
}
</script>
