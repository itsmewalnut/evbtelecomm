<?php
require('../../database/db_conn.php');
session_start();

if ($_SESSION['role'] == "ENCODER" || $_SESSION['role'] == "CHECKER") {

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
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    </head>

    <body class="g-sidenav-show bg-gray-200">
        <aside
            class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
            id="sidenav-main">
            <div class="sidenav-header">
                <i
                    class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                    aria-hidden="true"
                    id="iconSidenav"></i>
                <a
                    class="navbar-brand m-0"
                    href="dashboard">
                    <div class="d-flex justify-content-center align-items-center">
                        <img
                            src="../../image/HomeLogo.png"
                            class="object-fit-cover w-75"
                            alt="main_logo" />
                    </div>
                </a>
            </div>
            <hr class="horizontal light mt-0 mb-2" />
            <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                            Home page
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-secondary" href="dashboard">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                            Network
                        </h6>
                    </li>
                    <!-- <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white active collapsed" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                            <i class="material-icons-round opacity-10">dashboard</i>
                            <span class="nav-link-text ms-2 ps-1">Dashboards</span>
                        </a>
                        <div class="collapse" id="dashboardsExamples" style="">
                            <ul class="nav ">
                                <li class="nav-item active">
                                    <a class="nav-link text-white active" href="../../pages/dashboards/analytics.html">
                                        <span class="sidenav-mini-icon"> A </span>
                                        <span class="sidenav-normal  ms-2  ps-1"> Analytics </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="../../pages/dashboards/discover.html">
                                        <span class="sidenav-mini-icon"> D </span>
                                        <span class="sidenav-normal  ms-2  ps-1"> Discover </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="../../pages/dashboards/sales.html">
                                        <span class="sidenav-mini-icon"> S </span>
                                        <span class="sidenav-normal  ms-2  ps-1"> Sales </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="../../pages/dashboards/automotive.html">
                                        <span class="sidenav-mini-icon"> A </span>
                                        <span class="sidenav-normal  ms-2  ps-1"> Automotive </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="../../pages/dashboards/smart-home.html">
                                        <span class="sidenav-mini-icon"> S </span>
                                        <span class="sidenav-normal  ms-2  ps-1"> Smart Home </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="globe">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">public</i>
                            </div>
                            <span class="nav-link-text ms-1">Globe</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="smart">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">sim_card</i>
                            </div>
                            <span class="nav-link-text ms-1">Smart</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="pldt">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">cell_tower</i>
                            </div>
                            <span class="nav-link-text ms-1">PLDT</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                            Account pages
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profile">
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="logout(event)">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">logout</i>
                            </div>
                            <span class="nav-link-text ms-1">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <main
            class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a href="dashboard"><i class="material-icons opacity-10">home</i></a></li>
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                    </nav>
                    <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        </div>
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item dropdown pe-2">
                                <a href="javascript:;" class="nav-link text-body p-0 position-relative" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $_SESSION['avatar']; ?>" class="avatar avatar-sm me-1 border-radius-lg d-sm-inline d-none" alt="user_avatar" onerror="this.src='../../image/avatar_thumbnail.png';">
                                    <span class="d-sm-inline d-none text-bold"><?php echo $_SESSION['role']; ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-2" style="width:250px" aria-labelledby="dropdownMenuButton">
                                    <div class="profile-pic p-3 d-flex justify-content-center align-items-center">
                                        <img src="<?php echo $_SESSION['avatar']; ?>" class="avatar avatar-xl me-1 border-radius-lg d-sm-inline d-none" alt="user_avatar" onerror="this.src='../../image/avatar_thumbnail.png';">
                                        <span class="d-sm-inline d-none text-bold"><?php echo $_SESSION['fullname']; ?></span>
                                    </div>
                                    <hr class="horizontal dark mt-0 mb-0" />
                                    <div class="p-3 text-center">
                                        <span class="d-sm-inline d-none text-bold badge bg-gradient-success"><?php echo $_SESSION['account_status']; ?></span>
                                        <br>
                                        <div class="mt-2">
                                            <span class="d-sm-inline d-none text-bold"><?php echo $_SESSION['department']; ?></span>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- main content -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark border-radius-xl mt-n4 position-absolute d-flex justify-content-center align-items-center">
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/globe.png" alt="spotify_logo">
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
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/smart.png" alt="spotify_logo">
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
                                    <img class="w-80 h-80" src="../../assets/img/small-logos/pldt.png" alt="spotify_logo">
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

            <footer class="footer py-4">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <a href="https://evbgroup.biz/" class="font-weight-bold" target="_blank">EVB Group of Companies</a>
                                All rights reserve.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul
                                class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <span class="text-sm font-weight-bold">Version 1.0.0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" id="toggle-dark-mode">
                <i class="material-icons py-2" id="light-mode-icon">light_mode</i>
                <i class="material-icons py-2" id="dark-mode-icon">dark_mode</i>
            </a>
        </div>

        <!--   Date fns   -->
        <script src="https://cdn.jsdelivr.net/npm/date-fns@latest"></script>
        <!--   Core JS Files   -->
        <script src="../../assets/js/core/popper.min.js"></script>
        <script src="../../assets/js/core/bootstrap.min.js"></script>
        <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="../../assets/js/plugins/countup.min.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../../assets/js/material-dashboard.min.js?v=3.1.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../backend/dashboard.js"></script>
        <script src="../../backend/logout.js"></script>
        <script src="../../backend/count.js"></script>

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