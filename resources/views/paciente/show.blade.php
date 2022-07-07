@extends('layouts.app')

@section('template_title')
    {{ $paciente->name ?? 'Show Paciente' }}
@endsection

@section('content')
    <section class="mainhome content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"><strong>Datos del paciente:</strong> {{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pacientes.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body  text-left">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <strong>CURP:</strong>
                                        {{ $paciente->curp }}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <strong>Fecha de nacimiento:</strong>
                                        {{ \Carbon\Carbon::parse($paciente->fechaNacimiento)->format('d/m/Y')  }}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <strong>Edad:</strong>
                                        {{\Carbon\Carbon::parse($paciente->fechaNacimiento)->age }} años
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <strong>Sexo:</strong>
                                        {{ $paciente->sexo->descripcion }}
                                    </div>
                                </div>
                                <div class="col-sm">                                    
                                    <div class="form-group">
                                        <strong>Municipio de nacimiento:</strong>
                                        {{ $paciente->municipionac->municipio }}
                                    </div>                                    
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <strong>Entidad de nacimiento:</strong>
                                        {{ $paciente->entidadesfederativanac->entidad }}
                                    </div>
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
                                                <strong>Calle:</strong>
                                                {{ $paciente->calle }}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <strong>Número:</strong>
                                                {{ $paciente->numero }}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <strong>Colonia:</strong>
                                                {{ $paciente->colonia }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <strong>Municipio:</strong>
                                                {{ $paciente->municipio->municipio }}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <strong>Entidad:</strong>
                                                {{ $paciente->entidadesfederativa->entidad }}
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
