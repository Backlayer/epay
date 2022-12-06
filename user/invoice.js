'use strict';
let item = 1;
function getSubtotal(el) {
    let $parent = $(el).closest('.row');
    let $amount = $parent.find('#amount').val() ?? 0;
    let $quantity = $parent.find('#quantity').val() ?? 0;
    $parent.find('#subtotal').val(parseInt($amount) * parseInt($quantity))
}

$(document).ready(function () {
    $('.repeater').repeater({
        initEmpty: false,
        defaultValues: {
            'item_name': null,
            'invoice_no': null,
            'quantity': 1,
            'amount': null
        },
        show: function () {
            if(item <= 9){
                item++
                $(this).slideDown().prepend('<hr>');
                $(this).find('#quantity').attr('type', 'number');
                $(this).find('#amount').attr('type', 'number');
                $(this).find('#item_number span').html(item)
            }else{
                Notify('error', null, 'Item Limit Exceed')
            }
        },
        hide: function (deleteElement) {
            $.confirm({
                title:"Heads Up!",
                icon: 'fas fa-trash',
                theme: 'modern',
                closeIcon: true,
                animation: 'scale',
                type: 'red',
                scrollToPreviousElement: false,
                scrollToPreviousElementAnimate: false,
                buttons: {
                    confirm: {
                        btnClass: 'btn-red',
                        action: function () {
                            $(this).slideUp(deleteElement);
                            item--;
                        }
                    },
                    close: {
                        action: function () {
                            this.buttons.close.hide()
                        }
                    }
                },
            });
        },
        ready: function (setIndexes) {
            $(document).find('#quantity').attr('type', 'number');
            $(document).find('#amount').attr('type', 'number');
        },
        isFirstItemUndeletable: true
    })
});
