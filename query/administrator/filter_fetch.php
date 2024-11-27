<?php
session_start();
include('../../database/db_conn.php');
$role = $_SESSION["role"];
$network_type = $_POST['networkType'];
if ($network_type == "globe") {
    $searchBRANCH = $_POST['filterBRANCH'];
    $searchRNAME = $_POST['filterRNAME'];
    $searchACCNO = $_POST['filterACCNO'];
    $searchDUEDATE = $_POST['filterDUEDATE'];
    $searchACCSTATUS = $_POST['filterACCSTATUS'];
    $searchSTATUS = $_POST['filterSTATUS'];

    $columns = array('branch', 'register_name', 'account_no', 'duedate', 'account_status', 'final_status');

    $query = "SELECT globe_id, branch, register_name, account_no, register_no, duedate, account_status, final_status FROM globe_table WHERE ";
    if ($searchBRANCH == '') {
        $query .= 'branch = branch AND ';
    } else {
        $query .= 'branch = "' . $searchBRANCH . '" AND ';
    }

    if ($searchRNAME == '') {
        $query .= 'register_name = register_name AND ';
    } else {
        $query .= 'register_name = "' . $searchRNAME . '" AND ';
    }

    if ($searchACCNO == '') {
        $query .= 'account_no = account_no AND ';
    } else {
        $query .= 'account_no = "' . $searchACCNO . '" AND ';
    }

    if ($searchDUEDATE == '') {
        $query .= 'duedate = duedate AND ';
    } else {
        $query .= 'duedate = "' . $searchDUEDATE . '" AND ';
    }

    if ($searchACCSTATUS == '') {
        $query .= 'account_status = account_status AND ';
    } else {
        $query .= 'account_status = "' . $searchACCSTATUS . '" AND ';
    }

    if ($searchSTATUS == '') {
        $query .= 'final_status = final_status ';
    } else {
        $query .= 'final_status = "' . $searchSTATUS . '" ';
    }


    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
';
    } else {
        $query .= 'ORDER BY globe_id DESC ';
    }

    $query1 = '';

    if (isset($_POST['length'])) {
        if ($_POST["length"] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    }


    $result = mysqli_query($conn, $query . $query1);


    $number_filter_row = mysqli_num_rows($result);

    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $sub_array = array();
        $sub_array[] = $row["globe_id"];
        $sub_array[] = $row["branch"];
        $sub_array[] = $row["register_name"];
        $sub_array[] = $row["account_no"];
        $sub_array[] = $row["register_no"];
        $sub_array[] = $row["duedate"];

        if ($row["account_status"] == 'ACTIVE') {
            $sub_array[] = '<span class="badge bg-gradient-info">ACTIVE</span>';
        } else {
            $sub_array[] = '<span class="badge bg-gradient-secondary">INACTIVE</span>';
        }

        if ($row["final_status"] == 'PAID') {
            $sub_array[] = '<span class="badge bg-gradient-warning">PAID</span>';
        } else if ($row["final_status"] == 'TRANSMITTED') {
            $sub_array[] = '<span class="badge bg-gradient-success">TRANSMITTED</span>';
        } else {
            $sub_array[] = '<span class="badge bg-gradient-danger">UNPAID</span>';
        }

        if ($role == 'ADMINISTRATOR') {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getGlobeSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["globe_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getGlobeView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewGlobe" data-id="' . $row["globe_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getGlobeDelete" class="btn btn-icon btn-2 btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteGlobe" data-id="' . $row["globe_id"] . '" data-name="' . $row["register_name"] . '"><i class="fa fa-trash-alt" style="font-size: 13px" title="Delete"></i> Delete</button>
                </div>';
        } else if ($role == 'ENCODER') {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getGlobeSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["globe_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getGlobeView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewGlobe" data-id="' . $row["globe_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getGlobeUpdate" class="btn btn-icon btn-2 btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addGlobe" data-id="' . $row["globe_id"] . '"><i class="fa fa-edit" style="font-size: 13px" title="Update"></i> Update</button>
                </div>';
        } else {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getGlobeSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["globe_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getGlobeView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewGlobe" data-id="' . $row["globe_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                </div>';
        }

        $data[] = $sub_array;
    }

    function get_all_data($conn)
    {
        $query = "SELECT * FROM globe_table";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }

    $output = array(
        "data"    => $data,
        // "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  get_all_data($conn),
        "recordsFiltered" => $number_filter_row
    );
} else if ($network_type == "smart") {
    $searchBRANCH = $_POST['filterBRANCH'];
    $searchRNAME = $_POST['filterRNAME'];
    $searchACCNO = $_POST['filterACCNO'];
    $searchDUEDATE = $_POST['filterDUEDATE'];
    $searchACCSTATUS = $_POST['filterACCSTATUS'];
    $searchSTATUS = $_POST['filterSTATUS'];

    $columns = array('branch', 'register_name', 'account_no', 'duedate', 'account_status', 'final_status');

    $query = "SELECT smart_id, branch, register_name, account_no, register_no, duedate, account_status, final_status FROM smart_table WHERE ";
    if ($searchBRANCH == '') {
        $query .= 'branch = branch AND ';
    } else {
        $query .= 'branch = "' . $searchBRANCH . '" AND ';
    }

    if ($searchRNAME == '') {
        $query .= 'register_name = register_name AND ';
    } else {
        $query .= 'register_name = "' . $searchRNAME . '" AND ';
    }

    if ($searchACCNO == '') {
        $query .= 'account_no = account_no AND ';
    } else {
        $query .= 'account_no = "' . $searchACCNO . '" AND ';
    }

    if ($searchDUEDATE == '') {
        $query .= 'duedate = duedate AND ';
    } else {
        $query .= 'duedate = "' . $searchDUEDATE . '" AND ';
    }

    if ($searchACCSTATUS == '') {
        $query .= 'account_status = account_status AND ';
    } else {
        $query .= 'account_status = "' . $searchACCSTATUS . '" AND ';
    }

    if ($searchSTATUS == '') {
        $query .= 'final_status = final_status ';
    } else {
        $query .= 'final_status = "' . $searchSTATUS . '" ';
    }


    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
';
    } else {
        $query .= 'ORDER BY smart_id DESC ';
    }

    $query1 = '';

    if (isset($_POST['length'])) {
        if ($_POST["length"] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    }


    $result = mysqli_query($conn, $query . $query1);


    $number_filter_row = mysqli_num_rows($result);

    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $sub_array = array();
        $sub_array[] = $row["smart_id"];
        $sub_array[] = $row["branch"];
        $sub_array[] = $row["register_name"];
        $sub_array[] = $row["account_no"];
        $sub_array[] = $row["register_no"];
        $sub_array[] = $row["duedate"];

        if ($row["account_status"] == 'ACTIVE') {
            $sub_array[] = '<span class="badge bg-gradient-success">ACTIVE</span>';
        } else {
            $sub_array[] = '<span class="badge bg-gradient-secondary">INACTIVE</span>';
        }

        if ($row["final_status"] == 'PAID') {
            $sub_array[] = '<span class="badge bg-gradient-warning">PAID</span>';
        } else if ($row["final_status"] == 'TRANSMITTED') {
            $sub_array[] = '<span class="badge bg-gradient-success">TRANSMITTED</span>';
        } else {
            $sub_array[] = '<span class="badge bg-gradient-danger">UNPAID</span>';
        }

        if ($role == 'ADMINISTRATOR') {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getSmartSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["smart_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getSmartView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewSmart" data-id="' . $row["smart_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getSmartDelete" class="btn btn-icon btn-2 btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSmart" data-id="' . $row["smart_id"] . '" data-name="' . $row["register_name"] . '"><i class="fa fa-trash-alt" style="font-size: 13px" title="Delete"></i> Delete</button>
                </div>';
        } else if ($role == 'ENCODER') {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getSmartSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["smart_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getSmartView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewSmart" data-id="' . $row["smart_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getSmartUpdate" class="btn btn-icon btn-2 btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addSmart" data-id="' . $row["smart_id"] . '"><i class="fa fa-edit" style="font-size: 13px" title="Update"></i> Update</button>
                </div>';
        } else {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getSmartSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["smart_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getSmartView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewSmart" data-id="' . $row["smart_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                </div>';
        }

        $data[] = $sub_array;
    }

    function get_all_data($conn)
    {
        $query = "SELECT * FROM smart_table";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }

    $output = array(
        "data"    => $data,
        // "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  get_all_data($conn),
        "recordsFiltered" => $number_filter_row
    );
} else {
    $searchBRANCH = $_POST['filterBRANCH'];
    $searchRNAME = $_POST['filterRNAME'];
    $searchACCNO = $_POST['filterACCNO'];
    $searchDUEDATE = $_POST['filterDUEDATE'];
    $searchACCSTATUS = $_POST['filterACCSTATUS'];
    $searchSTATUS = $_POST['filterSTATUS'];

    $columns = array('branch', 'register_name', 'account_no', 'duedate', 'account_status', 'final_status');

    $query = "SELECT pldt_id, branch, register_name, account_no, register_no, duedate, account_status, final_status FROM pldt_table WHERE ";
    if ($searchBRANCH == '') {
        $query .= 'branch = branch AND ';
    } else {
        $query .= 'branch = "' . $searchBRANCH . '" AND ';
    }

    if ($searchRNAME == '') {
        $query .= 'register_name = register_name AND ';
    } else {
        $query .= 'register_name = "' . $searchRNAME . '" AND ';
    }

    if ($searchACCNO == '') {
        $query .= 'account_no = account_no AND ';
    } else {
        $query .= 'account_no = "' . $searchACCNO . '" AND ';
    }

    if ($searchDUEDATE == '') {
        $query .= 'duedate = duedate AND ';
    } else {
        $query .= 'duedate = "' . $searchDUEDATE . '" AND ';
    }

    if ($searchACCSTATUS == '') {
        $query .= 'account_status = account_status AND ';
    } else {
        $query .= 'account_status = "' . $searchACCSTATUS . '" AND ';
    }

    if ($searchSTATUS == '') {
        $query .= 'final_status = final_status ';
    } else {
        $query .= 'final_status = "' . $searchSTATUS . '" ';
    }


    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
';
    } else {
        $query .= 'ORDER BY pldt_id DESC ';
    }

    $query1 = '';

    if (isset($_POST['length'])) {
        if ($_POST["length"] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    }


    $result = mysqli_query($conn, $query . $query1);


    $number_filter_row = mysqli_num_rows($result);

    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        $sub_array = array();
        $sub_array[] = $row["pldt_id"];
        $sub_array[] = $row["branch"];
        $sub_array[] = $row["register_name"];
        $sub_array[] = $row["account_no"];
        $sub_array[] = $row["register_no"];
        $sub_array[] = $row["duedate"];

        if ($row["account_status"] == 'ACTIVE') {
            $sub_array[] = '<span class="badge bg-gradient-danger">ACTIVE</span>';
        } else {
            $sub_array[] = '<span class="badge bg-gradient-secondary">INACTIVE</span>';
        }

        if ($row["final_status"] == 'PAID') {
            $sub_array[] = '<span class="badge bg-gradient-warning">PAID</span>';
        } else if ($row["final_status"] == 'TRANSMITTED') {
            $sub_array[] = '<span class="badge bg-gradient-success">TRANSMITTED</span>';
        } else {
            $sub_array[] = '<span class="badge bg-gradient-danger">UNPAID</span>';
        }

        if ($role == 'ADMINISTRATOR') {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getPLDTSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["pldt_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getPLDTView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewPLDT" data-id="' . $row["pldt_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getPLDTDelete" class="btn btn-icon btn-2 btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePLDT" data-id="' . $row["pldt_id"] . '" data-name="' . $row["register_name"] . '"><i class="fa fa-trash-alt" style="font-size: 13px" title="Delete"></i> Delete</button>
                </div>';
        } else if ($role == 'ENCODER') {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getPLDTSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["pldt_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getPLDTView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewPLDT" data-id="' . $row["pldt_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                <button type="button" id="getPLDTUpdate" class="btn btn-icon btn-2 btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addPLDT" data-id="' . $row["pldt_id"] . '"><i class="fa fa-edit" style="font-size: 13px" title="Update"></i> Update</button>
                </div>';
        } else {
            $sub_array[] = '<div style="display:flex; justify-content:center; gap:10px; margin-top:10px">
                <button type="button" id="getPLDTSOA" class="btn btn-icon btn-2 btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewSOA" aria-controls="offcanvasRight" data-name="' . $row["register_name"] . '" data-id="' . $row["pldt_id"] . '"><i class="fa-solid fa-file-pdf" style="font-size: 13px" title="SOA"></i> SOA</button>
                <button type="button" id="getPLDTView" class="btn btn-icon btn-2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewPLDT" data-id="' . $row["pldt_id"] . '"><i class="fa fa-eye" style="font-size: 13px" title="View"></i> View</button>
                </div>';
        }

        $data[] = $sub_array;
    }

    function get_all_data($conn)
    {
        $query = "SELECT * FROM pldt_table";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }

    $output = array(
        "data"    => $data,
        // "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  get_all_data($conn),
        "recordsFiltered" => $number_filter_row
    );
}
echo json_encode($output);
