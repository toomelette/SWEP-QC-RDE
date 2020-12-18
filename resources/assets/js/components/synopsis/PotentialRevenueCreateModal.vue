

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

                        <div class="form-group col-md-12" v-bind:class="error.due_bh ? 'has-error' : ''">
                            <label for="due_bh">Due Mill and Boiling House</label>
                            <number-format decimals="2" v-model="due_bh" class="form-control" placeholder="Due Boiling Point"/>
                            <p v-if="error.due_bh" class="help-block">{{ error.due_bh.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.due_trash ? 'has-error' : ''">
                            <label for="due_trash">Due Trash</label>
                            <number-format decimals="2" v-model="due_trash" class="form-control" placeholder="Due Trash"/>
                            <p v-if="error.due_trash" class="help-block">{{ error.due_trash.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.total ? 'has-error' : ''">
                            <label for="total">Total</label>
                            <number-format decimals="2" v-model="total" class="form-control" placeholder="Total"/>
                            <p v-if="error.total" class="help-block">{{ error.total.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.potential_revenue ? 'has-error' : ''">
                            <label for="potential_revenue">Potential Revenue</label>
                            <number-format decimals="2" v-model="potential_revenue" class="form-control" placeholder="Potential Revenue"/>
                            <p v-if="error.potential_revenue" class="help-block">{{ error.potential_revenue.toString() }}</p>
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

    import EventBus from '../../SynPotentialRevenueMain';
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
                due_bh: "",
                due_trash: "",
                total: "",
                potential_revenue: "", 

            }

        },



        created() {

            EventBus.$on('OPEN_POTENTIAL_REVENUE_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/potential_revenue/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    due_bh: this.due_bh, 
                    due_trash: this.due_trash, 
                    total: this.total, 
                    potential_revenue: this.potential_revenue,

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.due_bh = '';
                        this.due_trash = '';
                        this.total = '';
                        this.potential_revenue = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('POTENTIAL_REVENUE_UPDATE_LIST', {'key': response.data.key});

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