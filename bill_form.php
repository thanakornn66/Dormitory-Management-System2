<?php
include 'config.php';

$room_id = $_GET['room_id'] ?? '';
$room_no = $_GET['roomNo'] ?? '';

// ดึงค่าเช่าปัจจุบันของห้อง
$sql = "SELECT r.room_number, r.id, r.type_id, t.price_monthly FROM rooms r JOIN room_types t ON r.type_id = t.id WHERE r.id = '$room_id'";
$result = $conn->query($sql);
$room = $result->fetch_assoc();
$rent_price = $room['price_monthly'] ?? 0;
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>บันทึกบิลห้อง <?php echo htmlspecialchars($room_no); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
<div class="col-md-2 bg-dark text-white p-3" style="min-height: 100vh">
  <h5 class="mb-3">เจ้าของหอพัก</h5>
  <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link text-white" href="admin_dashboard.html">📊 Dashboard</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="bill.php">📄 ออกแบบบิลรายเดือน</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="manage_tenants.php">👥 จัดการลูกค้ารายเดือน</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="dorm_info.html">🏢 ข้อมูลหอพัก</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="manage_rooms.html">🏘 จัดการห้องพัก</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="admin.php">🛠 จัดการ Admin</a></li>
    <li><a href="logout.php" class="nav-link text-danger" style="text-decoration: none;">🚪 ออกจากระบบ</a></li>
  </ul>
</div>


    <!-- Content -->
    <div class="col-md-10 p-4">
      <h4 class="mb-4">:: บันทึกบิลห้อง <?php echo htmlspecialchars($room_no); ?> ::</h4>

      <form method="POST" action="submit_bill.php" id="billForm">
        <div class="row mb-3">
          <div class="col-md-3">
            <label class="form-label">รอบบิล</label>
            <input type="month" name="billing_month" class="form-control" required>
            <input type="hidden" name="room_number" value="<?php echo $room_no; ?>">
          </div>
          <div class="col-md-3">
            <label class="form-label">ค่าเช่าห้อง</label>
            <input type="number" name="rent_price" id="rent_price" class="form-control" value="<?php echo $rent_price; ?>">
          </div>
        </div>

        <h6 class="text-primary">ค่าน้ำ</h6>
        <div class="row mb-3">
          <div class="col">
            <input type="number" id="water_old" placeholder="เลขมิเตอร์ (ก่อน)" class="form-control">
          </div>
          <div class="col">
            <input type="number" id="water_new" placeholder="เลขมิเตอร์ (ครั้งนี้)" class="form-control">
          </div>
          <div class="col">
            <input type="number" id="water_rate" value="20" placeholder="ราคาน้ำ/หน่วย" class="form-control">
          </div>
          <div class="col">
            <input type="number" id="water_total" name="water_total" placeholder="รวมค่าน้ำ" class="form-control" readonly>
          </div>
        </div>

        <h6 class="text-primary">ค่าไฟ</h6>
        <div class="row mb-3">
          <div class="col">
            <input type="number" id="elec_old" placeholder="เลขมิเตอร์ (ก่อน)" class="form-control">
          </div>
          <div class="col">
            <input type="number" id="elec_new" placeholder="เลขมิเตอร์ (ครั้งนี้)" class="form-control">
          </div>
          <div class="col">
            <input type="number" id="elec_rate" value="7" placeholder="ราคาไฟ/หน่วย" class="form-control">
          </div>
          <div class="col">
            <input type="number" id="elec_total" name="electric_total" placeholder="รวมค่าไฟ" class="form-control" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>ค่าส่วนกลาง</label>
            <input type="number" name="common_fee" id="common_fee" class="form-control">
          </div>
          <div class="col-md-6">
            <label>รวมทั้งหมด</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">บันทึกบิล</button>

        <h5 class="mt-5">รายการบิลย้อนหลัง</h5>
<table class="table table-bordered table-striped mt-3">
  <thead class="table-dark">
    <tr>
      <th>รอบบิล</th>
      <th>ค่าเช่า</th>
      <th>น้ำ</th>
      <th>ไฟ</th>
      <th>ส่วนกลาง</th>
      <th>รวม</th>
      <th>สถานะ</th>
      <th>พิมพ์</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT * FROM bills WHERE room_number = '$room_no' ORDER BY billing_month DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
    ?>
      <tr>
        <td><?php echo htmlspecialchars($row['billing_month']); ?></td>
        <td><?php echo number_format($row['rent_price'], 2); ?></td>
        <td><?php echo number_format($row['water_total'], 2); ?></td>
        <td><?php echo number_format($row['electric_total'], 2); ?></td>
        <td><?php echo number_format($row['common_fee'], 2); ?></td>
        <td><?php echo number_format($row['amount'], 2); ?></td>
        <td><span class="text-success fw-bold">จ่ายแล้ว</span></td>
        <td><a href="print_bill.php?bill_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">พิมพ์</a></td>
      </tr>
    <?php endwhile; else: ?>
      <tr><td colspan="8" class="text-center text-muted">ไม่พบบิลย้อนหลัง</td></tr>
    <?php endif; ?>
  </tbody>
</table>

      </form>
    </div>
  </div>
</div>

<script>
function calculate() {
  const wOld = parseFloat(document.getElementById('water_old').value) || 0;
  const wNew = parseFloat(document.getElementById('water_new').value) || 0;
  const wRate = parseFloat(document.getElementById('water_rate').value) || 0;
  const eOld = parseFloat(document.getElementById('elec_old').value) || 0;
  const eNew = parseFloat(document.getElementById('elec_new').value) || 0;
  const eRate = parseFloat(document.getElementById('elec_rate').value) || 0;
  const rent = parseFloat(document.getElementById('rent_price').value) || 0;
  const common = parseFloat(document.getElementById('common_fee').value) || 0;

  const water = (wNew - wOld) * wRate;
  const elec = (eNew - eOld) * eRate;
  document.getElementById('water_total').value = isNaN(water) ? 0 : water.toFixed(2);
  document.getElementById('elec_total').value = isNaN(elec) ? 0 : elec.toFixed(2);
  const total = rent + common + (isNaN(water) ? 0 : water) + (isNaN(elec) ? 0 : elec);
  document.getElementById('total').value = total.toFixed(2);
}

['water_old','water_new','water_rate','elec_old','elec_new','elec_rate','common_fee','rent_price']
  .forEach(id => document.getElementById(id).addEventListener('input', calculate));
</script>
</body>
</html>