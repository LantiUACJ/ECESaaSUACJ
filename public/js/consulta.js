const { each, forEach } = require("lodash");

var url = $('meta[name="base_url"]').attr('content');

var urlasset = $('meta[name="asset_url"]').attr('content');

window.addEventListener("load", init(), false);

//Funcion que se ejecuta al inicio
function init(){
    //Crear funcion para mostrar las imagenes de los archivos guardados de la consulta
    //fillFilesConsulta();
}

$('#price').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

$('#price2').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

function fillFilesConsulta(){
    var jsonfiles = $('#jsonfiles').val();
    if(jsonfiles != ""){
        console.log(urlasset);
        var arrayfiles = JSON.parse(jsonfiles);
        var contenedor = $("#filescontainer");
        contenedor.removeClass('hiddenli');
        contenedor.empty();
        
        arrayfiles.forEach(element => {
            switch (element[1]) {
                case 'png':
                    var content = 
                        '<img class="resultfile" src="'+urlasset+'/png.png")" title="'+element[0]+'" alt="'+element[0]+'">';
                    contenedor.append(content);
                    break;
                case 'jpg':
                    var content = 
                        '<img class="resultfile" src="'+urlasset+'/jpg.png")" title="'+element[0]+'" alt="'+element[0]+'">';
                    contenedor.append(content);
                    break;
                case 'docx':
                    var content = 
                        '<img class="resultfile" src="'+urlasset+'/docx.png")" title="'+element[0]+'" alt="'+element[0]+'">';
                    contenedor.append(content);
                    break;
                case 'doc':
                    var content = 
                        '<img class="resultfile" src="'+urlasset+'/doc.png")" title="'+element[0]+'" alt="'+element[0]+'">';
                    contenedor.append(content);
                    break;
                case 'pdf':
                    var content = 
                        '<img class="resultfile" src="'+urlasset+'/pdf.png")" title="'+element[0]+'" alt="'+element[0]+'">';
                    contenedor.append(content);
                    break;
                default:
                    break;
            }
        });
        
    }else{
        console.log("No files, nothing to do!");
    }

    /*
    let something = "something";

    $.ajax({
        url: url + "/gerente/recordCheck/",
        type: "POST",
        data: {
            something: something
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            window.scrollTo(0, 0);
            //Existen records
            console.log(data);
            $("#sheetrecordcontainer").empty();
            let counter = $('#recordscount');
            let last = data.pop();
            data.forEach(element => {
                addrecord(element);   
                addrecordsecond(element);             
            });
            counter.val(last.id + 1);
            console.log("There are Records");
        },
        error: function(response){
            window.scrollTo(0, 0);
            //No Existen records
            console.log(response.responseJSON.errormsg);
            console.log("No Records");
        },
    });
    */
}

function subformbutton(){ //store consulta
    let pacId = $("input[name=pac_id]").val();
    let motivo = $("textarea[name=motivo]").val();
    let cuadro = $("textarea[name=cuadro]").val();
    let resultados = $("textarea[name=resultados]").val();
    let diagnostico = $("textarea[name=diagnostico]").val();
    let pronostico = $("textarea[name=pronostico]").val();
    let indicacion = $("textarea[name=indicacion]").val();
    let select = $("input[name=select-diag]").val();
    let filename = $('#filename').get(0).files;

    console.log(select);

    var fd = new FormData();
    fd.append('motivo', motivo);
    fd.append('cuadro', cuadro);
    fd.append('resultados', resultados);
    fd.append('diagnostico', diagnostico);
    fd.append('pronostico', pronostico);
    fd.append('indicacion', indicacion);
    fd.append('select', select);

    for (let i = 0; i < filename.length; i++) {
        fd.append('filename[]', filename[i]);
    }

    $.ajax({
        url: url + "/storeconsulta/" + pacId,
        type: "POST",
        processData: false,
        contentType: false,
        data: fd,
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
            console.log(response);
            if(response.responseJSON.errormsg == null){
                console.log(response);
                if(response.responseJSON.errors != null){
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
    let realselect = $('.item').attr("data-value");
    let isnum = /^\d+$/.test(realselect);
    console.log(isnum);

    if(isnum){
        var select = realselect;
    }else{
        var select = $("input[name=real-select-diag]").val();
    }

    console.log(select);
    
    let pacId = $("input[name=pac_id]").val();
    let motivo = $("textarea[name=motivo]").val();
    let cuadro = $("textarea[name=cuadro]").val();
    let resultados = $("textarea[name=resultados]").val();
    let diagnostico = $("textarea[name=diagnostico]").val();
    let pronostico = $("textarea[name=pronostico]").val();
    let indicacion = $("textarea[name=indicacion]").val();
    //let select = $("input[name=select-diag]").val();
    let filename = $('#filename').get(0).files;

    console.log(select);

    var fd = new FormData();
    fd.append('motivo', motivo);
    fd.append('cuadro', cuadro);
    fd.append('resultados', resultados);
    fd.append('diagnostico', diagnostico);
    fd.append('pronostico', pronostico);
    fd.append('indicacion', indicacion);
    fd.append('select', select);

    for (let i = 0; i < filename.length; i++) {
        fd.append('filename[]', filename[i]);
    }

    $.ajax({
        url: url + "/updateconsulta/" + pacId,
        type: "POST",
        processData: false,
        contentType: false,
        data: fd,
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


function testconsulta(){
    var items = document.getElementsByClassName("item");
    let array = [];
    let count = 0;
    if(items.length > 0){
        [].forEach.call(items, function(element) {
            console.log("item: " + element.getAttribute("data-value"));
            array[count] = element.getAttribute("data-value");
            count++;
        });
    }else{
        console.log("Arreglo Vacio");
    }
    console.log("Array: "+array.length);
    
    //var select =  $( "#multiselecttoxic option:selected" ).text();
    //console.log("Select: "+select);
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

//registro y continuar consulta funcion
function patientece(curp){
    //requestcodeget

    /*
    var iframe = "<iframe src=\"_url_\" type=\"text/html\" frameborder=\"0\" height=\"900px\" width=\"100%\"></iframe>";
    var thisurl = url + "/requestcodeget/" + curp;
    var c_iframe = iframe.replace("_url_", thisurl);
    $("#ece-content").html(c_iframe);
    */
    var code = document.getElementById('patientcode').value;
    var fd = new FormData();
    fd.append('curp', curp);
    fd.append('code', code);

    $.ajax({
        url: url + "/expedienteece/",
        type: "POST",
        processData: false,
        contentType: false,
        data: fd,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            alert("Peticion completado con exito!");
            var iframe = document.getElementById('iframecontent');
            iframe.height="900px"
            iframe.width="100%"
            iframe.src = "data:text/html;base64," + response;
        },
        error: function(response){
            if(response.responseJSON.errormsg)
                alert("Código Invalido");
            else
                alert("Ocurrio un error! Intentalo mas tarde.");
            console.log(response);
        },
    });
}

//consulta completa pagina misece consulta
function patientconsult(){
    let code = $("input[name=patientcode]").val();
    let curp = $("input[name=patientcurp]").val();

    if(curp != ""){
        var fd = new FormData();
        fd.append('curp', curp);
        fd.append('code', code);

        $.ajax({
            url: url + "/expedienteece",
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                alert("Peticion completado con exito!");
                var iframe = document.getElementById('iframecontent');
                iframe.height="900px"
                iframe.width="100%"
                iframe.src = "data:text/html;base64," + response;
                console.log(response);
            },
            error: function(response){
                if(response.responseJSON.errormsg)
                    alert("Se ha enviado un Código al paciente! Espera unos minutos.");
                else
                    alert("Ocurrio un error! Intentalo mas tarde.");
                console.log(response);
            },
        });
    }else{
        alert("La curp y número teléfonico del paciente debe ser introducidos!");
    }
}

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
                alert("Peticion completado con exito!");
                var iframe = document.getElementById('iframecontentbasico');
                iframe.height="900px"
                iframe.width="100%"
                iframe.src = "data:text/html;base64," + response;
                console.log(response);
            },
            error: function(response){
                alert("Ocurrio un error! Intentalo mas tarde.");
                console.log(response);
            },
        });
    }else{
        alert("La curp del paciente debe ser introducida!");
    }
}