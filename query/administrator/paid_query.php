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

$paid_Type = $_POST['paid_type'];
$paid_ID = $_POST['paid_ID'];

$paid_Date = mysqli_real_escape_string($conn, $_POST["paid_date"]);
$paid_Amount = mysqli_real_escape_string($conn, $_POST["paid_amount"]);
$paid_Remarks = str_replace(array("\r\n", "\n", "\r"), "<br>", mysqli_real_escape_string($conn, $_POST["paid_remarks"]));

if ($paid_Type == "paidGlobe") {
    mysqli_query($conn, "UPDATE globe_table SET final_status = 'PAID', date_paid = '$paid_Date', paid_amount = '$paid_Amount', remarks = '$paid_Remarks' WHERE globe_id = '$paid_ID'");

    // Upload new attachments
    if (isset($_FILES['attachment'])) {
        foreach ($_FILES['attachment']['tmp_name'] as $key => $value) {
            $pname = rand(1000, 10000) . "-" . $empname . "_" . $_FILES['attachment']['name'][$key];
            $tname = $_FILES['attachment']['tmp_name'][$key];
            $file_name = $_FILES['attachment']['name'][$key];

            $upload_dir = ('../../files/globe_folder/payment');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "UPDATE globe_attachment SET payment_image = '$directory', soa_status = 'PAID' WHERE globe_id = '$paid_ID'");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('GLOBE', '$role paid in globe', '$date', '$role', 'PAID')");
    } else {
        echo "No files were uploaded.";
    }
} else if ($paid_Type == "paidSmart") {
    mysqli_query($conn, "UPDATE smart_table SET final_status = 'PAID', date_paid = '$paid_Date', paid_amount = '$paid_Amount', remarks = '$paid_Remarks' WHERE smart_id = '$paid_ID'");

    // Upload new attachments
    if (isset($_FILES['attachment'])) {
        foreach ($_FILES['attachment']['tmp_name'] as $key => $value) {
            $pname = rand(1000, 10000) . "-" . $empname . "_" . $_FILES['attachment']['name'][$key];
            $tname = $_FILES['attachment']['tmp_name'][$key];
            $file_name = $_FILES['attachment']['name'][$key];

            $upload_dir = ('../../files/smart_folder/payment');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "UPDATE smart_attachment SET payment_image = '$directory', soa_status = 'PAID' WHERE smart_id = '$paid_ID'");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('SMART', '$role paid in smart', '$date', '$role', 'PAID')");
    } else {
        echo "No files were uploaded.";
    }
} else if ($paid_Type == "paidPLDT") {
    mysqli_query($conn, "UPDATE pldt_table SET final_status = 'PAID', date_paid = '$paid_Date', paid_amount = '$paid_Amount', remarks = '$paid_Remarks' WHERE pldt_id = '$paid_ID'");

    // Upload new attachments
    if (isset($_FILES['attachment'])) {
        foreach ($_FILES['attachment']['tmp_name'] as $key => $value) {
            $pname = rand(1000, 10000) . "-" . $empname . "_" . $_FILES['attachment']['name'][$key];
            $tname = $_FILES['attachment']['tmp_name'][$key];
            $file_name = $_FILES['attachment']['name'][$key];

            $upload_dir = ('../../files/pldt_folder/payment');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "UPDATE pldt_attachment SET payment_image = '$directory', soa_status = 'PAID' WHERE pldt_id = '$paid_ID'");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('PLDT', '$role paid in pldt', '$date', '$role', 'PAID')");
    } else {
        echo "No files were uploaded.";
    }
} else {
    echo "Invalid payment type.";
};
