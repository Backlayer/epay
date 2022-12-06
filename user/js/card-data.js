'use strict';

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

function getTotalProducts() {
    let url = $("#get-products-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total').text(res.total);
            $('.quantity').text(res.quantity);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalProducts() {
    let url = $("#get-products-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total').text(res.total);
            $('.amount').text(res.quantity);
            $('#loading').addClass('d-none');
        },
    })
}






var qr = QRCode.generatePNG(document.getElementById('qrUrl').value, {
    ecclevel: "M",
    format: "html",
    margin: 4,
    modulesize: 8
});

var img = document.createElement("img");
img.src = qr;
document.getElementById('qrcode').appendChild(img);

//For download
var download = document.getElementById('download-qr').href = qr;