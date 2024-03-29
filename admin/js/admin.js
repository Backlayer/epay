"use strict";
function getTotalCustomers() {
    const url = $("#get-customers-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-customers').text(res.total);
            $('.active-customers').text(res.active);
            $('.paused-customers').text(res.pause);
            $('.suspend-customers').text(res.suspand);
            $('loading').addClass('d-none');
        },
    })
}

function getTotalDeposits() {
    const url = $("#get-deposits-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-deposits').text(res.total);
            $('.completed-deposits').text(res.completed);
            $('.pending-deposits').text(res.pending);
            $('.rejected-deposits').text(res.rejected);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalTransactions() {
    const url = $("#get-transaction-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-transactions .count').text(res.total.count).removeClass('d-none');
            $('.total-transactions .sum').text(res.total.sum).removeClass('d-none');

            $('.credit-transactions .count').text(res.credit.count).removeClass('d-none');
            $('.credit-transactions .sum').text(res.credit.sum).removeClass('d-none');

            $('.debit-transactions .count').text(res.debit.count).removeClass('d-none');
            $('.debit-transactions .sum').text(res.debit.sum).removeClass('d-none');

            $('.loading').addClass('d-none');
        },
    })
}

function getTotalDonations() {
    const url = $("#get-donations-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-donations').text(res.total);
            $('.active-donations').text(res.active);
            $('.paused-donations').text(res.paused);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalSingleCharge() {
    const url = $("#get-single-charge-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-single-changes').text(res.total);
            $('.active-single-changes').text(res.active);
            $('.paused-single-changes').text(res.paused);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalQrPayment() {
    const url = $("#get-qr-payment-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-qr-payments').text(res.total);
            $('.paid-qr-payments').text(res.paid);
            $('.confirmed-qr-payments').text(res.confirmed);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalInvoices() {
    const url = $("#get-invoices-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.invoices').text(res.invoices);
            if (res.total_items || res.total_quantity) {
                $('.total_items').text(res.total_items);
                $('.total_quantity').text(res.total_quantity);
            }
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalProducts() {
    const url = $("#get-products-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total').text(res.total);
            $('.physical').text(res.physical);
            $('.digital').text(res.digital);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalStores() {
    const url = $("#get-stores-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total').text(res.total);
            $('.physical').text(res.physical);
            $('.digital').text(res.digital);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalRequestMoney() {
    const url = $("#get-request-money-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-deposits').text(res.total);
            $('.completed-deposits').text(res.completed);
            $('.pending-deposits').text(res.pending);
            $('.rejected-deposits').text(res.rejected);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalPayouts() {
    const url = $("#get-payouts-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-payouts').text(res.withdraws);
            $('.completed-payouts').text(res.approved);
            $('.pending-payouts').text(res.pending);
            $('.rejected-payouts').text(res.rejected);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalOrders() {
    const url = $("#get-orders-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-orders').text(res.total);
            $('.completed-orders').text(res.completed);
            $('.pending-orders').text(res.pending);
            $('.cancled-orders').text(res.cancled);
            $('.loading').addClass('d-none');
        },
    })
}

function getTotalTransfers() {
    const url = $("#get-transfers-url").val();

    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-transfers').text(res.total);
            $('.completed-transfers').text(res.completed);
            $('.pending-transfers').text(res.pending);
            $('.refund-transfers').text(res.refund);
            $('.cancled-transfers').text(res.cancled);
            $('.loading').addClass('d-none');
        },
    })
}
