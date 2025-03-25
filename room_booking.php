<?php
// รวมไฟล์การเชื่อมต่อฐานข้อมูล
include 'config.php';

// รับค่า room_id และ room_no จาก URL
$room_id = $_GET['room_id'] ?? '';
$room_no = $_GET['room_no'] ?? '';

// ถ้าไม่ได้รับค่า room_id หรือ room_no
if (empty($room_id) || empty($room_no)) {
    echo "ไม่พบข้อมูลห้อง";
    exit;
}

// ดึงข้อมูลห้องจากฐานข้อมูล
$sql = "SELECT r.room_number, r.id, r.status, t.price_monthly 
        FROM rooms r 
        JOIN room_types t ON r.type_id = t.id 
        WHERE r.id = '$room_id'";

$result = $conn->query($sql);

// ตรวจสอบว่ามีห้องที่ตรงกับ room_id หรือไม่
if ($result->num_rows > 0) {
    $room = $result->fetch_assoc();
    $room_price = $room['price_monthly'];  // ราคาเช่าห้อง
} else {
    echo "ไม่พบข้อมูลห้องนี้";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองห้องพัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>ฟอร์มจองห้อง <?php echo htmlspecialchars($room_no); ?></h2>

        <form method="POST" action="submit_booking.php">
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">

            <div class="mb-3">
                <label for="room_number" class="form-label">หมายเลขห้อง</label>
                <input type="text" class="form-control" id="room_number" value="<?php echo $room_no; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">ชื่อผู้จอง</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">เบอร์โทร</label>
                <input type="text" class="form-control" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="checkin_date" class="form-label">วันที่เข้าพัก</label>
                <input type="date" class="form-control" name="checkin_date" required>
            </div>

            <div class="mb-3">
                <label for="checkout_date" class="form-label">วันที่ออก</label>
                <input type="date" class="form-control" name="checkout_date" required>
            </div>

            <div class="mb-3">
                <label for="total_days" class="form-label">จำนวนวันพัก</label>
                <input type="number" class="form-control" name="total_days" required>
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">ราคารวม (บาท)</label>
                <input type="number" class="form-control" name="total_price" value="<?php echo $room_price; ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">บันทึกการจอง</button>
        </form>
    </div>
</body>
</html>
