

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


Vue.component('cap-utilization-list', require('./components/synopsis/CapUtilizationList.vue').default);
Vue.component('cap-utilization-create-modal', require('./components/synopsis/CapUtilizationCreateModal.vue').default);
Vue.component('cap-utilization-update-modal', require('./components/synopsis/CapUtilizationUpdateModal.vue').default);
Vue.component('cap-utilization-delete-modal', require('./components/synopsis/CapUtilizationDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

