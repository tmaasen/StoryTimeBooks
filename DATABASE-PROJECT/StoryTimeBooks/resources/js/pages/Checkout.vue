<template>
<div>
  <head>
    <title>StoryTime | Checkout</title>
  </head>

  <div>
    <div class="profileContent">
      <p class="profileTitle">Credit Card Information</p>

      <b-container fluid>
        <div class="row1">
          <div class="col-75">
            <div class="container1">
              <form action="/action_page.php">
                <div class="row1">
                  <div class="col-50">
                    <h3>Billing Address</h3>
                    <label for="fname">
                      <i class="fa fa-user"></i> Full Name
                    </label>
                    <input
                      type="text"
                      class="creditInput"
                      id="fname"
                      name="firstname"
                      placeholder="John M. Doe"
                    />
                    <label for="email">
                      <i class="fa fa-envelope"></i> Email
                    </label>
                    <input
                      type="text"
                      class="creditInput"
                      id="email"
                      name="email"
                      placeholder="john@example.com"
                    />
                    <label for="adr">
                      <i class="fa fa-address-card-o"></i> Address
                    </label>
                    <input
                      type="text"
                      class="creditInput"
                      id="adr"
                      name="address"
                      placeholder="542 W. 15th Street"
                    />
                    <label for="city">
                      <i class="fa fa-institution"></i> City
                    </label>
                    <input
                      type="text"
                      class="creditInput"
                      id="city"
                      name="city"
                      placeholder="New York"
                    />

                    <div class="row1">
                      <div class="col-50">
                        <label for="state">State</label>
                        <input
                          type="text"
                          class="creditInput"
                          id="state"
                          name="state"
                          placeholder="NY"
                        />
                      </div>
                      <div class="col-50">
                        <label for="zip">Zip Code</label>
                        <input
                          type="text"
                          class="creditInput"
                          id="zip"
                          name="zip"
                          placeholder="10001"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-50">
                    <h3>Payment</h3>
                    <label for="fname">Accepted Cards</label>
                    <div class="icon-container">
                      <i class="fa fa-cc-visa" style="color:navy;"></i>
                      <i class="fa fa-cc-amex" style="color:blue;"></i>
                      <i class="fa fa-cc-mastercard" style="color:red;"></i>
                      <i class="fa fa-cc-discover" style="color:orange;"></i>
                    </div>
                    <label for="cname">Name on Card</label>
                    <input
                      type="text"
                      class="creditInput"
                      id="cname"
                      name="cardname"
                      placeholder="John More Doe"
                    />
                    <label for="ccnum">Credit card number</label>
                    <input
                      type="text"
                      class="creditInput"
                      id="ccnum"
                      name="cardnumber"
                      placeholder="1111-2222-3333-4444"
                    />
                    <label for="expmonth">Exp Month</label>
                    <input
                      type="text"
                      class="creditInput"
                      id="expmonth"
                      name="expmonth"
                      placeholder="September"
                    />
                    <div class="row1">
                      <div class="col-50">
                        <label for="expyear">Exp Year</label>
                        <input
                          type="text"
                          class="creditInput"
                          id="expyear"
                          name="expyear"
                          placeholder="2018"
                        />
                      </div>
                      <div class="col-50">
                        <label for="cvv">CVV</label>
                        <input
                          type="text"
                          class="creditInput"
                          id="cvv"
                          name="cvv"
                          placeholder="352"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <label>
                  <input type="checkbox" checked="checked" name="sameadr" /> Shipping address same as billing
                </label>
                <input type="submit" value="Apply Changes" class="btn1" />
              </form>
            </div>
          </div>
        </div>
      </b-container>
    </div>
  </div>
</div>
</template>


<style>
.profileContent {
  margin: 5% 25% 5% 0%;
}
.profileTitle {
  font-size: 40px;
  margin-bottom: 5%;
  border-bottom: 3px solid black;
  padding: 10 10 4px;
  width: 760px;
}
.creditInput {
  margin-bottom: 5%;
}
.row1 {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container1 {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn1 {
  background-color: #ff8d1e;
  color: white;
  padding: 12px;
  margin: 70px 0 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn1:hover {
  background-color: #45a049;
}

a {
  color: #2196f3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row1 {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>