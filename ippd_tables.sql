-- ================================================================
-- TABEL INDEKS PERENCANAAN PEMBANGUNAN DAERAH (IPPD)
-- ================================================================

CREATE TABLE IF NOT EXISTS `ippd_penilaian` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kodewilayah` VARCHAR(20) DEFAULT '35.12',
  `instansi_id` INT(11) DEFAULT 1,
  `tahun` INT(4) NOT NULL DEFAULT 2026,
  `item_code` VARCHAR(50) NOT NULL,
  `bobot_capaian` DECIMAL(8,3) DEFAULT NULL,
  `opsi_aksi` VARCHAR(255) DEFAULT NULL,
  `catatan` TEXT DEFAULT NULL,
  `bukti_dukung` VARCHAR(500) DEFAULT NULL,
  `status_verifikasi` VARCHAR(50) DEFAULT 'Draft',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_ippd_eval` (`kodewilayah`, `instansi_id`, `tahun`, `item_code`),
  INDEX `idx_ippd_lookup` (`tahun`, `instansi_id`, `kodewilayah`, `deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Sample Evaluation IPPD 2026
INSERT INTO `ippd_penilaian` (`kodewilayah`, `instansi_id`, `tahun`, `item_code`, `bobot_capaian`, `opsi_aksi`, `catatan`, `created_at`, `updated_at`)
VALUES
('35.12', 1, 2026, '1.a.1.a', 0.500, 'Memenuhi Sepenuhnya', 'Tersedia dokumen matrik penyelarasan RPJMD dengan Prioritas Nasional', NOW(), NOW()),
('35.12', 1, 2026, '1.a.1.b', 0.500, 'Memenuhi Sepenuhnya', 'Tabel persandingan tersedia pada Bab IV dokumen RPJMD', NOW(), NOW()),
('35.12', 1, 2026, '1.a.1.c', 0.500, 'Memenuhi Sepenuhnya', 'Selaras dengan prioritas RPJMN', NOW(), NOW()),
('35.12', 1, 2026, '1.a.1.d', 0.500, 'Memenuhi Sepenuhnya', 'Tersedia tabel persandingan terpadu', NOW(), NOW()),
('35.12', 1, 2026, '1.a.4', 1.000, 'Memenuhi Sepenuhnya', 'Proyek strategis daerah mendukung proyek prioritas nasional', NOW(), NOW()),
('35.12', 1, 2026, '1.a.5', 1.000, 'Memenuhi Sepenuhnya', 'Selaras dengan 6 SPM Wajib', NOW(), NOW()),
('35.12', 1, 2026, '1.a.6', 1.000, 'Memenuhi Sepenuhnya', 'Target SPM 100% pada tahun berjalan', NOW(), NOW()),
('35.12', 1, 2026, '1.c.1', 10.000, 'Memenuhi Sepenuhnya', 'Alokasi APBD untuk program prioritas nasional tersedia memadai', NOW(), NOW()),
('35.12', 1, 2026, '2.b.1', 4.500, 'Memenuhi Sepenuhnya', 'Program unggulan langsung mengintervensi isu kemiskinan dan ketimpangan', NOW(), NOW()),
('35.12', 1, 2026, '2.b.2', 4.500, 'Memenuhi Sepenuhnya', 'Keterkaitan output dan outcome terukur jelas', NOW(), NOW())
ON DUPLICATE KEY UPDATE `bobot_capaian`=VALUES(`bobot_capaian`), `opsi_aksi`=VALUES(`opsi_aksi`), `catatan`=VALUES(`catatan`);
