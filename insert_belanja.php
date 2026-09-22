<?php

$transcript_path = 'C:/Users/user/.gemini/antigravity-ide/brain/ee6ffe9b-71c1-4efc-a3d7-58ddf535b64c/.system_generated/logs/transcript_full.jsonl';
$pdf_text = '';

$handle = fopen($transcript_path, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $obj = json_decode($line, true);
        if (isset($obj['type']) && $obj['type'] === 'USER_INPUT') {
            $content = isset($obj['content']) ? $obj['content'] : '';
            if (strpos($content, '==Start of PDF==') !== false) {
                $parts = explode('==Start of PDF==', $content);
                if (count($parts) > 1) {
                    $pdf_parts = explode('==End of PDF==', $parts[1]);
                    $pdf_text = $pdf_parts[0];
                    break;
                }
            }
        }
    }
    fclose($handle);
}

$accounts = [];
$lines = explode("\n", $pdf_text);
foreach ($lines as $line) {
    $line = trim($line);
    // match: "5 1 02 01 01 0001 Belanja Modal..."
    if (preg_match('/^(\d(?: \d+){0,5})\s+(.*)$/', $line, $matches)) {
        $kode_raw = $matches[1];
        $uraian = trim($matches[2]);
        $parts = explode(' ', $kode_raw);
        if (count($parts) > 0 && in_array($parts[0], ['4', '5', '6'])) {
            $formatted_kode = implode('.', $parts);
            $level = count($parts);
            $accounts[] = [
                'kode_rekening' => $formatted_kode,
                'uraian_rekening' => $uraian,
                'level_rekening' => $level
            ];
        }
    }
}

echo "Parsed " . count($accounts) . " accounts from PDF.\n";
$belanja_accounts = array_filter($accounts, function($a) {
    return strpos($a['kode_rekening'], '5') === 0;
});
echo "Found " . count($belanja_accounts) . " Belanja accounts.\n";

$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, nama, kode_instansi FROM akun_instansi WHERE kodewilayah = '35.10' AND deleted_at IS NULL");
$instansi_list = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $instansi_list[] = $row;
    }
}
echo "Found " . count($instansi_list) . " instansi for Banyuwangi.\n";

$headers_inserted = 0;
$rekening_inserted = 0;

$stmt_check_header = $conn->prepare("SELECT id FROM belanja_sub_kegiatan_header WHERE kode_wilayah='35.10' AND tahun='2026' AND id_instansi=? AND kode_program='00' AND kode_kegiatan='00.00' AND kode_sub_kegiatan='00.00.00'");
$stmt_insert_header = $conn->prepare("INSERT INTO belanja_sub_kegiatan_header (kode_wilayah, tahun, id_instansi, kode_perangkat_daerah, nama_perangkat_daerah, kode_program, nama_program, kode_kegiatan, nama_kegiatan, kode_sub_kegiatan, nama_sub_kegiatan, total_belanja, created_at, updated_at) VALUES ('35.10', '2026', ?, ?, ?, '00', 'Data General', '00.00', 'Data General', '00.00.00', 'Data General', 0, NOW(), NOW())");

$stmt_check_rek = $conn->prepare("SELECT COUNT(*) as c FROM belanja_rekening WHERE header_id=?");
$stmt_insert_rek = $conn->prepare("INSERT INTO belanja_rekening (header_id, kode_rekening, uraian_rekening, level_rekening, total, created_at, updated_at) VALUES (?, ?, ?, ?, 0, NOW(), NOW())");

foreach ($instansi_list as $inst) {
    $stmt_check_header->bind_param("i", $inst['id']);
    $stmt_check_header->execute();
    $res = $stmt_check_header->get_result();
    
    if ($res->num_rows == 0) {
        $stmt_insert_header->bind_param("iss", $inst['id'], $inst['kode_instansi'], $inst['nama']);
        $stmt_insert_header->execute();
        $header_id = $conn->insert_id;
        $headers_inserted++;
    } else {
        $row = $res->fetch_assoc();
        $header_id = $row['id'];
    }
    
    $stmt_check_rek->bind_param("i", $header_id);
    $stmt_check_rek->execute();
    $res_rek = $stmt_check_rek->get_result();
    $row_rek = $res_rek->fetch_assoc();
    
    if ($row_rek['c'] == 0) {
        // use transaction and multiple inserts for speed?
        $conn->begin_transaction();
        foreach ($belanja_accounts as $a) {
            $stmt_insert_rek->bind_param("issi", $header_id, $a['kode_rekening'], $a['uraian_rekening'], $a['level_rekening']);
            $stmt_insert_rek->execute();
            $rekening_inserted++;
        }
        $conn->commit();
        echo "Inserted records for instansi " . $inst['nama'] . "\n";
    }
}

echo "Done. Inserted $headers_inserted headers and $rekening_inserted rekenings.\n";
$conn->close();
?>
