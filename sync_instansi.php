<?php

$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$json_str = file_get_contents('scratch/attached_programpd_banyuwangi.json');
$items = json_decode($json_str, true);

$pds = [];
foreach ($items as $item) {
    $pd = isset($item['PERANGKAT DAERAH PENANGGUNG JAWAB']) ? $item['PERANGKAT DAERAH PENANGGUNG JAWAB'] : null;
    if ($pd) {
        $pd = trim($pd);
        if ($pd != '') {
            $pds[$pd] = true;
        }
    }
}

echo "Found " . count($pds) . " unique Perangkat Daerah from JSON.\n";

$kodeWilayah = '35.10';
$added = 0;

foreach ($pds as $pd => $val) {
    $stmt = $conn->prepare("SELECT id FROM akun_instansi WHERE kodewilayah = ? AND nama = ? AND deleted_at IS NULL LIMIT 1");
    $stmt->bind_param("ss", $kodeWilayah, $pd);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
        // Generate random 6 char hex
        $kode_instansi = 'PD-' . bin2hex(random_bytes(3));
        $ins = $conn->prepare("INSERT INTO akun_instansi (kodewilayah, nama, kode_instansi, role_id, periode_awal, periode_akhir, password, created_at, updated_at) VALUES (?, ?, ?, 4, '2025', '2030', 'password123', NOW(), NOW())");
        $ins->bind_param("sss", $kodeWilayah, $pd, $kode_instansi);
        $ins->execute();
        $added++;
    }
}

echo "Added $added new akun_instansi.\n";

$conn->close();
