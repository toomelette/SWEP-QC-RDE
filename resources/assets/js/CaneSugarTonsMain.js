
require('./bootstrap');

import Select2 from 'v-select2-component';

window.Vue = require('vue');

const EventBus = new Vue();	
export default EventBus;

Vue.component('Select2', Select2);

Vue.component('synopsis-cane-sugar-tons-list', require('./components/synopsis/CaneSugarTonsList.vue').default);
Vue.component('synopsis-cane-sugar-tons-create', require('./components/synopsis/CaneSugarTonsCreate.vue').default);

const app = new Vue({
    el: '#app'
});

