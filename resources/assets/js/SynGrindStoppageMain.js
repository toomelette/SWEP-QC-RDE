

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


Vue.component('grind-stoppage-list', require('./components/synopsis/GrindStoppageList.vue').default);
Vue.component('grind-stoppage-create-modal', require('./components/synopsis/GrindStoppageCreateModal.vue').default);
Vue.component('grind-stoppage-update-modal', require('./components/synopsis/GrindStoppageUpdateModal.vue').default);
// Vue.component('grind-stoppage-delete-modal', require('./components/synopsis/GrindStoppageDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

