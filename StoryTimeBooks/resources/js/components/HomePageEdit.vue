<template>
    <div>
      <search :books="this.books" ref="navbar" id="home" />
      <b-overlay :show="busy" rounded="sm" opacity="0.6">
        <div class="header">
            <p>
                DISCLAIMER: This website is for educational use ONLY. Please
                enjoy.
            </p>
        </div>
        <div style="overflow:visible;flex-grow:1;text-align:center;">
          <b-jumbotron class="jumbotron">
              <div class="jumbomessage">
                  <h1>It's StoryTime</h1>
                  <h4>10% off all orders of $75 or more!</h4>
                  <h4>FREE shipping on all orders!</h4>
                  <b-button variant="primary" v-scroll-to="'#business'"
                      >Start Your Story</b-button
                  >
              </div>
          </b-jumbotron>
        <div v-for="category in categories" :key="category.id">
          <!-- Category 1: Computer Science -->
          <div v-if="category.category == 'Computer Sciences'" 
            id="computerScience" class="carousel slide" data-ride="carousel" data-interval="20000">
            <p class="title" id="computer">Computer Sciences</p>
              <div class="carousel-inner">
                
                <div class="carousel-item active"> <!-- slide 1 -->
                  <div class="col-md-4" v-for="book in books_ComputerScience.slice(0,3)" :key="book.id">
                      <ProductCard
                          :bookid="`${book.id}`"
                          :image="`${book.product_image}`"
                          :name="`${book.product_name}`"
                          :author="`${book.author}`"
                          :category="`${book.category}`"
                          :publisher="`${book.publisher_name}`"
                          :isbn13="`${book.isbn_13}`"
                          :copyright="`${book.copyright_date}`"
                          :retail="`${book.retail_price}`"
                          :quantity="`${book.quantity_on_hand}`" 
                      />
                  </div>
                </div>
                <div class="carousel-item"> <!-- slide 2 -->
                  <div class="col-md-4" v-for="book in books_ComputerScience.slice(3,6)" :key="book.id">
                        <ProductCard
                            :bookid="`${book.id}`"
                            :image="`${book.product_image}`"
                            :name="`${book.product_name}`"
                            :author="`${book.author}`"
                            :category="`${book.category}`"
                            :publisher="`${book.publisher_name}`"
                            :isbn13="`${book.isbn_13}`"
                            :copyright="`${book.copyright_date}`"
                            :retail="`${book.retail_price}`"
                            :quantity="`${book.quantity_on_hand}`" 
                        />
                    </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#computerScience" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#computerScience" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
          </div>
          <!-- Category 2: Business -->
          <div v-if="category.category == 'Business'" 
            id="business" class="carousel slide" data-ride="carousel">
            <p class="title" id="businessScroll">Business</p>
            <div class="carousel-inner">

                <div class="carousel-item active"> <!-- slide 1 -->
                  <div class="col-md-4" v-for="book in books_Business.slice(0,3)" :key="book.id">
                      <ProductCard
                          :bookid="`${book.id}`"
                          :image="`${book.product_image}`"
                          :name="`${book.product_name}`"
                          :author="`${book.author}`"
                          :category="`${book.category}`"
                          :publisher="`${book.publisher_name}`"
                          :isbn13="`${book.isbn_13}`"
                          :copyright="`${book.copyright_date}`"
                          :retail="`${book.retail_price}`"
                          :quantity="`${book.quantity_on_hand}`" 
                      />
                  </div>
                </div>
                <div class="carousel-item"> <!-- slide 2 -->
                  <div class="col-md-4" v-for="book in books_Business.slice(3,6)" :key="book.id">
                        <ProductCard
                            :bookid="`${book.id}`"
                            :image="`${book.product_image}`"
                            :name="`${book.product_name}`"
                            :author="`${book.author}`"
                            :category="`${book.category}`"
                            :publisher="`${book.publisher_name}`"
                            :isbn13="`${book.isbn_13}`"
                            :copyright="`${book.copyright_date}`"
                            :retail="`${book.retail_price}`"
                            :quantity="`${book.quantity_on_hand}`" 
                        />
                    </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#business" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#business" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
          </div>
          <!-- Category 3: Psychology -->
          <div v-if="category.category == 'Psychology'" 
            id="psychology" class="carousel slide" data-ride="carousel">
            <p class="title" id="psychologyScroll">Psychology</p>
            <div class="carousel-inner">

                <div class="carousel-item active"> <!-- slide 1 -->
                  <div class="col-md-4" v-for="book in books_Psychology.slice(0,3)" :key="book.id">
                      <ProductCard
                          :bookid="`${book.id}`"
                          :image="`${book.product_image}`"
                          :name="`${book.product_name}`"
                          :author="`${book.author}`"
                          :category="`${book.category}`"
                          :publisher="`${book.publisher_name}`"
                          :isbn13="`${book.isbn_13}`"
                          :copyright="`${book.copyright_date}`"
                          :retail="`${book.retail_price}`"
                          :quantity="`${book.quantity_on_hand}`" 
                      />
                  </div>
                </div>
                <div class="carousel-item"> <!-- slide 2 -->
                  <div class="col-md-4" v-for="book in books_Psychology.slice(3,6)" :key="book.id">
                        <ProductCard
                            :bookid="`${book.id}`"
                            :image="`${book.product_image}`"
                            :name="`${book.product_name}`"
                            :author="`${book.author}`"
                            :category="`${book.category}`"
                            :publisher="`${book.publisher_name}`"
                            :isbn13="`${book.isbn_13}`"
                            :copyright="`${book.copyright_date}`"
                            :retail="`${book.retail_price}`"
                            :quantity="`${book.quantity_on_hand}`" 
                        />
                    </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#psychology" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#psychology" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
          </div>
          <!-- Category 4: Engineering -->
          <div v-if="category.category == 'Engineering'" 
            id="engineering" class="carousel slide" data-ride="carousel">
            <p class="title" id="engineeringScroll">Engineering</p>
            <div class="carousel-inner">

                <div class="carousel-item active"> <!-- slide 1 -->
                  <div class="col-md-4" v-for="book in books_Engineering.slice(0,3)" :key="book.id">
                      <ProductCard
                          :bookid="`${book.id}`"
                          :image="`${book.product_image}`"
                          :name="`${book.product_name}`"
                          :author="`${book.author}`"
                          :category="`${book.category}`"
                          :publisher="`${book.publisher_name}`"
                          :isbn13="`${book.isbn_13}`"
                          :copyright="`${book.copyright_date}`"
                          :retail="`${book.retail_price}`"
                          :quantity="`${book.quantity_on_hand}`" 
                      />
                  </div>
                </div>
                <div class="carousel-item"> <!-- slide 2 -->
                  <div class="col-md-4" v-for="book in books_Engineering.slice(3,6)" :key="book.id">
                        <ProductCard
                            :bookid="`${book.id}`"
                            :image="`${book.product_image}`"
                            :name="`${book.product_name}`"
                            :author="`${book.author}`"
                            :category="`${book.category}`"
                            :publisher="`${book.publisher_name}`"
                            :isbn13="`${book.isbn_13}`"
                            :copyright="`${book.copyright_date}`"
                            :retail="`${book.retail_price}`"
                            :quantity="`${book.quantity_on_hand}`" 
                        />
                    </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#engineering" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#engineering" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
          </div>
          <!-- Category 5: Music & Theatre -->
          <div v-if="category.category == 'Music & Theatre'" 
            id="musicTheatre" class="carousel slide" data-ride="carousel">
            <p class="title" id="musicTheatreScroll">Music & Theatre</p>
            <div class="carousel-inner">

                <div class="carousel-item active"> <!-- slide 1 -->
                  <div class="col-md-4" v-for="book in books_MusicTheatre.slice(0,3)" :key="book.id">
                      <ProductCard
                          :bookid="`${book.id}`"
                          :image="`${book.product_image}`"
                          :name="`${book.product_name}`"
                          :author="`${book.author}`"
                          :category="`${book.category}`"
                          :publisher="`${book.publisher_name}`"
                          :isbn13="`${book.isbn_13}`"
                          :copyright="`${book.copyright_date}`"
                          :retail="`${book.retail_price}`"
                          :quantity="`${book.quantity_on_hand}`" 
                      />
                  </div>
                </div>
                <div class="carousel-item"> <!-- slide 2 -->
                  <div class="col-md-4" v-for="book in books_MusicTheatre.slice(3,6)" :key="book.id">
                        <ProductCard
                            :bookid="`${book.id}`"
                            :image="`${book.product_image}`"
                            :name="`${book.product_name}`"
                            :author="`${book.author}`"
                            :category="`${book.category}`"
                            :publisher="`${book.publisher_name}`"
                            :isbn13="`${book.isbn_13}`"
                            :copyright="`${book.copyright_date}`"
                            :retail="`${book.retail_price}`"
                            :quantity="`${book.quantity_on_hand}`" 
                        />
                    </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#musicTheatre" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#musicTheatre" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
          </div>
        </div>
      </div>
    </b-overlay>
  </div>
</template>

<script>
import ProductCard from './productcard';
import ProductDetailModal from './productdetailmodal'
import search from "./searchresults";

export default {
    data() {
        return {
          busy: false,
          books: [],
          categories: [],
          books_Business: [],
          books_ComputerScience: [],
          books_Psychology: [],
          books_MusicTheatre: [],
          books_Engineering: [],
        };
    },
    components: { 
        search,
        ProductCard,
        ProductDetailModal,
    },
    created() {
        this.getProducts();
        this.getCategories();
    },
    methods: {
      getCategories() {
        axios
          .get("../../../api/v1/admin/categories")
          .then(response => {
            this.categories = response.data.categories;
          })
          .then(error => {
            console.log(error)
          })
      },
      getProducts() {
        axios
          .get("../../../api/v1/auth/products")
          .then(response => {
            this.books = response.data.books;
            for (var i = 0; i < this.books.length; i++) {
              if (this.books[i].category == 'Business') {
                  this.books_Business.push(this.books[i]);
              } else if (this.books[i].category == 'Computer Sciences') {
                  this.books_ComputerScience.push(this.books[i]);
              } else if (this.books[i].category == 'Psychology') {
                  this.books_Psychology.push(this.books[i]);
              } else if (this.books[i].category == 'Music & Theatre') {
                  this.books_MusicTheatre.push(this.books[i]);
              } else {
                  this.books_Engineering.push(this.books[i]);
              }
            }
          })
          .then(error => {
            console.log(error);
          });
      },
    }
};
</script>

<style scoped>
.carousel-slide {
  padding: 10px;
}
@media only screen and (max-width: 769px) {
  .carousel-slide {
      width: auto;
  }
  .header {
      margin-bottom: -12% !important;
  }
}
.header {
  padding: 10px;
  text-align: center;
  background: rgb(37, 37, 37);
  color: white;
  font-size: 30px;
  margin-bottom: -1%;
  font-weight: bold;
}
@media screen and (max-width: 1000px) {
  .jumbotron {
    display: none;
  }
}
.jumbotron {
  background-image: url("../assets/colorful-books-on-shelf-5710.jpg");
  background-size: contain;
  padding: 10rem 2rem;
  margin-bottom: 2rem;
  background-color: #e9ecef;
  border-radius: 0.3rem;
  padding-left: 400px;
  padding-right: 400px;
}
.jumbomessage {
  background-color: #e9ecef;
  border-radius: 0.5em;
  font: status-bar;
  padding: 10px;
}
.img-fluid {
  max-width: 100%;
  height: 285px;
}
.col-md-4 {
  float: left;
  width: min-content;
}
@media only screen and (min-width: 768px) {
  .col-md-4 {
    max-width: none;
  }
}
.carousel-inner {
  display: flex;
  justify-content: center;
}
.carousel-item {
  width: 100%;
  margin-right: -35%;
}
.carousel-control-prev {
  position: absolute;
  overflow: visible !important;
  top: 30% !important;
  width: 33px;
  height: 88px;
}
.carousel-control-next {
  position: absolute;
  overflow: visible !important;
  top: 30% !important;
  width: 33px;
  height: 88px;
}
.carousel-control-next:after {
  content: ">";
  font-size: 55px;
  color: white;
  background-color: grey;
  width: 33px;
  height: 88px;
}
.carousel-control-prev:after {
  content: "<";
  font-size: 55px;
  color: white;
  background-color: grey;
  width: 33px;
  height: 88px;
}
.title {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 10px;
  font-size: 50px;
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
.list-group {
  max-height: 100px;
  margin-bottom: 2px;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  white-space: nowrap;
  padding-bottom: 3rem;
}
</style>
