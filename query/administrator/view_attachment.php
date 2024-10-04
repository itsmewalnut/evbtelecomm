<?php
include('../../database/db_conn.php');

$data = stripcslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$idid = $mydata['soa_id'];
$slipType = $mydata['soa_type'];

$data = '<div class="pdf-grid">'; // Start a grid container

if ($slipType == "globe") {
    $stmt = $conn->prepare("SELECT file_location, file_name, date_paid FROM globe_attachment WHERE globe_id = ?");
} elseif ($slipType == "smart") {
    $stmt = $conn->prepare("SELECT file_location, file_name, date_paid FROM smart_attachment WHERE smart_id = ?");
} else {
    $stmt = $conn->prepare("SELECT file_location, file_name, date_paid FROM pdlt_attachment WHERE pdlt_id = ?");
}

// Bind the idid parameter
$stmt->bind_param("s", $idid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $datePaid = new DateTime($row['date_paid']);
    $formattedDate = $datePaid->format('F d, Y');

    $data .= '<a href="' . htmlspecialchars($row['file_location']) . '" target="_blank" class="pdf-thumbnail">
            <h6 class="pdftitle mb-1 text-sm">' . htmlspecialchars($formattedDate) . '</h6>
            <div class="pdfview card card-body border card-plain border-radius-lg d-flex align-items-center flex-row p-2">
            <img class="w-10 me-3 mb-0" src="../../image/pdf-thumbnail.png" alt="logo">
            <h6 class="mb-0 text-sm">' . htmlspecialchars($row['file_name']) . '</h6>
            </div>
            </a>';
}

$stmt->close();
$data .= '</div>'; // Close the grid container

echo $data;
