<template>
  <b-modal centered ref="categoryModal" id="categoryModal" :title="title" @ok="handleOk" ok-title="Add Category">
    <form method="POST" @submit.prevent="addCategory" ref="form">
      <!-- Publisher Name -->
      <b-form-group
        label="Category Name"
        label-for="catname"
        invalid-feedback="Category Name is required"
        :state="categoryState"
      >
        <b-form-input id="catname" v-model="category_name" required :state="categoryState"></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      category_name: "",
      categoryState: null
    };
  },
  props: {
    title: String
  },
  methods: {
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.publisherState = valid;
      return valid;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      if(this.checkFormValidity())
      this.addCategory();
    },
    addCategory() {
      var app = this
      axios
      .post("http://127.0.0.1:8000/api/v1/admin/newcategory", {
        category_name: this.category_name
      })
      .then(function(response) {
        console.log(response);
        app.$refs['categoryModal'].hide()          
        app.$emit('refreshTables') // calls the event listener in Admin.vue, which calls the getAll() method
        app.$notify({
              message: "Product Category successfully added",
              type: "success",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
      })
      .catch(function(response) {
        console.log(response);
        app.$refs['categoryModal'].hide()
        app.$notify({
              message: "There has been an error adding this product category",
              type: "error",
              top: true,
              bottom: false,
              left: false,
              right: true,
              showClose: true,
              closeDelay: 4500,
            });
      });
      }
    }
};
</script>