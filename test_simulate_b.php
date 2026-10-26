<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');

echo "=== CEK DATA ISU 25 ===\n";
$r = $conn->query("SELECT * FROM cascading_rkpd_isu WHERE id = 25")->fetch_assoc();
print_r($r);

echo "=== CEK RELASI ISU 25 ===\n";
$res = $conn->query("SELECT * FROM cascading_rkpd_permasalahan_isu WHERE isu_id = 25");
while ($row = $res->fetch_assoc()) {
    print_r($row);
}
