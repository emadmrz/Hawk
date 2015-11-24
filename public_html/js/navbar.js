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

//setInterval( notifications_refresh , 3000);

$(function notifications_refresh(){
    setTimeout(function(){
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
            },
            complete: notifications_refresh
        });
    }, 3000);
});


/**
 * Created By Dara on 15/11/2015
 * handling the search
 */
$(document).ready(function(){
    $('input#fast-search').keyup(function(){
        var $this=$('form[role="search"]');
        var value=$this.find('span.active').attr('id');
        var content=$this.find('ul[class="dropdown-menu"]');
        if($(this).val().length>2){
            //begin the search process
            $.ajax({
                url : "/search/fastSearch",
                type : 'post',
                //async: false,
                data :{
                    query:$(this).val(),
                    section:value
                },

                beforeSend: function(){
                    $("#fast_search_preloader").show();
                    content.html('<div class="dropdown-preloader"><i class="fa fa-spinner fa-spin fa-2x"></i><div>در حال دریافت اطلاعات</div></div>');
                },
                complete: function(){
                    $("#fast_search_preloader").hide();
                },
                success: function(data){
                    if(data.hasCallback){
                        window[data.callback](data.returns);
                    }
                    if(data.hasMsg){
                        var type = 'success';
                        if(data.msgType){
                            type = data.msgType;
                        }
                        $.notify(data.msg, {type:type});
                    }
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        }else{

            content.slideUp(300,function(){
                content.html('');
            });
        }
    });

    /**
     * Created By Dara on 15/11/2015
     * switch between users & products
     */
    $("div#navbar").find('span#users').click(function(){
        if($(this).hasClass('active')){
            $("div#navbar").find('input[name="cat"]').val('users');
        }else{
            $(this).addClass('active');
            $(this).siblings('span').removeClass('active');
            $("div#navbar").find('input[name="cat"]').val('users')
        }
    });
    $("div#navbar").find('span#products').click(function(){
        if($(this).hasClass('active')){
            $("div#navbar").find('input[name="cat"]').val('products');
        }else{
            $(this).addClass('active');
            $(this).siblings('span').removeClass('active');
            $("div#navbar").find('input[name="cat"]').val('products')
        }
    });
});

/**
 * Created By Dara on 15/11/2015
 * handling the search
 */
function search_fast(data){
    var $this=$('form[role="search"]');
    $this.find('div.search-result-navbar').children('ul').html(data);
    $this.find('div.search-result-navbar').children('ul').slideDown(300);

}
