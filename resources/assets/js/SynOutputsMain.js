

require('./bootstrap');


import VueToast from 'vue-toast-notification';
import VueSelect from 'vue-select';
import Loading from 'vue-loading-overlay';


window.Vue = require('vue');
const EventBus = new Vue();	
export default EventBus;


Vue.use(VueToast);
Vue.use(Loading);
Vue.component('v-select', VueSelect);


Vue.component('cane-sugar-tons-format', require('./components/Synopsis/OutputCategoryFormats/CaneSugarTonsFormat').default);
Vue.component('prdn-increment-format', require('./components/Synopsis/OutputCategoryFormats/PRDNIncrementFormat').default);
Vue.component('ratios-on-gross-cane-format', require('./components/Synopsis/OutputCategoryFormats/RatiosOnGrossCaneFormat').default);


Vue.component('outputs', require('./components/synopsis/Outputs.vue').default);


const app = new Vue({
    el: '#app'
});

