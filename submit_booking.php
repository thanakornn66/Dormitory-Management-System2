<?php
include 'config.php';

// รับค่าจากฟอร์ม
$room_id = $_POST['room_id'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$checkin_date = $_POST['checkin_date'];
$checkout_date = $_POST['checkout_date'];
$total_days = $_POST['total_days'];
$total_price = $_POST['total_price'];
$payment_method = $_POST['payment_method'];
$status = $_POST['status'];

// บันทึกข้อมูลการจองห้องลงในฐานข้อมูล
$sql = "INSERT INTO bookings (room_id, username, phone, checkin_date, checkout_date, total_days, total_price, payment_method, status)
        VALUES ('$room_id', '$username', '$phone', '$checkin_date', '$checkout_date', '$total_days', '$total_price', '$payment_method', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "บันทึกข้อมูลการจองเรียบร้อยแล้ว";
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

$conn->close();
?>
