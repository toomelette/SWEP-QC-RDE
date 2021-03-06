

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

                        <div class="form-group col-md-12" v-bind:class="error.filtered_juice ? 'has-error' : ''">
                            <label for="filtered_juice">AP - Filtered Juice</label>
                            <number-format decimals="2" v-model="filtered_juice" class="form-control" placeholder="AP - Filtered Juice"/>
                            <p v-if="error.filtered_juice" class="help-block">{{ error.filtered_juice.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.purity_drop ? 'has-error' : ''">
                            <label for="purity_drop">Purity Drop (CJ to FJ)</label>
                            <number-format decimals="2" v-model="purity_drop" class="form-control" placeholder="Purity Drop (CJ to FJ)"/>
                            <p v-if="error.purity_drop" class="help-block">{{ error.purity_drop.toString() }}</p>
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

    import EventBus from '../../SynFilterCakeMain';
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
                tonnes: "",
                percent_on_cane: "",
                percent_pol: "",
                percent_moisture: "", 
                filtered_juice: "",
                purity_drop: "",

            }

        },



        created() {

            EventBus.$on('OPEN_FILTER_CAKE_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/filter_cake/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    tonnes: this.tonnes, 
                    percent_on_cane: this.percent_on_cane, 
                    percent_pol: this.percent_pol, 
                    percent_moisture: this.percent_moisture,
                    filtered_juice: this.filtered_juice, 
                    purity_drop: this.purity_drop, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.tonnes = '';
                        this.percent_on_cane = '';
                        this.percent_pol = '';
                        this.percent_moisture = '';
                        this.filtered_juice = '';
                        this.purity_drop = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('FILTER_CAKE_UPDATE_LIST', {'key': response.data.key});

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