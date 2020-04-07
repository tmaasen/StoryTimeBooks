<template>
  <div style="overflow:visible;flex-grow: 1;text-align: center;">
    <img
      src="https://dispatch.barnesandnoble.com/content/dam/ccr/homepage/daily/2020/03/17B/Homepage_Billboard_HeroA_03-17.jpg"
      alt="Trulli"
      width="80%"
      height="600px"
    />
    <div style="width:70%; margin:0 15%; padding:10px;">
      <p class="title">Computer Sciences</p>
      <!--Carousel Wrapper-->
      <div id="computerSience" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div style="margin:auto">
          <a
            class="carousel-control left carousel-control-prev"
            href="#computerSience"
            data-slide="prev"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-left"></i>
        </div>
        <div style="margin:auto">
          <a
            class="carousel-control right carousel-control-next"
            href="#computerSience"
            data-slide="next"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-right"></i>
        </div>
        <!--/.Controls-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <!--First slide-->
          <div class="carousel-item active">
            <div class="col-md-4" v-for="book in books_ComputerScience" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                    alt="Card image cap"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
    </div>

    <div style="width:70%; margin:1% 15%; padding:10px;">
      <p class="title">Business</p>
      <!--Carousel Wrapper-->
      <div id="business" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div style="margin:auto">
          <a
            class="carousel-control left carousel-control-prev"
            href="#business"
            data-slide="prev"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-left"></i>
        </div>
        <div style="margin:auto">
          <a
            class="carousel-control right carousel-control-next"
            href="#business"
            data-slide="next"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-right"></i>
        </div>
        <!--/.Controls-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <!--First slide-->
          <div class="carousel-item active">
            <div class="col-md-4" v-for="book in books_Business" :key="book.id">
              <div class="card mb-2">
                <b-img-lazy
                  class="card-img-top"
                  :src="getImgUrl(book.product_image)"
                  width="250"
                  height="300"
                  alt="Card image cap"
                />
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <p class="card-text">
                    {{ book.author }}
                    <br />PAPERBACK
                    <br />
                    ISBN: {{ book.isbn_13 }}
                    <br />
                    RETAIL: ${{ book.retail_price }}
                  </p>
                  <a class="btn btn-primary">
                    <b>Add To Cart</b>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!--Second slide-->
          <div class="carousel-item">
            <div class="col-md-4" v-for="book in books_Business2" :key="book.id">
              <div class="card mb-2">
                <b-img-lazy
                  class="card-img-top"
                  :src="getImgUrl(book.product_image)"
                  width="250"
                  height="300"
                  alt="Card image cap"
                />
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <p class="card-text">
                    {{ book.author }}
                    <br />PAPERBACK
                    <br />
                    ISBN: {{ book.isbn_13 }}
                    <br />
                    RETAIL: ${{ book.retail_price }}
                  </p>
                  <a class="btn btn-primary">
                    <b>Add To Cart</b>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
    </div>

    <div style="width:70%; margin:0 15%; padding:10px;">
      <p class="title">Psychology</p>
      <!--Carousel Wrapper-->
      <div id="psychology" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div style="margin:auto">
          <a
            class="carousel-control left carousel-control-prev"
            href="#psychology"
            data-slide="prev"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-left"></i>
        </div>
        <div style="margin:auto">
          <a
            class="carousel-control right carousel-control-next"
            href="#psychology"
            data-slide="next"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-right"></i>
        </div>
        <!--/.Controls-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <!--First slide-->
          <div class="carousel-item active">
            <div class="col-md-4" v-for="book in books_Psychology" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Second slide-->
          <div class="carousel-item">
            <div class="col-md-4" v-for="book in books_Psychology2" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
    </div>

    <div style="width:70%; margin:0 15%; padding:10px;">
      <p class="title">Engineering</p>
      <!--Carousel Wrapper-->
      <div id="engineering" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div style="margin:auto">
          <a
            class="carousel-control left carousel-control-prev"
            href="#engineering"
            data-slide="prev"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-left"></i>
        </div>
        <div style="margin:auto">
          <a
            class="carousel-control right carousel-control-next"
            href="#engineering"
            data-slide="next"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-right"></i>
        </div>
        <!--/.Controls-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <!--First slide-->
          <div class="carousel-item active">
            <div class="col-md-4" v-for="book in books_Engineering" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Second slide-->
          <div class="carousel-item">
            <div class="col-md-4" v-for="book in books_Engineering2" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
    </div>

    <div style="width:70%; margin:0 15%; padding:10px;">
      <p class="title">Music / Theatre</p>
      <!--Carousel Wrapper-->
      <div id="musicTheatre" class="carousel slide carousel-multi-item" data-ride="carousel">
        <!--Controls-->
        <div style="margin:auto">
          <a
            class="carousel-control left carousel-control-prev"
            href="#musicTheatre"
            data-slide="prev"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-left"></i>
        </div>
        <div style="margin:auto">
          <a
            class="carousel-control right carousel-control-next"
            href="#musicTheatre"
            data-slide="next"
            style="color:red;outline: black;"
          ></a>
          <i class="fa fa-angle-right"></i>
        </div>
        <!--/.Controls-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <!--First slide-->
          <div class="carousel-item active">
            <div class="col-md-4" v-for="book in books_MusicTheatre" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Second slide-->
          <div class="carousel-item">
            <div class="col-md-4" v-for="book in books_MusicTheatre2" :key="book.id">
              <div class="card mb-2">
                <div class="cardContainer">
                  <b-img-lazy
                    class="card-img-top"
                    :src="getImgUrl(book.product_image)"
                    width="250"
                    height="300"
                  />
                </div>
                <h4 class="card-title">{{ book.product_name }}</h4>
                <div class="card-body">
                  <div class="card-contentNoTitle">
                    <p class="card-text">
                      {{ book.author }}
                      <br />PAPERBACK
                      <br />
                      ISBN: {{ book.isbn_13 }}
                      <br />
                      RETAIL: ${{ book.retail_price }}
                    </p>
                    <a class="btn btn-primary">
                      <b>Add To Cart</b>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/.Slides-->
      </div>
      <!--/.Carousel Wrapper-->
    </div>
  </div>
</template>

<script>
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
  created() {
    axios
      .get("http://127.0.0.1:8000/api/v1/admin/products")
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
            if (count1 < 3) {
              this.books_Business.push(this.books[i]);
              count1++;
            } else {
              this.books_Business2.push(this.books[i]);
            }
          } else if (this.books[i].category_id === 2) {
            if (count2 < 3) {
              this.books_ComputerScience.push(this.books[i]);
              count2++;
            } else {
              this.books_ComputerScience2.push(this.books[i]);
            }
          } else if (this.books[i].category_id === 3) {
            if (count3 < 3) {
              this.books_Psychology.push(this.books[i]);
              count3++;
            } else {
              this.books_Psychology2.push(this.books[i]);
            }
          } else if (this.books[i].category_id === 4) {
            if (count4 < 3) {
              this.books_MusicTheatre.push(this.books[i]);
              count4++;
            } else {
              this.books_MusicTheatre2.push(this.books[i]);
            }
          } else {
            if (count5 < 3) {
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
.card-img-top {
  height: 300px;
  width: 250px;
  margin: auto;
}
.img-fluid {
  max-width: 100%;
  height: 285px;
}

.col-md-4 {
  float: left;
}
.card-title {
  margin-top: 10%;
  margin-right: auto;
  margin-left: auto;
  width: 200px;
  text-align: center;
}
.carousel-control-prev {
  position: absolute;
  height: 30%;
  overflow: visible !important;
  left: -170px !important;
  top: 30% !important;
}

.carousel-control-next {
  position: absolute;
  height: 30%;
  overflow: visible !important;
  right: -170px !important;
  top: 30% !important;
}

.carousel-control-next:after {
  content: ">";
  font-size: 55px;
  color: white;
  background-color: grey;
}

.carousel-control-prev:after {
  content: "<";
  font-size: 55px;
  color: white;
  background-color: grey;
}

.title {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 4%;
  font-size: 50px;
}

.btn {
  background-color: #ff8d1e;
  color: #fff;
}
.btn:hover {
  background-color: #2196f3;
  color: #fff;
}
</style>