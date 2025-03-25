<?php
include 'config.php'; // เชื่อมต่อกับฐานข้อมูล

$sql = "SELECT * FROM tenants"; // ดึงข้อมูลจากตาราง tenants
$result = $conn->query($sql); // ประมวลผลการ query

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้เช่ารายเดือน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>รายชื่อผู้เช่ารายเดือน</h2>
    <a href="admin_dashboard.html" class="btn btn-secondary mb-3">← กลับหน้า Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>ห้อง</th>
                <th>เลขบัตรประชาชน</th>
                <th>ชื่อ - นามสกุล</th>
                <th>เบอร์โทร</th>
                <th>สถานะ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // แสดงข้อมูลจากฐานข้อมูล
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['room_id']; ?></td>
                        <td><?php echo $row['id_card']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <!-- แสดงสถานะให้ถูกต้อง -->
                        <td>
    <?php
    if($row['status'] == 'เข้าพัก'){
        echo '<span class="badge bg-success">เข้าพัก</span>';
    } else if($row['status'] == 'ออกแล้ว'){
        echo '<span class="badge bg-danger">ออกแล้ว</span>';
    } else {
        echo '<span class="badge bg-warning">ห้องว่าง</span>';
    }
    ?>
</td>

                        <td>
                            <a href="edit_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                            <a href="delete_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูลนี้?')">ลบ</a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='7' class='text-center'>ไม่มีข้อมูลผู้เช่า</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
</div>
</body>
</html>
            