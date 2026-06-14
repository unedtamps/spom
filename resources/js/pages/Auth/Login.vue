<script setup>
import { ref, computed, onMounted } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'

defineOptions({ layoutName: 'auth' })

const page = usePage()
const showRegister = ref(false)
const showNotification = ref(false)

const loginForm = useForm({
  email: '',
  password: '',
})

const registerForm = useForm({
  name: '',
  username: '',
  email: '',
  password: '',
})

const flashSuccess = computed(() => page.props.flash?.success)
const flashError = computed(() => page.props.flash?.error)

const login = () => {
  loginForm.post('/auth/login')
}

const register = () => {
  registerForm.post('/auth/register')
}

onMounted(() => {
  if (page.props.flash?.success || page.props.flash?.error) {
    showNotification.value = true
    setTimeout(() => {
      showNotification.value = false
    }, 5000)
  }
})
</script>

<template>
  <div class="auth-main">
    <div id="notification" v-if="showNotification">
      <small v-if="flashError" id="errorMessage">{{ flashError }}</small>
      <small v-else-if="flashSuccess" id="successMessage">{{ flashSuccess }}</small>
    </div>

    <input
      type="checkbox"
      id="chk"
      aria-hidden="true"
      v-model="showRegister"
    >

    <div class="signup">
      <label for="chk" aria-hidden="true">Sign up</label>
      <form @submit.prevent="register">
        <div class="input-regist">
          <input
            type="text"
            v-model="registerForm.name"
            name="name"
            placeholder="Name"
          >
          <i v-if="registerForm.errors.name" class="error-input">{{ registerForm.errors.name }}</i>
        </div>
        <div class="input-regist">
          <input
            type="text"
            v-model="registerForm.username"
            name="txt"
            placeholder="User name"
          >
          <i v-if="registerForm.errors.username" class="error-input">{{ registerForm.errors.username }}</i>
        </div>
        <div class="input-regist">
          <input
            type="email"
            v-model="registerForm.email"
            name="email"
            placeholder="Email"
          >
          <i v-if="registerForm.errors.email" class="error-input">{{ registerForm.errors.email }}</i>
        </div>
        <div class="input-regist">
          <input
            type="password"
            v-model="registerForm.password"
            name="pswd"
            placeholder="Password"
          >
          <i v-if="registerForm.errors.password" class="error-input">{{ registerForm.errors.password }}</i>
        </div>
        <button type="submit" :disabled="registerForm.processing">Sign up</button>
      </form>
      <a style="text-decoration: none" href="/about">
        <button style="background-color: rgb(22, 22, 99)">About</button>
      </a>
    </div>

    <div class="login">
      <label for="chk" aria-hidden="true">Login</label>
      <form @submit.prevent="login">
        <div class="input-regist">
          <input
            type="email"
            v-model="loginForm.email"
            placeholder="Email"
            required
          >
          <i v-if="loginForm.errors.email" class="error-input">{{ loginForm.errors.email }}</i>
        </div>
        <div class="input-regist">
          <input
            type="password"
            v-model="loginForm.password"
            placeholder="Password"
            required
          >
          <i v-if="loginForm.errors.password" class="error-input">{{ loginForm.errors.password }}</i>
        </div>
        <button type="submit" :disabled="loginForm.processing">Login</button>
      </form>
    </div>
  </div>
</template>
