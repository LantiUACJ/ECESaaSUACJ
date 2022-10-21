@extends('layouts.app')

@section('content')

    <h5 class="section-title title">Registrar consulta</h5>
    <p class="breadcrumbs">
        <a href="{{ route('home') }}">Inicio</a> >
        <a href="{{ route('consultamedico') }}">Consultas</a> >
        <a href="{{ route('seleccionarpaciente') }}">Seleccionar paciente</a> >
        Registrar Consulta
    </p>

    <hr style="opacity: 0.3">

    <div class="scroll-section">
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
                                    <a class="black-text tab-title text-darken-2 active" href="#section1">Nota de
                                        consulta</a>
                                </li>
                                <li class="tab col s3 {{ session('consulta_id') !== null ? '' : 'disabled' }}" id="interrogatorio-tab">
                                    <a class="black-text tab-title text-darken-2 disable" href="#section2">Interrogatorio</a>
                                </li>
                                <li class="tab col s3 {{ session('consulta_id') !== null ? '' : 'disabled' }}" id="exploracion-tab">
                                    <a class="black-text tab-title text-darken-2" href="#section3">Exploración física</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="section1" class="col s12">
                        <div class="row no-mar">
                            <div class="col s12">
                                <div class="row no-mar bg-tab">
                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="motivo" id="motivo" cols="30" rows="10"></textarea>
                                        <label class="label-flex" for="motivo">
                                            <div class="float-voice startRecord" id="startmotivo" data-id="motivo">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopmotivo" data-id="motivo">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <p class="text-over">
                                                Motivo de la Consulta
                                            </p>
                                        </label>
                                        <span class="helper-text show">Error</span>
                                    </div>

                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="cuadro" id="cuadro" cols="30" rows="10"></textarea>
                                        <label class="label-flex" for="cuadro">
                                            <div class="float-voice startRecord" id="startcuadro" data-id="cuadro">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <div class="float-voice stopRecord" style="background-color: red; display: none" data-id="cuadro" id="stopcuadro">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <p class="text-over">
                                                Cuadro clínico
                                            </p>
                                        </label>
                                        <span class="helper-text show">Error</span>

                                    </div>

                                    <div class="input-field col s12 m12 l6 txtarin no-mar">
                                        <textarea name="resultados" id="resultados" cols="30" rows="10"></textarea>
                                        <label class="label-flex" for="resultados">
                                            <div class="float-voice startRecord" id="startresultados" data-id="resultados">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopresultados" data-id="resultados">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <p class="text-over">Resultados de Laboratorio y
                                                Gabinete</p>

                                        </label>
                                        <span class="helper-text show">Error</span>

                                        <div class="float-file">
                                            <input type="file" name="filename[]" id="filename" class="form-control" multiple accept=".doc,.docx,.pdf,.png,.jpg" style="display: none">
                                            <input type="hidden" id="jsonfiles" value="">
                                            <i class="material-icons" id="files">file_upload</i>
                                        </div>

                                        <div class="img-space" id="filescontainer">
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>
                                            <div class="img-grid-c">
                                                <a class="imglink" href="" download><img src="{{ url(asset('img/icons/pdf.png')) }}" alt="" ></a>
                                            </div>

                                            <div class="img-grid-c">
                                                <div class="img-overaly">
                                                </div>
                                                <a href=""><img src="{{ url(asset('img/labresdemo.jpeg')) }}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col s12 m12 l6  no-mar">
                                        <div class="input-field">
                                            <input class="form-control selectize" id="select-diag" name="select-diag">

                                            <label>Diagnósticos o Problemas Clínicos</label>
                                        </div> <br>

                                        <div class="input-field txtarin">
                                            <textarea name="diagnostico" id="diagnostico" cols="30" rows="10"></textarea>
                                            <label class="label-flex" for="diagnostico">
                                                <div class="float-voice startRecord" id="startdiagnostico" data-id="diagnostico">
                                                    <i class="material-icons">keyboard_voice</i>
                                                </div>
                                                <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopdiagnostico" data-id="diagnostico">
                                                    <i class="material-icons">keyboard_voice</i>
                                                </div>
                                                <p class="text-over">Diagnósticos o Problemas
                                                    Clínicos</p>
                                            </label>
                                            <span class="helper-text show">Error</span>
                                        </div>
                                    </div>

                                    <div class="input-field col s12 m6 l6 txtarin no-mar">
                                        <textarea name="pronostico" id="pronostico" cols="30" rows="10"></textarea>
                                        <label class="label-flex" for="pronostico">
                                            <div class="float-voice startRecord" id="startpronostico" data-id="pronostico">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <div class="float-voice stopRecord" style="background-color: red; display: none" id="stoppronostico" data-id="pronostico">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <p class="text-over">Pronóstico</p>
                                        </label>
                                        <span class="helper-text show">Error</span>

                                    </div>

                                    <div class="input-field col s12 m6 l12 txtarin no-mar">
                                        <textarea name="indicacion" id="indicacion" cols="30" rows="10"></textarea>
                                        <label class="label-flex" for="indicacion">
                                            <div class="float-voice startRecord" id="startindicacion" data-id="indicacion">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <div class="float-voice stopRecord" style="background-color: red; display: none" id="stopindicacion" data-id="indicacion">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <p class="text-over">Indicación Terapéutica</p>
                                        </label>
                                        <span class="helper-text show">Error</span>

                                    </div>

                                    @if ($paciente->sexo->numero == 2 && ($years >= 9 && $years <= 59))
                                        <div class="col s12" style="margin-bottom: 1rem;">
                                            <div class="switch">
                                                <label class="special-toggle">
                                                    <input type="checkbox" id="toggle">
                                                    <span class="lever"></span>
                                                    ¿Consulta por embarazo?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col s12 preganancy-section" id="pregnancySection">
                                            <div class="row" style="margin: 1rem">
                                                <div class="col s12 l6">
                                                    <div class="question">
                                                        <p><b>¿Primera consulta por embarazo?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q0" type="radio" />
                                                                <span>Primera vez</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q0" type="radio" />
                                                                <span>Subsecuente</span>
                                                            </label>
                                                        </p>
                                                    </div>
                                                    <div class="question">
                                                        <p><b>¿En qué trimestre gestacional se
                                                                encuentra?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q2" type="radio" />
                                                                <span>Primer trimestre</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q2" type="radio" />
                                                                <span>Segundo trimestre</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q2" type="radio" />
                                                                <span>Tercer trimestre</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Es de alto riesgo?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q3" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q3" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por diabetes?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q4" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q4" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                </div>
                                                <div class="col s12 l6">
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por infección
                                                                urinaria?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q5" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q5" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por
                                                                PreeclampsiaEclampsia??</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q6" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q6" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Hay complicación por hemorragia?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q7" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q7" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Se Sospecha que la paciente tiene
                                                                Covid-19?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q8" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q8" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
    
                                                    <div class="question">
                                                        <p><b>¿Se Confirma Covid-19?</b></p>
                                                        <p>
                                                            <label>
                                                                <input name="q9" type="radio" />
                                                                <span>No</span>
                                                            </label>
                                                        </p>
                                                        <p>
                                                            <label>
                                                                <input name="q9" type="radio" />
                                                                <span>Sí</span>
                                                            </label>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col s12" style="margin-bottom: 1rem; display: none;">
                                            <div class="switch">
                                                <label class="special-toggle">
                                                    <input type="checkbox" id="toggle" name="ispregnant" disabled>
                                                    <span class="lever"></span>
                                                    ¿Consulta por embarazo?
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    <!--div class="col s12" style="margin-bottom: 1rem; margin-top: 1rem;">
                                        <a class="waves-effect waves-light btn modal-trigger" href="#modal1"><i
                                                class="material-icons left">save</i>Guardar Nota de Consulta</a>
                                    </div-->

                                    <div class="col s12 {{ session('consulta_id') !== null ? 'hide' : '' }}" style="margin-bottom: 1rem; margin-top: 1rem;" id="consultasubmit">
                                        <a class="waves-effect waves-light btn" onclick="subformbutton()"><i
                                                class="material-icons left">save</i>Guardar Nota de Consulta</a>
                                    </div>
                                    <div class="col s12 {{ session('consulta_id') !== null ? '' : 'hide' }}" style="margin-bottom: 1rem; margin-top: 1rem;" id="consultaupdate">
                                        <a class="waves-effect waves-light btn" onclick="subformbutton()"><i
                                                class="material-icons left">save</i>Actualizar Nota de Consulta</a>
                                    </div>

                                    <div class="col s12" style="margin-bottom: 1rem; margin-top: 1rem;">
                                        <a class="waves-effect waves-light btn" onclick="modaltestfunction()"><i
                                                class="material-icons left">save</i>Test Modal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="section2" class="col s12">
                        <div class="row no-mar  bg-tab">
                            <div class="" style="padding: 0rem; display: grid;">
                                <div class="col s12">
                                    <div class="row no-mar">
                                        <div class="col s12">
                                            <ul class="collapsible specicop">
                                                <li class="active">
                                                    <div class="collapsible-header specialhedader">
                                                        1. Ant. Heredo - Familiares</div>
                                                    <div class="collapsible-body">
                                                        <div class="row no-mar">
                                                            <div class="col s12">
                                                                <div class="row no-mar">
                                                                    <div class="col s4">
                                                                        <div class="input-field">
                                                                            <select>
                                                                                <option value=""
                                                                                    disabled
                                                                                    selected>Elije
                                                                                    una opción
                                                                                </option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    No</option>
                                                                                <option value=»Si»>
                                                                                    Si</option>
                                                                                <option value=»No»>
                                                                                    La ante
                                                                                    penultima opcion
                                                                                </option>
                                                                                <option value=»Si»>
                                                                                    La penultima
                                                                                    opcion</option>
                                                                                <option value=»No»>
                                                                                    La ultima opcion
                                                                                </option>
                                                                                <option value=»No»>
                                                                                    Last</option>
                                                                            </select>
                                                                            <label>Grupo
                                                                                Étnico</label>
                                                                            <span
                                                                                class="helper-text">Error</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col s12 m12 l4">
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in"
                                                                            checked="checked" />
                                                                        <span>Diabetes</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Neoplasias</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Cardiopatías</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Parkinson</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Depresión</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Colestasis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Enfermedades
                                                                            Endícrinas</span>
                                                                    </label>
                                                                </p>
                                                            </div>
                                                            <div class="col s12 m12 l4">
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Hipertensión</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Tuberculosis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Alzheimer</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Esclerosis
                                                                            Múltiple</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Esquizofrenia</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Hepatitis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Enfermedades
                                                                            Genéticas</span>
                                                                    </label>
                                                                </p>
                                                            </div>
                                                            <div class="col s12 m12 l4">
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Dislipidemias</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Artritis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Epilepsia</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Transtorno de
                                                                            Ansiedad</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Cirrosis</span>
                                                                    </label>
                                                                </p>
                                                                <p>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            class="filled-in" />
                                                                        <span>Alergias</span>
                                                                    </label>
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Otros:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                            href="#modal1"><i
                                                                                class="material-icons left">save</i>
                                                                            Guardar Antecedentes
                                                                            Heredo - Familiares
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        2. Ant. Personales Patológicos</div>
                                                    <div class="collapsible-body">
                                                        <div class="row">

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Enfermedad enfecto
                                                                        contagiosa:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>


                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Enfermedad crónico
                                                                        degenerativa
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Traumatológicos:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Alérgicos:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Quirúrgicos:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Hospitalizaciones previas:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Transfusiones:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <!--textarea name="clinicalPicture" id="" cols="30"
                                                                    rows="10"></textarea-->
                                                                <select class="form-control"
                                                                    name="multiselecttoxic[]"
                                                                    id="multiselecttoxic">
                                                                    <option value="1">Depresoras
                                                                    </option>
                                                                    <option value="2">Estimulantes
                                                                    </option>
                                                                    <option value="3">
                                                                        Alucinógenos/Psicodélicos
                                                                    </option>
                                                                    <option value="4">Cannabis
                                                                    </option>
                                                                    <option value="5">Inhalantes
                                                                    </option>
                                                                    <option value="6">Alcoholismo
                                                                    </option>
                                                                    <option value="7">Tabaquismo
                                                                    </option>
                                                                </select>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Toxicomanías:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Otros:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                            href="#modal1"><i
                                                                                class="material-icons left">save</i>
                                                                            Guardar Antecedentes
                                                                            Personales Patológicos
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        3. Ant. Personales No Patológicos</div>
                                                    <div class="collapsible-body">
                                                        <div class="row no-mar">
                                                            <div class="input-field col s12 m4 l4">
                                                                <select>
                                                                    <option value="" disabled
                                                                        selected>Seleccione</option>
                                                                    <option value="1">Opción 1
                                                                    </option>
                                                                    <option value="2">Opción 2
                                                                    </option>
                                                                </select>
                                                                <label>Tipo de dificultad</label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>
                                                            <div class="input-field col s12 m4 l4">
                                                                <select>
                                                                    <option value="" disabled
                                                                        selected>Seleccione</option>
                                                                    <option value="1">Opción 1
                                                                    </option>
                                                                    <option value="2">Opción 2
                                                                    </option>
                                                                </select>
                                                                <label>Grado de dificultad</label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>
                                                            <div class="input-field col s12 m4 l4">
                                                                <select>
                                                                    <option value="" disabled
                                                                        selected>Seleccione</option>
                                                                    <option value="1">Opción 1
                                                                    </option>
                                                                    <option value="2">Opción 2
                                                                    </option>
                                                                </select>
                                                                <label>Origen de dificultad</label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Vivienda:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Higiene:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Dieta:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Zoonosis:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Otros:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                            href="#modal1"><i
                                                                                class="material-icons left">save</i>
                                                                            Guardar Antecedentes
                                                                            Personales No
                                                                            Patológicos
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        4. Aparatos y Sistemas</div>
                                                    <div class="collapsible-body">
                                                        <div class="row">
                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Signos y Síntomas:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Aparato Cardiovascular:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Aparato Respiratorio:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Aparato digestivo:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Sistema Nefrourológico:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Sistema Endócrino y
                                                                        Metabolismo:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Sistema Honomatopoyético:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Sistema Nervioso:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Sistema Musculo Esqulético:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>


                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Piel y Tegumentos:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Órganos de los sentidos:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>

                                                            <div
                                                                class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture"
                                                                    id="" cols="30"
                                                                    rows="10"></textarea>
                                                                <label class="label-flex"
                                                                    for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i
                                                                            class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Esfera Psíquica:
                                                                    </p>
                                                                </label>
                                                                <span
                                                                    class="helper-text">Error</span>
                                                            </div>


                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                            href="#modal1"><i
                                                                                class="material-icons left">save</i>
                                                                            Guardar Aparator y
                                                                            Sistemas
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
                        <div class="row no-mar  bg-tab">
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

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Habitus exterior:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Peso:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Talla:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Cabeza:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Cuello:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Tórax:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Abdomen:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Miembros:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Genitales:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>




                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                            href="#modal1"><i
                                                                                class="material-icons left">save</i>
                                                                            Guardar Exploración
                                                                            Física
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header specialhedader">
                                                        2. Signos Vitales</div>
                                                    <div class="collapsible-body">
                                                        <div class="row">

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Temperatura:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>


                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Presion arterial sistólica:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Presion arterial diastólica:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Frecuencia cardiaca:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                                <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                                <label class="label-flex" for="clinicalPicture">
                                                                    <div class="float-voice">
                                                                        <i class="material-icons">keyboard_voice</i>
                                                                    </div>
                                                                    <p class="text-over">
                                                                        Frecuencia respiratoria:
                                                                    </p>
                                                                </label>
                                                                <span class="helper-text">Error</span>
                                                            </div>

                                                            <div class="col s12">
                                                                <div class="row padbot no-mar">
                                                                    <div class="col">
                                                                        <a class="waves-effect waves-light btn modal-trigger"
                                                                            href="#modal1"><i
                                                                                class="material-icons left">save</i>
                                                                            Guardar Signos Vitales
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
                    <!-- <h6 class="subtt">Nota de la consulta</h6> -->

                    <div class="row">
                        <!-- <div class="col">
                        <a class="waves-effect waves-light btn"><i
                                class="material-icons left">save</i>Guardar</a>
                    </div> -->
                        <div class="col" style="padding-top: 1rem">
                            <a class="waves-effect waves-light btn modal-trigger orange darken-1 btn"  href="#modal2"><i
                                    class="material-icons left">check</i>Terminar consulta</a>
                        </div>
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
    <div id="errormodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="errormsg">Mensaje</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>
    <div id="infomodal" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem" id="infomsg">Mensaje</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
        </div>
    </div>
    
    <!-- Modal Structure SAVE -->
    <div id="modal2" class="modal">
        <div class="modal-content" style="padding: 1rem 2rem;">
            <p style="font-size: 1.5rem">Asegúrate que todos los cambios estén guardados correctamente. ¿Estás seguro que
                quieres terminar la consulta?</p>
            <p>Las pestañas de interrogatorio y exploración física han sido desbloqueadas</p>
        </div>
        <div class="modal-footer" style="padding: 1rem 1rem;">
            <a href="#!" class="modal-close waves-effect teal waves-green btn-flat"
                style="color: white;">Cerrar</a>
            <a href="#!" class="modal-close waves-effect red waves-green btn-flat" style="color: white;">Terminar
                consulta</a>
        </div>
    </div>

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

    <!--script src="{{ asset('js/speechtotext.js')."?v=1.17"  }}" defer></script--> <!-- Script para manejar las transcripciones speech to text de google cloud -->
    
    <script>
        var toggleStatus = false;
        var preganancy = $("#pregnancySection");

        $(document).ready(function() {
            $("#toggle").change(function() {
                toggleStatus = !toggleStatus
                console.log('toggleStatus', toggleStatus);
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
                    $("#loadanimation").removeClass("hiddenli");
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
                            $("#loadanimation").addClass("hiddenli");
                            callback()
                        },
                        success: (res) => {
                            $("#loadanimation").addClass("hiddenli");
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
            console.log("text: "+text);
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
                },
                error: function(response){
                    alert("A Ocurrido un Error!");
                },
            });
        }
    });
</script>
@endsection
