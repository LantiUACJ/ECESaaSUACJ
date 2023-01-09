<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url(asset('img/applogo.png')) }}">
    
    <meta name="base_url" content="{{ URL::to('/') }}"> <!-- Linea para obtener la url root de la app -->
    <meta name="asset_url" content="{{ URL::asset("/img/icons/") }}"> <!-- Linea para obtener la url root de la app -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous"> -->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    
    <!-- App js -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scripts -->
    <!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.js"></script>
    <script src="https://use.fontawesome.com/068a66244d.js"></script> -->

    <!-- JS y CSS para select con busqueda customizable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha512-hgoywpb1bcTi1B5kKwogCTG4cvTzDmFCJZWjit4ZimDIgXu7Dwsreq8GOQjKVUxFwxCWkLcJN5EN0W0aOngs4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha512-nATinx3+kN7dKuXEB0XLIpTd7j8QahdyJjE24jTJf4HASidUCFFN/TkSVn3CifGmWwfC2mO/VmFQ6hRn2IcAwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css')."?v=2.1"  }}" rel="stylesheet">
    <link href="{{ asset('css/myappstyle.css')."?v=2.1" }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
    <link href="{{ asset('css/materialize.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')."?v=2.1"}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>
<body>
    <div class="wrapper">
        <div class="topbar-white">
            <div class="row center">
                <div class="col s6 flex">
                    <img src="{{ asset('img/logoprep2.png') }}" class="logo" alt="" >
                </div>
                <div class="col s6 vcenter fh righttop">
                    <a href="" class="dropdown-trigger rightbtn " data-target='dropdown1'><b>Administrador de [{{ Auth::guard('tenantadmin')->user()->tenant->tenant_nombre }}],</b> {{ Auth::guard('tenantadmin')->user()->name }}
                        <i class="material-icons">arrow_drop_down</i>
                    </a>
                    
                    <ul id='dropdown1' class='dropdown-content'>
                        <li><a href="{{ route('tenantadmin.logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i>Cerrar sesión</a>
                        </li>
                            <form id="logout-form" action="{{ route('tenantadmin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                      </ul>
                </div>
            </div>
        </div>
        <div class="dashboard-home">
            <div class="small">
                <p>.</p>
            </div>
            <div class="dashboard-wrapper">
                <div class="sidebar">
                    <div class="side-menu">
                        <a href="{{ route('tenantadmin.home') }}" class="side-btn {{ session('menunav') == "inicio" ? 'active' : ''}}">
                            <i class="material-icons">home</i>
                            <p>Inicio</p>
                        </a>
                        <a href="{{ route('tenantadmin.medicos') }}" class="side-btn {{ session('menunav') == "medicos" ? 'active' : ''}}">
                            <i class="material-icons">group</i>
                            <p>Médicos</p>
                        </a>
                    </div>
                    <div class="sidefooter">
                        <hr>
                        <a href="{{ route('tenantadmin.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('tenantadmin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <main>
                    <div class="section box">
                        <div class="content">
                            @yield('content')
                        </div>
                        <div class="footer">
                            <p>Expediente clínico electrónico</p>
                            <p>©Software desarrollado por CENICIS - LANTI</p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script-->
</body>

<script type="text/javascript">
    //LUIS
    document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.tooltipped');
            var options = {};
            var instances = M.Tooltip.init(elems, options);
        });
    var elems = null;
    document.addEventListener('DOMContentLoaded', function() {
        elems = document.querySelectorAll('.collapsible');
        var options = {};
        var instances = M.Collapsible.init(elems, options);

    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems);
    });
    this.checkForScroll();

    $(window).resize(function() {
        if($(window).width() <= 960) {
            elems.forEach((elmnt, i) => {
            });
        }

        this.checkForScroll()
    });
    
    $( "#downbtn" ).click(function() {
        $(".scroll-section")[0].scrollTo({top: 100, left: 0, behavior: 'smooth'});
    });

    function checkForScroll() {
        var header = $(".scroll-part");
        var scrollSection = $(".scroll-section");
        var downarrow = $(".scroll-part");
        var scrollElements = $(".scroll-elements");

        if ( Math.round($(header).prop('scrollHeight')) > Math.round($(scrollSection).height())) {
           header.addClass("unscrolled");
           scrollElements.addClass("show-element");
           scrollElements.removeClass("hide-element");
        }
        else {
           scrollElements.removeClass("show-element");
           scrollElements.addClass("hide-element");
        }

       $(".scroll-section").scroll(function() {
            var scroll = $(this).scrollTop();
            if (scroll >= 1) {
                scrollElements.addClass("hide-element");
            } else {
                scrollElements.removeClass("hide-element");
            }
       });

    }

    //CESAR - YOC
    var url = $('meta[name="base_url"]').attr('content');    
</script>
</html>
