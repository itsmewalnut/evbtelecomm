<?php
require('../../database/db_conn.php');
session_start();

if ($_SESSION['role'] == "ADMINISTRATOR") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $pass = mysqli_real_escape_string($conn, $_POST['upass']);
        mysqli_query($conn, "UPDATE user_account SET password = '$pass' WHERE user_id = '$user_id'");
    };
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="../../image/EVBGOC.png" />
        <title><?php echo $_SESSION['role']; ?> | Profile</title>
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
                        <a class="nav-link text-white active bg-gradient-secondary" href="profile">
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
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Profile</h6>
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
            <div class="container-fluid px-2 px-md-4">
                <div class="profile-back page-header min-height-300 border-radius-xl mt-4">
                    <span class="mask  bg-gradient-dark  opacity-3"></span>
                </div>
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <div class="row gx-4 mb-2">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <img src="<?php echo $_SESSION['avatar']; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    <?php echo $_SESSION['fullname']; ?>
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    <?php echo $_SESSION['role']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="true">
                                            <i class="material-icons text-lg position-relative">person</i>
                                            <span class="ms-1">Personal Info</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#message" aria-controls="message" role="tab" aria-selected="false">
                                            <i class="material-icons text-lg position-relative">email</i>
                                            <span class="ms-1">Messages</span>
                                        </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#settings" aria-controls="settings" role="tab" aria-selected="false">
                                            <i class="material-icons text-lg position-relative">settings</i>
                                            <span class="ms-1">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active border-radius-lg" id="profile" role="tabpanel" aria-labelledby="profile" loading="lazy">
                                <div class="card" id="basic-info">
                                    <div class="card-header">
                                        <h5>Basic Information</h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <h6>First Name:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['firstname']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Middle Name:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['middlename']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Last Name:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['lastname']); ?></p>
                                                    <div class="mt-3">
                                                        <h6>Social Media:</h6>
                                                        <a href="https://facebook.com" class="me-3" target="_blank">
                                                            <i class="fab fa-facebook fa-md"></i>
                                                        </a>
                                                        <a href="https://twitter.com" class="me-3" target="_blank">
                                                            <i class="fab fa-twitter fa-md"></i>
                                                        </a>
                                                        <a href="https://instagram.com" class="" target="_blank">
                                                            <i class="fab fa-instagram fa-md"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6>Branch:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['branch']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Department:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['department']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Username:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Role:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['role']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Account Status:</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION['account_status']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade height-400 border-radius-lg" id="message" role="tabpanel" aria-labelledby="message" loading="lazy">

                            </div>
                        </div> -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade border-radius-lg" id="settings" role="tabpanel" aria-labelledby="settings" loading="lazy">
                                <div class="card" id="password">
                                    <div class="card-header">
                                        <h5>Change Password</h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Old Password</label>
                                                <input type="text" id="old_pass" name="old_pass" class="form-control" autocomplete="off">
                                                <small></small>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Current Password</label>
                                                <input type="text" id="current_pass" name="upass" class="form-control" autocomplete="off">
                                                <small></small>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="text" id="confirm_pass" name="confirm_pass" class="form-control" autocomplete="off">
                                                <small></small>
                                            </div>
                                            <h5 class="mt-5">Password requirements</h5>
                                            <p class="text-muted mb-2">
                                                Please follow this guide for a strong password:
                                            </p>
                                            <ul class="text-muted ps-4 mb-0 float-start">
                                                <li>
                                                    <span class="text-sm">One special characters</span>
                                                </li>
                                                <li>
                                                    <span class="text-sm">Min 8 characters</span>
                                                </li>
                                                <li>
                                                    <span class="text-sm">One number (2 are recommended)</span>
                                                </li>
                                                <li>
                                                    <span class="text-sm">Change it often</span>
                                                </li>
                                            </ul>
                                            <input class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" type="submit" name="updatePass" value="Update password">
                                        </form>
                                    </div>
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
        <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf("Win") > -1;
            if (win && document.querySelector("#sidenav-scrollbar")) {
                var options = {
                    damping: "0.5",
                };
                Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
            }
        </script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../../assets/js/material-dashboard.min.js?v=3.1.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../backend/logout.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: ../../logout.php");
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const oldpassword = document.getElementById("old_pass"),
            password = document.getElementById("current_pass"),
            password2 = document.getElementById("confirm_pass");

        const errorMessages = {
            old_pass: "Please enter your old password.",
            current_pass: "Please enter a new password.",
            confirm_pass: "Please confirm your new password."
        };

        // Listen for form submission
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent form submission for validation

            const isValidOldPassword = checkRequired([oldpassword]);
            const isValidCurrentPassword = checkRequired([password]);
            const isValidConfirmPassword = checkRequired([password2]);

            if (isValidOldPassword && isValidCurrentPassword && isValidConfirmPassword) {
                const isPasswordStrong = checkPasswordStrength(password);
                const isPasswordMatch = checkPasswordMatch(password, password2);

                // Only if all validations pass, allow submission
                if (isPasswordStrong && isPasswordMatch) {
                    // Here you can submit the form or handle it as needed
                    const form = e.target; // Reference the form from the event
                    Swal.fire({
                        title: "Change Password?",
                        text: "Are you sure, you want to change your password?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#f44335",
                        confirmButtonText: "Yes, Confirmed!",
                        cancelButtonText: "Cancel",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                            Swal.fire({
                                icon: "success",
                                title: "Thank You!",
                                text: "Password Successfully Changed!",
                                showConfirmButton: false,
                                timer: 2500,
                            });
                        }
                    });
                }
            }
        });

        function showError(field, message) {
            const parent = field.parentElement;
            parent.className = "input-group input-group-outline mb-5 is-invalid is-filled";
            parent.querySelector("small").innerText = message;
            return false; // Indicate that the validation failed
        }

        function showSucces(field) {
            field.parentElement.className = "input-group input-group-outline mb-5 is-valid is-filled";
            return true; // Indicate that the validation passed
        }

        function checkRequired(fields) {
            let allValid = true;
            fields.forEach(field => {
                if (field.value.trim() === "") {
                    allValid = false; // Set to false if any field is invalid
                    const message = errorMessages[field.id] || "This field is required.";
                    showError(field, message);
                } else {
                    field.parentElement.querySelector("small").innerText = "";
                    showSucces(field);
                }
            });
            return allValid; // Return true if all fields are valid
        }

        function checkPasswordStrength(password) {
            const passwordValue = password.value.trim();
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
            const hasNumber = /\d/.test(passwordValue);
            const isValidLength = passwordValue.length >= 8;

            // Clear any previous error messages
            password.parentElement.classList.remove("is-invalid");
            password.parentElement.querySelector("small").innerText = "";

            let isValid = true;

            if (!hasSpecialChar) {
                isValid = false;
                showError(password, "Password must contain one special character");
            }
            if (!hasNumber) {
                isValid = false;
                showError(password, "Password must contain at least one number");
            }
            if (!isValidLength) {
                isValid = false;
                showError(password, "Password must be at least 8 characters long");
            }

            if (isValid) {
                showSucces(password);
            }

            return isValid; // Return whether the password is strong
        }

        function checkPasswordMatch(password, password2) {
            password2.parentElement.classList.remove("is-invalid");
            password2.parentElement.querySelector("small").innerText = "";

            if (password.value !== password2.value) {
                return showError(password2, "Passwords do not match");
            } else {
                return showSucces(password2);
            }
        }
    });
</script>