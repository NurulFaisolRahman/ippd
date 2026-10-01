-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN GAMBIRAN
-- ID INSTANSI: 129 | KODE: 7.01.0.00.0.00.17.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-27 22:14:16
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN GAMBIRAN) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (129, '7.01.0.00.0.00.17.000', '35.10', 'Kecamatan Gambiran', '7.01', NULL, NULL, '$2y$10$cNZeYJ/KLAsUJ42SfR.28eTwKwGjYgs5kTXx.UvezQ38JO8ZaqnUG', 4, 2025, 2029, '2026-09-21 16:29:47', '2026-09-27 22:13:58', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN GAMBIRAN SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2437, 2438, 2439, 2440, 2441, 2442, 2443, 2444, 2445, 2446, 2447, 2448, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2437, 2438, 2439, 2440, 2441, 2442, 2443, 2444, 2445, 2446, 2447, 2448, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (196, 197, 198, 199, 200);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (196, 197, 198, 199, 200);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (196, 197, 198, 199, 200);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (101, 102);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (101, 102);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (37);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (37);
DELETE FROM `renstra_tujuan` WHERE `id` IN (37) OR (`id_instansi` = 129 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN GAMBIRAN
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (37, '35.10', 129, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (54, 37, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (101, 37, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (102, 37, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (150, 101, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (151, 102, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (196, 101, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, '95.5', '96', '96.5', '97', '97', NULL, '2188115482.00', '2193532411.00', '2193750553.00', '2211136028.00', '2288570718.00'),
  (197, 102, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194282000.00', '194282000.00', '194282000.00', '194282000.00', '194282000.00'),
  (198, 102, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '466991500.00', '466991500.00', '466991500.00', '466991500.00', '466991500.00'),
  (199, 102, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '8592000.00', '8592000.00', '8592000.00', '8592000.00', '8592000.00'),
  (200, 102, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '8939200.00', '8939200.00', '8939200.00', '8939200.00', '8939200.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (242, 196, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (243, 197, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (244, 198, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (245, 199, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (246, 200, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pmerintahan Desa', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (365, 196, 242, 129, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '95', '95.5', '96', '96.5', '97', '97', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 10),
  (366, 197, 243, 129, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 10),
  (367, 198, 244, 129, 'Persentase kegiatan pemberdayaan masyarakat yang terlaksana', '%', '27', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 10),
  (368, 199, 245, 129, 'Persentase Penyelesaian Pengaduan Masyarakat', '%', '100', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 10),
  (369, 200, 246, 129, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu', '%', '90', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (621, 196, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '3996900.00', '3996900.00', '3996900.00', '3996900.00', '3996900.00'),
  (622, 196, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00'),
  (623, 196, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '9', '9', '9', '9', '9', NULL, '180932900.00', '180932900.00', '180932900.00', '180932900.00', '180932900.00'),
  (624, 196, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '30', '30', '30', '30', '30', NULL, '42524255.00', '18024255.00', '18024255.00', '18024255.00', '142979491.00'),
  (625, 196, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '126847036.00', '126847036.00', '126847036.00', '126847036.00', '126847036.00'),
  (626, 196, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '', '', '', '1', '', NULL, '33587600.00', '63504529.00', '63722671.00', '81108146.00', '33587600.00'),
  (627, 197, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (628, 197, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (629, 198, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '446991500.00', '446991500.00', '446991500.00', '446991500.00', '446991500.00'),
  (630, 198, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '6', '6', '6', '6', '6', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (631, 199, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '8592000.00', '8592000.00', '8592000.00', '8592000.00', '8592000.00'),
  (632, 200, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '8939200.00', '8939200.00', '8939200.00', '8939200.00', '8939200.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (676, 621, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (677, 622, 'Cakupan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (678, 623, 'Cakupan Administrasi Umum Perangkat Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (679, 624, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (680, 625, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (681, 626, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (682, 627, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (683, 628, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (684, 629, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (685, 630, 'Cakupan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (686, 631, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (687, 632, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

-- Table: renstra_kegiatan_indikator (31 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2349, 621, 676, 129, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '1', '1', '3996900.00', '1', '3996900.00', '1', '3996900.00', '1', '3996900.00', '1', '3996900.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2350, 621, 676, 129, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '7', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', 20, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2351, 622, 677, 129, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '14', '12', '1800226791.00', '12', '1800226791.00', '12', '1800226791.00', '12', '1800226791.00', '12', '1800226791.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2352, 623, 678, 129, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '9', '9', '180932900.00', '9', '180932900.00', '9', '180932900.00', '9', '180932900.00', '9', '180932900.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2353, 623, 678, 129, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2354, 623, 678, 129, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 30, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2355, 623, 678, 129, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 40, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2356, 623, 678, 129, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 50, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2357, 623, 678, 129, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 60, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2358, 624, 679, 129, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '8', '30', '42524255.00', '30', '18024255.00', '30', '18024255.00', '30', '18024255.00', '30', '142979491.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2359, 624, 679, 129, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '2', '2', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2360, 624, 679, 129, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '2', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 30, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2361, 624, 679, 129, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 40, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2362, 624, 679, 129, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 50, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2363, 625, 680, 129, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '126847036.00', '12', '126847036.00', '12', '126847036.00', '12', '126847036.00', '12', '126847036.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2364, 625, 680, 129, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2365, 625, 680, 129, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2366, 625, 680, 129, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', '1', '1', '0.00', '12', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2367, 626, 681, 129, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '', '33587600.00', '', '63504529.00', '', '63722671.00', '1', '81108146.00', '', '33587600.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2368, 626, 681, 129, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2369, 626, 681, 129, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2370, 626, 681, 129, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '', '0.00', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', 40, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2371, 626, 681, 129, 'Jumlah Mebel yang Dipelihara', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '10', '0.00', '', '0.00', 50, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2372, 626, 681, 129, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '6', '6', '0.00', '', '0.00', '6', '0.00', '', '0.00', '6', '0.00', 60, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2373, 627, 682, 129, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', '1', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2374, 628, 683, 129, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '1', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2375, 629, 684, 129, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '4', '4', '446991500.00', '4', '446991500.00', '4', '446991500.00', '4', '446991500.00', '4', '446991500.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2376, 629, 684, 129, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2377, 630, 685, 129, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakatan', '', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2378, 631, 686, 129, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', '1', '1', '8592000.00', '1', '8592000.00', '1', '8592000.00', '1', '8592000.00', '1', '8592000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2379, 632, 687, 129, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '1', '1', '8939200.00', '1', '8939200.00', '1', '8939200.00', '1', '8939200.00', '1', '8939200.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

-- Table: renstra_sub_kegiatan (31 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2428, 621, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2496900.00', '2496900.00', '2496900.00', '2496900.00', '2496900.00'),
  (2429, 621, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (2430, 622, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '12', '12', '12', '12', '12', NULL, '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00', '1800226791.00'),
  (2431, 623, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '12993600.00', '12993600.00', '12993600.00', '12993600.00', '12993600.00'),
  (2432, 623, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '4', '4', '4', '4', '4', NULL, '44497400.00', '44497400.00', '44497400.00', '44497400.00', '44497400.00'),
  (2433, 623, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '12989900.00', '12989900.00', '12989900.00', '12989900.00', '12989900.00'),
  (2434, 623, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '9', '9', '9', '9', '9', NULL, '29990000.00', '29990000.00', '29990000.00', '29990000.00', '29990000.00'),
  (2435, 623, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '10997000.00', '10997000.00', '10997000.00', '10997000.00', '10997000.00'),
  (2436, 623, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '69465000.00', '69465000.00', '69465000.00', '69465000.00', '69465000.00'),
  (2437, 624, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '30', '30', '30', '30', '30', NULL, '18024255.00', '18024255.00', '18024255.00', '18024255.00', '18024255.00'),
  (2438, 624, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', NULL, '2', '', '', '', '', NULL, '24500000.00', '0.00', '0.00', '0.00', '0.00'),
  (2439, 624, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '79955236.00'),
  (2440, 624, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '30000000.00'),
  (2441, 624, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '15000000.00'),
  (2442, 625, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '3600000.00', '3600000.00', '3600000.00', '3600000.00', '3600000.00'),
  (2443, 625, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '24247036.00', '24247036.00', '24247036.00', '24247036.00', '24247036.00'),
  (2444, 625, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', NULL, '1', '12', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (2445, 625, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '84000000.00', '84000000.00', '84000000.00', '84000000.00', '84000000.00'),
  (2446, 626, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '19837600.00', '19837600.00', '19837600.00', '19837600.00', '19837600.00'),
  (2447, 626, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara (Unit)', 'Unit', NULL, '', '', '', '10', '', NULL, '0.00', '0.00', '0.00', '20000000.00', '0.00'),
  (2448, 626, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '6', '', '6', '', '6', NULL, '13750000.00', '0.00', '13750000.00', '0.00', '13750000.00'),
  (2449, 626, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '1', '', '', '', NULL, '0.00', '43666929.00', '0.00', '0.00', '0.00'),
  (2450, 626, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '', '', '1', '', NULL, '0.00', '0.00', '0.00', '41270546.00', '0.00'),
  (2451, 626, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '', '1', '', '', NULL, '0.00', '0.00', '30135071.00', '0.00', '0.00'),
  (2452, 627, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (2453, 628, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (2454, 629, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '9981500.00', '9981500.00', '9981500.00', '9981500.00', '9981500.00'),
  (2455, 629, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '437010000.00', '437010000.00', '437010000.00', '437010000.00', '437010000.00'),
  (2456, 630, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terselenggaranya Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakatan', NULL, '6', '6', '6', '6', '6', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2457, 631, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '8592000.00', '8592000.00', '8592000.00', '8592000.00', '8592000.00'),
  (2458, 632, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '8939200.00', '8939200.00', '8939200.00', '8939200.00', '8939200.00');

-- Table: renstra_sub_kegiatan_sasaran (31 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2457, 2428, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2458, 2429, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2459, 2430, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2460, 2431, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2461, 2432, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2462, 2433, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2463, 2434, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2464, 2435, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2465, 2436, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2466, 2437, 'Tersedianya Mebel', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2467, 2438, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2468, 2439, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2469, 2440, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2470, 2441, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2471, 2442, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2472, 2443, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2473, 2444, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2474, 2445, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2475, 2446, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2476, 2447, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2477, 2448, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2478, 2449, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2479, 2450, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2480, 2451, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2481, 2452, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2482, 2453, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2483, 2454, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2484, 2455, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2485, 2456, 'Terselenggaranya Lembaga Kemasyarakatan', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2486, 2457, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2487, 2458, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

-- Table: renstra_sub_kegiatan_indikator (31 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2523, 2428, 2457, 129, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '1', '1', '2496900.00', '1', '2496900.00', '1', '2496900.00', '1', '2496900.00', '1', '2496900.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2524, 2429, 2458, 129, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '7', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2525, 2430, 2459, 129, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '14', '12', '1800226791.00', '12', '1800226791.00', '12', '1800226791.00', '12', '1800226791.00', '12', '1800226791.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2526, 2431, 2460, 129, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '3', '3', '12993600.00', '3', '12993600.00', '3', '12993600.00', '3', '12993600.00', '3', '12993600.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2527, 2432, 2461, 129, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '4', '4', '44497400.00', '4', '44497400.00', '4', '44497400.00', '4', '44497400.00', '4', '44497400.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2528, 2433, 2462, 129, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '3', '3', '12989900.00', '3', '12989900.00', '3', '12989900.00', '3', '12989900.00', '3', '12989900.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2529, 2434, 2463, 129, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '9', '9', '29990000.00', '9', '29990000.00', '9', '29990000.00', '9', '29990000.00', '9', '29990000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2530, 2435, 2464, 129, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '3', '3', '10997000.00', '3', '10997000.00', '3', '10997000.00', '3', '10997000.00', '3', '10997000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2531, 2436, 2465, 129, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '12', '12', '69465000.00', '12', '69465000.00', '12', '69465000.00', '12', '69465000.00', '12', '69465000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2532, 2437, 2466, 129, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '8', '30', '18024255.00', '30', '18024255.00', '30', '18024255.00', '30', '18024255.00', '30', '18024255.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2533, 2438, 2467, 129, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '2', '2', '24500000.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2534, 2439, 2468, 129, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '2', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '79955236.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2535, 2440, 2469, 129, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '30000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2536, 2441, 2470, 129, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '15000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2537, 2442, 2471, 129, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '3600000.00', '1', '3600000.00', '1', '3600000.00', '1', '3600000.00', '1', '3600000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2538, 2443, 2472, 129, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '24247036.00', '12', '24247036.00', '12', '24247036.00', '12', '24247036.00', '12', '24247036.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2539, 2444, 2473, 129, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', '1', '1', '15000000.00', '12', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2540, 2445, 2474, 129, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '84000000.00', '12', '84000000.00', '12', '84000000.00', '12', '84000000.00', '12', '84000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2541, 2446, 2475, 129, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '1', '1', '19837600.00', '1', '19837600.00', '1', '19837600.00', '1', '19837600.00', '1', '19837600.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2542, 2447, 2476, 129, 'Jumlah Mebel yang Dipelihara (Unit)', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '10', '20000000.00', '', '0.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2543, 2448, 2477, 129, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '6', '6', '13750000.00', '', '0.00', '6', '13750000.00', '', '0.00', '6', '13750000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2544, 2449, 2478, 129, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '', '0.00', '1', '43666929.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2545, 2450, 2479, 129, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '', '0.00', '', '0.00', '', '0.00', '1', '41270546.00', '', '0.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2546, 2451, 2480, 129, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '', '0.00', '', '0.00', '1', '30135071.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2547, 2452, 2481, 129, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', '1', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2548, 2453, 2482, 129, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '1', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2549, 2454, 2483, 129, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', '1', '1', '9981500.00', '1', '9981500.00', '1', '9981500.00', '1', '9981500.00', '1', '9981500.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2550, 2455, 2484, 129, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '4', '4', '437010000.00', '4', '437010000.00', '4', '437010000.00', '4', '437010000.00', '4', '437010000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2551, 2456, 2485, 129, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakatan', '', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2552, 2457, 2486, 129, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', '1', '1', '8592000.00', '1', '8592000.00', '1', '8592000.00', '1', '8592000.00', '1', '8592000.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL),
  (2553, 2458, 2487, 129, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '1', '1', '8939200.00', '1', '8939200.00', '1', '8939200.00', '1', '8939200.00', '1', '8939200.00', 10, '2026-09-27 22:13:58', '2026-09-27 22:13:58', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
