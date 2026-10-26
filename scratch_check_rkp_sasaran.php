<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$res = $conn->query("SELECT Id, _IdPN, Sasaran FROM rkp_ps_pn_sasaran ORDER BY _IdPN ASC, Id ASC");
while ($r = $res->fetch_assoc()) {
    echo "PN " . $r['_IdPN'] . " -> Sasaran (" . $r['Id'] . "): " . $r['Sasaran'] . "\n";
}
