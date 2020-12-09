

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
                    <button class="btn btn-default" data-dismiss="modal" @click="closeModal()">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>     
            </form>
            

          </div>
        </div>
      </div>

</template>




<script>

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import EventBus from '../../SynPRDNIncrementMain';
    import Utils from '../utils';


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
                current_cy_prod: "",
                past_cy_prod: "",
                increase_decrease: "",
                sharing_ratio: "", 

            }

        },



        created() {

            EventBus.$on('OPEN_PRDN_INCREMENT_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/prdn_increment/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    current_cy_prod: this.current_cy_prod, 
                    past_cy_prod: this.past_cy_prod, 
                    increase_decrease: this.increase_decrease, 
                    sharing_ratio: this.sharing_ratio,

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.current_cy_prod = '';
                        this.past_cy_prod = '';
                        this.increase_decrease = '';
                        this.sharing_ratio = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('PRDN_INCREMENT_UPDATE_LIST', {'key': response.data.key});

                    }else{
                        
                        this.$toast.error('Unable to send data!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                    }

                })
                .catch((error) => {

                    if (error.response?.status == 422){
                        this.error = error.response.data.errors;
                    }
                    
                });

            },

            closeModal(){ 
                this.error = [];
            },



        },



    }

</script>