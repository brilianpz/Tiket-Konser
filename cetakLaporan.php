<?php
require('fpdf/fpdf.php');

$pdf = new FPDF('l', 'mm', 'Legal');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(320, 10, 'LAPORAN PEMBELIAN', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(320, 10, 'TIKET KONSER APLIKASI KONSERTIX', 0, 1, 'C');
$pdf->Cell(10, 10, '', 0, 1);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(10, 8, 'NO', 1, 0);
$pdf->Cell(120, 8, 'NAMA EVENT', 1, 0);
$pdf->Cell(80, 8, 'PENYELENGGARA', 1, 0);
$pdf->Cell(60, 8, 'TOTAL TERJUAL', 1, 0);
$pdf->Cell(60, 8, 'TOTAL PENDAPATAN', 1, 1);
$pdf->SetFont('Arial', '', 11);

include 'config/connection.php';
$query = "SELECT k.nama, k.penyelenggara, SUM(p.jumlah) AS total_terjual, SUM(p.jumlah) * k.harga AS total_pendapatan FROM pemesanan p JOIN konser k ON p.konserid = k.konserid GROUP BY k.konserid";
$result = mysqli_query($conn, $query);

$i = 1;
$total_pendapatan = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 8, $i++, 1, 0);
        $pdf->Cell(120, 8, $row['nama'], 1, 0);
        $pdf->Cell(80, 8, $row['penyelenggara'], 1, 0);
        $pdf->Cell(60, 8, $row['total_terjual'] . 'Tiket', 1, 0);
        $pdf->Cell(60, 8, 'Rp. ' . number_format($row['total_pendapatan'], 0, ',', '.'), 1, 1);

        $total_pendapatan += $row['total_pendapatan'];
    }

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(270, 8, 'Total Pendapatan', 1, 0, 'C');
    $pdf->Cell(60, 8, 'Rp. ' . number_format($total_pendapatan, 0, ',', '.'), 1, 1);
}

$pdf->Output();
