<?php
session_start();
session_destroy(); // ล้าง session ทั้งหมด
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ออกจากระบบแล้ว</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .logout-box {
      text-align: center;
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <div class="logout-box">
    <h4 class="mb-3 text-success">✅ ออกจากระบบเรียบร้อยแล้ว</h4>
    <p>คุณได้ทำการออกจากระบบเรียบร้อย</p>
    <a href="login_admin.php" class="btn btn-dark mt-3">กลับไปหน้า Login</a>
  </div>
</body>
</html>
