<?php
session_start();

if (!isset($_SESSION['status'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit'])) {
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['status']);
    header('Location: index.php');
    exit();
}

include_once('config/connection.php');

$sql = "SELECT * FROM users WHERE userid = '" . $_SESSION['userid'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

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
    <title>Konsertix - Account</title>


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
                    <h4 class="text-center">Profile <?= $_SESSION['username']; ?></h4>
                </div>
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">Username</div>
                                <div class="col-1">:</div>
                                <div class="col-7"><?= $row['username']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-4">Nama Depan</div>
                                <div class="col-1">:</div>
                                <div class="col-7"><?= $row['nama_depan']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-4">Nama Belakang</div>
                                <div class="col-1">:</div>
                                <div class="col-7"><?= empty($row['nama_belakang']) ? '-' : $row['nama_belakang']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-4">Email</div>
                                <div class="col-1">:</div>
                                <div class="col-7"><?= $row['Email']; ?></div>
                            </div>
                            <div class="col-12">
                                <form action="" method="post">
                                    <button type="submit" name="submit" class="btn btn-danger btn-block mt-4">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
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