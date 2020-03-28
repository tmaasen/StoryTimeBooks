<template>
  <!-- <header style="position:absolute; top:0px; left:0px; height:100px; right:0px;overflow:hidden;"> -->
  <div>
    <b-navbar sticky-header toggleable="lg" type="dark" style="background-color: #252525">
      <router-link :to="{name: 'Home'}">
        <img src="../assets/StoryTime.png" width="200" class="navbar-brand" alt="Go to Home" />
      </router-link>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <!-- Collapseable nav -->
      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-form class="textField">
            <b-form-select size="lg" class="mr-lg-10" v-model="searchFilter " :options="options"></b-form-select>
            <b-form-input size="lg" class="mr-lg-2" placeholder="Search"></b-form-input>
            <b-button size="lg" class="my-2 my-lg-0" type="submit">Search</b-button>
          </b-nav-form>
          <div>
            <a class="navbar-brand" id="shoppingCart" href="#">
              <span class="input-group-addon">
                <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 0 24 24" width="30">
                  <path
                    d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
                  />
                  <path d="M0 0h24v24H0z" fill="none" />
                </svg>
              </span>
              Cart
            </a>
          </div>
          <b-dropdown variant="primary" id="dropdown-right" text="Left align">
            <template v-slot:button-content>
              <b-icon icon="person-fill" aria-hidden="true" font-scale="2"></b-icon>
              <span v-if="$auth.check()">{{ $auth.user().first_name }} {{$auth.user().last_name}}</span>
              <span v-if="!$auth.check()">My Account</span>
            </template>

            <b-dropdown-item-button v-if="$auth.user().role === '2'">
              <b-icon icon="blank" aria-hidden="true"></b-icon>
              <a href="/admin" class="link">Admin</a>
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>
            
            <b-dropdown-item-button v-if="!$auth.check()">
             <b-icon icon="blank" aria-hidden="false"></b-icon>
              <a href="/profile" class="link">Profile</a>
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>

            <b-dropdown-item-button v-if="!$auth.check()">
              <a href="/login" class="link">Login</a>
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>

            <b-dropdown-item-button v-if="!$auth.check()">
              <a href="/register" class="link">Register</a>
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>

            <!-- Logout -->
            <!-- $auth.check() = unlogged user -->
            <!-- $auth.check(1) = user -->
            <!-- $auth.check(2) = admin user -->
            <b-dropdown-item-button v-if="$auth.check()" @click.prevent="$auth.logout()">
              <b-icon icon="blank" aria-hidden="true"></b-icon>Logout
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>
          </b-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
  <!-- </header> -->
</template>

<script>
export default {
  data() {
    return {
      searchFilter: "a",
      options: [
        // { value: null, text: "Please select some item" },
        { value: "a", text: "All" },
        { value: "b", text: "Title" },
        { value: "c", text: "Author" },
        { value: "d", text: "Year" },
        { value: "e", text: "Publisher" }
      ]
    };
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


<style>
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
}
svg {
  fill: #ff8d1e;
}
.bg-info {
  background-color: #252525;
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