<?php
include 'config.php';

if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // ลบข้อมูลแอดมินจากฐานข้อมูล
    $sql = "DELETE FROM admins WHERE id = '$admin_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); // รีไดเรกไปที่หน้าจัดการแอดมิน
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>
