

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


Vue.component('detail-of-stoppage-a-list', require('./components/synopsis/DetailOfStoppageAList.vue').default);
Vue.component('detail-of-stoppage-a-create-modal', require('./components/synopsis/DetailOfStoppageACreateModal.vue').default);
Vue.component('detail-of-stoppage-a-update-modal', require('./components/synopsis/DetailOfStoppageAUpdateModal.vue').default);
Vue.component('detail-of-stoppage-a-delete-modal', require('./components/synopsis/DetailOfStoppageADeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

