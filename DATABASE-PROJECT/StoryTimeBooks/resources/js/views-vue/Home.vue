<template>

  <div>
    <Navbar />
    <!--<div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Home Component</div>
            <div class="card-body">
              Welcome to Homepage
              <br />
            </div>
          </div>
        </div>
      </div>-->
      <Footer />
  </div>
    <!--</div>
  </div>-->
</template>
   
<script>
import Navbar from '../components/Navbar'
import Footer from '../components/Footer'
export default {
  components: {
    Navbar,
    Footer,
  },
  mounted() {
    console.log("Home mounted.");
  },
  props: [

  ]
};
</script>