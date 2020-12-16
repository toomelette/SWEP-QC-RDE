<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XIII. FINAL MOLASSES</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">TONNES <br>MANUFACTURED</th>
                    <th style="text-align:center;">TONNES DUE CANE</th>
                    <th style="text-align:center;">PERCENT <br>ON CANE</th>
                    <th style="text-align:center;">BRIX</th>
                    <th style="text-align:center;">APPARENT <br>PURITY</th>
                    <th style="text-align:center;">GRAVITY <br>PURITY</th>
                    <th style="text-align:center;">PERCENT <br>ASH</th>
                    <th style="text-align:center;">PERCENT <br>REDUCING <br>SUGAR</th>
                    <th style="text-align:center;">EXPECTED <br>MOLASSES <br>PURITY</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "tonnes_manufactured", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "tonnes_due_cane", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_on_cane", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "brix", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "apparent_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "gravity_purity", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_ash", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "percent_reducing_sugar", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "expected_molasses_purity", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.tonnes_manufactured }}</td>
                            <td id="mid-vert">{{ data.tonnes_due_cane }}</td>
                            <td id="mid-vert">{{ data.percent_on_cane }}</td>
                            <td id="mid-vert">{{ data.brix }}</td>
                            <td id="mid-vert">{{ data.apparent_purity }}</td>
                            <td id="mid-vert">{{ data.gravity_purity }}</td>
                            <td id="mid-vert">{{ data.percent_ash }}</td>
                            <td id="mid-vert">{{ data.percent_reducing_sugar }}</td>
                            <td id="mid-vert">{{ data.expected_molasses_purity }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "tonnes_manufactured", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "tonnes_due_cane", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_on_cane", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "brix", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "apparent_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "gravity_purity", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_ash", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "percent_reducing_sugar", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "expected_molasses_purity", 2) }}</td>
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
                                tonnes_manufactured: this.utilFilterFloat(data.tonnes_manufactured, 2),
                                tonnes_due_cane: this.utilFilterFloat(data.tonnes_due_cane, 2),
                                percent_on_cane: this.utilFilterFloat(data.percent_on_cane, 2),
                                brix: this.utilFilterFloat(data.brix, 2),
                                apparent_purity: this.utilFilterFloat(data.apparent_purity, 2),
                                gravity_purity: this.utilFilterFloat(data.gravity_purity, 2),
                                percent_ash: this.utilFilterFloat(data.percent_ash, 2),
                                percent_reducing_sugar: this.utilFilterFloat(data.percent_reducing_sugar, 2),
                                expected_molasses_purity: this.utilFilterFloat(data.expected_molasses_purity, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
