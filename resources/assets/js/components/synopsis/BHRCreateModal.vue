

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

                        <div class="form-group col-md-12" v-bind:class="error.actual_bhr ? 'has-error' : ''">
                            <label for="actual_bhr">Actual BHR</label>
                            <number-format decimals="2" v-model="actual_bhr" class="form-control" placeholder="Actual BHR"/>
                            <p v-if="error.actual_bhr" class="help-block">{{ error.actual_bhr.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.theoritical_bhr ? 'has-error' : ''">
                            <label for="theoritical_bhr">Theoritical BHR</label>
                            <number-format decimals="2" v-model="theoritical_bhr" class="form-control" placeholder="Theoritical BHR"/>
                            <p v-if="error.theoritical_bhr" class="help-block">{{ error.theoritical_bhr.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.basic_bhr ? 'has-error' : ''">
                            <label for="basic_bhr">Basic BHR</label>
                            <number-format decimals="2" v-model="basic_bhr" class="form-control" placeholder="Basic BHR"/>
                            <p v-if="error.basic_bhr" class="help-block">{{ error.basic_bhr.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.reduced_bhr ? 'has-error' : ''">
                            <label for="reduced_bhr">Reduced BHR</label>
                            <number-format decimals="2" v-model="reduced_bhr" class="form-control" placeholder="Reduced BHR"/>
                            <p v-if="error.reduced_bhr" class="help-block">{{ error.reduced_bhr.toString() }}</p>
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

    import EventBus from '../../SynBHRMain';
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
                actual_bhr: "",
                theoritical_bhr: "",
                basic_bhr: "",
                reduced_bhr: "", 

            }

        },



        created() {

            EventBus.$on('OPEN_BHR_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/bhr/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    actual_bhr: this.actual_bhr, 
                    theoritical_bhr: this.theoritical_bhr, 
                    basic_bhr: this.basic_bhr, 
                    reduced_bhr: this.reduced_bhr,

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.actual_bhr = '';
                        this.theoritical_bhr = '';
                        this.basic_bhr = '';
                        this.reduced_bhr = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('BHR_UPDATE_LIST', {'key': response.data.key});

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