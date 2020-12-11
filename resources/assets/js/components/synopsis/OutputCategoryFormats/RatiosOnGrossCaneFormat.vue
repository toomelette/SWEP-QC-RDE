<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE III.  RATIOS ON GROSS CANE GROUND</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align: center;">Burnt Cane Percent <br> Gross Cane</th>
                    <th style="text-align: center;">Quality Ratio <br> TC/TS</th>
                    <th style="text-align: center;">Rendement <br> Lkg/TC</th>
                    <th style="text-align: center;">Total Sugar <br> Recovered  %Cane </th>
                </tr>   
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "burnt_cane_percent", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "quality_ratio", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "rendement", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "total_sugar_recovered", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.burnt_cane_percent }}</td>
                            <td id="mid-vert">{{ data.quality_ratio }}</td>
                            <td id="mid-vert">{{ data.rendement }}</td>
                            <td id="mid-vert">{{ data.total_sugar_recovered }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "burnt_cane_percent", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "quality_ratio", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "rendement", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "total_sugar_recovered", 2) }}</td>
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
                                burnt_cane_percent: this.utilFilterFloat(data.burnt_cane_percent, 2),
                                quality_ratio: this.utilFilterFloat(data.quality_ratio, 2),
                                rendement: this.utilFilterFloat(data.rendement, 2),
                                total_sugar_recovered: this.utilFilterFloat(data.total_sugar_recovered, 2), 
                            });
                        }
                    });
                }
                return array;
            },



        },



	}

</script>
