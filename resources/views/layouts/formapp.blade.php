<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/consulta.js') }}" defer></script> <!-- Script para manejar las operaciones crud de consulta -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">   

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myappstyle.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="navigation">
                <ul class="nav nav-tabs navul" id="myTab" role="tablist">                    
                    <hr class="menuhr">
                    <li class="catli nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#consulta" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <span class="icon my-auto"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <span class="title my-auto">Pacientes</span>
                        </a>
                    </li>
                    <hr class="menuhr">
                    <li class="catli nav-item">
                        <a class="nav-link disabled" id="profile-tab" data-bs-toggle="tab" data-bs-target="#interrogatorio" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <span class="icon my-auto"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                            <span class="title my-auto">Consulta</span>
                        </a>
                    </li>
                    <hr class="menuhr">
                    <li class="catli nav-item">
                        <a class="nav-link disabled" id="contact-tab" data-bs-toggle="tab" data-bs-target="#exploracion" type="button" role="tab" aria-controls="contact" aria-selected="false">
                            <span class="icon my-auto"><i class="fa fa-sticky-note" aria-hidden="true"></i></span>
                            <span class="title my-auto">Geriatría</span>
                        </a>
                    </li>
                    <hr class="menuhr">
                    <hr class="menuhr">
                    <li class="catli nav-item">
                        <a class="nav-link disabled" id="contact-tab" data-bs-toggle="tab" data-bs-target="#exploracion" type="button" role="tab" aria-controls="contact" aria-selected="false">
                            <span class="icon my-auto"><i class="fa fa-sticky-note" aria-hidden="true"></i></span>
                            <span class="title my-auto">Catálogos</span>
                        </a>
                    </li>
                    <hr class="menuhr">
                </ul>
            </div>
        </div>
        <div class="py-4 container-fluid main">
            @yield('content')
        </div>
    </div>
</body>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/068a66244d.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
</html>
