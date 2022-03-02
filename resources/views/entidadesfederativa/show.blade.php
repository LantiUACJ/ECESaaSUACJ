@extends('layouts.app')

@section('template_title')
    {{ $entidadesfederativa->name ?? 'Show Entidadesfederativa' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Entidadesfederativa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('entidadesfederativas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Catalogkey:</strong>
                            {{ $entidadesfederativa->catalogKey }}
                        </div>
                        <div class="form-group">
                            <strong>Entidad:</strong>
                            {{ $entidadesfederativa->entidad }}
                        </div>
                        <div class="form-group">
                            <strong>Abreviatura:</strong>
                            {{ $entidadesfederativa->abreviatura }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
