
require('./bootstrap');
import Numberformat from './components/Numberformat';
import VueSelect from 'vue-select';
import VueToast from 'vue-toast-notification';


window.Vue = require('vue');

const EventBus = new Vue();	
export default EventBus;


Vue.use(VueToast);
Vue.component('v-select', VueSelect);
Vue.component('number-format', Numberformat.default);


Vue.component('prdn-increment-list', require('./components/synopsis/PRDNIncrementList.vue').default);
Vue.component('prdn-increment-create-modal', require('./components/synopsis/PRDNIncrementCreateModal.vue').default);
Vue.component('prdn-increment-update-modal', require('./components/synopsis/PRDNIncrementUpdateModal.vue').default);
Vue.component('prdn-increment-delete-modal', require('./components/synopsis/PRDNIncrementDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

