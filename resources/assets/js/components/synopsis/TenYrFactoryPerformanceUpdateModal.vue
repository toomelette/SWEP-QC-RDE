

<template>

    <div class="modal fade" id="update_modal" data-backdrop="static">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">


            <div class="modal-header">
              <button class="close" data-dismiss="modal" style="padding:5px;">
              </button>
              <h4 class="modal-title">
                <i class="glyphicon glyphicon-pencil"></i> Edit
                <div class="pull-right">
                    <code>Fields with asterisks(*) are required</code>
                </div> 
              </h4>
            </div>


            <form @submit.prevent="update" ref="update_form">
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" v-model="update_key">

                        <!-- crop year -->
                        <div class="form-group col-md-12" v-bind:class="error.crop_year_id ? 'has-error' : ''">
                            <label for="crop_year_id">Crop Year *</label>
                            <v-select v-model="crop_year_id" :options="crop_years"/>
                            <p v-if="error.crop_year_id" class="help-block">{{ error.crop_year_id.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.rated_capacity ? 'has-error' : ''">
                            <label for="rated_capacity">Rated Capacity (TCD)</label>
                            <number-format decimals="2" v-model="rated_capacity" class="form-control" placeholder="Rated Capacity (TCD)"/>
                            <p v-if="error.rated_capacity" class="help-block">{{ error.rated_capacity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.cap_utilization ? 'has-error' : ''">
                            <label for="cap_utilization">Capacity Utilization (%)</label>
                            <number-format decimals="2" v-model="cap_utilization" class="form-control" placeholder="Capacity Utilization (%)"/>
                            <p v-if="error.cap_utilization" class="help-block">{{ error.cap_utilization.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.pol_extraction ? 'has-error' : ''">
                            <label for="pol_extraction">POL Extraction (%)</label>
                            <number-format decimals="2" v-model="pol_extraction" class="form-control" placeholder="POL Extraction (%)"/>
                            <p v-if="error.pol_extraction" class="help-block">{{ error.pol_extraction.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.actual_bhr ? 'has-error' : ''">
                            <label for="actual_bhr">Actual Boiling House Recovery (%)</label>
                            <number-format decimals="2" v-model="actual_bhr" class="form-control" placeholder="Actual Boiling House Recovery (%)"/>
                            <p v-if="error.actual_bhr" class="help-block">{{ error.actual_bhr.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.reduced_overall_recovery ? 'has-error' : ''">
                            <label for="reduced_overall_recovery">Reduced Overall Recovery (%)</label>
                            <number-format decimals="2" v-model="reduced_overall_recovery" class="form-control" placeholder="Reduced Overall Recovery (%)"/>
                            <p v-if="error.reduced_overall_recovery" class="help-block">{{ error.reduced_overall_recovery.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.ave_num_of_grinding ? 'has-error' : ''">
                            <label for="ave_num_of_grinding">Ave. Number of Grinding Days</label>
                            <number-format decimals="2" v-model="ave_num_of_grinding" class="form-control" placeholder="Ave. Number of Grinding Days"/>
                            <p v-if="error.ave_num_of_grinding" class="help-block">{{ error.ave_num_of_grinding.toString() }}</p>
                        </div>
                        
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" @click="closeModal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>     
            </form>
            

          </div>
        </div>
      </div>

</template>




<script>

    import EventBus from '../../SynTenYrFactoryPerformanceMain';
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
                update_key:"",
                crop_year_id: {},
                rated_capacity: "",
                cap_utilization: "",
                pol_extraction: "",
                actual_bhr: "",
                reduced_overall_recovery: "",
                ave_num_of_grinding: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_TEN_YR_FACTORY_PERFORMANCE_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/ten_yr_factory_performance/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let ten_yr_factory_performance = response.data.data;
                            this.update_key = ten_yr_factory_performance.slug;
                            this.crop_year_id =  { code:ten_yr_factory_performance.crop_year.crop_year_id, label:ten_yr_factory_performance.crop_year.name };
                            this.rated_capacity =  this.utilCheckFloat(ten_yr_factory_performance.rated_capacity);
                            this.cap_utilization =  this.utilCheckFloat(ten_yr_factory_performance.cap_utilization);
                            this.pol_extraction =  this.utilCheckFloat(ten_yr_factory_performance.pol_extraction);
                            this.actual_bhr =  this.utilCheckFloat(ten_yr_factory_performance.actual_bhr);
                            this.reduced_overall_recovery =  this.utilCheckFloat(ten_yr_factory_performance.reduced_overall_recovery);
                            this.ave_num_of_grinding =  this.utilCheckFloat(ten_yr_factory_performance.ave_num_of_grinding);
                        }
                    }); 

            },

            getAllCropYears(){ 
               axios.get('crop_year/get_all')
                    .then((response) => {
                        this.crop_years = this.utilVSelectOptions(response.data, 'crop_year_id', 'name');
                    }); 
            },

            update(){ 
                
                let loader = this.$loading.show({
                  container: this.$refs.update_form,
                  canCancel: true,
                  onCancel: this.onCancel,
                  opacity: 0.7,
                  transition: null,
                  isFullPage:false,
                });

                axios.post('synopsis/ten_yr_factory_performance/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    rated_capacity: this.utilCheckFloat(this.rated_capacity), 
                    cap_utilization: this.utilCheckFloat(this.cap_utilization), 
                    pol_extraction: this.utilCheckFloat(this.pol_extraction), 
                    actual_bhr: this.utilCheckFloat(this.actual_bhr), 
                    reduced_overall_recovery: this.utilCheckFloat(this.reduced_overall_recovery), 
                    ave_num_of_grinding: this.utilCheckFloat(this.ave_num_of_grinding), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('TEN_YR_FACTORY_PERFORMANCE_UPDATE_LIST', {'key': response.data.key});

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