

require('./bootstrap');


import VueSelect from 'vue-select';
import Numberformat from './components/Numberformat';
import VueToast from 'vue-toast-notification';
import Loading from 'vue-loading-overlay';


window.Vue = require('vue');
const EventBus = new Vue();	
export default EventBus;


Vue.use(VueToast);
Vue.use(Loading);
Vue.component('v-select', VueSelect);
Vue.component('number-format', Numberformat.default);


Vue.component('ratios-on-gross-cane-list', require('./components/synopsis/RatiosOnGrossCaneList.vue').default);
Vue.component('ratios-on-gross-cane-create-modal', require('./components/synopsis/RatiosOnGrossCaneCreateModal.vue').default);
Vue.component('ratios-on-gross-cane-update-modal', require('./components/synopsis/RatiosOnGrossCaneUpdateModal.vue').default);
Vue.component('ratios-on-gross-cane-delete-modal', require('./components/synopsis/RatiosOnGrossCaneDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

