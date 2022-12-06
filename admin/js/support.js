(function($) {
    "use strict";

    /*-----------------
        Delete Chat
    -----------------------*/
    $('.delete-chat').on('click', function (event) {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this support ticket!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('delete_form_'+id).submit();
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your Data is Save :)',
                'error'
            )
            }
        })
    });


    /*-----------------
        Ticket Off
    -----------------------*/
    $('.ticket-item:first-child').addClass('active');
    var supportID = $('.ticket-item:first-child').data('id');
    var tickets = $('.ticket-item');

    $(document).on('change', '#status',function(e){
        var id = $(this).data('id');
        var status = $(this).val();

        $.ajax({
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            url: $('#support_status_url').val(),
            dataType: 'json',
            success: function(response){
                Notify('success', response)
            },
            error: function(xhr, status, error)
            {
                Notify('error', xhr)
            }
        })
    });

    let $spinner = '<div class="spinner-border spinner-border-sm" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div>'

    $(document).on('submit', '.replyForm', function (e) {
        e.preventDefault();

        let $submitBtn = $('.card-header-action');
        let $submitBtnOriginal = $submitBtn.html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($spinner).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);

                Notify('success', res)
                $('.replyForm').trigger('reset');

                $('#replies').prepend(res.reply)
            },
            error: function (xhr) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);
                Notify('error', xhr)
                showInputErrors(xhr);
            }
        });
    });

    for (let ticket of tickets) {
        $(ticket).on('click', function() {
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            let supportID = $(this).data('id');
            showTickets(supportID);
        })
    }

    function showTickets(supportID) {
        let $submitBtn = $('.card-header-action');
        let $submitBtnOriginal = $submitBtn.html();

        $.ajax({
            type: 'POST',
            url: $('#support_get_ticket_url').val(),
            data: {
                id: supportID
            },
            beforeSend: function () {
                $submitBtn.html($spinner).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);
                $('#getTicket').html(res)
                $('#replies').prepend(res.reply);
                $("select").select2();
                $('.gallery').Chocolat();
            },
            error: function (xhr) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);
                Notify('error', xhr)
                showInputErrors(xhr);
            }
        });
    }
})(jQuery);
