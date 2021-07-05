import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../views/Home';
import Developer from '../views/Developer';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  }, 
  {
    path: '/developers/show/:developerId',
    name: 'developer-show',
    component: Developer
  }, 
  {
    path: '/developers/new',
    name: 'developer-new',
    component: Developer
  },
  {
    path: '/developers/edit/:developerId',
    name: 'developer-edit',
    component: Developer
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
