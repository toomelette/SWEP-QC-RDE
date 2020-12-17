

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


Vue.component('bh-loss-list', require('./components/synopsis/BHLossList.vue').default);
Vue.component('bh-loss-create-modal', require('./components/synopsis/BHLossCreateModal.vue').default);
Vue.component('bh-loss-update-modal', require('./components/synopsis/BHLossUpdateModal.vue').default);
Vue.component('bh-loss-delete-modal', require('./components/synopsis/BHLossDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

