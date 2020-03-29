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
          <b-col class="label" sm="2">
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
    </div>

    <div class="profileContent">
      <p class="profileTitle">Address Information</p>

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
      <form action="/action_page.php">
      <input type="submit" value="Apply Changes" class="btn1" />
      </form>
    </div>
  </div>
  <navbottom />
</div>
</template>

<style>
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

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      firstname: "",
      searchFilter: "a",
      text: ""
    };
  },
  mounted() {
    console.log("Home mounted.");
  },
  components: {
    navtop,
    navbottom
  }
};
</script>