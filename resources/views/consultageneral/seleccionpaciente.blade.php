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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>Selecciona el paciente para realizar la consulta</h5>
                    </div>
                    <div class="card-body">
                        @if ($pacientes->count() > 0)
                            <div class="row">
                                <div class="col-md-4 col-sm-4 t-left">
                                    <a class="btn btn-primary my-sm-0 mybtn" href="{{ route('seleccionarpaciente') }}" role="button">Nuevo Paciente</a>
                                </div>
                                <form method="GET" class="form-inline my-2 my-lg-0 mysearchbar col-md-8 col-sm-8 t-right" action="{{ route('searchpacientemedico') }}">
                                    <input class="form-control mr-sm-2 mysearchst" type="search" placeholder="Buscar Paciente"
                                    aria-label="Search" name="search">
                                    <button class="btn btn-outline-success my-2 my-sm-0 mybtn" type="submit">Buscar</button>
                                </form>
                            </div>
                            <br>
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">CURP</th>
                                        <th scope="col">Sexo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($pacientes as $paciente)
                                        <tr>
                                            <th label="#" scope="row">{{ $count++ }}</th>
                                            <td label="Nombre">{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</td>
                                            <td label="CURP">{{ $paciente->curp }}</td>
                                            @if ($paciente->sexo_id == 1)
                                                <td label="Sexo">Hombre</td>
                                            @elseif ($paciente->sexo_id == 2)
                                                <td label="Sexo">Mujer</td>
                                            @elseif ($paciente->sexo_id == 8)
                                                <td label="Sexo">Se ignora</td>
                                            @else
                                                <td label="Sexo">No especificado</td>
                                            @endif
                                            <td label="Acciones">
                                                <a class="action-btn btn btn-success" href="{{ route('registrarconsulta', $paciente->id) }}">
                                                Seleccionar Paciente
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($pacientes->count() > 0)
                                <div class="container">
                                    {{ $pacientes->links() }}
                                </div>
                            @endif  
                        @else
                            <br><br>
                            <h3 class="opacy6">No hay pacientes en el sistema... Da de alta un nuevo paciente</h3>
                            <br><br>
                            <div>
                                <a href="{{ route('pacientes.create') }}" type="button" class="btn btn-success">Nuevo Paciente</a>
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
@endsection
