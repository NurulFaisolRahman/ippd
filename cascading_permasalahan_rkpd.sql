-- ============================================================
-- SQL DDL: CASCADING PERMASALAHAN RKPD
-- Menu: RKPD -> Rancangan Awal -> Cascading Permasalahan
-- ============================================================

CREATE TABLE IF NOT EXISTS `cascading_permasalahan_rkpd` (
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `KodeWilayah` VARCHAR(50) NOT NULL COMMENT 'Kode Wilayah Daerah',
    `Tahun` VARCHAR(10) NOT NULL COMMENT 'Tahun Perencanaan RKPD',
    `Permasalahan` TEXT NOT NULL COMMENT 'Uraian Permasalahan Pembangunan',
    `IsuStrategis` TEXT NOT NULL COMMENT 'Uraian Isu Strategis Daerah',
    `IdPrioritasDaerah` INT(11) DEFAULT NULL COMMENT 'Relasi ke prioritas_pembangunan.id (jenis daerah)',
    `ProgramPrioritas` TEXT NOT NULL COMMENT 'Program Prioritas Daerah dari Tema Pembangunan',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `idx_wilayah_tahun` (`KodeWilayah`, `Tahun`),
    KEY `idx_prioritas_daerah` (`IdPrioritasDaerah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel Cascading Permasalahan RKPD';
