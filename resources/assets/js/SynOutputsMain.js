

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


Vue.component('cane-sugar-tons', require('./components/Synopsis/OutputCategoryFormats/CaneSugarTonsFormat').default);
Vue.component('prdn-increment', require('./components/Synopsis/OutputCategoryFormats/PRDNIncrementFormat').default);
Vue.component('ratios-on-gross-cane', require('./components/Synopsis/OutputCategoryFormats/RatiosOnGrossCaneFormat').default);
Vue.component('cane-analysis', require('./components/Synopsis/OutputCategoryFormats/CaneAnalysisFormat').default);
Vue.component('sugar-analysis', require('./components/Synopsis/OutputCategoryFormats/SugarAnalysisFormat').default);
Vue.component('first-expressed-juice', require('./components/Synopsis/OutputCategoryFormats/FirstExpressedJuiceFormat').default);
Vue.component('last-expressed-juice', require('./components/Synopsis/OutputCategoryFormats/LastExpressedJuiceFormat').default);
Vue.component('mixed-juice', require('./components/Synopsis/OutputCategoryFormats/MixedJuiceFormat').default);
Vue.component('clarification', require('./components/Synopsis/OutputCategoryFormats/ClarificationFormat').default);
Vue.component('syrup', require('./components/Synopsis/OutputCategoryFormats/SyrupFormat').default);
Vue.component('bagasse', require('./components/Synopsis/OutputCategoryFormats/BagasseFormat').default);
Vue.component('filter-cake', require('./components/Synopsis/OutputCategoryFormats/FilterCakeFormat').default);
Vue.component('molasses', require('./components/Synopsis/OutputCategoryFormats/MolassesFormat').default);
Vue.component('non-sugar', require('./components/Synopsis/OutputCategoryFormats/NonSugarFormat').default);
Vue.component('cap-utilization', require('./components/Synopsis/OutputCategoryFormats/CapUtilizationFormat').default);
Vue.component('milling-plant', require('./components/Synopsis/OutputCategoryFormats/MillingPlantFormat').default);
Vue.component('bhr', require('./components/Synopsis/OutputCategoryFormats/BHRFormat').default);
Vue.component('oar', require('./components/Synopsis/OutputCategoryFormats/OARFormat').default);
Vue.component('bh-loss', require('./components/Synopsis/OutputCategoryFormats/BHLossFormat').default);


Vue.component('outputs', require('./components/synopsis/Outputs.vue').default);


const app = new Vue({
    el: '#app'
});

