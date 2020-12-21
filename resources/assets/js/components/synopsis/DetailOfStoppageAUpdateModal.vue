

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

                        <div class="form-group col-md-6" v-bind:class="error.due_factory_hrs ? 'has-error' : ''">
                            <label for="due_factory_hrs">Due Factory (No. of hrs)</label>
                            <number-format decimals="2" v-model="due_factory_hrs" class="form-control" placeholder="Due Factory (No. of hrs)"/>
                            <p v-if="error.due_factory_hrs" class="help-block">{{ error.due_factory_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_factory_tet ? 'has-error' : ''">
                            <label for="due_factory_tet">Due Factory (% on TET)</label>
                            <number-format decimals="2" v-model="due_factory_tet" class="form-control" placeholder="Due Factory (% on TET)"/>
                            <p v-if="error.due_factory_tet" class="help-block">{{ error.due_factory_tet.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_no_cane_hrs ? 'has-error' : ''">
                            <label for="due_no_cane_hrs">Due No Cane (No. of hrs)</label>
                            <number-format decimals="2" v-model="due_no_cane_hrs" class="form-control" placeholder="Due No Cane (No. of hrs)"/>
                            <p v-if="error.due_no_cane_hrs" class="help-block">{{ error.due_no_cane_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_no_cane_tet ? 'has-error' : ''">
                            <label for="due_no_cane_tet">Due No Cane (% on TET)</label>
                            <number-format decimals="2" v-model="due_no_cane_tet" class="form-control" placeholder="Due No Cane (% on TET)"/>
                            <p v-if="error.due_no_cane_tet" class="help-block">{{ error.due_no_cane_tet.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_transport_hrs ? 'has-error' : ''">
                            <label for="due_transport_hrs">Due Transport (No. of hrs)</label>
                            <number-format decimals="2" v-model="due_transport_hrs" class="form-control" placeholder="Due Transport (No. of hrs)"/>
                            <p v-if="error.due_transport_hrs" class="help-block">{{ error.due_transport_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.due_transport_tet ? 'has-error' : ''">
                            <label for="due_transport_tet">Due Transport (% on TET)</label>
                            <number-format decimals="2" v-model="due_transport_tet" class="form-control" placeholder="Due Transport (% on TET)"/>
                            <p v-if="error.due_transport_tet" class="help-block">{{ error.due_transport_tet.toString() }}</p>
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

    import EventBus from '../../SynDetailOfStoppageAMain';
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
                due_factory_hrs: "",
                due_factory_tet: "",
                due_no_cane_hrs: "",
                due_no_cane_tet: "",
                due_transport_hrs: "",
                due_transport_tet: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_DETAIL_OF_STOPPAGE_A_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/detail_of_stoppage_a/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let detail_of_stoppage_a = response.data.data;
                            this.update_key = detail_of_stoppage_a.slug;
                            this.crop_year_id =  { code:detail_of_stoppage_a.crop_year.crop_year_id, label:detail_of_stoppage_a.crop_year.name };
                            this.mill_id = { code:detail_of_stoppage_a.mill.mill_id, label:detail_of_stoppage_a.mill.name };
                            this.due_factory_hrs =  this.utilCheckFloat(detail_of_stoppage_a.due_factory_hrs);
                            this.due_factory_tet =  this.utilCheckFloat(detail_of_stoppage_a.due_factory_tet);
                            this.due_no_cane_hrs =  this.utilCheckFloat(detail_of_stoppage_a.due_no_cane_hrs);
                            this.due_no_cane_tet =  this.utilCheckFloat(detail_of_stoppage_a.due_no_cane_tet);
                            this.due_transport_hrs =  this.utilCheckFloat(detail_of_stoppage_a.due_transport_hrs);
                            this.due_transport_tet =  this.utilCheckFloat(detail_of_stoppage_a.due_transport_tet);
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

                axios.post('synopsis/detail_of_stoppage_a/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    due_factory_hrs: this.utilCheckFloat(this.due_factory_hrs), 
                    due_factory_tet: this.utilCheckFloat(this.due_factory_tet), 
                    due_no_cane_hrs: this.utilCheckFloat(this.due_no_cane_hrs), 
                    due_no_cane_tet: this.utilCheckFloat(this.due_no_cane_tet), 
                    due_transport_hrs: this.utilCheckFloat(this.due_transport_hrs), 
                    due_transport_tet: this.utilCheckFloat(this.due_transport_tet), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('DETAIL_OF_STOPPAGE_A_UPDATE_LIST', {'key': response.data.key});

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