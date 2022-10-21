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
                            <h5 class="bold title">Selecciona tu Clínica u Hospital</h5>
                        </div>
                        <form method="POST" action="{{ route('setTenant') }}">
                            @csrf
                            <div class="row">
                                <div class="col s12">
                                    <div class="form">
                                        <div class="input">
                                            <select name="company" id="companies" style="display: block !important">
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="submit center">
                                    <button type="submit" class="waves-effect waves-light btn">Seleccionar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal small-modal">
        <div class="modal-content">
            <div class="row no-mar">
                <h5>Recuperar contraseña</h5>
                <p>Ingresa el correo electrónico para recuperar tu contraseña.</p>
                <div class="input">
                    <input class="no-pad" type="email" placeholder="Ingresa tu correo electrónico">
                </div>
            </div>
        </div>
        <div class="modal-footer center">
        <a href="#!" class="modal-close waves-effect waves-green btn">Enviar</a>
        <a style="margin-left: 1rem" href="#!" class="modal-close waves-effect btn red darken-1">Cancelar</a>
        </div>
    </div>
    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
        });
    </script>

</body>
</html>
