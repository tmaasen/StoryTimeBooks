<template>
  <div id="app" class="padding">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/">StoryTime Books</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"></ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="nav-item" v-if="!$auth.check()">
              <router-link to="login">
              <a class="nav-link" href="#">Login</a>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="register">
              <a class="nav-link" href="#">Register</a>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("authnav mounted");
  }
}
</script>

<style>
.padding {
    padding-bottom: 35px;
}
a.navbar-brand:hover {
  color: #252525;
  background-color: #fff
}
a.nav-link:hover {
  color:#252525;
  background-color: #fff;
  text-decoration: none;
}
</style>