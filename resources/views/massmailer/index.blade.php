<!doctype html>
<html lang="en">
@include('massmailer.components.head')

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
        @include('massmailer.components.loadingpage')

        @include('massmailer.components.nav', ['active' => 'mailhome'])

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">

                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Dashboard
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center"> Lead Breakdown by Employee </h2>
                                    <div id="chart-tasks-overview"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center"> Email Outreach Summary </h2>
                                    <div id="chart-completion-tasks-10"></div>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center"> Email Campaigns by Service Offering </h2>
                                    <div id="chart-tasks-overview-01"></div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
            @include('massmailer.components.footer')
        </div>
    </div>
    @include('massmailer.components.script')

    <script>
        // Email Outreach Summary
        document.addEventListener("DOMContentLoaded", function() {

            fetch('/getemailsoverview')
                .then(response => response.json())
                .then(data => {

                    const formattedLabels = data.labels.map(dateString => {
                        const date = new Date(dateString);
                        const options = {
                            day: '2-digit',
                            month: 'short',
                        };
                        const formatted = new Intl.DateTimeFormat('en-PH', options).format(date);
                        return formatted.toUpperCase();
                    });

                    const colors = ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b'];

                    if (window.ApexCharts) {
                        new ApexCharts(document.getElementById('chart-completion-tasks-10'), {
                            chart: {
                                type: "area",
                                fontFamily: 'inherit',
                                height: 380,
                                parentHeightOffset: 0,
                                toolbar: {
                                    show: false,
                                },
                                animations: {
                                    enabled: true
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            fill: {
                                opacity: .16,
                                type: 'solid'
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                                curve: "smooth",
                            },
                            series: data.series,
                            tooltip: {
                                theme: 'dark'
                            },
                            grid: {
                                padding: {
                                    top: -20,
                                    right: 0,
                                    left: -4,
                                    bottom: -4
                                },
                                strokeDashArray: 4,
                            },
                            xaxis: {
                                labels: {
                                    padding: 0,
                                },
                                tooltip: {
                                    enabled: false
                                },
                                axisBorder: {
                                    show: false,
                                },
                                type: 'category',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: formattedLabels,
                            colors: colors.slice(0, data.series.length),
                            legend: {
                                show: true,
                            },
                        }).render();
                    }
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        });

        // Leads Overview
        document.addEventListener("DOMContentLoaded", function() {

            fetch('/getLeadsoverview')
                .then(response => response.json())
                .then(data => {

                    const categories = data.categories;
                    const leadCounts = data.series[0].data;

                    if (categories.length && leadCounts.length) {

                        if (window.ApexCharts) {
                            new ApexCharts(document.getElementById('chart-tasks-overview'), {
                                chart: {
                                    type: "bar",
                                    fontFamily: 'inherit',
                                    height: 380,
                                    parentHeightOffset: 0,
                                    toolbar: {
                                        show: false,
                                    },
                                    animations: {
                                        enabled: true
                                    },
                                },
                                plotOptions: {
                                    bar: {
                                        columnWidth: '50%',
                                    }
                                },
                                dataLabels: {
                                    enabled: false,
                                },
                                fill: {
                                    opacity: 1,
                                },
                                series: [{
                                    name: "Leads",
                                    data: leadCounts
                                }],
                                tooltip: {
                                    theme: 'dark'
                                },
                                grid: {
                                    padding: {
                                        top: -20,
                                        right: 0,
                                        left: -4,
                                        bottom: -4
                                    },
                                    strokeDashArray: 4,
                                },
                                xaxis: {
                                    labels: {
                                        padding: 0,
                                    },
                                    tooltip: {
                                        enabled: false
                                    },
                                    axisBorder: {
                                        show: false,
                                    },
                                    categories: categories,
                                },
                                yaxis: {
                                    labels: {
                                        padding: 4
                                    },
                                },
                                colors: [tabler.getColor("primary")],
                                legend: {
                                    show: false,
                                },
                            }).render();
                        }
                    } else {
                        console.error("Invalid data structure or empty data received.");
                    }
                })
                .catch(error => {
                    console.error("Error fetching leads overview data:", error);
                });
        });

        //Email Campaigns by Service Offering
        // document.addEventListener("DOMContentLoaded", function() {

        //     fetch('/hehe')
        //         .then(response => response.json())
        //         .then(data => {

        //             const categories = data.categories;
        //             const leadCounts = data.series[0].data;

        //             if (categories.length && leadCounts.length) {

        //                 if (window.ApexCharts) {
        //                     new ApexCharts(document.getElementById('chart-tasks-overview'), {
        //                         chart: {
        //                             type: "bar",
        //                             fontFamily: 'inherit',
        //                             height: 380,
        //                             parentHeightOffset: 0,
        //                             toolbar: {
        //                                 show: false,
        //                             },
        //                             animations: {
        //                                 enabled: true
        //                             },
        //                         },
        //                         plotOptions: {
        //                             bar: {
        //                                 columnWidth: '50%',
        //                             }
        //                         },
        //                         dataLabels: {
        //                             enabled: false,
        //                         },
        //                         fill: {
        //                             opacity: 1,
        //                         },
        //                         series: [{
        //                             name: "Leads",
        //                             data: leadCounts
        //                         }],
        //                         tooltip: {
        //                             theme: 'dark'
        //                         },
        //                         grid: {
        //                             padding: {
        //                                 top: -20,
        //                                 right: 0,
        //                                 left: -4,
        //                                 bottom: -4
        //                             },
        //                             strokeDashArray: 4,
        //                         },
        //                         xaxis: {
        //                             labels: {
        //                                 padding: 0,
        //                             },
        //                             tooltip: {
        //                                 enabled: false
        //                             },
        //                             axisBorder: {
        //                                 show: false,
        //                             },
        //                             categories: categories,
        //                         },
        //                         yaxis: {
        //                             labels: {
        //                                 padding: 4
        //                             },
        //                         },
        //                         colors: [tabler.getColor("primary")],
        //                         legend: {
        //                             show: false,
        //                         },
        //                     }).render();
        //                 }
        //             } else {
        //                 console.error("Invalid data structure or empty data received.");
        //             }
        //         })
        //         .catch(error => {
        //             console.error("Error fetching leads overview data:", error);
        //         });
        // });
    </script>

</body>

</html>
