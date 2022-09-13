<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'EasyMenager' }}</title>

    <!-- Skrypty -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/c46247eba8.js" crossorigin="anonymous"></script>
    
    
    

    <!-- Czcionki -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <!-- css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dark-mode.css') }}" rel="stylesheet">
</head>
<body data-theme="dark">

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm" style="position: fixed; z-index: 999; top: 0px; left: 0px; width: 100vw;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}" style="font-family: 'Press Start 2P', cursive; font-size: 14px;">
                    {{ 'EasyMenager' }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Zarejestruj') }}</a>
                                </li>
                            @endif
                        @else
                            
                            <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/../uploads/avatars/{{ Auth::user()->avatar }}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px; border: 1px solid black;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if ((Auth::user()->is_admin) == 'Administrator')
                                <a class="dropdown-item" href="{{ url('/panel') }}">
                                    {{ __('Panel Admina') }}
                                </a>
                                @endif
                                    <a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id ) }}">
                                        {{ __('Profil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/hours') }}">
                                        {{ __('Godziny') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="custom-control custom-switch" style="position: fixed; bottom: 15px; right: 15px;">
        <label class="label-switch switch-primary">
	        <input type="checkbox" id="darkSwitch" class="switch switch-bootstrap status" name="status" id="status" value="1" checked="checked">
            <span class="lable"></span>
        </label>
        <!-- <input type="checkbox" class="custom-control-input" id="darkSwitch">
        <label class="custom-control-label" for="darkSwitch">Ciemny motyw</label> -->
    </div>
    <script src="{{ asset('js/dark-mode-switch.min.js') }}"></script>
    
</body>
</html>
