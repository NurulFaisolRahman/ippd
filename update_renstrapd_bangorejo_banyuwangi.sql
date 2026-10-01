-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN BANGOREJO
-- ID INSTANSI: 126 | KODE: 7.01.0.00.0.00.14.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-27 22:02:12
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN BANGOREJO) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (126, '7.01.0.00.0.00.14.000', '35.10', 'Kecamatan Bangorejo', '7.01', NULL, NULL, '$2y$10$MW2fcAivd1ry6E1MnF1YLOv3jLO.N4ZOn/jLpSxYYRgbu8L/sbH0C', 4, 2025, 2029, '2026-09-21 16:27:38', '2026-09-27 22:01:58', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN BANGOREJO SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2397, 2398, 2399, 2400, 2401, 2402, 2403, 2404, 2405, 2406, 2407, 2408, 2409, 2410, 2411, 2412, 2413, 2414, 2415, 2416, 2417, 2418, 2419, 2420, 2421, 2422, 2423, 2424, 2425, 2426, 2427);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2397, 2398, 2399, 2400, 2401, 2402, 2403, 2404, 2405, 2406, 2407, 2408, 2409, 2410, 2411, 2412, 2413, 2414, 2415, 2416, 2417, 2418, 2419, 2420, 2421, 2422, 2423, 2424, 2425, 2426, 2427);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (191, 192, 193, 194, 195);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (191, 192, 193, 194, 195);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (191, 192, 193, 194, 195);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (99, 100);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (99, 100);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (36);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (36);
DELETE FROM `renstra_tujuan` WHERE `id` IN (36) OR (`id_instansi` = 126 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN BANGOREJO
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (36, '35.10', 126, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '87', '89', '90', '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (53, 36, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '87', '89', '90', 1, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (99, 36, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (100, 36, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (148, 99, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (149, 100, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (191, 99, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, '93.7', '94.9', '96.1', '97.3', '98.5', NULL, '2063304856.00', '2068505807.00', '2068715252.00', '2085407552.00', '2159754847.00'),
  (192, 100, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194282000.00', '194282000.00', '194282000.00', '194282000.00', '194282000.00'),
  (193, 100, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '470117966.00', '470117966.00', '470117966.00', '470117966.00', '470117966.00'),
  (194, 100, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (195, 100, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '14908500.00', '14908500.00', '14908500.00', '14908500.00', '14908500.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (237, 191, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (238, 192, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (239, 193, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (240, 194, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (241, 195, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pmerintahan Desa', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (360, 191, 237, 126, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '93.7', '94.9', '96.1', '97.3', '98.5', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 10),
  (361, 192, 238, 126, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 10),
  (362, 193, 239, 126, 'Persentase kegiatan pemberdayaan masyarakat yang terlaksana', '%', '', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 10),
  (363, 194, 240, 126, 'Persentase Penyelesaian Pengaduan Masyarakat', '%', '', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 10),
  (364, 195, 241, 126, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu', '%', '', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (609, 191, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '3999850.00', '3999850.00', '3999850.00', '3999850.00', '3999850.00'),
  (610, 191, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '297', '297', '297', '297', '297', NULL, '1776561510.00', '1776561510.00', '1776561510.00', '1776561510.00', '1776561510.00'),
  (611, 191, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '5', '5', '5', '5', '5', NULL, '107623900.00', '107623900.00', '107623900.00', '107623900.00', '107623900.00'),
  (612, 191, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '3', '', '', '', '', NULL, '22752300.00', '0.00', '5000000.00', '0.00', '119202291.00'),
  (613, 191, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '128997596.00', '128997596.00', '128997596.00', '128997596.00', '128997596.00'),
  (614, 191, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '', '', '', '1', '', NULL, '23369700.00', '51322951.00', '46532396.00', '68224696.00', '23369700.00'),
  (615, 192, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (616, 192, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (617, 193, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '450117966.00', '450117966.00', '450117966.00', '450117966.00', '450117966.00'),
  (618, 193, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (619, 194, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (620, 195, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '14908500.00', '14908500.00', '14908500.00', '14908500.00', '14908500.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (664, 609, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (665, 610, 'Cakupan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (666, 611, 'Cakupan Administrasi Umum Perangkat Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (667, 612, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (668, 613, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (669, 614, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (670, 615, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (671, 616, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (672, 617, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (673, 618, 'Cakupan Kegiatan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (674, 619, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (675, 620, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

-- Table: renstra_kegiatan_indikator (31 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2318, 609, 664, 126, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '', '1', '3999850.00', '1', '3999850.00', '1', '3999850.00', '1', '3999850.00', '1', '3999850.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2319, 609, 664, 126, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', 20, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2320, 610, 665, 126, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '', '297', '1776561510.00', '297', '1776561510.00', '297', '1776561510.00', '297', '1776561510.00', '297', '1776561510.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2321, 611, 666, 126, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '', '5', '107623900.00', '5', '107623900.00', '5', '107623900.00', '5', '107623900.00', '5', '107623900.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2322, 611, 666, 126, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 20, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2323, 611, 666, 126, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2324, 611, 666, 126, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', 40, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2325, 611, 666, 126, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 50, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2326, 611, 666, 126, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 60, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2327, 612, 667, 126, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '3', '22752300.00', '', '0.00', '', '5000000.00', '', '0.00', '', '119202291.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2328, 612, 667, 126, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '', '2', '0.00', '', '0.00', '3', '0.00', '', '0.00', '', '0.00', 20, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2329, 612, 667, 126, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2330, 612, 667, 126, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '1', '0.00', 40, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2331, 612, 667, 126, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 50, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2332, 613, 668, 126, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '', '12', '128997596.00', '12', '128997596.00', '12', '128997596.00', '12', '128997596.00', '12', '128997596.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2333, 613, 668, 126, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 20, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2334, 613, 668, 126, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2335, 613, 668, 126, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', '', '1', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 40, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2336, 614, 669, 126, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '23369700.00', '', '51322951.00', '', '46532396.00', '1', '68224696.00', '', '23369700.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2337, 614, 669, 126, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 20, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2338, 614, 669, 126, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2339, 614, 669, 126, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '2', '0.00', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', 40, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2340, 614, 669, 126, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '5', '0.00', '5', '0.00', '5', '0.00', '10', '0.00', '', '0.00', 50, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2341, 614, 669, 126, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '', '5', '0.00', '', '0.00', '5', '0.00', '', '0.00', '5', '0.00', 60, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2342, 615, 670, 126, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', '', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2343, 616, 671, 126, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2344, 617, 672, 126, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '', '4', '450117966.00', '4', '450117966.00', '4', '450117966.00', '4', '450117966.00', '4', '450117966.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2345, 617, 672, 126, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2346, 618, 673, 126, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakatan', '', '4', '20000000.00', '4', '20000000.00', '4', '20000000.00', '4', '20000000.00', '4', '20000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2347, 619, 674, 126, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', '', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2348, 620, 675, 126, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '', '4', '14908500.00', '4', '14908500.00', '4', '14908500.00', '4', '14908500.00', '4', '14908500.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

-- Table: renstra_sub_kegiatan (31 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2397, 609, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2499850.00', '2499850.00', '2499850.00', '2499850.00', '2499850.00'),
  (2398, 609, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (2399, 610, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '297', '297', '297', '297', '297', NULL, '1776561510.00', '1776561510.00', '1776561510.00', '1776561510.00', '1776561510.00'),
  (2400, 611, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '25', '25', '25', '25', '25', NULL, '7959500.00', '7959500.00', '7959500.00', '7959500.00', '7959500.00'),
  (2401, 611, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '17237750.00', '17237750.00', '17237750.00', '17237750.00', '17237750.00'),
  (2402, 611, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '4', '4', '4', '4', '4', NULL, '7991000.00', '7991000.00', '7991000.00', '7991000.00', '7991000.00'),
  (2403, 611, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '5', '5', '5', '5', '5', NULL, '23440000.00', '23440000.00', '23440000.00', '23440000.00', '23440000.00'),
  (2404, 611, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '5995650.00', '5995650.00', '5995650.00', '5995650.00', '5995650.00'),
  (2405, 611, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '5', '5', '5', '5', '5', NULL, '45000000.00', '45000000.00', '45000000.00', '45000000.00', '45000000.00'),
  (2406, 612, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '3', '', '', '', '', NULL, '22752300.00', '0.00', '0.00', '0.00', '0.00'),
  (2407, 612, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', NULL, '2', '', '3', '', '', NULL, '0.00', '0.00', '5000000.00', '0.00', '0.00'),
  (2408, 612, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '0.00', '0.00', '0.00', '74202291.00'),
  (2409, 612, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '1', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '30000000.00'),
  (2410, 612, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '4', '4', '4', '4', '1', NULL, '0.00', '0.00', '0.00', '0.00', '15000000.00'),
  (2411, 613, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '5', '5', '5', '5', '5', NULL, '1999000.00', '1999000.00', '1999000.00', '1999000.00', '1999000.00'),
  (2412, 613, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '37999096.00', '37999096.00', '37999096.00', '37999096.00', '37999096.00'),
  (2413, 613, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', NULL, '1', '12', '12', '12', '12', NULL, '4999500.00', '4999500.00', '4999500.00', '4999500.00', '4999500.00'),
  (2414, 613, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '84000000.00', '84000000.00', '84000000.00', '84000000.00', '84000000.00'),
  (2415, 614, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '4', '4', '4', '4', '4', NULL, '15874700.00', '15874700.00', '15874700.00', '15874700.00', '15874700.00'),
  (2416, 614, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'Unit', NULL, '5', '5', '5', '10', '', NULL, '0.00', '0.00', '0.00', '20000000.00', '0.00'),
  (2417, 614, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '5', '', '5', '', '5', NULL, '7495000.00', '0.00', '7495000.00', '0.00', '7495000.00'),
  (2418, 614, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '1', '', '', '', NULL, '0.00', '35448251.00', '0.00', '0.00', '0.00'),
  (2419, 614, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '', '', '1', '', NULL, '0.00', '0.00', '0.00', '32349996.00', '0.00'),
  (2420, 614, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '2', '', '1', '', '', NULL, '0.00', '0.00', '23162696.00', '0.00', '0.00'),
  (2421, 615, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '114282000.00', '114282000.00', '114282000.00', '114282000.00', '114282000.00'),
  (2422, 616, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (2423, 617, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '9991700.00', '9991700.00', '9991700.00', '9991700.00', '9991700.00'),
  (2424, 617, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '440126266.00', '440126266.00', '440126266.00', '440126266.00', '440126266.00'),
  (2425, 618, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terselenggaranya Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakatan', NULL, '4', '4', '4', '4', '4', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2426, 619, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (2427, 620, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '14908500.00', '14908500.00', '14908500.00', '14908500.00', '14908500.00');

-- Table: renstra_sub_kegiatan_sasaran (31 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2426, 2397, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2427, 2398, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2428, 2399, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2429, 2400, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2430, 2401, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2431, 2402, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2432, 2403, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2433, 2404, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2434, 2405, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2435, 2406, 'Tersedianya Mebel', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2436, 2407, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2437, 2408, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2438, 2409, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2439, 2410, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2440, 2411, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2441, 2412, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2442, 2413, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2443, 2414, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2444, 2415, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2445, 2416, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2446, 2417, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2447, 2418, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2448, 2419, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2449, 2420, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2450, 2421, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2451, 2422, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2452, 2423, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2453, 2424, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2454, 2425, 'Terselenggaranya Lembaga Kemasyarakatan', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2455, 2426, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2456, 2427, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

-- Table: renstra_sub_kegiatan_indikator (31 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2492, 2397, 2426, 126, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '', '1', '2499850.00', '1', '2499850.00', '1', '2499850.00', '1', '2499850.00', '1', '2499850.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2493, 2398, 2427, 126, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2494, 2399, 2428, 126, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '', '297', '1776561510.00', '297', '1776561510.00', '297', '1776561510.00', '297', '1776561510.00', '297', '1776561510.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2495, 2400, 2429, 126, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '', '25', '7959500.00', '25', '7959500.00', '25', '7959500.00', '25', '7959500.00', '25', '7959500.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2496, 2401, 2430, 126, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '', '2', '17237750.00', '2', '17237750.00', '2', '17237750.00', '2', '17237750.00', '2', '17237750.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2497, 2402, 2431, 126, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '', '4', '7991000.00', '4', '7991000.00', '4', '7991000.00', '4', '7991000.00', '4', '7991000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2498, 2403, 2432, 126, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '', '5', '23440000.00', '5', '23440000.00', '5', '23440000.00', '5', '23440000.00', '5', '23440000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2499, 2404, 2433, 126, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '', '2', '5995650.00', '2', '5995650.00', '2', '5995650.00', '2', '5995650.00', '2', '5995650.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2500, 2405, 2434, 126, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '', '5', '45000000.00', '5', '45000000.00', '5', '45000000.00', '5', '45000000.00', '5', '45000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2501, 2406, 2435, 126, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '3', '22752300.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2502, 2407, 2436, 126, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '', '2', '0.00', '', '0.00', '3', '5000000.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2503, 2408, 2437, 126, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '74202291.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2504, 2409, 2438, 126, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '30000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2505, 2410, 2439, 126, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '1', '15000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2506, 2411, 2440, 126, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '', '5', '1999000.00', '5', '1999000.00', '5', '1999000.00', '5', '1999000.00', '5', '1999000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2507, 2412, 2441, 126, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '', '12', '37999096.00', '12', '37999096.00', '12', '37999096.00', '12', '37999096.00', '12', '37999096.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2508, 2413, 2442, 126, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang Disediakan', 'Laporan', '', '1', '4999500.00', '12', '4999500.00', '12', '4999500.00', '12', '4999500.00', '12', '4999500.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2509, 2414, 2443, 126, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '', '12', '84000000.00', '12', '84000000.00', '12', '84000000.00', '12', '84000000.00', '12', '84000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2510, 2415, 2444, 126, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '', '4', '15874700.00', '4', '15874700.00', '4', '15874700.00', '4', '15874700.00', '4', '15874700.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2511, 2416, 2445, 126, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '5', '0.00', '5', '0.00', '5', '0.00', '10', '20000000.00', '', '0.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2512, 2417, 2446, 126, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '', '5', '7495000.00', '', '0.00', '5', '7495000.00', '', '0.00', '5', '7495000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2513, 2418, 2447, 126, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '1', '35448251.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2514, 2419, 2448, 126, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '1', '32349996.00', '', '0.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2515, 2420, 2449, 126, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '2', '0.00', '', '0.00', '1', '23162696.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2516, 2421, 2450, 126, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Laporan', '', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', '1', '114282000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2517, 2422, 2451, 126, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2518, 2423, 2452, 126, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', 'Dokumen', '', '1', '9991700.00', '1', '9991700.00', '1', '9991700.00', '1', '9991700.00', '1', '9991700.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2519, 2424, 2453, 126, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '', '4', '440126266.00', '4', '440126266.00', '4', '440126266.00', '4', '440126266.00', '4', '440126266.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2520, 2425, 2454, 126, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga Kemasyarakatan', '', '4', '20000000.00', '4', '20000000.00', '4', '20000000.00', '4', '20000000.00', '4', '20000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2521, 2426, 2455, 126, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Laporan', '', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL),
  (2522, 2427, 2456, 126, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '', '4', '14908500.00', '4', '14908500.00', '4', '14908500.00', '4', '14908500.00', '4', '14908500.00', 10, '2026-09-27 22:01:58', '2026-09-27 22:01:58', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
