<?php
session_start();
include('../../database/db_conn.php');

$data = stripcslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$otid = $mydata['slip_id'];
$slip_type = $mydata['slip_type'];

if ($slip_type == "globe") {
    $sql = "SELECT * from globe_tbl where globe_id = {$otid}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
} else if ($slip_type == "smart") {
    $sql = "SELECT * from smart_tbl where smart_id = {$otid}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
} else {
    $sql = "SELECT * from pldt_tbl where pldt_id = {$otid}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
}
