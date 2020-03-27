<template>
<div>
  <head>
    <title>StoryTime | Admin</title>
  </head>
  <navtop />
  <div>
    <br />
    <h1 style="text-align:center">Welcome, Administrator</h1>
    <hr />
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="users-table"
    ></b-pagination>
    <p class="mt-3">Current Page: {{ currentPage }}</p>
    <b-table
      id="users-table"
      :per-page="perPage"
      :current-page="currentPage"
      medium
      sticky-header
      striped
      hover
      :items="users"
      head-variant="light"
    ></b-table>
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
      perPage: 8,
      currentPage: 1,
      users: []
    };
  },
  components: {
    navtop,
    navbottom
  },
  computed: {
    rows() {
      return this.users.length;
    }
  },
  mounted() {
    // async function getAdminData() {
    //   const response = await Promise.all([
    //     axios.get("http://127.0.0.1:8000/api/v1/auth/users")
    //     .then(response => {
    //     this.users = response.data.users;
    //     console.log(response)
    //     })
    //     .then(error => {
    //       console.log(error);
    //     }),
    //     //axios.get("/some_url_endpoint") // next axios await request goes here
    //   ]);
    // }
    axios
      .get("http://127.0.0.1:8000/api/v1/auth/users")
      .then(response => {
        this.users = response.data.users;
        // this.First_Name = response.data.users.firstname;
        // this.Last_Name = response.data.users.lastname;
        console.log(response);
      })
      .then(error => {
        console.log(error);
      });
  }
};
</script>
<style>

</style>