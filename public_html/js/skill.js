/**
 * Created by emad on 16/09/2015.
 */
$(document).ready(function(){

    $("#select_tags").select2({
        placeholder: "تگ های مرتبط به مهارت خود را انتخاب نمایید.",
        tags: true
    });

    var select_category_id=$('select#category_id')
    var category_id=select_category_id.children('option');
    $.each(category_id,function(index,value){
        if(index==0){
            $(this).attr('disabled',true);
        }
    });

    $('select#category_id').change(function(){
        $.ajax({
            type: 'get',
            url: "/api/category/sub/",
            data: {category_id: $(this).val()},
            dataType: 'json',
            success: function(data){
                var $select = $("select#sub_category_id");
                $select.html('');
                $(data).each(function (key, value) {
                    if(value.id==0){
                        var $option=$("<option/>").attr({value:value.id,disabled:true,selected:true}).text(value.name);
                    }else{
                        var $option = $("<option/>").attr("value", value.id).text(value.name);
                    }

                    $select.append($option);
                });
            },
            error: function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

    $('select#sub_category_id').change(function(){
        $.ajax({
            type: 'get',
            url: "/api/category/tags/",
            data: {sub_category_id: $(this).val()},
            dataType: 'json',
            success: function(data){
                var $select = $("select#select_tags");
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

    $("#experience_table_list").on('click', 'button#delete_experience', function(e){
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
            url: '/profile/skill/experience',
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

    $("#degree_table_list").on('click', 'button#delete_degree', function(e){
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
            url: '/profile/skill/degree',
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

    $("#honor_table_list").on('click', 'button#delete_honor', function(e){
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
            url: '/profile/skill/honor',
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

    $("#history_table_list").on('click', 'button#delete_history', function(e){
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
            url: '/profile/skill/history',
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

    $("#schedule_table_list").on('click', 'button#delete_schedule', function(e){
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
            url: '/profile/skill/schedule',
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

    $("#paper_table_list").on('click', 'button#delete_paper', function(e){
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
            url: '/profile/skill/paper',
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

    $("#amount_table_list").on('click', 'button#delete_amount', function(e){
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
            url: '/profile/skill/amount',
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

    $("#area_table_list").on('click', 'button#delete_area', function(e){
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
            url: '/profile/skill/area',
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

    $("#gallery_table_list").on('click', 'button#delete_gallery', function(e){
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
            url: '/profile/skill/gallery',
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

    $("#service_table_list").on('click', 'button#delete_service', function(e){
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
            url: '/profile/skill/service',
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


    $('#experience_table_list a[data-editable]').editable({
        url: '/profile/skill/experience/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#degree_table_list a[data-editable]').editable({
        url: '/profile/skill/degree/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#honor_table_list a[data-editable]').editable({
        url: '/profile/skill/honor/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    })

    $('#history_table_list a[data-editable]').editable({
        url: '/profile/skill/history/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#schedule_table_list a[data-editable]').editable({
        url: '/profile/skill/schedule/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#paper_table_list a[data-editable]').editable({
        url: '/profile/skill/paper/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#amount_table_list a[data-editable]').editable({
        url: '/profile/skill/amount/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#area_table_list a[data-editable]').editable({
        url: '/profile/skill/area/change',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#gallery_table_list a[data-editable]').editable({
        url: '/profile/skill/gallery/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $('#service_table_list a[data-editable]').editable({
        url: '/profile/skill/service/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

    $("#pricing_type").change(function(){
        var $this = $(this);
        var value = $this.val() ;
        if(value == 1){
            $('#pricing_properties').slideDown(200);
        }else{
            $('#pricing_properties').slideUp(200);
        }
    })

    $("#add_service_form").find("#title").change(function(){
        if($(this).val()== 0){
           $("#manual_service").slideDown(300);
        }else{
            $("#manual_service").slideUp(300);
        }
    })


});

function skill_experiences(info){
    $('#experience_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="30%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="50%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        tr.append("<td width='15%' ><a href='/img/files/"+info[i].files[0].name+"' target='_blank' ><button class='btn btn-default btn-sm'><i class='fa fa-file-image-o fa-lg' ></i> مشاهده فایل </button></a></td>");
        tr.append('<td width="5%" ><button id="delete_experience" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#experience_table_list').find('tbody').append(tr);
        console.log(info[i].files[0])
    }

    $('#experience_table_list a[data-editable]').editable({
        url: '/profile/skill/experience/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_degrees(info){
    $('#degree_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="30%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="30%" ><a href="#" data-editable id="creator " data-type="text" data-pk="'+info[i].id+'">' + info[i].creator  + '</a></td>');
        tr.append('<td width="30%" ><a href="#" data-editable id="get_date" data-type="text" data-pk="'+info[i].id+'">' + info[i].get_date + '</a></td>');
        tr.append('<td width="30%" ><a href="#" data-editable id="expiration_date" data-type="text" data-pk="'+info[i].id+'">' + info[i].expiration_date + '</a></td>');
        //tr.append('<td width="50%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        tr.append("<td width='15%' ><a href='/img/files/"+info[i].files[0].name+"' target='_blank' ><button class='btn btn-default btn-sm'><i class='fa fa-file-image-o fa-lg' ></i> مشاهده تصویر </button></a></td>");
        tr.append('<td width="5%" ><button id="delete_degree" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#degree_table_list').find('tbody').append(tr);
        console.log(info[i].files[0])
    }

    $('#degree_table_list a[data-editable]').editable({
        url: '/profile/skill/degree/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_honors(info){
    $('#honor_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="25%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="50%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        tr.append("<td width='15%' ><a href='/img/files/"+info[i].files[0].name+"' target='_blank' ><button class='btn btn-default btn-sm'><i class='fa fa-file-image-o fa-lg' ></i> مشاهده تصویر </button></a></td>");
        tr.append('<td width="5%" ><button id="delete_honor" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#honor_table_list').find('tbody').append(tr);
        console.log(info[i].files[0])
    }

    $('#honor_table_list a[data-editable]').editable({
        url: '/profile/skill/honor/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_histories(info){
    $('#history_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="20%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="10%" ><a href="#" data-editable id="start_year" data-type="text" data-pk="'+info[i].id+'">' + info[i].start_year + '</a></td>');
        tr.append('<td width="10%" ><a href="#" data-editable id="end_year" data-type="text" data-pk="'+info[i].id+'">' + info[i].end_year + '</a></td>');
        tr.append('<td width="40%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        if(info[i].files.length){
            tr.append("<td width='15%' ><a href='/img/files/"+info[i].files[0].name+"' target='_blank' ><button class='btn btn-default btn-sm'><i class='fa fa-file-image-o fa-lg' ></i> مشاهده تصویر </button></a></td>");
        }else{
            tr.append("<td width='15%' ></td>");
        }
        tr.append('<td width="5%" ><button id="delete_history" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#history_table_list').find('tbody').append(tr);
        console.log(info[i].files[0])
    }

    $('#history_table_list a[data-editable]').editable({
        url: '/profile/skill/history/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_schedules(info){
    $('#schedule_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="35%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="25%" >' + info[i].day_name + '</td>');
        tr.append('<td width="20%" >' + info[i].start_time + '</td>');
        tr.append('<td width="20%" >' + info[i].end_time + '</td>');
        tr.append('<td width="5%" ><button id="delete_schedule" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#schedule_table_list').find('tbody').append(tr);
    }

    $('#schedule_table_list a[data-editable]').editable({
        url: '/profile/skill/schedule/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_papers(info){
    $('#paper_table_list').find('tbody').html('');
    var tr;
    console.log(info)
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="40%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="15%" >' + info[i].type_name + '</td>');
        tr.append('<td width="15%" ><a href="#" data-editable id="publish_year" data-type="number" data-pk="'+info[i].id+'">' + info[i].publish_year + '</a></td>');
        tr.append('<td width="25%" ><a href="#" data-editable id="publisher" data-type="text" data-pk="'+info[i].id+'">' + info[i].publisher + '</a></td>');
        if(info[i].file){
            tr.append("<td width='15%' ><a href='/img/files/"+info[i].file.name+"' target='_blank' ><button class='btn btn-default btn-sm'><i class='fa fa-file-image-o fa-lg' ></i> مشاهده تصویر </button></a></td>");
        }else{
            tr.append("<td width='15%' ></td>");
        }
        tr.append('<td width="5%" ><button id="delete_paper" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#paper_table_list').find('tbody').append(tr);
    }

    $('#paper_table_list a[data-editable]').editable({
        url: '/profile/skill/paper/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_amounts(info){
    $('#amount_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="10%" >' + info[i].title + '</td>');
        tr.append('<td width="15%" >' + info[i].type_name + '</td>');
        tr.append('<td width="15%" >' + info[i].price + '</td>');
        tr.append('<td width="10%" >' + info[i].unit_name + '</td>');
        tr.append('<td width="10%" >' + info[i].price_per + '</td>');
        tr.append('<td width="15%" >' + info[i].per_unit_name + '</td>');
        tr.append('<td width="20%" >' + info[i].description + '</td>');
        tr.append('<td width="5%" ><button id="delete_amount" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#amount_table_list').find('tbody').append(tr);
    }

    $('#amount_table_list a[data-editable]').editable({
        url: '/profile/skill/amount/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });
}

function skill_areas(info){
    $('#area_table_list').find('tbody').html('');
    var tr;
    console.log(info);
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="25%" >' + info[i].province_name+ '</td>');
        tr.append('<td width="25%" >' + info[i].city_name + '</td>');
        tr.append('<td width="45%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        tr.append('<td width="5%" ><button id="delete_area" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#area_table_list').find('tbody').append(tr);
    }

    $('#area_table_list a[data-editable]').editable({
        url: '/profile/skill/area/change',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });


}

function skill_galleries(info){
    $('#gallery_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="50%" ><a href="#" data-editable id="title" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append("<td width='15%' ><a href='/img/files/"+info[i].files[0].name+"' target='_blank' ><button class='btn btn-default btn-sm'><i class='fa fa-file-image-o fa-lg' ></i> مشاهده تصویر </button></a></td>");
        tr.append('<td width="5%" ><button id="delete_gallery" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#gallery_table_list').find('tbody').append(tr);
    }

    $('#gallery_table_list a[data-editable]').editable({
        url: '/profile/skill/gallery/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

}

function skill_services(info){
    $('#service_table_list').find('tbody').html('');
    var tr;
    for (var i = 0; i < info.length; i++) {
        tr = $('<tr />');
        tr.append('<td width="25%" ><a href="#" data-editable id="title" data-type="text" data-pk="'+info[i].id+'">' + info[i].title + '</a></td>');
        tr.append('<td width="70%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="'+info[i].id+'">' + info[i].description + '</a></td>');
        tr.append('<td width="5%" ><button id="delete_service" data-value="'+info[i].id+'" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>');
        $('#service_table_list').find('tbody').append(tr);
    }

    $('#service_table_list a[data-editable]').editable({
        url: '/profile/skill/service/update',
        title: 'ویرایش',
        params: function(params) {
            //originally params contain pk, name and value
            params._token = $('input[name="_token"]').val();
            return params;
        }
    });

}
