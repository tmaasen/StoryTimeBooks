<template>
<div>
  <head>
    <title>StoryTime | Login</title>
  </head>
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
                    :type="passwordFieldType"
                    class="form-control"
                    required
                  />
                  <b-icon-eye-fill font-scale="1.5" @click="switchVisibility" />
                </div>
              </div>
              <!-- Forgot Password -->
              <div style="margin-left:35%">
                  <a href="#" v-b-modal="'forgotpwModal'">Forgot your password?</a>
              </div>
              <!-- Modal -->
              <forgotpwModal
              id="forgotpwModal"
              title="Forgot Your Password"
              />
              <!-- Login button -->
              <div class="form-group row mb-0" style="margin-top:2%">
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
import authnav from "../components/authnav"
import forgotpwModal from "../components/forgotpasswordmodal"
import router from "../router"
export default {
  data() {
    return {
      email: null,
      password: null,
      passwordFieldType: 'password',
      success: false,
      has_error: false,
      error: ""
    };
  },
  components: {
    authnav,
    forgotpwModal
  },
  methods: {
    switchVisibility() {
       this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
    },
    login() {
      this.$Progress.start();
      // get the redirect object
      var redirect = this.$auth.redirect();
      var app = this;
      this.$auth.login({
        data: { 
          email: app.email,
          password: app.password
        },
        success: function() {
          // handle redirection
          app.success = true;
          this.$router.push({ name: "Home" });
          this.$Progress.finish();
        },
        error: function(res) {
          app.has_error = true;
          app.error = res.data;
          this.$Progress.fail();
        },
        fetchUser: true
      });
    }
  }
};
</script>