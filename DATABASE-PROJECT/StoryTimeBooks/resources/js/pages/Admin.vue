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
    <!-- Users -->
    <h1 style="text-align:center">Users</h1>
    <b-pagination
      v-model="currentUserPage"
      :total-rows="userrows"
      :per-page="perPage"
      aria-controls="users-table"
    ></b-pagination>
    <p class="mt-3">
      Current Page: {{ currentUserPage }}
      <b-button class="btn" style="color:white">Add User</b-button>
    </p>
    <b-table
      id="users-table"
      :per-page="perPage"
      :current-page="currentUserPage"
      small
      sticky-header
      striped
      hover
      :items="users"
      head-variant="light"
      class="w-85"
    ></b-table>
    <!-- Books -->
    <h1 style="text-align:center">Books</h1>
    <b-pagination
      v-model="currentBookPage"
      :total-rows="bookrows"
      :per-page="perPage"
      aria-controls="books-table"
      class="table"
    ></b-pagination>
    <p class="mt-3">
      Current Page: {{ currentBookPage }}
      <b-button class="btn" style="color:white">Add Book</b-button>
    </p>
    <b-table
      id="books-table"
      :per-page="perPage"
      :current-page="currentBookPage"
      small
      sticky-header
      striped
      hover
      :items="books"
      head-variant="light"
      class="w-85"
    ></b-table>
    <!-- Publishers -->
    <h1 style="text-align:center">Publishers</h1>
    <b-pagination
      v-model="currentPublisherPage"
      :total-rows="publisherrows"
      :per-page="perPage"
      aria-controls="publishers-table"
      class="table"
    ></b-pagination>
    <p class="mt-3">
      Current Page: {{ currentPublisherPage }}
      <b-button class="btn" style="color:white">Add Publisher</b-button>
    </p>
    <b-table
      id="publishers-table"
      :per-page="perPage"
      :current-page="currentPublisherPage"
      small
      sticky-header
      striped
      hover
      :items="publishers"
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
      currentUserPage: 1,
      users: [],
      currentBookPage: 1,
      books: [],
      currentPublisherPage: 1,
      publishers: []
    };
  },
  components: {
    navtop,
    navbottom
  },
  computed: {
    userrows() {
      return this.users.length;
    },
    bookrows() {
      return this.books.length;
    },
    publisherrows() {
      return this.publishers.length;
    }
  },
  mounted() {
    this.$Progress.start();
    // get users
    axios
      .get("http://127.0.0.1:8000/api/v1/admin/users")
      .then(response => {
        this.users = response.data.users;
        console.log(response);
      })
      .then(error => {
        console.log(error);
        this.$Progress.fail();
      });
    // get books
    axios
      .get("http://127.0.0.1:8000/api/v1/admin/products")
      .then(response => {
        this.books = response.data.books;
        console.log(response);
      })
      .then(error => {
        console.log(error);
        this.$Progress.fail();
      });
    // get publishers
    axios
      .get("http://127.0.0.1:8000/api/v1/admin/publishers")
      .then(response => {
        this.publishers = response.data.publishers;
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
<style scoped>
#wrapper {
  padding-left: 15px;
  padding-right: 15px;
}
.btn {
  background-color: #ff8d1e;
  color: #fff;
}
.btn:hover {
  background-color: #2196f3;
}
</style>