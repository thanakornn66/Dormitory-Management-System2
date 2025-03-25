<?php
include 'config.php'; // เชื่อมต่อกับฐานข้อมูล

if (isset($_GET['id'])) {
    $tenant_id = $_GET['id'];

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM tenants WHERE id = '$tenant_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $tenant = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลผู้เช่า";
        exit;
    }
}

// เช็คการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $id_card = $_POST['id_card'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    // ตรวจสอบให้แน่ใจว่า room_id มีอยู่ในตาราง rooms
    $check_room_sql = "SELECT id FROM rooms WHERE id = '$room_id'";
    $check_room_result = $conn->query($check_room_sql);
    if ($check_room_result->num_rows == 0) {
        echo "ห้องที่เลือกไม่มีในระบบ กรุณาเลือกห้องที่มีอยู่";
        exit;
    }

    // อัปเดตข้อมูล
    $sql = "UPDATE tenants SET room_id='$room_id', id_card='$id_card', name='$name', phone='$phone', status='$status' WHERE id = '$tenant_id'";
    if ($conn->query($sql) === TRUE) {
        // หลังจากอัปเดตข้อมูลสำเร็จ ให้รีไดเรกไปยังหน้า manage_tenants.php
        header("Location: manage_tenants.php");
        exit; // ใช้ exit เพื่อหยุดการทำงานของสคริปต์
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
    <title>แก้ไขข้อมูลผู้เช่า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            padding-top: 50px;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #4caf50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>แก้ไขข้อมูลผู้เช่า</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="room_id" class="form-label">หมายเลขห้อง:</label>
            <input type="text" name="room_id" class="form-control" value="<?php echo $tenant['room_id']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_card" class="form-label">หมายเลขบัตรประชาชน:</label>
            <input type="text" name="id_card" class="form-control" value="<?php echo $tenant['id_card']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ - นามสกุล:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $tenant['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">เบอร์โทร:</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $tenant['phone']; ?>" required>
        </div>

        <div class="mb-3">
        <label for="status" class="form-label">สถานะ:</label>
         <select name="status" class="form-control" required>
        <option value="เข้าพัก" <?php echo ($tenant['status'] == 'เข้าพัก') ? 'selected' : ''; ?>>เข้าพัก</option>
        <option value="ออกแล้ว" <?php echo ($tenant['status'] == 'ออกแล้ว') ? 'selected' : ''; ?>>ออกแล้ว</option>
        <option value="ห้อว่าง" <?php echo ($tenant['status'] == 'ว่าง') ? 'selected' : ''; ?>>ห้องว่าง</option>
        </select>
        </div>


        <button type="submit">อัปเดตข้อมูล</button>
    </form>
</div>

</body>
</html>
