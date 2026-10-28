<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$res = $conn->query("SELECT Id, _Id, SasaranPrioritasRPJMN FROM sasaran_prioritas_rpjmn ORDER BY _Id ASC, Id ASC");
while ($r = $res->fetch_assoc()) {
    echo "PN " . $r['_Id'] . " -> Sasaran (" . $r['Id'] . "): " . $r['SasaranPrioritasRPJMN'] . "\n";
}
