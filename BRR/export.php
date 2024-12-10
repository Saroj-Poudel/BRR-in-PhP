<?php
include("databse.php");

// Retrieve filter values
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$package = isset($_GET['package']) ? $_GET['package'] : '';
$payment_mode = isset($_GET['payment_mode']) ? $_GET['payment_mode'] : '';

// Build the query
$sql = "SELECT * FROM booked_userdetails WHERE 1=1";

if ($start_date && $end_date) {
    $sql .= " AND date_of_booking BETWEEN '" . $conn->real_escape_string($start_date) . "' AND '" . $conn->real_escape_string($end_date) . "'";
} elseif ($start_date) {
    $sql .= " AND date_of_booking >= '" . $conn->real_escape_string($start_date) . "'";
} elseif ($end_date) {
    $sql .= " AND date_of_booking <= '" . $conn->real_escape_string($end_date) . "'";
}
if ($package) {
    $sql .= " AND package = '" . $conn->real_escape_string($package) . "'";
}
if ($payment_mode) {
    $sql .= " AND pay_mode = '" . $conn->real_escape_string($payment_mode) . "'";
}

$result = mysqli_query($conn, $sql);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="booked_records.xls"');
header('Cache-Control: max-age=0');

echo "ID\tDate\tStudent Name\tPackage\tAmount\tPayment Mode\n";

while ($row = mysqli_fetch_array($result)) {
    echo $row["id"] . "\t" . $row["date_of_booking"] . "\t" . $row["username"] . "\t" . $row["package"] . "\t" . $row["amount"] . "\t" . $row["pay_mode"] . "\n";
}

exit;
?>
