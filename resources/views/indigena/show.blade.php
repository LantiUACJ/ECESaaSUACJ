@extends('layouts.app')

@section('template_title')
    {{ $indigena->name ?? 'Show Indigena' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Indigena</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('indigenas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Valor:</strong>
                            {{ $indigena->valor }}
                        </div>
                        <div class="form-group">
                            <strong>Opcion:</strong>
                            {{ $indigena->opcion }}
                        </div>
                        <div class="form-group">
                            <strong>Createduser Id:</strong>
                            {{ $indigena->createdUser_id }}
                        </div>
                        <div class="form-group">
                            <strong>Updateuser Id:</strong>
                            {{ $indigena->updateUser_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
