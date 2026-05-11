import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import router from './router'

const app = createApp(App)

app.config.globalProperties.$asset = (path = '') => {
  const base = import.meta.env.BASE_URL || '/'
  const cleanBase = base.endsWith('/') ? base : `${base}/`
  const cleanPath = String(path).replace(/^\//, '')
  return `${cleanBase}${cleanPath}`
}

app.component('font-awesome-icon', FontAwesomeIcon).use(router).mount('#app')
