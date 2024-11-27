<?php
require('../../database/db_conn.php');
session_start();

if ($_SESSION['role'] == "ADMINISTRATOR") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="../../image/EVBGOC.png" />
        <title><?php echo $_SESSION['role']; ?> | Users</title>
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
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-secondary shadow-secondary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Users Information</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-3">

                                    <!-- Add User Button -->
                                    <button class="btn btn-icon btn-3 btn-dark" id="AddNewUser" type="button" data-bs-toggle="modal" data-bs-target="#addUser">
                                        <span class="btn-inner--icon"><i class="fa fa-user-plus"></i></span>
                                        <span class="btn-inner--text"> add new user</span>
                                    </button>

                                    <table id="userTable" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">user id</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">fullname</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">branch</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 ps-2">department</th>
                                                <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder opacity-8 ps-2">role</th>
                                                <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder opacity-8 ps-2">status</th>
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

            <!-- Add User Modal -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="adduser-title">Add New User</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="adduser_form" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                <img class="profile-user-img img-responsive img-circle w-100" id="imagePreview" src="../../image/avatar_thumbnail.png" alt="User profile picture" onerror="this.src='../../image/avatar_thumbnail.png';">
                                            </div>
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="account_avatar" id="account_avatar">
                                                <label for="imageUpload" class="d-flex justify-content-center align-items-center text-white"><i class="fas fa-camera"></i></label>
                                            </div>
                                        </div>
                                        <div class="fname">
                                            <h4 class="fname" id="fname"></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-7 ms-auto">
                                        <h5 class="py-2">Personal Information</h5>
                                        <div class="input-group input-group-dynamic mb-4 textive">
                                            <label class="form-label">Firstname</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="input-group input-group-dynamic mb-4 textive">
                                            <label class="form-label">Middlename</label>
                                            <input type="text" name="middlename" id="middlename" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="input-group input-group-dynamic mb-4 textive">
                                            <label class="form-label">Lastname</label>
                                            <input type="text" name="lastname" id="lastname" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="input-group input-group-static mb-4">
                                            <label for="role" class="ms-0">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="" selected>Select Role</option>
                                                <option value="ENCODER">ENCODER</option>
                                                <option value="CHECKER">CHECKER</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="bg-gradient-light mt-1">
                                    <div>
                                        <h5 class="py-2">Credentials</h5>
                                        <div class="col ms-auto">
                                            <div class="input-group input-group-dynamic mb-4 textive">
                                                <label class="form-label">Username</label>
                                                <input type="text" name="username" id="username" class="form-control" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col ms-auto">
                                            <div class="input-group input-group-static mb-4">
                                                <label for="branch" class="ms-0">Branch</label>
                                                <select class="form-control" name="branch" id="branch">
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
                                        <div class="col ms-auto">
                                            <div class="input-group input-group-static">
                                                <label for="exampleFormControlSelect1" class="ms-0">Department</label>
                                                <select class="form-control" name="department" id="department">
                                                    <option value="" selected>Select Department</option>
                                                    <option value="HUMAN RESOURCE DEPARTMENT">HUMAN RESOURCE DEPARTMENT</option>
                                                    <option value="ACCOUNTING DEPARTMENT">ACCOUNTING DEPARTMENT</option>
                                                    <option value="BOOKKEEPING DEPARTMENT">BOOKKEEPING DEPARTMENT</option>
                                                    <option value="INTEGRATED INFORMATION AND COMMUNICATION SYSTEM">INTEGRATED INFORMATION AND COMMUNICATION SYSTEM</option>
                                                    <option value="QUALITY CONTROL DEPARTMENT">QUALITY CONTROL DEPARTMENT</option>
                                                    <option value="DOCUMENTATION DEPARTMENT">DOCUMENTATION DEPARTMENT</option>
                                                    <option value="FINANCE DEPARTMENT">FINANCE DEPARTMENT</option>
                                                    <option value="DISBURSEMENT DEPARTMENT">DISBURSEMENT DEPARTMENT</option>
                                                    <option value="LIAISON DEPARTMENT">LIAISON DEPARTMENT</option>
                                                    <option value="MARKETING DEPARTMENT">MARKETING DEPARTMENT</option>
                                                    <option value="PRINTING DEPARTMENT">PRINTING DEPARTMENT</option>
                                                    <option value="LICENSING DEPARTMENT">LICENSING DEPARTMENT</option>
                                                    <option value="BILLS DEPARTMENT">BILLS DEPARTMENT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" value="Submit"></input>
                                <input type="hidden" name="action" id="Addaction" value="">
                                <input type="hidden" name="accountID" id="accountID" value="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View User Modal -->
            <!-- <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">User Information</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="viewUserImage" class="rounded-circle" width="150" alt="No Image Available" onerror="this.src='../../image/avatar_thumbnail.png';">
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Deactivate User Modal -->
            <div class="modal fade" id="deactivateUser" tabindex="-1" role="dialog" aria-labelledby="DeactivateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="DeactivateModalLabel"></h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="deactivate_form" enctype="multipart/form-data">
                            <div class="modal-body">
                                <h5 class="text-center" id="deactivateMessage"></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" name="deactivateID" id="deactivateID">
                                <input type="hidden" name="action" id="action" value="">
                                <input type="submit" class="btn btn-success" name="action" id="deactivate" value="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete User Modal -->
            <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Delete User</h5>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="deleteUserForm" method="POST">
                            <div class="modal-body">
                                <h5 id="deleteMessage"></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete User</button>
                                <input type="hidden" name="action" id="deleteAction" value="">
                                <input type="hidden" name="deleteUserID" id="deleteUserID" value="">
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
        <script src="backend/user.js"></script>

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