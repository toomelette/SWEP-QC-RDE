<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XVI.  MILLING PLANT</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2" style="text-align: center;">MILLING PLANT <br>EXTRACTION <br>EQUIPMENT</th>
                    <th rowspan="2" style="text-align: center;">IMBIBITION <br>PERCENT <br>FIBER</th>
                    <th rowspan="2" style="text-align: center;">IMBIBITION <br>PERCENT <br>CANE</th>
                    <th colspan="4" style="text-align: center;">EXTRACTION</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">POL</th>
                    <th style="text-align: center;">SUCROSE</th>
                    <th style="text-align: center;">REDUCED</th>
                    <th style="text-align: center;">WHOLE <br>REDUCED</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td></td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "imbibition_percent_fiber") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "imbibition_percent_cane") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "pol") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "sucrose") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "reduced") }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "whole_reduced") }}</td>
                            <td></td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.extraction_equipment }}</td>
                            <td id="mid-vert">{{ data.imbibition_percent_fiber }}</td>
                            <td id="mid-vert">{{ data.imbibition_percent_cane }}</td>
                            <td id="mid-vert">{{ data.pol }}</td>
                            <td id="mid-vert">{{ data.sucrose }}</td>
                            <td id="mid-vert">{{ data.reduced }}</td>
                            <td id="mid-vert">{{ data.whole_reduced }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td></td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "imbibition_percent_fiber") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "imbibition_percent_cane") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "pol") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "sucrose") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "reduced") }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "whole_reduced") }}</td>
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
                                extraction_equipment: data.extraction_equipment,
                                imbibition_percent_fiber: this.utilFilterFloat(data.imbibition_percent_fiber),
                                imbibition_percent_cane: this.utilFilterFloat(data.imbibition_percent_cane),
                                pol: this.utilFilterFloat(data.pol), 
                                sucrose: this.utilFilterFloat(data.sucrose), 
                                reduced: this.utilFilterFloat(data.reduced), 
                                whole_reduced: this.utilFilterFloat(data.whole_reduced), 
                            });
                        }
                    });
                }
                return array;
            },



        },



	}

</script>
