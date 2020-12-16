

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


Vue.component('filter-cake-list', require('./components/synopsis/FilterCakeList.vue').default);
Vue.component('filter-cake-create-modal', require('./components/synopsis/FilterCakeCreateModal.vue').default);
Vue.component('filter-cake-update-modal', require('./components/synopsis/FilterCakeUpdateModal.vue').default);
Vue.component('filter-cake-delete-modal', require('./components/synopsis/FilterCakeDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

