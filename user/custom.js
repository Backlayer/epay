'use strict';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.confirm-action', function(event) {
    event.preventDefault();

    let url = $(this).data('action') ?? $(this).attr('href');
    let method = $(this).data('method') ?? 'POST';
    let icon = $(this).data('icon') ?? 'fas fa-warning';

    $.confirm({
        title:"Heads Up!",
        icon: icon,
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
                    event.preventDefault();
                    $.ajax({
                        type: method,
                        url: url,
                        success: function(response){
                            if (response.redirect){
                                window.sessionStorage.hasPreviousMessage = true;
                                window.sessionStorage.previousMessage = response.message ?? null;

                                location.href = response.redirect;
                            }else {
                                Notify('success', response)
                            }
                        },
                        error: function(xhr, status, error)
                        {
                            Notify('error', xhr)
                        }
                    })
                }
            },
            close: {
                action: function () {
                    this.buttons.close.hide()
                }
            }
        },
    });
});

$('.view-money-request').on('click', function() {
    let request = $(this).data('request');
    let amount = $(this).data('amount');
    let date = $(this).data('date');

    $('.sender-avatar').attr('src', request.sender.avatar);
    $('.sender-name').text(request.sender.name);
    $('.sender-email').text(request.sender.email);
    $('.sender-phone').text(request.sender.phone);

    $('.receiver-avatar').attr('src', request.receiver.avatar);
    $('.receiver-name').text(request.receiver.name);
    $('.receiver-email').text(request.receiver.email);
    $('.receiver-phone').text(request.receiver.phone);

    $('.request-amount').text(amount);
    $('.request-date').text(date);
    var status = '';

    if (request.status == 2) {
        status = '<span class="badge badge-pill badge-warning"><i class="fas fa-spinner"></i> PENDING </span>';
    } else if(request.status == 1) {
        status = '<span class="badge badge-pill badge-success"><i class="fas fa-check"></i> APPROVED </span>';
    } else {
        status = '<span class="badge badge-pill badge-danger"><i class="fa fa-times"></i> CANCLED </span>';
    }
    $('.request-status').html(status);

    $("#view-money-request").modal('show');
})

$('.edit-category').on('click', function() {
    let category = $(this).data('category');
    var attrVal = $('.edit-category-form').attr('action');
    var url = attrVal+'/'+category.id
    $('.edit-category-form').attr('action', url);
    $('.category-title').val(category.title);
    $("#edit-category").modal('show');
})

if ($('.clipboard-button').length > 0){
    var clipboard = new ClipboardJS('.clipboard-button');
    clipboard.on('success', function(e) {
        let $message = $(e.trigger).data('message') ?? 'Copied to clipboard'
        Notify('success', null, $message)
        e.clearSelection();
    });
}

$('.send-money-again').on('click', function() {
    let email = $(this).data('email');
    $('.email').val(email);
    $('.email').text(email);
    $('#send-money').modal('show');
})

$('.edit-shipping').on('click', function() {
    let shipping = $(this).data('shipping');
    let url = $('#shipping-url').val();
    $('#region').val(shipping.region);
    $('.edit-shipping-form').attr('action', url+'/'+shipping.id);
    $('#amount').val(shipping.amount);
    $('#amount').val(shipping.amount);
    $('#edit-shipping').modal('show');
})

if ($('table').length > 0){
    $('#table').DataTable({
        info: false,
        paging: false,
        searching: false
    })
}

var clipboard = new ClipboardJS('.link');
clipboard.on('success', function(e) {
    Notify('success', null, 'Copied to clipboard')
    e.clearSelection();
});

var clipboard = new ClipboardJS('.dropdown-item');
clipboard.on('success', function(e) {
    Notify('success', null, 'Copied to clipboard')
    e.clearSelection();
});
