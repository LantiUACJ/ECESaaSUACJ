@extends('layouts.app')

@section('template_title')
    Derechohabiencia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Derechohabiencia') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('derechohabiencias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        <th>No</th>
                                        
										<th>Valordh</th>
										<th>Nombredh</th>
										<th>Sigladh</th>
										<th>Createduser Id</th>
										<th>Updateuser Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($derechohabiencias as $derechohabiencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $derechohabiencia->valorDH }}</td>
											<td>{{ $derechohabiencia->nombreDH }}</td>
											<td>{{ $derechohabiencia->siglaDH }}</td>
											<td>{{ $derechohabiencia->createdUser_id }}</td>
											<td>{{ $derechohabiencia->updateUser_id }}</td>

                                            <td>
                                                <form action="{{ route('derechohabiencias.destroy',$derechohabiencia->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('derechohabiencias.show',$derechohabiencia->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('derechohabiencias.edit',$derechohabiencia->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $derechohabiencias->links() !!}
            </div>
        </div>
    </div>
@endsection
