<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$room_number = $conn->real_escape_string($data['room_number']);

$findRoom = $conn->query("SELECT id FROM rooms WHERE room_number = '$room_number'");
$room = $findRoom->fetch_assoc();
$room_id = $room['id'] ?? null;

if ($room_id) {
    // หาผู้เช่าทั้งหมดของห้องนี้
    $tenantRes = $conn->query("SELECT id FROM tenants WHERE room_id = $room_id");
    while ($tenant = $tenantRes->fetch_assoc()) {
        $tenant_id = $tenant['id'];
        // ลบการชำระเงินของ tenant นี้
        $conn->query("DELETE FROM payments WHERE tenant_id = $tenant_id");
    }

    // ลบผู้เช่าในห้องนี้
    $conn->query("DELETE FROM tenants WHERE room_id = $room_id");

    // ลบห้อง
    $delete = $conn->query("DELETE FROM rooms WHERE id = $room_id");

    if ($delete) {
        echo \"ลบห้องเรียบร้อยแล้ว\";
    } else {
        echo \"เกิดข้อผิดพลาดในการลบห้อง: \" . $conn->error;
    }
} else {
    echo \"ไม่พบห้องนี้ในระบบ\";
}
?>