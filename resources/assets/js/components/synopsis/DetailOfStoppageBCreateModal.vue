

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

                        <div class="form-group col-md-6" v-bind:class="error.due_cleaning_hrs ? 'has-error' : ''">
                            <label for="due_cleaning_hrs">Due Cleaning (No. of hrs)</label>
                            <number-format decimals="2" v-model="due_cleaning_hrs" class="form-control" placeholder="Due Cleaning (No. of hrs)"/>
                            <p v-if="error.due_cleaning_hrs" class="help-block">{{ error.due_cleaning_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_cleaning_tet ? 'has-error' : ''">
                            <label for="due_cleaning_tet">Due Cleaning (% on TET)</label>
                            <number-format decimals="2" v-model="due_cleaning_tet" class="form-control" placeholder="Due Cleaning (% on TET)"/>
                            <p v-if="error.due_cleaning_tet" class="help-block">{{ error.due_cleaning_tet.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_no_unavoidable_hrs ? 'has-error' : ''">
                            <label for="due_no_unavoidable_hrs">Due No Unavoidable (No. of hrs)</label>
                            <number-format decimals="2" v-model="due_no_unavoidable_hrs" class="form-control" placeholder="Due No Unavoidable (No. of hrs)"/>
                            <p v-if="error.due_no_unavoidable_hrs" class="help-block">{{ error.due_no_unavoidable_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_no_unavoidable_tet ? 'has-error' : ''">
                            <label for="due_no_unavoidable_tet">Due No Unavoidable (% on TET)</label>
                            <number-format decimals="2" v-model="due_no_unavoidable_tet" class="form-control" placeholder="Due No Unavoidable (% on TET)"/>
                            <p v-if="error.due_no_unavoidable_tet" class="help-block">{{ error.due_no_unavoidable_tet.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_miscellaneous_hrs ? 'has-error' : ''">
                            <label for="due_miscellaneous_hrs">Due Miscellaneous (No. of hrs)</label>
                            <number-format decimals="2" v-model="due_miscellaneous_hrs" class="form-control" placeholder="Due Miscellaneous (No. of hrs)"/>
                            <p v-if="error.due_miscellaneous_hrs" class="help-block">{{ error.due_miscellaneous_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_miscellaneous_tet ? 'has-error' : ''">
                            <label for="due_miscellaneous_tet">Due Miscellaneous (% on TET)</label>
                            <number-format decimals="2" v-model="due_miscellaneous_tet" class="form-control" placeholder="Due Miscellaneous (% on TET)"/>
                            <p v-if="error.due_miscellaneous_tet" class="help-block">{{ error.due_miscellaneous_tet.toString() }}</p>
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

    import EventBus from '../../SynDetailOfStoppageBMain';
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
                due_cleaning_hrs: "",
                due_cleaning_tet: "",
                due_no_unavoidable_hrs: "",
                due_no_unavoidable_tet: "",
                due_miscellaneous_hrs: "",
                due_miscellaneous_tet: "",

            }

        },



        created() {

            EventBus.$on('OPEN_DETAIL_OF_STOPPAGE_B_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/detail_of_stoppage_b/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    due_cleaning_hrs: this.due_cleaning_hrs, 
                    due_cleaning_tet: this.due_cleaning_tet, 
                    due_no_unavoidable_hrs: this.due_no_unavoidable_hrs, 
                    due_no_unavoidable_tet: this.due_no_unavoidable_tet, 
                    due_miscellaneous_hrs: this.due_miscellaneous_hrs, 
                    due_miscellaneous_tet: this.due_miscellaneous_tet, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.due_cleaning_hrs = '';
                        this.due_cleaning_tet = '';
                        this.due_no_unavoidable_hrs = '';
                        this.due_no_unavoidable_tet = '';
                        this.due_miscellaneous_hrs = '';
                        this.due_miscellaneous_tet = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('DETAIL_OF_STOPPAGE_B_UPDATE_LIST', {'key': response.data.key});

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