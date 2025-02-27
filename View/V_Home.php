<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NadorCars | Dashboard </title>
    <link rel="stylesheet" href="../Style/bootstrap.min.css">
    <link rel="stylesheet" href="../Style/All.css">
    <link rel="stylesheet" href="../Style/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <script src="../Style/jquery.min.js"></script>
    <script src="../Style/jquery.min.js"></script>
    <link rel="stylesheet" href="../Style/fontawesome-free-6.3.0-web/css/all.css">
    <script src="../Style/assets/js/chart.min.js"></script>
    <link rel="stylesheet" href="../Style/RealoadpageAnimation.css">

    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: black;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }


        table {
            word-wrap: break-word;
        }

        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 52px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
            border: red;
            background-color: #e6dfdf;
        }

        /* Media Queries */
        @media (max-width: 767px) {

            /* Header */
            header.navbar {
                flex-wrap: wrap;
            }

            header .navbar-brand {
                margin-bottom: 10px;
                width: 100%;
                text-align: center;
            }

            header .navbar-toggler {
                margin-right: 15px;
            }

            /* Sidebar */
            nav#sidebarMenu {
                position: static;
                width: 100%;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body style="background-color: #e6dfdf;">
    <?php include("header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <script>
                window.addEventListener("load", function () {
                    const preloader = document.querySelector("#preloader");
                    preloader.classList.add("hide");
                });
            </script>
            <?php include('SideBarMenu.php') ?>
            <div id="preloader">
                <div id="loader"></div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2>Dashboard | <b>
                                            <?php
                                            $currentTime = date("H:i:s");
                                            if ($currentTime >= "06:00:00" && $currentTime < "18:00:00") {
                                                echo "Bonjour ";
                                            } else {
                                                echo "Bonsoir ";
                                            }
                                            echo $_SESSION["Admin"][0];
                                            ?>
                                        </b></h2>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Totale des voiture</h6><i class="fa-solid fa-car"></i>
                                    <h2 class="text-right"><span>
                                            <?php echo $nbCars ?>
                                        </span></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Voiture Disponible
                                    </h6><i class="fa-solid fa-square-parking"></i>
                                    <h2 class="text-right"><span>
                                            <?php echo $nbVoitureDisponible ?>
                                        </span></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Totale Reservation</h6>
                                    <i class="fa-solid fa-hourglass-end"></i>
                                    <h2 class="text-right"><span>
                                            <?php echo $nbReservation ?>
                                        </span></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Totale des Clients</h6>
                                    <i class="fa-solid fa-users"></i>
                                    <h2 class="text-right"><span>
                                            <?php echo $nbClient ?>
                                        </span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><canvas id="myChart" width="100%" height="40%"></canvas>
                    <script>
                        var data = <?php echo json_encode($data); ?>;
                        var options = {
                            responsive: true,
                            title: {
                                display: false,
                                text: 'Revenus pour chaque Model de Voiture'
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            scales: {
                                xAxes: [{
                                    stacked: true,
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Model des Voitures'
                                    }
                                }]
                                ,
                                yAxes: [{
                                    stacked: true,
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Revenue'
                                    }
                                }]
                            }
                        };
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.map(function (d) { return d.Model; }),
                                datasets: [{
                                    label: 'Revenus par Model',
                                    data: data.map(function (d) { return d.earnings; }),
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1,
                                    type: 'bar',
                                    fill: false
                                }]
                            },
                            options: options
                        });
                    </script>
            </div>
        </div>
    </div>
</body>

</html>