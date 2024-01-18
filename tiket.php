<?php
session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

include_once('config/connection.php');

$errJumlah = '';

$sql = "SELECT * FROM konser WHERE konserid = $_GET[id]";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['beli'])) {
    if (!isset($_SESSION['status'])) {
        echo "<script>alert('Silahkan login terlebih dahulu');window.location.href='login.php';</script>";
        mysqli_close($conn);
        exit();
    }

    if (empty($_POST['jumlah'])) {
        $errJumlah = 'Jumlah tiket diperlukan';
    } else {
        $jumlah = test_input($_POST['jumlah']);
        if (!preg_match('/^[0-9]+$/', $jumlah)) {
            $errJumlah = 'Hanya angka yang diperbolehkan';
        }
    }

    if (empty($errJumlah)) {
        $userid = $_SESSION['userid'];
        $id = $_GET['id'];
        $total = $row['harga'] * $jumlah;
        $sql = "INSERT INTO pemesanan (userid, konserid, jumlah, total, waktu_beli) VALUES ($userid, $id, $jumlah, $total, NOW())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Berhasil membeli tiket');window.location.href='tiketAll.php';</script>";
            mysqli_close($conn);
            exit();
        } else {
            echo "<script>alert('Gagal membeli tiket');window.location.href='tiketAll.php';</script>";
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
    <title>Konsertix - Tiket</title>


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
    <section id="blog" class="blog-area pt-125">
        <div class="container">
            <?php if (mysqli_num_rows($result) > 0) :  ?>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-12">
                                <h3 class="text-center">Tiket <?= $row['nama']; ?></h3>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['status']) && $_SESSION['role'] == 'admin') : ?>
                            <div class="row mt-3">
                                <div class="col-12 col-md-2 mt-2">
                                    <a href="editTiket.php?id=<?= $row['konserid']; ?>" class="btn btn-success btn-block">Edit</a>
                                </div>
                                <div class="col-12 col-md-2 mt-2">
                                    <a href="deleteTiket.php?id=<?= $row['konserid']; ?>" class="btn btn-danger btn-block">Delete</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row mt-5">
                            <div class="col-12 col-md-6 mb-5">
                                <img src="<?= $row['foto']; ?>" alt="">
                            </div>
                            <div class="col-12 col-md-6">
                                <h5><?= $row['nama']; ?></h5>
                                <p class="mt-2">Rp. <b><?= number_format($row['harga'], 0, ',', '.'); ?></b></p>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        Lokasi
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-6">
                                        <?= $row['lokasi']; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        Tanggal
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-6">
                                        <?= date('d F Y H:i', strtotime($row['tanggal'])); ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        Penyelenggara
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-6">
                                        <?= $row['penyelenggara']; ?>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <form action="" method="post">
                                            <input type="text" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Tiket">
                                            <p class="text-danger"><?= $errJumlah; ?></p>
                                            <button type="submit" name="beli" class="btn btn-dark btn-block mt-3">Beli Tiket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <p><b>DESKRIPSI :</b></p>
                                <p class="mt-2"><?= $row['deskripsi']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-12">
                                <h3 class="text-center text-danger">Tiket Tidak Ditemukan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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