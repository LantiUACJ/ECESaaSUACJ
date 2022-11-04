<div class="container-fluid">
    <div class="container-fluid">
        <div class="navigation">
            <ul class="nav nav-tabs navul" id="myTab" role="tablist">
                <li class="brandli">
                    <img class="appimg" src="{{ $paciente->sexo->numero == 1? asset('img/person1.jpeg'): asset('img/person2.jpg') }}" alt="">
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
                        <span class="terminartitle">Teminar Consulta</span>
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

            <!-- Spinning modal -->
            <div class="modal fade bd-example-modal-lg" id="spinningmodal" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="width: 48px">
                        <span class="fa fa-spinner fa-spin fa-4x mx-auto"></span>
                    </div>
                </div>
            </div>

            <!--------- Consulta Success --------->
            <div class="modal modal-position" id="consultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mysuccess">
                        <div class="modal-body text-center text-white">
                            <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            <span class="text-20" id="consultamsg"></span>
                            <br>
                            <hr style="background-color: white">
                            Las pestañas de interrogatorio y Exploración Física han sido desbloqueadas!!
                        </div>
                        <div class="modal-footer text-dark">
                        <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- Consulta Success --------->
            <div class="modal modal-position" id="consultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mysuccess">
                        <div class="modal-body text-center text-white">
                            <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            <span class="text-20" id="consultamsg"></span>
                            <br>
                            <hr style="background-color: white">
                            Las pestañas de interrogatorio y Exploración Física han sido desbloqueadas!!
                        </div>
                        <div class="modal-footer text-dark">
                        <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-position" id="updateconsultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mysuccess">
                        <div class="modal-body text-center text-white">
                            <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
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
                    <div class="modal-content bg-mydanger">
                        <div class="modal-body text-center text-white">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            <span class="text-20" id="errormsg">Error</span>
                        </div>
                        <div class="modal-footer text-dark">
                        <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-position" id="intermodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mysuccess">
                        <div class="modal-body text-center text-white">
                            <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            <span class="text-20" id="intermsg">Mensaje</span>
                        </div>
                        <div class="modal-footer text-dark">
                        <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-position" id="explomodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mysuccess">
                        <div class="modal-body text-center text-white">
                            <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            <span class="text-20" id="explomsg">Mensaje</span>
                        </div>
                        <div class="modal-footer text-dark">
                        <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- Consulta Terminada --------->
            <div class="modal modal-position" id="terminarmodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-primary">
                        <div class="text-20 modal-body text-center text-white">
                            Asegúrate que todos los cambios esten guardados correctamente. ¿Estas seguro que quieres terminar la consulta?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light text-dark mx-auto" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('terminarConsulta') }}" role="button" class="btn btn-danger mx-auto" >Terminar Consulta</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- No Consulta --------->
            <div class="modal modal-position" id="noConsultamodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mydanger">
                        <div class="text-20 modal-body text-center text-white">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            ¡La consulta no ha sido guardada!
                        </div>
                        <div class="modal-footer text-dark">
                            <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------- No Interrogatorio --------->
            <div class="modal modal-position" id="noIntermodal" tabindex="-1" role="dialog" aria-labelledby="SuccessModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-mydanger">
                        <div class="text-20 modal-body text-center text-white">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 3.5em"></i>
                            <br style="margin-bottom: 10px">
                            ¡No hay interrogatorio registrado para el paciente!
                            <br>
                        </div>
                        <div class="modal-footer text-dark">
                            <button type="button" class="btn btn-light mx-auto" data-bs-dismiss="modal">Cerrar</button>
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
            @if (session('consulta_id') !== null)
                <input type="hidden" id="consulta_id" value="{{ session('consulta_id') }}">
            @else
                <input type="hidden" id="consulta_id" value="">
            @endif
            

            <!-- Id del medico (probablemente inecesario ya que podria obtenerse de auth o user) -->
            <input type="hidden" id="medico_id" value="">

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
                            <input class="pacinput" id="fechanac" type="text"  value="{{ date('d/m/Y', strtotime($paciente->fechaNacimiento)) }}" autocomplete="fechanac" maxlength="255" disabled autofocus>
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

            <div class="tab-pane fade show active" id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="mySecTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tabtitle active" id="datosconsulta-tab" data-bs-toggle="tab" data-bs-target="#datosconsulta" type="button" role="tab" aria-controls="datosconsulta" aria-selected="false">
                                    <span class="icon my-auto"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                    <span class="my-auto">Nota de la consulta</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="mySecTabContent">
                            <div class="tab-pane fade show active" id="datosconsulta" role="tabpanel" aria-labelledby="datosconsulta-tab">
                                <form method="POST" id="storeconsulta">
                                    @csrf
        
                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="motivo" class="col-md-12 col-form-label">{{ __('Motivo de la Consulta') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo" id="startrecmotivo">&nbsp;&nbsp;<i class="fa fa-microphone" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button" id="stoprecmotivo">&nbsp;&nbsp;<i class="fa fa-microphone-slash" aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12">
                                                <textarea name="motivo" id="motivo" cols="30" rows="2" 
                                                class="form-control @error('motivo') is-invalid @enderror"
                                                value="" autocomplete="motivo" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('motivo') }}</textarea>
        
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
                                                <textarea name="cuadro" id="cuadro" cols="30" rows="2" 
                                                class="form-control @error('cuadro') is-invalid @enderror"
                                                value="" autocomplete="cuadro" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('cuadro') }}</textarea>
        
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
        
                                                <!--   Prueba para mostrar multiples input files Pospuesto por el momento 
        
                                                <div class="input-group hdtuto control-group lst increment" >
                                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                                    <div class="input-group-btn"> 
                                                      <button class="btn btn-success btn-mysuccess" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                                    </div>
                                                </div>
                                              
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                      <input type="file" name="filenames[]" class="myfrm form-control">
                                                      <div class="input-group-btn"> 
                                                        <button class="btn btn-danger btn-mydanger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                                      </div>
                                                    </div>
                                                </div>
        
                                                -->
        
                                                <input type="file" name="filename[]" id="filename" class="form-control" multiple accept=".doc,.docx,.pdf,.png,.jpg">
                                                <input type="hidden" id="jsonfiles" value="">
                                                
                                                <div class=" border" id="filescontainer" style="margin-top: 10px; margin-bottom: 10px">
                                                </div>

                                                <textarea name="resultados" id="resultados" cols="30" rows="2" 
                                                class="form-control @error('resultados') is-invalid @enderror"
                                                value="" autocomplete="resultados" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('resultados') }}</textarea>
        
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
                                                <div class="input-group">
                                                    <input class="form-control selectize" id="select-diag" name="select-diag">
                                                    <div class="input-group-append">
                                                        <div class="loader hiddenli" id="loadanimation">
                                                            <div class="inner one"></div>
                                                            <div class="inner two"></div>
                                                            <div class="inner three"></div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                
                                                <p></p>
        
                                                <textarea name="diagnostico" id="diagnostico" cols="30" rows="2" 
                                                class="form-control @error('diagnostico') is-invalid @enderror"
                                                value="" autocomplete="diagnostico" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('diagnostico') }}</textarea>
        
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
                                                <textarea name="pronostico" id="pronostico" cols="30" rows="2" 
                                                class="form-control @error('pronostico') is-invalid @enderror"
                                                value="" autocomplete="pronostico" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('pronostico') }}</textarea>
        
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
                                                <textarea name="indicacion" id="indicacion" cols="30" rows="2" 
                                                class="form-control @error('indicacion') is-invalid @enderror"
                                                value="" autocomplete="indicacion" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('indicacion') }}</textarea>
        
                                                <span class="invalid-feedback error-msg" id="error-indicacion" role="alert">
                                                    <strong>El campo Indicación Terapéutica es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if ($paciente->sexo->numero == 2 && ($years >= 9 && $years <= 59))
                                        <br>
                                        <hr>
                                        <br>
                                        <label for="ispregnant" class="col-form-label">
                                            <input type="checkbox" id="ispregnant" name="ispregnant" onclick="collapsPreg()">
                                            Consulta por Embarazo
                                        </label>

                                        <div id="pregContainer" class="hiddenli">
                                            <div class="card-body row">
                                                <div class="form-group text-left col-md-6">
                                                    <div>
                                                        <label for="consultaembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Primera Consulta por embarazo?') }}</strong></label>
                                                        <div class="form-check col-md-10 mx-right">
                                                            <input type="radio" name="consultaembarazo" id="consultaembarazo1" value="0" disabled>
                                                            <label for="consultaembarazo1">Primera Vez</label>
                                                            <br>
                                                            <input type="radio" name="consultaembarazo" id="consultaembarazo2" value="1" disabled>
                                                            <label for="consultaembarazo2">Subsecuente</label>
                                                            <span class="invalid-feedback error-msg" id="error-consultaembarazo" role="alert">
                                                                <strong>El campo Consulta por Embarazo es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="trimestreembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿En qué Trimestre Gestacional se encuentra?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="trimestreembarazo" id="trimestreembarazo1" value="0" disabled>
                                                            <label for="trimestreembarazo1">Primer Trimestre</label>
                                                            <br>
                                                            <input type="radio" name="trimestreembarazo" id="trimestreembarazo2" value="1" disabled> 
                                                            <label for="trimestreembarazo2">Segundo Trimestre</label>
                                                            <br>
                                                            <input type="radio" name="trimestreembarazo" id="trimestreembarazo3" value="2" disabled>
                                                            <label for="trimestreembarazo3">Tercer Trimestre</label> 
                                                            <span class="invalid-feedback error-msg" id="error-trimestreembarazo" role="alert">
                                                                <strong>El campo Trimestre Gestacional es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="riesgoembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Es de Alto Riesgo?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="riesgoembarazo" id="riesgoembarazo1" value="0" disabled>
                                                            <label for="riesgoembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="riesgoembarazo" id="riesgoembarazo2" value="1" disabled>
                                                            <label for="riesgoembarazo2">Si</label>   
                                                            <span class="invalid-feedback error-msg" id="error-riesgoembarazo" role="alert">
                                                                <strong>El campo Alto Riesgo es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="diabetesembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicación por Diabetes?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="diabetesembarazo" id="diabetesembarazo1" value="0" disabled>
                                                            <label for="diabetesembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="diabetesembarazo" id="diabetesembarazo2" value="1" disabled>
                                                            <label for="diabetesembarazo2">Si</label>             
                                                            <span class="invalid-feedback error-msg" id="error-diabetesembarazo" role="alert">
                                                                <strong>El campo Complicación por Diabetes es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="infeccionembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicación por Infeccion Urinaria?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="infeccionembarazo" id="infeccionembarazo1" value="0" disabled>
                                                            <label for="infeccionembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="infeccionembarazo" id="infeccionembarazo2" value="1" disabled>
                                                            <label for="infeccionembarazo2">Si</label>          
                                                            <span class="invalid-feedback error-msg" id="error-infeccionembarazo" role="alert">
                                                                <strong>El campo Complicación por Infeccion Urinaria es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="form-group text-left col-md-6">
                                                    <div>
                                                        <label for="preclampsiaembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicacion por PreeclampsiaEclampsia?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="preclampsiaembarazo" id="preclampsiaembarazo1" value="0" disabled>
                                                            <label for="preclampsiaembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="preclampsiaembarazo" id="preclampsiaembarazo2" value="1" disabled>
                                                            <label for="preclampsiaembarazo2">Si</label>            
                                                            <span class="invalid-feedback error-msg" id="error-preclampsiaembarazo" role="alert">
                                                                <strong>El campo Complicacion por PreeclampsiaEclampsia es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="hemorragiaembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicación por Hemorragia?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="hemorragiaembarazo" id="hemorragiaembarazo1" value="0" disabled>
                                                            <label for="hemorragiaembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="hemorragiaembarazo" id="hemorragiaembarazo2" value="1" disabled>
                                                            <label for="hemorragiaembarazo2">Si</label>           
                                                            <span class="invalid-feedback error-msg" id="error-hemorragiaembarazo" role="alert">
                                                                <strong>El campo Complicación por Hemorragia es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="sospechacovidembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Se Sospecha que la paciente tiene Covid-19?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="sospechacovidembarazo" id="sospechacovidembarazo1" value="0" disabled>
                                                            <label for="sospechacovidembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="sospechacovidembarazo" id="sospechacovidembarazo2" value="1" disabled>
                                                            <label for="sospechacovidembarazo2">Si</label>             
                                                            <span class="invalid-feedback error-msg" id="error-infeccionembarazo" role="alert">
                                                                <strong>El campo Sospecha Covid-19 es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="confirmacioncovidembarazo" class="col-md-12 col-form-label"><strong>{{ __('¿Se Confirma Covid-19?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="confirmacioncovidembarazo" id="confirmacioncovidembarazo1" value="0" disabled>
                                                            <label for="confirmacioncovidembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="confirmacioncovidembarazo" id="confirmacioncovidembarazo2" value="1" disabled>
                                                            <label for="confirmacioncovidembarazo2">Si</label>          
                                                            <span class="invalid-feedback error-msg" id="error-confirmacioncovidembarazo" role="alert">
                                                                <strong>El campo Confirmacion Covid-19 es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    @else
                                        <input class="hiddenli" type="checkbox" id="ispregnant" name="ispregnant" disabled>
                                    @endif
                                    <hr>
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
                                    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-5 offset-md-5">
                                            <a onclick="Testspiningmodal()" class="btn btn-primary" role="button">
                                                {{ __('Test modal!') }}
                                            </a>
                                        </div>
                                    </div>
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
                </div>
            </div>
            
            <!------ ------->
            <!-- TAB de Interrogatorios -->
            <!------ ------->

            <div class="tab-pane fade" id="interrogatorio" role="tabpanel" aria-labelledby="interrogatorio-tab">
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
                                                    <select class="browser-default custom-select form-control @error('grupo') is-invalid @enderror" 
                                                    autocomplete="off" id="grupo" name="grupo">
                                                        @if ($grupos->count() == 0)
                                                            <option selected>--- No se encontraron Grupos Étnicos ---</option>
                                                        @elseif ($anteHF->grupo_id == null)
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
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback error-msg" id="error-grupo" role="alert">
                                                <strong>El campo Grupo Étnico es Obligatorio</strong>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Pertenece a la tabla de interrogatorio
                                    <div class="form-group row">
                                        <label for="padecimiento" class="col-md-4 col-form-label text-md-right offset-md-1">{{ __('Padecimiento Actual') }}:</label>
            
                                        <div class="col-md-5">
                                            <input id="padecimiento" type="text"
                                            class="form-control @error('padecimiento') is-invalid @enderror" name="padecimiento"
                                            value="{{ old('padecimiento') }}" autocomplete="padecimiento" maxlength="255" 
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
                                    
                                    <div class="form-group row">
                                        <div class="form-check col-md-6 row">
                                            <div class="col-md-12 row">
                                                <label for="otroshf" class="col-form-label text-md-right offset-md-1">{{ __('Otros') }}:</label>
            
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="otroshf" type="text"
                                                    class="form-control @error('otroshf') is-invalid @enderror" name="otroshf"
                                                    value="{{ $anteHF->otroshf }}" autocomplete="otroshf" maxlength="255" 
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>
                                                </div>
                                            </div>
                                        </div>
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
                                                <textarea name="infectacontagiosa" id="infectacontagiosa" cols="30" rows="2" 
                                                class="form-control @error('infectacontagiosa') is-invalid @enderror"
                                                value="" autocomplete="infectacontagiosa" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->enfermedadInfectaContagiosa }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="cronicodegenerativa" class="col-md-12 col-form-label">{{ __('Enfermedad Crónico Degenerativa') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cronicodegenerativa" id="cronicodegenerativa" cols="30" rows="2" 
                                                class="form-control @error('cronicodegenerativa') is-invalid @enderror"
                                                value="" autocomplete="cronicodegenerativa" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->enfermedadCronicaDegenerativa }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="traumatologicos" class="col-md-12 col-form-label">{{ __('Traumatológicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="traumatologicos" id="traumatologicos" cols="30" rows="2" 
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
                                                <textarea name="alergicos" id="alergicos" cols="30" rows="2" 
                                                class="form-control @error('alergicos') is-invalid @enderror"
                                                value="" autocomplete="alergicos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->alergicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="quirurgicos" class="col-md-12 col-form-label">{{ __('Quirúrgicos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="quirurgicos" id="quirurgicos" cols="30" rows="2" 
                                                class="form-control @error('quirurgicos') is-invalid @enderror"
                                                value="" autocomplete="quirurgicos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->quirurgicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="hospitalizaciones" class="col-md-12 col-form-label">{{ __('Hospitalizaciones Previas') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="hospitalizaciones" id="hospitalizaciones" cols="30" rows="2" 
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
                                                <textarea name="transfusiones" id="transfusiones" cols="30" rows="2" 
                                                class="form-control @error('transfusiones') is-invalid @enderror"
                                                value="" autocomplete="transfusiones" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePP->transfusiones }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="toxicomanias" class="col-md-12 col-form-label">{{ __('Toxicomanías') }}:</label>
            
                                            <div class="col-md-12">
                                                <select class="form-control" name="multiselecttoxic[]" id="multiselecttoxic" >
                                                    <option value="1">Depresoras</option>
                                                    <option value="2">Estimulantes</option>
                                                    <option value="3">Alucinógenos/Psicodélicos</option>
                                                    <option value="4">Cannabis</option>
                                                    <option value="5">Inhalantes</option>
                                                    <option value="6">Alcoholismo</option>
                                                    <option value="7">Tabaquismo</option>
                                                </select>
                                                <!--
                                                <textarea name="toxicomanias" id="toxicomanias" cols="30" rows="2" 
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
                                                <textarea name="otrospp" id="otrospp" cols="30" rows="2" 
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
                                        <!-- 
                                        <div class="col-md-4">
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12">
                                                    <a onclick="testconsulta()" class="btn btn-primary" role="button">
                                                        {{ __('Test toxicomanias') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        -->

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
                                                <textarea name="vivienda" id="vivienda" cols="30" rows="2" 
                                                class="form-control @error('vivienda') is-invalid @enderror"
                                                value="" autocomplete="vivienda" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->vivienda }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="higiene" class="col-md-12 col-form-label">{{ __('Higiene') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="higiene" id="higiene" cols="30" rows="2" 
                                                class="form-control @error('higiene') is-invalid @enderror"
                                                value="" autocomplete="higiene" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->higiene }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="dieta" class="col-md-12 col-form-label">{{ __('Dieta') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="dieta" id="dieta" cols="30" rows="2" 
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
                                                <textarea name="zoonosis" id="zoonosis" cols="30" rows="2" 
                                                class="form-control @error('zoonosis') is-invalid @enderror"
                                                value="" autocomplete="zoonosis" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $antePNP->zoonosis }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospnp" class="col-md-12 col-form-label">{{ __('Otros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="otrospnp" id="otrospnp" cols="30" rows="2" 
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
                                                <textarea name="signos" id="signos" cols="30" rows="2" 
                                                class="form-control @error('signos') is-invalid @enderror"
                                                value="" autocomplete="signos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->signosYsintomas }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cardiovascular" class="col-md-12 col-form-label">{{ __('Aparato Cardiovascular') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cardiovascular" id="cardiovascular" cols="30" rows="2" 
                                                class="form-control @error('cardiovascular') is-invalid @enderror"
                                                value="" autocomplete="cardiovascular" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoCardiovascular }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="respiratorio" class="col-md-12 col-form-label">{{ __('Aparato Respiratorio') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="respiratorio" id="respiratorio" cols="30" rows="2" 
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
                                                <textarea name="digestivo" id="digestivo" cols="30" rows="2" 
                                                class="form-control @error('digestivo') is-invalid @enderror"
                                                value="" autocomplete="digestivo" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->aparatoDigestivo }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nefro" class="col-md-12 col-form-label">{{ __('Sistema Nefrourologico') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="nefro" id="nefro" cols="30" rows="2" 
                                                class="form-control @error('nefro') is-invalid @enderror"
                                                value="" autocomplete="nefro" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaNefro }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="endocrino" class="col-md-12 col-form-label">{{ __('Sistema Endocrino y Metabolismo') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="endocrino" id="endocrino" cols="30" rows="2" 
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
                                                <textarea name="hematopoyetico" id="hematopoyetico" cols="30" rows="2" 
                                                class="form-control @error('hematopoyetico') is-invalid @enderror"
                                                value="" autocomplete="hematopoyetico" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaHemato }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nervioso" class="col-md-12 col-form-label">{{ __('Sistema Nervioso') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="nervioso" id="nervioso" cols="30" rows="2" 
                                                class="form-control @error('nervioso') is-invalid @enderror"
                                                value="" autocomplete="nervioso" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->sistemaNervioso }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="musculo" class="col-md-12 col-form-label">{{ __('Sistema Musculo Esquelético') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="musculo" id="musculo" cols="30" rows="2" 
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
                                                <textarea name="piel" id="piel" cols="30" rows="2" 
                                                class="form-control @error('piel') is-invalid @enderror"
                                                value="" autocomplete="piel" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->pielYtegumentos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="sentidos" class="col-md-12 col-form-label">{{ __('Órganos de los Sentidos') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="sentidos" id="sentidos" cols="30" rows="2" 
                                                class="form-control @error('sentidos') is-invalid @enderror"
                                                value="" autocomplete="sentidos" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ $interAS->organosSentidos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="psiquica" class="col-md-12 col-form-label">{{ __('Esfera Psíquica') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="psiquica" id="psiquica" cols="30" rows="2" 
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
            
            <div class="tab-pane fade" id="exploracion" role="tabpanel" aria-labelledby="exploracion-tab">
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
                                                <textarea name="habitus" id="habitus" cols="30" rows="2" 
                                                class="form-control @error('habitus') is-invalid @enderror"
                                                value="" autocomplete="habitus" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('habitus') }}</textarea>
            
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
                                                    name="peso" value="{{ old('peso') }}" autocomplete="peso" maxlength="6"
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
                                                    name="talla" value="{{ old('talla') }}" autocomplete="talla" maxlength="3"
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
                                                <textarea name="cabeza" id="cabeza" cols="30" rows="2" 
                                                class="form-control @error('cabeza') is-invalid @enderror"
                                                value="" autocomplete="cabeza" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('cabeza') }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cabeza" role="alert">
                                                    <strong>El campo Cabeza es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cuello" class="col-md-12 col-form-label">{{ __('Cuello') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="cuello" id="cuello" cols="30" rows="2" 
                                                class="form-control @error('cuello') is-invalid @enderror"
                                                value="" autocomplete="cuello" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('cuello') }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Cuello es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="torax" class="col-md-12 col-form-label">{{ __('Tórax') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="torax" id="torax" cols="30" rows="2" 
                                                class="form-control @error('torax') is-invalid @enderror"
                                                value="" autocomplete="torax" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('torax') }}</textarea>
            
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
                                                <textarea name="abdomen" id="abdomen" cols="30" rows="2" 
                                                class="form-control @error('abdomen') is-invalid @enderror"
                                                value="" autocomplete="abdomen" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('abdomen') }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Abdomen es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="miembros" class="col-md-12 col-form-label">{{ __('Miembros') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="miembros" id="miembros" cols="30" rows="2" 
                                                class="form-control @error('miembros') is-invalid @enderror"
                                                value="" autocomplete="miembros" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('miembros') }}</textarea>
            
                                                <span class="invalid-feedback error-msg" id="error-cuello" role="alert">
                                                    <strong>El campo Miembros es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="genitales" class="col-md-12 col-form-label">{{ __('Genitales') }}:</label>
            
                                            <div class="col-md-12">
                                                <textarea name="genitales" id="genitales" cols="30" rows="2" 
                                                class="form-control @error('genitales') is-invalid @enderror"
                                                value="" autocomplete="genitales" maxlength="255"
                                                onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" 
                                                autofocus>{{ old('genitales') }}</textarea>
            
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
            
                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="price" type="text" class="form-control"
                                                    name="temperatura" value="{{ old('temperatura') }}" autocomplete="temperatura" maxlength="4"
                                                    title="La temperatura es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;°C&nbsp;&nbsp;</span>
                                                    </div>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Temperatura es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="presion" class="col-md-12 col-form-label">{{ __('Presión Arterial') }}:</label>
        
                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="sistolica" type="text" class="form-control"
                                                    name="sistolica" placeholder="sistolica" value="{{ old('sistolica') }}" autocomplete="sistolica" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Tensión Sistolica es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;mmHg&nbsp;&nbsp;</span>
                                                    </div>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Presión Sistólica es Obligatorio</strong>
                                                    </span>
                                                    
                                                </div>
    
                                                <div class="col-md-12 input-group">
                                                    <input id="diastolica" type="text" class="form-control"
                                                    name="diastolica" placeholder="diastolica" value="{{ old('diastolica') }}" autocomplete="diastolica" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Tensión diastolica es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;mmHg&nbsp;&nbsp;</span>
                                                    </div>
    
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Presión Diastólico es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>
                                        
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="frecuenciacardiaca" class="col-md-12 col-form-label">{{ __('Frecuencia Cardiaca') }}:</label>
            
                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="frecuenciacardiaca" type="text" class="form-control"
                                                    name="frecuenciacardiaca" value="{{ old('frecuenciacardiaca') }}" autocomplete="frecuenciacardiaca" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Frecuencia Cardiaca es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;lmp&nbsp;&nbsp;</span>
                                                    </div>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Frecuencia Cardiaca es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-5">
                                            <label for="frecuenciarespiratoria" class="col-md-12 col-form-label">{{ __('Frecuencia Respiratoria') }}:</label>
            
                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="frecuenciarespiratoria" type="text" class="form-control"
                                                    name="frecuenciarespiratoria" value="{{ old('frecuenciarespiratoria') }}" autocomplete="frecuenciarespiratoria" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Frecuencia Respiratoria es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;rpm&nbsp;&nbsp;</span>
                                                    </div>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Frecuencia Respiratoria es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="saturacionoxigeno" class="col-md-12 col-form-label">{{ __('Saturación de oxígeno') }}:</label>
            
                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="saturacionoxigeno" type="text" class="form-control"
                                                    name="saturacionoxigeno" value="{{ old('saturacionoxigeno') }}" autocomplete="saturacionoxigeno" maxlength="3"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Saturación de Oxígeno es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;%&nbsp;&nbsp;</span>
                                                    </div>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Saturación de oxígeno es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-5">
                                            <label for="glucosa" class="col-md-12 col-form-label">{{ __('Glucosa') }}:</label>
            
                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="glucosa" type="text" class="form-control"
                                                    name="glucosa" value="{{ old('glucosa') }}" autocomplete="glucosa" maxlength="5"
                                                    onkeypress="return /[0-9]/i.test(event.key)"
                                                    title="La Frecuencia Respiratoria es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">&nbsp;&nbsp;mg/dL&nbsp;&nbsp;</span>
                                                    </div>
                
                                                    <span class="invalid-feedback error-msg" id="error-peso" role="alert">
                                                        <strong>El campo Glucosa es Obligatorio</strong>
                                                    </span>
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
                        <div>
                            <div class="col-md-3 mx-auto hiddenli" id="codeArea">
                                <label for="patientcode">Introduce el código del paciente</label>
                                <input class="form-control form-control-sm" type="text" id="patientcode" name="patientcode" value="">
                            </div>
                            <input type="hidden" name="patientcurp" id="patientcurp" value="{{ $paciente->curp }}">
                            <br>
                            <button class="btn btn-sm btn-success" type="button" id="consultBtn" onclick="patientconsult()">Solicitar Código</button>
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

<div class="scroll-section">
    <form action="">

        <div class="form-group">
            <div class="row">
                <div class="col s12">
                    <div class="row no-mar">
                        <ul class="tabs">
                            <li class="tab col s3">
                                <a class="black-text tab-title text-darken-2 active" href="#section1">Nota de
                                    consulta</a>
                            </li>
                            <li class="tab col s3">
                                <a class="black-text tab-title text-darken-2" href="#section2">Interrogatorio</a>
                            </li>
                            <li class="tab col s3">
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
                                    <textarea name="motivo" id="motivo" cols="30"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" rows="10">{{ old('motivo') }}</textarea>
                                    <label class="label-flex" for="motivo">
                                        <div class="float-voice">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <p class="text-over">
                                            Motivo de la Consulta
                                        </p>
                                    </label>
                                    <span class="helper-text" id="error-motivo">El campo Motivo de Consulta es
                                        Obligatorio</span>
                                </div>

                                <div class="input-field col s12 m6 l6 txtarin no-mar">
                                    <textarea name="cuadro" id="cuadro" cols="30"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" rows="10">{{ old('cuadro') }}</textarea>
                                    <label class="label-flex" for="cuadro">
                                        <div class="float-voice">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <p class="text-over">
                                            Cuadro clínico
                                        </p>
                                    </label>
                                    <span class="helper-text">Error</span>

                                </div>

                                <div class="input-field col s12 m12 l6 txtarin no-mar">
                                    <textarea name="resultados" id="resultados" cols="30"
                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" rows="10"></textarea>
                                    <label class="label-flex" for="resultados">
                                        <div class="float-voice">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <p class="text-over">Resultados de Laboratorio y Gabinete</p>
                                    </label>
                                    <span class="helper-text">Error</span>


                                    <!--
                                        Include input type="file" element on your HTML page and on the click event of your button trigger the click event of input type file element using trigger function of jQuery

                                        The code will look like:

                                        <input type="file" id="imgupload" style="display:none"/>
                                        <button id="OpenImgUpload">Image Upload</button>

                                        And on the button's click event write the jQuery code like :

                                        $('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
  
                                    -->
                                    <input class="float-file" type="file" name="filename[]" id="filename"
                                        multiple accept=".doc,.docx,.pdf,.png,.jpg">
                                    <i class="material-icons">file_upload</i>

                                    <input type="hidden" id="jsonfiles" value="">


                                    <!--div class="float-file">
                                        <i class="material-icons">file_upload</i>
                                    </div-->
                                    <div class="img-space">

                                        <div class="img-grid-c">
                                            <div class="img-overaly">
                                                <a href="#">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                            <img src="assets/labresdemo.jpeg" alt="">
                                        </div>

                                        <div class="img-grid-c">
                                            <div class="img-overaly">
                                                <a href="#">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                            <img src="assets/labresdemo.jpeg" alt="">
                                        </div>

                                        <div class="img-grid-c">
                                            <div class="img-overaly">
                                                <a href="#">
                                                    <i class="material-icons">delete</i>
                                                </a>
                                            </div>
                                            <img src="assets/labresdemo.jpeg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class=" col s12 m12 l6  no-mar">
                                    <div class="input-field">
                                        <input class="form-control selectize" id="select-diag" name="select-diag">

                                        <label>Diagnósticos o Problemas Clínicos</label>
                                        <span class="helper-text">Error</span>
                                    </div> <br>

                                    <div class="input-field txtarin">
                                        <textarea name="motive" id="" cols="30" rows="10"></textarea>
                                        <label class="label-flex" for="motive">
                                            <div class="float-voice">
                                                <i class="material-icons">keyboard_voice</i>
                                            </div>
                                            <p class="text-over">Diagnósticos o Problemas
                                                Clínicos</p>
                                    </div>
                                </div>

                                <div class="input-field col s12 m6 l6 txtarin no-mar">
                                    <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                    <label class="label-flex" for="clinicalPicture">
                                        <div class="float-voice">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <p class="text-over">Pronóstico</p>
                                    </label>
                                    <span class="helper-text">Error</span>

                                </div>

                                <div class="input-field col s12 m6 l12 txtarin no-mar">
                                    <textarea name="labresults" id="" cols="30" rows="10"></textarea>
                                    <label class="label-flex" for="labresults">


                                        <div class="float-voice">
                                            <i class="material-icons">keyboard_voice</i>
                                        </div>
                                        <p class="text-over">Indicación Terapéutica</p>
                                    </label>
                                    <span class="helper-text">Error</span>

                                </div>

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
                                                        <input name="q1" type="radio" />
                                                        <span>Primer trimestre</span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label>
                                                        <input name="q1" type="radio" />
                                                        <span>Segundo trimestre</span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label>
                                                        <input name="q1" type="radio" />
                                                        <span>Tercer trimestre</span>
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

                                <div class="col s12" style="margin-bottom: 1rem; margin-top: 1rem;">
                                    <a class="waves-effect waves-light btn">
                                        <i class="material-icons left">save</i>
                                        Guardar Notas de Consulta
                                    </a>
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
                                                                            <option value="" disabled selected>
                                                                                Elije
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
                                                                        <span class="helper-text">Error</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m12 l4">
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in"
                                                                        checked="checked" />
                                                                    <span>Diabetes</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Neoplasias</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Cardiopatías</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Parkinson</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Depresión</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Colestasis</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Enfermedades
                                                                        Endícrinas</span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                        <div class="col s12 m12 l4">
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Hipertensión</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Tuberculosis</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Alzheimer</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Esclerosis
                                                                        Múltiple</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Esquizofrenia</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Hepatitis</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Enfermedades
                                                                        Genéticas</span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                        <div class="col s12 m12 l4">
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Dislipidemias</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Artritis</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Epilepsia</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Transtorno de
                                                                        Ansiedad</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Cirrosis</span>
                                                                </label>
                                                            </p>
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="filled-in" />
                                                                    <span>Alergias</span>
                                                                </label>
                                                            </p>
                                                        </div>

                                                        <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                            <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                            <label class="label-flex" for="clinicalPicture">
                                                                <div class="float-voice">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <p class="text-over">
                                                                    Otros:
                                                                </p>
                                                            </label>
                                                            <span class="helper-text">Error</span>
                                                        </div>

                                                        <div class="col s12">
                                                            <div class="row padbot no-mar">
                                                                <div class="col">
                                                                    <a class="waves-effect waves-light btn">
                                                                        <i class="material-icons left">save</i>
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

                                                        <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                            <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                            <label class="label-flex" for="clinicalPicture">
                                                                <div class="float-voice">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <p class="text-over">
                                                                    Enfermedad enfecto
                                                                    contagiosa:
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
                                                                    Enfermedad crónico
                                                                    degenerativa
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
                                                                    Traumatológicos:
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
                                                                    Alérgicos:
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
                                                                    Quirúrgicos:
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
                                                                    Hospitalizaciones previas:
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
                                                                    Transfusiones:
                                                                </p>
                                                            </label>
                                                            <span class="helper-text">Error</span>
                                                        </div>

                                                        <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                            <!--textarea name="clinicalPicture" id="" cols="30"
                                                                rows="10"></textarea-->
                                                            <select class="form-control" name="multiselecttoxic[]"
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
                                                            <label class="label-flex" for="clinicalPicture">
                                                                <div class="float-voice">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <p class="text-over">
                                                                    Toxicomanías:
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
                                                                    Otros:
                                                                </p>
                                                            </label>
                                                            <span class="helper-text">Error</span>
                                                        </div>

                                                        <div class="col s12">
                                                            <div class="row padbot no-mar">
                                                                <div class="col">
                                                                    <a class="waves-effect waves-light btn">
                                                                        <i class="material-icons left">save</i>
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
                                                    <div class="row">

                                                        <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                            <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                            <label class="label-flex" for="clinicalPicture">
                                                                <div class="float-voice">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <p class="text-over">
                                                                    Vivienda:
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
                                                                    Higiene:
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
                                                                    Dieta:
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
                                                                    Zoonosis:
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
                                                                    Otros:
                                                                </p>
                                                            </label>
                                                            <span class="helper-text">Error</span>
                                                        </div>

                                                        <div class="col s12">
                                                            <div class="row padbot no-mar">
                                                                <div class="col">
                                                                    <a class="waves-effect waves-light btn">
                                                                        <i class="material-icons left">save</i>
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
                                                        <div class="input-field col s12 m6 l6 txtarin no-mar">
                                                            <textarea name="clinicalPicture" id="" cols="30" rows="10"></textarea>
                                                            <label class="label-flex" for="clinicalPicture">
                                                                <div class="float-voice">
                                                                    <i class="material-icons">keyboard_voice</i>
                                                                </div>
                                                                <p class="text-over">
                                                                    Signos y Síntomas:
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
                                                                    Aparato Cardiovascular:
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
                                                                    Aparato Respiratorio:
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
                                                                    Aparato digestivo:
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
                                                                    Sistema Nefrourológico:
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
                                                                    Sistema Endócrino y
                                                                    Metabolismo:
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
                                                                    Sistema Honomatopoyético:
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
                                                                    Sistema Nervioso:
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
                                                                    Sistema Musculo Esqulético:
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
                                                                    Piel y Tegumentos:
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
                                                                    Órganos de los sentidos:
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
                                                                    Esfera Psíquica:
                                                                </p>
                                                            </label>
                                                            <span class="helper-text">Error</span>
                                                        </div>


                                                        <div class="col s12">
                                                            <div class="row padbot no-mar">
                                                                <div class="col">
                                                                    <a class="waves-effect waves-light btn">
                                                                        <i class="material-icons left">save</i>
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
                                                                    <a class="waves-effect waves-light btn">
                                                                        <i class="material-icons left">save</i>
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
                                                                    <a class="waves-effect waves-light btn">
                                                                        <i class="material-icons left">save</i>
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
                        <a class="waves-effect waves-light orange darken-1 btn"><i
                                class="material-icons left">check</i>Terminar consulta</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid">

    <div class="main col-md-12">
        <div class="tab-content" id="myTabContent">

            <!------ ------->
            <!-- TAB de Nota de Consulta -->
            <!------ ------->

            <div class="tab-pane fade show active" id="consulta" role="tabpanel"
                aria-labelledby="consulta-tab">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="mySecTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tabtitle active" id="datosconsulta-tab" data-bs-toggle="tab"
                                    data-bs-target="#datosconsulta" type="button" role="tab"
                                    aria-controls="datosconsulta" aria-selected="false">
                                    <span class="icon my-auto"><i class="fa fa-info-circle"
                                            aria-hidden="true"></i></span>
                                    <span class="my-auto">Nota de la consulta</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="mySecTabContent">
                            <div class="tab-pane fade show active" id="datosconsulta" role="tabpanel"
                                aria-labelledby="datosconsulta-tab">
                                <form method="POST" id="storeconsulta">
                                    @csrf

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="motivo"
                                                class="col-md-12 col-form-label">{{ __('Motivo de la Consulta') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo"
                                                id="startrecmotivo">&nbsp;&nbsp;<i class="fa fa-microphone"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button"
                                                id="stoprecmotivo">&nbsp;&nbsp;<i class="fa fa-microphone-slash"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12">
                                                <textarea name="motivo" id="motivo" cols="30" rows="2"
                                                    class="form-control @error('motivo') is-invalid @enderror" value="" autocomplete="motivo"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('motivo') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-motivo"
                                                    role="alert">
                                                    <strong>El campo Motivo de Consulta es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cuadro"
                                                class="col-md-12 col-form-label">{{ __('Cuadro Clínico') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo"
                                                id="startreccuadro">&nbsp;&nbsp;<i class="fa fa-microphone"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button"
                                                id="stopreccuadro">&nbsp;&nbsp;<i class="fa fa-microphone-slash"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12">
                                                <textarea name="cuadro" id="cuadro" cols="30" rows="2"
                                                    class="form-control @error('cuadro') is-invalid @enderror" value="" autocomplete="cuadro"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('cuadro') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cuadro"
                                                    role="alert">
                                                    <strong>El campo Cuadro Clinico es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="resultados"
                                                class="col-md-12 col-form-label">{{ __('Resultados de Laboratorio y Gabinete') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo"
                                                id="startrecres">&nbsp;&nbsp;<i class="fa fa-microphone"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button"
                                                id="stoprecres">&nbsp;&nbsp;<i class="fa fa-microphone-slash"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12 text-center">

                                                <!--   Prueba para mostrar multiples input files Pospuesto por el momento
        
                                                <div class="input-group hdtuto control-group lst increment" >
                                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                                    <div class="input-group-btn">
                                                      <button class="btn btn-success btn-mysuccess" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                                    </div>
                                                </div>
                                              
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                      <input type="file" name="filenames[]" class="myfrm form-control">
                                                      <div class="input-group-btn">
                                                        <button class="btn btn-danger btn-mydanger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                                      </div>
                                                    </div>
                                                </div>
        
                                                -->

                                                <input type="file" name="filename[]" id="filename"
                                                    class="form-control" multiple
                                                    accept=".doc,.docx,.pdf,.png,.jpg">
                                                <input type="hidden" id="jsonfiles" value="">

                                                <div class=" border" id="filescontainer"
                                                    style="margin-top: 10px; margin-bottom: 10px">
                                                </div>

                                                <textarea name="resultados" id="resultados" cols="30" rows="2"
                                                    class="form-control @error('resultados') is-invalid @enderror" value="" autocomplete="resultados"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('resultados') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-resultados"
                                                    role="alert">
                                                    <strong>El campo Resultados de Laboratorio es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="diagnostico"
                                                class="col-md-12 col-form-label">{{ __('Diagnósticos o Problemas Clínicos') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo"
                                                id="startrecdiag">&nbsp;&nbsp;<i class="fa fa-microphone"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button"
                                                id="stoprecdiag">&nbsp;&nbsp;<i class="fa fa-microphone-slash"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input class="form-control selectize" id="select-diag"
                                                        name="select-diag">
                                                    <div class="input-group-append">
                                                        <div class="loader hiddenli" id="loadanimation">
                                                            <div class="inner one"></div>
                                                            <div class="inner two"></div>
                                                            <div class="inner three"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p></p>

                                                <textarea name="diagnostico" id="diagnostico" cols="30" rows="2"
                                                    class="form-control @error('diagnostico') is-invalid @enderror" value="" autocomplete="diagnostico"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('diagnostico') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-diagnostico"
                                                    role="alert">
                                                    <strong>El campo Diagnósticos o problemas Clínicos es
                                                        Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="pronostico"
                                                class="col-md-12 col-form-label">{{ __('Pronóstico') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo"
                                                id="startrecpron">&nbsp;&nbsp;<i class="fa fa-microphone"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button"
                                                id="stoprecpron">&nbsp;&nbsp;<i class="fa fa-microphone-slash"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12">
                                                <textarea name="pronostico" id="pronostico" cols="30" rows="2"
                                                    class="form-control @error('pronostico') is-invalid @enderror" value="" autocomplete="pronostico"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('pronostico') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-pronostico"
                                                    role="alert">
                                                    <strong>El campo Pronóstico es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="indicacion"
                                                class="col-md-12 col-form-label">{{ __('Indicación Terapéutica') }}:</label>
                                            <button class="btn btn-success btn-sm" type="button" value="motivo"
                                                id="startrecindica">&nbsp;&nbsp;<i class="fa fa-microphone"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <button class="btn btn-danger btn-sm hiddenli" type="button"
                                                id="stoprecindica">&nbsp;&nbsp;<i class="fa fa-microphone-slash"
                                                    aria-hidden="true"></i>&nbsp;&nbsp;</button>
                                            <p></p>
                                            <div class="col-md-12">
                                                <textarea name="indicacion" id="indicacion" cols="30" rows="2"
                                                    class="form-control @error('indicacion') is-invalid @enderror" value="" autocomplete="indicacion"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('indicacion') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-indicacion"
                                                    role="alert">
                                                    <strong>El campo Indicación Terapéutica es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($paciente->sexo->numero == 2 && ($years >= 9 && $years <= 59))
                                        <br>
                                        <hr>
                                        <br>
                                        <label for="ispregnant" class="col-form-label">
                                            <input type="checkbox" id="ispregnant" name="ispregnant"
                                                onclick="collapsPreg()">
                                            Consulta por Embarazo
                                        </label>

                                        <div id="pregContainer" class="hiddenli">
                                            <div class="card-body row">
                                                <div class="form-group text-left col-md-6">
                                                    <div>
                                                        <label for="consultaembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Primera Consulta por embarazo?') }}</strong></label>
                                                        <div class="form-check col-md-10 mx-right">
                                                            <input type="radio" name="consultaembarazo"
                                                                id="consultaembarazo1" value="0" disabled>
                                                            <label for="consultaembarazo1">Primera Vez</label>
                                                            <br>
                                                            <input type="radio" name="consultaembarazo"
                                                                id="consultaembarazo2" value="1" disabled>
                                                            <label for="consultaembarazo2">Subsecuente</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-consultaembarazo" role="alert">
                                                                <strong>El campo Consulta por Embarazo es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="trimestreembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿En qué Trimestre Gestacional se encuentra?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="trimestreembarazo"
                                                                id="trimestreembarazo1" value="0" disabled>
                                                            <label for="trimestreembarazo1">Primer Trimestre</label>
                                                            <br>
                                                            <input type="radio" name="trimestreembarazo"
                                                                id="trimestreembarazo2" value="1" disabled>
                                                            <label for="trimestreembarazo2">Segundo Trimestre</label>
                                                            <br>
                                                            <input type="radio" name="trimestreembarazo"
                                                                id="trimestreembarazo3" value="2" disabled>
                                                            <label for="trimestreembarazo3">Tercer Trimestre</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-trimestreembarazo" role="alert">
                                                                <strong>El campo Trimestre Gestacional es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="riesgoembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Es de Alto Riesgo?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="riesgoembarazo"
                                                                id="riesgoembarazo1" value="0" disabled>
                                                            <label for="riesgoembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="riesgoembarazo"
                                                                id="riesgoembarazo2" value="1" disabled>
                                                            <label for="riesgoembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-riesgoembarazo" role="alert">
                                                                <strong>El campo Alto Riesgo es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="diabetesembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicación por Diabetes?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="diabetesembarazo"
                                                                id="diabetesembarazo1" value="0" disabled>
                                                            <label for="diabetesembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="diabetesembarazo"
                                                                id="diabetesembarazo2" value="1" disabled>
                                                            <label for="diabetesembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-diabetesembarazo" role="alert">
                                                                <strong>El campo Complicación por Diabetes es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="infeccionembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicación por Infeccion Urinaria?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="infeccionembarazo"
                                                                id="infeccionembarazo1" value="0" disabled>
                                                            <label for="infeccionembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="infeccionembarazo"
                                                                id="infeccionembarazo2" value="1" disabled>
                                                            <label for="infeccionembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-infeccionembarazo" role="alert">
                                                                <strong>El campo Complicación por Infeccion Urinaria es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group text-left col-md-6">
                                                    <div>
                                                        <label for="preclampsiaembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicacion por PreeclampsiaEclampsia?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="preclampsiaembarazo"
                                                                id="preclampsiaembarazo1" value="0" disabled>
                                                            <label for="preclampsiaembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="preclampsiaembarazo"
                                                                id="preclampsiaembarazo2" value="1" disabled>
                                                            <label for="preclampsiaembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-preclampsiaembarazo" role="alert">
                                                                <strong>El campo Complicacion por PreeclampsiaEclampsia
                                                                    es Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="hemorragiaembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Hay Complicación por Hemorragia?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="hemorragiaembarazo"
                                                                id="hemorragiaembarazo1" value="0" disabled>
                                                            <label for="hemorragiaembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="hemorragiaembarazo"
                                                                id="hemorragiaembarazo2" value="1" disabled>
                                                            <label for="hemorragiaembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-hemorragiaembarazo" role="alert">
                                                                <strong>El campo Complicación por Hemorragia es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="sospechacovidembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Se Sospecha que la paciente tiene Covid-19?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="sospechacovidembarazo"
                                                                id="sospechacovidembarazo1" value="0" disabled>
                                                            <label for="sospechacovidembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="sospechacovidembarazo"
                                                                id="sospechacovidembarazo2" value="1" disabled>
                                                            <label for="sospechacovidembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-infeccionembarazo" role="alert">
                                                                <strong>El campo Sospecha Covid-19 es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="confirmacioncovidembarazo"
                                                            class="col-md-12 col-form-label"><strong>{{ __('¿Se Confirma Covid-19?') }}</strong></label>
                                                        <div class="col-md-10 mx-right">
                                                            <input type="radio" name="confirmacioncovidembarazo"
                                                                id="confirmacioncovidembarazo1" value="0"
                                                                disabled>
                                                            <label for="confirmacioncovidembarazo1">No</label>
                                                            <br>
                                                            <input type="radio" name="confirmacioncovidembarazo"
                                                                id="confirmacioncovidembarazo2" value="1"
                                                                disabled>
                                                            <label for="confirmacioncovidembarazo2">Si</label>
                                                            <span class="invalid-feedback error-msg"
                                                                id="error-confirmacioncovidembarazo" role="alert">
                                                                <strong>El campo Confirmacion Covid-19 es
                                                                    Obligatorio</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    @else
                                        <input class="hiddenli" type="checkbox" id="ispregnant"
                                            name="ispregnant" disabled>
                                    @endif
                                    <hr>
                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="consultasubmit"
                                                class="form-group row mb-0 {{ session('consulta_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="subformbutton()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Nota de Consulta') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="consultaupdate"
                                                class="form-group row mb-0 {{ session('consulta_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateformbutton()" class="btn btn-success"
                                                        role="button">
                                                        {{ __('Actualizar Nota de Consulta') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-5 offset-md-5">
                                            <a onclick="Testspiningmodal()" class="btn btn-primary"
                                                role="button">
                                                {{ __('Test modal!') }}
                                            </a>
                                        </div>
                                    </div>
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
                </div>
            </div>

            <!------ ------->
            <!-- TAB de Interrogatorios -->
            <!------ ------->

            <div class="tab-pane fade" id="interrogatorio" role="tabpanel" aria-labelledby="interrogatorio-tab">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="mySecTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tabtitle active" id="antehf-tab" data-bs-toggle="tab"
                                    data-bs-target="#antehf" type="button" role="tab"
                                    aria-controls="antehf" aria-selected="false">
                                    <span class="icon my-auto"><i class="bi bi-question-octagon-fill"></i></span>
                                    <span class="my-auto">Antecedentes Heredo - Familiares</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="antepp-tab" data-bs-toggle="tab"
                                    data-bs-target="#antepp" type="button" role="tab" aria-controls="v"
                                    aria-selected="false">
                                    <span class="icon my-auto"><i class="bi bi-question-octagon-fill"></i></span>
                                    <span class="my-auto">Antecedentes Personales Patológicos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="antepnp-tab" data-bs-toggle="tab"
                                    data-bs-target="#antepnp" type="button" role="tab"
                                    aria-controls="antepnp" aria-selected="false">
                                    <span class="icon my-auto"><i
                                            class="bi bi-question-octagon-fill"></i></i></span>
                                    <span class="my-auto">Antecedentes Personales No Patologios</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="anteas-tab" data-bs-toggle="tab"
                                    data-bs-target="#anteas" type="button" role="tab"
                                    aria-controls="anteas" aria-selected="false">
                                    <span class="icon my-auto"><i
                                            class="bi bi-question-octagon-fill"></i></i></span>
                                    <span class="my-auto">Aparatos y Sistemas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="mySecTabContent">

                            <div class="tab-pane fade show active" id="antehf" role="tabpanel"
                                aria-labelledby="hf-tab">
                                <form method="POST" id="storeantehf">

                                    <div class="form-group row">
                                        <div class="form-check col-md-6 row">
                                            <div class="col-md-12 row">
                                                <label for="grupo"
                                                    class="col-form-label text-md-right offset-md-1">{{ __('Grupo Étnico') }}:</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select
                                                        class="browser-default custom-select form-control @error('grupo') is-invalid @enderror"
                                                        autocomplete="off" id="grupo" name="grupo">
                                                        @if ($grupos->count() == 0)
                                                            <option selected>--- No se encontraron Grupos Étnicos ---
                                                            </option>
                                                        @elseif ($anteHF->grupo_id == null)
                                                            <option selected>--- Selecciona una Opción ---</option>
                                                            @foreach ($grupos as $grupo)
                                                                <option value="{{ $grupo->id }}">
                                                                    {{ $grupo->lenguaIndigena }}</option>
                                                            @endforeach
                                                        @else
                                                            <option>--- Selecciona una Opción ---</option>
                                                            @foreach ($grupos as $grupo)
                                                                <option value="{{ $grupo->id }}"
                                                                    {{ $grupo->id == $anteHF->grupo_id ? 'selected' : '' }}>
                                                                    {{ $grupo->lenguaIndigena }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback error-msg" id="error-grupo"
                                                role="alert">
                                                <strong>El campo Grupo Étnico es Obligatorio</strong>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Pertenece a la tabla de interrogatorio
                                    <div class="form-group row">
                                        <label for="padecimiento" class="col-md-4 col-form-label text-md-right offset-md-1">{{ __('Padecimiento Actual') }}:</label>
            
                                        <div class="col-md-5">
                                            <input id="padecimiento" type="text"
                                            class="form-control @error('padecimiento') is-invalid @enderror" name="padecimiento"
                                            value="{{ old('padecimiento') }}" autocomplete="padecimiento" maxlength="255"
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
                                                    class="form-control" name="diabetes" value="diabetes"
                                                    {{ $anteHF->diabetes == 1 ? 'checked' : '' }} autofocus>
                                                <label for="diabetes"
                                                    class="col-form-label">{{ __('Diabetes') }}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="checkinput" id="neoplasias" type="checkbox"
                                                    class="form-control @error('neoplasias') is-invalid @enderror"
                                                    name="neoplasias" value="neoplasias"
                                                    {{ $anteHF->neoplasias == 1 ? 'checked' : '' }} autofocus>
                                                <label for="neoplasias"
                                                    class=" col-form-label">{{ __('Neoplasias') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="cardiopatias" type="checkbox"
                                                    class="form-control @error('cardiopatias') is-invalid @enderror"
                                                    name="cardiopatias" value="cardiopatias"
                                                    {{ $anteHF->cardiopatias == 1 ? 'checked' : '' }} autofocus>
                                                <label for="cardiopatias"
                                                    class=" col-form-label">{{ __('Cardiopatías') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="parkinson" type="checkbox"
                                                    class="form-control @error('parkinson') is-invalid @enderror"
                                                    name="parkinson" value="parkinson"
                                                    {{ $anteHF->parkinson == 1 ? 'checked' : '' }} autofocus>
                                                <label for="parkinson"
                                                    class=" col-form-label">{{ __('Parkinson') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="depresion" type="checkbox"
                                                    class="form-control @error('depresion') is-invalid @enderror"
                                                    name="depresion" value="depresion"
                                                    {{ $anteHF->depresion == 1 ? 'checked' : '' }} autofocus>
                                                <label for="depresion"
                                                    class=" col-form-label">{{ __('Depresión') }}:</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="colestasis" type="checkbox"
                                                    class="form-control @error('colestasis') is-invalid @enderror"
                                                    name="colestasis" value="colestasis"
                                                    {{ $anteHF->colestasis == 1 ? 'checked' : '' }} autofocus>
                                                <label for="colestasis"
                                                    class=" col-form-label">{{ __('Colestasis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="endocrinas" type="checkbox"
                                                    class="form-control @error('endocrinas') is-invalid @enderror"
                                                    name="endocrinas" value="endocrinas"
                                                    {{ $anteHF->enfermedadesEndocrinas == 1 ? 'checked' : '' }}
                                                    autofocus>
                                                <label for="endocrinas"
                                                    class=" col-form-label">{{ __('Enfermedades Endocrinas') }}</label>
                                            </div>

                                        </div>

                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="hipertension" type="checkbox"
                                                    class="form-control" name="hipertension" value="hipertension"
                                                    {{ $anteHF->hipertension == 1 ? 'checked' : '' }} autofocus>
                                                <label for="hipertension"
                                                    class=" col-form-label ">{{ __('Hipertensión') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="tuberculosis" type="checkbox"
                                                    class="form-control @error('tuberculosis') is-invalid @enderror"
                                                    name="tuberculosis" value="tuberculosis"
                                                    {{ $anteHF->tuberculosis == 1 ? 'checked' : '' }} autofocus>
                                                <label for="tuberculosis"
                                                    class=" col-form-label">{{ __('Tuberculosis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="alzheimer" type="checkbox"
                                                    class="form-control @error('alzheimer') is-invalid @enderror"
                                                    name="alzheimer" value="alzheimer"
                                                    {{ $anteHF->alzheimer == 1 ? 'checked' : '' }} autofocus>
                                                <label for="alzheimer"
                                                    class=" col-form-label">{{ __('Alzheimer') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="esclerosis" type="checkbox"
                                                    class="form-control @error('esclerosis') is-invalid @enderror"
                                                    name="esclerosis" value="esclerosis"
                                                    {{ $anteHF->esclerosisMultiple == 1 ? 'checked' : '' }} autofocus>
                                                <label for="esclerosis"
                                                    class=" col-form-label">{{ __('Esclerosis Múltiple') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="esquizofrenia" type="checkbox"
                                                    class="form-control @error('esquizofrenia') is-invalid @enderror"
                                                    name="esquizofrenia" value="esquizofrenia"
                                                    {{ $anteHF->esquizofrenia == 1 ? 'checked' : '' }} autofocus>
                                                <label for="esquizofrenia"
                                                    class=" col-form-label">{{ __('Esquizofrenia') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="hepatitis" type="checkbox"
                                                    class="form-control @error('hepatitis') is-invalid @enderror"
                                                    name="hepatitis" value="hepatitis"
                                                    {{ $anteHF->hepatitis == 1 ? 'checked' : '' }} autofocus>
                                                <label for="hepatitis"
                                                    class=" col-form-label">{{ __('Hepatitis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="geneticas" type="checkbox"
                                                    class="form-control @error('geneticas') is-invalid @enderror"
                                                    name="geneticas" value="geneticas"
                                                    {{ $anteHF->enfermedadesGeneticas == 1 ? 'checked' : '' }} autofocus>
                                                <label for="geneticas"
                                                    class=" col-form-label">{{ __('Enfermedades Genéticas') }}</label>
                                            </div>


                                        </div>

                                        <div class="form-check col-md-4 row">
                                            <div class="col-md-12">
                                                <input class="checkinput" id="dislipidemias" type="checkbox"
                                                    class="form-control" name="dislipidemias"
                                                    value="dislipidemias"
                                                    {{ $anteHF->dislipidemias == 1 ? 'checked' : '' }} autofocus>
                                                <label for="dislipidemias"
                                                    class=" col-form-label">{{ __('Dislipidemias') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="artritis" type="checkbox"
                                                    class="form-control @error('artritis') is-invalid @enderror"
                                                    name="artritis" value="artritis"
                                                    {{ $anteHF->artritis == 1 ? 'checked' : '' }} autofocus>
                                                <label for="artritis"
                                                    class=" col-form-label">{{ __('Artritis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="epilepsia" type="checkbox"
                                                    class="form-control @error('epilepsia') is-invalid @enderror"
                                                    name="epilepsia" value="epilepsia"
                                                    {{ $anteHF->epilepsia == 1 ? 'checked' : '' }} autofocus>
                                                <label for="epilepsia"
                                                    class=" col-form-label">{{ __('Epilepsia') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="trastorno" type="checkbox"
                                                    class="form-control @error('trastorno') is-invalid @enderror"
                                                    name="trastorno" value="trastorno"
                                                    {{ $anteHF->trastornoAnsiedad == 1 ? 'checked' : '' }} autofocus>
                                                <label for="trastorno"
                                                    class=" col-form-label">{{ __('Trastorno de Ansiedad') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="cirrosis" type="checkbox"
                                                    class="form-control @error('cirrosis') is-invalid @enderror"
                                                    name="cirrosis" value="cirrosis"
                                                    {{ $anteHF->Cirrosis == 1 ? 'checked' : '' }} autofocus>
                                                <label for="cirrosis"
                                                    class=" col-form-label">{{ __('Cirrosis') }}</label>
                                            </div>

                                            <div class="col-md-12">
                                                <input class="checkinput" id="alergias" type="checkbox"
                                                    class="form-control @error('alergias') is-invalid @enderror"
                                                    name="alergias" value="alergias"
                                                    {{ $anteHF->alergias == 1 ? 'checked' : '' }} autofocus>
                                                <label for="alergias"
                                                    class=" col-form-label">{{ __('Alergias') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-check col-md-6 row">
                                            <div class="col-md-12 row">
                                                <label for="otroshf"
                                                    class="col-form-label text-md-right offset-md-1">{{ __('Otros') }}:</label>

                                                <div class="col-md-6 col-sm-6">
                                                    <input id="otroshf" type="text"
                                                        class="form-control @error('otroshf') is-invalid @enderror"
                                                        name="otroshf" value="{{ $anteHF->otroshf }}"
                                                        autocomplete="otroshf" maxlength="255"
                                                        onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)"
                                                        autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group col-md-12 text-center">
                                        <div class="col-md-8 offset-md-2">
                                            <div id="antehrsubmit"
                                                class="row mb-0 {{ session('anteHF_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeantecedenteshf()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Antecedesntes Heredo - Familiares') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="antehrupdate"
                                                class="form-group row mb-0 {{ session('anteHF_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateantecedenteshf()" class="btn btn-success"
                                                        role="button">
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
                                            <label for="infectacontagiosa"
                                                class="col-md-12 col-form-label">{{ __('Enfermedad Infecta Contagiosa') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="infectacontagiosa" id="infectacontagiosa" cols="30" rows="2"
                                                    class="form-control @error('infectacontagiosa') is-invalid @enderror" value=""
                                                    autocomplete="infectacontagiosa" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->enfermedadInfectaContagiosa }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cronicodegenerativa"
                                                class="col-md-12 col-form-label">{{ __('Enfermedad Crónico Degenerativa') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="cronicodegenerativa" id="cronicodegenerativa" cols="30" rows="2"
                                                    class="form-control @error('cronicodegenerativa') is-invalid @enderror" value=""
                                                    autocomplete="cronicodegenerativa" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->enfermedadCronicaDegenerativa }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="traumatologicos"
                                                class="col-md-12 col-form-label">{{ __('Traumatológicos') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="traumatologicos" id="traumatologicos" cols="30" rows="2"
                                                    class="form-control @error('traumatologicos') is-invalid @enderror" value=""
                                                    autocomplete="traumatologicos" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->traumatologicos }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="alergicos"
                                                class="col-md-12 col-form-label">{{ __('Alérgicos') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="alergicos" id="alergicos" cols="30" rows="2"
                                                    class="form-control @error('alergicos') is-invalid @enderror" value="" autocomplete="alergicos"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->alergicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="quirurgicos"
                                                class="col-md-12 col-form-label">{{ __('Quirúrgicos') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="quirurgicos" id="quirurgicos" cols="30" rows="2"
                                                    class="form-control @error('quirurgicos') is-invalid @enderror" value="" autocomplete="quirurgicos"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->quirurgicos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="hospitalizaciones"
                                                class="col-md-12 col-form-label">{{ __('Hospitalizaciones Previas') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="hospitalizaciones" id="hospitalizaciones" cols="30" rows="2"
                                                    class="form-control @error('hospitalizaciones') is-invalid @enderror" value=""
                                                    autocomplete="hospitalizaciones" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->hospitalizacionesPrevias }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="transfusiones"
                                                class="col-md-12 col-form-label">{{ __('Transfusiones') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="transfusiones" id="transfusiones" cols="30" rows="2"
                                                    class="form-control @error('transfusiones') is-invalid @enderror" value="" autocomplete="transfusiones"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->transfusiones }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="toxicomanias"
                                                class="col-md-12 col-form-label">{{ __('Toxicomanías') }}:</label>

                                            <div class="col-md-12">
                                                <select class="form-control" name="multiselecttoxic[]"
                                                    id="multiselecttoxic">
                                                    <option value="1">Depresoras</option>
                                                    <option value="2">Estimulantes</option>
                                                    <option value="3">Alucinógenos/Psicodélicos</option>
                                                    <option value="4">Cannabis</option>
                                                    <option value="5">Inhalantes</option>
                                                    <option value="6">Alcoholismo</option>
                                                    <option value="7">Tabaquismo</option>
                                                </select>
                                                <!--
                                                <textarea name="toxicomanias" id="toxicomanias" cols="30" rows="2"
                                                    class="form-control @error('toxicomanias') is-invalid @enderror" value="" autocomplete="toxicomanias"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->toxicomaniasAlcoholismo }}</textarea>
                                                -->
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospp"
                                                class="col-md-12 col-form-label">{{ __('Otros') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="otrospp" id="otrospp" cols="30" rows="2"
                                                    class="form-control @error('otrospp') is-invalid @enderror" value="" autocomplete="otrospp"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePP->otros }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                        </div>
                                        <!--
                                        <div class="col-md-4">
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12">
                                                    <a onclick="testconsulta()" class="btn btn-primary" role="button">
                                                        {{ __('Test toxicomanias') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <div class="col-md-4">
                                            <div id="antePPsubmit"
                                                class="form-group row mb-0 {{ session('antePP_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeantecedentespp()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Antecedentes Personales Patológicos') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="antePPupdate"
                                                class="form-group row mb-0 {{ session('antePP_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateantecedentespp()" class="btn btn-success"
                                                        role="button">
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
                                            <label for="vivienda"
                                                class="col-md-12 col-form-label">{{ __('Vivienda') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="vivienda" id="vivienda" cols="30" rows="2"
                                                    class="form-control @error('vivienda') is-invalid @enderror" value="" autocomplete="vivienda"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePNP->vivienda }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="higiene"
                                                class="col-md-12 col-form-label">{{ __('Higiene') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="higiene" id="higiene" cols="30" rows="2"
                                                    class="form-control @error('higiene') is-invalid @enderror" value="" autocomplete="higiene"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePNP->higiene }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="dieta"
                                                class="col-md-12 col-form-label">{{ __('Dieta') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="dieta" id="dieta" cols="30" rows="2"
                                                    class="form-control @error('dieta') is-invalid @enderror" value="" autocomplete="dieta"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePNP->dieta }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="zoonosis"
                                                class="col-md-12 col-form-label">{{ __('Zoonosis') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="zoonosis" id="zoonosis" cols="30" rows="2"
                                                    class="form-control @error('zoonosis') is-invalid @enderror" value="" autocomplete="zoonosis"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePNP->zoonosis }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="otrospnp"
                                                class="col-md-12 col-form-label">{{ __('Otros') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="otrospnp" id="otrospnp" cols="30" rows="2"
                                                    class="form-control @error('otrospnp') is-invalid @enderror" value="" autocomplete="otrospnp"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $antePNP->otros }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                        </div>

                                    </div>

                                    <br>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="antePNPsubmit"
                                                class="form-group row mb-0 {{ session('antePNP_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeantecedentespnp()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Antecedentes Personales No Patológicos') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="antePNPupdate"
                                                class="form-group row mb-0 {{ session('antePNP_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateantecedentespnp()" class="btn btn-success"
                                                        role="button">
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
                                            <label for="signos"
                                                class="col-md-12 col-form-label">{{ __('Signos y Sintomas') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="signos" id="signos" cols="30" rows="2"
                                                    class="form-control @error('signos') is-invalid @enderror" value="" autocomplete="signos"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->signosYsintomas }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cardiovascular"
                                                class="col-md-12 col-form-label">{{ __('Aparato Cardiovascular') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="cardiovascular" id="cardiovascular" cols="30" rows="2"
                                                    class="form-control @error('cardiovascular') is-invalid @enderror" value=""
                                                    autocomplete="cardiovascular" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->aparatoCardiovascular }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="respiratorio"
                                                class="col-md-12 col-form-label">{{ __('Aparato Respiratorio') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="respiratorio" id="respiratorio" cols="30" rows="2"
                                                    class="form-control @error('respiratorio') is-invalid @enderror" value="" autocomplete="respiratorio"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->aparatoRespiratorio }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="digestivo"
                                                class="col-md-12 col-form-label">{{ __('Aparato Digestivo') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="digestivo" id="digestivo" cols="30" rows="2"
                                                    class="form-control @error('digestivo') is-invalid @enderror" value="" autocomplete="digestivo"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->aparatoDigestivo }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nefro"
                                                class="col-md-12 col-form-label">{{ __('Sistema Nefrourologico') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="nefro" id="nefro" cols="30" rows="2"
                                                    class="form-control @error('nefro') is-invalid @enderror" value="" autocomplete="nefro"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->sistemaNefro }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="endocrino"
                                                class="col-md-12 col-form-label">{{ __('Sistema Endocrino y Metabolismo') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="endocrino" id="endocrino" cols="30" rows="2"
                                                    class="form-control @error('endocrino') is-invalid @enderror" value="" autocomplete="endocrino"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->sistemaEndocrino }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="hematopoyetico"
                                                class="col-md-12 col-form-label">{{ __('Sistema Hematopoyético') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="hematopoyetico" id="hematopoyetico" cols="30" rows="2"
                                                    class="form-control @error('hematopoyetico') is-invalid @enderror" value=""
                                                    autocomplete="hematopoyetico" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->sistemaHemato }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="nervioso"
                                                class="col-md-12 col-form-label">{{ __('Sistema Nervioso') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="nervioso" id="nervioso" cols="30" rows="2"
                                                    class="form-control @error('nervioso') is-invalid @enderror" value="" autocomplete="nervioso"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->sistemaNervioso }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="musculo"
                                                class="col-md-12 col-form-label">{{ __('Sistema Musculo Esquelético') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="musculo" id="musculo" cols="30" rows="2"
                                                    class="form-control @error('musculo') is-invalid @enderror" value="" autocomplete="musculo"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->sistemaMusculoEsqueletico }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="piel"
                                                class="col-md-12 col-form-label">{{ __('Piel y Tegumentos') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="piel" id="piel" cols="30" rows="2"
                                                    class="form-control @error('piel') is-invalid @enderror" value="" autocomplete="piel" maxlength="255"
                                                    onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->pielYtegumentos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="sentidos"
                                                class="col-md-12 col-form-label">{{ __('Órganos de los Sentidos') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="sentidos" id="sentidos" cols="30" rows="2"
                                                    class="form-control @error('sentidos') is-invalid @enderror" value="" autocomplete="sentidos"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->organosSentidos }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="psiquica"
                                                class="col-md-12 col-form-label">{{ __('Esfera Psíquica') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="psiquica" id="psiquica" cols="30" rows="2"
                                                    class="form-control @error('psiquica') is-invalid @enderror" value="" autocomplete="psiquica"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ $interAS->esferaPsiquica }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="aparatossubmit"
                                                class="form-group row mb-0 {{ session('interAS_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeaparatos()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Aparatos y Sistemas') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="aparatosupdate"
                                                class="form-group row mb-0 {{ session('interAS_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateaparatos()" class="btn btn-success"
                                                        role="button">
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

            <div class="tab-pane fade" id="exploracion" role="tabpanel" aria-labelledby="exploracion-tab">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTerTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tabtitle active" id="datosexplo-tab" data-bs-toggle="tab"
                                    data-bs-target="#datosexplo" type="button" role="tab"
                                    aria-controls="datosexplo" aria-selected="true">
                                    <span class="icon my-auto"><i class="fa fa-book"
                                            aria-hidden="true"></i></span>
                                    <span class="my-auto">Datos de Exploración Física</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tabtitle" id="signosvitales-tab" data-bs-toggle="tab"
                                    data-bs-target="#signosvitales" type="button" role="tab"
                                    aria-controls="signosvitales" aria-selected="false">
                                    <span class="icon my-auto"><i class="fa fa-book"
                                            aria-hidden="true"></i></span>
                                    <span class="my-auto">Signos Vitales</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="mySecTabContent">
                            <div class="tab-pane fade show active" id="datosexplo" role="tabpanel"
                                aria-labelledby="datosexplo-tab">
                                <form method="POST" id="storedatosexplo">

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="habitus"
                                                class="col-md-12 col-form-label">{{ __('Habitus Exterior') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="habitus" id="habitus" cols="30" rows="2"
                                                    class="form-control @error('habitus') is-invalid @enderror" value="" autocomplete="habitus"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('habitus') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-habitus"
                                                    role="alert">
                                                    <strong>El campo Habitus Exterior es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="peso"
                                                class="col-md-12 col-form-label">{{ __('Peso') }}:</label>

                                            <div class="col-md-12 row">
                                                <div class="col-md-7">
                                                    <input id="price2" type="text"
                                                        class="form-control @error('peso') is-invalid @enderror"
                                                        name="peso" value="{{ old('peso') }}"
                                                        autocomplete="peso" maxlength="6"
                                                        title="El Peso es una cantidad númerica." autofocus>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Peso es Obligatorio</strong>
                                                    </span>

                                                </div>
                                                <div class="col-md-5 text-md-center">
                                                    <div class="col-form-label littlediv">
                                                        kg
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="talla"
                                                class="col-md-4 col-form-label">{{ __('Talla') }}:</label>

                                            <div class="col-md-12 row">
                                                <div class="col-md-7">
                                                    <input id="talla" type="text"
                                                        class="form-control @error('talla') is-invalid @enderror"
                                                        name="talla" value="{{ old('talla') }}"
                                                        autocomplete="talla" maxlength="3"
                                                        onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Talla es una cantidad númerica." autofocus>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Talla es Obligatorio</strong>
                                                    </span>
                                                </div>
                                                <div class="col-md-5 text-md-center">
                                                    <div class="col-form-label littlediv">
                                                        cm
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="cabeza"
                                                class="col-md-12 col-form-label">{{ __('Cabeza') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="cabeza" id="cabeza" cols="30" rows="2"
                                                    class="form-control @error('cabeza') is-invalid @enderror" value="" autocomplete="cabeza"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('cabeza') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cabeza"
                                                    role="alert">
                                                    <strong>El campo Cabeza es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cuello"
                                                class="col-md-12 col-form-label">{{ __('Cuello') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="cuello" id="cuello" cols="30" rows="2"
                                                    class="form-control @error('cuello') is-invalid @enderror" value="" autocomplete="cuello"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('cuello') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cuello"
                                                    role="alert">
                                                    <strong>El campo Cuello es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="torax"
                                                class="col-md-12 col-form-label">{{ __('Tórax') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="torax" id="torax" cols="30" rows="2"
                                                    class="form-control @error('torax') is-invalid @enderror" value="" autocomplete="torax"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('torax') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cuello"
                                                    role="alert">
                                                    <strong>El campo Tórax es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4">
                                            <label for="abdomen"
                                                class="col-md-12 col-form-label">{{ __('Abdomen') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="abdomen" id="abdomen" cols="30" rows="2"
                                                    class="form-control @error('abdomen') is-invalid @enderror" value="" autocomplete="abdomen"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('abdomen') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cuello"
                                                    role="alert">
                                                    <strong>El campo Abdomen es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="miembros"
                                                class="col-md-12 col-form-label">{{ __('Miembros') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="miembros" id="miembros" cols="30" rows="2"
                                                    class="form-control @error('miembros') is-invalid @enderror" value="" autocomplete="miembros"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('miembros') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cuello"
                                                    role="alert">
                                                    <strong>El campo Miembros es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="genitales"
                                                class="col-md-12 col-form-label">{{ __('Genitales') }}:</label>

                                            <div class="col-md-12">
                                                <textarea name="genitales" id="genitales" cols="30" rows="2"
                                                    class="form-control @error('genitales') is-invalid @enderror" value="" autocomplete="genitales"
                                                    maxlength="255" onkeypress="return /[a-zA-Z0-9!#$%^&*áéíóúüñ/)(.,:;\s-]/i.test(event.key)" autofocus>{{ old('genitales') }}</textarea>

                                                <span class="invalid-feedback error-msg" id="error-cuello"
                                                    role="alert">
                                                    <strong>El campo Genitales es Obligatorio</strong>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <br>

                                    <div class="form-group row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div id="exploracionsubmit"
                                                class="form-group row mb-0 {{ session('explo_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storeexploracion()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Exploración Física') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="exploracionupdate"
                                                class="form-group row mb-0 {{ session('explo_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updateexploracion()" class="btn btn-success"
                                                        role="button">
                                                        {{ __('Actualizar Exploración Física') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="signosvitales" role="tabpanel"
                                aria-labelledby="signosvitales-tab">
                                <form method="POST" id="storesignos">

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="temperatura"
                                                class="col-md-12 col-form-label">{{ __('Temperatura') }}:</label>

                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="price" type="text" class="form-control"
                                                        name="temperatura" value="{{ old('temperatura') }}"
                                                        autocomplete="temperatura" maxlength="4"
                                                        title="La temperatura es una cantidad númerica." autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;°C&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Temperatura es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="presion"
                                                class="col-md-12 col-form-label">{{ __('Presión Arterial') }}:</label>

                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="sistolica" type="text" class="form-control"
                                                        name="sistolica" placeholder="sistolica"
                                                        value="{{ old('sistolica') }}" autocomplete="sistolica"
                                                        maxlength="3" onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Tensión Sistolica es una cantidad númerica."
                                                        autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;mmHg&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Presión Sistólica es Obligatorio</strong>
                                                    </span>

                                                </div>

                                                <div class="col-md-12 input-group">
                                                    <input id="diastolica" type="text" class="form-control"
                                                        name="diastolica" placeholder="diastolica"
                                                        value="{{ old('diastolica') }}" autocomplete="diastolica"
                                                        maxlength="3" onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Tensión diastolica es una cantidad númerica."
                                                        autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;mmHg&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Presión Diastólico es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>

                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="frecuenciacardiaca"
                                                class="col-md-12 col-form-label">{{ __('Frecuencia Cardiaca') }}:</label>

                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="frecuenciacardiaca" type="text"
                                                        class="form-control" name="frecuenciacardiaca"
                                                        value="{{ old('frecuenciacardiaca') }}"
                                                        autocomplete="frecuenciacardiaca" maxlength="3"
                                                        onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Frecuencia Cardiaca es una cantidad númerica."
                                                        autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;lmp&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Frecuencia Cardiaca es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-5">
                                            <label for="frecuenciarespiratoria"
                                                class="col-md-12 col-form-label">{{ __('Frecuencia Respiratoria') }}:</label>

                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="frecuenciarespiratoria" type="text"
                                                        class="form-control" name="frecuenciarespiratoria"
                                                        value="{{ old('frecuenciarespiratoria') }}"
                                                        autocomplete="frecuenciarespiratoria" maxlength="3"
                                                        onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Frecuencia Respiratoria es una cantidad númerica."
                                                        autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;rpm&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Frecuencia Respiratoria es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>
                                    </div>

                                    <div class="form-group row text-center">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-5">
                                            <label for="saturacionoxigeno"
                                                class="col-md-12 col-form-label">{{ __('Saturación de oxígeno') }}:</label>

                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="saturacionoxigeno" type="text"
                                                        class="form-control" name="saturacionoxigeno"
                                                        value="{{ old('saturacionoxigeno') }}"
                                                        autocomplete="saturacionoxigeno" maxlength="3"
                                                        onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Saturación de Oxígeno es una cantidad númerica."
                                                        autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;%&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Saturación de oxígeno es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-5">
                                            <label for="glucosa"
                                                class="col-md-12 col-form-label">{{ __('Glucosa') }}:</label>

                                            <div class="col-md-12">
                                                <div class="col-md-12 input-group">
                                                    <input id="glucosa" type="text" class="form-control"
                                                        name="glucosa" value="{{ old('glucosa') }}"
                                                        autocomplete="glucosa" maxlength="5"
                                                        onkeypress="return /[0-9]/i.test(event.key)"
                                                        title="La Frecuencia Respiratoria es una cantidad númerica."
                                                        autofocus>
                                                    <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">&nbsp;&nbsp;mg/dL&nbsp;&nbsp;</span>
                                                    </div>

                                                    <span class="invalid-feedback error-msg" id="error-peso"
                                                        role="alert">
                                                        <strong>El campo Glucosa es Obligatorio</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>

                                    </div>

                                    <br>

                                    <div class="form-group row text-center">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div id="signossubmit"
                                                class="form-group row mb-0 {{ session('signos_id') !== null ? 'hiddenli' : '' }}">
                                                <div class="col-md-12">
                                                    <a onclick="storesignos()" class="btn btn-primary"
                                                        role="button">
                                                        {{ __('Guardar Signos Vitales Física') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div id="signosupdate"
                                                class="form-group row mb-0 {{ session('signos_id') !== null ? '' : 'hiddenli' }}">
                                                <div class="col-md-12">
                                                    <a onclick="updatesignos()" class="btn btn-success"
                                                        role="button">
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
                        Consulta del Expediente clínico Electrónico del paciente <strong>{{ $paciente->nombre }}
                            {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</strong>
                    </div>
                    <div class="card-body text-center">
                        <div>
                            <div class="col-md-3 mx-auto hiddenli" id="codeArea">
                                <label for="patientcode">Introduce el código del paciente</label>
                                <input class="form-control form-control-sm" type="text" id="patientcode"
                                    name="patientcode" value="">
                            </div>
                            <input type="hidden" name="patientcurp" id="patientcurp"
                                value="{{ $paciente->curp }}">
                            <br>
                            <button class="btn btn-sm btn-success" type="button" id="consultBtn"
                                onclick="patientconsult()">Solicitar Código</button>
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