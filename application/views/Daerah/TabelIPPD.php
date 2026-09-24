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
.col-no { width: 70px; min-width: 70px; text-align: center; font-weight: 700; }
.col-bobot-maks { width: 160px; min-width: 160px; text-align: center; font-family: 'Roboto Mono', monospace; font-weight: 700; }
.col-bobot-capaian { width: 165px; min-width: 165px; text-align: center; }
.col-opsi-aksi { width: 200px; min-width: 200px; text-align: center; }

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
  max-width: 1420px;
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
          <col style="width: 70px;" />
          <col />
          <col style="width: 160px;" />
          <col style="width: 165px;" />
          <col style="width: 200px;" />
        </colgroup>
        <thead>
          <tr>
            <th class="col-no">NO</th>
            <th>URAIAN INDIKATOR / SUB-INDIKATOR</th>
            <th class="col-bobot-maks text-center">Bobot Maksimal</th>
            <th class="col-bobot-capaian text-center">Bobot Capaian</th>
            <th class="col-opsi-aksi text-center">Aksi & Detail Penilaian</th>
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
      <div class="excel-fx-icon">fx</div>
      <div class="excel-fx-text" id="excelFxContent">Uraian Indikator Evaluasi...</div>
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
            <label for="modalRefDokumen">Dokumen Sumber</label>
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
          </div>
          <div class="meta-field">
            <label for="modalBuktiDukung">Bukti Dukung / Tautan Digital</label>
            <textarea id="modalBuktiDukung" rows="2" placeholder="Link tautan dokumen, Google Drive, atau screenshot..."></textarea>
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
          </div>
          <button type="button" class="btn-excel-cancel" id="btnModalCancel">Batal</button>
          <button type="button" class="btn-excel-save" id="btnModalSave">
            <i class="fa fa-save"></i> Simpan Penilaian
          </button>
        </div>
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

  var collapsedKeys = new Set();
  var itemMap = {};

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
              var hasScore = savedScoreInd.bobot_capaian !== null && savedScoreInd.bobot_capaian !== undefined && savedScoreInd.bobot_capaian !== "";
              var currentScoreVal = hasSub ? calculatedScores[ind.code] : (hasScore ? savedScoreInd.bobot_capaian : "");

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
                '<td class="col-opsi-aksi">' + directActionHtml + '</td>';
              tbody.appendChild(trInd);

              if (isIndOpen && hasSub){
                ind.sub.forEach(function(sub){
                  var savedScoreSub = SCORES_MAP[sub.code] || {};
                  var hasSubScore = savedScoreSub.bobot_capaian !== null && savedScoreSub.bobot_capaian !== undefined && savedScoreSub.bobot_capaian !== "";
                  var currentSubScore = hasSubScore ? savedScoreSub.bobot_capaian : "";

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
        mn_base: d.lpe_mn_base !== undefined ? d.lpe_mn_base : '5.3',
        mn_end:  d.lpe_mn_end  !== undefined ? d.lpe_mn_end  : '6.2',
        md_base: d.lpe_md_base !== undefined ? d.lpe_md_base : '5.1',
        md_end:  d.lpe_md_end  !== undefined ? d.lpe_md_end  : '6.0' },
      { id: 'tk', name: 'Tingkat Kemiskinan (TK)', unit: 'Persen', isPositive: false,
        mn_base: d.tk_mn_base !== undefined ? d.tk_mn_base : '9.2',
        mn_end:  d.tk_mn_end  !== undefined ? d.tk_mn_end  : '6.5',
        md_base: d.tk_md_base !== undefined ? d.tk_md_base : '11.4',
        md_end:  d.tk_md_end  !== undefined ? d.tk_md_end  : '7.8' },
      { id: 'tpt', name: 'Tingkat Pengangguran Terbuka (TPT)', unit: 'Persen', isPositive: false,
        mn_base: d.tpt_mn_base !== undefined ? d.tpt_mn_base : '5.2',
        mn_end:  d.tpt_mn_end  !== undefined ? d.tpt_mn_end  : '4.0',
        md_base: d.tpt_md_base !== undefined ? d.tpt_md_base : '7.8',
        md_end:  d.tpt_md_end  !== undefined ? d.tpt_md_end  : '5.2' }
    ];

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Excel Poin 1.a.1.a</span>' +
        '<span style="font-style:italic;"><i class="fa fa-arrows-h"></i> Geser ke kanan untuk melihat kolom perhitungan & margin</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_a" style="min-width: 1580px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th>' +
            '<th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th><th class="excel-col-letter">I</th><th class="excel-col-letter">J</th>' +
            '<th class="excel-col-letter">K</th><th class="excel-col-letter">L</th><th class="excel-col-letter">M</th><th class="excel-col-letter">N</th><th class="excel-col-letter">O</th>' +
            '<th class="excel-col-letter">P</th><th class="excel-col-letter">Q</th><th class="excel-col-letter">R</th><th class="excel-col-letter">S</th><th class="excel-col-letter">T</th><th class="excel-col-letter">U</th><th class="excel-col-letter">V</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="3">1</th>' +
            '<th colspan="5" class="th-blue" style="font-size:13px;">RPJMN (Nasional)</th>' +
            '<th colspan="5" class="th-amber" style="font-size:13px;">RPJMD (Daerah)</th>' +
            '<th colspan="3" class="th-green">Cek Target Baseline</th>' +
            '<th colspan="3" class="th-green">Cek Target Akhir</th>' +
            '<th colspan="3" class="th-green">Cek Gap Target</th>' +
            '<th rowspan="3" class="th-green" style="width:85px; white-space:nowrap;">Nilai Rata-rata (%)</th>' +
            '<th rowspan="3" class="th-green" style="width:65px; white-space:nowrap;">Bobot</th>' +
            '<th rowspan="3" class="th-green" style="width:95px; white-space:nowrap;">Keselarasan Terbobot</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width:200px; white-space:nowrap;">Indikator Sasaran PN</th>' +
            '<th colspan="3" class="th-blue">Target RPJMN</th>' +
            '<th rowspan="2" class="th-blue" style="width:65px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width:200px; white-space:nowrap;">Indikator Sasaran Daerah</th>' +
            '<th colspan="3" class="th-amber">Target RPJMD</th>' +
            '<th rowspan="2" class="th-amber" style="width:65px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width:65px;">Baseline</th><th class="th-blue" style="width:65px;">Akhir</th><th class="th-blue" style="width:60px;">Gap</th>' +
            '<th class="th-amber" style="width:65px;">Baseline</th><th class="th-amber" style="width:65px;">Akhir</th><th class="th-amber" style="width:60px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rowsData.forEach(function(r, idx){
      var rNum = idx + 4;
      html += 
        '<tr class="ws-1a1a-row" data-row-id="' + r.id + '" data-positive="' + (r.isPositive ? '1' : '0') + '">' +
          '<td class="excel-row-num">' + rNum + '</td>' +
          '<td><strong>' + r.name + '</strong></td>' +
          '<td><input type="number" step="0.01" class="calc-inp mn-base" value="' + escapeHtml(r.mn_base) + '"></td>' +
          '<td><input type="number" step="0.01" class="calc-inp mn-end" value="' + escapeHtml(r.mn_end) + '"></td>' +
          '<td class="cell-formula mn-gap">0.00</td>' +
          '<td style="text-align:center; font-weight:600; color:#475569;">' + r.unit + '</td>' +
          '<td><strong>' + r.name + '</strong></td>' +
          '<td><input type="number" step="0.01" class="calc-inp md-base" value="' + escapeHtml(r.md_base) + '"></td>' +
          '<td><input type="number" step="0.01" class="calc-inp md-end" value="' + escapeHtml(r.md_end) + '"></td>' +
          '<td class="cell-formula md-gap">0.00</td>' +
          '<td style="text-align:center; font-weight:600; color:#475569;">' + r.unit + '</td>' +
          '<td class="cell-formula margin-base">0.0%</td>' +
          '<td class="cell-formula ket-base" style="font-size:11.5px;">100%</td>' +
          '<td class="cell-formula score-base" style="font-weight:700; color:#107c41;">100%</td>' +
          '<td class="cell-formula margin-end">0.0%</td>' +
          '<td class="cell-formula ket-end" style="font-size:11.5px;">100%</td>' +
          '<td class="cell-formula score-end" style="font-weight:700; color:#107c41;">100%</td>' +
          '<td class="cell-formula margin-gap">0.0%</td>' +
          '<td class="cell-formula ket-gap" style="font-size:11.5px;">100%</td>' +
          '<td class="cell-formula score-gap" style="font-weight:700; color:#107c41;">100%</td>' +
          '<td class="cell-formula row-avg" style="font-weight:800; background:#e2efda; color:#107c41;">100.0%</td>' +
          '<td style="text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
          '<td class="cell-formula row-terbobot" style="font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">7</td>' +
            '<td colspan="19" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA KESELARASAN TERBOBOT =AVERAGE(V4:V6)</td>' +
            '<td class="cell-formula" id="ws1a1aGrandAvg" style="text-align:center; background:#e2efda; color:#107c41; font-size:13px;">100.0%</td>' +
            '<td style="text-align:center; font-family:\'Roboto Mono\'; font-size:13px;">' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="ws1a1aGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
          '</tr>' +
        '</tfoot>' +
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
      '<table class="excel-grid-table" style="min-width: 900px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th>' +
            '<th class="excel-col-letter">B</th>' +
            '<th class="excel-col-letter">C</th>' +
            '<th class="excel-col-letter">D</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-green" style="width: 45%;">Parameter Pemeriksaan Dokumen (RPJMD)</th>' +
            '<th class="th-blue" style="width: 25%;">Status Ketersediaan Tabel</th>' +
            '<th class="th-green" style="width: 15%;">Formula Excel</th>' +
            '<th class="th-green" style="width: 15%;">Keselarasan Terbobot</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr>' +
            '<td class="excel-row-num">2</td>' +
            '<td><strong>' + labelItem + '</strong></td>' +
            '<td>' +
              '<select id="wsSelectPersandingan" style="font-weight:700; color:#107c41;">' +
                '<option value="Ada"' + (curVal === 'Ada' ? ' selected' : '') + '>Ada (Tersedia dalam Dokumen)</option>' +
                '<option value="Tidak Ada"' + (curVal === 'Tidak Ada' ? ' selected' : '') + '>Tidak Ada (Belum Tersedia)</option>' +
              '</select>' +
            '</td>' +
            '<td style="font-family:\'Roboto Mono\'; font-size:11.5px; color:#64748b; text-align:center;">=IF(B2="Ada", ' + numFmt(maxBobot) + ', 0)</td>' +
            '<td class="cell-formula" id="wsPersandinganResult" style="font-size:14.5px; font-weight:800; text-align:center; background:#d1fae5; color:#065f46;">' + 
              (curVal === 'Ada' ? numFmt(maxBobot) : '0,000') + 
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
    var pns = d.pn_list || [
      {
        pn_title: 'PN 1 : Memperkuat Ketahanan Ekonomi untuk Pertumbuhan yang Berkualitas dan Berkeadilan',
        pds: [
          { title: 'Prioritas Daerah 1 : Peningkatan Ekonomi Berkelanjutan & Pertanian Modern', score: 1.0, ket: 'Selaras Sepenuhnya' },
          { title: 'Prioritas Daerah 2 : Pengembangan UMKM, Industri Kreatif dan Perdagangan', score: 1.0, ket: 'Selaras Sepenuhnya' }
        ]
      },
      {
        pn_title: 'PN 2 : Mengembangkan Wilayah untuk Mengurangi Kesenjangan dan Menjamin Pemerataan',
        pds: [
          { title: 'Prioritas Daerah 3 : Pemerataan Pembangunan Infrastruktur Wilayah Terpadu', score: 1.0, ket: 'Selaras Sepenuhnya' },
          { title: 'Prioritas Daerah 4 : Peningkatan Konektivitas Antar Kawasan Pedesaan dan Perkotaan', score: 1.0, ket: 'Selaras Sepenuhnya' }
        ]
      },
      {
        pn_title: 'PN 3 : Meningkatkan Sumber Daya Manusia yang Berkualitas dan Berdaya Saing',
        pds: [
          { title: 'Prioritas Daerah 5 : Peningkatan Kualitas dan Aksesibilitas Layanan Pendidikan', score: 1.0, ket: 'Selaras Sepenuhnya' },
          { title: 'Prioritas Daerah 6 : Penguatan Mutu Layanan Kesehatan dan Penurunan Stunting', score: 1.0, ket: 'Selaras Sepenuhnya' }
        ]
      },
      {
        pn_title: 'PN 4 : Revolusi Mental dan Pembangunan Kebudayaan',
        pds: [
          { title: 'Prioritas Daerah 7 : Pelestarian Nilai Budaya Lokal dan Penguatan Karakter Masyarakat', score: 1.0, ket: 'Selaras Sepenuhnya' }
        ]
      },
      {
        pn_title: 'PN 5 : Memperkuat Infrastruktur untuk Mendukung Pengembangan Ekonomi dan Pelayanan Dasar',
        pds: [
          { title: 'Prioritas Daerah 8 : Penyediaan Sarana Air Bersih, Sanitasi Layak dan Hunian Berkualitas', score: 1.0, ket: 'Selaras Sepenuhnya' }
        ]
      }
    ];

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Matriks Prioritas Daerah vs Prioritas Nasional</span>' +
        '<span style="font-style:italic;"><i class="fa fa-arrows-h"></i> Geser horizontal jika diperlukan</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_1_c" style="min-width: 1200px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th><th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-blue" style="width: 28%;">Prioritas Pembangunan Nasional (RPJMN)</th>' +
            '<th class="th-amber" style="width: 32%;">Prioritas Pembangunan Daerah (RPJMD)</th>' +
            '<th class="th-green" style="width: 14%;">Nilai Keselarasan</th>' +
            '<th class="th-gray" style="width: 12%;">Keterangan</th>' +
            '<th class="th-green" style="width: 9%;">Rata-rata PN</th>' +
            '<th class="th-green" style="width: 7%;">Bobot</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 2;
    pns.forEach(function(pn, pnIdx){
      var pdCount = pn.pds && pn.pds.length > 0 ? pn.pds.length : 1;
      (pn.pds || [{ title: '', score: 1.0, ket: '' }]).forEach(function(pd, pdIdx){
        html += 
          '<tr class="ws-matrix-row" data-pn-idx="' + pnIdx + '" data-pd-idx="' + pdIdx + '">' +
            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-pn-wrap" style="vertical-align:top; background:#f0f7ff;">' +
              '<textarea class="calc-inp pn-title-inp" rows="2" style="font-weight:700; color:#1e3a8a;" placeholder="Prioritas Nasional...">' + escapeHtml(pn.pn_title) + '</textarea>' +
              '<button type="button" class="btn-mini-add-pd" data-pn-idx="' + pnIdx + '" style="font-size:10.5px; padding:3px 8px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:6px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
            '</td>';
        }

        html += 
            '<td><input type="text" class="calc-inp pd-title-inp" value="' + escapeHtml(pd.title) + '" placeholder="Prioritas Daerah..."></td>' +
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
            '<td rowspan="' + pdCount + '" class="cell-formula pn-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" class="cell-formula pn-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center;">' +
              '<button type="button" class="btn-del-pn" data-pn-idx="' + pnIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Blok PN"><i class="fa fa-trash"></i></button>' +
            '</td>';
        } else {
          html += 
            '<td style="text-align:center;"><button type="button" class="btn-del-pd" data-pn-idx="' + pnIdx + '" data-pd-idx="' + pdIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus Baris PD"><i class="fa fa-times"></i></button></td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + rowCounter + '</td>' +
            '<td colspan="5" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE(G:G)</td>' +
            '<td style="text-align:center; font-family:\'Roboto Mono\'; font-size:13px;">' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="ws1a1cGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAddPnBlock"><i class="fa fa-plus-circle"></i> Tambah Blok Prioritas Nasional (PN)</button>' +
      '</div>';

    return html;
  }

  // 4. Sheet 1.a.2.a (PN 1 Kegiatan Prioritas PP 1 s.d PP 8)
  function renderWs_1_a_2_a(d, maxBobot){
    d = d || {};
    var ppList = d.pp_list || [
      { pp_title: 'PP 1 : Peningkatan Ketersediaan, Akses, dan Kualitas Konsumsi Pangan', pds: [{ title: 'Dukungan Program Pengelolaan Pertanian & Ketahanan Pangan Daerah', score: 1.0 }] },
      { pp_title: 'PP 2 : Penguatan Kewirausahaan, UMKM, dan Koperasi', pds: [{ title: 'Dukungan Program Pemberdayaan Usaha Mikro dan Koperasi Daerah', score: 1.0 }] },
      { pp_title: 'PP 3 : Peningkatan Nilai Tambah, Lapangan Kerja, dan Investasi Sektor Riil', pds: [{ title: 'Dukungan Program Promosi Penanaman Modal & Pelayanan Perizinan Terpadu', score: 1.0 }] },
      { pp_title: 'PP 4 : Pengembangan Ekspor dan Daya Saing Produk Lokal', pds: [{ title: 'Dukungan Program Pengembangan Perdagangan Dalam dan Luar Negeri', score: 1.0 }] },
      { pp_title: 'PP 5 : Penguatan Pilar Ketahanan Energi & Energi Terbarukan', pds: [{ title: 'Dukungan Program Pengelolaan Energi dan Sumber Daya Alam Daerah', score: 1.0 }] },
      { pp_title: 'PP 6 : Peningkatan Produktivitas Pertanian dan Ketahanan Air', pds: [{ title: 'Dukungan Program Pengelolaan Sumber Daya Air & Irigasi Pertanian', score: 1.0 }] },
      { pp_title: 'PP 7 : Penguatan Ketahanan Bencana dan Pemanfaatan Maritim', pds: [{ title: 'Dukungan Program Pengelolaan Perikanan Tangkap & Budidaya', score: 1.0 }] },
      { pp_title: 'PP 8 : Penguatan Kemitraan Sektor Swasta dan Masyarakat', pds: [{ title: 'Dukungan Program Kerjasama Pembangunan Ekonomi Inklusif Daerah', score: 1.0 }] }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_a" style="min-width: 1280px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th><th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-blue" style="width: 25%;">Prioritas Nasional (RPJMN)</th>' +
            '<th class="th-blue" style="width: 28%;">Program Prioritas (PP)</th>' +
            '<th class="th-amber" style="width: 30%;">Dukungan Program Daerah (RPJMD)</th>' +
            '<th class="th-green" style="width: 13%;">Keselarasan</th>' +
            '<th class="th-green" style="width: 9%;">Rata-rata PP</th>' +
            '<th class="th-green" style="width: 7%;">Bobot</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 2;
    ppList.forEach(function(pp, ppIdx){
      var pdCount = pp.pds && pp.pds.length > 0 ? pp.pds.length : 1;
      (pp.pds || [{ title: '', score: 1.0 }]).forEach(function(pd, pdIdx){
        html += 
          '<tr class="ws-pp-row" data-pp-idx="' + ppIdx + '" data-pd-idx="' + pdIdx + '">' +
            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

        if (ppIdx === 0 && pdIdx === 0){
          var totalRowsAll = ppList.reduce(function(acc, item){ return acc + (item.pds ? item.pds.length : 1); }, 0);
          html += 
            '<td rowspan="' + totalRowsAll + '" class="cell-pn-wrap-2a" style="vertical-align:top; background:#f0f7ff; font-weight:800; color:#1e3a8a;">' +
              'PN 1 : Memperkuat Ketahanan Ekonomi untuk Pertumbuhan yang Berkualitas dan Berkeadilan' +
            '</td>';
        }

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-pp-wrap-2a" style="vertical-align:top; background:#fdfdfd;">' +
              '<input type="text" class="calc-inp pp-title-inp" style="font-weight:700; color:#203764;" value="' + escapeHtml(pp.pp_title) + '" placeholder="Program Prioritas...">' +
              '<button type="button" class="btn-add-pd-2a" data-pp-idx="' + ppIdx + '" style="font-size:10.5px; padding:3px 7px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:5px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
            '</td>';
        }

        html += 
            '<td><input type="text" class="calc-inp pd-title-inp" value="' + escapeHtml(pd.title) + '" placeholder="Program Daerah..."></td>' +
            '<td>' +
              '<select class="calc-inp pd-score-sel">' +
                '<option value="1.0"' + (pd.score == 1.0 || pd.score === undefined ? ' selected' : '') + '>100% (Selaras)</option>' +
                '<option value="0.5"' + (pd.score == 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
                '<option value="0"' + (pd.score == 0 ? ' selected' : '') + '>0% (Tidak Selaras)</option>' +
              '</select>' +
            '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-formula pp-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" class="cell-formula pp-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center;">' +
              '<button type="button" class="btn-del-pp-2a" data-pp-idx="' + ppIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus PP"><i class="fa fa-trash"></i></button>' +
            '</td>';
        } else {
          html += 
            '<td style="text-align:center;"><button type="button" class="btn-del-pd-2a" data-pp-idx="' + ppIdx + '" data-pd-idx="' + pdIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + rowCounter + '</td>' +
            '<td colspan="5" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE(H:H)</td>' +
            '<td style="text-align:center; font-family:\'Roboto Mono\'; font-size:13px;">' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="ws1a2aGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAddPp2a"><i class="fa fa-plus-circle"></i> Tambah Program Prioritas (PP)</button>' +
      '</div>';

    return html;
  }

  // 5. Sheets 1.a.2.b s.d 1.a.2.g (PN 2 s.d PN 7 dengan Kolom Review TA Bidang)
  function renderWs_1_a_2_b_to_g(code, d, maxBobot){
    d = d || {};
    var pnInfo = {
      '1.a.2.b': { no: '2', title: 'PN 2 : Mengembangkan Wilayah untuk Mengurangi Kesenjangan dan Menjamin Pemerataan' },
      '1.a.2.c': { no: '3', title: 'PN 3 : Meningkatkan Sumber Daya Manusia yang Berkualitas dan Berdaya Saing' },
      '1.a.2.d': { no: '4', title: 'PN 4 : Revolusi Mental dan Pembangunan Kebudayaan' },
      '1.a.2.e': { no: '5', title: 'PN 5 : Memperkuat Infrastruktur untuk Mendukung Pengembangan Ekonomi dan Pelayanan Dasar' },
      '1.a.2.f': { no: '6', title: 'PN 6 : Membangun Lingkungan Hidup, Meningkatkan Ketahanan Bencana dan Perubahan Iklim' },
      '1.a.2.g': { no: '7', title: 'PN 7 : Memperkuat Stabilitas Polhukhankam dan Transformasi Pelayanan Publik' }
    }[code] || { no: '2', title: 'PN RPJMN' };

    var ppList = d.pp_list || [
      { pp_title: 'Program Prioritas 1', pds: [{ title: 'Dukungan Program Pembangunan Daerah 1', ta_review: 'Sesuai dengan Kewenangan Daerah', score: 1.0 }] },
      { pp_title: 'Program Prioritas 2', pds: [{ title: 'Dukungan Program Pembangunan Daerah 2', ta_review: 'Sesuai dengan Kewenangan Daerah', score: 1.0 }] }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_2_bg" style="min-width: 1320px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th><th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th><th class="excel-col-letter">I</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-blue" style="width: 22%;">Prioritas Nasional (RPJMN)</th>' +
            '<th class="th-blue" style="width: 24%;">Program Prioritas (PP)</th>' +
            '<th class="th-amber" style="width: 24%;">Dukungan Program Daerah</th>' +
            '<th class="th-green" style="width: 16%;">Hasil Review TA Bidang</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan</th>' +
            '<th class="th-green" style="width: 8%;">Rata-rata PP</th>' +
            '<th class="th-green" style="width: 6%;">Bobot</th>' +
            '<th class="th-green" style="width: 9%;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 2;
    ppList.forEach(function(pp, ppIdx){
      var pdCount = pp.pds && pp.pds.length > 0 ? pp.pds.length : 1;
      (pp.pds || [{ title: '', ta_review: '', score: 1.0 }]).forEach(function(pd, pdIdx){
        html += 
          '<tr class="ws-ppbg-row" data-pp-idx="' + ppIdx + '" data-pd-idx="' + pdIdx + '">' +
            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

        if (ppIdx === 0 && pdIdx === 0){
          var totalRowsAll = ppList.reduce(function(acc, item){ return acc + (item.pds ? item.pds.length : 1); }, 0);
          html += 
            '<td rowspan="' + totalRowsAll + '" class="cell-pn-wrap-bg" style="vertical-align:top; background:#f0f7ff; font-weight:800; color:#1e3a8a;">' +
              escapeHtml(pnInfo.title) +
            '</td>';
        }

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-pp-wrap-bg" style="vertical-align:top; background:#fdfdfd;">' +
              '<textarea class="calc-inp pp-title-inp" rows="2" style="font-weight:700; color:#203764;" placeholder="Program Prioritas...">' + escapeHtml(pp.pp_title) + '</textarea>' +
              '<button type="button" class="btn-add-pd-bg" data-pp-idx="' + ppIdx + '" style="font-size:10.5px; padding:3px 7px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:5px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
            '</td>';
        }

        html += 
            '<td><input type="text" class="calc-inp pd-title-inp" value="' + escapeHtml(pd.title) + '" placeholder="Program Daerah..."></td>' +
            '<td><input type="text" class="pd-review-inp" value="' + escapeHtml(pd.ta_review || '') + '" placeholder="Review TA..."></td>' +
            '<td>' +
              '<select class="calc-inp pd-score-sel">' +
                '<option value="1.0"' + (pd.score == 1.0 || pd.score === undefined ? ' selected' : '') + '>100% (Iya)</option>' +
                '<option value="0.5"' + (pd.score == 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
                '<option value="0"' + (pd.score == 0 ? ' selected' : '') + '>0% (Tidak)</option>' +
              '</select>' +
            '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-formula pp-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" class="cell-formula pp-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center;">' +
              '<button type="button" class="btn-del-pp-bg" data-pp-idx="' + ppIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus PP"><i class="fa fa-trash"></i></button>' +
            '</td>';
        } else {
          html += 
            '<td style="text-align:center;"><button type="button" class="btn-del-pd-bg" data-pp-idx="' + ppIdx + '" data-pd-idx="' + pdIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + rowCounter + '</td>' +
            '<td colspan="6" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE(I:I)</td>' +
            '<td style="text-align:center; font-family:\'Roboto Mono\'; font-size:13px;">' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="ws1a2bgGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAddPpBlock"><i class="fa fa-plus-circle"></i> Tambah Program Prioritas (PP)</button>' +
      '</div>';

    return html;
  }

  // 6. Sheet 1.a.3.a (TPT) & 1.a.3.b (TK) (RPJMN vs RPJMD)
  function renderWs_1_a_3(code, d, maxBobot){
    d = d || {};
    var isTpt = (code === '1.a.3.a');
    var indName = isTpt ? 'Tingkat Pengangguran Terbuka (TPT)' : 'Tingkat Kemiskinan (TK)';
    var mn_base = d.mn_base !== undefined ? d.mn_base : (isTpt ? '5.2' : '9.2');
    var mn_end  = d.mn_end  !== undefined ? d.mn_end  : (isTpt ? '4.0' : '6.5');
    var md_base = d.md_base !== undefined ? d.md_base : (isTpt ? '7.8' : '11.4');
    var md_end  = d.md_end  !== undefined ? d.md_end  : (isTpt ? '5.2' : '7.8');

    var html = 
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:11.5px; color:#64748b;">' +
        '<span style="font-weight:700;"><i class="fa fa-table"></i> Lembar Kerja Indikator Makro RPJMD vs RPJMN (' + (isTpt ? 'TPT' : 'TK') + ')</span>' +
        '<span style="font-style:italic;"><i class="fa fa-arrows-h"></i> Geser ke kanan untuk melihat kolom margin</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_3" style="min-width: 1520px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th>' +
            '<th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th><th class="excel-col-letter">I</th><th class="excel-col-letter">J</th>' +
            '<th class="excel-col-letter">K</th><th class="excel-col-letter">L</th><th class="excel-col-letter">M</th><th class="excel-col-letter">N</th><th class="excel-col-letter">O</th>' +
            '<th class="excel-col-letter">P</th><th class="excel-col-letter">Q</th><th class="excel-col-letter">R</th><th class="excel-col-letter">S</th><th class="excel-col-letter">T</th><th class="excel-col-letter">U</th><th class="excel-col-letter">V</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="3">1</th>' +
            '<th colspan="5" class="th-blue" style="font-size:13px;">RPJMN (Nasional)</th>' +
            '<th colspan="5" class="th-amber" style="font-size:13px;">RPJMD (Daerah)</th>' +
            '<th colspan="3" class="th-green">Cek Target Baseline</th>' +
            '<th colspan="3" class="th-green">Cek Target Akhir</th>' +
            '<th colspan="3" class="th-green">Cek Gap Target</th>' +
            '<th rowspan="3" class="th-green" style="width:85px; white-space:nowrap;">Nilai Rata-rata (%)</th>' +
            '<th rowspan="3" class="th-green" style="width:65px; white-space:nowrap;">Bobot</th>' +
            '<th rowspan="3" class="th-green" style="width:95px; white-space:nowrap;">Keselarasan Terbobot</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width:200px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue">Target RPJMN</th>' +
            '<th rowspan="2" class="th-blue" style="width:65px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width:200px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber">Target RPJMD</th>' +
            '<th rowspan="2" class="th-amber" style="width:65px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width:65px;">Baseline</th><th class="th-blue" style="width:65px;">Akhir</th><th class="th-blue" style="width:60px;">Gap</th>' +
            '<th class="th-amber" style="width:65px;">Baseline</th><th class="th-amber" style="width:65px;">Akhir</th><th class="th-amber" style="width:60px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-1a3-row" data-positive="0">' +
            '<td class="excel-row-num">4</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="number" step="0.01" class="calc-inp mn-base" value="' + escapeHtml(mn_base) + '"></td>' +
            '<td><input type="number" step="0.01" class="calc-inp mn-end" value="' + escapeHtml(mn_end) + '"></td>' +
            '<td class="cell-formula mn-gap">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="number" step="0.01" class="calc-inp md-base" value="' + escapeHtml(md_base) + '"></td>' +
            '<td><input type="number" step="0.01" class="calc-inp md-end" value="' + escapeHtml(md_end) + '"></td>' +
            '<td class="cell-formula md-gap">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
            '<td class="cell-formula margin-base">0.0%</td>' +
            '<td class="cell-formula ket-base" style="font-size:11.5px;">100%</td>' +
            '<td class="cell-formula score-base" style="font-weight:700; color:#107c41;">100%</td>' +
            '<td class="cell-formula margin-end">0.0%</td>' +
            '<td class="cell-formula ket-end" style="font-size:11.5px;">100%</td>' +
            '<td class="cell-formula score-end" style="font-weight:700; color:#107c41;">100%</td>' +
            '<td class="cell-formula margin-gap">0.0%</td>' +
            '<td class="cell-formula ket-gap" style="font-size:11.5px;">100%</td>' +
            '<td class="cell-formula score-gap" style="font-weight:700; color:#107c41;">100%</td>' +
            '<td class="cell-formula row-avg" style="font-weight:800; background:#e2efda; color:#107c41;">100.0%</td>' +
            '<td style="text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula row-terbobot" style="font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 7. Sheet 1.a.4 (Major Project RPJMN vs RPJMD)
  function renderWs_1_a_4(d, maxBobot){
    d = d || {};
    var mpList = d.mp_list || [
      { mp_title: 'MP 1 : Pengembangan Aksesibilitas Konektivitas Logistik Wilayah', pds: [{ title: 'Dukungan Program Penyelenggaraan Jalan & Jembatan Daerah', score: 1.0 }] },
      { mp_title: 'MP 2 : Percepatan Penurunan Kematian Ibu dan Stunting', pds: [{ title: 'Dukungan Program Pemenuhan Upaya Kesehatan Ibu dan Anak Terpadu', score: 1.0 }] },
      { mp_title: 'MP 3 : Transformasi Digital dan SPBE Nasional', pds: [{ title: 'Dukungan Program Aplikasi Informatika dan Transformasi SPBE Daerah', score: 1.0 }] },
      { mp_title: 'MP 4 : Pemulihan Pasca Bencana & Pengurangan Risiko Bencana', pds: [{ title: 'Dukungan Program Pencegahan dan Kesiapsiagaan Bencana Daerah', score: 1.0 }] }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_a_4" style="min-width: 1180px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th><th class="excel-col-letter">F</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-blue" style="width: 35%;">Proyek Prioritas Strategis (Major Project RPJMN)</th>' +
            '<th class="th-amber" style="width: 35%;">Dukungan Program Daerah (RPJMD)</th>' +
            '<th class="th-green" style="width: 14%;">Nilai Keselarasan</th>' +
            '<th class="th-green" style="width: 8%;">Rata-rata MP</th>' +
            '<th class="th-green" style="width: 8%;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 2;
    mpList.forEach(function(mp, mpIdx){
      var pdCount = mp.pds && mp.pds.length > 0 ? mp.pds.length : 1;
      (mp.pds || [{ title: '', score: 1.0 }]).forEach(function(pd, pdIdx){
        html += 
          '<tr class="ws-mp-row" data-mp-idx="' + mpIdx + '" data-pd-idx="' + pdIdx + '">' +
            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-mp-wrap" style="vertical-align:top; background:#f0f7ff;">' +
              '<input type="text" class="calc-inp mp-title-inp" style="font-weight:700; color:#1e3a8a;" value="' + escapeHtml(mp.mp_title) + '" placeholder="Major Project...">' +
              '<button type="button" class="btn-add-pd-1a4" data-mp-idx="' + mpIdx + '" style="font-size:10.5px; padding:3px 7px; background:#eff6ff; border:1px dashed #3b82f6; border-radius:4px; cursor:pointer; color:#1d4ed8; margin-top:5px; font-weight:700;"><i class="fa fa-plus"></i> Tambah PD</button>' +
            '</td>';
        }

        html += 
            '<td><input type="text" class="calc-inp pd-title-inp" value="' + escapeHtml(pd.title) + '" placeholder="Program Daerah..."></td>' +
            '<td>' +
              '<select class="calc-inp pd-score-sel">' +
                '<option value="1.0"' + (pd.score == 1.0 || pd.score === undefined ? ' selected' : '') + '>Iya (100%)</option>' +
                '<option value="0.5"' + (pd.score == 0.5 ? ' selected' : '') + '>Tidak (50%)</option>' +
              '</select>' +
            '</td>';

        if (pdIdx === 0){
          html += 
            '<td rowspan="' + pdCount + '" class="cell-formula mp-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
            '<td rowspan="' + pdCount + '" class="cell-formula mp-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td rowspan="' + pdCount + '" style="vertical-align:middle; text-align:center;">' +
              '<button type="button" class="btn-del-mp-1a4" data-mp-idx="' + mpIdx + '" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus MP"><i class="fa fa-trash"></i></button>' +
            '</td>';
        } else {
          html += 
            '<td style="text-align:center;"><button type="button" class="btn-del-pd-1a4" data-mp-idx="' + mpIdx + '" data-pd-idx="' + pdIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus PD"><i class="fa fa-times"></i></button></td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + rowCounter + '</td>' +
            '<td colspan="3" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA KESELARASAN TERBOBOT =AVERAGE(E:E)</td>' +
            '<td class="cell-formula" id="ws1a4GrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAdd1a4Mp"><i class="fa fa-plus-circle"></i> Tambah Major Project (MP)</button>' +
      '</div>';

    return html;
  }

  // 8. Sheet 1.a.5 (Komponen SPM RPJMD) & Sheet 1.a.6 (Target SPM)
  function renderWs_SPM(code, d, maxBobot){
    d = d || {};
    var isTarget = (code === '1.a.6');
    var spmList = d.spm_list || [
      { bidang: '1. Pendidikan', ind_list: [{ name: 'Pendidikan Anak Usia Dini (PAUD)', target: '100%', unit: 'Persen', score: 1.0 }, { name: 'Pendidikan Dasar 9 Tahun', target: '100%', unit: 'Persen', score: 1.0 }] },
      { bidang: '2. Kesehatan', ind_list: [{ name: 'Pelayanan Kesehatan Ibu dan Balita', target: '100%', unit: 'Persen', score: 1.0 }, { name: 'Pelayanan Kesehatan Usia Produktif & Lansia', target: '100%', unit: 'Persen', score: 1.0 }] },
      { bidang: '3. Pekerjaan Umum', ind_list: [{ name: 'Akses Air Minum Layak', target: '100%', unit: 'Persen', score: 1.0 }, { name: 'Akses Sanitasi Layak dan Aman', target: '100%', unit: 'Persen', score: 1.0 }] },
      { bidang: '4. Perumahan Rakyat', ind_list: [{ name: 'Penyediaan Rumah Layak Huni Korban Bencana', target: '100%', unit: 'Persen', score: 1.0 }] },
      { bidang: '5. Ketenteraman & Ketertiban', ind_list: [{ name: 'Pelayanan Penegakan Perda dan Perlindungan Masyarakat', target: '100%', unit: 'Persen', score: 1.0 }] },
      { bidang: '6. Sosial', ind_list: [{ name: 'Pelayanan Sosial Dasar Penyandang Disabilitas & Lansia', target: '100%', unit: 'Persen', score: 1.0 }] }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_SPM" style="min-width: 1220px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th>' +
            (isTarget ? '<th class="excel-col-letter">D</th><th class="excel-col-letter">E</th>' : '') +
            '<th class="excel-col-letter">' + (isTarget ? 'F' : 'D') + '</th><th class="excel-col-letter">' + (isTarget ? 'G' : 'E') + '</th><th class="excel-col-letter">' + (isTarget ? 'H' : 'F') + '</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-green" style="width: 22%;">6 Bidang SPM (PP 2/2018)</th>' +
            '<th class="th-amber" style="width: 30%;">Indikator SPM di Daerah</th>' +
            (isTarget ? '<th class="th-blue" style="width: 12%;">Target</th><th class="th-blue" style="width: 10%;">Satuan</th>' : '') +
            '<th class="th-green" style="width: 14%;">Nilai Keselarasan</th>' +
            '<th class="th-green" style="width: 10%;">Rata-rata per Bidang</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    var rowCounter = 2;
    spmList.forEach(function(bid, bidIdx){
      var indCount = bid.ind_list && bid.ind_list.length > 0 ? bid.ind_list.length : 1;
      (bid.ind_list || [{ name: '', target: '100%', unit: 'Persen', score: 1.0 }]).forEach(function(ind, indIdx){
        html += 
          '<tr class="ws-spm-row" data-bid-idx="' + bidIdx + '" data-ind-idx="' + indIdx + '">' +
            '<td class="excel-row-num">' + (rowCounter++) + '</td>';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" class="cell-spm-bid-wrap" style="vertical-align:top; background:#f0fdf4; font-weight:700; color:#065f46;">' +
              escapeHtml(bid.bidang) +
              '<br><button type="button" class="btn-add-ind-spm" data-bid-idx="' + bidIdx + '" style="font-size:10.5px; padding:3px 7px; background:#e2efda; border:1px dashed #107c41; border-radius:4px; cursor:pointer; color:#065f46; margin-top:6px; font-weight:700;"><i class="fa fa-plus"></i> Tambah Indikator</button>' +
            '</td>';
        }

        html += 
            '<td><input type="text" class="calc-inp ind-name-inp" value="' + escapeHtml(ind.name) + '" placeholder="Indikator SPM..."></td>';

        if (isTarget){
          html += 
            '<td><input type="text" class="calc-inp ind-target-inp" value="' + escapeHtml(ind.target) + '" placeholder="Target (e.g. 100% / -)"></td>' +
            '<td><input type="text" class="ind-unit-inp" value="' + escapeHtml(ind.unit || 'Persen') + '"></td>';
        }

        html += 
            '<td>' +
              '<select class="calc-inp ind-score-sel">' +
                '<option value="1.0"' + (ind.score == 1.0 || ind.score === undefined ? ' selected' : '') + '>100% (Iya / Sesuai)</option>' +
                '<option value="0.5"' + (ind.score == 0.5 ? ' selected' : '') + '>50% (Tidak / Sebagian)</option>' +
              '</select>' +
            '</td>';

        if (indIdx === 0){
          html += 
            '<td rowspan="' + indCount + '" class="cell-formula bid-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#e2efda; color:#107c41;">100%</td>' +
            '<td rowspan="' + indCount + '"></td>';
        } else {
          html += 
            '<td style="text-align:center;"><button type="button" class="btn-del-ind-spm" data-bid-idx="' + bidIdx + '" data-ind-idx="' + indIdx + '" style="border:none; background:transparent; color:#94a3b8; cursor:pointer;" title="Hapus Indikator"><i class="fa fa-times"></i></button></td>';
        }

        html += '</tr>';
      });
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + rowCounter + '</td>' +
            '<td colspan="' + (isTarget ? 5 : 3) + '" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE() * ' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="wsSpmGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 9. Sheet 1.b.8.a (TPT) & 1.b.8.b (TK) (RKP vs RKPD)
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
        '<span style="font-style:italic;"><i class="fa fa-arrows-h"></i> Geser ke kanan untuk melihat kolom margin</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_b_8" style="min-width: 1520px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th>' +
            '<th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th><th class="excel-col-letter">I</th><th class="excel-col-letter">J</th>' +
            '<th class="excel-col-letter">K</th><th class="excel-col-letter">L</th><th class="excel-col-letter">M</th><th class="excel-col-letter">N</th><th class="excel-col-letter">O</th>' +
            '<th class="excel-col-letter">P</th><th class="excel-col-letter">Q</th><th class="excel-col-letter">R</th><th class="excel-col-letter">S</th><th class="excel-col-letter">T</th><th class="excel-col-letter">U</th><th class="excel-col-letter">V</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="3">1</th>' +
            '<th colspan="5" class="th-blue" style="font-size:13px;">RKP (Nasional)</th>' +
            '<th colspan="5" class="th-amber" style="font-size:13px;">RKPD (Daerah)</th>' +
            '<th colspan="3" class="th-green">Cek Target Realisasi</th>' +
            '<th colspan="3" class="th-green">Cek Target Tahun Berjalan</th>' +
            '<th colspan="3" class="th-green">Cek Gap Target</th>' +
            '<th rowspan="3" class="th-green" style="width:85px; white-space:nowrap;">Nilai Rata-rata (%)</th>' +
            '<th rowspan="3" class="th-green" style="width:65px; white-space:nowrap;">Bobot</th>' +
            '<th rowspan="3" class="th-green" style="width:95px; white-space:nowrap;">Keselarasan Terbobot</th>' +
          '</tr>' +
          '<tr>' +
            '<th rowspan="2" class="th-blue" style="width:200px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-blue">Nilai RKP</th>' +
            '<th rowspan="2" class="th-blue" style="width:65px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-amber" style="width:200px; white-space:nowrap;">Indikator Makro</th>' +
            '<th colspan="3" class="th-amber">Nilai RKPD</th>' +
            '<th rowspan="2" class="th-amber" style="width:65px; white-space:nowrap;">Satuan</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
            '<th rowspan="2" class="th-green" style="width:70px; white-space:nowrap;">Margin</th>' +
            '<th rowspan="2" class="th-green" style="width:75px; white-space:nowrap;">Keterangan</th>' +
            '<th rowspan="2" class="th-green" style="width:60px; white-space:nowrap;">Nilai</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-blue" style="width:65px;">Realisasi</th><th class="th-blue" style="width:65px;">Target</th><th class="th-blue" style="width:60px;">Gap</th>' +
            '<th class="th-amber" style="width:65px;">Realisasi</th><th class="th-amber" style="width:65px;">Target</th><th class="th-amber" style="width:60px;">Gap</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>' +
          '<tr class="ws-1b8-row" data-positive="0">' +
            '<td class="excel-row-num">4</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="number" step="0.01" class="calc-inp rkp-real" value="' + escapeHtml(rkp_real) + '"></td>' +
            '<td><input type="number" step="0.01" class="calc-inp rkp-tgt" value="' + escapeHtml(rkp_tgt) + '"></td>' +
            '<td class="cell-formula rkp-gap">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
            '<td><strong>' + indName + '</strong></td>' +
            '<td><input type="number" step="0.01" class="calc-inp rkpd-real" value="' + escapeHtml(rkpd_real) + '"></td>' +
            '<td><input type="number" step="0.01" class="calc-inp rkpd-tgt" value="' + escapeHtml(rkpd_tgt) + '"></td>' +
            '<td class="cell-formula rkpd-gap">0.00</td>' +
            '<td style="text-align:center; font-weight:600; color:#475569;">Persen</td>' +
            '<td class="cell-formula margin-real">0.0%</td>' +
            '<td class="cell-formula ket-real" style="font-size:11.5px;">100%</td>' +
            '<td class="cell-formula score-real" style="font-weight:700; color:#107c41;">100%</td>' +
            '<td class="cell-formula margin-tgt">0.0%</td>' +
            '<td class="cell-formula ket-tgt" style="font-size:11.5px;">100%</td>' +
            '<td class="cell-formula score-tgt" style="font-weight:700; color:#107c41;">100%</td>' +
            '<td class="cell-formula margin-gap">0.0%</td>' +
            '<td class="cell-formula ket-gap" style="font-size:11.5px;">100%</td>' +
            '<td class="cell-formula score-gap" style="font-weight:700; color:#107c41;">100%</td>' +
            '<td class="cell-formula row-avg" style="font-weight:800; background:#e2efda; color:#107c41;">100.0%</td>' +
            '<td style="text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula row-terbobot" style="font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
          '</tr>' +
        '</tbody>' +
      '</table>' +
      '</div>';

    return html;
  }

  // 10. Sheet 1.c.1 (Alokasi APBD untuk Prioritas Nasional / Major Project)
  function renderWs_1_c_1(d, maxBobot){
    d = d || {};
    var rows = d.rows || [
      { pn: 'PN 1 : Memperkuat Ketahanan Ekonomi', pp_mp: 'PP 1 : Peningkatan Ketersediaan Pangan', pd: 'Program Pengelolaan Pertanian & Pangan Daerah', pagu: '45.000.000.000', score: 1.0 },
      { pn: 'PN 3 : Meningkatkan Sumber Daya Manusia', pp_mp: 'PP 2 : Peningkatan Akses dan Mutu Pendidikan', pd: 'Program Pengelolaan Pendidikan Dasar dan Menengah', pagu: '120.000.000.000', score: 1.0 },
      { pn: 'PN 5 : Memperkuat Infrastruktur', pp_mp: 'MP 1 : Konektivitas dan Logistik Wilayah', pd: 'Program Penyelenggaraan Jalan dan Jembatan', pagu: '85.000.000.000', score: 1.0 }
    ];

    var html = 
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_1_c_1" style="min-width: 1200px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th><th class="excel-col-letter">F</th><th class="excel-col-letter">G</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-blue" style="width: 25%;">Prioritas Nasional (RKP)</th>' +
            '<th class="th-blue" style="width: 25%;">Program Prioritas (PP) / Major Project (MP)</th>' +
            '<th class="th-amber" style="width: 25%;">Dukungan Program Daerah (RKPD)</th>' +
            '<th class="th-amber" style="width: 15%;">Pagu Indikatif APBD (Rp)</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-1c1-row">' +
          '<td class="excel-row-num">' + (idx + 2) + '</td>' +
          '<td><input type="text" class="calc-inp pn-inp" value="' + escapeHtml(r.pn) + '" placeholder="Prioritas Nasional..."></td>' +
          '<td><input type="text" class="calc-inp pp-inp" value="' + escapeHtml(r.pp_mp) + '" placeholder="PP / Major Project..."></td>' +
          '<td><input type="text" class="calc-inp pd-inp" value="' + escapeHtml(r.pd) + '" placeholder="Program Daerah..."></td>' +
          '<td><input type="text" class="calc-inp pagu-inp" value="' + escapeHtml(r.pagu) + '" placeholder="Rp..."></td>' +
          '<td>' +
            '<select class="calc-inp score-sel">' +
              '<option value="1.0"' + (r.score == 1.0 || r.score === undefined ? ' selected' : '') + '>100% (Tersedia)</option>' +
              '<option value="0.5"' + (r.score == 0.5 ? ' selected' : '') + '>50% (Sebagian)</option>' +
              '<option value="0"' + (r.score == 0 ? ' selected' : '') + '>0% (Belum Tersedia)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-1c1-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + (rows.length + 2) + '</td>' +
            '<td colspan="4" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE() * ' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="ws1c1GrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
      '</table>' +
      '<button type="button" class="btn-excel-add-row" id="btnAdd1c1Row"><i class="fa fa-plus"></i> Tambah Alokasi Program APBD</button>' +
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
      '<table class="excel-grid-table" id="wsTable_3_a_1_a" style="min-width: 1100px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th><th class="excel-col-letter">F</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-green" style="width: 25%;">Bidang Program Prioritas</th>' +
            '<th class="th-amber" style="width: 30%;">Program Prioritas Daerah (RKPD)</th>' +
            '<th class="th-blue" style="width: 25%;">OPD Penanggungjawab</th>' +
            '<th class="th-green" style="width: 10%;">Nilai Keselarasan</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-3a1a-row">' +
          '<td class="excel-row-num">' + (idx + 2) + '</td>' +
          '<td><input type="text" class="calc-inp bidang-inp" value="' + escapeHtml(r.bidang) + '" placeholder="Bidang Urusan..."></td>' +
          '<td><input type="text" class="calc-inp prog-inp" value="' + escapeHtml(r.prog) + '" placeholder="Program Prioritas..."></td>' +
          '<td><input type="text" class="calc-inp opd-inp" value="' + escapeHtml(r.opd) + '" placeholder="Nama Perangkat Daerah (jika tidak ada isi -)..."></td>' +
          '<td class="cell-formula row-score" style="text-align:center; font-weight:700; color:#107c41;">100%</td>' +
          '<td class="cell-formula row-terbobot" style="text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-3a1a-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + (rows.length + 2) + '</td>' +
            '<td colspan="4" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE(E:E)</td>' +
            '<td class="cell-formula" id="ws3a1aGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
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
        '<span style="font-style:italic;"><i class="fa fa-arrows-h"></i> Geser ke kanan untuk melihat perbandingan target & margin</span>' +
      '</div>' +
      '<div style="overflow-x:auto;">' +
      '<table class="excel-grid-table" id="wsTable_3_a_1_b" style="min-width: 1540px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th>' +
            '<th class="excel-col-letter">F</th><th class="excel-col-letter">G</th><th class="excel-col-letter">H</th><th class="excel-col-letter">I</th><th class="excel-col-letter">J</th>' +
            '<th class="excel-col-letter">K</th><th class="excel-col-letter">L</th><th class="excel-col-letter">M</th><th class="excel-col-letter">N</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num" rowspan="2">1</th>' +
            '<th colspan="3" class="th-amber" style="font-size:13px;">RPJMD / RKPD (Daerah)</th>' +
            '<th colspan="4" class="th-blue" style="font-size:13px;">Renstra / Renja OPD</th>' +
            '<th rowspan="2" class="th-gray" style="width: 100px; white-space:nowrap;">Ekspektasi</th>' +
            '<th colspan="3" class="th-green">Cek Target</th>' +
            '<th rowspan="2" class="th-green" style="width: 65px; white-space:nowrap;">Bobot</th>' +
            '<th rowspan="2" class="th-green" style="width: 95px; white-space:nowrap;">Keselarasan Terbobot</th>' +
            '<th rowspan="2" class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="th-amber" style="width: 220px; white-space:nowrap;">Indikator Kinerja</th>' +
            '<th class="th-amber" style="width: 70px; white-space:nowrap;">Target</th>' +
            '<th class="th-amber" style="width: 65px; white-space:nowrap;">Satuan</th>' +
            '<th class="th-blue" style="width: 160px; white-space:nowrap;">Nama OPD</th>' +
            '<th class="th-blue" style="width: 220px; white-space:nowrap;">IKU OPD</th>' +
            '<th class="th-blue" style="width: 70px; white-space:nowrap;">Target</th>' +
            '<th class="th-blue" style="width: 65px; white-space:nowrap;">Satuan</th>' +
            '<th class="th-green" style="width: 70px; white-space:nowrap;">Margin</th>' +
            '<th class="th-green" style="width: 75px; white-space:nowrap;">Keterangan</th>' +
            '<th class="th-green" style="width: 60px; white-space:nowrap;">Nilai</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-3a1b-row">' +
          '<td class="excel-row-num">' + (idx + 3) + '</td>' +
          '<td><input type="text" class="calc-inp ind-daerah" value="' + escapeHtml(r.ind_daerah) + '" placeholder="Indikator Daerah..."></td>' +
          '<td><input type="number" step="0.01" class="calc-inp tgt-daerah" value="' + escapeHtml(r.target_daerah) + '"></td>' +
          '<td><input type="text" class="calc-inp unit-daerah" value="' + escapeHtml(r.unit_daerah) + '"></td>' +
          '<td><input type="text" class="calc-inp opd-name" value="' + escapeHtml(r.opd) + '" placeholder="OPD..."></td>' +
          '<td><input type="text" class="calc-inp iku-opd" value="' + escapeHtml(r.iku_opd) + '" placeholder="IKU OPD..."></td>' +
          '<td><input type="number" step="0.01" class="calc-inp tgt-opd" value="' + escapeHtml(r.target_opd) + '"></td>' +
          '<td><input type="text" class="calc-inp unit-opd" value="' + escapeHtml(r.unit_opd) + '"></td>' +
          '<td>' +
            '<select class="calc-inp ekspektasi-sel">' +
              '<option value="Besar"' + (r.ekspektasi === 'Besar' ? ' selected' : '') + '>Besar (Makin Besar Baik)</option>' +
              '<option value="Kecil"' + (r.ekspektasi === 'Kecil' ? ' selected' : '') + '>Kecil (Makin Kecil Baik)</option>' +
            '</select>' +
          '</td>' +
          '<td class="cell-formula margin-cell">0.0%</td>' +
          '<td class="cell-formula ket-cell" style="font-size:11.5px;">100%</td>' +
          '<td class="cell-formula score-cell" style="font-weight:700; color:#107c41;">100%</td>' +
          '<td style="text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(maxBobot) + '</td>' +
          '<td class="cell-formula row-terbobot" style="font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-3a1b-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + (rows.length + 3) + '</td>' +
            '<td colspan="12" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE(N:N)</td>' +
            '<td class="cell-formula" id="ws3a1bGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
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
      '<table class="excel-grid-table" id="wsTable_General" style="min-width: 1060px;">' +
        '<thead>' +
          '<tr>' +
            '<th class="excel-col-letter"></th>' +
            '<th class="excel-col-letter">A</th><th class="excel-col-letter">B</th><th class="excel-col-letter">C</th><th class="excel-col-letter">D</th><th class="excel-col-letter">E</th>' +
          '</tr>' +
          '<tr>' +
            '<th class="excel-row-num">1</th>' +
            '<th class="th-green" style="width: 42%;">Parameter / Kriteria Pemenuhan Indikator (Pedoman IPPD)</th>' +
            '<th class="th-blue" style="width: 24%;">Tingkat Pemenuhan</th>' +
            '<th class="th-amber" style="width: 20%;">Catatan / Justifikasi</th>' +
            '<th class="th-green" style="width: 10%;">Keselarasan Terbobot</th>' +
            '<th class="th-gray" style="width: 4%;">Aksi</th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    rows.forEach(function(r, idx){
      html += 
        '<tr class="ws-gen-row">' +
          '<td class="excel-row-num">' + (idx + 2) + '</td>' +
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
          '<td class="cell-formula row-terbobot" style="text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot * (r.score || 1.0)) + '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-gen-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Kriteria"><i class="fa fa-times"></i></button></td>' +
        '</tr>';
    });

    html += 
        '</tbody>' +
        '<tfoot>' +
          '<tr style="background:#f8fafc; font-weight:800;">' +
            '<td class="excel-row-num">' + (rows.length + 2) + '</td>' +
            '<td colspan="3" style="text-align:right; padding-right:14px; font-size:13px;">RATA-RATA TOTAL KESELARASAN TERBOBOT =AVERAGE() * ' + numFmt(maxBobot) + '</td>' +
            '<td class="cell-formula" id="wsGenGrandTerbobot" style="text-align:center; font-size:14.5px; background:#d1fae5; color:#065f46;">' + numFmt(maxBobot) + '</td>' +
            '<td></td>' +
          '</tr>' +
        '</tfoot>' +
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
        row.querySelector(".mn-gap").textContent = numFmt(mnGap);
        row.querySelector(".md-gap").textContent = numFmt(mdGap);

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

        row.querySelector(".margin-base").textContent = marginB.toFixed(1) + "%";
        row.querySelector(".score-base").textContent = scoreB + "%";
        row.querySelector(".margin-end").textContent = marginE.toFixed(1) + "%";
        row.querySelector(".score-end").textContent = scoreE + "%";
        row.querySelector(".margin-gap").textContent = marginGap.toFixed(1) + "%";
        row.querySelector(".score-gap").textContent = scoreG + "%";
        row.querySelector(".row-avg").textContent = rowAvg.toFixed(1) + "%";
        row.querySelector(".row-terbobot").textContent = numFmt(rowTerbobot);

        sumAvg += rowAvg;
      });

      var grandAvg = rows.length > 0 ? (sumAvg / rows.length) : 100;
      computedFinalScore = (grandAvg / 100) * maxBobot;
      var elGrandAvg = document.getElementById("ws1a1aGrandAvg");
      var elGrandTerbobot = document.getElementById("ws1a1aGrandTerbobot");
      if (elGrandAvg) elGrandAvg.textContent = grandAvg.toFixed(1) + "%";
      if (elGrandTerbobot) elGrandTerbobot.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(V4:V6) -> Keselarasan: " + grandAvg.toFixed(1) + "% (" + numFmt(computedFinalScore) + ")";
    }

    // 2. Sheet 1.a.1.b & 1.a.1.d Persandingan
    else if (code === '1.a.1.b' || code === '1.a.1.d'){
      var sel = document.getElementById("wsSelectPersandingan");
      var isAda = sel ? (sel.value === 'Ada') : true;
      computedFinalScore = isAda ? maxBobot : 0;
      var elRes = document.getElementById("wsPersandinganResult");
      if (elRes) elRes.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = '=IF(B2="Ada", ' + numFmt(maxBobot) + ', 0) -> ' + (isAda ? 'Tersedia (100%)' : 'Belum Ada (0%)');
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

      computedFinalScore = pnCount > 0 ? (allTerbobotSum / pnCount) : maxBobot;
      var elGrand = document.getElementById("ws1a1cGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(G:G) -> Skor Akhir Keselarasan: " + numFmt(computedFinalScore);
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
      excelFxContent.textContent = "=AVERAGE(H:H) -> Capaian Program PN 1: " + numFmt(computedFinalScore);
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
      excelFxContent.textContent = "=AVERAGE(I:I) -> Capaian Dukungan PN: " + numFmt(computedFinalScore);
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
        row.querySelector(".mn-gap").textContent = numFmt(mnGap);
        row.querySelector(".md-gap").textContent = numFmt(mdGap);

        var marginB = (mnB !== 0) ? (mdB <= mnB ? 0 : (Math.abs(mdB - mnB)/Math.abs(mnB))*100) : 0;
        var marginE = (mnE !== 0) ? (mdE <= mnE ? 0 : (Math.abs(mdE - mnE)/Math.abs(mnE))*100) : 0;
        var marginGap = (mnGap !== 0) ? ((Math.abs(mdGap) - Math.abs(mnGap))/Math.abs(mnGap))*100 : 0;

        var scoreB = calcMarginScore(marginB);
        var scoreE = calcMarginScore(marginE);
        var scoreG = calcMarginScore(marginGap);
        var rowAvg = (scoreB + scoreE + scoreG) / 3;
        computedFinalScore = (rowAvg / 100) * maxBobot;

        row.querySelector(".margin-base").textContent = marginB.toFixed(1) + "%";
        row.querySelector(".score-base").textContent = scoreB + "%";
        row.querySelector(".margin-end").textContent = marginE.toFixed(1) + "%";
        row.querySelector(".score-end").textContent = scoreE + "%";
        row.querySelector(".margin-gap").textContent = marginGap.toFixed(1) + "%";
        row.querySelector(".score-gap").textContent = scoreG + "%";
        row.querySelector(".row-avg").textContent = rowAvg.toFixed(1) + "%";
        row.querySelector(".row-terbobot").textContent = numFmt(computedFinalScore);

        excelFxContent.textContent = "=AVERAGE(M4,P4,S4)*Bobot -> Rata-rata: " + rowAvg.toFixed(1) + "% (" + numFmt(computedFinalScore) + ")";
      }
    }

    // 7. Sheet 1.a.4 (Major Project)
    else if (code === '1.a.4'){
      var mpGroups = {};
      document.querySelectorAll("#wsTable_1_a_4 .ws-mp-row").forEach(function(row){
        var mpIdx = row.getAttribute("data-mp-idx");
        if (!mpGroups[mpIdx]) mpGroups[mpIdx] = [];
        var scoreSel = row.querySelector(".pd-score-sel");
        mpGroups[mpIdx].push(scoreSel ? parseFloat(scoreSel.value) : 1.0);
      });

      var allMpSum = 0;
      var mpCount = 0;
      Object.keys(mpGroups).forEach(function(mpIdx){
        var scores = mpGroups[mpIdx];
        var avg = scores.reduce(function(a,b){return a+b;},0) / scores.length;
        var terbobot = avg * maxBobot;
        allMpSum += terbobot;
        mpCount++;

        var firstRow = document.querySelector('#wsTable_1_a_4 .ws-mp-row[data-mp-idx="' + mpIdx + '"]');
        if (firstRow){
          var avgCell = firstRow.querySelector(".mp-avg");
          var terbCell = firstRow.querySelector(".mp-terbobot");
          if (avgCell) avgCell.textContent = (avg * 100).toFixed(0) + "%";
          if (terbCell) terbCell.textContent = numFmt(terbobot);
        }
      });

      computedFinalScore = mpCount > 0 ? (allMpSum / mpCount) : maxBobot;
      var elGrand = document.getElementById("ws1a4GrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(E:E) -> Capaian Major Project: " + numFmt(computedFinalScore);
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

      var grandAvg = bidCount > 0 ? (allBidSum / bidCount) : 1.0;
      computedFinalScore = grandAvg * maxBobot;
      var elGrand = document.getElementById("wsSpmGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(Bidang) * " + numFmt(maxBobot) + " -> " + numFmt(computedFinalScore);
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
        row.querySelector(".rkp-gap").textContent = numFmt(rGap);
        row.querySelector(".rkpd-gap").textContent = numFmt(dGap);

        var marginReal = (rReal !== 0) ? (dReal <= rReal ? 0 : (Math.abs(dReal - rReal)/Math.abs(rReal))*100) : 0;
        var marginTgt  = (rTgt !== 0) ? (dTgt <= rTgt ? 0 : (Math.abs(dTgt - rTgt)/Math.abs(rTgt))*100) : 0;
        var marginGap  = (rGap !== 0) ? ((Math.abs(dGap) - Math.abs(rGap))/Math.abs(rGap))*100 : 0;

        var scoreReal = calcMarginScore(marginReal);
        var scoreTgt  = calcMarginScore(marginTgt);
        var scoreGap  = calcMarginScore(marginGap);
        var rowAvg = (scoreReal + scoreTgt + scoreGap) / 3;
        computedFinalScore = (rowAvg / 100) * maxBobot;

        row.querySelector(".margin-real").textContent = marginReal.toFixed(1) + "%";
        row.querySelector(".score-real").textContent = scoreReal + "%";
        row.querySelector(".margin-tgt").textContent = marginTgt.toFixed(1) + "%";
        row.querySelector(".score-tgt").textContent = scoreTgt + "%";
        row.querySelector(".margin-gap").textContent = marginGap.toFixed(1) + "%";
        row.querySelector(".score-gap").textContent = scoreGap + "%";
        row.querySelector(".row-avg").textContent = rowAvg.toFixed(1) + "%";
        row.querySelector(".row-terbobot").textContent = numFmt(computedFinalScore);

        excelFxContent.textContent = "=AVERAGE(Real,Tgt,Gap)*Bobot -> RKP-RKPD: " + rowAvg.toFixed(1) + "% (" + numFmt(computedFinalScore) + ")";
      }
    }

    // 10. Sheet 1.c.1 (Alokasi APBD)
    else if (code === '1.c.1'){
      var rows = document.querySelectorAll("#wsTable_1_c_1 .ws-1c1-row");
      var sumScore = 0;
      rows.forEach(function(r){
        var sel = r.querySelector(".score-sel");
        sumScore += sel ? parseFloat(sel.value) : 1.0;
      });
      var avgRatio = rows.length > 0 ? (sumScore / rows.length) : 1.0;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("ws1c1GrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(F:F)*10.00 -> Alokasi APBD RKP: " + numFmt(computedFinalScore);
    }

    // 11. Sheet 3.a.1.a (OPD Penanggungjawab)
    else if (code === '3.a.1.a'){
      var rows = document.querySelectorAll("#wsTable_3_a_1_a .ws-3a1a-row");
      var sumScore = 0;
      rows.forEach(function(r){
        var opdVal = r.querySelector(".opd-inp").value.trim();
        var isFilled = opdVal !== '' && opdVal !== '-';
        var rowScoreRatio = isFilled ? 1.0 : (opdVal === '-' ? 0.5 : 0.0);
        r.querySelector(".row-score").textContent = (rowScoreRatio * 100) + "%";
        r.querySelector(".row-terbobot").textContent = numFmt(rowScoreRatio * maxBobot);
        sumScore += rowScoreRatio;
      });
      var avgRatio = rows.length > 0 ? (sumScore / rows.length) : 1.0;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("ws3a1aGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = '=IF(C4<>"-", 100%, 0%) -> Rata-rata Terbobot: ' + numFmt(computedFinalScore);
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

        r.querySelector(".margin-cell").textContent = margin.toFixed(1) + "%";
        r.querySelector(".ket-cell").textContent = scorePct + "%";
        r.querySelector(".score-cell").textContent = scorePct + "%";
        r.querySelector(".row-terbobot").textContent = numFmt(rowTerb);
        sumTerb += rowTerb;
      });

      computedFinalScore = rows.length > 0 ? (sumTerb / rows.length) : maxBobot;
      var elGrand = document.getElementById("ws3a1bGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(N:N) -> Keterhubungan IKU OPD: " + numFmt(computedFinalScore);
    }

    // 13. General / Pilar 2 Kualitas Perencanaan
    else {
      var rows = document.querySelectorAll("#wsTable_General .ws-gen-row");
      var sumRatio = 0;
      rows.forEach(function(r){
        var sel = r.querySelector(".score-sel");
        var ratio = sel ? parseFloat(sel.value) : 1.0;
        r.querySelector(".row-terbobot").textContent = numFmt(ratio * maxBobot);
        sumRatio += ratio;
      });
      var avgRatio = rows.length > 0 ? (sumRatio / rows.length) : 1.0;
      computedFinalScore = avgRatio * maxBobot;
      var elGrand = document.getElementById("wsGenGrandTerbobot");
      if (elGrand) elGrand.textContent = numFmt(computedFinalScore);
      excelFxContent.textContent = "=AVERAGE(Criteria) * " + numFmt(maxBobot) + " -> " + numFmt(computedFinalScore);
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
    // 7. Sheet 1.a.4 (Major Project)
    else if (code === '1.a.4'){
      var mpList = [];
      var curMp = null;
      var lastMpIdx = null;

      document.querySelectorAll("#wsTable_1_a_4 .ws-mp-row").forEach(function(row){
        var mpIdx = row.getAttribute("data-mp-idx");
        var mpInp = row.querySelector(".mp-title-inp");
        var pdInp = row.querySelector(".pd-title-inp");
        var scoreSel = row.querySelector(".pd-score-sel");

        if (mpIdx !== lastMpIdx){
          if (curMp) mpList.push(curMp);
          curMp = {
            mp_title: mpInp ? mpInp.value.trim() : '',
            pds: []
          };
          lastMpIdx = mpIdx;
        }

        if (curMp && pdInp){
          curMp.pds.push({
            title: pdInp.value.trim(),
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0
          });
        }
      });
      if (curMp) mpList.push(curMp);
      json.mp_list = mpList;
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
    else if (code === '1.b.8.a' || code === '1.b.8.b'){
      var row = document.querySelector("#wsTable_1_b_8 .ws-1b8-row");
      if (row){
        json.rkp_real = row.querySelector(".rkp-real").value.trim();
        json.rkp_tgt  = row.querySelector(".rkp-tgt").value.trim();
        json.rkpd_real= row.querySelector(".rkpd-real").value.trim();
        json.rkpd_tgt = row.querySelector(".rkpd-tgt").value.trim();
      }
    }
    // 10. Sheet 1.c.1
    else if (code === '1.c.1'){
      var rows = [];
      document.querySelectorAll("#wsTable_1_c_1 .ws-1c1-row").forEach(function(r){
        var pnInp = r.querySelector(".pn-inp");
        var ppInp = r.querySelector(".pp-inp");
        var pdInp = r.querySelector(".pd-inp");
        var paguInp = r.querySelector(".pagu-inp");
        var scoreSel = r.querySelector(".score-sel");
        if (pnInp || pdInp){
          rows.push({
            pn: pnInp ? pnInp.value.trim() : '',
            pp_mp: ppInp ? ppInp.value.trim() : '',
            pd: pdInp ? pdInp.value.trim() : '',
            pagu: paguInp ? paguInp.value.trim() : '',
            score: scoreSel ? parseFloat(scoreSel.value) : 1.0
          });
        }
      });
      json.rows = rows;
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

    // Render Dynamic Worksheet
    modalDynamicWorksheet.innerHTML = renderDynamicWorksheet(code, item.bobot, detailObj);
    
    // Initial Calculation Trigger
    updateModalWorksheetScore();

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

  // Quick Preset Buttons in Modal
  document.querySelectorAll(".excel-preset-btn").forEach(function(btn){
    btn.addEventListener("click", function(){
      var ratio = parseFloat(this.getAttribute("data-ratio"));
      var max = parseFloat(modalBobotMaks.value) || 0;
      var calc = max * ratio;
      var strVal = calc.toFixed(3).replace(/0+$/, "").replace(/\.$/, "");
      modalBobotInput.value = strVal;
      modalCalcDisplay.textContent = numFmt(strVal);
    });
  });

  modalBobotInput.addEventListener("input", function(){
    modalCalcDisplay.textContent = numFmt(modalBobotInput.value);
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

  function renumberExcelSheetRows(table){
    if (!table) return;
    var theadRows = table.querySelectorAll("thead tr");
    var startNum = theadRows.length + 1;
    var curNum = startNum;
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
          '<td rowspan="1" class="cell-formula pn-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(modalBobotMaks.value) + '</td>' +
          '<td rowspan="1" class="cell-formula pn-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
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
          '<td rowspan="1" class="cell-formula pp-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(modalBobotMaks.value) + '</td>' +
          '<td rowspan="1" class="cell-formula pp-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
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
          '<td rowspan="1" class="cell-formula pp-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
          '<td rowspan="1" style="vertical-align:middle; text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(modalBobotMaks.value) + '</td>' +
          '<td rowspan="1" class="cell-formula pp-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
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
          '<td rowspan="1" class="cell-formula mp-avg" style="vertical-align:middle; text-align:center; font-weight:700; background:#f0fdf4; color:#107c41;">100%</td>' +
          '<td rowspan="1" class="cell-formula mp-terbobot" style="vertical-align:middle; text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
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

    // --- 1.c.1: Add / Del Row ---
    var btnAdd1c1 = target.closest("#btnAdd1c1Row");
    if (btnAdd1c1){
      var tbody1c1 = document.querySelector("#wsTable_1_c_1 tbody");
      if (tbody1c1){
        var newTr = document.createElement("tr");
        newTr.className = "ws-1c1-row";
        newTr.innerHTML = 
          '<td class="excel-row-num">+</td>' +
          '<td><input type="text" class="calc-inp pn-inp" placeholder="Prioritas Nasional..."></td>' +
          '<td><input type="text" class="calc-inp pp-inp" placeholder="PP / Major Project..."></td>' +
          '<td><input type="text" class="calc-inp pd-inp" placeholder="Program Daerah..."></td>' +
          '<td><input type="text" class="calc-inp pagu-inp" placeholder="Rp..."></td>' +
          '<td>' +
            '<select class="calc-inp score-sel">' +
              '<option value="1.0">100% (Tersedia)</option>' +
              '<option value="0.5">50% (Sebagian)</option>' +
              '<option value="0">0% (Belum Tersedia)</option>' +
            '</select>' +
          '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-1c1-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Baris"><i class="fa fa-times"></i></button></td>';
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
          '<td class="cell-formula row-terbobot" style="text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
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
          '<td><input type="number" step="0.01" class="calc-inp tgt-daerah" value="100"></td>' +
          '<td><input type="text" class="calc-inp unit-daerah" value="Persen"></td>' +
          '<td><input type="text" class="calc-inp opd-name" placeholder="OPD..."></td>' +
          '<td><input type="text" class="calc-inp iku-opd" placeholder="IKU OPD..."></td>' +
          '<td><input type="number" step="0.01" class="calc-inp tgt-opd" value="100"></td>' +
          '<td><input type="text" class="calc-inp unit-opd" value="Persen"></td>' +
          '<td>' +
            '<select class="calc-inp ekspektasi-sel">' +
              '<option value="Besar">Besar (Makin Besar Baik)</option>' +
              '<option value="Kecil">Kecil (Makin Kecil Baik)</option>' +
            '</select>' +
          '</td>' +
          '<td class="cell-formula margin-cell">0.0%</td>' +
          '<td class="cell-formula ket-cell" style="font-size:11.5px;">100%</td>' +
          '<td class="cell-formula score-cell" style="font-weight:700; color:#107c41;">100%</td>' +
          '<td style="text-align:center; font-family:\'Roboto Mono\'; font-weight:700;">' + numFmt(modalBobotMaks.value) + '</td>' +
          '<td class="cell-formula row-terbobot" style="font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
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
          '<td class="cell-formula row-terbobot" style="text-align:center; font-weight:800; background:#d1fae5; color:#065f46;">' + numFmt(modalBobotMaks.value) + '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-del-gen-row" style="border:none; background:transparent; color:#ef4444; cursor:pointer;" title="Hapus Kriteria"><i class="fa fa-times"></i></button></td>';
        tbodyGen.appendChild(newTr);
        updateModalWorksheetScore();
        renumberExcelSheetRows(document.getElementById("wsTable_General"));
      }
      return;
    }

    // Generic Delete Row (for 1c1, 3a1a, 3a1b, gen)
    var delGeneric = target.closest(".btn-del-1c1-row, .btn-del-3a1a-row, .btn-del-3a1b-row, .btn-del-gen-row");
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

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape" && modalDetail.classList.contains("open")){
      closeDetailModal();
    }
    if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S') && modalDetail.classList.contains("open")){
      e.preventDefault();
      saveModalDetail();
    }
  });

  // Initial Boot
  buildItemMap();
  renderTable();
})();
</script>

