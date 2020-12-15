<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE X.  SYRUP</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">BRIX</th>
                    <th style="text-align:center;">PERCENT <br>POL</th>
                    <th style="text-align:center;">APPARENT <br>PURITY</th>
                    <th style="text-align:center;">PERCENT <br>SUCROSE</th>
                    <th style="text-align:center;">GRAVITY <br>PURITY</th>
                    <th style="text-align:center;">pH</th>
                    <th style="text-align:center;">INC. IN AP <br>MJ TO SYRUP</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "brix", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_pol", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "apparent_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_sucrose", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "gravity_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "ph", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "inc_in_ap", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.brix }}</td>
                            <td id="mid-vert">{{ data.percent_pol }}</td>
                            <td id="mid-vert">{{ data.apparent_purity }}</td>
                            <td id="mid-vert">{{ data.percent_sucrose }}</td>
                            <td id="mid-vert">{{ data.gravity_purity }}</td>
                            <td id="mid-vert">{{ data.ph }}</td>
                            <td id="mid-vert">{{ data.inc_in_ap }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "brix", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_pol", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "apparent_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_sucrose", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "gravity_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "ph", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "inc_in_ap", 2) }}</td>
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
                                brix: this.utilFilterFloat(data.brix, 2),
                                percent_pol: this.utilFilterFloat(data.percent_pol, 2),
                                apparent_purity: this.utilFilterFloat(data.apparent_purity, 2),
                                percent_sucrose: this.utilFilterFloat(data.percent_sucrose, 2),
                                gravity_purity: this.utilFilterFloat(data.gravity_purity, 2),
                                ph: this.utilFilterFloat(data.ph, 2),
                                inc_in_ap: this.utilFilterFloat(data.inc_in_ap, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
