-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN GENTENG
-- ID INSTANSI: 127 | KODE: 7.01.0.00.0.00.15.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-27 22:20:41
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN GENTENG) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (127, '7.01.0.00.0.00.15.000', '35.10', 'Kecamatan Genteng', '7.01', NULL, NULL, '$2y$10$IszFJx3UasCeZmpsYgvRceZC2AgNgrfGFZG/ovvwdIUg3ZZ76llW.', 4, 2025, 2029, '2026-09-21 16:28:36', '2026-09-27 22:20:29', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN GENTENG SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2459, 2460, 2461, 2462, 2463, 2464, 2465, 2466, 2467, 2468, 2469, 2470, 2471, 2472, 2473, 2474, 2475, 2476, 2477, 2478, 2479, 2480, 2481, 2482, 2483, 2484, 2485, 2486, 2487, 2488, 2489);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2459, 2460, 2461, 2462, 2463, 2464, 2465, 2466, 2467, 2468, 2469, 2470, 2471, 2472, 2473, 2474, 2475, 2476, 2477, 2478, 2479, 2480, 2481, 2482, 2483, 2484, 2485, 2486, 2487, 2488, 2489);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (201, 202, 203, 204, 205);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (201, 202, 203, 204, 205);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (201, 202, 203, 204, 205);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (103, 104);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (103, 104);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (38);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (38);
DELETE FROM `renstra_tujuan` WHERE `id` IN (38) OR (`id_instansi` = 127 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN GENTENG
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (38, '35.10', 127, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (55, 38, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (103, 38, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (104, 38, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (152, 103, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (153, 104, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (201, 103, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, '95.5', '96', '96.5', '97', '97', NULL, '2500104280.00', '2506109173.00', '2506350993.00', '2525623524.00', '2611463134.00'),
  (202, 104, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194281150.00', '194281150.00', '194281150.00', '194281150.00', '194281150.00'),
  (203, 104, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '458869750.00', '458869750.00', '458869750.00', '458869750.00', '458869750.00'),
  (204, 104, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '17392400.00', '17392400.00', '17392400.00', '17392400.00', '17392400.00'),
  (205, 104, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '7454000.00', '7454000.00', '7454000.00', '7454000.00', '7454000.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (247, 201, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (248, 202, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (249, 203, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (250, 204, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (251, 205, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (370, 201, 247, 127, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '95', '95.5', '96', '96.5', '97', '97', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 10),
  (371, 202, 248, 127, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 10),
  (372, 203, 249, 127, 'Persentase kegiatan pemberdayaan masyarakat yang terlaksana', '%', '91', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 10),
  (373, 204, 250, 127, 'Persentase Penyelesaian Pengaduan Masyarakat', '%', '90', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 10),
  (374, 205, 251, 127, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (633, 201, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '3999900.00', '3999900.00', '3999900.00', '3999900.00', '3999900.00'),
  (634, 201, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '95', NULL, '2090918730.00', '2090918730.00', '2090918730.00', '2090918730.00', '2090918730.00'),
  (635, 201, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '144403500.00', '144403500.00', '144403500.00', '144403500.00', '144403500.00'),
  (636, 201, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '91', '', '93', '', '95', NULL, '21228450.00', '0.00', '20000000.00', '0.00', '142087304.00'),
  (637, 201, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '211356500.00', '211356500.00', '211356500.00', '211356500.00', '211356500.00'),
  (638, 201, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '95', NULL, '28197200.00', '55430543.00', '35672363.00', '74944894.00', '18697200.00'),
  (639, 202, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '114281150.00', '114281150.00', '114281150.00', '114281150.00', '114281150.00'),
  (640, 202, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (641, 203, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '438869750.00', '438869750.00', '438869750.00', '438869750.00', '438869750.00'),
  (642, 203, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '84', '86', '88', '90', '90', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (643, 204, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '17392400.00', '17392400.00', '17392400.00', '17392400.00', '17392400.00'),
  (644, 205, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '7454000.00', '7454000.00', '7454000.00', '7454000.00', '7454000.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (688, 633, 'Meningkatnya Ketepatan Penyusunan Perencanaan dan Evaluasi PD', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (689, 634, 'Meningkatnya Administrasi Keuangan Perangkat Daerah', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (690, 635, 'Meningkatnya Administrasi Umum Perangkat Daerah', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (691, 636, 'Tersedianya sarana dan prasarana', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (692, 637, 'Tersedianya Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (693, 638, 'Terpeliharanya sarana dan prasarana', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (694, 639, 'Terlaksananya Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (695, 640, 'Terlaksananya Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (696, 641, 'Terselenggaranya Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (697, 642, 'Terselenggaranya Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (698, 643, 'Terselenggaranya Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (699, 644, 'Terlaksananya Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

-- Table: renstra_kegiatan_indikator (12 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2380, 633, 688, 127, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', '100', '100', '3999900.00', '100', '3999900.00', '100', '3999900.00', '100', '3999900.00', '100', '3999900.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2381, 634, 689, 127, 'Cakupan Administrasi Keuangan Perangkat Daerah', '%', '90', '91', '2090918730.00', '92', '2090918730.00', '93', '2090918730.00', '94', '2090918730.00', '95', '2090918730.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2382, 635, 690, 127, 'Cakupan Administrasi Umum Perangkat Daerah', '%', '100', '100', '144403500.00', '100', '144403500.00', '100', '144403500.00', '100', '144403500.00', '100', '144403500.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2383, 636, 691, 127, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '%', '90', '91', '21228450.00', '', '0.00', '93', '20000000.00', '', '0.00', '95', '142087304.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2384, 637, 692, 127, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '%', '100', '100', '211356500.00', '100', '211356500.00', '100', '211356500.00', '100', '211356500.00', '100', '211356500.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2385, 638, 693, 127, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '%', '90', '91', '28197200.00', '92', '55430543.00', '93', '35672363.00', '94', '74944894.00', '95', '18697200.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2386, 639, 694, 127, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '%', '100', '100', '114281150.00', '100', '114281150.00', '100', '114281150.00', '100', '114281150.00', '100', '114281150.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2387, 640, 695, 127, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '%', '100', '100', '80000000.00', '100', '80000000.00', '100', '80000000.00', '100', '80000000.00', '100', '80000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2388, 641, 696, 127, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', '%', '100', '100', '438869750.00', '100', '438869750.00', '100', '438869750.00', '100', '438869750.00', '100', '438869750.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2389, 642, 697, 127, 'Cakupan Kegiatan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '%', '82', '84', '20000000.00', '86', '20000000.00', '88', '20000000.00', '90', '20000000.00', '90', '20000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2390, 643, 698, 127, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '', '4', '4', '17392400.00', '4', '17392400.00', '4', '17392400.00', '4', '17392400.00', '4', '17392400.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2391, 644, 699, 127, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '%', '100', '100', '7454000.00', '100', '7454000.00', '100', '7454000.00', '100', '7454000.00', '100', '7454000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

-- Table: renstra_sub_kegiatan (31 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2459, 633, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2499900.00', '2499900.00', '2499900.00', '2499900.00', '2499900.00'),
  (2460, 633, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersusunnya Dokumen Laporan Capaian Kinerja', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (2461, 634, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Penyediaan Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang / Bulan', NULL, '12', '12', '12', '12', '12', NULL, '2090918730.00', '2090918730.00', '2090918730.00', '2090918730.00', '2090918730.00'),
  (2462, 635, 'Penyediaan Komponen Instalasi Listrik/ Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Komponen Instalasi Listrik/ Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '7997100.00', '7997100.00', '7997100.00', '7997100.00', '7997100.00'),
  (2463, 635, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '49956400.00', '49956400.00', '49956400.00', '49956400.00', '49956400.00'),
  (2464, 635, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '8000000.00', '8000000.00', '8000000.00', '8000000.00', '8000000.00'),
  (2465, 635, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '9990000.00', '9990000.00', '9990000.00', '9990000.00', '9990000.00'),
  (2466, 635, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '6000000.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (2467, 635, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terselenggaranya Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '62460000.00', '62460000.00', '62460000.00', '62460000.00', '62460000.00'),
  (2468, 636, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '', '', '2', '', '', NULL, '0.00', '0.00', '20000000.00', '0.00', '0.00'),
  (2469, 636, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', NULL, '5', '', '', '', '', NULL, '21228450.00', '0.00', '0.00', '0.00', '0.00'),
  (2470, 636, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '97087304.00'),
  (2471, 636, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '30000000.00'),
  (2472, 636, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '15000000.00'),
  (2473, 637, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2000000.00', '2000000.00', '2000000.00', '2000000.00'),
  (2474, 637, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '75356500.00', '75356500.00', '75356500.00', '75356500.00', '75356500.00'),
  (2475, 637, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '5000000.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (2476, 637, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '129000000.00', '129000000.00', '129000000.00', '129000000.00', '129000000.00'),
  (2477, 638, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '7.01.01.2.09.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '6', '6', '6', '6', '6', NULL, '18697200.00', '18697200.00', '18697200.00', '18697200.00', '18697200.00'),
  (2478, 638, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'Unit', NULL, '', '', '', '10', '', NULL, '0.00', '0.00', '0.00', '20000000.00', '0.00'),
  (2479, 638, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '5', '', '', '', '', NULL, '9500000.00', '0.00', '0.00', '0.00', '0.00'),
  (2480, 638, 'Pemeliharaan/ Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '', '', '1', '', NULL, '0.00', '0.00', '0.00', '36247694.00', '0.00'),
  (2481, 638, 'Pemeliharaan/ Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Pemeliharaan/ Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/ Direhabilitasi', 'Unit', NULL, '', '1', '', '', '', NULL, '0.00', '36733343.00', '0.00', '0.00', '0.00'),
  (2482, 638, 'Pemeliharaan/ Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Pemeliharaan/ Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/ Direhabilitasi', 'Unit', NULL, '', '', '1', '', '', NULL, '0.00', '0.00', '16975163.00', '0.00', '0.00'),
  (2483, 639, 'Koordinasi/ Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Laporan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '114281150.00', '114281150.00', '114281150.00', '114281150.00', '114281150.00'),
  (2484, 640, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Tersedianya Laporan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (2485, 641, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terselenggaranya Musrenbang Desa/ Kelurahan', 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (2486, 641, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terselenggaranya Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '428869750.00', '428869750.00', '428869750.00', '428869750.00', '428869750.00'),
  (2487, 642, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Fasilitasi Penyelenggaraan Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan (Lembaga Kemasyarakatan)', 'Lembaga', NULL, '1157', '1157', '1157', '1157', '1157', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2488, 643, 'Koordinasi/ Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terselenggaranya Koordinasi/ Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '17392400.00', '17392400.00', '17392400.00', '17392400.00', '17392400.00'),
  (2489, 644, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '10', '10', '10', '10', '10', NULL, '7454000.00', '7454000.00', '7454000.00', '7454000.00', '7454000.00');

-- Table: renstra_sub_kegiatan_sasaran (31 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2488, 2459, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2489, 2460, 'Tersusunnya Dokumen Laporan Capaian Kinerja', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2490, 2461, 'Terlaksananya Penyediaan Gaji dan Tunjangan ASN', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2491, 2462, 'Tersedianya Komponen Instalasi Listrik/ Penerangan Bangunan Kantor', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2492, 2463, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2493, 2464, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2494, 2465, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2495, 2466, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2496, 2467, 'Terselenggaranya Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2497, 2468, 'Tersedianya Mebel', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2498, 2469, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2499, 2470, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2500, 2471, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2501, 2472, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2502, 2473, 'Tersedianya Jasa Surat Menyurat', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2503, 2474, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2504, 2475, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2505, 2476, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2506, 2477, 'Terlaksananya Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2507, 2478, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2508, 2479, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2509, 2480, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2510, 2481, 'Terlaksananya Pemeliharaan/ Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2511, 2482, 'Terlaksananya Pemeliharaan/ Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2512, 2483, 'Tersedianya Laporan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2513, 2484, 'Tersedianya Laporan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2514, 2485, 'Terselenggaranya Musrenbang Desa/ Kelurahan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2515, 2486, 'Terselenggaranya Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2516, 2487, 'Terlaksananya Fasilitasi Penyelenggaraan Lembaga Kemasyarakatan', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2517, 2488, 'Terselenggaranya Koordinasi/ Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2518, 2489, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

-- Table: renstra_sub_kegiatan_indikator (31 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2554, 2459, 2488, 127, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '1', '1', '2499900.00', '1', '2499900.00', '1', '2499900.00', '1', '2499900.00', '1', '2499900.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2555, 2460, 2489, 127, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '7', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2556, 2461, 2490, 127, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang / Bulan', '12', '12', '2090918730.00', '12', '2090918730.00', '12', '2090918730.00', '12', '2090918730.00', '12', '2090918730.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2557, 2462, 2491, 127, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '1', '1', '7997100.00', '1', '7997100.00', '1', '7997100.00', '1', '7997100.00', '1', '7997100.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2558, 2463, 2492, 127, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '2', '2', '49956400.00', '2', '49956400.00', '2', '49956400.00', '2', '49956400.00', '2', '49956400.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2559, 2464, 2493, 127, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '1', '1', '8000000.00', '1', '8000000.00', '1', '8000000.00', '1', '8000000.00', '1', '8000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2560, 2465, 2494, 127, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '1', '1', '9990000.00', '1', '9990000.00', '1', '9990000.00', '1', '9990000.00', '1', '9990000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2561, 2466, 2495, 127, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '1', '1', '6000000.00', '1', '6000000.00', '1', '6000000.00', '1', '6000000.00', '1', '6000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2562, 2467, 2496, 127, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '1', '1', '62460000.00', '1', '62460000.00', '1', '62460000.00', '1', '62460000.00', '1', '62460000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2563, 2468, 2497, 127, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '2', '20000000.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2564, 2469, 2498, 127, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '', '5', '21228450.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2565, 2470, 2499, 127, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '97087304.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2566, 2471, 2500, 127, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '30000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2567, 2472, 2501, 127, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '15000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2568, 2473, 2502, 127, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2569, 2474, 2503, 127, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '75356500.00', '12', '75356500.00', '12', '75356500.00', '12', '75356500.00', '12', '75356500.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2570, 2475, 2504, 127, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', '12', '12', '5000000.00', '12', '5000000.00', '12', '5000000.00', '12', '5000000.00', '12', '5000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2571, 2476, 2505, 127, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '129000000.00', '12', '129000000.00', '12', '129000000.00', '12', '129000000.00', '12', '129000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2572, 2477, 2506, 127, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '6', '6', '18697200.00', '6', '18697200.00', '6', '18697200.00', '6', '18697200.00', '6', '18697200.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2573, 2478, 2507, 127, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '10', '20000000.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2574, 2479, 2508, 127, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '5', '5', '9500000.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2575, 2480, 2509, 127, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '1', '36247694.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2576, 2481, 2510, 127, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/ Direhabilitasi', 'Unit', '', '', '0.00', '1', '36733343.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2577, 2482, 2511, 127, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/ Direhabilitasi', 'Unit', '', '', '0.00', '', '0.00', '1', '16975163.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2578, 2483, 2512, 127, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', '2', '2', '114281150.00', '2', '114281150.00', '2', '114281150.00', '2', '114281150.00', '2', '114281150.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2579, 2484, 2513, 127, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '4', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2580, 2485, 2514, 127, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', '1', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2581, 2486, 2515, 127, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '4', '4', '428869750.00', '4', '428869750.00', '4', '428869750.00', '4', '428869750.00', '4', '428869750.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2582, 2487, 2516, 127, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan (Lembaga Kemasyarakatan)', 'Lembaga', '1157', '1157', '20000000.00', '1157', '20000000.00', '1157', '20000000.00', '1157', '20000000.00', '1157', '20000000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2583, 2488, 2517, 127, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', '4', '4', '17392400.00', '4', '17392400.00', '4', '17392400.00', '4', '17392400.00', '4', '17392400.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL),
  (2584, 2489, 2518, 127, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '10', '10', '7454000.00', '10', '7454000.00', '10', '7454000.00', '10', '7454000.00', '10', '7454000.00', 10, '2026-09-27 22:20:29', '2026-09-27 22:20:29', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
