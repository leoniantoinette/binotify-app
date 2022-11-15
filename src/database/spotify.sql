-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2022 pada 09.25
-- Versi server: 10.6.5-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `Judul` char(64) NOT NULL,
  `Penyanyi` char(128) NOT NULL,
  `Total_duration` int(11) NOT NULL,
  `Image_path` char(255) NOT NULL,
  `Tanggal_terbit` date NOT NULL,
  `Genre` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`album_id`, `Judul`, `Penyanyi`, `Total_duration`, `Image_path`, `Tanggal_terbit`, `Genre`) VALUES
(1, 'Loan Interviewer', 'Otilia Tillman', 846, 'assets/CoverImages/goldfish.jpg', '2008-01-29', 'Pop'),
(9, 'Manager of Food Preparation', 'Ms. Ruthie Satterfield Sr.', 434, 'assets/CoverImages/goldfish.jpg', '2016-06-07', 'Rock'),
(15, 'Dot Etcher', 'Stanley Bins', 2140, 'assets/CoverImages/goldfish.jpg', '2007-03-16', 'Pop'),
(16, 'Soldering Machine Setter', 'Prof. Meta Schmeler IV', 1188, 'assets/CoverImages/goldfish.jpg', '1989-06-06', 'Jazz'),
(23, 'Medical Transcriptionist', 'Abigayle Casper', 2329, 'assets/CoverImages/goldfish.jpg', '1998-06-01', 'Jazz'),
(24, 'Computer Specialist', 'Summer Kshlerin', 2140, 'assets/CoverImages/goldfish.jpg', '2019-10-06', 'Pop'),
(26, 'Crane and Tower Operator', 'Arthur Brekke', 2140, 'assets/CoverImages/goldfish.jpg', '1970-07-12', 'Pop'),
(29, 'Trainer', 'Mr. Randal Smith Jr.', 2140, 'assets/CoverImages/goldfish.jpg', '1978-07-21', 'Pop'),
(37, 'Motion Picture Projectionist', 'Kari Frami', 2329, 'assets/CoverImages/goldfish.jpg', '2012-11-30', 'Jazz'),
(48, 'Designer', 'Bud Block III', 3140, 'assets/CoverImages/goldfish.jpg', '1997-03-07', 'Rock'),
(50, 'Textile Cutting Machine Operator', 'Dale Rice', 2140, 'assets/CoverImages/goldfish.jpg', '1996-04-27', 'Pop'),
(52, 'Conservation Scientist', 'Brad Swift', 3140, 'assets/CoverImages/goldfish.jpg', '2004-09-09', 'Rock'),
(53, 'Fire-Prevention Engineer', 'Darion Larson', 2140, 'assets/CoverImages/goldfish.jpg', '1983-04-06', 'Pop'),
(54, 'Pressure Vessel Inspector', 'Cierra Bashirian', 3140, 'assets/CoverImages/goldfish.jpg', '1993-11-25', 'Rock'),
(61, 'Entertainment Attendant', 'Ana Vandervort', 2329, 'assets/CoverImages/goldfish.jpg', '1993-12-15', 'Jazz'),
(71, 'Communications Equipment Operator', 'Dr. Cordia Schoen', 2140, 'assets/CoverImages/goldfish.jpg', '1979-11-12', 'Pop'),
(74, 'Home', 'Lonie Witting PhD', 2329, 'assets/CoverImages/goldfish.jpg', '1972-11-10', 'Jazz'),
(76, 'd', 'Ms. Era Pagac DDS', 2140, 'assets/CoverImages/goldfish.jpg', '0222-02-23', 'Jazz'),
(79, 'Locker Room Attendant', 'Alice Farrell', 2140, 'assets/CoverImages/goldfish.jpg', '1974-09-16', 'Pop'),
(83, 'Gas Appliance Repairer', 'Markus Vandervort', 2329, 'assets/CoverImages/goldfish.jpg', '2001-09-22', 'Jazz'),
(89, 'Housekeeper', 'Carmelo Cronin', 2140, 'assets/CoverImages/goldfish.jpg', '1992-07-10', 'Pop'),
(97, 'Telecommunications Equipment Installer', 'Hoyt Rodriguez', 2140, 'assets/CoverImages/goldfish.jpg', '1979-04-23', 'Pop'),
(130, 'Management Analyst', 'Laisha Jacobi DDS', 2329, 'assets/CoverImages/goldfish.jpg', '2014-08-12', 'Jazz'),
(214, 'Mathematical Science Teacher', 'Roy Powlowski', 2329, 'assets/CoverImages/goldfish.jpg', '1973-06-05', 'Jazz'),
(797, 'Computer-Controlled Machine Tool Operator', 'Margarette Medhurst', 2329, 'assets/CoverImages/goldfish.jpg', '1995-06-28', 'Jazz'),
(821, 'Geoscientists', 'Percy Nitzsche DDS', 2329, 'assets/CoverImages/goldfish.jpg', '1994-12-15', 'Jazz'),
(943, 'Library Worker', 'Rashad Mitchell', 2329, 'assets/CoverImages/goldfish.jpg', '2019-08-15', 'Jazz'),
(992, 'Plate Finisher', 'Monroe Legros', 2329, 'assets/CoverImages/goldfish.jpg', '2017-06-11', 'Jazz'),
(1182, 'Crushing Grinding Machine Operator', 'Elisa Schaefer', 2329, 'assets/CoverImages/goldfish.jpg', '1983-01-23', 'Jazz'),
(3109, 'Platemaker', 'Ms. Edythe Monahan', 2329, 'assets/CoverImages/goldfish.jpg', '1998-08-19', 'Jazz'),
(3362, 'Leoni Gilang Yola', 'Ardith Batz', 408, 'assets/CoverImages/goldfish.jpg', '2021-08-18', 'Country'),
(3926, 'Obstetrician', 'Chloe Bailey', 2329, 'assets/CoverImages/goldfish.jpg', '1997-04-18', 'Jazz'),
(7143, 'Financial Manager', 'Harley Weimann', 2329, 'assets/CoverImages/goldfish.jpg', '2004-04-01', 'Jazz'),
(8608, 'Segmental Paver', 'Bailee Beahan', 2329, 'assets/CoverImages/goldfish.jpg', '2014-10-05', 'Jazz'),
(8609, 'album', 'yola', 0, 'assets/CoverImages/goldfish.jpg', '2929-01-31', 'Rock'),
(8610, 'a', 'a', 0, 'assets/CoverImages/goldfish.jpg', '3333-02-23', 'Rock'),
(8611, 'Fish', 'BLACKPINK', 0, 'assets/CoverImages/goldfish.jpg', '2020-12-20', 'Pop');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `duration_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `duration_view` (
`album_id` int(11)
,`durasi` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `song`
--

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `Judul` char(64) NOT NULL,
  `Penyanyi` char(128) NOT NULL,
  `Tanggal_terbit` date NOT NULL,
  `Genre` char(64) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Audio_path` char(255) NOT NULL,
  `Image_path` char(255) NOT NULL,
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `song`
--

INSERT INTO `song` (`song_id`, `Judul`, `Penyanyi`, `Tanggal_terbit`, `Genre`, `Duration`, `Audio_path`, `Image_path`, `album_id`) VALUES
(1, 'Marine Architect', 'Jayme Leffler', '1971-07-29', 'Pop', 210, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 3362),
(926, 'Casting Machine Set-Up Operator', 'Ms. Kathleen Hermann', '1977-06-30', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 3362),
(945, 'Shuttle Car Operator', 'Dr. Cydney Huel', '1996-06-02', 'Pop', 216, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 1),
(1021, 'Psychology Teacher', 'Montana Wunsch', '1973-08-21', 'Rock', 217, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 9),
(1288, 'Animal Control Worker', 'Chasity Toy Jr.', '1993-02-16', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 16),
(2149, 'Budget Analyst', 'Akeem Carroll', '1984-11-08', 'Pop', 210, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 1),
(2155, 'Public Transportation Inspector', 'Miss Anna Hammes MD', '2011-08-13', 'Pop', 210, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 1),
(2260, 'Sawing Machine Operator', 'Miss Arlene Raynor DVM', '1996-09-14', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 16),
(2480, 'Correspondence Clerk', 'Mr. Joseph Lynch', '2000-05-08', 'Pop', 210, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 1),
(3224, 'Camera Repairer', 'Prof. David Legros DVM', '2006-05-16', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 16),
(3826, 'Surveyor', 'Madisyn Kozey', '1987-11-13', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 16),
(4435, 'Usher', 'Andrew Bradtke', '1997-11-04', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 16),
(4527, 'Streetcar Operator', 'Alvina Schowalter', '2009-01-28', 'Rock', 217, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 9),
(5058, 'Silversmith', 'Fredy Bailey PhD', '2017-04-20', 'Jazz', 198, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', 16),
(9943, 'Interaksi', 'Tulus', '2017-02-20', 'Pop', 11, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', NULL),
(9944, 'Ice Cream', 'BLACKPINK', '2018-09-13', 'Rnb', 183, 'assets/Song/BLACKPINK - Ice Cream.mp3', 'assets/CoverImages/panda.jpg', NULL);

--
-- Trigger `song`
--
DELIMITER $$
CREATE TRIGGER `delete_duration` AFTER DELETE ON `song` FOR EACH ROW begin
    update album
    inner join duration_view
    on album.album_id=duration_view.album_id
    set album.Total_duration=duration_view.durasi;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_duration` AFTER UPDATE ON `song` FOR EACH ROW begin
    update album
    inner join duration_view
    on album.album_id=duration_view.album_id
    set album.Total_duration=duration_view.durasi;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `username` char(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `isAdmin`) VALUES
(1, 'henri28@example.net', 'ab.oi<b`{25Kg=MD', 'bdoyle', 0),
(2, 'marjolaine.wiza@example.org', 'nwF`7|Rm>|8Mm', 'hallie.anderson', 0),
(3, 'jaime84@example.com', 'O178^O3$Z\'l`', 'grodriguez', 0),
(5, 'iabbott@example.net', '4!>9$BJ=3`,nV*nzJ', 'dagmar.hamill', 0),
(6, 'vdietrich@example.net', 'a0.:IsSd3m>WP#>L,', 'verla.tremblay', 0),
(7, 'rahsaan.roberts@example.org', '9Ewp@@bpAK}]>I?nX', 'albin20', 0),
(8, 'flubowitz@example.com', 'Jc.@nt95mB4$E!6', 'turner.claud', 0),
(9, 'brittany.keebler@example.com', 'cxdgx*NK<ZJ]_N}V#<%', 'vwyman', 0),
(10, 'gtremblay@example.net', 'Yxpgw2+i~{6Gp+y', 'lura.bergstrom', 0),
(16, 'lane59@example.org', 'mXE<ubo<ot7', 'ehartmann', 0),
(19, 'alisha.berge@example.net', '}Xe5\\%(aS%{]ROMI', 'sandy41', 0),
(20, 'jazmyne.hagenes@example.org', '@Rsq\'{', 'bailee43', 0),
(32, 'graham38@example.net', 'P~}H60qccH+x9t', 'otis55', 0),
(41, 'murazik.sallie@example.org', '}J*Dv0hGR~(Fe5$S5h!', 'cleveland.kunze', 0),
(42, 'cale.jaskolski@example.org', 'L>2W5&rhNNsUYJ4K;l', 'chaim.heller', 0),
(45, 'beth18@example.net', '%Ml:-R^U>;UD&8!N<{S', 'cronin.lucile', 0),
(52, 'conroy.axel@example.org', 'q=.e]f+gp^', 'gabrielle.schneider', 0),
(54, 'bwisozk@example.org', '7;&+af81>Ay}D$a\\TNaT', 'maximilian92', 0),
(56, 'little.mustafa@example.net', 'Z,sXcPvd0~JF:/@RS]%t', 'nova.considine', 0),
(62, 'mariane08@example.com', 'iit{Tsud', 'leatha73', 0),
(75, 'rhermann@example.net', 'A2\'&FG]$*~Co6yZ\"$M', 'marcos.zboncak', 0),
(77, 'harris.rupert@example.com', ':c<Ooq$\"3', 'bethel.gaylord', 0),
(86, 'ernser.geo@example.net', 'c^?H/|6YG5(', 'loren.brown', 0),
(87, 'amely.johnson@example.net', 'M:#QElD', 'raven47', 0),
(88, 'xbeer@example.com', '6C\\BqTw763', 'gleichner.maximillia', 0),
(95, 'fabiola01@example.org', 'LPT\"}=tguf5`Nh/?+W', 'herman.zboncak', 0),
(96, 'bashirian.lelia@example.org', 'J[{8$bEV>luN', 'billy.kulas', 0),
(603, 'kenna.dietrich@example.com', 'yTGtyt%>', 'brittany01', 0),
(653, 'johanna87@example.net', ']w_f?otTp>.0', 'dillon50', 0),
(782, 'waino.schoen@example.net', '\'5%=lM<P@v', 'camylle.marvin', 0),
(805, 'reuben97@example.net', 'xKG>k`)tKo]L9YGE+Ob', 'kkeebler', 0),
(875, 'buster43@example.com', '\"8E50}fKPO0`Yv', 'gbogan', 0),
(1471, 'gorczany.yasmine@example.com', 'WlJE]ZqL][0;]}X', 'abe.willms', 0),
(1914, 'amalia.kshlerin@example.org', '\'?3FsA|', 'joannie.powlowski', 0),
(3013, 'xlubowitz@example.com', 'E+glhnhq', 'major.sauer', 0),
(3318, 'adell31@example.net', '(g5Ve$V', 'mdenesik', 0),
(5667, 'jovani.conn@example.com', '4tjC9?Yse3NqQP+H</rr', 'mtromp', 0),
(5762, 'avery78@example.org', 'N`*?:f_)ks0Y!;6BD#', 'usatterfield', 0),
(7608, 'veum.dock@example.net', 'NI7gN5zOLs^[', 'acollins', 0),
(8306, 'naomi28@example.org', '<0)Ox\'I', 'treynolds', 0),
(8904, 'wisoky.melissa@example.com', 'KNN#YIzK3<Ua7-G@j', 'king.terrell', 0),
(9707, 'judah.botsford@example.org', 'um~\\xrj', 'norval31', 0),
(11928, 'frami.edward@example.net', '26hMZ,3)q=W^)', 'jed.dietrich', 0),
(15648, 'susana51@example.com', 'l$tV\'QO|hs8', 'qgrant', 0),
(16783, 'douglas.pink@example.net', '&fl]\\ebf-0`', 'elinor.cartwright', 0),
(23326, 'oconnell.nelda@example.net', 'ISH%9mfItP@,c`jAo-xA', 'earlene.cummings', 0),
(32720, 'jacobs.nola@example.org', 'U!l2hn<){4', 'korbin.beahan', 0),
(39991, 'cletus.jacobs@example.org', 'c,Fg8_&:~', 'dach.rogers', 0),
(42465, 'lloyd.christiansen@example.net', '\'x?<V[g6V', 'eliseo87', 0),
(52386, 'alphonso88@example.net', ')bk9&ZZ', 'ffeest', 0),
(58854, 'jrice@example.net', 'S=FI&S4KemY@;R3&oVcg', 'reva.jenkins', 0),
(77372, 'ansley66@example.com', 'Bg0\\nB/V:ZEJ]IiQr,', 'kunde.ethel', 0),
(82262, 'lemke.alene@example.net', 'E?{FGSjhUP;_an', 'mferry', 0),
(83009, 'wreynolds@example.com', '3)70xu~zX](', 'janiya.schamberger', 0),
(94244, 'leanne06@example.org', '(QxgB5q60Q', 'dulce.greenfelder', 0),
(121868, 'aquitzon@example.net', '3Z[fU}UDg+%_d', 'colton.dubuque', 0),
(144530, 'magdalen45@example.net', 'r~%eKR#N-t~F,ye~k', 'miracle.mayer', 0),
(161493, 'marks.francis@example.com', '\\g9>H)%UP@Qgl', 'raynor.paul', 0),
(342473, 'bechtelar.gayle@example.net', '{}#2uxi\'/6F[Ro1', 'leonard.ratke', 0),
(362466, 'bfritsch@example.net', '.*-F@^j(E(y1q', 'cziemann', 0),
(427571, 'acrooks@example.com', 'J<b+\"\':d_mV(', 'madonna.weber', 0),
(515281, 'kristoffer.orn@example.com', '-zb$YnJa:IdVK$^iq4/', 'ruby65', 0),
(717971, 'sandy.will@example.net', 'Iiv[}X\"tB>k/E/Sl?j0', 'raleigh97', 0),
(728336, 'hhyatt@example.org', 'eaf/}X.[o$h8~{2%^~', 'ondricka.edward', 0),
(840872, 'clangworth@example.net', '-z|JbO!0.+E6M', 'bbechtelar', 0),
(899238, 'sallie83@example.net', 'PZ\\O0<S{4JkDXf\\', 'leonardo.hermiston', 0),
(911160, 'hope32@example.com', 'qk8[3eBp', 'kwaters', 0),
(960092, 'quigley.alf@example.com', 'K!]@$g', 'marks.marianna', 0),
(2291949, 'ron19@example.org', 'Z__\"q$g$SE9N', 'montana.heller', 0),
(4152259, 'napoleon.heller@example.net', '>b(F6D2\"', 'antonette.abshire', 0),
(5195395, 'danielle.cronin@example.net', 'Ubj@3^', 'hoeger.ruthie', 0),
(6050850, 'keebler.luella@example.com', 'd_zK![^70DRqj', 'kschmeler', 0),
(9539981, 'davion.hills@example.com', 'BOi;|ql}', 'otilia.morissette', 0),
(9840194, 'weissnat.tom@example.net', 'kfmQ#lo6', 'margarett.kris', 0),
(9999949, 'phyllis63@example.net', '5;(`<\"+Gd(', 'monserrate33', 0),
(12108653, 'inicolas@example.net', 'Vx:*x+5nvy]q!', 'fjacobson', 0),
(16149980, 'lynn.cartwright@example.net', 'fH:Rk8UT[O-v0e', 'bergstrom.leatha', 0),
(23963565, 'metz.mina@example.org', '/Hy|kTb', 'alexander92', 0),
(40611281, 'uoberbrunner@example.org', ':fI$W1T%;', 'jschuster', 0),
(41068279, 'helen.west@example.org', 'ss&Xr~BJbK', 'omcglynn', 0),
(53957587, 'myra.murray@example.net', 'NK^a~XlbVZTF', 'osinski.beau', 0),
(61300657, 'nitzsche.lawson@example.org', 'LUG{m6$x0?p3Mdup', 'yost.jo', 0),
(66605321, 'cielo34@example.net', 'f\'(ZNAcXbFjq~9', 'reilly.loyal', 0),
(78816268, 'albina84@example.net', '-=^l?BVzUyLk/9)V\\q', 'amira.morar', 0),
(86913696, 'hills.monica@example.org', 'F8wzL[', 'anderson.elfrieda', 0),
(87233749, 'zelda95@example.net', 'xZIo`pqyjcHvAj.', 'mckenzie.dach', 0),
(90367476, 'mmcdermott@example.net', 'y4mM.t5f%g9F@zr;+3a^', 'yhuel', 0),
(90706153, 'cassidy25@example.com', '!^4kM+efU,2?\\pVS[+', 'fbashirian', 0),
(96000576, 'maya.tremblay@example.net', '%8FF^xaTYL2', 'clyde.gaylord', 0),
(189235845, 'tillman.andreane@example.net', 'j)YZRC6L(_3s.QLbmN', 'tkoch', 0),
(208819336, 'fhill@example.net', '1ezJ`^m^BlW4=\'/i)', 'rlynch', 0),
(260645132, 'xsenger@example.org', ':nc;fHqd', 'kessler.bonita', 0),
(363802087, 'johnathon23@example.com', 'Eo%X>x?vLlG', 'lubowitz.jewel', 0),
(777193241, 'konopelski.ayla@example.org', 'g(+C7M%govo,', 'estrella96', 0),
(820485332, 'reilly.laverne@example.com', 'y/N{*0', 'abigail.brakus', 0),
(824839950, 'sabrina82@example.com', '8ke_V9fxiJ\'z', 'asa85', 0),
(951430153, 'georgette.ziemann@example.net', 'hs\\q<VZ[vHa6{7sOIU1M', 'hyatt.mattie', 0),
(978574088, 'kris.misty@example.net', '<zMZ)P/DRvM,J\\Vuu<)q', 'buck.rutherford', 0),
(978574098, '12@nanan', '$2y$10$9nO4PSaLhYHaGfmacRCy9O5KpPg2.UCSw.q2wbGrxugKX/h1ongEe', 'huhu', 0),
(978574099, 'fllbryola2020@gmail.com', '$2y$10$5B.CLCzBpwccz6JhaQn.fuO9JcFPX/4uBa92X24eD6Sl2I0rG.PqG', 'ayutidur', 0),
(978574100, 'freakyfun@gmail.com', '$2y$10$hzu2LE7vu4VisBGh72C/fOKW5BBzwABgqJebmO4RlkK1GTYOJHD52', 'freakyfun', 1),
(978574101, 'a@gmail.com', '$2y$10$3wpBOAvZt.JHqw9nd3Zttesj5I1dJB/C6pC6Qx2qsQkSshoEaE/jG', 'a', 0),
(978574102, 'aa@gmail.com', '$2y$10$Ajmcy5ALawmtK1W8MI7LpOmqw1.G5Dz8pYSFS/MGCa4ExYjh9Wfg6', 'aa', 0),
(978574103, 'b@gmail.com', '$2y$10$cJufrHg7BIMwMB1h081lmuzc9GYRqAHzut6wkLmT1.vPbyPsOeWlC', 'b', 0),
(978574104, 'cc@gmail.com', '$2y$10$6FuZkXuLoa0NwYmaOR/ZOuVT1TAawlU/OohaK9SQhmH2sG/9cxkkC', 'cc', 0),
(978574105, 'd@gmail.com', '$2y$10$.mbMVhKjHNG.GbrpyeRQD.rGE3XaXpZ5OOEr5jgcbEUtlaQmWAowS', 'd', 0);

-- --------------------------------------------------------

--
-- Struktur untuk view `duration_view`
--
DROP TABLE IF EXISTS `duration_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `duration_view`  AS SELECT `a`.`album_id` AS `album_id`, sum(`a`.`Duration`) AS `durasi` FROM (`song` `a` join `album` `b`) WHERE `a`.`album_id` = `b`.`album_id` GROUP BY `a`.`album_id` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indeks untuk tabel `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `update_album` (`album_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8612;

--
-- AUTO_INCREMENT untuk tabel `song`
--
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9945;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=978574106;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `update_album` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
