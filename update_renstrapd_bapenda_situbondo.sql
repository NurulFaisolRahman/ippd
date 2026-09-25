-- ==============================================================================
-- SQL UPDATE & INSERT DATA RENSTRA PD
-- PERANGKAT DAERAH: BADAN PENDAPATAN DAERAH SITUBONDO
-- ID INSTANSI: 63 | KODE: 5.02.0.00.0.00.02.000
-- KABUPATEN SITUBONDO (KODE WILAYAH: 35.12)
-- TANGGAL EXPORT: 2026-09-24 15:53:23
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";

-- ------------------------------------------------------------------------------
-- 1. PASTIKAN AKUN INSTANSI (BADAN PENDAPATAN DAERAH SITUBONDO) TERSEDIA
-- ------------------------------------------------------------------------------

-- Table: akun_instansi (1 records)
INSERT INTO `akun_instansi` (`id`, `kode_instansi`, `kodewilayah`, `nama`, `urusan_id`, `bidang_urusan_id`, `idkementerian`, `password`, `Level`, `tahun_mulai`, `tahun_akhir`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (63, '5.02.0.00.0.00.02.000', '35.12', 'BADAN PENDAPATAN DAERAH SITUBONDO', '5.02', NULL, NULL, '$2y$10$gxDFjAOR1ShJFRVpvg6pcOAsUeO1d7j9nOJ71RONip65e5XxAob7y', 4, 2025, 2029, '2026-09-09 00:19:19', '2026-09-22 19:00:45', NULL)
ON DUPLICATE KEY UPDATE `kode_instansi` = VALUES(`kode_instansi`), `kodewilayah` = VALUES(`kodewilayah`), `nama` = VALUES(`nama`), `urusan_id` = VALUES(`urusan_id`), `bidang_urusan_id` = VALUES(`bidang_urusan_id`), `idkementerian` = VALUES(`idkementerian`), `password` = VALUES(`password`), `Level` = VALUES(`Level`), `tahun_mulai` = VALUES(`tahun_mulai`), `tahun_akhir` = VALUES(`tahun_akhir`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

-- ------------------------------------------------------------------------------
-- 2. BERSIHKAN DATA RENSTRA BADAN PENDAPATAN DAERAH SITUBONDO SEBELUMNYA (MENCEGAH DUPLIKAT)
-- ------------------------------------------------------------------------------
DELETE FROM `renstra_sub_kegiatan_indikator` WHERE `sub_kegiatan_id` IN (1737, 1738, 1739, 1740, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1752, 1753, 1754, 1755, 1756, 1757, 1758, 1759, 1760, 1761, 1762, 1763, 1764, 1765, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1775, 1776, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1795, 1796, 1797, 1798, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 1810, 1811, 1812, 1813, 1814, 1815, 1816, 1817, 1818, 1819, 1820, 1821, 1822, 1823, 1824, 1825, 1826, 1827, 1828, 1829, 1830, 1831, 1832, 1833, 1834);
DELETE FROM `renstra_sub_kegiatan_sasaran` WHERE `sub_kegiatan_id` IN (1737, 1738, 1739, 1740, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1752, 1753, 1754, 1755, 1756, 1757, 1758, 1759, 1760, 1761, 1762, 1763, 1764, 1765, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1775, 1776, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1795, 1796, 1797, 1798, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 1810, 1811, 1812, 1813, 1814, 1815, 1816, 1817, 1818, 1819, 1820, 1821, 1822, 1823, 1824, 1825, 1826, 1827, 1828, 1829, 1830, 1831, 1832, 1833, 1834);
DELETE FROM `renstra_sub_kegiatan` WHERE `kegiatan_id` IN (347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358);

DELETE FROM `renstra_kegiatan_indikator` WHERE `kegiatan_id` IN (347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358);
DELETE FROM `renstra_kegiatan_sasaran` WHERE `kegiatan_id` IN (347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358);
DELETE FROM `renstra_kegiatan` WHERE `program_id` IN (129, 130);

DELETE FROM `renstra_program_indikator` WHERE `program_id` IN (129, 130);
DELETE FROM `renstra_program_outcome` WHERE `program_id` IN (129, 130);
DELETE FROM `renstra_program` WHERE `sasaran_id` IN (71);

DELETE FROM `renstra_sasaran_indikator` WHERE `sasaran_id` IN (71);
DELETE FROM `renstra_sasaran` WHERE `tujuan_id` IN (26);

DELETE FROM `renstra_tujuan_indikator` WHERE `tujuan_id` IN (26);
DELETE FROM `renstra_tujuan` WHERE `id` IN (26) OR (`id_instansi` = 63 AND `kode_wilayah` = '35.12');

-- ------------------------------------------------------------------------------
-- 3. INSERT / REPLACE DATA HIERARKI RENSTRA PD BADAN PENDAPATAN DAERAH SITUBONDO
-- ------------------------------------------------------------------------------

-- Table: renstra_tujuan (1 records)
REPLACE INTO `renstra_tujuan` (`id`, `kode_wilayah`, `id_instansi`, `sasaran_rpjmd_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (26, '35.12', 63, '42', 'Meningkatnya Akuntabilitas Kinerja Pemerintah dan Profesionalitas ASN', NULL, NULL, 'Opini BPK Atas Laporan Keuangan', 'Predikat', NULL, 'WTP', 'WTP', 'WTP', 'WTP', 'WTP', '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_tujuan_indikator (1 records)
REPLACE INTO `renstra_tujuan_indikator` (`id`, `tujuan_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (41, 26, 63, 'Opini BPK Atas Laporan Keuangan', 'Predikat', 'WTP', NULL, 'WTP', 'WTP', 'WTP', 'WTP', 'WTP', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

-- Table: renstra_sasaran (1 records)
REPLACE INTO `renstra_sasaran` (`id`, `tujuan_id`, `uraian`, `bidang_id`, `bidang`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `created_at`, `updated_at`, `deleted_at`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (71, 26, 'Meningkatnya Penerimaan Pendapatan Asli Daerah (PAD)', NULL, NULL, 'Jumlah Peningkatan Realisasi PAD', 'Rp', NULL, '9000000000', '12000000000', '15000000000', '18000000000', '21000000000', '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Table: renstra_sasaran_indikator (1 records)
REPLACE INTO `renstra_sasaran_indikator` (`id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (111, 71, NULL, 'Jumlah Peningkatan Realisasi PAD', 'Rp', '', NULL, '9000000000', '12000000000', '15000000000', '18000000000', '21000000000', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

-- Table: renstra_program (2 records)
REPLACE INTO `renstra_program` (`id`, `sasaran_id`, `nama`, `kode_program`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran_rpjmd_id`, `outcome`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (129, 71, 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', '5.02.01', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, NULL, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah BAPENDA', 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', NULL, '86.25', '86.3', '86.35', '86.4', '86.45', NULL, '11870749468.00', '13147661415.00', '13389166856.00', '13865233542.00', '14906806896.00'),
  (130, 71, 'PROGRAM PENGELOLAAN PENDAPATAN DAERAH', '5.02.04', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, NULL, 'Meningkatnya implementasi elektronifikasi pembayaran pajak daerah dan retribusi daerah', 'Persentase implementasi elektronifikasi pembayaran pajak daerah dan retribusi
daerah', '%', NULL, '66.67', '75', '83.33', '91.67', '100', NULL, '9241042305.00', '8488234589.00', '11181661189.00', '12299827308.00', '11758253955.00');

-- Table: renstra_program_outcome (4 records)
REPLACE INTO `renstra_program_outcome` (`id`, `program_id`, `outcome_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (173, 129, 'Meningkatnya Capaian Nilai Sakip Perangkat Daerah BAPENDA', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (174, 130, 'Meningkatnya implementasi elektronifikasi pembayaran pajak daerah dan retribusi daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (175, 130, 'Meningkatnya Kualitas Pengawasan dan Pelaporan', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (176, 130, 'Meningkatnya Upaya Ekstensifikasi dan Intensifikasi Pendapatan', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

-- Table: renstra_program_indikator (4 records)
REPLACE INTO `renstra_program_indikator` (`id`, `program_id`, `outcome_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`, `created_at`, `updated_at`, `deleted_at`, `urutan`) VALUES
  (277, 129, 173, 63, 'Capaian Nilai SAKIP Perangkat Daerah', 'Nilai', '86.15', '86.25', '86.3', '86.35', '86.4', '86.45', '11870749468.00', '13147661415.00', '13389166856.00', '13865233542.00', '14906806896.00', '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 10),
  (278, 130, 174, 63, 'Persentase implementasi elektronifikasi pembayaran pajak daerah dan retribusi
daerah', '%', '', '66.67', '75', '83.33', '91.67', '100', '2501682472.00', '1074938773.00', '3027035791.00', '3329739370.00', '1891157223.00', '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 10),
  (279, 130, 175, 63, 'Persentase kepatuhan wajib pajak dan retribusi daerah %', '%', '70', '50', '51', '52', '53', '54', '730959833.00', '804055816.00', '884461398.00', '972907538.00', '1070198292.00', '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 10),
  (280, 130, 176, 63, 'Persentase PAD terhadap Pendapatan Daerah', 'Persentase', '', '14.8', '14.9', '15', '15.1', '15.2', '6008400000.00', '6609240000.00', '7270164000.00', '7997180400.00', '8796898440.00', '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 10);

-- Table: renstra_kegiatan (12 records)
REPLACE INTO `renstra_kegiatan` (`id`, `program_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (347, 129, 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', '5.02.01.2.01', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '173957100.00', '191352810.00', '210488091.00', '231536900.00', '254690590.00'),
  (348, 129, 'Administrasi Keuangan Perangkat Daerah', '5.02.01.2.02', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya dokumen administrasi keuangan perangkat daerah', 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Dokumen', NULL, '', '', '', '', '', NULL, '4589532368.00', '5048485605.00', '5553334165.00', '6108667582.00', '6719534340.00'),
  (349, 129, 'Administrasi Barang Milik Daerah pada Perangkat Daerah', '5.02.01.2.03', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Administrasi Barang Milik Daerah yang disusun', 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '33000000.00', '33800000.00', '34000000.00', '34500000.00', '34800000.00'),
  (350, 129, 'Administrasi Pendapatan Daerah Kewenangan Perangkat Daerah', '5.02.01.2.04', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Administrasi Pendapatan Daerah Kewenangan Perangkat Daerah', 'Jumlah Laporan Pengelolaan Retribusi Daerah', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (351, 129, 'Administrasi Kepegawaian Perangkat Daerah', '5.02.01.2.05', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Administrasi Kepegawaian Perangkat Daerah yang disusun', 'Jumlah Laporan Hasil Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', 'Laporan', NULL, '', '', '', '', '', NULL, '236000000.00', '186000000.00', '141000000.00', '171000000.00', '146000000.00'),
  (352, 129, 'Administrasi Umum Perangkat Daerah', '5.02.01.2.06', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Administrasi Umum yang disusun', 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '1493000000.00', '1324000000.00', '1237000000.00', '1325500000.00', '1309500000.00'),
  (353, 129, 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', '5.02.01.2.07', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 'Jumlah Unit Aset Tak Berwujud yang Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '600000000.00', '1390000000.00', '995000000.00', '535000000.00', '700000000.00'),
  (354, 129, 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', '5.02.01.2.08', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Laporan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang
Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '3285000000.00', '3395500000.00', '3445500000.00', '3506000000.00', '3556000000.00'),
  (355, 129, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '5.02.01.2.09', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '43', '40', '41', '42', '42', NULL, '1460260000.00', '1578523000.00', '1772844600.00', '1953029060.00', '2186281966.00'),
  (356, 130, 'Kegiatan Pengelolaan Pendapatan Daerah', '5.02.04.2.01', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersusunnya Dokumen Pengelolaan Pendapatan Daerah', 'Jumlah Dokumen Hasil Pelaksanaan Penagihan Pajak Daerah', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '2501682472.00', '1074938773.00', '3027035791.00', '3329739370.00', '1891157223.00'),
  (357, 130, 'Kegiatan Pengelolaan Pendapatan Daerah', '5.02.04.2.01', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersusunnya Dokumen Pengelolaan Pendapatan Daerah', 'Jumlah Laporan Pelaksanaan Penyuluhan dan Penyebarluasan Kebijakan Pajak Daerah', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '730959833.00', '804055816.00', '884461398.00', '972907538.00', '1070198292.00'),
  (358, 130, 'Kegiatan Pengelolaan Pendapatan Daerah', '5.02.04.2.01', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersusunnya Dokumen Pengelolaan Pendapatan Daerah', 'Jumlah Dokumen Hasil Analis Pajak Daerah serta Pengembangan Pajak Daerah dan Kebijakan Pajak Daerah', 'Dokumen', NULL, '2', '1', '1', '1', '1', NULL, '6008400000.00', '6609240000.00', '7270164000.00', '7997180400.00', '8796898440.00');

-- Table: renstra_kegiatan_sasaran (12 records)
REPLACE INTO `renstra_kegiatan_sasaran` (`id`, `kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (359, 347, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (360, 348, 'Tersedianya dokumen administrasi keuangan perangkat daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (361, 349, 'Tersedianya Dokumen Administrasi Barang Milik Daerah yang disusun', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (362, 350, 'Tersedianya Dokumen Administrasi Pendapatan Daerah Kewenangan Perangkat Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (363, 351, 'Tersedianya Dokumen Administrasi Kepegawaian Perangkat Daerah yang disusun', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (364, 352, 'Tersedianya Dokumen Administrasi Umum yang disusun', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (365, 353, 'Tersedianya Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (366, 354, 'Tersedianya Laporan Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (367, 355, 'Terlaksananya Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (368, 356, 'Tersusunnya Dokumen Pengelolaan Pendapatan Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (369, 357, 'Tersusunnya Dokumen Pengelolaan Pendapatan Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (370, 358, 'Tersusunnya Dokumen Pengelolaan Pendapatan Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

-- Table: renstra_kegiatan_indikator (98 records)
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1673, 347, 359, 63, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '173957100.00', '1', '191352810.00', '1', '210488091.00', '1', '231536900.00', '1', '254690590.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1674, 347, 359, 63, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja
SKPD', 'Laporan', '6', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1675, 347, 359, 63, 'Jumlah Laporan Evaluasi
Kinerja Perangkat Daerah', 'Laporan', '9', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', '7', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1676, 347, 359, 63, 'Jumlah Subtansi Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan
Pemerintahan Daerah yang Diampu', 'Substansi', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1677, 347, 359, 63, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1678, 347, 359, 63, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-
SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1679, 347, 359, 63, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen Perubahan DPA-SKPD', 'Dokumen', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1680, 347, 359, 63, 'Jumlah Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD yang disusun', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1681, 347, 359, 63, 'Jumlah Dokumen Perencanaan Perangkat
Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 90, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1682, 347, 359, 63, 'Jumlah Dokumen Hasil Penyelenggaraan Walidata Pendukung Statistik Sektoral Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 100, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1683, 347, 359, 63, 'Jumlah Berita Acara Hasil Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen
Perencanaan Perangkat Daerah', 'Berita Acara', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 110, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1684, 347, 359, 63, 'Jumlah Berita Acara Hasil Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui  Koordinasi Teknis
Pembangunan', 'Berita Acara', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 120, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1685, 347, 359, 63, 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa Lingkup Perangkat Daerah', 'Data', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 130, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1686, 348, 360, 63, 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Dokumen', '', '', '4589532368.00', '', '5048485605.00', '', '5553334165.00', '', '6108667582.00', '', '6719534340.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1687, 348, 360, 63, 'Jumlah Dokumen Penatausahaan dan
Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1688, 348, 360, 63, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan
Keuangan Akhir Tahun SKPD', 'Laporan', '5', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', '5', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1689, 348, 360, 63, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semester
an SKPD', 'Laporan', '24', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1690, 348, 360, 63, 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1691, 348, 360, 63, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '40', '40', '0.00', '40', '0.00', '40', '0.00', '40', '0.00', '40', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1692, 348, 360, 63, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1693, 348, 360, 63, 'Jumlah Dokumen Koordinasi dan Pelaksanaan Akuntansi SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1694, 349, 361, 63, 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', '12', '12', '33000000.00', '12', '33800000.00', '12', '34000000.00', '12', '34500000.00', '12', '34800000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1695, 349, 361, 63, 'Jumlah Dokumen Pengamanan Barang Milik Daerah SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1696, 349, 361, 63, 'Jumlah Dokumen Hasil Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1697, 349, 361, 63, 'Jumlah Laporan Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada
SKPD', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1698, 349, 361, 63, 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1699, 349, 361, 63, 'Jumlah Rencana Kebutuhan Barang Milik Daerah SKPD', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1700, 349, 361, 63, 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1701, 350, 362, 63, 'Jumlah Laporan Pengelolaan Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1702, 350, 362, 63, 'Jumlah Data Objek, Subjek dan Wajib Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1703, 350, 362, 63, 'Jumlah Dokumen Ketetapan Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1704, 350, 362, 63, 'Jumlah Dokumen Rencana Pengelolaan Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1705, 350, 362, 63, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi
Daerah', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1706, 350, 362, 63, 'Jumlah Laporan Hasil Penyuluhan dan Penyebarluasan Kebijakan
Retribusi Daerah', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1707, 351, 363, 63, 'Jumlah Laporan Hasil Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', 'Laporan', '', '', '236000000.00', '', '186000000.00', '', '141000000.00', '', '171000000.00', '', '146000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1708, 351, 363, 63, 'Jumlah ASN yang dipindahtugaskan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1709, 351, 363, 63, 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi
Kepegawaian', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1710, 351, 363, 63, 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1711, 351, 363, 63, 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi Kepegawaian', 'Dokumen', '12', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1712, 351, 363, 63, 'Jumlah Orang yang Mengikuti Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1713, 351, 363, 63, 'Jumlah Orang yang Mengikuti Sosialisasi Peraturan Perundang-Undangan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1714, 351, 363, 63, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '3', '3', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1715, 351, 363, 63, 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi yang Mengikuti Pendidikan dan
Pelatihan', 'Orang', '', '15', '0.00', '10', '0.00', '5', '0.00', '7', '0.00', '5', '0.00', 90, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1716, 351, 363, 63, 'Jumlah Pegawai Pensiun yang Dipulangkan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 100, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1717, 351, 363, 63, 'Jumlah Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 110, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1718, 352, 364, 63, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '12', '12', '1493000000.00', '12', '1324000000.00', '12', '1237000000.00', '12', '1325500000.00', '12', '1309500000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1719, 352, 364, 63, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', '24', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', '24', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1720, 352, 364, 63, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis
Elektronik pada SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1721, 352, 364, 63, 'Jumlah Dokumen Penatausahaan Arsip Dinamis pada SKPD', 'Dokumen', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1722, 352, 364, 63, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);
REPLACE INTO `renstra_kegiatan_indikator` (`id`, `kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1723, 352, 364, 63, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1724, 352, 364, 63, 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1725, 352, 364, 63, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', '6', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1726, 352, 364, 63, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan (Paket)', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 90, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1727, 352, 364, 63, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan (Paket)', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 100, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1728, 352, 364, 63, 'Jumlah Paket Bahan/Material yang Disediakan (Paket)', 'Paket', '1', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 110, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1729, 353, 365, 63, 'Jumlah Unit Aset Tak Berwujud yang Disediakan', 'Unit', '', '', '600000000.00', '', '1390000000.00', '', '995000000.00', '', '535000000.00', '', '700000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1730, 353, 365, 63, 'Jumlah Unit Aset Tetap
Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1731, 353, 365, 63, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1732, 353, 365, 63, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang Disediakan', 'Unit', '', '', '0.00', '1', '0.00', '', '0.00', '', '0.00', '', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1733, 353, 365, 63, 'Jumlah Unit Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan
yang Disediakan', 'Unit', '', '5', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', '1', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1734, 353, 365, 63, 'Jumlah Unit Peralatan dan Mesin Lainnya yang
Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1735, 353, 365, 63, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Disediakan', 'Unit', '11', '10', '0.00', '20', '0.00', '15', '0.00', '10', '0.00', '20', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1736, 353, 365, 63, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau
Bangunan Lainnya yang Disediakan', 'Unit', '', '5', '0.00', '25', '0.00', '15', '0.00', '10', '0.00', '15', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1737, 353, 365, 63, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '5', '8', '0.00', '10', '0.00', '30', '0.00', '10', '0.00', '20', '0.00', 90, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1738, 353, 365, 63, 'Jumlah Unit Alat Besar yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 100, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1739, 353, 365, 63, 'Jumlah Unit Alat Angkutan Darat Tak Bermotor yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 110, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1740, 354, 366, 63, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik yang
Disediakan', 'Laporan', '12', '12', '3285000000.00', '12', '3395500000.00', '12', '3445500000.00', '12', '3506000000.00', '12', '3556000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1741, 354, 366, 63, 'Jumlah Laporan Penyediaan Jasa Surat Menyurat', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1742, 354, 366, 63, 'Jumlah Laporan Penyediaan Jasa Peralatan dan
Perlengkapan Kantor yang Disediakan', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1743, 354, 366, 63, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', '12', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1744, 355, 367, 63, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan dibayarkan Pajak dan Perizinannya', 'Unit', '28', '43', '1460260000.00', '40', '1578523000.00', '41', '1772844600.00', '42', '1953029060.00', '42', '2186281966.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1745, 355, 367, 63, 'Luas Tanah yang Dilakukan Pemeliharaan/Rehabilitasi', 'Ha', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1746, 355, 367, 63, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '1', '0.00', '2', '0.00', '1', '0.00', '2', '0.00', '1', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1747, 355, 367, 63, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '186', '45', '0.00', '49', '0.00', '49', '0.00', '50', '0.00', '50', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1748, 355, 367, 63, 'Jumlah Peralatan dan Mesin
Lainnya yang Dipelihara', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1749, 355, 367, 63, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '10', '0.00', '20', '0.00', '10', '0.00', '15', '0.00', '10', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1750, 355, 367, 63, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan
yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1751, 355, 367, 63, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '4', '2', '0.00', '2', '0.00', '3', '0.00', '2', '0.00', '3', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1752, 355, 367, 63, 'Jumlah Aset Tetap Lainnya yang Dipelihara', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 90, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1753, 355, 367, 63, 'Jumlah Aset Tak Berwujud yang Dipelihara  (Unit)', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 100, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1754, 355, 367, 63, 'Jumlah Alat Besar yang Dipelihara dan dibayarkan
Perizinannya (Unit)', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 110, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1755, 355, 367, 63, 'Jumlah Alat Angkutan Darat Tak Bermotor yang Dipelihara dan Dibayarkan Perizinannya
(Unit)', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 120, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1756, 356, 368, 63, 'Jumlah Dokumen Hasil Pelaksanaan Penagihan Pajak Daerah', 'Dokumen', '12', '12', '2501682472.00', '12', '1074938773.00', '12', '3027035791.00', '12', '3329739370.00', '12', '1891157223.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1757, 356, 368, 63, 'Jumlah Laporan Perkembangan Elektronifikasi Transaksi Pemerintah Daerah', 'Laporan', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1758, 357, 369, 63, 'Jumlah Laporan Pelaksanaan Penyuluhan dan Penyebarluasan Kebijakan Pajak Daerah', 'Laporan', '1', '3', '730959833.00', '3', '804055816.00', '3', '884461398.00', '3', '972907538.00', '3', '1070198292.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1759, 357, 369, 63, 'Jumlah Laporan Hasil Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 'Laporan', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1760, 357, 369, 63, 'Jumlah Dokumen Hasil Penyelesaian Keberatan Pajak Daerah', 'Dokumen', '12', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', '10', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1761, 357, 369, 63, 'Jumlah Dokumen Hasil Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1762, 357, 369, 63, 'Jumlah Data Pelaporan Pajak Daerah yang Telah Dilakukan Penelitian dan Verifikasi', 'Dokumen', '48', '48', '0.00', '48', '0.00', '48', '0.00', '48', '0.00', '48', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1763, 358, 370, 63, 'Jumlah Dokumen Hasil Analis Pajak Daerah serta Pengembangan Pajak Daerah dan Kebijakan Pajak Daerah', 'Dokumen', '', '2', '6008400000.00', '1', '6609240000.00', '1', '7270164000.00', '1', '7997180400.00', '1', '8796898440.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1764, 358, 370, 63, 'Jumlah Dokumen Rencana Pengelolaan Pajak Daerah', 'Dokumen', '2', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 20, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1765, 358, 370, 63, 'Jumlah Laporan Hasil Pendataan dan Pendaftaran Objek Pajak Daerah, Subjek Pajak dan Wajib Pajak Daerah', 'Laporan', '4', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 30, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1766, 358, 370, 63, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Basis Data
Pajak Daerah', 'Laporan', '', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', '4', '0.00', 40, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1767, 358, 370, 63, 'Jumlah Layanan dan Konsultasi Pajak Daerah', 'Layanan', '', '120', '0.00', '120', '0.00', '120', '0.00', '120', '0.00', '120', '0.00', 50, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1768, 358, 370, 63, 'Jumlah Objek Pajak yang Disesuaikan NJOP nya', 'Obyek Pajak', '', '202452', '0.00', '202452', '0.00', '202452', '0.00', '202452', '0.00', '202452', '0.00', 60, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1769, 358, 370, 63, 'Jumlah Sarana dan Prasarana
Pengelolaan Pajak Daerah', 'Unit', '', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', '2', '0.00', 70, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1770, 358, 370, 63, 'Jumlah Dokumen Ketetapan Pajak Daerah', 'Dokumen', '239897', '221118', '0.00', '221118', '0.00', '221200', '0.00', '221200', '0.00', '221210', '0.00', 80, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

-- Table: renstra_sub_kegiatan (98 records)
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1737, 347, 'Penyusunan Dokumen Perencanaan Perangkat Daerah', '5.02.01.2.01.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '34500000.00', '37950000.00', '41745000.00', '45919500.00', '50511450.00'),
  (1738, 347, 'Koordinasi dan Penyusunan Dokumen RKA-SKPD', '5.02.01.2.01.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '7200000.00', '7920000.00', '8712000.00', '9583200.00', '10541520.00'),
  (1739, 347, 'Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '5.02.01.2.01.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen Perubahan RKA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '7200000.00', '7920000.00', '8712000.00', '9583200.00', '10541520.00'),
  (1740, 347, 'Koordinasi dan Penyusunan DPA-SKPD', '5.02.01.2.01.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '6700000.00', '7370000.00', '8107000.00', '8917700.00', '9809470.00'),
  (1741, 347, 'Koordinasi dan Penyusunan Perubahan DPA- SKPD', '5.02.01.2.01.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', NULL, '1', '1', '1', '1', '1', NULL, '6700000.00', '7370000.00', '8107000.00', '8917700.00', '9809470.00'),
  (1742, 347, 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '5.02.01.2.01.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja
SKPD', 'Laporan', NULL, '6', '6', '6', '6', '6', NULL, '49500000.00', '54450000.00', '59895000.00', '65884500.00', '72472950.00'),
  (1743, 347, 'Evaluasi Kinerja Perangkat Daerah', '5.02.01.2.01.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 'Jumlah Laporan Evaluasi
Kinerja Perangkat Daerah', 'Laporan', NULL, '7', '7', '7', '7', '7', NULL, '62157100.00', '68372810.00', '75210091.00', '82731100.00', '91004210.00'),
  (1744, 347, 'Penyelenggaraan Walidata Pendukung Statistik Sektoral Daerah', '5.02.01.2.01.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terselenggaranya Walidata Pendukung Statistik Sektoral Daerah', 'Jumlah Dokumen Hasil Penyelenggaraan Walidata Pendukung Statistik Sektoral Daerah', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1745, 347, 'Pelaksanaan Pengumpulan Data Statistik Sektoral Daerah', '5.02.01.2.01.0009', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pengumpulan Data Statistik Sektoral Daerah', 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa
Lingkup Perangkat Daerah', 'Data', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1746, 347, 'Pelaksanaan Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', '5.02.01.2.01.0010', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', 'Jumlah Berita Acara Hasil Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', 'Berita Acara', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1747, 347, 'Penyusunan Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', '5.02.01.2.01.0011', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersusunnya Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', 'Jumlah Dokumen Perencanaan Urusan Selain
Renstra PD dan Renja PD yang disusun', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1748, 347, 'Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', '5.02.01.2.01.0012', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terkoordinasikannya Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 'Jumlah Subtansi Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 'Substansi', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1749, 347, 'Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui Koordinasi Teknis Pembangunan', '5.02.01.2.01.0013', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tercapainya Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui Koordinasi Teknis Pembangunan', 'Jumlah Berita Acara Hasil Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional
melalui  Koordinasi Teknis Pembangunan', 'Berita Acara', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1750, 348, 'Penyediaan Gaji dan Tunjangan ASN', '5.02.01.2.02.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Gaji dan Tunjangan ASN', 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', NULL, '40', '40', '40', '40', '40', NULL, '4282932368.00', '4711225605.00', '5182348165.00', '5700582982.00', '6270641280.00'),
  (1751, 348, 'Penyediaan Administrasi Pelaksanaan Tugas ASN', '5.02.01.2.02.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '210600000.00', '231660000.00', '254826000.00', '280308600.00', '308339460.00'),
  (1752, 348, 'Pelaksanaan Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', '5.02.01.2.02.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 'Jumlah Dokumen Penatausahaan dan
Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1753, 348, 'Koordinasi dan Pelaksanaan Akuntansi SKPD', '5.02.01.2.02.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Koordinasi dan Pelaksanaan Akuntansi SKPD', 'Jumlah Dokumen Koordinasi dan Pelaksanaan Akuntansi SKPD', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1754, 348, 'Koordinasi dan Penyusunan Laporan Keuangan Akhir Tahun SKPD', '5.02.01.2.02.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', NULL, '5', '5', '5', '5', '5', NULL, '36000000.00', '39600000.00', '43560000.00', '47916000.00', '52707600.00'),
  (1755, 348, 'Pengelolaan dan Penyiapan Bahan Tanggapan Pemeriksaan', '5.02.01.2.02.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '15000000.00', '16500000.00', '18150000.00', '19965000.00', '21961500.00'),
  (1756, 348, 'Koordinasi dan Penyusunan Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD', '5.02.01.2.02.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semester an SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semester an SKPD', 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semester
an SKPD', 'Laporan', NULL, '24', '24', '24', '24', '24', NULL, '45000000.00', '49500000.00', '54450000.00', '59895000.00', '65884500.00'),
  (1757, 348, 'Penyusunan Pelaporan dan Analisis Prognosis Realisasi Anggaran', '5.02.01.2.02.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1758, 349, 'Penyusunan Perencanaan Kebutuhan Barang Milik Daerah SKPD', '5.02.01.2.03.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Rencana Kebutuhan Barang Milik Daerah SKPD', 'Jumlah Rencana Kebutuhan Barang Milik Daerah SKPD', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '3000000.00', '3500000.00', '3500000.00', '4000000.00', '4000000.00'),
  (1759, 349, 'Pengamanan Barang Milik Daerah SKPD', '5.02.01.2.03.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pengamanan Barang Milik Daerah SKPD', 'Jumlah Dokumen Pengamanan Barang Milik Daerah SKPD', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1760, 349, 'Koordinasi dan Penilaian Barang Milik Daerah SKPD', '5.02.01.2.03.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1761, 349, 'Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', '5.02.01.2.03.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '12000000.00', '12100000.00', '12200000.00', '12200000.00', '12300000.00'),
  (1762, 349, 'Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', '5.02.01.2.03.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada
SKPD', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1763, 349, 'Penatausahaan Barang Milik Daerah pada SKPD', '5.02.01.2.03.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '18000000.00', '18200000.00', '18300000.00', '18300000.00', '18500000.00'),
  (1764, 349, 'Pemanfaatan Barang Milik Daerah SKPD', '5.02.01.2.03.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemanfaatan Barang Milik Daerah SKPD', 'Jumlah Dokumen Hasil Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1765, 350, 'Perencanaan Pengelolaan Retribusi Daerah', '5.02.01.2.04.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Rencana Pengelolaan Retribusi Daerah', 'Jumlah Dokumen Rencana Pengelolaan Retribusi Daerah', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1766, 350, 'Penyuluhan dan Penyebarluasan Kebijakan Retribusi Daerah', '5.02.01.2.04.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penyuluhan dan Penyebarluasan Kebijakan Retribusi Daerah', 'Jumlah Laporan Hasil Penyuluhan dan Penyebarluasan Kebijakan
Retribusi Daerah', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1767, 350, 'Pendataan dan Pendaftaran Objek Retribusi Daerah', '5.02.01.2.04.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Data Objek, Subjek dan Wajib Retribusi Daerah', 'Jumlah Data Objek, Subjek
dan Wajib Retribusi Daerah', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1768, 350, 'Pengolahan Data Retribusi Daerah', '5.02.01.2.04.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi Daerah', 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi
Daerah', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1769, 350, 'Penetapan Wajib Retribusi Daerah', '5.02.01.2.04.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Ketetapan Retribusi Daerah', 'Jumlah Dokumen Ketetapan Retribusi Daerah', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1770, 350, 'Pelaporan Pengelolaan Retribusi Daerah', '5.02.01.2.04.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Laporan Pengelolaan Retribusi Daerah', 'Jumlah Laporan Pengelolaan Retribusi Daerah', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1771, 351, 'Peningkatan Sarana dan Prasarana Disiplin Pegawai', '5.02.01.2.05.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Jumlah Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1772, 351, 'Pengadaan Pakaian Dinas beserta Atribut Kelengkapannya', '5.02.01.2.05.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', NULL, '3', '2', '2', '2', '2', NULL, '75000000.00', '75000000.00', '80000000.00', '85000000.00', '85000000.00'),
  (1773, 351, 'Pendataan dan Pengolahan Administrasi Kepegawaian', '5.02.01.2.05.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi Kepegawaian', 'Dokumen', NULL, '24', '24', '24', '24', '24', NULL, '11000000.00', '11000000.00', '11000000.00', '11000000.00', '11000000.00'),
  (1774, 351, 'Koordinasi dan Pelaksanaan Sistem Informasi Kepegawaian', '5.02.01.2.05.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Koordinasi dan Pelaksanaan Sistem Informasi Kepegawaian', 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi
Kepegawaian', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1775, 351, 'Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', '5.02.01.2.05.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1776, 351, 'Pemulangan Pegawai yang Pensiun', '5.02.01.2.05.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemulangan Pegawai yang Pensiun', 'Jumlah Pegawai Pensiun yang Dipulangkan', 'Orang', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1777, 351, 'Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', '5.02.01.2.05.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', 'Jumlah Laporan Hasil Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1778, 351, 'Pemindahan Tugas ASN', '5.02.01.2.05.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemindahan Tugas ASN', 'Jumlah ASN yang dipindahtugaskan', 'Orang', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1779, 351, 'Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', '5.02.01.2.05.0009', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi yang Mengikuti Pendidikan dan
Pelatihan', 'Orang', NULL, '15', '10', '5', '7', '5', NULL, '150000000.00', '100000000.00', '50000000.00', '75000000.00', '50000000.00'),
  (1780, 351, 'Sosialisasi Peraturan Perundang-Undangan', '5.02.01.2.05.0010', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Sosialisasi Peraturan Perundang-Undangan', 'Jumlah Orang yang Mengikuti Sosialisasi Peraturan Perundang-Undangan', 'Orang', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1781, 351, 'Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', '5.02.01.2.05.0011', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 'Jumlah Orang yang Mengikuti Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 'orang', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1782, 352, 'Penyediaan Komponen Instalasi Listrik/Penerangan Bangunan Kantor', '5.02.01.2.06.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '32000000.00', '34000000.00', '35000000.00', '35000000.00'),
  (1783, 352, 'Penyediaan Peralatan dan Perlengkapan Kantor', '5.02.01.2.06.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Peralatan dan Perlengkapan Kantor', 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', NULL, '6', '6', '6', '6', '6', NULL, '515000000.00', '250000000.00', '150000000.00', '200000000.00', '150000000.00'),
  (1784, 352, 'Penyediaan Peralatan Rumah Tangga', '5.02.01.2.06.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Peralatan Rumah Tangga', 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '210000000.00', '250000000.00', '250000000.00', '275000000.00', '275000000.00'),
  (1785, 352, 'Penyediaan Bahan Logistik Kantor', '5.02.01.2.06.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Bahan Logistik Kantor', 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '35000000.00', '35000000.00', '35000000.00', '37000000.00', '39000000.00'),
  (1786, 352, 'Penyediaan Barang Cetakan dan Penggandaan', '5.02.01.2.06.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Barang Cetakan dan Penggandaan', 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '30000000.00', '32000000.00', '33000000.00', '35000000.00', '37000000.00');
REPLACE INTO `renstra_sub_kegiatan` (`id`, `kegiatan_id`, `nama`, `kode_nomenklatur`, `bidang_id`, `created_at`, `updated_at`, `deleted_at`, `sasaran`, `indikator`, `satuan`, `target_2025`, `target_2026`, `target_2027`, `target_2028`, `target_2029`, `target_2030`, `anggaran_2025`, `anggaran_2026`, `anggaran_2027`, `anggaran_2028`, `anggaran_2029`, `anggaran_2030`) VALUES
  (1787, 352, 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan', '5.02.01.2.06.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', NULL, '24', '24', '24', '24', '24', NULL, '10000000.00', '12000000.00', '12000000.00', '15000000.00', '15000000.00'),
  (1788, 352, 'Penyediaan Bahan/Material', '5.02.01.2.06.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Bahan/Material', 'Jumlah Paket Bahan/Material yang Disediakan', 'Paket', NULL, '1', '1', '1', '1', '1', NULL, '350000000.00', '400000000.00', '400000000.00', '400000000.00', '420000000.00'),
  (1789, 352, 'Fasilitasi Kunjungan Tamu', '5.02.01.2.06.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Fasilitasi Kunjungan Tamu', 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '50000000.00', '50000000.00', '50000000.00', '55000000.00', '55000000.00'),
  (1790, 352, 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', '5.02.01.2.06.0009', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '250000000.00', '250000000.00', '260000000.00', '260000000.00', '270000000.00'),
  (1791, 352, 'Penatausahaan Arsip Dinamis pada SKPD', '5.02.01.2.06.0010', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penatausahaan Arsip Dinamis pada SKPD', 'Jumlah Dokumen Penatausahaan Arsip Dinamis pada SKPD', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '13000000.00', '13000000.00', '13000000.00', '13500000.00', '13500000.00'),
  (1792, 352, 'Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', '5.02.01.2.06.0011', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1793, 353, 'Pengadaan Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '5.02.01.2.07.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Unit Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan
yang Disediakan', 'Unit', NULL, '5', '1', '1', '1', '1', NULL, '300000000.00', '450000000.00', '600000000.00', '300000000.00', '350000000.00'),
  (1794, 353, 'Pengadaan Kendaraan Dinas Operasional atau Lapangan', '5.02.01.2.07.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang Disediakan', 'Unit', NULL, '', '1', '', '', '', NULL, '0.00', '500000000.00', '0.00', '0.00', '0.00'),
  (1795, 353, 'Pengadaan Alat Besar', '5.02.01.2.07.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Alat Besar', 'Jumlah Unit Alat Besar yang Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1796, 353, 'Pengadaan Alat Angkutan Darat Tak Bermotor', '5.02.01.2.07.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Alat Angkutan Darat Tak Bermotor', 'Jumlah Unit Alat Angkutan Darat Tak Bermotor yang Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1797, 353, 'Pengadaan Mebel', '5.02.01.2.07.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Mebel', 'Jumlah Paket Mebel yang Disediakan', 'Unit', NULL, '8', '10', '30', '10', '20', NULL, '50000000.00', '65000000.00', '45000000.00', '35000000.00', '50000000.00'),
  (1798, 353, 'Pengadaan Peralatan dan Mesin Lainnya', '5.02.01.2.07.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Peralatan dan Mesin Lainnya', 'Jumlah Unit Peralatan dan Mesin Lainnya yang
Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1799, 353, 'Pengadaan Aset Tetap Lainnya', '5.02.01.2.07.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Aset Tetap Lainnya', 'Jumlah Unit Aset Tetap Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1800, 353, 'Pengadaan Aset Tak Berwujud', '5.02.01.2.07.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Aset Tak Berwujud', 'Jumlah Unit Aset Tak
Berwujud yang Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1801, 353, 'Pengadaan Gedung Kantor atau Bangunan Lainnya', '5.02.01.2.07.0009', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1802, 353, 'Pengadaan Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '5.02.01.2.07.0010', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Disediakan', 'Unit', NULL, '10', '20', '15', '10', '20', NULL, '150000000.00', '200000000.00', '200000000.00', '100000000.00', '150000000.00'),
  (1803, 353, 'Pengadaan Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '5.02.01.2.07.0011', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', NULL, '5', '25', '15', '10', '15', NULL, '100000000.00', '175000000.00', '150000000.00', '100000000.00', '150000000.00'),
  (1804, 354, 'Penyediaan Jasa Surat Menyurat', '5.02.01.2.08.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 'Jumlah Laporan Penyediaan
Jasa Surat Menyurat', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '5000000.00', '5500000.00', '5500000.00', '6000000.00', '6000000.00'),
  (1805, 354, 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik', '5.02.01.2.08.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber
Daya Air dan Listrik yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '1200000000.00', '1300000000.00', '1350000000.00', '1400000000.00', '1450000000.00'),
  (1806, 354, 'Penyediaan Jasa Peralatan dan Perlengkapan Kantor', '5.02.01.2.08.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang
Disediakan', 'Laporan', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1807, 354, 'Penyediaan Jasa Pelayanan Umum Kantor', '5.02.01.2.08.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Pelayanan Umum Kantor', 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', NULL, '12', '12', '12', '12', '12', NULL, '2080000000.00', '2090000000.00', '2090000000.00', '2100000000.00', '2100000000.00'),
  (1808, 355, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', '5.02.01.2.09.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1809, 355, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', '5.02.01.2.09.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan
dibayarkan Pajak dan Perizinannya', 'Unit', NULL, '43', '40', '41', '42', '42', NULL, '350000000.00', '385000000.00', '423500000.00', '465850000.00', '512435000.00'),
  (1810, 355, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan dan Perizinan Alat Besar', '5.02.01.2.09.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Perizinan Alat Besar', 'Jumlah Alat Besar yang Dipelihara dan dibayarkan Perizinannya', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1811, 355, 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan dan Perizinan Alat Angkutan Darat Tak Bermotor', '5.02.01.2.09.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Perizinan Alat Angkutan Darat Tak Bermotor', 'Jumlah Alat Angkutan Darat Tak Bermotor yang Dipelihara dan Dibayarkan Perizinannya', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1812, 355, 'Pemeliharaan Mebel', '5.02.01.2.09.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan Mebel', 'Jumlah Mebel yang Dipelihara', 'Unit', NULL, '10', '20', '10', '15', '10', NULL, '5000000.00', '5500000.00', '6050000.00', '6655000.00', '7320500.00'),
  (1813, 355, 'Pemeliharaan Peralatan dan Mesin Lainnya', '5.02.01.2.09.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 'Jumlah Peralatan dan Mesin
Lainnya yang Dipelihara', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1814, 355, 'Pemeliharaan Aset Tetap Lainnya', '5.02.01.2.09.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan Aset Tetap Lainnya', 'Jumlah Aset Tetap Lainnya yang Dipelihara', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1815, 355, 'Pemeliharaan Aset Tak Berwujud', '5.02.01.2.09.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan Aset Tak Berwujud', 'Jumlah Aset Tak Berwujud yang Dipelihara', 'Unit', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1816, 355, 'Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', '5.02.01.2.09.0009', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '2', '2', '3', '2', '3', NULL, '200000000.00', '220000000.00', '242000000.00', '266200000.00', '292820000.00'),
  (1817, 355, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', '5.02.01.2.09.0010', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '45', '49', '49', '50', '50', NULL, '350000000.00', '385000000.00', '423500000.00', '465850000.00', '512435000.00'),
  (1818, 355, 'Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', '5.02.01.2.09.0011', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', NULL, '1', '2', '1', '2', '1', NULL, '555260000.00', '583023000.00', '677794600.00', '748474060.00', '861271466.00'),
  (1819, 355, 'Pemeliharaan/Rehabilitasi Tanah', '5.02.01.2.09.0012', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pemeliharaan/Rehabilitasi Tanah', 'Luas Tanah yang Dilakukan Pemeliharaan/Rehabilitasi', 'Ha', NULL, '', '', '', '', '', NULL, '0.00', '0.00', '0.00', '0.00', '0.00'),
  (1820, 356, 'Penagihan Pajak Daerah', '5.02.04.2.01.0011', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penagihan Pajak Daerah', 'Jumlah Dokumen Hasil Pelaksanaan Penagihan Pajak Daerah', 'Dokumen', NULL, '12', '12', '12', '12', '12', NULL, '2408422669.00', '972352990.00', '2914191429.00', '3205610572.00', '1754615545.00'),
  (1821, 356, 'Elektronifikasi Transaksi Pemerintah Daerah', '5.02.04.2.01.0015', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Upaya Mengubah Transaksi Tunai Menjadi Non Tunai', 'Jumlah Laporan Perkembangan Elektronifikasi
Transaksi Pemerintah Daerah', 'Laporan', NULL, '2', '2', '2', '2', '2', NULL, '93259803.00', '102585783.00', '112844362.00', '124128798.00', '136541678.00'),
  (1822, 357, 'Penyuluhan dan Penyebarluasan Kebijakan Pajak Daerah', '5.02.04.2.01.0003', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penyuluhan dan Penyebarluasan Kebijakan Pajak Daerah', 'Jumlah Laporan Pelaksanaan Penyuluhan dan Penyebarluasan Kebijakan
Pajak Daerah', 'Laporan', NULL, '3', '3', '3', '3', '3', NULL, '164783813.00', '181262194.00', '199388414.00', '219327255.00', '241259981.00'),
  (1823, 357, 'Penelitian dan Verifikasi Data Pelaporan Pajak Daerah', '5.02.04.2.01.0010', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penelitian dan Verifikasi Data Pelaporan Pajak Daerah', 'Jumlah Data Pelaporan Pajak Daerah yang Telah Dilakukan Penelitian dan Verifikasi', 'Dokumen', NULL, '48', '48', '48', '48', '48', NULL, '190024710.00', '209027181.00', '229929899.00', '252922889.00', '278215178.00'),
  (1824, 357, 'Penyelesaian Keberatan Pajak Daerah', '5.02.04.2.01.0012', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Penyelesaian Keberatan Pajak Daerah', 'Jumlah Dokumen Hasil Penyelesaian Keberatan Pajak Daerah', 'Dokumen', NULL, '10', '10', '10', '10', '10', NULL, '50000000.00', '55000000.00', '60500000.00', '66550000.00', '73205000.00'),
  (1825, 357, 'Pengendalian, Pemeriksaan dan Pengawasan Pajak Daerah', '5.02.04.2.01.0013', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksanannya Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 'Jumlah Dokumen Hasil Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '216151310.00', '237766441.00', '261543085.00', '287697394.00', '316467133.00'),
  (1826, 357, 'Pembinaan dan Pengawasan Pengelolaan Pajak Daerah dan Retribusi Daerah', '5.02.04.2.01.0014', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 'Jumlah Laporan Hasil Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '110000000.00', '121000000.00', '133100000.00', '146410000.00', '161051000.00'),
  (1827, 358, 'Perencanaan Pengelolaan Pajak Daerah', '5.02.04.2.01.0001', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Rencana Pengelolaan Pajak Daerah', 'Jumlah Dokumen Rencana Pengelolaan Pajak Daerah', 'Dokumen', NULL, '2', '2', '2', '2', '2', NULL, '130000000.00', '143000000.00', '157300000.00', '173030000.00', '190333000.00'),
  (1828, 358, 'Analisa dan Pengembangan Pajak Daerah, serta Penyusunan Kebijakan Pajak Daerah', '5.02.04.2.01.0002', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Hasil Analis Pajak Daerah serta Terlaksananya Pengembangan Pajak Daerah dan Kebijakan Pajak Daerah', 'Jumlah Dokumen Hasil Analis Pajak Daerah serta Pengembangan Pajak Daerah dan Kebijakan Pajak Daerah', 'Dokumen', NULL, '2', '1', '1', '1', '1', NULL, '275000000.00', '302500000.00', '332750000.00', '366025000.00', '402627500.00'),
  (1829, 358, 'Penyediaan Sarana dan Prasarana Pengelolaan Pajak Daerah', '5.02.04.2.01.0004', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Sarana dan Prasarana Pengelolaan Pajak Daerah', 'Jumlah Sarana dan Prasarana Pengelolaan Pajak Daerah', 'Unit', NULL, '2', '2', '2', '2', '2', NULL, '150000000.00', '165000000.00', '181500000.00', '199650000.00', '219615000.00'),
  (1830, 358, 'Pendataan dan Pendaftaran Objek Pajak Daerah', '5.02.04.2.01.0005', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Data Objek Pajak, Subjek Pajak dan Wajib Pajak Daerah', 'Jumlah Laporan Hasil Pendataan dan Pendaftaran Objek Pajak Daerah, Subjek Pajak dan Wajib Pajak Daerah', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '4130000000.00', '4543000000.00', '4997300000.00', '5497030000.00', '6046733000.00'),
  (1831, 358, 'Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', '5.02.04.2.01.0006', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', 'Laporan', NULL, '4', '4', '4', '4', '4', NULL, '300000000.00', '330000000.00', '363000000.00', '399300000.00', '439230000.00'),
  (1832, 358, 'Penilaian Pajak Bumi dan Bangunan Perdesaan dan Perkotaan (PBBP2) serta Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB)', '5.02.04.2.01.0007', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Terpenuhinya Jumlah Objek Pajak yang Disesuaikan NJOP nya', 'Jumlah Objek Pajak yang Disesuaikan NJOP nya', 'Obyek Pajak', NULL, '202452', '202452', '202452', '202452', '202452', NULL, '600000000.00', '660000000.00', '726000000.00', '798600000.00', '878460000.00'),
  (1833, 358, 'Penetapan Wajib Pajak Daerah', '5.02.04.2.01.0008', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Dokumen Ketetapan Pajak Daerah', 'Jumlah Dokumen Ketetapan Pajak Daerah', 'Dokumen', NULL, '221118', '221118', '221200', '221200', '221210', NULL, '348400000.00', '383240000.00', '421564000.00', '463720400.00', '510092440.00'),
  (1834, 358, 'Pelayanan dan Konsultasi Pajak Daerah', '5.02.04.2.01.0009', NULL, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL, 'Tersedianya Layanan dan Konsultasi Pajak Daerah', 'Jumlah Layanan dan
Konsultasi Pajak Daerah Layanan', 'Layanan', NULL, '120', '120', '120', '120', '120', NULL, '75000000.00', '82500000.00', '90750000.00', '99825000.00', '109807500.00');

-- Table: renstra_sub_kegiatan_sasaran (98 records)
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1765, 1737, 'Tersusunnya Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1766, 1738, 'Tersedianya Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1767, 1739, 'Tersedianya Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan RKA-SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1768, 1740, 'Tersedianya Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1769, 1741, 'Tersedianya Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1770, 1742, 'Tersedianya Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1771, 1743, 'Terlaksananya Evaluasi Kinerja Perangkat Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1772, 1744, 'Terselenggaranya Walidata Pendukung Statistik Sektoral Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1773, 1745, 'Terlaksananya Pengumpulan Data Statistik Sektoral Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1774, 1746, 'Terlaksananya Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1775, 1747, 'Tersusunnya Dokumen Perencanaan Urusan Selain Renstra PD dan Renja PD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1776, 1748, 'Terkoordinasikannya Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1777, 1749, 'Tercapainya Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional melalui Koordinasi Teknis Pembangunan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1778, 1750, 'Tersedianya Gaji dan Tunjangan ASN', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1779, 1751, 'Tersedianya Administrasi Pelaksanaan Tugas ASN', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1780, 1752, 'Terlaksananya Penatausahaan dan Pengujian/Verifikasi Keuangan SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1781, 1753, 'Terlaksananya Koordinasi dan Pelaksanaan Akuntansi SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1782, 1754, 'Tersedianya Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1783, 1755, 'Tersedianya Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1784, 1756, 'Tersedianya Laporan Keuangan Bulanan/Triwulanan/Semester an SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semester an SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1785, 1757, 'Tersedianya Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1786, 1758, 'Tersedianya Rencana Kebutuhan Barang Milik Daerah SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1787, 1759, 'Terlaksananya Pengamanan Barang Milik Daerah SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1788, 1760, 'Tersedianya Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1789, 1761, 'Terlaksananya Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1790, 1762, 'Terlaksananya Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1791, 1763, 'Terlaksananya Penatausahaan Barang Milik Daerah pada SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1792, 1764, 'Terlaksananya Pemanfaatan Barang Milik Daerah SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1793, 1765, 'Tersedianya Rencana Pengelolaan Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1794, 1766, 'Terlaksananya Penyuluhan dan Penyebarluasan Kebijakan Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1795, 1767, 'Tersedianya Data Objek, Subjek dan Wajib Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1796, 1768, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1797, 1769, 'Tersedianya Dokumen Ketetapan Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1798, 1770, 'Tersedianya Laporan Pengelolaan Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1799, 1771, 'Tersedianya Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1800, 1772, 'Tersedianya Pakaian Dinas beserta Atribut Kelengkapan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1801, 1773, 'Terlaksananya Pendataan dan Pengolahan Administrasi Kepegawaian', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1802, 1774, 'Terlaksananya Koordinasi dan Pelaksanaan Sistem Informasi Kepegawaian', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1803, 1775, 'Terlaksananya Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1804, 1776, 'Terlaksananya Pemulangan Pegawai yang Pensiun', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1805, 1777, 'Terlaksananya Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1806, 1778, 'Terlaksananya Pemindahan Tugas ASN', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1807, 1779, 'Terlaksananya Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1808, 1780, 'Terlaksananya Sosialisasi Peraturan Perundang-Undangan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1809, 1781, 'Terlaksananya Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1810, 1782, 'Tersedianya Komponen Instalasi Listrik/Penerangan Bangunan Kantor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1811, 1783, 'Tersedianya Peralatan dan Perlengkapan Kantor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1812, 1784, 'Tersedianya Peralatan Rumah Tangga', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1813, 1785, 'Tersedianya Bahan Logistik Kantor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1814, 1786, 'Tersedianya Barang Cetakan dan Penggandaan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);
REPLACE INTO `renstra_sub_kegiatan_sasaran` (`id`, `sub_kegiatan_id`, `sasaran_text`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1815, 1787, 'Tersedianya Bahan Bacaan dan Peraturan Perundang-undangan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1816, 1788, 'Tersedianya Bahan/Material', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1817, 1789, 'Terlaksananya Fasilitasi Kunjungan Tamu', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1818, 1790, 'Terlaksananya Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1819, 1791, 'Terlaksananya Penatausahaan Arsip Dinamis pada SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1820, 1792, 'Terlaksananya Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1821, 1793, 'Tersedianya Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1822, 1794, 'Tersedianya Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1823, 1795, 'Tersedianya Alat Besar', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1824, 1796, 'Tersedianya Alat Angkutan Darat Tak Bermotor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1825, 1797, 'Tersedianya Mebel', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1826, 1798, 'Tersedianya Peralatan dan Mesin Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1827, 1799, 'Tersedianya Aset Tetap Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1828, 1800, 'Tersedianya Aset Tak Berwujud', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1829, 1801, 'Tersedianya Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1830, 1802, 'Tersedianya Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1831, 1803, 'Tersedianya Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1832, 1804, 'Terlaksananya Penyediaan Jasa Surat Menyurat', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1833, 1805, 'Tersedianya Jasa Komunikasi, Sumber Daya Air dan Listrik', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1834, 1806, 'Tersedianya Jasa Peralatan dan Perlengkapan Kantor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1835, 1807, 'Tersedianya Jasa Pelayanan Umum Kantor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1836, 1808, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Pajak Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1837, 1809, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1838, 1810, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Perizinan Alat Besar', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1839, 1811, 'Tersedianya Jasa Pemeliharaan, Biaya Pemeliharaan dan Perizinan Alat Angkutan Darat Tak Bermotor', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1840, 1812, 'Terlaksananya Pemeliharaan Mebel', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1841, 1813, 'Terlaksananya Pemeliharaan Peralatan dan Mesin Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1842, 1814, 'Terlaksananya Pemeliharaan Aset Tetap Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1843, 1815, 'Terlaksananya Pemeliharaan Aset Tak Berwujud', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1844, 1816, 'Terlaksananya Pemeliharaan/Rehabilitasi Gedung Kantor dan Bangunan Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1845, 1817, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1846, 1818, 'Terlaksananya Pemeliharaan/Rehabilitasi Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1847, 1819, 'Terlaksananya Pemeliharaan/Rehabilitasi Tanah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1848, 1820, 'Terlaksananya Penagihan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1849, 1821, 'Terlaksananya Upaya Mengubah Transaksi Tunai Menjadi Non Tunai', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1850, 1822, 'Terlaksananya Penyuluhan dan Penyebarluasan Kebijakan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1851, 1823, 'Terlaksananya Penelitian dan Verifikasi Data Pelaporan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1852, 1824, 'Terlaksananya Penyelesaian Keberatan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1853, 1825, 'Terlaksanannya Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1854, 1826, 'Terlaksananya Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1855, 1827, 'Tersedianya Rencana Pengelolaan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1856, 1828, 'Tersedianya Hasil Analis Pajak Daerah serta Terlaksananya Pengembangan Pajak Daerah dan Kebijakan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1857, 1829, 'Tersedianya Sarana dan Prasarana Pengelolaan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1858, 1830, 'Tersedianya Data Objek Pajak, Subjek Pajak dan Wajib Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1859, 1831, 'Terlaksananya Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1860, 1832, 'Terpenuhinya Jumlah Objek Pajak yang Disesuaikan NJOP nya', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1861, 1833, 'Tersedianya Dokumen Ketetapan Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1862, 1834, 'Tersedianya Layanan dan Konsultasi Pajak Daerah', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

-- Table: renstra_sub_kegiatan_indikator (98 records)
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1829, 1737, 1765, 63, 'Jumlah Dokumen Perencanaan Perangkat Daerah', 'Dokumen', '2', '2', '34500000.00', '2', '37950000.00', '2', '41745000.00', '2', '45919500.00', '2', '50511450.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1830, 1738, 1766, 63, 'Jumlah Dokumen RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen RKA-SKPD', 'Dokumen', '1', '1', '7200000.00', '1', '7920000.00', '1', '8712000.00', '1', '9583200.00', '1', '10541520.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1831, 1739, 1767, 63, 'Jumlah Dokumen Perubahan RKA-SKPD dan Laporan Hasil Koordinasi Penyusunan
Dokumen Perubahan RKA-SKPD', 'Dokumen', '1', '1', '7200000.00', '1', '7920000.00', '1', '8712000.00', '1', '9583200.00', '1', '10541520.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1832, 1740, 1768, 63, 'Jumlah Dokumen DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen DPA-SKPD', 'Dokumen', '1', '1', '6700000.00', '1', '7370000.00', '1', '8107000.00', '1', '8917700.00', '1', '9809470.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1833, 1741, 1769, 63, 'Jumlah Dokumen Perubahan DPA-SKPD dan Laporan Hasil Koordinasi Penyusunan Dokumen Perubahan DPA-
SKPD', 'Dokumen', '1', '1', '6700000.00', '1', '7370000.00', '1', '8107000.00', '1', '8917700.00', '1', '9809470.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1834, 1742, 1770, 63, 'Jumlah Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja
SKPD', 'Laporan', '6', '6', '49500000.00', '6', '54450000.00', '6', '59895000.00', '6', '65884500.00', '6', '72472950.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1835, 1743, 1771, 63, 'Jumlah Laporan Evaluasi
Kinerja Perangkat Daerah', 'Laporan', '9', '7', '62157100.00', '7', '68372810.00', '7', '75210091.00', '7', '82731100.00', '7', '91004210.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1836, 1744, 1772, 63, 'Jumlah Dokumen Hasil Penyelenggaraan Walidata Pendukung Statistik Sektoral Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1837, 1745, 1773, 63, 'Jumlah Data Statistik Sektoral Daerah yang Telah Dikumpulkan dan Diperiksa
Lingkup Perangkat Daerah', 'Data', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1838, 1746, 1774, 63, 'Jumlah Berita Acara Hasil Forum Perangkat Daerah Berdasarkan Bidang Urusan yang Diampu dalam Rangka Penyusunan Dokumen Perencanaan Perangkat Daerah', 'Berita Acara', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1839, 1747, 1775, 63, 'Jumlah Dokumen Perencanaan Urusan Selain
Renstra PD dan Renja PD yang disusun', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1840, 1748, 1776, 63, 'Jumlah Subtansi Koordinasi Peningkatan Partisipasi Masyarakat dalam Penyelenggaraan Urusan Pemerintahan Daerah yang Diampu', 'Substansi', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1841, 1749, 1777, 63, 'Jumlah Berita Acara Hasil Sinkronisasi dan Harmonisasi Pusat dan Daerah dalam Rangka Mendukung Target Pembangunan Nasional
melalui  Koordinasi Teknis Pembangunan', 'Berita Acara', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1842, 1750, 1778, 63, 'Jumlah Orang yang Menerima Gaji dan Tunjangan ASN', 'Orang/bulan', '40', '40', '4282932368.00', '40', '4711225605.00', '40', '5182348165.00', '40', '5700582982.00', '40', '6270641280.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1843, 1751, 1779, 63, 'Jumlah Dokumen Hasil Penyediaan Administrasi Pelaksanaan Tugas ASN', 'Dokumen', '12', '12', '210600000.00', '12', '231660000.00', '12', '254826000.00', '12', '280308600.00', '12', '308339460.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1844, 1752, 1780, 63, 'Jumlah Dokumen Penatausahaan dan
Pengujian/Verifikasi Keuangan SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1845, 1753, 1781, 63, 'Jumlah Dokumen Koordinasi dan Pelaksanaan Akuntansi SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1846, 1754, 1782, 63, 'Jumlah Laporan Keuangan Akhir Tahun SKPD dan Laporan Hasil Koordinasi Penyusunan Laporan Keuangan Akhir Tahun SKPD', 'Laporan', '5', '5', '36000000.00', '5', '39600000.00', '5', '43560000.00', '5', '47916000.00', '5', '52707600.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1847, 1755, 1783, 63, 'Jumlah Dokumen Bahan Tanggapan Pemeriksaan dan Tindak Lanjut Pemeriksaan', 'Dokumen', '2', '2', '15000000.00', '2', '16500000.00', '2', '18150000.00', '2', '19965000.00', '2', '21961500.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1848, 1756, 1784, 63, 'Jumlah Laporan Keuangan Bulanan/ Triwulanan/ Semesteran SKPD dan Laporan Koordinasi Penyusunan Laporan Keuangan Bulanan/Triwulanan/Semester
an SKPD', 'Laporan', '24', '24', '45000000.00', '24', '49500000.00', '24', '54450000.00', '24', '59895000.00', '24', '65884500.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1849, 1757, 1785, 63, 'Jumlah Dokumen Pelaporan dan Analisis Prognosis Realisasi Anggaran', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1850, 1758, 1786, 63, 'Jumlah Rencana Kebutuhan Barang Milik Daerah SKPD', 'Dokumen', '2', '2', '3000000.00', '2', '3500000.00', '2', '3500000.00', '2', '4000000.00', '2', '4000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1851, 1759, 1787, 63, 'Jumlah Dokumen Pengamanan Barang Milik Daerah SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1852, 1760, 1788, 63, 'Jumlah Laporan Hasil Penilaian Barang Milik Daerah dan Hasil Koordinasi Penilaian Barang Milik Daerah SKPD', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1853, 1761, 1789, 63, 'Jumlah Laporan Hasil Pembinaan, Pengawasan, dan Pengendalian Barang Milik Daerah pada SKPD', 'Laporan', '12', '12', '12000000.00', '12', '12100000.00', '12', '12200000.00', '12', '12200000.00', '12', '12300000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1854, 1762, 1790, 63, 'Jumlah Laporan Rekonsiliasi dan Penyusunan Laporan Barang Milik Daerah pada
SKPD', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1855, 1763, 1791, 63, 'Jumlah Laporan Penatausahaan Barang Milik Daerah pada SKPD', 'Laporan', '12', '12', '18000000.00', '12', '18200000.00', '12', '18300000.00', '12', '18300000.00', '12', '18500000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1856, 1764, 1792, 63, 'Jumlah Dokumen Hasil Pemanfaatan Barang Milik Daerah SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1857, 1765, 1793, 63, 'Jumlah Dokumen Rencana Pengelolaan Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1858, 1766, 1794, 63, 'Jumlah Laporan Hasil Penyuluhan dan Penyebarluasan Kebijakan
Retribusi Daerah', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1859, 1767, 1795, 63, 'Jumlah Data Objek, Subjek
dan Wajib Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1860, 1768, 1796, 63, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Data Retribusi
Daerah', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1861, 1769, 1797, 63, 'Jumlah Dokumen Ketetapan Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1862, 1770, 1798, 63, 'Jumlah Laporan Pengelolaan Retribusi Daerah', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1863, 1771, 1799, 63, 'Jumlah Unit Peningkatan Sarana dan Prasarana Disiplin Pegawai', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1864, 1772, 1800, 63, 'Jumlah Paket Pakaian Dinas beserta Atribut Kelengkapan', 'Paket', '3', '3', '75000000.00', '2', '75000000.00', '2', '80000000.00', '2', '85000000.00', '2', '85000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1865, 1773, 1801, 63, 'Jumlah Dokumen Pendataan dan Pengolahan Administrasi Kepegawaian', 'Dokumen', '12', '24', '11000000.00', '24', '11000000.00', '24', '11000000.00', '24', '11000000.00', '24', '11000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1866, 1774, 1802, 63, 'Jumlah Dokumen Hasil Koordinasi dan Pelaksanaaan Sistem Informasi
Kepegawaian', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1867, 1775, 1803, 63, 'Jumlah Dokumen Monitoring, Evaluasi, dan Penilaian Kinerja Pegawai', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1868, 1776, 1804, 63, 'Jumlah Pegawai Pensiun yang Dipulangkan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1869, 1777, 1805, 63, 'Jumlah Laporan Hasil Pemulangan Pegawai yang Meninggal dalam Melaksanakan Tugas', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1870, 1778, 1806, 63, 'Jumlah ASN yang dipindahtugaskan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1871, 1779, 1807, 63, 'Jumlah Pegawai Berdasarkan Tugas dan Fungsi yang Mengikuti Pendidikan dan
Pelatihan', 'Orang', '', '15', '150000000.00', '10', '100000000.00', '5', '50000000.00', '7', '75000000.00', '5', '50000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1872, 1780, 1808, 63, 'Jumlah Orang yang Mengikuti Sosialisasi Peraturan Perundang-Undangan', 'Orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1873, 1781, 1809, 63, 'Jumlah Orang yang Mengikuti Bimbingan Teknis Implementasi Peraturan Perundang-Undangan', 'orang', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1874, 1782, 1810, 63, 'Jumlah Paket Komponen Instalasi Listrik/Penerangan Bangunan Kantor yang
Disediakan', 'Paket', '1', '1', '30000000.00', '1', '32000000.00', '1', '34000000.00', '1', '35000000.00', '1', '35000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1875, 1783, 1811, 63, 'Jumlah Paket Peralatan dan Perlengkapan Kantor yang Disediakan', 'Paket', '', '6', '515000000.00', '6', '250000000.00', '6', '150000000.00', '6', '200000000.00', '6', '150000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1876, 1784, 1812, 63, 'Jumlah Paket Peralatan Rumah Tangga yang
Disediakan', 'Paket', '1', '1', '210000000.00', '1', '250000000.00', '1', '250000000.00', '1', '275000000.00', '1', '275000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1877, 1785, 1813, 63, 'Jumlah Paket Bahan Logistik Kantor yang Disediakan', 'Paket', '1', '1', '35000000.00', '1', '35000000.00', '1', '35000000.00', '1', '37000000.00', '1', '39000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1878, 1786, 1814, 63, 'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan', 'Paket', '1', '1', '30000000.00', '1', '32000000.00', '1', '33000000.00', '1', '35000000.00', '1', '37000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);
REPLACE INTO `renstra_sub_kegiatan_indikator` (`id`, `sub_kegiatan_id`, `sasaran_id`, `perangkat_daerah_id`, `indikator`, `satuan`, `kondisi_awal`, `target_2026`, `anggaran_2026`, `target_2027`, `anggaran_2027`, `target_2028`, `anggaran_2028`, `target_2029`, `anggaran_2029`, `target_2030`, `anggaran_2030`, `urutan`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1879, 1787, 1815, 63, 'Jumlah Dokumen Bahan Bacaan dan Peraturan Perundang-Undangan yang Disediakan', 'Dokumen', '24', '24', '10000000.00', '24', '12000000.00', '24', '12000000.00', '24', '15000000.00', '24', '15000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1880, 1788, 1816, 63, 'Jumlah Paket Bahan/Material yang Disediakan', 'Paket', '1', '1', '350000000.00', '1', '400000000.00', '1', '400000000.00', '1', '400000000.00', '1', '420000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1881, 1789, 1817, 63, 'Jumlah Laporan Fasilitasi Kunjungan Tamu', 'Laporan', '12', '12', '50000000.00', '12', '50000000.00', '12', '50000000.00', '12', '55000000.00', '12', '55000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1882, 1790, 1818, 63, 'Jumlah Laporan Penyelenggaraan Rapat Koordinasi dan Konsultasi
SKPD', 'Laporan', '12', '12', '250000000.00', '12', '250000000.00', '12', '260000000.00', '12', '260000000.00', '12', '270000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1883, 1791, 1819, 63, 'Jumlah Dokumen Penatausahaan Arsip Dinamis pada SKPD', 'Dokumen', '12', '12', '13000000.00', '12', '13000000.00', '12', '13000000.00', '12', '13500000.00', '12', '13500000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1884, 1792, 1820, 63, 'Jumlah Dokumen Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD', 'Dokumen', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1885, 1793, 1821, 63, 'Jumlah Unit Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan
yang Disediakan', 'Unit', '', '5', '300000000.00', '1', '450000000.00', '1', '600000000.00', '1', '300000000.00', '1', '350000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1886, 1794, 1822, 63, 'Jumlah Unit Kendaraan Dinas Operasional atau Lapangan yang Disediakan', 'Unit', '', '', '0.00', '1', '500000000.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1887, 1795, 1823, 63, 'Jumlah Unit Alat Besar yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1888, 1796, 1824, 63, 'Jumlah Unit Alat Angkutan Darat Tak Bermotor yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1889, 1797, 1825, 63, 'Jumlah Paket Mebel yang Disediakan', 'Unit', '5', '8', '50000000.00', '10', '65000000.00', '30', '45000000.00', '10', '35000000.00', '20', '50000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1890, 1798, 1826, 63, 'Jumlah Unit Peralatan dan Mesin Lainnya yang
Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1891, 1799, 1827, 63, 'Jumlah Unit Aset Tetap Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1892, 1800, 1828, 63, 'Jumlah Unit Aset Tak
Berwujud yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1893, 1801, 1829, 63, 'Jumlah Unit Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1894, 1802, 1830, 63, 'Jumlah Unit Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang
Disediakan', 'Unit', '11', '10', '150000000.00', '20', '200000000.00', '15', '200000000.00', '10', '100000000.00', '20', '150000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1895, 1803, 1831, 63, 'Jumlah Unit Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Disediakan', 'Unit', '', '5', '100000000.00', '25', '175000000.00', '15', '150000000.00', '10', '100000000.00', '15', '150000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1896, 1804, 1832, 63, 'Jumlah Laporan Penyediaan
Jasa Surat Menyurat', 'Laporan', '12', '12', '5000000.00', '12', '5500000.00', '12', '5500000.00', '12', '6000000.00', '12', '6000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1897, 1805, 1833, 63, 'Jumlah Laporan Penyediaan Jasa Komunikasi, Sumber
Daya Air dan Listrik yang Disediakan', 'Laporan', '12', '12', '1200000000.00', '12', '1300000000.00', '12', '1350000000.00', '12', '1400000000.00', '12', '1450000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1898, 1806, 1834, 63, 'Jumlah Laporan Penyediaan Jasa Peralatan dan Perlengkapan Kantor yang
Disediakan', 'Laporan', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1899, 1807, 1835, 63, 'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan', 'Laporan', '12', '12', '2080000000.00', '12', '2090000000.00', '12', '2090000000.00', '12', '2100000000.00', '12', '2100000000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1900, 1808, 1836, 63, 'Jumlah Kendaraan Perorangan Dinas atau Kendaraan Dinas Jabatan yang Dipelihara dan dibayarkan Pajaknya', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1901, 1809, 1837, 63, 'Jumlah Kendaraan Dinas Operasional atau Lapangan yang Dipelihara dan
dibayarkan Pajak dan Perizinannya', 'Unit', '28', '43', '350000000.00', '40', '385000000.00', '41', '423500000.00', '42', '465850000.00', '42', '512435000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1902, 1810, 1838, 63, 'Jumlah Alat Besar yang Dipelihara dan dibayarkan Perizinannya', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1903, 1811, 1839, 63, 'Jumlah Alat Angkutan Darat Tak Bermotor yang Dipelihara dan Dibayarkan Perizinannya', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1904, 1812, 1840, 63, 'Jumlah Mebel yang Dipelihara', 'Unit', '', '10', '5000000.00', '20', '5500000.00', '10', '6050000.00', '15', '6655000.00', '10', '7320500.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1905, 1813, 1841, 63, 'Jumlah Peralatan dan Mesin
Lainnya yang Dipelihara', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1906, 1814, 1842, 63, 'Jumlah Aset Tetap Lainnya yang Dipelihara', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1907, 1815, 1843, 63, 'Jumlah Aset Tak Berwujud yang Dipelihara', 'Unit', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1908, 1816, 1844, 63, 'Jumlah Gedung Kantor dan Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '4', '2', '200000000.00', '2', '220000000.00', '3', '242000000.00', '2', '266200000.00', '3', '292820000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1909, 1817, 1845, 63, 'Jumlah Sarana dan Prasarana Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '186', '45', '350000000.00', '49', '385000000.00', '49', '423500000.00', '50', '465850000.00', '50', '512435000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1910, 1818, 1846, 63, 'Jumlah Sarana dan Prasarana Pendukung Gedung Kantor atau Bangunan Lainnya yang Dipelihara/Direhabilitasi', 'Unit', '', '1', '555260000.00', '2', '583023000.00', '1', '677794600.00', '2', '748474060.00', '1', '861271466.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1911, 1819, 1847, 63, 'Luas Tanah yang Dilakukan Pemeliharaan/Rehabilitasi', 'Ha', '', '', '0.00', '', '0.00', '', '0.00', '', '0.00', '', '0.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1912, 1820, 1848, 63, 'Jumlah Dokumen Hasil Pelaksanaan Penagihan Pajak Daerah', 'Dokumen', '12', '12', '2408422669.00', '12', '972352990.00', '12', '2914191429.00', '12', '3205610572.00', '12', '1754615545.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1913, 1821, 1849, 63, 'Jumlah Laporan Perkembangan Elektronifikasi
Transaksi Pemerintah Daerah', 'Laporan', '', '2', '93259803.00', '2', '102585783.00', '2', '112844362.00', '2', '124128798.00', '2', '136541678.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1914, 1822, 1850, 63, 'Jumlah Laporan Pelaksanaan Penyuluhan dan Penyebarluasan Kebijakan
Pajak Daerah', 'Laporan', '1', '3', '164783813.00', '3', '181262194.00', '3', '199388414.00', '3', '219327255.00', '3', '241259981.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1915, 1823, 1851, 63, 'Jumlah Data Pelaporan Pajak Daerah yang Telah Dilakukan Penelitian dan Verifikasi', 'Dokumen', '48', '48', '190024710.00', '48', '209027181.00', '48', '229929899.00', '48', '252922889.00', '48', '278215178.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1916, 1824, 1852, 63, 'Jumlah Dokumen Hasil Penyelesaian Keberatan Pajak Daerah', 'Dokumen', '12', '10', '50000000.00', '10', '55000000.00', '10', '60500000.00', '10', '66550000.00', '10', '73205000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1917, 1825, 1853, 63, 'Jumlah Dokumen Hasil Pemeriksaan serta Pengendalian dan Pengawasan Pajak Daerah', 'Dokumen', '2', '2', '216151310.00', '2', '237766441.00', '2', '261543085.00', '2', '287697394.00', '2', '316467133.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1918, 1826, 1854, 63, 'Jumlah Laporan Hasil Pembinaan dan Pengawasan Pengelolaan Retribusi Daerah', 'Laporan', '4', '4', '110000000.00', '4', '121000000.00', '4', '133100000.00', '4', '146410000.00', '4', '161051000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1919, 1827, 1855, 63, 'Jumlah Dokumen Rencana Pengelolaan Pajak Daerah', 'Dokumen', '2', '2', '130000000.00', '2', '143000000.00', '2', '157300000.00', '2', '173030000.00', '2', '190333000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1920, 1828, 1856, 63, 'Jumlah Dokumen Hasil Analis Pajak Daerah serta Pengembangan Pajak Daerah dan Kebijakan Pajak Daerah', 'Dokumen', '', '2', '275000000.00', '1', '302500000.00', '1', '332750000.00', '1', '366025000.00', '1', '402627500.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1921, 1829, 1857, 63, 'Jumlah Sarana dan Prasarana Pengelolaan Pajak Daerah', 'Unit', '', '2', '150000000.00', '2', '165000000.00', '2', '181500000.00', '2', '199650000.00', '2', '219615000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1922, 1830, 1858, 63, 'Jumlah Laporan Hasil Pendataan dan Pendaftaran Objek Pajak Daerah, Subjek Pajak dan Wajib Pajak Daerah', 'Laporan', '4', '4', '4130000000.00', '4', '4543000000.00', '4', '4997300000.00', '4', '5497030000.00', '4', '6046733000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1923, 1831, 1859, 63, 'Jumlah Laporan Hasil Pengolahan, Pemeliharaan, dan Pelaporan Basis Data Pajak Daerah', 'Laporan', '', '4', '300000000.00', '4', '330000000.00', '4', '363000000.00', '4', '399300000.00', '4', '439230000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1924, 1832, 1860, 63, 'Jumlah Objek Pajak yang Disesuaikan NJOP nya', 'Obyek Pajak', '', '202452', '600000000.00', '202452', '660000000.00', '202452', '726000000.00', '202452', '798600000.00', '202452', '878460000.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1925, 1833, 1861, 63, 'Jumlah Dokumen Ketetapan Pajak Daerah', 'Dokumen', '239897', '221118', '348400000.00', '221118', '383240000.00', '221200', '421564000.00', '221200', '463720400.00', '221210', '510092440.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL),
  (1926, 1834, 1862, 63, 'Jumlah Layanan dan
Konsultasi Pajak Daerah Layanan', 'Layanan', '', '120', '75000000.00', '120', '82500000.00', '120', '90750000.00', '120', '99825000.00', '120', '109807500.00', 10, '2026-09-24 15:53:06', '2026-09-24 15:53:06', NULL);

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================================
-- SELESAI
-- ==============================================================================
