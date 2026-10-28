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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.swal2-container { z-index: 999999 !important; }
:root {
  --ui-primary: #00c292;
  --ui-primary-hover: #00a87e;
  --ui-primary-light: #e8f8f5;
  --ui-primary-border: #b2dfdb;
  --ui-primary-text: #007a5a;
  
  --ui-blue: #2563eb;
  --ui-blue-hover: #1d4ed8;
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
  
  --excel-green: #107c41;
  --excel-green-dark: #0b5c30;
  --excel-green-light: #e2efda;
  --excel-header-bg: #f2f2f2;
  --excel-border: #d4d4d4;
  --excel-col-header: #e1dfdd;
  
  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 14px;
  --shadow-card: 0 1px 3px rgba(15,23,42,0.06), 0 1px 2px rgba(15,23,42,0.04);
  --shadow-modal: 0 25px 60px -15px rgba(15,23,42,0.35);
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
  min-width: 1100px;
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
.col-no { width: 60px; min-width: 60px; text-align: center; font-weight: 700; }
.col-bobot-maks { width: 130px; min-width: 130px; text-align: center; font-family: 'Roboto Mono', monospace; font-weight: 700; }
.col-bobot-capaian { width: 140px; min-width: 140px; text-align: center; }
.col-opsi-aksi { width: 175px; min-width: 175px; text-align: center; }
.col-verifikator { width: 220px; min-width: 220px; text-align: center; }

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

/* Action Cell Button */
.btn-action-detail {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 6px 12px;
  font-size: 12px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  border: 1px solid #cbd5e1;
  background: #ffffff;
  color: #334155;
  cursor: pointer;
  transition: all 0.15s ease;
  width: 100%;
  max-width: 160px;
}
.btn-action-detail:hover {
  background: var(--ui-primary-light);
  border-color: var(--ui-primary-border);
  color: var(--ui-primary-text);
  box-shadow: 0 1px 3px rgba(0, 194, 146, 0.15);
}
.btn-action-detail.has-score {
  background: var(--ui-blue-light);
  border-color: var(--ui-blue-border);
  color: var(--ui-blue-text);
}
.btn-action-detail.has-score:hover {
  background: #dbeafe;
  border-color: #93c5fd;
}

/* Verifikator Column Styles */
.btn-action-verifikator {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 5px 10px;
  font-size: 11px;
  font-weight: 700;
  border-radius: var(--radius-sm);
  border: 1px solid #99f6e4;
  background: #f0fdfa;
  color: #0f766e;
  cursor: pointer;
  transition: all 0.15s ease;
  width: 100%;
  max-width: 205px;
  text-align: center;
  line-height: 1.35;
  box-sizing: border-box;
}
.btn-action-verifikator:hover {
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
  transform: translateY(-1px);
}
.btn-action-verifikator.kriteria-100 {
  background: #ecfdf5;
  border-color: #34d399;
  color: #065f46;
}
.btn-action-verifikator.kriteria-100:hover {
  background: #d1fae5;
  border-color: #10b981;
}
.btn-action-verifikator.kriteria-75 {
  background: #f0fdfa;
  border-color: #2dd4bf;
  color: #0f766e;
}
.btn-action-verifikator.kriteria-75:hover {
  background: #ccfbf1;
  border-color: #14b8a6;
}
.btn-action-verifikator.kriteria-50 {
  background: #fffbeb;
  border-color: #fcd34d;
  color: #92400e;
}
.btn-action-verifikator.kriteria-50:hover {
  background: #fef3c7;
  border-color: #f59e0b;
}
.btn-action-verifikator.kriteria-0 {
  background: #fef2f2;
  border-color: #fca5a5;
  color: #991b1b;
}
.btn-action-verifikator.kriteria-0:hover {
  background: #fee2e2;
  border-color: #ef4444;
}
.btn-action-verifikator.kriteria-na {
  background: #f8fafc;
  border-color: #cbd5e1;
  color: #475569;
}
.btn-action-verifikator.kriteria-empty {
  background: #f8fafc;
  border: 1px dashed #94a3b8;
  color: #64748b;
  font-weight: 600;
}
.btn-action-verifikator.kriteria-empty:hover {
  background: #f0fdfa;
  border-color: #0d9488;
  color: #0f766e;
}
.badge-verif-pill {
  display: inline-block;
  padding: 3px 8px;
  border-radius: 4px;
  background: #ccfbf1;
  color: #0f766e;
  font-size: 11.5px;
  font-weight: 700;
  font-family: 'Roboto Mono', monospace;
}
.badge-verif-subtotal {
  display: inline-block;
  padding: 3px 6px;
  border-radius: 4px;
  background: #e6f9f3;
  color: #059669;
  font-family: 'Roboto Mono', monospace;
}
.verif-keselarasan-strip {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  background: #f0fdf4;
  border: 1px solid #bbf7d0;
  border-radius: 10px;
  padding: 9px 16px;
  margin-bottom: 18px;
}
.verif-ks-info {
  display: flex;
  align-items: center;
  gap: 10px;
}
.verif-ks-icon {
  font-size: 14px;
  color: #059669;
  background: #dcfce7;
  width: 28px;
  height: 28px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.verif-ks-title {
  font-size: 12px;
  color: #15803d;
  font-weight: 600;
  margin-right: 6px;
}
.verif-ks-value {
  display: inline-block;
  font-size: 13.5px;
  font-weight: 800;
  color: #047857;
  font-family: 'Roboto Mono', monospace;
  background: #dcfce7;
  padding: 2px 8px;
  border-radius: 5px;
  border: 1px solid #86efac;
}
.btn-sync-keselarasan {
  background: #ffffff;
  border: 1.5px solid #10b981;
  border-radius: 7px;
  color: #047857;
  font-size: 11.5px;
  font-weight: 700;
  padding: 5px 12px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.15s ease;
  flex-shrink: 0;
}
.btn-sync-keselarasan:hover {
  background: #059669;
  color: #ffffff;
  border-color: #059669;
  box-shadow: 0 2px 5px rgba(5, 150, 105, 0.2);
}
.verif-col-hint {
  font-size: 11.5px;
  color: #64748b;
  margin-top: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
  min-height: 28px;
}

/* =========================================================
   VERIFIKATOR MODAL STYLES (Clean Modern Design per Image)
   ========================================================= */
.verif-modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.68);
  backdrop-filter: blur(5px);
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
  z-index: 100020;
}
.verif-modal-overlay.open {
  display: flex;
}
.verif-modal-card {
  background: #ffffff;
  width: 100%;
  max-width: 710px;
  border-radius: 16px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  animation: verifModalPop 0.22s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes verifModalPop {
  0% { opacity: 0; transform: scale(0.96) translateY(12px); }
  100% { opacity: 1; transform: scale(1) translateY(0); }
}
.verif-modal-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  padding: 24px 28px 16px;
  border-bottom: 1px solid #f1f5f9;
}
.verif-header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}
.verif-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: #e6f9f3;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #059669;
  font-size: 20px;
  flex-shrink: 0;
}
.verif-modal-title {
  margin: 0;
  font-size: 18px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.01em;
}
.verif-modal-subtitle {
  margin: 4px 0 0;
  font-size: 13px;
  color: #64748b;
  line-height: 1.4;
}
.btn-verif-close {
  border: none;
  background: transparent;
  font-size: 24px;
  color: #94a3b8;
  cursor: pointer;
  line-height: 1;
  padding: 0 4px;
  transition: color 0.15s;
}
.btn-verif-close:hover {
  color: #334155;
}
.verif-modal-body {
  padding: 22px 28px;
  overflow-y: auto;
  max-height: calc(88vh - 160px);
}
.verif-form-group {
  margin-bottom: 18px;
}
.verif-form-group:last-child {
  margin-bottom: 0;
}
.verif-label {
  display: block;
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  color: #1e293b;
  margin-bottom: 7px;
}
.verif-form-control {
  width: 100%;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 10px 14px;
  font-size: 13.5px;
  color: #1e293b;
  background: #ffffff;
  outline: none;
  transition: all 0.15s;
  box-sizing: border-box;
}
.verif-form-control:focus {
  border-color: #10b981;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
}
.verif-form-control[readonly] {
  background: #f8fafc;
  color: #334155;
}
.verif-form-control[disabled] {
  background: #f1f5f9;
  color: #64748b;
  cursor: not-allowed;
}
.verif-select-active {
  border: 1.5px solid #10b981 !important;
}
.verif-form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 18px;
}
.verif-col {
  display: flex;
  flex-direction: column;
}
.verif-preset-row {
  display: flex;
  gap: 6px;
  margin-top: 8px;
}
.verif-preset-btn {
  flex: 1;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  padding: 6px 0;
  font-size: 11.5px;
  font-weight: 700;
  color: #334155;
  cursor: pointer;
  text-align: center;
  transition: all 0.15s ease;
}
.verif-preset-btn:hover:not(:disabled) {
  background: #f1f5f9;
  border-color: #94a3b8;
  color: #0f172a;
  transform: translateY(-1px);
}
.verif-preset-btn.active {
  background: #059669 !important;
  border-color: #047857 !important;
  color: #ffffff !important;
  box-shadow: 0 2px 6px rgba(5, 150, 105, 0.4) !important;
  transform: translateY(-1px);
}
.verif-preset-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Dynamic Percentage Badge & Progress Bar */
.verif-calc-pill {
  font-size: 11.5px;
  font-weight: 800;
  font-family: 'Roboto Mono', monospace;
  padding: 2px 8px;
  border-radius: 6px;
  background: #e6f9f3;
  color: #059669;
  border: 1px solid #a7f3d0;
  transition: all 0.2s ease;
}
.verif-calc-pill.level-100 {
  background: #d1fae5;
  color: #065f46;
  border-color: #6ee7b7;
}
.verif-calc-pill.level-75 {
  background: #dbeafe;
  color: #1e40af;
  border-color: #93c5fd;
}
.verif-calc-pill.level-50 {
  background: #fef3c7;
  color: #92400e;
  border-color: #fde68a;
}
.verif-calc-pill.level-0 {
  background: #f1f5f9;
  color: #64748b;
  border-color: #cbd5e1;
}
.verif-calc-pill.level-over {
  background: #fee2e2;
  color: #b91c1c;
  border-color: #fca5a5;
  animation: pulseWarning 1.2s infinite;
}
@keyframes pulseWarning {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

.verif-input-wrapper {
  position: relative;
}
.verif-progress-bar-wrap {
  width: 100%;
  height: 4px;
  background: #e2e8f0;
  border-radius: 0 0 8px 8px;
  overflow: hidden;
  margin-top: -3px;
  position: relative;
  z-index: 2;
}
.verif-progress-bar {
  height: 100%;
  background: linear-gradient(90deg, #10b981 0%, #059669 100%);
  width: 0%;
  transition: width 0.25s ease, background 0.25s ease;
}

/* Quick Chips & Tags */
.quick-chips-wrap {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 8px;
}
.quick-chips-label {
  font-size: 11px;
  font-weight: 700;
  color: #64748b;
  margin-right: 2px;
}
.quick-chip {
  background: #f1f5f9;
  border: 1px solid #cbd5e1;
  border-radius: 999px;
  padding: 3px 10px;
  font-size: 11px;
  font-weight: 600;
  color: #334155;
  cursor: pointer;
  transition: all 0.15s ease;
  line-height: 1.3;
}
.quick-chip:hover {
  background: #e2e8f0;
  border-color: #94a3b8;
  color: #0f172a;
  transform: translateY(-1px);
}
.quick-chip:active {
  transform: translateY(0);
}
.quick-chip.chip-clear {
  background: #fee2e2;
  border-color: #fca5a5;
  color: #b91c1c;
}
.quick-chip.chip-clear:hover {
  background: #fecaca;
  border-color: #f87171;
  color: #991b1b;
}

.chip-mini {
  font-size: 10.5px;
  font-weight: 700;
  padding: 2px 8px;
  border-radius: 4px;
  background: #e2efda;
  color: #107c41;
  cursor: pointer;
  border: 1px solid #b7db9f;
  transition: all 0.15s;
}
.chip-mini:hover {
  background: #107c41;
  color: #ffffff;
  border-color: #0b5c30;
  transform: translateY(-1px);
}
.excel-meta-quick {
  display: flex;
  gap: 5px;
}

.btn-preview-link {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  font-weight: 700;
  color: #2563eb;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 2px 8px;
  border-radius: 4px;
  text-decoration: none !important;
  transition: all 0.15s ease;
}
.btn-preview-link:hover {
  background: #2563eb;
  color: #ffffff !important;
}

.shortcut-pill {
  display: inline-block;
  font-size: 10px;
  font-family: 'Roboto Mono', monospace;
  background: rgba(0, 0, 0, 0.2);
  padding: 1px 5px;
  border-radius: 3px;
  margin-left: 4px;
  font-weight: 600;
  vertical-align: middle;
}
.excel-pct-badge {
  font-size: 11.5px;
  font-weight: 800;
  font-family: 'Roboto Mono', monospace;
  background: #e2efda;
  color: #1b5e20;
  padding: 3px 8px;
  border-radius: 4px;
  border: 1px solid #b7db9f;
}

/* Excel Sheet Cell Focus Highlight */
.excel-grid-table input.calc-inp {
  transition: all 0.15s ease;
}
.excel-grid-table input.calc-inp:focus {
  background: #fafff8 !important;
  border-color: #107c41 !important;
  box-shadow: 0 0 0 2px rgba(16, 124, 65, 0.25) !important;
  outline: none !important;
}

.verif-notice-readonly {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  background: #fffbeb;
  border: 1px solid #fde68a;
  border-radius: 8px;
  color: #92400e;
  font-size: 12.5px;
  margin-bottom: 18px;
}
.verif-modal-footer {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 12px;
  padding: 16px 28px;
  border-top: 1px solid #f1f5f9;
  background: #fafafa;
}
.btn-verif-cancel {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  padding: 9px 20px;
  font-size: 13.5px;
  font-weight: 600;
  color: #334155;
  cursor: pointer;
  transition: all 0.15s;
}
.btn-verif-cancel:hover {
  background: #f8fafc;
  border-color: #94a3b8;
}
.btn-verif-save {
  background: #059669;
  border: none;
  border-radius: 8px;
  padding: 9px 22px;
  font-size: 13.5px;
  font-weight: 700;
  color: #ffffff;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.15s;
  box-shadow: 0 1px 3px rgba(5, 150, 105, 0.25);
}
.btn-verif-save:hover:not(:disabled) {
  background: #047857;
  box-shadow: 0 2px 6px rgba(5, 150, 105, 0.35);
}

/* =========================================================
   EXCEL WORKBOOK MODAL STYLES (Clean, Spacious, Horizontal Slide)
   ========================================================= */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.82);
  backdrop-filter: blur(6px);
  display: none;
  align-items: flex-start;
  justify-content: center;
  padding: 40px 20px 30px;
  overflow-y: auto;
  z-index: 100005;
}
.modal-overlay.open { display: flex; }

.excel-window-container {
  background: #ffffff;
  width: 98%;
  max-width: 1580px;
  border-radius: 10px;
  border: 1px solid var(--excel-green);
  box-shadow: 0 25px 70px rgba(0,0,0,0.45);
  position: relative;
  animation: excelModalPop 0.22s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  margin-bottom: 25px;
  transition: all 0.2s ease;
}
.excel-window-container.maximized {
  width: 99vw !important;
  max-width: 99vw !important;
  border-radius: 4px !important;
  margin: 0 !important;
  height: 96vh !important;
}
.excel-window-container.maximized .excel-sheet-canvas {
  max-height: calc(96vh - 240px) !important;
}
@keyframes excelModalPop {
  from { opacity: 0; transform: translateY(18px) scale(0.98); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

/* Excel Top Ribbon Header */
.excel-titlebar {
  background: linear-gradient(90deg, #107c41 0%, #0b5c30 100%);
  color: #ffffff;
  padding: 12px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  user-select: none;
}
.excel-title-left {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 14.5px;
  font-weight: 700;
  letter-spacing: 0.01em;
}
.excel-icon-brand {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  color: #107c41;
  width: 26px;
  height: 26px;
  border-radius: 5px;
  font-size: 15px;
  font-weight: 900;
}
.excel-window-controls {
  display: flex;
  align-items: center;
  gap: 6px;
}
.excel-win-btn {
  background: transparent;
  border: none;
  color: #ffffff;
  width: 30px;
  height: 30px;
  border-radius: 5px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.15s;
}
.excel-win-btn:hover { background: rgba(255,255,255,0.2); }
.excel-win-btn.btn-close-excel:hover { background: #e81123; color: #fff; }

/* Excel Formula / Context Bar */
.excel-formula-bar {
  background: #f8fafc;
  border-bottom: 1px solid #d4d4d4;
  padding: 10px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  font-size: 13px;
  flex-wrap: wrap;
}
.excel-name-box {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 4px;
  padding: 5px 12px;
  font-weight: 800;
  font-family: 'Roboto Mono', monospace;
  color: #0f172a;
  min-width: 100px;
  text-align: center;
  font-size: 12.5px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.04);
}
.excel-fx-icon {
  font-style: italic;
  font-weight: 900;
  color: #64748b;
  font-size: 16px;
  user-select: none;
}
.excel-fx-text {
  flex: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color: #1e293b;
  font-weight: 600;
  font-size: 13px;
  min-width: 250px;
}
.excel-score-pill {
  background: #e2efda;
  border: 1px solid #b7db9f;
  color: #1b5e20;
  padding: 5px 14px;
  border-radius: 6px;
  font-size: 12.5px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: 'Roboto Mono', monospace;
  white-space: nowrap;
}

/* Excel Worksheet Area - Generous Scroll Canvas */
.excel-sheet-canvas {
  max-height: 56vh;
  overflow-x: auto;
  overflow-y: auto;
  padding: 14px 18px;
  background: #fdfdfd;
  position: relative;
}

/* Custom Clean Scrollbars */
.excel-sheet-canvas::-webkit-scrollbar,
.modal-overlay::-webkit-scrollbar {
  width: 9px;
  height: 9px;
}
.excel-sheet-canvas::-webkit-scrollbar-track,
.modal-overlay::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 4px;
}
.excel-sheet-canvas::-webkit-scrollbar-thumb,
.modal-overlay::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
  border: 2px solid #f1f5f9;
}
.excel-sheet-canvas::-webkit-scrollbar-thumb:hover,
.modal-overlay::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* Authentic Excel Grid Table */
.excel-grid-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  margin-bottom: 12px;
  font-size: 13px;
  background: #ffffff;
  table-layout: auto;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}

.excel-col-letter {
  background: #e9ecef;
  border: 1px solid #d4d4d4;
  color: #495057;
  font-size: 11px;
  font-weight: 800;
  text-align: center;
  padding: 5px 8px;
  user-select: none;
  letter-spacing: 0.04em;
}

.excel-row-num {
  background: #e9ecef !important;
  border: 1px solid #d4d4d4;
  color: #495057;
  font-size: 11.5px;
  font-weight: 800;
  text-align: center;
  width: 42px;
  min-width: 42px;
  padding: 6px 8px;
  user-select: none;
  position: sticky;
  left: 0;
  z-index: 5;
}

.excel-grid-table th {
  background: var(--excel-header-bg);
  border: 1px solid #d4d4d4;
  padding: 9px 10px;
  font-weight: 700;
  color: #1e293b;
  text-align: center;
  font-size: 12.5px;
  line-height: 1.35;
}

.excel-grid-table th.th-green { background: #e2efda; color: #1e6b37; border-color: #badba4; }
.excel-grid-table th.th-blue  { background: #d9e1f2; color: #1a365d; border-color: #b4c6e7; }
.excel-grid-table th.th-amber { background: #fff2cc; color: #78350f; border-color: #ffe699; }
.excel-grid-table th.th-gray  { background: #f1f5f9; color: #475569; border-color: #cbd5e1; }

.excel-grid-table td {
  border: 1px solid #d4d4d4;
  padding: 6px 9px;
  vertical-align: middle;
  background: #ffffff;
  color: #1e293b;
  font-size: 12.5px;
  line-height: 1.4;
}

.excel-grid-table tbody tr:hover td:not(.excel-row-num) {
  background-color: #fafbfc;
}

/* Excel Input Styling */
.excel-grid-table input[type="text"], 
.excel-grid-table input[type="number"],
.excel-grid-table select,
.excel-grid-table textarea {
  width: 100%;
  border: 1px solid #d1d5db;
  background: #ffffff;
  border-radius: 4px;
  padding: 6px 9px;
  font-size: 12.5px;
  color: #0f172a;
  outline: none;
  font-family: inherit;
  transition: all 0.15s;
}

.excel-grid-table input[type="number"] {
  font-family: 'Roboto Mono', monospace;
  font-weight: 600;
  text-align: right;
}

.excel-grid-table input[type="text"]:focus, 
.excel-grid-table input[type="number"]:focus,
.excel-grid-table select:focus,
.excel-grid-table textarea:focus {
  background: #ffffff;
  border-color: var(--excel-green);
  box-shadow: 0 0 0 2px rgba(16, 124, 65, 0.2);
}

.excel-grid-table select {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  font-weight: 600;
  cursor: pointer;
  padding: 6px 8px;
}

/* Read-only Formula Cells */
.excel-grid-table td.cell-formula {
  font-family: 'Roboto Mono', monospace;
  text-align: center;
  font-size: 12px;
  background: #f8fafc;
}

.btn-excel-add-row {
  background: #f8fafc;
  border: 1px dashed #64748b;
  color: #1e293b;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 12.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: 6px;
  margin-bottom: 12px;
  transition: all 0.15s;
}
.btn-excel-add-row:hover {
  background: #e2efda;
  border-color: #107c41;
  color: #107c41;
  box-shadow: 0 2px 4px rgba(16,124,65,0.12);
}

/* Reference & Evidence Box */
.excel-meta-box {
  background: #f8fafc;
  border-top: 1px solid #d4d4d4;
  border-bottom: 1px solid #d4d4d4;
  padding: 14px 20px;
}
.excel-meta-title {
  font-size: 12px;
  font-weight: 800;
  color: #334155;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.meta-grid-3 {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 10px;
}
.meta-grid-2 {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.meta-field label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: #475569;
  text-transform: uppercase;
  margin-bottom: 4px;
}
.meta-field input, .meta-field textarea {
  width: 100%;
  border: 1px solid #cbd5e1;
  border-radius: 5px;
  padding: 7px 11px;
  font-size: 12.5px;
  font-family: inherit;
  color: #1e293b;
  outline: none;
  background: #ffffff;
  transition: border-color 0.15s, box-shadow 0.15s;
}
.meta-field textarea { min-height: 60px; resize: vertical; }
.meta-field input:focus, .meta-field textarea:focus {
  border-color: var(--excel-green);
  box-shadow: 0 0 0 2px rgba(16,124,65,0.2);
}

/* Bottom Sheet Tabs & Status Bar */
.excel-statusbar {
  background: #f1f3f4;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.excel-sheet-tabs {
  display: flex;
  align-items: center;
  gap: 6px;
}
.excel-tab-pill {
  background: #ffffff;
  border: 1px solid #d4d4d4;
  border-bottom: 2px solid var(--excel-green);
  padding: 6px 14px;
  border-radius: 5px 5px 0 0;
  font-size: 12.5px;
  font-weight: 700;
  color: #107c41;
  display: flex;
  align-items: center;
  gap: 6px;
}
.excel-preset-group {
  display: flex;
  align-items: center;
  gap: 5px;
}
.excel-preset-btn {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  padding: 5px 10px;
  font-size: 11.5px;
  font-weight: 700;
  border-radius: 4px;
  cursor: pointer;
  color: #334155;
  transition: all 0.15s;
}
.excel-preset-btn:hover {
  background: #e2efda;
  border-color: #107c41;
  color: #107c41;
}
.excel-preset-btn.active {
  background: #107c41 !important;
  border-color: #0b5c30 !important;
  color: #ffffff !important;
  box-shadow: 0 2px 5px rgba(16, 124, 65, 0.4) !important;
  transform: translateY(-1px);
}

.excel-actions-right {
  display: flex;
  align-items: center;
  gap: 12px;
}
.excel-score-input-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  padding: 4px 10px;
  border-radius: 5px;
}
.excel-score-input-wrap label {
  font-size: 11.5px;
  font-weight: 800;
  color: #334155;
  text-transform: uppercase;
}
.excel-score-input-wrap input {
  width: 85px;
  border: none;
  font-family: 'Roboto Mono', monospace;
  font-weight: 800;
  font-size: 14.5px;
  color: #107c41;
  text-align: center;
  outline: none;
}
.btn-excel-save {
  background: var(--excel-green);
  color: #ffffff;
  border: 1px solid var(--excel-green-dark);
  padding: 8px 18px;
  font-size: 13px;
  font-weight: 700;
  border-radius: 5px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.15);
  transition: all 0.15s;
}
.btn-excel-save:hover { background: var(--excel-green-dark); }
.btn-excel-cancel {
  background: #ffffff;
  color: #475569;
  border: 1px solid #cbd5e1;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 700;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.15s;
}
.btn-excel-cancel:hover { background: #f8fafc; }

/* Toast */
.toast-container {
  position: fixed;
  bottom: 24px;
  right: 24px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  z-index: 100010;
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

  <!-- FILTER WILAYAH SEBELUM LOGIN -->
  <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    <div style="background: #ffffff; border: 1px solid var(--ui-border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 18px 22px; margin-bottom: 20px;">
      <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
        <div style="flex: 1 1 250px; min-width: 200px;">
          <label style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.03em; color: var(--ui-text-muted); display: block; margin-bottom: 6px;">Provinsi</label>
          <select class="t-select" id="Provinsi" style="width: 100%; height: 38px;">
            <option value="">Pilih Provinsi</option>
            <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
              <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($HasFiltered) && !empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                <?= html_escape($prov['Nama']) ?>
              </option>
            <?php } } ?>
          </select>
        </div>

        <div style="flex: 1 1 250px; min-width: 200px;">
          <label style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.03em; color: var(--ui-text-muted); display: block; margin-bottom: 6px;">Kab/Kota</label>
          <select class="t-select" id="KabKota" style="width: 100%; height: 38px;">
            <option value="">Pilih Kab/Kota</option>
          </select>
        </div>

        <div style="flex: 0 0 auto;">
          <button type="button" class="btn-ui btn-ui-primary" id="Filter" style="height: 38px; padding: 0 25px; font-weight: 800; border-radius: var(--radius-sm);">
            <i class="fa fa-filter"></i> Filter
          </button>
        </div>
      </div>

      <?php if (!empty($KodeWilayah) && !empty($HasFiltered)) { ?>
        <div style="margin-top: 14px; padding: 10px 14px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 13px; color: #1e40af;">
          <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah ?? '') ?>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <?php if (empty($KodeWilayah)) { ?>
    <div class="alert alert-info text-center" style="padding: 30px 20px; margin: 20px 0; border-radius: 8px; background-color: #f0f9ff; border: 1px solid #bae6fd;">
      <i class="fa fa-info-circle fa-2x" style="color: #0284c7; margin-bottom: 10px; display: block;"></i>
      <h4 style="font-weight: 700; color: #0369a1; margin-bottom: 6px;">Wilayah Belum Dipilih</h4>
      <p style="color: #475569; margin: 0; font-size: 13.5px;">Silakan pilih <b>Provinsi</b> dan <b>Kab/Kota</b> di atas, kemudian klik tombol <b>Filter</b> untuk menampilkan data.</p>
    </div>
  <?php } else { ?>

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

      <input type="hidden" id="selectInstansi" value="<?= $filterInstansi ?>">

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
          <col style="width: 60px;" />
          <col />
          <col style="width: 130px;" />
          <col style="width: 140px;" />
          <col style="width: 175px;" />
          <col style="width: 220px;" />
        </colgroup>
        <thead>
          <tr>
            <th class="col-no">NO</th>
            <th>URAIAN INDIKATOR / SUB-INDIKATOR</th>
            <th class="col-bobot-maks text-center">Bobot Maksimal</th>
            <th class="col-bobot-capaian text-center">Bobot Capaian</th>
            <th class="col-opsi-aksi text-center">Aksi & Detail Penilaian</th>
            <th class="col-verifikator text-center">Verifikator</th>
          </tr>
        </thead>
        <tbody id="tbodyIppd">
          <!-- Rendered via JavaScript -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php } ?>

<!-- =========================================================
     EXCEL SPREADSHEET MODAL (Authentic Excel Window Design)
     ========================================================= -->
<div class="modal-overlay" id="modalDetailOverlay">
  <div class="excel-window-container">
    
    <!-- 1. Excel Title Bar -->
    <div class="excel-titlebar">
      <div class="excel-title-left">
        <div class="excel-icon-brand"><i class="fa fa-file-excel-o"></i></div>
        <span> IPPN Daerah - Lembar Kerja Evaluasi [<span id="excelPointBadge">POIN 1.a.1.a</span>]</span>
      </div>
      <div class="excel-window-controls">
        <button type="button" class="excel-win-btn" id="btnModalMaximize" title="Perbesar / Perkecil Tampilan Layar Penuh"><i class="fa fa-arrows-alt" id="iconModalMaximize"></i></button>
        <button type="button" class="excel-win-btn btn-close-excel" id="btnModalClose" title="Tutup">&times;</button>
      </div>
    </div>

    <!-- 2. Excel Formula Bar -->
    <div class="excel-formula-bar">
      <div class="excel-name-box" id="excelNameBox">POIN 1.a.1.a</div>
      <div class="excel-fx-icon" style="display:none;">fx</div>
      <div class="excel-fx-text" id="excelFxContent" style="display:none;">Uraian Indikator Evaluasi...</div>
      <div class="excel-score-pill">
        <span>Bobot Maks: <strong id="modalMaxBadge">0.500</strong></span>
        <span>|</span>
        <span>Capaian: <strong id="modalCalcDisplay">0.000</strong></span>
      </div>
    </div>

    <form id="formDetailIppd" autocomplete="off">
      <input type="hidden" id="modalItemCode" value="">
      <input type="hidden" id="modalBobotMaks" value="0">

      <!-- 3. Dynamic Worksheet Canvas -->
      <div class="excel-sheet-canvas" id="modalDynamicWorksheet">
        <!-- Injected dynamically with Excel row numbers & column letters -->
      </div>

      <!-- 4. Excel Reference & Evidence Metadata Box -->
      <div class="excel-meta-box">
        <div class="excel-meta-title"><i class="fa fa-bookmark"></i> Referensi Dokumen & Pembuktian (Audit Trail)</div>
        <div class="meta-grid-3">
          <div class="meta-field">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
              <label for="modalRefDokumen" style="margin-bottom:0;">Dokumen Sumber</label>
              <div class="excel-meta-quick">
                <span class="chip-mini chip-doc" data-text="RPJMD 2025-2029">RPJMD</span>
                <span class="chip-mini chip-doc" data-text="RKPD 2026">RKPD</span>
                <span class="chip-mini chip-doc" data-text="Renstra PD">Renstra</span>
              </div>
            </div>
            <input type="text" id="modalRefDokumen" placeholder="Contoh: RPJMD 2025-2029 / RKPD 2026">
          </div>
          <div class="meta-field">
            <label for="modalRefHalaman">Halaman</label>
            <input type="text" id="modalRefHalaman" placeholder="Contoh: Bab IV Hal. 142-148">
          </div>
          <div class="meta-field">
            <label for="modalRefTabel">Tabel / Matriks</label>
            <input type="text" id="modalRefTabel" placeholder="Contoh: Tabel 4.12 Matrik Penyelarasan">
          </div>
        </div>
        <div class="meta-grid-2">
          <div class="meta-field">
            <label for="modalCatatan">Catatan / Analisis Evaluasi</label>
            <textarea id="modalCatatan" rows="2" placeholder="Catatan evaluasi, justifikasi, atau keterangan pendukung..."></textarea>
            <div class="quick-chips-wrap" style="margin-top:4px;">
              <button type="button" class="quick-chip excel-catatan-chip" data-text="Target telah selaras dan konsisten.">Target Selaras</button>
              <button type="button" class="quick-chip excel-catatan-chip" data-text="Sesuai dokumen perencanaan daerah.">Sesuai Dokumen</button>
              <button type="button" class="quick-chip excel-catatan-chip" data-text="Bukti dukung telah diverifikasi.">Diverifikasi</button>
              <button type="button" class="quick-chip excel-catatan-chip" data-text="Perlu penyesuaian indikator dan target.">Perlu Revisi</button>
            </div>
          </div>
          <div class="meta-field">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
              <label for="modalBuktiDukung" style="margin-bottom:0;">Bukti Dukung / Tautan Digital</label>
              <a href="#" target="_blank" id="btnPreviewExcelLink" class="btn-preview-link" style="display:none;" title="Buka tautan di tab baru">
                <i class="fa fa-external-link"></i> Buka Tautan ↗
              </a>
            </div>
            <div style="display:flex; gap: 8px; flex-direction: column;">
              <div style="display:flex; gap: 8px;">
                <input type="text" id="modalBuktiDukung" class="form-control" style="flex:1; padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 4px;" placeholder="Link tautan dokumen, Google Drive, atau hasil upload...">
                <input type="file" id="uploadBuktiFile" style="display:none;" accept=".jpg,.jpeg,.png,.pdf" multiple>
                <button type="button" class="btn-ui btn-ui-primary" id="btnUploadBuktiFile" style="white-space: nowrap; padding: 6px 12px; font-size: 12px;" onclick="document.getElementById('uploadBuktiFile').click()">
                  <i class="fa fa-upload"></i> Upload
                </button>
              </div>
              <div id="uploadBuktiLoading" style="display:none; font-size: 11px; color: #b45309;"><i class="fa fa-spinner fa-spin"></i> Sedang mengunggah...</div>
              <div id="previewBuktiContainer" style="display:none; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px; background: #f8fafc; text-align: center;"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. Excel Statusbar & Actions -->
      <div class="excel-statusbar">
        <div class="excel-sheet-tabs">
          <div class="excel-tab-pill"><i class="fa fa-table"></i> <span id="excelTabTitle">Sheet: 1.a.1.a</span></div>
          <div class="excel-preset-group" style="margin-left: 10px;">
            <span style="font-size: 11px; font-weight: 700; color: #64748b; margin-right: 2px;">Preset:</span>
            <button type="button" class="excel-preset-btn" data-ratio="1.0">100%</button>
            <button type="button" class="excel-preset-btn" data-ratio="0.75">75%</button>
            <button type="button" class="excel-preset-btn" data-ratio="0.5">50%</button>
            <button type="button" class="excel-preset-btn" data-ratio="0.25">25%</button>
            <button type="button" class="excel-preset-btn" data-ratio="0">0%</button>
          </div>
        </div>

        <div class="excel-actions-right">
          <div class="excel-score-input-wrap">
            <label for="modalBobotInput">Capaian:</label>
            <input type="number" step="0.001" min="0" id="modalBobotInput" placeholder="0.000">
            <span class="excel-pct-badge" id="excelScorePctBadge">100%</span>
          </div>
          <button type="button" class="btn-excel-cancel" id="btnModalCancel">Batal</button>
          <button type="button" class="btn-excel-save" id="btnModalSave">
            <i class="fa fa-save"></i> Simpan Penilaian <span class="shortcut-pill">Ctrl+S</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- =========================================================
     VERIFIKATOR MODAL (Penilaian Sub-Indikator / Indikator)
     ========================================================= -->
<div class="verif-modal-overlay" id="modalVerifikatorOverlay">
  <div class="verif-modal-card">
    
    <!-- Modal Header -->
    <div class="verif-modal-header">
      <div class="verif-header-left">
        <div class="verif-icon-box">
          <i class="fa fa-pencil-square-o"></i>
        </div>
        <div>
          <h4 class="verif-modal-title" id="verifModalTitle">Penilaian Sub-Indikator (a)</h4>
          <p class="verif-modal-subtitle">Lengkapi capaian bobot, pilihan status pemenuhan, dan catatan evaluasi.</p>
        </div>
      </div>
      <button type="button" class="btn-verif-close" id="btnVerifClose" title="Tutup">&times;</button>
    </div>

    <!-- Modal Form -->
    <form id="formVerifikatorIppd" autocomplete="off">
      <input type="hidden" id="verifItemCode" value="">
      <input type="hidden" id="verifBobotMaks" value="0">

      <div class="verif-modal-body">
        <!-- 1. Uraian Indikator / Sub-Indikator -->
        <div class="verif-form-group">
          <label class="verif-label">URAIAN INDIKATOR / SUB-INDIKATOR</label>
          <input type="text" id="verifUraian" class="verif-form-control" readonly>
        </div>

        <!-- Info Strip Keselarasan Lembar Kerja -->
        <div class="verif-keselarasan-strip">
          <div class="verif-ks-info">
            <i class="fa fa-calculator verif-ks-icon"></i>
            <div>
              <span class="verif-ks-title">Total Keselarasan Terbobot:</span>
              <strong class="verif-ks-value" id="verifKeselarasanBadge">0,000</strong>
            </div>
          </div>
          <button type="button" class="btn-sync-keselarasan" id="btnSyncKeselarasan" title="Klik untuk menerapkan nilai keselarasan lembar kerja ke Bobot Capaian">
            <i class="fa fa-refresh"></i> Terapkan Nilai Keselarasan
          </button>
        </div>

        <!-- 2. Row: Bobot Capaian & Opsi Aksi -->
        <div class="verif-form-row">
          <div class="verif-col">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:7px;">
              <label class="verif-label" style="margin-bottom:0;">BOBOT CAPAIAN (MAKS: <span id="verifMaxBadge">0,625</span>)</label>
              <span class="verif-calc-pill level-0" id="verifPillPercent">0%</span>
            </div>
            <div class="verif-input-wrapper">
              <input type="number" step="0.001" min="0" id="verifBobotInput" class="verif-form-control" placeholder="0.000" <?= empty($IsRole4) ? 'readonly' : '' ?>>
              <div class="verif-progress-bar-wrap">
                <div class="verif-progress-bar" id="verifProgressBar" style="width: 0%;"></div>
              </div>
            </div>
            <div class="verif-validation-hint" id="verifValidationHint" style="display:none; color:#ef4444; font-size:11.5px; font-weight:600; margin-top:4px;">
              <i class="fa fa-exclamation-triangle"></i> Nilai melebihi bobot maksimal!
            </div>
            <div class="verif-preset-row">
              <button type="button" class="verif-preset-btn" data-ratio="1.0" title="100% Bobot Maksimal" <?= empty($IsRole4) ? 'disabled' : '' ?>>100%</button>
              <button type="button" class="verif-preset-btn" data-ratio="0.75" title="75% Sebagian Besar" <?= empty($IsRole4) ? 'disabled' : '' ?>>75%</button>
              <button type="button" class="verif-preset-btn" data-ratio="0.5" title="50% Sebagian" <?= empty($IsRole4) ? 'disabled' : '' ?>>50%</button>
              <button type="button" class="verif-preset-btn" data-ratio="0.25" title="25% Belum Memadai" <?= empty($IsRole4) ? 'disabled' : '' ?>>25%</button>
              <button type="button" class="verif-preset-btn" data-ratio="0" title="0% Belum Memenuhi" <?= empty($IsRole4) ? 'disabled' : '' ?>>0%</button>
            </div>
          </div>
          <div class="verif-col">
            <label class="verif-label">OPSI AKSI / KRITERIA</label>
            <select id="verifOpsiAksi" class="verif-form-control verif-select-active" <?= empty($IsRole4) ? 'disabled' : '' ?>>
              <option value="">-- Pilih Opsi Aksi --</option>
              <option value="Memenuhi Sepenuhnya (100%)">Memenuhi Sepenuhnya (100%)</option>
              <option value="Sebagian Besar Memenuhi (75%)">Sebagian Besar Memenuhi (75%)</option>
              <option value="Sebagian Memenuhi (50%)">Sebagian Memenuhi (50%)</option>
              <option value="Belum Memenuhi (0%)">Belum Memenuhi (0%)</option>
              <option value="Tidak Terkait / NA">Tidak Terkait / NA</option>
            </select>
            <div class="verif-col-hint">
              <i class="fa fa-info-circle"></i> Memilih opsi aksi otomatis menyesuaikan nilai bobot capaian & preset.
            </div>
          </div>
        </div>

        <!-- 3. Catatan / Evaluasi / Keterangan -->
        <div class="verif-form-group">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:7px;">
            <label class="verif-label" style="margin-bottom:0;">CATATAN / EVALUASI / KETERANGAN</label>
            <span style="font-size:11px; color:#64748b; font-weight:600;"><i class="fa fa-magic"></i> Template Cepat:</span>
          </div>
          <textarea id="verifCatatan" class="verif-form-control" rows="3" placeholder="Tambahkan uraian penjelasan hasil evaluasi atau catatan..." <?= empty($IsRole4) ? 'readonly' : '' ?>></textarea>
          <div class="quick-chips-wrap">
            <span class="quick-chips-label"><i class="fa fa-tags"></i> Pilih Cepat:</span>
            <button type="button" class="quick-chip verif-catatan-chip" data-text="Telah sesuai dokumen RPJMD dan RKPD.">Sesuai RPJMD/RKPD</button>
            <button type="button" class="quick-chip verif-catatan-chip" data-text="Target telah selaras dan konsisten.">Target Selaras</button>
            <button type="button" class="quick-chip verif-catatan-chip" data-text="Bukti dukung telah diverifikasi lengkap.">Bukti Lengkap</button>
            <button type="button" class="quick-chip verif-catatan-chip" data-text="Perlu penyesuaian target pada dokumen berikutnya.">Perlu Penyesuaian</button>
            <button type="button" class="quick-chip verif-catatan-chip" data-text="Belum melampirkan matriks/tabel pendukung yang memadai.">Bukti Kurang</button>
            <button type="button" class="quick-chip chip-clear" id="btnClearVerifCatatan" title="Bersihkan Catatan"><i class="fa fa-times"></i> Bersihkan</button>
          </div>
        </div>

        <!-- 4. Bukti Dukung / Sumber Data (Dokumen/Link) -->
        <div class="verif-form-group">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:7px;">
            <label class="verif-label" style="margin-bottom:0;">BUKTI DUKUNG / SUMBER DATA (DOKUMEN/LINK)</label>
            <a href="#" target="_blank" id="btnPreviewVerifLink" class="btn-preview-link" style="display:none;" title="Buka tautan di tab baru">
              <i class="fa fa-external-link"></i> Buka Tautan ↗
            </a>
          </div>
          <div style="display:flex; gap: 8px; flex-direction: column;">
            <div style="display:flex; gap: 8px;">
              <input type="text" id="verifBuktiDukung" class="verif-form-control" style="flex:1;" placeholder="Contoh: Bab IV RPJMD 2025-2029 / Link Dokumen Google Drive" <?= empty($IsRole4) ? 'readonly' : '' ?>>
              <?php if (!empty($IsRole4)): ?>
              <input type="file" id="verifUploadBuktiFile" style="display:none;" accept=".jpg,.jpeg,.png,.pdf" multiple>
              <button type="button" class="btn-ui btn-ui-primary" id="btnVerifUploadBuktiFile" style="white-space: nowrap; padding: 6px 12px; font-size: 12px; border-radius: 4px;" onclick="document.getElementById('verifUploadBuktiFile').click()">
                <i class="fa fa-upload"></i> Upload
              </button>
              <?php endif; ?>
            </div>
            <div id="verifUploadBuktiLoading" style="display:none; font-size: 11px; color: #b45309;"><i class="fa fa-spinner fa-spin"></i> Sedang mengunggah...</div>
            <div id="verifPreviewBuktiContainer" style="display:none; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px; background: #f8fafc; text-align: center;"></div>
          </div>
          <div class="quick-chips-wrap">
            <span class="quick-chips-label"><i class="fa fa-file-text-o"></i> Referensi:</span>
            <button type="button" class="quick-chip verif-bukti-chip" data-text="Bab IV Dokumen RPJMD 2025-2029">Bab IV RPJMD</button>
            <button type="button" class="quick-chip verif-bukti-chip" data-text="Matriks Program & Kegiatan RKPD 2026">Matriks RKPD</button>
            <button type="button" class="quick-chip verif-bukti-chip" data-text="Perda RPJMD No. 2 Tahun 2025">Perda RPJMD</button>
            <button type="button" class="quick-chip verif-bukti-chip" data-text="Dokumen Renstra Perangkat Daerah">Renstra PD</button>
            <button type="button" class="quick-chip verif-bukti-chip" data-text="Laporan Evaluasi IKU Triwulan">Laporan IKU</button>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="verif-modal-footer">
        <?php if (!empty($IsRole4)): ?>
          <button type="button" class="btn-verif-cancel" id="btnVerifCancel">Batal</button>
          <button type="button" class="btn-verif-save" id="btnVerifSave">
            <i class="fa fa-save"></i> Simpan Penilaian <span class="shortcut-pill">Ctrl+S</span>
          </button>
        <?php else: ?>
          <button type="button" class="btn-verif-cancel" id="btnVerifCloseBottom">Tutup</button>
        <?php endif; ?>
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
  var MASTER_DATA = <?= json_encode($MasterData) ?>;
  var SCORES_MAP = <?= json_encode($SavedScores) ?> || {};
  var AUTO_DATA_1_A_1_A = <?= isset($AutoData_1_a_1_a) ? json_encode($AutoData_1_a_1_a) : '{}' ?>;
  var AUTO_DATA_1_A_1_C = <?= isset($AutoData_1_a_1_c) ? json_encode($AutoData_1_a_1_c) : '[]' ?>;
  var AUTO_DATA_1_A_2_A = <?= isset($AutoData_1_a_2_a) ? json_encode($AutoData_1_a_2_a) : '[]' ?>;
  var AUTO_DATA_1_A_2_ALL = <?= isset($AutoData_1_a_2_ALL) ? json_encode($AutoData_1_a_2_ALL) : '{}' ?>;
  var AUTO_DATA_1_A_3_A = <?= isset($AutoData_1_a_3_a) ? json_encode($AutoData_1_a_3_a) : '{}' ?>;
  var AUTO_DATA_1_A_3_B = <?= isset($AutoData_1_a_3_b) ? json_encode($AutoData_1_a_3_b) : '{}' ?>;
  var AUTO_DATA_1_A_4 = <?= isset($AutoData_1_a_4) ? json_encode($AutoData_1_a_4) : '[]' ?>;
  var AUTO_DATA_1_A_5 = <?= isset($AutoData_1_a_5) ? json_encode($AutoData_1_a_5) : '[]' ?>;
  var AUTO_DATA_1_A_6 = <?= isset($AutoData_1_a_6) ? json_encode($AutoData_1_a_6) : '[]' ?>;
  var AUTO_DATA_1_B_10_A = <?= isset($AutoData_1_b_10_a) ? json_encode($AutoData_1_b_10_a) : '{}' ?>;
  var AUTO_DATA_1_B_10_B = <?= isset($AutoData_1_b_10_b) ? json_encode($AutoData_1_b_10_b) : '{}' ?>;
  var AUTO_DATA_1_C_1 = <?= isset($AutoData_1_c_1) ? json_encode($AutoData_1_c_1) : '[]' ?>;
  var IS_ROLE_4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;
  var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CURRENT_FILTER_INSTANSI = "<?= !empty($FilterInstansi) ? $FilterInstansi : '' ?>";

  <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    $(document).ready(function() {
      $("#Provinsi").change(function() {
        var provinsiKode = $(this).val();
        if (provinsiKode === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', true);
          $("#FilterInstansiGroup").hide();
          $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
          return;
        }

        $.ajax({
          url: BASE_URL + "Instansi/GetListKabKota",
          type: "POST",
          data: { Kode: provinsiKode, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          beforeSend: function() { 
            $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
            $("#FilterInstansiGroup").hide();
          },
          success: function(Data) {
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
              }
            } else {
              KabKota = '<option value="">Tidak ada data untuk provinsi ini</option>';
            }
            $("#KabKota").html(KabKota).prop('disabled', false);
            $("#FilterInstansiGroup").hide();
          },
          error: function() {
            $("#KabKota").html('<option value="">Error memuat data</option>').prop('disabled', false);
          }
        });
      });

      $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") {
          alert("Mohon Pilih Provinsi");
          return;
        }
        if ($("#KabKota").val() === "") {
          alert("Mohon Pilih Kab/Kota");
          return;
        }

        var kodeWilayah = $("#KabKota").val();
        var tahunVal = (selectTahun && selectTahun.value) ? selectTahun.value : '<?= $TahunAktif ?>';
        window.location.href = BASE_URL + "Instansi/TabelIPPD?tahun=" + tahunVal + "&kodewilayah=" + kodeWilayah;
      });

      <?php if (!empty($HasFiltered) && !empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv);
        
        $.ajax({
          url: BASE_URL + "Instansi/GetListKabKota",
          type: "POST",
          data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          success: function(Data) {
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
              }
            }
            $("#KabKota").html(KabKota).prop('disabled', false);
          }
        });
      <?php } ?>
    });
  <?php } ?>

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
  var excelPointBadge = document.getElementById("excelPointBadge");
  var excelNameBox = document.getElementById("excelNameBox");
  var excelFxContent = document.getElementById("excelFxContent");
  var excelTabTitle = document.getElementById("excelTabTitle");
  var modalMaxBadge = document.getElementById("modalMaxBadge");
  var modalCalcDisplay = document.getElementById("modalCalcDisplay");
  var modalItemCode = document.getElementById("modalItemCode");
  var modalBobotMaks = document.getElementById("modalBobotMaks");
  var modalBobotInput = document.getElementById("modalBobotInput");
  var modalDynamicWorksheet = document.getElementById("modalDynamicWorksheet");
  var modalRefDokumen = document.getElementById("modalRefDokumen");
  var modalRefHalaman = document.getElementById("modalRefHalaman");
  var modalRefTabel = document.getElementById("modalRefTabel");
  var modalCatatan = document.getElementById("modalCatatan");
  var modalBuktiDukung = document.getElementById("modalBuktiDukung");

  var modalVerif = document.getElementById("modalVerifikatorOverlay");
  var verifModalTitle = document.getElementById("verifModalTitle");
  var verifItemCode = document.getElementById("verifItemCode");
  var verifBobotMaks = document.getElementById("verifBobotMaks");
  var verifMaxBadge = document.getElementById("verifMaxBadge");
  var verifUraian = document.getElementById("verifUraian");
  var verifBobotInput = document.getElementById("verifBobotInput");
  var verifOpsiAksi = document.getElementById("verifOpsiAksi");
  var verifCatatan = document.getElementById("verifCatatan");
  var verifBuktiDukung = document.getElementById("verifBuktiDukung");
  var btnVerifSave = document.getElementById("btnVerifSave");
  var btnVerifCancel = document.getElementById("btnVerifCancel");
  var btnVerifClose = document.getElementById("btnVerifClose");
  var btnVerifCloseBottom = document.getElementById("btnVerifCloseBottom");
  var btnSyncKeselarasan = document.getElementById("btnSyncKeselarasan");
  var verifKeselarasanBadge = document.getElementById("verifKeselarasanBadge");

  var collapsedKeys = new Set();
  var itemMap = {};

  function numFmt(n){
    if (n === null || n === undefined || isNaN(n)) return "0";
    var num = Number(n);
    var s = num.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
    return s.replace(".", ",");
  }

  function parseNum(val){
    if (val === null || val === undefined) return 0;
    if (typeof val === 'number') return isNaN(val) ? 0 : val;
    var s = String(val).trim();
    if (!s) return 0;
    if (s.indexOf('-') !== -1 && !s.startsWith('-')) {
      var parts = s.split('-');
      if (parts.length === 2) {
        var p1 = parseNum(parts[0]);
        var p2 = parseNum(parts[1]);
        return (p1 + p2) / 2;
      }
    }
    s = s.replace(',', '.');
    var num = parseFloat(s);
    return isNaN(num) ? 0 : num;
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
    var calculatedVerif = {};
    var grandTotal = 0;
    var sinergiScore = 0;
    var kualitasScore = 0;
    var kinerjaScore = 0;

    MASTER_DATA.forEach(function(indeks){
      var indeksSum = 0;
      var indeksVerifSum = 0;
      if (indeks.aspek){
        indeks.aspek.forEach(function(aspek){
          var aspekSum = 0;
          var aspekVerifSum = 0;
          if (aspek.indikator){
            aspek.indikator.forEach(function(ind){
              var indScore = 0;
              var indVerifScore = 0;
              if (ind.sub && ind.sub.length > 0){
                ind.sub.forEach(function(sub){
                  var subVal = SCORES_MAP[sub.code] && SCORES_MAP[sub.code].bobot_capaian !== null ? Number(SCORES_MAP[sub.code].bobot_capaian) : 0;
                  indScore += subVal;
                  var subVerif = SCORES_MAP[sub.code] && SCORES_MAP[sub.code].bobot_verifikator !== null ? Number(SCORES_MAP[sub.code].bobot_verifikator) : 0;
                  indVerifScore += subVerif;
                });
                calculated[ind.code] = indScore;
                calculatedVerif[ind.code] = indVerifScore;
              } else {
                indScore = SCORES_MAP[ind.code] && SCORES_MAP[ind.code].bobot_capaian !== null ? Number(SCORES_MAP[ind.code].bobot_capaian) : 0;
                calculated[ind.code] = indScore;
                var indVerif = SCORES_MAP[ind.code] && SCORES_MAP[ind.code].bobot_verifikator !== null ? Number(SCORES_MAP[ind.code].bobot_verifikator) : 0;
                calculatedVerif[ind.code] = indVerif;
              }
              aspekSum += indScore;
              aspekVerifSum += indVerifScore;
            });
          }
          calculated[aspek.code] = aspekSum;
          calculatedVerif[aspek.code] = aspekVerifSum;
          indeksSum += aspekSum;
          indeksVerifSum += aspekVerifSum;
        });
      }
      calculated[indeks.code] = indeksSum;
      calculatedVerif[indeks.code] = indeksVerifSum;
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

    return { normal: calculated, verif: calculatedVerif };
  }

  function renderVerifikatorButtonHtml(code, savedScore){
    savedScore = savedScore || {};
    var hasVerif = (savedScore.bobot_verifikator !== null && savedScore.bobot_verifikator !== undefined && savedScore.bobot_verifikator !== "");
    var kriteria = (savedScore.opsi_aksi_verifikator || "").trim();

    var kriteriaClass = "kriteria-empty";
    var iconClass = IS_ROLE_4 ? "fa-pencil-square-o" : "fa-eye";
    var labelText = IS_ROLE_4 ? "Verifikasi" : "Belum Diverifikasi";

    if (kriteria !== ""){
      labelText = kriteria;
      iconClass = "fa-check-circle";
      if (kriteria.indexOf("100%") !== -1 || kriteria.indexOf("Memenuhi Sepenuhnya") !== -1) {
        kriteriaClass = "kriteria-100";
      } else if (kriteria.indexOf("75%") !== -1 || kriteria.indexOf("Sebagian Besar") !== -1) {
        kriteriaClass = "kriteria-75";
      } else if (kriteria.indexOf("50%") !== -1 || kriteria.indexOf("Sebagian Memenuhi") !== -1) {
        kriteriaClass = "kriteria-50";
      } else if (kriteria.indexOf("0%") !== -1 || kriteria.indexOf("Belum Memenuhi") !== -1) {
        kriteriaClass = "kriteria-0";
      } else {
        kriteriaClass = "kriteria-na";
      }
    } else if (hasVerif){
      labelText = "Bobot: " + numFmt(savedScore.bobot_verifikator);
      iconClass = "fa-check-circle";
      kriteriaClass = "kriteria-75";
    }

    var titleAttr = (kriteria ? "Kriteria: " + kriteria + (hasVerif ? " (" + numFmt(savedScore.bobot_verifikator) + ")" : "") : (hasVerif ? "Bobot: " + numFmt(savedScore.bobot_verifikator) : "Belum dinilai")) + 
                    (IS_ROLE_4 ? " | Klik untuk ubah penilaian verifikator" : " | Klik untuk lihat detail verifikasi");

    return '<button type="button" class="btn-action-verifikator ' + (hasVerif || kriteria ? 'has-verif ' : '') + kriteriaClass + '" data-code="' + code + '" title="' + escapeHtml(titleAttr) + '">' +
             '<i class="fa ' + iconClass + '"></i> ' +
             '<span>' + escapeHtml(labelText) + '</span>' +
           '</button>';
  }

  function renderTable(){
    tbody.innerHTML = "";
    var searchKeyword = inputSearch.value.trim().toLowerCase();
    var rollup = calculateRollupScores();
    var calculatedScores = rollup.normal;
    var calculatedVerif = rollup.verif;

    MASTER_DATA.forEach(function(indeks){
      var isIndeksOpen = !collapsedKeys.has(indeks.code);
      var hasChildAspek = indeks.aspek && indeks.aspek.length > 0;

      var trIndeks = document.createElement("tr");
      trIndeks.className = "type-indeks";
      trIndeks.innerHTML = 
        '<td class="col-no">' + indeks.code + '</td>' +
        '<td>' +
          '<div class="uraian-wrapper" style="padding-left: 4px;">' +
            (hasChildAspek ? '<button type="button" class="tree-toggle-btn ' + (isIndeksOpen ? '' : 'closed') + '" data-code="' + indeks.code + '"><i class="fa fa-chevron-down"></i></button>' : '') +
            '<div class="tree-text-content">' +
              '<div class="tree-eyebrow" style="color:#b45309;">PILAR ' + indeks.code + '</div>' +
              '<div class="tree-title">' + escapeHtml(indeks.title) + '</div>' +
            '</div>' +
          '</div>' +
        '</td>' +
        '<td class="col-bobot-maks">' + numFmt(indeks.bobot) + '</td>' +
        '<td class="col-bobot-capaian"><span class="badge-sum-score">' + numFmt(calculatedScores[indeks.code] || 0) + '</span></td>' +
        '<td class="col-opsi-aksi"><span style="font-size:11.5px; font-weight:700; color:#b45309;"><i class="fa fa-folder-open"></i> Pilar ' + indeks.code + '</span></td>' +
        '<td class="col-verifikator"><span class="badge-verif-pill" title="Total Nilai Verifikator Pilar ' + indeks.code + '"><i class="fa fa-shield"></i> Verif: ' + numFmt(calculatedVerif[indeks.code] || 0) + '</span></td>';
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
            '<td class="col-opsi-aksi"><span style="font-size:11.5px; font-weight:600; color:#2563eb;">Aspek Evaluasi</span></td>' +
            '<td class="col-verifikator"><span style="font-size:11.5px; font-weight:600; color:#0d9488;">Verif: ' + numFmt(calculatedVerif[aspek.code] || 0) + '</span></td>';
          tbody.appendChild(trAspek);

          if (isAspekOpen && hasChildInd){
            aspek.indikator.forEach(function(ind){
              var isIndOpen = !collapsedKeys.has(ind.code);
              var hasSub = ind.sub && ind.sub.length > 0;

              var savedScoreInd = SCORES_MAP[ind.code] || {};
              var hasScore = savedScoreInd.bobot_capaian !== null && savedScoreInd.bobot_capaian !== undefined && savedScoreInd.bobot_capaian !== "";
              var currentScoreVal = hasSub ? calculatedScores[ind.code] : (hasScore ? savedScoreInd.bobot_capaian : "");
              var hasVerifInd = savedScoreInd.bobot_verifikator !== null && savedScoreInd.bobot_verifikator !== undefined && savedScoreInd.bobot_verifikator !== "";

              var trInd = document.createElement("tr");
              trInd.className = "type-indikator";

              var cellInputOrBadge = hasSub ? 
                '<span class="badge-sum-score">' + numFmt(calculatedScores[ind.code] || 0) + '</span>' :
                '<input type="number" step="0.001" min="0" max="' + ind.bobot + '" class="input-bobot-cell" data-code="' + ind.code + '" data-max="' + ind.bobot + '" value="' + currentScoreVal + '" placeholder="0">';

              var directActionHtml = hasSub ? 
                '<span style="font-size:11.5px; color:#047857; font-weight:600;"><i class="fa fa-list"></i> ' + ind.sub.length + ' Sub-Indikator</span>' :
                '<button type="button" class="btn-action-detail ' + (hasScore ? 'has-score' : '') + '" data-code="' + ind.code + '" title="Buka lembar kerja penilaian detail">' +
                  '<i class="fa ' + (hasScore ? 'fa-check-square' : 'fa-pencil-square-o') + '"></i> ' +
                  (hasScore ? 'Detail (' + numFmt(savedScoreInd.bobot_capaian) + ')' : 'Detail Penilaian') +
                '</button>';

              var verifActionHtml = hasSub ?
                '<span class="badge-verif-subtotal" title="Total Nilai Verifikator Indikator ' + ind.no + '"><i class="fa fa-shield"></i> ' + numFmt(calculatedVerif[ind.code] || 0) + '</span>' :
                renderVerifikatorButtonHtml(ind.code, savedScoreInd);

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
                '<td class="col-opsi-aksi">' + directActionHtml + '</td>' +
                '<td class="col-verifikator">' + verifActionHtml + '</td>';
              tbody.appendChild(trInd);

              if (isIndOpen && hasSub){
                ind.sub.forEach(function(sub){
                  var savedScoreSub = SCORES_MAP[sub.code] || {};
                  var hasSubScore = savedScoreSub.bobot_capaian !== null && savedScoreSub.bobot_capaian !== undefined && savedScoreSub.bobot_capaian !== "";
                  var currentSubScore = hasSubScore ? savedScoreSub.bobot_capaian : "";
                  var hasSubVerif = savedScoreSub.bobot_verifikator !== null && savedScoreSub.bobot_verifikator !== undefined && savedScoreSub.bobot_verifikator !== "";

                  var verifSubHtml = renderVerifikatorButtonHtml(sub.code, savedScoreSub);

                  var trSub = document.createElement("tr");
                  trSub.className = "type-sub";
                  trSub.innerHTML = 
                    '<td class="col-no" style="font-weight:normal; color:#64748b;">' + sub.letter + ')</td>' +
                    '<td>' +
                      '<div class="uraian-wrapper" style="padding-left: 68px;">' +
                        '<div class="tree-text-content">' +
                          '<div class="tree-eyebrow" style="color:#64748b;">Poin ' + sub.code + '</div>' +
                          '<div class="tree-title">' + escapeHtml(sub.title) + '</div>' +
                        '</div>' +
                      '</div>' +
                    '</td>' +
                    '<td class="col-bobot-maks" style="font-weight:600; color:#475569;">' + numFmt(sub.bobot) + '</td>' +
                    '<td class="col-bobot-capaian">' +
                      '<input type="number" step="0.001" min="0" max="' + sub.bobot + '" class="input-bobot-cell" data-code="' + sub.code + '" data-max="' + sub.bobot + '" value="' + currentSubScore + '" placeholder="0">' +
                    '</td>' +
                    '<td class="col-opsi-aksi">' +
                      '<button type="button" class="btn-action-detail ' + (hasSubScore ? 'has-score' : '') + '" data-code="' + sub.code + '" title="Buka lembar kerja penilaian detail">' +
                        '<i class="fa ' + (hasSubScore ? 'fa-check-square' : 'fa-pencil-square-o') + '"></i> ' +
                        (hasSubScore ? 'Detail (' + numFmt(savedScoreSub.bobot_capaian) + ')' : 'Detail Penilaian') +
                      '</button>' +
                    '</td>' +
                    '<td class="col-verifikator">' + verifSubHtml + '</td>';
                  tbody.appendChild(trSub);
                });
              }
            });
          }
        });
      }
    });
  }

  // Margin Score Conversion function identical to Excel Formula:
  // IF(margin<=0%, 100%, IF(margin<=5%, 95%, IF(margin<=10%, 90%, ... IF(margin>95%, 0%))))
  function calcMarginScore(margin){
    if (margin === null || margin === undefined || isNaN(margin)) return 100;
    margin = Math.abs(Number(margin));
    if (margin <= 0) return 100;
    if (margin <= 5) return 95;
    if (margin <= 10) return 90;
    if (margin <= 15) return 85;
    if (margin <= 20) return 80;
    if (margin <= 25) return 75;
    if (margin <= 30) return 70;
    if (margin <= 35) return 65;
    if (margin <= 40) return 60;
    if (margin <= 45) return 55;
    if (margin <= 50) return 50;
    if (margin <= 55) return 45;
    if (margin <= 60) return 40;
    if (margin <= 65) return 35;
    if (margin <= 70) return 30;
    if (margin <= 75) return 25;
    if (margin <= 80) return 20;
    if (margin <= 85) return 15;
    if (margin <= 90) return 10;
    if (margin <= 95) return 5;
    return 0;
  }

  // =========================================================================
  // WORKSHEET RENDERERS (Exact replicas of the 21 Excel Sheet HTML Templates)
  // =========================================================================

  // 1. Sheet 1.a.1.a (LPE, TK, TPT - RPJMN vs RPJMD)
  function renderWs_1_a_1_a(d, maxBobot){
    d = d || {};
    var rowsData = [
      { id: 'lpe', name: 'Laju Pertumbuhan Ekonomi (LPE)', unit: 'Persen', isPositive: true,
        mn_base: d.lpe_mn_base !== undefined ? d.lpe_mn_base : (AUTO_DATA_1_A_1_A.mn_lpe_base || ''),
        mn_end:  d.lpe_mn_end  !== undefined ? d.lpe_mn_end  : (AUTO_DATA_1_A_1_A.mn_lpe_end || ''),
        md_base: d.lpe_md_base !== undefined ? d.lpe_md_base : (AUTO_DATA_1_A_1_A.md_lpe_base || ''),
        md_end:  d.lpe_md_end  !== undefined ? d.lpe_md_end  : (AUTO_DATA_1_A_1_A.md_lpe_end || '') },
      { id: 'tk', name: 'Tingkat Kemiskinan (TK)', unit: 'Persen', isPositive: true,
        mn_base: d.tk_mn_base !== undefined ? d.tk_mn_base : (AUTO_DATA_1_A_1_A.mn_tk_base || ''),
        mn_end:  d.tk_mn_end  !== undefined ? d.tk_mn_end  : (AUTO_DATA_1_A_1_A.mn_tk_end || ''),
        md_base: d.tk_md_base !== undefined ? d.tk_md_base : (AUTO_DATA_1_A_1_A.md_tk_base || ''),
        md_end:  d.tk_md_end  !== undefined ? d.tk_md_end  : (AUTO_DATA_1_A_1_A.md_tk_end || '') },
      { id: 'tpt', name: 'Tingkat Pengangguran Terbuka (TPT)', unit: 'Persen', isPositive: false,
        mn_base: d.tpt_mn_base !== undefined ? d.tpt_mn_base : (AUTO_DATA_1_A_1_A.mn_tpt_base || ''),
        mn_end:  d.tpt_mn_end  !== undefined ? d.tpt_mn_end  : (AUTO_DATA_1_A_1_A.mn_tpt_end || ''),
        md_base: d.tpt_md_base !== undefined ? d.tpt_md_base : (AUTO_DATA_1_A_1_A.md_tpt_base || ''),
        md_end:  d.tpt_md_end  !== undefined ? d.tpt_md_end  : (AUTO_DATA_1_A_1_A.md_tpt_end || '') }
    ];

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.1.a</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_a" style="min-width: 950px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="3" style="width:45px; text-align:center;">No</th>' +
            '<th colspan="5" class="th-blue" style="font-size:13px;">RPJMN (Nasional)</th>' +
            '<th colspan="5" class="th-amber" style="font-size:13px;">RPJMD (Daerah)</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width:220px; white-space:nowrap;">Indikator Sasaran PN</th>' +
            '<th colspan="3" class="th-blue">Target RPJMN</th>' +
            '<th rowspan="2" class="th-blue" style="width:70px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width:220px; white-space:nowrap;">Indikator Sasaran Daerah</th>' +
            '<th colspan="3" class="th-amber">Target RPJMD</th>' +
            '<th rowspan="2" class="th-amber" style="width:70px; white-space:nowrap;">Satuan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width:70px;">Baseline</th><th class="th-blue" style="width:70px;">Akhir</th><th class="th-blue" style="width:65px;">Gap</th>' +
            '<th class="th-amber" style="width:70px;">Baseline</th><th class="th-amber" style="width:70px;">Akhir</th><th class="th-amber" style="width:65px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rowsData.forEach(function(r, idx){
      var rNum = idx + 1;
      html += 
        '<tr class="ws-1a1a-row" data-row-id="' + r.id + '" data-positive="' + (r.isPositive ? '1' : '0') + '">' +
          '<td class="excel-row-num">' + rNum + '</td>' +
          '<td><strong>' + r.name + '</strong></td>' +
          '<td><input type="text" class="calc-inp mn-base" value="' + escapeHtml(r.mn_base) + '" readonly style="text-align:center; background:#f8fafc; font-weight:600;"></td>' +
          '<td><input type="text" class="calc-inp mn-end" value="' + escapeHtml(r.mn_end) + '" readonly style="text-align:center; background:#f8fafc; font-weight:600;"></td>' +
          '<td class="cell-formula mn-gap" style="text-align:center;">0.00</td>' +
          '<td style="text-align:center; font-weight:600; color:#475569;">' + r.unit + '</td>' +
          '<td><strong>' + r.name + '</strong></td>' +
          '<td><input type="text" class="calc-inp md-base" value="' + escapeHtml(r.md_base) + '" readonly style="text-align:center; background:#f8fafc; font-weight:600;"></td>' +
          '<td><input type="text" class="calc-inp md-end" value="' + escapeHtml(r.md_end) + '" readonly style="text-align:center; background:#f8fafc; font-weight:600;"></td>' +
          '<td class="cell-formula md-gap" style="text-align:center;">0.00</td>' +
          '<td style="text-align:center; font-weight:600; color:#475569;">' + r.unit + '</td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 2. Sheet 1.a.1.b & 1.a.1.d (Tabel Persandingan Ada / Tidak Ada)
  function renderWs_TabelPersandingan(code, d, maxBobot){
    d = d || {};
    var labelItem = (code === '1.a.1.b') ? 
      'Tabel Persandingan antara Sasaran Pembangunan Daerah RPJMD dengan PN RPJMN' : 
      'Tabel Persandingan antara Prioritas Pembangunan Daerah RPJMD dengan PN RPJMN';
    var curVal = d.status_tabel || (d.avail == '0' ? 'Tidak Ada' : 'Ada');

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" style="width: 100%;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-green" style="width: 65%;">Parameter Pemeriksaan Dokumen (RPJMD)</th>' +
            '<th class="th-blue" style="width: 30%;">Status Ketersediaan Tabel</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr>' +
            '<td class="excel-row-num">1</td>' +
            '<td><strong>' + labelItem + '</strong></td>' +
            '<td>' +
              '<select id="wsSelectPersandingan" style="font-weight:700; color:#107c41; width:100%;">' +
                '<option value="Ada"' + (curVal === 'Ada' ? ' selected' : '') + '>Ada (Tersedia dalam Dokumen)</option>' +
                '<option value="Tidak Ada"' + (curVal === 'Tidak Ada' ? ' selected' : '') + '>Tidak Ada (Belum Tersedia)</option>' +
              '</select>' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 3. Sheet 1.a.1.c (Prioritas Pembangunan Daerah vs Prioritas Nasional RPJMN)
  function renderWs_1_a_1_c(d, maxBobot){
    d = d || {};
    var pns = d.pn_list || (AUTO_DATA_1_A_1_C && AUTO_DATA_1_A_1_C.length > 0 ? AUTO_DATA_1_A_1_C : []);

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Matriks Prioritas Daerah vs Prioritas Nasional</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_c" style="width: 100%; min-width: 800px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-blue" style="width: 35%;">Prioritas Pembangunan Nasional (RPJMN)</th>' +
            '<th class="th-amber" style="width: 35%;">Prioritas Pembangunan Daerah (RPJMD)</th>' +
            '<th class="th-green" style="width: 15%;">Nilai Keselarasan</th>' +
            '<th class="th-gray" style="width: 15%;">Keterangan</th>' +
            '<th class="th-gray" style="width: 50px;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!pns || pns.length === 0){
      return html + '<tr><td colspan="6" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data Prioritas Daerah vs Prioritas Nasional pada menu terkait. Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr></tbody></table></div>';
    }

    var rowCounter = 1;
    pns.forEach(function(pn, pnIdx){
      var pdsToRender = (pn.pds && pn.pds.length > 0) ? pn.pds : [{ title: '', score: 0, ket: 'Tidak Ada Misi Daerah' }];
      var pdCount = pdsToRender.length;
      pdsToRender.forEach(function(pd, pdIdx){
        html += 
          '<tr class="ws-matrix-row" data-pn-idx="' + pnIdx + '" data-pd-idx="' + pdIdx + '">' +
            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-pn-wrap" style="vertical-align:top; background:#f0f7ff;">' +
              '<textarea class="calc-inp pn-title-inp" rows="2" style="font-weight:700; color:#1e3a8a; background:transparent; border:none;" placeholder="Prioritas Nasional..." readonly>' + escapeHtml(pn.pn_title) + '</textarea>' +
            '</td>';
        }

        html += 
            '<td><textarea class="calc-inp pd-title-inp" rows="3" style="width:100%; background:transparent; border:none; resize:vertical;" placeholder="Prioritas Daerah..." readonly>' + escapeHtml(pd.title) + '</textarea></td>' +
            '<td>' +
              '<select class="calc-inp pd-score-sel">' +
                '<option value="1.0"' + (pd.score == 1.0 || pd.score === undefined ? ' selected' : '') + '>100% (Selaras)</option>' +
                '<option value="0.75"' + (pd.score == 0.75 ? ' selected' : '') + '>75% (Sebagian Besar)</option>' +
                '<option value="0.5"' + (pd.score == 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
                '<option value="0"' + (pd.score == 0 ? ' selected' : '') + '>0% (Tidak Selaras)</option>' +
              '</select>' +
            '</td>' +
            '<td><input type="text" class="pd-ket-inp" value="' + escapeHtml(pd.ket || '') + '" placeholder="Keterangan..."></td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center;">' +
              '<span style="color:#cbd5e1; font-size:12px;">(Otomatis)</span>' +
            '</td>';
        } else {
          html += 
            '<td style="text-align:center;"><span style="color:#cbd5e1; font-size:12px;">(Otomatis)</span></td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 4. Sheet 1.a.2.a (PN 1 Kegiatan Prioritas PP 1 s.d PP 8)
  function renderWs_1_a_2_a(d, maxBobot){
    d = d || {};
    var savedPpList = d.pp_list || [];
    var pnList = (AUTO_DATA_1_A_2_A && AUTO_DATA_1_A_2_A.length > 0) ? AUTO_DATA_1_A_2_A : (d.pn_list || []);
    
    // Fallback if no dynamic data
    if (pnList.length === 0) {
      pnList = [{
        pn_title: 'Belum ada data Keselarasan Prioritas (silakan isi di menu Keselarasan Kegiatan Prioritas Utama)',
        pps: []
      }];
    }

    // Merge saved review & score into the fresh data
    if (pnList.length > 0 && savedPpList.length > 0) {
        pnList[0].pps.forEach(function(pp) {
            var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
            if (savedPp) {
                pp.pds.forEach(function(pd) {
                    var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
                    if (savedPd) {
                        pd.ta_review = savedPd.ta_review;
                        pd.score = savedPd.score;
                    }
                });
            }
        });
    }

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_a" style="width: 100%; min-width: 900px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-blue" style="width: 25%;">Prioritas Nasional (RPJMN)</th>' +
            '<th class="th-blue" style="width: 25%;">Program Prioritas (PP)</th>' +
            '<th class="th-amber" style="width: 25%;">Dukungan Program Daerah (RPJMD)</th>' +
            '<th class="th-green" style="width: 15%;">Hasil Review TA Bidang</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 1;
    pnList.forEach(function(pn, pnIdx) {
        var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [] }];
        
        var totalRowsForPn = pps.reduce(function(acc, pp) {
            return acc + (pp.pds && pp.pds.length > 0 ? pp.pds.length : 1);
        }, 0);

        pps.forEach(function(pp, ppIdx) {
            var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', score: 1.0, ta_review: '' }];
            var pdCount = pds.length;
            var globalPpIdx = pnIdx + "_" + ppIdx;

            pds.forEach(function(pd, pdIdx) {
                html += '<tr class="ws-pp-row" data-pp-idx="' + globalPpIdx + '">';
                html += '<td class="excel-row-num">' + (rowCounter++) + '</td>';

                if (ppIdx === 0 && pdIdx === 0) {
                    html += '<td rowspan="' + totalRowsForPn + '" class="cell-pn-wrap-2a" style="vertical-align:top; background:#f0f7ff; font-weight:800; color:#1e3a8a;">' +
                            escapeHtml(pn.pn_title) +
                            '</td>';
                }

                if (pdIdx === 0) {
                    html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2a" style="vertical-align:top; background:#fdfdfd;">' +
                            '<textarea class="calc-inp pp-title-inp" style="font-weight:700; color:#203764; width:100%; resize:none; border:none; background:transparent;" rows="3" readonly>' + escapeHtml(pp.pp_title) + '</textarea>' +
                            '</td>';
                }

                html += '<td><textarea class="calc-inp pd-title-inp" style="width:100%; resize:none; border:none; background:transparent;" rows="2" readonly>' + escapeHtml(pd.title) + '</textarea></td>';
                html += '<td><input type="text" class="pd-review-inp" value="' + escapeHtml(pd.ta_review || '') + '" placeholder="Review TA..."></td>';
                html += '<td>' +
                            '<select class="calc-inp pd-score-sel">' +
                                '<option value="1.0"' + (pd.score == 1.0 || pd.score === undefined ? ' selected' : '') + '>100% (Iya / Selaras)</option>' +
                                '<option value="0.75"' + (pd.score == 0.75 ? ' selected' : '') + '>75% (Sebagian Besar)</option>' +
                                '<option value="0.5"' + (pd.score == 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
                                '<option value="0"' + (pd.score == 0 ? ' selected' : '') + '>0% (Tidak)</option>' +
                            '</select>' +
                        '</td>';
                
                html += '</tr>';
            });
        });
    });

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 5. Sheets 1.a.2.b s.d 1.a.2.g (PN 2 s.d PN 7 dengan Kolom Review TA Bidang)
  function renderWs_1_a_2_b_to_g(code, d, maxBobot){
    d = d || {};
    var savedPpList = d.pp_list || [];
    
    // Get fresh data from db
    var pnList = AUTO_DATA_1_A_2_ALL[code] ? [AUTO_DATA_1_A_2_ALL[code]] : [];
    
    // Merge saved review & score into the fresh data
    if (pnList.length > 0 && savedPpList.length > 0) {
        pnList[0].pps.forEach(function(pp) {
            var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
            if (savedPp) {
                pp.pds.forEach(function(pd) {
                    var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
                    if (savedPd) {
                        pd.ta_review = savedPd.ta_review;
                        pd.score = savedPd.score;
                    }
                });
            }
        });
    }

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_bg" style="width: 100%; min-width: 900px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-blue" style="width: 25%;">Prioritas Nasional (RPJMN)</th>' +
            '<th class="th-blue" style="width: 25%;">Program Prioritas (PP)</th>' +
            '<th class="th-amber" style="width: 25%;">Dukungan Program Daerah</th>' +
            '<th class="th-green" style="width: 15%;">Hasil Review TA Bidang</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (pnList.length === 0) {
        html += '<tr><td colspan="6" style="text-align:center; padding:15px; color:#666;">Data tidak ditemukan atau Instansi belum dipetakan.</td></tr>';
    } else {
        var rowCounter = 1;
        pnList.forEach(function(pn, pnIdx) {
            var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [] }];
            
            pps.forEach(function(pp, ppIdx) {
                var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', ta_review: '', score: 1.0 }];
                var pdCount = pds.length;
                var globalPpIdx = pnIdx + "_" + ppIdx;
                
                pds.forEach(function(pd, pdIdx) {
                    html += '<tr class="ws-ppbg-row" data-pp-idx="' + globalPpIdx + '" data-pd-idx="' + pdIdx + '">' +
                            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

                    if (ppIdx === 0 && pdIdx === 0) {
                        var totalRowsAll = pps.reduce(function(acc, item) { return acc + (item.pds && item.pds.length > 0 ? item.pds.length : 1); }, 0);
                        html += '<td rowspan="' + totalRowsAll + '" class="cell-pn-wrap-bg" style="vertical-align:top; background:#f0f7ff; font-weight:800; color:#1e3a8a;">' +
                                escapeHtml(pn.pn_title) +
                                '</td>';
                    }

                    if (pdIdx === 0) {
                        html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-bg" style="vertical-align:top; background:#fdfdfd;">' +
                                '<textarea class="calc-inp pp-title-inp" rows="2" style="font-weight:700; color:#203764; background:#f8f9fa; cursor:not-allowed;" readonly placeholder="Program Prioritas...">' + escapeHtml(pp.pp_title) + '</textarea>' +
                                '</td>';
                    }

                    html += '<td><input type="text" class="calc-inp pd-title-inp" value="' + escapeHtml(pd.title) + '" readonly style="background:#f8f9fa; cursor:not-allowed;" placeholder="Program Daerah..."></td>' +
                            '<td><input type="text" class="pd-review-inp" value="' + escapeHtml(pd.ta_review || '') + '" placeholder="Review TA..."></td>' +
                            '<td>' +
                                '<select class="calc-inp pd-score-sel">' +
                                    '<option value="1.0"' + (pd.score == 1.0 || pd.score === undefined ? ' selected' : '') + '>100% (Iya / Selaras)</option>' +
                                    '<option value="0.75"' + (pd.score == 0.75 ? ' selected' : '') + '>75% (Sebagian Besar)</option>' +
                                    '<option value="0.5"' + (pd.score == 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
                                    '<option value="0"' + (pd.score == 0 ? ' selected' : '') + '>0% (Tidak)</option>' +
                                '</select>' +
                            '</td>' +
                            '</tr>';
                });
            });
        });
    }

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 6. Sheet 1.a.3.a (TPT) & 1.a.3.b (TK) (RPJMN vs RPJMD)
  function renderWs_1_a_3(code, d, maxBobot){
    d = d || {};
    var isTpt = (code === '1.a.3.a');
    var indName = isTpt ? 'Tingkat Pengangguran Terbuka (TPT)' : 'Tingkat Kemiskinan (TK)';
    var mn_base = d.mn_base !== undefined ? d.mn_base : (isTpt ? (AUTO_DATA_1_A_3_A.mn_base || AUTO_DATA_1_A_1_A.mn_tpt_base || '') : (AUTO_DATA_1_A_3_B.mn_base || AUTO_DATA_1_A_1_A.mn_tk_base || ''));
    var mn_end  = d.mn_end  !== undefined ? d.mn_end  : (isTpt ? (AUTO_DATA_1_A_3_A.mn_end || AUTO_DATA_1_A_1_A.mn_tpt_end || '') : (AUTO_DATA_1_A_3_B.mn_end || AUTO_DATA_1_A_1_A.mn_tk_end || ''));
    var md_base = d.md_base !== undefined ? d.md_base : (isTpt ? (AUTO_DATA_1_A_3_A.md_base || AUTO_DATA_1_A_1_A.md_tpt_base || '') : (AUTO_DATA_1_A_3_B.md_base || AUTO_DATA_1_A_1_A.md_tk_base || ''));
    var md_end  = d.md_end  !== undefined ? d.md_end  : (isTpt ? (AUTO_DATA_1_A_3_A.md_end || AUTO_DATA_1_A_1_A.md_tpt_end || '') : (AUTO_DATA_1_A_3_B.md_end || AUTO_DATA_1_A_1_A.md_tk_end || ''));

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Indikator Makro RPJMD vs RPJMN (' + (isTpt ? 'TPT' : 'TK') + ')</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_3" style="min-width: 950px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="3" style="width:45px; text-align:center;">No</th>' +
            '<th colspan="5" class="th-blue" style="font-size:13px;">RPJMN (Nasional)</th>' +
            '<th colspan="5" class="th-amber" style="font-size:13px;">RPJMD (Daerah)</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width:220px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue">Target RPJMN</th>' +
            '<th rowspan="2" class="th-blue" style="width:70px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width:220px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber">Target RPJMD</th>' +
            '<th rowspan="2" class="th-amber" style="width:70px; white-space:nowrap;">Satuan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width:70px;">Baseline</th><th class="th-blue" style="width:70px;">Akhir</th><th class="th-blue" style="width:65px;">Gap</th>' +
            '<th class="th-amber" style="width:70px;">Baseline</th><th class="th-amber" style="width:70px;">Akhir</th><th class="th-amber" style="width:65px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-1a3-row" data-positive="0">' +
            '<td class="excel-row-num">1</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="text" class="calc-inp mn-base" value="' + escapeHtml(mn_base) + '" readonly style="text-align:center; background:#f1f5f9; cursor:not-allowed; font-weight:600;"></td>' +
            '<td><input type="text" class="calc-inp mn-end" value="' + escapeHtml(mn_end) + '" readonly style="text-align:center; background:#f1f5f9; cursor:not-allowed; font-weight:600;"></td>' +
            '<td class="cell-formula mn-gap" style="text-align:center;">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="text" class="calc-inp md-base" value="' + escapeHtml(md_base) + '" readonly style="text-align:center; background:#f1f5f9; cursor:not-allowed; font-weight:600;"></td>' +
            '<td><input type="text" class="calc-inp md-end" value="' + escapeHtml(md_end) + '" readonly style="text-align:center; background:#f1f5f9; cursor:not-allowed; font-weight:600;"></td>' +
            '<td class="cell-formula md-gap" style="text-align:center;">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 7. Sheet 1.a.4 (Kegiatan Prioritas Utama KPU RPJMN vs Dukungan Program Daerah RPJMD)
  function renderWs_1_a_4(d, maxBobot){
    d = d || {};
    var kpuList = (d.kpu_list && Array.isArray(d.kpu_list) && d.kpu_list.length > 0) ? d.kpu_list : 
                  ((Array.isArray(AUTO_DATA_1_A_4) && AUTO_DATA_1_A_4.length > 0) ? AUTO_DATA_1_A_4 : []);

    var html = 
      '<div style="overflow-x:auto; padding-bottom:10px;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_4" style="min-width: 950px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="th-blue" style="width: 320px; min-width: 320px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">RPJMN<br><small style="font-weight:600; font-size:12px; color:#1e3a8a;">Kegiatan Prioritas Utama (KPU)</small></th>' +
            '<th class="th-amber" style="width: 340px; min-width: 340px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">RPJMD<br><small style="font-weight:600; font-size:12px; color:#78350f;">Dukungan Program Pembangunan Daerah</small></th>' +
            '<th class="th-green" style="width: 140px; min-width: 140px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">Nilai Keselarasan (0,5 / 1,0)</th>' +
            '<th class="th-amber" style="width: 280px; min-width: 280px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">Keterangan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!kpuList || kpuList.length === 0){
      return html + '<tr><td colspan="4" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data KPU RPJMN / Dukungan Program Daerah RPJMD pada menu terkait. Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr></tbody></table></div>';
    }

    kpuList.forEach(function(kpu, kpuIdx){
      var pdList = (kpu.pds && kpu.pds.length > 0) ? kpu.pds : [{ title: '-', score: 0.50 }];
      var pdCount = pdList.length;

      pdList.forEach(function(pd, pdIdx){
        html += 
          '<tr class="ws-1a4-row" data-kpu-idx="' + kpuIdx + '" data-pd-idx="' + pdIdx + '" data-kpu-title="' + escapeHtml(kpu.kpu_title || '') + '">';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" style="vertical-align: top; font-weight: 700; color: #1e3a8a; background: #f0f7ff; font-size: 13px; padding: 12px 10px; line-height: 1.55;">' +
              escapeHtml(kpu.kpu_title || '') +
            '</td>';
        }

        var isStrip = (!pd.title || pd.title === '-');
        html += 
          '<td style="vertical-align: middle; padding: 10px 12px; font-size: 13px; line-height: 1.55; color: ' + (isStrip ? '#94a3b8' : '#1e293b') + ';">' +
            '<span class="kpu-prog-title" style="font-weight: ' + (isStrip ? '400; font-style:italic' : '600') + ';">' + escapeHtml(pd.title || '-') + '</span>' +
          '</td>';

        var curScore = (pd.score !== null && pd.score !== undefined) ? parseFloat(pd.score) : (isStrip ? 0.50 : 1.00);
        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<select class="calc-inp kpu-score-sel" style="text-align: center; font-weight: 700; font-size: 13px; height: 38px; padding: 6px 8px; border-radius: 6px; background: #ffffff; cursor: pointer;">' +
              '<option value="1.00"' + (curScore === 1.0 ? ' selected' : '') + '>1.00 (Selaras)</option>' +
              '<option value="0.50"' + (curScore === 0.5 ? ' selected' : '') + '>0.50 (Sebagian)</option>' +
              '<option value="0.00"' + (curScore === 0.0 ? ' selected' : '') + '>0.00 (Tidak)</option>' +
            '</select>' +
          '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" style="vertical-align: top; padding: 10px 8px;">' +
              '<textarea class="calc-inp kpu-ket-inp" rows="4" style="resize: vertical; font-size: 12.5px; line-height: 1.5; padding: 8px 10px; border-radius: 6px; min-height: 85px;">' + escapeHtml(kpu.keterangan || (isStrip ? 'Tidak ada Dukungan Program Pembangunan Daerah untuk mendukung Kegiatan Prioritas Utama terkait' : 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Kegiatan Prioritas Utama terkait')) + '</textarea>' +
            '</td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
}

  // 8. Sheet 1.a.5 (Komponen SPM RPJMD) & Sheet 1.a.6 (Target SPM)
  function renderWs_SPM(code, d, maxBobot){
    d = d || {};
    var is1a5 = (code === '1.a.5');

    var defaultSPM = [
      {
        bidang_nasional: 'Bidang 1 : pendidikan',
        bidang_daerah: 'Bidang 1 : pendidikan',
        keterangan: 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait',
        ind_list: [
          { no: 1, name: 'Indikator 1 : Jumlah anak usia 5-6 tahun yang berpartisipasi dalam pendidikan anak usia dini (APS)', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 2, name: 'Indikator 2 : Jumlah anak usia 7-15 Tahun yang berpartisipasi dalam pendidikan dasar (APS)', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 3, name: 'Indikator 3 : Jumlah anak usia 7-18 Tahun yang berpartisipasi dalam pendidikan kesetaraan (Paket A/B/C) (APS)', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 4, name: 'Indikator 4 : Skor kemampuan Literasi SD', target: '100', unit: 'Angka', score: 1.0 },
          { no: 5, name: 'Indikator 5 : Skor kemampuan Numerasi SD', target: '100', unit: 'Angka', score: 1.0 },
          { no: 6, name: 'Indikator 6 : Skor kemampuan Literasi SMP', target: '100', unit: 'Angka', score: 1.0 },
          { no: 7, name: 'Indikator 7 : Skor kemampuan Numerasi SMP', target: '100', unit: 'Angka', score: 1.0 },
          { no: 8, name: 'Indikator 8 : Pertumbuhan Pendidik PAUD yang Memiliki Kualifikasi Akademik Paling Rendah D-IV/S1', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 9, name: 'Indikator 9 : Indeks Iklim Keamanan SD', target: '100', unit: 'Angka', score: 1.0 },
          { no: 10, name: 'Indikator 10 : Indeks Iklim Kebinekaan SD', target: '100', unit: 'Angka', score: 1.0 },
          { no: 11, name: 'Indikator 11 : Indeks Inklusivitas SD', target: '100', unit: 'Angka', score: 1.0 },
          { no: 12, name: 'Indikator 12 : Indeks Iklim Keamanan SMP', target: '100', unit: 'Angka', score: 1.0 },
          { no: 13, name: 'Indikator 13 : Indeks Iklim Kebinekaan SMP', target: '100', unit: 'Angka', score: 1.0 },
          { no: 14, name: 'Indikator 14 : Indeks Inklusivitas SMP', target: '100', unit: 'Angka', score: 1.0 }
        ]
      },
      {
        bidang_nasional: 'Bidang 2 : kesehatan',
        bidang_daerah: 'Bidang 2 : kesehatan',
        keterangan: 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait',
        ind_list: [
          { no: 1, name: 'Indikator 1 : Pelayanan Kesehatan Ibu Hamil', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 2, name: 'Indikator 2 : Pelayanan Kesehatan Ibu Bersalin', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 3, name: 'Indikator 3 : Pelayanan Kesehatan Bayi Baru Lahir', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 4, name: 'Indikator 4 : Pelayanan Kesehatan Balita', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 5, name: 'Indikator 5 : Pelayanan Kesehatan pada Usia Pendidikan Dasar', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 6, name: 'Indikator 6 : Pelayanan Kesehatan pada Usia Produktif', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 7, name: 'Indikator 7 : Pelayanan Kesehatan pada Usia Lanjut', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 8, name: 'Indikator 8 : Pelayanan Kesehatan Penderita Hipertensi', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 9, name: 'Indikator 9 : Pelayanan Kesehatan Penderita Diabetes Melitus (DM)', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 10, name: 'Indikator 10 : Pelayanan Kesehatan Orang dengan Gangguan Jiwa (ODGJ) Berat', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 11, name: 'Indikator 11 : Pelayanan Kesehatan Orang Terduga Tuberkulosis', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 12, name: 'Indikator 12 : Pelayanan Kesehatan Orang Dengan Risiko Terinfeksi Virus yang Melemahkan Daya Tahan Tubuh Manusia (HIV)', target: '100%', unit: 'Persen', score: 1.0 }
        ]
      },
      {
        bidang_nasional: 'Bidang 3 : pekerjaan umum',
        bidang_daerah: 'Bidang 3 : pekerjaan umum',
        keterangan: 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait',
        ind_list: [
          { no: 1, name: 'Indikator 1 : Persentase Penyediaan Kebutuhan Pokok Air Minum Sehari-hari', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 2, name: 'Indikator 2 : Persentase Penyediaan Pelayanan Pengolahan Air Limbah Domestik', target: '100%', unit: 'Persen', score: 1.0 }
        ]
      },
      {
        bidang_nasional: 'Bidang 4 : perumahan rakyat',
        bidang_daerah: 'Bidang 4 : perumahan rakyat',
        keterangan: 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait',
        ind_list: [
          { no: 1, name: 'Indikator 1 : Persentase Penyediaan Rumah Layak Huni bagi Korban Bencana Kabupaten/Kota', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 2, name: 'Indikator 2 : Persentase Fasilitasi Penyediaan Rumah Layak Huni bagi Masyarakat yang Terkena Relokasi Program Pemerintah Daerah Kabupaten/Kota', target: '100%', unit: 'Persen', score: 1.0 }
        ]
      },
      {
        bidang_nasional: 'Bidang 5 : ketenteraman, ketertiban umum, dan pelindungan masyarakat',
        bidang_daerah: 'Bidang 5 : ketenteraman, ketertiban umum, dan pelindungan masyarakat',
        keterangan: 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait',
        ind_list: [
          { no: 1, name: 'Indikator 1 : Persentase Pelayanan Ketenteraman dan Ketertiban Umum', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 2, name: 'Indikator 2 : Persentase Pelayanan Penyelamatan dan Evakuasi Korban Bencana', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 3, name: 'Indikator 3 : Persentase Pelayanan Penyelamatan dan Evakuasi Korban Kebakaran', target: '100%', unit: 'Persen', score: 1.0 }
        ]
      },
      {
        bidang_nasional: 'Bidang 6 : sosial',
        bidang_daerah: 'Bidang 6 : sosial',
        keterangan: 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait',
        ind_list: [
          { no: 1, name: 'Indikator 1 : Persentase Penyandang Disabilitas Terlantar yang Terpenuhi Kebutuhan Dasarnya', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 2, name: 'Indikator 2 : Persentase Anak Terlantar yang Terpenuhi Kebutuhan Dasarnya', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 3, name: 'Indikator 3 : Persentase Lanjut Usia Terlantar yang Terpenuhi Kebutuhan Dasarnya', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 4, name: 'Indikator 4 : Persentase Gelandangan dan Pengemis yang Terpenuhi Kebutuhan Dasarnya', target: '100%', unit: 'Persen', score: 1.0 },
          { no: 5, name: 'Indikator 5 : Persentase Korban Bencana Daerah yang Terpenuhi Kebutuhan Dasarnya Saat dan Setelah Tanggap Darurat Bencana', target: '100%', unit: 'Persen', score: 1.0 }
        ]
      }
    ];

    var autoSource = is1a5 ? (AUTO_DATA_1_A_5 || []) : (AUTO_DATA_1_A_6 || []);
    var spmData = (d.spm_list && Array.isArray(d.spm_list) && d.spm_list.length > 0) ? d.spm_list : 
                  (Array.isArray(autoSource) && autoSource.length > 0 ? autoSource : []);

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_SPM" style="min-width: 1250px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th rowspan="2" class="th-green" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">PP No. 2 Tahun 2018 tentang SPM<br><small style="font-weight:600; font-size:12px; color:#14532d;">Nasional</small></th>' +
            '<th rowspan="2" class="th-blue" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">' + (is1a5 ? 'RPJMD' : 'RKPD') + '<br><small style="font-weight:600; font-size:12px; color:#1e3a8a;">Bidang SPM Daerah</small></th>' +
            '<th rowspan="2" class="th-blue" style="width: 280px; min-width: 280px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">Indikator SPM</th>' +
            '<th colspan="2" class="th-blue" style="vertical-align: middle; font-size: 13.5px; padding: 10px 8px;">Target ' + (is1a5 ? 'RPJMD' : 'RKPD') + '</th>' +
            '<th rowspan="2" class="th-green" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">Nilai Keselarasan<br><small style="font-size:11px;">(0% / 50% / 100%)</small></th>' +
            '<th rowspan="2" class="th-amber" style="width: 240px; min-width: 240px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 13.5px; padding: 12px 10px; background:#dcfce7; color:#15803d; border: 2px solid #86efac;">Nilai Keselarasan per Bidang</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 85px; min-width: 85px; font-size: 12.5px; padding: 8px 6px;">Target</th>' +
            '<th class="th-blue" style="width: 85px; min-width: 85px; font-size: 12.5px; padding: 8px 6px;">Satuan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!spmData || spmData.length === 0){
      return html + '<tr><td colspan="7" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data SPM pada dokumen perencanaan terkait. Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr></tbody></table></div>';
    }

    spmData.forEach(function(bid, bidIdx){
      var indList = (bid.ind_list && bid.ind_list.length > 0) ? bid.ind_list : [{ no: 1, name: 'Indikator...', target: '-', unit: 'Persen', score: 0.50 }];
      var indCount = indList.length;

      indList.forEach(function(ind, indIdx){
        html += 
          '<tr class="ws-spm-row" data-bid-idx="' + bidIdx + '" data-ind-idx="' + indIdx + '" data-bid-title="' + escapeHtml(bid.bidang_daerah || bid.bidang_nasional || '') + '" data-bid-nasional="' + escapeHtml(bid.bidang_nasional || '') + '">';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; font-weight: 700; color: #166534; background: #f0fdf4; font-size: 13.5px; padding: 12px 10px; line-height: 1.55;">' +
              escapeHtml(bid.bidang_nasional || '') +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; font-weight: 700; color: #1e3a8a; background: #f0f7ff; font-size: 13.5px; padding: 12px 10px; line-height: 1.55;">' +
              escapeHtml(bid.bidang_daerah || '') +
            '</td>';
        }

        html += 
          '<td style="vertical-align: middle; padding: 10px 12px; font-size: 13px; line-height: 1.55; color: #1e293b;">' +
            '<span class="ind-name-text" style="font-weight: 500;">' + escapeHtml(ind.name || '') + '</span>' +
          '</td>';

        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<input type="text" class="calc-inp ind-target-inp" value="' + escapeHtml(ind.target || '-') + '" style="text-align: center; font-weight: 700; font-size: 13px; height: 38px; padding: 6px 8px; border-radius: 6px;">' +
          '</td>';

        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<input type="text" class="calc-inp ind-unit-inp" value="' + escapeHtml(ind.unit || 'Persen') + '" style="text-align: center; font-size: 13px; font-weight: 600; height: 38px; padding: 6px 8px; border-radius: 6px;">' +
          '</td>';

        var curScore = (ind.score !== null && ind.score !== undefined) ? parseFloat(ind.score) : 0.50;
        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<select class="calc-inp ind-score-sel" style="text-align: center; font-weight: 700; font-size: 13px; height: 38px; padding: 6px 8px; border-radius: 6px; background: #ffffff; cursor: pointer;">' +
              '<option value="1.00"' + (curScore === 1.0 ? ' selected' : '') + '>100% (Selaras)</option>' +
              '<option value="0.50"' + (curScore === 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
              '<option value="0.00"' + (curScore === 0.0 ? ' selected' : '') + '>0% (Tidak)</option>' +
            '</select>' +
          '</td>';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; padding: 10px 8px;">' +
              '<textarea class="calc-inp ind-ket-inp" rows="6" style="resize: vertical; font-size: 12.5px; line-height: 1.5; padding: 8px 10px; border-radius: 6px; min-height: 110px;">' + escapeHtml(bid.keterangan || 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait') + '</textarea>' +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: middle; text-align: center; padding: 10px 8px; background: #f0fdf4;">' +
              '<span class="bid-avg badge-verif-pill" data-bid-idx="' + bidIdx + '" style="font-size: 14px; font-weight: 800; padding: 8px 14px; border-radius: 6px; font-family: \'Roboto Mono\', monospace; background: #dcfce7; color: #15803d; border: 1.5px solid #86efac;">100%</span>' +
            '</td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
}

  // 9. Sheet 1.b.8.a (TPT) & 1.b.8.b (TK) (RKP vs RKPD)
      // 9.a Sheet 1.b.10.a (Tingkat Pengangguran Terbuka TPT RKP vs RKPD) - Tampilan Ringkas sampai Nilai Keselarasan
  function renderWs_1_b_10_a(d, maxBobot){
    d = d || {};
    var mn_real = d.mn_real !== undefined ? d.mn_real : (AUTO_DATA_1_B_10_A.mn_real || '');
    var mn_tgt  = d.mn_target !== undefined ? d.mn_target : (AUTO_DATA_1_B_10_A.mn_target || '');
    var md_real = d.md_real !== undefined ? d.md_real : (AUTO_DATA_1_B_10_A.md_real || '');
    var md_tgt  = d.md_target !== undefined ? d.md_target : (AUTO_DATA_1_B_10_A.md_target || '');

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_1_b_10_a" style="min-width: 1650px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th colspan="5" class="th-blue" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #e0f2fe; color: #0369a1; text-align: center; border-right: 2px solid #0284c7;">RKP</th>' +
            '<th colspan="5" class="th-amber" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #fef3c7; color: #92400e; text-align: center; border-right: 2px solid #d97706;">RKPD</th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #f4cccc; color: #000000; text-align: center; padding: 8px;">Cek Target Realisasi 2023<br><i>(Margin Hitung)</i></th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #f4cccc; color: #000000; text-align: center; padding: 8px;">Cek Target Realisasi 2023<br><i>(Keterangan)</i></th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #f4cccc; color: #000000; text-align: center; padding: 8px;">Nilai Keselarasan Target Realisasi 2023</th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Cek Target Tahun 2024<br><i>(Margin Hitung)</i></th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Cek Target Tahun 2024<br><i>(Keterangan)</i></th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Nilai Keselarasan Target Tahun 2024</th>' +
            '<th rowspan="3" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Cek <i>Gap</i> Target 2023 dan 2024<br><i>(Margin Hitung)</i></th>' +
            '<th rowspan="3" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;"><i>Cek</i> Gap Target 2023 dan 2024<br><i>(Keterangan)</i></th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Nilai Keselarasan <i>Gap</i> Target</th>' +
            '<th rowspan="3" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 13px; font-weight: 800; background: #dcfce7; color: #15803d; text-align: center; padding: 8px; border: 2px solid #86efac;">Nilai Keselarasan Rata-rata</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width: 220px; min-width: 220px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-blue" style="width: 80px; min-width: 80px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #0284c7;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width: 220px; min-width: 220px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-amber" style="width: 80px; min-width: 80px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #d97706;">Satuan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-blue" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-blue" style="width: 85px; min-width: 85px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
            '<th class="th-amber" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-amber" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-amber" style="width: 85px; min-width: 85px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-1b10a-row">' +
            '<td style="vertical-align: middle; font-weight: 700; color: #0369a1; background: #f0f9ff; padding: 12px 10px;">Tingkat Pengangguran Terbuka (TPT)</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkp-real" value="' + escapeHtml(mn_real) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #f8fafc;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkp-tgt" value="' + escapeHtml(mn_tgt) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #f8fafc;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px; background: #f1f5f9;">' +
              '<span class="cell-formula rkp-gap" style="font-weight: 800; font-size: 13.5px; color: #1e293b;">-0.47</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 600; color: #475569; border-right: 2px solid #0284c7;">Persen</td>' +
            '<td style="vertical-align: middle; font-weight: 700; color: #92400e; background: #fffbeb; padding: 12px 10px;">Tingkat Pengangguran Terbuka (TPT)</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkpd-real" value="' + escapeHtml(md_real) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #ffffff;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkpd-tgt" value="' + escapeHtml(md_tgt) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #ffffff;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px; background: #f1f5f9;">' +
              '<span class="cell-formula rkpd-gap" style="font-weight: 800; font-size: 13.5px; color: #1e293b;">-0.26</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 600; color: #475569; border-right: 2px solid #d97706;">Persen</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #fff5f5;">' +
              '<span class="margin-real-calc" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #fff5f5;">' +
              '<span class="margin-real-ket" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #fff5f5;">' +
              '<span class="badge-verif-pill score-real-val" style="font-weight: 800; font-size: 13px; padding: 6px 10px; background: #fee2e2; color: #991b1b; border-radius: 6px;">100.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-tgt-calc" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-tgt-ket" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="badge-verif-pill score-tgt-val" style="font-weight: 800; font-size: 13px; padding: 6px 10px; background: #e0f2fe; color: #0369a1; border-radius: 6px;">100.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-gap-calc" style="font-weight: 700; font-size: 13px; color: #334155;">-44.68%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-gap-ket" style="font-weight: 700; font-size: 13px; color: #334155;">44.68%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="badge-verif-pill score-gap-val" style="font-weight: 800; font-size: 13px; padding: 6px 10px; background: #fef3c7; color: #92400e; border-radius: 6px;">55.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #f0fdf4;">' +
              '<span class="badge-verif-pill avg-score-val" style="font-weight: 900; font-size: 14.5px; padding: 8px 14px; background: #dcfce7; color: #15803d; border-radius: 6px; border: 1.5px solid #86efac;">85.00%</span>' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '<div style="margin-top: 10px; padding: 10px 14px; background: #fff1f2; border: 1px solid #fecdd3; border-left: 4px solid #f43f5e; border-radius: 6px; color: #9f1239; font-size: 12.5px; font-weight: 600; font-style: italic;">' +
        '<i class="fa fa-info-circle"></i> Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap' +
      '</div>' +
      '</div>';

    return html;
  }

      // 9.b Sheet 1.b.10.b (Tingkat Kemiskinan RKP vs RKPD) - Tampilan Ringkas sampai Nilai Keselarasan
  function renderWs_1_b_10_b(d, maxBobot){
    d = d || {};
    var mn_real = d.mn_real !== undefined ? d.mn_real : (AUTO_DATA_1_B_10_B.mn_real || '');
    var mn_tgt  = d.mn_target !== undefined ? d.mn_target : (AUTO_DATA_1_B_10_B.mn_target || '');
    var md_real = d.md_real !== undefined ? d.md_real : (AUTO_DATA_1_B_10_B.md_real || '');
    var md_tgt  = d.md_target !== undefined ? d.md_target : (AUTO_DATA_1_B_10_B.md_target || '');

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_1_b_10_b" style="min-width: 1650px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th colspan="5" class="th-blue" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #e0f2fe; color: #0369a1; text-align: center; border-right: 2px solid #0284c7;">RKP</th>' +
            '<th colspan="5" class="th-amber" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #fef3c7; color: #92400e; text-align: center; border-right: 2px solid #d97706;">RKPD</th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #f4cccc; color: #000000; text-align: center; padding: 8px;">Cek Target Realisasi 2023<br><i>(Margin Hitung)</i></th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #f4cccc; color: #000000; text-align: center; padding: 8px;">Cek Target Realisasi 2023<br><i>(Keterangan)</i></th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #f4cccc; color: #000000; text-align: center; padding: 8px;">Nilai Keselarasan Target Realisasi 2023</th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Cek Target Tahun 2024<br><i>(Margin Hitung)</i></th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Cek Target Tahun 2024<br><i>(Keterangan)</i></th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Nilai Keselarasan Target Tahun 2024</th>' +
            '<th rowspan="3" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Cek <i>Gap</i> Target 2023 dan 2024<br><i>(Margin Hitung)</i></th>' +
            '<th rowspan="3" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;"><i>Cek</i> Gap Target 2023 dan 2024<br><i>(Keterangan)</i></th>' +
            '<th rowspan="3" style="width: 125px; min-width: 125px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Nilai Keselarasan <i>Gap</i> Target</th>' +
            '<th rowspan="3" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 13px; font-weight: 800; background: #dcfce7; color: #15803d; text-align: center; padding: 8px; border: 2px solid #86efac;">Nilai Keselarasan Rata-rata</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width: 220px; min-width: 220px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-blue" style="width: 80px; min-width: 80px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #0284c7;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width: 220px; min-width: 220px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-amber" style="width: 80px; min-width: 80px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #d97706;">Satuan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-blue" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-blue" style="width: 85px; min-width: 85px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
            '<th class="th-amber" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-amber" style="width: 95px; min-width: 95px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-amber" style="width: 85px; min-width: 85px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-1b10b-row">' +
            '<td style="vertical-align: middle; font-weight: 700; color: #0369a1; background: #f0f9ff; padding: 12px 10px;">Tingkat Kemiskinan (%)</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkp-real" value="' + escapeHtml(mn_real) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #f8fafc;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkp-tgt" value="' + escapeHtml(mn_tgt) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #f8fafc;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px; background: #f1f5f9;">' +
              '<span class="cell-formula rkp-gap" style="font-weight: 800; font-size: 13.5px; color: #1e293b;">-1.07</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 600; color: #475569; border-right: 2px solid #0284c7;">Persen</td>' +
            '<td style="vertical-align: middle; font-weight: 700; color: #92400e; background: #fffbeb; padding: 12px 10px;">Tingkat Kemiskinan (%)</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkpd-real" value="' + escapeHtml(md_real) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #ffffff;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px;">' +
              '<input type="text" class="calc-inp rkpd-tgt" value="' + escapeHtml(md_tgt) + '" style="text-align: center; font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; background: #ffffff;">' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; padding: 8px 6px; background: #f1f5f9;">' +
              '<span class="cell-formula rkpd-gap" style="font-weight: 800; font-size: 13.5px; color: #1e293b;">-0.95</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 600; color: #475569; border-right: 2px solid #d97706;">Persen</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #fff5f5;">' +
              '<span class="margin-real-calc" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #fff5f5;">' +
              '<span class="margin-real-ket" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #fff5f5;">' +
              '<span class="badge-verif-pill score-real-val" style="font-weight: 800; font-size: 13px; padding: 6px 10px; background: #fee2e2; color: #991b1b; border-radius: 6px;">100.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-tgt-calc" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-tgt-ket" style="font-weight: 700; font-size: 13px; color: #334155;">0.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="badge-verif-pill score-tgt-val" style="font-weight: 800; font-size: 13px; padding: 6px 10px; background: #e0f2fe; color: #0369a1; border-radius: 6px;">100.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-gap-calc" style="font-weight: 700; font-size: 13px; color: #334155;">-11.21%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="margin-gap-ket" style="font-weight: 700; font-size: 13px; color: #334155;">11.21%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center;">' +
              '<span class="badge-verif-pill score-gap-val" style="font-weight: 800; font-size: 13px; padding: 6px 10px; background: #fef3c7; color: #92400e; border-radius: 6px;">90.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #f0fdf4;">' +
              '<span class="badge-verif-pill avg-score-val" style="font-weight: 900; font-size: 14.5px; padding: 8px 14px; background: #dcfce7; color: #15803d; border-radius: 6px; border: 1.5px solid #86efac;">96.67%</span>' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '<div style="margin-top: 10px; padding: 10px 14px; background: #fff1f2; border: 1px solid #fecdd3; border-left: 4px solid #f43f5e; border-radius: 6px; color: #9f1239; font-size: 12.5px; font-weight: 600; font-style: italic;">' +
        '<i class="fa fa-info-circle"></i> Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap' +
      '</div>' +
      '</div>';

    return html;
  }

  function renderWs_1_b_8(code, d, maxBobot){
    d = d || {};
    var isTpt = (code === '1.b.8.a');
    var indName = isTpt ? 'Tingkat Pengangguran Terbuka (TPT)' : 'Tingkat Kemiskinan (TK)';
    var rkp_real = d.rkp_real !== undefined ? d.rkp_real : (isTpt ? '5.32' : '9.36');
    var rkp_tgt  = d.rkp_tgt  !== undefined ? d.rkp_tgt  : (isTpt ? '5.00' : '7.50');
    var rkpd_real= d.rkpd_real!== undefined ? d.rkpd_real: (isTpt ? '7.50' : '11.20');
    var rkpd_tgt = d.rkpd_tgt !== undefined ? d.rkpd_tgt : (isTpt ? '6.80' : '9.80');

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Indikator Makro RKPD vs RKP (' + (isTpt ? 'TPT' : 'TK') + ')</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_b_8" style="min-width: 950px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="3" style="width:45px; text-align:center;">No</th>' +
            '<th colspan="5" class="th-blue" style="font-size:13px;">RKP (Nasional)</th>' +
            '<th colspan="5" class="th-amber" style="font-size:13px;">RKPD (Daerah)</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width:220px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue">Nilai RKP</th>' +
            '<th rowspan="2" class="th-blue" style="width:70px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width:220px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber">Nilai RKPD</th>' +
            '<th rowspan="2" class="th-amber" style="width:70px; white-space:nowrap;">Satuan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width:70px;">Realisasi</th><th class="th-blue" style="width:70px;">Target</th><th class="th-blue" style="width:65px;">Gap</th>' +
            '<th class="th-amber" style="width:70px;">Realisasi</th><th class="th-amber" style="width:70px;">Target</th><th class="th-amber" style="width:65px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-1b8-row" data-positive="0">' +
            '<td class="excel-row-num">1</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="text" class="calc-inp rkp-real" value="' + escapeHtml(rkp_real) + '" style="text-align:center; font-weight:600;"></td>' +
            '<td><input type="text" class="calc-inp rkp-tgt" value="' + escapeHtml(rkp_tgt) + '" style="text-align:center; font-weight:600;"></td>' +
            '<td class="cell-formula rkp-gap" style="text-align:center;">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="text" class="calc-inp rkpd-real" value="' + escapeHtml(rkpd_real) + '" style="text-align:center; font-weight:600;"></td>' +
            '<td><input type="text" class="calc-inp rkpd-tgt" value="' + escapeHtml(rkpd_tgt) + '" style="text-align:center; font-weight:600;"></td>' +
            '<td class="cell-formula rkpd-gap" style="text-align:center;">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

      // 10. Sheet 1.c.1 (Alokasi APBD untuk Prioritas Nasional / Major Project) - Tampilan Ringkas sampai Nilai Keselarasan
  function renderWs_1_c_1(d, maxBobot){
    d = d || {};
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : (AUTO_DATA_1_C_1 && AUTO_DATA_1_C_1.length > 0 ? AUTO_DATA_1_C_1 : []);
    
    var html = 
      '<div style="overflow-x:auto; padding: 4px 0 12px 0;">' +
      '<table class="excel-grid-table" id="wsTable_1_c_1" style="min-width: 1350px; border-collapse: collapse; font-family: \'Inter\', -apple-system, BlinkMacSystemFont, sans-serif; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 45px; text-align:center; vertical-align: middle; background:#f1f5f9; border:1px solid #94a3b8; font-weight:700;">No</th>' +
            '<th class="th-blue" colspan="2" style="text-align:center; vertical-align: middle; font-weight:700; background: #e0f2fe; color: #0369a1; border: 1px solid #94a3b8; padding: 9px 8px; font-size: 13.5px;">RKP</th>' +
            '<th class="th-amber" colspan="2" style="text-align:center; vertical-align: middle; font-weight:700; background: #fef3c7; color: #b45309; border: 1px solid #94a3b8; padding: 9px 8px; font-size: 13.5px;">RKPD</th>' +
            '<th class="th-green" rowspan="2" style="width: 140px; text-align:center; vertical-align: middle; font-weight:700; background: #dcfce7; color: #15803d; border: 1px solid #94a3b8; padding: 8px;">Nilai Keselarasan<br><span style="font-size:11px; font-weight:500;">(0% / 100%)</span></th>' +
            '<th class="th-gray" rowspan="2" style="width: 320px; text-align:center; vertical-align: middle; font-weight:700; background: #f1f5f9; color: #334155; border: 1px solid #94a3b8; padding: 8px;">Keterangan</th>' +
            '<th class="th-green" rowspan="2" style="width: 130px; text-align:center; vertical-align: middle; font-weight:700; background: #dcfce7; color: #15803d; border: 1px solid #94a3b8; padding: 8px;">Nilai Keselarasan</th>' +
            '<th class="th-gray" rowspan="2" style="width: 50px; text-align:center; vertical-align: middle; font-weight:700; background: #f1f5f9; color: #334155; border: 1px solid #94a3b8; padding: 8px;">Aksi</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 230px; text-align:center; vertical-align: middle; font-weight:700; background: #f0f9ff; color: #0369a1; border: 1px solid #94a3b8; padding: 8px;">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-blue" style="width: 270px; text-align:center; vertical-align: middle; font-weight:700; background: #f0f9ff; color: #0369a1; border: 1px solid #94a3b8; padding: 8px;">Kegiatan Prioritas Utama (KPU)</th>' +
            '<th class="th-amber" style="width: 340px; text-align:center; vertical-align: middle; font-weight:700; background: #fffbeb; color: #b45309; border: 1px solid #94a3b8; padding: 8px;">Dukungan Program Pembangunan Daerah</th>' +
            '<th class="th-amber" style="width: 190px; text-align:center; vertical-align: middle; font-weight:700; background: #fffbeb; color: #b45309; border: 1px solid #94a3b8; padding: 8px;">Pagu Indikatif APBD (Rp.)</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!pnList || pnList.length === 0){
      return html + '<tr><td colspan="9" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data Alokasi APBD untuk Prioritas Nasional / Major Project pada menu terkait (dukungan KPU APBD). Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr></tbody></table></div>';
    }

    var globalRowNumber = 1;

    pnList.forEach(function(pn, pnIdx){
      var pnRowspan = 0;
      if (pn.kpu_list){
        pn.kpu_list.forEach(function(k){
          var subLen = (k.subs && k.subs.length > 0) ? k.subs.length : 1;
          pnRowspan += subLen;
        });
      }
      if (pnRowspan === 0) pnRowspan = 1;

      var isFirstPnRow = true;

      if (pn.kpu_list && pn.kpu_list.length > 0){
        pn.kpu_list.forEach(function(kpu, kpuIdx){
          var subList = (kpu.subs && kpu.subs.length > 0) ? kpu.subs : [{ sub_kegiatan: '', pagu: '', score: 1.0 }];
          var kpuRowspan = subList.length;
          var isFirstKpuRow = true;

          subList.forEach(function(sub, subIdx){
            html += 
              '<tr class="ws-1c1-sub-row" data-pn-idx="' + pnIdx + '" data-kpu-idx="' + kpuIdx + '" data-sub-idx="' + subIdx + '" style="background:#ffffff; border-bottom:1px solid #e2e8f0;">';

            // No Baris
            html += '<td class="excel-row-num" style="text-align:center; vertical-align:middle; background:#f8fafc; font-weight:600; border:1px solid #cbd5e1;">' + (globalRowNumber++) + '</td>';

            // Col A: Prioritas Pembangunan Nasional (Rowspan per PN)
            if (isFirstPnRow){
              html += 
                '<td rowspan="' + pnRowspan + '" style="vertical-align: top; padding: 12px 10px; font-weight: 700; color: #1e3a8a; background: #f8fafc; border: 1px solid #cbd5e1; line-height: 1.45;">' +
                  escapeHtml(pn.pn_nama || ('Prioritas Nasional ' + (pnIdx + 1))) +
                '</td>';
              isFirstPnRow = false;
            }

            // Col B: Kegiatan Prioritas Utama (KPU) (Rowspan per KPU)
            if (isFirstKpuRow){
              html += 
                '<td rowspan="' + kpuRowspan + '" style="vertical-align: top; padding: 12px 10px; font-weight: 600; color: #0f172a; background: #ffffff; border: 1px solid #cbd5e1; line-height: 1.45;">' +
                  escapeHtml(kpu.kpu_nama || '-') +
                '</td>';
            }

            // Col C: Dukungan Program Pembangunan Daerah (Per Subkegiatan)
            html += 
              '<td style="vertical-align: middle; padding: 6px 8px; border: 1px solid #cbd5e1;">' +
                '<input type="text" class="calc-inp ws-1c1-sub-inp" value="' + escapeHtml(sub.sub_kegiatan || '') + '" placeholder="Kode & Nama Sub Kegiatan..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px 8px; font-size: 12.5px; line-height: 1.4;">' +
              '</td>';

            // Col D: Pagu Indikatif APBD (Rp.) (Per Subkegiatan)
            html += 
              '<td style="vertical-align: middle; padding: 6px 8px; border: 1px solid #cbd5e1;">' +
                '<input type="text" class="calc-inp ws-1c1-pagu-inp" value="' + escapeHtml(sub.pagu || '') + '" placeholder="0,00" style="width: 100%; text-align: right; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px 8px; font-size: 12.5px; font-weight: 600; color: #0f172a;">' +
              '</td>';

            // Col E: Nilai Keselarasan (0% / 100%) (Per Subkegiatan)
            var subScore = (sub.score !== undefined && sub.score !== null) ? parseFloat(sub.score) : 1.0;
            html += 
              '<td style="vertical-align: middle; text-align: center; padding: 6px 8px; border: 1px solid #cbd5e1;">' +
                '<select class="calc-inp ws-1c1-score-sel" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px 4px; font-size: 12px; font-weight: 600; text-align: center; background: #f0fdf4; color: #166534; cursor: pointer;">' +
                  '<option value="1.0"' + (subScore === 1.0 ? ' selected' : '') + '>100.00%</option>' +
                  '<option value="0.0"' + (subScore === 0.0 ? ' selected' : '') + '>0.00%</option>' +
                '</select>' +
              '</td>';

            // Kolom Rowspan per KPU (Col F & Col G)
            if (isFirstKpuRow){
              // Col F: Keterangan
              var defaultKet = "Terdapat Dukungan APBD pada Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional / Major Project terkait";
              html += 
                '<td rowspan="' + kpuRowspan + '" style="vertical-align: middle; padding: 10px; font-size: 12px; line-height: 1.45; color: #334155; border: 1px solid #cbd5e1; background: #ffffff;">' +
                  escapeHtml(kpu.keterangan || defaultKet) +
                '</td>';

              // Col G: Nilai Keselarasan (100%)
              html += 
                '<td rowspan="' + kpuRowspan + '" style="vertical-align: middle; text-align: center; padding: 8px; border: 1px solid #cbd5e1; background: #ffffff;">' +
                  '<div style="font-weight: 800; color: #15803d; background: #dcfce7; padding: 6px 8px; border-radius: 6px; font-size: 13px; border: 1px solid #86efac;">100%</div>' +
                '</td>';

              isFirstKpuRow = false;
            }

            // Tombol Aksi per Subkegiatan
            html += 
              '<td style="text-align:center; vertical-align:middle; border:1px solid #cbd5e1; padding:4px;">' +
                '<button type="button" class="btn-del-1c1-sub" style="border:none; background:transparent; color:#ef4444; cursor:pointer; font-size:14px;" title="Hapus Sub Kegiatan"><i class="fa fa-trash"></i></button>' +
              '</td>';

            html += '</tr>';
          });
        });
      }
    });

    html += 
        '</tbody>' +
      '</table>' +
      
      '<div style="margin-top: 16px; padding: 14px 18px; background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">' +
        '<div style="font-size: 13.5px; font-weight: 600; color: #334155; display: flex; align-items: center; gap: 8px;">' +
          '<i class="fa fa-info-circle" style="color: #0284c7; font-size: 16px;"></i>' +
          '<span>Dukungan Sub Kegiatan & Pagu APBD ditarik dinamis dari dokumen RKPD daerah.</span>' +
        '</div>' +
        '<div>' +
          '<button type="button" class="btn btn-sm btn-primary" id="btnAdd1c1SubRow" style="border-radius: 6px; font-weight: 600; font-size: 12.5px; padding: 6px 14px;"><i class="fa fa-plus"></i> Tambah Sub Kegiatan</button>' +
        '</div>' +
      '</div>' +
      '</div>';

    return html;
  }

  // 11. Sheet 3.a.1.a (OPD Penanggungjawab Program Prioritas Daerah)
  function renderWs_3_a_1_a(d, maxBobot){
    d = d || {};
    var rows = d.rows || [
      { bidang: '1. Bidang Pekerjaan Umum dan Penataan Ruang', prog: 'Program Penyelenggaraan Jalan dan Jembatan', opd: 'Dinas Pekerjaan Umum dan Tata Ruang' },
      { bidang: '2. Bidang Pendidikan', prog: 'Program Pengelolaan Pendidikan Dasar', opd: 'Dinas Pendidikan' },
      { bidang: '3. Bidang Kesehatan', prog: 'Program Pemenuhan Upaya Kesehatan Masyarakat dan Perorangan', opd: 'Dinas Kesehatan' },
      { bidang: '4. Bidang Sosial', prog: 'Program Perlindungan dan Jaminan Sosial', opd: 'Dinas Sosial' }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_3_a_1_a" style="min-width: 900px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-green" style="width: 25%;">Bidang Program Prioritas</th>' +
            '<th class="th-amber" style="width: 35%;">Program Prioritas Daerah (RKPD)</th>' +
            '<th class="th-blue" style="width: 25%;">OPD Penanggungjawab</th>' +
            '<th class="th-green" style="width: 15%;">Nilai Keselarasan</th>' +
            '<th class="th-gray" style="width: 45px;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-3a1a-row">' +
          '<td class="excel-row-num">' + (idx + 1) + '</td>' +
          '<td><input type="text" class="calc-inp bidang-inp" value="' + escapeHtml(r.bidang) + '" placeholder="Bidang Urusan..."></td>' +
          '<td><input type="text" class="calc-inp prog-inp" value="' + escapeHtml(r.prog) + '" placeholder="Program Prioritas..."></td>' +
          '<td><input type="text" class="calc-inp opd-inp" value="' + escapeHtml(r.opd) + '" placeholder="Nama Perangkat Daerah (jika tidak ada isi -)..."></td>' +
          '<td class="cell-formula row-score" style="text-align:center; font-weight:700; color:#107c41;">100%</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-3a1a-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Baris"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAdd3a1aRow"><i class="fa fa-plus"></i> Tambah Program Prioritas OPD</button>' +
      '</div>';

    return html;
  }

  // 12. Sheet 3.a.1.b (Target dan Sasaran Daerah menjadi IKU OPD Renstra/Renja)
  function renderWs_3_a_1_b(d, maxBobot){
    d = d || {};
    var rows = d.rows || [
      { ind_daerah: 'Tingkat Kemantapan Jalan Kabupaten', target_daerah: '90', unit_daerah: 'Persen', opd: 'Dinas PUTR', iku_opd: 'Persentase Panjang Jalan Kondisi Mantap', target_opd: '90', unit_opd: 'Persen', ekspektasi: 'Besar' },
      { ind_daerah: 'Rata-rata Lama Sekolah (RLS)', target_daerah: '8.8', unit_daerah: 'Tahun', opd: 'Dinas Pendidikan', iku_opd: 'Angka Rata-rata Lama Sekolah', target_opd: '8.8', unit_opd: 'Tahun', ekspektasi: 'Besar' },
      { ind_daerah: 'Prevalensi Stunting', target_daerah: '14', unit_daerah: 'Persen', opd: 'Dinas Kesehatan', iku_opd: 'Persentase Penurunan Prevalensi Stunting', target_opd: '14', unit_opd: 'Persen', ekspektasi: 'Kecil' }
    ];

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Target & Sasaran Daerah vs IKU Renstra/Renja OPD</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_3_a_1_b" style="min-width: 950px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 45px; text-align:center;">No</th>' +
            '<th colspan="3" class="th-amber" style="font-size:13px;">RPJMD / RKPD (Daerah)</th>' +
            '<th colspan="4" class="th-blue" style="font-size:13px;">Renstra / Renja OPD</th>' +
            '<th rowspan="2" class="th-gray" style="width: 110px; white-space:nowrap;">Ekspektasi</th>' +
            '<th rowspan="2" class="th-gray" style="width: 45px;">Aksi</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-amber" style="width: 220px; white-space:nowrap;">Indikator Kinerja</th>' +
            '<th class="th-amber" style="width: 70px; white-space:nowrap;">Target</th>' +
            '<th class="th-amber" style="width: 65px; white-space:nowrap;">Satuan</th>' +
            '<th class="th-blue" style="width: 160px; white-space:nowrap;">Nama OPD</th>' +
            '<th class="th-blue" style="width: 220px; white-space:nowrap;">IKU OPD</th>' +
            '<th class="th-blue" style="width: 70px; white-space:nowrap;">Target</th>' +
            '<th class="th-blue" style="width: 65px; white-space:nowrap;">Satuan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-3a1b-row">' +
          '<td class="excel-row-num">' + (idx + 1) + '</td>' +
          '<td><input type="text" class="calc-inp ind-daerah" value="' + escapeHtml(r.ind_daerah) + '" placeholder="Indikator Daerah..."></td>' +
          '<td><input type="text" class="calc-inp tgt-daerah" value="' + escapeHtml(r.target_daerah) + '" style="text-align:center; font-weight:600;"></td>' +
          '<td><input type="text" class="calc-inp unit-daerah" value="' + escapeHtml(r.unit_daerah) + '"></td>' +
          '<td><input type="text" class="calc-inp opd-name" value="' + escapeHtml(r.opd) + '" placeholder="OPD..."></td>' +
          '<td><input type="text" class="calc-inp iku-opd" value="' + escapeHtml(r.iku_opd) + '" placeholder="IKU OPD..."></td>' +
          '<td><input type="text" class="calc-inp tgt-opd" value="' + escapeHtml(r.target_opd) + '" style="text-align:center; font-weight:600;"></td>' +
          '<td><input type="text" class="calc-inp unit-opd" value="' + escapeHtml(r.unit_opd) + '"></td>' +
          '<td>' +
            '<select class="calc-inp ekspektasi-sel">' +
              '<option value="Besar"' + (r.ekspektasi === 'Besar' ? ' selected' : '') + '>Besar (Makin Besar Baik)</option>' +
              '<option value="Kecil"' + (r.ekspektasi === 'Kecil' ? ' selected' : '') + '>Kecil (Makin Kecil Baik)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-3a1b-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Baris"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAdd3a1bRow"><i class="fa fa-plus"></i> Tambah Sasaran / IKU OPD</button>' +
      '</div>';

    return html;
  }

  // 13. General / Pilar 2 Worksheet Generator (Kualitas Perencanaan & Parameter Lain)
  function renderWs_General(code, d, maxBobot){
    d = d || {};
    var rows = d.rows || [
      { kriteria: 'Pemenuhan Kriteria Dokumen Evaluasi dan Analisis Kausalitas Perencanaan', score: 1.0, catatan: 'Tersedia lengkap dengan metodologi yang valid' },
      { kriteria: 'Konsistensi dan Penyelarasan Target Indikator dengan Kebijakan Strategis', score: 1.0, catatan: 'Tercantum secara eksplisit pada batang tubuh dan matriks' }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_General" style="min-width: 850px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-green" style="width: 48%;">Parameter / Kriteria Pemenuhan Indikator (Pedoman IPPD)</th>' +
            '<th class="th-blue" style="width: 25%;">Tingkat Pemenuhan</th>' +
            '<th class="th-amber" style="width: 25%;">Catatan / Justifikasi</th>' +
            '<th class="th-gray" style="width: 45px;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-gen-row">' +
          '<td class="excel-row-num">' + (idx + 1) + '</td>' +
          '<td><input type="text" class="calc-inp kriteria-inp" value="' + escapeHtml(r.kriteria) + '" placeholder="Kriteria parameter..."></td>' +
          '<td>' +
            '<select class="calc-inp score-sel">' +
              '<option value="1.0"' + (r.score == 1.0 || r.score === undefined ? ' selected' : '') + '>Memenuhi Sepenuhnya (100%)</option>' +
              '<option value="0.75"' + (r.score == 0.75 ? ' selected' : '') + '>Sebagian Besar Memenuhi (75%)</option>' +
              '<option value="0.5"' + (r.score == 0.5 ? ' selected' : '') + '>Sebagian Memenuhi (50%)</option>' +
              '<option value="0.25"' + (r.score == 0.25 ? ' selected' : '') + '>Belum Memadai (25%)</option>' +
              '<option value="0"' + (r.score == 0 ? ' selected' : '') + '>Belum Memenuhi (0%)</option>' +
            '</select>' +
          '</td>' +
          '<td><input type="text" class="calc-inp catatan-inp" value="' + escapeHtml(r.catatan || '') + '" placeholder="Catatan evaluasi..."></td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-gen-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Kriteria"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAddGenRow"><i class="fa fa-plus-circle"></i> Tambah Parameter Kriteria</button>' +
      '</div>';

    return html;
  }

  // Master Dispatcher for Worksheet Rendering
  function renderDynamicWorksheet(code, maxBobot, detailData){
    if (code === '1.a.1.a') return renderWs_1_a_1_a(detailData, maxBobot);
    if (code === '1.a.1.b' || code === '1.a.1.d') return renderWs_TabelPersandingan(code, detailData, maxBobot);
    if (code === '1.a.1.c') return renderWs_1_a_1_c(detailData, maxBobot);
    if (code === '1.a.2.a') return renderWs_1_a_2_a(detailData, maxBobot);
    if (code.indexOf('1.a.2.') === 0) return renderWs_1_a_2_b_to_g(code, detailData, maxBobot);
    if (code === '1.a.3.a' || code === '1.a.3.b') return renderWs_1_a_3(code, detailData, maxBobot);
    if (code === '1.a.4') return renderWs_1_a_4(detailData, maxBobot);
    if (code === '1.a.5' || code === '1.a.6') return renderWs_SPM(code, detailData, maxBobot);
    if (code === '1.b.10.a') return renderWs_1_b_10_a(detailData, maxBobot);
    if (code === '1.b.10.b') return renderWs_1_b_10_b(detailData, maxBobot);
    if (code === '1.b.8.a' || code === '1.b.8.b') return renderWs_1_b_8(code, detailData, maxBobot);
    if (code === '1.c.1') return renderWs_1_c_1(detailData, maxBobot);
    if (code === '3.a.1.a') return renderWs_3_a_1_a(detailData, maxBobot);
    if (code === '3.a.1.b') return renderWs_3_a_1_b(detailData, maxBobot);
    
    return renderWs_General(code, detailData, maxBobot);
  }

  // =========================================================================
  // REACTIVE JAVASCRIPT CALCULATION ENGINE (Executing all Excel formulas)
  // =========================================================================
  function updateModalWorksheetScore(){
    var code = modalItemCode.value;
    var maxBobot = parseFloat(modalBobotMaks.value) || 0;
    var computedFinalScore = maxBobot;

    // 1. Sheet 1.a.1.a Formula Execution
    if (code === '1.a.1.a'){
      var rows = document.querySelectorAll("#wsTable_1_a_1_a .ws-1a1a-row");
      var sumAvg = 0;
      rows.forEach(function(row){
        var isPos = row.getAttribute("data-positive") === '1';
        var mnB = parseFloat(row.querySelector(".mn-base").value) || 0;
        var mnE = parseFloat(row.querySelector(".mn-end").value) || 0;
        var mdB = parseFloat(row.querySelector(".md-base").value) || 0;
        var mdE = parseFloat(row.querySelector(".md-end").value) || 0;

        var mnGap = mnE - mnB;
        var mdGap = mdE - mdB;
        var elMnGap = row.querySelector(".mn-gap"); if (elMnGap) elMnGap.textContent = numFmt(mnGap);
        var elMdGap = row.querySelector(".md-gap"); if (elMdGap) elMdGap.textContent = numFmt(mdGap);

        var marginB = 0;
        if (mnB !== 0){
          marginB = isPos ? (mdB >= mnB ? 0 : (Math.abs(mdB - mnB)/Math.abs(mnB))*100) : (mdB <= mnB ? 0 : (Math.abs(mdB - mnB)/Math.abs(mnB))*100);
        }
        var marginE = 0;
        if (mnE !== 0){
          marginE = isPos ? (mdE >= mnE ? 0 : (Math.abs(mdE - mnE)/Math.abs(mnE))*100) : (mdE <= mnE ? 0 : (Math.abs(mdE - mnE)/Math.abs(mnE))*100);
        }
        var marginGap = 0;
        if (mnGap !== 0){
          marginGap = ((Math.abs(mdGap) - Math.abs(mnGap))/Math.abs(mnGap))*100;
        }

        var scoreB = calcMarginScore(marginB);
        var scoreE = calcMarginScore(marginE);
        var scoreG = calcMarginScore(marginGap);
        var rowAvg = (scoreB + scoreE + scoreG) / 3;
        var rowTerbobot = (rowAvg / 100) * maxBobot;

        var elMarginB = row.querySelector(".margin-base"); if (elMarginB) elMarginB.textContent = marginB.toFixed(1) + "%";
        var elScoreB = row.querySelector(".score-base"); if (elScoreB) elScoreB.textContent = scoreB + "%";
        var elMarginE = row.querySelector(".margin-end"); if (elMarginE) elMarginE.textContent = marginE.toFixed(1) + "%";
        var elScoreE = row.querySelector(".score-end"); if (elScoreE) elScoreE.textContent = scoreE + "%";
        var elMarginG = row.querySelector(".margin-gap"); if (elMarginG) elMarginG.textContent = marginGap.toFixed(1) + "%";
        var elScoreG = row.querySelector(".score-gap"); if (elScoreG) elScoreG.textContent = scoreG + "%";
        var elRowAvg = row.querySelector(".row-avg"); if (elRowAvg) elRowAvg.textContent = rowAvg.toFixed(1) + "%";
        var elRowTerb = row.querySelector(".row-terbobot"); if (elRowTerb) elRowTerb.textContent = numFmt(rowTerbobot);

        sumAvg += rowAvg;
      });

      var grandAvg = rows.length > 0 ? (sumAvg / rows.length) : 100;
      computedFinalScore = (grandAvg / 100) * maxBobot;
      var elGrandAvg = document.getElementById("ws1a1aGrandAvg");
      var elGrandTerbobot = document.getElementById("ws1a1aGrandTerbobot");
      if (elGrandAvg) elGrandAvg.textContent = grandAvg.toFixed(1) + "%";
      if (elGrandTerbobot) elGrandTerbobot.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 2. Sheet 1.a.1.b & 1.a.1.d Persandingan
    else if (code === '1.a.1.b' || code === '1.a.1.d'){
      var sel = document.getElementById("wsSelectPersandingan");
      var isAda = sel ? (sel.value === 'Ada') : true;
      computedFinalScore = isAda ? maxBobot : 0;
      var elRes = document.getElementById("wsPersandinganResult");
      if (elRes) elRes.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 3. Sheet 1.a.1.c Matrix
    else if (code === '1.a.1.c'){
      var pns = document.querySelectorAll("#wsTable_1_a_1_c tbody .cell-pn-wrap");
      var allTerbobotSum = 0;
      var pnCount = 0;

      // Group rows by pn-idx
      var pnGroups = {};
      document.querySelectorAll("#wsTable_1_a_1_c .ws-matrix-row").forEach(function(row){
        var pnIdx = row.getAttribute("data-pn-idx");
        if (!pnGroups[pnIdx]) pnGroups[pnIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        pnGroups[pnIdx].push(scoreSel ? parseFloat(scoreSel.value) : 1.0);
      });

      Object.keys(pnGroups).forEach(function(pnIdx){
        var scores = pnGroups[pnIdx];
        var avg = scores.reduce(function(a,b){return a+b;},0) / scores.length;
        var terbobot = avg * maxBobot;
        allTerbobotSum += terbobot;
        pnCount++;

        var firstRow = document.querySelector('#wsTable_1_a_1_c .ws-matrix-row[data-pn-idx="' + pnIdx + '"]');
        if (firstRow){
          var avgCell = firstRow.querySelector(".pn-avg");
          var terbCell = firstRow.querySelector(".pn-terbobot");
          if (avgCell) avgCell.textContent = (avg * 100).toFixed(1) + "%";
          if (terbCell) terbCell.textContent = numFmt(terbobot);
        }
      });

      computedFinalScore = pnCount > 0 ? (allTerbobotSum / pnCount) : 0;
      var elGrand = document.getElementById("ws1a1cGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 4. Sheet 1.a.2.a
    else if (code === '1.a.2.a'){
      var ppGroups = {};
      document.querySelectorAll("#wsTable_1_a_2_a .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        ppGroups[ppIdx].push(scoreSel ? parseFloat(scoreSel.value) : 1.0);
      });

      var allPpSum = 0;
      var ppCount = 0;
      Object.keys(ppGroups).forEach(function(ppIdx){
        var scores = ppGroups[ppIdx];
        var avg = scores.reduce(function(a,b){return a+b;},0) / scores.length;
        var terbobot = avg * maxBobot;
        allPpSum += terbobot;
        ppCount++;

        var firstRow = document.querySelector('#wsTable_1_a_2_a .ws-pp-row[data-pp-idx="' + ppIdx + '"]');
        if (firstRow){
          var avgCell = firstRow.querySelector(".pp-avg");
          var terbCell = firstRow.querySelector(".pp-terbobot");
          if (avgCell) avgCell.textContent = (avg * 100).toFixed(1) + "%";
          if (terbCell) terbCell.textContent = numFmt(terbobot);
        }
      });

      computedFinalScore = ppCount > 0 ? (allPpSum / ppCount) : maxBobot;
      var elGrand = document.getElementById("ws1a2aGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 5. Sheets 1.a.2.b s.d 1.a.2.g
    else if (code.indexOf('1.a.2.') === 0){
      var ppGroups = {};
      document.querySelectorAll("#wsTable_1_a_2_bg .ws-ppbg-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        ppGroups[ppIdx].push(scoreSel ? parseFloat(scoreSel.value) : 1.0);
      });

      var allPpSum = 0;
      var ppCount = 0;
      Object.keys(ppGroups).forEach(function(ppIdx){
        var scores = ppGroups[ppIdx];
        var avg = scores.reduce(function(a,b){return a+b;},0) / scores.length;
        var terbobot = avg * maxBobot;
        allPpSum += terbobot;
        ppCount++;

        var firstRow = document.querySelector('#wsTable_1_a_2_bg .ws-ppbg-row[data-pp-idx="' + ppIdx + '"]');
        if (firstRow){
          var avgCell = firstRow.querySelector(".pp-avg");
          var terbCell = firstRow.querySelector(".pp-terbobot");
          if (avgCell) avgCell.textContent = (avg * 100).toFixed(1) + "%";
          if (terbCell) terbCell.textContent = numFmt(terbobot);
        }
      });

      computedFinalScore = ppCount > 0 ? (allPpSum / ppCount) : maxBobot;
      var elGrand = document.getElementById("ws1a2bgGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 6. Sheet 1.a.3.a & 1.a.3.b (TPT & TK)
    else if (code === '1.a.3.a' || code === '1.a.3.b'){
      var row = document.querySelector("#wsTable_1_a_3 .ws-1a3-row");
      if (row){
        var mnB = parseFloat(row.querySelector(".mn-base").value) || 0;
        var mnE = parseFloat(row.querySelector(".mn-end").value) || 0;
        var mdB = parseFloat(row.querySelector(".md-base").value) || 0;
        var mdE = parseFloat(row.querySelector(".md-end").value) || 0;

        var mnGap = mnE - mnB;
        var mdGap = mdE - mdB;
        var elMnGap = row.querySelector(".mn-gap"); if (elMnGap) elMnGap.textContent = numFmt(mnGap);
        var elMdGap = row.querySelector(".md-gap"); if (elMdGap) elMdGap.textContent = numFmt(mdGap);

        var marginB = (mnB !== 0) ? (mdB <= mnB ? 0 : (Math.abs(mdB - mnB)/Math.abs(mnB))*100) : 0;
        var marginE = (mnE !== 0) ? (mdE <= mnE ? 0 : (Math.abs(mdE - mnE)/Math.abs(mnE))*100) : 0;
        var marginGap = (mnGap !== 0) ? ((Math.abs(mdGap) - Math.abs(mnGap))/Math.abs(mnGap))*100 : 0;

        var scoreB = calcMarginScore(marginB);
        var scoreE = calcMarginScore(marginE);
        var scoreG = calcMarginScore(marginGap);
        var rowAvg = (scoreB + scoreE + scoreG) / 3;
        computedFinalScore = (rowAvg / 100) * maxBobot;

        var elMarginB = row.querySelector(".margin-base"); if (elMarginB) elMarginB.textContent = marginB.toFixed(1) + "%";
        var elScoreB = row.querySelector(".score-base"); if (elScoreB) elScoreB.textContent = scoreB + "%";
        var elMarginE = row.querySelector(".margin-end"); if (elMarginE) elMarginE.textContent = marginE.toFixed(1) + "%";
        var elScoreE = row.querySelector(".score-end"); if (elScoreE) elScoreE.textContent = scoreE + "%";
        var elMarginG = row.querySelector(".margin-gap"); if (elMarginG) elMarginG.textContent = marginGap.toFixed(1) + "%";
        var elScoreG = row.querySelector(".score-gap"); if (elScoreG) elScoreG.textContent = scoreG + "%";
        var elRowAvg = row.querySelector(".row-avg"); if (elRowAvg) elRowAvg.textContent = rowAvg.toFixed(1) + "%";
        var elRowTerb = row.querySelector(".row-terbobot"); if (elRowTerb) elRowTerb.textContent = numFmt(computedFinalScore);

        if (excelFxContent) excelFxContent.textContent = "";
      }
    }

    // 7. Sheet 1.a.4 (KPU RPJMN vs Dukungan Program Daerah RPJMD) Sesuai Rumus Rata-rata Terbobot KPU
    else if (code === '1.a.4'){
      var kpuGroups = {};
      document.querySelectorAll("#wsTable_1_a_4 .ws-1a4-row").forEach(function(row){
        var kpuIdx = row.getAttribute("data-kpu-idx");
        if (!kpuGroups[kpuIdx]) kpuGroups[kpuIdx] = [];
        var scoreSel = row.querySelector(".kpu-score-sel");
        kpuGroups[kpuIdx].push(scoreSel ? parseFloat(scoreSel.value) : 0.50);
      });

      var allKpuSum = 0;
      var kpuCount = 0;
      Object.keys(kpuGroups).forEach(function(kpuIdx){
        var scores = kpuGroups[kpuIdx];
        var avg = scores.length > 0 ? (scores.reduce(function(a,b){return a+b;},0) / scores.length) : 0.50;
        allKpuSum += avg;
        kpuCount++;

        var avgCell = document.querySelector('#wsTable_1_a_4 .kpu-avg[data-kpu-idx="' + kpuIdx + '"]');
        if (avgCell){
          avgCell.textContent = avg.toFixed(2);
        }
      });

      var grandAvg = kpuCount > 0 ? (allKpuSum / kpuCount) : 0;
      computedFinalScore = grandAvg * maxBobot;

      var elGrand = document.getElementById("ws1a4GrandTerbobot");
      if (elGrand) elGrand.textContent = grandAvg.toFixed(2);

      modalBobotInput.value = computedFinalScore.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      modalCalcDisplay.textContent = numFmt(modalBobotInput.value);
      syncExcelScoreUI(modalBobotInput.value, maxBobot);
      if (excelFxContent) excelFxContent.textContent = "Rata-rata Keselarasan Terbobot KPU = " + grandAvg.toFixed(2) + " x Bobot Maksimal (" + maxBobot + ") = " + numFmt(computedFinalScore);
    }

    // 8. Sheet 1.a.5 & 1.a.6 (SPM)
    else if (code === '1.a.5' || code === '1.a.6'){
      var bidGroups = {};
      document.querySelectorAll("#wsTable_SPM .ws-spm-row").forEach(function(row){
        var bidIdx = row.getAttribute("data-bid-idx");
        if (!bidGroups[bidIdx]) bidGroups[bidIdx] = [];
        var scoreSel = row.querySelector(".ind-score-sel");
        bidGroups[bidIdx].push(scoreSel ? parseFloat(scoreSel.value) : 1.0);
      });

      var allBidSum = 0;
      var bidCount = 0;
      Object.keys(bidGroups).forEach(function(bidIdx){
        var scores = bidGroups[bidIdx];
        var avg = scores.reduce(function(a,b){return a+b;},0) / scores.length;
        allBidSum += avg;
        bidCount++;

        var firstRow = document.querySelector('#wsTable_SPM .ws-spm-row[data-bid-idx="' + bidIdx + '"]');
        if (firstRow){
          var avgCell = firstRow.querySelector(".bid-avg");
          if (avgCell) avgCell.textContent = (avg * 100).toFixed(0) + "%";
        }
      });

      var grandAvg = bidCount > 0 ? (allBidSum / bidCount) : 0;
      computedFinalScore = grandAvg * maxBobot;
      var elGrand = document.getElementById("wsSpmGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 9. Sheet 1.b.10.a & 1.b.10.b (TPT & Kemiskinan RKP vs RKPD Makro)
    else if (code === '1.b.10.a' || code === '1.b.10.b'){
      var tblId = code === '1.b.10.a' ? 'wsTable_1_b_10_a' : 'wsTable_1_b_10_b';
      var row = document.querySelector("#" + tblId + " tbody tr");
      if (row){
        var rkRealVal = row.querySelector(".rkp-real") ? row.querySelector(".rkp-real").value.trim() : "";
        var rkTgtVal  = row.querySelector(".rkp-tgt") ? row.querySelector(".rkp-tgt").value.trim() : "";
        var rdRealVal = row.querySelector(".rkpd-real") ? row.querySelector(".rkpd-real").value.trim() : "";
        var rdTgtVal  = row.querySelector(".rkpd-tgt") ? row.querySelector(".rkpd-tgt").value.trim() : "";

        var hasAnyVal = (rkRealVal !== "" || rkTgtVal !== "" || rdRealVal !== "" || rdTgtVal !== "");
        var rReal = parseFloat(rkRealVal) || 0;
        var rTgt  = parseFloat(rkTgtVal) || 0;
        var dReal = parseFloat(rdRealVal) || 0;
        var dTgt  = parseFloat(rdTgtVal) || 0;

        var rGap = rTgt - rReal;
        var dGap = dTgt - dReal;
        var elRGap = row.querySelector(".rkp-gap"); if (elRGap) elRGap.textContent = hasAnyVal ? rGap.toFixed(2) : "-";
        var elDGap = row.querySelector(".rkpd-gap"); if (elDGap) elDGap.textContent = hasAnyVal ? dGap.toFixed(2) : "-";

        var marginReal = (rReal !== 0) ? ((Math.abs(dReal - rReal)/Math.abs(rReal))*100) : 0;
        var marginTgt  = (rTgt !== 0) ? ((Math.abs(dTgt - rTgt)/Math.abs(rTgt))*100) : 0;
        var marginGap  = (rGap !== 0) ? (((Math.abs(dGap) - Math.abs(rGap))/Math.abs(rGap))*100) : 0;

        var scoreReal = hasAnyVal ? calcMarginScore(marginReal) : 0;
        var scoreTgt  = hasAnyVal ? calcMarginScore(marginTgt) : 0;
        var scoreGap  = hasAnyVal ? calcMarginScore(marginGap) : 0;
        var avgScore  = hasAnyVal ? ((scoreReal + scoreTgt + scoreGap) / 3) : 0;

        var elMarginReal = row.querySelector(".margin-real-calc"); if (elMarginReal) elMarginReal.textContent = marginReal.toFixed(2) + "%";
        var elMarginRealKet = row.querySelector(".margin-real-ket"); if (elMarginRealKet) elMarginRealKet.textContent = marginReal.toFixed(2) + "%";
        var elScoreReal = row.querySelector(".score-real-val"); if (elScoreReal) elScoreReal.textContent = scoreReal.toFixed(2) + "%";

        var elMarginTgt = row.querySelector(".margin-tgt-calc"); if (elMarginTgt) elMarginTgt.textContent = marginTgt.toFixed(2) + "%";
        var elMarginTgtKet = row.querySelector(".margin-tgt-ket"); if (elMarginTgtKet) elMarginTgtKet.textContent = marginTgt.toFixed(2) + "%";
        var elScoreTgt = row.querySelector(".score-tgt-val"); if (elScoreTgt) elScoreTgt.textContent = scoreTgt.toFixed(2) + "%";

        var elMarginGap = row.querySelector(".margin-gap-calc"); if (elMarginGap) elMarginGap.textContent = marginGap.toFixed(2) + "%";
        var elMarginGapKet = row.querySelector(".margin-gap-ket"); if (elMarginGapKet) elMarginGapKet.textContent = Math.abs(marginGap).toFixed(2) + "%";
        var elScoreGap = row.querySelector(".score-gap-val"); if (elScoreGap) elScoreGap.textContent = scoreGap.toFixed(2) + "%";

        var elAvg = row.querySelector(".avg-score-val"); if (elAvg) elAvg.textContent = avgScore.toFixed(2) + "%";

        computedFinalScore = (avgScore / 100) * maxBobot;
        modalBobotInput.value = numFmt(computedFinalScore);
        modalCalcDisplay.textContent = numFmt(computedFinalScore);
        syncExcelScoreUI(modalBobotInput.value, maxBobot);
        if (excelFxContent) excelFxContent.textContent = "Nilai Keselarasan Rata-rata: " + avgScore.toFixed(2) + "% x Bobot (" + maxBobot + ") = " + numFmt(computedFinalScore);
      }
    }

    // 9. Sheet 1.b.8.a & 1.b.8.b (RKP vs RKPD Makro)
    else if (code === '1.b.8.a' || code === '1.b.8.b'){
      var row = document.querySelector("#wsTable_1_b_8 .ws-1b8-row");
      if (row){
        var rReal = parseFloat(row.querySelector(".rkp-real").value) || 0;
        var rTgt  = parseFloat(row.querySelector(".rkp-tgt").value) || 0;
        var dReal = parseFloat(row.querySelector(".rkpd-real").value) || 0;
        var dTgt  = parseFloat(row.querySelector(".rkpd-tgt").value) || 0;

        var rGap = rTgt - rReal;
        var dGap = dTgt - dReal;
        var elRGap = row.querySelector(".rkp-gap"); if (elRGap) elRGap.textContent = numFmt(rGap);
        var elDGap = row.querySelector(".rkpd-gap"); if (elDGap) elDGap.textContent = numFmt(dGap);

        var marginReal = (rReal !== 0) ? (dReal <= rReal ? 0 : (Math.abs(dReal - rReal)/Math.abs(rReal))*100) : 0;
        var marginTgt  = (rTgt !== 0) ? (dTgt <= rTgt ? 0 : (Math.abs(dTgt - rTgt)/Math.abs(rTgt))*100) : 0;
        var marginGap  = (rGap !== 0) ? ((Math.abs(dGap) - Math.abs(rGap))/Math.abs(rGap))*100 : 0;

        var scoreReal = calcMarginScore(marginReal);
        var scoreTgt  = calcMarginScore(marginTgt);
        var scoreGap  = calcMarginScore(marginGap);
        var rowAvg = (scoreReal + scoreTgt + scoreGap) / 3;
        computedFinalScore = (rowAvg / 100) * maxBobot;

        var elMarginReal = row.querySelector(".margin-real"); if (elMarginReal) elMarginReal.textContent = marginReal.toFixed(1) + "%";
        var elScoreReal = row.querySelector(".score-real"); if (elScoreReal) elScoreReal.textContent = scoreReal + "%";
        var elMarginTgt = row.querySelector(".margin-tgt"); if (elMarginTgt) elMarginTgt.textContent = marginTgt.toFixed(1) + "%";
        var elScoreTgt = row.querySelector(".score-tgt"); if (elScoreTgt) elScoreTgt.textContent = scoreTgt + "%";
        var elMarginGap = row.querySelector(".margin-gap"); if (elMarginGap) elMarginGap.textContent = marginGap.toFixed(1) + "%";
        var elScoreGap = row.querySelector(".score-gap"); if (elScoreGap) elScoreGap.textContent = scoreGap + "%";
        var elRowAvg = row.querySelector(".row-avg"); if (elRowAvg) elRowAvg.textContent = rowAvg.toFixed(1) + "%";
        var elRowTerb = row.querySelector(".row-terbobot"); if (elRowTerb) elRowTerb.textContent = numFmt(computedFinalScore);

        if (excelFxContent) excelFxContent.textContent = "";
      }
    }

        // 10. Sheet 1.c.1 (Alokasi APBD untuk Prioritas Nasional / Major Project)
    else if (code === '1.c.1'){
      var subRows = document.querySelectorAll("#wsTable_1_c_1 .ws-1c1-sub-row");
      var sumScore = 0;
      var count = 0;
      subRows.forEach(function(r){
        var sel = r.querySelector(".ws-1c1-score-sel");
        sumScore += sel ? parseFloat(sel.value) : 1.0;
        count++;
      });
      var avgRatio = count > 0 ? (sumScore / count) : 0;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("ws1c1GrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "Bobot: " + numFmt(maxBobot) + " | Keselarasan Terbobot: " + numFmt(computedFinalScore);
    }

    // 11. Sheet 3.a.1.a (OPD Penanggungjawab)
    else if (code === '3.a.1.a'){
      var rows = document.querySelectorAll("#wsTable_3_a_1_a .ws-3a1a-row");
      var sumScore = 0;
      rows.forEach(function(r){
        var opdVal = r.querySelector(".opd-inp").value.trim();
        var isFilled = opdVal !== '' && opdVal !== '-';
        var rowScoreRatio = isFilled ? 1.0 : (opdVal === '-' ? 0.5 : 0.0);
        var elRowScore = r.querySelector(".row-score"); if (elRowScore) elRowScore.textContent = (rowScoreRatio * 100) + "%";
        var elRowTerb = r.querySelector(".row-terbobot"); if (elRowTerb) elRowTerb.textContent = numFmt(rowScoreRatio * maxBobot);
        sumScore += rowScoreRatio;
      });
      var avgRatio = rows.length > 0 ? (sumScore / rows.length) : 1.0;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("ws3a1aGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 12. Sheet 3.a.1.b (Target Daerah vs IKU OPD)
    else if (code === '3.a.1.b'){
      var rows = document.querySelectorAll("#wsTable_3_a_1_b .ws-3a1b-row");
      var sumTerb = 0;
      rows.forEach(function(r){
        var tD = parseFloat(r.querySelector(".tgt-daerah").value) || 0;
        var tO = parseFloat(r.querySelector(".tgt-opd").value) || 0;
        var eks = r.querySelector(".ekspektasi-sel").value;

        var margin = 0;
        if (tD !== 0){
          if (eks === 'Besar'){
            margin = (tO >= tD) ? 0 : ((Math.abs(tD - tO) / Math.abs(tD)) * 100);
          } else {
            margin = (tO <= tD) ? 0 : ((Math.abs(tO - tD) / Math.abs(tD)) * 100);
          }
        }
        var scorePct = calcMarginScore(margin);
        var rowTerb = (scorePct / 100) * maxBobot;

        var elMargin = r.querySelector(".margin-cell"); if (elMargin) elMargin.textContent = margin.toFixed(1) + "%";
        var elKet = r.querySelector(".ket-cell"); if (elKet) elKet.textContent = scorePct + "%";
        var elScore = r.querySelector(".score-cell"); if (elScore) elScore.textContent = scorePct + "%";
        var elRowTerb = r.querySelector(".row-terbobot"); if (elRowTerb) elRowTerb.textContent = numFmt(rowTerb);
        sumTerb += rowTerb;
      });

      computedFinalScore = rows.length > 0 ? (sumTerb / rows.length) : maxBobot;
      var elGrand = document.getElementById("ws3a1bGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // 13. General / Pilar 2 Kualitas Perencanaan
    else {
      var rows = document.querySelectorAll("#wsTable_General .ws-gen-row");
      var sumRatio = 0;
      rows.forEach(function(r){
        var sel = r.querySelector(".score-sel");
        var ratio = sel ? parseFloat(sel.value) : 1.0;
        var elRowTerb = r.querySelector(".row-terbobot"); if (elRowTerb) elRowTerb.textContent = numFmt(ratio * maxBobot);
        sumRatio += ratio;
      });
      var avgRatio = rows.length > 0 ? (sumRatio / rows.length) : 1.0;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("wsGenGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      if (excelFxContent) excelFxContent.textContent = "";
    }

    // Sync computed score to Capaian input and pill display
    var strFinal = computedFinalScore.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
    modalBobotInput.value = strFinal;
    modalCalcDisplay.textContent = numFmt(strFinal);
  }

  // =========================================================================
  // COLLECT DETAIL JSON (Preserving all custom table rows and states)
  // =========================================================================
  function collectDetailJson(code){
    var json = {
      ref_dokumen: modalRefDokumen.value.trim(),
      ref_halaman: modalRefHalaman.value.trim(),
      ref_tabel: modalRefTabel.value.trim()
    };

    // 1. Sheet 1.a.1.a
    if (code === '1.a.1.a'){
      document.querySelectorAll("#wsTable_1_a_1_a .ws-1a1a-row").forEach(function(row){
        var rId = row.getAttribute("data-row-id");
        json[rId + "_mn_base"] = row.querySelector(".mn-base").value.trim();
        json[rId + "_mn_end"]  = row.querySelector(".mn-end").value.trim();
        json[rId + "_md_base"] = row.querySelector(".md-base").value.trim();
        json[rId + "_md_end"]  = row.querySelector(".md-end").value.trim();
      });
    }
    // 2. Persandingan
    else if (code === '1.a.1.b' || code === '1.a.1.d'){
      var sel = document.getElementById("wsSelectPersandingan");
      json.status_tabel = sel ? sel.value : 'Ada';
    }
    // 3. Sheet 1.a.1.c Matrix
    else if (code === '1.a.1.c'){
      var pnList = [];
      var curPn = null;
      var lastPnIdx = null;

      document.querySelectorAll("#wsTable_1_a_1_c .ws-matrix-row").forEach(function(row){
        var pnIdx = row.getAttribute("data-pn-idx");
        var pnInp = row.querySelector(".pn-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");
        var ketInp = row.querySelector(".pd-ket-inp");

        if (pnIdx !== lastPnIdx){
          if (curPn) pnList.push(curPn);
          curPn = {
            pn_title: pnInp ? pnInp.value.trim() : '',
            pds: []
          };
          lastPnIdx = pnIdx;
        }

        if (curPn && pdInp){
          curPn.pds.push({
            title: pdInp.value.trim(),
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0,
            ket: ketInp ? ketInp.value.trim() : ''
          });
        }
      });
      if (curPn) pnList.push(curPn);
      json.pn_list = pnList;
    }
    // 4. Sheet 1.a.2.a
    else if (code === '1.a.2.a'){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;

      document.querySelectorAll("#wsTable_1_a_2_a .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");

        if (ppIdx !== lastPpIdx){
          if (curPp) ppList.push(curPp);
          curPp = {
            pp_title: ppInp ? ppInp.value.trim() : '',
            pds: []
          };
          lastPpIdx = ppIdx;
        }

        if (curPp && pdInp){
          curPp.pds.push({
            title: pdInp.value.trim(),
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;
    }
    // 5. Sheets 1.a.2.b s.d 1.a.2.g
    else if (code.indexOf('1.a.2.') === 0){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;

      document.querySelectorAll("#wsTable_1_a_2_bg .ws-ppbg-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var revInp = row.querySelector(".pd-review-inp");
        var scoreSel = row.querySelector(".pd-score-sel");

        if (ppIdx !== lastPpIdx){
          if (curPp) ppList.push(curPp);
          curPp = {
            pp_title: ppInp ? ppInp.value.trim() : '',
            pds: []
          };
          lastPpIdx = ppIdx;
        }

        if (curPp && pdInp){
          curPp.pds.push({
            title: pdInp.value.trim(),
            ta_review: revInp ? revInp.value.trim() : '',
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;
    }
    // 6. Sheet 1.a.3
    else if (code === '1.a.3.a' || code === '1.a.3.b'){
      var row = document.querySelector("#wsTable_1_a_3 .ws-1a3-row");
      if (row){
        json.mn_base = row.querySelector(".mn-base").value.trim();
        json.mn_end  = row.querySelector(".mn-end").value.trim();
        json.md_base = row.querySelector(".md-base").value.trim();
        json.md_end  = row.querySelector(".md-end").value.trim();
      }
    }
    // 7. Sheet 1.a.4 (KPU RPJMN vs Dukungan Program Daerah RPJMD)
    else if (code === '1.a.4'){
      var kpuList = [];
      var curKpu = null;
      var lastKpuIdx = null;

      document.querySelectorAll("#wsTable_1_a_4 .ws-1a4-row").forEach(function(row){
        var kpuIdx = row.getAttribute("data-kpu-idx");
        var progSpan = row.querySelector(".kpu-prog-title");
        var scoreSel = row.querySelector(".kpu-score-sel");
        var ketInp = row.querySelector(".kpu-ket-inp");
        var dokInp = row.querySelector(".kpu-dok-inp");
        var halInp = row.querySelector(".kpu-hal-inp");
        var tblInp = row.querySelector(".kpu-tbl-inp");
        var catInp = row.querySelector(".kpu-catatan-inp");

        if (kpuIdx !== lastKpuIdx){
          if (curKpu) kpuList.push(curKpu);
          curKpu = {
            kpu_title: row.getAttribute("data-kpu-title") || '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            dokumen: dokInp ? dokInp.value.trim() : '',
            halaman: halInp ? halInp.value.trim() : '',
            tabel: tblInp ? tblInp.value.trim() : '',
            catatan: catInp ? catInp.value.trim() : '',
            pds: []
          };
          lastKpuIdx = kpuIdx;
        }

        var progTitle = progSpan ? progSpan.textContent.trim() : '-';
        if (curKpu){
          curKpu.pds.push({
            title: progTitle,
            score: scoreSel ? parseFloat(scoreSel.value) : 0.50
          });
        }
      });
      if (curKpu) kpuList.push(curKpu);
      json.kpu_list = kpuList;
    }
    // 8. Sheet SPM
    else if (code === '1.a.5' || code === '1.a.6'){
      var spmList = [];
      var curBid = null;
      var lastBidIdx = null;

      document.querySelectorAll("#wsTable_SPM .ws-spm-row").forEach(function(row){
        var bidIdx = row.getAttribute("data-bid-idx");
        var indInp = row.querySelector(".ind-name-inp");
        var tgtInp = row.querySelector(".ind-target-inp");
        var unitInp = row.querySelector(".ind-unit-inp");
        var scoreSel = row.querySelector(".ind-score-sel");

        if (bidIdx !== lastBidIdx){
          if (curBid) spmList.push(curBid);
          curBid = {
            bidang: 'Bidang ' + (parseInt(bidIdx) + 1),
            ind_list: []
          };
          lastBidIdx = bidIdx;
        }

        if (curBid && indInp){
          curBid.ind_list.push({
            name: indInp.value.trim(),
            target: tgtInp ? tgtInp.value.trim() : '100%',
            unit: unitInp ? unitInp.value.trim() : 'Persen',
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0
          });
        }
      });
      if (curBid) spmList.push(curBid);
      json.spm_list = spmList;
    }
    // 9. Sheet 1.b.8
                // 9.a Sheet 1.b.10.a (TPT RKP vs RKPD)
    else if (code === '1.b.10.a'){
      var row = document.querySelector("#wsTable_1_b_10_a .ws-1b10a-row");
      if (row){
        json.mn_real = row.querySelector(".rkp-real") ? row.querySelector(".rkp-real").value.trim() : '';
        json.mn_target = row.querySelector(".rkp-tgt") ? row.querySelector(".rkp-tgt").value.trim() : '';
        json.mn_gap = row.querySelector(".rkp-gap") ? row.querySelector(".rkp-gap").textContent.trim() : '';
        json.md_real = row.querySelector(".rkpd-real") ? row.querySelector(".rkpd-real").value.trim() : '';
        json.md_target = row.querySelector(".rkpd-tgt") ? row.querySelector(".rkpd-tgt").value.trim() : '';
        json.md_gap = row.querySelector(".rkpd-gap") ? row.querySelector(".rkpd-gap").textContent.trim() : '';
        json.margin_real = row.querySelector(".margin-real-calc") ? row.querySelector(".margin-real-calc").textContent.trim() : '';
        json.margin_target = row.querySelector(".margin-tgt-calc") ? row.querySelector(".margin-tgt-calc").textContent.trim() : '';
        json.margin_gap = row.querySelector(".margin-gap-calc") ? row.querySelector(".margin-gap-calc").textContent.trim() : '';
        json.score_real = row.querySelector(".score-real-val") ? row.querySelector(".score-real-val").textContent.trim() : '';
        json.score_target = row.querySelector(".score-tgt-val") ? row.querySelector(".score-tgt-val").textContent.trim() : '';
        json.score_gap = row.querySelector(".score-gap-val") ? row.querySelector(".score-gap-val").textContent.trim() : '';
        json.avg_score = row.querySelector(".avg-score-val") ? row.querySelector(".avg-score-val").textContent.trim() : '';
        json.score_terbobot = row.querySelector(".terb-val") ? row.querySelector(".terb-val").textContent.trim() : '';
        json.dokumen = row.querySelector(".ref-dok-inp") ? row.querySelector(".ref-dok-inp").value.trim() : (modalRefDokumen ? modalRefDokumen.value.trim() : '');
        json.halaman = row.querySelector(".ref-hal-inp") ? row.querySelector(".ref-hal-inp").value.trim() : (modalRefHalaman ? modalRefHalaman.value.trim() : '');
        json.tabel = row.querySelector(".ref-tbl-inp") ? row.querySelector(".ref-tbl-inp").value.trim() : (modalRefTabel ? modalRefTabel.value.trim() : '');
        json.catatan = row.querySelector(".catatan-inp") ? row.querySelector(".catatan-inp").value.trim() : (modalCatatan ? modalCatatan.value.trim() : '');
      }
    }
        // 9.b Sheet 1.b.10.b (Kemiskinan RKP vs RKPD)
    else if (code === '1.b.10.b'){
      var row = document.querySelector("#wsTable_1_b_10_b .ws-1b10b-row");
      if (row){
        json.mn_real = row.querySelector(".rkp-real") ? row.querySelector(".rkp-real").value.trim() : '';
        json.mn_target = row.querySelector(".rkp-tgt") ? row.querySelector(".rkp-tgt").value.trim() : '';
        json.mn_gap = row.querySelector(".rkp-gap") ? row.querySelector(".rkp-gap").textContent.trim() : '';
        json.md_real = row.querySelector(".rkpd-real") ? row.querySelector(".rkpd-real").value.trim() : '';
        json.md_target = row.querySelector(".rkpd-tgt") ? row.querySelector(".rkpd-tgt").value.trim() : '';
        json.md_gap = row.querySelector(".rkpd-gap") ? row.querySelector(".rkpd-gap").textContent.trim() : '';
        json.margin_real = row.querySelector(".margin-real-calc") ? row.querySelector(".margin-real-calc").textContent.trim() : '';
        json.margin_target = row.querySelector(".margin-tgt-calc") ? row.querySelector(".margin-tgt-calc").textContent.trim() : '';
        json.margin_gap = row.querySelector(".margin-gap-calc") ? row.querySelector(".margin-gap-calc").textContent.trim() : '';
        json.score_real = row.querySelector(".score-real-val") ? row.querySelector(".score-real-val").textContent.trim() : '';
        json.score_target = row.querySelector(".score-tgt-val") ? row.querySelector(".score-tgt-val").textContent.trim() : '';
        json.score_gap = row.querySelector(".score-gap-val") ? row.querySelector(".score-gap-val").textContent.trim() : '';
        json.avg_score = row.querySelector(".avg-score-val") ? row.querySelector(".avg-score-val").textContent.trim() : '';
        json.score_terbobot = row.querySelector(".terb-val") ? row.querySelector(".terb-val").textContent.trim() : '';
        json.dokumen = row.querySelector(".ref-dok-inp") ? row.querySelector(".ref-dok-inp").value.trim() : (modalRefDokumen ? modalRefDokumen.value.trim() : '');
        json.halaman = row.querySelector(".ref-hal-inp") ? row.querySelector(".ref-hal-inp").value.trim() : (modalRefHalaman ? modalRefHalaman.value.trim() : '');
        json.tabel = row.querySelector(".ref-tbl-inp") ? row.querySelector(".ref-tbl-inp").value.trim() : (modalRefTabel ? modalRefTabel.value.trim() : '');
        json.catatan = row.querySelector(".catatan-inp") ? row.querySelector(".catatan-inp").value.trim() : (modalCatatan ? modalCatatan.value.trim() : '');
      }
    }
    else if (code === '1.b.8.a' || code === '1.b.8.b'){
      var row = document.querySelector("#wsTable_1_b_8 .ws-1b8-row");
      if (row){
        json.rkp_real = row.querySelector(".rkp-real").value.trim();
        json.rkp_tgt  = row.querySelector(".rkp-tgt").value.trim();
        json.rkpd_real= row.querySelector(".rkpd-real").value.trim();
        json.rkpd_tgt = row.querySelector(".rkpd-tgt").value.trim();
      }
    }
        // 10. Sheet 1.c.1 (Format Komprehensif PN & KPU)
    else if (code === '1.c.1'){
      var pnMap = {};
      document.querySelectorAll("#wsTable_1_c_1 .ws-1c1-sub-row").forEach(function(r){
        var pnIdx = r.getAttribute("data-pn-idx") || "0";
        var kpuIdx = r.getAttribute("data-kpu-idx") || "0";
        var subInp = r.querySelector(".ws-1c1-sub-inp");
        var paguInp = r.querySelector(".ws-1c1-pagu-inp");
        var scoreSel = r.querySelector(".ws-1c1-score-sel");
        var dokInp = r.querySelector(".ws-1c1-dok-inp");
        var halInp = r.querySelector(".ws-1c1-hal-inp");
        var tblInp = r.querySelector(".ws-1c1-tbl-inp");
        var catInp = r.querySelector(".ws-1c1-cat-inp");

        if (!pnMap[pnIdx]) {
          pnMap[pnIdx] = {
            pn_nama: "Prioritas Nasional " + (parseInt(pnIdx) + 1),
            kpu_list: {}
          };
        }
        if (!pnMap[pnIdx].kpu_list[kpuIdx]) {
          pnMap[pnIdx].kpu_list[kpuIdx] = {
            kpu_nama: "",
            keterangan: "Terdapat Dukungan APBD pada Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional / Major Project terkait",
            dokumen: dokInp ? dokInp.value.trim() : "",
            halaman: halInp ? halInp.value.trim() : "",
            tabel: tblInp ? tblInp.value.trim() : "",
            catatan: catInp ? catInp.value.trim() : "",
            subs: []
          };
        }

        if (dokInp && dokInp.value.trim()) pnMap[pnIdx].kpu_list[kpuIdx].dokumen = dokInp.value.trim();
        if (halInp && halInp.value.trim()) pnMap[pnIdx].kpu_list[kpuIdx].halaman = halInp.value.trim();
        if (tblInp && tblInp.value.trim()) pnMap[pnIdx].kpu_list[kpuIdx].tabel = tblInp.value.trim();
        if (catInp && catInp.value.trim()) pnMap[pnIdx].kpu_list[kpuIdx].catatan = catInp.value.trim();

        if (subInp){
          pnMap[pnIdx].kpu_list[kpuIdx].subs.push({
            sub_kegiatan: subInp.value.trim(),
            pagu: paguInp ? paguInp.value.trim() : "",
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0
          });
        }
      });

      var pnList = [];
      Object.keys(pnMap).forEach(function(pKey){
        var pn = pnMap[pKey];
        var kList = [];
        Object.keys(pn.kpu_list).forEach(function(kKey){
          kList.push(pn.kpu_list[kKey]);
        });
        pn.kpu_list = kList;
        pnList.push(pn);
      });
      json.pn_list = pnList;
    }
    // 11. Sheet 3.a.1.a
    else if (code === '3.a.1.a'){
      var rows = [];
      document.querySelectorAll("#wsTable_3_a_1_a .ws-3a1a-row").forEach(function(r){
        var bidInp = r.querySelector(".bidang-inp");
        var progInp = r.querySelector(".prog-inp");
        var opdInp = r.querySelector(".opd-inp");
        if (bidInp || progInp){
          rows.push({
            bidang: bidInp ? bidInp.value.trim() : '',
            prog: progInp ? progInp.value.trim() : '',
            opd: opdInp ? opdInp.value.trim() : ''
          });
        }
      });
      json.rows = rows;
    }
    // 12. Sheet 3.a.1.b
    else if (code === '3.a.1.b'){
      var rows = [];
      document.querySelectorAll("#wsTable_3_a_1_b .ws-3a1b-row").forEach(function(r){
        var indDInp = r.querySelector(".ind-daerah");
        var tgtDInp = r.querySelector(".tgt-daerah");
        var unitDInp = r.querySelector(".unit-daerah");
        var opdInp = r.querySelector(".opd-name");
        var ikuInp = r.querySelector(".iku-opd");
        var tgtOInp = r.querySelector(".tgt-opd");
        var unitOInp = r.querySelector(".unit-opd");
        var eksSel = r.querySelector(".ekspektasi-sel");
        if (indDInp || ikuInp){
          rows.push({
            ind_daerah: indDInp ? indDInp.value.trim() : '',
            target_daerah: tgtDInp ? tgtDInp.value.trim() : '',
            unit_daerah: unitDInp ? unitDInp.value.trim() : 'Persen',
            opd: opdInp ? opdInp.value.trim() : '',
            iku_opd: ikuInp ? ikuInp.value.trim() : '',
            target_opd: tgtOInp ? tgtOInp.value.trim() : '',
            unit_opd: unitOInp ? unitOInp.value.trim() : 'Persen',
            ekspektasi: eksSel ? eksSel.value : 'Besar'
          });
        }
      });
      json.rows = rows;
    }
    // 13. General
    else {
      var rows = [];
      document.querySelectorAll("#wsTable_General .ws-gen-row").forEach(function(r){
        var kritInp = r.querySelector(".kriteria-inp");
        var scoreSel = r.querySelector(".score-sel");
        var catInp = r.querySelector(".catatan-inp");
        if (kritInp){
          rows.push({
            kriteria: kritInp.value.trim(),
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0,
            catatan: catInp ? catInp.value.trim() : ''
          });
        }
      });
      json.rows = rows;
    }

    return json;
  }

  // Open Modal Detail
  function openDetailModal(code){
    var item = itemMap[code];
    if (!item) return;

    var saved = SCORES_MAP[code] || {};
    var detailObj = {};
    if (saved.detail_json){
      try {
        detailObj = typeof saved.detail_json === 'string' ? JSON.parse(saved.detail_json) : saved.detail_json;
      } catch(e) { detailObj = {}; }
    }

    modalItemCode.value = code;
    modalBobotMaks.value = item.bobot;
    modalMaxBadge.textContent = numFmt(item.bobot);
    excelPointBadge.textContent = "POIN " + code;
    excelNameBox.textContent = "POIN " + code;
    excelTabTitle.textContent = "Sheet: " + code;

    var typeLabel = item.type === 'sub' ? 'Sub-Indikator ' + item.letter + ')' : 'Indikator ' + (item.no || '');
    excelFxContent.textContent = typeLabel + " : " + item.title;

    var currentVal = (saved.bobot_capaian !== null && saved.bobot_capaian !== undefined) ? saved.bobot_capaian : item.bobot;
    modalBobotInput.value = currentVal;
    modalBobotInput.max = item.bobot;
    modalCalcDisplay.textContent = numFmt(currentVal);

    modalRefDokumen.value = detailObj.ref_dokumen || "";
    modalRefHalaman.value = detailObj.ref_halaman || "";
    modalRefTabel.value = detailObj.ref_tabel || "";
    modalCatatan.value = saved.catatan || "";
    modalBuktiDukung.value = saved.bukti_dukung || "";
    showPreviewIfImageOrPdf(modalBuktiDukung.value, 'previewBuktiContainer', 'modalBuktiDukung');

    // Render Dynamic Worksheet
    modalDynamicWorksheet.innerHTML = renderDynamicWorksheet(code, item.bobot, detailObj);
    
    // Initial Calculation Trigger
    updateModalWorksheetScore();

    syncExcelScoreUI(modalBobotInput.value, item.bobot);
    updateExcelLinkPreview(saved.bukti_dukung || "");

    modalDetail.classList.add("open");
    document.body.style.overflow = "hidden";
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

    if (bobotNum !== null && (bobotNum < 0 || bobotNum > (maxVal + 0.001))){
      showToast("Nilai bobot capaian melebihi bobot maksimal (" + numFmt(maxVal) + ")", true);
      return;
    }

    var detailData = collectDetailJson(code);

    var payload = {
      tahun: selectTahun.value,
      instansi_id: selectInstansi.value,
      item_code: code,
      bobot_capaian: bobotNum,
      opsi_aksi: bobotNum !== null ? (bobotNum >= maxVal ? 'Memenuhi Sepenuhnya' : (bobotNum > 0 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')) : '',
      catatan: modalCatatan.value.trim(),
      bukti_dukung: modalBuktiDukung.value.trim(),
      detail_json: JSON.stringify(detailData)
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
            bukti_dukung: payload.bukti_dukung,
            detail_json: payload.detail_json
          };
          closeDetailModal();
          showToast("Penilaian lembar kerja poin " + code + " berhasil disimpan.");
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

    document.querySelectorAll(".input-bobot-cell").forEach(function(input){
      var code = input.getAttribute("data-code");
      var maxBobot = Number(input.getAttribute("data-max") || 100);
      var valStr = input.value.trim();
      var valNum = valStr === "" ? null : Number(valStr);

      if (valNum !== null && (valNum < 0 || valNum > maxBobot)){
        valNum = maxBobot;
        input.value = valNum;
      }

      var existingCatatan = SCORES_MAP[code] ? SCORES_MAP[code].catatan : "";
      var existingBukti = SCORES_MAP[code] ? SCORES_MAP[code].bukti_dukung : "";
      var existingDetail = SCORES_MAP[code] ? SCORES_MAP[code].detail_json : null;
      var opsiVal = valNum !== null ? (valNum >= maxBobot ? 'Memenuhi Sepenuhnya' : (valNum > 0 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')) : '';

      SCORES_MAP[code] = {
        bobot_capaian: valNum,
        opsi_aksi: opsiVal,
        catatan: existingCatatan,
        bukti_dukung: existingBukti,
        detail_json: existingDetail
      };

      itemsToSave.push({
        item_code: code,
        bobot_capaian: valNum,
        opsi_aksi: opsiVal,
        catatan: existingCatatan,
        bukti_dukung: existingBukti,
        detail_json: existingDetail
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
          
          if (resp.AutoData_1_a_1_c) AUTO_DATA_1_A_1_C = resp.AutoData_1_a_1_c;
          if (resp.AutoData_1_a_2_a) AUTO_DATA_1_A_2_A = resp.AutoData_1_a_2_a;
          if (resp.AutoData_1_a_2_ALL) AUTO_DATA_1_A_2_ALL = resp.AutoData_1_a_2_ALL;
          if (resp.AutoData_1_a_4) AUTO_DATA_1_A_4 = resp.AutoData_1_a_4;
          if (resp.AutoData_1_a_5) AUTO_DATA_1_A_5 = resp.AutoData_1_a_5;
          if (resp.AutoData_1_a_6) AUTO_DATA_1_A_6 = resp.AutoData_1_a_6;
          if (resp.AutoData_1_b_10_a) AUTO_DATA_1_B_10_A = resp.AutoData_1_b_10_a;
          if (resp.AutoData_1_b_10_b) AUTO_DATA_1_B_10_B = resp.AutoData_1_b_10_b;
        if (resp.AutoData_1_c_1) AUTO_DATA_1_C_1 = resp.AutoData_1_c_1;

          buildItemMap();
          renderTable();
        }
      }
    });
  }

  // Event Listeners for Toolbar and Tree
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
    var detailBtn = e.target.closest(".btn-action-detail");
    if (detailBtn){
      var itemCode = detailBtn.getAttribute("data-code");
      openDetailModal(itemCode);
      return;
    }

    // Open Verifikator Modal
    var verifBtn = e.target.closest(".btn-action-verifikator");
    if (verifBtn){
      var itemCode = verifBtn.getAttribute("data-code");
      openVerifikatorModal(itemCode);
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

  // Excel Preset & UI Sync Helpers
  function updateExcelPresetActive(ratio) {
    document.querySelectorAll(".excel-preset-btn").forEach(function(btn){
      var btnRatio = parseFloat(btn.getAttribute("data-ratio"));
      if (Math.abs(btnRatio - ratio) < 0.02) {
        btn.classList.add("active");
      } else {
        btn.classList.remove("active");
      }
    });
  }

  function syncExcelScoreUI(val, maxVal) {
    var badge = document.getElementById("excelScorePctBadge");
    var numVal = parseFloat(val);
    if (isNaN(numVal) || val === "" || val === null) {
      if (badge) badge.textContent = "0%";
      updateExcelPresetActive(-1);
      return;
    }
    var pct = maxVal > 0 ? (numVal / maxVal) * 100 : 0;
    var ratio = maxVal > 0 ? (numVal / maxVal) : 0;
    if (badge) {
      badge.textContent = Math.min(Math.max(pct, 0), 100).toFixed(0) + "%";
    }
    updateExcelPresetActive(ratio);
  }

  // Quick Preset Buttons in Modal
  document.querySelectorAll(".excel-preset-btn").forEach(function(btn){
    btn.addEventListener("click", function(){
      var ratio = parseFloat(this.getAttribute("data-ratio"));
      var max = parseFloat(modalBobotMaks.value) || 0;
      var calc = max * ratio;
      var strVal = calc.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      modalBobotInput.value = strVal;
      modalCalcDisplay.textContent = numFmt(strVal);
      syncExcelScoreUI(strVal, max);
    });
  });

  modalBobotInput.addEventListener("input", function(){
    var max = parseFloat(modalBobotMaks.value) || 0;
    modalCalcDisplay.textContent = numFmt(modalBobotInput.value);
    syncExcelScoreUI(modalBobotInput.value, max);
  });

  modalBobotInput.addEventListener("focus", function(){
    this.select();
  });

  // Excel quick doc chips
  document.querySelectorAll(".chip-doc").forEach(function(chip){
    chip.addEventListener("click", function(){
      modalRefDokumen.value = this.getAttribute("data-text");
      modalRefDokumen.focus();
    });
  });

  // Excel catatan quick chips
  document.querySelectorAll(".excel-catatan-chip").forEach(function(chip){
    chip.addEventListener("click", function(){
      var textToAdd = this.getAttribute("data-text");
      var cur = modalCatatan.value.trim();
      if (!cur) {
        modalCatatan.value = textToAdd;
      } else if (cur.indexOf(textToAdd) === -1) {
        modalCatatan.value = cur + (cur.endsWith(".") ? " " : ", ") + textToAdd;
      }
      modalCatatan.focus();
    });
  });

  // Excel Bukti Dukung Link Preview
  function updateExcelLinkPreview(val) {
    var btn = document.getElementById("btnPreviewExcelLink");
    if (!btn) return;
    var match = (val || "").match(/https?:\/\/[^\s]+/i);
    if (match) {
      btn.href = match[0];
      btn.style.display = "inline-flex";
    } else {
      btn.style.display = "none";
    }
  }

  modalBuktiDukung.addEventListener("input", function(){
    updateExcelLinkPreview(this.value);
  });

  // Reactive Calculation on input and change events inside modal worksheet
  modalDynamicWorksheet.addEventListener("input", function(e){
    if (e.target.classList.contains("calc-inp") || e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT'){
      updateModalWorksheetScore();
    }
  });

  modalDynamicWorksheet.addEventListener("change", function(e){
    if (e.target.classList.contains("calc-inp") || e.target.tagName === 'SELECT' || e.target.id === 'wsSelectPersandingan'){
      updateModalWorksheetScore();
    }
  });

  // Auto select on focus for all calc inputs & Arrow key navigation
  modalDynamicWorksheet.addEventListener("focusin", function(e){
    if (e.target.classList.contains("calc-inp") && e.target.select){
      e.target.select();
    }
  });

  modalDynamicWorksheet.addEventListener("keydown", function(e){
    if (e.target.classList.contains("calc-inp")){
      if (e.key === "Enter" || e.key === "ArrowDown"){
        var td = e.target.closest("td");
        var tr = e.target.closest("tr");
        if (td && tr && tr.nextElementSibling){
          var colIdx = Array.from(tr.children).indexOf(td);
          var nextTd = tr.nextElementSibling.children[colIdx];
          if (nextTd){
            var nextInp = nextTd.querySelector(".calc-inp");
            if (nextInp){
              e.preventDefault();
              nextInp.focus();
            }
          }
        }
      } else if (e.key === "ArrowUp"){
        var td = e.target.closest("td");
        var tr = e.target.closest("tr");
        if (td && tr && tr.previousElementSibling){
          var colIdx = Array.from(tr.children).indexOf(td);
          var prevTd = tr.previousElementSibling.children[colIdx];
          if (prevTd){
            var prevInp = prevTd.querySelector(".calc-inp");
            if (prevInp){
              e.preventDefault();
              prevInp.focus();
            }
          }
        }
      }
    }
  });

  function renumberExcelSheetRows(table){
    if (!table) return;
    var curNum = 1;
    table.querySelectorAll("tbody tr").forEach(function(tr){
      var cellNum = tr.querySelector(".excel-row-num");
      if (cellNum) cellNum.textContent = curNum++;
    });
    var tfootNum = table.querySelector("tfoot .excel-row-num");
    if (tfootNum) tfootNum.textContent = curNum;
  }

  function syncRowspan2a(){
    var pnCell = document.querySelector("#wsTable_1_a_2_a tbody .cell-pn-wrap-2a");
    if (pnCell){
      var totalRows = document.querySelectorAll("#wsTable_1_a_2_a tbody .ws-pp-row").length;
      pnCell.setAttribute("rowspan", Math.max(1, totalRows));
    }
  }

  function syncRowspanBg(){
    var pnCell = document.querySelector("#wsTable_1_a_2_bg tbody .cell-pn-wrap-bg");
    if (pnCell){
      var totalRows = document.querySelectorAll("#wsTable_1_a_2_bg tbody .ws-ppbg-row").length;
      pnCell.setAttribute("rowspan", Math.max(1, totalRows));
    }
  }

  // Dynamic row additions/removals inside modal worksheet
  modalDynamicWorksheet.addEventListener("click", function(e){
    var target = e.target;

    // --- 1.a.1.c (Matrix PN vs PD) ---
    // Add PD inside PN
    var btnAddPd1c = target.closest(".btn-mini-add-pd");
    if (btnAddPd1c){
      var pnIdx = btnAddPd1c.getAttribute("data-pn-idx");
      var pnRow = document.querySelector('#wsTable_1_a_1_c .ws-matrix-row[data-pn-idx="' + pnIdx + '"]');
      if (pnRow){
        var pnCell = pnRow.querySelector(".cell-pn-wrap");
        var avgCell = pnRow.querySelector(".pn-avg");
        var terbCell = pnRow.querySelector(".pn-terbobot");
        var delCell = pnRow.querySelector(".btn-del-pn") ? pnRow.querySelector(".btn-del-pn").parentElement : null;

        var curRowSpan = parseInt(pnCell.getAttribute("rowspan") || 1) + 1;
        pnCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);

        var newTr = document.createElement("tr");
        newTr.className = "ws-matrix-row";
        newTr.setAttribute("data-pn-idx", pnIdx);
        newTr.setAttribute("data-pd-idx", curRowSpan - 1);
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Prioritas Daerah baru..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">100% (Selaras)</option>' +
              '<option value="0.75">75% (Sebagian Besar)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Tidak Selaras)</option>' +
            '</select>' +
          '</td>' +
          '<td><input type="text" class="pd-ket-inp" placeholder="Keterangan..."></td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-pd" data-pn-idx="' + pnIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';

        var allRowsOfPn = document.querySelectorAll('#wsTable_1_a_1_c .ws-matrix-row[data-pn-idx="' + pnIdx + '"]');
        var lastRow = allRowsOfPn[allRowsOfPn.length - 1];
        lastRow.parentNode.insertBefore(newTr, lastRow.nextSibling);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_1_c"));
      }
      return;
    }

    // Add PN Block
    var btnAddPn1c = target.closest("#btnAddPnBlock");
    if (btnAddPn1c){
      var tbodyMatrix = document.querySelector("#wsTable_1_a_1_c tbody");
      if (tbodyMatrix){
        var newPnIdx = document.querySelectorAll("#wsTable_1_a_1_c .cell-pn-wrap").length;
        var newTr = document.createElement("tr");
        newTr.className = "ws-matrix-row";
        newTr.setAttribute("data-pn-idx", newPnIdx);
        newTr.setAttribute("data-pd-idx", "0");
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td rowspan="1" class="cell-pn-wrap" style="vertical-align:top; background:#f0f7ff;">' +
            '<textarea class="calc-inp pn-title-inp" rows="2" style="font-weight:700; color:#1e3a8a;" placeholder="Prioritas Nasional baru...">PN ' + (newPnIdx + 1) + ' : ...</textarea>' +
            '<button type="button" class="btn-mini-add-pd" data-pn-idx="' + newPnIdx + '" style="font-size:10.5px; padding:2px 6px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:3px; cursor:pointer; color:#1d4ed8; margin-top:4px;"><i class="fa fa-plus"></i> Tambah PD</button>' +
          '</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Prioritas Daerah 1..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">100% (Selaras)</option>' +
              '<option value="0.75">75% (Sebagian Besar)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Tidak Selaras)</option>' +
            '</select>' +
          '</td>' +
          '<td><input type="text" class="pd-ket-inp" placeholder="Keterangan..."></td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center;">' +
            '<button type="button" class="btn-del-pn" data-pn-idx="' + newPnIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus PN"><i class="fa fa-trash"></i></button>' +
          '</td>';

        tbodyMatrix.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_1_c"));
      }
      return;
    }

    // Delete PN Block
    var btnDelPn1c = target.closest(".btn-del-pn");
    if (btnDelPn1c){
      var pnIdx = btnDelPn1c.getAttribute("data-pn-idx");
      document.querySelectorAll('#wsTable_1_a_1_c .ws-matrix-row[data-pn-idx="' + pnIdx + '"]').forEach(function(r){ r.remove(); });
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_1_c"));
      return;
    }

    // Delete single PD in 1.a.1.c
    var btnDelPd1c = target.closest(".btn-del-pd");
    if (btnDelPd1c){
      var tr = btnDelPd1c.closest(".ws-matrix-row");
      var pnIdx = tr.getAttribute("data-pn-idx");
      var pnRow = document.querySelector('#wsTable_1_a_1_c .ws-matrix-row[data-pn-idx="' + pnIdx + '"]');
      if (pnRow){
        var pnCell = pnRow.querySelector(".cell-pn-wrap");
        var avgCell = pnRow.querySelector(".pn-avg");
        var terbCell = pnRow.querySelector(".pn-terbobot");
        var delCell = pnRow.querySelector(".btn-del-pn") ? pnRow.querySelector(".btn-del-pn").parentElement : null;

        var curRowSpan = Math.max(1, parseInt(pnCell.getAttribute("rowspan") || 1) - 1);
        pnCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);
      }
      tr.remove();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_1_c"));
      return;
    }

    // --- 1.a.2.a (PN 1 PP 1 s.d 8) ---
    // Add PD to PP in 2a
    var btnAddPd2a = target.closest(".btn-add-pd-2a");
    if (btnAddPd2a){
      var ppIdx = btnAddPd2a.getAttribute("data-pp-idx");
      var ppRow = document.querySelector('#wsTable_1_a_2_a .ws-pp-row[data-pp-idx="' + ppIdx + '"]');
      if (ppRow){
        var ppCell = ppRow.querySelector(".cell-pp-wrap-2a");
        var avgCell = ppRow.querySelector(".pp-avg");
        var terbCell = ppRow.querySelector(".pp-terbobot");
        var delCell = ppRow.querySelector(".btn-del-pp-2a") ? ppRow.querySelector(".btn-del-pp-2a").parentElement : null;

        var curRowSpan = parseInt(ppCell.getAttribute("rowspan") || 1) + 1;
        ppCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);

        var newTr = document.createElement("tr");
        newTr.className = "ws-pp-row";
        newTr.setAttribute("data-pp-idx", ppIdx);
        newTr.setAttribute("data-pd-idx", curRowSpan - 1);
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Dukungan Program Daerah baru..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">100% (Selaras)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Tidak Selaras)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-pd-2a" data-pp-idx="' + ppIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';

        var allRowsOfPp = document.querySelectorAll('#wsTable_1_a_2_a .ws-pp-row[data-pp-idx="' + ppIdx + '"]');
        var lastRow = allRowsOfPp[allRowsOfPp.length - 1];
        lastRow.parentNode.insertBefore(newTr, lastRow.nextSibling);
        syncRowspan2a();
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_a"));
      }
      return;
    }

    // Delete PD in 2a
    var btnDelPd2a = target.closest(".btn-del-pd-2a");
    if (btnDelPd2a){
      var tr = btnDelPd2a.closest(".ws-pp-row");
      var ppIdx = tr.getAttribute("data-pp-idx");
      var ppRow = document.querySelector('#wsTable_1_a_2_a .ws-pp-row[data-pp-idx="' + ppIdx + '"]');
      if (ppRow){
        var ppCell = ppRow.querySelector(".cell-pp-wrap-2a");
        var avgCell = ppRow.querySelector(".pp-avg");
        var terbCell = ppRow.querySelector(".pp-terbobot");
        var delCell = ppRow.querySelector(".btn-del-pp-2a") ? ppRow.querySelector(".btn-del-pp-2a").parentElement : null;

        var curRowSpan = Math.max(1, parseInt(ppCell.getAttribute("rowspan") || 1) - 1);
        ppCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);
      }
      tr.remove();
      syncRowspan2a();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_a"));
      return;
    }

    // Add PP Block in 2a
    var btnAddPp2a = target.closest("#btnAddPp2a");
    if (btnAddPp2a){
      var tbody2a = document.querySelector("#wsTable_1_a_2_a tbody");
      if (tbody2a){
        var newPpIdx = document.querySelectorAll("#wsTable_1_a_2_a .pp-title-inp").length;
        var newTr = document.createElement("tr");
        newTr.className = "ws-pp-row";
        newTr.setAttribute("data-pp-idx", newPpIdx);
        newTr.setAttribute("data-pd-idx", "0");
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td rowspan="1" class="cell-pp-wrap-2a" style="vertical-align:top; background:#fdfdfd;">' +
            '<input type="text" class="calc-inp pp-title-inp" style="font-weight:700; color:#203764;" value="PP ' + (newPpIdx + 1) + ' : ..." placeholder="Program Prioritas...">' +
            '<button type="button" class="btn-add-pd-2a" data-pp-idx="' + newPpIdx + '" style="font-size:10.5px; padding:3px 7px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:5px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
          '</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Dukungan Program Daerah..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">100% (Selaras)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Tidak Selaras)</option>' +
            '</select>' +
          '</td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center;">' +
            '<button type="button" class="btn-del-pp-2a" data-pp-idx="' + newPpIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus PP"><i class="fa fa-trash"></i></button>' +
          '</td>';

        tbody2a.appendChild(newTr);
        syncRowspan2a();
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_a"));
      }
      return;
    }

    // Delete PP in 2a
    var btnDelPp2a = target.closest(".btn-del-pp-2a");
    if (btnDelPp2a){
      var ppIdx = btnDelPp2a.getAttribute("data-pp-idx");
      var rowsToDel = document.querySelectorAll('#wsTable_1_a_2_a .ws-pp-row[data-pp-idx="' + ppIdx + '"]');
      var hadPnWrap = false;
      rowsToDel.forEach(function(r){
        if (r.querySelector(".cell-pn-wrap-2a")) hadPnWrap = true;
        r.remove();
      });
      if (hadPnWrap){
        var remainingFirst = document.querySelector("#wsTable_1_a_2_a tbody .ws-pp-row");
        if (remainingFirst && !remainingFirst.querySelector(".cell-pn-wrap-2a")){
          var pnTd = document.createElement("td");
          pnTd.className = "cell-pn-wrap-2a";
          pnTd.style.verticalAlign = "top";
          pnTd.style.background = "#f0f7ff";
          pnTd.style.fontWeight = "800";
          pnTd.style.color = "#1e3a8a";
          pnTd.textContent = "PN 1 : Memperkuat Ketahanan Ekonomi untuk Pertumbuhan yang Berkualitas dan Berkeadilan";
          remainingFirst.insertBefore(pnTd, remainingFirst.children[1]);
        }
      }
      syncRowspan2a();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_a"));
      return;
    }

    // --- 1.a.2.b s.d 1.a.2.g (PN 2-7 dengan Review TA) ---
    // Add PD to PP in BG
    var btnAddPdBg = target.closest(".btn-add-pd-bg");
    if (btnAddPdBg){
      var ppIdx = btnAddPdBg.getAttribute("data-pp-idx");
      var ppRow = document.querySelector('#wsTable_1_a_2_bg .ws-ppbg-row[data-pp-idx="' + ppIdx + '"]');
      if (ppRow){
        var ppCell = ppRow.querySelector(".cell-pp-wrap-bg");
        var avgCell = ppRow.querySelector(".pp-avg");
        var terbCell = ppRow.querySelector(".pp-terbobot");
        var delCell = ppRow.querySelector(".btn-del-pp-bg") ? ppRow.querySelector(".btn-del-pp-bg").parentElement : null;

        var curRowSpan = parseInt(ppCell.getAttribute("rowspan") || 1) + 1;
        ppCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);

        var newTr = document.createElement("tr");
        newTr.className = "ws-ppbg-row";
        newTr.setAttribute("data-pp-idx", ppIdx);
        newTr.setAttribute("data-pd-idx", curRowSpan - 1);
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Dukungan Program Daerah..."></td>' +
          '<td><input type="text" class="pd-review-inp" placeholder="Review TA..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">100% (Iya)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Tidak)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-pd-bg" data-pp-idx="' + ppIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';

        var allRowsOfPp = document.querySelectorAll('#wsTable_1_a_2_bg .ws-ppbg-row[data-pp-idx="' + ppIdx + '"]');
        var lastRow = allRowsOfPp[allRowsOfPp.length - 1];
        lastRow.parentNode.insertBefore(newTr, lastRow.nextSibling);
        syncRowspanBg();
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_bg"));
      }
      return;
    }

    // Delete PD in BG
    var btnDelPdBg = target.closest(".btn-del-pd-bg");
    if (btnDelPdBg){
      var tr = btnDelPdBg.closest(".ws-ppbg-row");
      var ppIdx = tr.getAttribute("data-pp-idx");
      var ppRow = document.querySelector('#wsTable_1_a_2_bg .ws-ppbg-row[data-pp-idx="' + ppIdx + '"]');
      if (ppRow){
        var ppCell = ppRow.querySelector(".cell-pp-wrap-bg");
        var avgCell = ppRow.querySelector(".pp-avg");
        var terbCell = ppRow.querySelector(".pp-terbobot");
        var delCell = ppRow.querySelector(".btn-del-pp-bg") ? ppRow.querySelector(".btn-del-pp-bg").parentElement : null;

        var curRowSpan = Math.max(1, parseInt(ppCell.getAttribute("rowspan") || 1) - 1);
        ppCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);
      }
      tr.remove();
      syncRowspanBg();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_bg"));
      return;
    }

    // Add PP Block in BG
    var btnAddPpBg = target.closest("#btnAddPpBlock");
    if (btnAddPpBg){
      var tbodyBg = document.querySelector("#wsTable_1_a_2_bg tbody");
      if (tbodyBg){
        var newPpIdx = document.querySelectorAll("#wsTable_1_a_2_bg .pp-title-inp").length;
        var newTr = document.createElement("tr");
        newTr.className = "ws-ppbg-row";
        newTr.setAttribute("data-pp-idx", newPpIdx);
        newTr.setAttribute("data-pd-idx", "0");
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td rowspan="1" class="cell-pp-wrap-bg" style="vertical-align:top; background:#fdfdfd;">' +
            '<textarea class="calc-inp pp-title-inp" rows="2" style="font-weight:700; color:#203764;" placeholder="Program Prioritas baru...">Program Prioritas ' + (newPpIdx + 1) + '</textarea>' +
            '<button type="button" class="btn-add-pd-bg" data-pp-idx="' + newPpIdx + '" style="font-size:10.5px; padding:3px 7px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:5px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
          '</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Dukungan Program Daerah..."></td>' +
          '<td><input type="text" class="pd-review-inp" placeholder="Review TA..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">100% (Iya)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Tidak)</option>' +
            '</select>' +
          '</td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center;"><button type="button" class="btn-del-pp-bg" data-pp-idx="' + newPpIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus PP"><i class="fa fa-trash"></i></button></td>';

        tbodyBg.appendChild(newTr);
        syncRowspanBg();
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_bg"));
      }
      return;
    }

    // Delete PP in BG
    var btnDelPpBg = target.closest(".btn-del-pp-bg");
    if (btnDelPpBg){
      var ppIdx = btnDelPpBg.getAttribute("data-pp-idx");
      var rowsToDel = document.querySelectorAll('#wsTable_1_a_2_bg .ws-ppbg-row[data-pp-idx="' + ppIdx + '"]');
      var hadPnWrap = false;
      rowsToDel.forEach(function(r){
        if (r.querySelector(".cell-pn-wrap-bg")) hadPnWrap = true;
        r.remove();
      });
      if (hadPnWrap){
        var remainingFirst = document.querySelector("#wsTable_1_a_2_bg tbody .ws-ppbg-row");
        if (remainingFirst && !remainingFirst.querySelector(".cell-pn-wrap-bg")){
          var pnTd = document.createElement("td");
          pnTd.className = "cell-pn-wrap-bg";
          pnTd.style.verticalAlign = "top";
          pnTd.style.background = "#f0f7ff";
          pnTd.style.fontWeight = "800";
          pnTd.style.color = "#1e3a8a";
          pnTd.textContent = "Prioritas Nasional";
          remainingFirst.insertBefore(pnTd, remainingFirst.children[1]);
        }
      }
      syncRowspanBg();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_2_bg"));
      return;
    }

    // --- 1.a.4 (Major Project) ---
    // Add PD to MP
    var btnAddPd1a4 = target.closest(".btn-add-pd-1a4");
    if (btnAddPd1a4){
      var mpIdx = btnAddPd1a4.getAttribute("data-mp-idx");
      var mpRow = document.querySelector('#wsTable_1_a_4 .ws-mp-row[data-mp-idx="' + mpIdx + '"]');
      if (mpRow){
        var mpCell = mpRow.querySelector(".cell-mp-wrap");
        var avgCell = mpRow.querySelector(".mp-avg");
        var terbCell = mpRow.querySelector(".mp-terbobot");
        var delCell = mpRow.querySelector(".btn-del-mp-1a4") ? mpRow.querySelector(".btn-del-mp-1a4").parentElement : null;

        var curRowSpan = parseInt(mpCell.getAttribute("rowspan") || 1) + 1;
        mpCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);

        var newTr = document.createElement("tr");
        newTr.className = "ws-mp-row";
        newTr.setAttribute("data-mp-idx", mpIdx);
        newTr.setAttribute("data-pd-idx", curRowSpan - 1);
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Dukungan Program Daerah..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">Iya (100%)</option>' +
              '<option value="0.5">Tidak (50%)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-pd-1a4" data-mp-idx="' + mpIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';

        var allRowsOfMp = document.querySelectorAll('#wsTable_1_a_4 .ws-mp-row[data-mp-idx="' + mpIdx + '"]');
        var lastRow = allRowsOfMp[allRowsOfMp.length - 1];
        lastRow.parentNode.insertBefore(newTr, lastRow.nextSibling);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_4"));
      }
      return;
    }

    // Delete PD in 1a4
    var btnDelPd1a4 = target.closest(".btn-del-pd-1a4");
    if (btnDelPd1a4){
      var tr = btnDelPd1a4.closest(".ws-mp-row");
      var mpIdx = tr.getAttribute("data-mp-idx");
      var mpRow = document.querySelector('#wsTable_1_a_4 .ws-mp-row[data-mp-idx="' + mpIdx + '"]');
      if (mpRow){
        var mpCell = mpRow.querySelector(".cell-mp-wrap");
        var avgCell = mpRow.querySelector(".mp-avg");
        var terbCell = mpRow.querySelector(".mp-terbobot");
        var delCell = mpRow.querySelector(".btn-del-mp-1a4") ? mpRow.querySelector(".btn-del-mp-1a4").parentElement : null;

        var curRowSpan = Math.max(1, parseInt(mpCell.getAttribute("rowspan") || 1) - 1);
        mpCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
        if (terbCell) terbCell.setAttribute("rowspan", curRowSpan);
        if (delCell) delCell.setAttribute("rowspan", curRowSpan);
      }
      tr.remove();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_4"));
      return;
    }

    // Add MP Block
    var btnAdd1a4Mp = target.closest("#btnAdd1a4Mp");
    if (btnAdd1a4Mp){
      var tbodyMp = document.querySelector("#wsTable_1_a_4 tbody");
      if (tbodyMp){
        var newMpIdx = document.querySelectorAll("#wsTable_1_a_4 .mp-title-inp").length;
        var newTr = document.createElement("tr");
        newTr.className = "ws-mp-row";
        newTr.setAttribute("data-mp-idx", newMpIdx);
        newTr.setAttribute("data-pd-idx", "0");
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td rowspan="1" class="cell-mp-wrap" style="vertical-align:top; background:#f0f7ff;">' +
            '<input type="text" class="calc-inp mp-title-inp" style="font-weight:700; color:#1e3a8a;" value="MP ' + (newMpIdx + 1) + ' : ..." placeholder="Major Project...">' +
            '<button type="button" class="btn-add-pd-1a4" data-mp-idx="' + newMpIdx + '" style="font-size:10.5px; padding:3px 7px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:5px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
          '</td>' +
          '<td><input type="text" class="calc-inp pd-title-inp" placeholder="Program Daerah..."></td>' +
          '<td>' +
            '<select class="calc-inp pd-score-sel">' +
              '<option value="1.0">Iya (100%)</option>' +
              '<option value="0.5">Tidak (50%)</option>' +
            '</select>' +
          '</td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center;">' +
            '<button type="button" class="btn-del-mp-1a4" data-mp-idx="' + newMpIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus MP"><i class="fa fa-trash"></i></button>' +
          '</td>';

        tbodyMp.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_a_4"));
      }
      return;
    }

    // Delete MP Block
    var btnDelMp1a4 = target.closest(".btn-del-mp-1a4");
    if (btnDelMp1a4){
      var mpIdx = btnDelMp1a4.getAttribute("data-mp-idx");
      document.querySelectorAll('#wsTable_1_a_4 .ws-mp-row[data-mp-idx="' + mpIdx + '"]').forEach(function(r){ r.remove(); });
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_1_a_4"));
      return;
    }

    // --- 1.a.5 & 1.a.6 (SPM) ---
    // Add Indikator to Bidang SPM
    var btnAddIndSpm = target.closest(".btn-add-ind-spm");
    if (btnAddIndSpm){
      var bidIdx = btnAddIndSpm.getAttribute("data-bid-idx");
      var bidRow = document.querySelector('#wsTable_SPM .ws-spm-row[data-bid-idx="' + bidIdx + '"]');
      if (bidRow){
        var bidCell = bidRow.querySelector(".cell-spm-bid-wrap");
        var avgCell = bidRow.querySelector(".bid-avg");
        var isTarget = !!document.querySelector("#wsTable_SPM thead th:nth-child(4)");

        var curRowSpan = parseInt(bidCell.getAttribute("rowspan") || 1) + 1;
        bidCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);

        var newTr = document.createElement("tr");
        newTr.className = "ws-spm-row";
        newTr.setAttribute("data-bid-idx", bidIdx);
        newTr.setAttribute("data-ind-idx", curRowSpan - 1);
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp ind-name-inp" placeholder="Indikator SPM baru..."></td>' +
          (isTarget ? '<td><input type="text" class="calc-inp ind-target-inp" value="100%" placeholder="Target"></td><td><input type="text" class="ind-unit-inp" value="Persen"></td>' : '') +
          '<td>' +
            '<select class="calc-inp ind-score-sel">' +
              '<option value="1.0">100% (Iya / Sesuai)</option>' +
              '<option value="0.5">50% (Tidak / Sebagian)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-ind-spm" data-bid-idx="' + bidIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus Indikator"><i class="fa fa-times"></i></button></td>';

        var allRowsOfBid = document.querySelectorAll('#wsTable_SPM .ws-spm-row[data-bid-idx="' + bidIdx + '"]');
        var lastRow = allRowsOfBid[allRowsOfBid.length - 1];
        lastRow.parentNode.insertBefore(newTr, lastRow.nextSibling);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_SPM"));
      }
      return;
    }

    // Delete Indikator in SPM
    var btnDelIndSpm = target.closest(".btn-del-ind-spm");
    if (btnDelIndSpm){
      var tr = btnDelIndSpm.closest(".ws-spm-row");
      var bidIdx = tr.getAttribute("data-bid-idx");
      var bidRow = document.querySelector('#wsTable_SPM .ws-spm-row[data-bid-idx="' + bidIdx + '"]');
      if (bidRow){
        var bidCell = bidRow.querySelector(".cell-spm-bid-wrap");
        var avgCell = bidRow.querySelector(".bid-avg");

        var curRowSpan = Math.max(1, parseInt(bidCell.getAttribute("rowspan") || 1) - 1);
        bidCell.setAttribute("rowspan", curRowSpan);
        if (avgCell) avgCell.setAttribute("rowspan", curRowSpan);
      }
      tr.remove();
      updateModalWorksheetScore();
      renumberExcelSheetRows(document.getElementById("wsTable_SPM"));
      return;
    }

    // --- 1.c.1: Add / Del Row Sub Kegiatan ---
    var btnAdd1c1 = target.closest("#btnAdd1c1SubRow, #btnAdd1c1Row");
    if (btnAdd1c1){
      var tbody1c1 = document.querySelector("#wsTable_1_c_1 tbody");
      if (tbody1c1){
        var lastRow = tbody1c1.querySelector(".ws-1c1-sub-row:last-child");
        var lastPnIdx = lastRow ? (lastRow.getAttribute("data-pn-idx") || "6") : "6";
        var lastKpuIdx = lastRow ? (lastRow.getAttribute("data-kpu-idx") || "0") : "0";
        var nextSubIdx = document.querySelectorAll("#wsTable_1_c_1 .ws-1c1-sub-row").length;

        var newTr = document.createElement("tr");
        newTr.className = "ws-1c1-sub-row";
        newTr.setAttribute("data-pn-idx", lastPnIdx);
        newTr.setAttribute("data-kpu-idx", lastKpuIdx);
        newTr.setAttribute("data-sub-idx", nextSubIdx);
        newTr.style.background = "#ffffff";
        newTr.style.borderBottom = "1px solid #e2e8f0";
        newTr.innerHTML = 
          '<td class="excel-row-num" style="text-align:center; vertical-align:middle; background:#f8fafc; font-weight:600; border:1px solid #cbd5e1;">+</td>' +
          '<td style="vertical-align: middle; padding: 6px 8px; border: 1px solid #cbd5e1;">' +
            '<input type="text" class="calc-inp ws-1c1-sub-inp" placeholder="Kode & Nama Sub Kegiatan baru..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px 8px; font-size: 12.5px;">' +
          '</td>' +
          '<td style="vertical-align: middle; padding: 6px 8px; border: 1px solid #cbd5e1;">' +
            '<input type="text" class="calc-inp ws-1c1-pagu-inp" placeholder="0,00" style="width: 100%; text-align: right; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px 8px; font-size: 12.5px; font-weight: 600;">' +
          '</td>' +
          '<td style="vertical-align: middle; text-align: center; padding: 6px 8px; border: 1px solid #cbd5e1;">' +
            '<select class="calc-inp ws-1c1-score-sel" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px 4px; font-size: 12px; font-weight: 600; text-align: center; background: #f0fdf4; color: #166534; cursor: pointer;">' +
              '<option value="1.0" selected>100.00%</option>' +
              '<option value="0.0">0.00%</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center; vertical-align:middle; border:1px solid #cbd5e1; padding:4px;">' +
            '<button type="button" class="btn-del-1c1-sub" style="border:none; background:transparent; color:#ef4444; cursor:pointer; font-size:14px;" title="Hapus Sub Kegiatan"><i class="fa fa-trash"></i></button>' +
          '</td>';

        tbody1c1.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_1_c_1"));
      }
      return;
    }

    // --- 3.a.1.a: Add / Del Row ---
    var btnAdd3a1a = target.closest("#btnAdd3a1aRow");
    if (btnAdd3a1a){
      var tbody3a1a = document.querySelector("#wsTable_3_a_1_a tbody");
      if (tbody3a1a){
        var newTr = document.createElement("tr");
        newTr.className = "ws-3a1a-row";
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp bidang-inp" placeholder="Bidang Urusan..."></td>' +
          '<td><input type="text" class="calc-inp prog-inp" placeholder="Program Prioritas..."></td>' +
          '<td><input type="text" class="calc-inp opd-inp" placeholder="Nama Perangkat Daerah..."></td>' +
          '<td class="cell-formula row-score" style="text-align:center; font-weight:700; color:#107c41;">100%</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-3a1a-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Baris"><i class="fa fa-times"></i></button></td>';
        tbody3a1a.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_3_a_1_a"));
      }
      return;
    }

    // --- 3.a.1.b: Add / Del Row ---
    var btnAdd3a1b = target.closest("#btnAdd3a1bRow");
    if (btnAdd3a1b){
      var tbody3a1b = document.querySelector("#wsTable_3_a_1_b tbody");
      if (tbody3a1b){
        var newTr = document.createElement("tr");
        newTr.className = "ws-3a1b-row";
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp ind-daerah" placeholder="Indikator Daerah..."></td>' +
          '<td><input type="text" class="calc-inp tgt-daerah" value="100" style="text-align:center; font-weight:600;"></td>' +
          '<td><input type="text" class="calc-inp unit-daerah" value="Persen"></td>' +
          '<td><input type="text" class="calc-inp opd-name" placeholder="OPD..."></td>' +
          '<td><input type="text" class="calc-inp iku-opd" placeholder="IKU OPD..."></td>' +
          '<td><input type="text" class="calc-inp tgt-opd" value="100" style="text-align:center; font-weight:600;"></td>' +
          '<td><input type="text" class="calc-inp unit-opd" value="Persen"></td>' +
          '<td>' +
            '<select class="calc-inp ekspektasi-sel">' +
              '<option value="Besar">Besar (Makin Besar Baik)</option>' +
              '<option value="Kecil">Kecil (Makin Kecil Baik)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-3a1b-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Baris"><i class="fa fa-times"></i></button></td>';
        tbody3a1b.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_3_a_1_b"));
      }
      return;
    }

    // --- General / Pilar 2: Add / Del Row ---
    var btnAddGen = target.closest("#btnAddGenRow");
    if (btnAddGen){
      var tbodyGen = document.querySelector("#wsTable_General tbody");
      if (tbodyGen){
        var newTr = document.createElement("tr");
        newTr.className = "ws-gen-row";
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp kriteria-inp" placeholder="Kriteria parameter baru..."></td>' +
          '<td>' +
            '<select class="calc-inp score-sel">' +
              '<option value="1.0">Memenuhi Sepenuhnya (100%)</option>' +
              '<option value="0.75">Sebagian Besar Memenuhi (75%)</option>' +
              '<option value="0.5">Sebagian Memenuhi (50%)</option>' +
              '<option value="0.25">Belum Memadai (25%)</option>' +
              '<option value="0">Belum Memenuhi (0%)</option>' +
            '</select>' +
          '</td>' +
          '<td><input type="text" class="calc-inp catatan-inp" placeholder="Catatan evaluasi..."></td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-gen-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Kriteria"><i class="fa fa-times"></i></button></td>';
        tbodyGen.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_General"));
      }
      return;
    }

    // Generic Delete Row (for 1c1, 3a1a, 3a1b, gen)
    var delGeneric = target.closest(".btn-del-1c1-row, .btn-del-1c1-sub, .btn-del-3a1a-row, .btn-del-3a1b-row, .btn-del-gen-row");
    if (delGeneric){
      var tbl = delGeneric.closest(".excel-grid-table");
      delGeneric.closest("tr").remove();
      updateModalWorksheetScore();
      if (tbl) renumberExcelSheetRows(tbl);
      return;
    }
  });

  var btnModalMaximize = document.getElementById("btnModalMaximize");
  var iconModalMaximize = document.getElementById("iconModalMaximize");
  var excelContainer = document.querySelector(".excel-window-container");

  if (btnModalMaximize && excelContainer){
    btnModalMaximize.addEventListener("click", function(){
      var isMax = excelContainer.classList.toggle("maximized");
      if (iconModalMaximize){
        iconModalMaximize.className = isMax ? "fa fa-compress" : "fa fa-arrows-alt";
      }
    });
  }

  document.getElementById("btnModalClose").addEventListener("click", closeDetailModal);
  document.getElementById("btnModalCancel").addEventListener("click", closeDetailModal);
  
  document.getElementById("btnModalSave").addEventListener("click", saveModalDetail);

  modalDetail.addEventListener("click", function(e){
    if (e.target === modalDetail) closeDetailModal();
  });

  if (selectTahun) selectTahun.addEventListener("change", reloadData);
  if (selectInstansi && selectInstansi.tagName === 'SELECT') selectInstansi.addEventListener("change", reloadData);
  if (inputSearch) inputSearch.addEventListener("input", renderTable);

  // =========================================================
  // VERIFIKATOR MODAL LOGIC & ACTIONS
  // =========================================================
  function getItemKeselarasanBobot(code, maxBobot){
    var item = itemMap[code];
    if (!item) return 0;
    maxBobot = parseFloat(maxBobot !== undefined ? maxBobot : item.bobot) || 0;

    var saved = SCORES_MAP[code] || {};
    var detailObj = {};
    if (saved.detail_json){
      try {
        detailObj = typeof saved.detail_json === 'string' ? JSON.parse(saved.detail_json) : saved.detail_json;
      } catch(e) { detailObj = {}; }
    }

    var prevCode = modalItemCode ? modalItemCode.value : "";
    var prevMax = modalBobotMaks ? modalBobotMaks.value : "";
    var prevWsContent = modalDynamicWorksheet ? modalDynamicWorksheet.innerHTML : "";
    var prevInputVal = modalBobotInput ? modalBobotInput.value : "";
    var prevCalc = modalCalcDisplay ? modalCalcDisplay.textContent : "";
    var prevFx = excelFxContent ? excelFxContent.textContent : "";

    var calculatedScore = maxBobot;

    try {
      if (modalItemCode) modalItemCode.value = code;
      if (modalBobotMaks) modalBobotMaks.value = maxBobot;
      if (modalDynamicWorksheet) modalDynamicWorksheet.innerHTML = renderDynamicWorksheet(code, maxBobot, detailObj);

      updateModalWorksheetScore();

      if (modalBobotInput) {
        var val = parseFloat(modalBobotInput.value);
        if (!isNaN(val)) {
          calculatedScore = val;
        }
      }
    } catch(err) {
      if (saved.bobot_capaian !== null && saved.bobot_capaian !== undefined && saved.bobot_capaian !== ""){
        calculatedScore = parseFloat(saved.bobot_capaian) || maxBobot;
      } else {
        calculatedScore = maxBobot;
      }
    } finally {
      if (modalItemCode) modalItemCode.value = prevCode;
      if (modalBobotMaks) modalBobotMaks.value = prevMax;
      if (modalDynamicWorksheet) modalDynamicWorksheet.innerHTML = prevWsContent;
      if (modalBobotInput) modalBobotInput.value = prevInputVal;
      if (modalCalcDisplay) modalCalcDisplay.textContent = prevCalc;
      if (excelFxContent) excelFxContent.textContent = prevFx;
    }

    return calculatedScore;
  }

  function openVerifikatorModal(code){
    var item = itemMap[code];
    if (!item) return;

    var saved = SCORES_MAP[code] || {};

    verifItemCode.value = code;
    verifBobotMaks.value = item.bobot;
    verifMaxBadge.textContent = numFmt(item.bobot);

    var typeLabel = item.type === 'sub' ? 'Sub-Indikator (' + item.letter + ')' : 'Indikator (' + (item.no || code) + ')';
    verifModalTitle.textContent = "Penilaian " + typeLabel;
    verifUraian.value = item.title;

    // Hitung otomatis total keselarasan bobot dari lembar kerja / formula
    var keselarasanScore = getItemKeselarasanBobot(code, item.bobot);
    if (verifKeselarasanBadge) {
      verifKeselarasanBadge.textContent = numFmt(keselarasanScore);
    }

    // BOBOT CAPAIAN: otomatis terisi dari total keselarasan bobot jika belum pernah diverifikasi
    var hasSavedVerif = (saved.bobot_verifikator !== null && saved.bobot_verifikator !== undefined && saved.bobot_verifikator !== "");
    var targetScore = hasSavedVerif ? Number(saved.bobot_verifikator) : keselarasanScore;
    var targetStr = targetScore.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
    verifBobotInput.value = targetStr === "" ? "0" : targetStr;
    verifBobotInput.max = item.bobot;

    // OPSI AKSI / KRITERIA: jangan terisi otomatis (hanya dimuat jika sudah tersimpan sebelumnya)
    verifOpsiAksi.value = saved.opsi_aksi_verifikator || "";

    verifCatatan.value = saved.catatan_verifikator || "";
    verifBuktiDukung.value = saved.bukti_dukung_verifikator || "";
    showPreviewIfImageOrPdf(verifBuktiDukung.value, 'verifPreviewBuktiContainer', 'verifBuktiDukung');

    if (!IS_ROLE_4) {
      verifBobotInput.readOnly = true;
      verifOpsiAksi.disabled = true;
      verifCatatan.readOnly = true;
      verifBuktiDukung.readOnly = true;
      if (btnSyncKeselarasan) btnSyncKeselarasan.disabled = true;
      document.querySelectorAll(".verif-preset-btn").forEach(function(b){ b.disabled = true; });
      if (btnVerifCancel) btnVerifCancel.style.display = "none";
      if (btnVerifSave) btnVerifSave.style.display = "none";
      if (btnVerifCloseBottom) btnVerifCloseBottom.style.display = "";
    } else {
      verifBobotInput.readOnly = false;
      verifOpsiAksi.disabled = false;
      verifCatatan.readOnly = false;
      verifBuktiDukung.readOnly = false;
      if (btnSyncKeselarasan) btnSyncKeselarasan.disabled = false;
      document.querySelectorAll(".verif-preset-btn").forEach(function(b){ b.disabled = false; });
      if (btnVerifCancel) btnVerifCancel.style.display = "";
      if (btnVerifCloseBottom) btnVerifCloseBottom.style.display = "none";
      if (btnVerifSave) {
        btnVerifSave.style.display = "";
        btnVerifSave.disabled = false;
        btnVerifSave.style.opacity = "1";
        btnVerifSave.style.cursor = "pointer";
        btnVerifSave.innerHTML = '<i class="fa fa-save"></i> Simpan Penilaian';
        btnVerifSave.title = "Simpan Penilaian Verifikator";
      }
    }

    syncVerifScoreUI(targetStr, item.bobot);
    updateVerifLinkPreview(saved.bukti_dukung_verifikator || "");

    modalVerif.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  function closeVerifikatorModal(){
    if (modalVerif) modalVerif.classList.remove("open");
    document.body.style.overflow = "";
  }

  function saveVerifikatorModal(){
    if (!IS_ROLE_4){
      showToast("Akses ditolak: Hanya akun Level 4 yang dapat mengubah penilaian verifikator.", true);
      return;
    }

    var code = verifItemCode.value;
    if (!code) return;

    var item = itemMap[code];
    var maxVal = item ? item.bobot : 100;
    var inputVal = verifBobotInput.value.trim();
    var bobotNum = inputVal === "" ? null : Number(inputVal);

    if (bobotNum !== null && (bobotNum < 0 || bobotNum > (maxVal + 0.001))){
      showToast("Nilai bobot capaian melebihi bobot maksimal (" + numFmt(maxVal) + ")", true);
      return;
    }

    var payload = {
      tahun: selectTahun.value,
      instansi_id: selectInstansi.value,
      item_code: code,
      bobot_verifikator: bobotNum,
      opsi_aksi_verifikator: verifOpsiAksi.value,
      catatan_verifikator: verifCatatan.value.trim(),
      bukti_dukung_verifikator: verifBuktiDukung.value.trim()
    };

    var btn = btnVerifSave;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

    $.ajax({
      url: BASE_URL + "Instansi/SaveIPPDVerifikator",
      type: "POST",
      data: payload,
      dataType: "json",
      success: function(resp){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Penilaian';
        if (resp.status === "success"){
          if (!SCORES_MAP[code]) SCORES_MAP[code] = {};
          SCORES_MAP[code].bobot_verifikator = bobotNum;
          SCORES_MAP[code].opsi_aksi_verifikator = payload.opsi_aksi_verifikator;
          SCORES_MAP[code].catatan_verifikator = payload.catatan_verifikator;
          SCORES_MAP[code].bukti_dukung_verifikator = payload.bukti_dukung_verifikator;
          SCORES_MAP[code].status_verifikasi = "Terverifikasi";

          closeVerifikatorModal();
          showToast("Penilaian Verifikator poin " + code + " berhasil disimpan.");
          renderTable();
        } else {
          showToast(resp.message || "Gagal menyimpan data verifikator.", true);
        }
      },
      error: function(xhr){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Penilaian';
        showToast("Terjadi kesalahan pada server saat menyimpan penilaian verifikator.", true);
      }
    });
  }

  // --- VERIFIKATOR REACTIVE & DYNAMIC TWO-WAY BINDING ---
  function updateVerifPresetActive(ratio) {
    document.querySelectorAll(".verif-preset-btn").forEach(function(btn){
      var btnRatio = parseFloat(btn.getAttribute("data-ratio"));
      if (Math.abs(btnRatio - ratio) < 0.02) {
        btn.classList.add("active");
      } else {
        btn.classList.remove("active");
      }
    });
  }

  function syncVerifScoreUI(val, maxVal) {
    var pill = document.getElementById("verifPillPercent");
    var pBar = document.getElementById("verifProgressBar");
    var hint = document.getElementById("verifValidationHint");
    var btnSave = document.getElementById("btnVerifSave");

    var numVal = parseFloat(val);
    if (isNaN(numVal) || val === "" || val === null) {
      if (pill) {
        pill.textContent = "0%";
        pill.className = "verif-calc-pill level-0";
      }
      if (pBar) {
        pBar.style.width = "0%";
        pBar.style.background = "#94a3b8";
      }
      if (hint) hint.style.display = "none";
      updateVerifPresetActive(-1);
      return;
    }

    var pct = maxVal > 0 ? (numVal / maxVal) * 100 : 0;
    var ratio = maxVal > 0 ? (numVal / maxVal) : 0;

    // Check overflow
    var isOver = numVal > (maxVal + 0.001);
    if (hint) {
      hint.style.display = isOver ? "block" : "none";
      if (isOver) {
        hint.innerHTML = '<i class="fa fa-exclamation-triangle"></i> Nilai melebihi bobot maksimal (' + numFmt(maxVal) + ')';
      }
    }
    if (btnSave && IS_ROLE_4) {
      btnSave.disabled = isOver;
      btnSave.style.opacity = isOver ? "0.6" : "1";
    }

    if (pill) {
      pill.textContent = pct.toFixed(0) + "%";
      if (isOver) {
        pill.className = "verif-calc-pill level-over";
      } else if (pct >= 99) {
        pill.className = "verif-calc-pill level-100";
      } else if (pct >= 74) {
        pill.className = "verif-calc-pill level-75";
      } else if (pct >= 49) {
        pill.className = "verif-calc-pill level-50";
      } else {
        pill.className = "verif-calc-pill level-0";
      }
    }

    if (pBar) {
      pBar.style.width = Math.min(Math.max(pct, 0), 100) + "%";
      if (isOver) {
        pBar.style.background = "#ef4444";
      } else if (pct >= 99) {
        pBar.style.background = "linear-gradient(90deg, #10b981 0%, #059669 100%)";
      } else if (pct >= 74) {
        pBar.style.background = "linear-gradient(90deg, #3b82f6 0%, #2563eb 100%)";
      } else if (pct >= 49) {
        pBar.style.background = "linear-gradient(90deg, #f59e0b 0%, #d97706 100%)";
      } else {
        pBar.style.background = "linear-gradient(90deg, #94a3b8 0%, #64748b 100%)";
      }
    }

    updateVerifPresetActive(ratio);
  }

  // Two-way sync: Opsi Aksi change -> Updates Bobot Input & Presets
  if (verifOpsiAksi) {
    verifOpsiAksi.addEventListener("change", function(){
      if (!IS_ROLE_4) return;
      var max = parseFloat(verifBobotMaks.value) || 0;
      var selVal = this.value;
      var ratio = null;

      if (selVal === 'Memenuhi Sepenuhnya (100%)') ratio = 1.0;
      else if (selVal === 'Sebagian Besar Memenuhi (75%)') ratio = 0.75;
      else if (selVal === 'Sebagian Memenuhi (50%)') ratio = 0.50;
      else if (selVal === 'Belum Memenuhi (0%)') ratio = 0.0;
      else if (selVal === 'Tidak Terkait / NA') {
        verifBobotInput.value = "";
        syncVerifScoreUI("", max);
        return;
      }

      if (ratio !== null) {
        var calc = max * ratio;
        var strVal = calc.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
        verifBobotInput.value = strVal === "" ? "0" : strVal;
        syncVerifScoreUI(calc, max);
      }
    });
  }

  // Two-way sync: Bobot input typing -> Updates UI & syncs Opsi Aksi
  if (verifBobotInput) {
    verifBobotInput.addEventListener("input", function(){
      var max = parseFloat(verifBobotMaks.value) || 0;
      var numVal = parseFloat(this.value);
      syncVerifScoreUI(this.value, max);

      if (!isNaN(numVal) && max > 0 && verifOpsiAksi && IS_ROLE_4) {
        var ratio = numVal / max;
        if (Math.abs(ratio - 1.0) < 0.02) verifOpsiAksi.value = "Memenuhi Sepenuhnya (100%)";
        else if (Math.abs(ratio - 0.75) < 0.02) verifOpsiAksi.value = "Sebagian Besar Memenuhi (75%)";
        else if (Math.abs(ratio - 0.50) < 0.02) verifOpsiAksi.value = "Sebagian Memenuhi (50%)";
        else if (Math.abs(ratio - 0.0) < 0.02) verifOpsiAksi.value = "Belum Memenuhi (0%)";
      }
    });

    verifBobotInput.addEventListener("focus", function(){
      this.select();
    });
  }

  // Quick Preset Buttons for Verifikator
  document.querySelectorAll(".verif-preset-btn").forEach(function(btn){
    btn.addEventListener("click", function(){
      if (!IS_ROLE_4) return;
      var ratio = parseFloat(this.getAttribute("data-ratio"));
      var max = parseFloat(verifBobotMaks.value) || 0;
      var calc = max * ratio;
      var strVal = calc.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      verifBobotInput.value = strVal === "" ? "0" : strVal;

      // Sync Opsi Aksi automatically
      if (verifOpsiAksi) {
        if (ratio >= 0.99) verifOpsiAksi.value = "Memenuhi Sepenuhnya (100%)";
        else if (ratio >= 0.74) verifOpsiAksi.value = "Sebagian Besar Memenuhi (75%)";
        else if (ratio >= 0.49) verifOpsiAksi.value = "Sebagian Memenuhi (50%)";
        else if (ratio <= 0.01) verifOpsiAksi.value = "Belum Memenuhi (0%)";
      }

      syncVerifScoreUI(calc, max);
    });
  });

  // Catatan Evaluasi Quick Chips (Smart Templates)
  document.querySelectorAll(".verif-catatan-chip").forEach(function(chip){
    chip.addEventListener("click", function(){
      if (!IS_ROLE_4) return;
      var textToAdd = this.getAttribute("data-text");
      if (!textToAdd) return;
      var cur = verifCatatan.value.trim();
      if (!cur) {
        verifCatatan.value = textToAdd;
      } else if (cur.indexOf(textToAdd) === -1) {
        verifCatatan.value = cur + (cur.endsWith(".") ? " " : ", ") + textToAdd;
      }
      verifCatatan.focus();
    });
  });

  var btnClearVerifCatatan = document.getElementById("btnClearVerifCatatan");
  if (btnClearVerifCatatan) {
    btnClearVerifCatatan.addEventListener("click", function(){
      if (!IS_ROLE_4) return;
      verifCatatan.value = "";
      verifCatatan.focus();
    });
  }

  // Bukti Dukung Quick Chips & Link Preview
  function updateVerifLinkPreview(val) {
    var btn = document.getElementById("btnPreviewVerifLink");
    if (!btn) return;
    var match = (val || "").match(/https?:\/\/[^\s]+/i);
    if (match) {
      btn.href = match[0];
      btn.style.display = "inline-flex";
    } else {
      btn.style.display = "none";
    }
  }

  if (verifBuktiDukung) {
    verifBuktiDukung.addEventListener("input", function(){
      updateVerifLinkPreview(this.value);
    });
  }

  document.querySelectorAll(".verif-bukti-chip").forEach(function(chip){
    chip.addEventListener("click", function(){
      if (!IS_ROLE_4) return;
      var textToAdd = this.getAttribute("data-text");
      if (!textToAdd) return;
      var cur = verifBuktiDukung.value.trim();
      if (!cur) {
        verifBuktiDukung.value = textToAdd;
      } else if (cur.indexOf(textToAdd) === -1) {
        verifBuktiDukung.value = cur + " | " + textToAdd;
      }
      updateVerifLinkPreview(verifBuktiDukung.value);
      verifBuktiDukung.focus();
    });
  });

  // Sync button from Total Keselarasan
  if (btnSyncKeselarasan){
    btnSyncKeselarasan.addEventListener("click", function(){
      if (!IS_ROLE_4) return;
      var code = verifItemCode.value;
      var item = itemMap[code];
      if (!item) return;
      var score = getItemKeselarasanBobot(code, item.bobot);
      var strScore = score.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      verifBobotInput.value = strScore === "" ? "0" : strScore;
      if (verifKeselarasanBadge) verifKeselarasanBadge.textContent = numFmt(score);

      var max = parseFloat(verifBobotMaks.value) || item.bobot || 0;
      syncVerifScoreUI(score, max);

      // Auto update matching opsi aksi
      if (verifOpsiAksi && max > 0) {
        var ratio = score / max;
        if (ratio >= 0.99) verifOpsiAksi.value = "Memenuhi Sepenuhnya (100%)";
        else if (ratio >= 0.74) verifOpsiAksi.value = "Sebagian Besar Memenuhi (75%)";
        else if (ratio >= 0.49) verifOpsiAksi.value = "Sebagian Memenuhi (50%)";
        else if (ratio <= 0.01) verifOpsiAksi.value = "Belum Memenuhi (0%)";
      }

      showToast("Bobot capaian disinkronkan dari total keselarasan: " + numFmt(score));
    });
  }

  if (btnVerifClose) btnVerifClose.addEventListener("click", closeVerifikatorModal);
  if (btnVerifCloseBottom) btnVerifCloseBottom.addEventListener("click", closeVerifikatorModal);
  if (btnVerifCancel) btnVerifCancel.addEventListener("click", closeVerifikatorModal);
  if (btnVerifSave) btnVerifSave.addEventListener("click", saveVerifikatorModal);
  if (modalVerif) {
    modalVerif.addEventListener("click", function(e){
      if (e.target === modalVerif) closeVerifikatorModal();
    });
  }

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape"){
      if (modalVerif && modalVerif.classList.contains("open")) closeVerifikatorModal();
      else if (modalDetail && modalDetail.classList.contains("open")) closeDetailModal();
    }
    if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S')){
      if (modalVerif && modalVerif.classList.contains("open")){
        e.preventDefault();
        saveVerifikatorModal();
      } else if (modalDetail && modalDetail.classList.contains("open")){
        e.preventDefault();
        saveModalDetail();
      }
    }
  });

  // Initial Boot
  // --- File Upload Logic ---
  function initUpload(fileInputId, loadingId, urlInputId, previewContainerId) {
    var fileInput = document.getElementById(fileInputId);
    if (!fileInput) return;
    fileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        var file = this.files[0];
        var formData = new FormData();
        formData.append('file', file);
        
        var loading = document.getElementById(loadingId);
        var urlInput = document.getElementById(urlInputId);
        var preview = document.getElementById(previewContainerId);
        
        if (loading) loading.style.display = 'block';
        
        fetch(BASE_URL + 'Instansi/UploadBuktiIPPD', {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (loading) loading.style.display = 'none';
          if (data.status === 'success') {
            if (urlInput) {
              urlInput.value = data.file_url;
            }
            if (preview) {
              var ext = data.file_name.split('.').pop().toLowerCase();
              if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                preview.innerHTML = '<img src="' + data.file_url + '" style="max-width: 100%; max-height: 150px; object-fit: contain;">';
              } else if (ext === 'pdf') {
                preview.innerHTML = '<embed src="' + data.file_url + '" type="application/pdf" width="100%" height="150px" />';
              } else {
                preview.innerHTML = '<a href="' + data.file_url + '" target="_blank">' + data.file_name + '</a>';
              }
              preview.style.display = 'block';
            }
            showToast('File berhasil diunggah.', 'success');
          } else {
            showToast('Gagal mengunggah file: ' + data.message, 'error');
          }
        })
        .catch(err => {
          if (loading) loading.style.display = 'none';
          showToast('Terjadi kesalahan jaringan.', 'error');
          console.error(err);
        });
      }
    });
  }

  // Trigger modal preview
  // Modal for preview
  if (!document.getElementById('previewModalBukti')) {
    var modalHtml = '<div id="previewModalBukti" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:999999; justify-content:center; align-items:center;">' +
      '<div style="background:#fff; padding: 20px; border-radius: 8px; width: 80%; max-width: 800px; height: 85%; display:flex; flex-direction:column; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">' +
        '<div style="display:flex; justify-content:space-between; align-items:center; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 15px;">' +
          '<h3 style="margin:0; font-size:18px; color:#1e293b; font-weight:600;">Preview Bukti Dukung</h3>' +
          '<button type="button" onclick="document.getElementById(\'previewModalBukti\').style.display=\'none\'" style="background:none; border:none; font-size:24px; cursor:pointer; color:#64748b; line-height:1;">&times;</button>' +
        '</div>' +
        '<div id="previewModalBody" style="flex:1; overflow:hidden; display:flex; justify-content:center; align-items:center; background:#f1f5f9; border-radius:4px;"></div>' +
      '</div>' +
    '</div>';
    document.body.insertAdjacentHTML('beforeend', modalHtml);
  }

  window.openPreviewModal = function(url) {
    var ext = url.split('.').pop().toLowerCase();
    var body = document.getElementById('previewModalBody');
    if (['jpg', 'jpeg', 'png', 'gif'].includes(ext) || (ext.length > 4 && url.match(/\.(jpeg|jpg|gif|png)$/i))) {
        body.innerHTML = '<img src="' + url + '" style="max-width:100%; max-height:100%; object-fit:contain;">';
    } else {
        body.innerHTML = '<embed src="' + url + '" type="application/pdf" width="100%" height="100%" />';
    }
    document.getElementById('previewModalBukti').style.display = 'flex';
  };

  window.hapusBukti = function(inputId, containerId, urlToRemove) {
    Swal.fire({
      title: 'Hapus Bukti?',
      text: "Apakah Anda yakin ingin menghapus bukti ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ef4444',
      cancelButtonColor: '#64748b',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        var input = document.getElementById(inputId);
        var urls = input.value.split(',').map(s => s.trim()).filter(s => s !== '');
        var newUrls = urls.filter(u => u !== urlToRemove);
        input.value = newUrls.join(', ');
        
        var event = new Event('input');
        input.dispatchEvent(event);
      }
    });
  };

  function showPreviewIfImageOrPdf(urlsStr, previewContainerId, inputId) {
    var preview = document.getElementById(previewContainerId);
    if (!preview) return;
    if (!urlsStr || urlsStr.trim() === '') {
      preview.style.display = 'none';
      preview.innerHTML = '';
      return;
    }
    
    var urls = urlsStr.split(',').map(s => s.trim()).filter(s => s !== '');
    if (urls.length === 0) {
      preview.style.display = 'none';
      preview.innerHTML = '';
      return;
    }

    var html = '<div style="display:flex; flex-wrap:wrap; gap:10px; justify-content:center; margin-top:5px; padding:10px;">';
    
    urls.forEach(function(url) {
        var ext = url.split('.').pop().toLowerCase();
        var isMedia = (['jpg', 'jpeg', 'png', 'gif', 'pdf'].includes(ext) || (ext.length > 4 && url.match(/\.(jpeg|jpg|gif|png|pdf)$/i)));
        
        if (isMedia) {
            html += '<div style="border:1px solid #cbd5e1; border-radius:4px; padding:5px; background:#fff; text-align:center; max-width:150px; overflow:hidden;">';
            
            if (ext === 'pdf') {
                html += '<div style="font-size:30px; color:#ef4444; margin-bottom:5px;"><i class="fa fa-file-pdf-o"></i></div>';
                html += '<div style="font-size:10px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="'+url+'">PDF File</div>';
            } else {
                html += '<img src="' + url + '" style="max-width:100%; height:60px; object-fit:contain; margin-bottom:5px;">';
            }
            
            html += '<div style="display:flex; flex-direction:column; gap:4px; margin-top:5px;">' + 
            '<button type="button" class="btn-ui btn-ui-secondary" style="font-size:11px; padding: 2px 6px;" onclick="openPreviewModal(\'' + url + '\')"><i class="fa fa-eye"></i> Lihat</button>' +
            '<button type="button" style="font-size:11px; padding: 2px 6px; background:#ef4444; color:white; border:none; border-radius:4px; cursor:pointer;" onclick="hapusBukti(\'' + inputId + '\', \'' + previewContainerId + '\', \'' + url + '\')"><i class="fa fa-trash"></i> Hapus</button>' +
            '</div></div>';
        } else {
            html += '<div style="border:1px solid #cbd5e1; border-radius:4px; padding:5px; background:#fff; text-align:center;">' +
            '<a href="' + url + '" target="_blank" style="font-size:11px;"><i class="fa fa-external-link"></i> Tautan</a>' +
            '<div style="margin-top:5px;"><button type="button" style="font-size:11px; padding: 2px 6px; background:#ef4444; color:white; border:none; border-radius:4px; cursor:pointer;" onclick="hapusBukti(\'' + inputId + '\', \'' + previewContainerId + '\', \'' + url + '\')"><i class="fa fa-trash"></i> Hapus</button></div>' +
            '</div>';
        }
    });

    html += '</div>';

    preview.style.display = 'block';
    preview.style.background = 'transparent';
    preview.style.border = 'none';
    preview.innerHTML = html;
  }

  function initUpload(fileInputId, loadingId, urlInputId, previewContainerId) {
    var fileInput = document.getElementById(fileInputId);
    var loading = document.getElementById(loadingId);
    var urlInput = document.getElementById(urlInputId);

    if (!fileInput) return;

    fileInput.addEventListener('change', async function() {
      if (this.files && this.files.length > 0) {
        if (loading) loading.style.display = 'block';
        
        var uploadPromises = [];
        var uploadedUrls = [];
        var errors = [];

        for (let i = 0; i < this.files.length; i++) {
            let file = this.files[i];
            let formData = new FormData();
            formData.append('file', file);
            
            let p = fetch(BASE_URL + "Instansi/UploadBuktiIPPD", {
              method: 'POST',
              body: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                uploadedUrls.push(data.file_url);
              } else {
                errors.push(data.message);
              }
            })
            .catch(err => {
              errors.push("Gagal unggah: " + file.name);
            });
            
            uploadPromises.push(p);
        }

        await Promise.all(uploadPromises);
        
        if (loading) loading.style.display = 'none';
        
        if (uploadedUrls.length > 0) {
            var currentUrls = urlInput.value ? urlInput.value.split(',').map(s=>s.trim()).filter(s=>s!=='') : [];
            currentUrls = currentUrls.concat(uploadedUrls);
            urlInput.value = currentUrls.join(', ');
            
            var event = new Event('input');
            urlInput.dispatchEvent(event);
            
            if (errors.length > 0) {
                Swal.fire('Peringatan', 'Beberapa file diunggah, tapi ada error: ' + errors.join(', '), 'warning');
            } else {
                Swal.fire('Berhasil', uploadedUrls.length + ' File berhasil diunggah.', 'success');
            }
        } else {
            Swal.fire('Gagal', 'Gagal mengunggah file. ' + errors.join(', '), 'error');
        }
        
        fileInput.value = "";
      }
    });
  }

  // Listeners for links to show preview when typing
  var modalBukti = document.getElementById('modalBuktiDukung');
  if (modalBukti) {
    modalBukti.addEventListener('input', function() {
      showPreviewIfImageOrPdf(this.value, 'previewBuktiContainer', 'modalBuktiDukung');
    });
  }
  
  var verifBukti = document.getElementById('verifBuktiDukung');
  if (verifBukti) {
    verifBukti.addEventListener('input', function() {
      showPreviewIfImageOrPdf(this.value, 'verifPreviewBuktiContainer', 'verifBuktiDukung');
    });
  }

  // Bind the upload functions
  initUpload('uploadBuktiFile', 'uploadBuktiLoading', 'modalBuktiDukung', 'previewBuktiContainer');
  initUpload('verifUploadBuktiFile', 'verifUploadBuktiLoading', 'verifBuktiDukung', 'verifPreviewBuktiContainer');

  // Modify open modal to clear or populate preview
  var originalOpenDetailModal = window.openDetailModal; // Might not be global, but we can hook into modal display logic if we can.
  // We'll use mutation observer or just trust the users typing/uploading if we can't easily hook openDetailModal inside the IIFE.

  buildItemMap();
  renderTable();
})();
</script>

