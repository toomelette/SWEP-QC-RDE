

<template>

    <div class="modal fade" id="create_modal" data-backdrop="static">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">


            <div class="modal-header">
              <button class="close" data-dismiss="modal" style="padding:5px;">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">
                <i class="fa fa-file-o"></i> Create
                <div class="pull-right">
                    <code>Fields with asterisks(*) are required</code>
                </div> 
              </h4>
            </div>


            <form @submit.prevent="store">
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" name="_token" :value="csrf">

                        <!-- mills -->
                        <div class="form-group col-md-6">
                            <label for="mill_id">Mill *</label>
                            <Select2 v-model="mill_id" :options="mills" :settings="{ width: '100%', placeholder: 'Select',}"/>
                        </div>

                        <!-- crop year -->
                        <div class="form-group col-md-6">
                            <label for="mill_id">Crop Year *</label>
                            <Select2 v-model="crop_year_id" :options="crop_years" :settings="{ width: '100%', placeholder: 'Select',}"/>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Sugar Cane Gross Tonnes</label>
                            <number-format v-model="sgrcane_gross_tonnes" class="form-control" placeholder="Gross Tonnes" @change="numberFormat"/></number-format>
                        </div>

                        <!-- <div class="form-group col-md-12">
                            <label for="name">Sugar Cane Net Tonnes</label>
                            <input v-model="sgrcane_net_tonnes" class="form-control" type="text" placeholder="Gross Tonnes">    
                        </div> -->

                        <!-- <div class="form-group col-md-12">
                            <label for="name">Raw Sugar Tonnes Due Cane</label>
                            <input v-model="rawsgr_tonnes_due_cane" class="form-control priceformat" type="text" placeholder="Gross Tonnes">    
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Raw Sugar Tonnes Manufactured</label>
                            <input v-model="rawsgr_tonnes_manufactured" class="form-control priceformat" type="text" placeholder="Gross Tonnes">    
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Equivalend</label>
                            <input v-model="equivalent" class="form-control priceformat" type="text" placeholder="Gross Tonnes">    
                        </div> -->
                        
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>     
            </form>
            

          </div>
        </div>
      </div>

</template>




<script>

    import EventBus from '../../CaneSugarTonsMain';
    import Utils from '../utils';


    export default { 

        mixins: [
            Utils
        ],


        data() {

            return {

                mills : [],
                crop_years : [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                // fields
                _token: "",
                mill_id: "",
                crop_year_id: "",
                sgrcane_gross_tonnes: "",
                sgrcane_net_tonnes: "",
                rawsgr_tonnes_due_cane: "",
                rawsgr_tonnes_manufactured: "", 
                equivalent: "",

            }

        },



        created() {

            this.showModal();
            this.getAllMills();
            this.getAllCropYears();

        },



        methods: {

            numberFormat(event){

                console.log(this.sgrcane_gross_tonnes);

            },

            showModal(){ 
                EventBus.$on('OPEN_CANE_SUGAR_TONS_MODAL', (data) => {
                    $("#create_modal").modal("show");
                });
            },

            getAllMills(){ 
               axios.get('mill/get_all')
                    .then((response) => {
                       this.mills = this.utilJsonObjToArray(response.data, 'mill_id', 'name');
                    }); 
            },

            getAllCropYears(){ 
               axios.get('crop_year/get_all')
                    .then((response) => {
                        this.crop_years = this.utilJsonObjToArray(response.data, 'crop_year_id', 'name');
                    }); 
            },

            store(){ 
                axios.post('/cane_sugar_tons/store', {
                    mill_id: this.mill_id,
                    crop_year_id: this.crop_year_id, 
                    sgrcane_gross_tonnes: this.sgrcane_gross_tonnes, 
                    sgrcane_net_tonnes: this.sgrcane_net_tonnes, 
                    rawsgr_tonnes_due_cane: this.rawsgr_tonnes_due_cane, 
                    rawsgr_tonnes_manufactured: this.rawsgr_tonnes_manufactured, 
                    equivalent: this.equivalent, 
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

        },



    }

</script>