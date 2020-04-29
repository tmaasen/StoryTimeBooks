<template>
<div>
  <head>
    <title>StoryTime | Shopping Cart</title>
  </head>
  <navtop ref="navbar" @updateItemCount="updateItemCount($event)" />
  <b-overlay :show="busy" rounded="lg" opacity="1.0">
    <h1 class="pt-4" style="padding-left:2rem;">{{ $auth.user().first_name }}'s Shopping Cart</h1>
    <div class="row">
      <b-table
        id="shoppingcart-table"
        show-empty
        outlined
        select-mode="single"
        ref="shoppingCartTable"
        :busy.sync="busy"
        sticky-header
        :items="cart"
        :fields="tableFields"
        head-variant="light"
        class="column1"
      >
        <!-- Book Image -->
        <template v-slot:cell(Product)="cart">
          <img :src="getImgUrl(cart.item.product_image)" width="140" height="165" />
        </template>
        <!-- Product Info -->
        <template v-slot:cell(Product_Info)="cart">
          <div style="font-size:1rem">
            <label>
              <b>Title:&nbsp;</b>
              {{cart.item.product_name}}
            </label>
            <br />
            <label>
              <b>Author:&nbsp;</b>
              {{cart.item.author}}
            </label>
            <br />
            <label>
              <b>Copyright:&nbsp;</b>
              {{cart.item.copyright_date}}
            </label>
            <br />
            <label>
              <b>ISBN-13:&nbsp;</b>
              {{cart.item.isbn_13}}
            </label>
            <br />
          </div>
        </template>
        <!-- Price -->
        <template v-slot:cell(Price)="cart">
          <label>$ {{ formatPrice(cart.item.retail_price) }}</label>
        </template>
        <!-- Quantity spin button -->
        <template v-slot:cell(Quantity)="cart">
          <b-form-spinbutton
            class="quantity"
            id="quantity"
            v-model="cart.item.quantity"
            required
            min="1"
            :max="quantityOnHand[cart.index]"
            v-on:change="setCartQuantity(cart.item.product_id, $auth.user().id, cart.item.quantity)"
          ></b-form-spinbutton>
        </template>
        <!-- Total Price -->
        <template v-slot:cell(Total)="cart">
          <label
            style="padding-bottom:6rem;"
          >$ {{ formatPrice(cart.item.retail_price * cart.item.quantity) }}</label>
          <br />
          <!-- Remove Action -->
          <b-button v-b-modal="`remove-product-${cart.item.product_id}`" variant="danger">Remove</b-button>
          <b-modal
            :id="`remove-product-${cart.item.product_id}`"
            centered
            title="Remove Product"
            @ok="removeFromCart(cart.item.product_id)"
          >
            <p class="my-4">
              Are you sure you want to remove
              <i>
                <b>{{cart.item.product_name}}</b>
              </i> from your cart?
            </p>
            <p class="my-2">Select Ok to proceed with removing this product from your shopping cart.</p>
            <p class="my-4">Select Cancel to cancel, or click out of the popup box.</p>
          </b-modal>
        </template>
      </b-table>
      <!-- Totals box -->
      <b-overlay :show="totalsboxbusy" rounded="lg" opacity="0.6">
        <div class="column2">
          <b-card :header="`${totalItemsInCart} Items In Your Cart`" class="checkoutCard">
            <b-card-text v-model="subtotal">
              Subtotal:&nbsp;
              <span style="float:right"
              >$ {{ formatPrice(subtotal) }}</span>
            </b-card-text>
            <hr />
            <b-card-text>Shipping:&nbsp;<span style="float:right">$ 0.00</span></b-card-text>
            <hr />
            <b-card-text v-model="discount" v-if="subtotal >= 75">Discount:&nbsp;
              <span style="float:right">$ {{ formatPrice(discount) }} (10%)</span>
            </b-card-text>
            <b-card-text v-else>Discount:&nbsp;<span style="float:right">NONE</span></b-card-text>
            <hr />
            <b-card-text v-model="total">
              <b>Total:</b>
              &nbsp;<span style="float:right">$ {{ formatPrice(total) }}</span>
            </b-card-text>
            <template v-slot:footer>
              <router-link style="text-decoration:none" :to="`/user/${$auth.user().id}/order/info`">
                <b-button v-if="total > 0" block class="checkoutbtn" variant="primary">Checkout</b-button>
                <b-button v-else disabled block class="checkoutbtn" variant="primary">Checkout</b-button>
              </router-link>
            </template>
          </b-card>
        </div>
      </b-overlay>
    </div>
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
      busy: false,
      totalsboxbusy: false,
      tableFields: ["Product", "Product_Info", "Price", "Quantity", "Total"],
      cart: [],
      subtotal: null,
      discount:null,
      total: null,
      product_id: null,
      quantity: null,
      totalItemsInCart: null,
      quantityOnHand: null
    };
  },
  mounted() {
    console.log("Shopping Cart mounted.");
  },
  components: {
    navtop,
    navbottom,
  },
  created() {
    this.getCartItems();
    this.updateItemCount();
  },
  computed: {},
  methods: {
    updateItemCount(value) {
      this.totalItemsInCart = value;
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2);
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
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
          app.quantityOnHand = response.data.products.map(x => x.quantity_on_hand);
          app.busy = false;
          app.totalItemsInCart = app.$refs.navbar.getItemsInCart();
          app.calculatesubtotal(app.cart);
        })
        .catch(error => {
          console.log(error);
          app.busy = false;
          app.$notify({
              message: "There has been an error loading your shopping cart. Please try again.",
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
    calculatesubtotal(cart) {
      this.subtotal = 0;
      for (let i = 0; i < this.cart.length; i++) {
        this.subtotal +=
          parseFloat(this.cart[i].retail_price) *
          parseFloat(this.cart[i].quantity);
      }
      this.calculatetotal(this.subtotal);
      this.calculatediscount(this.subtotal);
      return this.subtotal;
    },
    calculatediscount(subtotal) {
      if (this.subtotal >= 75) {
        this.discount = this.subtotal * 0.1;
      } else this.discount = 0;
      return this.discount;
    },
    calculatetotal(subtotal) {
      if (this.subtotal >= 75) {
        this.total = this.subtotal - this.subtotal * 0.1;
      } else this.total = this.subtotal;
      return this.total;
    },
    removeFromCart(product_id) {
      var app = this;
      app.busy = true;
      axios
        .post("http://127.0.0.1:8000/api/v1/auth/removefromcart/{id}", {
          product_id: product_id,
          user_id: app.$auth.user().id
        })
        .then(function(response) {
          console.log(response);
          app.busy = false;
          app.getCartItems(app.$auth.user().id);
        })
        .catch(error => {
          console.log(error);
          app.busy = false;
          app.$notify({
              message: "There has been an error removing this item from your cart. Please try again",
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
    setCartQuantity(product_id, user_id, quantity) {
      var app = this;
      app.totalsboxbusy = true;
      axios
        .put("http://127.0.0.1:8000/api/v1/auth/updatecartquantity/{id}", {
          product_id: product_id,
          user_id: user_id,
          quantity: quantity
        })
        .then(function(response) {
          console.log(response);
          app.calculatesubtotal(app.cart);
          app.totalsboxbusy = false;
        })
        .catch(error => {
          console.log(error);
          app.totalsboxbusy = false;
          app.$notify({
              message: "There has been an error setting the correct quantity for your cart item. Please try again",
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
.checkoutCard {
  width: 20rem;
  font-size: 1rem;
  margin-left: auto;
  margin-bottom: 5%;
}
.checkoutbtn {
  background-color: #ff8d1e;
  font-size: 1.4rem;
}
.checkoutbtn:hover {
  background-color: #2196f3;
  font-size: 1.4rem;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.column1 {
  float: left;
  width: 74% !important;
  padding-bottom: 1.5rem !important;
  padding-left: 3rem !important;
  margin-right: 3rem;
}
.column2 {
  padding-right: 3rem !important;
  float: left;
  width: 20rem;
}
.aligncenter {
  text-align: center;
}
.card-header {
  font-size: 1.5rem;
  text-align: center;
  background-color: #e9ecef;
}
.card-footer {
  text-align: center;
  background-color: #e9ecef;
}
</style>