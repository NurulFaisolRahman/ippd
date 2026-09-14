<?php
$m = new mysqli("localhost", "root", "", "ippd");
echo "=== SELECT FROM lkpj_bab3_iku_capaian WHERE kodewilayah = '35.12' ===\n";
$res = $m->query("SELECT id, kodewilayah, tahun, indikator_iku, satuan, realisasi_2022, realisasi_2023, realisasi_2024, target_2025, realisasi_2025, capaian_2025 FROM lkpj_bab3_iku_capaian WHERE kodewilayah = '35.12' AND deleted_at IS NULL");
while($r = $res->fetch_assoc()) {
    echo "ID: {$r['id']} | Indikator: {$r['indikator_iku']} | 2022: {$r['realisasi_2022']} | 2023: {$r['realisasi_2023']} | 2024: {$r['realisasi_2024']} | T2025: {$r['target_2025']} | R2025: {$r['realisasi_2025']} | Cap: {$r['capaian_2025']}\n";
}

echo "\n=== SELECT FROM lkpj_bab3_iku_perkembangan WHERE kodewilayah = '35.12' ===\n";
$res2 = $m->query("SELECT id, kodewilayah, tahun, uraian_indikator, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025 FROM lkpj_bab3_iku_perkembangan WHERE kodewilayah = '35.12' AND deleted_at IS NULL");
while($r = $res2->fetch_assoc()) {
    echo "ID: {$r['id']} | Uraian: {$r['uraian_indikator']} | 2021: {$r['nilai_2021']} | 2022: {$r['nilai_2022']} | 2023: {$r['nilai_2023']} | 2024: {$r['nilai_2024']} | 2025: {$r['nilai_2025']}\n";
}
