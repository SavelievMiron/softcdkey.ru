(function($){
    const shoppingCart = $('#shopping-cart');

    function refreshCart()
    {
        $.ajax({
            type: 'GET',
            url: globalJS.ajax_url,
            data: {
                action: globalJS.ajax_actions.cart_contents,
                _wpnonce: globalJS.nonce.ajax.cart_contents
            },
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Произошла ошибка. Попробуйте добавить в корзину ещё раз.')
            },
            success: function (response) {
                if (response.success) {
                    shoppingCart.find('#dropdown-products').html(response.data.items)
                    shoppingCart.find('.cart-dropdown__amount').html(response.data.count);
                    shoppingCart.find('.cart-total-price').html(response.data.total_price)
                    shoppingCart.find('.cart-dropdown__hide').addClass('show')
                    shoppingCart.find('.cart-dropdown__menu').removeClass('hide')
                }
            }
        })
    }

    $(document.body).on('added_to_cart', refreshCart);

    shoppingCart.on('click', '.dropdown-product__remove', function () {
        const item = $(this).parent(),
        id = item.data('id');

        $.ajax({
            type: 'POST',
            url: globalJS.ajax_url,
            data: {
                action: globalJS.ajax_actions.remove_cart_item,
                id: id,
                _wpnonce: globalJS.nonce.ajax.remove_cart_item,
            },
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Произошла ошибка. Попробуйте удалить товар из корзины ещё раз.')
            },
            success: function (response) {
                if (response.success) {
                    shoppingCart.find('#dropdown-products').html(response.data.items)
                    shoppingCart.find('.cart-dropdown__amount').html(response.data.count);
                    shoppingCart.find('.cart-total-price').html(response.data.total_price)

                    if (response.data.count !== 0) {
                        shoppingCart.find('.cart-dropdown__hide').addClass('show')
                    } else {
                        shoppingCart.find('.cart-dropdown__hide').removeClass('show')
                    }
                }
            }
        })
    })

    $('#clearCart').on('click', function () {
        $.ajax({
            type: 'POST',
            url: globalJS.ajax_url,
            data: {
                action: globalJS.ajax_actions.clear_cart,
                _wpnonce: globalJS.nonce.ajax.clear_cart
            },
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Произошла ошибка. Попробуйте очистить корзину ещё раз.')
            },
            success: function (response) {
                if (response.success) {
                    shoppingCart.find('#dropdown-products').html(response.data.items)
                    shoppingCart.find('.cart-dropdown__amount').html(0);
                    shoppingCart.find('.cart-total-price').html(0)
                    shoppingCart.find('.cart-dropdown__hide').removeClass('show')
                }
            }
        })
    })

    $('.single-add_to_cart').on('click', function (e) {
        e.preventDefault()

        const id = this.dataset.product_id,
        quantity = this.dataset.quantity;

        $.ajax({
            type: 'POST',
            url: globalJS.ajax_url,
            data: {
                action: globalJS.ajax_actions.add_to_cart,
                id: id,
                quantity: quantity,
                _wpnonce: globalJS.nonce.ajax.add_to_cart
            },
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Произошла ошибка. Попробуйте очистить корзину ещё раз.')
            },
            success: function (response) {
                if (response.success) {
                    $(document.body).trigger('added_to_cart')
                }
            }
        })
    })
})(jQuery);