<template>
  <b-modal centered scrollable :id="`userModal${userid}`" @ok="updateUser(userid)" :title="title">
    <form method="POST" @submit.prevent="register" ref="form" v-if="!success">
      <!-- First Name -->
      <b-form-group
        label="First Name"
        label-for="firstname"
        invalid-feedback="First Name is required"
        :state="userState"
      >
        <b-form-input
          id="firstname"
          name="firstname"
          v-model="firstname"
          required
          :state="userState"
        ></b-form-input>
      </b-form-group>
      <!-- Last Name -->
      <b-form-group
        label="Last Name"
        label-for="lasstname"
        invalid-feedback="Last Name is required"
        :state="userState"
      >
        <b-form-input id="lastname" name="lastname" v-model="lastname" required :state="userState"></b-form-input>
      </b-form-group>
      <!-- Email -->
      <b-form-group
        label="E-Mail Address"
        label-for="email"
        invalid-feedback="E-Mail Address is required"
        :state="userState"
      >
        <b-form-input
          id="email"
          v-model="email"
          type="email"
          required
          :state="userState"
        ></b-form-input>
      </b-form-group>
      <!-- Password -->
      <b-form-group
        label="Password"
        label-for="password"
        invalid-feedback="Password is required"
        :state="userState"
      >
        <b-form-input
          id="password"
          v-model="password"
          type="password"
          required
          :state="userState"
        ></b-form-input>
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
          name="password_confirm"
          type="password"
          v-model="password_confirmation"
          required
          :state="userState"
        ></b-form-input>
      </b-form-group>
      <!-- Role -->
      <b-form-group
        label="Role"
        label-for="role"
        invalid-feedback="User role is required."
        :state="userState"
      >
        <b-form-select
          id="role"
          name="role"
          required
          :state="userState"
          v-model="roleSelected"
          :options="roleOptions"
        ></b-form-select>
      </b-form-group>
      <!-- Is Deleted -->
      <b-form-group
        label="User State"
        label-for="isDeleted"
        invalid-feedback="A user must have a active (0) or inactive (1) state"
        :state="userState"
      >
        <b-form-select
          id="isDeleted"
          name="isDeleted"
          required
          :state="userState"
          v-model="deleteSelected"
          :options="deleteOptions"
        ></b-form-select>
      </b-form-group>
    </form>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      roleOptions: [
        { value: 0, text: "0" },
        { value: 1, text: "1" },
        { value: 2, text: "2" },
        { text: "Please select a role" }
      ],
      deleteOptions: [
        { value: 0, text: "0" },
        { value: 1, text: "1" },
        { text: "0 is active, 1 is inactive" }
      ],
      firstname1: this.firstname,
      lastname1: this.lastname,
      email1: this.email,
      password1: this.password,
      password_confirmation1: this.password_confirmation,
      roleSelected1: this.roleSelected,
      deleteSelected1: this.deleteSelected,
      errors: {},
      success: false,
      userState: null
    };
  },
  props: {
    title: String,
    userid: String,
    firstname: String,
    lastname: String,
    email: String,
    password: String,
    password_confirmation: String,
    roleSelected: String,
    deleteSelected: String
  },
  methods: {
    updateUser(idToUpdate) {
      if (idToUpdate === null)
        this.registerUser();
      else {
      const user = this;
      axios
        .put("http://127.0.0.1:8000/api/v1/auth/updateuser/{id}", {
          first_name: user.firstname,
          last_name: user.lastname,
          email: user.email,
          password: user.password,
          password_confirmation: user.password_confirmation,
          role: user.roleSelected,
          is_Deleted: user.deleteSelected,
          id: idToUpdate
        })
        .then(function(response) {
          console.log(response);
          window.location.reload();
        })
        .catch(error => {
          console.log(error);
          alert(
            "There has been an error updating user information. Please try again."
          );
        });
      }
    },
    registerUser() {
      var app = this;
      this.$auth.register({
        data: {
          firstname: app.firstname1,
          lastname: app.lastname1,
          email: app.email1,
          password: app.password1,
          password_confirmation: app.password_confirmation1,
          role: app.roleSelected1,
          is_Deleted: app.deleteSelected1
        },
        success: function() {
          app.success = true;
          window.location.reload();
        },
        error: function(res) {
          console.log(res.response.data.errors);
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        }
      });
    },
  }
};
</script>