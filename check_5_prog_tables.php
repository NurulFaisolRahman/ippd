<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$tables = ['program_urusan', 'program_bidang_urusan', 'program_data', 'program_outcome', 'program_indikator'];
foreach ($tables as $t) {
    $res = $conn->query("SHOW TABLES LIKE '$t'");
    echo "$t: " . ($res->num_rows > 0 ? "EXISTS" : "MISSING") . "\n";
}
$conn->close();
