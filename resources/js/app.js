import Vue from 'vue';
import 'normalize.css/normalize.css';

import App from '@/views/App.vue';
import router from '@/router';
import i18n from '@/lang';
import store from '@/store';

require('./bootstrap');

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
