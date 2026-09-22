<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$kodeWilayah = '35.10';

// 1. Ensure Perangkat Daerah in akun_instansi
$opds = [
    'Dinas/Badan yang menangani Bidang Pendidikan' => 'Dinas Pendidikan',
    'Dinas/Badan yang menangani Bidang Kesehatan' => 'Dinas Kesehatan',
    'Dinas/Badan yang menangani Bidang Pekerjaan Umum Dan Penataan Ruang' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
    'Dinas/Badan yang menangani Bidang Perumahan Dan Kawasan Permukiman' => 'Dinas Perumahan dan Kawasan Permukiman',
    'Dinas/Badan yang menangani Bidang Ketenteraman Dan Ketertiban Umum Serta Perlindungan Masyarakat' => 'Satuan Polisi Pamong Praja',
    'Dinas/Badan yang menangani Bidang Sosial' => 'Dinas Sosial',
    'Dinas/Badan yang menangani Bidang Tenaga Kerja' => 'Dinas Tenaga Kerja',
    'Dinas/Badan yang menangani Bidang Pemberdayaan Perempuan Dan Perlindungan Anak' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak',
    'Dinas/Badan yang menangani Bidang Pangan' => 'Dinas Pertanian dan Pangan',
    'Dinas/Badan yang menangani Bidang Pertanahan' => 'Dinas Pertanahan',
    'Dinas/Badan yang menangani Bidang Lingkungan Hidup' => 'Dinas Lingkungan Hidup'
];

$opdIdMap = [];
foreach ($opds as $pdfName => $standardName) {
    // Check if exists
    $stmt = $conn->prepare("SELECT id FROM akun_instansi WHERE kodewilayah = ? AND (nama = ? OR nama = ?) AND deleted_at IS NULL LIMIT 1");
    $stmt->bind_param("sss", $kodeWilayah, $standardName, $pdfName);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($r = $res->fetch_assoc()) {
        $opdIdMap[$pdfName] = $r['id'];
        $opdIdMap[$standardName] = $r['id'];
    } else {
        $ins = $conn->prepare("INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
        $ins->bind_param("ss", $kodeWilayah, $standardName);
        $ins->execute();
        $newId = $conn->insert_id;
        $opdIdMap[$pdfName] = $newId;
        $opdIdMap[$standardName] = $newId;
    }
}

// 2. Clear old data for 35.10
$conn->query("DELETE FROM program_indikator WHERE kode_wilayah = '$kodeWilayah'");
$conn->query("DELETE FROM program_outcome WHERE program_id IN (SELECT id FROM program_data WHERE kode_wilayah = '$kodeWilayah')");
$conn->query("DELETE FROM program_data WHERE kode_wilayah = '$kodeWilayah'");
$conn->query("DELETE FROM program_bidang_urusan WHERE kode_wilayah = '$kodeWilayah'");
$conn->query("DELETE FROM program_urusan WHERE kode_wilayah = '$kodeWilayah'");

// 3. Load dataset
$items = json_decode(file_get_contents('final_programpd_banyuwangi.json'), true);

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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "ALTER TABLE `akun_instansi` ADD COLUMN IF NOT EXISTS `kode_instansi` VARCHAR(50) DEFAULT NULL AFTER `kodewilayah`;",
    "ALTER TABLE `akun_instansi` ADD COLUMN IF NOT EXISTS `bidang_urusan_id` VARCHAR(255) DEFAULT NULL AFTER `urusan_id`;",
    "ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `instansi_id` INT(11) DEFAULT NULL AFTER `id`;",
    "ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `kode_sub_unit` VARCHAR(50) DEFAULT NULL AFTER `instansi_id`;",
    "ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `nama_sub_unit` VARCHAR(255) DEFAULT NULL AFTER `kode_sub_unit`;",
    "ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `password` VARCHAR(255) DEFAULT NULL AFTER `level`;",
    "ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `bidang_urusan_id` TEXT DEFAULT NULL AFTER `parent_id`;",
    "ALTER TABLE `sub_unit` ADD COLUMN IF NOT EXISTS `urutan` INT(11) DEFAULT 10 AFTER `kode_wilayah`;"
];

foreach ($createTables as $ct) {
    $conn->query($ct);
}

// Build SQL dump
$sqlDump = "-- ========================================================\n";
$sqlDump .= "-- MIGRATION DATA LENGKAP PROGRAM PD KABUPATEN BANYUWANGI (35.10)\n";
$sqlDump .= "-- Sumber: Dokumen Renstra/RPJMD Target & Pagu Indikatif 2026-2030\n";
$sqlDump .= "-- Website: https://smartgovernment.web.id/Daerah/ProgramPD\n";
$sqlDump .= "-- ========================================================\n\n";

foreach ($createTables as $ct) {
    $sqlDump .= $ct . "\n\n";
}

$sqlDump .= "-- Pastikan wilayah Banyuwangi dan Akun Banyuwangi ada di database\n";
$sqlDump .= "INSERT IGNORE INTO kodewilayah (Kode, Nama) VALUES ('35.10', 'KAB. BANYUWANGI');\n";
$sqlDump .= "INSERT IGNORE INTO akun (Username, Password, KodeWilayah, Level, created_at, updated_at) VALUES ('banyuwangi', '\$2y\$10\$gZHWVI0lHSQGslGmgcAFdOTKfgRh7TmNyALFKMoVD9w9tEGEsRy.m', '35.10', 3, NOW(), NOW());\n\n";

$sqlDump .= "-- Buat Akun Instansi Perangkat Daerah untuk Banyuwangi\n";
foreach ($opds as $pdfName => $standardName) {
    $sqlDump .= "INSERT INTO akun_instansi (kodewilayah, nama, created_at, updated_at) SELECT '$kodeWilayah', '" . addslashes($standardName) . "', NOW(), NOW() WHERE NOT EXISTS (SELECT 1 FROM akun_instansi WHERE kodewilayah = '$kodeWilayah' AND nama = '" . addslashes($standardName) . "');\n";
}
$sqlDump .= "\n";

$sqlDump .= "-- Bersihkan data lama Banyuwangi jika ada\n";
$sqlDump .= "DELETE FROM program_indikator WHERE kode_wilayah = '$kodeWilayah';\n";
$sqlDump .= "DELETE FROM program_outcome WHERE program_id IN (SELECT id FROM program_data WHERE kode_wilayah = '$kodeWilayah');\n";
$sqlDump .= "DELETE FROM program_data WHERE kode_wilayah = '$kodeWilayah';\n";
$sqlDump .= "DELETE FROM program_bidang_urusan WHERE kode_wilayah = '$kodeWilayah';\n";
$sqlDump .= "DELETE FROM program_urusan WHERE kode_wilayah = '$kodeWilayah';\n\n";

// Build tree in PHP: Urusan -> Bidang -> Program -> Outcome -> Indikators
$tree = [];
foreach ($items as $it) {
    $uCode = $it['urusan_code'];
    $uName = $it['urusan_nama'];
    $bCode = $it['bidang_code'];
    $bName = $it['bidang_nama'];
    $pCode = $it['program_code'];
    $pName = $it['program_nama'];
    $oText = $it['outcome_text'];

    if (!isset($tree[$uCode])) {
        $tree[$uCode] = [
            'code' => $uCode,
            'nama' => $uName,
            'bidangs' => []
        ];
    }
    if (!isset($tree[$uCode]['bidangs'][$bCode])) {
        $tree[$uCode]['bidangs'][$bCode] = [
            'code' => $bCode,
            'nama' => $bName,
            'programs' => []
        ];
    }
    if (!isset($tree[$uCode]['bidangs'][$bCode]['programs'][$pCode])) {
        $tree[$uCode]['bidangs'][$bCode]['programs'][$pCode] = [
            'code' => $pCode,
            'nama' => $pName,
            'outcomes' => []
        ];
    }
    if (!isset($tree[$uCode]['bidangs'][$bCode]['programs'][$pCode]['outcomes'][$oText])) {
        $tree[$uCode]['bidangs'][$bCode]['programs'][$pCode]['outcomes'][$oText] = [
            'text' => $oText,
            'indicators' => []
        ];
    }
    $tree[$uCode]['bidangs'][$bCode]['programs'][$pCode]['outcomes'][$oText]['indicators'][] = $it;
}

$uIdx = 1;
foreach ($tree as $uCode => $uData) {
    // 1. Insert Urusan
    $stmtU = $conn->prepare("INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
    $stmtU->bind_param("sss", $kodeWilayah, $uData['code'], $uData['nama']);
    $stmtU->execute();
    $urusanId = $conn->insert_id;

    $sqlDump .= "-- -----------------------------------------------------\n";
    $sqlDump .= "-- URUSAN {$uData['code']}: {$uData['nama']}\n";
    $sqlDump .= "-- -----------------------------------------------------\n";
    $sqlDump .= "INSERT INTO program_urusan (kode_wilayah, kode_urusan, nama_urusan, created_at, updated_at) VALUES ('$kodeWilayah', '{$uData['code']}', '" . addslashes($uData['nama']) . "', NOW(), NOW());\n";
    $sqlDump .= "SET @urusan_id = LAST_INSERT_ID();\n\n";

    foreach ($uData['bidangs'] as $bCode => $bData) {
        // 2. Insert Bidang Urusan
        $stmtB = $conn->prepare("INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmtB->bind_param("siss", $kodeWilayah, $urusanId, $bData['code'], $bData['nama']);
        $stmtB->execute();
        $bidangId = $conn->insert_id;

        $sqlDump .= "INSERT INTO program_bidang_urusan (kode_wilayah, urusan_id, kode_bidang, nama_bidang, created_at, updated_at) VALUES ('$kodeWilayah', @urusan_id, '{$bData['code']}', '" . addslashes($bData['nama']) . "', NOW(), NOW());\n";
        $sqlDump .= "SET @bidang_id = LAST_INSERT_ID();\n\n";

        foreach ($bData['programs'] as $pCode => $pData) {
            // 3. Insert Program
            $stmtP = $conn->prepare("INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
            $stmtP->bind_param("siss", $kodeWilayah, $bidangId, $pData['code'], $pData['nama']);
            $stmtP->execute();
            $progId = $conn->insert_id;

            $sqlDump .= "INSERT INTO program_data (kode_wilayah, bidang_urusan_id, kode_program, nama_program, created_at, updated_at) VALUES ('$kodeWilayah', @bidang_id, '{$pData['code']}', '" . addslashes($pData['nama']) . "', NOW(), NOW());\n";
            $sqlDump .= "SET @prog_id = LAST_INSERT_ID();\n";

            $outUrutan = 1;
            foreach ($pData['outcomes'] as $oText => $oData) {
                // 4. Insert Outcome
                $stmtO = $conn->prepare("INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
                $stmtO->bind_param("isi", $progId, $oData['text'], $outUrutan);
                $stmtO->execute();
                $outcomeId = $conn->insert_id;

                $sqlDump .= "INSERT INTO program_outcome (program_id, outcome_text, urutan, created_at, updated_at) VALUES (@prog_id, '" . addslashes($oData['text']) . "', $outUrutan, NOW(), NOW());\n";
                $sqlDump .= "SET @outcome_id = LAST_INSERT_ID();\n";

                $indUrutan = 1;
                foreach ($oData['indicators'] as $ind) {
                    $pdName = $ind['perangkat_daerah'];
                    $pdId = null;
                    if ($pdName) {
                        foreach ($opdIdMap as $k => $v) {
                            if (stripos($pdName, $k) !== false || stripos($k, $pdName) !== false) {
                                $pdId = $v;
                                break;
                            }
                        }
                    }

                    $pagu26 = (float)$ind['pagu_2026'];
                    $pagu27 = (float)$ind['pagu_2027'];
                    $pagu28 = (float)$ind['pagu_2028'];
                    $pagu29 = (float)$ind['pagu_2029'];
                    $pagu30 = (float)$ind['pagu_2030'];

                    // 5. Insert Indikator
                    $stmtI = $conn->prepare("INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
                    $stmtI->bind_param("siisssssdsdsdsdsii", 
                        $kodeWilayah, $progId, $outcomeId, 
                        $ind['indikator'], $ind['satuan'], $ind['kondisi_awal'],
                        $ind['target_2026'], $pagu26,
                        $ind['target_2027'], $pagu27,
                        $ind['target_2028'], $pagu28,
                        $ind['target_2029'], $pagu29,
                        $ind['target_2030'], $pagu30,
                        $pdId, $indUrutan
                    );
                    $stmtI->execute();

                    $pdVal = $pdId ? $pdId : "NULL";
                    $sqlDump .= "INSERT INTO program_indikator (kode_wilayah, program_id, outcome_id, indikator, satuan, kondisi_awal, target_2026, pagu_2026, target_2027, pagu_2027, target_2028, pagu_2028, target_2029, pagu_2029, target_2030, pagu_2030, perangkat_daerah_id, urutan, created_at, updated_at) VALUES ('$kodeWilayah', @prog_id, @outcome_id, '" . addslashes($ind['indikator']) . "', '" . addslashes($ind['satuan']) . "', '" . addslashes($ind['kondisi_awal']) . "', '{$ind['target_2026']}', $pagu26, '{$ind['target_2027']}', $pagu27, '{$ind['target_2028']}', $pagu28, '{$ind['target_2029']}', $pagu29, '{$ind['target_2030']}', $pagu30, $pdVal, $indUrutan, NOW(), NOW());\n";

                    $indUrutan++;
                }
                $outUrutan++;
            }
            $sqlDump .= "\n";
        }
    }
}

file_put_contents('database_programpd_banyuwangi.sql', $sqlDump);
echo "Import completed successfully!\n";
echo "SQL Migration written to database_programpd_banyuwangi.sql\n";
