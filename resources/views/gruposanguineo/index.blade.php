@extends('layouts.app')

@section('template_title')
    Gruposanguineo
@endsection

@section('content')
<h5 class="section-title title">Tipos de sangre</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="">Catálogos</a> >
    <a href="#!">Tipos de sangre</a>
</p>
<hr style="opacity: 0.3">
<div class="scroll-section scroll-table">

    <div class="table-content">

        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Nombre corto</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($gruposanguineos as $gruposanguineo)
                <tr>
                    <td>{{ ++$i }}
                    </td><td>{{ $gruposanguineo->descripcion }}</td>
                    <td>{{ $gruposanguineo->slug }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($gruposanguineos->count() > 0)
        {{ $gruposanguineos->links('vendor.pagination.materializecss') }}
    @endif
</div>
@endsection
