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
    
                            @include('paciente.form')
                            
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
