<template>
    <div v-if="$auth.ready()">
        <head>
            <title>StoryTime | Home</title>

        </head>
        <navtop @childSearchResults="childSearchResults($event)" class="pb-5" id="home"/>
        <div id="searchResults" ref="results">
            <ul class="list-group list-group-horizontal">
                <div v-if="searchResults == null"><li class="list-group-item">There are no search results!</li></div>
                <div v-for="(post, index) in searchResults"
                     :key="index">

                    <div v-if="post.item.category_id == 1">
                        <li class="list-group-item"><a :href="'#businessScroll'"
                                                       class="list-group-item list-group-item-action">
                            <p>{{post.item.product_name}}</p>
                        </a></li>
                    </div>
                    <div v-if="post.item.category_id == 2">
                        <li class="list-group-item"><a :href="'#computer'"
                                                       class="list-group-item list-group-item-action">
                            <p>{{post.item.product_name}}</p>
                        </a></li>
                    </div>
                    <div v-if="post.item.category_id == 3">
                        <li class="list-group-item"><a :href="'#psychologyScroll'"
                                                       class="list-group-item list-group-item-action">
                            <p>{{post.item.product_name}}</p>
                        </a></li>
                    </div>
                    <div v-if="post.item.category_id == 4">
                        <li class="list-group-item"><a :href="'#musicTheatreScroll'"
                                                       class="list-group-item list-group-item-action">
                            <p>{{post.item.product_name}}</p>
                        </a></li>
                    </div>
                    <div v-if="post.item.category_id == 5">
                        <li class="list-group-item"><a :href="'#engineeringScroll'"
                                                       class="list-group-item list-group-item-action">
                            <p>{{post.item.product_name}}</p>
                        </a></li>
                    </div>

                </div>
            </ul>
        </div>
        <!-- <div v-if="$auth.check()">
          <h1 class="welcomeMessage">Hello, {{ $auth.user().first_name }}</h1>
        </div> -->

        <HomePageEdit/>
        <div class="toTop">
            <b-button v-scroll-to="'#home'" variant="primary" class="toTop rounded-circle p-2">
                <b-icon-arrow-up font-scale="2"/>
            </b-button>
        </div>
        <navbottom/>
    </div>
</template>

<script>
    import navtop from "../components/navtop";
    import HomePageEdit from "../components/HomePageEdit";
    import navbottom from "../components/navbottom";
    import search from "../components/search";

    export default {
        data() {
            return {
                searchResults: [],
            };
        },
        mounted() {
            console.log("Home mounted.");
        },
        components: {
            navtop,
            HomePageEdit,
            navbottom,
            search
        },
        methods: {
            childSearchResults(param) {
                console.log("search results called in Home" + param)
                this.searchResults = param;

            }

        },
    };
</script>
<style scoped>
    .toTop {
        text-align: center;
        padding: 10px;
    }

    .btn {
        background-color: #ff8d1e;
        color: #fff;
    }

    .btn:hover {
        background-color: #2196f3;
        color: #fff;
    }
    .list-group{
        max-height: 100px;
        margin-bottom: 2px;
        /*overflow:scroll;*/
        overflow-x:auto;
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
        padding-bottom: 3rem;
    }

</style>
