@extends('layouts.app')

@section('content')
<h5 class="section-title title">Registrar paciente</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="{{ route('consultamedico') }}">Consultas</a> >
    <a href="{{ route('seleccionarpaciente') }}">Seleccionar paciente</a> >
    Registrar paciente
</p>

<hr style="opacity: 0.3">

<form method="POST" action="{{ route('storepacienteconsulta') }}"  role="form" enctype="multipart/form-data">
    @csrf
    @include('paciente.form')
</form>
@endsection
