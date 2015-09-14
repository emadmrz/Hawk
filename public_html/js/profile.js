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
                $this.find('button[type="submit"]').html(current_text);
            },
            success: function(data){
                if(data.hasCallback){
                    window[data.callback](data.returns);
                }
                if(data.hasMsg){
                    $.notify(data.msg, {type:'success'});
                }
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('[data-delete-confirm]').click(function(){
        if(!confirm( $(this).attr('data-delete-message') )){
            return false;
        }
    })

    $('select#province_id').change(function(){
        $.ajax({
            type: 'get',
            url: "/api/location/cities/",
            data: {province_id: $(this).val()},
            dataType: 'json',
            success: function(data){
                var $select = $("select#city_id");
                $select.html('');
                $(data).each(function (key, value) {
                    var $option = $("<option/>").attr("value", value.id).text(value.name);
                    $select.append($option);
                });
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
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

    $('input#article_banner').change(function(){
        $this = $(this);
        var file_data = $this.prop("files")[0];
        var form_data = new FormData();
        form_data.append("image", file_data);
        form_data.append("_token", $('input[name="_token"]').val());
        $.ajax({
            url: "/profile/article/"+$('input#article_id').val()+"/banner",
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
                $("#article_image_banner").attr('href',data).fadeIn(200);
                $this.val('');
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
                $("#add_new_post").find('#post_banner').html('<img class="img-rounded" src="'+data+'" >');
                $("#add_new_post").find('#post_banner').addClass('has-banner');
                $("#add_new_post").find('#post_text_container').addClass('has-banner');
                $("#add_new_post").find('#post_image_value').val(data);
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        })
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
                        $("#add_new_post").find("#post_text_container").append('<div class="post-location-box"><span><i class="fa fa-map-marker"></i> ارسال شده از : </span><span class="location">'+results[2].formatted_address+'</span></div>');
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
        tr.append("<td>" + info[i].university.name + "</td>");
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
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['color', ['color']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
            onImageUpload: function(files) {
                sendFile(files[0]);
            }
        });
        $("#biography-save-btn").show();
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
            $(".biopraphy").find('.attachments-list').html('');
            var li;
            $(".biopraphy").find('.attachments-list').append("<ul>");
            for (var i = 0; i < data.length; i++) {
                li = $('<li><b id="delete_attachment" data-value="'+data[i].id+'" class="fa fa-times-circle" ></b><a target="_blank" href="/img/files/'+data[i].name+'" >'+data[i].real_name+'</a><i class="fa fa-paperclip" ></i></li>');
                $(".biopraphy").find('.attachments-list').find('ul').append(li);
            }
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function deleteAttachment($this){
    $.ajax({
        data: {attachment:$this.attr('data-value'), _token:$('input[name="_token"]').val() },
        type: "delete",
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
            $(".biopraphy.article").find('.attachments-list').html('');
            var li;
            $(".biopraphy.article").find('.attachments-list').append("<ul>");
            for (var i = 0; i < data.length; i++) {
                li = $('<li><b id="delete_attachment" data-value="'+data[i].id+'" class="fa fa-times-circle" ></b><a target="_blank" href="/img/files/'+data[i].name+'" >'+data[i].real_name+'</a><i class="fa fa-paperclip" ></i></li>');
                $(".biopraphy.article").find('.attachments-list').find('ul').append(li);
            }
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function deleteArticleAttachment($this){
    $.ajax({
        data: {attachment:$this.attr('data-value'), _token:$('input[name="_token"]').val() },
        type: "delete",
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




