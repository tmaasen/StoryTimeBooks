<template>
  <b-modal centered scrollable :id="`product-modal-${bookid}`" :title="title" @ok="handleOk">
    <b-overlay :show="busy" rounded="lg" opacity="0.6">
      <form method="POST" @submit.prevent="addProduct" ref="form" enctype="multipart/form-data">
        <!-- Product Name -->
        <b-form-group
          label="Product Name"
          label-for="name"
          invalid-feedback="Product Name is required"
          :state="productState"
        >
          <b-form-input id="name" v-model="name" required :state="productState"></b-form-input>
        </b-form-group>
        <!-- Author -->
        <b-form-group
          label="Author"
          label-for="author"
          invalid-feedback="Author is required"
          :state="productState"
        >
          <b-form-input id="author" v-model="author" required :state="productState"></b-form-input>
        </b-form-group>
        <!-- Category -->
        <b-form-group
          label="Category"
          label-for="categories"
          invalid-feedback="Product Category is required"
          :state="productState"
        >
          <b-form-select
            required
            :state="productState"
            name="categories"
            id="categories"
            v-model="categorySelected"
            :options="categoryOptions"
          ></b-form-select>
        </b-form-group>
        <!-- Publisher -->
        <b-form-group
          label="Publisher"
          label-for="publishers"
          invalid-feedback="Publisher is required"
          :state="productState"
        >
          <b-form-select
            required
            :state="productState"
            name="publishers"
            id="publishers"
            v-model="publisherSelected"
            :options="publisherOptions"
          ></b-form-select>
        </b-form-group>
        <!-- ISBN13 -->
        <b-form-group
          label="ISBN-13"
          label-for="isbn13"
          invalid-feedback="ISBN number is required"
          :state="productState"
        >
          <b-form-input id="isbn13" v-model="isbn13" required :state="productState"></b-form-input>
        </b-form-group>
        <!-- Copyright Date -->
        <b-form-group
          label="Copyright Date"
          label-for="copyright"
          invalid-feedback="Copyright Date is required"
          :state="productState"
        >
          <b-form-datepicker
            id="copyright"
            v-model="copyright"
            required
            :state="productState"
            class="border rounded p-2"
            locale="en"
            :max="max"
          ></b-form-datepicker>
        </b-form-group>
        <!-- Retail Price -->
        <b-form-group
          label="Retail Price"
          label-for="retail"
          invalid-feedback="Retail Price is required"
          :state="productState"
          prepend="$"
        >
          <b-input-group prepend="$">
            <b-form-input id="retail" v-model="retail" required :state="productState"></b-form-input>
          </b-input-group>
        </b-form-group>
        <!-- Company Cost -->
        <b-form-group
          label="StoryTime's Cost"
          label-for="cost"
          invalid-feedback="Company Cost is required"
          :state="productState"
        >
          <b-input-group prepend="$">
            <b-form-input id="cost" v-model="cost" required :state="productState"></b-form-input>
          </b-input-group>
        </b-form-group>
        <!-- Quantity on Hand -->
        <b-form-group
          label="Product Quantity"
          label-for="quantity"
          invalid-feedback="Product Quantity is required"
          :state="productState"
        >
          <b-form-spinbutton
            class="quantity"
            id="quantity"
            v-model="quantity"
            required
            :state="productState"
            min="1"
            max="100"
          ></b-form-spinbutton>
        </b-form-group>
        <!-- Product Image -->
        <b-form-group label="Product Image" label-for="image" :state="productState">
          <b-form-file
            name="image"
            id="image"
            v-model="image"
            v-on:change="onFileChange"
            :state="productState"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
        </b-form-group>
        <!-- Is Deleted -->
        <b-form-group
          label="Product State"
          label-for="isDeleted"
          invalid-feedback="A product must have a active (0) or inactive (1) state"
          :state="productState"
        >
          <b-form-select
            id="isDeleted"
            name="isDeleted"
            required
            :state="productState"
            v-model="deleteSelected"
            :options="deleteOptions"
          ></b-form-select>
        </b-form-group>
      </form>
    </b-overlay>
  </b-modal>
</template>

<script>
export default {
  data() {
    var today = new Date();
    var maxDate = new Date(today.getDate);
    return {
      busy: false,
      bookid1: this.bookid,
      name1: this.name,
      author1: this.author,
      publisher1: this.publisher,
      isbn131: this.isbn13,
      copyright1: this.copyright,
      retail1: this.retail,
      cost1: this.cost,
      quantity1: this.quantity,
      image1: this.image,
      publisherSelected1: this.publisherSelected,
      categorySelected1: this.categorySelected,
      deleteSelected1: this.deleteSelected,
      productState: null,
      publishers: [],
      publisherOptions: [],
      categories: [],
      categoryOptions: [],
      max: maxDate,
      deleteOptions: [
        { value: 0, text: "0" },
        { value: 1, text: "1" },
        { text: "0 is active, 1 is inactive" }
      ]
    };
  },
  props: {
    title: String,
    bookid: String,
    image: String,
    name: String,
    author: String,
    categorySelected: String,
    publisherSelected: String,
    isbn13: String,
    copyright: String,
    retail: String,
    cost: String,
    quantity: String,
    deleteSelected: String
  },
  created() {
    this.setPublisherOptions();
    this.setCategoryOptions();
  },
  methods: {
    setPublisherOptions() {
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/publishers")
        .then(response => {
          this.publishers = response.data.publishers;
          for (var i = 0; i < this.publishers.length; i++) {
            var option = [];
            for (var key in this.publishers[i]) {
              if (key == "id") {
                option["value"] = this.publishers[i][key];
              } else if (key == "publisher_name") {
                option["text"] = this.publishers[i][key];
              }
            }
            this.publisherOptions.push(Object.assign({}, option));
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    setCategoryOptions() {
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/categories")
        .then(response => {
          this.categories = response.data.categories;
          for (var i = 0; i < this.categories.length; i++) {
            var option = [];
            for (var key in this.categories[i]) {
              if (key == "id") {
                option["value"] = this.categories[i][key];
              } else if (key == "category") {
                option["text"] = this.categories[i][key];
              }
            }
            this.categoryOptions.push(Object.assign({}, option));
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.productState = valid;
      return valid;
    },
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault(); // Prevent modal from closing
      if (this.checkFormValidity()) {
        if (this.bookid !== null) this.updateProduct();
        else this.addProduct();
      }
    },
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.image = e.target.files[0];
    },
    addProduct() {
      let formData = new FormData();
      formData.append("product_image", this.image1);
      formData.append("product_name", this.name1);
      formData.append("author", this.author1);
      formData.append("category_id", this.categorySelected1);
      formData.append("publisher_id", this.publisherSelected1);
      formData.append("isbn_13", this.isbn131);
      formData.append("copyright_date", this.copyright1);
      formData.append("retail_price", this.retail1);
      formData.append("company_cost", this.cost1);
      formData.append("quantity_on_hand", this.quantity1);
      formData.append("is_deleted", this.deleteSelected1);

      axios
        .post("http://127.0.0.1:8000/api/v1/admin/newproduct", formData)
        .then(function(response) {
          console.log(response);
          window.location.reload();
        })
        .catch(function(response) {
          this.busy = false;
          console.log(response);
          alert(
            "There has been an error creating a new product. Please try again."
          );
        });
    },
    updateProduct(bookid) {
      const product = this;
      axios
        .put("http://127.0.0.1:8000/api/v1/admin/updateproduct/{id}", {
          id: product.bookid,
          product_image: product.image,
          product_name: product.name,
          author: product.author,
          category_id: product.categorySelected,
          publisher_id: product.publisherSelected,
          isbn_13: product.isbn13,
          copyright_date: product.copyright,
          retail_price: product.retail,
          company_cost: product.cost,
          quantity_on_hand: product.quantity,
          is_deleted: product.deleteSelected
        })
        .then(function(response) {
          console.log(response);
          window.location.reload();
        })
        .catch(error => {
          console.log(error);
          alert(
            "There has been an error updating product information. Please try again."
          );
        });
    }
  }
};
</script>

<style scoped>
.quantity {
  width: 50%;
}
</style>

