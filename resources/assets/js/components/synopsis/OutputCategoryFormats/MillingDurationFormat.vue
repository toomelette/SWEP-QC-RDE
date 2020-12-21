<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XXIII.  MILLING DURATION</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">SUGAR FACTORY</th>
                    <th style="text-align: center;">MILLING STARTED</th>
                    <th style="text-align: center;">MILLING ENDED</th>
                    <th>&nbsp;</th>
                    <th style="text-align: center;">CROP LENGTH</th>
                    <th style="text-align: center;">TOTAL ELAPSED TIME (TET) <br> (HOURS)</th>
                </tr>     
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td></td>
                            <td></td>
                            <td style="font-weight:bold;">Total:</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "crop_length", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "tet", 2) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight:bold;">Ave:</td>
                            <td style="font-weight:bold;"> 
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "crop_length", 2), filterCollection(collection, region_key).length) }}
                            </td>
                            <td style="font-weight:bold;">
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "tet", 2), filterCollection(collection, region_key).length) }}
                            </td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.mill_start }}</td>
                            <td id="mid-vert">{{ data.mill_end }}</td>
                            <td></td>
                            <td id="mid-vert">{{ data.crop_length }}</td>
                            <td id="mid-vert">{{ data.tet }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td></td>
                    <td></td>
                    <td style="font-weight:bold;">Total:</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "crop_length", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "tet", 2) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight:bold;">Ave:</td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "crop_length", 2), collection.length) }}
                    </td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "tet", 2), collection.length) }}
                    </td>
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
                                mill_start: data.mill_start,
                                mill_end: data.mill_end,
                                crop_length: this.utilFilterFloat(data.crop_length, 2),
                                tet: this.utilFilterFloat(data.tet, 2),
                            });
                        }
                    });
                }
                return array;
            },


            getAverage(total, length){
                var ave = 0.00;
                total = total.toString().replace(",", "");
                length = length.toString().replace(",", "");
                ave = Number(total) / Number(length)
                return this.utilFilterFloat(ave, 2);
            },



        },



	}

</script>
