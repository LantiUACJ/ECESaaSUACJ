@extends('layouts.eceadminapp')

@section('content')
    <h5 class="section-title title">Bienvenido</h5>

    <hr style="opacity: 0.2"> <br>

    <div class="scroll-section">
        <div class="scroll-part">
            <div class="row">
                <div class="col s12 m12 l8">
                    <div class="own-card">
                        <h5 class="title nomarginall">Sistema de Administración del Expediente Clínico Electrónico</h5> <br>
                        <p>Esta plataforma tiene la finalidad de proporcionar la funcionalidad necesaria para administrar los tenants del ECESAAS y sus administradores. </p>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="own-card">
                        <div class="info-card">
                            <div class="info-text">
                                <p class="info-text">Tenants</p>
                                <div class="icon-info">
                                    <a class="center" style="color: white; display: blockh;"
                                    href="{{ route('eceadmin.tenants') }}">
                                        <i class="material-icons">arrow_forward</i>
                                    </a>
                                </div>
                            </div>
                            <div class="info-number-container">
                                <div class="explain-element" style = "margin-top: 10px;">
                                    <div class="left-element">
                                        <p class="info-number" id="notificationBadge">0</p>
                                    </div>
                                    <div class="right-element center">
                                        <p>Tenants registrados</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12">
                    <div class="own-card large-card">
                        <h5 class="title nomarginall">Secciones</h5>
                        <hr style="opacity:0">
                        <div class="explain" style="display: block">
                            <a href="{{ route('eceadmin.tenants') }}" class="main-link">
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">apartment</i>
                                        <p>Tenants</p>
                                    </div>
                                    <div class="right-element">
                                        <p>Los datos de cada tenant son registrados en esta sección. Además, permite el manejo de los usuarios de tipo administrador de cada tenant.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row scroll-elements">
        <div class="col s12">
            <div class="scroll-down">
                <i id="downbtn" class="material-icons">arrow_drop_down_circle</i>
                <div class="drop-shadow"></div>
            </div>
        </div>
    </div>
    <script>
        var url = $('meta[name="base_url"]').attr('content');
        window.addEventListener("load", initnotifications(), false);

        function initnotifications(){
            findNotifications();
        }

        function findNotifications(){

            let something = "something";

            $.ajax({
                url: url + "/eceadmin/tenantsCheck",
                type: "POST",
                data: {
                    something: something
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    window.scrollTo(0, 0);
                    /*Existen records*/
                    $("#notificationBadge").empty();
                    $("#notificationBadge").text(data);
                },
                error: function(response){
                    window.scrollTo(0, 0);
                    /*No Existen records*/
                },
            });
        }
    </script>
@endsection
