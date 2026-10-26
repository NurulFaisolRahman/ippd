<?php
$conn = new mysqli('localhost', 'root', '', 'ippd');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rows = [
    // PN 1
    [
        'id_pn' => 1,
        'kode_pn' => 'PN 1',
        'nama_pn' => 'Memperkokoh Ideologi Pancasila, Demokrasi, dan Hak Asasi Manusia',
        'kode_sasaran_daerah' => 'S12',
        'sasaran_daerah' => 'Optimalnya Tata Kelola Pemerintah Berorientasi Layanan',
        'kode_sasaran_nasional' => 'S1',
        'sasaran_nasional' => 'Terwujudnya kehidupan bermasyarakat, berbangsa, dan bernegara yang berlandaskan Pancasila, demokrasi, dan hak asasi manusia'
    ],
    // PN 2
    [
        'id_pn' => 2,
        'kode_pn' => 'PN 2',
        'nama_pn' => 'Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru',
        'kode_sasaran_daerah' => 'S1',
        'sasaran_daerah' => 'Stabilitas Daya Beli Masyarakat',
        'kode_sasaran_nasional' => 'S3',
        'sasaran_nasional' => 'Meningkatkan kemandirian bangsa dalam memenuhi kebutuhan pangan yang berkualitas secara berkelanjutan dengan pendekatan nexus pangan, energi. dan air (FEW Nexus)'
    ],
    [
        'id_pn' => 2,
        'kode_pn' => 'PN 2',
        'nama_pn' => 'Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru',
        'kode_sasaran_daerah' => 'S3',
        'sasaran_daerah' => 'Distribusi Ekonomi yang Efisien dan Merata',
        'kode_sasaran_nasional' => 'S6',
        'sasaran_nasional' => 'Terwujudnya perekonomian nasional yang inklusif dan berkelanjutan'
    ],
    [
        'id_pn' => 2,
        'kode_pn' => 'PN 2',
        'nama_pn' => 'Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru',
        'kode_sasaran_daerah' => 'S5',
        'sasaran_daerah' => 'Meningkatnya Kualitas Lingkungan sebagai Penunjang Ekonomi yang Berkelanjutan',
        'kode_sasaran_nasional' => 'S7',
        'sasaran_nasional' => 'Terwujudnya transformasi ekonomi hijau'
    ],
    // PN 3
    [
        'id_pn' => 3,
        'kode_pn' => 'PN 3',
        'nama_pn' => 'Melanjutkan Pengembangan Infrastruktur dan Meningkatkan Lapangan Kerja yang Berkualitas, Mendorong Kewirausahaan, Mengembangkan Industri Kreatif serta Mengembangkan Agromaritim Industri di Sentra Produksi melalui Peran Aktif Koperasi',
        'kode_sasaran_daerah' => 'S8',
        'sasaran_daerah' => 'Meningkatnya Ekonomi Masyarakat Miskin dan Rentan',
        'kode_sasaran_nasional' => 'S10',
        'sasaran_nasional' => 'Meningkatnya lapangan kerja yang berkualitas'
    ],
    [
        'id_pn' => 3,
        'kode_pn' => 'PN 3',
        'nama_pn' => 'Melanjutkan Pengembangan Infrastruktur dan Meningkatkan Lapangan Kerja yang Berkualitas, Mendorong Kewirausahaan, Mengembangkan Industri Kreatif serta Mengembangkan Agromaritim Industri di Sentra Produksi melalui Peran Aktif Koperasi',
        'kode_sasaran_daerah' => 'S3',
        'sasaran_daerah' => 'Distribusi Ekonomi yang Efisien dan Merata',
        'kode_sasaran_nasional' => 'S8',
        'sasaran_nasional' => 'Terwujudnya pengembangan infrastruktur yang berkelanjutan'
    ],
    [
        'id_pn' => 3,
        'kode_pn' => 'PN 3',
        'nama_pn' => 'Melanjutkan Pengembangan Infrastruktur dan Meningkatkan Lapangan Kerja yang Berkualitas, Mendorong Kewirausahaan, Mengembangkan Industri Kreatif serta Mengembangkan Agromaritim Industri di Sentra Produksi melalui Peran Aktif Koperasi',
        'kode_sasaran_daerah' => 'S2',
        'sasaran_daerah' => 'Meningkatnya Pertumbuhan Ekonomi Sektor Unggulan',
        'kode_sasaran_nasional' => 'S12',
        'sasaran_nasional' => 'Meningkatnya proporsi PDB ekonomi kreatif'
    ],
    // PN 4
    [
        'id_pn' => 4,
        'kode_pn' => 'PN 4',
        'nama_pn' => 'Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, Serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi 2), dan Penyandang Disabilitas',
        'kode_sasaran_daerah' => 'S9',
        'sasaran_daerah' => 'Pendidikan Berkualitas dan Merata',
        'kode_sasaran_nasional' => 'S13',
        'sasaran_nasional' => 'Terwujudnya pendidikan berkualitas yang merata'
    ],
    [
        'id_pn' => 4,
        'kode_pn' => 'PN 4',
        'nama_pn' => 'Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, Serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi 2), dan Penyandang Disabilitas',
        'kode_sasaran_daerah' => 'S11',
        'sasaran_daerah' => 'Kesehatan Berkualitas dan Merata',
        'kode_sasaran_nasional' => 'S14',
        'sasaran_nasional' => 'Terwujudnya kesehatan untuk semua'
    ],
    [
        'id_pn' => 4,
        'kode_pn' => 'PN 4',
        'nama_pn' => 'Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, Serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi 2), dan Penyandang Disabilitas',
        'kode_sasaran_daerah' => 'S8',
        'sasaran_daerah' => 'Meningkatnya Ekonomi Masyarakat Miskin dan Rentan',
        'kode_sasaran_nasional' => 'S15',
        'sasaran_nasional' => 'Terwujudnya keluarga berkualitas, kesetaraan gender, dan masyarakat inklusif'
    ],
    [
        'id_pn' => 4,
        'kode_pn' => 'PN 4',
        'nama_pn' => 'Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, Serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi 2), dan Penyandang Disabilitas',
        'kode_sasaran_daerah' => 'S7',
        'sasaran_daerah' => 'Peranan Sosial Masyarakat yang Menguat',
        'kode_sasaran_nasional' => 'S16',
        'sasaran_nasional' => 'Menguatnya iptek, inovasi, dan produktivitas tenaga kerja'
    ],
    // PN 5
    [
        'id_pn' => 5,
        'kode_pn' => 'PN 5',
        'nama_pn' => 'Melanjutkan Hilirisasi dan Mengembangkan Industri Berbasis Sumber Daya Alam untuk Meningkatkan Nilai Tambah di Dalam Negeri',
        'kode_sasaran_daerah' => 'S2',
        'sasaran_daerah' => 'Meningkatnya Pertumbuhan Ekonomi Sektor Unggulan',
        'kode_sasaran_nasional' => 'S18',
        'sasaran_nasional' => 'Terwujudnya peningkatan nilai tambah, produktivitas dan daya saing industri pengolahan'
    ],
    // PN 6
    [
        'id_pn' => 6,
        'kode_pn' => 'PN 6',
        'nama_pn' => 'Membangun dari Desa dan dari Bawah untuk Pertumbuhan Ekonomi, Pemerataan Ekonomi, dan Pemberantasan Kemiskinan',
        'kode_sasaran_daerah' => 'S8',
        'sasaran_daerah' => 'Meningkatnya Ekonomi Masyarakat Miskin dan Rentan',
        'kode_sasaran_nasional' => 'S20',
        'sasaran_nasional' => 'Mempercepat pengurangan kemiskinan dan peningkatan pemerataan'
    ],
    [
        'id_pn' => 6,
        'kode_pn' => 'PN 6',
        'nama_pn' => 'Membangun dari Desa dan dari Bawah untuk Pertumbuhan Ekonomi, Pemerataan Ekonomi, dan Pemberantasan Kemiskinan',
        'kode_sasaran_daerah' => 'S6',
        'sasaran_daerah' => 'Berkurang Beban Pengeluaran Masyarakat Miskin dan Rentan',
        'kode_sasaran_nasional' => 'S22',
        'sasaran_nasional' => 'Mewujudkan pembangunan kemandirian perdesaan dari bawah sebagai sumber pertumbuhan ekonomi yang berkelanjutan'
    ],
    // PN 7
    [
        'id_pn' => 7,
        'kode_pn' => 'PN 7',
        'nama_pn' => 'Memperkuat Reformasi Politik, Hukum, dan Birokrasi, serta Memperkuat Pencegahan dan Pemberantasan Korupsi, Narkoba, Judi, dan Penyelundupan',
        'kode_sasaran_daerah' => 'S12',
        'sasaran_daerah' => 'Optimalnya Tata Kelola Pemerintah Berorientasi Layanan',
        'kode_sasaran_nasional' => 'S25',
        'sasaran_nasional' => 'Terwujudnya birokrasi pemerintahan yang adaptif dan melayani'
    ],
    // PN 8
    [
        'id_pn' => 8,
        'kode_pn' => 'PN 8',
        'nama_pn' => 'Memperkuat Penyelarasan Kehidupan yang Harmonis dengan Lingkungan Alam dan Budaya, serta Peningkatan Toleransi Antarumat Beragama untuk Mencapai Masyarakat yang Adil dan Makmur',
        'kode_sasaran_daerah' => 'S7',
        'sasaran_daerah' => 'Peranan Sosial Masyarakat yang Menguat',
        'kode_sasaran_nasional' => 'S30',
        'sasaran_nasional' => 'Terwujudnya kehidupan beragama yang maslahat dan berkebudayaan maju'
    ]
];

$years = ['2025', '2026'];
$kodeWilayah = '35.10';

// Hapus data lama untuk banyuwangi jika ada
$conn->query("DELETE FROM rkpd_keterkaitan_indikator WHERE kode_wilayah = '$kodeWilayah'");

$stmt = $conn->prepare("INSERT INTO rkpd_keterkaitan_indikator (
    kode_wilayah, tahun, id_pn, kode_pn, nama_pn, id_sasaran_nasional, kode_sasaran_nasional, sasaran_nasional, indikator_nasional, p_daerah_json, id_sasaran_daerah, kode_sasaran_daerah, sasaran_daerah, indikator_daerah_json, created_at
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

foreach ($years as $th) {
    foreach ($rows as $r) {
        $idSasNas = null;
        $indNas = '';
        $pDaerahJson = null;
        $idSasDae = null;
        $indDaeJson = null;

        $stmt->bind_param(
            "ssisssssssisss",
            $kodeWilayah,
            $th,
            $r['id_pn'],
            $r['kode_pn'],
            $r['nama_pn'],
            $idSasNas,
            $r['kode_sasaran_nasional'],
            $r['sasaran_nasional'],
            $indNas,
            $pDaerahJson,
            $idSasDae,
            $r['kode_sasaran_daerah'],
            $r['sasaran_daerah'],
            $indDaeJson
        );
        $stmt->execute();
    }
}

echo "Berhasil insert " . (count($years) * count($rows)) . " baris ke rkpd_keterkaitan_indikator untuk Banyuwangi ($kodeWilayah)!\n";
