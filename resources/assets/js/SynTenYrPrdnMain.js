

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


Vue.component('ten-yr-prdn-list', require('./components/synopsis/TenYrPrdnList.vue').default);
Vue.component('ten-yr-prdn-create-modal', require('./components/synopsis/TenYrPrdnCreateModal.vue').default);
Vue.component('ten-yr-prdn-update-modal', require('./components/synopsis/TenYrPrdnUpdateModal.vue').default);
Vue.component('ten-yr-prdn-delete-modal', require('./components/synopsis/TenYrPrdnDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

