@extends('layouts.app')

@section('template_title')
    {{ $sexo->name ?? 'Show Sexo' }}
@endsection

@section('content')
    <section class="content container-fluid main">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Sexo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sexos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Número:</strong>
                            {{ $sexo->numero }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $sexo->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
