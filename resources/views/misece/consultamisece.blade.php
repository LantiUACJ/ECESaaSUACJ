@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<h5 class="section-title title">Consultar Expedientes Clínicos Electrónicos</h5>
<p class="breadcrumbs">
    <a href="{{ route('home') }}">Inicio</a> >
    MISECE
</p>

<hr class="opactity3">

<div class="scroll-section" id="scrollwindow">
    <form action="">
        <div class="form-group">
            <ul>
                <li>
                    <div class="inner-spacer">
                        <div class="center-div">
                            <div class="toggle-div row" id="codeArea">
                                <div class="input-field col s12">
                                    <input type="text" id="patientcurpbasico" name="patientcurpbasico" value="" class="validate">
                                    <label for="patientcurpbasico">Introduce la curp del paciente</label>
                                </div>
                            </div>
                            <a href="#" onclick="patientconsultbasic()" class="btn solid-btn">Consultar ECE</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="" id="ece-content" style="width: 100%">
                        <iframe id="iframecontentbasic" src="" type="text/html" frameborder="0"></iframe>
                    </div>
                </li>
            </ul>
        </div>
    </form>
    <br><br>
    <hr>
    <form action="{{ route('misecetest') }}" method="post">
        @csrf
        <button type="submit">TEST</button>
        <input type="hidden" name="curp" value="LKLK123654JKJKJK45">
    </form>
</div>

<div id="infomissing" class="modal">
    <div class="modal-content" style="padding: 1rem 2rem;">
        <p style="font-size: 1.5rem" id="infomsg">Mensaje</p>
    </div>
    <div class="modal-footer" style="padding: 1rem 1rem;">
        <a href="#" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
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

<script>
    //consulta basica pagina misece consulta
function patientconsultbasic(){
    let curp = $("input[name=patientcurpbasico]").val();

    if(curp != ""){
        var fd = new FormData();
        fd.append('curp', curp);

        $.ajax({
            url: url + "/expedienteecebasico",
            method: "POST",
            processData: false,
            contentType: false,
            data: fd,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                $('#infomsg').text("Peticion Completada con exito");
                $('#infomissing').modal('open');
                var iframe = document.getElementById('iframecontentbasic');
                iframe.height="900px"
                iframe.width="100%"
                iframe.src = "data:text/html;base64," + response;
            },
            error: function(response){
                if(response.responseJSON.errormsg){
                    $('#infomsg').text(response.responseJSON.errormsg);
                    $('#infomissing').modal('open');
                }else{
                    $('#infomsg').text("A Ocurrio un error! Intentalo mas tarde");
                    $('#infomissing').modal('open');
                }
            },
        });
    }else{
        $('#infomsg').text("La Curp del paciente debe ser introducida.");
        $('#infomissing').modal('open');
    }
}
</script>
@endsection