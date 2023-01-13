@extends('layouts.tenantadminapp')

@section('content')
    <h5 class="section-title title">Bienvenido</h5>

    <hr style="opacity: 0.2"> <br>

    <div class="scroll-section">
        <div class="scroll-part">
            <div class="row">
                <div class="col s12 m12 l8">
                    <div class="own-card">
                        <h5 class="title nomarginall">Sistema de Administración para el tenant: <b>{{ Auth::guard('tenantadmin')->user()->tenant->tenant_nombre }}</b></h5> <br>
                        <p>Esta plataforma tiene la finalidad de proporcionar la funcionalidad necesaria para administrar las cuentas de usuario del personal médico del tenant <b>{{ Auth::guard('tenantadmin')->user()->tenant->tenant_nombre }}</b>. </p>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="own-card">
                        <div class="info-card">
                            <div class="info-text">
                                <p class="info-text">Médicos</p>
                                <div class="icon-info">
                                    <a class="center" style="color: white; display: blockh;"
                                    href="{{ route('tenantadmin.medicos') }}">
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
                                        <p>Médicos registrados</p>
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
                            <a href="{{ route('tenantadmin.medicos') }}" class="main-link">
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">apartment</i>
                                        <p>Médicos</p>
                                    </div>
                                    <div class="right-element">
                                        <p>Los datos de cada médico son registrados en esta sección. Los cuales registran, acualizan y manejan pacientes y consultas en el ECE.</p>
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
                url: url + "/tenantadmin/medicosCheck",
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
