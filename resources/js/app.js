/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//import {Ziggy} from '../assets/js/ziggy';
import { template } from 'lodash';
import storeData from './storeData';


import VueRouter from 'vue-router';
import VueX from "vuex";
import Axios from 'axios';

window.Vue = require('vue');

Vue.use(VueX);



const store = new VueX.Store(storeData);
store.dispatch("getUser");










Vue.use(VueRouter);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar', require('./components/NavBarComponent.vue').default);







//CSSMODAL
Vue.component('vue-image-loader', require('./components/VueLoadImage.vue').default);


//ENDCSSMODAL




Vue.component('admin-nav', require('./components/admin/NavBar.vue').default);


Vue.component('push-notification', require('./components/admin/PushNotification.vue').default);





//Admin Component

const routes = [
    
    { path: '/categorias', name:'categorias', component: Vue.component('categorias', require('./components/admin/Categorias.vue').default)   },
    { path: '/grupos', name:'grupos', component: Vue.component('grupos', require('./components/admin/Grupos.vue').default)   },
    { path: '/productos', name:'productos', component: Vue.component('productos', require('./components/admin/Productos.vue').default)   },
    { path: '/listaproductos', name:'listaproductos', component: Vue.component('getProduct', require('./components/admin/getProduct.vue').default)   },
    { path: '/register', 
    name:'register',beforeEnter: (to, from, next) => {
        // ...
        axios.get("api/user").then(response => {
        if(response.data)
        {
            next({name: 'perfil'})
           
        }
    })
    .catch(error => {if(error){next()}})
      },   
      
    component: Vue.component('register', require('./components/auth/Register.vue').default )  },
    { path: '/login', 
    name:'login', beforeEnter: (to, from, next) => {
        // ...
        axios.get("api/user").then(response => {
        if(response.data)
        {
            next({name: 'perfil'})
           
        }
    })
    .catch(error => {if(error){next()}})
      },     
      component: Vue.component('login', require('./components/auth/Login.vue').default )  },
  
      { path: '/perfil',  
    name:'perfil', beforeEnter: (to, from, next) => {
        // ...
        axios.get("api/user").then(response => {
        if(response.data)
        {
            next()
           
        }
    })
    .catch(error => {if(error){next({name: 'home'})}})
      },  
    component: Vue.component('perfil', require('./components/auth/Perfil.vue').default )  },

    
    { path: '/', name:'home',  component: Vue.component('home', require('./components/Home.vue').default )  },
    { path: '/order/', name:'order',  component: Vue.component('order', require('./components/Order.vue').default )  },
    { path: '/items/:id', name:'items',  component: Vue.component('items', require('./components/Items.vue').default )  },
    
    
   
];




const router = new VueRouter({
    routes,
   
   
     
    // short for routes: routes
    
});
// GOOD
router.beforeEach((to, from, next) => {
    
    if(to.matched.some(record => record.meta.auth))
    {

    }else
    {
        next();
    }
     
  })

  

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    router,
    store,
    

   
    
    
    
    
    
});

const admin = new Vue({
    el: '#admin',
    router
    
    
    
});

