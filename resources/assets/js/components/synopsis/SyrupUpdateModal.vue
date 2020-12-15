

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

                        <div class="form-group col-md-6" v-bind:class="error.brix ? 'has-error' : ''">
                            <label for="brix">Brix</label>
                            <number-format decimals="2" v-model="brix" class="form-control" placeholder="Brix"/>
                            <p v-if="error.brix" class="help-block">{{ error.brix.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_pol ? 'has-error' : ''">
                            <label for="percent_pol">Percent POL</label>
                            <number-format decimals="2" v-model="percent_pol" class="form-control" placeholder="Percent POL"/>
                            <p v-if="error.percent_pol" class="help-block">{{ error.percent_pol.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.apparent_purity ? 'has-error' : ''">
                            <label for="apparent_purity">Apparent Purity</label>
                            <number-format decimals="2" v-model="apparent_purity" class="form-control" placeholder="Apparent Purity"/>
                            <p v-if="error.apparent_purity" class="help-block">{{ error.apparent_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.percent_sucrose ? 'has-error' : ''">
                            <label for="percent_sucrose">Percent SUCROSE</label>
                            <number-format decimals="2" v-model="percent_sucrose" class="form-control" placeholder="Percent SUCROSE"/>
                            <p v-if="error.percent_sucrose" class="help-block">{{ error.percent_sucrose.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.gravity_purity ? 'has-error' : ''">
                            <label for="gravity_purity">Gravity Purity</label>
                            <number-format decimals="2" v-model="gravity_purity" class="form-control" placeholder="Gravity Purity"/>
                            <p v-if="error.gravity_purity" class="help-block">{{ error.gravity_purity.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.ph ? 'has-error' : ''">
                            <label for="ph">pH</label>
                            <number-format decimals="2" v-model="ph" class="form-control" placeholder="pH"/>
                            <p v-if="error.ph" class="help-block">{{ error.ph.toString() }}</p>
                        </div>

                        <div class="form-group col-md-6" v-bind:class="error.inc_in_ap ? 'has-error' : ''">
                            <label for="inc_in_ap">Inc. in AP (MJ TO SYRUP)</label>
                            <number-format decimals="2" v-model="inc_in_ap" class="form-control" placeholder="Inc. in AP (MJ TO SYRUP)"/>
                            <p v-if="error.inc_in_ap" class="help-block">{{ error.inc_in_ap.toString() }}</p>
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

    import EventBus from '../../SynSyrupMain';
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
                brix: "",
                percent_pol: "",
                apparent_purity: "",
                percent_sucrose: "",
                gravity_purity: "",
                ph: "",
                inc_in_ap: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_SYRUP_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/syrup/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let syrup = response.data.data;
                            this.update_key = syrup.slug;
                            this.crop_year_id =  { code:syrup.crop_year.crop_year_id, label:syrup.crop_year.name };
                            this.mill_id = { code:syrup.mill.mill_id, label:syrup.mill.name };
                            this.brix =  this.utilCheckFloat(syrup.brix);
                            this.percent_pol =  this.utilCheckFloat(syrup.percent_pol);
                            this.apparent_purity =  this.utilCheckFloat(syrup.apparent_purity);
                            this.percent_sucrose =  this.utilCheckFloat(syrup.percent_sucrose);
                            this.gravity_purity =  this.utilCheckFloat(syrup.gravity_purity);
                            this.ph =  this.utilCheckFloat(syrup.ph);
                            this.inc_in_ap =  this.utilCheckFloat(syrup.inc_in_ap);
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

                axios.post('synopsis/syrup/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    brix: this.utilCheckFloat(this.brix), 
                    percent_pol: this.utilCheckFloat(this.percent_pol), 
                    apparent_purity: this.utilCheckFloat(this.apparent_purity), 
                    percent_sucrose: this.utilCheckFloat(this.percent_sucrose), 
                    gravity_purity: this.utilCheckFloat(this.gravity_purity), 
                    ph: this.utilCheckFloat(this.ph), 
                    inc_in_ap: this.utilCheckFloat(this.inc_in_ap), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('SYRUP_UPDATE_LIST', {'key': response.data.key});

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