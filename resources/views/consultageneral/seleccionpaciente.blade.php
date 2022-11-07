@extends('layouts.app')

@section('content')

<h5 class="section-title title">Seleccionar paciente</h5>
<p class="breadcrumbs">
    <a href="{{ route('home') }}">Inicio</a> >
    <a href="{{ route('consultamedico') }}">Consultas</a> >
    Seleccionar paciente
</p>
<hr class="opactity3">
@if ($pacientes->count() > 0)
    <div>
        <p style="padding-top: 0.5rem">Selecciona el paciente que atenderás o agrega un nuevo paciente</p>
        <br>
    </div>
@endif

@if ($pacientes->count() > 0)
    <div class="menu-dashboard">
        <div class="left">
            <a href="{{ route('createpacfromcons') }}" class="waves-light btn">
                <i class="material-icons left">add</i>Nuevo Paciente</a>
        </div>
        <div class="right-spaced">
            <form method="GET" class="row nomargin center nomargbot" action="{{ route('searchpacienteseleccion') }}">
                <div class="input-field col s6 shrink-input" style="min-width: 300px">
                    <input placeholder="Buscar Paciente" id="search" type="text" class="validate" name="search">
                </div>
                <div class="col s6">
                    <button class="waves-light btn" type="submit">
                        <i class="material-icons left">search</i>Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="scroll-section scroll-table">
        <div class="table-content">
            <table class="striped highlight responsive-table cssanimation fadeInBottom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CURP</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th class="icons-row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $paciente->curp }}</td>
                            <td>{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</td>
                            <td>{{ $paciente->sexo->descripcion }}</td>
                            <td class="icons-row">
                                <a href="{{ route('registrarconsulta', $paciente->id) }}"
                                    class="waves-effect waves-light btn" style="color: white !important">seleccionar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($pacientes->count() > 15)
            {{ $pacientes->links('vendor.pagination.materializecss') }}
        @endif
    </div>
@else  
    @if ($search)
        <div class="menu-dashboard">
            <div class="left">
                <a href="{{ route('createpacfromcons') }}" class="waves-effect waves-light btn">
                    <i class="material-icons left">add</i>Nuevo Paciente</a>
            </div>
            <div class="right-spaced">
                <form method="GET" class="row nomargin center nomargbot" action="{{ route('searchpacienteseleccion') }}">
                    <div class="input-field col s6 shrink-input" style="min-width: 300px">
                        <input placeholder="Buscar Paciente" id="search" type="text" class="validate" name="search">
                    </div>
                    <div class="col s6">
                        <button class="waves-light btn" type="submit">
                            <i class="material-icons left">search</i>Buscar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="scroll-section scroll-table">
            <div class="table-content">
                <table class="striped highlight responsive-table cssanimation fadeInBottom">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CURP</th>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th class="icons-row">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="opacity: 0.6;"><td colspan="4"><h6 class="opacy6">No hay registros en la búsqueda realizada</h6></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h6 style="opacity: 0.6; margin-top: 15px">No hay pacientes registrados... Da de alta un nuevo paciente</h6>
        
        <div style="margin-top: 15px">
            <a href="{{ route('createpacfromcons') }}" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>Registrar Paciente
            </a>
        </div>
    @endif
@endif
@endsection
