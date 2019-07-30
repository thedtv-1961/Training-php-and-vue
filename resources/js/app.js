require('./bootstrap');
import Vue from 'vue';
import 'normalize.css/normalize.css';

import App from './views/App';
import router from './router';
import i18n from './lang';
import store from './store';

Vue.config.productionTip = false;

new Vue({
  el: '#app',
  router,
  i18n,
  store,
  components: { App },
  template: '<App/>',
});
