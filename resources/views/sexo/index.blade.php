@extends('layouts.app')

@section('template_title')
    Sexo
@endsection

@section('content')
    <div class="container-fluid main">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <strong>{{ __('Sexos') }}</strong>
                            </span>

                             <div class="float-right">
                                <a href="{{ route('sexos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Registrar sexo') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success text-center">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>                                                                             
										<th>No</th>
										<th>Descripción</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sexos as $sexo)
                                        <tr>
											<td>{{ ++$i }}</td>
											<td>{{ $sexo->descripcion }}</td>
                                            <td>
                                                <a class="btn" href="{{ route('sexos.edit',$sexo->id) }}"data-toggle="tooltip" data-placement="right" title="Actualizar">
                                                    <span class="icon my-auto"><i class="fa fa-fw fa-pencil"></i> </span>
                                                </a>

                                                <a data-toggle="modal" class="btn" data-target="#deleteModal_{{$sexo->id}}" data-bs-toggle="tooltip" 
                                                    data-action="{{ route('sexos.destroy', $sexo->id) }}"  title="Eliminar"><i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Delete Docente Modal -->
                                        <div class="modal fade" id="deleteModal_{{$sexo->id}}" data-backdrop="static" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title text-danger" id="deleteModalLabel"><strong>Esta acción es irreversible.</strong></h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('sexos.destroy',$sexo->id) }}" method="POST">
                                                        <div class="modal-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h6 class="text-center">¿Está seguro de que quieres eliminar el sexo {{ $sexo->descripcion }} ?</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Si, eliminar sexo</button>
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
                {!! $sexos->links() !!}
            </div>
        </div>
    </div>
@endsection
