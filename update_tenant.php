<?php
include 'config.php';

// รับข้อมูลจากฟอร์ม
$id = $_POST['id'] ?? '';
$id_card = $_POST['id_card'] ?? '';
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';

// อัปเดตข้อมูลในฐานข้อมูล
$sql = "UPDATE tenants SET id_card = '$id_card', name = '$name', phone = '$phone' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    // ถ้าอัปเดตสำเร็จให้กลับไปยังหน้าจัดการผู้เช่า
    header("Location: manage_tenants.php");
} else {
    echo "Error updating record: " . $conn->error;
}
?>
