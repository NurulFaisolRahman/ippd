<?php
$host = '127.0.0.1';
$db   = 'ippd';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table
    $sql = file_get_contents('update_relasi_permasalahan.sql');
    $pdo->exec($sql);
    echo "Tabel isustrategisdaerah_permasalahan berhasil dibuat.\n";

    // Migrate existing data
    $stmt = $pdo->query("SELECT Id, permasalahan_pokok FROM isustrategisdaerah WHERE deleted_at IS NULL AND permasalahan_pokok IS NOT NULL AND permasalahan_pokok != ''");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $insertStmt = $pdo->prepare("INSERT INTO isustrategisdaerah_permasalahan (IdIsuStrategis, Permasalahan) VALUES (?, ?)");

    foreach ($rows as $row) {
        $id = $row['Id'];
        $text = $row['permasalahan_pokok'];
        
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        foreach ($lines as $line) {
            $cleanLine = trim(preg_replace('/^[\?\-\*\d\.\)\s]+/u', '', trim($line)));
            if (!empty($cleanLine)) {
                $insertStmt->execute([$id, $cleanLine]);
            }
        }
    }
    
    echo "Data permasalahan berhasil dimigrasi.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
