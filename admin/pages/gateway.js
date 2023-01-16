"use strict";

$(document).ready(function () {
    $('.repeater').repeater({
        initEmpty: true,
        defaultValues: {
            'label': '',
            'type': 'text',
            'isRequired': false
        },
        show: function () {
            $(this).slideDown();

            $('.repeaters').animate({ scrollTop: 9999 }, 'slow');
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        isFirstItemUndeletable: true
    })
});
