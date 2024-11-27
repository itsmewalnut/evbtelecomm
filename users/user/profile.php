<?php
require('../../database/db_conn.php');
session_start();

if ($_SESSION['role'] == "ENCODER" || $_SESSION['role'] == "CHECKER") {

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
        <link href="../../assets/css/avatar.css" rel="stylesheet" />
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