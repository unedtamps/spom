import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export function useAuth() {
  const user = computed(() => usePage().props.auth.user)
  const isAdmin = computed(() => user.value?.role?.toLowerCase() === 'admin')

  return { user, isAdmin }
}
