<template>
<div>
  <div v-if="$auth.user().role === '2'">
    <head>
      <title>StoryTime | Admin</title>
    </head>
      <!-- <adminnav v-on:getreport1="report1" v-on:getreport2="report2" v-on:getreport3="report3" /> -->
      <adminnav />
      <b-overlay :show="busy" rounded="lg" opacity="1.0">
      <br />
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
          <b-button class="addbtn" style="color:white" v-b-modal="`userModal${null}`">Add User</b-button>
          <userModal 
          title="Add User" 
          :userid="null" 
          v-on:refreshTables="getAll" />
        </p>
        <b-table
          id="users-table"
          selectable
          select-mode="single"
          ref="userTable"
          :primary-key="users.id"
          :busy.sync="busy"
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
          <template v-slot:cell(actions)="users">
            <b-button class="tablebuttons" v-b-modal="`remove-user-${users.item.id}`">
              <b-icon id="icons" icon="trash-fill" variant="danger"></b-icon>
            </b-button>
            <b-modal
              :id="`remove-user-${users.item.id}`"
              centered
              title="Delete User"
              @ok="removeUser(users.item.id)"
            >
              <div v-if="users.item.is_deleted === 0">
                <p class="my-4">
                  Are you sure you want to remove
                  <i>
                    <b>{{users.item.first_name}} {{users.item.last_name}}</b>
                  </i> ?
                </p>
                <p class="my-2">Select Ok to proceed with removing this user.</p>
                <p class="my-4">Select Cancel to cancel this process, or click out of the popup box.</p>
              </div>
              <div v-else>
                <p class="my-2">This user has already been removed.</p>
              </div>
            </b-modal>
            <!-- Edit icon -->
            <b-button class="tablebuttons" v-b-modal="`userModal${users.item.id}`">
              <b-icon id="icons" style="margin-top:5px" icon="pencil-square" variant="info"></b-icon>
            </b-button>
            <userModal
              :id="`userModal${users.item.id}`"
              title="Edit User"
              :userid="`${users.item.id}`"
              :firstname="`${users.item.first_name}`"
              :lastname="`${users.item.last_name}`"
              :email="`${users.item.email}`"
              :password="`${users.item.password}`"
              :password_confirmation="`${users.item.password_confirmation}`"
              :roleSelected="`${users.item.role}`"
              :deleteSelected="`${users.item.is_deleted}`"
              v-on:refreshTables="getAll"
            />
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
          <b-button class="addbtn" style="color:white" v-b-modal="`product-modal-${null}`">Add Book</b-button>
          <bookModal 
          title="Add Product" 
          :bookid="null" 
          v-on:image="getImgUrl"
          v-on:refreshTables="getAll" />
        </p>
        <b-table
          id="books-table"
          selectable
          select-mode="single"
          ref="bookTable"
          :per-page="perPage"
          :current-page="currentBookPage"
          small
          sticky-header
          striped
          hover
          :items="books"
          :fields="bookfields"
          head-variant="light"
          class="w-85"
        >
          <template v-slot:cell(product_image)="books">
            <img :src="getImgUrl(books.item.product_image)" width="60" height="75" />
          </template>
          <template v-slot:cell(product_name)="books">
            <span>{{books.item.product_name}}</span>
          </template>
          <template v-slot:cell(author)="books">
            <span>{{books.item.author}}</span>
          </template>
          <template v-slot:cell(category)="books">
            <span>{{books.item.category}}</span>
          </template>
          <template v-slot:cell(publisher)="books">
            <span>{{books.item.publisher_name}}</span>
          </template>
          <template v-slot:cell(isbn_13)="books">
            <span>{{books.item.isbn_13}}</span>
          </template>
          <template v-slot:cell(copyright)="books">
            <span>{{books.item.copyright_date}}</span>
          </template>
          <template v-slot:cell(retail_price)="books">
            <span>{{books.item.retail_price}}</span>
          </template>
          <template v-slot:cell(company_cost)="books">
            <span>{{books.item.company_cost}}</span>
          </template>
          <template v-slot:cell(quantity_on_hand)="books">
            <span>{{books.item.quantity_on_hand}}</span>
          </template>
          <!-- Delete icon -->
          <template v-slot:cell(actions)="books">
            <b-button class="tablebuttons" v-b-modal="`remove-product-${books.item.id}`">
              <b-icon id="icons" icon="trash-fill" variant="danger"></b-icon>
            </b-button>
            <b-modal
              :id="`remove-product-${books.item.id}`"
              centered
              title="Delete Product"
              @ok="removeProduct(books.item.id)"
            >
              <div v-if="books.item.is_deleted === 0">
                <p class="my-4">
                  Are you sure you want to delete
                  <i>
                    <b>{{books.item.product_name}}</b>
                  </i> ?
                </p>
                <p
                  class="my-2"
                >Select Ok to proceed with removing this product from StoryTime Book's inventory.</p>
                <p class="my-4">Select Cancel to cancel this process, or click out of the popup box.</p>
              </div>
              <div v-else>
                <p class="my-4">This product has already been deleted.</p>
              </div>
            </b-modal>
            <!-- Edit icon -->
            <b-button class="tablebuttons" v-b-modal="`product-modal-${books.item.id}`">
              <b-icon id="icons" style="margin-top:5px" icon="pencil-square" variant="info"></b-icon>
            </b-button>
            <bookModal
              :id="`product-modal-${books.item.id}`"
              title="Edit Product"
              :bookid="`${books.item.id}`"
              :image="`${books.item.product_image}`"
              :name="`${books.item.product_name}`"
              :author="`${books.item.author}`"
              :categorySelected="`${books.item.category_id}`"
              :publisherSelected="`${books.item.publisher_id}`"
              :isbn13="`${books.item.isbn_13}`"
              :copyright="`${books.item.copyright_date}`"
              :retail="`${books.item.retail_price}`"
              :cost="`${books.item.company_cost}`"
              :quantity="`${books.item.quantity_on_hand}`"
              :deleteSelected="`${books.item.is_deleted}`"
              v-on:refreshTables="getAll"
            />
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
          <publisherModal 
          title="Add Publisher" 
          v-on:refreshTables="getAll"
          />
        </p>
        <b-table
          id="publishers-table"
          selectable
          select-mode="single"
          ref="publisherTable"
          :busy.sync="busy"
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
        <hr />
        <!-- Categories -->
        <h1 style="text-align:center">Categories</h1>
        <b-pagination
          v-model="currentCategoryPage"
          :total-rows="categoryrows"
          :per-page="perProductCategoryPage"
          aria-controls="category-table"
          class="table"
        ></b-pagination>
        <p class="mt-3">
          Current Page: {{ currentCategoryPage }}
          <b-button class="addbtn" style="color:white" v-b-modal.categoryModal>Add Product Category</b-button>
          <categoryModal 
          title="Add Product Category" 
          v-on:refreshTables="getAll"
          />
        </p>
        <b-table
          id="category-table"
          selectable
          select-mode="single"
          ref="categoryTable"
          :busy.sync="busy"
          :per-page="perProductCategoryPage"
          :current-page="currentCategoryPage"
          small
          sticky-header
          striped
          hover
          :items="categories"
          head-variant="light"
          class="w-50"
        ></b-table>
        <hr />
        <!-- Report 1: Order Summary -->
        <h1 id="report1-table" style="text-align:center">Order Summary</h1>
        <b-pagination
          v-model="currentOrderSummaryPage"
          :total-rows="ordersummaryrows"
          :per-page="perPage"
          class="table"
        ></b-pagination>
        <b-table
          ref="report1"
          selectable
          select-mode="single"
          :busy.sync="busy"
          :per-page="perPage"
          :current-page="currentOrderSummaryPage"
          small
          sticky-header
          striped
          hover
          :items="orderSummary"
          head-variant="light"
          class="w-50"
        ></b-table>
        <hr />
        <!-- Report 2: Customers by State -->
        <h1 id="report2-table" style="text-align:center">Customers By State</h1>
        <b-pagination
          v-model="currentCustomerByStatePage"
          :total-rows="customersbystaterows"
          :per-page="perStatePage"
          class="table"
        ></b-pagination>
        <b-table
          selectable
          select-mode="single"
          :busy.sync="busy"
          :per-page="perStatePage"
          :current-page="currentCustomerByStatePage"
          small
          sticky-header
          striped
          hover
          :items="customersByState"
          head-variant="light"
          class="w-50"
        ></b-table>
        <hr />
        <!-- Report 3: Inventory by Product Category -->
        <h1 id="report3-table" style="text-align:center">Inventory By Product Category</h1>
        <b-pagination
          v-model="currentInventoryByCategoryPage"
          :total-rows="inventorybycategoryrows"
          :per-page="perProductCategoryPage"
          class="table"
        ></b-pagination>
        <b-table
          selectable
          select-mode="single"
          :busy.sync="busy"
          :per-page="perProductCategoryPage"
          :current-page="currentInventoryByCategoryPage"
          small
          sticky-header
          striped
          hover
          :items="inventoryByCategory"
          head-variant="light"
          class="w-50"
        ></b-table>
      </div>
      <hr />
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <p>Copyright StoryTime Books © 2020. All rights reserved.</p>
            </div>
          </div>
        </div>
      </footer>
    </b-overlay>
  </div>
  <div v-else>
    <restricted />
  </div>
</div>
</template>

<script>
import restricted from "./403";
import adminnav from "../components/administratornav";
import navbottom from "../components/navbottom";
import userModal from "../components/usermodal";
import bookModal from "../components/bookmodal";
import publisherModal from "../components/publishermodal";
import categoryModal from "../components/categorymodal"
export default {
  data() {
    return {
      busy: false,
      perPage: 4,
      perStatePage: 10,
      perProductCategoryPage: 5,
      currentUserPage: 1,
      users: [],
      currentBookPage: 1,
      books: [],
      currentPublisherPage: 1,
      publishers: [],
      orderSummary:[],
      currentOrderSummaryPage: 1,
      customersByState:[],
      currentCustomerByStatePage: 1,
      inventoryByCategory:[],
      currentInventoryByCategoryPage: 1,
      currentCategoryPage: 1,
      categories: [],
      bookfields:["Product_Image", "Product_Name", "Author", "Category", 
      "Publisher", "ISBN_13", "Copyright", "Retail_Price", "Company_Cost", "Quantity_On_Hand", "Actions"],
    };
  },
  components: {
    restricted,
    adminnav,
    navbottom,
    userModal,
    bookModal,
    publisherModal,
    categoryModal
  },
  created() {
    this.getAll();
  },
  computed: {
    userrows() {
      return this.users.length;
    },
    bookrows() {
      return this.books.length - 1;
    },
    publisherrows() {
      return this.publishers.length;
    },
    categoryrows() {
      return this.categories.length;
    },
    ordersummaryrows() {
      return this.orderSummary.length;
    },
    customersbystaterows() {
      return this.customersByState.length;
    },
    inventorybycategoryrows() {
      return this.inventoryByCategory.length;
    }
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
    removeUser(idToRemove) {
      var app = this;
      app.busy = true;
      axios
        .post("http://127.0.0.1:8000/api/v1/auth/removeuser/{id}", {
          params: {id: { idToRemove }}
        })
        .then(function(response) {
          console.log(response);
          app.busy = false;
          app.getAll();
        })
        .catch(function(response) {
          console.log(response);
          app.busy = false;
          app.$notify({
            message: "There has been an error while removing this user. Please try again.",
            type: "error",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 4500,
          });
        });
    },
    removeProduct(idToRemove) {
      var app = this;
      app.busy = true;
      axios
        .post("http://127.0.0.1:8000/api/v1/admin/removeproduct/{id}", {
         params:{ id: { idToRemove }}
        })
        .then(function(response) {
          console.log(response);
          app.busy = false;
          app.getAll();
        })
        .catch(function(response) {
          console.log(response);
          app.busy = false;
          app.$notify({
              message: "There has been an error while removing this product. Please try again.",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
        });
    },
    getAll() {
      var app = this
      app.busy = true;
      this.report1()
      this.report2()
      this.report3()
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/all")
        .then(response => {
          this.users = response.data.users;
          this.books = response.data.books;
          this.publishers = response.data.publishers;
          this.categories = response.data.categories;
          console.log(response);
          app.busy = false;
        })
        .then(error => {
          console.log(error);
          app.busy = false;
        });
      },
    report1() {
      var app = this
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/reports/ordersummary")
        .then(response => {
          this.orderSummary = response.data.results;
          console.log(response);
        })
        .then(error => {
          console.log(error);
        });
    },
    report2() {
      var app = this
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/reports/customersbystate")
        .then(response => {
          this.customersByState = response.data.results;
          console.log(response);
        })
        .then(error => {
          console.log(error);
        });
    },
    report3() {
      var app = this
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/reports/inventorybycategory")
        .then(response => {
          this.inventoryByCategory = response.data.results;
          console.log(response);
        })
        .then(error => {
          console.log(error);
        });
    }
  },
};
</script>
<style scoped>
.tablewidth {
  width: 13%!important;
}
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