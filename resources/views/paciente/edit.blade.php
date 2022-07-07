@extends('layouts.app')

@section('template_title')
    Update Paciente
@endsection

@section('content')
    <section class="mainhome content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"><strong>Actualizar datos del paciente</strong></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pacientes.index') }}"> Regresar</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pacientes.update', $paciente->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('paciente.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
