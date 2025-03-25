<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบผู้ดูแลระบบ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f1f2f3;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-box h4 {
      text-align: center;
      margin-bottom: 25px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h4>🔐 เข้าสู่ระบบผู้ดูแลระบบ</h4>
    <form method="post" action="check_login.php">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-dark w-100">เข้าสู่ระบบ</button>
      <div class="text-center mt-3">
        <a href="register.php">สมัครสมาชิก</a>
      </div>
    </form>
  </div>
</body>
</html>
