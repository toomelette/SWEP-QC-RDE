

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

                        <div class="form-group col-md-12" v-bind:class="error.normal_rate_cap ? 'has-error' : ''">
                            <label for="normal_rate_cap">Normal Rate Capacity (TCD)</label>
                            <number-format decimals="2" v-model="normal_rate_cap" class="form-control" placeholder="Normal Rate Capacity (TCD)"/>
                            <p v-if="error.normal_rate_cap" class="help-block">{{ error.normal_rate_cap.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.tonnes_cane_per_hr ? 'has-error' : ''">
                            <label for="tonnes_cane_per_hr">Tonnes Cane per Hour</label>
                            <number-format decimals="2" v-model="tonnes_cane_per_hr" class="form-control" placeholder="Tonnes Cane per Hour"/>
                            <p v-if="error.tonnes_cane_per_hr" class="help-block">{{ error.tonnes_cane_per_hr.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.ave_hr_actual_grinding ? 'has-error' : ''">
                            <label for="ave_hr_actual_grinding">Ave. Hours Actual Grinding / Hour</label>
                            <number-format decimals="2" v-model="ave_hr_actual_grinding" class="form-control" placeholder="Ave. Hours Actual Grinding / Hour"/>
                            <p v-if="error.ave_hr_actual_grinding" class="help-block">{{ error.ave_hr_actual_grinding.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.cap_utilization ? 'has-error' : ''">
                            <label for="cap_utilization">Capacity Utilization</label>
                            <number-format decimals="2" v-model="cap_utilization" class="form-control" placeholder="Capacity Utilization"/>
                            <p v-if="error.cap_utilization" class="help-block">{{ error.cap_utilization.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.mechanical_time_eff ? 'has-error' : ''">
                            <label for="mechanical_time_eff">Mechanical Time Efficiency</label>
                            <number-format decimals="2" v-model="mechanical_time_eff" class="form-control" placeholder="Mechanical Time Efficiency"/>
                            <p v-if="error.mechanical_time_eff" class="help-block">{{ error.mechanical_time_eff.toString() }}</p>
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

    import EventBus from '../../SynCapUtilizationMain';
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
                normal_rate_cap: "",
                tonnes_cane_per_hr: "",
                ave_hr_actual_grinding: "",
                cap_utilization: "", 
                mechanical_time_eff: "",

            }

        },



        created() {

            EventBus.$on('OPEN_CAP_UTILIZATION_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/cap_utilization/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    normal_rate_cap: this.normal_rate_cap, 
                    tonnes_cane_per_hr: this.tonnes_cane_per_hr, 
                    ave_hr_actual_grinding: this.ave_hr_actual_grinding, 
                    cap_utilization: this.cap_utilization,
                    mechanical_time_eff: this.mechanical_time_eff, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.normal_rate_cap = '';
                        this.tonnes_cane_per_hr = '';
                        this.ave_hr_actual_grinding = '';
                        this.cap_utilization = '';
                        this.mechanical_time_eff = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('CAP_UTILIZATION_UPDATE_LIST', {'key': response.data.key});

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