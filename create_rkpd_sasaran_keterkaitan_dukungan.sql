-- ==============================================================================
-- DDL TABLE DATABASE UNTUK FITUR RKPD:
-- 1. Sasaran Pembangunan Daerah (4 Tabel Relasional)
-- 2. Keterkaitan Indikator Pembangunan Daerah (1 Tabel)
-- 3. Dukungan Prioritas Pembangunan (1 Tabel)
-- ==============================================================================

-- ------------------------------------------------------------------------------
-- 1. FITUR: SASARAN PEMBANGUNAN DAERAH
-- ------------------------------------------------------------------------------

-- Tabel 1.1: Prioritas Pembangunan Daerah (Tingkat Utama)
CREATE TABLE IF NOT EXISTS `rkpd_sasaran_prioritas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` VARCHAR(50) NOT NULL,
  `tahun` VARCHAR(10) NOT NULL,
  `id_prioritas_daerah` INT(11) NOT NULL,
  `prioritas_pembangunan` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wilayah_tahun` (`kode_wilayah`, `tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel 1.2: Isu Strategis Daerah (Relasi ke rkpd_sasaran_prioritas)
CREATE TABLE IF NOT EXISTS `rkpd_sasaran_isu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `prioritas_id` INT(11) NOT NULL,
  `isu_strategis` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_prioritas` (`prioritas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel 1.3: Sasaran Pembangunan Daerah (Relasi ke rkpd_sasaran_isu)
CREATE TABLE IF NOT EXISTS `rkpd_sasaran_daerah` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `isu_id` INT(11) NOT NULL,
  `sasaran` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_isu` (`isu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel 1.4: Indikator Sasaran Pembangunan Daerah (Relasi ke rkpd_sasaran_daerah)
CREATE TABLE IF NOT EXISTS `rkpd_sasaran_indikator` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `sasaran_id` INT(11) NOT NULL,
  `indikator` TEXT NOT NULL,
  `satuan` VARCHAR(100) DEFAULT NULL,
  `realisasi` VARCHAR(100) DEFAULT NULL,
  `target_1` VARCHAR(100) DEFAULT NULL,
  `target_2` VARCHAR(100) DEFAULT NULL,
  `target_3` VARCHAR(100) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sasaran` (`sasaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ------------------------------------------------------------------------------
-- 2. FITUR: KETERKAITAN INDIKATOR PEMBANGUNAN DAERAH
-- ------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `rkpd_keterkaitan_indikator` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` VARCHAR(20) NOT NULL,
  `tahun` VARCHAR(10) NOT NULL,
  `id_pn` INT(11) NOT NULL,
  `kode_pn` VARCHAR(20) DEFAULT NULL,
  `nama_pn` TEXT NOT NULL,
  `id_sasaran_nasional` INT(11) DEFAULT NULL,
  `kode_sasaran_nasional` VARCHAR(20) DEFAULT NULL,
  `sasaran_nasional` TEXT NOT NULL,
  `indikator_nasional` TEXT DEFAULT NULL,
  `p_daerah_json` TEXT DEFAULT NULL,
  `id_sasaran_daerah` INT(11) DEFAULT NULL,
  `kode_sasaran_daerah` VARCHAR(20) DEFAULT NULL,
  `sasaran_daerah` TEXT NOT NULL,
  `indikator_daerah_json` TEXT DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wilayah_tahun` (`kode_wilayah`, `tahun`),
  KEY `idx_id_pn` (`id_pn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ------------------------------------------------------------------------------
-- 3. FITUR: DUKUNGAN PRIORITAS PEMBANGUNAN
-- ------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `rkpd_dukungan_prioritas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` VARCHAR(50) NOT NULL,
  `tahun` VARCHAR(10) NOT NULL,
  `id_pn` INT(11) NOT NULL,
  `kode_pn` VARCHAR(50) DEFAULT NULL,
  `nama_pn` TEXT DEFAULT NULL,
  `nomor_ppn` VARCHAR(50) DEFAULT NULL,
  `id_program_nasional` INT(11) DEFAULT NULL,
  `program_nasional` TEXT NOT NULL,
  `kegiatan_nasional_json` LONGTEXT DEFAULT NULL,
  `id_prioritas_daerah` INT(11) DEFAULT NULL,
  `kode_prioritas_daerah` VARCHAR(50) DEFAULT NULL,
  `prioritas_daerah` TEXT NOT NULL,
  `program_prioritas_daerah` TEXT NOT NULL,
  `dukungan_program_json` LONGTEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wilayah_tahun` (`kode_wilayah`, `tahun`),
  KEY `idx_pn` (`id_pn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
