

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


Vue.component('milling-plant-list', require('./components/synopsis/MillingPlantList.vue').default);
Vue.component('milling-plant-create-modal', require('./components/synopsis/MillingPlantCreateModal.vue').default);
Vue.component('milling-plant-update-modal', require('./components/synopsis/MillingPlantUpdateModal.vue').default);
Vue.component('milling-plant-delete-modal', require('./components/synopsis/MillingPlantDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

