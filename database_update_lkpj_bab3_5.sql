-- ====================================================================
-- MIGRATION: E-LKPJ BAB 3.5 PENGHARGAAN DAERAH
-- ====================================================================

CREATE TABLE IF NOT EXISTS `lkpj_penghargaan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2025,
  `urutan` INT(11) DEFAULT 1,
  `jenis_penghargaan` TEXT NOT NULL,
  `tingkat` VARCHAR(100) NOT NULL,
  `lembaga` VARCHAR(255) NOT NULL,
  `keterangan` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_penghargaan_filter` (`tahun`, `kodewilayah`, `instansi_id`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data 11 Penghargaan (Sesuai Gambar Tabel Pengguna)
INSERT INTO `lkpj_penghargaan` 
(`id`, `kodewilayah`, `instansi_id`, `tahun`, `urutan`, `jenis_penghargaan`, `tingkat`, `lembaga`, `keterangan`, `created_at`, `updated_at`, `deleted_at`)
VALUES
(1, '35.12', 1, 2025, 1, 
 'Kabupaten Terinovatif - Innovative Government Award 2025', 
 'Pusat / Nasional', 
 'Kementerian Dalam Negeri', 
 'Kategori Kabupaten Terinovatif dalam IGA 2025', NOW(), NOW(), NULL),

(2, '35.12', 4, 2025, 2, 
 'Kabupaten Sehat Swasti Saba 2025 Kategori "Padapa"', 
 'Pusat / Nasional', 
 'Kementerian Kesehatan RI', 
 'Penghargaan Kabupaten/Kota Sehat Kategori Padapa', NOW(), NOW(), NULL),

(3, '35.12', 1, 2025, 3, 
 'CNN INDONESIA AWARD 2025 Kategori “Outstanding Regional Initiative For MSME Empowerment”', 
 'Pusat / Nasional', 
 'CNN', 
 'Inisiatif pemberdayaan UMKM daerah', NOW(), NOW(), NULL),

(4, '35.12', 1, 2025, 4, 
 'Opini LKPD/OPINI BPK atas LKPD', 
 'Pusat / Nasional', 
 'BPK RI', 
 'Opini Wajar Tanpa Pengecualian (WTP)', NOW(), NOW(), NULL),

(5, '35.12', 1, 2025, 5, 
 'Penghargaan Atas Capaian Perolehan Pajak Tertinggi Secara Nasional', 
 'Pusat / Nasional', 
 'Kantor Pelayanan Pajak Pratama Situbondo', 
 'Capaian perolehan pajak tertinggi', NOW(), NOW(), NULL),

(6, '35.12', 4, 2025, 6, 
 'Kabupaten/Kota Sehat (Swasti Saba) Kategori Padapa', 
 'Pusat / Nasional', 
 'Kementerian Kesehatan Republik Indonesia (Kemenkes RI)', 
 'Swasti Saba Kategori Padapa', NOW(), NOW(), NULL),

(7, '35.12', 5, 2025, 7, 
 'KABUPATEN LAYAK ANAK Kategori “Nindya”', 
 'Pusat / Nasional', 
 'Kementerian Pemberdayaan Perempuan dan Perlindungan Anak Republik Indonesia', 
 'KLA Kategori Nindya', NOW(), NOW(), NULL),

(8, '35.12', 1, 2025, 8, 
 'KOMPAS TV AWARD Kategori “Daerah Peduli Pengembangan UMKM dan Potensi Sumber Daya Lokal”', 
 'Pusat / Nasional', 
 'KOMPAS TV', 
 'Penghargaan daerah peduli UMKM dan potensi lokal', NOW(), NOW(), NULL),

(9, '35.12', 1, 2025, 9, 
 'Anugerah TIMES Indonesia 2025 kategori “The Gateway Leader Award bidang Accelerating Regional Economic Advancement”', 
 'Pusat / Nasional', 
 'Times Indonesia', 
 'The Gateway Leader Award', NOW(), NOW(), NULL),

(10, '35.12', 6, 2025, 10, 
 'TERBAIK 1 PETUGAS IB BERPRESTASI PROVINSI JAWA TIMUR KATEGORI AKSEPTOR TINGGI TAHUN 2025', 
 'Provinsi', 
 'Pemerintah Provinsi Jawa Timur', 
 'Kategori Akseptor Tinggi Tingkat Provinsi Jatim', NOW(), NOW(), NULL),

(11, '35.12', 6, 2025, 11, 
 'PERINGKAT 2 KABUPATEN DENGAN CAKUPAN VAKSINASI PMK TERBAIK TINGKAT PROVINSI', 
 'Provinsi', 
 'KETUA SATGAS PENANGANAN PMK PROVINSI JAWA TIMUR', 
 'Cakupan Vaksinasi PMK Terbaik Tingkat Jatim', NOW(), NOW(), NULL),

(12, '35.12', 35, 2025, 12, 'FORUM PENINGKATAN KONSUMSI IKAN KAB SITUBONDO', 'Provinsi', 'KETUA FORUM PENINGKATAN KONSUMSI IKAN PROV JATIM', 'Penghargaan Forum Peningkatan Konsumsi Ikan', NOW(), NOW(), NULL),
(13, '35.12', 36, 2025, 13, 'SATA JATIM AWARD', 'Provinsi', 'Dinas Komunikasi Dan Informatika Provinsi Jawa Timur', 'Satu Data Jawa Timur Award', NOW(), NOW(), NULL),
(14, '35.12', 37, 2025, 14, 'PIAGAM PENGHARGAAN KPD DESA SUMBER PINANG KECAMATAN MLANDINGAN DALAM LOMBA TIM PEMBINAAN POSYANDU TINGKAT PROVINSI JAWA TIMUR TAHUN 2025', 'Provinsi', 'Pemerintah Provinsi Jawa Timur', 'Lomba Tim Pembinaan Posyandu', NOW(), NOW(), NULL),
(15, '35.12', 38, 2025, 15, 'Apresiasi Penyelenggaraan Penilaian Kompetensi. Tingkat Provinsi', 'Provinsi', 'Badan Kepegawaian Daerah Provinsi Jawa Timur', 'Penilaian Kompetensi Tingkat Provinsi', NOW(), NOW(), NULL),
(16, '35.12', 39, 2025, 16, 'Mitra Strategis Terbaik Dalam Pengendalian Inflasi Daerah Kategori Non-IHK', 'Provinsi', 'Bank Indonesia', 'Pengendalian Inflasi Daerah Kategori Non-IHK', NOW(), NOW(), NULL),
(17, '35.12', 40, 2025, 17, 'Mitra Digitalisasi Daerah Terkooperatif di wilayah kerja BI', 'Provinsi', 'Bank Indonesia', 'Mitra Digitalisasi Daerah di Wilayah Kerja BI', NOW(), NOW(), NULL),
(18, '35.12', 42, 2025, 18, 'Juara II Apresiasi Penyelenggaraan Perpustakaan Umum Terbaik (Desa/Kelurahan) Desa Mojosari, Kecamatan Asembagus, Kabupaten Situbondo', 'Provinsi', 'Gubernur Jawa Timur', 'Perpustakaan Umum Terbaik Desa Mojosari', NOW(), NOW(), NULL),
(19, '35.12', 43, 2025, 19, 'Piagam Penghargaan Kelompok KB Pria "JAGO" Kabupaten Situbondo sebagai Juara Harapan 2 Lomba Kelompok KB Pria Tingkat Provinsi Jawa Timur Tahun 2025', 'Provinsi', 'Kementerian Kependudukan dan Pembangunan Keluarga/BKKBN Provinsi Jawa Timur', 'Juara Harapan 2 Kelompok KB Pria JAGO', NOW(), NOW(), NULL),
(20, '35.12', 4, 2025, 20, 'Penilaian Kinerja Pelaksanaan Aksi Konvergensi Pencegahan dan Percepatan Penurunan Stunting (PPPS)', 'Provinsi', 'Pemerintah Provinsi Jawa Timur', 'Aksi Konvergensi Pencegahan & Penurunan Stunting', NOW(), NOW(), NULL),
(21, '35.12', 41, 2025, 21, 'Wajib Pajak dengan Pembayaran Pajak atas Pembelanjaan APBD terbaik Tahun 2025 di Kabupaten Situbondo', 'Provinsi', 'Kantor Pelayanan Pajak Pratama Situbondo', 'Wajib Pajak Pembayaran Pajak Terbaik 2025', NOW(), NOW(), NULL),
(22, '35.12', 44, 2025, 22, 'Penghargaan Desa Berseri Madya untuk Desa Mojosari', 'Provinsi', 'Dinas Lingkungan Hidup Provinsi Jawa Timur', 'Desa Berseri Madya untuk Desa Mojosari', NOW(), NOW(), NULL),
(23, '35.12', 44, 2025, 23, 'Desa Berseri Pratama untuk Desa Kotakan, Paowan, Patokan dan Kilensari', 'Provinsi', 'Dinas Lingkungan Hidup Provinsi Jawa Timur', 'Desa Berseri Pratama', NOW(), NOW(), NULL),
(24, '35.12', 1, 2025, 25, 'Kabupaten Terinovatif III Kategori Inovasi Daerah Inotek Award 2025', 'Provinsi', 'BRIDA Provinsi Jatim', 'Inotek Award 2025 Kategori Inovasi Daerah', NOW(), NOW(), NULL),
(25, '35.12', 45, 2025, 26, 'Kabupaten Top 15 Kategori Inovasi Agribisnis dan Energi Baru Terbarukan Inotek Award 2025', 'Provinsi', 'BRIDA Provinsi Jatim', 'Inotek Award 2025 Top 15 Agribisnis & EBT', NOW(), NOW(), NULL),
(26, '35.12', 36, 2025, 27, 'Kabupaten Top 15 Kategori Inovasi Teknologi Berbasis Website/Mobile Apps Inotek Award 2025', 'Provinsi', 'BRIDA Provinsi Jatim', 'Inotek Award 2025 Top 15 Website/Mobile Apps', NOW(), NOW(), NULL),
(27, '35.12', 1, 2025, 28, 'Kabupaten Top 15 Kategori Inovasi Khusus Milenial Inotek Award 2025', 'Provinsi', 'BRIDA Provinsi Jatim', 'Inotek Award 2025 Top 15 Khusus Milenial', NOW(), NOW(), NULL),
(28, '35.12', 38, 2025, 29, 'DETIK JATIM AWARD Kategori “Transformasi Birokrasi Berbasis Meritokrasi”', 'Provinsi', 'Detikcom', 'Detik Jatim Award Kategori Transformasi Birokrasi', NOW(), NOW(), NULL)
ON DUPLICATE KEY UPDATE 
  `jenis_penghargaan` = VALUES(`jenis_penghargaan`),
  `tingkat` = VALUES(`tingkat`),
  `lembaga` = VALUES(`lembaga`),
  `keterangan` = VALUES(`keterangan`);

