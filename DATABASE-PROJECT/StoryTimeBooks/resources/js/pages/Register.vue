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

          <div class="card-body">
            <form method="POST">
              <!-- @csrf -->
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">First Name</label>

                <div class="col-md-6">
                  <input id="firstname" type="text" class="form-control" name="firstname" required />
                  <!-- @error('firstname') -->
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  <!-- @enderror -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Last Name</label>

                <div class="col-md-6">
                  <input
                    id="lastname"
                    type="text"
                    class="form-control"
                    name="lastname"
                    required
                  />

                  <!-- @error('lastname') -->
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  <!-- @enderror -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                <div class="col-md-6">
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    required
                    autocomplete="email"
                  />

                  <!-- @error('email') -->
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  <!-- @enderror -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    name="password"
                    required
                  />

                  <!-- @error('password') -->
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  <!-- @enderror -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    name="password_confirm"
                    required
                  />
                </div>
              </div>
              <div class="linksToTermsOfService">
                <router-link to="/terms">Terms Of Service</router-link>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Register</button>
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
  }
};
</script>

<style>
</style>