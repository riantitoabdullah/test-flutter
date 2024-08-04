<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>PT. Maha Akbar Sejahtera.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="./Assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css" />
  <!-- STYLE CSS -->
  <link rel="stylesheet" href="./Assets/css/style.css" />
</head>

<body>
  <div class="wrapper" style="background-image: url('./Assets/images/fbs.png')">
    <div class="inner">
      <div class="image-holder">
        <img src="./Assets/images/register.jpg" alt="" />
      </div>
      <form method="post" action="register.php">
        <br /><br /><br /><br />
        <h3>Form Registrasi</h3>
        <br />
        <div class="form-wrapper">
          <input type="text" placeholder="Username" id="username" name="username" class="form-control" required />
          <i class="zmdi zmdi-account"></i>
        </div>
        <div class="form-wrapper">
          <input type="password" placeholder="Password" id="password" name="password" class="form-control" required />
          <i class="zmdi zmdi-lock"></i>
        </div>
        <p>Sudah mempunyai Akun? <a href="./login.html" style="text-decoration: none; color: brown">Login</a> Sekarang</p>
        <button type="submit">Register<i class="zmdi zmdi-arrow-right"></i></button>
      </form>
    </div>
  </div>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    setcookie('username', $username, time() + (86400 * 30), "/"); // 30 hari
    setcookie('password', $password, time() + (86400 * 30), "/"); // 30 hari

    echo '<p>User registered successfully!</p>';
    echo '<script>window.location.href = "login.php";</script>';
  }
  ?>
</body>

</html>