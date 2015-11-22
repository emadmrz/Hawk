$(document).ready(function(){

    $('form[data-remote]').submit(function(e){
        e.preventDefault();
        var $this = $(this);
        var data = $this.serialize();
        var action = $this.attr('action');
        var method = $this.attr('method');
        if($this.find('input[name="_method"]').length>0){
            method = $this.find('input[name="_method"]').val();
        }
        console.log(method);
        var current_text = $this.find('button[type=submit]').html();
        $.ajax({
            url : action,
            type : method,
            data : data,
            dataType: 'json',
            beforeSend: function(){
                $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
            },
            complete: function(){
                if($this.find('button[type="submit"]').find('i').hasClass('fa fa-spinner fa-spin')){
                    $this.find('button[type="submit"]').html(current_text);
                }
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
    });

    //Program a custom submit function for the form
    $("form[data-remote-file]").submit(function(event){

        //disable the default form submission
        event.preventDefault();

        //grab all form data
        var formData = new FormData($(this)[0]);

        var $this = $(this);
        var action = $this.attr('action');
        var method = $this.attr('method');
        if($this.find('input[name="_method"]').length>0){
            method = $this.find('input[name="_method"]').val();
        }
        console.log(method);
        var current_text = $this.find('button[type=submit]').html();

        $.ajax({
            url: action,
            type: method,
            data: formData,
            //async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
            },
            complete: function(){
                $this.find('button[type="submit"]').html(current_text);
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

        return false;
    });

    $('[data-delete-confirm]').click(function(){
        if(!confirm( $(this).attr('data-delete-message') )){
            return false;
        }
    })

    $('select#province_id').change(function(){
        if($(this).val()!=0){
            $.ajax({
                type: 'get',
                url: "/api/location/cities/",
                data: {province_id: $(this).val()},
                dataType: 'json',
                success: function(data){
                    var $select = $("select#city_id");
                    var $default=$("<option/>").attr('value',0).text('اهمیتی ندارد');
                    $select.html('');
                    $(data).each(function (key, value) {
                        var $option = $("<option/>").attr("value", value.id).text(value.name);
                        $select.append($option);
                    });
                    $select.append($default);
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        }else{
            var $default=$("<option/>").attr('value',0).text('اهمیتی ندارد');
            var $select = $("select#city_id");
            $select.html('');
            $select.append($default);
        }

    });

    /**
     * Created By Dara on 18/11/15
     * skill_province select box
     */
    $('select#skill_province_id').change(function(){
        if($(this).val()!=0){
            $.ajax({
                type: 'get',
                url: "/api/location/cities/",
                data: {province_id: $(this).val()},
                dataType: 'json',
                success: function(data){
                    var $select = $("select#skill_city_id");
                    var $default=$("<option/>").attr('value',0).text('اهمیتی ندارد');
                    $select.html('');
                    $(data).each(function (key, value) {
                        var $option = $("<option/>").attr("value", value.id).text(value.name);
                        $select.append($option);
                    });
                    $select.append($default);
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        }else{
            var $default=$("<option/>").attr('value',0).text('اهمیتی ندارد');
            var $select = $("select#skill_city_id");
            $select.html('');
            $select.append($default);
        }

    });

    /**
     * Created By Dara on 19/11/2015
     * handling the skill week day select-box in search
     */
    $("select#skill_first_week").change(function(){
        var selected=$(this).val();
        var data={
            0:'اهمیتی ندارد',
            1:'شنبه'  ,
            2:'یکشنبه',
            3:'دوشنبه',
            4:'سه شنبه',
            5:'چهارشنبه',
            6:'پنجشنبه',
            7:'جمعه'
        };
        if(selected==0){
            var $select=$("select#skill_second_week");
            $select.html('');
            var $option = $("<option/>").attr("value", 0).text('اهمیتی ندارد');
            $select.append($option);
            return;
        }
        var $select=$("select#skill_second_week");
        $select.html('');
        $.each(data,function (key, value) {
            if(key>=selected){
                var $option = $("<option/>").attr("value", key).text(value);
                $select.append($option);
            }
        });

    });

    $("#user_info_form").inlineEditor();
    $("#education_form").inlineEditor();

    $("#education_table_edit").on('submit', 'form', function(e){
        $(this).deleteEduction(e);
    });

    $("#biography-attachment-form").submit(function(e){
        e.preventDefault();
        var data = new FormData($(this)[0]);
        uploadAttachment(data);
    });

    $("#article-attachment-form").submit(function(e){
        e.preventDefault();
        var data = new FormData($(this)[0]);
        data.append('article', $("input#article_id").val());
        uploadArticleAttachment(data);
    });

    $('.attachments-list').on('click', 'b#delete_attachment', function(){
        deleteAttachment($(this))
    });

    $('#article_edit_form').find('.attachments-list').on('click', 'b#delete_attachment', function(){
        deleteArticleAttachment($(this))
    });

    $('#problem_text_container').on('click', 'b#delete_problem_attachment', function(){
        deleteProblemAttachment($(this))
    });

    $('.article_summernote').summernote({
        height: 230,
        direction: 'rtl',
        lang: 'fa-IR',
        toolbar: [
            //[groupname, [button list]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['color', ['color']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
        onImageUpload: function(files) {
            sendArticleFile(files[0]);
        }
    });

    $('.textarea_summernote').summernote({
        height: 230,
        direction: 'rtl',
        lang: 'fa-IR',
        toolbar: [
            //[groupname, [button list]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['color', ['color']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ],
        onImageUpload: function(files) {
            sendTextareaFile(files[0]);
        }
    });

    $('input#article_banner').change(function(){
        var $this = $(this);
        var article_id = $('input#article_id').val();
        var file_data = $this.prop("files")[0];
        var form_data = new FormData();
        form_data.append("image", file_data);
        form_data.append("_token", $('input[name="_token"]').val());
        $.ajax({
            url: "/profile/article/"+article_id+"/banner",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function(){
                $("#article_banner_uploader").fadeIn(200);
                $("#article_image_banner").fadeOut(200);
            },
            complete: function(){
                $("#article_banner_uploader").hide();
            },
            success: function(data){
                console.log(data);
                if(data.returns.status == 1){
                    $("#article_image_banner").attr('href',data.returns.url).fadeIn(200);
                    $this.val('');
                }else{
                    notify_create(data);
                }

            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    })

    $("#article_edit_form_submit").click(function(){
        $("#article_edit_form").submit();
    })

    $("input#postImage").change(function () {
        var $this = $(this);
        var imageButton = $(this).closest('i');
        file_data = $this.prop('files')[0]
        var form_data = new FormData();
        form_data.append("image", file_data);
        form_data.append("_token", $('input[name="_token"]').val());
        $.ajax({
            url: "/profile/post/image",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function(){
                imageButton.removeClass('fa-image').addClass('fa-spin fa-spinner');
                $("#post_submit_btn").attr('disabled', 'disabled');
            },
            complete: function(){
                imageButton.removeClass('fa-spin fa-spinner').addClass('fa-image');
                $("#post_submit_btn").removeAttr('disabled');
            },
            success: function(data){
                console.log(data);
                $("#add_new_post").find('#post_banner').html('<img class="img-rounded" src="'+data+'" ><i id="delete_image" class="fa fa-times fa-lg"></i>');
                $("#add_new_post").find('#post_banner').addClass('has-banner');
                $("#add_new_post").find('#post_text_container').addClass('has-banner');
                $("#add_new_post").find('#post_image_value').val(data);
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    })

    $("#add_new_post").find('#post_banner').on('click', '#delete_image', function () {
        var $this =$(this);
        $this.siblings('img').remove();
        $this.remove();
        $("#add_new_post").find('#post_banner').removeClass('has-banner');
        $("#add_new_post").find('#post_text_container').removeClass('has-banner');
        $("#add_new_post").find('#post_image_value').val('');
    });

    $("#add_new_post").on('click', '.post-location-box #delete_location', function(){
        var $this = $(this);
        $this.closest(".post-location-box").remove();
        $("#add_new_post").find("#my_location_value").val('');
    })

    $("textarea#flex_textarea").flexText();

    $("#add_new_post").find("a#myLocation").click(function(e){
        $this = $(this);
        $this.find('i').removeClass('fa-map-marker').addClass('fa-spin fa-spinner');
        e.preventDefault();
        var geocoder;

        geocoder = new google.maps.Geocoder();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
        }

        function successFunction(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            codeLatLng(lat, lng)
        }

        function errorFunction(){
            alert("Geocoder failed");
            $this.find('i').removeClass('fa-spin fa-spinner').addClass('fa-map-marker');
        }

        function codeLatLng(lat, lng) {

            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results)
                    if (results[1]) {
                        //formatted address
                        //alert(results[2].formatted_address);
                        $("#add_new_post").find("#my_location_value").val(results[2].formatted_address);
                        $("#add_new_post").find("#post_text_container").append('<div class="post-location-box"><span><i class="fa fa-map-marker"></i> ارسال شده از : </span><span class="location">'+results[2].formatted_address+'</span><i id="delete_location" class="fa fa-times"></i></div>');
                        $this.find('i').removeClass('fa-spin fa-spinner').addClass('fa-map-marker');

                        //find country name
                        //for (var i=0; i<results[0].address_components.length; i++) {
                        //    for (var b=0;b<results[0].address_components[i].types.length;b++) {
                        //
                        //        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        //        if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                        //            //this is the object you are looking for
                        //            city= results[0].address_components[i];
                        //            break;
                        //        }
                        //    }
                        //}
                        //city data
                        //alert(city.short_name + " " + city.long_name)


                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        }
    });

    $("div#show-case-degrees").find("#item_list").children('li').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var container = $this.closest("#show-case-degrees");
        $.ajax({
            url : '/profile/skill/degree/preview',
            type : 'post',
            data : {id: $this.attr('data-value'),  _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.find('a').addClass('loading');
                $this.find('a').append('<i class="fa fa-spinner fa-spin" ></i>');
            },
            complete: function(){
                $this.find('a').removeClass('loading');
                $this.find('a').find('i').remove();
            },
            success: function(data){
                console.log(data)
                container.find("#license_name").html(data.title);
                container.find('.image').find('img').attr('src', $this.find('img').attr('src'));
                container.find('.image').find('.magnify-large').css('background', 'url(' + $this.find('img').attr('src') + ')');
                container.find('.image').find('.title').find('.name').html(data.title);
                container.find('.popularity').find('#view_item').attr('href', $this.find('a').attr('href') );
                container.find('.popularity').find('#like').attr('data-value', data.id );
                container.find('.popularity').find('#dislike').attr('data-value', data.id );
                container.find('#properties_list').html('');
                container.find('#properties_list').append('<p>  صادر کننده :  '+data.creator+'</p>');
                container.find('#properties_list').append('<p> تاریخ اخذ مدرک : '+data.get_date+'</p>');
                container.find('#properties_list').append('<p> مدت اعتبار : '+data.expiration_date+'</p>');
                container.find('#properties_list').append('<p>'+data.description+'</p>');

            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });

    });

    $("div#show-case-experience").find("#item_list").children('li').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var container = $this.closest("#show-case-experience");
        $.ajax({
            url : '/profile/skill/experience/preview',
            type : 'post',
            data : {id: $this.attr('data-value'),  _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.find('a').addClass('loading');
                $this.find('a').append('<i class="fa fa-spinner fa-spin" ></i>');
            },
            complete: function(){
                $this.find('a').removeClass('loading');
                $this.find('a').find('i').remove();
            },
            success: function(data){
                console.log(data)
                container.find("#license_name").html(data.title);
                if(data.file_type == 'image'){
                    container.find('.image').find('img').css({'width': '100%', 'padding': '0'});
                    container.find('.popularity').find('#view_item').html('<i class="fa fa-file-image-o"></i>  مشاهده تصویر  ' );
                }else{
                    container.find('.image').find('img').css({'width': '50%', 'padding': '20px 0'});
                    container.find('.popularity').find('#view_item').html('<i class="fa fa-download"></i>    دریافت فایل ' );
                }
                container.find('.image').find('img').attr('src', $this.find('img').attr('src'));
                container.find('.image').find('.magnify-large').css('background', 'url(' + $this.find('img').attr('src') + ')');
                container.find('.image').find('.title').find('.name').html(data.title);
                container.find('.popularity').find('#view_item').attr('href', $this.find('a').attr('href') );
                container.find('.popularity').find('#like').attr('data-value', data.id );
                container.find('.popularity').find('#like').find('#num').html(' '+data.num_like+' ');
                container.find('.popularity').find('#dislike').attr('data-value', data.id );
                container.find('.popularity').find('#dislike').find('#num').html(' '+data.num_dislike+' ');
                container.find('#properties_list').html('');
                container.find('#properties_list').append('<p>'+data.description+'</p>');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });

    });

    $("div#show-case-honor").find("#item_list").children('li').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var container = $this.closest("#show-case-honor");
        $.ajax({
            url : '/profile/skill/honor/preview',
            type : 'post',
            data : {id: $this.attr('data-value'),  _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.find('a').addClass('loading');
                $this.find('a').append('<i class="fa fa-spinner fa-spin" ></i>');
            },
            complete: function(){
                $this.find('a').removeClass('loading');
                $this.find('a').find('i').remove();
            },
            success: function(data){
                console.log(data)
                container.find("#license_name").html(data.title);
                container.find('.image').find('img').attr('src', $this.find('img').attr('src'));
                container.find('.image').find('.magnify-large').css('background', 'url(' + $this.find('img').attr('src') + ')');
                container.find('.image').find('.title').find('.name').html(data.title);
                container.find('.popularity').find('#view_item').attr('href', $this.find('a').attr('href') );
                container.find('.popularity').find('#like').attr('data-value', data.id );
                container.find('.popularity').find('#dislike').attr('data-value', data.id );
                container.find('#properties_list').html('');
                container.find('#properties_list').append('<p>'+data.description+'</p>');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });

    });

    $(".article_show").on('click', "#article_like", function(){
        var $this = $(this);
        var value_id = $this.attr('data-value');
        var article_id = $this.attr('data-article');
        $.ajax({
            url : '/profile/article/'+article_id+'/like',
            type : 'post',
            data : {article:article_id, value:value_id, _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.attr('class','');
                $this.addClass('fa fa-spin fa-spinner fa-lg');
            },
            complete: function(){
                if($this.hasClass('fa-spin')){
                    $this.removeClass('fa-spin fa-spinner').addClass('icon-heart').closest('li').removeClass('liked-heart');
                }
            },
            success: function(data){
                if(data.is_liked){
                    $this.attr('class','');
                    $this.removeClass('icon-heart').addClass('fa icon-heart-fill fa-lg liked-heart').closest('li').addClass('liked-heart');
                }
                $this.siblings("#num_like").html(data.num_like);
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    })

    $("div#show-case-experience").on('click', '#like,#dislike', function(e){
        e.preventDefault();
        var $this = $(this);
        var container = $this.closest("#show-case-experience");
        var current = $this.find('i').attr('class');
        $.ajax({
            url : '/profile/skill/experience/like',
            type : 'post',
            data : {id: $this.attr('data-value'), type:$this.attr('data-type'),  _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.find('i').attr('class', '').addClass('fa fa-spin fa-spinner');
            },
            complete: function(){
                if($this.find('i').hasClass('fa-spinner')){
                    $this.find('i').attr('class', '').addClass(current);
                }
            },
            success: function(data){
                console.log(data)
                container.find("#like").find("#num").html(' '+data.num_like+' ');
                container.find("#dislike").find("#num").html(' '+data.num_dislike+' ');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $("div#show-case-degrees").on('click', '#like,#dislike', function(e){
        e.preventDefault();
        var $this = $(this);
        var container = $this.closest("#show-case-degrees");
        var current = $this.find('i').attr('class');
        $.ajax({
            url : '/profile/skill/degree/like',
            type : 'post',
            data : {id: $this.attr('data-value'), type:$this.attr('data-type'),  _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.find('i').attr('class', '').addClass('fa fa-spin fa-spinner');
            },
            complete: function(){
                if($this.find('i').hasClass('fa-spinner')){
                    $this.find('i').attr('class', '').addClass(current);
                }
            },
            success: function(data){
                console.log(data)
                container.find("#like").find("#num").html(' '+data.num_like+' ');
                container.find("#dislike").find("#num").html(' '+data.num_dislike+' ');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $("div#show-case-honor").on('click', '#like,#dislike', function(e){
        e.preventDefault();
        var $this = $(this);
        var container = $this.closest("#show-case-honor");
        var current = $this.find('i').attr('class');
        $.ajax({
            url : '/profile/skill/honor/like',
            type : 'post',
            data : {id: $this.attr('data-value'), type:$this.attr('data-type'),  _token:$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $this.find('i').attr('class', '').addClass('fa fa-spin fa-spinner');
            },
            complete: function(){
                if($this.find('i').hasClass('fa-spinner')){
                    $this.find('i').attr('class', '').addClass(current);
                }
            },
            success: function(data){
                console.log(data)
                container.find("#like").find("#num").html(' '+data.num_like+' ');
                container.find("#dislike").find("#num").html(' '+data.num_dislike+' ');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('#skill-carousel').on('slid.bs.carousel', function () {
        var name = $('.carousel-inner').find('.active').attr('data-title');
        var index = $('.carousel-inner').find('.active').attr('data-index');
        $('.skill-carousel-nav').find('.name').find('span').html(name);
        $('ul.skill-list').find('li').removeClass('current');
        $('ul.skill-list').find('li[data-slide-to='+index+']').addClass('current');
    })

    $("button#open_recommendation").click(function(){
        var $this = $(this);
        $this.siblings('#add_recommendation_form').find('.recommendation-form').slideToggle(200);
    });

    $("#show-case .license-list li a").click(function(e){
        e.preventDefault();
        var img=$(this).find('img').attr('src');
        $("#show-case .image img").attr('src' , img );
        $("#show-case .image .magnify-large").css('background', 'url(' + img + ')');
    });

    $("ul#friendship_list, div#friendship_list").on('click', '#delete_friend', function(e){
        e.stopPropagation();
        var $this = $(this);
        var container = $this.closest("li");
        var current = $this.find('i').attr('class');
        $.ajax({
            url : '/profile/friend/unfriend',
            type : 'post',
            data : {
                friendship_id: $this.attr('data-value'),
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            dataType: 'json',
            beforeSend: function(){
                $this.find('i').attr('class', '').addClass('fa fa-spin fa-spinner');
            },
            complete: function(){
                if($this.find('i').hasClass('fa-spinner')){
                    $this.find('i').attr('class', '').addClass(current);
                }
            },
            success: function(data){
                console.log(data)
                if(data.returns.status == 1){
                    container.slideUp(200, function(){
                        container.remove();
                    })
                }
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $("ul#friendship_list, div#friendship_list").on('click', '#accept_friend', function(e){
        e.stopPropagation();
        var $this = $(this);
        var container = $this.closest("li");
        var current = $this.find('i').attr('class');
        $.ajax({
            url : '/profile/friend/accept',
            type : 'post',
            data : {
                friendship_id: $this.attr('data-value'),
                _token:$('input[name="_token"]').val()
            },
            dataType: 'json',
            beforeSend: function(){
                $this.find('i').attr('class', '').addClass('fa fa-spin fa-spinner');
            },
            complete: function(){
                if($this.find('i').hasClass('fa-spinner')){
                    $this.find('i').attr('class', '').addClass(current);
                }
            },
            success: function(data){
                console.log(data)
                if(data.returns.status == 1){
                    if(container.closest('ul').hasClass('dropdown-menu')){
                        container.slideUp(200, function(){
                            container.remove();
                            if($("#friendship_list").html().trim.length == 0){
                                $('#friends_request_nav').removeClass('open');
                            }
                        });
                    }else{
                        container.find('.label').removeClass('label-info').addClass('label-success').html('دوست');
                        $this.fadeOut(200,function(){
                            $this.remove();
                        })
                    }
                }
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('form[data-remote-multiple]').submit(function(e){
        e.preventDefault();
        var $this = $(this);
        var data = $this.serialize();
        var action = $this.attr('action');
        var method = $this.attr('method');
        if($this.find('input[name="_method"]').length>0){
            method = $this.find('input[name="_method"]').val();
        }
        console.log(method);
        var current_text = $this.find('button[type=submit]').html();
        $.ajax({
            url : action,
            type : method,
            data : data,
            dataType: 'json',
            beforeSend: function(){
                $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
            },
            complete: function(){
                if($this.find('button[type="submit"]').find('i').hasClass('fa fa-spinner fa-spin')){
                    $this.find('button[type="submit"]').html(current_text);
                }
            },
            success: function(data){
                if(data.hasCallback){
                    window[data.callback](data.returns, $this);
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
    });

    $('div[data-nicescroll]').niceScroll({
        railalign : 'left',
        cursorcolor : '#EEE',
        railpadding: {
            top: 5,
            right: 0,
            left: 0,
            bottom: 0
        }
    })

    $('a[data-post-inline-editable]').editable({
        anim: 150,
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    })

    $("#legal_address").on('keyup', 'input.new-address', function(){
        var $this = $(this);
        var num = $("#legal_address").find('input:text').filter(function() { return $(this).val() == ""; }).length;
        var total_num = $("#legal_address").find('input:text').length;
        if(num == 0 && total_num <= 4){
            $("#legal_address").append('<div class="form-group"><label for="other_address[]" class="control-label pull-right">آدرس  :</label><div class="col-sm-8"><input class="form-control new-address" placeholder="درصورتی که آدرس دیگری نیز دارید می توانید در این بخش ثبت نمایید." name="other_address[]" type="text" id="other_address"><i class="input-icon fa fa-edit"></i></div></div>');
        }

    });

    $("select#tags_list").select2({
        placeholder: "تگ های مرتبط را انتخاب نمایید.",
        tags: false
    });

    $('#parameter_table_list a[data-editable]').editable({
        url: '/profile/management/addon/poll/parameter/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    })

    $('#questionnaire_questions_list a[data-editable]').editable({
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#coupon_table_list a[data-editable]').editable({
        url: '/profile/management/addon/offer/coupon/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $("#coupon_table_list").on('click', 'button#delete_coupon', function(e){
        e.preventDefault();
        var $this=$(this);
        var pk = $this.attr('data-value');
        $.ajax({
            data: {
                id:pk,
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            type: "post",
            url: '/profile/management/offer/coupon',
            beforeSend: function () {
                $this.find('p').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
            },
            complete: function () {
                $this.find('p').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
            },
            success: function (data) {
                console.log(data)
                $this.closest('tr').remove();
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    });


    $("#questionnaire_questions_list").on('click', 'a#delete_question', function(e){
        e.preventDefault();
        var $this=$(this);
        var pk = $this.attr('data-value');
        $.ajax({
            data: {
                id:pk,
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            type: "post",
            url: '/profile/management/addon/questionnaire/question/delete',
            beforeSend: function () {
                $this.find('i').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
            },
            complete: function () {
                $this.find('i').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
            },
            success: function (data) {
                console.log(data)
                $this.closest('li').slideUp(300, function(){
                    $this.closest('li').remove();
                })
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    });

    $("select#attribute_group_id").change(function(){
        var $this = $(this);
        var type = $this.find(':selected').data('type');
        $('input[name="value"]').attr('type', type);
    });

    $("#attribute_table_list").on('click', 'button#delete_attribute', function(e){
        e.preventDefault();
        var $this=$(this);
        var pk = $this.attr('data-value');
        $.ajax({
            data: {
                id:pk,
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            type: "post",
            url: '/profile/management/addon/shop/product/attribute/delete',
            beforeSend: function () {
                $this.find('p').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
            },
            complete: function () {
                $this.find('p').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
            },
            success: function (data) {
                console.log(data)
                $this.closest('tr').remove();
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    })

    $("#product_image_table_list").on('click', 'button#delete_product_image', function(e){
        e.preventDefault();
        var $this=$(this);
        var pk = $this.attr('data-value');
        $.ajax({
            data: {
                id:pk,
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            type: "post",
            url: '/profile/management/addon/shop/product/image/delete',
            beforeSend: function () {
                $this.find('p').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
            },
            complete: function () {
                $this.find('p').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
            },
            success: function (data) {
                console.log(data)
                $this.closest('tr').remove();
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    })

    $("#shop_banner_table_list").on('click', 'button#delete_shop_banner', function(e){
        e.preventDefault();
        var $this=$(this);
        var pk = $this.attr('data-value');
        $.ajax({
            data: {
                id:pk,
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            type: "post",
            url: '/profile/management/addon/shop/images/delete',
            beforeSend: function () {
                $this.find('p').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
            },
            complete: function () {
                $this.find('p').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
            },
            success: function (data) {
                console.log(data)
                $this.closest('tr').remove();
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    })

    $("#commercial_table_list").on('click', 'button#delete_commercial', function(e){
        e.preventDefault();
        var $this=$(this);
        var pk = $this.attr('data-value');
        $.ajax({
            data: {
                id:pk,
                _token:$('input[name="_token"]').val(),
                _method: 'delete'
            },
            type: "post",
            url: '/profile/management/addon/shop/commercial/delete',
            beforeSend: function () {
                $this.find('p').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
            },
            complete: function () {
                $this.find('p').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
            },
            success: function (data) {
                console.log(data)
                $this.closest('tr').remove();
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
    })

    $('form#store_poll_form').find('input').change(function(){
        var form = $('form#store_poll_form');
        $.ajax({
            url : '/store/poll/price',
            type : 'post',
            data : form.serialize(),
            dataType: 'json',
            beforeSend: function(){},
            complete: function(){},
            success: function(data){
                form.find('#final_amount').html(numberWithCommas(data.final_amount)+' تومان ');
                form.find('#base_amount').html(numberWithCommas(data.base_amount)+' تومان ');
                form.find('#discount_amount').html(numberWithCommas(data.discount_amount));
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('form#store_storage_form').find('input').change(function(){
        var form = $('form#store_storage_form');
        $.ajax({
            url : '/store/storage/price',
            type : 'post',
            data : form.serialize(),
            dataType: 'json',
            beforeSend: function(){},
            complete: function(){},
            success: function(data){
                form.find('#final_amount').html(numberWithCommas(data.final_amount)+' تومان ');
                form.find('#base_amount').html(numberWithCommas(data.base_amount)+' تومان ');
                form.find('#discount_amount').html(numberWithCommas(data.discount_amount));
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('form#store_questionnaire_form').find('input').change(function(){
        var form = $('form#store_questionnaire_form');
        $.ajax({
            url : '/store/questionnaire/price',
            type : 'post',
            data : form.serialize(),
            dataType: 'json',
            beforeSend: function(){},
            complete: function(){},
            success: function(data){
                form.find('#final_amount').html(numberWithCommas(data.final_amount)+' تومان ');
                form.find('#base_amount').html(numberWithCommas(data.base_amount)+' تومان ');
                form.find('#discount_amount').html(numberWithCommas(data.discount_amount));
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('form#store_advertise_form').find('input').change(function(){
        var form = $('form#store_advertise_form');
        $.ajax({
            url : '/store/advertise/price',
            type : 'post',
            data : form.serialize(),
            dataType: 'json',
            beforeSend: function(){},
            complete: function(){},
            success: function(data){
                form.find('#final_amount').html(numberWithCommas(data.final_amount)+' تومان ');
                form.find('#base_amount').html(numberWithCommas(data.base_amount)+' تومان ');
                form.find('#discount_amount').html(numberWithCommas(data.discount_amount));
                if(data.availability == 0){
                    $("#advertise_availability").html('این افزونه برای این مدت توسط سایر کاربران رزرو شده است.').slideDown(300, function(){
                        $("button#buy_advertise").attr('disabled','disabled')
                    });
                }else{
                    $("#advertise_availability").slideUp(300, function(){
                        $("#advertise_availability").html();
                        $("button#buy_advertise").removeAttr('disabled')
                    });
                }
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('.other-image').find('li').find('img').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var src = $this.attr('src');
        $this.closest('.other-image').siblings('.image').find('img').attr('src', src);
    });

    $('section.special-offer').hover(function(){
        $('#carousel-special_offer').carousel('pause');
    }, function(){
        $('#carousel-special_offer').carousel('cycle');
    })

    $('#carousel-special_offer').on('slide.bs.carousel', function () {
        var container = $('#carousel-special_offer');
        var info_container = container.closest('.shop-banner').siblings('.shop-info-container');
        info_container.find('.shop-info').find('.content.active').removeClass('active').fadeOut(300);
    })

    $('#carousel-special_offer').on('slid.bs.carousel', function () {
        var container = $('#carousel-special_offer');
        var key = container.find('.item.active').attr('data-key');
        var info_container = container.closest('.shop-banner').siblings('.shop-info-container');
        info_container.find('.shop-info').find('.content[data-related-slide='+key+']').addClass('active').fadeIn(200);
    })

    $('button#show_offer_coupons').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var key = $this.closest('.content').attr('data-related-slide');
        $('#carousel-special_offer').find('.item[data-key='+key+']').find('.carousel-caption').fadeToggle(300);
    })

    /**
     * Created By Dara on 17/11/2015
     * filling the sub category for skill select box
     */
    $('select#main_category_id').change(function(){
        if($(this).val()!=0){
            $.ajax({
                type: 'get',
                url: "/api/category/sub/",
                data: {category_id: $(this).val()},
                dataType: 'json',
                success: function(data){
                    var $select = $("select#sub_category_id");
                    $select.html('');
                    var $default=$("<option/>").attr('value',0).text('اهمیتی ندارد');
                    $(data).each(function (key, value) {
                        var $option = $("<option/>").attr("value", value.id).text(value.name);
                        $select.append($option);
                    });
                    $select.append($default);
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        }else{
            var $select = $("select#sub_category_id");
            $select.html('');
            var $default=$("<option/>").attr('value',0).text('اهمیتی ندارد');
            $select.append($default);
        }

    });


});

//--------------------------------------
// Ajax Initial Setup
//--------------------------------------
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//--------------------------------------
// Plug-Ins
//--------------------------------------

// Delete education plug-in
(function($) {
    $.fn.deleteEduction = function(e) {
        e.preventDefault();
        var $this = $(this);
        var current_text = $this.find('button[type=submit]').html();
        $.ajax({
            type: 'get',
            url: "profile/education/delete",
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function(){
                $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
            },
            complete: function(){
                $this.find('button[type="submit"]').html(current_text);
            },
            success: function(data){
                delete_education(data);
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    };
}(jQuery));

// Inline blocks Editor Plug-in
(function($) {

    $.fn.inlineEditor = function() {
        var $this = $(this);
        $this.find('[data-role="edit"]').click(goToEdit);
        $this.find('[data-role="return"]').click(goToPreview);

        function goToEdit(){
            $this.find('[data-role="preview"]').fadeOut(300, function(){
                $this.find('[data-role="editor"]').fadeIn(300);
            })
        }
        function goToPreview(){
            $this.find('[data-role="editor"]').fadeOut(300, function(){
                $this.find('[data-role="preview"]').fadeIn(300);
            })
        }
    }

}(jQuery));



//--------------------------------------
// CallBack Functions
//--------------------------------------

function user_info(info){
    var container = $("#user_info_form");
    console.log(info);
    container.find('span[data-get="first_name"]').html(info.user.first_name);
    container.find('span[data-get="last_name"]').html(info.user.last_name);
    container.find('span[data-get="company"]').html(info.user.company);
    container.find('span[data-get="phone1"]').html(info.phone1);
    container.find('span[data-get="phone2"]').html(info.phone2);
    container.find('span[data-get="fax"]').html(info.fax);
    container.find('span[data-get="cell_phone"]').html(info.cell_phone);
    container.find('span[data-get="address"]').html(info.address);
    container.find('span[data-get="province"]').html(info.province);
    container.find('span[data-get="city"]').html(info.city);
    if(info.other_address){
        container.find('#legal_other_address').html('');
        $.each(info.other_address, function(key, value){
            if(value != ''){
                container.find('#legal_other_address').prepend('<div class="form-group"><label class="control-label pull-right"> آدرس : </label><div class="col-sm-8"><span class="form-control-static">'+value+'</span></div></div>');
            }
        });
    }

}

function user_educations(info){
    console.log(info);
    $('#education_table_preview').find('tbody').html('');
    $('#education_table_edit').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr data-education="'+info[i].id+'" />');
        tr.append("<td>" + info[i].degree_name + "</td>");
        tr.append("<td>" + info[i].field + "</td>");
        tr.append("<td>" + info[i].status_name + "</td>");
        tr.append("<td>" + info[i].university.name + "<img src='/img/icons/universities/"+info[i].university.logo+"'></td>");
        tr.append("<td>" + info[i].entrance_year + "</td>");
        tr.append("<td>" + info[i].graduate_year + "</td>");
        $('#education_table_preview').find('tbody').append(tr);
    }

    for (var i = 0; i < info.length; i++) {
        tr = $('<tr data-education="'+info[i].id+'" />');
        tr.append("<td>" + info[i].degree_name + "</td>");
        tr.append("<td>" + info[i].field + "</td>");
        tr.append("<td>" + info[i].status_name + "</td>");
        tr.append("<td>" + info[i].university.name + "</td>");
        tr.append("<td>" + info[i].entrance_year + "</td>");
        tr.append("<td>" + info[i].graduate_year + "</td>");
        tr.append("<td><form><input type='hidden' name='education_id' value='"+info[i].id+"' ><button type='submit' class=' btn btn-danger btn-xs' ><i class='fa fa-trash-o fa-lg' ></i></button></form></td>");
        $('#education_table_edit').find('tbody').append(tr);
    }
}

function delete_education(data){
    console.log('deleted');
    $("#education_table_edit").find('tr[data-education="'+data+'"]').remove();
    $("#education_table_preview").find('tr[data-education="'+data+'"]').remove();
}

var edit = function() {
    var $summernote = $('.summernote');
    if($summernote.attr('data-status') === 'preview'){
        $('.summernote').summernote({
            focus: true,
            height: 230,
            direction: 'rtl',
            lang: 'fa-IR',
            toolbar: [
                //[groupname, [button list]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['color', ['color']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen']],
                ['help', ['help']]
            ],
            onImageUpload: function(files) {
                sendFile(files[0]);
            }
        });
        $("#biography-save-btn").show();
        $("#biography-cancel").show();
        $('.panel-body.biopraphy').find('.attachment').show();
        $("#biography-toggle").html('<i class="fa fa-save"></i> ذخیره تغییرات');
        $summernote.attr('data-status','edit');
    }else if($summernote.attr('data-status') === 'edit'){
        var aHTML = $('.summernote').code(); //save HTML If you need(aHTML: array).
        $.ajax({
            url : 'profile/biography',
            type : 'post',
            data : {'text': aHTML, '_token':$('input[name="_token"]').val() },
            dataType: 'json',
            beforeSend: function(){
                $("#biography-toggle").find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
            },
            complete: function(){
                $("#biography-toggle").html('<i class="fa fa-pencil"></i> ویرایش بیوگرافی ');
            },
            success: function(data){
                console.log(data);
                $('.summernote').destroy();
                $("#biography-save-btn").hide();
                $("#biography-cancel").hide();
                $(".panel-body.biopraphy").find('.attachment').hide();
                $("#biography-toggle").html('<i class="fa fa-pencil"></i> ویرایش بیوگرافی ');
                $summernote.attr('data-status','preview');
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }

};

var cancel_edit = function(){
    var $summernote = $('.summernote');
    $.ajax({
        url : 'profile/biography/preview',
        type : 'post',
        data : { '_token':$('input[name="_token"]').val() },
        dataType: 'json',
        beforeSend: function(){
            $("#biography-cancel").find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
        },
        complete: function(){
            $("#biography-cancel").html('<i class="fa fa-times"></i> انصراف و عدم ذخیره  ');
        },
        success: function(data){
            console.log(data);
            $summernote.destroy();
            $("#biography-save-btn").hide();
            $("#biography-cancel").hide();
            $(".panel-body.biopraphy").find('.attachment').hide();
            $("#biography-cancel").html('<i class="fa fa-times"></i> انصراف و عدم ذخیره  ');
            $("#biography-toggle").html('<i class="fa fa-pencil"></i> ویرایش بیوگرافی ');
            $summernote.attr('data-status','preview');
            $summernote.html(data.biography);
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function sendFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
    data.append("_token", $('input[name="_token"]').val());
    $.ajax({
        data: data,
        type: "POST",
        url: '/files/uploader',
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            $('.summernote').summernote('editor.insertImage', url);
        }
    });
}

function sendArticleFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
    data.append("_token", $('input[name="_token"]').val());
    data.append("article", $('input#article_id').val());
    $.ajax({
        data: data,
        type: "POST",
        url: '/files/article/uploader',
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            $('.article_summernote').summernote('editor.insertImage', url);
        }
    });
}

function sendTextareaFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
    data.append("_token", $('input[name="_token"]').val());
    $.ajax({
        data: data,
        type: 'post',
        url: '/profile/management/addon/shop/summernote/image',
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            $('.textarea_summernote').summernote('editor.insertImage', url);
        }
    });
}

function uploadAttachment(data) {
    $.ajax({
        data: data,
        type: "post",
        url: '/files/attachment',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $(".biopraphy").find('.attachment').find('button').html('<i class="fa fa-spin fa-spinner"></i> درحال آپلود ...');
        },
        complete: function(){
            $(".biopraphy").find('.attachment').find('button').html('<i class="fa fa-plus"></i> افزودن ضمیمه');
        },
        success: function(data) {
            console.log(data);
            if(data.hasMsg){
                notify_create(data);
            }else{
                $(".biopraphy").find('.attachments-list').html('');
                var li;
                $(".biopraphy").find('.attachments-list').append("<ul>");
                for (var i = 0; i < data.length; i++) {
                    li = $('<li><b id="delete_attachment" data-value="'+data[i].id+'" class="fa fa-times-circle" ></b><a target="_blank" href="/img/files/'+data[i].name+'" >'+data[i].real_name+'</a><i class="fa fa-paperclip" ></i></li>');
                    $(".biopraphy").find('.attachments-list').find('ul').append(li);
                }
            }
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function deleteAttachment($this){
    $.ajax({
        data: {
            attachment:$this.attr('data-value'),
            _token:$('input[name="_token"]').val(),
            _method: 'delete'
        },
        type: "post",
        url: '/files/attachment',
        beforeSend: function () {
            $this.removeClass('fa-times-circle').addClass('fa-spinner fa-spin');
        },
        complete: function () {
            $this.removeClass('fa-spinner fa-spin').addClass('fa-times-circle');
        },
        success: function (data) {
            console.log(data)
            $this.closest('li').remove();
            if($(".biopraphy").find('.attachments-list').find('ul').html() == 0){
                $(".biopraphy").find('.attachments-list').find('ul').remove();
            }
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    })
}

function uploadArticleAttachment(data) {
    $.ajax({
        data: data,
        type: "post",
        url: '/files/article',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            $(".biopraphy.article").find('.attachment').find('button').html('<i class="fa fa-spin fa-spinner"></i> درحال آپلود ...');
        },
        complete: function(){
            $(".biopraphy.article").find('.attachment').find('button').html('<i class="fa fa-plus"></i> افزودن ضمیمه');
        },
        success: function(data) {
            console.log(data);
            if(data.hasMsg){
                notify_create(data);
            }else{
                $(".biopraphy.article").find('.attachments-list').html('');
                var li;
                $(".biopraphy.article").find('.attachments-list').append("<ul>");
                for (var i = 0; i < data.length; i++) {
                    li = $('<li><b id="delete_attachment" data-value="'+data[i].id+'" class="fa fa-times-circle" ></b><a target="_blank" href="/img/files/'+data[i].name+'" >'+data[i].real_name+'</a><i class="fa fa-paperclip" ></i></li>');
                    $(".biopraphy.article").find('.attachments-list').find('ul').append(li);
                }
            }
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function deleteArticleAttachment($this){
    $.ajax({
        data: {
            attachment:$this.attr('data-value'),
            _token:$('input[name="_token"]').val(),
            _method: 'delete'
        },
        type: "post",
        url: '/files/articleAttachment',
        beforeSend: function () {
            $this.removeClass('fa-times-circle').addClass('fa-spinner fa-spin');
        },
        complete: function () {
            $this.removeClass('fa-spinner fa-spin').addClass('fa-times-circle');
        },
        success: function (data) {
            console.log(data)
            $this.closest('li').remove();
            if($(".biopraphy.article").find('.attachments-list').find('ul').html() == 0){
                $(".biopraphy.article").find('.attachments-list').find('ul').remove();
            }
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    })
}

function friendRequest(data){
    console.log(data)
    if(data.status == 2){
        $("#friending").find('button').html('<i class="fa fa-hand-peace-o"></i> منتظر تایید دوستی ');
    }
}

function post_comment(data, form){
    var $this = form;
    $this.closest('ul#post_comments_list').find('.list').prepend(data.new_comment);
    $this.closest('ul#post_comments_list').find('.list').scrollTop( 0 );
    $this.find('input[name="body"]').val('');
    if(data.num_comments > 0){
        $this.closest('ul#post_comments_list').siblings('.view-all-comments').html('<a href="#" class="pull-right"><i class="fa fa-comments-o"></i></a> '+data.num_comments+' دیدگاه ')
    }else{
        $this.closest('ul#post_comments_list').siblings('.view-all-comments').html('<a href="#" class="pull-right"><i class="fa fa-comments-o"></i></a>  اولین نفری باشد که دیدگاهتان را ثبت می کنید. ')
    }


}

function post_comment_delete(data, form){
    var $this = form;
    if(data.num_comments > 0){
        $this.closest('ul#post_comments_list').siblings('.view-all-comments').html('<a href="#" class="pull-right"><i class="fa fa-comments-o"></i></a> '+data.num_comments+' دیدگاه ')
    }else{
        $this.closest('ul#post_comments_list').siblings('.view-all-comments').html('<a href="#" class="pull-right"><i class="fa fa-comments-o"></i></a>  اولین نفری باشد که دیدگاهتان را ثبت می کنید. ')
    }
    $this.closest('li.media').slideUp(300, function(){
        $this.closest('li.media').remove();
    });
}

function notify_create(data){
    if(data.hasMsg){
        var type = 'success';
        if(data.msgType){
            type = data.msgType;
        }
        $.notify(data.msg, {type:type});
    }
}


function poll_parameter_add(info){
    $('#parameter_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td><a href="#" data-editable id="name" data-type="text" data-pk="' + info[i].id + '">' + info[i].name + '</a></td>');
        tr.append('<td width="5%" ><button id="delete_parameter" data-value="' + info[i].id + '" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#parameter_table_list').find('tbody').append(tr);
    }
    $('#parameter_table_list').siblings('form').find('input[name="name"]').val('');

    $('#parameter_table_list a[data-editable]').editable({
        url: '/profile/management/addon/poll/parameter/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    })
}

$('#parameter_table_list').on('click', 'button#delete_parameter', function(e){
    e.preventDefault();
    var $this=$(this);
    var pk = $this.attr('data-value');
    $.ajax({
        data: {
            id:pk,
            _token:$('input[name="_token"]').val(),
            _method: 'delete'
        },
        type: "post",
        url: '/profile/management/addon/poll/parameter/delete',
        beforeSend: function () {
            $this.find('p').removeClass('fa-trash-o').addClass('fa-spinner fa-spin');
        },
        complete: function () {
            $this.find('p').removeClass('fa-spinner fa-spin').addClass('fa-trash-o');
        },
        success: function (data) {
            console.log(data)
            $this.closest('tr').remove();
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    })
})

function poll_voted(data, container){
    var parameters = data.parameters;
    var total_votes = data.total_votes;
    $.each(parameters, function(key, value){
        var content = container.find("#parameter_"+value.id);
        var progress = content.find('.progress');
        var value = (value.num_vote*100/total_votes).toFixed(2);
        progress.find('.progress-bar').attr('aria-valuenow', value).css('width',value+'%').html(value+'%');
    });
}

function questionnaire_question_added(info){
    var ul = $('<ul />')
    $.each(info, function(key, value){
        var li = $('<li/>').appendTo(ul);
        li.append('<div class="numbering">'+(key+1)+'</div>');
        var aaa = $('<a/>').text(value.title).attr('id','title').attr('href','#').attr('data-type','text').attr('data-editable','').attr('data-pk',value.id).appendTo(li);
        var aaaa = li.append('<a id="delete_question" data-value="'+value.id+'" class="delete-question pull-left" href="#"><i class="fa fa-trash-o" ></i></a>');

        sub_ul = $('<ul />');
            $.each(value.options, function(skey, svalue){
                var sub_li = $('<li/>').appendTo(sub_ul);
                sub_li.append('<i class="fa fa-circle-o" ></i>');
                var sub_aaa = $('<a/>').text(svalue.name).attr('id','name').attr('href','#').attr('data-type','text').attr('data-editable','').attr('data-pk',svalue.id).appendTo(sub_li);
            });
            sub_ul.appendTo(li);
    });
    $("#questionnaire_questions_list").html(ul);

    $('#questionnaire_questions_list a[data-editable]').editable({
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    })
}

/*Created By Dara on 22/10/2015
 add coupon callback function*/
function service_coupon(info){
    $('#coupon_table_list').find('tbody').html('');
    var tr;

    for(i=0;i<info.length;i++){
        tr=$('<tr>');
        tr.append('<td width="30%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="50%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        tr.append('<td width="50%" ><a href="#" id="service" data-type="text" data-pk="'+info[i].id+'">'+info[i].coupon_gallery.title+'</a></td>');
        tr.append('<td width="15%" ><a href="#" data-editable id="num" data-type="text" data-pk="'+info[i].id+'">'+info[i].num+'</a></td>');
        tr.append('<td width="5%" ><button id="delete_coupon" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#coupon_table_list').find('tbody').append(tr);
    }
    $('#coupon_table_list a[data-editable]').editable({
        url: '/profile/management/addon/offer/coupon/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function product_attribute_add(info){
    $('#attribute_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td  width="15%" >'+info[i].attribute_group.name+'</td>');
        if(info[i].attribute_group.type == 'color'){
            tr.append('<td  width="15%" ><div style="background: '+ info[i].value +'; width: 40%">&emsp;</div></td>');
        }else{
            tr.append('<td  width="15%" >'+info[i].value+'</td>');
        }
        tr.append('<td  width="15%" >'+info[i].add_price+'</td>');
        tr.append('<td width="5%" ><button id="delete_attribute" data-value="' + info[i].id + '" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#attribute_table_list').find('tbody').append(tr);
    }
    $('#attribute_table_list').siblings('form').find('input[name="name"]').val('');
    $('#attribute_table_list').siblings('form').find('input[name="add_price"]').val('');
    $('#attribute_table_list').siblings('form').find('input[name="value"]').val('');
}
function skill_endorsed(data, container){
    var ul = $('<ul />')
    $.each(data, function(key, value){
        ul.append('<li><img data-toggle="tooltip" data-placement="bottom" title="'+value.user.username+'" src="/img/persons/'+value.user.avatar+'" class="img-circle"  ></li>')
    });
    container.closest('.timeline-block').find('#endorse_persons').html(ul);
    $('[data-toggle="tooltip"]').tooltip()
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/**
 *Created By Dara on 3/11/2015
 *confirm problem answer callback
 **/
function problem_confirm_answer(data,form){
    if(data.status=='done'){
        form.closest('ul.comments').find('button.confirm-answer').removeClass('btn-success');
        form.find('button').addClass('btn-success');
    }
    if(data.status=='undo'){
        form.find('button').removeClass('btn-success');
    }

}


/**
 * Created By Dara on 4/11/2015
 * handling the join an leave in the group
 */
function group_join(data){
    if(data.status=='done'){ //the user successfully joined the group
        $("span.join-group").hide();
        $("span.leave-group").show();
    }
    if(data.status=='undo'){ //the user successfully left the group
        $("span.leave-group").hide();
        $("span.join-group").show();
    }
}

/**
 * Created By Dara on 5/11/2015
 * handling action after the coupon sold
 */
function coupon_sold(data,form){
    if(data.status=='done'){ //the coupon has been successfully paid
        var stat=form.closest('tr').children('td.status').find('span');
        stat.removeClass('label-danger').addClass('label-success');
        stat.html('تسویه شده');
        form.closest('td').html(data.date);

    }
}

function problem_attachment(data){
        li = $('<li><b id="delete_problem_attachment" data-name="'+data.name+'::'+data.real_name+'::'+data.size+'" data-value="'+data.id+'" class="fa fa-times-circle" ></b><a target="_blank" href="/img/files/'+data.name+'" >'+data.real_name+'</a><i class="fa fa-paperclip" ></i></li>');
        $("#problem_text_container").find('.attachments-list').find('ul').append(li);
        $("#images_list").append('<input type="hidden" name="attachment[]" value="'+data.name+'::'+data.real_name+'::'+data.size+'">')
}

function deleteProblemAttachment($this){
    var name = $this.attr('data-name');
    $("#images_list").find('input[value="'+name+'"]').remove();
    $this.closest('li').remove();
}



