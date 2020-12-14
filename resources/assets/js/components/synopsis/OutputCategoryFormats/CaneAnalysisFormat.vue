<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE IV. ANALYSES OF GROSS CANE GROUND</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">PERCENT <br> POL</th>
                    <th style="text-align:center;">PERCENT <br> SUCROSE</th>
                    <th style="text-align:center;">PERCENT <br> FIBER</th>
                    <th style="text-align:center;">PERCENT <br> TRASH</th>
                    <th style="text-align:center;">POL PERCENT <br> FIBER</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_pol", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_sucrose", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_fiber", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_trash", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "pol_percent_fiber", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.percent_pol }}</td>
                            <td id="mid-vert">{{ data.percent_sucrose }}</td>
                            <td id="mid-vert">{{ data.percent_fiber }}</td>
                            <td id="mid-vert">{{ data.percent_trash }}</td>
                            <td id="mid-vert">{{ data.pol_percent_fiber }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_pol", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_sucrose", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_fiber", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_trash", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "pol_percent_fiber", 2) }}</td>
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
                                percent_pol: this.utilFilterFloat(data.percent_pol, 2),
                                percent_sucrose: this.utilFilterFloat(data.percent_sucrose, 2),
                                percent_fiber: this.utilFilterFloat(data.percent_fiber, 2),
                                percent_trash: this.utilFilterFloat(data.percent_trash, 2), 
                                pol_percent_fiber: this.utilFilterFloat(data.pol_percent_fiber, 2), 
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
