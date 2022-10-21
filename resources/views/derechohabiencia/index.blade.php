@extends('layouts.app')

@section('template_title')
    Derechohabiencia
@endsection

@section('content')
<h5 class="section-title title">Derechohabiencias</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="">Catálogos</a> >
    <a href="#!">Derechohabiencias</a>
</p>
<hr style="opacity: 0.3">
<div class="scroll-section scroll-table">

    <div class="table-content">

        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    <th>Nombre de la institución</th>
					<th>Sigla</th>	
                </tr>
            </thead>

            <tbody>
                @foreach ($derechohabiencias as $derechohabiencia)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $derechohabiencia->valorDH }}</td>
					<td>{{ $derechohabiencia->nombreDH }}</td>
					<td>{{ $derechohabiencia->siglaDH }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($derechohabiencias->count() > 0)
        {{ $derechohabiencias->links('vendor.pagination.materializecss') }}
    @endif
</div>
@endsection
