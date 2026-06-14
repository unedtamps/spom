import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AppLayout from './layouts/AppLayout.vue'
import AuthLayout from './layouts/AuthLayout.vue'
import UserLayout from './layouts/UserLayout.vue'

const layouts = {
  app: AppLayout,
  auth: AuthLayout,
  user: UserLayout,
}

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    const page = pages[`./pages/${name}.vue`]

    if (!page) {
      throw new Error(`Page "${name}" not found.`)
    }

    page.default.layout = layouts[page.default.layoutName] ?? null

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
  progress: {
    color: '#7c3aed',
  },
})
