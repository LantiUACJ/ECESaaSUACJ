@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mainhome col-md-12 text-center">
        <h5>Consultar los Expedientes Clínicos Electrónicos</h5>
        <div class="card text-center">
            <div class="card-header">
                    ECE Basico
                <!--
                <ul class="nav nav-tabs card-header-tabs" id="mySecTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link tabtitle active" id="completo-tab" data-bs-toggle="tab" data-bs-target="#completo" type="button" role="tab" aria-controls="completo" aria-selected="false">
                            <span class="icon my-auto"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                            <span class="my-auto">Completo</span>
                        </a>
                    </li>
                    
                </ul>
                -->
            </div>
            <div class="card-body text-center">
                <div class="col-md-3 mx-auto">
                    <label for="patientcurpbasico">Introduce la curp del paciente:</label>
                    <input class="form-control form-control-sm" type="text" id="patientcurpbasico" name="patientcurpbasico" value="">
                </div>
                <br>
                <button class="btn btn-sm btn-success" type="button" onclick="patientconsultbasic()">Consultar ECE</button>
                <br><br>
                <div id="ece-content">
                    <iframe id="iframecontentbasico" src="" type="text/html" frameborder="0"></iframe>
                </div>
                <!--
                <div class="tab-content" id="mySecTabContent">
                    <div class="tab-pane fade show active" id="completo" role="tabpanel" aria-labelledby="cp-tab">
                        <div class="col-md-3 mx-auto">
                            <label for="patientcurp">Introduce la curp del paciente:</label>
                            <input class="form-control form-control-sm" type="text" id="patientcurp" name="patientcurp" value="">
                        </div>
                        <div class="col-md-3 mx-auto">
                            <label for="patientcode">Introduce código del paciente:</label>
                            <input class="form-control form-control-sm" type="text" id="patientcode" name="patientcode" value="">
                        </div>
                        <br>
                        <button class="btn btn-sm btn-success" type="button" onclick="patientconsult()">Consultar ECE</button>
                        <br><br>
                        <div id="ece-content">
                            <iframe id="iframecontent" src="" type="text/html" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                --> 
            </div>
        </div>
    </div>
</div>

@endsection