<?php
require('database/db_conn.php');
session_start();

if (isset($_POST['Submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM user_account WHERE username = ? AND password = ? AND account_status != 'INACTIVE'");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Store user data in session variables
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['fullname'] = $row["fullname"];
            $_SESSION['firstname'] = $row["firstname"];
            $_SESSION['middlename'] = $row["middlename"];
            $_SESSION['lastname'] = $row["lastname"];
            $_SESSION['branch'] = $row["branch"];
            $_SESSION['department'] = $row["department"];
            $_SESSION['username'] = $row["username"];
            $_SESSION['avatar'] = $row["avatar"];
            $_SESSION['role'] = $row['role'];
            $_SESSION['account_status'] = $row["account_status"];

            // Redirect based on user role
            if ($row["role"] == "ADMINISTRATOR") {
                header('Location: users/administrator');
            } elseif ($row["role"] == "ENCODER") {
                header('Location: users/encoder');
            }
            exit; // Ensure no further code is executed after redirection
        }
    } else {
        // Redirect with an error message
        header('Location: login?error=1');
        exit;
    }

    $stmt->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>EVB TELECOMMUNICATION MONITORING SYSTEM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" sizes="16x16" href="image/EVBGOC.png">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--===============================================================================================-->
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- DATA AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .showpass {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
            color: #ffffff;
        }

        #passwordIcon {
            position: absolute;
            font-size: 15px;
            cursor: pointer;
            right: 18px;
            bottom: 16px;
            display: none;
            /* Hidden by default, shown by JavaScript */
        }

        .loader-wrapper {
            display: none;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
        }

        .logo {
            width: 130px;
            height: auto;
            animation: rotateZoomGlow 5s infinite;
        }

        /* Keyframes for the animation */
        @keyframes rotateZoomGlow {
            0% {
                transform: rotate(0deg) scale(1);
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            50% {
                transform: rotate(360deg) scale(1.2);
            }

            75% {
                opacity: 1;
            }

            100% {
                transform: rotate(720deg) scale(1);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <section>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

        <div class="loader-wrapper">
            <img src="image/EVBGOC.png" alt="EVB Logo" class="logo">
        </div>

        <div class="signin" data-aos="flip-left" data-aos-duration="2000">
            <form class="login100-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="content">
                    <div class="img-fluid">
                        <img src="image/logo.png" alt="EVB logo" width="120px" height="115px">
                    </div>
                    <h2>telecommunication monitoring system</h2>
                    <div class="form">
                        <div class="inputBox">
                            <input type="text" name="username" required>
                            <i class="title">Username</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" required>
                            <i class="title">Password</i>
                            <div class="showpass" onclick="myFunction()">
                                <i id="passwordIcon" class="fas fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="links">
                            <a href="#">Forgot Password</a>
                            <a href="#">Signup</a>
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="Submit" value="Login">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Scripts -->
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


    <script>
        // Show loader when form is submitted
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.login100-form').addEventListener('submit', function() {
                document.querySelector('.loader-wrapper').style.display = 'flex';
            });
        });
    </script>
</body>

</html>



<script>
    // Check if 'error' parameter is in the URL
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('error')) {
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid username or password, or account is inactive.',
            confirmButtonText: 'Try Again',
            background: "#222",
            color: "#fff"
        }).then((result) => {
            if (result.isConfirmed) {
                // Remove the 'error' parameter from the URL
                urlParams.delete('error');
                const newUrl = `${window.location.pathname}? EVB TELECOMMUNICATION MONITORING SYSTEM${urlParams.toString()}`;
                window.history.replaceState({}, '', newUrl);
            }
        });
    }
</script>

<script>
    function myFunction() {
        var passwordInput = document.querySelector('input[name="password"]');
        var passwordIcon = document.getElementById("passwordIcon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.classList.remove("fa-eye-slash");
            passwordIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            passwordIcon.classList.remove("fa-eye");
            passwordIcon.classList.add("fa-eye-slash");
        }
    }

    // Make sure the password icon shows when there is input
    document.querySelector('input[name="password"]').addEventListener('input', function() {
        var passwordIcon = document.getElementById("passwordIcon");
        if (this.value.length > 0) {
            passwordIcon.style.display = "block";
        } else {
            passwordIcon.style.display = "none";
        }
    });
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>