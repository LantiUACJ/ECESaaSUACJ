@extends('layouts.app')

@section('template_title')
    Create Sexo
@endsection

@section('content')
    <form method="POST" action="{{ route('sexos.store') }}"  role="form" enctype="multipart/form-data">
        @csrf
        <h5 class="section-title title">Registrar sexo</h5>
        <p class="breadcrumbs"> 
            <a href="{{ url('/home') }}">Inicio</a> >
            <a href="">Catálogos</a> >
            <a href="{{ route('pacientes.index') }}">Sexos</a> >
            <a href="#!">Registrar Sexo</a>
        </p>
        <hr style="opacity: 0.3">
        <div class="scroll-section">
            @include('sexo.form')            
        </div>
    </form>
@endsection
