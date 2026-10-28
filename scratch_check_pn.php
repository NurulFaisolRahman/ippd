<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
$res = $conn->query("SELECT Id, _IdPN, ProgramPrioritas FROM ps_program_prioritas WHERE _IdPN = 1 ORDER BY Id ASC");
echo "--- ps_program_prioritas for PN 1 ---\n";
while ($r = $res->fetch_assoc()) {
    echo "ID: " . $r['Id'] . " | " . $r['ProgramPrioritas'] . "\n";
}
