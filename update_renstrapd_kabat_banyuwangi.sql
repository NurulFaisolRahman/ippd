-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN KABAT
-- ID INSTANSI: 122 | KODE: 7.01.0.00.0.00.10.000 | URUSAN: 7.01
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-27 22:42:28
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN KABAT) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (122, '7.01.0.00.0.00.10.000', '35.10', 'Kecamatan Kabat', '7.01', NULL, NULL, '$2y$10$iORXMIlZ/w7E0NIMq9GPEOiesWrC3r1n2tPlXvTO7eFkUntsSOMBa', 4, 2025, 2029, '2026-09-21 16:25:20', '2026-09-27 22:42:11', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN KABAT SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2559, 2560, 2561, 2562, 2563, 2564, 2565, 2566, 2567, 2568, 2569, 2570, 2571, 2572, 2573);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2559, 2560, 2561, 2562, 2563, 2564, 2565, 2566, 2567, 2568, 2569, 2570, 2571, 2572, 2573);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (216, 217, 218, 219, 220);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (216, 217, 218, 219, 220);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (216, 217, 218, 219, 220);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (109, 110);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (109, 110);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (41);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (41);
DELETE FROM `renstra_tujuan` WHERE `id` IN (41) OR (`id_instansi` = 122 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN KABAT
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (41, '35.10', 122, '61', 'Meningkatnya Kualitas Pelayanan Publik', NULL, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, '86', '87', '88', '89', '90', '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (58, 41, NULL, 'Indeks Kinerja Wilayah (IKW)', 'Indeks', NULL, NULL, '86', '87', '88', '89', '90', 1, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (109, 41, 'Meningkatnya Kualitas Layanan Administrasi', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, '91', '92', '93', '94', '95', '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (110, 41, 'Meningkatnya Kualitas Kinerja Kecamatan', NULL, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, '81', '82', '83', '84', '85', '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (158, 109, NULL, 'Indeks Kepuasan Masyarakat (IKM) Kecamatan', 'Indeks', NULL, NULL, '91', '92', '93', '94', '95', 1, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (159, 110, NULL, 'Persentase Kepuasan Masyarakat terhadap Pelaksanaan Tugas Atributif dan Delegatif Kecamatan', '%', NULL, NULL, '81', '82', '83', '84', '85', 1, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (216, 109, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, '93', '93.5', '94', '94.5', '95', NULL, '2645503638.00', '2652082274.00', '2652347199.00', '2673461139.00', '2767502363.00'),
  (217, 110, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '194270850.00', '194270850.00', '194270850.00', '194270850.00', '194270850.00'),
  (218, 110, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, '92', '93', '94', '95', '95', NULL, '610758700.00', '610758700.00', '610758700.00', '610758700.00', '610758700.00'),
  (219, 110, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, '92', '94', '96', '98', '98', NULL, '10350600.00', '10350600.00', '10350600.00', '10350600.00', '10350600.00'),
  (220, 110, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '20872050.00', '20872050.00', '20872050.00', '20872050.00', '20872050.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (262, 216, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (263, 217, 'Meningkatkan Kualitas Penyelenggaraan Pemerintahan dan Pelayananan Publik', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (264, 218, 'Meningkatnya Kualitas Pemberdayaan Masyarakat Desa dan Kelurahan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (265, 219, 'Meningkatnya Kualitas Koordinasi Ketentraman dan Ketertiban Umum', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (266, 220, 'Meningkatkan Kualitas Pembinaan dan Pengawasan Pmerintahan Desa', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (385, 216, 262, 122, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '90', '93', '93.5', '94', '94.5', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 10),
  (386, 217, 263, 122, 'Persentase Fasiltasi Penyelenggaraan Urusan Pemerintahan yang Dilaksanakan', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 10),
  (387, 218, 264, 122, 'Persentase kegiatan pemberdayaan masyarakat yang terlaksana', '%', '92', '92', '93', '94', '95', '95', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 10),
  (388, 219, 265, 122, 'Persentase Penyelesaian Pengaduan Masyarakat', '%', '92', '92', '94', '96', '98', '98', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 10),
  (389, 220, 266, 122, 'Persentase desa yang menyelesaikan laporan kinerja tepat waktu', '%', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (668, 216, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '4000000.00', '4000000.00', '4000000.00', '4000000.00', '4000000.00'),
  (669, 216, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '2312051538.00', '2312051538.00', '2312051538.00', '2312051538.00', '2312051538.00'),
  (670, 216, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '9', '9', '9', '9', '9', NULL, '134795150.00', '134795150.00', '134795150.00', '134795150.00', '134795150.00'),
  (671, 216, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2', NULL, '0.00', '0.00', '6843561.00', '27957501.00', '86998725.00'),
  (672, 216, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '150304500.00', '150304500.00', '150304500.00', '150304500.00', '150304500.00'),
  (673, 216, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '', '1', '', '', '', NULL, '44352450.00', '50931086.00', '44352450.00', '44352450.00', '79352450.00'),
  (674, 217, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '114270850.00', '114270850.00', '114270850.00', '114270850.00', '114270850.00'),
  (675, 217, 'Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', '7.01.02.2.04', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (676, 218, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '590758700.00', '590758700.00', '590758700.00', '590758700.00', '590758700.00'),
  (677, 218, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '', '6', '6', '6', '6', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (678, 219, 'Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', '7.01.04.2.02', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '4', '4', '4', '4', '4', NULL, '10350600.00', '10350600.00', '10350600.00', '10350600.00', '10350600.00'),
  (679, 220, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '20872050.00', '20872050.00', '20872050.00', '20872050.00', '20872050.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (723, 668, 'Cakupan Perencanaan, Penganggaran, dan Evaluasi Kinerja', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (724, 669, 'Cakupan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (725, 670, 'Cakupan Administrasi Umum', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (726, 671, 'Cakupan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (727, 672, 'Cakupan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (728, 673, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (729, 674, 'Cakupan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (730, 675, 'Cakupan Pelaksanaan Urusan Pemerintahan yang Dilimpahkan kepada Camat', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (731, 676, 'Cakupan Koordinasi Kegiatan Pemberdayaan Desa', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (732, 677, 'Cakupan Kegiatan Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (733, 678, 'Cakupan Koordinasi Penerapan dan Penegakan Peraturan Daerah dan Peraturan Kepala Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (734, 679, 'Cakupan Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

-- Table: renstra_kegiatan_indikator (31 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2415, 668, 723, 122, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2416, 668, 723, 122, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', '%', '7', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', 20, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2417, 669, 724, 122, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', '%', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2418, 670, 725, 122, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '9', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2419, 670, 725, 122, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi', '%', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2420, 670, 725, 122, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 30, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2421, 670, 725, 122, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang', '%', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2422, 670, 725, 122, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 50, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2423, 670, 725, 122, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', '%', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 60, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2424, 671, 726, 122, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '2', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2425, 671, 726, 122, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', '%', '', '', '0.00', '', '0.00', '3', '0.00', '', '0.00', '', '0.00', 20, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2426, 671, 726, 122, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 30, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2427, 671, 726, 122, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 40, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2428, 671, 726, 122, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang', '%', '', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', '', '0.00', 50, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2429, 672, 727, 122, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', '%', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2430, 672, 727, 122, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2431, 672, 727, 122, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2432, 672, 727, 122, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang', '%', '1', '1', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 40, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2433, 673, 728, 122, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2434, 673, 728, 122, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2435, 673, 728, 122, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 30, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2436, 673, 728, 122, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '0.00', 40, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2437, 673, 728, 122, 'Jumlah Mebel yang Dipelihara', 'Unit', '19', '19', '0.00', '19', '0.00', '19', '0.00', '19', '0.00', '19', '0.00', 50, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2438, 673, 728, 122, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara  (Unit)', 'Unit', '14', '14', '0.00', '14', '0.00', '14', '0.00', '14', '0.00', '14', '0.00', 60, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2439, 674, 729, 122, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi', '%', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2440, 675, 730, 122, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2441, 676, 731, 122, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di W ilayah Kecamatan', 'Laporan', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2442, 676, 731, 122, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di W ilayah Kerja Kecamatan', '%', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2443, 677, 732, 122, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga', '', '', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2444, 678, 733, 122, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau', '%', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2445, 679, 734, 122, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

-- Table: renstra_sub_kegiatan (31 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2543, 668, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2500000.00', '2500000.00', '2500000.00', '2500000.00', '2500000.00'),
  (2544, 668, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '1500000.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (2545, 669, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang / Bulan', NULL, '12', '12', '12', '12', '12', NULL, '2312051538.00', '2312051538.00', '2312051538.00', '2312051538.00', '2312051538.00'),
  (2546, 670, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '7998000.00', '7998000.00', '7998000.00', '7998000.00', '7998000.00'),
  (2547, 670, 'Penyediaan Peralatan dan Perlengkapan Kantor', '7.01.01.2.06.0002', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '4', '4', '4', '4', '4', NULL, '34538400.00', '34538400.00', '34538400.00', '34538400.00', '34538400.00'),
  (2548, 670, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '7923750.00', '7923750.00', '7923750.00', '7923750.00', '7923750.00'),
  (2549, 670, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '9', '9', '9', '9', '9', NULL, '20100000.00', '20100000.00', '20100000.00', '20100000.00', '20100000.00'),
  (2550, 670, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '6000000.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (2551, 670, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '58235000.00', '58235000.00', '58235000.00', '58235000.00', '58235000.00'),
  (2552, 671, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '', '', '', '', '2', NULL, '0.00', '0.00', '0.00', '0.00', '20000000.00'),
  (2553, 671, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', NULL, '', '', '3', '', '', NULL, '0.00', '0.00', '6843561.00', '0.00', '0.00'),
  (2554, 671, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0009', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '51998725.00'),
  (2555, 671, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang', 'Unit', NULL, '', '', '', '1', '', NULL, '0.00', '0.00', '0.00', '27957501.00', '0.00'),
  (2556, 671, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '15000000.00'),
  (2557, 672, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2000000.00', '2000000.00', '2000000.00', '2000000.00'),
  (2558, 672, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '38379500.00', '38379500.00', '38379500.00', '38379500.00', '38379500.00'),
  (2559, 672, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '7.01.01.2.08.0003', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang', 'Laporan', NULL, '1', '12', '12', '12', '12', NULL, '4925000.00', '4925000.00', '4925000.00', '4925000.00', '4925000.00'),
  (2560, 672, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '105000000.00', '105000000.00', '105000000.00', '105000000.00', '105000000.00'),
  (2561, 673, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya (Unit)', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '20018450.00', '20018450.00', '20018450.00', '20018450.00', '20018450.00'),
  (2562, 673, 'Pemeliharaan Mebel', '7.01.01.2.09.0005', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara (Unit)', 'Unit', NULL, '19', '19', '19', '19', '19', NULL, '11950000.00', '11950000.00', '11950000.00', '11950000.00', '11950000.00'),
  (2563, 673, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara  (Unit)', 'Unit', NULL, '14', '14', '14', '14', '14', NULL, '12384000.00', '12384000.00', '12384000.00', '12384000.00', '12384000.00'),
  (2564, 673, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '25000000.00'),
  (2565, 673, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', NULL, '', '1', '', '', '', NULL, '0.00', '6578636.00', '0.00', '0.00', '0.00'),
  (2566, 673, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', NULL, '', '', '', '', '1', NULL, '0.00', '0.00', '0.00', '0.00', '10000000.00'),
  (2567, 674, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '114270850.00', '114270850.00', '114270850.00', '114270850.00', '114270850.00'),
  (2568, 675, 'Pelaksanaan Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', '7.01.02.2.04.0003', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (2569, 676, 'Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di Wilayah Kerja Kecamatan', '7.01.03.2.01.0002', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di W ilayah Kerja Kecamatan', 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di W ilayah Kerja Kecamatan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '21595250.00', '21595250.00', '21595250.00', '21595250.00', '21595250.00'),
  (2570, 676, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di W ilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di W ilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '569163450.00', '569163450.00', '569163450.00', '569163450.00', '569163450.00'),
  (2571, 677, 'Penyelenggaraan Lembaga Kemasyarakatan', '7.01.03.2.03.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terselenggaranya Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga', NULL, '', '6', '6', '6', '6', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (2572, 678, 'Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', '7.01.04.2.02.0001', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '10350600.00', '10350600.00', '10350600.00', '10350600.00', '10350600.00'),
  (2573, 679, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '20872050.00', '20872050.00', '20872050.00', '20872050.00', '20872050.00');

-- Table: renstra_sub_kegiatan_sasaran (31 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2572, 2543, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2573, 2544, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2574, 2545, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2575, 2546, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2576, 2547, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2577, 2548, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2578, 2549, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2579, 2550, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2580, 2551, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2581, 2552, 'Tersedianya Mebel', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2582, 2553, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2583, 2554, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2584, 2555, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2585, 2556, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2586, 2557, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2587, 2558, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2588, 2559, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2589, 2560, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2590, 2561, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2591, 2562, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2592, 2563, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2593, 2564, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2594, 2565, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2595, 2566, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2596, 2567, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2597, 2568, 'Terlaksananya Urusan Pemerintahan yang Terkait dengan Kewenangan Lain yang Dilimpahkan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2598, 2569, 'Terlaksananya Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di W ilayah Kerja Kecamatan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2599, 2570, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di W ilayah Kecamatan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2600, 2571, 'Terselenggaranya Lembaga Kemasyarakatan', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2601, 2572, 'Terlaksananya Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau Kepolisian Negara Republik Indonesia', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2602, 2573, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

-- Table: renstra_sub_kegiatan_indikator (31 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2638, 2543, 2572, 122, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '1', '1', '2500000.00', '1', '2500000.00', '1', '2500000.00', '1', '2500000.00', '1', '2500000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2639, 2544, 2573, 122, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '7', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', '7', '1500000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2640, 2545, 2574, 122, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang / Bulan', '12', '12', '2312051538.00', '12', '2312051538.00', '12', '2312051538.00', '12', '2312051538.00', '12', '2312051538.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2641, 2546, 2575, 122, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang', 'Paket', '1', '1', '7998000.00', '1', '7998000.00', '1', '7998000.00', '1', '7998000.00', '1', '7998000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2642, 2547, 2576, 122, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '4', '4', '34538400.00', '4', '34538400.00', '4', '34538400.00', '4', '34538400.00', '4', '34538400.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2643, 2548, 2577, 122, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '3', '3', '7923750.00', '3', '7923750.00', '3', '7923750.00', '3', '7923750.00', '3', '7923750.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2644, 2549, 2578, 122, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '9', '9', '20100000.00', '9', '20100000.00', '9', '20100000.00', '9', '20100000.00', '9', '20100000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2645, 2550, 2579, 122, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '3', '3', '6000000.00', '3', '6000000.00', '3', '6000000.00', '3', '6000000.00', '3', '6000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2646, 2551, 2580, 122, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi', 'Laporan', '12', '12', '58235000.00', '12', '58235000.00', '12', '58235000.00', '12', '58235000.00', '12', '58235000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2647, 2552, 2581, 122, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '2', '20000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2648, 2553, 2582, 122, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '3', '6843561.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2649, 2554, 2583, 122, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '51998725.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2650, 2555, 2584, 122, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '1', '27957501.00', '', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2651, 2556, 2585, 122, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '15000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2652, 2557, 2586, 122, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2653, 2558, 2587, 122, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '38379500.00', '12', '38379500.00', '12', '38379500.00', '12', '38379500.00', '12', '38379500.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2654, 2559, 2588, 122, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang', 'Laporan', '1', '1', '4925000.00', '12', '4925000.00', '12', '4925000.00', '12', '4925000.00', '12', '4925000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2655, 2560, 2589, 122, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '105000000.00', '12', '105000000.00', '12', '105000000.00', '12', '105000000.00', '12', '105000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2656, 2561, 2590, 122, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya (Unit)', 'Unit', '1', '1', '20018450.00', '1', '20018450.00', '1', '20018450.00', '1', '20018450.00', '1', '20018450.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2657, 2562, 2591, 122, 'Jumlah Mebel yang Dipelihara (Unit)', 'Unit', '19', '19', '11950000.00', '19', '11950000.00', '19', '11950000.00', '19', '11950000.00', '19', '11950000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2658, 2563, 2592, 122, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara  (Unit)', 'Unit', '14', '14', '12384000.00', '14', '12384000.00', '14', '12384000.00', '14', '12384000.00', '14', '12384000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2659, 2564, 2593, 122, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '25000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2660, 2565, 2594, 122, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '', '', '0.00', '1', '6578636.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2661, 2566, 2595, 122, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi (Unit)', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '1', '10000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2662, 2567, 2596, 122, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi', 'Laporan', '1', '1', '114270850.00', '1', '114270850.00', '1', '114270850.00', '1', '114270850.00', '1', '114270850.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2663, 2568, 2597, 122, 'Jumlah Laporan Pelaksanaan Kewenangan Lain yang Dilimpahkan', 'Laporan', '4', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', '4', '80000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2664, 2569, 2598, 122, 'Jumlah Dokumen Sinkronisasi Program Kerja dan Kegiatan Pemberdayaan Masyarakat yang Dilakukan oleh Pemerintah dan Swasta di W ilayah Kerja Kecamatan', 'Dokumen', '1', '1', '21595250.00', '1', '21595250.00', '1', '21595250.00', '1', '21595250.00', '1', '21595250.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2665, 2570, 2599, 122, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di W ilayah Kecamatan', 'Laporan', '4', '4', '569163450.00', '4', '569163450.00', '4', '569163450.00', '4', '569163450.00', '4', '569163450.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2666, 2571, 2600, 122, 'Jumlah Lembaga Kemasyarakatan yang Diselenggarakan', 'Lembaga', '', '', '20000000.00', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', '6', '20000000.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2667, 2572, 2601, 122, 'Jumlah Laporan Koordinasi/Sinergi dengan Perangkat Daerah yang Tugas dan Fungsinya di Bidang Penegakan Peraturan Perundang-Undangan dan/atau', 'Laporan', '4', '4', '10350600.00', '4', '10350600.00', '4', '10350600.00', '4', '10350600.00', '4', '10350600.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL),
  (2668, 2573, 2602, 122, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '1', '1', '20872050.00', '1', '20872050.00', '1', '20872050.00', '1', '20872050.00', '1', '20872050.00', 10, '2026-09-27 22:42:11', '2026-09-27 22:42:11', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
