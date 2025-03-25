<?php
include 'config.php';

$bill_id = $_GET['bill_id'] ?? '';

if (!$bill_id) {
  echo "ไม่พบข้อมูลบิล";
  exit;
}

$sql = "SELECT * FROM bills WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bill_id);
$stmt->execute();
$result = $stmt->get_result();
$bill = $result->fetch_assoc();

if (!$bill) {
  echo "ไม่พบข้อมูลบิล";
  exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ใบเสร็จห้อง <?php echo htmlspecialchars($bill['room_number']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
    body {
      padding: 40px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h4 class="text-center mb-4">ใบเสร็จค่าเช่าห้องพัก</h4>

    <div class="mb-3">
      <strong>ห้อง:</strong> <?php echo htmlspecialchars($bill['room_number']); ?><br>
      <strong>รอบบิล:</strong> <?php echo htmlspecialchars($bill['billing_month']); ?><br>
      <strong>วันที่ออกบิล:</strong> <?php echo date("d/m/Y", strtotime($bill['created_at'])); ?>
    </div>

    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>รายการ</th>
          <th class="text-end">จำนวนเงิน (บาท)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>ค่าเช่าห้อง</td>
          <td class="text-end"><?php echo number_format($bill['rent_price'], 2); ?></td>
        </tr>
        <tr>
          <td>ค่าน้ำ</td>
          <td class="text-end"><?php echo number_format($bill['water_total'], 2); ?></td>
        </tr>
        <tr>
          <td>ค่าไฟ</td>
          <td class="text-end"><?php echo number_format($bill['electric_total'], 2); ?></td>
        </tr>
        <tr>
          <td>ค่าส่วนกลาง</td>
          <td class="text-end"><?php echo number_format($bill['common_fee'], 2); ?></td>
        </tr>
        <tr class="table-success">
          <th>รวมทั้งหมด</th>
          <th class="text-end"><?php echo number_format($bill['amount'], 2); ?></th>
        </tr>
      </tbody>
    </table>

    <div class="mt-4">
      <p>......................................................</p>
      <p>ลงชื่อผู้รับเงิน</p>
    </div>

    <div class="mt-3 no-print">
      <button class="btn btn-secondary" onclick="window.print()">🖨 พิมพ์ใบเสร็จ</button>
      <a href="bill_form.php?room_id=<?php echo $bill['room_number']; ?>&roomNo=<?php echo $bill['room_number']; ?>" class="btn btn-link">← กลับ</a>
    </div>
  </div>
</body>
</html>
