-- ==============================================================================
-- SKRIP UPDATE DATABASE HOSTING - E-LKPJ BAB 3.4 (IKU & IKD)
-- Aplikasi: IPPD / E-LKPJ
-- ==============================================================================
-- Petunjuk Import di Hosting:
-- 1. Buka cPanel / Panel Hosting Anda, lalu masuk ke phpMyAdmin.
-- 2. Pilih nama database aplikasi IPPD yang aktif di hosting.
-- 3. Klik tab "SQL" atau klik tab "Import" lalu pilih file ini.
-- 4. Klik tombol "Kirim" / "Go" / "Execute".
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------------------------
-- 1. UPDATE TABEL MASTER IKD (`ikd`)
-- Menambahkan kolom `urutan` dan `id_instansi` untuk tagging dinas & urutan data
-- ------------------------------------------------------------------------------
SET @col_urutan = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ikd' AND COLUMN_NAME = 'urutan');
SET @sql_urutan = IF(@col_urutan = 0, 'ALTER TABLE `ikd` ADD COLUMN `urutan` INT(11) DEFAULT 1', 'SELECT "Column urutan already exists"');
PREPARE stmt_urutan FROM @sql_urutan;
EXECUTE stmt_urutan;
DEALLOCATE PREPARE stmt_urutan;

SET @col_id_instansi = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ikd' AND COLUMN_NAME = 'id_instansi');
SET @sql_id_instansi = IF(@col_id_instansi = 0, 'ALTER TABLE `ikd` ADD COLUMN `id_instansi` INT(11) NULL DEFAULT NULL AFTER `pd_penanggung_jawab`, ADD INDEX `idx_ikd_instansi` (`id_instansi`)', 'SELECT "Column id_instansi already exists"');
PREPARE stmt_id_instansi FROM @sql_id_instansi;
EXECUTE stmt_id_instansi;
DEALLOCATE PREPARE stmt_id_instansi;


-- ------------------------------------------------------------------------------
-- 2. TABEL CAPAIAN IKD (`lkpj_bab3_ikd_capaian`) - BAB 3.4 BAGIAN B
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lkpj_bab3_ikd_capaian` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `kodewilayah` VARCHAR(13) NOT NULL,
    `tahun` INT(4) NOT NULL,
    `ikd_id` INT(11) DEFAULT NULL,
    `id_instansi` INT(11) DEFAULT NULL,
    `pd_penanggung_jawab` TEXT DEFAULT NULL,
    `aspek` VARCHAR(50) NOT NULL DEFAULT 'dayasaing',
    `indikator_ikd` TEXT NOT NULL,
    `satuan` VARCHAR(50) DEFAULT NULL,
    `target` VARCHAR(50) DEFAULT NULL,
    `realisasi` VARCHAR(50) DEFAULT NULL,
    `capaian` VARCHAR(50) DEFAULT NULL,
    `urutan` INT(11) DEFAULT 1,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_ikd_capaian_wil_thn` (`kodewilayah`, `tahun`),
    KEY `idx_ikd_capaian_aspek` (`aspek`),
    KEY `idx_ikd_capaian_ref` (`ikd_id`),
    KEY `idx_ikd_capaian_instansi` (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pastikan kolom id_instansi & pd_penanggung_jawab tersedia jika tabel sudah ada sebelumnya
SET @cap_instansi = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'lkpj_bab3_ikd_capaian' AND COLUMN_NAME = 'id_instansi');
SET @sql_cap_instansi = IF(@cap_instansi = 0, 'ALTER TABLE `lkpj_bab3_ikd_capaian` ADD COLUMN `id_instansi` INT(11) NULL DEFAULT NULL AFTER `ikd_id`, ADD INDEX `idx_ikd_capaian_instansi` (`id_instansi`)', 'SELECT "id_instansi exists in lkpj_bab3_ikd_capaian"');
PREPARE stmt_cap_instansi FROM @sql_cap_instansi;
EXECUTE stmt_cap_instansi;
DEALLOCATE PREPARE stmt_cap_instansi;

SET @cap_pd = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'lkpj_bab3_ikd_capaian' AND COLUMN_NAME = 'pd_penanggung_jawab');
SET @sql_cap_pd = IF(@cap_pd = 0, 'ALTER TABLE `lkpj_bab3_ikd_capaian` ADD COLUMN `pd_penanggung_jawab` TEXT NULL DEFAULT NULL AFTER `id_instansi`', 'SELECT "pd_penanggung_jawab exists in lkpj_bab3_ikd_capaian"');
PREPARE stmt_cap_pd FROM @sql_cap_pd;
EXECUTE stmt_cap_pd;
DEALLOCATE PREPARE stmt_cap_pd;


-- ------------------------------------------------------------------------------
-- 3. TABEL PERKEMBANGAN IKD (`lkpj_bab3_ikd_perkembangan`) - BAB 3.4 BAGIAN B
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lkpj_bab3_ikd_perkembangan` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `kodewilayah` VARCHAR(13) NOT NULL,
    `tahun` INT(4) NOT NULL,
    `ikd_id` INT(11) DEFAULT NULL,
    `id_instansi` INT(11) DEFAULT NULL,
    `pd_penanggung_jawab` TEXT DEFAULT NULL,
    `aspek` VARCHAR(50) NOT NULL DEFAULT 'dayasaing',
    `uraian_indikator` TEXT NOT NULL,
    `satuan` VARCHAR(50) DEFAULT NULL,
    `nilai_2021` VARCHAR(50) DEFAULT NULL,
    `nilai_2022` VARCHAR(50) DEFAULT NULL,
    `nilai_2023` VARCHAR(50) DEFAULT NULL,
    `nilai_2024` VARCHAR(50) DEFAULT NULL,
    `nilai_2025` VARCHAR(50) DEFAULT NULL,
    `narasi` LONGTEXT DEFAULT NULL,
    `urutan` INT(11) DEFAULT 1,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_ikd_perk_wil_thn` (`kodewilayah`, `tahun`),
    KEY `idx_ikd_perk_aspek` (`aspek`),
    KEY `idx_ikd_perk_ref` (`ikd_id`),
    KEY `idx_ikd_perk_instansi` (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pastikan kolom id_instansi & pd_penanggung_jawab tersedia jika tabel sudah ada sebelumnya
SET @perk_instansi = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'lkpj_bab3_ikd_perkembangan' AND COLUMN_NAME = 'id_instansi');
SET @sql_perk_instansi = IF(@perk_instansi = 0, 'ALTER TABLE `lkpj_bab3_ikd_perkembangan` ADD COLUMN `id_instansi` INT(11) NULL DEFAULT NULL AFTER `ikd_id`, ADD INDEX `idx_ikd_perk_instansi` (`id_instansi`)', 'SELECT "id_instansi exists in lkpj_bab3_ikd_perkembangan"');
PREPARE stmt_perk_instansi FROM @sql_perk_instansi;
EXECUTE stmt_perk_instansi;
DEALLOCATE PREPARE stmt_perk_instansi;

SET @perk_pd = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'lkpj_bab3_ikd_perkembangan' AND COLUMN_NAME = 'pd_penanggung_jawab');
SET @sql_perk_pd = IF(@perk_pd = 0, 'ALTER TABLE `lkpj_bab3_ikd_perkembangan` ADD COLUMN `pd_penanggung_jawab` TEXT NULL DEFAULT NULL AFTER `id_instansi`', 'SELECT "pd_penanggung_jawab exists in lkpj_bab3_ikd_perkembangan"');
PREPARE stmt_perk_pd FROM @sql_perk_pd;
EXECUTE stmt_perk_pd;
DEALLOCATE PREPARE stmt_perk_pd;


-- ------------------------------------------------------------------------------
-- 4. TABEL CAPAIAN IKU (`lkpj_bab3_iku_capaian`) - BAB 3.4 BAGIAN A
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lkpj_bab3_iku_capaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` varchar(13) NOT NULL,
  `tahun` int(4) NOT NULL DEFAULT 2025,
  `iku_id` int(11) DEFAULT NULL,
  `misi_id` int(11) DEFAULT NULL,
  `misi` text NOT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `tujuan` text NOT NULL,
  `indikator_iku` text NOT NULL,
  `satuan` varchar(50) DEFAULT 'Indeks',
  `realisasi_2021` decimal(15,3) DEFAULT NULL,
  `realisasi_2022` decimal(15,3) DEFAULT NULL,
  `realisasi_2023` decimal(15,3) DEFAULT NULL,
  `realisasi_2024` decimal(15,3) DEFAULT NULL,
  `target_2025` decimal(15,3) DEFAULT NULL,
  `realisasi_2025` decimal(15,3) DEFAULT NULL,
  `capaian_2025` decimal(15,3) DEFAULT NULL,
  `target` decimal(15,3) DEFAULT NULL,
  `realisasi` decimal(15,3) DEFAULT NULL,
  `capaian` decimal(15,3) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wilayah_tahun` (`kodewilayah`, `tahun`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ------------------------------------------------------------------------------
-- 5. TABEL PERKEMBANGAN IKU (`lkpj_bab3_iku_perkembangan`) - BAB 3.4 BAGIAN A
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lkpj_bab3_iku_perkembangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` varchar(13) NOT NULL,
  `tahun` int(4) NOT NULL DEFAULT 2025,
  `capaian_id` int(11) DEFAULT NULL,
  `iku_id` int(11) DEFAULT NULL,
  `uraian_indikator` varchar(255) NOT NULL,
  `nilai_2021` decimal(15,3) DEFAULT NULL,
  `nilai_2022` decimal(15,3) DEFAULT NULL,
  `nilai_2023` decimal(15,3) DEFAULT NULL,
  `nilai_2024` decimal(15,3) DEFAULT NULL,
  `nilai_2025` decimal(15,3) DEFAULT NULL,
  `narasi` text DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wilayah_tahun` (`kodewilayah`, `tahun`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
