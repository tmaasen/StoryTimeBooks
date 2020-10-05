<template>
  <div class="card mb-2">
    <div class="cardContainer">
      <b-img-lazy
        class="card-img-top"
        :src="getImgUrl(image)"
        width="250"
        height="300"
        title="Product Details"
        v-b-modal="`productdetails-${bookid}`"
      />
      <ProductDetailModal
        v-if="quantity > 0"
        :id="`productdetails-${bookid}`"
        title="Product Details"
        :bookid="`${bookid}`"
        :image="`${image}`"
        :name="`${name}`"
        :author="`${author}`"
        :category="`${category}`"
        :publisher="`${publisher}`"
        :isbn13="`${isbn13}`"
        :copyright="`${copyright}`"
        :retail="`${retail}`"
        :quantity="`${quantity}`"
        v-on:refreshCartCounter="updateNavbarCart"
      />
    </div>
    <h4 class="card-title">{{ name }}</h4>
    <div class="card-body">
      <div class="card-contentNoTitle">
        <p class="card-text">
          {{ author }}
          <br />
          ISBN: {{ isbn13 }}
          <br />
          RETAIL: ${{ retail }}
        </p>

        <a class="btn btn-primary" v-if="quantity > 0">
          <b @click="quickAdd(bookid, name)">Quick Add</b>
        </a>
        <h3 v-else style="margin:10px auto;">Out of Stock</h3>
      </div>
    </div>
  </div>
</template>

<script>
import ProductDetailModal from "../components/productdetailmodal";

export default {
  data() {
    return {
      busy: false,
    };
  },
  props: {
    scrollhref: String,
    bookid: String,
    image: String,
    name: String,
    author: String,
    category: String,
    publisher: String,
    isbn13: String,
    copyright: String,
    retail: String,
    quantity: String,
  },
  components: {
    ProductDetailModal,
  },
  methods: {
    showNotification() {
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
    getImgUrl(pic) {
      if (pic !== "[]") {
        return require(`../../../public/uploads/products/${pic}`);
      } else
      return "";
    },
    updateNavbarCart() {
      var app = this;
      app.$refs.navbar.getItemsInCart();
    },
    quickAdd(product_id) {
      // item will be added to cart with default quantity of 1
      var app = this;
      if (!app.$auth.check()) {
        app.$notify({
          message: "Please log in before adding items to your cart",
          type: "warning",
          top: true,
          bottom: false,
          left: false,
          right: true,
          showClose: true,
          closeDelay: 4500
        });
      } else {
        app.busy = true;
        axios
          .post("../../../api/v1/auth/addtocart/{id}", {
            product_id: product_id,
            user_id: app.$auth.user().id,
            quantity: 1
          })
          .then(function(response) {
            console.log(response);
            app.busy = false;
            app.updateNavbarCart();
            app.showNotification();
          })
          .catch(error => {
            console.log(error);
            app.busy = false;
            app.$notify({
              message: "There has been an error adding this item to your cart",
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
  }
};
</script>

<style scoped>
.card {
    min-height: 538px;
}
.card-body {
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: flex-end;
}
.card-img-top {
  height: 300px;
  width: 250px;
  margin: auto;
  cursor: pointer;
}
.card-title {
  margin: 20px auto 20px auto;
  width: 300px;
  height: 50px;
  text-align: center;
}
.card-text {
  margin: auto;
}
.btn {
  background-color: #ff8d1e;
  color: #fff;
  margin: 10px auto;
}
.btn:hover {
  background-color: #2196f3;
  color: #fff;
}
</style>
