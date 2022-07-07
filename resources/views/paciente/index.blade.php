@extends('layouts.app')

@section('template_title')
    Paciente
@endsection

@section('content')
    <div class="mainhome container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <strong>{{ __('Pacientes') }}</strong>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar paciente') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>CURP</th>
										<th>Nombre</th>
										<th>Primer apellido</th>
										<th>Segundo apellido</th>
										<th>Fecha de nacimiento</th>
										<th>Entidad de nacimiento</th>
                                        <th>Sexo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pacientes as $paciente)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td label="Curp">{{ $paciente->curp }}</td>
											<td label="Nombre">{{ $paciente->nombre }}</td>
											<td label="Primer Apellido">{{ $paciente->primerApellido }}</td>
											<td label="Segundo Apellido">{{ $paciente->segundoApellido }}</td> 
											<td label="Fecha Nac.">{{ \Carbon\Carbon::parse($paciente->fechaNacimiento)->format('d/m/Y') }}</td>
											<td label="E.F.">{{ $paciente->entidadesfederativanac->entidad }}</td>                                            
											<td label="Sexo">{{ $paciente->sexo->descripcion }}</td>
                                            <td>
                                                <a class="btn" href="{{ route('pacientes.show',$paciente->id) }}" data-toggle="tooltip" data-placement="right" title="Consultar">
                                                    <span class="icon my-auto"><i class="fa fa-fw fa-eye"></i></span> 
                                                </a>
                                                <a class="btn" href="{{ route('pacientes.edit',$paciente->id) }}" data-toggle="tooltip" data-placement="right" title="Actualizar">
                                                    <span class="icon my-auto"><i class="fa fa-fw fa-pencil"></i> </span>
                                                </a>   
                                                <a data-toggle="modal" class="btn" data-target="#deleteModal_{{$paciente->id}}" data-bs-toggle="tooltip" 
                                                    data-action="{{ route('pacientes.destroy', $paciente->id) }}"  title="Eliminar"><i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Delete Docente Modal -->
                                        <div class="modal fade" id="deleteModal_{{$paciente->id}}" data-backdrop="static" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title text-danger" id="deleteModalLabel"><strong>Esta acción es irreversible.</strong></h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                                                        <div class="modal-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h6 class="text-center">¿Está seguro de que quiere eliminar la información del paciente: {{ $paciente->nombre }} {{ $paciente->primerApellido }} {{ $paciente->segundoApellido }} ?</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Si, eliminar información</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pacientes->links() !!}
            </div>
        </div>
    </div>
@endsection
