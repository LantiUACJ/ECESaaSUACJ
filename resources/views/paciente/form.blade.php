<div class="box box-info padding-1">
    <div class="box-body">        
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Nombre(s)' }}
                    {{ Form::text('nombre', $paciente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'onkeypress' => "return /[A-Z Ñ]/i.test(event.key)", 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 50]) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Primer apellido' }}
                    {{ Form::text('primerApellido', $paciente->primerApellido, ['class' => 'form-control' . ($errors->has('primerApellido') ? ' is-invalid' : ''), 'placeholder' => 'Primer apellido', 'onkeypress' => "return /[A-Z Ñ]/i.test(event.key)", 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 50]) }}
                    {!! $errors->first('primerApellido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Segundo apellido' }}
                    {{ Form::text('segundoApellido', $paciente->segundoApellido, ['class' => 'form-control' . ($errors->has('segundoApellido') ? ' is-invalid' : ''), 'placeholder' => 'Segundo apellido', 'onkeypress' => "return /[A-Z Ñ]/i.test(event.key)", 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 50]) }}
                    {!! $errors->first('segundoApellido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::text('createdUser_id', $paciente->createdUser_id, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id', 'readonly' => 'true', 'hidden'=>'true']) }}
        </div>
        <div class="form-group">
            {{ Form::text('updateUser_id', $paciente->updateUser_id, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'updateUser Id', 'readonly' => 'true', 'hidden'=>'true']) }}
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    {{ 'CURP' }} &nbsp;&nbsp;&nbsp; <small><a href="https://www.gob.mx/curp/" target="_blank" >
                        <span class="title my-auto"> Consulta tu CURP</span>
                    </a></small>
                    {{ Form::text('curp', $paciente->curp, ['class' => 'form-control' . ($errors->has('curp') ? ' is-invalid' : ''), 'placeholder' => 'XXXX999999XXXXXX99', 'pattern' => '[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}','maxlength' => 18, 'oninput'=>"this.value = this.value.toUpperCase()" ]) }}
                    {!! $errors->first('curp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class ="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            {{ 'Fecha de nacimiento' }}
                            {{ Form::date('fechaNacimiento', $paciente->fechaNacimiento != null? date('Y-m-d',strtotime($paciente->fechaNacimiento)): "", ['class' => 'form-control' . ($errors->has('fechaNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de nacimiento', 'max' => date('Y-m-d'), 'id' => 'fechaNacimiento', 'onkeypress' => "return false", 'value' => old('fechaNacimiento', date('Y-m-d'))]) }}
                            {!! $errors->first('fechaNacimiento', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ 'Edad' }}
                            <div class ="row">
                                <div class ="col-sm">
                                {{ Form::text('edad', $paciente->edad, ['class' => 'form-control form-control-sm'. ($errors->has('edad') ? ' is-invalid' : ''), 'placeholder' => 'Años', 'maxlength' => 2, 'id' =>'edad', 'disabled' => 'disabled']) }}
                                </div>
                                <div class ="col-sm">
                                    <small>años</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Tipo de sangre' }}
                    <select class="browser-default custom-select  @error('gruposanguineo_id') is-invalid @enderror" id="gruposanguineo_id" class="form-control" name="gruposanguineo_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($gruposanguineos as $gruposanguineo)                       
                            <option value="{{ $gruposanguineo->id }}" {{ old('gruposanguineo_id') == $gruposanguineo->id ? 'selected' : ($gruposanguineo->id == $paciente->gruposanguineo_id ? 'selected' : '') }} >{{ $gruposanguineo->slug }}</option>                        
                        @endforeach                
                    </select>
                    {!! $errors->first('sexo_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Sexo' }} <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" 
                    title="Sexo del paciente, es decir la condición biológica y fisiológica de nacimiento."></i>
                    <select class="browser-default custom-select  @error('sexo_id') is-invalid @enderror" id="sexo_id" class="form-control" name="sexo_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($sexos as $sexo)                       
                            <option value="{{ $sexo->id }}" {{ old('sexo_id') == $sexo->id ? 'selected' : ($sexo->id == $paciente->sexo_id ? 'selected' : '') }} >{{ $sexo->descripcion }}</option>                        
                        @endforeach                
                    </select>
                    {!! $errors->first('sexo_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Género' }} <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" 
                    title="Identidad de género del paciente o atributos sociales aprendidos o adoptados por la persona."></i>
                    <select class="browser-default custom-select  @error('genero_id') is-invalid @enderror" id="genero_id" class="form-control" name="genero_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($generos as $genero)                       
                            <option value="{{ $genero->id }}" {{ old('genero_id') == $genero->id ? 'selected' : ($genero->id == $paciente->genero_id ? 'selected' : '') }} >{{ $genero->descripcion }}</option>                        
                        @endforeach                
                    </select>
                    {!! $errors->first('genero_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ '¿Se considerá indigena?' }}
                    <select class="browser-default custom-select  @error('indigena_id') is-invalid @enderror" id="indigena_id" class="form-control" name="indigena_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($indigenas as $indigena)                       
                            <option value="{{ $indigena->id }}" {{ old('indigena_id') == $indigena->id ? 'selected' : ($indigena->id == $paciente->indigena_id ? 'selected' : '') }} >{{ $indigena->opcion }}</option>                        
                        @endforeach                
                    </select>
                    {!! $errors->first('indigena_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    {{ '¿Se autodenomina afromexicano?' }}
                    <select class="browser-default custom-select  @error('afromexicano_id') is-invalid @enderror" id="afromexicano_id" class="form-control" name="afromexicano_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($afromexicanos as $afromexicano)                       
                            <option value="{{ $afromexicano->id }}" {{ old('afromexicano_id') == $afromexicano->id ? 'selected' : ($afromexicano->id == $paciente->afromexicano_id ? 'selected' : '') }} >{{ $afromexicano->opcionAfro }}</option>                        
                        @endforeach                
                    </select>
                    {!! $errors->first('afromexicano_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Correo electrónico' }}
                    {{ Form::text('email', $paciente->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo electrónico','maxlength' => 255, 'type' => 'email' ]) }}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Número de telefóno' }}<small>  (10 dígitos)</small>
                    {{ Form::text('phone', $paciente->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Telefóno','maxlength' => 10, 'onkeypress' => "return /[0-9]/i.test(event.key)"]) }}
                    {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Entidad de nacimiento' }}
                    <select class="browser-default custom-select @error('entidadNac_id') is-invalid @enderror" id="entidadNac_id" class="form-control" name="entidadNac_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($entidades as $entidad)                
                            <option value="{{ $entidad->id }}" {{ old('entidadNac_id') == $entidad->id ? 'selected' : ($entidad->id == $paciente->entidadNac_id ? 'selected' : '') }}>{{ $entidad->entidad }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('entidadNac_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ 'Municipio de nacimiento' }}
                    <select class="browser-default custom-select @error('municipioNac_id') is-invalid @enderror" id="municipioNac_id" class="form-control" name="municipioNac_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($municipiosnac as $municipionac)                       
                            <option value="{{ $municipionac->id }}" {{ old('municipioNac_id') ==  $municipionac->id ? 'selected' : ( $municipionac->id == $paciente->municipioNac_id ? 'selected' : '') }}>{{ $municipionac->municipio }}</option>                        
                        @endforeach  
                    </select>   
                    {!! $errors->first('municipioNac_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle"><strong>Derechohabiencia</strong></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <input class="form-control " type="text" name="dhcount" id="dhcount" hidden>
                        @if ($errors->has('dh'))
                            <small class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seleccionar al menos una opción</small>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-inline">
                        @foreach($derechohabiencias as $derechohabiencia)
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input @error('dh') is-invalid @enderror" type="checkbox" name="dh[{{$derechohabiencia->id}}]" id="dh{{$derechohabiencia->id}}" value= "{{$derechohabiencia->id}}" 
                                    @if(old('dh.'.$derechohabiencia->id) == $derechohabiencia->id)
                                        checked
                                    @else
                                        {
                                            @foreach($paciente->dhp as $pdh)
                                                @if($pdh->derechoHabiencias_id == $derechohabiencia->id)
                                                    checked
                                                @endif  
                                            @endforeach
                                        }
                                    @endif>
                                    <label class="form-check-label" for="dh{{$derechohabiencia->id}}">{{ $derechohabiencia->siglaDH }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group form-inline">
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle"><strong>Domicilio actual</strong></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            {{ 'Calle' }}
                            {{ Form::text('calle', $paciente->calle, ['class' => 'form-control' . ($errors->has('calle') ? ' is-invalid' : ''), 'placeholder' => 'Calle', 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 100]) }}
                            {!! $errors->first('calle', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            {{ 'Número' }}
                            {{ Form::text('numero', $paciente->numero, ['class' => 'form-control' . ($errors->has('numero') ? ' is-invalid' : ''), 'placeholder' => 'Numero']) }}
                            {!! $errors->first('numero', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            {{ 'Colonia' }}
                            {{ Form::text('colonia', $paciente->colonia, ['class' => 'form-control' . ($errors->has('colonia') ? ' is-invalid' : ''), 'placeholder' => 'Colonia', 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 100]) }}
                            {!! $errors->first('colonia', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm">
                        <div class="form-group">
                            {{ 'Entidad' }}                            
                            <select class="browser-default custom-select @error('entidadFederativa_id') is-invalid @enderror" id="entidadFederativa_id" class="form-control" name="entidadFederativa_id">
                                <option value="">Seleccionar...</option>
                                @foreach ($entidades as $entidad)                       
                                    <option value="{{ $entidad->id }}" {{ old('entidadFederativa_id') == $entidad->id ? 'selected' : ($entidad->id == $paciente->entidadFederativa_id ? 'selected' : '') }}>{{ $entidad->entidad }}</option>                        
                                @endforeach                
                            </select>  
                            {!! $errors->first('entidadFederativa_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            {{ 'Municipio' }}
                            <select class="browser-default custom-select @error('municipio_id') is-invalid @enderror" id="municipio_id" class="form-control" name="municipio_id">
                                <option value="">Seleccionar...</option>
                                @foreach ($municipios as $municipio)                       
                                    <option value="{{ $municipio->id }}" {{ old('municipio_id') ==  $municipio->id ? 'selected' : ( $municipio->id == $paciente->municipio_id ? 'selected' : '') }}>{{ $municipio->municipio }}</option>                        
                                @endforeach  
                            </select>  
                            {!! $errors->first('municipio_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="box-footer mt20">
        <div class="row">
            <div class="form-group">
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
    function myFunctionEdad()
    {
        var hoy = new Date();
        var cumpleanos = new Date($('#fechaNacimiento').val());
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if($('#fechaNacimiento').val() == '')
            $('#edad').prop('value', 0);
        else
        {  
            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate()))
                edad--;
            $('#edad').prop('value', edad);
        }
    };

    function myFunctiondh()
    {  
        if($("#dh1").is(':checked'))
        {
            $('#dh2').prop('disabled', true);
            $('#dh2').prop('checked', false);
            $('#dh3').prop('disabled', true);
            $('#dh3').prop('checked', false);
        }
        else{
            if($("#dh2").is(':checked'))
            {
                $('#dh1').prop('disabled', true);
                $('#dh1').prop('checked', false);
                $('#dh3').prop('disabled', true);
                $('#dh3').prop('checked', false);
            }
            else{
                if($("#dh3").is(':checked'))
                {
                    $('#dh2').prop('disabled', true);
                    $('#dh2').prop('checked', false);
                    $('#dh1').prop('disabled', true);
                    $('#dh1').prop('checked', false);
                }
            }
        }
        if($("#dh1").is(':checked')||$("#dh2").is(':checked') || $("#dh3").is(':checked'))
        {            
            $('#dh4').prop('disabled', true);
            $('#dh4').prop('checked', false);
            $('#dh5').prop('disabled', true);
            $('#dh5').prop('checked', false);
            $('#dh6').prop('disabled', true);
            $('#dh6').prop('checked', false);
            $('#dh7').prop('disabled', true);
            $('#dh7').prop('checked', false);
            $('#dh8').prop('disabled', true);
            $('#dh8').prop('checked', false);
            $('#dh9').prop('disabled', true);
            $('#dh9').prop('checked', false);
            $('#dh10').prop('disabled', true);
            $('#dh10').prop('checked', false);
            $('#dh11').prop('disabled', true);
            $('#dh11').prop('checked', false);
            $('#dh12').prop('disabled', true);
            $('#dh12').prop('checked', false);
        }
        else
        {   
            if($("#dh4").is(':checked')||$("#dh5").is(':checked') || $("#dh6").is(':checked') || $("#dh7").is(':checked') || $("#dh8").is(':checked')|| $("#dh9").is(':checked') || $("#dh10").is(':checked')|| $("#dh11").is(':checked')|| $("#dh12").is(':checked'))
            {            
                $('#dh1').prop('disabled', true);
                $('#dh1').prop('checked', false);
                $('#dh2').prop('disabled', true);
                $('#dh2').prop('checked', false);
                $('#dh3').prop('disabled', true);
                $('#dh3').prop('checked', false);
            }
            else
            {
                $('#dh1').prop('disabled', false);
                $('#dh1').prop('checked', false);
                $('#dh2').prop('disabled', false);
                $('#dh2').prop('checked', false);
                $('#dh3').prop('disabled', false);
                $('#dh3').prop('checked', false);         
                $('#dh4').prop('disabled', false);
                $('#dh4').prop('checked', false);
                $('#dh5').prop('disabled', false);
                $('#dh5').prop('checked', false);
                $('#dh6').prop('disabled', false);
                $('#dh6').prop('checked', false);
                $('#dh7').prop('disabled', false);
                $('#dh7').prop('checked', false);
                $('#dh8').prop('disabled', false);
                $('#dh8').prop('checked', false);
                $('#dh9').prop('disabled', false);
                $('#dh9').prop('checked', false);
                $('#dh10').prop('disabled', false);
                $('#dh10').prop('checked', false);
                $('#dh11').prop('disabled', false);
                $('#dh11').prop('checked', false);
                $('#dh12').prop('disabled', false);
                $('#dh12').prop('checked', false);
            }
        }
        myFunctiondhcount();
    };
    function myFunctiondhcount()
    {  
        var sumdh=0;
        if($("#dh1").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh2").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh4").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh3").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh5").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh6").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh7").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh8").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh9").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh10").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh11").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh12").is(':checked')){            
            sumdh = sumdh + 1;
        }
        $('#dhcount').prop('value', sumdh);
    };
   
    $(document).ready(function() {
        myFunctionEdad();
        myFunctiondh();

        $('#fechaNacimiento').change(function(){
            myFunctionEdad();
        });
        
        $('#dh1').on('click', function() {
            myFunctiondh();
        });
        $('#dh2').on('click', function() {
            myFunctiondh();
        });
        $('#dh3').on('click', function() {
            myFunctiondh();
        });
        $('#dh4').on('click', function() {
            myFunctiondh();
        });
        $('#dh5').on('click', function() {
            myFunctiondh();
        });
        $('#dh6').on('click', function() {
            myFunctiondh();
        });
        $('#dh7').on('click', function() {
            myFunctiondh();
        });
        $('#dh8').on('click', function() {
            myFunctiondh();
        });
        $('#dh9').on('click', function() {
            myFunctiondh();
        });
        $('#dh10').on('click', function() {
            myFunctiondh();
        });
        $('#dh11').on('click', function() {
            myFunctiondh();
        });
        $('#dh12').on('click', function() {
            myFunctiondh();
        });
        var entidad_id = $("#entidadFederativa_id").val();
        var oldMunicipio = $("#municipio_id").val();
            if (entidad_id == '') {
                $("#municipio_id").empty();
                $("#municipio_id").append("<option value = ''> Seleccionar... </option>")
                $('#municipio_id').prop('disabled', true);
            }
            else{
                $('#municipio_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidad_id, function (data) 
                {
                    //console.log(data);
                    // VACIAMOS EL DropDownList
                    $("#municipio_id").empty();
                    // AÑADIMOS UN NUEVO label CON EL NOMBRE DEL ELEMENTO SELECCIONADO
                    $("#municipio_id").append("<option value = ''> Seleccionar... </option>")
                    // CONSTRUIMOS EL DropDownList A PARTIR DEL RESULTADO Json (data)
                    data.forEach(element => {
                        if(element.id == oldMunicipio)
                            $("#municipio_id").append("<option value='" + element.id + "'selected > "+ element.municipio +" </option>")
                        else
                            $("#municipio_id").append("<option value='" + element.id + "'>"+ element.municipio +" </option>")
                    });
                });
            }
        var entidadnac_id = $("#entidadNac_id").val();
        var oldMunicipioNac = $("#municipioNac_id").val();
            if (entidadnac_id == '') {
                $("#municipioNac_id").empty();
                $("#municipioNac_id").append("<option value = ''> Seleccionar... </option>")
                $('#municipioNac_id').prop('disabled', true);
            }
            else {
                $('#municipioNac_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidadnac_id, function (data) 
                {
                    //console.log(data);
                    // VACIAMOS EL DropDownList
                    $("#municipioNac_id").empty();
                    // AÑADIMOS UN NUEVO label CON EL NOMBRE DEL ELEMENTO SELECCIONADO
                    $("#municipioNac_id").append("<option value = ''> Seleccionar... </option>")
                    // CONSTRUIMOS EL DropDownList A PARTIR DEL RESULTADO Json (data)
                    data.forEach(element => {
                        if(element.id == oldMunicipioNac)
                            $("#municipioNac_id").append("<option value='" + element.id + "'selected > "+ element.municipio +" </option>")
                        else
                            $("#municipioNac_id").append("<option value='" + element.id + "'>"+ element.municipio +" </option>")
                    });
                });
            }
        $('#entidadFederativa_id').on('change', function() {
            var entidad_id = $("#entidadFederativa_id").val();
            if (entidad_id != '') {
                $('#municipio_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidad_id, function (data) 
                {
                    //console.log(data);
                    // VACIAMOS EL DropDownList
                    $("#municipio_id").empty();
                    // AÑADIMOS UN NUEVO label CON EL NOMBRE DEL ELEMENTO SELECCIONADO
                    $("#municipio_id").append("<option value = ''> Seleccionar... </option>")
                    // CONSTRUIMOS EL DropDownList A PARTIR DEL RESULTADO Json (data)
                    data.forEach(element => {
                        $("#municipio_id").append("<option value='" + element.id + "'>"+ element.municipio +" </option>")
                    });
                });
            } else {
                $("#municipio_id").empty();
                $("#municipio_id").append("<option value = ''> Seleccionar... </option>")
                $('#municipio_id').prop('disabled', true);
            }            
            
        }); 

        $('#entidadNac_id').on('change', function() {
            var entidadNac_id = $("#entidadNac_id").val();
            if (entidadNac_id != '') {
                $('#municipioNac_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidadNac_id, function (data) 
                {
                    //console.log(data);
                    // VACIAMOS EL DropDownList
                    $("#municipioNac_id").empty();
                    // AÑADIMOS UN NUEVO label CON EL NOMBRE DEL ELEMENTO SELECCIONADO
                    $("#municipioNac_id").append("<option value = ''> Seleccionar... </option>")
                    // CONSTRUIMOS EL DropDownList A PARTIR DEL RESULTADO Json (data)
                    data.forEach(element => {
                        $("#municipioNac_id").append("<option value='" + element.id + "'>"+ element.municipio +" </option>")
                    });
                });
            } else {
                $("#municipioNac_id").empty();
                $("#municipioNac_id").append("<option value = ''> Seleccionar... </option>")
                $('#municipioNac_id').prop('disabled', true);
            }            
            
        }); 
    });

</script>
