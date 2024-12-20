<?php
include('../../database/db_conn.php');

$data = stripcslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$idid = $mydata['soa_id'];
$slipType = $mydata['soa_type'];
$soa_role = $mydata['soa_role'];

$data = '<div class="pdf-grid">';

if ($slipType == "globe") {
    $stmt = $conn->prepare("SELECT id, file_location, payment_image, file_name, date_paid, soa_status FROM globe_attachment WHERE globe_id = ? ORDER BY id DESC");
} elseif ($slipType == "smart") {
    $stmt = $conn->prepare("SELECT id, file_location, payment_image, file_name, date_paid, soa_status FROM smart_attachment WHERE smart_id = ? ORDER BY id DESC");
} else {
    $stmt = $conn->prepare("SELECT id, file_location, payment_image, file_name, date_paid, soa_status FROM pldt_attachment WHERE pldt_id = ? ORDER BY id DESC");
}

// Bind the idid parameter
$stmt->bind_param("s", $idid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $datePaid = new DateTime($row['date_paid']);
    $formattedDate = $datePaid->format('F d, Y');
    $data .= '<a href="' . htmlspecialchars($row['file_location']) . '" target="_blank" class="pdf-thumbnail">
                <div class="d-flex justify-content-between">
                    <h6 class="pdftitle">' . htmlspecialchars($formattedDate) . '</h6>';

    if ($row['soa_status'] == "UNPAID" && $soa_role == "CHECKER") {
        $data .= '<button class="btn btn-sm btn-outline-danger text-xs getPayment" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#paymentModal">' . htmlspecialchars($row['soa_status']) . '</button>';
    } else if ($row['soa_status'] == "UNPAID" && $soa_role != "CHECKER") {
        $data .= '<button class="btn btn-sm btn-outline-danger text-xs">' . htmlspecialchars($row['soa_status']) . '</button>';
    } else {
        $data .= '<button href="' . htmlspecialchars($row['payment_image']) . '" target="_blank" class="btn btn-sm btn-outline-warning text-xs payment-thumbnail">' . htmlspecialchars($row['soa_status']) . '</button>';
    }

    $data .= '</div>
                <div class="pdfview card card-body border card-plain border-radius-lg d-flex align-items-center flex-row p-2">
                    <img class="w-10 me-2 mb-0" src="../../image/pdf.png" alt="logo">
                    <h6 class="mb-0 text-sm">' . htmlspecialchars($row['file_name']) . '</h6>
                </div>
              </a>';
}

$stmt->close();
$data .= '</div>';

echo $data;
