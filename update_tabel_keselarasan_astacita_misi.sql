-- Tabel Keselarasan Asta Cita dan Misi Provinsi / Daerah
CREATE TABLE IF NOT EXISTS `keselarasan_astacita_misi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_wilayah` varchar(10) NOT NULL,
  `id_prioritas_nasional` int(11) NOT NULL,
  `id_misi_provinsi` text NULL,
  `misi_provinsi_text` text NULL,
  `id_misi_daerah` text NULL,
  `misi_daerah_text` text NULL,
  `tahun_mulai` int(4) NULL,
  `tahun_akhir` int(4) NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_kode_wilayah` (`kode_wilayah`),
  KEY `idx_pn` (`id_prioritas_nasional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
