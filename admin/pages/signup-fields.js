"use strict";

$(document).ready(function () {
    const renderRepeater = (defaultValues) => {
        $('.repeater').repeater({
            initEmpty: true,
            defaultValues,
            show: function () {
                $(this).slideDown();

                $('.repeaters').animate({ scrollTop: 9999 }, 'slow');
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: true
        })
    }

    renderRepeater({
        'label': '',
        'value': '',
    })

    if ($('.repeaters').data('count') > 0) {
        $('.repeaters').show()
    } else {
        $('.repeaters').hide()
    }

    $('select[name="type"]').on('change', function () {
        const val = $(this).val()

        if (['select', 'radio', 'checkbox'].includes(val)) {
            $('.repeaters').show()
        } else {
            $('.repeaters').hide()
        }
    })
});
