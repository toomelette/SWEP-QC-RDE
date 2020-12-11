<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE II.  PRODUCTION INCREMENT AND SHARING RATIO</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align:center;">SUGAR FACTORY</th>
                    <th colspan="3" style="text-align: center;">50 - KILOGRAMS RAW SUGAR MANUFACTURED</th>
                    <th rowspan="2" style="text-align: center;">PLANTERS-MILLERS <br> SHARING RATIO</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">CROP YEAR <br> {{ utilLastCropYearName() }}</th>
                    <th style="text-align: center;">CROP YEAR <br> {{ crop_year }}</th>
                    <th style="text-align: center;">INCREASE / <br> DECREASE</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "past_cy_prod") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "current_cy_prod") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "increase_decrease") }}</td>
                            <td></td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.past_cy_prod }}</td>
                            <td id="mid-vert">{{ data.current_cy_prod }}</td>
                            <td id="mid-vert">{{ data.increase_decrease }}</td>
                            <td id="mid-vert">{{ data.sharing_ratio }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "past_cy_prod") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "current_cy_prod") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "increase_decrease") }}</td>
                    <td></td>
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
                                current_cy_prod: this.utilFilterFloat(data.current_cy_prod),
                                past_cy_prod: this.utilFilterFloat(data.past_cy_prod),
                                increase_decrease: this.utilFilterFloat(data.increase_decrease),
                                sharing_ratio: data.sharing_ratio, 
                            });
                        }
                    });
                }
                return array;
            },



        },



	}

</script>
