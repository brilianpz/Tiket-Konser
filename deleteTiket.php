<?php
session_start();
include_once('config/connection.php');

// Cek apakah ada parameter 'id' dan pengguna memiliki peran 'admin'
if (isset($_GET['id']) && $_SESSION['role'] == 'admin') {
    $id = $_GET['id'];

    // Cek apakah ada pemesanan terkait dengan konser
    $sqlCek = "SELECT COUNT(*) as count FROM pemesanan WHERE konserid = $id";
    $resultCek = mysqli_query($conn, $sqlCek);

    if ($resultCek) {
        $rowPemesanan = mysqli_fetch_assoc($resultCek);
        $jumlahPemesanan = $rowPemesanan['count'];

        if ($jumlahPemesanan > 0) {
            // Jika ada pemesanan terkait, berikan pesan kesalahan
            echo "<script>alert('Tiket konser ini memiliki pemesanan dan tidak dapat dihapus');window.location.href='tiketAll.php';</script>";
            mysqli_close($conn);
            exit();
        } else {
            // Jika tidak ada pemesanan terkait, lanjutkan dengan menghapus konser
            $sql = "SELECT * FROM konser WHERE konserid = $id";
            $result = mysqli_query($conn, $sql);

            // Cek apakah tiket ditemukan
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $foto = $row['foto'];

                // Hapus konser dari database
                $sqlDelete = "DELETE FROM konser WHERE konserid = $id";
                $resultDelete = mysqli_query($conn, $sqlDelete);

                // Cek apakah penghapusan berhasil
                if ($resultDelete) {
                    // Hapus foto terkait dari direktori
                    $path = $foto;
                    unlink($path);

                    echo "<script>alert('Berhasil menghapus tiket');window.location.href='tiketAll.php';</script>";
                    mysqli_close($conn);
                    exit();
                } else {
                    echo "<script>alert('Gagal menghapus tiket');window.location.href='tiketAll.php';</script>";
                    mysqli_close($conn);
                    exit();
                }
            } else {
                // Tiket tidak ditemukan
                echo "<script>alert('Tiket tidak ditemukan');window.location.href='tiketAll.php';</script>";
                mysqli_close($conn);
                exit();
            }
        }
    } else {
        // Kesalahan saat memeriksa pemesanan
        echo "<script>alert('Gagal memeriksa pemesanan');window.location.href='tiketAll.php';</script>";
        mysqli_close($conn);
        exit();
    }
} else {
    // Jika tidak ada parameter 'id' atau pengguna tidak memiliki peran 'admin'
    header('Location: index.php');
    exit();
}
