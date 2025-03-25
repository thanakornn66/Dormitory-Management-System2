<?php
include 'config.php'; // เชื่อมต่อกับฐานข้อมูล

// เช็คการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน
    $role = $_POST['role'];

    // เพิ่มแอดมินใหม่
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        // ถ้าเพิ่มแอดมินสำเร็จให้เด้งกลับไปหน้าแอดมิน
        echo "<script>alert('เพิ่มแอดมินสำเร็จ'); window.location.href = 'admin.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มแอดมิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>เพิ่มแอดมิน</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้:</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">บทบาท:</label>
            <select name="role" class="form-control" required>
                <option value="admin">แอดมิน</option>
                <option value="user">ผู้ใช้</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">เพิ่มแอดมิน</button>
        <a href="admin.php" class="btn btn-secondary">กลับไปหน้าแอดมิน</a>
    </form>
</div>
</body>
</html>
