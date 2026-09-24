<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: Capaian Kinerja Pelaksanaan Tugas Pembantuan
 * Template Notika - Selaras dengan Desain IPPD
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2026;
$filterInstansi = isset($FilterInstansi) ? (int)$FilterInstansi : 1;
$items = isset($Items) ? $Items : [];
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
  margin: 0;
  line-height: 1.5;
}

/* Toolbar Card */
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

/* Filter Card */
.filter-card {
  background: var(--ui-card-bg);
  border-radius: var(--radius-lg, 12px);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-sm, 0 1px 3px rgba(0,0,0,0.05));
  padding: 16px 20px;
  margin-bottom: 20px;
}

.filter-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--ui-border-light, #f1f5f9);
}

.filter-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--ui-dark, #0f172a);
  display: flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.filter-title i {
  color: var(--ui-primary, #00c292);
  font-size: 15px;
}

.filter-grid {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-end;
  gap: 12px;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.filter-group label {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--ui-dark, #1e293b);
  letter-spacing: 0.1px;
}

.form-control-custom {
  height: 38px;
  padding: 0 12px;
  font-size: 13.5px;
  border: 1px solid var(--ui-border, #cbd5e1);
  border-radius: var(--radius-md, 6px);
  background: #ffffff;
  color: var(--ui-dark, #0f172a);
  font-weight: 500;
  outline: none;
  transition: all 0.2s;
  width: 100%;
}
.form-control-custom:focus {
  border-color: var(--ui-primary, #00c292);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
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
.t-select {
  background: #fff;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 8px 12px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--ui-dark);
  min-width: 170px;
  outline: none;
  cursor: pointer;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.t-select:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.btn-add-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--ui-primary);
  color: #fff;
  border: none;
  padding: 9px 18px;
  font-size: 13.5px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  cursor: pointer;
  transition: all 0.15s ease;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.25);
}
.btn-add-primary:hover { background: var(--ui-primary-hover); }

/* Table Section */
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

.tp-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 1740px;
  font-size: 12.5px;
}

.tp-table thead th {
  position: sticky;
  top: 0;
  z-index: 5;
  background: #f8fafc;
  color: var(--ui-dark);
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  padding: 12px 14px;
  border-bottom: 2px solid #cbd5e1;
  border-right: 1px solid var(--ui-border);
  white-space: nowrap;
  text-align: left;
}
.tp-table thead th:last-child { border-right: none; text-align: center; }
.tp-table thead th.center { text-align: center; }
.tp-table thead th.num { text-align: right; }

.tp-table tbody td {
  padding: 12px 14px;
  border-bottom: 1px solid var(--ui-border);
  border-right: 1px solid var(--ui-border);
  vertical-align: top;
  color: #334155;
  line-height: 1.55;
}
.tp-table tbody td:last-child { border-right: none; }
.tp-table tbody tr:hover td { background: #fdfefe; }

.cell-multiline {
  white-space: pre-wrap;
  word-break: break-word;
}
.cell-nowrap { white-space: nowrap; }
.cell-num {
  text-align: right;
  white-space: nowrap;
  font-family: 'Roboto Mono', monospace;
  font-size: 12.5px;
}

.badge-capaian {
  display: inline-block;
  padding: 3px 9px;
  border-radius: 999px;
  font-weight: 700;
  font-size: 12px;
}
.badge-good { background: var(--ui-green-light); color: #065f46; }
.badge-mid { background: var(--ui-amber-light); color: #92400e; }
.badge-low { background: var(--ui-red-light); color: #991b1b; }

.action-btns {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  white-space: nowrap;
}
.btn-icon {
  width: 30px;
  height: 30px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--radius-sm);
  border: 1px solid var(--ui-border);
  background: #fff;
  color: var(--ui-text-muted);
  cursor: pointer;
  transition: all 0.15s ease;
  font-size: 13px;
}
.btn-icon.edit:hover {
  background: var(--ui-primary-light);
  border-color: var(--ui-primary-border);
  color: var(--ui-primary-text);
}
.btn-icon.delete:hover {
  background: var(--ui-red-light);
  border-color: #fecaca;
  color: var(--ui-red);
}

/* Modals */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15,23,42,0.6);
  backdrop-filter: blur(2px);
  display: none;
  align-items: flex-start;
  justify-content: center;
  padding: 85px 16px 40px;
  overflow-y: auto;
  z-index: 999999 !important;
}
.modal-overlay.open { display: flex; }

.modal-box-lg {
  background: #fff;
  width: 100%;
  max-width: 920px;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-modal);
  padding: 28px 32px;
  position: relative;
  animation: modalFadeIn 0.2s ease-out;
}
@keyframes modalFadeIn {
  from { opacity: 0; transform: translateY(12px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

.modal-header-flex {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  border-bottom: 1px solid var(--ui-border);
  padding-bottom: 16px;
  margin-bottom: 22px;
}
.modal-header-left {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}
.modal-icon-badge {
  width: 48px;
  height: 48px;
  border-radius: var(--radius-md);
  background: var(--ui-primary-light);
  color: var(--ui-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.modal-title-text {
  font-size: 19px;
  font-weight: 800;
  color: var(--ui-dark);
  margin: 0 0 4px;
}
.modal-sub-text {
  font-size: 13px;
  color: var(--ui-text-muted);
  margin: 0;
}
.modal-close-btn {
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
.modal-close-btn:hover { background: #f1f5f9; color: var(--ui-dark); }

/* Form Sections */
.form-section-box {
  margin-bottom: 24px;
  background: #fafcff;
  border: 1px solid #e2e8f0;
  border-radius: var(--radius-md);
  padding: 18px 20px;
}
.form-section-title {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 13.5px;
  font-weight: 800;
  color: var(--ui-dark);
  margin-bottom: 14px;
  padding-bottom: 8px;
  border-bottom: 1px solid #e2e8f0;
}
.section-badge-num {
  width: 24px;
  height: 24px;
  border-radius: 6px;
  background: var(--ui-primary);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 800;
}

.form-grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.form-group-full { grid-column: 1 / -1; }

.f-field {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-bottom: 12px;
}
.f-field label {
  font-size: 12px;
  font-weight: 700;
  color: var(--ui-dark);
  text-transform: uppercase;
  letter-spacing: 0.02em;
}
.f-field label .req { color: var(--ui-red); margin-left: 2px; }

.f-input, .f-select, .f-textarea {
  width: 100%;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 9px 12px;
  font-size: 13px;
  color: var(--ui-dark);
  background: #fff;
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}
.f-input:focus, .f-select:focus, .f-textarea:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.f-input.is-invalid, .f-select.is-invalid, .f-textarea.is-invalid {
  border-color: var(--ui-red);
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
}
.f-textarea {
  min-height: 80px;
  resize: vertical;
  line-height: 1.5;
}

.input-prefix-box {
  position: relative;
}
.input-prefix-box span {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--ui-text-muted);
  font-size: 12px;
  font-weight: 700;
  pointer-events: none;
}
.input-prefix-box input {
  padding-left: 36px;
}

/* Achievement Real-time Box */
.capaian-box-widget {
  background: #fff;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 14px 16px;
  margin-top: 4px;
}
.capaian-box-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
}
.capaian-val-display {
  font-size: 18px;
  font-weight: 800;
  color: var(--ui-primary-text);
  font-family: 'Roboto Mono', monospace;
}
.capaian-progress-bar-bg {
  height: 8px;
  background: #e2e8f0;
  border-radius: 999px;
  overflow: hidden;
  margin-bottom: 10px;
}
.capaian-progress-fill {
  height: 100%;
  width: 0%;
  background: var(--ui-primary);
  border-radius: 999px;
  transition: width 0.3s ease;
}

.modal-footer-btn {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding-top: 16px;
  border-top: 1px solid var(--ui-border);
  margin-top: 20px;
}

.btn-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 9px 18px;
  font-size: 13.5px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  cursor: pointer;
  border: 1px solid transparent;
  transition: all 0.15s ease;
}
.btn-pill-reset { background: #fff; border-color: #cbd5e1; color: var(--ui-text-main); }
.btn-pill-reset:hover { background: #f8fafc; }
.btn-pill-save { background: var(--ui-primary); color: #fff; }
.btn-pill-save:hover { background: var(--ui-primary-hover); }
.btn-pill-danger { background: var(--ui-red); color: #fff; }
.btn-pill-danger:hover { background: #dc2626; }

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
    <div class="filter-card" style="margin-bottom: 20px;">
      <div class="filter-header">
        <div class="filter-title">
          <i class="fa fa-filter"></i> <?= empty($IsLoggedIn) ? 'Filter Wilayah &amp; Perangkat Daerah' : 'Filter Perangkat Daerah' ?>
        </div>
      </div>
      <div class="filter-grid" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end;">
        <?php if (empty($IsLoggedIn)): ?>
          <div class="filter-group" style="flex: 1; min-width: 180px;">
            <label>Provinsi</label>
            <select id="selProvinsiTop" class="form-control-custom">
              <option value="">Pilih Provinsi</option>
              <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($provKodeCurrent) && $provKodeCurrent==$prov['Kode']) ? 'selected' : '' ?>>
                  <?= html_escape($prov['Nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div class="filter-group" style="flex: 1; min-width: 180px;">
            <label>Kabupaten / Kota</label>
            <select id="selKabKotaTop" class="form-control-custom">
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

        <div class="filter-group" id="grpInstansiTop" style="flex: 1.2; min-width: 220px; <?= (!empty($IsLoggedIn) || !empty($KodeWilayah)) ? '' : 'display:none;' ?>">
          <label>Perangkat Daerah / Instansi</label>
          <select id="selInstansiTop" class="form-control-custom">
            <option value="">-- Semua Perangkat Daerah --</option>
            <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
              <option value="<?= $ins['id'] ?>" <?= (!empty($FilterInstansi) && $FilterInstansi == $ins['id']) || (!empty($filterInstansi) && $filterInstansi == $ins['id']) ? 'selected' : '' ?>>
                <?= html_escape($ins['nama']) ?>
              </option>
            <?php }} ?>
          </select>
        </div>

        <div style="width: auto;">
          <button type="button" id="btnFilterWilayahTop" class="btn btn-primary" style="height: 38px; padding: 0 18px; font-size: 13px; font-weight: 600; border-radius: 6px; background: var(--ui-primary, #00c292); color: #fff; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa fa-search"></i> <?= empty($IsLoggedIn) ? 'Terapkan Wilayah' : 'Terapkan Filter' ?>
          </button>
        </div>
      </div>
    </div>
  <?php } ?>

  <!-- Page Header -->
  <div class="page-header-box">
    <div class="page-badge"><i class="fa fa-tasks"></i> E-LKPJ Perangkat Daerah</div>
    <h1 class="page-title">Capaian Kinerja Pelaksanaan Tugas Pembantuan</h1>
    <p class="page-subtitle">Kelola dan laporkan capaian kinerja kegiatan tugas pembantuan per kementerian/instansi pemberi tugas beserta realisasi pagu anggaran dan solusi kendala lapangan.</p>
  </div>

  <!-- Toolbar & Filters -->
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

      <input type="hidden" id="selectInstansi" value="<?= $filterInstansi ?>">
    </div>

    <div>
      <?php if (!empty($IsRole4)): ?>
        <button type="button" class="btn-add-primary" id="btnTambahTP">
          <i class="fa fa-plus"></i> Tambah Tugas Pembantuan
        </button>
      <?php endif; ?>
    </div>
  </div>

  <!-- Data Table Card -->
  <div class="table-card">
    <div class="table-scroll-wrap">
      <table class="tp-table">
        <thead>
          <tr>
            <th style="width: 170px;">Dasar Penugasan</th>
            <th style="width: 160px;">Instansi Pemberi Tugas</th>
            <th style="width: 150px;">Program</th>
            <th style="width: 320px;">Kegiatan / Output</th>
            <th style="width: 140px;">Lokasi</th>
            <th style="width: 90px;" class="center">Satuan/Unit</th>
            <th style="width: 120px;" class="num">Pagu (Rp)</th>
            <th style="width: 120px;" class="num">Realisasi (Rp)</th>
            <th style="width: 110px;">Sumber Dana</th>
            <th style="width: 90px;" class="num">Capaian (%)</th>
            <th style="width: 240px;">Permasalahan</th>
            <th style="width: 240px;">Solusi</th>
            <?php if (!empty($IsRole4)): ?>
              <th style="width: 80px;" class="center">Aksi</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody id="tbodyTP">
          <!-- Rendered via JS -->
        </tbody>
      </table>
      <div id="emptyTPBox" style="display:none; text-align:center; padding:50px 20px; color:#94a3b8;">
        <i class="fa fa-folder-open-o" style="font-size:36px; display:block; margin-bottom:10px;"></i>
        <strong style="color:var(--ui-dark);">Belum ada data pelaksanaan tugas pembantuan</strong><br>
        <?= (empty($IsLoggedIn) && empty($KodeWilayah)) ? 'Silakan pilih Filter Wilayah & Perangkat Daerah di atas terlebih dahulu untuk menampilkan data.' : (empty($IsRole4) ? 'Belum ada data pelaksanaan tugas pembantuan untuk perangkat daerah ini.' : 'Klik tombol <strong>+ Tambah Tugas Pembantuan</strong> untuk menambahkan data baru.') ?>
      </div>
    </div>
  </div>
</div>

<!-- ============================================================== -->
<!-- MODAL TAMBAH / EDIT TUGAS PEMBANTUAN                           -->
<!-- ============================================================== -->
<div class="modal-overlay" id="modalTPOverlay">
  <div class="modal-box-lg">
    <div class="modal-header-flex">
      <div class="modal-header-left">
        <div class="modal-icon-badge">
          <i class="fa fa-clipboard"></i>
        </div>
        <div>
          <h3 class="modal-title-text" id="modalTPTitle">Capaian Kinerja Pelaksanaan Tugas Pembantuan</h3>
          <p class="modal-sub-text">Lengkapi informasi pelaksanaan, rincian anggaran, dan evaluasi kendala kegiatan.</p>
        </div>
      </div>
      <button type="button" class="modal-close-btn" id="btnTPClose">&times;</button>
    </div>

    <form id="formTP" autocomplete="off">
      <input type="hidden" id="formTPId" value="">

      <!-- SECTION 1: INFORMASI KEGIATAN -->
      <div class="form-section-box">
        <div class="form-section-title">
          <span class="section-badge-num">1</span> Informasi Kegiatan
        </div>

        <div class="form-grid-2">
          <div class="f-field form-group-full">
            <label for="fDasarPenugasan">Dasar Penugasan <span class="req">*</span></label>
            <input type="text" id="fDasarPenugasan" class="f-input" placeholder="Nomor, tanggal, dan nama dokumen perjanjian kerjasama/SK dasar tugas">
          </div>

          <div class="f-field form-group-full">
            <label for="fInstansiPemberi">Instansi Pemberian Tugas Pembantuan <span class="req">*</span></label>
            <input type="text" id="fInstansiPemberi" class="f-input" placeholder="Nama Kementerian / Lembaga / Instansi pemberi tugas">
          </div>

          <div class="f-field">
            <label for="fProgram">Program <span class="req">*</span></label>
            <input type="text" id="fProgram" class="f-input" placeholder="Nama program terkait">
          </div>

          <div class="f-field">
            <label for="fLokasi">Lokasi <span class="req">*</span></label>
            <input type="text" id="fLokasi" class="f-input" placeholder="Kabupaten/kota, kecamatan, desa/kelurahan">
          </div>

          <div class="f-field form-group-full">
            <label for="fKegiatanOutput">Kegiatan / Output <span class="req">*</span></label>
            <textarea id="fKegiatanOutput" class="f-textarea" rows="3" placeholder="Uraian kegiatan, output yang dihasilkan, serta outcome apabila tersedia..."></textarea>
          </div>
        </div>
      </div>

      <!-- SECTION 2: TARGET DAN REALISASI ANGGARAN -->
      <div class="form-section-box">
        <div class="form-section-title">
          <span class="section-badge-num">2</span> Target dan Realisasi Anggaran
        </div>

        <div class="form-grid-2">
          <div class="f-field">
            <label for="fSatuanUnit">Satuan / Unit <span class="req">*</span></label>
            <input type="text" id="fSatuanUnit" class="f-input" placeholder="Contoh: Unit, Paket, Km, Orang, Dokumen">
          </div>

          <div class="f-field">
            <label for="fSumberDana">Sumber Dana <span class="req">*</span></label>
            <input type="text" id="fSumberDana" class="f-input" placeholder="Contoh: APBN, DIPA BNPB TA 2025, DAK, APBD">
          </div>

          <div class="f-field">
            <label for="fPagu">Pagu (Rp) <span class="req">*</span></label>
            <div class="input-prefix-box">
              <span>Rp</span>
              <input type="text" id="fPagu" class="f-input" placeholder="0">
            </div>
          </div>

          <div class="f-field">
            <label for="fRealisasi">Realisasi (Rp) <span class="req">*</span></label>
            <div class="input-prefix-box">
              <span>Rp</span>
              <input type="text" id="fRealisasi" class="f-input" placeholder="0">
            </div>
          </div>

          <div class="f-field form-group-full">
            <label>Persentase Capaian (%) <span class="req">*</span></label>
            <div class="capaian-box-widget">
              <div class="capaian-box-header">
                <span style="font-size:12px; color:var(--ui-text-muted);">Kalkulasi persentase realisasi anggaran</span>
                <span class="capaian-val-display" id="displayCapaianText">0.00%</span>
              </div>
              <div class="capaian-progress-bar-bg">
                <div class="capaian-progress-fill" id="displayProgressBar"></div>
              </div>
              <div>
                <input type="number" step="0.01" min="0" max="100" id="fCapaianInput" class="f-input" placeholder="0.00" style="max-width: 160px; font-weight:700;">
                <span style="font-size:11.5px; color:var(--ui-text-muted); margin-left: 8px;">Terisi otomatis dari (Realisasi &divide; Pagu &times; 100), dapat disesuaikan manual.</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SECTION 3: EVALUASI PELAKSANAAN -->
      <div class="form-section-box">
        <div class="form-section-title">
          <span class="section-badge-num">3</span> Evaluasi Pelaksanaan
        </div>

        <div class="f-field">
          <label for="fPermasalahan">Permasalahan</label>
          <textarea id="fPermasalahan" class="f-textarea" rows="3" placeholder="Jelaskan kendala teknis, administratif, geografis, maupun anggaran di lapangan..."></textarea>
        </div>

        <div class="f-field">
          <label for="fSolusi">Solusi / Upaya Mengatasi</label>
          <textarea id="fSolusi" class="f-textarea" rows="3" placeholder="Jelaskan metode, penyesuaian teknis, atau koordinasi yang dilakukan untuk menyelesaikan kendala..."></textarea>
        </div>
      </div>

      <div class="modal-footer-btn">
        <button type="button" class="btn-pill btn-pill-reset" id="btnCancelTP">Batal</button>
        <button type="button" class="btn-pill btn-pill-save" id="btnSaveTP">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ============================================================== -->
<!-- MODAL KONFIRMASI HAPUS                                         -->
<!-- ============================================================== -->
<div class="modal-overlay" id="modalDeleteTPOverlay">
  <div class="modal-box-lg" style="max-width:440px; text-align:center; padding:30px 24px;">
    <div style="width:56px; height:56px; border-radius:50%; background:var(--ui-red-light); color:var(--ui-red); display:flex; align-items:center; justify-content:center; font-size:26px; margin:0 auto 16px;">
      <i class="fa fa-trash-o"></i>
    </div>
    <h3 style="margin:0 0 8px; font-size:18px; font-weight:800; color:var(--ui-dark);">Hapus Data Tugas Pembantuan?</h3>
    <p style="margin:0 0 20px; font-size:13px; color:var(--ui-text-muted); line-height:1.5;">Data capaian kinerja tugas pembantuan yang dihapus tidak dapat dipulihkan kembali.</p>
    <div style="display:flex; justify-content:center; gap:10px;">
      <button type="button" class="btn-pill btn-pill-reset" id="btnCancelDeleteTP">Batal</button>
      <button type="button" class="btn-pill btn-pill-danger" id="btnConfirmDeleteTP">
        <i class="fa fa-trash"></i> Ya, Hapus Data
      </button>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script>
(function(){
  "use strict";

  var BASE_URL = "<?= base_url() ?>";
  var IS_ROLE_4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;
  var itemsData = <?= json_encode($items) ?>;
  var deleteTargetId = null;

  var tbody = document.getElementById("tbodyTP");
  var emptyBox = document.getElementById("emptyTPBox");
  var selectTahun = document.getElementById("selectTahun");
  var selectInstansi = document.getElementById("selectInstansi");

  var modalTP = document.getElementById("modalTPOverlay");
  var modalTPTitle = document.getElementById("modalTPTitle");
  var modalDelete = document.getElementById("modalDeleteTPOverlay");

  // Form Fields
  var formTPId = document.getElementById("formTPId");
  var fDasarPenugasan = document.getElementById("fDasarPenugasan");
  var fInstansiPemberi = document.getElementById("fInstansiPemberi");
  var fProgram = document.getElementById("fProgram");
  var fLokasi = document.getElementById("fLokasi");
  var fKegiatanOutput = document.getElementById("fKegiatanOutput");
  var fSatuanUnit = document.getElementById("fSatuanUnit");
  var fSumberDana = document.getElementById("fSumberDana");
  var fPagu = document.getElementById("fPagu");
  var fRealisasi = document.getElementById("fRealisasi");
  var fCapaianInput = document.getElementById("fCapaianInput");
  var displayCapaianText = document.getElementById("displayCapaianText");
  var displayProgressBar = document.getElementById("displayProgressBar");
  var fPermasalahan = document.getElementById("fPermasalahan");
  var fSolusi = document.getElementById("fSolusi");

  var requiredInputs = [fDasarPenugasan, fInstansiPemberi, fProgram, fLokasi, fKegiatanOutput, fSatuanUnit, fSumberDana];

  // Helpers
  function escapeHtml(str){
    if (!str) return "";
    return String(str)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  function onlyDigits(str){
    return (str || "").replace(/\D/g, "");
  }

  function formatRibuan(digitsStr){
    if (!digitsStr) return "";
    return digitsStr.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  function formatRpDisplay(num){
    num = Number(num) || 0;
    return "Rp " + formatRibuan(String(num));
  }

  function formatPersen(num){
    num = Number(num) || 0;
    return num.toFixed(2).replace(".", ",") + "%";
  }

  function getBadgeClass(cap){
    var n = Number(cap) || 0;
    if (n >= 90) return "badge-good";
    if (n >= 60) return "badge-mid";
    return "badge-low";
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

  // Rupiah formatting on inputs & auto calculation
  function attachRupiahListener(input){
    input.addEventListener("input", function(){
      var digits = onlyDigits(this.value);
      this.value = formatRibuan(digits);
      calculateCapaianAuto();
    });
  }
  attachRupiahListener(fPagu);
  attachRupiahListener(fRealisasi);

  function calculateCapaianAuto(){
    var pagu = parseInt(onlyDigits(fPagu.value), 10) || 0;
    var realisasi = parseInt(onlyDigits(fRealisasi.value), 10) || 0;
    var cap = (pagu > 0) ? (realisasi / pagu * 100) : 0;
    cap = Math.round(cap * 100) / 100;
    if (cap < 0) cap = 0;

    fCapaianInput.value = cap;
    updateCapaianDisplay(cap);
  }

  function updateCapaianDisplay(val){
    var v = Number(val) || 0;
    displayCapaianText.textContent = formatPersen(v);
    var clamped = v > 100 ? 100 : (v < 0 ? 0 : v);
    displayProgressBar.style.width = clamped + "%";
  }

  fCapaianInput.addEventListener("input", function(){
    updateCapaianDisplay(this.value);
  });

  // Render Table
  function renderTable(){
    tbody.innerHTML = "";
    if (!itemsData || itemsData.length === 0){
      emptyBox.style.display = "block";
      return;
    }
    emptyBox.style.display = "none";

    itemsData.forEach(function(r){
      var tr = document.createElement("tr");
      var trHtml = 
        '<td class="cell-multiline">' + escapeHtml(r.dasar_penugasan) + '</td>' +
        '<td class="cell-multiline">' + escapeHtml(r.instansi_pemberi) + '</td>' +
        '<td class="cell-multiline">' + escapeHtml(r.program) + '</td>' +
        '<td class="cell-multiline">' + escapeHtml(r.kegiatan_output) + '</td>' +
        '<td class="cell-multiline">' + escapeHtml(r.lokasi) + '</td>' +
        '<td class="cell-nowrap center">' + escapeHtml(r.satuan_unit) + '</td>' +
        '<td class="cell-num">' + formatRpDisplay(r.pagu) + '</td>' +
        '<td class="cell-num">' + formatRpDisplay(r.realisasi) + '</td>' +
        '<td class="cell-nowrap">' + escapeHtml(r.sumber_dana) + '</td>' +
        '<td class="cell-num"><span class="badge-capaian ' + getBadgeClass(r.capaian) + '">' + formatPersen(r.capaian) + '</span></td>' +
        '<td class="cell-multiline">' + (r.permasalahan ? escapeHtml(r.permasalahan) : '-') + '</td>' +
        '<td class="cell-multiline">' + (r.solusi ? escapeHtml(r.solusi) : '-') + '</td>';

      if (IS_ROLE_4) {
        trHtml += 
          '<td class="center">' +
            '<div class="action-btns">' +
              '<button type="button" class="btn-icon edit" data-id="' + r.id + '" title="Edit"><i class="fa fa-pencil"></i></button>' +
              '<button type="button" class="btn-icon delete" data-id="' + r.id + '" title="Hapus"><i class="fa fa-trash-o"></i></button>' +
            '</div>' +
          '</td>';
      }

      tr.innerHTML = trHtml;
      tbody.appendChild(tr);
    });
  }

  function clearValidation(){
    requiredInputs.forEach(function(el){ el.classList.remove("is-invalid"); });
    fPagu.classList.remove("is-invalid");
    fRealisasi.classList.remove("is-invalid");
  }

  function resetForm(){
    formTPId.value = "";
    fDasarPenugasan.value = "";
    fInstansiPemberi.value = "";
    fProgram.value = "";
    fLokasi.value = "";
    fKegiatanOutput.value = "";
    fSatuanUnit.value = "";
    fSumberDana.value = "";
    fPagu.value = "";
    fRealisasi.value = "";
    fCapaianInput.value = 0;
    updateCapaianDisplay(0);
    fPermasalahan.value = "";
    fSolusi.value = "";
    clearValidation();
  }

  function openAddModal(){
    resetForm();
    modalTPTitle.textContent = "Tambah Capaian Tugas Pembantuan";
    modalTP.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ fDasarPenugasan.focus(); }, 100);
  }

  function openEditModal(id){
    var item = itemsData.find(function(d){ return Number(d.id) === Number(id); });
    if (!item) return;

    resetForm();
    formTPId.value = item.id;
    fDasarPenugasan.value = item.dasar_penugasan || "";
    fInstansiPemberi.value = item.instansi_pemberi || "";
    fProgram.value = item.program || "";
    fLokasi.value = item.lokasi || "";
    fKegiatanOutput.value = item.kegiatan_output || "";
    fSatuanUnit.value = item.satuan_unit || "";
    fSumberDana.value = item.sumber_dana || "";
    fPagu.value = formatRibuan(String(item.pagu || ""));
    fRealisasi.value = formatRibuan(String(item.realisasi || ""));
    fCapaianInput.value = item.capaian || 0;
    updateCapaianDisplay(item.capaian || 0);
    fPermasalahan.value = item.permasalahan || "";
    fSolusi.value = item.solusi || "";

    modalTPTitle.textContent = "Ubah Capaian Tugas Pembantuan";
    modalTP.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ fDasarPenugasan.focus(); }, 100);
  }

  function closeModal(){
    modalTP.classList.remove("open");
    document.body.style.overflow = "";
    resetForm();
  }

  function validate(){
    var valid = true;
    clearValidation();

    requiredInputs.forEach(function(el){
      if (!el.value.trim()){
        el.classList.add("is-invalid");
        valid = false;
      }
    });

    if (!onlyDigits(fPagu.value)){
      fPagu.classList.add("is-invalid");
      valid = false;
    }
    if (!onlyDigits(fRealisasi.value)){
      fRealisasi.classList.add("is-invalid");
      valid = false;
    }

    if (!valid){
      showToast("Mohon lengkapi seluruh kolom bertanda bintang (*)", true);
    }
    return valid;
  }

  function saveTP(){
    if (!validate()) return;

    var btn = document.getElementById("btnSaveTP");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    var payload = {
      id: formTPId.value,
      tahun: selectTahun.value,
      instansi_id: selectInstansi.value,
      dasar_penugasan: fDasarPenugasan.value.trim(),
      instansi_pemberi: fInstansiPemberi.value.trim(),
      program: fProgram.value.trim(),
      lokasi: fLokasi.value.trim(),
      kegiatan_output: fKegiatanOutput.value.trim(),
      satuan_unit: fSatuanUnit.value.trim(),
      sumber_dana: fSumberDana.value.trim(),
      pagu: fPagu.value,
      realisasi: fRealisasi.value,
      capaian: fCapaianInput.value,
      permasalahan: fPermasalahan.value.trim(),
      solusi: fSolusi.value.trim()
    };

    $.ajax({
      url: BASE_URL + "Instansi/SaveTugasPembantuan",
      type: "POST",
      data: payload,
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
        if (resp.status === "success"){
          showToast(resp.message || "Data berhasil disimpan.");
          closeModal();
          reloadTable();
        } else {
          showToast(resp.message || "Gagal menyimpan data.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
        showToast("Terjadi kesalahan pada server.", true);
      }
    });
  }

  function openDelete(id){
    deleteTargetId = id;
    modalDelete.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  function closeDelete(){
    deleteTargetId = null;
    modalDelete.classList.remove("open");
    document.body.style.overflow = "";
  }

  function confirmDelete(){
    if (!deleteTargetId) return;

    var btn = document.getElementById("btnConfirmDeleteTP");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menghapus...';

    $.ajax({
      url: BASE_URL + "Instansi/DeleteTugasPembantuan",
      type: "POST",
      data: { id: deleteTargetId },
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-trash"></i> Ya, Hapus Data';
        closeDelete();
        if (resp.status === "success"){
          showToast(resp.message || "Data berhasil dihapus.");
          reloadTable();
        } else {
          showToast(resp.message || "Gagal menghapus data.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-trash"></i> Ya, Hapus Data';
        closeDelete();
        showToast("Terjadi kesalahan jaringan.", true);
      }
    });
  }

  function reloadTable(){
    $.ajax({
      url: BASE_URL + "Instansi/GetTugasPembantuan",
      type: "POST",
      data: {
        tahun: selectTahun.value,
        instansi_id: selectInstansi.value
      },
      dataType: "json",
      success: function(resp){
        if (resp.status === "success"){
          itemsData = resp.data || [];
          renderTable();
        }
      }
    });
  }

  var btnTambahTP = document.getElementById("btnTambahTP");
  if (btnTambahTP) {
    btnTambahTP.addEventListener("click", openAddModal);
  }
  document.getElementById("btnTPClose").addEventListener("click", closeModal);
  document.getElementById("btnCancelTP").addEventListener("click", closeModal);
  document.getElementById("btnSaveTP").addEventListener("click", saveTP);

  tbody.addEventListener("click", function(e){
    var btn = e.target.closest(".btn-icon");
    if (!btn) return;
    var id = btn.getAttribute("data-id");
    if (btn.classList.contains("edit")){
      openEditModal(id);
    } else if (btn.classList.contains("delete")){
      openDelete(id);
    }
  });

  document.getElementById("btnCancelDeleteTP").addEventListener("click", closeDelete);
  document.getElementById("btnConfirmDeleteTP").addEventListener("click", confirmDelete);

  modalTP.addEventListener("click", function(e){
    if (e.target === modalTP) closeModal();
  });
  modalDelete.addEventListener("click", function(e){
    if (e.target === modalDelete) closeDelete();
  });

  selectTahun.addEventListener("change", reloadTable);
  if (selectInstansi && selectInstansi.tagName === "SELECT") {
    selectInstansi.addEventListener("change", reloadTable);
  }

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape"){
      if (modalDelete.classList.contains("open")) closeDelete();
      else if (modalTP.classList.contains("open")) closeModal();
    }
  });

  /* ---------------- Top Wilayah Filter (Before Login) ---------------- */
  $(function() {
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var BaseURL = '<?= base_url() ?>';
    var cKodeWilayah = '<?= !empty($KodeWilayah) ? $KodeWilayah : "" ?>';
    var cInstansiId = '<?= !empty($FilterInstansi) ? $FilterInstansi : (!empty($filterInstansi) ? $filterInstansi : (!empty($InstansiId) ? $InstansiId : "")) ?>';

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

    $(document).on('change', '#selProvinsiTop', function() {
      var prov = $(this).val();
      loadKabKotaTop(prov, '');
    });

    $(document).on('change', '#selKabKotaTop', function() {
      var kab = $(this).val();
      loadInstansiTop(kab, '');
    });

    var initialProv = $('#selProvinsiTop').val();
    if (initialProv) {
      loadKabKotaTop(initialProv, cKodeWilayah, function() {
        if (cKodeWilayah) {
          loadInstansiTop(cKodeWilayah, cInstansiId);
        }
      });
    } else if (cKodeWilayah) {
      var provKode = cKodeWilayah.substring(0, 2);
      loadKabKotaTop(provKode, cKodeWilayah, function() {
        loadInstansiTop(cKodeWilayah, cInstansiId);
      });
    }

    $(document).on('click', '#btnFilterWilayahTop', function() {
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

  renderTable();
})();
</script>
