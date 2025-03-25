<?php
include 'config.php';

$room_number = $_POST['room_number'];
$billing_month = $_POST['billing_month'];
$rent_price = $_POST['rent_price'];
$water_total = $_POST['water_total'];
$electric_total = $_POST['electric_total'];
$common_fee = $_POST['common_fee'];
$total = $_POST['total'];

// เตรียม SQL
$stmt = $conn->prepare("INSERT INTO bills (room_number, billing_month, rent_price, water_total, electric_total, common_fee, amount)
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssddddd", $room_number, $billing_month, $rent_price, $water_total, $electric_total, $common_fee, $total);
$stmt->execute();
$stmt->close();

// ✅ ดึง room_id ด้วย (ถ้ามีส่งมาด้วย)
$room_id = $_POST['room_id'] ?? '';

// ✅ กลับไปหน้าฟอร์มบิล
header("Location: bill_form.php?room_id=$room_id&roomNo=$room_number");
exit;

?>
