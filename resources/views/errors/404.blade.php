<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/materialize.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <link rel="icon" href="{{ url('img/applogo.png') }}">
</head>
<body class="unscroll">
    <div class="wrapper landing-section login-bg">
        <div class="topbar">
            <div class="row wrapper-max">
                <div class="col s6 flex">
                    <img src="{{ asset('img/logoprep2.png') }}" class="logo" alt="">
                </div>
                <div class="col s6 vcenter righttop">
                    @if(Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/home') }}" class="rightbtn">Home</a>
                            @else
                                <a href="{{ route('about') }}" class="rightbtn">Conócenos</a>
                                <a href="{{ route('login') }}" class="rightbtn">Iniciar sesión</a>

                               <!-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="rightbtn">Registrarse</a>
                                @endif-->
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="main-content content">
            <div class="box fullbox fh">
                <div class="row fh">
                    <div class="col s12 m12 nomargin">
                        <div class="text-content text-center">
                            <div class="text-center" style="margin-top: 20px">
                                <p style="font-size: 130px"><b>404</b></p>
                                <p style="font-size: 50px">La página no fue encontrada</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cirle-one"></div>
            </div>
            <div class="relative logos-bar">
                <div class="logos-bar-content">
                    <div class="box fullbox">
                        <div class="row nomarginall">
                            <div class="col s6 m3 nopad img-logo-cont">
                                <img class="logo-img" src="{{ asset('img/concayt.png') }}">
                            </div>
                            <div class="col s6 m3 nopad img-logo-cont">
                                <img class="logo-img" src="{{ asset('img/cenicis.png') }}">
                            </div>
                            <div class="col s6 m3 nopad img-logo-cont">
                                <img class="logo-img" src="{{ asset('img/lanti.png') }}">
                            </div>
                            <div class="col s6 m3 nopad img-logo-cont">
                                <img class="logo-img" src="{{ asset('img/uacj.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>
</body>
</html>