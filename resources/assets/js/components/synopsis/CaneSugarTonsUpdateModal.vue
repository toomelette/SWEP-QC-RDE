

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
                    <button class="btn btn-default" data-dismiss="modal" @click="closeModal">Close</button>
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
    import EventBus from '../../SynCaneSugarTonsMain';
    import Utils from '../utils';


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
                sgrcane_gross_tonnes: "",
                sgrcane_net_tonnes: "",
                rawsgr_tonnes_due_cane: "",
                rawsgr_tonnes_manufactured: "", 
                equivalent: "",

            }

        },



        created() {
            
            EventBus.$on('OPEN_CANE_SUGAR_TONS_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/cane_sugar_tons/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let cane_sugar_tons = response.data.data;
                            this.update_key = cane_sugar_tons.slug;
                            this.crop_year_id =  { code:cane_sugar_tons.crop_year.crop_year_id, label:cane_sugar_tons.crop_year.name };
                            this.mill_id = { code:cane_sugar_tons.mill.mill_id, label:cane_sugar_tons.mill.name };
                            this.sgrcane_gross_tonnes =  this.utilCheckFloat(cane_sugar_tons.sgrcane_gross_tonnes);
                            this.sgrcane_net_tonnes =  this.utilCheckFloat(cane_sugar_tons.sgrcane_net_tonnes);
                            this.rawsgr_tonnes_due_cane =  this.utilCheckFloat(cane_sugar_tons.rawsgr_tonnes_due_cane);
                            this.rawsgr_tonnes_manufactured =  this.utilCheckFloat(cane_sugar_tons.rawsgr_tonnes_manufactured); 
                            this.equivalent =  this.utilCheckFloat(cane_sugar_tons.equivalent);
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

                axios.post('synopsis/cane_sugar_tons/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    sgrcane_gross_tonnes: this.utilCheckFloat(this.sgrcane_gross_tonnes), 
                    sgrcane_net_tonnes: this.utilCheckFloat(this.sgrcane_net_tonnes), 
                    rawsgr_tonnes_due_cane: this.utilCheckFloat(this.rawsgr_tonnes_due_cane), 
                    rawsgr_tonnes_manufactured: this.utilCheckFloat(this.rawsgr_tonnes_manufactured), 
                    equivalent: this.utilCheckFloat(this.equivalent), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('CANE_SUGAR_TONS_UPDATE_LIST', {'key': response.data.key});
                        
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