@extends('layouts.app')

@section('template_title')
    Género
@endsection

@section('content')
    <h5 class="section-title title">Géneros</h5>
    <p class="breadcrumbs">
        <a href="{{ url('/home') }}">Inicio</a> >
        <a href="">Catálogos</a> >
        <a href="#!">Géneros</a>
    </p>
    <hr style="opacity: 0.3">
    <div class="scroll-section scroll-table">

        <div class="table-content">

            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catalog Key</th>
                        <th>Descripción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($generos as $genero)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $genero->numero }}</td>
                        <td>{{ $genero->descripcion }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($generos->count() > 0)
            {{ $generos->links('vendor.pagination.materializecss') }}
        @endif
    </div>
@endsection
