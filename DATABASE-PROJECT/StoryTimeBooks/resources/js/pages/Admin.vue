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
      <b-button class="addbtn" style="color:white" v-b-modal.userModal>Add User</b-button>
        <userModal title="Add User" />
      <b-input v-model="editUserInput" placeholder="Enter User Id" class="input"></b-input>
        <b-button class="editbtn" style="color:white">Edit User</b-button>
    </p>
    <b-table
      id="users-table"
      selectable
      select-mode="single"
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
    <hr />
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
      <b-button class="addbtn" style="color:white" v-b-modal.bookModal>Add Book</b-button>
        <bookModal title="Add Product" />
      <b-input v-model="editBookInput" placeholder="Enter Book Id" class="input"></b-input>
        <b-button class="editbtn" style="color:white">Edit Book</b-button>
    </p>
    <b-table
      id="books-table"
      
      selectable
      select-mode="single"
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
    <hr />
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
      <b-button class="addbtn" style="color:white" v-b-modal.publisherModal>Add Publisher</b-button>
        <publisherModal title="Add Publisher" />
      <b-input v-model="editPublisherInput" placeholder="Enter Publisher Id" class="input"></b-input>
        <b-button class="editbtn" style="color:white">Edit Publisher</b-button>
    </p>
    <b-table
      id="publishers-table"
      selectable
      select-mode="single"
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
import navtop from "../components/navtop"
import navbottom from "../components/navbottom"
import userModal from "../components/usermodal"
import bookModal from "../components/bookmodal"
import publisherModal from "../components/publishermodal"
export default {
  data() {
    return {
      perPage: 8,
      currentUserPage: 1,
      users: [],
      currentBookPage: 1,
      books: [],
      currentPublisherPage: 1,
      publishers: [],
      editUserInput: "",
      editBookInput: "",
      editPublisherInput: "",
    };
  },
  components: {
    navtop,
    navbottom,
    userModal,
    bookModal,
    publisherModal,
  },
  methods: {
    
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
  created() {
    // get users
    axios
      .get("http://127.0.0.1:8000/api/v1/admin/users")
      .then(response => {
        this.users = response.data.users;
        console.log(response);
      })
      .then(error => {
        console.log(error);
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
      });
  }
};
</script>
<style scoped>
#wrapper {
  padding-left: 15px;
  padding-right: 15px;
}
.addbtn {
  background-color: #ff8d1e;
  color: #fff;
  margin-left: 5%;
}
.editbtn {
  background-color: #ff8d1e;
  color: #fff;
}
.editbtn:hover, .addbtn:hover {
  background-color: #2196f3;
}
.input {
  margin-left:5%;
  width:15%;
  display:inline !important
}
</style>