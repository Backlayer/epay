'use strict';
let item = 1;

$(document).ready(function () {
    $('.repeater').repeater({
        initEmpty: false,
        defaultValues: {
            'title': null,
        },
        show: function () {
            if(item <= 9){
                item++
                $(this).slideDown();
            }else{
                Notify('error', null, 'Features Limit Exceed')
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

        },
        isFirstItemUndeletable: true
    })
});
