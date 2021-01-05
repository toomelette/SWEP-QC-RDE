

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


Vue.component('ten-yr-factory-performance-list', require('./components/synopsis/TenYrFactoryPerformanceList.vue').default);
Vue.component('ten-yr-factory-performance-create-modal', require('./components/synopsis/TenYrFactoryPerformanceCreateModal.vue').default);
Vue.component('ten-yr-factory-performance-update-modal', require('./components/synopsis/TenYrFactoryPerformanceUpdateModal.vue').default);
Vue.component('ten-yr-factory-performance-delete-modal', require('./components/synopsis/TenYrFactoryPerformanceDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

