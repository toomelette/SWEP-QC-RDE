

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
                        <div class="form-group col-md-12" v-bind:class="error.crop_year_id ? 'has-error' : ''">
                            <label for="crop_year_id">Crop Year *</label>
                            <v-select v-model="crop_year_id" :options="crop_years"/>
                            <p v-if="error.crop_year_id" class="help-block">{{ error.crop_year_id.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.gross_cane_milled ? 'has-error' : ''">
                            <label for="gross_cane_milled">Gross Cane Milled</label>
                            <number-format decimals="2" v-model="gross_cane_milled" class="form-control" placeholder="Gross Cane Milled"/>
                            <p v-if="error.gross_cane_milled" class="help-block">{{ error.gross_cane_milled.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.raw_sugar_man ? 'has-error' : ''">
                            <label for="raw_sugar_man">Raw Sugar Manufactured</label>
                            <number-format decimals="2" v-model="raw_sugar_man" class="form-control" placeholder="Raw Sugar Manufactured"/>
                            <p v-if="error.raw_sugar_man" class="help-block">{{ error.raw_sugar_man.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.molasses_due_cane ? 'has-error' : ''">
                            <label for="molasses_due_cane">Molasses Due Cane</label>
                            <number-format decimals="2" v-model="molasses_due_cane" class="form-control" placeholder="Molasses Due Cane"/>
                            <p v-if="error.molasses_due_cane" class="help-block">{{ error.molasses_due_cane.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.bagasse ? 'has-error' : ''">
                            <label for="bagasse">Bagasse</label>
                            <number-format decimals="2" v-model="bagasse" class="form-control" placeholder="Bagasse"/>
                            <p v-if="error.bagasse" class="help-block">{{ error.bagasse.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.filter_cake ? 'has-error' : ''">
                            <label for="filter_cake">Filter Cake</label>
                            <number-format decimals="2" v-model="filter_cake" class="form-control" placeholder="Filter Cake"/>
                            <p v-if="error.filter_cake" class="help-block">{{ error.filter_cake.toString() }}</p>
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

    import EventBus from '../../SynTenYrPrdnMain';
    import Utils from '../utils';

    import 'vue-select/dist/vue-select.css';
    import 'vue-toast-notification/dist/theme-sugar.css';
    import 'vue-loading-overlay/dist/vue-loading.css';


    export default { 


        mixins: [ Utils ],


        data() {

            return {

                crop_years : [],
                error:[],

                // fields
                crop_year_id: {},
                gross_cane_milled: "",
                raw_sugar_man: "",
                molasses_due_cane: "",
                bagasse: "",
                filter_cake: "",

            }

        },



        created() {

            EventBus.$on('OPEN_TEN_YR_PRDN_CREATE_MODAL', (data) => {
                this.showModal();
            });

            this.getAllCropYears();

        },



        methods: {

            showModal(){ 
                $("#create_modal").modal("show");
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

                axios.post('synopsis/ten_yr_prdn/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    gross_cane_milled: this.gross_cane_milled, 
                    raw_sugar_man: this.raw_sugar_man, 
                    molasses_due_cane: this.molasses_due_cane, 
                    bagasse: this.bagasse, 
                    filter_cake: this.filter_cake, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.gross_cane_milled = '';
                        this.raw_sugar_man = '';
                        this.molasses_due_cane = '';
                        this.bagasse = '';
                        this.filter_cake = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('TEN_YR_PRDN_UPDATE_LIST', {'key': response.data.key});

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