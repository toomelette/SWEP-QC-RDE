

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


Vue.component('cane-analysis-list', require('./components/synopsis/CaneAnalysisList.vue').default);
Vue.component('cane-analysis-create-modal', require('./components/synopsis/CaneAnalysisCreateModal.vue').default);
// Vue.component('cane-analysis-update-modal', require('./components/synopsis/CaneAnalysisUpdateModal.vue').default);
// Vue.component('cane-analysis-delete-modal', require('./components/synopsis/CaneAnalysisDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

