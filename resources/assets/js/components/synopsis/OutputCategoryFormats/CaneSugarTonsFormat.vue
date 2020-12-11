<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE I.  TONNAGE OF CANE MILLED AND RAW SUGAR PRODUCED</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th colspan="2" style="text-align: center;">SUGARCANE</th>
                    <th colspan="3" style="text-align: center;">RAW SUGAR</th>
                </tr>  
                <tr>
                    <th style="text-align:center;">GROSS TONNES</th>
                    <th style="text-align:center;">NET TONNES</th>
                    <th style="text-align:center;">TONNES DUE CANE</th>
                    <th style="text-align:center;">TONNES <br> MANUFACTURED</th>
                    <th style="text-align:center;">EQUIVALENT <br> (50-Kg Bag)</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "sgrcane_gross_tonnes", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "sgrcane_net_tonnes", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "rawsgr_tonnes_due_cane", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "rawsgr_tonnes_manufactured", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "equivalent", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.sgrcane_gross_tonnes }}</td>
                            <td id="mid-vert">{{ data.sgrcane_net_tonnes }}</td>
                            <td id="mid-vert">{{ data.rawsgr_tonnes_due_cane }}</td>
                            <td id="mid-vert">{{ data.rawsgr_tonnes_manufactured }}</td>
                            <td id="mid-vert">{{ data.equivalent }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "sgrcane_gross_tonnes", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "sgrcane_net_tonnes", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "rawsgr_tonnes_due_cane", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "rawsgr_tonnes_manufactured", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "equivalent", 2) }}</td>
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
                                sgrcane_gross_tonnes: this.utilFilterFloat(data.sgrcane_gross_tonnes, 2),
                                sgrcane_net_tonnes: this.utilFilterFloat(data.sgrcane_net_tonnes, 2),
                                rawsgr_tonnes_due_cane: this.utilFilterFloat(data.rawsgr_tonnes_due_cane, 2),
                                rawsgr_tonnes_manufactured: this.utilFilterFloat(data.rawsgr_tonnes_manufactured, 2), 
                                equivalent: this.utilFilterFloat(data.equivalent, 2), 
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
