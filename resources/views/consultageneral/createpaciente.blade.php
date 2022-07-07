@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="navigation">
            <ul class="text-center navul">
                <li class="brandli">
                    <img class="appimg" src="{{ asset('img/dr-here.png') }}" alt="">
                </li>
                <hr class="menuhr">
                <br>
                <li class="catli">
                    <a href="#">
                        <span class="maintitle my-auto mx-auto"><h5 class="brandtitle">Nombre: {{ auth()->user()->name }}</h5></span>
                    </a>
                </li>
                <br>
                <li class="catli">
                    <br>
                    <span class="maintitle"><h5 class="brandtitle my-auto">Correo: {{ auth()->user()->email }}</h5></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid main">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"><strong>Registrar paciente</strong></span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('storepacienteconsulta') }}"  role="form" enctype="multipart/form-data">
                            @csrf
    
                            <div class="box box-info padding-1">
                                <div class="box-body">        
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('Nombre(s)') }}
                                                {{ Form::text('nombre', null, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'required' => 'required']) }}
                                                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('Primer apellido') }}
                                                {{ Form::text('primerApellido', null, ['class' => 'form-control' . ($errors->has('primerApellido') ? ' is-invalid' : ''), 'placeholder' => 'Primerapellido','required' => 'required']) }}
                                                {!! $errors->first('primerApellido', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('Segundo apellido') }}
                                                {{ Form::text('segundoApellido', null, ['class' => 'form-control' . ($errors->has('segundoApellido') ? ' is-invalid' : ''), 'placeholder' => 'Segundoapellido']) }}
                                                {!! $errors->first('segundoApellido', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('createdUser_id', $paciente->, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id', 'readonly' => 'true', 'hidden'=>'true']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::text('updateUser_id', null, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'updateUser Id', 'readonly' => 'true', 'hidden'=>'true']) }}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('CURP') }}
                                                {{ Form::text('curp', null, ['class' => 'form-control' . ($errors->has('curp') ? ' is-invalid' : ''), 'placeholder' => 'CURP','required' => 'required', 'pattern' => '[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}','maxlength' => 18 ]) }}
                                                {!! $errors->first('curp', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('Fecha de Nacimiento') }}
                                                {{ Form::date('fechaNacimiento', null, ['class' => 'form-control' . ($errors->has('fechaNacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de nacimiento','required' => 'required']) }}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('Sexo') }}
                                                <select class="browser-default custom-select" id="sexo_id" class="form-control" name="sexo_id" required>
                                                    <option value="">Seleccionar...</option>
                                                    @foreach ($sexos as $sexo)                       
                                                        <option value="{{ $sexo->id }}" @if($sexo->id == old('sexo_id')) selected @endif>{{ $sexo->descripcion }}</option>                        
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
                                                <select class="browser-default custom-select" id="entidadNac_id" class="form-control" name="entidadNac_id" required>
                                                    <option value="">Seleccionar...</option>
                                                    @foreach ($entidades as $entidad)                       
                                                        <option value="{{ $entidad->id }}" @if($entidad->id == old('entidadNac_id')) selected @endif>{{ $entidad->entidad }}</option>                        
                                                    @endforeach                
                                                </select>                    
                                                {!! $errors->first('entidadNac_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                {{ Form::label('Municipio de nacimiento') }}
                                                <select class="browser-default custom-select" id="municipioNac_id" class="form-control" name="municipioNac_id" required >
                                                    <option value="">Seleccionar...</option>
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
                                                        {{ Form::text('calle', null, ['class' => 'form-control' . ($errors->has('calle') ? ' is-invalid' : ''), 'placeholder' => 'Calle']) }}
                                                        {!! $errors->first('calle', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ Form::label('Número') }}
                                                        {{ Form::text('numero', null, ['class' => 'form-control' . ($errors->has('numero') ? ' is-invalid' : ''), 'placeholder' => 'Numero']) }}
                                                        {!! $errors->first('numero', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ Form::label('Colonia') }}
                                                        {{ Form::text('colonia', null, ['class' => 'form-control' . ($errors->has('colonia') ? ' is-invalid' : ''), 'placeholder' => 'Colonia']) }}
                                                        {!! $errors->first('colonia', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                    
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ Form::label('Entidad') }}                            
                                                        <select class="browser-default custom-select" id="entidadFederativa_id" class="form-control" name="entidadFederativa_id" required>
                                                            <option value="">Seleccionar...</option>
                                                            @foreach ($entidades as $entidad)                       
                                                                <option value="{{ $entidad->id }}" @if($entidad->id == old('entidadFederativa_id')) selected @endif>{{ $entidad->entidad }}</option>                        
                                                            @endforeach                
                                                        </select>  
                                                        {!! $errors->first('entidadFederativa_id', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ Form::label('Municipio') }}
                                                        <select class="browser-default custom-select" id="municipio_id" class="form-control" name="municipio_id" required >
                                                            <option value="">Seleccionar...</option> 
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
                                            <button type="submit" class="btn btn-primary">Guardar Paciente</button>
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
</div>
<script type="text/javascript">     
    jQuery(function ($) {

        $('#entidadFederativa_id').on('change', function() {
            var entidad_id = $("#entidadFederativa_id").val();
            if (entidad_id != '') {
                $('#municipio_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidad_id, function (data) 
                {
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
@endsection
