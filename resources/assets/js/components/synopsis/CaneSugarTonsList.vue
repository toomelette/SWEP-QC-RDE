

<template>
    <div class="box">

        <div class="box-header with-border">

            <!-- Search Box -->
            <div class="box-title">  
                <div class="col-md-3 no-padding">
                    <button class="btn btn-success" @click="emitCreateModal()">
                        <i class="fa fa-plus"></i> Create
                    </button>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-md" style="width: 250px;">
                      <input class="form-control pull-right" placeholder="Search .." type="text" v-model.lazy="search_value" v-debounce="300">
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
                    </tr>    
                </thead>    
                <tbody v-if="sn_cane_sugar_tons.length > 0">
                    <tr v-for="sn_cane_sugar_ton in sn_cane_sugar_tons">
                        <td>{{ sn_cane_sugar_ton.mill.name }}</td>
                        <td>{{ sn_cane_sugar_ton.crop_year.name }}</td>
                    </tr>
                </tbody>
            </table>  
        </div>

        <div v-if="sn_cane_sugar_tons.length == 0" style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>

        <div v-if="is_invalid_fetch == true" style="padding :5px;">
          <center><h4>Server Error!</h4></center>
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
    import EventBus from '../../CaneSugarTonsMain';

    export default {


        data() {

            return {

                sn_cane_sugar_tons: [],
                page_data: [],
                is_invalid_fetch: false,

                // filters
                search_value: null,
                entry_value: 10,
                
            }

        },


        mounted() {
            this.fetch();
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
               axios.get('cane_sugar_tons', { params: { q: this.search_value, e: this.entry_value, page: page_no, } })
                    .then((response) => {
                        this.sn_cane_sugar_tons = response.data.data;
                        this.page_data = response.data;
                    })
                    .catch((error) => {
                        this.is_invalid_fetch = true;
                    }); 
            },


            emitCreateModal(){ 
                EventBus.$emit('OPEN_CANE_SUGAR_TONS_MODAL', {});
            },


        },

        directives: {debounce}

    }

</script>