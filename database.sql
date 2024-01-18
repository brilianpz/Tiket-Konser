-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2023 pada 21.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_tiket_konser`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `konser`
--

CREATE TABLE `konser` (
  `konserid` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `penyelenggara` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konser`
--

INSERT INTO `konser` (`konserid`, `nama`, `lokasi`, `tanggal`, `harga`, `penyelenggara`, `deskripsi`, `foto`) VALUES
(23, 'New Year Party at Stone Valley by HeHa', 'JL.Pok Tunggal, Kec. Tepus, Kab. Gunungkidul', '2023-12-28 23:23:00', 75000, 'HeHa Stone Valley', '✨ Sambut pergantian tahun dengan penuh kenangan di tempat wisata alam dekat pantai, di mana ombak riang dan pasir putih lembut menciptakan pesona alam yang memukau.\r\n\r\nDari hamparan pasir hingga perbukitan hutan tropis yang hijau, segala keindahan alam terasa begitu alami dan ajaib. Suasana sempurna untuk mengakhiri tahun dan memulai petualangan baru yang penuh keceriaan.\r\n\r\nBergabunglah dalam perayaan pesta Tahun Baru bersama Stone Valley by HeHa yang dipenuhi semangat, keceriaan, live musik, dan pertunjukan DJ yang menggema. Rasakan getaran positif dan kehangatan alam pantai yang memikat hati.\r\n\r\nSelamat menikmati momen-momen istimewa di bawah gemerlap bintang, merayakan Tahun Baru dengan keajaiban alam sebagai latar belakang yang memesona. Saksikan pesta kembang api yang memukau dan nikmati live musik serta pertunjukan DJ yang akan menambah keseruan malammu. Semoga tahun baru membawa kebahagiaan dan petualangan baru yang tak terlupakan! 🏝️🎉', 'uploads/foto_658da9840cc72.jpg'),
(24, 'Coming Home Fest Presents 2023', 'Atlantis Land Kenpark, Surabaya', '2023-12-31 00:00:00', 90000, 'Coming Home', 'Coming Home Fest tercipta untuk memberikan wadah berkumpul kepada masyarakat Surabaya Raya, bersuka cita bersama dalam merayakan malam pergantian tahun secara tertib dan gembira. Atas dasar itu juga kami memilih Atlantis Land sebagai tempat untuk merayakan pesta malam pergantian tahun tersebut. Selain itu kami juga ingin ikut andil dalam mempromosikan sekaligus mengenalkan wajah baru dari Atlantis Land yang notabane sebagai salah satu Landmark kota Surabaya agar tidak terlupakan oleh masyarakat Surabaya Raya.', 'uploads/foto_658da5bc31662.png'),
(25, 'OBELIX HILLS MUSIC FEST#2 NEW YEAR EVE 2023', 'Obelix Hills', '2023-12-31 00:00:00', 120000, 'OBELIX HILLS', 'Obelix Hills kembali menggelar konser musik dipenghujung tahun bertajuk OBELIX HILLS MUSIC FEST#2 - New Year Eve 2024 Edition yang akan selenggarakan pada Hari Minggu, 31 Desember 2023, Pukul 20.00 WIB yang berlokasi di dalam obyek wisata Obelix Hills, Kapanewon Prambanan, Sleman, Yogyakarta.\r\n\r\nFestival musik ini digawangi oleh penampilan bintang tamu Guyon Waton serta deretan musisi dan pelaku budaya dari Yogyakarta dan pesta kembang api perayaan menyambut tahun baru 2024. Guyon Waton adalah band asal Kulon Progo, Yogyakarta yang memiliki keunikan lagu-lagu berlirik bahasa Jawa dengan genre musik akustik dangdut. Band ini mampu meningkatkan citra musisi Jogja ke jenjang nasional maupun internasional serta meraih berbagai penghargaan musik Indonesia yang lagu-lagunya populer dan digemari oleh anak muda saat ini. Acara ini didukung oleh Pemerintah Daerah Kabupaten Sleman, Dinas Pariwisata Kabupaten Sleman, Natasha Skin Clinic Center, Naavagreen, serta Brimo (BRI Mobile Banking).\r\n\r\nOBELIX HILLS MUSIC FEST#2 menyuguhkan gelaran hiburan ditempat wisata yang dapat menjadi salah satu pilihan tujuan wisata unik karena diselenggarakan di hamparan bebatuan api purba dengan latar belakang pemandangan gemerlap Kota Yogyakarta pada pergantian malam tahun baru 2024 bagi wisatawan lokal, domestik dan mancanegara.', 'uploads/foto_658da5ff3ddc5.png'),
(26, 'DCASTELLO BERPESTA', 'Florawisata D Castello Ciater', '2023-12-28 23:46:00', 150000, 'Reunion Project', 'Merayakan Kegembiraan Tahun Baru&quot; dengan experience BERWISATA sambil BERPESTA. Dengan lineup Fiersa Besari, Panji Sakti dan Special Perfomance lainnya.', 'uploads/foto_658da6696cb7f.jpg'),
(27, 'Tchaikovsky & Rachmaninoff', 'Balai Resital Kertanegara, Jakarta', '2023-12-28 23:49:00', 159000, 'The Bright Knights Foundation', 'Immerse yourself in the beauty of music from the golden era of Russian composers: Tchaikovsky and Rachmaninoff! Featuring some of Indonesia’s up-and-rising classical stars. Sergei Rachmaninoff: Cello Sonata in G minor, Op. 19 Pyotr Ilyich Tchaikovsky: Sextet in D minor, Op. 70 “Souvenir de Florence”', 'uploads/foto_658da729e6070.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `konserid` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `waktu_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`orderid`, `userid`, `konserid`, `jumlah`, `total`, `waktu_beli`) VALUES
(22, 1, 23, 4, 300000, '2023-12-29'),
(23, 1, 24, 10, 900000, '2023-12-29'),
(24, 1, 25, 10, 1200000, '2023-12-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `nama_depan` varchar(255) DEFAULT NULL,
  `nama_belakang` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `role`, `nama_depan`, `nama_belakang`, `Email`) VALUES
(1, 'user', '95c946bf622ef93b0a211cd0fd028dfdfcf7e39e', 'user', 'user', NULL, 'user@gmail.com'),
(2, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin', 'admin', NULL, 'admin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`konserid`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `ConcertID` (`konserid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `Username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `konser`
--
ALTER TABLE `konser`
  MODIFY `konserid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`konserid`) REFERENCES `konser` (`konserid`),
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
