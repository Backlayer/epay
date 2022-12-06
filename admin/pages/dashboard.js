(function ($) {
    "use strict";

    var period = $('#days').val();
    $('#days').on('change', () => {
        period = $('#days').val();
        loadData();
    })

    var base_url = $("#base_url").val();
    var site_url = $("#site_url").val();
    var dashboard_static_url = $("#dashboard_static").val();
    var isPerformanceChartLoaded = false;
    var performanceChart = false;

    loadStaticData();
    load_performance(7);
    loadData();


    $('#performance').on('change', function () {
        var period = $('#performance').val();
        load_performance(period);
    });

    function loadStaticData() {
        $.ajax({
            type: 'get',
            url: dashboard_static_url,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $('#total_customers').html(response.total_customers);
                $('#total_active_website').html(response.total_active_website);
                $('#total_earnings').html(response.total_earnings);
                $('#total_earnings_this_year').html(response.total_earnings_this_year);
                $('#total_single_charge_earnings_this_year').html(response.total_single_charge_earnings_this_year);
                $('#total_invoice_earnings_this_year').html(response.total_invoice_earnings_this_year);
                $('#total_qr_payment_earnings_this_year').html(response.total_qr_payment_earnings_this_year);
                $('#total_donation_earnings_this_year').html(response.total_donation_earnings_this_year);
                $('#total_website_earnings_this_year').html(response.total_website_earnings_this_year);
                $('#total_transfer_earnings_this_year').html(response.total_transfer_earnings_this_year);
                $('#total_money_request_earnings_this_year').html(response.total_money_request_earnings_this_year);
                $('#total_payout_earnings_this_year').html(response.total_payout_earnings_this_year);

                // Charts
                getChart(response.total_earnings_this_year_chart, 'total_earnings_this_year_chart');
                getChart(response.total_single_charge_earnings_this_year_chart, 'total_single_charge_earnings_this_year_chart');
                getChart(response.total_invoice_earnings_this_year_chart, 'total_invoice_earnings_this_year_chart');
                getChart(response.total_qr_payment_earnings_this_year_chart, 'total_qr_payment_earnings_this_year_chart');
                getChart(response.total_donation_earnings_this_year_chart, 'total_donation_earnings_this_year_chart');
                getChart(response.total_website_earnings_this_year_chart, 'total_website_earnings_this_year_chart');
                getChart(response.total_transfer_earnings_this_year_chart, 'total_transfer_earnings_this_year_chart');
                getChart(response.total_money_request_earnings_this_year_chart, 'total_money_request_earnings_this_year_chart');
                getChart(response.total_payout_earnings_this_year_chart, 'total_payout_earnings_this_year_chart');
            }
        })
    }

    // Total Earning Chart of this year

    function getChart(data, elementID) {
        // Donation
        let earningDates = [];
        let earningTotal = [];

        $.each(data, function (index, value) {
            var date = value.month + ' ' + value.year;
            var total = value.total;

            earningDates.push(date);
            earningTotal.push(total);
        });

        var chart = document.getElementById(elementID).getContext('2d');
        var chart_bg_color = chart.createLinearGradient(0, 0, 0, 70);
        chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
        chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

        new Chart(chart, {
            type: 'line',
            data: {
                labels: earningDates,
                datasets: [{
                    label: 'Amount',
                    data: earningTotal,
                    backgroundColor: chart_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgb(9,23,133)',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            }, options: {
                layout: {
                    padding: {
                        bottom: -1, left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false,
                        },
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            console.log(tooltipItem)
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                            if (label) {
                                label += ': ';
                            }
                            if (tooltipItem.yLabel !== null) {
                                label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(tooltipItem.yLabel);
                            }
                            return label;
                        }
                    }
                }
            }
        });
    }

    function load_performance(period) {
        $('#earning_performance').show();
        var url = $('#dashboard_performance').val();
        $.ajax({
            type: 'get',
            url: url + '/' + period,
            dataType: 'json',

            success: function (response) {
                $('#earning_performance').hide();
                var month_year = [];
                var dates = [];
                var totals = [];


                $.each(response, function (index, value) {
                    var total = value.total;
                    var date = value.date ?? value.month;
                    totals.push(total);
                    dates.push(date);
                });

                if (isPerformanceChartLoaded){
                    performanceChart.destroy();
                    performanceChart = load_performance_chart(dates, totals);
                }else{
                    performanceChart = load_performance_chart(dates, totals);
                    isPerformanceChartLoaded = true;
                }
            }
        })
    }

    // Earning Performance Chart
    function load_performance_chart(dates, totals, id = "myChart") {
        var ctx = document.getElementById(id).getContext('2d');
        return new Chart(ctx, {
            type: 'line', data: {
                labels: dates, datasets: [{
                    label: 'Total Amount',
                    data: totals,
                    borderWidth: 2,
                    backgroundColor: 'rgba(63,82,227,.8)',
                    borderColor: 'transparent',
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'rgba(23,44,215,0.8)',
                    pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                }]
            }, options: {
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                            tickMarkLength: 15,
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            console.log(tooltipItem)
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                            if (label) {
                                label += ': ';
                            }
                            if (tooltipItem.yLabel !== null) {
                                label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(tooltipItem.yLabel);
                            }
                            return label;
                        }
                    }
                }
            }
        });
    }

    function removeData(chart) {
        chart.data.labels.pop();
        chart.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });
        chart.update();
    }

    function addData(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
        });
        chart.update();
    }


    // Site Statistics
    function loadData() {

        $.ajax({
            type: 'get',
            url: base_url + '/admin/dashboard/visitors/' + period,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                analytics_report(response.TotalVisitorsAndPageViews);
                top_browsers(response.TopBrowsers);
                Referrers(response.Referrers);
                TopPages(response.MostVisitedPages);
                $('#new_vistors').html(number_format(response.fetchUserTypes[0].sessions))
                $('#returning_visitor').html(number_format(response.fetchUserTypes[1].sessions))
            }
        })

    }

    function analytics_report(data) {
        var statistics_chart = document.getElementById("google_analytics").getContext('2d');
        var labels = [];
        var visitors = [];
        var pageViews = [];
        var total_visitors = 0;
        var total_page_views = 0;
        $.each(data, function (index, value) {
            labels.push(value.date);
            visitors.push(value.visitors);
            pageViews.push(value.pageViews);
            var total_visitor = total_visitors + value.visitors;
            total_visitors = total_visitor;
            var total_page_view = total_page_views + value.pageViews;
            total_page_views = total_page_view;
        });

        $('#total_visitors').html(number_format(total_visitors));
        $('#total_page_views').html(number_format(total_page_views));

        var myChart = new Chart(statistics_chart, {
            type: 'line', data: {
                labels: labels, datasets: [{
                    label: 'Visitors',
                    data: visitors,
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }, {
                    label: 'PageViews',
                    data: pageViews,
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }]
            }, options: {
                legend: {
                    display: false
                }, scales: {
                    yAxes: [{
                        gridLines: {
                            display: false, drawBorder: false,
                        }, ticks: {
                            stepSize: 150
                        }
                    }], xAxes: [{
                        gridLines: {
                            color: '#fbfbfb', lineWidth: 2
                        }
                    }]
                },
            }
        });

    }

    function Referrers(data) {
        $('#refs').html('');
        $.each(data, function (index, value) {
            var html = '<div class="mb-4"> <div class="text-small float-right font-weight-bold text-muted">' + number_format(value.pageViews) + '</div><div class="font-weight-bold mb-1">' + value.url + '</div></div><hr>';

            $('#refs').append(html);
        });
    }

    function top_browsers(data) {
        $('#browsers').html('');
        $.each(data, function (index, value) {
            var browser_name = value.browser;
            if (browser_name == 'Edge') {
                var browser_name = 'internet-explorer';
            }
            var html = ' <div class="col text-center"> <div class="browser browser-' + lower(browser_name) + '"></div><div class="mt-2 font-weight-bold">' + value.browser + '</div><div class="text-muted text-small"><span class="text-primary"></span> ' + number_format(value.sessions) + '</div></div>';
            $('#browsers').append(html);
            if (index == 4) {
                return false;
            }
        });
    }

    function TopPages(data) {
        $('#table-body').html('');
        $.each(data, function (index, value) {
            var index = index + 1;


            var html = '<div class="mb-4"> <div class="text-small float-right font-weight-bold text-muted">' + number_format(value.pageViews) + ' (Views)</div><div class="font-weight-bold mb-1"><a href="' + site_url + value.url + '" target="_blank" draggable="false">' + value.pageTitle + '</a></div></div>';
            $('#table-body').append(html);

        });
    }

    function lower(str) {
        var str = str.toLowerCase();
        var str = str.replace(' ', str);
        return str;
    }

    function number_format(number) {
        var num = new Intl.NumberFormat({maximumSignificantDigits: 3}).format(number);
        return num;
    }

})(jQuery);
