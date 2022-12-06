"use strict";

$(document).ready(function () {
    getChartData();
    getOrderData();
    getSingleChargeData();
    getDonationsData();
    getPlanData();
    getQrPaymentData();
});

$('#current-year').on('change', function() {
    let year = $(this).val();
    getChartData(year)
})

$('#order-perfomace').on('change', function() {
    let day = $(this).val();
    getOrderData(day)
})

$('#single-charge-perfomace').on('change', function() {
    let day = $(this).val();
    getSingleChargeData(day)
})

$('#donations-perfomace').on('change', function() {
    let day = $(this).val();
    getDonationsData(day)
})

$('#plans-perfomace').on('change', function() {
    let day = $(this).val();
    getPlanData(day)
})

$('#qr-payments-perfomace').on('change', function() {
    let day = $(this).val();
    getQrPaymentData(day)
})


function getChartData(year = null) {
    let chart_url = $("#get-chart-data").val();
    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            year
        },
    }).done(function (res) {
        var months = [];
        var credit = [];
        var debit = [];
        $.each(res.months, function (index, value) {
            months.push(value.month);
            if (value.month == res.credit[index]?.month) {
                credit.push(res.credit[index].amount);
            } else {
                credit.push(0);
            }
            if (value.month == res.debit[index]?.month) {
                debit.push(Math.abs(res.debit[index].amount));
            } else {
                debit.push(0);
            }
        });

        dashboardChart(months, credit, debit);
    });
}

function getOrderData(day = null) {
    let chart_url = $("#get-order-data").val();
    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        let orderMonths = [];
        let orderAmount = [];
        $.each(res.orders, function (index, value) {
            orderMonths.push(value.month);
            orderAmount.push(value.amount);
        });
        orderChart(orderMonths, orderAmount);
    });
}

function getSingleChargeData(day = null) {
    let chart_url = $("#get-single-charge-data").val();
    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        let singleChargeMonths = [];
        let singleChargeAmount = [];
        $.each(res.singlecharge, function (index, value) {
            singleChargeMonths.push(value.month);
            singleChargeAmount.push(value.amount);
        });
        singleCharge(singleChargeMonths, singleChargeAmount);
    });
}

function getDonationsData(day = null) {
    let chart_url = $("#get-donations-data").val();
    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        let donationsMonths = [];
        let donationsAmount = [];
        $.each(res.donations, function (index, value) {
            donationsMonths.push(value.month);
            donationsAmount.push(value.amount);
        });
        donationsChart(donationsMonths, donationsAmount);
    });
}

function getPlanData(day = null) {
    let chart_url = $("#get-plans-data").val();
    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        let planMonths = [];
        let planAmount = [];
        $.each(res.plans, function (index, value) {
            planMonths.push(value.month);
            planAmount.push(value.amount);
        });
        planChart(planMonths, planAmount);
    });
}

function getQrPaymentData(day = null) {
    let chart_url = $("#get-plans-data").val();
    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        let qrpaymentsMonths = [];
        let qrpaymentsAmount = [];
        $.each(res.qrpayments, function (index, value) {
            qrpaymentsMonths.push(value.month);
            qrpaymentsAmount.push(value.amount);
        });
        qrpayments(qrpaymentsMonths, qrpaymentsAmount);
    });
}

var ctx = document.getElementById("myChart").getContext("2d");
function dashboardChart(months, credit, debit) {
    new Chart(ctx, {
        type: "line",
        data: {
                labels: months,
                datasets: [{
                label: 'Credit',
                data: credit,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            },
            {
                label: 'Debit',
                data: debit,
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.7)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0 ,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
            }]
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return $('#currency').val() + parseFloat(value).toFixed(2);
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 10,
                        },
                    },
                ],
            },
        },
    });
}

var orderCtx = document.getElementById("orderChart").getContext("2d");
function orderChart(months, amount) {
    new Chart(orderCtx, {
        type: "line",
        data: {
                labels: months,
                datasets: [{
                label: 'Total order',
                data: amount,
                borderWidth: 2,
                backgroundColor: 'rgba(128, 242, 161,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return $('#currency').val() + parseFloat(value).toFixed(2);
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 10,
                        },
                    },
                ],
            },
        },
    });
}

var singleChargeCtx = document.getElementById("singleCharge").getContext("2d");
function singleCharge(months, amount) {
    new Chart(singleChargeCtx, {
        type: "line",
        data: {
                labels: months,
                datasets: [{
                label: 'Single charge',
                data: amount,
                borderWidth: 2,
                backgroundColor: 'rgba(106, 172, 196,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return $('#currency').val() + parseFloat(value).toFixed(2);
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 10,
                        },
                    },
                ],
            },
        },
    });
}

var donationsCtx = document.getElementById("donationsChart").getContext("2d");
function donationsChart(months, amount) {
    new Chart(donationsCtx, {
        type: "line",
        data: {
                labels: months,
                datasets: [{
                label: 'Donations',
                data: amount,
                borderWidth: 2,
                backgroundColor: 'rgba(106, 172, 196,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return $('#currency').val() + parseFloat(value).toFixed(2);
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 10,
                        },
                    },
                ],
            },
        },
    });
}

var planCtx = document.getElementById("planChart").getContext("2d");
function planChart(months, amount) {
    new Chart(planCtx, {
        type: "line",
        data: {
                labels: months,
                datasets: [{
                label: 'Plans',
                data: amount,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return $('#currency').val() + parseFloat(value).toFixed(2);
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 10,
                        },
                    },
                ],
            },
        },
    });
}

var qrpaymentsCtx = document.getElementById("qrpayments").getContext("2d");
function qrpayments(months, amount) {
    new Chart(qrpaymentsCtx, {
        type: "line",
        data: {
                labels: months,
                datasets: [{
                label: 'Qr payments',
                data: amount,
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }]
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            drawBorder: false,
                            color: "#f2f2f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return $('#currency').val() + parseFloat(value).toFixed(2);
                            },
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 10,
                        },
                    },
                ],
            },
        },
    });
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
