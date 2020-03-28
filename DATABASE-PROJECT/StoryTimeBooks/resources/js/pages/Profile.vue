<template>
<div>
  <head>
    <title>StoryTime | User Profile</title>
  </head>
  <navtop />
  <div class="profileBody">
    <div class="profileContent">
      <p class="profileTitle">Edit Profile</p>

      <b-container fluid>
        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Name</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your name"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Email</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your email"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Username</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your username"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Phone Number</label>
          </b-col>
          <b-col sm="10">
            <b-form-input id="input-large" size="lg" placeholder="Enter your phone number"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label" sm="2">
            <label for="input-large">Sex</label>
          </b-col>
          <b-col sm="10">
            <b-form-select
              id="input-large"
              size="lg"
              class="mr-lg-10"
              v-model="searchFilter "
              :options="options"
            ></b-form-select>
          </b-col>
        </b-row>

        <b-row class="my-1" v-for="type in types" :key="type">
          <b-col class="label" sm="2">
            <label for="input-large">Birthday</label>
          </b-col>
          <b-col sm="10">
            <b-form-input size="lg" class="mr-lg-10 birthday" :id="`type-${type}`" :type="type"></b-form-input>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label bioLabel" sm="2">
            <label for="input-large">Biography</label>
          </b-col>
          <b-col sm="10">
            <b-form-textarea
              size="lg"
              id="textarea"
              v-model="text"
              placeholder="Enter your biography"
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-col>
        </b-row>

        <b-row class="my-1">
          <b-col class="label submitButton" sm="2">
            <b-button id="submit" variant="success">Submit</b-button>
          </b-col>
        </b-row>
      </b-container>
    </div>
  </div>
  <navbottom />
</div>
</template>

<style>
.profileBody {
  border: 1px solid black;
  width: 80%;
  margin: auto;
  padding-left: 15%;
}

.profileContent {
  margin: 5% 5%;
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

.submitButton {
  margin-top: 2%;
}

#submit {
  width: 700px;
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
  width: 700px;
}
</style>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      firstname: "",
      types: ["date"],
      searchFilter: "a",
      options: [
        // { value: null, text: "Please select some item" },
        { value: "a", text: "Male" },
        { value: "b", text: "Female" }
      ],
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