

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


Vue.component('potential-revenue-list', require('./components/synopsis/PotentialRevenueList.vue').default);
Vue.component('potential-revenue-create-modal', require('./components/synopsis/PotentialRevenueCreateModal.vue').default);
Vue.component('potential-revenue-update-modal', require('./components/synopsis/PotentialRevenueUpdateModal.vue').default);
Vue.component('potential-revenue-delete-modal', require('./components/synopsis/PotentialRevenueDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

