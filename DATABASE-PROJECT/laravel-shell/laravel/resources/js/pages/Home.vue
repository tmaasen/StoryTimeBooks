<template>
<div v-if="$auth.ready()">
  <head>
    <title>StoryTime | Home</title>
  </head>
  <navtop />
  <div v-if="$auth.check()">
    <h1 class="welcomeMessage">Hello, {{ name }}</h1>
    <hr />
  </div>
  <navbottom />
</div>
<div v-else>
  <b-spinner
    style="width: 3rem; height: 3rem;"
    class="d-flex justify-content-center"
    label="Large Spinner"
    variant="primary"
  ></b-spinner>
</div>
</template>
   
<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      name: ""
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
    this.fetch();
  },
  methods: {
    created() {
      this.$auth.ready(function() {
        console.log(this); // Will be proper context.
      });
    },
    fetch() {
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/user")
        .then(response => {
          console.log(response), (this.name = response.data.data["0"].name);
        })
        .catch(error => {
          console.log(error);
        });
    }
    // fetch() { //gets logged in user
    //   this.$auth.fetch({
    //     params: {
    //       name: this.$auth.user()
    //     },
    //     success() {
    //       console.log("success " + this.context);
    //     },
    //     error() {
    //       console.log("error " + this.context);
    //     }
    //   });
    // }
  }
};
</script>
<style>
.welcomeMessage {
  text-align: center;
  padding-top: 10px;
}
</style>