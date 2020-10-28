

<template>
    <div class="box">

        <div class="box-header with-border">

            <!-- Search Box -->
            <div class="box-title">  
                <div class="input-group input-group-md" style="width: 300px;">
                  <input class="form-control pull-right" placeholder="Search" type="text" value="" v-model="search_value">
                </div>
            </div>
            <!-- Entries -->
            <div class="box-tools" style="margin-top:6px;">
                <div class="col-md-4" style="margin-top:6px;">
                    Entries:
                </div>
                <div class="col-md-8">
                    <select id="e" class="form-control input-sm">
                      <option value="">10</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="box-body no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Slug</th>
                        <th>ID</th>
                    </tr>    
                </thead>    
                <tbody v-if="sn_cane_sugar_tons.length > 0">
                    <tr v-for="sn_cane_sugar_ton in sn_cane_sugar_tons" :key="sn_cane_sugar_ton.cane_sugar_ton_id">
                        <td>{{ sn_cane_sugar_ton.slug }}</td>
                        <td>{{ sn_cane_sugar_ton.cane_sugar_ton_id }}</td>
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


        <div class="box-footer">
            <strong>Displaying 1 - 20 out of 31 Records</strong>
            <ul class="pagination no-margin pull-right pagination-success">

                <li class="page-item disabled">
                    <span class="page-link"><</span>
                </li>
                <li class="page-item active">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item">
                    <a data-pjax="" class="page-link" href="http://localhost:2009/dashboard/mill?page=2">2</a>
                </li>

                <li class="page-item"><a data-pjax="" class="page-link" href="http://localhost:2009/dashboard/mill?page=2" rel="next">></a></li>
            </ul>
        </div>

    </div>
</template>




<script>

    export default {



        data() {

            return {
                sn_cane_sugar_tons: [],
                is_invalid_fetch: false,
                search_value: null,
            }

        },


        mounted() {
            this.fetch();
        },


        watch:{

            search_value(after, before) {
                this.fetch();
            }

        },


        methods: {

            fetch(){
               axios.get('cane_sugar_tons', { params: { q: this.search_value } })
                    .then((response) => {
                        this.sn_cane_sugar_tons = response.data.data;
                    })
                    .catch((error) => {
                        this.is_invalid_fetch = true;
                    }); 
            },

        },


    }

</script>