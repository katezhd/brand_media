require('./bootstrap');

import { createApp } from 'vue';
import App from './components/App.vue'
import router from './router' 
import axios from 'axios'
import VueAxios from 'vue-axios'
import Notifications from '@kyvg/vue3-notification'

export const app = createApp(App);
app.use(router);
app.use(VueAxios, axios);
app.use(Notifications);
app.mount('#app');

const burgerWrapper = document.querySelectorAll('.burger-wrapper')[0];
const menuTrigger = document.querySelectorAll('.menu-trigger')[0];
const header = document.querySelectorAll('.header')[0];

burgerWrapper.addEventListener('click', function() {
  if(menuTrigger.checked) {
    header.classList.remove('open');
  } else {
    header.classList.add('open');
  }
});
