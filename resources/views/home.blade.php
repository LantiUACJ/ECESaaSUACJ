@extends('layouts.app')
<!-- testapp for consulta test -->

@section('content')
<div class="mainhome container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
                            <a class="btn btn-success" type="button" href="{{ route('tamizajes.index') }}" id="tamizaje">
                                <span class="icon my-auto"><i class="fa fa-file-text-o"></i></span>
                                <span class="title my-auto cutbutton">Tamizaje</span>
                            </a>
                        </div> 
                        <div class="col">
                            <a class="btn btn-secondary" type="button" href="{{ route('egis.index') }}" id="geriatrica">
                                <span class="icon my-auto"><i class="bi bi-journals"></i></span>
                                <span class="title my-auto cutbutton">Evaluación Geriátrica Integral</span>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">                            
                            <a class="btn btn-primary" type="button" href="{{ route('geriatriaproyectos.index') }}" id="geriatriaproyectos">
                                <span class="icon my-auto"><i class="bi bi-folder"></i></span>
                                <span class="title my-auto cutbutton">Proyectos</span>
                            </a>
                        </div>                        
                        <div class="col">
                            <a class="btn btn-success" type="button" href="{{ route('sexos.index') }}" id="sexos">
                                <span class="icon my-auto"><i class="bi bi-gender-female"></i><i class="bi bi-gender-male"></i></span>
                                <span class="title my-auto cutbutton">Sexos</span>
                            </a>
                        </div> 
                        <div class="col">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
