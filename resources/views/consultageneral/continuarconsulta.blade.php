@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="navigation">
            <ul class="nav nav-tabs navul" id="myTab" role="tablist">
                <li class="brandli">
                    <img class="appimg" src="{{ $paciente->sexo_id == 1? asset('img/person1.jpeg'): asset('img/person2.jpg') }}" alt="">
                    <span class="maintitle"><h6 class="brandtitle">{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</h6></span>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" data-toggle="tooltip" data-placement="right" title="Nota de Consulta">
                    <a class="nav-link active" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#consulta" type="button" role="tab" aria-controls="consulta" aria-selected="true">
                        <span class="icon my-auto"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                        <span class="title my-auto">Nota de Consulta</span>
                    </a>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" data-toggle="tooltip" data-placement="right" title="Interrogatorio">
                    <a class="nav-link {{ session('consulta_id') !== null ? '' : 'disabled' }}" id="interrogatorio-tab" data-bs-toggle="tab" data-bs-target="#interrogatorio" type="button" role="tab" aria-controls="interrogatorio" aria-selected="false">
                        <span class="icon my-auto"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <span class="title my-auto">Interrogatorio</span>
                    </a>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" data-toggle="tooltip" data-placement="right" title="Exploración Física">
                    <a class="nav-link {{ session('consulta_id') !== null ? '' : 'disabled' }}" id="exploracion-tab" data-bs-toggle="tab" data-bs-target="#exploracion" type="button" role="tab" aria-controls="exploracion" aria-selected="false">
                        <span class="icon my-auto"><i class="fa fa-sticky-note" aria-hidden="true"></i></span>
                        <span class="title my-auto">Exploración Física</span>
                    </a>
                </li>
                <hr class="menuhr">
                <li class="catli nav-item" data-toggle="tooltip" data-placement="right" title="MISECE">
                    <a class="nav-link" id="misece-tab" data-bs-toggle="tab" data-bs-target="#misece" type="button" role="tab" aria-controls="misece" aria-selected="false">
                        <span class="icon my-auto"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                        <span class="title my-auto">MISECE</span>
                    </a>
                </li>
                <hr class="specialhr">
                <li class="text-center">
                    <a href="#" onclick="terminarConsulta()" class="btn btn-success my-auto" type="button" data-toggle="tooltip" data-placement="bottom" title="Terminar y Cerrar Consulta">
                        <i class="bi bi-check2-square"></i>
                        <span class="onsmall">Teminar Consulta</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

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

            <div class="modal modal-position" id="updateconsultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mysuccess">
                        <div class="modal-body text-center text-white">
                            <span class="text-20" id="updateconsultamsg"></span>
                            <br>
                            <hr style="background-color: white">
                            Continua la consulta en las pestañas de interrogatorio y Exploración Física
                        </div>
                        <div class="modal-footer text-dark">
                        <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
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
                                    <button class="btn btn-success btn-sm" type="button" value="motivo" id="startrecmotivo">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <button class="btn btn-danger btn-sm hiddenli" type="button" id="stoprecmotivo">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <p></p>
                                    <div class="col-md-12">
                                        <textarea name="motivo" id="motivo" cols="30" rows="4" 
                                        class="form-control @error('motivo') is-invalid @enderror"
                                        value="" autocomplete="motivo" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus>{{ $consulta->motivoConsulta }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-motivo" role="alert">
                                            <strong>El campo Motivo de Consulta es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="cuadro" class="col-md-12 col-form-label">{{ __('Cuadro Clínico') }}:</label>
                                    <button class="btn btn-success btn-sm" type="button" value="motivo" id="startreccuadro">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <button class="btn btn-danger btn-sm hiddenli" type="button" id="stopreccuadro">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <p></p>
                                    <div class="col-md-12">
                                        <textarea name="cuadro" id="cuadro" cols="30" rows="4" 
                                        class="form-control @error('cuadro') is-invalid @enderror"
                                        value="" autocomplete="cuadro" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus>{{ $consulta->cuadroClinico }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-cuadro" role="alert">
                                            <strong>El campo Cuadro Clinico es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="resultados" class="col-md-12 col-form-label">{{ __('Resultados de Laboratorio y Gabinete') }}:</label>
                                    <button class="btn btn-success btn-sm" type="button" value="motivo" id="startrecres">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <button class="btn btn-danger btn-sm hiddenli" type="button" id="stoprecres">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <p></p>
                                    <div class="col-md-12 text-center">
                                        <input type="file" name="filename[]" id="filename" class="form-control" multiple accept=".doc,.docx,.pdf,.png,.jpg">
                                        <input type="hidden" id="jsonfiles" value="{{ $consulta->resultadosArchivos != null? $consulta->resultadosArchivos: "" }}">
                                        @if ($consulta->resultadosArchivos != null)
                                            <div class="border" id="filescontainer" style="margin-top: 10px">
                                                @php
                                                    $files = json_decode($consulta->resultadosArchivos);
                                                @endphp
                                                @for ($i = 0; $i < count($files); $i++)
                                                    @switch($files[$i][1])
                                                        @case('png')
                                                            <a href="{{ route('resultfile', $files[$i][0]) }}" download>
                                                                <img class="resultfile imglink" src="{{ URL::asset("/img/icons/png.png") }}"
                                                                data-toggle="tooltip" data-placement="top" title="{{ $files[$i][0] }}">
                                                            </a>
                                                            @break
                                                        @case('jpg')
                                                            <a href="{{ route('resultfile', $files[$i][0]) }}" download>
                                                                <img class="resultfile imglink" src="{{ URL::asset("/img/icons/jpg.png") }}"
                                                                data-toggle="tooltip" data-placement="top" title="{{ $files[$i][0] }}">
                                                            </a>
                                                            @break
                                                        @case('docx')
                                                            <a href="{{ route('resultfile', $files[$i][0]) }}" download>
                                                                <img class="resultfile imglink" src="{{ URL::asset("/img/icons/docx.png") }}"
                                                                data-toggle="tooltip" data-placement="top" title="{{ $files[$i][0] }}">
                                                            </a>
                                                            @break
                                                        @case('doc')
                                                            <a href="{{ route('resultfile', $files[$i][0]) }}" download>
                                                                <img class="resultfile imglink" src="{{ URL::asset("/img/icons/doc.png") }}"
                                                                data-toggle="tooltip" data-placement="top" title="{{ $files[$i][0] }}">
                                                            </a>
                                                            @break
                                                        @case('pdf')
                                                            <a href="{{ route('resultfile', $files[$i][0]) }}" download>
                                                                <img class="resultfile imglink" src="{{ URL::asset("/img/icons/pdf.png") }}"
                                                                data-toggle="tooltip" data-placement="top" title="{{ $files[$i][0] }}">
                                                            </a>
                                                            @break
                                                    @endswitch
                                                @endfor
                                            </div>
                                        @else
                                            <div class="border hiddenli" id="filescontainer" style="margin-top: 10px"></div>
                                        @endif
                                        <textarea name="resultados" id="resultados" cols="30" rows="4" style="margin-top: 10px" 
                                        class="form-control @error('resultados') is-invalid @enderror"
                                        value="" autocomplete="resultados" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus>{{ $consulta->resultadosLaboratorioGabinete }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-resultados" role="alert">
                                            <strong>El campo Resultados de Laboratorio es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <div class="col-md-4">
                                    <label for="diagnostico" class="col-md-12 col-form-label">{{ __('Diagnósticos o Problemas Clínicos') }}:</label>
                                    <button class="btn btn-success btn-sm" type="button" value="motivo" id="startrecdiag">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <button class="btn btn-danger btn-sm hiddenli" type="button" id="stoprecdiag">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <p></p>
                                    <div class="col-md-12">
                                        <input class="form-control selectize" id="select-diag" name="select-diag" value="{{ $consulta->diag_id != null? $consulta->diag_name : "" }}">
                                        <input type="hidden" id="real-select-diag" name="real-select-diag" value="{{ $consulta->diag_id != null? $consulta->diag_id : "" }}">
                                        <p></p>
                                        <textarea name="diagnostico" id="diagnostico" cols="30" rows="4" 
                                        class="form-control @error('diagnostico') is-invalid @enderror"
                                        value="" autocomplete="diagnostico" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus>{{ $consulta->diagnosticoProblemasClinicos }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-diagnostico" role="alert">
                                            <strong>El campo Diagnósticos o problemas Clínicos es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="pronostico" class="col-md-12 col-form-label">{{ __('Pronóstico') }}:</label>
                                    <button class="btn btn-success btn-sm" type="button" value="motivo" id="startrecpron">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <button class="btn btn-danger btn-sm hiddenli" type="button" id="stoprecpron">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <p></p>
                                    <div class="col-md-12">
                                        <textarea name="pronostico" id="pronostico" cols="30" rows="4" 
                                        class="form-control @error('pronostico') is-invalid @enderror"
                                        value="" autocomplete="pronostico" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus>{{ $consulta->pronostico }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-pronostico" role="alert">
                                            <strong>El campo Pronóstico es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="indicacion" class="col-md-12 col-form-label">{{ __('Indicación Terapéutica') }}:</label>
                                    <button class="btn btn-success btn-sm" type="button" value="motivo" id="startrecindica">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <button class="btn btn-danger btn-sm hiddenli" type="button" id="stoprecindica">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                    <p></p>
                                    <div class="col-md-12">
                                        <textarea name="indicacion" id="indicacion" cols="30" rows="4" 
                                        class="form-control @error('indicacion') is-invalid @enderror"
                                        value="" autocomplete="indicacion" maxlength="255"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                        autofocus>{{ $consulta->indicacionTerapeutica }}</textarea>

                                        <span class="invalid-feedback error-msg" id="error-indicacion" role="alert">
                                            <strong>El campo Indicación Terapéutica es Obligatorio</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="form-group row text-center">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div id="consultasubmit" class="form-group row mb-0 {{ session('consulta_id') !== null ? 'hiddenli' : '' }}">
                                        <div class="col-md-12">
                                            <a onclick="subformbutton()" class="btn btn-primary" role="button">
                                                {{ __('Guardar Nota de Consulta') }}
                                            </a>
                                        </div>
                                    </div>
        
                                    <div id="consultaupdate" class="form-group row mb-0 {{ session('consulta_id') !== null ? '' : 'hiddenli' }}">
                                        <div class="col-md-12">
                                            <a onclick="updateformbutton()" class="btn btn-success" role="button">
                                                {{ __('Actualizar Nota de Consulta') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <!--
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <a href="{{ route('sessionone') }}" class="btn btn-primary" role="button">
                                        {{ __('set consulta') }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <a href="{{ route('sessionone') }}" class="btn btn-primary" role="button">
                                        {{ __('set consulta') }}
                                    </a>
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <a onclick="testbutton()" class="btn btn-primary" role="button">
                                        {{ __('Test alerta!') }}
                                    </a>
                                </div>
                            </div>
                            
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <a href="{{ route('testfunc') }}" class="btn btn-primary" role="button">
                                        {{ __('show session Id') }}
                                    </a>
                                </div>
                            </div>
                            <br>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-5 offset-md-5">
                                    <a href="{{ route('deletesession') }}" class="btn btn-primary" role="button">
                                        {{ __('Delete Session') }}
                                    </a>
                                </div>
                            </div>
                            -->
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
                                        <div class="form-check col-md-6">
                                            <div class="col-md-12 row">
                                                <label for="grupo" class="col-md-4 col-sm-6 col-form-label text-md-left">{{ __('Grupo Étnico') }}:</label>
                                                <div class="col-md-6">
                                                    <select class="browser-default custom-select form-control @error('grupo') is-invalid @enderror" 
                                                    autocomplete="off" id="grupo" name="grupo">
                                                        @if ($grupos->count() == 0)
                                                            <option value="0" selected>--- No se encontraron Grupos Étnicos ---</option>
                                                        @else
                                                            @if ($anteHF->grupo_id == 0)
                                                                <option selected>--- Selecciona una Opción ---</option>
                                                                @foreach ($grupos as $grupo)
                                                                    <option value="{{ $grupo->id }}">{{ $grupo->lenguaIndigena }}</option>
                                                                @endforeach
                                                            @else
                                                                <option>--- Selecciona una Opción ---</option>
                                                                @foreach ($grupos as $grupo)
                                                                    <option value="{{ $grupo->id }}" {{ $grupo->id == $anteHF->grupo_id? "selected": "" }}>{{ $grupo->lenguaIndigena }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                        
                                                    </select>
                                                    <span class="invalid-feedback error-msg" id="error-grupo" role="alert">
                                                        <strong>El campo Grupo Étnico es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 
                                    <div class="form-group row">
                                        <label for="padecimiento" class="col-md-4 col-form-label text-md-right offset-md-1">{{ __('Padecimiento Actual') }}:</label>
            
                                        <div class="col-md-5">
                                            <input id="padecimiento" type="text"
                                            class="form-control @error('padecimiento') is-invalid @enderror" name="padecimiento"
                                            value="{{ $inter->padecimientoActual }}" autocomplete="padecimiento" maxlength="255" 
                                            onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>
        
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
                                                value="diabetes" {{ $anteHF->diabetes == 1? "checked": "" }} autofocus>
                                                <label for="diabetes" class="col-form-label">{{ __('Diabetes') }}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="checkinput" id="neoplasias" type="checkbox"
                                                class="form-control @error('neoplasias') is-invalid @enderror" name="neoplasias"
                                                value="neoplasias" {{ $anteHF->neoplasias == 1? "checked": "" }} autofocus>
                                                <label for="neoplasias" class=" col-form-label">{{ __('Neoplasias') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="cardiopatias" type="checkbox"
                                                class="form-control @error('cardiopatias') is-invalid @enderror" name="cardiopatias"
                                                value="cardiopatias" {{ $anteHF->cardiopatias == 1? "checked": "" }} autofocus>
                                                <label for="cardiopatias" class=" col-form-label">{{ __('Cardiopatías') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="parkinson" type="checkbox"
                                                class="form-control @error('parkinson') is-invalid @enderror" name="parkinson"
                                                value="parkinson"  {{ $anteHF->parkinson == 1? "checked": "" }} autofocus>
                                                <label for="parkinson" class=" col-form-label">{{ __('Parkinson') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="depresion" type="checkbox"
                                                class="form-control @error('depresion') is-invalid @enderror" name="depresion"
                                                value="depresion" {{ $anteHF->depresion == 1? "checked": "" }} autofocus>
                                                <label for="depresion" class=" col-form-label">{{ __('Depresión') }}:</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="colestasis" type="checkbox"
                                                class="form-control @error('colestasis') is-invalid @enderror" name="colestasis"
                                                value="colestasis"  {{ $anteHF->colestasis == 1? "checked": "" }} autofocus>
                                                <label for="colestasis" class=" col-form-label">{{ __('Colestasis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="endocrinas" type="checkbox"
                                                class="form-control @error('endocrinas') is-invalid @enderror" name="endocrinas"
                                                value="endocrinas"  {{ $anteHF->enfermedadesEndocrinas == 1? "checked": "" }} autofocus>
                                                <label for="endocrinas" class=" col-form-label">{{ __('Enfermedades Endocrinas') }}</label>
                                            </div>
            
                                        </div>

                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="hipertension" type="checkbox"
                                                class="form-control" name="hipertension"
                                                value="hipertension" {{ $anteHF->hipertension == 1? "checked": "" }} autofocus>
                                                <label for="hipertension" class=" col-form-label ">{{ __('Hipertensión') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="tuberculosis" type="checkbox"
                                                class="form-control @error('tuberculosis') is-invalid @enderror" name="tuberculosis"
                                                value="tuberculosis" {{ $anteHF->tuberculosis == 1? "checked": "" }} autofocus>
                                                <label for="tuberculosis" class=" col-form-label">{{ __('Tuberculosis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="alzheimer" type="checkbox"
                                                class="form-control @error('alzheimer') is-invalid @enderror" name="alzheimer"
                                                value="alzheimer" {{ $anteHF->alzheimer == 1? "checked": "" }} autofocus>
                                                <label for="alzheimer"  class=" col-form-label">{{ __('Alzheimer') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="esclerosis" type="checkbox"
                                                class="form-control @error('esclerosis') is-invalid @enderror" name="esclerosis"
                                                value="esclerosis" {{ $anteHF->esclerosisMultiple == 1? "checked": "" }} autofocus>
                                                <label for="esclerosis"  class=" col-form-label">{{ __('Esclerosis Múltiple') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="esquizofrenia" type="checkbox"
                                                class="form-control @error('esquizofrenia') is-invalid @enderror" name="esquizofrenia"
                                                value="esquizofrenia" {{ $anteHF->esquizofrenia == 1? "checked": "" }} autofocus>
                                                <label for="esquizofrenia" class=" col-form-label">{{ __('Esquizofrenia') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="hepatitis" type="checkbox"
                                                class="form-control @error('hepatitis') is-invalid @enderror" name="hepatitis"
                                                value="hepatitis" {{ $anteHF->hepatitis == 1? "checked": "" }} autofocus>
                                                <label for="hepatitis" class=" col-form-label">{{ __('Hepatitis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="geneticas" type="checkbox"
                                                class="form-control @error('geneticas') is-invalid @enderror" name="geneticas"
                                                value="geneticas" {{ $anteHF->enfermedadesGeneticas == 1? "checked": "" }} autofocus>
                                                <label for="geneticas" class=" col-form-label">{{ __('Enfermedades Genéticas') }}</label>
                                            </div>

                                            
                                        </div>

                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="dislipidemias" type="checkbox"
                                                class="form-control" name="dislipidemias"
                                                value="dislipidemias" {{ $anteHF->dislipidemias == 1? "checked": "" }} autofocus>
                                                <label for="dislipidemias"  class=" col-form-label">{{ __('Dislipidemias') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="artritis" type="checkbox"
                                                class="form-control @error('artritis') is-invalid @enderror" name="artritis"
                                                value="artritis" {{ $anteHF->artritis == 1? "checked": "" }} autofocus>
                                                <label for="artritis" class=" col-form-label">{{ __('Artritis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="epilepsia" type="checkbox"
                                                class="form-control @error('epilepsia') is-invalid @enderror" name="epilepsia"
                                                value="epilepsia"  {{ $anteHF->epilepsia == 1? "checked": "" }} autofocus>
                                                <label for="epilepsia" class=" col-form-label">{{ __('Epilepsia') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="trastorno" type="checkbox"
                                                class="form-control @error('trastorno') is-invalid @enderror" name="trastorno"
                                                value="trastorno" {{ $anteHF->trastornoAnsiedad == 1? "checked": "" }} autofocus>
                                                <label for="trastorno" class=" col-form-label">{{ __('Trastorno de Ansiedad') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="cirrosis" type="checkbox"
                                                class="form-control @error('cirrosis') is-invalid @enderror" name="cirrosis"
                                                value="cirrosis" {{ $anteHF->Cirrosis == 1? "checked": "" }} autofocus>
                                                <label for="cirrosis" class=" col-form-label">{{ __('Cirrosis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="alergias" type="checkbox"
                                                class="form-control @error('alergias') is-invalid @enderror" name="alergias"
                                                value="alergias" {{ $anteHF->alergias == 1? "checked": "" }} autofocus>
                                                <label for="alergias" class=" col-form-label">{{ __('Alergias') }}</label>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row text-left">
                                        <div class="col-md-12 row">
                                            <label for="otroshf" class="col-form-label">{{ __('Otros') }}:</label>
            
                                            <div class="col-md-3 col-sm-6">
                                                <input id="otroshf" type="text"
                                                class="form-control @error('otroshf') is-invalid @enderror" name="otroshf"
                                                value="{{ $anteHF->otroshf }}" autocomplete="otroshf" maxlength="255" 
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>
                                            </div>
                                        </div>

                                        <div class="col-md-4 row"></div>
                                        
                                        <div class="col-md-4 row"></div>
                                        
                                    </div>
        
                                    <br>
            
                                    <div class="form-group col-md-12 text-center">
                                        <div class="col-md-8 offset-md-2">
                                            <div id="antehrsubmit" class="row mb-0 {{ session('anteHF_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeantecedenteshf()" class="btn btn-primary" role="button">
                                                        {{ __('Guardar Antecedesntes Heredo - Familiares') }}
                                                    </a>
                                                </div>
                                            </div>
        
                                            <div id="antehrupdate" class="form-group row mb-0 {{ session('anteHF_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateantecedenteshf()" class="btn btn-success" role="button">
                                                        {{ __('Actualizar Antecedesntes Heredo - Familiares') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
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
                                                value="" autocomplete="infectacontagiosa" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->enfermedadInfectaContagiosa }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="cronicodegenerativa" class="col-md-12 col-form-label">{{ __('Enfermedad Crónico Degenerativa') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cronicodegenerativa" id="cronicodegenerativa" cols="30" rows="3" 
                                                class="form-control @error('cronicodegenerativa') is-invalid @enderror"
                                                value="" autocomplete="cronicodegenerativa" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->enfermedadCronicaDegenerativa }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="traumatologicos" class="col-md-12 col-form-label">{{ __('Traumatológicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="traumatologicos" id="traumatologicos" cols="30" rows="3" 
                                                class="form-control @error('traumatologicos') is-invalid @enderror"
                                                value="" autocomplete="traumatologicos" maxlength="255"
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
                                                value="" autocomplete="alergicos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->alergicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="quirurgicos" class="col-md-12 col-form-label">{{ __('Quirúrgicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="quirurgicos" id="quirurgicos" cols="30" rows="3" 
                                                class="form-control @error('quirurgicos') is-invalid @enderror"
                                                value="" autocomplete="quirurgicos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->quirurgicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="hospitalizaciones" class="col-md-12 col-form-label">{{ __('Hospitalizaciones Previas') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="hospitalizaciones" id="hospitalizaciones" cols="30" rows="3" 
                                                class="form-control @error('hospitalizaciones') is-invalid @enderror"
                                                value="" autocomplete="hospitalizaciones" maxlength="255"
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
                                                value="" autocomplete="transfusiones" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->transfusiones }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="toxicomanias" class="col-md-12 col-form-label">{{ __('Toxicomanías') }}:</label>
            
                                            <div class="col-md-12">
                                                <select class="form-control" name="multiselecttoxic" id="multiselecttoxic">
                                                    <option value="1">Depresoras</option>
                                                    <option value="2">Estimulantes</option>
                                                    <option value="3">Alucinógenos/Psicodélicos</option>
                                                    <option value="4">Cannabis</option>
                                                    <option value="5">Inhalantes</option>
                                                </select>
                                                @if ($antePP->toxicomaniasAlcoholismo != null)
                                                    @foreach (json_decode($antePP->toxicomaniasAlcoholismo) as $toxico)
                                                        <input type="hidden" id="toxicoinput[]" name="toxicoinput[]" value="{{ $toxico }}">
                                                    @endforeach
                                                @else
                                                    <input type="hidden" id="toxicoinput[]" name="toxicoinput[]" value="">
                                                @endif
                                                
                                                
                                                <!-- Aterior textarea
                                                <textarea name="toxicomanias" id="toxicomanias" cols="30" rows="3" 
                                                class="form-control @error('toxicomanias') is-invalid @enderror"
                                                value="" autocomplete="toxicomanias" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->toxicomaniasAlcoholismo }}</textarea>
                                                -->
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospp" class="col-md-12 col-form-label">{{ __('Otros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="otrospp" id="otrospp" cols="30" rows="3" 
                                                class="form-control @error('otrospp') is-invalid @enderror"
                                                value="" autocomplete="otrospp" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->otros }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
        
                                    <br>
                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                            <div id="antePPsubmit" class="form-group row mb-0 {{ session('antePP_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeantecedentespp()" class="btn btn-primary" role="button">
                                                        {{ __('Guardar Antecedentes Personales Patológicos') }}
                                                    </a>
                                                </div>
                                            </div>
        
                                            <div id="antePPupdate" class="form-group row mb-0 {{ session('antePP_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateantecedentespp()" class="btn btn-success" role="button">
                                                        {{ __('Actualizar Antecedentes Personales Patológicos') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                value="" autocomplete="vivienda" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->vivienda }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="higiene" class="col-md-12 col-form-label">{{ __('Higiene') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="higiene" id="higiene" cols="30" rows="3" 
                                                class="form-control @error('higiene') is-invalid @enderror"
                                                value="" autocomplete="higiene" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->higiene }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="dieta" class="col-md-12 col-form-label">{{ __('Dieta') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="dieta" id="dieta" cols="30" rows="3" 
                                                class="form-control @error('dieta') is-invalid @enderror"
                                                value="" autocomplete="dieta" maxlength="255"
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
                                                value="" autocomplete="zoonosis" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->zoonosis }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospnp" class="col-md-12 col-form-label">{{ __('Otros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="otrospnp" id="otrospnp" cols="30" rows="3" 
                                                class="form-control @error('otrospnp') is-invalid @enderror"
                                                value="" autocomplete="otrospnp" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->otros }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            
                                        </div>
                                        
                                    </div>
        
                                    <br>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="antePNPsubmit" class="form-group row mb-0 {{ session('antePNP_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeantecedentespnp()" class="btn btn-primary" role="button">
                                                        {{ __('Guardar Antecedentes Personales No Patológicos') }}
                                                    </a>
                                                </div>
                                            </div>
                    
                                            <div id="antePNPupdate" class="form-group row mb-0 {{ session('antePNP_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateantecedentespnp()" class="btn btn-success" role="button">
                                                        {{ __('Actualizar Antecedentes Personales No Patológicos') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
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
                                                value="" autocomplete="signos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->signosYsintomas }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cardiovascular" class="col-md-12 col-form-label">{{ __('Aparato Cardiovascular') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cardiovascular" id="cardiovascular" cols="30" rows="3" 
                                                class="form-control @error('cardiovascular') is-invalid @enderror"
                                                value="" autocomplete="cardiovascular" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoCardiovascular }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="respiratorio" class="col-md-12 col-form-label">{{ __('Aparato Respiratorio') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="respiratorio" id="respiratorio" cols="30" rows="3" 
                                                class="form-control @error('respiratorio') is-invalid @enderror"
                                                value="" autocomplete="respiratorio" maxlength="255"
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
                                                value="" autocomplete="digestivo" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoDigestivo }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nefro" class="col-md-12 col-form-label">{{ __('Sistema Nefrourologico') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="nefro" id="nefro" cols="30" rows="3" 
                                                class="form-control @error('nefro') is-invalid @enderror"
                                                value="" autocomplete="nefro" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaNefro }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="endocrino" class="col-md-12 col-form-label">{{ __('Sistema Endocrino y Metabolismo') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="endocrino" id="endocrino" cols="30" rows="3" 
                                                class="form-control @error('endocrino') is-invalid @enderror"
                                                value="" autocomplete="endocrino" maxlength="255"
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
                                                value="" autocomplete="hematopoyetico" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaHemato }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nervioso" class="col-md-12 col-form-label">{{ __('Sistema Nervioso') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="nervioso" id="nervioso" cols="30" rows="3" 
                                                class="form-control @error('nervioso') is-invalid @enderror"
                                                value="" autocomplete="nervioso" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaNervioso }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="musculo" class="col-md-12 col-form-label">{{ __('Sistema Musculo Esquelético') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="musculo" id="musculo" cols="30" rows="3" 
                                                class="form-control @error('musculo') is-invalid @enderror"
                                                value="" autocomplete="musculo" maxlength="255"
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
                                                value="" autocomplete="piel" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->pielYtegumentos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="sentidos" class="col-md-12 col-form-label">{{ __('Órganos de los Sentidos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="sentidos" id="sentidos" cols="30" rows="3" 
                                                class="form-control @error('sentidos') is-invalid @enderror"
                                                value="" autocomplete="sentidos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->organosSentidos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="psiquica" class="col-md-12 col-form-label">{{ __('Esfera Psíquica') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="psiquica" id="psiquica" cols="30" rows="3" 
                                                class="form-control @error('psiquica') is-invalid @enderror"
                                                value="" autocomplete="psiquica" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->esferaPsiquica }}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
        
                                    <br>
                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="aparatossubmit" class="form-group row mb-0 {{ session('interAS_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeaparatos()" class="btn btn-primary" role="button">
                                                        {{ __('Guardar Aparatos y Sistemas') }}
                                                    </a>
                                                </div>
                                            </div>
                    
                                            <div id="aparatosupdate" class="form-group row mb-0 {{ session('interAS_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateaparatos()" class="btn btn-success" role="button">
                                                        {{ __('Actualizar Aparatos y Sistemas') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                value="" autocomplete="habitus" maxlength="255"
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
                                                    title="El Peso es una cantidad númerica." autofocus>
                
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
                                                    onkeypress="return /[0-9]/i.test(event.key)"
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
                                                value="" autocomplete="cabeza" maxlength="255"
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
                                                value="" autocomplete="cuello" maxlength="255"
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
                                                value="" autocomplete="torax" maxlength="255"
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
                                                value="" autocomplete="abdomen" maxlength="255"
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
                                                value="" autocomplete="miembros" maxlength="255"
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
                                                value="" autocomplete="genitales" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $exploracion->genitales }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Genitales es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
        
                                    <br>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="exploracionsubmit" class="form-group row mb-0 {{ session('explo_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeexploracion()" class="btn btn-primary" role="button">
                                                        {{ __('Guardar Exploración Física') }}
                                                    </a>
                                                </div>
                                            </div>
                    
                                            <div id="exploracionupdate" class="form-group row mb-0 {{ session('explo_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateexploracion()" class="btn btn-success" role="button">
                                                        {{ __('Actualizar Exploración Física') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <input id="price" type="text" class="form-control"
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
                                                    <input id="sistolica" type="text" class="form-control"
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
                                                    <input id="diastolica" type="text" class="form-control"
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
                                                    <input id="frecuenciacardiaca" type="text" class="form-control"
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
                                                    <input id="frecuenciarespiratoria" type="text" class="form-control"
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

                                    <div class="form-group row text-center">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div id="signossubmit" class="form-group row mb-0 {{ session('signos_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storesignos()" class="btn btn-primary" role="button">
                                                        {{ __('Guardar Signos Vitales Física') }}
                                                    </a>
                                                </div>
                                            </div>
                    
                                            <div id="signosupdate" class="form-group row mb-0 {{ session('signos_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updatesignos()" class="btn btn-success" role="button">
                                                        {{ __('Actualizar Signos Vitales') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!------ ------->
            <!-- TAB de MISECE -->
            <!------ ------->

            <div class="tab-pane fade" id="misece" role="tabpanel" aria-labelledby="misece-tab">
                <div class="card text-center">
                    <div class="card-header">
                        Consulta del Expediente clínico Electrónico del paciente <strong>{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</strong>
                    </div>
                    <div class="card-body text-center">
                        <label for="">Introduce el código del paciente</label>
                        <br>
                        <div>
                            <div class="col-md-3 mx-auto">
                                <input class="form-control form-control-sm" type="text" id="patientcode" name="patientcode" value="">
                            </div>
                            <br>
                            <button class="btn btn-sm btn-success" type="button" onclick="patientece('{{ $paciente->curp }}')">Consultar ECE</button>
                        </div>
                        <br><br>
                        <div id="ece-content">
                            <iframe id="iframecontent" src="" type="text/html" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    
    jQuery(function ($) {

        $("#showfiles").click(function(){ 
            console.log("inside showfiles");
            var files = $('#filename');
            console.log(files);
        });
    });

    $(function(){
        $(".selectize").selectize({
            maxItems: 1,
            valueField: 'id',
            labelField: ['term'],
            searchField: ['term'],
            create: false,

            load: (query, callback) => {
                if(!query.length) return callback();
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
                    error: () => callback(),
                    success:(res) => callback(res)
                });
            },

            render: {
                option: (item, escape) => {
                    return '<p>'+item.term+'</p>'
                }
            }
        });
        
        var option = "{{ @$consulta->diag_id }}";
        var name = "{{ @$consulta->diag_name }}";

        if(option != null){
            
            var selectize = $('.selectize')[0].selectize; // This stores the selectize object to a variable (with name 'selectize')

            // 2. Access the selectize object with methods later, for ex:
            selectize.addOption({value: option, text: name});
            //selectize.addItem(option);
        }

        var $multitoxic = $("#multiselecttoxic").selectize({
            plugins: ["remove_button"],
            delimiter: ",",
            placeholder: "Selecciona una opción",
            persist: false,
            maxItems: 5,
        });

        var selectizetoxic = $multitoxic[0].selectize;
        selectizetoxic.clear();

        var toxicarray = document.getElementsByName('toxicoinput[]');

        toxicarray.forEach(element =>{
            selectizetoxic.addItem(element.value, true);
            console.log("item: "+element.value);
        });

    });
</script>

@endsection
