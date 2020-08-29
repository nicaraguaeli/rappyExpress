/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//import {Ziggy} from '../assets/js/ziggy';
import { template } from 'lodash';
window.Vue = require('vue');





import VueRouter from 'vue-router';



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
Vue.component('cart', require('./components/CarComponent.vue').default);
Vue.component('listproduct-component', require('./components/ListProductComponent.vue').default);
Vue.component('getproduct', require('./components/ProductoComponent.vue').default);
Vue.component('vue-image-loader', require('./components/VueLoadImage.vue').default);






Vue.component('admin-nav', require('./components/admin/NavBar.vue').default);


Vue.component('push-notification', require('./components/admin/PushNotification.vue').default);






//Admin Component

const routes = [
    
    { path: '/categorias', name:'categorias', component: Vue.component('categorias', require('./components/admin/Categorias.vue').default)   },
    { path: '/grupos', name:'grupos', component: Vue.component('grupos', require('./components/admin/Grupos.vue').default)   },
    { path: '/productos', name:'productos', component: Vue.component('productos', require('./components/admin/Productos.vue').default)   },
    { path: '/listaproductos', name:'listaproductos', component: Vue.component('getProduct', require('./components/admin/getProduct.vue').default)   },
    { path: '/register', name:'register',  component: Vue.component('register', require('./components/auth/Register.vue').default )  },
    { path: '/login', name:'login',  component: Vue.component('register', require('./components/auth/Login.vue').default )  },
    
   
];


const router = new VueRouter({
    routes, // short for routes: routes
    
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    router,
    
    
    
    
});

const admin = new Vue({
    el: '#admin',
    router
    
    
    
});

