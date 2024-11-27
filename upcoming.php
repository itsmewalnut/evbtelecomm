<?php
session_start();
include('database/db_conn.php');
date_default_timezone_set('Asia/Manila');

// Get the current date
$currentDate = date('Y-m-d');
$fiveDaysFromNow = date('Y-m-d', strtotime('+5 days')); // Calculate 5 days from today

$sql = "
    SELECT 'globe' AS table_type, globe_id AS id, duedate, register_name, branch, account_type, account_no, email, register_no, monthly, final_status, register_address, acquisition_date 
    FROM globe_table 
    WHERE duedate BETWEEN CURDATE() AND '$fiveDaysFromNow' AND final_status != 'PAID'
    
    UNION ALL

    SELECT 'smart' AS table_type, smart_id AS id, duedate, register_name, branch, account_type, account_no, email, register_no, monthly, final_status, register_address, acquisition_date 
    FROM smart_table 
    WHERE duedate BETWEEN CURDATE() AND '$fiveDaysFromNow' AND final_status != 'PAID'
    
    UNION ALL

    SELECT 'pldt' AS table_type, pldt_id AS id, duedate, register_name, branch, account_type, account_no, email, register_no, monthly, final_status, register_address, acquisition_date 
    FROM pldt_table 
    WHERE duedate BETWEEN CURDATE() AND '$fiveDaysFromNow' AND final_status != 'PAID'
";

$result = $conn->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each record to the array
        $records[] = $row;
    }
    echo json_encode($records); // Return all records with due dates between today and 5 days from now
} else {
    echo json_encode(["message" => "No upcoming due dates found"]);
}
