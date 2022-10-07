@extends('layouts.app')

@section('template_title')
    {{ $gruposanguineo->name ?? 'Show Gruposanguineo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Gruposanguineo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('gruposanguineos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $gruposanguineo->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $gruposanguineo->slug }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
