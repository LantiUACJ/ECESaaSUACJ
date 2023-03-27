@extends('layouts.app')

@section('content')

<h5 class="section-title title">Consultas</h5>
<p class="breadcrumbs">
    <a href="{{ route('home') }}">Inicio</a> >
    Consultas
</p>

<hr class="opactity3">

@if ($consultas->count() > 0)
    <div class="menu-dashboard">
        <div class="left">
            <a href="{{ route('seleccionarpaciente') }}" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>Registrar consulta</a>
        </div>
        <div class="right-spaced">
            <form method="GET" action="{{ route('searchconsultamedico') }}">
                <div class="row nomargin center nomargbot">
                    @csrf
                    <div class="input-field col s6 shrink-input" style="min-width: 300px">
                        <input placeholder="Buscar Consulta" id="search" type="text" class="validate" name="search">
                        <!-- <label for="search">Buscar consulta</label> -->
                    </div>
                    <div class="col s6">
                        <button type="submit" class="waves-effect waves-light btn" style="font-family: 'Montserrat', sans-serif;"><i class="material-icons left">search</i>Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="legend">
        <div class="legend-cont">
            <div class="legend-color-three"></div>
            <p>Consulta expirada</p>
        </div>
        <div class="legend-cont">
            <div class="legend-color-one"></div>
            <p>Consulta pendiente</p>
        </div>
        <div class="legend-cont">
            <div class="legend-color-two"></div>
            <p>Consulta terminada</p>
        </div>
    </div>
    <div class="scroll-section scroll-table">
        <div class="table-content">
            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>Fecha / Hora</th>
                        <th>Paciente</th>
                        <th>Motivo</th>
                        <th class="icons-row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultas as $consulta)
                        @if ($consulta->terminada)
                            <tr>
                                <td>{{$consulta->created_at->format('d/m/Y') }} :: {{ $consulta->created_at->format('g:i A') }}</td>
                                <td>{{ $consulta->paciente->nombre." ".$consulta->paciente->primerApellido." ".$consulta->paciente->segundoApellido }}</td>
                                <td>{{ $consulta->motivoConsulta }}</td>
                                <td class="icons-row">
                                    <i class="empty"></i>
                                    <a href="{{ route('viewconsulta', $consulta->id) }}">
                                        <i class="material-icons tooltipped" data-position="top"
                                        data-tooltip="Ver">remove_red_eye</i></a>
                                </td>
                            </tr>
                        @else
                            @if (\Carbon\Carbon::now() > $consulta->created_at->addHours(2))
                                <tr class="expired">
                                    <td>{{$consulta->created_at->format('d/m/Y') }} :: {{ $consulta->created_at->format('g:i A') }}</td>
                                    <td>{{ $consulta->paciente->nombre." ".$consulta->paciente->primerApellido." ".$consulta->paciente->segundoApellido }}</td>
                                    <td>{{ $consulta->motivoConsulta }}</td>
                                    <td class="icons-row">
                                        <a href="{{ route('viewconsulta', $consulta->id) }}">
                                            <i class="material-icons tooltipped" data-position="top"
                                            data-tooltip="Solo Terminar">lock</i>
                                        </a>
                                    </td>
                                </tr> 
                            @else
                                <tr class="unended">
                                    <td>{{$consulta->created_at->format('d/m/Y') }} :: {{ $consulta->created_at->format('g:i A') }}</td>
                                    <td>{{ $consulta->paciente->nombre." ".$consulta->paciente->primerApellido." ".$consulta->paciente->segundoApellido }}</td>
                                    <td>{{ $consulta->motivoConsulta }}</td>
                                    <td class="icons-row">
                                        <a href="{{ route('continuarconsulta', $consulta->id) }}">
                                            <i class="material-icons tooltipped" data-position="top"
                                            data-tooltip="Continuar">edit</i>
                                        </a>
                                        <a href="{{ route('viewconsulta', $consulta->id) }}">
                                            <i class="material-icons tooltipped" data-position="top"
                                            data-tooltip="Ver">remove_red_eye</i>
                                        </a>
                                    </td>
                                </tr> 
                            @endif           
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($consultas->count() > 14)
            {{ $consultas->links('vendor.pagination.materializecss') }}
        @endif
    </div>
@else
    @if ($search)
        <div class="menu-dashboard">
            <div class="left">
                <a href="{{ route('seleccionarpaciente') }}" class="waves-effect waves-light btn">
                    <i class="material-icons left">add</i>Registrar consulta</a>
            </div>
            <div class="right-spaced">
                <form method="GET" class="row nomargin center nomargbot" action="{{ route('searchconsultamedico') }}">
                    <div class="input-field col s6 shrink-input" style="min-width: 300px">
                        <input placeholder="Buscar Consulta" id="search" type="text" class="validate" name="search">
                        <!-- <label for="search">Buscar consulta</label> -->
                    </div>
                    <div class="col s6">
                        <button type="submit" class="waves-effect waves-light btn" style="font-family: 'Montserrat', sans-serif;"><i class="material-icons left">search</i>Buscar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="legend">
            <div class="legend-cont">
                <div class="legend-color-one"></div>
                <p>Consulta pendiente</p>
            </div>
            <div class="legend-cont">
                <div class="legend-color-two"></div>
                <p>Consulta terminada</p>
            </div>
        </div>
        <div class="scroll-section scroll-table">
            <div class="table-content">
                <table class="striped highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Fecha / Hora</th>
                            <th>Paciente</th>
                            <th>Motivo</th>
                            <th class="icons-row">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="opacity: 0.6;"><td colspan="4"><h6 class="opacy6">No hay registros de la búsqueda realizada</h6></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h6 style="opacity: 0.6; margin-top: 15px">El Doctor {{ auth()->user()->name }}, no cuenta con consultas registradas</h6>
        
        <div style="margin-top: 15px">
            <a href="{{ route('seleccionarpaciente') }}" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>Registrar consulta</a>
        </div>
    @endif
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@if(Session::has('successMsg'))
    <script> 
        M.toast({html: '<b>{{ Session::get('successMsg') }}</b>' , classes: 'rounded green', displayLength: 5000}); 
    </script>
@endif
@if(Session::has('errorMsg'))
    <script> 
        M.toast({html: '<b>{{ Session::get('errorMsg') }}</b>' , classes: 'rounded red', displayLength: 5000}); 
    </script>
@endif

@endsection
