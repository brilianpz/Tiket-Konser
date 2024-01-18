<?php
session_start();
include_once('config/connection.php');

$sql = "SELECT * FROM konser";
// search
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql .= " WHERE nama LIKE '%$search%'";
}
// sort
if (isset($_POST['sorting'])) {
    $sort = $_POST['sorting'];
    if ($sort == 1) {
        $sql .= " ORDER BY harga DESC";
    } elseif ($sort == 2) {
        $sql .= " ORDER BY harga ASC";
    } elseif ($sort == 3) {
        $sql .= " ORDER BY nama ASC";
    }
}
$result = mysqli_query($conn, $sql);
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
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h3 class="title mb-15">Tiket Konser</h3>
                        <p>
                            Taklukkan Panggung Bersama Kami - Temukan, Pesan, dan Raih Pengalaman Konser Terbaik! 🎟️🔥
                        </p>
                    </div> <!-- section title -->
                </div>
            </div>
            <div class="row justify-content-between">
                <?php if (isset($_SESSION['status'])) :
                    if ($_SESSION['role'] == 'admin') : ?>
                        <div class="col-6 col-sm-5 col-lg-2">
                            <a href="tambahTiket.php" class="btn btn-dark">Tambah Tiket Baru</a>
                        </div>
                <?php endif;
                endif; ?>
                <div class="col-6 col-sm-5 col-lg-3 ml-auto">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <select class="custom-select" id="inputGroupSelect02" name="sorting">
                                <option selected>Urutkan</option>
                                <option value="1">Harga tertinggi</option>
                                <option value="2">Harga terendah</option>
                                <option value="3">Nama</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Urutkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- menampilkan tiket jika ada -->
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog mt-30">
                            <div class="blog-image">
                                <img src="<?= $row['foto']; ?>" alt="Blog">
                            </div>
                            <div class="blog-content">
                                <div class="content">
                                    <h4 class="title"><a href="tiket.php?id=<?= $row['konserid']; ?>"><?= $row['nama']; ?></a></h4>
                                    <span>Harga : <?= number_format($row['harga'], 0, ',', '.'); ?> IDR</span> <br>
                                    <span>Lokasi : <?= $row['lokasi']; ?></span> <br>
                                    <span>Tanggal: <?= date('d F Y H:i', strtotime($row['tanggal'])); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <!-- jika tidak ada tiket -->
                <?php if (mysqli_num_rows($result) == 0) : ?>
                    <h3 class="text-danger mt-100">Tidak ada tiket</h3>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    if (mysqli_num_rows($result) > 0) {
        include_once('layout/footer.php');
    }

    ?>

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