<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View Realisasi Renaksi (Program, Kegiatan, Sub Kegiatan)
 * Desain dan Style Notika Teal (#00c292) - Selaras dengan menu DPA & Target Renaksi
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$bulanNames = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$currentBulanIdx = isset($BulanAktif) ? (int)$BulanAktif : 0;
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
  --sidebar-width: 280px;
  --sidebar-mini-width: 70px;
  --transition-speed: 0.3s;

  --ui-primary: #00c292;
  --ui-primary-hover: #00a87e;
  --ui-primary-light: #e8f8f5;
  --ui-primary-border: #b3ecd9;
  --ui-primary-dark: #007a5c;
  
  --ui-dark: #1e293b;
  --ui-gray-900: #0f172a;
  --ui-gray-700: #334155;
  --ui-gray-600: #475569;
  --ui-gray-500: #64748b;
  --ui-gray-400: #94a3b8;
  --ui-gray-300: #cbd5e1;
  --ui-gray-200: #e2e8f0;
  --ui-gray-100: #f1f5f9;
  --ui-gray-50:  #f8fafc;
  
  --ui-danger: #ef4444;
  --ui-warning: #f59e0b;
  --ui-info: #0284c7;
  --ui-success: #10b981;
  
  --ui-shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
  --ui-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
  --ui-shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
  --ui-radius: 10px;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  color: var(--ui-gray-700);
  background-color: #f4f7f6;
  font-size: 13.5px;
  line-height: 1.5;
  margin: 0;
  padding: 0;
}

.num-font {
  font-family: 'Roboto Mono', monospace;
  font-variant-numeric: tabular-nums;
}

/* Main Layout with Sidebar Integration */
.main-content {
  margin-left: var(--sidebar-width, 280px);
  padding: 20px 24px 80px;
  min-height: 100vh;
  transition: all var(--transition-speed, 0.3s) ease;
  background-color: #f4f7f6;
}

.sidebar-mini .main-content {
  margin-left: var(--sidebar-mini-width, 70px);
}

@media (max-width: 991px) {
  .main-content {
    margin-left: 0 !important;
    padding: 15px 12px 60px;
  }
}

.app-container {
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
}

/* Header Banner */
.renaksi-header-card {
  background: linear-gradient(135deg, #00c292 0%, #008f6b 100%);
  border-radius: var(--ui-radius);
  padding: 22px 26px;
  color: #ffffff;
  box-shadow: var(--ui-shadow-md);
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
}

.renaksi-header-card::after {
  content: '';
  position: absolute;
  right: -20px;
  bottom: -40px;
  width: 220px;
  height: 220px;
  background: radial-gradient(circle, rgba(255,255,255,0.18) 0%, rgba(255,255,255,0) 70%);
  border-radius: 50%;
  pointer-events: none;
}

.renaksi-header-title {
  font-size: 19px;
  font-weight: 800;
  letter-spacing: -0.02em;
  margin: 0 0 4px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.renaksi-header-desc {
  font-size: 13px;
  opacity: 0.92;
  margin: 0;
  max-width: 900px;
}

/* Cards */
.notika-card {
  background: #ffffff;
  border: 1px solid var(--ui-gray-200);
  border-radius: var(--ui-radius);
  box-shadow: var(--ui-shadow-sm);
  margin-bottom: 20px;
  overflow: hidden;
  transition: all 0.2s ease;
}

.notika-card-header {
  padding: 14px 20px;
  background-color: #ffffff;
  border-bottom: 1px solid var(--ui-gray-200);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}

.notika-card-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--ui-gray-900);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.notika-card-title i {
  color: var(--ui-primary);
}

.notika-card-body {
  padding: 18px 20px;
}

/* Filter Controls */
.filter-row {
  display: grid;
  grid-template-columns: 140px 1.8fr 180px 1.2fr;
  gap: 14px;
  align-items: flex-end;
}

@media (max-width: 1100px) {
  .filter-row {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 640px) {
  .filter-row {
    grid-template-columns: 1fr;
  }
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.filter-label {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--ui-gray-700);
  text-transform: uppercase;
  letter-spacing: 0.03em;
  margin: 0;
}

.filter-select, .filter-input {
  width: 100%;
  height: 38px;
  padding: 6px 12px;
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-gray-900);
  background-color: #ffffff;
  border: 1px solid var(--ui-gray-300);
  border-radius: 6px;
  outline: none;
  transition: border-color 0.15s ease, box-shadow 0.15s ease;
}

.filter-select:focus, .filter-input:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

/* Stats Summary */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-bottom: 20px;
}

@media (max-width: 1100px) {
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 640px) {
  .stats-grid {
    grid-template-columns: 1fr;
  }
}

.stat-box {
  background: #ffffff;
  border: 1px solid var(--ui-gray-200);
  border-radius: 8px;
  padding: 12px 16px;
  border-left: 4px solid var(--ui-primary);
  box-shadow: var(--ui-shadow-sm);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.stat-label {
  font-size: 11px;
  font-weight: 700;
  color: var(--ui-gray-500);
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

.stat-value {
  font-size: 16px;
  font-weight: 800;
  color: var(--ui-gray-900);
  margin-top: 2px;
}

/* Table Styling */
.table-responsive-notika {
  overflow-x: auto;
  border: 1px solid var(--ui-gray-200);
  border-radius: 0 0 var(--ui-radius) var(--ui-radius);
  background: #ffffff;
}

table.renaksi-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  font-size: 12.5px;
  color: var(--ui-gray-700);
  min-width: 1200px;
}

table.renaksi-table thead th {
  background-color: var(--ui-gray-100);
  color: var(--ui-gray-700);
  font-weight: 700;
  padding: 9px 8px;
  border: 1px solid var(--ui-gray-200);
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
}

table.renaksi-table thead tr:first-child th {
  background-color: #f8fafc;
  color: var(--ui-gray-900);
  font-size: 12px;
}

table.renaksi-table thead tr:last-child th {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

table.renaksi-table td {
  padding: 8px 10px;
  border: 1px solid var(--ui-gray-200);
  vertical-align: middle;
}

/* Hierarchical Rows */
tr.row-program {
  background-color: #e6f9f4 !important;
  border-left: 4px solid var(--ui-primary);
}

tr.row-program td.cell-name {
  font-weight: 800;
  color: #007a5c;
  font-size: 12.8px;
  text-transform: uppercase;
}

tr.row-kegiatan {
  background-color: #f8fafc !important;
}

tr.row-kegiatan td.cell-name {
  font-weight: 700;
  color: var(--ui-gray-900);
  padding-left: 24px;
}

tr.row-sub td.cell-name {
  color: #0284c7;
  font-weight: 600;
  padding-left: 44px;
}

tr.row-sub:hover td {
  background-color: #f0fdf9;
}

.num-cell {
  text-align: right;
  white-space: nowrap;
  font-family: 'Roboto Mono', monospace;
  font-size: 12px;
}

.center-cell {
  text-align: center;
  white-space: nowrap;
}

/* Badges for Predikat */
.badge-predikat {
  display: inline-block;
  padding: 2px 8px;
  border-radius: 999px;
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 0.02em;
  text-align: center;
  white-space: nowrap;
}

.pred-1 { background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; } /* Sangat Tinggi */
.pred-2 { background-color: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; } /* Tinggi */
.pred-3 { background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; } /* Sedang */
.pred-4 { background-color: #ffedd5; color: #c2410c; border: 1px solid #fed7aa; } /* Rendah */
.pred-5 { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; } /* Sangat Rendah */
.pred-none { color: var(--ui-gray-400); font-weight: 500; }

/* Buttons */
.btn-action-edit {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  border-radius: 6px;
  background-color: #ffffff;
  border: 1px solid var(--ui-primary-border);
  color: var(--ui-primary);
  cursor: pointer;
  transition: all 0.15s ease;
}

.btn-action-edit:hover {
  background-color: var(--ui-primary);
  color: #ffffff;
  border-color: var(--ui-primary);
  box-shadow: 0 2px 4px rgba(0, 194, 146, 0.25);
  transform: scale(1.05);
}

.btn-notika {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
  border: 1px solid transparent;
  transition: all 0.15s ease;
  text-decoration: none !important;
}

.btn-notika-primary {
  background-color: var(--ui-primary);
  color: #ffffff !important;
}

.btn-notika-primary:hover {
  background-color: var(--ui-primary-hover);
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.3);
}

.btn-notika-outline {
  background-color: #ffffff;
  border-color: var(--ui-gray-300);
  color: var(--ui-gray-700) !important;
}

.btn-notika-outline:hover {
  background-color: var(--ui-gray-100);
  border-color: var(--ui-gray-400);
}

.btn-notika-ghost {
  background-color: transparent;
  color: var(--ui-gray-600) !important;
}

.btn-notika-ghost:hover {
  background-color: var(--ui-gray-100);
  color: var(--ui-gray-900) !important;
}

/* Legend Table */
.legend-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 12px;
}

.legend-table th, .legend-table td {
  border: 1px solid var(--ui-gray-200);
  padding: 7px 12px;
  text-align: left;
}

.legend-table th {
  background-color: var(--ui-primary-light);
  color: var(--ui-primary-dark);
  font-weight: 700;
}

.legend-dot {
  display: inline-block;
  width: 10px;
  height: 10px;
  border-radius: 3px;
  margin-right: 8px;
  vertical-align: middle;
}

/* Modals */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(15, 23, 42, 0.7);
  display: none;
  align-items: flex-start;
  justify-content: center;
  padding: 85px 16px 40px;
  z-index: 999999 !important;
  overflow-y: auto;
  backdrop-filter: blur(4px);
}

.modal-overlay.open {
  display: flex !important;
}

.modal-container {
  background: #ffffff;
  border-radius: 12px;
  max-width: 1080px;
  max-height: calc(100vh - 48px);
  width: 100%;
  box-shadow: 0 25px 60px rgba(15, 23, 42, 0.4);
  animation: modalPop 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  margin: auto;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  position: relative;
  z-index: 200001;
}

@keyframes modalPop {
  from { opacity: 0; transform: translateY(12px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

.modal-header-notika {
  flex: 0 0 auto;
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 18px 24px;
  border-bottom: 1px solid var(--ui-gray-200);
  background: #ffffff;
  border-radius: 12px 12px 0 0;
}

.modal-header-icon {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  background: var(--ui-primary-light);
  color: var(--ui-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}

.modal-header-text h3 {
  margin: 0;
  font-size: 15.5px;
  font-weight: 800;
  color: var(--ui-gray-900);
}

.modal-header-text p {
  margin: 2px 0 0;
  font-size: 12px;
  color: var(--ui-gray-500);
}

.modal-close-btn {
  margin-left: auto;
  background: none;
  border: none;
  cursor: pointer;
  padding: 8px;
  border-radius: 6px;
  color: var(--ui-gray-400);
  font-size: 18px;
  transition: all 0.15s;
}

.modal-close-btn:hover {
  background-color: var(--ui-gray-100);
  color: var(--ui-danger);
}

.modal-body-notika {
  flex: 1 1 auto;
  padding: 20px 24px;
  max-height: calc(100vh - 180px);
  overflow-y: auto;
}

.modal-footer-notika {
  flex: 0 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 14px 24px;
  border-top: 1px solid var(--ui-gray-200);
  background-color: var(--ui-gray-50);
  border-radius: 0 0 12px 12px;
}

.modal-footer-right {
  display: flex;
  gap: 10px;
}

/* Info Sub Cards inside modal */
.info-section-card {
  background: #ffffff;
  border: 1px solid var(--ui-gray-200);
  border-radius: 8px;
  padding: 14px 16px;
  margin-bottom: 16px;
}

.info-section-title {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--ui-primary-dark);
  margin: 0 0 10px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.info-kv-grid {
  display: grid;
  grid-template-columns: 180px 1fr;
  row-gap: 6px;
  font-size: 12.5px;
}

.info-kv-k {
  color: var(--ui-gray-500);
  font-weight: 600;
}

.info-kv-v {
  color: var(--ui-gray-900);
  font-weight: 500;
}

.info-kv-v::before {
  content: ": ";
  font-weight: 600;
  color: var(--ui-gray-400);
}

/* Modal Edit Tables */
table.modal-edit-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 12px;
  margin-top: 6px;
}

table.modal-edit-table th {
  background-color: var(--ui-gray-100);
  border: 1px solid var(--ui-gray-200);
  padding: 7px 8px;
  color: var(--ui-gray-700);
  font-weight: 700;
  text-align: center;
}

table.modal-edit-table td {
  border: 1px solid var(--ui-gray-200);
  padding: 6px 7px;
  vertical-align: middle;
  text-align: center;
}

table.modal-edit-table td.readonly-val {
  background-color: #f8fafc;
  color: var(--ui-gray-700);
  font-weight: 600;
  text-align: right;
}

table.modal-edit-table input.input-real {
  width: 100%;
  border: 1px solid var(--ui-gray-300);
  border-radius: 5px;
  padding: 5px 7px;
  font-size: 12px;
  font-weight: 600;
  color: var(--ui-gray-900);
  text-align: right;
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}

table.modal-edit-table input.input-real:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.15);
  background-color: #ffffff;
}

.notice-box {
  background-color: #fffbeb;
  border: 1px solid #fde68a;
  border-radius: 8px;
  padding: 12px 14px;
  font-size: 12px;
  color: #92400e;
  margin-top: 14px;
}

.notice-box h5 {
  margin: 0 0 4px;
  font-size: 12.5px;
  font-weight: 700;
  color: #b45309;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* Toast Notifications */
.notika-toast-box {
  position: fixed;
  top: 24px;
  right: 24px;
  z-index: 99999;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.notika-toast {
  min-width: 280px;
  max-width: 380px;
  background: #ffffff;
  border-radius: 8px;
  padding: 14px 16px;
  box-shadow: var(--ui-shadow-lg);
  border-left: 4px solid var(--ui-primary);
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 13px;
  color: var(--ui-gray-900);
  animation: slideInToast 0.2s ease-out;
}

.notika-toast.toast-error {
  border-left-color: var(--ui-danger);
}

@keyframes slideInToast {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}
</style>

<div class="main-content">
  <div class="app-container">

    <!-- Header Card -->
    <div class="renaksi-header-card">
      <div class="renaksi-header-title">
        <i class="fa fa-chart-line"></i>
        Realisasi Kinerja &amp; Anggaran Renaksi
      </div>
      <div class="renaksi-header-desc">
        Akumulasi berjenjang dan pemantauan capaian realisasi anggaran dan kinerja sasaran dari Sub Kegiatan &rarr; Kegiatan &rarr; Program berbasis data Target Renaksi dan DPA.
      </div>
    </div>

    <!-- Filter Card -->
    <div class="notika-card">
      <div class="notika-card-header">
        <div class="notika-card-title">
          <i class="fa fa-filter"></i> Parameter Filter &amp; Pelaporan
        </div>
        <div style="font-size: 12px; color: var(--ui-gray-500); font-weight: 600;">
          <i class="fa fa-calendar-check" style="color: var(--ui-primary);"></i> Bulan Aktif: <strong><?=$bulanNames[$currentBulanIdx]?></strong> (Triwulan <?=floor($currentBulanIdx/3)+1?>)
        </div>
      </div>
      <div class="notika-card-body">
        <form id="filterForm" method="GET" action="<?=base_url('Instansi/RealisasiRenaksi')?>">
          <div class="filter-row">
            
            <!-- Tahun -->
            <div class="filter-group">
              <label class="filter-label">Tahun Anggaran</label>
              <select name="tahun" id="filterTahun" class="filter-select" onchange="this.form.submit()">
                <?php foreach ($ListTahun as $thn): ?>
                  <option value="<?=$thn?>" <?=$thn == $TahunAktif ? 'selected' : ''?>><?=$thn?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Perangkat Daerah -->
            <?php if (!$IsRole4): ?>
              <div class="filter-group">
                <label class="filter-label">Perangkat Daerah</label>
                <select name="instansi_id" id="filterInstansi" class="filter-select" onchange="this.form.submit()">
                  <option value="">-- Semua Perangkat Daerah --</option>
                  <?php foreach ($ListInstansi as $inst): ?>
                    <option value="<?=$inst['id']?>" <?=$inst['id'] == $FilterInstansi ? 'selected' : ''?>><?=htmlspecialchars($inst['nama'])?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            <?php else: ?>
              <input type="hidden" name="instansi_id" value="<?=$FilterInstansi?>">
            <?php endif; ?>

            <!-- Bulan Pelaporan -->
            <div class="filter-group">
              <label class="filter-label">Bulan Pelaporan</label>
              <select name="bulan" id="filterBulan" class="filter-select" onchange="this.form.submit()">
                <?php foreach ($bulanNames as $idx => $bName): ?>
                  <option value="<?=$idx?>" <?=$idx == $currentBulanIdx ? 'selected' : ''?>><?=$bName?> (TW <?=floor($idx/3)+1?>)</option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Search Input -->
            <div class="filter-group">
              <label class="filter-label">Pencarian Cepat</label>
              <input type="text" id="tableSearch" class="filter-input" placeholder="Cari kode / nama kegiatan...">
            </div>

          </div>
        </form>
      </div>
    </div>

    <!-- Summary Statistics -->
    <div class="stats-grid">
      <div class="stat-box">
        <div>
          <div class="stat-label">Total Target Anggaran</div>
          <div class="stat-value num-font" id="stat-target-anggaran">Rp 0</div>
        </div>
        <i class="fa fa-wallet fa-2x" style="color: var(--ui-gray-300);"></i>
      </div>
      <div class="stat-box">
        <div>
          <div class="stat-label">Realisasi s.d. <?=$bulanNames[$currentBulanIdx]?></div>
          <div class="stat-value num-font" id="stat-realisasi-anggaran" style="color: var(--ui-primary-dark);">Rp 0</div>
        </div>
        <i class="fa fa-coins fa-2x" style="color: var(--ui-primary-border);"></i>
      </div>
      <div class="stat-box">
        <div>
          <div class="stat-label">% Capaian Anggaran</div>
          <div class="stat-value num-font" id="stat-persen-anggaran">0.00%</div>
        </div>
        <div id="stat-badge-anggaran"><span class="badge-predikat pred-none">-</span></div>
      </div>
      <div class="stat-box">
        <div>
          <div class="stat-label">Rata-rata Capaian Kinerja</div>
          <div class="stat-value num-font" id="stat-persen-kinerja">0.00%</div>
        </div>
        <div id="stat-badge-kinerja"><span class="badge-predikat pred-none">-</span></div>
      </div>
    </div>

    <!-- Main Table Card -->
    <div class="notika-card">
      <div class="notika-card-header">
        <div class="notika-card-title">
          <i class="fa fa-sitemap"></i> Capaian Target &amp; Realisasi (Program, Kegiatan, Sub Kegiatan)
        </div>
        <div style="font-size: 12px; color: var(--ui-gray-500);">
          *Pagu Target &amp; Realisasi Anggaran Sub Kegiatan terakumulasi otomatis ke Kegiatan lalu ke Program
        </div>
      </div>
      <div class="notika-card-body" style="padding: 0;">
        <div class="table-responsive-notika">
          <table class="renaksi-table" id="mainRealisasiTable">
            <thead>
              <tr>
                <th rowspan="2" style="text-align: left; min-width: 380px; padding-left: 16px;">Program / Kegiatan / Sub Kegiatan</th>
                <th colspan="4" style="background-color: #f0fdf9; color: #007a5c; border-bottom: 1px solid var(--ui-gray-300);">Realisasi Anggaran (Rp) s.d. <?=$bulanNames[$currentBulanIdx]?></th>
                <th colspan="4" style="background-color: #f8fafc; color: #1e293b; border-bottom: 1px solid var(--ui-gray-300);">Realisasi Kinerja (%) Triwulan <?=floor($currentBulanIdx/3)+1?></th>
                <th rowspan="2" style="width: 60px;">Opsi<br>Aksi</th>
              </tr>
              <tr>
                <th style="min-width: 120px;">Target</th>
                <th style="min-width: 120px;">Realisasi</th>
                <th style="min-width: 70px;">%</th>
                <th style="min-width: 105px;">Predikat</th>
                <th style="min-width: 75px;">Target</th>
                <th style="min-width: 75px;">Realisasi</th>
                <th style="min-width: 70px;">%</th>
                <th style="min-width: 105px;">Predikat</th>
              </tr>
            </thead>
            <tbody id="realisasiTbody">
              <!-- Dynamic JavaScript Render -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Legend Card -->
    <div class="notika-card">
      <div class="notika-card-header">
        <div class="notika-card-title">
          <i class="fa fa-info-circle"></i> Skala Nilai Peringkat Realisasi Kinerja
        </div>
      </div>
      <div class="notika-card-body" style="padding: 16px;">
        <table class="legend-table">
          <thead>
            <tr>
              <th style="width: 50px; text-align: center;">No.</th>
              <th>Interval Nilai Realisasi Kinerja</th>
              <th>Kriteria Penilaian Realisasi Kinerja</th>
              <th>Badge Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align: center; color: var(--ui-gray-500); font-weight: bold;">(1)</td>
              <td class="num-font" style="font-weight: 600;">91% &le; 100%</td>
              <td><span class="legend-dot" style="background:#16a34a"></span><strong>Sangat Tinggi</strong></td>
              <td><span class="badge-predikat pred-1">Sangat Tinggi</span></td>
            </tr>
            <tr>
              <td style="text-align: center; color: var(--ui-gray-500); font-weight: bold;">(2)</td>
              <td class="num-font" style="font-weight: 600;">76% &le; 90%</td>
              <td><span class="legend-dot" style="background:#2563eb"></span><strong>Tinggi</strong></td>
              <td><span class="badge-predikat pred-2">Tinggi</span></td>
            </tr>
            <tr>
              <td style="text-align: center; color: var(--ui-gray-500); font-weight: bold;">(3)</td>
              <td class="num-font" style="font-weight: 600;">66% &le; 75%</td>
              <td><span class="legend-dot" style="background:#d97706"></span><strong>Sedang</strong></td>
              <td><span class="badge-predikat pred-3">Sedang</span></td>
            </tr>
            <tr>
              <td style="text-align: center; color: var(--ui-gray-500); font-weight: bold;">(4)</td>
              <td class="num-font" style="font-weight: 600;">51% &le; 65%</td>
              <td><span class="legend-dot" style="background:#ea580c"></span><strong>Rendah</strong></td>
              <td><span class="badge-predikat pred-4">Rendah</span></td>
            </tr>
            <tr>
              <td style="text-align: center; color: var(--ui-gray-500); font-weight: bold;">(5)</td>
              <td class="num-font" style="font-weight: 600;">&le; 50%</td>
              <td><span class="legend-dot" style="background:#dc2626"></span><strong>Sangat Rendah</strong></td>
              <td><span class="badge-predikat pred-5">Sangat Rendah</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Modal Container Shell -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-container" id="modalContainer">
    <!-- Dynamic Modal Content Loaded Here -->
  </div>
</div>

<!-- Toast Box Container -->
<div class="notika-toast-box" id="toastBox"></div>

<script>
"use strict";

const IS_ROLE_4 = <?=!empty($IsRole4) ? 'true' : 'false'?>;
const BULAN_NAMES = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
const CURRENT_BULAN_IDX = <?=json_encode($currentBulanIdx)?>;
const CURRENT_TAHUN = <?=json_encode($TahunAktif)?>;
const CURRENT_INSTANSI_ID = <?=json_encode($FilterInstansi)?>;
const BASE_URL = "<?=base_url()?>";

let REALISASI_TREE = <?=json_encode($RealisasiTree)?>;
let CURRENT_EDIT_DATA = null;

/* Formatting Helpers */
function esc(str) {
  return String(str == null ? '' : str).replace(/[&<>"']/g, function(m) {
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function fmtRp(num) {
  if (num === null || num === undefined || num === '') return '-';
  const n = typeof num === 'string' ? parseNum(num) : Number(num);
  if (n === null || isNaN(n)) return '-';
  return 'Rp ' + Math.round(n).toLocaleString('id-ID');
}

function fmtNum(num) {
  if (num === null || num === undefined || num === '') return '-';
  const n = typeof num === 'string' ? parseNum(num) : Number(num);
  if (n === null || isNaN(n)) return '-';
  return Number(n).toLocaleString('id-ID', { maximumFractionDigits: 2 });
}

function fmtPct(num) {
  if (num === null || num === undefined || isNaN(num)) return '-';
  return Number(num).toFixed(2) + '%';
}

function parseNum(val) {
  if (val === undefined || val === null) return null;
  let s = String(val).trim();
  if (s === '') return null;
  if (s.indexOf('.') !== -1 && s.indexOf(',') !== -1) {
    s = s.replace(/\./g, '').replace(',', '.');
  } else if (s.indexOf('.') !== -1 && s.indexOf(',') === -1) {
    const dotCount = (s.match(/\./g) || []).length;
    if (dotCount > 1) {
      s = s.replace(/\./g, '');
    } else {
      const parts = s.split('.');
      if (parts[1] && parts[1].length === 3 && Number(parts[0]) > 0) {
        s = s.replace(/\./g, '');
      }
    }
  } else if (s.indexOf(',') !== -1) {
    s = s.replace(',', '.');
  }
  s = s.replace(/[^0-9.-]+/g, '').trim();
  if (s === '' || isNaN(Number(s))) return null;
  return parseFloat(s);
}

function getPredikatObj(pct) {
  if (pct === null || pct === undefined || isNaN(pct)) return { label: '-', cls: 'pred-none' };
  if (pct >= 91) return { label: 'Sangat Tinggi', cls: 'pred-1' };
  if (pct >= 76) return { label: 'Tinggi', cls: 'pred-2' };
  if (pct >= 66) return { label: 'Sedang', cls: 'pred-3' };
  if (pct >= 51) return { label: 'Rendah', cls: 'pred-4' };
  return { label: 'Sangat Rendah', cls: 'pred-5' };
}

function showToast(message, isError = false) {
  const box = document.getElementById('toastBox');
  const toast = document.createElement('div');
  toast.className = 'notika-toast' + (isError ? ' toast-error' : '');
  toast.innerHTML = '<i class="fa ' + (isError ? 'fa-exclamation-circle text-danger' : 'fa-check-circle text-success') + '"></i> <span>' + esc(message) + '</span>';
  box.appendChild(toast);
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 0.3s';
    setTimeout(() => toast.remove(), 300);
  }, 3500);
}

/* Aggregation Functions */
// Target alokasi bulan murni untuk baris Sub Kegiatan (tidak ditambah antar bulan)
function getSubTargetBulan(sub, bulanIdx) {
  if (sub.bulanan && sub.bulanan[bulanIdx] && sub.bulanan[bulanIdx].target !== null && sub.bulanan[bulanIdx].target !== undefined) {
    return Number(sub.bulanan[bulanIdx].target);
  }
  return sub.targetAnggaran ? Number(sub.targetAnggaran) : 0;
}

// Target kumulatif s.d. bulan aktif untuk agregasi Kegiatan & Program (bertambah/terakumulasi)
function getSubTargetKumulatif(sub, bulanIdx) {
  let sum = 0;
  if (sub.bulanan && sub.bulanan.length) {
    for (let i = 0; i <= bulanIdx; i++) {
      if (sub.bulanan[i] && sub.bulanan[i].target !== null && sub.bulanan[i].target !== undefined) {
        sum += Number(sub.bulanan[i].target);
      }
    }
    return sum;
  }
  return sub.targetAnggaran ? (Number(sub.targetAnggaran) * (bulanIdx + 1) / 12) : 0;
}

function getSubTargetSampai(sub, bulanIdx) {
  return getSubTargetBulan(sub, bulanIdx);
}

function getSubRealisasiSampai(sub, bulanIdx) {
  let any = false, sum = 0;
  if (!sub.bulanan) return null;
  for (let i = 0; i <= bulanIdx; i++) {
    if (sub.bulanan[i] && sub.bulanan[i].realisasi !== null && sub.bulanan[i].realisasi !== undefined && sub.bulanan[i].realisasi !== '') {
      any = true;
      sum += Number(sub.bulanan[i].realisasi);
    }
  }
  return any ? sum : null;
}

function getKegiatanTargetTotal(keg) {
  return (keg.subKegiatan || []).reduce((a, s) => a + getSubTargetKumulatif(s, CURRENT_BULAN_IDX), 0);
}

function getKegiatanRealisasiSampai(keg, bulanIdx) {
  let any = false, sum = 0;
  (keg.subKegiatan || []).forEach(s => {
    const r = getSubRealisasiSampai(s, bulanIdx);
    if (r !== null) { any = true; sum += r; }
  });
  return any ? sum : null;
}

function getProgramTargetTotal(prog) {
  return (prog.kegiatan || []).reduce((a, k) => a + getKegiatanTargetTotal(k), 0);
}

function getProgramRealisasiSampai(prog, bulanIdx) {
  let any = false, sum = 0;
  (prog.kegiatan || []).forEach(k => {
    const r = getKegiatanRealisasiSampai(k, bulanIdx);
    if (r !== null) { any = true; sum += r; }
  });
  return any ? sum : null;
}

function sumTWTarget(twArr, upToTW) {
  if (!twArr) return null;
  let sum = 0, any = false;
  for (let i = 0; i < upToTW; i++) {
    if (twArr[i] && twArr[i].target !== null && twArr[i].target !== undefined) {
      any = true;
      sum += Number(twArr[i].target);
    }
  }
  return any ? sum : null;
}

function sumTWRealisasi(twArr, upToTW) {
  if (!twArr) return null;
  let sum = 0, any = false;
  for (let i = 0; i < upToTW; i++) {
    if (twArr[i] && twArr[i].realisasi !== null && twArr[i].realisasi !== undefined) {
      any = true;
      sum += Number(twArr[i].realisasi);
    }
  }
  return any ? sum : null;
}

/* Metric Cells Generator */
function renderMetricCols(target, realisasi, isRupiah, rowspan = 1) {
  const rs = rowspan > 1 ? ` rowspan="${rowspan}"` : '';
  const tStr = target !== null && target !== undefined ? (isRupiah ? fmtRp(target) : fmtNum(target)) : '-';
  const rStr = realisasi !== null && realisasi !== undefined ? (isRupiah ? fmtRp(realisasi) : fmtNum(realisasi)) : '-';
  
  let pct = null;
  if (target && target > 0 && realisasi !== null && realisasi !== undefined) {
    pct = (realisasi / target) * 100;
  }
  const pctStr = pct !== null ? fmtPct(pct) : '-';
  const pred = getPredikatObj(pct);
  const predHtml = `<span class="badge-predikat ${pred.cls}">${pred.label}</span>`;

  return `
    <td${rs} class="num-cell">${tStr}</td>
    <td${rs} class="num-cell" style="font-weight: 600; color: ${realisasi !== null ? 'var(--ui-gray-900)' : 'var(--ui-gray-400)'};">${rStr}</td>
    <td${rs} class="num-cell" style="font-weight: 700;">${pctStr}</td>
    <td${rs} class="center-cell">${predHtml}</td>
  `;
}

/* Main Table Render */
function renderMainTable() {
  const tbody = document.getElementById('realisasiTbody');
  const currentTW = Math.floor(CURRENT_BULAN_IDX / 3) + 1; // 1 s.d. 4
  
  if (!REALISASI_TREE || !REALISASI_TREE.length) {
    tbody.innerHTML = `
      <tr>
        <td colspan="10" style="text-align: center; padding: 40px 10px; color: var(--ui-gray-500);">
          <i class="fa fa-folder-open fa-3x" style="color: var(--ui-gray-300); margin-bottom: 10px;"></i><br>
          Tidak ada data Program, Kegiatan, atau Sub Kegiatan untuk parameter yang dipilih.
        </td>
      </tr>
    `;
    updateStatsSummary(0, 0, 0);
    return;
  }

  let html = '';
  let grandTargetAng = 0;
  let grandRealAng = 0;
  let kinerjaPctList = [];

  REALISASI_TREE.forEach((prog, pIdx) => {
    const pTarget = getProgramTargetTotal(prog);
    const pReal = getProgramRealisasiSampai(prog, CURRENT_BULAN_IDX);
    const pKinTarget = sumTWTarget(prog.kinerja ? prog.kinerja.tw : [], currentTW);
    const pKinReal = sumTWRealisasi(prog.kinerja ? prog.kinerja.tw : [], currentTW);

    grandTargetAng += pTarget;
    if (pReal !== null) grandRealAng += pReal;
    if (pKinTarget && pKinReal !== null) kinerjaPctList.push((pKinReal / pKinTarget) * 100);

    // Row Program
    html += `<tr class="row-program">`;
    html += `<td class="cell-name"><i class="fa fa-folder" style="margin-right: 6px; color:#3b82f6;"></i> <span style="font-weight:700;">[${esc(prog.kode)}] ${esc(prog.nomenklatur || prog.nama)}</span></td>`;
    html += renderMetricCols(pTarget, pReal, true, 1);
    html += renderMetricCols(pKinTarget, pKinReal, false, 1);
    html += `<td class="center-cell">
      ${IS_ROLE_4 ? `<button class="btn-action-edit" onclick="openProgramModal(${pIdx})" title="Edit Realisasi Program">
        <i class="fa fa-pen"></i>
      </button>` : `<span style="color:#94a3b8; font-size:12px;">-</span>`}
    </td>`;
    html += `</tr>`;

    (prog.kegiatan || []).forEach((keg, kIdx) => {
      const kTarget = getKegiatanTargetTotal(keg);
      const kReal = getKegiatanRealisasiSampai(keg, CURRENT_BULAN_IDX);
      const kKinTarget = sumTWTarget(keg.kinerja ? keg.kinerja.tw : [], currentTW);
      const kKinReal = sumTWRealisasi(keg.kinerja ? keg.kinerja.tw : [], currentTW);

      if (kKinTarget && kKinReal !== null) kinerjaPctList.push((kKinReal / kKinTarget) * 100);

      // Row Kegiatan
      html += `<tr class="row-kegiatan">`;
      html += `<td class="cell-name" style="padding-left: 22px;"><i class="fa fa-layer-group" style="margin-right: 6px; color: #06b6d4;"></i> <span style="font-weight:700;">[${esc(keg.kode)}] ${esc(keg.nomenklatur || keg.nama)}</span></td>`;
      html += renderMetricCols(kTarget, kReal, true, 1);
      html += renderMetricCols(kKinTarget, kKinReal, false, 1);
      html += `<td class="center-cell">
        ${IS_ROLE_4 ? `<button class="btn-action-edit" onclick="openKegiatanModal(${pIdx}, ${kIdx})" title="Edit Realisasi Kegiatan">
          <i class="fa fa-pen"></i>
        </button>` : `<span style="color:#94a3b8; font-size:12px;">-</span>`}
      </td>`;
      html += `</tr>`;

      (keg.subKegiatan || []).forEach((sub, sIdx) => {
        const subTarget = getSubTargetSampai(sub, CURRENT_BULAN_IDX);
        const subReal = getSubRealisasiSampai(sub, CURRENT_BULAN_IDX);
        const indikatorList = (sub.indikator && sub.indikator.length) ? sub.indikator : [null];
        const rowspan = indikatorList.length;

        indikatorList.forEach((indik, iIdx) => {
          html += `<tr class="row-sub">`;
          if (iIdx === 0) {
            html += `<td class="cell-name" style="padding-left: 36px;"${rowspan > 1 ? ` rowspan="${rowspan}"` : ''}>
              <i class="fa fa-check-circle" style="margin-right: 6px; color: var(--ui-primary);"></i>
              <span style="font-weight:600;">[${esc(sub.kode)}] ${esc(sub.nomenklatur || sub.nama)}</span>
            </td>`;
            html += renderMetricCols(subTarget, subReal, true, rowspan);
          }

          let iKinTarget = null, iKinReal = null;
          if (indik) {
            iKinTarget = sumTWTarget(indik.tw, currentTW);
            iKinReal = sumTWRealisasi(indik.tw, currentTW);
            if (iKinTarget && iKinReal !== null) kinerjaPctList.push((iKinReal / iKinTarget) * 100);
          }
          html += renderMetricCols(iKinTarget, iKinReal, false, 1);

          if (iIdx === 0) {
            html += `<td class="center-cell"${rowspan > 1 ? ` rowspan="${rowspan}"` : ''}>
              ${IS_ROLE_4 ? `<button class="btn-action-edit" onclick="openSubKegiatanModal(${pIdx}, ${kIdx}, ${sIdx})" title="Edit Realisasi Sub Kegiatan">
                <i class="fa fa-pen"></i>
              </button>` : `<span style="color:#94a3b8; font-size:12px;">-</span>`}
            </td>`;
          }
          html += `</tr>`;
        });
      });
    });
  });

  tbody.innerHTML = html;
  
  const avgKinPct = kinerjaPctList.length ? (kinerjaPctList.reduce((a, b) => a + b, 0) / kinerjaPctList.length) : null;
  updateStatsSummary(grandTargetAng, grandRealAng, avgKinPct);
}

function updateStatsSummary(targetAng, realAng, avgKinerja) {
  document.getElementById('stat-target-anggaran').textContent = fmtRp(targetAng);
  document.getElementById('stat-realisasi-anggaran').textContent = fmtRp(realAng);
  
  const pctAng = (targetAng > 0) ? (realAng / targetAng) * 100 : null;
  document.getElementById('stat-persen-anggaran').textContent = pctAng !== null ? fmtPct(pctAng) : '-';
  
  const predAng = getPredikatObj(pctAng);
  document.getElementById('stat-badge-anggaran').innerHTML = `<span class="badge-predikat ${predAng.cls}">${predAng.label}</span>`;
  
  document.getElementById('stat-persen-kinerja').textContent = avgKinerja !== null ? fmtPct(avgKinerja) : '-';
  const predKin = getPredikatObj(avgKinerja);
  document.getElementById('stat-badge-kinerja').innerHTML = `<span class="badge-predikat ${predKin.cls}">${predKin.label}</span>`;
}

/* Modal Helpers */
function showModal(content) {
  const container = document.getElementById('modalContainer');
  container.innerHTML = content;
  document.getElementById('modalOverlay').classList.add('open');
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
  document.getElementById('modalContainer').innerHTML = '';
  CURRENT_EDIT_DATA = null;
}

function renderTWInputCells(rowIdx, twArr) {
  let html = '';
  for (let i = 0; i < 4; i++) {
    const tVal = (twArr && twArr[i] && twArr[i].target !== null && twArr[i].target !== undefined) ? fmtNum(twArr[i].target) : '-';
    const rVal = (twArr && twArr[i] && twArr[i].realisasi !== null && twArr[i].realisasi !== undefined) ? twArr[i].realisasi : '';
    html += `
      <td class="readonly-val">${tVal}</td>
      <td style="padding: 3px;">
        <input type="number" step="any" class="input-real input-tw-real" data-row="${rowIdx}" data-tw="${i}" value="${rVal}">
      </td>
    `;
  }
  return html;
}

/* Modal Program */
function openProgramModal(pIdx) {
  const prog = REALISASI_TREE[pIdx];
  CURRENT_EDIT_DATA = { type: 'program', pIdx: pIdx, raw: JSON.parse(JSON.stringify(prog)) };

  const currentTW = Math.floor(CURRENT_BULAN_IDX / 3) + 1;
  const kin = prog.kinerja || { uraian: 'Indikator Program', satuan: '%', tw: [{},{},{},{}] };
  const targetTahunan = sumTWTarget(kin.tw, 4) || 100;

  const html = `
    <div class="modal-header-notika">
      <div class="modal-header-icon"><i class="fa fa-chart-pie"></i></div>
      <div class="modal-header-text">
        <h3>REALISASI KINERJA PROGRAM</h3>
        <p>Pengisian capaian realisasi kinerja program per triwulan (Target bersifat read-only).</p>
      </div>
      <button class="modal-close-btn" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>
    <div class="modal-body-notika">
      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-info-circle"></i> Informasi Program</div>
        <div class="info-kv-grid">
          <div class="info-kv-k">Tahun Anggaran</div><div class="info-kv-v">${CURRENT_TAHUN}</div>
          <div class="info-kv-k">Bulan / Triwulan</div><div class="info-kv-v">${BULAN_NAMES[CURRENT_BULAN_IDX]} (Triwulan ${currentTW})</div>
          <div class="info-kv-k">Kode &amp; Program</div><div class="info-kv-v"><strong>[${esc(prog.kode)}]</strong> ${esc(prog.nama)}</div>
        </div>
      </div>

      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-tasks"></i> Realisasi Kinerja Program</div>
        <table class="modal-edit-table">
          <thead>
            <tr>
              <th rowspan="2" style="width: 35px;">No</th>
              <th rowspan="2" style="text-align: left;">Uraian Indikator</th>
              <th rowspan="2" style="width: 70px;">Satuan</th>
              <th rowspan="2" style="width: 80px;">Target<br>Tahunan</th>
              <th colspan="2">Triwulan I</th>
              <th colspan="2">Triwulan II</th>
              <th colspan="2">Triwulan III</th>
              <th colspan="2">Triwulan IV</th>
            </tr>
            <tr>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-weight: bold; color: var(--ui-gray-500);">1</td>
              <td style="text-align: left; font-weight: 500;">${esc(kin.uraian)}</td>
              <td>${esc(kin.satuan)}</td>
              <td class="readonly-val">${fmtNum(targetTahunan)}</td>
              ${renderTWInputCells(0, kin.tw)}
            </tr>
          </tbody>
        </table>
      </div>

      <div class="notice-box">
        <h5><i class="fa fa-shield-alt"></i> Petunjuk Pengisian:</h5>
        Target Kinerja (Tahunan &amp; Triwulan) diambil dari penetapan Target Renaksi. Masukkan angka capaian realisasi pada kolom Realisasi per Triwulan, lalu klik <strong>Simpan Realisasi</strong>.
      </div>
    </div>
    <div class="modal-footer-notika">
      <button class="btn-notika btn-notika-ghost" onclick="closeModal()"><i class="fa fa-arrow-left"></i> Kembali</button>
      <div class="modal-footer-right">
        <button class="btn-notika btn-notika-outline" onclick="openProgramModal(${pIdx})"><i class="fa fa-undo"></i> Reset</button>
        <button class="btn-notika btn-notika-primary" onclick="saveProgramRealisasi()"><i class="fa fa-save"></i> Simpan Realisasi</button>
      </div>
    </div>
  `;

  showModal(html);
}

function saveProgramRealisasi() {
  const prog = REALISASI_TREE[CURRENT_EDIT_DATA.pIdx];
  const twVals = [];
  for (let i = 0; i < 4; i++) {
    const input = document.querySelector(`.input-tw-real[data-row="0"][data-tw="${i}"]`);
    twVals[i] = input ? parseNum(input.value) : null;
  }

  const payload = {
    level_type: 'program',
    entity_code: prog.kode,
    tahun: CURRENT_TAHUN,
    id_instansi: CURRENT_INSTANSI_ID,
    tw1: twVals[0],
    tw2: twVals[1],
    tw3: twVals[2],
    tw4: twVals[3]
  };

  $.ajax({
    url: BASE_URL + 'Instansi/SaveRealisasiHierarchy',
    type: 'POST',
    data: payload,
    dataType: 'json',
    success: function(resp) {
      if (resp.status === 'success') {
        showToast(resp.message || 'Realisasi program berhasil disimpan!');
        for (let i = 0; i < 4; i++) {
          if (!prog.kinerja.tw[i]) prog.kinerja.tw[i] = {};
          prog.kinerja.tw[i].realisasi = twVals[i];
        }
        closeModal();
        renderMainTable();
      } else {
        showToast(resp.message || 'Gagal menyimpan realisasi program', true);
      }
    },
    error: function() {
      showToast('Terjadi kesalahan koneksi server.', true);
    }
  });
}

/* Modal Kegiatan */
function openKegiatanModal(pIdx, kIdx) {
  const prog = REALISASI_TREE[pIdx];
  const keg = prog.kegiatan[kIdx];
  CURRENT_EDIT_DATA = { type: 'kegiatan', pIdx: pIdx, kIdx: kIdx, raw: JSON.parse(JSON.stringify(keg)) };

  const currentTW = Math.floor(CURRENT_BULAN_IDX / 3) + 1;
  const kin = keg.kinerja || { uraian: 'Indikator Kegiatan', satuan: '%', tw: [{},{},{},{}] };
  const targetTahunan = sumTWTarget(kin.tw, 4) || 100;

  const html = `
    <div class="modal-header-notika">
      <div class="modal-header-icon"><i class="fa fa-layer-group"></i></div>
      <div class="modal-header-text">
        <h3>REALISASI KINERJA KEGIATAN</h3>
        <p>Pengisian capaian realisasi kinerja kegiatan per triwulan (Target bersifat read-only).</p>
      </div>
      <button class="modal-close-btn" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>
    <div class="modal-body-notika">
      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-info-circle"></i> Informasi Kegiatan</div>
        <div class="info-kv-grid">
          <div class="info-kv-k">Tahun Anggaran</div><div class="info-kv-v">${CURRENT_TAHUN}</div>
          <div class="info-kv-k">Bulan / Triwulan</div><div class="info-kv-v">${BULAN_NAMES[CURRENT_BULAN_IDX]} (Triwulan ${currentTW})</div>
          <div class="info-kv-k">Program</div><div class="info-kv-v"><strong>[${esc(prog.kode)}]</strong> ${esc(prog.nama)}</div>
          <div class="info-kv-k">Kode &amp; Kegiatan</div><div class="info-kv-v"><strong>[${esc(keg.kode)}]</strong> ${esc(keg.nama)}</div>
        </div>
      </div>

      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-tasks"></i> Realisasi Kinerja Kegiatan</div>
        <table class="modal-edit-table">
          <thead>
            <tr>
              <th rowspan="2" style="width: 35px;">No</th>
              <th rowspan="2" style="text-align: left;">Uraian Indikator</th>
              <th rowspan="2" style="width: 70px;">Satuan</th>
              <th rowspan="2" style="width: 80px;">Target<br>Tahunan</th>
              <th colspan="2">Triwulan I</th>
              <th colspan="2">Triwulan II</th>
              <th colspan="2">Triwulan III</th>
              <th colspan="2">Triwulan IV</th>
            </tr>
            <tr>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-weight: bold; color: var(--ui-gray-500);">1</td>
              <td style="text-align: left; font-weight: 500;">${esc(kin.uraian)}</td>
              <td>${esc(kin.satuan)}</td>
              <td class="readonly-val">${fmtNum(targetTahunan)}</td>
              ${renderTWInputCells(0, kin.tw)}
            </tr>
          </tbody>
        </table>
      </div>

      <div class="notice-box">
        <h5><i class="fa fa-shield-alt"></i> Petunjuk Pengisian:</h5>
        Target Kinerja Kegiatan telah ditetapkan dari Target Renaksi. Masukkan angka capaian realisasi pada kolom Realisasi per Triwulan, lalu klik <strong>Simpan Realisasi</strong>.
      </div>
    </div>
    <div class="modal-footer-notika">
      <button class="btn-notika btn-notika-ghost" onclick="closeModal()"><i class="fa fa-arrow-left"></i> Kembali</button>
      <div class="modal-footer-right">
        <button class="btn-notika btn-notika-outline" onclick="openKegiatanModal(${pIdx}, ${kIdx})"><i class="fa fa-undo"></i> Reset</button>
        <button class="btn-notika btn-notika-primary" onclick="saveKegiatanRealisasi()"><i class="fa fa-save"></i> Simpan Realisasi</button>
      </div>
    </div>
  `;

  showModal(html);
}

function saveKegiatanRealisasi() {
  const keg = REALISASI_TREE[CURRENT_EDIT_DATA.pIdx].kegiatan[CURRENT_EDIT_DATA.kIdx];
  const twVals = [];
  for (let i = 0; i < 4; i++) {
    const input = document.querySelector(`.input-tw-real[data-row="0"][data-tw="${i}"]`);
    twVals[i] = input ? parseNum(input.value) : null;
  }

  const payload = {
    level_type: 'kegiatan',
    entity_code: keg.kode,
    tahun: CURRENT_TAHUN,
    id_instansi: CURRENT_INSTANSI_ID,
    tw1: twVals[0],
    tw2: twVals[1],
    tw3: twVals[2],
    tw4: twVals[3]
  };

  $.ajax({
    url: BASE_URL + 'Instansi/SaveRealisasiHierarchy',
    type: 'POST',
    data: payload,
    dataType: 'json',
    success: function(resp) {
      if (resp.status === 'success') {
        showToast(resp.message || 'Realisasi kegiatan berhasil disimpan!');
        for (let i = 0; i < 4; i++) {
          if (!keg.kinerja.tw[i]) keg.kinerja.tw[i] = {};
          keg.kinerja.tw[i].realisasi = twVals[i];
        }
        closeModal();
        renderMainTable();
      } else {
        showToast(resp.message || 'Gagal menyimpan realisasi kegiatan', true);
      }
    },
    error: function() {
      showToast('Terjadi kesalahan koneksi server.', true);
    }
  });
}

/* Modal Sub Kegiatan */
function openSubKegiatanModal(pIdx, kIdx, sIdx) {
  const prog = REALISASI_TREE[pIdx];
  const keg = prog.kegiatan[kIdx];
  const sub = keg.subKegiatan[sIdx];

  CURRENT_EDIT_DATA = {
    type: 'sub',
    pIdx: pIdx,
    kIdx: kIdx,
    sIdx: sIdx,
    headerId: sub.headerId || sub.id,
    kodeSub: sub.kode,
    raw: JSON.parse(JSON.stringify(sub))
  };

  // Muat detail via AJAX untuk memastikan data paling update
  $.ajax({
    url: BASE_URL + 'Instansi/GetSubKegiatanRealisasiDetail',
    type: 'POST',
    data: {
      header_id: sub.headerId || sub.id,
      kode_sub_kegiatan: sub.kode,
      tahun: CURRENT_TAHUN,
      bulan: CURRENT_BULAN_IDX
    },
    dataType: 'json',
    success: function(resp) {
      if (resp.status === 'success') {
        renderSubKegiatanModalContent(resp.data);
      } else {
        showToast(resp.message || 'Gagal memuat detail sub kegiatan', true);
      }
    },
    error: function() {
      showToast('Terjadi kesalahan saat memuat data sub kegiatan.', true);
    }
  });
}

function renderSubKegiatanModalContent(data) {
  const ce = CURRENT_EDIT_DATA;
  const prog = REALISASI_TREE[ce.pIdx];
  const keg = prog.kegiatan[ce.kIdx];
  const sub = keg.subKegiatan[ce.sIdx];
  const h = data.header || sub;

  // Realisasi Anggaran Bulan Terpilih (dari Target Renaksi)
  const m = CURRENT_BULAN_IDX;
  const b = data.bulanan && data.bulanan[m] ? data.bulanan[m] : { bulanNama: BULAN_NAMES[m], target: 0, realisasi: null };
  const tVal = b.target || 0;
  const rVal = (b.realisasi !== null && b.realisasi !== undefined) ? b.realisasi : '';
  
  let bulananHtml = `
    <tr>
      <td style="text-align: left; font-weight: 600; padding-left: 14px;">
        ${b.bulanNama} <span style="font-size:10px; background:#10b981; color:#fff; padding:1px 5px; border-radius:3px; margin-left:4px;">Bulan Dipilih</span>
      </td>
      <td class="readonly-val font-mono" style="font-weight:700; color:#0f766e; text-align:right; padding-right:12px;">${fmtRp(tVal)}</td>
      <td style="padding: 4px;">
        <input type="number" step="any" class="input-real input-bln-real font-mono" data-m="${m}" value="${rVal}" placeholder="0" style="text-align:right; font-weight:600;">
      </td>
      <td class="readonly-val font-mono" id="sub-persen-bln" style="color: var(--ui-primary-dark); font-weight: 700; text-align:right; padding-right:12px;">-</td>
    </tr>
  `;

  // Realisasi Kinerja Output Sub Kegiatan
  let indikatorHtml = '';
  (data.indikators || []).forEach((ind, iIdx) => {
    indikatorHtml += `
      <tr>
        <td style="font-weight: bold; color: var(--ui-gray-500);">${iIdx + 1}</td>
        <td style="text-align: left; font-weight: 500;">${esc(ind.uraian)}</td>
        <td>${esc(ind.satuan)}</td>
        <td class="readonly-val">${fmtNum(ind.targetTahunan)}</td>
        ${renderTWInputCells(iIdx, ind.tw)}
      </tr>
    `;
  });

  const html = `
    <div class="modal-header-notika">
      <div class="modal-header-icon"><i class="fa fa-file-invoice-dollar"></i></div>
      <div class="modal-header-text">
        <h3>REALISASI KINERJA &amp; ANGGARAN SUB KEGIATAN</h3>
        <p>Input realisasi anggaran bulan ${esc(BULAN_NAMES[m])} serta capaian output sub kegiatan per triwulan.</p>
      </div>
      <button class="modal-close-btn" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>
    <div class="modal-body-notika">
      
      <!-- Info Header -->
      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-info-circle"></i> Informasi Sub Kegiatan</div>
        <div class="info-kv-grid">
          <div class="info-kv-k">Tahun Anggaran</div><div class="info-kv-v">${CURRENT_TAHUN}</div>
          <div class="info-kv-k">Perangkat Daerah</div><div class="info-kv-v">${esc(h.nama_perangkat_daerah || sub.perangkatDaerah || '-')}</div>
          <div class="info-kv-k">Sub Unit</div><div class="info-kv-v">${esc(h.nama_sub_unit || sub.subUnit || '-')}</div>
          <div class="info-kv-k">Bidang Urusan</div><div class="info-kv-v">${esc(h.nama_bidang_urusan || sub.bidangUrusan || '-')}</div>
          <div class="info-kv-k">Program</div><div class="info-kv-v"><strong>[${esc(prog.kode)}]</strong> ${esc(prog.nama)}</div>
          <div class="info-kv-k">Kegiatan</div><div class="info-kv-v"><strong>[${esc(keg.kode)}]</strong> ${esc(keg.nama)}</div>
          <div class="info-kv-k">Sub Kegiatan</div><div class="info-kv-v"><strong>[${esc(sub.kode)}]</strong> ${esc(sub.nama)}</div>
        </div>
      </div>

      <!-- Realisasi Anggaran Bulan Terpilih -->
      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-calendar-alt"></i> Target &amp; Realisasi Anggaran Bulan ${esc(BULAN_NAMES[m])}</div>
        <table class="modal-edit-table">
          <thead>
            <tr>
              <th style="text-align: left; padding-left: 14px; width: 150px;">Bulan</th>
              <th style="text-align: right; padding-right: 12px; width: 170px;">Target Anggaran (Rp)</th>
              <th style="width: 180px;">Realisasi Anggaran (Rp)</th>
              <th style="text-align: right; padding-right: 12px; width: 130px;">% Capaian</th>
            </tr>
          </thead>
          <tbody>
            ${bulananHtml}
          </tbody>
        </table>
        <div style="font-size: 11.5px; color: var(--ui-gray-500); margin-top: 6px;">
          *Target Anggaran Bulan ${esc(BULAN_NAMES[m])} bersumber langsung dari penetapan Target Realisasi Anggaran Bulanan Sub Kegiatan pada menu Target Renaksi.
        </div>
      </div>

      <!-- Realisasi Kinerja Output -->
      <div class="info-section-card">
        <div class="info-section-title"><i class="fa fa-tasks"></i> Realisasi Kinerja Output Sub Kegiatan</div>
        <table class="modal-edit-table">
          <thead>
            <tr>
              <th rowspan="2" style="width: 35px;">No</th>
              <th rowspan="2" style="text-align: left;">Uraian Indikator</th>
              <th rowspan="2" style="width: 70px;">Satuan</th>
              <th rowspan="2" style="width: 80px;">Target<br>Tahunan</th>
              <th colspan="2">Triwulan I</th>
              <th colspan="2">Triwulan II</th>
              <th colspan="2">Triwulan III</th>
              <th colspan="2">Triwulan IV</th>
            </tr>
            <tr>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
              <th>Target</th><th>Realisasi</th>
            </tr>
          </thead>
          <tbody>
            ${indikatorHtml}
          </tbody>
        </table>
      </div>

      <div class="notice-box">
        <h5><i class="fa fa-shield-alt"></i> Ketentuan Realisasi:</h5>
        Target Anggaran dan Target Kinerja Triwulan bersifat tetap (read-only). Angka Realisasi Anggaran akan otomatis terakumulasi ke tingkat Kegiatan dan Program.
      </div>

    </div>
    <div class="modal-footer-notika">
      <button class="btn-notika btn-notika-ghost" onclick="closeModal()"><i class="fa fa-arrow-left"></i> Kembali</button>
      <div class="modal-footer-right">
        <button class="btn-notika btn-notika-outline" onclick="openSubKegiatanModal(${ce.pIdx}, ${ce.kIdx}, ${ce.sIdx})"><i class="fa fa-undo"></i> Reset</button>
        <button class="btn-notika btn-notika-primary" onclick="saveSubKegiatanRealisasi(${JSON.stringify(data.indikators).replace(/"/g, '&quot;')})"><i class="fa fa-save"></i> Simpan Realisasi</button>
      </div>
    </div>
  `;

  showModal(html);
  attachMonthlySaldoListeners(tVal);
}

function attachMonthlySaldoListeners(targetBulan) {
  function recalcSaldo() {
    const m = CURRENT_BULAN_IDX;
    const inp = document.querySelector(`.input-bln-real[data-m="${m}"]`);
    const rVal = inp ? parseNum(inp.value) : null;
    const pctCell = document.getElementById('sub-persen-bln');
    if (pctCell) {
      if (targetBulan > 0 && rVal !== null) {
        pctCell.textContent = ((rVal / targetBulan) * 100).toFixed(2) + '%';
      } else {
        pctCell.textContent = '-';
      }
    }
  }

  document.querySelectorAll('.input-bln-real').forEach(inp => {
    inp.addEventListener('input', recalcSaldo);
  });
  recalcSaldo();
}

function saveSubKegiatanRealisasi(originalIndikators) {
  const ce = CURRENT_EDIT_DATA;
  const monthKeys = ['jan','feb','mar','apr','mei','jun','jul','ags','sep','okt','nov','des'];
  
  // Realisasi Bulanan
  const bulananReal = {};
  monthKeys.forEach((k, idx) => {
    const inp = document.querySelector(`.input-bln-real[data-m="${idx}"]`);
    if (inp) {
      bulananReal[k] = inp.value !== '' ? parseNum(inp.value) : null;
    } else {
      // Pertahankan nilai bulan setelah bulan aktif dari state jika ada
      const sub = REALISASI_TREE[ce.pIdx].kegiatan[ce.kIdx].subKegiatan[ce.sIdx];
      bulananReal[k] = (sub.bulanan && sub.bulanan[idx]) ? sub.bulanan[idx].realisasi : null;
    }
  });

  // Realisasi Indikators
  const indikatorsReal = [];
  (originalIndikators || []).forEach((ind, iIdx) => {
    const tw1 = parseNum(document.querySelector(`.input-tw-real[data-row="${iIdx}"][data-tw="0"]`)?.value);
    const tw2 = parseNum(document.querySelector(`.input-tw-real[data-row="${iIdx}"][data-tw="1"]`)?.value);
    const tw3 = parseNum(document.querySelector(`.input-tw-real[data-row="${iIdx}"][data-tw="2"]`)?.value);
    const tw4 = parseNum(document.querySelector(`.input-tw-real[data-row="${iIdx}"][data-tw="3"]`)?.value);
    indikatorsReal.push({
      indikator_id: ind.id,
      tw1: tw1,
      tw2: tw2,
      tw3: tw3,
      tw4: tw4
    });
  });

  const payload = {
    header_id: ce.headerId,
    kode_sub_kegiatan: ce.kodeSub,
    tahun: CURRENT_TAHUN,
    id_instansi: CURRENT_INSTANSI_ID,
    bulanan_realisasi: bulananReal,
    indikators_realisasi: indikatorsReal
  };

  $.ajax({
    url: BASE_URL + 'Instansi/SaveRealisasiSubKegiatan',
    type: 'POST',
    data: payload,
    dataType: 'json',
    success: function(resp) {
      if (resp.status === 'success') {
        showToast(resp.message || 'Realisasi sub kegiatan berhasil disimpan!');
        
        // Update local memory state
        const sub = REALISASI_TREE[ce.pIdx].kegiatan[ce.kIdx].subKegiatan[ce.sIdx];
        if (!sub.bulanan) sub.bulanan = [];
        monthKeys.forEach((k, idx) => {
          if (!sub.bulanan[idx]) sub.bulanan[idx] = { target: 0, realisasi: null };
          sub.bulanan[idx].realisasi = bulananReal[k];
        });

        (indikatorsReal || []).forEach((ir, iIdx) => {
          if (sub.indikator && sub.indikator[iIdx]) {
            sub.indikator[iIdx].tw[0].realisasi = ir.tw1;
            sub.indikator[iIdx].tw[1].realisasi = ir.tw2;
            sub.indikator[iIdx].tw[2].realisasi = ir.tw3;
            sub.indikator[iIdx].tw[3].realisasi = ir.tw4;
          }
        });

        closeModal();
        renderMainTable();
      } else {
        showToast(resp.message || 'Gagal menyimpan realisasi sub kegiatan', true);
      }
    },
    error: function() {
      showToast('Terjadi kesalahan koneksi server.', true);
    }
  });
}

/* Quick Search in Table */
document.getElementById('tableSearch').addEventListener('input', function(e) {
  const query = e.target.value.toLowerCase().trim();
  const rows = document.querySelectorAll('#realisasiTbody tr');
  rows.forEach(tr => {
    const text = tr.textContent.toLowerCase();
    tr.style.display = (query === '' || text.includes(query)) ? '' : 'none';
  });
});

/* Close modal on ESC key or click outside */
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeModal();
});
document.getElementById('modalOverlay').addEventListener('click', function(e) {
  if (e.target.id === 'modalOverlay') closeModal();
});

/* Init */
document.addEventListener('DOMContentLoaded', function() {
  renderMainTable();
});
</script>
