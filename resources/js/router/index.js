import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export const constantRoutes = [
  {
    path: '/404',
    name: 'Page404',
    component: () => import(/* webpackChunkName:"404" */'@/views/ErrorPage/404'),
    hidden: true,
    meta: {
      guest: true,
    },
  },
  {
    path: '/',
    name: 'Home',
    redirect: '/login',
    component: () => import(/* webpackChunkName:"Home" */'@/views/Home/index'),
    meta: {
      guest: true,
    },
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName:"Login" */'@/views/Login/index'),
    meta: {
      guest: true,
    },
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: () => import(/* webpackChunkName:"SignUp" */'@/views/SignUp/index'),
    meta: {
      guest: true,
    },
  },
  {
    path: '/app',
    name: 'UserApp',
    hidden: false,
    alwaysShow: true,
    redirect: '/app/announcements',
    component: () => import(/* webpackChunkName:"LayoutUser" */'@/components/layouts/LayoutUser'),
    meta: {
      requiresAuth: true,
    },
    children: [
      {
        path: 'profile',
        name: 'Profile',
        component: () => import(/* webpackChunkName:"Profile" */'@/views/Profile/index'),
        meta: {
          requiresAuth: true,
        },
      },
      {
        path: 'announcements',
        name: 'Announcements',
        component: () => import(/* webpackChunkName:"Profile" */'@/views/Announcements/index'),
        meta: {
          requiresAuth: true,
        },
      },
    ],
  },
  { path: '*', redirect: '/404', hidden: true },
];

const createRouter = () => new Router({
  mode: 'history',
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRoutes,
  linkActiveClass: 'active',
});

const router = createRouter();

export default router;
