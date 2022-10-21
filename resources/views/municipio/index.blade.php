@extends('layouts.app')

@section('template_title')
    Municipio
@endsection

@section('content')
<h5 class="section-title title">Municipios</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="">Catálogos</a> >
    <a href="#!">Municipios</a>
</p>
<hr style="opacity: 0.3">
<div class="scroll-section scroll-table">

    <div class="table-content">

        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Catalog key</th>
                    <th>Entidad federativa</th>	
                    <th>Municipio</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($municipios as $municipio)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $municipio->catalogKey }}</td>
                    <td>{{ $municipio->entidadesfederativa->entidad }}</td>
                    <td>{{ $municipio->municipio }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($municipios->count() > 0)
        {{ $municipios->links('vendor.pagination.materializecss') }}
    @endif
</div>
@endsection
