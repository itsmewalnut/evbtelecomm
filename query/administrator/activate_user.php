<?php
session_start();
date_default_timezone_set('Asia/Macao');
include('../../database/db_conn.php');

$action = $_POST['action'];
$userID = $_POST['deactivateID'];

if ($action == "deactivate") {
    mysqli_query(
        $conn,
        "UPDATE user_account SET account_status = 'INACTIVE' WHERE user_id = '$userID'"
    );
} else {
    mysqli_query(
        $conn,
        "UPDATE user_account SET account_status = 'ACTIVE' WHERE user_id = '$userID'"
    );
}
