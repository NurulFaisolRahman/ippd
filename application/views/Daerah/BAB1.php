<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: BAB 1 (Kondisi Umum Daerah)
 * Tabel 1.1 s/d Tabel 1.20
 * Template Notika - Selaras dengan Desain IPPD & E-LKPJ
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2026;
$filterInstansi = isset($FilterInstansi) ? (int)$FilterInstansi : 1;
$activeTabel = isset($ActiveTabel) ? $ActiveTabel : '1.1';
$metaTabel = isset($MetaTabel) ? $MetaTabel : [];
$daftarTabel = isset($DaftarTabel) ? $DaftarTabel : [];
$itemsTabel1_1 = isset($ItemsTabel1_1) ? $ItemsTabel1_1 : [];
$itemsTabel1_2 = isset($ItemsTabel1_2) ? $ItemsTabel1_2 : [];
$itemsTabel1_3 = isset($ItemsTabel1_3) ? $ItemsTabel1_3 : [];
$itemsTabel1_4 = isset($ItemsTabel1_4) ? $ItemsTabel1_4 : [];
$itemsTabel1_5 = isset($ItemsTabel1_5) ? $ItemsTabel1_5 : [];
$itemsTabel1_6 = isset($ItemsTabel1_6) ? $ItemsTabel1_6 : [];
$itemsTabel1_7 = isset($ItemsTabel1_7) ? $ItemsTabel1_7 : [];
$itemsTabel1_8 = isset($ItemsTabel1_8) ? $ItemsTabel1_8 : [];
$itemsTabel1_9 = isset($ItemsTabel1_9) ? $ItemsTabel1_9 : [];
$itemsTabel1_10 = isset($ItemsTabel1_10) ? $ItemsTabel1_10 : [];
$itemsTabel1_11 = isset($ItemsTabel1_11) ? $ItemsTabel1_11 : [];
$itemsTabel1_12 = isset($ItemsTabel1_12) ? $ItemsTabel1_12 : [];
$itemsTabel1_13 = isset($ItemsTabel1_13) ? $ItemsTabel1_13 : [];
$itemsTabel1_14 = isset($ItemsTabel1_14) ? $ItemsTabel1_14 : [];
$itemsTabel1_15 = isset($ItemsTabel1_15) ? $ItemsTabel1_15 : [];
$itemsTabel1_16 = isset($ItemsTabel1_16) ? $ItemsTabel1_16 : [];
$itemsTabel1_17 = isset($ItemsTabel1_17) ? $ItemsTabel1_17 : [];
$itemsTabel1_18 = isset($ItemsTabel1_18) ? $ItemsTabel1_18 : [];
$itemsTabel1_19 = isset($ItemsTabel1_19) ? $ItemsTabel1_19 : [];
$itemsTabel1_20 = isset($ItemsTabel1_20) ? $ItemsTabel1_20 : [];
$itemsGeneric = isset($ItemsGeneric) ? $ItemsGeneric : [];
$narasiTabel = isset($NarasiTabel) ? $NarasiTabel : '';
$summary = isset($SummaryTabel1_1) ? $SummaryTabel1_1 : [
    'total_kecamatan' => 17,
    'total_luas' => 165.505,
    'total_desa' => 132,
    'total_kelurahan' => 4
];
$summary1_2 = isset($SummaryTabel1_2) ? $SummaryTabel1_2 : [
    'total_item' => 19,
    'total_luas' => 165505.000,
    'total_persen' => 100.00,
    'max_tutupan' => 'Hutan',
    'max_luas' => 57095.000
];
$summary1_3 = isset($SummaryTabel1_3) ? $SummaryTabel1_3 : [
    'total_kecamatan' => 17,
    'kec_tertinggi' => 'Bungatan (0-1250 m dpl)',
    'kec_terendah' => 'Mangaran (0-50 m dpl)',
    'sumber' => 'Dinas Pekerjaan Umum Perumahan dan Permukiman Kabupaten Situbondo'
];
$summary1_4 = isset($SummaryTabel1_4) ? $SummaryTabel1_4 : [
    'total_bulan' => 12,
    'total_curah' => 25730.00,
    'total_hari' => 157,
    'bulan_terbasah' => 'Februari (6.549 mm)',
    'bulan_terkering' => 'September (116 mm)',
    'hari_terbanyak' => 'Januari (27 Hari)',
    'sumber' => 'Badan Pusat Statistik Kabupaten Situbondo Dalam Angka, 2026'
];
$summary1_5 = isset($SummaryTabel1_5) ? $SummaryTabel1_5 : [
    'total_kecamatan' => 17,
    'total_laki' => 339857,
    'total_perempuan' => 354902,
    'total_penduduk' => 694759,
    'rasio_total' => 95.76,
    'kec_terbanyak' => 'Panji (67.923 Jiwa)',
    'kec_tersedikit' => 'Jatibanteng (23.319 Jiwa)',
    'sumber' => 'Badan Pusat Statistik Kabupaten Situbondo Tahun 2026'
];
$summary1_6 = isset($SummaryTabel1_6) ? $SummaryTabel1_6 : [
    'total_kecamatan' => 17,
    'total_2024' => 691635,
    'total_2025' => 694759,
    'pertumbuhan_total' => 0.45,
    'tumbuh_tertinggi' => 'Jangkar (0,73%)',
    'tumbuh_terendah' => 'Asembagus (0,27%)',
    'sumber' => 'Badan Pusat Statistik Kabupaten Situbondo Tahun 2026'
];
$summary1_7 = isset($SummaryTabel1_7) ? $SummaryTabel1_7 : [
    'total_kecamatan' => 17,
    'total_masuk' => 1603,
    'total_keluar' => 1843,
    'netto' => -240,
    'max_masuk' => 'Panji (228 Jiwa)',
    'max_keluar' => 'Banyuputih (262 Jiwa)',
    'sumber' => 'Badan Pusat Statistik Kabupaten Situbondo Tahun 2026'
];
$summary1_8 = isset($SummaryTabel1_8) ? $SummaryTabel1_8 : [
    'total_kategori' => 3,
    'total_laki' => 6553,
    'total_perempuan' => 5883,
    'total_asn' => 12436,
    'kategori_terbanyak' => 'PPPK Paruh Waktu (5.814 Orang)',
    'sumber' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Tahun 2026'
];
$summary1_9 = isset($SummaryTabel1_9) ? $SummaryTabel1_9 : [
    'total_tingkat' => 10,
    'pns_l' => 2417, 'pns_p' => 2372,
    'pppk_penuh_l' => 734, 'pppk_penuh_p' => 1099,
    'pppk_paruh_l' => 3402, 'pppk_paruh_p' => 2412,
    'total_asn' => 12436,
    'pendidikan_terbanyak' => 'S1/Sarjana (7.229 Orang)',
    'sumber' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Tahun 2026'
];
$summary1_10 = isset($SummaryTabel1_10) ? $SummaryTabel1_10 : [
    'total_anggaran_2025' => 1750518897402.00,
    'total_realisasi_2025' => 1800911300151.50,
    'total_selisih' => 50392402749.50,
    'total_persen' => 102.88,
    'total_realisasi_2024' => 1838398660788.09,
    'total_realisasi_2023' => 1815035360718.99,
    'total_realisasi_2022' => 1717196006641.04,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_11 = isset($SummaryTabel1_11) ? $SummaryTabel1_11 : [
    'total_target_2025' => 95608439254.00,
    'total_realisasi_2025' => 101579639887.40,
    'total_persen' => 106.25,
    'total_pertumbuhan' => 56.50,
    'sumber' => 'BAPENDA Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_12 = isset($SummaryTabel1_12) ? $SummaryTabel1_12 : [
    'total_target_2025' => 154503239288.00,
    'total_realisasi_2025' => 163468830248.82,
    'total_persen' => 105.80,
    'total_selisih' => 8965590960.82,
    'sumber' => 'Bapenda Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_13 = isset($SummaryTabel1_13) ? $SummaryTabel1_13 : [
    'total_target_2025' => 4965202287.00,
    'total_realisasi_2025' => 4989642157.03,
    'total_persen' => 100.49,
    'total_pertumbuhan' => -2.51,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_14 = isset($SummaryTabel1_14) ? $SummaryTabel1_14 : [
    'total_target_2025' => 47663144592.00,
    'total_realisasi_2025' => 50938653895.25,
    'total_persen' => 106.87,
    'total_pertumbuhan' => -72.85,
    'sumber' => 'Bapenda Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_15 = isset($SummaryTabel1_15) ? $SummaryTabel1_15 : [
    'total_target_2025' => 1447778871981.00,
    'total_realisasi_2025' => 1479934567563.00,
    'total_persen' => 102.22,
    'total_pertumbuhan' => -5.54,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_16 = isset($SummaryTabel1_16) ? $SummaryTabel1_16 : [
    'total_anggaran_2025' => 1851757572766.00,
    'total_realisasi_2025' => 1746064770629.08,
    'total_selisih' => -105692802136.92,
    'total_persen' => 94.29,
    'total_realisasi_2024' => 1907087812190.03,
    'total_realisasi_2023' => 1900286068905.39,
    'total_realisasi_2022' => 1778985460306.73,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_17 = isset($SummaryTabel1_17) ? $SummaryTabel1_17 : [
    'tot_pusat_anggaran' => 2300000000.00, 'tot_pusat_realisasi' => 2213926373.36,
    'tot_badan_anggaran' => 44634376006.00, 'tot_badan_realisasi' => 41077366476.39,
    'tot_parpol_anggaran' => 949679000.00, 'tot_parpol_realisasi' => 949679000.00,
    'tot_bosp_anggaran' => 26968918403.00, 'tot_bosp_realisasi' => 27046941702.00,
    'tot_total_anggaran' => 74852973409.00, 'tot_total_realisasi' => 71287913551.75,
    'tot_persen' => 95.24,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_18 = isset($SummaryTabel1_18) ? $SummaryTabel1_18 : [
    'tot_individu_anggaran' => 0.00, 'tot_individu_realisasi' => 0.00,
    'tot_pokmas_anggaran' => 9405000000.00, 'tot_pokmas_realisasi' => 9405000000.00,
    'tot_lembaga_anggaran' => 0.00, 'tot_lembaga_realisasi' => 0.00,
    'tot_total_anggaran' => 9405000000.00, 'tot_total_realisasi' => 9405000000.00,
    'tot_persen' => 100.00,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_19 = isset($SummaryTabel1_19) ? $SummaryTabel1_19 : [
    'penerimaan_realisasi' => 104238675365.12,
    'pengeluaran_realisasi' => 0.00,
    'netto_realisasi' => 104238675365.12,
    'silpa_realisasi' => 159085204887.54,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
$summary1_20 = isset($SummaryTabel1_20) ? $SummaryTabel1_20 : [
    'total_silpa' => 159085204886.86,
    'total_komponen' => 5,
    'sumber' => 'BKAD Kabupaten Situbondo Tahun 2026, unaudited'
];
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
:root {
  --ui-primary: #00c292;
  --ui-primary-hover: #00a87e;
  --ui-primary-light: #e8f8f5;
  --ui-primary-border: #b2dfdb;
  --ui-primary-text: #007a5a;
  
  --ui-table-header: #00c292;
  --ui-table-header-hover: #00a87e;
  --ui-table-title: #007a5a;
  --ui-table-stripe: #f2faf7;
  --ui-table-hover: #dcf5ec;
  --ui-table-border: #d4ece5;
  
  --ui-blue: #2563eb;
  --ui-blue-light: #eff6ff;
  --ui-blue-border: #bfdbfe;
  --ui-red: #ef4444;
  --ui-red-light: #fee2e2;
  --ui-amber: #f59e0b;
  --ui-amber-light: #fef3c7;
  --ui-green: #10b981;
  --ui-green-light: #d1fae5;
  
  --ui-dark: #0f172a;
  --ui-text-main: #1e293b;
  --ui-text-muted: #64748b;
  --ui-bg: #f8fafc;
  --ui-card-bg: #ffffff;
  --ui-border: #e2e8f0;
  --ui-border-light: #f1f5f9;
  
  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 14px;
  --shadow-card: 0 1px 3px rgba(15,23,42,0.06), 0 1px 2px rgba(15,23,42,0.04);
  --shadow-hover: 0 10px 25px -5px rgba(15,23,42,0.08), 0 8px 10px -6px rgba(15,23,42,0.05);
  --shadow-modal: 0 25px 60px -15px rgba(15,23,42,0.3);
}

* { box-sizing: border-box; }

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  background: var(--ui-bg);
  color: var(--ui-text-main);
  margin: 0;
  padding: 0;
  font-size: 13.5px;
}

.main-content {
  margin-left: var(--sidebar-width, 280px);
  padding: 24px 30px 80px;
  min-height: 100vh;
  transition: all var(--transition-speed, 0.3s) ease;
}

.sidebar-mini .main-content {
  margin-left: var(--sidebar-mini-width, 70px);
}

/* Page Header */
.page-header-box {
  margin-bottom: 20px;
}
.page-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--ui-primary-light);
  color: var(--ui-primary-text);
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 4px 10px;
  border-radius: 999px;
  margin-bottom: 8px;
}
.page-badge i { font-size: 13px; }
.page-title {
  font-size: 24px;
  font-weight: 800;
  color: var(--ui-dark);
  margin: 0 0 6px 0;
  letter-spacing: -0.01em;
}
.page-subtitle {
  color: var(--ui-text-muted);
  font-size: 13.5px;
  margin: 0;
}

/* Table Switcher Header Card */
.switcher-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  padding: 20px 24px;
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
}
.switcher-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #00c292 0%, #cf7e2f 50%, #2563eb 100%);
}

.switcher-top-row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.switcher-label-group {
  display: flex;
  align-items: center;
  gap: 12px;
}
.switcher-icon-box {
  width: 44px;
  height: 44px;
  border-radius: var(--radius-md);
  background: #e8f8f5;
  color: #00c292;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  border: 1px solid #b2dfdb;
}
.switcher-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--ui-dark);
  margin: 0;
}
.switcher-desc {
  font-size: 12.5px;
  color: var(--ui-text-muted);
  margin: 2px 0 0 0;
}

.switcher-controls {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
}

.select-tabel-custom {
  min-width: 320px;
  max-width: 480px;
  font-weight: 600;
  color: #0f172a;
  border: 1.5px solid #cbd5e1;
  border-radius: var(--radius-md);
  padding: 9px 14px;
  font-size: 13.5px;
  background-color: #f8fafc;
  outline: none;
  transition: all 0.2s;
  cursor: pointer;
}
.select-tabel-custom:focus {
  border-color: #00c292;
  background-color: #fff;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.btn-nav-tabel {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 14px;
  border-radius: var(--radius-md);
  font-size: 13px;
  font-weight: 600;
  border: 1px solid var(--ui-border);
  background: #fff;
  color: var(--ui-text-main);
  cursor: pointer;
  transition: all 0.15s ease;
  text-decoration: none;
}
.btn-nav-tabel:hover {
  background: #f1f5f9;
  color: var(--ui-primary-text);
  border-color: #cbd5e1;
}

/* Quick Jump Pill Carousel */
.quick-pills-wrapper {
  border-top: 1px solid var(--ui-border-light);
  padding-top: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  overflow-x: auto;
  scrollbar-width: thin;
  padding-bottom: 4px;
}
.quick-pill-label {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--ui-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  white-space: nowrap;
  margin-right: 4px;
}
.quick-pill {
  padding: 5px 12px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  color: #475569;
  background: #f1f5f9;
  border: 1px solid transparent;
  white-space: nowrap;
  text-decoration: none;
  transition: all 0.15s ease;
}
.quick-pill:hover {
  background: #e2e8f0;
  color: #0f172a;
}
.quick-pill.active {
  background: #00c292;
  color: #ffffff;
  font-weight: 700;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.35);
}

/* Stat Summary Cards */
.stat-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-bottom: 24px;
}
.stat-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  padding: 16px 20px;
  box-shadow: var(--shadow-card);
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-hover);
}
.stat-info .stat-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--ui-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-bottom: 4px;
}
.stat-info .stat-value {
  font-size: 22px;
  font-weight: 800;
  color: var(--ui-dark);
  line-height: 1.2;
}
.stat-icon {
  width: 46px;
  height: 46px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}
.stat-icon.icon-teal { background: var(--ui-primary-light); color: var(--ui-primary); }
.stat-icon.icon-amber { background: #fff7ed; color: #cf7e2f; }
.stat-icon.icon-blue { background: var(--ui-blue-light); color: var(--ui-blue); }
.stat-icon.icon-purple { background: #f5f3ff; color: #8b5cf6; }

/* Table Container Box */
.table-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  margin-bottom: 30px;
}

.table-toolbar {
  padding: 16px 20px;
  background: #ffffff;
  border-bottom: 1px solid var(--ui-border);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.toolbar-left, .toolbar-right {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
}

.search-input-box {
  position: relative;
  min-width: 240px;
}
.search-input-box i {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--ui-text-muted);
  font-size: 13px;
}
.search-input-box input {
  width: 100%;
  padding: 8px 12px 8px 34px;
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  font-size: 13px;
  background: #f8fafc;
  outline: none;
  transition: all 0.2s;
}
.search-input-box input:focus {
  border-color: var(--ui-primary);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

/* Action Buttons */
.btn-ui {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 600;
  border-radius: var(--radius-md);
  border: none;
  cursor: pointer;
  transition: all 0.15s ease;
  text-decoration: none;
}
.btn-ui-primary {
  background: #00c292;
  color: #fff;
}
.btn-ui-primary:hover {
  background: #00a87e;
  box-shadow: 0 2px 8px rgba(0, 194, 146, 0.35);
  color: #fff;
}
.btn-ui-amber,
.btn-ui-notika {
  background: #00c292;
  color: #fff;
}
.btn-ui-amber:hover,
.btn-ui-notika:hover {
  background: #00a87e;
  box-shadow: 0 4px 12px rgba(0, 194, 146, 0.35);
  color: #fff;
}
.btn-ui-outline {
  background: #fff;
  border: 1px solid var(--ui-border);
  color: var(--ui-text-main);
}
.btn-ui-outline:hover {
  background: #f1f5f9;
  border-color: #00c292;
  color: #007a5a;
}

/* Document Title Header over Table */
.doc-table-header-banner {
  padding: 24px 24px 16px;
  text-align: center;
  background: #ffffff;
  border-bottom: 2px solid #e8f8f5;
}
.doc-table-title {
  font-size: 19px;
  font-weight: 800;
  color: #007a5a;
  margin: 0 0 6px 0;
  letter-spacing: -0.01em;
}
.doc-table-subtitle {
  font-size: 13px;
  color: var(--ui-text-muted);
  margin: 0;
}

/* Table Style - Notika Green Theme */
.table-responsive-notika {
  width: 100%;
  overflow-x: auto;
}
.table-custom-notika {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 13.5px;
}
.table-custom-notika thead th {
  background: linear-gradient(135deg, #00c292 0%, #00a87e 100%) !important;
  color: #ffffff !important;
  font-weight: 700;
  padding: 12px 14px;
  border: 1px solid rgba(255, 255, 255, 0.25) !important;
  vertical-align: middle;
  text-align: center;
  letter-spacing: 0.02em;
}
.table-custom-notika thead th.th-kecamatan {
  text-align: left;
  padding-left: 20px;
}
.table-custom-notika tbody tr {
  transition: background-color 0.15s ease;
}
.table-custom-notika tbody tr:nth-child(even) {
  background-color: #ffffff;
}
.table-custom-notika tbody tr:nth-child(odd) {
  background-color: #f2faf7;
}
.table-custom-notika tbody tr:hover {
  background-color: #dcf5ec !important;
}
.table-custom-notika tbody td {
  padding: 10px 14px;
  border: 1px solid #d4ece5;
  color: #1e293b;
  vertical-align: middle;
}
.table-custom-notika tbody td.td-center {
  text-align: center;
}
.table-custom-notika tbody td.td-right {
  text-align: right;
  font-family: 'Roboto Mono', monospace;
  font-size: 13px;
  font-weight: 600;
  color: #0f172a;
}
.table-custom-notika tbody td.td-kecamatan {
  font-weight: 600;
  color: #0f172a;
  padding-left: 20px;
}
.table-custom-notika tfoot th {
  background-color: #eef9f5 !important;
  color: #007a5a !important;
  font-weight: 800;
  font-size: 14px;
  padding: 13px 14px;
  border-top: 2.5px solid #00c292 !important;
  border-bottom: 2.5px solid #00c292 !important;
}
.table-custom-notika tfoot th.th-total-label {
  text-align: center;
  font-size: 15px;
  color: #007a5a !important;
  letter-spacing: 0.03em;
}
.table-custom-notika tfoot th.th-total-num {
  text-align: right;
  font-family: 'Roboto Mono', monospace;
  font-size: 14px;
  color: #007a5a !important;
}
.table-custom-notika tfoot th.th-total-center {
  text-align: center;
  font-family: 'Roboto Mono', monospace;
  font-size: 14px;
  color: #007a5a !important;
}

/* Action Icons */
.btn-action-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  border-radius: var(--radius-sm);
  border: none;
  cursor: pointer;
  transition: all 0.15s;
  font-size: 12px;
}
.btn-action-edit {
  background: #e8f8f5;
  color: #007a5a;
}
.btn-action-edit:hover {
  background: #00c292;
  color: #fff;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.4);
}
.btn-action-del {
  background: var(--ui-red-light);
  color: var(--ui-red);
}
.btn-action-del:hover {
  background: var(--ui-red);
  color: #fff;
  box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
}

/* Empty State Box */
.empty-table-state {
  text-align: center;
  padding: 40px 20px;
  color: var(--ui-text-muted);
}
.empty-table-state i {
  font-size: 48px;
  color: #a7f3d0;
  margin-bottom: 12px;
}

/* Modal Styling - Selalu Muncul Tepat di Tengah Layar (Center Viewport) */
.modal-overlay {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(15, 23, 42, 0.65) !important;
  backdrop-filter: blur(5px) !important;
  -webkit-backdrop-filter: blur(5px) !important;
  z-index: 9999999 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 20px !important;
  margin: 0 !important;
  box-sizing: border-box !important;
  opacity: 0 !important;
  visibility: hidden !important;
  pointer-events: none !important;
  transition: opacity 0.22s ease, visibility 0.22s ease !important;
}
.modal-overlay.show {
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
}
.modal-box {
  background: #ffffff !important;
  border-radius: 14px !important;
  box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4) !important;
  width: 100% !important;
  max-width: 560px !important;
  margin: auto !important;
  max-height: 90vh !important;
  display: flex !important;
  flex-direction: column !important;
  overflow: hidden !important;
  position: relative !important;
  transform: scale(0.93) translateY(0) !important;
  transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.22s ease !important;
}
.modal-overlay.show .modal-box {
  transform: scale(1) translateY(0) !important;
}
.modal-header {
  padding: 18px 24px !important;
  background: #e8f8f5 !important;
  border-bottom: 1.5px solid #b2dfdb !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  flex-shrink: 0 !important;
}
.modal-title {
  font-size: 16px !important;
  font-weight: 700 !important;
  color: #007a5a !important;
  margin: 0 !important;
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
}
.modal-close-btn {
  background: none;
  border: none;
  font-size: 20px;
  color: #64748b;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 6px;
  line-height: 1;
  transition: all 0.15s;
}
.modal-close-btn:hover {
  color: var(--ui-red);
  background: #fee2e2;
}
.modal-body {
  padding: 24px !important;
  max-height: calc(90vh - 140px) !important;
  overflow-y: auto !important;
  flex: 1 1 auto !important;
}
.form-group {
  margin-bottom: 16px;
}
.form-label {
  display: block;
  font-size: 12.5px;
  font-weight: 600;
  color: #334155;
  margin-bottom: 6px;
}
.form-label span.req {
  color: var(--ui-red);
}
.form-control-ui {
  width: 100%;
  padding: 9px 12px;
  border: 1.5px solid var(--ui-border);
  border-radius: var(--radius-md);
  font-size: 13.5px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  background: #ffffff;
}
.form-control-ui:focus {
  border-color: #00c292;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.form-row-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.modal-footer {
  padding: 14px 22px;
  background: #f8fafc;
  border-top: 1px solid var(--ui-border);
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 10px;
}

/* Print Only Styles */
@media print {
  body { background: #fff !important; }
  .sidebar-wrapper, .header-top-area, .switcher-card, .table-toolbar, .stat-grid, .btn-action-icon, .modal-overlay {
    display: none !important;
  }
  .main-content { margin: 0 !important; padding: 0 !important; }
  .table-card { border: none !important; box-shadow: none !important; }
  .doc-table-header-banner { padding: 0 0 15px 0 !important; }
  .table-custom-notika thead th { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
  .table-custom-notika tbody tr { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
}

/* Read-only Mode & Filter Wilayah Styling */
<?php if (empty($CanCrud)): ?>
th.no-print, td.no-print, .btn-action-icon, .btn-action-edit, .btn-action-del, .btn-crud-only {
  display: none !important;
}
<?php endif; ?>

.filter-wilayah-card {
  background: #ffffff;
  border-radius: var(--radius-lg, 12px);
  border: 1.5px solid #b2dfdb;
  box-shadow: 0 4px 16px rgba(0, 194, 146, 0.08);
  padding: 20px 24px;
  margin-bottom: 24px;
  background: linear-gradient(180deg, #f2faf7 0%, #ffffff 100%);
}
.filter-wilayah-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 16px;
}
.filter-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: #00c292;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
  box-shadow: 0 4px 10px rgba(0, 194, 146, 0.25);
}
.filter-wilayah-title {
  font-size: 16px;
  font-weight: 700;
  color: #007a5a;
  margin: 0 0 4px 0;
}
.filter-wilayah-desc {
  font-size: 12.5px;
  color: #64748b;
  margin: 0;
  line-height: 1.4;
}
.filter-wilayah-form {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-end;
  gap: 14px;
  padding: 16px;
  background: #ffffff;
  border-radius: var(--radius-md, 8px);
  border: 1px solid #d4ece5;
}
.filter-col {
  flex: 1 1 240px;
}
.filter-col label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: #334155;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.filter-select-ui {
  width: 100%;
  padding: 9px 12px;
  border: 1.5px solid #cbd5e1;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 600;
  color: #0f172a;
  background: #f8fafc;
  outline: none;
  transition: all 0.2s;
  cursor: pointer;
}
.filter-select-ui:focus {
  border-color: #00c292;
  background: #fff;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.filter-col-btn {
  flex-shrink: 0;
}
.btn-filter-apply {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 22px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 700;
  background: #00c292;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: all 0.15s ease;
  box-shadow: 0 2px 8px rgba(0, 194, 146, 0.3);
}
.btn-filter-apply:hover {
  background: #00a87e;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 194, 146, 0.4);
}
.filter-status-notice {
  margin-top: 12px;
  font-size: 12px;
  color: #64748b;
  display: flex;
  align-items: center;
  gap: 8px;
}
.filter-status-notice a {
  color: #007a5a;
  text-decoration: underline;
}

/* AI Narasi Card Styles */
.narasi-card-container {
  margin-top: 24px;
  margin-bottom: 30px;
  background: #ffffff;
  border: 1px solid #d4ece5;
  border-radius: 12px;
  box-shadow: 0 4px 15px -3px rgba(0, 194, 146, 0.08);
  overflow: hidden;
  transition: all 0.3s ease;
}
.narasi-card-header {
  background: linear-gradient(135deg, #f0fdf4 0%, #e6f9f3 100%);
  border-bottom: 1px solid #b2dfdb;
  padding: 16px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
}
.narasi-textarea {
  width: 100%;
  border: 1.5px solid #cbd5e1;
  border-radius: 8px;
  padding: 14px;
  font-size: 14px;
  line-height: 1.7;
  color: #1e293b;
  background: #ffffff;
  resize: vertical;
  transition: border-color 0.2s, box-shadow 0.2s;
  font-family: inherit;
  box-sizing: border-box;
}
.narasi-textarea:focus {
  border-color: #00c292;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
  outline: none;
}
@media print {
  .print-only-narasi { display: block !important; }
}

</style>

<div class="main-content">

  <!-- Breadcrumb & Page Title -->
  <div class="page-header-box">
    <div class="page-badge">
      <i class="fa fa-book"></i> E-LKPJ &bull; Bab I
      <?php if (!empty($NamaWilayah)): ?>
        &bull; <i class="fa fa-map-marker"></i> <?= htmlspecialchars($NamaWilayah) ?>
      <?php endif; ?>
      <?php if (!empty($IsRole4) && !empty($NamaInstansi)): ?>
        &bull; <i class="fa fa-building"></i> <?= htmlspecialchars($NamaInstansi) ?> (Role Instansi)
      <?php endif; ?>
    </div>
    <h1 class="page-title">BAB 1 : Pendahuluan & Gambaran Umum Daerah</h1>
    <p class="page-subtitle">Pencatatan dan pelaporan data statistik kondisi geografis, administratif, demografis, dan indikator makro daerah <?= htmlspecialchars($NamaWilayah ?: 'Kabupaten Situbondo') ?>.</p>
  </div>

  
  <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT BELUM LOGIN ATAU ROLE READ-ONLY: KEMENTERIAN / NASIONAL) -->
  <?php if (empty($IsLoggedIn) || !empty($IsReadOnly)): ?>
  <div class="filter-wilayah-card">
    <div class="filter-wilayah-header">
      <div class="filter-icon-box">
        <i class="fa fa-map-marker"></i>
      </div>
      <div>
        <h3 class="filter-wilayah-title">Pilih Wilayah (Provinsi & Daerah)</h3>
        <?php if (!empty($IsReadOnly)): ?>
        <p class="filter-wilayah-desc">Mode Pemantauan & Evaluasi LKPJ Daerah: <b>Akun <?= htmlspecialchars($UserRoleLabel ?? 'Kementerian/Nasional') ?> (Hanya Baca)</b>. Silakan pilih provinsi dan kabupaten/kota untuk meninjau data statistik LKPJ daerah.</p>
        <?php else: ?>
        <p class="filter-wilayah-desc">Anda sedang dalam mode pratinjau publik (belum login). Silakan pilih provinsi dan kabupaten/kota untuk melihat data statistik dokumen LKPJ daerah terkait.</p>
        <?php endif; ?>
      </div>
    </div>
    <div class="filter-wilayah-form">
      <div class="filter-col">
        <label for="filterProvinsi"><i class="fa fa-globe"></i> Provinsi</label>
        <select id="filterProvinsi" class="filter-select-ui">
          <option value="">-- Pilih Provinsi --</option>
          <?php if (!empty($Provinsi)): ?>
            <?php foreach ($Provinsi as $prov): ?>
              <option value="<?= htmlspecialchars($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) === $prov['Kode']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($prov['Nama']) ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <div class="filter-col">
        <label for="filterKabKota"><i class="fa fa-building"></i> Kabupaten / Kota</label>
        <select id="filterKabKota" class="filter-select-ui">
          <option value="">-- Pilih Kab/Kota --</option>
        </select>
      </div>
      <div class="filter-col-btn">
        <button type="button" id="btnFilterWilayah" class="btn-filter-apply">
          <i class="fa fa-search"></i> Tampilkan Data
        </button>
      </div>
    </div>
    <div class="filter-status-notice">
      <i class="fa fa-info-circle" style="color:#0284c7;font-size:14px;"></i>
      <?php if (!empty($IsReadOnly)): ?>
      <span>Hak Akses: <b>Mode Lihat Data (Hanya Baca)</b> untuk akun <b><?= htmlspecialchars($UserRoleLabel ?? 'Kementerian/Nasional') ?></b>. Penambahan, pengeditan, atau penghapusan data dikelola langsung oleh Pemerintah Daerah terkait.</span>
      <?php else: ?>
      <span>Mode Pratinjau: <b>Hanya Baca (Read-Only)</b>. Untuk menambah, mengubah, atau menghapus data wilayah ini, silakan <a href="<?= base_url('Home') ?>" style="color:#007a5a;font-weight:700;text-decoration:underline;">Login ke Akun Daerah / Instansi</a>.</span>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- Header Pemilihan Tabel: Dropdown & Quick Selector (Tabel 1.1 s/d Tabel 1.20) -->
  <div class="switcher-card">
    <div class="switcher-top-row">
      <div class="switcher-label-group">
        <div class="switcher-icon-box">
          <i class="fa fa-th-list"></i>
        </div>
        <div>
          <h2 class="switcher-title">Pilih Tabel BAB 1 (Tabel 1.1 s/d 1.20)</h2>
          <p class="switcher-desc">Gunakan menu pilihan untuk beralih antar tabel dokumen LKPJ Bab 1</p>
        </div>
      </div>

      <div class="switcher-controls">
        <!-- Dropdown Selector -->
        <select id="selectTabel" class="select-tabel-custom" onchange="switchTabel(this.value)">
          <?php foreach ($daftarTabel as $k => $tab): ?>
            <option value="<?= $k ?>" <?= ($activeTabel === $k) ? 'selected' : '' ?>>
              <?= $tab['nomor_tabel'] ?> - <?= $tab['judul_singkat'] ?>
            </option>
          <?php endforeach; ?>
        </select>

        <!-- Previous & Next Nav Buttons -->
        <?php
          $allKeys = array_keys($daftarTabel);
          $currIdx = array_search($activeTabel, $allKeys);
          $prevKey = ($currIdx > 0) ? $allKeys[$currIdx - 1] : null;
          $nextKey = ($currIdx < count($allKeys) - 1) ? $allKeys[$currIdx + 1] : null;
        ?>
        <?php if ($prevKey): ?>
          <a href="<?= base_url('Instansi/BAB1?tabel=' . $prevKey . '&tahun=' . $tahunAktif) ?>" class="btn-nav-tabel" title="Tabel Sebelumnya">
            <i class="fa fa-chevron-left"></i> Prev
          </a>
        <?php endif; ?>
        <?php if ($nextKey): ?>
          <a href="<?= base_url('Instansi/BAB1?tabel=' . $nextKey . '&tahun=' . $tahunAktif) ?>" class="btn-nav-tabel" title="Tabel Berikutnya">
            Next <i class="fa fa-chevron-right"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Quick Pill Selector 1.1 to 1.20 -->
    <div class="quick-pills-wrapper">
      <span class="quick-pill-label"><i class="fa fa-bolt"></i> Cepat:</span>
      <?php foreach ($daftarTabel as $k => $tab): ?>
        <a href="<?= base_url('Instansi/BAB1?tabel=' . $k . '&tahun=' . $tahunAktif) ?>" 
           class="quick-pill <?= ($activeTabel === $k) ? 'active' : '' ?>"
           title="<?= htmlspecialchars($tab['judul']) ?>">
          <?= $k ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.1 -->
  <?php if ($activeTabel === '1.1'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Kecamatan</div>
        <div class="stat-value" id="cardKecamatan"><?= count($itemsTabel1_1) ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-map-marker"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Luas Wilayah</div>
        <div class="stat-value" id="cardLuas"><?= number_format($summary['total_luas'], 3, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Ha</span></div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-globe"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Jumlah Desa</div>
        <div class="stat-value" id="cardDesa"><?= number_format($summary['total_desa'], 0, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-building-o"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Jumlah Kelurahan</div>
        <div class="stat-value" id="cardKelurahan"><?= number_format($summary['total_kelurahan'], 0, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-university"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.2 -->
  <?php elseif ($activeTabel === '1.2'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Jenis Tutupan Lahan</div>
        <div class="stat-value" id="cardTutupanTotal"><?= count($itemsTabel1_2) ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jenis</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-tree"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Luas Total</div>
        <div class="stat-value" id="cardLuasTotal1_2"><?= number_format($summary1_2['total_luas'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Ha</span></div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-map"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Prosentase</div>
        <div class="stat-value" id="cardPersenTotal1_2"><?= number_format($summary1_2['total_persen'], 2, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">%</span></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-pie-chart"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Tutupan Terluas</div>
        <div class="stat-value" id="cardTopTutupan" style="font-size:17px;font-weight:800;color:#007a5a;">
          <?= htmlspecialchars($summary1_2['max_tutupan'] ?? '-') ?>
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-leaf"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.3 -->
  <?php elseif ($activeTabel === '1.3'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Kecamatan</div>
        <div class="stat-value" id="cardKecamatan1_3"><?= count($itemsTabel1_3) ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Wilayah</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-map-marker"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Wilayah Tertinggi</div>
        <div class="stat-value" id="cardTertinggi1_3" style="font-size:16px;font-weight:800;color:#007a5a;">
          <?= htmlspecialchars($summary1_3['kec_tertinggi'] ?? '-') ?>
        </div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Wilayah Terendah</div>
        <div class="stat-value" id="cardTerendah1_3" style="font-size:16px;font-weight:800;color:#2563eb;">
          <?= htmlspecialchars($summary1_3['kec_terendah'] ?? '-') ?>
        </div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-arrow-down"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Sumber Data</div>
        <div class="stat-value" id="cardSumber1_3" style="font-size:14px;font-weight:700;color:#64748b;line-height:1.3;">
          DPUPP Situbondo
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-institution"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.4 -->
  <?php elseif ($activeTabel === '1.4'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Curah Hujan</div>
        <div class="stat-value" id="cardTotalCurah1_4"><?= number_format($summary1_4['total_curah'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">mm/thn</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-tint"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Hari Hujan</div>
        <div class="stat-value" id="cardTotalHari1_4"><?= number_format($summary1_4['total_hari'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Hari</span></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calendar-check-o"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Bulan Terbasah</div>
        <div class="stat-value" id="cardTerbasah1_4" style="font-size:16px;font-weight:800;color:#007a5a;">
          <?= htmlspecialchars($summary1_4['bulan_terbasah'] ?? '-') ?>
        </div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-cloud"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Bulan Terkering</div>
        <div class="stat-value" id="cardTerkering1_4" style="font-size:16px;font-weight:800;color:#f59e0b;">
          <?= htmlspecialchars($summary1_4['bulan_terkering'] ?? '-') ?>
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-sun-o"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.5 -->
  <?php elseif ($activeTabel === '1.5'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Penduduk</div>
        <div class="stat-value" id="cardTotalPenduduk1_5"><?= number_format($summary1_5['total_penduduk'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-users"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Penduduk Laki-Laki</div>
        <div class="stat-value" id="cardTotalLaki1_5" style="font-size:17px;font-weight:800;color:#2563eb;">
          <?= number_format($summary1_5['total_laki'], 0, ',', '.') ?> <span style="font-size:12.5px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span>
        </div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-male"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Penduduk Perempuan</div>
        <div class="stat-value" id="cardTotalPerempuan1_5" style="font-size:17px;font-weight:800;color:#8b5cf6;">
          <?= number_format($summary1_5['total_perempuan'], 0, ',', '.') ?> <span style="font-size:12.5px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span>
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-female"></i>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Rasio Jenis Kelamin</div>
        <div class="stat-value" id="cardRasioTotal1_5" style="font-size:17px;font-weight:800;color:#007a5a;">
          <?= number_format($summary1_5['rasio_total'], 2, ',', '.') ?>%
        </div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.6 -->
  <?php elseif ($activeTabel === '1.6'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Penduduk 2024</div>
        <div class="stat-value" id="cardPenduduk2024_1_6"><?= number_format($summary1_6['total_2024'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-users"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Penduduk 2025</div>
        <div class="stat-value" id="cardPenduduk2025_1_6" style="color:#00a87e;"><?= number_format($summary1_6['total_2025'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-user-plus"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Laju Pertumbuhan</div>
        <div class="stat-value" id="cardTumbuhTotal_1_6" style="color:#2563eb;"><?= number_format($summary1_6['pertumbuhan_total'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pertumbuhan Tertinggi</div>
        <div class="stat-value" id="cardMaxTumbuh_1_6" style="font-size:15px;font-weight:800;color:#8b5cf6;"><?= htmlspecialchars($summary1_6['tumbuh_tertinggi'] ?? '-') ?></div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-arrow-up"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.7 -->
  <?php elseif ($activeTabel === '1.7'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Migrasi Masuk</div>
        <div class="stat-value" id="cardMasuk1_7" style="color:#00a87e;"><?= number_format($summary1_7['total_masuk'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-sign-in"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Migrasi Keluar</div>
        <div class="stat-value" id="cardKeluar1_7" style="color:#f59e0b;"><?= number_format($summary1_7['total_keluar'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span></div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-sign-out"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Netto Migrasi</div>
        <div class="stat-value" id="cardNetto1_7" style="color:#2563eb;"><?= ($summary1_7['netto'] > 0 ? '+' : '') . number_format($summary1_7['netto'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Jiwa</span></div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-exchange"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Migrasi Masuk Terbanyak</div>
        <div class="stat-value" id="cardMaxMasuk1_7" style="font-size:15px;font-weight:800;color:#007a5a;"><?= htmlspecialchars($summary1_7['max_masuk'] ?? '-') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-map-marker"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.8 -->
  <?php elseif ($activeTabel === '1.8'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total ASN Situbondo</div>
        <div class="stat-value" id="cardTotalAsn1_8" style="color:#00a87e;"><?= number_format($summary1_8['total_asn'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-users"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pegawai Laki-Laki</div>
        <div class="stat-value" id="cardTotalLaki1_8" style="color:#2563eb;"><?= number_format($summary1_8['total_laki'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-male"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pegawai Perempuan</div>
        <div class="stat-value" id="cardTotalPerempuan1_8" style="color:#8b5cf6;"><?= number_format($summary1_8['total_perempuan'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-female"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Kategori Terbanyak</div>
        <div class="stat-value" id="cardMaxPeg1_8" style="font-size:14px;font-weight:800;color:#f59e0b;"><?= htmlspecialchars($summary1_8['kategori_terbanyak'] ?? '-') ?></div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-id-badge"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.9 -->
  <?php elseif ($activeTabel === '1.9'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Keseluruhan ASN</div>
        <div class="stat-value" id="cardTotalAsn1_9" style="color:#00a87e;"><?= number_format($summary1_9['total_asn'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-graduation-cap"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">PNS (L + P)</div>
        <div class="stat-value" id="cardTotalPns1_9" style="color:#2563eb;"><?= number_format($summary1_9['pns_l'] + $summary1_9['pns_p'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-briefcase"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">PPPK Penuh Waktu</div>
        <div class="stat-value" id="cardTotalPenuh1_9" style="color:#8b5cf6;"><?= number_format($summary1_9['pppk_penuh_l'] + $summary1_9['pppk_penuh_p'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-clock-o"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">PPPK Paruh Waktu</div>
        <div class="stat-value" id="cardTotalParuh1_9" style="color:#f59e0b;"><?= number_format($summary1_9['pppk_paruh_l'] + $summary1_9['pppk_paruh_p'], 0, ',', '.') ?> <span style="font-size:13px;font-weight:600;color:var(--ui-text-muted)">Orang</span></div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-calendar-check-o"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.10 -->
  <?php elseif ($activeTabel === '1.10'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Target Anggaran 2025</div>
        <div class="stat-value" id="cardAnggaran1_10" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_10['total_anggaran_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Pendapatan 2025</div>
        <div class="stat-value" id="cardRealisasi1_10" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_10['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_10" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_10['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Surplus Lebih / (Kurang)</div>
        <div class="stat-value" id="cardSelisih1_10" style="font-size:16px;font-weight:800;color:#8b5cf6;">
          <?= ($summary1_10['total_selisih'] >= 0 ? '+' : '') ?>Rp <?= number_format($summary1_10['total_selisih'], 2, ',', '.') ?>
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.11 -->
  <?php elseif ($activeTabel === '1.11'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Target Pajak Daerah 2025</div>
        <div class="stat-value" id="cardTarget1_11" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_11['total_target_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Pajak Daerah 2025</div>
        <div class="stat-value" id="cardRealisasi1_11" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_11['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_11" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_11['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pertumbuhan Realisasi (2024-2025)</div>
        <div class="stat-value" id="cardPertumbuhan1_11" style="font-size:16px;font-weight:800;color:#8b5cf6;">
          <?= ($summary1_11['total_pertumbuhan'] >= 0 ? '+' : '') ?><?= number_format($summary1_11['total_pertumbuhan'], 2, ',', '.') ?>%
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.12 -->
  <?php elseif ($activeTabel === '1.12'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Target Retribusi Daerah 2025</div>
        <div class="stat-value" id="cardTarget1_12" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_12['total_target_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Retribusi 2025</div>
        <div class="stat-value" id="cardRealisasi1_12" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_12['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_12" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_12['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Surplus Lebih / (Kurang)</div>
        <div class="stat-value" id="cardSelisih1_12" style="font-size:16px;font-weight:800;color:#8b5cf6;">
          <?= ($summary1_12['total_selisih'] >= 0 ? '+' : '') ?>Rp <?= number_format($summary1_12['total_selisih'], 2, ',', '.') ?>
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.13 -->
  <?php elseif ($activeTabel === '1.13'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Target Pengelolaan 2025</div>
        <div class="stat-value" id="cardTarget1_13" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_13['total_target_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Pengelolaan 2025</div>
        <div class="stat-value" id="cardRealisasi1_13" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_13['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_13" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_13['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pertumbuhan Realisasi (2024-2025)</div>
        <div class="stat-value" id="cardPertumbuhan1_13" style="font-size:16px;font-weight:800;color:<?= ($summary1_13['total_pertumbuhan'] < 0) ? '#dc2626' : '#15803d' ?>;">
          <?= ($summary1_13['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_13['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_13['total_pertumbuhan'], 2, ',', '.') ?>%
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.14 -->
  <?php elseif ($activeTabel === '1.14'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Target Lain-lain PAD 2025</div>
        <div class="stat-value" id="cardTarget1_14" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_14['total_target_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Lain-lain PAD 2025</div>
        <div class="stat-value" id="cardRealisasi1_14" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_14['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_14" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_14['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pertumbuhan Realisasi (2024-2025)</div>
        <div class="stat-value" id="cardPertumbuhan1_14" style="font-size:16px;font-weight:800;color:<?= ($summary1_14['total_pertumbuhan'] < 0) ? '#dc2626' : '#15803d' ?>;">
          <?= ($summary1_14['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_14['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_14['total_pertumbuhan'], 2, ',', '.') ?>%
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.15 -->
  <?php elseif ($activeTabel === '1.15'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Target Pendapatan Transfer 2025</div>
        <div class="stat-value" id="cardTarget1_15" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_15['total_target_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Pendapatan Transfer 2025</div>
        <div class="stat-value" id="cardRealisasi1_15" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_15['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_15" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_15['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pertumbuhan Realisasi (2024-2025)</div>
        <div class="stat-value" id="cardPertumbuhan1_15" style="font-size:16px;font-weight:800;color:<?= ($summary1_15['total_pertumbuhan'] < 0) ? '#dc2626' : '#15803d' ?>;">
          <?= ($summary1_15['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_15['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_15['total_pertumbuhan'], 2, ',', '.') ?>%
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-line-chart"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.16 -->
  <?php elseif ($activeTabel === '1.16'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Anggaran Belanja & Transfer 2025</div>
        <div class="stat-value" id="cardAnggaran1_16" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_16['total_anggaran_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue">
        <i class="fa fa-calculator"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Belanja & Transfer 2025</div>
        <div class="stat-value" id="cardRealisasi1_16" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_16['total_realisasi_2025'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal">
        <i class="fa fa-money"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_16" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_16['total_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber">
        <i class="fa fa-percent"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Selisih Lebih / (Kurang)</div>
        <div class="stat-value" id="cardSelisih1_16" style="font-size:15px;font-weight:800;color:<?= ($summary1_16['total_selisih'] < 0) ? '#dc2626' : '#15803d' ?>;">
          <?= ($summary1_16['total_selisih'] < 0) ? '(Rp ' . number_format(abs($summary1_16['total_selisih']), 2, ',', '.') . ')' : 'Rp ' . number_format($summary1_16['total_selisih'], 2, ',', '.') ?>
        </div>
      </div>
      <div class="stat-icon icon-purple">
        <i class="fa fa-balance-scale"></i>
      </div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.17 -->
  <?php elseif ($activeTabel === '1.17'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Anggaran Total Belanja Hibah 2025</div>
        <div class="stat-value" id="cardAnggaran1_17" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_17['tot_total_anggaran'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-calculator"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Total Belanja Hibah 2025</div>
        <div class="stat-value" id="cardRealisasi1_17" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_17['tot_total_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-gift"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_17" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_17['tot_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber"><i class="fa fa-percent"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Dana BOSP (Sekolah)</div>
        <div class="stat-value" id="cardBosp1_17" style="font-size:15px;font-weight:800;color:#7c3aed;">Rp <?= number_format($summary1_17['tot_bosp_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-purple"><i class="fa fa-graduation-cap"></i></div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.18 -->
  <?php elseif ($activeTabel === '1.18'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Anggaran Total Bansos 2025</div>
        <div class="stat-value" id="cardAnggaran1_18" style="font-size:16px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_18['tot_total_anggaran'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-calculator"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Realisasi Total Bansos 2025</div>
        <div class="stat-value" id="cardRealisasi1_18" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_18['tot_total_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-users"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Capaian Realisasi (%)</div>
        <div class="stat-value" id="cardPersen1_18" style="font-size:18px;font-weight:800;color:#059669;"><?= number_format($summary1_18['tot_persen'], 2, ',', '.') ?>%</div>
      </div>
      <div class="stat-icon icon-amber"><i class="fa fa-percent"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Bansos Kelompok Masyarakat</div>
        <div class="stat-value" id="cardPokmas1_18" style="font-size:15px;font-weight:800;color:#d97706;">Rp <?= number_format($summary1_18['tot_pokmas_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-purple"><i class="fa fa-handshake-o"></i></div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.19 -->
  <?php elseif ($activeTabel === '1.19'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Penerimaan Pembiayaan 2025</div>
        <div class="stat-value" id="cardPrm1_19" style="font-size:15px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_19['penerimaan_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-arrow-down"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pengeluaran Pembiayaan 2025</div>
        <div class="stat-value" id="cardPng1_19" style="font-size:15px;font-weight:800;color:#dc2626;">Rp <?= number_format($summary1_19['pengeluaran_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-purple"><i class="fa fa-arrow-up"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pembiayaan Netto 2025</div>
        <div class="stat-value" id="cardNetto1_19" style="font-size:15px;font-weight:800;color:#2563eb;">Rp <?= number_format($summary1_19['netto_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-balance-scale"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">SILPA Realisasi Tahun 2025</div>
        <div class="stat-value" id="cardSilpa1_19" style="font-size:15px;font-weight:800;color:#d97706;">Rp <?= number_format($summary1_19['silpa_realisasi'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-amber"><i class="fa fa-archive"></i></div>
    </div>
  </div>

  <!-- Stat Summary Cards for Tabel 1.20 -->
  <?php elseif ($activeTabel === '1.20'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Posisi Kas SILPA 2025</div>
        <div class="stat-value" id="cardTotal1_20" style="font-size:16px;font-weight:800;color:#00a87e;">Rp <?= number_format($summary1_20['total_silpa'], 2, ',', '.') ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-archive"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Kas di Kas Daerah</div>
        <div class="stat-value" id="cardKasda1_20" style="font-size:15px;font-weight:800;color:#2563eb;">Rp 142.802.611.211,01</div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-university"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Kas di BLUD</div>
        <div class="stat-value" id="cardBlud1_20" style="font-size:15px;font-weight:800;color:#7c3aed;">Rp 14.502.585.796,04</div>
      </div>
      <div class="stat-icon icon-purple"><i class="fa fa-hospital-o"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Jumlah Rekening Kas</div>
        <div class="stat-value" id="cardKomponen1_20" style="font-size:18px;font-weight:800;color:#d97706;"><?= $summary1_20['total_komponen'] ?> Komponen</div>
      </div>
      <div class="stat-icon icon-amber"><i class="fa fa-list-ol"></i></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Table Container Card -->
  <div class="table-card">
    <!-- Toolbar: Search & Action Buttons -->
    <div class="table-toolbar">
      <div class="toolbar-left">
        <div class="search-input-box">
          <i class="fa fa-search"></i>
          <input type="text" id="searchInput" placeholder="Cari data dalam tabel..." onkeyup="filterTable()">
        </div>

        <span style="font-size:12.5px;color:var(--ui-text-muted);font-weight:600;">
          Tahun: 
          <select id="selectTahun" onchange="changeYear(this.value)" style="padding:5px 10px;border-radius:6px;border:1px solid var(--ui-border);font-weight:600;">
            <?php foreach ([2027, 2026, 2025, 2024, 2023] as $th): ?>
              <option value="<?= $th ?>" <?= ($tahunAktif == $th) ? 'selected' : '' ?>><?= $th ?></option>
            <?php endforeach; ?>
          </select>
        </span>

        <?php if (!empty($NamaWilayah)): ?>
        <span style="display:inline-flex;align-items:center;gap:6px;background:#e8f8f5;color:#007a5a;font-weight:700;font-size:12.5px;padding:5px 12px;border-radius:6px;border:1px solid #b2dfdb;">
          <i class="fa fa-map-marker"></i> <?= htmlspecialchars($NamaWilayah) ?>
        </span>
        <?php endif; ?>

        <?php if (!empty($IsRole4) && !empty($NamaInstansi)): ?>
        <span style="display:inline-flex;align-items:center;gap:6px;background:#eff6ff;color:#1d4ed8;font-weight:700;font-size:12.5px;padding:5px 12px;border-radius:6px;border:1px solid #bfdbfe;">
          <i class="fa fa-building"></i> <?= htmlspecialchars($NamaInstansi) ?> (Role Instansi)
        </span>
        <?php endif; ?>
      </div>

      <div class="toolbar-right">
        <?php if (!empty($CanCrud)): ?>
        <?php if ($activeTabel === '1.1'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_1()">
            <i class="fa fa-plus"></i> Tambah Kecamatan
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_1()" title="Reset ke 17 Kecamatan Bawaan Dokumen">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.2'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_2()">
            <i class="fa fa-plus"></i> Tambah Tutupan Lahan
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_2()" title="Reset ke 19 Tutupan Lahan Bawaan Dokumen">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.3'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_3()">
            <i class="fa fa-plus"></i> Tambah Kecamatan
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_3()" title="Reset ke 17 Data Ketinggian Kecamatan Bawaan Dokumen">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.4'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_4()">
            <i class="fa fa-plus"></i> Tambah Data Iklim
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_4()" title="Reset ke 12 Bulan Kondisi Iklim Bawaan BPS">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.5'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_5()">
            <i class="fa fa-plus"></i> Tambah Penduduk Kecamatan
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_5()" title="Reset ke 17 Data Kependudukan Bawaan BPS">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.6'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_6()">
            <i class="fa fa-plus"></i> Tambah Pertumbuhan Penduduk
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_6()" title="Reset ke 17 Data Pertumbuhan Penduduk Bawaan BPS">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.7'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_7()">
            <i class="fa fa-plus"></i> Tambah Data Migrasi
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_7()" title="Reset ke 17 Data Migrasi Bawaan BPS">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.8'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_8()">
            <i class="fa fa-plus"></i> Tambah Kategori Pegawai
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_8()" title="Reset ke Data ASN Bawaan BKPSDM">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.9'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_9()">
            <i class="fa fa-plus"></i> Tambah Tingkat Pendidikan
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_9()" title="Reset ke Data Pendidikan ASN Bawaan BKPSDM">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.10'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_10()">
            <i class="fa fa-plus"></i> Tambah Rincian Pendapatan
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_10()" title="Reset ke Rincian Pendapatan Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.11'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_11()">
            <i class="fa fa-plus"></i> Tambah Rincian Pajak
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_11()" title="Reset ke Rincian Pajak Daerah Bawaan BAPENDA">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.12'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_12()">
            <i class="fa fa-plus"></i> Tambah Rincian Retribusi
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_12()" title="Reset ke Rincian Retribusi Daerah Bawaan Bapenda">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.13'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_13()">
            <i class="fa fa-plus"></i> Tambah Rincian Hasil
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_13()" title="Reset ke Rincian Hasil Pengelolaan Keuangan Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.14'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_14()">
            <i class="fa fa-plus"></i> Tambah Lain-lain PAD
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_14()" title="Reset ke Rincian Lain-lain PAD Bawaan Bapenda">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.15'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_15()">
            <i class="fa fa-plus"></i> Tambah Pendapatan Transfer
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_15()" title="Reset ke Rincian Pendapatan Transfer Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.16'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_16()">
            <i class="fa fa-plus"></i> Tambah Belanja & Transfer
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_16()" title="Reset ke Rincian Belanja dan Transfer Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.17'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_17()">
            <i class="fa fa-plus"></i> Tambah Belanja Hibah
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_17()" title="Reset ke Rincian Belanja Hibah Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.18'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_18()">
            <i class="fa fa-plus"></i> Tambah Belanja Bansos
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_18()" title="Reset ke Rincian Belanja Bansos Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.19'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_19()">
            <i class="fa fa-plus"></i> Tambah Pembiayaan Daerah
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_19()" title="Reset ke Rincian Pembiayaan Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php elseif ($activeTabel === '1.20'): ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambah1_20()">
            <i class="fa fa-plus"></i> Tambah Komponen SILPA
          </button>
          <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset1_20()" title="Reset ke Komponen SILPA Bawaan BKAD">
            <i class="fa fa-refresh"></i> Reset Data
          </button>
        <?php else: ?>
          <button class="btn-ui btn-ui-notika" onclick="openModalTambahGeneric()">
            <i class="fa fa-plus"></i> Tambah Baris
          </button>
        <?php endif; ?>
        <?php elseif (!empty($IsReadOnly)): ?>
        <span class="btn-ui btn-ui-outline" style="background:#f0fdf4; border-color:#86efac; color:#166534; cursor:default; font-weight:600; font-size:12.5px; display:inline-flex; align-items:center; gap:6px;" title="Akun <?= htmlspecialchars($UserRoleLabel ?? 'Kementerian/Nasional') ?> hanya memiliki hak akses melihat data (Read-Only)">
          <i class="fa fa-eye" style="color:#16a34a;"></i> Mode Lihat Data (<?= htmlspecialchars($UserRoleLabel ?? 'Kementerian/Nasional') ?>)
        </span>
        <?php else: ?>
        <a href="<?= base_url('Home') ?>" class="btn-ui btn-ui-notika" style="text-decoration:none;">
          <i class="fa fa-sign-in"></i> Login untuk Kelola Data
        </a>
        <?php endif; ?>

        <button class="btn-ui btn-ui-outline" onclick="exportTableToExcel()" title="Unduh data format Excel / CSV">
          <i class="fa fa-file-excel-o" style="color:#10b981"></i> Ekspor
        </button>
        <button class="btn-ui btn-ui-outline" onclick="window.print()" title="Cetak dokumen tabel">
          <i class="fa fa-print"></i> Cetak
        </button>
      </div>
    </div>

    <!-- Official Title Header matching reference image -->
    <div class="doc-table-header-banner">
      <h2 class="doc-table-title"><?= htmlspecialchars($metaTabel['judul'] ?? 'Tabel BAB 1') ?></h2>
      <p class="doc-table-subtitle"><?= htmlspecialchars($metaTabel['subjudul'] ?? '') ?></p>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.1 (Persis dengan gambar referensi Kabupaten Situbondo) -->
    <!-- ============================================================= -->
    <?php if ($activeTabel === '1.1'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 60px;">No</th>
            <th rowspan="2" class="th-kecamatan">Kecamatan</th>
            <th rowspan="2" style="width: 170px;">Luas (Ha)</th>
            <th colspan="2" style="width: 280px;">Jumlah</th>
            <th rowspan="2" style="width: 90px;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 140px;">Desa</th>
            <th style="width: 140px;">Kelurahan</th>
          </tr>
        </thead>
        <tbody id="tableBody1_1">
          <?php if (empty($itemsTabel1_1)): ?>
            <tr>
              <td colspan="6" class="empty-table-state">
                <i class="fa fa-folder-open-o"></i>
                <p>Belum ada data untuk tahun ini. Silakan klik tombol <b>Tambah Kecamatan</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_1 as $item): 
                $kelurahanVal = ((int)$item['jumlah_kelurahan'] > 0) ? (int)$item['jumlah_kelurahan'] : '-';
                $formattedLuas = number_format((float)$item['luas_ha'], 3, ',', '.');
            ?>
            <tr id="row-<?= $item['id'] ?>" data-id="<?= $item['id'] ?>" data-nomor="<?= $item['nomor'] ?>" data-kecamatan="<?= htmlspecialchars($item['kecamatan']) ?>" data-luas="<?= $item['luas_ha'] ?>" data-desa="<?= $item['jumlah_desa'] ?>" data-kelurahan="<?= $item['jumlah_kelurahan'] ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan"><?= htmlspecialchars($item['kecamatan']) ?></td>
              <td class="td-right"><?= $formattedLuas ?></td>
              <td class="td-center"><?= (int)$item['jumlah_desa'] ?></td>
              <td class="td-center"><?= $kelurahanVal ?></td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_1(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_1(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['kecamatan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label">Jumlah</th>
            <th class="th-total-num" id="footTotalLuas"><?= number_format($summary['total_luas'], 3, ',', '.') ?></th>
            <th class="th-total-center" id="footTotalDesa"><?= (int)$summary['total_desa'] ?></th>
            <th class="th-total-center" id="footTotalKelurahan"><?= (int)$summary['total_kelurahan'] ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.2 (Persis dengan gambar referensi Kabupaten Situbondo) -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.2'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th style="width: 60px;">No</th>
            <th class="th-kecamatan">Tutupan Lahan</th>
            <th style="width: 200px; text-align: right; padding-right: 24px;">Luas (Ha)</th>
            <th style="width: 180px; text-align: right; padding-right: 24px;">Prosentase (%)</th>
            <th style="width: 90px;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_2">
          <?php if (empty($itemsTabel1_2)): ?>
            <tr>
              <td colspan="5" class="empty-table-state">
                <i class="fa fa-tree"></i>
                <p>Belum ada data tutupan lahan untuk tahun ini. Silakan klik tombol <b>Tambah Tutupan Lahan</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_2 as $item): 
                $luasVal = (float)$item['luas_ha'];
                $persenVal = (float)$item['prosentase'];
                
                // Format Luas persis gambar (titik ribuan, tanpa koma desimal jika bulat)
                $formattedLuas = (floor($luasVal) == $luasVal) ? number_format($luasVal, 0, ',', '.') : number_format($luasVal, 2, ',', '.');
                
                // Format Prosentase: 3 desimal untuk angka sangat kecil (0,001 & 0,002), selebihnya 2 desimal
                if ($persenVal < 0.01 && $persenVal > 0) {
                  $formattedPersen = number_format($persenVal, 3, ',', '.');
                } else {
                  $formattedPersen = number_format($persenVal, 2, ',', '.');
                }
            ?>
            <tr id="row1_2-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-tutupan="<?= htmlspecialchars($item['tutupan_lahan']) ?>" 
                data-luas="<?= $formattedLuas ?>" 
                data-persen="<?= $formattedPersen ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan"><?= htmlspecialchars($item['tutupan_lahan']) ?></td>
              <td class="td-right" style="padding-right: 24px;"><?= $formattedLuas ?></td>
              <td class="td-right" style="padding-right: 24px;"><?= $formattedPersen ?></td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_2(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_2(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['tutupan_lahan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 15px;">Luas Total</th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalLuas1_2"><?= number_format($summary1_2['total_luas'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalPersen1_2"><?= number_format($summary1_2['total_persen'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.3 (Ketinggian Wilayah Per Kecamatan Kabupaten Situbondo) -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.3'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th style="width: 70px; text-align: center;">No</th>
            <th class="th-kecamatan" style="text-align: center;">Kecamatan</th>
            <th style="width: 250px; text-align: center;">Tinggi Wilayah</th>
            <th style="width: 90px;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_3">
          <?php if (empty($itemsTabel1_3)): ?>
            <tr>
              <td colspan="4" class="empty-table-state">
                <i class="fa fa-map-marker"></i>
                <p>Belum ada data ketinggian kecamatan untuk tahun ini. Silakan klik tombol <b>Tambah Kecamatan</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_3 as $item): 
            ?>
            <tr id="row1_3-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-kecamatan="<?= htmlspecialchars($item['kecamatan']) ?>" 
                data-tinggi="<?= htmlspecialchars($item['tinggi_wilayah']) ?>" 
                data-satuan="<?= htmlspecialchars($item['satuan'] ?? 'm dpl') ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan" style="text-align: center; font-weight: 500;"><?= htmlspecialchars($item['kecamatan']) ?></td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 600;"><?= htmlspecialchars($item['tinggi_wilayah']) ?></td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_3(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_3(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['kecamatan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Dinas Pekerjaan Umum Perumahan dan Permukiman Kabupaten Situbondo') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.4 (Kondisi Iklim Kabupaten Situbondo Menurut Bulan)   -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.4'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th style="width: 70px; text-align: center;">No</th>
            <th class="th-kecamatan" style="text-align: center;">Bulan</th>
            <th style="width: 260px; text-align: right; padding-right: 24px;">Jumlah Curah Hujan (mm/tahun)</th>
            <th style="width: 220px; text-align: right; padding-right: 24px;">Jumlah Hari Hujan (Hari)</th>
            <th style="width: 90px;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_4">
          <?php if (empty($itemsTabel1_4)): ?>
            <tr>
              <td colspan="5" class="empty-table-state">
                <i class="fa fa-cloud"></i>
                <p>Belum ada data iklim per bulan untuk tahun ini. Silakan klik tombol <b>Tambah Data Iklim</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_4 as $item): 
            ?>
            <tr id="row1_4-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-bulan="<?= htmlspecialchars($item['bulan']) ?>" 
                data-curah="<?= htmlspecialchars($item['curah_hujan']) ?>" 
                data-hari="<?= htmlspecialchars($item['hari_hujan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan" style="text-align: center; font-weight: 500;"><?= htmlspecialchars($item['bulan']) ?></td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['curah_hujan'], 0, ',', '.') ?>
              </td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['hari_hujan'], 0, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_4(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_4(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['bulan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 15px;">Jumlah Total</th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalCurah1_4"><?= number_format($summary1_4['total_curah'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalHari1_4"><?= number_format($summary1_4['total_hari'], 0, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Badan Pusat Statistik Kabupaten Situbondo Dalam Angka, 2026') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.5 (Jumlah Penduduk Menurut Kecamatan Situbondo 2025)  -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.5'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 60px; text-align: center; vertical-align: middle;">No</th>
            <th rowspan="2" class="th-kecamatan" style="text-align: center; vertical-align: middle;">Kecamatan</th>
            <th colspan="2" style="text-align: center;">Jenis Kelamin</th>
            <th rowspan="2" style="width: 220px; text-align: center; vertical-align: middle;">Rasio Jenis Kelamin (%)</th>
            <th rowspan="2" style="width: 90px; text-align: center; vertical-align: middle;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Laki- Laki</th>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Perempuan</th>
          </tr>
        </thead>
        <tbody id="tableBody1_5">
          <?php if (empty($itemsTabel1_5)): ?>
            <tr>
              <td colspan="6" class="empty-table-state">
                <i class="fa fa-users"></i>
                <p>Belum ada data kependudukan per kecamatan untuk tahun ini. Silakan klik tombol <b>Tambah Penduduk Kecamatan</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_5 as $item): 
            ?>
            <tr id="row1_5-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-kecamatan="<?= htmlspecialchars($item['kecamatan']) ?>" 
                data-laki="<?= htmlspecialchars($item['laki_laki']) ?>" 
                data-perempuan="<?= htmlspecialchars($item['perempuan']) ?>"
                data-rasio="<?= htmlspecialchars($item['rasio']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan" style="text-align: center; font-weight: 500;"><?= htmlspecialchars($item['kecamatan']) ?></td>
              <td class="td-num" style="padding-right: 20px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['laki_laki'], 0, ',', '.') ?>
              </td>
              <td class="td-num" style="padding-right: 20px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['perempuan'], 0, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['rasio'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_5(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_5(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['kecamatan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 15px;">Kabupaten Situbondo</th>
            <th class="th-total-num" style="padding-right: 20px; font-size: 15px; font-weight: 800;" id="footTotalLaki1_5"><?= number_format($summary1_5['total_laki'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 20px; font-size: 15px; font-weight: 800;" id="footTotalPerempuan1_5"><?= number_format($summary1_5['total_perempuan'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="text-align: center; font-size: 15px; font-weight: 800;" id="footTotalRasio1_5"><?= number_format($summary1_5['rasio_total'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Badan Pusat Statistik Kabupaten Situbondo Tahun 2026') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.6 (Persentase Pertumbuhan Penduduk Situbondo)         -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.6'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 60px; text-align: center; vertical-align: middle;">No</th>
            <th rowspan="2" class="th-kecamatan" style="text-align: center; vertical-align: middle;">Kecamatan</th>
            <th colspan="2" style="text-align: center;">Jumlah Penduduk</th>
            <th rowspan="2" style="width: 220px; text-align: center; vertical-align: middle;">Pertumbuhan Penduduk (%)</th>
            <th rowspan="2" style="width: 90px; text-align: center; vertical-align: middle;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 190px; text-align: right; padding-right: 20px;">2024</th>
            <th style="width: 190px; text-align: right; padding-right: 20px;">2025</th>
          </tr>
        </thead>
        <tbody id="tableBody1_6">
          <?php if (empty($itemsTabel1_6)): ?>
            <tr>
              <td colspan="6" class="empty-table-state">
                <i class="fa fa-line-chart"></i>
                <p>Belum ada data pertumbuhan penduduk per kecamatan. Silakan klik tombol <b>Tambah Pertumbuhan Penduduk</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_6 as $item): 
            ?>
            <tr id="row1_6-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-kecamatan="<?= htmlspecialchars($item['kecamatan']) ?>" 
                data-p24="<?= htmlspecialchars($item['penduduk_2024']) ?>" 
                data-p25="<?= htmlspecialchars($item['penduduk_2025']) ?>" 
                data-growth="<?= htmlspecialchars($item['pertumbuhan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan" style="text-align: center; font-weight: 500;"><?= htmlspecialchars($item['kecamatan']) ?></td>
              <td class="td-num" style="padding-right: 20px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['penduduk_2024'], 0, ',', '.') ?>
              </td>
              <td class="td-num" style="padding-right: 20px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['penduduk_2025'], 0, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['pertumbuhan'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_6(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_6(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['kecamatan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 15px;">Kab Situbondo</th>
            <th class="th-total-num" style="padding-right: 20px; font-size: 15px; font-weight: 800;" id="footTotalP2024_1_6"><?= number_format($summary1_6['total_2024'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 20px; font-size: 15px; font-weight: 800;" id="footTotalP2025_1_6"><?= number_format($summary1_6['total_2025'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="text-align: center; font-size: 15px; font-weight: 800;" id="footTotalTumbuh_1_6"><?= number_format($summary1_6['pertumbuhan_total'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Badan Pusat Statistik Kabupaten Situbondo Tahun 2026') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.7 (Jumlah Migrasi Masuk dan Keluar)                   -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.7'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 60px; text-align: center; vertical-align: middle;">No</th>
            <th rowspan="2" class="th-kecamatan" style="text-align: center; vertical-align: middle;">Kecamatan</th>
            <th colspan="2" style="text-align: center;">Migrasi</th>
            <th rowspan="2" style="width: 90px; text-align: center; vertical-align: middle;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 200px; text-align: right; padding-right: 24px;">Masuk</th>
            <th style="width: 200px; text-align: right; padding-right: 24px;">Keluar</th>
          </tr>
        </thead>
        <tbody id="tableBody1_7">
          <?php if (empty($itemsTabel1_7)): ?>
            <tr>
              <td colspan="5" class="empty-table-state">
                <i class="fa fa-exchange"></i>
                <p>Belum ada data migrasi masuk & keluar per kecamatan. Silakan klik tombol <b>Tambah Data Migrasi</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_7 as $item): 
            ?>
            <tr id="row1_7-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-kecamatan="<?= htmlspecialchars($item['kecamatan']) ?>" 
                data-masuk="<?= htmlspecialchars($item['migrasi_masuk']) ?>" 
                data-keluar="<?= htmlspecialchars($item['migrasi_keluar']) ?>" 
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td class="td-kecamatan" style="text-align: center; font-weight: 500;"><?= htmlspecialchars($item['kecamatan']) ?></td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['migrasi_masuk'], 0, ',', '.') ?>
              </td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['migrasi_keluar'], 0, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_7(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_7(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['kecamatan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 15px;">Kabupaten Situbondo</th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalMasuk1_7"><?= number_format($summary1_7['total_masuk'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalKeluar1_7"><?= number_format($summary1_7['total_keluar'], 0, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Badan Pusat Statistik Kabupaten Situbondo Tahun 2026') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.8 (Jumlah ASN berdasarkan Jenis Kelamin)             -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.8'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th style="width: 60px; text-align: center;">No</th>
            <th style="text-align: left; padding-left: 24px;">Jumlah Pegawai</th>
            <th style="width: 200px; text-align: right; padding-right: 24px;">Laki-Laki</th>
            <th style="width: 200px; text-align: right; padding-right: 24px;">Perempuan</th>
            <th style="width: 200px; text-align: right; padding-right: 24px;">Jumlah</th>
            <th style="width: 90px; text-align: center;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_8">
          <?php if (empty($itemsTabel1_8)): ?>
            <tr>
              <td colspan="6" class="empty-table-state">
                <i class="fa fa-users"></i>
                <p>Belum ada data jumlah ASN berdasarkan jenis kelamin. Silakan klik tombol <b>Tambah Kategori Pegawai</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_8 as $item): 
            ?>
            <tr id="row1_8-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-jenis="<?= htmlspecialchars($item['jenis_pegawai']) ?>" 
                data-laki="<?= htmlspecialchars($item['laki_laki']) ?>" 
                data-perempuan="<?= htmlspecialchars($item['perempuan']) ?>" 
                data-jumlah="<?= htmlspecialchars($item['jumlah']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td style="text-align: left; padding-left: 24px; font-weight: 600;"><?= htmlspecialchars($item['jenis_pegawai']) ?></td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['laki_laki'], 0, ',', '.') ?>
              </td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 600;">
                <?= number_format($item['perempuan'], 0, ',', '.') ?>
              </td>
              <td class="td-num" style="padding-right: 24px; font-family: 'Roboto Mono', monospace; font-weight: 700; color: #007a5a;">
                <?= number_format($item['jumlah'], 0, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_8(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_8(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['jenis_pegawai'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 24px; font-weight: 800; font-size: 15px;">Total</th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalLaki1_8"><?= number_format($summary1_8['total_laki'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalPerempuan1_8"><?= number_format($summary1_8['total_perempuan'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 24px; font-size: 15px; font-weight: 800;" id="footTotalAsn1_8"><?= number_format($summary1_8['total_asn'], 0, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Tahun 2026') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.9 (Jumlah ASN Menurut Tingkat Pendidikan)             -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.9'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 50px; text-align: center; vertical-align: middle;">No</th>
            <th rowspan="2" style="text-align: left; padding-left: 20px; vertical-align: middle;">Tingkat Pendidikan</th>
            <th colspan="2" style="text-align: center;">PNS</th>
            <th colspan="2" style="text-align: center;">PPPK Penuh Waktu</th>
            <th colspan="2" style="text-align: center;">PPPK Paruh Waktu</th>
            <th rowspan="2" style="width: 100px; text-align: right; padding-right: 20px; vertical-align: middle;">Jumlah</th>
            <th rowspan="2" style="width: 80px; text-align: center; vertical-align: middle;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 90px; text-align: right; padding-right: 14px;">Laki-Laki</th>
            <th style="width: 90px; text-align: right; padding-right: 14px;">Perempuan</th>
            <th style="width: 90px; text-align: right; padding-right: 14px;">Laki-Laki</th>
            <th style="width: 90px; text-align: right; padding-right: 14px;">Perempuan</th>
            <th style="width: 90px; text-align: right; padding-right: 14px;">Laki-Laki</th>
            <th style="width: 90px; text-align: right; padding-right: 14px;">Perempuan</th>
          </tr>
        </thead>
        <tbody id="tableBody1_9">
          <?php if (empty($itemsTabel1_9)): ?>
            <tr>
              <td colspan="10" class="empty-table-state">
                <i class="fa fa-graduation-cap"></i>
                <p>Belum ada data ASN menurut tingkat pendidikan. Silakan klik tombol <b>Tambah Tingkat Pendidikan</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_9 as $item): 
            ?>
            <tr id="row1_9-<?= $item['id'] ?>" 
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= $item['nomor'] ?>" 
                data-tingkat="<?= htmlspecialchars($item['tingkat_pendidikan']) ?>" 
                data-pnsl="<?= htmlspecialchars($item['pns_l']) ?>" 
                data-pnsp="<?= htmlspecialchars($item['pns_p']) ?>" 
                data-penuhl="<?= htmlspecialchars($item['pppk_penuh_l']) ?>" 
                data-penuhp="<?= htmlspecialchars($item['pppk_penuh_p']) ?>" 
                data-paruhl="<?= htmlspecialchars($item['pppk_paruh_l']) ?>" 
                data-paruhp="<?= htmlspecialchars($item['pppk_paruh_p']) ?>" 
                data-jumlah="<?= htmlspecialchars($item['jumlah']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center"><?= $item['nomor'] ?? $no ?></td>
              <td style="text-align: left; padding-left: 20px; font-weight: 600;"><?= htmlspecialchars($item['tingkat_pendidikan']) ?></td>
              <td class="td-num" style="padding-right: 14px; font-family: 'Roboto Mono', monospace; font-weight: 500;">
                <?= ($item['pns_l'] > 0) ? number_format($item['pns_l'], 0, ',', '.') : '-' ?>
              </td>
              <td class="td-num" style="padding-right: 14px; font-family: 'Roboto Mono', monospace; font-weight: 500;">
                <?= ($item['pns_p'] > 0) ? number_format($item['pns_p'], 0, ',', '.') : '-' ?>
              </td>
              <td class="td-num" style="padding-right: 14px; font-family: 'Roboto Mono', monospace; font-weight: 500;">
                <?= ($item['pppk_penuh_l'] > 0) ? number_format($item['pppk_penuh_l'], 0, ',', '.') : '-' ?>
              </td>
              <td class="td-num" style="padding-right: 14px; font-family: 'Roboto Mono', monospace; font-weight: 500;">
                <?= ($item['pppk_penuh_p'] > 0) ? number_format($item['pppk_penuh_p'], 0, ',', '.') : '-' ?>
              </td>
              <td class="td-num" style="padding-right: 14px; font-family: 'Roboto Mono', monospace; font-weight: 500;">
                <?= ($item['pppk_paruh_l'] > 0) ? number_format($item['pppk_paruh_l'], 0, ',', '.') : '-' ?>
              </td>
              <td class="td-num" style="padding-right: 14px; font-family: 'Roboto Mono', monospace; font-weight: 500;">
                <?= ($item['pppk_paruh_p'] > 0) ? number_format($item['pppk_paruh_p'], 0, ',', '.') : '-' ?>
              </td>
              <td class="td-num" style="padding-right: 20px; font-family: 'Roboto Mono', monospace; font-weight: 700; color: #007a5a;">
                <?= number_format($item['jumlah'], 0, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_9(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_9(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['tingkat_pendidikan'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 15px;">Total</th>
            <th class="th-total-num" style="padding-right: 14px; font-size: 14px; font-weight: 800;" id="footPnsL1_9"><?= number_format($summary1_9['pns_l'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 14px; font-size: 14px; font-weight: 800;" id="footPnsP1_9"><?= number_format($summary1_9['pns_p'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 14px; font-size: 14px; font-weight: 800;" id="footPenuhL1_9"><?= number_format($summary1_9['pppk_penuh_l'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 14px; font-size: 14px; font-weight: 800;" id="footPenuhP1_9"><?= number_format($summary1_9['pppk_penuh_p'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 14px; font-size: 14px; font-weight: 800;" id="footParuhL1_9"><?= number_format($summary1_9['pppk_paruh_l'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 14px; font-size: 14px; font-weight: 800;" id="footParuhP1_9"><?= number_format($summary1_9['pppk_paruh_p'], 0, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 20px; font-size: 15px; font-weight: 800;" id="footTotalAsn1_9"><?= number_format($summary1_9['total_asn'], 0, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Tahun 2026') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.10 (Target, Realisasi & Capaian Pendapatan Daerah)    -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.10'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th style="width: 45px; text-align: center;">No</th>
            <th style="text-align: left; min-width: 260px;">Uraian</th>
            <th style="text-align: right; min-width: 170px;">Anggaran 2025 (Rp.)</th>
            <th style="text-align: right; min-width: 170px;">Realisasi 2025 (Rp.)</th>
            <th style="text-align: right; min-width: 170px;">Lebih/(Kurang) (Rp.)</th>
            <th style="text-align: center; width: 75px;">%</th>
            <th style="text-align: right; min-width: 170px;">Realisasi 2024 (Rp.)</th>
            <th style="text-align: right; min-width: 170px;">Realisasi 2023 (Rp.)</th>
            <th style="text-align: right; min-width: 170px;">Realisasi 2022 (Rp.)</th>
            <th style="width: 80px; text-align: center;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_10">
          <?php if (empty($itemsTabel1_10)): ?>
            <tr>
              <td colspan="10" class="empty-table-state">
                <i class="fa fa-money"></i>
                <p>Belum ada rincian pendapatan daerah untuk tahun ini. Silakan klik tombol <b>Tambah Rincian Pendapatan</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              $no = 1;
              foreach ($itemsTabel1_10 as $item): 
                $isHeader = ((int)$item['is_header'] === 1);
                $rowStyle = $isHeader ? 'background: #f0fdf4; font-weight: 700;' : '';
            ?>
            <tr id="row1_10-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-anggaran="<?= htmlspecialchars($item['anggaran_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-selisih="<?= htmlspecialchars($item['selisih']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-r24="<?= htmlspecialchars($item['realisasi_2024']) ?>" 
                data-r23="<?= htmlspecialchars($item['realisasi_2023']) ?>" 
                data-r22="<?= htmlspecialchars($item['realisasi_2022']) ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= $isHeader ? 'font-weight:800;' : '' ?>">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $isHeader ? 'font-weight: 800; color:#0f172a;' : 'padding-left: 28px; font-style: italic; color:#334155;' ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['anggaran_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['selisih'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2024'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2023'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2022'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_10(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_10(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #e6f7f2;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 14px; text-transform: uppercase;">
              JUMLAH PENDAPATAN DAERAH
            </th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footAnggaran1_10"><?= number_format($summary1_10['total_anggaran_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footRealisasi1_10"><?= number_format($summary1_10['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footSelisih1_10"><?= number_format($summary1_10['total_selisih'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center;" id="footPersen1_10"><?= number_format($summary1_10['total_persen'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footR24_1_10"><?= number_format($summary1_10['total_realisasi_2024'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footR23_1_10"><?= number_format($summary1_10['total_realisasi_2023'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footR22_1_10"><?= number_format($summary1_10['total_realisasi_2022'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.11 (Rincian Pajak Daerah Tahun 2025 - BAPENDA)        -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.11'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 110px; text-align: center; vertical-align: middle;">No</th>
            <th rowspan="2" style="text-align: left; min-width: 290px; vertical-align: middle;">Uraian</th>
            <th colspan="3" style="text-align: center; background: #e0f2fe; border-bottom: 1px solid #bae6fd;">2025</th>
            <th rowspan="2" style="text-align: center; min-width: 140px; vertical-align: middle;">Persentase Naik/Turun<br>Realisasi 2024-2025</th>
            <th rowspan="2" style="width: 85px; text-align: center; vertical-align: middle;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="text-align: right; min-width: 170px;">Target</th>
            <th style="text-align: right; min-width: 170px;">Realisasi</th>
            <th style="text-align: center; width: 75px;">%</th>
          </tr>
        </thead>
        <tbody id="tableBody1_11">
          <?php if (empty($itemsTabel1_11)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-percent"></i>
                <p>Belum ada data rincian pajak daerah untuk tahun ini. Silakan klik tombol <b>Tambah Rincian Pajak</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_11 as $item): 
                $isHeader = ((int)$item['is_header'] === 1);
                $lvl = (int)($item['level'] ?? 2);
                
                $rowStyle = '';
                $uraianStyle = '';
                if ($lvl === 1) {
                  $rowStyle = 'background: #f0fdf4; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #0f172a;';
                } elseif ($isHeader) {
                  $rowStyle = 'background: #f8fafc; font-weight: 700;';
                  $uraianStyle = 'font-weight: 700; color: #1e293b;';
                } elseif ($lvl === 3) {
                  $uraianStyle = 'padding-left: 32px; font-style: italic; color: #334155;';
                } else {
                  $uraianStyle = 'color: #1e293b;';
                }

                // Format Pertumbuhan
                $pVal = $item['pertumbuhan'];
                $pDisp = '-';
                $pColor = '#1e293b';
                if ($pVal !== null && $pVal !== '') {
                  $pf = (float)$pVal;
                  if ($pf < 0) {
                    $pDisp = '(' . number_format(abs($pf), 2, ',', '.') . ')';
                    $pColor = '#dc2626';
                  } elseif ($pf > 0) {
                    $pDisp = number_format($pf, 2, ',', '.');
                    $pColor = '#15803d';
                  } else {
                    $pDisp = '0,00';
                  }
                }
            ?>
            <tr id="row1_11-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-target="<?= htmlspecialchars($item['target_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-pertumbuhan="<?= ($item['pertumbuhan'] !== null ? htmlspecialchars($item['pertumbuhan']) : '') ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= ($lvl === 1 || $isHeader) ? 'font-weight:800;' : '' ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['target_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 600; color: <?= $pColor ?>;">
                <?= $pDisp ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_11(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_11(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #e6f7f2;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 14px; text-transform: uppercase;">
              JUMLAH PAJAK DAERAH
            </th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footTarget1_11"><?= number_format($summary1_11['total_target_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footRealisasi1_11"><?= number_format($summary1_11['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center;" id="footPersen1_11"><?= number_format($summary1_11['total_persen'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center;" id="footPertumbuhan1_11">
              <?= ($summary1_11['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_11['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_11['total_pertumbuhan'], 2, ',', '.') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BAPENDA Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.12 (Rincian Retribusi Daerah Tahun 2025 - Bapenda)    -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.12'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 110px; text-align: center; vertical-align: middle;">No</th>
            <th rowspan="2" style="text-align: left; min-width: 320px; vertical-align: middle;">Uraian</th>
            <th colspan="3" style="text-align: center; background: #e0f2fe; border-bottom: 1px solid #bae6fd;">2025</th>
            <th rowspan="2" style="width: 85px; text-align: center; vertical-align: middle;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="text-align: right; min-width: 170px;">Target</th>
            <th style="text-align: right; min-width: 170px;">Realisasi</th>
            <th style="text-align: center; width: 75px;">%</th>
          </tr>
        </thead>
        <tbody id="tableBody1_12">
          <?php if (empty($itemsTabel1_12)): ?>
            <tr>
              <td colspan="6" class="empty-table-state">
                <i class="fa fa-money"></i>
                <p>Belum ada data rincian retribusi daerah untuk tahun ini. Silakan klik tombol <b>Tambah Rincian Retribusi</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_12 as $item): 
                $isHeader = ((int)$item['is_header'] === 1);
                $lvl = (int)($item['level'] ?? 2);
                
                $rowStyle = '';
                $uraianStyle = '';
                if ($lvl === 1) {
                  $rowStyle = 'background: #f0fdf4; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #0f172a;';
                } elseif ($isHeader) {
                  $rowStyle = 'background: #f8fafc; font-weight: 700;';
                  $uraianStyle = 'font-weight: 700; color: #1e293b;';
                } elseif ($lvl === 3) {
                  $uraianStyle = 'padding-left: 32px; font-style: italic; color: #334155;';
                } else {
                  $uraianStyle = 'color: #1e293b;';
                }
            ?>
            <tr id="row1_12-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-target="<?= htmlspecialchars($item['target_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= ($lvl === 1 || $isHeader) ? 'font-weight:800;' : '' ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['target_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_12(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_12(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #e6f7f2;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 14px; text-transform: uppercase;">
              JUMLAH RETRIBUSI DAERAH
            </th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footTarget1_12"><?= number_format($summary1_12['total_target_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800;" id="footRealisasi1_12"><?= number_format($summary1_12['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center;" id="footPersen1_12"><?= number_format($summary1_12['total_persen'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Bapenda Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.13 (Rincian Hasil Pengelolaan Keuangan Daerah Dipisahkan) -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.13'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_13" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th rowspan="2" style="width: 110px; text-align: center; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">No</th>
            <th rowspan="2" style="text-align: left; min-width: 320px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th colspan="3" style="text-align: center; color: #fff; background: #e08e28; border-bottom: 1px solid #c26903;">2025</th>
            <th rowspan="2" style="text-align: center; min-width: 140px; vertical-align: middle; color: #fff; background: #d97706; border-left: 1px solid #c26903;">Persentase<br>Naik/Turun<br>Realisasi 2024-2025</th>
            <th rowspan="2" style="width: 85px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
          <tr style="color: #fff; background: #e08e28;">
            <th style="text-align: right; min-width: 160px; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Target</th>
            <th style="text-align: right; min-width: 160px; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi</th>
            <th style="text-align: center; width: 80px; color: #fff; background: #e08e28;">%</th>
          </tr>
        </thead>
        <tbody id="tableBody1_13">
          <?php if (empty($itemsTabel1_13)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-line-chart"></i>
                <p>Belum ada data rincian hasil pengelolaan keuangan daerah untuk tahun ini. Silakan klik tombol <b>Tambah Rincian Hasil</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_13 as $item): 
                $isHeader = ((int)$item['is_header'] === 1);
                $lvl = (int)($item['level'] ?? 2);
                
                $rowStyle = '';
                $uraianStyle = '';
                if ($lvl === 1) {
                  $rowStyle = 'background: #fdeee6; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #1e293b;';
                } elseif ($lvl === 2 && $isHeader) {
                  $rowStyle = 'background: #fcfbf9; font-weight: 700;';
                  $uraianStyle = 'font-weight: 700; color: #1e293b;';
                } elseif ($lvl === 3) {
                  $uraianStyle = 'padding-left: 28px; font-style: italic; color: #334155;';
                } else {
                  $uraianStyle = 'color: #1e293b;';
                }

                // Format Pertumbuhan
                $pVal = $item['pertumbuhan'];
                $pDisp = '-';
                $pColor = '#1e293b';
                if ($pVal !== null && $pVal !== '') {
                  $pf = (float)$pVal;
                  if ($pf < 0) {
                    $pDisp = '(' . number_format(abs($pf), 2, ',', '.') . ')';
                    $pColor = '#dc2626';
                  } elseif ($pf > 0) {
                    $pDisp = number_format($pf, 2, ',', '.');
                    $pColor = '#15803d';
                  } else {
                    $pDisp = '0,00';
                  }
                }
            ?>
            <tr id="row1_13-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-target="<?= htmlspecialchars($item['target_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-pertumbuhan="<?= htmlspecialchars($item['pertumbuhan'] ?? '') ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= ($lvl === 1 || $isHeader) ? 'font-weight:800;' : '' ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1) ? 'font-weight: 800;' : ($isHeader ? 'font-weight: 700;' : 'font-weight: 500;') ?>">
                <?= number_format($item['target_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1) ? 'font-weight: 800;' : ($isHeader ? 'font-weight: 700;' : 'font-weight: 500;') ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1) ? 'font-weight: 800;' : ($isHeader ? 'font-weight: 700;' : 'font-weight: 500;') ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 700; color: <?= $pColor ?>;">
                <?= $pDisp ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_13(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_13(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 13.5px; text-transform: uppercase; color: #9a3412;">
              JUMLAH HASIL PENGELOLAAN KEKAYAAN DAERAH
            </th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; color: #9a3412;" id="footTarget1_13"><?= number_format($summary1_13['total_target_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; color: #9a3412;" id="footRealisasi1_13"><?= number_format($summary1_13['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center; color: #9a3412;" id="footPersen1_13"><?= number_format($summary1_13['total_persen'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center; color: <?= ($summary1_13['total_pertumbuhan'] < 0) ? '#dc2626' : '#15803d' ?>;" id="footPertumbuhan1_13">
              <?= ($summary1_13['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_13['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_13['total_pertumbuhan'], 2, ',', '.') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.14 (Rincian Hasil Lain-Lain PAD yang Sah Tahun 2025)  -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.14'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_14" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th rowspan="2" style="width: 110px; text-align: center; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">No</th>
            <th rowspan="2" style="text-align: left; min-width: 320px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th colspan="3" style="text-align: center; color: #fff; background: #e08e28; border-bottom: 1px solid #c26903;">2025</th>
            <th rowspan="2" style="text-align: center; min-width: 140px; vertical-align: middle; color: #fff; background: #d97706; border-left: 1px solid #c26903;">Persentase<br>Naik/Turun<br>Realisasi 2024-2025</th>
            <th rowspan="2" style="width: 85px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
          <tr style="color: #fff; background: #e08e28;">
            <th style="text-align: right; min-width: 160px; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Target</th>
            <th style="text-align: right; min-width: 160px; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi</th>
            <th style="text-align: center; width: 80px; color: #fff; background: #e08e28;">%</th>
          </tr>
        </thead>
        <tbody id="tableBody1_14">
          <?php if (empty($itemsTabel1_14)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-money"></i>
                <p>Belum ada data rincian hasil lain-lain PAD yang sah untuk tahun ini. Silakan klik tombol <b>Tambah Lain-lain PAD</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_14 as $item): 
                $isHeader = ((int)$item['is_header'] === 1);
                $lvl = (int)($item['level'] ?? 2);
                
                $rowStyle = '';
                $uraianStyle = '';
                if ($lvl === 1 || $isHeader) {
                  $rowStyle = 'background: #fdeee6; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #1e293b;';
                } else {
                  $uraianStyle = 'color: #1e293b;';
                }

                // Format Pertumbuhan
                $pVal = $item['pertumbuhan'];
                $pDisp = '-';
                $pColor = '#1e293b';
                if ($pVal !== null && $pVal !== '') {
                  $pf = (float)$pVal;
                  if ($pf < 0) {
                    $pDisp = '(' . number_format(abs($pf), 2, ',', '.') . ')';
                    $pColor = '#dc2626';
                  } elseif ($pf > 0) {
                    $pDisp = number_format($pf, 2, ',', '.');
                    $pColor = '#15803d';
                  } else {
                    $pDisp = '0,00';
                  }
                }
            ?>
            <tr id="row1_14-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-target="<?= htmlspecialchars($item['target_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-pertumbuhan="<?= htmlspecialchars($item['pertumbuhan'] ?? '') ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= ($lvl === 1 || $isHeader) ? 'font-weight:800;' : '' ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['target_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= ($lvl === 1 || $isHeader) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 700; color: <?= $pColor ?>;">
                <?= $pDisp ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_14(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_14(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 13.5px; text-transform: uppercase; color: #9a3412;">
              JUMLAH LAIN-LAIN PAD YANG SAH
            </th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; color: #9a3412;" id="footTarget1_14"><?= number_format($summary1_14['total_target_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; color: #9a3412;" id="footRealisasi1_14"><?= number_format($summary1_14['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center; color: #9a3412;" id="footPersen1_14"><?= number_format($summary1_14['total_persen'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center; color: <?= ($summary1_14['total_pertumbuhan'] < 0) ? '#dc2626' : '#15803d' ?>;" id="footPertumbuhan1_14">
              <?= ($summary1_14['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_14['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_14['total_pertumbuhan'], 2, ',', '.') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'Bapenda Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.15 (Rincian Pendapatan Transfer Tahun 2025)           -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.15'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_15" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th rowspan="2" style="width: 110px; text-align: center; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">No</th>
            <th rowspan="2" style="text-align: left; min-width: 320px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th colspan="3" style="text-align: center; color: #fff; background: #e08e28; border-bottom: 1px solid #c26903;">2025</th>
            <th rowspan="2" style="text-align: center; min-width: 140px; vertical-align: middle; color: #fff; background: #d97706; border-left: 1px solid #c26903;">Persentase<br>Naik/Turun<br>Realisasi 2024-2025</th>
            <th rowspan="2" style="width: 85px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
          <tr style="color: #fff; background: #e08e28;">
            <th style="text-align: right; min-width: 160px; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Target</th>
            <th style="text-align: right; min-width: 160px; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi</th>
            <th style="text-align: center; width: 80px; color: #fff; background: #e08e28;">%</th>
          </tr>
        </thead>
        <tbody id="tableBody1_15">
          <?php if (empty($itemsTabel1_15)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-money"></i>
                <p>Belum ada data rincian pendapatan transfer untuk tahun ini. Silakan klik tombol <b>Tambah Pendapatan Transfer</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_15 as $item): 
                $isHeader = ((int)$item['is_header'] === 1);
                $lvl = (int)($item['level'] ?? 3);
                
                $rowStyle = '';
                $uraianStyle = '';
                $nomorStyle = '';
                if ($lvl === 1) {
                  $rowStyle = 'background: #fdeee6; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #1e293b; text-transform: uppercase;';
                  $nomorStyle = 'font-weight: 800;';
                } elseif ($lvl === 2) {
                  $rowStyle = 'background: #fdeee6; font-weight: 700;';
                  $uraianStyle = 'font-weight: 700; color: #1e293b;';
                  $nomorStyle = 'font-weight: 700;';
                } else {
                  $rowStyle = 'background: #ffffff;';
                  $uraianStyle = 'color: #1e293b; padding-left: 26px;';
                  $nomorStyle = 'font-weight: 500;';
                }

                // Format Pertumbuhan
                $pVal = $item['pertumbuhan'];
                $pDisp = '-';
                $pColor = '#1e293b';
                if ($pVal !== null && $pVal !== '') {
                  $pf = (float)$pVal;
                  if ($pf < 0) {
                    $pDisp = '(' . number_format(abs($pf), 2, ',', '.') . ')';
                    $pColor = '#dc2626';
                  } elseif ($pf > 0) {
                    $pDisp = number_format($pf, 2, ',', '.');
                    $pColor = '#15803d';
                  } else {
                    $pDisp = '0,00';
                  }
                }
            ?>
            <tr id="row1_15-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-target="<?= htmlspecialchars($item['target_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-pertumbuhan="<?= htmlspecialchars($item['pertumbuhan'] ?? '') ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= $nomorStyle ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl <= 2) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['target_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= ($lvl <= 2) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= ($lvl <= 2) ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; font-weight: 700; color: <?= $pColor ?>;">
                <?= $pDisp ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_15(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_15(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 13.5px; text-transform: uppercase; color: #9a3412;">
              JUMLAH PENDAPATAN TRANSFER
            </th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; color: #9a3412;" id="footTarget1_15"><?= number_format($summary1_15['total_target_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; color: #9a3412;" id="footRealisasi1_15"><?= number_format($summary1_15['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center; color: #9a3412;" id="footPersen1_15"><?= number_format($summary1_15['total_persen'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13.5px; font-weight: 800; text-align: center; color: <?= ($summary1_15['total_pertumbuhan'] < 0) ? '#dc2626' : '#15803d' ?>;" id="footPertumbuhan1_15">
              <?= ($summary1_15['total_pertumbuhan'] < 0) ? '(' . number_format(abs($summary1_15['total_pertumbuhan']), 2, ',', '.') . ')' : number_format($summary1_15['total_pertumbuhan'], 2, ',', '.') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.16 (Rincian Target, Realisasi & Capaian Belanja & Transfer) -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.16'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_16" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th style="width: 55px; text-align: center; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">No</th>
            <th style="text-align: left; min-width: 260px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th style="text-align: right; min-width: 145px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Anggaran 2025<br>(Rp.)</th>
            <th style="text-align: right; min-width: 145px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2025<br>(Rp.)</th>
            <th style="text-align: right; min-width: 145px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Lebih/(Kurang)<br>(Rp.)</th>
            <th style="text-align: center; width: 65px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">%</th>
            <th style="text-align: right; min-width: 145px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2024<br>(Rp.)</th>
            <th style="text-align: right; min-width: 145px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2023<br>(Rp.)</th>
            <th style="text-align: right; min-width: 145px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2022<br>(Rp.)</th>
            <th style="width: 80px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_16">
          <?php if (empty($itemsTabel1_16)): ?>
            <tr>
              <td colspan="10" class="empty-table-state">
                <i class="fa fa-money"></i>
                <p>Belum ada data rincian belanja dan transfer untuk tahun ini. Silakan klik tombol <b>Tambah Belanja & Transfer</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_16 as $item): 
                $isHeader = ((int)$item['is_header'] === 1 || (int)$item['level'] === 1);
                $lvl = (int)($item['level'] ?? 2);
                
                $rowStyle = '';
                $uraianStyle = '';
                $nomorStyle = '';
                if ($isHeader) {
                  $rowStyle = 'background: #fdeee6; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #1e293b; text-transform: uppercase;';
                  $nomorStyle = 'font-weight: 800;';
                } else {
                  $rowStyle = 'background: #ffffff;';
                  $uraianStyle = 'color: #1e293b; padding-left: 20px; font-style: italic;';
                  $nomorStyle = 'font-weight: 500;';
                }

                // Format Selisih Lebih / (Kurang)
                $selisihVal = (float)$item['selisih'];
                if ($selisihVal < 0) {
                  $selisihDisp = '(' . number_format(abs($selisihVal), 2, ',', '.') . ')';
                  $selisihColor = '#dc2626';
                } elseif ($selisihVal > 0) {
                  $selisihDisp = number_format($selisihVal, 2, ',', '.');
                  $selisihColor = '#15803d';
                } else {
                  $selisihDisp = '0,00';
                  $selisihColor = '#1e293b';
                }
            ?>
            <tr id="row1_16-<?= $item['id'] ?>" 
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>" 
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>" 
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>" 
                data-anggaran="<?= htmlspecialchars($item['anggaran_2025']) ?>" 
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>" 
                data-selisih="<?= htmlspecialchars($item['selisih']) ?>" 
                data-persen="<?= htmlspecialchars($item['persen']) ?>" 
                data-realisasi24="<?= htmlspecialchars($item['realisasi_2024']) ?>" 
                data-realisasi23="<?= htmlspecialchars($item['realisasi_2023']) ?>" 
                data-realisasi22="<?= htmlspecialchars($item['realisasi_2022']) ?>" 
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= $nomorStyle ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['anggaran_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-weight: <?= $isHeader ? '800' : '600' ?>; color: <?= $selisihColor ?>;">
                <?= $selisihDisp ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['persen'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2024'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2023'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2022'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_16(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_16(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th colspan="2" class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 13.5px; color: #9a3412;">
              Jumlah Belanja dan Transfer
            </th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #9a3412;" id="footAnggaran1_16"><?= number_format($summary1_16['total_anggaran_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #9a3412;" id="footRealisasi1_16"><?= number_format($summary1_16['total_realisasi_2025'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: <?= ($summary1_16['total_selisih'] < 0) ? '#dc2626' : '#15803d' ?>;" id="footSelisih1_16">
              <?= ($summary1_16['total_selisih'] < 0) ? '(' . number_format(abs($summary1_16['total_selisih']), 2, ',', '.') . ')' : number_format($summary1_16['total_selisih'], 2, ',', '.') ?>
            </th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; text-align: center; color: #9a3412;" id="footPersen1_16"><?= number_format($summary1_16['total_persen'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #9a3412;" id="footReal24_16"><?= number_format($summary1_16['total_realisasi_2024'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #9a3412;" id="footReal23_16"><?= number_format($summary1_16['total_realisasi_2023'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #9a3412;" id="footReal22_16"><?= number_format($summary1_16['total_realisasi_2022'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.17 (Rincian Belanja Hibah Tahun 2025)                 -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.17'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_17" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th rowspan="2" style="text-align: left; min-width: 200px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Hibah kepada Pemerintah Pusat</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Hibah kepada Badan, Lembaga, Ormas</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Hibah Bantuan Keuangan Parpol</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Hibah Dana BOSP</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Total Belanja Hibah</th>
            <th rowspan="2" style="width: 80px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
          <tr style="background: #e08e28; color: #fff; font-size: 12px;">
            <th style="text-align: right; min-width: 110px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 110px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 120px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 120px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 110px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 110px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 110px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 110px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 125px; color: #fff; background: #b45309; border-right: 1px solid #92400e;">Anggaran</th>
            <th style="text-align: right; min-width: 125px; color: #fff; background: #b45309; border-right: 1px solid #92400e;">Realisasi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_17">
          <?php if (empty($itemsTabel1_17)): ?>
            <tr>
              <td colspan="12" class="empty-table-state">
                <i class="fa fa-gift"></i>
                <p>Belum ada data rincian belanja hibah untuk tahun ini. Silakan klik tombol <b>Tambah Belanja Hibah</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsTabel1_17 as $item): ?>
            <tr id="row1_17-<?= $item['id'] ?>"
                data-id="<?= $item['id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>"
                data-pusat-ang="<?= htmlspecialchars($item['hibah_pusat_anggaran']) ?>"
                data-pusat-rea="<?= htmlspecialchars($item['hibah_pusat_realisasi']) ?>"
                data-badan-ang="<?= htmlspecialchars($item['hibah_badan_anggaran']) ?>"
                data-badan-rea="<?= htmlspecialchars($item['hibah_badan_realisasi']) ?>"
                data-parpol-ang="<?= htmlspecialchars($item['hibah_parpol_anggaran']) ?>"
                data-parpol-rea="<?= htmlspecialchars($item['hibah_parpol_realisasi']) ?>"
                data-bosp-ang="<?= htmlspecialchars($item['hibah_bosp_anggaran']) ?>"
                data-bosp-rea="<?= htmlspecialchars($item['hibah_bosp_realisasi']) ?>"
                data-total-ang="<?= htmlspecialchars($item['total_anggaran']) ?>"
                data-total-rea="<?= htmlspecialchars($item['total_realisasi']) ?>"
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td style="text-align: left; font-weight: 600; color: #1e293b;">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_pusat_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_pusat_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_badan_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_badan_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_parpol_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_parpol_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_bosp_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 11.5px;">
                <?= number_format($item['hibah_bosp_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-weight: 700; font-size: 12px; color: #0284c7;">
                <?= number_format($item['total_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-weight: 700; font-size: 12px; color: #059669;">
                <?= number_format($item['total_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_17(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_17(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 13px; color: #9a3412;">
              Jumlah
            </th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footPusatAngg1_17"><?= number_format($summary1_17['tot_pusat_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footPusatReal1_17"><?= number_format($summary1_17['tot_pusat_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footBadanAngg1_17"><?= number_format($summary1_17['tot_badan_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footBadanReal1_17"><?= number_format($summary1_17['tot_badan_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footParpolAngg1_17"><?= number_format($summary1_17['tot_parpol_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footParpolReal1_17"><?= number_format($summary1_17['tot_parpol_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footBospAngg1_17"><?= number_format($summary1_17['tot_bosp_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 11.5px; font-weight: 800; color: #9a3412;" id="footBospReal1_17"><?= number_format($summary1_17['tot_bosp_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12.5px; font-weight: 800; color: #0284c7;" id="footTotalAngg1_17"><?= number_format($summary1_17['tot_total_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12.5px; font-weight: 800; color: #059669;" id="footTotalReal1_17"><?= number_format($summary1_17['tot_total_realisasi'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.18 (Rincian Belanja Bantuan Sosial Tahun 2025)         -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.18'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_18" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th rowspan="2" style="text-align: left; min-width: 240px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Bantuan Sosial kepada Individu</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Bantuan Sosial kepada Kelompok Masyarakat</th>
            <th colspan="2" style="text-align: center; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Belanja Bantuan Sosial kepada Lembaga Non Pemerintahan<br><small>(Bidang Pendidikan, Keagamaan dan Bidang Lainnya)</small></th>
            <th colspan="2" style="text-align: center; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Total Belanja Bantuan Sosial</th>
            <th rowspan="2" style="width: 80px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
          <tr style="background: #e08e28; color: #fff; font-size: 12px;">
            <th style="text-align: right; min-width: 120px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 120px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 130px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 130px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 130px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Anggaran</th>
            <th style="text-align: right; min-width: 130px; color: #fff; background: #c97517; border-right: 1px solid #b45309;">Realisasi</th>
            <th style="text-align: right; min-width: 140px; color: #fff; background: #b45309; border-right: 1px solid #92400e;">Anggaran</th>
            <th style="text-align: right; min-width: 140px; color: #fff; background: #b45309; border-right: 1px solid #92400e;">Realisasi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_18">
          <?php if (empty($itemsTabel1_18)): ?>
            <tr>
              <td colspan="10" class="empty-table-state">
                <i class="fa fa-users"></i>
                <p>Belum ada data rincian belanja bantuan sosial. Silakan klik tombol <b>Tambah Belanja Bansos</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsTabel1_18 as $item): ?>
            <tr id="row1_18-<?= $item['id'] ?>"
                data-id="<?= $item['id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>"
                data-indiv-ang="<?= htmlspecialchars($item['bansos_individu_anggaran']) ?>"
                data-indiv-rea="<?= htmlspecialchars($item['bansos_individu_realisasi']) ?>"
                data-pokmas-ang="<?= htmlspecialchars($item['bansos_pokmas_anggaran']) ?>"
                data-pokmas-rea="<?= htmlspecialchars($item['bansos_pokmas_realisasi']) ?>"
                data-lembaga-ang="<?= htmlspecialchars($item['bansos_lembaga_anggaran']) ?>"
                data-lembaga-rea="<?= htmlspecialchars($item['bansos_lembaga_realisasi']) ?>"
                data-total-ang="<?= htmlspecialchars($item['total_anggaran']) ?>"
                data-total-rea="<?= htmlspecialchars($item['total_realisasi']) ?>"
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td style="text-align: left; font-weight: 600; color: #1e293b;">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 12px;">
                <?= number_format($item['bansos_individu_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 12px;">
                <?= number_format($item['bansos_individu_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 12px;">
                <?= number_format($item['bansos_pokmas_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 12px;">
                <?= number_format($item['bansos_pokmas_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 12px;">
                <?= number_format($item['bansos_lembaga_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 12px;">
                <?= number_format($item['bansos_lembaga_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-weight: 700; font-size: 12.5px; color: #0284c7;">
                <?= number_format($item['total_anggaran'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-weight: 700; font-size: 12.5px; color: #059669;">
                <?= number_format($item['total_realisasi'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_18(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_18(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th class="th-total-label" style="text-align: left; padding-left: 20px; font-weight: 800; font-size: 13px; color: #9a3412;">
              Jumlah
            </th>
            <th class="th-total-num" style="font-size: 12px; font-weight: 800; color: #9a3412;" id="footIndivAngg1_18"><?= number_format($summary1_18['tot_individu_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12px; font-weight: 800; color: #9a3412;" id="footIndivReal1_18"><?= number_format($summary1_18['tot_individu_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12px; font-weight: 800; color: #9a3412;" id="footPokmasAngg1_18"><?= number_format($summary1_18['tot_pokmas_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12px; font-weight: 800; color: #9a3412;" id="footPokmasReal1_18"><?= number_format($summary1_18['tot_pokmas_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12px; font-weight: 800; color: #9a3412;" id="footLembagaAngg1_18"><?= number_format($summary1_18['tot_lembaga_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 12px; font-weight: 800; color: #9a3412;" id="footLembagaReal1_18"><?= number_format($summary1_18['tot_lembaga_realisasi'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #0284c7;" id="footTotalAngg1_18"><?= number_format($summary1_18['tot_total_anggaran'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="font-size: 13px; font-weight: 800; color: #059669;" id="footTotalReal1_18"><?= number_format($summary1_18['tot_total_realisasi'], 2, ',', '.') ?></th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.19 (Target, Realisasi & Capaian Pembiayaan Daerah)     -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.19'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika table-tabel1_19" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th style="width: 45px; text-align: center; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">No</th>
            <th style="text-align: left; min-width: 280px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903;">Uraian</th>
            <th style="text-align: right; min-width: 140px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Anggaran 2025<br>(Rp.)</th>
            <th style="text-align: right; min-width: 140px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2025<br>(Rp.)</th>
            <th style="text-align: right; min-width: 140px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Lebih/(Kurang)<br>(Rp.)</th>
            <th style="text-align: center; width: 65px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">%</th>
            <th style="text-align: right; min-width: 140px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2024<br>(Rp.)</th>
            <th style="text-align: right; min-width: 140px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2023<br>(Rp.)</th>
            <th style="text-align: right; min-width: 140px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903;">Realisasi 2022<br>(Rp.)</th>
            <th style="width: 80px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_19">
          <?php if (empty($itemsTabel1_19)): ?>
            <tr>
              <td colspan="10" class="empty-table-state">
                <i class="fa fa-balance-scale"></i>
                <p>Belum ada data pembiayaan daerah untuk tahun ini. Silakan klik tombol <b>Tambah Pembiayaan Daerah</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php 
              foreach ($itemsTabel1_19 as $item): 
                $isHeader = ((int)$item['is_header'] === 1 || (int)$item['level'] === 1);
                
                $rowStyle = '';
                $uraianStyle = '';
                $nomorStyle = '';
                if ($isHeader) {
                  $rowStyle = 'background: #fdeee6; font-weight: 800;';
                  $uraianStyle = 'font-weight: 800; color: #1e293b; text-transform: uppercase;';
                  $nomorStyle = 'font-weight: 800;';
                } else {
                  $rowStyle = 'background: #ffffff;';
                  $uraianStyle = 'color: #1e293b; padding-left: 20px; font-style: italic;';
                  $nomorStyle = 'font-weight: 500;';
                }

                $selisihVal = (float)$item['selisih'];
                if ($selisihVal < 0) {
                  $selisihDisp = '(' . number_format(abs($selisihVal), 2, ',', '.') . ')';
                  $selisihColor = '#dc2626';
                } elseif ($selisihVal > 0) {
                  $selisihDisp = number_format($selisihVal, 2, ',', '.');
                  $selisihColor = '#15803d';
                } else {
                  $selisihDisp = '0,00';
                  $selisihColor = '#1e293b';
                }
            ?>
            <tr id="row1_19-<?= $item['id'] ?>"
                style="<?= $rowStyle ?>"
                data-id="<?= $item['id'] ?>"
                data-nomor="<?= htmlspecialchars($item['nomor'] ?? '') ?>"
                data-header="<?= $item['is_header'] ?>"
                data-level="<?= $item['level'] ?>"
                data-parent="<?= $item['parent_id'] ?>"
                data-uraian="<?= htmlspecialchars($item['uraian']) ?>"
                data-anggaran="<?= htmlspecialchars($item['anggaran_2025']) ?>"
                data-realisasi="<?= htmlspecialchars($item['realisasi_2025']) ?>"
                data-selisih="<?= htmlspecialchars($item['selisih']) ?>"
                data-persen="<?= htmlspecialchars($item['persen']) ?>"
                data-realisasi24="<?= htmlspecialchars($item['realisasi_2024']) ?>"
                data-realisasi23="<?= htmlspecialchars($item['realisasi_2023']) ?>"
                data-realisasi22="<?= htmlspecialchars($item['realisasi_2022']) ?>"
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td class="td-center" style="<?= $nomorStyle ?> font-family: 'Roboto Mono', monospace;">
                <?= htmlspecialchars($item['nomor'] ?? '') ?>
              </td>
              <td style="text-align: left; <?= $uraianStyle ?>">
                <?= htmlspecialchars($item['uraian']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['anggaran_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2025'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-weight: <?= $isHeader ? '800' : '600' ?>; color: <?= $selisihColor ?>;">
                <?= $selisihDisp ?>
              </td>
              <td class="td-center" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= htmlspecialchars($item['persen']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2024'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2023'], 2, ',', '.') ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; <?= $isHeader ? 'font-weight: 800;' : 'font-weight: 500;' ?>">
                <?= number_format($item['realisasi_2022'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_19(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_19(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['uraian'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL 1.20 (Komponen SILPA Kabupaten Situbondo Tahun 2025)     -->
    <!-- ============================================================= -->
    <?php elseif ($activeTabel === '1.20'): ?>
    <div class="table-responsive-notika" style="max-width: 850px; margin: 0 auto;">
      <table class="table-custom-notika table-tabel1_20" id="mainDataTable">
        <thead>
          <tr style="background: linear-gradient(135deg, #e08e28 0%, #c97517 100%); color: #fff;">
            <th style="text-align: left; min-width: 320px; vertical-align: middle; color: #fff; background: #d97706; border-right: 1px solid #c26903; padding: 12px 20px;">Komponen SILPA</th>
            <th style="text-align: right; min-width: 220px; vertical-align: middle; color: #fff; background: #e08e28; border-right: 1px solid #c26903; padding: 12px 20px;">Jumlah (Rp.)</th>
            <th style="width: 80px; text-align: center; vertical-align: middle; color: #fff; background: #d97706;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody1_20">
          <?php if (empty($itemsTabel1_20)): ?>
            <tr>
              <td colspan="3" class="empty-table-state">
                <i class="fa fa-archive"></i>
                <p>Belum ada data komponen SILPA untuk tahun ini. Silakan klik tombol <b>Tambah Komponen SILPA</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsTabel1_20 as $item): ?>
            <tr id="row1_20-<?= $item['id'] ?>"
                data-id="<?= $item['id'] ?>"
                data-komponen="<?= htmlspecialchars($item['komponen']) ?>"
                data-jumlah="<?= htmlspecialchars($item['jumlah']) ?>"
                data-urutan="<?= htmlspecialchars($item['urutan']) ?>"
                data-keterangan="<?= htmlspecialchars($item['keterangan'] ?? '') ?>">
              <td style="text-align: left; font-weight: 600; color: #1e293b; padding: 10px 20px;">
                <?= htmlspecialchars($item['komponen']) ?>
              </td>
              <td class="td-num" style="font-family: 'Roboto Mono', monospace; font-size: 13.5px; font-weight: 700; color: #0284c7; padding: 10px 20px;">
                <?= number_format($item['jumlah'], 2, ',', '.') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRow1_20(<?= $item['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRow1_20(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['komponen'])) ?>')" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr style="background: #fff7ed; border-top: 2px solid #fed7aa;">
            <th class="th-total-label" style="text-align: left; padding: 12px 20px; font-weight: 800; font-size: 14px; color: #9a3412;">
              Jumlah
            </th>
            <th class="th-total-num" style="font-size: 14.5px; font-weight: 800; color: #059669; padding: 12px 20px;" id="footTotal1_20">
              <?= number_format($summary1_20['total_silpa'], 2, ',', '.') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
      <div style="padding: 12px 20px; font-size: 12.5px; color: #475569; font-style: italic; border-top: 1px solid var(--ui-border-light); background: #fafdfc;">
        <strong>Sumber:</strong> <?= htmlspecialchars($metaTabel['sumber'] ?? 'BKAD Kabupaten Situbondo Tahun 2026, unaudited') ?>
      </div>
    </div>

    <!-- ============================================================= -->
    <!-- TABEL GENERIC (Fallback)                                      -->
    <!-- ============================================================= -->
    <?php else: ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <?php 
              $koloms = $metaTabel['kolom'] ?? ['No', 'Uraian', 'Nilai', 'Keterangan'];
              foreach ($koloms as $colName): 
            ?>
              <th><?= htmlspecialchars($colName) ?></th>
            <?php endforeach; ?>
            <th style="width: 90px;" class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBodyGeneric">
          <?php if (empty($itemsGeneric)): ?>
            <tr>
              <td colspan="<?= count($koloms) + 1 ?>" class="empty-table-state">
                <i class="fa fa-table"></i>
                <p>Belum ada rincian data untuk <b><?= htmlspecialchars($metaTabel['nomor_tabel'] ?? '') ?></b> pada tahun ini.</p>
                <button class="btn-ui btn-ui-primary" onclick="openModalTambahGeneric()" style="margin-top:10px;">
                  <i class="fa fa-plus"></i> Tambah Data Pertama
                </button>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsGeneric as $gen): ?>
            <tr id="row-gen-<?= $gen['id'] ?>" data-id="<?= $gen['id'] ?>" data-nomor="<?= $gen['nomor'] ?>" data-c1="<?= htmlspecialchars($gen['kolom_1'] ?? '') ?>" data-c2="<?= htmlspecialchars($gen['kolom_2'] ?? '') ?>" data-c3="<?= htmlspecialchars($gen['kolom_3'] ?? '') ?>" data-c4="<?= htmlspecialchars($gen['kolom_4'] ?? '') ?>" data-c5="<?= htmlspecialchars($gen['kolom_5'] ?? '') ?>" data-c6="<?= htmlspecialchars($gen['kolom_6'] ?? '') ?>">
              <td class="td-center"><?= $gen['nomor'] ?></td>
              <td class="td-kecamatan"><?= htmlspecialchars($gen['kolom_1'] ?? '-') ?></td>
              <?php if (isset($koloms[2])): ?>
                <td class="td-center"><?= htmlspecialchars($gen['kolom_2'] ?? '-') ?></td>
              <?php endif; ?>
              <?php if (isset($koloms[3])): ?>
                <td class="td-center"><?= htmlspecialchars($gen['kolom_3'] ?? '-') ?></td>
              <?php endif; ?>
              <?php if (isset($koloms[4])): ?>
                <td class="td-center"><?= htmlspecialchars($gen['kolom_4'] ?? '-') ?></td>
              <?php endif; ?>
              <?php if (isset($koloms[5])): ?>
                <td class="td-center"><?= htmlspecialchars($gen['kolom_5'] ?? '-') ?></td>
              <?php endif; ?>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editRowGeneric(<?= $gen['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteRowGeneric(<?= $gen['id'] ?>)" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <!-- Cetak Dokumen: Narasi Analisis Tabel Aktif -->
    <?php if (!empty($narasiTabel)): ?>
    <div class="print-only-narasi" style="display: none; margin-top: 20px; margin-bottom: 20px; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6;">
      <h5 style="margin-bottom: 8px; font-weight: bold; font-size: 12pt;">Narasi &amp; Interpretasi Tabel <?= htmlspecialchars($activeTabel) ?>:</h5>
      <p style="text-align: justify; text-indent: 30px; margin: 0;"><?= nl2br(htmlspecialchars($narasiTabel)) ?></p>
    </div>
    <?php endif; ?>

    <!-- ============================================================= -->
    <!-- NARASI & INTERPRETASI DATA (AI ASSISTANT GEMINI)              -->
    <!-- ============================================================= -->
    <div class="narasi-card-container no-print">
      <div class="narasi-card-header">
        <div style="display: flex; align-items: center; gap: 12px;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #00c292 0%, #008f6b 100%); display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 18px; box-shadow: 0 2px 8px rgba(0, 194, 146, 0.3);">
            <i class="fa fa-magic"></i>
          </div>
          <div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #007a5a; letter-spacing: -0.2px;">
                Narasi &amp; Interpretasi Data Tabel <?= htmlspecialchars($activeTabel) ?><?= !empty($metaTabel['judul_singkat']) ? ' (' . htmlspecialchars($metaTabel['judul_singkat']) . ')' : '' ?> (AI Assistant)
              </h4>
              <span style="display: inline-flex; align-items: center; gap: 4px; background: #dcfce7; color: #15803d; border: 1px solid #86efac; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 12px;">
                <i class="fa fa-bolt"></i> Gemini AI
              </span>
            </div>
            <p style="margin: 3px 0 0; font-size: 12px; color: #4b6358;">
              <i class="fa fa-user-circle"></i> <b>Persona:</b> Peneliti Riset Ekonomi Pembangunan &mdash; Analisis komprehensif, evaluatif, dan siap cetak untuk LKPJ.
            </p>
          </div>
        </div>
        <div style="display: flex; gap: 8px; align-items: center;">
          <button type="button" id="btnGenerateAI" onclick="generateNarasiAI('1', '<?= $activeTabel ?>')" class="btn-notika-primary" style="background: linear-gradient(135deg, #00c292 0%, #009688 100%); border: none; color: #fff; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 3px 10px rgba(0, 194, 146, 0.25); transition: all 0.2s ease;">
            <i class="fa fa-magic"></i> <span>Generate Narasi AI</span>
          </button>
        </div>
      </div>
      
      <div style="padding: 20px;">
        <div id="aiLoadingIndicator" style="display: none; padding: 18px; background: #f8fafc; border: 1px dashed #00c292; border-radius: 8px; margin-bottom: 15px; text-align: center;">
          <div style="display: inline-flex; align-items: center; gap: 10px; color: #007a5a; font-weight: 600; font-size: 14px;">
            <i class="fa fa-circle-o-notch fa-spin fa-lg"></i>
            <span>Gemini AI sedang meneliti dan menyusun narasi akademik Tabel <?= htmlspecialchars($activeTabel) ?>... Harap tunggu sejenak.</span>
          </div>
        </div>

        <div style="position: relative;">
          <textarea id="narasiTabelAktif" class="narasi-textarea" rows="7" placeholder="Narasi interpretasi data akan muncul di sini setelah di-generate oleh AI, atau Anda dapat mengetikkan analisis data secara manual..."><?= htmlspecialchars($narasiTabel) ?></textarea>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px; flex-wrap: wrap; gap: 10px;">
          <div style="font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px;">
            <i class="fa fa-info-circle" style="color: #00c292;"></i>
            <span>Anda dapat menyunting langsung teks di atas sebelum menyimpannya ke laporan LKPJ.</span>
          </div>
          <div style="display: flex; gap: 8px; align-items: center;">
            <button type="button" onclick="copyNarasiToClipboard()" class="btn btn-default btn-sm" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #334155; font-weight: 600; border-radius: 6px; padding: 6px 14px; display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
              <i class="fa fa-copy"></i> Salin Teks
            </button>
            <?php if (!empty($CanCrud)): ?>
            <button type="button" id="btnSimpanNarasi" onclick="simpanNarasi('1', '<?= $activeTabel ?>')" class="btn btn-success btn-sm" style="background: #00c292; border: 1px solid #00a87e; color: #fff; font-weight: 600; border-radius: 6px; padding: 6px 18px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(0, 194, 146, 0.2); cursor: pointer;">
              <i class="fa fa-save"></i> Simpan Narasi
            </button>
            <?php elseif (!empty($IsReadOnly)): ?>
            <button type="button" disabled title="Akun <?= htmlspecialchars($UserRoleLabel ?? 'Kementerian/Nasional') ?> hanya memiliki akses melihat data (Read-Only)" class="btn btn-default btn-sm" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #64748b; font-weight: 600; border-radius: 6px; padding: 6px 18px; display: inline-flex; align-items: center; gap: 6px; cursor: not-allowed;">
              <i class="fa fa-eye"></i> Simpan Narasi (Read-Only)
            </button>
            <?php else: ?>
            <button type="button" disabled title="Silakan login terlebih dahulu untuk menyimpan narasi" class="btn btn-default btn-sm" style="background: #e2e8f0; border: 1px solid #cbd5e1; color: #94a3b8; font-weight: 600; border-radius: 6px; padding: 6px 18px; display: inline-flex; align-items: center; gap: 6px; cursor: not-allowed;">
              <i class="fa fa-lock"></i> Simpan Narasi (Login Diperlukan)
            </button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.1                                            -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_1">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_1Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Kecamatan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_1')">&times;</button>
    </div>
    <form id="formTabel1_1" onsubmit="submitForm1_1(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_1_id" name="id" value="0">
        <input type="hidden" id="form1_1_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_1_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Luas Wilayah (Ha) <span class="req">*</span></label>
            <input type="text" id="form1_1_luas" name="luas_ha" class="form-control-ui" placeholder="Contoh: 8.965" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Nama Kecamatan <span class="req">*</span></label>
          <input type="text" id="form1_1_kecamatan" name="kecamatan" class="form-control-ui" placeholder="Nama kecamatan..." required>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Jumlah Desa <span class="req">*</span></label>
            <input type="number" id="form1_1_desa" name="jumlah_desa" class="form-control-ui" min="0" value="0" required>
          </div>
          <div class="form-group">
            <label class="form-label">Jumlah Kelurahan <span class="req">*</span></label>
            <input type="number" id="form1_1_kelurahan" name="jumlah_kelurahan" class="form-control-ui" min="0" value="0" required>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_1_ket" name="keterangan" class="form-control-ui" placeholder="Catatan batas atau kondisi...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_1')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_1">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.2 (Tutupan Lahan)                            -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_2">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_2Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Tutupan Lahan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_2')">&times;</button>
    </div>
    <form id="formTabel1_2" onsubmit="submitForm1_2(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_2_id" name="id" value="0">
        <input type="hidden" id="form1_2_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_2_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Luas (Ha) <span class="req">*</span></label>
            <input type="text" id="form1_2_luas" name="luas_ha" class="form-control-ui" placeholder="Contoh: 57.095 atau 477" required onkeyup="calcPersen1_2()">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Jenis Tutupan Lahan <span class="req">*</span></label>
          <input type="text" id="form1_2_tutupan" name="tutupan_lahan" class="form-control-ui" placeholder="Contoh: Hutan, Sawah, Sungai..." required>
        </div>

        <div class="form-group">
          <label class="form-label">Prosentase (%)</label>
          <div style="display:flex;gap:10px;align-items:center;">
            <input type="text" id="form1_2_persen" name="prosentase" class="form-control-ui" placeholder="Contoh: 34,53 atau 0,29">
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcPersen1_2(true)" style="white-space:nowrap;padding:9px 12px;" title="Hitung otomatis prosentase berdasarkan Luas Total 165.505 Ha">
              <i class="fa fa-calculator"></i> Hitung %
            </button>
          </div>
          <small style="color:var(--ui-text-muted);font-size:11.5px;margin-top:4px;display:block;">
            Dapat diisi manual atau dihitung otomatis berdasarkan luas total Kabupaten Situbondo (165.505 Ha).
          </small>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_2_ket" name="keterangan" class="form-control-ui" placeholder="Catatan sumber data atau peruntukan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_2')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_2">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.3 (Ketinggian Wilayah)                       -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_3">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_3Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Ketinggian Kecamatan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_3')">&times;</button>
    </div>
    <form id="formTabel1_3" onsubmit="submitForm1_3(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_3_id" name="id" value="0">
        <input type="hidden" id="form1_3_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_3_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Tinggi Wilayah <span class="req">*</span></label>
            <input type="text" id="form1_3_tinggi" name="tinggi_wilayah" class="form-control-ui" placeholder="Contoh: 0-500 atau 100-1223" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Nama Kecamatan <span class="req">*</span></label>
          <input type="text" id="form1_3_kecamatan" name="kecamatan" class="form-control-ui" placeholder="Contoh: Sumbermalang, Besuki..." required>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Satuan</label>
            <input type="text" id="form1_3_satuan" name="satuan" class="form-control-ui" value="m dpl" placeholder="m dpl">
          </div>
          <div class="form-group">
            <label class="form-label">Keterangan Tambahan (Opsional)</label>
            <input type="text" id="form1_3_ket" name="keterangan" class="form-control-ui" placeholder="Catatan topografi...">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_3')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_3">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.4 (Kondisi Iklim Menurut Bulan)              -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_4">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_4Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Iklim Bulan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_4')">&times;</button>
    </div>
    <form id="formTabel1_4" onsubmit="submitForm1_4(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_4_id" name="id" value="0">
        <input type="hidden" id="form1_4_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_4_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Bulan <span class="req">*</span></label>
            <select id="form1_4_bulan" name="bulan" class="form-control-ui" required>
              <option value="">-- Pilih Bulan --</option>
              <?php foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bln): ?>
                <option value="<?= $bln ?>"><?= $bln ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Jumlah Curah Hujan (mm/tahun) <span class="req">*</span></label>
            <input type="text" id="form1_4_curah" name="curah_hujan" class="form-control-ui" placeholder="Contoh: 6.205 atau 482" required>
          </div>
          <div class="form-group">
            <label class="form-label">Jumlah Hari Hujan (Hari) <span class="req">*</span></label>
            <input type="number" id="form1_4_hari" name="hari_hujan" class="form-control-ui" min="0" max="31" placeholder="Contoh: 27" required>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_4_ket" name="keterangan" class="form-control-ui" placeholder="Catatan data iklim...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_4')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_4">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.5 (Jumlah Penduduk Menurut Kecamatan)        -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_5">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_5Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Penduduk Kecamatan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_5')">&times;</button>
    </div>
    <form id="formTabel1_5" onsubmit="submitForm1_5(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_5_id" name="id" value="0">
        <input type="hidden" id="form1_5_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_5_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Nama Kecamatan <span class="req">*</span></label>
            <input type="text" id="form1_5_kecamatan" name="kecamatan" class="form-control-ui" placeholder="Contoh: Panji, Besuki..." required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Jumlah Laki-Laki (Jiwa) <span class="req">*</span></label>
            <input type="text" id="form1_5_laki" name="laki_laki" class="form-control-ui" placeholder="Contoh: 14.283 atau 14283" oninput="calcRasio1_5()" required>
          </div>
          <div class="form-group">
            <label class="form-label">Jumlah Perempuan (Jiwa) <span class="req">*</span></label>
            <input type="text" id="form1_5_perempuan" name="perempuan" class="form-control-ui" placeholder="Contoh: 14.710 atau 14710" oninput="calcRasio1_5()" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Rasio Jenis Kelamin (%)</label>
          <div style="display:flex;gap:8px;">
            <input type="text" id="form1_5_rasio" name="rasio" class="form-control-ui" placeholder="Contoh: 97,10 (Dihitung otomatis)">
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcRasio1_5(true)" style="white-space:nowrap;padding:9px 12px;" title="Hitung Rasio = (Laki / Perempuan) * 100">
              <i class="fa fa-calculator"></i> Hitung %
            </button>
          </div>
          <small style="color:var(--ui-text-muted);font-size:11.5px;margin-top:4px;display:block;">
            Dihitung otomatis berdasarkan rumus: (Laki-laki / Perempuan) &times; 100%.
          </small>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_5_ket" name="keterangan" class="form-control-ui" placeholder="Catatan data kependudukan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_5')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_5">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.6 (Pertumbuhan Penduduk)                     -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_6">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_6Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Pertumbuhan Penduduk
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_6')">&times;</button>
    </div>
    <form id="formTabel1_6" onsubmit="submitForm1_6(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_6_id" name="id" value="0">
        <input type="hidden" id="form1_6_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_6_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Nama Kecamatan <span class="req">*</span></label>
            <input type="text" id="form1_6_kecamatan" name="kecamatan" class="form-control-ui" placeholder="Contoh: Sumbermalang..." required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Jumlah Penduduk 2024 (Jiwa) <span class="req">*</span></label>
            <input type="text" id="form1_6_p24" name="penduduk_2024" class="form-control-ui" placeholder="Contoh: 28.906" oninput="calcPertumbuhan1_6()" required>
          </div>
          <div class="form-group">
            <label class="form-label">Jumlah Penduduk 2025 (Jiwa) <span class="req">*</span></label>
            <input type="text" id="form1_6_p25" name="penduduk_2025" class="form-control-ui" placeholder="Contoh: 28.993" oninput="calcPertumbuhan1_6()" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Pertumbuhan Penduduk (%)</label>
          <div style="display:flex;gap:8px;">
            <input type="text" id="form1_6_growth" name="pertumbuhan" class="form-control-ui" placeholder="Contoh: 0,30 (Dihitung otomatis)">
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcPertumbuhan1_6(true)" style="white-space:nowrap;padding:9px 12px;" title="Hitung = ((P2025 - P2024) / P2024) * 100">
              <i class="fa fa-calculator"></i> Hitung %
            </button>
          </div>
          <small style="color:var(--ui-text-muted);font-size:11.5px;margin-top:4px;display:block;">
            Dihitung otomatis berdasarkan rumus: ((Penduduk 2025 - Penduduk 2024) / Penduduk 2024) &times; 100%.
          </small>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_6_ket" name="keterangan" class="form-control-ui" placeholder="Catatan laju pertumbuhan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_6')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_6">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.7 (Migrasi Masuk & Keluar)                   -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_7">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_7Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Migrasi Kecamatan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_7')">&times;</button>
    </div>
    <form id="formTabel1_7" onsubmit="submitForm1_7(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_7_id" name="id" value="0">
        <input type="hidden" id="form1_7_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_7_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Nama Kecamatan <span class="req">*</span></label>
            <input type="text" id="form1_7_kecamatan" name="kecamatan" class="form-control-ui" placeholder="Contoh: Panarukan..." required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Migrasi Masuk (Jiwa) <span class="req">*</span></label>
            <input type="text" id="form1_7_masuk" name="migrasi_masuk" class="form-control-ui" placeholder="Contoh: 204" required>
          </div>
          <div class="form-group">
            <label class="form-label">Migrasi Keluar (Jiwa) <span class="req">*</span></label>
            <input type="text" id="form1_7_keluar" name="migrasi_keluar" class="form-control-ui" placeholder="Contoh: 172" required>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_7_ket" name="keterangan" class="form-control-ui" placeholder="Catatan data perpindahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_7')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_7">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.8 (Jumlah ASN berdasarkan Jenis Kelamin)     -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_8">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_8Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Kategori Pegawai ASN
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_8')">&times;</button>
    </div>
    <form id="formTabel1_8" onsubmit="submitForm1_8(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_8_id" name="id" value="0">
        <input type="hidden" id="form1_8_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_8_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Jenis Pegawai <span class="req">*</span></label>
            <input type="text" id="form1_8_jenis" name="jenis_pegawai" class="form-control-ui" placeholder="Contoh: PNS / PPPK Penuh Waktu" required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Pegawai Laki-Laki (Orang) <span class="req">*</span></label>
            <input type="text" id="form1_8_laki" name="laki_laki" class="form-control-ui" placeholder="Contoh: 2.417" oninput="calcJumlah1_8()" required>
          </div>
          <div class="form-group">
            <label class="form-label">Pegawai Perempuan (Orang) <span class="req">*</span></label>
            <input type="text" id="form1_8_perempuan" name="perempuan" class="form-control-ui" placeholder="Contoh: 2.372" oninput="calcJumlah1_8()" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Jumlah Total Pegawai (Orang)</label>
          <div style="display:flex;gap:8px;">
            <input type="text" id="form1_8_jumlah" name="jumlah" class="form-control-ui" placeholder="Contoh: 4.789 (Dihitung otomatis)">
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcJumlah1_8(true)" style="white-space:nowrap;padding:9px 12px;">
              <i class="fa fa-calculator"></i> Hitung Total
            </button>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_8_ket" name="keterangan" class="form-control-ui" placeholder="Catatan kepegawaian...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_8')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_8">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.9 (Jumlah ASN Menurut Tingkat Pendidikan)    -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_9">
  <div class="modal-box" style="max-width: 680px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_9Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data ASN Tingkat Pendidikan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_9')">&times;</button>
    </div>
    <form id="formTabel1_9" onsubmit="submitForm1_9(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_9_id" name="id" value="0">
        <input type="hidden" id="form1_9_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut</label>
            <input type="number" id="form1_9_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
          <div class="form-group">
            <label class="form-label">Tingkat Pendidikan <span class="req">*</span></label>
            <input type="text" id="form1_9_tingkat" name="tingkat_pendidikan" class="form-control-ui" placeholder="Contoh: S1/Sarjana..." required>
          </div>
        </div>

        <div style="background:#f8fafc;padding:12px;border-radius:8px;border:1px solid #e2e8f0;margin-bottom:12px;">
          <div style="font-weight:700;font-size:12.5px;color:#1e293b;margin-bottom:8px;"><i class="fa fa-user"></i> PNS</div>
          <div class="form-row-2">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Laki-Laki</label>
              <input type="text" id="form1_9_pnsl" name="pns_l" class="form-control-ui" placeholder="0" oninput="calcJumlah1_9()">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Perempuan</label>
              <input type="text" id="form1_9_pnsp" name="pns_p" class="form-control-ui" placeholder="0" oninput="calcJumlah1_9()">
            </div>
          </div>
        </div>

        <div style="background:#f0fdf4;padding:12px;border-radius:8px;border:1px solid #bbf7d0;margin-bottom:12px;">
          <div style="font-weight:700;font-size:12.5px;color:#166534;margin-bottom:8px;"><i class="fa fa-clock-o"></i> PPPK Penuh Waktu</div>
          <div class="form-row-2">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Laki-Laki</label>
              <input type="text" id="form1_9_penuhl" name="pppk_penuh_l" class="form-control-ui" placeholder="0" oninput="calcJumlah1_9()">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Perempuan</label>
              <input type="text" id="form1_9_penuhp" name="pppk_penuh_p" class="form-control-ui" placeholder="0" oninput="calcJumlah1_9()">
            </div>
          </div>
        </div>

        <div style="background:#fefce8;padding:12px;border-radius:8px;border:1px solid #fef08a;margin-bottom:12px;">
          <div style="font-weight:700;font-size:12.5px;color:#854d0e;margin-bottom:8px;"><i class="fa fa-calendar"></i> PPPK Paruh Waktu</div>
          <div class="form-row-2">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Laki-Laki</label>
              <input type="text" id="form1_9_paruhl" name="pppk_paruh_l" class="form-control-ui" placeholder="0" oninput="calcJumlah1_9()">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Perempuan</label>
              <input type="text" id="form1_9_paruhp" name="pppk_paruh_p" class="form-control-ui" placeholder="0" oninput="calcJumlah1_9()">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Total Keseluruhan (Orang)</label>
          <div style="display:flex;gap:8px;">
            <input type="text" id="form1_9_jumlah" name="jumlah" class="form-control-ui" placeholder="Otomatis terakumulasi">
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcJumlah1_9(true)" style="white-space:nowrap;padding:9px 12px;">
              <i class="fa fa-calculator"></i> Hitung Total
            </button>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_9_ket" name="keterangan" class="form-control-ui" placeholder="Catatan kualifikasi pendidikan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_9')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_9">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.10 (Target, Realisasi Pendapatan Daerah)     -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_10">
  <div class="modal-box" style="max-width: 740px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_10Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Pendapatan Daerah
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_10')">&times;</button>
    </div>
    <form id="formTabel1_10" onsubmit="submitForm1_10(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto; padding-right: 15px;">
        <input type="hidden" id="form1_10_id" name="id" value="0">
        <input type="hidden" id="form1_10_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Tipe Baris / Tingkatan <span class="req">*</span></label>
            <select id="form1_10_header" name="is_header" class="form-control-ui" onchange="toggleHeader1_10(this.value)">
              <option value="0">Rincian Sub-Akun (Contoh: Pajak daerah)</option>
              <option value="1">Kelompok Utama / Header (Contoh: 1. Pendapatan Asli Daerah)</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Nomor Urut / Kode (Opsional)</label>
            <input type="text" id="form1_10_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 1, 2, 3 atau kosong">
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Kelompok Induk</label>
            <select id="form1_10_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Berdiri Sendiri / Induk Utama --</option>
              <option value="1">1. Pendapatan Asli Daerah (PAD)</option>
              <option value="2">2. Pendapatan Transfer</option>
              <option value="3">3. LAIN-LAIN PENDAPATAN YANG SAH</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Urutan Tampil dalam Tabel</label>
            <input type="number" id="form1_10_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis urutan berikutnya jika kosong">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Uraian Akun Pendapatan Daerah <span class="req">*</span></label>
          <input type="text" id="form1_10_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Pajak daerah / Pendapatan Transfer..." required>
        </div>

        <!-- Section Anggaran 2025 -->
        <div style="background:#f0fdf4;padding:14px;border-radius:8px;border:1px solid #bbf7d0;margin-bottom:14px;">
          <div style="font-weight:700;font-size:13px;color:#166534;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;">
            <span><i class="fa fa-calculator"></i> Tahun Anggaran 2025 (Target, Realisasi & Capaian)</span>
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_10(true)" style="padding:3px 10px;font-size:11.5px;background:#fff;">
              <i class="fa fa-refresh"></i> Hitung Ulang
            </button>
          </div>
          <div class="form-row-2">
            <div class="form-group">
              <label class="form-label">Anggaran 2025 (Rp.) <span class="req">*</span></label>
              <input type="text" id="form1_10_anggaran" name="anggaran_2025" class="form-control-ui" placeholder="Contoh: 95.608.439.254,00" oninput="calcTabel1_10()" required>
            </div>
            <div class="form-group">
              <label class="form-label">Realisasi 2025 (Rp.) <span class="req">*</span></label>
              <input type="text" id="form1_10_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 101.579.606.287,40" oninput="calcTabel1_10()" required>
            </div>
          </div>
          <div class="form-row-2">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Lebih / (Kurang) (Rp.)</label>
              <input type="text" id="form1_10_selisih" name="selisih" class="form-control-ui" placeholder="Otomatis (Realisasi - Anggaran)">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Capaian Realisasi (%)</label>
              <input type="text" id="form1_10_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Angg * 100)">
            </div>
          </div>
        </div>

        <!-- Section Realisasi Historis 2024, 2023, 2022 -->
        <div style="background:#f8fafc;padding:14px;border-radius:8px;border:1px solid #e2e8f0;margin-bottom:14px;">
          <div style="font-weight:700;font-size:13px;color:#1e293b;margin-bottom:10px;">
            <i class="fa fa-history"></i> Realisasi Historis 3 Tahun Sebelumnya
          </div>
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));gap:10px;">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Realisasi 2024 (Rp.)</label>
              <input type="text" id="form1_10_r24" name="realisasi_2024" class="form-control-ui" placeholder="0,00">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Realisasi 2023 (Rp.)</label>
              <input type="text" id="form1_10_r23" name="realisasi_2023" class="form-control-ui" placeholder="0,00">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Realisasi 2022 (Rp.)</label>
              <input type="text" id="form1_10_r22" name="realisasi_2022" class="form-control-ui" placeholder="0,00">
            </div>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_10_ket" name="keterangan" class="form-control-ui" placeholder="Catatan atau regulasi terkait...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_10')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_10">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.11 (Rincian Pajak Daerah - BAPENDA)          -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_11">
  <div class="modal-box" style="max-width: 720px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_11Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Pajak Daerah
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_11')">&times;</button>
    </div>
    <form id="formTabel1_11" onsubmit="submitForm1_11(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto; padding-right: 15px;">
        <input type="hidden" id="form1_11_id" name="id" value="0">
        <input type="hidden" id="form1_11_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Tingkatan / Tipe Rekening <span class="req">*</span></label>
            <select id="form1_11_tipe" class="form-control-ui" onchange="handleTipe1_11Change(this.value)">
              <option value="lvl2_item">Jenis Pajak Daerah (Contoh: Pajak Reklame, PBBP2, Opsen)</option>
              <option value="lvl1_header">Header Utama Pajak Daerah (4.1.01 Pajak Daerah)</option>
              <option value="lvl2_header">Sub-Header Kelompok (4.1.01.19 PBJT)</option>
              <option value="lvl3_item">Rincian Sub-Akun PBJT (Contoh: PBJT-Makanan/Minuman)</option>
            </select>
            <input type="hidden" id="form1_11_header" name="is_header" value="0">
            <input type="hidden" id="form1_11_level" name="level" value="2">
          </div>
          <div class="form-group">
            <label class="form-label">Nomor / Kode Rekening <span class="req">*</span></label>
            <input type="text" id="form1_11_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 4.1.01.09" required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Kelompok Induk</label>
            <select id="form1_11_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Induk Utama (Level 1) --</option>
              <option value="1">4.1.01 Pajak Daerah</option>
              <option value="7">4.1.01.19 Pajak Barang dan Jasa Tertentu (PBJT)</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Urutan Tampil dalam Tabel</label>
            <input type="number" id="form1_11_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis urutan berikutnya jika kosong">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Uraian Pajak Daerah <span class="req">*</span></label>
          <input type="text" id="form1_11_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Pajak Reklame / Pajak Air Tanah / PBJT..." required>
        </div>

        <!-- Section Anggaran & Realisasi 2025 -->
        <div style="background:#f0fdf4;padding:14px;border-radius:8px;border:1px solid #bbf7d0;margin-bottom:14px;">
          <div style="font-weight:700;font-size:13px;color:#166534;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;">
            <span><i class="fa fa-calculator"></i> Tahun Anggaran 2025 (Target & Realisasi)</span>
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_11(true)" style="padding:3px 10px;font-size:11.5px;background:#fff;">
              <i class="fa fa-refresh"></i> Hitung Capaian
            </button>
          </div>
          <div class="form-row-2">
            <div class="form-group">
              <label class="form-label">Target 2025 (Rp.) <span class="req">*</span></label>
              <input type="text" id="form1_11_target" name="target_2025" class="form-control-ui" placeholder="Contoh: 1.918.982.503,00" oninput="calcTabel1_11()" required>
            </div>
            <div class="form-group">
              <label class="form-label">Realisasi 2025 (Rp.) <span class="req">*</span></label>
              <input type="text" id="form1_11_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 2.204.341.619,00" oninput="calcTabel1_11()" required>
            </div>
          </div>
          <div class="form-row-2">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Capaian Realisasi (%)</label>
              <input type="text" id="form1_11_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Target * 100)">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label">Persentase Naik/Turun Realisasi 2024-2025 (%)</label>
              <input type="text" id="form1_11_pertumbuhan" name="pertumbuhan" class="form-control-ui" placeholder="Contoh: 14,87 atau (11,10) atau -">
              <small style="color:#64748b;font-size:11px;">Gunakan tanda kurung <code>(11,10)</code> atau minus <code>-11,10</code> untuk penurunan.</small>
            </div>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_11_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_11')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_11">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.12 (Rincian Retribusi Daerah - Bapenda)      -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_12">
  <div class="modal-box" style="max-width: 720px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_12Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Retribusi Daerah
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_12')">&times;</button>
    </div>
    <form id="formTabel1_12" onsubmit="submitForm1_12(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto; padding-right: 15px;">
        <input type="hidden" id="form1_12_id" name="id" value="0">
        <input type="hidden" id="form1_12_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Tingkatan / Tipe Rekening <span class="req">*</span></label>
            <select id="form1_12_tipe" class="form-control-ui" onchange="handleTipe1_12Change(this.value)">
              <option value="lvl3_item">Objek Retribusi (Contoh: Pelayanan Kesehatan, Pasar, Parkir)</option>
              <option value="lvl1_header">Header Utama Retribusi (4.1.02 Retribusi Daerah)</option>
              <option value="lvl2_header">Kelompok Retribusi (4.1.02.01 / 4.1.02.02 / 4.1.02.03)</option>
            </select>
            <input type="hidden" id="form1_12_header" name="is_header" value="0">
            <input type="hidden" id="form1_12_level" name="level" value="3">
          </div>
          <div class="form-group">
            <label class="form-label">Nomor / Kode Rekening <span class="req">*</span></label>
            <input type="text" id="form1_12_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 4.1.02.01.01" required>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Kelompok Induk</label>
            <select id="form1_12_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Induk Utama (Level 1) --</option>
              <option value="1">4.1.02 Retribusi Daerah</option>
              <option value="2">4.1.02.01 Retribusi Jasa Umum</option>
              <option value="7">4.1.02.02 Retribusi Jasa Usaha</option>
              <option value="18">4.1.02.03 Retribusi Perizinan Tertentu</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Urutan Tampil dalam Tabel</label>
            <input type="number" id="form1_12_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis urutan berikutnya jika kosong">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Uraian Retribusi Daerah <span class="req">*</span></label>
          <input type="text" id="form1_12_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Retribusi Pelayanan Kesehatan / Retribusi Jasa Umum..." required>
        </div>

        <!-- Section Anggaran & Realisasi 2025 -->
        <div style="background:#f0fdf4;padding:14px;border-radius:8px;border:1px solid #bbf7d0;margin-bottom:14px;">
          <div style="font-weight:700;font-size:13px;color:#166534;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;">
            <span><i class="fa fa-calculator"></i> Tahun Anggaran 2025 (Target & Realisasi)</span>
            <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_12(true)" style="padding:3px 10px;font-size:11.5px;background:#fff;">
              <i class="fa fa-refresh"></i> Hitung Capaian
            </button>
          </div>
          <div class="form-row-2">
            <div class="form-group">
              <label class="form-label">Target 2025 (Rp.) <span class="req">*</span></label>
              <input type="text" id="form1_12_target" name="target_2025" class="form-control-ui" placeholder="Contoh: 132.407.126.517,00" oninput="calcTabel1_12()" required>
            </div>
            <div class="form-group">
              <label class="form-label">Realisasi 2025 (Rp.) <span class="req">*</span></label>
              <input type="text" id="form1_12_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 139.685.603.235,00" oninput="calcTabel1_12()" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Capaian Realisasi (%)</label>
            <input type="text" id="form1_12_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Target * 100)">
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_12_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_12')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_12">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.13 (Hasil Pengelolaan Keuangan Dipisahkan)   -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_13">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_13Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Hasil Pengelolaan
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_13')">&times;</button>
    </div>
    <form id="formTabel1_13" onsubmit="submitForm1_13(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_13_id" name="id" value="0">
        <input type="hidden" id="form1_13_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Tipe Baris Rekening <span class="required">*</span></label>
            <select id="form1_13_tipe" class="form-control-ui" onchange="handleTipe1_13Change(this.value)">
              <option value="lvl3_item">Rincian Objek (Level 3 - Regular)</option>
              <option value="lvl2_header">Kelompok Akun (Level 2 - Sub Header)</option>
              <option value="lvl1_header">Header Utama (Level 1 - Total/Induk)</option>
            </select>
            <input type="hidden" id="form1_13_header" name="is_header" value="0">
            <input type="hidden" id="form1_13_level" name="level" value="3">
          </div>
          <div>
            <label class="form-label">Nomor / Kode Akun <span class="required">*</span></label>
            <input type="text" id="form1_13_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 4.1.03.02.01" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Induk Rekening (Parent)</label>
            <select id="form1_13_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Tidak Ada (Header Utama Level 1) --</option>
              <?php foreach ($itemsTabel1_13 as $pi): ?>
                <?php if ((int)$pi['is_header'] === 1 || (int)$pi['level'] <= 2): ?>
                  <option value="<?= $pi['id'] ?>">
                    <?= htmlspecialchars($pi['nomor']) ?> - <?= htmlspecialchars($pi['uraian']) ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_13_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
        </div>

        <div>
          <label class="form-label">Uraian Rekening Hasil Pengelolaan <span class="required">*</span></label>
          <input type="text" id="form1_13_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Bagian Laba yang Dibagikan kepada Pemerintah Daerah (Dividen)..." required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <label class="form-label" style="margin-bottom:0;">Target 2025 (Rp.) <span class="required">*</span></label>
              <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_13(true)" style="padding:3px 10px;font-size:11.5px;background:#fff;">
                <i class="fa fa-refresh"></i> Hitung %
              </button>
            </div>
            <input type="text" id="form1_13_target" name="target_2025" class="form-control-ui" placeholder="Contoh: 4.154.014.113,00" oninput="calcTabel1_13()" required>
          </div>
          <div>
            <label class="form-label">Realisasi 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_13_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 4.178.453.983,03" oninput="calcTabel1_13()" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Capaian Realisasi (%)</label>
            <input type="text" id="form1_13_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Target * 100)">
          </div>
          <div>
            <label class="form-label">Persentase Naik/Turun 2024-2025 (%)</label>
            <input type="text" id="form1_13_pertumbuhan" name="pertumbuhan" class="form-control-ui" placeholder="Contoh: 2,43 atau (2,51) atau -">
            <span style="font-size:11px;color:var(--ui-text-muted);">Gunakan kurung `(2,51)` atau `-2.51` untuk angka negatif.</span>
          </div>
        </div>

        <div>
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_13_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_13')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_13">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.14 (Rincian Hasil Lain-Lain PAD yang Sah)    -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_14">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_14Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Lain-Lain PAD
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_14')">&times;</button>
    </div>
    <form id="formTabel1_14" onsubmit="submitForm1_14(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_14_id" name="id" value="0">
        <input type="hidden" id="form1_14_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Tipe Baris Rekening <span class="required">*</span></label>
            <select id="form1_14_tipe" class="form-control-ui" onchange="handleTipe1_14Change(this.value)">
              <option value="lvl2_item">Rincian Objek PAD (Level 2 - Regular)</option>
              <option value="lvl1_header">Header Utama (Level 1 - Total/Induk)</option>
            </select>
            <input type="hidden" id="form1_14_header" name="is_header" value="0">
            <input type="hidden" id="form1_14_level" name="level" value="2">
          </div>
          <div>
            <label class="form-label">Nomor / Kode Akun <span class="required">*</span></label>
            <input type="text" id="form1_14_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 4.1.04.01" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Induk Rekening (Parent)</label>
            <select id="form1_14_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Tidak Ada (Header Utama Level 1) --</option>
              <?php foreach ($itemsTabel1_14 as $pi): ?>
                <?php if ((int)$pi['is_header'] === 1): ?>
                  <option value="<?= $pi['id'] ?>">
                    <?= htmlspecialchars($pi['nomor']) ?> - <?= htmlspecialchars($pi['uraian']) ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_14_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
        </div>

        <div>
          <label class="form-label">Uraian Rekening Lain-lain PAD <span class="required">*</span></label>
          <input type="text" id="form1_14_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Jasa Giro / Pendapatan BLUD / Hasil Pemanfaatan BMD..." required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <label class="form-label" style="margin-bottom:0;">Target 2025 (Rp.) <span class="required">*</span></label>
              <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_14(true)" style="padding:3px 10px;font-size:11.5px;background:#fff;">
                <i class="fa fa-refresh"></i> Hitung %
              </button>
            </div>
            <input type="text" id="form1_14_target" name="target_2025" class="form-control-ui" placeholder="Contoh: 792.785.355,00" oninput="calcTabel1_14()" required>
          </div>
          <div>
            <label class="form-label">Realisasi 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_14_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 1.359.082.727,48" oninput="calcTabel1_14()" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Capaian Realisasi (%)</label>
            <input type="text" id="form1_14_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Target * 100)">
          </div>
          <div>
            <label class="form-label">Persentase Naik/Turun 2024-2025 (%)</label>
            <input type="text" id="form1_14_pertumbuhan" name="pertumbuhan" class="form-control-ui" placeholder="Contoh: 48,79 atau (72,85) atau -">
            <span style="font-size:11px;color:var(--ui-text-muted);">Gunakan kurung `(72,85)` atau `-72.85` untuk angka negatif.</span>
          </div>
        </div>

        <div>
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_14_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_14')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_14">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.15 (Rincian Pendapatan Transfer Tahun 2025)  -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_15">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_15Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Pendapatan Transfer
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_15')">&times;</button>
    </div>
    <form id="formTabel1_15" onsubmit="submitForm1_15(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_15_id" name="id" value="0">
        <input type="hidden" id="form1_15_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Tipe Baris Rekening <span class="required">*</span></label>
            <select id="form1_15_tipe" class="form-control-ui" onchange="handleTipe1_15Change(this.value)">
              <option value="lvl3_item">Rincian Objek Transfer (Level 3 - Regular)</option>
              <option value="lvl2_header">Sub-Kelompok (Level 2 - Pusat / Daerah)</option>
              <option value="lvl1_header">Header Utama (Level 1 - PENDAPATAN TRANSFER)</option>
            </select>
            <input type="hidden" id="form1_15_header" name="is_header" value="0">
            <input type="hidden" id="form1_15_level" name="level" value="3">
          </div>
          <div>
            <label class="form-label">Nomor / Kode Rekening <span class="required">*</span></label>
            <input type="text" id="form1_15_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 4.2.01.05" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Induk Rekening (Parent)</label>
            <select id="form1_15_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Tidak Ada (Header Utama Level 1) --</option>
              <?php foreach ($itemsTabel1_15 as $pi): ?>
                <?php if ((int)$pi['level'] <= 2): ?>
                  <option value="<?= $pi['id'] ?>">
                    <?= htmlspecialchars($pi['nomor']) ?> - <?= htmlspecialchars($pi['uraian']) ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_15_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
        </div>

        <div>
          <label class="form-label">Uraian Rekening Transfer <span class="required">*</span></label>
          <input type="text" id="form1_15_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Dana Desa / DBH / DAU / DAK / Bantuan Keuangan..." required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <label class="form-label" style="margin-bottom:0;">Target 2025 (Rp.) <span class="required">*</span></label>
              <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_15(true)" style="padding:3px 10px;font-size:11.5px;background:#fff;">
                <i class="fa fa-refresh"></i> Hitung %
              </button>
            </div>
            <input type="text" id="form1_15_target" name="target_2025" class="form-control-ui" placeholder="Contoh: 144.895.257.000,00" oninput="calcTabel1_15()" required>
          </div>
          <div>
            <label class="form-label">Realisasi 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_15_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 130.743.954.938,00" oninput="calcTabel1_15()" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Capaian Realisasi (%)</label>
            <input type="text" id="form1_15_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Target * 100)">
          </div>
          <div>
            <label class="form-label">Persentase Naik/Turun 2024-2025 (%)</label>
            <input type="text" id="form1_15_pertumbuhan" name="pertumbuhan" class="form-control-ui" placeholder="Contoh: 29,05 atau (15,20) atau -">
            <span style="font-size:11px;color:var(--ui-text-muted);">Gunakan kurung `(15,20)` atau `-15.20` untuk angka negatif.</span>
          </div>
        </div>

        <div>
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_15_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_15')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_15">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.16 (Rincian Belanja dan Transfer Daerah)      -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_16">
  <div class="modal-box" style="max-width: 640px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_16Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Belanja & Transfer
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_16')">&times;</button>
    </div>
    <form id="formTabel1_16" onsubmit="submitForm1_16(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
        <input type="hidden" id="form1_16_id" name="id" value="0">
        <input type="hidden" id="form1_16_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Tipe Baris Rekening <span class="required">*</span></label>
            <select id="form1_16_tipe" class="form-control-ui" onchange="handleTipe1_16Change(this.value)">
              <option value="lvl2_item">Rincian Objek Belanja (Level 2 - Regular)</option>
              <option value="lvl1_header">Header Kelompok (Level 1 - Induk / Total)</option>
            </select>
            <input type="hidden" id="form1_16_header" name="is_header" value="0">
            <input type="hidden" id="form1_16_level" name="level" value="2">
          </div>
          <div>
            <label class="form-label">Nomor Baris (Opsional)</label>
            <input type="text" id="form1_16_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 1, 2, 3, 4 (atau kosong)">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Kelompok Induk (Parent)</label>
            <select id="form1_16_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Tidak Ada (Header Utama Level 1) --</option>
              <?php foreach ($itemsTabel1_16 as $pi): ?>
                <?php if ((int)$pi['is_header'] === 1 || (int)$pi['level'] === 1): ?>
                  <option value="<?= $pi['id'] ?>">
                    <?= htmlspecialchars($pi['nomor']) ?> <?= htmlspecialchars($pi['uraian']) ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_16_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
          </div>
        </div>

        <div>
          <label class="form-label">Uraian Rekening Belanja / Transfer <span class="required">*</span></label>
          <input type="text" id="form1_16_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Belanja Pegawai / Belanja Modal Peralatan..." required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Anggaran 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_16_anggaran" name="anggaran_2025" class="form-control-ui" placeholder="Contoh: 718.115.470.587,00" oninput="calcTabel1_16()" required>
          </div>
          <div>
            <label class="form-label">Realisasi 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_16_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="Contoh: 689.653.487.516,20" oninput="calcTabel1_16()" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Lebih / (Kurang) (Rp.)</label>
            <input type="text" id="form1_16_selisih" name="selisih" class="form-control-ui" placeholder="Otomatis (Realisasi - Anggaran)" readonly style="background:#f8fafc;">
          </div>
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <label class="form-label" style="margin-bottom:0;">Capaian Realisasi (%)</label>
              <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_16(true)" style="padding:2px 8px;font-size:11px;background:#fff;">
                <i class="fa fa-refresh"></i> Hitung
              </button>
            </div>
            <input type="text" id="form1_16_persen" name="persen" class="form-control-ui" placeholder="Otomatis (Real / Anggaran * 100)">
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 4px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            <i class="fa fa-history"></i> Realisasi Tahun-Tahun Sebelumnya
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi 2024 (Rp.)</label>
              <input type="text" id="form1_16_real24" name="realisasi_2024" class="form-control-ui" placeholder="Contoh: 687.132.798.462,00">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi 2023 (Rp.)</label>
              <input type="text" id="form1_16_real23" name="realisasi_2023" class="form-control-ui" placeholder="Contoh: 651.626.798.729,00">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi 2022 (Rp.)</label>
              <input type="text" id="form1_16_real22" name="realisasi_2022" class="form-control-ui" placeholder="Contoh: 662.110.412.534,00">
            </div>
          </div>
        </div>

        <div style="margin-top: 10px;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_16_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_16')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_16">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.17 (Rincian Belanja Hibah)                   -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_17">
  <div class="modal-box" style="max-width: 680px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_17Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Belanja Hibah
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_17')">&times;</button>
    </div>
    <form id="formTabel1_17" onsubmit="submitForm1_17(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
        <input type="hidden" id="form1_17_id" name="id" value="0">
        <input type="hidden" id="form1_17_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Nama SKPD / Perangkat Daerah <span class="required">*</span></label>
            <input type="text" id="form1_17_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Dinas Pendidikan dan Kebudayaan..." required>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_17_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis">
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            1. Belanja Hibah kepada Pemerintah Pusat (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_17_pusat_ang" name="hibah_pusat_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_17_pusat_rea" name="hibah_pusat_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            2. Belanja Hibah kepada Badan, Lembaga, Ormas Berbadan Hukum (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_17_badan_ang" name="hibah_badan_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_17_badan_rea" name="hibah_badan_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            3. Belanja Hibah Bantuan Keuangan kepada Partai Politik (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_17_parpol_ang" name="hibah_parpol_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_17_parpol_rea" name="hibah_parpol_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            4. Belanja Hibah Dana BOSP (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_17_bosp_ang" name="hibah_bosp_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_17_bosp_rea" name="hibah_bosp_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_17()">
            </div>
          </div>
        </div>

        <div style="background: #fff7ed; border: 1px solid #fed7aa; border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 800; color: #9a3412; display: block; margin-bottom: 8px;">
            Total Belanja Hibah (Otomatis)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Total Anggaran</label>
              <input type="text" id="form1_17_tot_ang" class="form-control-ui" readonly style="background:#fff;">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Total Realisasi</label>
              <input type="text" id="form1_17_tot_rea" class="form-control-ui" readonly style="background:#fff;">
            </div>
          </div>
        </div>

        <div style="margin-top: 10px;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_17_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_17')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_17">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.18 (Rincian Belanja Bantuan Sosial)           -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_18">
  <div class="modal-box" style="max-width: 640px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_18Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Belanja Bansos
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_18')">&times;</button>
    </div>
    <form id="formTabel1_18" onsubmit="submitForm1_18(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
        <input type="hidden" id="form1_18_id" name="id" value="0">
        <input type="hidden" id="form1_18_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Nama SKPD / Perangkat Daerah <span class="required">*</span></label>
            <input type="text" id="form1_18_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Dinas Pekerjaan Umum Dan Perumahan Permukiman..." required>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_18_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis">
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            1. Belanja Bansos kepada Individu (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_18_indiv_ang" name="bansos_individu_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_18()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_18_indiv_rea" name="bansos_individu_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_18()">
            </div>
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            2. Belanja Bansos kepada Kelompok Masyarakat (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_18_pokmas_ang" name="bansos_pokmas_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_18()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_18_pokmas_rea" name="bansos_pokmas_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_18()">
            </div>
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            3. Belanja Bansos kepada Lembaga Non Pemerintahan (Rp.)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Anggaran</label>
              <input type="text" id="form1_18_lembaga_ang" name="bansos_lembaga_anggaran" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_18()">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi</label>
              <input type="text" id="form1_18_lembaga_rea" name="bansos_lembaga_realisasi" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_18()">
            </div>
          </div>
        </div>

        <div style="background: #fff7ed; border: 1px solid #fed7aa; border-radius: 8px; padding: 12px; margin-top: 6px;">
          <span style="font-size: 12px; font-weight: 800; color: #9a3412; display: block; margin-bottom: 8px;">
            Total Belanja Bantuan Sosial (Otomatis)
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Total Anggaran</label>
              <input type="text" id="form1_18_tot_ang" class="form-control-ui" readonly style="background:#fff;">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Total Realisasi</label>
              <input type="text" id="form1_18_tot_rea" class="form-control-ui" readonly style="background:#fff;">
            </div>
          </div>
        </div>

        <div style="margin-top: 10px;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_18_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_18')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_18">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.19 (Pembiayaan Daerah)                        -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_19">
  <div class="modal-box" style="max-width: 640px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_19Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rekening Pembiayaan Daerah
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_19')">&times;</button>
    </div>
    <form id="formTabel1_19" onsubmit="submitForm1_19(event)">
      <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
        <input type="hidden" id="form1_19_id" name="id" value="0">
        <input type="hidden" id="form1_19_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Tipe Baris <span class="required">*</span></label>
            <select id="form1_19_tipe" class="form-control-ui" onchange="handleTipe1_19Change(this.value)">
              <option value="lvl2_item">Rincian Objek Pembiayaan (Level 2)</option>
              <option value="lvl1_header">Kelompok Utama (Level 1 - Header / Netto)</option>
            </select>
            <input type="hidden" id="form1_19_header" name="is_header" value="0">
            <input type="hidden" id="form1_19_level" name="level" value="2">
          </div>
          <div>
            <label class="form-label">Nomor Baris (Opsional)</label>
            <input type="text" id="form1_19_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 1, 2, 3">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Kelompok Induk (Parent)</label>
            <select id="form1_19_parent" name="parent_id" class="form-control-ui">
              <option value="0">-- Tidak Ada (Header Utama Level 1) --</option>
              <?php foreach ($itemsTabel1_19 as $pi): ?>
                <?php if ((int)$pi['is_header'] === 1 || (int)$pi['level'] === 1): ?>
                  <option value="<?= $pi['id'] ?>">
                    <?= htmlspecialchars($pi['nomor']) ?> <?= htmlspecialchars($pi['uraian']) ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="form-label">Urutan Tampil</label>
            <input type="number" id="form1_19_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis">
          </div>
        </div>

        <div>
          <label class="form-label">Uraian Rekening Pembiayaan <span class="required">*</span></label>
          <input type="text" id="form1_19_uraian" name="uraian" class="form-control-ui" placeholder="Contoh: Sisa Lebih Perhitungan Anggaran Tahun Sebelumnya..." required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Anggaran 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_19_anggaran" name="anggaran_2025" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_19()" required>
          </div>
          <div>
            <label class="form-label">Realisasi 2025 (Rp.) <span class="required">*</span></label>
            <input type="text" id="form1_19_realisasi" name="realisasi_2025" class="form-control-ui" placeholder="0,00" oninput="calcTabel1_19()" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <div>
            <label class="form-label">Lebih / (Kurang) (Rp.)</label>
            <input type="text" id="form1_19_selisih" name="selisih" class="form-control-ui" placeholder="Otomatis" readonly style="background:#f8fafc;">
          </div>
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <label class="form-label" style="margin-bottom:0;">Capaian Realisasi (%)</label>
              <button type="button" class="btn-ui btn-ui-outline" onclick="calcTabel1_19(true)" style="padding:2px 8px;font-size:11px;background:#fff;">
                <i class="fa fa-refresh"></i> Hitung
              </button>
            </div>
            <input type="text" id="form1_19_persen" name="persen" class="form-control-ui" placeholder="Contoh: 100,00 atau -">
          </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--ui-border-light); border-radius: 8px; padding: 12px; margin-top: 4px;">
          <span style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">
            <i class="fa fa-history"></i> Realisasi Tahun-Tahun Sebelumnya
          </span>
          <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi 2024</label>
              <input type="text" id="form1_19_real24" name="realisasi_2024" class="form-control-ui" placeholder="0,00">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi 2023</label>
              <input type="text" id="form1_19_real23" name="realisasi_2023" class="form-control-ui" placeholder="0,00">
            </div>
            <div>
              <label class="form-label" style="font-size:11.5px;">Realisasi 2022</label>
              <input type="text" id="form1_19_real22" name="realisasi_2022" class="form-control-ui" placeholder="0,00">
            </div>
          </div>
        </div>

        <div style="margin-top: 10px;">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_19_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_19')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_19">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL 1.20 (Komponen SILPA)                          -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalTabel1_20">
  <div class="modal-box" style="max-width: 500px;">
    <div class="modal-header">
      <h3 class="modal-title" id="modal1_20Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Komponen SILPA
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalTabel1_20')">&times;</button>
    </div>
    <form id="formTabel1_20" onsubmit="submitForm1_20(event)">
      <div class="modal-body">
        <input type="hidden" id="form1_20_id" name="id" value="0">
        <input type="hidden" id="form1_20_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-group">
          <label class="form-label">Nama Komponen SILPA <span class="required">*</span></label>
          <input type="text" id="form1_20_komponen" name="komponen" class="form-control-ui" placeholder="Contoh: Kas di Kas Daerah / Kas di BLUD..." required>
        </div>

        <div class="form-group">
          <label class="form-label">Jumlah (Rp.) <span class="required">*</span></label>
          <input type="text" id="form1_20_jumlah" name="jumlah" class="form-control-ui" placeholder="Contoh: 142.802.611.211,01" required>
        </div>

        <div class="form-group">
          <label class="form-label">Urutan Tampil</label>
          <input type="number" id="form1_20_urutan" name="urutan" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
        </div>

        <div class="form-group">
          <label class="form-label">Keterangan Tambahan (Opsional)</label>
          <input type="text" id="form1_20_ket" name="keterangan" class="form-control-ui" placeholder="Catatan tambahan...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalTabel1_20')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSave1_20">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL CRUD TABEL GENERIC (1.17 s/d 1.20)                        -->
<!-- =============================================================== -->
<div class="modal-overlay" id="modalGeneric">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modalGenTitle">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Baris Data
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalGeneric')">&times;</button>
    </div>
    <form id="formGeneric" onsubmit="submitFormGeneric(event)">
      <div class="modal-body">
        <input type="hidden" id="formGen_id" name="id" value="0">
        <input type="hidden" id="formGen_tabel_kode" name="tabel_kode" value="<?= $activeTabel ?>">
        <input type="hidden" id="formGen_tahun" name="tahun" value="<?= $tahunAktif ?>">

        <div class="form-group">
          <label class="form-label">Nomor Urut</label>
          <input type="number" id="formGen_nomor" name="nomor" class="form-control-ui" min="1" placeholder="Otomatis jika kosong">
        </div>

        <?php 
          $genKoloms = $metaTabel['kolom'] ?? ['No', 'Uraian'];
          // Skip first column 'No'
          for ($i = 1; $i < count($genKoloms); $i++):
            $colLabel = $genKoloms[$i];
            $fieldName = 'kolom_' . $i;
        ?>
        <div class="form-group">
          <label class="form-label"><?= htmlspecialchars($colLabel) ?> <?= ($i === 1) ? '<span class="req">*</span>' : '' ?></label>
          <input type="text" id="formGen_<?= $fieldName ?>" name="<?= $fieldName ?>" class="form-control-ui" placeholder="Masukkan <?= htmlspecialchars($colLabel) ?>..." <?= ($i === 1) ? 'required' : '' ?>>
        </div>
        <?php endfor; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalGeneric')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSaveGen">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';
const CURRENT_TABEL = '<?= $activeTabel ?>';
const CURRENT_TAHUN = '<?= $tahunAktif ?>';
const IS_LOGGED_IN = <?= !empty($IsLoggedIn) ? 'true' : 'false' ?>;
const CAN_CRUD = <?= !empty($CanCrud) ? 'true' : 'false' ?>;

// Script Filter Dropdown Provinsi & Kab/Kota (Saat Belum Login atau Akun Read-Only Kementerian/Nasional)
<?php if (empty($IsLoggedIn) || !empty($IsReadOnly)): ?>
document.addEventListener('DOMContentLoaded', function() {
  const provSelect = document.getElementById('filterProvinsi');
  const kabSelect = document.getElementById('filterKabKota');
  const btnFilter = document.getElementById('btnFilterWilayah');
  const activeKode = '<?= $KodeWilayah ?>';
  const activeProv = activeKode ? activeKode.substring(0, 2) : '';

  function fetchKabKota(provCode, preselected) {
    if (!provCode) {
      kabSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
      kabSelect.disabled = true;
      return;
    }
    kabSelect.disabled = true;
    kabSelect.innerHTML = '<option value="">Memuat data kab/kota...</option>';

    const formData = new FormData();
    formData.append('Kode', provCode);

    fetch(BASE_URL + 'Instansi/GetListKabKota', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      let opts = '<option value="">-- Pilih Kab/Kota --</option>';
      if (data && data.length > 0) {
        data.forEach(item => {
          const sel = (item.Kode === preselected) ? ' selected' : '';
          opts += `<option value="${item.Kode}"${sel}>${item.Nama}</option>`;
        });
      }
      kabSelect.innerHTML = opts;
      kabSelect.disabled = false;
    })
    .catch(() => {
      kabSelect.innerHTML = '<option value="">-- Gagal memuat data --</option>';
      kabSelect.disabled = false;
    });
  }

  if (provSelect) {
    provSelect.addEventListener('change', function() {
      fetchKabKota(this.value, '');
    });

    if (activeProv) {
      fetchKabKota(activeProv, activeKode);
    }
  }

  if (btnFilter) {
    btnFilter.addEventListener('click', function() {
      const pVal = provSelect ? provSelect.value : '';
      const kVal = kabSelect ? kabSelect.value : '';
      if (!pVal) {
        Swal.fire('Perhatian', 'Silakan pilih Provinsi terlebih dahulu.', 'warning');
        return;
      }
      if (!kVal) {
        Swal.fire('Perhatian', 'Silakan pilih Kabupaten / Kota.', 'warning');
        return;
      }

      btnFilter.disabled = true;
      btnFilter.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memuat...';

      const formData = new FormData();
      formData.append('KodeWilayah', kVal);

      fetch(BASE_URL + 'Instansi/SetTempKodeWilayah', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
      })
      .then(r => r.text())
      .then(res => {
        if (res.trim() === '1') {
          window.location.reload();
        } else {
          Swal.fire('Error', res || 'Gagal menyimpan wilayah pilihan.', 'error');
          btnFilter.disabled = false;
          btnFilter.innerHTML = '<i class="fa fa-search"></i> Tampilkan Data';
        }
      })
      .catch(() => {
        Swal.fire('Error', 'Gagal menghubungi server.', 'error');
        btnFilter.disabled = false;
        btnFilter.innerHTML = '<i class="fa fa-search"></i> Tampilkan Data';
      });
    });
  }
});
<?php endif; ?>

// Beralih Tabel (Tabel 1.1 s/d 1.20)
function switchTabel(tabelKode) {
  const tahun = document.getElementById('selectTahun').value;
  window.location.href = `${BASE_URL}Instansi/BAB1?tabel=${tabelKode}&tahun=${tahun}`;
}

// Beralih Tahun
function changeYear(tahun) {
  window.location.href = `${BASE_URL}Instansi/BAB1?tabel=${CURRENT_TABEL}&tahun=${tahun}`;
}

// Filter teks dalam tabel
function filterTable() {
  const input = document.getElementById('searchInput').value.toLowerCase();
  const rows = document.querySelectorAll('#mainDataTable tbody tr');
  rows.forEach(row => {
    const text = row.innerText.toLowerCase();
    row.style.display = text.includes(input) ? '' : 'none';
  });
}

// Modal Handlers - Selalu Berada Tepat di Tengah Layar (Center Viewport)
function openModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    if (modal.parentElement !== document.body) {
      document.body.appendChild(modal);
    }
    document.body.style.overflow = 'hidden';
    modal.classList.add('show');
  }
}
function closeModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.remove('show');
    document.body.style.overflow = '';
  }
}

// Tutup modal saat klik area latar belakang (overlay) atau tombol ESC
document.addEventListener('click', function(e) {
  if (e.target && e.target.classList && e.target.classList.contains('modal-overlay')) {
    closeModal(e.target.id);
  }
});
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeModal('modalTabel1_1');
    closeModal('modalTabel1_2');
    closeModal('modalTabel1_3');
    closeModal('modalTabel1_4');
    closeModal('modalTabel1_5');
    closeModal('modalTabel1_6');
    closeModal('modalTabel1_7');
    closeModal('modalTabel1_8');
    closeModal('modalTabel1_9');
    closeModal('modalTabel1_10');
    closeModal('modalGeneric');
  }
});

// ===================================================================
// CRUD TABEL 1.1
// ===================================================================
function openModalTambah1_1() {
  document.getElementById('formTabel1_1').reset();
  document.getElementById('form1_1_id').value = '0';
  document.getElementById('form1_1_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_1Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Kecamatan';
  document.getElementById('btnSave1_1').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_1');
}

function editRow1_1(id) {
  const tr = document.getElementById('row-' + id);
  if (!tr) return;

  document.getElementById('form1_1_id').value = id;
  document.getElementById('form1_1_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_1_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_1_kecamatan').value = tr.getAttribute('data-kecamatan') || '';
  document.getElementById('form1_1_luas').value = tr.getAttribute('data-luas') || '';
  document.getElementById('form1_1_desa').value = tr.getAttribute('data-desa') || '0';
  document.getElementById('form1_1_kelurahan').value = tr.getAttribute('data-kelurahan') || '0';

  document.getElementById('modal1_1Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Kecamatan';
  document.getElementById('btnSave1_1').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_1');
}

function submitForm1_1(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_1');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_1');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_1`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_1');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_1(id, namaKecamatan) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Kecamatan "${namaKecamatan}" akan dihapus dari tabel 1.1.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_1`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: data.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal menghapus data' });
        }
      })
      .catch(err => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
      });
    }
  });
}

function konfirmasiReset1_1() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.1 akan dikembalikan persis ke 17 kecamatan Kabupaten Situbondo sesuai dokumen resmi.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#cf7e2f',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_1`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Direset!',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.2 (Tutupan Lahan Kabupaten Situbondo)
// ===================================================================
function calcPersen1_2(force = false) {
  const luasRaw = document.getElementById('form1_2_luas').value.trim();
  const persenInput = document.getElementById('form1_2_persen');
  if (!force && persenInput.value.trim() !== '') return;

  let clean = luasRaw.replace(/\s+/g, '');
  if (clean.includes(',')) {
    clean = clean.replace(/\./g, '').replace(',', '.');
  } else if (/^\d{1,3}\.\d{3}$/.test(clean)) {
    clean = clean.replace(/\./g, '');
  }
  const luasVal = parseFloat(clean);
  if (!isNaN(luasVal) && luasVal > 0) {
    const totalLuas = 165505.0;
    const pct = (luasVal / totalLuas) * 100;
    if (pct < 0.01) {
      persenInput.value = pct.toFixed(3).replace('.', ',');
    } else {
      persenInput.value = pct.toFixed(2).replace('.', ',');
    }
  }
}

function openModalTambah1_2() {
  document.getElementById('formTabel1_2').reset();
  document.getElementById('form1_2_id').value = '0';
  document.getElementById('form1_2_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_2Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Tutupan Lahan';
  document.getElementById('btnSave1_2').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_2');
}

function editRow1_2(id) {
  const tr = document.getElementById('row1_2-' + id);
  if (!tr) return;

  document.getElementById('form1_2_id').value = id;
  document.getElementById('form1_2_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_2_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_2_tutupan').value = tr.getAttribute('data-tutupan') || '';
  document.getElementById('form1_2_luas').value = tr.getAttribute('data-luas') || '';
  document.getElementById('form1_2_persen').value = tr.getAttribute('data-persen') || '';
  document.getElementById('form1_2_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_2Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Tutupan Lahan';
  document.getElementById('btnSave1_2').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_2');
}

function submitForm1_2(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_2');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_2');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_2`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_2');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_2(id, namaTutupan) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data tutupan lahan "${namaTutupan}" akan dihapus dari tabel 1.2.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_2`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: data.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal menghapus data' });
        }
      })
      .catch(err => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
      });
    }
  });
}

function konfirmasiReset1_2() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.2 akan dikembalikan ke 19 data tutupan lahan standar Kabupaten Situbondo sesuai dokumen resmi.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_2`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Direset!',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.3 (Ketinggian Wilayah Per Kecamatan)
// ===================================================================
function openModalTambah1_3() {
  document.getElementById('formTabel1_3').reset();
  document.getElementById('form1_3_id').value = '0';
  document.getElementById('form1_3_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_3_satuan').value = 'm dpl';
  document.getElementById('modal1_3Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Ketinggian Kecamatan';
  document.getElementById('btnSave1_3').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_3');
}

function editRow1_3(id) {
  const tr = document.getElementById('row1_3-' + id);
  if (!tr) return;

  document.getElementById('form1_3_id').value = id;
  document.getElementById('form1_3_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_3_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_3_kecamatan').value = tr.getAttribute('data-kecamatan') || '';
  document.getElementById('form1_3_tinggi').value = tr.getAttribute('data-tinggi') || '';
  document.getElementById('form1_3_satuan').value = tr.getAttribute('data-satuan') || 'm dpl';
  document.getElementById('form1_3_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_3Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Ketinggian Kecamatan';
  document.getElementById('btnSave1_3').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_3');
}

function submitForm1_3(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_3');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_3');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_3`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_3');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_3(id, namaKecamatan) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data ketinggian kecamatan "${namaKecamatan}" akan dihapus dari tabel 1.3.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_3`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: data.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal menghapus data' });
        }
      })
      .catch(err => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
      });
    }
  });
}

function konfirmasiReset1_3() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.3 akan dikembalikan ke 17 data ketinggian kecamatan Kabupaten Situbondo sesuai dokumen resmi.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_3`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Direset!',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.4 (Kondisi Iklim Menurut Bulan)
// ===================================================================
function openModalTambah1_4() {
  document.getElementById('formTabel1_4').reset();
  document.getElementById('form1_4_id').value = '0';
  document.getElementById('form1_4_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_4Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Iklim Bulan';
  document.getElementById('btnSave1_4').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_4');
}

function editRow1_4(id) {
  const tr = document.getElementById('row1_4-' + id);
  if (!tr) return;

  document.getElementById('form1_4_id').value = id;
  document.getElementById('form1_4_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_4_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_4_bulan').value = tr.getAttribute('data-bulan') || '';
  document.getElementById('form1_4_curah').value = tr.getAttribute('data-curah') || '';
  document.getElementById('form1_4_hari').value = tr.getAttribute('data-hari') || '';
  document.getElementById('form1_4_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_4Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Iklim Bulan';
  document.getElementById('btnSave1_4').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_4');
}

function submitForm1_4(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_4');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_4');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_4`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_4');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_4(id, namaBulan) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data iklim bulan "${namaBulan}" akan dihapus dari tabel 1.4.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_4`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: data.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal menghapus data' });
        }
      })
      .catch(err => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
      });
    }
  });
}

function konfirmasiReset1_4() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.4 akan dikembalikan ke 12 bulan kondisi iklim Kabupaten Situbondo sesuai data resmi BPS.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_4`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Direset!',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.5 (Jumlah Penduduk Menurut Kecamatan)
// ===================================================================
function calcRasio1_5(force = false) {
  const lkEl = document.getElementById('form1_5_laki');
  const prEl = document.getElementById('form1_5_perempuan');
  const rasioEl = document.getElementById('form1_5_rasio');
  if (!lkEl || !prEl || !rasioEl) return;

  const lkVal = parseFloat(lkEl.value.replace(/\./g, '').replace(/,/g, '.')) || 0;
  const prVal = parseFloat(prEl.value.replace(/\./g, '').replace(/,/g, '.')) || 0;

  if (prVal > 0) {
    const rasio = (lkVal / prVal) * 100;
    rasioEl.value = rasio.toFixed(2).replace('.', ',');
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan jumlah penduduk perempuan lebih dari 0 untuk menghitung rasio.'
    });
  }
}

function openModalTambah1_5() {
  document.getElementById('formTabel1_5').reset();
  document.getElementById('form1_5_id').value = '0';
  document.getElementById('form1_5_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_5Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Penduduk Kecamatan';
  document.getElementById('btnSave1_5').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_5');
}

function editRow1_5(id) {
  const tr = document.getElementById('row1_5-' + id);
  if (!tr) return;

  document.getElementById('form1_5_id').value = id;
  document.getElementById('form1_5_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_5_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_5_kecamatan').value = tr.getAttribute('data-kecamatan') || '';

  const lk = tr.getAttribute('data-laki') || '0';
  document.getElementById('form1_5_laki').value = parseInt(lk).toLocaleString('id-ID');

  const pr = tr.getAttribute('data-perempuan') || '0';
  document.getElementById('form1_5_perempuan').value = parseInt(pr).toLocaleString('id-ID');

  const rasio = parseFloat(tr.getAttribute('data-rasio') || '0');
  document.getElementById('form1_5_rasio').value = rasio.toFixed(2).replace('.', ',');

  document.getElementById('form1_5_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_5Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Penduduk Kecamatan';
  document.getElementById('btnSave1_5').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_5');
}

function submitForm1_5(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_5');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_5');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_5`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_5');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_5(id, namaKecamatan) {
  Swal.fire({
    title: 'Hapus Data Penduduk?',
    text: `Data kependudukan kecamatan "${namaKecamatan}" akan dihapus dari tabel 1.5.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_5`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: data.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Gagal menghapus data' });
        }
      })
      .catch(err => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
      });
    }
  });
}

function konfirmasiReset1_5() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.5 akan dikembalikan ke 17 data kependudukan kecamatan Kabupaten Situbondo sesuai rilis resmi BPS.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_5`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Direset!',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.6 (Pertumbuhan Penduduk)
// ===================================================================
function calcPertumbuhan1_6(force = false) {
  const p24El = document.getElementById('form1_6_p24');
  const p25El = document.getElementById('form1_6_p25');
  const grEl = document.getElementById('form1_6_growth');
  if (!p24El || !p25El || !grEl) return;

  const p24Val = parseFloat(p24El.value.replace(/\./g, '').replace(/,/g, '.')) || 0;
  const p25Val = parseFloat(p25El.value.replace(/\./g, '').replace(/,/g, '.')) || 0;

  if (p24Val > 0) {
    const growth = ((p25Val - p24Val) / p24Val) * 100;
    grEl.value = growth.toFixed(2).replace('.', ',');
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan jumlah penduduk 2024 lebih dari 0 untuk menghitung persentase pertumbuhan.'
    });
  }
}

function openModalTambah1_6() {
  document.getElementById('formTabel1_6').reset();
  document.getElementById('form1_6_id').value = '0';
  document.getElementById('form1_6_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_6Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Pertumbuhan Penduduk';
  document.getElementById('btnSave1_6').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_6');
}

function editRow1_6(id) {
  const tr = document.getElementById('row1_6-' + id);
  if (!tr) return;

  document.getElementById('form1_6_id').value = id;
  document.getElementById('form1_6_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_6_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_6_kecamatan').value = tr.getAttribute('data-kecamatan') || '';

  const p24 = tr.getAttribute('data-p24') || '0';
  document.getElementById('form1_6_p24').value = parseInt(p24).toLocaleString('id-ID');

  const p25 = tr.getAttribute('data-p25') || '0';
  document.getElementById('form1_6_p25').value = parseInt(p25).toLocaleString('id-ID');

  const growth = parseFloat(tr.getAttribute('data-growth') || '0');
  document.getElementById('form1_6_growth').value = growth.toFixed(2).replace('.', ',');

  document.getElementById('form1_6_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_6Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Pertumbuhan Penduduk';
  document.getElementById('btnSave1_6').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_6');
}

function submitForm1_6(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_6');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_6');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_6`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_6');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_6(id, namaKecamatan) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data pertumbuhan penduduk kecamatan "${namaKecamatan}" akan dihapus.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_6`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_6() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.6 akan dikembalikan ke 17 data pertumbuhan penduduk resmi BPS.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_6`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.7 (Migrasi Masuk dan Keluar)
// ===================================================================
function openModalTambah1_7() {
  document.getElementById('formTabel1_7').reset();
  document.getElementById('form1_7_id').value = '0';
  document.getElementById('form1_7_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_7Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data Migrasi Kecamatan';
  document.getElementById('btnSave1_7').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_7');
}

function editRow1_7(id) {
  const tr = document.getElementById('row1_7-' + id);
  if (!tr) return;

  document.getElementById('form1_7_id').value = id;
  document.getElementById('form1_7_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_7_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_7_kecamatan').value = tr.getAttribute('data-kecamatan') || '';

  const masuk = tr.getAttribute('data-masuk') || '0';
  document.getElementById('form1_7_masuk').value = parseInt(masuk).toLocaleString('id-ID');

  const keluar = tr.getAttribute('data-keluar') || '0';
  document.getElementById('form1_7_keluar').value = parseInt(keluar).toLocaleString('id-ID');

  document.getElementById('form1_7_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_7Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data Migrasi Kecamatan';
  document.getElementById('btnSave1_7').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_7');
}

function submitForm1_7(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_7');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_7');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_7`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_7');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_7(id, namaKecamatan) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data migrasi kecamatan "${namaKecamatan}" akan dihapus.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_7`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_7() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.7 akan dikembalikan ke 17 data migrasi kecamatan resmi BPS.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_7`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.8 (Jumlah ASN berdasarkan Jenis Kelamin)
// ===================================================================
function calcJumlah1_8(force = false) {
  const lkEl = document.getElementById('form1_8_laki');
  const prEl = document.getElementById('form1_8_perempuan');
  const jmEl = document.getElementById('form1_8_jumlah');
  if (!lkEl || !prEl || !jmEl) return;

  const lkVal = parseFloat(lkEl.value.replace(/\./g, '').replace(/,/g, '.')) || 0;
  const prVal = parseFloat(prEl.value.replace(/\./g, '').replace(/,/g, '.')) || 0;
  const sum = lkVal + prVal;
  jmEl.value = Math.round(sum).toLocaleString('id-ID');
}

function openModalTambah1_8() {
  document.getElementById('formTabel1_8').reset();
  document.getElementById('form1_8_id').value = '0';
  document.getElementById('form1_8_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_8Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Kategori Pegawai ASN';
  document.getElementById('btnSave1_8').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_8');
}

function editRow1_8(id) {
  const tr = document.getElementById('row1_8-' + id);
  if (!tr) return;

  document.getElementById('form1_8_id').value = id;
  document.getElementById('form1_8_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_8_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_8_jenis').value = tr.getAttribute('data-jenis') || '';

  const lk = tr.getAttribute('data-laki') || '0';
  document.getElementById('form1_8_laki').value = parseInt(lk).toLocaleString('id-ID');

  const pr = tr.getAttribute('data-perempuan') || '0';
  document.getElementById('form1_8_perempuan').value = parseInt(pr).toLocaleString('id-ID');

  const jm = tr.getAttribute('data-jumlah') || '0';
  document.getElementById('form1_8_jumlah').value = parseInt(jm).toLocaleString('id-ID');

  document.getElementById('form1_8_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_8Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Kategori Pegawai ASN';
  document.getElementById('btnSave1_8').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_8');
}

function submitForm1_8(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_8');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_8');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_8`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_8');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_8(id, namaJenis) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data kategori ASN "${namaJenis}" akan dihapus.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_8`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_8() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.8 akan dikembalikan ke data ASN resmi BKPSDM Kabupaten Situbondo.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_8`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.9 (Jumlah ASN Menurut Tingkat Pendidikan)
// ===================================================================
function calcJumlah1_9(force = false) {
  const fields = ['form1_9_pnsl', 'form1_9_pnsp', 'form1_9_penuhl', 'form1_9_penuhp', 'form1_9_paruhl', 'form1_9_paruhp'];
  let total = 0;
  fields.forEach(fId => {
    const el = document.getElementById(fId);
    if (el) {
      const val = parseFloat(el.value.replace(/\./g, '').replace(/,/g, '.').replace(/-/g, '')) || 0;
      total += val;
    }
  });
  const jmEl = document.getElementById('form1_9_jumlah');
  if (jmEl) {
    jmEl.value = Math.round(total).toLocaleString('id-ID');
  }
}

function openModalTambah1_9() {
  document.getElementById('formTabel1_9').reset();
  document.getElementById('form1_9_id').value = '0';
  document.getElementById('form1_9_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_9Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data ASN Tingkat Pendidikan';
  document.getElementById('btnSave1_9').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_9');
}

function editRow1_9(id) {
  const tr = document.getElementById('row1_9-' + id);
  if (!tr) return;

  document.getElementById('form1_9_id').value = id;
  document.getElementById('form1_9_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_9_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_9_tingkat').value = tr.getAttribute('data-tingkat') || '';

  const setVal = (id, attr) => {
    const v = parseInt(tr.getAttribute(attr) || '0');
    document.getElementById(id).value = v > 0 ? v.toLocaleString('id-ID') : '0';
  };

  setVal('form1_9_pnsl', 'data-pnsl');
  setVal('form1_9_pnsp', 'data-pnsp');
  setVal('form1_9_penuhl', 'data-penuhl');
  setVal('form1_9_penuhp', 'data-penuhp');
  setVal('form1_9_paruhl', 'data-paruhl');
  setVal('form1_9_paruhp', 'data-paruhp');

  const jm = tr.getAttribute('data-jumlah') || '0';
  document.getElementById('form1_9_jumlah').value = parseInt(jm).toLocaleString('id-ID');

  document.getElementById('form1_9_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_9Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data ASN Tingkat Pendidikan';
  document.getElementById('btnSave1_9').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_9');
}

function submitForm1_9(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_9');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_9');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_9`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_9');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_9(id, namaTingkat) {
  Swal.fire({
    title: 'Hapus Data?',
    text: `Data tingkat pendidikan "${namaTingkat}" akan dihapus.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_9`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_9() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.9 akan dikembalikan ke data pendidikan ASN resmi BKPSDM Kabupaten Situbondo.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_9`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.10 (Target, Realisasi dan Capaian Pendapatan Daerah)
// ===================================================================
function parseRupiahInput(val) {
  if (!val) return 0;
  let str = String(val).trim().replace(/\s/g, '');
  if (str.includes(',')) {
    str = str.replace(/\./g, '').replace(',', '.');
  } else if ((str.match(/\./g) || []).length > 1) {
    str = str.replace(/\./g, '');
  }
  return parseFloat(str) || 0;
}

function formatRupiahDisplay(num) {
  return (parseFloat(num) || 0).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function toggleHeader1_10(isHeader) {
  const parentSelect = document.getElementById('form1_10_parent');
  const nomorInput = document.getElementById('form1_10_nomor');
  if (isHeader == '1') {
    parentSelect.value = '0';
    if (!nomorInput.value) nomorInput.placeholder = 'Contoh: 1, 2, 3';
  } else {
    if (parentSelect.value == '0') parentSelect.value = '1';
    nomorInput.placeholder = 'Kosongkan untuk sub-akun';
  }
}

function calcTabel1_10(force = false) {
  const anggEl = document.getElementById('form1_10_anggaran');
  const realEl = document.getElementById('form1_10_realisasi');
  const selEl = document.getElementById('form1_10_selisih');
  const pctEl = document.getElementById('form1_10_persen');
  if (!anggEl || !realEl || !selEl || !pctEl) return;

  const angg = parseRupiahInput(anggEl.value);
  const real = parseRupiahInput(realEl.value);

  const selisih = real - angg;
  selEl.value = formatRupiahDisplay(selisih);

  if (angg > 0) {
    const pct = (real / angg) * 100;
    pctEl.value = pct.toFixed(2).replace('.', ',');
  } else if (real === 0 && angg === 0) {
    pctEl.value = '0,00';
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan nilai Anggaran 2025 lebih dari 0 untuk menghitung persentase capaian.'
    });
  }
}

function openModalTambah1_10() {
  document.getElementById('formTabel1_10').reset();
  document.getElementById('form1_10_id').value = '0';
  document.getElementById('form1_10_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_10_header').value = '0';
  document.getElementById('form1_10_parent').value = '1';
  document.getElementById('modal1_10Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Pendapatan Daerah';
  document.getElementById('btnSave1_10').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_10');
}

function editRow1_10(id) {
  const tr = document.getElementById('row1_10-' + id);
  if (!tr) return;

  document.getElementById('form1_10_id').value = id;
  document.getElementById('form1_10_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_10_nomor').value = tr.getAttribute('data-nomor') || '';
  document.getElementById('form1_10_header').value = tr.getAttribute('data-header') || '0';
  document.getElementById('form1_10_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_10_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_10_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_10_anggaran').value = formatRupiahDisplay(tr.getAttribute('data-anggaran') || 0);
  document.getElementById('form1_10_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  document.getElementById('form1_10_selisih').value = formatRupiahDisplay(tr.getAttribute('data-selisih') || 0);
  
  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_10_persen').value = pct.toFixed(2).replace('.', ',');

  document.getElementById('form1_10_r24').value = formatRupiahDisplay(tr.getAttribute('data-r24') || 0);
  document.getElementById('form1_10_r23').value = formatRupiahDisplay(tr.getAttribute('data-r23') || 0);
  document.getElementById('form1_10_r22').value = formatRupiahDisplay(tr.getAttribute('data-r22') || 0);

  document.getElementById('form1_10_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_10Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Pendapatan Daerah';
  document.getElementById('btnSave1_10').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_10');
}

function submitForm1_10(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_10');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_10');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_10`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_10');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_10(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Pendapatan?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.10.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_10`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_10() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.10 akan dikembalikan persis ke data Target dan Realisasi Pendapatan Daerah resmi BKAD Tahun 2025.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_10`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.11 (Rincian Pajak Daerah - BAPENDA)
// ===================================================================
function handleTipe1_11Change(val) {
  const hInput = document.getElementById('form1_11_header');
  const lvlInput = document.getElementById('form1_11_level');
  const pSelect = document.getElementById('form1_11_parent');
  const nomInput = document.getElementById('form1_11_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
    if (!nomInput.value) nomInput.value = '4.1.01';
  } else if (val === 'lvl2_header') {
    hInput.value = '1';
    lvlInput.value = '2';
    pSelect.value = '1';
    if (!nomInput.value) nomInput.value = '4.1.01.19';
  } else if (val === 'lvl3_item') {
    hInput.value = '0';
    lvlInput.value = '3';
    pSelect.value = '7';
    nomInput.placeholder = 'Contoh: 4.1.01.19.01';
  } else {
    hInput.value = '0';
    lvlInput.value = '2';
    pSelect.value = '1';
    nomInput.placeholder = 'Contoh: 4.1.01.09';
  }
}

function calcTabel1_11(force = false) {
  const tgtEl = document.getElementById('form1_11_target');
  const realEl = document.getElementById('form1_11_realisasi');
  const pctEl = document.getElementById('form1_11_persen');
  if (!tgtEl || !realEl || !pctEl) return;

  const tgt = parseRupiahInput(tgtEl.value);
  const real = parseRupiahInput(realEl.value);

  if (tgt > 0) {
    const pct = (real / tgt) * 100;
    pctEl.value = pct.toFixed(2).replace('.', ',');
  } else if (real === 0 && tgt === 0) {
    pctEl.value = '0,00';
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan nilai Target 2025 lebih dari 0 untuk menghitung persentase capaian.'
    });
  }
}

function openModalTambah1_11() {
  document.getElementById('formTabel1_11').reset();
  document.getElementById('form1_11_id').value = '0';
  document.getElementById('form1_11_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_11_tipe').value = 'lvl2_item';
  handleTipe1_11Change('lvl2_item');
  document.getElementById('modal1_11Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Pajak Daerah';
  document.getElementById('btnSave1_11').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_11');
}

function editRow1_11(id) {
  const tr = document.getElementById('row1_11-' + id);
  if (!tr) return;

  document.getElementById('form1_11_id').value = id;
  document.getElementById('form1_11_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_11_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '2', 10);
  
  let tipeVal = 'lvl2_item';
  if (lvl === 1) {
    tipeVal = 'lvl1_header';
  } else if (lvl === 2 && isHeader == '1') {
    tipeVal = 'lvl2_header';
  } else if (lvl === 3) {
    tipeVal = 'lvl3_item';
  }
  document.getElementById('form1_11_tipe').value = tipeVal;
  document.getElementById('form1_11_header').value = isHeader;
  document.getElementById('form1_11_level').value = lvl;

  document.getElementById('form1_11_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_11_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_11_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_11_target').value = formatRupiahDisplay(tr.getAttribute('data-target') || 0);
  document.getElementById('form1_11_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_11_persen').value = pct.toFixed(2).replace('.', ',');

  const pert = tr.getAttribute('data-pertumbuhan');
  if (pert !== null && pert !== '') {
    const pf = parseFloat(pert);
    if (pf < 0) {
      document.getElementById('form1_11_pertumbuhan').value = '(' + Math.abs(pf).toFixed(2).replace('.', ',') + ')';
    } else {
      document.getElementById('form1_11_pertumbuhan').value = pf.toFixed(2).replace('.', ',');
    }
  } else {
    document.getElementById('form1_11_pertumbuhan').value = '-';
  }

  document.getElementById('form1_11_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_11Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Pajak Daerah';
  document.getElementById('btnSave1_11').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_11');
}

function submitForm1_11(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_11');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_11');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_11`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_11');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_11(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Pajak?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.11.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_11`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_11() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.11 akan dikembalikan persis ke data Rincian Pajak Daerah resmi BAPENDA Tahun 2025.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_11`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.12 (Rincian Retribusi Daerah - Bapenda)
// ===================================================================
function handleTipe1_12Change(val) {
  const hInput = document.getElementById('form1_12_header');
  const lvlInput = document.getElementById('form1_12_level');
  const pSelect = document.getElementById('form1_12_parent');
  const nomInput = document.getElementById('form1_12_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
    if (!nomInput.value) nomInput.value = '4.1.02';
  } else if (val === 'lvl2_header') {
    hInput.value = '1';
    lvlInput.value = '2';
    pSelect.value = '1';
    nomInput.placeholder = 'Contoh: 4.1.02.01';
  } else {
    hInput.value = '0';
    lvlInput.value = '3';
    pSelect.value = '2';
    nomInput.placeholder = 'Contoh: 4.1.02.01.01';
  }
}

function calcTabel1_12(force = false) {
  const tgtEl = document.getElementById('form1_12_target');
  const realEl = document.getElementById('form1_12_realisasi');
  const pctEl = document.getElementById('form1_12_persen');
  if (!tgtEl || !realEl || !pctEl) return;

  const tgt = parseRupiahInput(tgtEl.value);
  const real = parseRupiahInput(realEl.value);

  if (tgt > 0) {
    const pct = (real / tgt) * 100;
    pctEl.value = pct.toFixed(2).replace('.', ',');
  } else if (real === 0 && tgt === 0) {
    pctEl.value = '0,00';
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan nilai Target 2025 lebih dari 0 untuk menghitung persentase capaian.'
    });
  }
}

function openModalTambah1_12() {
  document.getElementById('formTabel1_12').reset();
  document.getElementById('form1_12_id').value = '0';
  document.getElementById('form1_12_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_12_tipe').value = 'lvl3_item';
  handleTipe1_12Change('lvl3_item');
  document.getElementById('modal1_12Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Retribusi Daerah';
  document.getElementById('btnSave1_12').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_12');
}

function editRow1_12(id) {
  const tr = document.getElementById('row1_12-' + id);
  if (!tr) return;

  document.getElementById('form1_12_id').value = id;
  document.getElementById('form1_12_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_12_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '3', 10);
  
  let tipeVal = 'lvl3_item';
  if (lvl === 1) {
    tipeVal = 'lvl1_header';
  } else if (lvl === 2) {
    tipeVal = 'lvl2_header';
  } else {
    tipeVal = 'lvl3_item';
  }
  document.getElementById('form1_12_tipe').value = tipeVal;
  document.getElementById('form1_12_header').value = isHeader;
  document.getElementById('form1_12_level').value = lvl;

  document.getElementById('form1_12_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_12_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_12_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_12_target').value = formatRupiahDisplay(tr.getAttribute('data-target') || 0);
  document.getElementById('form1_12_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_12_persen').value = pct.toFixed(2).replace('.', ',');

  document.getElementById('form1_12_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_12Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Retribusi Daerah';
  document.getElementById('btnSave1_12').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_12');
}

function submitForm1_12(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_12');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_12');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_12`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_12');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_12(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Retribusi?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.12.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_12`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_12() {
  Swal.fire({
    title: 'Reset ke Data Bawaan?',
    text: 'Tabel 1.12 akan dikembalikan persis ke data Rincian Retribusi Daerah resmi Bapenda Tahun 2025.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_12`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.13 (Rincian Hasil Pengelolaan Keuangan Dipisahkan)
// ===================================================================
function handleTipe1_13Change(val) {
  const hInput = document.getElementById('form1_13_header');
  const lvlInput = document.getElementById('form1_13_level');
  const pSelect = document.getElementById('form1_13_parent');
  const nomInput = document.getElementById('form1_13_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
    if (!nomInput.value) nomInput.value = '4.1.03';
  } else if (val === 'lvl2_header') {
    hInput.value = '1';
    lvlInput.value = '2';
    if (!nomInput.value) nomInput.value = '4.1.03.02';
  } else {
    hInput.value = '0';
    lvlInput.value = '3';
    nomInput.placeholder = 'Contoh: 4.1.03.02.01';
  }
}

function calcTabel1_13(force = false) {
  const tgtEl = document.getElementById('form1_13_target');
  const realEl = document.getElementById('form1_13_realisasi');
  const pctEl = document.getElementById('form1_13_persen');
  if (!tgtEl || !realEl || !pctEl) return;

  const tgt = parseRupiahInput(tgtEl.value);
  const real = parseRupiahInput(realEl.value);

  if (tgt > 0) {
    const pct = (real / tgt) * 100;
    pctEl.value = pct.toFixed(2).replace('.', ',');
  } else if (real === 0 && tgt === 0) {
    pctEl.value = '0,00';
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan nilai Target 2025 lebih dari 0 untuk menghitung persentase capaian.'
    });
  }
}

function openModalTambah1_13() {
  document.getElementById('formTabel1_13').reset();
  document.getElementById('form1_13_id').value = '0';
  document.getElementById('form1_13_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_13_tipe').value = 'lvl3_item';
  handleTipe1_13Change('lvl3_item');
  document.getElementById('modal1_13Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Hasil Pengelolaan';
  document.getElementById('btnSave1_13').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_13');
}

function editRow1_13(id) {
  const tr = document.getElementById('row1_13-' + id);
  if (!tr) return;

  document.getElementById('form1_13_id').value = id;
  document.getElementById('form1_13_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_13_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '3', 10);
  
  let tipeVal = 'lvl3_item';
  if (lvl === 1) {
    tipeVal = 'lvl1_header';
  } else if (lvl === 2 && isHeader == '1') {
    tipeVal = 'lvl2_header';
  } else if (lvl === 3) {
    tipeVal = 'lvl3_item';
  }
  document.getElementById('form1_13_tipe').value = tipeVal;
  document.getElementById('form1_13_header').value = isHeader;
  document.getElementById('form1_13_level').value = lvl;

  document.getElementById('form1_13_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_13_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_13_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_13_target').value = formatRupiahDisplay(tr.getAttribute('data-target') || 0);
  document.getElementById('form1_13_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_13_persen').value = pct.toFixed(2).replace('.', ',');

  const pert = tr.getAttribute('data-pertumbuhan');
  if (pert !== null && pert !== '') {
    const pf = parseFloat(pert);
    if (pf < 0) {
      document.getElementById('form1_13_pertumbuhan').value = '(' + Math.abs(pf).toFixed(2).replace('.', ',') + ')';
    } else {
      document.getElementById('form1_13_pertumbuhan').value = pf.toFixed(2).replace('.', ',');
    }
  } else {
    document.getElementById('form1_13_pertumbuhan').value = '-';
  }

  document.getElementById('form1_13_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_13Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Hasil Pengelolaan';
  document.getElementById('btnSave1_13').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_13');
}

function submitForm1_13(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_13');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_13');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_13`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_13');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_13(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Data?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.13.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_13`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      })
      .catch(err => Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data.' }));
    }
  });
}

function konfirmasiReset1_13() {
  Swal.fire({
    title: 'Reset Tabel 1.13 ke Data Resmi BKAD?',
    text: 'Tabel 1.13 akan dikembalikan persis ke data hasil pengelolaan keuangan daerah resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_13`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.14 (Rincian Hasil Lain-Lain PAD yang Sah)
// ===================================================================
function handleTipe1_14Change(val) {
  const hInput = document.getElementById('form1_14_header');
  const lvlInput = document.getElementById('form1_14_level');
  const pSelect = document.getElementById('form1_14_parent');
  const nomInput = document.getElementById('form1_14_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
    if (!nomInput.value) nomInput.value = '4.1.04';
  } else {
    hInput.value = '0';
    lvlInput.value = '2';
    nomInput.placeholder = 'Contoh: 4.1.04.01';
  }
}

function calcTabel1_14(force = false) {
  const tgtEl = document.getElementById('form1_14_target');
  const realEl = document.getElementById('form1_14_realisasi');
  const pctEl = document.getElementById('form1_14_persen');
  if (!tgtEl || !realEl || !pctEl) return;

  const tgt = parseRupiahInput(tgtEl.value);
  const real = parseRupiahInput(realEl.value);

  if (tgt > 0) {
    const pct = (real / tgt) * 100;
    pctEl.value = pct.toFixed(2).replace('.', ',');
  } else if (real === 0 && tgt === 0) {
    pctEl.value = '0,00';
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan nilai Target 2025 lebih dari 0 untuk menghitung persentase capaian.'
    });
  }
}

function openModalTambah1_14() {
  document.getElementById('formTabel1_14').reset();
  document.getElementById('form1_14_id').value = '0';
  document.getElementById('form1_14_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_14_tipe').value = 'lvl2_item';
  handleTipe1_14Change('lvl2_item');
  document.getElementById('modal1_14Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Lain-Lain PAD';
  document.getElementById('btnSave1_14').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_14');
}

function editRow1_14(id) {
  const tr = document.getElementById('row1_14-' + id);
  if (!tr) return;

  document.getElementById('form1_14_id').value = id;
  document.getElementById('form1_14_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_14_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '2', 10);
  
  let tipeVal = (lvl === 1 || isHeader == '1') ? 'lvl1_header' : 'lvl2_item';
  document.getElementById('form1_14_tipe').value = tipeVal;
  document.getElementById('form1_14_header').value = isHeader;
  document.getElementById('form1_14_level').value = lvl;

  document.getElementById('form1_14_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_14_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_14_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_14_target').value = formatRupiahDisplay(tr.getAttribute('data-target') || 0);
  document.getElementById('form1_14_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_14_persen').value = pct.toFixed(2).replace('.', ',');

  const pert = tr.getAttribute('data-pertumbuhan');
  if (pert !== null && pert !== '') {
    const pf = parseFloat(pert);
    if (pf < 0) {
      document.getElementById('form1_14_pertumbuhan').value = '(' + Math.abs(pf).toFixed(2).replace('.', ',') + ')';
    } else {
      document.getElementById('form1_14_pertumbuhan').value = pf.toFixed(2).replace('.', ',');
    }
  } else {
    document.getElementById('form1_14_pertumbuhan').value = '-';
  }

  document.getElementById('form1_14_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_14Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Lain-Lain PAD';
  document.getElementById('btnSave1_14').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_14');
}

function submitForm1_14(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_14');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_14');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_14`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_14');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_14(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Data?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.14.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_14`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      })
      .catch(err => Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data.' }));
    }
  });
}

function konfirmasiReset1_14() {
  Swal.fire({
    title: 'Reset Tabel 1.14 ke Data Resmi Bapenda?',
    text: 'Tabel 1.14 akan dikembalikan persis ke data rincian hasil lain-lain PAD yang sah resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_14`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.15 (Rincian Pendapatan Transfer)
// ===================================================================
function handleTipe1_15Change(val) {
  const hInput = document.getElementById('form1_15_header');
  const lvlInput = document.getElementById('form1_15_level');
  const pSelect = document.getElementById('form1_15_parent');
  const nomInput = document.getElementById('form1_15_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
    if (!nomInput.value) nomInput.value = '4.2';
  } else if (val === 'lvl2_header') {
    hInput.value = '1';
    lvlInput.value = '2';
    if (!nomInput.value) nomInput.value = '4.2.01';
  } else {
    hInput.value = '0';
    lvlInput.value = '3';
    nomInput.placeholder = 'Contoh: 4.2.01.05';
  }
}

function calcTabel1_15(force = false) {
  const tgtEl = document.getElementById('form1_15_target');
  const realEl = document.getElementById('form1_15_realisasi');
  const pctEl = document.getElementById('form1_15_persen');
  if (!tgtEl || !realEl || !pctEl) return;

  const tgt = parseRupiahInput(tgtEl.value);
  const real = parseRupiahInput(realEl.value);

  if (tgt > 0) {
    const pct = (real / tgt) * 100;
    pctEl.value = pct.toFixed(2).replace('.', ',');
  } else if (real === 0 && tgt === 0) {
    pctEl.value = '0,00';
  } else if (force) {
    Swal.fire({
      icon: 'info',
      title: 'Info Hitung',
      text: 'Masukkan nilai Target 2025 lebih dari 0 untuk menghitung persentase capaian.'
    });
  }
}

function openModalTambah1_15() {
  document.getElementById('formTabel1_15').reset();
  document.getElementById('form1_15_id').value = '0';
  document.getElementById('form1_15_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_15_tipe').value = 'lvl3_item';
  handleTipe1_15Change('lvl3_item');
  document.getElementById('modal1_15Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Pendapatan Transfer';
  document.getElementById('btnSave1_15').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_15');
}

function editRow1_15(id) {
  const tr = document.getElementById('row1_15-' + id);
  if (!tr) return;

  document.getElementById('form1_15_id').value = id;
  document.getElementById('form1_15_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_15_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '3', 10);
  
  let tipeVal = 'lvl3_item';
  if (lvl === 1) tipeVal = 'lvl1_header';
  else if (lvl === 2) tipeVal = 'lvl2_header';

  document.getElementById('form1_15_tipe').value = tipeVal;
  document.getElementById('form1_15_header').value = isHeader;
  document.getElementById('form1_15_level').value = lvl;

  document.getElementById('form1_15_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_15_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_15_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_15_target').value = formatRupiahDisplay(tr.getAttribute('data-target') || 0);
  document.getElementById('form1_15_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_15_persen').value = pct.toFixed(2).replace('.', ',');

  const pert = tr.getAttribute('data-pertumbuhan');
  if (pert !== null && pert !== '') {
    const pf = parseFloat(pert);
    if (pf < 0) {
      document.getElementById('form1_15_pertumbuhan').value = '(' + Math.abs(pf).toFixed(2).replace('.', ',') + ')';
    } else {
      document.getElementById('form1_15_pertumbuhan').value = pf.toFixed(2).replace('.', ',');
    }
  } else {
    document.getElementById('form1_15_pertumbuhan').value = '-';
  }

  document.getElementById('form1_15_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_15Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Pendapatan Transfer';
  document.getElementById('btnSave1_15').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_15');
}

function submitForm1_15(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_15');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_15');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_15`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_15');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_15(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Data?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.15.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_15`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      })
      .catch(err => Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data.' }));
    }
  });
}

function konfirmasiReset1_15() {
  Swal.fire({
    title: 'Reset Tabel 1.15 ke Data Resmi BKAD?',
    text: 'Tabel 1.15 akan dikembalikan persis ke data rincian pendapatan transfer resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_15`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.16 (Rincian Belanja dan Transfer Daerah)
// ===================================================================
function handleTipe1_16Change(val) {
  const hInput = document.getElementById('form1_16_header');
  const lvlInput = document.getElementById('form1_16_level');
  const pSelect = document.getElementById('form1_16_parent');
  const nomInput = document.getElementById('form1_16_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
    if (!nomInput.value) nomInput.value = '1';
  } else {
    hInput.value = '0';
    lvlInput.value = '2';
    nomInput.placeholder = 'Kosongkan jika bukan kelompok utama';
  }
}

function calcTabel1_16(force = false) {
  const anggEl = document.getElementById('form1_16_anggaran');
  const realEl = document.getElementById('form1_16_realisasi');
  const selEl = document.getElementById('form1_16_selisih');
  const pctEl = document.getElementById('form1_16_persen');
  if (!anggEl || !realEl) return;

  const angg = parseRupiahInput(anggEl.value);
  const real = parseRupiahInput(realEl.value);

  // Selisih = Realisasi - Anggaran
  const diff = real - angg;
  if (selEl) {
    if (diff < 0) {
      selEl.value = '(' + formatRupiahDisplay(Math.abs(diff)) + ')';
    } else {
      selEl.value = formatRupiahDisplay(diff);
    }
  }

  // Capaian % = Realisasi / Anggaran * 100
  if (pctEl) {
    if (angg > 0) {
      const pct = (real / angg) * 100;
      pctEl.value = pct.toFixed(2).replace('.', ',');
    } else if (real === 0 && angg === 0) {
      pctEl.value = '0,00';
    } else if (force) {
      Swal.fire({
        icon: 'info',
        title: 'Info Hitung',
        text: 'Masukkan nilai Anggaran 2025 lebih dari 0 untuk menghitung capaian %.'
      });
    }
  }
}

function openModalTambah1_16() {
  document.getElementById('formTabel1_16').reset();
  document.getElementById('form1_16_id').value = '0';
  document.getElementById('form1_16_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_16_tipe').value = 'lvl2_item';
  handleTipe1_16Change('lvl2_item');
  document.getElementById('modal1_16Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Belanja & Transfer';
  document.getElementById('btnSave1_16').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_16');
}

function editRow1_16(id) {
  const tr = document.getElementById('row1_16-' + id);
  if (!tr) return;

  document.getElementById('form1_16_id').value = id;
  document.getElementById('form1_16_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_16_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '2', 10);
  
  let tipeVal = (lvl === 1 || isHeader == '1') ? 'lvl1_header' : 'lvl2_item';
  document.getElementById('form1_16_tipe').value = tipeVal;
  document.getElementById('form1_16_header').value = isHeader;
  document.getElementById('form1_16_level').value = lvl;

  document.getElementById('form1_16_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_16_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_16_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_16_anggaran').value = formatRupiahDisplay(tr.getAttribute('data-anggaran') || 0);
  document.getElementById('form1_16_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const selisih = parseFloat(tr.getAttribute('data-selisih') || 0);
  if (selisih < 0) {
    document.getElementById('form1_16_selisih').value = '(' + formatRupiahDisplay(Math.abs(selisih)) + ')';
  } else {
    document.getElementById('form1_16_selisih').value = formatRupiahDisplay(selisih);
  }

  const pct = parseFloat(tr.getAttribute('data-persen') || 0);
  document.getElementById('form1_16_persen').value = pct.toFixed(2).replace('.', ',');

  document.getElementById('form1_16_real24').value = formatRupiahDisplay(tr.getAttribute('data-realisasi24') || 0);
  document.getElementById('form1_16_real23').value = formatRupiahDisplay(tr.getAttribute('data-realisasi23') || 0);
  document.getElementById('form1_16_real22').value = formatRupiahDisplay(tr.getAttribute('data-realisasi22') || 0);

  document.getElementById('form1_16_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_16Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Belanja & Transfer';
  document.getElementById('btnSave1_16').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_16');
}

function submitForm1_16(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_16');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSave1_16');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_16`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_16');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_16(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Data?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.16.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_16`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      })
      .catch(err => Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data.' }));
    }
  });
}

function konfirmasiReset1_16() {
  Swal.fire({
    title: 'Reset Tabel 1.16 ke Data Resmi BKAD?',
    text: 'Tabel 1.16 akan dikembalikan persis ke data rincian belanja dan transfer resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);

      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_16`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.17 (Rincian Belanja Hibah)
// ===================================================================
function calcTabel1_17() {
  const pAng = parseRupiahInput(document.getElementById('form1_17_pusat_ang').value);
  const pRea = parseRupiahInput(document.getElementById('form1_17_pusat_rea').value);
  const bAng = parseRupiahInput(document.getElementById('form1_17_badan_ang').value);
  const bRea = parseRupiahInput(document.getElementById('form1_17_badan_rea').value);
  const kAng = parseRupiahInput(document.getElementById('form1_17_parpol_ang').value);
  const kRea = parseRupiahInput(document.getElementById('form1_17_parpol_rea').value);
  const sAng = parseRupiahInput(document.getElementById('form1_17_bosp_ang').value);
  const sRea = parseRupiahInput(document.getElementById('form1_17_bosp_rea').value);

  const totAng = pAng + bAng + kAng + sAng;
  const totRea = pRea + bRea + kRea + sRea;

  document.getElementById('form1_17_tot_ang').value = formatRupiahDisplay(totAng);
  document.getElementById('form1_17_tot_rea').value = formatRupiahDisplay(totRea);
}

function openModalTambah1_17() {
  document.getElementById('formTabel1_17').reset();
  document.getElementById('form1_17_id').value = '0';
  document.getElementById('form1_17_tahun').value = CURRENT_TAHUN;
  calcTabel1_17();
  document.getElementById('modal1_17Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Belanja Hibah';
  document.getElementById('btnSave1_17').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_17');
}

function editRow1_17(id) {
  const tr = document.getElementById('row1_17-' + id);
  if (!tr) return;

  document.getElementById('form1_17_id').value = id;
  document.getElementById('form1_17_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_17_uraian').value = tr.getAttribute('data-uraian') || '';
  document.getElementById('form1_17_urutan').value = tr.getAttribute('data-urutan') || '';

  document.getElementById('form1_17_pusat_ang').value = formatRupiahDisplay(tr.getAttribute('data-pusat-ang') || 0);
  document.getElementById('form1_17_pusat_rea').value = formatRupiahDisplay(tr.getAttribute('data-pusat-rea') || 0);
  document.getElementById('form1_17_badan_ang').value = formatRupiahDisplay(tr.getAttribute('data-badan-ang') || 0);
  document.getElementById('form1_17_badan_rea').value = formatRupiahDisplay(tr.getAttribute('data-badan-rea') || 0);
  document.getElementById('form1_17_parpol_ang').value = formatRupiahDisplay(tr.getAttribute('data-parpol-ang') || 0);
  document.getElementById('form1_17_parpol_rea').value = formatRupiahDisplay(tr.getAttribute('data-parpol-rea') || 0);
  document.getElementById('form1_17_bosp_ang').value = formatRupiahDisplay(tr.getAttribute('data-bosp-ang') || 0);
  document.getElementById('form1_17_bosp_rea').value = formatRupiahDisplay(tr.getAttribute('data-bosp-rea') || 0);

  calcTabel1_17();
  document.getElementById('form1_17_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_17Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Belanja Hibah';
  document.getElementById('btnSave1_17').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_17');
}

function submitForm1_17(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_17');
  const formData = new FormData(form);
  const btn = document.getElementById('btnSave1_17');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_17`, {
    method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_17');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_17(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Belanja Hibah?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.17.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);
      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_17`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_17() {
  Swal.fire({
    title: 'Reset Tabel 1.17 ke Data Resmi BKAD?',
    text: 'Tabel 1.17 akan dikembalikan persis ke data rincian belanja hibah resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_17`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.18 (Rincian Belanja Bantuan Sosial)
// ===================================================================
function calcTabel1_18() {
  const iAng = parseRupiahInput(document.getElementById('form1_18_indiv_ang').value);
  const iRea = parseRupiahInput(document.getElementById('form1_18_indiv_rea').value);
  const pAng = parseRupiahInput(document.getElementById('form1_18_pokmas_ang').value);
  const pRea = parseRupiahInput(document.getElementById('form1_18_pokmas_rea').value);
  const lAng = parseRupiahInput(document.getElementById('form1_18_lembaga_ang').value);
  const lRea = parseRupiahInput(document.getElementById('form1_18_lembaga_rea').value);

  const totAng = iAng + pAng + lAng;
  const totRea = iRea + pRea + lRea;

  document.getElementById('form1_18_tot_ang').value = formatRupiahDisplay(totAng);
  document.getElementById('form1_18_tot_rea').value = formatRupiahDisplay(totRea);
}

function openModalTambah1_18() {
  document.getElementById('formTabel1_18').reset();
  document.getElementById('form1_18_id').value = '0';
  document.getElementById('form1_18_tahun').value = CURRENT_TAHUN;
  calcTabel1_18();
  document.getElementById('modal1_18Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rincian Belanja Bansos';
  document.getElementById('btnSave1_18').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_18');
}

function editRow1_18(id) {
  const tr = document.getElementById('row1_18-' + id);
  if (!tr) return;

  document.getElementById('form1_18_id').value = id;
  document.getElementById('form1_18_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_18_uraian').value = tr.getAttribute('data-uraian') || '';
  document.getElementById('form1_18_urutan').value = tr.getAttribute('data-urutan') || '';

  document.getElementById('form1_18_indiv_ang').value = formatRupiahDisplay(tr.getAttribute('data-indiv-ang') || 0);
  document.getElementById('form1_18_indiv_rea').value = formatRupiahDisplay(tr.getAttribute('data-indiv-rea') || 0);
  document.getElementById('form1_18_pokmas_ang').value = formatRupiahDisplay(tr.getAttribute('data-pokmas-ang') || 0);
  document.getElementById('form1_18_pokmas_rea').value = formatRupiahDisplay(tr.getAttribute('data-pokmas-rea') || 0);
  document.getElementById('form1_18_lembaga_ang').value = formatRupiahDisplay(tr.getAttribute('data-lembaga-ang') || 0);
  document.getElementById('form1_18_lembaga_rea').value = formatRupiahDisplay(tr.getAttribute('data-lembaga-rea') || 0);

  calcTabel1_18();
  document.getElementById('form1_18_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_18Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rincian Belanja Bansos';
  document.getElementById('btnSave1_18').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_18');
}

function submitForm1_18(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_18');
  const formData = new FormData(form);
  const btn = document.getElementById('btnSave1_18');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_18`, {
    method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_18');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_18(id, uraian) {
  Swal.fire({
    title: 'Hapus Rincian Belanja Bansos?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.18.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);
      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_18`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_18() {
  Swal.fire({
    title: 'Reset Tabel 1.18 ke Data Resmi BKAD?',
    text: 'Tabel 1.18 akan dikembalikan persis ke data rincian belanja bantuan sosial resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_18`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.19 (Pembiayaan Daerah)
// ===================================================================
function handleTipe1_19Change(val) {
  const hInput = document.getElementById('form1_19_header');
  const lvlInput = document.getElementById('form1_19_level');
  const pSelect = document.getElementById('form1_19_parent');
  const nomInput = document.getElementById('form1_19_nomor');

  if (val === 'lvl1_header') {
    hInput.value = '1';
    lvlInput.value = '1';
    pSelect.value = '0';
  } else {
    hInput.value = '0';
    lvlInput.value = '2';
    nomInput.placeholder = 'Kosongkan jika bukan kelompok utama';
  }
}

function calcTabel1_19(force = false) {
  const anggEl = document.getElementById('form1_19_anggaran');
  const realEl = document.getElementById('form1_19_realisasi');
  const selEl = document.getElementById('form1_19_selisih');
  const pctEl = document.getElementById('form1_19_persen');
  if (!anggEl || !realEl) return;

  const angg = parseRupiahInput(anggEl.value);
  const real = parseRupiahInput(realEl.value);

  const diff = real - angg;
  if (selEl) {
    if (diff < 0) {
      selEl.value = '(' + formatRupiahDisplay(Math.abs(diff)) + ')';
    } else {
      selEl.value = formatRupiahDisplay(diff);
    }
  }

  if (pctEl) {
    if (angg > 0) {
      const pct = (real / angg) * 100;
      pctEl.value = pct.toFixed(2).replace('.', ',');
    } else if (real > 0 && angg === 0) {
      pctEl.value = '-';
    } else {
      pctEl.value = '0,00';
    }
  }
}

function openModalTambah1_19() {
  document.getElementById('formTabel1_19').reset();
  document.getElementById('form1_19_id').value = '0';
  document.getElementById('form1_19_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_19_tipe').value = 'lvl2_item';
  handleTipe1_19Change('lvl2_item');
  document.getElementById('modal1_19Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Rekening Pembiayaan Daerah';
  document.getElementById('btnSave1_19').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_19');
}

function editRow1_19(id) {
  const tr = document.getElementById('row1_19-' + id);
  if (!tr) return;

  document.getElementById('form1_19_id').value = id;
  document.getElementById('form1_19_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_19_nomor').value = tr.getAttribute('data-nomor') || '';
  
  const isHeader = tr.getAttribute('data-header') || '0';
  const lvl = parseInt(tr.getAttribute('data-level') || '2', 10);
  
  let tipeVal = (lvl === 1 || isHeader == '1') ? 'lvl1_header' : 'lvl2_item';
  document.getElementById('form1_19_tipe').value = tipeVal;
  document.getElementById('form1_19_header').value = isHeader;
  document.getElementById('form1_19_level').value = lvl;

  document.getElementById('form1_19_parent').value = tr.getAttribute('data-parent') || '0';
  document.getElementById('form1_19_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_19_uraian').value = tr.getAttribute('data-uraian') || '';

  document.getElementById('form1_19_anggaran').value = formatRupiahDisplay(tr.getAttribute('data-anggaran') || 0);
  document.getElementById('form1_19_realisasi').value = formatRupiahDisplay(tr.getAttribute('data-realisasi') || 0);
  
  const selisih = parseFloat(tr.getAttribute('data-selisih') || 0);
  if (selisih < 0) {
    document.getElementById('form1_19_selisih').value = '(' + formatRupiahDisplay(Math.abs(selisih)) + ')';
  } else {
    document.getElementById('form1_19_selisih').value = formatRupiahDisplay(selisih);
  }

  document.getElementById('form1_19_persen').value = tr.getAttribute('data-persen') || '0,00';
  document.getElementById('form1_19_real24').value = formatRupiahDisplay(tr.getAttribute('data-realisasi24') || 0);
  document.getElementById('form1_19_real23').value = formatRupiahDisplay(tr.getAttribute('data-realisasi23') || 0);
  document.getElementById('form1_19_real22').value = formatRupiahDisplay(tr.getAttribute('data-realisasi22') || 0);

  document.getElementById('form1_19_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_19Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Rekening Pembiayaan Daerah';
  document.getElementById('btnSave1_19').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_19');
}

function submitForm1_19(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_19');
  const formData = new FormData(form);
  const btn = document.getElementById('btnSave1_19');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_19`, {
    method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_19');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_19(id, uraian) {
  Swal.fire({
    title: 'Hapus Rekening Pembiayaan?',
    text: `Uraian "${uraian}" akan dihapus dari tabel 1.19.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);
      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_19`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_19() {
  Swal.fire({
    title: 'Reset Tabel 1.19 ke Data Resmi BKAD?',
    text: 'Tabel 1.19 akan dikembalikan persis ke data pembiayaan daerah resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_19`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL 1.20 (Komponen SILPA)
// ===================================================================
function openModalTambah1_20() {
  document.getElementById('formTabel1_20').reset();
  document.getElementById('form1_20_id').value = '0';
  document.getElementById('form1_20_tahun').value = CURRENT_TAHUN;
  document.getElementById('modal1_20Title').innerHTML = '<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Komponen SILPA';
  document.getElementById('btnSave1_20').innerHTML = '<i class="fa fa-save"></i> Simpan Data';
  openModal('modalTabel1_20');
}

function editRow1_20(id) {
  const tr = document.getElementById('row1_20-' + id);
  if (!tr) return;

  document.getElementById('form1_20_id').value = id;
  document.getElementById('form1_20_tahun').value = CURRENT_TAHUN;
  document.getElementById('form1_20_komponen').value = tr.getAttribute('data-komponen') || '';
  document.getElementById('form1_20_jumlah').value = formatRupiahDisplay(tr.getAttribute('data-jumlah') || 0);
  document.getElementById('form1_20_urutan').value = tr.getAttribute('data-urutan') || '';
  document.getElementById('form1_20_ket').value = tr.getAttribute('data-keterangan') || '';

  document.getElementById('modal1_20Title').innerHTML = '<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Komponen SILPA';
  document.getElementById('btnSave1_20').innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan';
  openModal('modalTabel1_20');
}

function submitForm1_20(e) {
  e.preventDefault();
  const form = document.getElementById('formTabel1_20');
  const formData = new FormData(form);
  const btn = document.getElementById('btnSave1_20');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Tabel1_20`, {
    method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalTabel1_20');
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 1500, showConfirmButton: false })
        .then(() => window.location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRow1_20(id, komponen) {
  Swal.fire({
    title: 'Hapus Komponen SILPA?',
    text: `Komponen "${komponen}" akan dihapus dari tabel 1.20.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);
      fetch(`${BASE_URL}Instansi/DeleteBab1Tabel1_20`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message, timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

function konfirmasiReset1_20() {
  Swal.fire({
    title: 'Reset Tabel 1.20 ke Data Resmi BKAD?',
    text: 'Tabel 1.20 akan dikembalikan persis ke data komponen SILPA resmi Kabupaten Situbondo sesuai dokumen LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292', cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data', cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('tahun', CURRENT_TAHUN);
      fetch(`${BASE_URL}Instansi/ResetBab1Tabel1_20`, {
        method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'Berhasil Direset!', text: data.message, timer: 1500, showConfirmButton: false })
            .then(() => window.location.reload());
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// ===================================================================
// CRUD TABEL GENERIC (1.17 s/d 1.20)
// ===================================================================
function openModalTambahGeneric() {
  document.getElementById('formGeneric').reset();
  document.getElementById('formGen_id').value = '0';
  document.getElementById('formGen_tabel_kode').value = CURRENT_TABEL;
  document.getElementById('formGen_tahun').value = CURRENT_TAHUN;
  document.getElementById('modalGenTitle').innerHTML = `<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data ${CURRENT_TABEL}`;
  openModal('modalGeneric');
}

function editRowGeneric(id) {
  const tr = document.getElementById('row-gen-' + id);
  if (!tr) return;

  document.getElementById('formGen_id').value = id;
  document.getElementById('formGen_tabel_kode').value = CURRENT_TABEL;
  document.getElementById('formGen_tahun').value = CURRENT_TAHUN;
  document.getElementById('formGen_nomor').value = tr.getAttribute('data-nomor') || '';

  for (let i = 1; i <= 6; i++) {
    const el = document.getElementById('formGen_kolom_' + i);
    if (el) {
      el.value = tr.getAttribute('data-c' + i) || '';
    }
  }

  document.getElementById('modalGenTitle').innerHTML = `<i class="fa fa-pencil-square-o" style="color: #00c292;"></i> Edit Data ${CURRENT_TABEL}`;
  openModal('modalGeneric');
}

function submitFormGeneric(e) {
  e.preventDefault();
  const form = document.getElementById('formGeneric');
  const formData = new FormData(form);

  const btn = document.getElementById('btnSaveGen');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(`${BASE_URL}Instansi/SaveBab1Generic`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (data.status === 'success') {
      closeModal('modalGeneric');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: data.message,
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan' });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal terhubung ke server.' });
  });
}

function deleteRowGeneric(id) {
  Swal.fire({
    title: 'Hapus Data?',
    text: 'Baris data ini akan dihapus dari tabel.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);

      fetch(`${BASE_URL}Instansi/DeleteBab1Generic`, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: data.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
        }
      });
    }
  });
}

// Export to Excel / CSV
function exportTableToExcel() {
  const table = document.getElementById('mainDataTable');
  let csv = [];
  for (let r = 0; r < table.rows.length; r++) {
    let row = [];
    for (let c = 0; c < table.rows[r].cells.length; c++) {
      const cell = table.rows[r].cells[c];
      if (cell.classList.contains('no-print')) continue;
      let text = cell.innerText.replace(/"/g, '""').trim();
      row.push(`"${text}"`);
    }
    if (row.length > 0) csv.push(row.join(';'));
  }
  const csvContent = "data:text/csv;charset=utf-8,\uFEFF" + csv.join("\n");
  const encodedUri = encodeURI(csvContent);
  const link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", `LKPJ_BAB1_Tabel_${CURRENT_TABEL}_${CURRENT_TAHUN}.csv`);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// ==============================================================
// FITUR AI GENERATE & SIMPAN NARASI TABEL (GEMINI)
// ==============================================================
function generateNarasiAI(bab, tabel) {
  const btn = document.getElementById('btnGenerateAI');
  const loader = document.getElementById('aiLoadingIndicator');
  const textarea = document.getElementById('narasiTabelAktif') || document.getElementById('narasiTabel1_1');
  
  if (!btn || !textarea) return;

  const originalBtnHtml = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> <span>Menganalisis...</span>';
  if (loader) loader.style.display = 'block';

  const formData = new FormData();
  formData.append('bab', bab);
  formData.append('tabel', tabel);
  formData.append('tahun', CURRENT_TAHUN);

  fetch(`${BASE_URL}Instansi/generate_narasi_ai`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = originalBtnHtml;
    if (loader) loader.style.display = 'none';

    if (data.status === 'success') {
      textarea.value = data.narasi;
      Swal.fire({
        icon: 'success',
        title: 'Narasi Berhasil Di-generate!',
        text: 'Analisis naratif akademik Tabel ' + tabel + ' telah dibuat oleh Gemini AI. Anda dapat meninjau, menyunting, atau menyimpannya.',
        timer: 3000,
        showConfirmButton: true,
        confirmButtonColor: '#00c292'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Generate Narasi',
        text: data.message || 'Terjadi kesalahan saat memproses permintaan ke AI.'
      });
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = originalBtnHtml;
    if (loader) loader.style.display = 'none';
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: 'Tidak dapat terhubung ke server. Silakan periksa koneksi jaringan Anda.'
    });
  });
}

function simpanNarasi(bab, tabel) {
  const btn = document.getElementById('btnSimpanNarasi');
  const textarea = document.getElementById('narasiTabelAktif') || document.getElementById('narasiTabel1_1');
  
  if (!textarea) return;
  const narasiVal = textarea.value.trim();
  if (!narasiVal) {
    Swal.fire({
      icon: 'warning',
      title: 'Narasi Kosong',
      text: 'Silakan ketikkan atau generate narasi terlebih dahulu sebelum menyimpan.'
    });
    return;
  }

  const originalBtnHtml = btn ? btn.innerHTML : '';
  if (btn) {
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';
  }

  const formData = new FormData();
  formData.append('bab', bab);
  formData.append('tabel', tabel);
  formData.append('tahun', CURRENT_TAHUN);
  formData.append('narasi', narasiVal);

  fetch(`${BASE_URL}Instansi/simpan_narasi`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(data => {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = originalBtnHtml;
    }

    if (data.status === 'success') {
      Swal.fire({
        icon: 'success',
        title: 'Tersimpan!',
        text: data.message,
        timer: 2000,
        showConfirmButton: false
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Menyimpan',
        text: data.message || 'Terjadi kesalahan saat menyimpan narasi.'
      });
    }
  })
  .catch(err => {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = originalBtnHtml;
    }
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: 'Gagal mengirim data ke server.'
    });
  });
}

function copyNarasiToClipboard() {
  const textarea = document.getElementById('narasiTabelAktif') || document.getElementById('narasiTabel1_1');
  if (!textarea || !textarea.value.trim()) {
    Swal.fire({
      icon: 'info',
      title: 'Teks Kosong',
      text: 'Belum ada narasi yang dapat disalin.'
    });
    return;
  }

  navigator.clipboard.writeText(textarea.value).then(() => {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Disalin!',
      text: 'Teks narasi telah disalin ke papan klip.',
      timer: 1500,
      showConfirmButton: false
    });
  }).catch(() => {
    textarea.select();
    document.execCommand('copy');
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Disalin!',
      text: 'Teks narasi telah disalin ke papan klip.',
      timer: 1500,
      showConfirmButton: false
    });
  });
}
</script>

