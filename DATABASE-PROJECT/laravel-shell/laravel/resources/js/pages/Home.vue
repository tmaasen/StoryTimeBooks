<template>
<div v-if="$auth.ready()">
  <head>
    <title>StoryTime | Home</title>
  </head>
<<<<<<< HEAD
  <body style="height:100%; width:100%">
      <navtop />
    <HomePageEdit />
    <!--
    <p>
    Logged In:
    {{$user.username}}
    </p>
    -->
      <navbottom />
  </body>
=======
  <navtop />
  <div v-if="$auth.check()">
    <h1 class="welcomeMessage">Hello, {{ name }}</h1>
    <hr />
  </div>
  <navbottom />
>>>>>>> 1a98511abd27c3482087e9a8875c8095d40243cb
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
import HomePageEdit from "../components/HomePageEdit";
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
    HomePageEdit,
    navbottom
  },
  mounted() {
    this.fetch();
  },
  methods: {
<<<<<<< HEAD
    // getUsers() {
    //   this.$http({
    //     url: "auth/user",
    //     method: "GET"
    //   }).then(
    //     res => {
    //       this.users = res.data.data.items;
=======
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
>>>>>>> 1a98511abd27c3482087e9a8875c8095d40243cb
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