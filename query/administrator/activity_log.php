<?php
session_start();
include('../../database/db_conn.php');

$columns = array('network_type', 'remarks', 'network_date', 'role', 'action');

$query = "SELECT * from activity_log ";

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
';
} else {
    $query .= 'ORDER BY id DESC LIMIT 9';
}

$query1 = '';

if (isset($_POST['length'])) {
    if ($_POST["length"] != -1) {
        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }
}
// if ($_POST["length"] != -1) {
//     $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }

// echo $query;

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = $row["network_type"];
    $sub_array[] = $row["remarks"];
    $sub_array[] = $row["network_date"];
    $sub_array[] = $row["role"];
    $sub_array[] = $row["action"];

    $data[] = $sub_array;
}

function get_all_data($conn)
{
    $query = "SELECT * FROM activity_log";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "data"    => $data,
    // "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($conn),
    "recordsFiltered" => $number_filter_row
);

echo json_encode($output);
