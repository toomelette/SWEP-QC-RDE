<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE V.  ANALYSES OF RAW SUGAR MANUFACTURED</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">GRAVITY <br>PURITY</th>
                    <th style="text-align:center;">APPARENT <br>PURITY</th>
                    <th style="text-align:center;">PERCENT <br>POL</th>
                    <th style="text-align:center;">PERCENT <br>SUCROSE</th>
                    <th style="text-align:center;">PERCENT <br>MOISTURE</th>
                    <th style="text-align:center;">DI</th>
                    <th style="text-align:center;">CLARITY/ <br>TURBIDITY</th>
                    <th style="text-align:center;">PERCENT <br>ASH</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "gravity_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "apparent_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_pol", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_sucrose", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_moisture", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "di", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "clarity_turbidity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_ash", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.gravity_purity }}</td>
                            <td id="mid-vert">{{ data.apparent_purity }}</td>
                            <td id="mid-vert">{{ data.percent_pol }}</td>
                            <td id="mid-vert">{{ data.percent_sucrose }}</td>
                            <td id="mid-vert">{{ data.percent_moisture }}</td>
                            <td id="mid-vert">{{ data.di }}</td>
                            <td id="mid-vert">{{ data.clarity_turbidity }}</td>
                            <td id="mid-vert">{{ data.percent_ash }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "gravity_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "apparent_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_pol", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_sucrose", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_moisture", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "di", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "clarity_turbidity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_ash", 2) }}</td>
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
                                gravity_purity: this.utilFilterFloat(data.gravity_purity, 2),
                                apparent_purity: this.utilFilterFloat(data.apparent_purity, 2),
                                percent_pol: this.utilFilterFloat(data.percent_pol, 2),
                                percent_sucrose: this.utilFilterFloat(data.percent_sucrose, 2), 
                                percent_moisture: this.utilFilterFloat(data.percent_moisture, 2), 
                                di: this.utilFilterFloat(data.di, 2),
                                clarity_turbidity: this.utilFilterFloat(data.clarity_turbidity, 2), 
                                percent_ash: this.utilFilterFloat(data.percent_ash, 2), 
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
