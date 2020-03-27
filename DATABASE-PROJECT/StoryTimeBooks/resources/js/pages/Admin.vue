<template>
<div>
  <head>
    <title>StoryTime | Admin</title>
  </head>
  <navtop />
  <div>
    <b-table sticky-header :items="items" head-variant="light"></b-table>
  </div>
  <navbottom />
</div>
</template>

<script>
import navtop from "../components/navtop";
import navbottom from "../components/navbottom";
export default {
  data() {
    return {
      components: {
        navtop,
        navbottom
      },
      items: [
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        },
        {
          heading1: "table cell",
          heading2: "table cell",
          heading3: "table cell"
        }
      ]
    };
  }
};
</script>