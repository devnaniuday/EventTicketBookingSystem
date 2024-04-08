<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            Event Ticket Booking System
        </title>
        <!--     Fonts and icons     -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
            rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- CSS Files -->
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- MDB -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
        <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JS (bundle includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Datepicker CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css"
            rel="stylesheet">

        <!-- Bootstrap Datepicker JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

        <!-- Bootstrap Timepicker CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"
            rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap JavaScript (Make sure to include Popper.js and jQuery as well) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Timepicker JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/css/Animation.css') }}">

        <script async src="https://www.google.com/recaptcha/api.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="{{ asset('assets/js/validation.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="g-sidenav-show  bg-gray-100">
        <x-app.sidebar />

        {{ $slot }}
        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/chartjs.min.js"></script>
        <script src="../assets/js/plugins/swiper-bundle.min.js" type="text/javascript"></script>
        <script>
            if (document.getElementsByClassName('mySwiper')) {
                var swiper = new Swiper(".mySwiper", {
                    effect: "cards",
                    grabCursor: true,
                    initialSlide: 1,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            };


            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
                    datasets: [{
                            label: "Sales",
                            tension: 0.4,
                            borderWidth: 0,
                            borderSkipped: false,
                            backgroundColor: "#2ca8ff",
                            data: [450, 200, 100, 220, 500, 100, 400, 230, 500, 200],
                            maxBarThickness: 6
                        },
                        {
                            label: "Sales",
                            tension: 0.4,
                            borderWidth: 0,
                            borderSkipped: false,
                            backgroundColor: "#7c3aed",
                            data: [200, 300, 200, 420, 400, 200, 300, 430, 400, 300],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#1e293b',
                            bodyColor: '#1e293b',
                            borderColor: '#e9ecef',
                            borderWidth: 1,
                            usePointStyle: true
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            stacked: true,
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [4, 4],
                            },
                            ticks: {
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 12,
                                    family: "Noto Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#64748B"
                            },
                        },
                        x: {
                            stacked: true,
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    family: "Noto Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#64748B"
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(45,168,255,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(45,168,255,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(45,168,255,0)'); //blue colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(119,77,211,0.4)');
            gradientStroke2.addColorStop(0.7, 'rgba(119,77,211,0.1)');
            gradientStroke2.addColorStop(0, 'rgba(119,77,211,0)'); //purple colors

            new Chart(ctx2, {
                plugins: [{
                    beforeInit(chart) {
                        const originalFit = chart.legend.fit;
                        chart.legend.fit = function fit() {
                            originalFit.bind(chart.legend)();
                            this.height += 40;
                        }
                    },
                }],
                type: "line",
                data: {
                    labels: ["Aug 18", "Aug 19", "Aug 20", "Aug 21", "Aug 22", "Aug 23", "Aug 24", "Aug 25", "Aug 26",
                        "Aug 27", "Aug 28", "Aug 29", "Aug 30", "Aug 31", "Sept 01", "Sept 02", "Sept 03", "Aug 22",
                        "Sept 04", "Sept 05", "Sept 06", "Sept 07", "Sept 08", "Sept 09"
                    ],
                    datasets: [{
                            label: "Volume",
                            tension: 0,
                            borderWidth: 2,
                            pointRadius: 3,
                            borderColor: "#2ca8ff",
                            pointBorderColor: '#2ca8ff',
                            pointBackgroundColor: '#2ca8ff',
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [2828, 1291, 3360, 3223, 1630, 980, 2059, 3092, 1831, 1842, 1902, 1478, 1123,
                                2444, 2636, 2593, 2885, 1764, 898, 1356, 2573, 3382, 2858, 4228
                            ],
                            maxBarThickness: 6

                        },
                        {
                            label: "Trade",
                            tension: 0,
                            borderWidth: 2,
                            pointRadius: 3,
                            borderColor: "#832bf9",
                            pointBorderColor: '#832bf9',
                            pointBackgroundColor: '#832bf9',
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: [2797, 2182, 1069, 2098, 3309, 3881, 2059, 3239, 6215, 2185, 2115, 5430, 4648,
                                2444, 2161, 3018, 1153, 1068, 2192, 1152, 2129, 1396, 2067, 1215, 712, 2462,
                                1669, 2360, 2787, 861
                            ],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'end',
                            labels: {
                                boxWidth: 6,
                                boxHeight: 6,
                                padding: 20,
                                pointStyle: 'circle',
                                borderRadius: 50,
                                usePointStyle: true,
                                font: {
                                    weight: 400,
                                },
                            },
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#1e293b',
                            bodyColor: '#1e293b',
                            borderColor: '#e9ecef',
                            borderWidth: 1,
                            pointRadius: 2,
                            usePointStyle: true,
                            boxWidth: 8,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [4, 4]
                            },
                            ticks: {
                                callback: function(value, index, ticks) {
                                    return parseInt(value).toLocaleString() + ' EUR';
                                },
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 12,
                                    family: "Noto Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#64748B"
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [4, 4]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 12,
                                    family: "Noto Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#64748B"
                            }
                        },
                    },
                },
            });
        </script>
        <script src="{{ asset('assets/js/ajaxRequest.js') }}"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
    </body>

</html>
