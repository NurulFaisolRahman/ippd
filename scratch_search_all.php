<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$res = $conn->query("SHOW TABLES");
while ($r = $res->fetch_array()) {
    $t = $r[0];
    $colsRes = $conn->query("SHOW COLUMNS FROM `$t`");
    $textCols = [];
    while ($col = $colsRes->fetch_assoc()) {
        if (strpos($col['Type'], 'varchar') !== false || strpos($col['Type'], 'text') !== false) {
            $textCols[] = "`" . $col['Field'] . "` LIKE '%Stabilitas Daya Beli%' OR `" . $col['Field'] . "` LIKE '%Pendidikan Berkualitas%'";
        }
    }
    if (!empty($textCols)) {
        $where = implode(" OR ", $textCols);
        $resMatch = $conn->query("SELECT * FROM `$t` WHERE $where LIMIT 2");
        if ($resMatch && $resMatch->num_rows > 0) {
            echo "Found in `$t`:\n";
            while ($row = $resMatch->fetch_assoc()) {
                print_r($row);
            }
        }
    }
}
