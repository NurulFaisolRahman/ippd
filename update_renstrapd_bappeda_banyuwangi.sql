-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: BADAN PERENCANAAN PEMBANGUNAN DAERAH BANYUWANGI
-- ID INSTANSI: 87 | KODE: 5.01.5.05.0.00.01.0000 | URUSAN: 5.01,5.05
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- TANGGAL EXPORT: 2026-09-26 18:19:39
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (BADAN PERENCANAAN PEMBANGUNAN DAERAH BANYUWANGI) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (87, '5.01.5.05.0.00.01.0000', '35.10', 'BADAN PERENCANAAN PEMBANGUNAN DAERAH BANYUWANGI', '5.01,5.05', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, '2026-09-21 11:48:29', '2026-09-26 13:42:19', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA BADAN PERENCANAAN PEMBANGUNAN DAERAH BANYUWANGI SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073, 2074, 2075, 2076, 2077, 2078, 2079, 2080, 2081, 2082, 2083, 2084, 2085, 2086, 2087, 2088, 2089, 2090, 2091, 2092, 2093, 2094, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073, 2074, 2075, 2076, 2077, 2078, 2079, 2080, 2081, 2082, 2083, 2084, 2085, 2086, 2087, 2088, 2089, 2090, 2091, 2092, 2093, 2094, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (491, 492, 493, 494, 495, 496, 497, 498, 499, 500, 501, 502, 503, 504, 505, 506, 507);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (491, 492, 493, 494, 495, 496, 497, 498, 499, 500, 501, 502, 503, 504, 505, 506, 507);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (491, 492, 493, 494, 495, 496, 497, 498, 499, 500, 501, 502, 503, 504, 505, 506, 507);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (144, 145, 146, 147);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (144, 145, 146, 147);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (144, 145, 146, 147);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (79, 80, 81);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (79, 80, 81);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (30);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (30);
DELETE FROM `renstra_tujuan` WHERE `id` IN (30) OR (`id_instansi` = 87 AND `kode_wilayah` = '35.10');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD BADAN PERENCANAAN PEMBANGUNAN DAERAH BANYUWANGI
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (30, '35.10', 87, '59', 'Meningkatnya kinerja pembangunan daerah', NULL, NULL, 'Persentase Ketercapaian Indikator Tujuan Pembangunan Daerah', '%', NULL, '100', '100', '100', '100', '100', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (2 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (45, 30, 87, 'Persentase Ketercapaian Indikator Tujuan Pembangunan Daerah', '%', '103.85', NULL, '100', '100', '100', '100', '100', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (46, 30, 87, 'Persentase Ketercapaian Sasaran Pembangunan Daerah', '%', '107.22', NULL, '100', '100', '100', '100', '100', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

-- Table: renstra_sasaran (3 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (79, 30, 'Meningkatnya Akuntabilitas dan Kualitas Pelayanan Perangkat Daerah', NULL, NULL, 'Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '90.79', '90.83', '90.87', '90.91', '90.95', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (80, 30, 'Meningkatnya kualitas perencanaan', NULL, NULL, 'Indeks Perencanaan Pembangunan Daerah', 'Nilai', NULL, '90', '90.3', '90.6', '90.9', '91.2', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (81, 30, 'Meningkatnya Pemanfaatan Hasil Kelitbangan', NULL, NULL, 'Persentase Rekomendasi Kebijakan Pembangunan Daerah yang Dijadikan sebagai Landasan dalam Implementasi Pembangunan Daerah', '%', NULL, '85', '86', '87', '88', '89', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (5 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (122, 79, NULL, 'Nilai SAKIP Perangkat Daerah', 'Nilai', '90.71', NULL, '90.79', '90.83', '90.87', '90.91', '90.95', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (123, 79, NULL, 'Indeks Kepuasan Masyarakat', 'Nilai', '96.43', NULL, '94.89', '94.9', '94.92', '94.96', '94.98', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (124, 80, NULL, 'Indeks Perencanaan Pembangunan Daerah', 'Nilai', '89.37', NULL, '90', '90.3', '90.6', '90.9', '91.2', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (125, 80, NULL, 'Nilai komponen perencanaan SAKIP', 'Nilai', '27.69', NULL, '27.88', '27.96', '28.04', '28.12', '28.2', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (126, 81, NULL, 'Persentase Rekomendasi Kebijakan Pembangunan Daerah yang Dijadikan sebagai Landasan dalam Implementasi Pembangunan Daerah', '%', '80', NULL, '85', '86', '87', '88', '89', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

-- Table: renstra_program (4 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (144, 79, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '5.01.01', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 'Persentase pemenuhan kebutuhan penunjang
Perangkat Daerah', '%', NULL, '100', '100', '100', '100', '100', NULL, '14360460999.00', '14387594400.00', '14388686900.00', '14475771100.00', '14863642900.00'),
  (145, 80, 'PROGRAM PERENCANAAN, PENGENDALIAN DAN EVALUASI PEMBANGUNAN DAERAH', '5.01.02', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, 'Meningkatnya Kualitas Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah', 'Persentase pemenuhan standar kualitas proses
perencanaan pembangunan daerah', '%', NULL, '100', '100', '100', '100', '100', NULL, '2210000000.00', '2214175800.00', '2214344000.00', '2227745700.00', '2287437000.00'),
  (146, 80, 'PROGRAM KOORDINASI DAN SINKRONISASI PERENCANAAN PEMBANGUNAN DAERAH', '5.01.03', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, 'Meningkatnya Kualitas Substansi Perencanaan Pembangunan Daerah', 'Persentase pemenuhan standar kualitas substansi dokumen perencanaan
pembangunan daerah', '%', NULL, '100', '100', '100', '100', '100', NULL, '6535000000.00', '6547347600.00', '6547844700.00', '6587474000.00', '6763982600.00'),
  (147, 81, 'PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, NULL, 'Meningkatnya Penelitian dan Pengembangan Daerah', 'Persentase kajian kelitbangan yang sesuai
dengan isu strategis daerah', '%', NULL, '81.5', '82', '82.5', '83', '83.5', NULL, '1164000000.00', '1166199200.00', '1166287900.00', '1173346600.00', '1204786000.00');

-- Table: renstra_program_outcome (4 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (190, 144, 'Meningkatnya Kualitas Penunjang Urusan Pemerintahan Daerah Kabupaten', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (191, 145, 'Meningkatnya Kualitas Perencanaan, Pengendalian dan Evaluasi Pembangunan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (192, 146, 'Meningkatnya Kualitas Substansi Perencanaan Pembangunan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (193, 147, 'Meningkatnya Penelitian dan Pengembangan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

-- Table: renstra_program_indikator (6 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (307, 144, 190, 87, 'Persentase pemenuhan kebutuhan penunjang
Perangkat Daerah', '%', '97.81', '100', '100', '100', '100', '100', '14360460999.00', '14387594400.00', '14388686900.00', '14475771100.00', '14863642900.00', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 10),
  (308, 145, 191, 87, 'Persentase pemenuhan standar kualitas proses
perencanaan pembangunan daerah', '%', '100', '100', '100', '100', '100', '100', '2210000000.00', '2214175800.00', '2214344000.00', '2227745700.00', '2287437000.00', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 10),
  (309, 145, 191, 87, 'Persentase Perangkat Daerah yang Kinerjanya
(Tujuan dan Sasaran Renstra) Tercapai', '%', '66.67', '70.37', '72.22', '74.07', '75.93', '77.78', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 20),
  (310, 146, 192, 87, 'Persentase pemenuhan standar kualitas substansi dokumen perencanaan
pembangunan daerah', '%', '100', '100', '100', '100', '100', '100', '6535000000.00', '6547347600.00', '6547844700.00', '6587474000.00', '6763982600.00', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 10),
  (311, 147, 193, 87, 'Persentase kajian kelitbangan yang sesuai
dengan isu strategis daerah', '%', '80', '81.5', '82', '82.5', '83', '83.5', '1164000000.00', '1166199200.00', '1166287900.00', '1173346600.00', '1204786000.00', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 10),
  (312, 147, 193, 87, 'Indeks Inovasi Daerah', 'Angka', '98.86', '88', '89', '90', '91', '92', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 20);

-- Table: renstra_kegiatan (17 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (491, 144, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '5.01.01.2.01', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Ketepatan Penyusunan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '160000000.00', '160302300.00', '160314500.00', '161284800.00', '165606400.00'),
  (492, 144, 'Administrasi Keuangan Perangkat Daerah', '5.01.01.2.02', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Pelayanan Administrasi Keuangan Perangkat Daerah', 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', NULL, '38', '38', '38', '38', '38', NULL, '10660940887.00', '10681084300.00', '10681895500.00', '10746545200.00', '11034494100.00'),
  (493, 144, 'Administrasi Kepegawaian Perangkat Daerah', '5.01.01.2.05', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kualitas Pegawai Perangkat Daerah', 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi yang Mengikuti Pendidikan dan Pelatihan', 'Orang', NULL, '55', '55', '55', '55', '55', NULL, '150000000.00', '150283400.00', '150294800.00', '151204400.00', '155255900.00'),
  (494, 144, 'Administrasi Umum Perangkat Daerah', '5.01.01.2.06', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kualitas Administrasi Umum Perangkat Daerah', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '1924800000.00', '1928436800.00', '1928583100.00', '1940255400.00', '1992243600.00'),
  (495, 144, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '5.01.01.2.07', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terfasilitasinya Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Jumlah Unit Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '449520112.00', '450369500.00', '450403700.00', '453129800.00', '465271300.00'),
  (496, 144, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '5.01.01.2.08', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Jasa Penunjang Urusan Pemerintahan Daerah', 'Jumlah Laporan Penyediaan Jasa Komunikasi,
Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '580200000.00', '581296200.00', '581340300.00', '584858700.00', '600529600.00'),
  (497, 144, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '5.01.01.2.09', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terfasilitasinya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', NULL, '3', '3', '3', '3', '3', NULL, '435000000.00', '435821900.00', '435855000.00', '438492800.00', '450242000.00'),
  (498, 145, 'Penyusunan Perencanaan dan Pendanaan', '5.01.02.2.01', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Keselarasan dalam Proses Musyawarah Pembangunan', 'Jumlah Berita Acara Musrenbang
Kabupaten/Kota', 'Berita Acara', NULL, '1', '1', '1', '1', '1', NULL, '295000000.00', '295557400.00', '295579800.00', '297368700.00', '305336500.00'),
  (499, 145, 'Analisis Data dan Informasi Pemerintahan Daerah Bidang Perencanaan Pembangunan Daerah', '5.01.02.2.02', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kualitas Metode dan Kerangka Berpikir Ilmiah', 'Jumlah Dokumen Hasil Analisis Data untuk Penyusunan Kebijakan Perencanaan Pembangunan Daerah (Semua Perencanaan
Pembangunan Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '116000000.00', '116219200.00', '116228000.00', '116931400.00', '120064500.00'),
  (500, 145, 'Pengendalian, Evaluasi dan Pelaporan Bidang Perencanaan Pembangunan Daerah', '5.01.02.2.03', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kualitas Pengendalian, Pelaporan, dan Evaluasi Bidang Perencanaan Pembangunan Daerah', 'Jumlah Laporan Hasil Evaluasi Kinerja
Pembangunan Daerah', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '251000000.00', '251474300.00', '251493400.00', '253015500.00', '259794900.00'),
  (501, 146, 'Koordinasi Perencanaan Bidang Pemerintahan dan Pembangunan Manusia', '5.01.03.2.01', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kesesuaian antara Perencanaan, Pelaksanaan, dan Evaluasi Program di Lingkup Pemerintahan dan Pembangunan Manusia', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Pembangunan Manusia', 'Laporan', NULL, '13', '13', '13', '13', '13', NULL, '3132000000.00', '3137917800.00', '3138156100.00', '3157149100.00', '3241743600.00'),
  (502, 146, 'Koordinasi Perencanaan Bidang Perekonomian dan SDA (Sumber Daya Alam)', '5.01.03.2.02', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kesesuaian antara Perencanaan, Pelaksanaan, dan Evaluasi Program di Lingkup Perekonomian dan SDA', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang SDA', 'Laporan', NULL, '24', '24', '24', '24', '24', NULL, '1020000000.00', '1021927300.00', '1022004900.00', '1028190400.00', '1055740300.00'),
  (503, 146, 'Koordinasi Perencanaan Bidang Infrastruktur dan Kewilayahan', '5.01.03.2.03', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Keterpaduan Perencanaan Pembangunan Daerah yang Berbasis Analisis Kewilayahan dan Selaras dengan Pelaksanaan serta Hasil Evaluasi Program di Lingkup Infrastruktur dan Kewilayahan', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada Bidang Kewilayahan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '475000000.00', '475897500.00', '475933600.00', '478814100.00', '491643700.00'),
  (504, 147, 'Penelitian dan Pengembangan Bidang Penyelenggaraan Pemerintahan dan Pengkajian Peraturan', '5.05.02.2.01', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Ekosistem Penelitian dan Pengembangan yang Kolaboratif dan Terarah di Lingkup Penyelenggaraan Pemerintahan dan Pengkajian Peraturan', 'Jumlah Laporan Hasil Pelaksanaan Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '140000000.00', '140264500.00', '140275200.00', '141124200.00', '144905600.00'),
  (505, 147, 'Penelitian dan Pengembangan Bidang Sosial dan Kependudukan', '5.05.02.2.02', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Ekosistem Penelitian dan Pengembangan yang Kolaboratif dan Terarah di Lingkup Sosial dan Kependudukan', 'Jumlah Dokumen Hasil Penelitian dan Pengembangan Pariwisata', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '204000000.00', '204385400.00', '204400900.00', '205638000.00', '211148000.00'),
  (506, 147, 'Penelitian dan Pengembangan Bidang Ekonomi dan Pembangunan', '5.05.02.2.03', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Ekosistem Penelitian dan Pengembangan yang Kolaboratif dan Terarah di Lingkup Ekonomi dan Pembangunan', 'Jumlah Dokumen Hasil Penelitian dan Pengembangan Pertanian, Perkebunan dan
Pangan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '140000000.00', '140264500.00', '140275200.00', '141124200.00', '144905600.00'),
  (507, 147, 'Pengembangan Inovasi dan Teknologi', '5.05.02.2.04', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Meningkatnya Kematangan Inovasi Daerah', 'Jumlah Dokumen Hasil Penelitian, Pengembangan, dan Perekayasaan di Bidang
Teknologi dan Inovasi', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '680000000.00', '681284800.00', '681336600.00', '685460200.00', '703826800.00');

-- Table: renstra_kegiatan_sasaran (23 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (529, 491, 'Meningkatnya Ketepatan Penyusunan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (530, 492, 'Meningkatnya Pelayanan Administrasi Keuangan Perangkat Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (531, 493, 'Meningkatnya Kualitas Pegawai Perangkat Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (532, 494, 'Meningkatnya Kualitas Administrasi Umum Perangkat Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (533, 495, 'Terfasilitasinya Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (534, 496, 'Tersedianya Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (535, 497, 'Terfasilitasinya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (536, 498, 'Meningkatnya Keselarasan dalam Proses Musyawarah Pembangunan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (537, 498, 'Meningkatnya Partisipasi Pemangku Kepentingan dalam Perencanaan Daerah', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (538, 498, 'Meningkatnya Sinkronisasi Visi Misi Kepala Daerah dalam Prioritas Pembangunan', 30, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (539, 499, 'Meningkatnya Kualitas Metode dan Kerangka Berpikir Ilmiah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (540, 500, 'Meningkatnya Kualitas Pengendalian, Pelaporan, dan Evaluasi Bidang Perencanaan Pembangunan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (541, 500, 'Meningkatnya Tindaklanjut Hasil Pengendalian dan Evaluasi', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (542, 501, 'Meningkatnya Kesesuaian antara Perencanaan, Pelaksanaan, dan Evaluasi Program di Lingkup Pemerintahan dan Pembangunan Manusia', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (543, 501, 'Meningkatnya Koherensi dan Keselarasan Tematik Dokumen Perencanaan Pembangunan Daerah di Lingkup Pemerintahan dan Pembangunan Manusia', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (544, 502, 'Meningkatnya Kesesuaian antara Perencanaan, Pelaksanaan, dan Evaluasi Program di Lingkup Perekonomian dan SDA', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (545, 502, 'Meningkatnya Koherensi dan Keselarasan Tematik Dokumen Perencanaan Pembangunan Daerah di Lingkup Perekonomian dan SDA', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (546, 503, 'Meningkatnya Keterpaduan Perencanaan Pembangunan Daerah yang Berbasis Analisis Kewilayahan dan Selaras dengan Pelaksanaan serta Hasil Evaluasi Program di Lingkup Infrastruktur dan Kewilayahan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (547, 503, 'Meningkatnya Koherensi dan Keselarasan Tematik Dokumen Perencanaan Pembangunan Daerah di Lingkup Infrastruktur dan Kewilayahan', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (548, 504, 'Meningkatnya Ekosistem Penelitian dan Pengembangan yang Kolaboratif dan Terarah di Lingkup Penyelenggaraan Pemerintahan dan Pengkajian Peraturan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (549, 505, 'Meningkatnya Ekosistem Penelitian dan Pengembangan yang Kolaboratif dan Terarah di Lingkup Sosial dan Kependudukan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (550, 506, 'Meningkatnya Ekosistem Penelitian dan Pengembangan yang Kolaboratif dan Terarah di Lingkup Ekonomi dan Pembangunan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (551, 507, 'Meningkatnya Kematangan Inovasi Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

-- Table: renstra_kegiatan_indikator (46 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1986, 491, 529, 87, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '7', '7', '160000000.00', '7', '160302300.00', '7', '160314500.00', '7', '161284800.00', '7', '165606400.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1987, 491, 529, 87, 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1988, 492, 530, 87, 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', '37', '38', '10660940887.00', '38', '10681084300.00', '38', '10681895500.00', '38', '10746545200.00', '38', '11034494100.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1989, 493, 531, 87, 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi yang Mengikuti Pendidikan dan Pelatihan', 'Orang', '55', '55', '150000000.00', '55', '150283400.00', '55', '150294800.00', '55', '151204400.00', '55', '155255900.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1990, 494, 532, 87, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', '2', '2', '1924800000.00', '2', '1928436800.00', '2', '1928583100.00', '2', '1940255400.00', '2', '1992243600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1991, 494, 532, 87, 'Jumlah Paket Peralatan dan Perlengkapan
Kantor yang Disediakan', 'Paket', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1992, 494, 532, 87, 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1993, 494, 532, 87, 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 40, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1994, 494, 532, 87, 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', '11', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', '11', '0.00', 50, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1995, 494, 532, 87, 'Jumlah Laporan Penyelenggaraan Rapat
Koordinasi dan Konsultasi SKPD', 'Laporan', '240', '240', '0.00', '240', '0.00', '240', '0.00', '240', '0.00', '240', '0.00', 60, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1996, 494, 532, 87, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 70, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1997, 494, 532, 87, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 80, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1998, 495, 533, 87, 'Jumlah Unit Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', '1', '1', '449520112.00', '1', '450369500.00', '1', '450403700.00', '1', '453129800.00', '1', '465271300.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (1999, 495, 533, 87, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2000, 496, 534, 87, 'Jumlah Laporan Penyediaan Jasa Komunikasi,
Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '580200000.00', '12', '581296200.00', '12', '581340300.00', '12', '584858700.00', '12', '600529600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2001, 496, 534, 87, 'Jumlah Laporan Penyediaan Jasa Pelayanan
Umum Kantor yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2002, 496, 534, 87, 'Jumlah Laporan Penyediaan Jasa Surat
Menyurat', 'Laporan', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2003, 497, 535, 87, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan
dibayarkan Pajaknya', 'Unit', '3', '3', '435000000.00', '3', '435821900.00', '3', '435855000.00', '3', '438492800.00', '3', '450242000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2004, 497, 535, 87, 'Jumlah Gedung Kantor dan Bangunan Lainnya
yang Dipelihara/Direhabilitasi', 'Unit', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2005, 497, 535, 87, 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', 'Unit', '50', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', 30, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2006, 497, 535, 87, 'Jumlah Sarana dan Prasarana Pendukung
Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2007, 498, 536, 87, 'Jumlah Berita Acara Musrenbang
Kabupaten/Kota', 'Berita Acara', '1', '1', '295000000.00', '1', '295557400.00', '1', '295579800.00', '1', '297368700.00', '1', '305336500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2008, 498, 536, 87, 'Jumlah Usulan yang Terverifikasi oleh
Kecamatan', 'Usulan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2009, 498, 537, 87, 'Jumlah Berita Acara Konsultasi Publik (Berita
Acara)', 'Berita Acara', '1', '1', '275000000.00', '1', '275519600.00', '1', '275540600.00', '1', '277208200.00', '1', '284635800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2010, 498, 537, 87, 'Jumlah Berita Acara Forum Perangkat
Daerah/Lintas Perangkat Daerah', 'Berita Acara', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2011, 498, 538, 87, 'Jumlah Dokumen Perencanaan Pembangunan
Daerah Kabupaten/Kota yang Ditetapkan (RPJPD/RPJMD/RKPD)', 'Dokumen', '2', '2', '1160000000.00', '2', '1162191800.00', '2', '1162280100.00', '2', '1169314500.00', '2', '1200645800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2012, 499, 539, 87, 'Jumlah Dokumen Hasil Analisis Data untuk Penyusunan Kebijakan Perencanaan Pembangunan Daerah (Semua Perencanaan
Pembangunan Daerah', 'Dokumen', '1', '1', '116000000.00', '1', '116219200.00', '1', '116228000.00', '1', '116931400.00', '1', '120064500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2013, 500, 540, 87, 'Jumlah Laporan Hasil Evaluasi Kinerja
Pembangunan Daerah', 'Laporan', '1', '1', '251000000.00', '1', '251474300.00', '1', '251493400.00', '1', '253015500.00', '1', '259794900.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2014, 500, 541, 87, 'Jumlah Laporan Hasil Pengendalian Perencanaan dan Pelaksanaan Pembangunan', 'Laporan', '4', '4', '113000000.00', '4', '113213500.00', '4', '113222100.00', '4', '113907400.00', '4', '116959500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2015, 501, 542, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Pembangunan Manusia', 'Laporan', '13', '13', '3132000000.00', '13', '3137917800.00', '13', '3138156100.00', '13', '3157149100.00', '13', '3241743600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2016, 501, 542, 87, 'Jumlah Laporan Hasil Sinkronisasi
Renstra/Renja dengan RKPD/RPJMD pada Bidang Pemerintahan', 'Laporan', '18', '18', '0.00', '18', '0.00', '18', '0.00', '18', '0.00', '18', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2017, 501, 543, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Pemerintahan yang Dikoordinir Penyusunannya (RPJPD, RPJMD dan RKPD)', 'Dokumen', '4', '4', '590000000.00', '4', '591114700.00', '4', '591159600.00', '4', '594737400.00', '4', '610673200.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2018, 501, 543, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan
RKPD)', 'Dokumen', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2019, 502, 544, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang SDA', 'Laporan', '24', '24', '1020000000.00', '24', '1021927300.00', '24', '1022004900.00', '24', '1028190400.00', '24', '1055740300.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2020, 502, 544, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Perekonomian', 'Laporan', '24', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2021, 502, 545, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang SDA yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '2', '2', '474000000.00', '2', '474895600.00', '2', '474931600.00', '2', '477806000.00', '2', '490608600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2022, 502, 545, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Perekonomian yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2023, 503, 546, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada Bidang Kewilayahan', 'Laporan', '12', '12', '475000000.00', '12', '475897500.00', '12', '475933600.00', '12', '478814100.00', '12', '491643700.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2024, 503, 546, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Infrastruktur', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2025, 503, 547, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Kewilayahan yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '4', '4', '844000000.00', '4', '845594700.00', '4', '845658900.00', '4', '850777000.00', '4', '873573200.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2026, 503, 547, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Infrastruktur yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2027, 504, 548, 87, 'Jumlah Laporan Hasil Pelaksanaan Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 'Laporan', '3', '3', '140000000.00', '3', '140264500.00', '3', '140275200.00', '3', '141124200.00', '3', '144905600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2028, 505, 549, 87, 'Jumlah Dokumen Hasil Penelitian dan Pengembangan Pariwisata', 'Dokumen', '2', '2', '204000000.00', '2', '204385400.00', '2', '204400900.00', '2', '205638000.00', '2', '211148000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2029, 506, 550, 87, 'Jumlah Dokumen Hasil Penelitian dan Pengembangan Pertanian, Perkebunan dan
Pangan', 'Dokumen', '2', '2', '140000000.00', '2', '140264500.00', '2', '140275200.00', '2', '141124200.00', '2', '144905600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2030, 507, 551, 87, 'Jumlah Dokumen Hasil Penelitian, Pengembangan, dan Perekayasaan di Bidang
Teknologi dan Inovasi', 'Dokumen', '4', '4', '680000000.00', '4', '681284800.00', '4', '681336600.00', '4', '685460200.00', '4', '703826800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2031, 507, 551, 87, 'Jumlah Laporan Hasil Penyelenggaraan Sosialisasi dan Diseminasi Hasil-Hasil
Kelitbangan', 'Laporan', '5', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 20, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

-- Table: renstra_sub_kegiatan (46 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (2065, 491, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '5.01.01.2.01.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '110000000.00', '110207800.00', '110216200.00', '110883300.00', '113854400.00'),
  (2066, 491, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '5.01.01.2.01.0006', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '50000000.00', '50094500.00', '50098300.00', '50401500.00', '51752000.00'),
  (2067, 492, 'Penyediaan Gaji dan Tunjangan ASN', '5.01.01.2.02.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', NULL, '38', '38', '38', '38', '38', NULL, '10660940887.00', '10681084300.00', '10681895500.00', '10746545200.00', '11034494100.00'),
  (2068, 493, 'Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', '5.01.01.2.05.0009', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi
yang Mengikuti Pendidikan dan Pelatihan', 'Orang', NULL, '55', '55', '55', '55', '55', NULL, '150000000.00', '150283400.00', '150294800.00', '151204400.00', '155255900.00'),
  (2069, 494, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '5.01.01.2.06.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi
Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '45000000.00', '45085000.00', '45088400.00', '45361300.00', '46576700.00'),
  (2070, 494, 'Penyediaan Peralatan dan Perlengkapan Kantor', '5.01.01.2.06.0002', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan
Kantor yang Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '150000000.00', '150283400.00', '150294800.00', '151204400.00', '155255900.00'),
  (2071, 494, 'Penyediaan Peralatan Rumah Tangga', '5.01.01.2.06.0003', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '40000000.00', '40075600.00', '40078600.00', '40321200.00', '41401600.00'),
  (2072, 494, 'Penyediaan Bahan Logistik Kantor', '5.01.01.2.06.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', NULL, '11', '11', '11', '11', '11', NULL, '350000000.00', '350661300.00', '350687900.00', '352810400.00', '362263800.00'),
  (2073, 494, 'Penyediaan Barang Cetakan dan Penggandaan', '5.01.01.2.06.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '30000000.00', '30056700.00', '30059000.00', '30240900.00', '31051200.00'),
  (2074, 494, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '5.01.01.2.06.0006', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '45000000.00', '45085000.00', '45088400.00', '45361300.00', '46576700.00'),
  (2075, 494, 'Fasilitasi Kunjungan Tamu', '5.01.01.2.06.0008', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Fasilitasi Kunjungan Tamu', 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '200000000.00', '200377900.00', '200393100.00', '201605900.00', '207007800.00'),
  (2076, 494, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '5.01.01.2.06.0009', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat
Koordinasi dan Konsultasi SKPD', 'Laporan', NULL, '240', '240', '240', '240', '240', NULL, '1064800000.00', '1066811900.00', '1066892900.00', '1073350000.00', '1102109900.00'),
  (2077, 495, 'Pengadaan Mebel', '5.01.01.2.07.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '224760056.00', '225184750.00', '225201850.00', '226564900.00', '232635650.00'),
  (2078, 495, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '5.01.01.2.07.0009', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '224760056.00', '225184750.00', '225201850.00', '226564900.00', '232635650.00'),
  (2079, 496, 'Penyediaan Jasa Surat Menyurat', '5.01.01.2.08.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan Jasa Surat
Menyurat', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '5000000.00', '5009400.00', '5009800.00', '5040100.00', '5175100.00'),
  (2080, 496, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '5.01.01.2.08.0002', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '200000000.00', '200377900.00', '200393100.00', '201605900.00', '207007800.00'),
  (2081, 496, 'Penyediaan Jasa Pelayanan Umum Kantor', '5.01.01.2.08.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan
Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '375200000.00', '375908900.00', '375937400.00', '378212700.00', '388346700.00'),
  (2082, 497, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '5.01.01.2.09.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau
Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '3', '3', '3', '3', '3', NULL, '55000000.00', '55103900.00', '55108100.00', '55441600.00', '56927100.00'),
  (2083, 497, 'Pemeliharaan Peralatan dan Mesin Lainnya', '5.01.01.2.09.0006', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', 'Unit', NULL, '50', '50', '50', '50', '50', NULL, '30000000.00', '30056700.00', '30059000.00', '30240900.00', '31051200.00'),
  (2084, 497, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '5.01.01.2.09.0009', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya
yang Dipelihara/Direhabilitasi', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '300000000.00', '300566800.00', '300589600.00', '302408800.00', '310511700.00'),
  (2085, 497, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '5.01.01.2.09.0011', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50094500.00', '50098300.00', '50401500.00', '51752000.00'),
  (2086, 498, 'Pelaksanaan Musrenbang Kabupaten/Kota', '5.01.02.2.01.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Musrenbang Kabupaten/Kota', 'Jumlah Berita Acara Musrenbang
Kabupaten/Kota', 'Berita Acara', NULL, '1', '1', '1', '1', '1', NULL, '179000000.00', '179338200.00', '179351800.00', '180437300.00', '185272000.00'),
  (2087, 498, 'Penyiapan Bahan Koordinasi Musrenbang Kecamatan', '5.01.02.2.01.0006', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersedianya Usulan-Usulan yang Telah Terverifikasi oleh Kecamatan', 'Jumlah Usulan yang Terverifikasi oleh
Kecamatan', 'Usulan', NULL, '1', '1', '1', '1', '1', NULL, '116000000.00', '116219200.00', '116228000.00', '116931400.00', '120064500.00'),
  (2088, 498, 'Pelaksanaan Konsultasi Publik', '5.01.02.2.01.0003', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Konsultasi Publik', 'Jumlah Berita Acara Konsultasi Publik (Berita
Acara)', 'Berita Acara', NULL, '1', '1', '1', '1', '1', NULL, '127000000.00', '127240000.00', '127249700.00', '128019800.00', '131450000.00'),
  (2089, 498, 'Koordinasi Pelaksanaan Forum Perangkat Daerah/Lintas Perangkat Daerah', '5.01.02.2.01.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Forum Perangkat Daerah/Lintas Perangkat Daerah', 'Jumlah Berita Acara Forum Perangkat
Daerah/Lintas Perangkat Daerah', 'Berita Acara', NULL, '1', '1', '1', '1', '1', NULL, '148000000.00', '148279600.00', '148290900.00', '149188400.00', '153185800.00'),
  (2090, 498, 'Koordinasi Penyusunan dan Penetapan Dokumen Perencanaan Pembangunan Daerah Kabupaten/Kota', '5.01.02.2.01.0007', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Ditetapkannya Dokumen Perencanaan Pembangunan Daerah Kabupaten/Kota', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Kabupaten/Kota yang Ditetapkan
(RPJPD/RPJMD/RKPD)', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '1160000000.00', '1162191800.00', '1162280100.00', '1169314500.00', '1200645800.00'),
  (2091, 499, 'Analisis Data dan Informasi Perencanaan Pembangunan Daerah', '5.01.02.2.02.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terinputnya Analisis Data dan Informasi untuk Perencanaan Pembangunan Daerah', 'Jumlah Dokumen Hasil Analisis Data untuk Penyusunan Kebijakan Perencanaan Pembangunan Daerah (Semua Perencanaan
Pembangunan Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '116000000.00', '116219200.00', '116228000.00', '116931400.00', '120064500.00'),
  (2092, 500, 'Monitoring, Evaluasi dan Penyusunan Laporan Berkala Pelaksanaan Pembangunan Daerah', '5.01.02.2.03.0003', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersusunnya Laporan Hasil Monitoring dan Evaluasi Berkala Pelaksanaan Pembangunan Daerah', 'Jumlah Laporan Hasil Evaluasi Kinerja
Pembangunan Daerah', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '251000000.00', '251474300.00', '251493400.00', '253015500.00', '259794900.00'),
  (2093, 500, 'Koordinasi Pengendalian Perencanaan dan Pelaksanaan Pembangunan Daerah di Kabupaten/Kota', '5.01.02.2.03.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Pengendalian Perencanaan dan Pelaksanaan Pembangunan Daerah di Kabupaten/Kota', 'Jumlah Laporan Hasil Pengendalian
Perencanaan dan Pelaksanaan Pembangunan', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '113000000.00', '113213500.00', '113222100.00', '113907400.00', '116959500.00'),
  (2094, 501, 'Koordinasi Pelaksanaan Sinergitas dan Harmonisasi Perencanaan Pembangunan Daerah Bidang Pemerintahan', '5.01.03.2.01.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Pemerintahan', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Pemerintahan', 'Laporan', NULL, '18', '18', '18', '18', '18', NULL, '274000000.00', '274517700.00', '274538500.00', '276200100.00', '283600800.00'),
  (2095, 501, 'Koordinasi Pelaksanaan Sinergitas dan Harmonisasi Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia', '5.01.03.2.01.0008', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Pembangunan Manusia', 'Jumlah Laporan Hasil Sinkronisasi
Renstra/Renja dengan RKPD/RPJMD pada Bidang Pembangunan Manusia', 'Laporan', NULL, '13', '13', '13', '13', '13', NULL, '2858000000.00', '2863400100.00', '2863617600.00', '2880949000.00', '2958142800.00'),
  (2096, 501, 'Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Pemerintahan (RPJPD, RPJMD dan RKPD)', '5.01.03.2.01.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Tersusunnya Dokumen Perencanaan Pembangunan Daerah Bidang Pemerintahan (RPJPD, RPJMD dan RKPD)', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Pemerintahan yang Dikoordinir Penyusunannya (RPJPD, RPJMD dan RKPD)', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '253000000.00', '253478000.00', '253497300.00', '255031500.00', '261865000.00'),
  (2097, 501, 'Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia (RPJPD, RPJMD dan RKPD)', '5.01.03.2.01.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia (RPJPD. RPJMD dan RKPD)', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan
RKPD)', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '337000000.00', '337636700.00', '337662300.00', '339705900.00', '348808200.00'),
  (2098, 502, 'Koordinasi Pelaksanaan Sinergitas dan Harmonisasi Perencanaan Pembangunan Daerah Bidang Perekonomian', '5.01.03.2.02.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Perekonomian', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Perekonomian', 'Laporan', NULL, '24', '24', '24', '24', '24', NULL, '316000000.00', '316597100.00', '316621100.00', '318537400.00', '327072500.00'),
  (2099, 502, 'Koordinasi Pelaksanaan Sinergitas dan Harmonisasi Perencanaan Pembangunan Daerah Bidang SDA', '5.01.03.2.02.0008', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang SDA', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang SDA', 'Laporan', NULL, '24', '24', '24', '24', '24', NULL, '704000000.00', '705330200.00', '705383800.00', '709653000.00', '728667800.00'),
  (2100, 502, 'Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Perekonomian (RPJPD, RPJMD dan RKPD)', '5.01.03.2.02.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Perekonomian (RPJPD. RPJMD dan RKPD)', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Perekonomian yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', NULL, '3', '3', '3', '3', '3', NULL, '316000000.00', '316597100.00', '316621100.00', '318537400.00', '327072500.00'),
  (2101, 502, 'Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang SDA (RPJPD, RPJMD dan RKPD)', '5.01.03.2.02.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang SDA (RPJPD. RPJMD dan RKPD)', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang SDA yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '158000000.00', '158298500.00', '158310500.00', '159268600.00', '163536100.00'),
  (2102, 503, 'Koordinasi Pelaksanaan Sinergitas dan Harmonisasi Perencanaan Pembangunan Daerah Bidang Infrastruktur', '5.01.03.2.03.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Infrastruktur', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Infrastruktur', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '153000000.00', '153289100.00', '153300700.00', '154228500.00', '158361000.00'),
  (2103, 503, 'Koordinasi Pelaksanaan Sinergitas dan Harmonisasi Perencanaan Pembangunan Daerah Bidang Kewilayahan', '5.01.03.2.03.0008', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Kewilayahan', 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Kewilayahan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '322000000.00', '322608400.00', '322632900.00', '324585600.00', '333282700.00'),
  (2104, 503, 'Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Infrastruktur (RPJPD, RPJMD dan RKPD)', '5.01.03.2.03.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Infrastruktur (RPJPD. RPJMD dan RKPD)', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Infrastruktur yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', NULL, '3', '3', '3', '3', '3', NULL, '443000000.00', '443837000.00', '443870700.00', '446557100.00', '458522400.00'),
  (2105, 503, 'Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Kewilayahan (RPJPD, RPJMD dan RKPD)', '5.01.03.2.03.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Kewilayahan (RPJPD, RPJMD dan RKPD)', 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Kewilayahan yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '401000000.00', '401757700.00', '401788200.00', '404219900.00', '415050800.00'),
  (2106, 504, 'Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', '5.05.02.2.01.0002', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 'Jumlah Laporan Hasil Pelaksanaan Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '140000000.00', '140264500.00', '140275200.00', '141124200.00', '144905600.00'),
  (2107, 505, 'Penelitian dan Pengembangan Pariwisata', '5.05.02.2.02.0005', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Penelitian dan Pengembangan Pariwisata', 'Jumlah Dokumen Hasil Penelitian dan
Pengembangan Pariwisata', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '204000000.00', '204385400.00', '204400900.00', '205638000.00', '211148000.00'),
  (2108, 506, 'Penelitian dan Pengembangan Pertanian, Perkebunan dan Pangan', '5.05.02.2.03.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Penelitian dan Pengembangan Pertanian, Perkebunan dan Pangan', 'Jumlah Dokumen Hasil Penelitian dan Pengembangan Pertanian, Perkebunan dan
Pangan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '140000000.00', '140264500.00', '140275200.00', '141124200.00', '144905600.00'),
  (2109, 507, 'Penelitian, Pengembangan, dan Perekayasaan di Bidang Teknologi dan Inovasi', '5.05.02.2.04.0001', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terlaksananya Penelitian, Pengembangan, dan Perekayasaan di Bidang Teknologi dan Inovasi', 'Jumlah Dokumen Hasil Penelitian,
Pengembangan, dan Perekayasaan di Bidang Teknologi dan Inovasi', 'Dokumen', NULL, '4', '4', '4', '4', '4', NULL, '340000000.00', '340642400.00', '340668300.00', '342730100.00', '351913400.00'),
  (2110, 507, 'Sosialisasi dan Diseminasi Hasil- Hasil Kelitbangan', '5.05.02.2.04.0004', NULL, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL, 'Terselenggaranya Sosialisasi dan Diseminasi Hasil-Hasil Kelitbangan', 'Jumlah Laporan Hasil Penyelenggaraan Sosialisasi dan Diseminasi Hasil-Hasil
Kelitbangan', 'Laporan', NULL, '5', '5', '5', '5', '5', NULL, '340000000.00', '340642400.00', '340668300.00', '342730100.00', '351913400.00');

-- Table: renstra_sub_kegiatan_sasaran (46 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2094, 2065, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2095, 2066, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2096, 2067, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2097, 2068, 'Terlaksananya Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2098, 2069, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2099, 2070, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2100, 2071, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2101, 2072, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2102, 2073, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2103, 2074, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2104, 2075, 'Terlaksananya Fasilitasi Kunjungan Tamu', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2105, 2076, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2106, 2077, 'Tersedianya Mebel', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2107, 2078, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2108, 2079, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2109, 2080, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2110, 2081, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2111, 2082, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2112, 2083, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2113, 2084, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2114, 2085, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2115, 2086, 'Terlaksananya Musrenbang Kabupaten/Kota', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2116, 2087, 'Tersedianya Usulan-Usulan yang Telah Terverifikasi oleh Kecamatan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2117, 2088, 'Terlaksananya Konsultasi Publik', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2118, 2089, 'Terlaksananya Forum Perangkat Daerah/Lintas Perangkat Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2119, 2090, 'Ditetapkannya Dokumen Perencanaan Pembangunan Daerah Kabupaten/Kota', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2120, 2091, 'Terinputnya Analisis Data dan Informasi untuk Perencanaan Pembangunan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2121, 2092, 'Tersusunnya Laporan Hasil Monitoring dan Evaluasi Berkala Pelaksanaan Pembangunan Daerah', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2122, 2093, 'Terlaksananya Pengendalian Perencanaan dan Pelaksanaan Pembangunan Daerah di Kabupaten/Kota', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2123, 2094, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Pemerintahan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2124, 2095, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Pembangunan Manusia', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2125, 2096, 'Tersusunnya Dokumen Perencanaan Pembangunan Daerah Bidang Pemerintahan (RPJPD, RPJMD dan RKPD)', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2126, 2097, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia (RPJPD. RPJMD dan RKPD)', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2127, 2098, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Perekonomian', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2128, 2099, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang SDA', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2129, 2100, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Perekonomian (RPJPD. RPJMD dan RKPD)', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2130, 2101, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang SDA (RPJPD. RPJMD dan RKPD)', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2131, 2102, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Infrastruktur', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2132, 2103, 'Sinkronnya Renstra/Renja dengan RKPD/RPJMD pada Bidang Kewilayahan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2133, 2104, 'Terkordinirnya Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Infrastruktur (RPJPD. RPJMD dan RKPD)', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2134, 2105, 'Terlaksananya Koordinasi Penyusunan Dokumen Perencanaan Pembangunan Daerah Bidang Kewilayahan (RPJPD, RPJMD dan RKPD)', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2135, 2106, 'Terlaksananya Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2136, 2107, 'Terlaksananya Penelitian dan Pengembangan Pariwisata', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2137, 2108, 'Terlaksananya Penelitian dan Pengembangan Pertanian, Perkebunan dan Pangan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2138, 2109, 'Terlaksananya Penelitian, Pengembangan, dan Perekayasaan di Bidang Teknologi dan Inovasi', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2139, 2110, 'Terselenggaranya Sosialisasi dan Diseminasi Hasil-Hasil Kelitbangan', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

-- Table: renstra_sub_kegiatan_indikator (46 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (2160, 2065, 2094, 87, 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', '1', '1', '110000000.00', '1', '110207800.00', '1', '110216200.00', '1', '110883300.00', '1', '113854400.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2161, 2066, 2095, 87, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Laporan', '7', '7', '50000000.00', '7', '50094500.00', '7', '50098300.00', '7', '50401500.00', '7', '51752000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2162, 2067, 2096, 87, 'Jumlah Orang yang Menerima Gaji dan
Tunjangan ASN', 'Orang/bulan', '37', '38', '10660940887.00', '38', '10681084300.00', '38', '10681895500.00', '38', '10746545200.00', '38', '11034494100.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2163, 2068, 2097, 87, 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi
yang Mengikuti Pendidikan dan Pelatihan', 'Orang', '55', '55', '150000000.00', '55', '150283400.00', '55', '150294800.00', '55', '151204400.00', '55', '155255900.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2164, 2069, 2098, 87, 'Jumlah Paket Komponen Instalasi
Listrik/Penerangan Bangunan Kantor yang Disediakan', 'Paket', '2', '2', '45000000.00', '2', '45085000.00', '2', '45088400.00', '2', '45361300.00', '2', '46576700.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2165, 2070, 2099, 87, 'Jumlah Paket Peralatan dan Perlengkapan
Kantor yang Disediakan', 'Paket', '2', '2', '150000000.00', '2', '150283400.00', '2', '150294800.00', '2', '151204400.00', '2', '155255900.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2166, 2071, 2100, 87, 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', '2', '2', '40000000.00', '2', '40075600.00', '2', '40078600.00', '2', '40321200.00', '2', '41401600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2167, 2072, 2101, 87, 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', '11', '11', '350000000.00', '11', '350661300.00', '11', '350687900.00', '11', '352810400.00', '11', '362263800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2168, 2073, 2102, 87, 'Jumlah Paket Barang Cetakan dan
Penggandaan yang Disediakan', 'Paket', '2', '2', '30000000.00', '2', '30056700.00', '2', '30059000.00', '2', '30240900.00', '2', '31051200.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2169, 2074, 2103, 87, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', '4', '4', '45000000.00', '4', '45085000.00', '4', '45088400.00', '4', '45361300.00', '4', '46576700.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2170, 2075, 2104, 87, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '12', '12', '200000000.00', '12', '200377900.00', '12', '200393100.00', '12', '201605900.00', '12', '207007800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2171, 2076, 2105, 87, 'Jumlah Laporan Penyelenggaraan Rapat
Koordinasi dan Konsultasi SKPD', 'Laporan', '240', '240', '1064800000.00', '240', '1066811900.00', '240', '1066892900.00', '240', '1073350000.00', '240', '1102109900.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2172, 2077, 2106, 87, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '2', '2', '224760056.00', '2', '225184750.00', '2', '225201850.00', '2', '226564900.00', '2', '232635650.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2173, 2078, 2107, 87, 'Jumlah Unit Gedung Kantor atau Bangunan
Lainnya yang Disediakan', 'Unit', '1', '1', '224760056.00', '1', '225184750.00', '1', '225201850.00', '1', '226564900.00', '1', '232635650.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2174, 2079, 2108, 87, 'Jumlah Laporan Penyediaan Jasa Surat
Menyurat', 'Laporan', '2', '2', '5000000.00', '2', '5009400.00', '2', '5009800.00', '2', '5040100.00', '2', '5175100.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2175, 2080, 2109, 87, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '200000000.00', '12', '200377900.00', '12', '200393100.00', '12', '201605900.00', '12', '207007800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2176, 2081, 2110, 87, 'Jumlah Laporan Penyediaan Jasa Pelayanan
Umum Kantor yang Disediakan', 'Laporan', '12', '12', '375200000.00', '12', '375908900.00', '12', '375937400.00', '12', '378212700.00', '12', '388346700.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2177, 2082, 2111, 87, 'Jumlah Kendaraan Perorangan Dinas atau
Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '3', '3', '55000000.00', '3', '55103900.00', '3', '55108100.00', '3', '55441600.00', '3', '56927100.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2178, 2083, 2112, 87, 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', 'Unit', '50', '50', '30000000.00', '50', '30056700.00', '50', '30059000.00', '50', '30240900.00', '50', '31051200.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2179, 2084, 2113, 87, 'Jumlah Gedung Kantor dan Bangunan Lainnya
yang Dipelihara/Direhabilitasi', 'Unit', '2', '2', '300000000.00', '2', '300566800.00', '2', '300589600.00', '2', '302408800.00', '2', '310511700.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2180, 2085, 2114, 87, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '1', '1', '50000000.00', '1', '50094500.00', '1', '50098300.00', '1', '50401500.00', '1', '51752000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2181, 2086, 2115, 87, 'Jumlah Berita Acara Musrenbang
Kabupaten/Kota', 'Berita Acara', '1', '1', '179000000.00', '1', '179338200.00', '1', '179351800.00', '1', '180437300.00', '1', '185272000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2182, 2087, 2116, 87, 'Jumlah Usulan yang Terverifikasi oleh
Kecamatan', 'Usulan', '1', '1', '116000000.00', '1', '116219200.00', '1', '116228000.00', '1', '116931400.00', '1', '120064500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2183, 2088, 2117, 87, 'Jumlah Berita Acara Konsultasi Publik (Berita
Acara)', 'Berita Acara', '1', '1', '127000000.00', '1', '127240000.00', '1', '127249700.00', '1', '128019800.00', '1', '131450000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2184, 2089, 2118, 87, 'Jumlah Berita Acara Forum Perangkat
Daerah/Lintas Perangkat Daerah', 'Berita Acara', '1', '1', '148000000.00', '1', '148279600.00', '1', '148290900.00', '1', '149188400.00', '1', '153185800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2185, 2090, 2119, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Kabupaten/Kota yang Ditetapkan
(RPJPD/RPJMD/RKPD)', 'Dokumen', '2', '2', '1160000000.00', '2', '1162191800.00', '2', '1162280100.00', '2', '1169314500.00', '2', '1200645800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2186, 2091, 2120, 87, 'Jumlah Dokumen Hasil Analisis Data untuk Penyusunan Kebijakan Perencanaan Pembangunan Daerah (Semua Perencanaan
Pembangunan Daerah', 'Dokumen', '1', '1', '116000000.00', '1', '116219200.00', '1', '116228000.00', '1', '116931400.00', '1', '120064500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2187, 2092, 2121, 87, 'Jumlah Laporan Hasil Evaluasi Kinerja
Pembangunan Daerah', 'Laporan', '1', '1', '251000000.00', '1', '251474300.00', '1', '251493400.00', '1', '253015500.00', '1', '259794900.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2188, 2093, 2122, 87, 'Jumlah Laporan Hasil Pengendalian
Perencanaan dan Pelaksanaan Pembangunan', 'Laporan', '4', '4', '113000000.00', '4', '113213500.00', '4', '113222100.00', '4', '113907400.00', '4', '116959500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2189, 2094, 2123, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Pemerintahan', 'Laporan', '18', '18', '274000000.00', '18', '274517700.00', '18', '274538500.00', '18', '276200100.00', '18', '283600800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2190, 2095, 2124, 87, 'Jumlah Laporan Hasil Sinkronisasi
Renstra/Renja dengan RKPD/RPJMD pada Bidang Pembangunan Manusia', 'Laporan', '13', '13', '2858000000.00', '13', '2863400100.00', '13', '2863617600.00', '13', '2880949000.00', '13', '2958142800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2191, 2096, 2125, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Pemerintahan yang Dikoordinir Penyusunannya (RPJPD, RPJMD dan RKPD)', 'Dokumen', '4', '4', '253000000.00', '4', '253478000.00', '4', '253497300.00', '4', '255031500.00', '4', '261865000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2192, 2097, 2126, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Pembangunan Manusia yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan
RKPD)', 'Dokumen', '4', '4', '337000000.00', '4', '337636700.00', '4', '337662300.00', '4', '339705900.00', '4', '348808200.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2193, 2098, 2127, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Perekonomian', 'Laporan', '24', '24', '316000000.00', '24', '316597100.00', '24', '316621100.00', '24', '318537400.00', '24', '327072500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2194, 2099, 2128, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang SDA', 'Laporan', '24', '24', '704000000.00', '24', '705330200.00', '24', '705383800.00', '24', '709653000.00', '24', '728667800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2195, 2100, 2129, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Perekonomian yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '3', '3', '316000000.00', '3', '316597100.00', '3', '316621100.00', '3', '318537400.00', '3', '327072500.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2196, 2101, 2130, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang SDA yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '2', '2', '158000000.00', '2', '158298500.00', '2', '158310500.00', '2', '159268600.00', '2', '163536100.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2197, 2102, 2131, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Infrastruktur', 'Laporan', '12', '12', '153000000.00', '12', '153289100.00', '12', '153300700.00', '12', '154228500.00', '12', '158361000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2198, 2103, 2132, 87, 'Jumlah Laporan Hasil Sinkronisasi Renstra/Renja dengan RKPD/RPJMD pada
Bidang Kewilayahan', 'Laporan', '12', '12', '322000000.00', '12', '322608400.00', '12', '322632900.00', '12', '324585600.00', '12', '333282700.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2199, 2104, 2133, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Infrastruktur yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '3', '3', '443000000.00', '3', '443837000.00', '3', '443870700.00', '3', '446557100.00', '3', '458522400.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2200, 2105, 2134, 87, 'Jumlah Dokumen Perencanaan Pembangunan Daerah Bidang Kewilayahan yang Dikoordinir Penyusunannya (RPJPD. RPJMD dan RKPD)', 'Dokumen', '4', '4', '401000000.00', '4', '401757700.00', '4', '401788200.00', '4', '404219900.00', '4', '415050800.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2201, 2106, 2135, 87, 'Jumlah Laporan Hasil Pelaksanaan Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 'Laporan', '3', '3', '140000000.00', '3', '140264500.00', '3', '140275200.00', '3', '141124200.00', '3', '144905600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2202, 2107, 2136, 87, 'Jumlah Dokumen Hasil Penelitian dan
Pengembangan Pariwisata', 'Dokumen', '2', '2', '204000000.00', '2', '204385400.00', '2', '204400900.00', '2', '205638000.00', '2', '211148000.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2203, 2108, 2137, 87, 'Jumlah Dokumen Hasil Penelitian dan Pengembangan Pertanian, Perkebunan dan
Pangan', 'Dokumen', '2', '2', '140000000.00', '2', '140264500.00', '2', '140275200.00', '2', '141124200.00', '2', '144905600.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2204, 2109, 2138, 87, 'Jumlah Dokumen Hasil Penelitian,
Pengembangan, dan Perekayasaan di Bidang Teknologi dan Inovasi', 'Dokumen', '4', '4', '340000000.00', '4', '340642400.00', '4', '340668300.00', '4', '342730100.00', '4', '351913400.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL),
  (2205, 2110, 2139, 87, 'Jumlah Laporan Hasil Penyelenggaraan Sosialisasi dan Diseminasi Hasil-Hasil
Kelitbangan', 'Laporan', '5', '5', '340000000.00', '5', '340642400.00', '5', '340668300.00', '5', '342730100.00', '5', '351913400.00', 10, '2026-09-26 18:19:02', '2026-09-26 18:19:02', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
