-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: BADAN PENDAPATAN DAERAH BANYUWANGI
-- ID INSTANSI: 89 | KODE: 5.02.0.00.0.00.02.0000
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-26 13:54:22
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (BADAN PENDAPATAN DAERAH BANYUWANGI) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (89, '5.02.0.00.0.00.02.0000', '35.10', 'BADAN PENDAPATAN DAERAH BANYUWANGI', '5.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, '2026-09-21 12:31:00', '2026-09-26 13:42:19', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA BADAN PENDAPATAN DAERAH BANYUWANGI SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (1835, 1836, 1837, 1838, 1839, 1840, 1841, 1842, 1843, 1844, 1845, 1846, 1847, 1848, 1849, 1850, 1851, 1852, 1853, 1854, 1855, 1856);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (1835, 1836, 1837, 1838, 1839, 1840, 1841, 1842, 1843, 1844, 1845, 1846, 1847, 1848, 1849, 1850, 1851, 1852, 1853, 1854, 1855, 1856);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (359, 360, 361, 362, 363, 364);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (359, 360, 361, 362, 363, 364);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (359, 360, 361, 362, 363, 364);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (131, 132);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (131, 132);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (131, 132);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (72, 73);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (72, 73);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (27);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (27);
DELETE FROM `renstra_tujuan` WHERE `id` IN (27) OR (`id_instansi` = 89 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD BADAN PENDAPATAN DAERAH BANYUWANGI
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (27, '35.10', 89, '59', 'Meningkatkan Kemandirian Keuangan Daerah', NULL, NULL, 'Persentase PAD terhadap Pendapatan Daerah', '%', NULL, '18.5', '19', '19.5', '20', '20.5', '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (42, 27, 89, 'Persentase PAD terhadap Pendapatan Daerah', '%', '15.04', NULL, '18.5', '19', '19.5', '20', '20.5', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (72, 27, 'Meningkatnya Akuntabilitas dan Kualitas Pelayanan Perangkat Daerah', NULL, NULL, 'Nilai SAKIP Perangkat Daerah', '%', NULL, '91.62', '91.64', '91.66', '91.67', '91.69', '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (73, 27, 'Meningkatkan Pendapatan Asli Daerah', NULL, NULL, 'Persentase Peningkatan Realisasi Pendapatan Asli Daerah', '%', NULL, '3.5', '4', '4.5', '5', '5.5', '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (3 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (112, 72, NULL, 'Nilai SAKIP Perangkat Daerah', '%', '', NULL, '91.62', '91.64', '91.66', '91.67', '91.69', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (113, 72, NULL, 'Indeks Kepuasan Masyarakat (IKM)', '%', '', NULL, '94', '95', '96', '97', '98', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (114, 73, NULL, 'Persentase Peningkatan Realisasi Pendapatan Asli Daerah', '%', '1.75', NULL, '3.5', '4', '4.5', '5', '5.5', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

-- Table: renstra_program (2 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (131, 72, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '5.02.01', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, NULL, 'Meningkatkan Penunjang Urusan Pemerintahan Daerah Kabupaten', 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', NULL, '94.3', '96.1', '97.9', '99.7', '100', NULL, '13514663987.00', '13540194800.00', '13541229100.00', '13623182500.00', '13988209700.00'),
  (132, 73, 'PROGRAM PENGELOLAAN PENDAPATAN DAERAH', '5.02.04', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, NULL, 'Meningkatkan Pengelolaan Pendapatan Daerah', 'Persentase Kepatuhan Wajib Pajak', '%', NULL, '92', '93', '94', '95', '96', NULL, '9301000000.00', '9318573800.00', '9319281500.00', '9375684300.00', '9626901600.00');

-- Table: renstra_program_outcome (2 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (177, 131, 'Meningkatkan Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (178, 132, 'Meningkatkan Pengelolaan Pendapatan Daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

-- Table: renstra_program_indikator (2 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (281, 131, 177, 89, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '100', '94.3', '96.1', '97.9', '99.7', '100', '13514663987.00', '13540194800.00', '13541229100.00', '13623182500.00', '13988209700.00', '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 10),
  (282, 132, 178, 89, 'Persentase Kepatuhan Wajib Pajak', '%', '', '92', '93', '94', '95', '96', '9301000000.00', '9318573800.00', '9319281500.00', '9375684300.00', '9626901600.00', '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 10);

-- Table: renstra_kegiatan (6 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (359, 131, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '5.02.01.2.01', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Cakupan perencanaan,penganggara n, dan evaluasi kinerja perangkat daerah', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan
Ikhtisar Realisasi Kinerja SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '125602000.00', '125839400.00', '125848900.00', '126610500.00', '130002900.00'),
  (360, 131, 'Administrasi Keuangan Perangkat Daerah', '5.02.01.2.02', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Cakupan administrasi keuangan perangkat daerah', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '600', '616', '632', '648', '664', NULL, '10711454887.00', '10731693700.00', '10732508700.00', '10797464700.00', '11086778000.00'),
  (361, 131, 'Administrasi Umum Perangkat Daerah', '5.02.01.2.06', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Cakupan administrasi umum perangkat daerah', 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '747715400.00', '749128100.00', '749185100.00', '753719300.00', '773915000.00'),
  (362, 131, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '5.02.01.2.08', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Cakupan jasa penunjang urusan pemerintahan daerah', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '1320281700.00', '1322776200.00', '1322876700.00', '1330883100.00', '1366543500.00'),
  (363, 131, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '5.02.01.2.09', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '609610000.00', '610757400.00', '610809700.00', '614504900.00', '630970300.00'),
  (364, 132, 'Kegiatan Pengelolaan Pendapatan Daerah', '5.02.04.2.01', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Peningkatan Pelaporan Realisasi Pendapatan Yang Tepat Waktu', 'Jumlah Data Pelaporan Pajak Daerah yang Telah Dilakukan Penelitian dan
Verifikasi', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '7208000000.00', '7221619200.00', '7222167600.00', '7265878100.00', '7460564100.00');

-- Table: renstra_kegiatan_sasaran (6 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (371, 359, 'Cakupan perencanaan,penganggara n, dan evaluasi kinerja perangkat daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (372, 360, 'Cakupan administrasi keuangan perangkat daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (373, 361, 'Cakupan administrasi umum perangkat daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (374, 362, 'Cakupan jasa penunjang urusan pemerintahan daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (375, 363, 'Cakupan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (376, 364, 'Peningkatan Pelaporan Realisasi Pendapatan Yang Tepat Waktu', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

-- Table: renstra_kegiatan_indikator (22 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1771, 359, 371, 89, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan
Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '12', '12', '125602000.00', '12', '125839400.00', '12', '125848900.00', '12', '126610500.00', '12', '130002900.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1772, 359, 371, 89, 'Jumlah Dokumen Perencanaan
Perangkat Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1773, 360, 372, 89, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '552', '600', '10711454887.00', '616', '10731693700.00', '632', '10732508700.00', '648', '10797464700.00', '664', '11086778000.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1774, 360, 372, 89, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun
SKPD', 'Laporan', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1775, 361, 373, 89, 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', '1', '1', '747715400.00', '1', '749128100.00', '1', '749185100.00', '1', '753719300.00', '1', '773915000.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1776, 361, 373, 89, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', '655', '655', '0.00', '655', '0.00', '655', '0.00', '655', '0.00', '655', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1777, 361, 373, 89, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1778, 361, 373, 89, 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1779, 361, 373, 89, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1780, 361, 373, 89, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1781, 361, 373, 89, 'Jumlah Paket Peralatan dan Perlengkapan
Kantor yang Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1782, 362, 374, 89, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '1320281700.00', '12', '1322776200.00', '12', '1322876700.00', '12', '1330883100.00', '12', '1366543500.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1783, 362, 374, 89, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1784, 362, 374, 89, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1785, 363, 375, 89, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', '11', '11', '609610000.00', '11', '610757400.00', '11', '610809700.00', '11', '614504900.00', '11', '630970300.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1786, 363, 375, 89, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita
si', 'Unit', '64', '64', '0.00', '64', '0.00', '64', '0.00', '64', '0.00', '64', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1787, 364, 376, 89, 'Jumlah Data Pelaporan Pajak Daerah yang Telah Dilakukan Penelitian dan
Verifikasi', 'Dokumen', '12', '12', '7208000000.00', '12', '7221619200.00', '12', '7222167600.00', '12', '7265878100.00', '12', '7460564100.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1788, 364, 376, 89, 'Jumlah Objek Pajak yang Disesuaikan
NJOP nya', 'Obyek Pajak', '27000', '30000', '0.00', '31000', '0.00', '32', '0.00', '33000', '0.00', '34000', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1789, 364, 376, 89, 'Jumlah Layanan dan Konsultasi Pajak Daerah', 'Layanan', '9', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', 30, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1790, 364, 376, 89, 'Jumlah Laporan Pelaksanaan Penyuluhan dan Penyebarluasan
Kebijakan Pajak Daerah', 'Laporan', '13', '13', '0.00', '13', '0.00', '13', '0.00', '13', '0.00', '13', '0.00', 40, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1791, 364, 376, 89, 'Jumlah Laporan Hasil Pendataan dan Pendaftaran Objek Pajak Daerah, Subjek Pajak dan Wajib Pajak
Daerah', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1792, 364, 376, 89, 'Jumlah Dokumen Rencana Pengelolaan
Pajak Daerah', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

-- Table: renstra_sub_kegiatan (22 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1835, 359, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '5.02.01.2.01.0001', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '50202000.00', '50296900.00', '50300700.00', '50605100.00', '51961000.00'),
  (1836, 359, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '5.02.01.2.01.0006', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan
Ikhtisar Realisasi Kinerja SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '75400000.00', '75542500.00', '75548200.00', '76005400.00', '78041900.00'),
  (1837, 360, 'Penyediaan Gaji dan Tunjangan ASN', '5.02.01.2.02.0001', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', NULL, '600', '616', '632', '648', '664', NULL, '10660940887.00', '10681084300.00', '10681895500.00', '10746545200.00', '11034494100.00'),
  (1838, 360, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '5.02.01.2.02.0005', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan
Keuangan Akhir Tahun SKPD', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '50514000.00', '50609400.00', '50613200.00', '50919500.00', '52283900.00'),
  (1839, 361, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '5.02.01.2.06.0001', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '9992700.00', '10011600.00', '10012400.00', '10073000.00', '10342900.00'),
  (1840, 361, 'Penyediaan Peralatan dan Perlengkapan Kantor', '5.02.01.2.06.0002', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '66754800.00', '66880900.00', '66886000.00', '67290800.00', '69093800.00'),
  (1841, 361, 'Penyediaan Peralatan Rumah Tangga', '5.02.01.2.06.0003', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '24997450.00', '25044700.00', '25046600.00', '25198200.00', '25873400.00'),
  (1842, 361, 'Penyediaan Bahan Logistik Kantor', '5.02.01.2.06.0004', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '59055000.00', '59166600.00', '59171100.00', '59529200.00', '61124300.00'),
  (1843, 361, 'Penyediaan Barang Cetakan dan Penggandaan', '5.02.01.2.06.0005', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '9999950.00', '10018800.00', '10019600.00', '10080200.00', '10350300.00'),
  (1844, 361, 'Penyediaan Bahan Bacaan dan Peraturan Perundang- undangan', '5.02.01.2.06.0006', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', 'Dokumen', NULL, '655', '655', '655', '655', '655', NULL, '7000000.00', '7013200.00', '7013700.00', '7056100.00', '7245100.00'),
  (1845, 361, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '5.02.01.2.06.0009', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '569915500.00', '570992300.00', '571035700.00', '574491800.00', '589885200.00'),
  (1846, 362, 'Penyediaan Jasa Surat Menyurat', '5.02.01.2.08.0001', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '5000000.00', '5009400.00', '5009800.00', '5040100.00', '5175100.00'),
  (1847, 362, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '5.02.01.2.08.0002', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik
yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '222831700.00', '223252700.00', '223269700.00', '224621000.00', '230639600.00'),
  (1848, 362, 'Penyediaan Jasa Pelayanan Umum Kantor', '5.02.01.2.08.0004', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '1092450000.00', '1094514100.00', '1094597200.00', '1101222000.00', '1130728800.00'),
  (1849, 363, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '5.02.01.2.09.0001', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '266450000.00', '266953400.00', '266973700.00', '268589500.00', '275786200.00'),
  (1850, 363, 'Pemeliharaan Peralatan dan Mesin Lainnya', '5.02.01.2.09.0006', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan
Mesin Lainnya yang Dipelihara', 'Unit', NULL, '58', '58', '58', '58', '58', NULL, '42000000.00', '42079400.00', '42082600.00', '42337300.00', '43471700.00'),
  (1851, 363, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '5.02.01.2.09.0009', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilita
si', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '250760000.00', '251233800.00', '251252900.00', '252773500.00', '259546500.00'),
  (1852, 363, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '5.02.01.2.09.0010', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita
si', 'Unit', NULL, '64', '64', '64', '64', '64', NULL, '50400000.00', '50490800.00', '50500500.00', '50804600.00', '52165900.00'),
  (1853, 364, 'Pengendalian, Pemeriksaan dan Pengawasan Pajak Daerah', '5.02.04.2.01.0013', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksanannya Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 'Jumlah Dokumen Hasil Pemeriksaan serta Pengendalian dan Pengawasan Pajak
Daerah (Dokumen )', 'Dokumen', NULL, '6', '6', '6', '6', '6', NULL, '473000000.00', '473893700.00', '473929700.00', '476798000.00', '489573600.00'),
  (1854, 364, 'Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', '5.02.04.2.01.0006', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Basis Data
Pajak Daerah', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '2063000000.00', '2064954600.00', '2063113900.00', '2073806200.00', '2128337500.00'),
  (1855, 364, 'Pembinaan dan Pengawasan Pengelolaan Pajak Daerah dan Retribusi Daerah', '5.02.04.2.01.0014', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 'Jumlah Laporan Hasil Pembinaan dan Pengawasan Pengelolaan Retribusi
Daerah', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '10000000.00', '11000000.00', '12000000.00', '13000000.00', '14000000.00'),
  (1856, 364, 'Elektronifikasi Transaksi Pemerintah Daerah', '5.02.04.2.01.0015', NULL, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL, 'Terlaksananya Upaya Mengubah Transaksi Tunai Menjadi Non Tunai', 'Jumlah Laporan Perkembangan Elektronifikasi Transaksi Pemerintah Daerah', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '20000000.00', '21000000.00', '22000000.00', '23000000.00', '24000000.00');

-- Table: renstra_sub_kegiatan_sasaran (23 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1863, 1835, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1864, 1836, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1865, 1837, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1866, 1838, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1867, 1839, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1868, 1840, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1869, 1841, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1870, 1842, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1871, 1843, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1872, 1844, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1873, 1845, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1874, 1846, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1875, 1847, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1876, 1848, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1877, 1849, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1878, 1850, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1879, 1851, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1880, 1852, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1881, 1853, 'Terlaksanannya Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1882, 1853, 'Peningkatan Pengelolaan Pendapatan Berbasis Teknologi Informasi', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1883, 1854, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1884, 1855, 'Terlaksananya Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1885, 1856, 'Terlaksananya Upaya Mengubah Transaksi Tunai Menjadi Non Tunai', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

-- Table: renstra_sub_kegiatan_indikator (25 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1927, 1835, 1863, 89, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '2', '2', '50202000.00', '2', '50296900.00', '2', '50300700.00', '2', '50605100.00', '2', '51961000.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1928, 1836, 1864, 89, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan
Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '12', '12', '75400000.00', '12', '75542500.00', '12', '75548200.00', '12', '76005400.00', '12', '78041900.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1929, 1837, 1865, 89, 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', '552', '600', '10660940887.00', '616', '10681084300.00', '632', '10681895500.00', '648', '10746545200.00', '664', '11034494100.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1930, 1838, 1866, 89, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan
Keuangan Akhir Tahun SKPD', 'Laporan', '2', '2', '50514000.00', '2', '50609400.00', '2', '50613200.00', '2', '50919500.00', '2', '52283900.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1931, 1839, 1867, 89, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', '1', '1', '9992700.00', '1', '10011600.00', '1', '10012400.00', '1', '10073000.00', '1', '10342900.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1932, 1840, 1868, 89, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '1', '1', '66754800.00', '1', '66880900.00', '1', '66886000.00', '1', '67290800.00', '1', '69093800.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1933, 1841, 1869, 89, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '1', '1', '24997450.00', '1', '25044700.00', '1', '25046600.00', '1', '25198200.00', '1', '25873400.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1934, 1842, 1870, 89, 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', '1', '1', '59055000.00', '1', '59166600.00', '1', '59171100.00', '1', '59529200.00', '1', '61124300.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1935, 1843, 1871, 89, 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', '1', '1', '9999950.00', '1', '10018800.00', '1', '10019600.00', '1', '10080200.00', '1', '10350300.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1936, 1844, 1872, 89, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', 'Dokumen', '655', '655', '7000000.00', '655', '7013200.00', '655', '7013700.00', '655', '7056100.00', '655', '7245100.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1937, 1845, 1873, 89, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '12', '12', '569915500.00', '12', '570992300.00', '12', '571035700.00', '12', '574491800.00', '12', '589885200.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1938, 1846, 1874, 89, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '12', '12', '5000000.00', '12', '5009400.00', '12', '5009800.00', '12', '5040100.00', '12', '5175100.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1939, 1847, 1875, 89, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik
yang Disediakan', 'Laporan', '12', '12', '222831700.00', '12', '223252700.00', '12', '223269700.00', '12', '224621000.00', '12', '230639600.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1940, 1848, 1876, 89, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', 'Laporan', '12', '12', '1092450000.00', '12', '1094514100.00', '12', '1094597200.00', '12', '1101222000.00', '12', '1130728800.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1941, 1849, 1877, 89, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '11', '11', '266450000.00', '11', '266953400.00', '11', '266973700.00', '11', '268589500.00', '11', '275786200.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1942, 1850, 1878, 89, 'Jumlah Peralatan dan
Mesin Lainnya yang Dipelihara', 'Unit', '58', '58', '42000000.00', '58', '42079400.00', '58', '42082600.00', '58', '42337300.00', '58', '43471700.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1943, 1851, 1879, 89, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilita
si', 'Unit', '1', '1', '250760000.00', '1', '251233800.00', '1', '251252900.00', '1', '252773500.00', '1', '259546500.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1944, 1852, 1880, 89, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilita
si', 'Unit', '64', '64', '50400000.00', '64', '50490800.00', '64', '50500500.00', '64', '50804600.00', '64', '52165900.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1945, 1853, 1881, 89, 'Jumlah Dokumen Hasil Pemeriksaan serta Pengendalian dan Pengawasan Pajak
Daerah (Dokumen )', 'Dokumen', '6', '6', '473000000.00', '6', '473893700.00', '6', '473929700.00', '6', '476798000.00', '6', '489573600.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1946, 1853, 1882, 89, 'Jumlah Laporan Perkembangan Elektronifikasi Transaksi Pemerintah
Daerah', 'Laporan', '2', '2', '2093000000.00', '2', '2096954600.00', '2', '2097113900.00', '2', '2109806200.00', '2', '2166337500.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1947, 1853, 1882, 89, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Basis Data
Pajak Daerah', 'Laporan', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1948, 1853, 1882, 89, 'Jumlah Laporan Hasil Pembinaan dan Pengawasan Pengelolaan Retribusi
Daerah', 'Laporan', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1949, 1854, 1883, 89, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Basis Data
Pajak Daerah', 'Laporan', '2', '2', '2063000000.00', '2', '2064954600.00', '2', '2063113900.00', '2', '2073806200.00', '2', '2128337500.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1950, 1855, 1884, 89, 'Jumlah Laporan Hasil Pembinaan dan Pengawasan Pengelolaan Retribusi
Daerah', 'Laporan', '', '2', '10000000.00', '2', '11000000.00', '2', '12000000.00', '2', '13000000.00', '2', '14000000.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL),
  (1951, 1856, 1885, 89, 'Jumlah Laporan Perkembangan Elektronifikasi Transaksi Pemerintah Daerah', 'Laporan', '', '2', '20000000.00', '2', '21000000.00', '2', '22000000.00', '2', '23000000.00', '2', '24000000.00', 10, '2026-09-26 13:54:03', '2026-09-26 13:54:03', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
