

export default {

  	methods: {


		utilLastCropYearName(){
			var name = "";
			name = this.crop_year.toString().split("-")
			name[0] = parseInt(name[0]) - 1
			name[1] = parseInt(name[1]) - 1
			name = name.join(" - ")
			return name;
		},

	
		utilFilterFloat(float, int){
			let input_value = parseFloat(float).toFixed(int);
			if (isNaN(input_value)) {
				input_value = '';
			}else{
				input_value = input_value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
			return input_value.toString();
		},


		utilTotalPerRegion(collection, region, field, int){
			let total = 0.00;
			if (Object.keys(collection).length != 0) {
				Object.values(collection).forEach(data => {
					if(data.mill.report_region == region){
						total += Number(data[field]);
					}
				});
			}
			return this.utilFilterFloat(total, int);
		},


		utilTotalPerCY(collection, field, int){
			let total = 0.00;
			if (Object.keys(collection).length != 0) {
				Object.values(collection).forEach(data => {
					total += Number(data[field]);
				});
			}
			return this.utilFilterFloat(total, int);
		},



  	}

}