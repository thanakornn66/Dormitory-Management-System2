<?php
include 'config.php';

// ดึงเฉพาะห้องที่มีลูกค้าและเป็นประเภทเช่ารายเดือน
$sql = "
SELECT r.room_number
FROM rooms r
JOIN tenants t ON r.id = t.room_id
WHERE t.checkout_date IS NULL
";

$result = $conn->query($sql);

$rooms = [];
while ($row = $result->fetch_assoc()) {
  $rooms[] = ["room_number" => $row["room_number"]];
}

header('Content-Type: application/json');
echo json_encode($rooms);
?>