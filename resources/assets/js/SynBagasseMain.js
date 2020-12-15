

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


Vue.component('bagasse-list', require('./components/synopsis/BagasseList.vue').default);
Vue.component('bagasse-create-modal', require('./components/synopsis/BagasseCreateModal.vue').default);
Vue.component('bagasse-update-modal', require('./components/synopsis/BagasseUpdateModal.vue').default);
Vue.component('bagasse-delete-modal', require('./components/synopsis/BagasseDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

