<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: BAB 3.4 Bagian B - Capaian Kinerja Indikator Kinerja Daerah (IKD)
 * Menarik data murni dari relasi tabel master IKD pada menu RPJMD (Read-Only)
 * Dilengkapi fitur Generate Narasi Analisis Tren AI (Google Gemini) dinamis per indikator
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2025;
$aspekList = isset($AspekList) ? $AspekList : [
    'dayasaing' => 'I. ASPEK DAYA SAING DAERAH',
    'geografi' => 'II. ASPEK GEOGRAFI DAN DEMOGRAFI',
    'kesejahteraan' => 'III. ASPEK KESEJAHTERAAN RAKYAT',
    'pelayanan' => 'IV. ASPEK PELAYANAN UMUM'
];
$capaianByAspek = isset($CapaianByAspek) ? $CapaianByAspek : [];
$perkembanganByAspek = isset($PerkembanganByAspek) ? $PerkembanganByAspek : [];
$aspekCounts = isset($AspekCounts) ? $AspekCounts : [];
$canCrud = !empty($CanCrud);
$namaWilayah = isset($NamaWilayah) ? $NamaWilayah : 'Kabupaten Situbondo';
$isRole4 = !empty($IsRole4);
$namaInstansi = isset($NamaInstansi) ? $NamaInstansi : '';
$activeBabPart = 'B';

$totalIndikator = array_sum($aspekCounts);

// Helper pemformat nilai numerik
function fmtIkdVal($v) {
    if ($v === null || $v === '' || $v === '-') return '-';
    $clean = trim((string)$v);
    if (strtolower($clean) === 'belum rilis' || strtolower($clean) === 'wtp') {
        return $clean;
    }
    $cleanNum = str_replace([' ', ','], ['', '.'], $clean);
    if (is_numeric($cleanNum)) {
        return number_format((float)$cleanNum, (strpos($cleanNum, '.') !== false ? 2 : 2), ',', '.');
    }
    return htmlspecialchars($clean);
}

// Helper badge capaian persentase
function renderBadgeCapaian($c) {
    if ($c === null || $c === '' || $c === '-') {
        return '<span class="badge-capaian badge-capaian-na">-</span>';
    }
    $clean = trim((string)$c);
    if (strtolower($clean) === 'belum rilis') {
        return '<span class="badge-capaian badge-capaian-na">Belum Rilis</span>';
    }
    $cleanNum = str_replace([' ', ','], ['', '.'], $clean);
    if (is_numeric($cleanNum)) {
        $num = (float)$cleanNum;
        $str = number_format($num, 2, ',', '.') . '%';
        if ($num >= 100) {
            return '<span class="badge-capaian badge-capaian-success">' . $str . '</span>';
        } elseif ($num >= 80) {
            return '<span class="badge-capaian badge-capaian-info">' . $str . '</span>';
        } elseif ($num >= 50) {
            return '<span class="badge-capaian badge-capaian-warning">' . $str . '</span>';
        } else {
            return '<span class="badge-capaian badge-capaian-danger">' . $str . '</span>';
        }
    }
    return '<span class="badge-capaian badge-capaian-na">' . htmlspecialchars($clean) . '</span>';
}
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">

<style>
:root {
  --ui-primary: #00c292;
  --ui-primary-hover: #00a87e;
  --ui-primary-light: #e8f8f5;
  --ui-primary-text: #007a5a;
  
  --ui-blue: #2563eb;
  --ui-blue-light: #eff6ff;
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
  --shadow-card: 0 4px 20px rgba(0, 0, 0, 0.05);
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
  transition: all 0.3s ease;
}
.sidebar-mini .main-content {
  margin-left: var(--sidebar-mini-width, 70px);
}

/* Page Header (Selaras BAB 1, BAB 2 & IPPD) */
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
  padding: 4px 12px;
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

/* Notika Tab Navigation di Header Diatas Tabel Data */
.notika-tab-bar {
  display: flex;
  align-items: center;
  background: #ffffff;
  border-radius: var(--radius-lg, 12px);
  border: 1px solid var(--ui-border, #e2e8f0);
  box-shadow: var(--shadow-card, 0 4px 20px rgba(0, 0, 0, 0.05));
  padding: 6px;
  gap: 8px;
  margin-bottom: 22px;
}
.notika-tab-btn {
  flex: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 12px 20px;
  border-radius: var(--radius-md, 8px);
  font-size: 13.5px;
  font-weight: 700;
  color: #475569;
  background: transparent;
  border: 1px solid transparent;
  text-decoration: none !important;
  transition: all 0.2s ease;
}
.notika-tab-btn:hover {
  background: #f1f5f9;
  color: #0f172a;
}
.notika-tab-btn.active {
  background: #00c292;
  color: #ffffff !important;
  box-shadow: 0 3px 12px rgba(0, 194, 146, 0.3);
}
.notika-tab-btn i {
  font-size: 16px;
}
.tab-label-main {
  font-weight: 800;
}
.tab-badge-sub {
  font-size: 11px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 999px;
  background: rgba(0,0,0,0.06);
}
.notika-tab-btn.active .tab-badge-sub {
  background: rgba(255,255,255,0.25);
  color: #ffffff;
}
@media (max-width: 768px) {
  .notika-tab-bar {
    flex-direction: column;
  }
  .notika-tab-btn {
    width: 100%;
    flex-direction: column;
    gap: 4px;
    text-align: center;
  }
}

/* Control Bar Card */
.control-bar-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  padding: 16px 20px;
  margin-bottom: 22px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 14px;
}
.control-left {
  display: flex;
  align-items: center;
  gap: 16px;
  flex-wrap: wrap;
}
.filter-item {
  display: flex;
  align-items: center;
  gap: 8px;
}
.filter-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-text-muted);
}
.filter-select {
  height: 38px;
  padding: 0 14px;
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-text-main);
  background: #ffffff;
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-sm);
  outline: none;
  cursor: pointer;
  transition: all 0.2s;
}
.filter-select:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.control-right {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}


/* Nav Aspect Tabs */
.aspek-tabs-nav {
  display: flex;
  gap: 8px;
  margin-bottom: 22px;
  overflow-x: auto;
  padding-bottom: 4px;
}
.aspek-tab-btn {
  padding: 10px 18px;
  background: #ffffff;
  border: 1px solid var(--ui-border);
  border-radius: 999px;
  font-size: 13px;
  font-weight: 700;
  color: var(--ui-text-muted);
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  white-space: nowrap;
}
.aspek-tab-btn:hover {
  background: var(--ui-border-light);
  color: var(--ui-text-main);
}
.aspek-tab-btn.active {
  background: var(--ui-primary);
  border-color: var(--ui-primary);
  color: #ffffff;
  box-shadow: 0 4px 14px rgba(0, 194, 146, 0.3);
}
.aspek-tab-btn .tab-count {
  background: rgba(0,0,0,0.08);
  padding: 2px 7px;
  border-radius: 999px;
  font-size: 11px;
}
.aspek-tab-btn.active .tab-count {
  background: rgba(255,255,255,0.25);
  color: #ffffff;
}

/* Content Card */
.content-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  padding: 24px;
  margin-bottom: 26px;
}
.card-header-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
  flex-wrap: wrap;
  gap: 12px;
}
.card-title-group h3 {
  font-size: 16px;
  font-weight: 700;
  color: var(--ui-dark);
  margin: 0 0 4px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.card-title-group p {
  font-size: 13px;
  color: var(--ui-text-muted);
  margin: 0;
}

/* Aspek Badge */
.aspek-badge-box {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 700;
  padding: 3px 9px;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.aspek-badge-dayasaing { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
.aspek-badge-geografi { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
.aspek-badge-kesejahteraan { background: #ffedd5; color: #c2410c; border: 1px solid #fed7aa; }
.aspek-badge-pelayanan { background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }

/* Custom Buttons */
.btn-ui {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  height: 38px;
  padding: 0 16px;
  font-size: 13px;
  font-weight: 600;
  border-radius: var(--radius-sm);
  border: 1px solid transparent;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none !important;
}
.btn-ui-primary { background: var(--ui-primary); color: #ffffff !important; }
.btn-ui-primary:hover { background: var(--ui-primary-hover); box-shadow: 0 4px 12px rgba(0, 194, 146, 0.25); }
.btn-ui-info { background: var(--ui-blue); color: #ffffff !important; }
.btn-ui-info:hover { background: #1d4ed8; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); }
.btn-ui-outline { background: #ffffff; border-color: var(--ui-border); color: var(--ui-text-main) !important; }
.btn-ui-outline:hover { background: var(--ui-bg); border-color: #cbd5e1; }
.btn-ui-sm { height: 30px; padding: 0 10px; font-size: 12px; border-radius: 4px; }

/* Table Custom */
.table-custom-wrapper {
  overflow-x: auto;
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  margin-top: 10px;
}
.table-custom {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 13px;
}
.table-custom thead th {
  background: #f8fafc;
  color: #334155;
  font-weight: 700;
  padding: 12px 14px;
  border-bottom: 2px solid var(--ui-border);
  border-right: 1px solid var(--ui-border);
  vertical-align: middle;
  text-align: center;
}
.table-custom thead th:last-child { border-right: none; }
.table-custom tbody tr {
  border-bottom: 1px solid var(--ui-border);
  transition: background 0.15s ease;
}
.table-custom tbody tr:hover { background: #f8fafc; }
.table-custom tbody td {
  padding: 10px 14px;
  border-right: 1px solid var(--ui-border);
  vertical-align: middle;
}
.table-custom tbody td:last-child { border-right: none; }

/* Numeric Columns */
.td-num {
  text-align: right;
  font-variant-numeric: tabular-nums;
  font-family: 'Roboto Mono', monospace;
  font-size: 12.5px;
  white-space: nowrap;
}
.td-center { text-align: center; }

/* Badges */
.badge-capaian {
  display: inline-block;
  padding: 3px 8px;
  font-weight: 700;
  font-size: 11.5px;
  border-radius: 6px;
  font-family: 'Roboto Mono', monospace;
}
.badge-capaian-success { background: #dcfce7; color: #166534; }
.badge-capaian-info { background: #e0f2fe; color: #075985; }
.badge-capaian-warning { background: #fef3c7; color: #92400e; }
.badge-capaian-danger { background: #fee2e2; color: #991b1b; }
.badge-capaian-na { background: #f1f5f9; color: #64748b; }

/* Notika Material Icon Action Buttons */
.notika-action-group {
  display: inline-flex !important;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.btn-notika-icon {
  width: 32px !important;
  height: 32px !important;
  min-width: 32px !important;
  max-width: 32px !important;
  padding: 0 !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  border-radius: 50% !important;
  border: none !important;
  outline: none !important;
  box-shadow: 0 2px 5px rgba(0,0,0,.16), 0 2px 10px rgba(0,0,0,.12) !important;
  cursor: pointer;
  position: relative;
  transition: all 0.2s ease !important;
}
.btn-notika-icon:hover {
  transform: translateY(-2px) scale(1.06);
  box-shadow: 0 4px 12px rgba(0,0,0,.25) !important;
}
.btn-notika-icon:active {
  transform: translateY(0);
}
.btn-notika-icon i {
  font-size: 13px !important;
  line-height: 1 !important;
  margin: 0 !important;
}
.btn-notika-icon .badge-check-icon {
  position: absolute;
  top: -3px;
  right: -3px;
  background: #00c292;
  color: #fff;
  font-size: 9px;
  font-weight: 700;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1.5px solid #fff;
  box-shadow: 0 1px 3px rgba(0,0,0,.2);
}

/* Sub-row Notika circular action buttons */
.btn-notika-subrow {
  width: 30px !important;
  height: 30px !important;
  min-width: 30px !important;
  padding: 0 !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  border-radius: 50% !important;
  border: none !important;
  outline: none !important;
  box-shadow: 0 2px 5px rgba(0,0,0,.12) !important;
  cursor: pointer;
  transition: all 0.2s ease !important;
}
.btn-notika-subrow:hover {
  transform: translateY(-1px) scale(1.05);
  box-shadow: 0 3px 8px rgba(0,0,0,.2) !important;
}
.btn-notika-subrow i {
  font-size: 12px !important;
  line-height: 1 !important;
  margin: 0 !important;
}

.btn-narasi-ready {
  background-color: #2196F3 !important;
  color: #ffffff !important;
}
.btn-narasi-ready:hover {
  background-color: #1976D2 !important;
}
.btn-narasi-done {
  background-color: #00c292 !important;
  color: #ffffff !important;
}
.btn-narasi-done:hover {
  background-color: #009688 !important;
}

/* Sub-row Narasi AI Container */
.subrow-narasi-box {
  background: #f8fafc;
  padding: 16px 20px;
  border-top: 2px dashed #cbd5e1;
  border-bottom: 2px solid #e2e8f0;
}
.subrow-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
  flex-wrap: wrap;
  gap: 8px;
}
.narasi-status-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  font-weight: 700;
  padding: 2px 8px;
  border-radius: 999px;
}
.narasi-status-saved { background: #d1fae5; color: #065f46; }
.narasi-status-empty { background: #fee2e2; color: #991b1b; }

.narasi-loader-box {
  display: none;
  padding: 12px 16px;
  background: #eff6ff;
  border: 1px dashed #3b82f6;
  border-radius: 8px;
  margin-bottom: 10px;
  text-align: center;
}
.narasi-textarea-custom {
  width: 100%;
  font-family: inherit;
  font-size: 13.5px;
  line-height: 1.65;
  color: #1e293b;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  padding: 12px 16px;
  outline: none;
  resize: vertical;
  transition: all 0.2s;
  box-shadow: 0 1px 2px rgba(0,0,0,0.03);
}
.narasi-textarea-custom:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

@media print {
  .no-print, .main-content > .page-header-box, .control-bar-card, .aspek-tabs-nav {
    display: none !important;
  }
  .main-content {
    margin-left: 0 !important;
    padding: 0 !important;
  }
  .content-card {
    box-shadow: none !important;
    border: none !important;
    padding: 0 !important;
    page-break-after: always;
  }
}
</style>

<div class="main-content">
  
  <!-- Page Header (Notika Style) -->
  <div class="page-header-box">
    
    <h1 class="page-title">BAB 3.4 CAPAIAN KINERJA DAERAH (IKU DAN IKD)</h1>
    <p class="page-subtitle">3.4 Bagian B : Pencatatan dan pemantauan capaian target kinerja serta analisis tren tahunan 4 Aspek Indikator Kinerja Daerah (IKD) Pemerintah <?= htmlspecialchars($namaWilayah) ?>.</p>
  </div>

  <?php if (!empty($isRole4) && !empty($namaInstansi)): ?>
    <div class="alert alert-info no-print" style="background: #eff6ff; border-left: 4px solid #3b82f6; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; color: #1e40af;">
      <i class="fa fa-info-circle"></i> <strong>Mode Dinas:</strong> Menampilkan Indikator Kinerja Daerah (IKD) yang diampu oleh <strong><?= htmlspecialchars($namaInstansi) ?></strong> sesuai penugasan tag pada master perencanaan daerah.
    </div>
  <?php endif; ?>

  <!-- Control Bar -->
  <div class="control-bar-card no-print">
    <div class="control-left">
      <div class="filter-item">
        <span class="filter-label"><i class="fa fa-calendar"></i> Tahun LKPJ:</span>
        <select class="filter-select" id="selectTahun" onchange="changeTahun(this.value)">
          <?php foreach ($ListTahun as $th): ?>
            <option value="<?= $th ?>" <?= ($th == $tahunAktif) ? 'selected' : '' ?>><?= $th ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="control-right">
      <button type="button" class="btn btn-sm btn-info notika-btn-info" onclick="sinkronIkdDaerah()" data-toggle="tooltip" title="Tarik indikator dari Master IKD RPJMD" style="border-radius: 4px;">
        <i class="notika-icon notika-refresh"></i> Tarik / Sinkronkan dari IKD RPJMD
      </button>
      <button type="button" class="btn btn-sm btn-success notika-btn-success" onclick="batchGenerateSemuaNarasi()" data-toggle="tooltip" title="Generate analisis narasi AI untuk semua indikator perkembangan" style="border-radius: 4px;">
        <i class="fa fa-magic"></i> Generate Semua Narasi AI (<?= $totalIndikator ?>)
      </button>
      <button type="button" class="btn btn-sm btn-default notika-btn-default" onclick="window.print()" data-toggle="tooltip" title="Cetak Dokumen" style="border-radius: 4px;">
        <i class="notika-icon notika-print"></i> Cetak Dokumen
      </button>
    </div>
  </div>

  <!-- Tab Pemilihan Bagian A & Bagian B di Header Diatas Tabel Data (Notika UI) -->
  <div class="notika-tab-bar no-print">
    <a href="<?= base_url('Instansi/BAB3_4A?tahun=' . $tahunAktif) ?>" 
       class="notika-tab-btn">
      <i class="fa fa-line-chart"></i>
      <span class="tab-label-main">3.4 Bagian A : Capaian Kinerja IKU</span>
      <span class="tab-badge-sub">Indikator Kinerja Utama</span>
    </a>
    <a href="<?= base_url('Instansi/BAB3_4B?tahun=' . $tahunAktif) ?>" 
       class="notika-tab-btn active">
      <i class="fa fa-pie-chart"></i>
      <span class="tab-label-main">3.4 Bagian B : Capaian Kinerja IKD</span>
      <span class="tab-badge-sub">Indikator Kinerja Daerah</span>
    </a>
  </div>

  <!-- Navigasi Tab Aspek -->
  <div class="aspek-tabs-nav no-print">
    <button type="button" class="aspek-tab-btn active" onclick="switchAspekTab('all', this)">
      <i class="fa fa-th-large"></i> Semua Aspek <span class="tab-count"><?= $totalIndikator ?></span>
    </button>
    <?php foreach ($aspekList as $aspKey => $aspTitle): ?>
      <?php 
        $cnt = isset($aspekCounts[$aspKey]) ? $aspekCounts[$aspKey] : 0;
        $icon = 'fa-line-chart';
        if ($aspKey === 'geografi') $icon = 'fa-globe';
        elseif ($aspKey === 'kesejahteraan') $icon = 'fa-users';
        elseif ($aspKey === 'pelayanan') $icon = 'fa-building';
      ?>
      <button type="button" class="aspek-tab-btn" onclick="switchAspekTab('<?= $aspKey ?>', this)">
        <i class="fa <?= $icon ?>"></i> <?= htmlspecialchars($aspTitle) ?> <span class="tab-count"><?= $cnt ?></span>
      </button>
    <?php endforeach; ?>
  </div>

  <!-- LOOPING 4 ASPEK IKD -->
  <?php foreach ($aspekList as $aspKey => $aspTitle): ?>
    <?php
      $capaianRows = isset($capaianByAspek[$aspKey]) ? $capaianByAspek[$aspKey] : [];
      $perkembanganRows = isset($perkembanganByAspek[$aspKey]) ? $perkembanganByAspek[$aspKey] : [];
      $badgeClass = 'aspek-badge-' . $aspKey;
      $iconAspek = 'fa-line-chart';
      if ($aspKey === 'geografi') $iconAspek = 'fa-globe';
      elseif ($aspKey === 'kesejahteraan') $iconAspek = 'fa-users';
      elseif ($aspKey === 'pelayanan') $iconAspek = 'fa-building';
    ?>

    <div class="aspek-section-container" id="section_aspek_<?= $aspKey ?>">
      
      <!-- CARD 1: TABEL CAPAIAN IKD TAHUN 2025 -->
      <div class="content-card">
        <div class="card-header-flex">
          <div class="card-title-group">
            <h3>
              <span class="aspek-badge-box <?= $badgeClass ?>"><i class="fa <?= $iconAspek ?>"></i> <?= htmlspecialchars($aspTitle) ?></span>
              Tabel Capaian Indikator Kinerja Daerah (IKD) Tahun <?= $tahunAktif ?>
            </h3>
            <p>Target, Realisasi, dan Persentase Capaian Tahun <?= $tahunAktif ?> berdasarkan data resmi Pemerintah <?= htmlspecialchars($namaWilayah) ?></p>
          </div>
          <div class="card-action-group no-print">
            <span class="badge" style="background: #f1f5f9; color: #475569; padding: 6px 12px; font-weight: 700; border-radius: 8px;">
              <?= count($capaianRows) ?> Indikator
            </span>
          </div>
        </div>

        <div class="table-custom-wrapper">
          <table class="table-custom">
            <thead>
              <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 44%; text-align: left;">Indikator Kinerja Daerah</th>
                <th style="width: 12%;">Satuan</th>
                <th style="width: 13%;">Target <small><?= $tahunAktif ?></small></th>
                <th style="width: 13%;">Realisasi <small><?= $tahunAktif ?></small></th>
                <th style="width: 14%;">Capaian (%)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($capaianRows)): ?>
                <tr>
                  <td colspan="6" class="td-center" style="padding: 25px; color: #94a3b8;">
                    <i class="fa fa-info-circle"></i> Belum ada data indikator untuk <?= htmlspecialchars($aspTitle) ?>.
                  </td>
                </tr>
              <?php else: ?>
                <?php $no = 1; foreach ($capaianRows as $cRow): ?>
                  <tr>
                    <td class="td-center" style="font-weight: 600; color: #64748b;"><?= $no++ ?></td>
                    <td style="font-weight: 600; color: #0f172a;">
                      <div><?= htmlspecialchars($cRow['indikator_ikd']) ?></div>
                      <?php if (!empty($cRow['pd_penanggung_jawab'])): ?>
                        <div style="margin-top: 4px;">
                          <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 600; font-size: 11px; padding: 2px 8px; border-radius: 4px; border: 1px solid #bae6fd;">
                            <i class="fa fa-building-o"></i> <?= htmlspecialchars($cRow['pd_penanggung_jawab']) ?>
                          </span>
                        </div>
                      <?php endif; ?>
                    </td>
                    <td class="td-center">
                      <span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 600;">
                        <?= !empty($cRow['satuan']) ? htmlspecialchars($cRow['satuan']) : '-' ?>
                      </span>
                    </td>
                    <td class="td-num"><?= fmtIkdVal($cRow['target']) ?></td>
                    <td class="td-num" style="font-weight: 700; color: #0f172a;"><?= fmtIkdVal($cRow['realisasi']) ?></td>
                    <td class="td-center"><?= renderBadgeCapaian($cRow['capaian']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- CARD 2: TABEL PERKEMBANGAN IKD (2021 - 2025) & NARASI AI -->
      <div class="content-card">
        <div class="card-header-flex">
          <div class="card-title-group">
            <h3>
              <i class="fa fa-bar-chart" style="color: #2563eb;"></i>
              Tabel Perkembangan Indikator Kinerja Daerah (2021 - 2025) - <?= htmlspecialchars($aspTitle) ?>
            </h3>
            <p>Data deret waktu 5 tahunan (2021–2025) serta analisis interpretasi tren perkembangan resmi per indikator</p>
          </div>
          <div class="card-action-group no-print" style="display: flex; gap: 8px;">
            <button type="button" class="btn btn-sm btn-info notika-btn-info" onclick="batchGenerateAspekNarasi('<?= $aspKey ?>')" data-toggle="tooltip" title="Generate narasi AI untuk seluruh indikator pada aspek ini" style="border-radius: 4px;">
              <i class="fa fa-magic"></i> Generate Narasi Aspek Ini
            </button>
          </div>
        </div>

        <div class="table-custom-wrapper">
          <table class="table-custom" id="tabel_perkembangan_<?= $aspKey ?>">
            <thead>
              <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 38%; text-align: left;">Indikator Kinerja Daerah</th>
                <th style="width: 10%;">2021</th>
                <th style="width: 10%;">2022</th>
                <th style="width: 10%;">2023</th>
                <th style="width: 10%;">2024</th>
                <th style="width: 10%;">2025</th>
                <th style="width: 10%;" class="no-print text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($perkembanganRows)): ?>
                <tr>
                  <td colspan="8" class="td-center" style="padding: 25px; color: #94a3b8;">
                    <i class="fa fa-info-circle"></i> Belum ada data perkembangan untuk aspek ini.
                  </td>
                </tr>
              <?php else: ?>
                <?php $noPerk = 1; foreach ($perkembanganRows as $pRow): ?>
                  <?php $hasNarasi = !empty(trim($pRow['narasi'] ?? '')); ?>
                  <tr id="mainRow_<?= $pRow['id'] ?>">
                    <td class="td-center" style="font-weight: 600; color: #64748b;"><?= $noPerk++ ?></td>
                    <td style="font-weight: 600; color: #0f172a;">
                      <div><?= htmlspecialchars($pRow['uraian_indikator']) ?></div>
                      <?php if (!empty($pRow['pd_penanggung_jawab'])): ?>
                        <div style="margin-top: 4px;">
                          <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 600; font-size: 11px; padding: 2px 8px; border-radius: 4px; border: 1px solid #bae6fd;">
                            <i class="fa fa-building-o"></i> <?= htmlspecialchars($pRow['pd_penanggung_jawab']) ?>
                          </span>
                        </div>
                      <?php endif; ?>
                    </td>
                    <td class="td-num"><?= fmtIkdVal($pRow['nilai_2021']) ?></td>
                    <td class="td-num"><?= fmtIkdVal($pRow['nilai_2022']) ?></td>
                    <td class="td-num"><?= fmtIkdVal($pRow['nilai_2023']) ?></td>
                    <td class="td-num"><?= fmtIkdVal($pRow['nilai_2024']) ?></td>
                    <td class="td-num" style="font-weight: 700; color: #0f172a;"><?= fmtIkdVal($pRow['nilai_2025']) ?></td>
                    <td class="td-center no-print" style="vertical-align: middle; white-space: nowrap;">
                      <div class="button-icon-btn button-icon-btn-cl notika-action-group">
                        <?php if ($canCrud): ?>
                          <button type="button" class="btn btn-sm btn-info notika-btn-info info-icon-notika btn-notika-icon" onclick='openModalEditIkd(<?= json_encode($pRow) ?>)' data-toggle="tooltip" data-placement="top" title="Edit Nilai Perkembangan (2021 - 2025)">
                            <i class="notika-icon notika-edit"></i>
                          </button>
                        <?php endif; ?>
                        <button type="button" id="btnToggleNarasi_<?= $pRow['id'] ?>" class="btn btn-sm <?= $hasNarasi ? 'btn-success notika-btn-success success-icon-notika btn-narasi-done' : 'btn-primary notika-btn-primary primary-icon-notika btn-narasi-ready' ?> btn-notika-icon" onclick="toggleNarasiRow(<?= $pRow['id'] ?>)" data-toggle="tooltip" data-placement="top" title="<?= $hasNarasi ? 'Narasi AI Tersedia (Buka/Tutup)' : 'Buat Analisis Narasi AI (Buka Panel)' ?>">
                          <i class="fa fa-magic"></i>
                          <?php if ($hasNarasi): ?>
                            <span class="badge-check-icon">✓</span>
                          <?php endif; ?>
                        </button>
                      </div>
                    </td>
                  </tr>

                  <!-- Sub-row Narasi AI Per Indikator -->
                  <tr id="narasiRow_<?= $pRow['id'] ?>" class="subrow-narasi-item" data-aspek="<?= $aspKey ?>" style="display: none;">
                    <td colspan="8" style="padding: 0; border-top: none;">
                      <div class="subrow-narasi-box">
                        <div class="subrow-header">
                          <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 700; color: #1e293b;"><i class="fa fa-newspaper-o" style="color: #2563eb;"></i> Narasi Tren: <b><?= htmlspecialchars($pRow['uraian_indikator']) ?></b></span>
                            <span id="badgeNarasiStatus_<?= $pRow['id'] ?>" class="narasi-status-badge <?= $hasNarasi ? 'narasi-status-saved' : 'narasi-status-empty' ?>">
                              <?= $hasNarasi ? '<i class="fa fa-check-circle"></i> Tersimpan di Dokumen LKPJ' : '<i class="fa fa-circle-o"></i> Belum Di-generate' ?>
                            </span>
                          </div>
                          <div class="button-icon-btn button-icon-btn-cl notika-action-group no-print">
                            <?php if ($canCrud): ?>
                              <button type="button" id="btnGenAI_<?= $pRow['id'] ?>" class="btn btn-sm btn-info notika-btn-info info-icon-notika btn-notika-subrow" onclick="generateNarasiIndikator(<?= $pRow['id'] ?>, '<?= $aspKey ?>')" data-toggle="tooltip" data-placement="top" title="Generate narasi resmi analisis tren dengan AI Google Gemini">
                                <i class="fa fa-magic"></i>
                              </button>
                              <button type="button" id="btnSaveAI_<?= $pRow['id'] ?>" class="btn btn-sm btn-success notika-btn-success success-icon-notika btn-notika-subrow" onclick="simpanNarasiIndikator(<?= $pRow['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Simpan perubahan narasi ke database">
                                <i class="fa fa-save"></i>
                              </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-default notika-btn-default btn-notika-subrow" onclick="salinTeksNarasi(<?= $pRow['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Salin teks narasi ke clipboard">
                              <i class="fa fa-copy"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger notika-btn-danger danger-icon-notika btn-notika-subrow" onclick="toggleNarasiRow(<?= $pRow['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Tutup panel narasi">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </div>

                        <!-- Loader Box -->
                        <div id="loadingAI_<?= $pRow['id'] ?>" class="narasi-loader-box">
                          <span style="color: #1d4ed8; font-weight: 600; font-size: 12.5px;">
                            <i class="fa fa-spinner fa-spin"></i> AI (Gemini) sedang menyusun analisis tren 2021 - 2025 untuk <?= htmlspecialchars($pRow['uraian_indikator']) ?>... Mohon tunggu sejenak.
                          </span>
                        </div>

                        <!-- Area Teks Narasi -->
                        <textarea id="narasiInput_<?= $pRow['id'] ?>" class="narasi-textarea-custom" rows="4" placeholder="Narasi analisis tren indikator IKD ini akan otomatis muncul di sini setelah di-generate oleh AI, atau Anda dapat menyuntingnya secara manual..." oninput="updateCharCount(<?= $pRow['id'] ?>)"><?= htmlspecialchars($pRow['narasi'] ?? '') ?></textarea>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; font-size: 11px; color: #64748b;">
                          <span><i class="fa fa-info-circle" style="color: #2563eb;"></i> Teks narasi di atas memuat uraian kuantitatif serta interpretasi kemanfaatan publik yang siap dicetak ke dokumen resmi LKPJ.</span>
                          <span id="charCount_<?= $pRow['id'] ?>"><?= mb_strlen($pRow['narasi'] ?? '') ?> karakter</span>
                        </div>
                      </div>
                    </td>
                  </tr>

                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  <?php endforeach; ?>

</div>

<!-- SWEETALERT2 & JQUERY -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const BASE_URL = '<?= base_url() ?>';
const CURRENT_KODEWILAYAH = '<?= $KodeWilayah ?>';
const CURRENT_TAHUN = <?= $tahunAktif ?>;

function changeTahun(val) {
  window.location.href = `${BASE_URL}Instansi/BAB3_4B?tahun=${encodeURIComponent(val)}`;
}

function sinkronIkdDaerah() {
  Swal.fire({
    title: 'Sinkronkan dengan IKD RPJMD?',
    text: 'Sistem akan menarik dan menyelaraskan seluruh data indikator 4 Aspek dari dokumen perencanaan RPJMD untuk wilayah ini.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Sinkronkan Sekarang',
    cancelButtonText: 'Batal'
  }).then(result => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Menyinkronkan...',
        text: 'Mengambil data dari master perencanaan IKD RPJMD',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      const fd = new FormData();
      fd.append('tahun', CURRENT_TAHUN);
      fd.append('kodewilayah', CURRENT_KODEWILAYAH);

      safeFetchJson(`${BASE_URL}Instansi/SinkronIkdDaerah`, {
        method: 'POST',
        body: fd
      })
      .then(res => {
        if (res.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Sinkronisasi Selesai',
            text: res.message
          }).then(() => location.reload());
        } else {
          Swal.fire('Peringatan', res.message, 'warning');
        }
      })
      .catch(err => {
        Swal.fire('Kesalahan', err.message || 'Gagal menyinkronkan data.', 'error');
      });
    }
  });
}

// Navigasi Tab Aspek
function switchAspekTab(aspekKey, btnEl) {
  document.querySelectorAll('.aspek-tab-btn').forEach(b => b.classList.remove('active'));
  if (btnEl) btnEl.classList.add('active');

  const allSections = document.querySelectorAll('.aspek-section-container');
  if (aspekKey === 'all') {
    allSections.forEach(s => s.style.display = 'block');
  } else {
    allSections.forEach(s => {
      if (s.id === `section_aspek_${aspekKey}`) {
        s.style.display = 'block';
      } else {
        s.style.display = 'none';
      }
    });
  }
}

// Buka / Tutup Sub-Row Narasi Indikator
function toggleNarasiRow(id) {
  const row = document.getElementById(`narasiRow_${id}`);
  if (!row) return;

  if (row.style.display === 'none' || row.style.display === '') {
    row.style.display = 'table-row';
    const textarea = document.getElementById(`narasiInput_${id}`);
    if (textarea) textarea.focus();
  } else {
    row.style.display = 'none';
  }
}

// Update Penghitung Karakter
function updateCharCount(id) {
  const textarea = document.getElementById(`narasiInput_${id}`);
  const counter = document.getElementById(`charCount_${id}`);
  if (textarea && counter) {
    counter.innerText = `${textarea.value.length} karakter`;
  }
}

// Generate Narasi AI untuk 1 Indikator
async function generateNarasiIndikator(id, aspekKey = '') {
  const btn = document.getElementById(`btnGenAI_${id}`);
  const loader = document.getElementById(`loadingAI_${id}`);
  const textarea = document.getElementById(`narasiInput_${id}`);
  const statusBadge = document.getElementById(`badgeNarasiStatus_${id}`);
  const toggleBtn = document.getElementById(`btnToggleNarasi_${id}`);

  if (!btn || !textarea) return;

  const originalBtnHtml = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
  if (loader) loader.style.display = 'block';

  try {
    const fd = new FormData();
    fd.append('id', id);
    fd.append('aspek', aspekKey);
    fd.append('kodewilayah', CURRENT_KODEWILAYAH);
    fd.append('tahun', CURRENT_TAHUN);

    const res = await safeFetchJson(`${BASE_URL}Instansi/GenerateNarasiIkdPerkembangan`, {
      method: 'POST',
      body: fd
    });

    btn.disabled = false;
    btn.innerHTML = originalBtnHtml;
    if (loader) loader.style.display = 'none';

    if (res.status === 'success') {
      textarea.value = res.narasi;
      updateCharCount(id);

      if (statusBadge) {
        statusBadge.className = 'narasi-status-badge narasi-status-saved';
        statusBadge.innerHTML = '<i class="fa fa-check-circle"></i> Tersimpan di Dokumen LKPJ';
      }
      if (toggleBtn) {
        toggleBtn.classList.remove('btn-narasi-ready', 'btn-primary', 'notika-btn-primary', 'primary-icon-notika');
        toggleBtn.classList.add('btn-narasi-done', 'btn-success', 'notika-btn-success', 'success-icon-notika');
        let checkIcon = toggleBtn.querySelector('.badge-check-icon');
        if (!checkIcon) {
          checkIcon = document.createElement('span');
          checkIcon.className = 'badge-check-icon';
          checkIcon.innerText = '✓';
          toggleBtn.appendChild(checkIcon);
        }
      }

      Swal.fire({
        icon: 'success',
        title: 'Narasi Berhasil Disusun!',
        text: 'Analisis tren 2021 - 2025 telah dibuat oleh AI (Gemini) dan otomatis tersimpan ke dokumen LKPJ.',
        timer: 2500,
        showConfirmButton: true,
        confirmButtonColor: '#2563eb'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Generate Narasi',
        text: res.message || 'Terjadi kendala saat memproses narasi AI.'
      });
    }
  } catch (err) {
    btn.disabled = false;
    btn.innerHTML = originalBtnHtml;
    if (loader) loader.style.display = 'none';
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: err.message || 'Gagal menghubungi server.'
    });
  }
}

// Simpan Narasi Indikator secara manual
async function simpanNarasiIndikator(id) {
  const btn = document.getElementById(`btnSaveAI_${id}`);
  const textarea = document.getElementById(`narasiInput_${id}`);
  const statusBadge = document.getElementById(`badgeNarasiStatus_${id}`);
  const toggleBtn = document.getElementById(`btnToggleNarasi_${id}`);

  if (!textarea) return;

  const narasi = textarea.value.trim();
  const origHtml = btn ? btn.innerHTML : '';
  if (btn) {
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
  }

  try {
    const fd = new FormData();
    fd.append('id', id);
    fd.append('narasi', narasi);
    fd.append('kodewilayah', CURRENT_KODEWILAYAH);

    const res = await safeFetchJson(`${BASE_URL}Instansi/SaveNarasiIkdPerkembangan`, {
      method: 'POST',
      body: fd
    });

    if (btn) {
      btn.disabled = false;
      btn.innerHTML = origHtml;
    }

    if (res.status === 'success') {
      if (statusBadge) {
        statusBadge.className = 'narasi-status-badge ' + (narasi.length > 0 ? 'narasi-status-saved' : 'narasi-status-empty');
        statusBadge.innerHTML = narasi.length > 0 ? '<i class="fa fa-check-circle"></i> Tersimpan di Dokumen LKPJ' : '<i class="fa fa-circle-o"></i> Belum Di-generate';
      }
      if (toggleBtn) {
        if (narasi.length > 0) {
          toggleBtn.classList.remove('btn-narasi-ready', 'btn-primary', 'notika-btn-primary', 'primary-icon-notika');
          toggleBtn.classList.add('btn-narasi-done', 'btn-success', 'notika-btn-success', 'success-icon-notika');
          let checkIcon = toggleBtn.querySelector('.badge-check-icon');
          if (!checkIcon) {
            checkIcon = document.createElement('span');
            checkIcon.className = 'badge-check-icon';
            checkIcon.innerText = '✓';
            toggleBtn.appendChild(checkIcon);
          }
        } else {
          toggleBtn.classList.remove('btn-narasi-done', 'btn-success', 'notika-btn-success', 'success-icon-notika');
          toggleBtn.classList.add('btn-narasi-ready', 'btn-primary', 'notika-btn-primary', 'primary-icon-notika');
          let checkIcon = toggleBtn.querySelector('.badge-check-icon');
          if (checkIcon) checkIcon.remove();
        }
      }

      Swal.fire({
        icon: 'success',
        title: 'Tersimpan!',
        text: 'Perubahan narasi berhasil disimpan.',
        timer: 1800,
        showConfirmButton: false
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Menyimpan',
        text: res.message || 'Terjadi kesalahan saat menyimpan.'
      });
    }
  } catch (err) {
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = origHtml;
    }
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: err.message
    });
  }
}

// Salin Teks Narasi
function salinTeksNarasi(id) {
  const textarea = document.getElementById(`narasiInput_${id}`);
  if (!textarea || !textarea.value.trim()) {
    Swal.fire({
      icon: 'info',
      title: 'Belum Ada Teks',
      text: 'Belum ada narasi yang dapat disalin untuk indikator ini.',
      timer: 1800,
      showConfirmButton: false
    });
    return;
  }

  navigator.clipboard.writeText(textarea.value).then(() => {
    Swal.fire({
      icon: 'success',
      title: 'Tersalin ke Clipboard!',
      text: 'Teks narasi berhasil disalin ke clipboard.',
      timer: 1500,
      showConfirmButton: false
    });
  }).catch(() => {
    textarea.select();
    document.execCommand('copy');
    Swal.fire({
      icon: 'success',
      title: 'Tersalin ke Clipboard!',
      text: 'Teks narasi berhasil disalin ke clipboard.',
      timer: 1500,
      showConfirmButton: false
    });
  });
}

// Batch Generate Semua Narasi AI (Global atau Per-Aspek)
async function batchGenerateSemuaNarasi() {
  executeBatchGenerate('.subrow-narasi-item', 'Seluruh 4 Aspek');
}

async function batchGenerateAspekNarasi(aspekKey) {
  executeBatchGenerate(`.subrow-narasi-item[data-aspek="${aspekKey}"]`, `Aspek ${aspekKey.toUpperCase()}`);
}

async function executeBatchGenerate(selector, scopeLabel) {
  const allSubrows = document.querySelectorAll(selector);
  if (allSubrows.length === 0) {
    Swal.fire({
      icon: 'info',
      title: 'Tidak Ada Data',
      text: 'Tidak ada data indikator yang ditemukan untuk di-generate.'
    });
    return;
  }

  const items = [];
  allSubrows.forEach(r => {
    const id = r.id.replace('narasiRow_', '');
    const asp = r.getAttribute('data-aspek') || '';
    if (id) items.push({ id, aspek: asp });
  });

  const confirmRes = await Swal.fire({
    title: `Generate Narasi AI (${scopeLabel})?`,
    text: `Sistem AI (Gemini) akan menganalisis tren data dan menyusun narasi untuk ${items.length} indikator secara berurutan.`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#2563eb',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Jalankan Sekarang',
    cancelButtonText: 'Batal'
  });

  if (!confirmRes.isConfirmed) return;

  Swal.fire({
    title: 'Sedang Memproses AI (Gemini)...',
    html: `Memproses indikator ke-<b id="batchProgressNum">1</b> dari <b>${items.length}</b>...<br><span style="font-size: 12px; color: #64748b;">Harap tunggu sejenak, proses ini berjalan otomatis.</span>`,
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });

  let successCount = 0;
  let failCount = 0;

  for (let i = 0; i < items.length; i++) {
    const item = items[i];
    const progressEl = document.getElementById('batchProgressNum');
    if (progressEl) progressEl.innerText = `${i + 1}`;

    try {
      const fd = new FormData();
      fd.append('id', item.id);
      fd.append('aspek', item.aspek);
      fd.append('kodewilayah', CURRENT_KODEWILAYAH);
      fd.append('tahun', CURRENT_TAHUN);

      const res = await safeFetchJson(`${BASE_URL}Instansi/GenerateNarasiIkdPerkembangan`, {
        method: 'POST',
        body: fd
      });

      if (res.status === 'success') {
        successCount++;
        const textarea = document.getElementById(`narasiInput_${item.id}`);
        const statusBadge = document.getElementById(`badgeNarasiStatus_${item.id}`);
        const toggleBtn = document.getElementById(`btnToggleNarasi_${item.id}`);

        if (textarea) {
          textarea.value = res.narasi;
          updateCharCount(item.id);
        }
        if (statusBadge) {
          statusBadge.className = 'narasi-status-badge narasi-status-saved';
          statusBadge.innerHTML = '<i class="fa fa-check-circle"></i> Tersimpan di Dokumen LKPJ';
        }
        if (toggleBtn) {
          toggleBtn.classList.remove('btn-narasi-ready', 'btn-primary', 'notika-btn-primary', 'primary-icon-notika');
          toggleBtn.classList.add('btn-narasi-done', 'btn-success', 'notika-btn-success', 'success-icon-notika');
          let checkIcon = toggleBtn.querySelector('.badge-check-icon');
          if (!checkIcon) {
            checkIcon = document.createElement('span');
            checkIcon.className = 'badge-check-icon';
            checkIcon.innerText = '✓';
            toggleBtn.appendChild(checkIcon);
          }
        }
      } else {
        failCount++;
      }
    } catch (e) {
      failCount++;
    }
  }

  Swal.fire({
    icon: successCount > 0 ? 'success' : 'error',
    title: 'Proses Batch AI Selesai!',
    html: `Berhasil menyusun <b>${successCount}</b> narasi indikator.<br>${failCount > 0 ? `<span style="color: #ef4444;">${failCount} indikator terkendala.</span>` : ''}`,
    confirmButtonColor: '#2563eb'
  });
}

// Safe Fetch JSON Utility
async function safeFetchJson(url, options = {}) {
  const response = await fetch(url, options);
  const text = await response.text();
  try {
    return JSON.parse(text);
  } catch (err) {
    let clean = text.trim();
    const firstBrace = clean.indexOf('{');
    const lastBrace = clean.lastIndexOf('}');
    if (firstBrace !== -1 && lastBrace !== -1 && lastBrace > firstBrace) {
      return JSON.parse(clean.substring(firstBrace, lastBrace + 1));
    }
    throw new Error('Respons server tidak valid: ' + clean.substring(0, 150));
  }
}

// Modal Edit Nilai Perkembangan IKD (2021 - 2025)
function openModalEditIkd(data) {
  if (typeof data === 'string') {
    try { data = JSON.parse(data); } catch(e) { }
  }
  document.getElementById('edit_ikd_id').value = data.id || '';
  document.getElementById('edit_ikd_uraian_display').innerText = data.uraian_indikator || '';
  const dinasDisplay = document.getElementById('edit_ikd_dinas_display');
  if (dinasDisplay) {
    if (data.pd_penanggung_jawab) {
      dinasDisplay.style.display = 'block';
      dinasDisplay.innerHTML = '<i class="fa fa-building-o"></i> Perangkat Daerah Pengampu: <b>' + data.pd_penanggung_jawab + '</b>';
    } else {
      dinasDisplay.style.display = 'none';
    }
  }
  document.getElementById('edit_ikd_n21').value = (data.nilai_2021 !== null && data.nilai_2021 !== undefined) ? data.nilai_2021 : '';
  document.getElementById('edit_ikd_n22').value = (data.nilai_2022 !== null && data.nilai_2022 !== undefined) ? data.nilai_2022 : '';
  document.getElementById('edit_ikd_n23').value = (data.nilai_2023 !== null && data.nilai_2023 !== undefined) ? data.nilai_2023 : '';
  document.getElementById('edit_ikd_n24').value = (data.nilai_2024 !== null && data.nilai_2024 !== undefined) ? data.nilai_2024 : '';
  document.getElementById('edit_ikd_n25').value = (data.nilai_2025 !== null && data.nilai_2025 !== undefined) ? data.nilai_2025 : '';
  $('#modalEditIkdPerkembangan').modal('show');
}

async function submitEditIkd() {
  const btn = document.getElementById('btnSimpanIkdNilai');
  const id = document.getElementById('edit_ikd_id').value;
  if (!id) return;

  const n21 = document.getElementById('edit_ikd_n21').value;
  const n22 = document.getElementById('edit_ikd_n22').value;
  const n23 = document.getElementById('edit_ikd_n23').value;
  const n24 = document.getElementById('edit_ikd_n24').value;
  const n25 = document.getElementById('edit_ikd_n25').value;

  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  try {
    const fd = new FormData();
    fd.append('id', id);
    fd.append('kodewilayah', '<?= htmlspecialchars($KodeWilayah) ?>');
    fd.append('tahun', '<?= $tahunAktif ?>');
    fd.append('nilai_2021', n21);
    fd.append('nilai_2022', n22);
    fd.append('nilai_2023', n23);
    fd.append('nilai_2024', n24);
    fd.append('nilai_2025', n25);

    const res = await safeFetchJson('<?= base_url("Instansi/SaveBab3IkdPerkembangan") ?>', {
      method: 'POST',
      body: fd
    });

    if (res.status === 'success') {
      $('#modalEditIkdPerkembangan').modal('hide');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Disimpan!',
        text: res.message || 'Nilai perkembangan IKD berhasil diperbarui.',
        timer: 1400,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire('Gagal', res.message || 'Terjadi kesalahan saat menyimpan.', 'error');
    }
  } catch (err) {
    Swal.fire('Kesalahan', err.message || 'Koneksi gagal.', 'error');
  } finally {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Perubahan Nilai';
  }
}
</script>

<!-- MODAL EDIT NILAI PERKEMBANGAN IKD (2021 - 2025) -->
<div class="modal fade" id="modalEditIkdPerkembangan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
    <div class="modal-content" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: none;">
      <div class="modal-header" style="background: linear-gradient(135deg, #00c292 0%, #008765 100%); color: #ffffff; border-top-left-radius: 12px; border-top-right-radius: 12px; padding: 16px 20px;">
        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff; opacity: 0.85; font-size: 24px;">&times;</button>
        <h4 class="modal-title" style="font-size: 16px; font-weight: 700; color: #ffffff; margin: 0;">
          <i class="fa fa-pencil-square-o"></i> Edit Nilai Perkembangan IKD (2021 - 2025)
        </h4>
      </div>
      <div class="modal-body" style="padding: 20px;">
        <form id="formEditIkdNilai" onsubmit="event.preventDefault(); submitEditIkd();">
          <input type="hidden" id="edit_ikd_id" name="id" value="">
          
          <div class="form-group" style="margin-bottom: 16px;">
            <label style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 4px; display: block;">
              <i class="fa fa-cube"></i> Indikator Kinerja Daerah (Master RPJMD)
            </label>
            <div id="edit_ikd_uraian_display" style="padding: 10px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; font-weight: 600; color: #0f172a; font-size: 13.5px; line-height: 1.4;">
              -
            </div>
            <div id="edit_ikd_dinas_display" style="display: none; margin-top: 6px; padding: 6px 10px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 12px; color: #1e40af;"></div>
            <small style="color: #64748b; font-size: 11px; margin-top: 4px; display: block;">
              <i class="fa fa-lock"></i> Nama indikator terhubung paten dari Master RPJMD dan tidak dapat diubah secara manual di sini.
            </small>
          </div>

          <div style="font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 8px;">
            <i class="fa fa-calendar"></i> Rincian Nilai Realisasi Tahunan (2021 - 2025):
          </div>
          
          <div class="row">
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2021</label>
              <input type="text" class="form-control" id="edit_ikd_n21" placeholder="Contoh: 70,00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2022</label>
              <input type="text" class="form-control" id="edit_ikd_n22" placeholder="Contoh: 71,00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2023</label>
              <input type="text" class="form-control" id="edit_ikd_n23" placeholder="Contoh: 71,00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2024</label>
              <input type="text" class="form-control" id="edit_ikd_n24" placeholder="Contoh: 71,00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-12" style="margin-bottom: 8px;">
              <label style="font-size: 12px; color: #007a5a; font-weight: 700;">Tahun 2025</label>
              <input type="text" class="form-control" id="edit_ikd_n25" placeholder="Contoh: 72,00" style="border-radius: 6px; font-weight: 700; border-color: #00c292;">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; padding: 12px 20px;">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
        <button type="button" class="btn btn-success" id="btnSimpanIkdNilai" onclick="submitEditIkd()" style="background: #00c292; border-color: #00c292; border-radius: 6px; font-weight: 600;">
          <i class="fa fa-save"></i> Simpan Perubahan Nilai
        </button>
      </div>
    </div>
  </div>
</div>

