<?php
$m = new mysqli("localhost", "root", "", "ippd");
echo "=== IKU FOR 32.09 WITH TUJUAN AND MISI ===\n";
$q = $m->query("
    SELECT 
        i.id, i.kodewilayah, i.IdTujuan, i.indikator_tujuan, i.target_1, i.target_2, i.target_3, i.target_4, i.target_5,
        t.Tujuan, t._Id as misi_id,
        m.Misi
    FROM iku i
    LEFT JOIN tujuanrpjmd t ON i.IdTujuan = t.Id
    LEFT JOIN misirpjmd m ON t._Id = m.Id
    WHERE i.kodewilayah = '32.09' AND i.deleted_at IS NULL
");
while($r = $q->fetch_assoc()) {
    print_r($r);
}
