

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

                        <div class="form-group col-md-6" v-bind:class="error.tonnes_manufactured ? 'has-error' : ''">
                            <label for="tonnes_manufactured">Tonnes Manufactured</label>
                            <number-format decimals="2" v-model="tonnes_manufactured" class="form-control" placeholder="Tonnes Manufactured"/>
                            <p v-if="error.tonnes_manufactured" class="help-block">{{ error.tonnes_manufactured.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.tonnes_due_cane ? 'has-error' : ''">
                            <label for="tonnes_due_cane">Tonnes Due Cane</label>
                            <number-format decimals="2" v-model="tonnes_due_cane" class="form-control" placeholder="Tonnes Due Cane"/>
                            <p v-if="error.tonnes_due_cane" class="help-block">{{ error.tonnes_due_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_on_cane ? 'has-error' : ''">
                            <label for="percent_on_cane">Percent on Cane</label>
                            <number-format decimals="2" v-model="percent_on_cane" class="form-control" placeholder="Percent on Cane"/>
                            <p v-if="error.percent_on_cane" class="help-block">{{ error.percent_on_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.brix ? 'has-error' : ''">
                            <label for="brix">Brix</label>
                            <number-format decimals="2" v-model="brix" class="form-control" placeholder="Brix"/>
                            <p v-if="error.brix" class="help-block">{{ error.brix.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.apparent_purity ? 'has-error' : ''">
                            <label for="apparent_purity">Apparent Purity</label>
                            <number-format decimals="2" v-model="apparent_purity" class="form-control" placeholder="Apparent Purity"/>
                            <p v-if="error.apparent_purity" class="help-block">{{ error.apparent_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.gravity_purity ? 'has-error' : ''">
                            <label for="gravity_purity">Gravity Purity</label>
                            <number-format decimals="2" v-model="gravity_purity" class="form-control" placeholder="Gravity Purity"/>
                            <p v-if="error.gravity_purity" class="help-block">{{ error.gravity_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_ash ? 'has-error' : ''">
                            <label for="percent_ash">Percent Ash</label>
                            <number-format decimals="2" v-model="percent_ash" class="form-control" placeholder="Percent Ash"/>
                            <p v-if="error.percent_ash" class="help-block">{{ error.percent_ash.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_reducing_sugar ? 'has-error' : ''">
                            <label for="percent_reducing_sugar">Percent Reducing Sugar</label>
                            <number-format decimals="2" v-model="percent_reducing_sugar" class="form-control" placeholder="Percent Reducing Sugar"/>
                            <p v-if="error.percent_reducing_sugar" class="help-block">{{ error.percent_reducing_sugar.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.expected_molasses_purity ? 'has-error' : ''">
                            <label for="expected_molasses_purity">Expected Molasses Purity</label>
                            <number-format decimals="2" v-model="expected_molasses_purity" class="form-control" placeholder="Expected Molasses Purity"/>
                            <p v-if="error.expected_molasses_purity" class="help-block">{{ error.expected_molasses_purity.toString() }}</p>
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

    import EventBus from '../../SynMolassesMain';
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
                tonnes_manufactured: "",
                tonnes_due_cane: "",
                percent_on_cane: "",
                brix: "", 
                apparent_purity: "",
                gravity_purity: "",
                percent_ash: "", 
                percent_reducing_sugar: "",
                expected_molasses_purity: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_MOLASSES_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/molasses/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let molasses = response.data.data;
                            this.update_key = molasses.slug;
                            this.crop_year_id =  { code:molasses.crop_year.crop_year_id, label:molasses.crop_year.name };
                            this.mill_id = { code:molasses.mill.mill_id, label:molasses.mill.name };
                            this.tonnes_manufactured =  this.utilCheckFloat(molasses.tonnes_manufactured);
                            this.tonnes_due_cane =  this.utilCheckFloat(molasses.tonnes_due_cane);
                            this.percent_on_cane =  this.utilCheckFloat(molasses.percent_on_cane);
                            this.brix =  this.utilCheckFloat(molasses.brix);
                            this.apparent_purity =  this.utilCheckFloat(molasses.apparent_purity);
                            this.gravity_purity =  this.utilCheckFloat(molasses.gravity_purity);
                            this.percent_ash =  this.utilCheckFloat(molasses.percent_ash);
                            this.percent_reducing_sugar =  this.utilCheckFloat(molasses.percent_reducing_sugar);
                            this.expected_molasses_purity =  this.utilCheckFloat(molasses.expected_molasses_purity);
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

                axios.post('synopsis/molasses/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    tonnes_manufactured: this.utilCheckFloat(this.tonnes_manufactured), 
                    tonnes_due_cane: this.utilCheckFloat(this.tonnes_due_cane), 
                    percent_on_cane: this.utilCheckFloat(this.percent_on_cane), 
                    brix: this.utilCheckFloat(this.brix), 
                    apparent_purity: this.utilCheckFloat(this.apparent_purity), 
                    gravity_purity: this.utilCheckFloat(this.gravity_purity), 
                    percent_ash: this.utilCheckFloat(this.percent_ash), 
                    percent_reducing_sugar: this.utilCheckFloat(this.percent_reducing_sugar), 
                    expected_molasses_purity: this.utilCheckFloat(this.expected_molasses_purity), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('MOLASSES_UPDATE_LIST', {'key': response.data.key});

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