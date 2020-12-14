

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

                        <div class="form-group col-md-6" v-bind:class="error.gravity_purity ? 'has-error' : ''">
                            <label for="gravity_purity">Gravity Purity</label>
                            <number-format decimals="2" v-model="gravity_purity" class="form-control" placeholder="Gravity Purity"/>
                            <p v-if="error.gravity_purity" class="help-block">{{ error.gravity_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.apparent_purity ? 'has-error' : ''">
                            <label for="apparent_purity">Apparent Purity</label>
                            <number-format decimals="2" v-model="apparent_purity" class="form-control" placeholder="Apparent Purity"/>
                            <p v-if="error.apparent_purity" class="help-block">{{ error.apparent_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_pol ? 'has-error' : ''">
                            <label for="percent_pol">Percent POL</label>
                            <number-format decimals="2" v-model="percent_pol" class="form-control" placeholder="Percent POL"/>
                            <p v-if="error.percent_pol" class="help-block">{{ error.percent_pol.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_sucrose ? 'has-error' : ''">
                            <label for="percent_sucrose">Percent SUCROSE</label>
                            <number-format decimals="2" v-model="percent_sucrose" class="form-control" placeholder="Percent SUCROSE"/>
                            <p v-if="error.percent_sucrose" class="help-block">{{ error.percent_sucrose.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_moisture ? 'has-error' : ''">
                            <label for="percent_moisture">Percent MOISTURE</label>
                            <number-format decimals="2" v-model="percent_moisture" class="form-control" placeholder="Percent MOISTURE"/>
                            <p v-if="error.percent_moisture" class="help-block">{{ error.percent_moisture.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.di ? 'has-error' : ''">
                            <label for="di">DI</label>
                            <number-format decimals="2" v-model="di" class="form-control" placeholder="DI"/>
                            <p v-if="error.di" class="help-block">{{ error.di.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.clarity_turbidity ? 'has-error' : ''">
                            <label for="clarity_turbidity">Clarity Turbidity</label>
                            <number-format decimals="2" v-model="clarity_turbidity" class="form-control" placeholder="Clarity Turbidity"/>
                            <p v-if="error.clarity_turbidity" class="help-block">{{ error.clarity_turbidity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_ash ? 'has-error' : ''">
                            <label for="percent_ash">Percent ASH</label>
                            <number-format decimals="2" v-model="percent_ash" class="form-control" placeholder="Percent ASH"/>
                            <p v-if="error.percent_ash" class="help-block">{{ error.percent_ash.toString() }}</p>
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

    import EventBus from '../../SynSugarAnalysisMain';
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
                gravity_purity: "",
                apparent_purity: "",
                percent_pol: "",
                percent_sucrose: "", 
                percent_moisture: "",
                di: "",
                clarity_turbidity: "",
                percent_ash: "",

            }

        },



        created() {

            EventBus.$on('OPEN_SUGAR_ANALYSIS_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/sugar_analysis/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    gravity_purity: this.gravity_purity, 
                    apparent_purity: this.apparent_purity, 
                    percent_pol: this.percent_pol, 
                    percent_sucrose: this.percent_sucrose,
                    percent_moisture: this.percent_moisture, 
                    di: this.di,
                    clarity_turbidity: this.clarity_turbidity, 
                    percent_ash: this.percent_ash, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.gravity_purity = '';
                        this.apparent_purity = '';
                        this.percent_pol = '';
                        this.percent_sucrose = '';
                        this.percent_moisture = '';
                        this.di = '';
                        this.clarity_turbidity = '';
                        this.percent_ash = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('SUGAR_ANALYSIS_UPDATE_LIST', {'key': response.data.key});

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