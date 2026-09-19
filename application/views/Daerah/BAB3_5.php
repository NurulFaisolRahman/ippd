<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: BAB 3.5 Penghargaan Daerah & Rekapitulasi OPD
 * Template Notika - Selaras dengan Tema Hijau Notika & Desain IPPD
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2025;
$filterInstansi = isset($FilterInstansi) ? $FilterInstansi : '';
$filterTingkat = isset($FilterTingkat) ? $FilterTingkat : '';
$items = isset($Items) ? $Items : [];
$stats = isset($Stats) ? $Stats : ['total' => 0, 'nasional' => 0, 'provinsi' => 0, 'total_opd' => 0];
$isRole4 = !empty($IsRole4);
$namaWilayahTampil = !empty($NamaWilayah) ? $NamaWilayah : 'Pemerintah Daerah';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
:root {
  --notika-primary: #00c292;
  --notika-primary-hover: #00a87e;
  --notika-primary-light: #e8f8f5;
  --notika-primary-border: #b2dfdb;
  --notika-primary-dark: #007a5a;
  
  --ui-blue: #2563eb;
  --ui-blue-light: #eff6ff;
  --ui-red: #ef4444;
  --ui-red-light: #fee2e2;
  --ui-amber: #f59e0b;
  --ui-amber-light: #fef3c7;
  --ui-purple: #7c3aed;
  --ui-purple-light: #f3e8ff;
  
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
  font-size: 14px;
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
  margin-bottom: 22px;
}
.page-badge-wrapper {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 10px;
}
.page-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--notika-primary-light);
  color: var(--notika-primary-dark);
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 5px 12px;
  border-radius: 999px;
  border: 1px solid var(--notika-primary-border);
}
.page-badge.badge-role-opd {
  background: #e8f8f5;
  color: #007a5a;
  border: 1px solid #b2dfdb;
}
.page-badge.badge-role-daerah {
  background: #f0fdf4;
  color: #166534;
  border: 1px solid #bbf7d0;
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
  line-height: 1.55;
}

/* Stats Cards Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-bottom: 22px;
}
.stat-card {
  background: #ffffff;
  border-radius: var(--radius-md);
  border: 1px solid var(--ui-border);
  padding: 16px 18px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: var(--shadow-card);
  transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(15,23,42,0.08);
}
.stat-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.stat-icon.green-notika {
  background: var(--notika-primary-light);
  color: var(--notika-primary);
}
.stat-icon.blue {
  background: #eff6ff;
  color: #2563eb;
}
.stat-icon.purple {
  background: #f3e8ff;
  color: #7c3aed;
}
.stat-icon.teal {
  background: #d1fae5;
  color: #059669;
}
.stat-info .stat-num {
  font-size: 24px;
  font-weight: 800;
  color: var(--ui-dark);
  line-height: 1.2;
}
.stat-info .stat-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--ui-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

/* Filter Card */
.filter-card {
  background: var(--ui-card-bg);
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  padding: 18px 22px;
  margin-bottom: 22px;
}
.filter-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 14px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--ui-border-light);
}
.filter-title {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--ui-dark);
  display: flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.filter-title i {
  color: var(--notika-primary);
  font-size: 15px;
}
.filter-grid {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-end;
  gap: 14px;
  justify-content: space-between;
}
.filter-left {
  display: flex;
  align-items: flex-end;
  gap: 12px;
  flex-wrap: wrap;
  flex: 1;
}
.filter-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
  min-width: 150px;
}
.filter-group label {
  font-size: 12px;
  font-weight: 700;
  color: var(--ui-dark);
  letter-spacing: 0.02em;
  text-transform: uppercase;
}
.filter-select, .filter-input {
  height: 38px;
  padding: 0 12px;
  font-size: 13px;
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-sm);
  background: #ffffff;
  color: var(--ui-dark);
  font-weight: 500;
  outline: none;
  transition: all 0.2s;
  width: 100%;
}
.filter-select:focus, .filter-input:focus {
  border-color: var(--notika-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.filter-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}
.btn-primary-notika {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--notika-primary);
  color: #fff;
  border: none;
  padding: 9px 18px;
  font-size: 13px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  cursor: pointer;
  transition: all 0.2s ease;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.35);
}
.btn-primary-notika:hover {
  background: var(--notika-primary-hover);
  transform: translateY(-1px);
  box-shadow: 0 4px 10px rgba(0, 194, 146, 0.45);
}
.btn-outline-action {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #ffffff;
  color: var(--ui-text-main);
  border: 1px solid var(--ui-border);
  padding: 8px 14px;
  font-size: 13px;
  font-weight: 600;
  border-radius: var(--radius-sm);
  cursor: pointer;
  transition: all 0.15s ease;
}
.btn-outline-action:hover {
  background: #f8fafc;
  border-color: #cbd5e1;
}

/* =======================================================
   TABLE DESIGN - TEMA HIJAU NOTIKA
   ======================================================= */
.table-card {
  background: var(--ui-card-bg);
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-card);
  overflow: hidden;
}
.table-header-bar {
  padding: 14px 20px;
  background: #ffffff;
  border-bottom: 1px solid var(--ui-border-light);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
}
.table-header-title {
  font-size: 15px;
  font-weight: 800;
  color: var(--ui-dark);
  display: flex;
  align-items: center;
  gap: 8px;
}
.table-header-title i {
  color: var(--notika-primary);
}

.table-wrapper {
  overflow-x: auto;
  width: 100%;
}

/* Tabel Penghargaan dengan Header Hijau Notika */
.table-penghargaan {
  width: 100%;
  border-collapse: collapse;
  min-width: 900px;
}

.table-penghargaan thead tr th {
  background-color: var(--notika-primary) !important;
  color: #ffffff !important;
  font-size: 13px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 13px 16px;
  border: 1px solid var(--notika-primary-hover) !important;
  text-align: center;
  vertical-align: middle;
}

.table-penghargaan thead tr th.th-left {
  text-align: left;
}

.table-penghargaan tbody td {
  padding: 14px 16px;
  vertical-align: middle;
  font-size: 13.5px;
  line-height: 1.55;
  color: #24292f;
  border: 1px solid #e2e8f0;
}

.table-penghargaan tbody tr:nth-child(even) {
  background-color: #fafbfc;
}
.table-penghargaan tbody tr:hover {
  background-color: #f0fdf9;
}

.col-no { width: 55px; text-align: center; font-weight: 700; }
.col-jenis { font-weight: 600; color: #0f172a; }
.col-tingkat { width: 170px; text-align: center; }
.col-lembaga { width: 280px; }
.col-opd { width: 240px; }
.col-aksi { width: 100px; text-align: center; }

/* Badges for Tingkat */
.badge-tingkat {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 10px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  white-space: nowrap;
}
.badge-nasional {
  background: #e8f8f5;
  color: #007a5a;
  border: 1px solid #b2dfdb;
}
.badge-provinsi {
  background: #eff6ff;
  color: #1d4ed8;
  border: 1px solid #bfdbfe;
}
.badge-internasional {
  background: #fef3c7;
  color: #b45309;
  border: 1px solid #fde68a;
}
.badge-kabkota {
  background: #f1f5f9;
  color: #334155;
  border: 1px solid #cbd5e1;
}

/* Badge for OPD */
.badge-opd {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: #f8fafc;
  color: #334155;
  padding: 4px 9px;
  border-radius: 6px;
  font-size: 11.5px;
  font-weight: 600;
  border: 1px solid #e2e8f0;
  max-width: 250px;
  white-space: normal;
  line-height: 1.35;
}

/* Action buttons (Hanya untuk Akun OPD) */
.action-btns {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.btn-table-icon {
  width: 32px;
  height: 32px;
  border-radius: 6px;
  border: none;
  outline: none;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  transition: all 0.15s ease;
}
.btn-table-icon.btn-edit {
  background: #e8f8f5;
  color: #00a87e;
  border: 1px solid #b2dfdb;
}
.btn-table-icon.btn-edit:hover {
  background: #00c292;
  color: #ffffff;
}
.btn-table-icon.btn-delete {
  background: #fee2e2;
  color: #dc2626;
  border: 1px solid #fecaca;
}
.btn-table-icon.btn-delete:hover {
  background: #dc2626;
  color: #ffffff;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--ui-text-muted);
}
.empty-state i {
  font-size: 48px;
  color: #cbd5e1;
  margin-bottom: 12px;
  display: block;
}
.empty-state h4 {
  font-size: 16px;
  font-weight: 700;
  color: var(--ui-dark);
  margin: 0 0 6px;
}
.empty-state p {
  margin: 0;
  font-size: 13px;
}

/* Modal Custom Styling (Khusus Akun OPD) */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15,23,42,0.6);
  backdrop-filter: blur(2px);
  display: none;
  align-items: flex-start;
  justify-content: center;
  padding: 80px 16px 40px;
  overflow-y: auto;
  z-index: 999999 !important;
}
.modal-overlay.open { display: flex; }
.modal-box {
  background: #fff;
  width: 100%;
  max-width: 650px;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-modal);
  padding: 26px 30px;
  position: relative;
  animation: modalFadeIn 0.2s ease-out;
}
@keyframes modalFadeIn {
  from { opacity: 0; transform: translateY(12px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}
.modal-close-btn {
  position: absolute;
  top: 18px;
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
  transition: all 0.15s;
}
.modal-close-btn:hover {
  background: #f1f5f9;
  color: var(--ui-dark);
}
.modal-header-sec {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 18px;
}
.modal-icon-badge {
  width: 46px;
  height: 46px;
  border-radius: var(--radius-md);
  background: var(--notika-primary-light);
  color: var(--notika-primary-hover);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.modal-title {
  margin: 0 0 4px;
  font-size: 19px;
  font-weight: 800;
  color: var(--ui-dark);
}
.modal-subtitle {
  margin: 0;
  font-size: 13px;
  color: var(--ui-text-muted);
}
.modal-body-sec {
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.form-field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.form-field label {
  font-size: 12px;
  font-weight: 700;
  color: var(--ui-dark);
  text-transform: uppercase;
  letter-spacing: 0.02em;
}
.form-field label .req {
  color: var(--ui-red);
}
.form-field input, .form-field select, .form-field textarea {
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-sm);
  padding: 9px 12px;
  font-size: 13.5px;
  color: var(--ui-dark);
  outline: none;
  transition: all 0.2s;
  font-family: inherit;
}
.form-field input:focus, .form-field select:focus, .form-field textarea:focus {
  border-color: var(--notika-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.form-field textarea {
  min-height: 80px;
  resize: vertical;
}
.modal-footer-sec {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding-top: 18px;
  border-top: 1px solid var(--ui-border-light);
  margin-top: 20px;
}
.btn-modal-action {
  padding: 9px 18px;
  font-size: 13.5px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  cursor: pointer;
  border: 1px solid transparent;
  transition: all 0.15s ease;
}
.btn-modal-cancel {
  background: #ffffff;
  border-color: var(--ui-border);
  color: var(--ui-text-main);
}
.btn-modal-cancel:hover {
  background: #f8fafc;
}
.btn-modal-save {
  background: var(--notika-primary);
  color: #ffffff;
}
.btn-modal-save:hover {
  background: var(--notika-primary-hover);
}

/* Print CSS - Format Cetak Bersih Sesuai Standar LKPJ */
@media print {
  body {
    background: #fff !important;
    color: #000 !important;
  }
  .sidebar, .navbar, .page-badge-wrapper, .stats-grid, .filter-card, .table-header-bar, .col-aksi, .modal-overlay, .btn-table-icon, .filter-actions {
    display: none !important;
  }
  .main-content {
    margin: 0 !important;
    padding: 0 !important;
  }
  .table-card {
    border: none !important;
    box-shadow: none !important;
  }
  .table-penghargaan {
    width: 100% !important;
    min-width: 100% !important;
    border-collapse: collapse !important;
  }
  .table-penghargaan thead tr th {
    background-color: #00c292 !important;
    color: #fff !important;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
    border: 1px solid #00a87e !important;
    font-size: 12px !important;
  }
  .table-penghargaan tbody td {
    border: 1px solid #ccc !important;
    font-size: 12px !important;
  }
  .print-header-report {
    display: block !important;
    text-align: center;
    margin-bottom: 20px;
  }
  .print-header-report h2 {
    font-size: 16px;
    font-weight: bold;
    margin: 0 0 5px;
    text-transform: uppercase;
  }
  .print-header-report p {
    font-size: 13px;
    margin: 0;
  }
}
.print-header-report { display: none; }
</style>

<div class="main-content">
  <!-- Print Header Only for Paper -->
  <div class="print-header-report">
    <h2>Daftar Penghargaan dan Prestasi Daerah</h2>
    <p><?= htmlspecialchars($namaWilayahTampil) ?> &bull; Tahun Anggaran <span id="printTahunAktif"><?= $tahunAktif ?></span></p>
  </div>

  <!-- Page Header -->
  <div class="page-header-box">
    <div class="page-badge-wrapper">
      <?php if ($isRole4): ?>
        <div class="page-badge badge-role-opd">
          <i class="fa fa-building"></i> Mode Pengisian OPD: <?= htmlspecialchars(!empty($NamaInstansiAktif) ? $NamaInstansiAktif : 'Perangkat Daerah') ?>
        </div>
      <?php endif; ?>
    </div>

    <h1 class="page-title">BAB 3.5  PENGHARGAAN</h1>
  </div>

  <!-- Stats Grid -->
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon green-notika">
        <i class="fa fa-trophy"></i>
      </div>
      <div class="stat-info">
        <div class="stat-num" id="statTotal"><?= $stats['total'] ?></div>
        <div class="stat-label">Total Penghargaan</div>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon blue">
        <i class="fa fa-globe"></i>
      </div>
      <div class="stat-info">
        <div class="stat-num" id="statNasional"><?= $stats['nasional'] ?></div>
        <div class="stat-label">Pusat / Nasional</div>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon purple">
        <i class="fa fa-flag"></i>
      </div>
      <div class="stat-info">
        <div class="stat-num" id="statProvinsi"><?= $stats['provinsi'] ?></div>
        <div class="stat-label">Tingkat Provinsi</div>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon teal">
        <i class="fa fa-building"></i>
      </div>
      <div class="stat-info">
        <div class="stat-num" id="statOpd"><?= $stats['total_opd'] ?></div>
        <div class="stat-label">OPD Berkontribusi</div>
      </div>
    </div>
  </div>

  <!-- Filter & Action Card -->
  <div class="filter-card">
    <div class="filter-header">
      <div class="filter-title">
        <i class="fa fa-filter"></i> Parameter Filter &amp; Pencarian
      </div>
      <div>
        <span style="font-size: 12.5px; color: var(--ui-text-muted);">
          Tahun Anggaran: <strong id="labelTahunAktif" style="color: var(--notika-primary);"><?= $tahunAktif ?></strong>
        </span>
      </div>
    </div>

    <div class="filter-grid">
      <div class="filter-left">
        <!-- Filter Tahun -->
        <div class="filter-group" style="max-width: 140px;">
          <label for="filterTahun">Tahun</label>
          <select id="filterTahun" class="filter-select">
            <?php foreach ($ListTahun as $th): ?>
              <option value="<?= $th ?>" <?= ((int)$th === (int)$tahunAktif) ? 'selected' : '' ?>><?= $th ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Filter OPD / Instansi (Hanya untuk Akun Daerah) -->
        <?php if (!$isRole4): ?>
          <div class="filter-group" style="min-width: 250px;">
            <label for="filterInstansi">Perangkat Daerah (OPD)</label>
            <select id="filterInstansi" class="filter-select">
              <option value="">-- Semua OPD (Rekapitulasi Daerah) --</option>
              <?php if (!empty($ListInstansi)): ?>
                <?php foreach ($ListInstansi as $ins): ?>
                  <option value="<?= $ins['id'] ?>" <?= (!empty($filterInstansi) && (int)$filterInstansi === (int)$ins['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ins['nama']) ?>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
        <?php else: ?>
          <input type="hidden" id="filterInstansi" value="<?= htmlspecialchars($InstansiId) ?>">
        <?php endif; ?>

        <!-- Filter Tingkat -->
        <div class="filter-group" style="max-width: 180px;">
          <label for="filterTingkat">Tingkat</label>
          <select id="filterTingkat" class="filter-select">
            <option value="">-- Semua Tingkat --</option>
            <option value="Pusat / Nasional" <?= ($filterTingkat === 'Pusat / Nasional') ? 'selected' : '' ?>>Pusat / Nasional</option>
            <option value="Provinsi" <?= ($filterTingkat === 'Provinsi') ? 'selected' : '' ?>>Provinsi</option>
            <option value="Internasional" <?= ($filterTingkat === 'Internasional') ? 'selected' : '' ?>>Internasional</option>
            <option value="Kabupaten/Kota" <?= ($filterTingkat === 'Kabupaten/Kota') ? 'selected' : '' ?>>Kabupaten/Kota</option>
          </select>
        </div>

        <!-- Pencarian Keyword Instan -->
        <div class="filter-group" style="flex: 1; min-width: 200px;">
          <label for="filterKeyword">Cari Penghargaan / Lembaga</label>
          <input type="text" id="filterKeyword" class="filter-input" placeholder="Ketik kata kunci...">
        </div>
      </div>

      <!-- Action Buttons: Tombol Tambah HANYA tampil untuk Akun OPD -->
      <div class="filter-actions">
        <?php if ($isRole4): ?>
          <button type="button" class="btn-primary-notika" id="btnTambahData">
            <i class="fa fa-plus"></i> Tambah Penghargaan
          </button>
        <?php endif; ?>
        <button type="button" class="btn-outline-action" id="btnExportExcel" title="Unduh format Excel">
          <i class="fa fa-file-excel text-green-600"></i> Ekspor Excel
        </button>
        <button type="button" class="btn-outline-action" id="btnPrintTable" title="Cetak format laporan">
          <i class="fa fa-print text-gray-600"></i> Cetak
        </button>
      </div>
    </div>
  </div>

  <!-- Data Table Card dengan Header Hijau Notika -->
  <div class="table-card">
    <div class="table-header-bar">
      <div class="table-header-title">
        <i class="fa fa-award"></i> Tabel Penghargaan dan Prestasi Kerja
        <span id="badgeFilteredCount" class="badge-opd" style="margin-left: 8px;">
          Menampilkan <strong id="cntRow" style="margin: 0 4px;"><?= count($items) ?></strong> data
        </span>
      </div>
      <div style="font-size: 12.5px; color: var(--ui-text-muted);">
        <?= $isRole4 ? 'Pengisian Mandiri OPD' : 'Rekapan Nasional / Provinsi Seluruh OPD' ?>
      </div>
    </div>

    <div class="table-wrapper">
      <table class="table-penghargaan" id="tblPenghargaan">
        <thead>
          <tr>
            <th class="col-no">NO</th>
            <th class="col-jenis th-left">JENIS PENGHARGAAN</th>
            <th class="col-tingkat">TINGKAT</th>
            <th class="col-lembaga th-left">LEMBAGA</th>
            <?php if (!$isRole4): ?>
              <th class="col-opd th-left">PERANGKAT DAERAH (OPD)</th>
            <?php else: ?>
              <th class="col-aksi">AKSI</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody id="tbodyPenghargaan">
          <?php if (!empty($items)): ?>
            <?php $no = 1; foreach ($items as $item): ?>
              <?php
                $tLower = strtolower($item['tingkat']);
                $badgeClass = 'badge-nasional';
                if (strpos($tLower, 'provinsi') !== false) {
                    $badgeClass = 'badge-provinsi';
                } elseif (strpos($tLower, 'internasional') !== false) {
                    $badgeClass = 'badge-internasional';
                } elseif (strpos($tLower, 'kab') !== false || strpos($tLower, 'kota') !== false) {
                    $badgeClass = 'badge-kabkota';
                }

                $canEdit = ($isRole4 && (int)$item['instansi_id'] === (int)$InstansiId);
              ?>
              <tr data-id="<?= $item['id'] ?>" data-instansi="<?= $item['instansi_id'] ?>">
                <td class="col-no"><?= $no++ ?></td>
                <td class="col-jenis">
                  <?= htmlspecialchars($item['jenis_penghargaan']) ?>
                  <?php if (!empty($item['keterangan'])): ?>
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 4px; font-weight: normal;">
                      <i class="fa fa-info-circle"></i> <?= htmlspecialchars($item['keterangan']) ?>
                    </div>
                  <?php endif; ?>
                </td>
                <td class="col-tingkat">
                  <span class="badge-tingkat <?= $badgeClass ?>">
                    <?= htmlspecialchars($item['tingkat']) ?>
                  </span>
                </td>
                <td class="col-lembaga">
                  <?= htmlspecialchars($item['lembaga']) ?>
                </td>

                <?php if (!$isRole4): ?>
                  <!-- Kolom OPD untuk Akun Daerah (Tanpa Kolom Aksi / Read-only) -->
                  <td class="col-opd">
                    <span class="badge-opd" title="<?= htmlspecialchars($item['nama_instansi']) ?>">
                      <i class="fa fa-building" style="color: var(--notika-primary); font-size: 10px;"></i>
                      <?= htmlspecialchars($item['nama_instansi']) ?>
                    </span>
                  </td>
                <?php else: ?>
                  <!-- Kolom Aksi Khusus Akun OPD -->
                  <td class="col-aksi">
                    <?php if ($canEdit): ?>
                      <div class="action-btns">
                        <button type="button" class="btn-table-icon btn-edit" data-json="<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>" onclick="onBtnEditClick(this)" title="Ubah Data">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn-table-icon btn-delete" data-id="<?= $item['id'] ?>" data-nama="<?= htmlspecialchars($item['jenis_penghargaan'], ENT_QUOTES, 'UTF-8') ?>" onclick="confirmHapusPenghargaan(this)" title="Hapus Data">
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                    <?php else: ?>
                      <span style="font-size: 11px; color: #94a3b8;"><i class="fa fa-lock"></i> Terkunci</span>
                    <?php endif; ?>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr id="rowEmpty">
              <td colspan="<?= $isRole4 ? 5 : 5 ?>">
                <div class="empty-state">
                  <i class="fa fa-award"></i>
                  <h4>Belum Ada Data Penghargaan Tahun <?= $tahunAktif ?></h4>
                  <p>
                    <?= $isRole4 ? "Belum ada data penghargaan untuk OPD Anda di tahun <strong>{$tahunAktif}</strong>. Silakan klik tombol <strong>Tambah Penghargaan</strong> untuk menambahkan data baru." : "Belum ada data penghargaan yang diinputkan untuk tahun <strong>{$tahunAktif}</strong>. Data baru akan muncul setelah ada inputan dari OPD." ?>
                  </p>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- =======================================================
     MODAL TAMBAH / EDIT PENGHARGAAN (KHUSUS AKUN OPD)
     ======================================================= -->
<?php if ($isRole4): ?>
<div class="modal-overlay" id="modalFormPenghargaan">
  <div class="modal-box">
    <button type="button" class="modal-close-btn" id="btnTutupModal">&times;</button>
    <div class="modal-header-sec">
      <div class="modal-icon-badge">
        <i class="fa fa-trophy"></i>
      </div>
      <div>
        <h3 class="modal-title" id="modalFormTitle">Tambah Penghargaan</h3>
        <p class="modal-subtitle">Pengisian data penghargaan untuk <?= htmlspecialchars(!empty($NamaInstansiAktif) ? $NamaInstansiAktif : 'OPD') ?> &bull; Tahun Anggaran <strong id="modalTahunBadge" style="color: var(--notika-primary);"><?= $tahunAktif ?></strong></p>
      </div>
    </div>

    <form id="formPenghargaan">
      <input type="hidden" id="formId" name="id" value="">
      <input type="hidden" id="formTahun" name="tahun" value="<?= $tahunAktif ?>">

      <div class="modal-body-sec">
        <!-- Jenis Penghargaan (Sesuai Kolom Gambar) -->
        <div class="form-field">
          <label for="formJenis">Jenis Penghargaan <span class="req">*</span></label>
          <textarea id="formJenis" name="jenis_penghargaan" rows="3" placeholder="Contoh: Kabupaten Terinovatif - Innovative Government Award 2025" required></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
          <!-- Tingkat (Sesuai Kolom Gambar) -->
          <div class="form-field">
            <label for="formTingkat">Tingkat <span class="req">*</span></label>
            <select id="formTingkat" name="tingkat" required>
              <option value="">-- Pilih Tingkat --</option>
              <option value="Pusat / Nasional">Pusat / Nasional</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Internasional">Internasional</option>
              <option value="Kabupaten/Kota">Kabupaten/Kota</option>
            </select>
          </div>

          <!-- Urutan Tampil -->
          <div class="form-field">
            <label for="formUrutan">Nomor Urut</label>
            <input type="number" id="formUrutan" name="urutan" min="1" value="1" placeholder="Auto">
          </div>
        </div>

        <!-- Lembaga Pemberi (Sesuai Kolom Gambar) -->
        <div class="form-field">
          <label for="formLembaga">Lembaga Pemberi Penghargaan <span class="req">*</span></label>
          <input type="text" id="formLembaga" name="lembaga" placeholder="Contoh: Kementerian Dalam Negeri / BPK RI / CNN" required>
        </div>

        <!-- Keterangan Tambahan (Opsional) -->
        <div class="form-field">
          <label for="formKeterangan">Keterangan / Kategori Tambahan (Opsional)</label>
          <input type="text" id="formKeterangan" name="keterangan" placeholder="Contoh: Kategori 'Padapa' / Akseptor Tinggi / No. Sertifikat">
        </div>
      </div>

      <div class="modal-footer-sec">
        <button type="button" class="btn-modal-action btn-modal-cancel" id="btnBatalModal">Batal</button>
        <button type="submit" class="btn-modal-action btn-modal-save" id="btnSimpanModal">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<script>
const BASE_URL = '<?= base_url() ?>';
const IS_ROLE_4 = <?= $isRole4 ? 'true' : 'false' ?>;
const USER_INSTANSI_ID = <?= !empty($InstansiId) ? (int)$InstansiId : 0 ?>;

document.addEventListener('DOMContentLoaded', function() {
  const filterTahun = document.getElementById('filterTahun');
  const filterInstansi = document.getElementById('filterInstansi');
  const filterTingkat = document.getElementById('filterTingkat');
  const filterKeyword = document.getElementById('filterKeyword');

  // Trigger reload data saat filter diubah
  if (filterTahun) filterTahun.addEventListener('change', reloadDataPenghargaan);
  if (filterInstansi && filterInstansi.tagName === 'SELECT') filterInstansi.addEventListener('change', reloadDataPenghargaan);
  if (filterTingkat) filterTingkat.addEventListener('change', reloadDataPenghargaan);

  // Live search debounce
  let searchTimeout = null;
  if (filterKeyword) {
    filterKeyword.addEventListener('input', function() {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(reloadDataPenghargaan, 300);
    });
  }

  // Modal open & close (Hanya aktif untuk Akun OPD)
  if (IS_ROLE_4) {
    const modal = document.getElementById('modalFormPenghargaan');
    const btnTambah = document.getElementById('btnTambahData');
    const btnTutup = document.getElementById('btnTutupModal');
    const btnBatal = document.getElementById('btnBatalModal');
    const form = document.getElementById('formPenghargaan');

    if (btnTambah && modal) {
      btnTambah.addEventListener('click', function() {
        form.reset();
        document.getElementById('formId').value = '';
        document.getElementById('formTahun').value = filterTahun.value;
        const modalBadge = document.getElementById('modalTahunBadge');
        if (modalBadge) modalBadge.textContent = filterTahun.value;
        document.getElementById('modalFormTitle').textContent = 'Tambah Penghargaan';
        
        // Hitung urutan default
        const rows = document.querySelectorAll('#tbodyPenghargaan tr[data-id]');
        document.getElementById('formUrutan').value = rows.length + 1;
        
        modal.classList.add('open');
      });
    }

    function tutupModal() {
      if (modal) modal.classList.remove('open');
    }
    if (btnTutup) btnTutup.addEventListener('click', tutupModal);
    if (btnBatal) btnBatal.addEventListener('click', tutupModal);

    if (modal) {
      modal.addEventListener('click', function(e) {
        if (e.target === modal) tutupModal();
      });
    }

    // Submit Form
    if (form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        const saveBtn = document.getElementById('btnSimpanModal');
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

        const formData = new FormData(form);

        fetch(`${BASE_URL}Instansi/SavePenghargaan`, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(r => r.json())
        .then(res => {
          saveBtn.disabled = false;
          saveBtn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';

          if (res.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: res.message,
              timer: 1500,
              showConfirmButton: false
            });
            tutupModal();
            reloadDataPenghargaan();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal Menyimpan',
              text: res.message || 'Terjadi kesalahan saat menyimpan data.'
            });
          }
        })
        .catch(err => {
          saveBtn.disabled = false;
          saveBtn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
          console.error(err);
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan Sistem',
            text: 'Tidak dapat terhubung ke server.'
          });
        });
      });
    }
  }

  // Export Excel
  const btnExport = document.getElementById('btnExportExcel');
  if (btnExport) {
    btnExport.addEventListener('click', function() {
      const th = filterTahun.value;
      const ins = filterInstansi ? filterInstansi.value : '';
      const tkt = filterTingkat.value;
      window.location.href = `${BASE_URL}Instansi/ExportPenghargaanExcel?tahun=${encodeURIComponent(th)}&instansi_id=${encodeURIComponent(ins)}&tingkat=${encodeURIComponent(tkt)}`;
    });
  }

  // Cetak
  const btnPrint = document.getElementById('btnPrintTable');
  if (btnPrint) {
    btnPrint.addEventListener('click', function() {
      window.print();
    });
  }
});

/**
 * Trigger Edit from Table Button (OPD Only)
 */
function onBtnEditClick(btn) {
  if (!IS_ROLE_4) return;
  try {
    const raw = btn.getAttribute('data-json');
    if (raw) {
      const data = JSON.parse(raw);
      editPenghargaan(data);
    }
  } catch (e) {
    console.error('Error parsing award json', e);
  }
}

function confirmHapusPenghargaan(btn) {
  if (!IS_ROLE_4) return;
  const id = btn.getAttribute('data-id');
  const nama = btn.getAttribute('data-nama') || 'Penghargaan';
  if (id) {
    hapusPenghargaan(id, nama);
  }
}

/**
 * Edit Data Penghargaan (OPD Only)
 */
function editPenghargaan(data) {
  if (!IS_ROLE_4) return;
  const modal = document.getElementById('modalFormPenghargaan');
  document.getElementById('modalFormTitle').textContent = 'Ubah Data Penghargaan';
  document.getElementById('formId').value = data.id;
  document.getElementById('formTahun').value = data.tahun;
  const modalBadge = document.getElementById('modalTahunBadge');
  if (modalBadge) modalBadge.textContent = data.tahun;
  document.getElementById('formJenis').value = data.jenis_penghargaan || '';
  document.getElementById('formTingkat').value = data.tingkat || '';
  document.getElementById('formUrutan').value = data.urutan || 1;
  document.getElementById('formLembaga').value = data.lembaga || '';
  document.getElementById('formKeterangan').value = data.keterangan || '';

  if (modal) modal.classList.add('open');
}

/**
 * Hapus Data Penghargaan (OPD Only)
 */
function hapusPenghargaan(id, nama) {
  if (!IS_ROLE_4) return;
  Swal.fire({
    title: 'Konfirmasi Hapus',
    text: `Apakah Anda yakin ingin menghapus penghargaan "${nama}"?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      const fd = new FormData();
      fd.append('id', id);

      fetch(`${BASE_URL}Instansi/DeletePenghargaan`, {
        method: 'POST',
        body: fd,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(r => r.json())
      .then(res => {
        if (res.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: res.message,
            timer: 1500,
            showConfirmButton: false
          });
          reloadDataPenghargaan();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Menghapus',
            text: res.message
          });
        }
      })
      .catch(err => {
        console.error(err);
        Swal.fire({
          icon: 'error',
          title: 'Kesalahan Sistem',
          text: 'Gagal terhubung ke server.'
        });
      });
    }
  });
}

/**
 * AJAX Reload Data Penghargaan & Update Stats
 */
function reloadDataPenghargaan() {
  const filterTahun = document.getElementById('filterTahun').value;
  const filterInstansi = document.getElementById('filterInstansi') ? document.getElementById('filterInstansi').value : '';
  const filterTingkat = document.getElementById('filterTingkat').value;
  const filterKeyword = document.getElementById('filterKeyword').value;

  // Update label info tahun aktif di header parameter & cetak
  const lblTahun = document.getElementById('labelTahunAktif');
  if (lblTahun) lblTahun.textContent = filterTahun;
  const prtTahun = document.getElementById('printTahunAktif');
  if (prtTahun) prtTahun.textContent = filterTahun;
  const formTh = document.getElementById('formTahun');
  if (formTh) formTh.value = filterTahun;

  // Update query param URL browser agar state tahun tersimpan
  try {
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('tahun', filterTahun);
    window.history.replaceState({}, '', currentUrl.toString());
  } catch (e) {}

  const fd = new FormData();
  fd.append('tahun', filterTahun);
  fd.append('instansi_id', filterInstansi);
  fd.append('tingkat', filterTingkat);
  fd.append('keyword', filterKeyword);

  const tbody = document.getElementById('tbodyPenghargaan');
  tbody.style.opacity = '0.5';

  fetch(`${BASE_URL}Instansi/GetPenghargaan`, {
    method: 'POST',
    body: fd,
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(r => r.json())
  .then(res => {
    tbody.style.opacity = '1';

    if (res.status === 'success') {
      // Update Statistik
      if (res.stats) {
        document.getElementById('statTotal').textContent = res.stats.total;
        document.getElementById('statNasional').textContent = res.stats.nasional;
        document.getElementById('statProvinsi').textContent = res.stats.provinsi;
        document.getElementById('statOpd').textContent = res.stats.total_opd;
      }

      document.getElementById('cntRow').textContent = res.data.length;

      // Render Baris Tabel
      if (res.data.length > 0) {
        let html = '';
        let no = 1;
        res.data.forEach(item => {
          const tLower = (item.tingkat || '').toLowerCase();
          let badgeClass = 'badge-nasional';
          if (tLower.includes('provinsi')) {
            badgeClass = 'badge-provinsi';
          } else if (tLower.includes('internasional')) {
            badgeClass = 'badge-internasional';
          } else if (tLower.includes('kab') || tLower.includes('kota')) {
            badgeClass = 'badge-kabkota';
          }

          const canEdit = (IS_ROLE_4 && parseInt(item.instansi_id) === USER_INSTANSI_ID);
          const safeItemJson = JSON.stringify(item).replace(/"/g, '&quot;');
          const safeJenisEsc = escapeHtml(item.jenis_penghargaan || '');

          let ketHtml = '';
          if (item.keterangan && item.keterangan.trim() !== '') {
            ketHtml = `<div style="font-size: 11.5px; color: #64748b; margin-top: 4px; font-weight: normal;">
                         <i class="fa fa-info-circle"></i> ${escapeHtml(item.keterangan)}
                       </div>`;
          }

          let extraColHtml = '';
          if (!IS_ROLE_4) {
            // Mode Daerah: Kolom Perangkat Daerah (Read-only)
            extraColHtml = `
              <td class="col-opd">
                <span class="badge-opd" title="${escapeHtml(item.nama_instansi || '')}">
                  <i class="fa fa-building" style="color: var(--notika-primary); font-size: 10px;"></i>
                  ${escapeHtml(item.nama_instansi || 'Pemerintah Daerah')}
                </span>
              </td>
            `;
          } else {
            // Mode OPD: Kolom Aksi
            let aksiBtns = `<span style="font-size: 11px; color: #94a3b8;"><i class="fa fa-lock"></i> Terkunci</span>`;
            if (canEdit) {
              aksiBtns = `
                <div class="action-btns">
                  <button type="button" class="btn-table-icon btn-edit" data-json="${safeItemJson}" onclick="onBtnEditClick(this)" title="Ubah Data">
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button type="button" class="btn-table-icon btn-delete" data-id="${item.id}" data-nama="${safeJenisEsc}" onclick="confirmHapusPenghargaan(this)" title="Hapus Data">
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              `;
            }
            extraColHtml = `<td class="col-aksi">${aksiBtns}</td>`;
          }

          html += `
            <tr data-id="${item.id}" data-instansi="${item.instansi_id}">
              <td class="col-no">${no++}</td>
              <td class="col-jenis">
                ${safeJenisEsc}
                ${ketHtml}
              </td>
              <td class="col-tingkat">
                <span class="badge-tingkat ${badgeClass}">
                  ${escapeHtml(item.tingkat)}
                </span>
              </td>
              <td class="col-lembaga">
                ${escapeHtml(item.lembaga)}
              </td>
              ${extraColHtml}
            </tr>
          `;
        });
        tbody.innerHTML = html;
      } else {
        const safeTh = escapeHtml(filterTahun);
        tbody.innerHTML = `
          <tr id="rowEmpty">
            <td colspan="5">
              <div class="empty-state">
                <i class="fa fa-award"></i>
                <h4>Belum Ada Data Penghargaan Tahun ${safeTh}</h4>
                <p>${IS_ROLE_4 
                  ? `Belum ada data penghargaan untuk OPD Anda di tahun <strong>${safeTh}</strong>. Silakan klik tombol <strong>Tambah Penghargaan</strong> untuk menambahkan data baru.` 
                  : `Belum ada data penghargaan yang diinputkan untuk tahun <strong>${safeTh}</strong>. Data baru akan muncul setelah ada inputan dari OPD.`}</p>
              </div>
            </td>
          </tr>
        `;
      }
    }
  })
  .catch(err => {
    tbody.style.opacity = '1';
    console.error(err);
  });
}

function escapeHtml(text) {
  if (!text) return '';
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.toString().replace(/[&<>"']/g, m => map[m]);
}
</script>
