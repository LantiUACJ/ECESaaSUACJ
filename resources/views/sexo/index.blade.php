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
                                {{ __('Sexos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('sexos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>                                                                             
										<th>Número</th>
										<th>Descripción</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sexos as $sexo)
                                        <tr>
											<td>{{ $sexo->numero }}</td>
											<td>{{ $sexo->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('sexos.destroy',$sexo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('sexos.show',$sexo->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> 
                                                        Consultar
                                                    </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('sexos.edit',$sexo->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> 
                                                        Actualizar
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i> 
                                                        Eliminar
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
                {!! $sexos->links() !!}
            </div>
        </div>
    </div>
@endsection
