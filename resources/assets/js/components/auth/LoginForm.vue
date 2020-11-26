

<template>

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form @submit.prevent="login">

            <div class="form-group has-feedback" v-bind:class="error.username ? 'has-error' : ''">
                <input v-model="username" class="form-control" placeholder="Username" type="text">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>   
                <p v-if="error.username" class="help-block"> {{ error.username.toString() }} </p>     
            </div>

            <div class="form-group has-feedback" v-bind:class="error.password ? 'has-error' : ''">
                <input v-model="password" class="form-control" placeholder="Password" type="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <p v-if="error.password" class="help-block"> {{ error.password.toString() }} </p>   
            </div>

            <div class="social-auth-links text-center">
              <button type="submit" class="btn btn-block btn-flat btn-success">LOGIN</button>
            </div>

        </form>

        <br>

    </div>

</template>




<script>

    export default { 


        data() {

            return {

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                error: "",

                // fields
                username: "",
                password: "",

            }

        },



        created() {

            localStorage.clear();

        },


        methods: {

            login(){ 
                const auth_usr = {};
                axios.post('auth/login', {
                    username: this.username,
                    password: this.password, 
                })
                .then((response) => {
                    if (response.status == 200) {
                        auth_usr.access_token = response.data.token;
                        window.localStorage.setItem('auth_usr', JSON.stringify(auth_usr));
                        location.replace(window.location.origin + '/dashboard/home');
                    }
                })
                .catch((error) => {
                    this.error = error.response.data.errors;
                });

            },

        },


    }

</script>