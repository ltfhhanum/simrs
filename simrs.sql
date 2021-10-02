-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2020 pada 04.43
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simrs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_resep`
--

CREATE TABLE `detail_resep` (
  `id` int(11) NOT NULL,
  `no_resep` varchar(15) NOT NULL,
  `id_obat` varchar(15) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_resep`
--

INSERT INTO `detail_resep` (`id`, `no_resep`, `id_obat`, `harga`, `jumlah`, `sub_total`) VALUES
(1, '191226-001', 'MDC-001', 55000, 1, 55000),
(2, '191226-001', 'MDC-001', 55000, 1, 55000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` varchar(15) NOT NULL,
  `nama_dokter` varchar(30) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `spesialis` varchar(30) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `jasa` double NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `jk`, `spesialis`, `id_poli`, `jasa`, `username`) VALUES
('DR-001', 'dr. Mawaddatur Rahmah', 'Perempuan', 'Jantung', 1, 70000, 'widamr'),
('DR-002', 'dr. Najwa Zahra Nazhifah', 'Perempuan', 'Saraf', 1, 100000, 'najwazn');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal` int(11) NOT NULL,
  `id_dokter` varchar(15) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` char(5) NOT NULL,
  `jam_akhir` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id_jadwal`, `id_dokter`, `hari`, `jam_mulai`, `jam_akhir`) VALUES
(1, 'DR-001', 'Senin', '08.00', '11.00'),
(2, 'DR-002', 'Senin', '13.00', '16.00'),
(3, 'DR-001', 'Selasa', '13.00', '17.00'),
(4, 'DR-001', 'Rabu', '09.00', '12.00'),
(5, 'DR-002', 'Selasa', '13.00', '17.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` varchar(15) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `exp` date NOT NULL,
  `harga` double NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `satuan`, `exp`, `harga`, `keterangan`) VALUES
('MDC-001', 'Actalipid Strip', 'Strip', '2020-02-20', 55000, 'Untuk penurunan kadar kolesterol dalam darah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `no_identitas` char(15) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` int(11) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `notelp` char(13) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_identitas`, `nama_pasien`, `tgl_lahir`, `umur`, `jk`, `notelp`, `alamat`) VALUES
('1711082010', 'Reza Oksri Nengsi', '1999-12-12', 20, 'Perempuan', '0909090', 'Padang'),
('1711082014', 'Lathifah Hanum', '1999-10-05', 20, 'Perempuan', '082384141041', 'Limau Manis'),
('1711082028', 'Zahri', '1999-01-01', 21, 'Perempuan', '082384141043', 'Komplek Sinar Waluyo '),
('1711082048', 'Elsa Oktavia', '1999-10-21', 20, 'Perempuan', '082384141022', 'Padang'),
('1711082052', 'Cecilya', '1999-01-21', 20, 'Perempuan', '085263774141', 'Padang'),
('1711082055', 'Resi', '1999-12-12', 20, 'Perempuan', '000000', 'Padang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembay`
--

CREATE TABLE `pembay` (
  `faktur` varchar(15) NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `no_pendaftaran` int(11) NOT NULL,
  `no_rm` varchar(15) NOT NULL,
  `no_resep` varchar(15) NOT NULL,
  `total_bayar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembay`
--

INSERT INTO `pembay` (`faktur`, `tgl_pembayaran`, `no_pendaftaran`, `no_rm`, `no_resep`, `total_bayar`) VALUES
('191227-001', '2019-12-26 22:04:34', 1, 'RM-001', '191226-001', 230000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_pendaftaran` int(11) NOT NULL,
  `tgl_pendaftaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `no_id` char(15) NOT NULL,
  `jenis_layanan` varchar(5) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_dokter` varchar(15) NOT NULL,
  `jasa_dokter` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_pendaftaran`, `tgl_pendaftaran`, `no_id`, `jenis_layanan`, `id_poli`, `id_dokter`, `jasa_dokter`) VALUES
(1, '2019-12-25 19:28:12', '1711082014', 'Umum', 1, 'DR-002', 100000),
(2, '2020-01-03 02:17:03', '1711082010', '', 1, 'DR-001', 70000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id_poli` int(11) NOT NULL,
  `nama_poli` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `poliklinik`
--

INSERT INTO `poliklinik` (`id_poli`, `nama_poli`, `keterangan`) VALUES
(1, 'Penyakit Dalam', 'Unit jantung, paru-paru, dsb'),
(2, 'Anak', 'Khusus anak-anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `no_resep` varchar(15) NOT NULL,
  `no_rm` varchar(15) NOT NULL,
  `total_harga` double NOT NULL,
  `apoteker` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`no_resep`, `no_rm`, `total_harga`, `apoteker`) VALUES
('191226-001', 'RM-001', 110000, 'abc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rm`
--

CREATE TABLE `rm` (
  `no_rm` varchar(15) NOT NULL,
  `no_pendaftaran` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `diagnosa` text NOT NULL,
  `tindakan` int(11) NOT NULL,
  `biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rm`
--

INSERT INTO `rm` (`no_rm`, `no_pendaftaran`, `keluhan`, `diagnosa`, `tindakan`, `biaya`) VALUES
('RM-001', 1, 'luka', 'luka bakar', 1, 20000),
('RM-002', 2, 'pusing', 'lelah', 0, 0),
('RM-003', 2, 'pusing', 'lelah', 3, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindakan`
--

CREATE TABLE `tindakan` (
  `id_tindakan` int(11) NOT NULL,
  `nama_tindakan` varchar(30) NOT NULL,
  `biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tindakan`
--

INSERT INTO `tindakan` (`id_tindakan`, `nama_tindakan`, `biaya`) VALUES
(1, 'Perban', 20000),
(2, 'Konsultasi', 20000),
(3, 'Tidak Ada', 0),
(4, 'Cek Darah', 70000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `level` varchar(15) NOT NULL,
  `email` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `level`, `email`, `foto`) VALUES
('abc', '900150983cd24fb0d6963f7d28e17f72', 'Abc', 'Administrasi', 'abc@gmail.com', '1.jpg'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Admin', '', ''),
('ltfhhanum', '423c33f39b9cc54ecfe1bd5df65d5e82', 'Lathifah Hanum', 'Apoteker', 'ltfhhanum@yahoo.co.id', '9.jpg'),
('najwazn', 'b340cadda51f2232a6b3041c56dbf2c6', 'Najwa Zahra Nazhifah', 'Dokter', 'najwazn@yahoo.com', 't4.jpg'),
('widamr', 'd36b438244e5d46490a116f2a7efeb33', 'Mawaddatur Rahmah', 'Dokter', 'widamr@gmail.com', 't2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_identitas`);

--
-- Indeks untuk tabel `pembay`
--
ALTER TABLE `pembay`
  ADD PRIMARY KEY (`faktur`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_pendaftaran`);

--
-- Indeks untuk tabel `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`no_resep`);

--
-- Indeks untuk tabel `rm`
--
ALTER TABLE `rm`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indeks untuk tabel `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `no_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
