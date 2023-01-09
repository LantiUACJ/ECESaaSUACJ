var url = $('meta[name="base_url"]').attr('content');

window.addEventListener("load", init(), false);

//Funcion que se ejecuta al inicio
function init(){
    // document.getElementById('numAdmins').value = 0;
    // document.getElementById('includeadmin1').value = "";
    // document.getElementById('includeadmin2').value = "";
}

function addMed(){
    //Buscar si existe el medico
    var curp = document.getElementById('lookcurp');
    if(curp.value != ""){
        $.ajax({
            url: url + "/tenantadmin/medicoCheck",
            type: "POST",
            data: {
                curp: curp.value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                console.log("respuesta: "+data);
                if(data == 2){
                    $('#errormsg').text("El Médico ya pertenece a la institución.");
                    $("#modalerror").modal('open');
                }else if(data == 1){
                    //Mostrar mensaje de medico ya en uso y continuar
                    document.getElementById('user1').classList.remove('hide');
                    document.getElementById('usercurp1').removeAttribute('disabled');
                    document.getElementById('usercurp1').value = curp.value;
                    document.getElementById('usercurp1').focus();
    
                    document.getElementById('medtype').value = 1;
                    document.getElementById('medicobutton').classList.add('hide');
                }else if(data == 0){
                    //Mostrar datos para registro de medico
                    document.getElementById('user2').classList.remove('hide');
                    document.getElementById('usercurp').removeAttribute('disabled');
                    document.getElementById('usercurp').value = curp.value;
                    document.getElementById('usercurp').focus();
                    document.getElementById('usercedula').removeAttribute('disabled');
                    document.getElementById('userphone').removeAttribute('disabled');
                    document.getElementById('usernombre').removeAttribute('disabled');
                    document.getElementById('userprimerApellido').removeAttribute('disabled');
                    document.getElementById('usersegundoApellido').removeAttribute('disabled');
                    document.getElementById('useremail').removeAttribute('disabled');
                    document.getElementById('userpassword').removeAttribute('disabled');
    
                    document.getElementById('medtype').value = 2;
                    document.getElementById('medicobutton').classList.add('hide');
                }else if(data == -1){
                    $('#errormsg').text("¡A ocurrido un error intentelo mas tarde!");
                    $("#modalerror").modal('open');
                }
            },
            error: function(response){
                console.log("Ocurrio un error");
                $('#errormsg').text("¡A ocurrido un error intentelo mas tarde!");
                $("#modalerror").modal('open');
            },
        });
    }else{
        $('#errormsg').text("Introduzca la Curp del médico.");
        $("#modalerror").modal('open');
    }
}

function removeMed1(){
    if(!document.getElementById('user1').classList.contains('hide')){
        document.getElementById('user1').classList.add('hide');
        document.getElementById('usercurp1').setAttribute('disabled', true);

        document.getElementById('medtype').value = "";
        document.getElementById('medicobutton').classList.remove('hide');
    }
}

function removeMed2(){
    if(!document.getElementById('user2').classList.contains('hide')){
        document.getElementById('user2').classList.add('hide');
        document.getElementById('usercurp').setAttribute('disabled', true);
        document.getElementById('usercedula').setAttribute('disabled', true);
        document.getElementById('userphone').setAttribute('disabled', true);
        document.getElementById('usernombre').setAttribute('disabled', true);
        document.getElementById('userprimerApellido').setAttribute('disabled', true);
        document.getElementById('usersegundoApellido').setAttribute('disabled', true);
        document.getElementById('useremail').setAttribute('disabled', true);
        document.getElementById('userpassword').setAttribute('disabled', true);
    
        document.getElementById('medtype').value = "";
        document.getElementById('medicobutton').classList.remove('hide');
    }
}