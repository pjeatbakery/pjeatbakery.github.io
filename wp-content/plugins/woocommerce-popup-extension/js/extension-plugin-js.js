jQuery(document).ready(function($) {
    var shr = 1;
    $('.add_to_cart_button').on('click', function() {
        var current_elem = $(this);
        var product_id = current_elem.data('product_id');
        var new_data = {
            action: 'new_pop_up',
            product_id: product_id
        };
        var xhr = $.post(WooPopUp.ajaxurl, new_data, function(res) {
            if (res.flag == true) {
                var data = '';
                data += res.msg;
                data += '<div class="woo-pop-cont">';
                data += '<div class="woo-pop-success">' + res.title + ' added to your cart</div>';
                data += '<div class="woo-pop-img"><img src="' + res.image_src + '"></div>';
                data += '<div class="button-div">';
                data += '<a href="" onclick="javascript:tb_remove();return false;" class="button continue-shpg wc-forward">Continue Shopping</a>';
                data += '<a href="' + WooPopUp.siteurl + '/cart/" class="button">View Cart</a>';
                data += '<a href="' + WooPopUp.siteurl + '/checkout/" class="button checkout wc-forward">Checkout</a>';
                data += '</div>';
                data += '</div>';
                current_elem.append('<div id="hidden_cart_' + res.product_ID + '" style="display:none">' + data + '</div>');
                $('#show_hidden_cart_' + res.product_ID + '').click();
            }
        }, 'json');
        if (shr > 1) {
            xhr.abort();
            shr = 1;
        } else {
            shr++;
        }




//        data += '<div>';
//        data += '<p>';
//        data += '<img src="">';
//        data += '<h4>Product added to cart</h4>';
//        data += '</p>';
//        data += '<p class="buttons">';
//        data += '	<a href="" onclick="javascript:tb_remove();return false;" class="button wc-forward">Continue Shopping</a>';
//        data += '	<a href="/store/checkout/" class="button checkout wc-forward">Checkout</a>';
//        data += '</p>';
//        data += '</div>';
//        $(this).append('<div id="hidden_cart" style="display:none">' + data + '</div>');

    });

});