<script type="text/javascript">
	
	window.Vue = require('vue');

	Vue.component('number-format', {



	    template: `<input type="text" v-model="displayValue" @blur="onBlur" @keyup="onChange" @keydown="onChange"/>`,



	    props: [
	    	"decimals"
	    ],



	    data(){
	        return {
				displayValue: '',
	        }
		},
		


		methods: {
			
			onChange(event){

				if (this.displayValue.toString().includes('.')) {
					let input_val = this.displayValue.toString().split(".");
					input_val[1] = input_val[1].toString().substring(0, this.decimals);
					this.displayValue = input_val.join(".").toString();
				}

	    		this.$emit('input', this.displayValue);

			},

			onBlur(event){

				this.displayValue = parseFloat(this.displayValue.toString().replace(/^[A-Za-z]+$/, ""));

				if (isNaN(this.displayValue)) {
					this.displayValue = '';
				}else{
					if (this.displayValue.toString().includes('.')) {
						input_val = this.displayValue.toString().split(".");
						input_val[0] = input_val[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");	
						input_val[1] = input_val[1].toString().substring(0, this.decimals);
						this.displayValue = input_val.join(".");
					}else{
						this.displayValue = this.displayValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					}
				}
				
	    		this.$emit('input', this.displayValue);

			},

		},



	});

</script>
