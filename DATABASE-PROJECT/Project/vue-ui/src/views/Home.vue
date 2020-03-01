<template>
<div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand href="#">NavBar</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item href="#">Link</b-nav-item>
        <b-nav-item href="#" disabled>Disabled</b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-form>
          <b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>
          <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>

        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template v-slot:button-content>
            <em>User</em>
          </template>
          <b-dropdown-item href="#">Profile</b-dropdown-item>
          <b-dropdown-item href="/login">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
  <!-- <div>
    <HomeMenu />
    <div class="main-container">
      <div class="loginsuccess-container">
        <h2 class="heading">Login Success!</h2>
        <div>
          <div v-if="this.$store.state.loginUser.loginType == 'google'">
            Google Access Token - {{this.$store.state.loginUser.google.Zi.access_token}}
            <p>Welcome {{this.$store.state.loginUser.google.w3.ig}} !</p>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</template>

<script>
//import HomeMenu from '@/components/Menu'
export default {
  name: 'home',
  components: {
    //HomeMenu
  }
}
</script>