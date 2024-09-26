<?php
session_start();
include('../../database/db_conn.php');

$data = stripcslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$networkID = $mydata['slip_id'];
$slip_type = $mydata['slip_type'];

if ($slip_type == "globe") {
    $sql = "SELECT * from globe_table where globe_id = {$networkID}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
} else if ($slip_type == "smart") {
    $sql = "SELECT * from smart_table where smart_id = {$networkID}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
} else {
    $sql = "SELECT * from pldt_table where pldt_id = {$networkID}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo json_encode($row);
}
