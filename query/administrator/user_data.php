<?php
session_start();
include('../../database/db_conn.php');

$data = stripcslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$slipID = $mydata['slip_id'];
$forPage = $mydata['forPage'];

$sql = "SELECT * from user_account where user_id = {$slipID}";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo json_encode($row);
