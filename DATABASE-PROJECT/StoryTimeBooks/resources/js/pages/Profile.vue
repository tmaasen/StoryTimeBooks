<template>
<div>
  <head>
    <title>StoryTime | Profile</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <b-overlay :show="busy" rounded="lg" opacity="0.6">
    <navtop id="profile" />
    <div class="profileBody">
      <div class="profileContent">
        <p class="profileTitle">Edit Profile</p>

        <form method="POST" @submit.prevent="updateUser">
          <b-container fluid>
            <!-- First Name -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">First Name</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your First name"
                  v-model="first_name"
                  required
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- Last Name -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">Last Name</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Last name"
                  v-model="last_name"
                  required
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- Email -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">Email</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Email"
                  v-model="email"
                  required
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- Home Phone -->
            <b-row class="my-1">
              <b-col class="label" sm="2" style="padding-right:0px">
                <label for="input-large">Home Phone</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Home Phone"
                  v-model="homePhone"
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- Work Phone -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">Work Phone</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Work Phone"
                  v-model="workPhone"
                ></b-form-input>
              </b-col>
            </b-row>
          </b-container>
        </form>
      </div>

      <div class="profileContent">
        <p class="profileTitle">Address Information</p>
        <form>
          <b-container fluid>
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <!-- Address Line 1 -->
                <label for="input-large">Address</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Address"
                  v-model="addressLine1"
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- Suite No -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">Suite No.</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Suite No."
                  v-model="suiteNo"
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- City -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">City</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your City"
                  v-model="city"
                ></b-form-input>
              </b-col>
            </b-row>
            <!-- State -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">State</label>
              </b-col>
              <b-col sm="10">
                <b-form-select
                  id="states"
                  name="states"
                  required
                  v-model="selected"
                  :options="stateOptions"
                  size="lg"
                  style="width:500px;color:#495057"
                ></b-form-select>
              </b-col>
            </b-row>
            <!-- Zip Code -->
            <b-row class="my-1">
              <b-col class="label" sm="2">
                <label for="input-large">Zip Code</label>
              </b-col>
              <b-col sm="10">
                <b-form-input
                  id="input-large"
                  size="lg"
                  placeholder="Enter your Zip Code"
                  v-model="zip"
                ></b-form-input>
              </b-col>
            </b-row>
          </b-container>
          <!-- Submit Changes -->
          <input type="submit" value="Apply Changes" class="btn1" v-on:click="updateUser(userid)" />
          <!-- Remove Account -->
          <span>
            <b-button class="tablebuttons" v-b-modal="`remove-user`">
              <b-icon id="icons" icon="trash-fill" variant="danger"></b-icon>Remove Account
            </b-button>
            <b-modal
              :id="`remove-user`"
              centered
              title="Remove Account"
              @ok="removeUser(userid)"
            >
              <p class="my-4">Are you sure you want to remove this account?</p>
              <p class="my-2">Select Ok to proceed.</p>
              <p class="my-4">Select Cancel or click out of the popup box to continue StoryTime.</p>
            </b-modal>
          </span>
        </form>
      </div>
    </div>
    <navbottom />
  </b-overlay>
</div>
</template>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";

export default {
  data() {
    return {
      busy: false,
      userid: "",
      first_name: "",
      last_name: "",
      email: "",
      homePhone: "",
      workPhone: "",
      addressLine1: "",
      suiteNo: "",
      city: "",
      state: "",
      zip: "",
      searchFilter: "a",
      expmonth: null,
      states: [],
      stateOptions: [{text: "Select your State"}],
      selected: null
    };
  },
  created() {
    this.getUserInfo();
    this.setStateOptions();
  },
  mounted() {
    console.log("Profile mounted.");
  },
  components: {
    navtop,
    navbottom
  },
  methods: {
    getUserInfo(userid) {
      var user = this;
      user.busy = true;
      axios
        .get("http://127.0.0.1:8000/api/v1/auth/userinfo/{id}", {
          params: { id: this.$auth.user().id }
        })
        .then(function(response) {
          console.log(response);
          if (response.data.user !== null) {
          user.userid = response.data.user.id;
          user.first_name = response.data.user.first_name;
          user.last_name = response.data.user.last_name;
          user.email = response.data.user.email;
          user.homePhone = response.data.user.home_phone;
          user.workPhone = response.data.user.work_phone;
          user.addressLine1 = response.data.user.address_line_1;
          user.suiteNo = response.data.user.suite_no;
          user.city = response.data.user.city;
          user.selected = response.data.user.state_id;
          user.zip = response.data.user.zipcode;
          user.setStateOptions();
          }
        })
        .catch(error => {
          console.log(error);
          user.busy = false
          alert(
            "There has been an error loading user data. Please try again."
          );
        });
    },
    updateUserAddress(userid) {
      const user = this;
      axios
        .put("http://127.0.0.1:8000/api/v1/auth/updateuseraddress/{id}", {
          address_line_1: user.addressLine1,
          suite_no: user.suiteNo,
          city: user.city,
          state_id: user.selected,
          zipcode: user.zip,
          home_phone: user.homePhone,
          work_phone: user.workPhone,
          user_id: user.userid
        })
        .then(function(response) {
          console.log(response);
          user.busy = false;
        })
        .catch(error => {
          console.log(error);
          user.busy = false
          alert(
            "There has been an error updating user address information. Please try again."
          );
        });
    },
    updateUser(userid) {
      const user = this;
      user.busy = true;
      axios
        .put("http://127.0.0.1:8000/api/v1/auth/updateuser/{id}", {
          first_name: user.first_name,
          last_name: user.last_name,
          email: user.email,
          id: user.userid
        })
        .then(function(response) {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
          user.busy = false
          alert(
            "There has been an error updating user information. Please try again."
          );
        });
      this.updateUserAddress(userid);
    },
    logout() {
      this.$auth.logout({
        makeRequest: true,
        params: {
          name: ""
        },
        success: function() {
        },
        error: function() {
        },
        redirect: "/login"
      });
    },
    removeUser(idToRemove) {
      var app = this
      app.busy = true
      axios
        .post("http://127.0.0.1:8000/api/v1/auth/removeuser/{id}", {
          id: { idToRemove }
        })
        .then(function(response) {
          console.log(response);
          app.busy = false
        })
        .catch(error => {
          console.log(error);
          app.busy = false
          alert("There has been an error removing the user. Please try again.");
        });
      this.logout();
    },
    setStateOptions() {
      var user = this
      axios
        .get("http://127.0.0.1:8000/api/v1/admin/states")
        .then(response => {
          this.states = response.data.states;
          for (var i = 0; i < this.states.length; i++) {
            var option = [];
            for (var key in this.states[i]) {
              if (key == "id") {
                option["value"] = this.states[i][key];
              } else if (key == "state") {
                option["text"] = this.states[i][key];
              }
            }
            this.stateOptions.push(Object.assign({}, option));
            user.busy = false;
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.tablebuttons {
  background: transparent;
  border: none;
  padding: 0%;
}
.tablebuttons:hover {
  border: 2px solid gray;
}
.form-control {
  width: 25%;
}
svg {
  fill: black;
}
.btn,
.btn:hover {
  background: white !important;
  color: black !important;
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
