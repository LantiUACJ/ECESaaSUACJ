@extends('layouts.app')

@section('content')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script src="{{ asset('js/consulta.js')."?v=2.1" }}" defer></script> <!-- Script para manejar las operaciones crud de consulta -->
    <script src="{{ asset('js/interrogatorio.js')."?v=2.1" }}" defer></script> <!-- Script para manejar las operaciones crud de interrogatorio -->
    <script src="{{ asset('js/exploracion.js')."?v=2.1" }}" defer></script> <!-- Script para manejar las operaciones crud de interrogatorio -->

    <h5 class="section-title title">Registrar consulta</h5>
    <p class="breadcrumbs">
        <a href="{{ route('home') }}">Inicio</a> >
        <a href="{{ route('consultamedico') }}">Consultas</a> >
        <a href="{{ route('seleccionarpaciente') }}">Seleccionar paciente</a> >
        Registrar Consulta
    </p>

    <hr class="opactity3">

    <div class="scroll-section" id="scrollwindow">
        <form action="">
            <!-- Inputs para ajax -->
            <!-- Id del paciente -->
            <input type="hidden" id="pac_id" name="pac_id" value="{{ $paciente->id }}">

            <!-- Id de la consulta -->
            @if (session('consulta_id') !== null)
                <input type="hidden" id="consulta_id" value="{{ session('consulta_id') }}">
            @else
                <input type="hidden" id="consulta_id" value="">
            @endif

            <!-- Id del medico (probablemente inecesario ya que podria obtenerse de auth o user) -->
            <input type="hidden" id="medico_id" value="">

            <!-- DATOS GENERALES -->
            <div class="form-group">
                <h6 class="subtt">Datos Generales del paciente</h6>
                <div class="row nomargbot">
                    <div class="col s12">
                        <div class="row nomargbot">
                            <div class="col s12 m6 l4">
                                <p>Nombre: <b>{{ $paciente->nombre }} {{ $paciente->primerApellido }}
                                        {{ $paciente->segundoApellido }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>CURP: <b>{{ $paciente->curp }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Edad: <b>{{ $age }}</b></p>
                            </div>
                        </div>
                        <div class="row nomargbot">
                            <div class="col s12 m6 l4">
                                <p>Fecha de Consulta: <b>{{ $todaynow->format('d/m/Y') }}</b></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- NOTA, INTERROGATORIO, EXPLORACION -->
            <div class="form-group">
                <div class="row">
                    <div class="col s12">
                        <div class="row no-mar">
                            <ul class="tabs">
                                <li class="tab col s3">
                                    <a class="black-text tab-title text-darken-2 active" href="#section1">Nota de consulta</a>
                                </li>
                                <li class="tab col s3 {{ session('consulta_id') !== null ? '' : 'disabled' }}" id="interrogatorio-tab">
                                    <a class="black-text tab-title text-darken-2 disable" href="#section2">Interrogatorio</a>
                                </li>
                                <li class="tab col s3 {{ session('consulta_id') !== null ? '' : 'disabled' }}" id="exploracion-tab">
                                    <a class="black-text tab-title text-darken-2" href="#section3">Exploración física</a>
                                </li>
                                <li class="tab col s3" id="misece-tab">
                                    <a class="black-text tab-title text-darken-2" href="#section4">MISECE</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="section1" class="col s12">
                        <div class="row no-mar">
                            <div class="col s12">
                                <div class="row no-mar bg-tab">
                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="motivo" id="motivo" cols="30" rows="10" maxlength="255" autocomplete="motivo">{{ old('motivo') }}</textarea>
                                        <div class="float-voice startRecord" id="startmotivo" data-id="motivo">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopmotivo" data-id="motivo">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <label class="label-flex" for="motivo">
                                            <p class="text-over">
                                                Motivo de la Consulta
                                            </p>
                                        </label>
                                        <span class="helper-text" id="error-motivo"><strong>El campo Motivo de Consulta es Obligatorio</strong></span>
                                    </div>

                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="cuadro" id="cuadro" cols="30" rows="10" maxlength="255">{{ old('cuadro') }}</textarea>
                                        <div class="float-voice startRecord" id="startcuadro" data-id="cuadro">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <div class="float-voice stopRecord" style="background-color: red; display: none" data-id="cuadro" id="stopcuadro">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <label class="label-flex" for="cuadro">
                                            <p class="text-over" id="error-cuadro">
                                                Cuadro Clínico
                                            </p>
                                        </label>
                                        <span class="helper-text">Error</span>

                                    </div>

                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="resultados" id="resultados" cols="30" rows="10" maxlength="255">{{ old('resultados') }}</textarea>
                                        <div class="float-voice startRecord" id="startresultados" data-id="resultados">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopresultados" data-id="resultados">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <label class="label-flex" for="resultados">
                                            <p class="text-over">Resultados de Laboratorio y Gabinete</p>
                                        </label>
                                        <span class="helper-text">Error</span>
                                    </div>
                                    
                                    <div class="input-field col s12 m6 l6 no-mar">
                                        <div class="selectize-one">
                                            <label>Diagnósticos o Problemas Clínicos</label>
                                            <input class="form-control selectize" id="select-diag" name="select-diag">

                                            <span class="helper-text">Error</span>
                                        </div>
                                    </div>

                                    <div class="input-field col s12 m6 l6 no-mar txtarin">
                                        <textarea name="diagnostico" id="diagnostico" cols="30" rows="10" maxlength="255">{{ old('diagnostico') }}</textarea>
                                        <div class="float-voice startRecord" id="startdiagnostico" data-id="diagnostico">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopdiagnostico" data-id="diagnostico">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <label class="label-flex" for="diagnostico">
                                            <p class="text-over">Diagnósticos o Problemas Clínicos</p>
                                        </label>
                                        <span class="helper-text">Error</span>
                                    </div>

                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="pronostico" id="pronostico" cols="30" rows="10" maxlength="255">{{ old('pronostico') }}</textarea>
                                        <div class="float-voice startRecord" id="startpronostico" data-id="pronostico">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoppronostico" data-id="pronostico">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <label class="label-flex" for="pronostico">
                                            <p class="text-over">Pronóstico</p>
                                        </label>
                                        <span class="helper-text">Error</span>

                                    </div>

                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="indicacion" id="indicacion" cols="30" rows="10" maxlength="255">{{ old('indicacion') }}</textarea>
                                        <div class="float-voice startRecord" id="startindicacion" data-id="indicacion">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopindicacion" data-id="indicacion">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <label class="label-flex" for="indicacion">
                                            <p class="text-over">Indicación Terapéutica</p>
                                        </label>
                                        <span class="helper-text">Error</span>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <div class="float-file">
                                            <input type="file" name="filename[]" id="filename" class="form-control" multiple accept=".doc,.docx,.pdf,.png,.jpg" style="display: none">
                                            <input type="hidden" id="jsonfiles" value="">
                                            <i class="material-icons" id="files">file_upload</i>
                                        </div>
                                        <p class="imginput-title">Archivos de los resultados de Laboratorio y Gabinete</p>
                                        <div class="img-space" id="filescontainer">
                                        </div>
                                    </div>

                                    @if ($paciente->sexo->numero == 2 && ($years >= 9 && $years <= 59))
                                        <div class="col s12" style="margin-bottom: 1rem;">
                                            <div class="switch">
                                                <label class="special-toggle">
                                                    <input type="checkbox" id="ispregnant" name="ispregnant" onclick="collapsPreg()">
                                                    <span class="lever"></span>
                                                    ¿Consulta por embarazo?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col s12 hide" id="pregContainer">
                                            <div class="row" style="margin: 1rem">
                                                <div class="col s12 l6">
                                                    <div class="question">
                                                        <p><b>¿Primera consulta por embarazo?</b></p>
                                                        <p>
                                                            <label for="consultaembarazo1">
                                                                <input name="consultaembarazo" id="consultaembarazo1" value="0" type="radio" />
                                                                <span>Primera vez</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="consultaembarazo2">
                                                                <input name="consultaembarazo" id="consultaembarazo2" value="1" type="radio" />
                                                                <span>Subsecuente</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-consultaembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
                                                    <div class="question">
                                                        <p><b>¿En qué trimestre gestacional se
                                                                encuentra?</b></p>
                                                        <p>
                                                            <label for="trimestreembarazo1">
                                                                <input name="trimestreembarazo" id="trimestreembarazo1" value="0" type="radio" />
                                                                <span>Primer trimestre</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="trimestreembarazo2">
                                                                <input name="trimestreembarazo" id="trimestreembarazo2" value="1" type="radio" />
                                                                <span>Segundo trimestre</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="trimestreembarazo3">
                                                                <input name="trimestreembarazo" id="trimestreembarazo3" value="2" type="radio" />
                                                                <span>Tercer trimestre</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-trimestreembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Es de alto riesgo?</b></p>
                                                        <p>
                                                            <label for="riesgoembarazo1">
                                                                <input name="riesgoembarazo" id="riesgoembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="riesgoembarazo2">
                                                                <input name="riesgoembarazo" id="riesgoembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-riesgoembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por diabetes?</b></p>
                                                        <p>
                                                            <label for="diabetesembarazo1">
                                                                <input name="diabetesembarazo" id="diabetesembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="diabetesembarazo2">
                                                                <input name="diabetesembarazo" id="diabetesembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-diabetesembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                </div>
                                                <div class="col s12 l6">
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por infección
                                                                urinaria?</b></p>
                                                        <p>
                                                            <label for="infeccionembarazo1">
                                                                <input name="infeccionembarazo" id="infeccionembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="infeccionembarazo2">
                                                                <input name="infeccionembarazo" id="infeccionembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-infeccionembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por
                                                                PreeclampsiaEclampsia??</b></p>
                                                        <p>
                                                            <label for="preclampsiaembarazo1">
                                                                <input name="preclampsiaembarazo" id="preclampsiaembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="preclampsiaembarazo2">
                                                                <input name="preclampsiaembarazo" id="preclampsiaembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-preclampsiaembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por hemorragia?</b></p>
                                                        <p>
                                                            <label for="hemorragiaembarazo1">
                                                                <input name="hemorragiaembarazo" id="hemorragiaembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="hemorragiaembarazo2">
                                                                <input name="hemorragiaembarazo" id="hemorragiaembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-hemorragiaembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Se Sospecha que la paciente tiene
                                                                Covid-19?</b></p>
                                                        <p>
                                                            <label for="sospechacovidembarazo1">
                                                                <input name="sospechacovidembarazo" id="sospechacovidembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="sospechacovidembarazo2">
                                                                <input name="sospechacovidembarazo" id="sospechacovidembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-sospechacovidembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Se Confirma Covid-19?</b></p>
                                                        <p>
                                                            <label for="confirmacioncovidembarazo1">
                                                                <input name="confirmacioncovidembarazo" id="confirmacioncovidembarazo1" value="0" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label for="confirmacioncovidembarazo2">
                                                                <input name="confirmacioncovidembarazo" id="confirmacioncovidembarazo2" value="1" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                        <span class="helper-text" id="error-confirmacioncovidembarazo"><strong>El campo Consulta por Embarazo es Obligatorio</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col s12" style="margin-bottom: 1rem; display: none;">
                                            <div class="switch">
                                                <label class="special-toggle">
                                                    <input type="checkbox" id="ispregnant" name="ispregnant" disabled>
                                                    <span class="lever"></span>
                                                    ¿Consulta por embarazo?
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col s12 {{ session('consulta_id') !== null ? 'hide' : '' }}" style="margin-bottom: 1rem; margin-top: 1rem;" id="consultasubmit">
                                        <a class="waves-light btn" onclick="subformbutton()">
                                            <i class="material-icons left">save</i>Guardar Nota de Consulta
                                        </a>
                                    </div>

                                    <div class="col s12 {{ session('consulta_id') !== null ? '' : 'hide' }}" style="margin-bottom: 1rem; margin-top: 1rem;" id="consultaupdate">
                                        <a class="waves-light btn" onclick="updateformbutton()">
                                            <i class="material-icons left">save</i>Actualizar Nota de Consulta
                                        </a>
                                    </div>

                                    <!--div class="col s12" style="margin-bottom: 1rem; margin-top: 1rem;">
                                        <a class="waves-effect waves-light btn" onclick="modaltestfunction()"><i
                                                class="material-icons left">save</i>Test Modal</a>
                                    </div-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="section2" class="col s12">
                        <div class="row no-mar bg-tab">
                            <div class="" style="padding: 0rem; display: grid;">
                                <div class="col s12">
                                    <div class="row no-mar">
                                        <div class="col s12">
                                            <ul class="collapsible specicop">
                                                <li class="active">
                                                    <div class="collapsible-header specialhedader">
                                                        1. Antecedentes Heredo - Familiares</div>
                                                    <div class="collapsible-body">
                                                        <div class="row no-mar">
                                                            <div class="col s12">
                                                                <div class="row no-mar">
                                                                    <div class="col s4">
                                                                        <div class="input-field">
                                                                            <select autocomplete="off" id="grupo" name="grupo">
                                                                                @if ($grupos->count() == 0)
                                                                                    <option value="0" selected>--- No se encontraron Grupos Étnicos ---</option>
                                                                                @elseif ($anteHF->grupo_id == null)
                                                                                    <option value="0" selected>--- Selecciona una Opción ---</option>
                                                                                    @foreach ($grupos as $grupo)
                                                                                        <option value="{{ $grupo->id }}">{{ $grupo->lenguaIndigena }}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                    <option value="0">--- Selecciona una Opción ---</option>
                                                                                    @foreach ($grupos as $grupo)
                                                                                        <option value="{{ $grupo->id }}" {{ $grupo->id == $anteHF->grupo_id? "selected": "" }}>{{ $grupo->lenguaIndigena }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                            <label>Grupo Étnico</label>
                                                                            <span class="helper-text" id="error-grupo">
                                                                                <strong>El campo Grupo Étnico es Obligatorio</strong>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col s12 m12 l4">
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="diabetes" id="diabetes"
                                                                        value="diabetes" {{ $anteHF->diabetes == 1? "checked": "" }}>
                                                                        <span>Diabetes</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="neoplasias" id="neoplasias"
                                                                        value="neoplasias" {{ $anteHF->neoplasias == 1? "checked": "" }}>
                                                                        <span>Neoplasias</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="cardiopatias" id="cardiopatias"
                                                                        value="cardiopatias" {{ $anteHF->cardiopatias == 1? "checked": "" }}>
                                                                        <span>Cardiopatías</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="parkinson" id="parkinson"
                                                                        value="parkinson"  {{ $anteHF->parkinson == 1? "checked": "" }}>
                                                                        <span>Parkinson</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="depresion" id="depresion"
                                                                        value="depresion" {{ $anteHF->depresion == 1? "checked": "" }}>
                                                                        <span>Depresión</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="colestasis" id="colestasis"
                                                                        value="colestasis"  {{ $anteHF->colestasis == 1? "checked": "" }}>
                                                                        <span>Colestasis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="endocrinas" id="endocrinas"
                                                                        value="endocrinas"  {{ $anteHF->enfermedadesEndocrinas == 1? "checked": "" }}>
                                                                        <span>Enfermedades
                                                                            Endícrinas</span>
                                                                    </label>
                                                                </p>
                                                            </div>
                                                            <div class="col s12 m12 l4">
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="hipertension" id="hipertension"
                                                                        value="hipertension" {{ $anteHF->hipertension == 1? "checked": "" }}>
                                                                        <span>Hipertensión</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="tuberculosis" id="tuberculosis"
                                                                        value="tuberculosis" {{ $anteHF->tuberculosis == 1? "checked": "" }}>
                                                                        <span>Tuberculosis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="alzheimer" id="alzheimer"
                                                                        value="alzheimer" {{ $anteHF->alzheimer == 1? "checked": "" }}>
                                                                        <span>Alzheimer</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="esclerosis" id="esclerosis"
                                                                        value="esclerosis" {{ $anteHF->esclerosisMultiple == 1? "checked": "" }}>
                                                                        <span>Esclerosis
                                                                            Múltiple</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="esquizofrenia" id="esquizofrenia"
                                                                        value="esquizofrenia" {{ $anteHF->esquizofrenia == 1? "checked": "" }}>
                                                                        <span>Esquizofrenia</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="hepatitis" id="hepatitis"
                                                                        value="hepatitis" {{ $anteHF->hepatitis == 1? "checked": "" }}>
                                                                        <span>Hepatitis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="geneticas" id="geneticas"
                                                                        value="geneticas" {{ $anteHF->enfermedadesGeneticas == 1? "checked": "" }}>
                                                                        <span>Enfermedades
                                                                            Genéticas</span>
                                                                    </label>
                                                                </p>
                                                            </div>
                                                            <div class="col s12 m12 l4">
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="dislipidemias" id="dislipidemias"
                                                                        value="dislipidemias" {{ $anteHF->dislipidemias == 1? "checked": "" }}>
                                                                        <span>Dislipidemias</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="artritis" id="artritis"
                                                                        value="artritis" {{ $anteHF->artritis == 1? "checked": "" }}>
                                                                        <span>Artritis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="epilepsia" id="epilepsia"
                                                                        value="epilepsia"  {{ $anteHF->epilepsia == 1? "checked": "" }}>
                                                                        <span>Epilepsia</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="trastorno" id="trastorno"
                                                                        value="trastorno" {{ $anteHF->trastornoAnsiedad == 1? "checked": "" }} >
                                                                        <span>Transtorno de
                                                                            Ansiedad</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="cirrosis" id="cirrosis"
                                                                        value="cirrosis" {{ $anteHF->Cirrosis == 1? "checked": "" }}>
                                                                        <span>Cirrosis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox" class="filled-in" name="alergias" id="alergias"
                                                                        value="alergias" {{ $anteHF->alergias == 1? "checked": "" }}>
                                                                        <span>Alergias</span>
                                                                    </label>
                                                                </p>
                                                            </div>
                                                            
                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="otroshf" id="otroshf" cols="30" rows="10" maxlength="255">{{ $anteHF->otroshf }}</textarea>
                                                                <div class="float-voice startRecord" id="startotroshf" data-id="otroshf">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopotroshf" data-id="otroshf">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="otroshf">
                                                                    <p class="text-over">
                                                                        Otros:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col {{ session('anteHF_id') !== null ? 'hide' : '' }}" id="antehrsubmit">
                                                                        <a class="waves-light btn" onclick="storeantecedenteshf()">
                                                                            <i class="material-icons left">save</i> Guardar Antecedentes Heredo - Familiares
                                                                        </a>
                                                                    </div>
                                                                    <div class="col {{ session('anteHF_id') !== null ? '' : 'hide' }}" id="antehrupdate">
                                                                        <a class="waves-light btn" onclick="updateantecedenteshf()">
                                                                            <i class="material-icons left">save</i> Actualizar Antecedentes Heredo - Familiares
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        2. Antecedentes Personales Patológicos</div>
                                                    <div class="collapsible-body">
                                                        <div class="row">

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="infectacontagiosa" id="infectacontagiosa" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePP->enfermedadInfectaContagiosa }}</textarea>
                                                                <div class="float-voice startRecord" id="startinfectacontagiosa" data-id="infectacontagiosa">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopinfectacontagiosa" data-id="infectacontagiosa">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="infectacontagiosa">
                                                                    <p class="text-over">
                                                                        Enfermedad infecto contagiosa:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="cronicodegenerativa" id="cronicodegenerativa" cols="30" rows="10"maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePP->enfermedadCronicaDegenerativa }}</textarea>
                                                                <div class="float-voice startRecord" id="startcronicodegenerativa" data-id="cronicodegenerativa">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopcronicodegenerativa" data-id="cronicodegenerativa">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="cronicodegenerativa">
                                                                    <p class="text-over">
                                                                        Enfermedad crónico degenerativa
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="traumatologicos" id="traumatologicos" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePP->traumatologicos }}</textarea>
                                                                <div class="float-voice startRecord" id="starttraumatologicos" data-id="traumatologicos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoptraumatologicos" data-id="traumatologicos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="traumatologicos">
                                                                    <p class="text-over">
                                                                        Traumatológicos:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="alergicos" id="alergicos" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePP->alergicos }}</textarea>
                                                                <div class="float-voice startRecord" id="startalergicos" data-id="alergicos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopalergicos" data-id="alergicos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="alergicos">
                                                                    <p class="text-over">
                                                                        Alérgicos:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="quirurgicos" id="quirurgicos" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" >{{ $antePP->quirurgicos }}</textarea>
                                                                <div class="float-voice startRecord" id="startquirurgicos" data-id="quirurgicos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopquirurgicos" data-id="quirurgicos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="quirurgicos">
                                                                    <p class="text-over">
                                                                        Quirúrgicos:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="hospitalizaciones" id="hospitalizaciones" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" >{{ $antePP->hospitalizacionesPrevias }}</textarea>
                                                                <div class="float-voice startRecord" id="starthospitalizaciones" data-id="hospitalizaciones">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stophospitalizaciones" data-id="hospitalizaciones">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="hospitalizaciones">
                                                                    <p class="text-over">
                                                                        Hospitalizaciones previas:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="transfusiones" id="transfusiones" cols="30" rows="10"maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" >{{ $antePP->transfusiones }}</textarea>
                                                                <div class="float-voice startRecord" id="starttransfusiones" data-id="transfusiones">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoptransfusiones" data-id="transfusiones">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="transfusiones">
                                                                    <p class="text-over">
                                                                        Transfusiones:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="otrospp" id="otrospp" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePP->otros }}</textarea>
                                                                <div class="float-voice startRecord" id="startotrospp" data-id="otrospp">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopotrospp" data-id="otrospp">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="otrospp">
                                                                    <p class="text-over">
                                                                        Otros:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12 m6 l6 txtarin no-mar default-select" style="margin-top: 0px !important">
                                                                <p class="grey-text">Toxicomanías:</p>
                                                                <select class="form-control selectize-container" name="multiselecttoxic[]" id="multiselecttoxic">
                                                                    <option value="1">Depresoras</option>
                                                                    <option value="2">Estimulantes</option>
                                                                    <option value="3">Alucinógenos/Psicodélicos</option>
                                                                    <option value="4">Cannabis</option>
                                                                    <option value="5">Inhalantes</option>
                                                                    <option value="6">Alcoholismo</option>
                                                                    <option value="7">Tabaquismo</option>
                                                                </select>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div id="antePPsubmit" class="col {{ session('antePP_id') !== null ? 'hide' : '' }}">
                                                                        <a class="waves-light btn" onclick="storeantecedentespp()">
                                                                            <i class="material-icons left">save</i> Guardar Antecedentes Personales Patológicos
                                                                        </a>
                                                                    </div>

                                                                    <div id="antePPupdate" class="col {{ session('antePP_id') !== null ? '' : 'hide' }}">
                                                                        <a class="waves-light btn" onclick="updateantecedentespp()">
                                                                            <i class="material-icons left">save</i> Actualizar Antecedentes Personales Patológicos
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        3. Antecedentes Personales No Patológicos</div>
                                                    <div class="collapsible-body">
                                                        <div class="row no-mar">
                                                            <div class="input-field col s12 m4 l4">
                                                                <select name="tipodificultad" id="tipodificultad">
                                                                    @if ($tiposDif->count() == 0)
                                                                        <option value="" selected>-Sin Tipos de Dificultad-</option>
                                                                    @else
                                                                        <option value="">-Selecciona una Opción-</option>
                                                                        @foreach ($tiposDif as $tipo)
                                                                            <option value="{{ $tipo->id }}" {{ ($tipo->id == $antePNP->tipoD_id)? "selected": (($antePNP->tipoD_id == null)? ($tipo->valor == 9? "selected": ""): "") }}>{{ $tipo->tipo }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <label for="tipodificultad">Tipo de dificultad</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>
                                                            <div class="input-field col s12 m4 l4">
                                                                <select name="gradodificultad" id="gradodificultad">
                                                                    @if ($gradosDif->count() == 0)
                                                                        <option value="" selected>-Sin grados de Dificultad-</option>
                                                                    @else
                                                                        <option value="">-Selecciona una Opción-</option>
                                                                        @foreach ($gradosDif as $grado)
                                                                            <option value="{{ $grado->id }}" {{ ($grado->id == $antePNP->gradoD_id)? "selected": (($antePNP->gradoD_id == null)? ($grado->valor == 9? "selected": ""): "") }}>{{ $grado->grado }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <label for="gradodificultad">Grado de dificultad</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>
                                                            <div class="input-field col s12 m4 l4">
                                                                <select name="origendificultad" id="origendificultad">
                                                                    @if ($origenesDif->count() == 0)
                                                                        <option value="" selected>-Sin origenes de Dificultad-</option>
                                                                    @else
                                                                        <option value="">-Selecciona una Opción-</option>
                                                                        @foreach ($origenesDif as $origen)
                                                                            <option value="{{ $origen->id }}" {{ ($origen->id == $antePNP->origenD_id)? "selected": (($antePNP->origenD_id == null)? ($origen->valor == 9? "selected": ""): "") }}>{{ $origen->origen }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <label for="origendificultad">Origen de dificultad</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="vivienda" id="vivienda" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePNP->vivienda }}</textarea>
                                                                <div class="float-voice startRecord" id="startvivienda" data-id="vivienda">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopvivienda" data-id="vivienda">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="vivienda">
                                                                    <p class="text-over">
                                                                        Vivienda:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="higiene" id="higiene" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePNP->higiene }}</textarea>
                                                                <div class="float-voice startRecord" id="starthigiene" data-id="higiene">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stophigiene" data-id="higiene">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="higiene">
                                                                    <p class="text-over">
                                                                        Higiene:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="dieta" id="dieta" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePNP->dieta }}</textarea>
                                                                <div class="float-voice startRecord" id="startdieta" data-id="dieta">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopdieta" data-id="dieta">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="dieta">
                                                                    <p class="text-over">
                                                                        Dieta:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="zoonosis" id="zoonosis" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePNP->zoonosis }}</textarea>
                                                                <div class="float-voice startRecord" id="startzoonosis" data-id="zoonosis">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopzoonosis" data-id="zoonosis">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="zoonosis">
                                                                    <p class="text-over">
                                                                        Zoonosis:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="otrospnp" id="otrospnp" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $antePNP->otros }}</textarea>
                                                                <div class="float-voice startRecord" id="startotrospnp" data-id="otrospnp">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopotrospnp" data-id="otrospnp">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="otrospnp">
                                                                    <p class="text-over">
                                                                        Otros:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div id="antePNPsubmit" class="col {{ session('antePNP_id') !== null ? 'hide' : '' }}">
                                                                        <a class="waves-light btn" onclick="storeantecedentespnp()">
                                                                            <i class="material-icons left">save</i>
                                                                            Guardar Antecedentes Personales No Patológicos
                                                                        </a>
                                                                    </div>

                                                                    <div id="antePNPupdate" class="col {{ session('antePNP_id') !== null ? '' : 'hide' }}">
                                                                        <a class="waves-light btn" onclick="updateantecedentespnp()">
                                                                            <i class="material-icons left">save</i>
                                                                            Actualizar Antecedentes Personales No Patológicos
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        4. Interrogatorio Aparatos y Sistemas
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <div class="row">
                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="signos" id="signos" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->signosYsintomas }}</textarea>
                                                                <div class="float-voice startRecord" id="startsignos" data-id="signos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopsignos" data-id="signos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="signos">
                                                                    <p class="text-over">
                                                                        Signos y Síntomas:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="cardiovascular" id="cardiovascular" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->aparatoCardiovascular }}</textarea>
                                                                <div class="float-voice startRecord" id="startcardiovascular" data-id="cardiovascular">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopcardiovascular" data-id="cardiovascular">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="cardiovascular">
                                                                    <p class="text-over">
                                                                        Aparato Cardiovascular:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="respiratorio" id="respiratorio" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->aparatoRespiratorio }}</textarea>
                                                                <div class="float-voice startRecord" id="startrespiratorio" data-id="respiratorio">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoprespiratorio" data-id="respiratorio">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="respiratorio">
                                                                    <p class="text-over">
                                                                        Aparato Respiratorio:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="digestivo" id="digestivo" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->aparatoDigestivo }}</textarea>
                                                                <div class="float-voice startRecord" id="startdigestivo" data-id="digestivo">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopdigestivo" data-id="digestivo">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="digestivo">
                                                                    <p class="text-over">
                                                                        Aparato digestivo:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="nefro" id="nefro" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->sistemaNefro }}</textarea>
                                                                <div class="float-voice startRecord" id="startnefro" data-id="nefro">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopnefro" data-id="nefro">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="nefro">
                                                                    <p class="text-over">
                                                                        Sistema Nefrourológico:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="endocrino" id="endocrino" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->sistemaEndocrino }}</textarea>
                                                                <div class="float-voice startRecord" id="startendocrino" data-id="endocrino">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopendocrino" data-id="endocrino">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="endocrino">
                                                                    <p class="text-over">
                                                                        Sistema Endócrino y Metabolismo:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="hematopoyetico" id="hematopoyetico" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->sistemaHemato }}</textarea>
                                                                <div class="float-voice startRecord" id="starthematopoyetico" data-id="hematopoyetico">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stophematopoyetico" data-id="hematopoyetico">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="hematopoyetico">
                                                                    <p class="text-over">
                                                                        Sistema Hematopoyético:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="nervioso" id="nervioso" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->sistemaNervioso }}</textarea>
                                                                <div class="float-voice startRecord" id="startnervioso" data-id="nervioso">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopnervioso" data-id="nervioso">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="nervioso">
                                                                    <p class="text-over">
                                                                        Sistema Nervioso:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="musculo" id="musculo" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->sistemaMusculoEsqueletico }}</textarea>
                                                                <div class="float-voice startRecord" id="startmusculo" data-id="musculo">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopmusculo" data-id="musculo">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="musculo">
                                                                    <p class="text-over">
                                                                        Sistema Musculo Esqulético:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="piel" id="piel" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->pielYtegumentos }}</textarea>
                                                                <div class="float-voice startRecord" id="startpiel" data-id="piel">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoppiel" data-id="piel">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="piel">
                                                                    <p class="text-over">
                                                                        Piel y Tegumentos:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="sentidos" id="sentidos" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->organosSentidos }}</textarea>
                                                                <div class="float-voice startRecord" id="startsentidos" data-id="sentidos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopsentidos" data-id="sentidos">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="sentidos">
                                                                    <p class="text-over">
                                                                        Órganos de los sentidos:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="psiquica" id="psiquica" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ $interAS->esferaPsiquica }}</textarea>
                                                                <div class="float-voice startRecord" id="startpsiquica" data-id="psiquica">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoppsiquica" data-id="psiquica">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <label class="label-flex" for="psiquica">
                                                                    <p class="text-over">
                                                                        Esfera Psíquica:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col {{ session('interAS_id') !== null ? 'hide' : '' }}" id="aparatossubmit">
                                                                        <a class="waves-light btn" onclick="storeaparatos()">
                                                                            <i class="material-icons left">save</i> Guardar Aparator y Sistemas
                                                                        </a>
                                                                    </div>
                                                                    <div class="col {{ session('interAS_id') !== null ? '' : 'hide' }}" id="aparatosupdate">
                                                                        <a class="waves-light btn" onclick="updateaparatos()">
                                                                            <i class="material-icons left">save</i> Actualizar Aparator y Sistemas
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="section3" class="col s12">
                        <div class="row no-mar bg-tab">
                            <div class="" style="padding: 0rem; display: grid;">
                                <div class="col s12">
                                    <div class="row no-mar">
                                        <div class="col s12">
                                            <ul class="collapsible specicop">
                                                <li class="active">
                                                    <div class="collapsible-header specialhedader">
                                                        1. Datos de exploración física</div>
                                                    <div class="collapsible-body">
                                                        <div class="row no-mar">

                                                            <div class="input-field col s12 m6 l6">
                                                                <p class="floating">kg</p>
                                                                <input name="peso" id="peso" data-id="price2" type="text" maxlength="6" class="validate" value="{{ old('peso') }}">
                                                                <label for="peso">Peso</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6">
                                                                <p class="floating">cm</p>
                                                                <input name="talla" id="talla" data-id="price2" type="text" maxlength="6" class="validate" value="{{ old('talla') }}">
                                                                <label for="talla">Talla</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="habitus" id="habitus" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ old('habitus') }}</textarea>
                                                                <label class="label-flex" for="habitus">
                                                                    <p class="text-over">
                                                                        Habitus exterior:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="starthabitus" data-id="habitus">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stophabitus" data-id="habitus">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="cabeza" id="cabeza" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ old('cabeza') }}</textarea>
                                                                <label class="label-flex" for="cabeza">
                                                                    <p class="text-over">
                                                                        Cabeza:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="startcabeza" data-id="cabeza">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopcabeza" data-id="cabeza">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="cuello" id="cuello" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ old('cuello') }}</textarea>
                                                                <label class="label-flex" for="cuello">
                                                                    <p class="text-over">
                                                                        Cuello:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="startcuello" data-id="cuello">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopcuello" data-id="cuello">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="torax" id="torax" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" >{{ old('torax') }}</textarea>
                                                                <label class="label-flex" for="torax">
                                                                    <p class="text-over">
                                                                        Tórax:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="starttorax" data-id="torax">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoptorax" data-id="torax">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="abdomen" id="abdomen" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ old('abdomen') }}</textarea>
                                                                <label class="label-flex" for="abdomen">
                                                                    <p class="text-over">
                                                                        Abdomen:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="startabdomen" data-id="abdomen">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopabdomen" data-id="abdomen">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="miembros" id="miembros" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" >{{ old('miembros') }}</textarea>
                                                                <label class="label-flex" for="miembros">
                                                                    <p class="text-over">
                                                                        Miembros:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="startmiembros" data-id="miembros">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopmiembros" data-id="miembros">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="genitales" id="genitales" cols="30" rows="10" maxlength="255"
                                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)">{{ old('genitales') }}</textarea>
                                                                <label class="label-flex" for="genitales">
                                                                    <p class="text-over">
                                                                        Genitales:
                                                                    </p>
                                                                </label>
                                                                <div class="float-voice startRecord" id="startgenitales" data-id="genitales">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopgenitales" data-id="genitales">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col {{ session('explo_id') !== null ? 'hide' : '' }}" id="exploracionsubmit">
                                                                        <a class="waves-light btn" onclick="storeexploracion()">
                                                                            <i class="material-icons left">save</i> Guardar Exploración Física
                                                                        </a>
                                                                    </div>

                                                                    <div class="col {{ session('explo_id') !== null ? '' : 'hide' }}" id="exploracionupdate">
                                                                        <a class="waves-light btn" onclick="updateexploracion()">
                                                                            <i class="material-icons left">save</i> Actualizar Exploración Física
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        2. Signos Vitales
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <div class="row">
                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">°C</p>
                                                                <input id="price" name="temperatura" type="text" class="validate" 
                                                                maxlength="4" value="{{ old('temperatura') }}">
                                                                <label for="price">Temperatura</label>
                                                                <span class="helper-text">El campo Temperatura es Obligatorio</span>
                                                            </div>

                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">mmHg</p>
                                                                <input id="sistolica" name="sistolica" type="text" class="validate"
                                                                maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" value="{{ old('temperatura') }}">
                                                                <label for="sistolica">Presión Arterial Sistólica</label>
                                                                <span class="helper-text">El campo Presión Sistólica es Obligatorio</span>
                                                            </div>

                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">mmHg</p>
                                                                <input name="diastolica" id="diastolica" type="text" class="validate"
                                                                maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" value="{{ old('diastolica') }}">
                                                                <label for="diastolica">Presión
                                                                    Arterial Diastólica</label>
                                                                <span class="helper-text">El campo Presión Diastólico es Obligatorio</span>
                                                            </div>



                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">lmp</p>
                                                                <input name="frecuenciacardiaca" id="frecuenciacardiaca" type="text" class="validate" 
                                                                maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" value="{{ old('frecuenciacardiaca') }}">
                                                                <label for="frecuenciacardiaca">Frecuencia Cardiaca</label>
                                                                <span class="helper-text">El campo Frecuencia Cardiaca es Obligatorio</span>
                                                            </div>


                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">rmp</p>
                                                                <input class="validate" id="frecuenciarespiratoria" type="text"  name="frecuenciarespiratoria" 
                                                                value="{{ old('frecuenciarespiratoria') }}" maxlength="3" onkeypress="return /[0-9]/i.test(event.key)">
                                                                <label for="frecuenciarespiratoria">Frecuencia Respiratoria</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">%</p>
                                                                <input name="saturacionoxigeno" type="text" class="validate"
                                                                id="saturacionoxigeno" value="{{ old('saturacionoxigeno') }}" maxlength="3"
                                                                onkeypress="return /[0-9]/i.test(event.key)">
                                                                <label for="saturacionoxigeno">Saturación de oxígeno</label>
                                                                <span class="helper-text">Error</span>
                                                            </div>



                                                            <div class="input-field col s12 m12 l6">
                                                                <p class="floating">mg/dL</p>
                                                                <input name="glucosa" id="glucosa" type="text" class="validate"
                                                                maxlength="6" value="{{ old('glucosa') }}" data-id="price2">
                                                                <label for="glucosa">Glucosa</label>
                                                                <span class="helper-text">El campo Glucosa es Obligatorio</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col {{ session('signos_id') !== null ? 'hide' : '' }}" id="signossubmit">
                                                                        <a class="waves-light btn" onclick="storesignos()">
                                                                            <i class="material-icons left">save</i> Guardar Signos Vitales
                                                                        </a>
                                                                    </div>
                                                                    <div class="col {{ session('signos_id') !== null ? '' : 'hide' }}" id="signosupdate">
                                                                        <a class="waves-light btn" onclick="updatesignos()">
                                                                            <i class="material-icons left">save</i> Actualizar Signos Vitales
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="section4" class="col s12">
                        <div class="row no-mar bg-tab">
                            <ul>
                                <li>
                                    <div class="inner-spacer">
                                        <div class="center-div">
                                            <form action="">
                                                <div class="toggle-div row hide" id="codeArea">
                                                    <div class="input-field col s12">
                                                        <input type="text" id="patientcode" name="patientcode" value="" class="validate">
                                                        <label for="patientcode">Introduce el código del paciente</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{ $paciente->curp }}">
                                                <input type="hidden" name="patientcurp" id="patientcurp" value="{{ $paciente->curp }}">
                                                <a href="#" id="consultBtn" class="btn solid-btn">solicitar código</a>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="hide" id="loadingArea">
                                    <div class="inner-spacer">
                                        <div class="center-div">
                                            <form action="">
                                                <div class="toggle-div row">
                                                    <div class="input-field col s12 center-align"">
                                                        <img id="wait" src="{{ asset('img/Loading_2.gif') }}" alt="">
                                                        <p><strong>Cargando datos... Por favor espera...</strong></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="" id="ece-content" style="width: 100%">
                                        <iframe id="iframecontent" src="" type="text/html" frameborder="0" style="margin-left: 5px; margin-right: 5px;"></iframe>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col">
                        <a class="waves-effect waves-light btn"><i
                                class="material-icons left">save</i>Guardar</a>
                    </div> -->
                        <div class="col" style="padding-top: 1rem">
                            <a class="waves-light btn orange darken-1 btn" onclick="buscarParaTerminarConsulta()"><i
                                    class="material-icons left">check</i>Terminar consulta</a>
                        </div>
                        
                        <!--a onclick="M.toast({html: 'I am a toast'})" class="btn">Abrir toast!</a-->
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Structure -->
    <div id="consultamodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="modalmsg">Mensaje</p>
            <p>Las pestañas de interrogatorio y Exploración Física han sido desbloqueadas!!</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="updateconsultamodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="updateconsultamsg">Mensaje</p>
            <p>Continua la consulta en las pestañas de interrogatorio y Exploración Física</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="errormodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="errormsg">Mensaje</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="intermodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="intermsg">Mensaje</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="explomodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="explomsg">Mensaje</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="infomissing" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="infomsg">Mensaje</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="noConsultamodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem">¡La consulta no ha sido guardada!</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>

    <div id="noIntermodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem">¡No hay interrogatorio registrado para el paciente!</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>
    
    <!-- Modal Structure SAVE -->
    <div id="terminarmodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.35rem">Asegúrate que todos los cambios estén guardados correctamente. ¿Estás seguro que
                quieres terminar la consulta?</p>
            <br>
            <div class="input">
                <label for="doctorsign" style="font-size: 1rem" class="col s12 row">
                    Contraseña:
                    <input type="password" id="doctorsign" name="doctorsign" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                </label>
            </div>
            <p class="hide" style="color: red" id="nopass">La contraseña es obligatoria.</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat"
                style="color: white;">Cerrar</a>
            <a onclick="TerminarConsulta()" class="red waves-green btn-flat" id="endconsult" style="color: white;">Firmar y Terminar
                consulta</a>
        </div>
    </div>

    <a href="{{ route('terminarConsulta') }}" class="hide" id="finishsuccess">Finish</a>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger');
            var instances = M.Dropdown.init(elems);
        });
        var instance = M.Tabs.init();
        $(document).ready(function() {
            $('.tabs').tabs();
        });
        $('.text-over').click(function(e) {
            e.stopPropagation();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sele = document.querySelectorAll('select');
            var instance = M.FormSelect.init(sele);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                dismissible: false
            });
        });
        $(document).ready(function() {
            $('.tabs').tabs();
        });
        var elems = null;
        document.addEventListener('DOMContentLoaded', function() {
            elems = document.querySelectorAll('.collapsible');
            var options = {};
            var instances = M.Collapsible.init(elems, options);
        });
        $(window).resize(function() {
            // console.log('Rezigin', $(window).width());
            if ($(window).width() <= 960) {
                elems.forEach((elmnt, i) => {
                    // var instance = M.Collapsible.getInstance(elmnt);
                    // instance.close(0);
                    // instance.close(1);
                    // instance.close(2);
                    // instance.close(3);
                });
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha512-hgoywpb1bcTi1B5kKwogCTG4cvTzDmFCJZWjit4ZimDIgXu7Dwsreq8GOQjKVUxFwxCWkLcJN5EN0W0aOngs4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha512-nATinx3+kN7dKuXEB0XLIpTd7j8QahdyJjE24jTJf4HASidUCFFN/TkSVn3CifGmWwfC2mO/VmFQ6hRn2IcAwg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script-->
    <!--script src="{{ asset('js/speechtotext.js')."?v=2.1"  }}" defer></script--> <!-- Script para manejar las transcripciones speech to text de google cloud -->
    
<script>
    var toggleStatus = false;
    var preganancy = $("#pregnancySection");
    $(document).ready(function() {
        $("#toggle").change(function() {
            toggleStatus = !toggleStatus
            if (toggleStatus) {
                preganancy.addClass("show");
            } else {
                preganancy.removeClass("show");
            }
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $(".selectize").selectize({
            maxItems: 1,
            valueField: 'id',
            labelField: ['term'],
            searchField: ['term'],
            create: false,
            load: (query, callback) => {
                if (!query.length) return callback();
                let textvalue = $("#select-diag-selectized").val();
                $.ajax({
                    url: url + "/getdiags",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        term: textvalue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: () => {
                        callback()
                    },
                    success: (res) => {
                        callback(res)
                    }
                });
            },
            render: {
                option: (item, escape) => {
                    return '<p>' + item.term + '</p>'
                }
            }
        });

        var $multitoxic = $("#multiselecttoxic").selectize({
            plugins: ["remove_button"],
            delimiter: ",",
            placeholder: "Selecciona una opción",
            persist: false,
            maxItems: 7,
        });

        var selectizetoxic = $multitoxic[0].selectize;
        selectizetoxic.clear()
    });
</script>

<script type="text/javascript">
    var text = "";
    $(function() {
        $('.startRecord').on('click', function(){
            text = $(this).attr('data-id');
            navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(handleSuccess);
            $('#start'+text).hide();
            $('#stop'+text).show();
        });
        const handleSuccess = function(stream) {
            const options = {mimeType: 'audio/webm'};
            const recordedChunks = [];
            const mediaRecorder = new MediaRecorder(stream, options);
            mediaRecorder.addEventListener('dataavailable', function(e) {
                if (e.data.size > 0) recordedChunks.push(e.data);
            });
            mediaRecorder.addEventListener('stop', function() {
                var audio = new Blob(recordedChunks);
                stream.getTracks().forEach( track => track.stop() );
                if(text == ""){
                    alert("Id invalido");
                }else
                    transcriptSpeech(audio, text);
            });
            $('.stopRecord').on('click', function(){
                text = $(this).attr('data-id');
                mediaRecorder.stop();
                $('#start'+text).show();
                $('#stop'+text).hide();
            });
            mediaRecorder.start();
        };
        //Funcion que llama el metodo de transcripcion de voz a texto
        function transcriptSpeech(audio, text){
            var fd = new FormData();
            fd.append('audio', audio);
            $.ajax({
                url: url + "/transcriptspeech",
                type: "POST",
                processData: false,
                contentType: false,
                data: fd,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    var textarea = document.getElementById(text);
                    textarea.value += " " + response + ".";
                    $('#'+text).focus();
                },
                error: function(response){
                    alert("A Ocurrido un Error!");
                },
            });
        }
    });
</script>
@endsection