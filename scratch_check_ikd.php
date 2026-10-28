<?php
$mysqli = new mysqli('localhost', 'root', '', 'ippd');
echo "--- target_makro_ekonomi ---\n";
$res = $mysqli->query('SELECT * FROM target_makro_ekonomi LIMIT 10');
if ($res) {
    while ($r = $res->fetch_assoc()) {
        print_r($r);
    }
}
echo "--- ikd indikator_sasaran distinct ---\n";
$res2 = $mysqli->query('SELECT DISTINCT indikator_sasaran FROM ikd LIMIT 20');
if ($res2) {
    while ($r2 = $res2->fetch_assoc()) {
        echo $r2['indikator_sasaran'] . PHP_EOL;
    }
}
