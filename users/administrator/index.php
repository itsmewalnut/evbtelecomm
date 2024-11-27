<?php
require('../../database/db_conn.php');
session_start();

if ($_SESSION['role'] == "ADMINISTRATOR") {

    $sql = mysqli_query($conn, "SELECT COUNT(*) AS globe_account FROM globe_table");
    while ($row = $sql->fetch_assoc()) {
        $globe_account = $row['globe_account'];
    }

    $sql = mysqli_query($conn, "SELECT COUNT(*) AS smart_account FROM smart_table");
    while ($row = $sql->fetch_assoc()) {
        $smart_account = $row['smart_account'];
    }

    $sql = mysqli_query($conn, "SELECT COUNT(*) AS pldt_account FROM pldt_table");
    while ($row = $sql->fetch_assoc()) {
        $pldt_account = $row['pldt_account'];
    }

    $overall_account = $globe_account + $smart_account + $pldt_account;
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="../../image/EVBGOC.png" />
        <title><?php echo $_SESSION['role']; ?> | Dashboard</title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
        <!-- Nucleo Icons -->
        <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
        <style>
            .upcomingBG {
                background-size: cover;
                background-position: center;
                /* backdrop-filter: blur(50px); */
                width: 100%;
                height: 100%;
            }

            .dark-version .upcomingBG {
                background-size: cover;
                background-position: center;
                width: 100%;
                height: 100%;
            }

            #upcomingCarousel .carousel-indicators li {
                background-color: #fff;
                border-radius: 50%;
                width: 7px;
                height: 7px;
                margin: 0 3px;
                opacity: 0.3;
            }

            #upcomingCarousel .carousel-indicators .active {
                background-color: #fff;
                opacity: 0.8;
            }
        </style>
    </head>

    <body class="g-sidenav-show bg-gray-200">
        <!-- Sidebar -->
        <?php include "../../sidebar.php" ?>
        <!-- End Sidebar -->

        <main
            class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <!-- Navbar -->
            <?php include "../../navbar.php" ?>
            <!-- End Navbar -->

            <!-- main content -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark border-radius-xl mt-n4 position-absolute d-flex justify-content-center align-items-center">
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/globe1.png" alt="spotify_logo">
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total Accounts</p>
                                    <h4 class="mb-0" id="globe_count" countto="<?php echo $globe_account; ?>"><?php echo $globe_account; ?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0" />
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    <a href="globe"><span class="text-info text-sm font-weight-bolder">GLOBE</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark border-radius-xl mt-n4 position-absolute d-flex justify-content-center align-items-center">
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/smart1.png" alt="spotify_logo">
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total Accounts</p>
                                    <h4 class="mb-0" id="smart_count" countto="<?php echo $smart_account; ?>"><?php echo $smart_account; ?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0" />
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    <a href="smart"><span class="text-success text-sm font-weight-bolder">SMART</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark border-radius-xl mt-n4 position-absolute d-flex justify-content-center align-items-center">
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/pldt1.png" alt="spotify_logo">
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total Accounts</p>
                                    <h4 class="mb-0" id="pldt_count" countto="<?php echo $pldt_account; ?>"><?php echo $pldt_account; ?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0" />
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    <a href="pldt"><span class="text-danger text-sm font-weight-bolder">PLDT</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark border-radius-xl mt-n4 position-absolute d-flex justify-content-center align-items-center">
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/simcard.png" alt="spotify_logo">
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Overall Accounts</p>
                                    <h4 class="mb-0" id="overall_count" countto="<?php echo $overall_account; ?>"><?php echo $overall_account; ?></h4>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0" />
                            <div class="card-footer p-3">
                                <p class="mb-0">
                                    <span class="text-sm font-weight-bolder">OVERALL</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">GLOBE STATUS</h6>
                                    <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See the status per network">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-3 py-7 pt-4">
                                <?php include('../../charts/globe_chart.php') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">SMART STATUS</h6>
                                    <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See the status per network">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-3 py-7 pt-4">
                                <?php include('../../charts/smart_chart.php') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">PLDT STATUS</h6>
                                    <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See the status per network">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-3 py-7 pt-4">
                                <?php include('../../charts/pldt_chart.php') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="col-lg-6 col-7">
                                    <h6>Due Date</h6>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <?php include('../../query/administrator/duedate_calendar.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card bg-gradient-dark h-100">
                            <div class="card-header bg-transparent pb-0">
                                <h6 class="text-white">Activity Log</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side" id="timeline_container">
                                    <!-- Timeline entries will be added here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end main content -->

            <div class="modal fade" id="upcoming" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Upcoming Due Dates</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="upcomingCarousel" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators" id="carouselIndicators"></ol>
                                <div class="carousel-inner" id="carouselUpcoming"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include "../../footer.php" ?>

        </main>
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" id="toggle-dark-mode">
                <i class="material-icons py-2" id="light-mode-icon">light_mode</i>
                <i class="material-icons py-2" id="dark-mode-icon">dark_mode</i>
            </a>
        </div>

        <!-- Scripts -->
        <?php include "../../important_scripts/script_dashboard.php" ?>

        <script>
            var win = navigator.platform.indexOf("Win") > -1;
            if (win && document.querySelector("#sidenav-scrollbar")) {
                var options = {
                    damping: "0.5",
                };
                Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../../logout.php");
}
?>