<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล
include 'config.php';

// คำสั่ง SQL เพื่อดึงข้อมูลหมายเลขห้องและจำนวนห้อง
$sql = "SELECT room_number, COUNT(id) AS room_count FROM rooms GROUP BY room_number";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการห้องพัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>รายชื่อห้องพัก</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>หมายเลขห้อง</th>
                <th>จำนวนห้อง</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // ตรวจสอบว่ามีข้อมูลห้องหรือไม่
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['room_number'] . "</td>";
                    echo "<td>" . $row['room_count'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center text-muted'>ไม่พบห้อง</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
