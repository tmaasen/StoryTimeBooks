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
    >
      <!-- Delete icon -->
      <template v-slot:cell(actions)>
        <b-button class="tablebuttons" v-b-modal.remove-user>
          <b-icon id="icons" icon="trash-fill" variant="danger"></b-icon>
        </b-button>
        <b-modal id="remove-user" centered title="Delete User" @ok="removeUser">
          <p class="my-4">Select Ok to proceed with removing this user.</p>
          <p class="my-4">Select Cancel to cancel this process, or click out of the popup box.</p>
        </b-modal>
        <!-- Edit icon -->
        <b-button class="tablebuttons">
          <b-icon id="icons" style="margin-top:5px" icon="pencil-square" variant="info"></b-icon>
        </b-button>
      </template>
    </b-table>
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
    >
      <!-- Delete icon....1 icon click shows up all the modals for that icon for that table -->
      <template v-slot:cell(actions)>
        <b-button class="tablebuttons" v-b-modal.remove-product>
          <b-icon id="icons" icon="trash-fill" variant="danger"></b-icon>
        </b-button>
        <b-modal id="remove-product" centered title="Delete Product" @ok="removeProduct">
          <p class="my-4">Select Ok to proceed with removing this product from StoryTime Book's inventory.</p>
          <p class="my-4">Select Cancel to cancel this process, or click out of the popup box.</p>
        </b-modal>
        <!-- Edit icon -->
        <b-button class="tablebuttons">
          <b-icon id="icons" style="margin-top:5px" icon="pencil-square" variant="info"></b-icon>
        </b-button>
      </template>
      <!-- Book image -->
      <template v-slot:cell(product_image)="books">
        <img :src="getImgUrl(books.item.product_image)" width="60" height="75" />
      </template>
    </b-table>
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
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";
import userModal from "../components/usermodal";
import bookModal from "../components/bookmodal";
import publisherModal from "../components/publishermodal";
export default {
  data() {
    return {
      product_name: "",
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
    navbottom,
    userModal,
    bookModal,
    publisherModal
  },
  methods: {
    getImgUrl(pic) {
      if (pic !== null) {
        var images = require.context(
          "../../../public/uploads/products/",
          false,
          /\.jpg$/
        );
        return images("./" + pic);
      }
    },
    removeUser() {
      // set is_deleted to 1
    },
    removeProduct() {
      // soft delete
    },
    editUser() {
      // put request
    },
    editProduct() {
      // put request
    }
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
        //this.book_image = response.data.books.map(x => x.product_image);
        //this.product_name = response.data.books.map(x => x.product_name);
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
#icons {
  font-size: 2rem;
}
.tablebuttons {
  background: transparent;
  border: none;
  padding: 0%;
}
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
.editbtn:hover,
.addbtn:hover {
  background-color: #2196f3;
}
</style>