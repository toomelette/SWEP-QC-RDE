

<template>
    <div class="box">

        <div class="box-header with-border">

            <!-- Search Box -->
            <div class="box-title">  
                <div class="col-md-3 no-padding">
                    <button class="btn btn-success" @click="emitCreateModal()">
                        <i class="fa fa-plus"></i> &nbsp;Create
                    </button>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-md" style="width: 250px;">
                      <input class="form-control pull-right" placeholder="Search .." type="text" v-model.lazy="search_value" v-debounce="500">
                    </div>
                </div>
            </div>

            <!-- Select Entries -->
            <div class="box-tools" style="margin-top:7px;">
                <div class="col-md-4 no-padding" style="margin-top:7px;">Entries:</div>
                <div class="col-md-8">
                    <select id="e" class="form-control input-sm" v-model="entry_value">
                      <option value="10">10</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- Table -->
        <div class="box-body no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mill</th>
                        <th>CropYear</th>
                        <th>Action</th>
                    </tr>    
                </thead>    
                <tbody v-if="collection.length > 0">
                    <tr v-for="data in collection" v-bind:style="data.slug == created_key ? active_tr_style : {}">
                        <td id="mid-vert">{{ data.crop_year.name }}</td>
                        <td id="mid-vert">{{ data.mill.name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm bg-navy" @click="emitUpdateModal(data.slug)"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-sm bg-red" @click="emitDeleteModal(data.slug)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>  
        </div>
        
        <div v-if="is_loading == false && collection.length == 0 && is_invalid_fetch == true" style="padding :5px;">
          <center><h4>Server Error!</h4></center>
        </div>

        <div v-if="is_loading == false && collection.length == 0" style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>

        <div v-if="is_loading == true" style="padding :5px;">
          <center><h3>Loading ...</h3></center>
        </div>



        <!-- Pagination -->
        <div class="box-footer">
            <strong>
                Displaying {{ page_data.from }} - {{ page_data.to }} out of {{ page_data.total }} Records
            </strong>    
            <ul class="pagination no-margin pull-right pagination-success">
                <div class="btn-group">
                  <a type="button" 
                     class="btn btn-default" 
                     @click="fetch(page_data.current_page - 1)"
                     :disabled="page_data.current_page <= 1 ? true : false">
                     ‹
                 </a>
                  <a type="button" 
                     class="btn btn-default" 
                     @click="fetch(page_data.current_page + 1)"
                     :disabled="page_data.current_page == page_data.last_page ? true : false">
                    ›  
                 </a>
                </div>
            </ul>
        </div>


    </div>
</template>




<script>

    import debounce from 'v-debounce';
    import EventBus from '../../SynFilterCakeMain';

    export default {



        data() {

            return {

                collection: [],
                page_data: [],
                is_invalid_fetch: false,
                is_loading: true,
                created_key: "",
                active_tr_style:{ 'background-color': '#D5F5E3', },

                // filters
                search_value: null,
                entry_value: 10,
                
            }

        },



        created() {

            this.fetch();

        },



        mounted() {
            
            EventBus.$on('FILTER_CAKE_UPDATE_LIST', (data) => {
                this.created_key = data.key;
                this.fetch();
            });

        },



        watch:{

            search_value(after, before) {
                this.fetch();
            },

            entry_value(after, before) {
                this.fetch();
            }

        },



        methods: {

            fetch(page_no){ 

               axios.get('synopsis/filter_cake', { params: { q: this.search_value, e: this.entry_value, page: page_no, } })
                    .then((response) => {
                        if(response.status == 200){
                            this.collection = response.data.data;
                            this.page_data = response.data;
                            this.is_loading = false;
                        }else{
                            this.is_invalid_fetch = true;
                        }
                    })
                    .catch((error) => {
                        this.is_invalid_fetch = true;
                    }); 
                    
            },

            emitCreateModal(){ 
                EventBus.$emit('OPEN_FILTER_CAKE_CREATE_MODAL', {});
            },

            emitUpdateModal(update_key){ 
                EventBus.$emit('OPEN_FILTER_CAKE_UPDATE_MODAL', {'update_key': update_key});
            },

            emitDeleteModal(delete_key){  
                EventBus.$emit('OPEN_FILTER_CAKE_DELETE_MODAL', {'delete_key': delete_key});
            },

        },



        directives: { debounce }



    }

</script>