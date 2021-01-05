<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">ANNEX  II</h3>
        <h3 style="text-align:center;">TEN - YEAR  SUMMARY  OF  SIGNIFICANT  PRODUCTION  RATIO  AND YIELD</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">IMBIBITION <br>FIBER RATIO</th>
                    <th style="text-align:center;">RENDEMENT <br>(LKg/TC)</th>
                    <th style="text-align:center;">QUALITY RATIO <br>(TC/TS)</th>
                    <th style="text-align:center;">KILOGRAM <br>MOLASSES PER <br>TONNE OF CANE</th>
                    <th style="text-align:center;">KILOGRAM <br>BAGASSE PER <br>TONNE OF CANE</th>
                    <th style="text-align:center;">KILOGRAM <br>FILTERCAKE PER <br>TONNE OF CANE</th>
                </tr>    
            </thead>    
            <tbody>
                <tr v-for="(data, data_key) in filterCollection(collection)">
                    <td id="mid-vert">{{ data.cy_name }}</td>
                    <td id="mid-vert">{{ data.imbibition_fiber_ratio }}</td>
                    <td id="mid-vert">{{ data.rendement }}</td>
                    <td id="mid-vert">{{ data.quality_ratio }}</td>
                    <td id="mid-vert">{{ data.kg_mollasses_per_ton_cane }}</td>
                    <td id="mid-vert">{{ data.kg_bagasse_per_ton_cane }}</td>
                    <td id="mid-vert">{{ data.kg_fc_per_ton_cane }}</td>
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
            crop_year: '',
        
        },


        methods: {


            filterCollection(collection){
                var array = [];
                if (Object.keys(collection).length != 0) {
                    Object.values(collection).forEach(data => {
                        array.push({
                            cy_name: data.cy_name,
                            imbibition_fiber_ratio: this.utilFilterFloat(data.imbibition_fiber_ratio, 2),
                            rendement: this.utilFilterFloat(data.rendement, 2),
                            quality_ratio: this.utilFilterFloat(data.quality_ratio, 2),
                            kg_mollasses_per_ton_cane: this.utilFilterFloat(data.kg_mollasses_per_ton_cane, 2),
                            kg_bagasse_per_ton_cane: this.utilFilterFloat(data.kg_bagasse_per_ton_cane, 2),
                            kg_fc_per_ton_cane: this.utilFilterFloat(data.kg_fc_per_ton_cane, 2),
                        });
                    });
                }
                return array;
            },


        },



	}

</script>
