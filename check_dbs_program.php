<?php
$conn = new mysqli('localhost', 'root', '');
foreach (['ippd', 'ippd_kaka', 'ippd_faisol'] as $db) {
    $conn->select_db($db);
    echo "=== DB: $db ===\n";
    $res = $conn->query("SHOW TABLES LIKE 'program_%'");
    while ($r = $res->fetch_array()) {
        echo " - " . $r[0] . "\n";
    }
}
$conn->close();
