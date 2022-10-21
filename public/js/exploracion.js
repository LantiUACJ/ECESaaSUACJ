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
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('open');
            }
            $('#exploracionsubmit').addClass('hide');
            $('#exploracionupdate').removeClass('hide');
            document.getElementById('scrollwindow').scrollTo(0, 0); 
        },
        error: function(response){
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('open');
            }
            document.getElementById('scrollwindow').scrollTo(0, 0); 
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
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('open');
            }
            document.getElementById('scrollwindow').scrollTo(0, 0); 
        },
        error: function(response){
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('open');
            }
            document.getElementById('scrollwindow').scrollTo(0, 0);             
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
    let saturacionoxigeno = $("input[name=saturacionoxigeno]").val();
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
            saturacionoxigeno : saturacionoxigeno,
            glucosa : glucosa
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('open');
            }
            $('#signossubmit').addClass('hide');
            $('#signosupdate').removeClass('hide');
            if($('#exploracionupdate').hasClass('hide')){
                $('#exploracionupdate').removeClass('hide')
                $('#exploracionsubmit').addClass('hide');
            }
            document.getElementById('scrollwindow').scrollTo(0, 0); 
        },
        error: function(response){
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('open');
            }
            document.getElementById('scrollwindow').scrollTo(0, 0); 
        },
    });
}

function updatesignos(){
    let temperatura = $("input[name=temperatura]").val();
    let sistolica = $("input[name=sistolica]").val();
    let diastolica = $("input[name=diastolica]").val();
    let frecuenciacardiaca = $("input[name=frecuenciacardiaca]").val();
    let frecuenciarespiratoria = $("input[name=frecuenciarespiratoria]").val();
    let saturacionoxigeno = $("input[name=saturacionoxigeno]").val();
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
            saturacionoxigeno : saturacionoxigeno,
            glucosa : glucosa
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response){
                $('#explomsg').text(response.msg);
                $("#explomodal").modal('open');
            }
            $('#signossubmit').addClass('hide');
            $('#signosupdate').removeClass('hide');
            document.getElementById('scrollwindow').scrollTo(0, 0); 
        },
        error: function(response){
            if(response.responseJSON.errormsg == null){
                if(response){
                    //Mensajes idividuales para cada campo, por ahora solo es valido para motivo.
                    
                }
            }else{
                $('#errormsg').text(response.msg);
                $("#errormodal").modal('open');
            }
            document.getElementById('scrollwindow').scrollTo(0, 0); 
        },
    });
}