<?php
include('../../database/db_conn.php');
date_default_timezone_set('Asia/Macao');
$date = date('Y-m-d H:i:s');

$slipType = $_POST['deleteNetworkType'];
$slipID = $_POST['deleteNetworkID'];
$slipNAME = $_POST['deleteNetworkNAME'];

// Function to delete files from the server and records from attachment tables
function deleteAttachments($conn, $attachmentTable, $slipID, $idColumn)
{
    // Select all attachment file paths related to the slip
    $stmt = $conn->prepare("SELECT file_location FROM $attachmentTable WHERE $idColumn = ?");
    $stmt->bind_param("i", $slipID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Delete files from the server
    while ($row = $result->fetch_assoc()) {
        $filePath = $row['file_location'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $stmt->close();

    // Delete records from the attachment table
    $stmt = $conn->prepare("DELETE FROM $attachmentTable WHERE $idColumn = ?");
    $stmt->bind_param("i", $slipID);
    $stmt->execute();
    $stmt->close();
}

// Determine the appropriate tables and ID columns based on slipType
switch ($slipType) {
    case "globe":
        $mainTable = "globe_table";
        $attachmentTable = "globe_attachment";
        $idColumn = "globe_id";
        break;
    case "smart":
        $mainTable = "smart_table";
        $attachmentTable = "smart_attachment";
        $idColumn = "smart_id";
        break;
    case "pldt":
        $mainTable = "pldt_table";
        $attachmentTable = "pldt_attachment";
        $idColumn = "pldt_id";
        break;
    default:
        die("Invalid slip type");
}

// Delete the files and records associated with the slip
deleteAttachments($conn, $attachmentTable, $slipID, $idColumn);

// Prepare the delete statement for the main table
$stmt = $conn->prepare("DELETE FROM $mainTable WHERE $idColumn = ?");
$stmt->bind_param("i", $slipID);
$stmt->execute();
$stmt->close();

mysqli_query($conn, "INSERT INTO activity_log(network_type, remarks, network_date, role, action) VALUES ('$slipType', '$slipNAME has been deleted in $slipType', '$date', 'ADMINISTRATOR', 'DELETE')");

$conn->close();
