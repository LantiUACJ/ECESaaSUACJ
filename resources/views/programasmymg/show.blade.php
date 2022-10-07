@extends('layouts.app')

@section('template_title')
    {{ $programasmymg->name ?? 'Show Programasmymg' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Programasmymg</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('programasmymgs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Valorprog:</strong>
                            {{ $programasmymg->valorProg }}
                        </div>
                        <div class="form-group">
                            <strong>Opcionprog:</strong>
                            {{ $programasmymg->opcionProg }}
                        </div>
                        <div class="form-group">
                            <strong>Createduser Id:</strong>
                            {{ $programasmymg->createdUser_id }}
                        </div>
                        <div class="form-group">
                            <strong>Updateuser Id:</strong>
                            {{ $programasmymg->updateUser_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
