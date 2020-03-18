<template>
<div>
  <nav class="navbar navbar-expand-lg" style="background-color: #252525">
   <a href="#"> <img src="../assets/StoryTime.png" width="200" class="navbar-brand" alt="Go to Home"></a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>

      <form class="form-inline my-2 my-lg-0">
        <!-- <div class="input-group">
          <input
            type="text"
            class="form-control"
          />
        </div>-->

        <!--  <link href="search-filter.css" rel="stylesheet" /> -->
        <div class="container">
          <div class="row searchFilter" id="n4">
            <div class="col-md-12">
              <div class="input-group">
                <input
                  id="table_filter"
                  type="text"
                  class="form-control"
                  aria-label="Text input with segmented button dropdown"
                />
                <div class="input-group-btn">
                  <button
                    type="button"
                    class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    id="n2"
                  >
                    <span class="label-icon">Category</span>
                    <span class="caret">&nbsp;</span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" id="n3">
                    <ul class="category_filters">
                      <li>
                        <div class="col-xs-4">
                          <input
                            class="cat_type category-input"
                            data-label="All"
                            id="all"
                            value
                            name="radios"
                            type="radio"
                          />
                        </div>
                        <label for="all">All</label>
                      </li>
                      <li>
                        <input type="radio" name="radios" id="Design" value="Design" />
                        <label class="category-label" for="Design">Design</label>
                      </li>
                      <li>
                        <input type="radio" name="radios" id="Marketing" value="Marketing" />
                        <label class="category-label" for="Marketing">Marketing</label>
                      </li>
                      <li>
                        <input type="radio" name="radios" id="Programming" value="Programming" />
                        <label class="category-label" for="Programming">Programming</label>
                      </li>
                      <li>
                        <input type="radio" name="radios" id="Sales" value="Sales" />
                        <label class="category-label" for="Sales">Sales</label>
                      </li>
                      <li>
                        <input type="radio" name="radios" id="Support" value="Support" />
                        <label class="category-label" for="Support">Support</label>
                      </li>
                    </ul>
                  </div>
                  <div id="n1">
                    <button id="searchBtn" type="button" class="btn btn-secondary btn-search">
                      <span class="glyphicon glyphicon-search">&nbsp;</span>
                      <span class="label-icon">Search</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div>
          <button class="btn btn-outline-success my-2 my-sm-0" id="searchBtn" type="submit">Search</button>
        </div>-->
      </form>

      <div>
        <a class="navbar-brand" id="shoppingCart" href="#">
          <span class="input-group-addon">
            <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 0 24 24" width="30">
              <path
                d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
              />
              <path d="M0 0h24v24H0z" fill="none" />
            </svg>
            <!-- <span class="hidden-xs text-upper-style"></span> -->
          </span>
          Cart
        </a>
      </div>
      <!--Tanner's addition-->
    </div>
    <b-dropdown variant="primary">
      <template v-slot:button-content>
        <b-icon icon="person-fill" aria-hidden="true"></b-icon>My Account
      </template>
      <b-dropdown-item-button>
        <b-icon icon="blank" aria-hidden="true"></b-icon>Profile
        <span class="sr-only">(Not selected)</span>
      </b-dropdown-item-button>
      <b-dropdown-item-button>
        <b-icon icon="blank" aria-hidden="true"></b-icon>Logout
        <span class="sr-only">(Selected)</span>
      </b-dropdown-item-button>
      <b-dropdown-divider></b-dropdown-divider>
      <b-dropdown-item-button variant="danger">
        <b-icon icon="trash-fill" aria-hidden="true"></b-icon>Remove Account
        <span class="sr-only">(Not selected)</span>
      </b-dropdown-item-button>
    </b-dropdown>
  </nav>
  <!-- <navbottom /> -->
</div>
</template>

<script>
// import navbottom from './navbottom'
export default {
  // components: {
  //   navbottom
  // },
  mounted() {
    console.log("navtop mounted");
  }
};
</script>

<style>
#shoppingCart {
  color: #ff8d1e;
}

svg {
  fill: #ff8d1e;
}
/* 
#searchBtn {
  margin-left: 10%;
} */

.searchFilter {
  margin-bottom: 20px;
}
.searchFilter.btn {
  display: inline-block;
  font-weight: 400;
  line-height: 1.25;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  border: 1px solid transparent;
  padding: 0.5rem 1rem;
  font-size: 16px;
  border-radius: 0.25rem;
  height: 50px;
  min-width: 20px;
}
.searchFilter .btn-secondary {
  color: #373a3c;
  background-color: #fff;
  border: 1px solid #ccc;
}
.searchFilter .btn-secondary:hover {
  color: #373a3c;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.searchFilter .btn-search {
  background-color: #ff8d1e;
  color: #fff;
  border: 1px solid #ff8d1e;
}
.searchFilter .btn-search:hover {
  background-color: #4b92dc;
  color: #fff;
  border: 1px solid #4b92dc;
}
.searchFilter .label-icon {
  display: none;
}
.searchFilter .glyphicon {
  margin-right: -15px;
}
.searchFilter .dropdown-menu .category_filters {
  min-width: 178px;
  width: 100%;
  margin: 15px 0 0 -25px;
}
.searchFilter .dropdown-menu-right {
  right: 170px;
  min-width: 175px;
  top: 90%;
}
.searchFilter .dropdown-menu .category_filters li {
  list-style-type: none;
  padding: 2px 10px;
  font-size: 18px;
}
.searchFilter .dropdown-menu .category_filters label {
  margin-left: 15px;
}
@media (min-width: 1400px) {
  .ct-header .ct-jumbotron .inner {
    max-width: 470px;
    min-height: 230px;
  }
}
@media (max-width: 1400px) {
  .ct-header-slider .item {
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center top;
  }
}
@media (min-width: 769px) and (max-width: 1400px) {
  .ct-header-slider .item {
    height: auto;
  }
}
@media (max-width: 1260px) {
  #dots-container {
    display: none;
  }
}
@media (min-width: 992px) {
  .ct-footer2 .ct-newsletter {
    max-width: 100%;
  }
  #dots-container {
    bottom: 100px;
  }
}
@media (min-width: 768px) {
  .ct-searchbar:before {
    height: 92px;
    bottom: -1px;
  }
  .page-scrolled .navbar .navbar-nav li > * {
    min-height: 67px;
    height: 67px;
  }
  .page-scrolled .navbar .navbar-nav {
    height: 100% !important;
  }
  .ct-current-facts h2 {
    margin: 0 auto 0px;
  }
  .contentNews .ct-recent-news {
    flex-direction: inherit;
  }
  .contentFaq .faq_question .col-sm-11 {
    padding-right: 0px;
  }
  .peopleDetail h2 {
    margin-top: -5px;
  }
  .searchFilter .btn {
    min-width: 172px;
  }
  .searchFilter .label-icon {
    display: inline-block;
  }
  .searchFilter .glyphicon {
    margin-right: -5px;
  }
  .ct-header .ct-jumbotron {
    top: 0;
    margin-top: 5%;
  }
  .ct-header .ct-jumbotron h1 {
    font-size: 2.5em;
  }
  .ct-news.ct-news--bigger h3 {
    font-size: 41px;
    line-height: 1.4;
  }
}
@media (max-width: 768px) {
  .ct-header .ct-jumbotron {
    width: 80%;
    margin: 20px 10px;
    top: 40%;
    width: 95%;
  }
  .ct-header .ct-jumbotron .inner {
    max-width: 100%;
  }
  #dots-container {
    display: none;
  }
  .main-section {
    margin-top: -80px;
  }
  .searchFilter .dropdown-menu-right {
    right: 0px;
  }
}

#n1,
#n2,
#table_filter {
  display: inline-block;
  vertical-align: middle;
}

/* .container {
  margin-top: 15px;
} */

html {
  overflow-y: scroll;
}
</style>
