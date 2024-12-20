<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../../database/db_conn.php');
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
$role = $_SESSION["role"];
$empname = $_SESSION['fullname'];
$fname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];

$transmit_Type = $_POST['transmitType'];
$transmit_ID = $_POST['transmitID'];
$transmit_Date = date('Y-m-d');

if ($transmit_Type == "transmitGlobe") {
    mysqli_query($conn, "UPDATE globe_table SET final_status = 'TRANSMITTED' WHERE globe_id = '$transmit_ID'");

    // Upload new attachments
    if (isset($_FILES['transmit_attachment'])) {
        foreach ($_FILES['transmit_attachment']['tmp_name'] as $key => $value) {
            $pname = rand(1000, 10000) . "-" . $empname . "_" . $_FILES['transmit_attachment']['name'][$key];
            $tname = $_FILES['transmit_attachment']['tmp_name'][$key];
            $file_name = $_FILES['transmit_attachment']['name'][$key];

            $upload_dir = ('../../files/globe_folder/soa');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "INSERT INTO globe_attachment(globe_id, file_location, file_name, date_paid, soa_status) VALUES ('$transmit_ID', '$directory', '$file_name', '$transmit_Date', 'UNPAID')");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('GLOBE', '$fname $lname transmitted in globe', '$date', '$role', 'TRANSMITTED')");
    } else {
        echo "No files were uploaded.";
    }
} else if ($transmit_Type == "transmitSmart") {
    mysqli_query($conn, "UPDATE smart_table SET final_status = 'TRANSMITTED' WHERE smart_id = '$transmit_ID'");

    // Upload new attachments
    if (isset($_FILES['transmit_attachment'])) {
        foreach ($_FILES['transmit_attachment']['tmp_name'] as $key => $value) {
            $pname = rand(1000, 10000) . "-" . $empname . "_" . $_FILES['transmit_attachment']['name'][$key];
            $tname = $_FILES['transmit_attachment']['tmp_name'][$key];
            $file_name = $_FILES['transmit_attachment']['name'][$key];

            $upload_dir = ('../../files/smart_folder/soa');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "INSERT INTO smart_attachment(smart_id, file_location, file_name, date_paid, soa_status) VALUES ('$transmit_ID', '$directory', '$file_name', '$transmit_Date', 'UNPAID')");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('SMART', '$fname $lname transmitted in smart', '$date', '$role', 'TRANSMITTED')");
    } else {
        echo "No files were uploaded.";
    }
} else if ($transmit_Type == "transmitPLDT") {
    mysqli_query($conn, "UPDATE pldt_table SET final_status = 'TRANSMITTED' WHERE pldt_id = '$transmit_ID'");

    // Upload new attachments
    if (isset($_FILES['transmit_attachment'])) {
        foreach ($_FILES['transmit_attachment']['tmp_name'] as $key => $value) {
            $pname = rand(1000, 10000) . "-" . $empname . "_" . $_FILES['transmit_attachment']['name'][$key];
            $tname = $_FILES['transmit_attachment']['tmp_name'][$key];
            $file_name = $_FILES['transmit_attachment']['name'][$key];

            $upload_dir = ('../../files/pldt_folder/soa');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "INSERT INTO pldt_attachment(pldt_id, file_location, file_name, date_paid, soa_status) VALUES ('$transmit_ID', '$directory', '$file_name', '$transmit_Date', 'UNPAID')");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('PLDT', '$fname $lname transmitted in pldt', '$date', '$role', 'TRANSMITTED')");
    } else {
        echo "No files were uploaded.";
    }
} else {
    echo "Invalid transmit type.";
};
