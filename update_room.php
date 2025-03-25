<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$room_number = $conn->real_escape_string($data['room_number']);
$status = $conn->real_escape_string($data['status']);

$sql = "UPDATE rooms SET status = '$status' WHERE room_number = '$room_number'";

if ($conn->query($sql)) {
    echo "อัปเดตสถานะห้องเรียบร้อยแล้ว";
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}
?>
