<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * View E-LKPJ: BAB 2 (Pengelolaan Keuangan Daerah)
 * Tabel 2.1 s/d Tabel 2.3
 * Template Notika - Selaras 100% dengan Desain BAB 1 & IPPD
 */
$this->load->view('Daerah/sidebar');
$this->load->view('Daerah/Cssumum');

$tahunAktif = isset($TahunAktif) ? (int)$TahunAktif : 2026;
$filterInstansi = isset($FilterInstansi) ? (int)$FilterInstansi : 1;
$activeTabel = isset($ActiveTabel) ? $ActiveTabel : '2.1';
$metaTabel = isset($MetaTabel) ? $MetaTabel : [];
$daftarTabel = isset($DaftarTabel) ? $DaftarTabel : [];

$itemsTabel2_1 = isset($ItemsTabel2_1) ? $ItemsTabel2_1 : [];
$itemsTabel2_2 = isset($ItemsTabel2_2) ? $ItemsTabel2_2 : [];
$itemsTabel2_3 = isset($ItemsTabel2_3) ? $ItemsTabel2_3 : [];

$summary2_1 = isset($SummaryTabel2_1) ? $SummaryTabel2_1 : [
    'total_sebelum' => 1800417023124.00,
    'total_sesudah' => 1750518897402.00,
    'total_selisih' => -49898125722.00,
    'total_persen' => -2.77,
    'sumber' => 'BAPENDA Tahun 2026, Unaudited'
];
$summary2_2 = isset($SummaryTabel2_2) ? $SummaryTabel2_2 : [
    'total_sebelum' => 1852936993777.00,
    'total_sesudah' => 1854757572766.00,
    'total_selisih' => 1820578989.00,
    'total_persen' => 0.10,
    'sumber' => 'BKAD Tahun 2026, Unaudited'
];
$summary2_3 = isset($SummaryTabel2_3) ? $SummaryTabel2_3 : [
    'penerimaan_sesudah' => 104238675364.00,
    'pengeluaran_sesudah' => 0.00,
    'netto_sesudah' => 0.00,
    'silpa_sesudah' => 104238675364.00,
    'sumber' => 'BKAD Tahun 2026, Unaudited'
];

// Helper format uang LKPJ (kurung bila minus)
function formatUangLKPJ($nilai, $showRp = true) {
    $val = (float)$nilai;
    $prefix = $showRp ? 'Rp ' : '';
    if ($val < 0) {
        return '(' . $prefix . number_format(abs($val), 2, ',', '.') . ')';
    }
    return $prefix . number_format($val, 2, ',', '.');
}

// Helper format persen LKPJ (kurung bila minus)
function formatPersenLKPJ($persen, $suffix = '%') {
    $val = (float)$persen;
    if ($val < 0) {
        return '(' . number_format(abs($val), 2, ',', '.') . ')' . $suffix;
    }
    return number_format($val, 2, ',', '.') . $suffix;
}
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
:root {
  --ui-primary: #00c292;
  --ui-primary-hover: #00a87e;
  --ui-primary-light: #e8f8f5;
  --ui-primary-border: #b2dfdb;
  --ui-primary-text: #007a5a;
  
  --ui-table-header: #00c292;
  --ui-table-header-hover: #00a87e;
  --ui-table-title: #007a5a;
  --ui-table-stripe: #f2faf7;
  --ui-table-hover: #dcf5ec;
  --ui-table-border: #d4ece5;
  
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
  --shadow-hover: 0 10px 25px -5px rgba(15,23,42,0.08), 0 8px 10px -6px rgba(15,23,42,0.05);
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
.page-header-box {
  margin-bottom: 20px;
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
}

/* Table Switcher Header Card */
.switcher-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  padding: 20px 24px;
  margin-bottom: 24px;
  position: relative;
  overflow: hidden;
}
.switcher-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #00c292 0%, #cf7e2f 50%, #2563eb 100%);
}

.switcher-top-row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.switcher-label-group {
  display: flex;
  align-items: center;
  gap: 12px;
}
.switcher-icon-box {
  width: 44px;
  height: 44px;
  border-radius: var(--radius-md);
  background: #e8f8f5;
  color: #00c292;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  border: 1px solid #b2dfdb;
}
.switcher-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--ui-dark);
  margin: 0;
}
.switcher-desc {
  font-size: 12.5px;
  color: var(--ui-text-muted);
  margin: 2px 0 0 0;
}

.switcher-controls {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
}

.select-tabel-custom {
  min-width: 320px;
  max-width: 480px;
  font-weight: 600;
  color: #0f172a;
  border: 1.5px solid #cbd5e1;
  border-radius: var(--radius-md);
  padding: 9px 14px;
  font-size: 13.5px;
  background-color: #f8fafc;
  outline: none;
  transition: all 0.2s;
  cursor: pointer;
}
.select-tabel-custom:focus {
  border-color: #00c292;
  background-color: #fff;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

.btn-nav-tabel {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 14px;
  border-radius: var(--radius-md);
  font-size: 13px;
  font-weight: 600;
  border: 1px solid var(--ui-border);
  background: #fff;
  color: var(--ui-text-main);
  cursor: pointer;
  transition: all 0.15s ease;
  text-decoration: none;
}
.btn-nav-tabel:hover {
  background: #f1f5f9;
  color: var(--ui-primary-text);
  border-color: #cbd5e1;
}

/* Quick Jump Pill Carousel */
.quick-pills-wrapper {
  border-top: 1px solid var(--ui-border-light);
  padding-top: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  overflow-x: auto;
  scrollbar-width: thin;
  padding-bottom: 4px;
}
.quick-pill-label {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--ui-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  white-space: nowrap;
  margin-right: 4px;
}
.quick-pill {
  padding: 5px 14px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  color: #475569;
  background: #f1f5f9;
  border: 1px solid transparent;
  white-space: nowrap;
  text-decoration: none;
  transition: all 0.15s ease;
}
.quick-pill:hover {
  background: #e2e8f0;
  color: #0f172a;
}
.quick-pill.active {
  background: #00c292;
  color: #ffffff;
  font-weight: 700;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.35);
}

/* Stat Summary Cards */
.stat-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-bottom: 24px;
}
.stat-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  padding: 16px 20px;
  box-shadow: var(--shadow-card);
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-hover);
}
.stat-info .stat-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--ui-text-muted);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin-bottom: 4px;
}
.stat-info .stat-value {
  font-size: 20px;
  font-weight: 800;
  color: var(--ui-dark);
  line-height: 1.2;
  font-family: 'Roboto Mono', monospace;
}
.stat-icon {
  width: 46px;
  height: 46px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}
.stat-icon.icon-teal { background: var(--ui-primary-light); color: var(--ui-primary); }
.stat-icon.icon-amber { background: #fff7ed; color: #cf7e2f; }
.stat-icon.icon-blue { background: var(--ui-blue-light); color: var(--ui-blue); }
.stat-icon.icon-purple { background: #f5f3ff; color: #8b5cf6; }
.stat-icon.icon-red { background: var(--ui-red-light); color: var(--ui-red); }
.stat-icon.icon-green { background: var(--ui-green-light); color: var(--ui-green); }

/* Table Container Box */
.table-card {
  background: #ffffff;
  border-radius: var(--radius-lg);
  border: 1px solid var(--ui-border);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  margin-bottom: 30px;
}

.table-toolbar {
  padding: 16px 20px;
  background: #ffffff;
  border-bottom: 1px solid var(--ui-border);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}
.toolbar-left, .toolbar-right {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
}

.search-input-box {
  position: relative;
  min-width: 240px;
}
.search-input-box i {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--ui-text-muted);
  font-size: 13px;
}
.search-input-box input {
  width: 100%;
  padding: 8px 12px 8px 34px;
  border: 1px solid var(--ui-border);
  border-radius: var(--radius-md);
  font-size: 13px;
  background: #f8fafc;
  outline: none;
  transition: all 0.2s;
}
.search-input-box input:focus {
  border-color: var(--ui-primary);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}

/* Action Buttons */
.btn-ui {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  font-size: 13px;
  font-weight: 600;
  border-radius: var(--radius-md);
  border: none;
  cursor: pointer;
  transition: all 0.15s ease;
  text-decoration: none;
}
.btn-ui-primary,
.btn-ui-notika {
  background: #00c292;
  color: #fff;
}
.btn-ui-primary:hover,
.btn-ui-notika:hover {
  background: #00a87e;
  box-shadow: 0 4px 12px rgba(0, 194, 146, 0.35);
  color: #fff;
}
.btn-ui-outline {
  background: #fff;
  border: 1px solid var(--ui-border);
  color: var(--ui-text-main);
}
.btn-ui-outline:hover {
  background: #f1f5f9;
  border-color: #00c292;
  color: #007a5a;
}

/* Document Title Header over Table */
.doc-table-header-banner {
  padding: 24px 24px 16px;
  text-align: center;
  background: #ffffff;
  border-bottom: 2px solid #e8f8f5;
}
.doc-table-title {
  font-size: 19px;
  font-weight: 800;
  color: #007a5a;
  margin: 0 0 6px 0;
  letter-spacing: -0.01em;
}
.doc-table-subtitle {
  font-size: 13px;
  color: var(--ui-text-muted);
  margin: 0;
}

/* Table Style - Notika Green Theme */
.table-responsive-notika {
  width: 100%;
  overflow-x: auto;
}
.table-custom-notika {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 13.5px;
}
.table-custom-notika thead th {
  background: linear-gradient(135deg, #00c292 0%, #00a87e 100%) !important;
  color: #ffffff !important;
  font-weight: 700;
  padding: 12px 14px;
  border: 1px solid rgba(255, 255, 255, 0.25) !important;
  vertical-align: middle;
  text-align: center;
  letter-spacing: 0.02em;
}
.table-custom-notika tbody tr {
  transition: background-color 0.15s ease;
}
.table-custom-notika tbody tr:nth-child(even) {
  background-color: #ffffff;
}
.table-custom-notika tbody tr:nth-child(odd) {
  background-color: #f2faf7;
}
.table-custom-notika tbody tr:hover {
  background-color: #dcf5ec !important;
}
.table-custom-notika tbody td {
  padding: 10px 14px;
  border: 1px solid #d4ece5;
  color: #1e293b;
  vertical-align: middle;
}
.table-custom-notika tbody td.td-center {
  text-align: center;
}
.table-custom-notika tbody td.td-right {
  text-align: right;
  font-family: 'Roboto Mono', monospace;
  font-size: 13px;
  font-weight: 600;
}
.table-custom-notika tfoot th {
  background-color: #eef9f5 !important;
  color: #007a5a !important;
  font-weight: 800;
  font-size: 14px;
  padding: 13px 14px;
  border-top: 2.5px solid #00c292 !important;
  border-bottom: 2.5px solid #00c292 !important;
}
.table-custom-notika tfoot th.th-total-label {
  text-align: left;
  padding-left: 20px;
  font-size: 14px;
  color: #007a5a !important;
  letter-spacing: 0.02em;
}
.table-custom-notika tfoot th.th-total-num {
  text-align: right;
  font-family: 'Roboto Mono', monospace;
  font-size: 13.5px;
  color: #007a5a !important;
}
.table-custom-notika tfoot th.th-total-center {
  text-align: center;
  font-family: 'Roboto Mono', monospace;
  font-size: 13.5px;
  color: #007a5a !important;
}

/* Row Level Distinction */
.tr-level-1 {
  background-color: #e8f8f5 !important;
  font-weight: 700 !important;
  color: #007a5a !important;
}
.tr-level-1 td {
  border-bottom: 2px solid #b2dfdb !important;
  color: #007a5a !important;
  font-weight: 700 !important;
}
.tr-level-2 td {
  background-color: transparent;
}
.td-indent {
  padding-left: 36px !important;
  font-style: italic;
  color: #334155;
}

/* Financial Highlights */
.text-negative {
  color: #dc2626 !important;
  font-weight: 700;
}

/* Action Icons */
.btn-action-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  border-radius: var(--radius-sm);
  border: none;
  cursor: pointer;
  transition: all 0.15s;
  font-size: 12px;
}
.btn-action-edit {
  background: #e8f8f5;
  color: #007a5a;
}
.btn-action-edit:hover {
  background: #00c292;
  color: #fff;
  box-shadow: 0 2px 6px rgba(0, 194, 146, 0.4);
}
.btn-action-del {
  background: var(--ui-red-light);
  color: var(--ui-red);
}
.btn-action-del:hover {
  background: var(--ui-red);
  color: #fff;
  box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
}

/* Empty State Box */
.empty-table-state {
  text-align: center;
  padding: 40px 20px;
  color: var(--ui-text-muted);
}
.empty-table-state i {
  font-size: 48px;
  color: #a7f3d0;
  margin-bottom: 12px;
}

/* Modal Styling - Center Viewport (Notika Style) */
.modal-overlay {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(15, 23, 42, 0.65) !important;
  backdrop-filter: blur(5px) !important;
  -webkit-backdrop-filter: blur(5px) !important;
  z-index: 9999999 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 20px !important;
  margin: 0 !important;
  box-sizing: border-box !important;
  opacity: 0 !important;
  visibility: hidden !important;
  pointer-events: none !important;
  transition: opacity 0.22s ease, visibility 0.22s ease !important;
}
.modal-overlay.show {
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
}
.modal-box {
  background: #ffffff !important;
  border-radius: 14px !important;
  box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4) !important;
  width: 100% !important;
  max-width: 640px !important;
  margin: auto !important;
  max-height: 90vh !important;
  display: flex !important;
  flex-direction: column !important;
  overflow: hidden !important;
  position: relative !important;
  transform: scale(0.93) translateY(0) !important;
  transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.22s ease !important;
}
.modal-overlay.show .modal-box {
  transform: scale(1) translateY(0) !important;
}
.modal-header {
  padding: 18px 24px !important;
  background: #e8f8f5 !important;
  border-bottom: 1.5px solid #b2dfdb !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  flex-shrink: 0 !important;
}
.modal-title {
  font-size: 16px !important;
  font-weight: 700 !important;
  color: #007a5a !important;
  margin: 0 !important;
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
}
.modal-close-btn {
  background: none;
  border: none;
  font-size: 20px;
  color: #64748b;
  cursor: pointer;
  padding: 4px 8px;
  border-radius: 6px;
  line-height: 1;
  transition: all 0.15s;
}
.modal-close-btn:hover {
  color: var(--ui-red);
  background: #fee2e2;
}
.modal-body {
  padding: 24px !important;
  max-height: calc(90vh - 140px) !important;
  overflow-y: auto !important;
  flex: 1 1 auto !important;
}
.form-group {
  margin-bottom: 16px;
}
.form-label {
  display: block;
  font-size: 12.5px;
  font-weight: 600;
  color: #334155;
  margin-bottom: 6px;
}
.form-label span.req {
  color: var(--ui-red);
}
.form-control-ui {
  width: 100%;
  padding: 9px 12px;
  border: 1.5px solid var(--ui-border);
  border-radius: var(--radius-md);
  font-size: 13.5px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  background: #ffffff;
}
.form-control-ui:focus {
  border-color: #00c292;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.form-row-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.modal-footer {
  padding: 14px 22px;
  background: #f8fafc;
  border-top: 1px solid var(--ui-border);
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 10px;
}

.calc-preview-card {
  background: #f0fdf4;
  border: 1.5px solid #bbf7d0;
  border-radius: var(--radius-md);
  padding: 12px 16px;
  margin-top: 8px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}
.calc-preview-item {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.calc-preview-label {
  font-size: 11px;
  font-weight: 700;
  color: #166534;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.calc-preview-val {
  font-size: 15px;
  font-weight: 800;
  font-family: 'Roboto Mono', monospace;
  color: #166534;
}

/* Print Only Styles */
@media print {
  body { background: #fff !important; }
  .sidebar-wrapper, .header-top-area, .switcher-card, .table-toolbar, .stat-grid, .btn-action-icon, .modal-overlay {
    display: none !important;
  }
  .main-content { margin: 0 !important; padding: 0 !important; }
  .table-card { border: none !important; box-shadow: none !important; }
  .doc-table-header-banner { padding: 0 0 15px 0 !important; }
  .table-custom-notika thead th { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
  .table-custom-notika tbody tr { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
}

/* Read-only Mode & Filter Wilayah Styling */
<?php if (empty($CanCrud)): ?>
th.no-print, td.no-print, .btn-action-icon, .btn-action-edit, .btn-action-del, .btn-crud-only {
  display: none !important;
}
<?php endif; ?>

.filter-wilayah-card {
  background: #ffffff;
  border-radius: var(--radius-lg, 12px);
  border: 1.5px solid #b2dfdb;
  box-shadow: 0 4px 16px rgba(0, 194, 146, 0.08);
  padding: 20px 24px;
  margin-bottom: 24px;
  background: linear-gradient(180deg, #f2faf7 0%, #ffffff 100%);
}
.filter-wilayah-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 16px;
}
.filter-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: #00c292;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
  box-shadow: 0 4px 10px rgba(0, 194, 146, 0.25);
}
.filter-wilayah-title {
  font-size: 16px;
  font-weight: 700;
  color: #007a5a;
  margin: 0 0 4px 0;
}
.filter-wilayah-desc {
  font-size: 12.5px;
  color: #64748b;
  margin: 0;
  line-height: 1.4;
}
.filter-wilayah-form {
  display: flex;
  flex-wrap: wrap;
  align-items: flex-end;
  gap: 14px;
  padding: 16px;
  background: #ffffff;
  border-radius: var(--radius-md, 8px);
  border: 1px solid #d4ece5;
}
.filter-col {
  flex: 1 1 240px;
}
.filter-col label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: #334155;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.filter-select-ui {
  width: 100%;
  padding: 9px 12px;
  border: 1.5px solid #cbd5e1;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 600;
  color: #0f172a;
  background: #f8fafc;
  outline: none;
  transition: all 0.2s;
  cursor: pointer;
}
.filter-select-ui:focus {
  border-color: #00c292;
  background: #fff;
  box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.filter-col-btn {
  flex-shrink: 0;
}
.btn-filter-apply {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 22px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 700;
  background: #00c292;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: all 0.15s ease;
  box-shadow: 0 2px 8px rgba(0, 194, 146, 0.3);
}
.btn-filter-apply:hover {
  background: #00a87e;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 194, 146, 0.4);
}
.filter-status-notice {
  margin-top: 12px;
  font-size: 12px;
  color: #64748b;
  display: flex;
  align-items: center;
  gap: 8px;
}
.filter-status-notice a {
  color: #007a5a;
  text-decoration: underline;
}

</style>

<div class="main-content">

  <!-- Breadcrumb & Page Title -->
  <div class="page-header-box">
    <div class="page-badge">
      <i class="fa fa-book"></i> E-LKPJ &bull; Bab II
      <?php if (!empty($NamaWilayah)): ?>
        &bull; <i class="fa fa-map-marker"></i> <?= htmlspecialchars($NamaWilayah) ?>
      <?php endif; ?>
      <?php if (!empty($IsRole4) && !empty($NamaInstansi)): ?>
        &bull; <i class="fa fa-building"></i> <?= htmlspecialchars($NamaInstansi) ?> (Role Instansi)
      <?php endif; ?>
    </div>
    <h1 class="page-title">BAB 2 : Pengelolaan Keuangan Daerah</h1>
    <p class="page-subtitle">Perubahan Anggaran Pendapatan, Belanja, dan Pembiayaan Daerah <?= htmlspecialchars($NamaWilayah ?: 'Kabupaten Situbondo') ?> Tahun Anggaran <?= $tahunAktif ?> (Sebelum dan Sesudah Perubahan).</p>
  </div>

  
  <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT BELUM LOGIN / MODE PUBLIK) -->
  <?php if (empty($IsLoggedIn)): ?>
  <div class="filter-wilayah-card">
    <div class="filter-wilayah-header">
      <div class="filter-icon-box">
        <i class="fa fa-map-marker"></i>
      </div>
      <div>
        <h3 class="filter-wilayah-title">Pilih Wilayah (Provinsi & Daerah)</h3>
        <p class="filter-wilayah-desc">Anda sedang dalam mode pratinjau publik (belum login). Silakan pilih provinsi dan kabupaten/kota untuk melihat data statistik dokumen LKPJ daerah terkait.</p>
      </div>
    </div>
    <div class="filter-wilayah-form">
      <div class="filter-col">
        <label for="filterProvinsi"><i class="fa fa-globe"></i> Provinsi</label>
        <select id="filterProvinsi" class="filter-select-ui">
          <option value="">-- Pilih Provinsi --</option>
          <?php if (!empty($Provinsi)): ?>
            <?php foreach ($Provinsi as $prov): ?>
              <option value="<?= htmlspecialchars($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) === $prov['Kode']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($prov['Nama']) ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <div class="filter-col">
        <label for="filterKabKota"><i class="fa fa-building"></i> Kabupaten / Kota</label>
        <select id="filterKabKota" class="filter-select-ui">
          <option value="">-- Pilih Kab/Kota --</option>
        </select>
      </div>
      <div class="filter-col-btn">
        <button type="button" id="btnFilterWilayah" class="btn-filter-apply">
          <i class="fa fa-search"></i> Tampilkan Data
        </button>
      </div>
    </div>
    <div class="filter-status-notice">
      <i class="fa fa-lock" style="color:#d97706;font-size:14px;"></i>
      <span>Mode Pratinjau: <b>Hanya Baca (Read-Only)</b>. Untuk menambah, mengubah, atau menghapus data wilayah ini, silakan <a href="<?= base_url('Home') ?>" style="color:#007a5a;font-weight:700;text-decoration:underline;">Login ke Akun Daerah / Instansi</a>.</span>
    </div>
  </div>
  <?php endif; ?>

  <!-- Header Pemilihan Tabel: Dropdown & Quick Selector (Tabel 2.1 s/d Tabel 2.3) -->
  <div class="switcher-card">
    <div class="switcher-top-row">
      <div class="switcher-label-group">
        <div class="switcher-icon-box">
          <i class="fa fa-balance-scale"></i>
        </div>
        <div>
          <h2 class="switcher-title"><?= $metaTabel['nomor_tabel'] ?> : <?= $metaTabel['judul_singkat'] ?></h2>
          <p class="switcher-desc">Gunakan menu pilihan untuk beralih antar tabel dokumen LKPJ Bab 2</p>
        </div>
      </div>

      <div class="switcher-controls">
        <select id="selectTabel" class="select-tabel-custom" onchange="switchTabel(this.value)">
          <?php foreach ($daftarTabel as $k => $tab): ?>
            <option value="<?= $k ?>" <?= ($activeTabel === $k) ? 'selected' : '' ?>>
              <?= $tab['nomor_tabel'] ?> - <?= $tab['judul_singkat'] ?>
            </option>
          <?php endforeach; ?>
        </select>

        <?php
          $allKeys = array_keys($daftarTabel);
          $currIdx = array_search($activeTabel, $allKeys);
          $prevKey = ($currIdx > 0) ? $allKeys[$currIdx - 1] : null;
          $nextKey = ($currIdx < count($allKeys) - 1) ? $allKeys[$currIdx + 1] : null;
        ?>
        <?php if ($prevKey): ?>
          <a href="<?= base_url('Instansi/BAB2?tabel=' . $prevKey . '&tahun=' . $tahunAktif) ?>" class="btn-nav-tabel" title="Tabel Sebelumnya">
            <i class="fa fa-chevron-left"></i> Prev
          </a>
        <?php endif; ?>
        <?php if ($nextKey): ?>
          <a href="<?= base_url('Instansi/BAB2?tabel=' . $nextKey . '&tahun=' . $tahunAktif) ?>" class="btn-nav-tabel" title="Tabel Berikutnya">
            Next <i class="fa fa-chevron-right"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Quick Jump Pill Carousel -->
    <div class="quick-pills-wrapper">
      <span class="quick-pill-label"><i class="fa fa-bolt"></i> Cepat:</span>
      <?php foreach ($daftarTabel as $k => $tab): ?>
        <a href="<?= base_url('Instansi/BAB2?tabel=' . $k . '&tahun=' . $tahunAktif) ?>" 
           class="quick-pill <?= ($activeTabel === $k) ? 'active' : '' ?>"
           title="<?= htmlspecialchars($tab['judul']) ?>">
          <?= $tab['nomor_tabel'] ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Stat Summary Cards for 2.1, 2.2, 2.3 -->
  <?php if ($activeTabel === '2.1'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pendapatan Sebelum Perubahan</div>
        <div class="stat-value" style="color: #007a5a;"><?= formatUangLKPJ($summary2_1['total_sebelum']) ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-money"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pendapatan Sesudah Perubahan</div>
        <div class="stat-value" style="color: #2563eb;"><?= formatUangLKPJ($summary2_1['total_sesudah']) ?></div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-line-chart"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Lebih / (Kurang)</div>
        <div class="stat-value <?= ($summary2_1['total_selisih'] < 0) ? 'text-negative' : '' ?>">
          <?= formatUangLKPJ($summary2_1['total_selisih']) ?>
        </div>
      </div>
      <div class="stat-icon <?= ($summary2_1['total_selisih'] < 0) ? 'icon-red' : 'icon-teal' ?>">
        <i class="fa <?= ($summary2_1['total_selisih'] < 0) ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">% Perubahan</div>
        <div class="stat-value <?= ($summary2_1['total_persen'] < 0) ? 'text-negative' : '' ?>">
          <?= formatPersenLKPJ($summary2_1['total_persen']) ?>
        </div>
      </div>
      <div class="stat-icon icon-amber"><i class="fa fa-percent"></i></div>
    </div>
  </div>
  <?php elseif ($activeTabel === '2.2'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Belanja Sebelum</div>
        <div class="stat-value" style="color: #007a5a;"><?= formatUangLKPJ($summary2_2['total_sebelum']) ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-shopping-cart"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Total Belanja Sesudah</div>
        <div class="stat-value" style="color: #2563eb;"><?= formatUangLKPJ($summary2_2['total_sesudah']) ?></div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-credit-card"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Selisih Belanja</div>
        <div class="stat-value <?= ($summary2_2['total_selisih'] < 0) ? 'text-negative' : '' ?>">
          <?= formatUangLKPJ($summary2_2['total_selisih']) ?>
        </div>
      </div>
      <div class="stat-icon <?= ($summary2_2['total_selisih'] < 0) ? 'icon-red' : 'icon-teal' ?>">
        <i class="fa <?= ($summary2_2['total_selisih'] < 0) ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">% Perubahan Belanja</div>
        <div class="stat-value"><?= formatPersenLKPJ($summary2_2['total_persen']) ?></div>
      </div>
      <div class="stat-icon icon-amber"><i class="fa fa-percent"></i></div>
    </div>
  </div>
  <?php elseif ($activeTabel === '2.3'): ?>
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Penerimaan Pembiayaan</div>
        <div class="stat-value" style="color: #007a5a;"><?= formatUangLKPJ($summary2_3['penerimaan_sesudah']) ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-download"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pengeluaran Pembiayaan</div>
        <div class="stat-value" style="color: #2563eb;"><?= formatUangLKPJ($summary2_3['pengeluaran_sesudah']) ?></div>
      </div>
      <div class="stat-icon icon-blue"><i class="fa fa-upload"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">Pembiayaan Netto</div>
        <div class="stat-value" style="color: #8b5cf6;"><?= formatUangLKPJ($summary2_3['netto_sesudah']) ?></div>
      </div>
      <div class="stat-icon icon-purple"><i class="fa fa-exchange"></i></div>
    </div>
    <div class="stat-card">
      <div class="stat-info">
        <div class="stat-label">SILPA Sesudah Perubahan</div>
        <div class="stat-value" style="color: #059669;"><?= formatUangLKPJ($summary2_3['silpa_sesudah']) ?></div>
      </div>
      <div class="stat-icon icon-teal"><i class="fa fa-check-circle"></i></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Table Container Card -->
  <div class="table-card">
    <!-- Toolbar: Search & Action Buttons -->
    <div class="table-toolbar">
      <div class="toolbar-left">
        <div class="search-input-box">
          <i class="fa fa-search"></i>
          <input type="text" id="searchInput" placeholder="Cari uraian rekening..." onkeyup="filterTable()">
        </div>

        <span style="font-size:12.5px;color:var(--ui-text-muted);font-weight:600;">
          Tahun: 
          <select id="selectTahun" onchange="changeYear(this.value)" style="padding:5px 10px;border-radius:6px;border:1px solid var(--ui-border);font-weight:600;">
            <?php foreach ([2027, 2026, 2025, 2024, 2023] as $th): ?>
              <option value="<?= $th ?>" <?= ($tahunAktif == $th) ? 'selected' : '' ?>><?= $th ?></option>
            <?php endforeach; ?>
          </select>
        </span>

        <?php if (!empty($NamaWilayah)): ?>
        <span style="display:inline-flex;align-items:center;gap:6px;background:#e8f8f5;color:#007a5a;font-weight:700;font-size:12.5px;padding:5px 12px;border-radius:6px;border:1px solid #b2dfdb;">
          <i class="fa fa-map-marker"></i> <?= htmlspecialchars($NamaWilayah) ?>
        </span>
        <?php endif; ?>

        <?php if (!empty($IsRole4) && !empty($NamaInstansi)): ?>
        <span style="display:inline-flex;align-items:center;gap:6px;background:#eff6ff;color:#1d4ed8;font-weight:700;font-size:12.5px;padding:5px 12px;border-radius:6px;border:1px solid #bfdbfe;">
          <i class="fa fa-building"></i> <?= htmlspecialchars($NamaInstansi) ?> (Role Instansi)
        </span>
        <?php endif; ?>
      </div>

      <div class="toolbar-right">
        <?php if (!empty($CanCrud)): ?>
        <button class="btn-ui btn-ui-notika" onclick="openModalTambah('<?= $activeTabel ?>')">
          <i class="fa fa-plus"></i> Tambah Data
        </button>
        <button class="btn-ui btn-ui-outline" onclick="konfirmasiReset('<?= $activeTabel ?>')" title="Reset ke Nilai Default Dokumen">
          <i class="fa fa-refresh"></i> Reset Data
        </button>
        <?php else: ?>
        <a href="<?= base_url('Home') ?>" class="btn-ui btn-ui-notika" style="text-decoration:none;">
          <i class="fa fa-sign-in"></i> Login untuk Kelola Data
        </a>
        <?php endif; ?>
        <button class="btn-ui btn-ui-outline" onclick="window.print()">
          <i class="fa fa-print"></i> Cetak
        </button>
      </div>
    </div>

    <!-- Document Header Banner over Table -->
    <div class="doc-table-header-banner">
      <h3 class="doc-table-title"><?= htmlspecialchars($metaTabel['judul'] ?? '') ?></h3>
      <p class="doc-table-subtitle"><?= htmlspecialchars($metaTabel['subjudul'] ?? '') ?></p>
    </div>

    <!-- TABEL 2.1 -->
    <?php if ($activeTabel === '2.1'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 55px;">No</th>
            <th rowspan="2" style="text-align: left; padding-left: 20px; min-width: 320px;">Uraian</th>
            <th colspan="2">Jumlah (Rp)</th>
            <th rowspan="2" style="width: 200px; text-align: right; padding-right: 20px;">Lebih/(Kurang)<br>(Rp)</th>
            <th rowspan="2" style="width: 85px;">%</th>
            <th rowspan="2" style="width: 85px;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Sebelum Perubahan</th>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Sesudah Perubahan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($itemsTabel2_1)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-folder-open-o"></i>
                <p>Belum ada data pendapatan daerah. Silakan klik tombol <b>Tambah Data</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsTabel2_1 as $row): 
              $isHeader = ((int)$row['is_header'] === 1);
              $isLevel1 = ((int)$row['level'] === 1);
              $selisih = (float)$row['selisih'];
              $persen = (float)$row['persen'];
            ?>
            <tr class="<?= $isHeader ? 'tr-level-1' : 'tr-level-2' ?>" data-uraian="<?= htmlspecialchars(strtolower($row['uraian'])) ?>">
              <td class="td-center"><?= htmlspecialchars($row['nomor'] ?? '') ?></td>
              <td class="<?= !$isLevel1 ? 'td-indent' : '' ?>" style="<?= $isLevel1 ? 'padding-left: 20px;' : '' ?>">
                <?php if ($isHeader): ?>
                  <strong><?= htmlspecialchars($row['uraian']) ?></strong>
                <?php else: ?>
                  <?= htmlspecialchars($row['uraian']) ?>
                <?php endif; ?>
              </td>
              <td class="td-right" style="padding-right: 20px;"><?= number_format((float)$row['sebelum_perubahan'], 2, ',', '.') ?></td>
              <td class="td-right" style="padding-right: 20px;"><?= number_format((float)$row['sesudah_perubahan'], 2, ',', '.') ?></td>
              <td class="td-right <?= ($selisih < 0) ? 'text-negative' : '' ?>" style="padding-right: 20px;">
                <?= formatUangLKPJ($selisih, false) ?>
              </td>
              <td class="td-center <?= ($persen < 0) ? 'text-negative' : '' ?>">
                <?= formatPersenLKPJ($persen, '') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editData('2.1', <?= $row['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteData('2.1', <?= $row['id'] ?>)" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label">JUMLAH PENDAPATAN DAERAH</th>
            <th class="th-total-num" style="padding-right: 20px;"><?= number_format($summary2_1['total_sebelum'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 20px;"><?= number_format($summary2_1['total_sesudah'], 2, ',', '.') ?></th>
            <th class="th-total-num <?= ($summary2_1['total_selisih'] < 0) ? 'text-negative' : '' ?>" style="padding-right: 20px;">
              <?= formatUangLKPJ($summary2_1['total_selisih'], false) ?>
            </th>
            <th class="th-total-center <?= ($summary2_1['total_persen'] < 0) ? 'text-negative' : '' ?>">
              <?= formatPersenLKPJ($summary2_1['total_persen'], '') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div style="padding: 12px 20px; font-size: 12.5px; color: #64748b; font-style: italic; background: #ffffff; border-top: 1px solid #d4ece5;">
      Sumber: <?= htmlspecialchars($summary2_1['sumber']) ?>
    </div>

    <!-- TABEL 2.2 -->
    <?php elseif ($activeTabel === '2.2'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 55px;">No</th>
            <th rowspan="2" style="text-align: left; padding-left: 20px; min-width: 320px;">Uraian</th>
            <th colspan="2">Jumlah (Rp)</th>
            <th rowspan="2" style="width: 200px; text-align: right; padding-right: 20px;">Lebih/(Kurang)<br>(Rp)</th>
            <th rowspan="2" style="width: 85px;">%</th>
            <th rowspan="2" style="width: 85px;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Sebelum Perubahan</th>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Sesudah Perubahan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($itemsTabel2_2)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-folder-open-o"></i>
                <p>Belum ada data belanja daerah. Silakan klik tombol <b>Tambah Data</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsTabel2_2 as $row): 
              $isHeader = ((int)$row['is_header'] === 1);
              $isLevel1 = ((int)$row['level'] === 1);
              $selisih = (float)$row['selisih'];
              $persen = (float)$row['persen'];
            ?>
            <tr class="<?= $isHeader ? 'tr-level-1' : 'tr-level-2' ?>" data-uraian="<?= htmlspecialchars(strtolower($row['uraian'])) ?>">
              <td class="td-center"><?= htmlspecialchars($row['nomor'] ?? '') ?></td>
              <td class="<?= !$isLevel1 ? 'td-indent' : '' ?>" style="<?= $isLevel1 ? 'padding-left: 20px;' : '' ?>">
                <?php if ($isHeader): ?>
                  <strong><?= htmlspecialchars($row['uraian']) ?></strong>
                <?php else: ?>
                  <?= htmlspecialchars($row['uraian']) ?>
                <?php endif; ?>
              </td>
              <td class="td-right" style="padding-right: 20px;"><?= number_format((float)$row['sebelum_perubahan'], 2, ',', '.') ?></td>
              <td class="td-right" style="padding-right: 20px;"><?= number_format((float)$row['sesudah_perubahan'], 2, ',', '.') ?></td>
              <td class="td-right <?= ($selisih < 0) ? 'text-negative' : '' ?>" style="padding-right: 20px;">
                <?= formatUangLKPJ($selisih, false) ?>
              </td>
              <td class="td-center <?= ($persen < 0) ? 'text-negative' : '' ?>">
                <?= formatPersenLKPJ($persen, '') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editData('2.2', <?= $row['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteData('2.2', <?= $row['id'] ?>)" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="th-total-label">Jumlah Belanja dan Transfer</th>
            <th class="th-total-num" style="padding-right: 20px;"><?= number_format($summary2_2['total_sebelum'], 2, ',', '.') ?></th>
            <th class="th-total-num" style="padding-right: 20px;"><?= number_format($summary2_2['total_sesudah'], 2, ',', '.') ?></th>
            <th class="th-total-num <?= ($summary2_2['total_selisih'] < 0) ? 'text-negative' : '' ?>" style="padding-right: 20px;">
              <?= formatUangLKPJ($summary2_2['total_selisih'], false) ?>
            </th>
            <th class="th-total-center <?= ($summary2_2['total_persen'] < 0) ? 'text-negative' : '' ?>">
              <?= formatPersenLKPJ($summary2_2['total_persen'], '') ?>
            </th>
            <th class="no-print"></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div style="padding: 12px 20px; font-size: 12.5px; color: #64748b; font-style: italic; background: #ffffff; border-top: 1px solid #d4ece5;">
      Sumber: <?= htmlspecialchars($summary2_2['sumber']) ?>
    </div>

    <!-- TABEL 2.3 -->
    <?php elseif ($activeTabel === '2.3'): ?>
    <div class="table-responsive-notika">
      <table class="table-custom-notika" id="mainDataTable">
        <thead>
          <tr>
            <th rowspan="2" style="width: 55px;">No</th>
            <th rowspan="2" style="text-align: left; padding-left: 20px; min-width: 320px;">Uraian</th>
            <th colspan="2">Jumlah (Rp)</th>
            <th rowspan="2" style="width: 200px; text-align: right; padding-right: 20px;">Lebih/(Kurang)<br>(Rp)</th>
            <th rowspan="2" style="width: 85px;">%</th>
            <th rowspan="2" style="width: 85px;" class="no-print">Aksi</th>
          </tr>
          <tr>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Sebelum Perubahan</th>
            <th style="width: 190px; text-align: right; padding-right: 20px;">Sesudah Perubahan</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($itemsTabel2_3)): ?>
            <tr>
              <td colspan="7" class="empty-table-state">
                <i class="fa fa-folder-open-o"></i>
                <p>Belum ada data pembiayaan daerah. Silakan klik tombol <b>Tambah Data</b> atau <b>Reset Data</b>.</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($itemsTabel2_3 as $row): 
              $isHeader = ((int)$row['is_header'] === 1);
              $isLevel1 = ((int)$row['level'] === 1);
              $selisih = (float)$row['selisih'];
              $persen = (float)$row['persen'];
            ?>
            <tr class="<?= $isHeader ? 'tr-level-1' : 'tr-level-2' ?>" data-uraian="<?= htmlspecialchars(strtolower($row['uraian'])) ?>">
              <td class="td-center"><?= htmlspecialchars($row['nomor'] ?? '') ?></td>
              <td class="<?= !$isLevel1 ? 'td-indent' : '' ?>" style="<?= $isLevel1 ? 'padding-left: 20px;' : '' ?>">
                <?php if ($isHeader): ?>
                  <strong><?= htmlspecialchars($row['uraian']) ?></strong>
                <?php else: ?>
                  <?= htmlspecialchars($row['uraian']) ?>
                <?php endif; ?>
              </td>
              <td class="td-right" style="padding-right: 20px;"><?= number_format((float)$row['sebelum_perubahan'], 2, ',', '.') ?></td>
              <td class="td-right" style="padding-right: 20px;"><?= number_format((float)$row['sesudah_perubahan'], 2, ',', '.') ?></td>
              <td class="td-right <?= ($selisih < 0) ? 'text-negative' : '' ?>" style="padding-right: 20px;">
                <?= formatUangLKPJ($selisih, false) ?>
              </td>
              <td class="td-center <?= ($persen < 0) ? 'text-negative' : '' ?>">
                <?= formatPersenLKPJ($persen, '') ?>
              </td>
              <td class="td-center no-print">
                <button class="btn-action-icon btn-action-edit" onclick="editData('2.3', <?= $row['id'] ?>)" title="Ubah Data">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn-action-icon btn-action-del" onclick="deleteData('2.3', <?= $row['id'] ?>)" title="Hapus Data">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div style="padding: 12px 20px; font-size: 12.5px; color: #64748b; font-style: italic; background: #ffffff; border-top: 1px solid #d4ece5;">
      Sumber: <?= htmlspecialchars($summary2_3['sumber']) ?>
    </div>
    <?php endif; ?>

  </div>

</div>

<!-- MODAL CRUD BAB 2 (Notika Center Viewport) -->
<div class="modal-overlay" id="modalBab2">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="modal-title" id="modalBab2Title">
        <i class="fa fa-plus-circle" style="color: #00c292;"></i> Form Data Anggaran
      </h3>
      <button class="modal-close-btn" onclick="closeModal('modalBab2')">&times;</button>
    </div>
    <form id="formBab2" onsubmit="submitFormBab2(event)">
      <div class="modal-body">
        <input type="hidden" id="form_id" name="id" value="">
        <input type="hidden" id="form_tahun" name="tahun" value="<?= $tahunAktif ?>">
        <input type="hidden" id="form_instansi_id" name="instansi_id" value="<?= $filterInstansi ?>">
        <input type="hidden" id="form_tabel_target" value="<?= $activeTabel ?>">

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Nomor Urut / Kode (Kosong jika rincian)</label>
            <input type="text" id="form_nomor" name="nomor" class="form-control-ui" placeholder="Contoh: 1, 2, 3">
          </div>
          <div class="form-group">
            <label class="form-label">Urutan Tampil Baris</label>
            <input type="number" id="form_urutan" name="urutan" class="form-control-ui" value="1" min="1">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Uraian Rekening / Akun <span class="req">*</span></label>
          <input type="text" id="form_uraian" name="uraian" class="form-control-ui" required placeholder="Contoh: Pajak daerah / Belanja Pegawai">
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Level Baris</label>
            <select id="form_level" name="level" class="form-control-ui" onchange="toggleLevelFields(this.value)">
              <option value="1">Level 1 - Kelompok / Akun Utama</option>
              <option value="2" selected>Level 2 - Rincian / Sub Akun</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Tipe Tampilan</label>
            <select id="form_is_header" name="is_header" class="form-control-ui">
              <option value="0" selected>Baris Rincian (Normal)</option>
              <option value="1">Baris Induk / Header (Bold)</option>
            </select>
          </div>
        </div>

        <div class="form-group" id="parentGroup">
          <label class="form-label">Pilih Induk (Parent Row)</label>
          <select id="form_parent_id" name="parent_id" class="form-control-ui">
            <option value="0">-- Tidak Ada (Baris Mandiri / Induk) --</option>
            <?php 
              $currentItems = ($activeTabel === '2.1') ? $itemsTabel2_1 : (($activeTabel === '2.2') ? $itemsTabel2_2 : $itemsTabel2_3);
              foreach ($currentItems as $itm):
                if ((int)$itm['is_header'] === 1 || (int)$itm['level'] === 1):
            ?>
              <option value="<?= $itm['id'] ?>">
                <?= htmlspecialchars(($itm['nomor'] ? $itm['nomor'] . '. ' : '') . $itm['uraian']) ?>
              </option>
            <?php 
                endif;
              endforeach; 
            ?>
          </select>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label class="form-label">Sebelum Perubahan (Rp) <span class="req">*</span></label>
            <input type="text" id="form_sebelum" name="sebelum_perubahan" class="form-control-ui" required value="0" oninput="calculateDifference()">
          </div>
          <div class="form-group">
            <label class="form-label">Sesudah Perubahan (Rp) <span class="req">*</span></label>
            <input type="text" id="form_sesudah" name="sesudah_perubahan" class="form-control-ui" required value="0" oninput="calculateDifference()">
          </div>
        </div>

        <div class="calc-preview-card">
          <div class="calc-preview-item">
            <span class="calc-preview-label">Lebih / (Kurang) (Rp):</span>
            <span class="calc-preview-val" id="previewSelisih">Rp 0,00</span>
          </div>
          <div class="calc-preview-item">
            <span class="calc-preview-label">Persentase (%):</span>
            <span class="calc-preview-val" id="previewPersen">0,00%</span>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn-ui btn-ui-outline" onclick="closeModal('modalBab2')">Batal</button>
        <button type="submit" class="btn-ui btn-ui-notika" id="btnSubmitBab2">
          <i class="fa fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';
const CURRENT_TABEL = '<?= $activeTabel ?>';
const CURRENT_TAHUN = '<?= $tahunAktif ?>';
const CURRENT_INSTANSI = '<?= $filterInstansi ?>';
const IS_LOGGED_IN = <?= !empty($IsLoggedIn) ? 'true' : 'false' ?>;
const CAN_CRUD = <?= !empty($CanCrud) ? 'true' : 'false' ?>;

// Script Filter Dropdown Provinsi & Kab/Kota (Khusus Saat Belum Login)
<?php if (empty($IsLoggedIn)): ?>
document.addEventListener('DOMContentLoaded', function() {
  const provSelect = document.getElementById('filterProvinsi');
  const kabSelect = document.getElementById('filterKabKota');
  const btnFilter = document.getElementById('btnFilterWilayah');
  const activeKode = '<?= $KodeWilayah ?>';
  const activeProv = activeKode ? activeKode.substring(0, 2) : '';

  function fetchKabKota(provCode, preselected) {
    if (!provCode) {
      kabSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
      kabSelect.disabled = true;
      return;
    }
    kabSelect.disabled = true;
    kabSelect.innerHTML = '<option value="">Memuat data kab/kota...</option>';

    const formData = new FormData();
    formData.append('Kode', provCode);

    fetch(BASE_URL + 'Instansi/GetListKabKota', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      let opts = '<option value="">-- Pilih Kab/Kota --</option>';
      if (data && data.length > 0) {
        data.forEach(item => {
          const sel = (item.Kode === preselected) ? ' selected' : '';
          opts += `<option value="${item.Kode}"${sel}>${item.Nama}</option>`;
        });
      }
      kabSelect.innerHTML = opts;
      kabSelect.disabled = false;
    })
    .catch(() => {
      kabSelect.innerHTML = '<option value="">-- Gagal memuat data --</option>';
      kabSelect.disabled = false;
    });
  }

  if (provSelect) {
    provSelect.addEventListener('change', function() {
      fetchKabKota(this.value, '');
    });

    if (activeProv) {
      fetchKabKota(activeProv, activeKode);
    }
  }

  if (btnFilter) {
    btnFilter.addEventListener('click', function() {
      const pVal = provSelect ? provSelect.value : '';
      const kVal = kabSelect ? kabSelect.value : '';
      if (!pVal) {
        Swal.fire('Perhatian', 'Silakan pilih Provinsi terlebih dahulu.', 'warning');
        return;
      }
      if (!kVal) {
        Swal.fire('Perhatian', 'Silakan pilih Kabupaten / Kota.', 'warning');
        return;
      }

      btnFilter.disabled = true;
      btnFilter.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memuat...';

      const formData = new FormData();
      formData.append('KodeWilayah', kVal);

      fetch(BASE_URL + 'Instansi/SetTempKodeWilayah', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
      })
      .then(r => r.text())
      .then(res => {
        if (res.trim() === '1') {
          window.location.reload();
        } else {
          Swal.fire('Error', res || 'Gagal menyimpan wilayah pilihan.', 'error');
          btnFilter.disabled = false;
          btnFilter.innerHTML = '<i class="fa fa-search"></i> Tampilkan Data';
        }
      })
      .catch(() => {
        Swal.fire('Error', 'Gagal menghubungi server.', 'error');
        btnFilter.disabled = false;
        btnFilter.innerHTML = '<i class="fa fa-search"></i> Tampilkan Data';
      });
    });
  }
});
<?php endif; ?>

// Beralih Tabel (Tabel 2.1 s/d 2.3)
function switchTabel(tabelKode) {
  const tahun = document.getElementById('selectTahun') ? document.getElementById('selectTahun').value : CURRENT_TAHUN;
  window.location.href = `${BASE_URL}Instansi/BAB2?tabel=${tabelKode}&tahun=${tahun}&instansi_id=${CURRENT_INSTANSI}`;
}

// Beralih Tahun
function changeYear(tahun) {
  window.location.href = `${BASE_URL}Instansi/BAB2?tabel=${CURRENT_TABEL}&tahun=${tahun}&instansi_id=${CURRENT_INSTANSI}`;
}

// Filter teks dalam tabel
function filterTable() {
  const input = document.getElementById('searchInput').value.toLowerCase().trim();
  const rows = document.querySelectorAll('#mainDataTable tbody tr');
  rows.forEach(row => {
    const text = (row.getAttribute('data-uraian') || row.innerText).toLowerCase();
    row.style.display = text.includes(input) ? '' : 'none';
  });
}

// Modal Handlers (Center Viewport - Notika Template)
function openModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    if (modal.parentElement !== document.body) {
      document.body.appendChild(modal);
    }
    document.body.style.overflow = 'hidden';
    modal.classList.add('show');
  }
}

function closeModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.remove('show');
    document.body.style.overflow = '';
  }
}

// Currency & Number Parsing
function parseCurrency(str) {
  if (!str) return 0;
  let clean = str.toString().replace(/Rp/g, '').replace(/\s/g, '').replace(/\./g, '').replace(/,/g, '.');
  let val = parseFloat(clean);
  return isNaN(val) ? 0 : val;
}

function formatIndoCurrency(num) {
  const isNegative = num < 0;
  const absNum = Math.abs(num);
  const parts = absNum.toFixed(2).split('.');
  const intPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  const decPart = parts[1];
  const formatted = `Rp ${intPart},${decPart}`;
  return isNegative ? `(${formatted})` : formatted;
}

function formatIndoPercent(num) {
  const isNegative = num < 0;
  const absNum = Math.abs(num);
  const formatted = absNum.toFixed(2).replace('.', ',') + '%';
  return isNegative ? `(${formatted})` : formatted;
}

// Auto Calculate Difference and Percent in Modal
function calculateDifference() {
  const sebelum = parseCurrency(document.getElementById('form_sebelum').value);
  const sesudah = parseCurrency(document.getElementById('form_sesudah').value);
  const selisih = sesudah - sebelum;
  let persen = 0;
  if (sebelum !== 0) {
    persen = (selisih / sebelum) * 100;
  }

  const elSelisih = document.getElementById('previewSelisih');
  const elPersen = document.getElementById('previewPersen');

  elSelisih.innerText = formatIndoCurrency(selisih);
  elPersen.innerText = formatIndoPercent(persen);

  if (selisih < 0) {
    elSelisih.style.color = '#dc2626';
    elPersen.style.color = '#dc2626';
  } else {
    elSelisih.style.color = '#166534';
    elPersen.style.color = '#166534';
  }
}

// Toggle level fields
function toggleLevelFields(level) {
  const isLvl1 = (parseInt(level) === 1);
  const isHeaderSel = document.getElementById('form_is_header');
  const parentSel = document.getElementById('form_parent_id');
  if (isLvl1) {
    isHeaderSel.value = '1';
    parentSel.value = '0';
  } else {
    isHeaderSel.value = '0';
  }
}

// Open Modal Tambah
function openModalTambah(tabel) {
  document.getElementById('formBab2').reset();
  document.getElementById('form_id').value = '';
  document.getElementById('form_tabel_target').value = tabel;
  document.getElementById('modalBab2Title').innerHTML = `<i class="fa fa-plus-circle" style="color: #00c292;"></i> Tambah Data ${tabel}`;
  document.getElementById('previewSelisih').innerText = 'Rp 0,00';
  document.getElementById('previewPersen').innerText = '0,00%';
  document.getElementById('previewSelisih').style.color = '#166534';
  document.getElementById('previewPersen').style.color = '#166534';
  openModal('modalBab2');
}

// Edit Data
function editData(tabel, id) {
  const endpoint = `${BASE_URL}Instansi/GetBab2Tabel${tabel.replace('.', '_')}?id=${id}`;
  fetch(endpoint, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(res => {
    if (res.status === 'success') {
      const d = res.data;
      document.getElementById('form_id').value = d.id;
      document.getElementById('form_tabel_target').value = tabel;
      document.getElementById('form_nomor').value = d.nomor || '';
      document.getElementById('form_urutan').value = d.urutan || 1;
      document.getElementById('form_uraian').value = d.uraian || '';
      document.getElementById('form_level').value = d.level || 2;
      document.getElementById('form_is_header').value = d.is_header || 0;
      document.getElementById('form_parent_id').value = d.parent_id || 0;
      document.getElementById('form_sebelum').value = formatIndoCurrency(parseFloat(d.sebelum_perubahan)).replace('Rp ', '').replace('(', '-').replace(')', '');
      document.getElementById('form_sesudah').value = formatIndoCurrency(parseFloat(d.sesudah_perubahan)).replace('Rp ', '').replace('(', '-').replace(')', '');

      document.getElementById('modalBab2Title').innerHTML = `<i class="fa fa-pencil" style="color: #00c292;"></i> Ubah Data ${tabel}`;
      calculateDifference();
      openModal('modalBab2');
    } else {
      Swal.fire('Gagal', res.message || 'Data tidak dapat dimuat', 'error');
    }
  })
  .catch(err => {
    Swal.fire('Error', 'Terjadi kesalahan saat memuat data', 'error');
  });
}

// Submit Form
function submitFormBab2(e) {
  e.preventDefault();
  const tabel = document.getElementById('form_tabel_target').value;
  const form = document.getElementById('formBab2');
  const formData = new FormData(form);
  const endpoint = `${BASE_URL}Instansi/SaveBab2Tabel${tabel.replace('.', '_')}`;

  const btn = document.getElementById('btnSubmitBab2');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(endpoint, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(res => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    if (res.status === 'success') {
      closeModal('modalBab2');
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: res.message,
        timer: 1200,
        showConfirmButton: false
      }).then(() => {
        window.location.reload();
      });
    } else {
      Swal.fire('Gagal', res.message || 'Gagal menyimpan data', 'error');
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fa fa-save"></i> Simpan Data';
    Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
  });
}

// Delete Data
function deleteData(tabel, id) {
  Swal.fire({
    title: 'Hapus Data Ini?',
    text: 'Data yang dihapus dapat dipulihkan melalui reset default.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then(result => {
    if (result.isConfirmed) {
      const endpoint = `${BASE_URL}Instansi/DeleteBab2Tabel${tabel.replace('.', '_')}`;
      const fd = new FormData();
      fd.append('id', id);

      fetch(endpoint, {
        method: 'POST',
        body: fd,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(res => {
        if (res.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus',
            text: res.message,
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire('Gagal', res.message || 'Gagal menghapus data', 'error');
        }
      })
      .catch(err => {
        Swal.fire('Error', 'Gagal memproses permintaan hapus', 'error');
      });
    }
  });
}

// Reset Data Default
function konfirmasiReset(tabel) {
  Swal.fire({
    title: 'Reset ke Data Default Dokumen?',
    text: 'Data saat ini akan dihapus dan dikembalikan ke nilai default sesuai dokumen resmi LKPJ.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#00c292',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Reset',
    cancelButtonText: 'Batal'
  }).then(result => {
    if (result.isConfirmed) {
      const endpoint = `${BASE_URL}Instansi/ResetBab2Tabel${tabel.replace('.', '_')}`;
      const fd = new FormData();
      fd.append('tahun', CURRENT_TAHUN);
      fd.append('instansi_id', CURRENT_INSTANSI);

      fetch(endpoint, {
        method: 'POST',
        body: fd,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(res => {
        if (res.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Reset',
            text: res.message,
            timer: 1400,
            showConfirmButton: false
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire('Gagal', res.message || 'Gagal mereset data', 'error');
        }
      })
      .catch(err => {
        Swal.fire('Error', 'Gagal memproses reset data', 'error');
      });
    }
  });
}

// Close modal when clicked outside backdrop
window.addEventListener('click', function(event) {
  const modal = document.getElementById('modalBab2');
  if (event.target === modal) {
    closeModal('modalBab2');
  }
});
</script>
