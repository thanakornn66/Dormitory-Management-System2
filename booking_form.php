<?php
include 'config.php';

// ดึงข้อมูลห้องจากฐานข้อมูล
$sql = "SELECT id, room_number, status FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มบันทึกข้อมูลการจองห้องพัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>ฟอร์มบันทึกข้อมูลการจองห้องพัก</h2>
    <form method="POST" action="submit_booking.php">
        <!-- เลือกห้อง -->
        <div class="mb-3">
            <label for="room_id" class="form-label">ห้อง</label>
            <select name="room_id" id="room_id" class="form-select" required>
                <option value="" disabled selected>เลือกห้อง</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        ห้อง <?php echo $row['room_number']; ?> (<?php echo $row['status'] === 'booked' ? 'มีลูกค้า' : 'ว่าง'; ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- ฟอร์มกรอกข้อมูล -->
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้จอง</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">เบอร์โทร</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="checkin_date" class="form-label">วันที่เข้าพัก (Check-in)</label>
            <input type="date" name="checkin_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="checkout_date" class="form-label">วันที่ออก (Checkout)</label>
            <input type="date" name="checkout_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_days" class="form-label">จำนวนวันพัก</label>
            <input type="number" name="total_days" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">ราคารวม (บาท)</label>
            <input type="number" name="total_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">วิธีการชำระเงิน</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="ไม่ชำระ">ไม่ชำระ</option>
                <option value="ชำระแล้ว">ชำระแล้ว</option>
                <option value="มัดจำ">มัดจำ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">สถานะ</label>
            <select name="status" class="form-select" required>
                <option value="checkin">Check-in</option>
                <option value="checkout">Check-out</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
    </form>
</div>
</body>
</html>
