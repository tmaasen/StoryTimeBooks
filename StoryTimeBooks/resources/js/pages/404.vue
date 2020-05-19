<template>
  <div class="hello">
    <head><title>StoryTime | 404</title></head>
    <img src="../assets/StoryTime.png" width="400" class="navbar-brand" />
    <h1>404 Page Not Found</h1>
    <h4><router-link :to="{name: 'Home'}">Go Home</router-link></h4>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.hello, h1, h4 {
  text-align: center;
  padding-top: 25px;
  padding-bottom: 25px;
}
img {
  background-color: #252525;
}
</style>