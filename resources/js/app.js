/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { extend } from 'vee-validate';
import { required,email,confirmed,image,max,min } from 'vee-validate/dist/rules';

// Add the required rule
extend('required', {
  ...required,
  message: 'هذا الحقل لا يمكن ان يكون فارغا'
});
extend('email', {
  ...email,
  message: 'الرجاء ادخال ايميل صحيح'
});
extend('confirmed', {
  ...confirmed,
  message: 'القيمة المدخلة غير مطابقة'
});
extend('image', {
  ...image,
  message: 'هذا الحقل يجب ان يحتوي على صور فقط'
});
extend('max', {
  ...max,
  message: 'لقد تخطيت الحد المسموح به من الحروف'
});
extend('min', {
  ...min,
  message: 'لقد ادحلت اقل من الحد المسموح به '
});

import { ValidationProvider } from 'vee-validate';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('ValidationProvider', ValidationProvider);

Vue.component('chat-app', require('./components/messenger/ChatApp.vue').default);
Vue.component('notification-app',require('./components/site/notificationComponent.vue').default);
Vue.component('login-app', require('./components/loginComponent.vue').default);
Vue.component('register-app', require('./components/registerComponent.vue').default);

Vue.component('filter-app', require('./components/filter/filterComponent.vue').default);
Vue.component('agars-app', require('./components/filter/agarsComponent.vue').default);
Vue.component('formfilter-app', require('./components/filter/formComponent.vue').default);

Vue.component('reservation-app', require('./components/reservations/sentReservationComponent.vue').default);

Vue.component('addagar-app', require('./components/agar/addAgarComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const login = new Vue({
    el: '#login',
});

const register = new Vue({
    el: '#register',
});

const filter = new Vue({
    el: '#filter'
});
const agars = new Vue({
    el: '#agars'
});
const formfilter = new Vue({
    el: '#formfilter'
});




const contact = new Vue({
    el: '#contact'
});

const notification = new Vue({
    el: '#notification'
});

const reservation = new Vue({
    el: '#reservation'
});

const add_agar = new Vue({
    el: '#add_agar'
});
