<template>
<div>
  <head>
    <title>StoryTime | Shopping Cart</title>
  </head>
  <navtop />
  <b-overlay :show="busy" rounded="lg" opacity="1.0">
    <b-table
      id="shoppingcart-table"
      outlined
      select-mode="single"
      ref="shoppingCartTable"
      :busy.sync="busy"
      sticky-header
      :items="cart"
      :fields="tableFields"
      head-variant="light"
      class="w-75 pt-5 pb-4 pl-4"
    >
      <!-- Book Image -->
      <template v-slot:cell(Product_Image)="cart">
        <img :src="getImgUrl(cart.item.product_image)" width="140" height="165" />
      </template>
      <!-- Product Info -->
      <template v-slot:cell(Product_Info)="cart">
        <div style="font-size:1rem">
          <label><b>Title:&nbsp;</b>{{cart.item.product_name}}</label>
          <br />
          <label><b>Author:&nbsp;</b>{{cart.item.author}}</label>
          <br />
          <label><b>Copyright:&nbsp;</b>{{cart.item.copyright_date}}</label>
          <br />
          <label><b>ISBN-13:&nbsp;</b>{{cart.item.isbn_13}}</label>
          <br />
        </div>
      </template>
      <!-- Quantity spin button -->
      <template v-slot:cell(Quantity)="cart">
        <b-form-spinbutton
          class="quantity"
          id="quantity"
          v-model="cart.item.quantity"
          required
          min="0"
          max="50"
        ></b-form-spinbutton>
      </template>
      <!-- Remove Action -->
      <template v-slot:cell(Remove)="cart">
        <b-button class="tablebuttons" v-b-modal="`remove-product-${cart.item.product_id}`">
          <b-icon id="icons" icon="trash-fill" class="h2 mb-2 mt-2" variant="danger"></b-icon>
        </b-button>
        <b-modal
          :id="`remove-product-${cart.item.product_id}`"
          centered
          title="Delete Product"
          @ok="removeFromCart(cart.item.product_id)"
        >
          <p class="my-4">
            Are you sure you want to delete
            <i>
              <b>{{cart.item.product_name}}</b>
            </i> ?
          </p>
          <p class="my-2">Select Ok to proceed with removing this product from your shopping cart.</p>
          <p class="my-4">Select Cancel to cancel, or click out of the popup box.</p>
        </b-modal>
      </template>
    </b-table>
    <!-- <div v-else>
      <h1>There are no items in your cart. Keep shopping while it's still StoryTime!</h1>
    </div>-->
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
      tableFields: ["Product_Image", "Product_Info", "Quantity", "Remove"],
      cart: []
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
          app.cart = response.data.products;
          app.busy = false;
        })
        .catch(error => {
          console.log(error);
          app.busy = false;
          alert("There has been an error loading user data. Please try again.");
        });
    },
    removeFromCart(product_id) {},
    getImgUrl(pic) {
      if (pic !== null) {
        var images = require.context(
          "../../../public/uploads/products/",
          false,
          /\.jpg$/
        );
        return images("./" + pic);
      }
    }
  }
};
</script>

<style scoped>
.tablebuttons {
  background: transparent;
  border: none;
  padding: 0%;
}
</style>