var url = $('meta[name="base_url"]').attr('content');

window.addEventListener("load", init(), false);

//Funcion que se ejecuta al inicio
function init(){
    // document.getElementById('numAdmins').value = 0;
    // document.getElementById('includeadmin1').value = "";
    // document.getElementById('includeadmin2').value = "";
}

function changetype(type){
    var instdiv = document.getElementById('instituto');
    var partdiv = document.getElementById('particular');

    if(type == 1){
        if(instdiv.classList.contains('hide')){
            instdiv.classList.remove('hide');
        }
        if(!partdiv.classList.contains('hide')){
            partdiv.classList.add('hide');
        }
        removeMed();
    }else{
        if(partdiv.classList.contains('hide')){
            partdiv.classList.remove('hide');
        }
        if(!instdiv.classList.contains('hide')){
            instdiv.classList.add('hide');
        }
        removeAdmin1();
        removeAdmin2();
    }
}

function addAdmin(){
    var numadmins = document.getElementById('numAdmins');
    var admin1 = document.getElementById('admin1');
    var admin2 = document.getElementById('admin2');

    //Contiene hide mostrar 1 
    if(admin1.classList.contains('hide')){
        admin1.classList.remove('hide');
        document.getElementById('adminname1').removeAttribute('disabled');
        document.getElementById('adminemail1').removeAttribute('disabled');
        document.getElementById('adminphone1').removeAttribute('disabled');
        document.getElementById('adminpassword1').removeAttribute('disabled');
        numadmins.value = parseInt(numadmins.value) + 1;
        document.getElementById('includeadmin1').value = 1;
    }else if(admin2.classList.contains('hide')){
        admin2.classList.remove('hide');
        document.getElementById('adminname2').removeAttribute('disabled');
        document.getElementById('adminemail2').removeAttribute('disabled');
        document.getElementById('adminphone2').removeAttribute('disabled');
        document.getElementById('adminpassword2').removeAttribute('disabled');
        numadmins.value = parseInt(numadmins.value) + 1;
        document.getElementById('includeadmin2').value = 1;
    }

    if(numadmins.value == 2){
        document.getElementById('adminbutton').classList.add('hide');
    }
}

function removeAdmin1(){
    if(!document.getElementById('admin1').classList.contains('hide')){
        var numadmins = document.getElementById('numAdmins');
        document.getElementById('admin1').classList.add('hide');
        document.getElementById('adminname1').setAttribute('disabled', true);
        document.getElementById('adminemail1').setAttribute('disabled', true);
        document.getElementById('adminphone1').setAttribute('disabled', true);
        document.getElementById('adminpassword1').setAttribute('disabled', true);
        numadmins.value = parseInt(numadmins.value) - 1;
        document.getElementById('includeadmin1').value = "";
        document.getElementById('adminbutton').classList.remove('hide');
    }
}

function removeAdmin2(){
    if(!document.getElementById('admin2').classList.contains('hide')){
        var numadmins = document.getElementById('numAdmins');
        document.getElementById('admin2').classList.add('hide');
        document.getElementById('adminname2').setAttribute('disabled', true);
        document.getElementById('adminemail2').setAttribute('disabled', true);
        document.getElementById('adminphone2').setAttribute('disabled', true);
        document.getElementById('adminpassword2').setAttribute('disabled', true);
        numadmins.value = parseInt(numadmins.value) - 1;
        document.getElementById('includeadmin2').value = "";
        document.getElementById('adminbutton').classList.remove('hide');
    }
}

function addMed(){
    //Buscar si existe el medico
    var curp = document.getElementById('lookcurp');

    $.ajax({
        url: url + "/eceadmin/medicoCheck",
        type: "POST",
        data: {
            curp: curp.value
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            console.log("respuesta: "+data);
            // 1 - existe
            // 0 - no exites
            //-1 - no autenticado?
            if(data == 1){
                //Mostrar mensaje de medico ya en uso y continuar
                document.getElementById('user1').classList.remove('hide');
                document.getElementById('usercurp1').removeAttribute('disabled');
                document.getElementById('usercurp1').value = curp.value;
                document.getElementById('usercurp1').focus();

                document.getElementById('includemed1').value = 1;
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

                document.getElementById('includemed2').value = 1;
                document.getElementById('medicobutton').classList.add('hide');
            }else if(data == -1){
                $("#modalerror").modal('open');
            }
        },
        error: function(response){
            console.log("Ocurrio un error");
            $("#modalerror").modal('open');
        },
    });
}

function removeMed1(){
    if(!document.getElementById('user1').classList.contains('hide')){
        document.getElementById('user1').classList.add('hide');
        document.getElementById('usercurp1').setAttribute('disabled', true);

        document.getElementById('includemed1').value = "";
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
    
        document.getElementById('includemed2').value = "";
        document.getElementById('medicobutton').classList.remove('hide');
    }
}