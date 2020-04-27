<template>
<b-modal
  size="xl"
  centered
  scrollable
  ref="ProductDetailModal"
  :id="`productdetails-${bookid}`"
  :title="title"
>
  <b-overlay :show="busy" rounded="lg" opacity="0.6">
    <div class="book-detail-container">
      <div id="img-container" class="column1">
        <b-img :src="getImgUrl(image)" />
      </div>

    <div class="cloumn2">
      <div class="block detail-texts">
        <div class="detail-title-and-author">
          <h1>{{ name }}</h1>
          <h2>by {{ author }}</h2>
        </div>

        <div class="detail-description-box">
          <h5>
            <strong>Publisher: </strong><span>{{ publisher }}</span>
          </h5>
          <h5>
            <strong>Retail Price: </strong><span> $ {{ retail }}</span>
          </h5>
        </div>
        
        <div class="cart-button-holder">
          <b-form-spinbutton
            v-model="quantity1"
            required
            min="1"
            :max="this.quantity"
            class="spinbutton"
          ></b-form-spinbutton>
          <b-button class="add-to-cart-btn" @click="addToCart(bookid, quantity1)">Add To Cart</b-button>
        </div>
      </div>

      <div>
        <b-table 
        class="detail-table" 
        striped 
        hover 
        :items="product_details">
        </b-table>
      </div>
    </div>
  </div>

  </b-overlay>
</b-modal>
</template>

<script>
export default {
  data() {
    return {
      busy:false,
      bookid1: this.bookid,
      name1: this.name,
      author1: this.author,
      publisher1: this.publisher,
      category1: this.category,
      isbn131: this.isbn13,
      copyright1: this.copyright,
      retail1: this.retail,
      quantity1: 1,
      image1: this.image,
      product_details: [
        { CATEGORY: this.category, 
          COPYRIGHT_DATE: this.copyright, 
          ISBN_13: this.isbn13, TYPE: "PAPERBACK", 
          QUANTITY_AVAILABLE: this.quantity
        }
      ]
    };
  },
  props: {
    title: String,
    bookid: String,
    image: Array,
    name: String,
    author: String,
    category: String,
    publisher: String,
    isbn13: String,
    copyright: String,
    retail: String,
    cost: String,
    quantity: Number,
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
    showSuccessNotification () {
      this.$notify({
        message: "Item has been added to your cart",
        type: "success",
        top: true,
        bottom: false,
        left: false,
        right: true,
        showClose: true,
        closeDelay: 4500
      });
    },
    addToCart(product_id, quantity) {
      var app = this;
      app.busy = true;
      axios
        .post("http://127.0.0.1:8000/api/v1/auth/addtocart/{id}", {
          product_id: product_id,
          user_id: app.$auth.user().id,
          quantity: quantity
        })
        .then(function(response) {
          console.log(response);
          app.busy = false;
          app.$refs['ProductDetailModal'].hide()
          app.$emit('refreshCartCounter')
          app.showSuccessNotification();
        })
        .catch(error => {
          console.log(error);
          app.busy = false
          app.$refs['ProductDetailModal'].hide()
            app.$notify({
              message: "There has been an error adding this item to your cart",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
          });
      }
  },
};
</script>

<style scoped>
.row:after {
  content: "";
  display: table;
  clear: both;
}
.column1 {
  float: left;
  width: 30% !important;
  padding-bottom: 1.5rem !important;
  padding-left: 3rem !important;
  margin-right: 6rem;
}
.column2 {
  padding-right: 3rem !important;
  float: left;
  width: 20rem;
}
.book-detail-container {
  margin: 1% 5%;
  text-align: center;
}
.spinbutton {
  width: 15%!important;
  margin-left: 40%;
  margin-top: 5px;
  text-align: center;
}
.add-to-cart-btn {
  background-color: #ff8d1e;
  width: 40%;
  font-size: 1.4rem;
  margin-left: auto;
}
.add-to-cart-btn:hover {
  background-color: #2196f3;
  width: 40%;
  font-size: 1.4rem;
}
.block.detail-texts {
  margin: 2% 4%;
  vertical-align: top;
  text-align: left;
}
.detail-description-box {
  margin-top: 3%;
}
.cart-button-holder {
  margin-top: 5%!important;
  text-align: right;
  display:flex;
}
.detail-table {
  margin-top: 1%;
  border: 2px solid black;
}
</style>