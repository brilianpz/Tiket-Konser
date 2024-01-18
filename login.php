<?php
session_start();

if (isset($_SESSION['status'])) {
  header("Location: index.php");
  exit();
}

include_once('config/connection.php');

// Inisialisasi variabel
$errUser = $errPass = $errCaptcha = '';

// Validasi form saat pengiriman
if (isset($_POST['submit'])) {
  // Validasi username
  if (empty(test_input($_POST['username']))) {
    $errUser = 'Username diperlukan';
  } else {
    $username = test_input($_POST['username']);
    // Validasi format username (contoh: hanya huruf dan angka)
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
      $errUser = 'Hanya huruf dan angka yang diperbolehkan';
    }
  }

  // Validasi password
  if (empty(test_input($_POST['password']))) {
    $errPass = 'Password diperlukan';
  }

  // Validasi captcha
  if (test_input($_POST['captcha']) != $_SESSION['captcha_code']) {
    $errCaptcha = 'Kode captcha salah';
  }

  // Jika tidak ada kesalahan, lanjutkan dengan proses login
  if (empty($errUser) && empty($errPass) && empty($errCaptcha)) {

    $password = sha1(test_input($_POST['password']));

    // cek username dan password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $cek = mysqli_num_rows($result);
    $r = mysqli_fetch_array($result);

    if ($cek > 0) {
      // Jika username dan password benar, set session dan redirect
      $_SESSION['userid'] = $r['userid'];
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $r['email'];
      $_SESSION['role'] = $r['role'];
      $_SESSION['status'] = "login";
      mysqli_close($conn);
      header("Location: index.php");
      exit();
    } else {
      // Jika username dan password salah, set pesan kesalahan login
      $_SESSION['flash_error'] = "Username atau Password Salah";
      header("Location: login.php");
      exit();
    }
  }
}

// Fungsi untuk membersihkan dan memvalidasi input
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!doctype html>
<html lang="en">

<head>

  <!--====== Required meta tags ======-->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--====== Title ======-->
  <title>Konsertix - Login</title>

  <!--====== Bootstrap css ======-->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!--====== Animate css ======-->
  <link rel="stylesheet" href="assets/css/animate.css">

  <!--====== Magnific Popup css ======-->
  <link rel="stylesheet" href="assets/css/magnific-popup.css">

  <!--====== Slick css ======-->
  <link rel="stylesheet" href="assets/css/slick.css">

  <!--====== Line Icons css ======-->
  <link rel="stylesheet" href="assets/css/LineIcons.css">

  <!--====== Default css ======-->
  <link rel="stylesheet" href="assets/css/default.css">

  <!--====== Style css ======-->
  <link rel="stylesheet" href="assets/css/style.css">

  <!--====== Responsive css ======-->
  <link rel="stylesheet" href="assets/css/responsive.css">

  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #fffaf6;
    }

    .card {
      width: 700px;
    }

    .error {
      color: red;
    }
  </style>

</head>

<body>

  <!--====== PRELOADER PART START ======-->

  <div class="preloader">
    <div class="spin">
      <div class="cube1"></div>
      <div class="cube2"></div>
    </div>
  </div>

  <!--====== PRELOADER PART START ======-->

  <div class="card p-5">
    <div class="card-body">
      <h3 class="card-title text-center">L O G I N</h3>

      <!-- pesan error login jika username atau password salah -->
      <?php if (isset($_SESSION['flash_error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $_SESSION['flash_error']; ?>
          <?php unset($_SESSION['flash_error']); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <form action="login.php" method="post">
        <div class="form-group mt-4">
          <label for="username">Username<span class="error">* <?= $errUser; ?></span></label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
        </div>
        <div class="form-group mt-3">
          <label for="password">Password<span class="error">* <?= $errPass; ?></span></label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
        </div>
        <div class="form-group mt-3">
          <label for="captcha">Captcha<span class="error">* <?= $errCaptcha; ?></span></label> <br>
          <img class="mb-2" src='captcha.php' />
          <input type="text" name="captcha" class="form-control" id="captcha" placeholder="Masukkan kode captcha" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block mt-3">Login</button>
      </form>
      <span class="mt-2">Belum punya akun? <a href="register.php">Daftar disini</a></span>
    </div>
  </div>

  <!--====== jquery js ======-->
  <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

  <!--====== Bootstrap js ======-->
  <script src="assets/js/bootstrap.min.js"></script>

  <!--====== Slick js ======-->
  <script src="assets/js/slick.min.js"></script>

  <!--====== Magnific Popup js ======-->
  <script src="assets/js/jquery.magnific-popup.min.js"></script>

  <!--====== nav js ======-->
  <script src="assets/js/jquery.nav.js"></script>

  <!--====== Nice Number js ======-->
  <script src="assets/js/jquery.nice-number.min.js"></script>

  <!--====== Main js ======-->
  <script src="assets/js/main.js"></script>

</body>

</html>