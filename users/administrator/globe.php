<?php
require('../../database/db_conn.php');
session_start();

$globe_BRANCH = mysqli_query($conn, "SELECT DISTINCT branch from globe_table");
$globe_RNAME = mysqli_query($conn, "SELECT DISTINCT register_name from globe_table");
$globe_ACCNO = mysqli_query($conn, "SELECT DISTINCT account_no from globe_table");
$globe_DUEDATE = mysqli_query($conn, "SELECT DISTINCT duedate from globe_table");

if ($_SESSION['role'] == "ADMINISTRATOR") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="../../image/EVBGOC.png" />
        <title><?php echo $_SESSION['role']; ?> | Globe</title>
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
        <link href="../../assets/css/avatar.css" rel="stylesheet" />
        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
                        <a class="nav-link text-white" href="dashboard">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Users</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                            Network
                        </h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-info" href="globe">
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
                            <div
                                class="text-white text-center me-2 d-flex align-items-center justify-content-center">
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
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Globe</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Globe</h6>
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
                                    <hr class="horizontal light mt-0 mb-" />
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex align-items-center py-1">
                                                <div class="my-auto">
                                                    <span class="material-icons">person</span>
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal mb-1"> Profile</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="my-auto">
                                                    <span class="material-icons">settings</span>
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal"> Settings</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
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
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Globe</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-3">

                                    <!-- Add New Account Button -->
                                    <?php
                                    if ($_SESSION["role"] == "ENCODER") {
                                        echo '<button class="btn btn-icon btn-3 btn-info" id="AddNewGlobe" type="button" data-bs-toggle="modal" data-bs-target="#addGlobe">
                                        <span class="btn-inner--icon"><i class="fa fa-user-plus"></i></span>
                                        <span class="btn-inner--text"> add new account</span>
                                    </button>';
                                    } else {
                                    }
                                    ?>

                                    <!-- Filterting -->
                                    <form id="accountSearchForm" method="POST">
                                        <div class="row p-1">
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterBRANCH" class="ms-0">Select Branch</label>
                                                    <select class="form-control" name="filterBRANCH" id="filterBRANCH">
                                                        <option value="" selected>Branch</option>
                                                        <?php while ($globeBRANCH = mysqli_fetch_assoc($globe_BRANCH)) { ?>
                                                            <option value="<?php echo $globeBRANCH['branch']; ?>"><?php echo $globeBRANCH['branch']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterRNAME" class="ms-0">Select Register Name</label>
                                                    <select class="form-control" name="filterRNAME" id="filterRNAME">
                                                        <option value="" selected>Name</option>
                                                        <?php while ($globeRNAME = mysqli_fetch_assoc($globe_RNAME)) { ?>
                                                            <option value="<?php echo $globeRNAME['register_name']; ?>"><?php echo $globeRNAME['register_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterACCNO" class="ms-0">Select Account No</label>
                                                    <select class="form-control" name="filterACCNO" id="filterACCNO">
                                                        <option value="" selected>Account No</option>
                                                        <?php while ($globeACCNO = mysqli_fetch_assoc($globe_ACCNO)) { ?>
                                                            <option value="<?php echo $globeACCNO['account_no']; ?>"><?php echo $globeACCNO['account_no']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row p-1">

                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterDUEDATE" class="ms-0">Select Duedate</label>
                                                    <select class="form-control" name="filterDUEDATE" id="filterDUEDATE">
                                                        <option value="" selected>Duedate</option>
                                                        <?php while ($globeDUEDATE = mysqli_fetch_assoc($globe_DUEDATE)) { ?>
                                                            <option value="<?php echo $globeDUEDATE['duedate']; ?>"><?php echo $globeDUEDATE['duedate']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterACCSTATUS" class="ms-0">Select Account Status</label>
                                                    <select class="form-control" name="filterACCSTATUS" id="filterACCSTATUS">
                                                        <option value="" selected>Account Status</option>
                                                        <option value="ACTIVE">ACTIVE</option>
                                                        <option value="INACTIVE">INACTIVE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterSTATUS" class="ms-0">Select Status</label>
                                                    <select class="form-control" name="filterSTATUS" id="filterSTATUS">
                                                        <option value="" selected>Status</option>
                                                        <option value="UNPAID">UNPAID</option>
                                                        <option value="PAID">PAID</option>
                                                        <option value="TRANSMITTED">TRANSMITTED</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Search Button -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" id="filterTable" class="btn btn-icon btn-3 btn-success w-100">
                                                    <span class="btn-inner--icon"><i class="fa fa-search"></i></span>
                                                    <span class="btn-inner--text"> search</span>
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" id="resetTable" class="btn btn-icon btn-3 bg-gradient-secondary w-100">
                                                    <span class="btn-inner--icon"><i class="fa fa-undo"></i></span>
                                                    <span class="btn-inner--text"> reset</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="networkType" value="globe">
                                        </div>
                                    </form>
                                    <!-- END OF Filterting -->

                                    <table id="globeTable" class="table align-items-center mb-0" data-order='[[ 0, "desc" ]]'>
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">globe id</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">branch</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">register name</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">account no</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">register no</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">due date</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">account status</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">final status</th>
                                                <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder opacity-8">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Account Modal -->
            <div class="modal fade" id="addGlobe" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="addGlobe-title">Add New Account</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addGlobe_form" enctype="multipart/form-data" method="post">
                                <div class="row mt-4">
                                    <div class="mx-auto position-relative">
                                        <div class="card">
                                            <div class="card-header p-0 position-relative mt-n4 mx-2 z-index-2">
                                                <div class="bg-gradient-info shadow-info border-radius-lg py-2 pe-1">
                                                    <h5 class="text-white font-weight-bolder px-3 mt-2">Account Information</h5>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2">
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="input-group input-group-static mb-4">
                                                            <label for="acc_Branch" class="ms-0">Branch</label>
                                                            <select class="form-control" name="acc_Branch" id="acc_Branch">
                                                                <option value="" selected>Select Branch</option>
                                                                <option value="HEAD OFFICE">HEAD OFFICE</option>
                                                                <option value="EVB BILLS PAYMENT & REMITTANCE SERVICES">EVB BILLS PAYMENT & REMITTANCE SERVICES</option>
                                                                <option value="EVB LIPA BRANCH">EVB LIPA BRANCH</option>
                                                                <option value="EVB LEMERY BRANCH">EVB LEMERY BRANCH</option>
                                                                <option value="EVB BIÑAN BRANCH">EVB BIÑAN BRANCH</option>
                                                                <option value="EVB TAYTAY BRANCH">EVB TAYTAY BRANCH</option>
                                                                <option value="EVB CALAPAN BRANCH">EVB CALAPAN BRANCH</option>
                                                                <option value="EVB CAINTA BRANCH">EVB CAINTA BRANCH</option>
                                                                <option value="EVB INTRAMUROS BRANCH">EVB INTRAMUROS BRANCH</option>
                                                                <option value="EVB KALIBO BRANCH">EVB KALIBO BRANCH</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Account No</label>
                                                            <input type="number" name="accountNO" id="accountNO" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Register No</label>
                                                            <input type="number" name="registerNO" id="registerNO" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Register Name</label>
                                                            <input type="text" name="registerName" id="registerName" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="accountStatus" class="ms-0">Account Status</label>
                                                            <select class="form-control" name="accountStatus" id="accountStatus">
                                                                <option value="" selected>Select Account Status</option>
                                                                <option value="ACTIVE">ACTIVE</option>
                                                                <option value="INACTIVE">INACTIVE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="finalStatus" class="ms-0">Final Status</label>
                                                            <select class="form-control" name="finalStatus" id="finalStatus">
                                                                <option value="" selected>Select Final Status</option>
                                                                <option value="UNPAID">UNPAID</option>
                                                                <option value="TRANSMITTED">TRANSMITTED</option>
                                                                <option value="PAID">PAID</option>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group input-group-static">
                                                            <label for="acc_type" class="ms-0">Types of Account</label>
                                                            <select class="form-control" name="acc_type" id="acc_type">
                                                                <option value="" selected>Select Account Type</option>
                                                                <option value="POSTPAID">POSTPAID</option>
                                                                <option value="PREPAID">PREPAID</option>
                                                                <option value="LANDLINE">LANDLINE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-static textive">
                                                            <label>Due Date</label>
                                                            <input class="form-control datetimepicker" name="dueDate" id="dueDate" type="text" autocomplete="off" data-input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-static textive">
                                                            <label>Acquisition Date</label>
                                                            <input class="form-control datetimepicker" name="acqui_date" id="acqui_date" type="text" autocomplete="off" data-input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mx-auto position-relative mt-5 mb-4">
                                        <div class="card">
                                            <div class="card-header p-0 position-relative mt-n4 mx-2 z-index-2">
                                                <div class="bg-gradient-info shadow-info border-radius-lg py-2 pe-1">
                                                    <h5 class="text-white font-weight-bolder px-3 mt-2">Other Details</h5>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2">
                                                <div class="row mt-4">
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Register Address</label>
                                                            <input type="text" name="register_add" id="register_add" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Username</label>
                                                            <input type="text" name="globe_username" id="globe_username" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Password</label>
                                                            <input type="text" name="globe_password" id="globe_password" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Monthly</label>
                                                            <input type="number" name="accMonthly" id="accMonthly" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Email</label>
                                                            <input type="email" name="accEmail" id="accEmail" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static mb-4 textive">
                                                            <label>Phone</label>
                                                            <input type="text" name="accPhone" id="accPhone" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static textive">
                                                            <label>Serial No</label>
                                                            <input type="text" name="acc_serialno" id="acc_serialno" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static textive">
                                                            <label>IMEI 1</label>
                                                            <input type="number" name="accImei1" id="accImei1" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-static textive">
                                                            <label>IMEI 2</label>
                                                            <input type="number" name="accImei2" id="accImei2" class="form-control" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <h5>Remarks</h5>
                                        <div class="input-group input-group-dynamic">
                                            <textarea class="multisteps-form__textarea form-control" rows="3" placeholder="Say a few words about your remarks"></textarea>
                                        </div>
                                    </div> -->
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" value="Submit"></input>
                            <input type="hidden" name="networkType" id="networkType" value="Globe">
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="networkID" id="networkID" value="">
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Account Modal -->
            <div class="modal fade" id="viewGlobe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="viewGlobe_title">Account Information</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 text-center">
                                    <figure>
                                        <a href="../../assets/img/products/product-details-1.jpg" target="_blank" data-size="500x600">
                                            <img class="w-100 border-radius-lg shadow-lg mx-auto" src="../../assets/img/products/product-details-1.jpg" alt="Image description">
                                        </a>
                                    </figure>
                                    <div class="my-gallery d-flex mt-4 pt-2">
                                        <figure>
                                            <a href="../../assets/img/products/product-details-2.jpg" data-size="500x600">
                                                <img class="w-100 min-height-100 max-height-100 border-radius-lg shadow" src="../../assets/img/products/product-details-2.jpg" alt="Image description" />
                                            </a>
                                        </figure>
                                        <figure class="ms-3">
                                            <a href="../../assets/img/products/product-details-3.jpg" data-size="500x600">
                                                <img class="w-100 min-height-100 max-height-100 border-radius-lg shadow" src="../../assets/img/products/product-details-3.jpg" itemprop="thumbnail" alt="Image description" />
                                            </a>
                                        </figure>
                                        <figure class="ms-3">
                                            <a href="../../assets/img/products/product-details-4.jpg" data-size="500x600">
                                                <img class="w-100 min-height-100 max-height-100 border-radius-lg shadow" src="../../assets/img/products/product-details-4.jpg" itemprop="thumbnail" alt="Image description" />
                                            </a>
                                        </figure>
                                        <figure class="ms-3">
                                            <a href="../../assets/img/products/product-details-5.jpg" data-size="500x600">
                                                <img class="w-100 min-height-100 max-height-100 border-radius-lg shadow" src="../../assets/img/products/product-details-5.jpg" itemprop="thumbnail" alt="Image description" />
                                            </a>
                                        </figure>
                                    </div>

                                    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                                        <div class="pswp__bg"></div>

                                        <div class="pswp__scroll-wrap">


                                            <div class="pswp__container">
                                                <div class="pswp__item"></div>
                                                <div class="pswp__item"></div>
                                                <div class="pswp__item"></div>
                                            </div>

                                            <div class="pswp__ui pswp__ui--hidden">
                                                <div class="pswp__top-bar">

                                                    <div class="pswp__counter"></div>
                                                    <button class="btn btn-white btn-sm pswp__button pswp__button--close">Close (Esc)</button>
                                                    <button class="btn btn-white btn-sm pswp__button pswp__button--fs">Fullscreen</button>
                                                    <button class="btn btn-white btn-sm pswp__button pswp__button--arrow--left">Prev
                                                    </button>
                                                    <button class="btn btn-white btn-sm pswp__button pswp__button--arrow--right">Next
                                                    </button>


                                                    <div class="pswp__preloader">
                                                        <div class="pswp__preloader__icn">
                                                            <div class="pswp__preloader__cut">
                                                                <div class="pswp__preloader__donut"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                                    <div class="pswp__share-tooltip"></div>
                                                </div>
                                                <div class="pswp__caption">
                                                    <div class="pswp__caption__center"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mx-auto">
                                    <div class="d-flex gap-2">
                                        <h3 class="mt-lg-0 mt-4" id="acc_name"></h3>
                                        <span class="badge my-auto" id="acc_status"></span>
                                    </div>
                                    <div class="rating">
                                        <h6 class="opacity-8 text-sm" id="acc_branch"></h6>
                                    </div>
                                    <h6 class="mb-0 mt-4">Duedate:</h6>
                                    <h5 id="acc_duedate"></h5>
                                    <h6 class="mt-4">Remarks:</h6>
                                    <h6 class="mb-0" id="acc_remarks"></h6>
                                    <div class="row mt-4">
                                        <div class="overflow-hidden position-relative border-radius-xl">
                                            <img src="../../assets/img/illustrations/pattern-tree.svg" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                                            <span class="mask bg-gradient-dark opacity-10"></span>
                                            <div class="card-body position-relative z-index-1 p-3">
                                                <i class="material-icons text-white p-2">wifi</i>
                                                <!-- <h5 class="text-white mt-3 pb-2" id="acc_no"></h5> -->
                                                <div class="d-flex mt-3">
                                                    <div class="me-6">
                                                        <p class="text-white text-sm opacity-8 mb-0">Paid Amount</p>
                                                        <h6 class="text-white mb-0" id="acc_amount"></h6>
                                                    </div>
                                                    <div class="ms-1">
                                                        <p class="text-white text-sm opacity-8 mb-0">Payment Plan</p>
                                                        <h6 class="text-white mb-0" id="acc_billing"></h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-3">
                                                    <div class="me-5">
                                                        <p class="text-white text-sm opacity-8 mb-0">Date of Paid</p>
                                                        <h6 class="text-white mb-0" id="acc_datepaid"></h6>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="text-white text-sm opacity-8 mb-0">Status</p>
                                                        <h6 class="text-white mb-0" id="acc_finalstatus"></h6>
                                                    </div>
                                                    <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                        <img class="w-60 mt-2" src="../../assets/img/logos/mastercard.png" alt="logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Paid Button -->
                                    <?php
                                    if ($_SESSION["role"] == "ENCODER") {
                                        echo '<div class="row mt-4">
                                                <div class="col-lg-5">
                                                    <button class="btn bg-gradient-info mb-0 mt-lg-auto w-100" type="button" name="button" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                        <span class="btn-inner--icon"><i class="material-icons">payments</i>
                                                        </span> pay
                                                    </button>
                                                </div>
                                            </div>';
                                    } else {
                                    }
                                    ?>
                                    <!------------->

                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div class="card h-100">
                                        <div class="card-header pb-0 p-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="mb-0">Other Details</h6>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                                    <i class="material-icons me-2 text-lg">date_range</i>
                                                    <small id="acc_acqdate"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">person</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Account No</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_no"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">mail</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Email</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_email"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">call</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Register No</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_rno"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">person_pin_circle</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Register Address</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_address"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">account_circle</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Username</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_username"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">lock</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Password</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_password"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">phone_iphone</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Phone</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_phone"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">dialpad</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Serial No</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_sno"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">tag</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">IMEI 1</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_imei1"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-info mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">tag</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">EMEI 2</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_imei2"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3" />
                                                        </li>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!----------------------------------------Payment Modal------------------------------------->
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel2">Payment Transaction</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="payment_form" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static">
                                            <label>Date of Paid</label>
                                            <input class="form-control datetimepicker" name="paid_date" id="paid_date" type="text" data-input>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4 textive">
                                            <label>Paid Amount</label>
                                            <input type="number" name="paid_amount" id="paid_amount" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <h5>Attachments</h5>
                                <div class="dropzone" id="dropzone">
                                    <div class="input-group input-group-dynamic">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-3">Remarks</h5>
                                <div class="input-group input-group-dynamic">
                                    <textarea class="multisteps-form__textarea form-control" rows="3" placeholder="Say a few words about your remarks"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-target="#viewGlobe" data-bs-toggle="modal">Back</button>
                                <button type="submit" id="submit_payment" class="btn bg-gradient-warning">Paid</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!----------------------------------------End Payment Modal------------------------------------->

            <!-- Delete Account Modal -->
            <div class="modal fade" id="deleteGlobe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Delete Account</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="deleteGlobeForm" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">
                                <h5 id="deleteMessage"></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                                <input type="hidden" name="deleteNetworkType" id="deleteNetworkType" value="globe">
                                <input type="hidden" name="deleteGlobeID" id="deleteGlobeID">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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

            <!-- end main content -->
        </main>

        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" id="toggle-dark-mode">
                <i class="material-icons py-2" id="light-mode-icon">light_mode</i>
                <i class="material-icons py-2" id="dark-mode-icon">dark_mode</i>
            </a>
        </div>

        <!--   Core JS Files   -->
        <script src="../../assets/js/core/popper.min.js"></script>
        <script src="../../assets/js/core/bootstrap.min.js"></script>
        <script src="../../assets/js/core/choices.min.js"></script>
        <script src="../../assets/js/core/quill.min.js"></script>
        <script src="../../assets/js/core/flatpickr.min.js"></script>
        <script src="../../plugins/dropzone/dropzone.js"></script>
        <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="../../assets/js/plugins/photoswipe.min.js"></script>
        <script src="../../assets/js/plugins/photoswipe-ui-default.min.js"></script>
        <script>
            var win = navigator.platform.indexOf("Win") > -1;
            if (win && document.querySelector("#sidenav-scrollbar")) {
                var options = {
                    damping: "0.5",
                };
                Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
            }
        </script>
        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../../plugins/jszip/jszip.min.js"></script>
        <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../../assets/js/material-dashboard.min.js?v=3.1.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="backend/globe.js"></script>
        <script src="../../backend/logout.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: ../../logout.php");
}
?>