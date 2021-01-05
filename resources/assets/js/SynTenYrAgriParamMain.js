

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


Vue.component('ten-yr-agri-param-list', require('./components/synopsis/TenYrAgriParamList.vue').default);
Vue.component('ten-yr-agri-param-create-modal', require('./components/synopsis/TenYrAgriParamCreateModal.vue').default);
Vue.component('ten-yr-agri-param-update-modal', require('./components/synopsis/TenYrAgriParamUpdateModal.vue').default);
Vue.component('ten-yr-agri-param-delete-modal', require('./components/synopsis/TenYrAgriParamDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

