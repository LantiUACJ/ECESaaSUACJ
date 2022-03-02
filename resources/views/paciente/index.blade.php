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
                            <p>{{ $message }}</p>
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
                                                <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                                                    <a class="btn" href="{{ route('pacientes.show',$paciente->id) }}" data-toggle="tooltip" data-placement="right" title="Consultar">
                                                        <span class="icon my-auto"><i class="fa fa-fw fa-eye"></i></span> 
                                                    </a>
                                                    <a class="btn" href="{{ route('pacientes.edit',$paciente->id) }}" data-toggle="tooltip" data-placement="right" title="Actualizar">
                                                        <span class="icon my-auto"><i class="fa fa-fw fa-pencil"></i> </span>
                                                    </a>                                                    
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn" data-toggle="tooltip" data-placement="right" title="Eliminar">
                                                        <span class="icon my-auto"><i class="fa fa-fw fa-trash"></i> </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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
