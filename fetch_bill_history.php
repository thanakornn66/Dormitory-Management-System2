<?php
include 'config.php';

$room_number = $_GET['room'] ?? '';
$room_number = $conn->real_escape_string($room_number);

$sql = "
SELECT p.billing_month, p.rent_price, p.water_total, p.electric_total, p.common_fee, p.amount
FROM payments p
JOIN tenants t ON p.tenant_id = t.id
JOIN rooms r ON t.room_id = r.id
WHERE r.room_number = '$room_number' AND p.payment_type = 'monthly'
ORDER BY p.billing_month DESC
";

$result = $conn->query($sql);
$rows = [];

while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rows);
    