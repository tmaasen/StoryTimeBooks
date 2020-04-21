<template>
<div>
  <head>
    <title>StoryTime | Product Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  </head>

  <div class="book-detail-container" v-for="book in books_ComputerScience" :key="book.id">
    <div id="img-container" class="block">
      <b-img-lazy
        class="card-img-top"
        :src="getImgUrl(book.product_image)"
        width="250"
        height="300"
        alt="Card image cap"
        v-b-modal.modal-1
      />
    </div>

    <div class="block detail-texts">
      <div class="detail-title-and-author">
        <h1>{{ book.product_name }}</h1>
        <h2>{{ book.author }}</h2>
      </div>
      <div class="detail-description-box">
        <h6>
          <strong>Description</strong>
        </h6>
        <p>I think it. This is a box for some descriptions of this book.</p>
      </div>
      <div class="cart-button-holder">
        <b-button class="add-to-cart-btn">Add To Cart</b-button>
      </div>
    </div>

    <div>
      <b-table class="detail-table" striped hover :items="detailsTable"></b-table>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      detailsTable: [
        { "ISBN-13":  book.isbn_13, TYPE: "PAPERBACK", PRICE: "$" + book.retail_price }
      ]
    };
  }
};
</script>

<script>
import ProductDetailModal from "../components/ProductDetailModal";
import ProductDetail from "../components/ProductDetail";
export default {
  data() {
    return {
      books: [],
      books_Business: [],
      books_Business2: [],
      books_ComputerScience: [],
      books_ComputerScience2: [],
      books_Psychology: [],
      books_Psychology2: [],
      books_MusicTheatre: [],
      books_MusicTheatre2: [],
      books_Engineering: [],
      books_Engineering2: []
    };
  },
  components: {
    ProductDetailModal,
    ProductDetail
  },
  created() {
    axios
      .get("http://127.0.0.1:8000/api/v1/auth/products")
      .then(response => {
        // loop through the array, setting each book into a category group
        this.books = response.data.books;
        var count1 = 0;
        var count2 = 0;
        var count3 = 0;
        var count4 = 0;
        var count5 = 0;
        for (var i = 0; i < this.books.length; i++) {
          if (this.books[i].category_id === 1) {
            if (count1 < 1) {
              this.books_Business.push(this.books[i]);
              count1++;
            } else {
              this.books_Business2.push(this.books[i]);
            }
          } else if (this.books[i].category_id === 2) {
            if (count2 < 1) {
              this.books_ComputerScience.push(this.books[i]);
              count2++;
            } else {
              this.books_ComputerScience2.push(this.books[i]);
            }
          } else if (this.books[i].category_id === 3) {
            if (count3 < 1) {
              this.books_Psychology.push(this.books[i]);
              count3++;
            } else {
              this.books_Psychology2.push(this.books[i]);
            }
          } else if (this.books[i].category_id === 4) {
            if (count4 < 1) {
              this.books_MusicTheatre.push(this.books[i]);
              count4++;
            } else {
              this.books_MusicTheatre2.push(this.books[i]);
            }
          } else {
            if (count5 < 1) {
              this.books_Engineering.push(this.books[i]);
              count5++;
            } else {
              this.books_Engineering2.push(this.books[i]);
            }
          }
        }
        console.log(response);
      })
      .then(error => {
        console.log(error);
      });
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
    }
  }
};
</script>

<style scoped>
.block {
  display: inline-block;
}

.book-detail-container {
  margin: 1% 5%;
  text-align: center;
}

.add-to-cart-btn {
  background-color: #3490dc;
  width: 40%;
  font-size: 150%;
}
.promo-container {
  text-align: center;
  margin: 5% 0%;
}
.promo-image {
  width: 80%;
  min-height: 350px;
}
.block.detail-texts {
  margin: 2% 4%;
  vertical-align: top;
  text-align: left;
}
.detail-description-box {
  margin-top: 5%;
}
.cart-button-holder {
  margin-top: 20%;
  text-align: right;
}
.detail-table {
  margin-top: 1%;
  border: 2px solid black;
}
</style>