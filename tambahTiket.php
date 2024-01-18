<?php
session_start();

// Pastikan pengguna telah login sebagai admin
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$errNama = $errLokasi = $errTanggal = $errPenyelenggara = $errHarga = $errFoto = '';

// Validasi Form
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $penyelenggara = $_POST['penyelenggara'];
    $harga = $_POST['harga'];
    $deskripsi = test_input($_POST['deskripsi']);

    // Validasi Nama Event
    if (empty(test_input($nama))) {
        $errNama = 'Nama Event tidak boleh kosong.';
    }

    // Validasi Lokasi Event
    if (empty(test_input($lokasi))) {
        $errLokasi = 'Lokasi Event tidak boleh kosong.';
    }

    // Validasi Tanggal Event
    if (empty(test_input($tanggal))) {
        $errTanggal = 'Tanggal Event tidak boleh kosong.';
    }

    // Validasi Penyelenggara Event
    if (empty(test_input($penyelenggara))) {
        $errPenyelenggara = 'Penyelenggara Event tidak boleh kosong.';
    }

    // Validasi Harga Tiket
    if (empty(test_input($harga))) {
        $errHarga = 'Harga Tiket tidak boleh kosong.';
    } else {
        if (!preg_match('/^[0-9]+$/', $harga)) {
            $errHarga = 'Hanya angka yang diperbolehkan';
        }
    }

    // Validasi Foto Tiket
    if (empty($_FILES['foto']['name'])) {
        $errFoto = 'Foto Tiket tidak boleh kosong.';
    } else {
        // Cek jenis file
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $foto_ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (!in_array($foto_ext, $allowed_types)) {
            $errFoto = 'Format foto tidak valid. Gunakan format JPG, JPEG, PNG, atau GIF.';
        }
    }

    // Jika tidak ada kesalahan validasi, simpan ke database
    // Jika tidak ada kesalahan validasi, simpan ke database
    if (empty($errNama) && empty($errLokasi) && empty($errTanggal) && empty($errPenyelenggara) && empty($errHarga) && empty($errFoto)) {
        include_once('config/connection.php');
        // Membuat nama file acak dengan menggabungkan uniqid() dan ekstensi file
        $foto_extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $foto_name = uniqid('foto_') . '.' . $foto_extension;
        $foto_path = 'uploads/' . $foto_name;

        // Proses upload file foto
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);

        // Simpan data ke database
        $sql = "INSERT INTO konser (nama, lokasi, tanggal, penyelenggara, harga, foto, deskripsi) VALUES ('$nama', '$lokasi', '$tanggal', '$penyelenggara', '$harga', '$foto_path', '$deskripsi')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Jika penyimpanan berhasil, bisa tambahkan redirect atau pesan sukses
            echo "<script>alert('Berhasil menambahkan tiket.'); window.location.href='tiketAll.php';</script>";
            mysqli_close($conn);
            exit();
        } else {
            $errEvent = 'Gagal menyimpan data event.';
            mysqli_close($conn);
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
    <title>Konsertix - Tambah</title>


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

    <!--====== HEADER PART START ======-->

    <?php include_once('layout/navbar.php'); ?>

    <!--====== HEADER PART ENDS ======-->
    <section id="blog" class="blog-area pt-125" style="background-color: #fffaf6;">
        <div class="container">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="card-title text-center">Tambah Tiket</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mt-3">
                            <label for="eventNameInput" class="form-label">Nama Event<span class="text-danger">*<?= $errNama; ?></span></label>
                            <input type="text" name="nama" class="form-control" id="eventNameInput" placeholder="Masukkan nama event" value="" required="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="lokasiEventInput" class="form-label">Lokasi Event<span class="text-danger">*<?= $errLokasi; ?></span></label>
                            <input type="text" name="lokasi" class="form-control" id="lokasiEventInput" placeholder="Masukkan lokasi event" value="" required="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="tanggalEventInput" class="form-label">Tanggal Event<span class="text-danger">*<?= $errTanggal; ?></span></label>
                            <input type="datetime-local" name="tanggal" class="form-control" id="tanggalEventInput">
                        </div>
                        <div class="form-group mt-3">
                            <label for="penyelenggaranInput" class="form-label">Penyelenggara Event<span class="text-danger">*<?= $errPenyelenggara; ?></span></label>
                            <input type="text" name="penyelenggara" class="form-control" id="penyelenggaranInput" placeholder="Masukkan penyelenggara" value="" required="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="hargaTiketInput" class="form-label">Harga Tiket<span class="text-danger">*<?= $errHarga; ?></span></label>
                            <input type="text" name="harga" class="form-control" id="hargaTiketInput" placeholder="Masukkan harga tiket" value="" required="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="fotoInput" class="form-label">Foto Tiket<span class="text-danger">*<?= $errFoto; ?></span></label>
                            <input type="file" name="foto" class="form-control" id="fotoInput" value="" required="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="deskripsiInput" class="form-label">Deskripsi Event</label>
                            <textarea name="deskripsi" id="deskripsiInput" class="form-control" placeholder="Masukan deskripsi event"></textarea>
                        </div>
                        <div class="pt-5 mt-5 border-top d-flex justify-content-md-end align-items-center">
                            <button type="submit" name="submit" class="btn btn-primary w-md-auto text-white">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('layout/footer.php'); ?>

    <!--====== BACK TO TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TO TOP PART ENDS ======-->

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