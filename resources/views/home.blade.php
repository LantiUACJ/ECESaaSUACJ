@extends('layouts.app')
<!-- testapp for consulta test -->

@section('content')
        <h5 class="section-title title">Bienvenido</h5>

        <hr style="opacity: 0.2"> <br>

        <div class="scroll-section">
            <div class="scroll-part">
                <div class="row">
                    <div class="col s12 m12 l8">
                        <div class="own-card">
                            <h5 class="title nomarginall">Expediente Clínico Electrónico</h5> <br>
                            <p>Plataforma para médicos e instituciones de salud que les permite administrar de forma segura, fácil y eficiente la información clínica de sus pacientes. Tomando como referencia las Normas Oficiales Mexicanas <b>NOM-004-SSA3-2012 </b>- Del expediente clínico, la <b>NOM-024-SSA3-2012</b> - Sistemas de Información de Registro Electrónico para la Salud. Intercambio de Información en Salud y la <b>GIIS-B015-03-02</b> Guía y Formatos para el Intercambio de Información en Salud Referente al Reporte de Información al Subsistema de Prestación de Servicios "SIS" - Consulta Externa.</p>
                        </div>
                    </div>
                    <div class="col s12 m12 l4">
                        <div class="own-card">
                            <div class="info-card">
                                <div class="info-text">
                                    <p class="info-text">Consultas</p>
                                    <div class="icon-info">
                                        <a class="center" style="color: white; display: blockh;"
                                        href="{{ route('consultamedico') }}">
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
                                            <p>Consultas sin terminar</p>
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
                            <div class="explain">
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">face</i>
                                        <p>Pacientes</p>
                                    </div>
                                    <div class="right-element">
                                        <a href="{{ route('pacientes.index') }}">
                                            <p>Los datos generales del paciente son registrados en esta sección. Es indispensable registrar primero al paciente para poder realizar una consulta.</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">local_hospital</i>
                                        <p>Consultas</p>
                                    </div>
                                    <div class="right-element">
                                        <a href="{{ route('consultamedico') }}">
                                            <p>Los datos recabados por el médico al momento de realizar la consulta son registrados en esta sección.</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">share</i>
                                        <p>MISECE</p>
                                    </div>
                                    <div class="right-element">
                                        <a href="{{ route('misece') }}">
                                            <p>Plataforma que permite consultar el expediente clínico electrónico del paciente sin importar en donde se encuentre almacenado.</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">group</i>
                                        <p>Catálogos</p>
                                    </div>
                                    <div class="right-element">
                                        <p>Sección que contiene la información de los catálogos indicados en la GIIS-B015-03-02.</p>
                                    </div>
                                </div>
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">group</i>
                                        <p>Sexos</p>
                                    </div>
                                    <div class="right-element">
                                        <a href="{{ route('sexos.index') }}">
                                        <p>Sexo del paciente, es decir la condición biológica y fisiológica de nacimiento. Esta opción se encuentra dentro de la Sección "Catálogos" del menú.</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="explain-element">
                                    <div class="left-element">
                                        <i class="material-icons">group</i>
                                        <p>Géneros</p>
                                    </div>
                                    <div class="right-element">
                                        <a href="{{ route('generos.index') }}">
                                        <p>Identidad de género del paciente o atributos sociales aprendidos o adoptados por la persona. Esta opción se encuentra dentro de la Sección "Catálogos" del menú.</p>
                                        </a>
                                    </div>
                                </div>
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
@endsection
