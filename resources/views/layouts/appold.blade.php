<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ url('img/heartred.png') }}">
    
    <meta name="base_url" content="{{ URL::to('/') }}"> <!-- Linea para obtener la url root de la app -->
    
    <meta name="asset_url" content="{{ URL::asset("/img/icons/") }}"> <!-- Linea para obtener la url root de la app -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- App js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/consulta.js')."?v=1.16" }}" defer></script> <!-- Script para manejar las operaciones crud de consulta -->
    <script src="{{ asset('js/interrogatorio.js')."?v=1.16" }}" defer></script> <!-- Script para manejar las operaciones crud de interrogatorio -->
    <script src="{{ asset('js/exploracion.js')."?v=1.16" }}" defer></script> <!-- Script para manejar las operaciones crud de interrogatorio -->
    <script src="{{ asset('js/notifications.js')."?v=1.16" }}" defer></script> <!-- Script para manejar las notificaciones de consultas sin terminar -->

    <!-- Scripts -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.js"></script>
    <script src="https://use.fontawesome.com/068a66244d.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- JS y CSS para select con busqueda customizable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha512-hgoywpb1bcTi1B5kKwogCTG4cvTzDmFCJZWjit4ZimDIgXu7Dwsreq8GOQjKVUxFwxCWkLcJN5EN0W0aOngs4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha512-nATinx3+kN7dKuXEB0XLIpTd7j8QahdyJjE24jTJf4HASidUCFFN/TkSVn3CifGmWwfC2mO/VmFQ6hRn2IcAwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css')."?v=1.16"  }}" rel="stylesheet">
    <link href="{{ asset('css/myappstyle.css')."?v=1.16" }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <h5><b><i class="bi bi-house-door-fill"></i></b></h5>
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
                                    <span class="hiddenli position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle" id="usernotiBadge">
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('consultamedico') }}">
                                        {{ __('Consultas') }} <span class="badge bg-danger text-light" id="notificationBadge"></span>
                                    </a>

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

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>

    <div class="footer">
        <div class="col-md-12 row">
            <div class="col-md-6">Expediente Clínico Electrónico – ECE SAAS - 2021</div>
            <div class="col-md-6">
                <a href="#" class="footer-link">Privacidad</a>
                <a href="#" class="footer-link">Terminos de uso</a>
                <a href="#" class="footer-link">Acerca de ECE-SAAS</a>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var url = $('meta[name="base_url"]').attr('content');

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select2').select2();

        $('[data-bs-toggle="tooltip"]').tooltip({
            trigger : 'hover',
            boundary: 'viewport'
        });

        $('[data-toggle="tooltip"]').tooltip({
            trigger : 'hover',
            boundary: 'viewport'
        });
    });
</script>
</html>
