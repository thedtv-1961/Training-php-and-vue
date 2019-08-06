import Vue from 'vue';
import 'normalize.css/normalize.css';
import Toasted from 'vue-toasted';

import App from '@/views/App.vue';
import router from '@/router';
import i18n from '@/lang';
import store from '@/store';
import '@/permission';

require('./bootstrap');

Vue.use(Toasted, {
  theme: 'bubble',
  position: 'top-right',
  duration: 5000,
});
Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  i18n,
  store,
  components: { App },
  template: '<App/>',
});
