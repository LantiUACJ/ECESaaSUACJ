@extends('layouts.app')

@section('template_title')
    Actualizar Paciente
@endsection

@section('content')
    <form method="POST" action="{{ route('pacientes.update', $paciente->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        <h5 class="section-title title">Actualizar datos del paciente</h5>
        <p class="breadcrumbs">
            <a href="{{ url('/home') }}">Inicio</a> >
            <a href="{{ route('pacientes.index') }}">Pacientes</a> >
            <a href="#!">Actualizar paciente</a>
        </p>
        <hr style="opacity: 0.3">
        @include('paciente.form')
    </form>
@endsection
