-- ============================================================
-- TABEL INDIKATOR TUJUAN RENSTRA PD
-- ============================================================
CREATE TABLE IF NOT EXISTS `renstra_tujuan_indikator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tujuan_id` int(11) NOT NULL,
  `perangkat_daerah_id` int(11) DEFAULT NULL,
  `indikator` text DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `kondisi_awal` varchar(255) DEFAULT NULL,
  `target_2025` varchar(255) DEFAULT NULL,
  `target_2026` varchar(255) DEFAULT NULL,
  `target_2027` varchar(255) DEFAULT NULL,
  `target_2028` varchar(255) DEFAULT NULL,
  `target_2029` varchar(255) DEFAULT NULL,
  `target_2030` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 10,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tujuan_id` (`tujuan_id`),
  KEY `idx_perangkat_daerah_id` (`perangkat_daerah_id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- TABEL INDIKATOR SASARAN RENSTRA PD
-- ============================================================
CREATE TABLE IF NOT EXISTS `renstra_sasaran_indikator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sasaran_id` int(11) NOT NULL,
  `perangkat_daerah_id` int(11) DEFAULT NULL,
  `indikator` text DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `kondisi_awal` varchar(255) DEFAULT NULL,
  `target_2025` varchar(255) DEFAULT NULL,
  `target_2026` varchar(255) DEFAULT NULL,
  `target_2027` varchar(255) DEFAULT NULL,
  `target_2028` varchar(255) DEFAULT NULL,
  `target_2029` varchar(255) DEFAULT NULL,
  `target_2030` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 10,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sasaran_id` (`sasaran_id`),
  KEY `idx_perangkat_daerah_id` (`perangkat_daerah_id`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
