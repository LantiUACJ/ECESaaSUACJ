@extends('layouts.app')

@section('template_title')
    {{ $pacientedh->name ?? 'Show Pacientedh' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Pacientedh</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pacientedhs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Pacientes Id:</strong>
                            {{ $pacientedh->pacientes_id }}
                        </div>
                        <div class="form-group">
                            <strong>Derechohabiencias Id:</strong>
                            {{ $pacientedh->derechoHabiencias_id }}
                        </div>
                        <div class="form-group">
                            <strong>Createduser Id:</strong>
                            {{ $pacientedh->createdUser_id }}
                        </div>
                        <div class="form-group">
                            <strong>Updateuser Id:</strong>
                            {{ $pacientedh->updateUser_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
