

<template>
    <div>
        testaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    </div>
</template>




<script>

    export default {



        data() {
            return {
                sn_cane_sugar_tons: {},
            }
        },



        mounted() {
            this.fetch();
        },



        methods: {

            fetch(){
               axios.get('cane_sugar_tons')
                    .then((response) => {
                      console.log(response);
                    }); 
            }

        },



    }

</script>