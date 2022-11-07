@extends('layouts.app')

@section('template_title')
    Paciente
@endsection

@section('content')

<h5 class="section-title title">Pacientes</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="{{ route('pacientes.index') }}">Pacientes</a>
</p>
<hr class="opactity3">
<div class="menu-dashboard">
    <a href="{{ route('pacientes.create') }}" class="waves-effect waves-light btn"><i
            class="material-icons left">add</i>Registrar paciente</a>
</div>

<div class="scroll-section scroll-table">
    <div class="table-content">
        <table class="striped highlight responsive-table cssanimation fadeInBottom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CURP</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>Entidad de nacimiento</th>
                    <th>Sexo</th>
                    <th class="icons-row">Acción</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $paciente->curp }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->primerApellido }}</td>
                    <td>{{ $paciente->segundoApellido }}</td>
                    <td>{{ \Carbon\Carbon::parse($paciente->fechaNacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $paciente->entidadesfederativanac->entidad }}</td>
                    <td>{{ $paciente->sexo->descripcion }}</td>
                    <td class="icons-row">
                        <a href="{{ route('pacientes.show',$paciente->id) }}">
                            <i class="material-icons tooltipped" data-position="top" data-tooltip="Ver">remove_red_eye</i> 
                        </a>
                        <a href="{{ route('pacientes.edit',$paciente->id) }}" >
                            <i class="material-icons tooltipped" data-position="top" data-tooltip="Editar">edit</i>
                        </a>   
                        <a class="modal-trigger" href="#deletepac{{$paciente->id}}">
                            <i class="material-icons tooltipped" data-position="top" data-tooltip="Eliminar">delete</i>
                        </a>
                    </td>
                </tr>
                <!-- Modal Structure -->
                <div id="deletepac{{$paciente->id}}" class="modal" style="padding: 1rem 2rem">
                    <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                        <p style="font-size: 1.2rem; padding-bottom: 1rem; display: flex; grid-gap: 1rem; align-items: center; font-weight: bold;"> 
                            <i class="material-icons" style="color: rgb(235, 0, 0); font-size: 2.5rem;">warning</i>
                            Esta acción es irreversible</p>
                        <p>¿Está seguro de que quiere <b>eliminar</b> la información del paciente: <b>{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</b>?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('pacientes.index') }}" class="modal-close teal waves-effect waves-green btn-flat" style="color: white">Cancelar</a>
                            <button type="submit" class="modal-close red waves-effect waves-red btn-flat" style="color: white">Sí, eliminar información</button>
                        </div>
                    </form>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($pacientes->count() > 0)
        {{ $pacientes->links('vendor.pagination.materializecss') }}
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@if ($message = Session::get('success'))
    <script> 
        M.toast({html: '{{$message}}' , classes: 'rounded green', displayLength: 5000}); 
    </script>
@endif
@if ($message = Session::get('error'))
    <script> 
        M.toast({html: '{{$message}}' , classes: 'rounded red', displayLength: 5000}); 
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.tooltipped');
        var options = {};
        var instances = M.Tooltip.init(elems, options);
    });

    var elems = null;
    document.addEventListener('DOMContentLoaded', function () {
        elems = document.querySelectorAll('.collapsible');
        var options = {};
        var instances = M.Collapsible.init(elems, options);

    });

    $(window).resize(function () {
        if ($(window).width() <= 960) {
            elems.forEach((elmnt, i) => {
            });
        }
    });

</script>
@endsection
