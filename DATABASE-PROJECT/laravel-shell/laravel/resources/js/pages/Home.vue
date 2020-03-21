<template>
  <div>
    <head>
      <title>StoryTime | Home</title>
    </head>
    <navtop />
    <navbottom />
  </div>
</template>
   
<script>
import navtop from '../components/navtop'
import navbottom from '../components/navbottom'
export default {
  mounted() {
    console.log("Home mounted.");
  },
  components: {
    navtop,
    navbottom,
  }
};
</script>