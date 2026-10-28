<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tables = [
    'rkpd_sasaran_prioritas',
    'rkpd_sasaran_isu',
    'rkpd_sasaran_daerah',
    'rkpd_sasaran_indikator',
    'rkpd_keterkaitan_indikator',
    'rkpd_dukungan_prioritas'
];

foreach ($tables as $t) {
    $res = $conn->query("SHOW TABLES LIKE '$t'");
    echo "$t: " . ($res->num_rows > 0 ? "EXISTS" : "DOES NOT EXIST") . "\n";
}
