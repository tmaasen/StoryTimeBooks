<template>
<div>
  <head>
    <title>StoryTime | Admin</title>
  </head>
  <navtop />
  <br />
  <h1 style="text-align:center">Welcome, Administrator</h1>
  <hr />
  <div id="wrapper">
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="users-table"
    ></b-pagination>
    <p class="mt-3">Current Page: {{ currentPage }}
      <b-button class="btn" style="color:white">Add User</b-button>
    </p>
    <b-table
      id="users-table"
      :per-page="perPage"
      :current-page="currentPage"
      small
      sticky-header
      striped
      hover
      :items="users"
      head-variant="light"
      class="w-50"
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
    this.$Progress.start();
    axios
      .get("http://127.0.0.1:8000/api/v1/auth/users")
      .then(response => {
        this.users = response.data.users;
        console.log(response);
      })
      .then(error => {
        console.log(error);
        this.$Progress.fail();
      });
    this.$Progress.finish();
  }
};
</script>
<style>
#wrapper {
  padding-left: 10px;
}
</style>