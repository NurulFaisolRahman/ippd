<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = file_get_contents('create_rkpd_sasaran_keterkaitan_dukungan.sql');
if ($conn->multi_query($sql)) {
    do {
        if ($res = $conn->store_result()) {
            $res->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "SQL executed successfully!\n";
} else {
    echo "Error executing SQL: " . $conn->error . "\n";
}
