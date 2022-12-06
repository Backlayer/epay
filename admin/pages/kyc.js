"use strict";

$(document).ready(function () {
    $('.repeater').repeater({
        initEmpty: true,
        defaultValues: {
            'label': '',
            'type': 'text'
        },
        show: function () {
            $(this).slideDown();

            $('.repeaters').animate({ scrollTop: 9999 }, 'slow');
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        ready: function (setIndexes) {
            $dragAndDrop.on('drop', setIndexes);
        },
        isFirstItemUndeletable: true
    })
});
