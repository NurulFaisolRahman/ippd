<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$res = $conn->query("DESCRIBE ippd_penilaian");
echo "ippd_penilaian columns:\n";
while ($row = $res->fetch_assoc()) {
    echo $row['Field'] . " | " . $row['Type'] . "\n";
}
