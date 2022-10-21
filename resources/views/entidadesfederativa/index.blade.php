@extends('layouts.app')

@section('template_title')
    Entidadesfederativa
@endsection

@section('content')
<h5 class="section-title title">Entidades federativas</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="">Catálogos</a> >
    <a href="#!">Entidades federativas</a>
</p>
<hr style="opacity: 0.3">
<div class="scroll-section scroll-table">

    <div class="table-content">

        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Catalog Key</th>
                    <th>Entidad</th>
                    <th>Abreviatura</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($entidadesfederativas as $entidadesfederativa)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $entidadesfederativa->catalogKey }}</td>
                    <td>{{ $entidadesfederativa->entidad }}</td>
                    <td>{{ $entidadesfederativa->abreviatura }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($entidadesfederativas->count() > 0)
        {{ $entidadesfederativas->links('vendor.pagination.materializecss') }}
    @endif
</div>
@endsection
