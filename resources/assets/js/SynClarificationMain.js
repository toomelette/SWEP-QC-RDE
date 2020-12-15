

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


Vue.component('clarification-list', require('./components/synopsis/ClarificationList.vue').default);
Vue.component('clarification-create-modal', require('./components/synopsis/ClarificationCreateModal.vue').default);
Vue.component('clarification-update-modal', require('./components/synopsis/ClarificationUpdateModal.vue').default);
Vue.component('clarification-delete-modal', require('./components/synopsis/ClarificationDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

