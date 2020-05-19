<template>
  <b-modal centered scrollable ref="bookModel" :id="`product-modal-${bookid}`" :title="title" @ok="handleOk">
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
          <b-form-input id="isbn13" v-model="isbn13" v-mask="'9999999999999'" required :state="productState"></b-form-input>
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
            v-on:input="checkCurrentDate"
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
            <b-form-input id="retail" v-model="retail" required v-mask="'9{1,4}.99'" :state="productState"></b-form-input>
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
            <b-form-input id="cost" v-model="cost" required v-mask="'9{1,4}.99'" :state="productState"></b-form-input>
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
            v-if="!image"
            name="image"
            id="image"
            v-model="image"
            v-on:change="onFileChange"
            :state="productState"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
          <b-form-file
            v-else
            name="image"
            id="image"
            v-model="image"
            v-on:change="onFileChange"
            :state="productState"
            placeholder="Replace current product image..."
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
    image: Array,
    name: String,
    author: String,
    categorySelected: String,
    publisherSelected: String,
    isbn13: String,
    copyright: String,
    retail: String,
    cost: String,
    quantity: Number,
    deleteSelected: String,
  },
  created() {
    this.setPublisherOptions();
    this.setCategoryOptions();
  },
  methods: {
    checkCurrentDate() {
      let today = new Date().toISOString();
      let copyrightDate = this.copyright;
      if (copyrightDate >= today) {
        this.$notify({
            message:
              "A book's copyright date cannot be in the future.",
            type: "error",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 3000
          });
        this.copyright = null; 
      }
    },
    setPublisherOptions() {
      axios
        .get("../../../api/v1/admin/publishers")
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
        .get("../../../api/v1/admin/categories")
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
      var product = this
      let formData = new FormData();
      formData.append("product_image", this.image);
      formData.append("product_name", this.name);
      formData.append("author", this.author);
      formData.append("category_id", this.categorySelected);
      formData.append("publisher_id", this.publisherSelected);
      formData.append("isbn_13", this.isbn13);
      formData.append("copyright_date", this.copyright);
      formData.append("retail_price", this.retail);
      formData.append("company_cost", this.cost);
      formData.append("quantity_on_hand", this.quantity);
      formData.append("is_deleted", this.deleteSelected);

      axios
        .post("../../../api/v1/admin/newproduct", formData)
        .then(function(response) {
          console.log(response);
          product.$refs['bookModel'].hide()  
          window.location.reload() // PROBLEM CHILD -> cannot find new image "module" path
        })
        .catch(function(response) {
          console.log(response);
          product.$notify({
              message: "There has been an error adding this product",
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
    updateProduct(bookid, e) {
      var product = this;
      let formData = new FormData();
      formData.append("id", product.bookid);
      formData.append("product_image", product.image);
      formData.append("product_name", product.name);
      formData.append("author", product.author);
      formData.append("category_id", product.categorySelected);
      formData.append("publisher_id", product.publisherSelected);
      formData.append("isbn_13", product.isbn13);
      formData.append("copyright_date", product.copyright);
      formData.append("retail_price", product.retail);
      formData.append("company_cost", product.cost);
      formData.append("quantity_on_hand", product.quantity);
      formData.append("is_deleted", product.deleteSelected);
      formData.append("_method", "put");

      axios
        .post("../../../api/v1/admin/updateproduct/{id}", formData)
        .then(function(response) {
          console.log(response)
          window.location.reload()
          product.$refs['bookModel'].hide()       
          product.$emit('refreshTables') // calls the event listener in Admin.vue, which calls the getAll() method
          product.$notify({
            message: "Book successfully updated",
            type: "success",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 4500,
          });
        })
        .catch(error => {
          console.log(error);
          product.$refs['bookModel'].hide()
          product.$notify({
              message: "There has been an error updating this product",
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
  }
};
</script>

<style scoped>
.quantity {
  width: 50%;
}
</style>

