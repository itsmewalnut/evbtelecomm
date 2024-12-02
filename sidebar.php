<?php
// Check the current page from the URL, but without the .php extension
$current_page = basename($_SERVER['REQUEST_URI'], ".php");

// Default active class for pages, reset it based on the current page
$active_class = [
    "dashboard" => "",
    "globe" => "",
    "smart" => "",
    "pldt" => "",
    "profile" => "",
    "users" => ""
];

// Define the background gradient class for each active link
$gradient_class = [
    "dashboard" => "bg-gradient-secondary",
    "globe" => "bg-gradient-info",
    "smart" => "bg-gradient-success",
    "pldt" => "bg-gradient-danger",
    "profile" => "bg-gradient-secondary",
    "users" => "bg-gradient-secondary"
];

// Check if the current page matches any of the sidebar links and set the active class
if (array_key_exists($current_page, $active_class)) {
    $active_class[$current_page] = "active " . $gradient_class[$current_page];
}
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="dashboard">
            <div class="d-flex justify-content-center align-items-center">
                <img src="../../image/HomeLogo.png" class="object-fit-cover w-75" alt="main_logo" />
            </div>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Home page</h6>
            </li>
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link text-white <?php echo $active_class['dashboard']; ?>" href="dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <?php
            // Check user role to display 'Users' link
            if ($_SESSION['role'] == "ADMINISTRATOR") {
                echo '<li class="nav-item">
                    <a class="nav-link text-white ' . $active_class['users'] . '" href="users">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>';
            }
            ?>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Network</h6>
            </li>
            <!-- Globe -->
            <li class="nav-item">
                <a class="nav-link text-white <?php echo $active_class['globe']; ?>" href="globe">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">public</i>
                    </div>
                    <span class="nav-link-text ms-1">Globe</span>
                </a>
            </li>
            <!-- Smart -->
            <li class="nav-item">
                <a class="nav-link text-white <?php echo $active_class['smart']; ?>" href="smart">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">sim_card</i>
                    </div>
                    <span class="nav-link-text ms-1">Smart</span>
                </a>
            </li>
            <!-- PLDT -->
            <li class="nav-item">
                <a class="nav-link text-white <?php echo $active_class['pldt']; ?>" href="pldt">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">cell_tower</i>
                    </div>
                    <span class="nav-link-text ms-1">PLDT</span>
                </a>
            </li>

            <!-- Account Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <!-- Profile -->
            <li class="nav-item">
                <a class="nav-link text-white <?php echo $active_class['profile']; ?>" href="profile">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
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