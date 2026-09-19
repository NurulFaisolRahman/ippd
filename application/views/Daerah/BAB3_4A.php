<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: BAB 3.4 Bagian A - Capaian Kinerja Indikator Kinerja Utama (IKU)
 * Template Notika - Selaras dengan Desain IPPD
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2025;
$itemsCapaian = isset($ItemsCapaian) ? $ItemsCapaian : [];
$misiRowspan = isset($MisiRowspan) ? $MisiRowspan : [];
$tujuanRowspan = isset($TujuanRowspan) ? $TujuanRowspan : [];
$itemsPerkembangan = isset($ItemsPerkembangan) ? $ItemsPerkembangan : [];
$canCrud = !empty($CanCrud);
$namaWilayah = isset($NamaWilayah) ? $NamaWilayah : 'Kabupaten Situbondo';
$isRole4 = !empty($IsRole4);
$namaInstansi = isset($NamaInstansi) ? $NamaInstansi : '';
$activeBabPart = 'A';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">

<style>
:root {
  --ui-primary: #00c292;
  --ui-primary-hover: #00a87e;
  --ui-primary-light: #e8f8f5;
  --ui-primary-border: #b2dfdb;
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
.btn-ui-primary {
  background: var(--ui-primary);
  color: #ffffff !important;
}
.btn-ui-primary:hover {
  background: var(--ui-primary-hover);
  box-shadow: 0 4px 12px rgba(0, 194, 146, 0.25);
}
.btn-ui-info {
  background: var(--ui-blue);
  color: #ffffff !important;
}
.btn-ui-info:hover {
  background: #1d4ed8;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
}
.btn-ui-outline {
  background: #ffffff;
  border-color: var(--ui-border);
  color: var(--ui-text-main) !important;
}
.btn-ui-outline:hover {
  background: var(--ui-bg);
  border-color: #cbd5e1;
}
.btn-ui-danger-outline {
  background: #ffffff;
  border-color: #fca5a5;
  color: var(--ui-red) !important;
}
.btn-ui-danger-outline:hover {
  background: var(--ui-red-light);
}
.btn-ui-sm {
  height: 30px;
  padding: 0 10px;
  font-size: 12px;
  border-radius: 4px;
}

/* Main Content Card */
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

/* Custom Table Styles */
.table-custom-wrapper {
  overflow-x: auto;
  border-radius: var(--radius-md);
  border: 1px solid var(--ui-border);
  background: #ffffff;
}
.table-custom {
  width: 100%;
  margin-bottom: 0;
  border-collapse: collapse;
}
.table-custom th {
  background: #f8fafc !important;
  color: #334155 !important;
  font-weight: 700 !important;
  font-size: 12.5px;
  text-transform: uppercase;
  letter-spacing: 0.02em;
  padding: 11px 12px !important;
  border: 1px solid #cbd5e1 !important;
  vertical-align: middle !important;
  text-align: center;
}
.table-custom td {
  padding: 11px 12px !important;
  border: 1px solid #e2e8f0 !important;
  font-size: 13px;
  line-height: 1.45;
  color: #1e293b;
}
.table-custom tbody tr:hover {
  background-color: #f8fafc;
}
.table-custom tbody tr.row-subtotal {
  background-color: #f1f5f9;
  font-weight: 700;
}

/* Badge Capaian */
.badge-capaian {
  display: inline-block;
  padding: 3px 8px;
  border-radius: 6px;
  font-weight: 700;
  font-size: 12px;
  font-family: 'Roboto Mono', monospace;
}
.badge-capaian-success {
  background: #dcfce7;
  color: #15803d;
}
.badge-capaian-warning {
  background: #fef3c7;
  color: #b45309;
}
.badge-capaian-danger {
  background: #fee2e2;
  color: #b91c1c;
}

.num-cell {
  font-family: 'Roboto Mono', monospace;
  font-size: 13px;
}

/* Modal Styling */
.modal-overlay {
  display: none;
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(4px);
  z-index: 9999;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.modal-overlay.active { display: flex; }
.modal-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-modal);
  width: 100%;
  max-width: 650px;
  max-height: 90vh;
  overflow-y: auto;
  animation: modalIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes modalIn {
  from { opacity: 0; transform: translateY(20px) scale(0.96); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}
.modal-card-header {
  padding: 18px 24px;
  border-bottom: 1px solid var(--ui-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.modal-card-header h4 {
  margin: 0;
  font-size: 16px;
  font-weight: 700;
  color: var(--ui-dark);
}
.modal-close-btn {
  background: none;
  border: none;
  font-size: 22px;
  color: var(--ui-text-muted);
  cursor: pointer;
}
.modal-close-btn:hover { color: var(--ui-red); }
.modal-card-body {
  padding: 24px;
}
.modal-card-footer {
  padding: 16px 24px;
  background: #f8fafc;
  border-top: 1px solid var(--ui-border);
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 10px;
}

.form-group-ui {
  margin-bottom: 16px;
}
.form-group-ui label {
  display: block;
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-text-main);
  margin-bottom: 6px;
}
.form-control-ui {
  width: 100%;
  height: 38px;
  padding: 0 12px;
  font-size: 13px;
  color: var(--ui-text-main);
  background: #ffffff;
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-sm);
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control-ui:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
textarea.form-control-ui {
  height: auto;
  padding: 10px 12px;
}

.grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.grid-3 {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 12px;
}

@media print {
  .no-print, .sidebar, .header-top-area, .control-bar-card, .btn-ui {
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
  }
  table th, table td {
    border: 1px solid #000 !important;
    color: #000 !important;
  }
}

/* AI Narasi Perkembangan & Notika Icon UI Action Buttons */
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
.narasi-preview-badge {
  font-size: 11px;
  color: #0284c7;
  margin-top: 4px;
  font-weight: 500;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 2px 6px;
  background: #f0f9ff;
  border-radius: 4px;
  border: 1px solid #bae6fd;
}
.narasi-preview-badge:hover {
  background: #e0f2fe;
  color: #0369a1;
}
.narasi-subrow td {
  background: #f8fafc !important;
  border-bottom: 2px solid #cbd5e1 !important;
  padding: 0 !important;
}
.narasi-box-container {
  padding: 16px 20px;
  background: #ffffff;
  margin: 10px 14px 16px;
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  border-left: 4px solid #2563eb;
  box-shadow: 0 3px 12px rgba(15, 23, 42, 0.05);
}
.narasi-box-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  flex-wrap: wrap;
  gap: 10px;
}
.narasi-box-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13.5px;
  font-weight: 700;
  color: #1e293b;
  flex-wrap: wrap;
}
.narasi-status-badge {
  font-size: 11px;
  font-weight: 600;
  padding: 3px 10px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.narasi-status-saved {
  background: #dcfce7;
  color: #15803d;
  border: 1px solid #bbf7d0;
}
.narasi-status-empty {
  background: #f1f5f9;
  color: #64748b;
  border: 1px solid #e2e8f0;
}
.narasi-textarea-custom {
  width: 100%;
  resize: vertical;
  min-height: 110px;
  font-size: 13px;
  line-height: 1.65;
  color: #1e293b;
  background: #fdfefe;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  padding: 12px 14px;
  font-family: inherit;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
  transition: border-color 0.2s, box-shadow 0.2s;
}
.narasi-textarea-custom:focus {
  border-color: #2563eb;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
  outline: none;
}
.narasi-loader-box {
  display: none;
  padding: 12px 16px;
  background: #eff6ff;
  border: 1px dashed #3b82f6;
  border-radius: 8px;
  margin-bottom: 12px;
  text-align: center;
}
@media print {
  .narasi-subrow {
    display: table-row !important;
  }
  .narasi-box-container {
    border: none !important;
    box-shadow: none !important;
    margin: 4px 0 !important;
    padding: 6px 0 !important;
  }
  .narasi-textarea-custom {
    border: none !important;
    background: transparent !important;
    padding: 0 !important;
    box-shadow: none !important;
    resize: none !important;
  }
}
</style>

<div class="main-content">
  <!-- Page Header (Selaras BAB 1, BAB 2 & IPPD) -->
  <!-- Page Header (Notika Style) -->
  <div class="page-header-box">
    
    <h1 class="page-title">BAB 3.4 CAPAIAN KINERJA DAERAH (IKU DAN IKD)</h1>
    <p class="page-subtitle"> Pencatatan dan pemantauan capaian target kinerja serta analisis tren tahunan Indikator Kinerja Utama (IKU) Pemerintah <?= htmlspecialchars($namaWilayah) ?>.</p>
  </div>

  <!-- Control Bar -->
  <div class="control-bar-card no-print">
    <div class="control-left">
      <div class="filter-item">
        <span class="filter-label"><i class="fa fa-calendar"></i> Tahun LKPJ:</span>
        <select class="filter-select" id="selectTahun" onchange="changeTahun(this.value)">
          <?php foreach ($ListTahun as $th): ?>
            <option value="<?= $th ?>" <?= ($th == $TahunAktif) ? 'selected' : '' ?>><?= $th ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="control-right">
      <?php if ($canCrud): ?>
        <button type="button" class="btn btn-sm btn-info notika-btn-info" onclick="sinkronIkuDaerah()" data-toggle="tooltip" title="Tarik indikator dari Master IKU RPJMD" style="border-radius: 4px;">
          <i class="notika-icon notika-refresh"></i> Tarik / Sinkronkan dari IKU RPJMD
        </button>
        <button type="button" class="btn btn-sm btn-danger notika-btn-danger" onclick="resetDefaultData()" data-toggle="tooltip" title="Reset ulang data sesuai IKU RPJMD" style="border-radius: 4px;">
          <i class="notika-icon notika-trash"></i> Reset Data RPJMD
        </button>
      <?php endif; ?>
      <button type="button" class="btn btn-sm btn-default notika-btn-default" onclick="window.print()" data-toggle="tooltip" title="Cetak Dokumen" style="border-radius: 4px;">
        <i class="notika-icon notika-print"></i> Cetak Dokumen
      </button>
    </div>
  </div>

  <!-- Tab Pemilihan Bagian A & Bagian B di Header Diatas Tabel Data (Notika UI) -->
  <div class="notika-tab-bar no-print">
    <a href="<?= base_url('Instansi/BAB3_4A?tahun=' . $tahunAktif) ?>" 
       class="notika-tab-btn active">
      <i class="fa fa-line-chart"></i>
      <span class="tab-label-main">3.4 Bagian A : Capaian Kinerja IKU</span>
      <span class="tab-badge-sub">Indikator Kinerja Utama</span>
    </a>
    <a href="<?= base_url('Instansi/BAB3_4B?tahun=' . $tahunAktif) ?>" 
       class="notika-tab-btn">
      <i class="fa fa-pie-chart"></i>
      <span class="tab-label-main">3.4 Bagian B : Capaian Kinerja IKD</span>
      <span class="tab-badge-sub">Indikator Kinerja Daerah</span>
    </a>
  </div>

  <!-- ================================================================ -->
  <!-- TABEL 1: CAPAIAN KINERJA INDIKATOR KINERJA UTAMA (IKU)           -->
  <!-- ================================================================ -->
  <div class="content-card">
    <div class="card-header-flex">
      <div class="card-title-group">
        <h3><i class="fa fa-line-chart" style="color: #00c292;"></i> Tabel Capaian Kinerja Indikator Kinerja Utama (IKU)</h3>
        <p>Data bersumber otomatis dari relasi Menu IKU Daerah, Misi, dan Tujuan RPJMD Pemerintah <?= htmlspecialchars($NamaWilayah) ?></p>
      </div>
    </div>

    <div class="table-custom-wrapper">
      <table class="table-custom" id="tabelCapaianIKU">
        <thead>
          <tr>
            <th rowspan="2" style="width: 21%; min-width: 180px;">Misi</th>
            <th rowspan="2" style="width: 21%; min-width: 170px;">Tujuan</th>
            <th rowspan="2" style="width: 21%; min-width: 170px;">IKU</th>
            <th rowspan="2" style="width: 7%; min-width: 70px;">Satuan</th>
            <th colspan="3" style="width: 15%;">Realisasi</th>
            <th colspan="3" style="width: 15%;">Tahun <?= $TahunAktif ?></th>
          </tr>
          <tr>
            <th style="width: 5%; min-width: 60px;"><?= $TahunAktif - 3 ?></th>
            <th style="width: 5%; min-width: 60px;"><?= $TahunAktif - 2 ?></th>
            <th style="width: 5%; min-width: 60px;"><?= $TahunAktif - 1 ?></th>
            <th style="width: 5%; min-width: 60px;">Target</th>
            <th style="width: 5%; min-width: 60px;">Realisasi</th>
            <th style="width: 5%; min-width: 60px;">Capaian</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($ItemsCapaian)): ?>
            <tr>
              <td colspan="10" class="text-center" style="padding: 30px !important; color: #94a3b8;">
                <i class="fa fa-folder-open-o" style="font-size: 32px; display: block; margin-bottom: 8px;"></i>
                Belum ada data Capaian IKU yang terhubung pada RPJMD Pemerintah <?= htmlspecialchars($NamaWilayah) ?> pada tahun <?= $TahunAktif ?>.
              </td>
            </tr>
          <?php else: ?>
            <?php
            $renderedMisi = [];
            $renderedTujuan = [];
            foreach ($ItemsCapaian as $it):
                $mKey = trim($it['misi']);
                $tKey = $mKey . '|||' . trim($it['tujuan']);
                $showMisi = !isset($renderedMisi[$mKey]);
                $showTujuan = !isset($renderedTujuan[$tKey]);
                if ($showMisi) $renderedMisi[$mKey] = true;
                if ($showTujuan) $renderedTujuan[$tKey] = true;

                $capaianVal = ($it['capaian_th_aktif'] ?? $it['capaian_2025'] ?? null);
                if ($capaianVal !== null && $capaianVal !== '') {
                    $capaianVal = (float)$capaianVal;
                } else {
                    $capaianVal = null;
                }
                $badgeClass = 'badge-capaian-success';
                if ($capaianVal !== null) {
                    if ($capaianVal < 90) $badgeClass = 'badge-capaian-danger';
                    elseif ($capaianVal < 100) $badgeClass = 'badge-capaian-warning';
                }
            ?>
              <tr>
                <?php if ($showMisi): ?>
                  <td rowspan="<?= $MisiRowspan[$mKey] ?? 1 ?>" style="vertical-align: middle; font-weight: 600; background: #ffffff;">
                    <?= htmlspecialchars($it['misi']) ?>
                  </td>
                <?php endif; ?>

                <?php if ($showTujuan): ?>
                  <td rowspan="<?= $TujuanRowspan[$tKey] ?? 1 ?>" style="vertical-align: middle; background: #ffffff;">
                    <?= htmlspecialchars($it['tujuan']) ?>
                  </td>
                <?php endif; ?>

                <td style="vertical-align: middle; font-weight: 500;">
                  <?= htmlspecialchars($it['indikator_iku']) ?>
                </td>
                <td class="text-center" style="vertical-align: middle;">
                  <?= htmlspecialchars($it['satuan'] ?: 'Indeks') ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;">
                  <?= ($it['val_th_min3'] !== null && $it['val_th_min3'] !== '') ? number_format((float)$it['val_th_min3'], 2, ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;">
                  <?= ($it['val_th_min2'] !== null && $it['val_th_min2'] !== '') ? number_format((float)$it['val_th_min2'], 2, ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;">
                  <?= ($it['val_th_min1'] !== null && $it['val_th_min1'] !== '') ? number_format((float)$it['val_th_min1'], 2, ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle; font-weight: 600;">
                  <?= ($it['target_th_aktif'] !== null && $it['target_th_aktif'] !== '') ? number_format((float)$it['target_th_aktif'], 2, ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle; font-weight: 600;">
                  <?= ($it['realisasi_th_aktif'] !== null && $it['realisasi_th_aktif'] !== '') ? number_format((float)$it['realisasi_th_aktif'], 2, ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;">
                  <?php if ($capaianVal !== null): ?>
                    <span class="badge-capaian <?= $badgeClass ?>"><?= number_format($capaianVal, 2, ',', '.') ?>%</span>
                  <?php else: ?>
                    -
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ================================================================ -->
  <!-- TABEL 2: PERKEMBANGAN IKU 2021 - 2025 (RELASI IKU RPJMD)         -->
  <!-- ================================================================ -->
  <div class="content-card">
    <div class="card-header-flex">
      <div class="card-title-group">
        <h3><i class="fa fa-bar-chart" style="color: #2563eb;"></i> Tabel Perkembangan Indikator Kinerja Utama (2021 - 2025)</h3>
        <p>Data perkembangan tahunan bersumber otomatis dari relasi Indikator Kinerja Utama (IKU) pada RPJMD Pemerintah <?= htmlspecialchars($NamaWilayah) ?></p>
      </div>
      <div class="card-action-group no-print" style="display: flex; gap: 8px; flex-wrap: wrap;">
        <button type="button" class="btn btn-sm btn-info notika-btn-info" onclick="batchGenerateSemuaNarasi()" data-toggle="tooltip" title="Generate otomatis narasi tren AI (Gemini) untuk seluruh indikator" style="border-radius: 4px;">
          <i class="fa fa-magic"></i> Generate Semua Narasi AI
        </button>
      </div>
    </div>

    <div class="table-custom-wrapper">
      <table class="table-custom" id="tabelPerkembanganIKU">
        <thead>
          <tr>
            <th style="width: 4%;" class="text-center">No</th>
            <th style="width: 40%;">Indikator / Uraian Perkembangan</th>
            <th style="width: 8%;" class="text-center">2021</th>
            <th style="width: 8%;" class="text-center">2022</th>
            <th style="width: 8%;" class="text-center">2023</th>
            <th style="width: 8%;" class="text-center">2024</th>
            <th style="width: 8%;" class="text-center">2025</th>
            <th style="width: 16%; min-width: 140px;" class="text-center no-print">Aksi & Narasi AI</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($ItemsPerkembangan)): ?>
            <tr>
              <td colspan="8" class="text-center" style="padding: 30px !important; color: #94a3b8;">
                <i class="fa fa-folder-open-o" style="font-size: 32px; display: block; margin-bottom: 8px;"></i>
                Belum ada data Perkembangan IKU yang terhubung pada RPJMD Pemerintah <?= htmlspecialchars($NamaWilayah) ?>.
              </td>
            </tr>
          <?php else: ?>
            <?php $no = 1; foreach ($ItemsPerkembangan as $p): ?>
              <tr>
                <td class="text-center" style="vertical-align: middle; color: #64748b;"><?= $no++ ?></td>
                <td style="vertical-align: middle; font-weight: 600; color: #1e293b;">
                  <div><?= htmlspecialchars($p['uraian_indikator']) ?></div>
                  <?php if (!empty($p['narasi'])): ?>
                    <div>
                      <span class="narasi-preview-badge" onclick="toggleNarasiRow(<?= $p['id'] ?>)" title="Klik untuk membuka/membaca narasi resmi LKPJ">
                        <i class="fa fa-file-text-o"></i> Narasi LKPJ tersedia
                      </span>
                    </div>
                  <?php endif; ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;" id="cell_p21_<?= $p['id'] ?>">
                  <?= ($p['nilai_2021'] !== null) ? number_format((float)$p['nilai_2021'], (strpos((string)$p['nilai_2021'], '.') !== false ? 2 : 2), ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;" id="cell_p22_<?= $p['id'] ?>">
                  <?= ($p['nilai_2022'] !== null) ? number_format((float)$p['nilai_2022'], (strpos((string)$p['nilai_2022'], '.') !== false ? 2 : 2), ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;" id="cell_p23_<?= $p['id'] ?>">
                  <?= ($p['nilai_2023'] !== null) ? number_format((float)$p['nilai_2023'], (strpos((string)$p['nilai_2023'], '.') !== false ? 2 : 2), ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle;" id="cell_p24_<?= $p['id'] ?>">
                  <?= ($p['nilai_2024'] !== null) ? number_format((float)$p['nilai_2024'], (strpos((string)$p['nilai_2024'], '.') !== false ? 2 : 2), ',', '.') : '-' ?>
                </td>
                <td class="text-right num-cell" style="vertical-align: middle; font-weight: 700; color: #0f172a;" id="cell_p25_<?= $p['id'] ?>">
                  <?= ($p['nilai_2025'] !== null) ? number_format((float)$p['nilai_2025'], (strpos((string)$p['nilai_2025'], '.') !== false ? 2 : 2), ',', '.') : '-' ?>
                </td>
                <td class="text-center no-print" style="vertical-align: middle; white-space: nowrap;">
                  <div class="button-icon-btn button-icon-btn-cl notika-action-group">
                    <?php if ($CanCrud): ?>
                      <button type="button" class="btn btn-sm btn-info notika-btn-info info-icon-notika btn-notika-icon" onclick='openModalEditIku(<?= json_encode($p) ?>)' data-toggle="tooltip" data-placement="top" title="Edit Nilai Perkembangan (2021 - 2025)">
                        <i class="notika-icon notika-edit"></i>
                      </button>
                    <?php endif; ?>
                    <button type="button" id="btnToggleNarasi_<?= $p['id'] ?>" class="btn btn-sm <?= !empty($p['narasi']) ? 'btn-success notika-btn-success success-icon-notika btn-narasi-done' : 'btn-primary notika-btn-primary primary-icon-notika btn-narasi-ready' ?> btn-notika-icon" onclick="toggleNarasiRow(<?= $p['id'] ?>)" data-toggle="tooltip" data-placement="top" title="<?= !empty($p['narasi']) ? 'Narasi AI Tersedia (Buka/Tutup)' : 'Buat Analisis Narasi AI (Buka Panel)' ?>">
                      <i class="fa fa-magic"></i>
                      <?php if (!empty($p['narasi'])): ?>
                        <span class="badge-check-icon">✓</span>
                      <?php endif; ?>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Sub-Row Collapsible Narasi AI per Indikator -->
              <tr id="narasiRow_<?= $p['id'] ?>" class="narasi-subrow" style="display: none;">
                <td colspan="8">
                  <div class="narasi-box-container">
                    <div class="narasi-box-header">
                      <div class="narasi-box-title">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 6px; background: #eff6ff; color: #2563eb; font-size: 13px;">
                          <i class="fa fa-magic"></i>
                        </span>
                        <span>Analisis &amp; Narasi Tren: <b><?= htmlspecialchars($p['uraian_indikator']) ?></b></span>
                        <span id="badgeNarasiStatus_<?= $p['id'] ?>" class="narasi-status-badge <?= !empty($p['narasi']) ? 'narasi-status-saved' : 'narasi-status-empty' ?>">
                          <?= !empty($p['narasi']) ? '<i class="fa fa-check-circle"></i> Tersimpan di Dokumen LKPJ' : '<i class="fa fa-circle-o"></i> Belum Di-generate' ?>
                        </span>
                      </div>
                      <div class="button-icon-btn button-icon-btn-cl notika-action-group no-print">
                        <?php if ($CanCrud): ?>
                          <button type="button" id="btnGenAI_<?= $p['id'] ?>" class="btn btn-sm btn-info notika-btn-info info-icon-notika btn-notika-subrow" onclick="generateNarasiIndikator(<?= $p['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Generate narasi otomatis menggunakan Gemini AI">
                            <i class="fa fa-magic"></i>
                          </button>
                          <button type="button" id="btnSaveAI_<?= $p['id'] ?>" class="btn btn-sm btn-success notika-btn-success success-icon-notika btn-notika-subrow" onclick="simpanNarasiIndikator(<?= $p['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Simpan perubahan narasi ke database">
                            <i class="fa fa-save"></i>
                          </button>
                        <?php endif; ?>
                        <button type="button" class="btn btn-sm btn-default notika-btn-default btn-notika-subrow" onclick="salinTeksNarasi(<?= $p['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Salin teks narasi ke clipboard">
                          <i class="fa fa-copy"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger notika-btn-danger danger-icon-notika btn-notika-subrow" onclick="toggleNarasiRow(<?= $p['id'] ?>)" data-toggle="tooltip" data-placement="top" title="Tutup panel narasi">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </div>

                    <!-- Indikator Loading AI -->
                    <div id="loadingAI_<?= $p['id'] ?>" class="narasi-loader-box">
                      <span style="color: #1d4ed8; font-weight: 600; font-size: 12.5px;">
                        <i class="fa fa-spinner fa-spin"></i> AI (Gemini) sedang menyusun analisis tren 2021 - 2025 untuk <?= htmlspecialchars($p['uraian_indikator']) ?>... Mohon tunggu sejenak.
                      </span>
                    </div>

                    <!-- Area Teks Narasi -->
                    <textarea id="narasiInput_<?= $p['id'] ?>" class="narasi-textarea-custom" rows="4" placeholder="Narasi analisis tren indikator ini akan muncul di sini setelah di-generate oleh AI, atau Anda dapat menyusunnya secara manual..." oninput="updateCharCount(<?= $p['id'] ?>)" <?= !$CanCrud ? 'readonly' : '' ?>><?= htmlspecialchars($p['narasi'] ?? '') ?></textarea>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px; font-size: 11px; color: #64748b;">
                      <span><i class="fa fa-info-circle" style="color: #2563eb;"></i> Teks narasi di atas adalah analisis resmi LKPJ per indikator yang dapat diedit, disimpan, dan dicetak.</span>
                      <span id="charCount_<?= $p['id'] ?>"><?= mb_strlen($p['narasi'] ?? '') ?> karakter</span>
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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const BASE_URL = '<?= base_url() ?>';
const CURRENT_TAHUN = '<?= $TahunAktif ?>';
const CURRENT_KODEWILAYAH = '<?= $KodeWilayah ?>';

// Safe fetch wrapper ensuring XMLHttpRequest header and meaningful error decoding
async function safeFetchJson(url, options = {}) {
  const defaultHeaders = {
    'X-Requested-With': 'XMLHttpRequest'
  };
  options.headers = Object.assign({}, defaultHeaders, options.headers || {});

  try {
    const response = await fetch(url, options);
    const text = await response.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (parseErr) {
      console.error('Non-JSON response received:', text);
      const cleanMsg = text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
      throw new Error(cleanMsg ? cleanMsg.substring(0, 200) : `Status respons server: ${response.status}`);
    }
    return data;
  } catch (netErr) {
    throw netErr;
  }
}

function changeTahun(val) {
  window.location.href = `${BASE_URL}Instansi/BAB3_4A?tahun=${val}`;
}

// -------------------------------------------------------------
// SINKRONISASI DATA RPJMD
// -------------------------------------------------------------
function sinkronIkuDaerah() {
  Swal.fire({
    title: 'Sinkronkan dengan IKU RPJMD?',
    text: 'Sistem akan menarik dan menyelaraskan indikator Misi, Tujuan, dan IKU dari dokumen perencanaan RPJMD untuk wilayah ini.',
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
        text: 'Mengambil data dari master perencanaan IKU RPJMD',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });

      const fd = new FormData();
      fd.append('tahun', CURRENT_TAHUN);
      fd.append('kodewilayah', CURRENT_KODEWILAYAH);

      safeFetchJson(`${BASE_URL}Instansi/SinkronIkuDaerah`, {
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
      .catch(err => Swal.fire('Error', 'Gagal menyinkronkan: ' + err.message, 'error'));
    }
  });
}

function resetDefaultData() {
  Swal.fire({
    title: 'Reset ke Data IKU RPJMD?',
    text: 'Data tabel Capaian IKU dan Perkembangan IKU akan disinkronkan kembali sesuai data resmi master IKU RPJMD wilayah ini.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset Data',
    cancelButtonText: 'Batal'
  }).then(result => {
    if (result.isConfirmed) {
      const fd = new FormData();
      fd.append('tahun', CURRENT_TAHUN);
      fd.append('kodewilayah', CURRENT_KODEWILAYAH);

      safeFetchJson(`${BASE_URL}Instansi/ResetBab3_4A`, {
        method: 'POST',
        body: fd
      })
      .then(res => {
        if (res.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Reset Selesai',
            text: res.message
          }).then(() => location.reload());
        } else {
          Swal.fire('Gagal', res.message, 'error');
        }
      })
      .catch(err => Swal.fire('Error', 'Gagal mereset: ' + err.message, 'error'));
    }
  });
}

// ==============================================================
// FITUR AI NARASI PER INDIKATOR PERKEMBANGAN (GEMINI)
// ==============================================================

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

// Generate Narasi Analisis Tren dengan Gemini AI
async function generateNarasiIndikator(id) {
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
    fd.append('kodewilayah', CURRENT_KODEWILAYAH);
    fd.append('tahun', CURRENT_TAHUN);

    const res = await safeFetchJson(`${BASE_URL}Instansi/GenerateNarasiIkuPerkembangan`, {
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
    Swal.fire('Error', 'Kesalahan koneksi ke server: ' + err.message, 'error');
  }
}

// Simpan Narasi Indikator secara Manual
async function simpanNarasiIndikator(id) {
  const btn = document.getElementById(`btnSaveAI_${id}`);
  const textarea = document.getElementById(`narasiInput_${id}`);
  const statusBadge = document.getElementById(`badgeNarasiStatus_${id}`);
  const toggleBtn = document.getElementById(`btnToggleNarasi_${id}`);

  if (!btn || !textarea) return;

  const originalBtnHtml = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';

  try {
    const fd = new FormData();
    fd.append('id', id);
    fd.append('kodewilayah', CURRENT_KODEWILAYAH);
    fd.append('narasi', textarea.value);

    const res = await safeFetchJson(`${BASE_URL}Instansi/SaveNarasiIkuPerkembangan`, {
      method: 'POST',
      body: fd
    });

    btn.disabled = false;
    btn.innerHTML = originalBtnHtml;

    if (res.status === 'success') {
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
        title: 'Tersimpan',
        text: res.message,
        timer: 1600,
        showConfirmButton: false
      });
    } else {
      Swal.fire('Gagal', res.message, 'error');
    }
  } catch (err) {
    btn.disabled = false;
    btn.innerHTML = originalBtnHtml;
    Swal.fire('Error', 'Gagal menyimpan: ' + err.message, 'error');
  }
}

// Salin Teks Narasi
function salinTeksNarasi(id) {
  const textarea = document.getElementById(`narasiInput_${id}`);
  if (!textarea || !textarea.value.trim()) {
    Swal.fire('Perhatian', 'Belum ada teks narasi untuk disalin. Klik tombol "Generate AI" terlebih dahulu.', 'warning');
    return;
  }

  navigator.clipboard.writeText(textarea.value).then(() => {
    Swal.fire({
      icon: 'success',
      title: 'Tersalin',
      text: 'Teks narasi indikator berhasil disalin ke clipboard.',
      timer: 1500,
      showConfirmButton: false
    });
  }).catch(() => {
    textarea.select();
    document.execCommand('copy');
    Swal.fire({
      icon: 'success',
      title: 'Tersalin',
      text: 'Teks narasi berhasil disalin.',
      timer: 1500,
      showConfirmButton: false
    });
  });
}

// Update hitungan karakter
function updateCharCount(id) {
  const textarea = document.getElementById(`narasiInput_${id}`);
  const counter = document.getElementById(`charCount_${id}`);
  if (textarea && counter) {
    counter.innerText = `${textarea.value.length} karakter`;
  }
}

// Batch Generate Semua Narasi Indikator Perkembangan
async function batchGenerateSemuaNarasi() {
  const allSubrows = document.querySelectorAll('.narasi-subrow');
  if (allSubrows.length === 0) {
    Swal.fire('Perhatian', 'Belum ada data indikator perkembangan untuk diproses.', 'warning');
    return;
  }

  const ids = [];
  allSubrows.forEach(r => {
    const id = r.id.replace('narasiRow_', '');
    if (id) ids.push(id);
  });

  const confirmRes = await Swal.fire({
    title: 'Generate Semua Narasi AI?',
    text: `Sistem AI (Gemini) akan menganalisis tren data dan menyusun narasi untuk ${ids.length} indikator perkembangan secara berurutan.`,
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
    html: `Memproses indikator ke-<b id="batchProgressNum">1</b> dari <b>${ids.length}</b>...<br><span style="font-size: 12px; color: #64748b;">Harap tunggu sejenak, proses ini berjalan otomatis.</span>`,
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });

  let successCount = 0;
  let failCount = 0;

  for (let i = 0; i < ids.length; i++) {
    const id = ids[i];
    const progressEl = document.getElementById('batchProgressNum');
    if (progressEl) progressEl.innerText = `${i + 1}`;

    try {
      const fd = new FormData();
      fd.append('id', id);
      fd.append('kodewilayah', CURRENT_KODEWILAYAH);
      fd.append('tahun', CURRENT_TAHUN);

      const res = await safeFetchJson(`${BASE_URL}Instansi/GenerateNarasiIkuPerkembangan`, {
        method: 'POST',
        body: fd
      });

      if (res.status === 'success') {
        successCount++;
        const textarea = document.getElementById(`narasiInput_${id}`);
        const statusBadge = document.getElementById(`badgeNarasiStatus_${id}`);
        const toggleBtn = document.getElementById(`btnToggleNarasi_${id}`);

        if (textarea) {
          textarea.value = res.narasi;
          updateCharCount(id);
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
    icon: 'success',
    title: 'Batch Generate Selesai!',
    text: `Berhasil menyusun narasi untuk ${successCount} indikator perkembangan.${failCount > 0 ? ' (' + failCount + ' gagal)' : ''}`,
    confirmButtonColor: '#2563eb'
  });
}

// Modal Edit Nilai Perkembangan IKU (2021 - 2025)
function openModalEditIku(data) {
  if (typeof data === 'string') {
    try { data = JSON.parse(data); } catch(e) { }
  }
  document.getElementById('edit_iku_id').value = data.id || '';
  document.getElementById('edit_iku_uraian_display').innerText = data.uraian_indikator || '';
  document.getElementById('edit_iku_n21').value = (data.nilai_2021 !== null && data.nilai_2021 !== undefined) ? data.nilai_2021 : '';
  document.getElementById('edit_iku_n22').value = (data.nilai_2022 !== null && data.nilai_2022 !== undefined) ? data.nilai_2022 : '';
  document.getElementById('edit_iku_n23').value = (data.nilai_2023 !== null && data.nilai_2023 !== undefined) ? data.nilai_2023 : '';
  document.getElementById('edit_iku_n24').value = (data.nilai_2024 !== null && data.nilai_2024 !== undefined) ? data.nilai_2024 : '';
  document.getElementById('edit_iku_n25').value = (data.nilai_2025 !== null && data.nilai_2025 !== undefined) ? data.nilai_2025 : '';
  $('#modalEditIkuPerkembangan').modal('show');
}

async function submitEditIku() {
  const btn = document.getElementById('btnSimpanIkuNilai');
  const id = document.getElementById('edit_iku_id').value;
  if (!id) return;

  const n21 = document.getElementById('edit_iku_n21').value;
  const n22 = document.getElementById('edit_iku_n22').value;
  const n23 = document.getElementById('edit_iku_n23').value;
  const n24 = document.getElementById('edit_iku_n24').value;
  const n25 = document.getElementById('edit_iku_n25').value;

  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  try {
    const fd = new FormData();
    fd.append('id', id);
    fd.append('kodewilayah', CURRENT_KODEWILAYAH);
    fd.append('tahun', CURRENT_TAHUN);
    fd.append('nilai_2021', n21);
    fd.append('nilai_2022', n22);
    fd.append('nilai_2023', n23);
    fd.append('nilai_2024', n24);
    fd.append('nilai_2025', n25);

    const res = await safeFetchJson(`${BASE_URL}Instansi/SaveBab3IkuPerkembangan`, {
      method: 'POST',
      body: fd
    });

    if (res.status === 'success') {
      $('#modalEditIkuPerkembangan').modal('hide');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Disimpan!',
        text: res.message || 'Nilai perkembangan IKU berhasil diperbarui.',
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

<!-- MODAL EDIT NILAI PERKEMBANGAN IKU (2021 - 2025) -->
<div class="modal fade" id="modalEditIkuPerkembangan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
    <div class="modal-content" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: none;">
      <div class="modal-header" style="background: linear-gradient(135deg, #00c292 0%, #008765 100%); color: #ffffff; border-top-left-radius: 12px; border-top-right-radius: 12px; padding: 16px 20px;">
        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff; opacity: 0.85; font-size: 24px;">&times;</button>
        <h4 class="modal-title" style="font-size: 16px; font-weight: 700; color: #ffffff; margin: 0;">
          <i class="fa fa-pencil-square-o"></i> Edit Nilai Perkembangan IKU (2021 - 2025)
        </h4>
      </div>
      <div class="modal-body" style="padding: 20px;">
        <form id="formEditIkuNilai" onsubmit="event.preventDefault(); submitEditIku();">
          <input type="hidden" id="edit_iku_id" name="id" value="">
          
          <div class="form-group" style="margin-bottom: 16px;">
            <label style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 4px; display: block;">
              <i class="fa fa-cube"></i> Indikator Kinerja Utama (Master RPJMD)
            </label>
            <div id="edit_iku_uraian_display" style="padding: 10px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; font-weight: 600; color: #0f172a; font-size: 13.5px; line-height: 1.4;">
              -
            </div>
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
              <input type="text" class="form-control" id="edit_iku_n21" placeholder="Contoh: 70.00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2022</label>
              <input type="text" class="form-control" id="edit_iku_n22" placeholder="Contoh: 71.00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2023</label>
              <input type="text" class="form-control" id="edit_iku_n23" placeholder="Contoh: 71.00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-6" style="margin-bottom: 12px;">
              <label style="font-size: 12px; color: #64748b; font-weight: 600;">Tahun 2024</label>
              <input type="text" class="form-control" id="edit_iku_n24" placeholder="Contoh: 71.00" style="border-radius: 6px;">
            </div>
            <div class="col-xs-12" style="margin-bottom: 8px;">
              <label style="font-size: 12px; color: #007a5a; font-weight: 700;">Tahun 2025</label>
              <input type="text" class="form-control" id="edit_iku_n25" placeholder="Contoh: 72.00" style="border-radius: 6px; font-weight: 700; border-color: #00c292;">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; padding: 12px 20px;">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
        <button type="button" class="btn btn-success" id="btnSimpanIkuNilai" onclick="submitEditIku()" style="background: #00c292; border-color: #00c292; border-radius: 6px; font-weight: 600;">
          <i class="fa fa-save"></i> Simpan Perubahan Nilai
        </button>
      </div>
    </div>
  </div>
</div>

