@extends('layouts.app')
<!-- testapp for consulta test -->

@section('content')
<div class="mainhome container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    {{ __('Bienvenido al Expediente Clínico Electrónico') }}
                </div>

                <div class="card-body text-center">
                    <div class="row">
                        <div class="col">                            
                            <a class="btn btn-primary" type="button" href="{{ route('pacientes.index') }}" id="pacientes">
                                <span class="icon my-auto"><i class="bi bi-people"></i></span>
                                <span class="title my-auto cutbutton">Pacientes</span>
                            </a>
                        </div>                        
                        <div class="col">
                            <a class="btn btn-success" type="button" href="{{ route('consultamedico') }}" id="consultamedico">
                                <span class="icon my-auto"><i class="fa fa-file-text-o"></i></span>
                                <span class="title my-auto cutbutton">Consultas del Medico</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
