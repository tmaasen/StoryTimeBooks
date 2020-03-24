<template>
<div>
  <head>
    <title>StoryTime | Home</title>
  </head>
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
</div>
</template>
   
<script>
import navtop from "../components/navtop";
import HomePageEdit from "../components/HomePageEdit";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      // username: null
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
    // this.getUsers();
  },
  methods: {
    // getUsers() {
    //   this.$http({
    //     url: "auth/user",
    //     method: "GET"
    //   }).then(
    //     res => {
    //       this.users = res.data.data.items;
    //       console.log("success " + this.context);
    //     },
    //     res => {
    //       console.log("error " + this.context);
    //     }
    //   );
    // }
  }
};
</script>