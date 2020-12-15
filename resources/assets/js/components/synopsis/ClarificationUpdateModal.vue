

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

                        <div class="form-group col-md-6" v-bind:class="error.juice_apparent_purity ? 'has-error' : ''">
                            <label for="juice_apparent_purity">Apparent Purity (Clarified Juice)</label>
                            <number-format decimals="2" v-model="juice_apparent_purity" class="form-control" placeholder="Apparent Purity (Clarified Juice)"/>
                            <p v-if="error.juice_apparent_purity" class="help-block">{{ error.juice_apparent_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.juice_brix ? 'has-error' : ''">
                            <label for="juice_brix">Brix (Clarified Juice)</label>
                            <number-format decimals="2" v-model="juice_brix" class="form-control" placeholder="Brix (Clarified Juice)"/>
                            <p v-if="error.juice_brix" class="help-block">{{ error.juice_brix.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.juice_ph ? 'has-error' : ''">
                            <label for="juice_ph">pH (Clarified Juice)</label>
                            <number-format decimals="2" v-model="juice_ph" class="form-control" placeholder="pH (Clarified Juice)"/>
                            <p v-if="error.juice_ph" class="help-block">{{ error.juice_ph.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.juice_clarity ? 'has-error' : ''">
                            <label for="juice_clarity">Clarity (Clarified Juice)</label>
                            <number-format decimals="2" v-model="juice_clarity" class="form-control" placeholder="Clarity (Clarified Juice)"/>
                            <p v-if="error.juice_clarity" class="help-block">{{ error.juice_clarity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.lime_tonnes_used ? 'has-error' : ''">
                            <label for="lime_tonnes_used">Tonnes Used (Lime)</label>
                            <number-format decimals="2" v-model="lime_tonnes_used" class="form-control" placeholder="Tonnes Used (Lime)"/>
                            <p v-if="error.lime_tonnes_used" class="help-block">{{ error.lime_tonnes_used.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.lime_cao ? 'has-error' : ''">
                            <label for="lime_cao">% CAO (Lime)</label>
                            <number-format decimals="2" v-model="lime_cao" class="form-control" placeholder="% CAO (Lime)"/>
                            <p v-if="error.lime_cao" class="help-block">{{ error.lime_cao.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.lime_cao_per_tc ? 'has-error' : ''">
                            <label for="lime_cao_per_tc">Kg CAO PER TC (Lime)</label>
                            <number-format decimals="2" v-model="lime_cao_per_tc" class="form-control" placeholder="Kg CAO PER TC (Lime)"/>
                            <p v-if="error.lime_cao_per_tc" class="help-block">{{ error.lime_cao_per_tc.toString() }}</p>
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

    import EventBus from '../../SynClarificationMain';
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
                juice_apparent_purity: "",
                juice_brix: "",
                juice_ph: "",
                juice_clarity: "",
                lime_tonnes_used: "",
                lime_cao: "",
                lime_cao_per_tc: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_CLARIFICATION_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/clarification/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let clarification = response.data.data;
                            this.update_key = clarification.slug;
                            this.crop_year_id =  { code:clarification.crop_year.crop_year_id, label:clarification.crop_year.name };
                            this.mill_id = { code:clarification.mill.mill_id, label:clarification.mill.name };
                            this.juice_apparent_purity =  this.utilCheckFloat(clarification.juice_apparent_purity);
                            this.juice_brix =  this.utilCheckFloat(clarification.juice_brix);
                            this.juice_ph =  this.utilCheckFloat(clarification.juice_ph);
                            this.juice_clarity =  this.utilCheckFloat(clarification.juice_clarity);
                            this.lime_tonnes_used =  this.utilCheckFloat(clarification.lime_tonnes_used);
                            this.lime_cao =  this.utilCheckFloat(clarification.lime_cao);
                            this.lime_cao_per_tc =  this.utilCheckFloat(clarification.lime_cao_per_tc);
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

                axios.post('synopsis/clarification/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    juice_apparent_purity: this.utilCheckFloat(this.juice_apparent_purity), 
                    juice_brix: this.utilCheckFloat(this.juice_brix), 
                    juice_ph: this.utilCheckFloat(this.juice_ph), 
                    juice_clarity: this.utilCheckFloat(this.juice_clarity), 
                    lime_tonnes_used: this.utilCheckFloat(this.lime_tonnes_used), 
                    lime_cao: this.utilCheckFloat(this.lime_cao), 
                    lime_cao_per_tc: this.utilCheckFloat(this.lime_cao_per_tc), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('CLARIFICATION_UPDATE_LIST', {'key': response.data.key});

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