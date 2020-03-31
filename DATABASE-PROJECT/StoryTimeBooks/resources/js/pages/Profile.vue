<template>
<div>
  <head>
    <title>StoryTime | Profile</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <navtop />
  <div class="profileBody">
    <div class="profileContent">
      <p class="profileTitle">Edit Profile</p>

      <form method="POST" @submit.prevent="updateUser">
      <b-container fluid>
        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">First Name</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your First name"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Last Name</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Last name"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Email</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Email"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2" style="padding-right:0px">
            <label for="input-large">Home Phone</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Home Phone"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Work Phone</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Work Phone"></b-form-input>
          </b-col>
        </b-row>
      </b-container>
      </form>
    </div>

    <div class="profileContent">
      <p class="profileTitle">Address Information</p>
      <form method="POST" @submit.prevent="updateUserAddress">
      <b-container fluid>
        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Address</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Address"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Suite No.</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Suite No."></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">City</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your City"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">State</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your State"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Zip Code</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your Zip Code"></b-form-input>
          </b-col>
        </b-row>
      </b-container>
      <!-- <form action="/action_page.php"> -->
      <input type="submit" value="Apply Changes" class="btn1" />
      </form>
    </div>
  </div>
  <navbottom />
</div>
</template>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      firstname: "",
      searchFilter: "a",
      text: "",
      expmonth: null,
    };
  },
  mounted() {
    console.log("Home mounted.");
  },
  components: {
    navtop,
    navbottom
  },
  methods: {
    updateUser(){

    },
    updateUserAddress() {

    },
    updateUserCreditCard() {

    },
  }
};
</script>

<style scoped>
.form-control {
  width:25%;
}
svg {
  fill:black;
}
.btn, .btn:hover {
  background: white !important;
  color:black !important;
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
  background-color: #2196f3;
}
.profileBody {
  border: 1px solid black;
  width: 80%;
  margin: auto;
  padding-left: 15%;
  font-family: Arial;
  font-size: 16px;
}

.profileContent {
  margin: 5% 25% 5% 0%;
}

#input-large {
  width: 500px;
}

#textarea {
  width: 500px;
}

.birthday {
  width: 500px;
}

.label {
  text-align: left;
  margin-top: auto;
  font-weight: bold;
}

.bio {
  height: 200px;
}

.bioLabel {
  margin: auto;
}

.profileTitle {
  font-size: 40px;
  margin-bottom: 5%;
  border-bottom: 3px solid black;
  padding: 10 10 4px;
  width: 760px;
}
</style>
