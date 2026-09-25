-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN ASEMBAGUS
-- ID INSTANSI: 80 | KODE: 7.01.0.00.0.00.15.000
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-24 12:39:10
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN ASEMBAGUS) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (80, '7.01.0.00.0.00.15.000', '35.12', 'KECAMATAN  ASEMBAGUS', '7.01', NULL, NULL, '$2y$10$A13ahXsTAUJ.bO8C4Fa02uAEjgKuzf8IaX.bGd95Rj0I99KW06sFK', 4, 2025, 2029, '2026-09-09 11:59:20', '2026-09-22 19:05:29', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN ASEMBAGUS SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (1439, 1440, 1441, 1442, 1443, 1444, 1445, 1446, 1447, 1448, 1449, 1450, 1451, 1452, 1453, 1454, 1455, 1456, 1457, 1458, 1459, 1460, 1461, 1462, 1463, 1464, 1465, 1466, 1467, 1468, 1469, 1470, 1471, 1472);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (1439, 1440, 1441, 1442, 1443, 1444, 1445, 1446, 1447, 1448, 1449, 1450, 1451, 1452, 1453, 1454, 1455, 1456, 1457, 1458, 1459, 1460, 1461, 1462, 1463, 1464, 1465, 1466, 1467, 1468, 1469, 1470, 1471, 1472);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (108, 109, 110, 111, 112);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (108, 109, 110, 111, 112);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (108, 109, 110, 111, 112);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (58, 59, 60);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (58, 59, 60);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (22);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (22);
DELETE FROM `renstra_tujuan` WHERE `id` IN (22) OR (`id_instansi` = 80 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN ASEMBAGUS
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (22, '35.12', 80, '43', 'Meningkatnya Kinerja Tata Kelola Pemerintahan dan Pelayanan Publik', NULL, NULL, 'Nilai Kinerja Kecamatan', 'Nilai', NULL, '76.1', '79.8', '84.2', '86.2', '89.8', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (36, 22, 80, 'Nilai Kinerja Kecamatan', 'Nilai', '57.81', NULL, '76.1', '79.8', '84.2', '86.2', '89.8', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

-- Table: renstra_sasaran (3 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (58, 22, 'Meningkatnya Akuntabilitas Kinerja Perangkat Daerah', NULL, NULL, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '85.1', '85.25', '85.4', '85.5', '85.8', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (59, 22, 'Meningkatnya Kualitas Layanan Publik di Kecamatan Asembagus', NULL, NULL, 'Nilai IKM PD', 'Nilai', NULL, '88.56', '89.06', '89.56', '90.06', '90.81', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (60, 22, 'Meningkatnya Kualitas Pembinaan dan Pengawasan Desa / Kelurahan', NULL, NULL, 'Persentase Desa yang Meningkat Nilai Indeks Desa nya', '%', NULL, '100', '100', '100', '100', '100', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (4 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (97, 58, NULL, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '82.51', NULL, '85.1', '85.25', '85.4', '85.5', '85.8', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (98, 59, NULL, 'Nilai IKM PD', 'Nilai', '82.99', NULL, '88.56', '89.06', '89.56', '90.06', '90.81', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (99, 59, NULL, 'Nilai Kematangan Inovasi Kecamatan', 'Nilai', '104', NULL, '110', '110', '110', '110', '110', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (100, 60, NULL, 'Persentase Desa yang Meningkat Nilai Indeks Desa nya', '%', '', NULL, '100', '100', '100', '100', '100', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (108, 58, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah Kecamatan Asembagus', 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '85.1', '85.25', '85.4', '85.5', '85.8', NULL, '3151363319.00', '3024471342.00', '3195694909.00', '3299229655.00', '3460441137.00'),
  (109, 59, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, 'Penyelenggaraan Pelayanan Publik yang sesuai dengan Standard Operasional Prosedur (SOP) Kecamatan Asembagus', 'Persentase Layanan yang terselesaikan', '%', NULL, '100', '100', '100', '100', '100', NULL, '166017996.00', '26250000.00', '27562500.00', '28940625.00', '30387656.00'),
  (110, 60, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, 'Meningkatkan kemandirian dan kesejahteraan masyarakat desa Kecamatan Asembagus', 'Presentase Pemberdayaan Masyarakat Desa / Kelurahan', '%', NULL, '100', '100', '100', '100', '100', NULL, '142903200.00', '477210777.00', '501071316.00', '526124881.00', '552431125.00'),
  (111, 60, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, 'Kepatuhan Masyarakat pada peraturan pemerintah Kecamatan Asembagus', 'Persentase koordinasi ketentraman dan ketertiban umum', '%', NULL, '100', '100', '100', '100', '100', NULL, '33055200.00', '36750000.00', '38587500.00', '40516875.00', '42542719.00'),
  (112, 60, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, NULL, 'Penyelenggaraan Pemerintahan Desa / Kelurahan yang sesuai dengan ketentuan peraturan perundang-undangan  Kecamatan Asembagus', 'Persentase pembinaan dan pengawasan desa', '%', NULL, '100', '100', '100', '100', '100', NULL, '37445600.00', '52500000.00', '55125000.00', '57881250.00', '60775313.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (152, 108, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah Kecamatan Asembagus', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (153, 109, 'Penyelenggaraan Pelayanan Publik yang sesuai dengan Standard Operasional Prosedur (SOP) Kecamatan Asembagus', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (154, 110, 'Meningkatkan kemandirian dan kesejahteraan masyarakat desa Kecamatan Asembagus', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (155, 111, 'Kepatuhan Masyarakat pada peraturan pemerintah Kecamatan Asembagus', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (156, 112, 'Penyelenggaraan Pemerintahan Desa / Kelurahan yang sesuai dengan ketentuan peraturan perundang-undangan  Kecamatan Asembagus', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (245, 108, 152, 80, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '82.51', '85.1', '85.25', '85.4', '85.5', '85.8', '3151363319.00', '3024471342.00', '3195694909.00', '3299229655.00', '3460441137.00', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 10),
  (246, 109, 153, 80, 'Persentase Layanan yang terselesaikan', '%', '100', '100', '100', '100', '100', '100', '166017996.00', '26250000.00', '27562500.00', '28940625.00', '30387656.00', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 10),
  (247, 110, 154, 80, 'Presentase Pemberdayaan Masyarakat Desa / Kelurahan', '%', '100', '100', '100', '100', '100', '100', '142903200.00', '477210777.00', '501071316.00', '526124881.00', '552431125.00', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 10),
  (248, 111, 155, 80, 'Persentase koordinasi ketentraman dan ketertiban umum', '%', '100', '100', '100', '100', '100', '100', '33055200.00', '36750000.00', '38587500.00', '40516875.00', '42542719.00', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 10),
  (249, 112, 156, 80, 'Persentase pembinaan dan pengawasan desa', '%', '100', '100', '100', '100', '100', '100', '37445600.00', '52500000.00', '55125000.00', '57881250.00', '60775313.00', '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 10);

-- Table: renstra_kegiatan (14 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (269, 108, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Dokumen Perencanaan, Penganggaran dan Evaluasi Kinerja', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '21164000.00', '21000000.00', '22050000.00', '23152500.00', '24310125.00'),
  (270, 108, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Dokumen Administrasi Keuangan', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '20', '20', '20', '20', '20', NULL, '2273142861.00', '2316101342.00', '2431906409.00', '2553501730.00', '2681176816.00'),
  (271, 108, 'Administrasi Barang Milik Daerah pada Perangkat Daerah', '7.01.01.2.03', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Dokumen Administrasi Barang Milik Daerah', 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada SKPD', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '0.00', '10080000.00', '10584000.00', '11113200.00', '11668860.00'),
  (272, 108, 'Administrasi Kepegawaian Perangkat Daerah', '7.01.01.2.05', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Dokumen Administrasi Kepegawaian', 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi
Kepegawaian', 'Dokumen', NULL, '3', '3', '3', '3', '3', NULL, '28186457.00', '42000000.00', '44100000.00', '46305000.00', '48620250.00'),
  (273, 108, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Dokumen Administrasi Umum Perangkat Daerah', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '98036342.00', '136500000.00', '143325000.00', '150491250.00', '158015813.00'),
  (274, 108, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Paket Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang
Disediakan', 'Unit', NULL, '', '', '1', '', '', NULL, '205535259.00', '130000000.00', '160250000.00', '115762500.00', '121550625.00'),
  (275, 108, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Laporan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 'Jumlah Laporan Penyediaan Jasa
Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '199934400.00', '141540000.00', '148617000.00', '156047850.00', '163850243.00'),
  (276, 108, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Paket Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', NULL, '1', '1', '2', '2', '2', NULL, '325364000.00', '227250000.00', '234862500.00', '242855625.00', '251248405.00'),
  (277, 109, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 'Jumlah Laporan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 'Laporan', NULL, '', '', '', '', '', NULL, '141017996.00', '0.00', '0.00', '0.00', '0.00'),
  (278, 109, 'Penyelenggaraan Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', '7.01.02.2.02', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Pelaksanaan Kegiatan Peningkatan Pelayanan Paten', 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah
Kecamatan', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '25000000.00', '26250000.00', '27562500.00', '28940625.00', '30387656.00'),
  (279, 110, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah koordinasi kegiatan pemberdayaan desa', 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Lembaga Kemasyarakatan', NULL, '6', '6', '6', '6', '6', NULL, '64125200.00', '414210777.00', '434921316.00', '456667381.00', '479500750.00'),
  (280, 110, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Kegiatan Pemberdayaan Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Ditingkatkan Kapasitasnya', 'Lembaga Kemasyarakatan', NULL, '4', '4', '4', '4', '4', NULL, '78778000.00', '63000000.00', '66150000.00', '69457500.00', '72930375.00'),
  (281, 111, 'Koordinasi Upaya Penyelenggaraan Ketenteraman dan Ketertiban Umum', '7.01.04.2.01', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Kegiatan Koordinasi Upaya Penyelenggaraan Ketentraman dan Ketertiban Umum', 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di
Wilayah Kecamatan', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '33055200.00', '36750000.00', '38587500.00', '40516875.00', '42542719.00'),
  (282, 112, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Jumlah Kegiatan Fasilitasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan
Kepala Desa', 'Dokumen', NULL, '', '1', '1', '', '', NULL, '37445600.00', '52500000.00', '55125000.00', '57881250.00', '60775313.00');

-- Table: renstra_kegiatan_sasaran (14 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (282, 269, 'Jumlah Dokumen Perencanaan, Penganggaran dan Evaluasi Kinerja', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (283, 270, 'Jumlah Dokumen Administrasi Keuangan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (284, 271, 'Jumlah Dokumen Administrasi Barang Milik Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (285, 272, 'Jumlah Dokumen Administrasi Kepegawaian', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (286, 273, 'Jumlah Dokumen Administrasi Umum Perangkat Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (287, 274, 'Jumlah Paket Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (288, 275, 'Jumlah Laporan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (289, 276, 'Jumlah Paket Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (290, 277, 'Terlaksananya Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (291, 278, 'Jumlah Pelaksanaan Kegiatan Peningkatan Pelayanan Paten', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (292, 279, 'Jumlah koordinasi kegiatan pemberdayaan desa', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (293, 280, 'Jumlah Kegiatan Pemberdayaan Lembaga Kemasyarakatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (294, 281, 'Jumlah Kegiatan Koordinasi Upaya Penyelenggaraan Ketentraman dan Ketertiban Umum', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (295, 282, 'Jumlah Kegiatan Fasilitasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

-- Table: renstra_kegiatan_indikator (35 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1381, 269, 282, 80, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '21164000.00', '1', '21000000.00', '1', '22050000.00', '1', '23152500.00', '1', '24310125.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1382, 269, 282, 80, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1383, 269, 282, 80, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi
Kinerja SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1384, 269, 282, 80, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1385, 269, 282, 80, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 50, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1386, 269, 282, 80, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1387, 269, 282, 80, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan DPA-SKPD', '', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1388, 270, 283, 80, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '20', '20', '2273142861.00', '20', '2316101342.00', '20', '2431906409.00', '20', '2553501730.00', '20', '2681176816.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1389, 270, 283, 80, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1390, 270, 283, 80, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas
ASN', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1391, 270, 283, 80, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi  Penyusunan  Laporan Keuangan Akhir Tahun SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1392, 271, 284, 80, 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada SKPD', 'Laporan', '', '3', '0.00', '3', '10080000.00', '3', '10584000.00', '3', '11113200.00', '3', '11668860.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1393, 272, 285, 80, 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi
Kepegawaian', 'Dokumen', '3', '3', '28186457.00', '3', '42000000.00', '3', '44100000.00', '3', '46305000.00', '3', '48620250.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1394, 272, 285, 80, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '1', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1395, 273, 286, 80, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '2', '2', '98036342.00', '2', '136500000.00', '2', '143325000.00', '2', '150491250.00', '2', '158015813.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1396, 273, 286, 80, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '1', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1397, 274, 287, 80, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang
Disediakan', 'Unit', '', '', '205535259.00', '', '130000000.00', '1', '160250000.00', '', '115762500.00', '', '121550625.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1398, 274, 287, 80, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', '10', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1399, 274, 287, 80, 'Jumlah Unit Kendaraan Perorangan Dinas atau Kendaraan Dinas
Jabatan yang Disediakan', 'Unit', '', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1400, 275, 288, 80, 'Jumlah Laporan Penyediaan Jasa
Pelayanan Umum Kantor yang Disediakan', 'Laporan', '2', '1', '199934400.00', '1', '141540000.00', '1', '148617000.00', '1', '156047850.00', '1', '163850243.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1401, 275, 288, 80, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1402, 275, 288, 80, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan
Listrik yang Disediakan', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1403, 276, 289, 80, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', '', '1', '325364000.00', '1', '227250000.00', '2', '234862500.00', '2', '242855625.00', '2', '251248405.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1404, 276, 289, 80, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', '10', '10', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1405, 276, 289, 80, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '25', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', 30, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1406, 276, 289, 80, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1407, 277, 290, 80, 'Jumlah Laporan Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', 'Laporan', '', '', '141017996.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1408, 278, 291, 80, 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah
Kecamatan', 'Laporan', '3', '3', '25000000.00', '3', '26250000.00', '3', '27562500.00', '3', '28940625.00', '3', '30387656.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1409, 279, 292, 80, 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Lembaga Kemasyarakatan', '6', '6', '64125200.00', '6', '414210777.00', '6', '434921316.00', '6', '456667381.00', '6', '479500750.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1410, 279, 292, 80, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '6', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1411, 280, 293, 80, 'Jumlah Lembaga Kemasyarakatan yang Ditingkatkan Kapasitasnya', 'Lembaga Kemasyarakatan', '', '4', '78778000.00', '4', '63000000.00', '4', '66150000.00', '4', '69457500.00', '4', '72930375.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1412, 281, 294, 80, 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di
Wilayah Kecamatan', 'Laporan', '3', '3', '33055200.00', '3', '36750000.00', '3', '38587500.00', '3', '40516875.00', '3', '42542719.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1413, 282, 295, 80, 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan
Kepala Desa', 'Dokumen', '', '', '37445600.00', '1', '52500000.00', '1', '55125000.00', '', '57881250.00', '', '60775313.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1414, 282, 295, 80, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1415, 282, 295, 80, 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata
Pemerintahan Desa', 'Dokumen', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

-- Table: renstra_sub_kegiatan (34 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1439, 269, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '4000000.00', '4200000.00', '4410000.00', '4630500.00', '4862025.00'),
  (1440, 269, 'Koordinasi dan Penyusunan Dokumen RKA-SKPD', '7.01.01.2.01.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2100000.00', '2205000.00', '2315250.00', '2431013.00'),
  (1441, 269, 'Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '7.01.01.2.01.0003', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2100000.00', '2205000.00', '2315250.00', '2431012.00'),
  (1442, 269, 'Koordinasi dan Penyusunan DPA-SKPD', '7.01.01.2.01.0004', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2100000.00', '2205000.00', '2315250.00', '2431013.00'),
  (1443, 269, 'Koordinasi dan Penyusunan Perubahan DPA- SKPD', '7.01.01.2.01.0005', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2100000.00', '2205000.00', '2315250.00', '2431012.00'),
  (1444, 269, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '7.01.01.2.01.0006', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '4000000.00', '4200000.00', '4410000.00', '4630500.00', '4862025.00'),
  (1445, 269, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5164000.00', '4200000.00', '4410000.00', '4630500.00', '4862025.00'),
  (1446, 270, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '20', '20', '20', '20', '20', NULL, '2170498861.00', '2220131342.00', '2331137909.00', '2447694805.00', '2570079545.00'),
  (1447, 270, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '7.01.01.2.02.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas
ASN', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '97644000.00', '90720000.00', '95256000.00', '100018800.00', '105019740.00'),
  (1448, 270, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '7.01.01.2.02.0005', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi  Penyusunan  Laporan Keuangan Akhir Tahun SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '3000000.00', '3150000.00', '3307500.00', '3472875.00', '3646519.00'),
  (1449, 270, 'Koordinasi dan Penyusunan Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD', '7.01.01.2.02.0007', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '2000000.00', '2100000.00', '2205000.00', '2315250.00', '2431012.00'),
  (1450, 271, 'Penatausahaan Barang Milik Daerah pada SKPD', '7.01.01.2.03.0006', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Penatausahaan
Barang Milik Daerah pada SKPD', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '0.00', '10080000.00', '10584000.00', '11113200.00', '11668860.00'),
  (1451, 272, 'Pengadaan Pakaian Dinas beserta Atribut Kelengkapannya', '7.01.01.2.05.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '23186457.00', '31500000.00', '33075000.00', '34728750.00', '36465188.00'),
  (1452, 272, 'Pendataan dan Pengolahan Administrasi Kepegawaian', '7.01.01.2.05.0003', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi
Kepegawaian', 'Dokumen', NULL, '3', '3', '3', '3', '3', NULL, '5000000.00', '10500000.00', '11025000.00', '11576250.00', '12155062.00'),
  (1453, 273, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '6', '6', '6', '6', '6', NULL, '60136352.00', '73500000.00', '77175000.00', '81033750.00', '85085438.00'),
  (1454, 273, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '37899990.00', '63000000.00', '66150000.00', '69457500.00', '72930375.00'),
  (1455, 274, 'Pengadaan Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '7.01.01.2.07.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Unit Kendaraan Perorangan Dinas atau Kendaraan Dinas
Jabatan yang Disediakan', 'Unit', NULL, '', '1', '', '', '', NULL, '0.00', '25000000.00', '0.00', '0.00', '0.00'),
  (1456, 274, 'Pengadaan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.07.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang
Disediakan', 'Unit', NULL, '', '', '1', '', '', NULL, '40611015.00', '0.00', '50000000.00', '0.00', '0.00'),
  (1457, 274, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0010', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', NULL, '10', '10', '10', '10', '10', NULL, '164924244.00', '105000000.00', '110250000.00', '115762500.00', '121550625.00'),
  (1458, 275, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '4800000.00', '5040000.00', '5292000.00', '5556600.00', '5834430.00'),
  (1459, 275, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan
Listrik yang Disediakan', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '52399200.00', '63000000.00', '66150000.00', '69457500.00', '72930375.00'),
  (1460, 275, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', '', NULL, '1', '1', '1', '1', '1', NULL, '142735200.00', '73500000.00', '77175000.00', '81033750.00', '85085438.00'),
  (1461, 276, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '7.01.01.2.09.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', NULL, '', '11', '11', '11', '11', NULL, '0.00', '120750000.00', '126787500.00', '133126875.00', '139783219.00'),
  (1462, 276, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', NULL, '10', '1', '2', '2', '2', NULL, '110080000.00', '10500000.00', '11025000.00', '11576250.00', '12155062.00'),
  (1463, 276, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (1464, 276, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', NULL, '30', '30', '30', '30', '30', NULL, '15284000.00', '21000000.00', '22050000.00', '23152500.00', '24310124.00'),
  (1465, 278, 'Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', '7.01.02.2.02.0003', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Meningkatnya Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '25000000.00', '26250000.00', '27562500.00', '28940625.00', '30387656.00'),
  (1466, 279, 'Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Desa', '7.01.03.2.01.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Meningkatnya Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Lembaga Kemasyarakatan', NULL, '6', '6', '6', '6', '6', NULL, '15107600.00', '23100000.00', '24255000.00', '25467750.00', '26741137.00'),
  (1467, 279, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '6', '6', '6', '6', '6', NULL, '49017600.00', '391110777.00', '410666316.00', '431199631.00', '452759613.00'),
  (1468, 280, 'Peningkatan Kapasitas Lembaga Kemasyarakatan', '7.01.03.2.03.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Meningkatnya Kapasitas Lembaga Kemasyarakatan', 'Jumlah Lembaga Kemasyarakatan yang Ditingkatkan Kapasitasnya', 'Lembaga Kemasyarakatan', NULL, '4', '4', '4', '4', '4', NULL, '38110400.00', '63000000.00', '66150000.00', '69457500.00', '72930375.00'),
  (1469, 281, 'Sinergitas  dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', '7.01.04.2.01.0001', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di
Wilayah Kecamatan', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '33055200.00', '36750000.00', '38587500.00', '40516875.00', '42542719.00'),
  (1470, 282, 'Fasilitasi Administrasi Tata Pemerintahan Desa', '7.01.06.2.01.0002', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Fasilitasi Administrasi Tata Pemerintahan Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata
Pemerintahan Desa', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '16815200.00', '21000000.00', '22050000.00', '23152500.00', '24310125.00'),
  (1471, 282, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '20630400.00', '21500000.00', '23075000.00', '34728750.00', '36465188.00'),
  (1472, 282, 'Fasilitasi Pelaksanaan Pemilihan Kepala Desa', '7.01.06.2.01.0006', NULL, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL, 'Terlaksananya Fasilitasi Pelaksanaan Pemilihan Kepala Desa', 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan
Kepala Desa', 'Dokumen', NULL, '', '1', '1', '', '', NULL, '0.00', '10000000.00', '10000000.00', '0.00', '0.00');

-- Table: renstra_sub_kegiatan_sasaran (34 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1471, 1439, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1472, 1440, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1473, 1441, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1474, 1442, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1475, 1443, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1476, 1444, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1477, 1445, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1478, 1446, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1479, 1447, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1480, 1448, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1481, 1449, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1482, 1450, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1483, 1451, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1484, 1452, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1485, 1453, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1486, 1454, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1487, 1455, 'Tersedianya Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1488, 1456, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1489, 1457, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1490, 1458, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1491, 1459, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1492, 1460, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1493, 1461, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1494, 1462, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1495, 1463, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1496, 1464, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1497, 1465, 'Meningkatnya Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1498, 1466, 'Meningkatnya Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1499, 1467, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1500, 1468, 'Meningkatnya Kapasitas Lembaga Kemasyarakatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1501, 1469, 'Terlaksananya Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1502, 1470, 'Terlaksananya Fasilitasi Administrasi Tata Pemerintahan Desa', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1503, 1471, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1504, 1472, 'Terlaksananya Fasilitasi Pelaksanaan Pemilihan Kepala Desa', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

-- Table: renstra_sub_kegiatan_indikator (34 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1535, 1439, 1471, 80, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '2', '2', '4000000.00', '2', '4200000.00', '2', '4410000.00', '2', '4630500.00', '2', '4862025.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1536, 1440, 1472, 80, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '2000000.00', '1', '2100000.00', '1', '2205000.00', '1', '2315250.00', '1', '2431013.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1537, 1441, 1473, 80, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan RKA-SKPD', 'Dokumen', '1', '1', '2000000.00', '1', '2100000.00', '1', '2205000.00', '1', '2315250.00', '1', '2431012.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1538, 1442, 1474, 80, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '2000000.00', '1', '2100000.00', '1', '2205000.00', '1', '2315250.00', '1', '2431013.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1539, 1443, 1475, 80, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan DPA-SKPD', 'Dokumen', '1', '1', '2000000.00', '1', '2100000.00', '1', '2205000.00', '1', '2315250.00', '1', '2431012.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1540, 1444, 1476, 80, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '1', '1', '4000000.00', '1', '4200000.00', '1', '4410000.00', '1', '4630500.00', '1', '4862025.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1541, 1445, 1477, 80, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '1', '1', '5164000.00', '1', '4200000.00', '1', '4410000.00', '1', '4630500.00', '1', '4862025.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1542, 1446, 1478, 80, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '20', '20', '2170498861.00', '20', '2220131342.00', '20', '2331137909.00', '20', '2447694805.00', '20', '2570079545.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1543, 1447, 1479, 80, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas
ASN', 'Dokumen', '1', '1', '97644000.00', '1', '90720000.00', '1', '95256000.00', '1', '100018800.00', '1', '105019740.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1544, 1448, 1480, 80, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi  Penyusunan  Laporan Keuangan Akhir Tahun SKPD', 'Laporan', '1', '1', '3000000.00', '1', '3150000.00', '1', '3307500.00', '1', '3472875.00', '1', '3646519.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1545, 1449, 1481, 80, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', '1', '1', '2000000.00', '1', '2100000.00', '1', '2205000.00', '1', '2315250.00', '1', '2431012.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1546, 1450, 1482, 80, 'Jumlah Laporan Penatausahaan
Barang Milik Daerah pada SKPD', 'Laporan', '', '3', '0.00', '3', '10080000.00', '3', '10584000.00', '3', '11113200.00', '3', '11668860.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1547, 1451, 1483, 80, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '1', '2', '23186457.00', '2', '31500000.00', '2', '33075000.00', '2', '34728750.00', '2', '36465188.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1548, 1452, 1484, 80, 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi
Kepegawaian', 'Dokumen', '3', '3', '5000000.00', '3', '10500000.00', '3', '11025000.00', '3', '11576250.00', '3', '12155062.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1549, 1453, 1485, 80, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '1', '6', '60136352.00', '6', '73500000.00', '6', '77175000.00', '6', '81033750.00', '6', '85085438.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1550, 1454, 1486, 80, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '2', '2', '37899990.00', '2', '63000000.00', '2', '66150000.00', '2', '69457500.00', '2', '72930375.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1551, 1455, 1487, 80, 'Jumlah Unit Kendaraan Perorangan Dinas atau Kendaraan Dinas
Jabatan yang Disediakan', 'Unit', '', '', '0.00', '1', '25000000.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1552, 1456, 1488, 80, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang
Disediakan', 'Unit', '', '', '40611015.00', '', '0.00', '1', '50000000.00', '', '0.00', '', '0.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1553, 1457, 1489, 80, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', '10', '10', '164924244.00', '10', '105000000.00', '10', '110250000.00', '10', '115762500.00', '10', '121550625.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1554, 1458, 1490, 80, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '2', '4800000.00', '2', '5040000.00', '2', '5292000.00', '2', '5556600.00', '2', '5834430.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1555, 1459, 1491, 80, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan
Listrik yang Disediakan', 'Laporan', '1', '1', '52399200.00', '1', '63000000.00', '1', '66150000.00', '1', '69457500.00', '1', '72930375.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1556, 1460, 1492, 80, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', '', '2', '1', '142735200.00', '1', '73500000.00', '1', '77175000.00', '1', '81033750.00', '1', '85085438.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1557, 1461, 1493, 80, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', '10', '', '0.00', '11', '120750000.00', '11', '126787500.00', '11', '133126875.00', '11', '139783219.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1558, 1462, 1494, 80, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', '', '10', '110080000.00', '1', '10500000.00', '2', '11025000.00', '2', '11576250.00', '2', '12155062.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1559, 1463, 1495, 80, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '1', '1', '200000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1560, 1464, 1496, 80, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '25', '30', '15284000.00', '30', '21000000.00', '30', '22050000.00', '30', '23152500.00', '30', '24310124.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1561, 1465, 1497, 80, 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 'Laporan', '3', '3', '25000000.00', '3', '26250000.00', '3', '27562500.00', '3', '28940625.00', '3', '30387656.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1562, 1466, 1498, 80, 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Lembaga Kemasyarakatan', '6', '6', '15107600.00', '6', '23100000.00', '6', '24255000.00', '6', '25467750.00', '6', '26741137.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1563, 1467, 1499, 80, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Laporan', '6', '6', '49017600.00', '6', '391110777.00', '6', '410666316.00', '6', '431199631.00', '6', '452759613.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1564, 1468, 1500, 80, 'Jumlah Lembaga Kemasyarakatan yang Ditingkatkan Kapasitasnya', 'Lembaga Kemasyarakatan', '', '4', '38110400.00', '4', '63000000.00', '4', '66150000.00', '4', '69457500.00', '4', '72930375.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1565, 1469, 1501, 80, 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di
Wilayah Kecamatan', 'Laporan', '3', '3', '33055200.00', '3', '36750000.00', '3', '38587500.00', '3', '40516875.00', '3', '42542719.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1566, 1470, 1502, 80, 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata
Pemerintahan Desa', 'Dokumen', '', '2', '16815200.00', '2', '21000000.00', '2', '22050000.00', '2', '23152500.00', '2', '24310125.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1567, 1471, 1503, 80, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '2', '2', '20630400.00', '2', '21500000.00', '2', '23075000.00', '2', '34728750.00', '2', '36465188.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL),
  (1568, 1472, 1504, 80, 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan
Kepala Desa', 'Dokumen', '', '', '0.00', '1', '10000000.00', '1', '10000000.00', '', '0.00', '', '0.00', 10, '2026-09-24 12:38:47', '2026-09-24 12:38:47', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
