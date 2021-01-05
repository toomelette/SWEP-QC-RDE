<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">ANNEX  IV</h3>
        <h3 style="text-align:center;">TEN - YEAR  DATA  ON  AGRICULTURAL  PARAMETERS</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">AREA HARVESTED <br>(Hectares)</th>
                    <th style="text-align:center;">TC/Ha</th>
                    <th style="text-align:center;">LKg/TC</th>
                    <th style="text-align:center;">LKg/Ha</th>
                </tr>    
            </thead>    
            <tbody>
                <tr v-for="(data, data_key) in filterCollection(collection)">
                    <td id="mid-vert">{{ data.cy_name }}</td>
                    <td id="mid-vert">{{ data.area_harvested }}</td>
                    <td id="mid-vert">{{ data.tc_ha }}</td>
                    <td id="mid-vert">{{ data.lkg_tc }}</td>
                    <td id="mid-vert">{{ data.lkg_ha }}</td>
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
                            area_harvested: this.utilFilterFloat(data.area_harvested, 2),
                            tc_ha: this.utilFilterFloat(data.tc_ha, 2),
                            lkg_tc: this.utilFilterFloat(data.lkg_tc, 2),
                        });
                    });
                }
                return array;
            },


        },



	}

</script>
