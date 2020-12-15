

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
Vue.component('cane-analysis', require('./components/Synopsis/OutputCategoryFormats/CaneAnalysisFormat').default);
Vue.component('sugar-analysis', require('./components/Synopsis/OutputCategoryFormats/SugarAnalysisFormat').default);
Vue.component('first-expressed-juice', require('./components/Synopsis/OutputCategoryFormats/FirstExpressedJuiceFormat').default);
Vue.component('last-expressed-juice', require('./components/Synopsis/OutputCategoryFormats/LastExpressedJuiceFormat').default);
Vue.component('mixed-juice', require('./components/Synopsis/OutputCategoryFormats/MixedJuiceFormat').default);
Vue.component('clarification', require('./components/Synopsis/OutputCategoryFormats/ClarificationFormat').default);
Vue.component('syrup', require('./components/Synopsis/OutputCategoryFormats/SyrupFormat').default);


Vue.component('outputs', require('./components/synopsis/Outputs.vue').default);


const app = new Vue({
    el: '#app'
});

