-- ==============================================================================
-- SCRIPT UPDATE & INSERT DATABASE IPPD (INDEKS PERENCANAAN PEMBANGUNAN DAERAH)
-- Aman dijalankan di server lokal maupun hosting (cPanel/phpMyAdmin)
-- Tidak merusak atau menghapus data/fungsi pada menu lain
-- ==============================================================================

-- ------------------------------------------------------------------------------
-- 1. TABEL EVALUASI IPPD: ippd_penilaian
-- Menyimpan penilaian seluruh poin IPPD, catatan, bukti dukung, dan detail per poin
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ippd_penilaian` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2026,
  `item_code` VARCHAR(50) NOT NULL,
  `bobot_capaian` DECIMAL(8,3) DEFAULT NULL,
  `opsi_aksi` VARCHAR(255) DEFAULT NULL,
  `catatan` TEXT DEFAULT NULL,
  `bukti_dukung` TEXT DEFAULT NULL,
  `detail_json` LONGTEXT DEFAULT NULL,
  `bobot_verifikator` DECIMAL(8,3) DEFAULT NULL,
  `opsi_aksi_verifikator` VARCHAR(255) DEFAULT NULL,
  `catatan_verifikator` TEXT DEFAULT NULL,
  `bukti_dukung_verifikator` TEXT DEFAULT NULL,
  `status_verifikasi` VARCHAR(50) DEFAULT 'Draft',
  `verifikator_id` INT(11) DEFAULT NULL,
  `tgl_verifikasi` DATETIME DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_ippd_eval` (`kodewilayah`, `instansi_id`, `tahun`, `item_code`),
  INDEX `idx_ippd_lookup` (`tahun`, `instansi_id`, `kodewilayah`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pastikan kolom detail_json ada jika tabel ippd_penilaian sebelumnya sudah ada
SET @col_json_exists = (
  SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'ippd_penilaian' 
    AND COLUMN_NAME = 'detail_json'
);
SET @sql_add_json = IF(@col_json_exists = 0, 
  'ALTER TABLE `ippd_penilaian` ADD COLUMN `detail_json` LONGTEXT DEFAULT NULL AFTER `bukti_dukung`', 
  'SELECT "Column detail_json already exists"'
);
PREPARE stmt_json FROM @sql_add_json;
EXECUTE stmt_json;
DEALLOCATE PREPARE stmt_json;

-- Perlebar bukti_dukung menjadi TEXT jika sebelumnya bertipe VARCHAR
ALTER TABLE `ippd_penilaian` MODIFY COLUMN `bukti_dukung` TEXT DEFAULT NULL;


-- ------------------------------------------------------------------------------
-- 2. TABEL KESELARASAN ASTA CITA & MISI DAERAH: keselarasan_astacita_misi
-- Diperlukan untuk Poin 1.a.1.c (Keselarasan Misi RPJMD dengan Prioritas Nasional)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `keselarasan_astacita_misi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` VARCHAR(10) NOT NULL,
  `id_prioritas_nasional` INT(11) NOT NULL,
  `id_misi_provinsi` TEXT NULL,
  `misi_provinsi_text` TEXT NULL,
  `id_misi_daerah` TEXT NULL,
  `misi_daerah_text` TEXT NULL,
  `tahun_mulai` INT(4) NULL,
  `tahun_akhir` INT(4) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kode_wilayah` (`kode_wilayah`),
  KEY `idx_pn` (`id_prioritas_nasional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ------------------------------------------------------------------------------
-- 3. TABEL KESELARASAN PRIORITAS NASIONAL & DAERAH:
-- keselarasan_prioritas_master & keselarasan_prioritas_detail
-- Diperlukan untuk Poin 1.a.2.a s/d 1.a.2.h (Keselarasan Program Prioritas)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `keselarasan_prioritas_master` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` VARCHAR(20) NOT NULL,
  `id_prioritas_nasional` INT(11) NOT NULL,
  `kegiatan_prioritas` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kode_wilayah` (`kode_wilayah`),
  KEY `idx_prioritas_nasional` (`id_prioritas_nasional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `keselarasan_prioritas_detail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_master` INT(11) NOT NULL,
  `kode_sub_kegiatan` VARCHAR(50) NOT NULL,
  `sub_kegiatan` TEXT DEFAULT NULL,
  `kode_kegiatan` VARCHAR(50) DEFAULT NULL,
  `kegiatan` TEXT DEFAULT NULL,
  `kode_program` VARCHAR(50) DEFAULT NULL,
  `program` TEXT DEFAULT NULL,
  `id_perangkat_daerah` INT(11) DEFAULT NULL,
  `keterangan` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_master` (`id_master`),
  KEY `idx_perangkat_daerah` (`id_perangkat_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ------------------------------------------------------------------------------
-- 4. MASTER PRIORITAS NASIONAL (ASTA CITA RPJMN 2025-2029):
-- prioritas_nasional_rpjmn
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `prioritas_nasional_rpjmn` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `_Id` INT(11) DEFAULT 1,
  `PrioritasNasional` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `prioritas_nasional_rpjmn` (`Id`, `_Id`, `PrioritasNasional`, `created_at`, `updated_at`)
VALUES
(1, 1, 'Memperkokoh ideologi Pancasila, demokrasi, dan hak asasi manusia (HAM)', NOW(), NOW()),
(2, 1, 'Memantapkan sistem pertahanan keamanan negara dan mendorong kemandirian bangsa melalui swasembada pangan, energi, air, ekonomi syariah, ekonomi digital, ekonomi hijau, dan ekonomi biru', NOW(), NOW()),
(3, 1, 'Melanjutkan pengembangan infrastruktur dan meningkatkan lapangan kerja yang berkualitas, mendorong kewirausahaan, mengembangkan industri kreatif serta mengembangkan agromaritim industri di sentra produksi melalui peran aktif koperasi', NOW(), NOW()),
(4, 1, 'Memperkuat pembangunan sumber daya manusia (SDM), sains, teknologi, pendidikan, kesehatan, prestasi olahraga, kesetaraan gender, serta penguatan peran perempuan, pemuda (generasi milenial dan generasi Z), dan penyandang disabilitas', NOW(), NOW()),
(5, 1, 'Melanjutkan hilirisasi dan mengembangkan industri berbasis sumber daya alam untuk meningkatkan nilai tambah di dalam negeri', NOW(), NOW()),
(6, 1, 'Membangun dari desa dan dari bawah untuk pertumbuhan ekonomi, pemerataan ekonomi, dan pemberantasan kemiskinan', NOW(), NOW()),
(7, 1, 'Memperkuat reformasi politik, hukum, dan birokrasi, serta memperkuat pencegahan dan pemberantasan korupsi, narkoba, judi, dan penyelundupan', NOW(), NOW()),
(8, 1, 'Memperkuat penyelarasan kehidupan yang harmonis dengan lingkungan, alam dan budaya, serta peningkatan toleransi antarumat beragama untuk mencapai masyarakat yang adil dan makmur', NOW(), NOW())
ON DUPLICATE KEY UPDATE 
  `PrioritasNasional` = VALUES(`PrioritasNasional`),
  `updated_at` = NOW();

-- ------------------------------------------------------------------------------
-- 4.B MASTER RESMI RKP/RPJMN: rkp_ps_prioritas_nasional & rkp_ps_program_prioritas
-- Memuat 8 Prioritas Nasional dan seluruh 88 Program Prioritas resmi nasional
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rkp_ps_prioritas_nasional` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PrioritasNasional` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `rkp_ps_prioritas_nasional` (`Id`, `PrioritasNasional`, `created_at`, `updated_at`) VALUES
  ('1', 'Memperkokoh Ideologi Pancasila, Demokrasi, dan Hak Asasi Manusia', NOW(), NOW()),
  ('2', 'Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru', NOW(), NOW()),
  ('3', 'Melanjutkan Pengembangan Infrastruktur dan Meningkatkan Lapangan Kerja yang Berkualitas, Mendorong Kewirausahaan, Mengembangkan Industri Kreatif serta Mengembangkan Agromaritim Industri di Sentra Produksi melalui Peran Aktif Koperasi', NOW(), NOW()),
  ('4', 'Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, Serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi 2), dan Penyandang Disabilitas', NOW(), NOW()),
  ('5', 'Melanjutkan Hilirisasi dan Mengembangkan Industri Berbasis Sumber Daya Alam untuk Meningkatkan Nilai Tambah di Dalam Negeri', NOW(), NOW()),
  ('6', 'Membangun dari Desa dan dari Bawah untuk Pertumbuhan Ekonomi, Pemerataan Ekonomi, dan Pemberantasan Kemiskinan', NOW(), NOW()),
  ('7', 'Memperkuat Reformasi Politik, Hukum, dan Birokrasi, serta Memperkuat Pencegahan dan Pemberantasan Korupsi, Narkoba, Judi, dan Penyelundupan', NOW(), NOW()),
  ('8', 'Memperkuat Penyelarasan Kehidupan yang Harmonis dengan Lingkungan Alam dan Budaya, serta Peningkatan Toleransi Antarumat Beragama untuk Mencapai Masyarakat yang Adil dan Makmur', NOW(), NOW())
ON DUPLICATE KEY UPDATE `PrioritasNasional` = VALUES(`PrioritasNasional`);

CREATE TABLE IF NOT EXISTS `rkp_ps_program_prioritas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `_IdPN` int(11) NOT NULL,
  `ProgramPrioritas` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4;

INSERT INTO `rkp_ps_program_prioritas` (`Id`, `_IdPN`, `ProgramPrioritas`, `created_at`, `updated_at`, `deleted_at`) VALUES
  ('1', '1', 'Penguatan Ideologi Pancasila, Wawasan Kebangsaan, dan Ketahanan Nasional', NOW(), NOW(), NULL),
  ('2', '1', 'Penguatan Komunikasi Publik dan Media', NOW(), NOW(), NULL),
  ('3', '1', 'Penguatan Lembaga Demokrasi', NOW(), NOW(), NULL),
  ('4', '1', 'Penguatan Kesetaraan Masyarakat Sipil', NOW(), NOW(), NULL),
  ('5', '1', 'Pengarusutamaan, Pemajuan, dan Penegakan HAM', NOW(), NOW(), NULL),
  ('6', '2', 'Pembangunan Postur Pertahanan', NOW(), NOW(), NULL),
  ('7', '2', 'Pembangunan dan Pengembangan Industri Pertahanan', NOW(), NOW(), NULL),
  ('8', '2', 'Komponen Cadangan dan Komponen Pendukung', NOW(), NOW(), NULL),
  ('9', '2', 'Intelijen dan Keamanan Dalam Negeri', NOW(), NOW(), NULL),
  ('10', '2', 'Keamanan Siber, Sandi, dan Sinyal', NOW(), NOW(), NULL),
  ('11', '2', 'Keamanan Laut dan Hidro-Oseanografi', NOW(), NOW(), NULL),
  ('12', '2', 'Keamanan dan Ketertiban Masyarakat', NOW(), NOW(), NULL),
  ('13', '2', 'Profesionalisme Pelayanan Kepolisian', NOW(), NOW(), NULL),
  ('14', '2', 'Diplomasi Asta Cita dan Diplomasi Ekonomi', NOW(), NOW(), NULL),
  ('15', '2', 'Swasembada Pangan', NOW(), NOW(), NULL),
  ('16', '2', 'Swasembada Energi', NOW(), NOW(), NULL),
  ('17', '2', 'Swasembada Air', NOW(), NOW(), NULL),
  ('18', '2', 'Ekonomi Syariah', NOW(), NOW(), NULL),
  ('19', '2', 'Ekonomi Digital', NOW(), NOW(), NULL),
  ('20', '2', 'Ekosistem Ekonomi Sirkular', NOW(), NOW(), NULL),
  ('21', '2', 'Pengelolaan Keanekaragaman Hayati Ekosistem, Spesies, dan Genetik', NOW(), NOW(), NULL),
  ('22', '2', 'Peningkatan Kualitas Lingkungan Hidup dan Tata Ruang', NOW(), NOW(), NULL),
  ('23', '2', 'Reformasi 02.18 Pengelolaan Sampah Terintegrasi dari Hulu ke Hilir', NOW(), NOW(), NULL),
  ('24', '2', 'Pembangunan Rendah Karbon', NOW(), NOW(), NULL),
  ('25', '2', 'Pekerjaan Hijau/Green Jobs', NOW(), NOW(), NULL),
  ('26', '2', 'Pengelolaan Hutan Lestari', NOW(), NOW(), NULL),
  ('27', '2', 'Pengembangan Ekonomi Biru sebagai Sumber Pertumbuhan. Baru', NOW(), NOW(), NULL),
  ('28', '3', 'Pengembangan Konektivitas dan Layanan Transportasi Multimoda', NOW(), NOW(), NULL),
  ('29', '3', 'Peningkatan Konektivitas Digital dan Transisi Energi Listrik', NOW(), NOW(), NULL),
  ('30', '3', 'Peningkatan Produktivitas UMKM dan Koperasi', NOW(), NOW(), NULL),
  ('31', '3', 'Pendalaman. Sektor Keuangan', NOW(), NOW(), NULL),
  ('32', '3', 'Pembangunan Pariwisata Berkualitas dan Berkelanjutan', NOW(), NOW(), NULL),
  ('33', '3', 'Penguatan Ekosistem Ekonomi Kreatif Berbasis Kekayaan Intelektual', NOW(), NOW(), NULL),
  ('34', '4', 'Percepatan Wajib Belajar 13 Tahun (1 Tahun Pendidikan Prasekolah dan 12 Tahun Pendidikan Dasar dan Pendidikan Menengah)', NOW(), NOW(), NULL),
  ('35', '4', 'Peningkatan Kualitas Pengajaran dan Pembelajaran', NOW(), NOW(), NULL),
  ('36', '4', 'Pemenuhan Layanan Pendidikan Pesantren dan. Pendidikan Keagamaan yang Berkualitas', NOW(), NOW(), NULL),
  ('37', '4', 'Penguatan Pengelolaan Pendidik dan Tenaga Kependidikan Berkualitas', NOW(), NOW(), NULL),
  ('38', '4', 'Penguatan Sistem Tata Kelola Pendidikan', NOW(), NOW(), NULL),
  ('39', '4', 'Penguatan Pendidikan Tinggi Berkualitas yang Merata dan Pengembangan Science, Technology, Engineering, Art, and Mathematics (STEAM)', NOW(), NOW(), NULL),
  ('40', '4', 'Penguatan Pendidikan dan Pelatihan Vokasi dan Produktivitas Tenaga Kerja', NOW(), NOW(), NULL),
  ('41', '4', 'Peningkatan Kontribusi Iptek dan Inovasi dalam Pembangunan Nasional', NOW(), NOW(), NULL),
  ('42', '4', 'Pengembangan Manajemen Talenta Nasional (MTN)', NOW(), NOW(), NULL),
  ('43', '4', 'Penguatan Budaya Literasi untuk Kreativitas dan Inovasi', NOW(), NOW(), NULL),
  ('44', '4', 'Peningkatan Kesehatan dan Gizi Masyarakat', NOW(), NOW(), NULL),
  ('45', '4', 'Pemberian Makan Gratis untuk Pemenuhan Gizi', NOW(), NOW(), NULL),
  ('46', '4', 'Pengendalian Penyakit dan Pembudayaan Hidup Sehat', NOW(), NOW(), NULL),
  ('47', '4', 'Penguatan Kapasitas Ketahanan Kesehatan', NOW(), NOW(), NULL),
  ('48', '4', 'Penguatan Pelayanan Kesehatan dan Tata Kelola', NOW(), NOW(), NULL),
  ('49', '4', 'Peningkatan Ketangguhan Keluarga', NOW(), NOW(), NULL),
  ('50', '4', 'Peningkatan Kualitas Perlindungan Anak', NOW(), NOW(), NULL),
  ('51', '4', 'Peningkatan Kualitas Pemuda', NOW(), NOW(), NULL),
  ('52', '4', 'Peningkatan Kesetaraan Gender, Pemberdayaan Perempuan, dan Perlindungan dari Kekerasan', NOW(), NOW(), NULL),
  ('53', '4', 'Peningkatan Kesetaraan dan Pemenuhan Hak Penyandang Disabilitas dan Lanjut Usia', NOW(), NOW(), NULL),
  ('54', '4', 'Peningkatan Pembinaan Prestasi Olahraga', NOW(), NOW(), NULL),
  ('55', '4', 'PP. Pengembangan Pembudayaan Olahraga yang Inklusif', NOW(), NOW(), NULL),
  ('56', '5', 'Pengembangan Hilirisasi Industri berbasis SDA Unggulan, Industri Padat Karya Terampil, Padat Teknologi Inovasi, serta Berorientasi Ekspor', NOW(), NOW(), NULL),
  ('57', '5', 'Pengembangan Aglomerasi Industri di KI/KEK Prioritas sebagai Pusat Pertumbuhan Baru', NOW(), NOW(), NULL),
  ('58', '5', 'Optimalisasi Backbone Integrasi Ekonomi dan Perkuatan Sistem Logistik Nasional', NOW(), NOW(), NULL),
  ('59', '5', 'Peningkatan Investasi untuk Integrasi Ekonomi Domestik dan Global', NOW(), NOW(), NULL),
  ('60', '5', 'Peningkatan Perdagangan Domestik, Antarwilayah, dan Ekspor serta Peningkatan Partisipasi dalam Rantai Nilai Global', NOW(), NOW(), NULL),
  ('61', '5', 'Optimalisasi Investasi Strategis Negara', NOW(), NOW(), NULL),
  ('62', '6', 'Sistem Pendataan Sosial Ekonomi Terintegrasi', NOW(), NOW(), NULL),
  ('63', '6', 'Perlindungan Sosial Adaptif dan Inklusif', NOW(), NOW(), NULL),
  ('64', '6', 'Peningkatan Akses Lapangan Kerja dan Penumbuhan Usaha Berkelanjutan dan Inovatif', NOW(), NOW(), NULL),
  ('65', '6', 'Pembangunan Perkotaan Berkelanjutan', NOW(), NOW(), NULL),
  ('66', '6', 'Pembangunan Ibu Kota Nusantara', NOW(), NOW(), NULL),
  ('67', '6', 'Percepatan Penyediaan Perumahan dan Permukiman', NOW(), NOW(), NULL),
  ('68', '6', 'Peningkatan Kemandirian Perdesaan yang Berkelanjutan', NOW(), NOW(), NULL),
  ('69', '7', 'Reformasi Politik dan Tata Kelola Pemilu', NOW(), NOW(), NULL),
  ('70', '7', 'Reformasi Hukum', NOW(), NOW(), NULL),
  ('71', '7', 'Penguatan Kelembagaan, Pelayanan dan Penegakan Hukum', NOW(), NOW(), NULL),
  ('72', '7', 'Transformasi Sistem Penuntutan dan Advocaat Generaal', NOW(), NOW(), NULL),
  ('73', '7', 'Pencegahan dan Pemberantasan Korupsi serta Tindak Pidana Pencucian Uang (TPPU', NOW(), NOW(), NULL),
  ('74', '7', 'Pencegahan, Pemberantasan Penyalahgunaan dan Peredaran Gelap Narkoba (P4GN)', NOW(), NOW(), NULL),
  ('75', '7', 'Penerapan Prinsip Meritokrasi dan Reformasi Manajemen ASN', NOW(), NOW(), NULL),
  ('76', '7', 'Transformasi Tata Kelola Pelayanan Publik dan Pembangunan', NOW(), NOW(), NULL),
  ('77', '7', 'Penataan Desentralisasi dan Otonomi Daerah', NOW(), NOW(), NULL),
  ('78', '7', 'Pemerintah Digital', NOW(), NOW(), NULL),
  ('79', '7', 'Peningkatan Produktivitas BUMN', NOW(), NOW(), NULL),
  ('80', '7', 'Optimalisasi Pendapatan Negara', NOW(), NOW(), NULL),
  ('81', '7', 'Optimalisasi Belanja Negara', NOW(), NOW(), NULL),
  ('82', '7', 'Perluasan Sumber dan Pengembangan Inovasi Pembiayaan', NOW(), NOW(), NULL),
  ('83', '7', 'Pengendalian Inflasi', NOW(), NOW(), NULL),
  ('84', '7', 'Pelindungan Warga Negara Indonesia di Luar Negeri, termasuk Pekerja Migran Indonesia', NOW(), NOW(), NULL),
  ('85', '8', 'Penguatan Kerukunan Umat Beragama dan Layanan Keagamaan Transformatif untuk Mewujudkan Kehidupan Beragama Maslahat', NOW(), NOW(), NULL),
  ('86', '8', 'Pelestarian dan Pemajuan Kebudayaan serta Penguatan Karakter Bangsa', NOW(), NOW(), NULL),
  ('87', '8', 'Pembangunan Berketahanan Iklim', NOW(), NOW(), NULL),
  ('88', '8', 'Pengelolaan Risiko Bencana yang Efisien dan Tepat Guna', NOW(), NOW(), NULL)
ON DUPLICATE KEY UPDATE `ProgramPrioritas` = VALUES(`ProgramPrioritas`);


-- ------------------------------------------------------------------------------
-- 5. MASTER AGENDA RPJMN (PN 1-8 dan PROGRAM PRIORITAS):
-- agendapn_rpjmn
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `agendapn_rpjmn` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `_Id` INT(11) NOT NULL DEFAULT 0,
  `Tipe` VARCHAR(10) NOT NULL DEFAULT 'PN',
  `Agenda` VARCHAR(100) DEFAULT NULL,
  `Uraian` TEXT NOT NULL,
  `Periode` VARCHAR(20) DEFAULT '2025-2029',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tambahkan kolom Agenda jika tabel di server sebelumnya dibuat tanpa kolom Agenda
SET @col_agenda_exists = (
  SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'agendapn_rpjmn' 
    AND COLUMN_NAME = 'Agenda'
);
SET @sql_add_agenda = IF(@col_agenda_exists = 0, 
  'ALTER TABLE `agendapn_rpjmn` ADD COLUMN `Agenda` VARCHAR(100) NULL AFTER `Tipe`', 
  'SELECT "Column Agenda already exists"'
);
PREPARE stmt_agenda FROM @sql_add_agenda;
EXECUTE stmt_agenda;
DEALLOCATE PREPARE stmt_agenda;

-- Master Prioritas Nasional (PN 1 s/d 8) - Gunakan kolom universal (Id, _Id, Tipe, Uraian, Periode)
INSERT INTO `agendapn_rpjmn` (`Id`, `_Id`, `Tipe`, `Uraian`, `Periode`)
VALUES
(1, 0, 'PN', 'Transformasi Sosial', '2025-2029'),
(2, 0, 'PN', 'Transformasi Ekonomi', '2025-2029'),
(3, 0, 'PN', 'Meningkatkan Sumber Daya Manusia yang Berkualitas dan Berdaya Saing', '2025-2029'),
(4, 0, 'PN', 'Pemantapan Ketahanan Ekonomi', '2025-2029'),
(5, 0, 'PN', 'Memantapkan Ketahanan Sosial Budaya dan Ekologi', '2025-2029'),
(6, 0, 'PN', 'Membangun Kewilayahan yang Merata dan Berkeadilan', '2025-2029'),
(7, 0, 'PN', 'Penguatan Stabilitas Polhukhankam dan Transformasi Pelayanan Publik', '2025-2029'),
(8, 0, 'PN', 'Kesinambungan Pembangunan Nasional', '2025-2029')
ON DUPLICATE KEY UPDATE 
  `Uraian` = VALUES(`Uraian`),
  `Periode` = VALUES(`Periode`);

-- Master Program Prioritas (PP) untuk masing-masing PN
INSERT INTO `agendapn_rpjmn` (`Id`, `_Id`, `Tipe`, `Uraian`, `Periode`)
VALUES
(108, 1, 'PP', 'Pengentasan Kemiskinan Ekstrem', '2025-2029'),
(1021, 2, 'PP', 'Peningkatan Investasi', '2025-2029'),
(101, 3, 'PP', 'Pengendalian Penduduk dan Penguatan Tata Kelola Kependudukan', '2025-2029'),
(102, 3, 'PP', 'Peningkatan Perlindungan Sosial', '2025-2029'),
(103, 4, 'PP', 'Peningkatan Produktivitas Pertanian', '2025-2029'),
(104, 4, 'PP', 'Penguatan Industri Pengolahan', '2025-2029'),
(105, 5, 'PP', 'Memantapkan Ketahanan Sosial Budaya dan Ekologi', '2025-2029'),
(1063, 6, 'PP', 'Pengembangan Wilayah Terpadu', '2025-2029'),
(1075, 7, 'PP', 'Reformasi Kelembagaan dan Birokrasi', '2025-2029'),
(1085, 8, 'PP', 'Penuntasan Proyek Strategis', '2025-2029')
ON DUPLICATE KEY UPDATE 
  `Uraian` = VALUES(`Uraian`),
  `Periode` = VALUES(`Periode`);

-- Update label Agenda jika kolom Agenda ada di tabel
SET @sql_upd_agenda = IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'agendapn_rpjmn' AND COLUMN_NAME = 'Agenda') > 0,
  'UPDATE `agendapn_rpjmn` SET `Agenda` = CASE 
     WHEN `Id` = 1 THEN "PN 1"
     WHEN `Id` = 2 THEN "PN 2"
     WHEN `Id` = 3 THEN "PN 3"
     WHEN `Id` = 4 THEN "PN 4"
     WHEN `Id` = 5 THEN "PN 5"
     WHEN `Id` = 6 THEN "PN 6"
     WHEN `Id` = 7 THEN "PN 7"
     WHEN `Id` = 8 THEN "PN 8"
     WHEN `Id` = 101 THEN "PP 1"
     WHEN `Id` = 102 THEN "PP 2"
     WHEN `Id` = 103 THEN "PP 3"
     WHEN `Id` = 104 THEN "PP 4"
     WHEN `Id` = 105 THEN "PP 5"
     WHEN `Id` = 108 THEN "PP 8"
     WHEN `Id` = 1021 THEN "PP 1"
     WHEN `Id` = 1063 THEN "PP 3"
     WHEN `Id` = 1075 THEN "PP 5"
     WHEN `Id` = 1085 THEN "PP 5"
     ELSE `Agenda`
   END
   WHERE `deleted_at` IS NULL',
  'SELECT "Skip update agenda"'
);
PREPARE stmt_upd_agenda FROM @sql_upd_agenda;
EXECUTE stmt_upd_agenda;
DEALLOCATE PREPARE stmt_upd_agenda;


-- ------------------------------------------------------------------------------
-- 6. INDIKATOR MAKRO PEMBANGUNAN RPJMN (Poin 1.a.1.a, 1.a.3.a, 1.a.3.b):
-- indikator_pembangunan_rpjmn
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `indikator_pembangunan_rpjmn` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `_Id` INT(11) DEFAULT 1,
  `IndikatorPembangunan` VARCHAR(255) NOT NULL,
  `Satuan` VARCHAR(50) DEFAULT NULL,
  `Baseline` VARCHAR(50) DEFAULT NULL,
  `TargetAwal` VARCHAR(50) DEFAULT NULL,
  `TargetAkhir` VARCHAR(50) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Pertumbuhan Ekonomi (LPE): Baseline 5.05, Target Akhir 8.00
UPDATE `indikator_pembangunan_rpjmn` 
SET `Baseline` = '5.05', `TargetAkhir` = '8.00', `updated_at` = NOW()
WHERE (LOWER(`IndikatorPembangunan`) LIKE '%pertumbuhan ekonomi%' OR LOWER(`IndikatorPembangunan`) LIKE '%lpe%')
  AND `deleted_at` IS NULL;

-- Tingkat Kemiskinan: Baseline 9.03, Target Akhir 5.00
UPDATE `indikator_pembangunan_rpjmn` 
SET `Baseline` = '9.03', `TargetAkhir` = '5.00', `updated_at` = NOW()
WHERE (LOWER(`IndikatorPembangunan`) LIKE '%kemiskinan%' OR LOWER(`IndikatorPembangunan`) LIKE '%miskin%')
  AND LOWER(`IndikatorPembangunan`) NOT LIKE '%keparahan%'
  AND `deleted_at` IS NULL;

-- Tingkat Pengangguran Terbuka (TPT): Baseline 4.91, Target Akhir 4.71
-- Update jika sudah ada
UPDATE `indikator_pembangunan_rpjmn` 
SET `Baseline` = '4.91', `TargetAkhir` = '4.71', `updated_at` = NOW()
WHERE (LOWER(`IndikatorPembangunan`) LIKE '%pengangguran%' OR LOWER(`IndikatorPembangunan`) LIKE '%tpt%')
  AND `deleted_at` IS NULL;

-- Insert Tingkat Pengangguran Terbuka jika belum ada sama sekali
INSERT INTO `indikator_pembangunan_rpjmn` (`IndikatorPembangunan`, `Satuan`, `Baseline`, `TargetAwal`, `TargetAkhir`, `created_at`, `updated_at`)
SELECT 'Tingkat Pengangguran Terbuka', 'Persen', '4.91', '5.0', '4.71', NOW(), NOW()
WHERE NOT EXISTS (
  SELECT 1 FROM `indikator_pembangunan_rpjmn` 
  WHERE (LOWER(`IndikatorPembangunan`) LIKE '%pengangguran%' OR LOWER(`IndikatorPembangunan`) LIKE '%tpt%')
    AND `deleted_at` IS NULL
);


-- ------------------------------------------------------------------------------
-- 7. SEED DATA PENILAIAN IPPD AWAL TAHUN 2026:
-- Memastikan seluruh 26 poin evaluasi memiliki nilai dasar yang dapat dikalkulasi
-- ------------------------------------------------------------------------------
INSERT INTO `ippd_penilaian` (`kodewilayah`, `instansi_id`, `tahun`, `item_code`, `bobot_capaian`, `opsi_aksi`, `catatan`, `created_at`, `updated_at`)
VALUES
('35.12', 1, 2026, '1.a.1.a', 0.500, 'Memenuhi Sepenuhnya', 'Tersedia dokumen matrik penyelarasan sasaran makro RPJMD dengan RPJMN', NOW(), NOW()),
('35.12', 1, 2026, '1.a.1.b', 0.500, 'Memenuhi Sepenuhnya', 'Tabel persandingan target makro tersedia pada Bab IV dokumen RPJMD', NOW(), NOW()),
('35.12', 1, 2026, '1.a.1.c', 0.500, 'Memenuhi Sepenuhnya', 'Misi RPJMD telah diselaraskan dengan Prioritas Nasional RPJMN', NOW(), NOW()),
('35.12', 1, 2026, '1.a.1.d', 0.500, 'Memenuhi Sepenuhnya', 'Tersedia tabel keterpaduan sasaran dan isu strategis', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.a', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 1', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.b', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 2', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.c', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 3', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.d', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 4', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.e', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 5', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.f', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 6', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.g', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 7', NOW(), NOW()),
('35.12', 1, 2026, '1.a.2.h', 1.000, 'Memenuhi Sepenuhnya', 'Program prioritas daerah selaras dengan Prioritas Nasional 8', NOW(), NOW()),
('35.12', 1, 2026, '1.a.3.a', 1.000, 'Memenuhi Sepenuhnya', 'Target Tingkat Pengangguran Terbuka (TPT) selaras dengan target nasional', NOW(), NOW()),
('35.12', 1, 2026, '1.a.3.b', 1.000, 'Memenuhi Sepenuhnya', 'Target Tingkat Kemiskinan daerah selaras dengan target nasional', NOW(), NOW()),
('35.12', 1, 2026, '1.a.4',   1.000, 'Memenuhi Sepenuhnya', 'Proyek strategis daerah mendukung proyek prioritas nasional', NOW(), NOW()),
('35.12', 1, 2026, '1.a.5',   1.000, 'Memenuhi Sepenuhnya', 'Target pelayanan dasar selaras dengan 6 Standar Pelayanan Minimal (SPM)', NOW(), NOW()),
('35.12', 1, 2026, '1.a.6',   1.000, 'Memenuhi Sepenuhnya', 'Target pencapaian SPM ditetapkan 100% pada tahun berkenaan', NOW(), NOW()),
('35.12', 1, 2026, '1.b.1',   3.000, 'Memenuhi Sepenuhnya', 'Penerapan tata kelola perencanaan daerah berbasis sistem informasi terintegrasi', NOW(), NOW()),
('35.12', 1, 2026, '1.c.1',  10.000, 'Memenuhi Sepenuhnya', 'Alokasi anggaran program prioritas nasional tersedia secara memadai dalam APBD', NOW(), NOW()),
('35.12', 1, 2026, '2.a.1',   4.500, 'Memenuhi Sepenuhnya', 'Analisis keterkaitan kondisi eksisting dan proyeksi kebutuhan pembangunan daerah jelas', NOW(), NOW()),
('35.12', 1, 2026, '2.a.2',   4.500, 'Memenuhi Sepenuhnya', 'Skenario kebijakan pembangunan daerah komprehensif', NOW(), NOW()),
('35.12', 1, 2026, '2.b.1',   4.500, 'Memenuhi Sepenuhnya', 'Program unggulan langsung mengintervensi isu kemiskinan dan ketimpangan', NOW(), NOW()),
('35.12', 1, 2026, '2.b.2',   4.500, 'Memenuhi Sepenuhnya', 'Keterkaitan logis antara output dan outcome terukur jelas', NOW(), NOW()),
('35.12', 1, 2026, '3.d.1',   3.000, 'Memenuhi Sepenuhnya', 'Laporan evaluasi RKPD disusun tepat waktu dan dipublikasikan', NOW(), NOW()),
('35.12', 1, 2026, '3.e.1',   2.000, 'Memenuhi Sepenuhnya', 'Rekomendasi hasil evaluasi ditindaklanjuti dalam penyusunan perencanaan periode berikutnya', NOW(), NOW()),
('35.12', 1, 2026, '3.e.2',   2.000, 'Memenuhi Sepenuhnya', 'Tingkat capaian kinerja program daerah mencapai kategori sangat tinggi', NOW(), NOW())
ON DUPLICATE KEY UPDATE 
  `bobot_capaian` = VALUES(`bobot_capaian`),
  `opsi_aksi` = VALUES(`opsi_aksi`),
  `catatan` = VALUES(`catatan`),
  `updated_at` = NOW();

-- ------------------------------------------------------------------------------
-- 6. TABEL DUKUNGAN KEGIATAN PRIORITAS UTAMA RPJMD (Menu Daerah/DukunganKegiatanPrioritas)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpjmn_kpu_prioritas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Kode` varchar(50) DEFAULT NULL,
  `PrioritasPembangunan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `rpjmn_kpu_prioritas` (`Id`, `Kode`, `PrioritasPembangunan`) VALUES
(1, 'PN 1', 'Memperkokoh Ideologi Pancasila, Demokrasi, dan Hak Asasi Manusia'),
(2, 'PN 2', 'Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru'),
(3, 'PN 3', 'Melanjutkan Pengembangan Infrastruktur dan Meningkatkan Lapangan Kerja yang Berkualitas, Mendorong Kewirausahaan, Mengembangkan Industri Kreatif serta Mengembangkan Agromaritim Industri di Sentra Produksi melalui Peran Aktif Koperasi'),
(4, 'PN 4', 'Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, Serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi Z), dan Penyandang Disabilitas'),
(5, 'PN 5', 'Melanjutkan Hilirisasi dan Mengembangkan Industri Berbasis Sumber Daya Alam untuk Meningkatkan Nilai Tambah di Dalam Negeri'),
(6, 'PN 6', 'Membangun dari Desa dan dari Bawah untuk Pertumbuhan Ekonomi, Pemerataan Ekonomi, dan Pemberantasan Kemiskinan'),
(7, 'PN 7', 'Memperkuat Reformasi Politik, Hukum, dan Birokrasi, serta Memperkuat Pencegahan dan Pemberantasan Korupsi, Narkoba, Judi, dan Penyelundupan'),
(8, 'PN 8', 'Memperkuat Penyelarasan Kehidupan yang Harmonis dengan Lingkungan Alam dan Budaya, serta Peningkatan Toleransi Antarumat Beragama untuk Mencapai Masyarakat yang Adil dan Makmur')
ON DUPLICATE KEY UPDATE 
  `Kode` = VALUES(`Kode`),
  `PrioritasPembangunan` = VALUES(`PrioritasPembangunan`);

CREATE TABLE IF NOT EXISTS `rpjmn_kpu_kegiatan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `_Id` int(11) NOT NULL,
  `Kode` varchar(50) DEFAULT NULL,
  `KegiatanPrioritas` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `idx_prioritas` (`_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `dukungan_kpu_rpjmd` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `KodeWilayah` varchar(50) NOT NULL,
  `PrioritasId` int(11) NOT NULL,
  `KegiatanId` int(11) NOT NULL,
  `KodeProgram` text NOT NULL,
  `NamaProgram` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `idx_kodewilayah` (`KodeWilayah`),
  KEY `idx_prioritas` (`PrioritasId`),
  KEY `idx_kegiatan` (`KegiatanId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

