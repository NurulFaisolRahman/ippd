<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: Pengisian Tindak Lanjut Rekomendasi DPRD Tahun N-1
 * Template Notika - Selaras dengan Desain IPPD
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2026;
$filterInstansi = isset($FilterInstansi) ? (int)$FilterInstansi : 1;
$items = isset($Items) ? $Items : [];
$stats = isset($Stats) ? $Stats : ['total' => 0, 'filled' => 0, 'pending' => 0];
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
  margin: 0 0 14px 0;
  line-height: 1.5;
}

/* Stats Chips */
.stat-chips-row {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}
.stat-chip {
  background: #fff;
  border: 1px solid var(--ui-border);
  border-radius: 999px;
  padding: 6px 14px;
  font-size: 13px;
  font-weight: 600;
  color: #334155;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: var(--shadow-card);
}
.stat-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
}
.dot-green { background: var(--ui-primary); }
.dot-amber { background: var(--ui-amber); }

/* Toolbar */
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
}

.tr-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 850px;
}

.tr-table thead th {
  background: #f8fafc;
  color: var(--ui-dark);
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  padding: 14px 16px;
  border-bottom: 2px solid #cbd5e1;
  border-right: 1px solid var(--ui-border);
  text-align: left;
}
.tr-table thead th:last-child {
  border-right: none;
  text-align: center;
}
.tr-table thead th.col-no { width: 50px; text-align: center; }

.tr-table tbody td {
  padding: 16px;
  vertical-align: top;
  font-size: 13.5px;
  line-height: 1.6;
  color: #334155;
  border-bottom: 1px solid var(--ui-border);
  border-right: 1px solid var(--ui-border);
  white-space: pre-wrap;
  word-break: break-word;
}
.tr-table tbody td:last-child { border-right: none; }
.tr-table tbody tr:last-child td { border-bottom: none; }
.tr-table tbody tr:hover td { background: #fdfefe; }

td.col-no { text-align: center; font-weight: 700; color: #94a3b8; }
td.col-rekom { width: 34%; font-weight: 600; color: var(--ui-dark); }
td.col-tindak { width: 28%; }
td.col-tujuan { width: 28%; }
td.col-aksi { width: 10%; text-align: center; white-space: nowrap; }

.empty-placeholder {
  display: inline-block;
  color: #94a3b8;
  font-style: italic;
  font-size: 13px;
  background: #f1f5f9;
  padding: 2px 8px;
  border-radius: 4px;
}

.action-btns {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.btn-icon {
  width: 32px;
  height: 32px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--radius-sm);
  border: 1px solid var(--ui-border);
  background: #fff;
  color: var(--ui-text-muted);
  cursor: pointer;
  transition: all 0.15s ease;
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
  padding: 36px 16px;
  overflow-y: auto;
  z-index: 1050;
}
.modal-overlay.open { display: flex; }

.modal-box {
  background: #fff;
  width: 100%;
  max-width: 680px;
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
  transition: all 0.15s;
}
.modal-close-btn:hover { background: #f1f5f9; color: var(--ui-dark); }

.modal-header-section {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  margin-bottom: 20px;
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
.modal-title {
  margin: 0 0 4px;
  font-size: 20px;
  font-weight: 800;
  color: var(--ui-dark);
}
.modal-subtitle {
  margin: 0;
  font-size: 13px;
  color: var(--ui-text-muted);
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
.form-field label .req { color: var(--ui-red); margin-left: 2px; }
.form-field textarea {
  width: 100%;
  min-height: 85px;
  resize: vertical;
  border: 1px solid #cbd5e1;
  border-radius: var(--radius-sm);
  padding: 10px 12px;
  font-family: inherit;
  font-size: 13.5px;
  line-height: 1.55;
  color: var(--ui-dark);
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}
.form-field textarea:focus {
  border-color: var(--ui-primary);
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.form-field textarea.is-invalid {
  border-color: var(--ui-red);
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
}
.form-field textarea[readonly] {
  background-color: #f8fafc;
  border-color: #cbd5e1;
  color: #334155;
  cursor: not-allowed;
  font-weight: 500;
  user-select: text;
}
.form-field textarea[readonly]:focus {
  border-color: #94a3b8;
  box-shadow: none;
}
.badge-locked {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: #f1f5f9;
  color: #475569;
  border: 1px solid #cbd5e1;
  padding: 3px 8px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.badge-locked-table {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 10.5px;
  font-weight: 700;
  color: #475569;
  background: #e2e8f0;
  padding: 2px 7px;
  border-radius: 4px;
  margin-left: 6px;
  vertical-align: middle;
  text-transform: uppercase;
  letter-spacing: 0.02em;
}
.field-readonly-hint {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: #64748b;
  margin-top: 6px;
  line-height: 1.4;
}
.field-readonly-hint i {
  color: #0284c7;
  font-size: 13px;
}
.field-error-msg {
  display: none;
  font-size: 12px;
  color: var(--ui-red);
  margin-top: 5px;
  font-weight: 600;
}
.field-error-msg.visible { display: block; }

.modal-footer-section {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding-top: 18px;
  border-top: 1px solid var(--ui-border);
  margin-top: 20px;
}

.btn-action {
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
.btn-reset-style { background: #fff; border-color: #cbd5e1; color: var(--ui-text-main); }
.btn-reset-style:hover { background: #f8fafc; }
.btn-save-style { background: var(--ui-primary); color: #fff; }
.btn-save-style:hover { background: var(--ui-primary-hover); }
.btn-danger-style { background: var(--ui-red); color: #fff; }
.btn-danger-style:hover { background: #dc2626; }

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
    <div class="page-badge"><i class="fa fa-institution"></i> E-LKPJ Perangkat Daerah</div>
    <h1 class="page-title">Tindak Lanjut Rekomendasi DPRD Tahun N-1</h1>
    <p class="page-subtitle">Pencatatan dan pemantauan tindak lanjut atas catatan serta rekomendasi DPRD tahun anggaran sebelumnya beserta tujuan penyelesaiannya.</p>
    
    <div class="stat-chips-row">
      <span class="stat-chip"><span class="stat-dot dot-green"></span> <span id="statFilledText"><?= $stats['filled'] ?> dari <?= $stats['total'] ?></span> telah ditindaklanjuti</span>
      <span class="stat-chip"><span class="stat-dot dot-amber"></span> <span id="statPendingText"><?= $stats['pending'] ?></span> belum diisi</span>
    </div>
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

      <div class="t-field">
        <label for="selectInstansi">Perangkat Daerah / Instansi</label>
        <select id="selectInstansi" class="t-select" style="min-width: 260px;">
          <?php foreach ($ListInstansi as $inst): ?>
            <option value="<?= $inst['id'] ?>" <?= ((int)$inst['id'] === $filterInstansi) ? 'selected' : '' ?>><?= htmlspecialchars($inst['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div>
      <button type="button" class="btn-add-primary" id="btnTambahRekom">
        <i class="fa fa-plus"></i> Tambah Rekomendasi DPRD
      </button>
    </div>
  </div>

  <!-- Table Card -->
  <div class="table-card">
    <div class="table-scroll-wrap">
      <table class="tr-table">
        <thead>
          <tr>
            <th class="col-no">No</th>
            <th>Rekomendasi DPRD Tahun N-1 <span class="badge-locked-table"><i class="fa fa-lock"></i> Mutlak</span></th>
            <th>Tindak Lanjut</th>
            <th>Tujuan / Masalah yang Diselesaikan</th>
            <th class="col-aksi">Aksi</th>
          </tr>
        </thead>
        <tbody id="tbodyTinjut">
          <!-- Rendered via JS -->
        </tbody>
      </table>
      <div id="emptyBox" style="display:none; text-align:center; padding:50px 20px; color:#94a3b8;">
        <i class="fa fa-folder-open-o" style="font-size:36px; display:block; margin-bottom:10px;"></i>
        <strong style="color:var(--ui-dark);">Belum ada data rekomendasi DPRD</strong><br>
        Klik tombol <strong>+ Tambah Rekomendasi DPRD</strong> untuk menambahkan data baru.
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah / Ubah -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <button type="button" class="modal-close-btn" id="btnModalClose">&times;</button>
    
    <div class="modal-header-section">
      <div class="modal-icon-badge">
        <i class="fa fa-gavel"></i>
      </div>
      <div>
        <h3 class="modal-title" id="modalTitle">Tinjut Rekomendasi DPRD Tahun N-1</h3>
        <p class="modal-subtitle" id="modalSubtitle">Lengkapi tindak lanjut dan tujuan penyelesaian rekomendasi.</p>
      </div>
    </div>

    <form id="formTinjut" autocomplete="off">
      <input type="hidden" id="formId" value="">

      <div class="form-field">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
          <label for="inputRekom" style="margin-bottom: 0;">Rekomendasi DPRD N-1</label>
          <span class="badge-locked"><i class="fa fa-lock"></i> Data Mutlak (Relasi)</span>
        </div>
        <textarea id="inputRekom" rows="4" readonly placeholder="Uraian rekomendasi dari DPRD tahun sebelumnya..."></textarea>
        <div class="field-readonly-hint">
          <i class="fa fa-info-circle"></i>
          <span>Rekomendasi bersifat <strong>mutlak dari isian relasi data</strong> dan tidak dapat diedit di halaman ini.</span>
        </div>
      </div>

      <div class="form-field">
        <label for="inputTindak">Tindak Lanjut yang Dilakukan <span class="req">*</span></label>
        <textarea id="inputTindak" rows="3" placeholder="Jelaskan tindak lanjut kebijakan/program yang telah dilakukan..."></textarea>
        <div class="field-error-msg" id="errTindak">Tindak lanjut wajib diisi.</div>
      </div>

      <div class="form-field">
        <label for="inputTujuan">Tujuan / Masalah yang Diselesaikan <span class="req">*</span></label>
        <textarea id="inputTujuan" rows="3" placeholder="Jelaskan tujuan atau masalah spesifik yang berhasil diselesaikan..."></textarea>
        <div class="field-error-msg" id="errTujuan">Tujuan / masalah yang diselesaikan wajib diisi.</div>
      </div>

      <div class="modal-footer-section">
        <button type="button" class="btn-action btn-reset-style" id="btnResetForm">
          <i class="fa fa-refresh"></i> Reset
        </button>
        <button type="button" class="btn-action btn-save-style" id="btnSaveForm">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal-overlay" id="modalDeleteOverlay">
  <div class="modal-box" style="max-width:440px; text-align:center; padding:30px 24px;">
    <div style="width:56px; height:56px; border-radius:50%; background:var(--ui-red-light); color:var(--ui-red); display:flex; align-items:center; justify-content:center; font-size:26px; margin:0 auto 16px;">
      <i class="fa fa-trash-o"></i>
    </div>
    <h3 style="margin:0 0 8px; font-size:18px; font-weight:800; color:var(--ui-dark);">Hapus Rekomendasi DPRD?</h3>
    <p style="margin:0 0 20px; font-size:13px; color:var(--ui-text-muted); line-height:1.5;">Data rekomendasi dan catatan tindak lanjut yang dihapus tidak dapat dipulihkan.</p>
    <div style="display:flex; justify-content:center; gap:10px;">
      <button type="button" class="btn-action btn-reset-style" id="btnCancelDelete">Batal</button>
      <button type="button" class="btn-action btn-danger-style" id="btnConfirmDelete">
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
  var itemsData = <?= json_encode($items) ?>;
  var deleteTargetId = null;

  var tbody = document.getElementById("tbodyTinjut");
  var emptyBox = document.getElementById("emptyBox");
  var selectTahun = document.getElementById("selectTahun");
  var selectInstansi = document.getElementById("selectInstansi");

  var statFilledText = document.getElementById("statFilledText");
  var statPendingText = document.getElementById("statPendingText");

  var modalOverlay = document.getElementById("modalOverlay");
  var modalTitle = document.getElementById("modalTitle");
  var modalSubtitle = document.getElementById("modalSubtitle");
  var formId = document.getElementById("formId");
  var inputRekom = document.getElementById("inputRekom");
  var inputTindak = document.getElementById("inputTindak");
  var inputTujuan = document.getElementById("inputTujuan");

  var modalDelete = document.getElementById("modalDeleteOverlay");

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

  function renderTable(){
    tbody.innerHTML = "";
    var total = itemsData.length;
    var filled = 0;

    if (total === 0){
      emptyBox.style.display = "block";
      statFilledText.textContent = "0 dari 0";
      statPendingText.textContent = "0";
      return;
    }
    emptyBox.style.display = "none";

    itemsData.forEach(function(item, idx){
      var isFilled = item.tindak_lanjut && item.tindak_lanjut.trim() !== "" && item.tujuan_masalah && item.tujuan_masalah.trim() !== "";
      if (isFilled) filled++;

      var tr = document.createElement("tr");
      tr.innerHTML = 
        '<td class="col-no">' + (idx + 1) + '</td>' +
        '<td class="col-rekom">' + escapeHtml(item.rekomendasi) + '</td>' +
        '<td class="col-tindak">' + (item.tindak_lanjut && item.tindak_lanjut.trim() ? escapeHtml(item.tindak_lanjut) : '<span class="empty-placeholder">Belum diisi</span>') + '</td>' +
        '<td class="col-tujuan">' + (item.tujuan_masalah && item.tujuan_masalah.trim() ? escapeHtml(item.tujuan_masalah) : '<span class="empty-placeholder">Belum diisi</span>') + '</td>' +
        '<td class="col-aksi">' +
          '<div class="action-btns">' +
            '<button type="button" class="btn-icon edit" data-id="' + item.id + '" title="Isi / Perbarui Tindak Lanjut"><i class="fa fa-pencil"></i></button>' +
            '<button type="button" class="btn-icon delete" data-id="' + item.id + '" title="Hapus"><i class="fa fa-trash-o"></i></button>' +
          '</div>' +
        '</td>';
      tbody.appendChild(tr);
    });

    var pending = total - filled;
    statFilledText.textContent = filled + " dari " + total;
    statPendingText.textContent = pending;
  }

  function clearValidation(){
    [inputTindak, inputTujuan].forEach(function(el){ if (el) el.classList.remove("is-invalid"); });
    document.querySelectorAll(".field-error-msg").forEach(function(el){ el.classList.remove("visible"); });
  }

  function resetForm(){
    formId.value = "";
    inputRekom.value = "";
    inputTindak.value = "";
    inputTujuan.value = "";
    clearValidation();
  }

  function openAddModal(){
    resetForm();
    modalTitle.textContent = "Tambah Rekomendasi DPRD";
    modalSubtitle.textContent = "Tambahkan catatan/rekomendasi DPRD beserta rencana tindak lanjut.";
    modalOverlay.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ inputTindak.focus(); }, 100);
  }

  function openEditModal(id){
    var item = itemsData.find(function(d){ return Number(d.id) === Number(id); });
    if (!item) return;

    resetForm();
    formId.value = item.id;
    inputRekom.value = item.rekomendasi || "";
    inputRekom.readOnly = true;
    inputTindak.value = item.tindak_lanjut || "";
    inputTujuan.value = item.tujuan_masalah || "";

    modalTitle.textContent = "Tindak Lanjut Rekomendasi DPRD";
    modalSubtitle.textContent = "Lengkapi rencana tindak lanjut dan tujuan penyelesaian untuk rekomendasi DPRD.";
    modalOverlay.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ inputTindak.focus(); }, 100);
  }

  function closeModal(){
    modalOverlay.classList.remove("open");
    document.body.style.overflow = "";
    resetForm();
  }

  function validate(){
    var valid = true;
    clearValidation();

    if (!inputTindak.value.trim()){
      inputTindak.classList.add("is-invalid");
      document.getElementById("errTindak").classList.add("visible");
      valid = false;
    }
    if (!inputTujuan.value.trim()){
      inputTujuan.classList.add("is-invalid");
      document.getElementById("errTujuan").classList.add("visible");
      valid = false;
    }
    return valid;
  }

  function saveForm(){
    if (!validate()) return;

    var btn = document.getElementById("btnSaveForm");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    var payload = {
      id: formId.value,
      tahun: selectTahun.value,
      instansi_id: selectInstansi.value,
      rekomendasi: inputRekom.value.trim(),
      tindak_lanjut: inputTindak.value.trim(),
      tujuan_masalah: inputTujuan.value.trim()
    };

    $.ajax({
      url: BASE_URL + "Instansi/SaveTinjutRekomendasiDPRD",
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

    var btn = document.getElementById("btnConfirmDelete");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menghapus...';

    $.ajax({
      url: BASE_URL + "Instansi/DeleteTinjutRekomendasiDPRD",
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
      url: BASE_URL + "Instansi/GetTinjutRekomendasiDPRD",
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

  document.getElementById("btnTambahRekom").addEventListener("click", openAddModal);
  document.getElementById("btnModalClose").addEventListener("click", closeModal);
  document.getElementById("btnResetForm").addEventListener("click", function(){
    inputTindak.value = "";
    inputTujuan.value = "";
    clearValidation();
    inputTindak.focus();
  });
  document.getElementById("btnSaveForm").addEventListener("click", saveForm);

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

  document.getElementById("btnCancelDelete").addEventListener("click", closeDelete);
  document.getElementById("btnConfirmDelete").addEventListener("click", confirmDelete);

  modalOverlay.addEventListener("click", function(e){
    if (e.target === modalOverlay) closeModal();
  });
  modalDelete.addEventListener("click", function(e){
    if (e.target === modalDelete) closeDelete();
  });

  selectTahun.addEventListener("change", reloadTable);
  selectInstansi.addEventListener("change", reloadTable);

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape"){
      if (modalDelete.classList.contains("open")) closeDelete();
      else if (modalOverlay.classList.contains("open")) closeModal();
    }
  });

  renderTable();
})();
</script>
