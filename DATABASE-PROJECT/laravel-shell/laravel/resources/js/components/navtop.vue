<template>
  <div>
    <b-navbar sticky-header toggleable="lg" type="dark" style="background-color: #252525">
      <a href="#">
        <img src="../assets/StoryTime.png" width="200" class="navbar-brand" alt="Go to Home" />
      </a>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <div>
            <b-form-select size= "lg" v-model="selected" :options="options"></b-form-select>
            <!--<div class="mt-3">{{ selected }}</div>-->
          </div>
          <b-nav-form class="textField">
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
          <b-dropdown variant="primary">

            
            <template v-slot:button-content>
              <b-icon icon="person-fill" aria-hidden="true"></b-icon>My Account
            </template>

            
            <b-dropdown-item-button href="#">
              <b-icon icon="blank" aria-hidden="true"></b-icon>Profile
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>
            <b-dropdown-item-button>
              <b-icon icon="blank" aria-hidden="true"></b-icon>
              <router-link to="/logout" target="_blank">
              <a>Logout</a>
              </router-link>
              <span class="sr-only">(Selected)</span>
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
    return {
      selected: "a",
      options: [
        // { value: null, text: "Please select some item" },
        { value: "a", text: "All" },
        { value: "b", text: "Title" },
        { value: "c", text: "Author" },
        { value: "d", text: "Year" },
        { value: "e", text: "Publisher" }
      ]
    };
  }
};
</script>


<style>
.textField {
  margin-left: 5px;
}

.bg-info {
  background-color: #252525 !important;
}
.hoverable a:hover {
  background-color: #252525;
  color: #fff;
}

.btn-group,
.btn-group-vertical {
  position: relative;
  display: -ms-inline-flexbox;
  display: inline-flex;
  vertical-align: middle;
  margin-left: 5px;
}

.dropdown-menu a:hover {
  background-color: #252525;
  color: #fff;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
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