<template>
<div>
  <head>
    <title>StoryTime | Home</title>
  </head>
  <navtop />
  <p>Logged In: 
    <!-- {{$user.username}} -->
    </p>
  <navbottom />
</div>
</template>
   
<script>
import navtop from "../components/navtop";
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