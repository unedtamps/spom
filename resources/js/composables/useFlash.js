import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export function useFlash() {
  const success = computed(() => usePage().props.flash.success)
  const error = computed(() => usePage().props.flash.error)

  return { success, error }
}
