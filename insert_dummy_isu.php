<?php
$host = '127.0.0.1';
$db   = 'ippd';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get KodeWilayah for Banyuwangi
    $stmt = $pdo->prepare("SELECT Kode FROM kodewilayah WHERE Nama LIKE '%banyuwangi%' LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $kodeWilayah = $row ? $row['Kode'] : '3510'; // Fallback to a code if not found

    echo "Using KodeWilayah: $kodeWilayah\\n";

    // Data to insert
    $permasalahan1 = "Infrastruktur kesehatan penyakit menular dan tidak menular yang berkualitas\nBelum meratanya jaminan Kesehatan\nKenaikan angka kematian ibu\nMasih adanya kasus Stunting\nBelum Meratanya Sistem Kesehatan yang berkualitas\nMasih belum meratanya kualitas Pendidikan\nBelum sepenuhnya kompetensi guru dalam penguasaan IT\nSarpras sekolah belum memenuhi akses lengkap yang berkualitas\nTantangan dalam mengimbangi Pendidikan dengan nilai karakter\nTidak tersedianya lapangan pekerjaan yang sesuai dengan keterampilan dan pengalaman yang dimiliki oleh para pencari kerja.\nSerapan tenaga kerja di banyuwangi masih belum optimal\nTingkat pengangguran yang masih tergolong tinggi";
    $isuKlhs1 = "Kualitas SDM";
    $global1 = "Persaingan Talenta Global\nAging Population\nTransformasi Digital";
    $nasional1 = "Rendahnya Kualitas SDM";
    $regional1 = "Pengembangan SDM berkualitas melalui peningkatan akses pendidikan, kesehatan dan standar hidup yang layak dan berkualitas.";
    $isuStrategis1 = "Sumber Daya Manusia yang Belum Berdaya Saing";

    $permasalahan2 = "Terjadi peningkatan kekerasan perempuan dan anak\nTerjadi kerentanan kualitas keluarga yang berdampak pada peningkatan perilaku menyimpang di kalangan individu";
    $isuKlhs2 = "Kesetaraan Gender dan Pencegahan Kekerasan terhadap Perempuan dan anak";
    $global2 = "Partisipasi Perempuan dalam Kepemimpinan dan Kebijakan Regulasi yang Lemah";
    $nasional2 = "Pergeseran struktur kelas masyarakat";
    $regional2 = "";
    $isuStrategis2 = "Kurangnya Peranan Gender dalam Pembangunan";

    $insertStmt = $pdo->prepare("INSERT INTO isustrategisdaerah (KodeWilayah, TahunMulai, TahunAkhir, permasalahan_pokok, isu_klhs, isu_global, isu_nasional, isu_regional, NamaIsuStrategis, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    
    // Default period
    $tahunMulai = '2025';
    $tahunAkhir = '2029';

    // Insert Row 1
    $insertStmt->execute([$kodeWilayah, $tahunMulai, $tahunAkhir, $permasalahan1, $isuKlhs1, $global1, $nasional1, $regional1, $isuStrategis1]);
    
    // Insert Row 2
    $insertStmt->execute([$kodeWilayah, $tahunMulai, $tahunAkhir, $permasalahan2, $isuKlhs2, $global2, $nasional2, $regional2, $isuStrategis2]);

    echo "Data dummy berhasil ditambahkan!\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
