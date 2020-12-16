

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


Vue.component('non-sugar-list', require('./components/synopsis/NonSugarList.vue').default);
Vue.component('non-sugar-create-modal', require('./components/synopsis/NonSugarCreateModal.vue').default);
Vue.component('non-sugar-update-modal', require('./components/synopsis/NonSugarUpdateModal.vue').default);
Vue.component('non-sugar-delete-modal', require('./components/synopsis/NonSugarDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

