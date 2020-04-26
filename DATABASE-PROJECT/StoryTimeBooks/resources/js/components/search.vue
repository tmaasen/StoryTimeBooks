<template>
    <div class="position-relative">
        <!--        <div class="position-relative">-->
        <!--            <b-nav-form class="textField">-->
        <!--                <b-form-select size="lg" class="mr-lg-10" v-model="searchFilter " :options="options"></b-form-select>-->
        <!--                        <b-form-input size="lg" class="mr-lg-2" placeholder="Search" v-model="searchInput" ></b-form-input>-->

        <!--                <b-button size="lg" class="my-2 my-lg-0" type="submit" @click="filterSearch" href="#">Search</b-button>-->
        <!--            </b-nav-form>-->
        <!--        </div>-->
        <!--        results-->


        <div id="searchResults" ref="results">
            <b-container>
                <div v-for="(post, index) in searchResults"
                     :key="index">
                    <div v-if="post.item.category_id == 1">
                        <a :href="'#businessScroll'">
                            <b-row>{{post.item.product_name}}</b-row>
                        </a>
                    </div>
                    <div v-if="post.item.category_id == 2">
                        <a :href="'#computer'">
                            <b-row>{{post.item.product_name}}</b-row>
                        </a>
                    </div>
                    <div v-if="post.item.category_id == 3">
                        <a :href="'#psychologyScroll'">
                            <b-row>{{post.item.product_name}}</b-row>
                        </a>
                    </div>
                    <div v-if="post.item.category_id == 4">
                        <a :href="'#musicTheatreScroll'">
                            <b-row>{{post.item.product_name}}</b-row>
                        </a>
                    </div>
                    <div v-if="post.item.category_id == 5">
                        <a :href="'#engineeringScroll'">
                            <b-row>{{post.item.product_name}}</b-row>
                        </a>
                    </div>


                </div>
            </b-container>
            <div>
                <p v-if="searchInput > 0 && index == 0">No results for '<strong>{{searchInput}}</strong>'</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
            }
        },
        created() {
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
            }

        }

    }

</script>

<style scoped>
    #searchResults {
        background-color: white;
        width: 10rem;

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
