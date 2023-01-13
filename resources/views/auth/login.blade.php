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
                            <h5 class="bold title">¡Bienvenido!</h5>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col s12">
                                    <div class="form">
                                        @if ($errors->has('email') || $errors->has('password'))
                                            @foreach ($errors->get('email') as $error)
                                                <span class="helper-text show">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                        <br><br>
                                        <div class="input">
                                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" autofocus required>
                                        </div>
                                        <div class="input">
                                            <input id="password" type="password"  name="password" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                    <div class="bottom-form">
                                        <a href="{{ route('password.request') }}" class="forgot-text right modal-trigger">Olvidé mi contraseña</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="submit center">
                                    <button type="submit" class="waves-effect waves-light btn">Iniciar sesión</button>
                                    
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

    <!-- Modal Structure -->
    <div id="modal1" class="modal small-modal">
        <div class="modal-content">
            <div class="row no-mar">
                <h5>Reestablecer contraseña</h5>
                <p>Ingresa el correo electrónico para recuperar tu contraseña.</p>
                <div class="input">
                    <input class="no-pad" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Ingresa tu correo electrónico">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer center">
            <button type="submit" class="modal-close waves-effect waves-green btn">Enviar</button>
            <a style="margin-left: 1rem" href="#!" class="modal-close waves-effect btn red darken-1">Cancelar</a>
        </div>
    </div>
    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    @php
        $error = Session::pull('errorMsg');
    @endphp
    @if($error)
        <script> 
            M.toast({html: '<b>{{ $error }}</b>' , classes: 'rounded red', displayLength: 5000}); 
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
        });
    </script>

</body>
</html>