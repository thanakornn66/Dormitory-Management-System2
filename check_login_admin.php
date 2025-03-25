<?php
session_start();
include 'config.php'; // เชื่อมฐานข้อมูล

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password']) && $row['role'] === 'admin') {
        $_SESSION['admin_login'] = $row['username'];
        header("Location: admin_dashboard.html");
        exit();
    } else {
        echo "<script>alert('รหัสผ่านไม่ถูกต้อง หรือไม่ใช่แอดมิน'); window.location.href='login_admin.php';</script>";
    }
} else {
    echo "<script>alert('ไม่พบบัญชีผู้ใช้นี้'); window.location.href='login_admin.php';</script>";
}
?>
