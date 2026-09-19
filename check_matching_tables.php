<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$patterns = ['%program%', '%bidang%', '%outcome%', '%indikator%'];
foreach ($patterns as $p) {
    echo "=== LIKE '$p' ===\n";
    $res = $conn->query("SHOW TABLES LIKE '$p'");
    while ($r = $res->fetch_array()) {
        echo " - " . $r[0] . "\n";
    }
}
$conn->close();
