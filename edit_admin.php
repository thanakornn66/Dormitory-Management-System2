<?php
include 'config.php';

if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // ดึงข้อมูลแอดมินจากฐานข้อมูล
    $sql = "SELECT * FROM admins WHERE id = '$admin_id'";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();
}

// เช็คการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE admins SET username='$username', password='$password_hashed', role='$role' WHERE id = '$admin_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); // รีไดเรกไปที่หน้าจัดการแอดมิน
        exit;
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
    <title>แก้ไขข้อมูลแอดมิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>แก้ไขข้อมูลแอดมิน</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้งาน:</label>
            <input type="text" name="username" class="form-control" value="<?php echo $admin['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">บทบาท:</label>
            <select name="role" class="form-control" required>
                <option value="admin" <?php echo ($admin['role'] == 'admin') ? 'selected' : ''; ?>>แอดมิน</option>
                <option value="user" <?php echo ($admin['role'] == 'user') ? 'selected' : ''; ?>>ผู้ใช้งาน</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">อัปเดตข้อมูล</button>
    </form>
</div>
</body>
</html>
