<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$res = $conn->query("SELECT * FROM sasaranrpjmd WHERE KodeWilayah = '35.10' AND deleted_at IS NULL ORDER BY Id ASC");
echo "Total rows for 35.10 in sasaranrpjmd: " . $res->num_rows . "\n";
$i = 1;
while ($r = $res->fetch_assoc()) {
    echo "S" . $i++ . " (Id=" . $r['Id'] . "): " . $r['Sasaran'] . "\n";
}
