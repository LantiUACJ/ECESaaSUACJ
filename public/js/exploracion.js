var url = $('meta[name="base_url"]').attr('content');

//Store y update de datos de exploracion
function storeexploracion(){
    let habitus = $("textarea[name=habitus]").val();
    let peso = $("input[name=peso]").val();
    let talla = $("input[name=talla]").val();
    let cabeza = $("textarea[name=cabeza]").val();
    let cuello = $("textarea[name=cuello]").val();
    let torax = $("textarea[name=torax]").val();
    let abdomen = $("textarea[name=abdomen]").val();
    let miembros = $("textarea[name=miembros]").val();
    let genitales = $("textarea[name=genitales]").val();

    $.ajax({
        url: url + "/storeexploracion",
        type: "POST",
        data: {
            habitus : habitus,
            peso : peso,
            talla : talla,
            cabeza : cabeza,
            cuello : cuello,
            torax : torax,
            abdomen : abdomen,
            miembros : miembros,
            genitales : genitales
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('show');
            }
            $('#exploracionsubmit').css("display", "none");
            $('#exploracionupdate').css("display", "block");
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

function updateexploracion(){
    let habitus = $("textarea[name=habitus]").val();
    let peso = $("input[name=peso]").val();
    let talla = $("input[name=talla]").val();
    let cabeza = $("textarea[name=cabeza]").val();
    let cuello = $("textarea[name=cuello]").val();
    let torax = $("textarea[name=torax]").val();
    let abdomen = $("textarea[name=abdomen]").val();
    let miembros = $("textarea[name=miembros]").val();
    let genitales = $("textarea[name=genitales]").val();

    $.ajax({
        url: url + "/updateexploracion",
        type: "POST",
        data: {
            habitus : habitus,
            peso : peso,
            talla : talla,
            cabeza : cabeza,
            cuello : cuello,
            torax : torax,
            abdomen : abdomen,
            miembros : miembros,
            genitales : genitales
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('show');
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

//Store y update de datos de exploracion
function storesignos(){
    let temperatura = $("input[name=temperatura]").val();
    let sistolica = $("input[name=sistolica]").val();
    let diastolica = $("input[name=diastolica]").val();
    let frecuenciacardiaca = $("input[name=frecuenciacardiaca]").val();
    let frecuenciarespiratoria = $("input[name=frecuenciarespiratoria]").val();
    let saturacion = $("input[name=saturacionoxigeno]").val();
    let glucosa = $("input[name=glucosa]").val();

    $.ajax({
        url: url + "/storesignos",
        type: "POST",
        data: {
            temperatura : temperatura,
            sistolica : sistolica,
            diastolica : diastolica,
            frecuenciacardiaca : frecuenciacardiaca,
            frecuenciarespiratoria : frecuenciarespiratoria,
            saturacion : saturacion,
            glucosa : glucosa
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('show');
            }
            $('#signossubmit').css("display", "none");
            $('#signosupdate').css("display", "block");
            if($('#exploracionupdate').hasClass('hiddenli')){
                $('#exploracionupdate').removeClass('hiddenli')
                $('#exploracionsubmit').addClass('hiddenli');
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

function updatesignos(){
    let temperatura = $("input[name=temperatura]").val();
    let sistolica = $("input[name=sistolica]").val();
    let diastolica = $("input[name=diastolica]").val();
    let frecuenciacardiaca = $("input[name=frecuenciacardiaca]").val();
    let frecuenciarespiratoria = $("input[name=frecuenciarespiratoria]").val();
    let saturacion = $("input[name=saturacionoxigeno]").val();
    let glucosa = $("input[name=glucosa]").val();

    $.ajax({
        url: url + "/updatesignos",
        type: "POST",
        data: {
            temperatura : temperatura,
            sistolica : sistolica,
            diastolica : diastolica,
            frecuenciacardiaca : frecuenciacardiaca,
            frecuenciarespiratoria : frecuenciarespiratoria,
            saturacion : saturacion,
            glucosa : glucosa
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            console.log(response);
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('show');
            }
            $('#signossubmit').css("display", "none");
            $('#signosupdate').css("display", "block");
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