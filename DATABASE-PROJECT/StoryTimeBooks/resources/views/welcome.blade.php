<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="https://www.clipartmax.com/png/middle/0-4398_stack-of-books-image-stack-clipart-school-book-clip-books-and-pencils.png">
        <link href="css/app.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>StoryTime | Home</title>
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
            <script type="text/javascript" src="js/app.js"></script>
            <script type="text/css" src="js/bootstrap.js"></script>
    </body>
</html>
