

require('./bootstrap');


import Numberformat from './components/Numberformat';
import VueSelect from 'vue-select';
import VueToast from 'vue-toast-notification';
import Loading from 'vue-loading-overlay';
import VueFlatPickr from 'vue-flatpickr-component';


window.Vue = require('vue');
const EventBus = new Vue();	
export default EventBus;


Vue.use(VueToast);
Vue.use(Loading);
Vue.use(VueFlatPickr);
Vue.component('v-select', VueSelect);
Vue.component('number-format', Numberformat.default);


Vue.component('milling-duration-list', require('./components/synopsis/MillingDurationList.vue').default);
Vue.component('milling-duration-create-modal', require('./components/synopsis/MillingDurationCreateModal.vue').default);
Vue.component('milling-duration-update-modal', require('./components/synopsis/MillingDurationUpdateModal.vue').default);
Vue.component('milling-duration-delete-modal', require('./components/synopsis/MillingDurationDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

