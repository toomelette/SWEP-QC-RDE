

require('./bootstrap');
import CaneSugarTonsFormat from './components/Synopsis/OutputCategoryFormats/CaneSugarTonsFormat';
import VueToast from 'vue-toast-notification';
import VueSelect from 'vue-select';

window.Vue = require('vue');

const EventBus = new Vue();	
export default EventBus;

Vue.use(VueToast);
Vue.component('v-select', VueSelect);

Vue.component('cane-sugar-tons-output-format', CaneSugarTonsFormat.default);

Vue.component('outputs', require('./components/synopsis/Outputs.vue').default);


const app = new Vue({
    el: '#app'
});

