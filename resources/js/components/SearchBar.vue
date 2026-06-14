<script setup>
import { ref, watch, onMounted, onBeforeUnmount } from 'vue'
import { debounce } from 'lodash-es'

const search = ref('')
const users = ref([])
const memes = ref([])
const origins = ref([])
const isOpen = ref(false)
const loading = ref(false)
const searchInput = ref(null)
const containerRef = ref(null)

const hasResults = ref(false)

const performSearch = debounce(async (query) => {
  if (!query || query.length < 1) {
    users.value = []
    memes.value = []
    origins.value = []
    hasResults.value = false
    loading.value = false
    return
  }

  loading.value = true
  try {
    const res = await fetch(`/api/search?q=${encodeURIComponent(query)}`)
    const data = await res.json()
    users.value = data.users || []
    memes.value = data.memes || []
    origins.value = data.origins || []
    hasResults.value = !!(users.value.length || memes.value.length || origins.value.length)
  } catch {
    users.value = []
    memes.value = []
    origins.value = []
    hasResults.value = false
  } finally {
    loading.value = false
  }
}, 300)

watch(search, (val) => {
  loading.value = val.length > 0
  performSearch(val)
})

const onFocus = () => {
  if (search.value.length > 0) {
    isOpen.value = true
  }
}

const clearSearch = () => {
  search.value = ''
  users.value = []
  memes.value = []
  origins.value = []
  hasResults.value = false
  isOpen.value = false
  searchInput.value?.focus()
}

const closeDropdown = (e) => {
  if (containerRef.value && !containerRef.value.contains(e.target)) {
    isOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', closeDropdown)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', closeDropdown)
})
</script>

<template>
  <div ref="containerRef" class="search-wrapper">
    <div class="search-bar" :class="{ focused: isOpen }">
      <i class="uil uil-search search-icon"></i>
      <input
        ref="searchInput"
        v-model="search"
        type="search"
        placeholder="Search users, memes, origins..."
        @focus="onFocus"
      >
      <button v-if="search" class="search-clear" @click.prevent="clearSearch">
        <i class="uil uil-times"></i>
      </button>
    </div>

    <Transition name="dropdown">
      <div v-if="isOpen && (loading || hasResults || (search.length > 0 && !loading))" class="search-dropdown">
        <!-- Loading -->
        <div v-if="loading && !hasResults" class="search-loading">
          <div class="spinner"></div>
          <span>Searching...</span>
        </div>

        <!-- No results -->
        <div v-else-if="!loading && !hasResults && search.length > 0" class="search-empty">
          <i class="uil uil-search"></i>
          <span>No results for "{{ search }}"</span>
        </div>

        <!-- Results -->
        <template v-else>
          <!-- Users -->
          <div v-if="users.length" class="search-section">
            <div class="search-section-title">
              <i class="uil uil-user"></i> Users
            </div>
            <a
              v-for="u in users"
              :key="`u-${u.id}`"
              :href="`/user/${u.id}`"
              class="search-item"
              @click="isOpen = false"
            >
              <div class="search-item-avatar">
                <img :src="`/storage/profile/${u.profile_pic || 'profile.jpg'}`" alt="">
              </div>
              <div class="search-item-info">
                <span class="search-item-name">{{ u.name }}</span>
                <span class="search-item-meta">@{{ u.username }}</span>
              </div>
            </a>
          </div>

          <!-- Memes -->
          <div v-if="memes.length" class="search-section">
            <div class="search-section-title">
              <i class="uil uil-image"></i> Memes
            </div>
            <a
              v-for="m in memes"
              :key="`m-${m.id}`"
              :href="`/meme/${m.id}`"
              class="search-item"
              @click="isOpen = false"
            >
              <div class="search-item-avatar">
                <img :src="`/storage/meme/${m.pics}`" alt="">
              </div>
              <div class="search-item-info">
                <span class="search-item-name">{{ m.title }}</span>
              </div>
            </a>
          </div>

          <!-- Origins -->
          <div v-if="origins.length" class="search-section">
            <div class="search-section-title">
              <i class="uil uil-book-alt"></i> Origins
            </div>
            <a
              v-for="o in origins"
              :key="`o-${o.id}`"
              :href="`/origin/${o.id}`"
              class="search-item"
              @click="isOpen = false"
            >
              <div class="search-item-avatar search-item-avatar--text">
                {{ o.name.charAt(0).toUpperCase() }}
              </div>
              <div class="search-item-info">
                <span class="search-item-name">{{ o.name }}</span>
              </div>
            </a>
          </div>
        </template>
      </div>
    </Transition>
  </div>
</template>

<style scoped>
.search-wrapper {
  position: relative;
  flex: 1;
  max-width: 400px;
}

.search-bar {
  display: flex;
  align-items: center;
  background: var(--color-light);
  border-radius: var(--border-radius);
  padding: 0.5rem 1rem;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.search-bar.focused {
  border-color: var(--color-primary);
  background: var(--color-white);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.search-icon {
  color: var(--color-gray);
  font-size: 1.1rem;
  flex-shrink: 0;
}

.search-bar input {
  flex: 1;
  background: transparent;
  border: none;
  outline: none;
  margin-left: 0.75rem;
  font-size: 0.9rem;
  color: var(--color-dark);
  font-family: 'Poppins', sans-serif;
}

.search-bar input::placeholder {
  color: var(--color-gray);
}

.search-clear {
  background: none;
  border: none;
  cursor: pointer;
  color: var(--color-gray);
  padding: 0.2rem;
  display: flex;
  align-items: center;
  border-radius: 50%;
  transition: all 0.2s;
}

.search-clear:hover {
  background: var(--color-gray);
  color: var(--color-white);
}

/* Dropdown */
.search-dropdown {
  position: absolute;
  top: calc(100% + 8px);
  left: 0;
  right: 0;
  background: var(--color-white);
  border-radius: 1rem;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
  border: 1px solid var(--color-light);
  max-height: 400px;
  overflow-y: auto;
  z-index: 100;
  padding: 0.5rem;
}

/* Sections */
.search-section {
  padding: 0.25rem 0;
}

.search-section + .search-section {
  border-top: 1px solid var(--color-light);
  margin-top: 0.25rem;
  padding-top: 0.5rem;
}

.search-section-title {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.4rem 0.75rem;
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: var(--color-gray);
}

/* Items */
.search-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.6rem 0.75rem;
  border-radius: 0.75rem;
  text-decoration: none;
  color: var(--color-dark);
  transition: background 0.15s ease;
}

.search-item:hover {
  background: var(--color-light);
}

.search-item-avatar {
  width: 2.2rem;
  height: 2.2rem;
  border-radius: 50%;
  overflow: hidden;
  flex-shrink: 0;
}

.search-item-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.search-item-avatar--text {
  background: linear-gradient(135deg, #5FBDFF, #7c3aed);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  font-size: 0.9rem;
}

.search-item-info {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.search-item-name {
  font-size: 0.85rem;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.search-item-meta {
  font-size: 0.75rem;
  color: var(--color-gray);
}

/* Loading & Empty */
.search-loading,
.search-empty {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 1.5rem;
  color: var(--color-gray);
  font-size: 0.85rem;
}

.spinner {
  width: 1rem;
  height: 1rem;
  border: 2px solid var(--color-light);
  border-top-color: var(--color-primary);
  border-radius: 50%;
  animation: spin 0.6s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Transition */
.dropdown-enter-active,
.dropdown-leave-active {
  transition: all 0.2s ease;
}

.dropdown-enter-from,
.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
