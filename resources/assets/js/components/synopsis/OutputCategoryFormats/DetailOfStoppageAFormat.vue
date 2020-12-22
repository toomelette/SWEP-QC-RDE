<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XXV-A.  DETAIL OF STOPPAGES</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2"></th>
                    <th colspan="2" style="text-align: center;">DUE FACTORY</th>
                    <th colspan="2" style="text-align: center;">DUE NO CANE</th>
                    <th colspan="2" style="text-align: center;">DUE TRANSPORT</th>
                </tr>  
                <tr>
                    <th style="text-align:center;">NO. OF HOUR</th>
                    <th style="text-align:center;">% ON TET</th>
                    <th style="text-align:center;">NO. OF HOUR</th>
                    <th style="text-align:center;">% ON TET</th>
                    <th style="text-align:center;">NO. OF HOUR</th>
                    <th style="text-align:center;">% ON TET</th>
                </tr>     
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">Total:</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_factory_hrs", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_factory_tet", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_no_cane_hrs", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_no_cane_tet", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_transport_hrs", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_transport_tet", 2) }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td style="font-weight:bold;">Ave:</td>
                            <td style="font-weight:bold;"> 
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "due_factory_hrs", 2), filterCollection(collection, region_key).length) }}
                            </td>
                            <td style="font-weight:bold;">
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "due_factory_tet", 2), filterCollection(collection, region_key).length) }}
                            </td>
                            <td style="font-weight:bold;">
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "due_no_cane_hrs", 2), filterCollection(collection, region_key).length) }}
                            </td>
                            <td style="font-weight:bold;">
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "due_no_cane_tet", 2), filterCollection(collection, region_key).length) }}
                            </td>
                            <td style="font-weight:bold;"> 
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "due_transport_hrs", 2), filterCollection(collection, region_key).length) }}
                            </td>
                            <td style="font-weight:bold;">
                                {{ getAverage(utilTotalPerRegion(collection, region_key, "due_transport_tet", 2), filterCollection(collection, region_key).length) }}
                            </td>
                        </tr>

                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td></td>
                            <td id="mid-vert">{{ data.due_factory_hrs }}</td>
                            <td id="mid-vert">{{ data.due_factory_tet }}</td>
                            <td id="mid-vert">{{ data.due_no_cane_hrs }}</td>
                            <td id="mid-vert">{{ data.due_no_cane_tet }}</td>
                            <td id="mid-vert">{{ data.due_transport_hrs }}</td>
                            <td id="mid-vert">{{ data.due_transport_tet }}</td>
                        </tr>

                    </template>
                </template>

                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">Total:</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_factory_hrs", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_factory_tet", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_no_cane_hrs", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_no_cane_tet", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_transport_hrs", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_transport_tet", 2) }}</td>
                </tr>

                <tr>
                    <td></td>
                    <td style="font-weight:bold;">Ave:</td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "due_factory_hrs", 2), collection.length) }}
                    </td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "due_factory_tet", 2), collection.length) }}
                    </td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "due_no_cane_hrs", 2), collection.length) }}
                    </td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "due_no_cane_tet", 2), collection.length) }}
                    </td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "due_transport_hrs", 2), collection.length) }}
                    </td>
                    <td style="font-weight:bold;">
                        {{ getAverage(utilTotalPerCY(collection, "due_transport_tet", 2), collection.length) }}
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
                                due_factory_hrs: this.utilFilterFloat(data.due_factory_hrs, 2),
                                due_factory_tet: this.utilFilterFloat(data.due_factory_tet, 2),
                                due_no_cane_hrs: this.utilFilterFloat(data.due_no_cane_hrs, 2),
                                due_no_cane_tet: this.utilFilterFloat(data.due_no_cane_tet, 2),
                                due_transport_hrs: this.utilFilterFloat(data.due_transport_hrs, 2),
                                due_transport_tet: this.utilFilterFloat(data.due_transport_tet, 2),
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
