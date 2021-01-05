

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

                        <div class="form-group col-md-12" v-bind:class="error.area_harvested ? 'has-error' : ''">
                            <label for="area_harvested">Area Harvested</label>
                            <number-format decimals="2" v-model="area_harvested" class="form-control" placeholder="Area Harvested"/>
                            <p v-if="error.area_harvested" class="help-block">{{ error.area_harvested.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.tc_ha ? 'has-error' : ''">
                            <label for="tc_ha">TC/Ha</label>
                            <number-format decimals="2" v-model="tc_ha" class="form-control" placeholder="TC/Ha"/>
                            <p v-if="error.tc_ha" class="help-block">{{ error.tc_ha.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.lkg_tc ? 'has-error' : ''">
                            <label for="lkg_tc">LKg/TC</label>
                            <number-format decimals="2" v-model="lkg_tc" class="form-control" placeholder="LKg/TC"/>
                            <p v-if="error.lkg_tc" class="help-block">{{ error.lkg_tc.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.lkg_ha ? 'has-error' : ''">
                            <label for="lkg_ha">LKg/Ha</label>
                            <number-format decimals="2" v-model="lkg_ha" class="form-control" placeholder="LKg/Ha"/>
                            <p v-if="error.lkg_ha" class="help-block">{{ error.lkg_ha.toString() }}</p>
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

    import EventBus from '../../SynTenYrAgriParamMain';
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
                area_harvested: "",
                tc_ha: "",
                lkg_tc: "",
                lkg_ha: "",

            }

        },



        created() {

            EventBus.$on('OPEN_TEN_YR_AGRI_PARAM_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/ten_yr_agri_param/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    area_harvested: this.area_harvested, 
                    tc_ha: this.tc_ha, 
                    lkg_tc: this.lkg_tc, 
                    lkg_ha: this.lkg_ha, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.area_harvested = '';
                        this.tc_ha = '';
                        this.lkg_tc = '';
                        this.lkg_ha = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('TEN_YR_AGRI_PARAM_UPDATE_LIST', {'key': response.data.key});

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