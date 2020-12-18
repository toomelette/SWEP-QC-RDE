<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XXI.  ADDITIONAL KILOS SUGAR DUE CLEAN CANE</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">TRASH PERCENT <br>CANE</th>
                    <th style="text-align:center;">PERCENT <br>RECOVERY</th>
                    <th style="text-align:center;">RECOVERABLE KILOS SUGAR<br> DUE FIBROUS TRASH AND <br>INCREASED EFFICIENCY</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "trash_percent_cane", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_recovery", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "recoverable", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.trash_percent_cane }}</td>
                            <td id="mid-vert">{{ data.percent_recovery }}</td>
                            <td id="mid-vert">{{ data.recoverable }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "trash_percent_cane", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_recovery", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "recoverable", 2) }}</td>
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
                                trash_percent_cane: this.utilFilterFloat(data.trash_percent_cane, 2),
                                percent_recovery: this.utilFilterFloat(data.percent_recovery, 2),
                                recoverable: this.utilFilterFloat(data.recoverable, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
