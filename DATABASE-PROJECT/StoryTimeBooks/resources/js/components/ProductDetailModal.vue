<template>
<b-modal
  centered
  scrollable
  ref="ProductDetailModal"
  :id="`ProductDetailModal${userid}`"
  :title="title"
>
  <b-overlay :show="busy" rounded="lg" opacity="0.6">
    <head>
      <title>StoryTime | Product Detail</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    </head>

    <div class="book-detail-container">
      <div id="img-container" class="block">
        <img src="https://images.bwbcovers.com/155/People-Who-Led-to-My-Plays-9781559361255.jpg" />
      </div>

      <div class="block detail-texts">
        <div class="detail-title-and-author">
          <h1>People Who Led to My Plays</h1>
          <h2>by Adrienne Kennedy</h2>
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

    <div class="promo-container">
      <img class="promo-image" src="../assets/promotion-banner.jpg" />
    </div>
  </b-overlay>
</b-modal>
</template>

<script>

export default {
  data() {
    return {
      detailsTable: [
        { "ISBN-13": 9780134322759, TYPE: "PAPERBACK", PRICE: 102.32 }
      ]
    };
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