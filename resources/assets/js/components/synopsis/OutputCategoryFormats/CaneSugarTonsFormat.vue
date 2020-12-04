<script type="text/javascript">
	
	window.Vue = require('vue');

	Vue.component('cane-sugar-tons-output-format', {
        
        

		props: {

            collection: {},
            regions: {},
            crop_year: '',

        },



        template: `<div v-if="collection.length > 0">
                    <h3 style="text-align:center;">Cane-Sugar Tons</h3>
                    <h4 style="text-align:center;">{{ crop_year }}</h4>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align:center;">SUGAR FACTORY</th>
                                <th colspan="2" style="text-align: center;">SUGARCANE</th>
                                <th colspan="3" style="text-align: center;">RAW SUGAR</th>
                            </tr>  
                            <tr>
                                <th>GROSS TONNES</th>
                                <th>NET TONNES</th>
                                <th>TONNES DUE CANE</th>
                                <th>TONNES MANUFACTURED</th>
                                <th>EQUIVALENT (50-Kg Bag)</th>
                            </tr>    
                        </thead>    
                        <tbody v-if="filterCollection(collection, region_key).length > 0" v-for="(region, region_key) in regions" v-bind:key="region_key">
                            <tr>
                                <td style="font-weight:bold;">{{ region }}</td>
                                <td style="font-weight:bold;">{{ totalPerRegion(collection, region_key, "sgrcane_gross_tonnes") }}</td>
                                <td style="font-weight:bold;">{{ totalPerRegion(collection, region_key, "sgrcane_net_tonnes") }}</td>
                                <td style="font-weight:bold;">{{ totalPerRegion(collection, region_key, "rawsgr_tonnes_due_cane") }}</td>
                                <td style="font-weight:bold;">{{ totalPerRegion(collection, region_key, "rawsgr_tonnes_manufactured") }}</td>
                                <td style="font-weight:bold;">{{ totalPerRegion(collection, region_key, "equivalent") }}</td>
                            </tr>
                            <tr v-for="(data, data_key) in filterCollection(collection, region_key)" v-bind:key="data_key">
                                <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                                <td id="mid-vert">{{ data.sgrcane_gross_tonnes }}</td>
                                <td id="mid-vert">{{ data.sgrcane_net_tonnes }}</td>
                                <td id="mid-vert">{{ data.rawsgr_tonnes_due_cane }}</td>
                                <td id="mid-vert">{{ data.rawsgr_tonnes_manufactured }}</td>
                                <td id="mid-vert">{{ data.equivalent }}</td>
                            </tr>
                        </tbody>
                    </table>
                  </div>`,



        methods: {


            filterCollection(collection, region){

                var array = [];

                if (Object.keys(collection).length != 0) {
                    Object.values(collection).forEach(data => {
                        if(data.mill.report_region == region){
                            array.push({
                                mill_name: data.mill.name,
                                sgrcane_gross_tonnes: this.filterFloat(data.sgrcane_gross_tonnes),
                                sgrcane_net_tonnes: this.filterFloat(data.sgrcane_net_tonnes),
                                rawsgr_tonnes_due_cane: this.filterFloat(data.rawsgr_tonnes_due_cane),
                                rawsgr_tonnes_manufactured: this.filterFloat(data.rawsgr_tonnes_manufactured), 
                                equivalent: this.filterFloat(data.equivalent), 
                            });
                        }
                    });
                }

                return array;

            },


            filterFloat(float){

                let input_value = parseFloat(float).toFixed(2);

                if (isNaN(input_value)) {
                    input_value = '';
                }else{
                    input_value = input_value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                return input_value.toString();

            },


            totalPerRegion(collection, region, field){

                let total = 0.00;

                if (Object.keys(collection).length != 0) {
                    Object.values(collection).forEach(data => {
                        if(data.mill.report_region == region){
                            total += Number(data[field]);
                        }
                    });
                }

                return this.filterFloat(total);

            },


            totalPerCY(collection, field){

                let total = 0.00;

                if (Object.keys(collection).length != 0) {
                    Object.values(collection).forEach(data => {
                        total += Number(data[field]);
                    });
                }

                return this.filterFloat(total);

            },



        },



	});

</script>
