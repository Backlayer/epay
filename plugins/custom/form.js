"use strict"

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let $savingLoader = '<div class="spinner-border spinner-border-sm" role="status">' +
    '<span class="visually-hidden">Loading...</span>' +
    '</div>';


let $ajaxform = $('.ajaxform');
$ajaxform.initFormValidation();

$(document).on('submit', '.ajaxform', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find('.submit-button');
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($savingLoader).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);

                Notify('success', res);
            },
            error: function (xhr) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);
                showInputErrors(xhr.responseJSON);
                Notify('error', xhr);
            }
        });
    }
});

// Show Success Message After Page Reload
let $ajaxform_instant_reload = $('.ajaxform_instant_reload');
$ajaxform_instant_reload.initFormValidation();

$(document).on('submit', '.ajaxform_instant_reload', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find('.submit-btn');
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform_instant_reload.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($savingLoader).addClass('disabled').attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($oldSubmitBtn).removeClass('disabled').attr('disabled', false);
                window.sessionStorage.hasPreviousMessage = true;
                window.sessionStorage.previousMessage = res.message ?? null;

                if (res.redirect) {
                    location.href = res.redirect;
                }
            },
            error: function (xhr) {
                $submitBtn.html($oldSubmitBtn).removeClass('disabled').attr('disabled', false);
                showInputErrors(xhr.responseJSON);
                Notify('error', xhr, null, xhr.responseJSON.url ?? null);
            }
        });
    }
});


// Show Success Message After Page Reload
let $ajaxform_instant_reload_after_confirm = $('.ajaxform_instant_reload_after_confirm');
$ajaxform_instant_reload_after_confirm.initFormValidation();

$(document).on('submit', '.ajaxform_instant_reload_after_confirm', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find('.submit-btn');
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform_instant_reload_after_confirm.valid()) {
        let icon = $(this).find('.submit-btn').data('icon') ?? 'fas fa-warning';
        let action = this.action
        let formData = new FormData(this)

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
                        let btnThis = this;
                        $.ajax({
                            type: 'POST',
                            url: action,
                            data: formData,
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function () {
                                $submitBtn.html($savingLoader).addClass('disabled').attr('disabled', true);
                                btnThis.buttons.close.hide()
                            },
                            success: function (res) {
                                $submitBtn.html($oldSubmitBtn).removeClass('disabled').attr('disabled', false);
                                window.sessionStorage.hasPreviousMessage = true;
                                window.sessionStorage.previousMessage = res.message ?? null;

                                if (res.redirect) {
                                    location.href = res.redirect;
                                }
                            },
                            error: function (xhr) {
                                $submitBtn.html($oldSubmitBtn).removeClass('disabled').attr('disabled', false);
                                showInputErrors(xhr.responseJSON);
                                Notify('error', xhr, null, xhr.responseJSON.url ?? null);
                            }
                        });
                    }
                },
                close: {
                    action: function () {
                        this.buttons.close.hide()
                    }
                }
            },
        });
    }
});

// Reset The form after success response
let $ajaxform_reset_form = $('.ajaxform_reset_form');
$ajaxform_reset_form.initFormValidation();

$(document).on('submit', '.ajaxform_reset_form', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find('.submit-button');
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform_reset_form.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($savingLoader).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);

                $this.trigger('reset');
                Notify('success', res);
            },
            error: function (xhr) {
                $submitBtn.html($oldSubmitBtn).attr('disabled', false);
                showInputErrors(xhr.responseJSON);
                Notify('error', xhr);
            }
        });
    }
});

$('.init_form_validation').initFormValidation();
