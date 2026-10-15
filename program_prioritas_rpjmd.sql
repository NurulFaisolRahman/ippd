-- ============================================================
-- SQL DDL: PROGRAM PRIORITAS RPJMD & INDIKATOR
-- Aplikasi: IPPD (Instrumen Pengawasan Penyelenggaraan Daerah)
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- 1. Tabel: program_prioritas_rpjmd
-- Keterangan: Menyimpan data Outcome per Sasaran RPJMD (VMTS)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `program_prioritas_rpjmd` (
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `KodeWilayah` VARCHAR(50) NOT NULL COMMENT 'Kode Wilayah Daerah (misal 32.09)',
    `sasaran_id` INT(11) NOT NULL COMMENT 'Relasi ke Id tabel sasaranrpjmd',
    `Outcome` TEXT NOT NULL COMMENT 'Uraian Outcome Sasaran RPJMD',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `idx_kodewilayah` (`KodeWilayah`),
    KEY `idx_sasaran_id` (`sasaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel Outcome Program Prioritas RPJMD';

-- ------------------------------------------------------------
-- 2. Tabel: program_prioritas_rpjmd_indikator
-- Keterangan: Menyimpan Indikator-indikator di bawah Outcome,
--              lengkap dengan pilihan Program Nomenklatur & Keterangan
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `program_prioritas_rpjmd_indikator` (
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `outcome_id` INT(11) NOT NULL COMMENT 'Relasi ke Id tabel program_prioritas_rpjmd',
    `Indikator` TEXT NOT NULL COMMENT 'Uraian Indikator Kinerja Sasaran/Outcome',
    `KodeProgram` VARCHAR(100) DEFAULT NULL COMMENT 'Kode Program Nomenklatur (misal 1.01.02)',
    `NamaProgram` TEXT DEFAULT NULL COMMENT 'Nama Program Nomenklatur',
    `Keterangan` TEXT DEFAULT NULL COMMENT 'Catatan atau keterangan tambahan',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `idx_outcome_id` (`outcome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel Indikator Program Prioritas RPJMD';

SET FOREIGN_KEY_CHECKS = 1;
