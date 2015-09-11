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

});

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

function user_info(info){
    var container = $("#user_info_form");
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