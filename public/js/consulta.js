$('#price').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

$('#price2').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

var url = $('meta[name="base_url"]').attr('content');
 
function subformbutton(){ //store consulta
    let pacId = $("input[name=pac_id]").val();
    let motivo = $("textarea[name=motivo]").val();
    let cuadro = $("textarea[name=cuadro]").val();
    let resultados = $("textarea[name=resultados]").val();
    let diagnostico = $("textarea[name=diagnostico]").val();
    let pronostico = $("textarea[name=pronostico]").val();
    let indicacion = $("textarea[name=indicacion]").val();

    $.ajax({
        url: url + "/storeconsulta/" + pacId,
        type: "POST",
        data: {
            motivo: motivo,
            cuadro: cuadro,
            resultados: resultados,
            diagnostico: diagnostico,
            pronostico: pronostico,
            indicacion: indicacion
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#consultamsg').text(response.msg);
                $("#consultamodal").modal('show');

                $('#interrogatorio-tab').removeClass("disabled");
                $('#exploracion-tab').removeClass("disabled");
            }
            clearErrorsConsulta();
            $('#consultasubmit').css("display", "none");
            $('#consultaupdate').css("display", "block"); 
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                    errorValidationConsulta(response);
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function updateformbutton(){ //update consulta
    let pacId = $("input[name=pac_id]").val();
    let motivo = $("textarea[name=motivo]").val();
    let cuadro = $("textarea[name=cuadro]").val();
    let resultados = $("textarea[name=resultados]").val();
    let diagnostico = $("textarea[name=diagnostico]").val();
    let pronostico = $("textarea[name=pronostico]").val();
    let indicacion = $("textarea[name=indicacion]").val();

    $.ajax({
        url: url + "/updateconsulta/" + pacId,
        type: "POST",
        data: {
            motivo: motivo,
            cuadro: cuadro,
            resultados: resultados,
            diagnostico: diagnostico,
            pronostico: pronostico,
            indicacion: indicacion
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response){
                $('#updateconsultamsg').text(response.msg);
                $("#updateconsultamodal").modal('show');
            }
            clearErrorsConsulta(); //limpia los mensaje de error en caso de que los haya
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                    errorValidationConsulta(response); //Muestra los mensajes de error correspondiente por campo
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function testbutton(){
    //$('#consultamsg').text('Guardada exitosamente!');
    //$("#consultamodal").modal('show');

    $('#errormsg').text('Error al guardar los datos!');
    $("#errormodal").modal('show');


    $('#consultasubmit').css("display", "none");
    $('#consultaupdate').css("display", "block"); 

    $('#interrogatorio-tab').removeClass("disabled");
    $('#exploracion-tab').removeClass("disabled");
}

function errorValidationConsulta(response){
    if(response.responseJSON.errors.motivo){
        $('#error-motivo').css("display", 'block');
        $('#motivo').addClass('is-invalid');
    }
    if(response.responseJSON.errors.cuadro){
        $('#error-cuadro').css("display", 'block');
        $('#cuadro').addClass('is-invalid');
    }
    if(response.responseJSON.errors.resultados){
        $('#error-resultados').css("display", 'block');
        $('#resultados').addClass('is-invalid');
    }
    if(response.responseJSON.errors.diagnostico){
        $('#error-diagnostico').css("display", 'block');
        $('#diagnostico').addClass('is-invalid');
    }
    if(response.responseJSON.errors.pronostico){
        $('#error-pronostico').css("display", 'block');
        $('#pronostico').addClass('is-invalid');
    }
    if(response.responseJSON.errors.indicacion){
        $('#error-indicacion').css("display", 'block');
        $('#indicacion').addClass('is-invalid');
    }
}

function clearErrorsConsulta(){
    if($('#motivo').hasClass('is-invalid')){
        $('#error-motivo').css("display", 'none');
        $('#motivo').removeClass('is-invalid');
    }
    if($('#cuadro').hasClass('is-invalid')){
        $('#error-cuadro').css("display", 'none');
        $('#cuadro').removeClass('is-invalid');
    }
    if($('#resultados').hasClass('is-invalid')){
        $('#error-resultados').css("display", 'none');
        $('#resultados').removeClass('is-invalid');
    }
    if($('#diagnostico').hasClass('is-invalid')){
        $('#error-diagnostico').css("display", 'none');
        $('#diagnostico').removeClass('is-invalid');
    }
    if($('#pronostico').hasClass('is-invalid')){
        $('#error-pronostico').css("display", 'none');
        $('#pronostico').removeClass('is-invalid');
    }
    if($('#indicacion').hasClass('is-invalid')){
        $('#error-indicacion').css("display", 'none');
        $('#indicacion').removeClass('is-invalid');
    }
}

function terminarConsulta(){
    $.get( "/getconsulta/", function( data ) {
        if(data == 1){
            $("#terminarmodal").modal('show');
        }else{
            $("#noIntermodal").modal('show');
        }
    }).fail(function(){
        $("#noConsultamodal").modal('show');
    });
}

function interdisabled(){
    let inter = $('#interavailable').val();
    if(inter == 0){
        $("#nointermodal").modal('show');
    }
}

function explodisabled(){
    let explo = $('#exploavailable').val();
    if(explo == 0){
        $("#noexplomodal").modal('show');
    }
}

function modaltest(){
    $('#noConsultamodal').modal('show');
}