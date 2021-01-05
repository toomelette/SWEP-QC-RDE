

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
                        <div class="form-group col-md-12" v-bind:class="error.crop_year_id ? 'has-error' : ''">
                            <label for="crop_year_id">Crop Year *</label>
                            <v-select v-model="crop_year_id" :options="crop_years"/>
                            <p v-if="error.crop_year_id" class="help-block">{{ error.crop_year_id.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.imbibition_fiber_ratio ? 'has-error' : ''">
                            <label for="imbibition_fiber_ratio">Imbibition Fiber Ratio</label>
                            <number-format decimals="2" v-model="imbibition_fiber_ratio" class="form-control" placeholder="Imbibition Fiber Ratio"/>
                            <p v-if="error.imbibition_fiber_ratio" class="help-block">{{ error.imbibition_fiber_ratio.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.rendement ? 'has-error' : ''">
                            <label for="rendement">Rendement (LKg/TC)</label>
                            <number-format decimals="2" v-model="rendement" class="form-control" placeholder="Rendement (LKg/TC)"/>
                            <p v-if="error.rendement" class="help-block">{{ error.rendement.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.quality_ratio ? 'has-error' : ''">
                            <label for="quality_ratio">Quality Ratio (TC/TS)</label>
                            <number-format decimals="2" v-model="quality_ratio" class="form-control" placeholder="Quality Ratio (TC/TS)"/>
                            <p v-if="error.quality_ratio" class="help-block">{{ error.quality_ratio.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.kg_mollasses_per_ton_cane ? 'has-error' : ''">
                            <label for="kg_mollasses_per_ton_cane">Kg Molasses per tonne of cane</label>
                            <number-format decimals="2" v-model="kg_mollasses_per_ton_cane" class="form-control" placeholder="Kg Molasses per tonne of cane"/>
                            <p v-if="error.kg_mollasses_per_ton_cane" class="help-block">{{ error.kg_mollasses_per_ton_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.kg_bagasse_per_ton_cane ? 'has-error' : ''">
                            <label for="kg_bagasse_per_ton_cane">Kg Bagasse per tonne of cane</label>
                            <number-format decimals="2" v-model="kg_bagasse_per_ton_cane" class="form-control" placeholder="Kg Bagasse per tonne of cane"/>
                            <p v-if="error.kg_bagasse_per_ton_cane" class="help-block">{{ error.kg_bagasse_per_ton_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.kg_fc_per_ton_cane ? 'has-error' : ''">
                            <label for="kg_fc_per_ton_cane">Kg Filter Cake per tonne of cane</label>
                            <number-format decimals="2" v-model="kg_fc_per_ton_cane" class="form-control" placeholder="Kg Filter Cake per tonne of cane"/>
                            <p v-if="error.kg_fc_per_ton_cane" class="help-block">{{ error.kg_fc_per_ton_cane.toString() }}</p>
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

    import EventBus from '../../SynTenYrRatioYieldMain';
    import Utils from '../utils';

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import 'vue-loading-overlay/dist/vue-loading.css';


    export default { 


        mixins: [ Utils ],


        data() {

            return {

                crop_years : [],
                error:[],

                // fields
                crop_year_id: {},
                imbibition_fiber_ratio: "",
                rendement: "",
                quality_ratio: "",
                kg_mollasses_per_ton_cane: "",
                kg_bagasse_per_ton_cane: "",
                kg_fc_per_ton_cane: "",

            }

        },



        created() {

            EventBus.$on('OPEN_TEN_YR_RATIO_YIELD_CREATE_MODAL', (data) => {
                this.showModal();
            });

            this.getAllCropYears();

        },



        methods: {

            showModal(){ 
                $("#create_modal").modal("show");
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

                axios.post('synopsis/ten_yr_ratio_yield/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    imbibition_fiber_ratio: this.imbibition_fiber_ratio, 
                    rendement: this.rendement, 
                    quality_ratio: this.quality_ratio, 
                    kg_mollasses_per_ton_cane: this.kg_mollasses_per_ton_cane, 
                    kg_bagasse_per_ton_cane: this.kg_bagasse_per_ton_cane, 
                    kg_fc_per_ton_cane: this.kg_fc_per_ton_cane, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.imbibition_fiber_ratio = '';
                        this.rendement = '';
                        this.quality_ratio = '';
                        this.kg_mollasses_per_ton_cane = '';
                        this.kg_bagasse_per_ton_cane = '';
                        this.kg_fc_per_ton_cane = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('TEN_YR_RATIO_YIELD_UPDATE_LIST', {'key': response.data.key});

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