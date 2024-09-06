<?php
session_start();
date_default_timezone_set('Asia/Macao');
include('../../database/db_conn.php');

$fetchType = $_POST['fetchType'];
$data = array();
$columns = array('user_id', 'avatar', 'fullname', 'branch', 'department', 'role', 'account_status');

if ($fetchType == "notFilter") {
    $query = "SELECT * FROM user_account WHERE role != 'ADMINISTRATOR'";

    if (isset($_POST["order"])) {
        $columnIndex = intval($_POST['order']['0']['column']);
        $direction = $_POST['order']['0']['dir'];
        if (isset($columns[$columnIndex])) {
            $query .= 'ORDER BY ' . $columns[$columnIndex] . ' ' . $direction . ' ';
        }
    } else {
        $query .= 'ORDER BY user_id DESC ';
    }

    if (isset($_POST['length']) && $_POST['length'] != -1) {
        $start = intval($_POST['start']);
        $length = intval($_POST['length']);
        $query .= 'LIMIT ' . $start . ', ' . $length;
    }

    $number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $sub_array = array();
            $sub_array[] = $row["user_id"];
            $avatar = $row["avatar"];
            $fullname = $row["fullname"];
            // Combine avatar and fullname into one column
            $sub_array[] = '<div style="display: flex; align-items: center;">
                                <img src="' . htmlspecialchars($avatar, ENT_QUOTES, 'UTF-8') . '" 
                                     alt="Avatar" 
                                     class="avatar avatar-sm me-2 border-radius-lg" 
                                     onerror="this.onerror=null; this.src=\'../../image/avatar_thumbnail.png\';">
                                <span>' . htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8') . '</span>
                            </div>';
            $sub_array[] = $row["branch"];
            $sub_array[] = $row["department"];
            $sub_array[] = '<span class="badge bg-gradient-info">' . $row["role"] . '</span>';
            if ($row["account_status"] == 'ACTIVE') {
                $sub_array[] = '<span class="badge bg-gradient-success">ACTIVE</span>';
            } else {
                $sub_array[] = '<span class="badge bg-gradient-secondary">INACTIVE</span>';
            }
            if ($row["account_status"] == 'ACTIVE') {
                $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getUserView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewUser" data-id="' . $row["user_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getUserUpdate" class="btn btn-icon btn-2 btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addUser" data-id="' . $row["user_id"] . '"><i class="fa fa-edit" style="font-size: 13px" title="Update"></i> Update</button>
                <button type="button" id="getUserDeactivate" class="btn btn-icon btn-2 btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#deactivateUser" data-action="deactivate" data-id="' . $row["user_id"] . '" data-name="' . $row["fullname"] . '"><i class="fa fa-user-times" style="font-size: 13px" title="Deactivate"></i> Deactivate</button>
                <button type="button" id="getUserDelete" class="btn btn-icon btn-2 btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser" data-id="' . $row["user_id"] . '" data-name="' . $row["fullname"] . '"><i class="fa fa-trash-alt" style="font-size: 13px" title="Delete"></i> Delete</button>
                </div>';
            } else {
                $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getUserView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewUser" data-id="' . $row["user_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getUserUpdate" class="btn btn-icon btn-2 btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addUser" data-id="' . $row["user_id"] . '"><i class="fa fa-edit" style="font-size: 13px" title="Update"></i> Update</button>
                <button type="button" id="getUserActivate" class="btn btn-icon btn-2 btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#deactivateUser" data-action="activate" data-id="' . $row["user_id"] . '" data-name="' . $row["fullname"] . '"><i class="fa fa-user-check" style="font-size: 13px" title="Activate"></i> Activate</button>
                <button type="button" id="getUserDelete" class="btn btn-icon btn-2 btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser" data-id="' . $row["user_id"] . '" data-name="' . $row["fullname"] . '"><i class="fa fa-trash-alt" style="font-size: 13px" title="Delete"></i> Delete</button>
                </div>';
            }

            $data[] = $sub_array;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    function get_all_data($conn)
    {
        $query = "SELECT * FROM user_account";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }

    $output = array(
        "data"    => $data,
        "recordsTotal"  => get_all_data($conn),
        "recordsFiltered" => $number_filter_row
    );

    echo json_encode($output);
}
