

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

                        <div class="form-group col-md-12" v-bind:class="error.first_expressed_juice ? 'has-error' : ''">
                            <label for="first_expressed_juice">First Expressed Juice</label>
                            <number-format decimals="2" v-model="first_expressed_juice" class="form-control" placeholder="First Expressed Juice"/>
                            <p v-if="error.first_expressed_juice" class="help-block">{{ error.first_expressed_juice.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.last_expressed_juice ? 'has-error' : ''">
                            <label for="last_expressed_juice">Last Expressed Juice</label>
                            <number-format decimals="2" v-model="last_expressed_juice" class="form-control" placeholder="Last Expressed Juice"/>
                            <p v-if="error.last_expressed_juice" class="help-block">{{ error.last_expressed_juice.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.mixed_juice ? 'has-error' : ''">
                            <label for="mixed_juice">Mixed Juice</label>
                            <number-format decimals="2" v-model="mixed_juice" class="form-control" placeholder="Mixed Juice"/>
                            <p v-if="error.mixed_juice" class="help-block">{{ error.mixed_juice.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.syrup ? 'has-error' : ''">
                            <label for="syrup">Syrup</label>
                            <number-format decimals="2" v-model="syrup" class="form-control" placeholder="Syrup"/>
                            <p v-if="error.syrup" class="help-block">{{ error.syrup.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.molasses ? 'has-error' : ''">
                            <label for="molasses">Molasses</label>
                            <number-format decimals="2" v-model="molasses" class="form-control" placeholder="Molasses"/>
                            <p v-if="error.molasses" class="help-block">{{ error.molasses.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.sugar ? 'has-error' : ''">
                            <label for="sugar">Sugar</label>
                            <number-format decimals="2" v-model="sugar" class="form-control" placeholder="Sugar"/>
                            <p v-if="error.sugar" class="help-block">{{ error.sugar.toString() }}</p>
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

    import EventBus from '../../SynNonSugarMain';
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
                first_expressed_juice: "",
                last_expressed_juice: "",
                mixed_juice: "",
                syrup: "", 
                molasses: "",
                sugar: "",

            }

        },



        created() {

            EventBus.$on('OPEN_NON_SUGAR_CREATE_MODAL', (data) => {
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

                axios.post('synopsis/non_sugar/store', {

                    crop_year_id: this.crop_year_id?.code, 
                    mill_id: this.mill_id?.code,
                    first_expressed_juice: this.first_expressed_juice, 
                    last_expressed_juice: this.last_expressed_juice, 
                    mixed_juice: this.mixed_juice, 
                    syrup: this.syrup,
                    molasses: this.molasses, 
                    sugar: this.sugar, 

                })
                .then((response) => {

                    if(response.status == 200){
                        
                        this.error = [];
                        this.crop_year_id = {};
                        this.mill_id = {};
                        this.first_expressed_juice = '';
                        this.last_expressed_juice = '';
                        this.mixed_juice = '';
                        this.syrup = '';
                        this.molasses = '';
                        this.sugar = '';

                        this.$toast.success('Data Successfully Saved!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('NON_SUGAR_UPDATE_LIST', {'key': response.data.key});

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