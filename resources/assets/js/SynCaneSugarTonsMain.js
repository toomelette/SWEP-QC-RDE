

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


Vue.component('cane-sugar-tons-list', require('./components/synopsis/CaneSugarTonsList.vue').default);
Vue.component('cane-sugar-tons-create-modal', require('./components/synopsis/CaneSugarTonsCreateModal.vue').default);
Vue.component('cane-sugar-tons-update-modal', require('./components/synopsis/CaneSugarTonsUpdateModal.vue').default);
Vue.component('cane-sugar-tons-delete-modal', require('./components/synopsis/CaneSugarTonsDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

