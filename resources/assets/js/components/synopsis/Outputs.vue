

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
                            <div v-for="cat in categories" v-bind:key="cat.id" style="margin-left:10px;">
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
                    <div v-if="collection.length > 0" class="box-tools">
                        
                        <button class="btn btn-sm btn-success" @click="exportExcel()" target="_blank">
                            <i class="fa fa-file-text-o"></i>&nbsp; Excel
                        </button>
                        
                        <button class="btn btn-sm btn-default" @click="print()">
                            <i class="fa fa-print"></i>&nbsp; Print
                        </button>

                    </div>

                </div>


                <div class="box-body"> 

                    <div v-if="collection.length == 0" style="text-align:center;"><h3>No Data Available!</h3></div>

                    <div ref="dataBody">

                 
                        <cane-sugar-tons v-if="category_id.toString() == 1" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </cane-sugar-tons>
                      
                        <prdn-increment v-if="category_id.toString() == 2" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </prdn-increment>
                       
                        <ratios-on-gross-cane v-if="category_id.toString() == 3" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </ratios-on-gross-cane>
                        
                        <cane-analysis v-if="category_id.toString() == 4" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </cane-analysis>
                        
                        <sugar-analysis v-if="category_id.toString() == 5" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </sugar-analysis>
                        
                        <first-expressed-juice v-if="category_id.toString() == 6" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </first-expressed-juice>
                        
                        <last-expressed-juice v-if="category_id.toString() == 7" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </last-expressed-juice>
                        
                        <mixed-juice v-if="category_id.toString() == 8" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </mixed-juice>

                        <clarification v-if="category_id.toString() == 9" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </clarification>

                        <syrup v-if="category_id.toString() == 10" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </syrup>

                        <bagasse v-if="category_id.toString() == 11" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </bagasse>

                        <filter-cake v-if="category_id.toString() == 12" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </filter-cake>

                        <molasses v-if="category_id.toString() == 13" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </molasses>

                        <non-sugar v-if="category_id.toString() == 14" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </non-sugar>

                        <cap-utilization v-if="category_id.toString() == 15" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </cap-utilization>

                        <milling-plant v-if="category_id.toString() == 16" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </milling-plant>

                        <bhr v-if="category_id.toString() == 17" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </bhr>

                        <oar v-if="category_id.toString() == 18" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </oar>

                        <bh-loss v-if="category_id.toString() == 19" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </bh-loss>

                        <kg-sugar-due-bh v-if="category_id.toString() == 20" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </kg-sugar-due-bh>

                        <kg-sugar-due-clean-cane v-if="category_id.toString() == 21" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </kg-sugar-due-clean-cane>

                        <potential-revenue v-if="category_id.toString() == 22" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </potential-revenue>

                        <milling-duration v-if="category_id.toString() == 23" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </milling-duration>

                        <grind-stoppage v-if="category_id.toString() == 24" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </grind-stoppage>

                        <detail-of-stoppage-a v-if="category_id.toString() == 25" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </detail-of-stoppage-a>

                        <detail-of-stoppage-b v-if="category_id.toString() == 26" :collection="collection" :regions="regions" :crop_year="crop_year_id.label">
                        </detail-of-stoppage-b>

                    </div>

                </div>


            </div>

        </div>

    </div>

</template>




<script>

    import Utils from '../utils';

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {

        mixins: [ Utils ],

        data() {

            return {

                regions : {},
                categories : {},
                crop_years : [],
                crop_year_id : '',
                category_id : [],

                collection : {},
                
            }

        },



        created() {
            
            this.getAllMills();
            this.getAllSynOutputCategories();
            this.getAllSynOutputRegions();
        
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


            getAllSynOutputRegions(){ 
               axios.get('synopsis/outputs/get_regions')
                    .then((response) => {
                       this.regions = response.data;
                    }); 
            },


            filter(){
                
                let loader = this.$loading.show({
                  container: this.$refs.dataBody,
                  canCancel: true,
                  onCancel: this.onCancel,
                  opacity: 1,
                  transition: null,
                  width: 60,
                  height: 60,
                });

               axios.get('synopsis/outputs/filter', { params: { cy: this.crop_year_id?.code, cat: this.category_id.toString()} })
                    .then((response) => {
                        this.collection = response.data;
                        loader.hide();
                    })
                    .catch((error) =>{
                        this.$toast.error('Cannot Process! Error occurred.', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        })
                    }); 

            },


            exportExcel(){

                let url = window.location.origin+'/dashboard/synopsis/outputs/export_excel?cy_id='+this.crop_year_id?.code+'&cy_name='+this.crop_year_id?.label+'&cat='+this.category_id.toString();
                window.open(url, '_blank');

            },


            print(){

                let url = window.location.origin+'/dashboard/synopsis/outputs/print?cy_id='+this.crop_year_id?.code+'&cy_name='+this.crop_year_id?.label+'&cat='+this.category_id.toString();
                window.open(url, '_blank');

            },


        },



    }

</script>