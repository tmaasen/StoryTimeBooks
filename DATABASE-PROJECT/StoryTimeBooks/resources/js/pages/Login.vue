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
                <!-- Login button -->
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
        this.$Progress.start();
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
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin' : 'Home'            
            this.$router.push({name: 'Home'})
            this.$Progress.finish();
          },
          error: function(res) {
            app.has_error = true
            app.error = res.data
            this.$Progress.fail();
          },
          rememberMe: true,
          fetchUser: true
        })
       }
    }
};
</script>