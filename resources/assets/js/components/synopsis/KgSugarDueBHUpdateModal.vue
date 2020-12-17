

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

                        <div class="form-group col-md-12" v-bind:class="error.standard_oar ? 'has-error' : ''">
                            <label for="standard_oar">Standard OAR</label>
                            <number-format decimals="2" v-model="standard_oar" class="form-control" placeholder="Standard OAR"/>
                            <p v-if="error.standard_oar" class="help-block">{{ error.standard_oar.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.actual_oar ? 'has-error' : ''">
                            <label for="actual_oar">Actual OAR</label>
                            <number-format decimals="2" v-model="actual_oar" class="form-control" placeholder="Actual OAR"/>
                            <p v-if="error.actual_oar" class="help-block">{{ error.actual_oar.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.additional_kg_sugar ? 'has-error' : ''">
                            <label for="additional_kg_sugar">Additional Kgs of Sugar</label>
                            <number-format decimals="2" v-model="additional_kg_sugar" class="form-control" placeholder="Additional Kgs of Sugar"/>
                            <p v-if="error.additional_kg_sugar" class="help-block">{{ error.additional_kg_sugar.toString() }}</p>
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

    import EventBus from '../../SynKgSugarDueBHMain';
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
                standard_oar: "",
                actual_oar: "",
                additional_kg_sugar: "", 
            }

        },



        created() {
            
            EventBus.$on('OPEN_KG_SUGAR_DUE_BH_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/kg_sugar_due_bh/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let kg_sugar_due_bh = response.data.data;
                            this.update_key = kg_sugar_due_bh.slug;
                            this.crop_year_id =  { code:kg_sugar_due_bh.crop_year.crop_year_id, label:kg_sugar_due_bh.crop_year.name };
                            this.mill_id = { code:kg_sugar_due_bh.mill.mill_id, label:kg_sugar_due_bh.mill.name };
                            this.standard_oar =  this.utilCheckFloat(kg_sugar_due_bh.standard_oar);
                            this.actual_oar =  this.utilCheckFloat(kg_sugar_due_bh.actual_oar);
                            this.additional_kg_sugar =  this.utilCheckFloat(kg_sugar_due_bh.additional_kg_sugar);
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

                axios.post('synopsis/kg_sugar_due_bh/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    standard_oar: this.utilCheckFloat(this.standard_oar), 
                    actual_oar: this.utilCheckFloat(this.actual_oar), 
                    additional_kg_sugar: this.utilCheckFloat(this.additional_kg_sugar), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('KG_SUGAR_DUE_BH_UPDATE_LIST', {'key': response.data.key});

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