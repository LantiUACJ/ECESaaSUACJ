//Global url base
var url = $('meta[name="base_url"]').attr('content');

window.addEventListener("load", initnotifications(), false);

function initnotifications(){
    findNotifications();
}

function findNotifications(){

    let something = "something";

    $.ajax({
        url: url + "/notificationsCheck",
        type: "POST",
        data: {
            something: something
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            window.scrollTo(0, 0);
            /*Existen records*/
            console.log(data);
            $("#notificationBadge").empty();
            $("usernotiBadge").empty();
            if(data > 0){
                $("#notificationBadge").text(data);
                $("#usernotiBadge").removeClass('hiddenli');
                $("#info-consulta-notification").removeClass('hiddenli');
            }
            if(data == 0){
                $("#notificationBadge").empty();
                $("#usernotiBadge").addClass('hiddenli');
                $("#info-consulta-notification").addClass('hiddenli');
            }
            console.log("Success at check");
        },
        error: function(response){
            window.scrollTo(0, 0);
            /*No Existen records*/
            console.log(response.responseJSON.errormsg);
            console.log("Ocurrio un error");
        },
    });
}