<?php
include 'config.php'; // เชื่อมต่อกับฐานข้อมูล

// ดึงข้อมูลแอดมินจากฐานข้อมูล
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการแอดมิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>จัดการแอดมิน</h2>
    
    <a href="add_admin.php" class="btn btn-primary mb-3">เพิ่มแอดมิน</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อผู้ใช้</th>
                <th>บทบาท</th>
                <th>วันที่สร้าง</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>
                            <a href='edit_admin.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>แก้ไข</a>
                            <a href='delete_admin.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้?\")'>ลบ</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลแอดมิน</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="admin_dashboard.html" class="btn btn-secondary mb-3">← กลับหน้า Dashboard</a>
</div>
</body>
</html>
