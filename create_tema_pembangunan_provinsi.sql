-- Table: tema_pembangunan_provinsi
-- Untuk mengakomodir Tema Pembangunan tingkat Provinsi (tanpa kolom tema_daerah)
CREATE TABLE IF NOT EXISTS `tema_pembangunan_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` varchar(10) NOT NULL,
  `tema_nasional` varchar(255) DEFAULT NULL,
  `tema_rkp_id` int(11) DEFAULT NULL,
  `tema_provinsi` text DEFAULT NULL,
  `tahun` year(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kode_wilayah` (`kode_wilayah`),
  KEY `idx_tahun` (`tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: prioritas_pembangunan_provinsi
-- Untuk prioritas tingkat Provinsi (nasional dan provinsi)
CREATE TABLE IF NOT EXISTS `prioritas_pembangunan_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema_id` int(11) NOT NULL,
  `kode_wilayah` varchar(10) NOT NULL,
  `jenis` enum('nasional','provinsi') NOT NULL,
  `prioritas` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tema_id` (`tema_id`),
  KEY `idx_kode_wilayah` (`kode_wilayah`),
  KEY `idx_jenis` (`jenis`),
  CONSTRAINT `fk_prioritas_prov_tema` FOREIGN KEY (`tema_id`) REFERENCES `tema_pembangunan_provinsi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
