<?php
$m = new mysqli("localhost", "root", "", "ippd");
$res = $m->query("SELECT kodewilayah, count(*) as cnt FROM iku WHERE deleted_at IS NULL GROUP BY kodewilayah");
while($r = $res->fetch_assoc()) {
    echo "Wilayah: " . $r['kodewilayah'] . " -> " . $r['cnt'] . " rows\n";
}
