

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


Vue.component('oar-list', require('./components/synopsis/OARList.vue').default);
Vue.component('oar-create-modal', require('./components/synopsis/OARCreateModal.vue').default);
Vue.component('oar-update-modal', require('./components/synopsis/OARUpdateModal.vue').default);
Vue.component('oar-delete-modal', require('./components/synopsis/OARDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

