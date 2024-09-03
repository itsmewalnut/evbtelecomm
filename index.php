<?php
require('database/db_conn.php');
session_start();

if ($row["role"] == "EMPLOYEE") {
    header('Location: users/employee');
} else {
    header("Location: logout.php");
}
