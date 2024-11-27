<?php
require('../../database/db_conn.php');
session_start();

$smart_BRANCH = mysqli_query($conn, "SELECT DISTINCT branch FROM smart_table");
$smart_RNAME = mysqli_query($conn, "SELECT DISTINCT register_name FROM smart_table");
$smart_ACCNO = mysqli_query($conn, "SELECT DISTINCT account_no FROM smart_table");
$smart_DUEDATE = mysqli_query($conn, "SELECT DISTINCT duedate FROM smart_table");

if ($_SESSION['role'] == "ADMINISTRATOR") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="../../image/EVBGOC.png" />
        <title><?php echo $_SESSION['role']; ?> | Smart</title>
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
        <link href="../../assets/css/avatar.css" rel="stylesheet" />
        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                        <a class="nav-link text-white" href="globe">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">public</i>
                            </div>
                            <span class="nav-link-text ms-1">Globe</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success" href="smart">
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
            <?php include "../../navbar.php" ?>
            <!-- End Navbar -->

            <!-- main content -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">SMART</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-3">

                                    <!-- Add New Account Button -->
                                    <?php
                                    if ($_SESSION["role"] == "ENCODER") {
                                        echo '<button class="btn btn-icon btn-3 btn-success" id="AddNewSmart" type="button" data-bs-toggle="modal" data-bs-target="#addSmart">
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
                                                        <?php while ($smartBRANCH = mysqli_fetch_assoc($smart_BRANCH)) { ?>
                                                            <option value="<?php echo $smartBRANCH['branch']; ?>"><?php echo $smartBRANCH['branch']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterRNAME" class="ms-0">Select Register Name</label>
                                                    <select class="form-control" name="filterRNAME" id="filterRNAME">
                                                        <option value="" selected>Name</option>
                                                        <?php while ($smartRNAME = mysqli_fetch_assoc($smart_RNAME)) { ?>
                                                            <option value="<?php echo $smartRNAME['register_name']; ?>"><?php echo $smartRNAME['register_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="filterACCNO" class="ms-0">Select Account No</label>
                                                    <select class="form-control" name="filterACCNO" id="filterACCNO">
                                                        <option value="" selected>Account No</option>
                                                        <?php while ($smartACCNO = mysqli_fetch_assoc($smart_ACCNO)) { ?>
                                                            <option value="<?php echo $smartACCNO['account_no']; ?>"><?php echo $smartACCNO['account_no']; ?></option>
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
                                                        <?php while ($smartDUEDATE = mysqli_fetch_assoc($smart_DUEDATE)) { ?>
                                                            <option value="<?php echo $smartDUEDATE['duedate']; ?>"><?php echo $smartDUEDATE['duedate']; ?></option>
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
                                            <input type="hidden" name="networkType" value="smart">
                                        </div>
                                    </form>
                                    <!-- END OF Filterting -->

                                    <table id="smartTable" class="table align-items-center mb-0" data-order='[[ 0, "desc" ]]'>
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">smart id</th>
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

            <!----------------------------------------SOA Modal------------------------------------->
            <!-- <div class="modal fade" id="viewSOA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Proof of Payment</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="pdf" id="attachment_container"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="offcanvas offcanvas-end" id="viewSOA" data-bs-scroll="false" tabindex="-1" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="pdf" id="attachment_container"></div>
                </div>
            </div>
            <!----------------------------------------End SOA Modal------------------------------------->

            <!-- View Account Modal -->
            <div class="modal fade" id="viewSmart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="viewSmart_title">Account Information</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 mx-auto mt-3">
                                    <img class="w-100" alt="Click here to View/Download" id="accImage">
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
                                            <img src="../../assets/img/illustrations/pattern-tree.svg" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1" alt="pattern-tree">
                                            <span class="mask bg-gradient-dark opacity-10"></span>
                                            <div class="card-body position-relative z-index-1 p-3">
                                                <i class="material-icons text-white p-2">wifi</i>
                                                <h5 class="text-white mt-3 mb-3 pb-2" id="acc_no"></h5>
                                                <div class="d-flex mt-3">
                                                    <div class="me-6">
                                                        <p class="text-white text-sm opacity-8 mb-0">Subscription</p>
                                                        <h6 class="text-white mb-0" id="acc_billing"></h6>
                                                    </div>
                                                    <div class="ms-1">
                                                        <p class="text-white text-sm opacity-8 mb-0">Paid Amount</p>
                                                        <h6 class="text-white mb-0" id="acc_amount"></h6>
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
                                        echo '<div class="row mt-4" id="PAID_BUTTON">
                                                <div class="col-lg-5">
                                                    <button class="btn bg-gradient-warning mb-0 mt-lg-auto w-100" type="button" id="payButton" name="button" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                        <span class="btn-inner--icon"><i class="material-icons">payments</i>
                                                        </span> paid
                                                    </button>
                                                </div>
                                            </div>';
                                    } else {
                                    }
                                    ?>
                                    <!------------->

                                    <!-- TRANSMIT Button -->
                                    <?php

                                    if ($_SESSION["role"] == "ENCODER") {
                                        echo '<div class="row mt-4" id="TRANSMIT_BUTTON">
                                                <div class="col-lg-5">
                                                    <button class="btn bg-gradient-success mb-0 mt-lg-auto w-100" type="button" id="transmitButton" name="button" data-bs-toggle="modal" data-bs-target="#transmitModal">
                                                        <span class="btn-inner--icon"><i class="material-icons">inventory</i>
                                                        </span> transmit
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">person</i></button>
                                                                    <div class="d-flex flex-column">
                                                                        <h6 class="mb-1 text-dark text-sm">Smart ID</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center text-sm font-weight-bold ms-auto" id="acc_id"></div>
                                                            </div>
                                                            <hr class="horizontal dark mt-3 mb-2" />
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <li class="list-group-item border-0 justify-content-between ps-0 border-radius-lg">
                                                            <div class="d-flex">
                                                                <div class="d-flex align-items-center">
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">mail</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">call</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">person_pin_circle</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">account_circle</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">lock</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">phone_iphone</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">dialpad</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">tag</i></button>
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
                                                                    <button class="btn btn-icon-only btn-rounded bg-gradient-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">tag</i></button>
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

            <!-- Delete Account Modal -->
            <div class="modal fade" id="deleteSmart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Delete Account</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="deleteSmartForm" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">
                                <h5 id="deleteMessage"></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                                <input type="hidden" name="deleteNetworkType" id="deleteNetworkType" value="smart">
                                <input type="hidden" name="deleteNetworkID" id="deleteNetworkID">
                                <input type="hidden" name="deleteNetworkNAME" id="deleteNetworkNAME">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include "../../footer.php" ?>

            <!-- end main content -->
        </main>

        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" id="toggle-dark-mode">
                <i class="material-icons py-2" id="light-mode-icon">light_mode</i>
                <i class="material-icons py-2" id="dark-mode-icon">dark_mode</i>
            </a>
        </div>

        <!-- Scripts -->
        <?php include "../../important_scripts/script_network.php" ?>
        <script src="backend/smart.js"></script>

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