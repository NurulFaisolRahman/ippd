<?php
$m = new mysqli("localhost", "root", "", "ippd");
echo "=== CAPAIAN ===\n";
$res = $m->query("SELECT kodewilayah, count(*) as cnt FROM lkpj_bab3_iku_capaian WHERE deleted_at IS NULL GROUP BY kodewilayah");
while($r = $res->fetch_assoc()) {
    echo $r['kodewilayah'] . " => " . $r['cnt'] . "\n";
}
echo "=== PERKEMBANGAN ===\n";
$res2 = $m->query("SELECT kodewilayah, count(*) as cnt FROM lkpj_bab3_iku_perkembangan WHERE deleted_at IS NULL GROUP BY kodewilayah");
while($r = $res2->fetch_assoc()) {
    echo $r['kodewilayah'] . " => " . $r['cnt'] . "\n";
}
