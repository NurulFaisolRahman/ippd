-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: RSUD DR. ABDOER RAHEM
-- ID INSTANSI: 39 | KODE: 1.02.0.00.0.00.01.0001
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-24 12:15:23
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (RSUD DR. ABDOER RAHEM) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (39, '1.02.0.00.0.00.01.0001', '35.12', 'RUMAH SAKIT UMUM DAERAH (RSUD) DR. ABDOER RAHEM', '1.02', NULL, NULL, '$2y$10$yqul2j/opX14xi8WuNvjo.WOphh/E2KpbHg3X8qNeRL/0y2fxuhXq', 4, 2025, 2029, '2026-09-08 15:54:04', '2026-09-22 18:48:57', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA RSUD DR. ABDOER RAHEM SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (1423, 1424, 1425, 1426, 1427, 1428, 1429, 1430, 1431, 1432, 1433, 1434, 1435, 1436, 1437, 1438);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (1423, 1424, 1425, 1426, 1427, 1428, 1429, 1430, 1431, 1432, 1433, 1434, 1435, 1436, 1437, 1438);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (261, 262, 263, 264, 265, 266, 267, 268);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (261, 262, 263, 264, 265, 266, 267, 268);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (261, 262, 263, 264, 265, 266, 267, 268);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (105, 106, 107);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (105, 106, 107);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (105, 106, 107);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (55, 56, 57);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (55, 56, 57);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (21);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (21);
DELETE FROM `renstra_tujuan` WHERE `id` IN (21) OR (`id_instansi` = 39 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD RSUD DR. ABDOER RAHEM
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (21, '35.12', 39, '33', 'Meningkatnya Derajat Kesehatan Masyarakat', NULL, NULL, 'Usia Harapan Hidup (UHH)', 'Tahun', NULL, '73.79', '74.05', '74.3', '74.55', '74.8', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (35, 21, 39, 'Usia Harapan Hidup (UHH)', 'Tahun', '73.36', NULL, '73.79', '74.05', '74.3', '74.55', '74.8', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

-- Table: renstra_sasaran (3 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (55, 21, 'Meningkatnya Akuntabilitas Kinerja Rumah Sakit', NULL, NULL, 'Nilai SAKIP Rumah sakit', 'Nilai', NULL, '82.75', '83', '83.25', '83.5', '83.75', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (56, 21, 'Meningkatnya Aksesbilitas dan Kualitas Mutu Pelayanan Rumah Sakit', NULL, NULL, 'Persentase Sarana, Prasarana, dan Alat Kesehatan Rumah Sakit Sesuai Standart', '%', NULL, '64.5', '64.64999999999999', '64.8', '64.95', '65.10000000000001', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (57, 21, 'Meningkatnya Kualitas Sumber Daya Manusia Kesehatan di Rumah Sakit', NULL, NULL, 'Persentase Tercukupinya Kebutuhan SDM Kesehatan Rumah Sakit sesuai standar', '%', NULL, '', '90.5', '91', '91.5', '92', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (7 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (90, 55, NULL, 'Nilai SAKIP Rumah sakit', 'Nilai', '82.35', NULL, '82.75', '83', '83.25', '83.5', '83.75', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (91, 55, NULL, 'IKM (Indeks Kepuasan Masyarakat)', 'Nilai', '83.25', NULL, '85.25', '86.25', '87.25', '88.25', '89.25', 20, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (92, 56, NULL, 'Persentase Sarana, Prasarana, dan Alat Kesehatan Rumah Sakit Sesuai Standart', '%', '64', NULL, '64.5', '64.64999999999999', '64.8', '64.95', '65.10000000000001', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (93, 56, NULL, 'Persentase Indikator Nasional Mutu (INM) yang mencapai target', '%', '92.30000000000001', NULL, '92.9', '93.2', '93.5', '93.8', '94.1', 20, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (94, 56, NULL, 'Persentase Indikator Prioiritas Rumah Sakit (IMPRS) yang mencapai target', '%', '80', NULL, '80.60000000000001', '80.9', '81.2', '81.5', '81.8', 30, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (95, 56, NULL, 'Persentase Indikator Perunit Layanan yangmencapai target', '%', '92.9', NULL, '93.5', '93.8', '94.1', '94.4', '94.69999999999999', 40, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (96, 57, NULL, 'Persentase Tercukupinya Kebutuhan SDM Kesehatan Rumah Sakit sesuai standar', '%', '', NULL, '', '90.5', '91', '91.5', '92', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

-- Table: renstra_program (3 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (105, 55, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '1.02.01', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, 'Meningkatnya Akuntabilitas Kinerja Rumah Sakit', 'IKM (Indeks Kepuasan Masyarakat)', 'Nilai', NULL, '85.25', '86.25', '87.25', '88.25', '89.25', NULL, '80000000000.00', '84764500000.00', '87765500000.00', '90766500000.00', '92767500000.00'),
  (106, 56, 'PROGRAM PEMENUHAN UPAYA KESEHATAN PERORANGAN DAN UPAYA KESEHATAN MASYARAKAT', '1.02.02', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, 'Meningkatnya Aksesbilitas dan Kualitas Mutu Pelayanan Rumah Sakit', 'Persentase Sarana, Prasarana, dan Alat Kesehatan Rumah Sakit Sesuai Standart', '%', NULL, '64.5', '64.64999999999999', '64.8', '64.95', '65.10000000000001', NULL, '8082597203.00', '13572881316.00', '13708610130.00', '13845696231.00', '13984153193.00'),
  (107, 57, 'PROGRAM PENINGKATAN KAPASITAS SUMBER DAYA MANUSIA KESEHATAN', '1.02.03', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, NULL, 'Meningkatnya Kualitas Sumber Daya Manusia Kesehatan di Rumah Sakit', 'Persentase Tercukupinya Kebutuhan SDM Kesehatan Rumah Sakit sesuai standar', '%', NULL, '', '90.5', '91', '91.5', '92', NULL, '0.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00');

-- Table: renstra_program_outcome (3 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (149, 105, 'Meningkatnya Akuntabilitas Kinerja Rumah Sakit', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (150, 106, 'Meningkatnya Aksesbilitas dan Kualitas Mutu Pelayanan Rumah Sakit', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (151, 107, 'Meningkatnya Kualitas Sumber Daya Manusia Kesehatan di Rumah Sakit', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

-- Table: renstra_program_indikator (7 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (238, 105, 149, 39, 'IKM (Indeks Kepuasan Masyarakat)', 'Nilai', '83.25', '85.25', '86.25', '87.25', '88.25', '89.25', '80000000000.00', '84764500000.00', '87765500000.00', '90766500000.00', '92767500000.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 10),
  (239, 105, 149, 39, 'Nilai SAKIP Rumah Sakit', 'Nilai', '82.35', '82.75', '83', '83.25', '83.5', '83.75', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 20),
  (240, 106, 150, 39, 'Persentase Sarana, Prasarana, dan Alat Kesehatan Rumah Sakit Sesuai Standart', '%', '64', '64.5', '64.64999999999999', '64.8', '64.95', '65.10000000000001', '8082597203.00', '13572881316.00', '13708610130.00', '13845696231.00', '13984153193.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 10),
  (241, 106, 150, 39, 'Persentase Indikator Nasional Mutu (INM) yang mencapai target', '%', '92.30000000000001', '92.9', '93.2', '93.5', '93.8', '94.1', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 20),
  (242, 106, 150, 39, 'Persentase Indikator Prioiritas Rumah Sakit (IMPRS) yang mencapai target', '%', '80', '80.60000000000001', '80.9', '81.2', '81.5', '81.8', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 30),
  (243, 106, 150, 39, 'Persentase Indikator Perunit Layanan yangmencapai target', '%', '92.9', '93.5', '93.8', '94.1', '94.4', '94.69999999999999', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 40),
  (244, 107, 151, 39, 'Persentase Tercukupinya Kebutuhan SDM Kesehatan Rumah Sakit sesuai standar', '%', '', '', '90.5', '91', '91.5', '92', '0.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00', '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 10);

-- Table: renstra_kegiatan (8 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (261, 105, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '1.02.01.2.01', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 'Persentase terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', NULL, '100', '100', '100', '100', '100', NULL, '0.00', '12500000.00', '12500000.00', '12500000.00', '12500000.00'),
  (262, 105, 'Administrasi Keuangan Perangkat Daerah', '1.02.01.2.02', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Administrasi Keuangan Perangkat Daerah', 'Persentase terlaksananya
Administrasi Keuangan Perangkat Daerah', '%', NULL, '', '100', '100', '100', '100', NULL, '0.00', '96000000.00', '97000000.00', '98000000.00', '99000000.00'),
  (263, 105, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '1.02.01.2.07', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Persentase Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '%', NULL, '', '100', '100', '100', '100', NULL, '0.00', '1500000000.00', '1500000000.00', '1500000000.00', '1500000000.00'),
  (264, 105, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '1.02.01.2.08', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Jasa Penunjang Urusan Pemerintahan Daerah', 'Persentase tersedianya jasa penunjang perangkat daerah', '%', NULL, '', '100', '100', '100', '100', NULL, '0.00', '156000000.00', '156000000.00', '156000000.00', '156000000.00'),
  (265, 105, 'Peningkatan Pelayanan BLUD', '1.02.01.2.10', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Peningkatan Pelayanan BLUD', 'Persentase Cost Recovery Rate', '%', NULL, '90', '92', '94', '96', '98', NULL, '80000000000.00', '83000000000.00', '86000000000.00', '89000000000.00', '91000000000.00'),
  (266, 106, 'Penyediaan Fasilitas Pelayanan Kesehatan untuk UKM dan UKP Kewenangan Daerah Kabupaten/Kota', '1.02.02.2.01', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Fasilitas Pelayanan Kesehatan untuk UKM dan UKP Kewenangan Daerah Kabupaten/Kota', 'Persentase Kelengkapan Sarana Rumah Sakit Sesuai Standar', '%', NULL, '71.5', '71.75', '72', '72.25', '72.5', NULL, '8082597203.00', '13572881316.00', '13708610130.00', '13845696231.00', '13984153193.00'),
  (267, 107, 'Perencanaan Kebutuhan dan Pendayagunaan Sumber Daya Manusia Kesehatan untuk UKP dan UKM di Wilayah Kabupaten/Kota', '1.02.03.2.02', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Perencanaan Kebutuhan dan Pendayagunaan Sumber Daya Manusia Kesehatan untuk UKP dan UKM di Wilayah Kabupaten/Kota', 'Jumlah dokumen analisa rencana kebutuhan SDM Kesehatan yang ter update', 'orang', NULL, '', '360', '370', '380', '390', NULL, '0.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (268, 107, 'Pengembangan Mutu dan Peningkatan Kompetensi Teknis Sumber Daya Manusia Kesehatan Tingkat Daerah Kabupaten/Kota', '1.02.03.2.03', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pengembangan Mutu dan Peningkatan Kompetensi Teknis Sumber Daya Manusia Kesehatan Tingkat Daerah Kabupaten/Kota', 'Jumlah SDM Kesehatan Rumah Sakit sesuai standar', 'orang', NULL, '', '25', '25', '25', '25', NULL, '0.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00');

-- Table: renstra_kegiatan_sasaran (8 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (274, 261, 'Terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (275, 262, 'Terlaksananya Administrasi Keuangan Perangkat Daerah', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (276, 263, 'Tersedianya Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (277, 264, 'Tersedianya Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (278, 265, 'Terlaksananya Peningkatan Pelayanan BLUD', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (279, 266, 'Tersedianya Fasilitas Pelayanan Kesehatan untuk UKM dan UKP Kewenangan Daerah Kabupaten/Kota', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (280, 267, 'Terlaksananya Perencanaan Kebutuhan dan Pendayagunaan Sumber Daya Manusia Kesehatan untuk UKP dan UKM di Wilayah Kabupaten/Kota', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (281, 268, 'Terlaksananya Pengembangan Mutu dan Peningkatan Kompetensi Teknis Sumber Daya Manusia Kesehatan Tingkat Daerah Kabupaten/Kota', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

-- Table: renstra_kegiatan_indikator (10 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1371, 261, 274, 39, 'Persentase terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', '100', '100', '0.00', '100', '12500000.00', '100', '12500000.00', '100', '12500000.00', '100', '12500000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1372, 262, 275, 39, 'Persentase terlaksananya
Administrasi Keuangan Perangkat Daerah', '%', '', '', '0.00', '100', '96000000.00', '100', '97000000.00', '100', '98000000.00', '100', '99000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1373, 263, 276, 39, 'Persentase Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '%', '', '', '0.00', '100', '1500000000.00', '100', '1500000000.00', '100', '1500000000.00', '100', '1500000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1374, 264, 277, 39, 'Persentase tersedianya jasa penunjang perangkat daerah', '%', '', '', '0.00', '100', '156000000.00', '100', '156000000.00', '100', '156000000.00', '100', '156000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1375, 265, 278, 39, 'Persentase Cost Recovery Rate', '%', '', '90', '80000000000.00', '92', '83000000000.00', '94', '86000000000.00', '96', '89000000000.00', '98', '91000000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1376, 266, 279, 39, 'Persentase Kelengkapan Sarana Rumah Sakit Sesuai Standar', '%', '70.25', '71.5', '8082597203.00', '71.75', '13572881316.00', '72', '13708610130.00', '72.25', '13845696231.00', '72.5', '13984153193.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1377, 266, 279, 39, 'Persentase Kelengkapan Prasarana Rumah Sakit
Sesuai Standar', '%', '73.25', '74.5', '0.00', '74.75', '0.00', '75', '0.00', '75.25', '0.00', '75.5', '0.00', 20, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1378, 266, 279, 39, 'Persentase Kelengkapan Alat Kesehatan Rumah Sakit
Sesuai Standar', '%', '30.84', '37', '0.00', '37.5', '0.00', '38', '0.00', '38.5', '0.00', '39', '0.00', 30, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1379, 267, 280, 39, 'Jumlah dokumen analisa rencana kebutuhan SDM Kesehatan yang ter update', 'orang', '', '', '0.00', '360', '100000000.00', '370', '100000000.00', '380', '100000000.00', '390', '100000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1380, 268, 281, 39, 'Jumlah SDM Kesehatan Rumah Sakit sesuai standar', 'orang', '', '', '0.00', '25', '100000000.00', '25', '100000000.00', '25', '100000000.00', '25', '100000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

-- Table: renstra_sub_kegiatan (16 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1423, 261, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '1.02.01.2.01.0001', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '', '4', '4', '4', '4', NULL, '0.00', '4500000.00', '4500000.00', '4500000.00', '4500000.00'),
  (1424, 261, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '1.02.01.2.01.0006', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan
Ikhtisar Realisasi Kinerja SKPD', 'Dokumen', NULL, '', '3', '3', '3', '3', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (1425, 261, 'Penyusunan Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', '1.02.01.2.01.0011', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersusunnya Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', 'Jumlah Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD yang disusun', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (1426, 262, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '1.02.01.2.02.0002', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah Dokumen Hasil
Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '0.00', '96000000.00', '97000000.00', '98000000.00', '99000000.00'),
  (1427, 263, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '1.02.01.2.07.0009', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang
Disediakan', 'unit', NULL, '', '1', '1', '1', '1', NULL, '0.00', '1500000000.00', '1500000000.00', '1500000000.00', '1500000000.00'),
  (1428, 264, 'Penyediaan Jasa Pelayanan Umum Kantor', '1.02.01.2.08.0004', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah   Laporan   Penyediaan Jasa   Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '', '12', '12', '12', '12', NULL, '0.00', '156000000.00', '156000000.00', '156000000.00', '156000000.00'),
  (1429, 265, 'Pelayanan dan Penunjang Pelayanan BLUD', '1.02.01.2.10.0001', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pelayanan dan Penunjang Pelayanan BLUD', 'Jumlah BLUD yang Menyediakan Pelayanan dan
Penunjang Pelayanan', 'unit', NULL, '24', '24', '24', '24', '24', NULL, '80000000000.00', '83000000000.00', '86000000000.00', '89000000000.00', '91000000000.00'),
  (1430, 266, 'Pembangunan Rumah Sakit beserta Sarana dan Prasarana Pendukungnya', '1.02.02.2.01.0001', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pembangunan Rumah Sakit beserta Sarana dan Prasarana Pendukungnya', 'Jumlah Rumah Sakit Baru yang Memenuhi Rasio Tempat Tidur Terhadap Jumlah
Penduduk Minimal 1:1000', 'unit', NULL, '2', '1', '1', '1', '1', NULL, '1701246000.00', '1500000000.00', '1500000000.00', '1500000000.00', '1500000000.00'),
  (1431, 266, 'Pengembangan Fasilitas Kesehatan Lainnya', '1.02.02.2.01.0007', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pengembangan Fasilitas Kesehatan Lainnya', 'Jumlah Fasilitas Kesehatan Lainnya yang Ditingkatkan Sarana, Prasarana, Alat Kesehatan dan SDM agar
Sesuai Standar', 'unit', NULL, '', '1', '1', '1', '1', NULL, '0.00', '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00'),
  (1432, 266, 'Rehabilitasi dan Pemeliharaan Rumah Sakit', '1.02.02.2.01.0008', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Rehabilitasi dan Pemeliharaan Rumah Sakit', 'Jumlah Sarana, Prasarana dan Alat Kesehatan yang Telah Dilakukan Program Rehabilitasi dan Pemeliharaan
Oleh Rumah Sakit', 'unit', NULL, '3', '1', '1', '1', '1', NULL, '4886961950.00', '1500000000.00', '1500000000.00', '1500000000.00', '1500000000.00'),
  (1433, 266, 'Pengadaan Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan', '1.02.02.2.01.0014', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan', 'Jumlah Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan yang Disediakan', 'unit', NULL, '10', '8', '9', '9', '11', NULL, '1493389253.00', '4322881316.00', '4208610130.00', '4095696231.00', '3984153193.00'),
  (1434, 266, 'Pemeliharaan Rutin dan Berkala Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan', '1.02.02.2.01.0020', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pemeliharaan Rutin dan Berkala Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan', 'Jumlah Alat Kesehatan/Alat Penunjang Medik Fasilitas Layanan Kesehatan yang Terpelihara Sesuai Standar', 'unit', NULL, '', '2', '2', '1', '1', NULL, '0.00', '1250000000.00', '1500000000.00', '1750000000.00', '2000000000.00'),
  (1435, 266, 'Pengembangan Rumah Sakit', '1.02.02.2.01.0022', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pengembangan Rumah Sakit', 'Jumlah Rumah sakit yang ditingkatkan  sarana, prasarana, alat kesehatan  dan SDM agar sesuai standar jenis pelayanan rumah sakit berdasarkan kelas rumah sakit yang memenuhi rasio tempat tidur terhadap jumlah penduduk minimal 1:1000 dan/atau dalam rangka peningkatan kapasitas
pelayanan rumah sakit', 'unit', NULL, '1', '1', '1', '1', '1', NULL, '1000000.00', '1500000000.00', '1500000000.00', '1500000000.00', '1500000000.00'),
  (1436, 266, 'Pengadaan Obat, Bahan Habis Pakai, Bahan Medis Habis Pakai,, Vaksin, Makanan dan Minuman di Fasilitas Kesehatan', '1.02.02.2.01.0023', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Tersedianya Obat, Bahan Habis Pakai, Bahan Medis Habis Pakai,, Vaksin, Makanan dan Minuman di Fasilitas Kesehatan', 'Jumlah Obat, Bahan Habis Pakai, Bahan Medis Habis Pakai, Vaksin, Makanan dan Minuman di Fasilitas Kesehatan  yang disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '2500000000.00', '2500000000.00', '2500000000.00', '2500000000.00'),
  (1437, 267, 'Pemenuhan Kebutuhan Sumber Daya Manusia Kesehatan Sesuai Standar', '1.02.03.2.02.0002', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Pemenuhan Kebutuhan Sumber Daya Manusia Kesehatan Sesuai Standar', 'Jumlah Sumber Daya Manusia Kesehatan yang Memenuhi Standar di Fasilitas Pelayanan
Kesehatan (Fasyankes)', 'orang', NULL, '', '360', '370', '380', '390', NULL, '0.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (1438, 268, 'Peningkatan kompetensi dan kualifikasi Sumber Daya Manusia Kesehatan', '1.02.03.2.03.0001', NULL, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL, 'Terlaksananya Peningkatan kompetensi dan kualifikasi Sumber Daya Manusia Kesehatan', 'Jumlah SDM Kesehatan yang mendapat peningkatan kompetensi', 'orang', NULL, '', '25', '25', '25', '25', NULL, '0.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00');

-- Table: renstra_sub_kegiatan_sasaran (16 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1455, 1423, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1456, 1424, 'Terlaksananya Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1457, 1425, 'Tersusunnya Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1458, 1426, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1459, 1427, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1460, 1428, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1461, 1429, 'Terlaksananya Pelayanan dan Penunjang Pelayanan BLUD', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1462, 1430, 'Terlaksananya Pembangunan Rumah Sakit beserta Sarana dan Prasarana Pendukungnya', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1463, 1431, 'Terlaksananya Pengembangan Fasilitas Kesehatan Lainnya', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1464, 1432, 'Terlaksananya Rehabilitasi dan Pemeliharaan Rumah Sakit', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1465, 1433, 'Tersedianya Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1466, 1434, 'Terlaksananya Pemeliharaan Rutin dan Berkala Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1467, 1435, 'Terlaksananya Pengembangan Rumah Sakit', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1468, 1436, 'Tersedianya Obat, Bahan Habis Pakai, Bahan Medis Habis Pakai,, Vaksin, Makanan dan Minuman di Fasilitas Kesehatan', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1469, 1437, 'Terlaksananya Pemenuhan Kebutuhan Sumber Daya Manusia Kesehatan Sesuai Standar', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1470, 1438, 'Terlaksananya Peningkatan kompetensi dan kualifikasi Sumber Daya Manusia Kesehatan', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

-- Table: renstra_sub_kegiatan_indikator (16 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1519, 1423, 1455, 39, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '', '', '0.00', '4', '4500000.00', '4', '4500000.00', '4', '4500000.00', '4', '4500000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1520, 1424, 1456, 39, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan
Ikhtisar Realisasi Kinerja SKPD', 'Dokumen', '3', '', '0.00', '3', '3000000.00', '3', '3000000.00', '3', '3000000.00', '3', '3000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1521, 1425, 1457, 39, 'Jumlah Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD yang disusun', 'Dokumen', '', '', '0.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1522, 1426, 1458, 39, 'Jumlah Dokumen Hasil
Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '1', '', '0.00', '12', '96000000.00', '12', '97000000.00', '12', '98000000.00', '12', '99000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1523, 1427, 1459, 39, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang
Disediakan', 'unit', '', '', '0.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1524, 1428, 1460, 39, 'Jumlah   Laporan   Penyediaan Jasa   Pelayanan Umum Kantor yang Disediakan', 'Laporan', '', '', '0.00', '12', '156000000.00', '12', '156000000.00', '12', '156000000.00', '12', '156000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1525, 1429, 1461, 39, 'Jumlah BLUD yang Menyediakan Pelayanan dan
Penunjang Pelayanan', 'unit', '19', '24', '80000000000.00', '24', '83000000000.00', '24', '86000000000.00', '24', '89000000000.00', '24', '91000000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1526, 1430, 1462, 39, 'Jumlah Rumah Sakit Baru yang Memenuhi Rasio Tempat Tidur Terhadap Jumlah
Penduduk Minimal 1:1000', 'unit', '46', '2', '1701246000.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1527, 1431, 1463, 39, 'Jumlah Fasilitas Kesehatan Lainnya yang Ditingkatkan Sarana, Prasarana, Alat Kesehatan dan SDM agar
Sesuai Standar', 'unit', '', '', '0.00', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1528, 1432, 1464, 39, 'Jumlah Sarana, Prasarana dan Alat Kesehatan yang Telah Dilakukan Program Rehabilitasi dan Pemeliharaan
Oleh Rumah Sakit', 'unit', '2', '3', '4886961950.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1529, 1433, 1465, 39, 'Jumlah Alat Kesehatan/Alat Penunjang Medik Fasilitas Pelayanan Kesehatan yang Disediakan', 'unit', '1432', '10', '1493389253.00', '8', '4322881316.00', '9', '4208610130.00', '9', '4095696231.00', '11', '3984153193.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1530, 1434, 1466, 39, 'Jumlah Alat Kesehatan/Alat Penunjang Medik Fasilitas Layanan Kesehatan yang Terpelihara Sesuai Standar', 'unit', '', '', '0.00', '2', '1250000000.00', '2', '1500000000.00', '1', '1750000000.00', '1', '2000000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1531, 1435, 1467, 39, 'Jumlah Rumah sakit yang ditingkatkan  sarana, prasarana, alat kesehatan  dan SDM agar sesuai standar jenis pelayanan rumah sakit berdasarkan kelas rumah sakit yang memenuhi rasio tempat tidur terhadap jumlah penduduk minimal 1:1000 dan/atau dalam rangka peningkatan kapasitas
pelayanan rumah sakit', 'unit', '', '1', '1000000.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', '1', '1500000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1532, 1436, 1468, 39, 'Jumlah Obat, Bahan Habis Pakai, Bahan Medis Habis Pakai, Vaksin, Makanan dan Minuman di Fasilitas Kesehatan  yang disediakan', 'Paket', '1', '1', '0.00', '1', '2500000000.00', '1', '2500000000.00', '1', '2500000000.00', '1', '2500000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1533, 1437, 1469, 39, 'Jumlah Sumber Daya Manusia Kesehatan yang Memenuhi Standar di Fasilitas Pelayanan
Kesehatan (Fasyankes)', 'orang', '', '', '0.00', '360', '100000000.00', '370', '100000000.00', '380', '100000000.00', '390', '100000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL),
  (1534, 1438, 1470, 39, 'Jumlah SDM Kesehatan yang mendapat peningkatan kompetensi', 'orang', '', '', '0.00', '25', '100000000.00', '25', '100000000.00', '25', '100000000.00', '25', '100000000.00', 10, '2026-09-24 12:14:57', '2026-09-24 12:14:57', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
