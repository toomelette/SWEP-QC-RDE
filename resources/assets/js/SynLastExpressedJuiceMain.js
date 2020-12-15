

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


Vue.component('last-expressed-juice-list', require('./components/synopsis/LastExpressedJuiceList.vue').default);
Vue.component('last-expressed-juice-create-modal', require('./components/synopsis/LastExpressedJuiceCreateModal.vue').default);
Vue.component('last-expressed-juice-update-modal', require('./components/synopsis/LastExpressedJuiceUpdateModal.vue').default);
Vue.component('last-expressed-juice-delete-modal', require('./components/synopsis/LastExpressedJuiceDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

