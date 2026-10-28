<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');

// Search for Banyuwangi (KodeWilayah = '35.10' or similar)
$res = $conn->query("SELECT * FROM kodewilayah WHERE Nama LIKE '%Banyuwangi%'");
while ($r = $res->fetch_assoc()) {
    echo "Wilayah: " . $r['Kode'] . " - " . $r['Nama'] . "\n";
}

// Check where 'Optimalnya Tata Kelola Pemerintah Berorientasi Layanan' or 'Stabilitas Daya Beli Masyarakat' exists
$searchTexts = ['Optimalnya Tata Kelola', 'Stabilitas Daya Beli', 'Distribusi Ekonomi'];
foreach ($searchTexts as $st) {
    echo "\nSearching for '$st':\n";
    $tables = ['indikator_sasaran', 'sasaran_pembangunan_daerah', 'sasaranrpjmd', 'sasaran_pd', 'rkpd_sasaran_daerah', 'rkpd_sasaran_prioritas', 'keselarasan_astacita_misi', 'rkpd_keterkaitan_indikator'];
    foreach ($tables as $t) {
        $resT = $conn->query("SHOW TABLES LIKE '$t'");
        if ($resT->num_rows == 0) continue;
        
        // Find text columns in $t
        $colsRes = $conn->query("SHOW COLUMNS FROM `$t`");
        $textCols = [];
        while ($col = $colsRes->fetch_assoc()) {
            if (strpos($col['Type'], 'varchar') !== false || strpos($col['Type'], 'text') !== false) {
                $textCols[] = "`" . $col['Field'] . "` LIKE '%$st%'";
            }
        }
        if (!empty($textCols)) {
            $where = implode(" OR ", $textCols);
            $q = "SELECT * FROM `$t` WHERE $where LIMIT 3";
            $resMatch = $conn->query($q);
            if ($resMatch && $resMatch->num_rows > 0) {
                echo "  Found in table `$t` (" . $resMatch->num_rows . " rows):\n";
                while ($rowMatch = $resMatch->fetch_assoc()) {
                    print_r($rowMatch);
                }
            }
        }
    }
}
