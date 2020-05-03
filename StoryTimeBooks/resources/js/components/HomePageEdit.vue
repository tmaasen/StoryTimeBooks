<template>
  <div>
    <navtop
      @childSearchResults="childSearchResults($event)"
      :books="this.books"
      ref="navbar"
      id="home"
    />
    <!--search results-->
    <div id="searchResults" ref="results">
      <ul class="list-group list-group-horizontal">
        <div v-for="(post, index) in searchResults" :key="index">
          <div v-if="post.item.category_id == 1">
            <li class="list-group-item">
              <a
                :href="'#'"
                v-scroll-to="'#businessScroll'"
                class="list-group-item list-group-item-action"
              >
                <p>{{post.item.product_name}}</p>
              </a>
            </li>
          </div>
          <div v-if="post.item.category_id == 2">
            <li class="list-group-item">
              <a
                :href="'#'"
                v-scroll-to="'#computer'"
                class="list-group-item list-group-item-action"
              >
                <p>{{post.item.product_name}}</p>
              </a>
            </li>
          </div>
          <div v-if="post.item.category_id == 3">
            <li class="list-group-item">
              <a
                :href="'#'"
                v-scroll-to="'#psychologyScroll'"
                class="list-group-item list-group-item-action"
              >
                <p>{{post.item.product_name}}</p>
              </a>
            </li>
          </div>
          <div v-if="post.item.category_id == 4">
            <li class="list-group-item">
              <a
                :href="'#'"
                v-scroll-to="'#musicTheatreScroll'"
                class="list-group-item list-group-item-action"
              >
                <p>{{post.item.product_name}}</p>
              </a>
            </li>
          </div>
          <div v-if="post.item.category_id == 5">
            <li class="list-group-item">
              <a
                :href="'#'"
                v-scroll-to="'#engineeringScroll'"
                class="list-group-item list-group-item-action"
              >
                <p>{{post.item.product_name}}</p>
              </a>
            </li>
          </div>
        </div>
      </ul>
    </div>
    <!--end search results-->
    <div class="header">
      <p>DISCLAIMER: This website is for educational use ONLY. Please enjoy.</p>
    </div>
    <div style="overflow:visible;flex-grow: 1;text-align: center;">
      <b-overlay :show="busy" rounded="sm" opacity="0.6">
        <b-jumbotron class="jumbotron">
          <div class="jumbomessage">
            <h1>It's StoryTime</h1>
            <h4>10% off all orders of $75 or more!</h4>
            <h4>FREE shipping on all orders!</h4>
            <b-button variant="primary" v-scroll-to="'#computer'">Start Your Story</b-button>
          </div>
        </b-jumbotron>
        <div style="width:70%; margin:0 15%; padding:10px;">
          <p class="title" id="computer">Computer Sciences</p>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--Second slide-->
              <div class="carousel-item">
                <div class="col-md-4" v-for="book in books_ComputerScience2" :key="book.id">
                  <div class="card mb-2">
                    <div class="cardContainer">
                      <b-img-lazy
                        class="card-img-top"
                        :src="getImgUrl(book.product_image)"
                        width="250"
                        height="300"
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
          <p id="businessScroll" class="title">Business</p>
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
                      title="Product Details"
                      v-b-modal="`productdetails-${book.id}`"
                    />
                    <ProductDetailModal
                      v-if="book.quantity_on_hand > 0"
                      :id="`productdetails-${book.id}`"
                      title="Product Details"
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
                      v-on:refreshCartCounter="updateNavbarCart"
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

                      <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                        <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                      </a>
                      <h3 v-else>Out of Stock</h3>
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
                      title="Product Details"
                      v-b-modal="`productdetails-${book.id}`"
                    />
                    <ProductDetailModal
                      v-if="book.quantity_on_hand > 0"
                      :id="`productdetails-${book.id}`"
                      title="Product Details"
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
                      v-on:refreshCartCounter="updateNavbarCart"
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

                      <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                        <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                      </a>
                      <h3 v-else>Out of Stock</h3>
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
          <p class="title" id="psychologyScroll">Psychology</p>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
          <p class="title" id="engineeringScroll">Engineering</p>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
          <p class="title" id="musicTheatreScroll">Music / Theatre</p>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
                        title="Product Details"
                        v-b-modal="`productdetails-${book.id}`"
                      />
                      <ProductDetailModal
                        v-if="book.quantity_on_hand > 0"
                        :id="`productdetails-${book.id}`"
                        title="Product Details"
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
                        v-on:refreshCartCounter="updateNavbarCart"
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

                        <a class="btn btn-primary" v-if="book.quantity_on_hand > 0">
                          <b @click="quickAdd(book.id, book.product_name)">Quick Add</b>
                        </a>
                        <h3 v-else>Out of Stock</h3>
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
      </b-overlay>
    </div>
  </div>
</template>

<script>
import ProductDetailModal from "../components/productdetailmodal";
import navtop from "./navtop";

export default {
  data() {
    return {
      busy: false,
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
      books_Engineering2: [],
      searchResults: []
    };
  },
  components: {
    ProductDetailModal,
    navtop
  },
  created() {
    this.getProducts();
  },
  methods: {
    childSearchResults(param) {
      console.log("search results called in Home" + param);
      this.searchResults = param;
    },
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
    getProducts() {
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
          .post("http://127.0.0.1:8000/api/v1/auth/addtocart/{id}", {
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
/* Header/Logo Title */
.header {
  padding: 10px;
  text-align: center;
  background: rgb(37, 37, 37);
  color: white;
  font-size: 30px;
  margin-bottom: -1%;
  font-weight: bold;
}
template {
  scroll-behavior: smooth !important;
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
.card-img-top {
  height: 300px;
  width: 250px;
  margin: auto;
  cursor: pointer;
}
.img-fluid {
  max-width: 100%;
  height: 285px;
}

.col-md-4 {
  float: left;
}
.card-title {
  margin: 20px auto 10px auto;
  width: 300px;
  height: 50px;
  text-align: center;
}
.card-text {
  margin: auto;
  width: 290px;
  height: 115px;
}
.carousel-control-prev {
  position: absolute;
  overflow: visible !important;
  left: -170px !important;
  top: 30% !important;
  width: 33px;
  height: 88px;
}

.carousel-control-next {
  position: absolute;
  overflow: visible !important;
  right: -170px !important;
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
  /*overflow:scroll;*/
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  white-space: nowrap;
  padding-bottom: 3rem;
}
</style>
