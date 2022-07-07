var url = $('meta[name="base_url"]').attr('content');

//Store y update de datos de interrogatorio
function storedatosinter(){
    let grupo = $('select[name=grupo] option').filter(':selected').val();
    let padecimiento = $("input[name=padecimiento]").val();

    $.ajax({
        url: url + "/storeinterrogatorio",
        type: "POST",
        data: {
            grupo: grupo,
            padecimiento: padecimiento
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
            clearErrorsInterrogatorio();
            $('#intersubmit').css("display", "none");
            $('#interupdate').css("display", "block"); 
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                    errorValidationInterrogatorio(response);
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function updatedatosinter(){
    let grupo = $('select[name=grupo] option').filter(':selected').val();
    let padecimiento = $("input[name=padecimiento]").val();

    $.ajax({
        url: url + "/updateinterrogatorio",
        type: "POST",
        data: {
            grupo: grupo,
            padecimiento: padecimiento
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
            clearErrorsInterrogatorio();
            $('#intersubmit').css("display", "none");
            $('#interupdate').css("display", "block"); 
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                    errorValidationInterrogatorio(response);
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

//Store y update de antecedesntes heredo familiares
function storeantecedenteshf(){

    let diabetes = $("input[name=diabetes]").is(':checked') ? 1: 0;
    let hipertension = $("input[name=hipertension]").is(':checked') ? 1: 0;
    let dislipidemias = $('input[name=dislipidemias]').is(':checked') ? 1: 0;
    let neoplasias = $('input[name=neoplasias]').is(':checked') ? 1: 0;
    let tuberculosis = $('input[name=tuberculosis]').is(':checked') ? 1: 0;
    let artritis = $('input[name=artritis]').is(':checked') ? 1: 0;
    let cardiopatias = $('input[name=cardiopatias]').is(':checked') ? 1: 0;
    let alzheimer = $('input[name=alzheimer]').is(':checked') ? 1: 0;
    let epilepsia = $('input[name=epilepsia]').is(':checked') ? 1: 0;
    let parkinson = $('input[name=parkinson]').is(':checked') ? 1: 0;
    let esclerosis = $('input[name=esclerosis]').is(':checked') ? 1: 0;
    let trastorno = $('input[name=trastorno]').is(':checked') ? 1: 0;
    let depresion = $('input[name=depresion]').is(':checked') ? 1: 0;
    let esquizofrenia = $('input[name=esquizofrenia]').is(':checked') ? 1: 0;
    let cirrosis = $('input[name=cirrosis]').is(':checked') ? 1: 0;
    let colestasis = $('input[name=colestasis]').is(':checked') ? 1: 0;
    let hepatitis = $('input[name=hepatitis]').is(':checked') ? 1: 0;
    let alergias = $('input[name=alergias]').is(':checked') ? 1: 0;
    let endocrinas = $('input[name=endocrinas]').is(':checked') ? 1: 0;
    let geneticas = $('input[name=geneticas]').is(':checked') ? 1: 0;
    let otroshf = $('input[name=otroshf]').val();

    $.ajax({
        url: url + "/storeantecedenteshf",
        type: "POST",
        data: {
            diabetes : diabetes,
            hipertension : hipertension,
            dislipidemias : dislipidemias,
            neoplasias : neoplasias,
            tuberculosis : tuberculosis,
            artritis : artritis,
            cardiopatias : cardiopatias,
            alzheimer : alzheimer,
            epilepsia : epilepsia,
            parkinson : parkinson,
            esclerosis : esclerosis,
            trastorno : trastorno,
            depresion : depresion,
            esquizofrenia : esquizofrenia,
            cirrosis : cirrosis,
            colestasis : colestasis,
            hepatitis : hepatitis,
            alergias : alergias,
            endocrinas : endocrinas,
            geneticas : geneticas,
            otros : otroshf
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
            $('#antehrsubmit').css("display", "none");
            $('#antehrupdate').css("display", "block");
            if($('#interupdate').hasClass('hiddenli')){
                $('#interupdate').removeClass('hiddenli')
                $('#intersubmit').addClass('hiddenli');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function updateantecedenteshf(){
    let diabetes = $("input[name=diabetes]").is(':checked') ? 1: 0;
    let hipertension = $("input[name=hipertension]").is(':checked') ? 1: 0;
    let dislipidemias = $('input[name=dislipidemias]').is(':checked') ? 1: 0;
    let neoplasias = $('input[name=neoplasias]').is(':checked') ? 1: 0;
    let tuberculosis = $('input[name=tuberculosis]').is(':checked') ? 1: 0;
    let artritis = $('input[name=artritis]').is(':checked') ? 1: 0;
    let cardiopatias = $('input[name=cardiopatias]').is(':checked') ? 1: 0;
    let alzheimer = $('input[name=alzheimer]').is(':checked') ? 1: 0;
    let epilepsia = $('input[name=epilepsia]').is(':checked') ? 1: 0;
    let parkinson = $('input[name=parkinson]').is(':checked') ? 1: 0;
    let esclerosis = $('input[name=esclerosis]').is(':checked') ? 1: 0;
    let trastorno = $('input[name=trastorno]').is(':checked') ? 1: 0;
    let depresion = $('input[name=depresion]').is(':checked') ? 1: 0;
    let esquizofrenia = $('input[name=esquizofrenia]').is(':checked') ? 1: 0;
    let cirrosis = $('input[name=cirrosis]').is(':checked') ? 1: 0;
    let colestasis = $('input[name=colestasis]').is(':checked') ? 1: 0;
    let hepatitis = $('input[name=hepatitis]').is(':checked') ? 1: 0;
    let alergias = $('input[name=alergias]').is(':checked') ? 1: 0;
    let endocrinas = $('input[name=endocrinas]').is(':checked') ? 1: 0;
    let geneticas = $('input[name=geneticas]').is(':checked') ? 1: 0;
    let otroshf = $('input[name=otroshf]').val();

    $.ajax({
        url: url + "/updateantecedenteshf",
        type: "POST",
        data: {
            diabetes : diabetes,
            hipertension : hipertension,
            dislipidemias : dislipidemias,
            neoplasias : neoplasias,
            tuberculosis : tuberculosis,
            artritis : artritis,
            cardiopatias : cardiopatias,
            alzheimer : alzheimer,
            epilepsia : epilepsia,
            parkinson : parkinson,
            esclerosis : esclerosis,
            trastorno : trastorno,
            depresion : depresion,
            esquizofrenia : esquizofrenia,
            cirrosis : cirrosis,
            colestasis : colestasis,
            hepatitis : hepatitis,
            alergias : alergias,
            endocrinas : endocrinas,
            geneticas : geneticas,
            otros : otroshf
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function isNumeric(str) {
    if (typeof str != "string") return false // we only process strings!  
    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
        !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

//Store y update de antecedesntes personales patologicos
function storeantecedentespp(){

    let infectacontagiosa = $('textarea[name=infectacontagiosa]').val();
    let cronicodegenerativa = $('textarea[name=cronicodegenerativa]').val();
    let traumatologicos = $('textarea[name=traumatologicos]').val();
    let alergicos = $('textarea[name=alergicos]').val();
    let quirurgicos = $('textarea[name=quirurgicos]').val();
    let hospitalizaciones = $('textarea[name=hospitalizaciones]').val();
    let transfusiones = $('textarea[name=transfusiones]').val();
    //let toxicomanias = $('textarea[name=toxicomanias]').val();
    let otrospp = $('textarea[name=otrospp]').val();
    let toxico = []; //arreglo de toxicomanias

    let toxicomanias = document.getElementsByClassName("item");
    let count = 0;

    if(toxicomanias.length > 0){
        [].forEach.call(toxicomanias, function(element) {
            if(isNumeric(element.getAttribute("data-value"))){
                toxico[count] = element.getAttribute("data-value");
                count++;
            }
        });
    }

    
    $.ajax({
        url: url + "/storeantecedentespp",
        type: "POST",
        data: {
            infectacontagiosa : infectacontagiosa,
            cronicodegenerativa : cronicodegenerativa,
            traumatologicos : traumatologicos,
            alergicos : alergicos,
            quirurgicos : quirurgicos,
            hospitalizaciones : hospitalizaciones,
            transfusiones : transfusiones,
            toxicomanias : toxico,
            otros : otrospp
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
            $('#antePPsubmit').css("display", "none");
            $('#antePPupdate').css("display", "block");
            if($('#interupdate').hasClass('hiddenli')){
                $('#interupdate').removeClass('hiddenli')
                $('#intersubmit').addClass('hiddenli');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function updateantecedentespp(){
    
    let infectacontagiosa = $('textarea[name=infectacontagiosa]').val();
    let cronicodegenerativa = $('textarea[name=cronicodegenerativa]').val();
    let traumatologicos = $('textarea[name=traumatologicos]').val();
    let alergicos = $('textarea[name=alergicos]').val();
    let quirurgicos = $('textarea[name=quirurgicos]').val();
    let hospitalizaciones = $('textarea[name=hospitalizaciones]').val();
    let transfusiones = $('textarea[name=transfusiones]').val();
    //let toxicomanias = $('textarea[name=toxicomanias]').val();
    let otrospp = $('textarea[name=otrospp]').val();

    let toxico = []; //arreglo de toxicomanias

    let toxicomanias = document.getElementsByClassName("item");
    let count = 0;

    if(toxicomanias.length > 0){
        [].forEach.call(toxicomanias, function(element) {
            if(isNumeric(element.getAttribute("data-value"))){
                toxico[count] = element.getAttribute("data-value");
                count++;
            }
        });
    }

    
    $.ajax({
        url: url + "/updateantecedentespp",
        type: "POST",
        data: {
            infectacontagiosa : infectacontagiosa,
            cronicodegenerativa : cronicodegenerativa,
            traumatologicos : traumatologicos,
            alergicos : alergicos,
            quirurgicos : quirurgicos,
            hospitalizaciones : hospitalizaciones,
            transfusiones : transfusiones,
            toxicomanias : toxico,
            otros : otrospp
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

//Store y update de antecedesntes personales No patologicos
function storeantecedentespnp(){

    let vivienda = $('textarea[name=vivienda]').val();
    let higiene = $('textarea[name=higiene]').val();
    let dieta = $('textarea[name=dieta]').val();
    let zoonosis = $('textarea[name=zoonosis]').val();
    let otrospnp = $('textarea[name=otrospnp]').val();

    $.ajax({
        url: url + "/storeantecedentespnp",
        type: "POST",
        data: {
            vivienda : vivienda,
            higiene : higiene,
            dieta : dieta,
            zoonosis : zoonosis,
            otros : otrospnp
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
            $('#antePNPsubmit').css("display", "none");
            $('#antePNPupdate').css("display", "block");
            if($('#interupdate').hasClass('hiddenli')){
                $('#interupdate').removeClass('hiddenli')
                $('#intersubmit').addClass('hiddenli');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function updateantecedentespnp(){

    let vivienda = $('textarea[name=vivienda]').val();
    let higiene = $('textarea[name=higiene]').val();
    let dieta = $('textarea[name=dieta]').val();
    let zoonosis = $('textarea[name=zoonosis]').val();
    let otrospnp = $('textarea[name=otrospnp]').val();

    $.ajax({
        url: url + "/updateantecedentespnp",
        type: "POST",
        data: {
            vivienda : vivienda,
            higiene : higiene,
            dieta : dieta,
            zoonosis : zoonosis,
            otros : otrospnp
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

//Store y update de interrogtorio aparatos y sistemas
function storeaparatos(){
    let signos = $('textarea[name=signos]').val();
    let cardiovascular = $('textarea[name=cardiovascular]').val();
    let respiratorio = $('textarea[name=respiratorio]').val();
    let digestivo = $('textarea[name=digestivo]').val();
    let nefro = $('textarea[name=nefro]').val();
    let endocrino = $('textarea[name=endocrino]').val();
    let hematopoyetico = $('textarea[name=hematopoyetico]').val();
    let nervioso = $('textarea[name=nervioso]').val();
    let musculo = $('textarea[name=musculo]').val();
    let piel = $('textarea[name=piel]').val();
    let sentidos = $('textarea[name=sentidos]').val();
    let psiquica = $('inptextareaut[name=psiquica]').val();

    $.ajax({
        url: url + "/storeaparatos",
        type: "POST",
        data: {
            signos : signos,
            cardiovascular : cardiovascular,
            respiratorio : respiratorio,
            digestivo : digestivo,
            nefro : nefro,
            endocrino : endocrino,
            hematopoyetico : hematopoyetico,
            nervioso : nervioso,
            musculo : musculo,
            piel : piel,
            sentidos : sentidos,
            psiquica : psiquica
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
            $('#aparatossubmit').css("display", "none");
            $('#aparatosupdate').css("display", "block");
            if($('#interupdate').hasClass('hiddenli')){
                $('#interupdate').removeClass('hiddenli')
                $('#intersubmit').addClass('hiddenli');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function updateaparatos(){
    let signos = $('textarea[name=signos]').val();
    let cardiovascular = $('textarea[name=cardiovascular]').val();
    let respiratorio = $('textarea[name=respiratorio]').val();
    let digestivo = $('textarea[name=digestivo]').val();
    let nefro = $('textarea[name=nefro]').val();
    let endocrino = $('textarea[name=endocrino]').val();
    let hematopoyetico = $('textarea[name=hematopoyetico]').val();
    let nervioso = $('textarea[name=nervioso]').val();
    let musculo = $('textarea[name=musculo]').val();
    let piel = $('textarea[name=piel]').val();
    let sentidos = $('textarea[name=sentidos]').val();
    let psiquica = $('textarea[name=psiquica]').val();

    $.ajax({
        url: url + "/updateaparatos",
        type: "POST",
        data: {
            signos : signos,
            cardiovascular : cardiovascular,
            respiratorio : respiratorio,
            digestivo : digestivo,
            nefro : nefro,
            endocrino : endocrino,
            hematopoyetico : hematopoyetico,
            nervioso : nervioso,
            musculo : musculo,
            piel : piel,
            sentidos : sentidos,
            psiquica : psiquica
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#intermsg').text(response.msg);
                $("#intermodal").modal('show');
            }
        },
        error: function(response){
            console.log(response.responseJSON.errormsg);
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('show');
            }
            
        },
    });
}

function errorValidationInterrogatorio(response){
    if(response.responseJSON.errors.grupo){
        $('#error-grupo').css("display", 'block');
        $('#grupo').addClass('is-invalid');
    }
    if(response.responseJSON.errors.padecimiento){
        $('#error-padecimiento').css("display", 'block');
        $('#padecimiento').addClass('is-invalid');
    }
}

function clearErrorsInterrogatorio(){
    if($('#grupo').hasClass('is-invalid')){
        $('#error-grupo').css("display", 'none');
        $('#grupo').removeClass('is-invalid');
    }
    if($('#padecimiento').hasClass('is-invalid')){
        $('#error-padecimiento').css("display", 'none');
        $('#padecimiento').removeClass('is-invalid');
    }
}