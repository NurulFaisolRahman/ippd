-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN LICIN
-- ID INSTANSI: 114 | KODE: 7.01.0.00.0.00.02.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-28 09:05:57
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN LICIN) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (114, '7.01.0.00.0.00.02.000', '35.10', 'Kecamatan Licin', '7.01', NULL, NULL, '$2y$10$3uG9EuYf6PLTjxfMTyhpzuGsCRT1WGkpG9i8nIzP2bb8Ata7aQv4u', 4, 2025, 2029, '2026-09-21 12:58:55', '2026-09-28 09:05:25', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN LICIN SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2658, 2659, 2660, 2661, 2662, 2663, 2664, 2665, 2666, 2667, 2668, 2669, 2670, 2671, 2672, 2673, 2674, 2675, 2676);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2658, 2659, 2660, 2661, 2662, 2663, 2664, 2665, 2666, 2667, 2668, 2669, 2670, 2671, 2672, 2673, 2674, 2675, 2676);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (712, 713, 714, 715, 716, 717, 718, 719, 720, 721);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (712, 713, 714, 715, 716, 717, 718, 719, 720, 721);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (712, 713, 714, 715, 716, 717, 718, 719, 720, 721);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (226, 227, 228, 229, 230);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (226, 227, 228, 229, 230);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (226, 227, 228, 229, 230);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (113, 114);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (113, 114);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (43);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (43);
DELETE FROM `renstra_tujuan` WHERE `id` IN (43) OR (`id_instansi` = 114 AND `kode_wilayah` = '35.10');


-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (43, '35.10', 114, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (60, 43, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (113, 43, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (114, 43, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (162, 113, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (163, 114, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (226, 113, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, '95', '95', '95', '95', '95', NULL, '2574351233.00', '2574351233.00', '2574351233.00', '2574351233.00', '2574351233.00'),
  (227, 114, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '21280950.00', '21280950.00', '21280950.00', '21280950.00', '21280950.00'),
  (228, 114, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '595044900.00', '595044900.00', '595044900.00', '595044900.00', '595044900.00'),
  (229, 114, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '2', '2', '2', NULL, '6959900.00', '6959900.00', '6959900.00', '6959900.00', '6959900.00'),
  (230, 114, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '11926000.00', '11926000.00', '11926000.00', '11926000.00', '11926000.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (272, 226, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (273, 227, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (274, 228, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (275, 229, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (276, 230, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (395, 226, 272, 114, 'Persentase Pemenuhan KebutuhanPenunjang Perangkat Daerah', '%', '95', '95', '95', '95', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 10),
  (396, 227, 273, 114, 'Persentase                   sarana prasarana    kecamatan   dan kelurahan    dalam    kondisi baik', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 10),
  (397, 228, 274, 114, 'Persentase keterlibatan masyarakatdalam kegiatan pembangunan', '%', '91', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 10),
  (398, 229, 275, 114, 'Jumlah pelanggaran Perda dan Perbupdi Kecamatan', 'Kasus', '2', '2', '2', '2', '2', '2', NULL, NULL, NULL, NULL, NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 10),
  (399, 230, 276, 114, 'Persentase laporan keuangan desa yangselesai tepat waktu', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 10);

-- Table: renstra_kegiatan (10 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (712, 226, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '2500000.00', '2500000.00', '2500000.00', '2500000.00', '2500000.00'),
  (713, 226, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '2273599592.00', '2273599592.00', '2273599592.00', '2273599592.00', '2273599592.00'),
  (714, 226, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '141974700.00', '141974700.00', '141974700.00', '141974700.00', '141974700.00'),
  (715, 226, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '132434941.00', '132434941.00', '132434941.00', '132434941.00', '132434941.00'),
  (716, 226, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '23842000.00', '23842000.00', '23842000.00', '23842000.00', '23842000.00'),
  (717, 227, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '11281150.00', '11281150.00', '11281150.00', '11281150.00', '11281150.00'),
  (718, 227, 'Penyelenggaraan Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', '7.01.02.2.02', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '9999800.00', '9999800.00', '9999800.00', '9999800.00', '9999800.00'),
  (719, 228, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '595044900.00', '595044900.00', '595044900.00', '595044900.00', '595044900.00'),
  (720, 229, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', '2', '2', NULL, '6959900.00', '6959900.00', '6959900.00', '6959900.00', '6959900.00'),
  (721, 230, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '11926000.00', '11926000.00', '11926000.00', '11926000.00', '11926000.00');

-- Table: renstra_kegiatan_sasaran (10 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (767, 712, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (768, 713, 'Cakupan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (769, 714, 'Cakupan Administrasi Umum Perangkat Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (770, 715, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (771, 716, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (772, 717, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (773, 718, 'Cakupan Penyelenggaraan Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (774, 719, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (775, 720, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (776, 721, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

-- Table: renstra_kegiatan_indikator (10 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2530, 712, 767, 114, 'Cakupan  Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2531, 713, 768, 114, 'Cakupan Adinistrasi Keuangan PD', '%', '90', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2532, 714, 769, 114, 'Cakupan         Administrasi Umum Perangkat Daerah', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2533, 715, 770, 114, 'Cakupan  Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2534, 716, 771, 114, 'Cakupan  Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '%', '90', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2535, 717, 772, 114, 'Cakupan  Koordinasi Penyelenggaraan Kegiatan Pemerintahan di tingkat Kecamatan', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2536, 718, 773, 114, 'Cakupan  Penyelenggaraan Urusan Pemerintahan Yang Tidak Dilaksanakan oleh Unit Kerja PD Yang Ada Di Kecamatan', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2537, 719, 774, 114, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', '%', '91', '92', '0.00', '93', '0.00', '94', '0.00', '95', '0.00', '95', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2538, 720, 775, 114, 'Cakupan  Koordinasi Penerapan dan penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 'Kasus', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2539, 721, 776, 114, 'Cakupan  Fasilitasi, Rekomendasi, dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

-- Table: renstra_sub_kegiatan (19 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2658, 712, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah dokumen yang disusun', 'Dokumen', NULL, '7', '7', '7', '7', '7', NULL, '2500000.00', '2500000.00', '2500000.00', '2500000.00', '2500000.00'),
  (2659, 713, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah orang yang menerima gaji / tujangan', 'Orang', NULL, '9', '9', '9', '9', '9', NULL, '2273599592.00', '2273599592.00', '2273599592.00', '2273599592.00', '2273599592.00'),
  (2660, 714, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen InstalasiListrik /Penerangan Bangunan Kantor yang disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '7999800.00', '7999800.00', '7999800.00', '7999800.00', '7999800.00'),
  (2661, 714, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah paket peralatan dan perlengkapan kantor yang disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '29999400.00', '29999400.00', '29999400.00', '29999400.00', '29999400.00'),
  (2662, 714, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket rumah tangga yang disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '7999500.00', '7999500.00', '7999500.00', '7999500.00', '7999500.00'),
  (2663, 714, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket bahan logistik kantor yang disediakan', 'Paket', NULL, '11', '11', '11', '11', '11', NULL, '24990000.00', '24990000.00', '24990000.00', '24990000.00', '24990000.00'),
  (2664, 714, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket barang cetakan dan penggandaan yang disediakan', 'Paket', NULL, '4', '4', '4', '4', '4', NULL, '6000000.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (2665, 714, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah laporan penyelenggaraan rapat koordinasi dan konsultasi SKPD yang disediakan', 'Laporan', NULL, '10', '10', '10', '10', '10', NULL, '64986000.00', '64986000.00', '64986000.00', '64986000.00', '64986000.00'),
  (2666, 715, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah laporan penyediaan jasa surat menyurat yang disediakan', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2000000.00', '2000000.00', '2000000.00', '2000000.00'),
  (2667, 715, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah laporan penyediaan Penyediaan Jasa komunikasi, Sumber Daya Air dan Listrik yang disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '20434941.00', '20434941.00', '20434941.00', '20434941.00', '20434941.00'),
  (2668, 715, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang disediakan', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (2669, 715, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '105000000.00', '105000000.00', '105000000.00', '105000000.00', '105000000.00'),
  (2670, 716, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah kendaraan dinas operasional atau lapangan yang dipelihara dan dibayarkan pajak perizinannya', 'Unit', NULL, '4', '4', '4', '4', '4', NULL, '19107000.00', '19107000.00', '19107000.00', '19107000.00', '19107000.00'),
  (2671, 716, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah peralatan dan mesin lainnya yang dipelihara', 'Unit', NULL, '13', '13', '13', '13', '13', NULL, '4735000.00', '4735000.00', '4735000.00', '4735000.00', '4735000.00'),
  (2672, 717, 'Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01.0002', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Meningkatnya Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Jumlah Dokumen Kegiatan Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '11281150.00', '11281150.00', '11281150.00', '11281150.00', '11281150.00'),
  (2673, 718, 'Perencanaan Kegiatan Pelayanan kepada Masyarakat di Kecamatan', '7.01.02.2.02.0001', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Terlaksananya Perencanaan Kegiatan Pelayanan kepada Masyarakat di Kecamatan', 'Jumlah Dokumen Perencanaan Kegiatan Pelayanan Kepada Masyarakat Di Kecamatan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '9999800.00', '9999800.00', '9999800.00', '9999800.00', '9999800.00'),
  (2674, 719, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan efektifitas Kegiatan Pemberdayaan Masyarakat Di Wilayah Kecamatan', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '595044900.00', '595044900.00', '595044900.00', '595044900.00', '595044900.00'),
  (2675, 720, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah laporan Koordinasi/Sinergi dengan PD yang tugas dan fungsinya di Bidang Penegakan Peraturan Perundang Undangan dan/atau Kepolisian Negara RI', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '6959900.00', '6959900.00', '6959900.00', '6959900.00', '6959900.00'),
  (2676, 721, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang difasilitasi dalam rangka pengelolaan  Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '8', '8', '8', '8', '8', NULL, '11926000.00', '11926000.00', '11926000.00', '11926000.00', '11926000.00');

-- Table: renstra_sub_kegiatan_sasaran (19 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2687, 2658, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2688, 2659, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2689, 2660, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2690, 2661, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2691, 2662, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2692, 2663, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2693, 2664, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2694, 2665, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2695, 2666, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2696, 2667, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2697, 2668, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2698, 2669, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2699, 2670, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2700, 2671, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2701, 2672, 'Meningkatnya Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2702, 2673, 'Terlaksananya Perencanaan Kegiatan Pelayanan kepada Masyarakat di Kecamatan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2703, 2674, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2704, 2675, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2705, 2676, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

-- Table: renstra_sub_kegiatan_indikator (19 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2753, 2658, 2687, 114, 'Jumlah dokumen yang disusun', 'Dokumen', '7', '7', '2500000.00', '7', '2500000.00', '7', '2500000.00', '7', '2500000.00', '7', '2500000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2754, 2659, 2688, 114, 'Jumlah orang yang menerima gaji / tujangan', 'Orang', '12', '9', '2273599592.00', '9', '2273599592.00', '9', '2273599592.00', '9', '2273599592.00', '9', '2273599592.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2755, 2660, 2689, 114, 'Jumlah Paket Komponen InstalasiListrik /Penerangan Bangunan Kantor yang disediakan', 'Paket', '1', '1', '7999800.00', '1', '7999800.00', '1', '7999800.00', '1', '7999800.00', '1', '7999800.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2756, 2661, 2690, 114, 'Jumlah paket peralatan dan perlengkapan kantor yang disediakan', 'Paket', '3', '3', '29999400.00', '3', '29999400.00', '3', '29999400.00', '3', '29999400.00', '3', '29999400.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2757, 2662, 2691, 114, 'Jumlah Paket rumah tangga yang disediakan', 'Paket', '1', '1', '7999500.00', '1', '7999500.00', '1', '7999500.00', '1', '7999500.00', '1', '7999500.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2758, 2663, 2692, 114, 'Jumlah Paket bahan logistik kantor yang disediakan', 'Paket', '11', '11', '24990000.00', '11', '24990000.00', '11', '24990000.00', '11', '24990000.00', '11', '24990000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2759, 2664, 2693, 114, 'Jumlah Paket barang cetakan dan penggandaan yang disediakan', 'Paket', '4', '4', '6000000.00', '4', '6000000.00', '4', '6000000.00', '4', '6000000.00', '4', '6000000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2760, 2665, 2694, 114, 'Jumlah laporan penyelenggaraan rapat koordinasi dan konsultasi SKPD yang disediakan', 'Laporan', '10', '10', '64986000.00', '10', '64986000.00', '10', '64986000.00', '10', '64986000.00', '10', '64986000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2761, 2666, 2695, 114, 'Jumlah laporan penyediaan jasa surat menyurat yang disediakan', 'Laporan', '1', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2762, 2667, 2696, 114, 'Jumlah laporan penyediaan Penyediaan Jasa komunikasi, Sumber Daya Air dan Listrik yang disediakan', 'Laporan', '12', '12', '20434941.00', '12', '20434941.00', '12', '20434941.00', '12', '20434941.00', '12', '20434941.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2763, 2668, 2697, 114, 'Jumlah laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang disediakan', 'Laporan', '1', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2764, 2669, 2698, 114, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang disediakan', 'Laporan', '12', '12', '105000000.00', '12', '105000000.00', '12', '105000000.00', '12', '105000000.00', '12', '105000000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2765, 2670, 2699, 114, 'Jumlah kendaraan dinas operasional atau lapangan yang dipelihara dan dibayarkan pajak perizinannya', 'Unit', '', '4', '19107000.00', '4', '19107000.00', '4', '19107000.00', '4', '19107000.00', '4', '19107000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2766, 2671, 2700, 114, 'Jumlah peralatan dan mesin lainnya yang dipelihara', 'Unit', '', '13', '4735000.00', '13', '4735000.00', '13', '4735000.00', '13', '4735000.00', '13', '4735000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2767, 2672, 2701, 114, 'Jumlah Dokumen Kegiatan Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Dokumen', '12', '12', '11281150.00', '12', '11281150.00', '12', '11281150.00', '12', '11281150.00', '12', '11281150.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2768, 2673, 2702, 114, 'Jumlah Dokumen Perencanaan Kegiatan Pelayanan Kepada Masyarakat Di Kecamatan', 'Dokumen', '1', '1', '9999800.00', '1', '9999800.00', '1', '9999800.00', '1', '9999800.00', '1', '9999800.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2769, 2674, 2703, 114, 'Jumlah Laporan Peningkatan efektifitas Kegiatan Pemberdayaan Masyarakat Di Wilayah Kecamatan', 'Laporan', '14', '7', '595044900.00', '7', '595044900.00', '7', '595044900.00', '7', '595044900.00', '7', '595044900.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2770, 2675, 2704, 114, 'Jumlah laporan Koordinasi/Sinergi dengan PD yang tugas dan fungsinya di Bidang Penegakan Peraturan Perundang Undangan dan/atau Kepolisian Negara RI', 'Laporan', '7', '7', '6959900.00', '7', '6959900.00', '7', '6959900.00', '7', '6959900.00', '7', '6959900.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL),
  (2771, 2676, 2705, 114, 'Jumlah Dokumen yang difasilitasi dalam rangka pengelolaan  Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '8', '8', '11926000.00', '8', '11926000.00', '8', '11926000.00', '8', '11926000.00', '8', '11926000.00', 10, '2026-09-28 09:05:25', '2026-09-28 09:05:25', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
