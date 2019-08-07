import isEmpty from 'lodash/isEmpty';
import router from '@/router';
import { getToken } from '@/utils/auth';
import store from '@/store';

const whiteList = ['Login', 'SignUp'];

router.beforeEach(async (to, from, next) => {
  const hasToken = getToken();
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (hasToken) {
      const { user } = store.getters;
      if (isEmpty(user)) {
        try {
          await store.dispatch('user/getInfo');
          next();
        } catch (error) {
          await store.dispatch('user/resetToken');
          next(`/login?redirect=${to.fullPath}`);
        }
      } else {
        next();
      }
    } else {
      next(`/login?redirect=${to.fullPath}`);
    }
  } else if (to.matched.some(record => record.meta.guest)) {
    if (hasToken) {
      if (whiteList.includes(to.name)) {
        next({ path: '/app' });
      } else {
        next();
      }
    } else {
      next();
    }
  }
});
