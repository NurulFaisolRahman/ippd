<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: Pengisian Capaian Program Kegiatan
 * Template Notika - Selaras dengan Desain IPPD
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2026;
$filterInstansi = isset($FilterInstansi) ? (int)$FilterInstansi : 1;
$filterUrusan = isset($FilterUrusan) ? $FilterUrusan : 'Perencanaan';
$groups = isset($Groups) ? $Groups : [];
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
  min-width: 160px;
  outline: none;
  cursor: pointer;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.t-select:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.toggle-budget-box {
  display: flex;
  align-items: center;
  gap: 10px;
  padding-bottom: 6px;
}
.switch-control {
  position: relative;
  display: inline-block;
  width: 44px;
  height: 24px;
}
.switch-control input { opacity: 0; width: 0; height: 0; }
.slider-round {
  position: absolute; cursor: pointer; inset: 0;
  background-color: #cbd5e1;
  border-radius: 34px;
  transition: .2s;
}
.slider-round:before {
  position: absolute; content: "";
  height: 18px; width: 18px;
  left: 3px; bottom: 3px;
  background-color: white;
  border-radius: 50%;
  transition: .2s;
  box-shadow: 0 1px 2px rgba(0,0,0,0.2);
}
.switch-control input:checked + .slider-round { background-color: var(--ui-primary); }
.switch-control input:checked + .slider-round:before { transform: translateX(20px); }

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

.cpk-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  min-width: 1720px;
  font-size: 13px;
}

.cpk-table thead th {
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
.cpk-table thead th.th-anggaran {
  background: #eff6ff;
  color: var(--ui-blue);
}
.cpk-table thead th.center { text-align: center; }
.cpk-table thead th.num { text-align: right; }
.cpk-table thead th:last-child { border-right: none; }

.cpk-table tbody td {
  padding: 12px 14px;
  border-bottom: 1px solid var(--ui-border);
  border-right: 1px solid var(--ui-border);
  vertical-align: top;
  color: #334155;
  line-height: 1.55;
}
.cpk-table tbody td:last-child { border-right: none; }

td.kebijakan-col {
  background: #fafcff;
  font-weight: 600;
  color: var(--ui-dark);
  min-width: 220px;
  border-right: 2px solid var(--ui-border);
}

tr.program-row td {
  background: #ffffff;
}
tr.program-row:hover td {
  background: #f1fbf8;
}

tr.kegiatan-row td {
  background: #fdfefe;
}
tr.kegiatan-row:hover td {
  background: #f1fbf8;
}

.program-name {
  font-weight: 700;
  color: var(--ui-dark);
  text-transform: uppercase;
  font-size: 12.5px;
}

.kegiatan-name {
  color: #1e293b;
  padding-left: 16px;
  position: relative;
}
.kegiatan-name:before {
  content: "";
  position: absolute;
  left: 2px;
  top: 7px;
  width: 7px;
  height: 7px;
  border-left: 2px solid var(--ui-primary);
  border-bottom: 2px solid var(--ui-primary);
}

td.center { text-align: center; white-space: nowrap; }
td.num { text-align: right; white-space: nowrap; font-family: 'Roboto Mono', monospace; font-size: 12.5px; }

.badge-capaian {
  display: inline-block;
  padding: 3px 9px;
  border-radius: 999px;
  font-weight: 700;
  font-size: 12px;
}
.badge-good { background: var(--ui-green-light); color: #065f46; }
.badge-warn { background: var(--ui-amber-light); color: #92400e; }
.badge-bad { background: var(--ui-red-light); color: #991b1b; }

.cell-text-desc {
  min-width: 250px;
  max-width: 320px;
  white-space: pre-wrap;
  word-break: break-word;
  font-size: 12.5px;
}
.empty-cell-text {
  color: #94a3b8;
  font-style: italic;
  font-size: 12px;
}

.hide-budget .col-budget { display: none !important; }

.action-btns {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  white-space: nowrap;
}
.btn-act {
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
.btn-act.eval:hover {
  background: var(--ui-primary-light);
  border-color: var(--ui-primary-border);
  color: var(--ui-primary-text);
}
.btn-act.edit:hover {
  background: var(--ui-blue-light);
  border-color: var(--ui-blue-border);
  color: var(--ui-blue);
}
.btn-act.delete:hover {
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
  max-width: 900px;
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
  margin-bottom: 20px;
}
.modal-header-left {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}
.modal-icon-square {
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

.kpi-info-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: var(--radius-sm);
  padding: 14px 16px;
  margin-bottom: 18px;
}
.kpi-info-grid {
  display: grid;
  grid-template-columns: 2fr 2fr 1fr;
  gap: 12px;
  margin-bottom: 12px;
}
.kpi-info-item label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--ui-text-muted);
  margin-bottom: 4px;
}
.kpi-info-box {
  background: #fff;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 8px 10px;
  font-size: 13px;
  font-weight: 600;
  color: var(--ui-dark);
}

.kpi-table-mini {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  overflow: hidden;
  font-size: 12.5px;
}
.kpi-table-mini th {
  background: #f1f5f9;
  padding: 8px 12px;
  font-weight: 700;
  text-align: center;
  border-bottom: 1px solid #cbd5e1;
}
.kpi-table-mini th:first-child { text-align: left; }
.kpi-table-mini td {
  padding: 8px 12px;
  text-align: center;
  border-bottom: 1px solid #f1f5f9;
  font-family: 'Roboto Mono', monospace;
}
.kpi-table-mini td:first-child { text-align: left; font-family: inherit; font-weight: 700; }

.section-tag {
  font-size: 12.5px;
  font-weight: 800;
  color: var(--ui-primary-text);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin: 16px 0 10px;
}

.form-group-custom {
  margin-bottom: 16px;
}
.form-group-custom label {
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: var(--ui-dark);
  margin-bottom: 6px;
}
.form-group-custom textarea {
  width: 100%;
  min-height: 85px;
  resize: vertical;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 10px 12px;
  font-family: inherit;
  font-size: 13.5px;
  line-height: 1.5;
  color: var(--ui-dark);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}
.form-group-custom textarea:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.char-counter {
  text-align: right;
  font-size: 11.5px;
  color: #94a3b8;
  margin-top: 4px;
}

.form-grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.form-control-input {
  width: 100%;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 8px 12px;
  font-size: 13px;
  outline: none;
}
.form-control-input:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.modal-footer-btn {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding-top: 16px;
  border-top: 1px solid var(--ui-border);
  margin-top: 18px;
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
  <!-- Page Title -->
  <div class="page-header-box">
    <div class="page-badge"><i class="fa fa-line-chart"></i> E-LKPJ Perangkat Daerah</div>
    <h1 class="page-title">Pengisian Capaian Program Kegiatan</h1>
    <p class="page-subtitle">Pelaksanaan Urusan Pemerintahan Daerah (Urusan Wajib & Pilihan), realisasi target kinerja dan anggaran, serta evaluasi permasalahan, solusi, dan tindak lanjut rekomendasi DPRD.</p>
  </div>

  <!-- Toolbar & Filters -->
  <div class="toolbar-card">
    <div class="toolbar-filters">
      <div class="t-field">
        <label for="selTahun">Tahun</label>
        <select id="selTahun" class="t-select">
          <?php foreach ($ListTahun as $th): ?>
            <option value="<?= $th ?>" <?= ((int)$th === $tahunAktif) ? 'selected' : '' ?>><?= $th ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="t-field">
        <label for="selUrusan">Urusan Pemerintahan</label>
        <select id="selUrusan" class="t-select" style="min-width: 220px;">
          <?php foreach ($ListUrusan as $ur): ?>
            <option value="<?= $ur ?>" <?= ($ur === $filterUrusan) ? 'selected' : '' ?>><?= htmlspecialchars($ur) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <?php if (!empty($IsDaerah)): ?>
        <div class="t-field">
          <label for="selInstansi">Perangkat Daerah / Instansi</label>
          <select id="selInstansi" class="t-select" style="min-width: 240px;">
            <option value="0">-- Semua Perangkat Daerah --</option>
            <?php foreach ($ListInstansi as $inst): ?>
              <option value="<?= $inst['id'] ?>" <?= ((int)$inst['id'] === (int)$filterInstansi) ? 'selected' : '' ?>><?= htmlspecialchars($inst['nama']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php else: ?>
        <input type="hidden" id="selInstansi" value="<?= $filterInstansi ?>">
      <?php endif; ?>

      <div class="toggle-budget-box">
        <label class="switch-control">
          <input type="checkbox" id="toggleAnggaran" checked>
          <span class="slider-round"></span>
        </label>
        <label for="toggleAnggaran" style="font-size:13px; font-weight:700; color:var(--ui-dark); cursor:pointer; user-select:none;">Tampilkan Anggaran</label>
      </div>
    </div>
  </div>

  <!-- Table Card -->
  <div class="table-card">
    <div class="table-scroll-wrap" id="tableScrollWrap">
      <table class="cpk-table">
        <thead>
          <tr>
            <th style="min-width: 200px;">Kebijakan</th>
            <th style="min-width: 260px;">Uraian Program / Kegiatan</th>
            <th style="min-width: 230px;">Indikator</th>
            <th class="center" style="width: 80px;">Satuan</th>
            <th class="num" style="width: 90px;">Target</th>
            <th class="num" style="width: 90px;">Realisasi</th>
            <th class="num" style="width: 90px;">Capaian (%)</th>
            <th class="num th-anggaran col-budget" style="width: 140px;">Anggaran (Rp)</th>
            <th class="num th-anggaran col-budget" style="width: 140px;">Realisasi (Rp)</th>
            <th class="num th-anggaran col-budget" style="width: 100px;">Capaian (%)</th>
            <th style="min-width: 240px;">Permasalahan</th>
            <th style="min-width: 240px;">Upaya Mengatasi Permasalahan</th>
            <th style="min-width: 240px;">Tinjut Rekomendasi DPRD</th>
            <th class="center" style="width: 80px;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tbodyCPK">
          <!-- Rendered via JS -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ============================================================== -->
<!-- MODAL: INPUT EVALUASI (Permasalahan, Upaya & Tinjut)          -->
<!-- ============================================================== -->
<div class="modal-overlay" id="modalEvaluasiOverlay">
  <div class="modal-box-lg">
    <div class="modal-header-flex">
      <div class="modal-header-left">
        <div class="modal-icon-square">
          <i class="fa fa-commenting-o"></i>
        </div>
        <div>
          <h3 class="modal-title-text" id="evalModalTitle">Input Permasalahan, Upaya &amp; Tinjut Rekomendasi DPRD</h3>
          <p class="modal-sub-text">Lengkapi evaluasi permasalahan, langkah perbaikan, dan tindak lanjut rekomendasi legislatif.</p>
        </div>
      </div>
      <button type="button" class="btn-act" id="btnCloseEvalModal" style="width:34px; height:34px; font-size:16px;">&times;</button>
    </div>

    <!-- KPI Information Box -->
    <div class="kpi-info-card">
      <div class="kpi-info-grid">
        <div class="kpi-info-item">
          <label id="lblUraian">Program / Kegiatan</label>
          <div class="kpi-info-box" id="evalUraianText">-</div>
        </div>
        <div class="kpi-info-item">
          <label>Indikator</label>
          <div class="kpi-info-box" id="evalIndikatorText">-</div>
        </div>
        <div class="kpi-info-item">
          <label>Satuan</label>
          <div class="kpi-info-box" id="evalSatuanText">-</div>
        </div>
      </div>

      <table class="kpi-table-mini">
        <thead>
          <tr>
            <th>Kategori</th>
            <th>Target</th>
            <th>Realisasi</th>
            <th>Capaian</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Kinerja</td>
            <td id="evalTargetK">-</td>
            <td id="evalRealisasiK">-</td>
            <td id="evalCapaianK">-</td>
          </tr>
          <tr>
            <td>Anggaran</td>
            <td id="evalTargetA">-</td>
            <td id="evalRealisasiA">-</td>
            <td id="evalCapaianA">-</td>
          </tr>
        </tbody>
      </table>
    </div>

    <input type="hidden" id="evalItemId" value="">

    <div class="section-tag"><i class="fa fa-commenting-o"></i> Informasi Evaluasi Tekstual</div>

    <div class="form-group-custom">
      <label for="evalPermasalahan">Permasalahan</label>
      <textarea id="evalPermasalahan" maxlength="2000" placeholder="Jelaskan kendala/permasalahan yang dihadapi dalam pelaksanaan ini..."></textarea>
      <div class="char-counter" id="countPermasalahan">0 / 2000</div>
    </div>

    <div class="form-group-custom">
      <label for="evalUpaya">Upaya Mengatasi Permasalahan</label>
      <textarea id="evalUpaya" maxlength="2000" placeholder="Jelaskan upaya atau tindak lanjut yang telah/akan dilakukan..."></textarea>
      <div class="char-counter" id="countUpaya">0 / 2000</div>
    </div>

    <div class="form-group-custom">
      <label for="evalTinjut">Tindak Lanjut Rekomendasi DPRD</label>
      <textarea id="evalTinjut" maxlength="2000" placeholder="Jelaskan tindak lanjut atas rekomendasi DPRD terkait kegiatan ini..."></textarea>
      <div class="char-counter" id="countTinjut">0 / 2000</div>
    </div>

    <div class="modal-footer-btn">
      <button type="button" class="btn-pill btn-pill-reset" id="btnResetEval">Reset</button>
      <button type="button" class="btn-pill btn-pill-save" id="btnSaveEval">
        <i class="fa fa-save"></i> Simpan Evaluasi
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
  var groupData = <?= json_encode($groups) ?>;

  // DOM Elements
  var tbody = document.getElementById("tbodyCPK");
  var selTahun = document.getElementById("selTahun");
  var selUrusan = document.getElementById("selUrusan");
  var selInstansi = document.getElementById("selInstansi");
  var toggleAnggaran = document.getElementById("toggleAnggaran");
  var tableScrollWrap = document.getElementById("tableScrollWrap");

  // Modals
  var modalEvaluasi = document.getElementById("modalEvaluasiOverlay");

  // Format Helpers
  function fmtNum(n){
    if (n === null || n === undefined || n === "") return "-";
    return Number(n).toLocaleString("id-ID");
  }
  function fmtPersen(n){
    if (n === null || n === undefined || n === "") return "0.00%";
    return Number(n).toFixed(2).replace(".", ",") + "%";
  }
  function fmtRp(n){
    if (n === null || n === undefined || n === "") return "-";
    return "Rp " + Number(n).toLocaleString("id-ID", { minimumFractionDigits: 0, maximumFractionDigits: 0 });
  }
  function getBadgeClass(cap){
    var n = Number(cap) || 0;
    if (n >= 90) return "badge-good";
    if (n >= 76) return "badge-warn";
    return "badge-bad";
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

  // Render Table
  function renderTable(){
    tbody.innerHTML = "";

    if (!groupData || groupData.length === 0){
      tbody.innerHTML = 
        '<tr><td colspan="14" style="text-align:center; padding:60px 20px; color:#94a3b8;">' +
        '<i class="fa fa-folder-open-o" style="font-size:38px; display:block; margin-bottom:10px;"></i>' +
        '<strong style="color:var(--ui-dark); font-size:15px;">Belum Ada Data Program / Kegiatan</strong><br>' +
        'Data capaian otomatis dimuat dari Realisasi Renaksi dan Sasaran Renstra Perangkat Daerah.' +
        '</td></tr>';
      return;
    }

    var htmlRows = [];

    groupData.forEach(function(grp, gIdx){
      var p = grp.program || {};
      var kegs = grp.kegiatan || [];
      var totalRows = (p.uraian || p.id ? 1 : 0) + kegs.length;
      if (totalRows === 0) return;

      var kebijakanCellRendered = false;
      var kebijakanText = grp.kebijakan || (p.kebijakan || '-');

      // Program Row
      if (p.uraian || p.id){
        var badgeK = getBadgeClass(p.capaian);
        var badgeA = getBadgeClass(p.capaian_anggaran);
        var pCodeLabel = p.kode ? '<span style="color:var(--ui-blue); font-weight:700; margin-right:4px;">[' + escapeHtml(p.kode) + ']</span> ' : '';

        var trHtml = '<tr class="program-row">';
        if (!kebijakanCellRendered){
          trHtml += '<td class="kebijakan-col" rowspan="' + totalRows + '">' + escapeHtml(kebijakanText) + '</td>';
          kebijakanCellRendered = true;
        }

        trHtml += 
          '<td><span class="program-name">' + pCodeLabel + escapeHtml(p.uraian) + '</span></td>' +
          '<td>' + escapeHtml(p.indikator || '-') + '</td>' +
          '<td class="center">' + escapeHtml(p.satuan || '%') + '</td>' +
          '<td class="num">' + fmtNum(p.target) + '</td>' +
          '<td class="num">' + fmtNum(p.realisasi) + '</td>' +
          '<td class="num"><span class="badge-capaian ' + badgeK + '">' + fmtPersen(p.capaian) + '</span></td>' +
          '<td class="num col-budget">' + fmtRp(p.anggaran) + '</td>' +
          '<td class="num col-budget">' + fmtRp(p.realisasi_anggaran) + '</td>' +
          '<td class="num col-budget"><span class="badge-capaian ' + badgeA + '">' + fmtPersen(p.capaian_anggaran) + '</span></td>' +
          '<td class="cell-text-desc">' + (p.permasalahan ? escapeHtml(p.permasalahan) : '<span class="empty-cell-text">Belum diisi</span>') + '</td>' +
          '<td class="cell-text-desc">' + (p.upaya ? escapeHtml(p.upaya) : '<span class="empty-cell-text">Belum diisi</span>') + '</td>' +
          '<td class="cell-text-desc">' + (p.tinjut ? escapeHtml(p.tinjut) : '<span class="empty-cell-text">Belum diisi</span>') + '</td>' +
          '<td class="center">' +
            (IS_ROLE_4 ? ('<div class="action-btns">' +
              '<button type="button" class="btn-act eval" onclick="window.CPK.openEval(\'' + (p.id || p.kode) + '\')" title="Input Permasalahan, Upaya & Tinjut"><i class="fa fa-pencil"></i></button>' +
            '</div>') : '<span style="color:#94a3b8; font-size:12px;">-</span>') +
          '</td>' +
        '</tr>';

        htmlRows.push(trHtml);
      }

      // Kegiatan Rows
      kegs.forEach(function(k){
        var badgeKK = getBadgeClass(k.capaian);
        var badgeKA = getBadgeClass(k.capaian_anggaran);
        var kCodeLabel = k.kode ? '<span style="color:#0284c7; font-weight:700; margin-right:4px;">[' + escapeHtml(k.kode) + ']</span> ' : '';

        var trHtml = '<tr class="kegiatan-row">';
        if (!kebijakanCellRendered){
          trHtml += '<td class="kebijakan-col" rowspan="' + totalRows + '">' + escapeHtml(kebijakanText) + '</td>';
          kebijakanCellRendered = true;
        }

        trHtml += 
          '<td><span class="kegiatan-name">' + kCodeLabel + escapeHtml(k.uraian) + '</span></td>' +
          '<td>' + escapeHtml(k.indikator || '-') + '</td>' +
          '<td class="center">' + escapeHtml(k.satuan || '%') + '</td>' +
          '<td class="num">' + fmtNum(k.target) + '</td>' +
          '<td class="num">' + fmtNum(k.realisasi) + '</td>' +
          '<td class="num"><span class="badge-capaian ' + badgeKK + '">' + fmtPersen(k.capaian) + '</span></td>' +
          '<td class="num col-budget">' + fmtRp(k.anggaran) + '</td>' +
          '<td class="num col-budget">' + fmtRp(k.realisasi_anggaran) + '</td>' +
          '<td class="num col-budget"><span class="badge-capaian ' + badgeKA + '">' + fmtPersen(k.capaian_anggaran) + '</span></td>' +
          '<td class="cell-text-desc">' + (k.permasalahan ? escapeHtml(k.permasalahan) : '<span class="empty-cell-text">Belum diisi</span>') + '</td>' +
          '<td class="cell-text-desc">' + (k.upaya ? escapeHtml(k.upaya) : '<span class="empty-cell-text">Belum diisi</span>') + '</td>' +
          '<td class="cell-text-desc">' + (k.tinjut ? escapeHtml(k.tinjut) : '<span class="empty-cell-text">Belum diisi</span>') + '</td>' +
          '<td class="center">' +
            (IS_ROLE_4 ? ('<div class="action-btns">' +
              '<button type="button" class="btn-act eval" onclick="window.CPK.openEval(\'' + (k.id || k.kode) + '\')" title="Input Permasalahan, Upaya & Tinjut"><i class="fa fa-pencil"></i></button>' +
            '</div>') : '<span style="color:#94a3b8; font-size:12px;">-</span>') +
          '</td>' +
        '</tr>';

        htmlRows.push(trHtml);
      });
    });

    tbody.innerHTML = htmlRows.join("");
  }

  function findItemById(id){
    for (var i = 0; i < groupData.length; i++){
      var g = groupData[i];
      if (g.program && (String(g.program.id) === String(id) || (g.program.kode && String(g.program.kode) === String(id)))) return g.program;
      if (g.kegiatan){
        for (var j = 0; j < g.kegiatan.length; j++){
          var item = g.kegiatan[j];
          if (String(item.id) === String(id) || (item.kode && String(item.kode) === String(id))) return item;
        }
      }
    }
    return null;
  }

  function updateCharCounters(){
    [["evalPermasalahan","countPermasalahan"],["evalUpaya","countUpaya"],["evalTinjut","countTinjut"]].forEach(function(pair){
      var el = document.getElementById(pair[0]);
      var cnt = document.getElementById(pair[1]);
      if (el && cnt){
        cnt.textContent = el.value.length + " / 2000";
      }
    });
  }

  ["evalPermasalahan","evalUpaya","evalTinjut"].forEach(function(id){
    var el = document.getElementById(id);
    if (el) el.addEventListener("input", updateCharCounters);
  });

  // Modal: Open Evaluasi Modal
  function openEvalModal(id){
    var item = findItemById(id);
    if (!item) return;

    document.getElementById("evalItemId").value = item.id || item.kode || "";
    document.getElementById("evalUraianText").textContent = (item.kode ? '[' + item.kode + '] ' : '') + (item.uraian || "-");
    document.getElementById("evalIndikatorText").textContent = item.indikator || "-";
    document.getElementById("evalSatuanText").textContent = item.satuan || "-";

    document.getElementById("evalTargetK").textContent = fmtNum(item.target);
    document.getElementById("evalRealisasiK").textContent = fmtNum(item.realisasi);
    document.getElementById("evalCapaianK").textContent = fmtPersen(item.capaian);

    document.getElementById("evalTargetA").textContent = fmtRp(item.anggaran);
    document.getElementById("evalRealisasiA").textContent = fmtRp(item.realisasi_anggaran);
    document.getElementById("evalCapaianA").textContent = fmtPersen(item.capaian_anggaran);

    document.getElementById("evalPermasalahan").value = item.permasalahan || "";
    document.getElementById("evalUpaya").value = item.upaya || "";
    document.getElementById("evalTinjut").value = item.tinjut || "";
    updateCharCounters();

    modalEvaluasi.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  function closeEvalModal(){
    modalEvaluasi.classList.remove("open");
    document.body.style.overflow = "";
  }

  document.getElementById("btnCloseEvalModal").addEventListener("click", closeEvalModal);
  document.getElementById("btnResetEval").addEventListener("click", function(){
    document.getElementById("evalPermasalahan").value = "";
    document.getElementById("evalUpaya").value = "";
    document.getElementById("evalTinjut").value = "";
    updateCharCounters();
  });

  document.getElementById("btnSaveEval").addEventListener("click", function(){
    var id = document.getElementById("evalItemId").value;
    var item = findItemById(id) || {};
    var btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    $.ajax({
      url: BASE_URL + "Instansi/SaveEvaluasiProgramKegiatan",
      type: "POST",
      data: {
        id: item.id || 0,
        kode: item.kode || "",
        tipe: item.tipe || "kegiatan",
        parent_id: item.parent_id || null,
        kebijakan: item.kebijakan || "",
        uraian: item.uraian || "",
        indikator: item.indikator || "",
        satuan: item.satuan || "",
        target: item.target || 0,
        realisasi: item.realisasi || 0,
        capaian: item.capaian || 0,
        anggaran: item.anggaran || 0,
        realisasi_anggaran: item.realisasi_anggaran || 0,
        capaian_anggaran: item.capaian_anggaran || 0,
        tahun: selTahun.value,
        urusan: selUrusan.value,
        instansi_id: selInstansi.value,
        permasalahan: document.getElementById("evalPermasalahan").value,
        upaya: document.getElementById("evalUpaya").value,
        tinjut: document.getElementById("evalTinjut").value
      },
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Evaluasi';
        if (resp.status === "success"){
          showToast("Evaluasi pelaksanaan berhasil disimpan.");
          closeEvalModal();
          reloadTable();
        } else {
          showToast(resp.message || "Gagal menyimpan evaluasi.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Evaluasi';
        showToast("Terjadi kesalahan koneksi.", true);
      }
    });
  });

  // Reload Table via AJAX
  function reloadTable(){
    $.ajax({
      url: BASE_URL + "Instansi/GetCapaianProgramKegiatan",
      type: "POST",
      data: {
        tahun: selTahun.value,
        urusan: selUrusan.value,
        instansi_id: selInstansi.value
      },
      dataType: "json",
      success: function(resp){
        if (resp.status === "success"){
          groupData = resp.data || [];
          renderTable();
        }
      }
    });
  }

  selTahun.addEventListener("change", reloadTable);
  selUrusan.addEventListener("change", reloadTable);
  if (selInstansi && selInstansi.tagName === "SELECT") {
    selInstansi.addEventListener("change", reloadTable);
  }

  toggleAnggaran.addEventListener("change", function(){
    tableScrollWrap.classList.toggle("hide-budget", !this.checked);
  });

  // Window CPK methods for inline onclick
  window.CPK = {
    openEval: openEvalModal
  };

  // Init
  renderTable();
})();
</script>
