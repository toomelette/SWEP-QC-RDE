<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XI.  BAGASSE</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">TONNES</th>
                    <th style="text-align:center;">PERCENT <br>ON CANE</th>
                    <th style="text-align:center;">PERCENT <br>POL</th>
                    <th style="text-align:center;">PERCENT <br>MOISTURE</th>
                    <th style="text-align:center;">PERCENT <br>FIBER</th>
                    <th style="text-align:center;">CALORIFIC VALUE <br>(Kcal/Kg)</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "tonnes", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_on_cane", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_pol", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_moisture", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_fiber", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "calorific_value", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.tonnes }}</td>
                            <td id="mid-vert">{{ data.percent_on_cane }}</td>
                            <td id="mid-vert">{{ data.percent_pol }}</td>
                            <td id="mid-vert">{{ data.percent_moisture }}</td>
                            <td id="mid-vert">{{ data.percent_fiber }}</td>
                            <td id="mid-vert">{{ data.calorific_value }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "tonnes", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_on_cane", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_pol", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_moisture", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_fiber", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "calorific_value", 2) }}</td>
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
            regions: {},
            crop_year: '',
        
        },


        methods: {


            filterCollection(collection, region){
                var array = [];
                if (Object.keys(collection).length != 0) {
                    Object.values(collection).forEach(data => {
                        if(data.mill.report_region == region){
                            array.push({
                                mill_name: data.mill.name,
                                tonnes: this.utilFilterFloat(data.tonnes, 2),
                                percent_on_cane: this.utilFilterFloat(data.percent_on_cane, 2),
                                percent_pol: this.utilFilterFloat(data.percent_pol, 2),
                                percent_moisture: this.utilFilterFloat(data.percent_moisture, 2),
                                percent_fiber: this.utilFilterFloat(data.percent_fiber, 2),
                                calorific_value: this.utilFilterFloat(data.calorific_value, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
