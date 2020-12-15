<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE IX. CLARIFICATION DATA</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th colspan="4" style="text-align: center;">CLARIFIED JUICE</th>
                    <th colspan="3" style="text-align: center;">LIME</th>
                </tr>  
                <tr>
                    <th style="text-align:center;">APPARENT <br>PURITY</th>
                    <th style="text-align:center;">BRIX</th>
                    <th style="text-align:center;">pH</th>
                    <th style="text-align:center;">CLARITY</th>

                    <th style="text-align:center;">TONNES <br>USED</th>
                    <th style="text-align:center;">% CAO</th>
                    <th style="text-align:center;">Kg CAO <br>PER TC</th>
                </tr>   
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "juice_apparent_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "juice_brix", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "juice_ph", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "juice_clarity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "lime_tonnes_used", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "lime_cao", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "lime_cao_per_tc", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.juice_apparent_purity }}</td>
                            <td id="mid-vert">{{ data.juice_brix }}</td>
                            <td id="mid-vert">{{ data.juice_ph }}</td>
                            <td id="mid-vert">{{ data.juice_clarity }}</td>
                            <td id="mid-vert">{{ data.lime_tonnes_used }}</td>
                            <td id="mid-vert">{{ data.lime_cao }}</td>
                            <td id="mid-vert">{{ data.lime_cao_per_tc }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "juice_apparent_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "juice_brix", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "juice_ph", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "juice_clarity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "lime_tonnes_used", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "lime_cao", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "lime_cao_per_tc", 2) }}</td>
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
                                juice_apparent_purity: this.utilFilterFloat(data.juice_apparent_purity, 2),
                                juice_brix: this.utilFilterFloat(data.juice_brix, 2),
                                juice_ph: this.utilFilterFloat(data.juice_ph, 2),
                                juice_clarity: this.utilFilterFloat(data.juice_clarity, 2),
                                lime_tonnes_used: this.utilFilterFloat(data.lime_tonnes_used, 2),
                                lime_cao: this.utilFilterFloat(data.lime_cao, 2),
                                lime_cao_per_tc: this.utilFilterFloat(data.lime_cao_per_tc, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
