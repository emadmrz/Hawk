$("#product_form").find('input').change(function(){
    var form = $("#product_form");
    var data = form.serialize();
    $.ajax({
        url : '/home/shop/product/price',
        type : 'post',
        data : data,
        dataType: 'json',
        beforeSend: function(){},
        complete: function(){},
        success: function(data){
            console.log(data);
            $("#amount").html(numberWithCommas(data.amount)+' تومان ');
            $("#final_amount").html(numberWithCommas(data.final_amount)+' تومان ');
            $("#discount_amount").html(numberWithCommas(data.discount_amount));
        },
        error: function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
});

$("#product_images_list").find('.other-image').find('img').click(function(e){
    e.preventDefault();
    var $this = $(this);
    $("#product_images_list").find('.image').find('img').attr('src', $this.attr('src'))
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}