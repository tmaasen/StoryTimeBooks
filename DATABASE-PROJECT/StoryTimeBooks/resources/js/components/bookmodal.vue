<template>
  <b-modal centered id="bookModal" :title="title" @ok="handleOk" ok-title="Create Product">
    <b-overlay :show="busy" rounded="lg" opacity="0.6">
      <form method="POST" @submit.prevent="addProduct" ref="form">
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
        <!-- Publisher -->
        <b-form-group
          label="Publisher Id"
          label-for="publisher"
          invalid-feedback="Publisher is required"
          :state="productState"
        >
          <b-form-select
            id="publisher"
            required
            :state="productState"
            v-model="publisher"
            :options="publishers"
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
            class="mb-2"
          ></b-form-datepicker>
        </b-form-group>
        <!-- Retail Price -->
        <b-form-group
          label="Retail Price"
          label-for="retail"
          invalid-feedback="Retail Price is required"
          :state="productState"
        >
          <b-form-input id="retail" v-model="retail" required :state="productState"></b-form-input>
        </b-form-group>
        <!-- Company Cost -->
        <b-form-group
          label="StoryTime's Cost"
          label-for="cost"
          invalid-feedback="Company Cost is required"
          :state="productState"
        >
          <b-form-input id="cost" v-model="cost" required :state="productState"></b-form-input>
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
      </form>
    </b-overlay>
  </b-modal>
</template>

<script>
export default {
  data() {
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
      productState: null,
      publishers: []
    };
  },
  props: {
    title: String
  },
  created() {
    // created is ran before mounted...mounted is run once the html loads
    axios
      .get("http://127.0.0.1:8000/api/v1/admin/publishers", {})
      .then(response => {
        // this.publishers = response.data.publishers.map(x => x.publisher_name);
        this.publishers = response.data.publishers.map(x => x.id);
      });
  },
  methods: {
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.productState = valid;
      return valid;
    },
    handleOk(bvModalEvt) {
      this.busy = true; // loading indicator
      bvModalEvt.preventDefault(); // Prevent modal from closing
      if (this.checkFormValidity()) this.addProduct();
      this.busy = false;
    },
    addProduct() {
      axios
        .post("http://127.0.0.1:8000/api/v1/admin/newproduct", {
          product_name: this.name,
          author: this.author,
          publisher_id: this.publisher, // need to get the id from the name
          isbn_13: this.isbn13,
          copyright_date: this.copyright,
          retail_price: this.retail,
          company_cost: this.cost,
          quantity_on_hand: this.quantity
        })
        .then(function(response) {
          // success
          console.log(response);
          location.reload(true);
        })
        .catch(function(response) {
          // error
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
