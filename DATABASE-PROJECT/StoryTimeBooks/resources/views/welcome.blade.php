<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>StoryTime | Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <div id="app">
             {{-- <navtop /> --}}
            {{-- <navbottom /> --}}
            <Home />
        </div>
    <h1 class="flex-center position-ref full-height">StoryTime Books</h1>

        <script type="text/javascript" src="js/app.js"></script>
        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> --}}
    </body>

        <!--JavaScript-->
        {{-- <script>
            /*Textbox Events*/
            $(document).on('focusin', 'navbar input.search-textbox', function(){
                if($(this).val() <= 0){
                    var parent = $(this).closest('div.search');
                    parent.addClass('focused');
                }
            });
            $(document).on('focusout', 'navbar input.search-textbox', function(){
                if($(this).val() <= 0){
                    var parent = $(this).closest('div.search');
                    parent.removeClass('focused');
                }
            });
            $(document).on('click', 'navbar .search', function(){
                $(this).children('input.search-textbox').focus();
            });
            
            /*Text Key Events for Animating Icons i.e. .ico-btn*/
            $(document).on('keyup', 'navbar input.search-textbox', function(){
                var parent = $(this).closest('div.search');
                var phrase = $(this).val(),
                    phrase_length = phrase.length;
            
                if(phrase_length >= 2){
                    parent.addClass('multi-char');
                    if(!parent.hasClass('not-null')){
                        parent.addClass('not-null');
                    }
            
                }
                else if(phrase_length == 1){
                    parent.addClass('not-null');
                    parent.removeClass('multi-char');
                }
                else if(phrase_length <= 0){
                    parent.removeClass('not-null');
                    parent.removeClass('multi-char');
                }
            });
            
            /*Tab Highlighter Functionality*/
            $(document).on('click', 'navbar .tabs ul.navbar-body li a', function(){
                var $this = $(this);
                TabHighlighter.set($this);
                $this.closest('li').siblings('.active').removeClass('active');
                $this.closest('li').addClass('active');
            });
            var TabHighlighter = {
                set: function($this){
                    $('.tab-highlighter').css({
                        'left':  $this.closest('li').offset().left,
                        'width': $this.closest('li').outerWidth()
                    });
                },
                refresh: function(){
                    var $this = $('.tabs ul.navbar-body li.active a');
                    $('.tab-highlighter').css({
                        'left':  $this.closest('li').offset().left,
                        'width': $this.closest('li').outerWidth()
                    });
                }
            };
            $(window).resize(function(){
                TabHighlighter.refresh();
            });
            $(document).ready(function(){
                TabHighlighter.refresh();
            });
            </script> --}}

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 20vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

</style>
</html>
