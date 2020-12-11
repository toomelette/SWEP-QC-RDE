

require('./bootstrap');


window.Vue = require('vue');
import Loading from 'vue-loading-overlay';


Vue.use(Loading);


Vue.component('login-form', require('./components/auth/LoginForm.vue').default);


const app = new Vue({
    el: '#app'
});

