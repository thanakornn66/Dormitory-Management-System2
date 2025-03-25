<?php
include 'config.php'; // เชื่อมต่อกับฐานข้อมูล

// เช็คการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $id_card = $_POST['id_card'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    // เช็คว่า room_id มีอยู่ในตาราง rooms หรือไม่
    $check_room_sql = "SELECT id FROM rooms WHERE id = '$room_id'";
    $check_result = $conn->query($check_room_sql);

    if ($check_result->num_rows == 0) {
        echo "ห้องหมายเลขนี้ไม่พบในระบบ กรุณาตรวจสอบห้องอีกครั้ง";
    } else {
        // ถ้ามี room_id ในตาราง rooms ก็ทำการเพิ่มข้อมูลผู้เช่าได้
        $sql = "INSERT INTO tenants (room_id, id_card, name, phone, status) VALUES ('$room_id', '$id_card', '$name', '$phone', '$status')";
        if ($conn->query($sql) === TRUE) {
            echo "บันทึกข้อมูลผู้เช่าเรียบร้อยแล้ว";
        } else {
            echo "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลผู้เช่า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>เพิ่มข้อมูลผู้เช่า</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="room_id" class="form-label">หมายเลขห้อง:</label>
            <input type="text" name="room_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_card" class="form-label">หมายเลขบัตรประชาชน:</label>
            <input type="text" name="id_card" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ - นามสกุล:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">เบอร์โทร:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">สถานะ:</label>
            <select name="status" class="form-control" required>
                <option value="เข้าพัก">เข้าพัก</option>
                <option value="ออกแล้ว">ออกแล้ว</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
    </form>
</div>
</body>
</html>
