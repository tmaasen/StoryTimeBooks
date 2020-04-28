<template>
  <div>
    <b-navbar sticky-header toggleable="lg" type="dark" style="background-color: #252525">
      <router-link :to="{name: 'Home'}">
        <img src="../assets/StoryTime.png" width="200" class="navbar-brand" title="Go Home" />
      </router-link>
      <h2 class="mx-auto mt-4" style="color:white">Administrator</h2>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
            npm install vue-fuse      <nav class="mt-2 reports">
            <a href="#">Report 1</a>
            <a href="#">Report 2</a>
            <a href="#">Report 3</a>
          </nav>
          <b-dropdown variant="primary" id="dropdown-right" text="Left align">

            <template v-slot:button-content>
              <b-icon icon="person-fill" aria-hidden="true" font-scale="2"></b-icon>
              <span v-if="$auth.check()">{{ $auth.user().first_name }} {{$auth.user().last_name}}</span>
              <span v-if="!$auth.check()">My Account</span>
            </template>

            <router-link :to="{name: 'Admin'}" class="link">
              <b-dropdown-item-button v-if="$auth.user().role === '2'">
                Admin
                <span class="sr-only">(Not selected)</span>
              </b-dropdown-item-button>
            </router-link>

            <router-link :to="{name: 'Profile'}" class="link">
              <b-dropdown-item-button v-if="$auth.check()">
                Profile
                <span class="sr-only">(Not selected)</span>
              </b-dropdown-item-button>
            </router-link>

            <b-dropdown-item-button v-if="$auth.check()" @click.prevent="$auth.logout()">
              Logout
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>

          </b-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    logout() {
      this.$Progress.start();
      this.$auth.logout({
        makeRequest: true,
        params: {
          name: ""
        }, // data: {} in axios
        success: function() {
          this.$Progress.finish();
        },
        error: function() {
          this.$Progress.fail();
        },
        redirect: "/login"
      });
      this.$Progress.finish();
    }
  }
};
</script>


<style scoped>
.reports, nav a {
    color:white;
    text-decoration:none;
    padding-right: 10px;
    font-size: 18px;
    font-family: Helvetica, sans-serif;
    line-height: 1.6;
}
nav a:hover{
    color:white;
    text-decoration:underline;
}
span {
  font-size: 1.125rem;
}
select {
  margin-right: 10px;
}
.link {
  text-decoration: none;
  color: #252525;
}
.link:hover {
  text-decoration: none;
  background-color: #fff;
  color: #252525;
}
.textField {
  margin-left: 10px;
}
#shoppingCart {
  color: #ff8d1e;
  padding-left: 5px;
  padding-right: 5px;
  margin-left: 20px;
}
#shoppingCart:hover {
  border: 3px solid #fff;
  border-radius: 5px;
  background-color: #fff;
}
svg {
  fill: #ff8d1e;
}
.bg-info {
  background-color: #252525;
}
.btn {
  background-color: #ff8d1e;
}
.btn:hover {
  background-color: #2196f3;
}
.btn-group,
.btn-group-vertical {
  position: relative;
  display: -ms-inline-flexbox;
  display: inline-flex;
  vertical-align: middle;
  margin-left: 30px;
}

.dropdown-menu a:hover {
  background-color: #fff;
  color: #252525;
  text-decoration: none;
}
.dropdown-menu a {
  font-size: 1rem;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: right;
  min-width: 9.5rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #252525;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
}
</style>
