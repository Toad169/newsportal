-- Migration file for adding dynamic categories and comments functionality
-- Run this SQL file to update your database

-- --------------------------------------------------------
-- Table structure for table `tbl_categories`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default categories
INSERT INTO `tbl_categories` (`id_kategori`, `nama_kategori`, `slug`, `deskripsi`) VALUES
(1, 'Berita', 'berita', 'Kategori untuk berita umum'),
(2, 'Info Umum', 'info-umum', 'Kategori untuk informasi umum'),
(3, 'Kontak', 'kontak', 'Kategori untuk kontak');

-- --------------------------------------------------------
-- Table structure for table `tbl_comments`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `status` enum('pending','approved','spam') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `tbl_comments_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `tbl_posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Update tbl_posts to add foreign key for categories
-- --------------------------------------------------------

-- First, add a new column for category foreign key (keeping old kategori column for migration)
ALTER TABLE `tbl_posts` 
ADD COLUMN `id_kategori` int(11) DEFAULT NULL AFTER `kategori`,
ADD KEY `id_kategori` (`id_kategori`);

-- Migrate existing category data to new structure
UPDATE `tbl_posts` SET `id_kategori` = 1 WHERE `kategori` = 'berita';
UPDATE `tbl_posts` SET `id_kategori` = 2 WHERE `kategori` = 'Info-umum';
UPDATE `tbl_posts` SET `id_kategori` = 3 WHERE `kategori` = 'kontak' OR `kategori` = 'Kontak';

-- Add foreign key constraint
ALTER TABLE `tbl_posts`
ADD CONSTRAINT `tbl_posts_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_categories` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE;
