<?php
// Get the current page (for example, from the URL)
$current_page = basename($_SERVER['REQUEST_URI'], ".php");

// Define page titles for the breadcrumb and page title
$page_titles = [
    "dashboard" => "Dashboard",
    "globe" => "Globe",
    "smart" => "Smart",
    "pldt" => "PLDT",
    "profile" => "Profile",
    "users" => "Users"
];

// Set the active page based on the current page
$breadcrumb_title = isset($page_titles[$current_page]) ? $page_titles[$current_page] : "Dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a href="dashboard.php"><i class="material-icons opacity-10">home</i></a></li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $breadcrumb_title; ?></li>
                </ol>
                <h6 class="font-weight-bolder mb-0"><?php echo $breadcrumb_title; ?></h6>
            </nav>
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none">
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

                    <!-- <li class="nav-item dropdown pe-4">
                        <a href="javascript:;" class="nav-link px-1 position-relative line-height-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons"><i class="fa-brands fa-facebook-messenger"></i></i>
                            <span class="position-absolute start-100 translate-middle badge rounded-circle bg-danger px-2 py-1">
                                <span class="small">1</span>
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2" style="width:330px" aria-labelledby="dropdownMenuButton">
                            <h5 class="p-2 mb-0">Messages</h5>
                            <div class="px-1">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Search Contact</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <hr class="horizontal dark mt-2 mb-3" />
                            <li class="mb-2">
                                <a href="javascript:;" class="dropdown-item border-radius-md">
                                    <div class="d-flex">
                                        <img alt="Image" src="<?php echo $_SESSION["avatar"] ?>" class="avatar shadow">
                                        <div class="ms-3">
                                            <div class="justify-content-between align-items-center">
                                                <h6 class="mb-0"><?php echo $_SESSION["fullname"] ?>
                                                    <span class="badge badge-success"></span>
                                                </h6>
                                                <p class="mb-0 text-sm">Typing...</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li> -->

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
                                <span class="d-sm-inline d-none text-bold text-uppercase"><?php echo $_SESSION['fullname']; ?></span>
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
</body>

</html>