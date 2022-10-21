var url = $('meta[name="base_url"]').attr('content');

var urlasset = $('meta[name="asset_url"]').attr('content');

window.addEventListener("load", init(), false);

//Funcion que se ejecuta al inicio
function init(){
    //Crear funcion para mostrar las imagenes de los archivos guardados de la consulta
    //fillFilesConsulta();

    if(document.getElementById('ispregnant').checked){
        $('#pregContainer').removeClass('hide');
    }
}

$('#price').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

$('#price2').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

$('input[data-id=price2]').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

$('#files').on('click', function(){
    $('#filename').trigger('click');   
});

$('#filename').on('change', function(){
    if($('#jsonfiles').val() == ""){
        $('#filescontainer').empty();
    }

    let files = $('#filename').get(0).files;

    for (let i = 0; i < files.length; i++) {
        var filename = files[i].name;
        var extension = filename.replace(/^.*\./, '');
        var link = "";
        switch(extension){
            case 'png':
                /*var link = '<a href="" download>'+
                    '<img style="margin: 5px" class="resultfile imglink" src="'+URL.createObjectURL(files[i])+'"'+
                    'data-toggle="tooltip" data-placement="top" title="'+filename+'">'+
                '</a>';*/
                var link = 
                    '<a href="#" class="img-grid-c">'+
                        '<img src="'+URL.createObjectURL(files[i])+'">'+
                    '</a>';
                break;
            case 'jpg':
                /*var link = '<a href="" download>'+
                    '<img style="margin: 5px" class="resultfile imglink" src="'+URL.createObjectURL(files[i])+'"'+
                    'data-toggle="tooltip" data-placement="top" title="'+filename+'">'+
                '</a>';*/
                var link = 
                    '<a href="#" class="img-grid-c">'+
                        '<img src="'+URL.createObjectURL(files[i])+'">'+
                    '</a>';
                break;
            case 'docx':
                /*var link = '<a href="" download>'+
                    '<img style="margin: 5px" class="resultfile imglink" src="'+url + '/img/icons/docx.png'+'"'+
                    'data-toggle="tooltip" data-placement="top" title="'+filename+'">'+
                '</a>';*/
                var link = 
                    '<a href="#" class="img-grid-c">'+
                        '<img src="'+url+ '/img/icons/docx.png'+'">'+
                    '</a>';
                break;
            case 'doc':
                /*var link = '<a href="" download>'+
                    '<img style="margin: 5px" class="resultfile imglink" src="'+url + '/img/icons/doc.png'+'"'+
                    'data-toggle="tooltip" data-placement="top" title="'+filename+'">'+
                '</a>';*/
                var link =
                    '<a href="#" class="img-grid-c">'+
                        '<img src="'+url + '/img/icons/doc.png'+'">'+
                    '</a>';
                break;
            case 'pdf':
                /*var link = '<a href="" download>'+
                    '<img style="margin: 5px" class="resultfile imglink" src="'+url + '/img/icons/pdf.png'+'"'+
                    'data-toggle="tooltip" data-placement="top" title="'+filename+'">'+
                '</a>';*/
                var link =
                    '<a href="#" class="img-grid-c">'+
                        '<img src="'+url + '/img/icons/pdf.png'+'">'+
                    '</a>';
                break;
        }
        $('#filescontainer').append(link);
    }
});

function fillFilesConsulta(){
    var jsonfiles = $('#jsonfiles').val();
    if(jsonfiles != ""){
        console.log(urlasset);
        var arrayfiles = JSON.parse(jsonfiles);
        var contenedor = $("#filescontainer");
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
    var motivo = $("textarea[name=motivo]").val();
    let cuadro = $("textarea[name=cuadro]").val();
    let resultados = $("textarea[name=resultados]").val();
    let diagnostico = $("textarea[name=diagnostico]").val();
    let pronostico = $("textarea[name=pronostico]").val();
    let indicacion = $("textarea[name=indicacion]").val();
    let select = $("input[name=select-diag]").val();
    let filename = $('#filename').get(0).files;
    
    var fd = new FormData();
    fd.append('cuadro', cuadro);
    fd.append('resultados', resultados);
    fd.append('diagnostico', diagnostico);
    fd.append('pronostico', pronostico);
    fd.append('indicacion', indicacion);
    fd.append('select', select);

    for (let i = 0; i < filename.length; i++) {
        fd.append('filename[]', filename[i]);
    }
    
    if(document.getElementById('ispregnant').checked){
        clearRadios();
        if(checkRadios()){ //Funcion que revisa que los radios hayan sido seleccionados 
            if(motivo == ""){
                motivo = "Consulta por Embarazo.";
                $("textarea[name=motivo]").val(motivo)
            }

            var embarazo = $("input[name=consultaembarazo]:checked").val();
            var trimestre = $("input[name=trimestreembarazo]:checked").val();
            var altoriesgo = $("input[name=riesgoembarazo]:checked").val();
            var diabetes = $("input[name=diabetesembarazo]:checked").val();
            var infeccion = $("input[name=infeccionembarazo]:checked").val();
            var preeclampsia = $("input[name=preclampsiaembarazo]:checked").val();
            var hemorragia = $("input[name=hemorragiaembarazo]:checked").val();
            var sospechacovid = $("input[name=sospechacovidembarazo]:checked").val();
            var confirmacovid = $("input[name=confirmacioncovidembarazo]:checked").val();
    
            fd.append('motivo', motivo);
            fd.append('embarazo', embarazo);
            fd.append('trimestre', trimestre);
            fd.append('altoriesgo', altoriesgo);
            fd.append('diabetes', diabetes);
            fd.append('infeccion', infeccion);
            fd.append('preeclampsia', preeclampsia);
            fd.append('hemorragia', hemorragia);
            fd.append('sospechacovid', sospechacovid);
            fd.append('confirmacovid', confirmacovid);

            $.ajax({
                url: url + "/storepregnantconsulta/" + pacId,
                type: "POST",
                processData: false,
                contentType: false,
                data: fd,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    document.getElementById('scrollwindow').scrollTo(0, 0);
                    if(response){
                        $('#modalmsg').text(response.msg);
                        $('#consultamodal').modal('open');
        
                        $('#interrogatorio-tab').removeClass("disabled");
                        $('#exploracion-tab').removeClass("disabled");
                    }
                    clearErrorsConsulta();
                    $('#consultasubmit').addClass('hide');
                    $('#consultaupdate').removeClass('hide');
                },
                error: function(response){
                    document.getElementById('scrollwindow').scrollTo(0, 0);
                    if(response.responseJSON.errormsg == null){
                        if(response.responseJSON.errors != null){
                            //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                            errorValidationConsulta(response);
                        }
                    }else{
                        $('#errormsg').text(response.msg);
                        $('#errormodal').modal('open');
                    }
                    
                },
            });
        }else{
            $('#infomsg').text("Hay campos faltantes en la sección de consulta por embarazo.");
            $('#infomissing').modal('open');
        }
    }else{
        fd.append('motivo', motivo);
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
                document.getElementById('scrollwindow').scrollTo(0, 0);
                if(response){
                    $('#modalmsg').text(response.msg);
                    $('#consultamodal').modal('open');
    
                    $('#interrogatorio-tab').removeClass("disabled");
                    $('#exploracion-tab').removeClass("disabled");
                }
                clearErrorsConsulta();
                $('#consultasubmit').addClass('hide');
                $('#consultaupdate').removeClass('hide');
            },
            error: function(response){
                if(response.responseJSON.errormsg == null){
                    if(response.responseJSON.errors != null){
                        //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                        errorValidationConsulta(response);
                        
                        document.getElementById('scrollwindow').scrollTo(0, 0);
                        $('#errormsg').text("Faltan Datos por Capturar!");
                        $('#errormodal').modal('open');
                    }
                }else{
                    $('#errormsg').text(response.msg);
                    $('#errormodal').modal('open');
                }
            },
        });
    }
}

function Testspiningmodal(){
    $('#spinningmodal').modal('show');
}

function updateformbutton(){ //update consulta
    
    /*let realselect = $('.item').attr("data-value");
    let isnum = /^\d+$/.test(realselect);
    console.log(isnum);

    if(isnum){
        var select = realselect;
    }else{
        var select = $("input[name=real-select-diag]").val();
    }*/

    var select = $("input[name=select-diag]").val();

    let pacId = $("input[name=pac_id]").val();
    let motivo = $("textarea[name=motivo]").val();
    let cuadro = $("textarea[name=cuadro]").val();
    let resultados = $("textarea[name=resultados]").val();
    let diagnostico = $("textarea[name=diagnostico]").val();
    let pronostico = $("textarea[name=pronostico]").val();
    let indicacion = $("textarea[name=indicacion]").val();
    //let select = $("input[name=select-diag]").val();
    let filename = $('#filename').get(0).files;

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

    if(document.getElementById('ispregnant').checked){
        clearRadios();

        if(checkRadios()){ //Funcion que revisa que los radios hayan sido seleccionados

            var embarazo = $("input[name=consultaembarazo]:checked").val();
            var trimestre = $("input[name=trimestreembarazo]:checked").val();
            var altoriesgo = $("input[name=riesgoembarazo]:checked").val();
            var diabetes = $("input[name=diabetesembarazo]:checked").val();
            var infeccion = $("input[name=infeccionembarazo]:checked").val();
            var preeclampsia = $("input[name=preclampsiaembarazo]:checked").val();
            var hemorragia = $("input[name=hemorragiaembarazo]:checked").val();
            var sospechacovid = $("input[name=sospechacovidembarazo]:checked").val();
            var confirmacovid = $("input[name=confirmacioncovidembarazo]:checked").val();
    
            fd.append('embarazo', embarazo);
            fd.append('trimestre', trimestre);
            fd.append('altoriesgo', altoriesgo);
            fd.append('diabetes', diabetes);
            fd.append('infeccion', infeccion);
            fd.append('preeclampsia', preeclampsia);
            fd.append('hemorragia', hemorragia);
            fd.append('sospechacovid', sospechacovid);
            fd.append('confirmacovid', confirmacovid);

            $.ajax({
                url: url + "/updatepregnantconsulta/" + pacId,
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
                        $('#updateconsultamodal').modal('open');
                    }
                    clearErrorsConsulta();
                    document.getElementById('scrollwindow').scrollTo(0, 0);
                },
                error: function(response){
                    if(response.responseJSON.errormsg == null){
                        if(response.responseJSON.errors != null){
                            //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                            errorValidationConsulta(response);
                        }
                    }else{
                        $('#errormsg').text(response.msg);
                        $('#errormodal').modal('open');
                    }
                    document.getElementById('scrollwindow').scrollTo(0, 0);                    
                },
            });
        }else{
            $('#infomsg').text("Hay campos faltantes en la sección de consulta por embarazo.");
            $('#infomissing').modal('open');
        }
    }else{
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
                    $('#updateconsultamodal').modal('open');
                }
                clearErrorsConsulta(); //limpia los mensaje de error en caso de que los haya
                document.getElementById('scrollwindow').scrollTo(0, 0);
            },
            error: function(response){
                if(response.responseJSON.errormsg == null){
                    if(response){
                        //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                        errorValidationConsulta(response); //Muestra los mensajes de error correspondiente por campo
                    }
                }else{
                    $('#errormsg').text(response.msg);
                    $('#errormodal').modal('open');
                }
                document.getElementById('scrollwindow').scrollTo(0, 0);                
            },
        });
    }
}

//Function that checks that radio buttons are selected when pregnant consultation is checkbox
function checkRadios(){
    let noerror = true;
    if(typeof $("input[name=consultaembarazo]:checked").val() == 'undefined'){
        $('#error-consultaembarazo').addClass('show');
        $("label[for=consultaembarazo1]").addClass('invalid-label');
        $("label[for=consultaembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=trimestreembarazo]:checked").val() == 'undefined'){
        $('#error-trimestreembarazo').addClass('show');
        $("label[for=trimestreembarazo1]").addClass('invalid-label');
        $("label[for=trimestreembarazo2]").addClass('invalid-label');
        $("label[for=trimestreembarazo3]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=riesgoembarazo]:checked").val() == 'undefined'){
        $('#error-riesgoembarazo').addClass('show');
        $("label[for=riesgoembarazo1]").addClass('invalid-label');
        $("label[for=riesgoembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=diabetesembarazo]:checked").val() == 'undefined'){
        $('#error-diabetesembarazo').addClass('show');
        $("label[for=diabetesembarazo1]").addClass('invalid-label');
        $("label[for=diabetesembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=infeccionembarazo]:checked").val() == 'undefined'){
        $('#error-infeccionembarazo').addClass('show');
        $("label[for=infeccionembarazo1]").addClass('invalid-label');
        $("label[for=infeccionembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=preclampsiaembarazo]:checked").val() == 'undefined'){
        $('#error-preclampsiaembarazo').addClass('show');
        $("label[for=preclampsiaembarazo1]").addClass('invalid-label');
        $("label[for=preclampsiaembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=hemorragiaembarazo]:checked").val() == 'undefined'){
        $('#error-hemorragiaembarazo').addClass('show');
        $("label[for=hemorragiaembarazo1]").addClass('invalid-label');
        $("label[for=hemorragiaembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=sospechacovidembarazo]:checked").val() == 'undefined'){
        $('#error-sospechacovidembarazo').addClass('show');
        $("label[for=sospechacovidembarazo1]").addClass('invalid-label');
        $("label[for=sospechacovidembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    if(typeof $("input[name=confirmacioncovidembarazo]:checked").val() == 'undefined'){
        $('#error-confirmacioncovidembarazo').addClass('show');
        $("label[for=confirmacioncovidembarazo1]").addClass('invalid-label');
        $("label[for=confirmacioncovidembarazo2]").addClass('invalid-label');
        noerror = false;
    }
    return noerror;
}

//Function that clear radio buttons on pregnant segment
function clearRadios(){
    if($("label[for=consultaembarazo1]").hasClass('invalid-label')){
        $('#error-consultaembarazo').removeClass('show');
        $("label[for=consultaembarazo1]").removeClass('invalid-label');
        $("label[for=consultaembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=trimestreembarazo1]").hasClass('invalid-label')){
        $('#error-trimestreembarazo').removeClass('show');
        $("label[for=trimestreembarazo1]").removeClass('invalid-label');
        $("label[for=trimestreembarazo2]").removeClass('invalid-label');
        $("label[for=trimestreembarazo3]").removeClass('invalid-label');
    }
    if($("label[for=riesgoembarazo1]").hasClass('invalid-label')){
        $('#error-riesgoembarazo').removeClass('show');
        $("label[for=riesgoembarazo1]").removeClass('invalid-label');
        $("label[for=riesgoembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=diabetesembarazo1]").hasClass('invalid-label')){
        $('#error-diabetesembarazo').removeClass('show');
        $("label[for=diabetesembarazo1]").removeClass('invalid-label');
        $("label[for=diabetesembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=infeccionembarazo1]").hasClass('invalid-label')){
        $('#error-infeccionembarazo').removeClass('show');
        $("label[for=infeccionembarazo1]").removeClass('invalid-label');
        $("label[for=infeccionembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=preclampsiaembarazo1]").hasClass('invalid-label')){
        $('#error-preclampsiaembarazo').removeClass('show');
        $("label[for=preclampsiaembarazo1]").removeClass('invalid-label');
        $("label[for=preclampsiaembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=hemorragiaembarazo1]").hasClass('invalid-label')){
        $('#error-hemorragiaembarazo').removeClass('show');
        $("label[for=hemorragiaembarazo1]").removeClass('invalid-label');
        $("label[for=hemorragiaembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=sospechacovidembarazo1]").hasClass('invalid-label')){
        $('#error-sospechacovidembarazo').removeClass('show');
        $("label[for=sospechacovidembarazo1]").removeClass('invalid-label');
        $("label[for=sospechacovidembarazo2]").removeClass('invalid-label');
    }
    if($("label[for=confirmacioncovidembarazo1]").hasClass('invalid-label')){
        $('#error-confirmacioncovidembarazo').removeClass('show');
        $("label[for=confirmacioncovidembarazo1]").removeClass('invalid-label');
        $("label[for=confirmacioncovidembarazo2]").removeClass('invalid-label');
    }

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

function collapsPreg(){
    var pregbox = document.getElementById('ispregnant');

    if(pregbox.checked){
        $('#pregContainer').removeClass('hide');

        document.getElementById('consultaembarazo1').disabled = false;
        document.getElementById('consultaembarazo2').disabled = false;

        document.getElementById('trimestreembarazo1').disabled = false;
        document.getElementById('trimestreembarazo2').disabled = false;
        document.getElementById('trimestreembarazo3').disabled = false;

        document.getElementById('riesgoembarazo1').disabled = false;
        document.getElementById('riesgoembarazo2').disabled = false;

        document.getElementById('diabetesembarazo1').disabled = false;
        document.getElementById('diabetesembarazo2').disabled = false;

        document.getElementById('infeccionembarazo1').disabled = false;
        document.getElementById('infeccionembarazo2').disabled = false;

        document.getElementById('preclampsiaembarazo1').disabled = false;
        document.getElementById('preclampsiaembarazo2').disabled = false;

        document.getElementById('hemorragiaembarazo1').disabled = false;
        document.getElementById('hemorragiaembarazo2').disabled = false;

        document.getElementById('sospechacovidembarazo1').disabled = false;
        document.getElementById('sospechacovidembarazo2').disabled = false;

        document.getElementById('confirmacioncovidembarazo1').disabled = false;
        document.getElementById('confirmacioncovidembarazo2').disabled = false;

    }else{
        $('#pregContainer').addClass('hide');

        document.getElementById('consultaembarazo1').disabled = true;
        document.getElementById('consultaembarazo2').disabled = true;

        document.getElementById('trimestreembarazo1').disabled = true;
        document.getElementById('trimestreembarazo2').disabled = true;
        document.getElementById('trimestreembarazo3').disabled = true;

        document.getElementById('riesgoembarazo1').disabled = true;
        document.getElementById('riesgoembarazo2').disabled = true;

        document.getElementById('diabetesembarazo1').disabled = true;
        document.getElementById('diabetesembarazo2').disabled = true;

        document.getElementById('infeccionembarazo1').disabled = true;
        document.getElementById('infeccionembarazo2').disabled = true;

        document.getElementById('preclampsiaembarazo1').disabled = true;
        document.getElementById('preclampsiaembarazo2').disabled = true;

        document.getElementById('hemorragiaembarazo1').disabled = true;
        document.getElementById('hemorragiaembarazo2').disabled = true;

        document.getElementById('sospechacovidembarazo1').disabled = true;
        document.getElementById('sospechacovidembarazo2').disabled = true;

        document.getElementById('confirmacioncovidembarazo1').disabled = true;
        document.getElementById('confirmacioncovidembarazo2').disabled = true;
    }
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
        $('#error-motivo').addClass('show');
        $('#motivo').addClass('error-textarea');
    }
    if(response.responseJSON.errors.cuadro){
        $('#error-cuadro').addClass('show');
        $('#cuadro').addClass('error-textarea');
    }
    if(response.responseJSON.errors.resultados){
        $('#error-resultados').addClass('show');
        $('#resultados').addClass('error-textarea');
    }
    if(response.responseJSON.errors.diagnostico){
        $('#error-diagnostico').addClass('show');
        $('#diagnostico').addClass('error-textarea');
    }
    if(response.responseJSON.errors.pronostico){
        $('#error-pronostico').addClass('show');
        $('#pronostico').addClass('error-textarea');
    }
    if(response.responseJSON.errors.indicacion){
        $('#error-indicacion').addClass('show');
        $('#indicacion').addClass('error-textarea');
    }
}

function clearErrorsConsulta(){
    if($('#motivo').hasClass('error-textarea')){
        $('#error-motivo').removeClass('show');
        $('#motivo').removeClass('error-textarea');
    }
    if($('#cuadro').hasClass('error-textarea')){
        $('#error-cuadro').removeClass('show');
        $('#cuadro').removeClass('error-textarea');
    }
    if($('#resultados').hasClass('error-textarea')){
        $('#error-resultados').removeClass('show');
        $('#resultados').removeClass('error-textarea');
    }
    if($('#diagnostico').hasClass('error-textarea')){
        $('#error-diagnostico').removeClass('show');
        $('#diagnostico').removeClass('error-textarea');
    }
    if($('#pronostico').hasClass('error-textarea')){
        $('#error-pronostico').removeClass('show');
        $('#pronostico').removeClass('error-textarea');
    }
    if($('#indicacion').hasClass('error-textarea')){
        $('#error-indicacion').removeClass('show');
        $('#indicacion').removeClass('error-textarea');
    }
}

function terminarConsulta(){
    var fd = new FormData();
    fd.append('test', "test");

    $.ajax({
        url: url + "/getconsulta/",
        type: "GET",
        processData: false,
        contentType: false,
        data: fd,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response == 1){
                $("#terminarmodal").modal('open');
            }else{
                $("#noIntermodal").modal('open');
            }
        },
        error: function(response){
            $("#noConsultamodal").modal('open');
        },
    });
}

function interdisabled(){
    let inter = $('#interavailable').val();
    if(inter == 0){
        $("#nointermodal").modal('open');
    }
}

function explodisabled(){
    let explo = $('#exploavailable').val();
    if(explo == 0){
        $("#noexplomodal").modal('open');
    }
}

function modaltest(){
    $('#noConsultamodal').modal('open');
}

function modaltestfunction(){
    $('#modalmsg').text("Prueba de texto en modal numero 5465456465464564");
    $('#consultamodal').modal('open');
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
    if($('#codeArea').hasClass('hide')){
        $('#codeArea').removeClass('hide');
    }

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
            $('#consultBtn').text("Consultar ECE");
            $('#infomsg').text("Peticion Completada con exito");
            $('#infomissing').modal('open');
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
        },
    });
}

$(function() {
    $('#consultBtn').on('click', function(){
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
                    if($('#codeArea').hasClass('hide')){
                        $('#codeArea').removeClass('hide');
                    }

                    $('#consultBtn').text("Consultar ECE");
                    $('#infomsg').text("Peticion Completada con exito");
                    $('#infomissing').modal('open');
                    var iframe = document.getElementById('iframecontent');
                    iframe.height="900px"
                    iframe.width="100%"
                    iframe.src = "data:text/html;base64," + response;
                },
                error: function(response){
                    if(response.responseJSON.errormsg){
                        $('#infomsg').text(response.responseJSON.errormsg);
                        $('#infomissing').modal('open');
                    }else{
                        $('#infomsg').text("¡Ha Ocurrido un error! Inténtalo más tarde");
                        $('#infomissing').modal('open');
                    }
                },
            });
        }else{
            $('#infomsg').text("¡Ha Ocurrido un error! Inténtalo más tarde");
            $('#infomissing').modal('open');
        }
    });
});

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
                if($('#codeArea').hasClass('hide')){
                    $('#codeArea').removeClass('hide');
                }

                $('#consultBtn').text("Consultar ECE");
                $('#infomsg').text("Peticion Completada con exito");
                $('#infomissing').modal('open');
                var iframe = document.getElementById('iframecontent');
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
        alert("La curp del paciente debe ser introducida!");
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
                $('#infomsg').text("Peticion Completada con exito");
                $('#infomissing').modal('open');
                var iframe = document.getElementById('iframecontentbasico');
                iframe.height="900px"
                iframe.width="100%"
                iframe.src = "data:text/html;base64," + response;
            },
            error: function(response){
                $('#infomsg').text("Ocurrio un error. Intentalo mas tarde.");
                $('#infomissing').modal('open');
            },
        });
    }else{
        $('#infomsg').text("La curp del paciente debe ser introducida.");
        $('#infomissing').modal('open');
    }
}
