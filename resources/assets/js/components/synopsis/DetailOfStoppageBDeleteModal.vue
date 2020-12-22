

<template>

    <div class="modal fade" id="delete_modal" data-backdrop="static">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <button class="close" data-dismiss="modal" style="padding:5px;">
              </button>
              <h4 class="modal-title">
                <i class="fa fa-exclamation-circle"></i> Delete
              </h4>
            </div>

            <form @submit.prevent="destroy()">
                <div class="modal-body">
                    <input type="hidden" v-model="delete_key">
                    <p style="font-size: 17px;">Are you sure, you want to delete this record?</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" @click="closeModal()">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>  
            </form>            

          </div>
        </div>
    </div>

</template>




<script>

    import 'vue-toast-notification/dist/theme-sugar.css';
    import EventBus from '../../SynDetailOfStoppageBMain';


    export default { 


        data() {

            return {

                delete_key:"",

            }

        },



        created() {
            
            EventBus.$on('OPEN_DETAIL_OF_STOPPAGE_B_DELETE_MODAL', (data) => {
                this.showModal(data);
            });

        },



        methods: {

            showModal(data){ 

                $("#delete_modal").modal("show");

                axios.get('synopsis/detail_of_stoppage_b/' + data.delete_key)
                    .then((response) => { 
                        if(response.status == 200){
                            this.delete_key = response.data.data.slug;
                        }
                    }); 

            },

            destroy(){ 

                axios.delete('synopsis/detail_of_stoppage_b/' + this.delete_key)
                    .then((response) => {

                        if(response.status == 200){

                            $('#delete_modal').modal('toggle');

                            this.$toast.success('Data Successfully Deleted!', {
                                position: 'top-right',
                                duration: 5000,
                                dismissible: true,
                            });
                            
                            EventBus.$emit('DETAIL_OF_STOPPAGE_B_UPDATE_LIST', {});
                            
                        }else{
                            
                            this.$toast.error('Unable to delete data!', {
                                position: 'top-right',
                                duration: 5000,
                                dismissible: true,
                            });

                        }

                    })

            },



        },



    }

</script>