import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export const constantRoutes = [
  {
    path: '/404',
    redirect: { name: 'Page404' },
    component: () => import(/* webpackChunkName:"404" */'../views/ErrorPage/404'),
    hidden: true,
  },
  {
    path: '',
    name: 'Home',
    component: () => import(/* webpackChunkName:"Home" */'../views/Home/index'),
  },
  { path: '*', redirect: '/404', hidden: true },
];

const createRouter = () => new Router({
  mode: 'history',
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRoutes,
});

const router = createRouter();

export default router;
