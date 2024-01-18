<?php
session_start();

include_once('config/connection.php');

// Inisialisasi variabel
$errUser = $errNamaDepan = $errNamaBelakang = $errEmail = $errPass = '';

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

  // Validasi nama depan
  if (empty(test_input($_POST['namaDepan']))) {
    $errNamaDepan = 'Nama depan diperlukan';
  } else {
    $namaDepan = test_input($_POST['namaDepan']);
    // Validasi format nama depan (contoh: hanya huruf)
    if (!preg_match('/^[a-zA-Z]+$/', $namaDepan)) {
      $errNamaDepan = 'Hanya huruf yang diperbolehkan';
    }
  }

  // Validasi nama belakang
  if (empty(test_input($_POST['namaBelakang']))) {
    $namaBelakang = test_input($_POST['namaBelakang']);
  } else {
    $namaBelakang = test_input($_POST['namaBelakang']);
    // Validasi format nama belakang (contoh: hanya huruf)
    if (!preg_match('/^[a-zA-Z]+$/', $namaBelakang)) {
      $errNamaBelakang = 'Hanya huruf yang diperbolehkan';
    }
  }


  // Validasi email
  if (empty(test_input($_POST['email']))) {
    $errEmail = 'Email diperlukan';
  } else {
    $email = test_input($_POST['email']);
    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errEmail = 'Format email tidak valid';
    }
  }

  // Validasi password
  if (empty(test_input($_POST['password']))) {
    $errPass = 'Password diperlukan';
  }

  // Jika tidak ada kesalahan, lanjutkan dengan proses registrasi
  if (empty($errUser) && empty($errNamaDepan) && empty($errNamaBelakang) && empty($errEmail) && empty($errPass)) {
    $password = sha1(test_input($_POST['password']));

    // Query untuk mengecek apakah username sudah ada dalam database
    $checkUsernameQuery = "SELECT * FROM users WHERE username='$username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
      // Jika username sudah ada, set pesan kesalahan
      $_SESSION['flash_error'] = 'Username sudah digunakan. Silakan pilih username lain.';
      header('Location: register.php'); // Sesuaikan dengan halaman registrasi yang diinginkan
      exit();
    }

    // Query untuk menambahkan user ke database
    $insertUserQuery = "INSERT INTO users (username, nama_depan, nama_belakang, email, password, role) VALUES ('$username', '$namaDepan', '$namaBelakang', '$email', '$password', 'user')";
    $result = mysqli_query($conn, $insertUserQuery);

    if ($result) {
      // Jika registrasi berhasil
      mysqli_close($conn);
      echo "<script>alert('Registrasi berhasil, silahkan login');window.location.href='login.php';</script>";
      exit();
    } else {
      // Jika terjadi kesalahan saat registrasi
      $_SESSION['flash_error'] = 'Terjadi kesalahan saat registrasi';
      header('Location: register.php'); // Sesuaikan dengan halaman registrasi yang diinginkan
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
  <title>Konsertix - Register</title>

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

  <div class="card p-5 my-5">
    <div class="card-body">
      <h3 class="card-title text-center">R E G I S T E R</h3>

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

      <form action="register.php" method="post">
        <div class="form-group mt-4">
          <label for="username">Username<span class="error">* <?= $errUser; ?></span></label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
        </div>
        <div class="form-group mt-4">
          <label for="namaDepan">Nama Depan<span class="error">* <?= $errNamaDepan; ?></span></label>
          <input type="text" name="namaDepan" class="form-control" id="namaDepan" placeholder="Masukkan nama depan" required>
        </div>
        <div class="form-group mt-4">
          <label for="namaBelakang">Nama Belakang<span class="error"> <?= $errNamaBelakang; ?></span></label>
          <input type="text" name="namaBelakang" class="form-control" id="namaBelakang" placeholder="Masukkan nama belakang">
        </div>
        <div class="form-group mt-4">
          <label for="email">Email<span class="error">* <?= $errEmail; ?></span></label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
        </div>
        <div class="form-group mt-3">
          <label for="password">Password<span class="error">* <?= $errPass; ?></span></label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block mt-3">Register</button>
      </form>
      <span class="mt-2">Sudah punya akun? <a href="login.php">Login disini</a></span>
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