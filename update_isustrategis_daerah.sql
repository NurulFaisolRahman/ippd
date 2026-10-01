-- Migration Script for Isu Strategis Daerah
-- Menyesuaikan tabel isustrategisdaerah untuk Linearitas Isu Strategis RPJMN, KLHS dan RPJMD

ALTER TABLE `isustrategisdaerah` 
  MODIFY COLUMN `_Id` VARCHAR(255) NULL DEFAULT '',
  MODIFY COLUMN `NamaIsuStrategis` TEXT NOT NULL,
  ADD COLUMN IF NOT EXISTS `isu_global` TEXT NULL AFTER `isu_klhs`,
  ADD COLUMN IF NOT EXISTS `isu_nasional` TEXT NULL AFTER `isu_global`,
  ADD COLUMN IF NOT EXISTS `isu_regional` TEXT NULL AFTER `isu_nasional`;
