

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


Vue.component('detail-of-stoppage-b-list', require('./components/synopsis/DetailOfStoppageBList.vue').default);
Vue.component('detail-of-stoppage-b-create-modal', require('./components/synopsis/DetailOfStoppageBCreateModal.vue').default);
Vue.component('detail-of-stoppage-b-update-modal', require('./components/synopsis/DetailOfStoppageBUpdateModal.vue').default);
Vue.component('detail-of-stoppage-b-delete-modal', require('./components/synopsis/DetailOfStoppageBDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

