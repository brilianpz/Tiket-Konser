<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['role'] != 'admin') {
    header("location: index.php");
    exit();
}

include_once('config/connection.php');
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
    <title>Konsertix - Laporan Pembelian</title>


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

    <!--====== SLIDER PART START ======-->

    <section id="home" class="slider-area pt-150">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">Laporan Pembelian</h4>
                </div>
                <div class="col-2 mt-2">
                    <a href="cetakLaporan.php" class="btn btn-primary">Cetak Laporan</a>
                </div>
                <div class="col-12 mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Event</th>
                                <th>Penyelenggara</th>
                                <th>Total Terjual</th>
                                <th>Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT k.nama, k.penyelenggara, SUM(p.jumlah) AS total_terjual, SUM(p.jumlah) * k.harga AS total_pendapatan FROM pemesanan p JOIN konser k ON p.konserid = k.konserid GROUP BY k.konserid";
                            $result = mysqli_query($conn, $query);
                            $total = 0;
                            while ($row = mysqli_fetch_assoc($result)) :
                                $total += $row['total_pendapatan'];
                            ?>
                                <tr>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['penyelenggara'] ?></td>
                                    <td class="text-center"><?= $row['total_terjual'] ?></td>
                                    <td class="text-center">Rp. <?= number_format($row['total_pendapatan'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="3" class="text-center">Total</td>
                                <td class="text-center"><?= 'Rp ' . number_format($total, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->

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