<?php
// fetch_dashboard.php
include 'config.php';

$res1 = $conn->query("SELECT SUM(amount) as total_monthly FROM payments WHERE payment_type='monthly'");
$row1 = $res1->fetch_assoc();
$total_monthly = $row1['total_monthly'] ?? 0;

$res2 = $conn->query("SELECT SUM(amount) as total_daily FROM payments WHERE payment_type='daily'");
$row2 = $res2->fetch_assoc();
$total_daily = $row2['total_daily'] ?? 0;


$res3 = $conn->query("SELECT COUNT(*) as current FROM tenants WHERE checkout_date IS NULL");
$row3 = $res3->fetch_assoc();
$current_tenants = $row3['current'] ?? 0;

$res4 = $conn->query("SELECT COUNT(*) as total_rooms FROM rooms");
$row4 = $res4->fetch_assoc();
$total_rooms = $row4['total_rooms'] ?? 0;

echo json_encode([
    "monthly" => $total_monthly,
    "daily" => $total_daily,
    "tenants" => $current_tenants,
    "rooms" => $total_rooms
]);
?>