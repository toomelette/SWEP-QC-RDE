

<template>

    <div class="row">


        <!-- FILTERS -->
        <div class="col-md-3">

            <div class="box">

                <div class="box-header with-border">

                    <div class="box-title">  
                        Filters
                    </div>

                </div>

                
                <div class="box-body">

                    <form v-on:change="filter">

                        <!-- input crop year -->
                        <div class="form-group no-padding col-md-12" style="margin-bottom:30px;">
                            <label for="crop_year_id">Crop Year: </label>
                            <v-select v-model="crop_year_id" :options="crop_years" @input="filter"/>
                        </div>

                        <!-- input categories -->
                        <div class="form-group no-padding col-md-12">
                            <label>Categories: </label><br>
                            <div v-for="cat in categories" style="margin-left:10px;">
                                <label>
                                    <input type="checkbox" v-model="category_id" :value="cat.id" @change="checkBox">
                                    &nbsp; {{ cat.label }}
                                </label>
                            </div>
                        </div>

                    </form>

                </div>


            </div>

        </div>



        <!-- DYNAMIC DATA -->
        <div class="col-md-9">

            <div class="box">

                <div class="box-header with-border">

                    <!-- Search Box -->
                    <div class="box-title">  
                        Data
                    </div>

                    <!-- Select Entries -->
                    <div class="box-tools">
                        
                        <button class="btn btn-sm btn-success" @click="">
                            <i class="fa fa-file-text-o"></i>&nbsp; Excel
                        </button>
                        
                        <button class="btn btn-sm btn-default" @click="">
                            <i class="fa fa-print"></i>&nbsp; Print
                        </button>

                    </div>

                </div>


                <div class="box-body">

                    <table v-if="collection.length > 0" class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align:center;">SUGAR FACTORY</th>
                                <th colspan="2" style="text-align: center;">SUGARCANE</th>
                                <th colspan="3" style="text-align: center;">RAW SUGAR</th>
                            </tr>  
                            <tr>
                                <th>GROSS TONNES</th>
                                <th>NET TONNES</th>
                                <th>TONNES DUE CANE</th>
                                <th>TONNES MANUFACTURED</th>
                                <th>EQUIVALENT (50-Kg Bag)</th>
                            </tr>    
                        </thead>    
                        <tbody v-for="(region, region_key) in regions" v-bind:key="region_key">
                            <tr>
                                <td colspan="6" style="font-weight:bold;">{{ region }}</td>
                            </tr>
                            <tr v-for="(data, data_key) in collection" v-bind:key="data_key">
                                <template v-if="data.mill.report_region ==  region_key">
                                    <td id="mid-vert">{{ data.mill.name }}</td>
                                    <td id="mid-vert">{{ data.sgrcane_gross_tonnes }}</td>
                                    <td id="mid-vert">{{ data.sgrcane_net_tonnes }}</td>
                                    <td id="mid-vert">{{ data.rawsgr_tonnes_due_cane }}</td>
                                    <td id="mid-vert">{{ data.rawsgr_tonnes_manufactured }}</td>
                                    <td id="mid-vert">{{ data.equivalent }}</td>
                                </template>
                            </tr>
                        </tbody>
                    </table>  

                </div>


            </div>

        </div>

    </div>

</template>




<script>

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import Utils from '../utils';

    export default {


        mixins: [ Utils ],


        data() {

            return {

                regions : {'LUZ':'LUZON', 'NEG':'NEGROS', 'EV':'EASTERN VISAYAS', 'PAN':'PANAY', 'MIN':'MINDANAO', },
                crop_years : [],
                crop_year_id : '',
                categories : [],
                category_id : [],

                collection : {},
                
            }

        },



        created() {
            
            this.getAllMills();
            this.getAllSynOutputCategories();
        
        },



        watch:{


        },



        methods: {


            checkBox(e){
                this.category_id = [];
                if (e.target.checked) {
                    this.category_id.push(e.target.value);
                }
            },


            getAllMills(){ 
               axios.get('crop_year/get_all')
                    .then((response) => {
                       this.crop_years = this.utilVSelectOptions(response.data, 'crop_year_id', 'name');
                    }); 
            },


            getAllSynOutputCategories(){ 
               axios.get('synopsis/outputs/get_categories')
                    .then((response) => {
                       this.categories = response.data;
                    }); 
            },


            filter(){

               axios.get('synopsis/outputs/filter', { params: { cy: this.crop_year_id?.code, cat: this.category_id.toString()} })
                    .then((response) => {
                       this.collection = response.data;
                    })
                    .catch((error) =>{

                        this.$toast.error('Cannot Process! Invalid data given.', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        })

                    }); 

            },


        },



    }

</script>