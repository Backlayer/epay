"use strict";

$(document).ready(function () {
    //getSingleChargeData();
    //getQrPaymentData();
    dashboardData();
    // getOrderData();
    // getDonationsData();
    // getPlanData();
});

$('#credit-debit-perfomace').on('change', function () {
    let year = $(this).val();
    dashboardData(year)
})

$('#single-charge-perfomace').on('change', function () {
    let day = $(this).val();
    getSingleChargeData(day)
})

$('#order-perfomace').on('change', function () {
    let day = $(this).val();
    getOrderData(day)
})

$('#donations-perfomace').on('change', function () {
    let day = $(this).val();
    getDonationsData(day)
})

$('#plans-perfomace').on('change', function () {
    let day = $(this).val();
    getPlanData(day)
})

$('#qr-payments-perfomace').on('change', function () {
    let day = $(this).val();
    getQrPaymentData(day)
})

function dashboardData(year = null) {
    if (!year) {
        year = $('#credit-debit-perfomace').find('option').first().val()
    }

    const chart_url = $("#get-dashboard-data").val();

    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            year
        },
    }).done(function (res) {
        const months = [];
        const credit = [];
        const debit = [];

        $.each(res.months, function (index, value) {
            months.push(value.month);

            if (value.month == res.credit[index]?.month) {
                credit.push(`${res.credit[index].amount}`.replace(',', ''));
            } else {
                credit.push(0);
            }

            if (value.month == res.debit[index]?.month) {
                debit.push(`${res.debit[index].amount}`.replace(',', ''));
            } else {
                debit.push(0);
            }
        });

        dashboardChart(months, credit, debit);
    });
}

function getOrderData(day = null) {
    const chart_url = $("#get-order-data").val();

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
    const chart_url = $("#get-single-charge-data").val()

    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        const singleChargeMonths = []
        const singleChargeAmount = []

        $.each(res.singlecharge, function (index, value) {
            if (value.month.indexOf('-') > -1) {
                const date = new Date(value.month)

                singleChargeMonths.push(date.toLocaleDateString())
            } else {
                singleChargeMonths.push(value.month)
            }

            singleChargeAmount.push(value.amount)
        });

        singleCharge(singleChargeMonths, singleChargeAmount)
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
    const chart_url = $("#get-qr-payments-data").val()

    $.ajax({
        url: chart_url,
        type: "get",
        data: {
            day
        },
    }).done(function (res) {
        const qrpaymentsMonths = []
        const qrpaymentsAmount = []

        $.each(res.qrpayments, function (index, value) {
            if (value.month.indexOf('-') > -1) {
                const date = new Date(value.month)

                qrpaymentsMonths.push(date.toLocaleDateString())
            } else {
                qrpaymentsMonths.push(value.month)
            }

            qrpaymentsAmount.push(value.amount);
        })

        qrpayments(qrpaymentsMonths, qrpaymentsAmount);
    });
}

const legend = {
    display: true
}

const xAxes = [
    {
        gridLines: {
            display: true,
            tickMarkLength: 10,
        },
    },
]

const yAxes = [
    {
        gridLines: {
            drawBorder: true,
            color: 'rgba(106, 172, 196,.8)',
        },
        ticks: {
            beginAtZero: true,
            callback: function (value, index, values) {
                return $('#currency').val() + parseFloat(value).toFixed(2);
            },
        },
    },
]

const datasets = (label, data, color) => ({
    label,
    data,
    backgroundColor: color,
    borderWidth: 2,
    borderColor: color,
    pointRadius: 3.5,
    pointBorderWidth: 0,
    pointBackgroundColor: color,
    pointHoverBackgroundColor: color,
})

function dashboardChart(months, credit, debit) {
    console.log({months, credit, debit})

    const dashboardCtx = document.getElementById("creditDebitChart").getContext("2d");

    new Chart(dashboardCtx, {
        type: "line",
        data: {
            labels: months,
            datasets: [
                datasets('Credit', credit, 'rgba(63,82,227,.8)'),
                datasets('Debit', debit, 'rgba(254,86,83,.7)'),
            ]
        },
        options: {
            legend,
            scales: {
                yAxes,
                xAxes
            },
        },
    });
}

function orderChart(months, amount) {
    var orderCtx = document.getElementById("orderChart").getContext("2d");
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
            legend,
            scales: {
                yAxes,
                xAxes
            },
        },
    });
}

function singleCharge(months, amount) {
    const singleChargeCtx = document.getElementById("singleCharge").getContext("2d");

    new Chart(singleChargeCtx, {
        type: "line",
        data: {
            labels: months,
            datasets: [datasets('Single charge', amount, 'rgba(63,82,227,.8)')]
        },
        options: {
            legend,
            scales: {
                yAxes,
                xAxes
            },
        },
    });
}

function donationsChart(months, amount) {
    var donationsCtx = document.getElementById("donationsChart").getContext("2d");
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
            legend,
            scales: {
                yAxes,
                xAxes
            },
        },
    });
}

function planChart(months, amount) {
    var planCtx = document.getElementById("planChart").getContext("2d");
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
            legend,
            scales: {
                yAxes,
                xAxes
            },
        },
    });
}

function qrpayments(months, amount) {
    const qrpaymentsCtx = document.getElementById("qrpayments").getContext("2d");

    new Chart(qrpaymentsCtx, {
        type: "line",
        data: {
            labels: months,
            datasets: [datasets('Qr payments', amount, 'rgba(223, 104, 7, 0.8)')]
        },
        options: {
            legend,
            scales: {
                yAxes,
                xAxes
            },
        },
    });
}

const qr = QRCode.generatePNG(document.getElementById('qrUrl').value, {
    ecclevel: "M",
    format: "html",
    margin: 4,
    modulesize: 8
});

const img = document.createElement("img");

img.src = qr;

document.getElementById('qrcode').appendChild(img);

//For download
var download = document.getElementById('download-qr').href = qr;
