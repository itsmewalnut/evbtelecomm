<?php
session_start();
date_default_timezone_set('Asia/Macao');
include('../../database/db_conn.php');

$action = $_POST['action'];
$accountID = $_POST['accountID'];
$userID = $_POST['deactivateID'];
$first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
$middle_name = mysqli_real_escape_string($conn, $_POST['middlename']);
$last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$account_status = mysqli_real_escape_string($conn, $_POST['account_status']);

$fullname = $last_name . ', ' . $first_name . " " . $middle_name;

// Initialize $directory as an empty string
$directory = '';

// Check if a new image is uploaded
if (!empty($_FILES['account_avatar']['name'])) {
    // If a new image is uploaded
    $pname = $fullname . "_" . $_FILES['account_avatar']['name'];
    $tname = $_FILES['account_avatar']['tmp_name'];

    $upload_dir = '../../image/user_avatar';

    // Delete the old image if it exists
    $old_image_query = mysqli_query($conn, "SELECT avatar FROM user_account WHERE user_id = '$accountID'");
    $old_image_row = mysqli_fetch_assoc($old_image_query);
    $old_image_path = $old_image_row['avatar'];

    if (!empty($old_image_path) && file_exists($old_image_path)) {
        unlink($old_image_path);
    }

    // Move the new image to the upload directory
    move_uploaded_file($tname, $upload_dir . '/' . $pname);
    $directory = $upload_dir . '/' . $pname;
} else {
    // If no new image is uploaded, retain the existing image path or set to empty if adding a new user
    if ($action == "AddUser") {
        $directory = '';
    } else {
        $directory_query = mysqli_query($conn, "SELECT avatar FROM user_account WHERE user_id = '$accountID'");
        $directory_row = mysqli_fetch_assoc($directory_query);
        $directory = $directory_row['avatar'];
    }
}

if ($action == "AddUser") {
    mysqli_query($conn, "INSERT INTO user_account (fullname, firstname, middlename, lastname, branch, department, username, password, avatar, role, account_status) VALUES ('$fullname', '$first_name', '$middle_name', '$last_name', '$branch', '$department', '$username', 'Evbgroup123', '$directory', '$role', '$account_status')");
} else if ($action == "updateUser") {
    mysqli_query(
        $conn,
        "UPDATE user_account SET fullname = '$fullname', firstname = '$first_name', middlename = '$middle_name', lastname = '$last_name', branch = '$branch', department = '$department', username = '$username', avatar = '$directory', role = '$role', account_status = '$account_status' WHERE user_id = '$accountID'"
    );
} else if ($action == "Deactivate") {
    mysqli_query(
        $conn,
        "UPDATE user_account SET account_status = 'INACTIVE' WHERE user_id = '$userID'"
    );
} else if ($action == "Activate") {
    mysqli_query(
        $conn,
        "UPDATE user_account SET account_status = 'ACTIVE' WHERE user_id = '$userID'"
    );
} else if ($action == "Delete") {
    $deleteID = $_POST['deleteUserID'];

    // Fetch the image path before deleting the user
    $image_query = mysqli_query($conn, "SELECT avatar FROM user_account WHERE user_id = '$deleteID'");
    $image_row = mysqli_fetch_assoc($image_query);
    $image_path = $image_row['avatar'];

    // Delete the image file if it exists
    if (!empty($image_path) && file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete the user record
    mysqli_query($conn, "DELETE FROM user_account WHERE user_id = '$deleteID'");
}
