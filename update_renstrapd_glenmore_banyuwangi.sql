-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN GLENMORE
-- ID INSTANSI: 130 | KODE: 7.01.0.00.0.00.18.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-27 22:36:38
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN GLENMORE) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (130, '7.01.0.00.0.00.18.000', '35.10', 'Kecamatan Glenmore', '7.01', NULL, NULL, '$2y$10$a6wsLqc7DZyObFH9g8MZTu5x2z/Iy7dbu6lqCUcgXzWJQJVf2S5du', 4, 2025, 2029, '2026-09-21 16:30:27', '2026-09-27 22:36:24', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN GLENMORE SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2512, 2513, 2514, 2515, 2516, 2517, 2518, 2519, 2520, 2521, 2522, 2523, 2524, 2525, 2526, 2527, 2528, 2529, 2530, 2531, 2532, 2533, 2534, 2535, 2536, 2537, 2538, 2539, 2540, 2541, 2542);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2512, 2513, 2514, 2515, 2516, 2517, 2518, 2519, 2520, 2521, 2522, 2523, 2524, 2525, 2526, 2527, 2528, 2529, 2530, 2531, 2532, 2533, 2534, 2535, 2536, 2537, 2538, 2539, 2540, 2541, 2542);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (211, 212, 213, 214, 215);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (211, 212, 213, 214, 215);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (211, 212, 213, 214, 215);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (107, 108);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (107, 108);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (40);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (40);
DELETE FROM `renstra_tujuan` WHERE `id` IN (40) OR (`id_instansi` = 130 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN GLENMORE
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (40, '35.10', 130, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (57, 40, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (107, 40, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (108, 40, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (156, 107, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (157, 108, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (211, 107, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, '95.5', '96', '96.5', '97', '97', NULL, '2683946801.00', '2817619147.00', '2957975111.00', '3105348870.00', '3260091318.00'),
  (212, 108, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194281400.00', '203995470.00', '214195244.00', '224905006.00', '236150256.00'),
  (213, 108, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '703405000.00', '738575250.00', '775504013.00', '814279213.00', '854993174.00'),
  (214, 108, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '14172000.00', '14880600.00', '15624630.00', '16405862.00', '17226155.00'),
  (215, 108, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '14908500.00', '15653925.00', '16436621.00', '17258452.00', '18121375.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (257, 211, 'Meningkatnya kualitas Pemenuhan Kebutuhan Penunjang Perangkat Daerah', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (258, 212, 'Meningkatnya Kualitas Penyelenggaraan Urusan Pemerintahan Lainnya di Kecamatan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (259, 213, 'Meningkatnya Kualitas Pemberdayaan Masyarakat', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (260, 214, 'Meningkatnya keamanan dan kenyamanan masyarakat', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (261, 215, 'Meningkatnya Kualitas Pemerintahan Desa', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (380, 211, 257, 130, 'Persentase Pemenuhan Kebutuhan Penunjang Perangkat Daerah', '%', '95', '95.5', '96', '96.5', '97', '97', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 10),
  (381, 212, 258, 130, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan lainnya yang Dilaksanakan', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 10),
  (382, 213, 259, 130, 'Persentase Kegiatan Pemberdayaan Masyarakat yang Terlaksana', '%', '91', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 10),
  (383, 214, 260, 130, 'Persentase Penyelesaian Pengaduan Masyarakat', '%', '90', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 10),
  (384, 215, 261, 130, 'Persentase Desa yang Menyelesaikan Laporan Kinerja Tepat Waktu', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (656, 211, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '4000000.00', '4075000.00', '4153750.00', '4236438.00', '4323259.00'),
  (657, 211, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '2327224591.00', '2443585821.00', '2565765112.00', '2694053367.00', '2828756036.00'),
  (658, 211, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '126854400.00', '132797125.00', '139036987.00', '145588841.00', '152468288.00'),
  (659, 211, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '16500000.00', '17325000.00', '18191250.00', '19100813.00', '20055853.00'),
  (660, 211, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '181884210.00', '190978421.00', '200527342.00', '210553709.00', '221081395.00'),
  (661, 211, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '91', '92', '93', '94', '94', NULL, '27483600.00', '28857780.00', '30300670.00', '31815702.00', '33406487.00'),
  (662, 212, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '114281400.00', '119995470.00', '125995244.00', '132295006.00', '138909756.00'),
  (663, 212, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '80000000.00', '84000000.00', '88200000.00', '92610000.00', '97240500.00'),
  (664, 213, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '683405000.00', '717575250.00', '753454013.00', '791126713.00', '830683049.00'),
  (665, 213, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '84', '86', '88', '90', '90', NULL, '20000000.00', '21000000.00', '22050000.00', '23152500.00', '24310125.00'),
  (666, 214, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '14172000.00', '14880600.00', '15624630.00', '16405862.00', '17226155.00'),
  (667, 215, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '14908500.00', '15653925.00', '16436621.00', '17258452.00', '18121375.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (711, 656, 'Meningkatnya Ketepatan Penyusunan Perencanaan dan Evaluasi PD', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (712, 657, 'Meningkatnya Administrasi Keuangan Perangkat Daerah', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (713, 658, 'Meningkatnya Administrasi Umum Perangkat Daerah', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (714, 659, 'Tersedianya sarana dan prasarana', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (715, 660, 'Tersedianya Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (716, 661, 'Terpeliharanya sarana dan prasarana', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (717, 662, 'Terlaksananya Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (718, 663, 'Terlaksananya Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (719, 664, 'Terselenggaranya Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (720, 665, 'Terselenggaranya Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (721, 666, 'Terselenggaranya Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (722, 667, 'Terlaksananya Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

-- Table: renstra_kegiatan_indikator (12 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2403, 656, 711, 130, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2404, 657, 712, 130, 'Cakupan Administrasi Keuangan Perangkat Daerah', '%', '90', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2405, 658, 713, 130, 'Cakupan Administrasi Umum Perangkat Daerah', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2406, 659, 714, 130, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '%', '90', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2407, 660, 715, 130, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2408, 661, 716, 130, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '%', '90', '91', '0.00', '92', '0.00', '93', '0.00', '94', '0.00', '94', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2409, 662, 717, 130, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2410, 663, 718, 130, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2411, 664, 719, 130, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2412, 665, 720, 130, 'Cakupan Kegiatan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '%', '82', '84', '0.00', '86', '0.00', '88', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2413, 666, 721, 130, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '%', '90', '92', '0.00', '94', '0.00', '96', '0.00', '98', '0.00', '98', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2414, 667, 722, 130, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

-- Table: renstra_sub_kegiatan (31 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2512, 656, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2500000.00', '2500000.00', '2500000.00', '2500000.00', '2500000.00'),
  (2513, 656, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersusunnya Dokumen Laporan Capaian Kinerja', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'laporan', NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1575000.00', '1653750.00', '1736438.00', '1823259.00'),
  (2514, 657, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Penyediaan Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'org/bln', NULL, '14', '14', '14', '14', '14', NULL, '2327224591.00', '2443585821.00', '2565765112.00', '2694053367.00', '2828756036.00'),
  (2515, 658, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'paket', NULL, '1', '1', '1', '1', '1', NULL, '7999500.00', '8399475.00', '8819449.00', '9260421.00', '9723442.00'),
  (2516, 658, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'paket', NULL, '2', '2', '2', '2', '2', NULL, '20280000.00', '21294000.00', '22358700.00', '23476635.00', '24650467.00'),
  (2517, 658, '7.01.01.2.06.000 Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'paket', NULL, '1', '1', '1', '1', '1', NULL, '7999900.00', '7999900.00', '7999900.00', '7999900.00', '7999900.00'),
  (2518, 658, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'paket', NULL, '10', '10', '10', '10', '10', NULL, '30075000.00', '31578750.00', '33157688.00', '34815572.00', '36556350.00'),
  (2519, 658, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'paket', NULL, '2', '2', '2', '2', '2', NULL, '6000000.00', '6300000.00', '6615000.00', '6945750.00', '7293038.00'),
  (2520, 658, 'Penyelenggaran Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terselenggaranya Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'laporan', NULL, '11', '11', '11', '11', '11', NULL, '54500000.00', '57225000.00', '60086250.00', '63090563.00', '66245091.00'),
  (2521, 659, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Mebel', 'Jumlah Unit Mebel yang Disediakan', 'unit', NULL, '', '0', '', '', '0', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2522, 659, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'unit', NULL, '1', '1', '1', '1', '1', NULL, '16500000.00', '17325000.00', '18191250.00', '19100813.00', '20055853.00'),
  (2523, 659, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2524, 659, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'unit', NULL, '', '', '', '', '0', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2525, 659, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'unit', NULL, '', '', '', '', '0', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2526, 660, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'laporan', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2100000.00', '2205000.00', '2315250.00', '2431013.00'),
  (2527, 660, 'Penyedian Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'laporan', NULL, '12', '12', '12', '12', '12', NULL, '51884210.00', '54478421.00', '57202342.00', '60062459.00', '63065582.00'),
  (2528, 660, 'Penyediaan Pasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5250000.00', '5512500.00', '5788125.00', '6077531.00'),
  (2529, 660, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'laporan', NULL, '12', '12', '12', '12', '12', NULL, '123000000.00', '129150000.00', '135607500.00', '142387875.00', '149507269.00'),
  (2530, 661, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipemelihara dan Dibayarkan Pajak dan Perizinannya', 'unit', NULL, '5', '5', '5', '5', '5', NULL, '19990600.00', '20990130.00', '22039637.00', '23141618.00', '24298699.00'),
  (2531, 661, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'unit', NULL, '0', '0', '0', '0', '0', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2532, 661, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'unit', NULL, '12', '12', '12', '12', '12', NULL, '7493000.00', '7867650.00', '8261033.00', '8674084.00', '9107788.00'),
  (2533, 661, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah  Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2534, 661, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor dan Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2535, 661, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor dan Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2536, 662, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Laporan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'laporan', NULL, '1', '1', '1', '1', '1', NULL, '114281400.00', '119995470.00', '125995244.00', '132295006.00', '138909756.00'),
  (2537, 663, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Tersedianya Laporan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'laporan', NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '84000000.00', '88200000.00', '92610000.00', '97240500.00'),
  (2538, 664, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terselenggaranya Musrenbang Desa/Kelurahan', 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'dokumen', NULL, '1', '1', '1', '1', '1', NULL, '10000000.00', '10500000.00', '11025000.00', '11576250.00', '12155063.00'),
  (2539, 664, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terselenggaranya Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'laporan', NULL, '4', '4', '4', '4', '4', NULL, '673405000.00', '707075250.00', '742429013.00', '779550463.00', '818527986.00'),
  (2540, 665, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Fasilitasi Penyelenggaraan Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyaraka tan', NULL, '1157', '1157', '1157', '1157', '1157', NULL, '20000000.00', '21000000.00', '22050000.00', '23152500.00', '24310125.00'),
  (2541, 666, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terselenggaranya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'laporan', NULL, '4', '4', '4', '4', '4', NULL, '14172000.00', '14880600.00', '15624630.00', '16405862.00', '17226155.00'),
  (2542, 667, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'dokumen', NULL, '20', '20', '20', '20', '20', NULL, '14908500.00', '15653925.00', '16436621.00', '17258452.00', '18121375.00');

-- Table: renstra_sub_kegiatan_sasaran (31 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2541, 2512, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2542, 2513, 'Tersusunnya Dokumen Laporan Capaian Kinerja', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2543, 2514, 'Terlaksananya Penyediaan Gaji dan Tunjangan ASN', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2544, 2515, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2545, 2516, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2546, 2517, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2547, 2518, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2548, 2519, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2549, 2520, 'Terselenggaranya Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2550, 2521, 'Tersedianya Mebel', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2551, 2522, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2552, 2523, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2553, 2524, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2554, 2525, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2555, 2526, 'Tersedianya Jasa Surat Menyurat', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2556, 2527, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2557, 2528, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2558, 2529, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2559, 2530, 'Terlaksananya Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2560, 2531, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2561, 2532, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2562, 2533, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2563, 2534, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2564, 2535, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2565, 2536, 'Tersedianya Laporan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2566, 2537, 'Tersedianya Laporan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2567, 2538, 'Terselenggaranya Musrenbang Desa/Kelurahan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2568, 2539, 'Terselenggaranya Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2569, 2540, 'Terlaksananya Fasilitasi Penyelenggaraan Lembaga Kemasyarakatan', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2570, 2541, 'Terselenggaranya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2571, 2542, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

-- Table: renstra_sub_kegiatan_indikator (31 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2607, 2512, 2541, 130, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'dokumen', '1', '1', '2500000.00', '1', '2500000.00', '1', '2500000.00', '1', '2500000.00', '1', '2500000.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2608, 2513, 2542, 130, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'laporan', '7', '7', '1500000.00', '7', '1575000.00', '7', '1653750.00', '7', '1736438.00', '7', '1823259.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2609, 2514, 2543, 130, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'org/bln', '15', '14', '2327224591.00', '14', '2443585821.00', '14', '2565765112.00', '14', '2694053367.00', '14', '2828756036.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2610, 2515, 2544, 130, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'paket', '1', '1', '7999500.00', '1', '8399475.00', '1', '8819449.00', '1', '9260421.00', '1', '9723442.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2611, 2516, 2545, 130, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'paket', '1', '2', '20280000.00', '2', '21294000.00', '2', '22358700.00', '2', '23476635.00', '2', '24650467.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2612, 2517, 2546, 130, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'paket', '1', '1', '7999900.00', '1', '7999900.00', '1', '7999900.00', '1', '7999900.00', '1', '7999900.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2613, 2518, 2547, 130, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'paket', '1', '10', '30075000.00', '10', '31578750.00', '10', '33157688.00', '10', '34815572.00', '10', '36556350.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2614, 2519, 2548, 130, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'paket', '1', '2', '6000000.00', '2', '6300000.00', '2', '6615000.00', '2', '6945750.00', '2', '7293038.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2615, 2520, 2549, 130, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'laporan', '1', '11', '54500000.00', '11', '57225000.00', '11', '60086250.00', '11', '63090563.00', '11', '66245091.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2616, 2521, 2550, 130, 'Jumlah Unit Mebel yang Disediakan', 'unit', '', '', '0.00', '0', '0.00', '', '0.00', '', '0.00', '0', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2617, 2522, 2551, 130, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'unit', '', '1', '16500000.00', '1', '17325000.00', '1', '18191250.00', '1', '19100813.00', '1', '20055853.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2618, 2523, 2552, 130, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'unit', '1', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2619, 2524, 2553, 130, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '0', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2620, 2525, 2554, 130, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '0', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2621, 2526, 2555, 130, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'laporan', '1', '1', '2000000.00', '1', '2100000.00', '1', '2205000.00', '1', '2315250.00', '1', '2431013.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2622, 2527, 2556, 130, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'laporan', '12', '12', '51884210.00', '12', '54478421.00', '12', '57202342.00', '12', '60062459.00', '12', '63065582.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2623, 2528, 2557, 130, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'laporan', '1', '1', '5000000.00', '1', '5250000.00', '1', '5512500.00', '1', '5788125.00', '1', '6077531.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2624, 2529, 2558, 130, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'laporan', '12', '12', '123000000.00', '12', '129150000.00', '12', '135607500.00', '12', '142387875.00', '12', '149507269.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2625, 2530, 2559, 130, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipemelihara dan Dibayarkan Pajak dan Perizinannya', 'unit', '1', '5', '19990600.00', '5', '20990130.00', '5', '22039637.00', '5', '23141618.00', '5', '24298699.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2626, 2531, 2560, 130, 'Jumlah Mebel yang Dipelihara', 'unit', '', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', '0', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2627, 2532, 2561, 130, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'unit', '1', '12', '7493000.00', '12', '7867650.00', '12', '8261033.00', '12', '8674084.00', '12', '9107788.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2628, 2533, 2562, 130, 'Jumlah  Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'unit', '-', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2629, 2534, 2563, 130, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'unit', '-', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2630, 2535, 2564, 130, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'unit', '-', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2631, 2536, 2565, 130, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'laporan', '1', '1', '114281400.00', '1', '119995470.00', '1', '125995244.00', '1', '132295006.00', '1', '138909756.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2632, 2537, 2566, 130, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'laporan', '4', '4', '80000000.00', '4', '84000000.00', '4', '88200000.00', '4', '92610000.00', '4', '97240500.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2633, 2538, 2567, 130, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'dokumen', '1', '1', '10000000.00', '1', '10500000.00', '1', '11025000.00', '1', '11576250.00', '1', '12155063.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2634, 2539, 2568, 130, 'Jumlah Laporan Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'laporan', '4', '4', '673405000.00', '4', '707075250.00', '4', '742429013.00', '4', '779550463.00', '4', '818527986.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2635, 2540, 2569, 130, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyaraka tan', '1157', '1157', '20000000.00', '1157', '21000000.00', '1157', '22050000.00', '1157', '23152500.00', '1157', '24310125.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2636, 2541, 2570, 130, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'laporan', '4', '4', '14172000.00', '4', '14880600.00', '4', '15624630.00', '4', '16405862.00', '4', '17226155.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL),
  (2637, 2542, 2571, 130, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'dokumen', '20', '20', '14908500.00', '20', '15653925.00', '20', '16436621.00', '20', '17258452.00', '20', '18121375.00', 10, '2026-09-27 22:36:24', '2026-09-27 22:36:24', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
