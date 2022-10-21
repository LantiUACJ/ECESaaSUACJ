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
            $("#notificationBadge").empty();
            $("usernotiBadge").empty();
            if(data > 0){
                $("#notificationBadge").text(data);
            }
            if(data == 0){
                $("#notificationBadge").text(data);
            }
        },
        error: function(response){
            window.scrollTo(0, 0);
            /*No Existen records*/
        },
    });
}