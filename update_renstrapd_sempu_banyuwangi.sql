-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN SEMPU
-- ID INSTANSI: 128 | KODE: 7.01.0.00.0.00.16.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-30 15:36:50
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN SEMPU) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (128, '7.01.0.00.0.00.16.000', '35.10', 'Kecamatan Sempu', '7.01', NULL, NULL, '$2y$10$707GJJ9grLURcEGNDobITe/u69Eavc/l/QMZMxDpp8D5j9noeLyJO', 4, 2025, 2029, '2026-09-21 16:29:08', '2026-09-30 15:36:50', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN SEMPU SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2711, 2712, 2713, 2714, 2715, 2716, 2717, 2718, 2719, 2720, 2721, 2722, 2723, 2724, 2725, 2726, 2727, 2728, 2729, 2730, 2731, 2732, 2733, 2734, 2735, 2736, 2737, 2738, 2739, 2740, 2741);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2711, 2712, 2713, 2714, 2715, 2716, 2717, 2718, 2719, 2720, 2721, 2722, 2723, 2724, 2725, 2726, 2727, 2728, 2729, 2730, 2731, 2732, 2733, 2734, 2735, 2736, 2737, 2738, 2739, 2740, 2741);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (735, 736, 737, 738, 739, 740, 741, 742, 743, 744, 745, 746);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (735, 736, 737, 738, 739, 740, 741, 742, 743, 744, 745, 746);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (735, 736, 737, 738, 739, 740, 741, 742, 743, 744, 745, 746);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (236, 237, 238, 239, 240);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (236, 237, 238, 239, 240);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (236, 237, 238, 239, 240);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (117, 118);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (117, 118);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (45);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (45);
DELETE FROM `renstra_tujuan` WHERE `id` IN (45) OR (`id_instansi` = 128 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN SEMPU
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (45, '35.10', 128, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (62, 45, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (117, 45, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (118, 45, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (166, 117, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (167, 118, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (236, 117, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, '95.5', '96', '96.5', '97', '97', NULL, '2188115482.00', '2193532411.00', '2193750553.00', '2211136028.00', '2288570718.00'),
  (237, 118, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194282000.00', '194282000.00', '194282000.00', '194282000.00', '194282000.00'),
  (238, 118, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '466991500.00', '466991500.00', '466991500.00', '466991500.00', '466991500.00'),
  (239, 118, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '8592000.00', '8592000.00', '8592000.00', '8592000.00', '8592000.00'),
  (240, 118, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '8939200.00', '8939200.00', '8939200.00', '8939200.00', '8939200.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (282, 236, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (283, 237, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (284, 238, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (285, 239, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (286, 240, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pmerintahan Desa', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (405, 236, 282, 128, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '95', '95.5', '96', '96.5', '97', '97', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, 10),
  (406, 237, 283, 128, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, 10),
  (407, 238, 284, 128, 'Persentase kegiatan pemberdayaan masyarakat yang terlaksana (%)', '%', '27', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, 10),
  (408, 239, 285, 128, 'Persentase Penyelesaian Pengaduan Masyarakat (%)', '%', '100', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, 10),
  (409, 240, 286, 128, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu (%)', '%', '90', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (735, 236, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '3996900.00', '3996900.00', '3996900.00', '3996900.00', '3996900.00'),
  (736, 236, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00'),
  (737, 236, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '9', '9', '9', '9', '9', NULL, '180932900.00', '180932900.00', '180932900.00', '180932900.00', '180932900.00'),
  (738, 236, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '30', '30', '30', '30', '30', NULL, '42524255.00', '18024255.00', '18024255.00', '18024255.00', '142979491.00'),
  (739, 236, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '126847036.00', '126847036.00', '126847036.00', '126847036.00', '126847036.00'),
  (740, 236, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '1', '0', NULL, '33587600.00', '63504529.00', '63722671.00', '81108146.00', '33587600.00'),
  (741, 237, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (742, 237, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (743, 238, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '446991500.00', '446991500.00', '446991500.00', '446991500.00', '446991500.00'),
  (744, 238, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '6', '6', '6', '6', '6', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (745, 239, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '8592000.00', '8592000.00', '8592000.00', '8592000.00', '8592000.00'),
  (746, 240, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '8939200.00', '8939200.00', '8939200.00', '8939200.00', '8939200.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (790, 735, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (791, 736, 'Cakupan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (792, 737, 'Cakupan Administrasi Umum Perangkat Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (793, 738, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (794, 739, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (795, 740, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (796, 741, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (797, 742, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (798, 743, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (799, 744, 'Cakupan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (800, 745, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (801, 746, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- Table: renstra_kegiatan_indikator (13 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2553, 735, 0, 128, 'Jumlah Dokumen Perencanaan Perangkat Daerah (Dokumen)', 'Dokumen', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2554, 735, 0, 128, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah (Laporan)', 'Laporan', '7', '7', NULL, '7', NULL, '7', NULL, '7', NULL, '7', NULL, 20, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2555, 736, 0, 128, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN (Orang/bulan)', 'Orang/bulan', '14', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2556, 737, 0, 128, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan (Paket)', 'Paket', '9', '9', NULL, '9', NULL, '9', NULL, '9', NULL, '9', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2557, 738, 0, 128, 'Jumlah Paket Mebel yang Disediakan (Unit)', 'Unit', '8', '30', NULL, '30', NULL, '30', NULL, '30', NULL, '30', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2558, 739, 0, 128, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan (Laporan)', 'Laporan', '12', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2559, 740, 0, 128, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '1', NULL, '0', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2560, 741, 0, 128, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait (Laporan)', 'Laporan', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2561, 742, 0, 128, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan (Laporan)', 'Laporan', '1', '4', NULL, '4', NULL, '4', NULL, '4', NULL, '4', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2562, 743, 0, 128, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan (Laporan)', 'Laporan', '4', '4', NULL, '4', NULL, '4', NULL, '4', NULL, '4', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2563, 744, 0, 128, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan (Lembaga Kemasyarakatan)', 'Lembaga Kemasyarakatan', '0', '6', NULL, '6', NULL, '6', NULL, '6', NULL, '6', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2564, 745, 0, 128, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia (Laporan)', 'Laporan', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2565, 746, 0, 128, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa (Dokumen)', 'Dokumen', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- Table: renstra_sub_kegiatan (31 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2711, 735, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '2496900.00', '2496900.00', '2496900.00', '2496900.00', '2496900.00'),
  (2712, 735, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (2713, 736, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00'),
  (2714, 737, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '3', '3', '3', '3', '3', NULL, '12993600.00', '12993600.00', '12993600.00', '12993600.00', '12993600.00'),
  (2715, 737, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '44497400.00', '44497400.00', '44497400.00', '44497400.00', '44497400.00'),
  (2716, 737, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '3', '3', '3', '3', '3', NULL, '12989900.00', '12989900.00', '12989900.00', '12989900.00', '12989900.00'),
  (2717, 737, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '9', '9', '9', '9', '9', NULL, '29990000.00', '29990000.00', '29990000.00', '29990000.00', '29990000.00'),
  (2718, 737, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '3', '3', '3', '3', '3', NULL, '10997000.00', '10997000.00', '10997000.00', '10997000.00', '10997000.00'),
  (2719, 737, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '69465000.00', '69465000.00', '69465000.00', '69465000.00', '69465000.00'),
  (2720, 738, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '30', '30', '30', '30', '30', NULL, '18024255.00', '18024255.00', '18024255.00', '18024255.00', '18024255.00'),
  (2721, 738, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '2', '0', '0', '0', '0', NULL, '24500000.00', '0.00', '0.00', '0.00', '0.00'),
  (2722, 738, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '79955236.00'),
  (2723, 738, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '30000000.00'),
  (2724, 738, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '1', NULL, '0.00', '0.00', '0.00', '0.00', '15000000.00'),
  (2725, 739, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '3600000.00', '3600000.00', '3600000.00', '3600000.00', '3600000.00'),
  (2726, 739, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '24247036.00', '24247036.00', '24247036.00', '24247036.00', '24247036.00'),
  (2727, 739, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '12', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (2728, 739, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '84000000.00', '84000000.00', '84000000.00', '84000000.00', '84000000.00'),
  (2729, 740, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '19837600.00', '19837600.00', '19837600.00', '19837600.00', '19837600.00'),
  (2730, 740, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '10', '0', NULL, '0.00', '0.00', '0.00', '20000000.00', '0.00'),
  (2731, 740, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '6', '0', '6', '0', '6', NULL, '13750000.00', '0.00', '13750000.00', '0.00', '13750000.00'),
  (2732, 740, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '1', '0', '0', '0', NULL, '0.00', '43666929.00', '0.00', '0.00', '0.00'),
  (2733, 740, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '1', '0', NULL, '0.00', '0.00', '0.00', '41270546.00', '0.00'),
  (2734, 740, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '0', '0', '1', '0', '0', NULL, '0.00', '0.00', '30135071.00', '0.00', '0.00'),
  (2735, 741, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (2736, 742, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (2737, 743, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '9981500.00', '9981500.00', '9981500.00', '9981500.00', '9981500.00'),
  (2738, 743, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '437010000.00', '437010000.00', '437010000.00', '437010000.00', '437010000.00'),
  (2739, 744, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '6', '6', '6', '6', '6', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2740, 745, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '8592000.00', '8592000.00', '8592000.00', '8592000.00', '8592000.00'),
  (2741, 746, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '8939200.00', '8939200.00', '8939200.00', '8939200.00', '8939200.00');

-- Table: renstra_sub_kegiatan_sasaran (31 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2740, 2711, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2741, 2712, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2742, 2713, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2743, 2714, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2744, 2715, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2745, 2716, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2746, 2717, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2747, 2718, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2748, 2719, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2749, 2720, 'Tersedianya Mebel', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2750, 2721, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2751, 2722, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2752, 2723, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2753, 2724, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2754, 2725, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2755, 2726, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2756, 2727, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2757, 2728, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2758, 2729, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2759, 2730, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2760, 2731, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2761, 2732, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2762, 2733, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2763, 2734, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2764, 2735, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2765, 2736, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2766, 2737, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2767, 2738, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2768, 2739, 'Terselenggaranya Lembaga Kemasyarakatan', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2769, 2740, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2770, 2741, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- Table: renstra_sub_kegiatan_indikator (49 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2806, 2711, 0, 128, 'Jumlah Dokumen Perencanaan Perangkat Daerah (Dokumen)', 'Dokumen', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2807, 2712, 0, 128, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah (Laporan)', 'Laporan', '7', '7', NULL, '7', NULL, '7', NULL, '7', NULL, '7', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2808, 2713, 0, 128, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN (Orang/bulan)', 'Orang/bulan', '14', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2809, 2713, 0, 128, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD (Laporan)', 'Laporan', '12', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 20, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2810, 2713, 0, 128, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan (Paket)', 'Paket', '3', '3', NULL, '3', NULL, '3', NULL, '3', NULL, '3', NULL, 30, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2811, 2713, 0, 128, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan (Paket)', 'Paket', '3', '3', NULL, '3', NULL, '3', NULL, '3', NULL, '3', NULL, 40, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2812, 2713, 0, 128, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan (Paket)', 'Paket', '4', '4', NULL, '4', NULL, '4', NULL, '4', NULL, '4', NULL, 50, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2813, 2713, 0, 128, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan (Paket)', 'Paket', '3', '3', NULL, '3', NULL, '3', NULL, '3', NULL, '3', NULL, 60, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2814, 2714, 0, 128, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan (Paket)', 'Paket', '3', '3', NULL, '3', NULL, '3', NULL, '3', NULL, '3', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2815, 2715, 0, 128, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan (Paket)', 'Paket', '4', '4', NULL, '4', NULL, '4', NULL, '4', NULL, '4', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2816, 2716, 0, 128, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan (Paket)', 'Paket', '3', '3', NULL, '3', NULL, '3', NULL, '3', NULL, '3', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2817, 2717, 0, 128, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan (Paket)', 'Paket', '9', '9', NULL, '9', NULL, '9', NULL, '9', NULL, '9', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2818, 2718, 0, 128, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan (Paket)', 'Paket', '3', '3', NULL, '3', NULL, '3', NULL, '3', NULL, '3', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2819, 2719, 0, 128, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD (Laporan)', 'Laporan', '12', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2820, 2719, 0, 128, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan (Unit)', 'Unit', '2', '2', NULL, '0', NULL, '0', NULL, '0', NULL, '0', NULL, 20, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2821, 2719, 0, 128, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan (Unit)', 'Unit', '2', '0', NULL, '0', NULL, '0', NULL, '0', NULL, '1', NULL, 30, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2822, 2719, 0, 128, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '0', NULL, '1', NULL, 40, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2823, 2719, 0, 128, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '0', NULL, '1', NULL, 50, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2824, 2720, 0, 128, 'Jumlah Paket Mebel yang Disediakan (Unit)', 'Unit', '8', '30', NULL, '30', NULL, '30', NULL, '30', NULL, '30', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2825, 2721, 0, 128, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan (Unit)', 'Unit', '2', '2', NULL, '0', NULL, '0', NULL, '0', NULL, '0', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2826, 2722, 0, 128, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan (Unit)', 'Unit', '2', '0', NULL, '0', NULL, '0', NULL, '0', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2827, 2723, 0, 128, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '0', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2828, 2724, 0, 128, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '0', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2829, 2724, 0, 128, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat (Laporan)', 'Laporan', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 20, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2830, 2724, 0, 128, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan (Laporan)', 'Laporan', '12', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 30, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2831, 2724, 0, 128, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan (Laporan)', 'Laporan', '1', '1', NULL, '12', NULL, '1', NULL, '1', NULL, '1', NULL, 40, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2832, 2725, 0, 128, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat (Laporan)', 'Laporan', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2833, 2726, 0, 128, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan (Laporan)', 'Laporan', '12', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2834, 2727, 0, 128, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan (Laporan)', 'Laporan', '1', '1', NULL, '12', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2835, 2728, 0, 128, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan (Laporan)', 'Laporan', '12', '12', NULL, '12', NULL, '12', NULL, '12', NULL, '12', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2836, 2728, 0, 128, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya (Unit)', 'Unit', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 20, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2837, 2728, 0, 128, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '1', '0', NULL, '1', NULL, '0', NULL, '0', NULL, '0', NULL, 30, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2838, 2728, 0, 128, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '1', NULL, '0', NULL, '0', NULL, 40, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2839, 2728, 0, 128, 'Jumlah Mebel yang Dipelihara (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '10', NULL, '0', NULL, 50, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2840, 2728, 0, 128, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara (Unit)', 'Unit', '6', '6', NULL, '0', NULL, '6', NULL, '0', NULL, '6', NULL, 60, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2841, 2729, 0, 128, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya (Unit)', 'Unit', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2842, 2730, 0, 128, 'Jumlah Mebel yang Dipelihara (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '10', NULL, '0', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2843, 2731, 0, 128, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara (Unit)', 'Unit', '6', '6', NULL, '0', NULL, '6', NULL, '0', NULL, '6', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2844, 2732, 0, 128, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '1', '0', NULL, '1', NULL, '0', NULL, '0', NULL, '0', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2845, 2733, 0, 128, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '0', NULL, '1', NULL, '0', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2846, 2734, 0, 128, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '1', '0', NULL, '0', NULL, '1', NULL, '0', NULL, '0', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2847, 2735, 0, 128, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait (Laporan)', 'Laporan', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2848, 2736, 0, 128, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan (Laporan)', 'Laporan', '1', '4', NULL, '4', NULL, '4', NULL, '4', NULL, '4', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2849, 2736, 0, 128, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan (Dokumen)', 'Dokumen', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 20, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2850, 2737, 0, 128, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan (Dokumen)', 'Dokumen', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2851, 2738, 0, 128, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan (Laporan)', 'Laporan', '4', '4', NULL, '4', NULL, '4', NULL, '4', NULL, '4', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2852, 2739, 0, 128, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan (Lembaga Kemasyarakatan)', 'Lembaga Kemasyarakatan', '0', '6', NULL, '6', NULL, '6', NULL, '6', NULL, '6', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2853, 2740, 0, 128, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia (Laporan)', 'Laporan', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL),
  (2854, 2741, 0, 128, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa (Dokumen)', 'Dokumen', '1', '1', NULL, '1', NULL, '1', NULL, '1', NULL, '1', NULL, 10, '2026-09-30 15:36:50', '2026-09-30 15:36:50', NULL);

-- ------------------------------------------------------------------------------
-- 4. VERIFIKASI TRANSAKSI SELESAI
-- ------------------------------------------------------------------------------
COMMIT;
SET FOREIGN_KEY_CHECKS = 1;
