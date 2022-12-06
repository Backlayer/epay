"use strict";
function getTotalCustomers() {
    let url = $("#get-customers-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-customers').text(res.total);
            $('.active-customers').text(res.active);
            $('.paused-customers').text(res.pause);
            $('.suspend-customers').text(res.suspand);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalDeposits() {
    let url = $("#get-deposits-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-deposits').text(res.total);
            $('.completed-deposits').text(res.completed);
            $('.pending-deposits').text(res.pending);
            $('.rejected-deposits').text(res.rejected);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalTransactions() {
    let url = $("#get-transaction-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-transactions').text(res.total);
            $('.credit-transactions').text(res.credit);
            $('.debit-transactions').text(res.debit);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalDonations() {
    let url = $("#get-donations-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-donations').text(res.total);
            $('.active-donations').text(res.active);
            $('.paused-donations').text(res.paused);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalSingleCharge() {
    let url = $("#get-single-charge-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-donations').text(res.total);
            $('.active-donations').text(res.active);
            $('.paused-donations').text(res.paused);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalInvoices() {
    let url = $("#get-invoices-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.invoices').text(res.invoices);
            if (res.total_items || res.total_quantity) {
                $('.total_items').text(res.total_items);
                $('.total_quantity').text(res.total_quantity);
            }
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalProducts() {
    let url = $("#get-products-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total').text(res.total);
            $('.physical').text(res.physical);
            $('.digital').text(res.digital);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalStores() {
    let url = $("#get-stores-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total').text(res.total);
            $('.physical').text(res.physical);
            $('.digital').text(res.digital);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalRequestMoney() {
    let url = $("#get-request-money-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-deposits').text(res.total);
            $('.completed-deposits').text(res.completed);
            $('.pending-deposits').text(res.pending);
            $('.rejected-deposits').text(res.rejected);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalPayouts() {
    let url = $("#get-payouts-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-payouts').text(res.withdraws);
            $('.completed-payouts').text(res.approved);
            $('.pending-payouts').text(res.pending);
            $('.rejected-payouts').text(res.rejected);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalOrders() {
    let url = $("#get-orders-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-orders').text(res.total);
            $('.completed-orders').text(res.completed);
            $('.pending-orders').text(res.pending);
            $('.cancled-orders').text(res.cancled);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalTransfers() {
    let url = $("#get-transfers-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res) {
            $('.total-transfers').text(res.total);
            $('.completed-transfers').text(res.completed);
            $('.pending-transfers').text(res.pending);
            $('.refund-transfers').text(res.refund);
            $('.cancled-transfers').text(res.cancled);
            $('#loading').addClass('d-none');
        },
    })
}
