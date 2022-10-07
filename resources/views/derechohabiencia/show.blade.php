@extends('layouts.app')

@section('template_title')
    {{ $derechohabiencia->name ?? 'Show Derechohabiencia' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Derechohabiencia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('derechohabiencias.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Valordh:</strong>
                            {{ $derechohabiencia->valorDH }}
                        </div>
                        <div class="form-group">
                            <strong>Nombredh:</strong>
                            {{ $derechohabiencia->nombreDH }}
                        </div>
                        <div class="form-group">
                            <strong>Sigladh:</strong>
                            {{ $derechohabiencia->siglaDH }}
                        </div>
                        <div class="form-group">
                            <strong>Createduser Id:</strong>
                            {{ $derechohabiencia->createdUser_id }}
                        </div>
                        <div class="form-group">
                            <strong>Updateuser Id:</strong>
                            {{ $derechohabiencia->updateUser_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
