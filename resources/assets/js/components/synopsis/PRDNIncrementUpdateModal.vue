

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

                        <div class="form-group col-md-12" v-bind:class="error.current_cy_prod ? 'has-error' : ''">
                            <label for="current_cy_prod">Current CY Production</label>
                            <number-format decimals="2" v-model="current_cy_prod" class="form-control" placeholder="Current CY Production"/>
                            <p v-if="error.current_cy_prod" class="help-block">{{ error.current_cy_prod.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.past_cy_prod ? 'has-error' : ''">
                            <label for="past_cy_prod">Past CY Production</label>
                            <number-format decimals="2" v-model="past_cy_prod" class="form-control" placeholder="Past CY Production"/>
                            <p v-if="error.past_cy_prod" class="help-block">{{ error.past_cy_prod.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.increase_decrease ? 'has-error' : ''">
                            <label for="increase_decrease">Increase / Decrease</label>
                            <number-format decimals="2" v-model="increase_decrease" class="form-control" placeholder="Increase / Decrease"/>  
                            <p v-if="error.increase_decrease" class="help-block">{{ error.increase_decrease.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.sharing_ratio ? 'has-error' : ''">
                            <label for="sharing_ratio">Planters-Millers Sharing Ratio</label>
                            <input type="text" v-model="sharing_ratio" class="form-control" placeholder="Planters-Millers Sharing Ratio"/>
                            <p v-if="error.sharing_ratio" class="help-block">{{ error.sharing_ratio.toString() }}</p>
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

    import EventBus from '../../SynPRDNIncrementMain';
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
                current_cy_prod: "",
                past_cy_prod: "",
                increase_decrease: "",
                sharing_ratio: "", 

            }

        },



        created() {
            
            EventBus.$on('OPEN_PRDN_INCREMENT_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/prdn_increment/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let prdn_increment = response.data.data;
                            this.update_key = prdn_increment.slug;
                            this.crop_year_id =  { code:prdn_increment.crop_year.crop_year_id, label:prdn_increment.crop_year.name };
                            this.mill_id = { code:prdn_increment.mill.mill_id, label:prdn_increment.mill.name };
                            this.current_cy_prod =  this.utilCheckFloat(prdn_increment.current_cy_prod);
                            this.past_cy_prod =  this.utilCheckFloat(prdn_increment.past_cy_prod);
                            this.increase_decrease =  this.utilCheckFloat(prdn_increment.increase_decrease);
                            this.sharing_ratio = prdn_increment.sharing_ratio; 
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

                axios.post('synopsis/prdn_increment/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    current_cy_prod: this.utilCheckFloat(this.current_cy_prod), 
                    past_cy_prod: this.utilCheckFloat(this.past_cy_prod), 
                    increase_decrease: this.utilCheckFloat(this.increase_decrease), 
                    sharing_ratio: this.sharing_ratio, 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('PRDN_INCREMENT_UPDATE_LIST', {'key': response.data.key});

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