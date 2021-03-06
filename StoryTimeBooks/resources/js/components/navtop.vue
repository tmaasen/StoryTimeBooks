<template>
  <div>
    <b-navbar sticky-header toggleable="lg" type="dark" style="background-color: #252525">
      <router-link :to="{name: 'Home'}">
        <img src="../assets/StoryTime.png" width="200" class="navbar-brand" title="Go Home" />
      </router-link>
      <a
        title="View our source code on GitHub"
        target="_blank"
        href="https://github.com/tmaasen/StoryTimeBooks/tree/master/StoryTimeBooks"
        id="githubButton"
      >
        <img img src="../assets/GitHub_Logo_White.png" width="60px" align="center" />
        <span>
        <img img src="../assets/GitHub-Mark-Light-32px.png" height="25px" width="25px" align="center" />
        </span>
      </a>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <!-- Collapseable nav -->
      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <!--search function-->
          <b-nav-form @submit.prevent="filterSearch" class="textField">
            <b-form-select size="lg" id="selectSearch" class="mr-lg-10" v-model="searchFilter " :options="options"></b-form-select>
            <b-input
              size="lg"
              class="mr-lg-2"
              placeholder="Search"
              id="searchBar"
              v-model="searchInput"
              v-on:change="filterSearch"
              @keyup.enter="filterSearch"
            ></b-input>

            <b-button
              size="lg"
              class="my-2 my-lg-0"
              type="submit"
              @click="filterSearch"
              href="#"
              id="searchButton"
            >Search</b-button>
          </b-nav-form>
          <div>
            <router-link :to="`/user/cart/${$auth.user().id}`">
              <a class="navbar-brand" id="shoppingCart" href="#">
                <span class="input-group-addon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="30"
                    viewBox="0 0 24 24"
                    width="30"
                  >
                    <path
                      d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
                    />
                    <path d="M0 0h24v24H0z" fill="none" />
                  </svg>
                </span>
                Cart
                <span v-if="cartCounter > 0">({{ cartCounter }})</span>
                <span v-else>(0)</span>
              </a>
            </router-link>
          </div>
          <b-dropdown variant="primary" id="dropdown-right" text="Left align">
            <template v-slot:button-content>
              <b-icon icon="person-fill" id="avatar" aria-hidden="true" font-scale="2"></b-icon>
              <span v-if="$auth.check()">{{ $auth.user().first_name }} {{$auth.user().last_name}}</span>
              <span v-if="!$auth.check()">My Account</span>
            </template>

            <router-link :to="{name: 'Admin'}" class="link">
              <b-dropdown-item-button v-if="$auth.user().role === '2'">
                Admin
                <span class="sr-only">(Not selected)</span>
              </b-dropdown-item-button>
            </router-link>

            <router-link :to="`/user/profile/${$auth.user().id}`" class="link">
              <b-dropdown-item-button v-if="$auth.check()">
                Profile
                <span class="sr-only">(Not selected)</span>
              </b-dropdown-item-button>
            </router-link>

            <router-link :to="{name: 'Login'}">
              <b-dropdown-item-button v-if="!$auth.check()">
                Login
                <span class="sr-only">(Not selected)</span>
              </b-dropdown-item-button>
            </router-link>

            <router-link :to="{name: 'Register'}">
              <b-dropdown-item-button v-if="!$auth.check()">
                Register
                <span class="sr-only">(Not selected)</span>
              </b-dropdown-item-button>
            </router-link>

            <!-- Logout -->
            <!-- $auth.check() = unlogged user -->
            <!-- $auth.check(1) = user -->
            <!-- $auth.check(2) = admin user -->
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
    return {
      cartCounter: null,
      searchInput: "",
      searchFilter: "a",
      searchResults: [],
      books: [],

      options: [
        { value: "a", text: "All" },
        { value: "b", text: "Title" },
        { value: "c", text: "Author" },
      ],
      name: "search",
      searchOptions: {
        shouldSort: true,
        includeMatches: true,
        threshold: 0.5,
        location: 0,
        distance: 500,
        maxPatternLength: 32,
        minMatchCharLength: 1,
        keys: ["books", "product_name", "author"]
      }
    };
  },
  created() {
    this.getItemsInCart();
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios
        .get("../../../api/v1/auth/products")
        .then(response => {
          this.books = response.data.books;
        })
        .then(error => {
          console.log(error)
        });
    },
    filterSearch() {
      this.$search(this.searchInput, this.books, this.searchOptions).then(
        results => {
          this.searchResults = results;
        }
      );
      //sends the data to searchresults component
      this.$emit("childSearchResults", this.searchResults);
    },
    logout() {
      this.$auth.logout({
        makeRequest: true,
        params: {
          name: ""
        },
        success: function() {
          this.$Progress.start();
          this.$Progress.finish();
        },
        error: function() {
          this.$Progress.fail();
        },
        redirect: "/login"
      });
      this.$Progress.finish();
    },
    getItemsInCart() {
      var app = this;
      if (app.$auth.check()) {
      axios
        .get("../../../api/v1/auth/itemsincart/{id}", {
          params: { user_id: this.$auth.user().id }
        })
        .then(function(response) {
          app.cartCounter = response.data.items;
          app.$emit("updateItemCount", app.cartCounter);
        })
        .catch(error => {
          console.log(error);
        });
      }
    }
  }
};
</script>


<style scoped>
@media only screen and (max-width: 1315px) {
    #searchButton, #selectSearch, #searchBar {
      display: none !important;
    }
}
@media only screen and (max-width: 768px) {
    .navbar {
      width: 100%;
    }
    #githubButton {
      display: none;
    }
}
@media screen and (max-width: 468px) {
  #selectSearch {display: none;}
  #searchBar {display: none;}
  #dropdown-right {width: 35%;}
  #avatar {display: none;}
  #searchButton {display: none;}
  .btn-group {margin-right: auto;}
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
b-navbar {
  margin-bottom: 0;
}
#githubButton {
  text-align: center;
  align-content: center;
  padding-left: 10%;
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
