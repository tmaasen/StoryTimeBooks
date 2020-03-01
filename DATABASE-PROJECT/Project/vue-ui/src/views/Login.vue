<template>
  <div class="main-container">
    <h1 class="store-name">StoryTime Books</h1>
    <form>
      <div class="box-container">
        <h2 class="heading">Sign In</h2>
        <div class="form-fields" style="padding-top:50px">
          <input id="email" name="email" type="text" placeholder="Email Address" required />
        </div>
        <div class="form-fields">
          <input id="password" name="password" type="password" placeholder="Password" required />
        </div>
        <div class="form-fields">
          <button class="signIn" name="commit" type="submit">Sign In</button>
        </div>
      </div>
    </form>
    <div class="footer">
      <p>
        Don't have an account?
        <a href="/signup">Create one now</a>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    login: function() {
      let email = this.email;
      let password = this.password;
      this.$store
        .dispatch("login", { email, password }) // Do I need logic here to check if there is a match???
        .then(() => this.$router.push("/"))
        .catch(err => console.log(err));
    }
  }
  // name: 'login',
  // components: {

  // }
};
</script>