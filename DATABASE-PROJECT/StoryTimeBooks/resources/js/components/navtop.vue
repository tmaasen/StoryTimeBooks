<template>
    <div>
        <b-navbar sticky-header toggleable="lg" type="dark" style="background-color: #252525">
            <router-link :to="{name: 'Home'}">
                <img src="../assets/StoryTime.png" width="200" class="navbar-brand" title="Go Home"/>
            </router-link>
            <!--        link to github repo-->
            <a alt="View on Github"
               href="https://github.com/polyestercupcake/Database-Systems/tree/master/DATABASE-PROJECT/StoryTimeBooks"
               id="githubButton">
                <img img src="../../../public/images/GitHub_Logo_White.png" width="60px" align="center"></a>


            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <!-- Collapseable nav -->
            <b-collapse id="nav-collapse" is-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <!--                    search function-->
                    <b-nav-form class="textField">
                        <b-form-select size="lg" class="mr-lg-10" v-model="searchFilter "
                                       :options="options"></b-form-select>
                        <b-form-input size="lg" class="mr-lg-2" placeholder="Search"
                                      v-model="searchInput" v-on:change="filterSearch"></b-form-input>

                        <b-button size="lg" class="my-2 my-lg-0" type="submit" @click="filterSearch" href="#">Search
                        </b-button>
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
                    <path d="M0 0h24v24H0z" fill="none"/>
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
    import search from './search'

    export default {

        data() {
            return {
                cartCounter: null,
                searchInput: "",
                searchFilter: "a",
                searchResults: [],

                options: [
                    {value: "a", text: "All"},
                    {value: "b", text: "Title"},
                    {value: "c", text: "Author"},
                    {value: "d", text: "Year"},
                    {value: "e", text: "Publisher"}
                ],
                name: "search",
                books: [],
                searchOptions: {
                    shouldSort: true,
                    includeMatches: true,
                    threshold: 0.5,
                    location: 0,
                    distance: 500,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: ['books', 'product_name']
                }

            };
        },
        components: {search},

        created() {
            this.getCartItems()
            this.getBooks()
        },
        methods: {
            filterSearch() {
                console.log("filter search called, value is: " + this.searchInput)

                //
                this.$search(this.searchInput, this.books, this.searchOptions).then(results => {
                    this.searchResults = results
                })
                //sends the data to Home.vue
                this.$emit("childSearchResults", this.searchResults)

                this.$emit("childSearchResults", this.searchResults)
            },
            getBooks() {
                axios.get("http://127.0.0.1:8000/api/v1/auth/products")
                    .then(response => {
                        // loop through the array, setting each book into a category group
                        this.books = response.data.books;
                        //  console.log(this.books)
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            logout() {
                this.$Progress.start();
                this.$auth.logout({
                    makeRequest: true,
                    params: {
                        name: ""
                    },
                    success: function () {
                        this.$Progress.finish();
                    },
                    error: function () {
                        this.$Progress.fail();
                    },
                    redirect: "/login"
                });
                this.$Progress.finish();
            },
            getCartItems(userid) {

            }
        }
    };
</script>


<style scoped>
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
