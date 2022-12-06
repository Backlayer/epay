(function ($) {
    "use strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.collapse_btn').on('click', function() {
        $('.sidebar-header').toggleClass('d-none')
    });

    /*----------------------
        CheckAll Active
    --------------------------*/
    $(".checkAll").on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    /*-------------------------------
    Delete Confirmation Alert
    -----------------------------------*/
    $(".cancel").on('click',function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do It!'
        }).then((result) => {
            if (result.value == true) {
                window.location.href = link;
            }
        })
    });

    /*-------------------------------
    Delete Confirmation Alert
    -----------------------------------*/
    $('.delete-confirm').on('click', function(event) {
        let url = $(this).data('action');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function(response){
                        if (response.redirect){
                            if (response.message){
                                Notify('success', response)
                            }

                            window.location.href = response.redirect;
                        }else{
                            Notify('success', null, response)
                        }
                    },
                    error: function(xhr, status, error)
                    {
                        Notify('error', xhr)
                    }
                })
            }
        })
    });

    $('.action-confirm').on('click', function(event) {
        let url = $(this).data('action');
        let text = $(this).data('text');
        let icon = $(this).data('icon');
        Swal.fire({
            title: 'Are you sure?',
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes confirm!'
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response){
                        if (response.redirect){
                            if (response.message){
                                Notify('success', response)
                            }
                            window.location.href = response.redirect;
                        } else {
                            Notify('success', null, response)
                        }
                    },
                    error: function(xhr, status, error)
                    {
                        Notify('error', xhr)
                    }
                })
            }
        })
    });

    $(document).on('submit', '.mass_destroy', function (e) {
        e.preventDefault();

        let ids = $(this).find('input:checkbox:checked');

        if (ids.length > 0){
            if ($(this).find('.action').val()){
                $.ajax({
                    type: 'POST',
                    url: this.action,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response){
                        if (response.redirect){
                            if (response.message){
                                Notify('success', response)
                            }
                            window.location.href = response.redirect;
                        } else {
                            Notify('success', null, response)
                        }
                    },
                    error: function(xhr, status, error)
                    {
                        Notify('error', xhr)
                    }
                })
            }else{
                Notify('error', null, 'Please select a method')
            }
        }else {
            Notify('error', null, 'Please select at least 1 item.')
        }
    })
    /*-------------------------------
    Action Confirmation Alert
    -----------------------------------*/
    $(document).on('click', '.confirm-action', function(event) {
        var url = $(this).data('action');
        var method = $(this).data('method') ?? 'POST'
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to do this?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#fc544b',
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: method,
                    url: url,
                    success: function(response){
                        success(response)
                    },
                    error: function(xhr, status, error)
                    {
                        error_response(xhr)
                    }
                })
            }
        })
    });

    /*-------------------------------
    Unsubscription Confirmation Alert
    -----------------------------------*/
    $('.unsubscribe-confirm').on('click', function(event) {
        let url = $(this).data('action');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to unsubscribe?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, unsubscribe it!'
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function(response){
                        if (response.redirect){
                            if (response.message){
                                Notify('success', response)
                            }

                            window.location.href = response.redirect;
                        }else{
                            Notify('success', null, response)
                        }
                    },
                    error: function(xhr, status)
                    {
                        error_response(xhr)
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your Data is Save :)',
                    'error'
                )
            }
        })
    });

    $.fn.initValidate = function () {
        $(this).validate({
            errorClass: 'is-invalid text-danger',
            validClass: ''
        });
    };

    $.fn.initFormValidation = function () {
        var validator = $(this).validate({
            errorClass: 'is-invalid',
            highlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
                } else if (elem.hasClass('input-group')) {
                    $('#' + elem.add("id")).parents('.input-group').append(errorClass);
                } else {
                    elem.addClass(errorClass);
                }
            },
            unhighlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
            },
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent();
                    error.insertAfter(element);
                } else if (elem.parent().hasClass('form-floating')) {
                    error.insertAfter(element.parent().css('color', 'text-danger'));
                } else if (elem.parent().hasClass('input-group')) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $(this).on('select2:select', function () {
            if (!$.isEmptyObject(validator.submitted)) {
                validator.form();
            }
        });
    };


    // Select2 Initialization
    var select2FocusFixInitialized = false;
    var initSelect2 = function () {
        // Check if jQuery included
        if (typeof jQuery == 'undefined') {
            return;
        }

        // Check if select2 included
        if (typeof $.fn.select2 === 'undefined') {
            return;
        }

        var elements = [].slice.call(document.querySelectorAll('[data-control="select2"]'));

        elements.map(function (element) {
            var options = {
                dir: document.body.getAttribute('direction')
            };

            if (element.getAttribute('data-hide-search') == 'true') {
                options.minimumResultsForSearch = Infinity;
            }

            if (element.hasAttribute('data-hide-search')) {
                options.minimumResultsForSearch = Infinity;
            }

            if (element.hasAttribute('data-placeholder')) {
                options.placeholder = element.getAttribute('data-placeholder');
            }

            $(document).ready(function (){
                $(element).select2(options);
            });
        });

        /*
        * Hacky fix for a bug in select2 with jQuery 3.6.0's new nested-focus "protection"
        * see: https://github.com/select2/select2/issues/5993
        * see: https://github.com/jquery/jquery/issues/4382
        *
        * TODO: Recheck with the select2 GH issue and remove once this is fixed on their side
        */

        if (select2FocusFixInitialized === false) {
            select2FocusFixInitialized = true;

            $(document).on('select2:open', function(e) {
                var elements = document.querySelectorAll('.select2-container--open .select2-search__field');
                if (elements.length > 0) {
                    elements[elements.length - 1].focus();
                }
            });
        }
    }

    initSelect2();

    $('.ajaxform_with_mass_delete :checkbox').change(function() {
        var allChecked = $('.ajaxform_with_mass_delete').find('.checked_input:checked');

        if (allChecked.length === 0){
            $('.mass-delete-btn').fadeOut();
        }else {
            $('.mass-delete-btn').fadeIn();
        }
    })

    $(document).on('click', '.edit-bank', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let code = $(this).data('code');
        let currency = $(this).data('currency');
        $('#name').val(name);
        $('#code').val(code);
        $('#currency_id').val(currency);
        let action = $('.bank-edit-form').attr('action');
        $('.bank-edit-form').attr('action', action + '/' + id);
        $('#edit-bank').modal('show');
    })

})(jQuery);

function subdomain(el, replaceWith = "") {
    if (el.value.match(/\s/g)) {
        el.value = el.value.toLowerCase();
        el.value = el.value.replace(/\s/g, replaceWith);
    }
}

function success(response) {
    if (response.redirect){
        if (response.message){
            Notify('success', response)
        }

        window.setTimeout(function () {
            window.location.href = response.redirect
        }, 1000);
    }else if(response.message){
        Notify('success', response)
    }else{
        Notify('success', null, response)
    }
}

function error_response(xhr) {
    Notify('error', xhr)
}

var clipboard = new ClipboardJS('.clipboard-button');
clipboard.on('success', function(e) {
    let $message = $(e.trigger).data('message') ?? 'Copied to clipboard'
    Notify('success', null, $message)
    e.clearSelection();
});
