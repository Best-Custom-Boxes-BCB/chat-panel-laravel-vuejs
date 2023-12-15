import './bootstrap';
import { createApp } from 'vue';
import router from './components/routes'
import App from './components/App.vue'

createApp(App).use(router).mount('#app')
