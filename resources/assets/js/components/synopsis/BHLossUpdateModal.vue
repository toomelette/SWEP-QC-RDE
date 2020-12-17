

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

                        <div class="form-group col-md-12" v-bind:class="error.milling_loss ? 'has-error' : ''">
                            <label for="milling_loss">Milling Loss</label>
                            <number-format decimals="2" v-model="milling_loss" class="form-control" placeholder="Milling Loss"/>
                            <p v-if="error.milling_loss" class="help-block">{{ error.milling_loss.toString() }}</p>
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

                        <div class="form-group col-md-12" v-bind:class="error.molasses ? 'has-error' : ''">
                            <label for="molasses">Molasses</label>
                            <number-format decimals="2" v-model="molasses" class="form-control" placeholder="Molasses"/>
                            <p v-if="error.molasses" class="help-block">{{ error.molasses.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.undetermined ? 'has-error' : ''">
                            <label for="undetermined">Undetermined</label>
                            <number-format decimals="2" v-model="undetermined" class="form-control" placeholder="Undetermined"/>
                            <p v-if="error.undetermined" class="help-block">{{ error.undetermined.toString() }}</p>
                        </div>

                        <div class="form-group col-md-12" v-bind:class="error.total ? 'has-error' : ''">
                            <label for="total">Total</label>
                            <number-format decimals="2" v-model="total" class="form-control" placeholder="Total"/>
                            <p v-if="error.total" class="help-block">{{ error.total.toString() }}</p>
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

    import EventBus from '../../SynBHLossMain';
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
                milling_loss: "",
                bagasse: "",
                filter_cake: "",
                molasses: "", 
                undetermined: "",
                total: "",
            }

        },



        created() {
            
            EventBus.$on('OPEN_BH_LOSS_UPDATE_MODAL', (data) => {
                this.showModal(data);
            });

            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            showModal(data){ 

                $("#update_modal").modal("show");

                axios.get('synopsis/bh_loss/' + data.update_key)
                    .then((response) => { 
                        if(response.status == 200){
                            let bh_loss = response.data.data;
                            this.update_key = bh_loss.slug;
                            this.crop_year_id =  { code:bh_loss.crop_year.crop_year_id, label:bh_loss.crop_year.name };
                            this.mill_id = { code:bh_loss.mill.mill_id, label:bh_loss.mill.name };
                            this.milling_loss =  this.utilCheckFloat(bh_loss.milling_loss);
                            this.bagasse =  this.utilCheckFloat(bh_loss.bagasse);
                            this.filter_cake =  this.utilCheckFloat(bh_loss.filter_cake);
                            this.molasses =  this.utilCheckFloat(bh_loss.molasses);
                            this.undetermined =  this.utilCheckFloat(bh_loss.undetermined);
                            this.total =  this.utilCheckFloat(bh_loss.total);
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

                axios.post('synopsis/bh_loss/' + this.update_key, {
                    crop_year_id: this.crop_year_id?.code.toString(), 
                    mill_id: this.mill_id?.code.toString(),
                    milling_loss: this.utilCheckFloat(this.milling_loss), 
                    bagasse: this.utilCheckFloat(this.bagasse), 
                    filter_cake: this.utilCheckFloat(this.filter_cake), 
                    molasses: this.utilCheckFloat(this.molasses), 
                    undetermined: this.utilCheckFloat(this.undetermined), 
                    total: this.utilCheckFloat(this.total), 
                })
                .then((response) => {

                    if(response.status == 200){

                        $('#update_modal').modal('toggle');

                        this.$toast.success('Data Successfully Updated!', {
                            position: 'top-right',
                            duration: 5000,
                            dismissible: true,
                        });

                        EventBus.$emit('BH_LOSS_UPDATE_LIST', {'key': response.data.key});

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