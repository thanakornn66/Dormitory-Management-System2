<?php
include 'config.php';

$room_id = $_GET['room_id'] ?? '';
$room_no = $_GET['roomNo'] ?? '';
$act = $_GET['act'] ?? '';

// ถ้าไม่ได้เลือก act=bill แสดงรายการห้องก่อน
if ($act !== 'bill' || !$room_id || !$room_no) {
  $sql = "SELECT id, room_number, status FROM rooms ORDER BY room_number ASC";
  $result = $conn->query($sql);
  ?>
  <!DOCTYPE html>
  <html lang="th">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ออกแบบบิลรายเดือน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body { background-color: #f8f9fa; }
      .sidebar {
        height: 100vh;
        background-color:rgb(33, 33, 33);
        color: white;
        padding: 20px 10px;
      }
      .sidebar a {
        color: white;
        display: block;
        padding: 10px;
        text-decoration: none;
      }
      .sidebar a:hover {
        background-color: #495057;
      }
      .content { padding: 20px; }
      .room-card {
        background-color: #28a745;
        color: white;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 15px;
        cursor: pointer;
        font-weight: bold;
      }
      .room-card:hover {
        background-color: #218838;
      }
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <h5 class="mb-3">เจ้าของหอพัก</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link text-white" href="admin_dashboard.html">📊 Dashboard</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="bill.php">📄 ออกแบบบิลรายเดือน</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="manage_tenants.php">👥 จัดการลูกค้ารายเดือน</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="dorm_info.html">🏢 ข้อมูลหอพัก</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="manage_rooms.html">🏘 จัดการห้องพัก</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">🛠 จัดการ Admin</a></li>
          <li><a href="logout.php" class="nav-link text-danger" style="text-decoration: none;">🚪 ออกจากระบบ</a></li>

        </ul>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 content">
        <h4 class="mb-4">:: รายการห้องพักรายเดือน ::</h4>
        <div class="row">
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-2 col-6">
              <a href="bill.php?room_id=<?= $row['id'] ?>&roomNo=<?= $row['room_number'] ?>&act=bill" class="text-decoration-none">
                <div class="room-card">
                  ห้อง <?= htmlspecialchars($row['room_number']) ?><br>
                  (<?= $row['status'] === 'booked' ? 'มีลูกค้า' : 'ว่าง' ?>)
                </div>
              </a>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
  </body>
  </html>
  <?php
  exit;
}

// ถ้าเลือกห้องแล้ว (act=bill)
include 'bill_form.php';
