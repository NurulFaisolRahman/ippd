-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN GIRI
-- ID INSTANSI: 118 | KODE: 7.01.0.00.0.00.06.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-27 22:32:23
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN GIRI) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (118, '7.01.0.00.0.00.06.000', '35.10', 'Kecamatan Giri', '7.01', NULL, NULL, '$2y$10$ZMi.HL2500oUwKsHAFqKF.VYkn9gfYbiKgrlSMULr79VB96OPVcWW', 4, 2025, 2029, '2026-09-21 13:03:12', '2026-09-27 22:32:12', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN GIRI SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2490, 2491, 2492, 2493, 2494, 2495, 2496, 2497, 2498, 2499, 2500, 2501, 2502, 2503, 2504, 2505, 2506, 2507, 2508, 2509, 2510, 2511);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2490, 2491, 2492, 2493, 2494, 2495, 2496, 2497, 2498, 2499, 2500, 2501, 2502, 2503, 2504, 2505, 2506, 2507, 2508, 2509, 2510, 2511);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (206, 207, 208, 209, 210);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (206, 207, 208, 209, 210);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (206, 207, 208, 209, 210);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (105, 106);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (105, 106);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (39);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (39);
DELETE FROM `renstra_tujuan` WHERE `id` IN (39) OR (`id_instansi` = 118 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN GIRI
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (39, '35.10', 118, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (56, 39, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (105, 39, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (106, 39, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (154, 105, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (155, 106, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (206, 105, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '5597008556.00', '5597008556.00', '5597008556.00', '5597008556.00', '5597008556.00'),
  (207, 106, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '124282000.00', '124282000.00', '124282000.00', '124282000.00', '124282000.00'),
  (208, 106, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '989027500.00', '989027500.00', '989027500.00', '989027500.00', '989027500.00'),
  (209, 106, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, '190', '190', '190', '190', '190', NULL, '22327835.00', '22327835.00', '22327835.00', '22327835.00', '22327835.00'),
  (210, 106, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '8945124.00', '8945124.00', '8945124.00', '8945124.00', '8945124.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (252, 206, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (253, 207, 'Meningkatnya Kualitas Penyelenggaraan Pemerintahan dan Pelayanan Publik', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (254, 208, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (255, 209, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (256, 210, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (375, 206, 252, 118, 'Persentase pemenuhan kebutuhan penunjang perangkat daerah', '%', '100', '90', '90', '90', '90', '90', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 10),
  (376, 207, 253, 118, 'Persentase sarana prasarana kecamatan dan kelurahan dalam kondisi baik', '%', '100', '90', '90', '90', '90', '90', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 10),
  (377, 208, 254, 118, 'Persentase keterlibatan masyarakat dalam kegiatan pembangunan', '%', '100', '90', '90', '90', '90', '90', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 10),
  (378, 209, 255, 118, 'Jumlah pelanggaran Perda dan Perbup di Kecamatan', 'Kasus', '100', '190', '190', '190', '190', '190', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 10),
  (379, 210, 256, 118, 'Persentase laporan keuangan desa yang selesai tepat waktu', '%', '100', '90', '90', '90', '90', '90', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 10);

-- Table: renstra_kegiatan (11 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (645, 206, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '2500000.00', '2500000.00', '2500000.00', '2500000.00', '2500000.00'),
  (646, 206, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '4876593596.00', '4876593596.00', '4876593596.00', '4876593596.00', '4876593596.00'),
  (647, 206, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '264821880.00', '264821880.00', '264821880.00', '264821880.00', '264821880.00'),
  (648, 206, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '418212080.00', '418212080.00', '418212080.00', '418212080.00', '418212080.00'),
  (649, 206, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '34881000.00', '34881000.00', '34881000.00', '34881000.00', '34881000.00'),
  (650, 207, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (651, 207, 'Penyelenggaraan Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', '7.01.02.2.02', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (652, 208, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '809027550.00', '809027550.00', '809027550.00', '809027550.00', '809027550.00'),
  (653, 208, 'Kegiatan Pemberdayaan Kelurahan', '7.01.03.2.02', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '179999950.00', '179999950.00', '179999950.00', '179999950.00', '179999950.00'),
  (654, 209, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '90', '90', '90', '90', '90', NULL, '22327835.00', '22327835.00', '22327835.00', '22327835.00', '22327835.00'),
  (655, 210, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '8945124.00', '8945124.00', '8945124.00', '8945124.00', '8945124.00');

-- Table: renstra_kegiatan_sasaran (11 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (700, 645, 'Meningkatnya Kualitas Perencanaan dan Evaluasi Kinerja', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (701, 646, 'Meningkatnya Akuntabilitas Pengelolaan Keuangan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (702, 647, 'Meningkatnya Kualitas Pelayanan Administrasi Perkantoran', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (703, 648, 'Meningkatnya Ketersediaan Jasa Pelayanan Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (704, 649, 'Meningkatnya Kondisi Sarana dan Prasarana Aparatur', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (705, 650, 'Meningkatnya Koordinasi Penyelenggaraan Pemerintahan Kecamatan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (706, 651, 'Terlaksananya Pelayanan kepada Masyarakat di Kecamatan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (707, 652, 'Meningkatnya Koordinasi Pemberdayaan Masyarakat', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (708, 653, 'Meningkatnya Kualitas Sarana Prasarana dan Pemberdayaan Kelurahan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (709, 654, 'Meningkatnya Kepatuhan terhadap Perda dan Perkada', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (710, 655, 'Meningkatnya Kualitas Pengelolaan Keuangan dan Aset Desa', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

-- Table: renstra_kegiatan_indikator (11 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2392, 645, 700, 118, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2393, 646, 701, 118, 'Cakupan Administrasi Keuangan Perangkat Daerah', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2394, 647, 702, 118, 'Cakupan Administrasi Umum Perangkat Daerah', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2395, 648, 703, 118, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2396, 649, 704, 118, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2397, 650, 705, 118, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2398, 651, 706, 118, 'Cakupan Pelayanan kepada Masyarakat di Kecamatan', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2399, 652, 707, 118, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2400, 653, 708, 118, 'Cakupan Kegiatan Pemberdayaan Kelurahan', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2401, 654, 709, 118, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '%', '100', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', '90', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2402, 655, 710, 118, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '%', '100', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

-- Table: renstra_sub_kegiatan (22 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2490, 645, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyusunan Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah yang disediakan', 'Dokumen', NULL, '90', '90', '90', '90', '90', NULL, '2500000.00', '2500000.00', '2500000.00', '2500000.00', '2500000.00'),
  (2491, 646, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Gaji dan Tunjangan ASN', 'Jumlah dokumen penyediaan gaji dan tunjangan ASN', 'Dokumen', NULL, '90', '90', '90', '90', '90', NULL, '4876593596.00', '4876593596.00', '4876593596.00', '4876593596.00', '4876593596.00'),
  (2492, 647, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah komponen instalasi listrik/penerangan bangunan kantor', 'Paket', NULL, '90', '90', '90', '90', '90', NULL, '27972280.00', '27972280.00', '27972280.00', '27972280.00', '27972280.00'),
  (2493, 647, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Peralatan dan Perlengkapan Kantor', 'Jumlah peralatan dan perlengkapan kantor yang disediakan', 'Paket', NULL, '90', '90', '90', '90', '90', NULL, '52000500.00', '52000500.00', '52000500.00', '52000500.00', '52000500.00'),
  (2494, 647, 'Penyediaan Peralatan Rumah Tangga Kantor', '7.01.01.2.06.0003', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Peralatan Rumah Tangga Kantor', 'Jumlah peralatan rumah tangga yang disediakan', 'Paket', NULL, '90', '90', '90', '90', '90', NULL, '17997700.00', '17997700.00', '17997700.00', '17997700.00', '17997700.00'),
  (2495, 647, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Bahan Logistik Kantor', 'Jumlah bahan logistik kantor yang di sediakan', 'Paket', NULL, '90', '90', '90', '90', '90', NULL, '37495000.00', '37495000.00', '37495000.00', '37495000.00', '37495000.00'),
  (2496, 647, 'Penyediaan Barang Cetakan dan Penggadaan', '7.01.01.2.06.0005', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Barang Cetakan dan Penggadaan', 'Jenis barang cetakan dan penggandaan yang di sediakan', 'Paket', NULL, '90', '90', '90', '90', '90', NULL, '25999600.00', '25999600.00', '25999600.00', '25999600.00', '25999600.00'),
  (2497, 647, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '103356800.00', '103356800.00', '103356800.00', '103356800.00', '103356800.00'),
  (2498, 648, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah prangko, materai, dan benda pos lainya yang di sediakan', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '6000000.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (2499, 648, 'Penyediaan Jasa Komunikasi, Sumberdaya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Jasa Komunikasi, Sumberdaya Air dan Listrik', 'Jumlah tagihan jasa komunikasi  sumber daya air dan listrik', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '110212080.00', '110212080.00', '110212080.00', '110212080.00', '110212080.00'),
  (2500, 648, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah peralatan dan perlengkapan yg di sediakan', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '5000000.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (2501, 648, 'Penyediaan  Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan  Jasa Pelayanan Umum Kantor', 'Jumlah jasa pelayanan umum kantor yang di sediakan', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '297000000.00', '297000000.00', '297000000.00', '297000000.00', '297000000.00'),
  (2502, 649, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah kendaraan dinas/operasional yang di pelihara (jasa pemeliharaan)', 'Unit', NULL, '90', '90', '90', '90', '90', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2503, 649, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin yang dipelihara', 'Unit', NULL, '90', '90', '90', '90', '90', NULL, '14881000.00', '14881000.00', '14881000.00', '14881000.00', '14881000.00'),
  (2504, 650, 'Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01.0002', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Jumlah kegiatan pemerintah yang dilaksanakan di tingkat kecamatan', 'Dokumen', NULL, '90', '90', '90', '90', '90', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (2505, 651, 'Perencanaan Kegiatan Pelayanan kepada Masyarakat di Kecamatan', '7.01.02.2.02.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Perencanaan Kegiatan Pelayanan kepada Masyarakat di Kecamatan', 'Jumlah fasilitas pelaksanaan musrenbang RKPD di Kecamatan', 'Dokumen', NULL, '90', '90', '90', '90', '90', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (2506, 652, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah kegiatan pemberdayaan Masyarakat di wilayah kecamatan yang dilaksanakan', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '809027550.00', '809027550.00', '809027550.00', '809027550.00', '809027550.00'),
  (2507, 653, 'Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', '7.01.03.2.02.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', 'Jumlah partisipasi masyarakat dalam forum musyawarah perencanaan pembangunan di kelurahan yang ditingkatkan', 'Lembaga Kemasyarakatan', NULL, '90', '90', '90', '90', '90', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2508, 653, 'Pembangunan Sarana dan Prasarana Kelurahan', '7.01.03.2.02.0002', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Pembangunan Sarana dan Prasarana Kelurahan', 'Jumlah Sarana dan Prasarana yang dibangun', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (2509, 653, 'Pemberdayaan Masyarakat di Kelurahan', '7.01.03.2.02.0003', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Pemberdayaan Masyarakat di Kelurahan', 'Jumlah masyarakat di kelurahan yang diberdayakan', 'Pokmas / Ormas', NULL, '90', '90', '90', '90', '90', NULL, '159999950.00', '159999950.00', '159999950.00', '159999950.00', '159999950.00'),
  (2510, 654, 'Koordinasi/sinergi dengan perangkat daerahyang tugas dan fungsinya dibidang penegakan peraturan perundang dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Koordinasi/sinergi dengan perangkat daerahyang tugas dan fungsinya dibidang penegakan peraturan perundang dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah fasilitas penegakan perda dan perbup di kecamatan', 'Laporan', NULL, '90', '90', '90', '90', '90', NULL, '22327835.00', '22327835.00', '22327835.00', '22327835.00', '22327835.00'),
  (2511, 655, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah  kegiatan optimalisasi  dan pengembangan potensi lokal', 'Dokumen', NULL, '100', '100', '100', '100', '100', NULL, '8945124.00', '8945124.00', '8945124.00', '8945124.00', '8945124.00');

-- Table: renstra_sub_kegiatan_sasaran (22 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2519, 2490, 'Terlaksananya Penyusunan Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2520, 2491, 'Terlaksananya Penyediaan Gaji dan Tunjangan ASN', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2521, 2492, 'Terlaksananya Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2522, 2493, 'Terlaksananya Penyediaan Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2523, 2494, 'Terlaksananya Penyediaan Peralatan Rumah Tangga Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2524, 2495, 'Terlaksananya Penyediaan Bahan Logistik Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2525, 2496, 'Terlaksananya Penyediaan Barang Cetakan dan Penggadaan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2526, 2497, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2527, 2498, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2528, 2499, 'Terlaksananya Penyediaan Jasa Komunikasi, Sumberdaya Air dan Listrik', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2529, 2500, 'Terlaksananya Penyediaan Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2530, 2501, 'Terlaksananya Penyediaan  Jasa Pelayanan Umum Kantor', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2531, 2502, 'Terlaksananya Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2532, 2503, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2533, 2504, 'Terlaksananya Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2534, 2505, 'Terlaksananya Perencanaan Kegiatan Pelayanan kepada Masyarakat di Kecamatan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2535, 2506, 'Terlaksananya Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2536, 2507, 'Terlaksananya Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Kelurahan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2537, 2508, 'Terlaksananya Pembangunan Sarana dan Prasarana Kelurahan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2538, 2509, 'Terlaksananya Pemberdayaan Masyarakat di Kelurahan', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2539, 2510, 'Terlaksananya Koordinasi/sinergi dengan perangkat daerahyang tugas dan fungsinya dibidang penegakan peraturan perundang dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2540, 2511, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

-- Table: renstra_sub_kegiatan_indikator (22 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2585, 2490, 2519, 118, 'Jumlah Dokumen Perencanaan Perangkat Daerah yang disediakan', 'Dokumen', '100', '90', '2500000.00', '90', '2500000.00', '90', '2500000.00', '90', '2500000.00', '90', '2500000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2586, 2491, 2520, 118, 'Jumlah dokumen penyediaan gaji dan tunjangan ASN', 'Dokumen', '100', '90', '4876593596.00', '90', '4876593596.00', '90', '4876593596.00', '90', '4876593596.00', '90', '4876593596.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2587, 2492, 2521, 118, 'Jumlah komponen instalasi listrik/penerangan bangunan kantor', 'Paket', '100', '90', '27972280.00', '90', '27972280.00', '90', '27972280.00', '90', '27972280.00', '90', '27972280.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2588, 2493, 2522, 118, 'Jumlah peralatan dan perlengkapan kantor yang disediakan', 'Paket', '100', '90', '52000500.00', '90', '52000500.00', '90', '52000500.00', '90', '52000500.00', '90', '52000500.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2589, 2494, 2523, 118, 'Jumlah peralatan rumah tangga yang disediakan', 'Paket', '100', '90', '17997700.00', '90', '17997700.00', '90', '17997700.00', '90', '17997700.00', '90', '17997700.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2590, 2495, 2524, 118, 'Jumlah bahan logistik kantor yang di sediakan', 'Paket', '100', '90', '37495000.00', '90', '37495000.00', '90', '37495000.00', '90', '37495000.00', '90', '37495000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2591, 2496, 2525, 118, 'Jenis barang cetakan dan penggandaan yang di sediakan', 'Paket', '100', '90', '25999600.00', '90', '25999600.00', '90', '25999600.00', '90', '25999600.00', '90', '25999600.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2592, 2497, 2526, 118, 'Jumlah rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '100', '90', '103356800.00', '90', '103356800.00', '90', '103356800.00', '90', '103356800.00', '90', '103356800.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2593, 2498, 2527, 118, 'Jumlah prangko, materai, dan benda pos lainya yang di sediakan', 'Laporan', '100', '90', '6000000.00', '90', '6000000.00', '90', '6000000.00', '90', '6000000.00', '90', '6000000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2594, 2499, 2528, 118, 'Jumlah tagihan jasa komunikasi  sumber daya air dan listrik', 'Laporan', '100', '90', '110212080.00', '90', '110212080.00', '90', '110212080.00', '90', '110212080.00', '90', '110212080.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2595, 2500, 2529, 118, 'Jumlah peralatan dan perlengkapan yg di sediakan', 'Laporan', '100', '90', '5000000.00', '90', '5000000.00', '90', '5000000.00', '90', '5000000.00', '90', '5000000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2596, 2501, 2530, 118, 'Jumlah jasa pelayanan umum kantor yang di sediakan', 'Laporan', '100', '90', '297000000.00', '90', '297000000.00', '90', '297000000.00', '90', '297000000.00', '90', '297000000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2597, 2502, 2531, 118, 'Jumlah kendaraan dinas/operasional yang di pelihara (jasa pemeliharaan)', 'Unit', '100', '90', '20000000.00', '90', '20000000.00', '90', '20000000.00', '90', '20000000.00', '90', '20000000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2598, 2503, 2532, 118, 'Jumlah Peralatan dan Mesin yang dipelihara', 'Unit', '100', '90', '14881000.00', '90', '14881000.00', '90', '14881000.00', '90', '14881000.00', '90', '14881000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2599, 2504, 2533, 118, 'Jumlah kegiatan pemerintah yang dilaksanakan di tingkat kecamatan', 'Dokumen', '100', '90', '114282000.00', '90', '114282000.00', '90', '114282000.00', '90', '114282000.00', '90', '114282000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2600, 2505, 2534, 118, 'Jumlah fasilitas pelaksanaan musrenbang RKPD di Kecamatan', 'Dokumen', '100', '90', '10000000.00', '90', '10000000.00', '90', '10000000.00', '90', '10000000.00', '90', '10000000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2601, 2506, 2535, 118, 'Jumlah kegiatan pemberdayaan Masyarakat di wilayah kecamatan yang dilaksanakan', 'Laporan', '100', '90', '809027550.00', '90', '809027550.00', '90', '809027550.00', '90', '809027550.00', '90', '809027550.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2602, 2507, 2536, 118, 'Jumlah partisipasi masyarakat dalam forum musyawarah perencanaan pembangunan di kelurahan yang ditingkatkan', 'Lembaga Kemasyarakatan', '100', '90', '20000000.00', '90', '20000000.00', '90', '20000000.00', '90', '20000000.00', '90', '20000000.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2603, 2508, 2537, 118, 'Jumlah Sarana dan Prasarana yang dibangun', 'Unit', '100', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2604, 2509, 2538, 118, 'Jumlah masyarakat di kelurahan yang diberdayakan', 'Pokmas / Ormas', '100', '90', '159999950.00', '90', '159999950.00', '90', '159999950.00', '90', '159999950.00', '90', '159999950.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2605, 2510, 2539, 118, 'Jumlah fasilitas penegakan perda dan perbup di kecamatan', 'Laporan', '100', '90', '22327835.00', '90', '22327835.00', '90', '22327835.00', '90', '22327835.00', '90', '22327835.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL),
  (2606, 2511, 2540, 118, 'Jumlah  kegiatan optimalisasi  dan pengembangan potensi lokal', 'Dokumen', '', '100', '8945124.00', '100', '8945124.00', '100', '8945124.00', '100', '8945124.00', '100', '8945124.00', 10, '2026-09-27 22:32:12', '2026-09-27 22:32:12', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
