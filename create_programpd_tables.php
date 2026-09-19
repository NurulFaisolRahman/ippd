<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');

$queries = [
    "CREATE TABLE IF NOT EXISTS `program_urusan` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `kode_urusan` VARCHAR(50) NOT NULL,
      `nama_urusan` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_urusan_wil` (`kode_wilayah`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "CREATE TABLE IF NOT EXISTS `program_bidang_urusan` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `urusan_id` INT(11) NOT NULL,
      `kode_bidang` VARCHAR(50) NOT NULL,
      `nama_bidang` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_bidang_wil_ur` (`kode_wilayah`, `urusan_id`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "CREATE TABLE IF NOT EXISTS `program_data` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `bidang_urusan_id` INT(11) NOT NULL,
      `kode_program` VARCHAR(50) DEFAULT NULL,
      `nama_program` VARCHAR(255) NOT NULL,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_data_wil_bid` (`kode_wilayah`, `bidang_urusan_id`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "CREATE TABLE IF NOT EXISTS `program_outcome` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `program_id` INT(11) NOT NULL,
      `outcome_text` TEXT NOT NULL,
      `urutan` INT(11) DEFAULT 10,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_outcome_prog` (`program_id`, `deleted_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "CREATE TABLE IF NOT EXISTS `program_indikator` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `kode_wilayah` VARCHAR(20) NOT NULL,
      `program_id` INT(11) NOT NULL,
      `outcome_id` INT(11) NOT NULL,
      `indikator` TEXT NOT NULL,
      `satuan` VARCHAR(100) DEFAULT '',
      `kondisi_awal` VARCHAR(100) DEFAULT '',
      `target_2026` VARCHAR(100) DEFAULT '',
      `pagu_2026` DECIMAL(20,2) DEFAULT NULL,
      `target_2027` VARCHAR(100) DEFAULT '',
      `pagu_2027` DECIMAL(20,2) DEFAULT NULL,
      `target_2028` VARCHAR(100) DEFAULT '',
      `pagu_2028` DECIMAL(20,2) DEFAULT NULL,
      `target_2029` VARCHAR(100) DEFAULT '',
      `pagu_2029` DECIMAL(20,2) DEFAULT NULL,
      `target_2030` VARCHAR(100) DEFAULT '',
      `pagu_2030` DECIMAL(20,2) DEFAULT NULL,
      `perangkat_daerah_id` INT(11) DEFAULT NULL,
      `urutan` INT(11) DEFAULT 10,
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `deleted_at` DATETIME DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_prog_ind_wil_out` (`kode_wilayah`, `outcome_id`, `deleted_at`),
      KEY `idx_prog_ind_pd` (`perangkat_daerah_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

foreach ($queries as $q) {
    if (!$conn->query($q)) {
        echo "Error: " . $conn->error . "\n";
    }
}
echo "All 5 Program PD tables created successfully.\n";
$conn->close();
