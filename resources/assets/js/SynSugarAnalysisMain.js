

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


Vue.component('sugar-analysis-list', require('./components/synopsis/SugarAnalysisList.vue').default);
Vue.component('sugar-analysis-create-modal', require('./components/synopsis/SugarAnalysisCreateModal.vue').default);
Vue.component('sugar-analysis-update-modal', require('./components/synopsis/SugarAnalysisUpdateModal.vue').default);
Vue.component('sugar-analysis-delete-modal', require('./components/synopsis/SugarAnalysisDeleteModal.vue').default);


const app = new Vue({
    el: '#app'
});

