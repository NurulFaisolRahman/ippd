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
$isVerifikator = isset($IsVerifikator) ? (bool)$IsVerifikator : (
    (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 4 && (!empty($_SESSION['IsVerifikator']) || empty($_SESSION['IdInstansi']) || (isset($_SESSION['Username']) && stripos($_SESSION['Username'], 'verif') !== false))) ||
    (!empty($_SESSION['IsVerifikator']))
);
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
.btn-action-detail.verif-btn-verified {
  background: #dcfce7 !important;
  border-color: #86efac !important;
  color: #15803d !important;
}
.btn-action-detail.verif-btn-verified:hover {
  background: #bbf7d0 !important;
  border-color: #22c55e !important;
  box-shadow: 0 2px 6px rgba(34, 197, 94, 0.2) !important;
}
.btn-action-detail.verif-btn-revision {
  background: #fef3c7 !important;
  border-color: #fde68a !important;
  color: #b45309 !important;
}
.btn-action-detail.verif-btn-revision:hover {
  background: #fde68a !important;
  border-color: #f59e0b !important;
  box-shadow: 0 2px 6px rgba(245, 158, 11, 0.2) !important;
}
.btn-action-detail.verif-btn-pending {
  background: #f0fdfa !important;
  border-color: #99f6e4 !important;
  color: #0d9488 !important;
}
.btn-action-detail.verif-btn-pending:hover {
  background: #ccfbf1 !important;
  border-color: #14b8a6 !important;
  box-shadow: 0 2px 6px rgba(20, 184, 166, 0.2) !important;
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
.btn-action-verifikator.verif-btn-verified {
  background: #dcfce7 !important;
  border: 1px solid #86efac !important;
  color: #15803d !important;
  font-weight: 700 !important;
}
.btn-action-verifikator.verif-btn-verified:hover {
  background: #bbf7d0 !important;
  border-color: #22c55e !important;
  box-shadow: 0 2px 6px rgba(34, 197, 94, 0.2) !important;
}
.btn-action-verifikator.verif-btn-revision {
  background: #fef3c7 !important;
  border: 1px solid #fde68a !important;
  color: #b45309 !important;
  font-weight: 700 !important;
}
.btn-action-verifikator.verif-btn-revision:hover {
  background: #fde68a !important;
  border-color: #f59e0b !important;
  box-shadow: 0 2px 6px rgba(245, 158, 11, 0.2) !important;
}
.btn-action-verifikator.verif-btn-pending {
  background: #f0fdfa !important;
  border: 1px solid #99f6e4 !important;
  color: #0d9488 !important;
  font-weight: 700 !important;
}
.btn-action-verifikator.verif-btn-pending:hover {
  background: #ccfbf1 !important;
  border-color: #14b8a6 !important;
  box-shadow: 0 2px 6px rgba(20, 184, 166, 0.2) !important;
}

/* Verifikator Decision Panel inside Modal */
.verif-decision-panel {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: var(--radius-md, 10px);
  margin: 10px 16px 0;
  padding: 12px 16px;
  box-shadow: 0 1px 3px rgba(15,23,42,0.04);
}
.verif-decision-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
}
.verif-decision-left {
  display: flex;
  align-items: center;
  gap: 8px;
}
.verif-decision-tag {
  font-size: 12.5px;
  font-weight: 700;
  color: #1e293b;
  display: flex;
  align-items: center;
  gap: 6px;
}
.verif-badge-pill {
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 9999px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.verif-badge-pill.status-draft {
  background: #f1f5f9;
  color: #64748b;
  border: 1px solid #cbd5e1;
}
.verif-badge-pill.status-verified {
  background: #dcfce7;
  color: #15803d;
  border: 1px solid #86efac;
}
.verif-badge-pill.status-revision {
  background: #fef3c7;
  color: #b45309;
  border: 1px solid #fde68a;
}
.verif-decision-buttons {
  display: flex;
  align-items: center;
  gap: 8px;
}
.btn-decision-choice {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 14px;
  font-size: 12px;
  font-weight: 700;
  border-radius: 6px;
  border: 1.5px solid transparent;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  background: #ffffff;
}
.btn-choice-verify {
  border-color: #86efac;
  color: #166534;
  background: #f0fdf4;
}
.btn-choice-verify:hover {
  background: #dcfce7;
  border-color: #22c55e;
  box-shadow: 0 2px 6px rgba(34, 197, 94, 0.2);
}
.btn-choice-verify.active {
  background: #16a34a;
  border-color: #15803d;
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}
.btn-choice-revision {
  border-color: #fde68a;
  color: #92400e;
  background: #fffbeb;
}
.btn-choice-revision:hover {
  background: #fef3c7;
  border-color: #f59e0b;
  box-shadow: 0 2px 6px rgba(245, 158, 11, 0.2);
}
.btn-choice-revision.active {
  background: #d97706;
  border-color: #b45309;
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
}

/* Alasan Revisi Box */
.verif-revisi-expandable {
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px dashed #cbd5e1;
  animation: fadeInDown 0.2s ease-out;
}
@keyframes fadeInDown {
  from { opacity: 0; transform: translateY(-6px); }
  to { opacity: 1; transform: translateY(0); }
}
.revisi-label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 6px;
  flex-wrap: wrap;
  gap: 6px;
}
.revisi-label {
  font-size: 12px;
  font-weight: 700;
  color: #b45309;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 6px;
}
.revisi-guide {
  font-size: 11px;
  color: #64748b;
  font-style: italic;
}
.revisi-textarea {
  width: 100%;
  border: 1.5px solid #fcd34d;
  border-radius: 6px;
  padding: 8px 12px;
  font-size: 13px;
  font-family: inherit;
  background: #fffdf5;
  color: #1e293b;
  resize: vertical;
  transition: all 0.2s ease;
  box-sizing: border-box;
}
.revisi-textarea:focus {
  outline: none;
  border-color: #f59e0b;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
}
.revisi-template-chips {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
  margin-top: 8px;
}
.chips-title {
  font-size: 11px;
  font-weight: 700;
  color: #64748b;
  display: flex;
  align-items: center;
  gap: 4px;
}
.chip-item-revisi {
  font-size: 11px;
  font-weight: 600;
  padding: 3px 8px;
  border-radius: 4px;
  border: 1px solid #e2e8f0;
  background: #ffffff;
  color: #475569;
  cursor: pointer;
  transition: all 0.15s ease;
}
.chip-item-revisi:hover {
  background: #fffbeb;
  border-color: #fcd34d;
  color: #b45309;
}

/* Modal Bottom Action Buttons for Verifikator */
.btn-excel-verify {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 18px;
  font-size: 12.5px;
  font-weight: 700;
  border-radius: 6px;
  border: none;
  background: #16a34a;
  color: #ffffff;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(22, 163, 74, 0.25);
  transition: all 0.15s ease;
}
.btn-excel-verify:hover {
  background: #15803d;
  box-shadow: 0 4px 10px rgba(22, 163, 74, 0.35);
  transform: translateY(-1px);
}
.btn-excel-revision {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 18px;
  font-size: 12.5px;
  font-weight: 700;
  border-radius: 6px;
  border: 1px solid #d97706;
  background: #fef3c7;
  color: #b45309;
  cursor: pointer;
  transition: all 0.15s ease;
}
.btn-excel-revision:hover {
  background: #d97706;
  color: #ffffff;
  box-shadow: 0 4px 10px rgba(217, 119, 6, 0.25);
  transform: translateY(-1px);
}

/* Alert Banners inside Modal */
.verif-banner-revisi {
  background: #fffbeb;
  border-left: 4px solid #f59e0b;
  border-bottom: 1px solid #fde68a;
  padding: 10px 16px;
  display: flex;
  align-items: flex-start;
  gap: 12px;
}
.banner-revisi-icon {
  color: #d97706;
  font-size: 18px;
  margin-top: 1px;
}
.banner-revisi-title {
  font-size: 12px;
  font-weight: 800;
  color: #92400e;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}
.banner-revisi-text {
  font-size: 12.5px;
  color: #78350f;
  margin-top: 2px;
}
.verif-banner-verified {
  background: #f0fdf4;
  border-left: 4px solid #16a34a;
  border-bottom: 1px solid #bbf7d0;
  padding: 10px 16px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.banner-verified-icon {
  color: #16a34a;
  font-size: 18px;
}
.banner-verified-title {
  font-size: 12px;
  font-weight: 800;
  color: #166534;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}
.banner-verified-text {
  font-size: 12.5px;
  color: #15803d;
}

/* Data Informasi Dokumen & Bukti Pendukung Card */
.excel-info-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-left: 4px solid #00c292;
  border-radius: var(--radius-md, 8px);
  margin: 10px 16px 0;
  padding: 12px 16px;
  box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
}
.excel-info-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 8px;
  padding-bottom: 6px;
  border-bottom: 1px dashed #cbd5e1;
}
.excel-info-title {
  font-size: 12.5px;
  font-weight: 700;
  color: #1e293b;
  display: flex;
  align-items: center;
  gap: 6px;
}
.excel-info-badge {
  font-size: 11px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 9999px;
  background: #e8f8f5;
  color: #007a5a;
  border: 1px solid #b2dfdb;
}
.excel-info-badge.badge-success {
  background: #e8f8f5;
  color: #007a5a;
  border: 1px solid #b2dfdb;
}
.excel-info-badge.badge-empty {
  background: #f1f5f9;
  color: #64748b;
  border: 1px solid #cbd5e1;
}
.excel-info-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 8px;
}
.excel-info-pill {
  font-size: 11.5px;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  padding: 4px 10px;
  border-radius: 6px;
  color: #334155;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.excel-info-catatan {
  font-size: 12px;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  padding: 8px 12px;
  color: #334155;
  margin-bottom: 8px;
  line-height: 1.45;
}
.excel-info-bukti {
  font-size: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.btn-info-bukti-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 10px;
  font-size: 11.5px;
  font-weight: 600;
  color: #1d4ed8;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.15s ease;
}
.btn-info-bukti-link:hover {
  background: #dbeafe;
  color: #1e40af;
  text-decoration: none;
}

/* Verifikator Single Action Button & Status Pill */
.btn-action-detail.btn-verif-action {
  background: #f0fdfa !important;
  border: 1.5px solid #00c292 !important;
  color: #007a5a !important;
  font-weight: 700 !important;
  box-shadow: 0 1px 3px rgba(0, 194, 146, 0.12) !important;
}
.btn-action-detail.btn-verif-action:hover {
  background: #00c292 !important;
  border-color: #00a87e !important;
  color: #ffffff !important;
  box-shadow: 0 3px 8px rgba(0, 194, 146, 0.3) !important;
  transform: translateY(-1px);
}
.verif-status-pill {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 5px 12px;
  font-size: 11.5px;
  font-weight: 700;
  border-radius: 9999px;
  width: 100%;
  max-width: 195px;
  text-align: center;
  line-height: 1.35;
  box-sizing: border-box;
}
.verif-status-pill.pill-verified {
  background: #dcfce7;
  color: #15803d;
  border: 1px solid #86efac;
}
.verif-status-pill.pill-revision {
  background: #fef3c7;
  color: #b45309;
  border: 1px solid #fde68a;
}
.verif-status-pill.pill-draft {
  background: #f1f5f9;
  color: #64748b;
  border: 1px solid #cbd5e1;
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

      <?php if (!empty($ListInstansi) && empty($InstansiId)): ?>
      <div class="t-field">
        <label for="selectInstansi">Perangkat Daerah / Instansi</label>
        <select id="selectInstansi" class="t-select" onchange="window.location.href='<?= base_url('Instansi/TabelIPPD') ?>?tahun=<?= $tahunAktif ?>&instansi_id=' + this.value">
          <?php foreach ($ListInstansi as $inst): ?>
            <option value="<?= $inst['id'] ?>" <?= ((int)$inst['id'] === (int)$filterInstansi) ? 'selected' : '' ?>><?= htmlspecialchars($inst['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php else: ?>
      <input type="hidden" id="selectInstansi" value="<?= $filterInstansi ?>">
      <?php endif; ?>

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
            <th class="col-opsi-aksi text-center"><?= $isVerifikator ? 'Aksi' : 'Aksi & Detail Penilaian' ?></th>
            <th class="col-verifikator text-center">Status Verifikasi</th>
          </tr>
        </thead>
        <tbody id="tbodyIppd">
          <!-- Rendered via JavaScript -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- =========================================================
     EXCEL SPREADSHEET MODAL (Authentic Excel Window Design)
     ========================================================= -->
<div class="modal-overlay" id="modalDetailOverlay">
  <div class="excel-window-container">
    
    <!-- 1. Excel Title Bar -->
    <div class="excel-titlebar">
      <div class="excel-title-left">
        <div class="excel-icon-brand" id="modalExcelBrandIcon"><i class="fa fa-file-excel-o"></i></div>
        <span id="modalExcelTitleWrap"> IPPD Daerah - Lembar Kerja Evaluasi [<span id="excelPointBadge">POIN 1.a.1.a</span>]</span>
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
        <span id="modalScorePillLabel"><?= $isVerifikator ? 'Bobot Verifikasi:' : 'Capaian:' ?></span> <strong id="modalCalcDisplay">0.000</strong>
      </div>
    </div>

    <!-- Banner Info Status Verifikasi -->
    <div id="bannerStatusRevisi" class="verif-banner-revisi" style="display:none;">
      <div class="banner-revisi-icon"><i class="fa fa-exclamation-triangle"></i></div>
      <div class="banner-revisi-content">
        <div class="banner-revisi-title"><i class="fa fa-pencil-square-o"></i> Catatan Perbaikan dari Verifikator:</div>
        <div class="banner-revisi-text" id="bannerRevisiText">-</div>
      </div>
    </div>
    <div id="bannerStatusVerified" class="verif-banner-verified" style="display:none;">
      <div class="banner-verified-icon"><i class="fa fa-check-circle"></i></div>
      <div class="banner-verified-content">
        <div class="banner-verified-title">Status: Terverifikasi oleh Verifikator</div>
        <div class="banner-verified-text">Indikator ini telah memenuhi kriteria dan disetujui.</div>
      </div>
    </div>

    <form id="formDetailIppd" autocomplete="off">
      <input type="hidden" id="modalItemCode" value="">
      <input type="hidden" id="modalBobotMaks" value="0">

      <!-- 3. Dynamic Worksheet Canvas -->
      <div class="excel-sheet-canvas" id="modalDynamicWorksheet">
        <!-- Injected dynamically with Excel row numbers & column letters -->
      </div>

      <!-- Section Keputusan Verifikasi & Alasan Revisi -->
      <div class="verif-decision-panel" id="verifDecisionPanel" style="<?= $isVerifikator ? '' : 'display:none;' ?>">
        <div class="verif-decision-header">
          <div class="verif-decision-left">
            <span class="verif-decision-tag"><i class="fa fa-shield"></i> Keputusan Verifikator:</span>
            <span class="verif-badge-pill status-draft" id="badgeVerifModalStatus">Belum Diverifikasi</span>
          </div>
          <div class="verif-decision-buttons">
            <button type="button" class="btn-decision-choice btn-choice-verify" id="btnChoiceVerify" title="Setujui indikator & konfirmasi capaian">
              <i class="fa fa-check-circle"></i> Verifikasi (Sesuai)
            </button>
            <button type="button" class="btn-decision-choice btn-choice-revision" id="btnChoiceRevision" title="Tandai belum sesuai & isi alasan perbaikan">
              <i class="fa fa-pencil-square-o"></i> Perbaiki (Belum Sesuai)
            </button>
          </div>
        </div>

        <!-- Box Alasan Revisi: Tampil jika memilih 'Perbaiki' / Belum Sesuai -->
        <div class="verif-revisi-expandable" id="boxAlasanRevisi" style="display:none;">
          <div class="revisi-label-row">
            <label for="modalAlasanRevisi" class="revisi-label">
              <i class="fa fa-exclamation-circle text-amber"></i> Alasan Revisi / Catatan Perbaikan <span class="text-danger">*</span>
            </label>
            <span class="revisi-guide">Tuliskan hal-hal yang belum sesuai agar daerah dapat melakukan perbaikan.</span>
          </div>
          <textarea id="modalAlasanRevisi" class="revisi-textarea" rows="3" placeholder="Tuliskan catatan perbaikan atau alasan mengapa indikator / bukti dukung ini belum sesuai..."></textarea>
          
          <div class="revisi-template-chips">
            <span class="chips-title"><i class="fa fa-tags"></i> Template Alasan Cepat:</span>
            <button type="button" class="chip-item-revisi" data-text="Dokumen bukti dukung belum dilampirkan atau tautan tidak dapat diakses.">Bukti Belum Lengkap</button>
            <button type="button" class="chip-item-revisi" data-text="Target indikator daerah belum konsisten dengan target nasional RPJMN.">Target Belum Selaras</button>
            <button type="button" class="chip-item-revisi" data-text="Matriks penyelarasan program dan sub-kegiatan belum memadai.">Matriks Kurang Lengkap</button>
            <button type="button" class="chip-item-revisi" data-text="Perlu penyesuaian perhitungan bobot capaian berdasarkan data realisasi terbaru.">Penyesuaian Nilai</button>
            <button type="button" class="chip-item-revisi" data-text="Belum mencakup target dan capaian SPM tahun berjalan secara lengkap.">Target SPM Belum Sesuai</button>
          </div>
        </div>
      </div>

      <?php if (!empty($isVerifikator)): ?>
        <!-- Hidden Inputs for Verifikator to preserve form references safely without errors -->
        <input type="hidden" id="modalRefDokumen" value="">
        <input type="hidden" id="modalRefHalaman" value="">
        <input type="hidden" id="modalRefTabel" value="">
        <input type="hidden" id="modalCatatan" value="">
        <input type="hidden" id="modalBuktiDukung" value="">

        <!-- Read-Only: Data Informasi Dokumen & Bukti Pendukung untuk Verifikator -->
        <div class="excel-info-card" id="boxDataInformasi">
          <div class="excel-info-header">
            <div class="excel-info-title">
              <i class="fa fa-info-circle" style="color:#00c292;"></i> Data Informasi Referensi Sumber & Bukti Dukung
            </div>
            <span class="excel-info-badge" id="badgeDataInformasi"><i class="fa fa-check-circle"></i> Data Terlampir</span>
          </div>
          <div class="excel-info-body" id="contentDataInformasi">
            <!-- Populated dynamically via JavaScript -->
          </div>
        </div>
      <?php else: ?>
        <!-- Editable: Excel Reference & Evidence Metadata Box untuk Akun Daerah -->
        <div class="excel-meta-box" id="boxInputReferensiDaerah">
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
      <?php endif; ?>

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
            <label for="modalBobotInput" id="modalBobotLabel"><?= $isVerifikator ? 'Bobot Verifikasi:' : 'Capaian:' ?></label>
            <input type="number" step="0.001" min="0" id="modalBobotInput" placeholder="0.000">
            <span class="excel-pct-badge" id="excelScorePctBadge">100%</span>
          </div>
          <button type="button" class="btn-excel-cancel" id="btnModalCancel">Tutup</button>
          <?php if ($isVerifikator): ?>
            <button type="button" class="btn-excel-revision" id="btnModalActionPerbaiki" title="Tandai perlu perbaikan jika belum sesuai">
              <i class="fa fa-pencil-square-o"></i> Perbaiki
            </button>
            <button type="button" class="btn-excel-verify" id="btnModalActionVerifikasi" title="Verifikasi & setujui capaian">
              <i class="fa fa-check-circle"></i> Verifikasi
            </button>
          <?php else: ?>
            <button type="button" class="btn-excel-save" id="btnModalSave">
              <i class="fa fa-save"></i> Simpan Penilaian <span class="shortcut-pill">Ctrl+S</span>
            </button>
          <?php endif; ?>
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
  var AUTO_DATA_1_A_1_B = <?= isset($AutoData_1_a_1_b) ? json_encode($AutoData_1_a_1_b) : '{}' ?>;
  var AUTO_DATA_1_A_1_C = <?= isset($AutoData_1_a_1_c) ? json_encode($AutoData_1_a_1_c) : '[]' ?>;
  var AUTO_DATA_1_A_1_D = <?= isset($AutoData_1_a_1_d) ? json_encode($AutoData_1_a_1_d) : '{}' ?>;
  var AUTO_DATA_1_A_2_A = <?= isset($AutoData_1_a_2_a) ? json_encode($AutoData_1_a_2_a) : '[]' ?>;
  var AUTO_DATA_1_A_2_B = <?= isset($AutoData_1_a_2_b) ? json_encode($AutoData_1_a_2_b) : '[]' ?>;
  var AUTO_DATA_1_A_2_C = <?= isset($AutoData_1_a_2_c) ? json_encode($AutoData_1_a_2_c) : '[]' ?>;
  var AUTO_DATA_1_A_2_D = <?= isset($AutoData_1_a_2_d) ? json_encode($AutoData_1_a_2_d) : '[]' ?>;
  var AUTO_DATA_1_A_2_E = <?= isset($AutoData_1_a_2_e) ? json_encode($AutoData_1_a_2_e) : '[]' ?>;
  var AUTO_DATA_1_A_2_ALL = <?= isset($AutoData_1_a_2_ALL) ? json_encode($AutoData_1_a_2_ALL) : '{}' ?>;
  var AUTO_DATA_1_A_3_A = <?= isset($AutoData_1_a_3_a) ? json_encode($AutoData_1_a_3_a) : '{}' ?>;
  var AUTO_DATA_1_A_3_B = <?= isset($AutoData_1_a_3_b) ? json_encode($AutoData_1_a_3_b) : '{}' ?>;
  var AUTO_DATA_1_A_4 = <?= isset($AutoData_1_a_4) ? json_encode($AutoData_1_a_4) : '[]' ?>;
  var AUTO_DATA_1_A_5 = <?= isset($AutoData_1_a_5) ? json_encode($AutoData_1_a_5) : '[]' ?>;
  var AUTO_DATA_1_A_6 = <?= isset($AutoData_1_a_6) ? json_encode($AutoData_1_a_6) : '[]' ?>;
  var AUTO_DATA_1_B_10_A = <?= isset($AutoData_1_b_10_a) ? json_encode($AutoData_1_b_10_a) : '{}' ?>;
  var AUTO_DATA_1_B_10_B = <?= isset($AutoData_1_b_10_b) ? json_encode($AutoData_1_b_10_b) : '{}' ?>;
  var AUTO_DATA_1_B_1_B = <?= isset($AutoData_1_b_1_b) ? json_encode($AutoData_1_b_1_b) : '{}' ?>;
  var AUTO_DATA_1_B_1_D = <?= isset($AutoData_1_b_1_d) ? json_encode($AutoData_1_b_1_d) : '{}' ?>;
  var AUTO_DATA_1_B_2_B = <?= isset($AutoData_1_b_2_b) ? json_encode($AutoData_1_b_2_b) : '{}' ?>;
  var AUTO_DATA_1_B_3_B = <?= isset($AutoData_1_b_3_b) ? json_encode($AutoData_1_b_3_b) : '{}' ?>;
  var AUTO_DATA_1_B_4_B = <?= isset($AutoData_1_b_4_b) ? json_encode($AutoData_1_b_4_b) : '{}' ?>;
  var AUTO_DATA_1_B_5_B = <?= isset($AutoData_1_b_5_b) ? json_encode($AutoData_1_b_5_b) : '{}' ?>;
  var AUTO_DATA_1_B_6_B = <?= isset($AutoData_1_b_6_b) ? json_encode($AutoData_1_b_6_b) : '{}' ?>;
  var AUTO_DATA_1_B_7_B = <?= isset($AutoData_1_b_7_b) ? json_encode($AutoData_1_b_7_b) : '{}' ?>;
  var AUTO_DATA_1_B_8_B = <?= isset($AutoData_1_b_8_b) ? json_encode($AutoData_1_b_8_b) : '{}' ?>;
  var AUTO_DATA_1_B_9_B = <?= isset($AutoData_1_b_9_b) ? json_encode($AutoData_1_b_9_b) : '{}' ?>;
  var AUTO_DATA_1_C_1 = <?= isset($AutoData_1_c_1) ? json_encode($AutoData_1_c_1) : '[]' ?>;
  var IS_ROLE_4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;
  var IS_VERIFIKATOR = <?= !empty($isVerifikator) ? 'true' : 'false' ?>;

  var verifDecisionPanel = document.getElementById("verifDecisionPanel");
  var badgeVerifModalStatus = document.getElementById("badgeVerifModalStatus");
  var btnChoiceVerify = document.getElementById("btnChoiceVerify");
  var btnChoiceRevision = document.getElementById("btnChoiceRevision");
  var boxAlasanRevisi = document.getElementById("boxAlasanRevisi");
  var modalAlasanRevisi = document.getElementById("modalAlasanRevisi");
  var btnModalActionVerifikasi = document.getElementById("btnModalActionVerifikasi");
  var btnModalActionPerbaiki = document.getElementById("btnModalActionPerbaiki");
  var bannerStatusRevisi = document.getElementById("bannerStatusRevisi");
  var bannerRevisiText = document.getElementById("bannerRevisiText");
  var bannerStatusVerified = document.getElementById("bannerStatusVerified");
  var modalExcelBrandIcon = document.getElementById("modalExcelBrandIcon");
  var modalExcelTitleWrap = document.getElementById("modalExcelTitleWrap");
  var modalScorePillLabel = document.getElementById("modalScorePillLabel");
  var modalBobotLabel = document.getElementById("modalBobotLabel");

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
                  if (sub.code === '1.a.1.a' && (!SCORES_MAP['1.a.1.a'] || SCORES_MAP['1.a.1.a'].bobot_capaian === null || SCORES_MAP['1.a.1.a'].bobot_capaian === undefined)) {
                    var auto1a1a = getAutoScore_1_a_1_a();
                    subVal = auto1a1a.score;
                  }
                  if (sub.code === '1.a.1.b' && (!SCORES_MAP['1.a.1.b'] || SCORES_MAP['1.a.1.b'].bobot_capaian === null || SCORES_MAP['1.a.1.b'].bobot_capaian === undefined)) {
                    var auto1a1b = getAutoScore_1_a_1_b();
                    subVal = auto1a1b.score;
                  }
                  if (sub.code === '1.a.1.c' && (!SCORES_MAP['1.a.1.c'] || SCORES_MAP['1.a.1.c'].bobot_capaian === null || SCORES_MAP['1.a.1.c'].bobot_capaian === undefined)) {
                    var auto1a1c = getAutoScore_1_a_1_c();
                    subVal = auto1a1c.score;
                  }
                  if (sub.code === '1.a.1.d' && (!SCORES_MAP['1.a.1.d'] || SCORES_MAP['1.a.1.d'].bobot_capaian === null || SCORES_MAP['1.a.1.d'].bobot_capaian === undefined)) {
                    var auto1a1d = getAutoScore_1_a_1_d();
                    subVal = auto1a1d.score;
                  }
                  if (sub.code === '1.a.2.a' && (!SCORES_MAP['1.a.2.a'] || SCORES_MAP['1.a.2.a'].bobot_capaian === null || SCORES_MAP['1.a.2.a'].bobot_capaian === undefined)) {
                    var auto1a2a = getAutoScore_1_a_2_a();
                    subVal = auto1a2a.score;
                  }
                  if (sub.code === '1.a.2.b' && (!SCORES_MAP['1.a.2.b'] || SCORES_MAP['1.a.2.b'].bobot_capaian === null || SCORES_MAP['1.a.2.b'].bobot_capaian === undefined)) {
                    var auto1a2b = getAutoScore_1_a_2_b();
                    subVal = auto1a2b.score;
                  }
                  if (sub.code === '1.a.2.c' && (!SCORES_MAP['1.a.2.c'] || SCORES_MAP['1.a.2.c'].bobot_capaian === null || SCORES_MAP['1.a.2.c'].bobot_capaian === undefined)) {
                    var auto1a2c = getAutoScore_1_a_2_c();
                    subVal = auto1a2c.score;
                  }
                  if (sub.code === '1.a.2.d' && (!SCORES_MAP['1.a.2.d'] || SCORES_MAP['1.a.2.d'].bobot_capaian === null || SCORES_MAP['1.a.2.d'].bobot_capaian === undefined)) {
                    var auto1a2d = getAutoScore_1_a_2_d();
                    subVal = auto1a2d.score;
                  }
                  if (sub.code === '1.a.2.e' && (!SCORES_MAP['1.a.2.e'] || SCORES_MAP['1.a.2.e'].bobot_capaian === null || SCORES_MAP['1.a.2.e'].bobot_capaian === undefined)) {
                    var auto1a2e = getAutoScore_1_a_2_e();
                    subVal = auto1a2e.score;
                  }
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

  function renderVerifikatorActionButton(code, savedScore){
    return '<button type="button" class="btn-action-detail btn-verif-action" data-code="' + code + '" title="Buka lembar kerja verifikasi">' +
             '<i class="fa fa-shield"></i> Verifikasi' +
           '</button>';
  }

  function renderVerifikatorStatusBadge(code, savedScore){
    savedScore = savedScore || {};
    var statusVerif = savedScore.status_verifikasi || (savedScore.bobot_verifikator !== null && savedScore.bobot_verifikator !== undefined && savedScore.bobot_verifikator !== "" ? 'Terverifikasi' : 'Draft');
    var hasVerif = (savedScore.bobot_verifikator !== null && savedScore.bobot_verifikator !== undefined && savedScore.bobot_verifikator !== "");
    var kriteria = (savedScore.opsi_aksi_verifikator || "").trim();

    if (statusVerif === 'Terverifikasi' || kriteria === 'Terverifikasi' || kriteria.indexOf("100%") !== -1 || kriteria.indexOf("Memenuhi Sepenuhnya") !== -1){
      return '<span class="verif-status-pill pill-verified" title="Status: Terverifikasi">' +
               '<i class="fa fa-check-circle"></i> Terverifikasi (' + numFmt(savedScore.bobot_verifikator || savedScore.bobot_capaian) + ')' +
             '</span>';
    } else if (statusVerif === 'Perlu Perbaikan' || statusVerif === 'Revisi' || kriteria === 'Perlu Perbaikan'){
      return '<span class="verif-status-pill pill-revision" title="' + escapeHtml(savedScore.alasan_revisi ? 'Perlu Perbaikan: ' + savedScore.alasan_revisi : 'Perlu Perbaikan') + '">' +
               '<i class="fa fa-pencil-square-o"></i> Perlu Perbaikan' +
             '</span>';
    } else if (hasVerif){
      return '<span class="verif-status-pill pill-verified">' +
               '<i class="fa fa-check-circle"></i> Terverifikasi (' + numFmt(savedScore.bobot_verifikator) + ')' +
             '</span>';
    } else {
      return '<span class="verif-status-pill pill-draft">' +
               '<i class="fa fa-clock-o"></i> Belum Diverifikasi' +
             '</span>';
    }
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

              if (ind.code === '1.a.4') {
                var auto1a4 = getAutoScore_1_a_4(savedScoreInd.detail_json ? (typeof savedScoreInd.detail_json === 'string' ? JSON.parse(savedScoreInd.detail_json) : savedScoreInd.detail_json) : null);
                if (!hasScore || (parseFloat(savedScoreInd.bobot_capaian) !== 0.5 && parseFloat(savedScoreInd.bobot_capaian) !== 1.0)) {
                  savedScoreInd = Object.assign(savedScoreInd, {
                    bobot_capaian: auto1a4.score,
                    opsi_aksi: auto1a4.aksi,
                    catatan: 'Otomatis dihitung dari keselarasan Dukungan Program Daerah terhadap Kegiatan Prioritas Utama (KPU) RPJMN (Rata-rata Terbobot: ' + auto1a4.avg.toFixed(2) + ', Kriteria ' + auto1a4.crit + ' = ' + auto1a4.aksi + ')'
                  });
                  SCORES_MAP['1.a.4'] = savedScoreInd;
                  hasScore = true;
                }
              }

              if (ind.code === '1.a.5') {
                var auto1a5 = getAutoScore_1_a_5(savedScoreInd.detail_json ? (typeof savedScoreInd.detail_json === 'string' ? JSON.parse(savedScoreInd.detail_json) : savedScoreInd.detail_json) : null);
                if (!hasScore || (parseFloat(savedScoreInd.bobot_capaian) !== 0.5 && parseFloat(savedScoreInd.bobot_capaian) !== 1.0)) {
                  savedScoreInd = Object.assign(savedScoreInd, {
                    bobot_capaian: auto1a5.score,
                    opsi_aksi: auto1a5.aksi,
                    catatan: 'Otomatis dihitung dari keselarasan Komponen Indikator SPM Daerah terhadap PP No. 2 Tahun 2018 (Rata-rata Terbobot: ' + auto1a5.avg.toFixed(2) + ', Kriteria ' + auto1a5.crit + ' = ' + auto1a5.aksi + ')'
                  });
                  SCORES_MAP['1.a.5'] = savedScoreInd;
                  hasScore = true;
                }
              }

              if (ind.code === '1.a.6') {
                var auto1a6 = getAutoScore_1_a_6(savedScoreInd.detail_json ? (typeof savedScoreInd.detail_json === 'string' ? JSON.parse(savedScoreInd.detail_json) : savedScoreInd.detail_json) : null);
                if (!hasScore || (parseFloat(savedScoreInd.bobot_capaian) !== 0.5 && parseFloat(savedScoreInd.bobot_capaian) !== 1.0)) {
                  savedScoreInd = Object.assign(savedScoreInd, {
                    bobot_capaian: auto1a6.score,
                    opsi_aksi: auto1a6.aksi,
                    catatan: 'Otomatis dihitung dari keselarasan Target SPM Daerah terhadap PP No. 2 Tahun 2018 (Rata-rata Terbobot: ' + auto1a6.avg.toFixed(2) + ', Kriteria ' + auto1a6.crit + ' = ' + auto1a6.aksi + ')'
                  });
                  SCORES_MAP['1.a.6'] = savedScoreInd;
                  hasScore = true;
                }
              }

              var currentScoreVal = hasSub ? calculatedScores[ind.code] : (hasScore ? savedScoreInd.bobot_capaian : "");
              var hasVerifInd = savedScoreInd.bobot_verifikator !== null && savedScoreInd.bobot_verifikator !== undefined && savedScoreInd.bobot_verifikator !== "";

              var trInd = document.createElement("tr");
              trInd.className = "type-indikator";

              var cellInputOrBadge = hasSub ? 
                '<span class="badge-sum-score">' + numFmt(calculatedScores[ind.code] || 0) + '</span>' :
                '<input type="number" step="0.001" min="0" max="' + ind.bobot + '" class="input-bobot-cell" data-code="' + ind.code + '" data-max="' + ind.bobot + '" value="' + currentScoreVal + '" placeholder="0">';

              var directActionHtml = hasSub ? 
                '<span style="font-size:11.5px; color:#047857; font-weight:600;"><i class="fa fa-list"></i> ' + ind.sub.length + ' Sub-Indikator</span>' :
                (IS_VERIFIKATOR ?
                  renderVerifikatorActionButton(ind.code, savedScoreInd) :
                  '<button type="button" class="btn-action-detail ' + (hasScore ? 'has-score' : '') + '" data-code="' + ind.code + '" title="Buka lembar kerja penilaian detail">' +
                    '<i class="fa ' + (hasScore ? 'fa-check-square' : 'fa-pencil-square-o') + '"></i> ' +
                    (hasScore ? 'Detail (' + numFmt(savedScoreInd.bobot_capaian) + ')' : 'Detail Penilaian') +
                  '</button>'
                );

              var verifActionHtml = hasSub ?
                '<span class="badge-verif-subtotal" title="Total Nilai Verifikator Indikator ' + ind.no + '"><i class="fa fa-shield"></i> ' + numFmt(calculatedVerif[ind.code] || 0) + '</span>' :
                renderVerifikatorStatusBadge(ind.code, savedScoreInd);

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
                  if (sub.code === '1.a.1.a' && !hasSubScore) {
                    var auto1a1a = getAutoScore_1_a_1_a();
                    savedScoreSub = {
                      bobot_capaian: auto1a1a.score,
                      opsi_aksi: auto1a1a.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a1a.score > 0 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.1.b' && !hasSubScore) {
                    var auto1a1b = getAutoScore_1_a_1_b();
                    savedScoreSub = {
                      bobot_capaian: auto1a1b.score,
                      opsi_aksi: auto1a1b.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : 'Belum Memenuhi'
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.1.c' && !hasSubScore) {
                    var auto1a1c = getAutoScore_1_a_1_c();
                    savedScoreSub = {
                      bobot_capaian: auto1a1c.score,
                      opsi_aksi: auto1a1c.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a1c.score > 0 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.1.d' && !hasSubScore) {
                    var auto1a1d = getAutoScore_1_a_1_d();
                    savedScoreSub = {
                      bobot_capaian: auto1a1d.score,
                      opsi_aksi: auto1a1d.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : 'Belum Memenuhi'
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.2.a' && !hasSubScore) {
                    var auto1a2a = getAutoScore_1_a_2_a();
                    savedScoreSub = {
                      bobot_capaian: auto1a2a.score,
                      opsi_aksi: auto1a2a.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a2a.score >= 0.225 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.2.b' && !hasSubScore) {
                    var auto1a2b = getAutoScore_1_a_2_b();
                    savedScoreSub = {
                      bobot_capaian: auto1a2b.score,
                      opsi_aksi: auto1a2b.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a2b.score >= 0.225 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.2.c' && !hasSubScore) {
                    var auto1a2c = getAutoScore_1_a_2_c();
                    savedScoreSub = {
                      bobot_capaian: auto1a2c.score,
                      opsi_aksi: auto1a2c.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a2c.score >= 0.225 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.2.d' && !hasSubScore) {
                    var auto1a2d = getAutoScore_1_a_2_d();
                    savedScoreSub = {
                      bobot_capaian: auto1a2d.score,
                      opsi_aksi: auto1a2d.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a2d.score >= 0.225 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  if (sub.code === '1.a.2.e' && !hasSubScore) {
                    var auto1a2e = getAutoScore_1_a_2_e();
                    savedScoreSub = {
                      bobot_capaian: auto1a2e.score,
                      opsi_aksi: auto1a2e.score >= sub.bobot ? 'Memenuhi Sepenuhnya' : (auto1a2e.score >= 0.225 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')
                    };
                    hasSubScore = true;
                  }
                  var currentSubScore = hasSubScore ? savedScoreSub.bobot_capaian : "";
                  var hasSubVerif = savedScoreSub.bobot_verifikator !== null && savedScoreSub.bobot_verifikator !== undefined && savedScoreSub.bobot_verifikator !== "";

                  var verifSubHtml = renderVerifikatorStatusBadge(sub.code, savedScoreSub);

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
                      (IS_VERIFIKATOR ?
                        renderVerifikatorActionButton(sub.code, savedScoreSub) :
                        '<button type="button" class="btn-action-detail ' + (hasSubScore ? 'has-score' : '') + '" data-code="' + sub.code + '" title="Buka lembar kerja penilaian detail">' +
                          '<i class="fa ' + (hasSubScore ? 'fa-check-square' : 'fa-pencil-square-o') + '"></i> ' +
                          (hasSubScore ? 'Detail (' + numFmt(savedScoreSub.bobot_capaian) + ')' : 'Detail Penilaian') +
                        '</button>'
                      ) +
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
  // STANDARDIZED CRITERIA CARD COMPONENT (Same style across all IPPD points)
  // =========================================================================
  function renderStandardCriteriaCard(cfg) {
    var safeId = cfg.safeId;
    var code = cfg.code;
    var title = cfg.title || ('Keterangan & Kriteria Penilaian Poin ' + code);
    var badgeText = cfg.badgeText || 'Evaluasi Penilaian';
    var colTitle = cfg.colTitle || ('Kriteria Penilaian Poin ' + code);
    var rows = cfg.rows || [];
    var sourceTitle = cfg.sourceTitle || 'Hasil Kelengkapan Sinkronisasi Form Terkait';
    var infoRows = cfg.infoRows || [];
    var initialScore = cfg.initialScore !== undefined ? numFmt(cfg.initialScore) : '-';

    var html = 
      '<div class="ws-criteria-card-standard" style="margin-top:16px; border:1px solid #e2e8f0; border-radius:8px; background:#ffffff; box-shadow:0 1px 3px rgba(0,0,0,0.05); overflow:hidden;">' +
        '<div style="background:#f8fafc; padding:10px 14px; border-bottom:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center;">' +
          '<div style="font-weight:700; font-size:12.5px; color:#1e293b; display:flex; align-items:center; gap:6px;">' +
            '<i class="fa fa-info-circle" style="color:#2563eb;"></i> ' + title +
          '</div>' +
          '<div id="' + safeId + 'CriteriaBadge" style="font-size:11.5px; font-weight:700; padding:3px 10px; border-radius:20px; background:#f1f5f9; color:#475569; border:1px solid #cbd5e1;">' +
            badgeText +
          '</div>' +
        '</div>' +
        '<div style="padding:14px; display:flex; gap:20px; flex-wrap:wrap;">' +
          '<div style="flex:1.4; min-width:380px;">' +
            '<table style="width:100%; border-collapse:collapse; font-size:11.5px; border:1px solid #cbd5e1;">' +
              '<thead>' +
                '<tr style="background:#f1f5f9; color:#334155;">' +
                  '<th style="border:1px solid #cbd5e1; padding:7px 10px; text-align:left; font-weight:700;">' + colTitle + '</th>' +
                  '<th style="border:1px solid #cbd5e1; padding:7px 10px; text-align:center; width:100px; min-width:100px; font-weight:700;">Nilai</th>' +
                '</tr>' +
              '</thead>' +
              '<tbody>';

    rows.forEach(function(r) {
      var critLetter = r.crit;
      var critText = r.text;
      var critVal = r.val;
      var critColor = r.color || '#1e293b';

      html += 
        '<tr id="' + safeId + 'CritRow_' + critLetter + '" style="transition:background 0.2s;">' +
          '<td style="border:1px solid #cbd5e1; padding:6px 10px; color:#1e293b;">' +
            '<span class="crit-icon" style="margin-right:4px;"></span><strong>' + critLetter + '.</strong> ' + critText +
          '</td>' +
          '<td style="border:1px solid #cbd5e1; padding:6px 10px; text-align:center; font-weight:700; color:' + critColor + ';">' +
            critVal +
          '</td>' +
        '</tr>';
    });

    html += 
              '</tbody>' +
            '</table>';

    if (cfg.notes && Array.isArray(cfg.notes) && cfg.notes.length > 0) {
      html += 
        '<div style="margin-top:10px; padding:8px 12px; background:#f8fafc; border-left:3px solid #3b82f6; border-radius:4px; font-size:11.5px; color:#334155; line-height:1.6;">';
      cfg.notes.forEach(function(nt) {
        html += '<div style="margin-bottom:2px;"><i class="fa fa-info-circle" style="color:#3b82f6; margin-right:5px; font-size:11px;"></i>' + nt + '</div>';
      });
      html += '</div>';
    }

    html += 
          '</div>' +
          '<div style="flex:1; min-width:280px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px; font-size:12px;">' +
            '<div style="font-weight:700; color:#0f172a; margin-bottom:8px; display:flex; align-items:center; gap:6px;">' +
              '<i class="fa fa-sliders" style="color:#0ea5e9;"></i> ' + sourceTitle +
            '</div>';

    infoRows.forEach(function(ir) {
      var idAttr = ir.id ? ' id="' + ir.id + '"' : '';
      html += 
        '<div style="display:flex; justify-content:space-between; padding:4px 0; border-bottom:1px solid #e2e8f0;">' +
          '<span style="color:#64748b;">' + ir.label + '</span>' +
          '<strong' + idAttr + ' style="color:#0f172a;">' + (ir.value || '-') + '</strong>' +
        '</div>';
    });

    html += 
            '<div style="display:flex; justify-content:space-between; align-items:center; padding-top:6px; margin-top:2px;">' +
              '<span style="color:#64748b; font-weight:600;">Nilai Capaian Otomatis:</span>' +
              '<strong id="' + safeId + 'GeneratedScore" style="color:#16a34a; font-size:14px;">' + initialScore + '</strong>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>';

    return html;
  }

  function updateStandardCriteriaHighlight(safeId, currentCrit, currentScore, infoMap, allLetters) {
    allLetters = allLetters || ['A', 'B', 'C', 'D', 'E'];
    allLetters.forEach(function(c) {
      var row = document.getElementById(safeId + "CritRow_" + c);
      if (row) {
        var icon = row.querySelector(".crit-icon");
        if (c === currentCrit) {
          row.style.background = '#dcfce7';
          row.style.fontWeight = '700';
          if (icon) icon.innerHTML = '<i class="fa fa-check-circle" style="color:#15803d; font-size:12px;"></i> ';
        } else {
          row.style.background = 'transparent';
          row.style.fontWeight = 'normal';
          if (icon) icon.innerHTML = '';
        }
      }
    });

    var badge = document.getElementById(safeId + "CriteriaBadge");
    if (badge) {
      badge.innerHTML = '<i class="fa fa-tag"></i> Kriteria ' + currentCrit + ' : Nilai ' + numFmt(currentScore);
      var isPassing = (allLetters && allLetters.length === 2) ? (currentCrit === 'B') : (currentCrit === 'E' || currentCrit === 'D');
      badge.style.background = isPassing ? '#dcfce7' : (currentCrit === 'C' ? '#e0f2fe' : (currentCrit === 'B' ? '#fef3c7' : '#fee2e2'));
      badge.style.color = isPassing ? '#15803d' : (currentCrit === 'C' ? '#0369a1' : (currentCrit === 'B' ? '#b45309' : '#b91c1c'));
      badge.style.border = isPassing ? '1px solid #86efac' : (currentCrit === 'C' ? '1px solid #7dd3fc' : (currentCrit === 'B' ? '1px solid #fde68a' : '1px solid #fca5a5'));
    }

    if (infoMap) {
      Object.keys(infoMap).forEach(function(elId) {
        var el = document.getElementById(elId);
        if (el) {
          if (typeof infoMap[elId] === 'string' && infoMap[elId].indexOf('<') !== -1) {
            el.innerHTML = infoMap[elId];
          } else {
            el.textContent = infoMap[elId];
          }
        }
      });
    }

    var scoreEl = document.getElementById(safeId + "GeneratedScore");
    if (scoreEl) {
      scoreEl.textContent = numFmt(currentScore);
    }
  }

  // =========================================================================
  // WORKSHEET RENDERERS (Exact replicas of the 21 Excel Sheet HTML Templates)
  // =========================================================================

  // 1. Sheet 1.a.1.a (LPE, TK, TPT - RPJMN vs RPJMD)
  function renderWs_1_a_1_a(d, maxBobot){
    d = d || {};
    var rowsData = [
      { id: 'lpe', name: 'Laju Pertumbuhan Ekonomi (LPE)', unit: 'Persen', isPositive: true,
        mn_base: (d.lpe_mn_base !== undefined && String(d.lpe_mn_base).trim() !== '') ? d.lpe_mn_base : (AUTO_DATA_1_A_1_A.mn_lpe_base || ''),
        mn_end:  (d.lpe_mn_end  !== undefined && String(d.lpe_mn_end).trim() !== '')  ? d.lpe_mn_end  : (AUTO_DATA_1_A_1_A.mn_lpe_end || ''),
        md_base: (d.lpe_md_base !== undefined && String(d.lpe_md_base).trim() !== '') ? d.lpe_md_base : (AUTO_DATA_1_A_1_A.md_lpe_base || ''),
        md_end:  (d.lpe_md_end  !== undefined && String(d.lpe_md_end).trim() !== '')  ? d.lpe_md_end  : (AUTO_DATA_1_A_1_A.md_lpe_end || '') },
      { id: 'tk', name: 'Tingkat Kemiskinan (TK)', unit: 'Persen', isPositive: true,
        mn_base: (d.tk_mn_base !== undefined && String(d.tk_mn_base).trim() !== '') ? d.tk_mn_base : (AUTO_DATA_1_A_1_A.mn_tk_base || ''),
        mn_end:  (d.tk_mn_end  !== undefined && String(d.tk_mn_end).trim() !== '')  ? d.tk_mn_end  : (AUTO_DATA_1_A_1_A.mn_tk_end || ''),
        md_base: (d.tk_md_base !== undefined && String(d.tk_md_base).trim() !== '') ? d.tk_md_base : (AUTO_DATA_1_A_1_A.md_tk_base || ''),
        md_end:  (d.tk_md_end  !== undefined && String(d.tk_md_end).trim() !== '')  ? d.tk_md_end  : (AUTO_DATA_1_A_1_A.md_tk_end || '') },
      { id: 'tpt', name: 'Tingkat Pengangguran Terbuka (TPT)', unit: 'Persen', isPositive: false,
        mn_base: (d.tpt_mn_base !== undefined && String(d.tpt_mn_base).trim() !== '') ? d.tpt_mn_base : (AUTO_DATA_1_A_1_A.mn_tpt_base || ''),
        mn_end:  (d.tpt_mn_end  !== undefined && String(d.tpt_mn_end).trim() !== '')  ? d.tpt_mn_end  : (AUTO_DATA_1_A_1_A.mn_tpt_end || ''),
        md_base: (d.tpt_md_base !== undefined && String(d.tpt_md_base).trim() !== '') ? d.tpt_md_base : (AUTO_DATA_1_A_1_A.md_tpt_base || ''),
        md_end:  (d.tpt_md_end  !== undefined && String(d.tpt_md_end).trim() !== '')  ? d.tpt_md_end  : (AUTO_DATA_1_A_1_A.md_tpt_end || '') }
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

    // Keterangan di bawah tabel: Range Nilai sesuai kriteria evaluasi
    html += renderStandardCriteriaCard({
      code: '1.a.1.a',
      safeId: 'ws1a1a',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.1.a',
      badgeText: 'Evaluasi Data Sinkronisasi',
      colTitle: 'Kriteria Kesesuaian dengan PN RPJMN',
      rows: [
        { crit: 'A', text: 'Tidak ada keterkaitan', val: '0', color: '#475569' },
        { crit: 'B', text: 'Kurang dari 50% sesuai dengan PN RPJMN', val: '0,3', color: '#d97706' },
        { crit: 'C', text: 'Di atas atau sama dengan 50% sesuai dengan PN RPJMN', val: '0,5', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Data',
      infoRows: [
        { label: 'Indikator Sesuai:', id: 'ws1a1aCountMatched', value: '-' },
        { label: 'Persentase Keterkaitan:', id: 'ws1a1aPctMatched', value: '-%' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a1aCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.1.a berdasarkan kelengkapan sinkronisasi data
  function getAutoScore_1_a_1_a(d){
    d = d || {};
    var lpe_base = (d.lpe_md_base !== undefined && String(d.lpe_md_base).trim() !== '') ? d.lpe_md_base : (AUTO_DATA_1_A_1_A.md_lpe_base || '');
    var lpe_end  = (d.lpe_md_end  !== undefined && String(d.lpe_md_end).trim() !== '')  ? d.lpe_md_end  : (AUTO_DATA_1_A_1_A.md_lpe_end || '');
    var tk_base  = (d.tk_md_base  !== undefined && String(d.tk_md_base).trim() !== '')  ? d.tk_md_base  : (AUTO_DATA_1_A_1_A.md_tk_base || '');
    var tk_end   = (d.tk_md_end   !== undefined && String(d.tk_md_end).trim() !== '')   ? d.tk_md_end   : (AUTO_DATA_1_A_1_A.md_tk_end || '');
    var tpt_base = (d.tpt_md_base !== undefined && String(d.tpt_md_base).trim() !== '') ? d.tpt_md_base : (AUTO_DATA_1_A_1_A.md_tpt_base || '');
    var tpt_end  = (d.tpt_md_end  !== undefined && String(d.tpt_md_end).trim() !== '')  ? d.tpt_md_end  : (AUTO_DATA_1_A_1_A.md_tpt_end || '');

    var items = [
      { id: 'lpe', hasData: (String(lpe_base).trim() !== '' || String(lpe_end).trim() !== '') },
      { id: 'tk',  hasData: (String(tk_base).trim() !== ''  || String(tk_end).trim() !== '') },
      { id: 'tpt', hasData: (String(tpt_base).trim() !== '' || String(tpt_end).trim() !== '') }
    ];

    var matched = items.filter(function(i){ return i.hasData; }).length;
    var total = items.length;
    var pct = total > 0 ? (matched / total) * 100 : 0;

    var crit = 'A';
    var score = 0;
    var label = 'A. Tidak ada keterkaitan';

    if (matched === 0) {
      crit = 'A';
      score = 0;
      label = 'A. Tidak ada keterkaitan';
    } else if (pct < 50) {
      crit = 'B';
      score = 0.3;
      label = 'B. Kurang dari 50% sesuai dengan PN RPJMN';
    } else {
      crit = 'C';
      score = 0.5;
      label = 'C. Di atas atau sama dengan 50% sesuai dengan PN RPJMN';
    }

    return {
      matched: matched,
      total: total,
      pct: pct,
      crit: crit,
      score: score,
      label: label
    };
  }

  // Helper untuk menghitung capaian otomatis 1.a.1.b berdasarkan ketersediaan tabel persandingan
  function getAutoScore_1_a_1_b(d){
    d = d || {};
    var curVal = (d.status_tabel !== undefined && String(d.status_tabel).trim() !== '') ? d.status_tabel : 
                 (AUTO_DATA_1_A_1_B.status_tabel !== undefined ? AUTO_DATA_1_A_1_B.status_tabel : 
                 (d.avail == '0' ? 'Tidak Ada' : 'Ada'));
    var isAda = (curVal === 'Ada');
    var score = isAda ? 0.5 : 0.0;
    var crit = isAda ? 'B' : 'A';
    var label = isAda ? 'B. Ada' : 'A. Tidak ada';

    return {
      status_tabel: curVal,
      isAda: isAda,
      crit: crit,
      score: score,
      label: label,
      dokumen: d.dokumen !== undefined ? d.dokumen : (AUTO_DATA_1_A_1_B.dokumen || (isAda ? 'RPJMD' : '')),
      halaman: d.halaman !== undefined ? d.halaman : (AUTO_DATA_1_A_1_B.halaman || (isAda ? 'Bab IV' : '')),
      tabel: d.tabel !== undefined ? d.tabel : (AUTO_DATA_1_A_1_B.tabel || (isAda ? 'Tabel Persandingan Sasaran RPJMD dengan PN RPJMN' : '')),
      catatan: d.catatan !== undefined ? d.catatan : (AUTO_DATA_1_A_1_B.catatan || ''),
      screenshot: d.screenshot !== undefined ? d.screenshot : (AUTO_DATA_1_A_1_B.screenshot || '')
    };
  }

  // 2. Sheet 1.a.1.b (Tabel Persandingan Sasaran RPJMD vs PN RPJMN)
  function renderWs_1_a_1_b(d, maxBobot){
    d = d || {};
    var autoObj = getAutoScore_1_a_1_b(d);
    var curVal = (d.status_tabel !== undefined && String(d.status_tabel).trim() !== '') ? d.status_tabel : autoObj.status_tabel;
    var isAda = (curVal === 'Ada');
    var curCatatan = d.catatan !== undefined ? d.catatan : autoObj.catatan;
    var curScore   = isAda ? maxBobot : 0.0;

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.1.b</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Penarikan Data Otomatis</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_b" style="width: 100%; min-width: 750px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-green" style="width: 45%; text-align:left;">Parameter Pemeriksaan Dokumen (RPJMD)</th>' +
            '<th class="th-blue" style="width: 20%; text-align:center;">Status Ketersediaan</th>' +
            '<th class="th-green" style="width: 15%; text-align:center;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 20%; text-align:left;">Catatan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr>' +
            '<td class="excel-row-num">1</td>' +
            '<td>' +
              '<strong style="color:#0f172a; font-size:12px;">Tabel Persandingan antara Sasaran Pembangunan Daerah RPJMD dengan PN RPJMN</strong>' +
            '</td>' +
            '<td>' +
              '<select id="wsSelectPersandingan" class="calc-inp" style="font-weight:700; color:' + (isAda ? '#107c41' : '#dc2626') + '; width:100%; padding:6px 8px; border-radius:4px; border:1px solid #cbd5e1;">' +
                '<option value="Ada"' + (isAda ? ' selected' : '') + '>B. Ada (Tersedia)</option>' +
                '<option value="Tidak Ada"' + (!isAda ? ' selected' : '') + '>A. Tidak Ada</option>' +
              '</select>' +
            '</td>' +
            '<td style="text-align:center; font-weight:700; font-size:13.5px; color:' + (isAda ? '#16a34a' : '#dc2626') + ';">' +
              '<span id="ws1a1bTerbobotCell">' + numFmt(curScore) + '</span>' +
            '</td>' +
            '<td>' +
              '<input type="text" id="ws1a1bCatatan" class="calc-inp" value="' + escapeHtml(curCatatan) + '" placeholder="Catatan ketersediaan tabel..." style="width:100%; font-size:11.5px; padding:6px 8px; border:1px solid #cbd5e1; border-radius:4px;">' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan di bawah tabel: Range Nilai sesuai kriteria evaluasi (A: 0, B: 0,5)
    html += renderStandardCriteriaCard({
      code: '1.a.1.b',
      safeId: 'ws1a1b',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.1.b',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Ketersediaan Tabel Persandingan',
      rows: [
        { crit: 'A', text: 'Tidak ada', val: '0', color: '#dc2626' },
        { crit: 'B', text: 'Ada', val: '0,5', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Status Ketersediaan:', id: 'ws1a1bStatusText', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a1bCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.1.d berdasarkan ketersediaan tabel persandingan prioritas
  function getAutoScore_1_a_1_d(d){
    d = d || {};
    var curVal = (d.status_tabel !== undefined && String(d.status_tabel).trim() !== '') ? d.status_tabel : 
                 (AUTO_DATA_1_A_1_D.status_tabel !== undefined ? AUTO_DATA_1_A_1_D.status_tabel : 
                 (d.avail == '0' ? 'Tidak Ada' : 'Ada'));
    var isAda = (curVal === 'Ada');
    var score = isAda ? 0.5 : 0.0;
    var crit = isAda ? 'B' : 'A';
    var label = isAda ? 'B. Ada' : 'A. Tidak ada';

    return {
      status_tabel: curVal,
      isAda: isAda,
      crit: crit,
      score: score,
      label: label,
      catatan: d.catatan !== undefined ? d.catatan : (AUTO_DATA_1_A_1_D.catatan || '')
    };
  }

  // 2b. Sheet 1.a.1.d (Tabel Persandingan Prioritas Daerah RPJMD vs PN RPJMN)
  function renderWs_1_a_1_d(d, maxBobot){
    d = d || {};
    var autoObj = getAutoScore_1_a_1_d(d);
    var curVal = (d.status_tabel !== undefined && String(d.status_tabel).trim() !== '') ? d.status_tabel : autoObj.status_tabel;
    var isAda = (curVal === 'Ada');
    var curCatatan = d.catatan !== undefined ? d.catatan : autoObj.catatan;
    var curScore   = isAda ? maxBobot : 0.0;

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.1.d</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Penarikan Data Otomatis</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_d" style="width: 100%; min-width: 750px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-green" style="width: 45%; text-align:left;">Parameter Pemeriksaan Dokumen (RPJMD)</th>' +
            '<th class="th-blue" style="width: 20%; text-align:center;">Status Ketersediaan</th>' +
            '<th class="th-green" style="width: 15%; text-align:center;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 20%; text-align:left;">Catatan</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr>' +
            '<td class="excel-row-num">1</td>' +
            '<td>' +
              '<strong style="color:#0f172a; font-size:12px;">Tabel Persandingan antara Prioritas Pembangunan Daerah RPJMD dengan PN RPJMN</strong>' +
            '</td>' +
            '<td>' +
              '<select id="wsSelectPersandingan1d" class="calc-inp" style="font-weight:700; color:' + (isAda ? '#107c41' : '#dc2626') + '; width:100%; padding:6px 8px; border-radius:4px; border:1px solid #cbd5e1;">' +
                '<option value="Ada"' + (isAda ? ' selected' : '') + '>B. Ada (Tersedia)</option>' +
                '<option value="Tidak Ada"' + (!isAda ? ' selected' : '') + '>A. Tidak Ada</option>' +
              '</select>' +
            '</td>' +
            '<td style="text-align:center; font-weight:700; font-size:13.5px; color:' + (isAda ? '#16a34a' : '#dc2626') + ';">' +
              '<span id="ws1a1dTerbobotCell">' + numFmt(curScore) + '</span>' +
            '</td>' +
            '<td>' +
              '<input type="text" id="ws1a1dCatatan" class="calc-inp" value="' + escapeHtml(curCatatan) + '" placeholder="Catatan ketersediaan tabel..." style="width:100%; font-size:11.5px; padding:6px 8px; border:1px solid #cbd5e1; border-radius:4px;">' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan di bawah tabel: Range Nilai sesuai kriteria evaluasi (A: 0, B: 0,5)
    html += renderStandardCriteriaCard({
      code: '1.a.1.d',
      safeId: 'ws1a1d',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.1.d',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Ketersediaan Tabel Persandingan',
      rows: [
        { crit: 'A', text: 'Tidak ada', val: '0', color: '#dc2626' },
        { crit: 'B', text: 'Ada', val: '0,5', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Status Ketersediaan:', id: 'ws1a1dStatusText', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a1dCritText', value: '-' }
      ]
    });

    return html;
  }

  function renderWs_TabelPersandingan(code, d, maxBobot){
    return renderWs_1_a_1_d(d, maxBobot);
  }

  // Helper untuk menghitung capaian otomatis 1.a.1.c berdasarkan keselarasan Prioritas Daerah vs Prioritas Nasional
  function getAutoScore_1_a_1_c(d){
    d = d || {};
    var pns = d.pn_list || (AUTO_DATA_1_A_1_C && AUTO_DATA_1_A_1_C.length > 0 ? AUTO_DATA_1_A_1_C : []);
    var total = pns.length > 0 ? pns.length : 8;
    var matched = 0;

    pns.forEach(function(pn){
      var pds = pn.pds || [];
      var hasMatched = pds.some(function(pd){
        return (pd.score !== undefined && parseFloat(pd.score) > 0) || (pd.title && pd.title.trim() !== '' && !pd.title.toLowerCase().includes('tidak ada') && !pd.title.toLowerCase().includes('belum'));
      });
      if (hasMatched) matched++;
    });

    var pct = total > 0 ? (matched / total) * 100 : 0;
    var crit = 'A';
    var score = 0.0;
    var label = 'A. Tidak ada keterkaitan';

    if (matched === 0) {
      crit = 'A';
      score = 0.0;
      label = 'A. Tidak ada keterkaitan';
    } else if (pct < 50.0) {
      crit = 'B';
      score = 0.3;
      label = 'B. Kurang dari 50% sesuai dengan PN RPJMN';
    } else {
      crit = 'C';
      score = 0.5;
      label = 'C. Di atas atau sama dengan 50% sesuai dengan PN RPJMN';
    }

    return {
      pns: pns,
      matched: matched,
      total: total,
      pct: pct,
      crit: crit,
      score: score,
      label: label
    };
  }

  // 3. Sheet 1.a.1.c (Prioritas Pembangunan Daerah vs Prioritas Nasional RPJMN)
  function renderWs_1_a_1_c(d, maxBobot){
    d = d || {};
    var autoObj = getAutoScore_1_a_1_c(d);
    var pns = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : autoObj.pns;

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.1.c - Matriks Keselarasan PN RPJMN vs Prioritas Daerah (RPJMD)</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Penarikan Data Otomatis</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_c" style="width: 100%; min-width: 950px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 40px; text-align:center;">No</th>' +
            '<th class="th-blue" style="width: 26%;">RPJMN</th>' +
            '<th class="th-amber" style="width: 26%;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Nilai Keselarasan (0% / 100%)</th>' +
            '<th class="th-gray" rowspan="2" style="width: 18%;">Keterangan</th>' +
            '<th class="th-green" rowspan="2" style="width: 90px; text-align:center;">Nilai Keselarasan Rata-rata</th>' +
            '<th class="th-gray" rowspan="2" style="width: 65px; text-align:center;">Bobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 85px; text-align:center;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" rowspan="2" style="width: 14%;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-amber">Prioritas Pembangunan Daerah</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!pns || pns.length === 0){
      html += '<tr><td colspan="9" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data Prioritas Daerah vs Prioritas Nasional pada menu terkait. Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr>';
    } else {
      var rowCounter = 1;
      pns.forEach(function(pn, pnIdx){
        var pdsToRender = (pn.pds && pn.pds.length > 0) ? pn.pds : [{ title: '', score: 0, ket: 'Tidak ada Prioritas Pembangunan Daerah untuk mendukung Prioritas Pembangunan Nasional terkait' }];
        var pdCount = pdsToRender.length;
        var hasMatchPn = pdsToRender.some(function(p){ return (p.score !== undefined && parseFloat(p.score) > 0) || (p.title && p.title.trim() !== ''); });
        var pnTitleClean = pn.pn_title || ('Prioritas Nasional ' + (pnIdx + 1));

        pdsToRender.forEach(function(pd, pdIdx){
          var curScore = (pd.score !== undefined) ? parseFloat(pd.score) : 0;
          var curTitle = pd.title || '';
          var curKet = pd.ket || (curScore > 0 ? 'Terdapat Prioritas Pembangunan Daerah untuk mendukung Prioritas Pembangunan Nasional terkait' : 'Tidak ada Prioritas Pembangunan Daerah untuk mendukung Prioritas Pembangunan Nasional terkait');

          html += '<tr class="ws-matrix-row" data-pn-idx="' + pnIdx + '" data-pd-idx="' + pdIdx + '">';

          if (pdIdx === 0){
            html += 
              '<td class="excel-row-num" rowspan="' + pdCount + '" style="text-align:center; vertical-align:top; font-weight:bold;">' + (pnIdx + 1) + '</td>' +
              '<td rowspan="' + pdCount + '" class="cell-pn-wrap" style="vertical-align:top; background:#f0f7ff; padding:8px;">' +
                '<input type="hidden" class="pn-title-inp" value="' + escapeHtml(pnTitleClean) + '">' +
                '<div style="font-size:12px; line-height:1.45; color:#1e3a8a;">' +
                  '<strong>PN ' + (pnIdx + 1) + ' :</strong> ' + escapeHtml(pnTitleClean.replace(/^PN\s*\d+\s*:\s*/i, '')) +
                '</div>' +
              '</td>';
          }

          html += 
            '<td style="vertical-align:top; padding:6px 8px;">' +
              '<textarea class="calc-inp pd-title-inp" rows="2" style="width:100%; font-size:11.5px; background:transparent; border:none; resize:vertical;" placeholder="Tidak ada PD..." readonly>' + escapeHtml(curTitle) + '</textarea>' +
            '</td>' +
            '<td style="vertical-align:middle; text-align:center; padding:4px 6px;">' +
              '<select class="calc-inp pd-score-sel" style="font-weight:700; width:100%; font-size:11.5px; padding:4px; border-radius:4px; border:1px solid #cbd5e1; color:' + (curScore > 0 ? '#16a34a' : '#dc2626') + ';">' +
                '<option value="1.0"' + (curScore > 0 ? ' selected' : '') + '>100.00%</option>' +
                '<option value="0.0"' + (curScore == 0 ? ' selected' : '') + '>0.00%</option>' +
              '</select>' +
            '</td>' +
            '<td style="vertical-align:top; padding:6px 8px;">' +
              '<textarea class="calc-inp pd-ket-inp" rows="2" style="width:100%; font-size:11px; background:transparent; border:none; resize:vertical;" placeholder="Keterangan keselarasan...">' + escapeHtml(curKet) + '</textarea>' +
            '</td>';

          if (pdIdx === 0){
            html += 
              '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#fafafa; font-weight:700;">' +
                '<span class="pn-avg-cell" style="font-size:12px; color:#1e293b;">' + (hasMatchPn ? '100%' : '0%') + '</span>' +
              '</td>' +
              '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#fafafa; color:#64748b; font-weight:600; font-size:11.5px;">' +
                numFmt(maxBobot) +
              '</td>' +
              '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#fafafa; font-weight:700;">' +
                '<span class="pn-terbobot-cell" style="font-size:12px; color:' + (hasMatchPn ? '#16a34a' : '#dc2626') + ';">' + numFmt(hasMatchPn ? maxBobot : 0) + '</span>' +
              '</td>' +
              '<td rowspan="' + pdCount + '" style="vertical-align:top; padding:6px 8px;">' +
                '<input type="text" class="calc-inp pn-catatan-inp" value="' + escapeHtml(pn.catatan || '') + '" placeholder="Catatan..." style="width:100%; font-size:11px; padding:5px 7px; border:1px solid #cbd5e1; border-radius:4px;">' +
              '</td>';
          }

          html += '</tr>';
        });
      });
    }

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:bold; border-top:2px solid #cbd5e1;">' +
            '<td class="excel-row-num" style="text-align:center;"></td>' +
            '<td colspan="4" style="text-align:right; padding:9px 12px; color:#1e293b; font-size:12px;">Rata-rata Nilai Keselarasan:</td>' +
            '<td style="text-align:center; padding:9px; font-size:13px; color:#dc2626; font-weight:bold;">' +
              '<span id="ws1a1cAvgPctCell">' + autoObj.pct.toFixed(2) + '%</span>' +
            '</td>' +
            '<td style="text-align:center; color:#64748b; font-size:11px;">Rata-rata Terbobot:</td>' +
            '<td style="text-align:center; padding:9px; font-size:13px; color:#0f172a; font-weight:bold;">' +
              '<span id="ws1a1cGrandTerbobot">' + numFmt((autoObj.matched * maxBobot) / (autoObj.total || 8)) + '</span>' +
            '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '</div>';

    // Keterangan di bawah tabel: Range Nilai sesuai kriteria evaluasi (A: 0, B: 0.3, C: 0.5)
    html += renderStandardCriteriaCard({
      code: '1.a.1.c',
      safeId: 'ws1a1c',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.1.c',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Keselarasan Prioritas Daerah dengan PN RPJMN',
      rows: [
        { crit: 'A', text: 'Tidak ada keterkaitan sasaran daerah', val: '0', color: '#dc2626' },
        { crit: 'B', text: 'Kurang dari 50% sesuai dengan PN RPJMN', val: '0,3', color: '#d97706' },
        { crit: 'C', text: 'Di atas atau sama dengan 50% sesuai dengan PN RPJMN', val: '0,5', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Sinkronisasi Menu Keselarasan',
      infoRows: [
        { label: 'Jumlah PN Selaras:', id: 'ws1a1cCountMatched', value: '-' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a1cPctMatched', value: '-%' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a1cCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.2.a berdasarkan keselarasan PP PN 1
  function getAutoScore_1_a_2_a(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 (AUTO_DATA_1_A_2_A && AUTO_DATA_1_A_2_A.length > 0 ? AUTO_DATA_1_A_2_A : []);

    var totalRows = 0;
    var sumScore = 0;

    pnList.forEach(function(pn){
      (pn.pps || []).forEach(function(pp){
        (pp.pds || []).forEach(function(pd){
          totalRows++;
          var s = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          sumScore += s;
        });
      });
    });

    var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
    var pct = avgRatio * 100;
    var score = 0.375;
    var crit = 'E';
    var label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 1 RPJMN';

    if (totalRows === 0) {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 1 RPJMN';
    } else if (pct >= 100) {
      crit = 'E';
      score = 0.375;
      label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 1 RPJMN';
    } else if (pct > 75) {
      crit = 'D';
      score = 0.300;
      label = 'D. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 1 RPJMN';
    } else if (pct > 50) {
      crit = 'C';
      score = 0.225;
      label = 'C. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 1 RPJMN';
    } else if (pct > 25) {
      crit = 'B';
      score = 0.150;
      label = 'B. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 1 RPJMN';
    } else {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 1 RPJMN';
    }

    return {
      pnList: pnList,
      totalRows: totalRows,
      sumScore: sumScore,
      avgRatio: avgRatio,
      pct: pct,
      score: score,
      crit: crit,
      label: label
    };
  }

  // 4. Sheet 1.a.2.a (PN 1 Program Prioritas Pembangunan Nasional)
  function renderWs_1_a_2_a(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var autoObj = getAutoScore_1_a_2_a(d, maxBobot);
    var savedPpList = d.pp_list || [];
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 ((AUTO_DATA_1_A_2_A && AUTO_DATA_1_A_2_A.length > 0) ? AUTO_DATA_1_A_2_A : autoObj.pnList);
    
    if (!pnList || pnList.length === 0) {
      pnList = [{
        pn_title: 'PN 1 : Memperkokoh Ideologi Pancasila, Demokrasi, dan Hak Asasi Manusia',
        pps: [{
          pp_title: 'PP 2 : Penguatan Komunikasi Publik dan Media',
          pds: [{
            title: 'PROGRAM PENGELOLAAN INFORMASI DAN KOMUNIKASI PUBLIK',
            score: 1.0,
            ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait'
          }]
        }]
      }];
    }

    // Merge saved review & score into data
    if (pnList.length > 0 && savedPpList.length > 0) {
      pnList.forEach(function(pn){
        (pn.pps || []).forEach(function(pp) {
          var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
          if (savedPp) {
            (pp.pds || []).forEach(function(pd) {
              var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
              if (savedPd) {
                if (savedPd.ket) pd.ket = savedPd.ket;
                if (savedPd.score !== undefined) pd.score = savedPd.score;
              }
            });
          }
        });
      });
    }

    var grandTotalRows = 0;
    pnList.forEach(function(pn){
      var pps = (pn.pps && pn.pps.length > 0) ? pn.pps : [{ pds: [{}] }];
      pps.forEach(function(pp){
        grandTotalRows += (pp.pds && pp.pds.length > 0) ? pp.pds.length : 1;
      });
    });

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.2.a - Pemetaan Program Prioritas PN 1 RPJMN vs Program Daerah</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Sumber: /Daerah/DukunganKegiatanPrioritas (Program Prioritas)</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_a" style="width: 100%; min-width: 1050px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 45px; text-align:center;">No</th>' +
            '<th class="th-blue" colspan="2" style="text-align:center;">RPJMN</th>' +
            '<th class="th-amber" colspan="1" style="text-align:center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 140px; text-align:center;">Nilai Keselarasan<br>(0% / 100%)</th>' +
            '<th class="th-green" rowspan="2" style="width: 220px; text-align:center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 110px; text-align:center;">Nilai Keselarasan<br>Rata-rata</th>' +
            '<th class="th-gray" rowspan="2" style="width: 75px; text-align:center;">Bobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Keselarasan<br>Terbobot</th>' +
            '<th class="th-gray" rowspan="2" style="width: 140px; text-align:center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 240px; text-align:left;">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-blue" style="width: 240px; text-align:left;">Program Prioritas Pembangunan Nasional</th>' +
            '<th class="th-amber" style="width: 240px; text-align:left;">Dukungan Program Pembangunan Daerah</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 1;
    var isFirstGrandRow = true;

    pnList.forEach(function(pn, pnIdx) {
      var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [{}] }];
      var totalRowsForPn = pps.reduce(function(acc, pp) {
        return acc + (pp.pds && pp.pds.length > 0 ? pp.pds.length : 1);
      }, 0);

      pps.forEach(function(pp, ppIdx) {
        var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', score: 1.0, ket: '' }];
        var pdCount = pds.length;
        var globalPpIdx = pnIdx + "_" + ppIdx;

        pds.forEach(function(pd, pdIdx) {
          var sVal = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          var isSelaras = (sVal >= 1.0);
          var defaultKet = isSelaras ? 
            'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' : 
            'Tidak ada Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait';
          var curKet = pd.ket ? pd.ket : defaultKet;

          html += '<tr class="ws-pp-row" data-pp-idx="' + globalPpIdx + '">';
          html += '<td class="excel-row-num" style="text-align:center;">' + (rowCounter++) + '</td>';

          if (ppIdx === 0 && pdIdx === 0) {
            html += '<td rowspan="' + totalRowsForPn + '" class="cell-pn-wrap-2a" style="vertical-align:top; background:#f0f7ff; font-weight:700; color:#1e3a8a;">' +
                    escapeHtml(pn.pn_title) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2a" style="vertical-align:top; background:#f8fafc; font-weight:700; color:#0f172a;">' +
                    '<textarea class="calc-inp pp-title-inp" style="font-weight:700; color:#203764; width:100%; resize:none; border:none; background:transparent;" rows="3" readonly>' + escapeHtml(pp.pp_title) + '</textarea>' +
                    '</td>';
          }

          html += '<td style="vertical-align:middle;">' +
                    '<textarea class="calc-inp pd-title-inp" style="width:100%; font-weight:600; color:#334155; resize:none; border:none; background:transparent;" rows="2" readonly>' + escapeHtml(pd.title) + '</textarea>' +
                  '</td>';

          html += '<td style="vertical-align:middle; text-align:center;">' +
                    '<select class="calc-inp pd-score-sel" style="font-weight:700; color:' + (isSelaras ? '#16a34a' : '#dc2626') + '; width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:5px 6px;">' +
                      '<option value="1.0"' + (isSelaras ? ' selected' : '') + '>100.00%</option>' +
                      '<option value="0.0"' + (!isSelaras ? ' selected' : '') + '>0.00%</option>' +
                    '</select>' +
                  '</td>';

          html += '<td style="vertical-align:middle;">' +
                    '<input type="text" class="calc-inp pd-ket-inp" value="' + escapeHtml(curKet) + '" placeholder="Keterangan..." style="width:100%; font-size:11.5px; border:1px solid #cbd5e1; border-radius:4px; padding:5px 8px;">' +
                  '</td>';

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2aAvgCell" style="font-weight:700; font-size:13.5px; color:#1e3a8a;">100%</span>' +
                    '</td>';
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff; font-weight:700;">' +
                      numFmt(maxBobot) +
                    '</td>';
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2aTerbobotCell" style="font-weight:700; font-size:13.5px; color:#16a34a;">' + numFmt(maxBobot) + '</span>' +
                    '</td>';
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<input type="text" id="ws1a2aCatatan" class="calc-inp" value="' + escapeHtml(d.catatan || '') + '" placeholder="Catatan keselarasan..." style="width:100%; font-size:11.5px; border:1px solid #cbd5e1; border-radius:4px; padding:6px 8px;">' +
                    '</td>';
            isFirstGrandRow = false;
          }

          html += '</tr>';
        });
      });
    });

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan & Range Penilaian Poin 1.a.2.a di bawah tabel
    html += renderStandardCriteriaCard({
      code: '1.a.2.a',
      safeId: 'ws1a2a',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.2.a',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Dukungan Program Daerah terhadap Kegiatan Prioritas dalam PN 1 RPJMN',
      rows: [
        { crit: 'A', text: 'Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 1 RPJMN', val: '0,075', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 1 RPJMN', val: '0,150', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 1 RPJMN', val: '0,225', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 1 RPJMN', val: '0,300', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 1 RPJMN', val: '0,375', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Sumber Data:', value: '/Daerah/DukunganKegiatanPrioritas' },
        { label: 'Program Prioritas:', value: 'PN 1 RPJMN' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a2aPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a2aCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.2.b berdasarkan keselarasan PP PN 2
  function getAutoScore_1_a_2_b(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 (AUTO_DATA_1_A_2_B && AUTO_DATA_1_A_2_B.length > 0 ? AUTO_DATA_1_A_2_B : 
                 (AUTO_DATA_1_A_2_ALL && AUTO_DATA_1_A_2_ALL['1.a.2.b'] ? [AUTO_DATA_1_A_2_ALL['1.a.2.b']] : []));

    var totalRows = 0;
    var sumScore = 0;

    pnList.forEach(function(pn){
      (pn.pps || []).forEach(function(pp){
        (pp.pds || []).forEach(function(pd){
          totalRows++;
          var s = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          sumScore += s;
        });
      });
    });

    var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
    var pct = avgRatio * 100;
    var score = 0.375;
    var crit = 'E';
    var label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 2 RPJMN';

    if (totalRows === 0) {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan. atau kurang dari 25% terhadap kegiatan prioritas dalam PN 2 RPJMN';
    } else if (pct >= 100) {
      crit = 'E';
      score = 0.375;
      label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 2 RPJMN';
    } else if (pct > 75) {
      crit = 'D';
      score = 0.300;
      label = 'D. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 2 RPJMN';
    } else if (pct > 50) {
      crit = 'C';
      score = 0.225;
      label = 'C. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 2 RPJMN';
    } else if (pct > 25) {
      crit = 'B';
      score = 0.150;
      label = 'B. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 2 RPJMN';
    } else {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan. atau kurang dari 25% terhadap kegiatan prioritas dalam PN 2 RPJMN';
    }

    return {
      pnList: pnList,
      totalRows: totalRows,
      sumScore: sumScore,
      avgRatio: avgRatio,
      pct: pct,
      score: score,
      crit: crit,
      label: label
    };
  }

  // Sheet 1.a.2.b (PN 2 Program Prioritas Pembangunan Nasional) Sesuai Isian File HTML
  function renderWs_1_a_2_b(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var autoObj = getAutoScore_1_a_2_b(d, maxBobot);
    var savedPpList = d.pp_list || [];
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 ((AUTO_DATA_1_A_2_B && AUTO_DATA_1_A_2_B.length > 0) ? AUTO_DATA_1_A_2_B : autoObj.pnList);

    if (!pnList || pnList.length === 0) {
      pnList = [{
        pn_title: 'PN 2 : Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru',
        pps: [
          {
            pp_title: 'PP 10 : Swasembada Pangan',
            pds: [
              { title: 'PROGRAM PENGELOLAAN PERIKANAN TANGKAP', score: 1.0, ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' }
            ]
          }
        ]
      }];
    }

    // Merge saved review & score into data
    if (pnList.length > 0 && savedPpList.length > 0) {
      pnList.forEach(function(pn){
        (pn.pps || []).forEach(function(pp) {
          var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
          if (savedPp) {
            if (savedPp.keterangan) pp.keterangan = savedPp.keterangan;
            (pp.pds || []).forEach(function(pd) {
              var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
              if (savedPd) {
                if (savedPd.ket) pd.ket = savedPd.ket;
                if (savedPd.score !== undefined) pd.score = savedPd.score;
              }
            });
          }
        });
      });
    }

    var grandTotalRows = 0;
    pnList.forEach(function(pn){
      var pps = (pn.pps && pn.pps.length > 0) ? pn.pps : [{ pds: [{}] }];
      pps.forEach(function(pp){
        grandTotalRows += (pp.pds && pp.pds.length > 0) ? pp.pds.length : 1;
      });
    });

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.2.b - Pemetaan Program Prioritas PN 2 RPJMN vs Program Daerah</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Sumber: /Daerah/DukunganKegiatanPrioritas (Program Prioritas PN 2)</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_b" style="width: 100%; min-width: 1050px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 40px; text-align:center;">No</th>' +
            '<th class="th-blue" colspan="2" style="text-align:center;">RPJMN</th>' +
            '<th class="th-amber" colspan="1" style="text-align:center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Nilai Keselarasan<br>(0% / 100%)</th>' +
            '<th class="th-green" rowspan="2" style="width: 200px; text-align:center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 100px; text-align:center;">Nilai Keselarasan<br>Rata-rata</th>' +
            '<th class="th-gray" rowspan="2" style="width: 70px; text-align:center;">Bobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 100px; text-align:center;">Keselarasan<br>Terbobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Rata-rata Keselarasan<br>Terbobot</th>' +
            '<th class="th-gray" rowspan="2" style="width: 140px; text-align:center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 230px; text-align:left;">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-blue" style="width: 210px; text-align:left;">Program Prioritas Pembangunan Nasional</th>' +
            '<th class="th-amber" style="width: 230px; text-align:left;">Dukungan Program Pembangunan Daerah</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 1;
    var isFirstGrandRow = true;

    pnList.forEach(function(pn, pnIdx) {
      var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [{}] }];
      var totalRowsForPn = pps.reduce(function(acc, pp) {
        return acc + (pp.pds && pp.pds.length > 0 ? pp.pds.length : 1);
      }, 0);

      pps.forEach(function(pp, ppIdx) {
        var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', score: 1.0, ket: '' }];
        var pdCount = pds.length;
        var globalPpIdx = pnIdx + "_" + ppIdx;

        var ppSumScore = pds.reduce(function(acc, item){
          var s = (item.score !== undefined && item.score !== null) ? parseFloat(item.score) : 1.0;
          return acc + s;
        }, 0);
        var ppAvgRatio = pdCount > 0 ? (ppSumScore / pdCount) : 1.0;
        var ppTerbobotVal = ppAvgRatio * maxBobot;

        var defaultPpKet = pp.keterangan || 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait';

        pds.forEach(function(pd, pdIdx) {
          var sVal = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          var isSelaras = (sVal >= 1.0);

          html += '<tr class="ws-pp-row" data-pp-idx="' + globalPpIdx + '">';
          html += '<td class="excel-row-num" style="text-align:center;">' + (rowCounter++) + '</td>';

          if (ppIdx === 0 && pdIdx === 0) {
            html += '<td rowspan="' + totalRowsForPn + '" class="cell-pn-wrap-2b" style="vertical-align:top; background:#f0f7ff; font-weight:700; color:#1e3a8a; font-size:11.5px; line-height:1.4; padding:8px;">' +
                    escapeHtml(pn.pn_title) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2b" style="vertical-align:top; background:#f8fafc; font-weight:700; color:#0f172a; font-size:11.5px; padding:8px;">' +
                    '<textarea class="calc-inp pp-title-inp" style="font-weight:700; color:#203764; width:100%; resize:none; border:none; background:transparent;" rows="3" readonly>' + escapeHtml(pp.pp_title) + '</textarea>' +
                    '</td>';
          }

          html += '<td style="vertical-align:middle; padding:6px 8px;">' +
                    '<textarea class="calc-inp pd-title-inp" style="width:100%; font-weight:600; font-size:11.5px; color:#334155; resize:none; border:none; background:transparent;" rows="2" readonly>' + escapeHtml(pd.title) + '</textarea>' +
                  '</td>';

          html += '<td style="vertical-align:middle; text-align:center;">' +
                    '<select class="calc-inp pd-score-sel" style="font-weight:700; font-size:11.5px; color:' + (isSelaras ? '#16a34a' : '#dc2626') + '; width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 5px;">' +
                      '<option value="1.0"' + (isSelaras ? ' selected' : '') + '>100.00%</option>' +
                      '<option value="0.0"' + (!isSelaras ? ' selected' : '') + '>0.00%</option>' +
                    '</select>' +
                  '</td>';

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; font-size:11px; padding:6px 8px; color:#334155;">' +
                      '<textarea class="calc-inp pp-ket-inp" style="width:100%; font-size:11px; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px;" rows="3" placeholder="Keterangan...">' + escapeHtml(defaultPpKet) + '</textarea>' +
                    '</td>';

            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2bPpAvg_' + globalPpIdx + '" class="pp-avg-val" style="font-weight:700; font-size:12px; color:#1e3a8a;">' + Math.round(ppAvgRatio * 100) + '%</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff; font-weight:700; font-size:12px;">' +
                      numFmt(maxBobot) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2bPpTerb_' + globalPpIdx + '" class="pp-terbobot-val" style="font-weight:700; font-size:12px; color:#16a34a;">' + numFmt(ppTerbobotVal) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2bGrandRataTerbobotCell" style="font-weight:700; font-size:13.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<textarea id="ws1a2bCatatan" class="calc-inp" style="width:100%; font-size:11.5px; border:1px solid #cbd5e1; border-radius:4px; padding:6px 8px;" rows="8" placeholder="Catatan keselarasan...">' + escapeHtml(d.catatan || '') + '</textarea>' +
                    '</td>';
            isFirstGrandRow = false;
          }

          html += '</tr>';
        });
      });
    });

    // Summary bottom row matching HTML row 23
    html += 
        '<tr style="background:#f8fafc; font-weight:700; border-top:2px solid #cbd5e1;">' +
          '<td colspan="6" style="text-align:right; padding:8px 12px; color:#1e293b; font-size:12px;">Rata-rata Keselarasan:</td>' +
          '<td style="text-align:center; padding:8px 4px;"><span id="ws1a2bAvgCell" style="font-weight:700; font-size:13px; color:#dc2626;">' + Math.round(autoObj.pct) + '%</span></td>' +
          '<td style="text-align:center; font-size:12px; color:#334155;">' + numFmt(maxBobot) + '</td>' +
          '<td style="text-align:center;"><span id="ws1a2bTerbobotCell" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td style="text-align:center;"><span id="ws1a2bTerbobotCell2" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td></td>' +
        '</tr>';

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan & Range Penilaian Poin 1.a.2.b di bawah tabel sesuai isian file HTML
    html += renderStandardCriteriaCard({
      code: '1.a.2.b',
      safeId: 'ws1a2b',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.2.b',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Dukungan Program Daerah terhadap Kegiatan Prioritas dalam PN 2 RPJMN',
      rows: [
        { crit: 'A', text: 'Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 2 RPJMN', val: '0,075', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 2 RPJMN', val: '0,150', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 2 RPJMN', val: '0,225', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 2 RPJMN', val: '0,300', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 2 RPJMN', val: '0,375', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Sumber Data:', value: '/Daerah/DukunganKegiatanPrioritas' },
        { label: 'Program Prioritas:', value: 'PN 2 RPJMN' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a2bPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a2bCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.2.c berdasarkan keselarasan PP PN 3
  function getAutoScore_1_a_2_c(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 (AUTO_DATA_1_A_2_C && AUTO_DATA_1_A_2_C.length > 0 ? AUTO_DATA_1_A_2_C : []);

    var totalRows = 0;
    var sumScore = 0;

    pnList.forEach(function(pn){
      (pn.pps || []).forEach(function(pp){
        (pp.pds || []).forEach(function(pd){
          totalRows++;
          var s = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          sumScore += s;
        });
      });
    });

    var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
    var pct = avgRatio * 100;
    var score = 0.375;
    var crit = 'E';
    var label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 3 RPJMN';

    if (totalRows === 0) {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 3 RPJMN';
    } else if (pct >= 100) {
      crit = 'E';
      score = 0.375;
      label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 3 RPJMN';
    } else if (pct > 75) {
      crit = 'D';
      score = 0.300;
      label = 'D. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 3 RPJMN';
    } else if (pct > 50) {
      crit = 'C';
      score = 0.225;
      label = 'C. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 3 RPJMN';
    } else if (pct > 25) {
      crit = 'B';
      score = 0.150;
      label = 'B. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 3 RPJMN';
    } else {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 3 RPJMN';
    }

    return {
      pnList: pnList,
      totalRows: totalRows,
      sumScore: sumScore,
      avgRatio: avgRatio,
      pct: pct,
      crit: crit,
      score: score,
      label: label
    };
  }

  // Lembar Kerja Khusus Poin 1.a.2.c (Pemetaan Program Prioritas PN 3 RPJMN vs Program Daerah)
  function renderWs_1_a_2_c(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var savedPpList = d.pp_list || [];

    var pnList = (AUTO_DATA_1_A_2_C && AUTO_DATA_1_A_2_C.length > 0) ? 
                 JSON.parse(JSON.stringify(AUTO_DATA_1_A_2_C)) : 
                 ((d.pn_list && d.pn_list.length > 0) ? JSON.parse(JSON.stringify(d.pn_list)) : []);

    if (pnList.length === 0) {
      pnList = [{
        pn_title: 'PN 3 : Meningkatkan lapangan kerja yang berkualitas, mendorong kewirausahaan, mengembangkan industri kreatif serta mengembangkan agroindustri maritim industri di sentra produksi melalui peran aktif koperasi,',
        pps: [
          {
            pp_title: 'PP 3 : Peningkatan Produktivitas UMKM dan Koperasi',
            pds: [
              { title: 'PROGRAM PENDIDIKAN DANLATIHAN PERKOPERASIAN', score: 1.0, ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' },
              { title: 'PROGRAM PEMBERDAYAAN DANPERLINDUNGAN KOPERASI', score: 1.0, ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' }
            ]
          }
        ]
      }];
    }

    // Merge saved review & score into data
    if (pnList.length > 0 && savedPpList.length > 0) {
      pnList.forEach(function(pn){
        (pn.pps || []).forEach(function(pp) {
          var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
          if (savedPp) {
            if (savedPp.keterangan) pp.keterangan = savedPp.keterangan;
            (pp.pds || []).forEach(function(pd) {
              var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
              if (savedPd) {
                if (savedPd.ket) pd.ket = savedPd.ket;
                if (savedPd.score !== undefined) pd.score = savedPd.score;
              }
            });
          }
        });
      });
    }

    var grandTotalRows = 0;
    pnList.forEach(function(pn){
      var pps = (pn.pps && pn.pps.length > 0) ? pn.pps : [{ pds: [{}] }];
      pps.forEach(function(pp){
        grandTotalRows += (pp.pds && pp.pds.length > 0) ? pp.pds.length : 1;
      });
    });

    var autoObj = getAutoScore_1_a_2_c(d, maxBobot);

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.2.c - Pemetaan Program Prioritas PN 3 RPJMN vs Program Daerah</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Sumber: /Daerah/DukunganKegiatanPrioritas (Program Prioritas PN 3)</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_c" style="width: 100%; min-width: 1050px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 40px; text-align:center;">No</th>' +
            '<th class="th-blue" colspan="2" style="text-align:center;">RPJMN</th>' +
            '<th class="th-amber" colspan="1" style="text-align:center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Nilai Keselarasan<br>(0% / 100%)</th>' +
            '<th class="th-green" rowspan="2" style="width: 200px; text-align:center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 100px; text-align:center;">Nilai Keselarasan<br>Rata-rata</th>' +
            '<th class="th-gray" rowspan="2" style="width: 70px; text-align:center;">Bobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 100px; text-align:center;">Keselarasan<br>Terbobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Rata-rata Keselarasan<br>Terbobot</th>' +
            '<th class="th-gray" rowspan="2" style="width: 140px; text-align:center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 230px; text-align:left;">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-blue" style="width: 210px; text-align:left;">Program Prioritas Pembangunan Nasional</th>' +
            '<th class="th-amber" style="width: 230px; text-align:left;">Dukungan Program Pembangunan Daerah</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 1;
    var isFirstGrandRow = true;

    pnList.forEach(function(pn, pnIdx) {
      var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [{}] }];
      var totalRowsForPn = pps.reduce(function(acc, pp) {
        return acc + (pp.pds && pp.pds.length > 0 ? pp.pds.length : 1);
      }, 0);

      pps.forEach(function(pp, ppIdx) {
        var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', score: 1.0, ket: '' }];
        var pdCount = pds.length;
        var globalPpIdx = pnIdx + "_" + ppIdx;

        var ppSumScore = pds.reduce(function(acc, item){
          var s = (item.score !== undefined && item.score !== null) ? parseFloat(item.score) : 1.0;
          return acc + s;
        }, 0);
        var ppAvgRatio = pdCount > 0 ? (ppSumScore / pdCount) : 1.0;
        var ppTerbobotVal = ppAvgRatio * maxBobot;

        var defaultPpKet = pp.keterangan || 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait';

        pds.forEach(function(pd, pdIdx) {
          var sVal = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          var isSelaras = (sVal >= 1.0);

          html += '<tr class="ws-pp-row" data-pp-idx="' + globalPpIdx + '">';
          html += '<td class="excel-row-num" style="text-align:center;">' + (rowCounter++) + '</td>';

          if (ppIdx === 0 && pdIdx === 0) {
            html += '<td rowspan="' + totalRowsForPn + '" class="cell-pn-wrap-2c" style="vertical-align:top; background:#f0f7ff; font-weight:700; color:#1e3a8a; font-size:11.5px; line-height:1.4; padding:8px;">' +
                    escapeHtml(pn.pn_title) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2c" style="vertical-align:top; background:#f8fafc; font-weight:700; color:#0f172a; font-size:11.5px; padding:8px;">' +
                    '<textarea class="calc-inp pp-title-inp" style="font-weight:700; color:#203764; width:100%; resize:none; border:none; background:transparent;" rows="3" readonly>' + escapeHtml(pp.pp_title) + '</textarea>' +
                    '</td>';
          }

          html += '<td style="vertical-align:middle; padding:6px 8px;">' +
                    '<textarea class="calc-inp pd-title-inp" style="width:100%; font-weight:600; font-size:11.5px; color:#334155; resize:none; border:none; background:transparent;" rows="2" readonly>' + escapeHtml(pd.title) + '</textarea>' +
                  '</td>';

          html += '<td style="vertical-align:middle; text-align:center;">' +
                    '<select class="calc-inp pd-score-sel" style="font-weight:700; font-size:11.5px; color:' + (isSelaras ? '#16a34a' : '#dc2626') + '; width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 5px;">' +
                      '<option value="1.0"' + (isSelaras ? ' selected' : '') + '>100.00%</option>' +
                      '<option value="0.0"' + (!isSelaras ? ' selected' : '') + '>0.00%</option>' +
                    '</select>' +
                  '</td>';

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; font-size:11px; padding:6px 8px; color:#334155;">' +
                      '<textarea class="calc-inp pp-ket-inp" style="width:100%; font-size:11px; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px;" rows="3" placeholder="Keterangan...">' + escapeHtml(defaultPpKet) + '</textarea>' +
                    '</td>';

            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2cPpAvg_' + globalPpIdx + '" class="pp-avg-val" style="font-weight:700; font-size:12px; color:#1e3a8a;">' + Math.round(ppAvgRatio * 100) + '%</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff; font-weight:700; font-size:12px;">' +
                      numFmt(maxBobot) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2cPpTerb_' + globalPpIdx + '" class="pp-terbobot-val" style="font-weight:700; font-size:12px; color:#16a34a;">' + numFmt(ppTerbobotVal) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2cGrandRataTerbobotCell" style="font-weight:700; font-size:13.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<textarea id="ws1a2cCatatan" class="calc-inp" style="width:100%; font-size:11.5px; border:1px solid #cbd5e1; border-radius:4px; padding:6px 8px;" rows="8" placeholder="Catatan keselarasan...">' + escapeHtml(d.catatan || '') + '</textarea>' +
                    '</td>';
            isFirstGrandRow = false;
          }

          html += '</tr>';
        });
      });
    });

    // Summary bottom row matching HTML row 6
    html += 
        '<tr style="background:#f8fafc; font-weight:700; border-top:2px solid #cbd5e1;">' +
          '<td colspan="6" style="text-align:right; padding:8px 12px; color:#1e293b; font-size:12px;">Rata-rata Keselarasan:</td>' +
          '<td style="text-align:center; padding:8px 4px;"><span id="ws1a2cAvgCell" style="font-weight:700; font-size:13px; color:#dc2626;">' + Math.round(autoObj.pct) + '%</span></td>' +
          '<td style="text-align:center; font-size:12px; color:#334155;">' + numFmt(maxBobot) + '</td>' +
          '<td style="text-align:center;"><span id="ws1a2cTerbobotCell" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td style="text-align:center;"><span id="ws1a2cTerbobotCell2" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td></td>' +
        '</tr>';

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan & Range Penilaian Poin 1.a.2.c di bawah tabel
    html += renderStandardCriteriaCard({
      code: '1.a.2.c',
      safeId: 'ws1a2c',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.2.c',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Dukungan Program Daerah terhadap Kegiatan Prioritas dalam PN 3 RPJMN',
      rows: [
        { crit: 'A', text: 'Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 3 RPJMN', val: '0,075', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 3 RPJMN', val: '0,150', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 3 RPJMN', val: '0,225', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 3 RPJMN', val: '0,300', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 3 RPJMN', val: '0,375', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Sumber Data:', value: '/Daerah/DukunganKegiatanPrioritas' },
        { label: 'Program Prioritas:', value: 'PN 3 RPJMN' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a2cPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a2cCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.2.d berdasarkan keselarasan PP PN 4
  function getAutoScore_1_a_2_d(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 (AUTO_DATA_1_A_2_D && AUTO_DATA_1_A_2_D.length > 0 ? AUTO_DATA_1_A_2_D : 
                 (AUTO_DATA_1_A_2_ALL && AUTO_DATA_1_A_2_ALL['1.a.2.d'] ? [AUTO_DATA_1_A_2_ALL['1.a.2.d']] : []));

    var totalRows = 0;
    var sumScore = 0;

    pnList.forEach(function(pn){
      (pn.pps || []).forEach(function(pp){
        (pp.pds || []).forEach(function(pd){
          totalRows++;
          var s = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          sumScore += s;
        });
      });
    });

    var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
    var pct = avgRatio * 100;
    var score = 0.375;
    var crit = 'E';
    var label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 4 RPJMN';

    if (totalRows === 0) {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 4 RPJMN';
    } else if (pct >= 100) {
      crit = 'E';
      score = 0.375;
      label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 4 RPJMN';
    } else if (pct > 75) {
      crit = 'D';
      score = 0.300;
      label = 'D. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 4 RPJMN';
    } else if (pct > 50) {
      crit = 'C';
      score = 0.225;
      label = 'C. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 4 RPJMN';
    } else if (pct > 25) {
      crit = 'B';
      score = 0.150;
      label = 'B. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 4 RPJMN';
    } else {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 4 RPJMN';
    }

    return {
      pnList: pnList,
      totalRows: totalRows,
      sumScore: sumScore,
      avgRatio: avgRatio,
      pct: pct,
      crit: crit,
      score: score,
      label: label
    };
  }

  // Sheet 1.a.2.d (PN 4 Program Prioritas Pembangunan Nasional) Sesuai Isian File HTML
  function renderWs_1_a_2_d(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var autoObj = getAutoScore_1_a_2_d(d, maxBobot);
    var savedPpList = d.pp_list || [];
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 ((AUTO_DATA_1_A_2_D && AUTO_DATA_1_A_2_D.length > 0) ? AUTO_DATA_1_A_2_D : autoObj.pnList);

    if (!pnList || pnList.length === 0) {
      pnList = [{
        pn_title: 'PN 4 : Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi Z), dan Penyandang Disabilitas',
        pps: [
          {
            pp_title: 'PP 1 : Percepatan Wajib Belajar 13 Tahun (1 Prasekolah dan 12 Tahun Pendidikan Tahun Pendidikan Dasar dan Pendidikan Menengah)',
            pds: [
              { title: 'PROGRAM PENGELOLAANPENDIDIKAN', score: 1.0, ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' }
            ]
          }
        ]
      }];
    }

    // Merge saved review & score into data
    if (pnList.length > 0 && savedPpList.length > 0) {
      pnList.forEach(function(pn){
        (pn.pps || []).forEach(function(pp) {
          var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
          if (savedPp) {
            if (savedPp.keterangan) pp.keterangan = savedPp.keterangan;
            (pp.pds || []).forEach(function(pd) {
              var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
              if (savedPd) {
                if (savedPd.ket) pd.ket = savedPd.ket;
                if (savedPd.score !== undefined) pd.score = savedPd.score;
              }
            });
          }
        });
      });
    }

    var grandTotalRows = 0;
    pnList.forEach(function(pn){
      var pps = (pn.pps && pn.pps.length > 0) ? pn.pps : [{ pds: [{}] }];
      pps.forEach(function(pp){
        grandTotalRows += (pp.pds && pp.pds.length > 0) ? pp.pds.length : 1;
      });
    });

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.2.d - Pemetaan Program Prioritas PN 4 RPJMN vs Program Daerah</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Sumber: /Daerah/DukunganKegiatanPrioritas (Program Prioritas PN 4)</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_d" style="width: 100%; min-width: 1050px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 40px; text-align:center;">No</th>' +
            '<th class="th-blue" colspan="2" style="text-align:center;">RPJMN</th>' +
            '<th class="th-amber" colspan="1" style="text-align:center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Nilai Keselarasan<br>(0% / 100%)</th>' +
            '<th class="th-green" rowspan="2" style="width: 200px; text-align:center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 100px; text-align:center;">Nilai Keselarasan<br>Rata-rata</th>' +
            '<th class="th-gray" rowspan="2" style="width: 70px; text-align:center;">Bobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 100px; text-align:center;">Keselarasan<br>Terbobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Rata-rata Keselarasan<br>Terbobot</th>' +
            '<th class="th-gray" rowspan="2" style="width: 140px; text-align:center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 230px; text-align:left;">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-blue" style="width: 210px; text-align:left;">Program Prioritas Pembangunan Nasional</th>' +
            '<th class="th-amber" style="width: 230px; text-align:left;">Dukungan Program Pembangunan Daerah</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 1;
    var isFirstGrandRow = true;

    pnList.forEach(function(pn, pnIdx) {
      var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [{}] }];
      var totalRowsForPn = pps.reduce(function(acc, pp) {
        return acc + (pp.pds && pp.pds.length > 0 ? pp.pds.length : 1);
      }, 0);

      pps.forEach(function(pp, ppIdx) {
        var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', score: 1.0, ket: '' }];
        var pdCount = pds.length;
        var globalPpIdx = pnIdx + "_" + ppIdx;

        var ppSumScore = pds.reduce(function(acc, item){
          var s = (item.score !== undefined && item.score !== null) ? parseFloat(item.score) : 1.0;
          return acc + s;
        }, 0);
        var ppAvgRatio = pdCount > 0 ? (ppSumScore / pdCount) : 1.0;
        var ppTerbobotVal = ppAvgRatio * maxBobot;

        var defaultPpKet = pp.keterangan || (pp.pp_title.indexOf('PP 6') !== -1 ? 'Tidak ada Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' : 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait');

        pds.forEach(function(pd, pdIdx) {
          var sVal = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          var isSelaras = (sVal >= 1.0);

          html += '<tr class="ws-pp-row" data-pp-idx="' + globalPpIdx + '">';
          html += '<td class="excel-row-num" style="text-align:center;">' + (rowCounter++) + '</td>';

          if (ppIdx === 0 && pdIdx === 0) {
            html += '<td rowspan="' + totalRowsForPn + '" class="cell-pn-wrap-2b" style="vertical-align:top; background:#f0f7ff; font-weight:700; color:#1e3a8a; font-size:11.5px; line-height:1.4; padding:8px;">' +
                    escapeHtml(pn.pn_title) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2b" style="vertical-align:top; background:#f8fafc; font-weight:700; color:#0f172a; font-size:11.5px; padding:8px;">' +
                    '<textarea class="calc-inp pp-title-inp" style="font-weight:700; color:#203764; width:100%; resize:none; border:none; background:transparent;" rows="3" readonly>' + escapeHtml(pp.pp_title) + '</textarea>' +
                    '</td>';
          }

          html += '<td style="vertical-align:middle; padding:6px 8px;">' +
                    '<textarea class="calc-inp pd-title-inp" style="width:100%; font-weight:600; font-size:11.5px; color:#334155; resize:none; border:none; background:transparent;" rows="2" readonly>' + escapeHtml(pd.title) + '</textarea>' +
                  '</td>';

          html += '<td style="vertical-align:middle; text-align:center;">' +
                    '<select class="calc-inp pd-score-sel" style="font-weight:700; font-size:11.5px; color:' + (isSelaras ? '#16a34a' : '#dc2626') + '; width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 5px;">' +
                      '<option value="1.0"' + (isSelaras ? ' selected' : '') + '>100.00%</option>' +
                      '<option value="0.0"' + (!isSelaras ? ' selected' : '') + '>0.00%</option>' +
                    '</select>' +
                  '</td>';

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; font-size:11px; padding:6px 8px; color:#334155;">' +
                      '<textarea class="calc-inp pp-ket-inp" style="width:100%; font-size:11px; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px;" rows="3" placeholder="Keterangan...">' + escapeHtml(defaultPpKet) + '</textarea>' +
                    '</td>';

            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2dPpAvg_' + globalPpIdx + '" class="pp-avg-val" style="font-weight:700; font-size:12px; color:#1e3a8a;">' + Math.round(ppAvgRatio * 100) + '%</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff; font-weight:700; font-size:12px;">' +
                      numFmt(maxBobot) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2dPpTerb_' + globalPpIdx + '" class="pp-terbobot-val" style="font-weight:700; font-size:12px; color:#16a34a;">' + numFmt(ppTerbobotVal) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2dGrandRataTerbobotCell" style="font-weight:700; font-size:13.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<textarea id="ws1a2dCatatan" class="calc-inp" style="width:100%; font-size:11.5px; border:1px solid #cbd5e1; border-radius:4px; padding:6px 8px;" rows="8" placeholder="Catatan keselarasan...">' + escapeHtml(d.catatan || '') + '</textarea>' +
                    '</td>';
            isFirstGrandRow = false;
          }

          html += '</tr>';
        });
      });
    });

    // Summary bottom row matching HTML row 19
    html += 
        '<tr style="background:#f8fafc; font-weight:700; border-top:2px solid #cbd5e1;">' +
          '<td colspan="6" style="text-align:right; padding:8px 12px; color:#1e293b; font-size:12px;">Rata-rata Keselarasan:</td>' +
          '<td style="text-align:center; padding:8px 4px;"><span id="ws1a2dAvgCell" style="font-weight:700; font-size:13px; color:#dc2626;">' + Math.round(autoObj.pct) + '%</span></td>' +
          '<td style="text-align:center; font-size:12px; color:#334155;">' + numFmt(maxBobot) + '</td>' +
          '<td style="text-align:center;"><span id="ws1a2dTerbobotCell" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td style="text-align:center;"><span id="ws1a2dTerbobotCell2" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td></td>' +
        '</tr>';

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan & Range Penilaian Poin 1.a.2.d di bawah tabel sesuai isian file HTML
    html += renderStandardCriteriaCard({
      code: '1.a.2.d',
      safeId: 'ws1a2d',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.2.d',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Dukungan Program Daerah terhadap Kegiatan Prioritas dalam PN 4 RPJMN',
      rows: [
        { crit: 'A', text: 'Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 4 RPJMN', val: '0,075', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 4 RPJMN', val: '0,150', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 4 RPJMN', val: '0,225', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 4 RPJMN', val: '0,300', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 4 RPJMN', val: '0,375', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Sumber Data:', value: '/Daerah/DukunganKegiatanPrioritas' },
        { label: 'Program Prioritas:', value: 'PN 4 RPJMN' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a2dPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a2dCritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper untuk menghitung capaian otomatis 1.a.2.e berdasarkan keselarasan PP PN 5
  function getAutoScore_1_a_2_e(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 (AUTO_DATA_1_A_2_E && AUTO_DATA_1_A_2_E.length > 0 ? AUTO_DATA_1_A_2_E : 
                 (AUTO_DATA_1_A_2_ALL && AUTO_DATA_1_A_2_ALL['1.a.2.e'] ? [AUTO_DATA_1_A_2_ALL['1.a.2.e']] : []));

    // Filter hanya PP 1 sesuai permintaan dan isian file HTML
    if (pnList && pnList.length > 0) {
      pnList.forEach(function(pn){
        if (pn.pps && pn.pps.length > 0) {
          pn.pps = pn.pps.filter(function(pp){
            return (pp.pp_title && (pp.pp_title.indexOf('PP 1') !== -1 || pp.pp_title.indexOf('Hilirisasi') !== -1));
          });
        }
      });
    }

    var totalRows = 0;
    var sumScore = 0;

    pnList.forEach(function(pn){
      (pn.pps || []).forEach(function(pp){
        (pp.pds || []).forEach(function(pd){
          totalRows++;
          var s = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          sumScore += s;
        });
      });
    });

    var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
    var pct = avgRatio * 100;
    var score = 0.375;
    var crit = 'E';
    var label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 5 RPJMN';

    if (totalRows === 0) {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 5 RPJMN';
    } else if (pct >= 100) {
      crit = 'E';
      score = 0.375;
      label = 'E. Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 5 RPJMN';
    } else if (pct > 75) {
      crit = 'D';
      score = 0.300;
      label = 'D. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 5 RPJMN';
    } else if (pct > 50) {
      crit = 'C';
      score = 0.225;
      label = 'C. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 5 RPJMN';
    } else if (pct > 25) {
      crit = 'B';
      score = 0.150;
      label = 'B. Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 5 RPJMN';
    } else {
      crit = 'A';
      score = 0.075;
      label = 'A. Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 5 RPJMN';
    }

    return {
      pnList: pnList,
      totalRows: totalRows,
      sumScore: sumScore,
      avgRatio: avgRatio,
      pct: pct,
      crit: crit,
      score: score,
      label: label
    };
  }

  // Sheet 1.a.2.e (PN 5 Program Prioritas Pembangunan Nasional) Sesuai Isian File HTML
  function renderWs_1_a_2_e(d, maxBobot){
    d = d || {};
    maxBobot = maxBobot !== undefined ? parseFloat(maxBobot) : 0.375;
    var autoObj = getAutoScore_1_a_2_e(d, maxBobot);
    var savedPpList = d.pp_list || [];
    var pnList = (d.pn_list && d.pn_list.length > 0) ? d.pn_list : 
                 ((AUTO_DATA_1_A_2_E && AUTO_DATA_1_A_2_E.length > 0) ? AUTO_DATA_1_A_2_E : autoObj.pnList);

    // Filter agar hanya memunculkan Program Prioritas yang sesuai saja (PP 1)
    if (pnList && pnList.length > 0) {
      pnList.forEach(function(pn){
        if (pn.pps && pn.pps.length > 0) {
          pn.pps = pn.pps.filter(function(pp){
            return (pp.pp_title && (pp.pp_title.indexOf('PP 1') !== -1 || pp.pp_title.indexOf('Hilirisasi') !== -1));
          });
          if (pn.pps.length === 0) {
            pn.pps = [
              {
                pp_title: 'PP 1 : Pengembangan Hilirisasi Industri berbasis SDA Unggulan, Industri Padat Karya Terampil, Padat Teknologi Inovasi, serta Berorientasi Ekspor',
                pds: [
                  { title: 'PROGRAM PENINGKATAN KAPASITAS SUMBER DAYA MANUSIA KESEHATAN', score: 1.0, ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' }
                ]
              }
            ];
          }
        }
      });
    }

    if (!pnList || pnList.length === 0) {
      pnList = [{
        pn_title: 'PN 5 : Melanjutkan Hilirisasi dan Mengembangkan Industri Berbasis Sumber Daya Alam untuk Meningkatkan Nilai Tambah di Dalam Negeri',
        pps: [
          {
            pp_title: 'PP 1 : Pengembangan Hilirisasi Industri berbasis SDA Unggulan, Industri Padat Karya Terampil, Padat Teknologi Inovasi, serta Berorientasi Ekspor',
            pds: [
              { title: 'PROGRAM PENINGKATAN KAPASITAS SUMBER DAYA MANUSIA KESEHATAN', score: 1.0, ket: 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait' }
            ]
          }
        ]
      }];
    }

    // Merge saved review & score into data
    if (pnList.length > 0 && savedPpList.length > 0) {
      pnList.forEach(function(pn){
        (pn.pps || []).forEach(function(pp) {
          var savedPp = savedPpList.find(function(s) { return s.pp_title === pp.pp_title; });
          if (savedPp) {
            if (savedPp.keterangan) pp.keterangan = savedPp.keterangan;
            (pp.pds || []).forEach(function(pd) {
              var savedPd = savedPp.pds ? savedPp.pds.find(function(s) { return s.title === pd.title; }) : null;
              if (savedPd) {
                if (savedPd.ket) pd.ket = savedPd.ket;
                if (savedPd.score !== undefined) pd.score = savedPd.score;
              }
            });
          }
        });
      });
    }

    var grandTotalRows = 0;
    pnList.forEach(function(pn){
      var pps = (pn.pps && pn.pps.length > 0) ? pn.pps : [{ pds: [{}] }];
      pps.forEach(function(pp){
        grandTotalRows += (pp.pds && pp.pds.length > 0) ? pp.pds.length : 1;
      });
    });

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Poin 1.a.2.e - Pemetaan Program Prioritas PN 5 RPJMN vs Program Daerah</span>' +
        '<span style="font-size:11px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; padding:2px 8px; border-radius:12px; font-weight:600;"><i class="fa fa-database"></i> Sumber: /Daerah/DukunganKegiatanPrioritas (Program Prioritas PN 5)</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_e" style="width: 100%; min-width: 1050px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2" style="width: 40px; text-align:center;">No</th>' +
            '<th class="th-blue" colspan="2" style="text-align:center;">RPJMN</th>' +
            '<th class="th-amber" colspan="1" style="text-align:center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Nilai Keselarasan<br>(0% / 100%)</th>' +
            '<th class="th-green" rowspan="2" style="width: 200px; text-align:center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 100px; text-align:center;">Nilai Keselarasan<br>Rata-rata</th>' +
            '<th class="th-gray" rowspan="2" style="width: 70px; text-align:center;">Bobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 100px; text-align:center;">Keselarasan<br>Terbobot</th>' +
            '<th class="th-green" rowspan="2" style="width: 110px; text-align:center;">Rata-rata Keselarasan<br>Terbobot</th>' +
            '<th class="th-gray" rowspan="2" style="width: 140px; text-align:center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 230px; text-align:left;">Prioritas Pembangunan Nasional</th>' +
            '<th class="th-blue" style="width: 210px; text-align:left;">Program Prioritas Pembangunan Nasional</th>' +
            '<th class="th-amber" style="width: 230px; text-align:left;">Dukungan Program Pembangunan Daerah</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 1;
    var isFirstGrandRow = true;

    pnList.forEach(function(pn, pnIdx) {
      var pps = pn.pps && pn.pps.length > 0 ? pn.pps : [{ pp_title: '-', pds: [{}] }];
      var totalRowsForPn = pps.reduce(function(acc, pp) {
        return acc + (pp.pds && pp.pds.length > 0 ? pp.pds.length : 1);
      }, 0);

      pps.forEach(function(pp, ppIdx) {
        var pds = pp.pds && pp.pds.length > 0 ? pp.pds : [{ title: '-', score: 1.0, ket: '' }];
        var pdCount = pds.length;
        var globalPpIdx = pnIdx + "_" + ppIdx;

        var ppSumScore = pds.reduce(function(acc, item){
          var s = (item.score !== undefined && item.score !== null) ? parseFloat(item.score) : 1.0;
          return acc + s;
        }, 0);
        var ppAvgRatio = pdCount > 0 ? (ppSumScore / pdCount) : 1.0;
        var ppTerbobotVal = ppAvgRatio * maxBobot;

        var defaultPpKet = pp.keterangan || 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait';

        pds.forEach(function(pd, pdIdx) {
          var sVal = (pd.score !== undefined && pd.score !== null) ? parseFloat(pd.score) : 1.0;
          var isSelaras = (sVal >= 1.0);

          html += '<tr class="ws-pp-row" data-pp-idx="' + globalPpIdx + '">';
          html += '<td class="excel-row-num" style="text-align:center;">' + (rowCounter++) + '</td>';

          if (ppIdx === 0 && pdIdx === 0) {
            html += '<td rowspan="' + totalRowsForPn + '" class="cell-pn-wrap-2b" style="vertical-align:top; background:#f0f7ff; font-weight:700; color:#1e3a8a; font-size:11.5px; line-height:1.4; padding:8px;">' +
                    escapeHtml(pn.pn_title) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2b" style="vertical-align:top; background:#f8fafc; font-weight:700; color:#0f172a; font-size:11.5px; padding:8px;">' +
                    '<textarea class="calc-inp pp-title-inp" style="font-weight:700; color:#203764; width:100%; resize:none; border:none; background:transparent;" rows="3" readonly>' + escapeHtml(pp.pp_title) + '</textarea>' +
                    '</td>';
          }

          html += '<td style="vertical-align:middle; padding:6px 8px;">' +
                    '<textarea class="calc-inp pd-title-inp" style="width:100%; font-weight:600; font-size:11.5px; color:#334155; resize:none; border:none; background:transparent;" rows="2" readonly>' + escapeHtml(pd.title) + '</textarea>' +
                  '</td>';

          html += '<td style="vertical-align:middle; text-align:center;">' +
                    '<select class="calc-inp pd-score-sel" style="font-weight:700; font-size:11.5px; color:' + (isSelaras ? '#16a34a' : '#dc2626') + '; width:100%; border:1px solid #cbd5e1; border-radius:4px; padding:4px 5px;">' +
                      '<option value="1.0"' + (isSelaras ? ' selected' : '') + '>100.00%</option>' +
                      '<option value="0.0"' + (!isSelaras ? ' selected' : '') + '>0.00%</option>' +
                    '</select>' +
                  '</td>';

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; font-size:11px; padding:6px 8px; color:#334155;">' +
                      '<textarea class="calc-inp pp-ket-inp" style="width:100%; font-size:11px; border:1px solid #cbd5e1; border-radius:4px; padding:4px 6px;" rows="3" placeholder="Keterangan...">' + escapeHtml(defaultPpKet) + '</textarea>' +
                    '</td>';

            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2ePpAvg_' + globalPpIdx + '" class="pp-avg-val" style="font-weight:700; font-size:12px; color:#1e3a8a;">' + Math.round(ppAvgRatio * 100) + '%</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff; font-weight:700; font-size:12px;">' +
                      numFmt(maxBobot) +
                    '</td>';
          }

          if (pdIdx === 0) {
            html += '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2ePpTerb_' + globalPpIdx + '" class="pp-terbobot-val" style="font-weight:700; font-size:12px; color:#16a34a;">' + numFmt(ppTerbobotVal) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<span id="ws1a2eGrandRataTerbobotCell" style="font-weight:700; font-size:13.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span>' +
                    '</td>';
          }

          if (isFirstGrandRow) {
            html += '<td rowspan="' + grandTotalRows + '" style="vertical-align:middle; text-align:center; background:#ffffff;">' +
                      '<textarea id="ws1a2eCatatan" class="calc-inp" style="width:100%; font-size:11.5px; border:1px solid #cbd5e1; border-radius:4px; padding:6px 8px;" rows="8" placeholder="Catatan keselarasan...">' + escapeHtml(d.catatan || '') + '</textarea>' +
                    '</td>';
            isFirstGrandRow = false;
          }

          html += '</tr>';
        });
      });
    });

    // Summary bottom row matching HTML row 5
    html += 
        '<tr style="background:#f8fafc; font-weight:700; border-top:2px solid #cbd5e1;">' +
          '<td colspan="6" style="text-align:right; padding:8px 12px; color:#1e293b; font-size:12px;">Rata-rata Keselarasan:</td>' +
          '<td style="text-align:center; padding:8px 4px;"><span id="ws1a2eAvgCell" style="font-weight:700; font-size:13px; color:#dc2626;">' + Math.round(autoObj.pct) + '%</span></td>' +
          '<td style="text-align:center; font-size:12px; color:#334155;">' + numFmt(maxBobot) + '</td>' +
          '<td style="text-align:center;"><span id="ws1a2eTerbobotCell" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td style="text-align:center;"><span id="ws1a2eTerbobotCell2" style="font-weight:700; font-size:12.5px; color:#16a34a;">' + numFmt(autoObj.score) + '</span></td>' +
          '<td></td>' +
        '</tr>';

    html += 
        '</tbody>' +
      '</table>' +
      '</div>';

    // Keterangan & Range Penilaian Poin 1.a.2.e di bawah tabel sesuai isian file HTML
    html += renderStandardCriteriaCard({
      code: '1.a.2.e',
      safeId: 'ws1a2e',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.2.e',
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Dukungan Program Daerah terhadap Kegiatan Prioritas dalam PN 5 RPJMN',
      rows: [
        { crit: 'A', text: 'Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam PN 5 RPJMN', val: '0,075', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam PN 5 RPJMN', val: '0,150', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam PN 5 RPJMN', val: '0,225', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam PN 5 RPJMN', val: '0,300', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam PN 5 RPJMN', val: '0,375', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Sumber Data:', value: '/Daerah/DukunganKegiatanPrioritas' },
        { label: 'Program Prioritas:', value: 'PN 5 RPJMN' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a2ePctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a2eCritText', value: '-' }
      ]
    });

    return html;
  }

  // 5. Sheets 1.a.2.e s.d 1.a.2.h (PN 5 s.d PN 8 dengan Kolom Review TA Bidang)
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

    var pnMap = {
      '1.a.2.d': 'PN 4',
      '1.a.2.e': 'PN 5',
      '1.a.2.f': 'PN 6',
      '1.a.2.g': 'PN 7',
      '1.a.2.h': 'PN 8'
    };
    var pnLabel = pnMap[code] || ('PN ' + code);

    html += renderStandardCriteriaCard({
      code: code,
      safeId: 'ws1a2bg',
      title: 'Keterangan & Kriteria Penilaian Poin ' + code,
      badgeText: 'Evaluasi Form Terkait',
      colTitle: 'Kriteria Dukungan Program Daerah terhadap Kegiatan Prioritas dalam ' + pnLabel + ' RPJMN',
      rows: [
        { crit: 'A', text: 'Ketersediaan dukungan program daerah dalam RPJMD sama dengan atau kurang dari 25% terhadap kegiatan prioritas dalam ' + pnLabel + ' RPJMN', val: '0,075', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 25% dan sama dengan atau kurang dari 50% terhadap kegiatan prioritas dalam ' + pnLabel + ' RPJMN', val: '0,150', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 50% dan sama dengan atau kurang dari 75% terhadap kegiatan prioritas dalam ' + pnLabel + ' RPJMN', val: '0,225', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan dukungan program daerah dalam RPJMD lebih dari 75% dan sama dengan atau kurang dari 99% terhadap kegiatan prioritas dalam ' + pnLabel + ' RPJMN', val: '0,300', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan dukungan program daerah dalam RPJMD 100% terhadap kegiatan prioritas dalam ' + pnLabel + ' RPJMN', val: '0,375', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Kelengkapan Sinkronisasi Form Terkait',
      infoRows: [
        { label: 'Sumber Data:', value: '/Daerah/DukunganKegiatanPrioritas' },
        { label: 'Program Prioritas:', value: pnLabel + ' RPJMN' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a2bgPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a2bgCritText', value: '-' }
      ]
    });

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

    html += renderStandardCriteriaCard({
      code: code,
      safeId: 'ws1a3',
      title: 'Keterangan & Kriteria Penilaian Poin ' + code,
      badgeText: 'Perhitungan Otomatis Margin',
      colTitle: 'Kriteria Keselarasan Target ' + indName + ' RPJMD terhadap RPJMN',
      rows: [
        { crit: 'A', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' kurang dari 25% terhadap RPJMN', val: '0,000', color: '#dc2626' },
        { crit: 'B', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' sama dengan atau lebih dari 25% dan kurang dari 50% terhadap RPJMN', val: '0,125', color: '#d97706' },
        { crit: 'C', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' sama dengan atau lebih dari 50% dan kurang dari 75% terhadap RPJMN', val: '0,250', color: '#2563eb' },
        { crit: 'D', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' sama dengan atau lebih dari 75% dan kurang dari 100% terhadap RPJMN', val: '0,375', color: '#0891b2' },
        { crit: 'E', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' mencapai 100% (selaras penuh / melampaui target nasional)', val: '0,500', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Sinkronisasi Target Makro',
      infoRows: [
        { label: 'Indikator:', value: indName },
        { label: 'Sumber Data:', value: 'Data Makro RPJMN & RPJMD Daerah' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1a3AvgScore', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a3CritText', value: '-' }
      ]
    });

    return html;
  }

  // Helper Kalkulasi Otomatis Skor & Kriteria Poin 1.a.4
  function getAutoScore_1_a_4(d){
    d = d || {};
    var rawAutoList = (typeof AUTO_DATA_1_A_4 !== 'undefined' && AUTO_DATA_1_A_4 && Array.isArray(AUTO_DATA_1_A_4.kpu_list) && AUTO_DATA_1_A_4.kpu_list.length > 0) ? AUTO_DATA_1_A_4.kpu_list :
                      ((typeof AUTO_DATA_1_A_4 !== 'undefined' && Array.isArray(AUTO_DATA_1_A_4) && AUTO_DATA_1_A_4.length > 0) ? AUTO_DATA_1_A_4 : []);
    var kpuList = rawAutoList.length > 0 ? rawAutoList : 
                  ((d.kpu_list && Array.isArray(d.kpu_list) && d.kpu_list.length > 0) ? d.kpu_list : []);

    var totalKpu = kpuList.length;
    var sumTerbobot = 0;
    kpuList.forEach(function(km){
      var pdList = (km.pds && km.pds.length > 0) ? km.pds : [];
      var hasSupport = pdList.some(function(p){ return p.title && p.title !== '-' && (p.score === undefined || parseFloat(p.score) > 0.5); });
      var terb = (km.keselarasan_terbobot !== undefined && km.keselarasan_terbobot !== null) ? parseFloat(km.keselarasan_terbobot) : (hasSupport ? 1.0 : 0.5);
      sumTerbobot += terb;
    });

    var avgTerbobot = totalKpu > 0 ? (sumTerbobot / totalKpu) : 0.50;
    var crit = (avgTerbobot >= 0.50) ? 'B' : 'A';
    var score = (avgTerbobot >= 0.50) ? 1.0 : 0.5;
    var label = (avgTerbobot >= 0.50) ? 'Ya (Nilai keselarasan >= 0,50)' : 'Tidak (Nilai keselarasan < 0,50)';
    var aksi = (avgTerbobot >= 0.50) ? 'Ya' : 'Tidak';

    return {
      kpuList: kpuList,
      total: totalKpu,
      avg: avgTerbobot,
      crit: crit,
      score: score,
      label: label,
      aksi: aksi
    };
  }

  // Helper Kalkulasi Otomatis Skor & Kriteria Poin 1.a.5
  function getAutoScore_1_a_5(d){
    d = d || {};
    var rawAutoList = (typeof AUTO_DATA_1_A_5 !== 'undefined' && AUTO_DATA_1_A_5 && Array.isArray(AUTO_DATA_1_A_5.bidang_list) && AUTO_DATA_1_A_5.bidang_list.length > 0) ? AUTO_DATA_1_A_5.bidang_list :
                      ((typeof AUTO_DATA_1_A_5 !== 'undefined' && Array.isArray(AUTO_DATA_1_A_5) && AUTO_DATA_1_A_5.length > 0) ? AUTO_DATA_1_A_5 : []);
    var spmList = (d.spm_list && Array.isArray(d.spm_list) && d.spm_list.length > 0) ? d.spm_list : 
                  (rawAutoList.length > 0 ? rawAutoList : []);

    var totalBidang = spmList.length;
    var sumTerbobot = 0;
    spmList.forEach(function(bm){
      var indList = (bm.ind_list && bm.ind_list.length > 0) ? bm.ind_list : [];
      var hasSupport = indList.some(function(p){ return p.name && p.name !== '-' && (p.score === undefined || parseFloat(p.score) > 0.5); });
      var terb = (bm.keselarasan_terbobot !== undefined && bm.keselarasan_terbobot !== null) ? parseFloat(bm.keselarasan_terbobot) : (hasSupport ? 1.0 : 0.5);
      sumTerbobot += terb;
    });

    var avgTerbobot = totalBidang > 0 ? (sumTerbobot / totalBidang) : 0.50;
    var crit = (avgTerbobot >= 0.50) ? 'B' : 'A';
    var score = (avgTerbobot >= 0.50) ? 1.0 : 0.5;
    var label = (avgTerbobot >= 0.50) ? 'Ya (Nilai keselarasan >= 0,50)' : 'Tidak (Nilai keselarasan < 0,50)';
    var aksi = (avgTerbobot >= 0.50) ? 'Ya' : 'Tidak';

    return {
      spmList: spmList,
      total: totalBidang,
      avg: avgTerbobot,
      crit: crit,
      score: score,
      label: label,
      aksi: aksi
    };
  }

  // Helper Kalkulasi Otomatis Skor & Kriteria Poin 1.a.6 (Target SPM)
  function getAutoScore_1_a_6(d){
    d = d || {};
    var rawAutoList = (typeof AUTO_DATA_1_A_6 !== 'undefined' && AUTO_DATA_1_A_6 && Array.isArray(AUTO_DATA_1_A_6.bidang_list) && AUTO_DATA_1_A_6.bidang_list.length > 0) ? AUTO_DATA_1_A_6.bidang_list :
                      ((typeof AUTO_DATA_1_A_6 !== 'undefined' && Array.isArray(AUTO_DATA_1_A_6) && AUTO_DATA_1_A_6.length > 0) ? AUTO_DATA_1_A_6 : []);
    var spmList = (d.spm_list && Array.isArray(d.spm_list) && d.spm_list.length > 0) ? d.spm_list : 
                  (rawAutoList.length > 0 ? rawAutoList : []);

    var totalBidang = spmList.length;
    var sumTerbobot = 0;
    spmList.forEach(function(bm){
      var indList = (bm.ind_list && bm.ind_list.length > 0) ? bm.ind_list : [];
      var hasSupport = indList.some(function(p){ return p.name && p.name !== '-' && (p.score === undefined || parseFloat(p.score) > 0.5); });
      var terb = (bm.keselarasan_terbobot !== undefined && bm.keselarasan_terbobot !== null) ? parseFloat(bm.keselarasan_terbobot) : (hasSupport ? 1.0 : 0.5);
      sumTerbobot += terb;
    });

    var avgTerbobot = totalBidang > 0 ? (sumTerbobot / totalBidang) : 0.50;
    var crit = (avgTerbobot >= 0.50) ? 'B' : 'A';
    var score = (avgTerbobot >= 0.50) ? 1.0 : 0.5;
    var label = (avgTerbobot >= 0.50) ? 'Ya (Nilai keselarasan >= 0,50)' : 'Tidak (Nilai keselarasan < 0,50)';
    var aksi = (avgTerbobot >= 0.50) ? 'Ya' : 'Tidak';

    return {
      spmList: spmList,
      total: totalBidang,
      avg: avgTerbobot,
      crit: crit,
      score: score,
      label: label,
      aksi: aksi
    };
  }

  // 7. Sheet 1.a.4 (Kegiatan Prioritas Utama KPU RPJMN vs Dukungan Program Daerah RPJMD)
  function renderWs_1_a_4(d, maxBobot){
    d = d || {};
    var rawAutoList = (AUTO_DATA_1_A_4 && Array.isArray(AUTO_DATA_1_A_4.kpu_list) && AUTO_DATA_1_A_4.kpu_list.length > 0) ? AUTO_DATA_1_A_4.kpu_list :
                      ((Array.isArray(AUTO_DATA_1_A_4) && AUTO_DATA_1_A_4.length > 0) ? AUTO_DATA_1_A_4 : []);

    var kpuList = rawAutoList.length > 0 ? rawAutoList : 
                  ((d.kpu_list && Array.isArray(d.kpu_list) && d.kpu_list.length > 0) ? d.kpu_list : []);

    // Sinkronisasi catatan yang pernah diinputkan user sebelumnya
    if (d.kpu_list && Array.isArray(d.kpu_list)) {
      var savedNoteMap = {};
      d.kpu_list.forEach(function(sk){
        if (sk.kpu_title && sk.catatan) savedNoteMap[sk.kpu_title] = sk.catatan;
      });
      kpuList.forEach(function(k){
        if (savedNoteMap[k.kpu_title] && !k.catatan) k.catatan = savedNoteMap[k.kpu_title];
      });
    }

    var totalRowCount = 0;
    var totalKpuCount = kpuList.length;
    var sumTerbobotInitial = 0;

    kpuList.forEach(function(kpu){
      var pdList = (kpu.pds && kpu.pds.length > 0) ? kpu.pds : [{ title: '-', score: 0.50 }];
      totalRowCount += pdList.length;
      var curTerbobot = (kpu.keselarasan_terbobot !== undefined && kpu.keselarasan_terbobot !== null) ? parseFloat(kpu.keselarasan_terbobot) : (pdList[0].score !== undefined ? parseFloat(pdList[0].score) : 0.50);
      sumTerbobotInitial += curTerbobot;
    });

    var grandAvgInitial = totalKpuCount > 0 ? (sumTerbobotInitial / totalKpuCount) : 0.50;

    var html = 
      '<div style="overflow-x:auto; padding-bottom:10px;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_4" style="min-width: 1050px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="th-blue" rowspan="2" style="width: 280px; min-width: 280px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">RPJMN<br><small style="font-weight:600; font-size:11.5px; color:#1e3a8a;">Kegiatan Prioritas Utama (KPU)</small></th>' +
            '<th class="th-amber" rowspan="2" style="width: 300px; min-width: 300px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">RPJMD<br><small style="font-weight:600; font-size:11.5px; color:#78350f;">Dukungan Program Pembangunan Daerah</small></th>' +
            '<th class="th-green" rowspan="2" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Nilai Keselarasan<br><small style="font-weight:600;">(0,5 / 1,0)</small></th>' +
            '<th class="th-amber" rowspan="2" style="width: 260px; min-width: 260px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 110px; min-width: 110px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Keselarasan Terbobot</th>' +
            '<th class="th-blue" rowspan="2" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Rata-rata Keselarasan Terbobot</th>' +
            '<th class="th-blue" colspan="3" style="display:none;">Referensi</th>' +
            '<th class="th-amber" rowspan="2" style="width: 160px; min-width: 160px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Catatan</th>' +
          '</tr>' +
          '<tr style="display:none;">' +
            '<th>Dokumen</th>' +
            '<th>Halaman</th>' +
            '<th>Tabel</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!kpuList || kpuList.length === 0){
      html += '<tr><td colspan="7" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data KPU RPJMN / Dukungan Program Daerah RPJMD pada menu terkait (/Daerah/DukunganKegiatanPrioritas). Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr>';
    } else {
      var isOverallFirstRow = true;

      kpuList.forEach(function(kpu, kpuIdx){
        var pdList = (kpu.pds && kpu.pds.length > 0) ? kpu.pds : [{ title: '-', score: 0.50 }];
        var pdCount = pdList.length;
        var kpuTerbobot = (kpu.keselarasan_terbobot !== undefined && kpu.keselarasan_terbobot !== null) ? parseFloat(kpu.keselarasan_terbobot) : (pdList[0].score !== undefined ? parseFloat(pdList[0].score) : 0.50);

        pdList.forEach(function(pd, pdIdx){
          var isStrip = (!pd.title || pd.title === '-');
          var curScore = (pd.score !== null && pd.score !== undefined) ? parseFloat(pd.score) : (isStrip ? 0.50 : 1.00);

          html += 
            '<tr class="ws-1a4-row" data-kpu-idx="' + kpuIdx + '" data-pd-idx="' + pdIdx + '" data-kpu-title="' + escapeHtml(kpu.kpu_title || '') + '">';

          // Col A: KPU RPJMN (Rowspan per KPU)
          if (pdIdx === 0){
            html += 
              '<td rowspan="' + pdCount + '" style="vertical-align: top; font-weight: 700; color: #1e3a8a; background: #f0f7ff; font-size: 12.5px; padding: 10px 8px; line-height: 1.5;">' +
                escapeHtml(kpu.kpu_title || '') +
              '</td>';
          }

          // Col B: RPJMD Dukungan Program Pembangunan Daerah
          html += 
            '<td style="vertical-align: middle; padding: 8px 10px; font-size: 12.5px; line-height: 1.5; color: ' + (isStrip ? '#94a3b8' : '#1e293b') + ';">' +
              '<span class="kpu-prog-title" style="font-weight: ' + (isStrip ? '400; font-style:italic' : '600') + ';">' + escapeHtml(pd.title || '-') + '</span>' +
            '</td>';

          // Col C: Nilai Keselarasan (0,5 / 1,0)
          html += 
            '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
              '<select class="calc-inp kpu-score-sel" style="text-align: center; font-weight: 700; font-size: 13px; height: 36px; padding: 4px 6px; border-radius: 6px; background: #ffffff; cursor: pointer;">' +
                '<option value="1.00"' + (curScore >= 1.0 ? ' selected' : '') + '>1</option>' +
                '<option value="0.50"' + (curScore < 1.0 ? ' selected' : '') + '>0.5</option>' +
              '</select>' +
            '</td>';

          // Col D: Keterangan (Rowspan per KPU)
          if (pdIdx === 0){
            var defaultKet = isStrip ? 'Tidak ada Dukungan Program Pembangunan Daerah untuk mendukung Kegiatan Prioritas Utama terkait' : 'Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Kegiatan Prioritas Utama terkait';
            html += 
              '<td rowspan="' + pdCount + '" style="vertical-align: top; padding: 8px 6px;">' +
                '<textarea class="calc-inp kpu-ket-inp" rows="3" style="width: 100%; resize: vertical; font-size: 12px; line-height: 1.45; padding: 6px 8px; border-radius: 6px; min-height: 70px;">' + escapeHtml(kpu.keterangan || defaultKet) + '</textarea>' +
              '</td>';

            // Col E: Keselarasan Terbobot (Rowspan per KPU)
            html += 
              '<td rowspan="' + pdCount + '" class="kpu-terbobot" data-kpu-idx="' + kpuIdx + '" style="text-align: center; vertical-align: middle; font-weight: 700; color: #1e3a8a; font-size: 13px; background: #f8fafc;">' +
                kpuTerbobot.toFixed(2) +
              '</td>';
          }

          // Col F: Rata-rata Keselarasan Terbobot (Rowspan across all rows pada baris pertama)
          if (isOverallFirstRow){
            html += 
              '<td rowspan="' + totalRowCount + '" class="kpu-grand-avg" style="text-align: center; vertical-align: middle; font-weight: 800; color: #dc2626; font-size: 16px; background: #ffffff; border-left: 2px solid #e2e8f0; border-right: 2px solid #e2e8f0;">' +
                grandAvgInitial.toFixed(2) +
              '</td>';
          }

          // Col G, H, I: Referensi (Hidden via style="display:none;" tetapi ada di DOM)
          if (pdIdx === 0){
            html += 
              '<td style="display:none;"><input type="hidden" class="kpu-dok-inp" value="' + escapeHtml(kpu.dokumen || 'RPJMN Tahun 2025-2029') + '"></td>' +
              '<td style="display:none;"><input type="hidden" class="kpu-hal-inp" value="' + escapeHtml(kpu.halaman || '270') + '"></td>' +
              '<td style="display:none;"><input type="hidden" class="kpu-tbl-inp" value="' + escapeHtml(kpu.tabel || 'Daftar Kegiatan Utama Pembangunan') + '"></td>';

            // Col J: Catatan (Rowspan per KPU)
            html += 
              '<td rowspan="' + pdCount + '" style="vertical-align: top; padding: 8px 6px;">' +
                '<textarea class="calc-inp kpu-catatan-inp" rows="3" style="width: 100%; resize: vertical; font-size: 12px; line-height: 1.45; padding: 6px 8px; border-radius: 6px; min-height: 70px;" placeholder="Catatan...">' + escapeHtml(kpu.catatan || '') + '</textarea>' +
              '</td>';
          }

          html += '</tr>';
          isOverallFirstRow = false;
        });
      });
    }

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background: #f1f5f9; font-weight: 700; border-top: 2px solid #cbd5e1;">' +
            '<td colspan="4" style="text-align: right; padding: 10px 14px; font-size: 13px; color: #1e293b;">Rata-rata Keselarasan Terbobot KPU:</td>' +
            '<td colspan="2" style="text-align: center; padding: 10px 12px; font-size: 15px; font-weight: 800; color: #dc2626;" id="ws1a4GrandTerbobotFooter">' + grandAvgInitial.toFixed(2) + '</td>' +
            '<td style="display:none;" colspan="3"></td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '</div>';

    html += renderStandardCriteriaCard({
      code: '1.a.4',
      safeId: 'ws1a4',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.4',
      badgeText: 'Proyek Prioritas Strategis (KPU)',
      colTitle: 'Kriteria',
      rows: [
        { crit: 'A', text: 'Tidak', val: 'A = 0, 5', color: '#dc2626' },
        { crit: 'B', text: 'Ya', val: 'B = 1', color: '#16a34a' }
      ],
      notes: [
        'Tidak artinya nilai keselarasan dibawah 0,50',
        'Ya artinya nilai keselarasan diatas 0,50'
      ],
      sourceTitle: 'Hasil Pemetaan KPU RPJMN (/Daerah/DukunganKegiatanPrioritas)',
      infoRows: [
        { label: 'Sumber Data:', value: 'Dukungan Kegiatan Prioritas Utama (KPU) RPJMN' },
        { label: 'Total KPU Terdata:', id: 'ws1a4CountMatched', value: '-' },
        { label: 'Rata-rata Keselarasan Terbobot:', id: 'ws1a4AvgPct', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a4CritText', value: '-' }
      ]
    });

    return html;
  }

  // 8. Sheet 1.a.5 (Komponen SPM RPJMD) sesuai Template HTML media_1793030444857.html
  function renderWs_1_a_5(d, maxBobot){
    d = d || {};
    var autoScore = getAutoScore_1_a_5(d);
    var spmData = autoScore.spmList;
    var grandAvg = autoScore.avg;

    // Hitung total row untuk rowspan Rata-rata Keselarasan Terbobot
    var totalRowCount = 0;
    spmData.forEach(function(b){
      var len = (b.ind_list && b.ind_list.length > 0) ? b.ind_list.length : 1;
      totalRowCount += len;
    });
    if (totalRowCount === 0) totalRowCount = 1;

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_5" style="min-width: 1250px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="th-green" rowspan="2" style="width: 220px; min-width: 220px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">PP No. 2 Tahun 2018 tentang SPM<br><small style="font-weight:600; font-size:11.5px; color:#14532d;">Bidang SPM</small></th>' +
            '<th class="th-blue" colspan="2" style="vertical-align: middle; font-size: 13px; padding: 8px; text-align: center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 130px; min-width: 130px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Nilai Keselarasan<br><small style="font-weight:600;">(0,5 / 1,0)</small></th>' +
            '<th class="th-amber" rowspan="2" style="width: 260px; min-width: 260px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 110px; min-width: 110px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Keselarasan Terbobot</th>' +
            '<th class="th-blue" rowspan="2" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Rata-rata Keselarasan Terbobot</th>' +
            '<th class="th-blue" colspan="3" style="display:none;">Referensi</th>' +
            '<th class="th-amber" rowspan="2" style="width: 160px; min-width: 160px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 200px; min-width: 200px; font-size: 12.5px; padding: 8px; text-align: center;">Bidang SPM</th>' +
            '<th class="th-blue" style="width: 280px; min-width: 280px; font-size: 12.5px; padding: 8px; text-align: center;">Indikator SPM</th>' +
            '<th style="display:none;">Dokumen</th>' +
            '<th style="display:none;">Halaman</th>' +
            '<th style="display:none;">Tabel</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!spmData || spmData.length === 0){
      return html + '<tr><td colspan="8" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data Komponen Indikator SPM RPJMD pada menu <b>/Daerah/SPM</b>. Silakan lengkapi data indikator SPM daerah terlebih dahulu.</td></tr></tbody></table></div>';
    }

    var isFirstGlobalRow = true;

    spmData.forEach(function(bid, bidIdx){
      var indList = (bid.ind_list && bid.ind_list.length > 0) ? bid.ind_list : [{ no: 1, name: '-', score: 0.50 }];
      var indCount = indList.length;
      var curTerb = (bid.keselarasan_terbobot !== undefined && bid.keselarasan_terbobot !== null) ? parseFloat(bid.keselarasan_terbobot) : 1.0;
      var curKet = bid.keterangan || (curTerb >= 1.0 ? 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait' : 'Tidak ada Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait');
      var curDok = bid.dokumen || 'RPJMD Kab Banyuwangi 2025-2029';
      var curHal = bid.halaman || '';
      var curTbl = bid.tabel || '';
      var curCat = bid.catatan || '';

      indList.forEach(function(ind, indIdx){
        var curScore = (ind.score !== null && ind.score !== undefined) ? parseFloat(ind.score) : 1.00;

        html += 
          '<tr class="ws-1a5-row" data-bid-idx="' + bidIdx + '" data-ind-idx="' + indIdx + '" data-bid-title="' + escapeHtml(bid.bidang_daerah || bid.bidang_nasional || '') + '" data-bid-nasional="' + escapeHtml(bid.bidang_nasional || '') + '">';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; font-weight: 700; color: #166534; background: #f0fdf4; font-size: 13px; padding: 10px 8px; line-height: 1.5;">' +
              escapeHtml(bid.bidang_nasional || '') +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; font-weight: 700; color: #1e3a8a; background: #f0f7ff; font-size: 13px; padding: 10px 8px; line-height: 1.5;">' +
              escapeHtml(bid.bidang_daerah || '') +
            '</td>';
        }

        html += 
          '<td style="vertical-align: middle; padding: 10px 12px; font-size: 13px; line-height: 1.5; color: #1e293b;">' +
            '<span class="spm-ind-name" style="font-weight: 500;">' + escapeHtml(ind.name || '') + '</span>' +
          '</td>';

        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<select class="calc-inp ind-score-sel" style="text-align: center; font-weight: 700; font-size: 13px; height: 38px; padding: 4px 6px; border-radius: 6px; background: #ffffff; cursor: pointer;">' +
              '<option value="1.00"' + (curScore >= 1.0 ? ' selected' : '') + '>1</option>' +
              '<option value="0.50"' + (curScore < 1.0 ? ' selected' : '') + '>0.5</option>' +
            '</select>' +
          '</td>';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; padding: 8px;">' +
              '<textarea class="calc-inp spm-ket-inp" rows="4" style="resize: vertical; font-size: 12.5px; line-height: 1.45; padding: 6px 8px; border-radius: 6px; min-height: 80px;">' + escapeHtml(curKet) + '</textarea>' +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" class="spm-bid-terbobot" data-bid-idx="' + bidIdx + '" style="vertical-align: middle; text-align: center; font-weight: 800; font-size: 14px; font-family: \'Roboto Mono\', monospace; background: #f0fdf4; color: #15803d; border: 1.5px solid #86efac; padding: 8px;">' +
              curTerb.toFixed(2) +
            '</td>';

          if (isFirstGlobalRow){
            html += 
              '<td rowspan="' + totalRowCount + '" class="spm-grand-avg" style="vertical-align: middle; text-align: center; font-weight: 900; font-size: 15px; font-family: \'Roboto Mono\', monospace; background: #eff6ff; color: #1d4ed8; border: 2px solid #93c5fd; padding: 10px;">' +
                grandAvg.toFixed(2) +
              '</td>';
            isFirstGlobalRow = false;
          }

          html += 
            '<td style="display:none;">' +
              '<input type="hidden" class="spm-dok-inp" value="' + escapeHtml(curDok) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="hidden" class="spm-hal-inp" value="' + escapeHtml(curHal) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="hidden" class="spm-tbl-inp" value="' + escapeHtml(curTbl) + '">' +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; padding: 8px;">' +
              '<textarea class="calc-inp spm-catatan-inp" rows="4" placeholder="Catatan bidang..." style="resize: vertical; font-size: 12px; line-height: 1.4; padding: 6px 8px; border-radius: 6px; min-height: 80px;">' + escapeHtml(curCat) + '</textarea>' +
            '</td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1;">' +
            '<td colspan="5" style="text-align: right; padding: 10px 12px; font-size: 13px; color: #334155;">Rata-rata Keselarasan Terbobot Seluruh Bidang SPM:</td>' +
            '<td colspan="2" id="ws1a5GrandTerbobotFooter" style="text-align: center; padding: 10px; font-size: 15px; font-weight: 800; color: #1d4ed8; font-family: \'Roboto Mono\', monospace; background: #dbeafe;">' +
              grandAvg.toFixed(2) +
            '</td>' +
            '<td style="display:none;" colspan="3"></td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '</div>';

    html += renderStandardCriteriaCard({
      code: '1.a.5',
      safeId: 'ws1a5',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.5',
      badgeText: 'Komponen SPM di RPJMD',
      colTitle: 'Kriteria',
      rows: [
        { crit: 'A', text: 'Tidak', val: 'A = 0, 5', color: '#dc2626' },
        { crit: 'B', text: 'Ya', val: 'B = 1', color: '#16a34a' }
      ],
      notes: [
        'Tidak artinya nilai keselarasan dibawah 0,50',
        'Ya artinya nilai keselarasan diatas 0,50'
      ],
      sourceTitle: 'Hasil Sinkronisasi Data SPM (/Daerah/SPM)',
      infoRows: [
        { label: 'Sumber Data:', value: 'Tabel Standar Pelayanan Minimal (SPM) RPJMD' },
        { label: 'Total Bidang SPM:', id: 'ws1a5CountMatched', value: '-' },
        { label: 'Rata-rata Keselarasan Terbobot:', id: 'ws1a5AvgPct', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a5CritText', value: '-' }
      ]
    });

    return html;
  }

  // 8.b Sheet 1.a.6 (Target SPM RPJMD/RKPD diselaraskan dengan Target SPM Nasional) sesuai Template HTML
  function renderWs_1_a_6(d, maxBobot){
    d = d || {};
    var autoScore = getAutoScore_1_a_6(d);
    var spmData = autoScore.spmList;
    var grandAvg = autoScore.avg;

    // Hitung total row untuk rowspan Rata-rata Keselarasan Terbobot
    var totalRowCount = 0;
    spmData.forEach(function(b){
      var len = (b.ind_list && b.ind_list.length > 0) ? b.ind_list.length : 1;
      totalRowCount += len;
    });
    if (totalRowCount === 0) totalRowCount = 1;

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_6" style="min-width: 1350px; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="th-green" rowspan="2" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">PP No. 2 Tahun 2018 tentang SPM<br><small style="font-weight:600; font-size:11.5px; color:#14532d;">Bidang SPM</small></th>' +
            '<th class="th-blue" colspan="4" style="vertical-align: middle; font-size: 13px; padding: 8px; text-align: center;">RPJMD</th>' +
            '<th class="th-green" rowspan="2" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Nilai Keselarasan<br><small style="font-weight:600;">(0,5 / 1,0)</small></th>' +
            '<th class="th-amber" rowspan="2" style="width: 240px; min-width: 240px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Keterangan</th>' +
            '<th class="th-blue" rowspan="2" style="width: 110px; min-width: 110px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Keselarasan Terbobot</th>' +
            '<th class="th-blue" rowspan="2" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Rata-rata Keselarasan Terbobot</th>' +
            '<th class="th-blue" colspan="3" style="display:none;">Referensi</th>' +
            '<th class="th-amber" rowspan="2" style="width: 160px; min-width: 160px; vertical-align: middle; font-size: 13px; padding: 10px 8px; text-align: center;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 180px; min-width: 180px; font-size: 12.5px; padding: 8px; text-align: center;">Bidang SPM</th>' +
            '<th class="th-blue" style="width: 260px; min-width: 260px; font-size: 12.5px; padding: 8px; text-align: center;">Indikator SPM</th>' +
            '<th class="th-blue" style="width: 90px; min-width: 90px; font-size: 12.5px; padding: 8px; text-align: center;">Target</th>' +
            '<th class="th-blue" style="width: 80px; min-width: 80px; font-size: 12.5px; padding: 8px; text-align: center;">Satuan</th>' +
            '<th style="display:none;">Dokumen</th>' +
            '<th style="display:none;">Halaman</th>' +
            '<th style="display:none;">Tabel</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    if (!spmData || spmData.length === 0){
      return html + '<tr><td colspan="10" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data Target SPM RPJMD pada menu <b>/Daerah/SPM</b>. Silakan lengkapi data target SPM daerah terlebih dahulu.</td></tr></tbody></table></div>';
    }

    var isFirstGlobalRow = true;

    spmData.forEach(function(bid, bidIdx){
      var indList = (bid.ind_list && bid.ind_list.length > 0) ? bid.ind_list : [{ no: 1, name: '-', target: '-', satuan: '-', score: 0.50 }];
      var indCount = indList.length;
      var curTerb = (bid.keselarasan_terbobot !== undefined && bid.keselarasan_terbobot !== null) ? parseFloat(bid.keselarasan_terbobot) : 1.0;
      var curKet = bid.keterangan || (curTerb >= 1.0 ? 'Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait' : 'Tidak ada Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait');
      var curDok = bid.dokumen || 'RPJMD Kab Banyuwangi 2025-2029';
      var curHal = bid.halaman || '';
      var curTbl = bid.tabel || '';
      var curCat = bid.catatan || 'Tidak ada target SPM pada dokumen RPJMD/RKPD';

      indList.forEach(function(ind, indIdx){
        var curScore = (ind.score !== null && ind.score !== undefined) ? parseFloat(ind.score) : 1.00;

        html += 
          '<tr class="ws-1a6-row" data-bid-idx="' + bidIdx + '" data-ind-idx="' + indIdx + '" data-bid-title="' + escapeHtml(bid.bidang_daerah || bid.bidang_nasional || '') + '" data-bid-nasional="' + escapeHtml(bid.bidang_nasional || '') + '">';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; font-weight: 700; color: #166534; background: #f0fdf4; font-size: 13px; padding: 10px 8px; line-height: 1.5;">' +
              escapeHtml(bid.bidang_nasional || '') +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; font-weight: 700; color: #1e3a8a; background: #f0f7ff; font-size: 13px; padding: 10px 8px; line-height: 1.5;">' +
              escapeHtml(bid.bidang_daerah || '') +
            '</td>';
        }

        html += 
          '<td style="vertical-align: middle; padding: 10px 12px; font-size: 13px; line-height: 1.5; color: #1e293b;">' +
            '<span class="spm-ind-name" style="font-weight: 500;">' + escapeHtml(ind.name || '') + '</span>' +
          '</td>';

        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<input type="text" class="calc-inp ind-target-inp" value="' + escapeHtml(ind.target || '-') + '" style="text-align: center; font-weight: 700; font-size: 12.5px; height: 36px; padding: 4px 6px; border-radius: 6px; width: 100%;">' +
          '</td>';

        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<input type="text" class="calc-inp ind-unit-inp" value="' + escapeHtml(ind.satuan || ind.unit || 'persen') + '" style="text-align: center; font-size: 12px; font-weight: 600; height: 36px; padding: 4px 6px; border-radius: 6px; width: 100%; color: #475569;">' +
          '</td>';

        html += 
          '<td style="text-align: center; vertical-align: middle; padding: 6px 8px;">' +
            '<select class="calc-inp ind-score-sel" style="text-align: center; font-weight: 700; font-size: 13px; height: 38px; padding: 4px 6px; border-radius: 6px; background: #ffffff; cursor: pointer;">' +
              '<option value="1.00"' + (curScore >= 1.0 ? ' selected' : '') + '>1</option>' +
              '<option value="0.50"' + (curScore < 1.0 ? ' selected' : '') + '>0.5</option>' +
            '</select>' +
          '</td>';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; padding: 8px;">' +
              '<textarea class="calc-inp spm-ket-inp" rows="4" style="resize: vertical; font-size: 12.5px; line-height: 1.45; padding: 6px 8px; border-radius: 6px; min-height: 80px;">' + escapeHtml(curKet) + '</textarea>' +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" class="spm-bid-terbobot" data-bid-idx="' + bidIdx + '" style="vertical-align: middle; text-align: center; font-weight: 800; font-size: 14px; font-family: \'Roboto Mono\', monospace; background: #f0fdf4; color: #15803d; border: 1.5px solid #86efac; padding: 8px;">' +
              curTerb.toFixed(2) +
            '</td>';

          if (isFirstGlobalRow){
            html += 
              '<td rowspan="' + totalRowCount + '" class="spm-grand-avg" style="vertical-align: middle; text-align: center; font-weight: 900; font-size: 15px; font-family: \'Roboto Mono\', monospace; background: #eff6ff; color: #1d4ed8; border: 2px solid #93c5fd; padding: 10px;">' +
                grandAvg.toFixed(2) +
              '</td>';
            isFirstGlobalRow = false;
          }

          html += 
            '<td style="display:none;">' +
              '<input type="hidden" class="spm-dok-inp" value="' + escapeHtml(curDok) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="hidden" class="spm-hal-inp" value="' + escapeHtml(curHal) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="hidden" class="spm-tbl-inp" value="' + escapeHtml(curTbl) + '">' +
            '</td>';

          html += 
            '<td rowspan="' + indCount + '" style="vertical-align: top; padding: 8px;">' +
              '<textarea class="calc-inp spm-catatan-inp" rows="4" placeholder="Catatan bidang..." style="resize: vertical; font-size: 12px; line-height: 1.4; padding: 6px 8px; border-radius: 6px; min-height: 80px;">' + escapeHtml(curCat) + '</textarea>' +
            '</td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1;">' +
            '<td colspan="7" style="text-align: right; padding: 10px 12px; font-size: 13px; color: #334155;">Rata-rata Keselarasan Terbobot Seluruh Bidang SPM:</td>' +
            '<td colspan="2" id="ws1a6GrandTerbobotFooter" style="text-align: center; padding: 10px; font-size: 15px; font-weight: 800; color: #1d4ed8; font-family: \'Roboto Mono\', monospace; background: #dbeafe;">' +
              grandAvg.toFixed(2) +
            '</td>' +
            '<td style="display:none;" colspan="3"></td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '</div>';

    html += renderStandardCriteriaCard({
      code: '1.a.6',
      safeId: 'ws1a6',
      title: 'Keterangan & Kriteria Penilaian Poin 1.a.6',
      badgeText: 'Target SPM di RPJMD',
      colTitle: 'Kriteria',
      rows: [
        { crit: 'A', text: 'Tidak', val: 'A = 0, 5', color: '#dc2626' },
        { crit: 'B', text: 'Ya', val: 'B = 1', color: '#16a34a' }
      ],
      notes: [
        'Tidak artinya nilai keselarasan dibawah 0,50',
        'Ya artinya nilai keselarasan diatas 0,50'
      ],
      sourceTitle: 'Hasil Sinkronisasi Data SPM (/Daerah/SPM)',
      infoRows: [
        { label: 'Sumber Data:', value: 'Tabel Standar Pelayanan Minimal (SPM) RPJMD/RKPD' },
        { label: 'Total Bidang SPM:', id: 'ws1a6CountMatched', value: '-' },
        { label: 'Rata-rata Keselarasan Terbobot:', id: 'ws1a6AvgPct', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1a6CritText', value: '-' }
      ]
    });

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
    var bobotVal = maxBobot !== undefined ? maxBobot : 0.75;
    var terbVal = d.score_terbobot !== undefined ? d.score_terbobot : (d.score !== undefined ? numFmt(d.score) : '0,75');
    var ref_dok = d.dokumen || AUTO_DATA_1_B_10_A.dokumen || 'RKPD Kab Banyuwangi 2026';
    var ref_hal = d.halaman || AUTO_DATA_1_B_10_A.halaman || 'IV-7';
    var ref_tbl = d.tabel || AUTO_DATA_1_B_10_A.tabel || 'Tabel 4.1';
    var catatan = d.catatan || AUTO_DATA_1_B_10_A.catatan || 'Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap';

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_1_b_10_a" style="min-width: 1100px; width: 100%; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th colspan="5" class="th-blue" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #e0f2fe; color: #0369a1; text-align: center; border-right: 2px solid #0284c7;">RKP</th>' +
            '<th colspan="5" class="th-amber" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #fef3c7; color: #92400e; text-align: center; border-right: 2px solid #d97706;">RKPD</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Realisasi 2023 (Margin Hitung)</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Realisasi 2023 (Keterangan)</th>' +
            '<th rowspan="3" style="display:none;">Nilai Keselarasan Target Realisasi 2023</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Tahun 2024 (Margin Hitung)</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Tahun 2024 (Keterangan)</th>' +
            '<th rowspan="3" style="display:none;">Nilai Keselarasan Target Tahun 2024</th>' +
            '<th rowspan="3" style="display:none;">Cek Gap Target 2023 dan 2024 (Margin Hitung)</th>' +
            '<th rowspan="3" style="display:none;">Cek Gap Target 2023 dan 2024 (Keterangan)</th>' +
            '<th rowspan="3" style="display:none;">Nilai Keselarasan Gap Target</th>' +
            '<th rowspan="3" style="width: 140px; min-width: 140px; vertical-align: middle; font-size: 13px; font-weight: 800; background: #dcfce7; color: #15803d; text-align: center; padding: 8px; border: 2px solid #86efac;">Nilai Keselarasan Rata-rata</th>' +
            '<th rowspan="3" style="width: 80px; min-width: 80px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Bobot</th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 13px; font-weight: 800; background: #e0f2fe; color: #0369a1; text-align: center; padding: 8px; border: 1.5px solid #7dd3fc;">Keselarasan Terbobot</th>' +
            '<th colspan="3" style="display:none;">Referensi</th>' +
            '<th rowspan="3" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-blue" style="width: 75px; min-width: 75px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #0284c7;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-amber" style="width: 75px; min-width: 75px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #d97706;">Satuan</th>' +
            '<th rowspan="2" style="display:none;">Dokumen</th>' +
            '<th rowspan="2" style="display:none;">Halaman</th>' +
            '<th rowspan="2" style="display:none;">Tabel</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-blue" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-blue" style="width: 80px; min-width: 80px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
            '<th class="th-amber" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-amber" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-amber" style="width: 80px; min-width: 80px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
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
              '<span class="cell-formula rkp-gap" style="font-weight: 800; font-size: 13.5px; color: #1e293b;">-0.32</span>' +
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
              '<span class="cell-formula rkpd-gap" style="font-weight: 800; font-size: 13.5px; color: #1e293b;">-0.18</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 600; color: #475569; border-right: 2px solid #d97706;">Persen</td>' +
            '<td style="display:none;">' +
              '<span class="margin-real-calc">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-real-ket">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="score-real-val">100.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-tgt-calc">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-tgt-ket">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="score-tgt-val">100.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-gap-calc">-43.75%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-gap-ket">43.75%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="score-gap-val">55.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #f0fdf4;">' +
              '<span class="badge-verif-pill avg-score-val" style="font-weight: 900; font-size: 14.5px; padding: 8px 14px; background: #dcfce7; color: #15803d; border-radius: 6px; border: 1.5px solid #86efac;">85.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 700; background: #f8fafc;">' +
              numFmt(bobotVal) +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #eff6ff;">' +
              '<span class="badge-verif-pill terb-val" style="font-weight: 900; font-size: 14px; padding: 6px 12px; background: #dbeafe; color: #1e40af; border-radius: 6px; border: 1px solid #93c5fd;">' + escapeHtml(terbVal) + '</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="ref-dok-inp" value="' + escapeHtml(ref_dok) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="ref-hal-inp" value="' + escapeHtml(ref_hal) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="ref-tbl-inp" value="' + escapeHtml(ref_tbl) + '">' +
            '</td>' +
            '<td style="vertical-align: middle; padding: 6px 8px;">' +
              '<input type="text" class="form-control catatan-inp" value="' + escapeHtml(catatan) + '" style="font-size: 12px; padding: 6px 8px; height: 36px; min-width: 180px;">' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '<div style="margin-top: 10px; padding: 10px 14px; background: #fff1f2; border: 1px solid #fecdd3; border-left: 4px solid #f43f5e; border-radius: 6px; color: #9f1239; font-size: 12.5px; font-weight: 600; font-style: italic;">' +
        '<i class="fa fa-info-circle"></i> Catatan: Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap' +
      '</div>' +
      '</div>';

    html += renderStandardCriteriaCard({
      code: '1.b.10.a',
      safeId: 'ws1b10a',
      title: 'Keterangan & Kriteria Penilaian Poin 1.b.10.a',
      badgeText: 'A. Tidak Selaras | B. Selaras',
      colTitle: 'Kriteria Keselarasan Target Tingkat Pengangguran Terbuka (TPT) RKPD terhadap RKP',
      rows: [
        { crit: 'A', text: 'Tidak Selaras (Nilai keselarasan di bawah 50%)', val: '0,375', color: '#dc2626' },
        { crit: 'B', text: 'Selaras (Nilai keselarasan di atas 50%)', val: '0,75', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Sinkronisasi Target Makro Tahunan',
      infoRows: [
        { label: 'Indikator:', value: 'Tingkat Pengangguran Terbuka (TPT)' },
        { label: 'Sumber Data:', value: 'Dokumen RKP (Nasional) & RKPD Daerah' },
        { label: 'Nilai Keselarasan:', id: 'ws1b10aAvgPct', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1b10aCritText', value: '-' }
      ]
    });

    return html;
  }

      // 9.b Sheet 1.b.10.b (Tingkat Kemiskinan RKP vs RKPD) - Tampilan Ringkas sampai Nilai Keselarasan
  function renderWs_1_b_10_b(d, maxBobot){
    d = d || {};
    var mn_real = d.mn_real !== undefined ? d.mn_real : (AUTO_DATA_1_B_10_B.mn_real || '8.57');
    var mn_tgt  = d.mn_target !== undefined ? d.mn_target : (AUTO_DATA_1_B_10_B.mn_target || '7.50');
    var md_real = d.md_real !== undefined ? d.md_real : (AUTO_DATA_1_B_10_B.md_real || '6.54');
    var md_tgt  = d.md_target !== undefined ? d.md_target : (AUTO_DATA_1_B_10_B.md_target || '5.59');
    var bobotVal = maxBobot !== undefined ? maxBobot : 0.75;
    var terbVal = d.score_terbobot !== undefined ? d.score_terbobot : (d.score !== undefined ? numFmt(d.score) : '0,75');
    var ref_dok = d.dokumen || AUTO_DATA_1_B_10_B.dokumen || 'RKPD Kab Banyuwangi 2026';
    var ref_hal = d.halaman || AUTO_DATA_1_B_10_B.halaman || 'IV-8';
    var ref_tbl = d.tabel || AUTO_DATA_1_B_10_B.tabel || 'Tabel 4.1';
    var catatan = d.catatan || AUTO_DATA_1_B_10_B.catatan || 'Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap';

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_1_b_10_b" style="min-width: 1100px; width: 100%; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th colspan="5" class="th-blue" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #e0f2fe; color: #0369a1; text-align: center; border-right: 2px solid #0284c7;">RKP</th>' +
            '<th colspan="5" class="th-amber" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #fef3c7; color: #92400e; text-align: center; border-right: 2px solid #d97706;">RKPD</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Realisasi 2023 (Margin Hitung)</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Realisasi 2023 (Keterangan)</th>' +
            '<th rowspan="3" style="display:none;">Nilai Keselarasan Target Realisasi 2023</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Tahun 2024 (Margin Hitung)</th>' +
            '<th rowspan="3" style="display:none;">Cek Target Tahun 2024 (Keterangan)</th>' +
            '<th rowspan="3" style="display:none;">Nilai Keselarasan Target Tahun 2024</th>' +
            '<th rowspan="3" style="display:none;">Cek Gap Target 2023 dan 2024 (Margin Hitung)</th>' +
            '<th rowspan="3" style="display:none;">Cek Gap Target 2023 dan 2024 (Keterangan)</th>' +
            '<th rowspan="3" style="display:none;">Nilai Keselarasan Gap Target</th>' +
            '<th rowspan="3" style="width: 140px; min-width: 140px; vertical-align: middle; font-size: 13px; font-weight: 800; background: #dcfce7; color: #15803d; text-align: center; padding: 8px; border: 2px solid #86efac;">Nilai Keselarasan Rata-rata</th>' +
            '<th rowspan="3" style="width: 80px; min-width: 80px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Bobot</th>' +
            '<th rowspan="3" style="width: 120px; min-width: 120px; vertical-align: middle; font-size: 13px; font-weight: 800; background: #e0f2fe; color: #0369a1; text-align: center; padding: 8px; border: 1.5px solid #7dd3fc;">Keselarasan Terbobot</th>' +
            '<th colspan="3" style="display:none;">Referensi</th>' +
            '<th rowspan="3" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 12.5px; font-weight: 700; background: #efefef; color: #000000; text-align: center; padding: 8px;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-blue" style="width: 75px; min-width: 75px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #0284c7;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width: 200px; min-width: 200px; vertical-align: middle; font-size: 13px; padding: 8px;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber" style="vertical-align: middle; font-size: 13px; padding: 6px;">Nilai</th>' +
            '<th rowspan="2" class="th-amber" style="width: 75px; min-width: 75px; vertical-align: middle; font-size: 13px; padding: 8px; border-right: 2px solid #d97706;">Satuan</th>' +
            '<th rowspan="2" style="display:none;">Dokumen</th>' +
            '<th rowspan="2" style="display:none;">Halaman</th>' +
            '<th rowspan="2" style="display:none;">Tabel</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-blue" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-blue" style="width: 80px; min-width: 80px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
            '<th class="th-amber" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Realisasi (2024)</th>' +
            '<th class="th-amber" style="width: 90px; min-width: 90px; font-size: 12px; padding: 6px;">Target Tahun Terakhir (2026)</th>' +
            '<th class="th-amber" style="width: 80px; min-width: 80px; font-size: 12px; font-style: italic; padding: 6px;">Gap</th>' +
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
            '<td style="vertical-align: middle; font-weight: 700; color: #92400e; background: #fffbeb; padding: 12px 10px;">Persentase Penduduk Miskin</td>' +
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
            '<td style="display:none;">' +
              '<span class="margin-real-calc">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-real-ket">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="score-real-val">100.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-tgt-calc">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-tgt-ket">0.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="score-tgt-val">100.00%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-gap-calc">-11.21%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="margin-gap-ket">11.21%</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<span class="score-gap-val">85.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #f0fdf4;">' +
              '<span class="badge-verif-pill avg-score-val" style="font-weight: 900; font-size: 14.5px; padding: 8px 14px; background: #dcfce7; color: #15803d; border-radius: 6px; border: 1.5px solid #86efac;">95.00%</span>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; font-weight: 700; background: #f8fafc;">' +
              numFmt(bobotVal) +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #eff6ff;">' +
              '<span class="badge-verif-pill terb-val" style="font-weight: 900; font-size: 14px; padding: 6px 12px; background: #dbeafe; color: #1e40af; border-radius: 6px; border: 1px solid #93c5fd;">' + escapeHtml(terbVal) + '</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="ref-dok-inp" value="' + escapeHtml(ref_dok) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="ref-hal-inp" value="' + escapeHtml(ref_hal) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="ref-tbl-inp" value="' + escapeHtml(ref_tbl) + '">' +
            '</td>' +
            '<td style="vertical-align: middle; padding: 6px 8px;">' +
              '<input type="text" class="form-control catatan-inp" value="' + escapeHtml(catatan) + '" style="font-size: 12px; padding: 6px 8px; height: 36px; min-width: 180px;">' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '<div style="margin-top: 10px; padding: 10px 14px; background: #fff1f2; border: 1px solid #fecdd3; border-left: 4px solid #f43f5e; border-radius: 6px; color: #9f1239; font-size: 12.5px; font-weight: 600; font-style: italic;">' +
        '<i class="fa fa-info-circle"></i> Catatan: Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap' +
      '</div>' +
      '</div>';

    html += renderStandardCriteriaCard({
      code: '1.b.10.b',
      safeId: 'ws1b10b',
      title: 'Keterangan & Kriteria Penilaian Poin 1.b.10.b',
      badgeText: 'A. Tidak Selaras | B. Selaras',
      colTitle: 'Kriteria Keselarasan Target Tingkat Kemiskinan RKPD terhadap RKP',
      rows: [
        { crit: 'A', text: 'Tidak Selaras (Nilai keselarasan di bawah 50%)', val: '0,375', color: '#dc2626' },
        { crit: 'B', text: 'Selaras (Nilai keselarasan di atas 50%)', val: '0,75', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Sinkronisasi Target Makro Tahunan',
      infoRows: [
        { label: 'Indikator:', value: 'Tingkat Kemiskinan (%)' },
        { label: 'Sumber Data:', value: 'Dokumen RKP (Nasional) & RKPD Daerah' },
        { label: 'Nilai Keselarasan:', id: 'ws1b10bAvgPct', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1b10bCritText', value: '-' }
      ]
    });

    return html;
  }

  // 9. Persandingan Keterkaitan Program/Kegiatan Prioritas RKP dengan Program Daerah (1.b.1.b, 1.b.1.d s.d 1.b.9.b)
  function renderWs_Persandingan_1b(code, d, maxBobot){
    d = d || {};
    var safeCode = code.replace(/\./g, '');
    var autoMap = {
      '1.b.1.b': typeof AUTO_DATA_1_B_1_B !== 'undefined' ? AUTO_DATA_1_B_1_B : {},
      '1.b.1.d': typeof AUTO_DATA_1_B_1_D !== 'undefined' ? AUTO_DATA_1_B_1_D : {},
      '1.b.2.b': typeof AUTO_DATA_1_B_2_B !== 'undefined' ? AUTO_DATA_1_B_2_B : {},
      '1.b.3.b': typeof AUTO_DATA_1_B_3_B !== 'undefined' ? AUTO_DATA_1_B_3_B : {},
      '1.b.4.b': typeof AUTO_DATA_1_B_4_B !== 'undefined' ? AUTO_DATA_1_B_4_B : {},
      '1.b.5.b': typeof AUTO_DATA_1_B_5_B !== 'undefined' ? AUTO_DATA_1_B_5_B : {},
      '1.b.6.b': typeof AUTO_DATA_1_B_6_B !== 'undefined' ? AUTO_DATA_1_B_6_B : {},
      '1.b.7.b': typeof AUTO_DATA_1_B_7_B !== 'undefined' ? AUTO_DATA_1_B_7_B : {},
      '1.b.8.b': typeof AUTO_DATA_1_B_8_B !== 'undefined' ? AUTO_DATA_1_B_8_B : {},
      '1.b.9.b': typeof AUTO_DATA_1_B_9_B !== 'undefined' ? AUTO_DATA_1_B_9_B : {}
    };
    var pnLabelMap = {
      '1.b.1.b': 'Sasaran Daerah vs PN RKP',
      '1.b.1.d': 'Prioritas Daerah vs PN RKP',
      '1.b.2.b': 'PN 1 RKP',
      '1.b.3.b': 'PN 2 RKP',
      '1.b.4.b': 'PN 3 RKP',
      '1.b.5.b': 'PN 4 RKP',
      '1.b.6.b': 'PN 5 RKP',
      '1.b.7.b': 'PN 6 RKP',
      '1.b.8.b': 'PN 7 RKP',
      '1.b.9.b': 'PN 8 RKP'
    };
    var auto = autoMap[code] || {};
    var statusTabel = d.status_tabel !== undefined ? d.status_tabel : (auto.status_tabel || (auto.is_ada ? 'Ada' : 'Tidak Ada'));
    var isAda = (statusTabel === 'Ada');
    var bobotVal = maxBobot !== undefined ? maxBobot : 0.625;
    var terbVal = isAda ? numFmt(bobotVal) : '0,000';
    if (d.score_terbobot !== undefined) {
      terbVal = d.score_terbobot;
    } else if (d.score !== undefined) {
      terbVal = numFmt(d.score);
    }
    var ref_dok = d.dokumen !== undefined ? d.dokumen : (auto.dokumen || '');
    var ref_hal = d.halaman !== undefined ? d.halaman : (auto.halaman || '');
    var ref_tbl = d.tabel !== undefined ? d.tabel : (auto.tabel || '');
    var catatan = d.catatan !== undefined ? d.catatan : (auto.catatan || '');

    var subTitle = (code === '1.b.1.d')
      ? 'Tabel Persandingan antara Prioritas Pembangunan Daerah RKPD dengan PN RKP'
      : ((code === '1.b.1.b') 
        ? 'Tersedianya persandingan tabel antara Sasaran Pembangunan daerah RKPD dengan PN RKP'
        : 'Informasi eksplisit persandingan keterkaitan. program prioritas/kegiatan prioritas RKP dengan program daerah');

    var colTitle = (code === '1.b.1.d')
      ? 'Kriteria Ketersediaan Tabel Persandingan antara Prioritas Pembangunan Daerah RKPD dengan PN RKP'
      : ((code === '1.b.1.b')
        ? 'Kriteria Ketersediaan Persandingan Tabel Antara Sasaran Pembangunan Daerah RKPD dengan PN RKP'
        : ('Kriteria Ketersediaan Informasi Eksplisit Persandingan Keterkaitan Program Prioritas/Kegiatan Prioritas RKP ' + (pnLabelMap[code] || '') + ' dengan Program Daerah'));

    var sourceTitle = 'Hasil Pemeriksaan Dokumen RKPD (' + (pnLabelMap[code] || '') + ')';
    var indText = (code === '1.b.1.d')
      ? 'Tersedianya tabel persandingan antara Prioritas Pembangunan Daerah RKPD dengan PN RKP'
      : ((code === '1.b.1.b')
        ? 'Tersedianya persandingan tabel antara Sasaran Pembangunan daerah RKPD dengan PN RKP'
        : 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah');

    var html = 
      '<div style="overflow-x:auto; padding-bottom:12px;">' +
      '<table class="excel-grid-table" id="wsTable_' + code.replace(/\./g, '_') + '" style="min-width: 850px; width: 100%; font-size: 13px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="th-amber" style="font-size: 13.5px; font-weight: 700; padding: 10px; background: #fef3c7; color: #92400e; text-align: center; border-right: 2px solid #d97706; width: 55%;">RKPD</th>' +
            '<th rowspan="2" class="th-blue" style="font-size: 13px; font-weight: 800; padding: 10px; background: #e0f2fe; color: #0369a1; text-align: center; vertical-align: middle; border: 1.5px solid #7dd3fc; width: 18%;">Keselarasan Terbobot</th>' +
            '<th colspan="3" style="display:none;">Referensi</th>' +
            '<th rowspan="2" class="th-gray" style="font-size: 12.5px; font-weight: 700; padding: 10px; background: #f8fafc; color: #334155; text-align: center; vertical-align: middle; width: 27%;">Catatan</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-amber" style="font-size: 12px; font-weight: 600; padding: 8px; background: #fffbeb; color: #78350f; text-align: center; border-right: 2px solid #d97706;">' + subTitle + '</th>' +
            '<th style="display:none;">Dokumen</th>' +
            '<th style="display:none;">Halaman</th>' +
            '<th style="display:none;">Tabel</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-persandingan-row ws-' + safeCode + '-row">' +
            '<td style="vertical-align: middle; padding: 10px 12px; border-right: 2px solid #d97706;">' +
              '<select id="wsSelectPersandingan' + safeCode + '" class="calc-inp status-tabel-select" style="font-weight: 700; font-size: 13.5px; height: 38px; border-radius: 6px; width: 100%; color: ' + (isAda ? '#16a34a' : '#dc2626') + '; background: ' + (isAda ? '#f0fdf4' : '#fef2f2') + '; border: 1.5px solid ' + (isAda ? '#86efac' : '#fca5a5') + ';">' +
                '<option value="Ada"' + (isAda ? ' selected' : '') + '>B. Ada</option>' +
                '<option value="Tidak Ada"' + (!isAda ? ' selected' : '') + '>A. Tidak ada</option>' +
              '</select>' +
            '</td>' +
            '<td style="vertical-align: middle; text-align: center; background: #eff6ff; border: 1.5px solid #7dd3fc;">' +
              '<span class="badge-verif-pill terb-val" style="font-weight: 900; font-size: 14px; padding: 6px 12px; background: #dbeafe; color: #1e40af; border-radius: 6px; border: 1px solid #93c5fd;">' + escapeHtml(terbVal) + '</span>' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="form-control ref-dok-inp" value="' + escapeHtml(ref_dok) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="form-control ref-hal-inp" value="' + escapeHtml(ref_hal) + '">' +
            '</td>' +
            '<td style="display:none;">' +
              '<input type="text" class="form-control ref-tbl-inp" value="' + escapeHtml(ref_tbl) + '">' +
            '</td>' +
            '<td style="vertical-align: middle; padding: 6px 8px;">' +
              '<input type="text" class="form-control catatan-inp" value="' + escapeHtml(catatan) + '" placeholder="Catatan..." style="font-size: 12px; padding: 6px 8px; height: 36px;">' +
            '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '<div style="margin-top: 10px; padding: 10px 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #3b82f6; border-radius: 6px; color: #1e293b; font-size: 12.5px; font-weight: 600;">' +
        '<i class="fa fa-camera" style="color: #3b82f6;"></i> Screenshot Tabel Persandingan di RKPD dapat diunggah melalui Bukti Dukung di bawah.' +
      '</div>' +
      '</div>';

    html += renderStandardCriteriaCard({
      code: code,
      safeId: 'ws' + safeCode,
      title: 'Keterangan & Kriteria Penilaian Poin ' + code,
      badgeText: 'A. Tidak ada | B. Ada',
      colTitle: colTitle,
      rows: [
        { crit: 'A', text: 'Tidak ada', val: '0', color: '#dc2626' },
        { crit: 'B', text: 'Ada', val: '0,625', color: '#16a34a' }
      ],
      sourceTitle: sourceTitle,
      infoRows: [
        { label: 'Indikator:', value: indText },
        { label: 'Sumber Data:', value: 'Dokumen RKPD Daerah' },
        { label: 'Status Ketersediaan:', id: 'ws' + safeCode + 'StatusText', value: isAda ? 'Ada' : 'Tidak Ada' },
        { label: 'Kriteria Terpenuhi:', id: 'ws' + safeCode + 'CritText', value: isAda ? 'Kriteria B (Ada)' : 'Kriteria A (Tidak ada)' }
      ]
    });

    return html;
  }

  function renderWs_1_b_1_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.1.b', d, maxBobot); }
  function renderWs_1_b_1_d(d, maxBobot){ return renderWs_Persandingan_1b('1.b.1.d', d, maxBobot); }
  function renderWs_1_b_2_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.2.b', d, maxBobot); }
  function renderWs_1_b_3_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.3.b', d, maxBobot); }
  function renderWs_1_b_4_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.4.b', d, maxBobot); }
  function renderWs_1_b_5_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.5.b', d, maxBobot); }
  function renderWs_1_b_6_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.6.b', d, maxBobot); }
  function renderWs_1_b_7_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.7.b', d, maxBobot); }
  function renderWs_1_b_8_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.8.b', d, maxBobot); }
  function renderWs_1_b_9_b(d, maxBobot){ return renderWs_Persandingan_1b('1.b.9.b', d, maxBobot); }

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

    html += renderStandardCriteriaCard({
      code: code,
      safeId: 'ws1b8',
      title: 'Keterangan & Kriteria Penilaian Poin ' + code,
      badgeText: 'Perhitungan Otomatis Margin',
      colTitle: 'Kriteria Keselarasan Target ' + indName + ' RKPD terhadap RKP',
      rows: [
        { crit: 'A', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' kurang dari 25% terhadap RKP', val: '0,000', color: '#dc2626' },
        { crit: 'B', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' sama dengan atau lebih dari 25% dan kurang dari 50% terhadap RKP', val: '0,156', color: '#d97706' },
        { crit: 'C', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' sama dengan atau lebih dari 50% dan kurang dari 75% terhadap RKP', val: '0,313', color: '#2563eb' },
        { crit: 'D', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' sama dengan atau lebih dari 75% dan kurang dari 100% terhadap RKP', val: '0,469', color: '#0891b2' },
        { crit: 'E', text: 'Rata-rata keselarasan capaian dan target ' + indName + ' mencapai 100% (selaras penuh / melampaui target nasional)', val: '0,625', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Sinkronisasi Target Makro RKPD',
      infoRows: [
        { label: 'Indikator:', value: indName },
        { label: 'Sumber Data:', value: 'Data Makro RKP & RKPD Daerah' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1b8AvgScore', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1b8CritText', value: '-' }
      ]
    });

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
      html += '<tr><td colspan="9" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px; background: #f8fafc;"><i class="fa fa-info-circle" style="margin-right: 8px; color: #3b82f6; font-size: 16px;"></i>Belum ada data Alokasi APBD untuk Prioritas Nasional / Major Project pada menu terkait (dukungan KPU APBD). Data akan otomatis terisi saat data diinputkan pada menu terkait.</td></tr>';
    } else {
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
    }

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

    html += renderStandardCriteriaCard({
      code: '1.c.1',
      safeId: 'ws1c1',
      title: 'Keterangan & Kriteria Penilaian Poin 1.c.1',
      badgeText: 'Alokasi APBD untuk Prioritas Nasional',
      colTitle: 'Kriteria Ketersediaan Dukungan APBD terhadap Prioritas Nasional / Major Project',
      rows: [
        { crit: 'A', text: 'Ketersediaan alokasi APBD terhadap Prioritas Nasional / Major Project sama dengan atau kurang dari 25%', val: '2,000', color: '#dc2626' },
        { crit: 'B', text: 'Ketersediaan alokasi APBD terhadap Prioritas Nasional / Major Project lebih dari 25% dan sama dengan atau kurang dari 50%', val: '4,000', color: '#d97706' },
        { crit: 'C', text: 'Ketersediaan alokasi APBD terhadap Prioritas Nasional / Major Project lebih dari 50% dan sama dengan atau kurang dari 75%', val: '6,000', color: '#2563eb' },
        { crit: 'D', text: 'Ketersediaan alokasi APBD terhadap Prioritas Nasional / Major Project lebih dari 75% dan sama dengan atau kurang dari 99%', val: '8,000', color: '#0891b2' },
        { crit: 'E', text: 'Ketersediaan alokasi APBD terhadap Prioritas Nasional / Major Project 100% (seluruh Major Project terdanai dalam APBD)', val: '10,000', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Pemetaan Alokasi Anggaran APBD',
      infoRows: [
        { label: 'Sumber Data:', value: 'Dukungan Sub Kegiatan RKPD & Pagu APBD' },
        { label: 'Subkegiatan Terdanai:', id: 'ws1c1CountMatched', value: '-' },
        { label: 'Rata-rata Keselarasan:', id: 'ws1c1AvgPct', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws1c1CritText', value: '-' }
      ]
    });

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

    html += renderStandardCriteriaCard({
      code: '3.a.1.a',
      safeId: 'ws3a1a',
      title: 'Keterangan & Kriteria Penilaian Poin 3.a.1.a',
      badgeText: 'Penetapan OPD Penanggungjawab',
      colTitle: 'Kriteria Penetapan OPD Penanggungjawab Program Prioritas Daerah',
      rows: [
        { crit: 'A', text: 'Tidak ada atau kurang dari 25% program prioritas daerah yang ditetapkan OPD penanggungjawab', val: '0,000', color: '#dc2626' },
        { crit: 'B', text: 'Lebih dari 25% dan sama dengan atau kurang dari 50% program prioritas daerah ditetapkan OPD penanggungjawab', val: '0,125', color: '#d97706' },
        { crit: 'C', text: 'Lebih dari 50% dan sama dengan atau kurang dari 75% program prioritas daerah ditetapkan OPD penanggungjawab', val: '0,250', color: '#2563eb' },
        { crit: 'D', text: 'Lebih dari 75% dan sama dengan atau kurang dari 99% program prioritas daerah ditetapkan OPD penanggungjawab', val: '0,375', color: '#0891b2' },
        { crit: 'E', text: '100% seluruh program prioritas daerah telah ditetapkan OPD penanggungjawab secara tepat', val: '0,500', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Penetapan OPD Penanggungjawab',
      infoRows: [
        { label: 'Sumber Data:', value: 'Program Prioritas Daerah & OPD Penanggungjawab' },
        { label: 'Persentase Penetapan:', id: 'ws3a1aPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws3a1aCritText', value: '-' }
      ]
    });

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

    html += renderStandardCriteriaCard({
      code: '3.a.1.b',
      safeId: 'ws3a1b',
      title: 'Keterangan & Kriteria Penilaian Poin 3.a.1.b',
      badgeText: 'Target Sasaran Daerah vs IKU OPD',
      colTitle: 'Kriteria Keselarasan Target Sasaran Daerah dengan IKU Renstra/Renja OPD',
      rows: [
        { crit: 'A', text: 'Rata-rata keselarasan target daerah dengan IKU OPD kurang dari 25%', val: '0,000', color: '#dc2626' },
        { crit: 'B', text: 'Rata-rata keselarasan target daerah dengan IKU OPD sama dengan atau lebih dari 25% dan kurang dari 50%', val: '0,125', color: '#d97706' },
        { crit: 'C', text: 'Rata-rata keselarasan target daerah dengan IKU OPD sama dengan atau lebih dari 50% dan kurang dari 75%', val: '0,250', color: '#2563eb' },
        { crit: 'D', text: 'Rata-rata keselarasan target daerah dengan IKU OPD sama dengan atau lebih dari 75% dan kurang dari 100%', val: '0,375', color: '#0891b2' },
        { crit: 'E', text: 'Rata-rata keselarasan target daerah dengan IKU OPD mencapai 100% (selaras penuh / melampaui target daerah)', val: '0,500', color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Penyelarasan IKU OPD',
      infoRows: [
        { label: 'Sumber Data:', value: 'Target RPJMD/RKPD vs IKU Renstra/Renja OPD' },
        { label: 'Rata-rata Keselarasan:', id: 'ws3a1bPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'ws3a1bCritText', value: '-' }
      ]
    });

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

    var bA = '0,000';
    var bB = numFmt(0.25 * maxBobot);
    var bC = numFmt(0.50 * maxBobot);
    var bD = numFmt(0.75 * maxBobot);
    var bE = numFmt(maxBobot);

    html += renderStandardCriteriaCard({
      code: code,
      safeId: 'wsGen',
      title: 'Keterangan & Kriteria Penilaian Poin ' + code,
      badgeText: 'Parameter Pemenuhan Indikator',
      colTitle: 'Kriteria Tingkat Pemenuhan Parameter Indikator IPPD',
      rows: [
        { crit: 'A', text: 'Pemenuhan parameter kriteria indikator sama dengan atau kurang dari 25%', val: bA, color: '#dc2626' },
        { crit: 'B', text: 'Pemenuhan parameter kriteria indikator lebih dari 25% dan sama dengan atau kurang dari 50%', val: bB, color: '#d97706' },
        { crit: 'C', text: 'Pemenuhan parameter kriteria indikator lebih dari 50% dan sama dengan atau kurang dari 75%', val: bC, color: '#2563eb' },
        { crit: 'D', text: 'Pemenuhan parameter kriteria indikator lebih dari 75% dan sama dengan atau kurang dari 99%', val: bD, color: '#0891b2' },
        { crit: 'E', text: 'Pemenuhan parameter kriteria indikator 100% (seluruh kriteria dan justifikasi terpenuhi lengkap)', val: bE, color: '#16a34a' }
      ],
      sourceTitle: 'Hasil Evaluasi Parameter IPPD',
      infoRows: [
        { label: 'Sumber Data:', value: 'Pedoman Penilaian Indikator IPPD' },
        { label: 'Rata-rata Pemenuhan:', id: 'wsGenPctMatched', value: '-' },
        { label: 'Kriteria Terpenuhi:', id: 'wsGenCritText', value: '-' }
      ]
    });

    return html;
  }

  // Master Dispatcher for Worksheet Rendering
  function renderDynamicWorksheet(code, maxBobot, detailData){
    if (code === '1.a.1.a') return renderWs_1_a_1_a(detailData, maxBobot);
    if (code === '1.a.1.b') return renderWs_1_a_1_b(detailData, maxBobot);
    if (code === '1.a.1.d') return renderWs_TabelPersandingan(code, detailData, maxBobot);
    if (code === '1.a.1.c') return renderWs_1_a_1_c(detailData, maxBobot);
    if (code === '1.a.2.a') return renderWs_1_a_2_a(detailData, maxBobot);
    if (code === '1.a.2.b') return renderWs_1_a_2_b(detailData, maxBobot);
    if (code === '1.a.2.c') return renderWs_1_a_2_c(detailData, maxBobot);
    if (code === '1.a.2.d') return renderWs_1_a_2_d(detailData, maxBobot);
    if (code === '1.a.2.e') return renderWs_1_a_2_e(detailData, maxBobot);
    if (code.indexOf('1.a.2.') === 0) return renderWs_1_a_2_b_to_g(code, detailData, maxBobot);
    if (code === '1.a.3.a' || code === '1.a.3.b') return renderWs_1_a_3(code, detailData, maxBobot);
    if (code === '1.a.4') return renderWs_1_a_4(detailData, maxBobot);
    if (code === '1.a.5') return renderWs_1_a_5(detailData, maxBobot);
    if (code === '1.a.6') return renderWs_1_a_6(detailData, maxBobot);
    if (code === '1.b.10.a') return renderWs_1_b_10_a(detailData, maxBobot);
    if (code === '1.b.10.b') return renderWs_1_b_10_b(detailData, maxBobot);
    if (code === '1.b.8.a') return renderWs_1_b_8(code, detailData, maxBobot);
    if (code === '1.b.1.b' || code === '1.b.1.d' || code === '1.b.2.b' || code === '1.b.3.b' || code === '1.b.4.b' || code === '1.b.5.b' || code === '1.b.6.b' || code === '1.b.7.b' || code === '1.b.8.b' || code === '1.b.9.b') {
      return renderWs_Persandingan_1b(code, detailData, maxBobot);
    }
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

    // 1. Sheet 1.a.1.a Formula Execution (Kesesuaian Indikator Sasaran RPJMD vs PN RPJMN)
    if (code === '1.a.1.a'){
      var rows = document.querySelectorAll("#wsTable_1_a_1_a .ws-1a1a-row");
      var matchedCount = 0;
      var totalRows = rows.length || 3;

      rows.forEach(function(row){
        var mnB = parseFloat(row.querySelector(".mn-base").value) || 0;
        var mnE = parseFloat(row.querySelector(".mn-end").value) || 0;
        var mdB_val = (row.querySelector(".md-base") ? row.querySelector(".md-base").value : "").trim();
        var mdE_val = (row.querySelector(".md-end")  ? row.querySelector(".md-end").value  : "").trim();

        var mnGap = mnE - mnB;
        var mdGap = (parseFloat(mdE_val) || 0) - (parseFloat(mdB_val) || 0);
        var elMnGap = row.querySelector(".mn-gap"); if (elMnGap) elMnGap.textContent = numFmt(mnGap);
        var elMdGap = row.querySelector(".md-gap"); if (elMdGap) elMdGap.textContent = numFmt(mdGap);

        // Indikator dianggap lengkap & selaras jika memiliki data target RPJMD dari sinkronisasi data
        var hasMdData = (mdB_val !== "" && !isNaN(parseFloat(mdB_val))) || (mdE_val !== "" && !isNaN(parseFloat(mdE_val)));
        if (hasMdData){
          matchedCount++;
        }
      });

      var pctMatched = totalRows > 0 ? (matchedCount / totalRows) * 100 : 0;
      var critLetter = 'A';
      var critText = 'A. Tidak ada keterkaitan';
      var critBg = '#f1f5f9';
      var critColor = '#475569';

      if (matchedCount === 0){
        computedFinalScore = 0;
        critLetter = 'A';
        critText = 'A. Tidak ada keterkaitan';
        critBg = '#fef2f2';
        critColor = '#dc2626';
      } else if (pctMatched < 50){
        computedFinalScore = 0.3;
        critLetter = 'B';
        critText = 'B. Kurang dari 50% sesuai dengan PN RPJMN';
        critBg = '#fffbeb';
        critColor = '#d97706';
      } else {
        computedFinalScore = 0.5;
        critLetter = 'C';
        critText = 'C. Di atas atau sama dengan 50% sesuai dengan PN RPJMN';
        critBg = '#f0fdf4';
        critColor = '#16a34a';
      }

      updateStandardCriteriaHighlight('ws1a1a', critLetter, computedFinalScore, {
        'ws1a1aCountMatched': matchedCount + " dari " + totalRows + " Indikator",
        'ws1a1aPctMatched': pctMatched.toFixed(0) + "%",
        'ws1a1aCritText': "Kriteria " + critLetter
      }, ['A', 'B', 'C']);

      if (excelFxContent) {
        excelFxContent.textContent = "Kelengkapan Indikator RPJMD: " + matchedCount + "/" + totalRows + " (" + pctMatched.toFixed(0) + "%) -> Kriteria " + critLetter + " -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // 2. Sheet 1.a.1.b (Tabel Persandingan Sasaran RPJMD vs PN RPJMN)
    else if (code === '1.a.1.b'){
      var sel = document.getElementById("wsSelectPersandingan");
      var isAda = sel ? (sel.value === 'Ada') : true;
      computedFinalScore = isAda ? 0.5 : 0.0;
      var critLetter = isAda ? 'B' : 'A';
      var critText = isAda ? 'B. Ada' : 'A. Tidak ada';
      var critBg = isAda ? '#f0fdf4' : '#fef2f2';
      var critColor = isAda ? '#16a34a' : '#dc2626';

      var elRes = document.getElementById("ws1a1bTerbobotCell");
      if (elRes) {
        elRes.textContent = numFmt(computedFinalScore);
        elRes.style.color = critColor;
      }

      updateStandardCriteriaHighlight('ws1a1b', critLetter, computedFinalScore, {
        'ws1a1bStatusText': isAda ? 'Ada (Tersedia dalam Dokumen)' : 'Tidak Ada (Belum Tersedia)',
        'ws1a1bCritText': "Kriteria " + critLetter + " (" + (isAda ? "Ada" : "Tidak ada") + ")"
      }, ['A', 'B']);

      if (excelFxContent) {
        excelFxContent.textContent = "Status Ketersediaan: " + (isAda ? "Ada (Kriteria B)" : "Tidak Ada (Kriteria A)") + " -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // 2b. Sheet 1.a.1.d Persandingan Prioritas Daerah RPJMD vs PN RPJMN
    else if (code === '1.a.1.d'){
      var sel = document.getElementById("wsSelectPersandingan1d") || document.getElementById("wsSelectPersandingan");
      var isAda = sel ? (sel.value === 'Ada') : true;
      computedFinalScore = isAda ? maxBobot : 0.0;
      var critLetter = isAda ? 'B' : 'A';
      var critText = isAda ? 'B. Ada' : 'A. Tidak ada';
      var critBg = isAda ? '#f0fdf4' : '#fef2f2';
      var critColor = isAda ? '#16a34a' : '#dc2626';

      var elTerbCell = document.getElementById("ws1a1dTerbobotCell");
      if (elTerbCell) {
        elTerbCell.textContent = numFmt(computedFinalScore);
        elTerbCell.style.color = critColor;
      }

      updateStandardCriteriaHighlight('ws1a1d', critLetter, computedFinalScore, {
        'ws1a1dStatusText': isAda ? "B. Ada (Tersedia)" : "A. Tidak Ada",
        'ws1a1dCritText': critText
      }, ['A', 'B']);

      if (excelFxContent) {
        excelFxContent.textContent = "Status Ketersediaan: " + (isAda ? "Ada (Kriteria B)" : "Tidak Ada (Kriteria A)") + " -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // 3. Sheet 1.a.1.c Matrix (Prioritas Daerah vs PN RPJMN)
    else if (code === '1.a.1.c'){
      var allTerbobotSum = 0;
      var pnGroups = {};

      document.querySelectorAll("#wsTable_1_a_1_c .ws-matrix-row").forEach(function(row){
        var pnIdx = row.getAttribute("data-pn-idx");
        if (!pnGroups[pnIdx]) pnGroups[pnIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 0;
        pnGroups[pnIdx].push(val);
      });

      var totalPns = Object.keys(pnGroups).length || 8;
      var matchedPns = 0;

      Object.keys(pnGroups).forEach(function(pnIdx){
        var scores = pnGroups[pnIdx];
        var maxScore = Math.max.apply(null, scores);
        var isAligned = maxScore > 0;
        if (isAligned) matchedPns++;

        var pnAvgVal = isAligned ? 1.0 : 0.0;
        var terbobot = pnAvgVal * maxBobot;
        allTerbobotSum += terbobot;

        var firstRow = document.querySelector('#wsTable_1_a_1_c .ws-matrix-row[data-pn-idx="' + pnIdx + '"]');
        if (firstRow){
          var avgCell = firstRow.querySelector(".pn-avg-cell");
          var terbCell = firstRow.querySelector(".pn-terbobot-cell");
          if (avgCell) avgCell.textContent = isAligned ? "100%" : "0%";
          if (terbCell) {
            terbCell.textContent = numFmt(terbobot);
            terbCell.style.color = isAligned ? '#16a34a' : '#dc2626';
          }
        }
      });

      var pctMatched = totalPns > 0 ? (matchedPns / totalPns) * 100 : 0;
      var avgTerbobot = totalPns > 0 ? (allTerbobotSum / totalPns) : 0;

      var elAvgPct = document.getElementById("ws1a1cAvgPctCell");
      if (elAvgPct) elAvgPct.textContent = pctMatched.toFixed(2) + "%";

      var elGrand = document.getElementById("ws1a1cGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(avgTerbobot);

      // Range Penilaian Kriteria:
      // A. Tidak ada keterkaitan -> 0
      // B. Kurang dari 50% sesuai dengan PN RPJMN -> 0,3
      // C. Di atas atau sama dengan 50% sesuai dengan PN RPJMN -> 0,5
      var crit = 'A';
      var critScore = 0.0;
      var critLabel = 'A. Tidak ada keterkaitan';

      if (matchedPns === 0) {
        crit = 'A';
        critScore = 0.0;
        critLabel = 'A. Tidak ada keterkaitan';
      } else if (pctMatched < 50.0) {
        crit = 'B';
        critScore = 0.3;
        critLabel = 'B. Kurang dari 50% sesuai dengan PN RPJMN';
      } else {
        crit = 'C';
        critScore = maxBobot; // 0.5
        critLabel = 'C. Di atas atau sama dengan 50% sesuai dengan PN RPJMN';
      }

      computedFinalScore = critScore;

      updateStandardCriteriaHighlight('ws1a1c', crit, critScore, {
        'ws1a1cCountMatched': matchedPns + " dari " + totalPns + " PN",
        'ws1a1cPctMatched': pctMatched.toFixed(2) + "%",
        'ws1a1cCritText': critLabel
      }, ['A', 'B', 'C']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pctMatched.toFixed(2) + "% (" + critLabel + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // 4. Sheet 1.a.2.a
    else if (code === '1.a.2.a'){
      var totalRows = 0;
      var sumScore = 0;
      document.querySelectorAll("#wsTable_1_a_2_a .ws-pp-row").forEach(function(row){
        totalRows++;
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        sumScore += val;
        if (scoreSel) {
          scoreSel.style.color = val >= 1.0 ? '#16a34a' : '#dc2626';
        }
      });

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      var crit = 'E';
      var critLabel = '100% Selaras';
      var scoreVal = 0.375;

      if (totalRows === 0) {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      } else if (pct >= 100) {
        crit = 'E';
        critLabel = '100%';
        scoreVal = 0.375;
      } else if (pct > 75) {
        crit = 'D';
        critLabel = '> 75% s.d <= 99%';
        scoreVal = 0.300;
      } else if (pct > 50) {
        crit = 'C';
        critLabel = '> 50% s.d <= 75%';
        scoreVal = 0.225;
      } else if (pct > 25) {
        crit = 'B';
        critLabel = '> 25% s.d <= 50%';
        scoreVal = 0.150;
      } else {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      }

      computedFinalScore = scoreVal;

      // Update table cells
      var avgCell = document.getElementById("ws1a2aAvgCell");
      if (avgCell) avgCell.textContent = Math.round(pct) + "%";

      var terbCell = document.getElementById("ws1a2aTerbobotCell");
      if (terbCell) terbCell.textContent = numFmt(scoreVal);

      updateStandardCriteriaHighlight('ws1a2a', crit, computedFinalScore, {
        'ws1a2aPctMatched': pct.toFixed(2) + "% (" + Math.round(sumScore) + "/" + totalRows + " Selaras)",
        'ws1a2aCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pct.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // Sheet 1.a.2.b (PN 2 Program Prioritas Pembangunan Nasional)
    else if (code === '1.a.2.b'){
      var ppGroups = {};
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_b .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        ppGroups[ppIdx].push(val);
        totalRows++;
        sumScore += val;
      });

      // Update per-PP averages and terbobot
      Object.keys(ppGroups).forEach(function(ppIdx){
        var scores = ppGroups[ppIdx];
        var avg = scores.reduce(function(a,b){return a+b;}, 0) / (scores.length || 1);
        var terbobot = avg * maxBobot;
        var avgCell = document.getElementById("ws1a2bPpAvg_" + ppIdx);
        var terbCell = document.getElementById("ws1a2bPpTerb_" + ppIdx);
        if (avgCell) avgCell.textContent = Math.round(avg * 100) + "%";
        if (terbCell) terbCell.textContent = numFmt(terbobot);
      });

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      var crit = 'E';
      var critLabel = '100%';
      var scoreVal = 0.375;

      if (totalRows === 0) {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      } else if (pct >= 100) {
        crit = 'E';
        critLabel = '100%';
        scoreVal = 0.375;
      } else if (pct > 75) {
        crit = 'D';
        critLabel = '> 75% s/d <= 99%';
        scoreVal = 0.300;
      } else if (pct > 50) {
        crit = 'C';
        critLabel = '> 50% s/d <= 75%';
        scoreVal = 0.225;
      } else if (pct > 25) {
        crit = 'B';
        critLabel = '> 25% s/d <= 50%';
        scoreVal = 0.150;
      } else {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      }

      computedFinalScore = scoreVal;

      // Update table bottom summary cells
      var avgCell = document.getElementById("ws1a2bAvgCell");
      if (avgCell) avgCell.textContent = Math.round(pct) + "%";

      var terbCell = document.getElementById("ws1a2bTerbobotCell");
      if (terbCell) terbCell.textContent = numFmt(scoreVal);

      var terbCell2 = document.getElementById("ws1a2bTerbobotCell2");
      if (terbCell2) terbCell2.textContent = numFmt(scoreVal);

      var rataTerbGrand = document.getElementById("ws1a2bGrandRataTerbobotCell");
      if (rataTerbGrand) rataTerbGrand.textContent = numFmt(scoreVal);

      updateStandardCriteriaHighlight('ws1a2b', crit, scoreVal, {
        'ws1a2bPctMatched': pct.toFixed(2) + "% (" + Math.round(sumScore) + "/" + totalRows + " Selaras)",
        'ws1a2bCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pct.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // Sheet 1.a.2.c (PN 3 Program Prioritas Pembangunan Nasional)
    else if (code === '1.a.2.c'){
      var ppGroups = {};
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_c .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        ppGroups[ppIdx].push(val);
        totalRows++;
        sumScore += val;
      });

      // Update per-PP averages and terbobot
      Object.keys(ppGroups).forEach(function(ppIdx){
        var scores = ppGroups[ppIdx];
        var avg = scores.reduce(function(a,b){return a+b;}, 0) / (scores.length || 1);
        var terbobot = avg * maxBobot;
        var avgCell = document.getElementById("ws1a2cPpAvg_" + ppIdx);
        var terbCell = document.getElementById("ws1a2cPpTerb_" + ppIdx);
        if (avgCell) avgCell.textContent = Math.round(avg * 100) + "%";
        if (terbCell) terbCell.textContent = numFmt(terbobot);
      });

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      var crit = 'E';
      var critLabel = '100%';
      var scoreVal = 0.375;

      if (totalRows === 0) {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      } else if (pct >= 100) {
        crit = 'E';
        critLabel = '100%';
        scoreVal = 0.375;
      } else if (pct > 75) {
        crit = 'D';
        critLabel = '> 75% s/d <= 99%';
        scoreVal = 0.300;
      } else if (pct > 50) {
        crit = 'C';
        critLabel = '> 50% s/d <= 75%';
        scoreVal = 0.225;
      } else if (pct > 25) {
        crit = 'B';
        critLabel = '> 25% s/d <= 50%';
        scoreVal = 0.150;
      } else {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      }

      computedFinalScore = scoreVal;

      // Update table bottom summary cells
      var avgCell = document.getElementById("ws1a2cAvgCell");
      if (avgCell) avgCell.textContent = Math.round(pct) + "%";

      var terbCell = document.getElementById("ws1a2cTerbobotCell");
      if (terbCell) terbCell.textContent = numFmt(scoreVal);

      var terbCell2 = document.getElementById("ws1a2cTerbobotCell2");
      if (terbCell2) terbCell2.textContent = numFmt(scoreVal);

      var rataTerbGrand = document.getElementById("ws1a2cGrandRataTerbobotCell");
      if (rataTerbGrand) rataTerbGrand.textContent = numFmt(scoreVal);

      updateStandardCriteriaHighlight('ws1a2c', crit, scoreVal, {
        'ws1a2cPctMatched': pct.toFixed(2) + "% (" + Math.round(sumScore) + "/" + totalRows + " Selaras)",
        'ws1a2cCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pct.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // Sheet 1.a.2.d (PN 4 Program Prioritas Pembangunan Nasional)
    else if (code === '1.a.2.d'){
      var ppGroups = {};
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_d .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        ppGroups[ppIdx].push(val);
        totalRows++;
        sumScore += val;
      });

      // Update per-PP averages and terbobot
      Object.keys(ppGroups).forEach(function(ppIdx){
        var scores = ppGroups[ppIdx];
        var avg = scores.reduce(function(a,b){return a+b;}, 0) / (scores.length || 1);
        var terbobot = avg * maxBobot;
        var avgCell = document.getElementById("ws1a2dPpAvg_" + ppIdx);
        var terbCell = document.getElementById("ws1a2dPpTerb_" + ppIdx);
        if (avgCell) avgCell.textContent = Math.round(avg * 100) + "%";
        if (terbCell) terbCell.textContent = numFmt(terbobot);
      });

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      var crit = 'E';
      var critLabel = '100%';
      var scoreVal = 0.375;

      if (totalRows === 0) {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      } else if (pct >= 100) {
        crit = 'E';
        critLabel = '100%';
        scoreVal = 0.375;
      } else if (pct > 75) {
        crit = 'D';
        critLabel = '> 75% s/d <= 99%';
        scoreVal = 0.300;
      } else if (pct > 50) {
        crit = 'C';
        critLabel = '> 50% s/d <= 75%';
        scoreVal = 0.225;
      } else if (pct > 25) {
        crit = 'B';
        critLabel = '> 25% s/d <= 50%';
        scoreVal = 0.150;
      } else {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      }

      computedFinalScore = scoreVal;

      // Update table bottom summary cells
      var avgCell = document.getElementById("ws1a2dAvgCell");
      if (avgCell) avgCell.textContent = Math.round(pct) + "%";

      var terbCell = document.getElementById("ws1a2dTerbobotCell");
      if (terbCell) terbCell.textContent = numFmt(scoreVal);

      var terbCell2 = document.getElementById("ws1a2dTerbobotCell2");
      if (terbCell2) terbCell2.textContent = numFmt(scoreVal);

      var rataTerbGrand = document.getElementById("ws1a2dGrandRataTerbobotCell");
      if (rataTerbGrand) rataTerbGrand.textContent = numFmt(scoreVal);

      updateStandardCriteriaHighlight('ws1a2d', crit, scoreVal, {
        'ws1a2dPctMatched': pct.toFixed(2) + "% (" + Math.round(sumScore) + "/" + totalRows + " Selaras)",
        'ws1a2dCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pct.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // Sheet 1.a.2.e (PN 5 Program Prioritas Pembangunan Nasional)
    else if (code === '1.a.2.e'){
      var ppGroups = {};
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_e .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        ppGroups[ppIdx].push(val);
        totalRows++;
        sumScore += val;
      });

      // Update per-PP averages and terbobot
      Object.keys(ppGroups).forEach(function(ppIdx){
        var scores = ppGroups[ppIdx];
        var avg = scores.reduce(function(a,b){return a+b;}, 0) / (scores.length || 1);
        var terbobot = avg * maxBobot;
        var avgCell = document.getElementById("ws1a2ePpAvg_" + ppIdx);
        var terbCell = document.getElementById("ws1a2ePpTerb_" + ppIdx);
        if (avgCell) avgCell.textContent = Math.round(avg * 100) + "%";
        if (terbCell) terbCell.textContent = numFmt(terbobot);
      });

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      var crit = 'E';
      var critLabel = '100%';
      var scoreVal = 0.375;

      if (totalRows === 0) {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      } else if (pct >= 100) {
        crit = 'E';
        critLabel = '100%';
        scoreVal = 0.375;
      } else if (pct > 75) {
        crit = 'D';
        critLabel = '> 75% s/d <= 99%';
        scoreVal = 0.300;
      } else if (pct > 50) {
        crit = 'C';
        critLabel = '> 50% s/d <= 75%';
        scoreVal = 0.225;
      } else if (pct > 25) {
        crit = 'B';
        critLabel = '> 25% s/d <= 50%';
        scoreVal = 0.150;
      } else {
        crit = 'A';
        critLabel = '<= 25%';
        scoreVal = 0.075;
      }

      computedFinalScore = scoreVal;

      // Update table bottom summary cells
      var avgCell = document.getElementById("ws1a2eAvgCell");
      if (avgCell) avgCell.textContent = Math.round(pct) + "%";

      var terbCell = document.getElementById("ws1a2eTerbobotCell");
      if (terbCell) terbCell.textContent = numFmt(scoreVal);

      var terbCell2 = document.getElementById("ws1a2eTerbobotCell2");
      if (terbCell2) terbCell2.textContent = numFmt(scoreVal);

      var rataTerbGrand = document.getElementById("ws1a2eGrandRataTerbobotCell");
      if (rataTerbGrand) rataTerbGrand.textContent = numFmt(scoreVal);

      updateStandardCriteriaHighlight('ws1a2e', crit, scoreVal, {
        'ws1a2ePctMatched': pct.toFixed(2) + "% (" + Math.round(sumScore) + "/" + totalRows + " Selaras)",
        'ws1a2eCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pct.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
    }

    // 5. Sheets 1.a.2.f s.d 1.a.2.h
    else if (code.indexOf('1.a.2.') === 0){
      var ppGroups = {};
      var totalRows = 0;
      var sumScore = 0;
      document.querySelectorAll("#wsTable_1_a_2_bg .ws-ppbg-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        if (!ppGroups[ppIdx]) ppGroups[ppIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        var val = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        ppGroups[ppIdx].push(val);
        totalRows++;
        sumScore += val;
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

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      var crit = 'E';
      var critLabel = '100%';
      var scoreVal = 0.375;

      if (totalRows === 0) {
        crit = 'A'; critLabel = '<= 25%'; scoreVal = 0.075;
      } else if (pct >= 100) {
        crit = 'E'; critLabel = '100%'; scoreVal = 0.375;
      } else if (pct > 75) {
        crit = 'D'; critLabel = '> 75% s/d <= 99%'; scoreVal = 0.300;
      } else if (pct > 50) {
        crit = 'C'; critLabel = '> 50% s/d <= 75%'; scoreVal = 0.225;
      } else if (pct > 25) {
        crit = 'B'; critLabel = '> 25% s/d <= 50%'; scoreVal = 0.150;
      } else {
        crit = 'A'; critLabel = '<= 25%'; scoreVal = 0.075;
      }

      computedFinalScore = scoreVal;
      var elGrand = document.getElementById("ws1a2bgGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);

      updateStandardCriteriaHighlight('ws1a2bg', crit, scoreVal, {
        'ws1a2bgPctMatched': pct.toFixed(2) + "% (" + Math.round(sumScore) + "/" + totalRows + " Selaras)",
        'ws1a2bgCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan: " + pct.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
      }
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

        var crit = 'A';
        var critLabel = '< 25%';
        if (rowAvg >= 100) { crit = 'E'; critLabel = '100% (Selaras Penuh)'; }
        else if (rowAvg >= 75) { crit = 'D'; critLabel = '>= 75% s.d < 100%'; }
        else if (rowAvg >= 50) { crit = 'C'; critLabel = '>= 50% s.d < 75%'; }
        else if (rowAvg >= 25) { crit = 'B'; critLabel = '>= 25% s.d < 50%'; }
        else { crit = 'A'; critLabel = '< 25%'; }

        updateStandardCriteriaHighlight('ws1a3', crit, computedFinalScore, {
          'ws1a3AvgScore': rowAvg.toFixed(2) + "%",
          'ws1a3CritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
        }, ['A', 'B', 'C', 'D', 'E']);

        if (excelFxContent) {
          excelFxContent.textContent = "Rata-rata Keselarasan: " + rowAvg.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
        }
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

        var terbCell = document.querySelector('#wsTable_1_a_4 .kpu-terbobot[data-kpu-idx="' + kpuIdx + '"]');
        if (terbCell){
          terbCell.textContent = avg.toFixed(2);
        }
      });

      var grandAvg = kpuCount > 0 ? (allKpuSum / kpuCount) : 0.50;

      // Update display cell Rata-rata Keselarasan Terbobot
      var elGrandCell = document.querySelector("#wsTable_1_a_4 .kpu-grand-avg");
      if (elGrandCell) elGrandCell.textContent = grandAvg.toFixed(2);

      var elGrandFooter = document.getElementById("ws1a4GrandTerbobotFooter");
      if (elGrandFooter) elGrandFooter.textContent = grandAvg.toFixed(2);

      // Kriteria 2 Tingkat:
      // A. Tidak -> A = 0,5 (nilai keselarasan dibawah 0,50)
      // B. Ya    -> B = 1   (nilai keselarasan diatas atau sama dengan 0,50)
      var crit = (grandAvg >= 0.50) ? 'B' : 'A';
      var critScore = (grandAvg >= 0.50) ? 1.0 : 0.5;
      var critLabel = (grandAvg >= 0.50) ? 'Ya (Nilai keselarasan >= 0,50)' : 'Tidak (Nilai keselarasan < 0,50)';
      computedFinalScore = critScore * maxBobot;

      updateStandardCriteriaHighlight('ws1a4', crit, computedFinalScore, {
        'ws1a4CountMatched': kpuCount + " KPU RPJMN",
        'ws1a4AvgPct': grandAvg.toFixed(2),
        'ws1a4CritText': '<span style="color:' + (crit === 'B' ? '#16a34a' : '#dc2626') + '; font-weight:700;">Kriteria ' + crit + ' (' + (crit === 'B' ? 'B = 1' : 'A = 0, 5') + ')</span>'
      }, ['A', 'B']);

      modalBobotInput.value = computedFinalScore.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      modalCalcDisplay.textContent = numFmt(modalBobotInput.value);
      syncExcelScoreUI(modalBobotInput.value, maxBobot);
      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan Terbobot KPU = " + grandAvg.toFixed(2) + " -> Kriteria " + crit + " (" + (crit === 'B' ? 'Ya (B = 1)' : 'Tidak (A = 0, 5)') + ") = " + numFmt(computedFinalScore);
      }
    }

    // 8. Sheet 1.a.5 (Komponen SPM RPJMD) Sesuai Rumus Rata-rata Terbobot Bidang SPM
    else if (code === '1.a.5'){
      var bidGroups = {};
      document.querySelectorAll("#wsTable_1_a_5 .ws-1a5-row").forEach(function(row){
        var bidIdx = row.getAttribute("data-bid-idx");
        if (!bidGroups[bidIdx]) bidGroups[bidIdx] = [];
        var scoreSel = row.querySelector(".ind-score-sel");
        bidGroups[bidIdx].push(scoreSel ? parseFloat(scoreSel.value) : 0.50);
      });

      var allBidSum = 0;
      var bidCount = 0;
      Object.keys(bidGroups).forEach(function(bidIdx){
        var scores = bidGroups[bidIdx];
        var avg = scores.length > 0 ? (scores.reduce(function(a,b){return a+b;},0) / scores.length) : 0.50;
        allBidSum += avg;
        bidCount++;

        var terbCell = document.querySelector('#wsTable_1_a_5 .spm-bid-terbobot[data-bid-idx="' + bidIdx + '"]');
        if (terbCell){
          terbCell.textContent = avg.toFixed(2);
        }
      });

      var grandAvg = bidCount > 0 ? (allBidSum / bidCount) : 0.50;

      // Update display cell Rata-rata Keselarasan Terbobot
      var elGrandCell = document.querySelector("#wsTable_1_a_5 .spm-grand-avg");
      if (elGrandCell) elGrandCell.textContent = grandAvg.toFixed(2);

      var elGrandFooter = document.getElementById("ws1a5GrandTerbobotFooter");
      if (elGrandFooter) elGrandFooter.textContent = grandAvg.toFixed(2);

      // Kriteria 2 Tingkat:
      // A. Tidak -> A = 0,5 (nilai keselarasan dibawah 0,50)
      // B. Ya    -> B = 1   (nilai keselarasan diatas atau sama dengan 0,50)
      var crit = (grandAvg >= 0.50) ? 'B' : 'A';
      var critScore = (grandAvg >= 0.50) ? 1.0 : 0.5;
      computedFinalScore = critScore * maxBobot;

      updateStandardCriteriaHighlight('ws1a5', crit, computedFinalScore, {
        'ws1a5CountMatched': bidCount + " Bidang SPM",
        'ws1a5AvgPct': grandAvg.toFixed(2),
        'ws1a5CritText': '<span style="color:' + (crit === 'B' ? '#16a34a' : '#dc2626') + '; font-weight:700;">Kriteria ' + crit + ' (' + (crit === 'B' ? 'B = 1' : 'A = 0, 5') + ')</span>'
      }, ['A', 'B']);

      modalBobotInput.value = computedFinalScore.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      modalCalcDisplay.textContent = numFmt(modalBobotInput.value);
      syncExcelScoreUI(modalBobotInput.value, maxBobot);
      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan Terbobot SPM = " + grandAvg.toFixed(2) + " -> Kriteria " + crit + " (" + (crit === 'B' ? 'Ya (B = 1)' : 'Tidak (A = 0, 5)') + ") = " + numFmt(computedFinalScore);
      }
    }

    // 8.b Sheet 1.a.6 (Target SPM) Sesuai Rumus Rata-rata Terbobot Bidang SPM
    else if (code === '1.a.6'){
      var bidGroups = {};
      document.querySelectorAll("#wsTable_1_a_6 .ws-1a6-row").forEach(function(row){
        var bidIdx = row.getAttribute("data-bid-idx");
        if (!bidGroups[bidIdx]) bidGroups[bidIdx] = [];
        var scoreSel = row.querySelector(".ind-score-sel");
        bidGroups[bidIdx].push(scoreSel ? parseFloat(scoreSel.value) : 0.50);
      });

      var allBidSum = 0;
      var bidCount = 0;
      Object.keys(bidGroups).forEach(function(bidIdx){
        var scores = bidGroups[bidIdx];
        var avg = scores.length > 0 ? (scores.reduce(function(a,b){return a+b;},0) / scores.length) : 0.50;
        allBidSum += avg;
        bidCount++;

        var terbCell = document.querySelector('#wsTable_1_a_6 .spm-bid-terbobot[data-bid-idx="' + bidIdx + '"]');
        if (terbCell){
          terbCell.textContent = avg.toFixed(2);
        }
      });

      var grandAvg = bidCount > 0 ? (allBidSum / bidCount) : 0.50;

      // Update display cell Rata-rata Keselarasan Terbobot
      var elGrandCell = document.querySelector("#wsTable_1_a_6 .spm-grand-avg");
      if (elGrandCell) elGrandCell.textContent = grandAvg.toFixed(2);

      var elGrandFooter = document.getElementById("ws1a6GrandTerbobotFooter");
      if (elGrandFooter) elGrandFooter.textContent = grandAvg.toFixed(2);

      // Kriteria 2 Tingkat:
      // A. Tidak -> A = 0,5 (nilai keselarasan dibawah 0,50)
      // B. Ya    -> B = 1   (nilai keselarasan diatas atau sama dengan 0,50)
      var crit = (grandAvg >= 0.50) ? 'B' : 'A';
      var critScore = (grandAvg >= 0.50) ? 1.0 : 0.5;
      computedFinalScore = critScore * maxBobot;

      updateStandardCriteriaHighlight('ws1a6', crit, computedFinalScore, {
        'ws1a6CountMatched': bidCount + " Bidang SPM",
        'ws1a6AvgPct': grandAvg.toFixed(2),
        'ws1a6CritText': '<span style="color:' + (crit === 'B' ? '#16a34a' : '#dc2626') + '; font-weight:700;">Kriteria ' + crit + ' (' + (crit === 'B' ? 'B = 1' : 'A = 0, 5') + ')</span>'
      }, ['A', 'B']);

      modalBobotInput.value = computedFinalScore.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      modalCalcDisplay.textContent = numFmt(modalBobotInput.value);
      syncExcelScoreUI(modalBobotInput.value, maxBobot);
      if (excelFxContent) {
        excelFxContent.textContent = "Rata-rata Keselarasan Terbobot SPM = " + grandAvg.toFixed(2) + " -> Kriteria " + crit + " (" + (crit === 'B' ? 'Ya (B = 1)' : 'Tidak (A = 0, 5)') + ") = " + numFmt(computedFinalScore);
      }
    }

    // 9.a Sheet 1.b.10.a (TPT RKP vs RKPD Makro)
    else if (code === '1.b.10.a'){
      var tblId = 'wsTable_1_b_10_a';
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

        var crit = 'A';
        var critLabel = 'Tidak Selaras';
        if (avgScore >= 50.0) {
          crit = 'B';
          critLabel = 'Selaras';
          computedFinalScore = 0.75;
        } else {
          crit = 'A';
          critLabel = 'Tidak Selaras';
          computedFinalScore = 0.375;
        }

        modalBobotInput.value = numFmt(computedFinalScore);
        modalCalcDisplay.textContent = numFmt(computedFinalScore);
        syncExcelScoreUI(modalBobotInput.value, maxBobot);

        var elTerb = row.querySelector(".terb-val");
        if (elTerb) elTerb.textContent = numFmt(computedFinalScore);

        var elRefDok = row.querySelector(".ref-dok-inp");
        if (elRefDok && modalRefDokumen && modalRefDokumen.value !== elRefDok.value) modalRefDokumen.value = elRefDok.value;
        var elRefHal = row.querySelector(".ref-hal-inp");
        if (elRefHal && modalRefHalaman && modalRefHalaman.value !== elRefHal.value) modalRefHalaman.value = elRefHal.value;
        var elRefTbl = row.querySelector(".ref-tbl-inp");
        if (elRefTbl && modalRefTabel && modalRefTabel.value !== elRefTbl.value) modalRefTabel.value = elRefTbl.value;
        var elCatatan = row.querySelector(".catatan-inp");
        if (elCatatan && modalCatatan && modalCatatan.value !== elCatatan.value) modalCatatan.value = elCatatan.value;

        var safeId = 'ws1b10a';
        var infoMap = {};
        infoMap[safeId + 'AvgPct'] = avgScore.toFixed(2) + "%";
        infoMap[safeId + 'CritText'] = '<span style="color:' + (crit === 'B' ? '#16a34a' : '#dc2626') + '; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>';

        updateStandardCriteriaHighlight(safeId, crit, computedFinalScore, infoMap, ['A', 'B']);

        if (excelFxContent) {
          excelFxContent.textContent = "Nilai Keselarasan: " + avgScore.toFixed(2) + "% -> Kriteria " + crit + " (" + critLabel + ") = " + numFmt(computedFinalScore);
        }
      }
    }

    // 9.b Sheet 1.b.10.b (Kemiskinan RKP vs RKPD Makro)
    else if (code === '1.b.10.b'){
      var tblId = 'wsTable_1_b_10_b';
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

        var crit = 'A';
        var critLabel = 'Tidak Selaras';
        if (avgScore >= 50.0) {
          crit = 'B';
          critLabel = 'Selaras';
          computedFinalScore = 0.75;
        } else {
          crit = 'A';
          critLabel = 'Tidak Selaras';
          computedFinalScore = 0.375;
        }

        modalBobotInput.value = numFmt(computedFinalScore);
        modalCalcDisplay.textContent = numFmt(computedFinalScore);
        syncExcelScoreUI(modalBobotInput.value, maxBobot);

        var elTerb = row.querySelector(".terb-val");
        if (elTerb) elTerb.textContent = numFmt(computedFinalScore);

        var elRefDok = row.querySelector(".ref-dok-inp");
        if (elRefDok && modalRefDokumen && modalRefDokumen.value !== elRefDok.value) modalRefDokumen.value = elRefDok.value;
        var elRefHal = row.querySelector(".ref-hal-inp");
        if (elRefHal && modalRefHalaman && modalRefHalaman.value !== elRefHal.value) modalRefHalaman.value = elRefHal.value;
        var elRefTbl = row.querySelector(".ref-tbl-inp");
        if (elRefTbl && modalRefTabel && modalRefTabel.value !== elRefTbl.value) modalRefTabel.value = elRefTbl.value;
        var elCatatan = row.querySelector(".catatan-inp");
        if (elCatatan && modalCatatan && modalCatatan.value !== elCatatan.value) modalCatatan.value = elCatatan.value;

        var safeId = 'ws1b10b';
        var infoMap = {};
        infoMap[safeId + 'AvgPct'] = avgScore.toFixed(2) + "%";
        infoMap[safeId + 'CritText'] = '<span style="color:' + (crit === 'B' ? '#16a34a' : '#dc2626') + '; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>';

        updateStandardCriteriaHighlight(safeId, crit, computedFinalScore, infoMap, ['A', 'B']);

        if (excelFxContent) {
          excelFxContent.textContent = "Nilai Keselarasan: " + avgScore.toFixed(2) + "% -> Kriteria " + crit + " (" + critLabel + ") = " + numFmt(computedFinalScore);
        }
      }
    }

    // 9. Persandingan Keterkaitan Program/Kegiatan Prioritas RKP dengan Program Daerah (1.b.1.b, 1.b.1.d s.d 1.b.9.b)
    else if (code === '1.b.1.b' || code === '1.b.1.d' || code === '1.b.2.b' || code === '1.b.3.b' || code === '1.b.4.b' || code === '1.b.5.b' || code === '1.b.6.b' || code === '1.b.7.b' || code === '1.b.8.b' || code === '1.b.9.b') {
      var safeCode = code.replace(/\./g, '');
      var sel = document.getElementById("wsSelectPersandingan" + safeCode);
      var isAda = sel ? (sel.value === 'Ada') : false;
      var maxBobot = parseFloat(modalBobotMaks.value) || 0.625;
      computedFinalScore = isAda ? maxBobot : 0.0;
      var crit = isAda ? 'B' : 'A';
      var critLabel = isAda ? 'Ada' : 'Tidak ada';

      modalBobotInput.value = numFmt(computedFinalScore);
      modalCalcDisplay.textContent = numFmt(computedFinalScore);
      syncExcelScoreUI(modalBobotInput.value, maxBobot);

      var tableId = "#wsTable_" + code.replace(/\./g, '_');
      var elTerb = document.querySelector(tableId + " .terb-val");
      if (elTerb) {
        elTerb.textContent = numFmt(computedFinalScore);
      }
      if (sel) {
        sel.style.color = isAda ? '#16a34a' : '#dc2626';
        sel.style.background = isAda ? '#f0fdf4' : '#fef2f2';
        sel.style.borderColor = isAda ? '#86efac' : '#fca5a5';
      }

      var elRefDok = document.querySelector(tableId + " .ref-dok-inp");
      if (elRefDok && modalRefDokumen && modalRefDokumen.value !== elRefDok.value) modalRefDokumen.value = elRefDok.value;
      var elRefHal = document.querySelector(tableId + " .ref-hal-inp");
      if (elRefHal && modalRefHalaman && modalRefHalaman.value !== elRefHal.value) modalRefHalaman.value = elRefHal.value;
      var elRefTbl = document.querySelector(tableId + " .ref-tbl-inp");
      if (elRefTbl && modalRefTabel && modalRefTabel.value !== elRefTbl.value) modalRefTabel.value = elRefTbl.value;
      var elCatatan = document.querySelector(tableId + " .catatan-inp");
      if (elCatatan && modalCatatan && modalCatatan.value !== elCatatan.value) modalCatatan.value = elCatatan.value;

      var safeId = 'ws' + safeCode;
      var infoMap = {};
      infoMap[safeId + 'StatusText'] = isAda ? 'Ada (Tersedia)' : 'Tidak Ada';
      infoMap[safeId + 'CritText'] = '<span style="color:' + (isAda ? '#16a34a' : '#dc2626') + '; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ') = ' + numFmt(computedFinalScore) + '</span>';

      updateStandardCriteriaHighlight(safeId, crit, computedFinalScore, infoMap, ['A', 'B']);

      if (excelFxContent) {
        excelFxContent.textContent = "Ketersediaan: " + (isAda ? "Ada" : "Tidak Ada") + " -> Kriteria " + crit + " (" + critLabel + ") = " + numFmt(computedFinalScore);
      }
    }

    // 9. Sheet 1.b.8.a (RKP vs RKPD Makro)
    else if (code === '1.b.8.a'){
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

        var crit = 'A';
        var critLabel = '< 25%';
        if (rowAvg >= 100) { crit = 'E'; critLabel = '100% (Selaras Penuh)'; }
        else if (rowAvg >= 75) { crit = 'D'; critLabel = '>= 75% s.d < 100%'; }
        else if (rowAvg >= 50) { crit = 'C'; critLabel = '>= 50% s.d < 75%'; }
        else if (rowAvg >= 25) { crit = 'B'; critLabel = '>= 25% s.d < 50%'; }
        else { crit = 'A'; critLabel = '< 25%'; }

        updateStandardCriteriaHighlight('ws1b8', crit, computedFinalScore, {
          'ws1b8AvgScore': rowAvg.toFixed(2) + "%",
          'ws1b8CritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
        }, ['A', 'B', 'C', 'D', 'E']);

        if (excelFxContent) {
          excelFxContent.textContent = "Rata-rata Keselarasan: " + rowAvg.toFixed(2) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
        }
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
      var pct = avgRatio * 100;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("ws1c1GrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);

      var crit = 'A';
      var critLabel = '<= 25%';
      if (pct >= 100) { crit = 'E'; critLabel = '100% (Selaras Penuh)'; }
      else if (pct > 75) { crit = 'D'; critLabel = '> 75% s/d <= 99%'; }
      else if (pct > 50) { crit = 'C'; critLabel = '> 50% s/d <= 75%'; }
      else if (pct > 25) { crit = 'B'; critLabel = '> 25% s/d <= 50%'; }
      else { crit = 'A'; critLabel = '<= 25%'; }

      updateStandardCriteriaHighlight('ws1c1', crit, computedFinalScore, {
        'ws1c1CountMatched': count + " Sub Kegiatan",
        'ws1c1AvgPct': pct.toFixed(1) + "%",
        'ws1c1CritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

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
      var pct = avgRatio * 100;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("ws3a1aGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);

      var crit = 'A';
      var critLabel = '<= 25%';
      if (pct >= 100) { crit = 'E'; critLabel = '100% (Seluruh Program Ada OPD)'; }
      else if (pct > 75) { crit = 'D'; critLabel = '> 75% s/d <= 99%'; }
      else if (pct > 50) { crit = 'C'; critLabel = '> 50% s/d <= 75%'; }
      else if (pct > 25) { crit = 'B'; critLabel = '> 25% s/d <= 50%'; }
      else { crit = 'A'; critLabel = '<= 25%'; }

      updateStandardCriteriaHighlight('ws3a1a', crit, computedFinalScore, {
        'ws3a1aPctMatched': pct.toFixed(1) + "% (" + Math.round(sumScore) + "/" + rows.length + " OPD Ditetapkan)",
        'ws3a1aCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) excelFxContent.textContent = "Penetapan OPD: " + pct.toFixed(1) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
    }

    // 12. Sheet 3.a.1.b (Target Daerah vs IKU OPD)
    else if (code === '3.a.1.b'){
      var rows = document.querySelectorAll("#wsTable_3_a_1_b .ws-3a1b-row");
      var sumTerb = 0;
      var sumScorePct = 0;
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
        sumScorePct += scorePct;
      });

      var avgScorePct = rows.length > 0 ? (sumScorePct / rows.length) : 100;
      computedFinalScore = rows.length > 0 ? (sumTerb / rows.length) : maxBobot;
      var elGrand = document.getElementById("ws3a1bGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);

      var crit = 'A';
      var critLabel = '< 25%';
      if (avgScorePct >= 100) { crit = 'E'; critLabel = '100% (Selaras Penuh)'; }
      else if (avgScorePct >= 75) { crit = 'D'; critLabel = '>= 75% s.d < 100%'; }
      else if (avgScorePct >= 50) { crit = 'C'; critLabel = '>= 50% s.d < 75%'; }
      else if (avgScorePct >= 25) { crit = 'B'; critLabel = '>= 25% s.d < 50%'; }
      else { crit = 'A'; critLabel = '< 25%'; }

      updateStandardCriteriaHighlight('ws3a1b', crit, computedFinalScore, {
        'ws3a1bPctMatched': avgScorePct.toFixed(1) + "% (" + rows.length + " IKU Terukur)",
        'ws3a1bCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) excelFxContent.textContent = "Rata-rata Keselarasan IKU OPD: " + avgScorePct.toFixed(1) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
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
      var pct = avgRatio * 100;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("wsGenGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);

      var crit = 'A';
      var critLabel = '<= 25%';
      if (pct >= 100) { crit = 'E'; critLabel = '100% (Memenuhi Sepenuhnya)'; }
      else if (pct > 75) { crit = 'D'; critLabel = '> 75% s/d <= 99%'; }
      else if (pct > 50) { crit = 'C'; critLabel = '> 50% s/d <= 75%'; }
      else if (pct > 25) { crit = 'B'; critLabel = '> 25% s/d <= 50%'; }
      else { crit = 'A'; critLabel = '<= 25%'; }

      updateStandardCriteriaHighlight('wsGen', crit, computedFinalScore, {
        'wsGenPctMatched': pct.toFixed(1) + "% (" + rows.length + " Parameter)",
        'wsGenCritText': '<span style="color:#16a34a; font-weight:700;">Kriteria ' + crit + ' (' + critLabel + ')</span>'
      }, ['A', 'B', 'C', 'D', 'E']);

      if (excelFxContent) excelFxContent.textContent = "Pemenuhan Kriteria: " + pct.toFixed(1) + "% (Kriteria " + crit + ") -> Nilai Capaian = " + numFmt(computedFinalScore);
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
      var matchedCount = 0;
      var totalRows = 0;
      document.querySelectorAll("#wsTable_1_a_1_a .ws-1a1a-row").forEach(function(row){
        var rId = row.getAttribute("data-row-id");
        var mnB = row.querySelector(".mn-base").value.trim();
        var mnE = row.querySelector(".mn-end").value.trim();
        var mdB = row.querySelector(".md-base").value.trim();
        var mdE = row.querySelector(".md-end").value.trim();
        json[rId + "_mn_base"] = mnB;
        json[rId + "_mn_end"]  = mnE;
        json[rId + "_md_base"] = mdB;
        json[rId + "_md_end"]  = mdE;
        totalRows++;
        if ((mdB !== "" && !isNaN(parseFloat(mdB))) || (mdE !== "" && !isNaN(parseFloat(mdE)))) {
          matchedCount++;
        }
      });
      var pctMatched = totalRows > 0 ? (matchedCount / totalRows) * 100 : 0;
      json.matched_count = matchedCount;
      json.total_rows = totalRows;
      json.pct_matched = pctMatched;
      json.kriteria = matchedCount === 0 ? 'A' : (pctMatched < 50 ? 'B' : 'C');
    }
    // 2. Persandingan 1.a.1.b
    else if (code === '1.a.1.b'){
      var sel = document.getElementById("wsSelectPersandingan");
      var isAda = sel ? (sel.value === 'Ada') : true;
      var catInp = document.getElementById("ws1a1bCatatan");

      json.status_tabel = isAda ? 'Ada' : 'Tidak Ada';
      json.catatan = catInp ? catInp.value.trim() : '';
      json.kriteria = isAda ? 'B' : 'A';
      json.score = isAda ? 0.5 : 0.0;
    }
    // 2b. Persandingan 1.a.1.d
    else if (code === '1.a.1.d'){
      var sel = document.getElementById("wsSelectPersandingan1d") || document.getElementById("wsSelectPersandingan");
      var isAda = sel ? (sel.value === 'Ada') : true;
      var catInp = document.getElementById("ws1a1dCatatan");

      json.status_tabel = isAda ? 'Ada' : 'Tidak Ada';
      json.catatan = catInp ? catInp.value.trim() : '';
      json.kriteria = isAda ? 'B' : 'A';
      json.score = isAda ? 0.5 : 0.0;
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
        var catInp = row.querySelector(".pn-catatan-inp");

        if (pnIdx !== lastPnIdx){
          if (curPn) pnList.push(curPn);
          curPn = {
            pn_id: parseInt(pnIdx) + 1,
            pn_title: pnInp ? pnInp.value.trim() : '',
            catatan: catInp ? catInp.value.trim() : '',
            pds: []
          };
          lastPnIdx = pnIdx;
        }

        if (curPn && pdInp){
          curPn.pds.push({
            title: pdInp.value.trim(),
            score: scoreSel ? parseFloat(scoreSel.value) : 0,
            ket: ketInp ? ketInp.value.trim() : ''
          });
        }
      });
      if (curPn) pnList.push(curPn);
      json.pn_list = pnList;

      var totalPns = pnList.length || 8;
      var matchedPns = 0;
      pnList.forEach(function(pn){
        var hasMatch = (pn.pds || []).some(function(pd){
          return pd.score > 0 || (pd.title && pd.title.trim() !== '' && !pd.title.toLowerCase().includes('tidak ada') && !pd.title.toLowerCase().includes('belum'));
        });
        if (hasMatch) matchedPns++;
      });
      var pct = totalPns > 0 ? (matchedPns / totalPns) * 100 : 0;
      json.matched_count = matchedPns;
      json.total_pns = totalPns;
      json.pct_matched = pct;
      json.kriteria = matchedPns === 0 ? 'A' : (pct < 50 ? 'B' : 'C');
      json.score = matchedPns === 0 ? 0.0 : (pct < 50 ? 0.3 : 0.5);
    }
    // 4. Sheet 1.a.2.a
    else if (code === '1.a.2.a'){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_a .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");
        var ketInp = row.querySelector(".pd-ket-inp");

        var sVal = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        totalRows++;
        sumScore += sVal;

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
            score: sVal,
            ket: ketInp ? ketInp.value.trim() : ''
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;

      var pnWrap = document.querySelector("#wsTable_1_a_2_a .cell-pn-wrap-2a");
      var pnTitle = pnWrap ? pnWrap.textContent.trim() : 'PN 1 : Memperkokoh Ideologi Pancasila, Demokrasi, dan Hak Asasi Manusia';
      json.pn_list = [{
        pn_title: pnTitle,
        pps: ppList
      }];

      var catatanInp = document.getElementById("ws1a2aCatatan");
      json.catatan = catatanInp ? catatanInp.value.trim() : '';

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      json.total_rows = totalRows;
      json.sum_score = sumScore;
      json.pct_matched = pct;

      if (totalRows === 0) {
        json.kriteria = 'A';
        json.score = 0.075;
      } else if (pct >= 100) {
        json.kriteria = 'E';
        json.score = 0.375;
      } else if (pct > 75) {
        json.kriteria = 'D';
        json.score = 0.300;
      } else if (pct > 50) {
        json.kriteria = 'C';
        json.score = 0.225;
      } else if (pct > 25) {
        json.kriteria = 'B';
        json.score = 0.150;
      } else {
        json.kriteria = 'A';
        json.score = 0.075;
      }
    }
    // Sheet 1.a.2.b
    else if (code === '1.a.2.b'){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_b .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");
        var ketInp = row.querySelector(".pp-ket-inp");

        var sVal = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        totalRows++;
        sumScore += sVal;

        if (ppIdx !== lastPpIdx){
          if (curPp) ppList.push(curPp);
          curPp = {
            pp_title: ppInp ? ppInp.value.trim() : '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            pds: []
          };
          lastPpIdx = ppIdx;
        }

        if (curPp && pdInp){
          curPp.pds.push({
            title: pdInp.value.trim(),
            score: sVal
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;

      var pnWrap = document.querySelector("#wsTable_1_a_2_b .cell-pn-wrap-2b");
      var pnTitle = pnWrap ? pnWrap.textContent.trim() : 'PN 2 : Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa melalui Swasembada Pangan, Energi, Air, Ekonomi Syariah, Ekonomi Digital, Ekonomi Hijau, dan Ekonomi Biru';
      json.pn_list = [{
        pn_title: pnTitle,
        pps: ppList
      }];

      var catatanInp = document.getElementById("ws1a2bCatatan");
      json.catatan = catatanInp ? catatanInp.value.trim() : '';

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      json.total_rows = totalRows;
      json.sum_score = sumScore;
      json.pct_matched = pct;

      if (totalRows === 0) {
        json.kriteria = 'A';
        json.score = 0.075;
      } else if (pct >= 100) {
        json.kriteria = 'E';
        json.score = 0.375;
      } else if (pct > 75) {
        json.kriteria = 'D';
        json.score = 0.300;
      } else if (pct > 50) {
        json.kriteria = 'C';
        json.score = 0.225;
      } else if (pct > 25) {
        json.kriteria = 'B';
        json.score = 0.150;
      } else {
        json.kriteria = 'A';
        json.score = 0.075;
      }
    }
    // Sheet 1.a.2.c
    else if (code === '1.a.2.c'){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_c .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");
        var ketInp = row.querySelector(".pp-ket-inp");

        var sVal = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        totalRows++;
        sumScore += sVal;

        if (ppIdx !== lastPpIdx){
          if (curPp) ppList.push(curPp);
          curPp = {
            pp_title: ppInp ? ppInp.value.trim() : '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            pds: []
          };
          lastPpIdx = ppIdx;
        }

        if (curPp && pdInp){
          curPp.pds.push({
            title: pdInp.value.trim(),
            score: sVal
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;

      var pnWrap = document.querySelector("#wsTable_1_a_2_c .cell-pn-wrap-2c");
      var pnTitle = pnWrap ? pnWrap.textContent.trim() : 'PN 3 : Meningkatkan lapangan kerja yang berkualitas, mendorong kewirausahaan, mengembangkan industri kreatif serta mengembangkan agroindustri maritim industri di sentra produksi melalui peran aktif koperasi,';
      json.pn_list = [{
        pn_title: pnTitle,
        pps: ppList
      }];

      var catatanInp = document.getElementById("ws1a2cCatatan");
      json.catatan = catatanInp ? catatanInp.value.trim() : '';

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      json.total_rows = totalRows;
      json.sum_score = sumScore;
      json.pct_matched = pct;

      if (totalRows === 0) {
        json.kriteria = 'A';
        json.score = 0.075;
      } else if (pct >= 100) {
        json.kriteria = 'E';
        json.score = 0.375;
      } else if (pct > 75) {
        json.kriteria = 'D';
        json.score = 0.300;
      } else if (pct > 50) {
        json.kriteria = 'C';
        json.score = 0.225;
      } else if (pct > 25) {
        json.kriteria = 'B';
        json.score = 0.150;
      } else {
        json.kriteria = 'A';
        json.score = 0.075;
      }
    }
    // Sheet 1.a.2.d
    else if (code === '1.a.2.d'){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_d .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");
        var ketInp = row.querySelector(".pp-ket-inp");

        var sVal = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        totalRows++;
        sumScore += sVal;

        if (ppIdx !== lastPpIdx){
          if (curPp) ppList.push(curPp);
          curPp = {
            pp_title: ppInp ? ppInp.value.trim() : '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            pds: []
          };
          lastPpIdx = ppIdx;
        }

        if (curPp && pdInp){
          curPp.pds.push({
            title: pdInp.value.trim(),
            score: sVal
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;

      var pnWrap = document.querySelector("#wsTable_1_a_2_d .cell-pn-wrap-2b");
      var pnTitle = pnWrap ? pnWrap.textContent.trim() : 'PN 4 : Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, Teknologi, Pendidikan, Kesehatan, Prestasi Olahraga, Kesetaraan Gender, serta Penguatan Peran Perempuan, Pemuda (Generasi Milenial dan Generasi Z), dan Penyandang Disabilitas';
      json.pn_list = [{
        pn_title: pnTitle,
        pps: ppList
      }];

      var catatanInp = document.getElementById("ws1a2dCatatan");
      json.catatan = catatanInp ? catatanInp.value.trim() : '';

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      json.total_rows = totalRows;
      json.sum_score = sumScore;
      json.pct_matched = pct;

      if (totalRows === 0) {
        json.kriteria = 'A';
        json.score = 0.075;
      } else if (pct >= 100) {
        json.kriteria = 'E';
        json.score = 0.375;
      } else if (pct > 75) {
        json.kriteria = 'D';
        json.score = 0.300;
      } else if (pct > 50) {
        json.kriteria = 'C';
        json.score = 0.225;
      } else if (pct > 25) {
        json.kriteria = 'B';
        json.score = 0.150;
      } else {
        json.kriteria = 'A';
        json.score = 0.075;
      }
    }
    // Sheet 1.a.2.e
    else if (code === '1.a.2.e'){
      var ppList = [];
      var curPp = null;
      var lastPpIdx = null;
      var totalRows = 0;
      var sumScore = 0;

      document.querySelectorAll("#wsTable_1_a_2_e .ws-pp-row").forEach(function(row){
        var ppIdx = row.getAttribute("data-pp-idx");
        var ppInp = row.querySelector(".pp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");
        var ketInp = row.querySelector(".pp-ket-inp");

        var sVal = scoreSel ? parseFloat(scoreSel.value) : 1.0;
        totalRows++;
        sumScore += sVal;

        if (ppIdx !== lastPpIdx){
          if (curPp) ppList.push(curPp);
          curPp = {
            pp_title: ppInp ? ppInp.value.trim() : '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            pds: []
          };
          lastPpIdx = ppIdx;
        }

        if (curPp && pdInp){
          curPp.pds.push({
            title: pdInp.value.trim(),
            score: sVal
          });
        }
      });
      if (curPp) ppList.push(curPp);
      json.pp_list = ppList;

      var pnWrap = document.querySelector("#wsTable_1_a_2_e .cell-pn-wrap-2b");
      var pnTitle = pnWrap ? pnWrap.textContent.trim() : 'PN 5 : Melanjutkan Hilirisasi dan Mengembangkan Industri Berbasis Sumber Daya Alam untuk Meningkatkan Nilai Tambah di Dalam Negeri';
      json.pn_list = [{
        pn_title: pnTitle,
        pps: ppList
      }];

      var catatanInp = document.getElementById("ws1a2eCatatan");
      json.catatan = catatanInp ? catatanInp.value.trim() : '';

      var avgRatio = totalRows > 0 ? (sumScore / totalRows) : 1.0;
      var pct = avgRatio * 100;
      json.total_rows = totalRows;
      json.sum_score = sumScore;
      json.pct_matched = pct;

      if (totalRows === 0) {
        json.kriteria = 'A';
        json.score = 0.075;
      } else if (pct >= 100) {
        json.kriteria = 'E';
        json.score = 0.375;
      } else if (pct > 75) {
        json.kriteria = 'D';
        json.score = 0.300;
      } else if (pct > 50) {
        json.kriteria = 'C';
        json.score = 0.225;
      } else if (pct > 25) {
        json.kriteria = 'B';
        json.score = 0.150;
      } else {
        json.kriteria = 'A';
        json.score = 0.075;
      }
    }
    // 5. Sheets 1.a.2.f s.d 1.a.2.h
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
          var terbCell = document.querySelector('#wsTable_1_a_4 .kpu-terbobot[data-kpu-idx="' + kpuIdx + '"]');
          curKpu = {
            kpu_title: row.getAttribute("data-kpu-title") || '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            keselarasan_terbobot: terbCell ? parseFloat(terbCell.textContent) : 0.50,
            dokumen: dokInp ? (dokInp.value.trim() || 'RPJMN Tahun 2025-2029') : 'RPJMN Tahun 2025-2029',
            halaman: halInp ? (halInp.value.trim() || '270') : '270',
            tabel: tblInp ? (tblInp.value.trim() || 'Daftar Kegiatan Utama Pembangunan') : 'Daftar Kegiatan Utama Pembangunan',
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

      var grandCell = document.querySelector("#wsTable_1_a_4 .kpu-grand-avg");
      var grandVal = grandCell ? parseFloat(grandCell.textContent) : 0.50;
      json.rata_rata_terbobot = grandVal;
      json.kriteria = (grandVal >= 0.50) ? 'B' : 'A';
      json.score = (grandVal >= 0.50) ? 1.0 : 0.5;
    }
    // 8. Sheet 1.a.5 (Komponen SPM RPJMD)
    else if (code === '1.a.5'){
      var spmList = [];
      var curBid = null;
      var lastBidIdx = null;

      document.querySelectorAll("#wsTable_1_a_5 .ws-1a5-row").forEach(function(row){
        var bidIdx = row.getAttribute("data-bid-idx");
        var indNameSpan = row.querySelector(".spm-ind-name");
        var scoreSel = row.querySelector(".ind-score-sel");
        var ketInp = row.querySelector(".spm-ket-inp");
        var dokInp = row.querySelector(".spm-dok-inp");
        var halInp = row.querySelector(".spm-hal-inp");
        var tblInp = row.querySelector(".spm-tbl-inp");
        var catInp = row.querySelector(".spm-catatan-inp");

        if (bidIdx !== lastBidIdx){
          if (curBid) spmList.push(curBid);
          var terbCell = document.querySelector('#wsTable_1_a_5 .spm-bid-terbobot[data-bid-idx="' + bidIdx + '"]');
          curBid = {
            no_bidang: parseInt(bidIdx) + 1,
            bidang_nasional: row.getAttribute("data-bid-nasional") || '',
            bidang_daerah: row.getAttribute("data-bid-title") || '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            keselarasan_terbobot: terbCell ? parseFloat(terbCell.textContent) : 0.50,
            dokumen: dokInp ? (dokInp.value.trim() || 'RPJMD Kab Banyuwangi 2025-2029') : 'RPJMD Kab Banyuwangi 2025-2029',
            halaman: halInp ? halInp.value.trim() : '',
            tabel: tblInp ? tblInp.value.trim() : '',
            catatan: catInp ? catInp.value.trim() : '',
            ind_list: []
          };
          lastBidIdx = bidIdx;
        }

        var indName = indNameSpan ? indNameSpan.textContent.trim() : '-';
        if (curBid){
          curBid.ind_list.push({
            name: indName,
            score: scoreSel ? parseFloat(scoreSel.value) : 0.50
          });
        }
      });
      if (curBid) spmList.push(curBid);
      json.spm_list = spmList;

      var grandCell = document.querySelector("#wsTable_1_a_5 .spm-grand-avg");
      var grandVal = grandCell ? parseFloat(grandCell.textContent) : 0.50;
      json.rata_rata_terbobot = grandVal;
      json.kriteria = (grandVal >= 0.50) ? 'B' : 'A';
      json.score = (grandVal >= 0.50) ? 1.0 : 0.5;
    }
    // 8.b Sheet 1.a.6 (Target SPM)
    else if (code === '1.a.6'){
      var spmList = [];
      var curBid = null;
      var lastBidIdx = null;

      document.querySelectorAll("#wsTable_1_a_6 .ws-1a6-row").forEach(function(row){
        var bidIdx = row.getAttribute("data-bid-idx");
        var indNameSpan = row.querySelector(".spm-ind-name");
        var tgtInp = row.querySelector(".ind-target-inp");
        var unitInp = row.querySelector(".ind-unit-inp");
        var scoreSel = row.querySelector(".ind-score-sel");
        var ketInp = row.querySelector(".spm-ket-inp");
        var dokInp = row.querySelector(".spm-dok-inp");
        var halInp = row.querySelector(".spm-hal-inp");
        var tblInp = row.querySelector(".spm-tbl-inp");
        var catInp = row.querySelector(".spm-catatan-inp");

        if (bidIdx !== lastBidIdx){
          if (curBid) spmList.push(curBid);
          var terbCell = document.querySelector('#wsTable_1_a_6 .spm-bid-terbobot[data-bid-idx="' + bidIdx + '"]');
          curBid = {
            no_bidang: parseInt(bidIdx) + 1,
            bidang_nasional: row.getAttribute("data-bid-nasional") || '',
            bidang_daerah: row.getAttribute("data-bid-title") || '',
            keterangan: ketInp ? ketInp.value.trim() : '',
            keselarasan_terbobot: terbCell ? parseFloat(terbCell.textContent) : 0.50,
            dokumen: dokInp ? (dokInp.value.trim() || 'RPJMD Kab Banyuwangi 2025-2029') : 'RPJMD Kab Banyuwangi 2025-2029',
            halaman: halInp ? halInp.value.trim() : '',
            tabel: tblInp ? tblInp.value.trim() : '',
            catatan: catInp ? catInp.value.trim() : '',
            ind_list: []
          };
          lastBidIdx = bidIdx;
        }

        var indName = indNameSpan ? indNameSpan.textContent.trim() : '-';
        if (curBid){
          curBid.ind_list.push({
            name: indName,
            target: tgtInp ? tgtInp.value.trim() : '-',
            satuan: unitInp ? unitInp.value.trim() : 'persen',
            score: scoreSel ? parseFloat(scoreSel.value) : 0.50
          });
        }
      });
      if (curBid) spmList.push(curBid);
      json.spm_list = spmList;

      var grandCell = document.querySelector("#wsTable_1_a_6 .spm-grand-avg");
      var grandVal = grandCell ? parseFloat(grandCell.textContent) : 0.50;
      json.rata_rata_terbobot = grandVal;
      json.kriteria = (grandVal >= 0.50) ? 'B' : 'A';
      json.score = (grandVal >= 0.50) ? 1.0 : 0.5;
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
        var avgVal = parseFloat(json.avg_score) || 0;
        json.kriteria = avgVal >= 50.0 ? 'B' : 'A';
        json.score = avgVal >= 50.0 ? 0.75 : 0.375;
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
        var avgVal = parseFloat(json.avg_score) || 0;
        json.kriteria = avgVal >= 50.0 ? 'B' : 'A';
        json.score = avgVal >= 50.0 ? 0.75 : 0.375;
      }
    }
    else if (code === '1.b.1.b' || code === '1.b.1.d' || code === '1.b.2.b' || code === '1.b.3.b' || code === '1.b.4.b' || code === '1.b.5.b' || code === '1.b.6.b' || code === '1.b.7.b' || code === '1.b.8.b' || code === '1.b.9.b'){
      var tableId = "#wsTable_" + code.replace(/\./g, '_');
      var row = document.querySelector(tableId + " .ws-persandingan-row");
      if (row){
        var sel = row.querySelector(".status-tabel-select");
        var isAda = sel ? (sel.value === 'Ada') : false;
        json.status_tabel = sel ? sel.value : 'Tidak Ada';
        json.kriteria = isAda ? 'B' : 'A';
        json.score = isAda ? 0.625 : 0.0;
        json.score_terbobot = row.querySelector(".terb-val") ? row.querySelector(".terb-val").textContent.trim() : numFmt(json.score);
        json.dokumen = row.querySelector(".ref-dok-inp") ? row.querySelector(".ref-dok-inp").value.trim() : (modalRefDokumen ? modalRefDokumen.value.trim() : '');
        json.halaman = row.querySelector(".ref-hal-inp") ? row.querySelector(".ref-hal-inp").value.trim() : (modalRefHalaman ? modalRefHalaman.value.trim() : '');
        json.tabel = row.querySelector(".ref-tbl-inp") ? row.querySelector(".ref-tbl-inp").value.trim() : (modalRefTabel ? modalRefTabel.value.trim() : '');
        json.catatan = row.querySelector(".catatan-inp") ? row.querySelector(".catatan-inp").value.trim() : (modalCatatan ? modalCatatan.value.trim() : '');
      }
    }
    else if (code === '1.b.8.a'){
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
  function openDetailModal(code, isVerifMode){
    if (isVerifMode === undefined) isVerifMode = IS_VERIFIKATOR;
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

    var currentVal = (saved.bobot_verifikator !== null && saved.bobot_verifikator !== undefined && saved.bobot_verifikator !== "") ? saved.bobot_verifikator : ((saved.bobot_capaian !== null && saved.bobot_capaian !== undefined) ? saved.bobot_capaian : item.bobot);
    modalBobotInput.value = currentVal;
    modalBobotInput.max = item.bobot;
    modalCalcDisplay.textContent = numFmt(currentVal);

    modalRefDokumen.value = detailObj.ref_dokumen || "";
    modalRefHalaman.value = detailObj.ref_halaman || "";
    modalRefTabel.value = detailObj.ref_tabel || "";
    modalCatatan.value = saved.catatan || "";
    modalBuktiDukung.value = saved.bukti_dukung || "";

    if (code === '1.a.1.b') {
      var auto1b = getAutoScore_1_a_1_b(detailObj);
      if (!modalCatatan.value && auto1b.catatan) {
        modalCatatan.value = auto1b.catatan;
      }
    }
    if (code === '1.a.1.c') {
      var auto1c = getAutoScore_1_a_1_c(detailObj);
      if (!modalCatatan.value) {
        modalCatatan.value = "Otomatis dihitung dari keselarasan Prioritas Pembangunan Daerah terhadap PN RPJMN (" + auto1c.matched + "/" + auto1c.total + " PN selaras, " + auto1c.pct.toFixed(2) + "%)";
      }
    }
    if (code === '1.a.1.d') {
      var auto1d = getAutoScore_1_a_1_d(detailObj);
      if (!modalCatatan.value && auto1d.catatan) {
        modalCatatan.value = auto1d.catatan;
      }
    }
    if (code === '1.a.2.a') {
      var auto1a2a = getAutoScore_1_a_2_a(detailObj, item.bobot);
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait";
      }
      detailObj.catatan = modalCatatan.value;
    }
    if (code === '1.a.2.b') {
      var auto1a2b = getAutoScore_1_a_2_b(detailObj, item.bobot);
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait";
      }
      detailObj.catatan = modalCatatan.value;
    }
    if (code === '1.a.2.c') {
      var auto1a2c = getAutoScore_1_a_2_c(detailObj, item.bobot);
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait";
      }
      detailObj.catatan = modalCatatan.value;
    }
    if (code === '1.a.2.d') {
      var auto1a2d = getAutoScore_1_a_2_d(detailObj, item.bobot);
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait";
      }
      detailObj.catatan = modalCatatan.value;
    }
    if (code === '1.a.2.e') {
      var auto1a2e = getAutoScore_1_a_2_e(detailObj, item.bobot);
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Program Prioritas Pembangunan Nasional terkait";
      }
      detailObj.catatan = modalCatatan.value;
    }
    if (code === '1.a.4') {
      var auto1a4 = getAutoScore_1_a_4(detailObj);
      if (!saved.bobot_capaian || (parseFloat(saved.bobot_capaian) !== 0.5 && parseFloat(saved.bobot_capaian) !== 1.0)) {
        saved.bobot_capaian = auto1a4.score;
        saved.opsi_aksi = auto1a4.aksi;
      }
      if (!modalRefDokumen.value) modalRefDokumen.value = detailObj.dokumen || 'RPJMN Tahun 2025-2029';
      if (!modalRefHalaman.value) modalRefHalaman.value = detailObj.halaman || '270';
      if (!modalRefTabel.value) modalRefTabel.value = detailObj.tabel || 'Daftar Kegiatan Utama Pembangunan';
      if (!modalCatatan.value) {
        modalCatatan.value = detailObj.catatan || "Terdapat Dukungan Program Pembangunan Daerah untuk mendukung Kegiatan Prioritas Utama terkait";
      }
      detailObj.dokumen = modalRefDokumen.value;
      detailObj.halaman = modalRefHalaman.value;
      detailObj.tabel = modalRefTabel.value;
      detailObj.catatan = modalCatatan.value;
      currentVal = saved.bobot_capaian;
      modalBobotInput.value = currentVal;
      modalCalcDisplay.textContent = numFmt(currentVal);
    }
    if (code === '1.a.5') {
      var auto1a5 = getAutoScore_1_a_5(detailObj);
      if (!saved.bobot_capaian || (parseFloat(saved.bobot_capaian) !== 0.5 && parseFloat(saved.bobot_capaian) !== 1.0)) {
        saved.bobot_capaian = auto1a5.score;
        saved.opsi_aksi = auto1a5.aksi;
      }
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Indikator SPM Daerah yang selaras dengan Bidang SPM Nasional dan Daerah terkait";
      }
      detailObj.catatan = modalCatatan.value;
      currentVal = saved.bobot_capaian;
      modalBobotInput.value = currentVal;
      modalCalcDisplay.textContent = numFmt(currentVal);
    }
    if (code === '1.a.6') {
      var auto1a6 = getAutoScore_1_a_6(detailObj);
      if (!saved.bobot_capaian || (parseFloat(saved.bobot_capaian) !== 0.5 && parseFloat(saved.bobot_capaian) !== 1.0)) {
        saved.bobot_capaian = auto1a6.score;
        saved.opsi_aksi = auto1a6.aksi;
      }
      if (!modalCatatan.value) {
        modalCatatan.value = "Terdapat Target SPM Daerah yang selaras dengan Target SPM Nasional terkait";
      }
      detailObj.catatan = modalCatatan.value;
      currentVal = saved.bobot_capaian;
      modalBobotInput.value = currentVal;
      modalCalcDisplay.textContent = numFmt(currentVal);
    }
    if (code === '1.b.10.a') {
      if (!modalRefDokumen.value) modalRefDokumen.value = detailObj.dokumen || (typeof AUTO_DATA_1_B_10_A !== 'undefined' ? (AUTO_DATA_1_B_10_A.dokumen || '') : '') || 'RKPD Kab Banyuwangi 2026';
      if (!modalRefHalaman.value) modalRefHalaman.value = detailObj.halaman || (typeof AUTO_DATA_1_B_10_A !== 'undefined' ? (AUTO_DATA_1_B_10_A.halaman || '') : '') || 'IV-7';
      if (!modalRefTabel.value) modalRefTabel.value = detailObj.tabel || (typeof AUTO_DATA_1_B_10_A !== 'undefined' ? (AUTO_DATA_1_B_10_A.tabel || '') : '') || 'Tabel 4.1';
      if (!modalCatatan.value) modalCatatan.value = detailObj.catatan || (typeof AUTO_DATA_1_B_10_A !== 'undefined' ? (AUTO_DATA_1_B_10_A.catatan || '') : '') || 'Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap';
      detailObj.dokumen = modalRefDokumen.value;
      detailObj.halaman = modalRefHalaman.value;
      detailObj.tabel = modalRefTabel.value;
      detailObj.catatan = modalCatatan.value;
    }
    if (code === '1.b.10.b') {
      if (!modalRefDokumen.value) modalRefDokumen.value = detailObj.dokumen || (typeof AUTO_DATA_1_B_10_B !== 'undefined' ? (AUTO_DATA_1_B_10_B.dokumen || '') : '') || 'RKPD Kab Banyuwangi 2026';
      if (!modalRefHalaman.value) modalRefHalaman.value = detailObj.halaman || (typeof AUTO_DATA_1_B_10_B !== 'undefined' ? (AUTO_DATA_1_B_10_B.halaman || '') : '') || 'IV-8';
      if (!modalRefTabel.value) modalRefTabel.value = detailObj.tabel || (typeof AUTO_DATA_1_B_10_B !== 'undefined' ? (AUTO_DATA_1_B_10_B.tabel || '') : '') || 'Tabel 4.1';
      if (!modalCatatan.value) modalCatatan.value = detailObj.catatan || (typeof AUTO_DATA_1_B_10_B !== 'undefined' ? (AUTO_DATA_1_B_10_B.catatan || '') : '') || 'Tidak perlu dihitung, data realisasi hanya untuk data perhitungan Gap';
      detailObj.dokumen = modalRefDokumen.value;
      detailObj.halaman = modalRefHalaman.value;
      detailObj.tabel = modalRefTabel.value;
      detailObj.catatan = modalCatatan.value;
    }
    var persandinganAutoMap = {
      '1.b.1.b': typeof AUTO_DATA_1_B_1_B !== 'undefined' ? AUTO_DATA_1_B_1_B : {},
      '1.b.1.d': typeof AUTO_DATA_1_B_1_D !== 'undefined' ? AUTO_DATA_1_B_1_D : {},
      '1.b.2.b': typeof AUTO_DATA_1_B_2_B !== 'undefined' ? AUTO_DATA_1_B_2_B : {},
      '1.b.3.b': typeof AUTO_DATA_1_B_3_B !== 'undefined' ? AUTO_DATA_1_B_3_B : {},
      '1.b.4.b': typeof AUTO_DATA_1_B_4_B !== 'undefined' ? AUTO_DATA_1_B_4_B : {},
      '1.b.5.b': typeof AUTO_DATA_1_B_5_B !== 'undefined' ? AUTO_DATA_1_B_5_B : {},
      '1.b.6.b': typeof AUTO_DATA_1_B_6_B !== 'undefined' ? AUTO_DATA_1_B_6_B : {},
      '1.b.7.b': typeof AUTO_DATA_1_B_7_B !== 'undefined' ? AUTO_DATA_1_B_7_B : {},
      '1.b.8.b': typeof AUTO_DATA_1_B_8_B !== 'undefined' ? AUTO_DATA_1_B_8_B : {},
      '1.b.9.b': typeof AUTO_DATA_1_B_9_B !== 'undefined' ? AUTO_DATA_1_B_9_B : {}
    };
    if (persandinganAutoMap[code]) {
      var autoItem = persandinganAutoMap[code];
      if (!modalRefDokumen.value) modalRefDokumen.value = detailObj.dokumen || autoItem.dokumen || '';
      if (!modalRefHalaman.value) modalRefHalaman.value = detailObj.halaman || autoItem.halaman || '';
      if (!modalRefTabel.value) modalRefTabel.value = detailObj.tabel || autoItem.tabel || '';
      if (!modalCatatan.value) modalCatatan.value = detailObj.catatan || autoItem.catatan || '';
      detailObj.dokumen = modalRefDokumen.value;
      detailObj.halaman = modalRefHalaman.value;
      detailObj.tabel = modalRefTabel.value;
      detailObj.catatan = modalCatatan.value;
    }

    showPreviewIfImageOrPdf(modalBuktiDukung.value, 'previewBuktiContainer', 'modalBuktiDukung');

    // Render Dynamic Worksheet
    modalDynamicWorksheet.innerHTML = renderDynamicWorksheet(code, item.bobot, detailObj);
    
    // Initial Calculation Trigger (Nilai otomatis generate seperti modal di detail)
    updateModalWorksheetScore();

    // Verifikator Decision Panel & Status Setup
    var statusVerif = saved.status_verifikasi || (saved.bobot_verifikator !== null && saved.bobot_verifikator !== undefined && saved.bobot_verifikator !== "" ? 'Terverifikasi' : 'Draft');
    var alasanRevisi = saved.alasan_revisi || saved.catatan_verifikator || '';

    if (isVerifMode) {
      if (verifDecisionPanel) verifDecisionPanel.style.display = 'block';
      if (modalExcelTitleWrap) {
        modalExcelTitleWrap.innerHTML = ' <i class="fa fa-shield" style="color:#00c292;"></i> Lembar Verifikasi IPPD [<span id="excelPointBadge">POIN ' + code + '</span>]';
      }
      if (modalBobotLabel) {
        modalBobotLabel.textContent = 'Bobot Verifikasi:';
      }

      // Hide banners for verifikator
      if (bannerStatusRevisi) bannerStatusRevisi.style.display = 'none';
      if (bannerStatusVerified) bannerStatusVerified.style.display = 'none';

      // Setup state for verifikator decision panel
      if (statusVerif === 'Terverifikasi' || statusVerif === 'Sudah Sesuai') {
        if (badgeVerifModalStatus) {
          badgeVerifModalStatus.className = 'verif-badge-pill status-verified';
          badgeVerifModalStatus.innerHTML = '<i class="fa fa-check-circle"></i> Terverifikasi';
        }
        if (btnChoiceVerify) btnChoiceVerify.classList.add('active');
        if (btnChoiceRevision) btnChoiceRevision.classList.remove('active');
        if (boxAlasanRevisi) boxAlasanRevisi.style.display = 'none';
        if (modalAlasanRevisi) modalAlasanRevisi.value = '';
      } else if (statusVerif === 'Perlu Perbaikan' || statusVerif === 'Revisi') {
        if (badgeVerifModalStatus) {
          badgeVerifModalStatus.className = 'verif-badge-pill status-revision';
          badgeVerifModalStatus.innerHTML = '<i class="fa fa-pencil-square-o"></i> Perlu Perbaikan';
        }
        if (btnChoiceRevision) btnChoiceRevision.classList.add('active');
        if (btnChoiceVerify) btnChoiceVerify.classList.remove('active');
        if (boxAlasanRevisi) boxAlasanRevisi.style.display = 'block';
        if (modalAlasanRevisi) modalAlasanRevisi.value = alasanRevisi;
      } else {
        if (badgeVerifModalStatus) {
          badgeVerifModalStatus.className = 'verif-badge-pill status-draft';
          badgeVerifModalStatus.innerHTML = '<i class="fa fa-clock-o"></i> Belum Diverifikasi';
        }
        if (btnChoiceVerify) btnChoiceVerify.classList.remove('active');
        if (btnChoiceRevision) btnChoiceRevision.classList.remove('active');
        if (boxAlasanRevisi) boxAlasanRevisi.style.display = 'none';
        if (modalAlasanRevisi) modalAlasanRevisi.value = '';
      }
    } else {
      if (verifDecisionPanel) verifDecisionPanel.style.display = 'none';
      if (modalExcelTitleWrap) {
        modalExcelTitleWrap.innerHTML = ' IPPD Daerah - Lembar Kerja Evaluasi [<span id="excelPointBadge">POIN ' + code + '</span>]';
      }
      if (modalBobotLabel) {
        modalBobotLabel.textContent = 'Capaian:';
      }

      // Show alert banners for regular/Daerah user if verifikator gave feedback
      if (statusVerif === 'Perlu Perbaikan' || statusVerif === 'Revisi') {
        if (bannerStatusRevisi) {
          bannerStatusRevisi.style.display = 'flex';
          if (bannerRevisiText) {
            bannerRevisiText.textContent = alasanRevisi || 'Terdapat beberapa data atau bukti dukung yang belum sesuai. Silakan lakukan perbaikan data.';
          }
        }
        if (bannerStatusVerified) bannerStatusVerified.style.display = 'none';
      } else if (statusVerif === 'Terverifikasi') {
        if (bannerStatusVerified) bannerStatusVerified.style.display = 'flex';
        if (bannerStatusRevisi) bannerStatusRevisi.style.display = 'none';
      } else {
        if (bannerStatusRevisi) bannerStatusRevisi.style.display = 'none';
        if (bannerStatusVerified) bannerStatusVerified.style.display = 'none';
      }
    }

    // Render Data Informasi Dokumen & Bukti Pendukung
    var boxInputDaerah = document.getElementById("boxInputReferensiDaerah");
    var boxDataInfo = document.getElementById("boxDataInformasi");
    var contentDataInfo = document.getElementById("contentDataInformasi");
    var badgeDataInfo = document.getElementById("badgeDataInformasi");

    if (isVerifMode || IS_VERIFIKATOR) {
      if (boxInputDaerah) boxInputDaerah.style.display = 'none';
      if (boxDataInfo && contentDataInfo) {
        boxDataInfo.style.display = 'block';

        var docName = (modalRefDokumen ? modalRefDokumen.value : (detailObj.ref_dokumen || "")).trim();
        var docHal = (modalRefHalaman ? modalRefHalaman.value : (detailObj.ref_halaman || "")).trim();
        var docTab = (modalRefTabel ? modalRefTabel.value : (detailObj.ref_tabel || "")).trim();
        var docCat = (modalCatatan ? modalCatatan.value : (saved.catatan || "")).trim();
        var docBukti = (modalBuktiDukung ? modalBuktiDukung.value : (saved.bukti_dukung || "")).trim();

        var hasAnyInfo = docName || docHal || docTab || docCat || docBukti;

        if (hasAnyInfo) {
          if (badgeDataInfo) {
            badgeDataInfo.innerHTML = '<i class="fa fa-check-circle"></i> Data Terlampir';
            badgeDataInfo.className = 'excel-info-badge badge-success';
          }
          var infoHtml = '';

          // Pills for docName, docHal, docTab
          if (docName || docHal || docTab) {
            infoHtml += '<div class="excel-info-pills">';
            if (docName) {
              infoHtml += '<span class="excel-info-pill"><i class="fa fa-book" style="color:#0f766e;"></i> <strong>Dokumen Sumber:</strong> ' + escapeHtml(docName) + '</span>';
            }
            if (docHal) {
              infoHtml += '<span class="excel-info-pill"><i class="fa fa-bookmark-o" style="color:#0f766e;"></i> <strong>Halaman:</strong> ' + escapeHtml(docHal) + '</span>';
            }
            if (docTab) {
              infoHtml += '<span class="excel-info-pill"><i class="fa fa-table" style="color:#0f766e;"></i> <strong>Tabel/Matriks:</strong> ' + escapeHtml(docTab) + '</span>';
            }
            infoHtml += '</div>';
          }

          // Catatan Evaluasi Daerah
          if (docCat) {
            infoHtml += '<div class="excel-info-catatan"><i class="fa fa-commenting-o" style="color:#2563eb; margin-right:4px;"></i> <strong>Catatan Evaluasi Daerah:</strong> ' + escapeHtml(docCat) + '</div>';
          }

          // Bukti Dukung (Images / PDFs / Links) - Read-Only View (No delete, no upload)
          if (docBukti) {
            infoHtml += '<div class="excel-info-bukti-wrap" style="margin-top:6px;">';
            infoHtml += '<div style="font-size:11px; font-weight:700; color:#475569; text-transform:uppercase; margin-bottom:6px;"><i class="fa fa-paperclip" style="color:#0f766e;"></i> Bukti Dukung / Lampiran Daerah:</div>';

            var urls = docBukti.split(',').map(function(s){ return s.trim(); }).filter(function(s){ return s !== ''; });
            if (urls.length > 0) {
              infoHtml += '<div style="display:flex; flex-wrap:wrap; gap:10px; align-items:flex-start;">';
              urls.forEach(function(url){
                var ext = url.split('.').pop().toLowerCase();
                var isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(ext) || (ext.length > 4 && url.match(/\.(jpeg|jpg|gif|png)$/i));
                var isPdf = (ext === 'pdf');

                if (isImage) {
                  infoHtml += 
                    '<div style="border:1px solid #cbd5e1; border-radius:6px; padding:6px; background:#fff; text-align:center; max-width:140px; box-shadow:0 1px 2px rgba(0,0,0,0.05);">' +
                      '<img src="' + escapeHtml(url) + '" style="max-width:100%; height:60px; object-fit:contain; border-radius:4px; margin-bottom:5px; cursor:pointer;" onclick="openPreviewModal(\'' + escapeHtml(url) + '\')">' +
                      '<button type="button" class="btn-ui btn-ui-secondary" style="font-size:11px; padding:3px 8px; width:100%; justify-content:center;" onclick="openPreviewModal(\'' + escapeHtml(url) + '\')"><i class="fa fa-eye"></i> Lihat Foto</button>' +
                    '</div>';
                } else if (isPdf) {
                  infoHtml += 
                    '<div style="border:1px solid #cbd5e1; border-radius:6px; padding:8px 10px; background:#fff; text-align:center; max-width:140px; box-shadow:0 1px 2px rgba(0,0,0,0.05);">' +
                      '<div style="font-size:32px; color:#ef4444; margin-bottom:4px;"><i class="fa fa-file-pdf-o"></i></div>' +
                      '<div style="font-size:10px; color:#475569; margin-bottom:6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="' + escapeHtml(url) + '">Dokumen PDF</div>' +
                      '<button type="button" class="btn-ui btn-ui-secondary" style="font-size:11px; padding:3px 8px; width:100%; justify-content:center;" onclick="openPreviewModal(\'' + escapeHtml(url) + '\')"><i class="fa fa-eye"></i> Buka PDF</button>' +
                    '</div>';
                } else {
                  var isHttp = url.match(/^https?:\/\//i);
                  infoHtml += 
                    '<div style="border:1px solid #cbd5e1; border-radius:6px; padding:8px 12px; background:#fff; display:inline-flex; align-items:center; gap:8px;">' +
                      '<i class="fa fa-link" style="color:#2563eb;"></i>' +
                      (isHttp ? 
                        '<a href="' + escapeHtml(url) + '" target="_blank" class="btn-info-bukti-link"><i class="fa fa-external-link"></i> Buka Tautan Dokumen ↗</a>' :
                        '<span style="color:#334155; font-size:12px;">' + escapeHtml(url) + '</span>'
                      ) +
                    '</div>';
                }
              });
              infoHtml += '</div>';
            } else {
              infoHtml += '<div style="font-size:12px; color:#64748b; font-style:italic;">' + escapeHtml(docBukti) + '</div>';
            }
            infoHtml += '</div>';
          }

          contentDataInfo.innerHTML = infoHtml;
        } else {
          if (badgeDataInfo) {
            badgeDataInfo.innerHTML = '<i class="fa fa-clock-o"></i> Belum Diisi';
            badgeDataInfo.className = 'excel-info-badge badge-empty';
          }
          contentDataInfo.innerHTML = 
            '<div style="padding:10px 14px; background:#ffffff; border:1px dashed #cbd5e1; border-radius:6px; color:#64748b; font-size:12.5px; font-style:italic;">' +
              '<i class="fa fa-info-circle" style="color:#94a3b8; margin-right:4px;"></i> Daerah belum menginputkan referensi dokumen sumber atau bukti dukung untuk indikator ini.' +
            '</div>';
        }
      }
    } else {
      // Regular / Akun Daerah Mode
      if (boxInputDaerah) boxInputDaerah.style.display = 'block';
      if (boxDataInfo) boxDataInfo.style.display = 'none';
      showPreviewIfImageOrPdf(modalBuktiDukung ? modalBuktiDukung.value : '', 'previewBuktiContainer', 'modalBuktiDukung');
    }

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
      opsi_aksi: ((code === '1.a.4' || code === '1.a.5') && detailData && detailData.kriteria) ? (detailData.kriteria === 'B' ? 'Ya' : 'Tidak') : (bobotNum !== null ? (bobotNum >= maxVal ? 'Memenuhi Sepenuhnya' : (bobotNum > 0 ? 'Sebagian Memenuhi' : 'Belum Memenuhi')) : ''),
      catatan: ((code === '1.a.2.a' || code === '1.a.2.b' || code === '1.a.2.c' || code === '1.a.4' || code === '1.a.5') && detailData && detailData.catatan !== undefined) ? detailData.catatan : ((detailData && detailData.catatan && !modalCatatan.value.trim()) ? detailData.catatan : modalCatatan.value.trim()),
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
          
          if (resp.AutoData_1_a_1_a) AUTO_DATA_1_A_1_A = resp.AutoData_1_a_1_a;
          if (resp.AutoData_1_a_1_b) AUTO_DATA_1_A_1_B = resp.AutoData_1_a_1_b;
          if (resp.AutoData_1_a_1_c) AUTO_DATA_1_A_1_C = resp.AutoData_1_a_1_c;
          if (resp.AutoData_1_a_2_a) AUTO_DATA_1_A_2_A = resp.AutoData_1_a_2_a;
          if (resp.AutoData_1_a_2_b) AUTO_DATA_1_A_2_B = resp.AutoData_1_a_2_b;
          if (resp.AutoData_1_a_2_c) AUTO_DATA_1_A_2_C = resp.AutoData_1_a_2_c;
          if (resp.AutoData_1_a_2_d) AUTO_DATA_1_A_2_D = resp.AutoData_1_a_2_d;
          if (resp.AutoData_1_a_2_e) AUTO_DATA_1_A_2_E = resp.AutoData_1_a_2_e;
          if (resp.AutoData_1_a_2_ALL) AUTO_DATA_1_A_2_ALL = resp.AutoData_1_a_2_ALL;
          if (resp.AutoData_1_a_4) AUTO_DATA_1_A_4 = resp.AutoData_1_a_4;
          if (resp.AutoData_1_a_5) AUTO_DATA_1_A_5 = resp.AutoData_1_a_5;
          if (resp.AutoData_1_a_6) AUTO_DATA_1_A_6 = resp.AutoData_1_a_6;
          if (resp.AutoData_1_b_1_b) AUTO_DATA_1_B_1_B = resp.AutoData_1_b_1_b;
          if (resp.AutoData_1_b_1_d) AUTO_DATA_1_B_1_D = resp.AutoData_1_b_1_d;
          if (resp.AutoData_1_b_2_b) AUTO_DATA_1_B_2_B = resp.AutoData_1_b_2_b;
          if (resp.AutoData_1_b_3_b) AUTO_DATA_1_B_3_B = resp.AutoData_1_b_3_b;
          if (resp.AutoData_1_b_4_b) AUTO_DATA_1_B_4_B = resp.AutoData_1_b_4_b;
          if (resp.AutoData_1_b_5_b) AUTO_DATA_1_B_5_B = resp.AutoData_1_b_5_b;
          if (resp.AutoData_1_b_6_b) AUTO_DATA_1_B_6_B = resp.AutoData_1_b_6_b;
          if (resp.AutoData_1_b_7_b) AUTO_DATA_1_B_7_B = resp.AutoData_1_b_7_b;
          if (resp.AutoData_1_b_8_b) AUTO_DATA_1_B_8_B = resp.AutoData_1_b_8_b;
          if (resp.AutoData_1_b_9_b) AUTO_DATA_1_B_9_B = resp.AutoData_1_b_9_b;
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
  if (selectTahun) {
    selectTahun.addEventListener("change", function(){
      var url = new URL(window.location.href);
      url.searchParams.set("tahun", this.value);
      if (selectInstansi && selectInstansi.value) {
        url.searchParams.set("instansi_id", selectInstansi.value);
      }
      window.location.href = url.toString();
    });
  }

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

  var btnSaveAll = document.getElementById("btnSaveAll");
  if (btnSaveAll) {
    btnSaveAll.addEventListener("click", saveAllScores);
  }

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

    // Open Modal Detail (in verification mode if user is verifikator)
    var detailBtn = e.target.closest(".btn-action-detail");
    if (detailBtn){
      var itemCode = detailBtn.getAttribute("data-code");
      openDetailModal(itemCode, IS_VERIFIKATOR);
      return;
    }

    // Open Verifikator Modal (opens authentic Excel detail modal in verification mode)
    var verifBtn = e.target.closest(".btn-action-verifikator");
    if (verifBtn){
      var itemCode = verifBtn.getAttribute("data-code");
      openDetailModal(itemCode, true);
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
      if (modalRefDokumen) {
        modalRefDokumen.value = this.getAttribute("data-text");
        if (modalRefDokumen.type !== 'hidden') modalRefDokumen.focus();
      }
    });
  });

  // Excel catatan quick chips
  document.querySelectorAll(".excel-catatan-chip").forEach(function(chip){
    chip.addEventListener("click", function(){
      if (modalCatatan) {
        var textToAdd = this.getAttribute("data-text");
        var cur = modalCatatan.value.trim();
        if (!cur) {
          modalCatatan.value = textToAdd;
        } else if (cur.indexOf(textToAdd) === -1) {
          modalCatatan.value = cur + (cur.endsWith(".") ? " " : ", ") + textToAdd;
        }
        if (modalCatatan.type !== 'hidden') modalCatatan.focus();
      }
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
    if ((e.target.id === 'ws1a2aCatatan' || e.target.id === 'ws1a2bCatatan' || e.target.id === 'ws1a2cCatatan') && modalCatatan) {
      modalCatatan.value = e.target.value;
    }
    if (e.target.classList.contains("calc-inp") || e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT'){
      updateModalWorksheetScore();
    }
  });

  if (modalCatatan) {
    modalCatatan.addEventListener("input", function(){
      var cInp = document.getElementById("ws1a2aCatatan") || document.getElementById("ws1a2bCatatan") || document.getElementById("ws1a2cCatatan");
      if (cInp) cInp.value = this.value;
    });
  }

  modalDynamicWorksheet.addEventListener("change", function(e){
    if ((e.target.id === 'ws1a2aCatatan' || e.target.id === 'ws1a2bCatatan' || e.target.id === 'ws1a2cCatatan') && modalCatatan) {
      modalCatatan.value = e.target.value;
    }
    if (e.target.classList.contains("calc-inp") || e.target.tagName === 'SELECT' || e.target.id === 'wsSelectPersandingan' || e.target.id === 'wsSelectPersandingan1d'){
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

  var btnClose = document.getElementById("btnModalClose");
  if (btnClose) btnClose.addEventListener("click", closeDetailModal);

  var btnCancel = document.getElementById("btnModalCancel");
  if (btnCancel) btnCancel.addEventListener("click", closeDetailModal);
  
  var btnModalSave = document.getElementById("btnModalSave");
  if (btnModalSave) {
    btnModalSave.addEventListener("click", saveModalDetail);
  }

  // Verifikator Action Button Listeners inside Modal
  if (btnModalActionVerifikasi) {
    btnModalActionVerifikasi.addEventListener("click", function(){
      submitVerifikasi("verifikasi");
    });
  }
  if (btnModalActionPerbaiki) {
    btnModalActionPerbaiki.addEventListener("click", function(){
      submitVerifikasi("perbaiki");
    });
  }

  // Verifikator Decision Choices
  if (btnChoiceVerify) {
    btnChoiceVerify.addEventListener("click", function(){
      btnChoiceVerify.classList.add("active");
      if (btnChoiceRevision) btnChoiceRevision.classList.remove("active");
      if (boxAlasanRevisi) boxAlasanRevisi.style.display = "none";
      if (badgeVerifModalStatus) {
        badgeVerifModalStatus.className = "verif-badge-pill status-verified";
        badgeVerifModalStatus.innerHTML = '<i class="fa fa-check-circle"></i> Verifikasi (Sesuai)';
      }
    });
  }

  if (btnChoiceRevision) {
    btnChoiceRevision.addEventListener("click", function(){
      btnChoiceRevision.classList.add("active");
      if (btnChoiceVerify) btnChoiceVerify.classList.remove("active");
      if (boxAlasanRevisi) {
        boxAlasanRevisi.style.display = "block";
        if (modalAlasanRevisi) {
          modalAlasanRevisi.focus();
        }
      }
      if (badgeVerifModalStatus) {
        badgeVerifModalStatus.className = "verif-badge-pill status-revision";
        badgeVerifModalStatus.innerHTML = '<i class="fa fa-pencil-square-o"></i> Perlu Perbaikan';
      }
    });
  }

  // Template Quick Chips for Alasan Revisi
  document.querySelectorAll(".chip-item-revisi").forEach(function(chip){
    chip.addEventListener("click", function(){
      var text = this.getAttribute("data-text");
      if (!modalAlasanRevisi) return;
      if (modalAlasanRevisi.value.trim() === "") {
        modalAlasanRevisi.value = text;
      } else {
        modalAlasanRevisi.value += " " + text;
      }
      modalAlasanRevisi.focus();
    });
  });

  // Submit Verifikasi or Perbaiki
  function submitVerifikasi(action){
    if (!IS_ROLE_4 && !IS_VERIFIKATOR){
      showToast("Akses ditolak: Hanya akun verifikator yang dapat memverifikasi.", true);
      return;
    }

    var code = modalItemCode ? modalItemCode.value : "";
    if (!code) return;

    var item = itemMap[code];
    var maxVal = item ? item.bobot : 100;
    var currentScore = parseFloat(modalBobotInput ? modalBobotInput.value : 0);
    if (isNaN(currentScore)) currentScore = 0;

    var alasan = modalAlasanRevisi ? modalAlasanRevisi.value.trim() : "";
    var statusVerif = (action === 'perbaiki') ? 'Perlu Perbaikan' : 'Terverifikasi';

    if (action === 'perbaiki'){
      if (!alasan){
        if (boxAlasanRevisi) boxAlasanRevisi.style.display = 'block';
        if (btnChoiceRevision) btnChoiceRevision.classList.add('active');
        if (btnChoiceVerify) btnChoiceVerify.classList.remove('active');
        if (modalAlasanRevisi) modalAlasanRevisi.focus();

        Swal.fire({
          icon: 'warning',
          title: 'Alasan Revisi Wajib Diisi',
          text: 'Mohon tuliskan catatan perbaikan atau alasan mengapa indikator / bukti dukung ini belum sesuai agar daerah dapat memperbaikinya.',
          confirmButtonColor: '#d97706',
          confirmButtonText: 'Baik, Saya Isi Sekarang'
        });
        return;
      }
    }

    var detailData = collectDetailJson(code);

    var payload = {
      tahun: selectTahun ? selectTahun.value : 2026,
      instansi_id: selectInstansi ? selectInstansi.value : 1,
      item_code: code,
      bobot_verifikator: currentScore,
      opsi_aksi_verifikator: (action === 'perbaiki') ? 'Perlu Perbaikan' : 'Terverifikasi',
      status_verifikasi: statusVerif,
      alasan_revisi: (action === 'perbaiki') ? alasan : '',
      catatan_verifikator: (action === 'perbaiki') ? alasan : (modalCatatan ? modalCatatan.value.trim() : ''),
      bukti_dukung_verifikator: modalBuktiDukung ? modalBuktiDukung.value.trim() : '',
      detail_json: JSON.stringify(detailData)
    };

    var btnSubmit = (action === 'perbaiki') ? btnModalActionPerbaiki : btnModalActionVerifikasi;
    var origHtml = btnSubmit ? btnSubmit.innerHTML : '';
    if (btnSubmit){
      btnSubmit.disabled = true;
      btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';
    }

    $.ajax({
      url: BASE_URL + "Instansi/SaveIPPDVerifikator",
      type: "POST",
      data: payload,
      dataType: "json",
      success: function(resp){
        if (btnSubmit){
          btnSubmit.disabled = false;
          btnSubmit.innerHTML = origHtml;
        }

        if (resp && resp.status === 'success'){
          if (!SCORES_MAP[code]) SCORES_MAP[code] = {};
          SCORES_MAP[code].bobot_verifikator = currentScore;
          SCORES_MAP[code].status_verifikasi = statusVerif;
          SCORES_MAP[code].opsi_aksi_verifikator = (action === 'perbaiki') ? 'Perlu Perbaikan' : 'Terverifikasi';
          SCORES_MAP[code].alasan_revisi = (action === 'perbaiki') ? alasan : null;
          SCORES_MAP[code].catatan_verifikator = (action === 'perbaiki') ? alasan : (modalCatatan ? modalCatatan.value.trim() : '');
          if (statusVerif === 'Terverifikasi'){
            SCORES_MAP[code].bobot_capaian = currentScore;
          }

          closeDetailModal();
          renderTable();

          Swal.fire({
            icon: action === 'perbaiki' ? 'info' : 'success',
            title: action === 'perbaiki' ? 'Catatan Perbaikan Terkirim' : 'Berhasil Diverifikasi',
            text: resp.message || (action === 'perbaiki' ? 'Catatan perbaikan telah dikirim ke akun daerah.' : 'Nilai capaian berhasil diverifikasi dan disetujui.'),
            timer: 2000,
            showConfirmButton: false,
            confirmButtonColor: '#00c292'
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan',
            text: (resp && resp.message) ? resp.message : 'Terjadi kesalahan sistem saat menyimpan verifikasi.'
          });
        }
      },
      error: function(xhr, status, error){
        if (btnSubmit){
          btnSubmit.disabled = false;
          btnSubmit.innerHTML = origHtml;
        }
        Swal.fire({
          icon: 'error',
          title: 'Kesalahan Jaringan',
          text: 'Gagal menghubungi server: ' + (error || 'Koneksi terputus')
        });
      }
    });
  }

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
    openDetailModal(code, true);
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

