
require('./bootstrap');

window.Vue = require('vue');

Vue.component('synopsis-cane-sugar-tons', require('./components/synopsis/CaneSugarTons.vue').default);

const app = new Vue({
    el: '#app'
});

