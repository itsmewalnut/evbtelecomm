<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../../database/db_conn.php');
date_default_timezone_set('Asia/Macao');
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

            $upload_dir = ('../../files/globe_folder');

            move_uploaded_file($tname, $upload_dir . '/' . $pname);

            $directory = ($upload_dir . '/' . $pname);

            mysqli_query($conn, "INSERT INTO globe_attachment(globe_id, file_location, file_name, date_paid) VALUES ('$paid_ID', '$directory', '$file_name', '$paid_Date')");
        }
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('GLOBE', '$role paid in globe', '$date', '$role', 'PAID')");
    } else {
        echo "No files were uploaded.";
    }
} else if ($paid_Type == "paidSmart") {
    mysqli_query($conn, "UPDATE smart_table SET final_status = 'PAID', date_paid = '$paid_Date', paid_amount = '$paid_Amount', remarks = '$paid_Remarks' WHERE globe_id = '$paid_ID'");
} else {
    mysqli_query($conn, "UPDATE pldt_table SET final_status = 'PAID', date_paid = '$paid_Date', paid_amount = '$paid_Amount', remarks = '$paid_Remarks' WHERE globe_id = '$paid_ID'");
};
