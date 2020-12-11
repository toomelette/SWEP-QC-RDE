

<template>

    <div class="modal fade" id="create_modal" data-backdrop="static">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">


            <div class="modal-header">
              <button class="close" data-dismiss="modal" style="padding:5px;">
              </button>
              <h4 class="modal-title">
                <i class="glyphicon glyphicon-floppy-disk"></i> Create
                <div class="pull-right">
                    <code>Fields with asterisks(*) are required</code>
                </div> 
              </h4>
            </div>


            <form @submit.prevent="store" ref="create_form">
                <div class="modal-body">
                    <div class="row">

                        <!-- crop year -->
                        <div class="form-group col-md-6" v-bind:class="error.crop_year_id ? 'has-error' : ''">
                            <label for="crop_year_id">Crop Year *</label>
                            <v-select v-model="crop_year_id" :options="crop_years"/>
                            <p v-if="error.crop_year_id" class="help-block">{{ error.crop_year_id.toString() }}</p>
                        </div>

                        <!-- mills -->
                        <div class="form-group col-md-6" v-bind:class="error.mill_id ? 'has-error' : ''">
                            <label for="mill_id">Mill *</label>
                            <v-select v-model="mill_id" :options="mills"/>
                            <p v-if="error.mill_id" class="help-block">{{ error.mill_id.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.burnt_cane_percent ? 'has-error' : ''">
                            <label for="burnt_cane_percent">Burnt Cane Percent Gross Cane</label>
                            <number-format decimals="2" v-model="burnt_cane_percent" class="form-control" placeholder="Burnt Cane Percent Gross Cane"/>
                            <p v-if="error.burnt_cane_percent" class="help-block">{{ error.burnt_cane_percent.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.quality_ratio ? 'has-error' : ''">
                            <label for="quality_ratio">Quality Ratio (TC/TS)</label>
                            <number-format decimals="2" v-model="quality_ratio" class="form-control" placeholder="Quality Ratio (TC/TS)"/>
                            <p v-if="error.quality_ratio" class="help-block">{{ error.quality_ratio.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.rendement ? 'has-error' : ''">
                            <label for="rendement">Rendement (Lkg/TC)</label>
                            <number-format decimals="2" v-model="rendement" class="form-control" placeholder="Rendement (Lkg/TC)"/>  
                            <p v-if="error.rendement" class="help-block">{{ error.rendement.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.total_sugar_recovered ? 'has-error' : ''">
                            <label for="total_sugar_recovered">Total Sugar Recovered (% Cane)</label>
                            <number-format decimals="2" v-model="total_sugar_recovered" class="form-control" placeholder="Total Sugar Recovered (% Cane)"/>
                            <p v-if="error.total_sugar_recovered" class="help-block">{{ error.total_sugar_recovered.toString() }}</p>
                        </div>
                        
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" @click="closeModal()">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>     
            </form>
            

          </div>
        </div>
      </div>

</template>




<script>

    import EventBus from '../../SynRatiosOnGrossCaneMain';
    import Utils from '../utils';

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import 'vue-loading-overlay/dist/vue-loading.css';


    export default { 


        mixins: [ Utils ],


        data() {

            return {

                mills : [],
                crop_years : [],
                error:[],

                // fields
                crop_year_id: {},
                mill_id: {},
                burnt_cane_percent: "",
                quality_ratio: "",
                rendement: "",
                total_sugar_recovered: "",

            }

        },



        created() {

            EventBus.$on('OPEN_RATIOS_ON_GROSS_CANE_CREATE_MODAL', (data) => {
                this.showModal();
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(){ 
                $("#create_modal").modal("show");
            },

            getAllMills(){ 
               axios.get('mill/get_all')
                    .then((response) => {
                       this.mills = this.utilVSelectOptions(response.data, 'mill_id', 'name');
                    }); 
            },

            getAllCropYears(){ 
               axios.get('crop_year/get_all')
                    .then((response) => {
                        this.crop_years = this.utilVSelectOptions(response.data, 'crop_year_id', 'name');
                    }); 
            },

            store(){ 
                
                let loader = this.$loading.show({
                  container: this.$refs.create_form,
                  canCancel: true,
                  onCancel: this.onCancel,
                  opacity: 0.7,
                  transition: null,
                  isFullPage:false,
                });

                axios.post('synopsis/ratios_on_gross_cane/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    burnt_cane_percent: this.burnt_cane_percent, 
                    quality_ratio: this.quality_ratio, 
                    rendement: this.rendement, 
                    total_sugar_recovered: this.total_sugar_recovered,

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.burnt_cane_percent = '';
                        this.quality_ratio = '';
                        this.rendement = '';
                        this.total_sugar_recovered = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('RATIOS_ON_GROSS_CANE_UPDATE_LIST', {'key': response.data.key});

                        loader.hide();

                    }else{
                        
                        this.$toast.error('Unable to send data!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        loader.hide();

                    }

                })
                .catch((error) => {

                    if (error.response?.status == 422){
                        this.error = error.response.data.errors;
                    }

                    loader.hide();
                    
                });

            },

            closeModal(){ 
                this.error = [];
            },



        },



    }

</script>