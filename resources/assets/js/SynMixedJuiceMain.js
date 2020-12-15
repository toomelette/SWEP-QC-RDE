

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


Vue.component('mixed-juice-list', require('./components/synopsis/MixedJuiceList.vue').default);
Vue.component('mixed-juice-create-modal', require('./components/synopsis/MixedJuiceCreateModal.vue').default);
Vue.component('mixed-juice-update-modal', require('./components/synopsis/MixedJuiceUpdateModal.vue').default);
Vue.component('mixed-juice-delete-modal', require('./components/synopsis/MixedJuiceDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

