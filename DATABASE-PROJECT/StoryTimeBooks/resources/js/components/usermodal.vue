<template>
  <b-modal centered id="userModal" :title="title" @ok="handleOk" ok-title="Create User">
    <form method="POST" @submit.prevent="register" ref="form" v-if="!success">
      <!-- First Name -->
      <b-form-group
        label="First Name"
        label-for="firstname"
        invalid-feedback="First Name is required"
        :state="userState"
      >
        <b-form-input id="firstname" v-model="firstname" required :state="userState"></b-form-input>
      </b-form-group>
      <!-- Last Name -->
      <b-form-group
        label="Last Name"
        label-for="lasstname"
        invalid-feedback="Last Name is required"
        :state="userState"
      >
        <b-form-input id="lastname" v-model="lastname" required :state="userState"></b-form-input>
      </b-form-group>
      <!-- Email -->
      <b-form-group
        label="E-Mail Address"
        label-for="email"
        invalid-feedback="E-Mail Address is required"
        :state="userState"
      >
        <b-form-input id="email" v-model="email" type="email" required :state="userState"></b-form-input>
      </b-form-group>
      <!-- Password -->
      <b-form-group
        label="Password"
        label-for="password"
        invalid-feedback="Password is required"
        :state="userState"
      >
        <b-form-input id="password" v-model="password" type="password" required :state="userState"></b-form-input>
      </b-form-group>
      <!-- Password Confirm -->
      <b-form-group
        label="Confirm Password"
        label-for="password_confirm"
        invalid-feedback="Password confirmation does not match"
        :state="userState"
      >
        <b-form-input
          id="password_confirm"
          type="password"
          v-model="password_confirmation"
          required
          :state="userState"
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      firstname: "",
      lastname: "",
      email: "",
      password: "",
      password_confirmation: "",
      errors: {},
      success: false,
      userState: null
    };
  },
  props: {
    title: String
  },
  methods: {
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.userState = valid;
      return valid;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      if(this.checkFormValidity())
      this.register();
    },
    register() {
        var app = this;
        this.$auth.register({
          data: {
            firstname: app.firstname,
            lastname: app.lastname,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function() {
            app.success = true;
            location.reload(true);
          },
          error: function(res) {
            console.log(res.response.data.errors)
            app.has_error = true;
            app.error = res.response.data.error;
            app.errors = res.response.data.errors || {};
          }
        });
      }
    }
};
</script>