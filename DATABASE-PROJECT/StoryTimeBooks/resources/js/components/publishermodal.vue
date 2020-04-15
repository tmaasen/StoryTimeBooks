<template>
  <b-modal centered ref="publisherModal" id="publisherModal" :title="title" @ok="handleOk" ok-title="Add Publisher">
    <form method="POST" @submit.prevent="addPublisher" ref="form">
      <!-- Publisher Name -->
      <b-form-group
        label="Publisher Name"
        label-for="pubname"
        invalid-feedback="Publisher Name is required"
        :state="publisherState"
      >
        <b-form-input id="pubname" v-model="publisher_name" required :state="publisherState"></b-form-input>
      </b-form-group>
      <!-- Address -->
      <b-form-group
        label="Address"
        label-for="address"
        invalid-feedback="Publisher address is required"
        :state="publisherState"
      >
        <b-form-input id="address" v-model="address" required :state="publisherState"></b-form-input>
      </b-form-group>
      <!-- City -->
      <b-form-group
        label="City"
        label-for="city"
        invalid-feedback="Publisher's city is required"
        :state="publisherState"
      >
        <b-form-input id="city" v-model="city" required :state="publisherState"></b-form-input>
      </b-form-group>
      <!-- State -->
      <b-form-group
        label="State"
        label-for="states"
        invalid-feedback="Publisher's state is required"
        :state="publisherState"
      >
      <b-form-select
        id="states"
        name="states"
        required
        :state="publisherState"
        v-model="selected"
        :options="stateOptions"
      ></b-form-select>
      </b-form-group>
      <!-- Zip Code -->
      <b-form-group
        label="Zip Code"
        label-for="zip"
        invalid-feedback="Publisher zip code is required"
        :state="publisherState"
      >
        <b-form-input
          id="zip"
          v-model="zip_code"
          required
          :state="publisherState"
        ></b-form-input>
      </b-form-group>
      <!-- Phone -->
      <b-form-group
        label="Contact"
        label-for="phone"
        invalid-feedback="Publisher contact number is required"
        :state="publisherState"
      >
        <b-form-input
          id="phone"
          v-model="phone"
          required
          :state="publisherState"
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      publisher_name: "",
      address: "",
      city: "",
      state: null,
      zip_code: "",
      phone: "",
      states: [],
      stateOptions: [],
      selected: null,
      publisherState: null
    };
  },
  props: {
    title: String
  },
  created() {
    this.setStateOptions();
  },
  methods: {
    setStateOptions() {
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
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.publisherState = valid;
      return valid;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      if(this.checkFormValidity())
      this.addPublisher();
    },
    addPublisher() {
      var app = this
      axios
      .post("http://127.0.0.1:8000/api/v1/admin/newpublisher", {
        publisher_name: this.publisher_name,
        address: this.address,
        city: this.city,
        state_id: this.selected,
        zipcode: this.zip_code,
        phone: this.phone,
      })
      .then(function(response) {
        console.log(response);
        app.$refs['publisherModal'].hide()          
        app.$emit('refreshTables') // calls the event listener in Admin.vue, which calls the getAll() method
      })
      .catch(function(response) {
        console.log(response);
        alert("There has been an error adding a publisher. Please try again.");
      });
      }
    }
};
</script>