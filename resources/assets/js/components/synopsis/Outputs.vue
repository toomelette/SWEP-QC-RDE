

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
                    <cane-sugar-tons-output-format v-if="category_id.toString() == 1" 
                                                  :collection="collection" 
                                                  :regions="regions" 
                                                  :crop_year="crop_year_id.label">
                    </cane-sugar-tons-output-format>
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


            getAllSynOutputRegions(){ 
               axios.get('synopsis/outputs/get_regions')
                    .then((response) => {
                       this.regions = response.data;
                    }); 
            },


            filter(){

               axios.get('synopsis/outputs/filter', { params: { cy: this.crop_year_id?.code, cat: this.category_id.toString()} })
                    .then((response) => {
                       this.collection = response.data;
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


        },



    }

</script>