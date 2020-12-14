

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

                        <div class="form-group col-md-12" v-bind:class="error.percent_pol ? 'has-error' : ''">
                            <label for="percent_pol">PERCENT POL</label>
                            <number-format decimals="2" v-model="percent_pol" class="form-control" placeholder="PERCENT POL"/>
                            <p v-if="error.percent_pol" class="help-block">{{ error.percent_pol.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_sucrose ? 'has-error' : ''">
                            <label for="percent_sucrose">PERCENT SUCROSE</label>
                            <number-format decimals="2" v-model="percent_sucrose" class="form-control" placeholder="PERCENT SUCROSE"/>
                            <p v-if="error.percent_sucrose" class="help-block">{{ error.percent_sucrose.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_fiber ? 'has-error' : ''">
                            <label for="percent_fiber">PERCENT FIBER</label>
                            <number-format decimals="2" v-model="percent_fiber" class="form-control" placeholder="PERCENT FIBER"/>
                            <p v-if="error.percent_fiber" class="help-block">{{ error.percent_fiber.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_trash ? 'has-error' : ''">
                            <label for="percent_trash">PERCENT TRASH</label>
                            <number-format decimals="2" v-model="percent_trash" class="form-control" placeholder="PERCENT TRASH"/>
                            <p v-if="error.percent_trash" class="help-block">{{ error.percent_trash.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.pol_percent_fiber ? 'has-error' : ''">
                            <label for="pol_percent_fiber">POL PERCENT FIBER</label>
                            <number-format decimals="2" v-model="pol_percent_fiber" class="form-control" placeholder="POL PERCENT FIBER"/>
                            <p v-if="error.pol_percent_fiber" class="help-block">{{ error.pol_percent_fiber.toString() }}</p>
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

    import EventBus from '../../SynCaneAnalysisMain';
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
                percent_pol: "",
                percent_sucrose: "",
                percent_fiber: "",
                percent_trash: "", 
                pol_percent_fiber: "",

            }

        },



        created() {

            EventBus.$on('OPEN_CANE_ANALYSIS_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/cane_analysis/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    percent_pol: this.percent_pol, 
                    percent_sucrose: this.percent_sucrose, 
                    percent_fiber: this.percent_fiber, 
                    percent_trash: this.percent_trash,
                    pol_percent_fiber: this.pol_percent_fiber, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.percent_pol = '';
                        this.percent_sucrose = '';
                        this.percent_fiber = '';
                        this.percent_trash = '';
                        this.pol_percent_fiber = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('CANE_ANALYSIS_UPDATE_LIST', {'key': response.data.key});

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