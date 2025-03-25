<?php
include 'config.php';

// รับห้องที่ต้องการแก้ไขจาก URL
$room_id = $_GET['room_id'] ?? '';

// ดึงข้อมูลห้องจากฐานข้อมูล
$sql = "SELECT * FROM rooms WHERE id = '$room_id'";
$result = $conn->query($sql);
$room = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_number = $_POST['room_number'];
    $price_monthly = $_POST['price_monthly'];
    $status = $_POST['status'];

    // อัปเดตข้อมูลห้องพักในฐานข้อมูล
    $update_sql = "UPDATE rooms SET room_number = '$room_number', price_monthly = '$price_monthly', status = '$status' WHERE id = '$room_id'";
    if ($conn->query($update_sql)) {
        header('Location: manage_rooms.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขห้องพัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>แก้ไขห้องพัก</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">หมายเลขห้อง</label>
                <input type="text" class="form-control" name="room_number" value="<?php echo htmlspecialchars($room['room_number']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ราคาเช่ารายเดือน (บาท)</label>
                <input type="number" class="form-control" name="price_monthly" value="<?php echo htmlspecialchars($room['price_monthly']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">สถานะ</label>
                <select class="form-control" name="status">
                    <option value="available" <?php echo ($room['status'] === 'available') ? 'selected' : ''; ?>>ว่าง</option>
                    <option value="booked" <?php echo ($room['status'] === 'booked') ? 'selected' : ''; ?>>ถูกจอง</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
        </form>
    </div>
</body>
</html>
