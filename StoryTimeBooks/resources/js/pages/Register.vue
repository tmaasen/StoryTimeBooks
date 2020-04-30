<template>
<div>
  <head>
    <title>StoryTime | Create Account</title>
  </head>
  <authnav />
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Register</div>
            <!-- error checking -->
             <div class="alert alert-danger" v-if="has_error && !success">
                <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
            </div>
            <!-- end error checking -->
          <div class="card-body">
            <form method="POST" @submit.prevent="register" v-if="!success">
              <!-- First name field -->
              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.name }">
                <label for="name" class="col-md-4 col-form-label text-md-right">First Name</label>
                <div class="col-md-6">
                  <input v-model="firstname" id="firstname" type="text" class="form-control" placeholder="First Name" required />
                </div>
                <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
              </div>
              <!-- Last name field -->
              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.name }">
                <label for="name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                <div class="col-md-6">
                  <input v-model="lastname" id="lastname" type="text" class="form-control" placeholder="Last Name" required />
                </div>
                <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
              </div>
              <!-- Email field -->
              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.email }">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                <div class="col-md-6">
                  <input
                    v-model="email"
                    type="email"
                    id="email"
                    class="form-control"
                    placeholder="user@example.com"
                    required
                  />
                  <span class="has-error" v-if="has_error && errors.email">{{ errors.email }}</span>
                </div>
              </div>
              <!-- Password field -->
              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.password }">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                  <input
                    v-model="password"
                    :type="passwordFieldType"
                    id="password"
                    class="form-control"
                    placeholder="Password"
                    required
                  />
                  <b-icon-eye-fill font-scale="1.5" @click="switchVisibility" />
                </div>

              </div>
              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.password }">
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                <div class="col-md-6">
                  <input
                    v-model="password_confirmation"
                    type="password"
                    class="form-control"
                    id="password_confirmation"
                    placeholder="Confirm Password"
                    required
                  />
                 <span class="has-error" v-if="has_error && errors.password">{{ errors.password }}</span>
                </div>
              </div>

              <div style="text-align:center">
                <input type="checkbox" id="checkbox" v-model="termsChecked">
                <label>I agree to the</label>
                <router-link to="/termsofservice">
                <a href="#">Terms Of Service</a>
                </router-link>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button v-if="termsChecked" type="submit" class="btn btn-primary">Register</button>
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
    authnav,
  },
   data() {
      return {
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        password_confirmation: '',
        termsChecked: false,
        has_error: false,
        error: '',
        errors: {},
        passwordFieldType: 'password',
        success: false
      }
    },
    methods: {
      switchVisibility() {
       this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
      },
      register() {
        this.$Progress.start();
        var app = this
        this.$auth.register({
          data: {
            firstname: app.firstname,
            lastname: app.lastname,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
            this.$Progress.finish();
          },
          error: function (res) {
            // console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
            this.$Progress.fail();
          }
        })
      }
    }
};
</script>

<style scoped>
a {
  color: #3490dc;
  text-decoration: none;
  background-color: transparent;
}

a:hover {
  color: #1d68a7;
  text-decoration: underline; 
  background-color: transparent;
}
</style>