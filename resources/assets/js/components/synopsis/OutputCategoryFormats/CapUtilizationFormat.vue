<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XV.  CAPACITY  UTILIZATION AND MECHANICAL TIME EFFICIENCY</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">NORMAL RATE <br>CAPACITY <br>(TCD)</th>
                    <th style="text-align:center;">TONNES <br>CANE PER <br>HOUR</th>
                    <th style="text-align:center;">AVERAGE HOURS <br>ACTUAL GRINDING/ <br>HOUR</th>
                    <th style="text-align:center;">CAPACITY <br>UTILIZATION</th>
                    <th style="text-align:center;">MECHANICAL <br>TIME <br>EFFICIENCY</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "normal_rate_cap", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "tonnes_cane_per_hr", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "ave_hr_actual_grinding", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "cap_utilization", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "mechanical_time_eff", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.normal_rate_cap }}</td>
                            <td id="mid-vert">{{ data.tonnes_cane_per_hr }}</td>
                            <td id="mid-vert">{{ data.ave_hr_actual_grinding }}</td>
                            <td id="mid-vert">{{ data.cap_utilization }}</td>
                            <td id="mid-vert">{{ data.mechanical_time_eff }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "normal_rate_cap", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "tonnes_cane_per_hr", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "ave_hr_actual_grinding", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "cap_utilization", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "mechanical_time_eff", 2) }}</td>
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
                                normal_rate_cap: this.utilFilterFloat(data.normal_rate_cap, 2),
                                tonnes_cane_per_hr: this.utilFilterFloat(data.tonnes_cane_per_hr, 2),
                                ave_hr_actual_grinding: this.utilFilterFloat(data.ave_hr_actual_grinding, 2),
                                cap_utilization: this.utilFilterFloat(data.cap_utilization, 2),
                                mechanical_time_eff: this.utilFilterFloat(data.mechanical_time_eff, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
