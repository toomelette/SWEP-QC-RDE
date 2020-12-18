

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

                        <div class="form-group col-md-12" v-bind:class="error.trash_percent_cane ? 'has-error' : ''">
                            <label for="trash_percent_cane">Trash Percent Cane</label>
                            <number-format decimals="2" v-model="trash_percent_cane" class="form-control" placeholder="Trash Percent Cane"/>
                            <p v-if="error.trash_percent_cane" class="help-block">{{ error.trash_percent_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.percent_recovery ? 'has-error' : ''">
                            <label for="percent_recovery">Percent Recovery</label>
                            <number-format decimals="2" v-model="percent_recovery" class="form-control" placeholder="Percent Recovery"/>
                            <p v-if="error.percent_recovery" class="help-block">{{ error.percent_recovery.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.recoverable ? 'has-error' : ''">
                            <label for="recoverable">Recoverable Kilos of Sugar</label>
                            <number-format decimals="2" v-model="recoverable" class="form-control" placeholder="Recoverable Kilos of Sugar"/>
                            <p v-if="error.recoverable" class="help-block">{{ error.recoverable.toString() }}</p>
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

    import EventBus from '../../SynKgSugarDueCleanCaneMain';
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
                trash_percent_cane: "",
                percent_recovery: "",
                recoverable: "", 
            }

        },



        created() {
            
            EventBus.$on('OPEN_KG_SUGAR_DUE_CLEAN_CANE_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/kg_sugar_due_clean_cane/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let kg_sugar_due_clean_cane = response.data.data;
                            this.update_key = kg_sugar_due_clean_cane.slug;
                            this.crop_year_id =  { code:kg_sugar_due_clean_cane.crop_year.crop_year_id, label:kg_sugar_due_clean_cane.crop_year.name };
                            this.mill_id = { code:kg_sugar_due_clean_cane.mill.mill_id, label:kg_sugar_due_clean_cane.mill.name };
                            this.trash_percent_cane =  this.utilCheckFloat(kg_sugar_due_clean_cane.trash_percent_cane);
                            this.percent_recovery =  this.utilCheckFloat(kg_sugar_due_clean_cane.percent_recovery);
                            this.recoverable =  this.utilCheckFloat(kg_sugar_due_clean_cane.recoverable);
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

                axios.post('synopsis/kg_sugar_due_clean_cane/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    trash_percent_cane: this.utilCheckFloat(this.trash_percent_cane), 
                    percent_recovery: this.utilCheckFloat(this.percent_recovery), 
                    recoverable: this.utilCheckFloat(this.recoverable), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('KG_SUGAR_DUE_CLEAN_CANE_UPDATE_LIST', {'key': response.data.key});

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