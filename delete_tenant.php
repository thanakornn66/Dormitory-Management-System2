<?php
include 'config.php';

if (isset($_GET['id'])) {
    $tenant_id = $_GET['id'];

    // ลบข้อมูลผู้เช่าจากฐานข้อมูล
    $sql = "DELETE FROM tenants WHERE id = '$tenant_id'";
    if ($conn->query($sql) === TRUE) {
        echo "ลบข้อมูลผู้เช่าเรียบร้อยแล้ว";
        header('Location: manage_tenants.php'); // รีไดเร็กต์กลับไปที่หน้าจัดการผู้เช่า
    } else {
        echo "เกิดข้อผิดพลาดในการลบ: " . $conn->error;
    }
}
?>
