<template>
<div>
  <head>
    <title>StoryTime | Profile</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
    <navtop id="profile" />
    <b-overlay :show="busy" rounded="lg" opacity="1.0">
    <div class="profileBody">
      <div class="profileContent">
        <p class="profileTitle">Edit Profile</p>

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
                  v-mask="'(999) 999-9999'"
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
                  v-mask="'(999) 999-9999'"
                ></b-form-input>
              </b-col>
            </b-row>
          </b-container>
      </div>

      <div class="profileContent">
        <p class="profileTitle">Shipping Address</p>
        <form @submit.prevent="updateUser(userid)">
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
                  required
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
                  required
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
                  v-mask="{ mask: ['99999[-9999]','9A9 A9A'] }"  
                  v-model="zip"
                  required
                ></b-form-input>
              </b-col>
            </b-row>
          </b-container>
          <!-- Submit Changes -->
          <b-button class="btn1" type="submit">Apply Changes</b-button>
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
      stateOptions: [{value:null, text: "Please select a state or US territory"}],
      selected: null
    };
  },
  created() {
    this.getUserInfo();
    this.setStateOptions();
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
        .get("../../../api/v1/auth/userinfo/{id}", {
          params: { id: this.$auth.user().id }
        })
        .then(function(response) {
          if (response.data.user !== null) {
            user.userid = response.data.user.id;
            user.first_name = response.data.user.first_name;
            user.last_name = response.data.user.last_name;
            user.email = response.data.user.email;
          }
          if (response.data.shipping !== null) {
            user.addressLine1 = response.data.shipping.address_line_1;
            user.suiteNo = response.data.shipping.suite_no;
            user.city = response.data.shipping.city;
            user.selected = response.data.shipping.state_id;
            user.zip = response.data.shipping.zipcode;
            user.homePhone = response.data.shipping.home_phone;
            user.workPhone = response.data.shipping.work_phone;
          }
          user.setStateOptions();
        })
        .catch(error => {
          console.log(error);
          user.busy = false
          user.$notify({
              message: "There has been an error loading user information. Please try again.",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
        });
    },
    updateUserAddress(userid) {
      const user = this;
      axios
        .put("../../../api/v1/auth/updateuseraddress/{id}", {
          address_line_1: user.addressLine1,
          suite_no: user.suiteNo,
          city: user.city,
          state_id: user.selected,
          zipcode: user.zip,
          home_phone: user.homePhone,
          work_phone: user.workPhone,
          id: user.userid
        })
        .then(function(response) {
          user.busy = false;
        })
        .catch(error => {
          console.log(error);
          user.busy = false
          user.$notify({
              message: "There has been an error updating user address information. Please try again.",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
        });
    },
    updateUser(userid) {
      const user = this;
      user.busy = true;
      axios
        .put("../../../api/v1/auth/updateuser/{id}", {
          first_name: user.first_name,
          last_name: user.last_name,
          email: user.email,
          id: user.userid
        })
        .then(function(response) {
          user.updateUserAddress(userid);
        })
        .catch(error => {
          console.log(error);
          user.busy = false
          user.$notify({
              message: "There has been an error updating user information. Please try again.",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
        });
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
        .post("../../../api/v1/auth/removeuser/{id}", {
          id:  idToRemove 
        })
        .then(function(response) {
          app.busy = false
          app.logout();
        })
        .catch(error => {
          console.log(error);
          app.busy = false
          app.$notify({
              message: "There has been an error removing this user.",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
        });
    },
    setStateOptions() {
      var user = this
      axios
        .get("../../../api/v1/admin/states")
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
@media screen and (max-width: 1100px) {
    .profileBody {
      margin: 0 !important;
      width: auto !important;
      padding-left: 5% !important;
      overflow-x: hidden; 
    }
}
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
  background: white;
  color: black;
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
  color: white;
}
.profileBody {
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
