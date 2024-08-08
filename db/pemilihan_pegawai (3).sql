-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2024 pada 07.38
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemilihan_pegawai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `status_kepegawaian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama`, `nip`, `tempat_lahir`, `tanggal_lahir`, `jabatan`, `pendidikan_terakhir`, `jenis_kelamin`, `status_kepegawaian`) VALUES
(3081, 'Agnes Benga Lasan, A.Md.Kep', '196805191988122002', '-', '1968-05-19', 'Perawat Penyelia', 'D-IV', 'perempuan', 'ASN'),
(3082, 'Margarida  C. Lay, A.Md.Keb', '196710161988012001', '-', '1967-10-16', 'Bidan Penyelia', 'D-III', 'perempuan', 'ASN'),
(3083, 'Maria Elisabeth Seran Tae, A.Md.Keb', '1972111151992120001', '-', '1972-11-11', 'Bidan Penyelia', 'D-III', 'perempuan', 'ASN'),
(3084, 'Yuliana Lin Asa, A.Md.Keb', '197005251992122002', '-', '1970-05-25', 'Bidan Penyelia', 'D-III', 'perempuan', 'ASN'),
(3085, 'Eni Wahyuning, S.Farm.Apt', '198303102006042025', '-', '1983-03-10', 'Apoteker Ahli Muda', 'S1', 'perempuan', 'ASN'),
(3086, 'Atris Apriany Nafie, S.KM', '198504192010012030', '-', '1985-04-19', 'Tenaga Promkes dan Ilmu Perilaku Ahli Muda', 'S1', 'perempuan', 'ASN'),
(3087, 'Ni Made Dwi Ari Paramitha,S.KM', '198609182010012024', '-', '1986-09-18', 'Tenaga Promkes dan Ilmu Perilaku Ahli Muda', 'S1', 'perempuan', 'ASN'),
(3088, 'Angriani Adam, A.Md.KL', '198408032009042016', '-', '1984-08-03', 'Sanitarian Penyelia', 'D-III', 'perempuan', 'ASN'),
(3089, 'Benedikta Silut', '196610081990032012', '-', '1966-10-08', 'PLK Penyelia/ATLM', 'SMA', 'perempuan', 'ASN'),
(3090, 'Benjamin Fodrik Lesirolo, A.Md.Gz', '196804171995031005', '-', '1968-04-17', 'Tenaga Promosi Kesehatan dan Ilmu Perilaku', 'D-III', 'laki-laki', 'ASN'),
(3091, 'Rosario Barek Bahin, A.Md.Kep', '197608152001122003', '-', '1976-08-15', 'Perawat Penyelia', 'D-III', 'perempuan', 'ASN'),
(3092, 'Ani Agustini Gaspersz, S.Tr.Keb, M.Kes', '198208082006042013', '-', '1982-08-08', 'Bidan Penyelia', 'S2', 'perempuan', 'ASN'),
(3093, 'Victora   Kotten, S.Tr.Keb', '198301052006042017', '-', '1983-01-05', 'Bidan Penyelia', 'D-IV', 'perempuan', 'ASN'),
(3094, 'Maria Bibiana Tea, A.Md.Kep', '197304262006042003', '-', '1973-04-26', 'Perawat Penyelia', 'D-III', 'perempuan', 'ASN'),
(3095, 'Martha Rensi, A.Md.Kep', '197907032006042014', '-', '1979-07-03', 'Perawat Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3096, 'Winahyu  Pertimasari, S.Tr.Keb', '198408162006042015', '-', '1984-08-16', 'Bidan Penyelia', 'D-IV', 'perempuan', 'ASN'),
(3097, 'Siti Nur Rahmah A. Rahman, A.Md.Keb', '198212142006042018', '-', '1982-12-14', 'Bidan Penyelia', 'D-III', 'perempuan', 'ASN'),
(3098, 'Dwi Indria Kusuma Ningsih, A.Md.KL', '198203262006042014', '-', '1982-03-26', 'Tenaga Sanitasi Lingkungan', 'D-III', 'perempuan', 'ASN'),
(3099, 'Dewi Rahmawati, A.Md.Kep', '198705272009032003', '-', '1987-05-27', 'Perawat Penyelia', 'D-III', 'perempuan', 'ASN'),
(3100, 'Maria Junita Yadha Yato, A.Md.Kep', '198506172009032009', '-', '1985-06-17', 'Perawat Penyelia', 'D-III', 'perempuan', 'ASN'),
(3101, 'Rambu Patty Jiara, S.Kep, Ns', '197402222003122007', '-', '1974-02-22', 'Perawat Ahli Muda', 'S1', 'perempuan', 'ASN'),
(3102, 'Helena Andriani Klakik, A.Md.Kep', '198503202010012036', '-', '1985-03-20', 'Perawat Penyelia', 'D-III', 'perempuan', 'ASN'),
(3103, 'Marlina Yuliantje Ang Djadi, S.Km', '197805112006042034', '-', '1978-05-11', 'Sanitarian', 'S1', 'perempuan', 'ASN'),
(3104, 'Sofia Susanti Dua Ota, S.Keb', '198504302006042002', '-', '1985-04-30', 'Bidan Pertama', 'S1', 'perempuan', 'ASN'),
(3105, 'Lambertus Boro Nubi,A.Md', '198412222009031003', '-', '1984-12-22', 'Perawat Pelaksana Lanjutan/Mahir', 'D-III', 'laki-laki', 'ASN'),
(3106, 'dr. Maria Yosita Ayu Hapsari', '198712102014122002', '-', '1987-12-10', 'Dokter Pertama', 'S1', 'perempuan', 'ASN'),
(3107, 'Andi Putri Iradama Yanti,A.Md.Kep.', '198706202010012020', '-', '1987-06-20', 'Perawat Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3108, 'Marlian Elsa Elisama,A.Md.Keb', '198702032009032006', '-', '1987-02-03', 'Bidan Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3109, 'Weny Sriani Lobo, A.Md.Kes', '198204212006042025', '-', '1982-04-21', 'Perawat Gigi Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3110, 'Inviolata Carmelinda Nahak,A.Md.F', '198604152010012019', '-', '1986-04-15', 'Ass. Apoteker Pelaksana Lanjutan', 'D-III', 'perempuan', 'ASN'),
(3111, 'Beatrix Maria Illas, A.Md.Keb', '197303292006042004', '-', '1973-03-29', 'Bidan Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3112, 'Desly Lian,A.Md.Keb', '198102272010012024', '-', '1981-02-27', 'Bidan Mahir', 'D-III', 'perempuan', 'ASN'),
(3113, 'dr. Radha Govinda Padma, S.Ked', '199501222022032013', '-', '1995-01-22', 'Dokter', 'S1', 'perempuan', 'ASN'),
(3114, 'Roselkrans E. Pabara', '-', '-', '0000-00-00', 'Perawat Penyelia', 'D-IV', 'perempuan', 'ASN'),
(3115, 'dr. Tika Anggraeni', '198608162022032001', '-', '1986-08-16', 'Dokter', 'S1', 'perempuan', 'ASN'),
(3116, 'dr. Elisabeth Sophiane, S.Ked', '199008072022032006', '-', '1990-08-07', 'Dokter', 'S1', 'perempuan', 'ASN'),
(3117, 'Yeny Sunaria Haning, SST', '198608202009032014', '-', '1986-08-20', 'Nutrisionis Pertama', 'D-IV', 'perempuan', 'ASN'),
(3118, 'Katarina Dae,A.Md.Kep', '197809042010012015', '-', '1978-09-04', 'Perawat Mahir', 'D-III', 'perempuan', 'ASN'),
(3119, 'Filipina Telnoni, A.Md.Keb', '197202022006042007', '-', '1972-02-02', 'Bidan Mahir', 'D-III', 'perempuan', 'ASN'),
(3120, 'Maria Letelay, A.Md.Keb', '198104052006042025', '-', '1981-04-05', 'Bidan Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3121, 'Getereda Benu, A.Md.Keb', '197509232006042021', '-', '1975-09-23', 'Bidan Pelaksana Lanjutan/Mahir', 'D-III', 'perempuan', 'ASN'),
(3122, 'Isabela Pia, A.Md.Keb', '198610072017042006', '-', '1986-10-07', 'Bidan Terampil', 'D-III', 'perempuan', 'ASN'),
(3123, 'Imelda Merdekawati Arlis, A.Md.Keb', '198708122017042002', '-', '1987-08-12', 'Bidan Pelaksana/Terampil', 'D-III', 'perempuan', 'ASN'),
(3124, 'Maria Ima Colata Fallo Sabuin, A.Md.Keb', '199412252022032011', '-', '1994-12-25', 'Bidan', 'D-III', 'perempuan', 'ASN'),
(3125, 'Lidwina Adinda Saputri Harry, A.Md.Keb', '199812212022032011', '-', '1998-12-21', 'Bidan', 'D-III', 'perempuan', 'ASN'),
(3126, 'Julita Beatriz Pah De Araujo, A.Md.Kes', '199807172022032017', '-', '1998-07-17', 'Pranata Laboratorium Kesehatan/ATLM', 'D-III', 'perempuan', 'ASN'),
(3127, 'Dorotea Barek Bura, A.Md.Kep', '199503282022032018', '-', '1995-03-28', 'Perawat', 'D-III', 'perempuan', 'ASN'),
(3128, 'Febriana Da Costa, A.Md.Kes', '199802212022032013', '-', '1998-02-21', 'Terapis Gigi dan Mulut', 'D-III', 'perempuan', 'ASN'),
(3129, 'Yuliana Peni Witin, A.Md.Farm', '199707182022032014', '-', '1997-07-18', 'Asisten Apoteker', 'D-III', 'perempuan', 'ASN'),
(3130, 'Megga Bestari Nenotek, A.Md.Kep', '199405112022032020', '-', '1994-05-11', 'Perawat', 'D-III', 'perempuan', 'ASN'),
(3131, 'Hendrikus G. S. I. Juleidin, A.Md.Kep', '199506102022031006', '-', '1995-06-10', 'Perawat', 'D-III', 'laki-laki', 'ASN'),
(3132, 'Ricky Abraham Lofa, A.Md.GZ', '199005282022031004', '-', '1990-05-28', 'Nutrisionis', 'D-III', 'laki-laki', 'ASN'),
(3133, 'dr. Diogo A. Fernandez', '7120198908110419', '-', '1989-08-11', 'Dokter Umum', 'S1', 'laki-laki', 'PTT DAERAH KOTA KUPA'),
(3134, 'dr.Resky F. Rona', '7121199407280278', '-', '1994-07-28', 'Dokter Umum', 'S1', 'laki-laki', 'PTT DAERAH KOTA KUPA'),
(3135, 'Innayatun Rubaiyah, A.Md.Kep', '7120198009201773', '-', '1980-09-21', 'Perawat', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3136, 'Daud Fek', '712019931271771', '-', '1993-01-27', 'Tenaga Administrasi', 'SMA', 'laki-laki', 'PTT DAERAH KOTA KUPA'),
(3137, 'Novelinda Ngara Kana, SH', '7120198311281774', '-', '1983-11-28', 'Tenaga Administrasi', 'S1', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3138, 'Mardon Y. Foeh, SE', '7120198903171779', '-', '1989-03-17', 'Tenaga Akuntansi', 'S1', 'laki-laki', 'PTT DAERAH KOTA KUPA'),
(3139, 'Yulia C. Husada, A.Md.Kep', '7120199207241775', '-', '1992-07-24', 'Perawat', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3140, 'Agnes Legifani, A.Md.KG', '7120199204101778', '-', '1992-04-10', 'Perawat Gigi', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3141, 'Apriedsan R. Non, A.Md.Gz', '7120198804241777', '-', '1988-04-24', 'Tenaga Gizi', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3142, 'Nur Asmi Burhan, A.Md.F', '7120199005251776', '-', '1990-05-25', 'Asisten Apoteker', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3143, 'Esau Hunggurami, S.KM', '7122199109090008', '-', '1991-09-09', 'Penyuluh Kesehatan Masyarakat', 'S1', 'laki-laki', 'PTT DAERAH KOTA KUPA'),
(3144, 'Fatahiyah D. Mau, A.Md.AK', '-', '-', '1991-09-09', 'Analis Kesehatan', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3145, 'Siti Maryam Batjo, A.Md.Keb', '-', '-', '0000-00-00', 'Bidan', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3146, 'Ica Agrisa Agustince Sanam, A.Md.Keb', '-', '-', '0000-00-00', 'Bidan', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3147, 'Marlinda Ivoni Hano, A.Md.Keb', '-', '-', '0000-00-00', 'Bidan', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3148, 'Dina Luis, A.Md.Kep', '-', '-', '0000-00-00', 'Perawat', 'D-III', 'perempuan', 'PTT DAERAH KOTA KUPA'),
(3149, 'Yulesthie Yolan Mulnyria Ndaomanu, A.Md.Kep', '-', '-', '0000-00-00', 'Perawat', 'S1', 'perempuan', 'PTT DAERAH KOTA KUPA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `atribut`
--

CREATE TABLE `atribut` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `atribut`
--

INSERT INTO `atribut` (`id`, `nama`) VALUES
(1, 'Benefit'),
(2, 'Cost');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `kriteria_1` int(11) NOT NULL,
  `kriteria_2` int(11) NOT NULL,
  `bobot` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`kriteria_1`, `kriteria_2`, `bobot`) VALUES
(48, 49, '5/1'),
(48, 50, '3/1'),
(48, 51, '5/1'),
(48, 52, '4/1'),
(48, 53, '6/1'),
(48, 54, '4/1'),
(48, 55, '5/1'),
(49, 50, '3/1'),
(49, 51, '4/1'),
(49, 52, '3/1'),
(49, 53, '5/1'),
(49, 54, '4/1'),
(49, 55, '4/1'),
(50, 51, '3/1'),
(50, 52, '2/1'),
(50, 53, '4/1'),
(50, 54, '3/1'),
(50, 55, '3/1'),
(51, 52, '1/1'),
(51, 53, '3/1'),
(51, 54, '2/1'),
(51, 55, '3/1'),
(52, 53, '3/1'),
(52, 54, '2/1'),
(52, 55, '2/1'),
(53, 54, '1/1'),
(53, 55, '2/1'),
(54, 55, '2/1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `atribut` int(11) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `atribut`, `bobot`) VALUES
(48, 'Disiplin', 2, 0.34363570355993),
(49, 'Komitmen', 1, 0.21015079038032),
(50, 'Aman', 1, 0.14052798154421),
(51, 'Inisiatif', 1, 0.084145643032812),
(52, 'Sigap', 1, 0.084616238265442),
(53, 'Kerja sama tim', 1, 0.044817798363704),
(54, 'Fokus pada kualitas', 1, 0.053898069301196),
(55, 'Kemauan mengembangakan diri', 1, 0.038207775552391);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_alternatif`
--

CREATE TABLE `laporan_alternatif` (
  `id` int(11) NOT NULL,
  `alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `jabatan1` varchar(50) NOT NULL,
  `periode` varchar(10) NOT NULL,
  `hasil_akhir` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_alternatif`
--

INSERT INTO `laporan_alternatif` (`id`, `alternatif`, `nama_alternatif`, `jabatan1`, `periode`, `hasil_akhir`) VALUES
(2864, 2662, 'Agnes Benga Lasan, A.Md.Kep', 'Perawat Penyelia', '2023-7', 0.87818689198604),
(2865, 2663, 'Margarida  C. Lay, A.Md.Keb', 'Bidan Penyelia', '2023-7', 0.92409850123233),
(2866, 2664, 'Maria Elisabeth Seran Tae, A.Md.Keb', 'Bidan Penyelia', '2023-7', 0.94649457143426),
(2867, 2665, 'Yuliana Lin Asa, A.Md.Keb', 'Bidan Penyelia', '2023-7', 0.97648446095564),
(2868, 2666, 'Eni Wahyuning, S.Farm.Apt', 'Apoteker Ahli Muda', '2023-7', 0.93152763510506),
(2869, 2667, 'Atris Apriany Nafie, S.KM', 'Tenaga Promkes dan Ilmu Perilaku Ahli Muda', '2023-7', 0.95913637757186),
(2870, 2668, 'Ni Made Dwi Ari Paramitha,S.KM', 'Tenaga Promkes dan Ilmu Perilaku Ahli Muda', '2023-7', 0.9224729065926),
(2871, 2669, 'Angriani Adam, A.Md.KL', 'Sanitarian Penyelia', '2023-7', 0.90426415885964),
(2872, 2670, 'Benedikta Silut', 'PLK Penyelia/ATLM', '2023-7', 0.91753105522648),
(2873, 2671, 'Benjamin Fodrik Lesirolo, A.Md.Gz', 'Tenaga Promosi Kesehatan dan Ilmu Perilaku', '2023-7', 0.7563738528748),
(2874, 2672, 'Rosario Barek Bahin, A.Md.Kep', 'Perawat Penyelia', '2023-7', 0.73397778267288),
(2875, 2673, 'Ani Agustini Gaspersz, S.Tr.Keb, M.Kes', 'Bidan Penyelia', '2023-7', 0.87613646161562),
(2876, 2674, 'Victora   Kotten, S.Tr.Keb', 'Bidan Penyelia', '2023-7 ', 0.72415295220835),
(2877, 2675, 'Maria Bibiana Tea, A.Md.Kep', 'Perawat Penyelia', '2023-7', 0.65982084297689),
(2878, 2676, 'Martha Rensi, A.Md.Kep', 'Perawat Pelaksana Lanjutan/Mahir', '2023-7 ', 0.86698244239512),
(2879, 2677, 'Winahyu  Pertimasari, S.Tr.Keb', 'Bidan Penyelia', '2023-7', 0.83741738860442),
(2880, 2678, 'drg. Maria Anggreany Wea Phodi', 'Dokter Gigi Muda', '2023-7', 0.83615673390998),
(2881, 2679, 'Siti Nur Rahmah A. Rahman, A.Md.Keb', 'Bidan Penyelia', '2023-7', 0.88908547027824),
(2882, 2680, 'Dwi Indria Kusuma Ningsih, A.Md.KL', 'Tenaga Sanitasi Lingkungan', '2023-7', 0.74571320344652),
(2883, 2681, 'Dewi Rahmawati, A.Md.Kep', 'Perawat Penyelia', '2023-7', 0.94845088275815),
(2884, 2682, 'Maria Junita Yadha Yato, A.Md.Kep', 'Perawat Penyelia', '2023-7', 0.94691940716494),
(2885, 2683, 'Rambu Patty Jiara, S.Kep, Ns', 'Perawat Ahli Muda', '2023-7', 0.91204540369772),
(2886, 2684, 'Helena Andriani Klakik, A.Md.Kep', 'Perawat Penyelia', '2023-7 ', 0.77537237628374),
(2887, 2685, 'Marlina Yuliantje Ang Djadi, S.Km', 'Sanitarian', '2023-7', 0.93682159743653),
(2888, 2686, 'Elim Sitas Suek, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-7', 0.7100986349095),
(2889, 2687, 'Sofia Susanti Dua Ota, S.Keb', 'Bidan Pertama', '2023-7', 0.87947239206592),
(2890, 2688, 'Lambertus Boro Nubi,A.Md', 'Perawat Pelaksana Lanjutan/Mahir', '2023-7', 0.93036109945714),
(2891, 2689, 'dr. Maria Yosita Ayu Hapsari', 'Dokter Pertama', '2023-7', 0.95965533234907),
(2892, 2690, 'Andi Putri Iradama Yanti,A.Md.Kep.', 'Perawat Pelaksana Lanjutan/Mahir', '2023-7', 0.69363311502195),
(2893, 2691, 'Marlian Elsa Elisama,A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-7', 0.93668256994966),
(2894, 2692, 'Weny Sriani Lobo, A.Md.Kes', 'Perawat Gigi Pelaksana Lanjutan/Mahir', '2023-7', 0.73828406957379),
(2895, 2693, 'Inviolata Carmelinda Nahak,A.Md.F', 'Ass. Apoteker Pelaksana Lanjutan', '2023-7', 0.98726407481587),
(2896, 2694, 'Beatrix Maria Illas, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-7', 0.91281276157481),
(2897, 2695, 'Desly Lian,A.Md.Keb', 'Bidan Mahir', '2023-7', 0.73966368870019),
(2898, 2696, 'dr. Radha Govinda Padma, S.Ked', 'Dokter', '2023-7', 0.60342916507697),
(2899, 2697, 'dr. Tika Anggraeni', 'Dokter', '2023-7', 0.9423072489653),
(2900, 2698, 'dr. Elisabeth Sophiane, S.Ked', 'Dokter', '2023-7', 0.85145438692334),
(2901, 2699, 'Yeny Sunaria Haning, SST', 'Nutrisionis Pertama', '2023-7', 0.74107619986144),
(2902, 2700, 'Katarina Dae,A.Md.Kep', 'Perawat Mahir', '2023-7', 0.91566886294912),
(2903, 2701, 'Filipina Telnoni, A.Md.Keb', 'Bidan Mahir', '2023-7', 0.90027709088923),
(2904, 2702, 'Maria Letelay, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-7', 0.79305015283399),
(2905, 2703, 'Getereda Benu, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-7', 0.67655585253693),
(2906, 2704, 'Isabela Pia, A.Md.Keb', 'Bidan Terampil', '2023-7', 0.98726407481587),
(2907, 2705, 'Imelda Merdekawati Arlis, A.Md.Keb', 'Bidan Pelaksana/Terampil', '2023-7', 0.82173531830072),
(2908, 2706, 'Maria Ima Colata Fallo Sabuin, A.Md.Keb', 'Bidan', '2023-7', 0.73828406957379),
(2909, 2707, 'Lidwina Adinda Saputri Harry, A.Md.Keb', 'Bidan', '2023-7', 0.76952178480969),
(2910, 2708, 'Julita Beatriz Pah De Araujo, A.Md.Kes', 'Pranata Laboratorium Kesehatan/ATLM', '2023-7', 0.71705453501979),
(2911, 2709, 'Dorotea Barek Bura, A.Md.Kep', 'Perawat', '2023-7', 0.75065505481264),
(2912, 2710, 'Febriana Da Costa, A.Md.Kes', 'Terapis Gigi dan Mulut', '2023-7', 0.82570681321621),
(2913, 2711, 'Yuliana Peni Witin, A.Md.Farm', 'Asisten Apoteker', '2023-7', 0.9273403126361),
(2914, 2712, 'Megga Bestari Nenotek, A.Md.Kep', 'Perawat', '2023-7', 0.71588799937187),
(2915, 2713, 'Hendrikus G. S. I. Juleidin, A.Md.Kep', 'Perawat', '2023-7', 0.93530295082326),
(2916, 2714, 'Ricky Abraham Lofa, A.Md.GZ', 'Nutrisionis', '2023-7', 0.68048518308706),
(2917, 2715, 'dr. Diogo A. Fernandez', 'Dokter Umum', '2023-7', 0.95351169855622),
(2918, 2716, 'dr.Resky F. Rona', 'Dokter Umum', '2023-7', 0.72166669321944),
(2919, 2717, 'Innayatun Rubaiyah, A.Md.Kep', 'Perawat', '2023-7', 0.72750445571355),
(2920, 2718, 'Daud Fek', 'Tenaga Administrasi', '2023-7', 0.91331888737209),
(2921, 2719, 'Novelinda Ngara Kana, SH', 'Tenaga Administrasi', '2023-7', 0.95513729319595),
(2922, 2720, 'Mardon Y. Foeh, SE', 'Tenaga Akuntansi', '2023-7', 0.93152763510506),
(2923, 2721, 'Yulia C. Husada, A.Md.Kep', 'Perawat', '2023-7', 0.94133963658965),
(2924, 2722, 'Agnes Legifani, A.Md.KG', 'Perawat Gigi', '2023-7', 0.95407556177378),
(2925, 2723, 'Apriedsan R. Non, A.Md.Gz', 'Tenaga Gizi', '2023-7', 0.80057340575324),
(2926, 2724, 'Nur Asmi Burhan, A.Md.F', 'Asisten Apoteker', '2023-7', 0.87213737723972),
(2927, 2725, 'Esau Hunggurami, S.KM', 'Penyuluh Kesehatan Masyarakat', '2023-7', 0.93529012184333),
(2928, 2726, 'Fatahiyah D. Mau, A.Md.AK', 'Analis Kesehatan', '2023-7', 0.7762081952475),
(2929, 2727, 'Siti Maryam Batjo, A.Md.Keb', 'Bidan', '2023-7', 0.87797513973384),
(2930, 2728, 'Ica Agrisa Agustince Sanam, A.Md.Keb', 'Bidan', '2023-7', 0.98726407481587),
(2931, 2729, 'Marlinda Ivoni Hano, A.Md.Keb', 'Bidan', '2023-7', 0.92451050798309),
(2932, 2730, 'Dina Luis, A.Md.Kep', 'Perawat', '2023-7', 0.70022540641323),
(2933, 2731, 'Yulesthie Yolan Mulnyria Ndaomanu, A.Md.Kep', 'Perawat', '2023-7', 0.94941849513379),
(3141, 3081, 'Agnes Benga Lasan, A.Md.Kep', 'Perawat Penyelia', '2023-9', 0.98089611222381),
(3142, 3082, 'Margarida  C. Lay, A.Md.Keb', 'Bidan Penyelia', '2023-9', 0.93593928637323),
(3143, 3083, 'Maria Elisabeth Seran Tae, A.Md.Keb', 'Bidan Penyelia', '2023-9', 0.93839281307277),
(3144, 3084, 'Yuliana Lin Asa, A.Md.Keb', 'Bidan Penyelia', '2023-9', 0.89054663190415),
(3145, 3085, 'Eni Wahyuning, S.Farm.Apt', 'Apoteker Ahli Muda', '2023-9', 0.84232702633301),
(3146, 3086, 'Atris Apriany Nafie, S.KM', 'Tenaga Promkes dan Ilmu Perilaku Ahli Muda', '2023-9', 0.80907826044384),
(3147, 3087, 'Ni Made Dwi Ari Paramitha,S.KM', 'Tenaga Promkes dan Ilmu Perilaku Ahli Muda', '2023-9', 0.78269718794918),
(3148, 3088, 'Angriani Adam, A.Md.KL', 'Sanitarian Penyelia', '2023-9', 0.97924360652098),
(3149, 3089, 'Benedikta Silut', 'PLK Penyelia/ATLM', '2023-9', 0.7657739402961),
(3150, 3090, 'Benjamin Fodrik Lesirolo, A.Md.Gz', 'Tenaga Promosi Kesehatan dan Ilmu Perilaku', '2023-9', 0.9416580844354),
(3151, 3091, 'Rosario Barek Bahin, A.Md.Kep', 'Perawat Penyelia', '2023-9', 0.6335863243746),
(3152, 3092, 'Ani Agustini Gaspersz, S.Tr.Keb, M.Kes', 'Bidan Penyelia', '2023-9', 0.77532588418419),
(3153, 3093, 'Victora   Kotten, S.Tr.Keb', 'Bidan Penyelia', '2023-9', 0.82549789772644),
(3154, 3094, 'Maria Bibiana Tea, A.Md.Kep', 'Perawat Penyelia', '2023-9', 0.77561479356465),
(3155, 3095, 'Martha Rensi, A.Md.Kep', 'Perawat Pelaksana Lanjutan/Mahir', '2023-9', 0.90123212671787),
(3156, 3096, 'Winahyu  Pertimasari, S.Tr.Keb', 'Bidan Penyelia', '2023-9', 0.92473483678231),
(3157, 3097, 'Siti Nur Rahmah A. Rahman, A.Md.Keb', 'Bidan Penyelia', '2023-9', 0.91475964082272),
(3158, 3098, 'Dwi Indria Kusuma Ningsih, A.Md.KL', 'Tenaga Sanitasi Lingkungan', '2023-9', 0.9068568057335),
(3159, 3099, 'Dewi Rahmawati, A.Md.Kep', 'Perawat Penyelia', '2023-9', 0.9090857512009),
(3160, 3100, 'Maria Junita Yadha Yato, A.Md.Kep', 'Perawat Penyelia', '2023-9', 0.7870166608917),
(3161, 3101, 'Rambu Patty Jiara, S.Kep, Ns', 'Perawat Ahli Muda', '2023-9', 0.94558534930786),
(3162, 3102, 'Helena Andriani Klakik, A.Md.Kep', 'Perawat Penyelia', '2023-9', 0.71628236580705),
(3163, 3103, 'Marlina Yuliantje Ang Djadi, S.Km', 'Sanitarian', '2023-9', 0.92294330359261),
(3164, 3104, 'Sofia Susanti Dua Ota, S.Keb', 'Bidan Pertama', '2023-9', 0.96969166263288),
(3165, 3105, 'Lambertus Boro Nubi,A.Md', 'Perawat Pelaksana Lanjutan/Mahir', '2023-9', 0.77271859508565),
(3166, 3106, 'dr. Maria Yosita Ayu Hapsari', 'Dokter Pertama', '2023-9', 0.79952631655575),
(3167, 3107, 'Andi Putri Iradama Yanti,A.Md.Kep.', 'Perawat Pelaksana Lanjutan/Mahir', '2023-9', 0.80540417615456),
(3168, 3108, 'Marlian Elsa Elisama,A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-9', 0.93603340541976),
(3169, 3109, 'Weny Sriani Lobo, A.Md.Kes', 'Perawat Gigi Pelaksana Lanjutan/Mahir', '2023-9', 0.65050957202769),
(3170, 3110, 'Inviolata Carmelinda Nahak,A.Md.F', 'Ass. Apoteker Pelaksana Lanjutan', '2023-9', 0.76421555363979),
(3171, 3111, 'Beatrix Maria Illas, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-9', 0.90817859475217),
(3172, 3112, 'Desly Lian,A.Md.Keb', 'Bidan Mahir', '2023-9', 0.93848693211929),
(3173, 3113, 'dr. Radha Govinda Padma, S.Ked', 'Dokter', '2023-9', 0.75012485471469),
(3174, 3114, 'Roselkrans E. Pabara', 'Perawat Penyelia', '2023-9', 0.94558534930786),
(3175, 3115, 'dr. Tika Anggraeni', 'Dokter', '2023-9', 0.87873250539343),
(3176, 3116, 'dr. Elisabeth Sophiane, S.Ked', 'Dokter', '2023-9', 0.80170695667885),
(3177, 3117, 'Yeny Sunaria Haning, SST', 'Nutrisionis Pertama', '2023-9', 0.80157103032863),
(3178, 3118, 'Katarina Dae,A.Md.Kep', 'Perawat Mahir', '2023-9', 0.76019416972081),
(3179, 3119, 'Filipina Telnoni, A.Md.Keb', 'Bidan Mahir', '2023-9', 0.90473455585964),
(3180, 3120, 'Maria Letelay, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-9 ', 0.87007570154857),
(3181, 3121, 'Getereda Benu, A.Md.Keb', 'Bidan Pelaksana Lanjutan/Mahir', '2023-9', 0.81863020433194),
(3182, 3122, 'Isabela Pia, A.Md.Keb', 'Bidan Terampil', '2023-9', 0.88828444928153),
(3183, 3123, 'Imelda Merdekawati Arlis, A.Md.Keb', 'Bidan Pelaksana/Terampil', '2023-9', 0.93839281307277),
(3184, 3124, 'Maria Ima Colata Fallo Sabuin, A.Md.Keb', 'Bidan', '2023-9', 0.92884086918467),
(3185, 3125, 'Lidwina Adinda Saputri Harry, A.Md.Keb', 'Bidan', '2023-9', 0.63140568425149),
(3186, 3126, 'Julita Beatriz Pah De Araujo, A.Md.Kes', 'Pranata Laboratorium Kesehatan/ATLM', '2023-9', 0.85627530086729),
(3187, 3127, 'Dorotea Barek Bura, A.Md.Kep', 'Perawat', '2023-9', 0.77344333308461),
(3188, 3128, 'Febriana Da Costa, A.Md.Kes', 'Terapis Gigi dan Mulut', '2023-9', 0.73508725929783),
(3189, 3129, 'Yuliana Peni Witin, A.Md.Farm', 'Asisten Apoteker', '2023-9', 0.70138069674041),
(3190, 3130, 'Megga Bestari Nenotek, A.Md.Kep', 'Perawat', '2023-9', 0.60459796278139),
(3191, 3131, 'Hendrikus G. S. I. Juleidin, A.Md.Kep', 'Perawat', '2023-9', 0.87678562614553),
(3192, 3132, 'Ricky Abraham Lofa, A.Md.GZ', 'Nutrisionis', '2023-9', 0.96241447791442),
(3193, 3133, 'dr. Diogo A. Fernandez', 'Dokter Umum', '2023-9', 0.71258514633134),
(3194, 3134, 'dr.Resky F. Rona', 'Dokter Umum', '2023-9', 0.78639440742489),
(3195, 3135, 'Innayatun Rubaiyah, A.Md.Kep', 'Perawat', '2023-9', 0.99044805611191),
(3196, 3136, 'Daud Fek', 'Tenaga Administrasi', '2023-9', 0.72402985483806),
(3197, 3137, 'Novelinda Ngara Kana, SH', 'Tenaga Administrasi', '2023-9', 0.61859046735872),
(3198, 3138, 'Mardon Y. Foeh, SE', 'Tenaga Akuntansi', '2023-9', 0.64095762813959),
(3199, 3139, 'Yulia C. Husada, A.Md.Kep', 'Perawat', '2023-9', 0.95669567985226),
(3200, 3140, 'Agnes Legifani, A.Md.KG', 'Perawat Gigi', '2023-9', 0.71751003577919),
(3201, 3141, 'Apriedsan R. Non, A.Md.Gz', 'Tenaga Gizi', '2023-9', 0.88014501655468),
(3202, 3142, 'Nur Asmi Burhan, A.Md.F', 'Asisten Apoteker', '2023-9', 0.64095762813959),
(3203, 3143, 'Esau Hunggurami, S.KM', 'Penyuluh Kesehatan Masyarakat', '2023-9', 0.88091314551654),
(3204, 3144, 'Fatahiyah D. Mau, A.Md.AK', 'Analis Kesehatan', '2023-9', 0.8844029981113),
(3205, 3145, 'Siti Maryam Batjo, A.Md.Keb', 'Bidan', '2023-9', 0.67695021897211),
(3206, 3146, 'Ica Agrisa Agustince Sanam, A.Md.Keb', 'Bidan', '2023-9 ', 0.99044805611191),
(3207, 3147, 'Marlinda Ivoni Hano, A.Md.Keb', 'Bidan', '2023-9', 0.75361470730946),
(3208, 3148, 'Dina Luis, A.Md.Kep', 'Perawat', '2023-9', 0.90850931143633),
(3209, 3149, 'Yulesthie Yolan Mulnyria Ndaomanu, A.Md.Kep', 'Perawat', '2023-9', 0.96397286457072);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `keterangan` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `keterangan`) VALUES
(0, 'Admin'),
(1, 'Petugas'),
(2, 'Pakar/Ahli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `id` char(36) NOT NULL,
  `pengguna` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`id`, `pengguna`) VALUES
('0aa01c30-9cea-11ee-acca-d05f6436850a', 'admin'),
('0bfba3c3-a0c9-11ee-aa74-7cb27de7d546', 'admin'),
('0d9a5a66-a188-11ee-8f8d-d05f6436850a', 'admin'),
('0fa847f8-a188-11ee-8f8d-d05f6436850a', 'admin'),
('234af0a2-9b5b-11ee-ab67-d05f6436850a', 'admin'),
('259c8870-ba8e-11ee-b3c6-d05f6436850a', 'admin'),
('4c2bc95b-a16a-11ee-8f8d-d05f6436850a', 'admin'),
('4d5575af-9b5d-11ee-ab67-d05f6436850a', 'admin'),
('5841155b-9b5c-11ee-ab67-d05f6436850a', 'admin'),
('5a73af95-a0e1-11ee-aa74-7cb27de7d546', 'admin'),
('7598a23a-a0db-11ee-aa74-7cb27de7d546', 'admin'),
('856316cb-9b5d-11ee-ab67-d05f6436850a', 'admin'),
('8cbebd43-0318-11ef-83c5-d05f6436850a', 'admin'),
('8faf2e02-a0db-11ee-aa74-7cb27de7d546', 'admin'),
('914f237d-a169-11ee-8f8d-d05f6436850a', 'admin'),
('9bfacefa-a168-11ee-8f8d-d05f6436850a', 'admin'),
('9e5cf0ed-a168-11ee-8f8d-d05f6436850a', 'admin'),
('ae6a9796-ba8d-11ee-b3c6-d05f6436850a', 'admin'),
('b07f8eee-ba8d-11ee-b3c6-d05f6436850a', 'admin'),
('b6352161-9b5c-11ee-ab67-d05f6436850a', 'admin'),
('b7c4bc0d-0d8c-11ea-aaea-7a1b192e9b80', 'admin'),
('bc1d88fd-b9c5-11ee-aec1-d05f6436850a', 'admin'),
('be4b8da7-b9c6-11ee-aec1-d05f6436850a', 'admin'),
('be96b50a-b9c5-11ee-aec1-d05f6436850a', 'admin'),
('cc736795-11f9-11ef-bcde-d05f6436850a', 'admin'),
('ccb22892-a0db-11ee-aa74-7cb27de7d546', 'admin'),
('e01a0133-0fcd-11ef-99ce-d05f6436850a', 'admin'),
('e0413a2e-ba8d-11ee-b3c6-d05f6436850a', 'admin'),
('e1b0522d-0554-11ef-905f-d05f6436850a', 'admin'),
('e6f72f7a-9ce3-11ee-acca-d05f6436850a', 'admin'),
('edb9b737-a169-11ee-8f8d-d05f6436850a', 'admin'),
('f9c75a34-a188-11ee-8f8d-d05f6436850a', 'admin'),
('fb564628-a169-11ee-8f8d-d05f6436850a', 'admin'),
('fc13ba21-a188-11ee-8f8d-d05f6436850a', 'admin'),
('fc5f9b2a-a863-11ee-b4ef-d05f6436850a', 'admin'),
('0925e126-b9c9-11ee-aec1-d05f6436850a', 'pakar'),
('0cc9735d-b9c5-11ee-aec1-d05f6436850a', 'pakar'),
('0f9f1246-b9c7-11ee-aec1-d05f6436850a', 'pakar'),
('18431caf-b9c8-11ee-aec1-d05f6436850a', 'pakar'),
('195fe5a1-b9c9-11ee-aec1-d05f6436850a', 'pakar'),
('205df190-bb9c-11ee-a97d-d05f6436850a', 'pakar'),
('2373737f-c04e-11ee-8d99-d05f6436850a', 'pakar'),
('29b23202-b9c7-11ee-aec1-d05f6436850a', 'pakar'),
('2aefbb57-9b5b-11ee-ab67-d05f6436850a', 'pakar'),
('37a1c97e-b9c8-11ee-aec1-d05f6436850a', 'pakar'),
('3a74ed09-ba8d-11ee-b3c6-d05f6436850a', 'pakar'),
('45cbb677-a187-11ee-8f8d-d05f6436850a', 'pakar'),
('4748ed43-9b64-11ee-ab67-d05f6436850a', 'pakar'),
('64d1b4c8-a97a-11ee-878a-d05f6436850a', 'pakar'),
('65dd9bdb-b9c5-11ee-aec1-d05f6436850a', 'pakar'),
('68784f5b-b9c8-11ee-aec1-d05f6436850a', 'pakar'),
('71e2be6c-a600-11ee-aefd-d05f6436850a', 'pakar'),
('7fbcfafd-9810-11ee-bab5-7cb27de7d546', 'pakar'),
('82fafa86-bebc-11ee-8619-d05f6436850a', 'pakar'),
('83dad316-a602-11ee-aefd-d05f6436850a', 'pakar'),
('919db45a-aa50-11ee-bf41-d05f6436850a', 'pakar'),
('97c9931c-a0db-11ee-aa74-7cb27de7d546', 'pakar'),
('a85205be-9b5c-11ee-ab67-d05f6436850a', 'pakar'),
('af967fc1-0eed-11ef-8913-d05f6436850a', 'pakar'),
('b1364b35-b208-11ee-87b9-d05f6436850a', 'pakar'),
('b73a3197-b9c6-11ee-aec1-d05f6436850a', 'pakar'),
('b84d08c6-b9c5-11ee-aec1-d05f6436850a', 'pakar'),
('bbb392ee-a65a-11ee-998c-d05f6436850a', 'pakar'),
('bbcc76f7-b600-11ee-9374-d05f6436850a', 'pakar'),
('bbe771ad-0ab3-11ea-a4b9-68ccc88749d6', 'pakar'),
('bec6f9d7-a866-11ee-b4ef-d05f6436850a', 'pakar'),
('bf0931e4-b9c7-11ee-aec1-d05f6436850a', 'pakar'),
('c2b80c40-a169-11ee-8f8d-d05f6436850a', 'pakar'),
('ca80a2d9-b9c6-11ee-aec1-d05f6436850a', 'pakar'),
('d4e5dbc8-a0db-11ee-aa74-7cb27de7d546', 'pakar'),
('d7e856ae-b9c4-11ee-aec1-d05f6436850a', 'pakar'),
('db57f168-b9c4-11ee-aec1-d05f6436850a', 'pakar'),
('e37d34aa-ba8d-11ee-b3c6-d05f6436850a', 'pakar'),
('e8bc971f-a6e0-11ee-bc88-d05f6436850a', 'pakar'),
('ea33872d-b9c4-11ee-aec1-d05f6436850a', 'pakar'),
('ebc31b8d-9b5f-11ee-ab67-d05f6436850a', 'pakar'),
('f2a03acc-abed-11ee-b13d-d05f6436850a', 'pakar'),
('f533d064-127c-11ef-80fe-d05f6436850a', 'pakar'),
('fd5db0fb-a169-11ee-8f8d-d05f6436850a', 'pakar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `alternatif` int(11) DEFAULT NULL,
  `kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`alternatif`, `kriteria`, `nilai`) VALUES
(3081, 48, 1),
(3081, 49, 5),
(3081, 50, 4),
(3081, 51, 5),
(3081, 52, 5),
(3081, 53, 4),
(3081, 54, 5),
(3081, 55, 2),
(3082, 48, 1),
(3082, 49, 5),
(3082, 50, 4),
(3082, 51, 4),
(3082, 52, 4),
(3082, 53, 3),
(3082, 54, 5),
(3082, 55, 2),
(3083, 48, 1),
(3083, 49, 5),
(3083, 50, 3),
(3083, 51, 5),
(3083, 52, 4),
(3083, 53, 4),
(3083, 54, 5),
(3083, 55, 3),
(3084, 48, 1),
(3084, 49, 5),
(3084, 50, 3),
(3084, 51, 3),
(3084, 52, 5),
(3084, 53, 4),
(3084, 54, 3),
(3084, 55, 2),
(3085, 48, 1),
(3085, 49, 3),
(3085, 50, 4),
(3085, 51, 4),
(3085, 52, 4),
(3085, 53, 3),
(3085, 54, 5),
(3085, 55, 1),
(3086, 48, 2),
(3086, 49, 5),
(3086, 50, 4),
(3086, 51, 5),
(3086, 52, 5),
(3086, 53, 4),
(3086, 54, 5),
(3086, 55, 2),
(3087, 48, 2),
(3087, 49, 5),
(3087, 50, 4),
(3087, 51, 4),
(3087, 52, 5),
(3087, 53, 4),
(3087, 54, 5),
(3087, 55, 1),
(3088, 48, 1),
(3088, 49, 5),
(3088, 50, 4),
(3088, 51, 5),
(3088, 52, 5),
(3088, 53, 3),
(3088, 54, 5),
(3088, 55, 3),
(3089, 48, 2),
(3089, 49, 5),
(3089, 50, 4),
(3089, 51, 4),
(3089, 52, 4),
(3089, 53, 4),
(3089, 54, 5),
(3089, 55, 1),
(3090, 48, 1),
(3090, 49, 5),
(3090, 50, 4),
(3090, 51, 4),
(3090, 52, 5),
(3090, 53, 2),
(3090, 54, 5),
(3090, 55, 2),
(3091, 48, 2),
(3091, 49, 1),
(3091, 50, 4),
(3091, 51, 5),
(3091, 52, 4),
(3091, 53, 4),
(3091, 54, 5),
(3091, 55, 3),
(3092, 48, 2),
(3092, 49, 5),
(3092, 50, 4),
(3092, 51, 4),
(3092, 52, 4),
(3092, 53, 4),
(3092, 54, 5),
(3092, 55, 2),
(3093, 48, 1),
(3093, 49, 3),
(3093, 50, 4),
(3093, 51, 3),
(3093, 52, 4),
(3093, 53, 3),
(3093, 54, 5),
(3093, 55, 1),
(3094, 48, 1),
(3094, 49, 1),
(3094, 50, 4),
(3094, 51, 4),
(3094, 52, 5),
(3094, 53, 4),
(3094, 54, 4),
(3094, 55, 1),
(3095, 48, 1),
(3095, 49, 5),
(3095, 50, 3),
(3095, 51, 4),
(3095, 52, 4),
(3095, 53, 4),
(3095, 54, 4),
(3095, 55, 2),
(3096, 48, 1),
(3096, 49, 5),
(3096, 50, 4),
(3096, 51, 4),
(3096, 52, 4),
(3096, 53, 2),
(3096, 54, 5),
(3096, 55, 2),
(3097, 48, 1),
(3097, 49, 4),
(3097, 50, 4),
(3097, 51, 3),
(3097, 52, 5),
(3097, 53, 4),
(3097, 54, 5),
(3097, 55, 3),
(3098, 48, 1),
(3098, 49, 5),
(3098, 50, 3),
(3098, 51, 5),
(3098, 52, 4),
(3098, 53, 3),
(3098, 54, 4),
(3098, 55, 2),
(3099, 48, 1),
(3099, 49, 4),
(3099, 50, 4),
(3099, 51, 5),
(3099, 52, 4),
(3099, 53, 2),
(3099, 54, 5),
(3099, 55, 3),
(3100, 48, 1),
(3100, 49, 1),
(3100, 50, 4),
(3100, 51, 3),
(3100, 52, 5),
(3100, 53, 3),
(3100, 54, 5),
(3100, 55, 4),
(3101, 48, 1),
(3101, 49, 5),
(3101, 50, 4),
(3101, 51, 3),
(3101, 52, 5),
(3101, 53, 3),
(3101, 54, 5),
(3101, 55, 3),
(3102, 48, 1),
(3102, 49, 1),
(3102, 50, 3),
(3102, 51, 3),
(3102, 52, 4),
(3102, 53, 4),
(3102, 54, 4),
(3102, 55, 2),
(3103, 48, 1),
(3103, 49, 5),
(3103, 50, 4),
(3103, 51, 3),
(3103, 52, 3),
(3103, 53, 4),
(3103, 54, 5),
(3103, 55, 3),
(3104, 48, 1),
(3104, 49, 5),
(3104, 50, 4),
(3104, 51, 5),
(3104, 52, 5),
(3104, 53, 3),
(3104, 54, 5),
(3104, 55, 2),
(3105, 48, 2),
(3105, 49, 5),
(3105, 50, 3),
(3105, 51, 5),
(3105, 52, 5),
(3105, 53, 4),
(3105, 54, 4),
(3105, 55, 3),
(3106, 48, 2),
(3106, 49, 5),
(3106, 50, 4),
(3106, 51, 5),
(3106, 52, 5),
(3106, 53, 4),
(3106, 54, 5),
(3106, 55, 1),
(3107, 48, 1),
(3107, 49, 1),
(3107, 50, 4),
(3107, 51, 5),
(3107, 52, 4),
(3107, 53, 4),
(3107, 54, 5),
(3107, 55, 3),
(3108, 48, 1),
(3108, 49, 5),
(3108, 50, 4),
(3108, 51, 3),
(3108, 52, 5),
(3108, 53, 3),
(3108, 54, 5),
(3108, 55, 2),
(3109, 48, 2),
(3109, 49, 1),
(3109, 50, 4),
(3109, 51, 5),
(3109, 52, 5),
(3109, 53, 4),
(3109, 54, 5),
(3109, 55, 3),
(3110, 48, 2),
(3110, 49, 5),
(3110, 50, 4),
(3110, 51, 3),
(3110, 52, 5),
(3110, 53, 3),
(3110, 54, 5),
(3110, 55, 2),
(3111, 48, 1),
(3111, 49, 5),
(3111, 50, 3),
(3111, 51, 4),
(3111, 52, 5),
(3111, 53, 3),
(3111, 54, 5),
(3111, 55, 1),
(3112, 48, 1),
(3112, 49, 5),
(3112, 50, 3),
(3112, 51, 4),
(3112, 52, 5),
(3112, 53, 4),
(3112, 54, 5),
(3112, 55, 3),
(3113, 48, 2),
(3113, 49, 4),
(3113, 50, 4),
(3113, 51, 5),
(3113, 52, 4),
(3113, 53, 4),
(3113, 54, 5),
(3113, 55, 2),
(3114, 48, 1),
(3114, 49, 5),
(3114, 50, 4),
(3114, 51, 3),
(3114, 52, 5),
(3114, 53, 3),
(3114, 54, 5),
(3114, 55, 3),
(3115, 48, 1),
(3115, 49, 4),
(3115, 50, 4),
(3115, 51, 3),
(3115, 52, 4),
(3115, 53, 4),
(3115, 54, 5),
(3115, 55, 1),
(3116, 48, 2),
(3116, 49, 5),
(3116, 50, 4),
(3116, 51, 5),
(3116, 52, 4),
(3116, 53, 4),
(3116, 54, 5),
(3116, 55, 3),
(3117, 48, 1),
(3117, 49, 1),
(3117, 50, 4),
(3117, 51, 5),
(3117, 52, 5),
(3117, 53, 3),
(3117, 54, 5),
(3117, 55, 2),
(3118, 48, 2),
(3118, 49, 5),
(3118, 50, 4),
(3118, 51, 5),
(3118, 52, 4),
(3118, 53, 2),
(3118, 54, 5),
(3118, 55, 1),
(3119, 48, 1),
(3119, 49, 5),
(3119, 50, 3),
(3119, 51, 3),
(3119, 52, 4),
(3119, 53, 4),
(3119, 54, 5),
(3119, 55, 3),
(3120, 48, 1),
(3120, 49, 4),
(3120, 50, 3),
(3120, 51, 3),
(3120, 52, 5),
(3120, 53, 4),
(3120, 54, 5),
(3120, 55, 2),
(3121, 48, 2),
(3121, 49, 5),
(3121, 50, 4),
(3121, 51, 5),
(3121, 52, 5),
(3121, 53, 4),
(3121, 54, 5),
(3121, 55, 3),
(3122, 48, 1),
(3122, 49, 4),
(3122, 50, 4),
(3122, 51, 3),
(3122, 52, 4),
(3122, 53, 4),
(3122, 54, 5),
(3122, 55, 2),
(3123, 48, 1),
(3123, 49, 5),
(3123, 50, 3),
(3123, 51, 5),
(3123, 52, 4),
(3123, 53, 4),
(3123, 54, 5),
(3123, 55, 3),
(3124, 48, 1),
(3124, 49, 5),
(3124, 50, 3),
(3124, 51, 5),
(3124, 52, 4),
(3124, 53, 4),
(3124, 54, 5),
(3124, 55, 2),
(3125, 48, 2),
(3125, 49, 1),
(3125, 50, 4),
(3125, 51, 5),
(3125, 52, 5),
(3125, 53, 4),
(3125, 54, 5),
(3125, 55, 1),
(3126, 48, 1),
(3126, 49, 5),
(3126, 50, 3),
(3126, 51, 3),
(3126, 52, 3),
(3126, 53, 3),
(3126, 54, 4),
(3126, 55, 2),
(3127, 48, 1),
(3127, 49, 1),
(3127, 50, 4),
(3127, 51, 5),
(3127, 52, 4),
(3127, 53, 2),
(3127, 54, 5),
(3127, 55, 2),
(3128, 48, 2),
(3128, 49, 4),
(3128, 50, 4),
(3128, 51, 5),
(3128, 52, 5),
(3128, 53, 2),
(3128, 54, 5),
(3128, 55, 1),
(3129, 48, 2),
(3129, 49, 5),
(3129, 50, 3),
(3129, 51, 3),
(3129, 52, 4),
(3129, 53, 3),
(3129, 54, 4),
(3129, 55, 2),
(3130, 48, 2),
(3130, 49, 1),
(3130, 50, 3),
(3130, 51, 5),
(3130, 52, 5),
(3130, 53, 4),
(3130, 54, 4),
(3130, 55, 3),
(3131, 48, 1),
(3131, 49, 5),
(3131, 50, 2),
(3131, 51, 5),
(3131, 52, 3),
(3131, 53, 4),
(3131, 54, 5),
(3131, 55, 2),
(3132, 48, 1),
(3132, 49, 5),
(3132, 50, 4),
(3132, 51, 4),
(3132, 52, 5),
(3132, 53, 3),
(3132, 54, 5),
(3132, 55, 3),
(3133, 48, 2),
(3133, 49, 5),
(3133, 50, 3),
(3133, 51, 3),
(3133, 52, 4),
(3133, 53, 4),
(3133, 54, 4),
(3133, 55, 2),
(3134, 48, 1),
(3134, 49, 1),
(3134, 50, 4),
(3134, 51, 4),
(3134, 52, 5),
(3134, 53, 4),
(3134, 54, 5),
(3134, 55, 1),
(3135, 48, 1),
(3135, 49, 5),
(3135, 50, 4),
(3135, 51, 5),
(3135, 52, 5),
(3135, 53, 4),
(3135, 54, 5),
(3135, 55, 3),
(3136, 48, 1),
(3136, 49, 1),
(3136, 50, 2),
(3136, 51, 4),
(3136, 52, 5),
(3136, 53, 3),
(3136, 54, 5),
(3136, 55, 3),
(3137, 48, 2),
(3137, 49, 5),
(3137, 50, 1),
(3137, 51, 4),
(3137, 52, 3),
(3137, 53, 2),
(3137, 54, 3),
(3137, 55, 3),
(3138, 48, 2),
(3138, 49, 1),
(3138, 50, 4),
(3138, 51, 5),
(3138, 52, 5),
(3138, 53, 4),
(3138, 54, 5),
(3138, 55, 2),
(3139, 48, 1),
(3139, 49, 5),
(3139, 50, 4),
(3139, 51, 4),
(3139, 52, 4),
(3139, 53, 4),
(3139, 54, 5),
(3139, 55, 3),
(3140, 48, 1),
(3140, 49, 1),
(3140, 50, 3),
(3140, 51, 3),
(3140, 52, 4),
(3140, 53, 4),
(3140, 54, 5),
(3140, 55, 1),
(3141, 48, 1),
(3141, 49, 5),
(3141, 50, 3),
(3141, 51, 3),
(3141, 52, 5),
(3141, 53, 2),
(3141, 54, 5),
(3141, 55, 1),
(3142, 48, 2),
(3142, 49, 1),
(3142, 50, 4),
(3142, 51, 5),
(3142, 52, 5),
(3142, 53, 4),
(3142, 54, 5),
(3142, 55, 2),
(3143, 48, 1),
(3143, 49, 4),
(3143, 50, 4),
(3143, 51, 3),
(3143, 52, 3),
(3143, 53, 4),
(3143, 54, 5),
(3143, 55, 3),
(3144, 48, 1),
(3144, 49, 5),
(3144, 50, 3),
(3144, 51, 3),
(3144, 52, 4),
(3144, 53, 4),
(3144, 54, 4),
(3144, 55, 2),
(3145, 48, 1),
(3145, 49, 1),
(3145, 50, 3),
(3145, 51, 3),
(3145, 52, 3),
(3145, 53, 2),
(3145, 54, 4),
(3145, 55, 2),
(3146, 48, 1),
(3146, 49, 5),
(3146, 50, 4),
(3146, 51, 5),
(3146, 52, 5),
(3146, 53, 4),
(3146, 54, 5),
(3146, 55, 3),
(3147, 48, 2),
(3147, 49, 5),
(3147, 50, 3),
(3147, 51, 5),
(3147, 52, 5),
(3147, 53, 4),
(3147, 54, 4),
(3147, 55, 1),
(3148, 48, 1),
(3148, 49, 5),
(3148, 50, 3),
(3148, 51, 5),
(3148, 52, 4),
(3148, 53, 4),
(3148, 54, 4),
(3148, 55, 1),
(3149, 48, 1),
(3149, 49, 5),
(3149, 50, 4),
(3149, 51, 5),
(3149, 52, 4),
(3149, 53, 4),
(3149, 54, 5),
(3149, 55, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` char(50) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `nama` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `level`, `nama`) VALUES
('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0, 'admin'),
('pakar', 'fe65e2bda80133a7e34d263ce30d5e13030a7b3423e9404ee3307764bea94ed9', 2, 'pakar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` char(36) NOT NULL,
  `tanggapan` text,
  `akurasi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `atribut`
--
ALTER TABLE `atribut`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD KEY `kriteria_1` (`kriteria_1`),
  ADD KEY `kriteria_2` (`kriteria_2`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_ibfk_1` (`atribut`);

--
-- Indeks untuk tabel `laporan_alternatif`
--
ALTER TABLE `laporan_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alternatif` (`alternatif`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masuk_ibfk_1` (`pengguna`);

--
-- Indeks untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD KEY `alternatif` (`alternatif`),
  ADD KEY `kriteria` (`kriteria`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`),
  ADD KEY `level` (`level`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3150;

--
-- AUTO_INCREMENT untuk tabel `atribut`
--
ALTER TABLE `atribut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `laporan_alternatif`
--
ALTER TABLE `laporan_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3210;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`kriteria_1`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`kriteria_2`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`atribut`) REFERENCES `atribut` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`pengguna`) REFERENCES `pengguna` (`username`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`alternatif`) REFERENCES `alternatif` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`kriteria`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
