

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

                        <div class="form-group col-md-12" v-bind:class="error.burnt_cane_percent ? 'has-error' : ''">
                            <label for="burnt_cane_percent">Burnt Cane Percent Gross Cane</label>
                            <number-format decimals="2" v-model="burnt_cane_percent" class="form-control" placeholder="Burnt Cane Percent Gross Cane"/>
                            <p v-if="error.burnt_cane_percent" class="help-block">{{ error.burnt_cane_percent.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.quality_ratio ? 'has-error' : ''">
                            <label for="quality_ratio">Quality Ratio (TC/TS)</label>
                            <number-format decimals="2" v-model="quality_ratio" class="form-control" placeholder="Quality Ratio (TC/TS)"/>
                            <p v-if="error.quality_ratio" class="help-block">{{ error.quality_ratio.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.rendement ? 'has-error' : ''">
                            <label for="rendement">Rendement (Lkg/TC)</label>
                            <number-format decimals="2" v-model="rendement" class="form-control" placeholder="Rendement (Lkg/TC)"/>  
                            <p v-if="error.rendement" class="help-block">{{ error.rendement.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.total_sugar_recovered ? 'has-error' : ''">
                            <label for="total_sugar_recovered">Total Sugar Recovered (% Cane)</label>
                            <number-format decimals="2" v-model="total_sugar_recovered" class="form-control" placeholder="Total Sugar Recovered (% Cane)"/>
                            <p v-if="error.total_sugar_recovered" class="help-block">{{ error.total_sugar_recovered.toString() }}</p>
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
    import EventBus from '../../SynRatiosOnGrossCaneMain';
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
                burnt_cane_percent: "",
                quality_ratio: "",
                rendement: "",
                total_sugar_recovered: "",

            }

        },



        created() {
            
            EventBus.$on('OPEN_RATIOS_ON_GROSS_CANE_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('ratios_on_gross_cane/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let cane_sugar_tons = response.data.data;
                            this.update_key = cane_sugar_tons.slug;
                            this.crop_year_id =  { code:cane_sugar_tons.crop_year.crop_year_id, label:cane_sugar_tons.crop_year.name };
                            this.mill_id = { code:cane_sugar_tons.mill.mill_id, label:cane_sugar_tons.mill.name };
                            this.burnt_cane_percent =  this.utilCheckFloat(cane_sugar_tons.burnt_cane_percent);
                            this.quality_ratio =  this.utilCheckFloat(cane_sugar_tons.quality_ratio);
                            this.rendement =  this.utilCheckFloat(cane_sugar_tons.rendement);
                            this.total_sugar_recovered =  this.utilCheckFloat(cane_sugar_tons.total_sugar_recovered); 
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

                axios.post('ratios_on_gross_cane/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    burnt_cane_percent: this.utilCheckFloat(this.burnt_cane_percent), 
                    quality_ratio: this.utilCheckFloat(this.quality_ratio), 
                    rendement: this.utilCheckFloat(this.rendement), 
                    total_sugar_recovered: this.utilCheckFloat(this.total_sugar_recovered), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('RATIOS_ON_GROSS_CANE_UPDATE_LIST', {'key': response.data.key});
                        
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