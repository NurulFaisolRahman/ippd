-- --------------------------------------------------------
-- Struktur Tabel Berjenjang Program dan Kegiatan Prioritas RKPD
-- Hierarki: Prioritas Daerah -> Arah Kebijakan -> Program -> Kegiatan -> Subkegiatan & Pagu & OPD
-- --------------------------------------------------------

-- 1. Arah Kebijakan (1 Prioritas Daerah bisa beberapa Arah Kebijakan)
CREATE TABLE IF NOT EXISTS `rkpd_arah_kebijakan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` VARCHAR(50) NOT NULL,
  `tahun` VARCHAR(10) NOT NULL,
  `id_prioritas_daerah` INT(11) NOT NULL,
  `prioritas_pembangunan` TEXT DEFAULT NULL,
  `arah_kebijakan` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wilayah_tahun` (`kode_wilayah`, `tahun`),
  KEY `idx_prioritas` (`id_prioritas_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Program Prioritas (1 Arah Kebijakan bisa beberapa Program)
CREATE TABLE IF NOT EXISTS `rkpd_program_prioritas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `arah_id` INT(11) NOT NULL,
  `kode_program` VARCHAR(100) NOT NULL,
  `nama_program` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_arah` (`arah_id`),
  KEY `idx_program` (`kode_program`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Kegiatan Prioritas (1 Program bisa beberapa Kegiatan)
CREATE TABLE IF NOT EXISTS `rkpd_kegiatan_prioritas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `program_id` INT(11) NOT NULL,
  `kode_kegiatan` VARCHAR(100) NOT NULL,
  `nama_kegiatan` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_program` (`program_id`),
  KEY `idx_kegiatan` (`kode_kegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Subkegiatan Prioritas (1 Kegiatan bisa beberapa Subkegiatan, Pagu, dan OPD)
CREATE TABLE IF NOT EXISTS `rkpd_subkegiatan_prioritas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kegiatan_id` INT(11) NOT NULL,
  `kode_subkegiatan` VARCHAR(100) NOT NULL,
  `nama_subkegiatan` TEXT NOT NULL,
  `pagu` DECIMAL(20,2) DEFAULT 0.00,
  `id_instansi` TEXT DEFAULT NULL,
  `nama_instansi` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kegiatan` (`kegiatan_id`),
  KEY `idx_subkegiatan` (`kode_subkegiatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
