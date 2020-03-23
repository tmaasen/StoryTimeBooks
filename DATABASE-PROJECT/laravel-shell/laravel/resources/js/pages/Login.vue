<template>
  <div>
    <head><title>StoryTime | Login</title></head>
    <authnav />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Login</div>

            <div class="card-body">

              <!-- error message -->
              <div class="alert alert-danger" v-if="has_error && !success">
                <p v-if="error == 'login_error'">Validation Errors.</p>
                <p v-else>Error, unable to connect with these credentials.</p>
              </div>

              <form method="POST" @submit.prevent="login">

                <div class="form-group row">
                  <!-- Email -->
                  <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                  <div class="col-md-6">
                    <input
                      v-model="email"
                      id="email"
                      type="email"
                      class="form-control"
                      placeholder="user@example.com"
                      required
                      autocomplete="email"
                      autofocus
                    />
                  </div>
                </div>
                <!-- Password -->
                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                  <div class="col-md-6">
                    <input
                      v-model="password"
                      id="password"
                      type="password"
                      class="form-control"
                      required
                    />
                  </div>
                </div>

                <!-- <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" />

                      <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                  </div>
                </div> -->

                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import authnav from '../components/authnav'
export default {
  components: {
    authnav
  },
  data() {
      return {
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: ''
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
        // axios.post('http://127.0.0.1:8000/api/v1/auth/login', {
        //     email: this.email,
        //     password: this.password
        // }).then(function (response) {
        //   console.log(response);
        //   this.$router.push({name: 'Home'})
        // }).catch(function (error) {
        //   console.log(error);
        // });
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          data: {
            email: app.email,
            password: app.password
          },
           success: function() {
          // handle redirection
            app.success = true
            const redirectTo = 'Home'
            this.$router.push({name: redirectTo})
          },
          error: function(res) {
            app.has_error = true
            app.error = res.json()
          },
          rememberMe: true,
          fetchUser: true
        })
       }
    }
};
</script>