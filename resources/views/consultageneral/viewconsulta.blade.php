@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="navigation">
            <ul class="nav nav-tabs navul" id="myTab" role="tablist">
                <li class="brandli">
                    <img class="appimg" src="{{ asset('img/leonardo.jpg') }}" alt="">
                    <span class="maintitle"><h5 class="brandtitle">{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</h5></span>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" data-toggle="tooltip" data-placement="right" title="Nota de Consulta">
                    <a class="nav-link active" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#consulta" type="button" role="tab" aria-controls="consulta" aria-selected="true">
                        <span class="icon my-auto"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                        <span class="title my-auto">Nota de Consulta</span>
                    </a>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" onclick="explodisabled()" data-toggle="tooltip" data-placement="right" title="Exploración Física">
                    <a class="nav-link {{ $consulta->exploracion_id == null? "disabled": "" }}" id="exploracion-tab" data-bs-toggle="tab" data-bs-target="#exploracion" type="button" role="tab" aria-controls="exploracion" aria-selected="false">
                        <span class="icon my-auto"><i class="fa fa-sticky-note" aria-hidden="true"></i></span>
                        <span class="title my-auto">Exploración Física</span>
                    </a>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" onclick="interdisabled()" data-toggle="tooltip" data-placement="right" title="Interrogatorio">
                    <a class="nav-link {{ $inter == null? "disabled": "" }}" id="interrogatorio-tab" data-bs-toggle="tab" data-bs-target="#interrogatorio" type="button" role="tab" aria-controls="interrogatorio" aria-selected="false">
                        <span class="icon my-auto"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <span class="title my-auto">Interrogatorio</span>
                    </a>
                </li>
                <hr class="specialhr">
            </ul>
        </div>
    </div>

    <input type="hidden" id="interavailable" value="{{ $consulta->interrogatorio_id !== null ? 1: 0 }}">
    <input type="hidden" id="exploavailable" value="{{ $consulta->exploracion_id !== null ? 1: 0 }}">

    <div class="main col-md-12">
        <div class="tab-content" id="myTabContent">

            <!--------- --------->
            <!-- Messages Area -->
            <!--------- --------->

            <!--------- Consulta Success --------->
            <div class="modal modal-position" id="consultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-success">
                        <div class="modal-body text-center text-white">
                            <span id="consultamsg"></span>
                            <br>
                            <br>
                            Las pestañas de interrogatorio y Exploracion Fisica han sido desbloqueadas!!
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- Errors --------->
            <div class="modal modal-position" id="errormodal" tabindex="-1" role="dialog" aria-labelledby="ErrorModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-danger">
                        <div class="modal-body text-center text-white">
                            <span id="errormsg"></span>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-position" id="intermodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-success">
                        <div class="modal-body text-center text-white">
                            <span id="intermsg"></span>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-position" id="explomodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-success">
                        <div class="modal-body text-center text-white">
                            <span id="explomsg"></span>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- Consulta Terminada --------->
            <div class="modal modal-position" id="terminarmodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-warning">
                        <div class="modal-body text-center text-black">
                            Asegúrate que todos los cambioes esten guardados.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('terminarConsulta') }}" role="button" class="btn btn-danger mx-auto" >Terminar Consulta</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- No Consulta --------->
            <div class="modal modal-position" id="noConsultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-danger">
                        <div class="modal-body text-center text-white">
                            La consulta no ha sido guardada!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!----------- ----------->
            <!-- End Messages Area -->
            <!----------- ----------->

            <!-- Inputs para ajax -->

            <!-- Id del paciente -->
            <input type="hidden" id="pac_id" name="pac_id" value="{{ $paciente->id }}">

            <!-- Id de la consulta -->
            <input type="hidden" id="consulta_id" value="{{ session('consulta_id') !== null? session('consulta_id'): "" }}">
            

            <!-- Id del medico (probablemente inecesario ya que podria obtenerse de auth o user) -->
            <input type="hidden" id="medico_id" value="{{ auth()->user()->id }}">

            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <label>{{ __('CURP') }}:</label>
                            <br>
                            <input class="pacinput" id="curp" type="text" value="{{ $paciente->curp }}" autocomplete="curp" maxlength="255" disabled autofocus>
                        </div>
                        <div class="col-md-4">
                            <label>{{ __('Nombre(s)') }}:</label>
                            <br>
                            <input class="pacinput" id="nombre" type="text" 
                            value="{{ $paciente->nombre }}" 
                            autocomplete="nombre" maxlength="255" disabled autofocus>
                        </div>
                        <div class="col-md-4">
                            <label>{{ __('Apellido(s)') }}:</label>
                            <br>
                            <input class="pacinput" id="apellido" type="text"  value="{{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}" autocomplete="apellido" maxlength="255" disabled autofocus>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <label>{{ __('Fecha de Nac') }}: </label>
                            <br>
                            <input class="pacinput" id="fechanac" type="text"  value="{{ $paciente->fechaNacimiento }}" autocomplete="fechanac" maxlength="255" disabled autofocus>
                        </div>
                        <div class="col-md-4">
                            <label>{{ __('Edad') }}:</label>
                            <br>
                            <input class="pacinput" id="edad" type="text" value="{{ $age }}" 
                            autocomplete="edad" maxlength="255" disabled autofocus>
                        </div>
                        <div class="col-md-4">
                            <label>{{ __('Sexo') }}:</label>
                            <br>
                            @foreach ($sexos as $sexo)
                                @if ($paciente->sexo_id == $sexo->id)
                                    <input class="pacinput" id="sexo" type="text"  value="{{ $sexo->descripcion }}" 
                                    autocomplete="sexo" maxlength="255" disabled autofocus>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <!------ ------->
            <!-- TAB de Nota de Consulta -->
            <!------ ------->

            <div class="tab-pane fade show active" id="consulta" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="card-header">
                        Nota de la consulta
                    </div>
                    <div class="card-body">
                        <form method="POST" id="storeconsulta">
                            @csrf

                            <div class="form-group row text-center">
                                <div class="col-md-4">
                                    <label for="motivo" class="col-md-12 col-form-label">{{ __('Motivo de la Consulta') }}:</label>
    
                                    <div class="col-md-12">
                                        <textarea name="motivo" id="motivo" cols="30" rows="4" 
                                        class="form-control @error('motivo') is-invalid @enderror"
                                        value="" autocomplete="motivo" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus disabled>{{ $consulta->motivoConsulta }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-motivo" role="alert">
                                            <strong>El campo Motivo de Consulta es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="cuadro" class="col-md-12 col-form-label">{{ __('Cuadro Clínico') }}:</label>
    
                                    <div class="col-md-12">
                                        <textarea name="cuadro" id="cuadro" cols="30" rows="4" 
                                        class="form-control @error('cuadro') is-invalid @enderror"
                                        value="" autocomplete="cuadro" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus disabled>{{ $consulta->cuadroClinico }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-cuadro" role="alert">
                                            <strong>El campo Cuadro Clinico es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="resultados" class="col-md-12 col-form-label">{{ __('Resultados de Laboratorio y Gabinete') }}:</label>
    
                                    <div class="col-md-12 text-center">
                                        <textarea name="resultados" id="resultados" cols="30" rows="4" 
                                        class="form-control @error('resultados') is-invalid @enderror"
                                        value="" autocomplete="resultados" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus disabled>{{ $consulta->resultadosLaboratorioGabinete }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-resultados" role="alert">
                                            <strong>El campo Resultados de Laboratorio es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <div class="col-md-4">
                                    <label for="diagnostico" class="col-md-12 col-form-label">{{ __('Diagnósticos o Problemas Clínicos') }}:</label>
    
                                    <div class="col-md-12">
                                        <textarea name="diagnostico" id="diagnostico" cols="30" rows="4" 
                                        class="form-control @error('diagnostico') is-invalid @enderror"
                                        value="" autocomplete="diagnostico" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus disabled>{{ $consulta->diagnosticoProblemasClinicos }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-diagnostico" role="alert">
                                            <strong>El campo Diagnósticos o problemas Clínicos es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="pronostico" class="col-md-12 col-form-label">{{ __('Pronóstico') }}:</label>
    
                                    <div class="col-md-12">
                                        <textarea name="pronostico" id="pronostico" cols="30" rows="4" 
                                        class="form-control @error('pronostico') is-invalid @enderror"
                                        value="" autocomplete="pronostico" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus disabled>{{ $consulta->pronostico }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-pronostico" role="alert">
                                            <strong>El campo Pronóstico es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="indicacion" class="col-md-12 col-form-label">{{ __('Indicación Terapéutica') }}:</label>
    
                                    <div class="col-md-12">
                                        <textarea name="indicacion" id="indicacion" cols="30" rows="4" 
                                        class="form-control @error('indicacion') is-invalid @enderror"
                                        value="" autocomplete="indicacion" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus disabled>{{ $consulta->indicacionTerapeutica }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-indicacion" role="alert">
                                            <strong>El campo Indicación Terapéutica es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
            
            <!------ ------->
            <!-- TAB de Interrogatorios -->
            <!------ ------->

            <div class="tab-pane fade" id="interrogatorio" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="mySecTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tabtitle active" id="antehf-tab" data-bs-toggle="tab" data-bs-target="#antehf" type="button" role="tab" aria-controls="antehf" aria-selected="false">
                                    <span class="icon my-auto"><i class="bi bi-question-octagon-fill"></i></span>
                                    <span class="my-auto">Antecedentes Heredo - Familiares</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="antepp-tab" data-bs-toggle="tab" data-bs-target="#antepp" type="button" role="tab" aria-controls="v" aria-selected="false">
                                    <span class="icon my-auto"><i class="bi bi-question-octagon-fill"></i></span>
                                    <span class="my-auto">Antecedentes Personales Patológicos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="antepnp-tab" data-bs-toggle="tab" data-bs-target="#antepnp" type="button" role="tab" aria-controls="antepnp" aria-selected="false">
                                    <span class="icon my-auto"><i class="bi bi-question-octagon-fill"></i></i></span>
                                    <span class="my-auto">Antecedentes Personales No Patologios</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="anteas-tab" data-bs-toggle="tab" data-bs-target="#anteas" type="button" role="tab" aria-controls="anteas" aria-selected="false">
                                    <span class="icon my-auto"><i class="bi bi-question-octagon-fill"></i></i></span>
                                    <span class="my-auto">Aparatos y Sistemas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="mySecTabContent">

                            <div class="tab-pane fade show active" id="antehf" role="tabpanel" aria-labelledby="hf-tab">
                                
                                <form method="POST" id="storeantehf">

                                    <div class="form-group row">
                                        <div class="form-check col-md-6 row">
                                            <div class="col-md-12 row">
                                                <label for="grupo" class="col-form-label text-md-right offset-md-1">{{ __('Grupo Étnico') }}:</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="browser-default custom-select" id="grupo"
                                                    class="form-control @error('grupo') is-invalid @enderror browser-default custom-select" 
                                                    name="grupo" disabled>
                                                        @if ($grupos->count() == 0)
                                                            <option value="0" selected>--- No se encontraron Grupos Étnicos ---</option>
                                                        @endif
                                                        @if ($inter !== null)
                                                            @foreach ($grupos as $grupo)
                                                                @if ($inter->grupo_id == $grupo->catalogKey)
                                                                    <option value="{{ $grupo->CATALOG_KEY }}" selected>{{ $grupo->lenguaIndigena }}</option>
                                                                @else
                                                                    <option value="{{ $grupo->CATALOG_KEY }}" {{ old('grupo') == $grupo->CATALOG_KEY ? 'selected': '' }}>{{ $grupo->lenguaIndigena }}</option>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <option value="0" selected>--- No se encontraron Grupos Étnicos ---</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback error-msg" id="error-grupo" role="alert">
                                                <strong>El campo Grupo Étnico es Obligatorio</strong>
                                            </span>
                                        </div>
                                    </div>

                                    <!--
                                    <div class="form-group row">
                                        <label for="padecimiento" class="col-md-4 col-form-label text-md-right offset-md-1">{{ __('Padecimiento Actual') }}:</label>
            
                                        <div class="col-md-5">
                                            <input id="padecimiento" type="text"
                                            class="form-control @error('padecimiento') is-invalid @enderror" name="padecimiento"
                                            value="{{ $inter->padecimientoActual }}" autocomplete="padecimiento" maxlength="255" 
                                            disabled onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>
        
                                            <span class="invalid-feedback error-msg" id="error-padecimiento" role="alert">
                                                <strong>El campo Padecimiento Actual es Obligatorio</strong>
                                            </span>
                                        </div>
                                    </div>
                                    -->

                                    <div class="form-group row">
                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="diabetes" type="checkbox"
                                                class="form-control" name="diabetes"
                                                value="diabetes" disabled {{ $anteHF->diabetes == 1? "checked": "" }} autofocus>
                                                <label for="diabetes" class="col-form-label">{{ __('Diabetes') }}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="checkinput" id="neoplasias" type="checkbox"
                                                class="form-control @error('neoplasias') is-invalid @enderror" name="neoplasias"
                                                value="neoplasias" disabled {{ $anteHF->neoplasias == 1? "checked": "" }} autofocus>
                                                <label for="neoplasias" class=" col-form-label">{{ __('Neoplasias') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="cardiopatias" type="checkbox"
                                                class="form-control @error('cardiopatias') is-invalid @enderror" name="cardiopatias"
                                                value="cardiopatias" disabled {{ $anteHF->cardiopatias == 1? "checked": "" }} autofocus>
                                                <label for="cardiopatias" class=" col-form-label">{{ __('Cardiopatías') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="parkinson" type="checkbox"
                                                class="form-control @error('parkinson') is-invalid @enderror" name="parkinson"
                                                value="parkinson" disabled {{ $anteHF->parkinson == 1? "checked": "" }} autofocus>
                                                <label for="parkinson" class=" col-form-label">{{ __('Parkinson') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="depresion" type="checkbox"
                                                class="form-control @error('depresion') is-invalid @enderror" name="depresion"
                                                value="depresion" disabled {{ $anteHF->depresion == 1? "checked": "" }} autofocus>
                                                <label for="depresion" class=" col-form-label">{{ __('Depresión') }}:</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="colestasis" type="checkbox"
                                                class="form-control @error('colestasis') is-invalid @enderror" name="colestasis"
                                                value="colestasis" disabled {{ $anteHF->colestasis == 1? "checked": "" }} autofocus>
                                                <label for="colestasis" class=" col-form-label">{{ __('Colestasis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="endocrinas" type="checkbox"
                                                class="form-control @error('endocrinas') is-invalid @enderror" name="endocrinas"
                                                value="endocrinas" disabled {{ $anteHF->enfermedadesEndocrinas == 1? "checked": "" }} autofocus>
                                                <label for="endocrinas" class=" col-form-label">{{ __('Enfermedades Endocrinas') }}</label>
                                            </div>
            
                                        </div>

                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="hipertension" type="checkbox"
                                                class="form-control" name="hipertension"
                                                value="hipertension" disabled {{ $anteHF->hipertension == 1? "checked": "" }} autofocus>
                                                <label for="hipertension" class=" col-form-label ">{{ __('Hipertensión') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="tuberculosis" type="checkbox"
                                                class="form-control @error('tuberculosis') is-invalid @enderror" name="tuberculosis"
                                                value="tuberculosis" disabled {{ $anteHF->tuberculosis == 1? "checked": "" }} autofocus>
                                                <label for="tuberculosis" class=" col-form-label">{{ __('Tuberculosis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="alzheimer" type="checkbox"
                                                class="form-control @error('alzheimer') is-invalid @enderror" name="alzheimer"
                                                value="alzheimer" disabled {{ $anteHF->alzheimer == 1? "checked": "" }} autofocus>
                                                <label for="alzheimer"  class=" col-form-label">{{ __('Alzheimer') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="esclerosis" type="checkbox"
                                                class="form-control @error('esclerosis') is-invalid @enderror" name="esclerosis"
                                                value="esclerosis" disabled {{ $anteHF->esclerosisMultiple == 1? "checked": "" }} autofocus>
                                                <label for="esclerosis"  class=" col-form-label">{{ __('Esclerosis Múltiple') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="esquizofrenia" type="checkbox"
                                                class="form-control @error('esquizofrenia') is-invalid @enderror" name="esquizofrenia"
                                                value="esquizofrenia" disabled {{ $anteHF->esquizofrenia == 1? "checked": "" }} autofocus>
                                                <label for="esquizofrenia" class=" col-form-label">{{ __('Esquizofrenia') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="hepatitis" type="checkbox"
                                                class="form-control @error('hepatitis') is-invalid @enderror" name="hepatitis"
                                                value="hepatitis" disabled {{ $anteHF->hepatitis == 1? "checked": "" }} autofocus>
                                                <label for="hepatitis" class=" col-form-label">{{ __('Hepatitis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="geneticas" type="checkbox"
                                                class="form-control @error('geneticas') is-invalid @enderror" name="geneticas"
                                                value="geneticas" disabled {{ $anteHF->enfermedadesGeneticas == 1? "checked": "" }} autofocus>
                                                <label for="geneticas" class=" col-form-label">{{ __('Enfermedades Genéticas') }}</label>
                                            </div>

                                            
                                        </div>

                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="dislipidemias" type="checkbox"
                                                class="form-control" name="dislipidemias"
                                                value="dislipidemias" disabled {{ $anteHF->dislipidemias == 1? "checked": "" }} autofocus>
                                                <label for="dislipidemias"  class=" col-form-label">{{ __('Dislipidemias') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="artritis" type="checkbox"
                                                class="form-control @error('artritis') is-invalid @enderror" name="artritis"
                                                value="artritis" disabled {{ $anteHF->artritis == 1? "checked": "" }} autofocus>
                                                <label for="artritis" class=" col-form-label">{{ __('Artritis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="epilepsia" type="checkbox"
                                                class="form-control @error('epilepsia') is-invalid @enderror" name="epilepsia"
                                                value="epilepsia" disabled  {{ $anteHF->epilepsia == 1? "checked": "" }} autofocus>
                                                <label for="epilepsia" class=" col-form-label">{{ __('Epilepsia') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="trastorno" type="checkbox"
                                                class="form-control @error('trastorno') is-invalid @enderror" name="trastorno"
                                                value="trastorno" disabled {{ $anteHF->trastornoAnsiedad == 1? "checked": "" }} autofocus>
                                                <label for="trastorno" class=" col-form-label">{{ __('Trastorno de Ansiedad') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="cirrosis" type="checkbox"
                                                class="form-control @error('cirrosis') is-invalid @enderror" name="cirrosis"
                                                value="cirrosis" disabled {{ $anteHF->Cirrosis == 1? "checked": "" }} autofocus>
                                                <label for="cirrosis" class=" col-form-label">{{ __('Cirrosis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="alergias" type="checkbox"
                                                class="form-control @error('alergias') is-invalid @enderror" name="alergias"
                                                value="alergias" disabled {{ $anteHF->alergias == 1? "checked": "" }} autofocus>
                                                <label for="alergias" class=" col-form-label">{{ __('Alergias') }}</label>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-check col-md-6 row">
                                            <div class="col-md-12 row">
                                                <label for="otroshf" class="col-form-label text-md-right offset-md-1">{{ __('Otros') }}:</label>
            
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="otroshf" type="text"
                                                    class="form-control @error('otroshf') is-invalid @enderror" name="otroshf"
                                                    value="{{ $anteHF->otroshf }}" disabled autocomplete="otroshf" maxlength="255" 
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="antepp" role="tabpanel" aria-labelledby="pp-tab">
                                <form method="POST" id="storeantepp">

                                    <div class="form-group row text-center">

                                        <div class="col-md-4">
                                            <label for="infectacontagiosa" class="col-md-12 col-form-label">{{ __('Enfermedad Infecta Contagiosa') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="infectacontagiosa" id="infectacontagiosa" cols="30" rows="3" 
                                                class="form-control @error('infectacontagiosa') is-invalid @enderror"
                                                value="" autocomplete="infectacontagiosa" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->enfermedadInfectaContagiosa }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="cronicodegenerativa" class="col-md-12 col-form-label">{{ __('Enfermedad Crónico Degenerativa') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cronicodegenerativa" id="cronicodegenerativa" cols="30" rows="3" 
                                                class="form-control @error('cronicodegenerativa') is-invalid @enderror"
                                                value="" autocomplete="cronicodegenerativa" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->enfermedadCronicaDegenerativa }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="traumatologicos" class="col-md-12 col-form-label">{{ __('Traumatológicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="traumatologicos" id="traumatologicos" cols="30" rows="3" 
                                                class="form-control @error('traumatologicos') is-invalid @enderror"
                                                value="" autocomplete="traumatologicos" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->traumatologicos }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="alergicos" class="col-md-12 col-form-label">{{ __('Alérgicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="alergicos" id="alergicos" cols="30" rows="3" 
                                                class="form-control @error('alergicos') is-invalid @enderror"
                                                value="" autocomplete="alergicos" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->alergicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="quirurgicos" class="col-md-12 col-form-label">{{ __('Quirúrgicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="quirurgicos" id="quirurgicos" cols="30" rows="3" 
                                                class="form-control @error('quirurgicos') is-invalid @enderror"
                                                value="" autocomplete="quirurgicos" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->quirurgicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="hospitalizaciones" class="col-md-12 col-form-label">{{ __('Hospitalizaciones Previas') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="hospitalizaciones" id="hospitalizaciones" cols="30" rows="3" 
                                                class="form-control @error('hospitalizaciones') is-invalid @enderror"
                                                value="" autocomplete="hospitalizaciones" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->hospitalizacionesPrevias }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="transfusiones" class="col-md-12 col-form-label">{{ __('Transfusiones') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="transfusiones" id="transfusiones" cols="30" rows="3" 
                                                class="form-control @error('transfusiones') is-invalid @enderror"
                                                value="" autocomplete="transfusiones" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->transfusiones }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="toxicomanias" class="col-md-12 col-form-label">{{ __('Toxicomanías') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="toxicomanias" id="toxicomanias" cols="30" rows="3" 
                                                class="form-control @error('toxicomanias') is-invalid @enderror"
                                                value="" autocomplete="toxicomanias" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->toxicomaniasAlcoholismo }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospp" class="col-md-12 col-form-label">{{ __('Otros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="otrospp" id="otrospp" cols="30" rows="3" 
                                                class="form-control @error('otrospp') is-invalid @enderror"
                                                value="" autocomplete="otrospp" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->otros }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
        
                                    <br>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="antepnp" role="tabpanel" aria-labelledby="pnp-tab">
                                <form method="POST" id="storeantepnp">

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="vivienda" class="col-md-12 col-form-label">{{ __('Vivienda') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="vivienda" id="vivienda" cols="30" rows="3" 
                                                class="form-control @error('vivienda') is-invalid @enderror"
                                                value="" autocomplete="vivienda" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->vivienda }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="higiene" class="col-md-12 col-form-label">{{ __('Higiene') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="higiene" id="higiene" cols="30" rows="3" 
                                                class="form-control @error('higiene') is-invalid @enderror"
                                                value="" autocomplete="higiene" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->higiene }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="dieta" class="col-md-12 col-form-label">{{ __('Dieta') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="dieta" id="dieta" cols="30" rows="3" 
                                                class="form-control @error('dieta') is-invalid @enderror"
                                                value="" autocomplete="dieta" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->dieta }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="zoonosis" class="col-md-12 col-form-label">{{ __('Zoonosis') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="zoonosis" id="zoonosis" cols="30" rows="3" 
                                                class="form-control @error('zoonosis') is-invalid @enderror"
                                                value="" autocomplete="zoonosis" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->zoonosis }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospnp" class="col-md-12 col-form-label">{{ __('Otros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="otrospnp" id="otrospnp" cols="30" rows="3" 
                                                class="form-control @error('otrospnp') is-invalid @enderror"
                                                value="" autocomplete="otrospnp" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->otros }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            
                                        </div>
                                        
                                    </div>
        
                                    <br>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="anteas" role="tabpanel" aria-labelledby="as-tab">
                                <form method="POST" id="storeinteras">

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="signos" class="col-md-12 col-form-label">{{ __('Signos y Sintomas') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="signos" id="signos" cols="30" rows="3" 
                                                class="form-control @error('signos') is-invalid @enderror"
                                                value="" autocomplete="signos" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->signosYsintomas }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cardiovascular" class="col-md-12 col-form-label">{{ __('Aparato Cardiovascular') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cardiovascular" id="cardiovascular" cols="30" rows="3" 
                                                class="form-control @error('cardiovascular') is-invalid @enderror"
                                                value="" autocomplete="cardiovascular" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoCardiovascular }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="respiratorio" class="col-md-12 col-form-label">{{ __('Aparato Respiratorio') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="respiratorio" id="respiratorio" cols="30" rows="3" 
                                                class="form-control @error('respiratorio') is-invalid @enderror"
                                                value="" autocomplete="respiratorio" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoRespiratorio }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="digestivo" class="col-md-12 col-form-label">{{ __('Aparato Digestivo') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="digestivo" id="digestivo" cols="30" rows="3" 
                                                class="form-control @error('digestivo') is-invalid @enderror"
                                                value="" autocomplete="digestivo" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoDigestivo }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nefro" class="col-md-12 col-form-label">{{ __('Sistema Nefrourologico') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="nefro" id="nefro" cols="30" rows="3" 
                                                class="form-control @error('nefro') is-invalid @enderror"
                                                value="" autocomplete="nefro" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaNefro }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="endocrino" class="col-md-12 col-form-label">{{ __('Sistema Endocrino y Metabolismo') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="endocrino" id="endocrino" cols="30" rows="3" 
                                                class="form-control @error('endocrino') is-invalid @enderror"
                                                value="" autocomplete="endocrino" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaEndocrino }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="hematopoyetico" class="col-md-12 col-form-label">{{ __('Sistema Hematopoyético') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="hematopoyetico" id="hematopoyetico" cols="30" rows="3" 
                                                class="form-control @error('hematopoyetico') is-invalid @enderror"
                                                value="" autocomplete="hematopoyetico" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaHemato }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nervioso" class="col-md-12 col-form-label">{{ __('Sistema Nervioso') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="nervioso" id="nervioso" cols="30" rows="3" 
                                                class="form-control @error('nervioso') is-invalid @enderror"
                                                value="" autocomplete="nervioso" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaNervioso }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="musculo" class="col-md-12 col-form-label">{{ __('Sistema Musculo Esquelético') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="musculo" id="musculo" cols="30" rows="3" 
                                                class="form-control @error('musculo') is-invalid @enderror"
                                                value="" autocomplete="musculo" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaMusculoEsqueletico }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="piel" class="col-md-12 col-form-label">{{ __('Piel y Tegumentos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="piel" id="piel" cols="30" rows="3" 
                                                class="form-control @error('piel') is-invalid @enderror"
                                                value="" autocomplete="piel" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->pielYtegumentos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="sentidos" class="col-md-12 col-form-label">{{ __('Órganos de los Sentidos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="sentidos" id="sentidos" cols="30" rows="3" 
                                                class="form-control @error('sentidos') is-invalid @enderror"
                                                value="" autocomplete="sentidos" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->organosSentidos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="psiquica" class="col-md-12 col-form-label">{{ __('Esfera Psíquica') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="psiquica" id="psiquica" cols="30" rows="3" 
                                                class="form-control @error('psiquica') is-invalid @enderror"
                                                value="" autocomplete="psiquica" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->esferaPsiquica }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!------ ------->
            <!-- TAB de Exploracion Fisica -->
            <!------ ------->
            
            <div class="tab-pane fade" id="exploracion" role="tabpanel" aria-labelledby="contact-tab">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTerTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tabtitle active" id="datosexplo-tab" data-bs-toggle="tab" data-bs-target="#datosexplo" type="button" role="tab" aria-controls="datosexplo" aria-selected="true">
                                    <span class="icon my-auto"><i class="fa fa-book" aria-hidden="true"></i></span>
                                    <span class="my-auto">Datos de Exploración Física</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="signosvitales-tab" data-bs-toggle="tab" data-bs-target="#signosvitales" type="button" role="tab" aria-controls="signosvitales" aria-selected="false">
                                    <span class="icon my-auto"><i class="fa fa-book" aria-hidden="true"></i></span>
                                    <span class="my-auto">Signos Vitales</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="mySecTabContent">
                            <div class="tab-pane fade show active" id="datosexplo" role="tabpanel" aria-labelledby="datosexplo-tab">
                                <form method="POST" id="storedatosexplo">

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="habitus" class="col-md-12 col-form-label">{{ __('Habitus Exterior') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="habitus" id="habitus" cols="30" rows="3" 
                                                class="form-control @error('habitus') is-invalid @enderror"
                                                value="" autocomplete="habitus" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->habitusExterior }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-habitus" role="alert">
                                                    <strong>El campo Habitus Exterior es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="peso" class="col-md-12 col-form-label">{{ __('Peso') }}:</label>
            
                                            <div class="col-md-12 row">
                                                <div class="col-md-7">
                                                    <input id="price2" type="text" class="form-control @error('peso') is-invalid @enderror"
                                                    name="peso" value="{{ $exploracion->peso }}" autocomplete="peso" maxlength="6"
                                                    title="El Peso es una cantidad númerica." disabled autofocus>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Peso es Obligatorio</strong>
                                                    </span>
                                                    
                                                </div>
                                                <div class="col-md-5 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        kg
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="talla" class="col-md-4 col-form-label">{{ __('Talla') }}:</label>
            
                                            <div class="col-md-12 row">
                                                <div class="col-md-7">
                                                    <input id="talla" type="text" class="form-control @error('talla') is-invalid @enderror"
                                                    name="talla" value="{{ $exploracion->talla }}" autocomplete="talla" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)" disabled
                                                    title="La Talla es una cantidad númerica." autofocus>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Talla es Obligatorio</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-5 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        cm
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="cabeza" class="col-md-12 col-form-label">{{ __('Cabeza') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cabeza" id="cabeza" cols="30" rows="3" 
                                                class="form-control @error('cabeza') is-invalid @enderror"
                                                value="" autocomplete="cabeza" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->cabeza }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cabeza" role="alert">
                                                    <strong>El campo Cabeza es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cuello" class="col-md-12 col-form-label">{{ __('Cuello') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cuello" id="cuello" cols="30" rows="3" 
                                                class="form-control @error('cuello') is-invalid @enderror"
                                                value="" autocomplete="cuello" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->cuello }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Cuello es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="torax" class="col-md-12 col-form-label">{{ __('Tórax') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="torax" id="torax" cols="30" rows="3" 
                                                class="form-control @error('torax') is-invalid @enderror"
                                                value="" autocomplete="torax" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->torax }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Tórax es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="abdomen" class="col-md-12 col-form-label">{{ __('Abdomen') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="abdomen" id="abdomen" cols="30" rows="3" 
                                                class="form-control @error('abdomen') is-invalid @enderror"
                                                value="" autocomplete="abdomen" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->abdomen }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Abdomen es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="miembros" class="col-md-12 col-form-label">{{ __('Miembros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="miembros" id="miembros" cols="30" rows="3" 
                                                class="form-control @error('miembros') is-invalid @enderror"
                                                value="" autocomplete="miembros" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->miembros }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Miembros es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="genitales" class="col-md-12 col-form-label">{{ __('Genitales') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="genitales" id="genitales" cols="30" rows="3" 
                                                class="form-control @error('genitales') is-invalid @enderror"
                                                value="" autocomplete="genitales" maxlength="255" disabled
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->genitales }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Genitales es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
        
                                    <br>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="signosvitales" role="tabpanel" aria-labelledby="signosvitales-tab">
                                <form method="POST" id="storesignos">

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="temperatura" class="col-md-12 col-form-label">{{ __('Temperatura') }}:</label>
            
                                            <div class="col-md-12 row">
                                                <div class="col-md-8">
                                                    <input id="price" type="text" class="form-control" disabled
                                                    name="temperatura" value="{{ $signos->temperatura }}" autocomplete="temperatura" maxlength="4"
                                                    title="La temperatura es una cantidad númerica." autofocus>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Temperatura es Obligatorio</strong>
                                                    </span>
                                                </div>
    
                                                <div class="col-md-4 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        °C
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="presion" class="col-md-12 col-form-label">{{ __('Presión Arterial') }}:</label>
        
                                            <div class="col-md-12 row">
                                                <div class="col-md-8">
                                                    <input id="sistolica" type="text" class="form-control" disabled
                                                    name="sistolica" placeholder="sistolica" value="{{ $signos->tensionSistolica }}" autocomplete="sistolica" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Tensión Sistolica es una cantidad númerica." autofocus>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Presión Sistólica es Obligatorio</strong>
                                                    </span>
                                                    
                                                </div>

                                                <div class="col-md-4 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        mmHg
                                                    </div>
                                                </div>
    
                                                <div class="col-md-8">
                                                    <input id="diastolica" type="text" class="form-control" disabled
                                                    name="diastolica" placeholder="diastolica" value="{{ $signos->tensionDiastolica }}" autocomplete="diastolica" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Tensión diastolica es una cantidad númerica." autofocus>
    
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Presión Diastólico es Obligatorio</strong>
                                                    </span>
                                                </div>

                                                <div class="col-md-4 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        mmHg
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="frecuenciacardiaca" class="col-md-12 col-form-label">{{ __('Frecuencia Cardiaca') }}:</label>
            
                                            <div class="col-md-12 row">
                                                <div class="col-md-8">
                                                    <input id="frecuenciacardiaca" type="text" class="form-control" disabled
                                                    name="frecuenciacardiaca" value="{{ $signos->frecuenciaCardiaca }}" autocomplete="frecuenciacardiaca" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Frecuencia Cardiaca es una cantidad númerica." autofocus>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Frecuencia Cardiaca es Obligatorio</strong>
                                                    </span>
                                                </div>

                                                <div class="col-md-4 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        lmp
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-5">
                                            <label for="frecuenciarespiratoria" class="col-md-12 col-form-label">{{ __('Frecuencia Respiratoria') }}:</label>
            
                                            <div class="col-md-12 row">
                                                <div class="col-md-8">
                                                    <input id="frecuenciarespiratoria" type="text" class="form-control" disabled
                                                    name="frecuenciarespiratoria" value="{{ $signos->frecuenciaRespiratoria }}" autocomplete="frecuenciarespiratoria" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Frecuencia Respiratoria es una cantidad númerica." autofocus>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Frecuencia Respiratoria es Obligatorio</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-4 text-md-center" >
                                                    <div class="col-form-label littlediv">
                                                        rpm
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>
                                        
                                    </div>
        
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
