@extends('layouts.tenantadminapp')

@section('content')

<h5 class="section-title title">Médicos</h5>
<p class="breadcrumbs">
    <a href="{{ route('tenantadmin.home') }}">Inicio</a> >
    Médicos
</p>

<hr class="opactity3">

@if ($medicos->count() > 0)
    <div class="menu-dashboard">
        <div class="left">
            <a href="{{ route('tenantadmin.registermedico') }}" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>Registrar Médico</a>
        </div>
        <div class="right-spaced">
            <form method="GET" action="{{ route('tenantadmin.searchmedico') }}">
                <div class="row nomargin center nomargbot">
                    @csrf
                    <div class="input-field col s6 shrink-input" style="min-width: 300px">
                        <input placeholder="Buscar Médico" id="search" type="text" class="validate" name="search">
                        <!-- <label for="search">Buscar consulta</label> -->
                    </div>
                    <div class="col s6">
                        <button type="submit" class="waves-effect waves-light btn" style="font-family: 'Montserrat', sans-serif;"><i class="material-icons left">search</i>Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="legend">
        <div class="legend-cont">
            <div class="legend-color-three"></div>
            <p>Médico Inhabilitado</p>
        </div>
        <div class="legend-cont">
            <div class="legend-color-two"></div>
            <p>Médico Activo</p>
        </div>
    </div>
    <div class="scroll-section scroll-table">
        <div class="table-content">
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                        <th>Fecha de creación</th>
                        <th>Nombre del Médico</th>
                        <th>Cédula</th>
                        <th class="icons-row">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicos as $medico)
                        @if ($medico->active)
                            <tr>
                                <td>{{$medico->user->created_at->format('d/m/Y') }}</td>
                                <td>{{ $medico->user->name." ".$medico->user->primerApellido." ".$medico->user->segundoApellido }}</td>
                                <td>{{ $medico->user->cedula }}</td>
                                <td class="icons-row">
                                    @if (Auth::guard('tenantadmin')->user()->tenant_id == $medico->user->tenantCreator_id)
                                        <!--a href="{{ route('tenantadmin.editmedico', $medico->user->id) }}">
                                            <i class="material-icons tooltipped" data-position="top"
                                            data-tooltip="Editar">edit</i>
                                        </a-->
                                    @endif
                                    <a class="modal-trigger" href="#disablemed{{$medico->user->id}}">
                                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Inhabilitar">block</i>
                                    </a>
                                </td>
                            </tr>
                        @else
                            <tr class="expired">
                                <td>{{$medico->user->created_at->format('d/m/Y') }}</td>
                                <td>{{ $medico->user->name." ".$medico->user->primerApellido." ".$medico->user->segundoApellido }}</td>
                                <td>{{ $medico->user->cedula }}</td>
                                <td class="icons-row">
                                    @if (Auth::guard('tenantadmin')->user()->tenant_id == $medico->user->tenantCreator_id)
                                        <!--a href="{{ route('tenantadmin.editmedico', $medico->user->id) }}">
                                            <i class="material-icons tooltipped" data-position="top"
                                            data-tooltip="Editar">edit</i>
                                        </a-->
                                    @endif
                                    <a class="modal-trigger" href="#enablemed{{$medico->user->id}}">
                                        <i class="material-icons tooltipped" data-position="top" data-tooltip="Habilitar">check</i>
                                    </a>
                                </td>
                            </tr>        
                        @endif
                        <!-- Modal Structure -->
                        <div id="disablemed{{$medico->user->id}}" class="modal" style="padding: 1rem 2rem">
                            <form action="{{ route('tenantadmin.disablemedico', $medico->user->id) }}" method="get">
                                @csrf
                                <div class="modal-content">
                                <p>¿Está seguro de que quiere <b>deshabilitar</b> el médico: <b>{{ $medico->user->name." ".$medico->user->primerApellido." ".$medico->user->segundoApellido }}</b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cancelar</a>
                                    <button type="submit" class="modal-close red waves-effect waves-red btn-flat" style="color: white">Sí, Inhabilitar Médico</button>
                                </div>
                            </form>
                        </div>

                        <div id="enablemed{{$medico->user->id}}" class="modal" style="padding: 1rem 2rem">
                            <form action="{{ route('tenantadmin.enablemedico', $medico->user->id) }}" method="get">
                                @csrf
                                <div class="modal-content">
                                <p>¿Está seguro de que quiere <b>habilitar</b> el médico: <b>{{ $medico->user->name." ".$medico->user->primerApellido." ".$medico->user->segundoApellido }}</b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cancelar</a>
                                    <button type="submit" class="modal-close green waves-effect waves-green btn-flat" style="color: white">Sí, Habilitar Médico</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($medicos->count() > 14)
            {{ $medicos->links('vendor.pagination.materializecss') }}
        @endif
    </div>
@else
    @if ($search)
        <div class="menu-dashboard">
            <div class="left">
                <a href="{{ route('tenantadmin.registermedico') }}" class="waves-effect waves-light btn">
                    <i class="material-icons left">add</i>Registrar médico</a>
            </div>
            <div class="right-spaced">
                <form method="GET" class="row nomargin center nomargbot" action="{{ route('tenantadmin.searchmedico') }}">
                    <div class="input-field col s6 shrink-input" style="min-width: 300px">
                        <input placeholder="Buscar Médico" id="search" type="text" class="validate" name="search">
                    </div>
                    <div class="col s6">
                        <button type="submit" class="waves-effect waves-light btn" style="font-family: 'Montserrat', sans-serif;"><i class="material-icons left">search</i>Buscar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="legend">
            <div class="legend-cont">
                <div class="legend-color-three"></div>
                <p>Médico Inhabilitado</p>
            </div>
            <div class="legend-cont">
                <div class="legend-color-two"></div>
                <p>Médico Activo</p>
            </div>
        </div>
        <div class="scroll-section scroll-table">
            <div class="table-content">
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Fecha de creación</th>
                            <th>Nombre del Médico</th>
                            <th>Cédula</th>
                            <th class="icons-row">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="opacity: 0.6;"><td colspan="4"><h6 class="opacy6">No hay registros de la búsqueda realizada</h6></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h6 style="opacity: 0.6; margin-top: 15px">No hay Médicos registrados</h6>
        
        <div style="margin-top: 15px">
            <a href="{{ route('tenantadmin.registermedico') }}" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>Registrar Médico</a>
        </div>
    @endif
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

@if(Session::has('successMsg'))
    <script> 
        M.toast({html: '<b>{{ Session::get('successMsg') }}</b>' , classes: 'rounded green', displayLength: 5000}); 
    </script>
@endif
@if(Session::has('errorMsg'))
    <script> 
        M.toast({html: '<b>{{ Session::get('errorMsg') }}</b>' , classes: 'rounded red', displayLength: 5000}); 
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.tooltipped');
        var options = {};
        var instances = M.Tooltip.init(elems, options);
    });

    var elems = null;
    document.addEventListener('DOMContentLoaded', function () {
        elems = document.querySelectorAll('.collapsible');
        var options = {};
        var instances = M.Collapsible.init(elems, options);

    });

    $(window).resize(function () {
        if ($(window).width() <= 960) {
            elems.forEach((elmnt, i) => {
            });
        }
    });

</script>

@endsection
