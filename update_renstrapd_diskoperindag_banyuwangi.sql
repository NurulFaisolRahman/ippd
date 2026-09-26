-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: DINAS KOPERASI, USAHA MIKRO DAN PERDAGANGAN BANYUWANGI
-- ID INSTANSI: 103 | KODE: 2.17.3.30.0.00.01.0000 | URUSAN: 2.17,3.30
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-26 18:32:22
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (DINAS KOPERASI, USAHA MIKRO DAN PERDAGANGAN BANYUWANGI) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (103, '2.17.3.30.0.00.01.0000', '35.10', 'DINAS KOPERASI, USAHA MIKRO DAN PERDAGANGAN BANYUWANGI', '2.17,3.30', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, '2026-09-21 12:44:13', '2026-09-26 13:42:19', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA DINAS KOPERASI, USAHA MIKRO DAN PERDAGANGAN BANYUWANGI SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2111, 2112, 2113, 2114, 2115, 2116, 2117, 2118, 2119, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133, 2134, 2135, 2136, 2137, 2138, 2139, 2140, 2141, 2142, 2143, 2144, 2145, 2146, 2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2111, 2112, 2113, 2114, 2115, 2116, 2117, 2118, 2119, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133, 2134, 2135, 2136, 2137, 2138, 2139, 2140, 2141, 2142, 2143, 2144, 2145, 2146, 2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (508, 509, 510, 511, 512, 513, 514, 515, 516, 517, 518, 519, 520, 521, 522, 523, 524, 525, 526, 527, 528, 529);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (508, 509, 510, 511, 512, 513, 514, 515, 516, 517, 518, 519, 520, 521, 522, 523, 524, 525, 526, 527, 528, 529);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (508, 509, 510, 511, 512, 513, 514, 515, 516, 517, 518, 519, 520, 521, 522, 523, 524, 525, 526, 527, 528, 529);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 160);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 160);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 160);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (82, 83, 84, 85);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (82, 83, 84, 85);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (31);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (31);
DELETE FROM `renstra_tujuan` WHERE `id` IN (31) OR (`id_instansi` = 103 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD DINAS KOPERASI, USAHA MIKRO DAN PERDAGANGAN BANYUWANGI
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (31, '35.10', 103, '48', 'Meningkatnya daya saing sektor koperasi, usaha mikro dan perdagangan', NULL, NULL, 'Kontribusi Sektor Perdagangan terhadap PDRB', '%', NULL, '17.95', '18.1', '18.25', '18.4', '18.55', '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (47, 31, NULL, 'Kontribusi Sektor Perdagangan terhadap PDRB', '%', NULL, NULL, '17.95', '18.1', '18.25', '18.4', '18.55', 1, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

-- Table: renstra_sasaran (4 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (82, 31, 'Meningkatnya Akuntabilitas dan kualitas Pelayanan Perangkat Daerah', NULL, NULL, 'Nilai SAKIP Perangkat Daerah', 'Angka', NULL, '91.1', '91.2', '91.3', '91.4', '91.5', '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (83, 31, 'Meningkatnya kualitas koperasi', NULL, NULL, 'Persentase koperasi berkualitas', '%', NULL, '53.99', '54.19', '54.39', '54.59', '54.79', '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (84, 31, 'Meningkatnya skala usaha mikro', NULL, NULL, 'Persentase usaha mikro naik kelas', '%', NULL, '37.73', '38.23', '38.73', '39.23', '39.73', '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (85, 31, 'Meningkat nya kinerja sektor perdagangan', NULL, NULL, 'Laju Pertumbuhan Indeks Harga Implisit PDRB', '%', NULL, '2.61', '2.71', '2.81', '2.91', '3.01', '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (5 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (127, 82, NULL, 'Nilai SAKIP Perangkat Daerah', 'Angka', NULL, NULL, '91.1', '91.2', '91.3', '91.4', '91.5', 1, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (128, 82, NULL, 'Indeks Kepuasan Masyarakat', 'Indeks', NULL, NULL, '93', '93.5', '94', '94.5', '95', 1, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (129, 83, NULL, 'Persentase koperasi berkualitas', '%', NULL, NULL, '53.99', '54.19', '54.39', '54.59', '54.79', 1, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (130, 84, NULL, 'Persentase usaha mikro naik kelas', '%', NULL, NULL, '37.73', '38.23', '38.73', '39.23', '39.73', 1, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (131, 85, NULL, 'Laju Pertumbuhan Indeks Harga Implisit PDRB', '%', NULL, NULL, '2.61', '2.71', '2.81', '2.91', '3.01', 1, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

-- Table: renstra_program (13 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (148, 82, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '2.17.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '92', '92', '92', '92', '92', NULL, '14490296021.00', '14517675000.00', '14518777600.00', '14606649200.00', '14998027700.00'),
  (149, 83, 'PROGRAM PENGAWASAN DAN PEMERIKSAAN KOPERASI', '2.17.03', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '88.22', '89', '91', '92', '93', NULL, '62000000.00', '62117200.00', '62121900.00', '62497800.00', '64172400.00'),
  (150, 83, 'PROGRAM PENILAIAN KESEHATAN KSP/USP KOPERASI', '2.17.04', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '46', '47', '48', '49', '50', NULL, '20000000.00', '20037800.00', '20039300.00', '20160600.00', '20700800.00'),
  (151, 83, 'PROGRAM PENDIDIKAN DAN LATIHAN PERKOPERASIAN', '2.17.05', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '10', '15', '20', '25', '30', NULL, '120000000.00', '120037800.00', '120039300.00', '120160600.00', '120700800.00'),
  (152, 83, 'PROGRAM PEMBERDAYAAN DAN PERLINDUNGAN KOPERASI', '2.17.06', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '17.5', '18', '18.5', '19', '19.5', NULL, '182000000.00', '182155000.00', '182161200.00', '182658400.00', '184873200.00'),
  (153, 84, 'PROGRAM PEMBERDAYAAN USAHA MENENGAH, USAHA KECIL, DAN USAHA MIKRO (UMKM)', '2.17.07', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '76', '77', '78', '79', '80', NULL, '2087000000.00', '2091321200.00', '2091495200.00', '2105364000.00', '2167135300.00'),
  (154, 84, 'PROGRAM PENGEMBANGAN UMKM', '2.17.08', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '38', '39', '41', '42', '43', NULL, '899000000.00', '900698600.00', '900767000.00', '906218700.00', '930500400.00'),
  (155, 85, 'PROGRAM PERIZINAN DAN PENDAFTARAN PERUSAHAAN', '3.30.02', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '266000000.00', '266502500.00', '266522700.00', '268135800.00', '275320400.00'),
  (156, 85, 'PROGRAM PENINGKATAN SARANA DISTRIBUSI PERDAGANGAN', '3.30.03', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '25', '35', '45', '55', '65', NULL, '1837000000.00', '1840470900.00', '1840610600.00', '1851750500.00', '1901367300.00'),
  (157, 85, 'PROGRAM STABILISASI HARGA BARANG KEBUTUHAN POKOK DAN BARANG PENTING', '3.30.04', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '5.13', '5.12', '5.11', '5.1', '5', NULL, '1735000000.00', '1738278100.00', '1738410100.00', '1748931300.00', '1795793100.00'),
  (158, 85, 'PROGRAM PENGEMBANGAN', '3.30.05', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '176.38', '177.26', '178.15', '179.04', '179.93', NULL, '302000000.00', '302570600.00', '302593600.00', '304425000.00', '312582000.00'),
  (159, 85, 'PROGRAM STANDARDISASI DAN PERLINDUNGAN KONSUMEN', '3.30.06', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '20.5', '20.75', '21', '21.25', '21.5', NULL, '290000000.00', '290547900.00', '290570000.00', '292328600.00', '300161400.00'),
  (160, 85, 'PROGRAM PENGGUNAAN DAN PEMASARAN PRODUK DALAM NEGERI', '3.30.07', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, NULL, '13.89', '14.86', '15.83', '16.79', '17.76', NULL, '73000000.00', '73137900.00', '73143500.00', '73586200.00', '75557900.00');

-- Table: renstra_program_outcome (13 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (194, 148, 'Terpenuhinya penunjang urusan Perangkat Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (195, 149, 'Meningkatnya Kapasitas Kelembagaan Koperasi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (196, 150, 'Meningkatnya KSP/USP Sehat', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (197, 151, 'Meningkatnya Kompetensi SDM Pengelola Koperasi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (198, 152, 'Meningkatnya Kapasitas Usaha Koperasi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (199, 153, 'Meningkatnya Kapasitas SDM dan Kelembagaan Usaha Mikro', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (200, 154, 'Meningkatnya Penjualan Usaha Mikro', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (201, 155, 'Meningkatnya Pasar Tertib Niaga', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (202, 156, 'Meningkatnya Kualitas Sarana Distribusi Perdagangan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (203, 157, 'Meningkatnya Stabilisasi Harga Barang Kebutuhan Pokok dan Barang Penting', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (204, 158, 'Meningkatnya Volume Ekspor', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (205, 159, 'Meningkatnya Pasar Tertib Niaga', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (206, 160, 'Meningkatnya Volume Perdagangan Dalam Negeri', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

-- Table: renstra_program_indikator (13 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (313, 148, 194, 103, 'Persentase pemenuhan kebutuhan penunjang Perangkat Daerah', '%', '92', '92', '92', '92', '92', '92', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (314, 149, 195, 103, 'Persentase Koperasi Aktif', '', '87.22', '88.22', '89', '91', '92', '93', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (315, 150, 196, 103, 'Persentase KSP/USP Sehat', '', '44.86', '46', '47', '48', '49', '50', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (316, 151, 197, 103, 'Persentase Pengurus dan Pengawas Bersertifikat Kompetensi', '', '5', '10', '15', '20', '25', '30', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (317, 152, 198, 103, 'Pertumbuhan Volume Usaha Koperasi', '', '76.98', '17.5', '18', '18.5', '19', '19.5', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (318, 153, 199, 103, 'Persentase Usaha Mikro yang Bertransforma si dari Informal ke Formal', '', '74.07', '76', '77', '78', '79', '80', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (319, 154, 200, 103, 'Persentase usaha mikro yang meningkat nilai omset', '', '36.73', '38', '39', '41', '42', '43', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (320, 155, 201, 103, 'Persentase Izin Usaha Perdagangan yang Difasilitasi', '', '100', '100', '100', '100', '100', '100', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (321, 156, 202, 103, 'Persentase sarana distribusi perdagangan yang mengalami
peningkatan Kualitas', '', '20', '25', '35', '45', '55', '65', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (322, 157, 203, 103, 'Persentase koefisien variasi harga antar waktu per komoditas bahan pokok', '', '5.14', '5.13', '5.12', '5.11', '5.1', '5', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (323, 158, 204, 103, 'Jumlah realisasi ekspor (dalam Juta U$$)', '', '175.5', '176.38', '177.26', '178.15', '179.04', '179.93', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (324, 159, 205, 103, 'Persentase alat ukur takar timbang dan perlengkapan nya (UTTP) bertanda tera sah yang berlaku', '', '20.31', '20.5', '20.75', '21', '21.25', '21.5', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10),
  (325, 160, 206, 103, 'Persentase Promosi Produk Lokal yang difasilitasi', '', '12.93', '13.89', '14.86', '15.83', '16.79', '17.76', NULL, NULL, NULL, NULL, NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 10);

-- Table: renstra_kegiatan (22 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (508, 148, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '2.17.01.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '7', '1', '7', '7', '7', NULL, '100000000.00', '100189000.00', '100196600.00', '100803000.00', '103504000.00'),
  (509, 148, 'Administrasi Keuangan Perangkat Daerah', '2.17.01.2.02', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '9246196021.00', '9263666300.00', '9264369800.00', '9320440300.00', '9570177400.00'),
  (510, 148, 'Administrasi Umum Perangkat Daerah', '2.17.01.2.06', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', '2', '2', NULL, '1306800000.00', '1309250400.00', '1309349000.00', '1317213000.00', '1352239100.00'),
  (511, 148, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '2.17.01.2.07', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '10', '10', '10', '10', '10', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (512, 148, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '2.17.01.2.08', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1', NULL, '3230300000.00', '3236403500.00', '3236649400.00', '3256238500.00', '3343487900.00'),
  (513, 148, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '2.17.01.2.09', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '20', '20', '20', '20', '20', NULL, '532000000.00', '533165800.00', '533212800.00', '536954400.00', '553619300.00'),
  (514, 149, 'Pemeriksaan dan Pengawasan Koperasi, Koperasi Simpan Pinjam/Unit Simpan Pinjam Koperasi yang Wilayah Keanggotaannya dalam Daerah Kabupaten/ Kota', '2.17.03.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '60', '60', '60', '60', '60', NULL, '62000000.00', '62117200.00', '62121900.00', '62497800.00', '64172400.00'),
  (515, 150, 'Penilaian Kesehatan Koperasi Simpan Pinjam/Unit Simpan Pinjam Koperasi yang Wilayah Keanggotaanya dalam 1 (Satu) Daerah Kabupaten/Kota', '2.17.04.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '185', '190', '195', '200', '205', NULL, '20000000.00', '20037800.00', '20039300.00', '20160600.00', '20700800.00'),
  (516, 151, 'Pendidikan dan Latihan Perkoperasian Bagi Koperasi yang Wilayah Keanggotaan dalam Daerah Kabupaten/Kota', '2.17.05.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '100', '100', '100', '100', '100', NULL, '120000000.00', '120037800.00', '120039300.00', '120160600.00', '120700800.00'),
  (517, 152, 'Pemberdayaan dan Perlindungan Koperasi yang Keanggotaannya dalam Daerah Kabupaten/Kota', '2.17.06.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '217', '217', '217', '217', '217', NULL, '182000000.00', '182155000.00', '182161200.00', '182658400.00', '184873200.00'),
  (518, 153, 'Pemberdayaan Usaha Mikro yang Dilakukan Melalui Pendataan, Kemitraan, Kemudahan Perizinan, Penguatan Kelembagaan dan Koordinasi dengan Para Pemangku Kepentingan', '2.17.07.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '9', '9', '9', '9', '9', NULL, '2087000000.00', '2091321200.00', '2091495200.00', '2105364000.00', '2167135300.00'),
  (519, 154, 'Pengembangan Usaha Mikro dengan Orientasi Peningkatan Skala Usaha Menjadi Usaha Kecil', '2.17.08.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '2540', '2.6', '2.65', '2.7', '2.75', NULL, '899000000.00', '900698600.00', '900767000.00', '906218700.00', '930500400.00'),
  (520, 155, 'Penerbitan Tanda Daftar Gudang', '3.30.02.2.02', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '15', '15', '15', '15', '15', NULL, '24000000.00', '24045300.00', '24047100.00', '24192600.00', '24840800.00'),
  (521, 155, 'Pengendalian Fasilitas Penyimpanan Bahan Berbahaya dan Pengawasan Distribusi, Pengemasan dan Pelabelan Bahan Berbahaya di Tingkat Daerah Kabupaten/ Kota', '3.30.02.2.06', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '121000000.00', '121228600.00', '121237800.00', '121971600.00', '125239800.00'),
  (522, 155, 'Penerbitan Surat Keterangan Asal (bagi Daerah Kabupaten/Kota yang Telah Ditetapkan sebagai Instansi Penerbit Surat Keterangan Asal)', '3.30.02.2.07', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '1200', '1.21', '1.22', '1.23', '1.24', NULL, '121000000.00', '121228600.00', '121237800.00', '121971600.00', '125239800.00'),
  (523, 156, 'Pembangunan dan Pengelolaan Sarana Distribusi Perdagangan', '3.30.03.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '20', '20', '20', '20', '20', NULL, '1837000000.00', '1840470900.00', '1840610600.00', '1851750500.00', '1901367300.00'),
  (524, 157, 'Menjamin Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Daerah Kabupaten/ Kota', '3.30.04.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '24000000.00', '24045300.00', '24047100.00', '24192600.00', '24840800.00'),
  (525, 157, 'Pengendalian Harga, dan Stok Barang Kebutuhan Pokok dan Barang Penting di Tingkat Pasar Kabupaten/Kota', '3.30.04.2.02', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '1687000000.00', '1690187500.00', '1690315900.00', '1700546100.00', '1746111500.00'),
  (526, 157, 'Pengawasan Pupuk dan Pestisida Bersubsidi di Tingkat Daerah Kabupaten/Kota', '3.30.04.2.03', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '12', '12', '12', '12', '12', NULL, '24000000.00', '24045300.00', '24047100.00', '24192600.00', '24840800.00'),
  (527, 158, 'Penyelenggaraan Promosi Dagang Melalui Pameran Dagang dan Misi Dagang bagi Produk Ekspor Unggulan yang Terdapat pada 1 (Satu) Daerah Kabupaten/Kota', '3.30.05.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '3', '3', '3', '3', '3', NULL, '302000000.00', '302570600.00', '302593600.00', '304425000.00', '312582000.00'),
  (528, 159, 'Pelaksanaan Metrologi Legal, Berupa Tera, Tera Ulang, dan Pengawasan', '3.30.06.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '14000', '14200', '14400', '14500', '14700', NULL, '290000000.00', '290547900.00', '290570000.00', '292328600.00', '300161400.00'),
  (529, 160, 'Pelaksanaan Promosi, Pemasaran dan Peningkatan Penggunaan Produk Dalam Negeri', '3.30.07.2.01', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, NULL, NULL, NULL, NULL, '67', '67', '67', '67', '67', NULL, '73000000.00', '73137900.00', '73143500.00', '73586200.00', '75557900.00');

-- Table: renstra_kegiatan_sasaran (22 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (552, 508, 'Terlaksananya Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (553, 509, 'Terlaksananya Administrasi Keuangan Perangkat Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (554, 510, 'Terlaksanakannya Administrasi Umum Perangkat Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (555, 511, 'Terlaksananya pengadaan barang milik daerah penunjang urusan pemerintah daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (556, 512, 'Terlaksananya Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (557, 513, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (558, 514, 'Terlaksananya Pengawasan dan Pemeriksaan Koperasi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (559, 515, 'Terlaksananya Penilaian Kesehatan Koperasi Simpan Pinjam/Unit Simpan Pinjam Koperasi yang Wilayah Keanggotaanya dalam 1 (Satu) Daerah Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (560, 516, 'Terlaksananya Pendidikan dan Latihan Perkoperasian Bagi Koperasi yang Wilayah Keanggotaan dalam Daerah Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (561, 517, 'Terlaksananya Pemberdayaan dan Perlindungan Koperasi yang Keanggotaannya dalam Daerah Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (562, 518, 'Terlaksananya Pemberdayaan Usaha Mikro yang Dilakukan Melalui Pendataan, Kemitraan, Kemudahan Perizinan, Penguatan Kelembagaan dan Koordinasi dengan Para Pemangku Kepentingan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (563, 519, 'Terlaksananya Pengembangan Usaha Mikro dengan Orientasi Peningkatan Skala Usaha Menjadi Usaha Kecil', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (564, 520, 'Cakupan Penerbitan Tanda Daftar Gudang', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (565, 521, 'Cakupan Pengendalian Fasilitas Penyimpanan Bahan Berbahaya dan Pengawasan Distribusi, Pengemasan dan Pelabelan Bahan Berbahaya di Tingkat Daerah Kabupaten/ Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (566, 522, 'Cakupan Penerbitan Surat Keterangan Asal (bagi Daerah Kabupaten/Kota yang Telah Ditetapkan sebagai Instansi Penerbit Surat Keterangan Asal)', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (567, 523, 'Cakupan Pembangunan dan Pengelolaan Sarana Distribusi Perdagangan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (568, 524, 'Terjaminnya Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Daerah Kabupaten/ Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (569, 525, 'Terjaminnya Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Daerah Kabupaten/ Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (570, 526, 'Terlaksananya Pengawasan Pupuk dan Pestisida Bersubsidi di Tingkat Daerah Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (571, 527, 'Terselenggaranya Promosi Dagang Melalui Pameran Dagang dan Misi Dagang bagi Produk Ekspor Unggulan yang Terdapat pada 1 (Satu) Daerah Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (572, 528, 'Terlaksananya Metrologi Legal, Berupa Tera, Tera Ulang, dan Pengawasan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (573, 529, 'Terlaksananya Promosi, Pemasaran dan Peningkatan Penggunaan Produk Dalam Negeri', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

-- Table: renstra_kegiatan_indikator (45 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2032, 508, 552, 103, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '', '6', '7', '100000000.00', '1', '100189000.00', '7', '0.00', '7', '100803000.00', '7', '103504000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2033, 508, 552, 103, 'Jumlah Dokumen Perencanaan
Perangkat Daerah', '', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '2', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2034, 509, 553, 103, 'Jumlah Laporan Keuangan Bulanan/Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triw ulanan/Seme
steran SKPD', '', '12', '12', '9246196021.00', '12', '9263666300.00', '12', '9264369800.00', '12', '9320440300.00', '12', '9570177400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2035, 509, 553, 103, 'Jumlah Orang yang Menerima Gaji dan Tunjangan
ASN', '', '47', '47', '0.00', '47', '0.00', '47', '9264369800.00', '47', '0.00', '47', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2036, 510, 554, 103, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang
Disediakan', '', '1132', '2', '1306800000.00', '2', '1309250400.00', '2', '0.00', '2', '1317213000.00', '2', '1352239100.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2037, 510, 554, 103, 'Jumlah Paket Peralatan Rumah
Tangga yang Disediakan', '', '857', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2038, 510, 554, 103, 'Jumlah Paket Komponen Instalasi Listrik/Penera ngan Bangunan Kantor yang
Disediakan', '', '488', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2039, 510, 554, 103, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', '', '6190', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 40, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2040, 510, 554, 103, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', '', '20743', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', 50, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2041, 510, 554, 103, 'Jumlah Laporan Penyelenggar aan Rapat Koordinasi dan Konsultasi SKPD', '', '60', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 60, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2042, 510, 554, 103, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang- Undangan yang Disediakan', '', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 70, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2043, 511, 555, 103, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Disediakan', '', '', '10', '75000000.00', '10', '75000000.00', '10', '0.00', '10', '75000000.00', '10', '75000000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2044, 511, 555, 103, 'Jumlah Paket Mebel yang Disediakan', '', '', '44', '0.00', '44', '0.00', '44', '0.00', '44', '0.00', '44', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2045, 512, 556, 103, 'Jumlah Laporan Penyediaan Jasa Surat
Menyurat', '', '1', '1', '3230300000.00', '1', '3236403500.00', '1', '3236649400.00', '1', '3256238500.00', '1', '3343487900.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2046, 512, 556, 103, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', '', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2047, 512, 556, 103, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang
Disediakan', '', '60', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2048, 513, 557, 103, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Dir
ehabilitasi', '', '20', '20', '532000000.00', '20', '533165800.00', '20', '0.00', '20', '536954400.00', '20', '553619300.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2049, 513, 557, 103, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Dir
ehabilitasi', '', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2050, 513, 557, 103, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', '', '29', '29', '0.00', '29', '0.00', '29', '0.00', '29', '0.00', '29', '0.00', 30, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2051, 513, 557, 103, 'Jumlah Mebel yang
Dipelihara', '', '', '40', '0.00', '40', '0.00', '40', '0.00', '40', '0.00', '40', '0.00', 40, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2052, 513, 557, 103, 'Jumlah Peralatan dan Mesin
Lainnya yang Dipelihara', '', '16', '16', '0.00', '16', '0.00', '16', '0.00', '16', '0.00', '16', '0.00', 50, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2053, 514, 558, 103, 'Jumlah Koperasi yang Dilakukan Penguatan Tata Kelola Kelembagaan
Koperasi', '', '', '60', '62000000.00', '60', '62117200.00', '60', '62121900.00', '60', '62497800.00', '60', '64172400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2054, 514, 558, 103, 'Jumlah Koperasi yang telah dilakukan Pemeriksaan
dan Pengawasan', '', '1002', '1219', '0.00', '1219', '0.00', '1219', '0.00', '1219', '0.00', '1219', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2055, 515, 559, 103, 'Jumlah Unit Usaha Koperasi yang Telah Dilakukan Penilaian Kesehatan', '', '185', '185', '20000000.00', '190', '20037800.00', '195', '20039300.00', '200', '20160600.00', '205', '20700800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2056, 516, 560, 103, 'Jumlah SDM yang Memahami Pengetahuan
Perkoperasia n', '', '50', '100', '120000000.00', '100', '120037800.00', '100', '120039300.00', '100', '120160600.00', '100', '120700800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2057, 517, 561, 103, 'Pembinaan dan/atau Pendampinga n yang dilaksanakan', '', '', '217', '182000000.00', '217', '182155000.00', '217', '182161200.00', '217', '182658400.00', '217', '184873200.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2058, 517, 561, 103, 'Koperasi dengan Keanggotaan Daerah
Kabupaten/Ko ta', '', '50', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2059, 518, 562, 103, 'Jumlah Unit Usaha yang Telah Menerima Pembinaan dan Pendampinga n Terhadap
Usaha Mikro', '', '9', '9', '2087000000.00', '9', '2091321200.00', '9', '2091495200.00', '9', '2105364000.00', '9', '2167135300.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2060, 518, 562, 103, 'Jumlah SDM yang Memahami Pengetahuan Usaha Mikro dan Kewirausahaan', '', '', '500', '0.00', '560', '0.00', '600', '2091495200.00', '640', '0.00', '700', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2061, 518, 562, 103, 'Jumlah Usaha Mikro yang Telah
Mendapatkan Perizinan', '', '100', '100', '0.00', '100', '0.00', '100', '2091495200.00', '100', '0.00', '100', '0.00', 30, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2062, 519, 563, 103, 'Jumlah Usaha Mikro yang Terfasilitasi', '', '3040', '2540', '899000000.00', '2.6', '900698600.00', '2.65', '900767000.00', '2.7', '906218700.00', '2.75', '930500400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2063, 520, 564, 103, 'Jumlah Dokumen Tanda Daftar Gudang', '', '15', '15', '24000000.00', '15', '24045300.00', '15', '0.00', '15', '24192600.00', '15', '24840800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2064, 521, 565, 103, 'Jumlah Laporan Hasil Pengawasan Distribusi, Pengemasan dan  Pelabelan Bahan Berbahaya Terhadap Distributor B2, Pengguna Akhir Bahan Berbahaya (PA-B2) maupun Produsen B2 (P-B2)', '', '', '12', '121000000.00', '12', '121228600.00', '12', '0.00', '12', '121971600.00', '12', '125239800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2065, 522, 566, 103, 'Jumlah Dokumen Penerbitan Surat Keterangan Asal', '', '1158', '1200', '121000000.00', '1.21', '121228600.00', '1.22', '121237800.00', '1.23', '121971600.00', '1.24', '125239800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2066, 523, 567, 103, 'Jumlah Sarana Distribusi
Perdagangan', '', '20', '20', '1837000000.00', '20', '1840470900.00', '20', '1840610600.00', '20', '1851750500.00', '20', '1901367300.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2067, 523, 567, 103, 'Jumlah Fasilitasi Pengelolaan Sarana
Distribusi Perdagangan', '', '20', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2068, 524, 568, 103, 'Jumlah Laporan Pengendalian Stok atau Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Agen dan Pasar
Rakyat', '', '12', '12', '24000000.00', '12', '24045300.00', '12', '24047100.00', '12', '24192600.00', '12', '24840800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2069, 525, 569, 103, 'Jumlah Laporan Pemantauan Harga dan Stok Barang Kebutuhan Pokok dan Barang Penting pada Pasar Rakyat yang Terintegrasi dalam Sistem Informasi
Perdagangan', '', '12', '12', '1687000000.00', '12', '1690187500.00', '12', '1690315900.00', '12', '1700546100.00', '12', '1746111500.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2070, 525, 569, 103, 'Jumlah Laporan Pelaksanaan Operasi Pasar Reguler dan Pasar Khusus yang Berdampak dalam 1 (Satu) Kabupaten/Kota', '', '30', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2071, 526, 570, 103, 'Jumlah Laporan Pengawasan Penyaluran dan Penggunaan Pupuk dan Pestisida Bersubsidi dengan Realisasi Minimal 90%', '', '12', '12', '24000000.00', '12', '24045300.00', '12', '0.00', '12', '24192600.00', '12', '24840800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2072, 527, 571, 103, 'Jumlah Pelaku Usaha yang Difasilitasi dalam Pameran Dagang', '', '', '3', '302000000.00', '3', '302570600.00', '3', '302593600.00', '3', '304425000.00', '3', '312582000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2073, 527, 571, 103, 'Jumlah Pelaku Usaha yang Difasilitasi dalam Misi Dagang Produk Ekspor Unggulan', '', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2074, 528, 572, 103, 'Jumlah Alat Ukur, Alat Takar, Alat Timbang, dan Alat
Perlengkapan Ditera Ulang', '', '13855', '14000', '290000000.00', '14200', '290547900.00', '14400', '0.00', '14500', '292328600.00', '14700', '300161400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2075, 528, 572, 103, 'Jumlah Pelaku Usaha di Bidang Metrologi Legal yang
Dibina', '', '118', '120', '0.00', '130', '0.00', '140', '0.00', '150', '0.00', '160', '0.00', 20, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2076, 529, 573, 103, 'Jumlah UMKM yang memperoleh fasilitasi Promosi Penggunaan Produk Dalam Negeri di Tingkat
Kabupaten/Kota', '', '67', '67', '73000000.00', '67', '73137900.00', '67', '73143500.00', '67', '73586200.00', '67', '75557900.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

-- Table: renstra_sub_kegiatan (45 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2111, 508, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '2.17.01.2.01.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '2', NULL, '50000000.00', '50094500.00', '50098300.00', '50401500.00', '51752000.00'),
  (2112, 508, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '2.17.01.2.01.0006', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '', NULL, '7', '7', '7', '7', '7', NULL, '50000000.00', '50094500.00', '50098300.00', '50401500.00', '51752000.00'),
  (2113, 509, 'Penyediaan Gaji dan Tunjangan ASN', '2.17.01.2.02.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan
ASN', '', NULL, '47', '47', '47', '47', '47', NULL, '9226196021.00', '9243628500.00', '9244330500.00', '9300279700.00', '9549476600.00'),
  (2114, 509, 'Koordinasi dan Penyusunan Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD', '2.17.01.2.02.0007', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Se mesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Se mesteran SKPD', 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triw ulanan/Seme
steran SKPD', '', NULL, '12', '12', '12', '12', '12', NULL, '20000000.00', '20037800.00', '20039300.00', '20160600.00', '20700800.00'),
  (2115, 510, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '2.17.01.2.06.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penera ngan Bangunan Kantor yang Disediakan', '', NULL, '2', '2', '2', '2', '2', NULL, '40000000.00', '40075600.00', '40078600.00', '40321200.00', '41401600.00'),
  (2116, 510, 'Penyediaan Peralatan dan Perlengkapan Kantor', '2.17.01.2.06.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang
Disediakan', '', NULL, '2', '2', '2', '2', '2', NULL, '200000000.00', '200377900.00', '200393100.00', '201605900.00', '207007800.00'),
  (2117, 510, 'Penyediaan Peralatan Rumah Tangga', '2.17.01.2.06.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', '', NULL, '2', '2', '2', '2', '2', NULL, '200000000.00', '200377900.00', '200393100.00', '201605900.00', '207007800.00'),
  (2118, 510, 'Penyediaan Bahan Logistik Kantor', '2.17.01.2.06.0004', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', '', NULL, '11', '11', '11', '11', '11', NULL, '250000000.00', '250472400.00', '250491400.00', '252007400.00', '258759800.00'),
  (2119, 510, 'Penyediaan Barang Cetakan dan Penggandaan', '2.17.01.2.06.0005', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan
yang Disediakan', '', NULL, '2', '2', '2', '2', '2', NULL, '12000000.00', '12022700.00', '12023700.00', '12096400.00', '12420500.00'),
  (2120, 510, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '2.17.01.2.06.0006', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', '', NULL, '4', '4', '4', '4', '4', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (2121, 510, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '2.17.01.2.06.0009', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggar aan Rapat Koordinasi dan Konsultasi
SKPD', '', NULL, '12', '12', '12', '12', '12', NULL, '594800000.00', '595923900.00', '595969100.00', '599576200.00', '615641600.00'),
  (2122, 511, 'Pengadaan Mebel', '2.17.01.2.07.0005', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang
Disediakan', '', NULL, '44', '44', '44', '44', '44', NULL, '35000000.00', '35000000.00', '35000000.00', '35000000.00', '35000000.00'),
  (2123, 511, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '2.17.01.2.07.0010', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Disediakan', '', NULL, '10', '10', '10', '10', '10', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (2124, 512, 'Penyediaan Jasa Surat Menyurat', '2.17.01.2.08.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat
Menyurat', '', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5009400.00', '5009800.00', '5040100.00', '5175100.00'),
  (2125, 512, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '2.17.01.2.08.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan
Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang
Disediakan', '', NULL, '12', '12', '12', '12', '12', NULL, '600000000.00', '601133700.00', '601179400.00', '604817900.00', '621023700.00'),
  (2126, 512, 'Penyediaan Jasa Pelayanan Umum Kantor', '2.17.01.2.08.0004', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', '', NULL, '12', '12', '12', '12', '12', NULL, '2625300000.00', '2630260400.00', '2630460200.00', '2646380500.00', '2717289100.00'),
  (2127, 513, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '2.17.01.2.09.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', '', NULL, '29', '29', '29', '29', '29', NULL, '137800000.00', '138060400.00', '138072100.00', '138906500.00', '142628400.00'),
  (2128, 513, 'Pemeliharaan Mebel', '2.17.01.2.09.0005', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang
Dipelihara', '', NULL, '40', '40', '40', '40', '40', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (2129, 513, 'Pemeliharaan Peralatan dan Mesin Lainnya', '2.17.01.2.09.0006', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', '', NULL, '16', '16', '16', '16', '16', NULL, '14200000.00', '14226800.00', '14227900.00', '14314000.00', '14697500.00'),
  (2130, 513, 'Pemeliharaan/Rehabilita si Gedung Kantor dan Bangunan Lainnya', '2.17.01.2.09.0009', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Pemeliharaan/Rehabilita si Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Dir
ehabilitasi', '', NULL, '1', '1', '1', '1', '1', NULL, '300000000.00', '300661300.00', '300686700.00', '302810400.00', '312263800.00'),
  (2131, 513, 'Pemeliharaan/Rehabilita si Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '2.17.01.2.09.0010', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Pemeliharaan/Rehabilita si Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Dir ehabilitasi', '', NULL, '20', '20', '20', '20', '20', NULL, '40000000.00', '40217300.00', '40226100.00', '40923500.00', '44029600.00'),
  (2132, 514, 'Penguatan Tata Kelola Kelembagaan Koperasi', '2.17.03.2.01.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Pelaksanaan Penguatan Tata Kelola Kelembagaan Koperasi', 'Jumlah Koperasi yang Dilakukan Penguatan Tata Kelola Kelembagaan
Koperasi', '', NULL, '60', '60', '60', '60', '60', NULL, '41000000.00', '41077500.00', '41080600.00', '41329200.00', '42436600.00'),
  (2133, 514, 'Pelaksanaan Proses Pemeriksaan dan Pengawasan Koperasi yang Wilayah Keanggotaannya Daerah Kabupaten/Kota', '2.17.03.2.01.0004', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Pelaksanaan proses Pemeriksaan dan Pengawasan Koperasi yang Wilayah Keanggotaannya Daerah Kabupaten/ Kota', 'Jumlah Koperasi yang telah dilakukan Pemeriksaan
dan Pengawasan', '', NULL, '1219', '1219', '1219', '1219', '1219', NULL, '21000000.00', '21039700.00', '21041300.00', '21168600.00', '21735800.00'),
  (2134, 515, 'Pelaksanaan Penilaian Kesehatan KSP/USP Koperasi Kewenangan Kabupaten/Kota', '2.17.04.2.01.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Penilaian Kesehatan KSP/USP Koperasi Kewenangan Kabupaten/Kota', 'Jumlah Unit Usaha Koperasi yang Telah Dilakukan Penilaian
Kesehatan', '', NULL, '185', '190', '195', '200', '205', NULL, '20000000.00', '20037800.00', '20039300.00', '20160600.00', '20700800.00'),
  (2135, 516, 'Peningkatan Pemahaman dan Pengetahuan Perkoperasian serta Kapasitas dan Kompetensi SDM Koperasi', '2.17.05.2.01.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Meningkatnya Pemahaman dan Pengetahuan Perkoperasian serta Kapasitas dan Kompetensi SDM Koperasi', 'Jumlah SDM yang Memahami Pengetahuan Perkoperasia n', '', NULL, '100', '100', '100', '100', '100', NULL, '120000000.00', '120037800.00', '120039300.00', '120160600.00', '120700800.00'),
  (2136, 517, 'Pembinaan dan Pendampingan Bagi Keluarga dan Kelompok Masyarakat yang Akan Membentuk Koperasi Dalam Pengembangan Ekonomi', '2.17.06.2.01.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Meningkatnya Penumbuhan Kesadaran Bagi Keluarga dan Kelompok Masyarakat Dalam Peningkatan Taraf Hidup Melalui Kehidupan Berkoperasi Dalam Pengembangan Ekonomi', 'Pembinaan dan/atau Pendampinga n yang dilaksanakan', '', NULL, '217', '217', '217', '217', '217', NULL, '41000000.00', '41077500.00', '41080600.00', '41329200.00', '42436600.00'),
  (2137, 517, 'Pemberdayaan Koperasi dengan Keanggotaan Daerah Kabupaten/Kota', '2.17.06.2.01.0009', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Peningkatan iklim usaha Koperasi melalui aspek kelembagaan, produksi, pemasaran, keuangan, dan inovasi teknologi bagi Koperasi dengan Keanggotaan Daerah Kabupaten/Kota', 'Koperasi dengan Keanggotaan Daerah Kabupaten/Ko ta', '', NULL, '50', '50', '50', '50', '50', NULL, '141000000.00', '141077500.00', '141080600.00', '141329200.00', '142436600.00'),
  (2138, 518, 'Fasilitasi Kemudahan Perizinan Usaha Mikro', '2.17.07.2.01.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terfasilitasinya Kemudahan Perizinan Usaha Mikro', 'Jumlah Usaha Mikro yang Telah Mendapatkan Perizinan', '', NULL, '100', '100', '100', '100', '100', NULL, '20000000.00', '20037800.00', '20039300.00', '20160600.00', '20700800.00'),
  (2139, 518, 'Pemberdayaan Kelembagaan Potensi dan Pengembangan Usaha Mikro', '2.17.07.2.01.0004', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terfasilitasinya Pemberdayaan Kelembagaan Potensi dan Pengembangan Usaha Mikro', 'Jumlah Unit Usaha yang Telah Menerima Pembinaan dan Pendampinga n Terhadap
Usaha Mikro', '', NULL, '9', '9', '9', '9', '9', NULL, '619000000.00', '620547500.00', '620599200.00', '625576400.00', '647697400.00'),
  (2140, 518, 'Peningkatan Pemahaman dan Pengetahuan UMKM serta Kapasitas dan Kompetensi SDM UMKM dan Kewirausahaan melalui Pendidikan dan Pelatihan', '2.17.07.2.01.0015', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Meningkatnya Pemahaman dan Pengetahuan UMKM serta Kapasitas dan Kompetensi SDM UMKM dan Kewirausahaan', 'Jumlah SDM yang Memahami Pengetahuan Usaha Mikro dan Kewirausahaan', '', NULL, '500', '560', '600', '640', '700', NULL, '1448000000.00', '1450735900.00', '1450856700.00', '1459627000.00', '1498737100.00'),
  (2141, 519, 'Pengembangan Usaha Mikro', '2.17.08.2.01.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terfasilitasinya Usaha Mikro Menjadi Usaha Menengah Melalui Pendampingan, Kemitraan, Perluasan Pasar, Akses Pembiayaan dan Investasi, Pengembangan SDM, dan/Kegiatan Lainnya', 'Jumlah Usaha Mikro yang Terfasilitasi', '', NULL, '2540', '2.6', '2.65', '2.7', '2.75', NULL, '899000000.00', '900698600.00', '900767000.00', '906218700.00', '930500400.00'),
  (2142, 520, 'Fasilitasi Penerbitan Tanda Daftar Gudang', '3.30.02.2.02.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Dokumen Tanda Daftar Gudang', 'Jumlah Dokumen Tanda Daftar
Gudang', '', NULL, '15', '15', '15', '15', '15', NULL, '24000000.00', '24045300.00', '24047100.00', '24192600.00', '24840800.00'),
  (2143, 521, 'Pengawasan Distribusi, Pengemasan dan Pelabelan Bahan Berbahaya Terhadap Pengguna Akhir Bahan Berbahaya (PA-B2) maupun Produsen B2 (P-B2)', '3.30.02.2.06.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Pengawasan Distribusi, Pengemasan dan Pelabelan Bahan Berbahaya Terhadap Distributor B2, Pengguna Akhir Bahan Berbahaya (PA-B2) maupun Produsen B2 (P-B2)', 'Jumlah Laporan Hasil Pengawasan Distribusi, Pengemasan dan  Pelabelan Bahan Berbahaya Terhadap Distributor B2, Pengguna Akhir Bahan Berbahaya (PA-B2)
maupun Produsen B2 (P-B2)', '', NULL, '12', '12', '12', '12', '12', NULL, '121000000.00', '121228600.00', '121237800.00', '121971600.00', '125239800.00'),
  (2144, 522, 'Koordinasi dan Sinkronisasi Layanan Penerbitan SKA', '3.30.02.2.07.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Dokumen Penerbitan Surat Keterangan Asal', 'Jumlah Dokumen Penerbitan Surat Keterangan Asal', '', NULL, '1200', '1.21', '1.22', '1.23', '1.24', NULL, '121000000.00', '121228600.00', '121237800.00', '121971600.00', '125239800.00'),
  (2145, 523, 'Penyediaan Sarana Distribusi Perdagangan', '3.30.03.2.01.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Sarana Distribusi Perdagangan', 'Jumlah Sarana Distribusi
Perdagangan', '', NULL, '20', '20', '20', '20', '20', NULL, '145000000.00', '145273900.00', '145284900.00', '146164200.00', '150080600.00'),
  (2146, 523, 'Fasilitasi Pengelolaan Sarana Distribusi Perdagangan', '3.30.03.2.01.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Fasilitasi Pengelolaan Sarana Distribusi Perdagangan', 'Jumlah Fasilitasi Pengelolaan Sarana
Distribusi Perdagangan', '', NULL, '20', '20', '20', '20', '20', NULL, '1692000000.00', '1695197000.00', '1695325700.00', '1705586300.00', '1751286700.00'),
  (2147, 524, 'Pengendalian Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Agen dan Pasar Rakyat', '3.30.04.2.01.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Pengendalian Stok atau Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Agen dan Pasar Rakyat', 'Jumlah Laporan Pengendalian Stok atau Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Agen dan Pasar Rakyat', '', NULL, '12', '12', '12', '12', '12', NULL, '24000000.00', '24045300.00', '24047100.00', '24192600.00', '24840800.00'),
  (2148, 525, 'Pemantauan Harga dan Stok Barang Kebutuhan Pokok dan Barang Penting pada Pasar Rakyat yang Terintegrasi dalam Sistem Informasi Perdagangan', '3.30.04.2.02.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Pemantauan Harga dan Stok Barang Kebutuhan Pokok dan Barang Penting pada Pasar Rakyat yang Terintegrasi dalam Sistem Informasi Perdagangan', 'Jumlah Laporan Pemantauan Harga dan Stok Barang Kebutuhan Pokok dan Barang Penting pada Pasar Rakyat yang Terintegrasi dalam Sistem Informasi Perdagangan', '', NULL, '12', '12', '12', '12', '12', NULL, '482000000.00', '482910700.00', '482947400.00', '485870300.00', '498889000.00'),
  (2149, 525, 'Pelaksanaan Operasi Pasar Reguler dan Pasar Khusus yang Berdampak dalam 1 (Satu) Kabupaten/Kota', '3.30.04.2.02.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Pelaksanaan Operasi Pasar Reguler dan Pasar Khusus yang Berdampak dalam 1 (Satu) Kabupaten/Kota', 'Jumlah Laporan Pelaksanaan Operasi  Pasar  Reguler dan Pasar Khusus yang Berdampak dalam 1 (Satu)
Kabupaten/Ko ta', '', NULL, '30', '30', '30', '30', '30', NULL, '1205000000.00', '1207276800.00', '1207368500.00', '1214675800.00', '1247222500.00'),
  (2150, 526, 'Pengawasan Penyaluran dan Penggunaan Pupuk dan Pestisida Bersubsidi', '3.30.04.2.03.0003', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Tersedianya Laporan Pengawasan Penyaluran dan Penggunaan Pupuk dan Pestisida Bersubsidi dengan Realisasi Minimal 90%', 'Jumlah Laporan Pengawasan Penyaluran dan Penggunaan Pupuk dan Pestisida Bersubsidi dengan Realisasi Minimal 90%', '', NULL, '12', '12', '12', '12', '12', NULL, '24000000.00', '24045300.00', '24047100.00', '24192600.00', '24840800.00'),
  (2151, 527, 'Pameran Dagang Nasional', '3.30.05.2.01.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terfasilitasinya Pelaku Usaha yang Berorientasi Ekspor pada Pameran Dagang Nasional', 'Jumlah Pelaku Usaha yang Difasilitasi dalam
Pameran Dagang', '', NULL, '3', '3', '3', '3', '3', NULL, '181000000.00', '181342000.00', '181355800.00', '182453400.00', '187342200.00'),
  (2152, 527, 'Misi Dagang bagi Produk Ekspor Unggulan', '3.30.05.2.01.0004', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terfasilitasinya Pelaku Usaha yang Berorientasi Ekspor pada Pelaksanaan Misi Dagang', 'Jumlah Pelaku Usaha yang Difasilitasi dalam Misi Dagang Produk Ekspor Unggulan', '', NULL, '2', '2', '2', '2', '2', NULL, '121000000.00', '121228600.00', '121237800.00', '121971600.00', '125239800.00'),
  (2153, 528, 'Pelaksanaan Metrologi Legal, Berupa Tera, Tera Ulang', '3.30.06.2.01.0001', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Meningkatnya Kesesuaian Alat Ukur, Alat Takar, Alat Timbang, dan Alat Perlengkapan Terhadap Ketentuan yang Berlaku', 'Jumlah Alat Ukur, Alat Takar, Alat Timbang, dan Alat Perlengkapan
Ditera Ulang', '', NULL, '14000', '14200', '14400', '14500', '14700', NULL, '242000000.00', '242457200.00', '242475600.00', '243943100.00', '250479400.00'),
  (2154, 528, 'Pengawasan/Penyuluha n Metrologi Legal', '3.30.06.2.01.0002', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Pelaku Usaha di Bidang Metrologi Legal yang Dibina', 'Jumlah Pelaku Usaha di Bidang Metrologi Legal yang
Dibina', '', NULL, '120', '130', '140', '150', '160', NULL, '48000000.00', '48090700.00', '48094400.00', '48385500.00', '49682000.00'),
  (2155, 529, 'Pelaksanaan Promosi Penggunaan Produk Dalam Negeri di Tingkat Kabupaten/Kota', '3.30.07.2.01.0005', NULL, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL, 'Terlaksananya Promosi Penggunaan Produk Dalam Negeri di Tingkat Kabupaten/Kota', 'Jumlah UMKM yang memperoleh fasilitasi Promosi Penggunaan Produk Dalam Negeri di Tingkat
Kabupaten/Ko ta', '', NULL, '67', '67', '67', '67', '67', NULL, '73000000.00', '73137900.00', '73143500.00', '73586200.00', '75557900.00');

-- Table: renstra_sub_kegiatan_sasaran (45 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2140, 2111, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2141, 2112, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2142, 2113, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2143, 2114, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Se mesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Se mesteran SKPD', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2144, 2115, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2145, 2116, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2146, 2117, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2147, 2118, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2148, 2119, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2149, 2120, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2150, 2121, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2151, 2122, 'Tersedianya Mebel', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2152, 2123, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2153, 2124, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2154, 2125, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2155, 2126, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2156, 2127, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2157, 2128, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2158, 2129, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2159, 2130, 'Terlaksananya Pemeliharaan/Rehabilita si Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2160, 2131, 'Terlaksananya Pemeliharaan/Rehabilita si Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2161, 2132, 'Pelaksanaan Penguatan Tata Kelola Kelembagaan Koperasi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2162, 2133, 'Pelaksanaan proses Pemeriksaan dan Pengawasan Koperasi yang Wilayah Keanggotaannya Daerah Kabupaten/ Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2163, 2134, 'Terlaksananya Penilaian Kesehatan KSP/USP Koperasi Kewenangan Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2164, 2135, 'Meningkatnya Pemahaman dan Pengetahuan Perkoperasian serta Kapasitas dan Kompetensi SDM Koperasi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2165, 2136, 'Meningkatnya Penumbuhan Kesadaran Bagi Keluarga dan Kelompok Masyarakat Dalam Peningkatan Taraf Hidup Melalui Kehidupan Berkoperasi Dalam Pengembangan Ekonomi', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2166, 2137, 'Peningkatan iklim usaha Koperasi melalui aspek kelembagaan, produksi, pemasaran, keuangan, dan inovasi teknologi bagi Koperasi dengan Keanggotaan Daerah Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2167, 2138, 'Terfasilitasinya Kemudahan Perizinan Usaha Mikro', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2168, 2139, 'Terfasilitasinya Pemberdayaan Kelembagaan Potensi dan Pengembangan Usaha Mikro', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2169, 2140, 'Meningkatnya Pemahaman dan Pengetahuan UMKM serta Kapasitas dan Kompetensi SDM UMKM dan Kewirausahaan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2170, 2141, 'Terfasilitasinya Usaha Mikro Menjadi Usaha Menengah Melalui Pendampingan, Kemitraan, Perluasan Pasar, Akses Pembiayaan dan Investasi, Pengembangan SDM, dan/Kegiatan Lainnya', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2171, 2142, 'Tersedianya Dokumen Tanda Daftar Gudang', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2172, 2143, 'Tersedianya Laporan Pengawasan Distribusi, Pengemasan dan Pelabelan Bahan Berbahaya Terhadap Distributor B2, Pengguna Akhir Bahan Berbahaya (PA-B2) maupun Produsen B2 (P-B2)', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2173, 2144, 'Tersedianya Dokumen Penerbitan Surat Keterangan Asal', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2174, 2145, 'Tersedianya Sarana Distribusi Perdagangan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2175, 2146, 'Tersedianya Fasilitasi Pengelolaan Sarana Distribusi Perdagangan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2176, 2147, 'Tersedianya Laporan Pengendalian Stok atau Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Agen dan Pasar Rakyat', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2177, 2148, 'Tersedianya Laporan Pemantauan Harga dan Stok Barang Kebutuhan Pokok dan Barang Penting pada Pasar Rakyat yang Terintegrasi dalam Sistem Informasi Perdagangan', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2178, 2149, 'Tersedianya Laporan Pelaksanaan Operasi Pasar Reguler dan Pasar Khusus yang Berdampak dalam 1 (Satu) Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2179, 2150, 'Tersedianya Laporan Pengawasan Penyaluran dan Penggunaan Pupuk dan Pestisida Bersubsidi dengan Realisasi Minimal 90%', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2180, 2151, 'Terfasilitasinya Pelaku Usaha yang Berorientasi Ekspor pada Pameran Dagang Nasional', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2181, 2152, 'Terfasilitasinya Pelaku Usaha yang Berorientasi Ekspor pada Pelaksanaan Misi Dagang', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2182, 2153, 'Meningkatnya Kesesuaian Alat Ukur, Alat Takar, Alat Timbang, dan Alat Perlengkapan Terhadap Ketentuan yang Berlaku', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2183, 2154, 'Pelaku Usaha di Bidang Metrologi Legal yang Dibina', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2184, 2155, 'Terlaksananya Promosi Penggunaan Produk Dalam Negeri di Tingkat Kabupaten/Kota', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

-- Table: renstra_sub_kegiatan_indikator (45 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2206, 2111, 2140, 103, 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', '1', '1', '50000000.00', '1', '50094500.00', '1', '50098300.00', '1', '50401500.00', '2', '51752000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2207, 2112, 2141, 103, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '', '6', '7', '50000000.00', '7', '50094500.00', '7', '50098300.00', '7', '50401500.00', '7', '51752000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2208, 2113, 2142, 103, 'Jumlah Orang yang Menerima Gaji dan Tunjangan
ASN', '', '47', '47', '9226196021.00', '47', '9243628500.00', '47', '9244330500.00', '47', '9300279700.00', '47', '9549476600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2209, 2114, 2143, 103, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triw ulanan/Seme
steran SKPD', '', '12', '12', '20000000.00', '12', '20037800.00', '12', '20039300.00', '12', '20160600.00', '12', '20700800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2210, 2115, 2144, 103, 'Jumlah Paket Komponen Instalasi Listrik/Penera ngan Bangunan Kantor yang Disediakan', '', '488', '2', '40000000.00', '2', '40075600.00', '2', '40078600.00', '2', '40321200.00', '2', '41401600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2211, 2116, 2145, 103, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang
Disediakan', '', '1132', '2', '200000000.00', '2', '200377900.00', '2', '200393100.00', '2', '201605900.00', '2', '207007800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2212, 2117, 2146, 103, 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', '', '857', '2', '200000000.00', '2', '200377900.00', '2', '200393100.00', '2', '201605900.00', '2', '207007800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2213, 2118, 2147, 103, 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', '', '20743', '11', '250000000.00', '11', '250472400.00', '11', '250491400.00', '11', '252007400.00', '11', '258759800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2214, 2119, 2148, 103, 'Jumlah Paket Barang Cetakan dan Penggandaan
yang Disediakan', '', '6190', '2', '12000000.00', '2', '12022700.00', '2', '12023700.00', '2', '12096400.00', '2', '12420500.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2215, 2120, 2149, 103, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang
Disediakan', '', '', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', '4', '10000000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2216, 2121, 2150, 103, 'Jumlah Laporan Penyelenggar aan Rapat Koordinasi dan Konsultasi
SKPD', '', '60', '12', '594800000.00', '12', '595923900.00', '12', '595969100.00', '12', '599576200.00', '12', '615641600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2217, 2122, 2151, 103, 'Jumlah Paket Mebel yang
Disediakan', '', '', '44', '35000000.00', '44', '35000000.00', '44', '35000000.00', '44', '35000000.00', '44', '35000000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2218, 2123, 2152, 103, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Disediakan', '', '', '10', '40000000.00', '10', '40000000.00', '10', '40000000.00', '10', '40000000.00', '10', '40000000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2219, 2124, 2153, 103, 'Jumlah Laporan Penyediaan Jasa Surat
Menyurat', '', '1', '1', '5000000.00', '1', '5009400.00', '1', '5009800.00', '1', '5040100.00', '1', '5175100.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2220, 2125, 2154, 103, 'Jumlah Laporan
Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang
Disediakan', '', '60', '12', '600000000.00', '12', '601133700.00', '12', '601179400.00', '12', '604817900.00', '12', '621023700.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2221, 2126, 2155, 103, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang
Disediakan', '', '12', '12', '2625300000.00', '12', '2630260400.00', '12', '2630460200.00', '12', '2646380500.00', '12', '2717289100.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2222, 2127, 2156, 103, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', '', '29', '29', '137800000.00', '29', '138060400.00', '29', '138072100.00', '29', '138906500.00', '29', '142628400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2223, 2128, 2157, 103, 'Jumlah Mebel yang
Dipelihara', '', '', '40', '40000000.00', '40', '40000000.00', '40', '40000000.00', '40', '40000000.00', '40', '40000000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2224, 2129, 2158, 103, 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', '', '16', '16', '14200000.00', '16', '14226800.00', '16', '14227900.00', '16', '14314000.00', '16', '14697500.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2225, 2130, 2159, 103, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Dir
ehabilitasi', '', '1', '1', '300000000.00', '1', '300661300.00', '1', '300686700.00', '1', '302810400.00', '1', '312263800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2226, 2131, 2160, 103, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Dir ehabilitasi', '', '20', '20', '40000000.00', '20', '40217300.00', '20', '40226100.00', '20', '40923500.00', '20', '44029600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2227, 2132, 2161, 103, 'Jumlah Koperasi yang Dilakukan Penguatan Tata Kelola Kelembagaan
Koperasi', '', '', '60', '41000000.00', '60', '41077500.00', '60', '41080600.00', '60', '41329200.00', '60', '42436600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2228, 2133, 2162, 103, 'Jumlah Koperasi yang telah dilakukan Pemeriksaan
dan Pengawasan', '', '1002', '1219', '21000000.00', '1219', '21039700.00', '1219', '21041300.00', '1219', '21168600.00', '1219', '21735800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2229, 2134, 2163, 103, 'Jumlah Unit Usaha Koperasi yang Telah Dilakukan Penilaian
Kesehatan', '', '185', '185', '20000000.00', '190', '20037800.00', '195', '20039300.00', '200', '20160600.00', '205', '20700800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2230, 2135, 2164, 103, 'Jumlah SDM yang Memahami Pengetahuan Perkoperasia n', '', '50', '100', '120000000.00', '100', '120037800.00', '100', '120039300.00', '100', '120160600.00', '100', '120700800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2231, 2136, 2165, 103, 'Pembinaan dan/atau Pendampinga n yang dilaksanakan', '', '', '217', '41000000.00', '217', '41077500.00', '217', '41080600.00', '217', '41329200.00', '217', '42436600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2232, 2137, 2166, 103, 'Koperasi dengan Keanggotaan Daerah Kabupaten/Ko ta', '', '50', '50', '141000000.00', '50', '141077500.00', '50', '141080600.00', '50', '141329200.00', '50', '142436600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2233, 2138, 2167, 103, 'Jumlah Usaha Mikro yang Telah Mendapatkan Perizinan', '', '100', '100', '20000000.00', '100', '20037800.00', '100', '20039300.00', '100', '20160600.00', '100', '20700800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2234, 2139, 2168, 103, 'Jumlah Unit Usaha yang Telah Menerima Pembinaan dan Pendampinga n Terhadap
Usaha Mikro', '', '9', '9', '619000000.00', '9', '620547500.00', '9', '620599200.00', '9', '625576400.00', '9', '647697400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2235, 2140, 2169, 103, 'Jumlah SDM yang Memahami Pengetahuan Usaha Mikro dan Kewirausahaan', '', '', '500', '1448000000.00', '560', '1450735900.00', '600', '1450856700.00', '640', '1459627000.00', '700', '1498737100.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2236, 2141, 2170, 103, 'Jumlah Usaha Mikro yang Terfasilitasi', '', '3040', '2540', '899000000.00', '2.6', '900698600.00', '2.65', '900767000.00', '2.7', '906218700.00', '2.75', '930500400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2237, 2142, 2171, 103, 'Jumlah Dokumen Tanda Daftar
Gudang', '', '15', '15', '24000000.00', '15', '24045300.00', '15', '24047100.00', '15', '24192600.00', '15', '24840800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2238, 2143, 2172, 103, 'Jumlah Laporan Hasil Pengawasan Distribusi, Pengemasan dan  Pelabelan Bahan Berbahaya Terhadap Distributor B2, Pengguna Akhir Bahan Berbahaya (PA-B2)
maupun Produsen B2 (P-B2)', '', '', '12', '121000000.00', '12', '121228600.00', '12', '121237800.00', '12', '121971600.00', '12', '125239800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2239, 2144, 2173, 103, 'Jumlah Dokumen Penerbitan Surat Keterangan Asal', '', '1158', '1200', '121000000.00', '1.21', '121228600.00', '1.22', '121237800.00', '1.23', '121971600.00', '1.24', '125239800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2240, 2145, 2174, 103, 'Jumlah Sarana Distribusi
Perdagangan', '', '20', '20', '145000000.00', '20', '145273900.00', '20', '145284900.00', '20', '146164200.00', '20', '150080600.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2241, 2146, 2175, 103, 'Jumlah Fasilitasi Pengelolaan Sarana
Distribusi Perdagangan', '', '20', '20', '1692000000.00', '20', '1695197000.00', '20', '1695325700.00', '20', '1705586300.00', '20', '1751286700.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2242, 2147, 2176, 103, 'Jumlah Laporan Pengendalian Stok atau Ketersediaan Barang Kebutuhan Pokok dan Barang Penting di Tingkat Agen dan Pasar Rakyat', '', '12', '12', '24000000.00', '12', '24045300.00', '12', '24047100.00', '12', '24192600.00', '12', '24840800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2243, 2148, 2177, 103, 'Jumlah Laporan Pemantauan Harga dan Stok Barang Kebutuhan Pokok dan Barang Penting pada Pasar Rakyat yang Terintegrasi dalam Sistem Informasi Perdagangan', '', '12', '12', '482000000.00', '12', '482910700.00', '12', '482947400.00', '12', '485870300.00', '12', '498889000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2244, 2149, 2178, 103, 'Jumlah Laporan Pelaksanaan Operasi  Pasar  Reguler dan Pasar Khusus yang Berdampak dalam 1 (Satu)
Kabupaten/Ko ta', '', '30', '30', '1205000000.00', '30', '1207276800.00', '30', '1207368500.00', '30', '1214675800.00', '30', '1247222500.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2245, 2150, 2179, 103, 'Jumlah Laporan Pengawasan Penyaluran dan Penggunaan Pupuk dan Pestisida Bersubsidi dengan Realisasi Minimal 90%', '', '12', '12', '24000000.00', '12', '24045300.00', '12', '24047100.00', '12', '24192600.00', '12', '24840800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2246, 2151, 2180, 103, 'Jumlah Pelaku Usaha yang Difasilitasi dalam
Pameran Dagang', '', '', '3', '181000000.00', '3', '181342000.00', '3', '181355800.00', '3', '182453400.00', '3', '187342200.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2247, 2152, 2181, 103, 'Jumlah Pelaku Usaha yang Difasilitasi dalam Misi Dagang Produk Ekspor Unggulan', '', '', '2', '121000000.00', '2', '121228600.00', '2', '121237800.00', '2', '121971600.00', '2', '125239800.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2248, 2153, 2182, 103, 'Jumlah Alat Ukur, Alat Takar, Alat Timbang, dan Alat Perlengkapan
Ditera Ulang', '', '13855', '14000', '242000000.00', '14200', '242457200.00', '14400', '242475600.00', '14500', '243943100.00', '14700', '250479400.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2249, 2154, 2183, 103, 'Jumlah Pelaku Usaha di Bidang Metrologi Legal yang
Dibina', '', '118', '120', '48000000.00', '130', '48090700.00', '140', '48094400.00', '150', '48385500.00', '160', '49682000.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL),
  (2250, 2155, 2184, 103, 'Jumlah UMKM yang memperoleh fasilitasi Promosi Penggunaan Produk Dalam Negeri di Tingkat
Kabupaten/Ko ta', '', '67', '67', '73000000.00', '67', '73137900.00', '67', '73143500.00', '67', '73586200.00', '67', '75557900.00', 10, '2026-09-26 18:31:56', '2026-09-26 18:31:56', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
