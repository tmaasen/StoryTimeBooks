<template>
<div>
  <head>
    <title>StoryTime | Order Info</title>
  </head>
  <navtop ref="navbar" />
  <b-overlay :show="busy" rounded="lg" opacity="1.0">
    <div class="row">
      <p class="profileTitle">Billing / Shipping Information</p>
      <div class="container1">
        <b-form method="POST" ref="form">
          <div class="column1">
            <h3>User Information</h3>

            <b-form-group
              label="First Name"
              label-for="fname"
              invalid-feedback="First name is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="firstname"
                required
                :state="purchaseInfoState"
                placeholder="Enter your first name"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Last Name"
              label-for="lname"
              invalid-feedback="Last name is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="lastname"
                required
                :state="purchaseInfoState"
                placeholder="Enter your last name"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Email"
              label-for="email"
              invalid-feedback="Email is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="email"
                required
                :state="purchaseInfoState"
                placeholder="Enter your email address"
              ></b-form-input>
            </b-form-group>

            <h3 style="margin-top:10%">Shipping Address</h3>

            <b-form-group
              label="Address"
              label-for="adr"
              invalid-feedback="Address is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="shippingaddress"
                :state="purchaseInfoState"
                required
                placeholder="Enter your address"
              ></b-form-input>
            </b-form-group>

            <b-form-group label="Suite No." label-for="suite" :state="purchaseInfoState">
              <b-form-input
                v-model="shippingsuiteno"
                :state="purchaseInfoState"
                placeholder="Enter your suite number"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="City"
              label-for="city"
              invalid-feedback="City is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="shippingcity"
                :state="purchaseInfoState"
                required
                placeholder="Enter your city"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="State"
              label-for="state"
              invalid-feedback="State is required"
              :state="purchaseInfoState"
            >
              <b-form-select
                id="states"
                name="states"
                :state="purchaseInfoState"
                required
                v-model="shippingstateselected"
                :options="stateOptions"
                size="md"
                style="color:#495057"
              ></b-form-select>
            </b-form-group>

            <b-form-group
              label="Zip Code"
              label-for="zip"
              invalid-feedback="Zip code is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="shippingzip"
                :state="purchaseInfoState"
                required
                placeholder="Enter your zip code"
              ></b-form-input>
            </b-form-group>
          </div>

          <div class="column2">
            <h3>Payment Method</h3>
            <!-- <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>-->
            <b-form-group
              label="Card Type"
              label-for="cardtype"
              invalid-feedback="Credit Card type is required"
              :state="purchaseInfoState"
            >
              <b-form-select
                id="cardtype"
                name="cardtype"
                :state="purchaseInfoState"
                required
                v-model="cardtypeselected"
                :options="cards"
                size="md"
                style="color:#495057"
              ></b-form-select>
            </b-form-group>

            <b-form-group
              label="Name on Card"
              label-for="cname"
              invalid-feedback="Name for Credit Card is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="cardname"
                required
                :state="purchaseInfoState"
                placeholder="Enter the name on your credit card"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              label="Credit Card Number"
              label-for="ccnum"
              invalid-feedback="Credit Card number is required"
              :state="purchaseInfoState"
            >
              <b-form-input
                v-model="cardnumber"
                required
                :state="purchaseInfoState"
                placeholder="Enter your credit card number"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              label="Exp Month"
              label-for="cardexpmonth"
              invalid-feedback="Card expiration month is required"
              :state="purchaseInfoState"
            >
              <b-form-select
                id="cardexpmonth"
                name="cardexpmonth"
                :state="purchaseInfoState"
                required
                v-model="expmonthselected"
                :options="months"
                size="md"
                style="color:#495057"
              ></b-form-select>
            </b-form-group>
            <b-form-group
              label="Exp Year"
              label-for="cardexpyear"
              invalid-feedback="Card expiration year is required"
              :state="purchaseInfoState"
            >
              <b-form-select
                id="cardexpyear"
                name="cardexpyear"
                :state="purchaseInfoState"
                required
                v-model="expyearselected"
                :options="years"
                size="md"
                style="color:#495057"
              ></b-form-select>
            </b-form-group>
            <!-- <b-form-group
              label="CVV"
              label-for="cvv"
              invalid-feedback="CVV Code is required"
              :state="purchaseInfoState"
            >
              <b-form-input v-model="cardcvv" :state="purchaseInfoState" required placeholder="Enter your card's cvv code"></b-form-input>
            </b-form-group>-->
          </div>

          <div v-if="!checked">
            <h3>Billing Address</h3>

            <label for="adr">Address</label>
            <b-form-input
              v-model="billingaddress"
              required
              placeholder="Enter your billing address"
            ></b-form-input>

            <label for="suiteno">Suite No</label>
            <b-form-input v-model="billingsuiteno" placeholder="Enter your suite number"></b-form-input>

            <label for="city">City</label>
            <b-form-input v-model="billingcity" required placeholder="Enter your city"></b-form-input>

            <label for="state">State</label>
            <b-form-select
              id="states"
              name="states"
              required
              v-model="billingstateselected"
              :options="stateOptions"
              size="md"
              style="color:#495057"
            ></b-form-select>

            <b-form-group label="Zip Code" label-for="zip" :state="purchaseInfoState">
              <b-form-input
                style="margin-bottom:5%"
                v-model="billingzip"
                required
                placeholder="Enter your zip code"
              ></b-form-input>
            </b-form-group>
          </div>

          <div style="text-align:left">
            <label>
              <input v-model="checked" type="checkbox" name="sameadress" />
              Shipping address same as billing
            </label>
            <b-button block class="checkoutbtn" variant="primary" @click="proceedToReview">
              Proceed to Order Review
              <b-icon-arrow-right font-scale="2" />
            </b-button>
          </div>
        </b-form>
      </div>

      <div class="column3">
        <b-card :header="`${totalItemsInCart} Items In Your Cart`" class="checkoutCardHeader">
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
          <b-card-text v-else>Discount:&nbsp;NONE</b-card-text>
          <hr />
          <b-card-text v-model="total">
            <b>Total:</b>
            &nbsp;
            <span style="float:right">$ {{ formatPrice(total) }}</span>
          </b-card-text>
          <template v-slot:footer>
            <span style="font-size:1.5rem">
              <b-icon-check-circle variant="success" />&nbsp;Estimated arrival by:
              <br />
              <b>{{ getArrivalDate() }}</b>
            </span>
          </template>
        </b-card>
      </div>
    </div>
  </b-overlay>
  <navbottom />
</div>
</template>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";
export default {
  data() {
    return {
      busy: true,
      checked: true,
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
      total: 0,
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
  components: {
    navtop,
    navbottom
  },
  created() {
    this.getUserInfo();
    this.getCartItems();
    this.getItemsInCart();
  },
  methods: {
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
          app.subtotalarray = response.data.products.map(x => x.retail_price);
          app.quantityarray = response.data.products.map(x => x.quantity);
          for (var i = 0; i < app.subtotalarray.length; i++) {
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
              "There has been an error loading your shopping cart. Please try again.",
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
            user.checked = false;
            user.billingaddress = response.data.billing.address_line_1;
            user.billingsuiteno = response.data.billing.suite_no;
            user.billingcity = response.data.billing.city;
            user.billingstateselected = response.data.billing.state_id;
            user.billingzip = response.data.billing.zipcode;
          } else {
            user.checked = true;
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
    proceedToReview() {
      var app = this;
      app.busy = true;
      if (app.checkFormValidity()) {
        if (!app.checked) {
          axios
            .post("http://127.0.0.1:8000/api/v1/auth/orderinfo/{id}", {
              id: this.$auth.user().id,
              first_name: app.firstname,
              last_name: app.lastname,
              email: app.email,
              // shipping info
              address_line_1: app.shippingaddress,
              suite_no: app.shippingsuiteno,
              city: app.shippingcity,
              state_id: app.shippingstateselected,
              zipcode: app.shippingzip,
              // payment info
              card_type: app.cardtypeselected,
              card_name: app.cardname,
              card_number: app.cardnumber,
              exp_month: app.expmonthselected,
              exp_year: app.expyearselected,
              // billing info
              billing_address: app.billingaddress,
              billing_suite_no: app.billingsuiteno,
              billing_city: app.billingcity,
              billing_state: app.billingstateselected,
              billing_zip: app.billingzip
            })
            .then(function(response) {
              console.log(response);
              app.busy = false;
            })
            .catch(error => {
              console.log(error);
              app.busy = false;
              app.$notify({
                message:
                  "There has been an error adding your billing / shipping information. Please try again.",
                type: "error",
                top: true,
                bottom: false,
                left: false,
                right: true,
                showClose: true,
                closeDelay: 4500
              });
            });
        } else {
          axios
            .post("http://127.0.0.1:8000/api/v1/auth/orderinfo/{id}", {
              id: this.$auth.user().id,
              first_name: app.firstname,
              last_name: app.lastname,
              email: app.email,
              // shipping info
              address_line_1: app.shippingaddress,
              suite_no: app.shippingsuiteno,
              city: app.shippingcity,
              state_id: app.shippingstateselected,
              zipcode: app.shippingzip,
              // payment info
              card_type: app.cardtypeselected,
              card_name: app.cardname,
              card_number: app.cardnumber,
              exp_month: app.expmonthselected,
              exp_year: app.expyearselected,
            })
            .then(function(response) {
              console.log(response);
              app.busy = false;
            })
            .catch(error => {
              console.log(error);
              app.busy = false;
              app.$notify({
                message:
                  "There has been an error adding your shipping information. Please try again.",
                type: "error",
                top: true,
                bottom: false,
                left: false,
                right: true,
                showClose: true,
                closeDelay: 4500
              });
            });
        }
      }
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
    }
  }
};
</script>

<style scoped>
.checkoutCardHeader {
  font-size: 1.5rem;
}
.container1 {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  margin-left: 4%;
  margin-bottom: 3%;
  width: 60%;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.column1 {
  float: left;
  width: 45%;
}
.column2 {
  float: left;
  margin-right: auto;
  margin-left: 10%;
  margin-bottom: 45%;
  width: 45%;
}
.column3 {
  float: left;
  width: 20rem;
  margin-right: 3rem;
  margin-left: auto;
}
.checkoutbtn {
  background-color: #ff8d1e;
  font-size: 1.4rem;
}
.checkoutbtn:hover {
  background-color: #2196f3;
  font-size: 1.4rem;
}
.profileTitle {
  font-size: 40px;
  margin-top: 3%;
  border-bottom: 3px solid black;
  width: 760px;
  margin-left: 4%;
}
.creditInput {
  margin-bottom: 5%;
}
label {
  margin-top: 10px;
  display: block;
}
.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}
</style>
