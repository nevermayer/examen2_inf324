import { createApp } from 'vue'
import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"
import './bootstrap'
import axios from 'axios'
import router from './router/router'
import store from './store'

import App from './layouts/app.vue'
const app =createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router)
app.use(Toast, {
    position: "top-center",
    timeout: 3980,
    closeOnClick: true,
    pauseOnFocusLoss: false,
    pauseOnHover: false,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: "button",
    icon: true,
    rtl: false
  })
app.use(store)
app.mount('#app')



