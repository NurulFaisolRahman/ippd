<?php
// Script to populate Program PD tables for Banyuwangi (KodeWilayah: 35.10)
$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$kodeWilayah = '35.10';

// Ensure tables exist
$createTables = [
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

foreach ($createTables as $ct) {
    $conn->query($ct);
}

// Hapus data lama jika ada
$conn->query("DELETE FROM program_indikator WHERE kode_wilayah = '$kodeWilayah'");
$conn->query("DELETE FROM program_outcome WHERE program_id IN (SELECT id FROM program_data WHERE kode_wilayah = '$kodeWilayah')");
$conn->query("DELETE FROM program_data WHERE kode_wilayah = '$kodeWilayah'");
$conn->query("DELETE FROM program_bidang_urusan WHERE kode_wilayah = '$kodeWilayah'");
$conn->query("DELETE FROM program_urusan WHERE kode_wilayah = '$kodeWilayah'");

$ikdData = json_decode(file_get_contents('ikd_rows_3510.json'), true);

$aspekMap = [
    'dayasaing' => [
        'kode' => '1',
        'nama' => 'ASPEK DAYA SAING DAERAH',
        'kode_bidang' => '1.01',
        'nama_bidang' => 'Bidang Perekonomian, Infrastruktur dan Daya Saing Daerah'
    ],
    'geografi' => [
        'kode' => '2',
        'nama' => 'ASPEK GEOGRAFI DAN DEMOGRAFI',
        'kode_bidang' => '2.01',
        'nama_bidang' => 'Bidang Tata Kelola Wilayah, Geografi dan Kependudukan'
    ],
    'kesejahteraan' => [
        'kode' => '3',
        'nama' => 'ASPEK KESEJAHTERAAN RAKYAT',
        'kode_bidang' => '3.01',
        'nama_bidang' => 'Bidang Kesejahteraan Rakyat, Sosial dan Pendidikan'
    ],
    'pelayanan' => [
        'kode' => '4',
        'nama' => 'ASPEK PELAYANAN UMUM',
        'kode_bidang' => '4.01',
        'nama_bidang' => 'Bidang Tata Kelola Pemerintahan dan Pelayanan Publik'
    ]
];

$sqlDump = "-- ========================================================\n";
$sqlDump .= "-- MIGRATION DATA PROGRAM PD KABUPATEN BANYUWANGI (35.10)\n";
$sqlDump .= "-- Sumber: Data PDF Capaian Indikator Kinerja Daerah (IKD) Banyuwangi\n";
$sqlDump .= "-- Website: https://smartgovernment.web.id/Daerah/ProgramPD\n";
$sqlDump .= "-- ========================================================\n\n";

foreach ($createTables as $ct) {
    $sqlDump .= $ct . "\n\n";
}

$sqlDump .= "-- Pastikan wilayah Banyuwangi dan Akun Banyuwangi ada di database\n";
$sqlDump .= "INSERT IGNORE INTO kodewilayah (Kode, Nama) VALUES ('35.10', 'KAB. BANYUWANGI');\n";
$sqlDump .= "INSERT IGNORE INTO akun (Username, Password, KodeWilayah, Level, created_at, updated_at) VALUES ('banyuwangi', '\$2y\$10\$gZHWVI0lHSQGslGmgcAFdOTKfgRh7TmNyALFKMoVD9w9tEGEsRy.m', '35.10', 3, NOW(), NOW());\n\n";

$sqlDump .= "-- Bersihkan data lama Banyuwangi jika ada\n";
$sqlDump .= "DELETE FROM program_indikator WHERE kode_wilayah = '$kodeWilayah';\n";
$sqlDump .= "DELETE FROM program_outcome WHERE program_id IN (SELECT id FROM program_data WHERE kode_wilayah = '$kodeWilayah');\n";
$sqlDump .= "DELETE FROM program_data WHERE kode_wilayah = '$kodeWilayah';\n";
$sqlDump .= "DELETE FROM program_bidang_urusan WHERE kode_wilayah = '$kodeWilayah';\n";
$sqlDump .= "DELETE FROM program_urusan WHERE kode_wilayah = '$kodeWilayah';\n\n";

$aspekIndex = 1;
// Loop per aspek
foreach ($aspekMap as $aspekKey => $aspekInfo) {
    // 1. Insert Urusan
    $stmtUrusan = $conn->prepare("INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
    $stmtUrusan->bind_param("sss", $kodeWilayah, $aspekInfo['kode'], $aspekInfo['nama']);
    $stmtUrusan->execute();
    $urusanId = $conn->insert_id;

    $sqlDump .= "-- -----------------------------------------------------\n";
    $sqlDump .= "-- Urusan {$aspekInfo['kode']}: {$aspekInfo['nama']}\n";
    $sqlDump .= "-- -----------------------------------------------------\n";
    $sqlDump .= "INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('$kodeWilayah', '{$aspekInfo['kode']}', '" . addslashes($aspekInfo['nama']) . "', NOW(), NOW());\n";
    $sqlDump .= "SET @urusan_id = LAST_INSERT_ID();\n\n";

    // 2. Insert Bidang Urusan
    $stmtBidang = $conn->prepare("INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
    $stmtBidang->bind_param("siss", $kodeWilayah, $urusanId, $aspekInfo['kode_bidang'], $aspekInfo['nama_bidang']);
    $stmtBidang->execute();
    $bidangId = $conn->insert_id;

    $sqlDump .= "INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('$kodeWilayah', @urusan_id, '{$aspekInfo['kode_bidang']}', '" . addslashes($aspekInfo['nama_bidang']) . "', NOW(), NOW());\n";
    $sqlDump .= "SET @bidang_id = LAST_INSERT_ID();\n\n";

    // Filter data IKD untuk aspek ini
    $items = array_filter($ikdData, function($row) use ($aspekKey) {
        return $row['aspek'] === $aspekKey;
    });

    $progIdx = 1;
    foreach ($items as $item) {
        $kodeProg = sprintf("%s.%02d", $aspekInfo['kode_bidang'], $progIdx);
        $namaProg = "Program " . $item['indikator_sasaran'];

        // 3. Insert Program
        $stmtProg = $conn->prepare("INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmtProg->bind_param("siss", $kodeWilayah, $bidangId, $kodeProg, $namaProg);
        $stmtProg->execute();
        $progId = $conn->insert_id;

        $sqlDump .= "INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('$kodeWilayah', @bidang_id, '$kodeProg', '" . addslashes($namaProg) . "', NOW(), NOW());\n";
        $sqlDump .= "SET @prog_id = LAST_INSERT_ID();\n";

        // 4. Insert Outcome
        $outcomeText = "Meningkatnya " . $item['indikator_sasaran'];
        $stmtOut = $conn->prepare("INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (?, ?, 1, NOW(), NOW())");
        $stmtOut->bind_param("is", $progId, $outcomeText);
        $stmtOut->execute();
        $outcomeId = $conn->insert_id;

        $sqlDump .= "INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, '" . addslashes($outcomeText) . "', 1, NOW(), NOW());\n";
        $sqlDump .= "SET @outcome_id = LAST_INSERT_ID();\n";

        // 5. Insert Indikator
        $indikator = $item['indikator_sasaran'];
        $satuan = $item['satuan'] ?? '';
        $kondisiAwal = !empty($item['nilai_2024']) ? $item['nilai_2024'] : (!empty($item['nilai_2021']) ? $item['nilai_2021'] : (!empty($item['nilai_2025']) ? $item['nilai_2025'] : '-'));
        $target2026 = !empty($item['target_2025']) ? $item['target_2025'] : '-';
        $target2027 = !empty($item['realisasi_2025']) ? $item['realisasi_2025'] : $target2026;
        $target2028 = $target2026;
        $target2029 = $target2026;
        $target2030 = $target2026;

        $stmtInd = $conn->prepare("INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, urutan, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?, 0, ?, 0, ?, 0, ?, 0, 1, NOW(), NOW())");
        $stmtInd->bind_param("siissssssss", $kodeWilayah, $progId, $outcomeId, $indikator, $satuan, $kondisiAwal, $target2026, $target2027, $target2028, $target2029, $target2030);
        $stmtInd->execute();
        $indId = $conn->insert_id;

        $sqlDump .= "INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, urutan, created_at, updated_at) VALUES ('$kodeWilayah', @prog_id, @outcome_id, '" . addslashes($indikator) . "', '" . addslashes($satuan) . "', '" . addslashes($kondisiAwal) . "', '$target2026', 0, '$target2027', 0, '$target2028', 0, '$target2029', 0, '$target2030', 0, 1, NOW(), NOW());\n\n";

        $progIdx++;
    }
    $aspekIndex++;
}

file_put_contents('database_programpd_banyuwangi.sql', $sqlDump);
echo "Successfully regenerated database_programpd_banyuwangi.sql and updated local DB!\n";
