

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


Vue.component('kg-sugar-due-clean-cane-list', require('./components/synopsis/KgSugarDueCleanCaneList.vue').default);
Vue.component('kg-sugar-due-clean-cane-create-modal', require('./components/synopsis/KgSugarDueCleanCaneCreateModal.vue').default);
Vue.component('kg-sugar-due-clean-cane-update-modal', require('./components/synopsis/KgSugarDueCleanCaneUpdateModal.vue').default);
Vue.component('kg-sugar-due-clean-cane-delete-modal', require('./components/synopsis/KgSugarDueCleanCaneDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

