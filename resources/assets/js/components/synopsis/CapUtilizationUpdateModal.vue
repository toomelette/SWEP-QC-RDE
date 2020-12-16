

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
                    <button class="btn btn-default" data-dismiss="modal" @click="closeModal">Close</button>
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
                update_key:"",
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
            
            EventBus.$on('OPEN_CAP_UTILIZATION_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/cap_utilization/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let cap_utilization = response.data.data;
                            this.update_key = cap_utilization.slug;
                            this.crop_year_id =  { code:cap_utilization.crop_year.crop_year_id, label:cap_utilization.crop_year.name };
                            this.mill_id = { code:cap_utilization.mill.mill_id, label:cap_utilization.mill.name };
                            this.normal_rate_cap =  this.utilCheckFloat(cap_utilization.normal_rate_cap);
                            this.tonnes_cane_per_hr =  this.utilCheckFloat(cap_utilization.tonnes_cane_per_hr);
                            this.ave_hr_actual_grinding =  this.utilCheckFloat(cap_utilization.ave_hr_actual_grinding);
                            this.cap_utilization =  this.utilCheckFloat(cap_utilization.cap_utilization);
                            this.mechanical_time_eff =  this.utilCheckFloat(cap_utilization.mechanical_time_eff);
                        }
                    }); 

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

            update(){ 
                
                let loader = this.$loading.show({
                  container: this.$refs.update_form,
                  canCancel: true,
                  onCancel: this.onCancel,
                  opacity: 0.7,
                  transition: null,
                  isFullPage:false,
                });

                axios.post('synopsis/cap_utilization/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    normal_rate_cap: this.utilCheckFloat(this.normal_rate_cap), 
                    tonnes_cane_per_hr: this.utilCheckFloat(this.tonnes_cane_per_hr), 
                    ave_hr_actual_grinding: this.utilCheckFloat(this.ave_hr_actual_grinding), 
                    cap_utilization: this.utilCheckFloat(this.cap_utilization), 
                    mechanical_time_eff: this.utilCheckFloat(this.mechanical_time_eff),
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
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