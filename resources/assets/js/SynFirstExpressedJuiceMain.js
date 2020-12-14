

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


Vue.component('first-expressed-juice-list', require('./components/synopsis/FirstExpressedJuiceList.vue').default);
Vue.component('first-expressed-juice-create-modal', require('./components/synopsis/FirstExpressedJuiceCreateModal.vue').default);
Vue.component('first-expressed-juice-update-modal', require('./components/synopsis/FirstExpressedJuiceUpdateModal.vue').default);
Vue.component('first-expressed-juice-delete-modal', require('./components/synopsis/FirstExpressedJuiceDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

