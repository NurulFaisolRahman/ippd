-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN ROGOJAMPI
-- ID INSTANSI: 121 | KODE: 7.01.0.00.0.00.09.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-30 15:32:41
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN ROGOJAMPI) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (121, '7.01.0.00.0.00.09.000', '35.10', 'Kecamatan Rogojampi', '7.01', NULL, NULL, '$2y$10$eamtkRoXDbmW.MJJ1j1.MuNr1uk1QbP51txQNBMUh.27VQgPDJBv6', 4, 2025, 2029, '2026-09-21 16:24:41', '2026-09-30 15:31:38', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN ROGOJAMPI SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2677, 2678, 2679, 2680, 2681, 2682, 2683, 2684, 2685, 2686, 2687, 2688, 2689, 2690, 2691, 2692, 2693, 2694, 2695, 2696, 2697, 2698, 2699, 2700, 2701, 2702, 2703, 2704, 2705, 2706, 2707, 2708, 2709, 2710);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2677, 2678, 2679, 2680, 2681, 2682, 2683, 2684, 2685, 2686, 2687, 2688, 2689, 2690, 2691, 2692, 2693, 2694, 2695, 2696, 2697, 2698, 2699, 2700, 2701, 2702, 2703, 2704, 2705, 2706, 2707, 2708, 2709, 2710);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (722, 723, 724, 725, 726, 727, 728, 729, 730, 731, 732, 733, 734);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (722, 723, 724, 725, 726, 727, 728, 729, 730, 731, 732, 733, 734);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (722, 723, 724, 725, 726, 727, 728, 729, 730, 731, 732, 733, 734);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (231, 232, 233, 234, 235);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (231, 232, 233, 234, 235);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (231, 232, 233, 234, 235);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (115, 116);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (115, 116);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (44);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (44);
DELETE FROM `renstra_tujuan` WHERE `id` IN (44) OR (`id_instansi` = 121 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN ROGOJAMPI
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (44, '35.10', 121, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (61, 44, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (115, 44, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (116, 44, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (164, 115, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (165, 116, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (231, 115, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, '95.5', '96', '96.5', '97', '97', NULL, '3040259343.00', '3047483651.00', '3047774577.00', '3070960783.00', '3174231853.00'),
  (232, 116, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194279100.00', '194279100.00', '194279100.00', '194279100.00', '194279100.00'),
  (233, 116, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '556453100.00', '556453100.00', '556453100.00', '556453100.00', '556453100.00'),
  (234, 116, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '17537500.00', '17537500.00', '17537500.00', '17537500.00', '17537500.00'),
  (235, 116, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '14950000.00', '14950000.00', '14950000.00', '14950000.00', '14950000.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (277, 231, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (278, 232, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (279, 233, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (280, 234, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (281, 235, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (400, 231, 277, 121, 'Persentase Pemenuhan Kebutuhan Penunjang Perangkat Daerah', '%', '2134875960', '95.5', '96', '96.5', '97', '97', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 10),
  (401, 232, 278, 121, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '183533050', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 10),
  (402, 233, 279, 121, 'Persentase kegiatan pemberdayaan masyarakat yang terlaksana', '%', '582004900', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 10),
  (403, 234, 280, 121, 'Persentase Penyelesaian Pengaduan Masyarakat', '%', '12246500', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 10),
  (404, 235, 281, 121, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu', '%', '13444900', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 10);

-- Table: renstra_kegiatan (13 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (722, 231, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '3998400.00', '3998400.00', '3998400.00', '3998400.00', '3998400.00'),
  (723, 231, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '2727831490.00', '2727831490.00', '2727831490.00', '2727831490.00', '2727831490.00'),
  (724, 231, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '124798600.00', '124798600.00', '124798600.00', '124798600.00', '124798600.00'),
  (725, 231, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '0.00', '0.00', '7515234.00', '30701440.00', '88972510.00'),
  (726, 231, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '159989053.00', '159989053.00', '159989053.00', '159989053.00', '159989053.00'),
  (727, 231, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '23641800.00', '30866108.00', '23641800.00', '23641800.00', '68641800.00'),
  (728, 232, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '114279300.00', '114279300.00', '114279300.00', '114279300.00', '114279300.00'),
  (729, 232, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '79999800.00', '79999800.00', '79999800.00', '79999800.00', '79999800.00'),
  (730, 233, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '536453150.00', '536453150.00', '536453150.00', '536453150.00', '536453150.00'),
  (731, 233, 'Kegiatan Pemberdayaan Kelurahan', '7.01.03.2.02', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (732, 233, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '84', '86', '88', '90', '90', NULL, '19999950.00', '19999950.00', '19999950.00', '19999950.00', '19999950.00'),
  (733, 234, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '17537500.00', '17537500.00', '17537500.00', '17537500.00', '17537500.00'),
  (734, 235, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '14950000.00', '14950000.00', '14950000.00', '14950000.00', '14950000.00');

-- Table: renstra_kegiatan_sasaran (13 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (777, 722, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (778, 723, 'Cakupan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (779, 724, 'Cakupan Administrasi Umum Perangkat Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (780, 725, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (781, 726, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (782, 727, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (783, 728, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (784, 729, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (785, 730, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (786, 731, 'Cakupan Kegiatan Pemberdayaan Kelurahan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (787, 732, 'Cakupan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (788, 733, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (789, 734, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- Table: renstra_kegiatan_indikator (13 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2540, 722, 777, 121, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', '2450000', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2541, 723, 778, 121, 'Cakupan Administrasi Keuangan Perangkat Daerah', '%', '1846297454', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2542, 724, 779, 121, 'Cakupan Administrasi Umum Perangkat Daerah', '%', '104008250', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2543, 725, 780, 121, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '%', '', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2544, 726, 781, 121, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '%', '159997053', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2545, 727, 782, 121, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '%', '26581000', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2546, 728, 783, 121, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '%', '173583050', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2547, 729, 784, 121, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2548, 730, 785, 121, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', '%', '582004900', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2549, 731, 786, 121, 'Cakupan Kegiatan Pemberdayaan Kelurahan', '%', '', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2550, 732, 787, 121, 'Cakupan Kegiatan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '%', '82', '84', '0.00', '86', '0.00', '88', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2551, 733, 788, 121, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '%', '12246500', '92', '0.00', '94', '0.00', '96', '0.00', '98', '0.00', '98', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2552, 734, 789, 121, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '%', '13444900', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- Table: renstra_sub_kegiatan (34 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2677, 722, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2498400.00', '2498400.00', '2498400.00', '2498400.00', '2498400.00'),
  (2678, 722, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (2679, 723, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/Bulan', NULL, '13', '13', '13', '13', '13', NULL, '2727831490.00', '2727831490.00', '2727831490.00', '2727831490.00', '2727831490.00'),
  (2680, 724, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '7999700.00', '7999700.00', '7999700.00', '7999700.00', '7999700.00'),
  (2681, 724, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '17860350.00', '17860350.00', '17860350.00', '17860350.00', '17860350.00'),
  (2682, 724, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '7990800.00', '7990800.00', '7990800.00', '7990800.00', '7990800.00'),
  (2683, 724, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '19950000.00', '19950000.00', '19950000.00', '19950000.00', '19950000.00'),
  (2684, 724, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '6003750.00', '6003750.00', '6003750.00', '6003750.00', '6003750.00'),
  (2685, 724, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '64994000.00', '64994000.00', '64994000.00', '64994000.00', '64994000.00'),
  (2686, 725, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Paket', NULL, '0', '0', '0', '0', '2', NULL, '0.00', '0.00', '0.00', '0.00', '20000000.00'),
  (2687, 725, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Paket', NULL, '0', '0', '3', '0', '0', NULL, '0.00', '0.00', '7515234.00', '0.00', '0.00'),
  (2688, 725, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '53972510.00'),
  (2689, 725, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '0', '0', '0', '1', '0', NULL, '0.00', '0.00', '0.00', '30701440.00', '0.00'),
  (2690, 725, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '15000000.00'),
  (2691, 726, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2000000.00', '2000000.00', '2000000.00', '2000000.00'),
  (2692, 726, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '29999053.00', '29999053.00', '29999053.00', '29999053.00', '29999053.00'),
  (2693, 726, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', NULL, '1', '12', '12', '12', '12', NULL, '4990000.00', '4990000.00', '4990000.00', '4990000.00', '4990000.00'),
  (2694, 726, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '123000000.00', '123000000.00', '123000000.00', '123000000.00', '123000000.00'),
  (2695, 727, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan Dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '10', '10', '10', '10', '10', NULL, '14860000.00', '14860000.00', '14860000.00', '14860000.00', '14860000.00'),
  (2696, 727, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'Unit', NULL, '0', '10', '0', '0', '0', NULL, '0.00', '7224308.00', '0.00', '0.00', '0.00'),
  (2697, 727, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '15', '15', '15', '15', '15', NULL, '8781800.00', '8781800.00', '8781800.00', '8781800.00', '8781800.00'),
  (2698, 727, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita si', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '0.00', '0.00', '0.00', '25000000.00'),
  (2699, 727, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita si', 'Unit', NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '10000000.00'),
  (2700, 727, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita si', 'Unit', NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '10000000.00'),
  (2701, 728, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', NULL, '100', '100', '100', '100', '100', NULL, '114279300.00', '114279300.00', '114279300.00', '114279300.00', '114279300.00'),
  (2702, 729, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '79999800.00', '79999800.00', '79999800.00', '79999800.00', '79999800.00'),
  (2703, 730, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '9998300.00', '9998300.00', '9998300.00', '9998300.00', '9998300.00'),
  (2704, 730, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan  Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '526454850.00', '526454850.00', '526454850.00', '526454850.00', '526454850.00'),
  (2705, 731, 'Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', '7.01.03.2.02.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Meningkatnya Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', 'Jumlah Laporan Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2706, 731, 'Pembangunan Sarana dan Prasarana Kelurahan', '7.01.03.2.02.0002', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terbangunnya Sarana dan Prasarana Kelurahan', 'Jumlah Laporan Pembangunan Sarana dan  Prasarana Kelurahan', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2707, 731, 'Pemberdayaan Masyarakat di Kelurahan', '7.01.03.2.02.0003', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Pemberdayaan Masyarakat di Kelurahan', 'Jumlah Laporan Pemberdayaan Masyarakat di Kelurahan', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2708, 732, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terselenggaranya Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakata n', NULL, '1157', '1157', '1157', '1157', '1157', NULL, '19999950.00', '19999950.00', '19999950.00', '19999950.00', '19999950.00'),
  (2709, 733, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '17537500.00', '17537500.00', '17537500.00', '17537500.00', '17537500.00'),
  (2710, 734, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '14950000.00', '14950000.00', '14950000.00', '14950000.00', '14950000.00');

-- Table: renstra_sub_kegiatan_sasaran (34 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2706, 2677, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2707, 2678, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2708, 2679, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2709, 2680, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2710, 2681, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2711, 2682, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2712, 2683, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2713, 2684, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2714, 2685, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2715, 2686, 'Tersedianya Mebel', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2716, 2687, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2717, 2688, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2718, 2689, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2719, 2690, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2720, 2691, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2721, 2692, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2722, 2693, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2723, 2694, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2724, 2695, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2725, 2696, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2726, 2697, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2727, 2698, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2728, 2699, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2729, 2700, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2730, 2701, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2731, 2702, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2732, 2703, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2733, 2704, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2734, 2705, 'Meningkatnya Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2735, 2706, 'Terbangunnya Sarana dan Prasarana Kelurahan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2736, 2707, 'Terlaksananya Pemberdayaan Masyarakat di Kelurahan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2737, 2708, 'Terselenggaranya Lembaga Kemasyarakatan', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2738, 2709, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2739, 2710, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- Table: renstra_sub_kegiatan_indikator (34 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2772, 2677, 2706, 121, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '2450000', '1', '2498400.00', '1', '2498400.00', '1', '2498400.00', '1', '2498400.00', '1', '2498400.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2773, 2678, 2707, 121, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '1846297454', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2774, 2679, 2708, 121, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/Bulan', '1846297454', '13', '2727831490.00', '13', '2727831490.00', '13', '2727831490.00', '13', '2727831490.00', '13', '2727831490.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2775, 2680, 2709, 121, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '7694500', '1', '7999700.00', '1', '7999700.00', '1', '7999700.00', '1', '7999700.00', '1', '7999700.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2776, 2681, 2710, 121, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '14717000', '1', '17860350.00', '1', '17860350.00', '1', '17860350.00', '1', '17860350.00', '1', '17860350.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2777, 2682, 2711, 121, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '7421000', '1', '7990800.00', '1', '7990800.00', '1', '7990800.00', '1', '7990800.00', '1', '7990800.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2778, 2683, 2712, 121, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '18551750', '1', '19950000.00', '1', '19950000.00', '1', '19950000.00', '1', '19950000.00', '1', '19950000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2779, 2684, 2713, 121, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '5834000', '1', '6003750.00', '1', '6003750.00', '1', '6003750.00', '1', '6003750.00', '1', '6003750.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2780, 2685, 2714, 121, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '49790000', '12', '64994000.00', '12', '64994000.00', '12', '64994000.00', '12', '64994000.00', '12', '64994000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2781, 2686, 2715, 121, 'Jumlah Paket Mebel yang Disediakan', 'Paket', '-', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', '2', '20000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2782, 2687, 2716, 121, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Paket', '-', '0', '0.00', '0', '0.00', '3', '7515234.00', '0', '0.00', '0', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2783, 2688, 2717, 121, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '-', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', '1', '53972510.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2784, 2689, 2718, 121, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '-', '0', '0.00', '0', '0.00', '0', '0.00', '1', '30701440.00', '0', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2785, 2690, 2719, 121, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '-', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', '1', '15000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2786, 2691, 2720, 121, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '2000000', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2787, 2692, 2721, 121, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '25656256', '12', '29999053.00', '12', '29999053.00', '12', '29999053.00', '12', '29999053.00', '12', '29999053.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2788, 2693, 2722, 121, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', '4883000', '1', '4990000.00', '12', '4990000.00', '12', '4990000.00', '12', '4990000.00', '12', '4990000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2789, 2694, 2723, 121, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '123000000', '12', '123000000.00', '12', '123000000.00', '12', '123000000.00', '12', '123000000.00', '12', '123000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2790, 2695, 2724, 121, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan Dibayarkan Pajak dan Perizinannya', 'Unit', '17976000', '10', '14860000.00', '10', '14860000.00', '10', '14860000.00', '10', '14860000.00', '10', '14860000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2791, 2696, 2725, 121, 'Jumlah Mebel yang Dipelihara', 'Unit', '-', '0', '0.00', '10', '7224308.00', '0', '0.00', '0', '0.00', '0', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2792, 2697, 2726, 121, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '8605000', '15', '8781800.00', '15', '8781800.00', '15', '8781800.00', '15', '8781800.00', '15', '8781800.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2793, 2698, 2727, 121, 'Jumlah Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita si', 'Paket', '-', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '25000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2794, 2699, 2728, 121, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita si', 'Unit', '-', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', '1', '10000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2795, 2700, 2729, 121, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita si', 'Unit', '-', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', '1', '10000000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2796, 2701, 2730, 121, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', '173583050', '100', '114279300.00', '100', '114279300.00', '100', '114279300.00', '100', '114279300.00', '100', '114279300.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2797, 2702, 2731, 121, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '', '4', '79999800.00', '4', '79999800.00', '4', '79999800.00', '4', '79999800.00', '4', '79999800.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2798, 2703, 2732, 121, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', '1', '1', '9998300.00', '1', '9998300.00', '1', '9998300.00', '1', '9998300.00', '1', '9998300.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2799, 2704, 2733, 121, 'Jumlah Laporan Peningkatan  Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '582004900', '4', '526454850.00', '4', '526454850.00', '4', '526454850.00', '4', '526454850.00', '4', '526454850.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2800, 2705, 2734, 121, 'Jumlah Laporan Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', 'Laporan', '-', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2801, 2706, 2735, 121, 'Jumlah Laporan Pembangunan Sarana dan  Prasarana Kelurahan', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2802, 2707, 2736, 121, 'Jumlah Laporan Pemberdayaan Masyarakat di Kelurahan', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2803, 2708, 2737, 121, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakata n', '1157', '1157', '19999950.00', '1157', '19999950.00', '1157', '19999950.00', '1157', '19999950.00', '1157', '19999950.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2804, 2709, 2738, 121, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', '12246500', '4', '17537500.00', '4', '17537500.00', '4', '17537500.00', '4', '17537500.00', '4', '17537500.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL),
  (2805, 2710, 2739, 121, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '13444900', '4', '14950000.00', '4', '14950000.00', '4', '14950000.00', '4', '14950000.00', '4', '14950000.00', 10, '2026-09-30 15:31:38', '2026-09-30 15:31:38', NULL);

-- ------------------------------------------------------------------------------
-- 4. VERIFIKASI TRANSAKSI SELESAI
-- ------------------------------------------------------------------------------
COMMIT;
SET FOREIGN_KEY_CHECKS = 1;
