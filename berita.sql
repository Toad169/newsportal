-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2026 at 02:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berita`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id_kategori`, `nama_kategori`, `slug`, `deskripsi`, `created_at`) VALUES
(1, 'Berita Teknologi', 'berita-teknologi', 'Berita terbaru dan terkini seputar dunia teknologi, inovasi digital, dan perkembangan IT.', '2026-01-26 01:06:39'),
(2, 'Perangkat Lunak & Pengembangan', 'perangkat-lunak-pengembangan', 'Artikel, tutorial, dan kabar seputar pemrograman, software engineering, framework, dan tools pengembangan.', '2026-01-26 01:06:39'),
(3, 'Perangkat Keras & Gadget', 'perangkat-keras-gadget', 'Ulasan dan berita mengenai hardware komputer, gadget, smartphone, dan perangkat elektronik.', '2026-01-26 01:06:39'),
(4, 'Kecerdasan Buatan', 'kecerdasan-buatan', 'Pembahasan tren, riset, dan penerapan kecerdasan buatan serta machine learning.', '2026-01-26 01:06:39'),
(5, 'Keamanan Siber', 'keamanan-siber', 'Informasi tentang keamanan digital, kebocoran data, privasi, dan perlindungan sistem.', '2026-01-26 01:06:39'),
(6, 'Sistem Operasi', 'sistem-operasi', 'Berita dan analisis sistem operasi seperti Linux, Windows, BSD, Android, dan lainnya.', '2026-01-26 01:06:39'),
(7, 'Open Source', 'open-source', 'Kabar, komunitas, dan perkembangan perangkat lunak open source dan kolaborasi terbuka.', '2026-01-26 01:06:39'),
(8, 'Internet & Web', 'internet-web', 'Teknologi web, browser, standar internet, platform online, dan budaya digital.', '2026-01-26 01:06:39'),
(9, 'Teknologi Game', 'teknologi-game', 'Teknologi di balik dunia game: hardware, engine, performa, dan inovasi industri game.', '2026-01-26 01:06:39'),
(10, 'Industri Teknologi', 'industri-teknologi', 'Berita bisnis teknologi, startup, perusahaan besar, dan tren industri digital.', '2026-01-26 01:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id_comment` int(11) NOT NULL,
  `id_post` int(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `status` enum('pending','approved','spam') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `id_img` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lvuser`
--

CREATE TABLE `tbl_lvuser` (
  `id_lvuser` int(10) NOT NULL,
  `leveluser` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lvuser`
--

INSERT INTO `tbl_lvuser` (`id_lvuser`, `leveluser`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id_post` int(25) NOT NULL,
  `img` varchar(255) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `artikel` text DEFAULT NULL,
  `date` date NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id_post`, `img`, `judul`, `artikel`, `date`, `kategori`, `id_kategori`, `author`) VALUES
(28, 'gmail-android-1.jpg', 'Google Memperkenalkan Opsi untuk Mengubah Alamat Gmail Anda', 'Google memperkenalkan fitur yang sangat dinantikan yang memungkinkan pengguna untuk mengubah alamat email @gmail.com mereka. Sebelumnya, fungsi ini tidak tersedia untuk pengguna Gmail, tidak seperti mereka yang menggunakan alamat email pihak ketiga. Fitur baru ini memungkinkan pengguna untuk mengganti nama pengguna Gmail mereka sambil tetap mempertahankan alamat lama mereka sebagai alias. Alias ​​ini tetap berfungsi untuk menerima email serta untuk masuk ke layanan Google.\r\n\r\nNamun, ada beberapa batasan untuk fleksibilitas baru ini. Pengguna dapat mengubah alamat Gmail mereka hingga tiga kali, sehingga totalnya menjadi empat alamat berbeda seiring waktu. Ada juga masa tunggu wajib selama 12 bulan antara setiap perubahan alamat email.\r\n\r\nPeluncuran fitur ini dilakukan secara bertahap, artinya tidak semua pengguna akan langsung memiliki akses. Menariknya, detail fungsi baru ini saat ini hanya tersedia di halaman dukungan Google berbahasa Hindi, dengan versi bahasa Inggris yang belum diperbarui.\r\n\r\nPenambahan ini menunjukkan upaya berkelanjutan Google untuk meningkatkan pengalaman pengguna dengan mengakomodasi kebutuhan akan fleksibilitas dalam mengelola identitas digital.', '2026-01-28', 'berita-teknologi', 1, 'Muhamad Shandy Rafliza Akbar'),
(29, 'ZUK7s6Os6.jpg', 'Mengapa W3Schools Menjadi Fondasi Perjalanan Coding Saya dan Mengapa Saya Meneruskannya', 'There are a lot of platforms that teach coding today.\r\nInteractive apps. Video courses. AI-assisted walkthroughs.\r\n\r\nBut long before any of that existed in its current form, there was W3Schools.\r\n\r\nFor me, W3Schools wasn’t just a reference site.\r\nIt was the starting line.\r\n\r\nThis was back when learning to code required patience. There were no accounts to track progress. No dashboards telling you where you left off. You learned by reading, experimenting, breaking things, and figuring out where you were the last time you stopped.\r\n\r\nYou didn’t rely on memory aids.\r\nYou relied on understanding.\r\n\r\nAnd that mattered.\r\n\r\nW3Schools taught coding from the very beginning not by assuming prior knowledge, but by walking you through how things actually work. HTML wasn’t abstract. CSS wasn’t magic. JavaScript wasn’t intimidating. Everything was broken down into simple, digestible pieces.\r\n\r\nYou could:\r\n\r\n- Read a concept\r\n- See the syntax\r\n- Modify the example\r\n- Watch the result change\r\n- That immediate feedback loop was powerful. It taught cause and effect. It taught experimentation. It taught confidence.\r\n\r\nWhat made W3Schools special (and still does) is that it doesn’t just show how to write code. It teaches why the code behaves the way it does.\r\n\r\nIt gives learners a mental model.\r\n\r\nAs the platform evolved, it didn’t abandon that philosophy. It expanded it.\r\n\r\nToday, W3Schools is far more robust and interactive than when I first used it:\r\n\r\n- Structured learning paths\r\n- In-browser code editors\r\n- Progress tracking with user accounts\r\n- Clear separation between frontend and backend concepts\r\n- Exposure to multiple languages in one place\r\n- That evolution is exactly why I’ve set up accounts for my kids.\r\n\r\nI want them to start where I started but with better tools.\r\n\r\nW3Schools lets them experiment safely. They can write code, break it, fix it, and understand what changed. There’s no pressure to “build something impressive.” The focus stays on fundamentals.\r\n\r\nAnd that’s the part too many people skip.\r\n\r\nW3Schools doesn’t pretend to replace deeper documentation or advanced frameworks. In fact, it does something better: it points you outward. It references where languages originated, how standards evolved, and where to go next when you’re ready to dig deeper.\r\n\r\nThat teaches an important lesson early:\r\n\r\nNo single site makes you an expert.\r\nBut a strong foundation lets you become one.\r\n\r\n- HTML leads to CSS.\r\n- CSS leads to layout systems.\r\n- JavaScript leads to logic.\r\n- Logic leads to backend thinking.\r\n- Backend thinking leads to systems.\r\n\r\nW3Schools makes those connections visible.\r\n\r\nIn an age where AI can generate code instantly, sites like W3Schools matter more not less. They teach you how to read code, reason through problems, and understand what tools are abstracting away.\r\n\r\nThat’s why it was instrumental in my career.\r\nThat’s why it’s still relevant.\r\nAnd that’s why I’m passing it on to my kids.\r\n\r\nStrong builders aren’t created by shortcuts.\r\nThey’re built on fundamentals.\r\n\r\nAnd for a lot of us, those fundamentals started right there.\r\n\r\n', '2026-01-28', 'internet-web', 8, 'Muhamad Shandy Rafliza Akbar'),
(30, 'cheat-gta-san-andreas-1769494208018_169.jpg', 'Daftar Cheat GTA San Andreas di HP Android, PS4, PS5, dan PC', 'Jakarta - Ketika bermain Grand Theft Auto (GTA) San Andreas, penggunaan cheat bisa menjadi salah satu cara hebat mengubah gameplay permainan. Pemain bisa bermain bebas sesuka hati dan bertindak lebih ekstrem tanpa takut konsekuensi yang diterima.\r\n\r\nContohnya, ketika kalian mencoba melakukan tindak kekerasan ke warga sipil, bertarung dengan geng di suatu wilayah, atau upaya melarikan diri dari kejaran polisi bintang lima akan menjadi lebih mudah. Hal itu mengingat, dengan mengaktifkan cheat, pemain bisa memiliki kemampuan tahan dari serangan, mendatangkan senjata-senjata kuat, menghadirkan kendaraan spektakuler, uang yang banyak, dan lain sebagainya.\r\n\r\nJadi kejaran polisi atau pertarungan antar geng tidak terasa sulit sama sekali. Namun, itu dilakukan hanya untuk seru-seruan saja ya.\r\n\r\nJika ingin merasakan sensasi sulit menyelesaikan suatu misi, atau tugas yang menantang, bermain tanpa cheat GTA San Andreas merupakan cara terbaik. Namun bila gamer penasaran dan ingin menjajalnya, mungkin bisa menyimak daftar cheat berikut, Selasa\r\n\r\nCheat GTA San Andreas Bahasa Indonesia di PC dan Android\r\nSenjata (Set 1) - LXGIWYL\r\nSenjata (Set 2) - PROFESSIONALSKIT\r\nSenjata (Set 3) - UZUMYMW\r\nParasut - AIYPWZQP\r\nNyawa Tak TerbAtas - CAINEMVHZC\r\nHitman Level di Semua Senjata - PROFESSIONALKILLER\r\nAmunisi tak terbAtas - FULLCLIP\r\nKurus - KVGYZQK\r\nGendut - BTCDBCB\r\nArmor, Darah, dan Uang - HESOYAM\r\nJetpack - ROCKETMAN\r\nPesawat Tempur - JUMPJET\r\nHelikopter Militer - OHDUDE\r\nRhino Tank - AIWPRTON\r\nMobil Limosin - KRIJEBR\r\nMobil Tanker - AMOMHRER\r\nMobil Sampah - TRUEGRIME\r\nMobil Amfibi - KGGGDKP\r\nMobil Bloodring - CQZIJMB\r\nMobil Golf - RZHSUEW\r\nMobil Dozer - EEGCYXT\r\nMobil Monster - AGBDLCID\r\nMobil ATV - AKJJYGLC\r\nMobil Kebal - JCNRUAD\r\nMobil Meledak Semua - CPKTNWT\r\nPerahu Terbang - FLYINGFISH\r\nMobil Terbang - RIPAZHA\r\nPejalan Kaki Bentrok - AJLOJYQY\r\nPejalan Kaki Bersenjata - FOOOXFT\r\nPejalan Kaki Menyerang dengan Senjata - BGLUAWML\r\nYakuza Ninja - NINJATOWN\r\nGang dan Buruh - ONLYHOMIESALLOWED\r\nAnti Polisi - AEZAKMI\r\nWanted Level 6 Bintang - LJSPQK\r\nWanted Level Bertambah 2 Bintang - OSRBLHH\r\nWanted Level Berkurang - ASNAEB\r\nMobil Romero - AQTBCODX\r\nPesawat Capung - URKQSRK\r\nMobil Racecar - VROCKPOKEY\r\nMobil Racecar 2 - VPJTQWV\r\nMobil Rancher - JQNTDMH\r\nGang di Kota - BIFBUZZ\r\nKekacauan Kota - STATEOFEMERGENCY\r\nElvis - BLUESUEDESHOES\r\nLompatan Tinggi - KANGAROO\r\nNafas dalam Air Tanpa BAtas - CVWKXAM\r\nKontrol Senjata Manual di Mobil - OUIQDMW\r\nPukulan Super - STINGLIKEABEE\r\nTidak pernah Lapar - AEDUWNV\r\nRespek Maksimum - WORSHIPME\r\nBadan Berotot - BUFFMEUP\r\nGerak Cepat - SPEEDITUP\r\nGerak Lambat - SLOWITDOWN\r\nWaktu Berjalan Cepat - YSOHNUL\r\nEfek Adrenalin - ANOSEONGLASS\r\nSelalu Tengah Malam - NIGHTPROWLER\r\nSelalu Jam 9 Malam - OFVIAC\r\nRekrut dengan 9mm - SJMAHPE\r\nRekrut dengan Roket - ROCKETMAYHEM\r\nBadai Petir - CWJXUOC\r\nBadai - SCOTTISHSUMMER\r\nLalu Lintas Beater - BGKGTJH\r\nLalu Lintas Sepi - GHOSTTOWN\r\nLalu Lintas Mobil Desa - EVERYONEISPOOR\r\nLalu Lintas Mobil Sport - EVERYONEISRICH\r\nBunuh Diri - SZCMAWO\r\nNOS - SPEEDFREAK\r\nMobil Melayang ketika ditabrak - BUBBLECARS\r\nMobil Transparan - WHEELSONLYPLEASE\r\nMobil Hitam - IOWDLAC\r\nMobil Pink - LLQPFBN\r\nLampu Lalu Lintas Hijau - ZEIIVG\r\nLalu Lintas Agresif - YLTEICZ\r\nDesa - BMTPWHR\r\nPejalan Kaki Bentrok - AJLOJYQY\r\nPejalan Kaki Bersenjata - FOOOXFT\r\nPejalan Kaki Menyerang dengan Senjata - BGLUAWML\r\nYakuza Ninja - NINJATOWN\r\nGang dan Buruh - ONLYHOMIESALLOWED\r\nAnti Polisi - AEZAKMI\r\nWanted Level 6 Bintang - LJSPQK\r\nWanted Level Bertambah 2 Bintang - OSRBLHH\r\nWanted Level Berkurang - ASNAEB\r\nLompatan BMX yang Tinggi - JHJOECW\r\nKeahlian Menyetir Natural - NATURALTALENT\r\nKeahlian Menyetir Maksimal - STICKLIKEGLUE\r\nHujan - AUIFRVQS\r\nBerkabut - CFVFGMJ\r\nMendung - ALNSFMZO\r\nTerik - TOODAMNHOT\r\nCerah - PLEASANTLYWARM\r\nKarnaval - CRAZYTOWN\r\nKinky - BEKKNQV\r\n\r\nCheat GTA San Andreas Bahasa Indonesia di PS4 dan PS5\r\nKesehatan, Baju Zirah, dan Uang (USD 250 ribu) - R1, R2, L1, X, Kiri, Bawah, Kanan, Atas, Kiri, Bawah, Kanan, Atas\r\nAmunisi Tak TerbAtas - L1, R1, Kotak, R1, Kiri, R2, R1, Kiri, Kotak, Bawah, L1, L1\r\nKesehatan (Hampir) Tak TerbAtas - Bawah, X, Kanan, Kiri, Kanan, R1, Kanan, Bawah, Atas, Segitiga\r\nLevel Maksimum yang Diinginkan - Lingkaran, Kanan, Lingkaran, Kanan, Kiri, Kotak, X, Bawah\r\nKerusuhan Pejalan Kaki - Bawah, Kiri, Atas, Kiri, X, R2, R1, L2, L\r\nMode Kekacauan - L2, Kanan, L1, Segitiga, Kanan, Kanan, R1, L1, Kanan, L1, L1, L\r\nHadiah Atas Kepalamu - Bawah, Atas, Atas, Atas, X, R2, R1, L2, L\r\nPenyerangan Pejalan Kaki (Dengan Senjata) X, L1, Atas, Kotak, Bawah, X, L2, Segitiga, Bawah, R1, L1, L1\r\nPejalan Kaki Memiliki Senjata R2, R1, X, Segitiga, X, Segitiga, Atas, Bawah\r\nSemua Pejalan Kaki Adalah Elvis - L1, Lingkaran, Segitiga, L1, L1, Kotak, L2, Atas, Bawah, Kiri\r\nMode Pesta Pantai - Atas, Atas, Bawah, Bawah, Kotak, Lingkaran, L1, R1, Segitiga, Bawah\r\nTema Rumah Hiburan - Segitiga, Segitiga, L1, Kotak, Kotak, Lingkaran, Kotak, Bawah, Lingkaran\r\nTema Pedesaan - L1, L1, R1, R1, L2, L1, R2, Bawah, Kiri, Atas\r\nLompatan Mega - Atas, Atas, Segitiga, Segitiga, Atas, Atas, Kiri, Kanan, Kotak, R2, R2\r\nPukulan Super - Atas, Kiri, X, Segitiga, R1, Kotak, Kotak, Kotak, L2\r\nTank Badak - Lingkaran, Lingkaran, L1, Lingkaran, Lingkaran, Lingkaran, L1, L2, R1, Segitiga, Lingkaran, Segitiga\r\nMunculkan Jetpack - L1, L2, R1, R2, Atas, Bawah, Kiri, Kanan, L1, L2, R1, R2, Atas, Bawah, Kiri, Kanan\r\nMenelurkan Hydra - Segitiga, Segitiga, Kotak, Lingkaran, X, L1, L1, Bawah, Atas\r\nMunculkan Pesawat Akrobat - Lingkaran, Atas, L1, L2, Bawah, R1, L1, L1, Kiri, Kiri, X, Segitiga\r\nMunculkan Bloodring Banger - Bawah, R1, Lingkaran, L2, L2, X, R1, L1, Kiri, Kiri\r\nParasut - Kiri, Kanan, L1, L2, R1, R2, R2, Atas, Bawah, Kanan, L1\r\nOtot Maksimal - Segitiga, Atas, Atas, Kiri, Kanan, Kotak, Lingkaran, Kiri\r\nLemak Maksimal - Segitiga, Atas, Atas, Kiri, Kanan, Kotak, Lingkaran, Bawah\r\nMinimal Otot dan Lemak - Segitiga, Atas, Atas, Kiri, Kanan, Kotak, Lingkaran, Kanan\r\nKapasitas Paru-Paru Tak TerbAtas - Bawah, Kiri, L1, Bawah, Bawah, R2, Bawah, L2, Bawah\r\nJangan Pernah Lapar - Kotak, L2, RB, Segitiga, Atas, Kotak, L2, Atas, X\r\nLevel Hitman untuk Semua Senjata - Bawah, Kotak, X, Kiri, R1, R2, Kiri, Bawah, Bawah, L1, L1, L1\r\nMode Anggota Geng - Kiri, Kanan, Kanan, Kanan, Kiri, X, Bawah, Atas, Kotak, Kanan, Bawah\r\nKontrol Geng - L2, Atas, R1, R1, Kiri, R1, R1, R2, Kanan, Bawah\r\nRekrut Siapa Saja (Pistol) - Bawah, Kotak, Atas, R2, R2, Atas, Kanan, Kanan, Atas\r\nRekrut Siapa Saja (Peluncur Roket) - R2, R2, R2, X, L2, L1, R1, L2, Bawah, X\r\nSelalu Tengah Malam - Kotak, L1, R1, Kanan, X, Atas, L1, Kiri, Kiri\r\nSelalu 21:00 - Kiri, Kiri, L2, R1, Kanan, Kotak, Kotak, L1, L2, X\r\nGerak Lambat - Segitiga, Atas, Kanan, Bawah, Kotak, R2, R1\r\nGerak Cepat - Segitiga, Atas, Kanan, Bawah, L2, L1, Kotak\r\nJam Lebih Cepat - Lingkaran, Lingkaran, L1, Kotak, L1, Kotak, Kotak, Kotak, L1, Segitiga, Lingkaran, Segitiga\r\nCuaca mendung - L2, Bawah, Bawah, Kiri, Kotak, Kiri, R2, Kotak, X, R1, L1, L1\r\nCuaca Berkabut - R2, L1, L1, L2, L2, L2, L2, L1 ...\r\nCuaca Badai - R2, X, L1, L1, L2, L2, L2, Lingkaran\r\nCuaca cerah - R2, X, L1, L1, L2, L2, L2, Kotak\r\nCuaca Sangat Cerah - R2, X, L1, L1, L2, L2, L2, Bawah\r\nBadai pasir - Atas, Bawah, L1, L1, L2, L2, L1, L2, R1, R2\r\nBebas Membidik Saat Mengemudi - Atas, Atas, Kotak, L2, Kanan, X, R1, Bawah, R2, Lingkaran\r\nMeledakkan Semua Mobil - R2, L2, R1, L1, L2, R2, Kotak, Segitiga, Lingkaran, Segitiga, L2, L1\r\nLampu Lalu Lintas Tetap Hijau - Kanan, R1, Atas, L2, L2, Kiri, R1, L1, R1, R1\r\nLalu Lintas Agresif - R2, Lingkaran, R1, L2, Kiri, R1, L1, R2, L2\r\nMeningkatkan Kecepatan Mobil - Kanan, R1, Atas, L2, L2, Kiri, R1, L1, R1, R1\r\nSemua Mobil Memiliki Nitrous - Kiri, Segitiga, R1, L1, Atas, Kotak, Segitiga, Bawah, Lingkaran, L2, L1, L1\r\nMobil Tak Terlihat - Segitiga, L1, Segitiga, R2, Kotak, L1, L1\r\nMobil Bulan Gravitasi - Kotak, R2, Bawah, Bawah, Kiri, Bawah, Kiri, Kiri L2, X\r\nLalu Lintas Berkurang - X, Bawah, Atas, R2, Bawah, Segitiga, L1, Segitiga, Kiri\r\nMobil Merah Muda - Lingkaran, L1, Bawah, L2, Kiri, X, R1, L1, Kanan, Lingkaran\r\nMobil Hitam - Lingkaran, L2, Atas, R1, Kiri, X, R1, L1, Kiri, Lingkaran\r\nMobil Sport - Atas, L1, R1, Atas, Kanan, Atas, X, L2, X, L1\r\nMobil Rongsokan - L2, Kanan, L1, Atas, X, L1, L2, R2, R1, L1, L1, L1\r\nMobil Terbang - Kotak, Bawah, L2, Atas, L1, Lingkaran, Atas, X, Kiri\r\nPerahu Terbang - R2, Lingkaran, Atas, L1, Kanan, R1, Kanan, Atas, Kotak, Segitiga\r\nBerkendara di Atas Air - Kanan, R2, Lingkaran, R1, L2, Kotak, R1, R2\r\nLompatan Kelinci Super - Segitiga, Kotak, Lingkaran, Lingkaran, Kotak, Lingkaran, Lingkaran, L1, L2, L2, R1, R2\r\nSenjata 1 (Pemukul, Pistol, Senapan, Mini SMG, AK 47, Peluncur Roket, Koktail Molotov, Kaleng Semprot, Brass Knuckles) - R1, R2, L1, R2, Kiri, Bawah, Kanan, Atas, Kiri, Bawah, Kanan, Atas\r\nSenjata 2 (Pisau, Pistol, Senapan Gergaji, Tec 9, Senapan Runduk, Penyembur Api, Granat, Alat Pemadam Kebakaran) - R1, R2, L1, R2, Kiri, Bawah, Kanan, Atas, Kiri, Bawah, Bawah, Kiri\r\nSenjata 3 (Gergaji mesin, Pistol berperedam, Senapan tempur, M4, Bazooka, Peledak plastik) - R1, R2, L1, R2, Kiri, Bawah, Kanan, Atas, Kiri, Bawah, Bawah, Bawah\r\n', '2026-01-28', 'teknologi-game', 9, 'Muhamad Shandy Rafliza Akbar'),
(31, 'ilustrasi-media-sosial-1755140697765_169.jpg', 'Duh, Meta Dituduh Bisa Baca Isi Pesan WhatsApp', 'Sekelompok penggugat dari beberapa negara menggugat Meta dengan tuduhan bahwa mereka bisa membaca pesan pengguna WhatsApp. Meta menyebut gugatan tersebut tidak masuk akal.\r\nDalam gugatan yang dilayangkan di Pengadilan Distrik San Francisco, kelompok penggugat menuding Meta dan WhatsApp menyimpan, menganalisis, dan dapat mengakses semua pesan pribadi pengguna WhatsApp. Mereka juga menuduh Meta dan pemimpinnya telah menipu miliaran pengguna WhatsApp di seluruh dunia.\r\n\r\nSebagai bukti, gugatan tersebut mengutip \"whistleblower berani\" yang menuding karyawan WhatsApp dan Meta dapat meminta untuk melihat pesan pengguna lewat cara sederhana. Namun gugatan itu tidak memberikan informasi teknis untuk mendukung argumennya.\r\n\r\nEnkripsi end-to-end sudah lama menjadi fitur unggulan WhatsApp, yang artinya baik WhatsApp maupun Meta tidak bisa melihat isi pesan pengguna. Juru bicara Meta mengatakan gugatan itu tidak berdasar dan mereka akan mengambil tindakan tegas terhadap pengacara penggugat.\r\n\r\n\"Segala klaim bahwa pesan WhatsApp milik banyak orang tidak dienkripsi adalah sepenuhnya salah dan tidak masuk akal,\" kata juru bicara Meta, seperti dikutip dari PCMag, Selasa (27/1/2026).\r\n\r\n\"(Pesan) WhatsApp sudah dienkripsi end-to-end menggunakan protokol Signal selama satu dekade. Gugatan ini adalah karya fiksi yang tidak berdasar dan kami akan mengambil tindakan terhadap pengacara penggugat,\" sambungnya.\r\n\r\nGugatan ini turut dikomentari oleh bos teknologi lainnya, termasuk CEO Telegram Pavel Durov dan bos X Elon Musk. Dalam postingannya di X, Musk menyebut WhatsApp tidak aman sambil mempromosikan fitur X Chat. Tidak lama setelahnya, Head of WhatsApp Will Cathcart menegaskan klaim gugatan itu tidak benar.\r\n\r\n\"Ini sepenuhnya salah. WhatsApp tidak bisa membaca pesan karena kunci enkripsi disimpan di ponsel Anda dan kami tidak dapat mengaksesnya,\" tulis Cathcart dalam balasannya kepada Musk.\r\n\r\n\"Ini adalah gugatan tidak berdasar yang hanya bertujuan untuk mencari perhatian media, yang diajukan perusahaan yang sama yang membela NSO setelah spyware mereka menyerang jurnalis dan pejabat pemerintah,\" sambungnya.', '2026-01-28', 'berita-teknologi', 1, 'Muhamad Shandy Rafliza Akbar'),
(32, '412b1f0e-1351-4f12-b50c-af1ce5c6e4cd_169 (1).jpg', 'Bos Telegram: \"Bodoh\" Jika Percaya WhatsApp Aman di 2026', 'Persaingan antar-aplikasi pesan instan kembali memanas di awal tahun 2026. Pendiri sekaligus CEO Telegram, Pavel Durov, baru-baru ini melontarkan kritik pedas yang ditujukan langsung kepada WhatsApp.\r\nMelalui unggahan terbarunya di platform X, Durov secara terang-terangan menyebut sistem keamanan aplikasi milik Meta tersebut penuh lubang. Bahkan, dia menggunakan istilah yang cukup kasar untuk memperingatkan publik.\r\n\r\nDurov mengklaim bahwa siapa pun yang masih percaya bahwa WhatsApp aman untuk digunakan pada tahun 2026 adalah orang yang \"braindead\" atau bodoh.\r\n\r\nKomentar tajam Durov bukan tanpa alasan. Ia menyatakan bahwa tim pengembang Telegram telah melakukan analisis mendalam terhadap sistem enkripsi WhatsApp dan menemukan temuan yang mengkhawatirkan.\r\n\r\nMenurut Durov, timnya berhasil mengidentifikasi \"multiple attack vectors\" atau berbagai jalur serangan potensial yang bisa dieksploitasi oleh pihak ketiga. Ia menuding bahwa klaim keamanan WhatsApp selama ini hanyalah tameng pemasaran semata.\r\n\r\n\"Tim kami secara independen menemukan celah keamanan yang memungkinkan penyerang masuk. Masih percaya WhatsApp aman di 2026? Itu bodoh,\" tulis Durov.\r\n\r\nPernyataan Durov ini muncul di tengah badai hukum yang menerjang Meta. Pekan lalu, sebuah gugatan hukum internasional diajukan di Pengadilan Distrik AS di San Francisco. Gugatan tersebut menuduh Meta telah menyesatkan miliaran penggunanya.\r\n\r\nMeskipun WhatsApp mengklaim menggunakan enkripsi end-to-end (E2EE), para penggugat mengeklaim bahwa:\r\n\r\n- WhatsApp tetap mampu menyimpan dan menganalisis pesan pengguna.\r\n- Data tersebut berpotensi besar diakses oleh instansi pemerintah maupun penipu siber.\r\n- Pernyataan privasi Meta dianggap sebagai pernyataan palsu yang merugikan konsumen.\r\n\r\nMenanggapi hal tersebut, juru bicara WhatsApp kepada Bloomberg membantah keras. \"Klaim bahwa pesan WhatsApp tidak terenkripsi adalah salah dan absurd secara kategoris. Gugatan ini hanyalah karya fiksi,\" tegasnya.\r\n\r\nTerlepas dari perseteruan kedua bos tersebut, pengguna WhatsApp memang tengah diincar oleh skema penipuan baru yang muncul pada Januari 2026. Penipu mengirimkan pesan berisi tautan berbahaya ke situs web palsu.\r\n\r\nBegitu pengguna mengklik tautan tersebut, penyerang dapat memperoleh akses penuh ke akun korban tanpa terdeteksi dalam waktu yang lama. Hal ini menambah daftar kekhawatiran atas kerentanan platform tersebut.\r\n\r\nTelegram Tak Lepas Kritik\r\nMeski vokal menyerang WhatsApp, rekam jejak keamanan Telegram sendiri sebenarnya tidak bersih dari cacat. Dalam beberapa tahun terakhir, sejumlah peneliti menemukan berbagai kelemahan pada platform tersebut, mulai dari bug yang memungkinkan pengambilalihan pesan hingga kerentanan pada protokol enkripsi.\r\n\r\nInvestigasi juga pernah mengungkap bahwa Telegram hanya menyediakan enkripsi end-to-end secara penuh pada fitur obrolan rahasia, bukan pada percakapan standar.\r\n\r\nKontroversi ini dimanfaatkan pihak lain untuk mempromosikan layanan pesaing. Pemilik X, Elon Musk, ikut meramaikan perdebatan dengan mempromosikan XChat sebagai alternatif WhatsApp.\r\n\r\nNamun, klaim keunggulan keamanan XChat segera dipatahkan oleh catatan komunitas pengguna X yang menyoroti sejumlah potensi kelemahan serius pada layanan tersebut.\r\n\r\nPersaingan antarplatform pesan instan pun kian memanas. Di tengah saling serang klaim keamanan antara WhatsApp, Telegram, dan pemain baru, para pakar menilai pengguna perlu lebih kritis menilai janji privasi yang disampaikan perusahaan teknologi, demikian dilansir dari Protos.', '2026-01-28', 'berita-teknologi', 1, 'Muhamad Shandy Rafliza Akbar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(255) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_lvuser` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `username`, `password`, `nama_pengguna`, `img`, `id_lvuser`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dodit Mulyantoro', 'avatar5.png', 1),
(34, 'shandy', '92ae645d4f8da8cf9eea36d52b4b4d1e', 'Muhamad Shandy Rafliza Akbar', 'image.png', 1),
(35, 'akucok', '92ae645d4f8da8cf9eea36d52b4b4d1e', 'akucok', 'avatar2.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`id_img`);

--
-- Indexes for table `tbl_lvuser`
--
ALTER TABLE `tbl_lvuser`
  ADD PRIMARY KEY (`id_lvuser`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `tbl_users_ibfk_1` (`id_lvuser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_lvuser`
--
ALTER TABLE `tbl_lvuser`
  MODIFY `id_lvuser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id_post` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `tbl_comments_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `tbl_posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD CONSTRAINT `tbl_posts_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_categories` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`id_lvuser`) REFERENCES `tbl_lvuser` (`id_lvuser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
