import router from '@/router';
import { getToken } from '@/utils/auth';

router.beforeEach((to, from, next) => {
  const hasToken = getToken();
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (hasToken) {
      next();
    } else {
      next(`/login?redirect=${to.path}`);
    }
  } else if (to.matched.some(record => record.meta.guest)) {
    if (hasToken) {
      if (to.path === '/login') {
        next({ path: '/' });
      } else {
        next();
      }
    } else {
      next();
    }
  }
});
