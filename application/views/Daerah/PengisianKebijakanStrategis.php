<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: Pengisian Kebijakan Strategis
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

/* Filter Card */
.filter-card {
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

.filter-left {
  display: flex;
  align-items: flex-end;
  gap: 14px;
  flex-wrap: wrap;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.filter-group label {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: var(--ui-text-muted);
}
.filter-select {
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
.filter-select:focus {
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
  transition: background 0.15s ease, transform 0.1s ease;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.25);
}
.btn-add-primary:hover {
  background: var(--ui-primary-hover);
}
.btn-add-primary:active {
  transform: translateY(1px);
}

/* Table Card */
.table-card {
  background: var(--ui-card-bg);
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-card);
  overflow: hidden;
}

.table-wrapper {
  overflow-x: auto;
}

.custom-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 850px;
}

.custom-table thead th {
  background: #f8fafc;
  color: var(--ui-dark);
  font-size: 12.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  padding: 14px 16px;
  border-bottom: 2px solid #cbd5e1;
  border-right: 1px solid var(--ui-border);
  text-align: left;
}
.custom-table thead th:last-child {
  border-right: none;
  text-align: center;
}
.col-kebijakan { width: 28%; }
.col-hukum { width: 25%; }
.col-tujuan { width: 37%; }
.col-aksi { width: 10%; text-align: center; }

.custom-table tbody td {
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
.custom-table tbody td:last-child {
  border-right: none;
}
.custom-table tbody tr:last-child td {
  border-bottom: none;
}
.custom-table tbody tr:hover td {
  background: #fdfefe;
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

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--ui-text-muted);
}
.empty-state i {
  font-size: 42px;
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
  font-size: 13.5px;
}

/* Modal Overlay */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15,23,42,0.55);
  backdrop-filter: blur(2px);
  display: none;
  align-items: flex-start;
  justify-content: center;
  padding: 40px 16px;
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
.modal-close-btn:hover {
  background: #f1f5f9;
  color: var(--ui-dark);
}

.modal-header-section {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  margin-bottom: 18px;
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

/* Info Box */
.info-notice {
  display: flex;
  gap: 12px;
  background: var(--ui-primary-light);
  border: 1px solid var(--ui-primary-border);
  border-radius: var(--radius-sm);
  padding: 12px 14px;
  margin-bottom: 20px;
}
.info-notice i {
  color: var(--ui-primary-text);
  font-size: 16px;
  margin-top: 2px;
  flex-shrink: 0;
}
.info-notice strong {
  display: block;
  font-size: 13px;
  color: var(--ui-primary-text);
  margin-bottom: 2px;
}
.info-notice p {
  margin: 0;
  font-size: 12.5px;
  line-height: 1.5;
  color: #1e3a34;
}

/* Form Styles */
.form-field {
  margin-bottom: 16px;
}
.form-field label {
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: var(--ui-dark);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.02em;
}
.form-field label .req {
  color: var(--ui-red);
  margin-left: 2px;
}
.form-field textarea {
  width: 100%;
  min-height: 90px;
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
.btn-reset-style {
  background: #fff;
  border-color: #cbd5e1;
  color: var(--ui-text-main);
}
.btn-reset-style:hover {
  background: #f8fafc;
}
.btn-save-style {
  background: var(--ui-primary);
  color: #fff;
}
.btn-save-style:hover {
  background: var(--ui-primary-hover);
}
.btn-danger-style {
  background: var(--ui-red);
  color: #fff;
}
.btn-danger-style:hover {
  background: #dc2626;
}

/* Modal Confirm Delete */
.modal-confirm-box {
  max-width: 440px;
  text-align: center;
  padding: 30px 26px 24px;
}
.modal-confirm-icon {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: var(--ui-red-light);
  color: var(--ui-red);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  margin: 0 auto 16px;
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
.toast-msg.show {
  opacity: 1;
  transform: translateY(0);
}
.toast-msg.error {
  border-left-color: var(--ui-red);
}
</style>

<div class="main-content">
  <!-- Header Title -->
  <div class="page-header-box">
    <div class="page-badge"><i class="fa fa-book"></i> E-LKPJ Perangkat Daerah</div>
    <h1 class="page-title">Pengisian Kebijakan Strategis</h1>
    <p class="page-subtitle">Pencatatan kebijakan strategis kepala daerah, dasar hukum, serta tujuan/masalah yang diselesaikan dalam periode anggaran.</p>
  </div>

  <!-- Filter & Actions Toolbar -->
  <div class="filter-card">
    <div class="filter-left">
      <div class="filter-group">
        <label for="selectTahun">Tahun Anggaran</label>
        <select id="selectTahun" class="filter-select">
          <?php foreach ($ListTahun as $th): ?>
            <option value="<?= $th ?>" <?= ((int)$th === $tahunAktif) ? 'selected' : '' ?>><?= $th ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="filter-group">
        <label for="selectInstansi">Perangkat Daerah / Instansi</label>
        <select id="selectInstansi" class="filter-select" style="min-width: 260px;">
          <?php foreach ($ListInstansi as $inst): ?>
            <option value="<?= $inst['id'] ?>" <?= ((int)$inst['id'] === $filterInstansi) ? 'selected' : '' ?>><?= htmlspecialchars($inst['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div>
      <button type="button" class="btn-add-primary" id="btnBukaTambah">
        <i class="fa fa-plus"></i> Tambah Kebijakan Strategis
      </button>
    </div>
  </div>

  <!-- Data Table Card -->
  <div class="table-card">
    <div class="table-wrapper">
      <table class="custom-table">
        <thead>
          <tr>
            <th class="col-kebijakan">Kebijakan Strategis</th>
            <th class="col-hukum">Dasar Hukum</th>
            <th class="col-tujuan">Tujuan / Masalah yang Diselesaikan</th>
            <th class="col-aksi">Aksi</th>
          </tr>
        </thead>
        <tbody id="tbodyKebijakan">
          <!-- Rendered via JS -->
        </tbody>
      </table>
      <div class="empty-state" id="emptyStateBox" style="display: none;">
        <i class="fa fa-folder-open-o"></i>
        <h4>Belum ada data kebijakan strategis</h4>
        <p>Silakan klik tombol <strong>+ Tambah Kebijakan Strategis</strong> di atas untuk menambahkan data baru.</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah / Edit -->
<div class="modal-overlay" id="modalKebijakanOverlay">
  <div class="modal-box">
    <button type="button" class="modal-close-btn" id="btnModalClose" aria-label="Tutup">&times;</button>
    
    <div class="modal-header-section">
      <div class="modal-icon-badge">
        <i class="fa fa-file-text-o"></i>
      </div>
      <div>
        <h3 class="modal-title" id="modalTitleText">Kebijakan Strategis</h3>
        <p class="modal-subtitle" id="modalSubtitleText">Lengkapi informasi kebijakan strategis daerah.</p>
      </div>
    </div>

    <div class="info-notice">
      <i class="fa fa-info-circle"></i>
      <div>
        <strong>Keterangan:</strong>
        <p>Kebijakan yang diambil meliputi peraturan kepala daerah dan keputusan atau tindakan kepala daerah dalam menyelesaikan masalah masyarakat yang strategis yang diambil dalam satu tahun anggaran.</p>
      </div>
    </div>

    <form id="formKebijakanStrategis" autocomplete="off">
      <input type="hidden" id="inputEditId" value="">

      <div class="form-field">
        <label for="inputKebijakan">Kebijakan Strategis <span class="req">*</span></label>
        <textarea id="inputKebijakan" rows="3" placeholder="Masukkan kebijakan strategis..."></textarea>
        <div class="field-error-msg" id="errKebijakan">Kebijakan strategis wajib diisi.</div>
      </div>

      <div class="form-field">
        <label for="inputHukum">Dasar Hukum <span class="req">*</span></label>
        <textarea id="inputHukum" rows="3" placeholder="Masukkan nomor dan nama regulasi dasar hukum..."></textarea>
        <div class="field-error-msg" id="errHukum">Dasar hukum wajib diisi.</div>
      </div>

      <div class="form-field">
        <label for="inputTujuan">Tujuan / Masalah yang Diselesaikan <span class="req">*</span></label>
        <textarea id="inputTujuan" rows="4" placeholder="Jelaskan tujuan atau masalah strategis yang diselesaikan..."></textarea>
        <div class="field-error-msg" id="errTujuan">Tujuan / masalah yang diselesaikan wajib diisi.</div>
      </div>

      <div class="modal-footer-section">
        <button type="button" class="btn-action btn-reset-style" id="btnModalReset">
          <i class="fa fa-refresh"></i> Reset
        </button>
        <button type="button" class="btn-action btn-save-style" id="btnModalSimpan">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal-overlay" id="modalHapusOverlay">
  <div class="modal-box modal-confirm-box">
    <div class="modal-confirm-icon">
      <i class="fa fa-trash-o"></i>
    </div>
    <h3 style="margin:0 0 8px; font-size:18px; font-weight:800; color:var(--ui-dark);">Hapus Kebijakan Strategis?</h3>
    <p style="margin:0 0 20px; font-size:13.5px; color:var(--ui-text-muted); line-height:1.5;">Data yang dihapus tidak akan ditampilkan lagi dalam tabel laporan E-LKPJ.</p>
    <div style="display:flex; justify-content:center; gap:10px;">
      <button type="button" class="btn-action btn-reset-style" id="btnBatalHapus">Batal</button>
      <button type="button" class="btn-action btn-danger-style" id="btnKonfirmHapus">
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
  var dataItems = <?= json_encode($items) ?>;
  var deleteTargetId = null;

  // DOM Elements
  var tbody = document.getElementById("tbodyKebijakan");
  var emptyState = document.getElementById("emptyStateBox");
  var selectTahun = document.getElementById("selectTahun");
  var selectInstansi = document.getElementById("selectInstansi");

  var modalOverlay = document.getElementById("modalKebijakanOverlay");
  var modalTitle = document.getElementById("modalTitleText");
  var modalSubtitle = document.getElementById("modalSubtitleText");
  var inputId = document.getElementById("inputEditId");
  var inputKebijakan = document.getElementById("inputKebijakan");
  var inputHukum = document.getElementById("inputHukum");
  var inputTujuan = document.getElementById("inputTujuan");

  var modalHapus = document.getElementById("modalHapusOverlay");

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
    if (!dataItems || dataItems.length === 0){
      emptyState.style.display = "block";
      return;
    }
    emptyState.style.display = "none";

    dataItems.forEach(function(item){
      var tr = document.createElement("tr");
      tr.innerHTML = 
        '<td>' + escapeHtml(item.kebijakan_strategis) + '</td>' +
        '<td>' + escapeHtml(item.dasar_hukum) + '</td>' +
        '<td>' + escapeHtml(item.tujuan_masalah) + '</td>' +
        '<td class="col-aksi">' +
          '<div class="action-btns">' +
            '<button type="button" class="btn-icon edit" data-id="' + item.id + '" title="Edit">' +
              '<i class="fa fa-pencil"></i>' +
            '</button>' +
            '<button type="button" class="btn-icon delete" data-id="' + item.id + '" title="Hapus">' +
              '<i class="fa fa-trash-o"></i>' +
            '</button>' +
          '</div>' +
        '</td>';
      tbody.appendChild(tr);
    });
  }

  function clearValidation(){
    [inputKebijakan, inputHukum, inputTujuan].forEach(function(el){
      el.classList.remove("is-invalid");
    });
    document.querySelectorAll(".field-error-msg").forEach(function(err){
      err.classList.remove("visible");
    });
  }

  function resetFormFields(){
    inputId.value = "";
    inputKebijakan.value = "";
    inputHukum.value = "";
    inputTujuan.value = "";
    clearValidation();
  }

  function openAddModal(){
    resetFormFields();
    modalTitle.textContent = "Tambah Kebijakan Strategis";
    modalSubtitle.textContent = "Lengkapi informasi kebijakan strategis daerah.";
    modalOverlay.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ inputKebijakan.focus(); }, 100);
  }

  function openEditModal(id){
    var item = dataItems.find(function(d){ return Number(d.id) === Number(id); });
    if (!item) return;

    resetFormFields();
    inputId.value = item.id;
    inputKebijakan.value = item.kebijakan_strategis;
    inputHukum.value = item.dasar_hukum;
    inputTujuan.value = item.tujuan_masalah;

    modalTitle.textContent = "Ubah Kebijakan Strategis";
    modalSubtitle.textContent = "Perbarui informasi kebijakan strategis daerah.";
    modalOverlay.classList.add("open");
    document.body.style.overflow = "hidden";
    setTimeout(function(){ inputKebijakan.focus(); }, 100);
  }

  function closeModal(){
    modalOverlay.classList.remove("open");
    document.body.style.overflow = "";
    resetFormFields();
  }

  function validateForm(){
    var valid = true;
    clearValidation();

    if (!inputKebijakan.value.trim()){
      inputKebijakan.classList.add("is-invalid");
      document.getElementById("errKebijakan").classList.add("visible");
      valid = false;
    }
    if (!inputHukum.value.trim()){
      inputHukum.classList.add("is-invalid");
      document.getElementById("errHukum").classList.add("visible");
      valid = false;
    }
    if (!inputTujuan.value.trim()){
      inputTujuan.classList.add("is-invalid");
      document.getElementById("errTujuan").classList.add("visible");
      valid = false;
    }
    return valid;
  }

  function simpanData(){
    if (!validateForm()) return;

    var btn = document.getElementById("btnModalSimpan");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    var payload = {
      id: inputId.value,
      tahun: selectTahun.value,
      instansi_id: selectInstansi.value,
      kebijakan_strategis: inputKebijakan.value.trim(),
      dasar_hukum: inputHukum.value.trim(),
      tujuan_masalah: inputTujuan.value.trim()
    };

    $.ajax({
      url: BASE_URL + "Instansi/SaveKebijakanStrategis",
      type: "POST",
      data: payload,
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
        if (resp.status === "success"){
          showToast(resp.message || "Data berhasil disimpan.");
          closeModal();
          reloadTableData();
        } else {
          showToast(resp.message || "Gagal menyimpan data.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
        showToast("Terjadi kesalahan jaringan atau server.", true);
      }
    });
  }

  function reloadTableData(){
    $.ajax({
      url: BASE_URL + "Instansi/GetKebijakanStrategis",
      type: "POST",
      data: {
        tahun: selectTahun.value,
        instansi_id: selectInstansi.value
      },
      dataType: "json",
      success: function(resp){
        if (resp.status === "success"){
          dataItems = resp.data || [];
          renderTable();
        }
      }
    });
  }

  function openHapusModal(id){
    deleteTargetId = id;
    modalHapus.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  function closeHapusModal(){
    deleteTargetId = null;
    modalHapus.classList.remove("open");
    document.body.style.overflow = "";
  }

  function konfirmHapus(){
    if (!deleteTargetId) return;

    var btn = document.getElementById("btnKonfirmHapus");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menghapus...';

    $.ajax({
      url: BASE_URL + "Instansi/DeleteKebijakanStrategis",
      type: "POST",
      data: { id: deleteTargetId },
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-trash"></i> Ya, Hapus Data';
        closeHapusModal();
        if (resp.status === "success"){
          showToast(resp.message || "Data berhasil dihapus.");
          reloadTableData();
        } else {
          showToast(resp.message || "Gagal menghapus data.", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-trash"></i> Ya, Hapus Data';
        closeHapusModal();
        showToast("Terjadi kesalahan pada server.", true);
      }
    });
  }

  // Event Listeners
  document.getElementById("btnBukaTambah").addEventListener("click", openAddModal);
  document.getElementById("btnModalClose").addEventListener("click", closeModal);
  modalOverlay.addEventListener("click", function(e){
    if (e.target === modalOverlay) closeModal();
  });

  document.getElementById("btnModalReset").addEventListener("click", resetFormFields);
  document.getElementById("btnModalSimpan").addEventListener("click", simpanData);

  tbody.addEventListener("click", function(e){
    var btn = e.target.closest(".btn-icon");
    if (!btn) return;
    var id = btn.getAttribute("data-id");
    if (btn.classList.contains("edit")){
      openEditModal(id);
    } else if (btn.classList.contains("delete")){
      openHapusModal(id);
    }
  });

  document.getElementById("btnBatalHapus").addEventListener("click", closeHapusModal);
  modalHapus.addEventListener("click", function(e){
    if (e.target === modalHapus) closeHapusModal();
  });
  document.getElementById("btnKonfirmHapus").addEventListener("click", konfirmHapus);

  selectTahun.addEventListener("change", reloadTableData);
  selectInstansi.addEventListener("change", reloadTableData);

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape"){
      if (modalHapus.classList.contains("open")) closeHapusModal();
      else if (modalOverlay.classList.contains("open")) closeModal();
    }
  });

  // Init Table
  renderTable();
})();
</script>
