<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto:wght@400;500;700&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    /* Sentuhan Warna Notika yang Selaras & Elegan */
    --notika-green: #00c292;
    --notika-green-dark: #00a87e;
    --notika-green-light: #e8f8f5;
    --notika-green-border: #b2dfdb;
    
    --ui-primary: #00c292;
    --ui-primary-hover: #00a87e;
    --ui-accent: #00a87e;
    --ui-accent-hover: #00897b;
    --ui-accent-light: #e8f8f5;
    
    --ui-blue: #0284c7;
    --ui-blue-light: #eff6ff;
    --ui-red: #dc2626;
    --ui-red-light: #fef2f2;
    --ui-amber: #d97706;
    --ui-amber-light: #fffbeb;
    
    --ui-bg: #f8fafc;
    --ui-card-bg: #ffffff;
    --ui-border: #cbd5e1;
    --ui-border-light: #e2e8f0;
    --ui-text-black: #000000;
    --ui-text-main: #0f172a;
    --ui-text-muted: #475569;
    --ui-text-subtle: #64748b;
    
    /* Table Headers (Hijau Notika Selaras) */
    --th-bg-main: #00c292;
    --th-bg-sub: #00a87e;
  }

  * { box-sizing: border-box; }
  
  body {
    margin: 0;
    font-family: "Inter", "Roboto", "Segoe UI", -apple-system, BlinkMacSystemFont, Arial, sans-serif;
    background: var(--ui-bg);
    color: var(--ui-text-main);
    font-size: 14.5px;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
  }

  .app {
    width: 100%;
    max-width: 100%;
    margin: 0;
    padding: 10px 16px 70px;
  }

  /* ---------- Page Header (Professional & Clean) ---------- */
  .page-header {
    background: var(--ui-card-bg);
    border: 1px solid var(--ui-border-light);
    border-radius: 10px;
    padding: 18px 24px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  }
  .page-header-left {
    display: flex;
    align-items: center;
    gap: 16px;
  }
  .page-header h1 {
    font-size: 22px;
    margin: 0;
    font-weight: 800;
    color: var(--ui-text-main);
    letter-spacing: -0.3px;
  }
  .page-header p {
    margin: 3px 0 0;
    font-size: 14px;
    color: var(--ui-text-muted);
  }

  /* ---------- Cards ---------- */
  .card {
    background: var(--ui-card-bg);
    border: 1px solid var(--ui-border-light);
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    margin-bottom: 22px;
    overflow: hidden;
    width: 100%;
  }

  /* Context Card Header */
  .card-header-simple {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 24px;
    background: #f8fafc;
    border-bottom: 1px solid var(--ui-border-light);
  }
  .card-header-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: var(--ui-text-main);
  }
  .card-header-title svg {
    width: 18px;
    height: 18px;
    stroke: var(--notika-green);
  }
  .card-header-desc {
    font-size: 13px;
    color: var(--ui-text-subtle);
  }

  .context-card .card-body {
    padding: 12px 24px 16px;
  }

  /* ---------- Context Rows (Semua Tulisan Berwarna Hitam Pekat) ---------- */
  .context-grid {
    display: flex;
    flex-direction: column;
  }
  .context-row {
    display: flex;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
    align-items: center;
    font-size: 14.5px;
  }
  .context-row:last-child {
    border-bottom: none;
  }
  .context-row .label {
    width: 220px;
    flex-shrink: 0;
    font-weight: 700;
    font-size: 14.5px;
    color: var(--ui-text-black) !important;
  }
  .context-row .colon {
    width: 18px;
    flex-shrink: 0;
    font-weight: 700;
    font-size: 14.5px;
    color: var(--ui-text-black) !important;
  }
  .context-row .control-wrap {
    flex: 1;
  }
  .context-row select, 
  .context-row input {
    border: 1px solid var(--ui-border);
    border-radius: 6px;
    background: #ffffff;
    font-size: 14.5px;
    color: var(--ui-text-black) !important;
    width: 100%;
    font-family: inherit;
    padding: 7px 12px;
    font-weight: 600;
    transition: all 0.15s ease;
  }
  .context-row select:focus, 
  .context-row input:focus {
    outline: none;
    border-color: var(--notika-green);
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2);
  }
  .context-row input.context-readonly {
    background: #f8fafc;
    border-color: var(--ui-border-light);
    color: var(--ui-text-black) !important;
    font-weight: 600;
    cursor: default;
  }

  .context-hint {
    margin: 4px 24px 16px;
    padding: 11px 16px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    background: #f8fafc;
    color: var(--ui-text-muted);
    border: 1px solid var(--ui-border-light);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .context-hint.ok {
    background: var(--notika-green-light);
    color: #00796b;
    border-color: var(--notika-green-border);
    font-weight: 600;
  }
  .context-hint.hidden {
    display: none;
  }

  /* ---------- Toolbar ---------- */
  .table-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    border-bottom: 1px solid var(--ui-border-light);
    background: #ffffff;
  }
  .table-toolbar h2 {
    font-size: 17px;
    margin: 0;
    font-weight: 700;
    color: var(--ui-text-main);
  }
  .table-toolbar p {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--ui-text-muted);
  }
  
  .btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--notika-green);
    color: #ffffff;
    border: none;
    padding: 9px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease;
    white-space: nowrap;
    box-shadow: 0 1px 2px rgba(0, 194, 146, 0.2);
  }
  .btn-add:hover {
    background: var(--notika-green-dark);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 194, 146, 0.3);
  }
  .btn-add svg {
    width: 16px;
    height: 16px;
  }
  .btn-add:disabled {
    background: #cbd5e1;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
  }

  /* ---------- Table (Header Hijau Notika & Data Bersih) ---------- */
  .table-wrap {
    overflow-x: auto;
    width: 100%;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1100px;
    font-size: 14px;
  }
  
  /* Hijau Notika Header */
  thead th {
    background: var(--th-bg-main);
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    padding: 12px 16px;
    text-align: left;
    letter-spacing: 0.2px;
    white-space: nowrap;
    border: 1px solid rgba(255,255,255,0.25) !important;
  }
  thead .sub-head th {
    background: var(--th-bg-sub);
    font-size: 13.5px;
    font-weight: 700;
    padding: 10px 16px;
    border: 1px solid rgba(255,255,255,0.2) !important;
  }
  th.num, td.num {
    text-align: right;
  }
  th.center, td.center {
    text-align: center;
  }
  
  tbody td {
    padding: 11px 16px;
    border: 1px solid var(--ui-border-light);
    vertical-align: middle;
    font-size: 14px;
    color: var(--ui-text-main);
  }
  tbody tr:hover td {
    background: #f8fafc;
  }

  /* Baris Data Bersih & Terstruktur (Tanpa Blok Warna Berat) */
  tr.row-lvl1 td {
    background: #ffffff;
    color: #0f172a;
    font-weight: 700;
    font-size: 14.5px;
    border-left: 4px solid var(--notika-green) !important;
  }
  tr.row-lvl2 td {
    background: #ffffff;
    color: #0f172a;
    font-weight: 700;
    font-size: 14px;
    border-left: 4px solid var(--notika-green-dark) !important;
  }
  tr.row-lvl3 td {
    background: #ffffff;
    color: #0f172a;
    font-weight: 700;
    font-size: 14px;
    border-left: 4px solid #64748b !important;
  }
  tr.row-lvl4 td {
    background: #ffffff;
    color: #0f172a;
    font-weight: 600;
    border-left: 4px solid #94a3b8 !important;
    font-size: 14px;
  }
  tr.row-lvl5 td {
    background: #ffffff;
    color: #0f172a;
    font-weight: 600;
    border-left: 4px solid #cbd5e1 !important;
    font-size: 14px;
  }
  tr.row-account td {
    background: #ffffff;
    color: var(--ui-text-main);
    font-weight: 700;
    border-left: 4px solid var(--notika-green) !important;
    font-size: 14px;
  }
  tr.row-group td {
    background: #f8fafc;
    font-weight: 700;
    color: var(--ui-text-main);
    border-left: 4px solid var(--notika-green) !important;
    font-size: 14px;
  }
  tr.row-group .sub-label {
    display: block;
    font-weight: 500;
    font-size: 12.5px;
    color: var(--ui-text-muted);
    margin-top: 2px;
  }
  tr.row-subgroup td {
    background: #ffffff;
    font-weight: 600;
    color: #334155;
    border-left: 4px solid #cbd5e1 !important;
    font-size: 13.5px;
  }
  tr.row-item td {
    background: #ffffff;
    font-size: 14px;
  }
  tr.row-item .komponen {
    color: var(--ui-text-main);
    font-weight: 600;
    font-size: 14px;
  }
  tr.row-item .spesifikasi {
    display: block;
    font-size: 13px;
    color: var(--ui-text-muted);
    margin-top: 2px;
  }
  tr.row-item .keterangan {
    display: block;
    font-size: 12.5px;
    color: var(--ui-text-subtle);
    margin-top: 2px;
  }

  .toggle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    cursor: pointer;
    margin-right: 8px;
    flex-shrink: 0;
    vertical-align: middle;
    user-select: none;
  }
  .toggle svg {
    width: 14px;
    height: 14px;
    transition: transform 0.15s ease;
  }
  .toggle.collapsed svg {
    transform: rotate(-90deg);
  }
  .cell-label {
    display: flex;
    align-items: flex-start;
  }
  .cell-label .txt {
    flex: 1;
  }

  .tag {
    font-weight: 700;
  }

  /* Monospace Numbers & Codes */
  .font-mono {
    font-family: 'Roboto Mono', 'SFMono-Regular', Consolas, monospace;
    font-size: 14px;
    font-weight: 600;
  }

  /* Currency Alignment (Rp di Kiri & Nominal di Kanan Sejajar) */
  .money-cell {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    gap: 8px;
    font-family: 'Roboto Mono', 'SFMono-Regular', Consolas, monospace;
    box-sizing: border-box;
  }
  .money-cell .cur {
    font-weight: 600;
    font-size: 13.5px;
    color: var(--ui-text-muted);
    flex-shrink: 0;
    text-align: left;
  }
  .money-cell .val {
    text-align: right;
    flex-grow: 1;
    font-size: 14px;
    font-weight: 600;
    font-variant-numeric: tabular-nums;
  }
  tr.row-lvl1 .money-cell .cur,
  tr.row-account .money-cell .cur {
    color: #0f172a;
    font-weight: 700;
  }
  tfoot .money-cell .cur {
    color: var(--ui-text-black);
    font-weight: 700;
    font-size: 14px;
  }
  tfoot .money-cell .val {
    color: var(--ui-text-black);
    font-weight: 700;
    font-size: 15px;
  }

  .actions {
    display: flex;
    gap: 6px;
    justify-content: center;
  }
  .icon-btn {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: 1px solid var(--ui-border);
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .icon-btn svg {
    width: 15px;
    height: 15px;
  }
  .icon-btn.edit {
    color: var(--ui-blue);
  }
  .icon-btn.edit:hover {
    background: var(--ui-blue-light);
    border-color: var(--ui-blue);
  }
  .icon-btn.del {
    color: var(--ui-red);
  }
  .icon-btn.del:hover {
    background: var(--ui-red-light);
    border-color: var(--ui-red);
  }

  tfoot td {
    padding: 12px 16px;
    font-weight: 700;
    background: #ffffff;
    color: var(--ui-text-main);
    font-size: 14.5px;
    border: 1px solid var(--ui-border-light);
    border-top: 2px solid var(--ui-border) !important;
  }
  tfoot td.label {
    text-align: center;
    color: var(--ui-text-black);
    font-weight: 700;
    letter-spacing: 0.3px;
  }

  .empty-state {
    padding: 55px 20px;
    text-align: center;
    color: var(--ui-text-muted);
  }
  .empty-state svg {
    width: 48px;
    height: 48px;
    stroke: #94a3b8;
    margin-bottom: 14px;
  }
  .empty-state p {
    margin: 0;
    font-size: 14.5px;
  }

  /* ---------- Modal (Notika Header) ---------- */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 85px 16px 40px;
    z-index: 999999 !important;
    overflow-y: auto;
  }
  .modal-overlay.hidden {
    display: none;
  }
  .modal-custom {
    background: #ffffff;
    border-radius: 10px;
    width: 100%;
    max-width: 840px;
    max-height: 92vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
  }
  .modal-header-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    background: var(--notika-green);
    color: #ffffff;
    border-bottom: 1px solid var(--notika-green-dark);
  }
  .modal-header-custom .header-info {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .modal-header-custom .icon {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    background: rgba(255,255,255,0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .modal-header-custom .icon svg {
    width: 22px;
    height: 22px;
    stroke: #ffffff;
  }
  .modal-header-custom .titles {
    flex: 1;
  }
  .modal-header-custom h3 {
    margin: 0;
    font-size: 18px;
    color: #ffffff;
    font-weight: 700;
  }
  .modal-header-custom p {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: rgba(255,255,255,0.85);
  }
  .btn-back {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.3);
    padding: 7px 16px;
    border-radius: 6px;
    font-size: 13.5px;
    font-weight: 600;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .btn-back:hover {
    background: rgba(255,255,255,0.28);
  }

  .modal-body-custom {
    padding: 24px;
    overflow-y: auto;
    background: #f8fafc;
  }
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px 20px;
  }
  .form-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .form-field.full {
    grid-column: 1 / -1;
  }
  .form-field label {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--ui-text-main);
  }
  .form-field label .req {
    color: var(--ui-red);
    margin-left: 2px;
  }
  .form-field select, 
  .form-field input {
    border: 1px solid var(--ui-border);
    border-radius: 6px;
    padding: 9px 13px;
    font-size: 14px;
    font-family: inherit;
    color: var(--ui-text-main);
    background: #ffffff;
    transition: all 0.15s ease;
  }
  .form-field select:focus, 
  .form-field input:focus {
    outline: none;
    border-color: var(--notika-green);
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2);
  }
  .form-field input[readonly] {
    background: #f1f5f9;
    color: var(--ui-text-main);
    font-weight: 700;
  }
  .field-hint {
    font-size: 12.5px;
    color: var(--ui-text-subtle);
  }

  .modal-footer-custom {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 16px 24px;
    border-top: 1px solid var(--ui-border-light);
    background: #ffffff;
  }
  .btn-secondary {
    background: #ffffff;
    border: 1px solid var(--ui-border);
    color: var(--ui-text-main);
    padding: 9px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .btn-secondary:hover {
    background: #f8fafc;
    border-color: #94a3b8;
  }
  .btn-primary {
    background: var(--notika-green);
    border: none;
    color: #ffffff;
    padding: 9px 24px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background 0.15s ease;
    box-shadow: 0 1px 2px rgba(0, 194, 146, 0.2);
  }
  .btn-primary:hover {
    background: var(--notika-green-dark);
  }
  .btn-primary svg {
    width: 16px;
    height: 16px;
  }
  .btn-danger {
    background: var(--ui-red);
    border: none;
    color: #ffffff;
    padding: 9px 22px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s ease;
  }
  .btn-danger:hover {
    background: #b91c1c;
  }

  /* Standar Harga Button */
  .btn-tarik-standar {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--notika-green-dark);
    color: #ffffff;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s ease;
  }
  .btn-tarik-standar:hover {
    background: #00897b;
  }

  /* ---------- Custom confirm dialog ---------- */
  .confirm-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    z-index: 1100;
  }
  .confirm-overlay.hidden {
    display: none;
  }
  .confirm-box {
    background: #ffffff;
    border-radius: 10px;
    width: 100%;
    max-width: 440px;
    padding: 28px 26px 24px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  }
  .confirm-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--ui-red-light);
    color: var(--ui-red);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
  }
  .confirm-icon svg {
    width: 26px;
    height: 26px;
  }
  .confirm-box h4 {
    margin: 0 0 8px;
    font-size: 18px;
    color: var(--ui-text-main);
    font-weight: 700;
  }
  .confirm-box p {
    margin: 0 0 24px;
    font-size: 14px;
    color: var(--ui-text-muted);
    line-height: 1.5;
  }
  .confirm-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
  }
  .confirm-actions button {
    flex: 1;
  }

  /* Modal Standar Harga Picker */
  .picker-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 85px 16px 40px;
    z-index: 999999 !important;
    overflow-y: auto;
  }
  .picker-overlay.hidden {
    display: none;
  }
  .picker-modal {
    background: #ffffff;
    border-radius: 10px;
    width: 100%;
    max-width: 1080px;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
  }
  .picker-tabs {
    display: flex;
    gap: 8px;
    border-bottom: 2px solid var(--ui-border-light);
    padding: 14px 24px 0;
    background: #ffffff;
  }
  .picker-tab {
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 700;
    border: none;
    background: transparent;
    color: var(--ui-text-muted);
    cursor: pointer;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    transition: all 0.15s ease;
  }
  .picker-tab.active {
    color: var(--notika-green);
    border-bottom-color: var(--notika-green);
  }

  @media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .form-grid { grid-template-columns: 1fr; }
    .context-row { flex-wrap: wrap; }
    .context-row .label { width: 100%; margin-bottom: 4px; }
    .context-row .colon { display: none; }
    .context-row .control-wrap { width: 100%; }
  }
</style>

<div class="main-content">
<div class="app">

  <!-- Professional Page Header -->
  <div class="page-header">
    <div class="page-header-left">
      <div>
        <h1>Rincian Belanja Sub Kegiatan</h1>
        <p>Pengelolaan rincian belanja berjenjang per Sub Kegiatan, Rekening/Akun, dan komponen belanja daerah.</p>
      </div>
    </div>
  </div>

  <!-- Context Card (Parameter & Konteks Belanja) -->
  <div class="card context-card">
    <div class="card-header-simple">
      <div class="card-header-title">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
        </svg>
        <span>Parameter & Konteks Belanja</span>
      </div>
      <span class="card-header-desc">Pilih tingkatan struktur belanja untuk menampilkan data rincian</span>
    </div>
    <div class="card-body">
      <div class="context-grid">
        <div class="context-row">
          <div class="label">Tahun</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <select id="ctxTahun" class="font-mono">
              <?php if (!empty($ListTahun)): ?>
                <?php foreach ($ListTahun as $y): ?>
                  <option value="<?= $y ?>" <?= ($y == $TahunAktif) ? 'selected' : '' ?>><?= $y ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="context-row">
          <div class="label">Perangkat Daerah</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <?php if (empty($IsRole4) && !empty($ListInstansi)): ?>
              <select id="ctxInstansiSelect">
                <?php foreach ($ListInstansi as $inst): ?>
                  <option value="<?= $inst['id'] ?>" <?= ($inst['id'] == $ActiveInstansiId) ? 'selected' : '' ?>>
                    <?= html_escape($inst['nama']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <input type="hidden" id="ctxPerangkatDaerah" value="<?= html_escape($CurrentInstansi ? $CurrentInstansi['nama'] : '') ?>">
            <?php else: ?>
              <input id="ctxPerangkatDaerah" class="context-readonly" readonly value="<?= html_escape($CurrentInstansi ? $CurrentInstansi['nama'] : 'PERANGKAT DAERAH') ?>" placeholder="Perangkat Daerah">
              <input type="hidden" id="ctxInstansiSelect" value="<?= $ActiveInstansiId ?: '' ?>">
            <?php endif; ?>
          </div>
        </div>
        <div class="context-row">
          <div class="label">Sub Unit</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <select id="ctxSubUnit"></select>
          </div>
        </div>
        <div class="context-row">
          <div class="label">Bidang Urusan</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <select id="ctxBidangUrusan"></select>
          </div>
        </div>
        <div class="context-row">
          <div class="label">Program</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <select id="ctxProgram"></select>
          </div>
        </div>
        <div class="context-row">
          <div class="label">Kegiatan</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <select id="ctxKegiatan"></select>
          </div>
        </div>
        <div class="context-row">
          <div class="label">Sub Kegiatan</div>
          <div class="colon">:</div>
          <div class="control-wrap">
            <select id="ctxSubKegiatan"></select>
          </div>
        </div>
      </div>
    </div>
    <div class="context-hint" id="contextHint"></div>
  </div>

  <!-- Table card -->
  <div class="card">
    <div class="table-toolbar">
      <div>
        <h2>Tabel Rincian Belanja</h2>
        <p id="toolbarContext">Lengkapi pilihan Sub Unit sampai Sub Kegiatan terlebih dahulu.</p>
      </div>
      <?php if (!empty($IsRole4)): ?>
        <button class="btn-add" id="btnTambah" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          Tambah Rincian
        </button>
      <?php endif; ?>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th rowspan="2" style="width:160px;">Kode Rekening</th>
            <th rowspan="2">Uraian</th>
            <th colspan="4" class="center">Rincian Perhitungan</th>
            <th rowspan="2" style="width:90px;" class="center">Aksi</th>
          </tr>
          <tr class="sub-head">
            <th class="num" style="width:120px;">Koefisien</th>
            <th class="num" style="width:140px;">Harga Satuan</th>
            <th class="center" style="width:65px;">PPN</th>
            <th class="num" style="width:150px;">Jumlah</th>
          </tr>
        </thead>
        <tbody id="tableBody"></tbody>
        <tfoot>
          <tr>
            <td colspan="10" class="label">Jumlah Total</td>
            <td class="num" id="grandTotal"><span class="money-cell"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
</div>

<!-- Modal Form -->
<div class="modal-overlay hidden" id="modalOverlay">
  <div class="modal-custom">
    <div class="modal-header-custom">
      <div class="header-info">
        <div class="icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-4"/><rect x="9" y="1" width="6" height="4" rx="1"/><path d="M9 12h6"/><path d="M9 16h6"/></svg>
        </div>
        <div class="titles">
          <h3 id="modalTitle">Tambah Rincian Sub Kegiatan</h3>
          <p>Lengkapi informasi rincian belanja untuk sub kegiatan.</p>
        </div>
      </div>
      <button class="btn-back" id="btnBack" type="button">&larr; Kembali</button>
    </div>
    <div class="modal-body-custom">
      <div class="form-grid">

        <div class="form-field full">
          <label>Objek Belanja <span class="req">*</span></label>
          <select id="fObjekBelanja">
            <option>Belanja Pegawai</option>
            <option selected>Belanja Barang Jasa dan Modal</option>
            <option>Belanja Modal</option>
          </select>
        </div>

        <div class="form-field full">
          <label>Rekening / Akun <span class="req">*</span></label>
          <select id="fRekeningAkun"></select>
        </div>

        <div class="form-field">
          <label>Pengelompokan Belanja / Paket Pekerjaan <span class="req">*</span></label>
          <select id="fPengelompokanTipe">
            <option>Pengelompokan Belanja</option>
            <option>Paket Pekerjaan</option>
          </select>
        </div>

        <div class="form-field">
          <label>Uraian Pengelompokan Belanja / Paket Pekerjaan</label>
          <input id="fUraianPengelompokan" list="uraianList" placeholder="Pilih atau masukkan uraian (opsional)">
          <datalist id="uraianList"></datalist>
        </div>

        <div class="form-field">
          <label>Sumber Dana</label>
          <select id="fSumberDana">
            <option value="">Pilih sumber dana (opsional)</option>
            <option>Pendapatan Bagi Hasil</option>
            <option>Dana Alokasi Umum (DAU)</option>
            <option>Dana Alokasi Khusus (DAK)</option>
            <option>Pendapatan Asli Daerah (PAD)</option>
          </select>
        </div>

        <div class="form-field">
          <label>Jenis Standar Harga</label>
          <div style="display:flex; gap:6px;">
            <select id="fJenisStandarHarga" style="flex:1;">
              <option value="">Pilih jenis standar harga</option>
              <option>Harga Satuan Pokok Kegiatan (HSPK)</option>
              <option>Analisis Standar Belanja (ASB)</option>
              <option>Standar Satuan Harga (SSH)</option>
              <option>Standar Harga Satuan Regional</option>
              <option>E-Katalog</option>
              <option>Survey Harga Pasar</option>
            </select>
            <button type="button" class="btn-tarik-standar" id="btnOpenStandarPicker" title="Tarik dari database HSPK/ASB">
              <i class="fa fa-database"></i> Tarik
            </button>
          </div>
        </div>

        <div class="form-field">
          <label>Komponen <span class="req">*</span></label>
          <input id="fKomponen" list="komponenList" placeholder="Nama komponen / barang">
          <datalist id="komponenList"></datalist>
        </div>

        <div class="form-field">
          <label>Spesifikasi Komponen</label>
          <input id="fSpesifikasi" placeholder="Masukkan spesifikasi komponen (opsional)">
        </div>

        <div class="form-field">
          <label>Satuan <span class="req">*</span></label>
          <select id="fSatuan">
            <option value="">Pilih satuan</option>
            <option>Buah</option><option>Pak</option><option>Kotak</option><option>Rim</option>
            <option>Lembar</option><option>Unit</option><option>Paket</option><option>Set</option>
            <option>M2</option><option>Ls</option><option>Botol</option><option>Dus</option>
            <option>Orang</option><option>Bulan</option><option>Hari</option>
          </select>
        </div>

        <div class="form-field">
          <label>Harga Satuan <span class="req">*</span></label>
          <input id="fHargaSatuan" type="number" min="0" step="1" placeholder="Masukkan harga satuan" class="font-mono">
        </div>

        <div class="form-field">
          <label>PPN (%)</label>
          <input id="fPPN" type="number" min="0" step="0.1" placeholder="0" value="0" class="font-mono">
        </div>

        <div class="form-field">
          <label>Keterangan</label>
          <input id="fKeterangan" placeholder="Masukkan keterangan (opsional)">
        </div>

        <div class="form-field">
          <label>Koefisien (Perkalian) <span class="req">*</span></label>
          <input id="fKoefisien" type="number" min="0" step="1" placeholder="Masukkan koefisien (perkalian)" class="font-mono">
        </div>

        <div class="form-field">
          <label>Volume</label>
          <input id="fVolume" type="number" min="0" step="1" placeholder="1" value="1" class="font-mono">
        </div>

        <div class="form-field full">
          <label>Koefisien (Keterangan Jumlah)</label>
          <input id="fKoefisienKeterangan" placeholder="Masukkan koefisien (keterangan jumlah)">
        </div>

        <div class="form-field full">
          <label>Total Belanja</label>
          <input id="fTotalBelanja" readonly value="Rp 0,00" class="font-mono" style="font-size: 15px; color: var(--ui-text-main); font-weight:700; background:#f1f5f9;">
        </div>

      </div>
    </div>
    <div class="modal-footer-custom">
      <button class="btn-secondary" id="btnReset" type="button">Reset</button>
      <button class="btn-primary" id="btnSimpan" type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Data
      </button>
    </div>
  </div>
</div>

<!-- Modal Picker Standar Harga (HSPK / ASB) -->
<div class="picker-overlay hidden" id="pickerOverlay">
  <div class="picker-modal">
    <div class="modal-header-custom" style="padding: 16px 24px;">
      <div class="header-info">
        <div class="icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
        </div>
        <div class="titles">
          <h3 style="margin:0; font-size:16px;">Tarik Data Standar Harga Daerah</h3>
          <p style="margin:2px 0 0; font-size:12.5px; color:rgba(255,255,255,0.75);">Pilih item standar harga dari database HSPK atau ASB.</p>
        </div>
      </div>
      <button class="btn-back" id="btnClosePicker" type="button">&times; Tutup</button>
    </div>
    
    <div class="picker-tabs">
      <button type="button" class="picker-tab active" data-type="hspk">HSPK (Harga Satuan Pokok Kegiatan)</button>
      <button type="button" class="picker-tab" data-type="asb">ASB (Analisis Standar Belanja)</button>
    </div>

    <div style="padding: 14px 24px; display:flex; gap:10px; background:#ffffff;">
      <input type="text" id="inputSearchStandar" placeholder="Cari nama barang / uraian / spesifikasi..." style="flex:1; border:1px solid var(--ui-border); border-radius:6px; padding:9px 13px; font-size:14px;">
      <button type="button" class="btn-primary" id="btnDoSearchStandar" style="padding:9px 20px;">Cari</button>
    </div>

    <div style="padding: 0 24px 20px; overflow-y:auto; flex:1; background:#ffffff;">
      <div class="table-wrap" style="border:1px solid var(--ui-border-light); border-radius:6px;">
        <table>
          <thead>
            <tr>
              <th style="width:140px;">Kode Barang</th>
              <th>Uraian Barang & Spesifikasi</th>
              <th class="center" style="width:75px;">Satuan</th>
              <th class="num" style="width:140px;">Harga Satuan</th>
              <th style="width:140px;">Kode Rekening</th>
              <th class="center" style="width:70px;">Pilih</th>
            </tr>
          </thead>
          <tbody id="pickerTableBody">
            <tr><td colspan="6" class="center" style="padding:24px; color:var(--ui-text-muted);">Memuat standar harga...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Custom Confirm Dialog -->
<div class="confirm-overlay hidden" id="confirmOverlay">
  <div class="confirm-box">
    <div class="confirm-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>
    </div>
    <h4 id="confirmTitle">Hapus Rincian Belanja</h4>
    <p id="confirmMessage">Apakah Anda yakin ingin menghapus rincian ini?</p>
    <div class="confirm-actions">
      <button class="btn-secondary" id="confirmCancel" type="button">Batal</button>
      <button class="btn-danger" id="confirmOk" type="button">Ya, Hapus</button>
    </div>
  </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
(function(){
  "use strict";

  var BaseURL = '<?= base_url() ?>';
  var controllerName = '<?= isset($ControllerName) ? $ControllerName : $this->router->fetch_class() ?>';
  var ControllerURL = BaseURL + controllerName + '/';
  var rawBelanjaHeaders = <?= json_encode(!empty($BelanjaData) ? $BelanjaData : []) ?>;
  var initialSubUnits = <?= json_encode(!empty($SubUnits) ? $SubUnits : []) ?>;
  var currentInstansi = <?= json_encode(!empty($CurrentInstansi) ? $CurrentInstansi : null) ?>;
  var isRole4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;
  var activeInstansiId = <?= json_encode($ActiveInstansiId) ?>;

  /* ---------------- Master data ---------------- */
  var NODE_NAMES = {
    "5": "BELANJA DAERAH",
    "5.1": "BELANJA OPERASI",
    "5.1.01": "Belanja Pegawai",
    "5.1.02": "Belanja Barang dan Jasa",
    "5.1.02.01": "Belanja Barang",
    "5.1.02.01.001": "Belanja Barang Pakai Habis",
    "5.1.02.02": "Belanja Jasa",
    "5.1.02.02.001": "Belanja Jasa Kantor",
    "5.1.02.03": "Belanja Pemeliharaan",
    "5.1.02.04": "Belanja Perjalanan Dinas",
    "5.2": "BELANJA MODAL",
    "5.2.01": "Belanja Modal Tanah",
    "5.2.02": "Belanja Modal Peralatan dan Mesin",
    "5.2.03": "Belanja Modal Gedung dan Bangunan",
    "5.2.04": "Belanja Modal Jalan, Jaringan, dan Irigasi"
  };

  var REKENING_OPTIONS = [];
  var MASTER = {
    subUnit: [],
    bidangUrusan: [],
    program: [],
    kegiatan: [],
    subKegiatan: []
  };

  /* ---------------- State ---------------- */
  var items = [];
  var collapsedSet = new Set();
  var editingItem = null;
  var currentSubKegiatanKode = null;
  var currentPickerType = 'hspk';

  /* ---------------- Init Master Data from Database ---------------- */
  function buildMasterFromDatabase() {
    var allItems = [];

    $.each(rawBelanjaHeaders, function(idx, h) {
      var skKode = h.kode_sub_kegiatan || ('5.01.02.2.03.' + String(idx + 1).padStart(2, '0'));

      // Convert nested rekening and rincian into items list
      if (h.rekening && h.rekening.length > 0) {
        $.each(h.rekening, function(rIdx, rek) {
          if (rek.rincian && rek.rincian.length > 0) {
            $.each(rek.rincian, function(iIdx, rinc) {
              allItems.push({
                id: parseInt(rinc.id, 10),
                headerId: h.id,
                rekeningId: rek.id,
                subKegiatanKode: skKode,
                objekBelanja: "Belanja Barang Jasa dan Modal",
                rekeningKode: rek.kode_rekening,
                rekeningNama: rek.uraian_rekening,
                pengelompokanTipe: "Pengelompokan Belanja",
                uraianPengelompokan: rinc.uraian || deriveGroupLabel(rek.kode_rekening),
                sumberDana: rinc.sumber_dana || "",
                jenisStandarHarga: rinc.jenis_standar_harga || "",
                komponen: rinc.komponen || rinc.uraian || "",
                spesifikasi: rinc.spesifikasi_komponen || "",
                satuan: rinc.satuan || "Unit",
                hargaSatuan: parseFloat(rinc.harga_satuan) || 0,
                keterangan: rinc.keterangan || "",
                koefisien: parseFloat(rinc.koefisien) || 1,
                volume: parseFloat(rinc.koefisien_volume) || 1,
                koefisienKeterangan: (rinc.koefisien || 1) + " " + (rinc.satuan || "Unit"),
                ppn: parseFloat(rinc.ppn) || 0
              });
            });
          }
        });
      }
    });

    items = allItems;
  }

  /* ---------------- Helpers ---------------- */
  function rupiah(n){
    n = n || 0;
    return "Rp " + n.toLocaleString("id-ID",{minimumFractionDigits:2,maximumFractionDigits:2});
  }
  function formatMoney(n){
    n = n || 0;
    var numStr = n.toLocaleString("id-ID",{minimumFractionDigits:2,maximumFractionDigits:2});
    return '<span class="money-cell"><span class="cur">Rp</span><span class="val">' + numStr + '</span></span>';
  }
  function calcJumlah(it){
    var koef = parseFloat(it.koefisien)||0;
    var vol = parseFloat(it.volume)||1;
    var harga = parseFloat(it.hargaSatuan)||0;
    var ppn = parseFloat(it.ppn)||0;
    var subtotal = koef*vol*harga;
    return subtotal + subtotal*(ppn/100);
  }
  function compareCode(a,b){
    var pa=a.split(".").map(Number), pb=b.split(".").map(Number);
    var len=Math.max(pa.length,pb.length);
    for(var i=0;i<len;i++){
      var x=pa[i]===undefined?0:pa[i], y=pb[i]===undefined?0:pb[i];
      if(x!==y) return x-y;
    }
    return 0;
  }
  function esc(s){
    return String(s==null?"":s).replace(/[&<>"']/g,function(c){
      return {"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c];
    });
  }
  function groupBy(arr, keyFn){
    var map = {}, order = [];
    arr.forEach(function(it){
      var k = keyFn(it);
      if(!map[k]){ map[k]=[]; order.push(k); }
      map[k].push(it);
    });
    return {map:map, order:order};
  }
  function findRekening(kode){
    for(var i=0;i<REKENING_OPTIONS.length;i++){ if(REKENING_OPTIONS[i].kode===kode) return REKENING_OPTIONS[i]; }
    return null;
  }
  function deriveGroupLabel(kode){
    var r = findRekening(kode);
    var nama = r ? r.nama : (NODE_NAMES[kode] || kode);
    var parts = nama.split("-");
    return parts.length>1 ? parts[parts.length-1].trim() : nama;
  }

  /* ---------------- Tree build ---------------- */
  function buildTree(itemsArr){
    var root = {code:null, children:{}, order:[]};
    itemsArr.forEach(function(it){
      var parts = it.rekeningKode.split(".");
      var node = root, acc=[];
      parts.forEach(function(p){
        acc.push(p);
        var code = acc.join(".");
        if(!node.children[code]){
          node.children[code] = {code:code, children:{}, order:[], items:[]};
          node.order.push(code);
        }
        node = node.children[code];
      });
      node.items.push(it);
    });
    return root;
  }
  function sumNode(node){
    var total = 0;
    (node.items||[]).forEach(function(it){ total += calcJumlah(it); });
    Object.keys(node.children).forEach(function(c){ total += sumNode(node.children[c]); });
    return total;
  }

  /* ---------------- Icons ---------------- */
  var ICON_CHEVRON = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>';
  var ICON_EDIT = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"/></svg>';
  var ICON_DEL = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>';
  var ICON_EMPTY = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-4"/><rect x="9" y="1" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h6"/></svg>';

  function toggleBtn(key, collapsed, hasChildren){
    if(!hasChildren) return '<span class="toggle" style="visibility:hidden;">'+ICON_CHEVRON+'</span>';
    return '<span class="toggle'+(collapsed?" collapsed":"")+'" data-toggle="'+esc(key)+'">'+ICON_CHEVRON+'</span>';
  }

  /* ---------------- Row renderers ---------------- */
  function levelRow(code, name, level, total, hasChildren){
    var collapsed = collapsedSet.has(code);
    var pad = 10 + (level-1)*18;
    return '<tr class="row-lvl'+level+'">'+
      '<td class="font-mono">'+esc(code)+'</td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(code,collapsed,hasChildren)+'<span class="txt">'+esc(name)+'</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      '<td></td>'+
    '</tr>';
  }
  function accountRow(code, name, level, total, hasChildren){
    var collapsed = collapsedSet.has(code);
    var pad = 10 + (level-1)*18;
    return '<tr class="row-account">'+
      '<td class="font-mono">'+esc(code)+'</td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(code,collapsed,hasChildren)+'<span class="txt">'+esc(name)+'</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      '<td></td>'+
    '</tr>';
  }
  function groupRow(key, label, sumberDana, level, total, hasChildren){
    var collapsed = collapsedSet.has(key);
    var pad = 10 + (level-1)*18;
    return '<tr class="row-group">'+
      '<td></td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(key,collapsed,hasChildren)+
        '<span class="txt"><span class="tag">[ # ] '+esc(label)+'</span>'+
        (sumberDana ? '<span class="sub-label">Sumber Dana: '+esc(sumberDana)+'</span>' : '')+
        '</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      '<td></td>'+
    '</tr>';
  }
  function subgroupRow(key, label, level, total, hasChildren){
    var collapsed = collapsedSet.has(key);
    var pad = 10 + (level-1)*18;
    return '<tr class="row-subgroup">'+
      '<td></td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(key,collapsed,hasChildren)+'<span class="txt">[ - ] '+esc(label)+'</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      '<td></td>'+
    '</tr>';
  }
  function itemRow(it, level){
    var pad = 10 + (level-1)*18;
    return '<tr class="row-item">'+
      '<td></td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+
        '<span class="toggle" style="visibility:hidden;">'+ICON_CHEVRON+'</span>'+
        '<span class="txt"><span class="komponen">'+esc(it.komponen)+'</span>'+
        (it.spesifikasi ? '<span class="spesifikasi">Spesifikasi: '+esc(it.spesifikasi)+'</span>' : '')+
        (it.keterangan ? '<span class="keterangan">'+esc(it.keterangan)+'</span>' : '')+
        '</span></div></td>'+
      '<td class="num font-mono">'+esc(it.koefisien)+' '+esc(it.satuan)+'</td>'+
      '<td class="num">'+formatMoney(it.hargaSatuan)+'</td>'+
      '<td class="center font-mono">'+(parseFloat(it.ppn)||0)+'%</td>'+
      '<td class="num" style="font-weight:700;">'+formatMoney(calcJumlah(it))+'</td>'+
      '<td class="center">' + (isRole4 ? ('<div class="actions">'+
        '<button class="icon-btn edit" data-edit="'+it.id+'" title="Ubah">'+ICON_EDIT+'</button>'+
        '<button class="icon-btn del" data-del="'+it.id+'" title="Hapus">'+ICON_DEL+'</button>'+
      '</div>') : '<span style="color:#94a3b8; font-size:12px;">-</span>') + '</td>'+
    '</tr>';
  }

  /* ---------------- Main render ---------------- */
  function renderLevelNode(code, node, level, hidden, out){
    var name = NODE_NAMES[code] || (findRekening(code)? findRekening(code).nama : code);
    var total = sumNode(node);
    var isAccount = !!findRekening(code) || (code.split('.').length >= 6);
    var hasChildren = node.order.length>0 || node.items.length>0;
    if(!hidden){
      out.push(isAccount ? accountRow(code,name,level,total,hasChildren) : levelRow(code,name,level,total,hasChildren));
    }
    var isCollapsed = collapsedSet.has(code);
    var childHidden = hidden || isCollapsed;

    var childCodes = node.order.slice().sort(compareCode);
    childCodes.forEach(function(cc){
      renderLevelNode(cc, node.children[cc], level+1, childHidden, out);
    });
    if(node.items.length>0){
      renderItemGroups(code, node.items, level+1, childHidden, out);
    }
  }

  function renderItemGroups(accountCode, itemsArr, level, hidden, out){
    var autoLabel = deriveGroupLabel(accountCode);
    var bySD = groupBy(itemsArr, function(it){ return it.sumberDana || "-"; });
    bySD.order.forEach(function(sd){
      var sdItems = bySD.map[sd];
      var sdKey = accountCode+"::SD::"+sd;
      var sdCollapsed = collapsedSet.has(sdKey);
      var sdTotal = sdItems.reduce(function(s,it){return s+calcJumlah(it);},0);
      if(!hidden){
        out.push(groupRow(sdKey, autoLabel, sd==="-"?"":sd, level, sdTotal, true));
      }
      var urHidden = hidden || sdCollapsed;

      var byUR = groupBy(sdItems, function(it){ return it.uraianPengelompokan || autoLabel; });
      byUR.order.forEach(function(ur){
        var urItems = byUR.map[ur];
        var urKey = sdKey+"::UR::"+ur;
        var urCollapsed = collapsedSet.has(urKey);
        var urTotal = urItems.reduce(function(s,it){return s+calcJumlah(it);},0);
        if(!urHidden){
          out.push(subgroupRow(urKey, ur, level+1, urTotal, true));
        }
        var itHidden = urHidden || urCollapsed;
        if(!itHidden){
          urItems.forEach(function(it){ out.push(itemRow(it, level+2)); });
        }
      });
    });
  }

  function render(){
    var tbody = document.getElementById("tableBody");
    var visibleItems = items.filter(function(it){ return it.subKegiatanKode===currentSubKegiatanKode; });

    if(!currentSubKegiatanKode){
      tbody.innerHTML = '<tr><td colspan="7"><div class="empty-state">'+ICON_EMPTY+
        '<p>Pilih Sub Unit, Bidang Urusan, Program, Kegiatan dan Sub Kegiatan di atas terlebih dahulu untuk menampilkan rincian belanja.</p></div></td></tr>';
      document.getElementById("grandTotal").innerHTML = formatMoney(0);
      refreshDatalists(visibleItems);
      return;
    }

    var tree = buildTree(visibleItems);
    var out = [];
    var rootCodes = tree.order.slice().sort(compareCode);
    rootCodes.forEach(function(code){
      renderLevelNode(code, tree.children[code], 1, false, out);
    });

    if(out.length===0){
      tbody.innerHTML = '<tr><td colspan="7"><div class="empty-state">'+ICON_EMPTY+
        '<p>Belum ada rincian belanja untuk Sub Kegiatan ini. Klik <strong>+ Tambah Rincian</strong> untuk menambahkan.</p></div></td></tr>';
    } else {
      tbody.innerHTML = out.join("");
    }

    var grand = visibleItems.reduce(function(s,it){return s+calcJumlah(it);},0);
    document.getElementById("grandTotal").innerHTML = formatMoney(grand);

    refreshDatalists(visibleItems);
  }

  function refreshDatalists(scopeItems){
    var uraianSet = new Set(), komponenSet = new Set();
    (scopeItems||items).forEach(function(it){
      if(it.uraianPengelompokan) uraianSet.add(it.uraianPengelompokan);
      if(it.komponen) komponenSet.add(it.komponen);
    });
    document.getElementById("uraianList").innerHTML = Array.from(uraianSet).map(function(v){ return '<option value="'+esc(v)+'">'; }).join("");
    document.getElementById("komponenList").innerHTML = Array.from(komponenSet).map(function(v){ return '<option value="'+esc(v)+'">'; }).join("");
  }

  /* ---------------- Modal Form Logic ---------------- */
  var overlay = document.getElementById("modalOverlay");
  var f = {
    objek: document.getElementById("fObjekBelanja"),
    rekening: document.getElementById("fRekeningAkun"),
    tipe: document.getElementById("fPengelompokanTipe"),
    uraian: document.getElementById("fUraianPengelompokan"),
    sumberDana: document.getElementById("fSumberDana"),
    jsh: document.getElementById("fJenisStandarHarga"),
    komponen: document.getElementById("fKomponen"),
    spesifikasi: document.getElementById("fSpesifikasi"),
    satuan: document.getElementById("fSatuan"),
    harga: document.getElementById("fHargaSatuan"),
    ppn: document.getElementById("fPPN"),
    keterangan: document.getElementById("fKeterangan"),
    koefisien: document.getElementById("fKoefisien"),
    volume: document.getElementById("fVolume"),
    koefKet: document.getElementById("fKoefisienKeterangan"),
    total: document.getElementById("fTotalBelanja")
  };

  function loadMasterRekening() {
    $.ajax({
      url: ControllerURL + "GetMasterRekening",
      type: "POST",
      dataType: "json",
      success: function(res) {
        if (res.status === 'success' && res.data && res.data.length > 0) {
          REKENING_OPTIONS = res.data.map(function(r) {
            return { kode: r.kode_rekening, nama: r.nama_rekening };
          });
        }
        if (REKENING_OPTIONS.length === 0) {
          REKENING_OPTIONS = [
            {kode:"5.1.02.01.001.0024", nama:"Belanja Alat/Bahan untuk Kegiatan Kantor - Alat Tulis Kantor"},
            {kode:"5.1.02.01.001.0025", nama:"Belanja Alat/Bahan untuk Kegiatan Kantor - Kertas dan Cover"},
            {kode:"5.1.02.01.001.0026", nama:"Belanja Alat/Bahan untuk Kegiatan Kantor - Bahan Cetak"},
            {kode:"5.1.02.01.001.0027", nama:"Belanja Alat/Bahan untuk Kegiatan Kantor - Bahan Komputer"},
            {kode:"5.1.02.02.001.0031", nama:"Belanja Jasa Kantor - Jasa Kebersihan"},
            {kode:"5.1.02.03.002.00492", nama:"Belanja Pemeliharaan Rambu dan Marka Jalan"},
            {kode:"5.2.03.01.001.00001", nama:"Belanja Modal Bangunan Gedung Kantor"}
          ];
        }
        populateRekeningSelect();
      }
    });
  }

  function populateRekeningSelect(){
    f.rekening.innerHTML = REKENING_OPTIONS.map(function(r){
      return '<option value="'+esc(r.kode)+'">'+esc(r.kode)+' '+esc(r.nama)+'</option>';
    }).join("");
  }

  function openModal(item){
    editingItem = item || null;
    document.getElementById("modalTitle").textContent = item ? "Ubah Rincian Sub Kegiatan" : "Tambah Rincian Sub Kegiatan";
    if(item){
      f.objek.value = item.objekBelanja || "Belanja Barang Jasa dan Modal";
      f.rekening.value = item.rekeningKode;
      f.tipe.value = item.pengelompokanTipe || "Pengelompokan Belanja";
      f.uraian.value = item.uraianPengelompokan || "";
      f.sumberDana.value = item.sumberDana || "";
      f.jsh.value = item.jenisStandarHarga || "";
      f.komponen.value = item.komponen || "";
      f.spesifikasi.value = item.spesifikasi || "";
      f.satuan.value = item.satuan || "";
      f.harga.value = item.hargaSatuan || "";
      f.ppn.value = item.ppn || 0;
      f.keterangan.value = item.keterangan || "";
      f.koefisien.value = item.koefisien || "";
      f.volume.value = item.volume || 1;
      f.koefKet.value = item.koefisienKeterangan || "";
    } else {
      resetForm();
    }
    updateTotalPreview();
    overlay.classList.remove("hidden");
  }
  function closeModal(){
    overlay.classList.add("hidden");
    editingItem = null;
  }
  function resetForm(){
    f.objek.value = "Belanja Barang Jasa dan Modal";
    if(f.rekening.options.length) f.rekening.selectedIndex = 0;
    f.tipe.value = "Pengelompokan Belanja";
    f.uraian.value = "";
    f.sumberDana.value = "";
    f.jsh.value = "";
    f.komponen.value = "";
    f.spesifikasi.value = "";
    f.satuan.value = "";
    f.harga.value = "";
    f.ppn.value = 0;
    f.keterangan.value = "";
    f.koefisien.value = "";
    f.volume.value = 1;
    f.koefKet.value = "";
    updateTotalPreview();
  }
  function updateTotalPreview(){
    var harga = parseFloat(f.harga.value)||0;
    var koef = parseFloat(f.koefisien.value)||0;
    var vol = parseFloat(f.volume.value)||1;
    var ppn = parseFloat(f.ppn.value)||0;
    var sub = harga*koef*vol;
    var total = sub + sub*(ppn/100);
    f.total.value = rupiah(total);
  }
  [f.harga,f.koefisien,f.volume,f.ppn].forEach(function(el){
    el.addEventListener("input", updateTotalPreview);
  });

  function saveForm(){
    if(!f.rekening.value){ alert("Rekening / Akun wajib dipilih."); return; }
    if(!f.komponen.value.trim()){ alert("Komponen wajib diisi."); f.komponen.focus(); return; }
    if(!f.satuan.value){ alert("Satuan wajib dipilih."); f.satuan.focus(); return; }
    if(!f.harga.value || parseFloat(f.harga.value)<=0){ alert("Harga Satuan wajib diisi."); f.harga.focus(); return; }
    if(!f.koefisien.value || parseFloat(f.koefisien.value)<=0){ alert("Koefisien (Perkalian) wajib diisi."); f.koefisien.focus(); return; }

    var rOpt = findRekening(f.rekening.value);
    var sk = MASTER.subKegiatan.find(function(s){ return s.kode===currentSubKegiatanKode; });
    var su = MASTER.subUnit.find(function(s){ return s.kode===el("ctxSubUnit").value; });
    var prg = MASTER.program.find(function(p){ return p.kode===el("ctxProgram").value; });
    var keg = MASTER.kegiatan.find(function(k){ return k.kode===el("ctxKegiatan").value; });
    var bu = MASTER.bidangUrusan.find(function(b){ return b.kode===el("ctxBidangUrusan").value; });

    var pdNama = el("ctxPerangkatDaerah").value || (currentInstansi ? currentInstansi.nama : "");
    var pdKode = currentInstansi && currentInstansi.kode_instansi ? currentInstansi.kode_instansi : (su && su.kode ? su.kode.substring(0, 10) : "");
    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : (su ? su.id_instansi : 0));

    var payload = {
      rincian_id: editingItem ? editingItem.id : 0,
      sub_kegiatan_kode: currentSubKegiatanKode,
      nama_sub_kegiatan: sk ? sk.nama : "",
      tahun: el("ctxTahun").value,
      id_instansi: instId,
      kode_perangkat_daerah: pdKode,
      nama_perangkat_daerah: pdNama,
      kode_sub_unit: su ? su.kode : "",
      nama_sub_unit: su ? su.nama : "",
      kode_bidang_urusan: bu ? bu.kode : "",
      nama_bidang_urusan: bu ? bu.nama : "",
      kode_program: prg ? prg.kode : "",
      nama_program: prg ? prg.nama : "",
      kode_kegiatan: keg ? keg.kode : "",
      nama_kegiatan: keg ? keg.nama : "",
      rekening_kode: f.rekening.value,
      rekening_nama: rOpt ? rOpt.nama : "",
      rekening_level: 6,
      objek_belanja: f.objek.value,
      pengelompokan_tipe: f.tipe.value,
      uraian_pengelompokan: f.uraian.value.trim() || (rOpt ? rOpt.nama : "Belanja"),
      sumber_dana: f.sumberDana.value,
      jenis_standar_harga: f.jsh.value,
      komponen: f.komponen.value.trim(),
      spesifikasi: f.spesifikasi.value.trim(),
      satuan: f.satuan.value,
      harga_satuan: parseFloat(f.harga.value)||0,
      ppn: parseFloat(f.ppn.value)||0,
      keterangan: f.keterangan.value.trim(),
      koefisien: parseFloat(f.koefisien.value)||0,
      volume: parseFloat(f.volume.value)||1
    };

    // AJAX Save to Database
    $.ajax({
      url: ControllerURL + "SaveRincianSingleItem",
      type: "POST",
      data: payload,
      dataType: "json",
      success: function(res) {
        if (res.status === 'success') {
          var itemObj = {
            id: res.rincian_id,
            headerId: res.header_id,
            rekeningId: res.rekening_id,
            subKegiatanKode: currentSubKegiatanKode,
            objekBelanja: payload.objek_belanja,
            rekeningKode: payload.rekening_kode,
            rekeningNama: payload.rekening_nama,
            pengelompokanTipe: payload.pengelompokan_tipe,
            uraianPengelompokan: payload.uraian_pengelompokan,
            sumberDana: payload.sumber_dana,
            jenisStandarHarga: payload.jenis_standar_harga,
            komponen: payload.komponen,
            spesifikasi: payload.spesifikasi,
            satuan: payload.satuan,
            hargaSatuan: payload.harga_satuan,
            ppn: payload.ppn,
            keterangan: payload.keterangan,
            koefisien: payload.koefisien,
            volume: payload.volume,
            koefisienKeterangan: payload.koefisien + " " + payload.satuan
          };

          if (editingItem) {
            var idx = items.findIndex(function(x) { return x.id === editingItem.id; });
            if (idx > -1) items[idx] = itemObj;
          } else {
            items.push(itemObj);
          }

          closeModal();
          render();
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: res.message,
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          alert(res.message || "Gagal menyimpan data.");
        }
      },
      error: function() {
        alert("Terjadi kesalahan pada server.");
      }
    });
  }

  /* ---------------- Cascading Context Logic ---------------- */
  function el(id){ return document.getElementById(id); }
  function optionsHTML(list, labelFn, placeholder){
    var html = '<option value="">'+placeholder+'</option>';
    list.forEach(function(it){
      html += '<option value="'+esc(it.kode)+'">'+esc(it.kode)+' - '+esc(it.nama)+'</option>';
    });
    return html;
  }
  function labelFor(it){ return it.kode+' - '+it.nama; }

  function populateSubUnitOptions(){
    el("ctxSubUnit").innerHTML = optionsHTML(MASTER.subUnit, labelFor, "Pilih sub unit");
  }

  function updatePerangkatDaerah(subUnitKode){
    var pdNama = currentInstansi ? currentInstansi.nama : 'PERANGKAT DAERAH';
    if (el("ctxPerangkatDaerah")) {
      el("ctxPerangkatDaerah").value = pdNama;
    }
  }

  function updateTambahState(){
    var btn = el("btnTambah");
    var hint = el("contextHint");
    var toolbar = el("toolbarContext");
    if(currentSubKegiatanKode){
      var sk = MASTER.subKegiatan.find(function(s){ return s.kode===currentSubKegiatanKode; });
      btn.disabled = false;
      hint.className = "context-hint ok";
      hint.textContent = "Konteks siap. Sub Kegiatan aktif: " + currentSubKegiatanKode + " - " + (sk?sk.nama:"");
      toolbar.textContent = "Sub Kegiatan aktif: " + currentSubKegiatanKode + " - " + (sk?sk.nama:"");
    } else {
      btn.disabled = true;
      hint.className = "context-hint";
      hint.textContent = "Lengkapi pilihan Sub Unit \u2192 Bidang Urusan \u2192 Program \u2192 Kegiatan \u2192 Sub Kegiatan di atas sebelum mengisi rincian belanja.";
      toolbar.textContent = "Lengkapi pilihan Sub Unit sampai Sub Kegiatan terlebih dahulu.";
    }
  }

  /* ---------------- Dynamic Cascading Loaders via AJAX ---------------- */
  function loadCascadeBidangUrusan(suObj, presetVal) {
    el("ctxBidangUrusan").innerHTML = '<option value="">Memuat bidang urusan...</option>';
    el("ctxProgram").innerHTML = '<option value="">Pilih program</option>';
    el("ctxKegiatan").innerHTML = '<option value="">Pilih kegiatan</option>';
    el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun").value;

    $.ajax({
      url: ControllerURL + "GetCascadeBidangUrusan",
      type: "POST",
      data: {
        sub_unit_id: suObj ? suObj.id : 0,
        bidang_urusan_id: suObj ? suObj.bidang_urusan_id : '',
        instansi_id: instId,
        tahun: thnVal
      },
      dataType: "json",
      success: function(res) {
        var list = (res.status === 'success' && res.data) ? res.data : [];

        MASTER.bidangUrusan = list;
        el("ctxBidangUrusan").innerHTML = optionsHTML(list, labelFor, "Pilih bidang urusan");

        if (list.length > 0) {
          var targetVal = presetVal && list.some(function(x){ return x.kode === presetVal; }) ? presetVal : list[0].kode;
          el("ctxBidangUrusan").value = targetVal;
          loadCascadeProgram(targetVal);
        } else {
          render();
        }
      },
      error: function() {
        el("ctxBidangUrusan").innerHTML = '<option value="">Gagal memuat</option>';
      }
    });
  }

  function loadCascadeProgram(bidangKode, presetVal) {
    el("ctxProgram").innerHTML = '<option value="">Memuat program...</option>';
    el("ctxKegiatan").innerHTML = '<option value="">Pilih kegiatan</option>';
    el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    if (!bidangKode) {
      el("ctxProgram").innerHTML = '<option value="">Pilih program</option>';
      return;
    }

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun").value;

    $.ajax({
      url: ControllerURL + "GetCascadeProgram",
      type: "POST",
      data: {
        kode_bidang_urusan: bidangKode,
        instansi_id: instId,
        tahun: thnVal
      },
      dataType: "json",
      success: function(res) {
        var list = (res.status === 'success' && res.data) ? res.data : [];

        MASTER.program = list;
        el("ctxProgram").innerHTML = optionsHTML(list, labelFor, "Pilih program");

        if (list.length > 0) {
          var targetVal = presetVal && list.some(function(x){ return x.kode === presetVal; }) ? presetVal : list[0].kode;
          el("ctxProgram").value = targetVal;
          loadCascadeKegiatan(targetVal);
        } else {
          render();
        }
      },
      error: function() {
        el("ctxProgram").innerHTML = '<option value="">Gagal memuat</option>';
      }
    });
  }

  function loadCascadeKegiatan(progKode, presetVal) {
    el("ctxKegiatan").innerHTML = '<option value="">Memuat kegiatan...</option>';
    el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    if (!progKode) {
      el("ctxKegiatan").innerHTML = '<option value="">Pilih kegiatan</option>';
      return;
    }

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun").value;

    $.ajax({
      url: ControllerURL + "GetCascadeKegiatan",
      type: "POST",
      data: {
        kode_program: progKode,
        instansi_id: instId,
        tahun: thnVal
      },
      dataType: "json",
      success: function(res) {
        var list = (res.status === 'success' && res.data) ? res.data : [];

        MASTER.kegiatan = list;
        el("ctxKegiatan").innerHTML = optionsHTML(list, labelFor, "Pilih kegiatan");

        if (list.length > 0) {
          var targetVal = presetVal && list.some(function(x){ return x.kode === presetVal; }) ? presetVal : list[0].kode;
          el("ctxKegiatan").value = targetVal;
          loadCascadeSubKegiatan(targetVal);
        } else {
          render();
        }
      },
      error: function() {
        el("ctxKegiatan").innerHTML = '<option value="">Gagal memuat</option>';
      }
    });
  }

  function loadCascadeSubKegiatan(kegKode, presetVal) {
    el("ctxSubKegiatan").innerHTML = '<option value="">Memuat sub kegiatan...</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    if (!kegKode) {
      el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
      return;
    }

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun").value;

    $.ajax({
      url: ControllerURL + "GetCascadeSubKegiatan",
      type: "POST",
      data: {
        kode_kegiatan: kegKode,
        instansi_id: instId,
        tahun: thnVal
      },
      dataType: "json",
      success: function(res) {
        var list = (res.status === 'success' && res.data) ? res.data : [];

        MASTER.subKegiatan = list;
        
        var html = '<option value="">Pilih sub kegiatan</option>';
        list.forEach(function(it){
          var hasRincian = items.some(function(x){ return x.subKegiatanKode === it.kode; });
          var suffix = hasRincian ? ' (Ada Rincian)' : '';
          html += '<option value="' + esc(it.kode) + '">' + esc(it.kode) + ' - ' + esc(it.nama) + esc(suffix) + '</option>';
        });
        el("ctxSubKegiatan").innerHTML = html;

        if (list.length > 0) {
          var targetVal = presetVal && list.some(function(x){ return x.kode === presetVal; }) ? presetVal : list[0].kode;
          el("ctxSubKegiatan").value = targetVal;
          currentSubKegiatanKode = targetVal;
        } else {
          currentSubKegiatanKode = null;
        }
        updateTambahState();
        render();
      },
      error: function() {
        el("ctxSubKegiatan").innerHTML = '<option value="">Gagal memuat</option>';
        updateTambahState();
        render();
      }
    });
  }

  function initSubUnits(subUnitsList){
    var pdNama = currentInstansi ? currentInstansi.nama : 'PERANGKAT DAERAH';
    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);

    var list = [];
    if (subUnitsList && subUnitsList.length > 0) {
      list = subUnitsList.map(function(s) {
        return {
          id: s.id,
          kode: s.kode_sub_unit || (currentInstansi && currentInstansi.kode_instansi ? currentInstansi.kode_instansi + '.0001' : '01.0001'),
          nama: s.nama_sub_unit || 'SEKRETARIAT',
          perangkatDaerah: pdNama,
          id_instansi: s.instansi_id || instId,
          bidang_urusan_id: s.bidang_urusan_id || ''
        };
      });
    } else {
      list = [{
        id: 0,
        kode: currentInstansi && currentInstansi.kode_instansi ? currentInstansi.kode_instansi + '.0001' : '01.0001',
        nama: pdNama,
        perangkatDaerah: pdNama,
        id_instansi: instId,
        bidang_urusan_id: ''
      }];
    }

    MASTER.subUnit = list;
    populateSubUnitOptions();

    if (MASTER.subUnit.length > 0) {
      var firstSU = MASTER.subUnit[0].kode;
      el("ctxSubUnit").value = firstSU;
      updatePerangkatDaerah(firstSU);
      loadCascadeBidangUrusan(MASTER.subUnit[0]);
    } else {
      updateTambahState();
      render();
    }
  }

  function loadBelanjaByTahun(thn) {
    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : null);
    $.ajax({
      url: ControllerURL + "GetBelanjaData",
      type: "POST",
      data: { tahun: thn, instansi: instId },
      dataType: "json",
      success: function(res) {
        if (res.status === 'success') {
          rawBelanjaHeaders = res.data || [];
          buildMasterFromDatabase();
          var curSU = MASTER.subUnit.find(function(s){ return s.kode === el("ctxSubUnit").value; });
          loadCascadeBidangUrusan(curSU || MASTER.subUnit[0], el("ctxBidangUrusan").value);
        }
      }
    });
  }

  /* ---------------- Event Listeners for Parameter Controls ---------------- */
  if (el("ctxInstansiSelect") && el("ctxInstansiSelect").tagName === "SELECT") {
    el("ctxInstansiSelect").addEventListener("change", function() {
      var newInstId = this.value;
      activeInstansiId = newInstId;
      var selectedText = this.options[this.selectedIndex].text;
      if (el("ctxPerangkatDaerah")) {
        el("ctxPerangkatDaerah").value = selectedText;
      }

      $.ajax({
        url: ControllerURL + "GetSubUnitsByInstansi",
        type: "POST",
        data: { instansi_id: newInstId },
        dataType: "json",
        success: function(res) {
          if (res.status === 'success') {
            currentInstansi = res.instansi || { id: newInstId, nama: selectedText };
            initialSubUnits = res.data || [];

            $.ajax({
              url: ControllerURL + "GetBelanjaData",
              type: "POST",
              data: { tahun: el("ctxTahun").value, instansi: newInstId },
              dataType: "json",
              success: function(bRes) {
                if (bRes.status === 'success') {
                  rawBelanjaHeaders = bRes.data || [];
                  buildMasterFromDatabase();
                  initSubUnits(initialSubUnits);
                }
              }
            });
          }
        }
      });
    });
  }

  el("ctxTahun").addEventListener("change", function() {
    loadBelanjaByTahun(this.value);
  });

  el("ctxSubUnit").addEventListener("change", function(){
    var suVal = this.value;
    var suObj = MASTER.subUnit.find(function(x){ return x.kode === suVal; });
    updatePerangkatDaerah(suVal);
    loadCascadeBidangUrusan(suObj);
  });

  el("ctxBidangUrusan").addEventListener("change", function(){
    loadCascadeProgram(this.value);
  });

  el("ctxProgram").addEventListener("change", function(){
    loadCascadeKegiatan(this.value);
  });

  el("ctxKegiatan").addEventListener("change", function(){
    loadCascadeSubKegiatan(this.value);
  });

  el("ctxSubKegiatan").addEventListener("change", function(){
    currentSubKegiatanKode = this.value || null;
    updateTambahState();
    render();
  });

  /* ---------------- Standar Harga Picker ---------------- */
  var pickerOverlay = document.getElementById("pickerOverlay");

  document.getElementById("btnOpenStandarPicker").addEventListener("click", function() {
    pickerOverlay.classList.remove("hidden");
    document.getElementById("inputSearchStandar").value = "";
    loadStandarHargaItems(currentPickerType, "");
  });

  document.getElementById("btnClosePicker").addEventListener("click", function() {
    pickerOverlay.classList.add("hidden");
  });

  $('.picker-tab').click(function() {
    $('.picker-tab').removeClass('active');
    $(this).addClass('active');
    currentPickerType = $(this).data('type');
    loadStandarHargaItems(currentPickerType, document.getElementById("inputSearchStandar").value);
  });

  document.getElementById("btnDoSearchStandar").addEventListener("click", function() {
    loadStandarHargaItems(currentPickerType, document.getElementById("inputSearchStandar").value);
  });

  document.getElementById("inputSearchStandar").addEventListener("keypress", function(e) {
    if (e.which === 13) {
      e.preventDefault();
      loadStandarHargaItems(currentPickerType, this.value);
    }
  });

  function loadStandarHargaItems(type, query) {
    var $tbody = $('#pickerTableBody');
    $tbody.html('<tr><td colspan="6" class="center" style="padding:24px; color:var(--ui-text-muted);"><i class="fa fa-spinner fa-spin"></i> Memuat data...</td></tr>');

    $.ajax({
      url: ControllerURL + "GetStandarHarga",
      type: "POST",
      data: { type: type, q: query, limit: 50 },
      dataType: "json",
      success: function(res) {
        if (res.status === 'success' && res.data && res.data.length > 0) {
          var html = '';
          $.each(res.data, function(idx, it) {
            var itemJson = encodeURIComponent(JSON.stringify(it));
            html += `
              <tr>
                <td><code class="font-mono">${esc(it.kode_barang)}</code></td>
                <td>
                  <strong>${esc(it.uraian_barang)}</strong>
                  ${it.spesifikasi && it.spesifikasi !== '-' ? `<br><small style="color:var(--ui-text-muted); font-style:italic;">${esc(it.spesifikasi)}</small>` : ''}
                </td>
                <td class="center"><span class="badge" style="background:#64748b; color:#ffffff; font-size:12.5px; font-weight:600; padding:4px 8px; border-radius:4px;">${esc(it.satuan || '-')}</span></td>
                <td class="num">${formatMoney(parseFloat(it.harga_satuan)||0)}</td>
                <td><small class="font-mono" style="color:var(--ui-blue); font-weight:700; font-size:13px;">${esc(it.kode_rekening || '-')}</small></td>
                <td class="center">
                  <button type="button" class="btn-primary btn-pick-item" data-json="${itemJson}" style="padding:6px 16px; font-size:13px;">Pilih</button>
                </td>
              </tr>
            `;
          });
          $tbody.html(html);
        } else {
          $tbody.html('<tr><td colspan="6" class="center" style="padding:24px; color:var(--ui-text-muted);">Tidak ada data standar harga yang sesuai.</td></tr>');
        }
      },
      error: function() {
        $tbody.html('<tr><td colspan="6" class="center text-danger" style="padding:24px;">Gagal memuat standar harga dari server.</td></tr>');
      }
    });
  }

  $(document).on('click', '.btn-pick-item', function() {
    var raw = decodeURIComponent($(this).data('json'));
    var item = JSON.parse(raw);

    f.komponen.value = item.uraian_barang || "";
    f.spesifikasi.value = (item.spesifikasi && item.spesifikasi !== '-') ? item.spesifikasi : "";
    f.satuan.value = item.satuan || "Unit";
    f.harga.value = item.harga_satuan || 0;
    f.koefisien.value = 1;
    f.volume.value = 1;
    f.koefKet.value = "1 " + (item.satuan || "Unit");
    f.jsh.value = (currentPickerType === 'asb') ? "Analisis Standar Belanja (ASB)" : "Harga Satuan Pokok Kegiatan (HSPK)";
    
    if (item.kode_rekening) {
      var kRek = item.kode_rekening.split(',')[0].trim();
      var found = REKENING_OPTIONS.some(function(r){ return r.kode === kRek; });
      if (!found) {
        REKENING_OPTIONS.unshift({ kode: kRek, nama: item.uraian_kelompok_barang || "Belanja Rekening" });
        populateRekeningSelect();
      }
      f.rekening.value = kRek;
      f.uraian.value = item.uraian_kelompok_barang || "";
    }

    updateTotalPreview();
    pickerOverlay.classList.add("hidden");
  });

  /* ---------------- Event wiring ---------------- */
  document.getElementById("btnTambah").addEventListener("click", function(){
    if(!currentSubKegiatanKode){
      alert("Pilih Sub Unit, Bidang Urusan, Program, Kegiatan, dan Sub Kegiatan terlebih dahulu.");
      return;
    }
    openModal(null);
  });
  document.getElementById("btnBack").addEventListener("click", closeModal);
  document.getElementById("btnReset").addEventListener("click", resetForm);
  document.getElementById("btnSimpan").addEventListener("click", saveForm);
  overlay.addEventListener("click", function(e){ if(e.target===overlay) closeModal(); });
  document.addEventListener("keydown", function(e){ if(e.key==="Escape" && !overlay.classList.contains("hidden")) closeModal(); });

  document.getElementById("tableBody").addEventListener("click", function(e){
    var toggleEl = e.target.closest(".toggle[data-toggle]");
    if(toggleEl){
      var key = toggleEl.getAttribute("data-toggle");
      if(collapsedSet.has(key)) collapsedSet.delete(key); else collapsedSet.add(key);
      render();
      return;
    }
    var editEl = e.target.closest("[data-edit]");
    if(editEl){
      var id = parseFloat(editEl.getAttribute("data-edit"));
      var it = items.find(function(x){ return x.id===id; });
      if(it) openModal(it);
      return;
    }
    var delEl = e.target.closest("[data-del]");
    if(delEl){
      var did = parseFloat(delEl.getAttribute("data-del"));
      var itx = items.find(function(x){ return x.id===did; });
      if(itx){
        openConfirmDelete(did, itx.komponen);
      }
      return;
    }
  });

  /* ---------------- Custom confirm dialog (delete) ---------------- */
  var confirmOverlay = document.getElementById("confirmOverlay");
  var pendingDeleteId = null;

  function openConfirmDelete(id, komponenNama){
    pendingDeleteId = id;
    document.getElementById("confirmMessage").textContent =
      'Rincian belanja "' + komponenNama + '" akan dihapus dan tidak dapat dikembalikan. Lanjutkan?';
    confirmOverlay.classList.remove("hidden");
  }
  function closeConfirmDelete(){
    confirmOverlay.classList.add("hidden");
    pendingDeleteId = null;
  }
  document.getElementById("confirmCancel").addEventListener("click", closeConfirmDelete);
  document.getElementById("confirmOk").addEventListener("click", function(){
    if(pendingDeleteId!=null){
      var did = pendingDeleteId;
      $.ajax({
        url: ControllerURL + "DeleteRincianSingleItem",
        type: "POST",
        data: { rincian_id: did },
        dataType: "json",
        success: function(res) {
          if (res.status === 'success') {
            items = items.filter(function(x){ return x.id!==did; });
            render();
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: res.message,
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            alert(res.message || "Gagal menghapus data.");
          }
        },
        error: function() {
          alert("Terjadi kesalahan pada server.");
        }
      });
    }
    closeConfirmDelete();
  });
  confirmOverlay.addEventListener("click", function(e){ if(e.target===confirmOverlay) closeConfirmDelete(); });
  document.addEventListener("keydown", function(e){
    if(e.key==="Escape" && !confirmOverlay.classList.contains("hidden")) closeConfirmDelete();
  });

  /* ---------------- Initialization ---------------- */
  buildMasterFromDatabase();
  loadMasterRekening();
  initSubUnits(initialSubUnits);
})();
</script>
</body>
</html>