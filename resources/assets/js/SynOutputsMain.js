

require('./bootstrap');

import VueToast from 'vue-toast-notification';
import VueSelect from 'vue-select';

window.Vue = require('vue');

const EventBus = new Vue();	
export default EventBus;

// 3RD PARTY
Vue.use(VueToast);
Vue.component('v-select', VueSelect);

// CATEGORY FORMATS
Vue.component('cane-sugar-tons-output-format', require('./components/Synopsis/OutputCategoryFormats/CaneSugarTonsFormat').default);

// MAIN COMPONENT
Vue.component('outputs', require('./components/synopsis/Outputs.vue').default);


const app = new Vue({
    el: '#app'
});

