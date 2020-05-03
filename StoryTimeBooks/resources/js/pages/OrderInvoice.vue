<template>
<div>
  <head>
    <title>StoryTime | Invoice</title>
  </head>
  <navtop />
  <!-- content -->
  <div class="invoice-box">
    <b-col lg="4" class="pb-2"><b-button onclick="window.print();return false;"><strong>PRINT INVOICE</strong></b-button></b-col>
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <img
                  src="../assets/StoryTime2.png"
                  style="width:150%; max-width:200px;"
                />
              </td>

              <td>
                <p id="vueRoot" class="table-top">
                  <strong>Invoice Number: {{confirmation}}
                  <br />
                  Created: {{myDate}}
                  <br />Due: {{myDate}} </strong>
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <td class="bill-to-table">
                <label class="billing-shiping-title">
                  <strong>Bill to:</strong>
                </label>

                <br />
                <div class="col-sm-10">
                  <b-form-input
                    v-model="fullName"
                    :state="purchaseInfoState"
                    required
                    placeholder="Enter your address"
                    :readonly="shippingaddress"
                  ></b-form-input>
                  <b-form-input
                    v-model="fullAddress"
                    :state="purchaseInfoState"
                    required
                    placeholder="Enter your address"
                    :readonly="shippingaddress"
                  ></b-form-input>
                  <b-form-input
                    v-model="fullAddress2"
                    :state="purchaseInfoState"
                    required
                    placeholder="Enter your address"
                    :readonly="shippingaddress"
                  ></b-form-input>
                </div>
                <br />
              </td>

              <td class="ship-to-table">
                <label class="billing-shiping-title">
                  <strong>Ship to:</strong>
                </label>
                <br />
                <div class="col-sm-10">
                  <b-form-input
                    v-model="fullName"
                    :state="purchaseInfoState"
                    required
                    placeholder="Enter your address"
                    :readonly="shippingaddress"
                  ></b-form-input>
                  <b-form-input
                    v-model="fullAddress3"
                    :state="purchaseInfoState"
                    required
                    placeholder="Enter your address"
                    :readonly="shippingaddress"
                  ></b-form-input>
                  <b-form-input
                    v-model="fullAddress4"
                    :state="purchaseInfoState"
                    required
                    placeholder="Enter your address"
                    :readonly="shippingaddress"
                  ></b-form-input>
                </div>
                <br />
              </td>
            </tr>
          </table>
        </td>
      </tr>
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
      >
        <!-- Product Info -->
        <template v-slot:cell(Product)="cart">
          <div style="font-size:1rem;">
            <label>{{cart.item.product_name}}</label>
          </div>
        </template>
        <!-- Price -->
        <template v-slot:cell(Price)="cart">
          <div style="float:left;">
            <label>$ {{ formatPrice(cart.item.retail_price) }}</label>
          </div>
        </template>
        <!-- Quantity spin button -->
        <template v-slot:cell(Quantity)="cart">
          <div style="font-size:1rem; text-align:center; float:center;">
            <label>{{cart.item.quantity}}</label>
          </div>
        </template>
        <!-- Total Price -->
        <template v-slot:cell(Total)="cart">
          <label style="padding-bottom:6rem;">$ {{ formatPrice(itemtotal[cart.index]) }}</label>
        </template>
      </b-table>
    </table>
    <div class="column3">
      <b-card class="checkoutCardHeader">
        <b-card-text v-model="subtotal">
          Subtotal:&nbsp;
          <span style="float:right">$ {{ formatPrice(subtotal) }}</span>
        </b-card-text>
        <hr />
        <b-card-text>
          Shipping:&nbsp;
          <span style="float:right">$ 0.00</span>
        </b-card-text>
        <hr />
        <b-card-text v-model="discount" v-if="subtotal >= 75">
          Discount:&nbsp;
          <span style="float:right">$ {{ formatPrice(discount) }} (10%)</span>
        </b-card-text>
        <b-card-text v-else>
          Discount:&nbsp;
          <span style="float:right">NONE</span>
        </b-card-text>
        <hr />
        <b-card-text v-model="total">
          <b>Total:</b>
          &nbsp;
          <span style="float:right">$ {{ formatPrice(total) }}</span>
        </b-card-text>
      </b-card>
    </div>
  </div>
  <navbottom />
</div>
</template>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";
export default {
  data() {
    return {
      myDate: new Date().toISOString().slice(0, 10),
      totalsboxbusy: false,
      tableFields: ["Product", "Price", "Quantity", "Total"],
      cart: [],
      product_id: null,
      quantity: null,
      quantityOnHand: null,
      busy: true,
      checked1: this.checked,
      arrivalDate: "",
      purchaseInfoState: null,
      firstname: "",
      lastname: "",
      email: "",
      shippingaddress: "",
      shippingsuiteno: "",
      shippingcity: "",
      shippingstateselected: null,
      shippingzip: "",
      cardtypeselected: null,
      cardname: "",
      cardnumber: "",
      expmonthselected: null,
      expyearselected: null,
      billingaddress: "",
      billingsuiteno: "",
      billingcity: "",
      billingstateselected: null,
      billingzip: "",
      totalItemsInCart: null,
      subtotal: 0,
      discount: 0,
      itemtotal: [],
      total: 0,
      confirmation: "",
      stateOptions: [
        { value: null, text: "Please select a state or US territory" }
      ],
      cards: [
        { value: null, text: "Credit Card Type" },
        { value: 1, text: "Visa" },
        { value: 2, text: "MasterCard" },
        { value: 3, text: "American Express" },
        { value: 4, text: "Discover Card" }
      ],
      months: [
        { value: null, text: "Card Expiration Month" },
        { value: 1, text: "01" },
        { value: 2, text: "02" },
        { value: 3, text: "03" },
        { value: 4, text: "04" },
        { value: 5, text: "05" },
        { value: 6, text: "06" },
        { value: 7, text: "07" },
        { value: 8, text: "08" },
        { value: 9, text: "09" },
        { value: 10, text: "10" },
        { value: 11, text: "11" },
        { value: 12, text: "12" }
      ],
      years: [
        { value: null, text: "Card Expiration Year" },
        { value: 20, text: "20" },
        { value: 21, text: "21" },
        { value: 22, text: "22" }
      ]
    };
  },
  computed: {
    fullName: {
      get() {
        return `${this.firstname} ${this.lastname}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);

        this.firstname = m[1];
        this.lastname = m[2];
      }
    },
    fullAddress: {
      get() {
        return `${this.billingaddress} ${this.billingsuiteno}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);

        this.billingaddress = m[1];
        this.billingsuiteno = m[2];
      }
    },
    fullAddress2: {
      get() {
        return `${this.billingcity} ${this.billingstateselected}, ${this.billingzip}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);

        this.billingcity = m[1];
        this.billingstateselected = m[2];
        this.billingzip = m[3];
      }
    },
    fullAddress3: {
      get() {
        return `${this.shippingaddress} ${this.shippingsuiteno}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);

        this.shippingaddress = m[1];
        this.shippingsuiteno = m[2];
      }
    },
    fullAddress4: {
      get() {
        return `${this.shippingcity} ${this.shippingstateselected}, ${this.shippingzip}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);

        this.shippingcity = m[1];
        this.shippingstateselected = m[2];
        this.shippingzip = m[3];
      }
    }
  },
  components: {
    navtop,
    navbottom
  },
  props: {
    checked: Boolean
  },
  created() {
    this.getUserInfo();
    this.getCartItems();
    this.getItemsInCart();
    this.generateConfirmationNumber();
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
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.purchaseInfoState = valid;
      return valid;
    },
    getArrivalDate() {
      let dateObj = new Date();
      dateObj.setDate(dateObj.getDate() + 5);
      return dateObj.toDateString();
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2);
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
    getItemsInCart() {
      var app = this;
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/itemsincart/{id}", {
          params: { user_id: app.$auth.user().id }
        })
        .then(function(response) {
          console.log(response);
          app.totalItemsInCart = response.data.items;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getCartItems() {
      var app = this;
      var subtotalarray = [];
      var quantityarray = [];
      app.busy = true;
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/shoppingcart/{id}", {
          params: { user_id: this.$auth.user().id }
        })
        .then(function(response) {
          console.log(response);
          app.cart = response.data.products;
          app.quantityOnHand = response.data.products.map(
            x => x.quantity_on_hand
          );
          app.subtotalarray = response.data.products.map(x => x.retail_price);
          app.quantityarray = response.data.products.map(x => x.quantity);
          for (var i = 0; i < app.subtotalarray.length; i++) {
            app.itemtotal[i] = app.subtotalarray[i] * app.quantityarray[i];
            app.subtotal =
              app.subtotal +
              parseFloat(app.subtotalarray[i]) * app.quantityarray[i];
          }
          app.calculatediscount(app.subtotal);
          app.calculatetotal(app.subtotal);
          app.busy = false;
        })
        .catch(error => {
          console.log(error);
          app.busy = false;
          app.$notify({
            message:
              "There has been an error loading your order review. Please try again.",
            type: "error",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 4500
          });
        });
    },
    getUserInfo(userid) {
      var user = this;
      user.busy = true;
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/userinfo/{id}", {
          params: { id: this.$auth.user().id }
        })
        .then(function(response) {
          console.log(response);
          if (response.data.user !== null) {
            user.userid = response.data.user.id;
            user.firstname = response.data.user.first_name;
            user.lastname = response.data.user.last_name;
            user.email = response.data.user.email;
          }
          if (response.data.shipping !== null) {
            user.shippingaddress = response.data.shipping.address_line_1;
            user.shippingsuiteno = response.data.shipping.suite_no;
            user.shippingcity = response.data.shipping.city;
            user.shippingstateselected = response.data.shipping.state_id;
            user.shippingzip = response.data.shipping.zipcode;
          }
          if (response.data.card !== null) {
            user.cardtypeselected = response.data.card.card_id;
            user.cardname = response.data.card.card_name;
            user.cardnumber = response.data.card.card_number;
            user.expmonthselected = response.data.card.exp_month;
            user.expyearselected = response.data.card.exp_year;
          }
          if (response.data.billing !== null) {
            user.billingaddress = response.data.billing.address_line_1;
            user.billingsuiteno = response.data.billing.suite_no;
            user.billingcity = response.data.billing.city;
            user.billingstateselected = response.data.billing.state_id;
            user.billingzip = response.data.billing.zipcode;
          }
          user.setStateOptions();
        })
        .catch(error => {
          console.log(error);
          user.busy = false;
          user.$notify({
            message:
              "There has been an error loading user information. Please try again.",
            type: "error",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 4500
          });
        });
    },
    placeOrder() {
      var app = this;
      app.busy = true;
      axios
        .post("http://127.0.0.1:8000/api/v1/auth/order", {
          user_id: this.$auth.user().id,
          items_ordered: app.cart.length,
          subtotal: app.subtotal,
          discount: app.discount,
          total: app.total,
          products: app.cart,
          product_total: app.itemtotal,
          confirmation_number: app.confirmation
        })
        .then(function(response) {
          console.log(response);
          app.busy = false;
          app.$notify({
            message: "Your order has been placed!",
            type: "success",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 4500
          });
          app.router.push({
            path: `/user/${app.$auth.user().id}/order/invoice/${
              app.confirmation
            }`
          });
        })
        .catch(error => {
          console.log(error);
          app.busy = false;
          app.$notify({
            message:
              "There has been an error placing your order. Please try again.",
            type: "error",
            top: true,
            bottom: false,
            left: false,
            right: true,
            showClose: true,
            closeDelay: 4500
          });
        });
    },
    setStateOptions() {
      var user = this;
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/states")
        .then(response => {
          this.states = response.data.states;
          for (var i = 0; i < this.states.length; i++) {
            var option = [];
            for (var key in this.states[i]) {
              if (key == "id") {
                option["value"] = this.states[i][key];
              } else if (key == "state") {
                option["text"] = this.states[i][key];
              }
            }
            this.stateOptions.push(Object.assign({}, option));
            user.busy = false;
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    generateConfirmationNumber(length = 15) {
      var characters = "0123456789";
      var charactersLength = characters.length;
      var randomString = "";
      for (var i = 0; i <= length; i++) {
        randomString = Math.random().toPrecision(length);
      }
      this.confirmation = randomString.slice(2, length + 2);
    }
  }
};
</script>

<style>
.ship-to-table {
  display: block;
  float: right;
  min-width: 100%;
}
.billing-shiping-title {
  float: left;
}
.col-sm-10 {
  padding: 0;
}
.table-top {
  /*text-shadow: -0.1px 0 black, 0 0.1px black, 0.1px 0 black, 0 -0.1px black;*/
  color: #555;
}
.invoice-box {
  background-color: #dcdcdb;
  max-width: 800px;
  margin: auto;
  padding: 30px;
  border: 1px solid #eee;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
  font-size: 16px;
  line-height: 24px;
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  color: #555;
}

.invoice-box table {
  width: 100%;
  line-height: inherit;
  text-align: left;
}

.invoice-box table td {
  padding: 5px;
  vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
  text-align: right;
}

.invoice-box table tr.top table td {
  padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
  font-size: 45px;
  line-height: 45px;
  color: #333;
}

.invoice-box table tr.information table td {
  padding-bottom: 40px;
}

.invoice-box table tr.heading td {
  background: #eee;
  border-bottom: 1px solid #ddd;
  font-weight: bold;
}

.invoice-box table tr.details td {
  padding-bottom: 20px;
}

.invoice-box table tr.item td {
  border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
  border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
  border-top: 2px solid #eee;
  font-weight: bold;
}

@media only screen and (max-width: 600px) {
  .invoice-box table tr.top table td {
    width: 100%;
    display: block;
    text-align: center;
  }

  .invoice-box table tr.information table td {
    width: 100%;
    display: block;
    text-align: center;
  }
}

/** RTL **/
.rtl {
  direction: rtl;
  font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
    sans-serif;
}

.rtl table {
  text-align: right;
}

.rtl table tr td:nth-child(2) {
  text-align: left;
}
</style>