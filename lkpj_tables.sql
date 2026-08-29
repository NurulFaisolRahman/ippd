-- ====================================================================
-- MIGRATION: 4 TABEL E-LKPJ (Perangkat Daerah)
-- ====================================================================

-- 1. TABEL KEBIJAKAN STRATEGIS
CREATE TABLE IF NOT EXISTS `lkpj_kebijakan_strategis` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2026,
  `kebijakan_strategis` TEXT NOT NULL,
  `dasar_hukum` TEXT NOT NULL,
  `tujuan_masalah` TEXT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_ks_filter` (`tahun`, `instansi_id`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data Kebijakan Strategis
INSERT INTO `lkpj_kebijakan_strategis` (`id`, `kodewilayah`, `instansi_id`, `tahun`, `kebijakan_strategis`, `dasar_hukum`, `tujuan_masalah`, `created_at`, `updated_at`, `deleted_at`)
VALUES
(1, '35.12', 1, 2026,
 'Rencana Pembangunan Jangka Menengah Daerah Kabupaten Situbondo Tahun 2025-2029',
 'Peraturan Daerah Nomor 6 Tahun 2025 Tentang Rencana Pembangunan Jangka Menengah Daerah Kabupaten Situbondo Tahun 2025-2029',
 'Penyusunan Rencana Pembangunan Jangka Menengah Daerah (RPJMD) Kabupaten Situbondo Tahun 2025-2029 merupakan langkah strategis untuk mengatasi berbagai persoalan mendasar, mulai dari upaya pemulihan ekonomi pasca-pandemi, pengentasan kemiskinan dan pengangguran, hingga peningkatan kualitas sumber daya manusia yang fokus pada kenaikan Indeks Pembangunan Manusia (IPM) serta penurunan angka stunting. Dengan mengusung visi "Situbondo Naik Kelas", RPJMD ini bertujuan untuk menjabarkan visi dan misi kepala daerah ke dalam target pembangunan yang terukur, menjamin konsistensi perencanaan antara pusat dan daerah, serta menjadi pedoman kerja bagi seluruh perangkat daerah dalam menyusun rencana strategis yang sinkron. Pada akhirnya, dokumen ini berfungsi sebagai instrumen koordinasi antar-pelaku pembangunan dan alat evaluasi kinerja yang akuntabel untuk mewujudkan kemajuan Kabupaten Situbondo',
 NOW(), NOW(), NULL),
(2, '35.12', 1, 2026,
 'Rencana Induk Dan Peta Jalan Pemajuan Ilmu Pengetahuan Dan Teknologi Daerah Kabupaten Situbondo Tahun 2025-2029',
 'Peraturan Bupati Nomor 61 Tahun 2025 Tentang Rencana Induk Dan Peta Jalan Pemajuan Ilmu Pengetahuan Dan Teknologi Daerah Kabupaten Situbondo Tahun 2025-2029',
 'Tujuan penyusunan dokumen ini adalah untuk mewujudkan keterpaduan, keberlanjutan, dan ketepatan sasaran dalam memberikan rekomendasi kebijakan bagi pemerintah daerah. Secara lebih spesifik, dokumen ini berfungsi untuk mengidentifikasi data dan informasi mengenai riset serta inovasi di Kabupaten Situbondo, merumuskan tema-tema prioritas riset dan inovasi, serta menganalisis tantangan, peluang, dan kesenjangan kebijakan berbasis bukti di daerah. Selain itu, RIPJPID bertujuan untuk merumuskan strategi riset dan inovasi yang aplikatif serta menetapkan peta jalan program kegiatan prioritas yang relevan, terpadu, dan selaras dengan Rencana Pembangunan Jangka Menengah Daerah (RPJMD) Kabupaten Situbondo periode 2025-2029.',
 NOW(), NOW(), NULL),
(3, '35.12', 1, 2026,
 'Tim Koordinasi pengembangan Inovasi dan Teknologi Kabupaten Situbondo',
 'Keputusan Bupati Situbondo NOMOR: 100.3.3.2/252/431.013/2025 Tentang TIM KOORDINASI PENGEMBANGAN INOVASI DAN TEKNOLOGI KABUPATEN SITUBONDO',
 'Pengembangan Inovasi dan Teknologi Kabupaten Situbondo dalam rangka memotivasi dan meningkatkan inovasi serta kreativitas perangkat daerah di lingkungan Pemerintah Kabupaten Situbondo dalam memberikan pelayanan publik,',
 NOW(), NOW(), NULL)
ON DUPLICATE KEY UPDATE `kebijakan_strategis`=VALUES(`kebijakan_strategis`);


-- 2. TABEL CAPAIAN PROGRAM KEGIATAN
CREATE TABLE IF NOT EXISTS `lkpj_capaian_program_kegiatan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2026,
  `urusan` VARCHAR(255) DEFAULT 'Perencanaan',
  `kebijakan` TEXT NOT NULL,
  `tipe` ENUM('program','kegiatan') NOT NULL DEFAULT 'kegiatan',
  `parent_id` INT(11) DEFAULT NULL,
  `uraian` TEXT NOT NULL,
  `indikator` TEXT DEFAULT NULL,
  `satuan` VARCHAR(50) DEFAULT NULL,
  `target` DECIMAL(14,2) DEFAULT 0.00,
  `realisasi` DECIMAL(14,2) DEFAULT 0.00,
  `capaian` DECIMAL(8,2) DEFAULT 0.00,
  `anggaran` DECIMAL(20,2) DEFAULT 0.00,
  `realisasi_anggaran` DECIMAL(20,2) DEFAULT 0.00,
  `capaian_anggaran` DECIMAL(8,2) DEFAULT 0.00,
  `permasalahan` TEXT DEFAULT NULL,
  `upaya` TEXT DEFAULT NULL,
  `tinjut` TEXT DEFAULT NULL,
  `urutan` INT(11) DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_cpk_filter` (`tahun`, `urusan`, `instansi_id`, `deleted_at`),
  INDEX `idx_cpk_parent` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data Capaian Program Kegiatan
INSERT INTO `lkpj_capaian_program_kegiatan` 
(`id`, `kodewilayah`, `instansi_id`, `tahun`, `urusan`, `kebijakan`, `tipe`, `parent_id`, `uraian`, `indikator`, `satuan`, `target`, `realisasi`, `capaian`, `anggaran`, `realisasi_anggaran`, `capaian_anggaran`, `permasalahan`, `upaya`, `tinjut`, `urutan`, `created_at`, `updated_at`, `deleted_at`)
VALUES
(1, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'program', NULL,
 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA',
 'Capaian Nilai SAKIP Perangkat Daerah',
 'Nilai', 88.60, 85.41, 96.40,
 6764342774.00, 6448530934.00, 95.33,
 'Capaian nilai SAKIP 2025 (85.41) A turun terhadap capaian SAKIP tahun 2024 (88,5) A, penyebab turunnya nilai SAKIP diantaranya dikarenakan Terdapat capaian kinerja sasaran tahun 2024 yang lebih rendah dari 80%, meskipun secara rata-rata capaian indikator sasaran masih sebesar 95%. berikutnya laporan Monitoring dan Evaluasi per triwulan telah disusun namun belum tercermin keterkaitan/ keterhubungan antar laporan Monev yang telah disusun dan tidak terdapat saran serta rekomendasi dari atasan langsung.',
 'Melaksanakan Koordinasi untuk meningkatkan capaian kinerja dengan lebih intensif serta seluruh Sekretariat dan bidang Menyusun laporan monitoring dan evaluasi tiap triwulan dengan menjamin keterhubungan dan keterkaitan antar laporan, serta memberikan tanggapan pimpinan langsung pada laporan monev.',
 '', 1, NOW(), NOW(), NULL),

(2, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah',
 'Jumlah Dokumen Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah yang disusun dengan baik',
 'Dokumen', 10.00, 10.00, 100.00,
 100435441.00, 97600775.00, 97.18,
 'Rencana aksi pada kegiatan Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah telah terlaksana dengan baik. namun dalam aktivitas perencanaan terdapat kendala dalam penyusunan Manajemen Risiko dan Fraud Control Plan tahun 2025 yang kurang mengoptimalkan peran setiap bidang.',
 'Optimalisasi koordinasi dan peran bidang dalam penyusunan MR dan FCP tahun 2026.',
 '', 2, NOW(), NOW(), NULL),

(3, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Administrasi Keuangan Perangkat Daerah',
 'Prosentase Administrasi Keuangan Perangkat Daerah yang disusun dengan baik',
 '%', 100.00, 100.00, 100.00,
 3668362163.00, 3545545120.00, 96.65,
 'Pelaksanaan administrasi keuangan telah berjalan dengan baik, namun SIPD penatausahaan sering mengalami gangguan, sehingga proses administrasi keuangan sering terganggu.',
 'Koordinasi dengan helpdesk perbendaharaan.',
 '', 3, NOW(), NOW(), NULL),

(4, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Administrasi Barang Milik Daerah pada Perangkat Daerah',
 'Jumlah Dokumen Administrasi Barang Milik Daerah pada Perangkat Daerah yang disusun dengan baik',
 'Dokumen', 2.00, 2.00, 100.00,
 12337135.00, 11867450.00, 96.19,
 'Penghapusan aset masih belum terlaksana sehingga banyak aset yang manfaatnya berkurang dan menumpuk pada gudang, administrasi pengajuan penghapusan telah tersampaikan dengan baik.',
 'Meningkatkan koordinasi dengan bagian Aset BKAD.',
 '', 4, NOW(), NOW(), NULL),

(5, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Administrasi Kepegawaian Perangkat Daerah',
 'Prosentase Administrasi Kepegawaian Perangkat Daerah dengan baik',
 '%', 100.00, 100.00, 100.00,
 118744545.00, 82390723.00, 69.38,
 'Anggaran sub kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi tidak terserap, dikarenakan pada tahun 2025 Pusbindiklatren tidak mengadakan Pelatihan Fungsional Perencana Ahli Pertama, sehingga anggaran yang disediakan untuk 2 orang Fungsional Perencana Ahli Pertama tidak dapat direalisasikan.',
 'Meningkatkan pencermatan terhadap anggaran pada perubahan APBD sehingga anggaran yang berpotensi tidak terserap dapat dialokasikan untuk kegiatan lain.',
 '', 5, NOW(), NOW(), NULL),

(6, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Administrasi Umum Perangkat Daerah',
 'Prosentase Administrasi Umum Perangkat Daerah yang dilaksanakan',
 '%', 100.00, 100.00, 100.00,
 657547623.00, 620009486.00, 94.29,
 'Kegiatan telah berjalan dengan baik, namun terdapat kendala dalam melaksanakan aktivitas administrasi berkas yang sudah diarsipkan belum sepenuhnya teregister pada register arsip dinamis.',
 'Memasukkan setiap berkas ke dalam register arsip sebelum dimasukkan dalam box arsip untuk memudahkan masuk dalam register pada register arsip dinamis.',
 '', 6, NOW(), NOW(), NULL),

(7, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah',
 'Prosentase Pengadaan Barang Milik Daerah Penunjang Urusan Pemerintah Daerah yang diadakan',
 '%', 100.00, 100.00, 100.00,
 220150290.00, 193886308.00, 88.07,
 'Mencari pembanding yang sesuai untuk pengajuan e-purchasing sangat sulit karena barang yang dibutuhkan tidak seluruhnya tersedia oleh marketplace, sehingga anggaran tidak seluruhnya terserap.',
 'dalam menyusun RKA dan DPA akan dioptimalkan dengan mencari barang yang umum di pasaran.',
 '', 7, NOW(), NOW(), NULL),

(8, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah',
 'Prosentase Penyediaan Jasa Penunjang Urusan Pemerintahan Daerah yang diadakan',
 '%', 100.00, 100.00, 100.00,
 1341769077.00, 1296263252.00, 96.61,
 'Kegiatan telah berjalan dengan baik, namun dalam melaksanakan aktivitas masih terdapat surat masuk dan keluar yang belum terinput pada aplikasi e-agenda.',
 'Melakukan kontrol terhadap setiap surat masuk dan keluar serta langsung menginput pada aplikasi e-agenda.',
 '', 8, NOW(), NOW(), NULL),

(9, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah',
 'Prosentase Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah yang diadakan',
 '%', 100.00, 100.00, 100.00,
 440396500.00, 407833008.00, 92.61,
 'Melaksanakan aktivitas kegiatan Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah terdapat kendala banyaknya barang yang perlu dirawat / service.',
 'Melakukan pendataan barang-barang yang perlu perawatan / service.',
 '', 9, NOW(), NOW(), NULL),

(10, '35.12', 1, 2026, 'Perencanaan',
 'Meningkatnya Kualitas Perencanaan Pembangunan Daerah',
 'kegiatan', 1,
 'Penataan Organisasi',
 'Prosentase Manajemen Resiko yang disusun',
 '%', 100.00, 100.00, 100.00,
 204600000.00, 193134812.00, 94.40,
 'Rencana aksi pada kegiatan penataan organisasi telah terlaksana dengan baik. namun dalam aktivitas, terdapat kendala sempitnya waktu penyusunan Manajemen Resiko Kabupaten Situbondo tahun 2026, dimana dokumen dapat disusun, setelah RPJMD dan RKPD ditetapkan.',
 'Menyusun time schedule monev MR Kabupaten Situbondo tahun 2026 dan penyusunan MR Kabupaten Situbondo tahun 2027 dengan lebih optimal.',
 '', 10, NOW(), NOW(), NULL)
ON DUPLICATE KEY UPDATE `uraian`=VALUES(`uraian`);


-- 3. TABEL TINJUT REKOMENDASI DPRD N-1
CREATE TABLE IF NOT EXISTS `lkpj_tinjut_rekomendasi_dprd` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2026,
  `rekomendasi` TEXT NOT NULL,
  `tindak_lanjut` TEXT DEFAULT NULL,
  `tujuan_masalah` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_tr_filter` (`tahun`, `instansi_id`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data Tinjut Rekomendasi DPRD
INSERT INTO `lkpj_tinjut_rekomendasi_dprd` (`id`, `kodewilayah`, `instansi_id`, `tahun`, `rekomendasi`, `tindak_lanjut`, `tujuan_masalah`, `created_at`, `updated_at`, `deleted_at`)
VALUES
(1, '35.12', 1, 2026,
 'Terhadap kegiatan intervensi untuk menekan tingkat ketimpangan ekonomi, tentunya patut direkomendasikan dilakukan evaluasi pada setiap sector/cluster kebijakan strategis, agar dicapai kegiatan maupun kebijakan inovatif yang berfokus pada penurunan ketimpangan ekonomi, dengan memperhatikan Kebijakan inovatif yang mengintegrasikan program prioritas Kabupaten, Provinsi dan Nasional.',
 'dalam rangka menekan tingkat ketimpangan dan meningkatkan Pertumbuhan Ekonomi di Kabupaten Situbondo maka telah dirumuskan program prioritas daerah dalam Arah Kebijakan di RPJMD Pemerintah Kabupaten Situbondo',
 'meningkatkan pertumbuhan ekonomi dan mengendalikan gini rasio di Kabupaten Situbondo',
 NOW(), NOW(), NULL),
(2, '35.12', 1, 2026,
 'Bahwa dalam rangka mewujudkan pertumbuhan ekonomi Situbondo yang inklusif, penting untuk direkomendasikan adanya pertumbuhan pada sektor- sektor kerakyatan yang dominan menyerap tenaga kerja, seperti pertanian dan kehutanan dan perikanan dengan strategi kebijakan yang progresif (intensifikasi dan ekstensifikasi produksi, pemasaran, teknologi, pemberdayaan penyuluh, sarana irigasi, aplikasi pertanian organic).',
 'Pemerintah Kabupaten Situbondo akan terus memperkuat Branding “Kabupaten UMKM untuk memperkuat pemasaran produk –produk UMKM di seluruh sektor (pertanian, peternakan ) karena hal ini akan mampu meningkatkan serapan tenaga kerja, meningkatkan produksi, dan kesejahteraan masyarakat',
 'meningkatkan serapan tenaga kerja, meningkatkan produksi, dan kesejahteraan masyarakat',
 NOW(), NOW(), NULL)
ON DUPLICATE KEY UPDATE `rekomendasi`=VALUES(`rekomendasi`);


-- 4. TABEL CAPAIAN KINERJA PELAKSANAAN TUGAS PEMBANTUAN
CREATE TABLE IF NOT EXISTS `lkpj_tugas_pembantuan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2026,
  `dasar_penugasan` TEXT NOT NULL,
  `instansi_pemberi` VARCHAR(255) NOT NULL,
  `program` VARCHAR(255) NOT NULL,
  `kegiatan_output` TEXT NOT NULL,
  `lokasi` VARCHAR(255) NOT NULL,
  `satuan_unit` VARCHAR(50) NOT NULL,
  `pagu` DECIMAL(20,2) NOT NULL DEFAULT 0.00,
  `realisasi` DECIMAL(20,2) NOT NULL DEFAULT 0.00,
  `sumber_dana` VARCHAR(100) NOT NULL,
  `capaian` DECIMAL(8,2) NOT NULL DEFAULT 0.00,
  `permasalahan` TEXT DEFAULT NULL,
  `solusi` TEXT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_tp_filter` (`tahun`, `instansi_id`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data Tugas Pembantuan
INSERT INTO `lkpj_tugas_pembantuan` 
(`id`, `kodewilayah`, `instansi_id`, `tahun`, `dasar_penugasan`, `instansi_pemberi`, `program`, `kegiatan_output`, `lokasi`, `satuan_unit`, `pagu`, `realisasi`, `sumber_dana`, `capaian`, `permasalahan`, `solusi`, `created_at`, `updated_at`, `deleted_at`)
VALUES
(1, '35.12', 1, 2026,
 'Perjanjian Kerjasama BNPB dengan BPBD Kabupaten Situbondo Nomor: 34/BNPB/SU/KS.01.01/07/2025',
 'Badan Nasional Penanggulangan Bencana',
 'Program Penanggulangan Bencana',
 '❖ Output Tersedianya sarana air bersih berupa sumur bor yang berfungsi dengan baik di Desa Tlogosari dan Desa Plalangan Kecamatan Sumbermalang, lengkap dengan fasilitas pendukung, sehingga dapat dimanfaatkan oleh masyarakat sebagai sumber air bersih pada wilayah rawan kekeringan.\n❖ Outcome Meningkatnya akses dan ketersediaan air bersih bagi masyarakat Kecamatan Sumbermalang, berkurangnya dampak kekeringan terhadap kebutuhan dasar rumah tangga, serta meningkatnya ketahanan masyarakat dalam menghadapi bencana kekeringan secara berkelanjutan.',
 'Kecamatan Sumbermalang, Kabupaten Situbondo',
 '2 Unit',
 965207000.00, 907828000.00,
 'DIPA BNPB TA 2025', 94.06,
 'Secara khusus, beberapa kendala yang dihadapi antara lain kondisi geografis dan topografi wilayah yang berbukit serta bebatuan, sehingga menyulitkan proses pengeboran dan pekerjaan konstruksi di lapangan. Selain itu, keterbatasan akses menuju lokasi pekerjaan juga menjadi hambatan tersendiri, baik dalam mobilisasi peralatan maupun distribusi material, yang pada akhirnya berdampak pada efisiensi pelaksanaan kegiatan.',
 'Sebagai upaya penyelesaian permasalahan tersebut, dilakukan penyesuaian metode serta spesifikasi teknis pengeboran dengan menyesuaikan karakteristik geologi setempat, yaitu melalui penggunaan metode DTH (Down-the-Hole). Metode ini dinilai lebih tepat untuk kondisi tanah berbukit dan bebatuan karena memiliki kemampuan penetrasi yang lebih optimal, sehingga proses pengeboran dapat berjalan lebih efektif dan meminimalkan hambatan teknis di lapangan.',
 NOW(), NOW(), NULL)
ON DUPLICATE KEY UPDATE `dasar_penugasan`=VALUES(`dasar_penugasan`);
