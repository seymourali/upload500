import './assets/main.css'

import { createApp } from 'vue'
import store from './store'
import App from './App.vue'
import router from './router'
import ToastPlugin from 'vue-toast-notification';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'vue-toast-notification/dist/theme-default.css';

const app = createApp(App)

app.use(router)
app.use(store)
app.use(ToastPlugin)

app.mount('#app')
