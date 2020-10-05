<template>
    <div>
        <navtop @childSearchResults="childSearchResults($event)" />
        <div id="searchResults" ref="results">
            <ul class="list-group list-group-horizontal">
                <div v-for="(post, index) in searchResults" :key="index">
                    <div v-if="post.item.category_id == 8">
                        <li class="list-group-item">
                            <a
                                :href="'#'"
                                v-scroll-to="'#businessScroll'"
                                class="list-group-item list-group-item-action"
                            >
                                <p>{{ post.item.product_name }}</p>
                            </a>
                        </li>
                    </div>
                    <div v-if="post.item.category_id == 9">
                        <li class="list-group-item">
                            <a
                                :href="'#'"
                                v-scroll-to="'#computer'"
                                class="list-group-item list-group-item-action"
                            >
                                <p>{{ post.item.product_name }}</p>
                            </a>
                        </li>
                    </div>
                    <div v-if="post.item.category_id == 10">
                        <li class="list-group-item">
                            <a
                                :href="'#'"
                                v-scroll-to="'#psychologyScroll'"
                                class="list-group-item list-group-item-action"
                            >
                                <p>{{ post.item.product_name }}</p>
                            </a>
                        </li>
                    </div>
                    <div v-if="post.item.category_id == 11">
                        <li class="list-group-item">
                            <a
                                :href="'#'"
                                v-scroll-to="'#musicTheatreScroll'"
                                class="list-group-item list-group-item-action"
                            >
                                <p>{{ post.item.product_name }}</p>
                            </a>
                        </li>
                    </div>
                    <div v-if="post.item.category_id == 12">
                        <li class="list-group-item">
                            <a
                                :href="'#'"
                                v-scroll-to="'#engineeringScroll'"
                                class="list-group-item list-group-item-action"
                            >
                                <p>{{ post.item.product_name }}</p>
                            </a>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</template>

<script>
import navtop from "./navtop";

export default {
    data() {
        return {
            searchResults: []
        };
    },
    components: {
        navtop,
    },
    methods: {
        childSearchResults(param) {
            this.searchResults = param;
        }
    }
};
</script>

<style scoped>
.header {
  padding: 10px;
  text-align: center;
  background: rgb(37, 37, 37);
  color: white;
  font-size: 30px;
  margin-bottom: -1%;
  font-weight: bold;
}
template {
  scroll-behavior: smooth !important;
}
@media screen and (max-width: 1000px) {
  .jumbotron {
    display: none;
  }
}
.jumbotron {
  background-image: url("../assets/colorful-books-on-shelf-5710.jpg");
  background-size: contain;
  padding: 10rem 2rem;
  margin-bottom: 2rem;
  background-color: #e9ecef;
  border-radius: 0.3rem;
  padding-left: 400px;
  padding-right: 400px;
}
.jumbomessage {
  background-color: #e9ecef;
  border-radius: 0.5em;
  font: status-bar;
  padding: 10px;
}

.title {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 10px;
  font-size: 50px;
}

.btn {
  background-color: #ff8d1e;
  color: #fff;
  margin: 10px auto;
}
.btn:hover {
  background-color: #2196f3;
  color: #fff;
}
.list-group {
  max-height: 100px;
  margin-bottom: 2px;
  /*overflow:scroll;*/
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  white-space: nowrap;
  padding-bottom: 3rem;
}
</style>

