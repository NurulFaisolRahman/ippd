<?php
$conn = new mysqli('localhost', 'root', '');
$res = $conn->query("SHOW DATABASES");
echo "Databases:\n";
while ($r = $res->fetch_array()) {
    echo " - " . $r[0] . "\n";
}

$conn->select_db('ippd');
$res2 = $conn->query("SHOW TABLES LIKE '%program%'");
echo "\nTables like %program% in ippd:\n";
while ($r = $res2->fetch_array()) {
    echo " - " . $r[0] . "\n";
}
$conn->close();
