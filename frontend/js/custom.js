"use strict";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add_to_cart').on('click',function(e) {
        e.preventDefault();
        let quantity = $("#quantity").val();
        let id = $(this).data('id');
        let store = $(this).data('store');
        let url = $(this).data('url');
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id,
                quantity,
                store,
            },
            success: function (response) {
                if (response.success) {
                    $('.cart-list').html(response.carts)
                    $('.cart_quantity').text(response.items)
                    Notify('success', null, response.message);
                }
            },
            error: function (res) {
                Notify('error', null, res.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.cart__close', function (e) {
        let get_id = $(this).data('id')
        let store = $('#store').val();
        let get_url = $('#cart-route').val();
        let main_url = get_url+'/'+get_id;

        $.ajax({
            type: 'DELETE',
            url: main_url,
            data: {
                rowId: get_id,
                store
            },
            dataType: 'json',
            success: function (res) {
                $('.cart_quantity').text(res.items)
                $('.cart-list').html(res.carts)
                $('#cart-area').html(res.data);
                Notify('success', null, res.message);
            },
            error: function (xhr) {
                Notify('error', xhr, null, xhr.responseJSON.url ?? null);
            }
        });
    });

    $(document).on('submit', '.update-cart', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                $('#cart-area').html(res.data);
                Notify('success', null, res.message);
            },
            error: function (xhr) {
                Notify('error', xhr, null, xhr.responseJSON.url ?? null);
            }
        });
    });

    $('.shipping-place').on('change', function() {
        let total = parseFloat($('#total-price').val());
        let amount = parseFloat($('option:selected', this).attr('amount'));
        if(amount) {
            $('.shipping-charge').text(amount);
            $('.total-price').text(total + amount);
        } else {
            $('.total-price').text(total);
            $('.shipping-charge').text(0);
        }
    })
});

