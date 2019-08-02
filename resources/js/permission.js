import router from '@/router';
import { getToken } from '@/utils/auth';

const whiteList = ['Login', 'SignUp'];

router.beforeEach((to, from, next) => {
  const hasToken = getToken();
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (hasToken) {
      next();
    } else {
      next(`/login?redirect=${to.fullPath}`);
    }
  } else if (to.matched.some(record => record.meta.guest)) {
    if (hasToken) {
      if (whiteList.includes(to.name)) {
        next({ path: '/' });
      } else {
        next();
      }
    } else {
      next();
    }
  }
});
