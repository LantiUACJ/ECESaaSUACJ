@extends('layouts.app')

@section('template_title')
    Create Sexo
@endsection

@section('content')
    <section class="content container-fluid main">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Registrar Sexo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sexos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('sexo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
