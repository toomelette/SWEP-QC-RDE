

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

                        <div class="form-group col-md-12" v-bind:class="error.actual_grind_hrs ? 'has-error' : ''">
                            <label for="actual_grind_hrs">Actual Grinding (No. of hrs)</label>
                            <number-format decimals="2" v-model="actual_grind_hrs" class="form-control" placeholder="Actual Grinding (No. of hrs)"/>
                            <p v-if="error.actual_grind_hrs" class="help-block">{{ error.actual_grind_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.actual_grind_tet ? 'has-error' : ''">
                            <label for="actual_grind_tet">Actual Grind (% on TET)</label>
                            <number-format decimals="2" v-model="actual_grind_tet" class="form-control" placeholder="Actual Grind (% on TET)"/>
                            <p v-if="error.actual_grind_tet" class="help-block">{{ error.actual_grind_tet.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.total_delays_hrs ? 'has-error' : ''">
                            <label for="total_delays_hrs">Total Delays & Stoppages (No. of hrs)</label>
                            <number-format decimals="2" v-model="total_delays_hrs" class="form-control" placeholder="Total Delays & Stoppages (No. of hrs)"/>
                            <p v-if="error.total_delays_hrs" class="help-block">{{ error.total_delays_hrs.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.total_delays_tet ? 'has-error' : ''">
                            <label for="total_delays_tet">Total Delays & Stoppages (% on TET)</label>
                            <number-format decimals="2" v-model="total_delays_tet" class="form-control" placeholder="Total Delays & Stoppages (% on TET)"/>
                            <p v-if="error.total_delays_tet" class="help-block">{{ error.total_delays_tet.toString() }}</p>
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

    import EventBus from '../../SynGrindStoppageMain';
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
                actual_grind_hrs: "",
                actual_grind_tet: "",
                total_delays_hrs: "",
                total_delays_tet: "", 

            }

        },



        created() {
            
            EventBus.$on('OPEN_GRIND_STOPPAGE_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/grind_stoppage/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let grind_stoppage = response.data.data;
                            this.update_key = grind_stoppage.slug;
                            this.crop_year_id =  { code:grind_stoppage.crop_year.crop_year_id, label:grind_stoppage.crop_year.name };
                            this.mill_id = { code:grind_stoppage.mill.mill_id, label:grind_stoppage.mill.name };
                            this.actual_grind_hrs =  this.utilCheckFloat(grind_stoppage.actual_grind_hrs);
                            this.actual_grind_tet =  this.utilCheckFloat(grind_stoppage.actual_grind_tet);
                            this.total_delays_hrs =  this.utilCheckFloat(grind_stoppage.total_delays_hrs);
                            this.total_delays_tet =  this.utilCheckFloat(grind_stoppage.total_delays_tet); 
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

                axios.post('synopsis/grind_stoppage/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    actual_grind_hrs: this.utilCheckFloat(this.actual_grind_hrs), 
                    actual_grind_tet: this.utilCheckFloat(this.actual_grind_tet), 
                    total_delays_hrs: this.utilCheckFloat(this.total_delays_hrs), 
                    total_delays_tet: this.utilCheckFloat(this.total_delays_tet), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('GRIND_STOPPAGE_UPDATE_LIST', {'key': response.data.key});

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