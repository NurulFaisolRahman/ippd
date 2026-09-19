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

