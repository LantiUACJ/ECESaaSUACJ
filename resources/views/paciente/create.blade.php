@extends('layouts.app')

@section('template_title')
    Registro de paciente
@endsection

@section('content')
    <form method="POST" action="{{ route('pacientes.store') }}"  role="form" enctype="multipart/form-data">
        @csrf
        <h5 class="section-title title">Registrar paciente</h5>
        <p class="breadcrumbs">
            <a href="{{ url('/home') }}">Inicio</a> >
            <a href="{{ route('pacientes.index') }}">Pacientes</a> >
            <a href="{{ route('pacientes.create') }}">Registrar paciente</a>
        </p>
        <hr style="opacity: 0.3">
        @include('paciente.form')

    </form>
@endsection
