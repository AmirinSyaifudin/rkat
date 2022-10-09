-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2020 pada 00.59
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rkat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_adm` int(2) NOT NULL,
  `nama_adm` varchar(50) NOT NULL,
  `username_adm` varchar(40) NOT NULL,
  `password_adm` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_adm`, `nama_adm`, `username_adm`, `password_adm`) VALUES
(1, 'Mohammad', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_approval`
--

CREATE TABLE `tb_approval` (
  `id_approval` int(4) NOT NULL,
  `id_rka` int(4) NOT NULL,
  `anggaran_approval` int(8) NOT NULL,
  `disetujui_oleh` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_approval`
--

INSERT INTO `tb_approval` (`id_approval`, `id_rka`, `anggaran_approval`, `disetujui_oleh`) VALUES
(5, 3, 11000000, 18),
(7, 6, 4500000, 1),
(9, 8, 4000, 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bidanggarapan`
--

CREATE TABLE `tb_bidanggarapan` (
  `id_bidang` int(4) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bidanggarapan`
--

INSERT INTO `tb_bidanggarapan` (`id_bidang`, `nama_bidang`) VALUES
(1, 'Pendidikan & Pengajaran'),
(3, 'Penelitian'),
(6, 'Pengabdian pada Masyarakat'),
(7, 'Kerjasama'),
(8, 'Pengembangan Karakter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(4) NOT NULL,
  `kode_rka` varchar(50) NOT NULL,
  `latar_belakang` text NOT NULL,
  `maksud` text NOT NULL,
  `tujuan` text NOT NULL,
  `judul_kegiatan` text NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `peserta` text NOT NULL,
  `jumlah_hari` int(4) NOT NULL,
  `p_penanggungjawab` varchar(100) NOT NULL,
  `p_ketua` varchar(100) NOT NULL,
  `p_sekretaris` varchar(100) NOT NULL,
  `p_bendahara` varchar(100) NOT NULL,
  `p_instruktur` varchar(100) NOT NULL,
  `p_asisten` varchar(100) NOT NULL,
  `b_kesekretariatan` int(8) NOT NULL,
  `b_konsumsi` int(8) NOT NULL,
  `b_honorarium` int(8) NOT NULL,
  `b_total` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `kode_rka`, `latar_belakang`, `maksud`, `tujuan`, `judul_kegiatan`, `tgl_awal`, `tgl_akhir`, `tempat`, `peserta`, `jumlah_hari`, `p_penanggungjawab`, `p_ketua`, `p_sekretaris`, `p_bendahara`, `p_instruktur`, `p_asisten`, `b_kesekretariatan`, `b_konsumsi`, `b_honorarium`, `b_total`) VALUES
(3, 'RKA/KTU/I/2017/001', 'Latar belakang masalah contoh 1', 'Maksud kegiatan contoh 1', 'Tujuan kegiatan contoh 1', 'Judul kegiatan contoh 1', '2017-01-01', '2017-01-10', 'Tempat contoh 1', 'Peserta contoh 1', 3, 'aaa aaaa', 'Ketua 1', 'Sekretaris 1', 'Bendahara 1', 'Instruktur 1', 'Asisten 1', 2000000, 5000000, 3000000, 10000000),
(4, 'RKA/KTU/I/2017/002', 'fddff', 'dfdfdf', 'fddf', 'dfddfdf fdkdf df', '2017-01-10', '2017-01-13', 'dfdf', 'dfdf', 5, 'aaa aaaa', 'dfdf', 'hggh', 'jhh', 'kkjj', 'gfggf', 4545, 454, 45445, 50444),
(6, 'RKA/Lab/I/2017/001', 'fgvfg ffff', 'fgffgfg', 'gf fggffg', 'dfhdudhd dfddfhdf', '2017-01-11', '2017-01-20', 'gygg yg', 'ffcddf', 4, 'Ketua Lab', 'dfdfdf', 'dfdfdf', 'dfdfdfd', 'ghg', 'hggh', 1000000, 2000000, 1500000, 4500000),
(8, 'RKA/Wadek/II/2020/003', 'Meningkatkan SDM ', 'memperbaiki SDM', 'Menciptakan Solusi bagi permasalahan desa', 'Kerjasama ', '2020-02-06', '2020-08-13', 'Kalimantan Timur ', '40', 50, 'Nur F', 'Wahid ', 'Andi ', 'Yuda', 'Proto ', 'Sifa ', 2, 4, 4, 10),
(9, 'RKA/Kaprodi/II/2020/001', 'Pariwisata', 'pariwisata kota pati ', 'mempromosikan wisata kota pati ', 'GIS', '2020-02-14', '2020-05-21', 'PATI', '4', 30, 'amir sy', 'Amir', 'Ibnu ', 'Abdullah', 'Aris ', 'Raka', 2, 5, 10, 17),
(10, 'RKA/Kaprodi/III/2020/002', 'ewfrg', 'egtearg', 'esrgteag', 'eargtaeg', '2020-03-18', '2020-04-07', 'sdgfar', 'fgeargfv', 4, 'amir sy', 'Wahid ', 'budi ', 'cici', 'wijang', 'ratna', 4, 5, 5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_realisasi`
--

CREATE TABLE `tb_realisasi` (
  `id_realisasi` int(4) NOT NULL,
  `id_rka` int(4) NOT NULL,
  `periode_realisasi` enum('awal','akhir') NOT NULL,
  `tgl_awal_r` date NOT NULL,
  `tgl_akhir_r` date NOT NULL,
  `anggaran_realisasi` int(8) NOT NULL,
  `status_anggaran` enum('sesuai','tidak sesuai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_realisasi`
--

INSERT INTO `tb_realisasi` (`id_realisasi`, `id_rka`, `periode_realisasi`, `tgl_awal_r`, `tgl_akhir_r`, `anggaran_realisasi`, `status_anggaran`) VALUES
(4, 3, 'akhir', '2017-01-02', '2017-01-11', 11000000, 'sesuai'),
(6, 6, 'akhir', '2017-01-12', '2017-01-21', 5000000, 'tidak sesuai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rencanakerja`
--

CREATE TABLE `tb_rencanakerja` (
  `id_rka` int(4) NOT NULL,
  `kode_rka` varchar(50) NOT NULL,
  `id_bidang` int(4) NOT NULL,
  `periode` enum('awal','akhir') NOT NULL,
  `unit_kerja` int(4) NOT NULL,
  `status_approval` enum('disetujui','menunggu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rencanakerja`
--

INSERT INTO `tb_rencanakerja` (`id_rka`, `kode_rka`, `id_bidang`, `periode`, `unit_kerja`, `status_approval`) VALUES
(3, 'RKA/KTU/I/2017/001', 1, 'awal', 13, 'disetujui'),
(4, 'RKA/KTU/I/2017/002', 3, 'akhir', 13, 'menunggu'),
(6, 'RKA/Lab/I/2017/001', 8, 'akhir', 16, 'disetujui'),
(8, 'RKA/Wadek/II/2020/003', 7, 'awal', 1, 'disetujui'),
(9, 'RKA/Kaprodi/II/2020/001', 3, 'akhir', 19, 'menunggu'),
(10, 'RKA/Kaprodi/III/2020/002', 1, 'awal', 19, 'menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unitkerja`
--

CREATE TABLE `tb_unitkerja` (
  `id_uk` int(4) NOT NULL,
  `nama_uk` varchar(50) NOT NULL,
  `username_uk` varchar(40) NOT NULL,
  `password_uk` varchar(40) NOT NULL,
  `jenis_uk` enum('Wadek','Kaprodi','Sekprodi','Lab','KTU','Dekan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_unitkerja`
--

INSERT INTO `tb_unitkerja` (`id_uk`, `nama_uk`, `username_uk`, `password_uk`, `jenis_uk`) VALUES
(1, 'Nur F', 'nur', 'nur', 'Wadek'),
(6, 'dfdf', 'agus', 'agus', 'Kaprodi'),
(11, 'ccc ccc', 'ccc', 'ccc', 'Sekprodi'),
(13, 'aaa aaaa', 'aaaa', 'aaaa', 'KTU'),
(16, 'Ketua Lab', 'lab1', 'lab1', 'Lab'),
(18, 'Dekan Teknik', 'dekan1', 'dekan1', 'Dekan'),
(19, 'amir sy', 'amir', 'amir', 'Kaprodi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indeks untuk tabel `tb_approval`
--
ALTER TABLE `tb_approval`
  ADD PRIMARY KEY (`id_approval`);

--
-- Indeks untuk tabel `tb_bidanggarapan`
--
ALTER TABLE `tb_bidanggarapan`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `tb_realisasi`
--
ALTER TABLE `tb_realisasi`
  ADD PRIMARY KEY (`id_realisasi`);

--
-- Indeks untuk tabel `tb_rencanakerja`
--
ALTER TABLE `tb_rencanakerja`
  ADD PRIMARY KEY (`id_rka`);

--
-- Indeks untuk tabel `tb_unitkerja`
--
ALTER TABLE `tb_unitkerja`
  ADD PRIMARY KEY (`id_uk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_adm` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_approval`
--
ALTER TABLE `tb_approval`
  MODIFY `id_approval` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_bidanggarapan`
--
ALTER TABLE `tb_bidanggarapan`
  MODIFY `id_bidang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_realisasi`
--
ALTER TABLE `tb_realisasi`
  MODIFY `id_realisasi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_rencanakerja`
--
ALTER TABLE `tb_rencanakerja`
  MODIFY `id_rka` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_unitkerja`
--
ALTER TABLE `tb_unitkerja`
  MODIFY `id_uk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
