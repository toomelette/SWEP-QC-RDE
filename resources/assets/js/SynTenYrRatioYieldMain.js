

require('./bootstrap');


import Numberformat from './components/Numberformat';
import VueSelect from 'vue-select';
import VueToast from 'vue-toast-notification';
import Loading from 'vue-loading-overlay';


window.Vue = require('vue');
const EventBus = new Vue();	
export default EventBus;


Vue.use(VueToast);
Vue.use(Loading);
Vue.component('v-select', VueSelect);
Vue.component('number-format', Numberformat.default);


Vue.component('ten-yr-ratio-yield-list', require('./components/synopsis/TenYrRatioYieldList.vue').default);
Vue.component('ten-yr-ratio-yield-create-modal', require('./components/synopsis/TenYrRatioYieldCreateModal.vue').default);
Vue.component('ten-yr-ratio-yield-update-modal', require('./components/synopsis/TenYrRatioYieldUpdateModal.vue').default);
Vue.component('ten-yr-ratio-yield-delete-modal', require('./components/synopsis/TenYrRatioYieldDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

