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
  <navbottom />
</div>
</template>
   
<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      firstname: 'foo'
    };
  },
  mounted() {
    console.log("Home mounted.");
  },
  components: {
    navtop,
    navbottom
  },
  mounted() {
  },
  methods: {

  }
};
</script>
<style>
.welcomeMessage {
  text-align: center;
  padding-top: 10px;
}
</style>