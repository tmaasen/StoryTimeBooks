<template>
  <b-modal centered ref="forgotpwModal" id="forgotpwModal" :title="title" @ok="handleOk">
    <form method="POST" @submit.prevent="sendEmail" ref="form">
      <!-- Email -->
      <b-form-group
        label="Email"
        label-for="email"
        invalid-feedback="Email address is required"
        :state="userState"
      >
        <b-form-input id="email" v-model="email" required :state="userState"></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      userState: null,
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
      this.sendEmail();
    },
    sendEmail() {
      var app = this
      axios
      .get("../../../api/v1/auth/forgotpassword", {
        params:{email: this.email}
      })
      .then(function(response) {
        console.log(response);
        if (response.data.email_exists === true) {
          app.$refs['forgotpwModal'].hide()
          app.$notify({
                message: "A link to recover your password has been sent to your email.",
                type: "success",
                top: true,
                bottom: false,
                left: false,
                right: true,
                showClose: true,
                closeDelay: 4500,
              });
        } else {
          app.$refs['forgotpwModal'].hide()
          app.$notify({
              message: "This email does not exist.",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
        }
      })
      .catch(function(response) {
        console.log(response);
      });
      }
    }
};
</script>