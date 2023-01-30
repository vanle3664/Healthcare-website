import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import pinia from './store/index'

createApp(App).use(router, VueAxios, axios, pinia).mount('#app')
