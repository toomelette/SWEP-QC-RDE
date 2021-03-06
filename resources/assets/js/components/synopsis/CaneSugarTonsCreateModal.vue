

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

                        <div class="form-group col-md-12" v-bind:class="error.sgrcane_gross_tonnes ? 'has-error' : ''">
                            <label for="sgrcane_gross_tonnes">Sugar Cane Gross Tonnes</label>
                            <number-format decimals="2" v-model="sgrcane_gross_tonnes" class="form-control" placeholder="Sugar Cane Gross Tonnes"/>
                            <p v-if="error.sgrcane_gross_tonnes" class="help-block">{{ error.sgrcane_gross_tonnes.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.sgrcane_net_tonnes ? 'has-error' : ''">
                            <label for="sgrcane_net_tonnes">Sugar Cane Net Tonnes</label>
                            <number-format decimals="2" v-model="sgrcane_net_tonnes" class="form-control" placeholder="Sugar Cane Net Tonnes"/>
                            <p v-if="error.sgrcane_net_tonnes" class="help-block">{{ error.sgrcane_net_tonnes.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.rawsgr_tonnes_due_cane ? 'has-error' : ''">
                            <label for="rawsgr_tonnes_due_cane">Raw Sugar Tonnes Due Cane</label>
                            <number-format decimals="2" v-model="rawsgr_tonnes_due_cane" class="form-control" placeholder="Raw Sugar Tonnes Due Cane"/>  
                            <p v-if="error.rawsgr_tonnes_due_cane" class="help-block">{{ error.rawsgr_tonnes_due_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.rawsgr_tonnes_manufactured ? 'has-error' : ''">
                            <label for="rawsgr_tonnes_manufactured">Raw Sugar Tonnes Manufactured</label>
                            <number-format decimals="2" v-model="rawsgr_tonnes_manufactured" class="form-control" placeholder="Raw Sugar Tonnes Manufactured"/>
                            <p v-if="error.rawsgr_tonnes_manufactured" class="help-block">{{ error.rawsgr_tonnes_manufactured.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.equivalent ? 'has-error' : ''">
                            <label for="equivalent">Equivalend</label>
                            <number-format decimals="2" v-model="equivalent" class="form-control" placeholder="Equivalent"/>  
                            <p v-if="error.equivalent" class="help-block">{{ error.equivalent.toString() }}</p>
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

    import EventBus from '../../SynCaneSugarTonsMain';
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
                sgrcane_gross_tonnes: "",
                sgrcane_net_tonnes: "",
                rawsgr_tonnes_due_cane: "",
                rawsgr_tonnes_manufactured: "", 
                equivalent: "",

            }

        },



        created() {

            EventBus.$on('OPEN_CANE_SUGAR_TONS_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/cane_sugar_tons/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    sgrcane_gross_tonnes: this.sgrcane_gross_tonnes, 
                    sgrcane_net_tonnes: this.sgrcane_net_tonnes, 
                    rawsgr_tonnes_due_cane: this.rawsgr_tonnes_due_cane, 
                    rawsgr_tonnes_manufactured: this.rawsgr_tonnes_manufactured,
                    equivalent: this.equivalent, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.sgrcane_gross_tonnes = '';
                        this.sgrcane_net_tonnes = '';
                        this.rawsgr_tonnes_due_cane = '';
                        this.rawsgr_tonnes_manufactured = '';
                        this.equivalent = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('CANE_SUGAR_TONS_UPDATE_LIST', {'key': response.data.key});

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