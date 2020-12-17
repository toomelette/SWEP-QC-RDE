<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XIX.  MILLING AND BOILING HOUSE LOSSES</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2" style="text-align: center;">MILLING LOSS</th>
                    <th colspan="5" style="text-align: center;">POL LOSSES</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">BAGASSE</th>
                    <th style="text-align: center;">FILTER CAKE</th>
                    <th style="text-align: center;">FINAL MOLASSES</th>
                    <th style="text-align: center;">UNDETERMINED</th>
                    <th style="text-align: center;">TOTAL</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "milling_loss") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "bagasse") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "filter_cake") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "molasses") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "undetermined") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "total") }}</td>
                            <td></td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.milling_loss }}</td>
                            <td id="mid-vert">{{ data.bagasse }}</td>
                            <td id="mid-vert">{{ data.filter_cake }}</td>
                            <td id="mid-vert">{{ data.molasses }}</td>
                            <td id="mid-vert">{{ data.undetermined }}</td>
                            <td id="mid-vert">{{ data.total }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "milling_loss") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "bagasse") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "filter_cake") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "molasses") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "undetermined") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "total") }}</td>
                    <td></td>
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
                                milling_loss: this.utilFilterFloat(data.milling_loss),
                                bagasse: this.utilFilterFloat(data.bagasse),
                                filter_cake: this.utilFilterFloat(data.filter_cake), 
                                molasses: this.utilFilterFloat(data.molasses), 
                                undetermined: this.utilFilterFloat(data.undetermined), 
                                total: this.utilFilterFloat(data.total), 
                            });
                        }
                    });
                }
                return array;
            },



        },



	}

</script>
