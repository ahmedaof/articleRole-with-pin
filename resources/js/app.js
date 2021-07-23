/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueMaterial)

 // Router Imported
 import {routes} from './routes';

import User from './Helpers/User';

import Swal from 'sweetalert2';
window.Swal=Swal;


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  window.Toast = Toast;

window.User = User;
const router = new VueRouter({
    routes,
    mode: 'history' 
  })
  
  const app = new Vue({
      el: '#app',
      router
  });
