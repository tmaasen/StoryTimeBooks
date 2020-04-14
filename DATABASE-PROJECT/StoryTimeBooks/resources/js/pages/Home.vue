co<template>
<div v-if="$auth.ready()">
  <head>
    <title>StoryTime | Home</title>
  </head>
  <navtop class="pb-5" id="home"/>
  <!-- <div v-if="$auth.check()">
    <h1 class="welcomeMessage">Hello, {{ $auth.user().first_name }}</h1>
  </div> -->
  <HomePageEdit />
  <div class="toTop">
  <b-button v-scroll-to="'#home'" variant="primary" class="toTop rounded-circle p-2"><b-icon-arrow-up font-scale="2" /></b-button>
  </div>
  <navbottom />
</div>
</template>

<script>
import navtop from "../components/navtop";
import HomePageEdit from "../components/HomePageEdit";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {};
  },
  mounted() {
    console.log("Home mounted.");
  },
  components: {
    navtop,
    HomePageEdit,
    navbottom
  }
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
</style>
