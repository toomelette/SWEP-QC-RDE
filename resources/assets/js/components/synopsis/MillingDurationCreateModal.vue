

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

                        <div class="form-group col-md-6" v-bind:class="error.mill_start ? 'has-error' : ''">
                            <label for="mill_start">Milling Started</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <flat-pickr v-model="mill_start" type="text" class="form-control" :config="flatpcker_config" placeholder="mm/dd/yyyy"></flat-pickr>
                                <p v-if="error.mill_start" class="help-block">{{ error.mill_start.toString() }}</p>
                            </div>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.mill_end ? 'has-error' : ''">
                            <label for="mill_end">Milling Ended</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <flat-pickr v-model="mill_end" type="text" class="form-control" :config="flatpcker_config" placeholder="mm/dd/yyyy"></flat-pickr>
                                <p v-if="error.mill_end" class="help-block">{{ error.mill_end.toString() }}</p>
                            </div>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.crop_length ? 'has-error' : ''">
                            <label for="crop_length">Crop Length</label>
                            <number-format decimals="2" v-model="crop_length" class="form-control" placeholder="Crop Length"/>
                            <p v-if="error.crop_length" class="help-block">{{ error.crop_length.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.tet ? 'has-error' : ''">
                            <label for="tet">Total Elapsed Time (Hours)</label>
                            <number-format decimals="2" v-model="tet" class="form-control" placeholder="Total Elapsed Time (Hours)"/>
                            <p v-if="error.tet" class="help-block">{{ error.tet.toString() }}</p>
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

    import EventBus from '../../SynMillingDurationMain';
    import Utils from '../utils';

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import 'vue-loading-overlay/dist/vue-loading.css';
    import 'flatpickr/dist/flatpickr.css';


    export default { 


        mixins: [ Utils ],


        data() {

            return {

                mills : [],
                crop_years : [],
                error:[],
                flatpcker_config: {
                    altFormat: 'm/d/Y',
                    dateFormat: 'm/d/Y',        
                }, 

                // fields
                crop_year_id: {},
                mill_id: {},
                mill_start: "",
                mill_end: "",
                crop_length: "",
                tet: "", 

            }

        },



        created() {

            EventBus.$on('OPEN_MILLING_DURATION_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/milling_duration/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    mill_start: this.mill_start, 
                    mill_end: this.mill_end, 
                    crop_length: this.crop_length, 
                    tet: this.tet,

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.mill_start = '';
                        this.mill_end = '';
                        this.crop_length = '';
                        this.tet = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('MILLING_DURATION_UPDATE_LIST', {'key': response.data.key});

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