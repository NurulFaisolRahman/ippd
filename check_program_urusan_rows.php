<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$res = $conn->query("SELECT * FROM program_urusan LIMIT 20");
echo "Rows in program_urusan: " . $res->num_rows . "\n";
while ($r = $res->fetch_assoc()) {
    print_r($r);
}
$conn->close();
