<template>
<div>
  <head>
    <title>StoryTime | Invoice</title>
  </head>
  <b-overlay :show="busy" rounded="lg" opacity="1.0">
    <navtop />
    <b-col lg="4" class="pt-2 print-button">
      <b-button onclick="window.print();return false;">
        <strong>PRINT INVOICE</strong>
      </b-button>
      <router-link :to="{name:'Home'}">
        <b-button style="margin-left:10%">
          <strong>RETURN HOME</strong>
        </b-button>
      </router-link>
    </b-col>
    <!-- content -->
    <div class="invoice-box">
      <table cellpadding="0" cellspacing="0">
        <tr class="top">
          <td colspan="2">
            <table>
              <tr>
                <td class="title">
                  <img src="../assets/StoryTime2.png" style="width:150%; max-width:200px;" />
                </td>

                <td>
                  <p id="vueRoot" class="table-top">
                    <strong>
                      Invoice Number: {{confirmation}}
                      <br />
                      Created: {{myDate}}
                      <br />
                      Due: {{dueDate}}
                      <br />Status: PAID
                    </strong>
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
                <!-- Shipping Info -->
                <td class="ship-to-table" style="text-align:left!important">
                  <label class="billing-shiping-title">
                    <strong>Ship to:</strong>
                  </label>
                  <br />
                  <div>
                    <br />
                    <label>{{fullName}}</label>
                    <br />
                    <label>{{fullAddress3}}</label>
                    <br />
                    <label>{{fullAddress4}}</label>
                  </div>
                  <br />
                </td>
                <!-- Billing Info -->
                <td class="bill-to-table">
                  <label class="billing-shiping-title">
                    <strong>Bill to:</strong>
                  </label>
                  <br />
                  <div style="text-align:left!important;">
                    <br />
                    <label>{{fullName}}</label>
                    <br />
                    <label v-if="checked == 'false'">{{fullAddress}}</label>
                    <label v-else>{{fullAddress3}}</label>
                    <br />
                    <label v-if="checked == 'false'">{{fullAddress2}}</label>
                    <label v-else>{{fullAddress4}}</label>
                  </div>
                  <br />
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <b-table
          show-empty
          no-select-on-click
          :busy.sync="busy"
          sticky-header
          :items="products"
          :fields="tableFields"
          borderless
        >
          <!-- Product Info -->
          <template v-slot:cell(Product)="products">
            <div style="font-size:1rem;">
              <label>{{products.item.product_name}}</label>
            </div>
          </template>
          <!-- Quantity Ordered -->
          <template v-slot:cell(Quantity_Ordered)="products">
            <div style="font-size:1rem; text-align:center;">
              <label>{{products.item.quantity_ordered}}</label>
            </div>
          </template>
          <!-- Total Price -->
          <template v-slot:cell(Total)="products">
            <label>$ {{ formatPrice(products.item.product_total) }}</label>
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
          <b-card-text v-model="discount">
            Discount:&nbsp;
            <span style="float:right">$ {{ formatPrice(discount) }}</span>
          </b-card-text>
          <hr />
          <b-card-text v-model="total">
            Total:&nbsp;
            <span style="float:right">$ {{ formatPrice(total) }}</span>
          </b-card-text>
          <hr />
          <b-card-text>
            <b>
              Amount Due:&nbsp;
              <span style="float:right">$ 0.00</span>
            </b>
          </b-card-text>
        </b-card>
      </div>
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
      myDate: new Date().toISOString().slice(0, 10),
      dueDate: this.getDueDate(),
      tableFields: ["Product", "Quantity_Ordered", "Total"],
      products: [],
      busy: true,
      checked1: this.checked,
      arrivalDate: "",
      firstname: "",
      lastname: "",
      email: "",
      shippingaddress: "",
      shippingsuiteno: "",
      shippingcity: "",
      shippingstate: "",
      shippingzip: "",
      cardtypeselected: null,
      cardname: "",
      cardnumber: "",
      expmonthselected: null,
      expyearselected: null,
      billingaddress: "",
      billingsuiteno: "",
      billingcity: "",
      billingstate: "",
      billingzip: "",
      subtotal: 0,
      discount: 0,
      total: 0,
      confirmation: this.number,
      stateOptions: []
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
        if (this.billingsuiteno == null) {
          return `${this.billingaddress}`;
        } else return `${this.billingaddress} ${this.billingsuiteno}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);
        this.billingaddress = m[1];
        this.billingsuiteno = m[2];
      }
    },
    fullAddress2: {
      get() {
        return `${this.billingcity} ${this.billingstate}, ${this.billingzip}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);
        this.billingcity = m[1];
        this.billingstate = m[2];
        this.billingzip = m[3];
      }
    },
    fullAddress3: {
      get() {
        if (this.shippingsuiteno == null) {
          return `${this.shippingaddress}`;
        } else return `${this.shippingaddress} ${this.shippingsuiteno}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);
        this.shippingaddress = m[1];
        this.shippingsuiteno = m[2];
      }
    },
    fullAddress4: {
      get() {
        return `${this.shippingcity} ${this.shippingstate}, ${this.shippingzip}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);
        this.shippingcity = m[1];
        this.shippingstate = m[2];
        this.shippingzip = m[3];
      }
    }
  },
  components: {
    navtop,
    navbottom
  },
  props: {
    number: String,
    checked: Boolean
  },
  created() {
    this.getUserInfo();
    this.getItemsInCart();
  },
  methods: {
    getDueDate() {
      let dateObj = new Date();
      dateObj.setDate(dateObj.getDate() + 30);
      return dateObj.toISOString().slice(0, 10);
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2);
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
    getOrderInfo() {
      var user = this;
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/invoice", {
          params: {
            user_id: user.$auth.user().id,
            confirmation_number: user.number
          }
        })
        .then(function(response) {
          console.log(response);
          user.products = response.data.products;
          user.subtotal = response.data.order.map(x => x.subtotal);
          user.discount = response.data.order.map(x => x.discount);
          user.total = response.data.order.map(x => x.total);
        })
        .catch(error => {
          console.log(error);
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
            user.shippingstate = response.data.shipping.state;
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
            user.billingstate = response.data.billing.state;
            user.billingzip = response.data.billing.zipcode;
          }
          user.getOrderInfo();
          user.busy = false;
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
    }
  }
};
</script>

<style>
@media print {
  @page {
    size: A4 landscape;
    max-height: 100%;
    max-width: 100%;
  }
}
.print-button {
  margin-left: 23%;
  margin-top: 1%;
  margin-bottom: 1%;
  font-size: 16px;
  line-height: 24px;
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
}
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
  margin-bottom: 2%;
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