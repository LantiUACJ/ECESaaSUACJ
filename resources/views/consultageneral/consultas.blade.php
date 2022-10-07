@extends('layouts.app')

@section('content')
<div class="container-fluid start">
    <div class="container-fluid">
        <div class="navigation">
            <ul class="navul">
                <li class="brandli">
                    <img class="appimg" src="{{ asset('img/leonardo.jpg') }}" alt="">
                    <span class="maintitle"><h5 class="brandtitle">{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</h5></span>
                </li>
                <hr class="menuhr">
                <li class="catli" data-toggle="tooltip" data-placement="right" title="Registrar Consulta">
                    <a href="{{ route('registrarconsulta', $paciente->id) }}" type="button">
                        <span class="icon my-auto"><i class="fa fa-plus-square text-success" aria-hidden="true"></i></span>
                        <span class="title my-auto">Nueva Consulta</span>
                    </a>
                </li>
                <hr class="menuhr">
                <!-- 
                <li class="catli" data-toggle="tooltip" data-placement="right" title="Registrar Nota de Urgencia">
                    <a type="button">
                        <span class="icon my-auto"><i class="fa fa-plus-square text-danger" aria-hidden="true"></i></span>
                        <span href="#" type="button" class="title my-auto">Urgencia</span>
                    </a>
                </li>
                <hr class="menuhr">
                <li class="catli" data-toggle="tooltip" data-placement="right" title="Registrar Nota de Hospitalización">
                    <a type="button">
                        <span class="icon my-auto"><i class="fa fa-plus-square text-primary" aria-hidden="true"></i></span>
                        <span class="title my-auto"> Hospitalización</a>
                    </a>
                </li>
                -->
                <!--
                <hr class="specialhr">
                <li class="spaceli text-center">
                    <button class="btn btn-success mt-terminar" data-toggle="tooltip" data-placement="right" title="Terminar Consulta">
                        <i class="bi bi-check2-square"></i>
                        <span>Teminar Consulta</span>
                    </button>
                </li>
                -->
            </ul>
        </div>
    </div>

    <div class="container-fluid main">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Paciente - Consulta
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                Datos del Paciente
                            </div>
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
                                        <input class="pacinput" id="sexo" type="text"  value="Masculino" autocomplete="sexo" maxlength="255" disabled autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('registrarconsulta', $paciente->id) }}" type="button" class="btn btn-success">+ Consulta</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" type="button" class="btn btn-success">+ Urgencia</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" type="button" class="btn btn-success">+ Hospitalización</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="card">
                            <div class="card-body">
                                <h5>{{ __('Consultas') }}</h5>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-body">
                                @if ($consultas->count() > 0)
                                    <table class="table table-striped text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Fecha/Hora</th>
                                                <th scope="col">Motivo</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($consultas as $consulta)
                                                <tr>
                                                    <th label="#" scope="row">{{ $count++ }}</th>
                                                    <td label="Fecha/Hora">{{ $consulta->created_at }}</td>
                                                    <td label="Motivo">{{ $consulta->motivoConsulta }}</td>
                                                    <td label="Acciones">
                                                        <a class="action-btn btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Consulta"
                                                            href="{{ route('viewconsulta', $consulta->id) }}"><!--  --> 
                                                        <i class="fa fa-eye action-ico" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($consultas->count() > 0)
                                        <div class="container">
                                            {{ $consultas->links() }}
                                        </div>
                                    @endif
                                @else
                                    <br><br>
                                    <h5 class="opacy6">El paciente no tiene Consultas para mostrar... Da de alta una nueva Consulta</h5>
                                    <br><br>
                                    <div>
                                        <a href="{{ route('registrarconsulta', $paciente->id) }}" type="button" class="btn btn-success">Nueva Consulta</a>
                                    </div>
                                    <br><br>
                                    <img class="emptyimg" src="{{ asset('img/empty.png')}}" alt="">
                                @endif
    
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
