
require('./bootstrap');

import VueSelect from 'vue-select';
import Numberformat from './components/Numberformat';


window.Vue = require('vue');


const EventBus = new Vue();	
export default EventBus;


Vue.component('v-select', VueSelect);
Vue.component('number-format', Numberformat.default);


Vue.component('synopsis-cane-sugar-tons-list', require('./components/synopsis/CaneSugarTonsList.vue').default);
Vue.component('synopsis-cane-sugar-tons-create', require('./components/synopsis/CaneSugarTonsCreate.vue').default);


const app = new Vue({
    el: '#app'
});

