@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script src="{{ asset('js/consulta.js')."?v=2.2" }}" defer></script> <!-- Script para manejar las operaciones crud de consulta -->

<h5 class="section-title title">Consultar Expedientes Clínicos Electrónicos</h5>
<p class="breadcrumbs">
    <a href="{{ route('home') }}">Inicio</a> >
    MISECE
</p>

<hr style="opacity: 0.3">

<div class="scroll-section" id="scrollwindow">
    <form action="">
        <div class="form-group">
            <div class="nomargbot">
                <div class="col s12">
                    <label for="patientcurpbasico">Introduce la curp del paciente:</label><br>
                    <input class="" type="text" id="patientcurpbasico" name="patientcurpbasico" value="" style="width: 20%">
                </div>
                <br>
                <a class="btn btn-sm btn-success" type="button" onclick="patientconsultbasic()">Consultar ECE</a>
                <br><br>
                <div id="ece-content">
                    <iframe id="iframecontentbasico" src="" type="text/html" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="infomissing" class="modal">
    <div class="modal-content" style="padding: 1rem 2rem;">
        <p style="font-size: 1.5rem" id="infomsg">Mensaje</p>
    </div>
    <div class="modal-footer" style="padding: 1rem 1rem;">
        <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems, {
            dismissible: false
        });
    });
</script>
@endsection