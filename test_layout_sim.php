<?php
// Ambil data langsung dari DB
$conn = new mysqli('localhost', 'root', '', 'ippd');

$permRows = $conn->query("SELECT id, permasalahan FROM cascading_rkpd_permasalahan WHERE deleted_at IS NULL ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
$isuRows = $conn->query("SELECT id, isu_strategis FROM cascading_rkpd_isu WHERE deleted_at IS NULL ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
$relRows = $conn->query("SELECT permasalahan_id, isu_id FROM cascading_rkpd_permasalahan_isu")->fetch_all(MYSQLI_ASSOC);

$relMap = [];
foreach ($relRows as $r) {
    $relMap[$r['permasalahan_id']][] = (int)$r['isu_id'];
}

echo "=== SEBELUM RELASI B DITAMBAHKAN ===\n";
foreach ($permRows as $p) {
    $isus = $relMap[$p['id']] ?? [];
    echo "Perm {$p['id']} ({$p['permasalahan']}): Isu IDs: " . implode(',', $isus) . "\n";
}

// Mari kita lihat jika Permasalahan 17 (B) dihubungkan ke Isu 25 (B)
echo "\n=== KASUS 1: Permasalahan B terhubung ke A1, B1, dan B ===\n";
// Uji di JS
