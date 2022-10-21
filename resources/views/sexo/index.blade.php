@extends('layouts.app')

@section('template_title')
    Sexo
@endsection

@section('content')
<h5 class="section-title title">Sexos</h5>
<p class="breadcrumbs">
    <a href="{{ url('/home') }}">Inicio</a> >
    <a href="">Catálogos</a> >
    <a href="#!">Sexos</a>
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
                @foreach ($sexos as $sexo)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $sexo->numero }}</td>
					<td>{{ $sexo->descripcion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($sexos->count() > 0)
        {{ $sexos->links('vendor.pagination.materializecss') }}
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@if ($message = Session::get('success'))
    <script> 
        M.toast({html: '{{$message}}' , classes: 'rounded green', displayLength: 5000}); 
    </script>
@endif
@if ($message = Session::get('error'))
    <script> 
        M.toast({html: '{{$message}}' , classes: 'rounded red', displayLength: 5000}); 
    </script>
@endif

@endsection