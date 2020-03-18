<template>

  <div>
    <navtop />
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
      <navbottom />
  </div>
    <!--</div>
  </div>-->
</template>
   
<script>
import navtop from '../components/navtop'
import navbottom from '../components/navbottom'
export default {
  mounted() {
    console.log("Home mounted.");
  },
  props: [

  ]
};
</script>