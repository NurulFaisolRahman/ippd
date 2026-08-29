<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View IPPD: Tabel Indeks Perencanaan Pembangunan Daerah
 * Template Notika - Selaras dengan Desain IPPD & E-LKPJ
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2026;
$filterInstansi = isset($FilterInstansi) ? (int)$FilterInstansi : 1;
$masterData = isset($MasterData) ? $MasterData : [];
$savedScores = isset($SavedScores) ? $SavedScores : [];
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
  --ui-blue-border: #bfdbfe;
  --ui-blue-text: #1d4ed8;

  --ui-amber: #f59e0b;
  --ui-amber-light: #fffbeb;
  --ui-amber-border: #fde68a;
  --ui-amber-text: #b45309;

  --ui-purple: #8b5cf6;
  --ui-purple-light: #f5f3ff;
  --ui-purple-border: #ddd6fe;
  --ui-purple-text: #6d28d9;

  --ui-red: #ef4444;
  --ui-red-light: #fee2e2;
  
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
.page-header-box { margin-bottom: 20px; }
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
.page-title {
  font-size: 22px;
  font-weight: 800;
  color: var(--ui-dark);
  margin: 0 0 6px 0;
  letter-spacing: -0.01em;
}
.page-subtitle {
  color: var(--ui-text-muted);
  font-size: 13.5px;
  margin: 0 0 16px 0;
  line-height: 1.5;
}

/* Summary Dashboard Cards */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-bottom: 20px;
}
.stat-card {
  background: var(--ui-card-bg);
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  padding: 16px 18px;
  box-shadow: var(--shadow-card);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.stat-card::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3.5px;
}
.stat-card.c-total::before { background: var(--ui-primary); }
.stat-card.c-sinergi::before { background: var(--ui-amber); }
.stat-card.c-kualitas::before { background: var(--ui-blue); }
.stat-card.c-kinerja::before { background: var(--ui-purple); }

.stat-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 8px;
}
.stat-label {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: var(--ui-text-muted);
}
.stat-icon-wrap {
  width: 30px;
  height: 30px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
}
.c-total .stat-icon-wrap { background: var(--ui-primary-light); color: var(--ui-primary); }
.c-sinergi .stat-icon-wrap { background: var(--ui-amber-light); color: var(--ui-amber); }
.c-kualitas .stat-icon-wrap { background: var(--ui-blue-light); color: var(--ui-blue); }
.c-kinerja .stat-icon-wrap { background: var(--ui-purple-light); color: var(--ui-purple); }

.stat-value-row {
  display: flex;
  align-items: baseline;
  gap: 6px;
  margin-bottom: 8px;
}
.stat-score {
  font-size: 22px;
  font-weight: 800;
  color: var(--ui-dark);
  font-family: 'Roboto Mono', monospace;
}
.stat-max {
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-text-muted);
}
.stat-progress-bar {
  width: 100%;
  height: 6px;
  background: #f1f5f9;
  border-radius: 999px;
  overflow: hidden;
}
.stat-progress-fill {
  height: 100%;
  border-radius: 999px;
  transition: width 0.4s ease;
}
.c-total .stat-progress-fill { background: var(--ui-primary); }
.c-sinergi .stat-progress-fill { background: var(--ui-amber); }
.c-kualitas .stat-progress-fill { background: var(--ui-blue); }
.c-kinerja .stat-progress-fill { background: var(--ui-purple); }

/* Toolbar & Filters */
.toolbar-card {
  background: var(--ui-card-bg);
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-card);
  padding: 16px 20px;
  margin-bottom: 20px;
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.toolbar-filters {
  display: flex;
  align-items: flex-end;
  gap: 14px;
  flex-wrap: wrap;
}
.t-field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.t-field label {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: var(--ui-text-muted);
}
.t-select, .t-input {
  background: #fff;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 8px 12px;
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-dark);
  min-width: 160px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.t-select:focus, .t-input:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.toolbar-actions {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.btn-ui {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border: 1px solid #cbd5e1;
  background: #fff;
  color: var(--ui-text-main);
  padding: 8px 14px;
  font-size: 12.5px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  cursor: pointer;
  transition: all 0.15s ease;
}
.btn-ui:hover { background: #f8fafc; border-color: #94a3b8; }
.btn-ui-primary {
  background: var(--ui-primary);
  color: #fff;
  border-color: transparent;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.25);
}
.btn-ui-primary:hover { background: var(--ui-primary-hover); }

/* Table Container */
.table-card {
  background: var(--ui-card-bg);
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-card);
  overflow: hidden;
}
.table-scroll-wrap {
  overflow-x: auto;
  max-height: 75vh;
}
.ippd-table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
  min-width: 980px;
}
.ippd-table thead th {
  background: #f1f5f9;
  color: var(--ui-dark);
  font-size: 12px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  padding: 13px 12px;
  border-bottom: 2px solid #cbd5e1;
  border-right: 1px solid var(--ui-border);
  text-align: left;
  position: sticky;
  top: 0;
  z-index: 10;
}
.ippd-table thead th:last-child { border-right: none; }
.ippd-table thead th.text-center { text-align: center; }

.ippd-table tbody td {
  padding: 10px 12px;
  vertical-align: middle;
  font-size: 13px;
  line-height: 1.45;
  color: #1e293b;
  border-bottom: 1px solid var(--ui-border);
  border-right: 1px solid var(--ui-border);
}
.ippd-table tbody td:last-child { border-right: none; }

/* Column Specific Widths */
.col-no { width: 55px; min-width: 55px; text-align: center; font-weight: 700; }
.col-bobot-maks { width: 115px; min-width: 115px; text-align: center; font-family: 'Roboto Mono', monospace; font-weight: 700; }
.col-bobot-capaian { width: 135px; min-width: 135px; text-align: center; }
.col-opsi-aksi { width: 160px; min-width: 160px; }

/* Row Hierarchy Stylings */
tr.type-indeks {
  background: #fff8e1;
  border-left: 4px solid var(--ui-amber);
}
tr.type-indeks td {
  padding-top: 13px;
  padding-bottom: 13px;
  font-weight: 800;
  color: #78350f;
}
tr.type-indeks .col-bobot-maks { font-size: 15px; color: #b45309; }

tr.type-aspek {
  background: #eff6ff;
  border-left: 4px solid var(--ui-blue);
}
tr.type-aspek td {
  padding-top: 11px;
  padding-bottom: 11px;
  font-weight: 700;
  color: #1e3a8a;
}
tr.type-aspek .col-bobot-maks { font-size: 14px; color: #2563eb; }

tr.type-indikator {
  background: #f0fdf4;
  border-left: 3px solid var(--ui-primary);
}
tr.type-indikator td {
  color: #064e3b;
  font-weight: 600;
}
tr.type-indikator .col-no { color: #047857; }

tr.type-sub {
  background: #ffffff;
}
tr.type-sub:hover td {
  background: #fdfefe;
}

/* Tree Uraian Content */
.uraian-wrapper {
  display: flex;
  align-items: flex-start;
  gap: 8px;
}
.tree-toggle-btn {
  width: 20px;
  height: 20px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border: none;
  background: transparent;
  cursor: pointer;
  color: inherit;
  margin-top: 1px;
  flex-shrink: 0;
  transition: transform 0.15s ease;
}
.tree-toggle-btn.closed i {
  transform: rotate(-90deg);
}
.tree-text-content {
  flex: 1;
  min-width: 0;
}
.tree-eyebrow {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 2px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.tree-title {
  line-height: 1.45;
  word-break: break-word;
}

.type-indeks .tree-title { font-size: 15px; letter-spacing: -0.01em; }
.type-aspek .tree-title { font-size: 13.5px; }
.type-indikator .tree-title { font-size: 13px; }
.type-sub .tree-title { font-size: 12.5px; color: #334155; }

/* Input Bobot in Table */
.input-bobot-cell {
  width: 100%;
  max-width: 100px;
  padding: 6px 8px;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  font-family: 'Roboto Mono', monospace;
  font-size: 13px;
  font-weight: 700;
  text-align: center;
  color: var(--ui-dark);
  outline: none;
  background: #fff;
  transition: all 0.15s;
}
.input-bobot-cell:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.badge-sum-score {
  font-family: 'Roboto Mono', monospace;
  font-size: 13.5px;
  font-weight: 800;
  padding: 3px 8px;
  border-radius: 4px;
  display: inline-block;
}
.type-indeks .badge-sum-score { background: #fde68a; color: #92400e; }
.type-aspek .badge-sum-score { background: #dbeafe; color: #1e40af; }
.type-indikator .badge-sum-score { background: #d1fae5; color: #065f46; }

/* Action Cell */
.action-cell-wrap {
  display: flex;
  align-items: center;
  gap: 6px;
}
.select-opsi-aksi {
  width: 100%;
  padding: 5px 8px;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  font-size: 12px;
  font-weight: 600;
  color: var(--ui-dark);
  background: #fff;
  cursor: pointer;
  outline: none;
}
.select-opsi-aksi:focus {
  border-color: var(--ui-primary);
}
.btn-detail-modal {
  width: 28px;
  height: 28px;
  border-radius: var(--radius-sm);
  border: 1px solid var(--ui-border);
  background: #fff;
  color: var(--ui-text-muted);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  flex-shrink: 0;
  transition: all 0.15s;
}
.btn-detail-modal:hover {
  background: var(--ui-primary-light);
  border-color: var(--ui-primary-border);
  color: var(--ui-primary-text);
}
.btn-detail-modal.has-data {
  background: var(--ui-blue-light);
  border-color: var(--ui-blue-border);
  color: var(--ui-blue);
}

/* Modal Detail & Bukti Dukung */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15,23,42,0.6);
  backdrop-filter: blur(2px);
  display: none;
  align-items: flex-start;
  justify-content: center;
  padding: 36px 16px;
  overflow-y: auto;
  z-index: 1050;
}
.modal-overlay.open { display: flex; }

.modal-box {
  background: #fff;
  width: 100%;
  max-width: 650px;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-modal);
  padding: 28px 30px;
  position: relative;
  animation: modalFadeIn 0.2s ease-out;
}
@keyframes modalFadeIn {
  from { opacity: 0; transform: translateY(12px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}
.modal-close-btn {
  position: absolute;
  top: 20px;
  right: 20px;
  width: 32px;
  height: 32px;
  border-radius: 8px;
  border: none;
  background: transparent;
  color: var(--ui-text-muted);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}
.modal-close-btn:hover { background: #f1f5f9; color: var(--ui-dark); }

.modal-header-section {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  margin-bottom: 18px;
}
.modal-icon-badge {
  width: 46px;
  height: 46px;
  border-radius: var(--radius-md);
  background: var(--ui-primary-light);
  color: var(--ui-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.modal-title {
  margin: 0 0 4px;
  font-size: 18px;
  font-weight: 800;
  color: var(--ui-dark);
}
.modal-subtitle {
  margin: 0;
  font-size: 12.5px;
  color: var(--ui-text-muted);
}

.preset-btn-row {
  display: flex;
  gap: 6px;
  margin-top: 6px;
  flex-wrap: wrap;
}
.preset-btn {
  padding: 4px 10px;
  font-size: 11.5px;
  font-weight: 700;
  border-radius: 4px;
  border: 1px solid #cbd5e1;
  background: #f8fafc;
  color: #334155;
  cursor: pointer;
  transition: all 0.15s;
}
.preset-btn:hover {
  background: var(--ui-primary-light);
  border-color: var(--ui-primary-border);
  color: var(--ui-primary-text);
}

.form-field {
  margin-bottom: 16px;
}
.form-field label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: var(--ui-dark);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.02em;
}
.form-field input, .form-field select, .form-field textarea {
  width: 100%;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 9px 12px;
  font-family: inherit;
  font-size: 13px;
  color: var(--ui-dark);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}
.form-field textarea { min-height: 75px; resize: vertical; }
.form-field input:focus, .form-field select:focus, .form-field textarea:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.modal-footer-section {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding-top: 18px;
  border-top: 1px solid var(--ui-border);
  margin-top: 18px;
}

/* Toast */
.toast-container {
  position: fixed;
  bottom: 24px;
  right: 24px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  z-index: 1200;
}
.toast-msg {
  background: var(--ui-dark);
  color: #fff;
  padding: 12px 18px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.25);
  border-left: 4px solid var(--ui-primary);
  opacity: 0;
  transform: translateY(10px);
  transition: 0.25s ease;
}
.toast-msg.show { opacity: 1; transform: translateY(0); }
.toast-msg.error { border-left-color: var(--ui-red); }
</style>

<div class="main-content">
  <!-- Page Header -->
  <div class="page-header-box">
    <div class="page-badge"><i class="fa fa-line-chart"></i> Instrumen Pengukuran IPPD</div>
    <h1 class="page-title">Tabel Indeks Perencanaan Pembangunan Daerah (IPPD)</h1>
    <p class="page-subtitle">Instrumen penilaian dan pemantauan kualitas perencanaan daerah berdasarkan 3 pilar: Sinergi (32%), Kualitas Perencanaan (58%), dan Keterhubungan Kinerja (10%).</p>
  </div>

  <!-- Stats Grid -->
  <div class="stats-grid">
    <!-- Total Score -->
    <div class="stat-card c-total">
      <div class="stat-header">
        <span class="stat-label">Total Skor IPPD</span>
        <div class="stat-icon-wrap"><i class="fa fa-trophy"></i></div>
      </div>
      <div class="stat-value-row">
        <span class="stat-score" id="statTotalScore">0,00</span>
        <span class="stat-max">/ 100,00</span>
      </div>
      <div class="stat-progress-bar">
        <div class="stat-progress-fill" id="statTotalFill" style="width: 0%;"></div>
      </div>
    </div>

    <!-- Sinergi -->
    <div class="stat-card c-sinergi">
      <div class="stat-header">
        <span class="stat-label">1. Sinergi</span>
        <div class="stat-icon-wrap"><i class="fa fa-link"></i></div>
      </div>
      <div class="stat-value-row">
        <span class="stat-score" id="statSinergiScore">0,00</span>
        <span class="stat-max">/ 32,00</span>
      </div>
      <div class="stat-progress-bar">
        <div class="stat-progress-fill" id="statSinergiFill" style="width: 0%;"></div>
      </div>
    </div>

    <!-- Kualitas Perencanaan -->
    <div class="stat-card c-kualitas">
      <div class="stat-header">
        <span class="stat-label">2. Kualitas Perencanaan</span>
        <div class="stat-icon-wrap"><i class="fa fa-check-square-o"></i></div>
      </div>
      <div class="stat-value-row">
        <span class="stat-score" id="statKualitasScore">0,00</span>
        <span class="stat-max">/ 58,00</span>
      </div>
      <div class="stat-progress-bar">
        <div class="stat-progress-fill" id="statKualitasFill" style="width: 0%;"></div>
      </div>
    </div>

    <!-- Keterhubungan Kinerja -->
    <div class="stat-card c-kinerja">
      <div class="stat-header">
        <span class="stat-label">3. Keterhubungan Kinerja</span>
        <div class="stat-icon-wrap"><i class="fa fa-sitemap"></i></div>
      </div>
      <div class="stat-value-row">
        <span class="stat-score" id="statKinerjaScore">0,00</span>
        <span class="stat-max">/ 10,00</span>
      </div>
      <div class="stat-progress-bar">
        <div class="stat-progress-fill" id="statKinerjaFill" style="width: 0%;"></div>
      </div>
    </div>
  </div>

  <!-- Toolbar & Filter -->
  <div class="toolbar-card">
    <div class="toolbar-filters">
      <div class="t-field">
        <label for="selectTahun">Tahun Anggaran</label>
        <select id="selectTahun" class="t-select">
          <?php foreach ($ListTahun as $th): ?>
            <option value="<?= $th ?>" <?= ((int)$th === $tahunAktif) ? 'selected' : '' ?>><?= $th ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="t-field">
        <label for="selectInstansi">Perangkat Daerah / Instansi</label>
        <select id="selectInstansi" class="t-select" style="min-width: 250px;">
          <?php foreach ($ListInstansi as $inst): ?>
            <option value="<?= $inst['id'] ?>" <?= ((int)$inst['id'] === $filterInstansi) ? 'selected' : '' ?>><?= htmlspecialchars($inst['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="t-field">
        <label for="inputSearch">Pencarian Uraian</label>
        <input type="text" id="inputSearch" class="t-input" placeholder="Cari indikator / kata kunci...">
      </div>
    </div>

    <div class="toolbar-actions">
      <button type="button" class="btn-ui" id="btnExpandAll" title="Buka seluruh rincian tabel">
        <i class="fa fa-plus-square-o"></i> Buka Semua
      </button>
      <button type="button" class="btn-ui" id="btnCollapseAll" title="Tutup seluruh rincian tabel">
        <i class="fa fa-minus-square-o"></i> Tutup Semua
      </button>
      <button type="button" class="btn-ui btn-ui-primary" id="btnSaveAll" title="Simpan seluruh perubahan nilai">
        <i class="fa fa-save"></i> Simpan Semua Penilaian
      </button>
    </div>
  </div>

  <!-- Table Card -->
  <div class="table-card">
    <div class="table-scroll-wrap">
      <table class="ippd-table" id="tableIppd">
        <colgroup>
          <col style="width: 55px;" />
          <col />
          <col style="width: 115px;" />
          <col style="width: 135px;" />
          <col style="width: 160px;" />
        </colgroup>
        <thead>
          <tr>
            <th class="col-no">NO</th>
            <th>URAIAN INDIKATOR / SUB-INDIKATOR</th>
            <th class="col-bobot-maks text-center">Bobot Maksimal</th>
            <th class="col-bobot-capaian text-center">Bobot</th>
            <th class="col-opsi-aksi">Opsi Aksi</th>
          </tr>
        </thead>
        <tbody id="tbodyIppd">
          <!-- Rendered via JavaScript -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Detail & Bukti Dukung -->
<div class="modal-overlay" id="modalDetailOverlay">
  <div class="modal-box">
    <button type="button" class="modal-close-btn" id="btnModalClose">&times;</button>
    
    <div class="modal-header-section">
      <div class="modal-icon-badge">
        <i class="fa fa-pencil-square-o"></i>
      </div>
      <div>
        <h3 class="modal-title" id="modalDetailTitle">Detail Penilaian Indikator</h3>
        <p class="modal-subtitle" id="modalDetailSubtitle">Lengkapi capaian bobot, pilihan status pemenuhan, dan catatan evaluasi.</p>
      </div>
    </div>

    <form id="formDetailIppd" autocomplete="off">
      <input type="hidden" id="modalItemCode" value="">
      <input type="hidden" id="modalBobotMaks" value="0">

      <div class="form-field">
        <label>Uraian Indikator / Sub-Indikator</label>
        <div id="modalItemDesc" style="padding: 10px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; font-weight: 600; color: #334155; font-size: 13px; line-height: 1.5;"></div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
        <div class="form-field">
          <label for="modalBobotInput">Bobot Capaian (Maks: <span id="modalMaxBadge">0</span>)</label>
          <input type="number" step="0.001" min="0" id="modalBobotInput" placeholder="0.000">
          <div class="preset-btn-row">
            <button type="button" class="preset-btn" data-ratio="1.0">100%</button>
            <button type="button" class="preset-btn" data-ratio="0.75">75%</button>
            <button type="button" class="preset-btn" data-ratio="0.5">50%</button>
            <button type="button" class="preset-btn" data-ratio="0.25">25%</button>
            <button type="button" class="preset-btn" data-ratio="0">0%</button>
          </div>
        </div>

        <div class="form-field">
          <label for="modalOpsiAksi">Opsi Aksi / Kriteria</label>
          <select id="modalOpsiAksi">
            <option value="">-- Pilih Opsi Aksi --</option>
            <option value="Memenuhi Sepenuhnya">Memenuhi Sepenuhnya (100%)</option>
            <option value="Sebagian Besar Memenuhi">Sebagian Besar Memenuhi (75%)</option>
            <option value="Sebagian Memenuhi">Sebagian Memenuhi (50%)</option>
            <option value="Belum Memenuhi">Belum Memenuhi (0%)</option>
            <option value="Tidak Terkait / NA">Tidak Terkait / NA</option>
          </select>
        </div>
      </div>

      <div class="form-field">
        <label for="modalCatatan">Catatan / Evaluasi / Keterangan</label>
        <textarea id="modalCatatan" rows="3" placeholder="Tambahkan uraian penjelasan hasil evaluasi atau catatan pendukung..."></textarea>
      </div>

      <div class="form-field">
        <label for="modalBuktiDukung">Bukti Dukung / Sumber Data (Dokumen/Link)</label>
        <input type="text" id="modalBuktiDukung" placeholder="Contoh: Bab IV RPJMD 2025-2029 / Link Dokumen Evaluasi">
      </div>

      <div class="modal-footer-section">
        <button type="button" class="btn-ui" id="btnModalCancel">Batal</button>
        <button type="button" class="btn-ui btn-ui-primary" id="btnModalSave">
          <i class="fa fa-save"></i> Simpan Penilaian
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script>
(function(){
  "use strict";

  var BASE_URL = "<?= base_url() ?>";
  var MASTER_DATA = <?= json_encode($masterData) ?>;
  var SCORES_MAP = <?= json_encode($savedScores) ?> || {};

  var tbody = document.getElementById("tbodyIppd");
  var selectTahun = document.getElementById("selectTahun");
  var selectInstansi = document.getElementById("selectInstansi");
  var inputSearch = document.getElementById("inputSearch");

  var statTotalScore = document.getElementById("statTotalScore");
  var statTotalFill = document.getElementById("statTotalFill");
  var statSinergiScore = document.getElementById("statSinergiScore");
  var statSinergiFill = document.getElementById("statSinergiFill");
  var statKualitasScore = document.getElementById("statKualitasScore");
  var statKualitasFill = document.getElementById("statKualitasFill");
  var statKinerjaScore = document.getElementById("statKinerjaScore");
  var statKinerjaFill = document.getElementById("statKinerjaFill");

  var modalDetail = document.getElementById("modalDetailOverlay");
  var modalItemCode = document.getElementById("modalItemCode");
  var modalBobotMaks = document.getElementById("modalBobotMaks");
  var modalItemDesc = document.getElementById("modalItemDesc");
  var modalMaxBadge = document.getElementById("modalMaxBadge");
  var modalBobotInput = document.getElementById("modalBobotInput");
  var modalOpsiAksi = document.getElementById("modalOpsiAksi");
  var modalCatatan = document.getElementById("modalCatatan");
  var modalBuktiDukung = document.getElementById("modalBuktiDukung");

  var collapsedKeys = new Set();
  var itemMap = {}; // Lookup for flat item reference

  function numFmt(n){
    if (n === null || n === undefined || isNaN(n)) return "0";
    var num = Number(n);
    var s = num.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
    return s.replace(".", ",");
  }

  function showToast(msg, isError){
    var container = document.getElementById("toastContainer");
    var toast = document.createElement("div");
    toast.className = "toast-msg" + (isError ? " error" : "");
    toast.innerHTML = '<i class="fa ' + (isError ? 'fa-exclamation-triangle' : 'fa-check-circle') + '"></i> <span>' + escapeHtml(msg) + '</span>';
    container.appendChild(toast);
    setTimeout(function(){ toast.classList.add("show"); }, 20);
    setTimeout(function(){
      toast.classList.remove("show");
      setTimeout(function(){ toast.remove(); }, 300);
    }, 3000);
  }

  function escapeHtml(str){
    if (!str) return "";
    return String(str)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // Populate itemMap for quick lookup
  function buildItemMap(){
    itemMap = {};
    MASTER_DATA.forEach(function(indeks){
      itemMap[indeks.code] = { title: indeks.title, bobot: indeks.bobot, type: 'indeks', obj: indeks };
      if (indeks.aspek){
        indeks.aspek.forEach(function(aspek){
          itemMap[aspek.code] = { title: aspek.title, bobot: aspek.bobot, type: 'aspek', letter: aspek.letter, obj: aspek };
          if (aspek.indikator){
            aspek.indikator.forEach(function(ind){
              itemMap[ind.code] = { title: ind.title, bobot: ind.bobot, type: 'indikator', no: ind.no, obj: ind };
              if (ind.sub && ind.sub.length > 0){
                ind.sub.forEach(function(sub){
                  itemMap[sub.code] = { title: sub.title, bobot: sub.bobot, type: 'sub', letter: sub.letter, obj: sub };
                });
              }
            });
          }
        });
      }
    });
  }

  // Calculate Rollup Scores for Tree
  function calculateRollupScores(){
    var calculated = {};
    var grandTotal = 0;
    var sinergiScore = 0;
    var kualitasScore = 0;
    var kinerjaScore = 0;

    MASTER_DATA.forEach(function(indeks){
      var indeksSum = 0;
      if (indeks.aspek){
        indeks.aspek.forEach(function(aspek){
          var aspekSum = 0;
          if (aspek.indikator){
            aspek.indikator.forEach(function(ind){
              var indScore = 0;
              if (ind.sub && ind.sub.length > 0){
                ind.sub.forEach(function(sub){
                  var subVal = SCORES_MAP[sub.code] && SCORES_MAP[sub.code].bobot_capaian !== null ? Number(SCORES_MAP[sub.code].bobot_capaian) : 0;
                  indScore += subVal;
                });
                calculated[ind.code] = indScore;
              } else {
                indScore = SCORES_MAP[ind.code] && SCORES_MAP[ind.code].bobot_capaian !== null ? Number(SCORES_MAP[ind.code].bobot_capaian) : 0;
                calculated[ind.code] = indScore;
              }
              aspekSum += indScore;
            });
          }
          calculated[aspek.code] = aspekSum;
          indeksSum += aspekSum;
        });
      }
      calculated[indeks.code] = indeksSum;
      grandTotal += indeksSum;

      if (indeks.code === '1') sinergiScore = indeksSum;
      else if (indeks.code === '2') kualitasScore = indeksSum;
      else if (indeks.code === '3') kinerjaScore = indeksSum;
    });

    // Update Top Stat Cards
    statTotalScore.textContent = numFmt(grandTotal);
    statTotalFill.style.width = Math.min(100, Math.max(0, (grandTotal / 100) * 100)) + "%";

    statSinergiScore.textContent = numFmt(sinergiScore);
    statSinergiFill.style.width = Math.min(100, Math.max(0, (sinergiScore / 32) * 100)) + "%";

    statKualitasScore.textContent = numFmt(kualitasScore);
    statKualitasFill.style.width = Math.min(100, Math.max(0, (kualitasScore / 58) * 100)) + "%";

    statKinerjaScore.textContent = numFmt(kinerjaScore);
    statKinerjaFill.style.width = Math.min(100, Math.max(0, (kinerjaScore / 10) * 100)) + "%";

    return calculated;
  }

  function renderTable(){
    tbody.innerHTML = "";
    var searchKeyword = inputSearch.value.trim().toLowerCase();
    var calculatedScores = calculateRollupScores();

    MASTER_DATA.forEach(function(indeks){
      var isIndeksOpen = !collapsedKeys.has(indeks.code);
      var hasChildAspek = indeks.aspek && indeks.aspek.length > 0;

      // Filter check
      var matchIndeks = !searchKeyword || indeks.title.toLowerCase().indexOf(searchKeyword) !== -1;

      var trIndeks = document.createElement("tr");
      trIndeks.className = "type-indeks";
      trIndeks.innerHTML = 
        '<td class="col-no">' + indeks.code + '</td>' +
        '<td>' +
          '<div class="uraian-wrapper" style="padding-left: 4px;">' +
            (hasChildAspek ? '<button type="button" class="tree-toggle-btn ' + (isIndeksOpen ? '' : 'closed') + '" data-code="' + indeks.code + '"><i class="fa fa-chevron-down"></i></button>' : '') +
            '<div class="tree-text-content">' +
              '<div class="tree-eyebrow" style="color:#b45309;">INDEKS ' + indeks.code + '</div>' +
              '<div class="tree-title">' + escapeHtml(indeks.title) + '</div>' +
            '</div>' +
          '</div>' +
        '</td>' +
        '<td class="col-bobot-maks">' + numFmt(indeks.bobot) + '</td>' +
        '<td class="col-bobot-capaian"><span class="badge-sum-score">' + numFmt(calculatedScores[indeks.code] || 0) + '</span></td>' +
        '<td class="col-opsi-aksi"><span style="font-size:11.5px; font-weight:700; color:#b45309;"><i class="fa fa-folder-open"></i> Pilar ' + indeks.code + '</span></td>';
      tbody.appendChild(trIndeks);

      if (isIndeksOpen && hasChildAspek){
        indeks.aspek.forEach(function(aspek){
          var isAspekOpen = !collapsedKeys.has(aspek.code);
          var hasChildInd = aspek.indikator && aspek.indikator.length > 0;

          var trAspek = document.createElement("tr");
          trAspek.className = "type-aspek";
          trAspek.innerHTML = 
            '<td class="col-no">' + aspek.letter + '</td>' +
            '<td>' +
              '<div class="uraian-wrapper" style="padding-left: 24px;">' +
                (hasChildInd ? '<button type="button" class="tree-toggle-btn ' + (isAspekOpen ? '' : 'closed') + '" data-code="' + aspek.code + '"><i class="fa fa-chevron-down"></i></button>' : '') +
                '<div class="tree-text-content">' +
                  '<div class="tree-eyebrow" style="color:#1d4ed8;">ASPEK ' + aspek.letter.toUpperCase() + '</div>' +
                  '<div class="tree-title">' + escapeHtml(aspek.title) + '</div>' +
                '</div>' +
              '</div>' +
            '</td>' +
            '<td class="col-bobot-maks">' + numFmt(aspek.bobot) + '</td>' +
            '<td class="col-bobot-capaian"><span class="badge-sum-score">' + numFmt(calculatedScores[aspek.code] || 0) + '</span></td>' +
            '<td class="col-opsi-aksi"><span style="font-size:11.5px; font-weight:600; color:#2563eb;">Aspek Evaluasi</span></td>';
          tbody.appendChild(trAspek);

          if (isAspekOpen && hasChildInd){
            aspek.indikator.forEach(function(ind){
              var isIndOpen = !collapsedKeys.has(ind.code);
              var hasSub = ind.sub && ind.sub.length > 0;

              var savedScoreInd = SCORES_MAP[ind.code] || {};
              var currentScoreVal = hasSub ? calculatedScores[ind.code] : (savedScoreInd.bobot_capaian !== null && savedScoreInd.bobot_capaian !== undefined ? savedScoreInd.bobot_capaian : "");

              var trInd = document.createElement("tr");
              trInd.className = "type-indikator";

              var cellInputOrBadge = hasSub ? 
                '<span class="badge-sum-score">' + numFmt(calculatedScores[ind.code] || 0) + '</span>' :
                '<input type="number" step="0.001" min="0" max="' + ind.bobot + '" class="input-bobot-cell" data-code="' + ind.code + '" data-max="' + ind.bobot + '" value="' + currentScoreVal + '" placeholder="0">';

              var opsiAksiHtml = hasSub ? 
                '<span style="font-size:11.5px; color:#047857; font-weight:600;"><i class="fa fa-list"></i> ' + ind.sub.length + ' Sub-Indikator</span>' :
                '<div class="action-cell-wrap">' +
                  '<select class="select-opsi-aksi" data-code="' + ind.code + '">' +
                    '<option value="">-- Opsi Aksi --</option>' +
                    '<option value="Memenuhi Sepenuhnya"' + (savedScoreInd.opsi_aksi === 'Memenuhi Sepenuhnya' ? ' selected' : '') + '>Memenuhi (100%)</option>' +
                    '<option value="Sebagian Besar Memenuhi"' + (savedScoreInd.opsi_aksi === 'Sebagian Besar Memenuhi' ? ' selected' : '') + '>Sebagian Besar (75%)</option>' +
                    '<option value="Sebagian Memenuhi"' + (savedScoreInd.opsi_aksi === 'Sebagian Memenuhi' ? ' selected' : '') + '>Sebagian (50%)</option>' +
                    '<option value="Belum Memenuhi"' + (savedScoreInd.opsi_aksi === 'Belum Memenuhi' ? ' selected' : '') + '>Belum Memenuhi (0%)</option>' +
                  '</select>' +
                  '<button type="button" class="btn-detail-modal ' + (savedScoreInd.catatan || savedScoreInd.bukti_dukung ? 'has-data' : '') + '" data-code="' + ind.code + '" title="Catatan & Bukti Dukung"><i class="fa fa-file-text-o"></i></button>' +
                '</div>';

              trInd.innerHTML = 
                '<td class="col-no">' + ind.no + '</td>' +
                '<td>' +
                  '<div class="uraian-wrapper" style="padding-left: 44px;">' +
                    (hasSub ? '<button type="button" class="tree-toggle-btn ' + (isIndOpen ? '' : 'closed') + '" data-code="' + ind.code + '"><i class="fa fa-chevron-down"></i></button>' : '') +
                    '<div class="tree-text-content">' +
                      '<div class="tree-eyebrow" style="color:#047857;">Indikator ' + ind.no + '</div>' +
                      '<div class="tree-title">' + escapeHtml(ind.title) + '</div>' +
                    '</div>' +
                  '</div>' +
                '</td>' +
                '<td class="col-bobot-maks">' + numFmt(ind.bobot) + '</td>' +
                '<td class="col-bobot-capaian">' + cellInputOrBadge + '</td>' +
                '<td class="col-opsi-aksi">' + opsiAksiHtml + '</td>';
              tbody.appendChild(trInd);

              if (isIndOpen && hasSub){
                ind.sub.forEach(function(sub){
                  var savedScoreSub = SCORES_MAP[sub.code] || {};
                  var currentSubScore = (savedScoreSub.bobot_capaian !== null && savedScoreSub.bobot_capaian !== undefined) ? savedScoreSub.bobot_capaian : "";

                  var trSub = document.createElement("tr");
                  trSub.className = "type-sub";
                  trSub.innerHTML = 
                    '<td class="col-no" style="font-weight:normal; color:#64748b;">' + sub.letter + ')</td>' +
                    '<td>' +
                      '<div class="uraian-wrapper" style="padding-left: 68px;">' +
                        '<div class="tree-text-content">' +
                          '<div class="tree-eyebrow" style="color:#64748b;">Sub-Indikator ' + sub.letter + '</div>' +
                          '<div class="tree-title">' + escapeHtml(sub.title) + '</div>' +
                        '</div>' +
                      '</div>' +
                    '</td>' +
                    '<td class="col-bobot-maks" style="font-weight:600; color:#475569;">' + numFmt(sub.bobot) + '</td>' +
                    '<td class="col-bobot-capaian">' +
                      '<input type="number" step="0.001" min="0" max="' + sub.bobot + '" class="input-bobot-cell" data-code="' + sub.code + '" data-max="' + sub.bobot + '" value="' + currentSubScore + '" placeholder="0">' +
                    '</td>' +
                    '<td class="col-opsi-aksi">' +
                      '<div class="action-cell-wrap">' +
                        '<select class="select-opsi-aksi" data-code="' + sub.code + '">' +
                          '<option value="">-- Opsi Aksi --</option>' +
                          '<option value="Memenuhi Sepenuhnya"' + (savedScoreSub.opsi_aksi === 'Memenuhi Sepenuhnya' ? ' selected' : '') + '>Memenuhi (100%)</option>' +
                          '<option value="Sebagian Besar Memenuhi"' + (savedScoreSub.opsi_aksi === 'Sebagian Besar Memenuhi' ? ' selected' : '') + '>Sebagian Besar (75%)</option>' +
                          '<option value="Sebagian Memenuhi"' + (savedScoreSub.opsi_aksi === 'Sebagian Memenuhi' ? ' selected' : '') + '>Sebagian (50%)</option>' +
                          '<option value="Belum Memenuhi"' + (savedScoreSub.opsi_aksi === 'Belum Memenuhi' ? ' selected' : '') + '>Belum Memenuhi (0%)</option>' +
                        '</select>' +
                        '<button type="button" class="btn-detail-modal ' + (savedScoreSub.catatan || savedScoreSub.bukti_dukung ? 'has-data' : '') + '" data-code="' + sub.code + '" title="Catatan & Bukti Dukung"><i class="fa fa-file-text-o"></i></button>' +
                      '</div>' +
                    '</td>';
                  tbody.appendChild(trSub);
                });
              }
            });
          }
        });
      }
    });
  }

  // Open Modal Detail
  function openDetailModal(code){
    var item = itemMap[code];
    if (!item) return;

    var saved = SCORES_MAP[code] || {};
    modalItemCode.value = code;
    modalBobotMaks.value = item.bobot;
    modalMaxBadge.textContent = numFmt(item.bobot);

    var typeLabel = item.type === 'sub' ? 'Sub-Indikator (' + item.letter + ')' : 'Indikator (' + (item.no || '') + ')';
    modalDetailTitle.textContent = "Penilaian " + typeLabel;
    modalItemDesc.textContent = item.title;

    modalBobotInput.value = (saved.bobot_capaian !== null && saved.bobot_capaian !== undefined) ? saved.bobot_capaian : "";
    modalBobotInput.max = item.bobot;
    modalOpsiAksi.value = saved.opsi_aksi || "";
    modalCatatan.value = saved.catatan || "";
    modalBuktiDukung.value = saved.bukti_dukung || "";

    modalDetail.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ modalBobotInput.focus(); }, 100);
  }

  function closeDetailModal(){
    modalDetail.classList.remove("open");
    document.body.style.overflow = "";
  }

  // Save Single Item from Modal
  function saveModalDetail(){
    var code = modalItemCode.value;
    if (!code) return;

    var item = itemMap[code];
    var maxVal = item ? item.bobot : 100;
    var inputVal = modalBobotInput.value.trim();
    var bobotNum = inputVal === "" ? null : Number(inputVal);

    if (bobotNum !== null && (bobotNum < 0 || bobotNum > maxVal)){
      showToast("Nilai bobot capaian melebihi bobot maksimal (" + numFmt(maxVal) + ")", true);
      return;
    }

    var payload = {
      tahun: selectTahun.value,
      instansi_id: selectInstansi.value,
      item_code: code,
      bobot_capaian: bobotNum,
      opsi_aksi: modalOpsiAksi.value,
      catatan: modalCatatan.value.trim(),
      bukti_dukung: modalBuktiDukung.value.trim()
    };

    var btn = document.getElementById("btnModalSave");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    $.ajax({
      url: BASE_URL + "Instansi/SaveIPPDScore",
      type: "POST",
      data: payload,
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Penilaian';
        if (resp.status === "success"){
          SCORES_MAP[code] = {
            bobot_capaian: bobotNum,
            opsi_aksi: payload.opsi_aksi,
            catatan: payload.catatan,
            bukti_dukung: payload.bukti_dukung
          };
          closeDetailModal();
          showToast("Penilaian untuk item berhasil disimpan.");
          renderTable();
        } else {
          showToast(resp.message || "Gagal menyimpan data.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Penilaian';
        showToast("Terjadi kesalahan pada server.", true);
      }
    });
  }

  // Save All Scores in Table
  function saveAllScores(){
    var btn = document.getElementById("btnSaveAll");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    var itemsToSave = [];

    // Collect all inputs from table
    document.querySelectorAll(".input-bobot-cell").forEach(function(input){
      var code = input.getAttribute("data-code");
      var maxBobot = Number(input.getAttribute("data-max") || 100);
      var valStr = input.value.trim();
      var valNum = valStr === "" ? null : Number(valStr);

      if (valNum !== null && (valNum < 0 || valNum > maxBobot)){
        valNum = maxBobot; // clamp to max
        input.value = valNum;
      }

      var selectOpsi = document.querySelector('.select-opsi-aksi[data-code="' + code + '"]');
      var opsiVal = selectOpsi ? selectOpsi.value : (SCORES_MAP[code] ? SCORES_MAP[code].opsi_aksi : "");
      var existingCatatan = SCORES_MAP[code] ? SCORES_MAP[code].catatan : "";
      var existingBukti = SCORES_MAP[code] ? SCORES_MAP[code].bukti_dukung : "";

      SCORES_MAP[code] = {
        bobot_capaian: valNum,
        opsi_aksi: opsiVal,
        catatan: existingCatatan,
        bukti_dukung: existingBukti
      };

      itemsToSave.push({
        item_code: code,
        bobot_capaian: valNum,
        opsi_aksi: opsiVal,
        catatan: existingCatatan,
        bukti_dukung: existingBukti
      });
    });

    $.ajax({
      url: BASE_URL + "Instansi/SaveAllIPPDScore",
      type: "POST",
      data: {
        tahun: selectTahun.value,
        instansi_id: selectInstansi.value,
        items: JSON.stringify(itemsToSave)
      },
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Semua Penilaian';
        if (resp.status === "success"){
          showToast(resp.message || "Seluruh penilaian IPPD berhasil disimpan.");
          renderTable();
        } else {
          showToast(resp.message || "Gagal menyimpan penilaian.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Semua Penilaian';
        showToast("Terjadi gangguan komunikasi dengan server.", true);
      }
    });
  }

  // Reload data from server on filter change
  function reloadData(){
    $.ajax({
      url: BASE_URL + "Instansi/GetIPPDData",
      type: "POST",
      data: {
        tahun: selectTahun.value,
        instansi_id: selectInstansi.value
      },
      dataType: "json",
      success: function(resp){
        if (resp.status === "success"){
          MASTER_DATA = resp.master || MASTER_DATA;
          SCORES_MAP = resp.scores || {};
          buildItemMap();
          renderTable();
        }
      }
    });
  }

  // Event Listeners
  document.getElementById("btnExpandAll").addEventListener("click", function(){
    collapsedKeys.clear();
    renderTable();
  });

  document.getElementById("btnCollapseAll").addEventListener("click", function(){
    collapsedKeys.clear();
    MASTER_DATA.forEach(function(indeks){
      collapsedKeys.add(indeks.code);
      if (indeks.aspek){
        indeks.aspek.forEach(function(aspek){
          collapsedKeys.add(aspek.code);
          if (aspek.indikator){
            aspek.indikator.forEach(function(ind){
              collapsedKeys.add(ind.code);
            });
          }
        });
      }
    });
    renderTable();
  });

  document.getElementById("btnSaveAll").addEventListener("click", saveAllScores);

  tbody.addEventListener("click", function(e){
    // Toggle Tree Chevron
    var toggleBtn = e.target.closest(".tree-toggle-btn");
    if (toggleBtn){
      var code = toggleBtn.getAttribute("data-code");
      if (collapsedKeys.has(code)) collapsedKeys.delete(code);
      else collapsedKeys.add(code);
      renderTable();
      return;
    }

    // Open Modal Detail
    var detailBtn = e.target.closest(".btn-detail-modal");
    if (detailBtn){
      var itemCode = detailBtn.getAttribute("data-code");
      openDetailModal(itemCode);
      return;
    }
  });

  // Dynamic input changes in table
  tbody.addEventListener("input", function(e){
    if (e.target.classList.contains("input-bobot-cell")){
      var input = e.target;
      var code = input.getAttribute("data-code");
      var maxBobot = Number(input.getAttribute("data-max") || 100);
      var val = input.value.trim() === "" ? null : Number(input.value);

      if (val !== null && val > maxBobot){
        val = maxBobot;
        input.value = val;
      }

      if (!SCORES_MAP[code]) SCORES_MAP[code] = {};
      SCORES_MAP[code].bobot_capaian = val;
      calculateRollupScores();
    }
  });

  // Dynamic Select Opsi Aksi change in table
  tbody.addEventListener("change", function(e){
    if (e.target.classList.contains("select-opsi-aksi")){
      var sel = e.target;
      var code = sel.getAttribute("data-code");
      var item = itemMap[code];
      if (!item) return;

      var maxBobot = item.bobot;
      var ratio = 0;
      if (sel.value === "Memenuhi Sepenuhnya") ratio = 1.0;
      else if (sel.value === "Sebagian Besar Memenuhi") ratio = 0.75;
      else if (sel.value === "Sebagian Memenuhi") ratio = 0.5;
      else if (sel.value === "Belum Memenuhi") ratio = 0;

      var computedScore = maxBobot * ratio;
      var inputCell = document.querySelector('.input-bobot-cell[data-code="' + code + '"]');
      if (inputCell){
        inputCell.value = computedScore;
      }

      if (!SCORES_MAP[code]) SCORES_MAP[code] = {};
      SCORES_MAP[code].bobot_capaian = computedScore;
      SCORES_MAP[code].opsi_aksi = sel.value;
      calculateRollupScores();
    }
  });

  // Quick Preset Buttons in Modal
  document.querySelectorAll(".preset-btn").forEach(function(btn){
    btn.addEventListener("click", function(){
      var ratio = parseFloat(this.getAttribute("data-ratio"));
      var max = parseFloat(modalBobotMaks.value) || 0;
      var calc = max * ratio;
      modalBobotInput.value = calc;

      if (ratio === 1.0) modalOpsiAksi.value = "Memenuhi Sepenuhnya";
      else if (ratio === 0.75) modalOpsiAksi.value = "Sebagian Besar Memenuhi";
      else if (ratio === 0.5) modalOpsiAksi.value = "Sebagian Memenuhi";
      else if (ratio === 0) modalOpsiAksi.value = "Belum Memenuhi";
    });
  });

  document.getElementById("btnModalClose").addEventListener("click", closeDetailModal);
  document.getElementById("btnModalCancel").addEventListener("click", closeDetailModal);
  document.getElementById("btnModalSave").addEventListener("click", saveModalDetail);

  modalDetail.addEventListener("click", function(e){
    if (e.target === modalDetail) closeDetailModal();
  });

  selectTahun.addEventListener("change", reloadData);
  selectInstansi.addEventListener("change", reloadData);
  inputSearch.addEventListener("input", renderTable);

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape" && modalDetail.classList.contains("open")){
      closeDetailModal();
    }
  });

  // Initial Boot
  buildItemMap();
  renderTable();
})();
</script>
