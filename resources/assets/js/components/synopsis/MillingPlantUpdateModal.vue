

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

                        <div class="form-group col-md-6" v-bind:class="error.extraction_equipment ? 'has-error' : ''">
                            <label for="extraction_equipment">Milling Plant Extraction Eqiupment</label>
                            <input type="text" v-model="extraction_equipment" class="form-control" placeholder="Milling Plant Extraction Eqiupment"/>
                            <p v-if="error.extraction_equipment" class="help-block">{{ error.extraction_equipment.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.imbibition_percent_fiber ? 'has-error' : ''">
                            <label for="imbibition_percent_fiber">Imbibition Percent Fiber</label>
                            <number-format decimals="2" v-model="imbibition_percent_fiber" class="form-control" placeholder="Imbibition Percent Fiber"/>
                            <p v-if="error.imbibition_percent_fiber" class="help-block">{{ error.imbibition_percent_fiber.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.imbibition_percent_cane ? 'has-error' : ''">
                            <label for="imbibition_percent_cane">Imbibition Percent Cane</label>
                            <number-format decimals="2" v-model="imbibition_percent_cane" class="form-control" placeholder="Imbibition Percent Cane"/>
                            <p v-if="error.imbibition_percent_cane" class="help-block">{{ error.imbibition_percent_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.pol ? 'has-error' : ''">
                            <label for="pol">Extraction - POL</label>
                            <number-format decimals="2" v-model="pol" class="form-control" placeholder="Extraction - POL"/>
                            <p v-if="error.pol" class="help-block">{{ error.pol.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.sucrose ? 'has-error' : ''">
                            <label for="sucrose">Extraction - SUCROSE</label>
                            <number-format decimals="2" v-model="sucrose" class="form-control" placeholder="Extraction - SUCROSE"/>
                            <p v-if="error.sucrose" class="help-block">{{ error.sucrose.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.reduced ? 'has-error' : ''">
                            <label for="reduced">Extraction - REDUCED</label>
                            <number-format decimals="2" v-model="reduced" class="form-control" placeholder="Extraction - REDUCED"/>
                            <p v-if="error.reduced" class="help-block">{{ error.reduced.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.whole_reduced ? 'has-error' : ''">
                            <label for="whole_reduced">Extraction - WHOLE REDUCED</label>
                            <number-format decimals="2" v-model="whole_reduced" class="form-control" placeholder="Extraction - WHOLE REDUCED"/>
                            <p v-if="error.whole_reduced" class="help-block">{{ error.whole_reduced.toString() }}</p>
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

    import EventBus from '../../SynMillingPlantMain';
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
                extraction_equipment: "",
                imbibition_percent_fiber: "",
                imbibition_percent_cane: "", 
                pol: "",
                sucrose: "",
                reduced: "",
                whole_reduced: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_MILLING_PLANT_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/milling_plant/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let milling_plant = response.data.data;
                            this.update_key = milling_plant.slug;
                            this.crop_year_id =  { code:milling_plant.crop_year.crop_year_id, label:milling_plant.crop_year.name };
                            this.mill_id = { code:milling_plant.mill.mill_id, label:milling_plant.mill.name };
                            this.extraction_equipment =  this.utilCheckFloat(milling_plant.extraction_equipment);
                            this.imbibition_percent_fiber =  this.utilCheckFloat(milling_plant.imbibition_percent_fiber);
                            this.imbibition_percent_cane =  this.utilCheckFloat(milling_plant.imbibition_percent_cane);
                            this.pol =  this.utilCheckFloat(milling_plant.pol);
                            this.sucrose =  this.utilCheckFloat(milling_plant.sucrose);
                            this.reduced =  this.utilCheckFloat(milling_plant.reduced);
                            this.whole_reduced =  this.utilCheckFloat(milling_plant.whole_reduced);
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

                axios.post('synopsis/milling_plant/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    extraction_equipment: this.utilCheckFloat(this.extraction_equipment), 
                    imbibition_percent_fiber: this.utilCheckFloat(this.imbibition_percent_fiber), 
                    imbibition_percent_cane: this.utilCheckFloat(this.imbibition_percent_cane), 
                    pol: this.utilCheckFloat(this.pol), 
                    sucrose: this.utilCheckFloat(this.sucrose), 
                    reduced: this.utilCheckFloat(this.reduced), 
                    whole_reduced: this.utilCheckFloat(this.whole_reduced), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('MILLING_PLANT_UPDATE_LIST', {'key': response.data.key});

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