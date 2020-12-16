

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


Vue.component('molasses-list', require('./components/synopsis/MolassesList.vue').default);
Vue.component('molasses-create-modal', require('./components/synopsis/MolassesCreateModal.vue').default);
Vue.component('molasses-update-modal', require('./components/synopsis/MolassesUpdateModal.vue').default);
Vue.component('molasses-delete-modal', require('./components/synopsis/MolassesDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

