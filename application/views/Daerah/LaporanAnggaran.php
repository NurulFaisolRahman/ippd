<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View Laporan Anggaran (Rekapitulasi Realisasi Anggaran)
 * Desain dan Style Notika Teal (#00c292) - Selaras dengan menu DPA & Target Renaksi
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$bulanNames = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$currentBulanSampai = isset($BulanSampai) ? (int)$BulanSampai : 7; // Default: Agustus
$periodeText = "Januari - " . $bulanNames[$currentBulanSampai] . " " . $TahunAktif;

$namaInstansiAktif = 'SEMUA PERANGKAT DAERAH';
if (!empty($FilterInstansi)) {
    foreach ($ListInstansi as $inst) {
        if ($inst['id'] == $FilterInstansi) {
            $namaInstansiAktif = strtoupper($inst['nama']);
            break;
        }
    }
}

$totMurni = isset($Summary['total_murni']) ? $Summary['total_murni'] : 0;
$totPerubahan = isset($Summary['total_perubahan']) ? $Summary['total_perubahan'] : 0;
$totRealisasi = isset($Summary['total_realisasi']) ? $Summary['total_realisasi'] : 0;
$totSisa = isset($Summary['total_sisa']) ? $Summary['total_sisa'] : 0;
$persenCapaian = isset($Summary['persen_capaian']) ? $Summary['persen_capaian'] : 0;
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
  font-size: 13px;
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
.laporan-header-card {
  background: linear-gradient(135deg, #00c292 0%, #008f6b 100%);
  border-radius: var(--ui-radius);
  padding: 22px 26px;
  color: #ffffff;
  box-shadow: var(--ui-shadow-md);
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
}

.laporan-header-card::after {
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

.laporan-header-title {
  font-size: 20px;
  font-weight: 800;
  letter-spacing: -0.02em;
  margin: 0 0 2px;
  display: flex;
  align-items: center;
  gap: 10px;
  text-transform: uppercase;
}

.laporan-header-sub {
  font-size: 14px;
  font-weight: 700;
  opacity: 0.95;
  margin: 0 0 4px;
  letter-spacing: 0.5px;
}

.laporan-header-desc {
  font-size: 12.5px;
  opacity: 0.88;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
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
  font-size: 13.5px;
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
  grid-template-columns: 150px 250px 1.5fr auto;
  gap: 12px;
  align-items: flex-end;
}

@media (max-width: 991px) {
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
  padding: 14px 18px;
  border-left: 4px solid var(--ui-primary);
  box-shadow: var(--ui-shadow-sm);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.stat-box.highlight {
  background: linear-gradient(135deg, #00c292 0%, #00a87e 100%);
  color: #ffffff;
  border-left-color: #007a5c;
}

.stat-box.highlight .stat-label {
  color: rgba(255,255,255,0.9);
}

.stat-box.highlight .stat-value {
  color: #ffffff;
  font-size: 22px;
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

table.laporan-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  font-size: 12px;
  color: var(--ui-gray-700);
  min-width: 1200px;
}

table.laporan-table thead th {
  background-color: var(--ui-gray-100);
  color: var(--ui-gray-700);
  font-weight: 700;
  padding: 8px 8px;
  border: 1px solid var(--ui-gray-200);
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
}

table.laporan-table thead tr:first-child th {
  background-color: #f8fafc;
  color: var(--ui-gray-900);
  font-size: 12px;
}

table.laporan-table thead tr:last-child th {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  background-color: #f1f5f9;
}

table.laporan-table tbody td {
  padding: 6px 8px;
  border: 1px solid var(--ui-gray-200);
  vertical-align: middle;
}

table.laporan-table tbody tr:nth-child(even) {
  background-color: #fcfdfe;
}

table.laporan-table tbody tr:hover {
  background-color: #f0fdf9;
}

table.laporan-table tfoot td {
  padding: 10px 8px;
  border: 1px solid var(--ui-gray-300);
  background-color: #e6f9f4;
  font-weight: 800;
  color: var(--ui-gray-900);
}

.num-cell {
  text-align: right;
  white-space: nowrap;
  font-family: 'Roboto Mono', monospace;
  font-size: 11.8px;
}

.center-cell {
  text-align: center;
  white-space: nowrap;
}

/* Badges for +/- Status */
.badge-status {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  border-radius: 4px;
  font-weight: 800;
  font-size: 12px;
}

.badge-plus {
  background-color: #dcfce7;
  color: #15803d;
  border: 1px solid #bbf7d0;
}

.badge-minus {
  background-color: #fee2e2;
  color: #b91c1c;
  border: 1px solid #fecaca;
}

/* Action Buttons */
.btn-action-edit {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
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
  transform: scale(1.05);
}

.btn-notika {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 14px;
  font-size: 12.5px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
  border: 1px solid transparent;
  transition: all 0.15s ease;
  text-decoration: none !important;
  white-space: nowrap;
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

/* Modals */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(15, 23, 42, 0.65);
  display: none;
  align-items: center;
  justify-content: center;
  padding: 24px 16px;
  z-index: 200000 !important;
  overflow-y: auto;
  backdrop-filter: blur(4px);
}

.modal-overlay.open {
  display: flex !important;
}

.modal-container {
  background: #ffffff;
  border-radius: 12px;
  max-width: 650px;
  max-height: calc(100vh - 48px);
  width: 100%;
  box-shadow: 0 25px 60px rgba(15, 23, 42, 0.4);
  animation: modalPop 0.18s ease-out;
  margin: auto;
  position: relative;
  z-index: 200001;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

@keyframes modalPop {
  from { opacity: 0; transform: translateY(12px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

.modal-header-notika {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 16px 22px;
  border-bottom: 1px solid var(--ui-gray-200);
  background: #ffffff;
  border-radius: 12px 12px 0 0;
}

.modal-header-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: var(--ui-primary-light);
  color: var(--ui-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 17px;
  flex-shrink: 0;
}

.modal-header-text h3 {
  margin: 0;
  font-size: 15px;
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
  padding: 18px 22px;
}

.modal-footer-notika {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 14px 22px;
  border-top: 1px solid var(--ui-gray-200);
  background-color: var(--ui-gray-50);
  border-radius: 0 0 12px 12px;
}

.form-group-modal {
  margin-bottom: 14px;
}

.form-group-modal label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: var(--ui-gray-700);
  margin-bottom: 4px;
  text-transform: uppercase;
}

.form-control-modal {
  width: 100%;
  height: 38px;
  padding: 6px 12px;
  font-size: 13px;
  font-weight: 600;
  border: 1px solid var(--ui-gray-300);
  border-radius: 6px;
  outline: none;
  transition: border 0.15s, box-shadow 0.15s;
}

.form-control-modal:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.input-group-rp {
  display: flex;
  align-items: stretch;
  width: 100%;
}

.input-rp-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0 12px;
  background-color: var(--ui-gray-100);
  border: 1px solid var(--ui-gray-300);
  border-right: none;
  border-radius: 6px 0 0 6px;
  color: var(--ui-gray-600);
  font-weight: 700;
  font-size: 13px;
}

.input-group-rp .form-control-modal {
  border-radius: 0 6px 6px 0 !important;
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

/* Print Styles */
@media print {
  .navbar, .sidebar-wrapper, .filter-row, .btn-action-edit, .notika-card-header .btn-notika, .modal-overlay, .notika-toast-box {
    display: none !important;
  }
  .main-content {
    margin-left: 0 !important;
    padding: 0 !important;
  }
  .laporan-header-card {
    background: #008f6b !important;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }
  table.laporan-table {
    font-size: 9.5px !important;
    min-width: 100% !important;
  }
  table.laporan-table th, table.laporan-table td {
    padding: 3px 4px !important;
  }
}
</style>

<div class="main-content">
  <div class="app-container">

    <!-- Header Card -->
    <div class="laporan-header-card">
      <div class="laporan-header-title">
        <i class="fa fa-file-invoice-dollar"></i>
        Rekapitulasi Realisasi Anggaran
      </div>
      <div class="laporan-header-sub">
        <?=htmlspecialchars($namaInstansiAktif)?>
      </div>
      <div class="laporan-header-desc">
        <i class="fa fa-calendar-alt"></i> <strong>PERIODE: <?=$periodeText?></strong>
      </div>
    </div>

    <!-- Filter Wilayah Top (Sebelum Login & Saat Login Sebagai Daerah) -->
    <?php if (!$IsLoggedIn || !empty($IsDaerah)) { 
      $provKodeCurrent = !empty($KodeWilayah) ? substr($KodeWilayah, 0, 2) : '';
      $ListKabKotaTop = [];
      if (!empty($provKodeCurrent)) {
          $ListKabKotaTop = $this->db
              ->select('Kode, Nama')
              ->from('kodewilayah')
              ->where('Kode LIKE', $provKodeCurrent . '.%')
              ->where('LENGTH(REPLACE(Kode, ".", "")) = 4', null, false)
              ->order_by('Nama', 'ASC')
              ->get()
              ->result_array();
      }
    ?>
      <div class="notika-card" style="margin-bottom: 20px;">
        <div class="notika-card-header">
          <div class="notika-card-title">
            <i class="fa fa-filter"></i> <?= empty($IsLoggedIn) ? 'Filter Wilayah &amp; Perangkat Daerah' : 'Filter Perangkat Daerah' ?>
          </div>
        </div>
        <div class="notika-card-body">
          <div style="display:flex; flex-wrap:wrap; align-items:flex-end; gap:12px;">
            <?php if (empty($IsLoggedIn)): ?>
              <div style="flex:1; min-width:180px;">
                <label class="filter-label">Provinsi</label>
                <select id="selProvinsiTop" class="filter-select">
                  <option value="">Pilih Provinsi</option>
                  <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                    <option value="<?= html_escape($prov['Kode']) ?>"
                      <?= (!empty($provKodeCurrent) && $provKodeCurrent==$prov['Kode']) ? 'selected' : '' ?>>
                      <?= html_escape($prov['Nama']) ?>
                    </option>
                  <?php } } ?>
                </select>
              </div>

              <div style="flex:1; min-width:180px;">
                <label class="filter-label">Kabupaten / Kota</label>
                <select id="selKabKotaTop" class="filter-select">
                  <option value="">Pilih Kab/Kota</option>
                  <?php if (!empty($ListKabKotaTop)) { foreach ($ListKabKotaTop as $kab) { ?>
                    <option value="<?= html_escape($kab['Kode']) ?>" <?= (!empty($KodeWilayah) && $KodeWilayah == $kab['Kode']) ? 'selected' : '' ?>>
                      <?= html_escape($kab['Nama']) ?>
                    </option>
                  <?php }} ?>
                </select>
              </div>
            <?php else: ?>
              <input type="hidden" id="selProvinsiTop" value="<?= !empty($provKodeCurrent) ? $provKodeCurrent : substr($KodeWilayah, 0, 2) ?>">
              <input type="hidden" id="selKabKotaTop" value="<?= !empty($KodeWilayah) ? $KodeWilayah : '' ?>">
            <?php endif; ?>

            <div id="grpInstansiTop" style="flex:1.2; min-width:220px; <?= (!empty($IsLoggedIn) || !empty($KodeWilayah)) ? '' : 'display:none;' ?>">
              <label class="filter-label">Perangkat Daerah / Instansi</label>
              <select id="selInstansiTop" class="filter-select">
                <option value="">-- Semua Perangkat Daerah --</option>
                <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
                  <option value="<?= $ins['id'] ?>" <?= (!empty($FilterInstansi) && $FilterInstansi == $ins['id']) ? 'selected' : '' ?>>
                    <?= html_escape($ins['nama']) ?>
                  </option>
                <?php }} ?>
              </select>
            </div>

            <div style="margin-top:auto;">
              <button type="button" class="btn-notika btn-notika-primary" id="btnFilterWilayahTop" style="height:38px;">
                <i class="fa fa-search"></i> <?= empty($IsLoggedIn) ? 'Terapkan Wilayah' : 'Terapkan Filter' ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- Parameter & Filter Card -->
    <div class="notika-card">
      <div class="notika-card-header">
        <div class="notika-card-title">
          <i class="fa fa-filter"></i> Parameter Laporan &amp; Filter
        </div>
        <div style="display: flex; gap: 8px;">
          <button class="btn-notika btn-notika-outline" onclick="window.print()" title="Cetak Laporan">
            <i class="fa fa-print"></i> Cetak / PDF
          </button>
          <?php if (!empty($IsRole4)): ?>
            <button class="btn-notika btn-notika-outline" onclick="syncWithRenaksi()" title="Sinkronkan dengan Realisasi Renaksi">
              <i class="fa fa-sync-alt"></i> Sinkron Renaksi
            </button>
          <?php endif; ?>
        </div>
      </div>
      <div class="notika-card-body">
        <form id="filterLaporanForm" method="GET" action="<?=base_url('Instansi/LaporanAnggaran')?>">
          <div class="filter-row">
            
            <!-- Tahun -->
            <div class="filter-group">
              <label class="filter-label">Tahun</label>
              <select name="tahun" id="filterTahun" class="filter-select" onchange="this.form.submit()">
                <?php foreach ($ListTahun as $thn): ?>
                  <option value="<?=$thn?>" <?=$thn == $TahunAktif ? 'selected' : ''?>><?=$thn?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <input type="hidden" name="instansi_id" id="filterInstansi" value="<?=$FilterInstansi?>">

            <!-- Periode Bulan Sampai -->
            <div class="filter-group">
              <label class="filter-label">Periode s.d. Bulan</label>
              <select name="bulan_sampai" id="filterBulanSampai" class="filter-select" onchange="this.form.submit()">
                <?php foreach ($bulanNames as $idx => $bName): ?>
                  <option value="<?=$idx?>" <?=$idx == $currentBulanSampai ? 'selected' : ''?>>Januari - <?=$bName?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Search Input -->
            <div class="filter-group">
              <label class="filter-label">Pencarian Cepat</label>
              <input type="text" id="laporanSearch" class="filter-input" placeholder="Ketik kode / nama sub kegiatan...">
            </div>

            <div>
              <button type="submit" class="btn-notika btn-notika-primary" style="height: 38px;">
                <i class="fa fa-search"></i> Tampilkan
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>

    <!-- Summary Cards (Matching PDF Header Box) -->
    <div class="stats-grid">
      <div class="stat-box">
        <div>
          <div class="stat-label">Total Anggaran Awal (Murni)</div>
          <div class="stat-value num-font" id="stat-total-murni"><?='Rp ' . number_format($totMurni, 0, ',', '.')?></div>
        </div>
        <i class="fa fa-wallet fa-2x" style="color: var(--ui-gray-300);"></i>
      </div>

      <div class="stat-box">
        <div>
          <div class="stat-label">Total Anggaran Perubahan</div>
          <div class="stat-value num-font" id="stat-total-perubahan"><?='Rp ' . number_format($totPerubahan, 0, ',', '.')?></div>
        </div>
        <i class="fa fa-exchange-alt fa-2x" style="color: var(--ui-primary-border);"></i>
      </div>

      <div class="stat-box">
        <div>
          <div class="stat-label">Total Realisasi s.d. <?=$bulanNames[$currentBulanSampai]?></div>
          <div class="stat-value num-font" id="stat-total-realisasi" style="color: var(--ui-primary-dark);"><?='Rp ' . number_format($totRealisasi, 0, ',', '.')?></div>
        </div>
        <i class="fa fa-coins fa-2x" style="color: var(--ui-primary-border);"></i>
      </div>

      <div class="stat-box highlight">
        <div>
          <div class="stat-label">Capaian Anggaran</div>
          <div class="stat-value num-font" id="stat-capaian-persen"><?=number_format($persenCapaian, 2)?>%</div>
        </div>
        <i class="fa fa-chart-pie fa-2x" style="color: rgba(255,255,255,0.75);"></i>
      </div>
    </div>

    <!-- Main Table Card -->
    <div class="notika-card">
      <div class="notika-card-header">
        <div class="notika-card-title">
          <i class="fa fa-table"></i> Rincian Rekapitulasi Realisasi Anggaran per Sub Kegiatan
        </div>
        <div style="font-size: 12px; color: var(--ui-gray-500); font-weight: 600;">
          Total Sub Kegiatan: <strong><?=count($Items)?></strong> baris
        </div>
      </div>
      <div class="notika-card-body" style="padding: 0;">
        <div class="table-responsive-notika">
          <table class="laporan-table" id="laporanTable">
            <thead>
              <tr>
                <th rowspan="2" style="width: 45px;">No</th>
                <th rowspan="2" style="min-width: 155px; text-align: left; padding-left: 10px;">Kode Rek</th>
                <th rowspan="2" style="min-width: 320px; text-align: left; padding-left: 10px;">Sub Kegiatan</th>
                <th colspan="3" style="background-color: #f0fdf9; color: #007a5c; border-bottom: 1px solid var(--ui-gray-300);">Anggaran (Rp)</th>
                <th colspan="1" style="background-color: #eff6ff; color: #1d4ed8; border-bottom: 1px solid var(--ui-gray-300);">Realisasi Anggaran</th>
                <th colspan="2" style="background-color: #fffbeb; color: #b45309; border-bottom: 1px solid var(--ui-gray-300);">Capaian Akhir</th>
              </tr>
              <tr>
                <th style="min-width: 125px;">Murni</th>
                <th style="min-width: 125px;">Perubahan</th>
                <th style="width: 40px;">+/-</th>
                <th style="min-width: 125px;">Total (Rp)</th>
                <th style="min-width: 125px;">Sisa (Rp)</th>
                <th style="width: 70px;">%</th>
              </tr>
            </thead>
            <tbody id="laporanTbody">
              <?php if (!empty($Items)): ?>
                <?php foreach ($Items as $idx => $row): ?>
                  <tr data-id="<?=$row['id']?>">
                    <td class="center-cell" style="font-weight: 600; color: var(--ui-gray-500);"><?=$row['urutan'] ?: ($idx + 1)?></td>
                    <td class="num-font" style="font-weight: 600; color: var(--ui-gray-900); padding-left: 10px;">
                      <?=htmlspecialchars(str_replace('.', ' ', $row['kode_rekening']))?>
                    </td>
                    <td style="font-weight: 500; color: var(--ui-gray-900); padding-left: 10px;">
                      <?=htmlspecialchars($row['nama_sub_kegiatan'])?>
                    </td>
                    <td class="num-cell"><?='Rp ' . number_format($row['anggaran_murni'], 0, ',', '.')?></td>
                    <td class="num-cell" style="font-weight: 600;"><?='Rp ' . number_format($row['anggaran_perubahan'], 0, ',', '.')?></td>
                    <td class="center-cell">
                      <?php if ($row['perubahan_status'] === '+'): ?>
                        <span class="badge-status badge-plus">+</span>
                      <?php else: ?>
                        <span class="badge-status badge-minus">-</span>
                      <?php endif; ?>
                    </td>
                    <td class="num-cell" style="color: #1d4ed8; font-weight: 600;">
                      <?='Rp ' . number_format($row['realisasi_anggaran'], 0, ',', '.')?>
                    </td>
                    <td class="num-cell" style="color: #b91c1c; font-weight: 600;">
                      <?='Rp ' . number_format($row['sisa_anggaran'], 0, ',', '.')?>
                    </td>
                    <td class="num-cell" style="font-weight: 700;">
                      <?=number_format($row['persen_capaian'], 2)?>%
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="9" class="center-cell" style="padding: 40px; color: var(--ui-gray-400);">
                    <i class="fa fa-folder-open fa-3x" style="margin-bottom: 10px;"></i><br>
                    <?= (empty($IsLoggedIn) && empty($KodeWilayah)) ? 'Silakan pilih Filter Wilayah & Perangkat Daerah di atas terlebih dahulu untuk menampilkan data.' : 'Belum ada data Rekapitulasi Realisasi Anggaran.' ?>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" style="text-align: right; padding-right: 14px; font-size: 13px;">JUMLAH TOTAL</td>
                <td class="num-cell" style="font-size: 12.5px;"><?='Rp ' . number_format($totMurni, 0, ',', '.')?></td>
                <td class="num-cell" style="font-size: 12.5px;"><?='Rp ' . number_format($totPerubahan, 0, ',', '.')?></td>
                <td class="center-cell">
                  <span class="badge-status badge-plus">+</span>
                </td>
                <td class="num-cell" style="font-size: 12.5px; color: #1d4ed8;">
                  <?='Rp ' . number_format($totRealisasi, 0, ',', '.')?>
                </td>
                <td class="num-cell" style="font-size: 12.5px; color: #b91c1c;">
                  <?='Rp ' . number_format($totSisa, 0, ',', '.')?>
                </td>
                <td class="num-cell" style="font-size: 12.5px;">
                  <?=number_format($persenCapaian, 2)?>%
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Toast Box Container -->
<div class="notika-toast-box" id="toastBox"></div>

<script>
"use strict";

const BASE_URL = "<?=base_url()?>";
const CURRENT_TAHUN = <?=json_encode($TahunAktif)?>;
const CURRENT_INSTANSI_ID = <?=json_encode($FilterInstansi)?>;
const CURRENT_BULAN_SAMPAI = <?=json_encode($currentBulanSampai)?>;

function showToast(message, isError = false) {
  const box = document.getElementById('toastBox');
  const toast = document.createElement('div');
  toast.className = 'notika-toast' + (isError ? ' toast-error' : '');
  toast.innerHTML = '<i class="fa ' + (isError ? 'fa-exclamation-circle text-danger' : 'fa-check-circle text-success') + '"></i> <span>' + message + '</span>';
  box.appendChild(toast);
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 0.3s';
    setTimeout(() => toast.remove(), 300);
  }, 3500);
}

function syncWithRenaksi() {
  if (!confirm('Apakah Anda ingin menyinkronkan data realisasi akumulasi dari menu Realisasi Renaksi ke tabel Laporan Anggaran?')) {
    return;
  }

  $.ajax({
    url: BASE_URL + 'Instansi/SyncLaporanAnggaran',
    type: 'POST',
    data: {
      tahun: CURRENT_TAHUN,
      instansi_id: CURRENT_INSTANSI_ID,
      bulan_sampai: CURRENT_BULAN_SAMPAI
    },
    dataType: 'json',
    success: function(resp) {
      if (resp.status === 'success') {
        showToast(resp.message);
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(resp.message || 'Gagal sinkronisasi data', true);
      }
    },
    error: function() {
      showToast('Terjadi kesalahan koneksi server.', true);
    }
  });
}

/* ---------------- Top Wilayah Filter (Before Login) ---------------- */
$(function() {
  var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var BaseURL = '<?= base_url() ?>';
  var cKodeWilayah = '<?= !empty($KodeWilayah) ? $KodeWilayah : "" ?>';
  var cInstansiId = '<?= !empty($FilterInstansi) ? $FilterInstansi : (!empty($InstansiId) ? $InstansiId : "") ?>';

  function loadKabKotaTop(provKode, selectedKabKode, callback) {
    if (!provKode) {
      $('#selKabKotaTop').html('<option value="">Pilih Kab/Kota</option>');
      $('#grpInstansiTop').hide();
      return;
    }
    $.ajax({
      url: BaseURL + 'Instansi/GetListKabKota',
      type: 'POST',
      data: { Kode: provKode, [CSRF_NAME]: CSRF_TOKEN },
      dataType: 'json',
      beforeSend: function() {
        $('#selKabKotaTop').prop('disabled', true).html('<option value="">Memuat Kab/Kota...</option>');
      },
      success: function(data) {
        var html = '<option value="">Pilih Kab/Kota</option>';
        if (data && data.length > 0) {
          for (var i = 0; i < data.length; i++) {
            var sel = (selectedKabKode && selectedKabKode == data[i].Kode) ? 'selected' : '';
            html += '<option value="' + data[i].Kode + '" ' + sel + '>' + data[i].Nama + '</option>';
          }
        }
        $('#selKabKotaTop').html(html).prop('disabled', false);
        if (callback) callback();
      },
      error: function() {
        $('#selKabKotaTop').html('<option value="">Gagal memuat data</option>').prop('disabled', false);
      }
    });
  }

  function loadInstansiTop(kabKode, selectedInstansiId) {
    if (!kabKode) {
      $('#grpInstansiTop').hide();
      $('#selInstansiTop').html('<option value="">-- Semua Perangkat Daerah --</option>');
      return;
    }
    $.ajax({
      url: BaseURL + 'Instansi/GetListInstansiLevel4',
      type: 'POST',
      data: { kode_wilayah: kabKode, [CSRF_NAME]: CSRF_TOKEN },
      dataType: 'json',
      beforeSend: function() {
        $('#selInstansiTop').html('<option value="">Memuat Instansi...</option>');
        $('#grpInstansiTop').show();
      },
      success: function(data) {
        var html = '<option value="">-- Semua Perangkat Daerah --</option>';
        if (data && data.length > 0) {
          for (var i = 0; i < data.length; i++) {
            var sel = (selectedInstansiId && selectedInstansiId == data[i].id) ? 'selected' : '';
            html += '<option value="' + data[i].id + '" ' + sel + '>' + data[i].nama + '</option>';
          }
        }
        $('#selInstansiTop').html(html);
        $('#grpInstansiTop').show();
      },
      error: function() {
        $('#selInstansiTop').html('<option value="">-- Gagal memuat instansi --</option>');
      }
    });
  }

  $('#selProvinsiTop').change(function() {
    var prov = $(this).val();
    loadKabKotaTop(prov, '');
  });

  $('#selKabKotaTop').change(function() {
    var kab = $(this).val();
    loadInstansiTop(kab, '');
  });

  if (cKodeWilayah) {
    var provKode = cKodeWilayah.substring(0, 2);
    loadKabKotaTop(provKode, cKodeWilayah, function() {
      loadInstansiTop(cKodeWilayah, cInstansiId);
    });
  }

  $('#btnFilterWilayahTop').click(function() {
    var prov = $('#selProvinsiTop').val();
    var kab = $('#selKabKotaTop').val();
    var inst = $('#selInstansiTop').val();

    if (!prov) {
      alert('Mohon pilih Provinsi');
      return;
    }
    if (!kab) {
      alert('Mohon pilih Kabupaten/Kota');
      return;
    }

    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
      url: BaseURL + 'Instansi/SetTempKodeWilayah',
      type: 'POST',
      data: {
        KodeWilayah: kab,
        InstansiId: inst,
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res) {
        if (res.trim() === '1') {
          var url = window.location.pathname;
          var queryParams = [];
          if (inst) {
            queryParams.push('instansi_id=' + encodeURIComponent(inst));
          }
          if (queryParams.length > 0) {
            url += '?' + queryParams.join('&');
          }
          window.location.href = url;
        } else {
          alert(res || 'Gagal mengatur filter wilayah');
          btn.prop('disabled', false).html('<i class="fa fa-search"></i> Terapkan Wilayah');
        }
      },
      error: function() {
        alert('Terjadi kesalahan koneksi ke server');
        btn.prop('disabled', false).html('<i class="fa fa-search"></i> Terapkan Wilayah');
      }
    });
  });
});
</script>
