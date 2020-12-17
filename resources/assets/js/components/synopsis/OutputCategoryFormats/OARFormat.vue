<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XVIII. OVERALL RECOVERIES</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">ACTUAL <br>BOILING HOUSE <br>RECOVERY</th>
                    <th style="text-align:center;">STANDARD <br>BOILING HOUSE <br>RECOVERY</th>
                    <th style="text-align:center;">REDUCED <br>BOILING HOUSE <br>RECOVERY, ESG</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "actual_oar", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "standard_oar", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "reduced_oar", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.actual_oar }}</td>
                            <td id="mid-vert">{{ data.standard_oar }}</td>
                            <td id="mid-vert">{{ data.reduced_oar }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "actual_oar", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "standard_oar", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "reduced_oar", 2) }}</td>
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
                                actual_oar: this.utilFilterFloat(data.actual_oar, 2),
                                standard_oar: this.utilFilterFloat(data.standard_oar, 2),
                                reduced_oar: this.utilFilterFloat(data.reduced_oar, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
