<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ url(asset('img/applogo.png')) }}">
        
        <!-- Material -->
        <link href="{{ asset('css/materialize.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    </head>
    <body class="login-bg fh">
        <div class="box fh">
            <div class="row fh rowmaster">
                <div class="col s12 m6 fh center left-panel">
                    <div class="login-logo">
                        <img src="{{ asset('img/logoprep2.png') }}">
                    </div>
                </div>
                <div class="col s12 m6 fh card-padding modal-cont">
                    <div class="white-card fh center modal-middle">
                        <div class="login-content">
                            <div class="row">
                                <h5 class="bold title">Recuperar contraseña</h5>
                                <p>Ingresa el correo electrónico para recuperar tu contraseña.</p>
                            </div>
                            
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <div class="form">
                                            <div class="input">
                                                <input id="email" type="email" name="email" value="{{ old('email') }}"  placeholder="Correo Electrónico" autofocus >
                                                @error('email')
                                                    <span class="helper-text show">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="submit center">
                                        <button type="submit" class="waves-effect waves-light btn">Enviar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="submit center">
                                    <a href="{{ route('welcome') }}" class="">Volver a sitio web</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        @if ($message = session('status'))
            <script> 
                M.toast({html: '{{$message}}'  , classes: 'rounded green', displayLength: 5000}); 
            </script>
        @endif
    </body>
</html>