<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="https://www.clipartmax.com/png/middle/0-4398_stack-of-books-image-stack-clipart-school-book-clip-books-and-pencils.png">
        <script src="https://code.iconify.design/1/1.0.5/iconify.min.js"></script>
        <link href="/css/app.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
            <vue-progress-bar></vue-progress-bar>
        </div>
            <script type="text/javascript" src="/js/app.js"></script>
            <script type="text/css" src="/js/bootstrap.js"></script>
    </body>
</html>
<style>
#app {
    overflow-x: hidden;
}
.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 200%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
}
@media screen and (max-width: 500px) {
  .modal-content {
    width: 100%;
  }
}
</style>
