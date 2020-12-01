<script type="text/javascript">
	
	window.Vue = require('vue');

	Vue.component('number-format', {
		

		props: [
	    	"value",
	    	"decimals",
		],
		

		template: `<input type="text" v-model="displayValue" @blur="isInputActive=false" @focus="isInputActive=true"/>`,


	    data(){
	        return {
	            isInputActive: false
	        }
		},


	    computed: {

	        displayValue: {

	            get: function() {

	                if (this.isInputActive) {

						if(isNaN(this.value)){
							return '';
						}

						return this.value.toString();
						
	                } else {

						let input_value = parseFloat(this.value.toString().replace(/^[A-Za-z]+$/, ""));
						
	                	if (isNaN(input_value)) {
	                		input_value = '';
	                	}else{
	                		if (input_value.toString().includes('.')) {
	                			input_value = input_value.toString().split(".");
					    		input_value[0] = input_value[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	                			input_value[1] = input_value[1].toString().substring(0,this.decimals);
					    		input_value = input_value.join(".");
	                		}else{
					    		input_value = input_value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	                		}
	                	}
	                	
						return input_value.toString();
						
					}
					
				},
				
				
	            set: function(modified_value) {

					let new_value = modified_value.replace(',', '');

	                if (isNaN(new_value)) {
	                    new_value = '';
					}

					if (new_value.toString().includes('.')) {
						new_value = new_value.toString().split(".");
						new_value[1] = new_value[1].toString().substring(0, this.decimals);
						new_value = new_value.join(".");
					}

					this.$emit('input', new_value);
					
				}

				
			}
			
	    },


	});

</script>
