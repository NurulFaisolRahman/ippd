<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');

foreach (['program_urusan', 'bidang_urusan', 'program', 'program_pd'] as $tbl) {
    echo "=== DESCRIBE $tbl ===\n";
    $res = $conn->query("DESCRIBE $tbl");
    if ($res) {
        while ($r = $res->fetch_assoc()) {
            printf("%-22s %-15s %s\n", $r['Field'], $r['Type'], $r['Null']);
        }
    } else {
        echo "Table not found: " . $conn->error . "\n";
    }
}
$conn->close();
