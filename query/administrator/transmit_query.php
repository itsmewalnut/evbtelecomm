<?php
session_start();
include('../../database/db_conn.php');
date_default_timezone_set('Asia/Macao');
$date = date('Y-m-d H:i:s');
$role = $_SESSION["role"];

$transmit_Type = $_POST['transmitType'];
$transmit_ID = $_POST['transmitGlobeID'];

if ($transmit_Type == "paidGlobe") {
    mysqli_query($conn, "UPDATE globe_table SET final_status = 'TRANSMITTED' WHERE globe_id = '$transmit_ID'");
    mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('GLOBE', '$role transmitted in globe', '$date', '$role', 'TRANSMITTED')");
} else if ($transmit_Type == "paidSmart") {
    mysqli_query($conn, "UPDATE smart_table SET final_status = 'TRANSMITTED' WHERE smart_id = '$transmit_ID'");
    mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('SMART', '$role transmitted in smart', '$date', '$role', 'TRANSMITTED')");
} else {
    mysqli_query($conn, "UPDATE pldt_table SET final_status = 'TRANSMITTED' WHERE pldt_id = '$transmit_ID'");
    mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('PLDT', '$role transmitted in pldt', '$date', '$role', 'TRANSMITTED')");
};
