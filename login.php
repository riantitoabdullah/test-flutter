<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>PT. Maha Akbar Sejahtera.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="./Assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css" />
  <link rel="stylesheet" href="./Assets/css/style.css" />
</head>

<body>
  <div class="wrapper" style="background-image: url('./Assets/images/fbs.png')">
    <div class="inner">
      <div class="image-holder">
        <img src="./Assets/images/register.jpg" alt="" />
      </div>
      <form method="post" action="login.php">
        <img src="./Assets/images/logo.png" style="width: 150px" alt="" />
        <br /><br /><br /><br /><br />
        <h3>Silahkan Login</h3>
        <div class="form-wrapper">
          <input type="text" placeholder="Masukkan User Name Anda" id="username" name="username" class="form-control" required />
          <i class="zmdi zmdi-email"></i>
        </div>

        <div class="form-wrapper">
          <input type="password" placeholder="Masukkan Password Anda" id="password" name="password" class="form-control" required />
          <i class="zmdi zmdi-lock"></i>
        </div>
        <p>Belum mempunyai Akun? <a href="./register.html" style="text-decoration: none; color: brown">Daftar</a> Sekarang</p>
        <button type="submit">Login<i class="zmdi zmdi-arrow-right"></i></button>
      </form>
    </div>
  </div>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data dari local storage (simulasi dengan cookie)
    $storedUsername = $_COOKIE['username'] ?? '';
    $storedPassword = $_COOKIE['password'] ?? '';

    if ($username === $storedUsername && $password === $storedPassword) {
      echo '<p>Login successful!</p>';
      echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
      echo '<p>Invalid username or password</p>';
    }
  }
  ?>
</body>

</html>