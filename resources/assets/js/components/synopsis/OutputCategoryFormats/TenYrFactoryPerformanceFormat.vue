<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">ANNEX  III</h3>
        <h3 style="text-align:center;">TEN - YEAR  SUMMARY  OF  FACTORY  PERFORMANCE</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">RATED CAPACITY <br>(TCD)</th>
                    <th style="text-align:center;">CAPACITY <br>UTILIZATION <br> (%)</th>
                    <th style="text-align:center;">POL EXTRACTION <br> (%)</th>
                    <th style="text-align:center;">ACTUAL BOILING <br>HOUSE RECOVERY <br> (%)</th>
                    <th style="text-align:center;">REDUCED <br>OVERALL <br>RECOVERY, ESG <br> (%)</th>
                    <th style="text-align:center;">AVERAGE NUMBER <br>OF GRINDING DAYS</th>
                </tr>    
            </thead>    
            <tbody>
                <tr v-for="(data, data_key) in filterCollection(collection)">
                    <td id="mid-vert">{{ data.cy_name }}</td>
                    <td id="mid-vert">{{ data.rated_capacity }}</td>
                    <td id="mid-vert">{{ data.cap_utilization }}</td>
                    <td id="mid-vert">{{ data.pol_extraction }}</td>
                    <td id="mid-vert">{{ data.actual_bhr }}</td>
                    <td id="mid-vert">{{ data.reduced_overall_recovery }}</td>
                    <td id="mid-vert">{{ data.ave_num_of_grinding }}</td>
                </tr>
            </tbody>
        </table>
        </div>
    
</template>

<script type="text/javascript">


    import OutputFormatUtil from './OutputFormatUtil';


    export default {


        mixins: [ OutputFormatUtil ],


		props: {

            collection: {},
            crop_year: '',
        
        },


        methods: {


            filterCollection(collection){
                var array = [];
                if (Object.keys(collection).length != 0) {
                    Object.values(collection).forEach(data => {
                        array.push({
                            cy_name: data.cy_name,
                            rated_capacity: this.utilFilterFloat(data.rated_capacity, 2),
                            cap_utilization: this.utilFilterFloat(data.cap_utilization, 2),
                            pol_extraction: this.utilFilterFloat(data.pol_extraction, 2),
                            actual_bhr: this.utilFilterFloat(data.actual_bhr, 2),
                            reduced_overall_recovery: this.utilFilterFloat(data.reduced_overall_recovery, 2),
                            ave_num_of_grinding: this.utilFilterFloat(data.ave_num_of_grinding, 2),
                        });
                    });
                }
                return array;
            },


        },



	}

</script>
