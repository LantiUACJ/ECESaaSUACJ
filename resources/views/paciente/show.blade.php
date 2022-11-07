@extends('layouts.app')

@section('template_title')
    {{ $paciente->name ?? 'Ver Paciente' }}
@endsection

@section('content')
    <h5 class="section-title title">Consultar datos del paciente</h5>
    <p class="breadcrumbs">
        <a href="{{ url('/home') }}">Inicio</a> >
        <a href="{{ route('pacientes.index') }}">Pacientes</a> >
        <a href="#!">Consultar paciente</a>
    </p>
    <hr class="opactity3">

    <div class="scroll-section">
        <div class="form-group">
            <h6 class="subtt">Datos generales del paciente: <b>{{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }}</b></h6>
            <div class="input-field col s12 m6 l6 txtarin no-mar">
                <div class="row nomargbot">
                    <div class="col s12">
                        <div class="row nomargbot">
                            <div class="col s12 m6 l4">
                                <p>CURP: <b>{{ $paciente->curp }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Fecha de nacimiento: <b>{{ \Carbon\Carbon::parse($paciente->fechaNacimiento)->format('d/m/Y')  }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Edad: <b>{{\Carbon\Carbon::parse($paciente->fechaNacimiento)->age }} años</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m6 l6 txtarin no-mar">
                <div class="row nomargbot">
                    <div class="col s12">
                        <div class="row nomargbot">
                            <div class="col s12 m6 l4">
                                <p>Tipo de sangre: <b> {{ $paciente->gruposanguineo->slug }} </b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Sexo: <b>{{ $paciente->sexo->descripcion }} </b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Género: <b>{{ $paciente->genero->descripcion }} </b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m6 l6 txtarin no-mar">
                <div class="row nomargbot">
                    <div class="col s12">
                        <div class="row nomargbot">
                            <div class="col s12 m6 l4">
                                <p>¿Se considerá indigena?: <b>{{ $paciente->indigena->opcion }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>¿Se autodenomina afromexicano?: <b>{{ $paciente->afromexicano->opcionAfro }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Correo electrónico: <b>{{ $paciente->email }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field col s12 m6 l6 txtarin no-mar">
                <div class="row nomargbot">
                    <div class="col s12">
                        <div class="row nomargbot">
                            <div class="col s12 m6 l4">
                                <p>Número de teléfono (10 dígitos): <b>{{ $paciente->phone }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Entidad de nacimiento: <b> {{ $paciente->entidadesfederativanac->entidad }}</b></p>
                            </div>
                            <div class="col s12 m6 l4">
                                <p>Municipio de nacimiento: <b>{{ $paciente->municipionac->municipio }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h6 class="subtt">Derechohabiencias</h6>
            <div class="row nomargbot">
                <div class="col s12">
                    <div class="row nomargbot">
                        @foreach($paciente->dhp as $pdh)
                        <div class="col s12 m6 l4">
                            
                                <p><b>{{ $pdh->derechohabiencia->siglaDH }}</b></p>
                           
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h6 class="subtt">Domicilio actual</h6>
            <div class="row nomargbot">
                <div class="col s12">
                    <div class="row nomargbot">
                        <div class="col s12 m6 l4">
                            <p>Calle: <b>{{ $paciente->calle }}</b></p>
                        </div>
                        <div class="col s12 m6 l4">
                            <p>Número: <b>{{ $paciente->numero }}</b></p>
                        </div>
                        <div class="col s12 m6 l4">
                            <p>Colonia: <b>{{ $paciente->colonia }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row nomargbot">
                <div class="col s12">
                    <div class="row nomargbot">
                        <div class="col s12 m6 l4">
                            <p>Entidad: <b>{{ $paciente->entidadesfederativa->entidad }}</b></p>
                        </div>
                        <div class="col s12 m6 l4">
                            <p>Municipio: <b>{{ $paciente->municipio->municipio }}</b></p>
                        </div>
                        <div class="col s12 m6 l4">
                            <p> <b></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
