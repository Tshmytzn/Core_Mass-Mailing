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

                        <div class="col-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center"> Leads Overview </h2>
                                    <div id="chart-tasks-overview"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-7">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center"> Employee Email Performance Overview </h2>
                                    <div id="chart-completion-tasks-10"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @include('massmailer.components.footer')
        </div>
    </div>
    @include('massmailer.components.script')

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-completion-tasks-10'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 420,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
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
                series: [{
                    name: "",
                    data: [155, 65, 465, 265, 225, 325, 80]
                }, {
                    name: "",
                    data: [113, 42, 65, 54, 76, 65, 35]
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
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24',
                    '2020-06-25', '2020-06-26'
                ],
                colors: [tabler.getColor("primary"), tabler.getColor("red")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-tasks-overview'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 420,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
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
                    name: "A",
                    data: [44, 32, 48, 72, 60, 16, 22]
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
                    categories: ['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4', 'Sprint 5', 'Sprint 6',
                        'Sprint 24'
                    ],
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
            })).render();
        });
        // @formatter:on
    </script>

</body>

</html>
