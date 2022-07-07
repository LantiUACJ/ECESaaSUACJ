<div class="box box-info padding-1">
    <div class="box-body">        
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    {{ Form::label('Nombre(s)') }}
                    {{ Form::text('nombre', $paciente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ Form::label('Primer apellido') }}
                    {{ Form::text('primerApellido', $paciente->primerApellido, ['class' => 'form-control' . ($errors->has('primerApellido') ? ' is-invalid' : ''), 'placeholder' => 'Primerapellido']) }}
                    {!! $errors->first('primerApellido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ Form::label('Segundo apellido') }}
                    {{ Form::text('segundoApellido', $paciente->segundoApellido, ['class' => 'form-control' . ($errors->has('segundoApellido') ? ' is-invalid' : ''), 'placeholder' => 'Segundoapellido']) }}
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
                    {{ Form::label('CURP') }}
                    {{ Form::text('curp', $paciente->curp, ['class' => 'form-control' . ($errors->has('curp') ? ' is-invalid' : ''), 'placeholder' => 'CURP', 'pattern' => '[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}','maxlength' => 18 ]) }}
                    {!! $errors->first('curp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ Form::label('Fecha de Nacimiento') }}
                    {{ Form::date('fechaNacimiento', \Carbon\Carbon::parse($paciente->fechaNacimiento)->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('fechaNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de nacimiento', 'max' => \Carbon\Carbon::parse($paciente->fechaNacimiento)->format('Y-m-d')]) }}
                    {!! $errors->first('fechaNacimiento', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    {{ Form::label('Sexo') }}
                    <select class="browser-default custom-select  @error('sexo_id') is-invalid @enderror" id="sexo_id" class="form-control" name="sexo_id">
                        <option value="">Seleccionar...</option>
                        @foreach ($sexos as $sexo)                       
                            <option value="{{ $sexo->id }}" {{ old('sexo_id') == $sexo->id ? 'selected' : ($sexo->id == $paciente->sexo ? 'selected' : '') }} >{{ $sexo->descripcion }}</option>                        
                        @endforeach                
                    </select>
                    {!! $errors->first('sexo_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-sm">
                <div class="form-group">
                    {{ Form::label('Entidad de nacimiento') }}
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
                    {{ Form::label('Municipio de nacimiento') }}
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
                <span class="card-subtitle">Domicilio actual</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            {{ Form::label('Calle') }}
                            {{ Form::text('calle', $paciente->calle, ['class' => 'form-control' . ($errors->has('calle') ? ' is-invalid' : ''), 'placeholder' => 'Calle']) }}
                            {!! $errors->first('calle', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            {{ Form::label('Número') }}
                            {{ Form::text('numero', $paciente->numero, ['class' => 'form-control' . ($errors->has('numero') ? ' is-invalid' : ''), 'placeholder' => 'Numero']) }}
                            {!! $errors->first('numero', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            {{ Form::label('Colonia') }}
                            {{ Form::text('colonia', $paciente->colonia, ['class' => 'form-control' . ($errors->has('colonia') ? ' is-invalid' : ''), 'placeholder' => 'Colonia']) }}
                            {!! $errors->first('colonia', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm">
                        <div class="form-group">
                            {{ Form::label('Entidad') }}                            
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
                            {{ Form::label('Municipio') }}
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
    jQuery(function ($) {
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
