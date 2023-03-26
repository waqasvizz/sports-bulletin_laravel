jQuery(document).ready(function () {


    var dt_most_visited_pages_filter_table = $('.dt-most-visited-pages'),
        dt_top_referrers_filter_table = $('.dt-top-referrers'),
        dt_top_countires_filter_table = $('.dt-top-countires');

    var horizontalTopBrowserBarChartEx = $('.horizontal-top-browser-bar-chart-ex');
    // Color Variables
    var primaryColorShade = '#836AF9',
        yellowColor = '#ffe800',
        successColorShade = '#28dac6',
        warningColorShade = '#ffe802',
        warningLightColor = '#FDAC34',
        infoColorShade = '#299AFF',
        greyColor = '#4F5D70',
        blueColor = '#2c9aff',
        blueLightColor = '#84D0FF',
        greyLightColor = '#EDF1F4',
        tooltipShadow = 'rgba(0, 0, 0, 0.25)',
        lineChartPrimary = '#666ee8',
        lineChartDanger = '#ff4961',
        labelColor = '#6e6b7b',
        grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

    var mytickAmountLimit = 18;
    // console.log("window.innerWidth: "+window.innerWidth);
    if (window.innerWidth < 1688) {
        mytickAmountLimit = 18;
    }
    if (window.innerWidth < 768) {
        mytickAmountLimit = 10;
    }

    // Total visitors and page views line Area Chart
    // --------------------------------------------------------------------

    var areaChartEl = document.querySelector('#total-visitors-and-page-views-line-area-chart'),
        areaChartConfig = {
            chart: {
                height: 400,
                type: 'area',
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: false,
                curve: 'straight'
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'start'
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            // colors: ["#06774f", "#826af9", "#7eefc7", "#d2b0ff"],
            colors: ["#00E396", "#008FFB", "#84D0FF", "#FDAC34"],
            // colors: ["#ff00bf", "#299AFF", "#28dac6", "#836AF9"],
            // colors: ["#00E396", "#008FFB", "#ffe802", "#84D0FF"],
            // colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
            series: [
                {
                    name: 'Visitors',
                    data: visitorsDataProvider
                    // data: [100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270, 280, 375]
                },
                {
                    name: 'PageViews',
                    data: pageViewsDataProvider
                    // data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
                },
                {
                    name: 'PreviousVisitors',
                    data: previousVisitorsDataProvider
                    // data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
                },
                {
                    name: 'PreviousPageViews',
                    data: previousPageViewsDataProvider
                    // data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
                },
                // {
                // name: 'Sales',
                // data: [20, 40, 30, 70, 40, 60, 50, 140, 120, 100, 140, 180, 220]
                // }
            ],
            xaxis: {
                categories: datesDataProvider,
                // categories: [
                // '7/12',
                // '8/12',
                // '9/12',
                // '10/12',
                // '11/12',
                // '12/12',
                // '13/12',
                // '14/12',
                // '15/12',
                // '16/12',
                // '17/12',
                // '18/12',
                // '19/12',
                // '20/12'
                // ],
                title: {
                    text: 'Days'
                },
                tickAmount: mytickAmountLimit,
            },
            stroke: {
                // width: [5, 7],
                curve: 'smooth',
                // dashArray: [0, 8]
                dashArray: [0, 8, 8, 0]
            },
            fill: {
                opacity: 0.3,
                type: 'solid'
            },
            tooltip: {
                shared: false,
            },
            yaxis: {
                opposite: 'rtl',
                title: {
                    text: 'Views'
                }
            }
        };
    if (typeof areaChartEl !== undefined && areaChartEl !== null) {
        var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
        areaChart.render();
        areaChart.hideSeries("PreviousVisitors");
        areaChart.hideSeries("PreviousPageViews");
    }
    // --------------------------------------------------------------------




    // Doughnut User Types Chart
    // --------------------------------------------------------------------
    var doughnutUserTypeChartEx = $('.doughnut-user-type-chart-ex');
    if (doughnutUserTypeChartEx.length) {
        var doughnutExample = new Chart(doughnutUserTypeChartEx, {
            type: 'doughnut',
            options: {
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 500,
                cutoutPercentage: 60,
                legend: { display: false },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var label = data.datasets[0].labels[tooltipItem.index] || '',
                                value = data.datasets[0].data[tooltipItem.index];
                            var output = ' ' + label + ' : ' + value + ' %';
                            return output;
                        }
                    },
                    // Updated default tooltip UI
                    shadowOffsetX: 1,
                    shadowOffsetY: 1,
                    shadowBlur: 8,
                    shadowColor: tooltipShadow,
                    backgroundColor: window.colors.solid.white,
                    titleFontColor: window.colors.solid.black,
                    bodyFontColor: window.colors.solid.black
                }
            },
            data: {
                datasets: [
                    {
                        labels: doughnut_user_type_chart_ex_label,
                        data: doughnut_user_type_chart_ex_data,
                        backgroundColor: [successColorShade, warningLightColor, window.colors.solid.primary],
                        borderWidth: 0,
                        pointStyle: 'rectRounded'
                    }
                ]
            }
        });
    }

    // Horizontal Top Browsers Bar Chart
    // --------------------------------------------------------------------
    if (horizontalTopBrowserBarChartEx.length) {
        new Chart(horizontalTopBrowserBarChartEx, {
            type: 'horizontalBar',
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderSkipped: 'right'
                    }
                },
                tooltips: {
                    // Updated default tooltip UI
                    shadowOffsetX: 1,
                    shadowOffsetY: 1,
                    shadowBlur: 8,
                    shadowColor: tooltipShadow,
                    backgroundColor: window.colors.solid.white,
                    titleFontColor: window.colors.solid.black,
                    bodyFontColor: window.colors.solid.black
                },
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 500,
                legend: {
                    display: false
                },
                layout: {
                    padding: {
                        bottom: -30,
                        left: -25
                    }
                },
                scales: {
                    xAxes: [
                        {
                            display: true,
                            gridLines: {
                                zeroLineColor: grid_line_color,
                                borderColor: 'transparent',
                                color: grid_line_color
                            },
                            scaleLabel: {
                                display: true
                            },
                            ticks: {
                                min: 0,
                                fontColor: labelColor
                            }
                        }
                    ],
                    yAxes: [
                        {
                            display: true,
                            barThickness: 15,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: true
                            },
                            ticks: {
                                fontColor: labelColor
                            }
                        }
                    ]
                }
            },
            data: {
                labels: top_browser_bar_chart_label,
                // labels: ['MON', 'TUE', 'WED ', 'THU', 'FRI', 'SAT', 'SUN'],
                datasets: [
                    {
                        data: top_browser_bar_chart_data,
                        // data: [710, 350, 470, 580, 230, 460, 120],
                        backgroundColor: window.colors.solid.info,
                        borderColor: 'transparent'
                    }
                ]
            }
        });
    }

    // Top Countries Search
    // --------------------------------------------------------------------

    if (dt_top_countires_filter_table.length) {
        // Setup - add a text input to each footer cell
        $('.dt-top-countries thead tr').clone(true).appendTo('.dt-top-countries thead');
        $('.dt-top-countries thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (dt_top_countries_filter.column(i).search() !== this.value) {
                    dt_top_countries_filter.column(i).search(this.value).draw();
                }
            });
        });

        var dt_top_countries_filter = dt_top_countires_filter_table.DataTable({
            // ajax: assetPath + 'data/table-datatable.json',
            columns: [
                { data: 'sr_no' },
                { data: 'Sessions' },
                { data: 'Pageviews' },
                { data: 'Visitors' },
            ],
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            orderCellsTop: true,
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }

    // Top Referrers Search
    // --------------------------------------------------------------------

    if (dt_top_referrers_filter_table.length) {
        // Setup - add a text input to each footer cell
        $('.dt-top-referrers thead tr').clone(true).appendTo('.dt-top-referrers thead');
        $('.dt-top-referrers thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (dt_top_referrers_filter.column(i).search() !== this.value) {
                    dt_top_referrers_filter.column(i).search(this.value).draw();
                }
            });
        });

        var dt_top_referrers_filter = dt_top_referrers_filter_table.DataTable({
            // ajax: assetPath + 'data/table-datatable.json',
            columns: [
                { data: 'sr_no' },
                { data: 'url' },
                { data: 'view' },
                // { data: 'city' },
                // { data: 'start_date' },
                // { data: 'salary' }
            ],
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            orderCellsTop: true,
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }


    // Most Visited Pages Search
    // --------------------------------------------------------------------

    if (dt_most_visited_pages_filter_table.length) {
        // Setup - add a text input to each footer cell
        $('.dt-most-visited-pages thead tr').clone(true).appendTo('.dt-most-visited-pages thead');
        $('.dt-most-visited-pages thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (dt_most_visited_pages_filter.column(i).search() !== this.value) {
                    dt_most_visited_pages_filter.column(i).search(this.value).draw();
                }
            });
        });

        var dt_most_visited_pages_filter = dt_most_visited_pages_filter_table.DataTable({
            // ajax: assetPath + 'data/table-datatable.json',
            columns: [
                { data: 'sr_no' },
                { data: 'url' },
                { data: 'view' },
                // { data: 'city' },
                // { data: 'start_date' },
                // { data: 'salary' }
            ],
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            orderCellsTop: true,
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }
});
