-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: DINAS PENDIDIKAN DAN KEBUDAYAAN (DISDIKBUD)
-- ID INSTANSI: 37 | KODE: 1.01.2.22.0.00.01.0000
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-23 16:40:08
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (DINAS PENDIDIKAN DAN KEBUDAYAAN SITUBONDO) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (37, '1.01.2.22.0.00.01.0000', '35.12', 'DINAS PENDIDIKAN DAN KEBUDAYAAN SITUBONDO', '1.01,2.22', NULL, NULL, '$2y$10$2GzpZAMu9qe1eBBcdjNoG.CgrPoO4LxeBtNi65MDSQSevEDXMo7uW', 4, 2025, 2029, '2026-09-08 12:45:41', '2026-09-22 18:48:26', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA DISDIKBUD SITUBONDO SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (481, 482, 483, 484, 485, 486, 487, 488, 489, 490, 491, 492, 493, 494, 495, 496, 497, 498, 499, 500, 501, 502, 503, 504, 505, 506, 507, 508, 509, 510, 511, 512, 513, 514, 515, 516, 517, 518, 519, 520, 521, 522, 523, 524, 525, 526, 527, 528, 529, 530, 531, 532, 533, 534, 535, 536, 537, 538, 539, 540, 541, 542, 543, 544, 545, 546, 547, 548, 549, 550, 551, 552, 553, 554, 555, 556, 557, 558, 559, 560, 561, 562, 563, 564, 565, 566, 567, 568, 569, 570, 571, 572, 573, 574, 575, 576, 577, 578, 579, 580, 581, 582, 583, 584, 585, 586, 587, 588, 589, 590, 591, 592, 593, 594, 595, 596, 597, 598, 599, 600, 601, 602, 603, 604, 605, 606, 607, 608, 609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620, 621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655, 656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667, 668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679, 680, 681, 682, 683, 684, 685, 686, 687, 688, 689, 690, 691, 692, 693, 694, 695, 696, 697, 698, 699, 700, 701, 702, 703, 704, 705, 706, 707, 708, 709, 710, 711, 712, 713, 714, 715, 716, 717, 718, 719, 720, 721, 722, 723, 724, 725, 726, 727, 728, 729, 730, 731, 732, 733, 734, 735, 736, 737, 738, 739);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (481, 482, 483, 484, 485, 486, 487, 488, 489, 490, 491, 492, 493, 494, 495, 496, 497, 498, 499, 500, 501, 502, 503, 504, 505, 506, 507, 508, 509, 510, 511, 512, 513, 514, 515, 516, 517, 518, 519, 520, 521, 522, 523, 524, 525, 526, 527, 528, 529, 530, 531, 532, 533, 534, 535, 536, 537, 538, 539, 540, 541, 542, 543, 544, 545, 546, 547, 548, 549, 550, 551, 552, 553, 554, 555, 556, 557, 558, 559, 560, 561, 562, 563, 564, 565, 566, 567, 568, 569, 570, 571, 572, 573, 574, 575, 576, 577, 578, 579, 580, 581, 582, 583, 584, 585, 586, 587, 588, 589, 590, 591, 592, 593, 594, 595, 596, 597, 598, 599, 600, 601, 602, 603, 604, 605, 606, 607, 608, 609, 610, 611, 612, 613, 614, 615, 616, 617, 618, 619, 620, 621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655, 656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667, 668, 669, 670, 671, 672, 673, 674, 675, 676, 677, 678, 679, 680, 681, 682, 683, 684, 685, 686, 687, 688, 689, 690, 691, 692, 693, 694, 695, 696, 697, 698, 699, 700, 701, 702, 703, 704, 705, 706, 707, 708, 709, 710, 711, 712, 713, 714, 715, 716, 717, 718, 719, 720, 721, 722, 723, 724, 725, 726, 727, 728, 729, 730, 731, 732, 733, 734, 735, 736, 737, 738, 739);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (55, 56, 57, 58, 59, 60, 61, 62);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (55, 56, 57, 58, 59, 60, 61, 62);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (55, 56, 57, 58, 59, 60, 61, 62);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (24, 25, 26);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (24, 25, 26);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (11);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (11);
DELETE FROM `renstra_tujuan` WHERE `id` IN (11) OR (`id_instansi` = 37 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD DISDIKBUD SITUBONDO
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (11, '35.12', 37, '33', 'Meningkatnya Akses Masyarakat terhadap layanan Pendidikan', NULL, NULL, 'Indeks Pendidikan', 'Indeks', NULL, '0.61', '0.615', '0.621', '0.627', '0.633', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (22, 11, 37, 'Indeks Pendidikan', 'Indeks', '0.598', NULL, '0.61', '0.615', '0.621', '0.627', '0.633', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

-- Table: renstra_sasaran (3 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (24, 11, 'Meningkatnya Akuntabilitas Kinerja Perangkat Daerah', NULL, NULL, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '86.05', '86.1', '86.15', '86.2', '86.25', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (25, 11, 'Meningkatnya Akses dan Mutu Pendidikan', NULL, NULL, 'Angka Rata-rata lama sekolah', 'tahun', NULL, '7.49', '7.63', '7.82', '7.94', '8.02', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (26, 11, 'Meningkatnya Akses dan Mutu Pendidikan', NULL, NULL, 'Prosentase Cagar Budaya dan Seni Lokal yang lestari', '%', NULL, '42.5', '43.25', '43.5', '44', '44.25', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (11 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (35, 24, 37, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '85.95', NULL, '86.05', '86.1', '86.15', '86.2', '86.25', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (36, 25, 37, 'Angka Rata-rata lama sekolah', 'tahun', '6.93', NULL, '7.49', '7.63', '7.82', '7.94', '8.02', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (37, 25, 37, 'Angka Harapan Lama Sekolah', 'tahun', '13.2', NULL, '13.23', '13.3', '13.39', '13.45', '13.49', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (38, 25, 37, 'APS ( Angka Partisipasi Sekolah) 5-6 tahun', '%', '77.43', NULL, '79.6', '80.68', '81.77', '82.85', '83.93', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (39, 25, 37, 'APS ( Angka Partisipasi Sekolah) 7-15 tahun', '%', '99.17', NULL, '100', '100', '100', '100', '100', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (40, 25, 37, 'APS ( Angka Partisipasi Sekolah) 7-18 tahun Kesetaraan', '%', '18.41', NULL, '26.61', '30.71', '34.81', '38.91', '43.01', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (41, 25, 37, 'Capaian Kompetensi Literasi SD', '%', '60.45', NULL, '65.45', '67.95', '70.45', '72.95', '75.45', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (42, 25, 37, 'Capaian Kompetensi Literasi SMP', '%', '67.72', NULL, '69.92', '71.02', '72.12', '73.22', '74.32', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (43, 25, 37, 'Capaian Kompetensi Numerasi SD', '', '54.31', NULL, '60.11', '63.01', '65.91', '68.81', '71.71', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (44, 25, 37, 'Capaian Kompetensi Numerasi SMP', '%', '61.3', NULL, '64.3', '65.8', '67.3', '68.8', '70.3', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (45, 26, 37, 'Prosentase Cagar Budaya dan Seni Lokal yang lestari', '%', '41.25', NULL, '42.5', '43.25', '43.5', '44', '44.25', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

-- Table: renstra_program (8 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (55, 24, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '1.01.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'MENINGKATNYA CAPAIAN NILAI SAKIP PERANGKAT DAERAH', 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '86.5', '86.1', '86.15', '86.2', '86.25', NULL, '409798000000.00', '412058000000.00', '412058000000.00', '412058000000.00', '412058000000.00'),
  (56, 25, 'PROGRAM PENGELOLAAN PENDIDIKAN', '1.01.02', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya Layanan Pendidikan PAUD/ Nonformal/ Kesetaraan pada UPT SPNF SANGGAR KEGIATAN BELAJAR', 'Proporsi jumlah satuan PAUD yang mendapatkan minimal akreditasi B', '%', NULL, '73.16', '73.57', '73.98', '74.39', '74.8', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (57, 25, 'PROGRAM PENDIDIK DAN TENAGA KEPENDIDIKAN', '1.01.04', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya kualitas tenaga pendidik dan kependidikan PAUD / Sekolah Dasar / Sekolah Menengah Pertama / Nonformal/Kesetaraan', 'Proporsi Guru PAUD Formal dengan kualifikasi S1/D IV', '%', NULL, '76.29', '76.79', '77.29', '77.29', '78.29', NULL, '28604000000.00', '29604000000.00', '29604000000.00', '29604000000.00', '29604000000.00'),
  (58, 26, 'PROGRAM PENGEMBANGAN KEBUDAYAAN', '2.22.02', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya Pengembangan Kebudayaan Lokal', 'Prosentase Budaya Lokal Yang dikembangkan', '%', NULL, '100', '100', '100', '100', '100', NULL, '2075000000.00', '2075000000.00', '2075000000.00', '2075000000.00', '2075000000.00'),
  (59, 26, 'PROGRAM PENGEMBANGAN KESENIAN TRADISIONAL', '2.22.03', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya Pengembangan Kesenian Tradisional', 'Prosentase Kelompok Seni Tradisional Yang Dibina', '%', NULL, '', '100', '100', '100', '100', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (60, 26, 'PROGRAM PEMBINAAN SEJARAH', '2.22.04', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya pembinaan dan pelestarian sejarah', 'Prosentase sejarah yang terpelihara', '%', NULL, '100', '100', '100', '100', '100', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (61, 26, 'PROGRAM PELESTARIAN DAN  PENGELOLAAN CAGAR BUDAYA', '2.22.05', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya Pengelolaan dan Pelestarian Cagar Budaya', 'Prosentase Cagar Budaya dan Seni Lokal yang Lestari', '%', NULL, '42.5', '43.25', '43.05', '44', '44.25', NULL, '1770000000.00', '1770000000.00', '1770000000.00', '1770000000.00', '1770000000.00'),
  (62, 26, 'PROGRAM PENGELOLAAN PERMUSEUMAN', '2.22.06', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, NULL, 'Meningkatnya Pengelolaan Permuseuma', 'Prosentase Museum yang dikelola', '%', NULL, '', '100', '100', '100', '100', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00');

-- Table: renstra_program_outcome (8 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (89, 55, 'MENINGKATNYA CAPAIAN NILAI SAKIP PERANGKAT DAERAH', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (90, 56, 'Meningkatnya Layanan Pendidikan PAUD/ Nonformal/ Kesetaraan pada UPT SPNF SANGGAR KEGIATAN BELAJAR', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (91, 57, 'Meningkatnya kualitas tenaga pendidik dan kependidikan PAUD / Sekolah Dasar / Sekolah Menengah Pertama / Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (92, 58, 'Meningkatnya Pengembangan Kebudayaan Lokal', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (93, 59, 'Meningkatnya Pengembangan Kesenian Tradisional', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (94, 60, 'Meningkatnya pembinaan dan pelestarian sejarah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (95, 61, 'Meningkatnya Pengelolaan dan Pelestarian Cagar Budaya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (96, 62, 'Meningkatnya Pengelolaan Permuseuma', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

-- Table: renstra_program_indikator (12 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (168, 55, 89, 37, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '85.95', '86.5', '86.1', '86.15', '86.2', '86.25', '409798000000.00', '412058000000.00', '412058000000.00', '412058000000.00', '412058000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (169, 56, 90, 37, 'Proporsi jumlah satuan PAUD yang mendapatkan minimal akreditasi B', '%', '72.34', '73.16', '73.57', '73.98', '74.39', '74.8', '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (170, 56, 90, 37, 'Jumlah anak usia 7-18 Tahun yang berpartisipasi dalam pendidikan
kesetaraan (APS)', '%', '18.41', '26.61', '30.71', '34.81', '38.91', '43.01', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 20),
  (171, 57, 91, 37, 'Proporsi Guru PAUD Formal dengan kualifikasi S1/D IV', '%', '78.48', '76.29', '76.79', '77.29', '77.29', '78.29', '28604000000.00', '29604000000.00', '29604000000.00', '29604000000.00', '29604000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (172, 57, 91, 37, 'Rata-rata kemampuan numerasi SMP berdasarkan Asesmen
Nasional', '%', '61.3', '64.3', '65.8', '67.3', '68.8', '70.3', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 20),
  (173, 57, 91, 37, 'Rata-rata kemampuan Numerasi SD berdasarkan asesmen nasional (Nilai)', '%', '54.31', '60.11', '63.01', '65.91', '68.81', '71.71', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 30),
  (174, 57, 91, 37, 'Rata-rata kemampuan literasi SMP berdasarkan
Asesmen Nasional', '%', '67.72', '69.92', '71.02', '72.12', '73.22', '74.32', '0.00', '0.00', '0.00', '0.00', '0.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 40),
  (175, 58, 92, 37, 'Prosentase Budaya Lokal Yang dikembangkan', '%', '100', '100', '100', '100', '100', '100', '2075000000.00', '2075000000.00', '2075000000.00', '2075000000.00', '2075000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (176, 59, 93, 37, 'Prosentase Kelompok Seni Tradisional Yang Dibina', '%', '100', '', '100', '100', '100', '100', '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (177, 60, 94, 37, 'Prosentase sejarah yang terpelihara', '%', '100', '100', '100', '100', '100', '100', '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (178, 61, 95, 37, 'Prosentase Cagar Budaya dan Seni Lokal yang Lestari', '%', '41.25', '42.5', '43.25', '43.05', '44', '44.25', '1770000000.00', '1770000000.00', '1770000000.00', '1770000000.00', '1770000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10),
  (179, 62, 96, 37, 'Prosentase Museum yang dikelola', '%', '', '', '100', '100', '100', '100', '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00', '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 10);

-- Table: renstra_kegiatan (22 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (100, 55, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '1.01.01.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Prosentase dokumen perencanaan, penganggaran dan evaluasi perangkat daerah', 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa Lingkup
Perangkat Daerah', 'Data', NULL, '12', '12', '12', '12', '12', NULL, '965000000.00', '965000000.00', '965000000.00', '965000000.00', '965000000.00'),
  (101, 55, 'Administrasi Keuangan Perangkat Daerah', '1.01.01.2.02', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Prosentase Penyediaan dokumen Administrasi keuangan tepat waktu', 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', NULL, '10', '10', '10', '10', '10', NULL, '400740000000.00', '403000000000.00', '403000000000.00', '403000000000.00', '403000000000.00'),
  (102, 55, 'Administrasi Barang Milik Daerah pada Perangkat Daerah', '1.01.01.2.03', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Persentase administrasi barang milik daerah', 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '310000000.00', '310000000.00', '310000000.00', '310000000.00', '310000000.00'),
  (103, 55, 'Administrasi Pendapatan Daerah Kewenangan Perangkat Daerah', '1.01.01.2.04', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Prosentase Penyediaan dokumen Pendapatan kewenangan PD tepat waktu', 'Jumlah Data Objek, Subjek dan Wajib Retribusi Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '350000000.00', '350000000.00', '350000000.00', '350000000.00', '350000000.00'),
  (104, 55, 'Administrasi Kepegawaian Perangkat Daerah', '1.01.01.2.05', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'prosentase pegawai yang terfasilitasi layanan kepegawaian', 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi Kepegawaian', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '375000000.00', '375000000.00', '375000000.00', '375000000.00', '375000000.00'),
  (105, 55, 'Administrasi Umum Perangkat Daerah', '1.01.01.2.06', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'prosentase kebutuhan kantor yang terfasilitasi', 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '1175000000.00', '1175000000.00', '1175000000.00', '1175000000.00', '1175000000.00'),
  (106, 55, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '1.01.01.2.07', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'prosentase pengadaan barang milik daerah sesuai dengan Rencana kebutuhan', 'Jumlah Unit Kendaraan Perorangan Dinas atau
Kendaraan Dinas Jabatan yang Disediakan', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '990000000.00', '990000000.00', '990000000.00', '990000000.00', '990000000.00'),
  (107, 56, 'Pengelolaan Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah lembaga UPT SPNF', 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen', 'SatuanPendidikan', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (108, 56, 'Pengelolaan Pendidikan Sekolah Dasar', '1.01.02.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'prosentase Drop Out SD/MI, ratio murid terhadap kelas SD/MI, ratio guru terhadap murid SD/MI dan Prosentase sekolah inklusi SD', 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'Satuan Pendidikan', NULL, '120', '120', '120', '120', '120', NULL, '5925000000.00', '7025000000.00', '7125000000.00', '7225000000.00', '7325000000.00'),
  (109, 56, 'Pengelolaan Pendidikan Sekolah Menengah Pertama', '1.01.02.2.02', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'prosentase Drop Out SMP/MTS, ratio murid terhadap kelas SMP/MTS, ratio guru terhadap murid SMP/MTS dan Prosentase sekolah inklusi SMP', 'Jumlah Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '8730000000.00', '8730000000.00', '8730000000.00', '8730000000.00', '8730000000.00'),
  (110, 56, 'Pengelolaan Pendidikan Anak Usia Dini (PAUD)', '1.01.02.2.03', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'ratio murid terhadap kelas PAUD, ratio guru terhadap murid PAUD dan Prosentase sekolah inklusi PAUD', 'Jumlah Ruang Serba Guna/Aula yang Telah Direhabilitasi sedang/berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '5120000000.00', '5120000000.00', '5120000000.00', '5120000000.00', '5120000000.00'),
  (111, 56, 'Pengelolaan Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Prsosentase melek huruf, Persentase lulusan pendidikan kesetaraan dan Jumlah Penerima Beasiswa Situbondo Cerdas', 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', NULL, '3', '3', '3', '3', '3', NULL, '9127000000.00', '9127000000.00', '9127000000.00', '9127000000.00', '9127000000.00'),
  (112, 57, 'Pemerataan Kuantitas dan Kualitas Pendidik dan Tenaga Kependidikan bagi Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', '1.01.04.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Prosentase guru ASN dan Non ASN TK yang bersertifikat pendidik, Prosentase guru ASN dan Non ASN SD yang bersertifikat pendidik dan Prosentase guru ASN dan Non ASN SMP yang bersertifikat pendidik', 'Jumlah Dokumen Hasil Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '28604000000.00', '29604000000.00', '29604000000.00', '29604000000.00', '29604000000.00'),
  (113, 58, 'Pengelolaan Kebudayaan yang Masyarakat Pelakunya dalam Daerah Kabupaten/Kota', '2.22.02.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah kebudayaan masyarakat yang dikelola dan Jumlah dokumen pengelolaan kebudayaan', 'Jumlah Lembaga dan Pranata Kebudayaan yang Dibina', 'Lembaga', NULL, '2', '2', '2', '2', '2', NULL, '850000000.00', '850000000.00', '850000000.00', '850000000.00', '850000000.00'),
  (114, 58, 'Pelestarian Kesenian Tradisional yang Masyarakat Pelakunya dalam Daerah Kabupaten/Kota', '2.22.02.2.02', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah kesenian tradisional yang dilestarikan dan Jumlah Orang/Lembaga yang diberi penghargaan', 'Jumlah Objek Pemajuan Tradisi Budaya yang Dilakukan Pelindungan,
Pengembangan dan Pemanfaatan', 'Objek', NULL, '5', '5', '5', '5', '5', NULL, '740000000.00', '740000000.00', '740000000.00', '740000000.00', '740000000.00'),
  (115, 58, 'Pembinaan Lembaga Adat yang Penganutnya dalam Daerah Kabupaten/Kota', '2.22.02.2.03', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah lembaga adat kesenian yang dibina', 'Jumlah Sumber Daya Manusia, Lembaga, dan
Pranata Adat yang Dibina', 'Orang', NULL, '15', '15', '15', '15', '15', NULL, '485000000.00', '485000000.00', '485000000.00', '485000000.00', '485000000.00'),
  (116, 59, 'Pembinaan Kesenian yang Masyarakat Pelakunya dalam Daerah Kabupaten/Kota', '2.22.03.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah kesenian lokal yang terbina', 'Jumlah Lembaga Kesenian Tradisional yang Ditingkatkan Kapasitasnya', 'Lembaga', NULL, '1', '1', '1', '1', '1', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (117, 60, 'Pembinaan Sejarah Lokal dalam 1 (Satu) Daerah Kabupaten/Kota', '2.22.04.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah sejarah lokal yang terbina (WBTB) dan Jumlah Hari Jadi Kabupaten/kota yang dilaksanakan', 'Jumlah Sarana dan Prasarana Pembinaan Sejarah', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (118, 61, 'Penetapan Cagar Budaya Peringkat Kabupaten/Kota', '2.22.05.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah cagar budaya yang ditetapkan kepala daerah', 'Jumlah Warisan Budaya
Tak Benda yang Diusulkan', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '735000000.00', '735000000.00', '735000000.00', '735000000.00', '735000000.00'),
  (119, 61, 'Pengelolaan Cagar Budaya Peringkat Kabupaten/Kota', '2.22.05.2.02', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah cagar budaya yang dikelola', 'Jumlah Objek Cagar
Budaya yang Dilindungi', 'Objek', NULL, '2', '2', '2', '2', '2', NULL, '785000000.00', '785000000.00', '785000000.00', '785000000.00', '785000000.00'),
  (120, 61, 'Penerbitan Izin Membawa Cagar Budaya ke Luar Daerah Kabupaten/Kota dalam 1 (Satu) Daerah Kabupaten/Kota', '2.22.05.2.03', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Prosentase ijin cagar budaya ke luar daerah yang diterbitkan', 'Jumlah Objek Cagar Budaya yang Mendapatkan Perizinan ke Luar Daerah
Provinsi', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (121, 62, 'Pengelolaan Museum Kabupaten/Kota', '2.22.06.2.01', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Jumlah museum yang di kelola', 'Jumlah Layanan Operasional Museum', 'Layanan', NULL, '1', '1', '1', '1', '1', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00');

-- Table: renstra_kegiatan_sasaran (22 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (113, 100, 'Prosentase dokumen perencanaan, penganggaran dan evaluasi perangkat daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (114, 101, 'Prosentase Penyediaan dokumen Administrasi keuangan tepat waktu', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (115, 102, 'Persentase administrasi barang milik daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (116, 103, 'Prosentase Penyediaan dokumen Pendapatan kewenangan PD tepat waktu', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (117, 104, 'prosentase pegawai yang terfasilitasi layanan kepegawaian', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (118, 105, 'prosentase kebutuhan kantor yang terfasilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (119, 106, 'prosentase pengadaan barang milik daerah sesuai dengan Rencana kebutuhan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (120, 107, 'Jumlah lembaga UPT SPNF', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (121, 108, 'prosentase Drop Out SD/MI, ratio murid terhadap kelas SD/MI, ratio guru terhadap murid SD/MI dan Prosentase sekolah inklusi SD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (122, 109, 'prosentase Drop Out SMP/MTS, ratio murid terhadap kelas SMP/MTS, ratio guru terhadap murid SMP/MTS dan Prosentase sekolah inklusi SMP', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (123, 110, 'ratio murid terhadap kelas PAUD, ratio guru terhadap murid PAUD dan Prosentase sekolah inklusi PAUD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (124, 111, 'Prsosentase melek huruf, Persentase lulusan pendidikan kesetaraan dan Jumlah Penerima Beasiswa Situbondo Cerdas', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (125, 112, 'Prosentase guru ASN dan Non ASN TK yang bersertifikat pendidik, Prosentase guru ASN dan Non ASN SD yang bersertifikat pendidik dan Prosentase guru ASN dan Non ASN SMP yang bersertifikat pendidik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (126, 113, 'Jumlah kebudayaan masyarakat yang dikelola dan Jumlah dokumen pengelolaan kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (127, 114, 'Jumlah kesenian tradisional yang dilestarikan dan Jumlah Orang/Lembaga yang diberi penghargaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (128, 115, 'Jumlah lembaga adat kesenian yang dibina', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (129, 116, 'Jumlah kesenian lokal yang terbina', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (130, 117, 'Jumlah sejarah lokal yang terbina (WBTB) dan Jumlah Hari Jadi Kabupaten/kota yang dilaksanakan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (131, 118, 'Jumlah cagar budaya yang ditetapkan kepala daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (132, 119, 'Jumlah cagar budaya yang dikelola', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (133, 120, 'Prosentase ijin cagar budaya ke luar daerah yang diterbitkan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (134, 121, 'Jumlah museum yang di kelola', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

-- Table: renstra_kegiatan_indikator (267 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (489, 100, 113, 37, 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa Lingkup
Perangkat Daerah', 'Data', '', '12', '965000000.00', '12', '965000000.00', '12', '965000000.00', '12', '965000000.00', '12', '965000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (490, 100, 113, 37, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (491, 100, 113, 37, 'Jumlah Dokumen Hasil Penyelenggaraan Walidata Pendukung Statistik Sektoral Daerah', 'Dokumen', '1', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (492, 100, 113, 37, 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (493, 100, 113, 37, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (494, 100, 113, 37, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (495, 100, 113, 37, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (496, 100, 113, 37, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi
Kinerja SKPD', 'Laporan', '1', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (497, 100, 113, 37, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '1', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (498, 100, 113, 37, 'Jumlah Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD yang disusun', 'Dokumen', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (499, 100, 113, 37, 'Jumlah Subtansi Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 'Substansi', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (500, 100, 113, 37, 'Jumlah Berita Acara Hasil Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat
Daerah', 'Berita Acara', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 120, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (501, 100, 113, 37, 'Jumlah Berita Acara Hasil Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis Pembangunan', 'Berita Acara', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 130, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (502, 101, 114, 37, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '10', '10', '400740000000.00', '10', '403000000000.00', '10', '403000000000.00', '10', '403000000000.00', '10', '403000000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (503, 101, 114, 37, 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', '3', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (504, 101, 114, 37, 'Jumlah Dokumen Koordinasi dan Pelaksanaan Akuntansi
SKPD', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (505, 101, 114, 37, 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi
Anggaran', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (506, 101, 114, 37, 'Jumlah Dokumen Penatausahaan dan Pengujian/Verifikasi', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (507, 101, 114, 37, 'Keuangan SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (508, 101, 114, 37, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun
SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (509, 101, 114, 37, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semes
teran SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (510, 101, 114, 37, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '4500/12', '4500/12', '0.00', '4500/12', '0.00', '4500/12', '0.00', '4500/12', '0.00', '4500/12', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (511, 102, 115, 37, 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Laporan', '4', '4', '310000000.00', '4', '310000000.00', '4', '310000000.00', '4', '310000000.00', '4', '310000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (512, 102, 115, 37, 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (513, 102, 115, 37, 'Jumlah Dokumen Pengamanan Barang Milik Daerah SKPD', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (514, 102, 115, 37, 'Jumlah Rencana Kebutuhan Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (515, 102, 115, 37, 'Jumlah Dokumen Hasil Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (516, 102, 115, 37, 'Jumlah Laporan Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada
SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (517, 102, 115, 37, 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (518, 103, 116, 37, 'Jumlah Data Objek, Subjek dan Wajib Retribusi Daerah', 'Dokumen', '', '1', '350000000.00', '1', '350000000.00', '1', '350000000.00', '1', '350000000.00', '1', '350000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (519, 103, 116, 37, 'Jumlah Dokumen Hasil Analisis serta Pengembangan Retribusi Daerah dan Kebijakan Retribusi Daerah', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (520, 103, 116, 37, 'Jumlah Dokumen Ketetapan Retribusi
Daerah', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (521, 103, 116, 37, 'Jumlah Dokumen Rencana Pengelolaan Retribusi Daerah', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (522, 103, 116, 37, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan
Pelaporan Data Retribusi Daerah', 'Laporan', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (523, 103, 116, 37, 'Jumlah Laporan Hasil Penyuluhan dan Penyebarluasan Kebijakan
Retribusi Daerah', 'Laporan', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (524, 103, 116, 37, 'Jumlah Laporan Pengelolaan Retribusi
Daerah', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (525, 104, 117, 37, 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi Kepegawaian', 'Dokumen', '', '1', '375000000.00', '1', '375000000.00', '1', '375000000.00', '1', '375000000.00', '1', '375000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (526, 104, 117, 37, 'Jumlah Orang yang Mengikuti Bimbingan Teknis Implementasi Peraturan Perundang-
Undangan', 'Orang', '', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (527, 104, 117, 37, 'Jumlah Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Unit', '', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (528, 104, 117, 37, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (529, 104, 117, 37, 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (530, 104, 117, 37, 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi
Kepegawaian', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (531, 105, 118, 37, 'Jumlah Paket Bahan Logistik Kantor yang
Disediakan', 'Paket', '1', '1', '1175000000.00', '1', '1175000000.00', '1', '1175000000.00', '1', '1175000000.00', '1', '1175000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (532, 105, 118, 37, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (533, 105, 118, 37, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada
SKPD', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (534, 105, 118, 37, 'Jumlah Dokumen Penatausahaan Arsip Dinamis pada SKPD', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (535, 105, 118, 37, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (536, 105, 118, 37, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (537, 105, 118, 37, 'Jumlah Paket Bahan/Material yang
Disediakan', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (538, 105, 118, 37, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (539, 105, 118, 37, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (540, 105, 118, 37, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (541, 105, 118, 37, 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (542, 106, 119, 37, 'Jumlah Unit Kendaraan Perorangan Dinas atau
Kendaraan Dinas Jabatan yang Disediakan', 'Unit', '', '2', '990000000.00', '2', '990000000.00', '2', '990000000.00', '2', '990000000.00', '2', '990000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (543, 106, 119, 37, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (544, 106, 119, 37, 'Jumlah Unit Aset Tak
Berwujud yang Disediakan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (545, 106, 119, 37, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (546, 106, 119, 37, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang Disediakan', 'Unit', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (547, 106, 119, 37, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau
Bangunan Lainnya yang Disediakan', 'Unit', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (548, 106, 119, 37, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya
yang Disediakan', 'Unit', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (549, 106, 119, 37, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (550, 106, 119, 37, 'Jumlah Peralatan dan
Mesin Lainnya yang Dipelihara', 'Unit', '', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (551, 106, 119, 37, 'Jumlah Mebel yang Dipelihara', 'Unit', '5', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (552, 106, 119, 37, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan
yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '7', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (553, 106, 119, 37, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara
dan dibayarkan Pajak dan Perizinannya', 'Unit', '171', '171', '0.00', '171', '0.00', '171', '0.00', '171', '0.00', '171', '0.00', 120, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (554, 106, 119, 37, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '5', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 130, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (555, 106, 119, 37, 'Jumlah Aset Tak Berwujud yang Dipelihara', 'Unit', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 140, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (556, 107, 120, 37, 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen', 'SatuanPendidikan', '1', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (557, 108, 121, 37, 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'Satuan Pendidikan', '120', '120', '5925000000.00', '120', '7025000000.00', '120', '7125000000.00', '120', '7225000000.00', '120', '7325000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (558, 108, 121, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Paket', '10', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (559, 108, 121, 37, 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (560, 108, 121, 37, 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', '', '110', '0.00', '110', '0.00', '110', '0.00', '110', '0.00', '110', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (561, 108, 121, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (562, 108, 121, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (563, 108, 121, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (564, 108, 121, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', '', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (565, 108, 121, 37, 'Jumlah konten digital untuk pendidikan yang telah dikembangkan', 'Konten Digital', '1', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (566, 108, 121, 37, 'Jumlah Laboratorium Sekolah Dasar yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (567, 108, 121, 37, 'Jumlah Mebel Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', '50', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (568, 108, 121, 37, 'Jumlah Mebel sekolah yang Tersedia', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 120, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (569, 108, 121, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 130, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (570, 108, 121, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '250', '250', '0.00', '250', '0.00', '250', '0.00', '250', '0.00', '250', '0.00', 140, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (571, 108, 121, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada Satuan
Pendidikan Sekolah Dasar', 'Orang', '150', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', 150, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (572, 108, 121, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '1', '110', '0.00', '110', '0.00', '110', '0.00', '110', '0.00', '110', '0.00', 160, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (573, 108, 121, 37, 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 170, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (574, 108, 121, 37, 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 180, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (575, 108, 121, 37, 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 190, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (576, 108, 121, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas
Bidang Pendidikan yang dilaksanakan', 'Orang', '', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', 200, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (577, 108, 121, 37, 'Jumlah Peserta Didik Sekolah Dasar yang Menerima Biaya Personil
Peserta Didik', 'Peserta Didik', '150', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', 210, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (578, 108, 121, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 220, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (579, 108, 121, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 230, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (580, 108, 121, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 240, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (581, 108, 121, 37, 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 250, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (582, 108, 121, 37, 'Jumlah Ruang Laboratorium Sekolah Dasar yang Telah
Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 260, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (583, 108, 121, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 270, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (584, 108, 121, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 280, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (585, 108, 121, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 290, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (586, 108, 121, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 300, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (587, 108, 121, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 310, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (588, 108, 121, 37, 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang
Telah Dibangun', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 320, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (589, 108, 121, 37, 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Telah DiRehabilitasi
Sedang/Berat', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 330, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (590, 108, 121, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 340, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (591, 108, 121, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Dibangun', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 350, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (592, 108, 121, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 360, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (593, 108, 121, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 370, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (594, 108, 121, 37, 'Jumlah Sekolah Dasar yang Dilaksanakan Pembinaan Kelembagaan
dan manajemen sekolah', 'Satuan Pendidikan', '444', '444', '0.00', '444', '0.00', '444', '0.00', '444', '0.00', '444', '0.00', 380, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (595, 108, 121, 37, 'Jumlah Sekolah Dasar yang Mengelola Dana BOS', 'Satuan Pendidikan', '444', '444', '0.00', '444', '0.00', '444', '0.00', '444', '0.00', '444', '0.00', 390, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (596, 108, 121, 37, 'Jumlah Siswa yang Mengikuti Ajang Kompetisi/Lomba
Akademik dan Non Akademik', 'Peserta Didik', '300', '300', '0.00', '300', '0.00', '300', '0.00', '300', '0.00', '300', '0.00', 400, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (597, 108, 121, 37, 'Jumlah Tenaga Pengelola yang Meningkat Kapasitasnya dalam Pengelolaan Dana BOS
Sekolah Dasar', 'Orang', '20', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', 410, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (598, 109, 122, 37, 'Jumlah Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Unit', '', '1', '8730000000.00', '1', '8730000000.00', '1', '8730000000.00', '1', '8730000000.00', '1', '8730000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (599, 109, 122, 37, 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Unit', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (600, 109, 122, 37, 'Jumlah Asrama Sekolah yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (601, 109, 122, 37, 'Jumlah Asrama Sekolah
yang telah direhabilitasi sedang/berat', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (602, 109, 122, 37, 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', '', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (603, 109, 122, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', '', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (604, 109, 122, 37, 'Jumlah Fasilitas Parkir yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (605, 109, 122, 37, 'Jumlah Fasilitas Parkir
yang Telah Direhabilitasi Sedang/Berat', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (606, 109, 122, 37, 'Jumlah Kantin Sekolah
yang Direhabilitasi Sedang/Berat', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (607, 109, 122, 37, 'Jumlah Kantin Sekolah yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (608, 109, 122, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (609, 109, 122, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 120, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (610, 109, 122, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', '', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', '9', '0.00', 130, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (611, 109, 122, 37, 'Jumlah konten digital untuk pendidikan yang telah dikembangkan', 'KontenDigital', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 140, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (612, 109, 122, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Paket', '', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 150, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (613, 109, 122, 37, 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana BOS Sekolah Menengah
Pertama', 'Orang', '', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 160, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (614, 109, 122, 37, 'Jumlah Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non
Akademik', 'Peserta Didik', '150', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', 170, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (615, 109, 122, 37, 'Jumlah Sekolah Menengah pertama yang Mengelola
Dana BOS', 'Satuan Pendidikan', '98', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', 180, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (616, 109, 122, 37, 'Jumlah Sekolah Menengah Pertama yang Dilaksanakan Pembinaan', 'Satuan Pendidikan', '98', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', 190, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (617, 109, 122, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 200, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (618, 109, 122, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 210, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (619, 109, 122, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Dibangun', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 220, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (620, 109, 122, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 230, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (621, 109, 122, 37, 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang
Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 240, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (622, 109, 122, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 250, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (623, 109, 122, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 260, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (624, 109, 122, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 270, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (625, 109, 122, 37, 'Jumlah Ruang Serba Guna/Aula yang Telah Direhabilitasi sedang/berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 280, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (626, 109, 122, 37, 'Jumlah Ruang Serba Guna/Aula yang Telah
Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 290, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (627, 109, 122, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 300, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (628, 109, 122, 37, 'yang Telah Direhabilitasi', 'Ruang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 310, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (629, 109, 122, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 320, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (630, 109, 122, 37, 'Jumlah Ruang
Laboratorium yang Telah Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 330, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (631, 109, 122, 37, 'Jumlah Ruang kelas sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '1', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 340, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (632, 109, 122, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 350, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (633, 109, 122, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 360, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (634, 109, 122, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 370, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (635, 109, 122, 37, 'Jumlah Peserta Didik yang Mengikuti Proses Belajar', 'Satuan Pendidikan', '98', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', 380, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (636, 109, 122, 37, 'Jumlah Peserta didik Sekolah Menengah Pertama yang Menerima
Biaya Personil Peserta Didik', 'Peserta Didik', '', '200', '0.00', '200', '0.00', '200', '0.00', '200', '0.00', '200', '0.00', 390, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (637, 109, 122, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', '25', '0.00', 400, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (638, 109, 122, 37, 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 410, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (639, 109, 122, 37, 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 420, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (640, 109, 122, 37, 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 430, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (641, 109, 122, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 440, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (642, 109, 122, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada Satuan Pendidikan Sekolah Menengah Pertama', 'Orang', '', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', 450, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (643, 109, 122, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', '98', '0.00', 460, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (644, 109, 122, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 470, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (645, 109, 122, 37, 'Jumlah Mebel Sekolah yang Tersedia', 'Paket', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 480, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (646, 109, 122, 37, 'Jumlah Mebel Sekolah
yang Dilaksanakan Pemeliharaan', 'Unit', '', '60', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', 490, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (647, 109, 122, 37, 'Jumlah Laboratorium yang
Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 500, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (648, 110, 123, 37, 'Jumlah Ruang Serba Guna/Aula yang Telah Direhabilitasi sedang/berat', 'Ruang', '', '1', '5120000000.00', '1', '5120000000.00', '1', '5120000000.00', '1', '5120000000.00', '1', '5120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (649, 110, 123, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (650, 110, 123, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (651, 110, 123, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (652, 110, 123, 37, 'Jumlah Sarana, Prasarana dan Utilitas PAUD yang Telah Dibangun', 'Unit', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (653, 110, 123, 37, 'Jumlah Sarana, Prasarana dan Utilitas PAUD yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (654, 110, 123, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (655, 110, 123, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik
PAUD yang Tersedia', 'Paket', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (656, 110, 123, 37, 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana
BOP PAUD', 'Orang', '', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (657, 110, 123, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (658, 110, 123, 37, 'Jumlah Alat Rumah Tangga PAUD yang
Tersedia', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (659, 110, 123, 37, 'Jumlah Buku Teks dan Non Teks yang Diterima
Peserta Didik', 'Buku', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 120, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (660, 110, 123, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang
Pendidikan', 'Dokumen', '', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 130, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (661, 110, 123, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 140, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (662, 110, 123, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 150, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (663, 110, 123, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga
Pendidik yang terfasilitasi', 'Komunitas', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 160, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (664, 110, 123, 37, 'Jumlah konten digital untuk pendidikan yang telah dikembangkan', 'Konten Digital', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 170, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (665, 110, 123, 37, 'Jumlah Mebel PAUD yang Tersedia', 'Paket', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 180, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (666, 110, 123, 37, 'Jumlah Mebel Sekolah yang Dipelihara', 'Unit', '', '60', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', '60', '0.00', 190, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (667, 110, 123, 37, 'Jumlah PAUD yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen', 'Satuan Pendidikan', '', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 200, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (668, 110, 123, 37, 'Jumlah PAUD yang Mengelola Dana BOP', 'Satuan Pendidikan', '782', '782', '0.00', '782', '0.00', '782', '0.00', '782', '0.00', '782', '0.00', 210, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (669, 110, 123, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan
fasilitasi peningkatan profesi', 'Orang', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 220, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (670, 110, 123, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', 230, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (671, 110, 123, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada PAUD', 'Orang', '', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 240, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (672, 110, 123, 37, 'Jumlah perlengkapan
PAUD yang Tersedia', 'Paket', '', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', '3', '0.00', 250, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (673, 110, 123, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 260, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (674, 110, 123, 37, 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 270, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (675, 110, 123, 37, 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 280, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (676, 110, 123, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', '20', '0.00', 290, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (677, 110, 123, 37, 'Jumlah Peserta Didik PAUD yang Menerima Biaya Personil Peserta
Didik', 'Peserta Didik', '', '1000', '0.00', '1000', '0.00', '1000', '0.00', '1000', '0.00', '1000', '0.00', 300, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (678, 110, 123, 37, 'Jumlah Peserta Didik PAUD yang Mengikuti Proses Belajar', 'Satuan Pendidikan', '', '250', '0.00', '250', '0.00', '250', '0.00', '250', '0.00', '250', '0.00', 310, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (679, 110, 123, 37, 'Jumlah Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba
Akademik dan Non Akademik', 'Peserta Didik', '', '250', '0.00', '250', '0.00', '250', '0.00', '250', '0.00', '250', '0.00', 320, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (680, 110, 123, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 330, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (681, 110, 123, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
sedang/berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 340, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (682, 110, 123, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '1', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 350, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (683, 110, 123, 37, 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 360, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (684, 110, 123, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 370, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (685, 110, 123, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 380, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (686, 111, 124, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', '', '3', '9127000000.00', '3', '9127000000.00', '3', '9127000000.00', '3', '9127000000.00', '3', '9127000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (687, 111, 124, 37, 'Pendidik Satuan Pendidikan Nonformal/Kesetaraan
yang mendapat sertifikat kompetensi', 'Orang', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (688, 111, 124, 37, 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 'Orang', '', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (689, 111, 124, 37, 'Jumlah Taman Bacaan Masyarakat yang Telah Direhabilitasi sedang/berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (690, 111, 124, 37, 'Jumlah Taman Bacaan
Masyarakat yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (691, 111, 124, 37, 'Jumlah Sekolah Nonformal/Kesetaraan yang Mengelola Dana BOP', 'Satuan Pendidikan', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (692, 111, 124, 37, 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen', 'Satuan Pendidikan', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (693, 111, 124, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (694, 111, 124, 37, 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'Peserta Didik', '', '215', '0.00', '215', '0.00', '215', '0.00', '215', '0.00', '215', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (695, 111, 124, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang
Telah Direhabilitasi Sedang/Berat', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (696, 111, 124, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 110, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (697, 111, 124, 37, 'Jumlah Sarana, Prasarana dan Utilitas Pendidikan Non Formal yang Telah
Dibangun', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 120, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (698, 111, 124, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 130, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (699, 111, 124, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 140, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (700, 111, 124, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 150, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (701, 111, 124, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 160, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (702, 111, 124, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 170, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (703, 111, 124, 37, 'Jumlah Ruang Laboratorium yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 180, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (704, 111, 124, 37, 'Jumlah Ruang
Laboratorium yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 190, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (705, 111, 124, 37, 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 200, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (706, 111, 124, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 210, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (707, 111, 124, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 220, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (708, 111, 124, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Dibangun', 'Ruang', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 230, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (709, 111, 124, 37, 'Jumlah Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non
Akademik', 'Peserta Didik', '', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', '30', '0.00', 240, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (710, 111, 124, 37, 'Jumlah Peserta Didik Nonformal/Kesetaraan yang Menerima Biaya Personil Peserta Didik', 'Peserta Didik', '', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 250, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (711, 111, 124, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 260, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (712, 111, 124, 37, 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 270, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (713, 111, 124, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 280, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (714, 111, 124, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia bagi Satuan Pendidikan Nonformal/Kesetaraan', 'Orang', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 290, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (715, 111, 124, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 300, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (716, 111, 124, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 310, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (717, 111, 124, 37, 'Jumlah Mebel Sekolah yang Tersedia', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 320, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (718, 111, 124, 37, 'Jumlah Mebel Pendidikan Nonformal/Kesetaraan
yang Dilaksanakan Pemeliharaan', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 330, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (719, 111, 124, 37, 'Jumlah konten digital untuk pendidikan yang telah dikembangkan', 'Konten Digital', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 340, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (720, 111, 124, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 350, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (721, 111, 124, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 360, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (722, 111, 124, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', '', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 370, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (723, 111, 124, 37, 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', '', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', '28', '0.00', 380, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (724, 111, 124, 37, 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 390, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (725, 111, 124, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik Nonformal/ Kesetaraan
yang Tersedia', 'Paket', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 400, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (726, 112, 125, 37, 'Jumlah Dokumen Hasil Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Dokumen', '12', '12', '28604000000.00', '12', '29604000000.00', '12', '29604000000.00', '12', '29604000000.00', '12', '29604000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (727, 112, 125, 37, 'Jumlah Laporan Hasil Pelaksanaan Penataan Pendistribusian Pendidik dan Tenaga Kependidikan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (728, 113, 126, 37, 'Jumlah Lembaga dan Pranata Kebudayaan yang Dibina', 'Lembaga', '', '2', '850000000.00', '2', '850000000.00', '2', '850000000.00', '2', '850000000.00', '2', '850000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (729, 113, 126, 37, 'Jumlah Sumber Daya Manusia Kebudayaan yang
Dibina', 'Orang', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (730, 113, 126, 37, 'Jumlah PPKD Kabupaten/Kota yang
Disusun, Dimutakhirkan dan Ditetapkan', 'Dokumen', '', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (731, 113, 126, 37, 'Jumlah Objek Pemajuan Kebudayaan yang Dilakukan Pelindungan,
Pengembangan, Pemanfaatan', 'Objek', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (732, 113, 126, 37, 'Jumlah Peserta Pembinaan Sumber Daya Manusia, Lembaga, dan
Pranata Kebudayaan', 'Orang', '', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (733, 114, 127, 37, 'Jumlah Objek Pemajuan Tradisi Budaya yang Dilakukan Pelindungan,
Pengembangan dan Pemanfaatan', 'Objek', '', '5', '740000000.00', '5', '740000000.00', '5', '740000000.00', '5', '740000000.00', '5', '740000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (734, 114, 127, 37, 'Jumlah Orang/Lembaga yang Diberi Penghargaan untuk Mereka yang Berjasa
dalam Pemajuan Kebudayaan', 'Sertifikat', '', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', '150', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (735, 114, 127, 37, 'Jumlah Laporan Pembinaan Sumber Daya Manusia, Lembaga, dan
Pranata Tradisional', 'Laporan', '', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (736, 115, 128, 37, 'Jumlah Sumber Daya Manusia, Lembaga, dan
Pranata Adat yang Dibina', 'Orang', '', '15', '485000000.00', '15', '485000000.00', '15', '485000000.00', '15', '485000000.00', '15', '485000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (737, 115, 128, 37, 'Jumlah Sarana dan Prasarana Lembaga Adat yang Disediakan/Difasilitasi', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (738, 115, 128, 37, 'Jumlah Objek Pemajuan Lembaga Adat yang Telah Dilakukan Pelindungan, Pengembangan dan
Pemanfaatan', 'Objek', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (739, 116, 129, 37, 'Jumlah Lembaga Kesenian Tradisional yang Ditingkatkan Kapasitasnya', 'Lembaga', '', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (740, 116, 129, 37, 'Jumlah Sumber Daya Manusia Kesenian Tradisonal yang Mengikuti Proses Standarisasi', 'Sertifikat', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (741, 116, 129, 37, 'Jumlah Sumber Daya Manusia Kesenian Tradisional yang Mendapat Pendidikan dan Pelatihan (Ditingkatkan
Kompetensinya)', 'Orang', '', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (742, 117, 130, 37, 'Jumlah Sarana dan Prasarana Pembinaan Sejarah', 'Unit', '', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (743, 117, 130, 37, 'Jumlah Sumber Daya Manusia dan Lembaga Sejarah Lokal Provinsi
yang Diberdayakan', 'Orang', '', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', '15', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (744, 117, 130, 37, 'Jumlah Dokumen Data dan Informasi Sejarah yang Dapat Diakses Masyarakat', 'Dokumen', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (745, 118, 131, 37, 'Jumlah Warisan Budaya
Tak Benda yang Diusulkan', 'Objek', '', '1', '735000000.00', '1', '735000000.00', '1', '735000000.00', '1', '735000000.00', '1', '735000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (746, 118, 131, 37, 'Jumlah Objek Cagar
Budaya yang Ditetapkan', 'Objek', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (747, 118, 131, 37, 'Jumlah Objek Diduga
Cagar Budaya yang Didaftarkan', 'Objek', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (748, 119, 132, 37, 'Jumlah Objek Cagar
Budaya yang Dilindungi', 'Objek', '', '2', '785000000.00', '2', '785000000.00', '2', '785000000.00', '2', '785000000.00', '2', '785000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (749, 119, 132, 37, 'Jumlah Cagar Budaya dan Objek Pemajuan Kebudayaan yang
Diinventarisasi', 'Objek', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (750, 119, 132, 37, 'Jumlah Objek Cagar Budaya yang
Dikembangkan', 'Objek', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (751, 119, 132, 37, 'Jumlah Objek Cagar Budaya yang
Dimanfaatkan', 'Objek', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (752, 120, 133, 37, 'Jumlah Objek Cagar Budaya yang Mendapatkan Perizinan ke Luar Daerah
Provinsi', 'Objek', '', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (753, 120, 133, 37, 'Jumlah Laporan Hasil Evaluasi dan Pengawasan Cagar Budaya ke Luar
Daerah Provinsi', 'Laporan', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (754, 121, 134, 37, 'Jumlah Layanan Operasional Museum', 'Layanan', '', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (755, 121, 134, 37, 'Jumlah Sarana dan Prasarana Museum yang Tersedia dan Terpelihara', 'Unit', '', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

-- Table: renstra_sub_kegiatan (259 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (481, 100, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '1.01.01.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (482, 100, 'Koordinasi dan Penyusunan Dokumen RKA-SKPD', '1.01.01.2.01.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (483, 100, 'Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '1.01.01.2.01.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (484, 100, 'Koordinasi dan Penyusunan DPA-SKPD', '1.01.01.2.01.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (485, 100, 'Koordinasi dan Penyusunan Perubahan DPA- SKPD', '1.01.01.2.01.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (486, 100, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '1.01.01.2.01.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi
Kinerja SKPD', 'Laporan', NULL, '6', '6', '6', '6', '6', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (487, 100, 'Evaluasi Kinerja Perangkat Daerah', '1.01.01.2.01.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (488, 100, 'Penyelenggaraan Walidata Pendukung Statistik Sektoral Daerah', '1.01.01.2.01.0008', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terselenggaranya Walidata Pendukung Statistik Sektoral Daerah', 'Jumlah Dokumen Hasil Penyelenggaraan Walidata Pendukung Statistik
Sektoral Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (489, 100, 'Pelaksanaan Pengumpulan Data Statistik Sektoral Daerah', '1.01.01.2.01.0009', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengumpulan Data Statistik Sektoral Daerah', 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa Lingkup
Perangkat Daerah', 'Data', NULL, '12', '12', '12', '12', '12', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (490, 100, 'Pelaksanaan Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', '1.01.01.2.01.0010', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', 'Jumlah Berita Acara Hasil Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat
Daerah', 'Berita Acara', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (491, 100, 'Penyusunan Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', '1.01.01.2.01.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersusunnya Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', 'Jumlah Dokumen Perencanaan Urusan Selain Renstra PD dan
Renja PD yang disusun', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (492, 100, 'Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', '1.01.01.2.01.0012', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terkoordinasikannya Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 'Jumlah Subtansi Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan
Daerah yang Diampu', 'Substansi', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (493, 100, 'Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis Pembangunan', '1.01.01.2.01.0013', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tercapainya Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis Pembangunan', 'Jumlah Berita Acara Hasil Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis Pembangunan', 'Berita Acara', NULL, '4', '4', '4', '4', '4', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (494, 101, 'Penyediaan Gaji dan Tunjangan ASN', '1.01.01.2.02.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '4500/12', '4500/12', '4500/12', '4500/12', '4500/12', NULL, '399915000000.00', '402175000000.00', '402175000000.00', '402175000000.00', '402175000000.00'),
  (495, 101, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '1.01.01.2.02.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', NULL, '10', '10', '10', '10', '10', NULL, '415000000.00', '415000000.00', '415000000.00', '415000000.00', '415000000.00'),
  (496, 101, 'Pelaksanaan Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', '1.01.01.2.02.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 'Jumlah Dokumen Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (497, 101, 'Koordinasi dan Pelaksanaan Akuntansi SKPD', '1.01.01.2.02.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Koordinasi dan Pelaksanaan Akuntansi SKPD', 'Jumlah Dokumen Koordinasi dan Pelaksanaan Akuntansi
SKPD', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (498, 101, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '1.01.01.2.02.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun
SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (499, 101, 'Pengelolaan dan Penyiapan Bahan Tanggapan Pemeriksaan', '1.01.01.2.02.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', NULL, '3', '3', '3', '3', '3', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (500, 101, 'Koordinasi dan Penyusunan Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD', '1.01.01.2.02.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semes teran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semes teran SKPD', 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semes
teran SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (501, 101, 'Penyusunan Pelaporan dan Analisis Prognosis Realisasi Anggaran', '1.01.01.2.02.0008', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi
Anggaran', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '35000000.00', '35000000.00', '35000000.00', '35000000.00', '35000000.00'),
  (502, 102, 'Penyusunan Perencanaan Kebutuhan Barang Milik Daerah SKPD', '1.01.01.2.03.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Rencana Kebutuhan Barang Milik Daerah SKPD', 'Jumlah Rencana Kebutuhan Barang Milik Daerah SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (503, 102, 'Pengamanan Barang Milik Daerah SKPD', '1.01.01.2.03.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengamanan Barang Milik Daerah SKPD', 'Jumlah Dokumen Pengamanan Barang Milik Daerah SKPD', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '35000000.00', '35000000.00', '35000000.00', '35000000.00', '35000000.00'),
  (504, 102, 'Koordinasi dan Penilaian Barang Milik Daerah SKPD', '1.01.01.2.03.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian
Barang Milik Daerah SKPD', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (505, 102, 'Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', '1.01.01.2.03.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', NULL, '1', '1', '1', '1', '', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (506, 102, 'Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', '1.01.01.2.03.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada
SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (507, 102, 'Penatausahaan Barang Milik Daerah pada SKPD', '1.01.01.2.03.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Penatausahaan Barang
Milik Daerah pada SKPD', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (508, 102, 'Pemanfaatan Barang Milik Daerah SKPD', '1.01.01.2.03.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemanfaatan Barang Milik Daerah SKPD', 'Jumlah Dokumen Hasil Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (509, 103, 'Perencanaan Pengelolaan Retribusi Daerah', '1.01.01.2.04.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Rencana Pengelolaan Retribusi Daerah', 'Jumlah Dokumen Rencana Pengelolaan Retribusi Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (510, 103, 'Analisa dan Pengembangan Retribusi Daerah, serta Penyusunan Kebijakan Retribusi Daerah', '1.01.01.2.04.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Hasil Analisis serta Pengembangan Retribusi Daerah dan Kebijakan Retribusi Daerah', 'Jumlah Dokumen Hasil Analisis serta Pengembangan Retribusi Daerah dan Kebijakan Retribusi Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (511, 103, 'Penyuluhan dan Penyebarluasan Kebijakan Retribusi Daerah', '1.01.01.2.04.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penyuluhan dan Penyebarluasan Kebijakan Retribusi Daerah', 'Jumlah Laporan Hasil Penyuluhan dan Penyebarluasan Kebijakan
Retribusi Daerah', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (512, 103, 'Pendataan dan Pendaftaran Objek Retribusi Daerah', '1.01.01.2.04.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Data Objek, Subjek dan Wajib Retribusi Daerah', 'Jumlah Data Objek, Subjek dan Wajib Retribusi Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (513, 103, 'Pengolahan Data Retribusi Daerah', '1.01.01.2.04.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi Daerah', 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi
Daerah', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (514, 103, 'Penetapan Wajib Retribusi Daerah', '1.01.01.2.04.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen Ketetapan Retribusi Daerah', 'Jumlah Dokumen Ketetapan Retribusi
Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (515, 103, 'Pelaporan Pengelolaan Retribusi Daerah', '1.01.01.2.04.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Laporan Pengelolaan Retribusi Daerah', 'Jumlah Laporan Pengelolaan Retribusi
Daerah', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (516, 104, 'Peningkatan Sarana dan Prasarana Disiplin Pegawai', '1.01.01.2.05.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Jumlah Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Unit', NULL, '3', '3', '3', '3', '3', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (517, 104, 'Pengadaan Pakaian Dinas beserta Atribut Kelengkapannya', '1.01.01.2.05.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', NULL, '100', '100', '100', '100', '100', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (518, 104, 'Pendataan dan Pengolahan Administrasi Kepegawaian', '1.01.01.2.05.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 'Jumlah Dokumen Pendataan dan
Pengolahan Administrasi Kepegawaian', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (519, 104, 'Koordinasi dan Pelaksanaan Sistem Informasi Kepegawaian', '1.01.01.2.05.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Koordinasi dan Pelaksanaan Sistem Informasi Kepegawaian', 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi Kepegawaian', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (520, 104, 'Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', '1.01.01.2.05.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (521, 104, 'Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', '1.01.01.2.05.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 'Jumlah Orang yang Mengikuti Bimbingan Teknis Implementasi Peraturan Perundang-
Undangan', 'Orang', NULL, '150', '150', '150', '150', '150', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (522, 105, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '1.01.01.2.06.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan
Bangunan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '35000000.00', '35000000.00', '35000000.00', '35000000.00', '35000000.00'),
  (523, 105, 'Penyediaan Peralatan dan Perlengkapan Kantor', '1.01.01.2.06.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (524, 105, 'Penyediaan Peralatan Rumah Tangga', '1.01.01.2.06.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (525, 105, 'Penyediaan Bahan Logistik Kantor', '1.01.01.2.06.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan
Logistik Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (526, 105, 'Penyediaan Barang Cetakan dan Penggandaan', '1.01.01.2.06.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', '', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (527, 105, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '1.01.01.2.06.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan
yang Disediakan', '', NULL, '12', '12', '12', '12', '12', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (528, 105, 'Penyediaan Bahan/Material', '1.01.01.2.06.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Bahan/Material', 'Jumlah Paket
Bahan/Material yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '10000000.00', '10000000.00', '10000000.00', '10000000.00', '10000000.00'),
  (529, 105, 'Fasilitasi Kunjungan Tamu', '1.01.01.2.06.0008', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Fasilitasi Kunjungan Tamu', 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (530, 105, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '1.01.01.2.06.0009', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '550000000.00', '550000000.00', '550000000.00', '550000000.00', '550000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (531, 105, 'Penatausahaan Arsip Dinamis pada SKPD', '1.01.01.2.06.0010', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penatausahaan Arsip Dinamis pada SKPD', 'Jumlah Dokumen Penatausahaan Arsip
Dinamis pada SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (532, 105, 'Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', '1.01.01.2.06.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan
Berbasis Elektronik pada SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (533, 106, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '1.01.01.2.09.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '7', '7', '7', '7', '7', NULL, '300000000.00', '300000000.00', '300000000.00', '300000000.00', '300000000.00'),
  (534, 106, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '1.01.01.2.09.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '171', '171', '171', '171', '171', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (535, 106, 'Pemeliharaan Mebel', '1.01.01.2.09.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'Unit', NULL, '5', '5', '5', '5', '5', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (536, 106, 'Pemeliharaan Peralatan dan Mesin Lainnya', '1.01.01.2.09.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', 'Unit', NULL, '25', '25', '25', '25', '25', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (537, 106, 'Pemeliharaan Aset Tak Berwujud', '1.01.01.2.09.0008', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Aset Tak Berwujud', 'Jumlah Aset Tak Berwujud yang Dipelihara', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (538, 106, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '1.01.01.2.09.0009', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '5', '5', '5', '5', '5', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (539, 106, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '1.01.01.2.09.0010', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', NULL, '50', '50', '50', '50', '50', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (540, 106, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '1.01.01.2.09.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '5', '5', '5', '5', '5', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (541, 107, 'Pembinaan Kelembagaan dan Manajemen Sekolah Nonformal/Kesetaraan', '1.01.02.2.04.0016', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah Nonformal/Kesetaraan', 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen (Satuan
Pendidikan)', 'SatuanPendidikan', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (542, 108, 'Pembangunan Unit Sekolah Baru (USB)', '1.01.02.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sekolah Baru yang Terbangun', 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '240000000.00', '1120000000.00', '1220000000.00', '1320000000.00', '1420000000.00'),
  (543, 108, 'Pembangunan Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.01.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 'Jumlah Ruang Guru/Kepala Sekolah/TU
yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '160000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (544, 108, 'Pembangunan Ruang Unit Kesehatan Sekolah', '1.01.02.2.01.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (545, 108, 'Pembangunan Perpustakaan Sekolah', '1.01.02.2.01.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Perpustakaan Sekolah yang Terbangun', 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (546, 108, 'Pembangunan Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.01.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas Sekolah yang Terbangun', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '160000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (547, 108, 'Pembangunan Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah', '1.01.02.2.01.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Terbangun', 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang
Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (548, 108, 'Rehabilitasi Sedang/Berat Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.01.0009', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (549, 108, 'Rehabilitasi Sedang/Berat Ruang Unit Kesehatan Sekolah', '1.01.02.2.01.0010', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (550, 108, 'Rehabilitasi Sedang/Berat Perpustakaan Sekolah', '1.01.02.2.01.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perpustakaan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Perpustakaan Sekolah yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (551, 108, 'Rehabilitasi Sedang/Berat Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah', '1.01.02.2.01.0013', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang
Telah DiRehabilitasi Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (552, 108, 'Pengadaan Mebel Sekolah', '1.01.02.2.01.0014', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Mebel Sekolah yang Tersedia', 'Jumlah Mebel sekolah yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (553, 108, 'Pengadaan Alat Rumah Tangga Sekolah', '1.01.02.2.01.0015', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Rumah Tangga Sekolah yang Tersedia', 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (554, 108, 'Pengadaan Perlengkapan Sekolah', '1.01.02.2.01.0016', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan Sekolah yang Tersedia', 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (555, 108, 'Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.01.0019', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (556, 108, 'Pembinaan Minat, Bakat dan Kreativitas Siswa', '1.01.02.2.01.0025', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 'Jumlah Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 'Peserta Didik', NULL, '300', '300', '300', '300', '300', NULL, '300000000.00', '300000000.00', '300000000.00', '300000000.00', '300000000.00'),
  (557, 108, 'Penyediaan Pendidik dan Tenaga Kependidikan bagi Satuan Pendidikan Sekolah Dasar', '1.01.02.2.01.0026', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan Tersedia bagi Satuan Pendidikan Sekolah Dasar', 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada Satuan Pendidikan Sekolah Dasar', 'Orang', NULL, '150', '150', '150', '150', '150', NULL, '125000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (558, 108, 'Pengembangan Karir Pendidik dan Tenaga Kependidikan pada Satuan Pendidikan Sekolah Dasar', '1.01.02.2.01.0027', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', NULL, '250', '250', '250', '250', '250', NULL, '155000000.00', '175000000.00', '175000000.00', '175000000.00', '175000000.00'),
  (559, 108, 'Pembinaan Kelembagaan dan Manajemen Sekolah', '1.01.02.2.01.0028', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah', 'Jumlah Sekolah Dasar yang Dilaksanakan Pembinaan Kelembagaan
dan manajemen sekolah', 'Satuan Pendidikan', NULL, '444', '444', '444', '444', '444', NULL, '175000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (560, 108, 'Pengelolaan Dana BOS Sekolah Dasar', '1.01.02.2.01.0029', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengelolaan Dana BOS Sekolah Dasar', 'Jumlah Sekolah Dasar yang Mengelola Dana BOS', 'Satuan Pendidikan', NULL, '444', '444', '444', '444', '444', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (561, 108, 'Peningkatan Kapasitas Pengelolaan Dana BOS Sekolah Dasar', '1.01.02.2.01.0030', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Meningkatnya Kapasitas Tenaga Pengelola Dana BOS Sekolah Dasar', 'Jumlah Tenaga Pengelola yang Meningkat Kapasitasnya dalam
Pengelolaan Dana BOS Sekolah Dasar', 'Orang', NULL, '20', '20', '20', '20', '20', NULL, '175000000.00', '175000000.00', '175000000.00', '175000000.00', '175000000.00'),
  (562, 108, 'Pembangunan Laboratorium Sekolah Dasar', '1.01.02.2.01.0031', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Laboratorium Sekolah Dasar yang Terbangun', 'Jumlah Ruang Laboratorium Sekolah Dasar yang Telah
Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (563, 108, 'Rehabilitasi Sedang/Berat Laboratorium Sekolah Dasar', '1.01.02.2.01.0032', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Laboratorium Sekolah Dasar yang Terehabilitasi Sedang/Berat', 'Jumlah Laboratorium Sekolah Dasar yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (564, 108, 'Pemeliharaan Mebel Sekolah', '1.01.02.2.01.0033', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Mebel Sekolah', 'Jumlah Mebel Sekolah
yang Dilaksanakan Pemeliharaan', 'Unit', NULL, '50', '50', '50', '50', '50', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (565, 108, 'Peningkatan profesi pelaku perbukuan daerah pada Satuan Pendidikan Dasar', '1.01.02.2.01.0034', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (566, 108, 'Pengembangan konten digital untuk pendidikan', '1.01.02.2.01.0036', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 'Jumlah konten digital untuk pendidikan yang telah dikembangkan', 'Konten Digital', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (567, 108, 'Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', '1.01.02.2.01.0038', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang
Pendidikan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (568, 108, 'Sosialisasi dan Advokasi Kebijakan Bidang Pendidikan', '1.01.02.2.01.0039', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (569, 108, 'Fasilitasi Komunitas Belajar Pendidik dan Tenaga Kependidikan', '1.01.02.2.01.0041', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', NULL, '3', '3', '3', '3', '3', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (570, 108, 'Pemberian layanan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', '1.01.02.2.01.0043', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan,
kekerasan, dan intoleransi', 'Kegiatan', NULL, '3', '3', '3', '3', '3', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (571, 108, 'Penataan Ruang/Sudut Baca', '1.01.02.2.01.0044', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang/Sudut Baca yang Tertata', 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (572, 108, 'Perlengkapan Dasar Buku Teks dan Non Teks Peserta Didik', '1.01.02.2.01.0045', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 'Jumlah Buku Teks dan Non Teks yang Diterima
Peserta Didik', 'Buku', NULL, '110', '110', '110', '110', '110', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (573, 108, 'Pengadaan Perlengkapan Peserta Didik', '1.01.02.2.01.0046', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Pengadaan Perlengkapan Peserta Didik', 'Jumlah Perlengkapan Peserta Didik yang
Tersedia', 'Paket', NULL, '110', '110', '110', '110', '110', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (574, 108, 'Pembangunan Ruang Kelas Baru', '1.01.02.2.01.0047', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Baru bertambah', 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (575, 108, 'Rehabilitasi Sedang/Berat Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.01.0048', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (576, 108, 'Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', '1.01.02.2.01.0049', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', NULL, '20', '20', '20', '20', '20', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (577, 108, 'Penyelenggaraan Proses Belajar Bagi Peserta Didik', '1.01.02.2.01.0050', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terselenggaranya Proses Belajar Bagi Peserta Didik', 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'SatuanPendidikan', NULL, '120', '120', '120', '120', '120', NULL, '135000000.00', '135000000.00', '135000000.00', '135000000.00', '135000000.00'),
  (578, 108, 'Rehabilitasi Sedang/Berat Ruang Kelas Sekolah', '1.01.02.2.01.0051', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Kelas Sekolah yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (579, 108, 'Rehabilitasi Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.01.0052', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '130000000.00', '130000000.00', '130000000.00', '130000000.00', '130000000.00'),
  (580, 108, 'Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.01.0053', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (581, 108, 'Penyediaan Biaya Personil Peserta Didik Sekolah Dasar', '1.01.02.2.01.0054', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Biaya Personil Peserta Didik Sekolah Dasar Diterima oleh Peserta Didik', 'Jumlah Peserta Didik Sekolah Dasar yang Menerima Biaya Personil Peserta Didik', 'Peserta Didik', NULL, '150', '150', '150', '150', '150', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (582, 108, 'Pengadaan Alat Praktik dan Peraga Peserta Didik', '1.01.02.2.01.0055', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Jumlah Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Paket', NULL, '10', '10', '10', '10', '10', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (583, 109, 'Pembangunan Unit Sekolah Baru (USB)', '1.01.02.2.02.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sekolah Baru yang Terbangun', 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00'),
  (584, 109, 'Pembangunan Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.02.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (585, 109, 'Pembangunan Ruang Unit Kesehatan Sekolah', '1.01.02.2.02.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (586, 109, 'Pembangunan Perpustakaan Sekolah', '1.01.02.2.02.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perpustakaan Sekolah yang Terbangun', 'Jumlah Perpustakaan Sekolah yang Telah
Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (587, 109, 'Pembangunan Laboratorium', '1.01.02.2.02.0006', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Laboratorium yang Terbangun', 'Jumlah Ruang Laboratorium yang Telah
Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (588, 109, 'Pembangunan Ruang Serba Guna/Aula', '1.01.02.2.02.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Serba Guna/Aula yang Terbangun', 'Jumlah Ruang Serba Guna/Aula yang Telah
Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (589, 109, 'Pembangunan Asrama Sekolah', '1.01.02.2.02.0008', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Asrama Sekolah yang Terbangun', 'Jumlah Asrama Sekolah yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (590, 109, 'Pembangunan Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah', '1.01.02.2.02.0009', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Terbangun', 'Jumlah Rumah Dinas Kepala Sekolah, Guru,
Penjaga Sekolah yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (591, 109, 'Pembangunan Fasilitas Parkir', '1.01.02.2.02.0010', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Fasilitas Parkir yang Terbangun', 'Jumlah Fasilitas Parkir yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (592, 109, 'Pembangunan Kantin Sekolah', '1.01.02.2.02.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Kantin Sekolah yang Terbangun', 'Jumlah Kantin Sekolah yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (593, 109, 'Pembangunan Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.02.0012', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas Sekolah yang Terbangun', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (594, 109, 'Rehabilitasi Sedang/Berat Ruang Kelas Sekolah', '1.01.02.2.02.0014', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang kelas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang kelas sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '2', '2', '2', '2', '2', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (595, 109, 'Rehabilitasi Sedang/Berat Ruang Unit Kesehatan Sekolah', '1.01.02.2.02.0016', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (596, 109, 'Rehabilitasi Sedang/Berat Perpustakaan Sekolah', '1.01.02.2.02.0017', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perpustakaan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', '', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (597, 109, 'Rehabilitasi Sedang/Berat Laboratorium', '1.01.02.2.02.0018', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Laboratorium yang Terehabilitasi Sedang/Berat', 'Jumlah Laboratorium yang
Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (598, 109, 'Rehabilitasi Sedang/Berat Ruang Serba Guna/Aula', '1.01.02.2.02.0019', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Serba Guna/Aula yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Serba Guna/Aula yang Telah Direhabilitasi sedang/berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (599, 109, 'Rehabilitasi Sedang/Berat Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah', '1.01.02.2.02.0021', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '110000000.00', '110000000.00', '110000000.00', '110000000.00', '110000000.00'),
  (600, 109, 'Rehabilitasi Sedang/Berat Fasilitas Parkir', '1.01.02.2.02.0022', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Fasilitas Parkir yang Terehabilitasi Sedang/Berat', 'Jumlah Fasilitas Parkir
yang Telah Direhabilitasi Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (601, 109, 'Rehabilitasi Sedang/Berat Kantin Sekolah', '1.01.02.2.02.0023', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Kantin Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Kantin Sekolah
yang Direhabilitasi Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (602, 109, 'Rehabilitasi Sedang/Berat Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.02.0024', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (603, 109, 'Pengadaan Mebel Sekolah', '1.01.02.2.02.0025', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Mebel Sekolah yang Tersedia', 'Jumlah Mebel Sekolah yang Tersedia', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (604, 109, 'Pengadaan Alat Rumah Tangga Sekolah', '1.01.02.2.02.0026', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Rumah Tangga Sekolah yang Tersedia', 'Jumlah Alat Rumah Tangga Sekolah yang
Tersedia', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (605, 109, 'Pengadaan Perlengkapan Sekolah', '1.01.02.2.02.0027', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan Sekolah yang Tersedia', 'Jumlah Perlengkapan Sekolah yang Tersedia', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (606, 109, 'Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.02.0030', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (607, 109, 'Penyediaan Biaya Personil Peserta Didik Sekolah Menengah Pertama', '1.01.02.2.02.0032', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Biaya Personil Peserta Didik Sekolah Menengah Pertama Diterima oleh Peserta Didik', 'Jumlah Peserta didik Sekolah Menengah Pertama yang Menerima
Biaya Personil Peserta Didik', 'Peserta Didik', NULL, '200', '200', '200', '200', '200', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (608, 109, 'Pembinaan Minat, Bakat dan Kreativitas Siswa', '1.01.02.2.02.0038', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 'Jumlah Siswa yang Mengikuti Ajang Kompetisi/Lomba
Akademik dan Non Akademik', 'Peserta Didik', NULL, '150', '150', '150', '150', '150', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (609, 109, 'Penyediaan Pendidik dan Tenaga Kependidikan bagi Satuan Pendidikan Sekolah Menengah Pertama', '1.01.02.2.02.0039', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan Tersedia bagi Satuan Pendidikan Sekolah Menengah Pertama', 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada Satuan Pendidikan Sekolah Menengah Pertama', 'Orang', NULL, '98', '98', '98', '98', '98', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (610, 109, 'Pengembangan Karir Pendidik dan Tenaga Kependidikan pada Satuan Pendidikan Sekolah Menengah Pertama', '1.01.02.2.02.0040', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', NULL, '98', '98', '98', '98', '98', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (611, 109, 'Pembinaan Kelembagaan dan Manajemen Sekolah', '1.01.02.2.02.0041', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah', 'Jumlah Sekolah Menengah Pertama yang Dilaksanakan Pembinaan', 'Satuan Pendidikan', NULL, '98', '98', '98', '98', '98', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (612, 109, 'Pengelolaan Dana BOS Sekolah Menengah Pertama', '1.01.02.2.02.0042', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengelolaan Dana BOS Sekolah Menengah Pertama', 'Jumlah Sekolah Menengah pertama yang Mengelola
Dana BOS', 'Satuan Pendidikan', NULL, '98', '98', '98', '98', '98', NULL, '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00'),
  (613, 109, 'Peningkatan Kapasitas Pengelolaan Dana BOS Sekolah Menengah Pertama', '1.01.02.2.02.0043', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Dana BOS Sekolah Menengah Pertama yang Terkelola dengan Baik', 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana
BOS Sekolah Menengah Pertama', '', NULL, '10', '10', '10', '10', '10', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (614, 109, 'Pemeliharaan Mebel Sekolah', '1.01.02.2.02.0046', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Mebel Sekolah', 'Jumlah Mebel Sekolah
yang Dilaksanakan Pemeliharaan', 'Unit', NULL, '60', '60', '60', '60', '60', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (615, 109, 'Peningkatan profesi pelaku perbukuan daerah pada Satuan Pendidikan Menengah Pertama', '1.01.02.2.02.0047', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', NULL, '4', '4', '4', '4', '4', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (616, 109, 'Pengembangan konten digital untuk pendidikan', '1.01.02.2.02.0049', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 'Jumlah konten digital untuk pendidikan yang telah
dikembangkan', 'Konten Digital', NULL, '4', '4', '4', '4', '4', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (617, 109, 'Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', '1.01.02.2.02.0051', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (618, 109, 'Sosialisasi dan Advokasi Kebijakan Bidang Pendidikan', '1.01.02.2.02.0052', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (619, 109, 'Fasilitasi Komunitas Belajar Pendidik dan Tenaga Kependidikan', '1.01.02.2.02.0054', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Jumlah Komunitas Belajar Pendidik dan Tenaga
Pendidik yang terfasilitasi', 'Komunitas', NULL, '9', '9', '9', '9', '9', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (620, 109, 'Pemberian layanan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', '1.01.02.2.02.0055', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', NULL, '5', '5', '5', '5', '5', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (621, 109, 'Penataan Ruang/Sudut Baca', '1.01.02.2.02.0056', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang/Sudut Baca yang Tertata', 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (622, 109, 'Penyelenggaraan Proses Belajar bagi Peserta Didik', '1.01.02.2.02.0058', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terselenggaranya Proses Belajar bagi Peserta Didik', 'Jumlah Peserta Didik yang Mengikuti Proses Belajar', 'Satuan Pendidikan', NULL, '98', '98', '98', '98', '98', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (623, 109, 'Pembangunan Ruang Kelas Baru', '1.01.02.2.02.0059', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Baru Bertambah', 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (624, 109, 'Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', '1.01.02.2.02.0060', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', NULL, '25', '25', '25', '25', '25', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (625, 109, 'Perlengkapan Dasar Buku Teks dan Non Teks Peserta Didik', '1.01.02.2.02.0061', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', NULL, '98', '98', '98', '98', '98', NULL, '180000000.00', '180000000.00', '180000000.00', '180000000.00', '180000000.00'),
  (626, 109, 'Pengadaan Perlengkapan Peserta Didik', '1.01.02.2.02.0062', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan Peserta Didik yang Tersedia', 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (627, 109, 'Rehabilitasi Sedang/Berat Asrama Sekolah', '1.01.02.2.02.0063', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Asrama Sekolah yang terehabilitasi Sedang/Berat', 'Jumlah Asrama Sekolah
yang telah direhabilitasi sedang/berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (628, 109, 'Rehabilitasi Sedang/Berat Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.02.0064', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (629, 109, 'Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.02.0065', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (630, 109, 'Rehabilitasi Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.02.0066', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Direhabilitasi', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '140000000.00', '140000000.00', '140000000.00', '140000000.00', '140000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (631, 109, 'Pengadaan Alat Praktik dan Peraga Peserta Didik', '1.01.02.2.02.0067', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Jumlah Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Paket', NULL, '10', '10', '10', '10', '10', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (632, 110, 'Pembangunan Sarana, Prasarana dan Utilitas PAUD', '1.01.02.2.03.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas PAUD yang Terbangun', 'Jumlah Sarana, Prasarana dan Utilitas PAUD yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (633, 110, 'Pengadaan Mebel PAUD', '1.01.02.2.03.0007', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Mebel PAUD yang Tersedia', 'Jumlah Mebel PAUD yang Tersedia', 'Paket', NULL, '2', '2', '2', '2', '2', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (634, 110, 'Pengadaan Alat Rumah Tangga PAUD', '1.01.02.2.03.0008', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Rumah Tangga PAUD yang Tersedia', 'Jumlah Alat Rumah
Tangga PAUD yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '15000000.00', '15000000.00', '15000000.00', '15000000.00', '15000000.00'),
  (635, 110, 'Pengadaan Perlengkapan PAUD', '1.01.02.2.03.0009', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan PAUD yang Tersedia', 'Jumlah perlengkapan
PAUD yang Tersedia', 'Paket', NULL, '3', '3', '3', '3', '3', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (636, 110, 'Penyediaan Biaya Personil Peserta Didik PAUD', '1.01.02.2.03.0011', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Biaya Personil Peserta Didik PAUD Diterima oleh Peserta Didik', 'Jumlah Peserta Didik PAUD yang Menerima Biaya Personil Peserta
Didik', 'Peserta Didik', NULL, '1000', '1000', '1000', '1000', '1000', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (637, 110, 'Penyediaan Pendidik dan Tenaga Kependidikan bagi Satuan PAUD', '1.01.02.2.03.0015', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan Tersedia bagi PAUD', 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada PAUD', 'Orang', NULL, '100', '100', '100', '100', '100', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (638, 110, 'Pengembangan Karir Pendidik dan Tenaga Kependidikan pada Satuan Pendidikan PAUD', '1.01.02.2.03.0016', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 'Orang', NULL, '20', '20', '20', '20', '20', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (639, 110, 'Pembinaan Kelembagaan dan Manajemen PAUD', '1.01.02.2.03.0017', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen PAUD', 'Jumlah PAUD yang Dilaksanakan Pembinaan Kelembagaan dan
Manajemen', 'Satuan Pendidikan', NULL, '100', '100', '100', '100', '100', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (640, 110, 'Pengelolaan Dana BOP PAUD', '1.01.02.2.03.0018', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengelolaan Dana BOP PAUD', 'Jumlah PAUD yang
Mengelola Dana BOP', 'Satuan Pendidikan', NULL, '782', '782', '782', '782', '782', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (641, 110, 'Peningkatan Kapasitas Pengelolaan Dana BOP PAUD', '1.01.02.2.03.0019', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Meningkatnya Kapasitas Pengelolaan Dana BOP PAUD', 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana
BOP PAUD', 'Orang', NULL, '20', '20', '20', '20', '20', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (642, 110, 'Pemeliharaan Mebel Sekolah', '1.01.02.2.03.0020', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terpeliharanya Mebel Sekolah', 'Jumlah Mebel Sekolah yang Dipelihara', 'Unit', NULL, '60', '60', '60', '60', '60', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (643, 110, 'Peningkatan profesi pelaku perbukuan daerah pada Satuan Pendidikan Anak Usia Dini (PAUD)', '1.01.02.2.03.0021', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', NULL, '4', '4', '4', '4', '4', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (644, 110, 'Pengembangan konten digital untuk pendidikan', '1.01.02.2.03.0023', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 'Jumlah konten digital untuk pendidikan yang telah
dikembangkan', 'Konten Digital', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (645, 110, 'Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', '1.01.02.2.03.0025', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang
Pendidikan', 'Konten Digital', NULL, '12', '12', '12', '12', '12', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (646, 110, 'Sosialisasi dan Advokasi Kebijakan Bidang Pendidikan', '1.01.02.2.03.0026', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '110000000.00', '110000000.00', '110000000.00', '110000000.00', '110000000.00'),
  (647, 110, 'Pembangunan Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.03.0028', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 'Jumlah Ruang Guru/Kepala Sekolah/TU
yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '170000000.00', '170000000.00', '170000000.00', '170000000.00', '170000000.00'),
  (648, 110, 'Fasilitasi Komunitas Belajar Pendidik dan Tenaga Kependidikan', '1.01.02.2.03.0029', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (649, 110, 'Pembangunan Ruang Kelas Baru', '1.01.02.2.03.0030', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Baru bertambah', 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', NULL, '2', '2', '2', '2', '2', NULL, '300000000.00', '300000000.00', '300000000.00', '300000000.00', '300000000.00'),
  (650, 110, 'Penataan Ruang/Sudut Baca', '1.01.02.2.03.0032', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang/Sudut Baca yang Tertata', 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', NULL, '4', '4', '4', '4', '4', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (651, 110, 'Pembangunan Perpustakaan Sekolah', '1.01.02.2.03.0033', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perpustakaan Sekolah yang terbangun', 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (652, 110, 'Pembinaan Minat, Bakat dan Kreativitas Peserta Didik', '1.01.02.2.03.0034', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 'Jumlah Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non
Akademik', 'Peserta didik', NULL, '250', '250', '250', '250', '250', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (653, 110, 'Perlengkapan Dasar Buku Teks dan Non Teks Peserta Didik', '1.01.02.2.03.0035', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', NULL, '4', '4', '4', '4', '4', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (654, 110, 'Rehabilitasi Sedang/Berat Perpustakaan Sekolah', '1.01.02.2.03.0036', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perpustakaan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (655, 110, 'Pemberian layanan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', '1.01.02.2.03.0037', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', NULL, '3', '3', '3', '3', '3', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (656, 110, 'Rehabilitasi Sedang/Berat Ruang Serba Guna/Aula', '1.01.02.2.03.0038', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Serba Guna/Aula yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Serba Guna/Aula yang Telah
Direhabilitasi sedang/berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '130000000.00', '130000000.00', '130000000.00', '130000000.00', '130000000.00'),
  (657, 110, 'Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', '1.01.02.2.03.0039', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', NULL, '20', '20', '20', '20', '20', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (658, 110, 'Pembangunan Unit Sekolah Baru (USB)', '1.01.02.2.03.0040', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sekolah Baru yang Terbangun', 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00', '1000000000.00'),
  (659, 110, 'Pengadaan Perlengkapan Peserta Didik', '1.01.02.2.03.0041', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan Peserta Didik  yang Tersedia', 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', NULL, '5', '5', '5', '5', '5', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (660, 110, 'Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.03.0042', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (661, 110, 'Rehabilitasi Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.03.0043', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Direhabilitasi', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (662, 110, 'Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.03.0044', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (663, 110, 'Rehabilitasi Sedang/Berat Sarana, Prasarana dan Utilitas PAUD', '1.01.02.2.03.0045', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas PAUD yang Terehabilitasi Sedang/Berat', 'Jumlah Sarana, Prasarana dan Utilitas PAUD yang Telah Direhabilitasi
Sedang/Berat', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '60000000.00', '60000000.00', '60000000.00', '60000000.00', '60000000.00'),
  (664, 110, 'Pengadaan Alat Praktik dan Peraga  Peserta Didik PAUD', '1.01.02.2.03.0046', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Praktik dan Peraga Peserta Didik PAUD yang Tersedia', 'Jumlah Alat Praktik dan Peraga Peserta Didik PAUD yang Tersedia', 'Paket', NULL, '5', '5', '5', '5', '5', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (665, 110, 'Penyelenggaraan Proses Belajar PAUD', '1.01.02.2.03.0047', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terselenggaranya Proses Belajar PAUD', 'Jumlah Peserta Didik PAUD yang Mengikuti Proses Belajar', 'Satuan Pendidikan', NULL, '250', '250', '250', '250', '250', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (666, 110, 'Rehabilitasi Sedang/Berat Ruang Unit Kesehatan Sekolah', '1.01.02.2.03.0048', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (667, 110, 'Rehabilitasi sedang/berat Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.03.0049', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi sedang/berat', 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
sedang/berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (668, 110, 'Pembangunan Ruang Unit Kesehatan Sekolah', '1.01.02.2.03.0050', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (669, 110, 'Rehabilitasi Sedang/Berat Ruang Kelas Sekolah', '1.01.02.2.03.0051', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '130000000.00', '130000000.00', '130000000.00', '130000000.00', '130000000.00'),
  (670, 111, 'Penyediaan Biaya Personil Peserta Didik Nonformal/Kesetaraan', '1.01.02.2.04.0010', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Biaya Personil Peserta Didik Nonformal/Kesetaraan diterima oleh peserta didik', 'Jumlah Peserta Didik Nonformal/Kesetaraan yang Menerima Biaya
Personil Peserta Didik', 'Peserta Didik', NULL, '100', '100', '100', '100', '100', NULL, '1975000000.00', '1975000000.00', '1975000000.00', '1975000000.00', '1975000000.00'),
  (671, 111, 'Penyediaan Pendidik dan Tenaga Kependidikan bagi Satuan Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04.0014', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan Tenaga Kependidikan Tersedia bagi Satuan Pendidikan Nonformal/Kesetaraan', 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia bagi Satuan Pendidikan Nonformal/Kesetaraan', 'Orang', NULL, '28', '28', '28', '28', '28', NULL, '76000000.00', '76000000.00', '76000000.00', '76000000.00', '76000000.00'),
  (672, 111, 'Pengembangan Karir Pendidik dan Tenaga Kependidikan pada Satuan Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04.0015', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik dan tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', NULL, '28', '28', '28', '28', '28', NULL, '76000000.00', '76000000.00', '76000000.00', '76000000.00', '76000000.00'),
  (673, 111, 'Pembinaan Kelembagaan dan Manajemen Sekolah Nonformal/Kesetaraan', '1.01.02.2.04.0016', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah Nonformal/Kesetaraan', 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen', 'Satuan Pendidikan', NULL, '28', '28', '28', '28', '28', NULL, '120000000.00', '120000000.00', '120000000.00', '120000000.00', '120000000.00'),
  (674, 111, 'Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', '1.01.02.2.04.0017', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 'Jumlah Sekolah Nonformal/Kesetaraan yang Mengelola Dana BOP', 'SatuanPendidikan', NULL, '28', '28', '28', '28', '28', NULL, '350000000.00', '350000000.00', '350000000.00', '350000000.00', '350000000.00'),
  (675, 111, 'Peningkatan Kapasitas Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', '1.01.02.2.04.0018', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Meningkatnya Kapasitas Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 'Orang', NULL, '10', '10', '10', '10', '10', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (676, 111, 'Pemeliharaan Mebel Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04.0021', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Mebel Pendidikan Nonformal/Kesetaraan', 'Jumlah Mebel Pendidikan Nonformal/Kesetaraan yang Dilaksanakan
Pemeliharaan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (677, 111, 'Peningkatan profesi pelaku perbukuan daerah pada Satuan Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04.0023', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (678, 111, 'Pengembangan konten digital untuk pendidikan', '1.01.02.2.04.0025', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 'Jumlah konten digital untuk pendidikan yang telah
dikembangkan', 'Konten Digital', NULL, '2', '2', '2', '2', '2', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (679, 111, 'Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', '1.01.02.2.04.0027', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (680, 111, 'Sosialisasi dan Advokasi Kebijakan Bidang Pendidikan', '1.01.02.2.04.0028', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (681, 111, 'Fasilitasi Komunitas Belajar Pendidik dan Tenaga Kependidikan', '1.01.02.2.04.0030', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Jumlah Komunitas Belajar Pendidik dan Tenaga
Pendidik yang terfasilitasi', 'Komunitas', NULL, '3', '3', '3', '3', '3', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (682, 111, 'Pemberian layanan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', '1.01.02.2.04.0031', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', NULL, '1', '1', '1', '1', '1', NULL, '40000000.00', '40000000.00', '40000000.00', '40000000.00', '40000000.00'),
  (683, 111, 'Fasilitasi sertifikasi kompetensi bagi pendidik Satuan Pendidikan Nonformal/Kesetaraan', '1.01.02.2.04.0032', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Pendidik Satuan Pendidikan Nonformal/Kesetaraan yang mendapat sertifikat kompetensi', 'Pendidik Satuan Pendidikan Nonformal/Kesetaraan
yang mendapat sertifikat kompetensi', 'Orang', NULL, '28', '28', '28', '28', '28', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (684, 111, 'Penataan Ruang/Sudut Baca', '1.01.02.2.04.0034', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang/Sudut Baca yang Tertata', 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', NULL, '2', '2', '2', '2', '2', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (685, 111, 'Pembinaan Minat, Bakat dan Kreativitas Peserta Didik', '1.01.02.2.04.0035', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 'Jumlah Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba
Akademik dan Non Akademik', 'Peserta Didik', NULL, '30', '30', '30', '30', '30', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (686, 111, 'Pengadaan Perlengkapan Peserta Didik', '1.01.02.2.04.0036', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan Peserta Didik  yang Tersedia', 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (687, 111, 'Perlengkapan Dasar Buku Teks dan Non Teks Peserta Didik', '1.01.02.2.04.0037', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 'Jumlah Buku Teks dan Non Teks yang Diterima
Peserta Didik', 'Buku', NULL, '28', '28', '28', '28', '28', NULL, '80000000.00', '80000000.00', '80000000.00', '80000000.00', '80000000.00'),
  (688, 111, 'Pembangunan Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.04.0038', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 'Jumlah Ruang Guru/Kepala Sekolah/TU
yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '140000000.00', '140000000.00', '140000000.00', '140000000.00', '140000000.00'),
  (689, 111, 'Pembangunan Ruang Kelas Baru', '1.01.02.2.04.0039', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Baru bertambah', 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (690, 111, 'Pengadaan Perlengkapan Sekolah', '1.01.02.2.04.0040', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Perlengkapan Sekolah yang Tersedia', 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (691, 111, 'Rehabilitasi Sedang/Berat Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.04.0041', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (692, 111, 'Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', '1.01.02.2.04.0042', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', NULL, '28', '28', '28', '28', '28', NULL, '65000000.00', '65000000.00', '65000000.00', '65000000.00', '65000000.00'),
  (693, 111, 'Rehabilitasi Sedang/Berat Ruang Laboratorium', '1.01.02.2.04.0043', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Laboratorium yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Laboratorium yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (694, 111, 'Pembangunan Unit Sekolah Baru (USB)', '1.01.02.2.04.0044', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sekolah Baru yang Terbangun', 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '500000000.00', '500000000.00', '500000000.00', '500000000.00', '500000000.00'),
  (695, 111, 'Pengadaan Alat Rumah Tangga Sekolah', '1.01.02.2.04.0045', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Rumah Tangga Sekolah yang Tersedia', 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '25000000.00', '25000000.00', '25000000.00', '25000000.00', '25000000.00'),
  (696, 111, 'Penyelenggaraan Proses Belajar bagi Peserta Didik', '1.01.02.2.04.0046', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terselenggaranya Proses Belajar bagi Peserta Didik', 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'Peserta Didik', NULL, '215', '215', '215', '215', '215', NULL, '3500000000.00', '3500000000.00', '3500000000.00', '3500000000.00', '3500000000.00'),
  (697, 111, 'Pembangunan Ruang Laboratorium', '1.01.02.2.04.0047', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Laboratorium yang Terbangun', 'Jumlah Ruang Laboratorium yang Telah
Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '160000000.00', '160000000.00', '160000000.00', '160000000.00', '160000000.00'),
  (698, 111, 'Pengadaan Mebel Sekolah', '1.01.02.2.04.0048', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Mebel Pendidikan Nonformal/Kesetaraan yang Tersedia', 'Jumlah Mebel Sekolah yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (699, 111, 'Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', '1.01.02.2.04.0049', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan Pemeliharaan', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '20000000.00', '20000000.00', '20000000.00', '20000000.00', '20000000.00'),
  (700, 111, 'Pembangunan Sarana, Prasarana dan Utilitas Pendidikan Non Formal', '1.01.02.2.04.0052', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Sarana, Prasarana dan Utilitas Pendidikan Non Formal yang Terbangun', 'Jumlah Sarana, Prasarana dan Utilitas Pendidikan Non Formal yang Telah
Dibangun', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (701, 111, 'Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.04.0053', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '140000000.00', '140000000.00', '140000000.00', '140000000.00', '140000000.00'),
  (702, 111, 'Rehabilitasi Ruang Pusat Sumber Anak Berkebutuhan Khusus', '1.01.02.2.04.0054', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (703, 111, 'Pengadaan Alat Praktik dan Peraga Peserta Didik Nonformal / Kesetaraan', '1.01.02.2.04.0055', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Alat Praktik dan Peraga Peserta Didik Nonformal/Kesetaraan yang Tersedia', 'Jumlah Alat Praktik dan Peraga Peserta Didik Nonformal/ Kesetaraan
yang Tersedia', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '35000000.00', '35000000.00', '35000000.00', '35000000.00', '35000000.00'),
  (704, 111, 'Rehabilitasi Sedang/Berat Ruang Unit Kesehatan Sekolah', '1.01.02.2.04.0056', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '30000000.00', '30000000.00', '30000000.00', '30000000.00'),
  (705, 111, 'Pembangunan Ruang Unit Kesehatan Sekolah', '1.01.02.2.04.0057', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (706, 111, 'Rehabilitasi Sedang/Berat Taman Bacaan Masyarakat', '1.01.02.2.04.0058', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Taman Bacaan Masyarakat yang Terehabilitasi Sedang/Berat', 'Jumlah Taman Bacaan Masyarakat yang Telah Direhabilitasi sedang/berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '75000000.00', '75000000.00', '75000000.00', '75000000.00', '75000000.00'),
  (707, 111, 'Pembangunan Taman Bacaan Masyarakat', '1.01.02.2.04.0059', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Taman Bacaan Masyarakat yang Terbangun', 'Jumlah Taman Bacaan
Masyarakat yang Telah Dibangun', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '175000000.00', '175000000.00', '175000000.00', '175000000.00', '175000000.00'),
  (708, 111, 'Rehabilitasi Sedang/Berat Ruang Guru/Kepala Sekolah/TU', '1.01.02.2.04.0060', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (709, 111, 'Rehabilitasi Sedang/Berat Ruang Kelas Sekolah', '1.01.02.2.04.0061', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Ruang Kelas Sekolah yang Terehabilitasi Sedang/Berat', 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (710, 112, 'Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', '1.01.04.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Dokumen Hasil Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Jumlah Dokumen Hasil Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '27930000000.00', '28930000000.00', '28930000000.00', '28930000000.00', '28930000000.00'),
  (711, 112, 'Penataan Pendistribusian Pendidik dan Tenaga Kependidikan bagi Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', '1.01.04.2.01.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penataan Pendistribusian Pendidik dan Tenaga Kependidikan Satuan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Jumlah Laporan Hasil Pelaksanaan Penataan Pendistribusian Pendidik dan Tenaga Kependidikan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '674000000.00', '674000000.00', '674000000.00', '674000000.00', '674000000.00'),
  (712, 113, 'Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Kebudayaan', '2.22.02.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Kebudayaan', 'Jumlah Objek Pemajuan Kebudayaan yang Dilakukan Pelindungan,
Pengembangan, Pemanfaatan', 'Objek', NULL, '2', '2', '2', '2', '2', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (713, 113, 'Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Kebudayaan', '2.22.02.2.01.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Kebudayaan', 'Jumlah Peserta Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Kebudayaan', 'Orang', NULL, '15', '15', '15', '15', '15', NULL, '350000000.00', '350000000.00', '350000000.00', '350000000.00', '350000000.00'),
  (714, 113, 'Penyusunan, Pemutakhiran, Penetapan Pokok Pikiran Kebudayaan Daerah (PPKD) Kabupaten/Kota', '2.22.02.2.01.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penyusunan, Pemutakhiran, Penetapan PPKD Kabupaten/Kota', 'Jumlah PPKD Kabupaten/Kota yang Disusun, Dimutakhirkan
dan Ditetapkan', 'Dokumen', NULL, '5', '5', '5', '5', '5', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (715, 113, 'Pembinaan Sumber Daya Manusia Kebudayaan', '2.22.02.2.01.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya pembinaan Sumber Daya Manusia Bidang Kebudayaan', 'Jumlah Sumber Daya
Manusia Kebudayaan yang Dibina', 'Orang', NULL, '5', '5', '5', '5', '5', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (716, 113, 'Pembinaan Lembaga dan Pranata Kebudayaan', '2.22.02.2.01.0005', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Lembaga dan Pranata Kebudayaan', 'Jumlah Lembaga dan Pranata Kebudayaan yang Dibina', 'Lembaga', NULL, '2', '2', '2', '2', '2', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (717, 114, 'Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Tradisi Budaya', '2.22.02.2.02.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Tradisi Budaya', 'Jumlah Objek Pemajuan Tradisi Budaya yang Dilakukan Pelindungan,
Pengembangan dan Pemanfaatan', 'Objek', NULL, '5', '5', '5', '5', '5', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (718, 114, 'Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Tradisional', '2.22.02.2.02.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Tradisional', 'Jumlah Laporan Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Tradisional', 'Laporan', NULL, '15', '15', '15', '15', '15', NULL, '50000000.00', '50000000.00', '50000000.00', '50000000.00', '50000000.00'),
  (719, 114, 'Pemberian Penghargaan kepada Pihak yang Berprestasi atau Berkontribusi Luar Biasa Sesuai dengan Prestasi dan Kontribusinya dalam Pemajuan Kebudayaan', '2.22.02.2.02.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Penghargaan kepada Pihak yang Berprestasi atau Berkontribusi Luar Biasa Sesuai dengan Prestasi dan Kontribusinya dalam Pemajuan Kebudayaan', 'Jumlah Orang/Lembaga yang Diberi Penghargaan untuk Mereka yang Berjasa dalam Pemajuan Kebudayaan', 'Sertifikat', NULL, '150', '150', '150', '150', '150', NULL, '590000000.00', '590000000.00', '590000000.00', '590000000.00', '590000000.00'),
  (720, 115, 'Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Lembaga Adat', '2.22.02.2.03.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Lembaga Adat', 'Jumlah Objek Pemajuan Lembaga Adat yang Telah Dilakukan Pelindungan, Pengembangan dan
Pemanfaatan', 'Objek', NULL, '2', '2', '2', '2', '2', NULL, '35000000.00', '35000000.00', '35000000.00', '35000000.00', '35000000.00'),
  (721, 115, 'Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Adat', '2.22.02.2.03.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Adat', 'Jumlah Sumber Daya Manusia, Lembaga, dan Pranata Adat yang Dibina', 'Orang', NULL, '15', '15', '15', '15', '15', NULL, '300000000.00', '300000000.00', '300000000.00', '300000000.00', '300000000.00'),
  (722, 115, 'Penyediaan Sarana dan Prasarana Pembinaan Lembaga Adat', '2.22.02.2.03.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Sarana dan Prasarana Pembinaan Lembaga Adat', 'Jumlah Sarana dan Prasarana Lembaga Adat yang Disediakan/Difasilitasi', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (723, 116, 'Peningkatan Pendidikan dan Pelatihan Sumber Daya Manusia Kesenian Tradisional', '2.22.03.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pendidikan dan Pelatihan Sumber Daya Manusia Kesenian Tradisional', 'Jumlah Sumber Daya Manusia Kesenian Tradisional yang Mendapat Pendidikan dan Pelatihan (Ditingkatkan
Kompetensinya)', 'Orang', NULL, '15', '15', '15', '15', '15', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (724, 116, 'Standardisasi dan Sertifikasi Sumber Daya Manusia Kesenian Tradisional Sesuai dengan Kebutuhan dan Tuntutan', '2.22.03.2.01.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Standardisasi dan Sertifikasi Sumber Daya Manusia Kesenian Tradisional Sesuai dengan Kebutuhan dan Tuntutan', 'Jumlah Sumber Daya Manusia Kesenian Tradisonal yang Mengikuti
Proses Standarisasi', 'Sertifikat', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (725, 116, 'Peningkatan Kapasitas Tata Kelola Lembaga Kesenian Tradisional', '2.22.03.2.01.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Peningkatan Kapasitas Tata Kelola Lembaga Kesenian Tradisional', 'Jumlah Lembaga Kesenian Tradisional yang Ditingkatkan Kapasitasnya', 'Lembaga', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (726, 117, 'Pemberdayaan Sumber Daya Manusia dan Lembaga Sejarah Lokal Kabupaten/Kota', '2.22.04.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemberdayaan Sumber Daya Manusia dan Lembaga Sejarah Lokal Provinsi', 'Jumlah Sumber Daya Manusia dan Lembaga Sejarah Lokal Provinsi yang Diberdayakan', 'Orang', NULL, '15', '15', '15', '15', '15', NULL, '250000000.00', '250000000.00', '250000000.00', '250000000.00', '250000000.00'),
  (727, 117, 'Penyediaan Sarana dan Prasarana Pembinaan Sejarah', '2.22.04.2.01.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Sarana dan Prasarana Pembinaan Sejarah', 'Jumlah Sarana dan
Prasarana Pembinaan Sejarah', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (728, 117, 'Peningkatan Akses Masyarakat Terhadap Data dan Informasi Sejarah', '2.22.04.2.01.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Tersedianya Data dan Informasi Sejarah yang Diakses Masyarakat', 'Jumlah Dokumen Data dan Informasi Sejarah yang
Dapat Diakses Masyarakat', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (729, 118, 'Pendaftaran Objek Diduga Cagar Budaya', '2.22.05.2.01.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pendaftaran Objek Diduga Cagar Budaya', 'Jumlah Objek Diduga
Cagar Budaya yang Didaftarkan', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '260000000.00', '260000000.00', '260000000.00', '260000000.00', '260000000.00'),
  (730, 118, 'Penetapan Cagar Budaya', '2.22.05.2.01.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penetapan Cagar Budaya', 'Jumlah Objek Cagar
Budaya yang Ditetapkan', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '260000000.00', '260000000.00', '260000000.00', '260000000.00', '260000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (731, 118, 'Pengusulan Warisan Budaya Tak Benda', '2.22.05.2.01.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengusulan Warisan Budaya Tak Benda', 'Jumlah Warisan Budaya
Tak Benda yang Diusulkan', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '215000000.00', '215000000.00', '215000000.00', '215000000.00', '215000000.00'),
  (732, 119, 'Pelindungan Cagar Budaya', '2.22.05.2.02.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Cagar Budaya yang Dilindungi', 'Jumlah Objek Cagar Budaya yang Dilindungi', 'Objek', NULL, '2', '2', '2', '2', '2', NULL, '210000000.00', '210000000.00', '210000000.00', '210000000.00', '210000000.00'),
  (733, 119, 'Pengembangan Cagar Budaya', '2.22.05.2.02.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksanakannya Pengembangan Cagar Budaya', 'Jumlah Objek Cagar Budaya yang
Dikembangkan', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '175000000.00', '175000000.00', '175000000.00', '175000000.00', '175000000.00'),
  (734, 119, 'Pemanfaatan Cagar Budaya', '2.22.05.2.02.0003', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pemanfaatan Cagar Budaya', 'Jumlah Objek Cagar Budaya yang
Dimanfaatkan', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (735, 119, 'Inventarisasi Cagar Budaya dan Objek Pemajuan Kebudayaan', '2.22.05.2.02.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Inventarisasi Cagar Budaya dan Objek Pemajuan Kebudayaan', 'Jumlah Cagar Budaya dan Objek Pemajuan Kebudayaan yang
Diinventarisasi', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '200000000.00', '200000000.00', '200000000.00', '200000000.00', '200000000.00'),
  (736, 120, 'Penerbitan Izin Membawa Cagar Budaya ke Luar Daerah Kabupaten/Kota dalam 1 (Satu) Daerah Kabupaten/Kota', '2.22.05.2.03.0001', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terbitnya Izin Membawa Cagar Budaya ke Luar Daerah Kabupaten/Kota dalam 1 (Satu) Daerah Kabupaten/Kota', 'Jumlah Objek Cagar Budaya yang Mendapatkan Perizinan ke Luar Daerah Provinsi', 'Objek', NULL, '1', '1', '1', '1', '1', NULL, '150000000.00', '150000000.00', '150000000.00', '150000000.00', '150000000.00'),
  (737, 120, 'Evaluasi dan Pengawasan Cagar Budaya ke Luar Daerah Kabupaten/Kota dalam 1 (Satu) Daerah Kabupaten/Kota', '2.22.05.2.03.0002', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Evaluasi dan Pengawasan Cagar Budaya ke Luar Daerah Provinsi', 'Jumlah Laporan Hasil Evaluasi dan Pengawasan Cagar Budaya ke Luar
Daerah Provinsi', 'Laporan', NULL, '1', '1', '1', '1', '1', NULL, '100000000.00', '100000000.00', '100000000.00', '100000000.00', '100000000.00'),
  (738, 121, 'Penyediaan dan Pemeliharaan Sarana dan Prasarana Museum', '2.22.06.2.01.0004', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Penyediaan dan Pemeliharaan Sarana dan Prasarana Museum', 'Jumlah Sarana dan Prasarana Museum yang Tersedia dan Terpelihara', 'Unit', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00'),
  (739, 121, 'Pengelolaan Operasional Museum', '2.22.06.2.01.0014', NULL, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL, 'Terlaksananya Pengelolaan Operasional Museum', 'Jumlah Layanan
Operasional Museum', 'Layanan', NULL, '1', '1', '1', '1', '1', NULL, '5000000.00', '5000000.00', '5000000.00', '5000000.00', '5000000.00');

-- Table: renstra_sub_kegiatan_sasaran (260 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (484, 481, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (485, 482, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (486, 483, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (487, 484, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (488, 485, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (489, 486, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (490, 487, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (491, 488, 'Terselenggaranya Walidata Pendukung Statistik Sektoral Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (492, 489, 'Terlaksananya Pengumpulan Data Statistik Sektoral Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (493, 490, 'Terlaksananya Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (494, 491, 'Tersusunnya Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (495, 492, 'Terkoordinasikannya Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (496, 493, 'Tercapainya Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis Pembangunan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (497, 494, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (498, 495, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (499, 496, 'Terlaksananya Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (500, 497, 'Terlaksananya Koordinasi dan Pelaksanaan Akuntansi SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (501, 498, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (502, 499, 'Tersedianya Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (503, 500, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semes teran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semes teran SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (504, 501, 'Tersedianya Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (505, 502, 'Tersedianya Rencana Kebutuhan Barang Milik Daerah SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (506, 503, 'Terlaksananya Pengamanan Barang Milik Daerah SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (507, 504, 'Tersedianya Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (508, 505, 'Terlaksananya Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (509, 506, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (510, 507, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (511, 508, 'Terlaksananya Pemanfaatan Barang Milik Daerah SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (512, 509, 'Tersedianya Rencana Pengelolaan Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (513, 510, 'Tersedianya Hasil Analisis serta Pengembangan Retribusi Daerah dan Kebijakan Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (514, 511, 'Terlaksananya Penyuluhan dan Penyebarluasan Kebijakan Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (515, 512, 'Tersedianya Data Objek, Subjek dan Wajib Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (516, 513, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (517, 514, 'Tersedianya Dokumen Ketetapan Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (518, 515, 'Tersedianya Laporan Pengelolaan Retribusi Daerah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (519, 516, 'Tersedianya Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (520, 517, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (521, 518, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (522, 519, 'Terlaksananya Koordinasi dan Pelaksanaan Sistem Informasi Kepegawaian', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (523, 520, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (524, 521, 'Terlaksananya Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (525, 522, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (526, 523, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (527, 524, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (528, 525, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (529, 526, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (530, 527, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (531, 528, 'Tersedianya Bahan/Material', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (532, 529, 'Terlaksananya Fasilitasi Kunjungan Tamu', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (533, 530, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (534, 531, 'Terlaksananya Penatausahaan Arsip Dinamis pada SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (535, 532, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (536, 533, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (537, 534, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (538, 535, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (539, 536, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (540, 537, 'Terlaksananya Pemeliharaan Aset Tak Berwujud', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (541, 538, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (542, 539, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (543, 540, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (544, 541, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (545, 541, 'Meningkatnya Layanan Pendidikan PAUD / Sekolah Dasar / Sekolah Menengah Pertama / Nonformal/ Kesetaraan Pada Dinas Pendidikan', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (546, 542, 'Sekolah Baru yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (547, 543, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (548, 544, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (549, 545, 'Ruang Perpustakaan Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (550, 546, 'Sarana, Prasarana dan Utilitas Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (551, 547, 'Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (552, 548, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (553, 549, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (554, 550, 'Perpustakaan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (555, 551, 'Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (556, 552, 'Mebel Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (557, 553, 'Alat Rumah Tangga Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (558, 554, 'Perlengkapan Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (559, 555, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (560, 556, 'Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (561, 557, 'Pendidik dan Tenaga Kependidikan Tersedia bagi Satuan Pendidikan Sekolah Dasar', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (562, 558, 'Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (563, 559, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (564, 560, 'Terlaksananya Pengelolaan Dana BOS Sekolah Dasar', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (565, 561, 'Meningkatnya Kapasitas Tenaga Pengelola Dana BOS Sekolah Dasar', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (566, 562, 'Ruang Laboratorium Sekolah Dasar yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (567, 563, 'Ruang Laboratorium Sekolah Dasar yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (568, 564, 'Terlaksananya Pemeliharaan Mebel Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (569, 565, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (570, 566, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (571, 567, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (572, 568, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (573, 569, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (574, 570, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (575, 571, 'Ruang/Sudut Baca yang Tertata', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (576, 572, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (577, 573, 'Tersedianya Pengadaan Perlengkapan Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (578, 574, 'Ruang Kelas Baru bertambah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (579, 575, 'Sarana, Prasarana dan Utilitas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (580, 576, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (581, 577, 'Terselenggaranya Proses Belajar Bagi Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (582, 578, 'Ruang Kelas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (583, 579, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (584, 580, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (585, 581, 'Biaya Personil Peserta Didik Sekolah Dasar Diterima oleh Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (586, 582, 'Alat Praktik dan Peraga Peserta Didik yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (587, 583, 'Sekolah Baru yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (588, 584, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (589, 585, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (590, 586, 'Perpustakaan Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (591, 587, 'Ruang Laboratorium yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (592, 588, 'Ruang Serba Guna/Aula yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (593, 589, 'Asrama Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (594, 590, 'Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (595, 591, 'Fasilitas Parkir yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (596, 592, 'Kantin Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (597, 593, 'Sarana, Prasarana dan Utilitas Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (598, 594, 'Ruang kelas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (599, 595, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (600, 596, 'Perpustakaan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (601, 597, 'Laboratorium yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (602, 598, 'Ruang Serba Guna/Aula yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (603, 599, 'Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (604, 600, 'Fasilitas Parkir yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (605, 601, 'Kantin Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (606, 602, 'Sarana, Prasarana dan Utilitas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (607, 603, 'Mebel Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (608, 604, 'Alat Rumah Tangga Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (609, 605, 'Perlengkapan Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (610, 606, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (611, 607, 'Biaya Personil Peserta Didik Sekolah Menengah Pertama Diterima oleh Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (612, 608, 'Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (613, 609, 'Pendidik dan Tenaga Kependidikan Tersedia bagi Satuan Pendidikan Sekolah Menengah Pertama', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (614, 610, 'Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (615, 611, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (616, 612, 'Terlaksananya Pengelolaan Dana BOS Sekolah Menengah Pertama', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (617, 613, 'Dana BOS Sekolah Menengah Pertama yang Terkelola dengan Baik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (618, 614, 'Terlaksananya Pemeliharaan Mebel Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (619, 615, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (620, 616, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (621, 617, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (622, 618, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (623, 619, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (624, 620, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (625, 621, 'Ruang/Sudut Baca yang Tertata', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (626, 622, 'Terselenggaranya Proses Belajar bagi Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (627, 623, 'Ruang Kelas Baru Bertambah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (628, 624, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (629, 625, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (630, 626, 'Perlengkapan Peserta Didik yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (631, 627, 'Asrama Sekolah yang terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (632, 628, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (633, 629, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (634, 630, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (635, 631, 'Alat Praktik dan Peraga Peserta Didik yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (636, 632, 'Sarana, Prasarana dan Utilitas PAUD yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (637, 633, 'Mebel PAUD yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (638, 634, 'Alat Rumah Tangga PAUD yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (639, 635, 'Perlengkapan PAUD yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (640, 636, 'Biaya Personil Peserta Didik PAUD Diterima oleh Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (641, 637, 'Pendidik dan Tenaga Kependidikan Tersedia bagi PAUD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (642, 638, 'Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (643, 639, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen PAUD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (644, 640, 'Terlaksananya Pengelolaan Dana BOP PAUD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (645, 641, 'Meningkatnya Kapasitas Pengelolaan Dana BOP PAUD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (646, 642, 'Terpeliharanya Mebel Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (647, 643, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (648, 644, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (649, 645, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (650, 646, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (651, 647, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (652, 648, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (653, 649, 'Ruang Kelas Baru bertambah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (654, 650, 'Ruang/Sudut Baca yang Tertata', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (655, 651, 'Perpustakaan Sekolah yang terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (656, 652, 'Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (657, 653, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (658, 654, 'Perpustakaan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (659, 655, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (660, 656, 'Ruang Serba Guna/Aula yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (661, 657, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (662, 658, 'Sekolah Baru yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (663, 659, 'Perlengkapan Peserta Didik  yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (664, 660, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (665, 661, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (666, 662, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (667, 663, 'Sarana, Prasarana dan Utilitas PAUD yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (668, 664, 'Alat Praktik dan Peraga Peserta Didik PAUD yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (669, 665, 'Terselenggaranya Proses Belajar PAUD', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (670, 666, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (671, 667, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi sedang/berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (672, 668, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (673, 669, 'Ruang Kelas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (674, 670, 'Biaya Personil Peserta Didik Nonformal/Kesetaraan diterima oleh peserta didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (675, 671, 'Pendidik dan Tenaga Kependidikan Tersedia bagi Satuan Pendidikan Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (676, 672, 'Pendidik dan tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (677, 673, 'Terlaksananya Pembinaan Kelembagaan dan Manajemen Sekolah Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (678, 674, 'Terlaksananya Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (679, 675, 'Meningkatnya Kapasitas Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (680, 676, 'Terlaksananya Pemeliharaan Mebel Pendidikan Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (681, 677, 'Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan profesi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (682, 678, 'Terlaksananya konten digital untuk pendidikan yang dikembangkan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (683, 679, 'Terlaksananya Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (684, 680, 'Terlaksananya kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (685, 681, 'Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (686, 682, 'Terlayaninya satuan pendidikan dalam pencegahan perundungan, kekerasan, dan intoleransi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (687, 683, 'Pendidik Satuan Pendidikan Nonformal/Kesetaraan yang mendapat sertifikat kompetensi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (688, 684, 'Ruang/Sudut Baca yang Tertata', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (689, 685, 'Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (690, 686, 'Perlengkapan Peserta Didik  yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (691, 687, 'Peserta Didik Menerima Perlengkapan Dasar Buku Teks dan Non Teks', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (692, 688, 'Ruang Guru/Kepala Sekolah/TU yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (693, 689, 'Ruang Kelas Baru bertambah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (694, 690, 'Perlengkapan Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (695, 691, 'Sarana, Prasarana dan Utilitas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (696, 692, 'Terlaksananya Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (697, 693, 'Ruang Laboratorium yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (698, 694, 'Sekolah Baru yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (699, 695, 'Alat Rumah Tangga Sekolah yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (700, 696, 'Terselenggaranya Proses Belajar bagi Peserta Didik', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (701, 697, 'Ruang Laboratorium yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (702, 698, 'Mebel Pendidikan Nonformal/Kesetaraan yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (703, 699, 'Terlaksananya Pemeliharaan Rutin Sarana, Prasarana dan Utilitas Sekolah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (704, 700, 'Sarana, Prasarana dan Utilitas Pendidikan Non Formal yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (705, 701, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (706, 702, 'Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Terehabilitasi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (707, 703, 'Alat Praktik dan Peraga Peserta Didik Nonformal/Kesetaraan yang Tersedia', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (708, 704, 'Ruang Unit Kesehatan Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (709, 705, 'Ruang Unit Kesehatan Sekolah yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (710, 706, 'Taman Bacaan Masyarakat yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (711, 707, 'Taman Bacaan Masyarakat yang Terbangun', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (712, 708, 'Ruang Guru/Kepala Sekolah/TU yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (713, 709, 'Ruang Kelas Sekolah yang Terehabilitasi Sedang/Berat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (714, 710, 'Tersedianya Dokumen Hasil Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (715, 711, 'Terlaksananya Penataan Pendistribusian Pendidik dan Tenaga Kependidikan Satuan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (716, 712, 'Terlaksananya Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (717, 713, 'Terlaksananya Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (718, 714, 'Terlaksananya Penyusunan, Pemutakhiran, Penetapan PPKD Kabupaten/Kota', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (719, 715, 'Terlaksananya pembinaan Sumber Daya Manusia Bidang Kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (720, 716, 'Terlaksananya Pembinaan Lembaga dan Pranata Kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (721, 717, 'Terlaksananya Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Tradisi Budaya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (722, 718, 'Terlaksananya Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Tradisional', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (723, 719, 'Tersedianya Penghargaan kepada Pihak yang Berprestasi atau Berkontribusi Luar Biasa Sesuai dengan Prestasi dan Kontribusinya dalam Pemajuan Kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (724, 720, 'Terlaksananya Pelindungan, Pengembangan, Pemanfaatan Objek Pemajuan Lembaga Adat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (725, 721, 'Terlaksananya Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Adat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (726, 722, 'Tersedianya Sarana dan Prasarana Pembinaan Lembaga Adat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (727, 723, 'Terlaksananya Pendidikan dan Pelatihan Sumber Daya Manusia Kesenian Tradisional', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (728, 724, 'Tersedianya Standardisasi dan Sertifikasi Sumber Daya Manusia Kesenian Tradisional Sesuai dengan Kebutuhan dan Tuntutan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (729, 725, 'Terlaksananya Peningkatan Kapasitas Tata Kelola Lembaga Kesenian Tradisional', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (730, 726, 'Terlaksananya Pemberdayaan Sumber Daya Manusia dan Lembaga Sejarah Lokal Provinsi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (731, 727, 'Tersedianya Sarana dan Prasarana Pembinaan Sejarah', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (732, 728, 'Tersedianya Data dan Informasi Sejarah yang Diakses Masyarakat', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (733, 729, 'Terlaksananya Pendaftaran Objek Diduga Cagar Budaya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (734, 730, 'Terlaksananya Penetapan Cagar Budaya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (735, 731, 'Terlaksananya Pengusulan Warisan Budaya Tak Benda', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (736, 732, 'Terlaksananya Cagar Budaya yang Dilindungi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (737, 733, 'Terlaksanakannya Pengembangan Cagar Budaya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (738, 734, 'Terlaksananya Pemanfaatan Cagar Budaya', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (739, 735, 'Terlaksananya Inventarisasi Cagar Budaya dan Objek Pemajuan Kebudayaan', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (740, 736, 'Terbitnya Izin Membawa Cagar Budaya ke Luar Daerah Kabupaten/Kota dalam 1 (Satu) Daerah Kabupaten/Kota', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (741, 737, 'Terlaksananya Evaluasi dan Pengawasan Cagar Budaya ke Luar Daerah Provinsi', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (742, 738, 'Terlaksananya Penyediaan dan Pemeliharaan Sarana dan Prasarana Museum', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (743, 739, 'Terlaksananya Pengelolaan Operasional Museum', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

-- Table: renstra_sub_kegiatan_indikator (268 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (484, 481, 484, 37, 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', '1', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (485, 482, 485, 37, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen RKA-SKPD', 'Dokumen', '1', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (486, 483, 486, 37, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Dokumen', '1', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (487, 484, 487, 37, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen DPA-SKPD', 'Dokumen', '1', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (488, 485, 488, 37, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Dokumen', '1', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (489, 486, 489, 37, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi
Kinerja SKPD', 'Laporan', '1', '6', '180000000.00', '6', '180000000.00', '6', '180000000.00', '6', '180000000.00', '6', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (490, 487, 490, 37, 'Jumlah Laporan Evaluasi Kinerja Perangkat Daerah', 'Laporan', '1', '4', '40000000.00', '4', '40000000.00', '4', '40000000.00', '4', '40000000.00', '4', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (491, 488, 491, 37, 'Jumlah Dokumen Hasil Penyelenggaraan Walidata Pendukung Statistik
Sektoral Daerah', 'Dokumen', '1', '2', '20000000.00', '2', '20000000.00', '2', '20000000.00', '2', '20000000.00', '2', '20000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (492, 489, 492, 37, 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa Lingkup
Perangkat Daerah', 'Data', '', '12', '25000000.00', '12', '25000000.00', '12', '25000000.00', '12', '25000000.00', '12', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (493, 490, 493, 37, 'Jumlah Berita Acara Hasil Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat
Daerah', 'Berita Acara', '', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (494, 491, 494, 37, 'Jumlah Dokumen Perencanaan Urusan Selain Renstra PD dan
Renja PD yang disusun', 'Dokumen', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (495, 492, 495, 37, 'Jumlah Subtansi Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan
Daerah yang Diampu', 'Substansi', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (496, 493, 496, 37, 'Jumlah Berita Acara Hasil Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis Pembangunan', 'Berita Acara', '', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (497, 494, 497, 37, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '4500/12', '4500/12', '399915000000.00', '4500/12', '402175000000.00', '4500/12', '402175000000.00', '4500/12', '402175000000.00', '4500/12', '402175000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (498, 495, 498, 37, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '10', '10', '415000000.00', '10', '415000000.00', '10', '415000000.00', '10', '415000000.00', '10', '415000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (499, 496, 499, 37, 'Jumlah Dokumen Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', '12', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (500, 497, 500, 37, 'Jumlah Dokumen Koordinasi dan Pelaksanaan Akuntansi
SKPD', 'Dokumen', '12', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (501, 498, 501, 37, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun
SKPD', 'Laporan', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (502, 499, 502, 37, 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', '3', '3', '50000000.00', '3', '50000000.00', '3', '50000000.00', '3', '50000000.00', '3', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (503, 500, 503, 37, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semes
teran SKPD', 'Laporan', '12', '12', '75000000.00', '12', '75000000.00', '12', '75000000.00', '12', '75000000.00', '12', '75000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (504, 501, 504, 37, 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi
Anggaran', 'Dokumen', '12', '12', '35000000.00', '12', '35000000.00', '12', '35000000.00', '12', '35000000.00', '12', '35000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (505, 502, 505, 37, 'Jumlah Rencana Kebutuhan Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (506, 503, 506, 37, 'Jumlah Dokumen Pengamanan Barang Milik Daerah SKPD', 'Dokumen', '2', '2', '35000000.00', '2', '35000000.00', '2', '35000000.00', '2', '35000000.00', '2', '35000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (507, 504, 507, 37, 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian
Barang Milik Daerah SKPD', 'Laporan', '4', '4', '50000000.00', '4', '50000000.00', '4', '50000000.00', '4', '50000000.00', '4', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (508, 505, 508, 37, 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (509, 506, 509, 37, 'Jumlah Laporan Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada
SKPD', 'Laporan', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (510, 507, 510, 37, 'Jumlah Laporan Penatausahaan Barang
Milik Daerah pada SKPD', 'Laporan', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (511, 508, 511, 37, 'Jumlah Dokumen Hasil Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (512, 509, 512, 37, 'Jumlah Dokumen Rencana Pengelolaan Retribusi Daerah', 'Dokumen', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (513, 510, 513, 37, 'Jumlah Dokumen Hasil Analisis serta Pengembangan Retribusi Daerah dan Kebijakan Retribusi Daerah', 'Dokumen', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (514, 511, 514, 37, 'Jumlah Laporan Hasil Penyuluhan dan Penyebarluasan Kebijakan
Retribusi Daerah', 'Laporan', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (515, 512, 515, 37, 'Jumlah Data Objek, Subjek dan Wajib Retribusi Daerah', 'Dokumen', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (516, 513, 516, 37, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi
Daerah', 'Laporan', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (517, 514, 517, 37, 'Jumlah Dokumen Ketetapan Retribusi
Daerah', 'Dokumen', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (518, 515, 518, 37, 'Jumlah Laporan Pengelolaan Retribusi
Daerah', 'Dokumen', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (519, 516, 519, 37, 'Jumlah Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Unit', '', '3', '30000000.00', '3', '30000000.00', '3', '30000000.00', '3', '30000000.00', '3', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (520, 517, 520, 37, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '', '100', '100000000.00', '100', '100000000.00', '100', '100000000.00', '100', '100000000.00', '100', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (521, 518, 521, 37, 'Jumlah Dokumen Pendataan dan
Pengolahan Administrasi Kepegawaian', 'Dokumen', '', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (522, 519, 522, 37, 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi Kepegawaian', 'Dokumen', '', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (523, 520, 523, 37, 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (524, 521, 524, 37, 'Jumlah Orang yang Mengikuti Bimbingan Teknis Implementasi Peraturan Perundang-
Undangan', 'Orang', '', '150', '200000000.00', '150', '200000000.00', '150', '200000000.00', '150', '200000000.00', '150', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (525, 522, 525, 37, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan
Bangunan Kantor yang Disediakan', 'Paket', '', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (526, 523, 526, 37, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (527, 524, 527, 37, 'Jumlah Paket Peralatan
Rumah Tangga yang Disediakan', 'Paket', '', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (528, 525, 528, 37, 'Jumlah Paket Bahan
Logistik Kantor yang Disediakan', 'Paket', '1', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (529, 526, 529, 37, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', '', '1', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (530, 527, 530, 37, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan
yang Disediakan', '', '12', '12', '25000000.00', '12', '25000000.00', '12', '25000000.00', '12', '25000000.00', '12', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (531, 528, 531, 37, 'Jumlah Paket
Bahan/Material yang Disediakan', 'Paket', '', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', '1', '10000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (532, 529, 532, 37, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (533, 530, 533, 37, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '12', '12', '550000000.00', '12', '550000000.00', '12', '550000000.00', '12', '550000000.00', '12', '550000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (534, 531, 534, 37, 'Jumlah Dokumen Penatausahaan Arsip
Dinamis pada SKPD', 'Dokumen', '', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (535, 532, 535, 37, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan
Berbasis Elektronik pada SKPD', 'Dokumen', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (536, 533, 536, 37, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '7', '7', '300000000.00', '7', '300000000.00', '7', '300000000.00', '7', '300000000.00', '7', '300000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (537, 534, 537, 37, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '171', '171', '150000000.00', '171', '150000000.00', '171', '150000000.00', '171', '150000000.00', '171', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (538, 535, 538, 37, 'Jumlah Mebel yang Dipelihara', 'Unit', '5', '5', '30000000.00', '5', '30000000.00', '5', '30000000.00', '5', '30000000.00', '5', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (539, 536, 539, 37, 'Jumlah Peralatan dan Mesin Lainnya yang
Dipelihara', 'Unit', '', '25', '200000000.00', '25', '200000000.00', '25', '200000000.00', '25', '200000000.00', '25', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (540, 537, 540, 37, 'Jumlah Aset Tak Berwujud yang Dipelihara', 'Unit', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (541, 538, 541, 37, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '5', '5', '200000000.00', '5', '200000000.00', '5', '200000000.00', '5', '200000000.00', '5', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (542, 539, 542, 37, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Dipelihara/Direhabilitasi', 'Unit', '', '50', '100000000.00', '50', '100000000.00', '50', '100000000.00', '50', '100000000.00', '50', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (543, 540, 543, 37, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '5', '50000000.00', '5', '50000000.00', '5', '50000000.00', '5', '50000000.00', '5', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (544, 541, 544, 37, 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen (Satuan
Pendidikan)', 'SatuanPendidikan', '1', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (545, 541, 545, 37, 'Indeks iklim kebinekaan sekolah jenjang SMP', '%', '68.96', '70.96', '28902000000.00', '71.96', '30002000000.00', '72.96', '30102000000.00', '73.96', '30202000000.00', '74.96', '30302000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (546, 541, 545, 37, 'Indeks iklim keamanan sekolah jenjang SMP', '%', '68.04', '71.04', '0.00', '71.54', '0.00', '74.04', '0.00', '75.54', '0.00', '77.04', '0.00', 20, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (547, 541, 545, 37, 'Indeks iklim keamanan sekolah jenjang SD', '%', '72.76', '74.56', '0.00', '75.46', '0.00', '76.36', '0.00', '77.26', '0.00', '78.16', '0.00', 30, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (548, 541, 545, 37, 'Indeks iklim inklusivitas sekolah jenjang SMP', '%', '54.85', '59.65', '0.00', '62.05', '0.00', '64.45', '0.00', '66.85', '0.00', '69.25', '0.00', 40, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (549, 541, 545, 37, 'Indeks iklim inklusivitas sekolah jenjang SD', '%', '56.92', '61.92', '0.00', '64.42', '0.00', '66.92', '0.00', '69.42', '0.00', '71.92', '0.00', 50, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (550, 541, 545, 37, 'Indeks iklim kebinekaan sekolah jenjang SD', '%', '69.25', '71.25', '0.00', '72.25', '0.00', '73.25', '0.00', '74.25', '0.00', '75.25', '0.00', 60, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (551, 541, 545, 37, 'Proporsi jumlah satuan PAUD yang mendapatkan minimal akreditasi B', '%', '72.34', '73.16', '0.00', '73.57', '0.00', '73.98', '0.00', '74.39', '0.00', '74.8', '0.00', 70, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (552, 541, 545, 37, 'Jumlah anak usia 7-18 Tahun yang berpartisipasi dalam pendidikan
kesetaraan (APS)', '%', '18.41', '26.61', '0.00', '30.71', '0.00', '34.81', '0.00', '38.91', '0.00', '43.01', '0.00', 80, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (553, 541, 545, 37, 'Jumlah anak usia 7-15 Tahun yang berpartisipasi dalam pendidikan dasar
(APS)', '%', '99.17', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', '100', '0.00', 90, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (554, 542, 546, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '240000000.00', '1', '1120000000.00', '1', '1220000000.00', '1', '1320000000.00', '1', '1420000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (555, 543, 547, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU
yang Telah Dibangun', 'Ruang', '', '1', '160000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (556, 544, 548, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '150000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (557, 545, 549, 37, 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '150000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (558, 546, 550, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Dibangun', 'Unit', '1', '1', '160000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (559, 547, 551, 37, 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang
Telah Dibangun', 'Unit', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (560, 548, 552, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (561, 549, 553, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (562, 550, 554, 37, 'Jumlah Perpustakaan Sekolah yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (563, 551, 555, 37, 'Jumlah Rumah Dinas Kepala Sekolah, Guru, Penjaga Sekolah yang
Telah DiRehabilitasi Sedang/Berat', 'Unit', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (564, 552, 556, 37, 'Jumlah Mebel sekolah yang Tersedia', 'Paket', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (565, 553, 557, 37, 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Paket', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (566, 554, 558, 37, 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (567, 555, 559, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (568, 556, 560, 37, 'Jumlah Siswa yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non Akademik', 'Peserta Didik', '300', '300', '300000000.00', '300', '300000000.00', '300', '300000000.00', '300', '300000000.00', '300', '300000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (569, 557, 561, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada Satuan Pendidikan Sekolah Dasar', 'Orang', '150', '150', '125000000.00', '150', '150000000.00', '150', '150000000.00', '150', '150000000.00', '150', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (570, 558, 562, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '250', '250', '155000000.00', '250', '175000000.00', '250', '175000000.00', '250', '175000000.00', '250', '175000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (571, 559, 563, 37, 'Jumlah Sekolah Dasar yang Dilaksanakan Pembinaan Kelembagaan
dan manajemen sekolah', 'Satuan Pendidikan', '444', '444', '175000000.00', '444', '250000000.00', '444', '250000000.00', '444', '250000000.00', '444', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (572, 560, 564, 37, 'Jumlah Sekolah Dasar yang Mengelola Dana BOS', 'Satuan Pendidikan', '444', '444', '120000000.00', '444', '120000000.00', '444', '120000000.00', '444', '120000000.00', '444', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (573, 561, 565, 37, 'Jumlah Tenaga Pengelola yang Meningkat Kapasitasnya dalam
Pengelolaan Dana BOS Sekolah Dasar', 'Orang', '20', '20', '175000000.00', '20', '175000000.00', '20', '175000000.00', '20', '175000000.00', '20', '175000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (574, 562, 566, 37, 'Jumlah Ruang Laboratorium Sekolah Dasar yang Telah
Dibangun', 'Ruang', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (575, 563, 567, 37, 'Jumlah Laboratorium Sekolah Dasar yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (576, 564, 568, 37, 'Jumlah Mebel Sekolah
yang Dilaksanakan Pemeliharaan', 'Unit', '', '50', '30000000.00', '50', '30000000.00', '50', '30000000.00', '50', '30000000.00', '50', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (577, 565, 569, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (578, 566, 570, 37, 'Jumlah konten digital untuk pendidikan yang telah dikembangkan', 'Konten Digital', '1', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (579, 567, 571, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang
Pendidikan', 'Dokumen', '12', '12', '100000000.00', '12', '100000000.00', '12', '100000000.00', '12', '100000000.00', '12', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (580, 568, 572, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (581, 569, 573, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', '', '3', '150000000.00', '3', '150000000.00', '3', '150000000.00', '3', '150000000.00', '3', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (582, 570, 574, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan,
kekerasan, dan intoleransi', 'Kegiatan', '', '3', '160000000.00', '3', '160000000.00', '3', '160000000.00', '3', '160000000.00', '3', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (583, 571, 575, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (584, 572, 576, 37, 'Jumlah Buku Teks dan Non Teks yang Diterima
Peserta Didik', 'Buku', '', '110', '150000000.00', '110', '150000000.00', '110', '150000000.00', '110', '150000000.00', '110', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (585, 573, 577, 37, 'Jumlah Perlengkapan Peserta Didik yang
Tersedia', 'Paket', '1', '110', '100000000.00', '110', '100000000.00', '110', '100000000.00', '110', '100000000.00', '110', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (586, 574, 578, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '1', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (587, 575, 579, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '1', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (588, 576, 580, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '20', '50000000.00', '20', '50000000.00', '20', '50000000.00', '20', '50000000.00', '20', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (589, 577, 581, 37, 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'SatuanPendidikan', '120', '120', '135000000.00', '120', '135000000.00', '120', '135000000.00', '120', '135000000.00', '120', '135000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (590, 578, 582, 37, 'Jumlah Ruang Kelas Sekolah yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (591, 579, 583, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', '', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (592, 580, 584, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Dibangun', 'Ruang', '', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (593, 581, 585, 37, 'Jumlah Peserta Didik Sekolah Dasar yang Menerima Biaya Personil Peserta Didik', 'Peserta Didik', '150', '150', '120000000.00', '150', '120000000.00', '150', '120000000.00', '150', '120000000.00', '150', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (594, 582, 586, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Paket', '10', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (595, 583, 587, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (596, 584, 588, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Dibangun', 'Ruang', '1', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (597, 585, 589, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (598, 586, 590, 37, 'Jumlah Perpustakaan Sekolah yang Telah
Dibangun', 'Ruang', '1', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', '1', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (599, 587, 591, 37, 'Jumlah Ruang Laboratorium yang Telah
Dibangun', 'Ruang', '1', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (600, 588, 592, 37, 'Jumlah Ruang Serba Guna/Aula yang Telah
Dibangun', 'Ruang', '', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (601, 589, 593, 37, 'Jumlah Asrama Sekolah yang Telah Dibangun', 'Unit', '', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (602, 590, 594, 37, 'Jumlah Rumah Dinas Kepala Sekolah, Guru,
Penjaga Sekolah yang Telah Dibangun', 'Unit', '', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (603, 591, 595, 37, 'Jumlah Fasilitas Parkir yang Telah Dibangun', 'Unit', '', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (604, 592, 596, 37, 'Jumlah Kantin Sekolah yang Telah Dibangun', 'Unit', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (605, 593, 597, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Dibangun', 'Unit', '1', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (606, 594, 598, 37, 'Jumlah Ruang kelas sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '1', '2', '200000000.00', '2', '200000000.00', '2', '200000000.00', '2', '200000000.00', '2', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (607, 595, 599, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '1', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (608, 596, 600, 37, 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', '', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (609, 597, 601, 37, 'Jumlah Laboratorium yang
Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (610, 598, 602, 37, 'Jumlah Ruang Serba Guna/Aula yang Telah Direhabilitasi sedang/berat', 'Ruang', '', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (611, 599, 603, 37, 'Jumlah Rumah Dinas Kepala Sekolah/Guru/Penjaga Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Unit', '', '1', '110000000.00', '1', '110000000.00', '1', '110000000.00', '1', '110000000.00', '1', '110000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (612, 600, 604, 37, 'Jumlah Fasilitas Parkir
yang Telah Direhabilitasi Sedang/Berat', 'Unit', '', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (613, 601, 605, 37, 'Jumlah Kantin Sekolah
yang Direhabilitasi Sedang/Berat', 'Unit', '', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (614, 602, 606, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '1', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (615, 603, 607, 37, 'Jumlah Mebel Sekolah yang Tersedia', 'Paket', '', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (616, 604, 608, 37, 'Jumlah Alat Rumah Tangga Sekolah yang
Tersedia', 'Paket', '', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (617, 605, 609, 37, 'Jumlah Perlengkapan Sekolah yang Tersedia', 'Paket', '', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (618, 606, 610, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (619, 607, 611, 37, 'Jumlah Peserta didik Sekolah Menengah Pertama yang Menerima
Biaya Personil Peserta Didik', 'Peserta Didik', '', '200', '250000000.00', '200', '250000000.00', '200', '250000000.00', '200', '250000000.00', '200', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (620, 608, 612, 37, 'Jumlah Siswa yang Mengikuti Ajang Kompetisi/Lomba
Akademik dan Non Akademik', 'Peserta Didik', '150', '150', '250000000.00', '150', '250000000.00', '150', '250000000.00', '150', '250000000.00', '150', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (621, 609, 613, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada Satuan Pendidikan Sekolah Menengah Pertama', 'Orang', '', '98', '100000000.00', '98', '100000000.00', '98', '100000000.00', '98', '100000000.00', '98', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (622, 610, 614, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '', '98', '100000000.00', '98', '100000000.00', '98', '100000000.00', '98', '100000000.00', '98', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (623, 611, 615, 37, 'Jumlah Sekolah Menengah Pertama yang Dilaksanakan Pembinaan', 'Satuan Pendidikan', '98', '98', '250000000.00', '98', '250000000.00', '98', '250000000.00', '98', '250000000.00', '98', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (624, 612, 616, 37, 'Jumlah Sekolah Menengah pertama yang Mengelola
Dana BOS', 'Satuan Pendidikan', '98', '98', '1000000000.00', '98', '1000000000.00', '98', '1000000000.00', '98', '1000000000.00', '98', '1000000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (625, 613, 617, 37, 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana
BOS Sekolah Menengah Pertama', '', '', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (626, 614, 618, 37, 'Jumlah Mebel Sekolah
yang Dilaksanakan Pemeliharaan', 'Unit', '', '60', '30000000.00', '60', '30000000.00', '60', '30000000.00', '60', '30000000.00', '60', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (627, 615, 619, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (628, 616, 620, 37, 'Jumlah konten digital untuk pendidikan yang telah
dikembangkan', 'Konten Digital', '', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (629, 617, 621, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', '', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (630, 618, 622, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (631, 619, 623, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga
Pendidik yang terfasilitasi', 'Komunitas', '', '9', '200000000.00', '9', '200000000.00', '9', '200000000.00', '9', '200000000.00', '9', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (632, 620, 624, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '5', '200000000.00', '5', '200000000.00', '5', '200000000.00', '5', '200000000.00', '5', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (633, 621, 625, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', '1', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (634, 622, 626, 37, 'Jumlah Peserta Didik yang Mengikuti Proses Belajar', 'Satuan Pendidikan', '98', '98', '200000000.00', '98', '200000000.00', '98', '200000000.00', '98', '200000000.00', '98', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (635, 623, 627, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '1', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', '1', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (636, 624, 628, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '25', '40000000.00', '25', '40000000.00', '25', '40000000.00', '25', '40000000.00', '25', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (637, 625, 629, 37, 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', '', '98', '180000000.00', '98', '180000000.00', '98', '180000000.00', '98', '180000000.00', '98', '180000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (638, 626, 630, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '2', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (639, 627, 631, 37, 'Jumlah Asrama Sekolah
yang telah direhabilitasi sedang/berat', 'Unit', '', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (640, 628, 632, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (641, 629, 633, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', '', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (642, 630, 634, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Direhabilitasi', 'Ruang', '', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (643, 631, 635, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik yang Tersedia', 'Paket', '', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', '10', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (644, 632, 636, 37, 'Jumlah Sarana, Prasarana dan Utilitas PAUD yang Telah Dibangun', 'Unit', '1', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (645, 633, 637, 37, 'Jumlah Mebel PAUD yang Tersedia', 'Paket', '', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (646, 634, 638, 37, 'Jumlah Alat Rumah
Tangga PAUD yang Tersedia', 'Paket', '', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', '1', '15000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (647, 635, 639, 37, 'Jumlah perlengkapan
PAUD yang Tersedia', 'Paket', '', '3', '60000000.00', '3', '60000000.00', '3', '60000000.00', '3', '60000000.00', '3', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (648, 636, 640, 37, 'Jumlah Peserta Didik PAUD yang Menerima Biaya Personil Peserta
Didik', 'Peserta Didik', '', '1000', '100000000.00', '1000', '100000000.00', '1000', '100000000.00', '1000', '100000000.00', '1000', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (649, 637, 641, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia pada PAUD', 'Orang', '', '100', '150000000.00', '100', '150000000.00', '100', '150000000.00', '100', '150000000.00', '100', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (650, 638, 642, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi dan Kualifikasi', 'Orang', '', '20', '40000000.00', '20', '40000000.00', '20', '40000000.00', '20', '40000000.00', '20', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (651, 639, 643, 37, 'Jumlah PAUD yang Dilaksanakan Pembinaan Kelembagaan dan
Manajemen', 'Satuan Pendidikan', '', '100', '60000000.00', '100', '60000000.00', '100', '60000000.00', '100', '60000000.00', '100', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (652, 640, 644, 37, 'Jumlah PAUD yang
Mengelola Dana BOP', 'Satuan Pendidikan', '782', '782', '100000000.00', '782', '100000000.00', '782', '100000000.00', '782', '100000000.00', '782', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (653, 641, 645, 37, 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana
BOP PAUD', 'Orang', '', '20', '200000000.00', '20', '200000000.00', '20', '200000000.00', '20', '200000000.00', '20', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (654, 642, 646, 37, 'Jumlah Mebel Sekolah yang Dipelihara', 'Unit', '', '60', '25000000.00', '60', '25000000.00', '60', '25000000.00', '60', '25000000.00', '60', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (655, 643, 647, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '4', '160000000.00', '4', '160000000.00', '4', '160000000.00', '4', '160000000.00', '4', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (656, 644, 648, 37, 'Jumlah konten digital untuk pendidikan yang telah
dikembangkan', 'Konten Digital', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (657, 645, 649, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi Layanan di Bidang
Pendidikan', 'Konten Digital', '', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', '12', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (658, 646, 650, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '110000000.00', '2', '110000000.00', '2', '110000000.00', '2', '110000000.00', '2', '110000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (659, 647, 651, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU
yang Telah Dibangun', 'Ruang', '', '1', '170000000.00', '1', '170000000.00', '1', '170000000.00', '1', '170000000.00', '1', '170000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (660, 648, 652, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga Pendidik yang terfasilitasi', 'Komunitas', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (661, 649, 653, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '1', '2', '300000000.00', '2', '300000000.00', '2', '300000000.00', '2', '300000000.00', '2', '300000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (662, 650, 654, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', '4', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (663, 651, 655, 37, 'Jumlah Perpustakaan
Sekolah yang Telah Dibangun', 'Ruang', '', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (664, 652, 656, 37, 'Jumlah Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba Akademik dan Non
Akademik', 'Peserta didik', '', '250', '200000000.00', '250', '200000000.00', '250', '200000000.00', '250', '200000000.00', '250', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (665, 653, 657, 37, 'Jumlah Buku Teks dan
Non Teks yang Diterima Peserta Didik', 'Buku', '', '4', '200000000.00', '4', '200000000.00', '4', '200000000.00', '4', '200000000.00', '4', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (666, 654, 658, 37, 'Jumlah Perpustakaan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (667, 655, 659, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '3', '150000000.00', '3', '150000000.00', '3', '150000000.00', '3', '150000000.00', '3', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (668, 656, 660, 37, 'Jumlah Ruang Serba Guna/Aula yang Telah
Direhabilitasi sedang/berat', 'Ruang', '', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (669, 657, 661, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '20', '150000000.00', '20', '150000000.00', '20', '150000000.00', '20', '150000000.00', '20', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (670, 658, 662, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', '1', '1000000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (671, 659, 663, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '', '5', '60000000.00', '5', '60000000.00', '5', '60000000.00', '5', '60000000.00', '5', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (672, 660, 664, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan
Pemeliharaan', 'Unit', '', '2', '40000000.00', '2', '40000000.00', '2', '40000000.00', '2', '40000000.00', '2', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (673, 661, 665, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Direhabilitasi', 'Ruang', '', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (674, 662, 666, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Dibangun', 'Ruang', '', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (675, 663, 667, 37, 'Jumlah Sarana, Prasarana dan Utilitas PAUD yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', '2', '60000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (676, 664, 668, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik PAUD yang Tersedia', 'Paket', '', '5', '100000000.00', '5', '100000000.00', '5', '100000000.00', '5', '100000000.00', '5', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (677, 665, 669, 37, 'Jumlah Peserta Didik PAUD yang Mengikuti Proses Belajar', 'Satuan Pendidikan', '', '250', '150000000.00', '250', '150000000.00', '250', '150000000.00', '250', '150000000.00', '250', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (678, 666, 670, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '80000000.00', '1', '80000000.00', '1', '80000000.00', '1', '80000000.00', '1', '80000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (679, 667, 671, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
sedang/berat', 'Ruang', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (680, 668, 672, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', '1', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (681, 669, 673, 37, 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', '1', '130000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (682, 670, 674, 37, 'Jumlah Peserta Didik Nonformal/Kesetaraan yang Menerima Biaya
Personil Peserta Didik', 'Peserta Didik', '', '100', '1975000000.00', '100', '1975000000.00', '100', '1975000000.00', '100', '1975000000.00', '100', '1975000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (683, 671, 675, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Tersedia bagi Satuan Pendidikan Nonformal/Kesetaraan', 'Orang', '', '28', '76000000.00', '28', '76000000.00', '28', '76000000.00', '28', '76000000.00', '28', '76000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (684, 672, 676, 37, 'Jumlah Pendidik dan Tenaga Kependidikan yang Mendapatkan Fasilitasi Kenaikan Pangkat/Golongan, Pemberian Promosi, Peningkatan Kompetensi
dan Kualifikasi', 'Orang', '', '28', '76000000.00', '28', '76000000.00', '28', '76000000.00', '28', '76000000.00', '28', '76000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (685, 673, 677, 37, 'Jumlah Sekolah Nonformal/Kesetaraan yang Dilaksanakan Pembinaan Kelembagaan dan Manajemen', 'Satuan Pendidikan', '', '28', '120000000.00', '28', '120000000.00', '28', '120000000.00', '28', '120000000.00', '28', '120000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (686, 674, 678, 37, 'Jumlah Sekolah Nonformal/Kesetaraan yang Mengelola Dana BOP', 'SatuanPendidikan', '', '28', '350000000.00', '28', '350000000.00', '28', '350000000.00', '28', '350000000.00', '28', '350000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (687, 675, 679, 37, 'Jumlah Tenaga yang Meningkat Kapasitasnya dalam Pengelolaan Dana BOP Sekolah Nonformal/Kesetaraan', 'Orang', '', '10', '40000000.00', '10', '40000000.00', '10', '40000000.00', '10', '40000000.00', '10', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (688, 676, 680, 37, 'Jumlah Mebel Pendidikan Nonformal/Kesetaraan yang Dilaksanakan
Pemeliharaan', 'Unit', '', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (689, 677, 681, 37, 'Jumlah Pelaku perbukuan daerah yang mendapatkan fasilitasi peningkatan
profesi', 'Orang', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (690, 678, 682, 37, 'Jumlah konten digital untuk pendidikan yang telah
dikembangkan', 'Konten Digital', '', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', '2', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (691, 679, 683, 37, 'Jumlah Dokumen Hasil Koordinasi, Perencanaan, Supervisi dan Evaluasi
Layanan di Bidang Pendidikan', 'Dokumen', '', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (692, 680, 684, 37, 'Jumlah kegiatan sosialisasi dan advokasi kebijakan di bidang Pendidikan yang dilaksanakan', 'Dokumen', '', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (693, 681, 685, 37, 'Jumlah Komunitas Belajar Pendidik dan Tenaga
Pendidik yang terfasilitasi', 'Komunitas', '', '3', '75000000.00', '3', '75000000.00', '3', '75000000.00', '3', '75000000.00', '3', '75000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (694, 682, 686, 37, 'Jumlah kegiatan pendampingan bagi satuan pendidikan untuk pencegahan perundungan, kekerasan, dan intoleransi', 'Kegiatan', '', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', '1', '40000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (695, 683, 687, 37, 'Pendidik Satuan Pendidikan Nonformal/Kesetaraan
yang mendapat sertifikat kompetensi', 'Orang', '', '28', '160000000.00', '28', '160000000.00', '28', '160000000.00', '28', '160000000.00', '28', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (696, 684, 688, 37, 'Jumlah Ruang/Sudut Baca yang Telah Ditata', 'Ruang', '', '2', '75000000.00', '2', '75000000.00', '2', '75000000.00', '2', '75000000.00', '2', '75000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (697, 685, 689, 37, 'Jumlah Peserta Didik yang Mengikuti Ajang Kompetisi/Lomba
Akademik dan Non Akademik', 'Peserta Didik', '', '30', '150000000.00', '30', '150000000.00', '30', '150000000.00', '30', '150000000.00', '30', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (698, 686, 690, 37, 'Jumlah Perlengkapan
Peserta Didik yang Tersedia', 'Paket', '', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (699, 687, 691, 37, 'Jumlah Buku Teks dan Non Teks yang Diterima
Peserta Didik', 'Buku', '', '28', '80000000.00', '28', '80000000.00', '28', '80000000.00', '28', '80000000.00', '28', '80000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (700, 688, 692, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU
yang Telah Dibangun', 'Ruang', '', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (701, 689, 693, 37, 'Jumlah Ruang Kelas Baru yang Bertambah', 'Ruang', '', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (702, 690, 694, 37, 'Jumlah Perlengkapan
Sekolah yang Tersedia', 'Paket', '', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (703, 691, 695, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Unit', '', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (704, 692, 696, 37, 'Jumlah Peserta Bimbingan Teknis, Pelatihan, dan/atau Magang/PKL untuk Peningkatan Kapasitas Bidang Pendidikan yang
dilaksanakan', 'Orang', '', '28', '65000000.00', '28', '65000000.00', '28', '65000000.00', '28', '65000000.00', '28', '65000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (705, 693, 697, 37, 'Jumlah Ruang Laboratorium yang Telah
Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (706, 694, 698, 37, 'Jumlah Sekolah Baru yang Telah Dibangun', 'Unit', '', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', '1', '500000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (707, 695, 699, 37, 'Jumlah Alat Rumah
Tangga Sekolah yang Tersedia', 'Paket', '', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', '1', '25000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (708, 696, 700, 37, 'Jumlah Satuan Pendidikan yang Menyelenggarakan Proses Belajar', 'Peserta Didik', '', '215', '3500000000.00', '215', '3500000000.00', '215', '3500000000.00', '215', '3500000000.00', '215', '3500000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (709, 697, 701, 37, 'Jumlah Ruang Laboratorium yang Telah
Dibangun', 'Ruang', '', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', '1', '160000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (710, 698, 702, 37, 'Jumlah Mebel Sekolah yang Tersedia', 'Paket', '', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (711, 699, 703, 37, 'Jumlah Sarana, Prasarana dan Utilitas Sekolah yang Dilaksanakan Pemeliharaan', 'Unit', '', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', '1', '20000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (712, 700, 704, 37, 'Jumlah Sarana, Prasarana dan Utilitas Pendidikan Non Formal yang Telah
Dibangun', 'Unit', '', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (713, 701, 705, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus
yang Telah Dibangun', 'Ruang', '', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', '1', '140000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (714, 702, 706, 37, 'Jumlah Ruang Pusat Sumber Anak Berkebutuhan Khusus yang Telah Direhabilitasi', 'Ruang', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (715, 703, 707, 37, 'Jumlah Alat Praktik dan Peraga Peserta Didik Nonformal/ Kesetaraan
yang Tersedia', 'Paket', '', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (716, 704, 708, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', '1', '30000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (717, 705, 709, 37, 'Jumlah Ruang Unit Kesehatan Sekolah yang Telah Dibangun', 'Ruang', '', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (718, 706, 710, 37, 'Jumlah Taman Bacaan Masyarakat yang Telah Direhabilitasi sedang/berat', 'Ruang', '', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', '1', '75000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (719, 707, 711, 37, 'Jumlah Taman Bacaan
Masyarakat yang Telah Dibangun', 'Ruang', '', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (720, 708, 712, 37, 'Jumlah Ruang Guru/Kepala Sekolah/TU yang Telah Direhabilitasi
Sedang/Berat', 'Ruang', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (721, 709, 713, 37, 'Jumlah Ruang Kelas Sekolah yang Telah Direhabilitasi Sedang/Berat', 'Ruang', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (722, 710, 714, 37, 'Jumlah Dokumen Hasil Perhitungan dan Pemetaan Pendidik dan Tenaga Kependidikan Satuan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Dokumen', '12', '12', '27930000000.00', '12', '28930000000.00', '12', '28930000000.00', '12', '28930000000.00', '12', '28930000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (723, 711, 715, 37, 'Jumlah Laporan Hasil Pelaksanaan Penataan Pendistribusian Pendidik dan Tenaga Kependidikan Satuan Pendidikan Dasar, PAUD, dan Pendidikan Nonformal/Kesetaraan', 'Laporan', '12', '12', '674000000.00', '12', '674000000.00', '12', '674000000.00', '12', '674000000.00', '12', '674000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (724, 712, 716, 37, 'Jumlah Objek Pemajuan Kebudayaan yang Dilakukan Pelindungan,
Pengembangan, Pemanfaatan', 'Objek', '', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (725, 713, 717, 37, 'Jumlah Peserta Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Kebudayaan', 'Orang', '', '15', '350000000.00', '15', '350000000.00', '15', '350000000.00', '15', '350000000.00', '15', '350000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (726, 714, 718, 37, 'Jumlah PPKD Kabupaten/Kota yang Disusun, Dimutakhirkan
dan Ditetapkan', 'Dokumen', '', '5', '150000000.00', '5', '150000000.00', '5', '150000000.00', '5', '150000000.00', '5', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (727, 715, 719, 37, 'Jumlah Sumber Daya
Manusia Kebudayaan yang Dibina', 'Orang', '', '5', '150000000.00', '5', '150000000.00', '5', '150000000.00', '5', '150000000.00', '5', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (728, 716, 720, 37, 'Jumlah Lembaga dan Pranata Kebudayaan yang Dibina', 'Lembaga', '', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', '2', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (729, 717, 721, 37, 'Jumlah Objek Pemajuan Tradisi Budaya yang Dilakukan Pelindungan,
Pengembangan dan Pemanfaatan', 'Objek', '', '5', '100000000.00', '5', '100000000.00', '5', '100000000.00', '5', '100000000.00', '5', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (730, 718, 722, 37, 'Jumlah Laporan Pembinaan Sumber Daya Manusia, Lembaga, dan Pranata Tradisional', 'Laporan', '', '15', '50000000.00', '15', '50000000.00', '15', '50000000.00', '15', '50000000.00', '15', '50000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (731, 719, 723, 37, 'Jumlah Orang/Lembaga yang Diberi Penghargaan untuk Mereka yang Berjasa dalam Pemajuan Kebudayaan', 'Sertifikat', '', '150', '590000000.00', '150', '590000000.00', '150', '590000000.00', '150', '590000000.00', '150', '590000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (732, 720, 724, 37, 'Jumlah Objek Pemajuan Lembaga Adat yang Telah Dilakukan Pelindungan, Pengembangan dan
Pemanfaatan', 'Objek', '', '2', '35000000.00', '2', '35000000.00', '2', '35000000.00', '2', '35000000.00', '2', '35000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (733, 721, 725, 37, 'Jumlah Sumber Daya Manusia, Lembaga, dan Pranata Adat yang Dibina', 'Orang', '', '15', '300000000.00', '15', '300000000.00', '15', '300000000.00', '15', '300000000.00', '15', '300000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (734, 722, 726, 37, 'Jumlah Sarana dan Prasarana Lembaga Adat yang Disediakan/Difasilitasi', 'Unit', '', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (735, 723, 727, 37, 'Jumlah Sumber Daya Manusia Kesenian Tradisional yang Mendapat Pendidikan dan Pelatihan (Ditingkatkan
Kompetensinya)', 'Orang', '', '15', '250000000.00', '15', '250000000.00', '15', '250000000.00', '15', '250000000.00', '15', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (736, 724, 728, 37, 'Jumlah Sumber Daya Manusia Kesenian Tradisonal yang Mengikuti
Proses Standarisasi', 'Sertifikat', '', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (737, 725, 729, 37, 'Jumlah Lembaga Kesenian Tradisional yang Ditingkatkan Kapasitasnya', 'Lembaga', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (738, 726, 730, 37, 'Jumlah Sumber Daya Manusia dan Lembaga Sejarah Lokal Provinsi yang Diberdayakan', 'Orang', '', '15', '250000000.00', '15', '250000000.00', '15', '250000000.00', '15', '250000000.00', '15', '250000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (739, 727, 731, 37, 'Jumlah Sarana dan
Prasarana Pembinaan Sejarah', 'Unit', '', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (740, 728, 732, 37, 'Jumlah Dokumen Data dan Informasi Sejarah yang
Dapat Diakses Masyarakat', 'Dokumen', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (741, 729, 733, 37, 'Jumlah Objek Diduga
Cagar Budaya yang Didaftarkan', 'Objek', '', '1', '260000000.00', '1', '260000000.00', '1', '260000000.00', '1', '260000000.00', '1', '260000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (742, 730, 734, 37, 'Jumlah Objek Cagar
Budaya yang Ditetapkan', 'Objek', '', '1', '260000000.00', '1', '260000000.00', '1', '260000000.00', '1', '260000000.00', '1', '260000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (743, 731, 735, 37, 'Jumlah Warisan Budaya
Tak Benda yang Diusulkan', 'Objek', '', '1', '215000000.00', '1', '215000000.00', '1', '215000000.00', '1', '215000000.00', '1', '215000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (744, 732, 736, 37, 'Jumlah Objek Cagar Budaya yang Dilindungi', 'Objek', '', '2', '210000000.00', '2', '210000000.00', '2', '210000000.00', '2', '210000000.00', '2', '210000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (745, 733, 737, 37, 'Jumlah Objek Cagar Budaya yang
Dikembangkan', 'Objek', '', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', '1', '175000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (746, 734, 738, 37, 'Jumlah Objek Cagar Budaya yang
Dimanfaatkan', 'Objek', '', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (747, 735, 739, 37, 'Jumlah Cagar Budaya dan Objek Pemajuan Kebudayaan yang
Diinventarisasi', 'Objek', '', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', '1', '200000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (748, 736, 740, 37, 'Jumlah Objek Cagar Budaya yang Mendapatkan Perizinan ke Luar Daerah Provinsi', 'Objek', '', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', '1', '150000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (749, 737, 741, 37, 'Jumlah Laporan Hasil Evaluasi dan Pengawasan Cagar Budaya ke Luar
Daerah Provinsi', 'Laporan', '', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', '1', '100000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (750, 738, 742, 37, 'Jumlah Sarana dan Prasarana Museum yang Tersedia dan Terpelihara', 'Unit', '', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL),
  (751, 739, 743, 37, 'Jumlah Layanan
Operasional Museum', 'Layanan', '', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', '1', '5000000.00', 10, '2026-09-23 16:39:51', '2026-09-23 16:39:51', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
