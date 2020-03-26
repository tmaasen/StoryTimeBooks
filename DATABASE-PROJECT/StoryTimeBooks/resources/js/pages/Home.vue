<template>
<div v-if="$auth.ready()">
  <head>
    <title>StoryTime | Home</title>
  </head>
  <navtop />
  <div v-if="$auth.check()">
    <h1 class="welcomeMessage">Hello, {{ $auth.user().firstname }}</h1>
    <hr />
  </div>
  <HomePageEdit />
  <navbottom />
</div>
</template>
   
<script>
import navtop from "../components/navtop";
import HomePageEdit from "../components/HomePageEdit";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      firstname: ""
    };
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
<style>
.welcomeMessage {
  text-align: center;
  padding-top: 10px;
}
</style>