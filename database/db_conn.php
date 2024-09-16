<?php

//$sname= "localhost";
//$unmae= "evbgroupbiz_evbtelecomm";
//$password = "Evbgroup123!";
//$db_name = "evbgroupbiz_evbtelecomm";
$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "evbgroupbiz_telecomm";

$conn = new mysqli($sname, $unmae, $password, $db_name);

if ($conn->connect_error) {
    die("Connection Failed");
}
