<?php
include 'config.php';

// เช็คว่ามีการส่งข้อมูลมาแก้ไขหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $conn->real_escape_string($data['name']);
    $address = $conn->real_escape_string($data['address']);
    $phone = $conn->real_escape_string($data['phone']);
    $email = $conn->real_escape_string($data['email']);

    // อัปเดตในตาราง dorm_info
    $check = $conn->query("SELECT id FROM dorm_info LIMIT 1");
    if ($check->num_rows > 0) {
        $conn->query("UPDATE dorm_info SET name='$name', address='$address', phone='$phone', email='$email' WHERE id=1");
    } else {
        $conn->query("INSERT INTO dorm_info (id, name, address, phone, email) VALUES (1, '$name', '$address', '$phone', '$email')");
    }

    echo "บันทึกข้อมูลสำเร็จ";
    exit;
}

// ดึงข้อมูลหอพักจากฐานข้อมูลจริง
$result = $conn->query("SELECT * FROM dorm_info WHERE id = 1");
$dormInfo = $result->fetch_assoc() ?: [
    'name' => '-',
    'address' => '-',
    'phone' => '-',
    'email' => '-'
];

// ดึงจำนวนห้องทั้งหมด
$total = $conn->query("SELECT COUNT(*) AS total FROM rooms")->fetch_assoc()['total'] ?? 0;

// ดึงจำนวนห้องว่าง
$available = $conn->query("SELECT COUNT(*) AS available FROM rooms WHERE status = 'available'")->fetch_assoc()['available'] ?? 0;

$dormInfo['total_rooms'] = $total;
$dormInfo['available_rooms'] = $available;

header('Content-Type: application/json');
echo json_encode($dormInfo);
?>
