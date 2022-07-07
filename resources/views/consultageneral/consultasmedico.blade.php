@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="navigation" id="nav-menu">
            <ul class="text-center navul">
                <li class="brandli">
                    <img class="appimg" src="{{ asset('img/dr-here.png') }}" alt="">
                </li>
                <hr class="menuhr">
                <br>
                <li class="catli" data-toggle="tooltip" data-placement="right" title="{{ auth()->user()->name }}">
                    <a href="#">
                        <span class="maintitle my-auto mx-auto"><h5 class="brandtitle">Nombre: {{ auth()->user()->name }}</h5></span>
                    </a>
                </li>
                <br>
                <li class="catli" data-toggle="tooltip" data-placement="right" title="{{ auth()->user()->email }}">
                    <br>
                    <span class="maintitle wordwrap"><h5 class="brandtitle my-auto">Correo: {{ auth()->user()->email }}</h5></span>
                    <br>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid main" id="menu-main">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(Session::has('successMsg'))
                    <div class="alert alert-success text-center"> 
                        {{ Session::get('successMsg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card text-center">
                    <div class="card-header">
                        <h5>Consultas del Doctor - {{ auth()->user()->name }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($consultas->count() > 0)
                            <div class="row">
                                <div class="col-md-6 t-left">
                                    <a class="btn btn-primary my-sm-0 mybtn" href="{{ route('seleccionarpaciente') }}" role="button">Nueva Consulta</a>
                                </div>
                                <form method="GET" class="form-inline my-2 my-lg-0 mysearchbar col-md-6 t-right" action="{{ route('searchconsultamedico') }}">
                                    <input class="form-control mr-sm-2 mysearchst" type="search" placeholder="Buscar Consulta"
                                    aria-label="Search" name="search">
                                    <button class="btn btn-outline-success my-2 my-sm-0 mybtn" type="submit">Buscar</button>
                                </form>
                            </div>
                            <br>
                            <div class="row">
                                <div class="bg-info info-box"></div>
                                <div class="col-md-6 t-left"> Consultas sin terminar </div>
                            </div>
                            <br>
                            <table class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha/Hora</th>
                                        <th scope="col">Paciente</th>
                                        <th scope="col">Motivo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($consultas as $consulta)
                                        @if ($consulta->terminada)
                                            <tr>
                                                <th label="#" scope="row">{{ $count++ }}</th>
                                                <td label="Fecha/Hora">{{$consulta->created_at->format('d - m - Y') }}::{{ $consulta->created_at->format('H:i') }}</td>
                                                <td label="Paciente">{{ $consulta->paciente->nombre." ".$consulta->paciente->primerApellido." ".$consulta->paciente->segundoApellido }}</td>
                                                <td label="Motivo">{{ $consulta->motivoConsulta }}</td>
                                                <td label="Acciones">
                                                    <a class="action-btn btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Consulta"
                                                        href="{{ route('viewconsulta', $consulta->id) }}">
                                                    <i class="fa fa-eye action-ico" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="bg-info opacity-50">
                                                <th label="#" scope="row">{{ $count++ }}</th>
                                                <td label="Fecha/Hora">{{$consulta->created_at->format('d - m - Y') }}::{{ $consulta->created_at->format('H:i') }}</td>
                                                <td label="Paciente">{{ $consulta->paciente->nombre." ".$consulta->paciente->primerApellido." ".$consulta->paciente->segundoApellido }}</td>
                                                <td label="Motivo">{{ $consulta->motivoConsulta }}</td>
                                                <td label="Acciones">
                                                    <a class="action-btn btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Continuar Consulta"
                                                    href="{{ route('continuarconsulta', $consulta->id) }}">
                                                        <i class="fa fa-pencil-square action-ico" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="action-btn btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Consulta"
                                                    href="{{ route('viewconsulta', $consulta->id) }}">
                                                        <i class="fa fa-eye action-ico" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>                                            
                                        @endif
                                        
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
                            <h3 class="opacy6">No hay consultas para el Doctor {{ auth()->user()->name }}... Da de alta una nueva Consulta</h3>
                            <br><br>
                            <div>
                                <a href="{{ route('seleccionarpaciente') }}" type="button" class="btn btn-success">Nueva Consulta</a>
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
