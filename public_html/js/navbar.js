/**
 * Created by emad on 07/10/2015.
 */

$('#friends_request_nav').on('show.bs.dropdown', function () {
    var $this = $(this);
    var content = $this.find('ul.dropdown-menu');
    content.html('<div class="dropdown-preloader"><i class="fa fa-spinner fa-spin fa-2x"></i><div>در حال دریافت اطلاعات</div></div>');
    $.ajax({
        url : '/profile/friend/requestslist',
        type : 'post',
        data : {
            _token:$('input[name="_token"]').val()
        },
        success: function(data){
            console.log(data)
            content.html(data);
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });

});

setInterval( notifications_refresh , 3000);

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
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}