/**
 * Created by emad on 07/10/2015.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#friends_request_nav').on('show.bs.dropdown', function () {
    var $this = $(this);
    var content = $this.find('ul.dropdown-menu');
    content.html('<div class="dropdown-preloader"><i class="fa fa-spinner fa-spin fa-2x"></i><div>در حال دریافت اطلاعات</div></div>');
    $.ajax({
        url : '/profile/friend/requestslist',
        type : 'post',
        data : {},
        success: function(data){
            console.log(data)
            content.html(data);
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

});

$('#new_notifications_nav').on('show.bs.dropdown', function () {
    var $this = $(this);
    var content = $this.find('ul.dropdown-menu');
    content.html('<div class="dropdown-preloader"><i class="fa fa-spinner fa-spin fa-2x"></i><div>در حال دریافت اطلاعات</div></div>');
    $.ajax({
        url : '/home/stream/notification',
        type : 'post',
        data : {},
        success: function(data){
            console.log(data)
            content.html(data);
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

});

setTimeout( notifications_refresh , 3000);

function notifications_refresh(){
    $.ajax({
        url : '/api/notification/num',
        type : 'get',
        dataType: 'json',
        data : {},
        success: function(data){
            if(data.friend_request > 0){
                $("nav").find("#new_friend_request_num").html('<i class="notification_num">'+data.friend_request+'</i>');
            }else{
                $("nav").find("#new_friend_request_num").html('');
            }
            if(data.notification > 0){
                $("nav").find("#new_notifications_num").html('<i class="notification_num">'+data.notification+'</i>');
            }else{
                $("nav").find("#new_notifications_num").html('');
            }
        },
        error: function(xhr){
            //alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}