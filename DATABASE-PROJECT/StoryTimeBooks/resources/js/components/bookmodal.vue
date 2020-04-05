<template>
  <b-modal centered scrollable id="bookModal" :title="title" @ok="handleOk" ok-title="Add Product">
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
            v-model="selected_category"
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
            v-model="selected_publisher"
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
      name: "",
      author: "",
      publisher: null,
      isbn13: "",
      copyright: null,
      retail: "",
      cost: "",
      quantity: 1,
      image: {},
      productState: null,
      publishers: [],
      publisherOptions: [],
      selected_publisher: null,
      categories: [],
      categoryOptions: [],
      selected_category: null,
      max: maxDate
    };
  },
  props: {
    title: String,
    value: [{File}, {Array}]
  },
  created() {
    this.setPublisherOptions();
    this.setCategoryOptions();
  },
  methods: {
    setPublisherOptions() {
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/publishers ")
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
      this.busy = true; // loading indicator
      bvModalEvt.preventDefault(); // Prevent modal from closing
      if (this.checkFormValidity()) {
        this.addProduct();
        this.busy = false;
        location.reload(true);
      }
    },
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.image = e.target.files[0];
    },
    addProduct() {
      let formData = new FormData();
      formData.append("product_image", this.image);
      formData.append("product_name", this.name);
      formData.append("author", this.author);
      formData.append("category_id", this.selected_category);
      formData.append("publisher_id", this.selected_publisher);
      formData.append("isbn_13", this.isbn13);
      formData.append("copyright_date", this.copyright);
      formData.append("retail_price", this.retail);
      formData.append("company_cost", this.cost);
      formData.append("quantity_on_hand", this.quantity);
      
      axios.post("http://127.0.0.1:8000/api/v1/admin/newproduct", formData)
        .then(function(response) {
          console.log(response);
        })
        .catch(function(response) {
          this.busy = false;
          console.log(response);
          alert("There has been an error. Please try again.");
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

