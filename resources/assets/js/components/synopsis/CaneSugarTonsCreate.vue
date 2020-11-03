

<template>

    <div class="modal fade" id="create_modal" data-backdrop="static">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Create</h4>
            </div>

            <div class="modal-body" id="delete_body">



            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            
          </div>
        </div>
      </div>

</template>




<script>

    import EventBus from '../../CaneSugarTonsMain';

    export default {


        data() {

            return {


                
            }

        },



        created() {

            EventBus.$on('OPEN_CANE_SUGAR_TONS_MODAL', (data) => {
              
                $("#create_modal").modal("show");

            })

        }



    }

</script>