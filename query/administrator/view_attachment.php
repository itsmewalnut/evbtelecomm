<?php
include('../../database/db_conn.php');

$idid = $_POST['id'];
$slipType = $_POST['slipType'];

$data = '';

if ($slipType == "globe") {
    $stmt = $conn->prepare("SELECT file_location FROM globe_attachment WHERE globe_id = ?");
} elseif ($slipType == "smart") {
    $stmt = $conn->prepare("SELECT file_location FROM smart_attachment WHERE smart_id = ?");
} else {
    $stmt = $conn->prepare("SELECT file_location FROM pdlt_attachment WHERE pdlt_id = ?");
}

$stmt->bind_param("s", $idid);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $data .= '<img class="w-100 h-100" id="view_attachment" href="' . htmlspecialchars($row['file_location']) . '" alt="Click here to View/Download" src="../../image/pdf-thumbnail.png">';
} else {
    echo '<img class="w-100 h-100" alt="Click here to View/Download" src="../../image/pdf-invalid.png">';
}

$stmt->close();
echo $data;

// ----------------------------------------MULTIPLE PDF FILE

// <?php
// include('../../database/db_conn.php');

// $idid = $_POST['id'];
// $slipType = $_POST['slipType'];

// $data = '<div class="pdf-grid">'; // Start a grid container

// if ($slipType == "globe") {
//     $stmt = $conn->prepare("SELECT file_location FROM globe_attachment WHERE globe_id = ?");
// } elseif ($slipType == "smart") {
//     $stmt = $conn->prepare("SELECT file_location FROM smart_attachment WHERE smart_id = ?");
// } else {
//     $stmt = $conn->prepare("SELECT file_location FROM pdlt_attachment WHERE pdlt_id = ?");
// }

// $stmt->bind_param("s", $idid); // Bind the idid parameter
// $stmt->execute();
// $result = $stmt->get_result();

// while ($row = $result->fetch_assoc()) {
//     $data .= '<a href="' . htmlspecialchars($row['file_location']) . '" target="_blank" class="pdf-thumbnail">
//                 <img class="w-100 h-100" alt="Click here to View/Download" src="../../image/pdf-thumbnail.png">
//               </a>';
// }

// $stmt->close();
// $data .= '</div>'; // Close the grid container

// echo $data;
