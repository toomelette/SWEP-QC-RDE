<template>
    <div v-if="collection.length > 0">
        <h4 style="text-align:center;">CROP-YEAR: {{ crop_year }}</h4>
        <h3 style="text-align:center;">TABLE XXII. POTENTIAL REVENUE DIFFERENTIAL DUE INCREASED EFFICIENCY</h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">DUE MILL AND <br>BOILING HOUSE</th>
                    <th style="text-align:center;">DUE TRASH</th>
                    <th style="text-align:center;">TOTAL</th>
                    <th style="text-align:center;">POTENTIAL REVENUE <br> (PESO)</th>
                </tr>    
            </thead>    
            <tbody>
                <template v-for="(region, region_key) in regions">
                    <template v-if="filterCollection(collection, region_key).length > 0">
                        <tr>
                            <td style="font-weight:bold;">{{ region }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_bh", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "due_trash", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "total", 2) }}</td>
                            <td style="font-weight:bold;">{{ utilTotalPerRegion(collection, region_key, "potential_revenue", 2) }}</td>
                        </tr>
                        <tr v-for="(data, data_key) in filterCollection(collection, region_key)">
                            <td id="mid-vert">{{ data_key + 1 }}. {{ data.mill_name }}</td>
                            <td id="mid-vert">{{ data.due_bh }}</td>
                            <td id="mid-vert">{{ data.due_trash }}</td>
                            <td id="mid-vert">{{ data.total }}</td>
                            <td id="mid-vert">{{ data.potential_revenue }}</td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_bh", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "due_trash", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "total", 2) }}</td>
                    <td style="font-weight:bold;">{{ utilTotalPerCY(collection, "potential_revenue", 2) }}</td>
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
                                due_bh: this.utilFilterFloat(data.due_bh, 2),
                                due_trash: this.utilFilterFloat(data.due_trash, 2),
                                total: this.utilFilterFloat(data.total, 2),
                                potential_revenue: this.utilFilterFloat(data.potential_revenue, 2), 
                            });
                        }
                    });
                }
                return array;
            },


        },



	}

</script>
