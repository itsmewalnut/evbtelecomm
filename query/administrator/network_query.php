<?php
session_start();
include('../../database/db_conn.php');
date_default_timezone_set('Asia/Macao');
$date = date('Y-m-d H:i:s');
$role = $_SESSION["role"];
$fname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];

// $remarks = str_replace('\r\n', '<br>', mysqli_real_escape_string($conn, $_POST["remarks"]));
$network_ID = mysqli_real_escape_string($conn, $_POST["networkID"]);
$action = mysqli_real_escape_string($conn, $_POST["action"]);
$network_type = mysqli_real_escape_string($conn, $_POST["networkType"]);

$acc_Branch = mysqli_real_escape_string($conn, $_POST["acc_Branch"]);
$acc_Department = mysqli_real_escape_string($conn, $_POST["acc_Department"]);
$accountNO = mysqli_real_escape_string($conn, $_POST["accountNO"]);
$registerNO = mysqli_real_escape_string($conn, $_POST["registerNO"]);
$registerName = mysqli_real_escape_string($conn, $_POST["registerName"]);
$accountStatus = mysqli_real_escape_string($conn, $_POST["accountStatus"]);
$finalStatus = mysqli_real_escape_string($conn, $_POST["finalStatus"]);
$acc_type = mysqli_real_escape_string($conn, $_POST["acc_type"]);
$dueDate = mysqli_real_escape_string($conn, $_POST["dueDate"]);
$acqui_date = mysqli_real_escape_string($conn, $_POST["acqui_date"]);
$register_add = mysqli_real_escape_string($conn, $_POST["register_add"]);
$account_username = mysqli_real_escape_string($conn, $_POST["account_username"]);
$account_password = mysqli_real_escape_string($conn, $_POST["account_password"]);
$accMonthly = mysqli_real_escape_string($conn, $_POST["accMonthly"]);
$accEmail = mysqli_real_escape_string($conn, $_POST["accEmail"]);
$accPhone = mysqli_real_escape_string($conn, $_POST["accPhone"]);
$acc_serialno = mysqli_real_escape_string($conn, $_POST["acc_serialno"]);
$accImei1 = mysqli_real_escape_string($conn, $_POST["accImei1"]);
$accImei2 = mysqli_real_escape_string($conn, $_POST["accImei2"]);
$accImei2 = mysqli_real_escape_string($conn, $_POST["accImei2"]);

if ($network_type == "Globe") {
    if ($action == 'AddGlobe') {
        mysqli_query($conn, "INSERT INTO globe_table(account_no, register_no, register_name, branch, department, duedate, account_type, acquisition_date, register_address, username, password, monthly, email, phone, serial_no, imei1, imei2, account_status, final_status) VALUES ('$accountNO', '$registerNO', '$registerName', '$acc_Branch', '$acc_Department', '$dueDate', '$acc_type', '$acqui_date', '$register_add', '$account_username', '$account_password', '$accMonthly', '$accEmail', '$accPhone', '$acc_serialno', '$accImei1', '$accImei2', '$accountStatus', '$finalStatus')");
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('GLOBE', '$fname $lname added new account in globe', '$date', '$role', 'ADD')");
    } else {
        mysqli_query($conn, "UPDATE globe_table SET account_no = '$accountNO', register_no = '$registerNO', register_name = '$registerName', branch = '$acc_Branch', department = '$acc_Department', duedate = '$dueDate', account_type = '$acc_type', acquisition_date = '$acqui_date', acquisition_date = '$acqui_date', register_address = '$register_add', username = '$account_username', password = '$account_password', monthly = '$accMonthly', email = '$accEmail', serial_no = '$acc_serialno', imei1 = '$accImei1', imei2 = '$accImei2', account_status = '$accountStatus', final_status = '$finalStatus' WHERE globe_id = '$network_ID'");
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('GLOBE', '$fname $lname updated in globe', '$date', '$role', 'UPDATE')");
    }
} else if ($network_type == "Smart") {
    if ($action == 'AddSmart') {
        mysqli_query($conn, "INSERT INTO smart_table(account_no, register_no, register_name, branch, department, duedate, account_type, acquisition_date, register_address, username, password, monthly, email, phone, serial_no, imei1, imei2, account_status, final_status) VALUES ('$accountNO', '$registerNO', '$registerName', '$acc_Branch', '$acc_Department', '$dueDate', '$acc_type', '$acqui_date', '$register_add', '$account_username', '$account_password', '$accMonthly', '$accEmail', '$accPhone', '$acc_serialno', '$accImei1', '$accImei2', '$accountStatus', '$finalStatus')");
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('SMART', '$fname $lname added new account in smart', '$date', '$role', 'ADD')");
    } else {
        mysqli_query($conn, "UPDATE smart_table SET account_no = '$accountNO', register_no = '$registerNO', register_name = '$registerName', branch = '$acc_Branch', department = '$acc_Department', duedate = '$dueDate', account_type = '$acc_type', acquisition_date = '$acqui_date', acquisition_date = '$acqui_date', register_address = '$register_add', username = '$account_username', password = '$account_password', monthly = '$accMonthly', email = '$accEmail', serial_no = '$acc_serialno', imei1 = '$accImei1', imei2 = '$accImei2', account_status = '$accountStatus', final_status = '$finalStatus' WHERE smart_id = '$network_ID'");
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('SMART', '$fname $lname updated in smart', '$date', '$role', 'UPDATE')");
    }
} else {
    if ($action == 'AddPLDT') {
        mysqli_query($conn, "INSERT INTO pldt_table(account_no, register_no, register_name, branch, department, duedate, account_type, acquisition_date, register_address, username, password, monthly, email, phone, serial_no, imei1, imei2, account_status, final_status) VALUES ('$accountNO', '$registerNO', '$registerName', '$acc_Branch', '$acc_Department', '$dueDate', '$acc_type', '$acqui_date', '$register_add', '$account_username', '$account_password', '$accMonthly', '$accEmail', '$accPhone', '$acc_serialno', '$accImei1', '$accImei2', '$accountStatus', '$finalStatus')");
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('PLDT', '$fname $lname added new account in pldt', '$date', '$role', 'ADD')");
    } else {
        mysqli_query($conn, "UPDATE pldt_table SET account_no = '$accountNO', register_no = '$registerNO', register_name = '$registerName', branch = '$acc_Branch', department = '$acc_Department', duedate = '$dueDate', account_type = '$acc_type', acquisition_date = '$acqui_date', acquisition_date = '$acqui_date', register_address = '$register_add', username = '$account_username', password = '$account_password', monthly = '$accMonthly', email = '$accEmail', serial_no = '$acc_serialno', imei1 = '$accImei1', imei2 = '$accImei2', account_status = '$accountStatus', final_status = '$finalStatus' WHERE pldt_id = '$network_ID'");
        mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('PLDT', '$fname $lname updated in pldt', '$date', '$role', 'UPDATE')");
    }
};
