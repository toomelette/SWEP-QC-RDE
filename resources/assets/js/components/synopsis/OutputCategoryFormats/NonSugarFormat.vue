<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XIV.  PERCENT NON-SUGAR OF END PRODUCTS & MATERIALS IN PROCESS</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">FIRST EXPRESSED <br>JUICE</th>
                    <th style="text-align:center;">LAST EXPRESSED <br>JUICE</th>
                    <th style="text-align:center;">MIXED JUICE</th>
                    <th style="text-align:center;">SYRUP</th>
                    <th style="text-align:center;">MOLASSES</th>
                    <th style="text-align:center;">SUGAR</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "first_expressed_juice", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "last_expressed_juice", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "mixed_juice", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "syrup", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "molasses", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "sugar", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.first_expressed_juice }}</td>
                            <td id="mid-vert">{{ data.last_expressed_juice }}</td>
                            <td id="mid-vert">{{ data.mixed_juice }}</td>
                            <td id="mid-vert">{{ data.syrup }}</td>
                            <td id="mid-vert">{{ data.molasses }}</td>
                            <td id="mid-vert">{{ data.sugar }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "first_expressed_juice", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "last_expressed_juice", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "mixed_juice", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "syrup", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "molasses", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "sugar", 2) }}</td>
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
                                first_expressed_juice: this.utilFilterFloat(data.first_expressed_juice, 2),
                                last_expressed_juice: this.utilFilterFloat(data.last_expressed_juice, 2),
                                mixed_juice: this.utilFilterFloat(data.mixed_juice, 2),
                                syrup: this.utilFilterFloat(data.syrup, 2),
                                molasses: this.utilFilterFloat(data.molasses, 2),
                                sugar: this.utilFilterFloat(data.sugar, 2),
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
