

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


Vue.component('bhr-list', require('./components/synopsis/BHRList.vue').default);
Vue.component('bhr-create-modal', require('./components/synopsis/BHRCreateModal.vue').default);
Vue.component('bhr-update-modal', require('./components/synopsis/BHRUpdateModal.vue').default);
Vue.component('bhr-delete-modal', require('./components/synopsis/BHRDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

