-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: DINAS PERHUBUNGAN SITUBONDO
-- ID INSTANSI: 52 | KODE: 2.15.0.00.0.00.01.0000
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-24 12:57:54
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (DINAS PERHUBUNGAN SITUBONDO) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (52, '2.15.0.00.0.00.01.0000', '35.12', 'DINAS PERHUBUNGAN SITUBONDO', '2.15', NULL, NULL, '$2y$10$dhbTZwuOqbKuXWFDvW5NjO.KNk3Gm0XffdPcxiUdz45BwpIlDzKpq', 4, 2025, 2029, '2026-09-08 17:48:21', '2026-09-22 18:53:49', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA DINAS PERHUBUNGAN SITUBONDO SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (1473, 1474, 1475, 1476, 1477, 1478, 1479, 1480, 1481, 1482, 1483, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1504, 1505, 1506, 1507, 1508, 1509, 1510, 1511, 1512, 1513, 1514, 1515, 1516, 1517);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (1473, 1474, 1475, 1476, 1477, 1478, 1479, 1480, 1481, 1482, 1483, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1504, 1505, 1506, 1507, 1508, 1509, 1510, 1511, 1512, 1513, 1514, 1515, 1516, 1517);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (283, 284, 285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (283, 284, 285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (283, 284, 285, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (113, 114, 115);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (113, 114, 115);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (113, 114, 115);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (61, 62);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (61, 62);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (23);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (23);
DELETE FROM `renstra_tujuan` WHERE `id` IN (23) OR (`id_instansi` = 52 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD DINAS PERHUBUNGAN SITUBONDO
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (23, '35.12', 52, '41', 'Terwujudnya Layanan Transportasi yang Nyaman, Aman dan Terjangkau', NULL, NULL, 'Rasio Konektivitas Kabupaten/Kota', 'Rasio', NULL, '0.286', '0.429', '0.429', '0.571', '0.571', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (2 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (37, 23, 52, 'Rasio Konektivitas Kabupaten/Kota', 'Rasio', '0.286', NULL, '0.286', '0.429', '0.429', '0.571', '0.571', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (38, 23, 52, 'IKM Perhubungan', 'Nilai', '82.97', NULL, '83.9', '84.07', '84.59', '84.97', '85.21', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

-- Table: renstra_sasaran (2 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (61, 23, 'Meningkatnya Akuntabilitas Kinerja Perangkat Daerah', NULL, NULL, 'Nilai SAKIP', 'Nilai', NULL, '85.9', '86.21', '86.54', '86.75', '86.94', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (62, 23, 'Meningkatnya Kualitas Pelayanan Infrastruktur', NULL, NULL, 'Indeks Infrastruktur Perhubungan', 'Indeks', NULL, '55.18', '56.04', '56.49', '57.12', '58.13', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (2 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (101, 61, NULL, 'Nilai SAKIP', 'Nilai', '85.66', NULL, '85.9', '86.21', '86.54', '86.75', '86.94', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (102, 62, NULL, 'Indeks Infrastruktur Perhubungan', 'Indeks', '53.17', NULL, '55.18', '56.04', '56.49', '57.12', '58.13', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

-- Table: renstra_program (3 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (113, 61, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '2.15.01', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, NULL, 'Terlaksananya Penunjang Urusan Pemerintahan Daerah Kabupaten / Kota', 'Persentase          Penunjang Urusan  Pemerintah  Daerah Kab/Kota', '%', NULL, '100', '100', '100', '100', '100', NULL, '31704046735.00', '30890768616.00', '32155538616.00', '32986185616.00', '32841547316.00'),
  (114, 62, 'PROGRAM PENYELENGGARAAN LALU LINTAS DAN ANGKUTANJALAN(LLAJ)', '2.15.02', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, NULL, 'Meningkatnya kualitas layanan transportasi darat', 'Persentase      Perusahaan angkutan     umum     yang tersertifikasi            Sistem
Manajemen   Keselamatan', '%', NULL, '3.85', '8.97', '12.82', '19.23', '25.64', NULL, '5276149435.00', '14300000000.00', '8795534681.00', '12000000000.00', '7000000000.00'),
  (115, 62, 'PROGRAM PENGELOLAAN PELAYARAN', '2.15.03', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, NULL, 'Meningkatnya kualitas layanan transportasi laut', 'Prosentase pengembangan rute
pelayaran (%)', '', NULL, '3.33', '3.33', '6.67', '6.67', '10', NULL, '55000000.00', '337700000.00', '337700000.00', '337700000.00', '337700000.00');

-- Table: renstra_program_outcome (3 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (157, 113, 'Terlaksananya Penunjang Urusan Pemerintahan Daerah Kabupaten / Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (158, 114, 'Meningkatnya kualitas layanan transportasi darat', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (159, 115, 'Meningkatnya kualitas layanan transportasi laut', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

-- Table: renstra_program_indikator (5 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (250, 113, 157, 52, 'Persentase          Penunjang Urusan  Pemerintah  Daerah Kab/Kota', '%', '100', '100', '100', '100', '100', '100', '31704046735.00', '30890768616.00', '32155538616.00', '32986185616.00', '32841547316.00', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 10),
  (251, 114, 158, 52, 'Persentase      Perusahaan angkutan     umum     yang tersertifikasi            Sistem
Manajemen   Keselamatan', '%', '', '3.85', '8.97', '12.82', '19.23', '25.64', '5276149435.00', '14300000000.00', '8795534681.00', '12000000000.00', '7000000000.00', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 10),
  (252, 114, 158, 52, 'Persentase Kelengkapan Jalan           yang         telah Terpasang            terhadap
Kondisi Ideal', 'Persentase', '29.5', '29.91', '31.67', '31.97', '32.53', '31.98', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 20),
  (253, 114, 158, 52, 'Konektivitas Darat', 'Rasio', '0.286', '0.286', '0.428', '0.428', '0.571', '0.571', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 30),
  (254, 115, 159, 52, 'Prosentase pengembangan rute
pelayaran (%)', '', '', '3.33', '3.33', '6.67', '6.67', '10', '55000000.00', '337700000.00', '337700000.00', '337700000.00', '337700000.00', '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 10);

-- Table: renstra_kegiatan (19 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (283, 113, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '2.15.01.2.01', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Dokumen Perencanaan dan Evaluasi Kinerja Perangkat Daerah', 'Jumlah                 Dokumen Perubahan        RKA-SKPD dan        Laporan        Hasil Koordinasi      Penyusunan
Dokumen Perubahan RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '0.00', '0.00', '72000000.00', '72000000.00'),
  (284, 113, 'Administrasi Keuangan Perangkat Daerah', '2.15.01.2.02', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Administrasi Keuangan Perangkat Daerah', 'Jumlah                 Laporan Keuangan   Akhir   Tahun SKPD  dan  Laporan  Hasil Koordinasi Penyusunan Laporan  Keuangan  Akhir
Tahun SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5673588054.00', '5723318845.00', '6009134787.00', '6310241526.00', '6625353602.00'),
  (285, 113, 'Administrasi Barang Milik Daerah pada Perangkat Daerah', '2.15.01.2.03', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Administrasi Barang Milik Daerah pada Perangkat Daerah', 'Jumlah                    Laporan Rekonsiliasi                    dan
Penyusunan            Laporan
Barang Milik Daerah pada SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (286, 113, 'Administrasi Kepegawaian Perangkat Daerah', '2.15.01.2.05', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Administrasi Kepegawaian Perangkat Daerah', 'Jumlah               Dokumen
Pendataan                   dan Pengolahan Administrasi Kepegawaian', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '18000000.00', '18000000.00', '19000000.00', '19000000.00'),
  (287, 113, 'Administrasi Umum Perangkat Daerah', '2.15.01.2.06', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Administrasi Umum Perangkat Daerah', 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan yang Disediakan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '398500000.00', '631000000.00', '673500000.00', '754000000.00', '754000000.00'),
  (288, 113, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '2.15.01.2.07', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', NULL, '4', '5', '8', '7', '6', NULL, '40850000.00', '70000000.00', '120000000.00', '120000000.00', '60000000.00'),
  (289, 113, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '2.15.01.2.08', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Jasa Penunjang Urusan Pemerintah Daerah', 'Jumlah                  Laporan Penyediaan                 Jasa Komunikasi, Sumber Daya
Air     dan     Listrik     yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '25134698300.00', '23779018451.00', '24465566028.00', '24896606289.00', '24712270182.00'),
  (290, 113, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '2.15.01.2.09', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah  Kendaraan  Dinas Operasional                 atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', NULL, '49', '49', '49', '49', '49', NULL, '396410381.00', '598431320.00', '797337801.00', '807337801.00', '591923532.00'),
  (291, 114, 'Penetapan Rencana Induk Jaringan LLAJ Kabupaten/Kota', '2.15.02.2.01', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya Kualitas Rencana Induk Jaringan LLAJ Kabupaten', 'Jumlah                Dokumen Penyusunan         Rencana Induk Jaringan LLAJ Kabupaten/Kota', 'Dokumen', NULL, '1', '', '1', '', '1', NULL, '0.00', '0.00', '250000000.00', '0.00', '275000000.00'),
  (292, 114, 'Penyediaan Perlengkapan Jalan di Jalan Kabupaten/Kota', '2.15.02.2.02', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya Penyediaan Perlengkapan Jalan sesuai Ketentuan', 'Jumlah Prasarana Jalan yang Terehabilitasi dan
Terpelihara', 'Unit', NULL, '25', '28', '32', '37', '42', NULL, '3036849435.00', '10977600000.00', '5099734681.00', '8395800000.00', '3120800000.00'),
  (293, 114, 'Pengelolaan Terminal Penumpang Tipe C', '2.15.02.2.03', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya Fasilitas Terminal Tipe C', 'Jumlah  Terminal  Tipe   C (Fasilitas      Utama      dan Penunjang)                 yang
terehabilitasi                 dan terpelihara', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '400000000.00', '400000000.00', '500000000.00', '500000000.00'),
  (294, 114, 'Penerbitan Izin Penyelenggaraan dan Pembangunan Fasilitas Parkir', '2.15.02.2.04', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya Kinerja Pelayanan Parkir', 'Jumlah                  Laporan Koordinasi                    dan Sinkronisasi  Pengawasan Pelaksanaan                 Izin
Penyelenggaraan         dan Terbangunnya      Fasilitas Parkir             Kewenangan Kabupaten/Kota', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '1290000000.00', '1550000000.00', '1600000000.00', '1650000000.00', '1650000000.00'),
  (295, 114, 'Pengujian Berkala Kendaraan Bermotor', '2.15.02.2.05', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 'Jumlah       Sarana       dan Prasarana           Pengujian Berkala Kendaraan Bermotoryang Terpelihara', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '250000000.00', '149400000.00', '152800000.00', '157200000.00', '157200000.00'),
  (296, 114, 'Pelaksanaan Manajemen dan Rekayasa Lalu Lintas untuk Jaringan Jalan Kabupaten/Kota', '2.15.02.2.06', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya Pelaksanaan Manajemen dan Rekayasa Lalu Lintas', 'Jumlah                    laporan pelaksanaan        Penataan Manajemen dan Rekayasa Lalu        Lintas         Untuk Jaringan                     Jalan Kabupaten/Provinsi', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '464300000.00', '930000000.00', '980000000.00', '980000000.00', '980000000.00'),
  (297, 114, 'Persetujuan Hasil Analisis Dampak Lalu Lintas (Andalalin) untuk Jalan Kabupaten/Kota', '2.15.02.2.07', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya persetujuan hasil andalalin untuk jalan kabupaten', 'Jumlah                  Laporan Koordinasi                   dan Sinkronisasi       Penilaian Hasil Andalalin', 'Laporan', NULL, '4', '5', '6', '7', '8', NULL, '5000000.00', '18000000.00', '18000000.00', '19000000.00', '19000000.00'),
  (298, 114, 'Audit dan Inspeksi Keselamatan LLAJ di Jalan', '2.15.02.2.08', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 'Jumlah  laporan  Inspeksi, Audit    dan    Pemantauan Sistem             Manajemen Keselamatan  Perusahaan
Angkutan                 Umum', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '28000000.00', '28000000.00', '30000000.00', '30000000.00'),
  (299, 114, 'Penyediaan Angkutan Umum untuk Jasa Angkutan Orang dan/atau Barang Antar Kota dalam 1 (Satu) Daerah Kabupaten/Kota', '2.15.02.2.09', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 'Jumlah                  Laporan Pengendalian               dan Pengawasan Ketersediaan Angkutan
Umum        untuk        Jasa Angkutan Orang dan/atau Barang Antar Kota dalam
1 (Satu) Kabupaten/Kota', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '230000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (300, 114, 'Penerbitan Izin Penyelenggaraan Angkutan Orang dalam Trayek Lintas Daerah Kabupaten/Kota dalam 1 (Satu) Daerah Kabupaten/Kota', '2.15.02.2.14', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 'Jumlah    Laporan Pemenuhan Persyaratan Perolehan                     Izin Penyelenggaraan Angkutan Orang dalam Trayek           Kewenangan Kabupaten/Kota       dalam Sistem   Pelayanan
Perizinan            Berusaha
Terintegrasi            Secara Elektronik', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '17000000.00', '17000000.00', '18000000.00', '18000000.00'),
  (301, 115, 'Pembangunan, Penerbitan Izin Pembangunan dan Pengoperasian Pelabuhan Pengumpan Lokal', '2.15.03.2.12', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya fasilitas pelabuhan', 'Jumlah              Pelabuhan Pengumpan   Lokal   yang Beroperasi                   dan Terpelihara', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '55000000.00', '337700000.00', '337700000.00', '337700000.00', '337700000.00');

-- Table: renstra_kegiatan_sasaran (19 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (296, 283, 'Terlaksananya Dokumen Perencanaan dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (297, 284, 'Terlaksananya Administrasi Keuangan Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (298, 285, 'Terlaksananya Administrasi Barang Milik Daerah pada Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (299, 286, 'Terlaksananya Administrasi Kepegawaian Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (300, 287, 'Terlaksananya Administrasi Umum Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (301, 288, 'Tersedianya Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (302, 289, 'Tersedianya Jasa Penunjang Urusan Pemerintah Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (303, 290, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (304, 291, 'Meningkatnya Kualitas Rencana Induk Jaringan LLAJ Kabupaten', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (305, 292, 'Meningkatnya Penyediaan Perlengkapan Jalan sesuai Ketentuan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (306, 293, 'Meningkatnya Fasilitas Terminal Tipe C', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (307, 294, 'Meningkatnya Kinerja Pelayanan Parkir', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (308, 295, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (309, 296, 'Meningkatnya Pelaksanaan Manajemen dan Rekayasa Lalu Lintas', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (310, 297, 'Meningkatnya persetujuan hasil andalalin untuk jalan kabupaten', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (311, 298, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (312, 299, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (313, 300, 'Meningkatnya ketersediaan angkutan umum yang layak jalan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (314, 301, 'Meningkatnya fasilitas pelabuhan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

-- Table: renstra_kegiatan_indikator (45 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1416, 283, 296, 52, 'Jumlah                 Dokumen Perubahan        RKA-SKPD dan        Laporan        Hasil Koordinasi      Penyusunan
Dokumen Perubahan RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '72000000.00', '1', '72000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1417, 283, 296, 52, 'Jumlah    Dokumen    RKA-SKPD  dan  Laporan  Hasil Koordinasi      Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1418, 283, 296, 52, 'Jumlah Laporan Evaluasi
Kinerja Perangkat Daerah', 'Laporan', '2', '2', '50000000.00', '2', '65000000.00', '2', '66000000.00', '2', '0.00', '2', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1419, 283, 296, 52, 'Jumlah    Dokumen    DPA-SKPD  dan  Laporan  Hasil Koordinasi      Penyusunan
Dokumen DPA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1420, 283, 296, 52, 'Jumlah                 Dokumen Perubahan        DPA-SKPD dan        Laporan        Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1421, 283, 296, 52, 'Jumlah                 Dokumen
Perencanaan      Perangkat Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 60, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1422, 284, 297, 52, 'Jumlah                 Laporan Keuangan   Akhir   Tahun SKPD  dan  Laporan  Hasil Koordinasi Penyusunan Laporan  Keuangan  Akhir
Tahun SKPD', 'Laporan', '1', '1', '5673588054.00', '1', '5723318845.00', '1', '6009134787.00', '1', '6310241526.00', '1', '6625353602.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1423, 284, 297, 52, 'Jumlah   Dokumen   Hasil Penyediaan Administrasi
Pelaksanaan  Tugas  ASN', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1424, 284, 297, 52, 'Jumlah Orang yang Menerima  Gaji  dan Tunjangan ASN', 'Orang/bulan', '58', '55', '0.00', '55', '0.00', '55', '0.00', '55', '0.00', '55', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1425, 285, 298, 52, 'Jumlah                    Laporan Rekonsiliasi                    dan
Penyusunan            Laporan
Barang Milik Daerah pada SKPD', 'Laporan', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '7000000.00', '1', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1426, 286, 299, 52, 'Jumlah               Dokumen
Pendataan                   dan Pengolahan Administrasi Kepegawaian', 'Dokumen', '1', '1', '5000000.00', '1', '18000000.00', '1', '18000000.00', '1', '19000000.00', '1', '19000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1427, 286, 299, 52, 'Jumlah               Dokumen Monitoring, Evaluasi, dan
PenilaianKinerja Pegawai', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1428, 287, 300, 52, 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan yang Disediakan', 'Dokumen', '12', '12', '398500000.00', '12', '631000000.00', '12', '673500000.00', '12', '754000000.00', '12', '754000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1429, 287, 300, 52, 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', '9', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1430, 287, 300, 52, 'Jumlah Paket Komponen Instalasi                   Listrik
/Penerangan    Bangunan Kantor yang Disediakan', 'Paket', '10', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1431, 287, 300, 52, 'Jumlah      Paket      Barang
Cetakan dan  Penggandaan yang Disediakan', 'Paket', '15', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', 40, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1432, 287, 300, 52, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '14', '14', '0.00', '14', '0.00', '14', '0.00', '14', '0.00', '14', '0.00', 50, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1433, 287, 300, 52, 'Jumlah                  Laporan Penyelenggaraan     Rapat Koordinasi                   dan
Konsultasi                SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 60, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1434, 287, 300, 52, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 70, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1435, 288, 301, 52, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', '4', '4', '40850000.00', '5', '70000000.00', '8', '120000000.00', '7', '120000000.00', '6', '60000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1436, 289, 302, 52, 'Jumlah                  Laporan Penyediaan                 Jasa Komunikasi, Sumber Daya
Air     dan     Listrik     yang Disediakan', 'Laporan', '12', '12', '25134698300.00', '12', '23779018451.00', '12', '24465566028.00', '12', '24896606289.00', '12', '24712270182.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1437, 289, 302, 52, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1438, 289, 302, 52, 'Jumlah                  Laporan Penyediaan                 Jasa
Pelayanan  Umum  Kantor yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1439, 290, 303, 52, 'Jumlah  Kendaraan  Dinas Operasional                 atau Lapangan yang Dipelihara dan dibayarkan Pajak
dan Perizinannya', 'Unit', '49', '49', '396410381.00', '49', '598431320.00', '49', '797337801.00', '49', '807337801.00', '49', '591923532.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1440, 290, 303, 52, 'Jumlah              Kendaraan Perorangan    Dinas    atau Kendaraan  Dinas  Jabatan
yang       Dipelihara      dan dibayarkan Pajaknya', 'Unit', '49', '49', '0.00', '49', '0.00', '49', '0.00', '49', '0.00', '49', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1441, 290, 303, 52, 'Jumlah       Sarana       dan Prasarana Gedung Kantor atau   Bangunan   Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '10', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1442, 291, 304, 52, 'Jumlah                Dokumen Penyusunan         Rencana Induk Jaringan LLAJ Kabupaten/Kota', 'Dokumen', '1', '1', '0.00', '', '0.00', '1', '250000000.00', '', '0.00', '1', '275000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1443, 292, 305, 52, 'Jumlah Prasarana Jalan yang Terehabilitasi dan
Terpelihara', 'Unit', '23', '25', '3036849435.00', '28', '10977600000.00', '32', '5099734681.00', '37', '8395800000.00', '42', '3120800000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1444, 292, 305, 52, 'Jumlah         Perlengkapan
Jalan           di             Jalan Kabupaten/Kota yang Tersedia', 'Unit', '1390', '125', '0.00', '213', '0.00', '238', '0.00', '404', '0.00', '112', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1445, 292, 305, 52, 'Jumlah Perlengkapan
Jalan yang Terehabilitasi dan Terpelihara', 'Unit', '500', '610', '0.00', '632', '0.00', '654', '0.00', '675', '0.00', '682', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1446, 293, 306, 52, 'Jumlah  Terminal  Tipe   C (Fasilitas      Utama      dan Penunjang)                 yang
terehabilitasi                 dan terpelihara', 'Unit', '1', '1', '100000000.00', '1', '400000000.00', '1', '400000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1447, 294, 307, 52, 'Jumlah                  Laporan Koordinasi                    dan Sinkronisasi  Pengawasan Pelaksanaan                 Izin
Penyelenggaraan         dan Terbangunnya      Fasilitas Parkir             Kewenangan Kabupaten/Kota', 'Laporan', '12', '12', '1290000000.00', '12', '1550000000.00', '12', '1600000000.00', '12', '1650000000.00', '12', '1650000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1448, 295, 308, 52, 'Jumlah       Sarana       dan Prasarana           Pengujian Berkala Kendaraan Bermotoryang Terpelihara', 'Unit', '11', '11', '250000000.00', '11', '149400000.00', '11', '152800000.00', '11', '157200000.00', '11', '157200000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1449, 295, 308, 52, 'Jumlah    Dokumen    Bukti Lulus       Uji       Pengujian Berkala              Kendaraan Bermotor', 'Dokumen', '6408', '4200', '0.00', '2400', '0.00', '2400', '0.00', '2400', '0.00', '2400', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1450, 295, 308, 52, 'Jumlah Sumber Daya Manusia              Pengujian
Berkala              Kendaraan
Bermotor                    yang Ditingkatkan Kapasitasnya', 'orang', '', '4', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1451, 296, 309, 52, 'Jumlah                    laporan pelaksanaan        Penataan Manajemen dan Rekayasa Lalu        Lintas         Untuk Jaringan                     Jalan Kabupaten/Provinsi', 'Laporan', '1', '1', '464300000.00', '1', '930000000.00', '1', '980000000.00', '1', '980000000.00', '1', '980000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1452, 296, 309, 52, 'Jumlah         Perlengkapan Jalan      dalam      Rangka Manajemen dan Rekayasa Lalu         Lintas          yang dilaksanakan    pengadaan
dan Pemasangan', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1453, 296, 309, 52, 'Jumlah                  Laporan Pengawasan                 dan Pengendalian    Efektivitas Pelaksanaan       Kebijakan untuk                          Jalan
Kabupaten/Kota', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1454, 296, 309, 52, 'Jumlah    laporan    Forum Lalu Lintas dan Angkutan Jalan untuk Jaringan
Jalan        Kabupaten/Kota', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1455, 297, 310, 52, 'Jumlah                  Laporan Koordinasi                   dan Sinkronisasi       Penilaian Hasil Andalalin', 'Laporan', '9', '4', '5000000.00', '5', '18000000.00', '6', '18000000.00', '7', '19000000.00', '8', '19000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1456, 298, 311, 52, 'Jumlah  laporan  Inspeksi, Audit    dan    Pemantauan Sistem             Manajemen Keselamatan  Perusahaan
Angkutan                 Umum', 'Laporan', '1', '1', '15000000.00', '1', '28000000.00', '1', '28000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1457, 299, 312, 52, 'Jumlah                  Laporan Pengendalian               dan Pengawasan Ketersediaan Angkutan
Umum        untuk        Jasa Angkutan Orang dan/atau Barang Antar Kota dalam
1 (Satu) Kabupaten/Kota', 'Laporan', '1', '1', '100000000.00', '1', '230000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1458, 300, 313, 52, 'Jumlah    Laporan Pemenuhan Persyaratan Perolehan                     Izin Penyelenggaraan Angkutan Orang dalam Trayek           Kewenangan Kabupaten/Kota       dalam Sistem   Pelayanan
Perizinan            Berusaha
Terintegrasi            Secara Elektronik', 'Unit', '1', '1', '15000000.00', '1', '17000000.00', '1', '17000000.00', '1', '18000000.00', '1', '18000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1459, 301, 314, 52, 'Jumlah              Pelabuhan Pengumpan   Lokal   yang Beroperasi                   dan Terpelihara', 'Unit', '1', '1', '55000000.00', '1', '337700000.00', '1', '337700000.00', '1', '337700000.00', '1', '337700000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1460, 301, 314, 52, 'Jumlah                  Laporan Pengawasan Pengoperasian
Pelabuhan Pengumpan Lokal', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

-- Table: renstra_sub_kegiatan (45 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1473, 283, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '2.15.01.2.01.0001', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah                   Dokumen Perencanaan        Perangkat
Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (1474, 283, 'Koordinasi dan Penyusunan Dokumen RKA-SKPD', '2.15.01.2.01.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Jumlah  Dokumen  RKA-SKPD dan  Laporan  Hasil  Koordinas Penyusunan   Dokumen   RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (1475, 283, 'Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '2.15.01.2.01.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Jumlah                   Dokumen Perubahan  RKA-SKPD  dan Laporan    Hasil    Koordinasi Penyusunan  Dokumen Perubahan          RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (1476, 283, 'Koordinasi dan Penyusunan DPA-SKPD', '2.15.01.2.01.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Jumlah Dokumen DPA-SKPD dan           Laporan         Hasi Koordinasi  Penyusunan
Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (1477, 283, 'Koordinasi dan Penyusunan Perubahan DPA- SKPD', '2.15.01.2.01.0005', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Jumlah                 Dokumen Perubahan        DPA-SKPD dan        Laporan        Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (1478, 283, 'Evaluasi Kinerja Perangkat Daerah', '2.15.01.2.01.0007', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi
Kinerja Perangkat Daerah', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '25000000.00', '35000000.00', '36000000.00', '37000000.00', '37000000.00'),
  (1479, 284, 'Penyediaan Gaji dan Tunjangan ASN', '2.15.01.2.02.0001', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', NULL, '55', '55', '55', '55', '55', NULL, '5505988054.00', '5540548845.00', '5817576287.00', '6108455101.00', '6413877856.00'),
  (1480, 284, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '2.15.01.2.02.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah      Dokumen      Hasil Penyediaan         Administrasi
Pelaksanaan Tugas ASN', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '162600000.00', '175770000.00', '184558500.00', '193786425.00', '203475746.00'),
  (1481, 284, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '2.15.01.2.02.0005', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir   Tahun   SKPD   dan Laporan   Hasil   Koordinasi Penyusunan           Laporan
Keuangan Akhir  Tahun SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '7000000.00', '7000000.00', '8000000.00', '8000000.00'),
  (1482, 285, 'Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', '2.15.01.2.03.0005', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Jumlah  Laporan  Rekonsiliasi dan    Penyusunan    Laporan Barang   Milik   Daerah   pada SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '7000000.00', '7000000.00'),
  (1483, 286, 'Pendataan dan Pengolahan Administrasi Kepegawaian', '2.15.01.2.05.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 'Jumlah                 Dokumen
Pendataan                    dan Pengolahan Administrasi Kepegawaian', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '6000000.00', '6000000.00', '6000000.00', '6000000.00'),
  (1484, 286, 'Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', '2.15.01.2.05.0005', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Jumlah                 Dokumen Monitoring,   Evaluasi,   dan
Penilaian Kinerja  Pegawai', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '0.00', '12000000.00', '12000000.00', '13000000.00', '13000000.00'),
  (1485, 287, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '2.15.01.2.06.0001', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor  yang Disediakan', 'Paket', NULL, '10', '10', '10', '10', '10', NULL, '10000000.00', '20000000.00', '22000000.00', '24000000.00', '24000000.00'),
  (1486, 287, 'Penyediaan Peralatan Rumah Tangga', '2.15.01.2.06.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', NULL, '9', '9', '9', '9', '9', NULL, '10000000.00', '12000000.00', '12000000.00', '15000000.00', '15000000.00'),
  (1487, 287, 'Penyediaan Bahan Logistik Kantor', '2.15.01.2.06.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan
Logistik Kantor yang Disediakan', 'Paket', NULL, '14', '14', '14', '14', '14', NULL, '60000000.00', '90000000.00', '95000000.00', '105000000.00', '105000000.00'),
  (1488, 287, 'Penyediaan Barang Cetakan dan Penggandaan', '2.15.01.2.06.0005', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah       Paket       Barang Cetakan dan Penggandaan
yang Disediakan', 'Paket', NULL, '15', '15', '15', '15', '15', NULL, '160000000.00', '160000000.00', '165000000.00', '175000000.00', '175000000.00'),
  (1489, 287, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '2.15.01.2.06.0006', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan yang Disediakan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '8500000.00', '9000000.00', '9500000.00', '10000000.00', '10000000.00'),
  (1490, 287, 'Fasilitasi Kunjungan Tamu', '2.15.01.2.06.0008', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Fasilitasi Kunjungan Tamu', 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '60000000.00', '65000000.00', '70000000.00', '75000000.00', '75000000.00'),
  (1491, 287, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '2.15.01.2.06.0009', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah                    Laporan Penyelenggaraan       Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '90000000.00', '275000000.00', '300000000.00', '350000000.00', '350000000.00'),
  (1492, 288, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '2.15.01.2.07.0010', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah   Unit   Sarana   dan Prasarana   Gedung   Kantor
atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '4', '5', '8', '7', '6', NULL, '40850000.00', '70000000.00', '120000000.00', '120000000.00', '60000000.00'),
  (1493, 289, 'Penyediaan Jasa Surat Menyurat', '2.15.01.2.08.0001', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan
Penyediaan Jasa Surat Menyurat', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5000000.00', '5500000.00', '6000000.00', '6000000.00'),
  (1494, 289, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '2.15.01.2.08.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa   Komunikasi,   Sumber
Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '21332205800.00', '20757179001.00', '21179330977.00', '21510834485.00', '21442902942.00'),
  (1495, 289, 'Penyediaan Jasa Pelayanan Umum Kantor', '2.15.01.2.08.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa     Pelayanan     Umum Kantor yang  Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '3797492500.00', '3016839450.00', '3280735051.00', '3379771804.00', '3263367240.00'),
  (1496, 290, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '2.15.01.2.09.0001', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah                Kendaraan Perorangan     Dinas     atau Kendaraan   Dinas   Jabatan yang        Dipelihara        dan dibayarkan Pajaknya', 'Unit', NULL, '49', '49', '49', '49', '49', NULL, '314275000.00', '489431320.00', '675337801.00', '675337801.00', '459923532.00'),
  (1497, 290, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan  Kendaraan Dinas Operasional atauLapangan', '2.15.01.2.09.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah   Kendaraan   Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan      Pajak      dan
Perizinannya', 'Unit', NULL, '49', '49', '49', '49', '49', NULL, '44725000.00', '45000000.00', '48000000.00', '48000000.00', '48000000.00'),
  (1498, 290, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '2.15.01.2.09.0010', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah        Sarana        dan Prasarana   Gedung   Kantor atau     Bangunan     Lainnya
yang Dipelihara/Direhabilitasi', 'Unit', NULL, '10', '10', '10', '10', '10', NULL, '37410381.00', '64000000.00', '74000000.00', '84000000.00', '84000000.00'),
  (1499, 291, 'Pelaksanaan Penyusunan Rencana Induk Jaringan LLAJ Kabupaten/Kota', '2.15.02.2.01.0001', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Penyusunan Rencana Induk Jaringan LLAJ Kabupaten/Kota', 'Jumlah                  Dokumen
Penyusunan           Rencana Induk       Jaringan       LLAJ Kabupaten/Kota', 'Dokumen', NULL, '1', '', '1', '', '1', NULL, '0.00', '0.00', '250000000.00', '0.00', '275000000.00'),
  (1500, 292, 'Penyediaan Perlengkapan Jalan di Jalan Kabupaten/Kota', '2.15.02.2.02.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Perlengkapan Jalan di Jalan Kabupaten/Kota', 'Jumlah Perlengkapan Jalan di Jalan Kabupaten/Kota
yang Tersedia', 'Unit', NULL, '125', '213', '238', '404', '112', NULL, '2008599435.00', '9937600000.00', '4049734681.00', '7270800000.00', '2010800000.00'),
  (1501, 292, 'Rehabilitasi dan Pemeliharaan Prasarana Jalan', '2.15.02.2.02.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Rehabilitasi dan Pemeliharaan Prasarana Jalan', 'Jumlah Prasarana Jalan yang Terehabilitasi dan
Terpelihara', 'Unit', NULL, '25', '28', '32', '37', '42', NULL, '278250000.00', '280000000.00', '290000000.00', '315000000.00', '300000000.00'),
  (1502, 292, 'Rehabilitasi dan Pemeliharaan Perlengkapan Jalan', '2.15.02.2.02.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Rehabilitasi dan Pemeliharaan Perlengkapan Jalan', 'Jumlah Perlengkapan Jalan yang Terehabilitasi dan
Terpelihara', 'Unit', NULL, '610', '632', '654', '675', '682', NULL, '750000000.00', '760000000.00', '760000000.00', '810000000.00', '810000000.00'),
  (1503, 293, 'Rehabilitasi dan Pemeliharaan Terminal Tipe C (Fasilitas Utama dan Penunjang)', '2.15.02.2.03.0011', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Rehabilitasi dan Pemeliharaan Terminal Tipe C (FasilitasUtama dan Penunjang)', 'Jumlah   Terminal   Tipe   C (Fasilitas       Utama       dan Penunjang)                   yang terehabilitasi dan terpelihara', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '400000000.00', '400000000.00', '500000000.00', '500000000.00'),
  (1504, 294, 'Koordinasi dan Sinkronisasi Pengawasan Pelaksanaan Izin Penyelenggaraan dan Pembangunan Fasilitas Parkir              Kewenangan Kabupaten/Kota', '2.15.02.2.04.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Koordinasi dan Sinkronisasi Pengawasan Pelaksanaan Izin Penyelenggaraan dan Terbangunnya Fasilitas Parkir Kewenangan Kabupaten/Kota', 'Jumlah  Laporan  Koordinasi dan                    Sinkronisasi Pengawasan    Pelaksanaan Izin   Penyelenggaraan   dan Terbangunnya  Fasilitas Parkir               Kewenangan
Kabupaten/Kota', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '1290000000.00', '1550000000.00', '1600000000.00', '1650000000.00', '1650000000.00'),
  (1505, 295, 'Peningkatan Kapasitas Sumber Daya Manusia Pengujian Berkala Kendaraan Bermotor', '2.15.02.2.05.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Meningkatnya Kapasitas Sumber Daya Manusia Pengujian Berkala Kendaraan Bermotor', 'Jumlah      Sumber      Daya Manusia  Pengujian  Berkala Kendaraan Bermotor yang Ditingkatkan Kapasitasnya', 'orang', NULL, '4', '', '', '', '', NULL, '60000000.00', '0.00', '0.00', '0.00', '0.00'),
  (1506, 295, 'Penyediaan Bukti Lulus Uji Pengujian Berkala Kendaraan Bermotor', '2.15.02.2.05.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Tersedianya Bukti Lulus Uji Pengujian Berkala Kendaraan Bermotor', 'Jumlah     Dokumen     Bukti Lulus Uji Pengujian Berkala
Kendaraan Bermotor', 'Dokumen', NULL, '4200', '2400', '2400', '2400', '2400', NULL, '105000000.00', '62400000.00', '64800000.00', '67200000.00', '67200000.00'),
  (1507, 295, 'Pemeliharaan Sarana dan Prasarana Pengujian Berkala Kendaraan Bermotor', '2.15.02.2.05.0007', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terpeliharanya Sarana dan Prasarana Pengujian Berkala Kendaraan Bermotor', 'Jumlah        Sarana        dan Prasarana             Pengujian
Berkala                Kendaraan
Bermotor  yang  Terpelihara', 'Unit', NULL, '11', '11', '11', '11', '11', NULL, '85000000.00', '87000000.00', '88000000.00', '90000000.00', '90000000.00'),
  (1508, 296, 'Pengawasan dan Pengendalian Efektivitas Pelaksanaan Kebijakan untuk Jalan Kabupaten/Kota', '2.15.02.2.06.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terawasinya dan Terkendalinya Efektivitas Pelaksanaan Kebijakan untuk Jalan Kabupaten/Kota', 'Jumlah                    Laporan Pengawasan                  dan Pengendalian        Efektivitas Pelaksanaan         Kebijakan
untuk Jalan Kabupaten/Kota', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '270000000.00', '165000000.00', '175000000.00', '175000000.00', '175000000.00'),
  (1509, 296, 'Forum Lalu Lintas dan Angkutan Jalan untuk Jaringan Jalan Kabupaten/Kota', '2.15.02.2.06.0015', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Forum Lalu Lintas dan Angkutan Jalan untuk Jaringan Jalan Kabupaten/Kota', 'Jumlah laporan Forum Lalu Lintas  dan  Angkutan  Jalan
untuk Jaringan Jalan Kabupaten/Kota', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '59300000.00', '275000000.00', '300000000.00', '300000000.00', '300000000.00'),
  (1510, 296, 'Pengadaan dan Pemasangan Perlengkapan Jalan dalam rangka Manajemen dan Rekayasa Lalu Lintas', '2.15.02.2.06.0016', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Pengadaan dan Pemasangan Perlengkapan Jalan dalam Rangka Manajemen dan Rekayasa Lalu Lintas', 'Jumlah Perlengkapan Jalan dalam  Rangka  Manajemen dan  Rekayasa  Lalu  Lintas yang                dilaksanakan
pengadaan                    dan Pemasangan', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '75000000.00', '410000000.00', '425000000.00', '425000000.00', '425000000.00'),
  (1511, 296, 'Penataan Manajemen dan Rekayasa Lalu Lintas untuk Jaringan Jalan Kabupaten/Kota', '2.15.02.2.06.0017', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya penataan Manajemen dan Rekayasa Lalu Lintas Untuk Jaringan Jalan Kabupaten/Kota', 'Jumlah                     laporan pelaksanaan         Penataan Manajemen  dan  Rekayasa Lalu  Lintas  Untuk  Jaringan
Jalan Kabupaten/Provinsi', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '60000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (1512, 297, 'Koordinasi dan Sinkronisasi Penilaian Hasil Andalalin', '2.15.02.2.07.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Koordinasi dan Sinkronisasi Penilaian Hasil Andalalin', 'Jumlah Laporan Koordinasi dan  Sinkronisasi  Penilaian Hasil Andalalin', 'Laporan', NULL, '4', '5', '6', '7', '8', NULL, '5000000.00', '18000000.00', '18000000.00', '19000000.00', '19000000.00'),
  (1513, 298, 'Pelaksanaan Inspeksi, Audit dan Pemantauan Sistem Manajemen Keselamatan Perusahaan Angkutan Umum', '2.15.02.2.08.0007', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terlaksananya Inspeksi, Audit dan Pemantauan Sistem Manajemen Keselamatan Perusahaan Angkutan Umum', 'Jumlah   laporan   Inspeksi, Audit     dan     Pemantauan Sistem               Manajemen Keselamatan  Perusahaan Angkutan Umum', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '28000000.00', '28000000.00', '30000000.00', '30000000.00'),
  (1514, 299, 'Pengendalian dan Pengawasan Ketersediaan Angkutan Umum untuk Jasa Angkutan Orang dan/atau Barang Antar Kota dalam 1 (Satu) Kabupaten/Kota', '2.15.02.2.09.0002', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terkendalinya dan Terawasinya Ketersediaan Angkutan Umum untuk Jasa Angkutan Orang dan/atau Barang Antar Kota dalam 1 (Satu) Kabupaten/Kota', 'Jumlah                    Laporan Pengendalian                dan Pengawasan   Ketersediaan Angkutan     Umum     untuk Jasa      Angkutan      Orang dan/atau    Barang       Antar
Kota dalam 1  (Satu) Kabupaten/Kota', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '230000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (1515, 300, 'Fasilitasi Pemenuhan Persyaratan Perolehan Izin Penyelenggaraan Angkutan Orang dalam Trayek Kewenangan Kabupaten/Kota dalam Sistem Pelayanan Perizinan Berusaha Terintegrasi Secara Elektronik', '2.15.02.2.14.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terfasilitasinya Pemenuhan Persyaratan Perolehan Izin Penyelenggaraan Angkutan Orang dalam Trayek Kewenangan Kabupaten/Kota dalam Sistem Pelayanan Perizinan Berusaha Terintegrasi Secara Elektronik', 'Jumlah                    Laporan Pemenuhan       Persyaratan Perolehan                      Izin
Penyelenggaraan Angkutan Orang        dalam Trayek Kewenangan Kabupaten/Kota         dalam Sistem                Pelayanan
Perizinan              Berusaha
Terintegrasi              Secara Elektronik', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '17000000.00', '17000000.00', '18000000.00', '18000000.00'),
  (1516, 301, 'Pengoperasian dan Pemeliharaan Pelabuhan Pengumpan Lokal', '2.15.03.2.12.0003', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Teroperasinya dan Terpeliharanya Pelabuhan Pengumpan Lokal', 'Jumlah  Pelabuhan Pengumpan Lokal  yang Beroperasi dan Terpelihara', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '0.00', '275000000.00', '275000000.00', '275000000.00', '275000000.00'),
  (1517, 301, 'Pengawasan Pengoperasian Pelabuhan PengumpanLokal', '2.15.03.2.12.0004', NULL, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL, 'Terawasinya Pengoperasian Pelabuhan Pengumpan Lokal', 'Jumlah   Laporan PengawasanPengoperasian Pelabuhan  Pengumpan Lokal', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '55000000.00', '62700000.00', '62700000.00', '62700000.00', '62700000.00');

-- Table: renstra_sub_kegiatan_sasaran (45 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1505, 1473, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1506, 1474, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1507, 1475, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1508, 1476, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1509, 1477, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1510, 1478, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1511, 1479, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1512, 1480, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1513, 1481, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1514, 1482, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1515, 1483, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1516, 1484, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1517, 1485, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1518, 1486, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1519, 1487, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1520, 1488, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1521, 1489, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1522, 1490, 'Terlaksananya Fasilitasi Kunjungan Tamu', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1523, 1491, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1524, 1492, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1525, 1493, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1526, 1494, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1527, 1495, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1528, 1496, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1529, 1497, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1530, 1498, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1531, 1499, 'Terlaksananya Penyusunan Rencana Induk Jaringan LLAJ Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1532, 1500, 'Tersedianya Perlengkapan Jalan di Jalan Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1533, 1501, 'Terlaksananya Rehabilitasi dan Pemeliharaan Prasarana Jalan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1534, 1502, 'Terlaksananya Rehabilitasi dan Pemeliharaan Perlengkapan Jalan', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1535, 1503, 'Terlaksananya Rehabilitasi dan Pemeliharaan Terminal Tipe C (FasilitasUtama dan Penunjang)', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1536, 1504, 'Terlaksananya Koordinasi dan Sinkronisasi Pengawasan Pelaksanaan Izin Penyelenggaraan dan Terbangunnya Fasilitas Parkir Kewenangan Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1537, 1505, 'Meningkatnya Kapasitas Sumber Daya Manusia Pengujian Berkala Kendaraan Bermotor', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1538, 1506, 'Tersedianya Bukti Lulus Uji Pengujian Berkala Kendaraan Bermotor', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1539, 1507, 'Terpeliharanya Sarana dan Prasarana Pengujian Berkala Kendaraan Bermotor', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1540, 1508, 'Terawasinya dan Terkendalinya Efektivitas Pelaksanaan Kebijakan untuk Jalan Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1541, 1509, 'Terlaksananya Forum Lalu Lintas dan Angkutan Jalan untuk Jaringan Jalan Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1542, 1510, 'Terlaksananya Pengadaan dan Pemasangan Perlengkapan Jalan dalam Rangka Manajemen dan Rekayasa Lalu Lintas', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1543, 1511, 'Terlaksananya penataan Manajemen dan Rekayasa Lalu Lintas Untuk Jaringan Jalan Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1544, 1512, 'Terlaksananya Koordinasi dan Sinkronisasi Penilaian Hasil Andalalin', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1545, 1513, 'Terlaksananya Inspeksi, Audit dan Pemantauan Sistem Manajemen Keselamatan Perusahaan Angkutan Umum', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1546, 1514, 'Terkendalinya dan Terawasinya Ketersediaan Angkutan Umum untuk Jasa Angkutan Orang dan/atau Barang Antar Kota dalam 1 (Satu) Kabupaten/Kota', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1547, 1515, 'Terfasilitasinya Pemenuhan Persyaratan Perolehan Izin Penyelenggaraan Angkutan Orang dalam Trayek Kewenangan Kabupaten/Kota dalam Sistem Pelayanan Perizinan Berusaha Terintegrasi Secara Elektronik', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1548, 1516, 'Teroperasinya dan Terpeliharanya Pelabuhan Pengumpan Lokal', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1549, 1517, 'Terawasinya Pengoperasian Pelabuhan Pengumpan Lokal', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

-- Table: renstra_sub_kegiatan_indikator (45 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1569, 1473, 1505, 52, 'Jumlah                   Dokumen Perencanaan        Perangkat
Daerah', 'Dokumen', '2', '2', '5000000.00', '2', '6000000.00', '2', '6000000.00', '2', '7000000.00', '2', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1570, 1474, 1506, 52, 'Jumlah  Dokumen  RKA-SKPD dan  Laporan  Hasil  Koordinas Penyusunan   Dokumen   RKA-SKPD', 'Dokumen', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '7000000.00', '1', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1571, 1475, 1507, 52, 'Jumlah                   Dokumen Perubahan  RKA-SKPD  dan Laporan    Hasil    Koordinasi Penyusunan  Dokumen Perubahan          RKA-SKPD', 'Dokumen', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '7000000.00', '1', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1572, 1476, 1508, 52, 'Jumlah Dokumen DPA-SKPD dan           Laporan         Hasi Koordinasi  Penyusunan
Dokumen DPA-SKPD', 'Dokumen', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '7000000.00', '1', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1573, 1477, 1509, 52, 'Jumlah                 Dokumen Perubahan        DPA-SKPD dan        Laporan        Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '7000000.00', '1', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1574, 1478, 1510, 52, 'Jumlah Laporan Evaluasi
Kinerja Perangkat Daerah', 'Laporan', '2', '2', '25000000.00', '2', '35000000.00', '2', '36000000.00', '2', '37000000.00', '2', '37000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1575, 1479, 1511, 52, 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', '58', '55', '5505988054.00', '55', '5540548845.00', '55', '5817576287.00', '55', '6108455101.00', '55', '6413877856.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1576, 1480, 1512, 52, 'Jumlah      Dokumen      Hasil Penyediaan         Administrasi
Pelaksanaan Tugas ASN', 'Dokumen', '12', '12', '162600000.00', '12', '175770000.00', '12', '184558500.00', '12', '193786425.00', '12', '203475746.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1577, 1481, 1513, 52, 'Jumlah Laporan Keuangan Akhir   Tahun   SKPD   dan Laporan   Hasil   Koordinasi Penyusunan           Laporan
Keuangan Akhir  Tahun SKPD', 'Laporan', '1', '1', '5000000.00', '1', '7000000.00', '1', '7000000.00', '1', '8000000.00', '1', '8000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1578, 1482, 1514, 52, 'Jumlah  Laporan  Rekonsiliasi dan    Penyusunan    Laporan Barang   Milik   Daerah   pada SKPD', 'Laporan', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '7000000.00', '1', '7000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1579, 1483, 1515, 52, 'Jumlah                 Dokumen
Pendataan                    dan Pengolahan Administrasi Kepegawaian', 'Dokumen', '1', '1', '5000000.00', '1', '6000000.00', '1', '6000000.00', '1', '6000000.00', '1', '6000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1580, 1484, 1516, 52, 'Jumlah                 Dokumen Monitoring,   Evaluasi,   dan
Penilaian Kinerja  Pegawai', 'Dokumen', '12', '12', '0.00', '12', '12000000.00', '12', '12000000.00', '12', '13000000.00', '12', '13000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1581, 1485, 1517, 52, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor  yang Disediakan', 'Paket', '10', '10', '10000000.00', '10', '20000000.00', '10', '22000000.00', '10', '24000000.00', '10', '24000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1582, 1486, 1518, 52, 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', '9', '9', '10000000.00', '9', '12000000.00', '9', '12000000.00', '9', '15000000.00', '9', '15000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1583, 1487, 1519, 52, 'Jumlah Paket Bahan
Logistik Kantor yang Disediakan', 'Paket', '14', '14', '60000000.00', '14', '90000000.00', '14', '95000000.00', '14', '105000000.00', '14', '105000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1584, 1488, 1520, 52, 'Jumlah       Paket       Barang Cetakan dan Penggandaan
yang Disediakan', 'Paket', '15', '15', '160000000.00', '15', '160000000.00', '15', '165000000.00', '15', '175000000.00', '15', '175000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1585, 1489, 1521, 52, 'Jumlah Dokumen Bahan Bacaan dan Peraturan
Perundang-Undangan yang Disediakan', 'Dokumen', '12', '12', '8500000.00', '12', '9000000.00', '12', '9500000.00', '12', '10000000.00', '12', '10000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1586, 1490, 1522, 52, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '12', '12', '60000000.00', '12', '65000000.00', '12', '70000000.00', '12', '75000000.00', '12', '75000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1587, 1491, 1523, 52, 'Jumlah                    Laporan Penyelenggaraan       Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '12', '12', '90000000.00', '12', '275000000.00', '12', '300000000.00', '12', '350000000.00', '12', '350000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1588, 1492, 1524, 52, 'Jumlah   Unit   Sarana   dan Prasarana   Gedung   Kantor
atau Bangunan Lainnya yang Disediakan', 'Unit', '4', '4', '40850000.00', '5', '70000000.00', '8', '120000000.00', '7', '120000000.00', '6', '60000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1589, 1493, 1525, 52, 'Jumlah Laporan
Penyediaan Jasa Surat Menyurat', 'Laporan', '1', '1', '5000000.00', '1', '5000000.00', '1', '5500000.00', '1', '6000000.00', '1', '6000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1590, 1494, 1526, 52, 'Jumlah Laporan Penyediaan Jasa   Komunikasi,   Sumber
Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '21332205800.00', '12', '20757179001.00', '12', '21179330977.00', '12', '21510834485.00', '12', '21442902942.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1591, 1495, 1527, 52, 'Jumlah Laporan Penyediaan Jasa     Pelayanan     Umum Kantor yang  Disediakan', 'Laporan', '12', '12', '3797492500.00', '12', '3016839450.00', '12', '3280735051.00', '12', '3379771804.00', '12', '3263367240.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1592, 1496, 1528, 52, 'Jumlah                Kendaraan Perorangan     Dinas     atau Kendaraan   Dinas   Jabatan yang        Dipelihara        dan dibayarkan Pajaknya', 'Unit', '49', '49', '314275000.00', '49', '489431320.00', '49', '675337801.00', '49', '675337801.00', '49', '459923532.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1593, 1497, 1529, 52, 'Jumlah   Kendaraan   Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan      Pajak      dan
Perizinannya', 'Unit', '49', '49', '44725000.00', '49', '45000000.00', '49', '48000000.00', '49', '48000000.00', '49', '48000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1594, 1498, 1530, 52, 'Jumlah        Sarana        dan Prasarana   Gedung   Kantor atau     Bangunan     Lainnya
yang Dipelihara/Direhabilitasi', 'Unit', '10', '10', '37410381.00', '10', '64000000.00', '10', '74000000.00', '10', '84000000.00', '10', '84000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1595, 1499, 1531, 52, 'Jumlah                  Dokumen
Penyusunan           Rencana Induk       Jaringan       LLAJ Kabupaten/Kota', 'Dokumen', '1', '1', '0.00', '', '0.00', '1', '250000000.00', '', '0.00', '1', '275000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1596, 1500, 1532, 52, 'Jumlah Perlengkapan Jalan di Jalan Kabupaten/Kota
yang Tersedia', 'Unit', '1390', '125', '2008599435.00', '213', '9937600000.00', '238', '4049734681.00', '404', '7270800000.00', '112', '2010800000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1597, 1501, 1533, 52, 'Jumlah Prasarana Jalan yang Terehabilitasi dan
Terpelihara', 'Unit', '23', '25', '278250000.00', '28', '280000000.00', '32', '290000000.00', '37', '315000000.00', '42', '300000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1598, 1502, 1534, 52, 'Jumlah Perlengkapan Jalan yang Terehabilitasi dan
Terpelihara', 'Unit', '500', '610', '750000000.00', '632', '760000000.00', '654', '760000000.00', '675', '810000000.00', '682', '810000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1599, 1503, 1535, 52, 'Jumlah   Terminal   Tipe   C (Fasilitas       Utama       dan Penunjang)                   yang terehabilitasi dan terpelihara', 'Unit', '1', '1', '100000000.00', '1', '400000000.00', '1', '400000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1600, 1504, 1536, 52, 'Jumlah  Laporan  Koordinasi dan                    Sinkronisasi Pengawasan    Pelaksanaan Izin   Penyelenggaraan   dan Terbangunnya  Fasilitas Parkir               Kewenangan
Kabupaten/Kota', 'Laporan', '12', '12', '1290000000.00', '12', '1550000000.00', '12', '1600000000.00', '12', '1650000000.00', '12', '1650000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1601, 1505, 1537, 52, 'Jumlah      Sumber      Daya Manusia  Pengujian  Berkala Kendaraan Bermotor yang Ditingkatkan Kapasitasnya', 'orang', '', '4', '60000000.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1602, 1506, 1538, 52, 'Jumlah     Dokumen     Bukti Lulus Uji Pengujian Berkala
Kendaraan Bermotor', 'Dokumen', '6408', '4200', '105000000.00', '2400', '62400000.00', '2400', '64800000.00', '2400', '67200000.00', '2400', '67200000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1603, 1507, 1539, 52, 'Jumlah        Sarana        dan Prasarana             Pengujian
Berkala                Kendaraan
Bermotor  yang  Terpelihara', 'Unit', '11', '11', '85000000.00', '11', '87000000.00', '11', '88000000.00', '11', '90000000.00', '11', '90000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1604, 1508, 1540, 52, 'Jumlah                    Laporan Pengawasan                  dan Pengendalian        Efektivitas Pelaksanaan         Kebijakan
untuk Jalan Kabupaten/Kota', 'Laporan', '1', '1', '270000000.00', '1', '165000000.00', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1605, 1509, 1541, 52, 'Jumlah laporan Forum Lalu Lintas  dan  Angkutan  Jalan
untuk Jaringan Jalan Kabupaten/Kota', 'Laporan', '1', '1', '59300000.00', '1', '275000000.00', '1', '300000000.00', '1', '300000000.00', '1', '300000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1606, 1510, 1542, 52, 'Jumlah Perlengkapan Jalan dalam  Rangka  Manajemen dan  Rekayasa  Lalu  Lintas yang                dilaksanakan
pengadaan                    dan Pemasangan', 'Dokumen', '1', '1', '75000000.00', '1', '410000000.00', '1', '425000000.00', '1', '425000000.00', '1', '425000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1607, 1511, 1543, 52, 'Jumlah                     laporan pelaksanaan         Penataan Manajemen  dan  Rekayasa Lalu  Lintas  Untuk  Jaringan
Jalan Kabupaten/Provinsi', 'Laporan', '1', '1', '60000000.00', '1', '80000000.00', '1', '80000000.00', '1', '80000000.00', '1', '80000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1608, 1512, 1544, 52, 'Jumlah Laporan Koordinasi dan  Sinkronisasi  Penilaian Hasil Andalalin', 'Laporan', '9', '4', '5000000.00', '5', '18000000.00', '6', '18000000.00', '7', '19000000.00', '8', '19000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1609, 1513, 1545, 52, 'Jumlah   laporan   Inspeksi, Audit     dan     Pemantauan Sistem               Manajemen Keselamatan  Perusahaan Angkutan Umum', 'Laporan', '1', '1', '15000000.00', '1', '28000000.00', '1', '28000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1610, 1514, 1546, 52, 'Jumlah                    Laporan Pengendalian                dan Pengawasan   Ketersediaan Angkutan     Umum     untuk Jasa      Angkutan      Orang dan/atau    Barang       Antar
Kota dalam 1  (Satu) Kabupaten/Kota', 'Laporan', '1', '1', '100000000.00', '1', '230000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1611, 1515, 1547, 52, 'Jumlah                    Laporan Pemenuhan       Persyaratan Perolehan                      Izin
Penyelenggaraan Angkutan Orang        dalam Trayek Kewenangan Kabupaten/Kota         dalam Sistem                Pelayanan
Perizinan              Berusaha
Terintegrasi              Secara Elektronik', 'Unit', '1', '1', '15000000.00', '1', '17000000.00', '1', '17000000.00', '1', '18000000.00', '1', '18000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1612, 1516, 1548, 52, 'Jumlah  Pelabuhan Pengumpan Lokal  yang Beroperasi dan Terpelihara', 'Unit', '1', '1', '0.00', '1', '275000000.00', '1', '275000000.00', '1', '275000000.00', '1', '275000000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL),
  (1613, 1517, 1549, 52, 'Jumlah   Laporan PengawasanPengoperasian Pelabuhan  Pengumpan Lokal', 'Laporan', '1', '1', '55000000.00', '1', '62700000.00', '1', '62700000.00', '1', '62700000.00', '1', '62700000.00', 10, '2026-09-24 12:57:29', '2026-09-24 12:57:29', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
