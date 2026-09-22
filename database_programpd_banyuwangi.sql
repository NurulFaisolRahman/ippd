-- ========================================================
-- MIGRATION DATA LENGKAP PROGRAM PD KABUPATEN BANYUWANGI (35.10)
-- Sumber: Dokumen Renstra/RPJMD Target & Pagu Indikatif 2026-2030
-- Website: https://smartgovernment.web.id/Daerah/ProgramPD
-- ========================================================

CREATE TABLE IF NOT EXISTS `program_urusan` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `kode_urusan` VARCHAR(50) NOT NULL,
      `nama_urusan` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_urusan_wil` (`kode_wilayah`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `program_bidang_urusan` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `urusan_id` INT(11) NOT NULL,
      `kode_bidang` VARCHAR(50) NOT NULL,
      `nama_bidang` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_bidang_wil_ur` (`kode_wilayah`, `urusan_id`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `program_data` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `bidang_urusan_id` INT(11) NOT NULL,
      `kode_program` VARCHAR(50) DEFAULT NULL,
      `nama_program` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_data_wil_bid` (`kode_wilayah`, `bidang_urusan_id`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `program_outcome` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `program_id` INT(11) NOT NULL,
      `outcome_text` TEXT NOT NULL,
      `urutan` INT(11) DEFAULT 10,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_outcome_prog` (`program_id`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `program_indikator` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `program_id` INT(11) NOT NULL,
      `outcome_id` INT(11) NOT NULL,
      `indikator` TEXT NOT NULL,
      `satuan` VARCHAR(100) DEFAULT '',
      `kondisi_awal` VARCHAR(100) DEFAULT '',
      `target_2026` VARCHAR(100) DEFAULT '',
      `pagu_2026` DECIMAL(20,2) DEFAULT NULL,
      `target_2027` VARCHAR(100) DEFAULT '',
      `pagu_2027` DECIMAL(20,2) DEFAULT NULL,
      `target_2028` VARCHAR(100) DEFAULT '',
      `pagu_2028` DECIMAL(20,2) DEFAULT NULL,
      `target_2029` VARCHAR(100) DEFAULT '',
      `pagu_2029` DECIMAL(20,2) DEFAULT NULL,
      `target_2030` VARCHAR(100) DEFAULT '',
      `pagu_2030` DECIMAL(20,2) DEFAULT NULL,
      `perangkat_daerah_id` INT(11) DEFAULT NULL,
      `urutan` INT(11) DEFAULT 10,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_ind_wil_out` (`kode_wilayah`, `outcome_id`, `deleted_at`),
      KEY `idx_prog_ind_pd` (`perangkat_daerah_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pastikan kolom pendukung akun_instansi dan sub_unit tersedia
ALTER TABLE `akun_instansi` ADD COLUMN IF NOT EXISTS `kode_instansi` VARCHAR(50) DEFAULT NULL AFTER `kodewilayah`;
ALTER TABLE `akun_instansi` ADD COLUMN IF NOT EXISTS `bidang_urusan_id` VARCHAR(255) DEFAULT NULL AFTER `urusan_id`;
ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `instansi_id` INT(11) DEFAULT NULL AFTER `id`;
ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `kode_sub_unit` VARCHAR(50) DEFAULT NULL AFTER `instansi_id`;
ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `nama_sub_unit` VARCHAR(255) DEFAULT NULL AFTER `kode_sub_unit`;
ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `password` VARCHAR(255) DEFAULT NULL AFTER `level`;
ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `bidang_urusan_id` TEXT DEFAULT NULL AFTER `parent_id`;
ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `urutan` INT(11) DEFAULT 10 AFTER `kode_wilayah`;

-- Pastikan wilayah Banyuwangi dan Akun Banyuwangi ada di database
INSERT IGNORE INTO kodewilayah (Kode, Nama) VALUES ('35.10', 'KAB. BANYUWANGI');
INSERT IGNORE INTO akun (Username, Password, KodeWilayah, Level, created_at, updated_at) VALUES ('banyuwangi', '$2y$10$gZHWVI0lHSQGslGmgcAFdOTKfgRh7TmNyALFKMoVD9w9tEGEsRy.m', '35.10', 3, NOW(), NOW());

-- Buat Akun Instansi Perangkat Daerah untuk Banyuwangi
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pendidikan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pendidikan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Kesehatan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kesehatan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pekerjaan Umum dan Penataan Ruang', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pekerjaan Umum dan Penataan Ruang');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Perumahan dan Kawasan Permukiman', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perumahan dan Kawasan Permukiman');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Satuan Polisi Pamong Praja', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Satuan Polisi Pamong Praja');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Sosial', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Sosial');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Tenaga Kerja', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Tenaga Kerja');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pertanian dan Pangan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pertanahan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanahan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Lingkungan Hidup', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Lingkungan Hidup');

-- Bersihkan data lama Banyuwangi jika ada
DELETE FROM program_indikator WHERE kode_wilayah = '35.10';
DELETE FROM program_outcome WHERE program_id IN (SELECT id FROM program_data WHERE kode_wilayah = '35.10');
DELETE FROM program_data WHERE kode_wilayah = '35.10';
DELETE FROM program_bidang_urusan WHERE kode_wilayah = '35.10';
DELETE FROM program_urusan WHERE kode_wilayah = '35.10';

-- -----------------------------------------------------
-- URUSAN 1: URUSAN PEMERINTAHAN WAJIB YANG BERKAITAN DENGAN PELAYANAN DASAR
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '1', 'URUSAN PEMERINTAHAN WAJIB YANG BERKAITAN DENGAN PELAYANAN DASAR', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '1.01', 'URUSAN PEMERINTAHAN BIDANG PENDIDIKAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.01.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintah Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '92', 915389611566, '93', 917119202700, '93', 917188854200, '94', 922739927000, '95', 947464337700, 46, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.01.02', 'PROGRAM PENGELOLAAN PENDIDIKAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Pendidikan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase ketersediaan sarana dan prasarana pendidikan berkondisi baik', '%', '94.52', '94.92', 93030000000, '95.12', 93205776200, '95.32', 93212856300, '95.52', 93777005400, '95.72', 96289719700, 46, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase peserta didik miskin dan berprestasi yang mendapatkan Beasiswa dan Pelayanan Pendidikan Sekolah', '%', '69.85', '73.85', 0, '75.85', 0, '77.85', 0, '79.85', 0, '81.85', 0, 46, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Peserta Didik yang Telah Mencapai Batas Kompetensi Minimum untuk Literasi', '%', '69.89', '71.89', 0, '72.89', 0, '73.89', 0, '74.89', 0, '75.89', 0, 46, 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Peserta Didik yang Telah Mencapai Batas Kompetensi Minimum untuk Numerasi', '%', '69.15', '71.15', 0, '72.15', 0, '73.15', 0, '74.15', 0, '75.15', 0, 46, 4, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Jumlah peserta didik yang Berprestasi', 'Angka', '217', '257', 0, '277', 0, '297', 0, '317', 0, '337', 0, 46, 5, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.01.03', 'PROGRAM PENGEMBANGAN KURIKULUM', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Kurikulum', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase perangkat kurikulum yang dikembangkan', '%', '100', '100', 94000000, '100', 94177600, '100', 94184800, '100', 94754800, '100', 97293800, 46, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.01.04', 'PROGRAM PENDIDIK DAN TENAGA KEPENDIDIKAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pendidik dan Tenaga Kependidikan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pendidik dan Tenaga Kependidikan yang tersertifikasi di Masing-Masing Sekolah', '%', '93.32', '95', 71000000, '96', 71134100, '97', 71139500, '98', 71570000, '100', 73487700, 46, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.01.05', 'PROGRAM PENGENDALIAN PERIZINAN PENDIDIKAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengendalian Perizinan Pendidikan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase PAUD berakreditasi minimal B', '%', '85.25', '85.65', 142000000, '85.85', 142268300, '86.05', 142279100, '86.25', 143140100, '86.45', 146975400, 46, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase SD/MI berakreditasi minimal B', '%', '97.03', '97.43', 0, '97.63', 0, '97.83', 0, '98.03', 0, '98.23', 0, 46, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase SMP/MTs berakreditasi minimal B', '%', '82.72', '83.12', 0, '83.32', 0, '83.52', 0, '83.72', 0, '83.92', 0, 46, 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase satuan pendidikan kesetaraan berakreditasi minimal B', '%', '30.51', '30.91', 0, '31.11', 0, '31.31', 0, '31.51', 0, '31.71', 0, 46, 4, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.01.06', 'PROGRAM PENGEMBANGAN BAHASA DAN SASTRA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Bahasa dan Sastra', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase bahasa dan sastra daerah yang dikembangkan dan dilindungi di Kabupaten Banyuwangi', '%', '100', '100', 66000000, '100', 66124700, '100', 66129700, '100', 66529900, '100', 68312500, 46, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '1.02', 'URUSAN PEMERINTAHAN BIDANG KESEHATAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.02.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '95', '95.5', 355712570163, '96', 356384674600, '96.5', 356411740500, '97', 358568839800, '97', 368176534000, 47, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.02.02', 'PROGRAM PEMENUHAN UPAYA KESEHATAN PERORANGAN DAN UPAYA KESEHATAN MASYARAKAT', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemenuhan Upaya Kesehatan Perorangan dan Upaya Kesehatan Masyarakat', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase fasilitas kesehatan yang terintegrasi dalam sistem informasi kesehatan nasional', '%', '87.40', '88.40', 206260000000, '89.40', 206649720200, '90.40', 206665414900, '91.40', 207916209700, '92', 213487233000, 47, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'nasional Cakupan penemuan kasus TB', '%', '74.5', '90', 0, '90', 0, '90', 0, '90', 0, '90', 0, 47, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Desa/Kelurahan sanitasi total berbasis masyarakat', '%', '1.38', '2.3', 0, '2.76', 0, '3.23', 0, '3.69', 0, '4.15', 0, 47, 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'masyarakat Tingkat kepuasan pasien di fasilitas kesehatan', '%', '88.5', '89', 0, '89.5', 0, '90', 0, '90.50', 0, '90.50', 0, 47, 4, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitas Kesehatan yang sesuai standar', '%', '0', '50', 0, '60', 0, '75', 0, '80', 0, '85', 0, 47, 5, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Cakupan imunisasi bayi lengkap', '%', '80.42', '95', 0, '97', 0, '98', 0, '99', 0, '99', 0, 47, 6, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Cakupan kepesertaan Jaminan Kesehatan Nasional', '%', '93.95', '95', 0, '95.5', 0, '96', 0, '96.5', 0, '97', 0, 47, 7, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Hipertensi dalam pengendalian', '%', '10', '20', 0, '35', 0, '50', 0, '60', 0, '60', 0, 47, 8, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Kunjungan Ibu Hamil K1', '%', '92.1', '93.1', 0, '93.6', 0, '94.1', 0, '94.6', 0, '95.1', 0, 47, 9, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Perilaku Hidup Bersih Sehat (PHBS\\ Rumah Tangga', '%', '56', '57', 0, '58', 0, '59', 0, '60', 0, '60', 0, 47, 10, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Puskesmas yang memenuhi rasio Puskesmas terhadap populasi', '%', '15.5', '15.5', 0, '17.30', 0, '19.10', 0, '20.80', 0, '20.80', 0, 47, 11, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase lanjut usia yang mandiri', '%', '79.18', '77', 0, '79', 0, '81', 0, '83', 0, '83', 0, 47, 12, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Prevalensi wasting (gizi kurang dan gizi buruk\\ pada balita', '%', '6.5', '6.3', 0, '6.1', 0, '5.9', 0, '5.7', 0, '6', 0, 47, 13, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.02.03', 'PROGRAM PENINGKATAN KAPASITAS SUMBER DAYA MANUSIA KESEHATAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kapasitas Sumber Daya Manusia Kesehatan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Rasio tenaga kesehatan dan tenaga medis terhadap populasi', 'Angka', '2.3:1000', '2.3:1000', 1563000000, '2.3:1000', 1565953300, '2.3:1000', 1566072200, '2.3:1000', 1575550400, '2.3:1000', 1617766600, 47, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.02.04', 'PROGRAM SEDIAAN FARMASI, ALAT KESEHATAN DAN MAKANAN MINUMAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Ketersediaan Farmasi, Alat Kesehatan dan Makanan Minuman', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase apotek dan toko obat yang mampu memelihara persyaratan perizinan', '%', '0', '92', 325000000, '94', 325614100, '96', 325638900, '98', 327609800, '100', 336388000, 47, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase apotek dan toko obat yang mampu memelihara persyaratan perizinan', '%', '39.8', '44', 0, '46', 0, '48', 0, '50', 0, '52', 0, 47, 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.02.05', 'PROGRAM PEMBERDAYAAN MASYARAKAT BIDANG KESEHATAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Bidang Kesehatan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Proporsi penduduk dengan aktivitas fisik cukup', '%', '40', '42', 8320000000, '44', 8335720300, '46', 8336353400, '48', 8386807300, '50', 8611528200, 47, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '1.03', 'URUSAN PEMERINTAHAN BIDANG PEKERJAAN UMUM DAN PENATAAN RUANG', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92', '94.50', 45182063628, '95', 45267432800, '95.50', 45270870400, '96', 45544861500, '96.50', 46765215600, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.02', 'PROGRAM PENGELOLAAN SUMBER DAYA AIR (SDA)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Sumber Daya Air (SDA', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase daerah aman dari daya rusak air', '%', '89', '89.4', 76971000000, '89.6', 77116433800, '89.8', 77122290600, '90', 77589055100, '90.2', 79668019800, 48, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase daerah irigasi yang terlayani', '%', '68', '68.2', 0, '68.3', 0, '68.4', 0, '68.5', 0, '68.6', 0, 48, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase masyarakat yang berpartisipasi dalam pengelolaan SDA', '%', '43', '44', 0, '44.5', 0, '45', 0, '45.5', 0, '46', 0, 48, 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase peningkatan DAS yang dikonservasi', '%', '33', '36.34', 0, '38.01', 0, '39.68', 0, '41.32', 0, '43.02', 0, 48, 4, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.03', 'PROGRAM PENGELOLAAN DAN PENGEMBANGAN SISTEM PENYEDIAAN AIR MINUM', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan dan Pengembangan Sistem Penyediaan Air Minum', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan pokok air minum rumah tangga dengan akses berkelanjutan terhadap air minum layak perkotaan dan perdesaan sehari-hari', '%', '97.58', '97.62', 95156000000, '97.64', 95335793400, '97.66', 95343033800, '97.68', 95920075400, '97.7', 98490211500, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.05', 'PROGRAM PENGELOLAAN DAN PENGEMBANGAN SISTEM AIR LIMBAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan dan Pengembangan Sistem Air Limbah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase rumah tangga yang memiliki akses terhadap layanan sanitasi layak', '%', '0.24', '0.36', 363000000, '0.42', 363685900, '0.49', 363713400, '0.56', 365914700, '0.63', 375719200, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.06', 'PROGRAM PENGELOLAAN DAN PENGEMBANGAN SISTEM DRAINASE', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya kualitas Sistem Drainase Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Panjang Drainase Berfungsi Baik', 'Angka', '74.45', '76.45', 75873000000, '77.45', 76016358900, '78.45', 76022132000, '79.45', 76482238400, '80.45', 78531546300, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.08', 'PROGRAM PENATAAN BANGUNAN GEDUNG', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penataan Bangunan Gedung', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase gedung negara dalam kondisi baik', '%', '34', '37', 692000000, '40', 693307500, '45', 693360100, '47', 697556600, '50', 716247400, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.09', 'PROGRAM PENATAAN BANGUNAN DAN LINGKUNGANNYA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penataan Bangunan dan Lingkungannya', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kecukupan luasan RTH Publik', '%', '16.49', '17.89', 3768000000, '18.59', 3775119500, '19.29', 3775406200, '19.99', 3798255900, '20.69', 3900028500, 48, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase ketersediaan LPJU pada jalan kabupaten', '%', '30.65', '34.45', 0, '36.35', 0, '38.25', 0, '40.15', 0, '42.05', 0, 48, 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.10', 'PROGRAM PENYELENGGARAAN JALAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penyelenggaraan Jalan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Tingkat Kemantapan Jalan kabupaten/kota', '%', '76.41', '77.73', 170875000000, '78.4', 171197861200, '79.08', 171210863100, '79.76', 172247077100, '80.44', 176862361600, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.11', 'PROGRAM PENGEMBANGAN JASA KONSTRUKSI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengembangan Jasa Kontruksi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase tenaga kerja konstruksi yang memiliki sertifikat keahlian', '%', '79', '81', 1294000000, '82', 1296445100, '83', 1296543500, '84', 1304390600, '85', 1339341100, 48, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.03.12', 'PROGRAM PENYELENGGARAAN PENATAAN RUANG', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penyelenggaraan Penataan Ruang', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase wilayah yang telah tersusun perencanaan tata ruang', '%', '25', '41', 6289000000, '50', 6300882700, '58', 6301361300, '66', 6339498800, '75', 6509362700, 48, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '1.04', 'URUSAN PEMERINTAHAN BIDANG PERUMAHAN DAN KAWASAN PERMUKIMAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.04.02', 'PROGRAM PENGEMBANGAN PERUMAHAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemenuhan Kebutuhan Permukiman Pasca Bencana dan Terdampak Relokasi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Penyediaan dan Rehabilitasi Rumah Yang Layak Huni bagi korban bencana', '%', '0', '100', 2806000000, '100', 2811301700, '100', 2811515400, '100', 2828531400, '100', 2904320400, 49, 1, NOW(), NOW());
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya kualitas perumahan yang berijin', 2, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase perumahan yang mendapatkan ijin', '%', '0', '100', 81000000, '100', 81152900, '100', 81159200, '100', 81650400, '100', 83838200, 49, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.04.03', 'PROGRAM KAWASAN PERMUKIMAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Menurunnya luasan kawasan permukiman kumuh yang ditangani', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kawasan permukiman kumuh dibawah 10 ha di kabupaten/kota yang ditangani', '%', '2.71', '4.56', 1940000000, '5.45', 1943665600, '6.57', 1943813200, '7.58', 1955577700, '8.59', 2007976500, 49, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.04.04', 'PROGRAM PERUMAHAN DAN KAWASAN PERMUKIMAN KUMUH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Menurunnya jumlah rumah tidak layak huni di luar kawasan kumuh', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Rumah Tidak Layak Huni yang diperbaiki diluar Kawsan Kumuh', '%', '0', '100', 11422000000, '100', 11443581400, '100', 11444450400, '100', 11513715200, '100', 11822220200, 49, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.04.05', 'PROGRAM PENINGKATAN PRASARANA, SARANA DAN UTILITAS UMUM (PSU)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya perumahan yang dilengkapi PSU', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase perumahan yang sudah dilengkapi PSU (Prasarana, Sarana dan Utilitas Umum)', '%', '100', '100', 19612000000, '100', 19649055900, '100', 19650548200, '100', 19769478500, '100', 20299192800, 49, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '1.05', 'URUSAN PEMERINTAHAN BIDANG KETENTERAMAN DAN KETERTIBAN UMUM SERTA PERLINDUNGAN MASYARAKAT', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.05.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '92', 23648127241, '93', 23692309100, '94', 23694608500, '95', 23838014200, '96', 24476743100, 50, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '93.70', 0, '94.90', 0, '96.10', 0, '97.30', 0, '98.80', 0, 50, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '94.5', '95', 0, '95.5', 0, '95.5', 0, '96', 0, '96', 0, 50, 3, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.05.02', 'PROGRAM PENINGKATAN KETENTERAMAN DAN KETERTIBAN UMUM', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Partisipasi Masyarakat Dalam Penegakan Perda', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penurunan pelanggaran PERDA', '%', '4.1', '4', 2641000000, '3.8', 2645990200, '3.6', 2646191100, '3.4', 2662206600, '3.2', 2733539400, 50, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.05.03', 'PROGRAM PENANGGULANGAN BENCANA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Terwujudnya ketahanan daerah dalam penanggulangan bencana melalui mitigasi, kesiapsiagaan, dan pemulihan yang lebih optimal', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Pengembangan Sistem Pemulihan Bencana', 'Indeks', '0.75', '0.75', 1814000000, '0.75', 1817427500, '0.75', 1817565700, '0.75', 1828565900, '0.75', 1877561100, 50, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Peningkatan Efektivitas Pencegahan dan Mitigasi Bencana', 'Indeks', '0.81', '0.81', 0, '0.82', 0, '0.82', 0, '0.82', 0, '0.82', 0, 50, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Perkuatan Kesiapsiagaan dan Penanganan Darurat Bencana', 'Indeks', '0.52', '0.52', 0, '0.53', 0, '0.53', 0, '0.53', 0, '0.54', 0, 50, 3, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.05.04', 'PROGRAM PENCEGAHAN, PENANGGULANGAN, PENYELAMATAN KEBAKARAN DAN PENYELAMATAN NON KEBAKARAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pencegahan, Penanggulangan, Penyelamatan Kebakaran dan Penyelamatan Non Kebakaran', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Respons time rate Maksimal 15 Menit pada Wilayah Manajemen Kebakaran', '%', '75', '75.5', 2177000000, '76', 2181113300, '76.5', 2181278900, '77', 2194480600, '77.5', 2253280900, 50, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '1.06', 'URUSAN PEMERINTAHAN BIDANG SOSIAL', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.06.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '87.5', '95.2', 11080481999, '95.4', 11101418200, '95.6', 11102261200, '95.8', 11169455000, '96', 11468735600, 51, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.06.02', 'PROGRAM PEMBERDAYAAN SOSIAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemberdayaan Sosial', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Potensi dan sumber kesejahteraan sosial (PSKS) perorangan sosial yang melaksanakan pelayanan sosial sesuai standar', '%', '100', '100', 3648000000, '100', 3654892800, '100', 3655170400, '100', 3677292500, '100', 3775823900, 51, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.06.04', 'PROGRAM REHABILITASI SOSIAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Rehabilitasi Sosial', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Gelandangan dan Pengemis Terpenuhi Kebutuhan Dasarnya', '%', '100', '100', 6780000000, '100', 6792810700, '100', 6793326600, '100', 6834441700, '100', 7017567600, 51, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase anak terlantar yang terpenuhi kebutuhan dasarnya di luar panti', '%', '100', '100', 0, '100', 0, '100', 0, '100', 0, '100', 0, 51, 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase lanjut usia terlantar yang terpenuhi kebutuhan dasarnya di luar panti', '%', '100', '100', 0, '100', 0, '100', 0, '100', 0, '100', 0, 51, 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'dasarnya Persentase penyandang disabilitas terlantar yang terpenuhi kebutuhan dasarnya di luar panti', '%', '100', '100', 0, '100', 0, '100', 0, '100', 0, '100', 0, 51, 4, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.06.05', 'PROGRAM PERLINDUNGAN DAN JAMINAN SOSIAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Perlindungan dan Jaminan Sosial', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penerima manfaat yang terpenuhinya kebutuhan dasar', '%', '100', '100', 7470000000, '100', 7484114300, '100', 7484682700, '100', 7529982000, '100', 7731744500, 51, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.06.06', 'PROGRAM PENANGANAN BENCANA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penanganan Bencana', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase korban bencana alam dan sosial yang terpenuhi kebutuhan dasarnya ada saat dan setelah tanggap darurat bencana daerah kab/kota', '%', '100', '100', 2496000000, '100', 2500716100, '100', 2500906000, '100', 2516042100, '100', 2583458400, 51, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '1.06.07', 'PROGRAM PENGELOLAAN TAMAN MAKAM PAHLAWAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Taman Makam Pahlawan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase taman makam pahlawan nasional yang terkelola dengan baik', '%', '100', '100', 676000000, '100', 677277300, '100', 677328700, '100', 681428100, '100', 699686700, 51, 1, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 2: URUSAN PEMERINTAHAN WAJIB YANG TIDAK BERKAITAN DENGAN PELAYANAN DASAR
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '2', 'URUSAN PEMERINTAHAN WAJIB YANG TIDAK BERKAITAN DENGAN PELAYANAN DASAR', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.07', 'URUSAN PEMERINTAHAN BIDANG TENAGA KERJA', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.07.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintah Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '96.68', '97', 6448913660, '97', 6461098600, '97.25', 6461589200, '97.25', 6500696300, '97.5', 6674879500, 52, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.07.02', 'PROGRAM PERENCANAAN TENAGA KERJA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Perencanaan Tenaga kerja', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase rekomendasi kebijakan ketenagakerjaan pada RTK Kabupaten yang dilaksanakan', '%', '100', '100', 81000000, '100', 81153000, '100', 81159200, '100', 81650400, '100', 83838200, 52, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.07.03', 'PROGRAM PELATIHAN KERJA DAN PRODUKTIVITAS TENAGA KERJA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas dan Produktivitas Tenaga Kerja', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Tenaga Kerja Bersertifikat kompetensi', '%', '7.59', '7.67', 1852000000, '7.75', 1855499200, '7.89', 1855640100, '7.9', 1866870900, '8', 1916892900, 52, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Tingkat Produktivitas Tenaga Kerja', 'Juta Rupiah/Tenaga Kerja', '63.091', '63.731', 0, '64.054', 0, '64.379', 0, '64.705', 0, '65.033', 0, 52, 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.07.04', 'PROGRAM PENEMPATAN TENAGA KERJA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Jumlah Penempatan Tenaga Kerja', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Penempatan tenaga kerja (Dala dan Luar Negeri', '%', '93.92', '94.43', 2075000000, '94.69', 2078920700, '95', 2079078500, '95.20', 2091661600, '95.46', 2147706700, 52, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.07.05', 'PROGRAM HUBUNGAN INDUSTRIAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Hubungan Industrial', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Perusahaan yang menerapkan tata kelola kerja yang layak (PP/PKB, LKS Bipartit, Struktur Skala Upah, dan terdaftar peserta BPJS Ketenagakerjaan)', '%', '81.8', '82', 2605000000, '82.5', 2609922100, '83', 2610120200, '83.5', 2625917400, '84', 2696277600, 52, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.08', 'URUSAN PEMERINTAHAN BIDANG PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.08.02', 'PROGRAM PENGARUSUTAMAAN GENDER DAN PEMBERDAYAAN PEREMPUAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengarusutamaan Gender dan Pemberdayaan Perempuan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase anggaran responsif Gender', '%', '59', '60.50', 4087000000, '65.50', 4094722200, '70.50', 4095033200, '75.50', 4119817400, '80.50', 4230206100, 53, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.08.03', 'PROGRAM PERLINDUNGAN PEREMPUAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Perlindungan Perempuan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase perempuan korban kekerasan dan TPPO yang mendapatkan layanan komprehensif', '%', '100', '100', 904000000, '100', 905708000, '100', 905776800, '100', 911258800, '100', 935675600, 53, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.08.04', 'PROGRAM PENINGKATAN KUALITAS KELUARGA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Keluarga', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase terlayaninya keluarga yang memanfaatkan puspaga', '%', '100', '100', 517000000, '100', 517976900, '100', 518016200, '100', 521151400, '100', 535115400, 53, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.08.06', 'PROGRAM PEMENUHAN HAK ANAK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pemenuhan Hak Anak (PHA)', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, '% peningkatan partisipasi anak', '%', '60', '63', 3410000000, '66', 3416443100, '69', 3416702600, '72', 3437381400, '75', 3529484500, 53, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.08.07', 'PROGRAM PERLINDUNGAN KHUSUS ANAK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya perlindungan khusus anak', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase anak korban kekerasan yang mendapatkan layanan komprehensif', '%', '100', '100', 905000000, '100', 906710000, '100', 906778800, '100', 912266900, '100', 936710700, 53, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.09', 'URUSAN PEMERINTAHAN BIDANG PANGAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.09.02', 'PROGRAM PENGELOLAAN SUMBER DAYA EKONOMI UNTUK KEDAULATAN dan KEMANDIRIAN PANGAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Ketersediaan Pangan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase Ketersediaan Bahan Pangan Pokok Unggulan', '%', '100', '100', 423000000, '100', 423799200, '100', 423831400, '100', 426396600, '100', 437821700, 54, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.09.03', 'PROGRAM PENINGKATAN DIVERSIFIKASI DAN KETAHANAN PANGAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Diversifikasi Pangan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka Kecukupan Energi', 'Kkal/Kapita/Hari', '2,288', '2,244', 3826000000, '2,208', 3833229000, '2,172', 3833520300, '2,136', 3856722000, '2,100', 3960061000, 54, 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka Kecukupan Protein', 'Gram/Kapita/Hari', '68.66', '65', 0, '63', 0, '61', 0, '59', 0, '57', 0, 54, 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.09.04', 'PROGRAM PENANGANAN KERAWANAN PANGAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Menurunnya Kerawanan Pangan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Daerah Rentan Rawan Pangan', '%', '1.84', '2', 3023000000, '2', 3028711800, '1', 3028941900, '1', 3047273800, '1', 3128924100, 54, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.09.05', 'PROGRAM PENGAWASAN KEAMANAN PANGAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Keamanan Pangan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pangan Segar asal tumbuhan yang memenuhi persyaratan mutu dan keamanan pangan', '%', '100', '100', 507000000, '100', 507958100, '100', 507996800, '100', 511071300, '100', 524765200, 54, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.10', 'URUSAN PEMERINTAHAN BIDANG PERTANAHAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.10.04', 'PROGRAM PENYELESAIAN SENGKETA TANAH GARAPAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penyelesaian Sengketa Tanah Garapan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase fasilitasi penyelesaian sengketa pertanahan', '%', '100', '100', 214000000, '100', 214593200, '100', 214617000, '100', 216521200, '100', 225002200, 55, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.10.05', 'PROGRAM PENYELESAIAN GANTI KERUGIAN DAN SANTUNAN TANAH UNTUK PEMBANGUNAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penyelesaian Ganti Kerugian dan Santunan Tanah Untuk Pembangunan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kegiatan pengadaan tanah untuk pembangunan', '%', '0', '100', 132000000, '100', 132249400, '100', 132259400, '100', 133059900, '100', 136625200, 55, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.10.06', 'PROGRAM REDISTRIBUSI TANAH, DAN GANTI KERUGIAN PROGRAM TANAH KELEBIHAN MAKSIMUM DAN TANAH ABSENTEE', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Fasilitasi Redistribusi Tanah, dan Ganti Kerugian Program Tanah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase fasilitasi kegiatan redistribusi tanah', '%', '100', '100', 100000000, '100', 100000000, '100', 100000000, '100', 100000000, '100', 100000000, 55, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.11', 'URUSAN PEMERINTAHAN BIDANG LINGKUNGAN HIDUP', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '89', '91.80', 18622750142, '93.64', 18657937300, '95.51', 18659354500, '97.42', 18772285700, '97.42', 19275280700, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.02', 'PROGRAM PERENCANAAN LINGKUNGAN HIDUP', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas lingkungan hidup', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Perencanaan bidang lingkungan hidup yang disusun', '%', '100', '100', 169000000, '100', 169319300, '100', 169332200, '100', 170357000, '100', 174921600, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.03', 'PROGRAM PENGENDALIAN PENCEMARAN DAN/ATAU KERUSAKAN LINGKUNGAN HIDUP', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengendalian Pencemaran dan/atau Kerusakan Lingkungan Hidup', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase peningkatan sarana prasarana dan aktifitas penanggulangan pencemaran dan/atau kerusakan lingkungan hidup', '%', '100', '100', 1143000000, '100', 1145159600, '100', 1145246600, '100', 1152178000, '100', 1183050100, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.04', 'PROGRAM PENGELOLAAN KEANEKARAGAMAN HAYATI (KEHATI)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Terkendalinya alih fungsi lahan hijau', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase Ruang Terbuka Hijau (RTH)', '%', '95', '95.7', 655000000, '95.9', 656237600, '96.1', 656287500, '96.3', 660259600, '96.5', 677951000, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.05', 'PROGRAM PENGENDALIAN BAHAN BERBAHAYA DAN BERACUN (B3) DAN LIMBAH BAHAN BERBAHAYA DAN BERACUN (LIMBAH B3)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya penanganan Bahan Berbahaya Beracun (B3) dan Limbah B3', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penerbitan rekomendasi teknis ijin pengelolaan limbah B3 skala Kabupaten', '%', '100', '100', 5000000, '100', 5000000, '100', 5000000, '100', 5000000, '100', 5000000, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.06', 'PROGRAM PEMBINAAN DAN PENGAWASAN TERHADAP IZIN LINGKUNGAN DAN IZIN PERLINDUNGAN DAN PENGELOLAAN LINGKUNGAN HIDUP (PPLH)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Tata Kelola Perlindungan dan Pengelolaan Lingkungan Hidup', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase Kepatuhan Kegiatan Usaha Terhadap Aspek Lingkungan', '%', '74', '78', 145000000, '80', 145274000, '82.85', 145285000, '83.75', 146164300, '84.71', 150080700, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.08', 'PROGRAM PENINGKATAN PENDIDIKAN, PELATIHAN DAN PENYULUHAN LINGKUNGAN HIDUP UNTUK MASYARAKAT', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya peran serta masyarakat dalam pelestarian lingkungan hidup', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kelompok masyarakat yang berpartisipasi dalam pelestarian lingkungan hidup', '%', '20', '22', 142000000, '24', 142268400, '26', 142279200, '28', 143140300, '30', 146975600, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.09', 'PROGRAM PENGHARGAAN LINGKUNGAN HIDUP UNTUK MASYARAKAT', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penghargaan terhadap pelestari lingkungan hidup', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penghargaan terhadap pelaku pelestari lingkungan hidup', '%', '65', '72', 56000000, '73', 56105800, '74', 56110100, '75', 56449700, '76', 57962200, 56, 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.11.11', 'PROGRAM PENGELOLAAN PERSAMPAHAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Persampahan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase timbulan sampah yang terolah di fasilitas pengolahan sampah', '%', '31.3', '40.26', 13975000000, '41.75', 14001414600, '43.24', 14002478300, '44.72', 14087255400, '46.21', 14364851200, 56, 1, NOW(), NOW());


-- ========================================================
-- TAMBAHAN DATA PROGRAM PD KABUPATEN BANYUWANGI (35.10)
-- ========================================================

INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Kependudukan dan Pencatatan Sipil', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kependudukan dan Pencatatan Sipil');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pemberdayaan Masyarakat dan Desa', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pengendalian Penduduk dan Keluarga Berencana', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Perhubungan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Komunikasi dan Informatika', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Komunikasi dan Informatika');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Koperasi, Usaha Mikro dan Perdagangan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pemuda dan Olahraga', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Kebudayaan dan Pariwisata', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Perpustakaan dan Kearsipan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perpustakaan dan Kearsipan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Perikanan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perikanan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Pertanian dan Pangan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Perindustrian dan Perdagangan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perindustrian dan Perdagangan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Tenaga Kerja', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Tenaga Kerja');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Sekretariat Daerah', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Sekretariat DPRD', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat DPRD');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Badan Perencanaan Pembangunan Daerah', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Perencanaan Pembangunan Daerah');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Badan Pengelolaan Keuangan dan Aset Daerah', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Badan Kepegawaian, Pendidikan dan Pelatihan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kepegawaian, Pendidikan dan Pelatihan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Badan Riset dan Inovasi Daerah', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Riset dan Inovasi Daerah');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Inspektorat Daerah', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Kecamatan', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Badan Kesatuan Bangsa dan Politik', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik');
INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '35.10', 'Dinas Lingkungan Hidup', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Lingkungan Hidup');

-- Tambahan indikator untuk Program 2.11.11
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) SELECT '35.10', id, (SELECT id FROM program_outcome WHERE program_id = pd.id LIMIT 1), 'Proporsi Rumah Tangga (RT) Dengan Layanan Penuh Pengumpulan Sampah', '%', '27.5', '30.87', NULL, '31.07', NULL, '31.27', NULL, '31.47', NULL, '31.67', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Lingkungan Hidup' LIMIT 1), 2, NOW(), NOW() FROM program_data pd WHERE pd.kode_wilayah = '35.10' AND pd.kode_program = '2.11.11';

-- Urusan 2 (URUSAN PEMERINTAHAN WAJIB YANG TIDAK BERKAITAN DENGAN PELAYANAN DASAR) already exists, fetch ID
SELECT id INTO @urusan_id FROM program_urusan WHERE kode_wilayah = '35.10' AND kode_urusan = '2' LIMIT 1;

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.12', 'URUSAN PEMERINTAHAN BIDANG ADMINISTRASI KEPENDUDUKAN DAN PENCATATANSIPIL', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.12.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHANDAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92.5', '92.5', 7106827138, '92.5', 7120255000, '92.5', 7120795800, '92.5', 7163892600, '92.5', 7355846100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kependudukan dan Pencatatan Sipil' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.12.02', 'PROGRAMPENDAFTARAN PENDUDUK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Jumlah Pendaftaran Penduduk', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase layanan pendaftaran penduduk yang selesai tepat waktu', '%', '86', '90', 3447000000, '91', 3453512900, '92', 3453775200, '93', 3474678400, '94', 3567780800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kependudukan dan Pencatatan Sipil' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.12.03', 'PROGRAM PENCATATAN SIPIL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pencatatan Sipil', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase layanan pencatatan sipil yang selesai tepat waktu', '%', '80.1', '90', 786000000, '91', 787485000, '92', 787544800, '93', 792311200, '94', 813540800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kependudukan dan Pencatatan Sipil' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.12.04', 'PROGRAM PENGELOLAAN INFORMASI ADMINISTRASIKEPENDUDUKAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Data Kependudukan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase data kependudukan yang ganda dan anomali', '%', '1', '1', 425000000, '1', 425803100, '1', 425835500, '1', 428412700, '1', 439891800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kependudukan dan Pencatatan Sipil' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.13', 'URUSAN PEMERINTAHAN BIDANG PEMBERDAYAAN MASYARAKAT DANDESA', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.13.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92.5', '93.5', 5271844446, '94.5', 5281805200, '95.5', 5282206200, '96.5', 5314175500, '97.5', 5456566300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.13.02', 'PROGRAM PENATAAN DESA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya kualitas penataan desa', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitasi Penataan Desa', '%', '0', '30', 38000000, '50', 38071800, '70', 38074700, '80', 38305100, '90', 39331500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.13.03', 'PROGRAM PENINGKATANKERJA SAMA DESA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Kerja Sama Desa', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitasi Kerjasama Desa', '%', '0', '40', 102000000, '50', 102192700, '60', 102200400, '70', 102819000, '80', 105574000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.13.04', 'PROGRAM ADMINISTRASIPEMERINTAHAN DESA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Administrasi Pemerintahan Desa', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitasi Tata Kelola Desa', '%', '0', '40', 6264000000, '55', 6275835400, '70', 6276312100, '80', 6314297900, '90', 6483486700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.13.05', 'PROGRAM PEMBERDAYAAN LEMBAGA KEMASYARAKATAN, LEMBAGA ADAT DAN MASYARAKATHUKUM ADAT', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemberdayaan Lembaga Kemasyarakatan, Lembaga Adat dan Masyarakat HukumAdat', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitasi Pemberdayaan Lembaga Kemasyarakatan Desa (LKD)', '%', '0', '50', 859000000, '60', 860623100, '70', 860688500, '80', 865897700, '90', 889099100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitasi Pemberdayaan Lembaga Adat Desa dan Lembaga Masyarakat Hukum Adat', '%', '0', '30', NULL, '35', NULL, '40', NULL, '45', NULL, '50', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemberdayaan Masyarakat dan Desa' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.14', 'URUSAN PEMERINTAHAN BIDANG PENGENDALIAN PENDUDUK DANKELUARGA BERENCANA', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.14.02', 'PROGRAMPENGENDALIAN PENDUDUK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Terkendalinya Penduduk', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Total Fertility Rate (TFR).', 'Orang', '2.02', '2.02', 371000000, '2.02', 371701000, '2.02', 371729300, '2.02', 373979100, '2.01', 383999800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka kelahiran remaja umur 15-19 tahun (Age Specific Fertility Rate/ASFR 15-19)(Kelahiran per 1000 WUS 15-19 tahun)', 'Angka', '7.7', '6.5', NULL, '6', NULL, '5.5', NULL, '5', NULL, '5', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.14.03', 'PROGRAM PEMBINAAN KELUARGA BERENCANA (KB)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pembinaan Keluarga Berencana (KB)', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka prevalensi kontrasepsi modern/modern Contraceptive (mCPR)', 'Angka', '69.8', '72', 999000000, '73', 1000887700, '73.75', 1000963700, '74.25', 1007021700, '75', 1034004400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kebutuhan ber-KB yang tidak terpenuhi (unmet need)', '%', '11.86', '11.5', NULL, '11.2', NULL, '10.9', NULL, '10.6', NULL, '10.3', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.14.04', 'PROGRAM PEMBERDAYAAN DAN PENINGKATAN KELUARGASEJAHTERA (KS)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kesejahteraan dan Ketahanan Keluarga', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase keluarga yang mengikuti kelompok kegiatan ketahanan keluarga', '%', '78.71', '80.81', 493000000, '81.86', 493931500, '82.91', 493969000, '83.96', 496958600, '85', 510274400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Lansia Berdaya', 'Indeks', '61.4', '61.76', NULL, '61.94', NULL, '62.12', NULL, '62.3', NULL, '62.5', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Pengasuhan Keluarga yang memiliki Remaja', 'Indeks', '81.3', '84.03', NULL, '85.4', NULL, '86.73', NULL, '88.1', NULL, '89.5', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pengendalian Penduduk dan Keluarga Berencana' LIMIT 1), 3, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.15', 'URUSAN PEMERINTAHAN BIDANG PERHUBUNGAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.15.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHANDAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '94.1', '94.3', 11237850194, '96.1', 11259083700, '97.9', 11259938900, '99.7', 11328086900, '100', 11631617900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.15.02', 'PROGRAM PENYELENGGARAAN LALU LINTAS DAN ANGKUTAN JALAN(LLAJ)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penyelenggaraan Lalu Lintas dan AngkutanJalan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase layanan angkutan darat', '%', '60.91', '63', 13270000000, '64', 13295073100, '65', 13296082900, '66', 13376554400, '67', 13734973300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Kinerja Lalu Lintas', 'Rasio', '0.325', '0.375', NULL, '0.378', NULL, '0.38', NULL, '0.383', NULL, '0.385', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.15.03', 'PROGRAM PENGELOLAANPELAYARAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya PemahamanMasyarakat tentang Pelayaran', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Rasio Konektivitas Laut', 'Rasio', '100', '100', 50000000, '100', 50000000, '100', 50000000, '100', 50000000, '100', 50000000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.15.04', 'PROGRAMPENGELOLAAN PENERBANGAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemahaman Masyarakat tentangKawasan KKOP', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Jumlah Masyarakat Yang Mengikuti Sosialisasi KawasanKKOP', 'Orang', '100', '100', 33000000, '100', 33062400, '100', 33064900, '100', 33265000, '100', 34156300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.15.05', 'PROGRAM PENGELOLAANPERKERETAAPIAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Perlintasan Sebidang', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Cakupan perlintasan kereta api yang ditangani', '%', '75', '76', 2497000000, '77', 2501812500, '78', 2502006300, '79', 2517451700, '80', 2586245400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perhubungan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.16', 'URUSAN PEMERINTAHAN BIDANG KOMUNIKASIDAN INFORMATIKA', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.16.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '91', '93.5', 9269885422, '94.5', 9287400200, '95.5', 9288105700, '96.5', 9344319600, '98', 9594696400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Komunikasi dan Informatika' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.16.02', 'PROGRAM PENGELOLAAN INFORMASI DANKOMUNIKASI PUBLIK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Informasi dan Komunikasi Publik', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Tingkat Kepuasan Masyarajkat terhadap akses dan kualitas Konten informasi publik', 'Angka', '85.7', '85.9', 8336000000, '86', 8351750600, '86.1', 8352384800, '86.2', 8402935800, '86.3', 8628088700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Komunikasi dan Informatika' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.16.03', 'PROGRAM PENGELOLAAN APLIKASIINFORMATIKA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Aplikasi Informatika', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, '\"Tingkat Kepuasan pengguna terhadap layanan TIK\"', 'Angka', '0', '80.25', 14326000000, '80.5', 14353068500, '80.75', 14354158600, '81', 14441033900, '81.25', 14827975100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Komunikasi dan Informatika' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.17', 'URUSAN PEMERINTAHAN BIDANG KOPERASI,USAHA KECIL, DAN MENENGAH', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'terpenuhinya penunjang urusan Perangkat Daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92', '92', 14490296021, '92', 14517675000, '92', 14518777600, '92', 14606649200, '92', 14998027700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.03', 'PROGRAM PENGAWASAN DAN PEMERIKSAANKOPERASI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kapasitas Kelembagaan Koperasi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Koperasi Aktif', '%', '87.22', '88.22', 62000000, '89.25', 62117200, '91', 62121900, '92', 62497800, '93', 64172400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.04', 'PROGRAM PENILAIANKESEHATAN KSP/USP KOPERASI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kesehatan KSP/USP Koperasi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase KSP/USP Sehat', '%', '44.86', '46', 20000000, '47', 20037800, '48', 20039300, '49', 20160600, '50', 20700800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.05', 'PROGRAM PENDIDIKAN DAN LATIHANPERKOPERASIAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kompetensi SDM Pengelola Koperasi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pengurus dan pengawas bersertifikat kompetensi', '%', '5', '10', 120000000, '15', 120037800, '20', 120039300, '25', 120160600, '30', 120700800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.06', 'PROGRAM PEMBERDAYAANDAN PERLINDUNGAN KOPERASI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kapasitas Usaha Koperasi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Pertumbuhan Volume Usaha Koperasi', '%', '76.98', '17.5', 182000000, '18', 182155000, '18.5', 182161200, '19', 182658400, '19.5', 184873200, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.07', 'PROGRAM PEMBERDAYAAN USAHA MENENGAH, USAHA KECIL, DAN USAHA MIKRO(UMKM)', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kapasitas SDM dan Kelembagaan Usaha Mikro', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Usaha Mikro yang Bertransformasi dari Informal ke Formal', '%', '74.07', '76', 2087000000, '77', 2091321200, '78', 2091495200, '79', 2105364000, '80', 2167135300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.17.08', 'PROGRAM PENGEMBANGANUMKM', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penjualan Usaha Mikro', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase usaha mikro yang meningkat nilai omset', '%', '36.73', '38', 899000000, '39', 900698600, '41', 900767000, '42', 906218700, '43', 930500400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.18', 'URUSAN PEMERINTAHANBIDANG PENANAMAN MODAL', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.18.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Terpenuhinya kebutuhan Penunjang Urusan Perangkat Daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '97', '97', 9124498948, '97', 9142532700, '97', 9143259000, '97', 9201138300, '97', 9458932300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.18.02', 'PROGRAM PENGEMBANGAN IKLIM PENANAMANMODAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Iklim Penanaman modal', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Potensi Investasi Daerah yang Dikembangkan', '%', '0', '12.5', 1054000000, '12.5', 1055991500, '25', 1056071800, '25', 1062463600, '25', 1090931900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.18.03', 'PROGRAMPROMOSI PENANAMAN MODAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Promosi Penanaman Modal', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Peningkatan Investor yang Berinvestasi', '%', '17.42', '17.5', 400000000, '17.6', 400755800, '17.7', 400786200, '17.8', 403211900, '17.9', 414015800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.18.04', 'PROGRAMPELAYANAN PENANAMAN MODAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pelayanan Penanaman Modal', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'IKM Pelayanan Perizinan dan Non Perizinan Penanaman Modal', 'Indeks', '93.06', '92', 420000000, '92.25', 420000000, '92.5', 420000000, '92.75', 420000000, '93', 420000000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.18.05', 'PROGRAM PENGENDALIAN PELAKSANAANPENANAMAN MODAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Terkendalinya Pelaksanaan Kegiatan Penanaman Modal', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pelaku Usaha yang mempunyai LKPM sesuai standar', '%', '17', '18', 1057000000, '19', 1058997200, '20', 1059077600, '21', 1065487400, '22', 1094036600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.18.06', 'PROGRAM PENGELOLAAN DATA DAN SISTEM INFORMASI PENANAMAN MODAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Tata Kelola Data  Dan Sistem Informasi Penanaman Modal', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pemanfaatan Data dan Informasi Penanaman Modal', '%', '95', '100', 29000000, '100', 29054800, '100', 29057000, '100', 29232900, '100', 30016200, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.19', 'URUSAN PEMERINTAHAN BIDANG KEPEMUDAAN DANOLAHRAGA', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.19.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHANDAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintah Daerah Kabupaten/Kota', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '87.5', '93.75', 5428286273, '95', 5438542600, '96.25', 5438955500, '97.5', 5471873400, '98.75', 5618489600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.19.02', 'PROGRAM PENGEMBANGAN KAPASITAS DAYASAING KEPEMUDAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Kapasitas Daya Saing Kepemudaan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Wirausaha Mandiri', '%', '20', '21', 3205000000, '21', 3211055800, '22', 3211299600, '22', 3230735200, '23', 3317301300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase organisasi pemuda yang aktif', '%', '20', '21', NULL, '21', NULL, '22', NULL, '22', NULL, '23', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Jumlah pemuda pelopor yang berperan aktif', 'Angka', '5', '7', NULL, '7', NULL, '8', NULL, '8', NULL, '9', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 3, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.19.03', 'PROGRAM PENGEMBANGAN KAPASITAS DAYA SAINGKEOLAHRAGAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Kapasitas Daya Saing Keolahragaan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Jumlah partisipasi masyarakat dalam kegiatan olahraga', 'Angka', '1000', '1100', 10519000000, '1200', 10538875100, '1300', 10539675300, '1400', 10603464200, '1500', 10887579300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase cabor yang memiliki infrastruktur memadai', '%', '80', '81', NULL, '82', NULL, '83', NULL, '84', NULL, '85', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.19.04', 'PROGRAM PENGEMBANGAN KAPASITASKEPRAMUKAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Kapasitas Kepramukaan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase organisasi pemuda yang aktif', '%', '20', '21', 208000000, '21', 208393000, '22', 208408800, '22', 209670100, '23', 215288100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pemuda dan Olahraga' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.20', 'URUSAN PEMERINTAHANBIDANG STATISTIK', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.20.02', 'PROGRAM PENYELENGGARAAN STATISTIKSEKTORAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penyelenggaraan Statistik Sektoral', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase OPD yang menggunakan Data Statistik dalam menyusun Perencaan dan evaluasi Pembangunan Daerah', '%', '100', '100', 4550000000, '100', 4558597000, '100', 4558943300, '100', 4586535300, '100', 4709429500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Komunikasi dan Informatika' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.21', 'URUSAN PEMERINTAHAN BIDANGPERSANDIAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.21.02', 'PROGRAM PENYELENGGARAAN PERSANDIAN UNTUK PENGAMANANINFORMASI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Keamanan sistem informasi pemerintah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks KAMI', 'Angka', '0', '559', 721000000, '568', 722362200, '578', 722417000, '587', 726789200, '596', 746263200, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Komunikasi dan Informatika' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.22', 'URUSAN PEMERINTAHAN BIDANGKEBUDAYAAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.22.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan DaerahKabupaten/Kota', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '85', '94.3', 7918929719, '96.1', 7933892400, '97.9', 7934494900, '99.7', 7982516300, '100', 8196404300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.22.02', 'PROGRAMPENGEMBANGAN KEBUDAYAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya pengembangan budaya lokal yangdilestarikan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Budaya lokal yang dilestarikan dan dikembangkan', '%', '76.47', '88.23', 283000000, '88.4', 283534700, '88.6', 283556300, '88.8', 285272400, '89', 292916200, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.22.03', 'PROGRAM PENGEMBANGAN KESENIANTRADISIONAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Kesenian Tradisional', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pertumbuhan Pelaku Seni', '%', '1.06', '1.1', 532000000, '1.2', 533005200, '1.3', 533045700, '1.4', 536271900, '1.5', 550641100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.22.05', 'PROGRAM PELESTARIAN DAN PENGELOLAANCAGAR BUDAYA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pelestarian Program dan Pengelolaan CagarBudaya', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Jumlah Obyek Warisan Budaya yang Dilestarikan', '%', '25.51', '25.53', 224000000, '25.55', 224423200, '25.58', 224440300, '25.62', 225798500, '25.67', 231848800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.22.06', 'PROGRAM PENGELOLAANPERMUSEUMAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Permuseuman', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persetase Jumlah Kunjungan Museum', '%', '12.52', '13', 554000000, '13.05', 555046800, '13.1', 555089000, '13.15', 558448600, '13.2', 573411900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.23', 'URUSAN PEMERINTAHAN BIDANGPERPUSTAKAAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.23.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan DaerahKabupaten/Kota', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '94', '95', 5359441203, '95', 5369567600, '96', 5369975500, '96', 5402476100, '96', 5547232800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perpustakaan dan Kearsipan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.23.02', 'PROGRAM PEMBINAANPERPUSTAKAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya kualitas Pengelolaan perpustakaan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Perpustakaan yang Terakreditasi', '%', '88.74', '89.9', 4435000000, '89.9', 4443379800, '89.1', 4443717200, '89.2', 4470611700, '89.3', 4590399700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perpustakaan dan Kearsipan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.23.03', 'PROGRAM PELESTARIAN KOLEKSI NASIONALDAN NASKAH KUNO', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pelestarian Koleksi Nasional dan NaskahKuno', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Koleksi Nasional dan Naskah Kuno yang di lestarikan', '%', '10.5', '39.19', 418000000, '40.54', 418789800, '41.89', 418821600, '43.24', 421356400, '43.24', 432646500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perpustakaan dan Kearsipan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '2.24', 'URUSANPEMERINTAHAN BIDANG KEARSIPAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.24.02', 'PROGRAMPENGELOLAAN ARSIP', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Arsip', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Tingkat Ketersediaan Arsip', '%', '95', '95.5', 4082000000, '96', 4089712800, '96.5', 4090023400, '97', 4114777200, '97.5', 4225030900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perpustakaan dan Kearsipan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '2.24.03', 'PROGRAM PERLINDUNGAN DAN PENYELAMATANARSIP', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya perlindungan dan penyelamatan arsip', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Perlindungan dan Penyelamatan Arsip', '%', '73', '75', 912000000, '76', 913723200, '77', 913792600, '78', 919323100, '79', 943955900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perpustakaan dan Kearsipan' LIMIT 1), 1, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 3: URUSAN PEMERINTAHAN PILIHAN
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '3', 'URUSAN PEMERINTAHAN PILIHAN', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '3.25', 'URUSAN PEMERINTAHAN BIDANG KELAUTANDAN PERIKANAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.25.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintah DaerahKabupaten/Kota', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92.5', '93.5', 6309551322, '94.5', 6321473000, '95.5', 6321952800, '96.5', 6360214900, '97.5', 6530633900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perikanan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.25.03', 'PROGRAM PENGELOLAAN PERIKANANTANGKAP', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Perikanan Tangkap Nelayan Kecil', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Volume produksi perikanan tangkap nelayan kecil', 'Ton', '21529', '24158', 1099000000, '24641', 1101076500, '25134', 1101160200, '25636', 1107824600, '26149', 1137508300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perikanan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.25.04', 'PROGRAM PENGELOLAAN PERIKANANBUDIDAYA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Perikanan Budidaya', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Volume produksi perikanan budidaya', 'Ton', '30047', '30995', 1581000000, '31200', 1583987200, '31410', 1584107400, '31630', 1593694700, '31792', 1636397000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perikanan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.25.05', 'PROGRAM PENGAWASAN SUMBER DAYAKELAUTAN DAN PERIKANAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengawasan pelaku Usaha perikanan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase jumlah pelaku usaha perikanan yang taat regulasi', '%', '0', '50', 684000000, '53', 685292400, '66', 685344400, '69', 689492300, '72', 707967000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perikanan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.25.06', 'PROGRAM PENGOLAHAN DAN PEMASARAN HASILPERIKANAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Produksi dan Pemasaran usaha olahan hasil perikanan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase peningkatan produksi UMK perikanan', '%', '0', '2.5', 734000000, '2.5', 735386800, '2.5', 735442600, '2.5', 739893600, '2.5', 759718700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perikanan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '3.26', 'URUSAN PEMERINTAHANBIDANG PARIWISATA', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.26.02', 'PROGRAM PENINGKATAN DAYA TARIK DESTINASIPARIWISATA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Daya Tarik Terhadap Destinasi Pariwisata', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Length of stay (Hari)', 'Hari', '2', '2', 1281000000, '2', 1283420400, '2', 1283518100, '2', 1291286400, '2', 1325885700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.26.03', 'PROGRAM PEMASARANPARIWISATA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemasaran Pariwisata', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Peningkatan kunjungan wisatawan', '%', '10', '12', 2058000000, '16', 2061888500, '19', 2062045100, '23', 2074525100, '26', 2130111100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.26.04', 'PROGRAM PENGEMBANGAN EKONOMI KREATIF MELALUI PEMANFAATAN DANPERLINDUNGAN HAK KEKAYAAN INTELEKTUAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Presentase Cakupan Pengembangan Ekonomi Kreatif', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase PeningkatanPendapatan Pelaku Ekraf', '%', '0.47', '0.5', 1360000000, '0.55', 1362569500, '0.59', 1362673000, '0.63', 1370920200, '0.67', 1407653500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.26.05', 'PROGRAM PENGEMBANGAN SUMBER DAYA PARIWISATA DAN EKONOMI KREATIF', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengembangan Sumber Daya Pariwisata dan Ekonomi Kreatif', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pelaku Ekonomi Kreatif yang Memiliki Kekayaan Intelektual', '%', '3.72', '4.2', 761000000, '4.4', 762437900, '4.6', 762495800, '4.8', 767110600, '5', 787665000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Kebudayaan dan Pariwisata' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '3.27', 'URUSANPEMERINTAHAN BIDANG PERTANIAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.27.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Dukungan Terhadap Pelaksanaan Urusan Pemerintahan PD', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '94.29', '95.29', 30970201646, '95.86', 31028718600, '96.43', 31031075200, '97', 31218883600, '97.57', 32055379800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.27.02', 'PROGRAM PENYEDIAAN DAN PENGEMBANGANSARANA PERTANIAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Pemanfaatan Sarana Produksi Pertanian', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan Produksi Tanaman Pangan', '%', '2.74', '2.76', 11921000000, '2.77', 11943524200, '2.78', 11944431100, '2.79', 12016722100, '2.8', 12338704900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan Produksi Hortikultura', '%', '11.54', '11.56', NULL, '11.57', 11943524200, '11.58', 11944431100, '11.59', 12016722100, '11.6', 12338704900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan produksi komoditas peternakan', '%', '-22.57', '1.3', NULL, '1.4', NULL, '1.5', NULL, '1.6', NULL, '1.7', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan produksi komoditas perkebunan', '%', '-1.21', '0.35', NULL, '0.4', NULL, '0.45', NULL, '0.5', NULL, '0.55', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 4, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.27.03', 'PROGRAM PENYEDIAAN DAN PENGEMBANGAN PRASARANAPERTANIAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Pemanfaatan Prasarana Produksi Pertanian', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penyediaan dan pengembangan prasarana pertanian mendukung tanamanpangan', '%', '100', '100', 26955750000, '100', 27006681700, '100', 27008732800, '100', 27172197100, '100', 27900264100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penyediaan dan pengembangan prasarana pertanian mendukung tanaman perkebunan danhortikultura', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penyediaan dan pengembangan prasarana pertanianmendukung peternakan', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase penyediaan dan pengembangan prasarana pertanian mendukung kesehatan hewan dan kesehatanmasyarakat veteriner', '%', '95.24', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 4, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.27.04', 'PROGRAM PENGENDALIAN KESEHATAN HEWAN DAN KESEHATAN MASYARAKATVETERINER', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kesehatan Hewan dan Kesehatan MasyarakatVeteriner', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase wilayah yang terkendali dari penyakit hewanmenular strategis', '%', '59', '71', 1660750000, '73', 1663888000, '75', 1664014300, '77', 1674085300, '79', 1718941700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Usaha produk hewan yang bersertifikasi PRA/NKV (Unit)', 'Unit', '19', '30', NULL, '34', NULL, '38', NULL, '42', NULL, '44', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.27.05', 'PROGRAM PENGENDALIAN DAN PENANGGULANGANBENCANA PERTANIAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Perlindungan Usaha Tani', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Luas areal pengendalian dan penanggulangan bencana DPI tanaman pangan, hortikulturadan perkebunan', '%', '76.52', '76.72', 6006000000, '76.82', 6017348100, '76.92', 6017805100, '77.02', 6054226400, '77.12', 6216446800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.27.07', 'PROGRAM PENYULUHAN PERTANIAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas SDM dan KelembagaanPertanian', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Cakupan bina kelompok petani', '%', '100', '100', 955500000, '100', 957305400, '100', 957378100, '100', 963172500, '100', 988980200, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Pertanian dan Pangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '3.30', 'URUSAN PEMERINTAHAN BIDANGPERDAGANGAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.30.02', 'PROGRAM PERIZINAN DAN PENDAFTARANPERUSAHAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pasar Tertib Niaga Melalui Fasilitas PerizinanUsaha Perdagangan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Izin Usaha Perdagangan yang Difasilitasi', '%', '100', '100', 266000000, '100', 266502500, '100', 266522700, '100', 268135800, '100', 275320400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.30.03', 'PROGRAM PENINGKATAN SARANA DISTRIBUSIPERDAGANGAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Sarana Distribusi Perdagangan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase sarana distribusi perdagangan yang mengalamipeningkatan Kualitas', '%', '20', '25', 1837000000, '35', 1840470900, '45', 1840610600, '55', 1851750500, '65', 1901367300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.30.04', 'PROGRAM STABILISASI HARGA BARANG KEBUTUHAN POKOK DAN BARANGPENTING', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Stabilisasi Harga Barang Kebutuhan Pokok dan BarangPenting', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase koefisien variasi harga antar waktu per komoditas bahan pokok', '%', '5.14', '5.13', 1735000000, '5.12', 1738278100, '5.11', 1738410100, '5.1', 1748931300, '5.1', 1795793100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.30.05', 'PROGRAM PENGEMBANGANEKSPOR', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Volume Ekspor', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Jumlah realisasi ekspor (dalam Juta U$$)', 'Angka', '175.5', '176.38', 302000000, '177.26', 302570600, '178.15', 302593600, '179.04', 304425000, '179.93', 312582000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.30.06', 'PROGRAM STANDARDISASI DAN PERLINDUNGANKONSUMEN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pasar Tertib Niaga', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase alat ukur takar timbang dan perlengkapannya (UTTP) bertanda tera sah yang berlaku', '%', '20.31', '20.5', 29000000, '20.75', 290547900, '21', 290570000, '21.25', 292328600, '21.5', 300161400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.30.07', 'PROGRAM PENGGUNAAN DAN PEMASARANPRODUK DALAM NEGERI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Volume Perdagangan Dalam Negeri', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Promosi Produk Lokal yang difasilitasi', '%', '12.93', '13.89', 73000000, '14.86', 73137900, '15.83', 73143500, '16.79', 73586200, '17.76', 75557900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Koperasi, Usaha Mikro dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '3.31', 'URUSAN PEMERINTAHAN BIDANGPERINDUSTRIAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.31.02', 'PROGRAM PERENCANAAN DAN PEMBANGUNANINDUSTRI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Perencanaan dan Pengembangan Industri', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pertumbuhan Nilai Produksi IKM', '%', '7.86', '8.5', 1593000000, '8.6', 1596010000, '8.7', 1596131100, '8.8', 1605791300, '8.9', 1648817900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perindustrian dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.31.03', 'PROGRAMPENGENDALIAN IZIN USAHA INDUSTRI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengendalian Izin Usaha Industri', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase realisasi investasi sektor industri dan kawasan industri dibandingkan realisasi investasi seluruh sektor', '%', '10.78', '10.89', 378000000, '10.95', 378714200, '11', 378743000, '11.06', 381035200, '11.12', 391244800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Perindustrian dan Perdagangan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.31.04', 'PROGRAM PENGELOLAANSISTEM INFORMASI INDUSTRI NASIONAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Sistem Informasi IndustriNasional', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pertumbuhan Nilai Produksi IKM', '%', '0.78', '1.4', 378000000, '1.55', 378714200, '1.63', 378743000, '1.77', 381035300, '1.86', 391245000, NULL, 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '3.32', 'URUSAN PEMERINTAHANBIDANG TRANSMIGRASI', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '3.32.03', 'PROGRAM PEMBANGUNAN KAWASANTRANSMIGRASI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pembangunan Kawasan Transmigrasi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Transmigran yang Menetap', '%', '100', '100', 399000000, '100', 399753900, '100', 399784300, '100', 402203900, '100', 412980800, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Dinas Tenaga Kerja' LIMIT 1), 1, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 4: UNSUR PENDUKUNG URUSAN PEMERINTAHAN
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '4', 'UNSUR PENDUKUNG URUSAN PEMERINTAHAN', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '4.01', 'SEKRETARIAT DAERAH', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '4.01.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan manajemen pelayanan pemerintah daerah', 'Nilai', '94.87', '94.89', 59004714835, '94.9', 59116201500, '94.92', 59120691100, '94.96', 59478505400, '94.98', 61072206100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan pelayanan Tamu', 'Nilai', '95.77', '95.82', NULL, '95.85', NULL, '95.9', NULL, '95.95', NULL, '96', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pelayanan Pimpinan', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Peningkatan Akuntabilitas Kinerja Instansi Pemerintah', 'Nilai', '90.13', '92', NULL, '93', NULL, '94', NULL, '95', NULL, '96', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 4, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Kepuasan Pemenuhan Sarana dan Prasarana Setda', '%', '90.8', '91.25', NULL, '91.5', NULL, '91.75', NULL, '91.9', NULL, '92', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 5, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Nilai SAKIP SETDA', 'Angka', '90.33', '90.65', NULL, '90.85', NULL, '91', NULL, '91.1', NULL, '91.25', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 6, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '4.01.02', 'PROGRAM PEMERINTAHAN DAN KESEJAHTERAANRAKYAT', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pemerintahan dan Kesejahteraan Rakyat', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'IKM Kesra', 'Indeks', '0', '90.25', 44844000000, '90.5', 44928731000, '90.75', 44932143100, '91', 45204084600, '92', 46415308300, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pemenuhan Indikator Kinerja Kunci PenyelenggaraanPemerintahan Daerah', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Reformasi Hukum', 'Indeks', '85', '89', NULL, '90', NULL, '91', NULL, '92', NULL, '93', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 3, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '4.01.03', 'PROGRAMPEREKONOMIAN DAN PEMBANGUNAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya perekonomian dan Pembangunan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Tata Kelola Pengadaan', 'Angka', '88.42', '88.48', 4743000000, '88.5', 4751961800, '88.53', 4752322800, '88.55', 4781085000, '88.58', 4909192200, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Tingkat Inflasi', '%', '1.73', '2.5', NULL, '2.5', NULL, '2.5', NULL, '2.5', NULL, '2.5', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat Daerah' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '4.02', 'SEKRETARIAT DPRD', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '4.02.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan DaerahKabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '100', '94.3', 48802303169, '96.1', 48894513200, '97.9', 48898226700, '99.7', 49194172000, '100', 50512308400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat DPRD' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '4.02.02', 'PROGRAM DUKUNGAN PELAKSANAAN TUGAS DAN FUNGSIDPRD', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya DukunganPelaksanaan Tugas dan Fungsi DPRD', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Penyelenggaraan Pengawasan Pemerintahan', '%', '84', '86', 26265000000, '87', 26314626700, '88', 26316625600, '89', 26475900800, '90', 27185310900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat DPRD' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Prosentase pemenuhan kebutuhan terhadap pelaksanaan tugasDPRD', '%', '90', '91.25', NULL, '91.5', NULL, '91.75', NULL, '92', NULL, '92.25', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat DPRD' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Prosentase pengesahan dokumen penganggaran yang di failitasi', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat DPRD' LIMIT 1), 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'prosentase pengesahan perda yang tepat waktu', '%', '66', '70', NULL, '71', NULL, '72', NULL, '73', NULL, '74', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Sekretariat DPRD' LIMIT 1), 4, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 5: UNSUR PENUNJANG URUSAN PEMERINTAHAN
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '5', 'UNSUR PENUNJANG URUSAN PEMERINTAHAN', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '5.01', 'PERENCANAAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.01.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan DaerahKabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '97.81', '100', 14360460999, '100', 14387594400, '100', 14388686900, '100', 14475771100, '100', 14863642900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Perencanaan Pembangunan Daerah' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.01.02', 'PROGRAM PERENCANAAN, PENGENDALIAN DAN EVALUASI PEMBANGUNANDAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan standar kualitas proses perencanaanpembangunan daerah', '%', '100', '100', 2210000000, '100', 2214175800, '100', 2214344000, '100', 2227745700, '100', 2287437000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Perencanaan Pembangunan Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Perangkat Daerah yang Kinerjanya (Tujuan danSasaran Renstra) Tercapai', '%', '66.67', '70.37', NULL, '72.22', NULL, '74.07', NULL, '75.93', NULL, '77.78', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Perencanaan Pembangunan Daerah' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.01.03', 'PROGRAM KOORDINASI DAN SINKRONISASI PERENCANAAN PEMBANGUNAN DAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Substansi Perencanaan Pembangunan Daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan standar kualitas substansi dokumen perencanaan pembangunan daerah', '%', '100', '100', 6535000000, '100', 6547347600, '100', 6547844700, '100', 6587474000, '100', 6763982600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Perencanaan Pembangunan Daerah' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '5.02', 'KEUANGAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.02.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan DaerahKabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '100', '94.3', 24640228858, '96.1', 24686785500, '97.9', 24688660700, '99.7', 24838082500, '100', 25503608000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '100', '94.3', NULL, '96.1', NULL, '97.9', NULL, '99.7', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.02.02', 'PROGRAM PENGELOLAANKEUANGAN DAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Tata Kelola Perbendaharaan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, '% Pelayanan Realisasi Penerimaan Keuangan', '%', '102.4', '100', 448451813901, '100', 466602975623, '100', 486151888739, '100', 513225439739, '100', 570229275498, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, '% Pelayanan Realisasi Pengeluaran Keuangan', '%', '92.6', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pelaporan Keuangan Daerah', 2, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan LKPD yang sesuai SAP dan tepat waktu', '%', '100', '100', 1384000000, '100', 1386614900, '100', 1386720000, '100', 1395112700, '100', 1432493900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'MeningkatnyaTata kelola Penganggaran Keuangan Daerah', 3, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Pemenuhan Dokumen Penganggaran tepat waktu', '%', '100', '100', 2247000000, '100', 2251245700, '100', 2251416700, '100', 2265042900, '100', 2325733600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.02.03', 'PROGRAM PENGELOLAAN BARANG MILIKDAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pengelolaan Barang Milik daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Presentase pemenuhan LBMD tepat waktu', '%', '92', '96', 1460000000, '97', 1462758600, '98', 1462869800, '99', 1471723500, '100', 1511157700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.02.04', 'PROGRAM PENGELOLAAN PENDAPATAN DAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pengelolaan Pendapatan Daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Kepatuhan Wajib Pajak', '%', '0', '92', 9301000000, '93', 9318573800, '94', 9319281500, '95', 9375684300, '96', 9626901600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Pengelolaan Keuangan dan Aset Daerah' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '5.03', 'KEPEGAWAIAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.03.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHANDAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintah DaerahKabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '85', '94.3', 20603828355, '96.1', 20642758400, '97.9', 20644326000, '99.7', 20769270900, '100', 21325774400, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kepegawaian, Pendidikan dan Pelatihan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.03.02', 'PROGRAM KEPEGAWAIANDAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pelaksanaan Manajemen ASN', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Nilai Indeks Implementasi NSPK manajemen ASN', '%', '85.08', '86.5', 3410000000, '87', 3416443000, '87.5', 3416702400, '88', 3437381100, '88.5', 3529484100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kepegawaian, Pendidikan dan Pelatihan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '5.04', 'PENDIDIKAN DAN PELATIHAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.04.02', 'PROGRAM PENGEMBANGAN SUMBER DAYAMANUSIA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Kualitas ASN', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase ASN yang meningkat kompetensinya', '%', '80', '83', 1640000000, '85', 1643098700, '88', 1643223500, '90', 1653168700, '93', 1697464600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kepegawaian, Pendidikan dan Pelatihan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '5.05', 'PENELITIAN DANPENGEMBANGAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '5.05.02', 'PROGRAM PENELITIAN DANPENGEMBANGAN DAERAH', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penelitian dan Pengembangan Daerah', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kajian kelitbangan yang sesuai dengan isu strategis daerah', '%', '80', '81.5', 1164000000, '82', 1166199200, '82.5', 1166287900, '83', 1173346600, '83.5', 1204786000, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Riset dan Inovasi Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Indeks Inovasi Daerah', 'Angka', '98.86', '88', NULL, '89', NULL, '90', NULL, '91', NULL, '92', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Riset dan Inovasi Daerah' LIMIT 1), 2, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 6: UNSUR PENGAWASAN URUSAN PEMERINTAHAN
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '6', 'UNSUR PENGAWASAN URUSAN PEMERINTAHAN', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '6.01', 'INSPEKTORAT DAERAH', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '6.01.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92.5', '93.5', 14031185430, '94.5', 14057696600, '95.5', 14058764200, '96.5', 14143851400, '97.5', 14522829600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '6.01.02', 'PROGRAMPENYELENGGARAAN PENGAWASAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penyelenggaraan Pengawasan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Tindak Lanjut Akuntabilitas Keuangan', '%', '100', '100', 8416000000, '100', 8431901700, '100', 8432542000, '100', 8483578000, '100', 8710891700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Tindak Lanjut Akuntabilitas Kinerja', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah' LIMIT 1), 2, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Tindak Lanjut Tatakelola Kinerja', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah' LIMIT 1), 3, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, '% TL Tatakelola Keuangan', '%', '100', '100', NULL, '100', NULL, '100', NULL, '100', NULL, '100', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah' LIMIT 1), 4, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '6.01.03', 'PROGRAM PERUMUSAN KEBIJAKAN,PENDAMPINGAN DAN ASISTENSI', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Perumusan Kebijakan, Pendampingan dan Asistensi', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase rekomendasi temuan yang selesai ditindaklanjuti Hasil Pemeriksaan BPKRI/APIP', '%', '61', '62', 4710000000, '63.5', 4718899300, '65.5', 4719257600, '68', 4747819800, '71.5', 4875035500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Inspektorat Daerah' LIMIT 1), 1, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 7: UNSUR KEWILAYAHAN
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '7', 'UNSUR KEWILAYAHAN', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '7.01', 'KECAMATAN', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '7.01.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHANDAERAH KABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '93.7', 88816686833, '94.9', 89037216433, '96.1', 89046097261, '97.3', 89753880591, '98.5', 92906338691, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '7.01.02', 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase Fasilitasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '82.5', '100', 4769643645, '100', 4769643645, '100', 4769643645, '100', 4769643645, '100', 4769643645, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase sarana prasarana kecamatan dan kelurahan dalamkondisi baik', '%', '75', '80', NULL, '82.5', NULL, '85', NULL, '87.5', NULL, '90', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '7.01.03', 'PROGRAM PEMBERDAYAAN MASYARAKAT DESADAN KELURAHAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase kegiatan pemberdayaan masyarakat yangterlaksana', '%', '27', '92', 22523882707, '93', 22523882707, '94', 22523882707, '95', 22523882707, '95', 22523882707, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '7.01.04', 'PROGRAM KOORDINASIKETENTRAMAN DAN KETERTIBAN UMUM', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kualitas Koordinasi Ketentraman danKetertiban Umum', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'PersentasePenyelesaian Pengaduan Masyarakat', '%', '100', '92', 306550505, '94', 306550505, '96', 306550505, '98', 306550505, '98', 306550505, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '7.01.06', 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHANDESA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatkan Kualitas Pembinaan danPengawasan Pemerintahan Desa', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu', '%', '90', '100', 298958198, '100', 298958198, '100', 298958198, '100', 298958198, '100', 298958198, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Kecamatan' LIMIT 1), 1, NOW(), NOW());

-- -----------------------------------------------------
-- URUSAN 8: UNSUR PEMERINTAHAN UMUM
-- -----------------------------------------------------
INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('35.10', '8', 'UNSUR PEMERINTAHAN UMUM', NOW(), NOW());
SET @urusan_id = LAST_INSERT_ID();

INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('35.10', @urusan_id, '8.01', 'KESATUAN BANGSA DANPOLITIK', NOW(), NOW());
SET @bidang_id = LAST_INSERT_ID();

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '8.01.01', 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAHKABUPATEN/KOTA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penunjang Urusan Pemerintahan Daerah Kabupaten', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '93.7', 5733476608, '94.9', 5744309800, '96.1', 5744746000, '97.3', 5779514600, '98.5', 5934373900, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '8.01.02', 'PROGRAM PENGUATAN IDEOLOGI PANCASILA DAN KARAKTERKEBANGSAAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Penguatan Ideologi Pancasila dan Karakter Kebangsaan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka potensi konflik SARA di masyarakat', 'Kejadian', '1', '0', 1625000000, '0', 1628070400, '0', 1628194100, '0', 1638048400, '0', 1681939100, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 1, NOW(), NOW());
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, '\"Presentase masyarakat yang memiliki wawasan kesabangsaan, Ideologi Pancasila dan IPOLEKSOSBUDHANKAM yang baik (nilai post test lebih dari 70) \"', '%', '70', '73', NULL, '75', NULL, '77', NULL, '79', NULL, '80', NULL, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 2, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '8.01.03', 'PROGRAM PENINGKATAN PERAN PARTAI POLITIK DAN LEMBAGA PENDIDIKAN MELALUI PENDIDIKAN POLITIK DAN PENGEMBANGAN ETIKA SERTABUDAYA POLITIK', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Peran Partai Politik dan Lembaga Pendidikan melalui Pendidikan Politik dan Pengembangan Etikaserta Budaya Politik', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Persentase peningkatan partisipasi politik di masyarakat', '%', '65', '69', 5290000000, '72', 5299995200, '75', 5300397700, '80', 5332477100, '83', 5475358500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '8.01.04', 'PROGRAM PEMBERDAYAAN DAN PENGAWASAN ORGANISASIKEMASYARAKATAN', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pemberdayaan dan Pengawasan OrganisasiKemasyarakatan', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Jumlah Organisasi Masyarakat yang dibina', 'Angka', '65', '69', 67000000, '72', 67126600, '75', 67131700, '80', 67538000, '83', 69347700, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '8.01.05', 'PROGRAM PEMBINAAN DAN PENGEMBANGAN KETAHANAN EKONOMI, SOSIAL,DAN BUDAYA', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Pembinaan dan PengembanganKetahanan Ekonomi, Sosial, dan Budaya', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka potensi konflik sosial dan budaya di masyarakat', 'Kejadian', '12', '10', 467000000, '8', 467882400, '6', 467918000, '4', 470750000, '2', 483363500, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 1, NOW(), NOW());

INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('35.10', @bidang_id, '8.01.06', 'PROGRAM PENINGKATAN KEWASPADAAN NASIONAL DAN PENINGKATAN KUALITAS DAN FASILITASIPENANGANAN KONFLIK SOSIAL', NOW(), NOW());
SET @prog_id = LAST_INSERT_ID();
INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, 'Meningkatnya Kewaspadaan Nasional, dan Meningkatnya Kualitas dan Fasilitasi KonflikSosial', 1, NOW(), NOW());
SET @outcome_id = LAST_INSERT_ID();
INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('35.10', @prog_id, @outcome_id, 'Angka potensi konflik ideologi,politik,ekonomi, pertahanan dan keamanan', 'Kejadian', '12', '10', 981000000, '8', 982853500, '6', 982928200, '4', 988877100, '2', 1015373600, (SELECT id FROM akun_instansi WHERE kodewilayah = '35.10' AND nama = 'Badan Kesatuan Bangsa dan Politik' LIMIT 1), 1, NOW(), NOW());

