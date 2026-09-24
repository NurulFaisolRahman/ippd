-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: KECAMATAN JANGKAR
-- ID INSTANSI: 81 | KODE: 7.01.0.00.0.00.16.000
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-24 11:06:10
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (KECAMATAN JANGKAR) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (81, '7.01.0.00.0.00.16.000', '35.12', 'KECAMATAN  JANGKAR', '7.01', NULL, NULL, '$2y$10$NpSY74uOsp9shImDw5t0Ou.xIsWKhzeU4O3FubGljDfj2Snwq0SDi', 4, 2025, 2029, '2026-09-09 12:02:32', '2026-09-22 19:05:39', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA KECAMATAN JANGKAR SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (1240, 1241, 1242, 1243, 1244, 1245, 1246, 1247, 1248, 1249, 1250, 1251, 1252, 1253, 1254, 1255, 1256, 1257, 1258, 1259, 1260, 1261, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1275, 1276, 1277, 1278, 1279, 1280, 1281, 1282, 1283, 1284, 1285, 1286, 1287);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (1240, 1241, 1242, 1243, 1244, 1245, 1246, 1247, 1248, 1249, 1250, 1251, 1252, 1253, 1254, 1255, 1256, 1257, 1258, 1259, 1260, 1261, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1275, 1276, 1277, 1278, 1279, 1280, 1281, 1282, 1283, 1284, 1285, 1286, 1287);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (90, 91, 92, 93, 94);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (90, 91, 92, 93, 94);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (90, 91, 92, 93, 94);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (46, 47, 48);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (46, 47, 48);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (18);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (18);
DELETE FROM `renstra_tujuan` WHERE `id` IN (18) OR (`id_instansi` = 81 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD KECAMATAN JANGKAR
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (18, '35.12', 81, '43', 'Meningkatnya Kinerja Tata Kelola Pemerintahan dan Pelayanan Publik', NULL, NULL, 'Nilai Kinerja Kecamatan', 'Nilai', NULL, '89.85', '90', '90.1', '90.55', '91', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (32, 18, 81, 'Nilai Kinerja Kecamatan', 'Nilai', '89.13', NULL, '89.85', '90', '90.1', '90.55', '91', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

-- Table: renstra_sasaran (3 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (46, 18, 'Meningkatnya Akuntabilitas Kinerja Perangkat Daerah', NULL, NULL, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '84', '84.5', '84.8', '85', '85.5', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (47, 18, 'Meningkatnya Kualitas Layanan Publik di Kecamatan Jangkar', NULL, NULL, 'Indeks Kepuasan Masyarakat (IKM)', 'Nilai', NULL, '90', '91', '91.5', '92', '92.5', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (48, 18, 'Meningkatnya Kualitas Pembinaan dan Pengawasan Desa / Kelurahan', NULL, NULL, 'Persentase Desa yang Meningkat Nilai Indeks Desa nya', '%', NULL, '100', '100', '100', '100', '100', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (4 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (78, 46, NULL, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '81.5', NULL, '84', '84.5', '84.8', '85', '85.5', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (79, 47, NULL, 'Indeks Kepuasan Masyarakat (IKM)', 'Nilai', '89.69', NULL, '90', '91', '91.5', '92', '92.5', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (80, 47, NULL, 'Nilai Kematangan Inovasi Kecamatan', 'Nilai', '94', NULL, '95.5', '96', '96.5', '97', '97.5', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (81, 48, NULL, 'Persentase Desa yang Meningkat Nilai Indeks Desa nya', '%', '100', NULL, '100', '100', '100', '100', '100', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

-- Table: renstra_program (5 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (90, 46, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '7.01.01', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, 'Meningkatnya Capaian Nilai SAKIP Perangkat Daerah Kecamatan Jangkar', 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '84', '84.5', '84.8', '85', '85.5', NULL, '2666646911.00', '2599150315.00', '2435014251.00', '2624045484.00', '2654289474.00'),
  (91, 47, 'PROGRAM PENYELENGGARAAN PEMERINTAHAN DAN PELAYANAN PUBLIK', '7.01.02', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, 'Penyelenggaraan Pelayanan Publik yang sesuai dengan Standard Operasional Prosedur (SOP) Kecamatan Jangkar', 'Persentase Layanan yang terselesaikan', '%', NULL, '100', '100', '100', '100', '100', NULL, '18144528.00', '24600000.00', '27528000.00', '29345680.00', '30300000.00'),
  (92, 48, 'PROGRAM PEMBERDAYAAN MASYARAKAT DESA DAN KELURAHAN', '7.01.03', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, 'Meningkatkan kemandirian dan kesejahteraan masyarakat desa Kecamatan Jangkar', 'Presentase Pemberdayaan Masyarakat Desa / Kelurahan', '%', NULL, '100', '100', '100', '100', '100', NULL, '205389181.00', '214555000.00', '249370500.00', '255919600.00', '260646905.00'),
  (93, 48, 'PROGRAM KOORDINASI KETENTRAMAN DAN KETERTIBAN UMUM', '7.01.04', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, 'Kepatuhan Masyarakat pada peraturan pemerintah Kecamatan Jangkar', 'Persentase koordinasi ketentraman dan ketertiban
umum', '%', NULL, '100', '100', '100', '100', '100', NULL, '10000000.00', '15000000.00', '18900000.00', '19500000.00', '70000000.00'),
  (94, 48, 'PROGRAM PEMBINAAN DAN PENGAWASAN PEMERINTAHAN DESA', '7.01.06', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, NULL, 'Penyelenggaraan Pemerintahan Desa / Kelurahan yang sesuai dengan ketentuan peraturan perundang-undangan Kecamatan Jangkar', 'Persentase pembinaan dan pengawasan desa', '%', NULL, '100', '100', '100', '100', '100', NULL, '44840000.00', '68200000.00', '68300000.00', '102450000.00', '168675000.00');

-- Table: renstra_program_outcome (5 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (124, 90, 'Meningkatnya Capaian Nilai SAKIP Perangkat Daerah Kecamatan Jangkar', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (125, 91, 'Penyelenggaraan Pelayanan Publik yang sesuai dengan Standard Operasional Prosedur (SOP) Kecamatan Jangkar', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (126, 92, 'Meningkatkan kemandirian dan kesejahteraan masyarakat desa Kecamatan Jangkar', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (127, 93, 'Kepatuhan Masyarakat pada peraturan pemerintah Kecamatan Jangkar', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (128, 94, 'Penyelenggaraan Pemerintahan Desa / Kelurahan yang sesuai dengan ketentuan peraturan perundang-undangan Kecamatan Jangkar', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (213, 90, 124, 81, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '81.5', '84', '84.5', '84.8', '85', '85.5', '2666646911.00', '2599150315.00', '2435014251.00', '2624045484.00', '2654289474.00', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 10),
  (214, 91, 125, 81, 'Persentase Layanan yang terselesaikan', '%', '100', '100', '100', '100', '100', '100', '18144528.00', '24600000.00', '27528000.00', '29345680.00', '30300000.00', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 10),
  (215, 92, 126, 81, 'Presentase Pemberdayaan Masyarakat Desa / Kelurahan', '%', '100', '100', '100', '100', '100', '100', '205389181.00', '214555000.00', '249370500.00', '255919600.00', '260646905.00', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 10),
  (216, 93, 127, 81, 'Persentase koordinasi ketentraman dan ketertiban
umum', '%', '100', '100', '100', '100', '100', '100', '10000000.00', '15000000.00', '18900000.00', '19500000.00', '70000000.00', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 10),
  (217, 94, 128, 81, 'Persentase pembinaan dan pengawasan desa', '%', '100', '100', '100', '100', '100', '100', '44840000.00', '68200000.00', '68300000.00', '102450000.00', '168675000.00', '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 10);

-- Table: renstra_kegiatan (14 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (200, 90, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '12330000.00', '13800000.00', '14500000.00', '14900000.00', '14900000.00'),
  (201, 90, 'Administrasi Keuangan Perangkat Daerah', '7.01.01.2.02', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya  Administrasi Keuangan Perangkat Daerah', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '15', '15', '15', '15', '15', NULL, '1753720871.00', '1747423784.00', '1747923784.00', '1747923784.00', '1747923784.00'),
  (202, 90, 'Administrasi Barang Milik Daerah pada Perangkat Daerah', '7.01.01.2.03', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Administrasi Barang Milik Daerah pada Perangkat Daerah', 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada
SKPD', 'Laporan', NULL, '', '12', '12', '12', '12', NULL, '0.00', '6000000.00', '7200000.00', '7200000.00', '7200000.00'),
  (203, 90, 'Administrasi Kepegawaian Perangkat Daerah', '7.01.01.2.05', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya  Administrasi Kepegawaian Perangkat Daerah', 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', NULL, '1', '1', '3', '1', '2', NULL, '7945158.00', '12000000.00', '23200000.00', '16000000.00', '21200000.00'),
  (204, 90, 'Administrasi Umum Perangkat Daerah', '7.01.01.2.06', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Administrasi Umum Perangkat Daerah', 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '151596500.00', '128849541.00', '135532018.00', '141863000.00', '149368075.00'),
  (205, 90, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '7.01.01.2.07', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', NULL, '5', '1', '1', '1', '1', NULL, '187801233.00', '157700000.00', '128939000.00', '115100000.00', '107700000.00'),
  (206, 90, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.08', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '220759570.00', '217434790.00', '236809250.00', '248684700.00', '261143935.00'),
  (207, 90, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '7.01.01.2.09', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '332493579.00', '315942200.00', '140910199.00', '332374000.00', '344853680.00'),
  (208, 91, 'Koordinasi Penyelenggaraan Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya koordinasi Pemerintahan di  Kecamatan Jangkar', 'Jumlah Dokumen Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '8400000.00', '10032000.00', '10450000.00', '11300000.00'),
  (209, 91, 'Penyelenggaraan Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', '7.01.02.2.02', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat
di Wilayah Kecamatan', 'Laporan', NULL, '15', '15', '15', '15', '15', NULL, '18144528.00', '16200000.00', '17496000.00', '18895680.00', '19000000.00'),
  (210, 92, 'Koordinasi Kegiatan Pemberdayaan Desa', '7.01.03.2.01', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya  Pembinaan dan Pengawasan Kegiatan Pemberdayaan Desa / Kelurahan', 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan
Pembangunan di Desa', 'Lembaga Kemasyarakatan', NULL, '5', '5', '5', '5', '5', NULL, '200389181.00', '209155000.00', '243370500.00', '249439600.00', '253646905.00'),
  (211, 92, 'Pemberdayaan Lembaga Kemasyarakatan Tingkat Kecamatan', '7.01.03.2.03', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Pemberdayaan Masyarakat Desa / Kelurahan', 'Jumlah Laporan Fasilitasi Pengembangan Usaha Ekonomi
Masyarakat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5400000.00', '6000000.00', '6480000.00', '7000000.00'),
  (212, 93, 'Koordinasi Upaya Penyelenggaraan Ketenteraman dan Ketertiban Umum', '7.01.04.2.01', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Sinergitas tingkat Kecamatan', 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '10000000.00', '15000000.00', '18900000.00', '19500000.00', '70000000.00'),
  (213, 94, 'Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa', '7.01.06.2.01', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa / Kelurahan', 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata Pemerintahan Desa', 'Dokumen', NULL, '7', '7', '7', '7', '7', NULL, '44840000.00', '68200000.00', '68300000.00', '102450000.00', '168675000.00');

-- Table: renstra_kegiatan_sasaran (14 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (213, 200, 'Terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (214, 201, 'Terlaksananya  Administrasi Keuangan Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (215, 202, 'Terlaksananya Administrasi Barang Milik Daerah pada Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (216, 203, 'Terlaksananya  Administrasi Kepegawaian Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (217, 204, 'Terlaksananya Administrasi Umum Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (218, 205, 'Terlaksananya Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (219, 206, 'Terlaksananya Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (220, 207, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (221, 208, 'Terlaksananya koordinasi Pemerintahan di  Kecamatan Jangkar', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (222, 209, 'Terlaksananya Urusan Pemerintahan yang Tidak Dilaksanakan oleh Unit Kerja Perangkat Daerah yang Ada di Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (223, 210, 'Terlaksananya  Pembinaan dan Pengawasan Kegiatan Pemberdayaan Desa / Kelurahan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (224, 211, 'Terlaksananya Fasilitasi Pemberdayaan Masyarakat Desa / Kelurahan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (225, 212, 'Terlaksananya Sinergitas tingkat Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (226, 213, 'Terlaksananya Fasilitasi, Rekomendasi dan Koordinasi Pembinaan dan Pengawasan Pemerintahan Desa / Kelurahan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

-- Table: renstra_kegiatan_indikator (48 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1188, 200, 213, 81, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-
SKPD', 'Dokumen', '4', '1', '12330000.00', '1', '13800000.00', '1', '14500000.00', '1', '14900000.00', '1', '14900000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1189, 200, 213, 81, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-
SKPD', 'Dokumen', '4', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1190, 200, 213, 81, 'Jumlah Laporan Capaian  Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '16', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1191, 200, 213, 81, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '4', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 40, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1192, 200, 213, 81, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', '4', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1193, 200, 213, 81, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '12', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '3', '0.00', 60, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1194, 200, 213, 81, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '4', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1195, 201, 214, 81, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '15', '15', '1753720871.00', '15', '1747423784.00', '15', '1747923784.00', '15', '1747923784.00', '15', '1747923784.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1196, 201, 214, 81, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan
Bulanan/Triwulanan/Semesteran SKPD', 'Laporan', '24', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1197, 201, 214, 81, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun
SKPD', 'Laporan', '4', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1198, 201, 214, 81, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '30', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 40, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1199, 202, 215, 81, 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada
SKPD', 'Laporan', '', '', '0.00', '12', '6000000.00', '12', '7200000.00', '12', '7200000.00', '12', '7200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1200, 203, 216, 81, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '5', '1', '7945158.00', '1', '12000000.00', '3', '23200000.00', '1', '16000000.00', '2', '21200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1201, 203, 216, 81, 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja
Pegawai', 'Dokumen', '', '', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1202, 204, 217, 81, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', '', '', '151596500.00', '1', '128849541.00', '1', '135532018.00', '1', '141863000.00', '1', '149368075.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1203, 204, 217, 81, 'Jumlah Paket Peralatan Rumah
Tangga yang Disediakan', 'Paket', '', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1204, 204, 217, 81, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '15', '11', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1205, 204, 217, 81, 'Jumlah Paket Barang Cetakan dan Penggandaan yang
Disediakan', 'Paket', '7', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 40, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1206, 204, 217, 81, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', 'Dokumen', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1207, 204, 217, 81, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '66', '34', '0.00', '35', '0.00', '36', '0.00', '36', '0.00', '38', '0.00', 60, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1208, 204, 217, 81, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '48', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 70, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1209, 204, 217, 81, 'Jumlah Laporan Fasilitasi
Kunjungan Tamu', 'Laporan', '', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 80, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1210, 205, 218, 81, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', '', '5', '187801233.00', '1', '157700000.00', '1', '128939000.00', '1', '115100000.00', '1', '107700000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1211, 205, 218, 81, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '2', '3', '0.00', '2', '0.00', '', '0.00', '3', '0.00', '3', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1212, 205, 218, 81, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '', '13', '0.00', '2', '0.00', '3', '0.00', '3', '0.00', '2', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1213, 205, 218, 81, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang Disediakan', 'Unit', '', '', '0.00', '3', '0.00', '2', '0.00', '', '0.00', '', '0.00', 40, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1214, 206, 219, 81, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '72', '12', '220759570.00', '12', '217434790.00', '12', '236809250.00', '12', '248684700.00', '12', '261143935.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1215, 206, 219, 81, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '84', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1216, 206, 219, 81, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '48', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1217, 207, 220, 81, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '44', '11', '332493579.00', '11', '315942200.00', '11', '140910199.00', '11', '332374000.00', '11', '344853680.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1218, 207, 220, 81, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '2', '4', '0.00', '1', '0.00', '', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1219, 207, 220, 81, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '40', '14', '0.00', '14', '0.00', '14', '0.00', '14', '0.00', '14', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1220, 207, 220, 81, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '41', '35', '0.00', '30', '0.00', '35', '0.00', '35', '0.00', '35', '0.00', 40, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1221, 207, 220, 81, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan
Pajak dan Perizinannya', 'Unit', '44', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', 50, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1222, 207, 220, 81, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '', '', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 60, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1223, 208, 221, 81, 'Jumlah Dokumen Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Dokumen', '', '', '0.00', '1', '8400000.00', '1', '10032000.00', '1', '10450000.00', '1', '11300000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1224, 208, 221, 81, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi
Vertikal Terkait', 'Laporan', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1225, 209, 222, 81, 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat
di Wilayah Kecamatan', 'Laporan', '52', '15', '18144528.00', '15', '16200000.00', '15', '17496000.00', '15', '18895680.00', '15', '19000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1226, 209, 222, 81, 'Jumlah Laporan Fasilitasi Percepatan Pencapaian Standar Pelayanan Minimal di Wilayah
Kecamatan', 'Laporan', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1227, 210, 223, 81, 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan
Pembangunan di Desa', 'Lembaga Kemasyarakatan', '18', '5', '200389181.00', '5', '209155000.00', '5', '243370500.00', '5', '249439600.00', '5', '253646905.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1228, 210, 223, 81, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di
Wilayah Kecamatan', 'Laporan', '18', '8', '0.00', '8', '0.00', '8', '0.00', '8', '0.00', '8', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1229, 211, 224, 81, 'Jumlah Laporan Fasilitasi Pengembangan Usaha Ekonomi
Masyarakat', 'Laporan', '', '1', '5000000.00', '1', '5400000.00', '1', '6000000.00', '1', '6480000.00', '1', '7000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1230, 212, 225, 81, 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 'Laporan', '8', '4', '10000000.00', '4', '15000000.00', '4', '18900000.00', '4', '19500000.00', '4', '70000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1231, 213, 226, 81, 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata Pemerintahan Desa', 'Dokumen', '', '7', '44840000.00', '7', '68200000.00', '7', '68300000.00', '7', '102450000.00', '7', '168675000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1232, 213, 226, 81, 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan Kepala Desa', 'Dokumen', '', '', '0.00', '7', '0.00', '', '0.00', '', '0.00', '1', '0.00', 20, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1233, 213, 226, 81, 'Jumlah Dokumen Fasilitasi dalam rangka Penyelenggaraan Ketenteraman dan Ketertiban
Umum', 'Dokumen', '32', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 30, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1234, 213, 226, 81, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '28', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 40, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1235, 213, 226, 81, 'Jumlah Laporan Hasil Koordinasi Pelaksanaan Pembangunan Kawasan Perdesaan di Wilayah
Kecamatan', 'Laporan', '32', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 50, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

-- Table: renstra_sub_kegiatan (48 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1240, 200, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '7.01.01.2.01.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '3', NULL, '2472000.00', '2400000.00', '2700000.00', '2900000.00', '2900000.00'),
  (1241, 200, 'Koordinasi dan Penyusunan Dokumen RKA-SKPD', '7.01.01.2.01.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '1604000.00', '1700000.00', '1700000.00', '1800000.00', '1800000.00'),
  (1242, 200, 'Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '7.01.01.2.01.0003', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '1604000.00', '1700000.00', '1700000.00', '1800000.00', '1800000.00'),
  (1243, 200, 'Koordinasi dan Penyusunan DPA-SKPD', '7.01.01.2.01.0004', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '1404000.00', '1700000.00', '1700000.00', '1800000.00', '1800000.00'),
  (1244, 200, 'Koordinasi dan Penyusunan Perubahan DPA- SKPD', '7.01.01.2.01.0005', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '1404000.00', '1700000.00', '1700000.00', '1800000.00', '1800000.00'),
  (1245, 200, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '7.01.01.2.01.0006', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian  Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '2272000.00', '2600000.00', '3000000.00', '2600000.00', '2600000.00'),
  (1246, 200, 'Evaluasi Kinerja Perangkat Daerah', '7.01.01.2.01.0007', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '1570000.00', '2000000.00', '2000000.00', '2200000.00', '2200000.00'),
  (1247, 201, 'Penyediaan Gaji dan Tunjangan ASN', '7.01.01.2.02.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '15', '15', '15', '15', '15', NULL, '1680822871.00', '1674223784.00', '1674223784.00', '1674223784.00', '1674223784.00'),
  (1248, 201, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '7.01.01.2.02.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '68440000.00', '68700000.00', '68700000.00', '68700000.00', '68700000.00'),
  (1249, 201, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '7.01.01.2.02.0005', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '1498000.00', '1700000.00', '2000000.00', '2000000.00', '2000000.00'),
  (1250, 201, 'Koordinasi dan Penyusunan Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD', '7.01.01.2.02.0007', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '2960000.00', '2800000.00', '3000000.00', '3000000.00', '3000000.00'),
  (1251, 202, 'Penatausahaan Barang Milik Daerah pada SKPD', '7.01.01.2.03.0006', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada
SKPD', 'Laporan', NULL, '', '12', '12', '12', '12', NULL, '0.00', '6000000.00', '7200000.00', '7200000.00', '7200000.00'),
  (1252, 203, 'Pengadaan Pakaian Dinas beserta Atribut Kelengkapannya', '7.01.01.2.05.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', NULL, '1', '1', '3', '1', '2', NULL, '7945158.00', '7000000.00', '17200000.00', '10000000.00', '15200000.00'),
  (1253, 203, 'Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', '7.01.01.2.05.0005', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '0.00', '5000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (1254, 204, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '7.01.01.2.06.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '11', '10', '10', '10', '10', NULL, '3854405.00', '3150000.00', '3307500.00', '3475000.00', '3650000.00'),
  (1255, 204, 'Penyediaan Peralatan Rumah Tangga', '7.01.01.2.06.0003', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '10', '10', '10', '10', '10', NULL, '5811150.00', '4200000.00', '4800000.00', '4800000.00', '5200000.00'),
  (1256, 204, 'Penyediaan Bahan Logistik Kantor', '7.01.01.2.06.0004', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '34', '35', '36', '36', '38', NULL, '18367614.00', '21729441.00', '22815913.00', '24000000.00', '25000000.00'),
  (1257, 204, 'Penyediaan Barang Cetakan dan Penggandaan', '7.01.01.2.06.0005', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '5', '5', '5', '5', '5', NULL, '5411131.00', '5250000.00', '5512500.00', '5788000.00', '6077000.00'),
  (1258, 204, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '7.01.01.2.06.0006', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '3654000.00', '3836700.00', '4100000.00', '4230000.00'),
  (1259, 204, 'Fasilitasi Kunjungan Tamu', '7.01.01.2.06.0008', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Kunjungan Tamu', 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '3130200.00', '12600000.00', '13230000.00', '13800000.00', '14586075.00'),
  (1260, 204, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '7.01.01.2.06.0009', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '115022000.00', '75266100.00', '79029405.00', '82900000.00', '87125000.00'),
  (1261, 204, 'Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', '7.01.01.2.06.0011', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3500000.00'),
  (1262, 205, 'Pengadaan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.07.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan
yang Disediakan', 'Unit', NULL, '', '3', '2', '', '', NULL, '0.00', '80000000.00', '67000000.00', '0.00', '0.00'),
  (1263, 205, 'Pengadaan Mebel', '7.01.01.2.07.0005', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang
Disediakan', 'Unit', NULL, '3', '2', '', '3', '3', NULL, '66130248.00', '36500000.00', '0.00', '50000000.00', '63000000.00'),
  (1264, 205, 'Pengadaan Peralatan dan Mesin Lainnya', '7.01.01.2.07.0006', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan
Mesin Lainnya yang Disediakan', 'Unit', NULL, '13', '2', '3', '3', '2', NULL, '106998450.00', '33000000.00', '53500000.00', '56000000.00', '34500000.00'),
  (1265, 205, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.07.0011', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', NULL, '5', '1', '1', '1', '1', NULL, '14672535.00', '8200000.00', '8439000.00', '9100000.00', '10200000.00'),
  (1266, 206, 'Penyediaan Jasa Surat Menyurat', '7.01.01.2.08.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '2500000.00', '3150000.00', '3300000.00', '3500000.00', '3700000.00'),
  (1267, 206, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '7.01.01.2.08.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '63827970.00', '52184790.00', '54794000.00', '57533700.00', '60410385.00'),
  (1268, 206, 'Penyediaan Jasa Pelayanan Umum Kantor', '7.01.01.2.08.0004', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor
yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '154431600.00', '162100000.00', '178715250.00', '187651000.00', '197033550.00'),
  (1269, 207, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '7.01.01.2.09.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '86376426.00', '96500000.00', '100321155.00', '102327500.00', '104374130.00'),
  (1270, 207, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '7.01.01.2.09.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '4450000.00', '4131000.00', '4213620.00', '4297800.00', '4383850.00'),
  (1271, 207, 'Pemeliharaan Peralatan dan Mesin Lainnya', '7.01.01.2.09.0006', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '', '3', '3', '3', '3', NULL, '0.00', '12811200.00', '13067424.00', '13328700.00', '13595300.00'),
  (1272, 207, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '7.01.01.2.09.0009', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '4', '1', '', '1', '1', NULL, '222576330.00', '186000000.00', '0.00', '189000000.00', '198000000.00'),
  (1273, 207, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0010', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '14', '14', '14', '14', '14', NULL, '5737590.00', '7600000.00', '8908000.00', '8900000.00', '9000200.00'),
  (1274, 207, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '7.01.01.2.09.0011', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '35', '30', '35', '35', '35', NULL, '13353233.00', '8900000.00', '14400000.00', '14520000.00', '15500200.00'),
  (1275, 208, 'Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', '7.01.02.2.01.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi
Vertikal Terkait', 'Laporan', NULL, '', '1', '1', '1', '1', NULL, '0.00', '5400000.00', '5832000.00', '6250000.00', '6800000.00'),
  (1276, 208, 'Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', '7.01.02.2.01.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Meningkatnya Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 'Jumlah Dokumen Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat
Kecamatan', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '3000000.00', '4200000.00', '4200000.00', '4500000.00'),
  (1277, 209, 'Fasilitasi Percepatan Pencapaian Standar Pelayanan Minimal di Wilayah Kecamatan', '7.01.02.2.02.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Percepatan Pencapaian Standar Pelayanan Minimal di Wilayah Kecamatan', 'Jumlah Laporan Fasilitasi Percepatan Pencapaian Standar Pelayanan Minimal di Wilayah
Kecamatan', 'Laporan', NULL, '', '1', '1', '1', '1', NULL, '0.00', '5400000.00', '5832000.00', '5832000.00', '5832000.00'),
  (1278, 209, 'Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', '7.01.02.2.02.0003', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Meningkatnya Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 'Laporan', NULL, '15', '15', '15', '15', '15', NULL, '18144528.00', '10800000.00', '11664000.00', '13063680.00', '13168000.00'),
  (1279, 210, 'Peningkatan Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Desa', '7.01.03.2.01.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Meningkatnya Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Lembaga Kemasyarakatan', NULL, '5', '5', '5', '5', '5', NULL, '11050000.00', '12155000.00', '13370500.00', '14707550.00', '16178305.00'),
  (1280, 210, 'Peningkatan Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', '7.01.03.2.01.0003', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di
Wilayah Kecamatan', 'Laporan', NULL, '8', '8', '8', '8', '8', NULL, '189339181.00', '197000000.00', '230000000.00', '234732050.00', '237468600.00'),
  (1281, 211, 'Fasilitasi Pengembangan Usaha Ekonomi Masyarakat', '7.01.03.2.03.0004', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Pengembangan Usaha Ekonomi Masyarakat', 'Jumlah Laporan Fasilitasi Pengembangan Usaha Ekonomi Masyarakat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5400000.00', '6000000.00', '6480000.00', '7000000.00'),
  (1282, 212, 'Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', '7.01.04.2.01.0001', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '10000000.00', '15000000.00', '18900000.00', '19500000.00', '70000000.00'),
  (1283, 213, 'Fasilitasi Administrasi Tata Pemerintahan Desa', '7.01.06.2.01.0002', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Administrasi Tata Pemerintahan Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata Pemerintahan Desa', 'Dokumen', NULL, '7', '7', '7', '7', '7', NULL, '8200000.00', '8000000.00', '8000000.00', '12000000.00', '18000000.00'),
  (1284, 213, 'Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', '7.01.06.2.01.0003', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', NULL, '6', '6', '6', '6', '6', NULL, '13900000.00', '15100000.00', '22650000.00', '33975000.00', '50962500.00'),
  (1285, 213, 'Fasilitasi Pelaksanaan Pemilihan Kepala Desa', '7.01.06.2.01.0006', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Pelaksanaan Pemilihan Kepala Desa', 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan Kepala Desa', 'Dokumen', NULL, '', '7', '', '', '1', NULL, '0.00', '20000000.00', '0.00', '0.00', '15000000.00'),
  (1286, 213, 'Fasilitasi Penyelenggaraan Ketenteraman dan Ketertiban Umum', '7.01.06.2.01.0011', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Fasilitasi Penyelenggaraan Ketenteraman dan Ketertiban Umum', 'Jumlah Dokumen Fasilitasi dalam rangka Penyelenggaraan Ketenteraman dan Ketertiban
Umum', 'Dokumen', NULL, '6', '6', '6', '6', '6', NULL, '8840000.00', '10000000.00', '15000000.00', '22500000.00', '33750000.00'),
  (1287, 213, 'Koordinasi Pelaksanaan Pembangunan Kawasan Perdesaan di Wilayah Kecamatan', '7.01.06.2.01.0018', NULL, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL, 'Terlaksananya Koordinasi Pelaksanaan Pembangunan Kawasan Perdesaan di Wilayah Kecamatan', 'Jumlah Laporan Hasil Koordinasi Pelaksanaan Pembangunan Kawasan Perdesaan di Wilayah
Kecamatan', 'Laporan', NULL, '6', '6', '6', '6', '6', NULL, '13900000.00', '15100000.00', '22650000.00', '33975000.00', '50962500.00');

-- Table: renstra_sub_kegiatan_sasaran (48 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1272, 1240, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1273, 1241, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1274, 1242, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1275, 1243, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1276, 1244, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1277, 1245, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1278, 1246, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1279, 1247, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1280, 1248, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1281, 1249, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1282, 1250, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1283, 1251, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1284, 1252, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1285, 1253, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1286, 1254, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1287, 1255, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1288, 1256, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1289, 1257, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1290, 1258, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1291, 1259, 'Terlaksananya Fasilitasi Kunjungan Tamu', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1292, 1260, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1293, 1261, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1294, 1262, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1295, 1263, 'Tersedianya Mebel', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1296, 1264, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1297, 1265, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1298, 1266, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1299, 1267, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1300, 1268, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1301, 1269, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1302, 1270, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1303, 1271, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1304, 1272, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1305, 1273, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1306, 1274, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1307, 1275, 'Terlaksananya Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi Vertikal Terkait', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1308, 1276, 'Meningkatnya Efektifitas Kegiatan Pemerintahan di Tingkat Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1309, 1277, 'Terlaksananya Fasilitasi Percepatan Pencapaian Standar Pelayanan Minimal di Wilayah Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1310, 1278, 'Meningkatnya Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1311, 1279, 'Meningkatnya Partisipasi Masyarakat dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1312, 1280, 'Meningkatnya Efektifitas Kegiatan Pemberdayaan Masyarakat di Wilayah Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1313, 1281, 'Terlaksananya Fasilitasi Pengembangan Usaha Ekonomi Masyarakat', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1314, 1282, 'Terlaksananya Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1315, 1283, 'Terlaksananya Fasilitasi Administrasi Tata Pemerintahan Desa', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1316, 1284, 'Terlaksananya Fasilitasi Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1317, 1285, 'Terlaksananya Fasilitasi Pelaksanaan Pemilihan Kepala Desa', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1318, 1286, 'Terlaksananya Fasilitasi Penyelenggaraan Ketenteraman dan Ketertiban Umum', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1319, 1287, 'Terlaksananya Koordinasi Pelaksanaan Pembangunan Kawasan Perdesaan di Wilayah Kecamatan', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

-- Table: renstra_sub_kegiatan_indikator (48 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1336, 1240, 1272, 81, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '12', '2', '2472000.00', '2', '2400000.00', '2', '2700000.00', '2', '2900000.00', '3', '2900000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1337, 1241, 1273, 81, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-
SKPD', 'Dokumen', '4', '1', '1604000.00', '1', '1700000.00', '1', '1700000.00', '1', '1800000.00', '1', '1800000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1338, 1242, 1274, 81, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-
SKPD', 'Dokumen', '4', '1', '1604000.00', '1', '1700000.00', '1', '1700000.00', '1', '1800000.00', '1', '1800000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1339, 1243, 1275, 81, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-
SKPD', 'Dokumen', '4', '1', '1404000.00', '1', '1700000.00', '1', '1700000.00', '1', '1800000.00', '1', '1800000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1340, 1244, 1276, 81, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', '4', '1', '1404000.00', '1', '1700000.00', '1', '1700000.00', '1', '1800000.00', '1', '1800000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1341, 1245, 1277, 81, 'Jumlah Laporan Capaian  Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '16', '4', '2272000.00', '4', '2600000.00', '4', '3000000.00', '4', '2600000.00', '4', '2600000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1342, 1246, 1278, 81, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '4', '3', '1570000.00', '3', '2000000.00', '3', '2000000.00', '3', '2200000.00', '3', '2200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1343, 1247, 1279, 81, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '15', '15', '1680822871.00', '15', '1674223784.00', '15', '1674223784.00', '15', '1674223784.00', '15', '1674223784.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1344, 1248, 1280, 81, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '30', '12', '68440000.00', '12', '68700000.00', '12', '68700000.00', '12', '68700000.00', '12', '68700000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1345, 1249, 1281, 81, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', '4', '1', '1498000.00', '1', '1700000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1346, 1250, 1282, 81, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', '24', '12', '2960000.00', '12', '2800000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1347, 1251, 1283, 81, 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada
SKPD', 'Laporan', '', '', '0.00', '12', '6000000.00', '12', '7200000.00', '12', '7200000.00', '12', '7200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1348, 1252, 1284, 81, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '5', '1', '7945158.00', '1', '7000000.00', '3', '17200000.00', '1', '10000000.00', '2', '15200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1349, 1253, 1285, 81, 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '', '0.00', '12', '5000000.00', '12', '6000000.00', '12', '6000000.00', '12', '6000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1350, 1254, 1286, 81, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '15', '11', '3854405.00', '10', '3150000.00', '10', '3307500.00', '10', '3475000.00', '10', '3650000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1351, 1255, 1287, 81, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '', '10', '5811150.00', '10', '4200000.00', '10', '4800000.00', '10', '4800000.00', '10', '5200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1352, 1256, 1288, 81, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '66', '34', '18367614.00', '35', '21729441.00', '36', '22815913.00', '36', '24000000.00', '38', '25000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1353, 1257, 1289, 81, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '7', '5', '5411131.00', '5', '5250000.00', '5', '5512500.00', '5', '5788000.00', '5', '6077000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1354, 1258, 1290, 81, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', 'Dokumen', '', '', '0.00', '1', '3654000.00', '1', '3836700.00', '1', '4100000.00', '1', '4230000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1355, 1259, 1291, 81, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '', '12', '3130200.00', '12', '12600000.00', '12', '13230000.00', '12', '13800000.00', '12', '14586075.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1356, 1260, 1292, 81, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '48', '12', '115022000.00', '12', '75266100.00', '12', '79029405.00', '12', '82900000.00', '12', '87125000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1357, 1261, 1293, 81, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', '', '', '0.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', '1', '3500000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1358, 1262, 1294, 81, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan
yang Disediakan', 'Unit', '', '', '0.00', '3', '80000000.00', '2', '67000000.00', '', '0.00', '', '0.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1359, 1263, 1295, 81, 'Jumlah Paket Mebel yang
Disediakan', 'Unit', '2', '3', '66130248.00', '2', '36500000.00', '', '0.00', '3', '50000000.00', '3', '63000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1360, 1264, 1296, 81, 'Jumlah Unit Peralatan dan
Mesin Lainnya yang Disediakan', 'Unit', '', '13', '106998450.00', '2', '33000000.00', '3', '53500000.00', '3', '56000000.00', '2', '34500000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1361, 1265, 1297, 81, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', '', '5', '14672535.00', '1', '8200000.00', '1', '8439000.00', '1', '9100000.00', '1', '10200000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1362, 1266, 1298, 81, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '72', '12', '2500000.00', '12', '3150000.00', '12', '3300000.00', '12', '3500000.00', '12', '3700000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1363, 1267, 1299, 81, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '84', '12', '63827970.00', '12', '52184790.00', '12', '54794000.00', '12', '57533700.00', '12', '60410385.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1364, 1268, 1300, 81, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor
yang Disediakan', 'Laporan', '48', '12', '154431600.00', '12', '162100000.00', '12', '178715250.00', '12', '187651000.00', '12', '197033550.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1365, 1269, 1301, 81, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '44', '11', '86376426.00', '11', '96500000.00', '11', '100321155.00', '11', '102327500.00', '11', '104374130.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1366, 1270, 1302, 81, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '44', '11', '4450000.00', '11', '4131000.00', '11', '4213620.00', '11', '4297800.00', '11', '4383850.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1367, 1271, 1303, 81, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '', '', '0.00', '3', '12811200.00', '3', '13067424.00', '3', '13328700.00', '3', '13595300.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1368, 1272, 1304, 81, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '2', '4', '222576330.00', '1', '186000000.00', '', '0.00', '1', '189000000.00', '1', '198000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1369, 1273, 1305, 81, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '40', '14', '5737590.00', '14', '7600000.00', '14', '8908000.00', '14', '8900000.00', '14', '9000200.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1370, 1274, 1306, 81, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '41', '35', '13353233.00', '30', '8900000.00', '35', '14400000.00', '35', '14520000.00', '35', '15500200.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1371, 1275, 1307, 81, 'Jumlah Laporan Koordinasi/Sinergi Perencanaan dan Pelaksanaan Kegiatan Pemerintahan dengan Perangkat Daerah dan Instansi
Vertikal Terkait', 'Laporan', '', '', '0.00', '1', '5400000.00', '1', '5832000.00', '1', '6250000.00', '1', '6800000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1372, 1276, 1308, 81, 'Jumlah Dokumen Peningkatan Efektifitas Kegiatan Pemerintahan di Tingkat
Kecamatan', 'Dokumen', '', '', '0.00', '1', '3000000.00', '1', '4200000.00', '1', '4200000.00', '1', '4500000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1373, 1277, 1309, 81, 'Jumlah Laporan Fasilitasi Percepatan Pencapaian Standar Pelayanan Minimal di Wilayah
Kecamatan', 'Laporan', '', '', '0.00', '1', '5400000.00', '1', '5832000.00', '1', '5832000.00', '1', '5832000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1374, 1278, 1310, 81, 'Jumlah Laporan Peningkatan Efektifitas Pelaksanaan Pelayanan kepada Masyarakat di Wilayah Kecamatan', 'Laporan', '52', '15', '18144528.00', '15', '10800000.00', '15', '11664000.00', '15', '13063680.00', '15', '13168000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1375, 1279, 1311, 81, 'Jumlah Lembaga Kemasyarakatan yang Berpartisipasi dalam Forum Musyawarah Perencanaan Pembangunan di Desa', 'Lembaga Kemasyarakatan', '18', '5', '11050000.00', '5', '12155000.00', '5', '13370500.00', '5', '14707550.00', '5', '16178305.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1376, 1280, 1312, 81, 'Jumlah Laporan Peningkatan Efektivitas Kegiatan Pemberdayaan Masyarakat di
Wilayah Kecamatan', 'Laporan', '18', '8', '189339181.00', '8', '197000000.00', '8', '230000000.00', '8', '234732050.00', '8', '237468600.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1377, 1281, 1313, 81, 'Jumlah Laporan Fasilitasi Pengembangan Usaha Ekonomi Masyarakat', 'Laporan', '', '1', '5000000.00', '1', '5400000.00', '1', '6000000.00', '1', '6480000.00', '1', '7000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1378, 1282, 1314, 81, 'Jumlah Laporan Hasil Sinergitas dengan Kepolisian Negara Republik Indonesia, Tentara Nasional Indonesia dan Instansi Vertikal di Wilayah Kecamatan', 'Laporan', '8', '4', '10000000.00', '4', '15000000.00', '4', '18900000.00', '4', '19500000.00', '4', '70000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1379, 1283, 1315, 81, 'Jumlah Dokumen yang Difasilitasi dalam rangka Administrasi Tata Pemerintahan Desa', 'Dokumen', '', '7', '8200000.00', '7', '8000000.00', '7', '8000000.00', '7', '12000000.00', '7', '18000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1380, 1284, 1316, 81, 'Jumlah Dokumen yang Difasilitasi dalam rangka Pengelolaan Keuangan Desa dan Pendayagunaan Aset Desa', 'Dokumen', '28', '6', '13900000.00', '6', '15100000.00', '6', '22650000.00', '6', '33975000.00', '6', '50962500.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1381, 1285, 1317, 81, 'Jumlah Dokumen Fasilitasi dalam rangka Pelaksanaan Pemilihan Kepala Desa', 'Dokumen', '', '', '0.00', '7', '20000000.00', '', '0.00', '', '0.00', '1', '15000000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1382, 1286, 1318, 81, 'Jumlah Dokumen Fasilitasi dalam rangka Penyelenggaraan Ketenteraman dan Ketertiban
Umum', 'Dokumen', '32', '6', '8840000.00', '6', '10000000.00', '6', '15000000.00', '6', '22500000.00', '6', '33750000.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL),
  (1383, 1287, 1319, 81, 'Jumlah Laporan Hasil Koordinasi Pelaksanaan Pembangunan Kawasan Perdesaan di Wilayah
Kecamatan', 'Laporan', '32', '6', '13900000.00', '6', '15100000.00', '6', '22650000.00', '6', '33975000.00', '6', '50962500.00', 10, '2026-09-24 11:05:34', '2026-09-24 11:05:34', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
