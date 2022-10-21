<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="icon" href="{{ url(asset('img/applogo.png')) }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
</head>
<body>
    <div class="about-wrapper">
        <div class="row">
            <div class="topbar">
                <div class="row wrapper-max">
                    <div class="col s6 flex">
                        <img src="{{ asset('img/logoprep2.png') }}" class="logo" alt="">
                    </div>
                    <div class="col s6 vcenter righttop">
                        <a href="{{ route('welcome') }}" class="rightbtn">Inicio</a>
                        <a href="{{ route('login') }}" class="rightbtn">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row box-row">
            <div class="col s12">
                <h3>Conócenos</h3>
            </div>
        </div>
        <div class="row box-row">
            <div class="col s6">
                <img src="{{ asset('img/medicalimg.jpg') }}" style="width: 100%; border-radius: 1rem;" alt="">
            </div>
            <div class="col s6">
                <h5>¿Qué es el Expediente Clínico Electrónico?</h5><br>
                <p>Plataforma para médicos e instituciones de salud que les permite administrar de forma segura, fácil y eficiente la información clínica de sus pacientes. Tomando como referencia las Normas Oficiales Mexicanas NOM-004-SSA3-2012 - Del expediente clínico, la NOM-024-SSA3-2012 - Sistemas de Información de Registro Electrónico para la Salud. Intercambio de Información en Salud y la GIIS-B015-03-02 Guía y Formatos para el Intercambio de Información en Salud Referente al Reporte de Información al Subsistema de Prestación de Servicios "SIS" - Consulta Externa.</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12" style="padding: 0px; margin-top: 4rem; margin-bottom: 4rem;">
                <div class="stats">
                    <p>Una plataforma diseñada para digitalizar la información clínica <br> del paciente, obtenida en la atención médica en México.</p>
                </div>
            </div>
        </div>
        <div class="row box-row">
            
            <div class="col s12 text-center" style="padding-bottom: 4rem">
                <h4>Contáctanos</h4>
                <p>Para más información, envíanos un correo a <a href="mailto: cenicis@uacj.mx"> cenicis@uacj.mx</a></p>
            </div>
            <!--<div class="col s12 ">
                <div class="">
                    <form class="col s12">
                      <div class="row">
                        <div class="input-field col s6">
                          <input id="nombre" type="text" class="validate">
                          <label for="nombre">Tu nombre</label>
                        </div>
                        <div class="input-field col s6">
                          <input id="lainstitutionst_name" type="text" class="validate">
                          <label for="institution">Institución</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="email" type="email" class="validate">
                          <label for="email">Correo electrónico</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 text-center">
                            <button class="waves-effect waves-light btn">Envíar</button>
                        </div>
                      </div>
                    </form>
                  </div>
            </div>-->
        </div>

        <div class="row">
            <div class="parallax-container">
                <div class="parallax"><img src="{{ asset('img/medicaltwo.jpg') }}">
                <h1 class="text-inpara">Acercando la tecnología a la medicina en México</h1></div>
              </div>
        </div>

        <div class="row box-row" style="padding-top: 5rem; padding-bottom: 5rem;">
            <div class="col s12">
               <div class="row">
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
        <div class="row clasfooter">
            <div class="col s12 center">
                <i class="material-icons">copyright</i> Software desarrollado por CENICIS - LANTI 
            </div>
        </div>

    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.parallax');
    var instances = M.Parallax.init(elems);
  });
    </script>
</body>
</html>