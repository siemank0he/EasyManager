<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EasyMenager</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body{
                overflow: hidden;
                font-family: 'Open Sans', sans-serif;
                background: linear-gradient(270deg, #ff0000, #0005ff, #10ac00);
                background-size: 600% 600%;

                -webkit-animation: AnimationName 30s ease infinite;
                -moz-animation: AnimationName 30s ease infinite;
                animation: AnimationName 30s ease infinite;
            }

            @-webkit-keyframes AnimationName {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @-moz-keyframes AnimationName {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @keyframes AnimationName {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }

            .pacifico{
                font-family: 'Press Start 2P', cursive;
                color: white;
            }

            .container{
                width: 100vw;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .buttons{
                margin-top: 30px;
            }

            .buttons .button-log{
                height: 40px;
                width: 120px;
                padding: 10px 20px;
                color: white;
                text-decoration: none;
                border-radius: 10px;
                border: 1px solid white;
                font-size: 14px;

            }
        </style>
    </head>
    <body>
        <div class="container">
            @if (Route::has('login'))
                <div>
                    <h1 class="pacifico">EasyMenager</h1>
                </div>
                <div class="buttons">
                    @auth
                        <a class="button-log" href="{{ url('/home') }}">Główna</a>
                    @else
                        <a style="margin-right: 10px;" class="button-log" href="{{ route('login') }}">Zaloguj</a>

                        @if (Route::has('register'))
                            <a class="button-log" href="{{ route('register') }}">Rejestracja</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
