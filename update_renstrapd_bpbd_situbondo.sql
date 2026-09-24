-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: BADAN PENANGGULANGAN BENCANA DAERAH (BPBD)
-- ID INSTANSI: 44 | KODE: 1.05.0.00.0.00.04.0000
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-23 16:27:26
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (BADAN PENANGGULANGAN BENCANA DAERAH SITUBONDO) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (44, '1.05.0.00.0.00.04.0000', '35.12', 'BADAN PENANGGULANGAN BENCANA DAERAH SITUBONDO', '1.05', NULL, NULL, '$2y$10$phYrPu9v8mSfEwaquzZNnu/5Z3m7Z/WHe3qTS5Pn7zU5NNowfjUPy', 4, 2025, 2029, '2026-09-08 16:45:17', '2026-09-22 18:50:55', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA BPBD SITUBONDO SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263, 264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282, 283, 284, 285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 318, 319);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263, 264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282, 283, 284, 285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 318, 319);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (36, 37);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (36, 37);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (36, 37);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (16, 17);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (16, 17);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (9);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (9);
DELETE FROM `renstra_tujuan` WHERE `id` IN (9) OR (`id_instansi` = 44 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD BPBD SITUBONDO
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (9, '35.12', 44, '44', 'Menurunnya Risiko Bencana', NULL, NULL, 'Indeks Risiko Bencana', 'Indeks', NULL, '145.48', '142.02', '138.72', '135.57', '132.55', '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (17, 9, 44, 'Indeks Risiko Bencana', 'Indeks', '151.65', NULL, '145.48', '142.02', '138.72', '135.57', '132.55', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (16, 9, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah Badan Penanggulangan Bencana Daerah', NULL, NULL, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '83.5', '84', '84.5', '85', '85.5', '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (17, 9, 'Meningkatnya Kapasitas Daerah dalam Penanggulangan Bencana', NULL, NULL, 'Indeks Ketahanan Daerah', 'Indeks', NULL, '0.71', '0.72', '0.73', '0.74', '0.75', '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (27, 16, 44, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '83.17', NULL, '83.5', '84', '84.5', '85', '85.5', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (28, 17, 44, 'Indeks Ketahanan Daerah', 'Indeks', '0.69', NULL, '0.71', '0.72', '0.73', '0.74', '0.75', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

-- Table: renstra_program (2 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (36, 16, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '1.05.01', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, NULL, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah Badan Penanggulangan Bencana Daerah', 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '83.5', '84', '84.5', '85', '85.5', NULL, '5730598456.00', '4696600000.00', '5572600000.00', '4702600000.00', '4702600000.00'),
  (37, 17, 'PROGRAM PENANGGULANGAN BENCANA', '1.05.03', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, NULL, 'Meningkatnya Kesiapsiagaan Masyarakat dalam Menghadapi Bencana', 'Nilai Indeks Kesiapsiagaan Masyarakat', '', NULL, '0.33', '0.34', '0.35', '0.36', '0.37', NULL, '2365139515.00', '2420000000.00', '2440000000.00', '2390000000.00', '2290000000.00');

-- Table: renstra_program_outcome (2 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (70, 36, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah Badan Penanggulangan Bencana Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (71, 37, 'Meningkatnya Kesiapsiagaan Masyarakat dalam Menghadapi Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

-- Table: renstra_program_indikator (2 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (148, 36, 70, 44, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '83.17', '83.5', '84', '84.5', '85', '85.5', '5730598456.00', '4696600000.00', '5572600000.00', '4702600000.00', '4702600000.00', '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 10),
  (149, 37, 71, 44, 'Nilai Indeks Kesiapsiagaan Masyarakat', '', '0.31', '0.33', '0.34', '0.35', '0.36', '0.37', '2365139515.00', '2420000000.00', '2440000000.00', '2390000000.00', '2290000000.00', '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (54, 36, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '1.05.01.2.01', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '28630000.00', '30000000.00', '30000000.00', '38000000.00', '38000000.00'),
  (55, 36, 'Administrasi Keuangan Perangkat Daerah', '1.05.01.2.02', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Administrasi Keuangan Perangkat Daerah', 'Jumlah Dokumen Koordinasi dan
Pelaksanaan Akuntansi SKPD', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '3576348516.00', '3641600000.00', '3641600000.00', '3641600000.00', '3641600000.00'),
  (56, 36, 'Administrasi Barang Milik Daerah pada Perangkat Daerah', '1.05.01.2.03', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Administrasi Barang Milik Daerah pada Perangkat Daerah', 'Jumlah Rencana Kebutuhan
Barang Milik Daerah SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (57, 36, 'Administrasi Kepegawaian Perangkat Daerah', '1.05.01.2.05', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Administrasi Kepegawaian Perangkat Daerah', 'Jumlah Pegawai Berdasarkan
Tugas dan Fungsi yang Mengikuti Pendidikan dan Pelatihan', 'Orang', NULL, '', '5', '5', '5', '5', NULL, '12568530.00', '82000000.00', '82000000.00', '82000000.00', '82000000.00'),
  (58, 36, 'Administrasi Umum Perangkat Daerah', '1.05.01.2.06', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Administrasi Umum Perangkat Daerah', 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '240632140.00', '303000000.00', '303000000.00', '303000000.00', '303000000.00'),
  (59, 36, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '1.05.01.2.07', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Jumlah Unit Kendaraan Dinas
Operasional atau Lapangan yang Disediakan', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '1004848285.00', '109000000.00', '755000000.00', '105000000.00', '105000000.00'),
  (60, 36, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '1.05.01.2.08', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 'Jumlah Laporan Penyediaan Jasa
Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '586960780.00', '106000000.00', '106000000.00', '118000000.00', '118000000.00'),
  (61, 36, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '1.05.01.2.09', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kegiatan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '20', '20', '20', '20', '20', NULL, '280610205.00', '410000000.00', '640000000.00', '400000000.00', '400000000.00'),
  (62, 37, 'Pelayanan Informasi Rawan Bencana Kabupaten/Kota', '1.05.03.2.01', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pelayanan Informasi Rawan Bencana Kabupaten/Kota', 'Jumlah dokumen Kajian Risiko Bencana (KRB) sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', NULL, '1', '', '1', '', '', NULL, '397500000.00', '200000000.00', '300000000.00', '200000000.00', '200000000.00'),
  (63, 37, 'Pelayanan Pencegahan dan Kesiapsiagaan Terhadap Bencana', '1.05.03.2.02', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pelayanan Pencegahan dan Kesiapsiagaan Terhadap Bencana', 'Jumlah laporan layanan pusat pengendalian operasi (pusdalops) dengan Maklumat Pelayanan yang sah dan legal sesuai dengan jenis ancaman bencana yang ada di kawasan tempat tinggalnya', 'laporan', NULL, '12', '12', '12', '12', '12', NULL, '1256688200.00', '1105000000.00', '1105000000.00', '1155000000.00', '1055000000.00'),
  (64, 37, 'Pelayanan Penyelamatan dan Evakuasi Korban Bencana', '1.05.03.2.03', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pelayanan Penyelamatan dan Evakuasi Korban Bencana', 'Jumlah dokumen rencana operasi yang sah/legal', '', NULL, '', '2', '2', '2', '2', NULL, '200879265.00', '490000000.00', '490000000.00', '490000000.00', '490000000.00'),
  (65, 37, 'Penataan Sistem Dasar Penanggulangan Bencana', '1.05.03.2.04', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Penataan Sistem Dasar Penanggulangan Bencana', 'Jumlah SDM aparatur
penanggulangan bencana yang memiliki kompetensi', 'Orang', NULL, '', '10', '10', '10', '10', NULL, '510072050.00', '625000000.00', '545000000.00', '545000000.00', '545000000.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (67, 54, 'Terlaksananya Kegiatan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (68, 55, 'Terlaksananya Kegiatan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (69, 56, 'Terlaksananya Administrasi Barang Milik Daerah pada Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (70, 57, 'Terlaksananya Kegiatan Administrasi Kepegawaian Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (71, 58, 'Terlaksananya Kegiatan Administrasi Umum Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (72, 59, 'Terlaksananya Kegiatan Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (73, 60, 'Terlaksananya Kegiatan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (74, 61, 'Terlaksananya Kegiatan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (75, 62, 'Terlaksananya Pelayanan Informasi Rawan Bencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (76, 63, 'Terlaksananya Pelayanan Pencegahan dan Kesiapsiagaan Terhadap Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (77, 64, 'Terlaksananya Pelayanan Penyelamatan dan Evakuasi Korban Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (78, 65, 'Terlaksananya Penataan Sistem Dasar Penanggulangan Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

-- Table: renstra_kegiatan_indikator (85 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (252, 54, 67, 44, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '28630000.00', '1', '30000000.00', '1', '30000000.00', '1', '38000000.00', '1', '38000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (253, 54, 67, 44, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (254, 54, 67, 44, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (255, 54, 67, 44, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (256, 54, 67, 44, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (257, 54, 67, 44, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan DPA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (258, 54, 67, 44, 'Jumlah Dokumen Perencanaan
Perangkat Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (259, 55, 68, 44, 'Jumlah Dokumen Koordinasi dan
Pelaksanaan Akuntansi SKPD', 'Dokumen', '', '', '3576348516.00', '12', '3641600000.00', '12', '3641600000.00', '12', '3641600000.00', '12', '3641600000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (260, 55, 68, 44, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '25', '28', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (261, 55, 68, 44, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (262, 55, 68, 44, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (263, 55, 68, 44, 'Jumlah Dokumen Penatausahaan
dan Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', '', '', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (264, 55, 68, 44, 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', '1', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (265, 55, 68, 44, 'Jumlah Dokumen Hasil Penyediaan
Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (266, 55, 68, 44, 'Jumlah Dokumen Pelaporan dan
Analisis Prognosis Realisasi Anggaran', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 80, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (267, 56, 69, 44, 'Jumlah Rencana Kebutuhan
Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '0.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (268, 56, 69, 44, 'Jumlah Laporan Rekonsiliasi dan
Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (269, 56, 69, 44, 'Jumlah Laporan Penatausahaan
Barang Milik Daerah pada SKPD', 'Laporan', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (270, 56, 69, 44, 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik
Daerah SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (271, 56, 69, 44, 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', '12', '1', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (272, 56, 69, 44, 'Jumlah Dokumen Pengamanan
Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (273, 56, 69, 44, 'Jumlah Dokumen Hasil
Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (274, 57, 70, 44, 'Jumlah Pegawai Berdasarkan
Tugas dan Fungsi yang Mengikuti Pendidikan dan Pelatihan', 'Orang', '', '', '12568530.00', '5', '82000000.00', '5', '82000000.00', '5', '82000000.00', '5', '82000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (275, 57, 70, 44, 'Jumlah Dokumen Monitoring,
Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (276, 57, 70, 44, 'Jumlah Dokumen Pendataan dan
Pengolahan Administrasi Kepegawaian', 'Dokumen', '1', '', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (277, 57, 70, 44, 'Jumlah Paket Pakaian Dinas
beserta Atribut Kelengkapan', 'Paket', '60', '65', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (278, 57, 70, 44, 'Jumlah Pegawai Pensiun yang Dipulangkan', 'Orang', '', '', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (279, 58, 71, 44, 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', '1', '1', '240632140.00', '1', '303000000.00', '1', '303000000.00', '1', '303000000.00', '1', '303000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (280, 58, 71, 44, 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan  yang
Disediakan', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (281, 58, 71, 44, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (282, 58, 71, 44, 'Jumlah Dokumen Penatausahaan
Arsip Dinamis pada SKPD', 'Dokumen', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (283, 58, 71, 44, 'Jumlah Laporan Fasilitasi
Kunjungan Tamu', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (284, 58, 71, 44, 'Jumlah Laporan Penyelenggaraan
Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (285, 58, 71, 44, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (286, 58, 71, 44, 'Jumlah Paket Komponen Instalasi
Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 80, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (287, 58, 71, 44, 'Jumlah Paket Peralatan dan
Perlengkapan Kantor yang Disediakan', 'Paket', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 90, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (288, 58, 71, 44, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (289, 59, 72, 44, 'Jumlah Unit Kendaraan Dinas
Operasional atau Lapangan yang Disediakan', 'Unit', '', '2', '1004848285.00', '2', '109000000.00', '2', '755000000.00', '2', '105000000.00', '2', '105000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (290, 59, 72, 44, 'Jumlah Unit Sarana dan Prasarana
Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (291, 59, 72, 44, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '4', '8', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (292, 59, 72, 44, 'Jumlah Unit Kendaraan Perorangan
Dinas atau Kendaraan Dinas Jabatan yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (293, 59, 72, 44, 'Jumlah Unit Gedung Kantor atau
Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (294, 59, 72, 44, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '10', '0.00', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (295, 60, 73, 44, 'Jumlah Laporan Penyediaan Jasa
Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '586960780.00', '12', '106000000.00', '12', '106000000.00', '12', '118000000.00', '12', '118000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (296, 60, 73, 44, 'Jumlah Laporan Penyediaan Jasa
Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (297, 60, 73, 44, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (298, 61, 74, 44, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '10', '20', '280610205.00', '20', '410000000.00', '20', '640000000.00', '20', '400000000.00', '20', '400000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (299, 61, 74, 44, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (300, 61, 74, 44, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', '15', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (301, 61, 74, 44, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', '13', '13', '0.00', '13', '0.00', '13', '0.00', '13', '0.00', '13', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (302, 61, 74, 44, 'Jumlah Gedung Kantor dan
Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (303, 61, 74, 44, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '10', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (304, 62, 75, 44, 'Jumlah dokumen Kajian Risiko Bencana (KRB) sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', '', '1', '397500000.00', '', '200000000.00', '1', '300000000.00', '', '200000000.00', '', '200000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (305, 62, 75, 44, 'Jumlah warga negara termasuk kelompok rentan di kawasan rawan bencana bencana Kabupaten/Kota yang memperoleh sosialisasi, komunikasi, informasi dan edukasi sesuai jenis ancaman bencana yang ada di kawasan tempat tinggalnya selama 1 (satu) tahun', 'Orang', '50', '120', '0.00', '200', '0.00', '200', '0.00', '200', '0.00', '200', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (306, 63, 76, 44, 'Jumlah laporan layanan pusat pengendalian operasi (pusdalops) dengan Maklumat Pelayanan yang sah dan legal sesuai dengan jenis ancaman bencana yang ada di kawasan tempat tinggalnya', 'laporan', '12', '12', '1256688200.00', '12', '1105000000.00', '12', '1105000000.00', '12', '1155000000.00', '12', '1055000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (307, 63, 76, 44, 'Jumlah Peralatan Penyelamatan Diri bagi Individu Warga Negara, Keluarga, maupun Petugas sesuai dengan jenis ancaman bencana di kawasan tempat tinggalnya', 'Unit', '', '30', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (308, 63, 76, 44, 'Jumlah personil Tim Reaksi Cepat Penanggulangan Bencana (TRC PB) Kabupaten/Kota yang berasal dari lintas sektor yang memiliki kompetensi untuk penanganan awal darurat bencana', 'Orang', '', '', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (309, 63, 76, 44, 'Jumlah warga negara termasuk kelompok rentan di kawasan rawan bencana Kabupaten/Kota yang mengikuti pelatihan pencegahan dan mitigasi bencana', 'Kawasan', '300', '100', '0.00', '350', '0.00', '350', '0.00', '350', '0.00', '350', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (310, 63, 76, 44, 'Jumlah warga negara yang mengikuti gladi kesiapsiagaan untuk menguji efektivitas SOP dan keberfungsian sarana prasarana dalam pengendalian operasi penanganan darurat bencana (per jenis ancaman) Kabupaten/Kota', 'Orang', '', '300', '0.00', '200', '0.00', '200', '0.00', '200', '0.00', '200', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (311, 63, 76, 44, 'Jumlah Keluarga yang Mengikuti
Pelatihan Keluarga Tanggap Bencana Alam', 'Keluarga', '', '', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (312, 63, 76, 44, 'Jumlah kegiatan penyelesaian akar masalah risiko bencana (per jenis ancaman bencana prioritas) Kabupaten/Kota yang tertangani', 'Kegiatan', '', '', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (313, 63, 76, 44, 'Jumlah kawasan rawan bencana (per jenis ancaman bencana) dan/atau kawasan-kawasan strategis Kabupaten/Kota yang memiliki mekanisme dan prosedur tetap kesiapsiagaan menghadapi bencana', 'Kawasan', '4', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 80, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (314, 63, 76, 44, 'Jumlah dokumen Rencana Penanggulangan Kedaruratan Bencana (RPKB) Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama dalam 1
(satu) tahun', 'Dokumen', '', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 90, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (315, 63, 76, 44, 'Jumlah dokumen Rencana Penanggulangan Bencana (RPB) Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', '1', '1', '0.00', '', '0.00', '', '0.00', '1', '0.00', '', '0.00', 100, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (316, 63, 76, 44, 'Jumlah Dokumen Rencana Kontijensi Kabupaten/Kota (per jenis ancaman bencana) sampai dengan dinyatakan sah/legal paling lama dalam 1 (satu) tahun', 'Dokumen', '', '3', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 110, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (317, 64, 77, 44, 'Jumlah dokumen rencana operasi yang sah/legal', '', '2', '', '200879265.00', '2', '490000000.00', '2', '490000000.00', '2', '490000000.00', '2', '490000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (318, 64, 77, 44, 'Jumlah dokumen SK Penetapan Status Darurat Bencana dan SKPDB yang Ditetapkan Paling Lama 1x24 Jam berdasarkan Hasil Dokumen Laporan Investigasi KLB dan Epidemiologi Terpadu', 'Dokumen', '1', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (319, 64, 77, 44, 'Jumlah Dokumen SK Penetapan Status Darurat Bencana dan SKPDB yang Ditetapkan Paling Lama 1x24 Jam berdasarkan Hasil Dokumen Laporan Kaji Cepat', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (320, 64, 77, 44, 'Jumlah Korban Bencana yang Mendapatkan Distribusi Logistik Penyelamatan dan Evakuasi
Korban Bencana', 'Orang', '500', '350', '0.00', '500', '0.00', '500', '0.00', '500', '0.00', '500', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (321, 64, 77, 44, 'Jumlah Korban yang Berhasil Ditemukan, Ditolong, dan Dievakuasi Per Jenis Kejadian
Bencana', 'Orang', '4000', '4000', '0.00', '4000', '0.00', '4000', '0.00', '4000', '0.00', '4000', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (322, 64, 77, 44, 'Jumlah Laporan Koordinasi Respon
Cepat Kejadian Luar Biasa Penyakit/Wabah Prioritas', 'Orang', '1', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (323, 64, 77, 44, 'Jumlah Laporan Pelaksanaan Aktivasi Sistem Komando Penanganan Darurat Bencana
Kanupaten/Kota', 'Orang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (324, 64, 77, 44, 'Jumlah Aparatur SDM BPBD Kabupaten/Kota dan lintas perangkat daerah yang memiliki kemampuan penanganan keadaan darurat dalam aspek manajerial dan
teknis', 'Orang', '10', '', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 80, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (325, 65, 78, 44, 'Jumlah SDM aparatur
penanggulangan bencana yang memiliki kompetensi', 'Orang', '', '', '510072050.00', '10', '625000000.00', '10', '545000000.00', '10', '545000000.00', '10', '545000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (326, 65, 78, 44, 'Jumlah data penduduk terpilah di daerah rawan bencana', 'Laporan', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (327, 65, 78, 44, 'Jumlah Dokumen Kerja Sama antar Lembaga dan Kemitraan dalam Penanggulangan Bencana', 'Dokumen', '2', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (328, 65, 78, 44, 'Jumlah Dokumen Regulasi Pendukung Penyelenggaraan Penanggulangan Bencana di
Daerah', 'Dokumen', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (329, 65, 78, 44, 'Jumlah keterlibatan kelompok masyarakat dan dunia usaha dalam penanganan pascabencana Kabupaten/Kota meliputi Lembaga non pemerintah antara lain : lembaga filantropi, lembaga swadaya masyarakat, organisasi kemasyarakatan, organisasi sosial, organisasi keagamaan, organisasi relawan, perguruan tinggi, media massa dan dunia usaha yang telah
terdaftar dan legal', 'Lembaga', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (330, 65, 78, 44, 'Jumlah Laporan Hasil Binwas
Penyelenggaraan Penanggulangan Bencana', 'Laporan', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (331, 65, 78, 44, 'Jumlah penyelesaian dokumen Maklumat Pelayanan sampai dengan dinyatakan sah/legal paling lama dalam 1 (satu) tahun', 'Dokumen', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (332, 65, 78, 44, 'Jumlah penyelesaian dokumen Pengkajian Kebutuhan Pascabencana dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P) Kab/Kota sampai dengan dinyatakan sah dan legal paling lama dalam 1 (satu)
tahun', 'Dokumen', '12', '12', '0.00', '13', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 80, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (333, 65, 78, 44, 'Jumlah penyelesaian dokumen Rencana Aksi Penerapan Standar Pelayanan Minimal (SPM) Sub Urusan Bencana Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama dalam 1
(satu) tahun', 'Dokumen', '', '', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 90, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (334, 65, 78, 44, 'Jumlah Data dan Informasi
Kebencanaan yang tersedia', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (335, 65, 78, 44, 'Jumlah Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang memiliki kemampuan teknis dalam menyusun dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P)', 'Orang', '35', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', 110, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (336, 65, 78, 44, 'Jumlah penyelesaian kegiatan pascabencana di semua sektor sesuai berdasarkan Rencana Rehabilitasi dan Rekontruksi Pascabencana (R3P) Kabupaten/Kota yang dilegalkan', 'Kegiatan', '5', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 120, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

-- Table: renstra_sub_kegiatan (85 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (235, 54, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '1.05.01.2.01.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '6450000.00', '6000000.00', '6000000.00', '8000000.00', '8000000.00'),
  (236, 54, 'Koordinasi dan Penyusunan Dokumen RKA-SKPD', '1.05.01.2.01.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '4640000.00', '3000000.00', '3000000.00', '4000000.00', '4000000.00'),
  (237, 54, 'Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '1.05.01.2.01.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '4640000.00', '3000000.00', '3000000.00', '4000000.00', '4000000.00'),
  (238, 54, 'Koordinasi dan Penyusunan DPA-SKPD', '1.05.01.2.01.0004', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '430000.00', '1000000.00', '1000000.00', '1000000.00', '1000000.00'),
  (239, 54, 'Koordinasi dan Penyusunan Perubahan DPA- SKPD', '1.05.01.2.01.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '430000.00', '1000000.00', '1000000.00', '1000000.00', '1000000.00'),
  (240, 54, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '1.05.01.2.01.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi
Kinerja SKPD', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '8600000.00', '10000000.00', '10000000.00', '12000000.00', '12000000.00'),
  (241, 54, 'Evaluasi Kinerja Perangkat Daerah', '1.05.01.2.01.0007', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '3440000.00', '6000000.00', '6000000.00', '8000000.00', '8000000.00'),
  (242, 55, 'Penyediaan Gaji dan Tunjangan ASN', '1.05.01.2.02.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '28', '60', '60', '60', '60', NULL, '3428688516.00', '3500000000.00', '3500000000.00', '3500000000.00', '3500000000.00'),
  (243, 55, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '1.05.01.2.02.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah Dokumen Hasil Penyediaan
Administrasi Pelaksanaan Tugas ASN', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '129000000.00', '117600000.00', '117600000.00', '117600000.00', '117600000.00'),
  (244, 55, 'Pelaksanaan Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', '1.05.01.2.02.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 'Jumlah Dokumen Penatausahaan
dan Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '0.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (245, 55, 'Koordinasi dan Pelaksanaan Akuntansi SKPD', '1.05.01.2.02.0004', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Koordinasi dan Pelaksanaan Akuntansi SKPD', 'Jumlah Dokumen Koordinasi dan
Pelaksanaan Akuntansi SKPD', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '0.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (246, 55, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '1.05.01.2.02.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5700000.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (247, 55, 'Pengelolaan dan Penyiapan Bahan Tanggapan Pemeriksaan', '1.05.01.2.02.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (248, 55, 'Koordinasi dan Penyusunan Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD', '1.05.01.2.02.0007', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '8400000.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (249, 55, 'Penyusunan Pelaporan dan Analisis Prognosis Realisasi Anggaran', '1.05.01.2.02.0008', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Jumlah Dokumen Pelaporan dan
Analisis Prognosis Realisasi Anggaran', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '4560000.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (250, 56, 'Penyusunan Perencanaan Kebutuhan Barang Milik Daerah SKPD', '1.05.01.2.03.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Rencana Kebutuhan Barang Milik Daerah SKPD', 'Jumlah Rencana Kebutuhan
Barang Milik Daerah SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (251, 56, 'Pengamanan Barang Milik Daerah SKPD', '1.05.01.2.03.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pengamanan Barang Milik Daerah SKPD', 'Jumlah Dokumen Pengamanan
Barang Milik Daerah SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (252, 56, 'Koordinasi dan Penilaian Barang Milik Daerah SKPD', '1.05.01.2.03.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik
Daerah SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (253, 56, 'Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', '1.05.01.2.03.0004', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', NULL, '1', '12', '12', '12', '12', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (254, 56, 'Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', '1.05.01.2.03.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Rekonsiliasi dan
Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (255, 56, 'Penatausahaan Barang Milik Daerah pada SKPD', '1.05.01.2.03.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Penatausahaan
Barang Milik Daerah pada SKPD', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (256, 56, 'Pemanfaatan Barang Milik Daerah SKPD', '1.05.01.2.03.0007', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pemanfaatan Barang Milik Daerah SKPD', 'Jumlah Dokumen Hasil
Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '0.00', '1500000.00', '1500000.00', '1500000.00', '1500000.00'),
  (257, 57, 'Pengadaan Pakaian Dinas beserta Atribut Kelengkapannya', '1.05.01.2.05.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 'Jumlah Paket Pakaian Dinas
beserta Atribut Kelengkapan', 'Orang', NULL, '65', '60', '60', '60', '60', NULL, '12568530.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (258, 57, 'Pendataan dan Pengolahan Administrasi Kepegawaian', '1.05.01.2.05.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 'Jumlah Dokumen Pendataan dan
Pengolahan Administrasi Kepegawaian', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (259, 57, 'Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', '1.05.01.2.05.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Jumlah Dokumen Monitoring,
Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', NULL, '', '12', '12', '12', '12', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (260, 57, 'Pemulangan Pegawai yang Pensiun', '1.05.01.2.05.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pemulangan Pegawai yang Pensiun', 'Jumlah Pegawai Pensiun yang Dipulangkan', 'Orang', NULL, '', '2', '2', '2', '2', NULL, '0.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (261, 57, 'Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', '1.05.01.2.05.0009', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 'Jumlah Pegawai Berdasarkan
Tugas dan Fungsi yang Mengikuti Pendidikan dan Pelatihan', 'Orang', NULL, '', '5', '5', '5', '5', NULL, '0.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (262, 58, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '1.05.01.2.06.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi
Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (263, 58, 'Penyediaan Peralatan dan Perlengkapan Kantor', '1.05.01.2.06.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan
Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '', '1', '1', '1', '1', NULL, '0.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (264, 58, 'Penyediaan Peralatan Rumah Tangga', '1.05.01.2.06.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '8000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (265, 58, 'Penyediaan Bahan Logistik Kantor', '1.05.01.2.06.0004', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik
Kantor yang Disediakan', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '30842940.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (266, 58, 'Penyediaan Barang Cetakan dan Penggandaan', '1.05.01.2.06.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '10000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (267, 58, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '1.05.01.2.06.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Bahan Bacaan dan Peraturan  Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan  yang
Disediakan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '2464200.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (268, 58, 'Fasilitasi Kunjungan Tamu', '1.05.01.2.06.0008', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Fasilitasi Kunjungan Tamu', 'Jumlah Laporan Fasilitasi
Kunjungan Tamu', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '6675000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (269, 58, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '1.05.01.2.06.0009', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan
Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '177650000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (270, 58, 'Penatausahaan Arsip Dinamis pada SKPD', '1.05.01.2.06.0010', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Penatausahaan Arsip Dinamis pada SKPD', 'Jumlah Dokumen Penatausahaan
Arsip Dinamis pada SKPD', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '3000000.00', '3000000.00', '3000000.00', '3000000.00'),
  (271, 58, 'Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', '1.05.01.2.06.0011', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '2000000.00', '2000000.00', '2000000.00', '2000000.00'),
  (272, 59, 'Pengadaan Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '1.05.01.2.07.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Unit Kendaraan Perorangan
Dinas atau Kendaraan Dinas Jabatan yang Disediakan', 'Unit', NULL, '', '', '1', '', '', NULL, '0.00', '0.00', '400000000.00', '0.00', '0.00'),
  (273, 59, 'Pengadaan Kendaraan Dinas Operasional atau Lapangan', '1.05.01.2.07.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Unit Kendaraan Dinas
Operasional atau Lapangan yang Disediakan', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '860000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (274, 59, 'Pengadaan Mebel', '1.05.01.2.07.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '10', '1', '', '', '', NULL, '80000000.00', '4000000.00', '0.00', '0.00', '0.00'),
  (275, 59, 'Pengadaan Peralatan dan Mesin Lainnya', '1.05.01.2.07.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', NULL, '8', '2', '2', '2', '2', NULL, '64848285.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (276, 59, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '1.05.01.2.07.0009', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau
Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '1', '', '', NULL, '0.00', '0.00', '250000000.00', '0.00', '0.00'),
  (277, 59, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '1.05.01.2.07.0010', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana
Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '1', '1', '1', '1', NULL, '0.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (278, 60, 'Penyediaan Jasa Surat Menyurat', '1.05.01.2.08.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '2000000.00', '2000000.00', '2000000.00', '2000000.00', '2000000.00'),
  (279, 60, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '1.05.01.2.08.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa
Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '78917180.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (280, 60, 'Penyediaan Jasa Pelayanan Umum Kantor', '1.05.01.2.08.0004', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa
Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '506043600.00', '24000000.00', '24000000.00', '36000000.00', '36000000.00'),
  (281, 61, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '1.05.01.2.09.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', NULL, '15', '15', '15', '15', '15', NULL, '90589200.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (282, 61, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '1.05.01.2.09.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', NULL, '13', '13', '13', '13', '13', NULL, '165000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (283, 61, 'Pemeliharaan Mebel', '1.05.01.2.09.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'Unit', NULL, '', '2', '2', '2', '2', NULL, '0.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (284, 61, 'Pemeliharaan Peralatan dan Mesin Lainnya', '1.05.01.2.09.0006', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', NULL, '20', '20', '20', '20', '20', NULL, '18238000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (285, 61, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '1.05.01.2.09.0009', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan
Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '', '1', '1', '1', '1', NULL, '0.00', '20000000.00', '250000000.00', '10000000.00', '10000000.00'),
  (286, 61, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '1.05.01.2.09.0010', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', NULL, '10', '10', '10', '10', '10', NULL, '6783005.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (287, 62, 'Sosialisasi, Komunikasi, Informasi dan Edukasi (KIE) Rawan Bencana Kabupaten/Kota (Per Jenis Ancaman Bencana)', '1.05.03.2.01.0007', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya sosialisasi, komunikasi, informasi dan edukasi (KIE) rawan bencana bagi warga negara termasuk kelompok rentan per jenis ancaman bencana sesuai jenis ancaman bencana yang ada di kawasan tempat tinggalnya', 'Jumlah warga negara termasuk kelompok rentan di kawasan rawan bencana bencana Kabupaten/Kota yang memperoleh sosialisasi, komunikasi, informasi dan edukasi sesuai jenis ancaman bencana yang ada di kawasan tempat tinggalnya selama 1 (satu) tahun', 'Orang', NULL, '120', '200', '200', '200', '200', NULL, '272500000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (288, 62, 'Penyusunan Kajian Risiko Bencana Kabupaten/Kota', '1.05.03.2.01.0008', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya dokumen Kajian Risiko Bencana (KRB) yang Sah dan Legal', 'Jumlah dokumen Kajian Risiko Bencana (KRB) sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', NULL, '1', '', '1', '', '', NULL, '125000000.00', '0.00', '100000000.00', '0.00', '0.00'),
  (289, 63, 'Pengelolaan Risiko Bencana Kabupaten/Kota', '1.05.03.2.02.0013', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terselenggaranya kegiatan untuk mengatasi akar masalah risiko bencana (per jenis ancaman bencana prioritas) berdasarkan hasil kajian risiko bencana di kawasan rawan bencana Kabupaten/Kota', 'Jumlah kegiatan penyelesaian akar masalah risiko bencana (per jenis ancaman bencana prioritas) Kabupaten/Kota yang tertangani', 'Kegiatan', NULL, '', '5', '5', '5', '5', NULL, '0.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (290, 63, 'Penyediaan Peralatan Perlindungan dan Kesiapsiagaan Terhadap Bencana kabupaten/kota', '1.05.03.2.02.0015', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya alat perlindungan diri (APD) bagi individu, keluarga dan petugas untuk kesiapsiagaan terhadap bencana Kabupaten/Kota', 'Jumlah Peralatan Penyelamatan Diri bagi Individu Warga Negara, Keluarga, maupun Petugas sesuai dengan jenis ancaman bencana di kawasan tempat tinggalnya', 'Unit', NULL, '30', '100', '100', '100', '100', NULL, '75000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (291, 63, 'Gladi Kesiapsiagaan Terhadap Bencana kabupaten/kota', '1.05.03.2.02.0018', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya uji SOP pengendalian operasi penanganan darurat bencana dan keberfungsian sarana prasarana kesiapsiagaan terhadap bencana Kabupaten/Kota yang diikuti oleh warga negara di kawasan rawan bencana', 'Jumlah warga negara yang mengikuti gladi kesiapsiagaan untuk menguji efektivitas SOP dan keberfungsian sarana prasarana dalam pengendalian operasi penanganan darurat bencana (per jenis ancaman) Kabupaten/Kota', 'Orang', NULL, '300', '200', '200', '200', '200', NULL, '57712000.00', '250000000.00', '250000000.00', '200000000.00', '200000000.00'),
  (292, 63, 'Pelatihan Keluarga Tanggap Bencana Alam', '1.05.03.2.02.0019', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pelatihan Keluarga Tanggap Bencana Alam', 'Jumlah Keluarga yang Mengikuti
Pelatihan Keluarga Tanggap Bencana Alam', 'Keluarga', NULL, '', '100', '100', '100', '100', NULL, '0.00', '70000000.00', '70000000.00', '70000000.00', '70000000.00'),
  (293, 63, 'Penguatan Kapasitas Kawasan untuk Pencegahan dan Kesiapsiagaan Bencana', '1.05.03.2.02.0020', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya penguatan kapasitas kawasan rawan bencana dan/atau kawasan-kawasan strategis Kabupaten/Kota untuk pencegahan dan kesiapsiagaan menghadapi bencana', 'Jumlah kawasan rawan bencana (per jenis ancaman bencana) dan/atau kawasan-kawasan strategis Kabupaten/Kota yang memiliki mekanisme dan prosedur tetap kesiapsiagaan menghadapi bencana', 'Kawasan', NULL, '', '1', '1', '1', '1', NULL, '0.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (294, 63, 'Pengembangan Kapasitas Tim Reaksi Cepat (TRC) Bencana Kabupaten/Kota', '1.05.03.2.02.0021', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Meningkatnya kompetensi personil Tim Reaksi Cepat Penanggulangan Bencana (TRC PB) Kabupaten/Kota yang berasal dari lintas sektor untuk penanganan awal darurat bencana', 'Jumlah personil Tim Reaksi Cepat Penanggulangan Bencana (TRC PB) Kabupaten/Kota yang berasal dari lintas sektor yang memiliki kompetensi untuk penanganan awal darurat bencana', 'Orang', NULL, '', '25', '25', '25', '25', NULL, '0.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (295, 63, 'Penyusunan Rencana Kontijensi Kabupaten/Kota', '1.05.03.2.02.0022', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya dokumen Rencana Kontinjensi Kabupaten/Kota (per jenis ancaman bencana) yang sah dan legal', 'Jumlah Dokumen Rencana Kontijensi Kabupaten/Kota (per jenis ancaman bencana) sampai dengan dinyatakan sah/legal paling lama dalam 1 (satu) tahun', 'Dokumen', NULL, '3', '2', '2', '2', '2', NULL, '225000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (296, 63, 'Penyusunan Rencana Penanggulangan Kedaruratan Bencana', '1.05.03.2.02.0023', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya dokumen Rencana Penanggulangan Kedaruratan Bencana (RPKB) Kabupaten/Kota yang sah dan legal', 'Jumlah dokumen Rencana Penanggulangan Kedaruratan Bencana (RPKB) Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama dalam 1
(satu) tahun', 'Dokumen', NULL, '1', '', '', '', '', NULL, '100000000.00', '0.00', '0.00', '0.00', '0.00'),
  (297, 63, 'Pengendalian Operasi dan Penyediaan Sarana Prasarana Kesiapsiagaan Terhadap Bencana Kabupaten/Kota', '1.05.03.2.02.0026', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya layanan pusat pengendalian operasi (pusdalops) dengan Maklumat Pelayanan yang sah dan legal serta dukungan penyediaan sarana prasarana kesiapsiagaan terhadap bencana', 'Jumlah laporan layanan pusat pengendalian operasi (pusdalops) dengan Maklumat Pelayanan yang sah dan legal sesuai dengan jenis ancaman bencana yang ada di kawasan tempat tinggalnya', 'laporan', NULL, '12', '12', '12', '12', '12', NULL, '688976200.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (298, 63, 'Penyusunan Rencana Penanggulangan Bencana Kabupaten/Kota', '1.05.03.2.02.0027', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Penanggulangan Bencana (RPB) Kabupaten/Kota yang sah dan legal', 'Jumlah dokumen Rencana Penanggulangan Bencana (RPB) Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', NULL, '1', '', '', '1', '', NULL, '50000000.00', '0.00', '0.00', '100000000.00', '0.00'),
  (299, 63, 'Pelatihan Pencegahan dan Mitigasi Bencana Kabupaten/Kota', '1.05.03.2.02.0028', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pelatihan Pencegahan dan Mitigasi untuk warga negara termasuk kelompok rentan di kawasan rawan bencana Kabupaten/Kota', 'Jumlah warga negara termasuk kelompok rentan di kawasan rawan bencana Kabupaten/Kota yang mengikuti pelatihan pencegahan
dan mitigasi bencana', 'Kawasan', NULL, '100', '350', '350', '350', '350', NULL, '60000000.00', '350000000.00', '350000000.00', '350000000.00', '350000000.00'),
  (300, 64, 'Respon Cepat Kejadian Luar Biasa Penyakit/Wabah Zoonosis Prioritas', '1.05.03.2.03.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Koordinasi Respon Cepat Kejadian Luar Biasa Penyakit/Wabah Prioritas', 'Jumlah Laporan Koordinasi Respon
Cepat Kejadian Luar Biasa Penyakit/Wabah Prioritas', 'Laporan', NULL, '', '1', '1', '1', '1', NULL, '0.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (301, 64, 'Respon Cepat Darurat Bencana Kabupaten/Kota', '1.05.03.2.03.0002', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Respon Cepat Darurat Bencana Penanganan Awal Untuk Penetapan Status Darurat Bencana Paling Lama 1 X 24 Jam', 'Jumlah Dokumen SK Penetapan Status Darurat Bencana dan SKPDB yang Ditetapkan Paling Lama 1x24 Jam berdasarkan Hasil Dokumen Laporan Kaji Cepat', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '5000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (302, 64, 'Pencarian, Pertolongan dan Evakuasi Korban Bencana Kabupaten/Kota', '1.05.03.2.03.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Upaya untuk Menemukan, Menolong, maupun Memindahkan Korban Bencana Dari Lokasi Bencana ke Tempat yang Aman', 'Jumlah Korban yang Berhasil Ditemukan, Ditolong, dan Dievakuasi Per Jenis Kejadian Bencana', '', NULL, '4000', '4000', '4000', '4000', '4000', NULL, '95000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (303, 64, 'Penyusunan Rencana Operasi Kedaruratan Bencana Kabupaten/Kota', '1.05.03.2.03.0007', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersusunnya dokumen rencana operasi kedaruratan bencana Kabupaten/Kota', 'Jumlah dokumen rencana operasi yang sah/legal', 'Dokumen', NULL, '', '2', '2', '2', '2', NULL, '0.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (304, 64, 'Peningkatan Kapasitas Sumber Daya Aparatur dalam penangananan keadaan darurat Kabupaten/Kota', '1.05.03.2.03.0008', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya SDM Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang kompeten dalam penanganan keadaan darurat Kabupaten/Kota', 'Jumlah Aparatur SDM BPBD Kabupaten/Kota dan lintas perangkat daerah yang memiliki kemampuan penanganan keadaan darurat dalam aspek manajerial dan
teknis', 'Orang', NULL, '', '10', '10', '10', '10', NULL, '0.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (305, 64, 'Penyediaan Logistik Penyelamatan dan Evakuasi Korban Bencana Kabupaten/Kota', '1.05.03.2.03.0009', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terdistribusinya Logistik Penyelamatan dan Evakuasi Korban Bencana', 'Jumlah Korban Bencana yang Mendapatkan Distribusi Logistik Penyelamatan dan Evakuasi
Korban Bencana', 'Orang', NULL, '350', '500', '500', '500', '500', NULL, '85879265.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (306, 64, 'Respon Cepat Bencana Non Alam Epidemi/Wabah Penyakit', '1.05.03.2.03.0010', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Respon Cepat Bencana Non Alam Epidemi/ Wabah dalam Penanganan Awal untuk KLB yang Ditingkatkan Statusnya Menjadi Darurat Bencana Non Alam Paling Lama 1x24 Jam', 'Jumlah dokumen SK Penetapan Status Darurat Bencana dan SKPDB yang Ditetapkan Paling Lama 1x24 Jam berdasarkan Hasil Dokumen Laporan Investigasi KLB dan Epidemiologi Terpadu', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (307, 64, 'Aktivasi Sistem Komando Penanganan Darurat Bencana', '1.05.03.2.03.0012', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pengerahan dan Pengorganisasian Komando Penanganan Darurat Bencana Tingkat Kabupaten/Kota', 'Jumlah Laporan Pelaksanaan Aktivasi Sistem Komando Penanganan Darurat Bencana
Kanupaten/Kota', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (308, 65, 'Penyusunan Regulasi Penanggulangan Bencana Kabupaten/Kota', '1.05.03.2.04.0001', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Regulasi Pendukung Penyelenggaraan Penanggulangan Bencana di Daerah', 'Jumlah Dokumen Regulasi Pendukung Penyelenggaraan Penanggulangan Bencana di
Daerah', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (309, 65, 'Kerja Sama antar Lembaga dan Kemitraan dalam Penanggulangan Bencana Kabupaten/Kota', '1.05.03.2.04.0003', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Kerja Sama antar Lembaga dan Kemitraan dalam Penanggulangan Bencana', 'Jumlah Dokumen Kerja Sama antar Lembaga dan Kemitraan dalam Penanggulangan Bencana', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (310, 65, 'Pengelolaan dan Pemanfaatan Sistem Informasi Kebencanaan', '1.05.03.2.04.0004', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Data dan Informasi Kebencanaan', 'Jumlah Data dan Informasi
Kebencanaan yang tersedia', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '32847715.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (311, 65, 'Pembinaan dan Pengawasan Penyelenggaraan Penanggulangan Bencana', '1.05.03.2.04.0005', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya Pembinaan dan Pengawasan Penyelenggaraan Penanggulangan Bencana', 'Jumlah Laporan Hasil Binwas
Penyelenggaraan Penanggulangan Bencana', 'Laporan', NULL, '', '1', '1', '1', '1', NULL, '0.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (312, 65, 'Peningkatan Kapasitas SDM Aparatur Penanggulangan Bencana Kabupaten/Kota', '1.05.03.2.04.0007', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Meningkatnya kompetensi teknis dan manajerial SDM aparatur penanggulangan bencana pada setiap tahapan (Pra bencana, tanggap darurat dan pasca bencana)', 'Jumlah SDM aparatur penanggulangan bencana yang memiliki kompetensi', 'Orang', NULL, '', '10', '10', '10', '10', NULL, '0.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (313, 65, 'Bimbingan Teknis Pasca Bencana Kabupaten/Kota', '1.05.03.2.04.0008', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang memiliki kemampuan teknnis dalam menyusun dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Dokumen Rencana Rehabilitasi dan Rekontruksi Pascabencana (R3P)', 'Jumlah Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang memiliki kemampuan teknis dalam menyusun dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P)', 'Orang', NULL, '30', '30', '30', '30', '30', NULL, '50000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (314, 65, 'Koordinasi penanganan Pascabencana Kabupaten/Kota', '1.05.03.2.04.0010', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Terlaksananya koordinasi lintas perangkat daerah pada tahap perencanaan, pengalokasian sumber daya dan ketersediaan APBD, non APBD dan sumber pendanaan lainnya berdasarkan R3P melalui pelaksanaan, pemantauan, evaluasi dan pelaporan lintas perangkat daerah dalam penanganan pascabencana Kabupaten/Kota', 'Jumlah penyelesaian kegiatan pascabencana di semua sektor sesuai berdasarkan Rencana Rehabilitasi dan Rekontruksi Pascabencana (R3P) Kabupaten/Kota yang dilegalkan', 'Kegiatan', NULL, '5', '5', '5', '5', '5', NULL, '327224335.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (315, 65, 'Peningkatan partisipasi masyarakat dan dunia usaha dalam penanganan Pascabencana Kabupaten/Kota', '1.05.03.2.04.0011', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Meningkatnya partisipasi masyarakat dan dunia usaha dalam penanganan pascabencana Kabupaten/Kota', 'Jumlah keterlibatan kelompok masyarakat dan dunia usaha dalam penanganan pascabencana Kabupaten/Kota meliputi Lembaga non pemerintah antara lain : lembaga filantropi, lembaga swadaya masyarakat, organisasi kemasyarakatan, organisasi sosial, organisasi keagamaan, organisasi relawan, perguruan tinggi, media massa dan dunia usaha yang telah
terdaftar dan legal', 'Lembaga', NULL, '', '1', '1', '1', '1', NULL, '0.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (316, 65, 'Fasilitasi pengumpulan data penduduk di daerah rawan bencana lintas Kab/Kota', '1.05.03.2.04.0012', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya data penduduk terpilah di daerah rawan bencana', 'Jumlah data penduduk terpilah di daerah rawan bencana', 'Laporan', NULL, '', '1', '1', '1', '1', NULL, '0.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (317, 65, 'Penguatan Kelembagaan Bencana Kabupaten/Kota', '1.05.03.2.04.0014', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya dokumen Maklumat Pelayanan Penanggulangan Bencana yang sah dan legal', 'Jumlah penyelesaian dokumen Maklumat Pelayanan sampai dengan dinyatakan sah/legal paling lama dalam 1 (satu) tahun', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (318, 65, 'Penyusunan Kajian Kebutuhan Pascabencana (JITUPASNA) dan Rencana Rehabilitasi dan Rekontruksi Pascabencana (R3P) Kab/Kota', '1.05.03.2.04.0015', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P) Kab/Kota yang sah dan legal', 'Jumlah penyelesaian dokumen Pengkajian Kebutuhan Pascabencana dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P) Kab/Kota sampai dengan dinyatakan sah dan legal paling lama dalam 1 (satu)
tahun', 'Dokumen', NULL, '12', '13', '12', '12', '12', NULL, '100000000.00', '100000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (319, 65, 'Penyusunan Rencana Aksi Penerapan Standar Pelayanan Minimal (SPM) Sub Urusan Bencana Kabupaten/Kota', '1.05.03.2.04.0016', NULL, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL, 'Tersedianya dokumen Rencana Aksi Penerapan Standar Pelayanan Minimal (SPM) Sub Urusan Bencana Kabupaten/Kota', 'Jumlah penyelesaian dokumen Rencana Aksi Penerapan Standar Pelayanan Minimal (SPM) Sub Urusan Bencana Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama dalam 1
(satu) tahun', 'Dokumen', NULL, '', '1', '1', '1', '1', NULL, '0.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00');

-- Table: renstra_sub_kegiatan_sasaran (85 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (238, 235, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (239, 236, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (240, 237, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (241, 238, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (242, 239, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (243, 240, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (244, 241, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (245, 242, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (246, 243, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (247, 244, 'Terlaksananya Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (248, 245, 'Terlaksananya Koordinasi dan Pelaksanaan Akuntansi SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (249, 246, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (250, 247, 'Tersedianya Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (251, 248, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (252, 249, 'Tersedianya Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (253, 250, 'Tersedianya Rencana Kebutuhan Barang Milik Daerah SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (254, 251, 'Terlaksananya Pengamanan Barang Milik Daerah SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (255, 252, 'Tersedianya Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (256, 253, 'Terlaksananya Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (257, 254, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (258, 255, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (259, 256, 'Terlaksananya Pemanfaatan Barang Milik Daerah SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (260, 257, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (261, 258, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (262, 259, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (263, 260, 'Terlaksananya Pemulangan Pegawai yang Pensiun', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (264, 261, 'Terlaksananya Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (265, 262, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (266, 263, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (267, 264, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (268, 265, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (269, 266, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (270, 267, 'Tersedianya Bahan Bacaan dan Peraturan  Perundang-undangan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (271, 268, 'Terlaksananya Fasilitasi Kunjungan Tamu', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (272, 269, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (273, 270, 'Terlaksananya Penatausahaan Arsip Dinamis pada SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (274, 271, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (275, 272, 'Tersedianya Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (276, 273, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (277, 274, 'Tersedianya Mebel', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (278, 275, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (279, 276, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (280, 277, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (281, 278, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (282, 279, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (283, 280, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (284, 281, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (285, 282, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (286, 283, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (287, 284, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (288, 285, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (289, 286, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (290, 287, 'Terlaksananya sosialisasi, komunikasi, informasi dan edukasi (KIE) rawan bencana bagi warga negara termasuk kelompok rentan per jenis ancaman bencana sesuai jenis ancaman bencana yang ada di kawasan tempat tinggalnya', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (291, 288, 'Tersedianya dokumen Kajian Risiko Bencana (KRB) yang Sah dan Legal', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (292, 289, 'Terselenggaranya kegiatan untuk mengatasi akar masalah risiko bencana (per jenis ancaman bencana prioritas) berdasarkan hasil kajian risiko bencana di kawasan rawan bencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (293, 290, 'Tersedianya alat perlindungan diri (APD) bagi individu, keluarga dan petugas untuk kesiapsiagaan terhadap bencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (294, 291, 'Terlaksananya uji SOP pengendalian operasi penanganan darurat bencana dan keberfungsian sarana prasarana kesiapsiagaan terhadap bencana Kabupaten/Kota yang diikuti oleh warga negara di kawasan rawan bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (295, 292, 'Terlaksananya Pelatihan Keluarga Tanggap Bencana Alam', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (296, 293, 'Terlaksananya penguatan kapasitas kawasan rawan bencana dan/atau kawasan-kawasan strategis Kabupaten/Kota untuk pencegahan dan kesiapsiagaan menghadapi bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (297, 294, 'Meningkatnya kompetensi personil Tim Reaksi Cepat Penanggulangan Bencana (TRC PB) Kabupaten/Kota yang berasal dari lintas sektor untuk penanganan awal darurat bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (298, 295, 'Tersedianya dokumen Rencana Kontinjensi Kabupaten/Kota (per jenis ancaman bencana) yang sah dan legal', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (299, 296, 'Tersedianya dokumen Rencana Penanggulangan Kedaruratan Bencana (RPKB) Kabupaten/Kota yang sah dan legal', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (300, 297, 'Tersedianya layanan pusat pengendalian operasi (pusdalops) dengan Maklumat Pelayanan yang sah dan legal serta dukungan penyediaan sarana prasarana kesiapsiagaan terhadap bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (301, 298, 'Penanggulangan Bencana (RPB) Kabupaten/Kota yang sah dan legal', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (302, 299, 'Terlaksananya Pelatihan Pencegahan dan Mitigasi untuk warga negara termasuk kelompok rentan di kawasan rawan bencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (303, 300, 'Terlaksananya Koordinasi Respon Cepat Kejadian Luar Biasa Penyakit/Wabah Prioritas', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (304, 301, 'Terlaksananya Respon Cepat Darurat Bencana Penanganan Awal Untuk Penetapan Status Darurat Bencana Paling Lama 1 X 24 Jam', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (305, 302, 'Terlaksananya Upaya untuk Menemukan, Menolong, maupun Memindahkan Korban Bencana Dari Lokasi Bencana ke Tempat yang Aman', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (306, 303, 'Tersusunnya dokumen rencana operasi kedaruratan bencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (307, 304, 'Tersedianya SDM Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang kompeten dalam penanganan keadaan darurat Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (308, 305, 'Terdistribusinya Logistik Penyelamatan dan Evakuasi Korban Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (309, 306, 'Terlaksananya Respon Cepat Bencana Non Alam Epidemi/ Wabah dalam Penanganan Awal untuk KLB yang Ditingkatkan Statusnya Menjadi Darurat Bencana Non Alam Paling Lama 1x24 Jam', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (310, 307, 'Terlaksananya Pengerahan dan Pengorganisasian Komando Penanganan Darurat Bencana Tingkat Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (311, 308, 'Tersedianya Regulasi Pendukung Penyelenggaraan Penanggulangan Bencana di Daerah', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (312, 309, 'Terlaksananya Kerja Sama antar Lembaga dan Kemitraan dalam Penanggulangan Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (313, 310, 'Tersedianya Data dan Informasi Kebencanaan', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (314, 311, 'Terlaksananya Pembinaan dan Pengawasan Penyelenggaraan Penanggulangan Bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (315, 312, 'Meningkatnya kompetensi teknis dan manajerial SDM aparatur penanggulangan bencana pada setiap tahapan (Pra bencana, tanggap darurat dan pasca bencana)', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (316, 313, 'Tersedianya Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang memiliki kemampuan teknnis dalam menyusun dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Dokumen Rencana Rehabilitasi dan Rekontruksi Pascabencana (R3P)', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (317, 314, 'Terlaksananya koordinasi lintas perangkat daerah pada tahap perencanaan, pengalokasian sumber daya dan ketersediaan APBD, non APBD dan sumber pendanaan lainnya berdasarkan R3P melalui pelaksanaan, pemantauan, evaluasi dan pelaporan lintas perangkat daerah dalam penanganan pascabencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (318, 315, 'Meningkatnya partisipasi masyarakat dan dunia usaha dalam penanganan pascabencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (319, 316, 'Tersedianya data penduduk terpilah di daerah rawan bencana', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (320, 317, 'Tersedianya dokumen Maklumat Pelayanan Penanggulangan Bencana yang sah dan legal', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (321, 318, 'Tersedianya dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P) Kab/Kota yang sah dan legal', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (322, 319, 'Tersedianya dokumen Rencana Aksi Penerapan Standar Pelayanan Minimal (SPM) Sub Urusan Bencana Kabupaten/Kota', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

-- Table: renstra_sub_kegiatan_indikator (85 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (238, 235, 238, 44, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '2', '2', '6450000.00', '2', '6000000.00', '2', '6000000.00', '2', '8000000.00', '2', '8000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (239, 236, 239, 44, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '4640000.00', '1', '3000000.00', '1', '3000000.00', '1', '4000000.00', '1', '4000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (240, 237, 240, 44, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan RKA-SKPD', 'Dokumen', '1', '1', '4640000.00', '1', '3000000.00', '1', '3000000.00', '1', '4000000.00', '1', '4000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (241, 238, 241, 44, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '430000.00', '1', '1000000.00', '1', '1000000.00', '1', '1000000.00', '1', '1000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (242, 239, 242, 44, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen
Perubahan DPA-SKPD', 'Dokumen', '1', '1', '430000.00', '1', '1000000.00', '1', '1000000.00', '1', '1000000.00', '1', '1000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (243, 240, 243, 44, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi
Kinerja SKPD', 'Laporan', '4', '4', '8600000.00', '4', '10000000.00', '4', '10000000.00', '4', '12000000.00', '4', '12000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (244, 241, 244, 44, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '4', '4', '3440000.00', '4', '6000000.00', '4', '6000000.00', '4', '8000000.00', '4', '8000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (245, 242, 245, 44, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '25', '28', '3428688516.00', '60', '3500000000.00', '60', '3500000000.00', '60', '3500000000.00', '60', '3500000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (246, 243, 246, 44, 'Jumlah Dokumen Hasil Penyediaan
Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '12', '12', '129000000.00', '12', '117600000.00', '12', '117600000.00', '12', '117600000.00', '12', '117600000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (247, 244, 247, 44, 'Jumlah Dokumen Penatausahaan
dan Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', '', '', '0.00', '12', '6000000.00', '12', '6000000.00', '12', '6000000.00', '12', '6000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (248, 245, 248, 44, 'Jumlah Dokumen Koordinasi dan
Pelaksanaan Akuntansi SKPD', 'Dokumen', '', '', '0.00', '12', '6000000.00', '12', '6000000.00', '12', '6000000.00', '12', '6000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (249, 246, 249, 44, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', '1', '1', '5700000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (250, 247, 250, 44, 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', '1', '', '0.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (251, 248, 251, 44, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semesteran
SKPD', 'Laporan', '12', '12', '8400000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (252, 249, 252, 44, 'Jumlah Dokumen Pelaporan dan
Analisis Prognosis Realisasi Anggaran', 'Dokumen', '1', '1', '4560000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (253, 250, 253, 44, 'Jumlah Rencana Kebutuhan
Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '0.00', '1', '1500000.00', '1', '1500000.00', '1', '1500000.00', '1', '1500000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (254, 251, 254, 44, 'Jumlah Dokumen Pengamanan
Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '0.00', '1', '1500000.00', '1', '1500000.00', '1', '1500000.00', '1', '1500000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (255, 252, 255, 44, 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik
Daerah SKPD', 'Laporan', '1', '1', '0.00', '1', '1500000.00', '1', '1500000.00', '1', '1500000.00', '1', '1500000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (256, 253, 256, 44, 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', '12', '1', '0.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (257, 254, 257, 44, 'Jumlah Laporan Rekonsiliasi dan
Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Laporan', '12', '12', '0.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (258, 255, 258, 44, 'Jumlah Laporan Penatausahaan
Barang Milik Daerah pada SKPD', 'Laporan', '2', '2', '0.00', '2', '3000000.00', '2', '3000000.00', '2', '3000000.00', '2', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (259, 256, 259, 44, 'Jumlah Dokumen Hasil
Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', '12', '12', '0.00', '12', '1500000.00', '12', '1500000.00', '12', '1500000.00', '12', '1500000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (260, 257, 260, 44, 'Jumlah Paket Pakaian Dinas
beserta Atribut Kelengkapan', 'Orang', '60', '65', '12568530.00', '60', '50000000.00', '60', '50000000.00', '60', '50000000.00', '60', '50000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (261, 258, 261, 44, 'Jumlah Dokumen Pendataan dan
Pengolahan Administrasi Kepegawaian', 'Dokumen', '1', '', '0.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (262, 259, 262, 44, 'Jumlah Dokumen Monitoring,
Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '', '0.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', '12', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (263, 260, 263, 44, 'Jumlah Pegawai Pensiun yang Dipulangkan', 'Orang', '', '', '0.00', '2', '6000000.00', '2', '6000000.00', '2', '6000000.00', '2', '6000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (264, 261, 264, 44, 'Jumlah Pegawai Berdasarkan
Tugas dan Fungsi yang Mengikuti Pendidikan dan Pelatihan', 'Orang', '', '', '0.00', '5', '20000000.00', '5', '20000000.00', '5', '20000000.00', '5', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (265, 262, 265, 44, 'Jumlah Paket Komponen Instalasi
Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '1', '1', '5000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (266, 263, 266, 44, 'Jumlah Paket Peralatan dan
Perlengkapan Kantor yang Disediakan', 'Paket', '', '', '0.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (267, 264, 267, 44, 'Jumlah Paket Peralatan Rumah Tangga yang Disediakan', 'Paket', '1', '1', '8000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (268, 265, 268, 44, 'Jumlah Paket Bahan Logistik
Kantor yang Disediakan', 'Paket', '3', '3', '30842940.00', '3', '30000000.00', '3', '30000000.00', '3', '30000000.00', '3', '30000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (269, 266, 269, 44, 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', '1', '1', '10000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (270, 267, 270, 44, 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan  yang
Disediakan', 'Dokumen', '1', '1', '2464200.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (271, 268, 271, 44, 'Jumlah Laporan Fasilitasi
Kunjungan Tamu', 'Laporan', '12', '12', '6675000.00', '12', '10000000.00', '12', '10000000.00', '12', '10000000.00', '12', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (272, 269, 272, 44, 'Jumlah Laporan Penyelenggaraan
Rapat Koordinasi dan Konsultasi SKPD', 'Laporan', '12', '12', '177650000.00', '12', '200000000.00', '12', '200000000.00', '12', '200000000.00', '12', '200000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (273, 270, 273, 44, 'Jumlah Dokumen Penatausahaan
Arsip Dinamis pada SKPD', 'Dokumen', '', '', '0.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', '1', '3000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (274, 271, 274, 44, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', '', '', '0.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', '1', '2000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (275, 272, 275, 44, 'Jumlah Unit Kendaraan Perorangan
Dinas atau Kendaraan Dinas Jabatan yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '1', '400000000.00', '', '0.00', '', '0.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (276, 273, 276, 44, 'Jumlah Unit Kendaraan Dinas
Operasional atau Lapangan yang Disediakan', 'Unit', '', '2', '860000000.00', '2', '80000000.00', '2', '80000000.00', '2', '80000000.00', '2', '80000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (277, 274, 277, 44, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '10', '80000000.00', '1', '4000000.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (278, 275, 278, 44, 'Jumlah Unit Peralatan dan Mesin Lainnya yang Disediakan', 'Unit', '4', '8', '64848285.00', '2', '20000000.00', '2', '20000000.00', '2', '20000000.00', '2', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (279, 276, 279, 44, 'Jumlah Unit Gedung Kantor atau
Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '1', '250000000.00', '', '0.00', '', '0.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (280, 277, 280, 44, 'Jumlah Unit Sarana dan Prasarana
Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (281, 278, 281, 44, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '12', '12', '2000000.00', '12', '2000000.00', '12', '2000000.00', '12', '2000000.00', '12', '2000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (282, 279, 282, 44, 'Jumlah Laporan Penyediaan Jasa
Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '78917180.00', '12', '80000000.00', '12', '80000000.00', '12', '80000000.00', '12', '80000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (283, 280, 283, 44, 'Jumlah Laporan Penyediaan Jasa
Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '506043600.00', '12', '24000000.00', '12', '24000000.00', '12', '36000000.00', '12', '36000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (284, 281, 284, 44, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', '15', '15', '90589200.00', '15', '150000000.00', '15', '150000000.00', '15', '150000000.00', '15', '150000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (285, 282, 285, 44, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', '13', '13', '165000000.00', '13', '200000000.00', '13', '200000000.00', '13', '200000000.00', '13', '200000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (286, 283, 286, 44, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '', '0.00', '2', '5000000.00', '2', '5000000.00', '2', '5000000.00', '2', '5000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (287, 284, 287, 44, 'Jumlah Peralatan dan Mesin Lainnya yang Dipelihara', 'Unit', '10', '20', '18238000.00', '20', '20000000.00', '20', '20000000.00', '20', '20000000.00', '20', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (288, 285, 288, 44, 'Jumlah Gedung Kantor dan
Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '', '0.00', '1', '20000000.00', '1', '250000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (289, 286, 289, 44, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '10', '10', '6783005.00', '10', '15000000.00', '10', '15000000.00', '10', '15000000.00', '10', '15000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (290, 287, 290, 44, 'Jumlah warga negara termasuk kelompok rentan di kawasan rawan bencana bencana Kabupaten/Kota yang memperoleh sosialisasi, komunikasi, informasi dan edukasi sesuai jenis ancaman bencana yang ada di kawasan tempat tinggalnya selama 1 (satu) tahun', 'Orang', '50', '120', '272500000.00', '200', '200000000.00', '200', '200000000.00', '200', '200000000.00', '200', '200000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (291, 288, 291, 44, 'Jumlah dokumen Kajian Risiko Bencana (KRB) sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', '', '1', '125000000.00', '', '0.00', '1', '100000000.00', '', '0.00', '', '0.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (292, 289, 292, 44, 'Jumlah kegiatan penyelesaian akar masalah risiko bencana (per jenis ancaman bencana prioritas) Kabupaten/Kota yang tertangani', 'Kegiatan', '', '', '0.00', '5', '20000000.00', '5', '20000000.00', '5', '20000000.00', '5', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (293, 290, 293, 44, 'Jumlah Peralatan Penyelamatan Diri bagi Individu Warga Negara, Keluarga, maupun Petugas sesuai dengan jenis ancaman bencana di kawasan tempat tinggalnya', 'Unit', '', '30', '75000000.00', '100', '100000000.00', '100', '100000000.00', '100', '100000000.00', '100', '100000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (294, 291, 294, 44, 'Jumlah warga negara yang mengikuti gladi kesiapsiagaan untuk menguji efektivitas SOP dan keberfungsian sarana prasarana dalam pengendalian operasi penanganan darurat bencana (per jenis ancaman) Kabupaten/Kota', 'Orang', '', '300', '57712000.00', '200', '250000000.00', '200', '250000000.00', '200', '200000000.00', '200', '200000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (295, 292, 295, 44, 'Jumlah Keluarga yang Mengikuti
Pelatihan Keluarga Tanggap Bencana Alam', 'Keluarga', '', '', '0.00', '100', '70000000.00', '100', '70000000.00', '100', '70000000.00', '100', '70000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (296, 293, 296, 44, 'Jumlah kawasan rawan bencana (per jenis ancaman bencana) dan/atau kawasan-kawasan strategis Kabupaten/Kota yang memiliki mekanisme dan prosedur tetap kesiapsiagaan menghadapi bencana', 'Kawasan', '4', '', '0.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (297, 294, 297, 44, 'Jumlah personil Tim Reaksi Cepat Penanggulangan Bencana (TRC PB) Kabupaten/Kota yang berasal dari lintas sektor yang memiliki kompetensi untuk penanganan awal darurat bencana', 'Orang', '', '', '0.00', '25', '75000000.00', '25', '75000000.00', '25', '75000000.00', '25', '75000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (298, 295, 298, 44, 'Jumlah Dokumen Rencana Kontijensi Kabupaten/Kota (per jenis ancaman bencana) sampai dengan dinyatakan sah/legal paling lama dalam 1 (satu) tahun', 'Dokumen', '', '3', '225000000.00', '2', '150000000.00', '2', '150000000.00', '2', '150000000.00', '2', '150000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (299, 296, 299, 44, 'Jumlah dokumen Rencana Penanggulangan Kedaruratan Bencana (RPKB) Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama dalam 1
(satu) tahun', 'Dokumen', '', '1', '100000000.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (300, 297, 300, 44, 'Jumlah laporan layanan pusat pengendalian operasi (pusdalops) dengan Maklumat Pelayanan yang sah dan legal sesuai dengan jenis ancaman bencana yang ada di kawasan tempat tinggalnya', 'laporan', '12', '12', '688976200.00', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (301, 298, 301, 44, 'Jumlah dokumen Rencana Penanggulangan Bencana (RPB) Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama
dalam 1 (satu) tahun', 'Dokumen', '1', '1', '50000000.00', '', '0.00', '', '0.00', '1', '100000000.00', '', '0.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (302, 299, 302, 44, 'Jumlah warga negara termasuk kelompok rentan di kawasan rawan bencana Kabupaten/Kota yang mengikuti pelatihan pencegahan
dan mitigasi bencana', 'Kawasan', '300', '100', '60000000.00', '350', '350000000.00', '350', '350000000.00', '350', '350000000.00', '350', '350000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (303, 300, 303, 44, 'Jumlah Laporan Koordinasi Respon
Cepat Kejadian Luar Biasa Penyakit/Wabah Prioritas', 'Laporan', '1', '', '0.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (304, 301, 304, 44, 'Jumlah Dokumen SK Penetapan Status Darurat Bencana dan SKPDB yang Ditetapkan Paling Lama 1x24 Jam berdasarkan Hasil Dokumen Laporan Kaji Cepat', 'Dokumen', '2', '2', '5000000.00', '2', '30000000.00', '2', '30000000.00', '2', '30000000.00', '2', '30000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (305, 302, 305, 44, 'Jumlah Korban yang Berhasil Ditemukan, Ditolong, dan Dievakuasi Per Jenis Kejadian Bencana', '', '4000', '4000', '95000000.00', '4000', '200000000.00', '4000', '200000000.00', '4000', '200000000.00', '4000', '200000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (306, 303, 306, 44, 'Jumlah dokumen rencana operasi yang sah/legal', 'Dokumen', '2', '', '0.00', '2', '30000000.00', '2', '30000000.00', '2', '30000000.00', '2', '30000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (307, 304, 307, 44, 'Jumlah Aparatur SDM BPBD Kabupaten/Kota dan lintas perangkat daerah yang memiliki kemampuan penanganan keadaan darurat dalam aspek manajerial dan
teknis', 'Orang', '10', '', '0.00', '10', '30000000.00', '10', '30000000.00', '10', '30000000.00', '10', '30000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (308, 305, 308, 44, 'Jumlah Korban Bencana yang Mendapatkan Distribusi Logistik Penyelamatan dan Evakuasi
Korban Bencana', 'Orang', '500', '350', '85879265.00', '500', '150000000.00', '500', '150000000.00', '500', '150000000.00', '500', '150000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (309, 306, 309, 44, 'Jumlah dokumen SK Penetapan Status Darurat Bencana dan SKPDB yang Ditetapkan Paling Lama 1x24 Jam berdasarkan Hasil Dokumen Laporan Investigasi KLB dan Epidemiologi Terpadu', 'Dokumen', '1', '', '0.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (310, 307, 310, 44, 'Jumlah Laporan Pelaksanaan Aktivasi Sistem Komando Penanganan Darurat Bencana
Kanupaten/Kota', 'Laporan', '1', '1', '15000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (311, 308, 311, 44, 'Jumlah Dokumen Regulasi Pendukung Penyelenggaraan Penanggulangan Bencana di
Daerah', 'Dokumen', '', '', '0.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (312, 309, 312, 44, 'Jumlah Dokumen Kerja Sama antar Lembaga dan Kemitraan dalam Penanggulangan Bencana', 'Dokumen', '2', '', '0.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (313, 310, 313, 44, 'Jumlah Data dan Informasi
Kebencanaan yang tersedia', 'Dokumen', '', '1', '32847715.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (314, 311, 314, 44, 'Jumlah Laporan Hasil Binwas
Penyelenggaraan Penanggulangan Bencana', 'Laporan', '', '', '0.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (315, 312, 315, 44, 'Jumlah SDM aparatur penanggulangan bencana yang memiliki kompetensi', 'Orang', '', '', '0.00', '10', '30000000.00', '10', '30000000.00', '10', '30000000.00', '10', '30000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (316, 313, 316, 44, 'Jumlah Aparatur BPBD Kabupaten/Kota dan lintas perangkat daerah Kabupaten/Kota yang memiliki kemampuan teknis dalam menyusun dokumen Pengkajian Kebutuhan Pascabencana (JITUPASNA) dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P)', 'Orang', '35', '30', '50000000.00', '30', '60000000.00', '30', '60000000.00', '30', '60000000.00', '30', '60000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (317, 314, 317, 44, 'Jumlah penyelesaian kegiatan pascabencana di semua sektor sesuai berdasarkan Rencana Rehabilitasi dan Rekontruksi Pascabencana (R3P) Kabupaten/Kota yang dilegalkan', 'Kegiatan', '5', '5', '327224335.00', '5', '25000000.00', '5', '25000000.00', '5', '25000000.00', '5', '25000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (318, 315, 318, 44, 'Jumlah keterlibatan kelompok masyarakat dan dunia usaha dalam penanganan pascabencana Kabupaten/Kota meliputi Lembaga non pemerintah antara lain : lembaga filantropi, lembaga swadaya masyarakat, organisasi kemasyarakatan, organisasi sosial, organisasi keagamaan, organisasi relawan, perguruan tinggi, media massa dan dunia usaha yang telah
terdaftar dan legal', 'Lembaga', '', '', '0.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (319, 316, 319, 44, 'Jumlah data penduduk terpilah di daerah rawan bencana', 'Laporan', '', '', '0.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (320, 317, 320, 44, 'Jumlah penyelesaian dokumen Maklumat Pelayanan sampai dengan dinyatakan sah/legal paling lama dalam 1 (satu) tahun', 'Dokumen', '', '', '0.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (321, 318, 321, 44, 'Jumlah penyelesaian dokumen Pengkajian Kebutuhan Pascabencana dan Rencana Rehabilitasi dan Rekonstruksi Pascabencana (R3P) Kab/Kota sampai dengan dinyatakan sah dan legal paling lama dalam 1 (satu)
tahun', 'Dokumen', '12', '12', '100000000.00', '13', '100000000.00', '12', '20000000.00', '12', '20000000.00', '12', '20000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL),
  (322, 319, 322, 44, 'Jumlah penyelesaian dokumen Rencana Aksi Penerapan Standar Pelayanan Minimal (SPM) Sub Urusan Bencana Kabupaten/Kota sampai dengan dinyatakan sah/legal paling lama dalam 1
(satu) tahun', 'Dokumen', '', '', '0.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:26:46', '2026-09-23 16:26:46', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
