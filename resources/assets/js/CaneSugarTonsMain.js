
require('./bootstrap');

import Select2 from 'v-select2-component';


window.Vue = require('vue');


const EventBus = new Vue();	
export default EventBus;


Vue.component('Select2', Select2);

Vue.component('number-format', {
    props: ["value"],
    template: `
        <input type="text" v-model="displayValue" @blur="isInputActive = false" @focus="isInputActive = true"/>`,
    data: function() {
        return {
            isInputActive: false
        }
    },
    computed: {
        displayValue: {
            get: function() {
                if (this.isInputActive) {
                    return this.value.toString();
                } else {
                    return this.value.toString().replace(',','').toLocaleString();
                }
            },
            set: function(modifiedValue) {
                let newValue = parseFloat(modifiedValue.replace(',', ''))
                if (isNaN(newValue)) {
                    newValue = 0
                }
                this.$emit('input', newValue)
            }
        }
    }
});


Vue.component('synopsis-cane-sugar-tons-list', require('./components/synopsis/CaneSugarTonsList.vue').default);
Vue.component('synopsis-cane-sugar-tons-create', require('./components/synopsis/CaneSugarTonsCreate.vue').default);

const app = new Vue({
    el: '#app'
});

