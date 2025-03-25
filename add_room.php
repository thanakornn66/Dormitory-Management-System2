<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$room_number = $conn->real_escape_string($data['room_number']);
$type_id = (int) $data['type_id'];
$status = $conn->real_escape_string($data['status']);

$sql = "INSERT INTO rooms (room_number, type_id, status) VALUES ('$room_number', $type_id, '$status')";

if ($conn->query($sql)) {
    echo "เพิ่มห้องสำเร็จ!";
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}
?>
