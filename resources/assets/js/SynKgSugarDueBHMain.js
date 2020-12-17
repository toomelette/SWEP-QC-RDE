

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


Vue.component('kg-sugar-due-bh-list', require('./components/synopsis/KgSugarDueBHList.vue').default);
Vue.component('kg-sugar-due-bh-create-modal', require('./components/synopsis/KgSugarDueBHCreateModal.vue').default);
Vue.component('kg-sugar-due-bh-update-modal', require('./components/synopsis/KgSugarDueBHUpdateModal.vue').default);
Vue.component('kg-sugar-due-bh-delete-modal', require('./components/synopsis/KgSugarDueBHDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

