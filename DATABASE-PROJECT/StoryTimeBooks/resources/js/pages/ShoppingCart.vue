<template>
<div>
  <head>
    <title>StoryTime | Shopping Cart</title>
  </head>
  <navtop />
  <b-overlay :show="busy" rounded="lg" opacity="1.0">
    <b-table
      id="shoppingcart-table"
      selectable
      select-mode="single"
      ref="shoppingCartTable"
      :busy.sync="busy"
      small
      sticky-header
      striped
      hover
      :items="products"
      head-variant="light"
      class="w-50"
    ></b-table>
    <navbottom />
  </b-overlay>
</div>
</template>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      products: []
    };
  },
  mounted() {
    console.log("Shopping Cart mounted.");
  },
  components: {
    navtop,
    navbottom
  },
  created() {
    this.getCartItems();
  },
  methods: {
    getCartItems(user_id) {
      var app = this;
      app.busy = true;
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/shoppingcart/{id}", {
          params: { user_id: this.$auth.user().id }
        })
        .then(function(response) {
          console.log(response);
          app.products = response.data.products;
          app.busy = false;
        })
        .catch(error => {
          console.log(error);
          app.busy = false;
          alert("There has been an error loading user data. Please try again.");
        });
    }
  }
};
</script>

<style>
</style>