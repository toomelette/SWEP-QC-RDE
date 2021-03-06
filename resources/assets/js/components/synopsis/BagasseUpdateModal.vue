

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

                        <div class="form-group col-md-12" v-bind:class="error.tonnes ? 'has-error' : ''">
                            <label for="tonnes">Tonnes</label>
                            <number-format decimals="2" v-model="tonnes" class="form-control" placeholder="Tonnes"/>
                            <p v-if="error.tonnes" class="help-block">{{ error.tonnes.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_on_cane ? 'has-error' : ''">
                            <label for="percent_on_cane">Percent on Cane</label>
                            <number-format decimals="2" v-model="percent_on_cane" class="form-control" placeholder="Percent on Cane"/>
                            <p v-if="error.percent_on_cane" class="help-block">{{ error.percent_on_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_pol ? 'has-error' : ''">
                            <label for="percent_pol">Percent POL</label>
                            <number-format decimals="2" v-model="percent_pol" class="form-control" placeholder="Percent POL"/>
                            <p v-if="error.percent_pol" class="help-block">{{ error.percent_pol.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_moisture ? 'has-error' : ''">
                            <label for="percent_moisture">Percent MOISTURE</label>
                            <number-format decimals="2" v-model="percent_moisture" class="form-control" placeholder="Percent MOISTURE"/>
                            <p v-if="error.percent_moisture" class="help-block">{{ error.percent_moisture.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_fiber ? 'has-error' : ''">
                            <label for="percent_fiber">Percent FIBER</label>
                            <number-format decimals="2" v-model="percent_fiber" class="form-control" placeholder="Percent FIBER"/>
                            <p v-if="error.percent_fiber" class="help-block">{{ error.percent_fiber.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.calorific_value ? 'has-error' : ''">
                            <label for="calorific_value">Calorific Value</label>
                            <number-format decimals="2" v-model="calorific_value" class="form-control" placeholder="Calorific Value"/>
                            <p v-if="error.calorific_value" class="help-block">{{ error.calorific_value.toString() }}</p>
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

    import EventBus from '../../SynBagasseMain';
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
                tonnes: "",
                percent_on_cane: "",
                percent_pol: "",
                percent_moisture: "", 
                percent_fiber: "",
                calorific_value: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_BAGASSE_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/bagasse/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let bagasse = response.data.data;
                            this.update_key = bagasse.slug;
                            this.crop_year_id =  { code:bagasse.crop_year.crop_year_id, label:bagasse.crop_year.name };
                            this.mill_id = { code:bagasse.mill.mill_id, label:bagasse.mill.name };
                            this.tonnes =  this.utilCheckFloat(bagasse.tonnes);
                            this.percent_on_cane =  this.utilCheckFloat(bagasse.percent_on_cane);
                            this.percent_pol =  this.utilCheckFloat(bagasse.percent_pol);
                            this.percent_moisture =  this.utilCheckFloat(bagasse.percent_moisture);
                            this.percent_fiber =  this.utilCheckFloat(bagasse.percent_fiber);
                            this.calorific_value =  this.utilCheckFloat(bagasse.calorific_value);
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

                axios.post('synopsis/bagasse/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    tonnes: this.utilCheckFloat(this.tonnes), 
                    percent_on_cane: this.utilCheckFloat(this.percent_on_cane), 
                    percent_pol: this.utilCheckFloat(this.percent_pol), 
                    percent_moisture: this.utilCheckFloat(this.percent_moisture), 
                    percent_fiber: this.utilCheckFloat(this.percent_fiber), 
                    calorific_value: this.utilCheckFloat(this.calorific_value), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('BAGASSE_UPDATE_LIST', {'key': response.data.key});

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