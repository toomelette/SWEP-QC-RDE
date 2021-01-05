<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">ANNEX  I</h3>
        <h3 style="text-align:center;">TEN - YEAR  SUMMARY  OF  PRODUCTION  DATA</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">GROSS CANE <br>MILLED</th>
                    <th style="text-align:center;">RAW SUGAR <br>MANUFACTURED</th>
                    <th style="text-align:center;">MOLASSES DUE <br>CANE</th>
                    <th style="text-align:center;">BAGASSE</th>
                    <th style="text-align:center;">FILTER CAKE</th>
                </tr>    
            </thead>    
            <tbody>
                <tr v-for="(data, data_key) in filterCollection(collection)">
                    <td id="mid-vert">{{ data.cy_name }}</td>
                    <td id="mid-vert">{{ data.gross_cane_milled }}</td>
                    <td id="mid-vert">{{ data.raw_sugar_man }}</td>
                    <td id="mid-vert">{{ data.molasses_due_cane }}</td>
                    <td id="mid-vert">{{ data.bagasse }}</td>
                    <td id="mid-vert">{{ data.filter_cake }}</td>
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
                            gross_cane_milled: this.utilFilterFloat(data.gross_cane_milled, 2),
                            raw_sugar_man: this.utilFilterFloat(data.raw_sugar_man, 2),
                            molasses_due_cane: this.utilFilterFloat(data.molasses_due_cane, 2),
                            bagasse: this.utilFilterFloat(data.bagasse, 2),
                            filter_cake: this.utilFilterFloat(data.filter_cake, 2),
                        });
                    });
                }
                return array;
            },


        },



	}

</script>
