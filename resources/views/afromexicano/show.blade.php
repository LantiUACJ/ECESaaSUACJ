@extends('layouts.app')

@section('template_title')
    {{ $afromexicano->name ?? 'Show Afromexicano' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Afromexicano</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('afromexicanos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Valorafro:</strong>
                            {{ $afromexicano->valorAfro }}
                        </div>
                        <div class="form-group">
                            <strong>Opcionafro:</strong>
                            {{ $afromexicano->opcionAfro }}
                        </div>
                        <div class="form-group">
                            <strong>Createduser Id:</strong>
                            {{ $afromexicano->createdUser_id }}
                        </div>
                        <div class="form-group">
                            <strong>Updateuser Id:</strong>
                            {{ $afromexicano->updateUser_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
