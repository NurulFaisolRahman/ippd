<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto:wght@400;500;700&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

  /* ---------- Select2 Searchable Dropdown Styling for Modal ---------- */
  .modal-overlay .select2-container {
    width: 100% !important;
  }
  .modal-overlay .select2-container .select2-selection--single {
    height: 42px !important;
    border: 1px solid var(--ui-border) !important;
    border-radius: 6px !important;
    padding: 6px 13px !important;
    background: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.15s ease !important;
  }
  .modal-overlay .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: var(--ui-text-main) !important;
    font-size: 13.5px !important;
    line-height: normal !important;
    padding-left: 0 !important;
    padding-right: 24px !important;
    font-weight: 500 !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
  }
  .modal-overlay .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #94a3b8 !important;
    font-size: 13.5px !important;
  }
  .modal-overlay .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 10px !important;
  }
  .modal-overlay .select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #64748b transparent transparent transparent !important;
    border-width: 5px 4px 0 4px !important;
  }
  .modal-overlay .select2-container--default.select2-container--open .select2-selection--single {
    border-color: var(--notika-green) !important;
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2) !important;
  }
  .modal-overlay .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent var(--notika-green) transparent !important;
    border-width: 0 4px 5px 4px !important;
  }
  .select2-dropdown {
    border: 1px solid var(--ui-border) !important;
    border-radius: 8px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
    z-index: 1000005 !important;
    overflow: hidden !important;
    background: #ffffff !important;
  }
  .select2-search--dropdown {
    padding: 10px 12px !important;
    background: #f8fafc !important;
    border-bottom: 1px solid var(--ui-border-light) !important;
  }
  .select2-search--dropdown .select2-search__field {
    border: 1px solid var(--ui-border) !important;
    border-radius: 6px !important;
    padding: 8px 12px !important;
    font-size: 13.5px !important;
    outline: none !important;
    width: 100% !important;
    font-family: inherit !important;
    background: #ffffff !important;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.03) !important;
  }
  .select2-search--dropdown .select2-search__field:focus {
    border-color: var(--notika-green) !important;
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2) !important;
  }
  .select2-results__options {
    max-height: 260px !important;
    padding: 4px 0 !important;
    font-size: 13.5px !important;
  }
  .select2-results__option {
    padding: 9px 14px !important;
    color: var(--ui-text-main) !important;
    border-bottom: 1px solid #f8fafc !important;
    transition: background 0.1s ease !important;
  }
  .select2-results__option:last-child {
    border-bottom: none !important;
  }
  .select2-results__option--highlighted[aria-selected] {
    background-color: #f0faf7 !important;
    color: #00897b !important;
  }
  .select2-results__option[aria-selected=true] {
    background-color: #e8f8f5 !important;
    color: var(--notika-green-dark) !important;
    font-weight: 700 !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__clear {
    margin-right: 18px !important;
    font-size: 18px !important;
    color: #94a3b8 !important;
    line-height: 40px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__clear:hover {
    color: var(--ui-red) !important;
  }
  .rekening-opt-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 2px 0;
  }
  .rekening-opt-code {
    font-family: "Roboto Mono", monospace;
    font-weight: 700;
    font-size: 12px;
    color: #0284c7;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    padding: 2px 7px;
    border-radius: 4px;
    flex-shrink: 0;
    letter-spacing: 0.3px;
    margin-top: 1px;
  }
  .rekening-opt-name {
    font-size: 13.5px;
    color: #1e293b;
    line-height: 1.4;
  }
  .select2-results__option--highlighted .rekening-opt-code {
    background: #ffffff;
    border-color: #93c5fd;
  }
  .select2-results__option--highlighted .rekening-opt-name {
    color: #00796b;
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
  /* ---------- Header Tahapan Renja (Pemisah diatas Tabel Rincian Belanja) ---------- */
  .renja-stage-header {
    background: var(--ui-card-bg);
    border: 1px solid var(--ui-border-light);
    border-radius: 10px;
    padding: 11px 18px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  }
  .renja-stage-left {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
  }
  .renja-stage-title {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    color: var(--ui-text-muted);
    text-transform: uppercase;
    letter-spacing: 0.4px;
  }
  .renja-stage-title svg {
    color: var(--notika-green);
  }
  .renja-stage-tabs {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f1f5f9;
    padding: 4px;
    border-radius: 8px;
    border: 1px solid var(--ui-border-light);
  }
  .stage-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #475569;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s ease;
  }
  .stage-tab:hover {
    color: #0f172a;
    background: rgba(255,255,255,0.7);
  }
  .stage-tab.active {
    background: var(--notika-green);
    color: #ffffff;
    box-shadow: 0 1px 2px rgba(0, 194, 146, 0.3);
  }
  .stage-tab .stage-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #94a3b8;
  }
  .stage-tab.active .stage-dot {
    background: #ffffff;
  }
  .renja-stage-right {
    display: flex;
    align-items: center;
  }
  .stage-badge-info {
    font-size: 12.5px;
    color: var(--ui-text-muted);
    background: var(--ui-bg);
    padding: 4px 12px;
    border-radius: 6px;
    border: 1px solid var(--ui-border-light);
  }
  .stage-badge-info b {
    color: var(--notika-green-dark);
  }

  /* ---------- Kartu Pagu & Realisasi Ringkasan (Notika Style) ---------- */
  .pagu-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    background: var(--ui-card-bg);
    border: 1px solid var(--ui-border-light);
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    overflow: hidden;
  }
  .pagu-item {
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
    background: #ffffff;
  }
  .pagu-item + .pagu-item {
    border-left: 1px solid var(--ui-border-light);
  }
  .pagu-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .pagu-icon svg {
    width: 22px;
    height: 22px;
  }
  .pagu-icon.icon-pagu {
    background: var(--notika-green);
    color: #ffffff;
  }
  .pagu-icon.icon-input {
    background: var(--notika-green-light);
    color: var(--notika-green-dark);
  }
  .pagu-icon.icon-selisih {
    background: #fffbeb;
    color: #d97706;
  }
  .pagu-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
  }
  .pagu-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
  }
  .pagu-value {
    font-size: 18.5px;
    font-weight: 800;
    color: #0f172a;
    white-space: nowrap;
    font-family: 'Roboto', "Inter", sans-serif;
    letter-spacing: -0.2px;
  }
  .pagu-sub {
    font-size: 11.5px;
    color: #64748b;
  }

  /* Status Colors untuk Selisih Pagu */
  .pagu-item.status-balanced .pagu-icon.icon-selisih {
    background: var(--notika-green-light);
    color: var(--notika-green-dark);
  }
  .pagu-item.status-balanced .pagu-value {
    color: var(--notika-green-dark);
  }
  .pagu-item.status-remaining .pagu-icon.icon-selisih {
    background: #fffbeb;
    color: #d97706;
  }
  .pagu-item.status-remaining .pagu-value {
    color: #d97706;
  }
  .pagu-item.status-over .pagu-icon.icon-selisih {
    background: #fef2f2;
    color: #dc2626;
  }
  .pagu-item.status-over .pagu-value {
    color: #dc2626;
  }

  @media (max-width: 992px) {
    .pagu-cards {
      grid-template-columns: 1fr;
    }
    .pagu-item {
      padding: 10px 16px;
    }
    .pagu-item + .pagu-item {
      border-left: none;
      border-top: 1px solid var(--ui-border-light);
    }
  }
</style>

<div class="main-content">
<div class="app">

  <!-- Filter Wilayah (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN & LOGIN DAERAH -->
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
    <div class="card" style="padding: 16px 20px; margin-bottom: 20px; border-left: 4px solid var(--notika-green);">
      <div style="font-size: 14.5px; font-weight: 700; color: var(--ui-text-main); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
        <i class="fa fa-filter" style="color: var(--notika-green); font-size: 16px;"></i> 
        <span><?= empty($IsLoggedIn) ? 'Filter Wilayah &amp; Perangkat Daerah' : 'Filter Perangkat Daerah (Instansi)' ?></span>
      </div>
      <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end;">
        <?php if (empty($IsLoggedIn)): ?>
          <div style="flex: 1; min-width: 180px;">
            <label style="font-size: 12px; font-weight: 600; color: var(--ui-text-muted); margin-bottom: 4px; display: block;">Provinsi</label>
            <select id="selProvinsiTop" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid var(--ui-border); padding: 6px 10px; font-size: 13px;">
              <option value="">Pilih Provinsi</option>
              <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($provKodeCurrent) && $provKodeCurrent == $prov['Kode']) ? 'selected' : '' ?>>
                  <?= html_escape($prov['Nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div style="flex: 1; min-width: 180px;">
            <label style="font-size: 12px; font-weight: 600; color: var(--ui-text-muted); margin-bottom: 4px; display: block;">Kabupaten / Kota</label>
            <select id="selKabKotaTop" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid var(--ui-border); padding: 6px 10px; font-size: 13px;">
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

        <div id="grpInstansiTop" style="flex: 1.5; min-width: 250px; <?= (!empty($IsLoggedIn) || !empty($KodeWilayah)) ? '' : 'display:none;' ?>">
          <label style="font-size: 12px; font-weight: 700; color: var(--ui-text-main); margin-bottom: 4px; display: block;">Perangkat Daerah / Instansi</label>
          <select id="selInstansiTop" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid var(--ui-border); padding: 6px 10px; font-size: 13px; font-weight: 600;">
            <option value="">-- Pilih Perangkat Daerah --</option>
            <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
              <option value="<?= $ins['id'] ?>" <?= ($ActiveInstansiId == $ins['id']) ? 'selected' : '' ?>>
                <?= html_escape($ins['nama']) ?>
              </option>
            <?php }} ?>
          </select>
        </div>

        <?php if (!empty($IsDaerah)): ?>
          <div style="flex: 0.8; min-width: 130px;">
            <label style="font-size: 12px; font-weight: 700; color: var(--ui-text-main); margin-bottom: 4px; display: block;">Tahun Anggaran</label>
            <select id="selTahunTop" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid var(--ui-border); padding: 6px 10px; font-size: 13px; font-weight: 600;">
              <?php foreach ($ListTahun as $y): ?>
                <option value="<?= $y ?>" <?= ($y == $TahunAktif) ? 'selected' : '' ?>><?= $y ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endif; ?>

        <div style="width: auto;">
          <button type="button" id="btnFilterWilayahTop" class="btn btn-primary" style="height: 38px; padding: 0 20px; font-size: 13px; font-weight: 700; border-radius: 6px; background: var(--notika-green); color: #fff; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa fa-search"></i> <?= empty($IsLoggedIn) ? 'Terapkan Wilayah' : 'Tampilkan Rincian' ?>
          </button>
        </div>
      </div>
    </div>

    <script>
    (function() {
      var BaseURL = '<?= base_url() ?>';
      var cKodeWilayah = '<?= !empty($KodeWilayah) ? $KodeWilayah : "" ?>';
      var cInstansiId = '<?= !empty($ActiveInstansiId) ? $ActiveInstansiId : "" ?>';

      function loadKabKota(provKode, selectedKabKode, callback) {
        var selKab = document.getElementById('selKabKotaTop');
        var grpInst = document.getElementById('grpInstansiTop');
        if (!selKab) return;
        if (!provKode) {
          selKab.innerHTML = '<option value="">Pilih Kab/Kota</option>';
          if (grpInst) grpInst.style.display = 'none';
          return;
        }
        selKab.disabled = true;
        selKab.innerHTML = '<option value="">Memuat Kab/Kota...</option>';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', BaseURL + 'Instansi/GetListKabKota', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
          selKab.disabled = false;
          if (xhr.status === 200) {
            try {
              var data = JSON.parse(xhr.responseText);
              var html = '<option value="">Pilih Kab/Kota</option>';
              if (data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                  var sel = (selectedKabKode && selectedKabKode == data[i].Kode) ? ' selected' : '';
                  html += '<option value="' + data[i].Kode + '"' + sel + '>' + data[i].Nama + '</option>';
                }
              }
              selKab.innerHTML = html;
              if (callback) callback();
            } catch (e) {
              selKab.innerHTML = '<option value="">Gagal memuat data</option>';
            }
          } else {
            selKab.innerHTML = '<option value="">Gagal memuat data</option>';
          }
        };
        xhr.onerror = function() {
          selKab.disabled = false;
          selKab.innerHTML = '<option value="">Gagal memuat data</option>';
        };
        xhr.send('Kode=' + encodeURIComponent(provKode));
      }

      function loadInstansi(kabKode, selectedInstansiId) {
        var selInst = document.getElementById('selInstansiTop');
        var grpInst = document.getElementById('grpInstansiTop');
        if (!selInst) return;
        if (!kabKode) {
          if (grpInst) grpInst.style.display = 'none';
          selInst.innerHTML = '<option value="">-- Semua Perangkat Daerah --</option>';
          return;
        }
        if (grpInst) grpInst.style.display = '';
        selInst.innerHTML = '<option value="">Memuat Instansi...</option>';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', BaseURL + 'Instansi/GetListInstansiLevel4', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
          if (xhr.status === 200) {
            try {
              var data = JSON.parse(xhr.responseText);
              var html = '<option value="">-- Semua Perangkat Daerah --</option>';
              if (data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                  var sel = (selectedInstansiId && selectedInstansiId == data[i].id) ? ' selected' : '';
                  html += '<option value="' + data[i].id + '"' + sel + '>' + data[i].nama + '</option>';
                }
              }
              selInst.innerHTML = html;
              if (grpInst) grpInst.style.display = '';
            } catch (e) {
              selInst.innerHTML = '<option value="">-- Gagal memuat instansi --</option>';
            }
          }
        };
        xhr.send('kode_wilayah=' + encodeURIComponent(kabKode));
      }

      function initFilter() {
        var selProv = document.getElementById('selProvinsiTop');
        var selKab = document.getElementById('selKabKotaTop');
        var btnApply = document.getElementById('btnFilterWilayahTop');

        if (selProv) {
          selProv.onchange = function() {
            loadKabKota(this.value, '', function() {
              loadInstansi('', '');
            });
          };
        }

        if (selKab) {
          selKab.onchange = function() {
            loadInstansi(this.value, '');
          };
        }

        if (btnApply) {
          btnApply.onclick = function() {
            <?php if (!empty($IsDaerah)): ?>
              var selInst = document.getElementById('selInstansiTop');
              var inst = selInst ? selInst.value : '';
              var thn = document.getElementById('selTahunTop') ? document.getElementById('selTahunTop').value : (document.getElementById('ctxTahun') ? document.getElementById('ctxTahun').value : '');
              var url = BaseURL + 'Instansi/BelanjaSubKegiatan';
              var queryParams = [];
              if (inst) queryParams.push('instansi_id=' + encodeURIComponent(inst));
              if (thn) queryParams.push('tahun=' + encodeURIComponent(thn));
              if (queryParams.length > 0) url += '?' + queryParams.join('&');
              window.location.href = url;
              return;
            <?php endif; ?>

            var prov = selProv ? selProv.value : '';
            var kab = selKab ? selKab.value : '';
            var selInst = document.getElementById('selInstansiTop');
            var inst = selInst ? selInst.value : '';

            if (!prov) {
              alert('Mohon pilih Provinsi');
              return;
            }
            if (!kab) {
              alert('Mohon pilih Kabupaten/Kota');
              return;
            }

            btnApply.disabled = true;
            btnApply.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

            var xhr = new XMLHttpRequest();
            xhr.open('POST', BaseURL + 'Instansi/SetTempKodeWilayah', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
              if (xhr.responseText.trim() === '1') {
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
                alert(xhr.responseText || 'Gagal mengatur filter wilayah');
                btnApply.disabled = false;
                btnApply.innerHTML = '<i class="fa fa-search"></i> Terapkan Wilayah';
              }
            };
            xhr.onerror = function() {
              alert('Terjadi kesalahan koneksi ke server');
              btnApply.disabled = false;
              btnApply.innerHTML = '<i class="fa fa-search"></i> Terapkan Wilayah';
            };
            xhr.send('KodeWilayah=' + encodeURIComponent(kab) + '&InstansiId=' + encodeURIComponent(inst));
          };
        }
      }

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFilter);
      } else {
        initFilter();
      }
    })();
    </script>
  <?php } ?>

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
            <?php if (!empty($IsRole4)): ?>
              <input id="ctxPerangkatDaerah" class="context-readonly" readonly value="<?= html_escape($CurrentInstansi ? $CurrentInstansi['nama'] : 'PERANGKAT DAERAH') ?>" placeholder="Perangkat Daerah">
              <input type="hidden" id="ctxInstansiSelect" value="<?= $ActiveInstansiId ?: '' ?>">
            <?php else: ?>
              <select id="ctxInstansiSelect">
                <?php if (!empty($ListInstansi)): ?>
                  <?php foreach ($ListInstansi as $ins): ?>
                    <option value="<?= $ins['id'] ?>" <?= ($ActiveInstansiId == $ins['id']) ? 'selected' : '' ?>><?= html_escape($ins['nama']) ?></option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="">-- Tidak ada perangkat daerah --</option>
                <?php endif; ?>
              </select>
              <input type="hidden" id="ctxPerangkatDaerah" value="<?= html_escape($CurrentInstansi ? $CurrentInstansi['nama'] : '') ?>">
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

  <!-- ============ HEADER TAHAPAN RENJA (PEMISAH DIATAS TABEL RINCIAN BELANJA) ============ -->
  <div class="renja-stage-header">
    <div class="renja-stage-left">
      <div class="renja-stage-title">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        <span>Tahapan Renja :</span>
      </div>
      <div class="renja-stage-tabs" id="renjaStageTabs">
        <button type="button" class="stage-tab active" data-stage="ranwal" title="Rancangan Awal Renja">
          <span class="stage-dot"></span> Ranwal
        </button>
        <button type="button" class="stage-tab" data-stage="rancangan" title="Rancangan Renja">
          <span class="stage-dot"></span> Rancangan
        </button>
        <button type="button" class="stage-tab" data-stage="rankhir" title="Rancangan Akhir / Penetapan Renja">
          <span class="stage-dot"></span> Rankhir / Penetapan
        </button>
        <button type="button" class="stage-tab" data-stage="perubahan" title="Perubahan Renja">
          <span class="stage-dot"></span> Perubahan
        </button>
      </div>
    </div>
    <div class="renja-stage-right">
      <span class="stage-badge-info" id="stageInfoText">Pagu Sub Kegiatan: <b>Ranwal Renja</b></span>
    </div>
  </div>

  <!-- Kartu Ringkasan Pagu & Realisasi Sub Kegiatan -->
  <div class="pagu-cards">
    <div class="pagu-item">
      <div class="pagu-icon icon-pagu">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="16" height="11" rx="2"/><path d="M2 8.5h16M6.5 12.5h2"/></svg>
      </div>
      <div class="pagu-text">
        <span class="pagu-label">PAGU SUB KEGIATAN (RENJA)</span>
        <span class="pagu-value" id="paguAnggaranValue">Rp 0</span>
        <span class="pagu-sub" id="paguAnggaranSub">Pilih Sub Kegiatan terlebih dahulu</span>
      </div>
    </div>
    <div class="pagu-item">
      <div class="pagu-icon icon-input">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5l4 4 10-10"/></svg>
      </div>
      <div class="pagu-text">
        <span class="pagu-label">AKUMULASI TERINPUT (SUB KEGIATAN)</span>
        <span class="pagu-value" id="paguTerinputValue">Rp 0</span>
        <span class="pagu-sub" id="paguTerinputPercent">0% dari Pagu Renja</span>
      </div>
    </div>
    <div class="pagu-item status-remaining" id="paguSelisihItem">
      <div class="pagu-icon icon-selisih">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10.5h12M10 4.5v3M10 12.5v3"/></svg>
      </div>
      <div class="pagu-text">
        <span class="pagu-label" id="paguSelisihLabel">SISA PAGU SUB KEGIATAN</span>
        <span class="pagu-value" id="paguSelisihValue">Rp 0</span>
        <span class="pagu-sub" id="paguSelisihSub">Pilih Sub Kegiatan terlebih dahulu</span>
      </div>
    </div>
  </div>

  <!-- Table card -->
  <div class="card">
    <div class="table-toolbar">
      <div>
        <h2>Tabel Rincian Belanja</h2>
        <p id="toolbarContext">Lengkapi pilihan Sub Unit sampai Sub Kegiatan terlebih dahulu.</p>
      </div>
      <?php if (!empty($CanCrud)): ?>
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
            <?php if (!empty($CanCrud)): ?>
            <th rowspan="2" style="width:90px;" class="center">Aksi</th>
            <?php endif; ?>
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
            <td colspan="5" class="label">Jumlah Total</td>
            <td class="num" id="grandTotal"><span class="money-cell"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <?php if (!empty($CanCrud)): ?>
            <td></td>
            <?php endif; ?>
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
          <label for="fObjekBelanja">Objek Belanja <span class="req">*</span> <small style="font-weight:600; color:#0284c7; background:#eff6ff; padding:2px 8px; border-radius:4px; font-size:11.5px; border:1px solid #bfdbfe; margin-left:6px;"><i class="fa fa-filter"></i> Memfilter Rekening / Akun</small></label>
          <select id="fObjekBelanja" style="width:100%; border:1px solid var(--ui-border); border-radius:6px; padding:9px 12px; font-size:13.5px; background:#ffffff;">
            <option value="">-- Semua / Pilih Objek Belanja --</option>
          </select>
        </div>

        <div class="form-field full">
          <label for="fRekeningAkun">Rekening / Akun <span class="req">*</span> <small style="font-weight:600; color:#0284c7; background:#eff6ff; padding:2px 8px; border-radius:4px; font-size:11.5px; border:1px solid #bfdbfe; margin-left:6px;"><i class="fa fa-search"></i> Ketik untuk mencari</small></label>
          <select id="fRekeningAkun" style="width:100%;"></select>
        </div>

        <div class="form-field">
          <label>Pengelompokan Belanja / Paket Pekerjaan <span class="req">*</span></label>
          <select id="fPengelompokanTipe">
            <option>Pengelompokan Belanja</option>
            <option>Paket Pekerjaan</option>
          </select>
        </div>

        <div class="form-field">
          <div style="display:flex; align-items:center; margin-bottom:6px;">
            <label for="fUraianPengelompokan" style="margin:0;">Uraian Pengelompokan Belanja / Paket Pekerjaan</label>
            <button type="button" id="btnToggleUraianMode" class="btn btn-xs btn-default" style="margin-left:10px; font-size:11.5px; padding:2px 8px; border-radius:4px; border:1px solid #cbd5e1; background:#f8fafc; color:#0284c7; cursor:pointer; font-weight:600;" title="Beralih antara pilihan rekomendasi atau ketik manual">
              <i class="fa fa-pencil"></i> Ketik Manual
            </button>
          </div>
          <div id="wrapUraianSelect" style="width:100%;">
            <select id="fUraianPengelompokan" style="width:100%;">
              <option value="">-- Cari atau ketik Uraian Pengelompokan Belanja / Paket Pekerjaan... --</option>
            </select>
          </div>
          <div id="wrapUraianManual" style="width:100%; display:none;">
            <input type="text" id="fUraianManual" class="form-control" style="width:100%; border:1px solid var(--ui-border); border-radius:6px; padding:9px 12px; font-size:13.5px; background:#ffffff;" placeholder="Ketik uraian pengelompokan secara manual...">
          </div>
        </div>

        <div class="form-field">
          <label for="fSumberDana">Sumber Dana <small style="font-weight:600; color:#0284c7; background:#eff6ff; padding:2px 8px; border-radius:4px; font-size:11.5px; border:1px solid #bfdbfe; margin-left:6px;"><i class="fa fa-search"></i> Ketik untuk mencari</small></label>
          <select id="fSumberDana" style="width:100%;">
            <option value="">Pilih sumber dana (opsional)</option>
            <option>Pendapatan Bagi Hasil</option>
            <option>Dana Alokasi Umum (DAU)</option>
            <option>Dana Alokasi Khusus (DAK)</option>
            <option>Pendapatan Asli Daerah (PAD)</option>
          </select>
        </div>

        <div class="form-field">
          <label for="fJenisStandarHarga">Jenis Standar Harga</label>
          <select id="fJenisStandarHarga" style="width:100%; border:1px solid var(--ui-border); border-radius:6px; padding:9px 12px; font-size:13.5px; background:#ffffff;">
            <option value="">Pilih jenis standar harga</option>
            <option>Standar Satuan Harga (SSH)</option>
            <option>Harga Satuan Pokok Kegiatan (HSPK)</option>
            <option>Analisis Standar Belanja (ASB)</option>
            <option>Standar Harga Satuan Regional (SBU)</option>
          </select>
        </div>

        <div class="form-field">
          <label for="fKomponen">Komponen <span class="req">*</span> <small style="font-weight:600; color:#0284c7; background:#eff6ff; padding:2px 8px; border-radius:4px; font-size:11.5px; border:1px solid #bfdbfe; margin-left:6px;"><i class="fa fa-list"></i> Pilih Komponen</small></label>
          <div style="display:flex; gap:6px;">
            <input id="fKomponen" list="komponenList" placeholder="Nama komponen / barang" style="flex:1;">
            <datalist id="komponenList"></datalist>
            <button type="button" class="btn-tarik-standar" id="btnOpenStandarPicker" title="Pilih Komponen dari Standar Harga">
              <i class="fa fa-search"></i> Pilih Komponen
            </button>
          </div>
        </div>

        <div class="form-field">
          <label>Spesifikasi Komponen</label>
          <input id="fSpesifikasi" placeholder="Masukkan spesifikasi komponen (opsional)">
        </div>

        <div class="form-field">
          <label for="fSatuan">Satuan <span class="req">*</span> <small style="font-weight:600; color:#0284c7; background:#eff6ff; padding:2px 8px; border-radius:4px; font-size:11.5px; border:1px solid #bfdbfe; margin-left:6px;"><i class="fa fa-search"></i> Ketik untuk mencari</small></label>
          <select id="fSatuan" style="width:100%;">
            <option value="">Pilih satuan</option>
            <option>Buah</option><option>Pak</option><option>Kotak</option><option>Rim</option>
            <option>Lembar</option><option>Unit</option><option>Paket</option><option>Set</option>
            <option>M2</option><option>M3</option><option>Meter</option><option>Ls</option>
            <option>Botol</option><option>Dus</option><option>Kg</option><option>Liter</option>
            <option>Orang</option><option>Bulan</option><option>Hari</option><option>Tahun</option>
            <option>Kegiatan</option><option>Laporan</option><option>Dokumen</option><option>Kali</option>
            <option>Orang / Bulan</option><option>Orang / Hari</option><option>Orang / Jam</option>
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
          <h3 id="pickerModalTitle" style="margin:0; font-size:16px;">Pilih Komponen Standar Harga</h3>
          <p id="pickerModalDesc" style="margin:2px 0 0; font-size:12.5px; color:rgba(255,255,255,0.75);">Menampilkan daftar komponen sesuai Jenis Standar Harga yang dipilih.</p>
        </div>
      </div>
      <button class="btn-back" id="btnClosePicker" type="button">&times; Tutup</button>
    </div>
    
    <div id="pickerActiveTypeBadge" style="padding: 10px 24px; background: #f8fafc; border-bottom: 1px solid var(--ui-border-light); font-weight: 600; color: var(--ui-text); font-size: 13.5px; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-tag" style="color:var(--notika-green);"></i>
      <span>Jenis Standar Harga: <strong id="lblActivePickerType" style="color:var(--notika-green);">Standar Satuan Harga (SSH)</strong></span>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
(function(){
  "use strict";

  var BaseURL = '<?= rtrim(base_url(), "/") . "/" ?>';
  var controllerName = '<?= isset($ControllerName) ? $ControllerName : $this->router->fetch_class() ?>';
  var ControllerURL = BaseURL + controllerName + '/';
  var rawBelanjaHeaders = <?= json_encode(!empty($BelanjaData) ? $BelanjaData : []) ?>;
  var initialSubUnits = <?= json_encode(!empty($SubUnits) ? $SubUnits : []) ?>;
  var currentInstansi = <?= json_encode(!empty($CurrentInstansi) ? $CurrentInstansi : null) ?>;
  var isRole4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;
  var isLoggedIn = <?= !empty($IsLoggedIn) ? 'true' : 'false' ?>;
  var hasKodeWilayah = <?= !empty($KodeWilayah) ? 'true' : 'false' ?>;
  var activeInstansiId = <?= json_encode($ActiveInstansiId) ?>;
  var canCrud = <?= !empty($CanCrud) ? 'true' : 'false' ?>;
  var instansiUraianList = <?= json_encode(!empty($InstansiUraianList) ? $InstansiUraianList : []) ?>;

  /* ---------------- Master data ---------------- */
  var serverNodeNames = <?= json_encode(!empty($MasterNodeNames) ? $MasterNodeNames : (object)[]) ?>;
  var NODE_NAMES = $.extend({
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
  }, serverNodeNames);

  function normalizeCode(c){
    if(!c) return "";
    return String(c).split(".").map(function(p){
      var n = parseInt(p, 10);
      return isNaN(n) ? p.trim() : String(n);
    }).join(".");
  }

  function isCodeLike(s){
    if(!s) return true;
    var str = String(s).trim();
    return /^[0-9]+(\.[0-9]+)*$/.test(str);
  }

  function registerRekeningName(kode, nama, level){
    if(!kode || !nama) return;
    NODE_NAMES[kode] = nama;
    var norm = normalizeCode(kode);
    NODE_NAMES[norm] = nama;
    var found = false;
    for(var i=0; i<REKENING_OPTIONS.length; i++){
      if(REKENING_OPTIONS[i].kode === kode){
        REKENING_OPTIONS[i].nama = nama;
        found = true;
        break;
      }
    }
    if(!found){
      REKENING_OPTIONS.push({
        kode: kode,
        nama: nama,
        level: level || 6
      });
    }
  }

  var REKENING_OPTIONS = [];
  var OBJEK_BELANJA_OPTIONS = [];
  var OBJEK_MAP = {};
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
  var currentPickerType = 'ssh';

  /* ---------------- Init Master Data from Database ---------------- */
  function buildMasterFromDatabase() {
    var allItems = [];

    $.each(rawBelanjaHeaders, function(idx, h) {
      var skKode = h.kode_sub_kegiatan || ('5.01.02.2.03.' + String(idx + 1).padStart(2, '0'));

      // Convert nested rekening and rincian into items list
      if (h.rekening && h.rekening.length > 0) {
        $.each(h.rekening, function(rIdx, rek) {
          if (rek.kode_rekening && rek.uraian_rekening) {
            registerRekeningName(rek.kode_rekening, rek.uraian_rekening, rek.level_rekening || 6);
          }
          if (rek.rincian && rek.rincian.length > 0) {
            var parts = (rek.kode_rekening || "").split('.');
            var objKode = parts.slice(0, 3).join('.');
            var objNama = OBJEK_MAP[objKode] || (NODE_NAMES[objKode] ? (objKode + " - " + NODE_NAMES[objKode]) : objKode);

            $.each(rek.rincian, function(iIdx, rinc) {
              allItems.push({
                id: parseInt(rinc.id, 10),
                headerId: h.id,
                rekeningId: rek.id,
                subKegiatanKode: skKode,
                objekBelanja: objKode || "5.1.02",
                objekBelanjaNama: objNama,
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
  /* ---------------- Helpers ---------------- */
  /* ---------------- Pagu & Tahapan Renja Summary ---------------- */
  var currentRenjaStage = 'ranwal';
  var cachedPaguTahapan = null;

  function fmtRp(n){
    n = Number(n) || 0;
    return "Rp " + Math.round(n).toLocaleString("id-ID");
  }

  function renderPaguCards(){
    var thnVal = (el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>') || '<?= $TahunAktif ?>';
    if(el("paguTahunLabel")){
      el("paguTahunLabel").textContent = thnVal;
    }

    var stageNames = {
      'ranwal': 'Ranwal Renja',
      'rancangan': 'Rancangan Renja',
      'rankhir': 'Rankhir / Penetapan Renja',
      'perubahan': 'Perubahan Renja'
    };
    var stgLbl = stageNames[currentRenjaStage] || 'Ranwal Renja';

    var visibleItems = currentSubKegiatanKode ? 
      items.filter(function(it){ return it.subKegiatanKode === currentSubKegiatanKode; }) : 
      [];
    var terinput = visibleItems.reduce(function(s, it){ return s + calcJumlah(it); }, 0);

    var pagu = 0;
    var hasSubKegPagu = false;
    if(cachedPaguTahapan && currentSubKegiatanKode){
      var valTahap = parseFloat(cachedPaguTahapan[currentRenjaStage]);
      if(!isNaN(valTahap) && valTahap > 0){
        pagu = valTahap;
        hasSubKegPagu = true;
      }
    }

    // Pagu yang tampil HANYA pagu per sub kegiatan dari Renja, bukan pagu total PD
    var selisih = pagu - terinput;
    var persen = pagu > 0 ? (Math.round((terinput / pagu) * 1000) / 10) : 0;

    if(el("paguAnggaranValue")){
      el("paguAnggaranValue").textContent = fmtRp(pagu);
    }
    if(el("paguAnggaranSub")){
      if(!currentSubKegiatanKode){
        el("paguAnggaranSub").textContent = 'Pilih Sub Kegiatan terlebih dahulu';
      } else if(hasSubKegPagu){
        el("paguAnggaranSub").innerHTML = 'Pagu Sub Kegiatan Renja (<b>' + esc(stgLbl) + '</b>) TA <b>' + esc(thnVal) + '</b>';
      } else {
        el("paguAnggaranSub").innerHTML = '<span style="color:#d97706;"><i class="fa fa-info-circle"></i> Belum ada alokasi di ' + esc(stgLbl) + ' TA ' + esc(thnVal) + '</span>';
      }
    }

    if(el("paguTerinputValue")){
      el("paguTerinputValue").textContent = fmtRp(terinput);
    }
    if(el("paguTerinputPercent")){
      if(!currentSubKegiatanKode){
        el("paguTerinputPercent").textContent = 'Pilih Sub Kegiatan terlebih dahulu';
      } else if(pagu > 0){
        el("paguTerinputPercent").textContent = persen + '% dari Pagu Renja Sub Kegiatan';
      } else {
        el("paguTerinputPercent").textContent = 'Total rincian belanja terinput';
      }
    }

    var selisihItem = el("paguSelisihItem");
    if(el("paguSelisihValue")){
      el("paguSelisihValue").textContent = fmtRp(Math.abs(selisih));
    }
    if(selisihItem && el("paguSelisihLabel") && el("paguSelisihSub")){
      selisihItem.classList.remove('status-balanced', 'status-remaining', 'status-over');
      if(!currentSubKegiatanKode){
        el("paguSelisihLabel").textContent = 'SISA PAGU SUB KEGIATAN';
        el("paguSelisihSub").textContent = 'Pilih Sub Kegiatan terlebih dahulu';
        selisihItem.classList.add('status-remaining');
      } else if(pagu === 0 && terinput === 0){
        el("paguSelisihLabel").textContent = 'SISA PAGU SUB KEGIATAN';
        el("paguSelisihSub").textContent = 'Pagu Renja belum dialokasikan';
        selisihItem.classList.add('status-remaining');
      } else if(selisih > 0){
        el("paguSelisihLabel").textContent = 'SISA PAGU BELUM TERINPUT';
        el("paguSelisihSub").textContent = 'Tersisa untuk rincian Sub Kegiatan ini';
        selisihItem.classList.add('status-remaining');
      } else if(selisih === 0){
        el("paguSelisihLabel").textContent = 'PAGU PAS / SESUAI';
        el("paguSelisihSub").textContent = 'Total rincian tepat 100% dari Pagu Renja';
        selisihItem.classList.add('status-balanced');
      } else {
        el("paguSelisihLabel").textContent = 'LEBIH INPUT DARI PAGU';
        el("paguSelisihSub").innerHTML = '<span style="color:#dc2626; font-weight:600;"><i class="fa fa-exclamation-triangle"></i> Melebihi Pagu Renja Sub Kegiatan</span>';
        selisihItem.classList.add('status-over');
      }
    }
  }

  function fetchPaguTahapan(skKode){
    if(!skKode){
      cachedPaguTahapan = null;
      renderPaguCards();
      return;
    }
    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = (el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>') || '<?= $TahunAktif ?>';

    $.ajax({
      url: ControllerURL + "GetPaguRenjaTahapan",
      type: "POST",
      data: {
        kode_sub_kegiatan: skKode,
        instansi_id: instId,
        tahun: thnVal
      },
      dataType: "json",
      success: function(res){
        if(res && res.status === 'success' && res.data){
          cachedPaguTahapan = res.data;
        } else {
          cachedPaguTahapan = null;
        }
        renderPaguCards();
      },
      error: function(){
        cachedPaguTahapan = null;
        renderPaguCards();
      }
    });
  }

  function initRenjaStageEvents(){
    var stageTabs = document.querySelectorAll('#renjaStageTabs .stage-tab');
    stageTabs.forEach(function(btn){
      btn.addEventListener('click', function(){
        stageTabs.forEach(function(b){ b.classList.remove('active'); });
        this.classList.add('active');
        currentRenjaStage = this.getAttribute('data-stage') || 'ranwal';

        var stageNames = {
          'ranwal': 'Ranwal Renja',
          'rancangan': 'Rancangan Renja',
          'rankhir': 'Rankhir / Penetapan Renja',
          'perubahan': 'Perubahan Renja'
        };
        var lbl = stageNames[currentRenjaStage] || 'Ranwal Renja';
        var infoEl = el("stageInfoText");
        if(infoEl){
          infoEl.innerHTML = 'Pagu Sub Kegiatan: <b>' + esc(lbl) + '</b>';
        }

        renderPaguCards();
      });
    });
  }

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
    if(!kode) return null;
    for(var i=0; i<REKENING_OPTIONS.length; i++){
      if(REKENING_OPTIONS[i].kode === kode) return REKENING_OPTIONS[i];
    }
    var norm = normalizeCode(kode);
    for(var j=0; j<REKENING_OPTIONS.length; j++){
      if(normalizeCode(REKENING_OPTIONS[j].kode) === norm) return REKENING_OPTIONS[j];
    }
    for(var k=0; k<items.length; k++){
      if(items[k].rekeningKode === kode || normalizeCode(items[k].rekeningKode) === norm){
        if(items[k].rekeningNama && !isCodeLike(items[k].rekeningNama)){
          return { kode: kode, nama: items[k].rekeningNama };
        }
      }
    }
    return null;
  }

  function getNodeName(code, fallbackItems){
    if(!code) return "";
    
    // 1. Direct match in NODE_NAMES
    if(NODE_NAMES[code] && !isCodeLike(NODE_NAMES[code])){
      return NODE_NAMES[code];
    }

    // 2. Normalized match in NODE_NAMES
    var norm = normalizeCode(code);
    if(NODE_NAMES[norm] && !isCodeLike(NODE_NAMES[norm])){
      return NODE_NAMES[norm];
    }

    // 3. Match in REKENING_OPTIONS
    var r = findRekening(code);
    if(r && r.nama && !isCodeLike(r.nama)){
      return r.nama;
    }

    // 4. Match in fallbackItems (items of this node)
    if(fallbackItems && fallbackItems.length > 0){
      for(var k=0; k<fallbackItems.length; k++){
        if(fallbackItems[k].rekeningNama && !isCodeLike(fallbackItems[k].rekeningNama)){
          if(fallbackItems[k].rekeningKode === code || normalizeCode(fallbackItems[k].rekeningKode) === norm){
            return fallbackItems[k].rekeningNama;
          }
        }
      }
      if(code.split('.').length >= 6 && fallbackItems[0].rekeningNama && !isCodeLike(fallbackItems[0].rekeningNama)){
        return fallbackItems[0].rekeningNama;
      }
    }

    // 5. Match in global items
    for(var i=0; i<items.length; i++){
      if(items[i].rekeningNama && !isCodeLike(items[i].rekeningNama)){
        if(items[i].rekeningKode === code || normalizeCode(items[i].rekeningKode) === norm){
          return items[i].rekeningNama;
        }
      }
    }

    // 6. Match in rawBelanjaHeaders
    if(typeof rawBelanjaHeaders !== 'undefined' && rawBelanjaHeaders){
      for(var h=0; h<rawBelanjaHeaders.length; h++){
        var reks = rawBelanjaHeaders[h].rekening || [];
        for(var rk=0; rk<reks.length; rk++){
          if(reks[rk].uraian_rekening && !isCodeLike(reks[rk].uraian_rekening)){
            if(reks[rk].kode_rekening === code || normalizeCode(reks[rk].kode_rekening) === norm){
              return reks[rk].uraian_rekening;
            }
          }
        }
      }
    }

    return code;
  }

  function deriveGroupLabel(kode, itemsArr){
    var nama = getNodeName(kode, itemsArr);
    if(isCodeLike(nama)){
      if(itemsArr && itemsArr.length > 0){
        for(var i=0; i<itemsArr.length; i++){
          if(itemsArr[i].rekeningNama && !isCodeLike(itemsArr[i].rekeningNama)){
            nama = itemsArr[i].rekeningNama;
            break;
          }
        }
      }
    }
    if(!nama || isCodeLike(nama)){
      return "Belanja " + (kode || "");
    }
    var parts = nama.split(/\s+[-–]\s+/);
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
    var displayName = (name && !isCodeLike(name)) ? name : getNodeName(code);
    return '<tr class="row-lvl'+level+'">'+
      '<td class="font-mono">'+esc(code)+'</td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(code,collapsed,hasChildren)+'<span class="txt">'+esc(displayName)+'</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      (canCrud ? '<td></td>' : '')+
    '</tr>';
  }
  function accountRow(code, name, level, total, hasChildren){
    var collapsed = collapsedSet.has(code);
    var pad = 10 + (level-1)*18;
    var displayName = (name && !isCodeLike(name)) ? name : getNodeName(code);
    return '<tr class="row-account">'+
      '<td class="font-mono">'+esc(code)+'</td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(code,collapsed,hasChildren)+'<span class="txt">'+esc(displayName)+'</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      (canCrud ? '<td></td>' : '')+
    '</tr>';
  }
  function groupRow(key, label, sumberDana, level, total, hasChildren){
    var collapsed = collapsedSet.has(key);
    var pad = 10 + (level-1)*18;
    var displayLabel = (label && !isCodeLike(label)) ? label : getNodeName(label);
    return '<tr class="row-group">'+
      '<td></td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(key,collapsed,hasChildren)+
        '<span class="txt"><span class="tag">[ + ] '+esc(displayLabel)+'</span>'+
        (sumberDana ? '<span class="sub-label">Sumber Dana: '+esc(sumberDana)+'</span>' : '')+
        '</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      (canCrud ? '<td></td>' : '')+
    '</tr>';
  }
  function subgroupRow(key, label, level, total, hasChildren){
    var collapsed = collapsedSet.has(key);
    var pad = 10 + (level-1)*18;
    var displayLabel = (label && label.trim() !== '') ? label : '-';
    return '<tr class="row-subgroup">'+
      '<td></td>'+
      '<td><div class="cell-label" style="padding-left:'+pad+'px;">'+toggleBtn(key,collapsed,hasChildren)+'<span class="txt">[ - ] '+esc(displayLabel)+'</span></div></td>'+
      '<td></td><td></td><td></td>'+
      '<td class="num">'+formatMoney(total)+'</td>'+
      (canCrud ? '<td></td>' : '')+
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
        '</span></div></td>'+
      '<td class="num font-mono">'+esc(it.koefisien)+' '+esc(it.satuan)+'</td>'+
      '<td class="num">'+formatMoney(it.hargaSatuan)+'</td>'+
      '<td class="center font-mono">'+(parseFloat(it.ppn)||0)+'%</td>'+
      '<td class="num" style="font-weight:700;">'+formatMoney(calcJumlah(it))+'</td>'+
      (canCrud ? ('<td class="center"><div class="actions">'+
        '<button class="icon-btn edit" data-edit="'+it.id+'" title="Ubah">'+ICON_EDIT+'</button>'+
        '<button class="icon-btn del" data-del="'+it.id+'" title="Hapus">'+ICON_DEL+'</button>'+
      '</div></td>') : '')+
    '</tr>';
  }

  /* ---------------- Main render ---------------- */
  function renderLevelNode(code, node, level, hidden, out){
    var name = getNodeName(code, node.items);
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
    var autoLabel = deriveGroupLabel(accountCode, itemsArr);
    
    // Group Level 1: [ + ] Uraian Pengelompokan Belanja / Paket Pekerjaan (+ Sumber Dana)
    var byUR = groupBy(itemsArr, function(it){
      var u = (it.uraianPengelompokan && it.uraianPengelompokan.trim() !== '') ? it.uraianPengelompokan.trim() : autoLabel;
      var sd = (it.sumberDana && it.sumberDana.trim() !== '') ? it.sumberDana.trim() : '-';
      return u + "____SD____" + sd;
    });

    byUR.order.forEach(function(uKey){
      var uItems = byUR.map[uKey];
      var parts = uKey.split("____SD____");
      var uraianLabel = parts[0] || autoLabel;
      var sdLabel = (parts[1] && parts[1] !== '-') ? parts[1] : '';

      var gKey = accountCode + "::UR::" + uKey;
      var gCollapsed = collapsedSet.has(gKey);
      var gTotal = uItems.reduce(function(s,it){ return s + calcJumlah(it); }, 0);

      if(!hidden){
        out.push(groupRow(gKey, uraianLabel, sdLabel, level, gTotal, true));
      }
      var urHidden = hidden || gCollapsed;

      // Group Level 2: [ - ] Mengambil dari Keterangan
      var byKet = groupBy(uItems, function(it){
        return (it.keterangan && it.keterangan.trim() !== '') ? it.keterangan.trim() : '-';
      });

      byKet.order.forEach(function(ket){
        var ketItems = byKet.map[ket];
        var ketKey = gKey + "::KET::" + ket;
        var ketCollapsed = collapsedSet.has(ketKey);
        var ketTotal = ketItems.reduce(function(s,it){ return s + calcJumlah(it); }, 0);

        if(!urHidden){
          out.push(subgroupRow(ketKey, ket, level + 1, ketTotal, true));
        }
        var itHidden = urHidden || ketCollapsed;
        if(!itHidden){
          ketItems.forEach(function(it){
            out.push(itemRow(it, level + 2));
          });
        }
      });
    });
  }

  function render(){
    var tbody = document.getElementById("tableBody");
    var visibleItems = currentSubKegiatanKode ? 
      items.filter(function(it){ return it.subKegiatanKode === currentSubKegiatanKode; }) : 
      [];

    var emptyColspan = canCrud ? 7 : 6;
    if(!currentSubKegiatanKode){
      tbody.innerHTML = '<tr><td colspan="'+emptyColspan+'"><div class="empty-state">'+ICON_EMPTY+
        '<p>Pilih Sub Unit, Bidang Urusan, Program, Kegiatan dan Sub Kegiatan di atas terlebih dahulu untuk menampilkan rincian belanja.</p></div></td></tr>';
      document.getElementById("grandTotal").innerHTML = formatMoney(0);
      refreshDatalists(visibleItems);
      renderPaguCards();
      return;
    }

    var tree = buildTree(visibleItems);
    var out = [];
    var rootCodes = tree.order.slice().sort(compareCode);
    rootCodes.forEach(function(code){
      renderLevelNode(code, tree.children[code], 1, false, out);
    });

    if(out.length===0){
      var emptyMsg = canCrud ? 
        'Belum ada rincian belanja untuk Sub Kegiatan ini. Klik <strong>+ Tambah Rincian</strong> untuk menambahkan.' :
        'Belum ada data rincian belanja untuk Sub Kegiatan ini.';
      tbody.innerHTML = '<tr><td colspan="'+emptyColspan+'"><div class="empty-state">'+ICON_EMPTY+
        '<p>' + emptyMsg + '</p></div></td></tr>';
    } else {
      tbody.innerHTML = out.join("");
    }

    var grand = visibleItems.reduce(function(s,it){return s+calcJumlah(it);},0);
    document.getElementById("grandTotal").innerHTML = formatMoney(grand);

    refreshDatalists(visibleItems);
    renderPaguCards();
  }

  function populateUraianSelect(selectedVal){
    var $sel = $('#fUraianPengelompokan');
    if (!$sel.length) return;
    var curVal = selectedVal !== undefined ? selectedVal : ($sel.val() || '');

    var html = '<option value="">-- Cari atau ketik Uraian Pengelompokan Belanja / Paket Pekerjaan... --</option>';
    var list = [];
    if (Array.isArray(instansiUraianList)) {
      list = instansiUraianList.filter(function(u){
        return u && typeof u === 'string' && u.trim() !== '' && !isCodeLike(u);
      });
    }

    var uniqueList = Array.from(new Set(list));

    if (curVal && uniqueList.indexOf(curVal) === -1) {
      uniqueList.unshift(curVal);
    }

    uniqueList.forEach(function(u){
      html += '<option value="' + esc(u) + '">' + esc(u) + '</option>';
    });

    $sel.html(html);
    if (curVal) {
      $sel.val(curVal);
    } else {
      $sel.val('');
    }
    if ($sel.hasClass('select2-hidden-accessible')) {
      $sel.trigger('change.select2');
    }
  }

  function refreshDatalists(scopeItems){
    populateUraianSelect();
    var komponenSet = new Set();
    (scopeItems||items).forEach(function(it){
      if(it.komponen && it.komponen.trim() !== '') komponenSet.add(it.komponen.trim());
    });
    var kompEl = document.getElementById("komponenList");
    if (kompEl) {
      kompEl.innerHTML = Array.from(komponenSet).map(function(v){ return '<option value="'+esc(v)+'">'; }).join("");
    }
  }

  var isUraianManualMode = false;

  function getUraianValue(){
    if (isUraianManualMode) {
      return ($('#fUraianManual').val() || '').trim();
    }
    var selVal = ($('#fUraianPengelompokan').val() || '').trim();
    var typedVal = ($('#fUraianPengelompokan').data('current-typed') || '').trim();
    return selVal || typedVal || '';
  }

  function setUraianValue(val){
    val = val || '';
    $('#fUraianManual').val(val);
    populateUraianSelect(val);
    if (val && !$('#fUraianPengelompokan option[value="' + val + '"]').length) {
      var newOpt = new Option(val, val, true, true);
      $('#fUraianPengelompokan').append(newOpt).trigger('change');
    } else {
      $('#fUraianPengelompokan').val(val).trigger('change');
    }
  }

  function setUraianMode(manual){
    isUraianManualMode = !!manual;
    var curVal = getUraianValue();
    if (isUraianManualMode) {
      $('#wrapUraianSelect').hide();
      $('#wrapUraianManual').show();
      $('#fUraianManual').val(curVal);
      $('#btnToggleUraianMode').html('<i class="fa fa-list"></i> Pilih Rekomendasi');
      setTimeout(function(){ $('#fUraianManual').focus(); }, 50);
    } else {
      $('#wrapUraianManual').hide();
      $('#wrapUraianSelect').show();
      setUraianValue(curVal);
      $('#btnToggleUraianMode').html('<i class="fa fa-pencil"></i> Ketik Manual');
    }
  }

  $(document).on('click', '#btnToggleUraianMode', function(e){
    e.preventDefault();
    setUraianMode(!isUraianManualMode);
  });

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
        if (res && res.status === 'success') {
          if (res.node_names) {
            $.extend(NODE_NAMES, res.node_names);
            Object.keys(res.node_names).forEach(function(k){
              var nk = normalizeCode(k);
              if(!NODE_NAMES[nk]) NODE_NAMES[nk] = res.node_names[k];
            });
          }
          if (res.objek_belanja && res.objek_belanja.length > 0) {
            OBJEK_BELANJA_OPTIONS = res.objek_belanja.map(function(o) {
              OBJEK_MAP[o.kode_rekening] = o.nama_rekening;
              return { kode: o.kode_rekening, nama: o.nama_rekening };
            });
          }
          if (res.data && res.data.length > 0) {
            REKENING_OPTIONS = res.data.map(function(r) {
              return { kode: r.kode_rekening, nama: r.nama_rekening, level: r.level };
            });
            (rawBelanjaHeaders || []).forEach(function(h){
              (h.rekening || []).forEach(function(rek){
                if(rek.kode_rekening && rek.uraian_rekening){
                  registerRekeningName(rek.kode_rekening, rek.uraian_rekening, rek.level_rekening || 6);
                }
              });
            });
          }
        }

        if (OBJEK_BELANJA_OPTIONS.length === 0) {
          OBJEK_BELANJA_OPTIONS = [
            {kode:"5.1.01", nama:"Belanja Pegawai"},
            {kode:"5.1.02", nama:"Belanja Barang dan Jasa"},
            {kode:"5.1.03", nama:"Belanja Bunga"},
            {kode:"5.1.04", nama:"Belanja Subsidi"},
            {kode:"5.1.05", nama:"Belanja Hibah"},
            {kode:"5.1.06", nama:"Belanja Bantuan Sosial"},
            {kode:"5.2.01", nama:"Belanja Modal Tanah"},
            {kode:"5.2.02", nama:"Belanja Modal Peralatan dan Mesin"},
            {kode:"5.2.03", nama:"Belanja Modal Gedung dan Bangunan"},
            {kode:"5.2.04", nama:"Belanja Modal Jalan, Jaringan, dan Irigasi"},
            {kode:"5.2.05", nama:"Belanja Modal Aset Tetap Lainnya"},
            {kode:"5.2.06", nama:"Belanja Modal Aset Lainnya"},
            {kode:"5.3.01", nama:"Belanja Tidak Terduga"},
            {kode:"5.4.01", nama:"Belanja Bagi Hasil"},
            {kode:"5.4.02", nama:"Belanja Bantuan Keuangan"}
          ];
          OBJEK_BELANJA_OPTIONS.forEach(function(o){ OBJEK_MAP[o.kode] = o.nama; });
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

        populateObjekBelanjaSelect();
        populateRekeningSelect();
        render();
      }
    });
  }

  function populateObjekBelanjaSelect(selectedKode) {
    if (!f.objek) return;
    var html = '<option value="">-- Semua / Pilih Objek Belanja --</option>';
    OBJEK_BELANJA_OPTIONS.forEach(function(o) {
      var isSel = (selectedKode && (selectedKode === o.kode || selectedKode.indexOf(o.kode) === 0)) ? ' selected' : '';
      html += '<option value="' + esc(o.kode) + '"' + isSel + '>' + esc(o.kode) + ' - ' + esc(o.nama) + '</option>';
    });
    f.objek.innerHTML = html;
    if (selectedKode) {
      f.objek.value = selectedKode;
    }
  }

  function matchCustom(params, data) {
    if ($.trim(params.term) === '') return data;
    if (typeof data.text === 'undefined') return null;

    var termWords = params.term.toLowerCase().split(/\s+/).filter(Boolean);
    var textLower = data.text.toLowerCase();

    var matchAll = termWords.every(function(word) {
      return textLower.indexOf(word) > -1;
    });

    return matchAll ? data : null;
  }

  function formatRekeningOption(state) {
    if (!state.id) return state.text;
    var text = state.text;
    var idx = text.indexOf(' - ');
    if (idx > -1) {
      var kode = text.substring(0, idx).trim();
      var nama = text.substring(idx + 3).trim();
      return $(
        '<div class="rekening-opt-item">' +
          '<span class="rekening-opt-code">' + esc(kode) + '</span>' +
          '<span class="rekening-opt-name">' + esc(nama) + '</span>' +
        '</div>'
      );
    }
    return state.text;
  }

  function formatRekeningSelection(state) {
    return state.text || state.id;
  }

  function initModalSelect2() {
    if (!$().select2) return;

    if (!$('#fRekeningAkun').hasClass('select2-hidden-accessible')) {
      $('#fRekeningAkun').select2({
        dropdownParent: $('#modalOverlay'),
        width: '100%',
        placeholder: '-- Ketik kode atau nama rekening belanja --',
        allowClear: true,
        matcher: matchCustom,
        templateResult: formatRekeningOption,
        templateSelection: formatRekeningSelection
      });
    }

    if (!$('#fSatuan').hasClass('select2-hidden-accessible')) {
      $('#fSatuan').select2({
        dropdownParent: $('#modalOverlay'),
        width: '100%',
        placeholder: 'Pilih / ketik satuan...',
        allowClear: true,
        tags: true
      });
    }

    if (!$('#fUraianPengelompokan').hasClass('select2-hidden-accessible')) {
      $('#fUraianPengelompokan').select2({
        dropdownParent: $('#modalOverlay'),
        width: '100%',
        placeholder: '-- Cari atau ketik Uraian Pengelompokan Belanja / Paket Pekerjaan... --',
        allowClear: true,
        tags: true,
        createTag: function (params) {
          var term = $.trim(params.term);
          if (term === '') return null;
          return {
            id: term,
            text: term,
            newTag: true
          };
        }
      });

      $('#fUraianPengelompokan').on('select2:closing', function() {
        var typed = $('#fUraianPengelompokan').data('current-typed');
        if (typed && typed.trim() !== '') {
          typed = typed.trim();
          if (!$('#fUraianPengelompokan option[value="' + typed + '"]').length) {
            var newOpt = new Option(typed, typed, true, true);
            $('#fUraianPengelompokan').append(newOpt);
          }
          $('#fUraianPengelompokan').val(typed).trigger('change');
          $('#fUraianPengelompokan').data('current-typed', '');
        }
      });
    }

    if (!$('#fSumberDana').hasClass('select2-hidden-accessible')) {
      $('#fSumberDana').select2({
        dropdownParent: $('#modalOverlay'),
        width: '100%',
        placeholder: 'Pilih sumber dana (opsional)...',
        allowClear: true
      });
    }
  }

  $(document).on('input keyup', '.select2-container--open .select2-search__field', function() {
    if ($('#fUraianPengelompokan').data('select2') && $('#fUraianPengelompokan').data('select2').isOpen()) {
      var val = $(this).val();
      $('#fUraianPengelompokan').data('current-typed', val);
    }
  });

  $(document).on('select2:open', function() {
    setTimeout(function() {
      var searchField = document.querySelector('.select2-container--open .select2-search__field');
      if (searchField) {
        searchField.focus();
      }
    }, 50);
  });

  $('#fObjekBelanja').on('change', function() {
    var objVal = $(this).val();
    var curRek = $('#fRekeningAkun').val();
    var keepRek = '';
    if (curRek && objVal) {
      var prefix = objVal + '.';
      if (curRek.indexOf(prefix) === 0) {
        keepRek = curRek;
      }
    }
    populateRekeningSelect(keepRek, objVal);
    $('#fRekeningAkun').val(keepRek).trigger('change');
  });

  $('#fRekeningAkun').on('change', function() {
    var val = $(this).val();
    if (val) {
      var parts = val.split('.');
      if (parts.length >= 3) {
        var objKode = parts.slice(0, 3).join('.');
        if (OBJEK_MAP[objKode] && f.objek.value !== objKode) {
          f.objek.value = objKode;
        }
      }
    }
  });

  function populateRekeningSelect(selectedKode, filterObjekKode){
    var curObj = filterObjekKode !== undefined ? filterObjekKode : (f.objek ? f.objek.value : '');

    var list = REKENING_OPTIONS.filter(function(r){
      if (!r.kode) return false;
      if (curObj) {
        var prefix = curObj.indexOf('.') > -1 ? curObj + '.' : curObj;
        if (r.kode.indexOf(prefix) !== 0 && r.kode !== selectedKode) {
          return false;
        }
      } else {
        if (r.kode.indexOf('5') !== 0 && r.kode !== selectedKode) {
          return false;
        }
      }
      return true;
    });

    if (list.length === 0 && selectedKode) {
      var exist = findRekening(selectedKode);
      if (exist) list = [exist];
    }

    var placeholder = curObj ? 
      ('-- Pilih Rekening (' + (OBJEK_MAP[curObj] ? (curObj + ' - ' + OBJEK_MAP[curObj]) : curObj) + ') --') : 
      '-- Ketik kode atau nama rekening belanja --';

    f.rekening.innerHTML = '<option value="">' + esc(placeholder) + '</option>' + list.map(function(r){
      return '<option value="'+esc(r.kode)+'">'+esc(r.kode)+' - '+esc(r.nama)+'</option>';
    }).join("");

    if ($('#fRekeningAkun').hasClass('select2-hidden-accessible')) {
      $('#fRekeningAkun').val(selectedKode || '').trigger('change.select2');
    }
  }

  function openModal(item){
    editingItem = item || null;
    document.getElementById("modalTitle").textContent = item ? "Ubah Rincian Sub Kegiatan" : "Tambah Rincian Sub Kegiatan";
    overlay.classList.remove("hidden");
    initModalSelect2();

    if(item){
      var rekKode = item.rekeningKode || "";
      var objKode = "";
      if (rekKode) {
        var parts = rekKode.split('.');
        objKode = parts.slice(0, 3).join('.');
      }
      if (!objKode && item.objekBelanja) {
        objKode = item.objekBelanja;
      }

      populateObjekBelanjaSelect(objKode);
      populateRekeningSelect(rekKode, objKode);

      f.objek.value = objKode || "";
      f.rekening.value = rekKode;
      $('#fRekeningAkun').val(rekKode).trigger('change');
      f.tipe.value = item.pengelompokanTipe || "Pengelompokan Belanja";
      var curUraian = item.uraianPengelompokan || "";
      setUraianValue(curUraian);
      setUraianMode(false);
      f.sumberDana.value = item.sumberDana || "";
      $('#fSumberDana').val(item.sumberDana || '').trigger('change');
      f.jsh.value = item.jenisStandarHarga || "";
      f.komponen.value = item.komponen || "";
      f.spesifikasi.value = item.spesifikasi || "";
      f.satuan.value = item.satuan || "";
      if (item.satuan && !$('#fSatuan option[value="' + item.satuan + '"]').length) {
        var newOpt = new Option(item.satuan, item.satuan, true, true);
        $('#fSatuan').append(newOpt).trigger('change');
      } else {
        $('#fSatuan').val(item.satuan || '').trigger('change');
      }
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
  }
  function closeModal(){
    overlay.classList.add("hidden");
    editingItem = null;
  }
  function resetForm(){
    populateObjekBelanjaSelect("");
    populateRekeningSelect("");
    f.objek.value = "";
    f.rekening.value = "";
    $('#fRekeningAkun').val('').trigger('change');
    f.tipe.value = "Pengelompokan Belanja";
    setUraianValue("");
    if (!instansiUraianList || instansiUraianList.length === 0) {
      setUraianMode(true);
    } else {
      setUraianMode(false);
    }
    f.sumberDana.value = "";
    $('#fSumberDana').val('').trigger('change');
    f.jsh.value = "";
    f.komponen.value = "";
    f.spesifikasi.value = "";
    f.satuan.value = "";
    $('#fSatuan').val('').trigger('change');
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
    var sk = MASTER.subKegiatan ? MASTER.subKegiatan.find(function(s){ return s.kode===currentSubKegiatanKode; }) : null;
    var suVal = el("ctxSubUnit") ? el("ctxSubUnit").value : "";
    var su = MASTER.subUnit ? MASTER.subUnit.find(function(s){ return s.kode===suVal; }) : null;
    var prgVal = el("ctxProgram") ? el("ctxProgram").value : "";
    var prg = MASTER.program ? MASTER.program.find(function(p){ return p.kode===prgVal; }) : null;
    var kegVal = el("ctxKegiatan") ? el("ctxKegiatan").value : "";
    var keg = MASTER.kegiatan ? MASTER.kegiatan.find(function(k){ return k.kode===kegVal; }) : null;
    var buVal = el("ctxBidangUrusan") ? el("ctxBidangUrusan").value : "";
    var bu = MASTER.bidangUrusan ? MASTER.bidangUrusan.find(function(b){ return b.kode===buVal; }) : null;

    var pdNama = (el("ctxPerangkatDaerah") ? el("ctxPerangkatDaerah").value : "") || (currentInstansi ? currentInstansi.nama : "");
    var pdKode = currentInstansi && currentInstansi.kode_instansi ? currentInstansi.kode_instansi : (su && su.kode ? su.kode.substring(0, 10) : "");
    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : (su ? su.id_instansi : 0));

    var payload = {
      rincian_id: editingItem ? editingItem.id : 0,
      sub_kegiatan_kode: currentSubKegiatanKode,
      nama_sub_kegiatan: sk ? sk.nama : "",
      tahun: el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>',
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
      objek_belanja: (f.objek && f.objek.selectedIndex >= 0 && f.objek.options[f.objek.selectedIndex].value) ? f.objek.options[f.objek.selectedIndex].text : (OBJEK_MAP[f.objek.value] ? (f.objek.value + ' - ' + OBJEK_MAP[f.objek.value]) : (f.objek.value || "")),
      pengelompokan_tipe: f.tipe.value,
      uraian_pengelompokan: getUraianValue() || (rOpt ? rOpt.nama : "Belanja"),
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
            objekBelanja: f.objek.value || (payload.rekening_kode ? payload.rekening_kode.split('.').slice(0, 3).join('.') : ''),
            objekBelanjaNama: payload.objek_belanja,
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

          if (payload.uraian_pengelompokan && payload.uraian_pengelompokan.trim() !== '') {
            var trimmedU = payload.uraian_pengelompokan.trim();
            if (Array.isArray(instansiUraianList) && instansiUraianList.indexOf(trimmedU) === -1) {
              instansiUraianList.push(trimmedU);
            }
            populateUraianSelect(trimmedU);
          }

          closeModal();
          render();
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: res.message,
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            alert(res.message);
          }
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
    if (el("ctxSubUnit")) {
      el("ctxSubUnit").innerHTML = optionsHTML(MASTER.subUnit, labelFor, "Pilih sub unit");
    }
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
    if (!canCrud) {
      if (btn) btn.style.display = 'none';
      if (currentSubKegiatanKode) {
        var sk = MASTER.subKegiatan ? MASTER.subKegiatan.find(function(s){ return s.kode===currentSubKegiatanKode; }) : null;
        if (hint) {
          hint.className = "context-hint ok";
          hint.textContent = "Sub Kegiatan aktif: " + currentSubKegiatanKode + " - " + (sk?sk.nama:"");
        }
        if (toolbar) toolbar.textContent = "Sub Kegiatan aktif: " + currentSubKegiatanKode + " - " + (sk?sk.nama:"");
      } else {
        if (hint) {
          hint.className = "context-hint";
          hint.textContent = "Pilih Sub Unit sampai Sub Kegiatan di atas untuk melihat rincian belanja.";
        }
        if (toolbar) toolbar.textContent = "Lengkapi pilihan Sub Unit sampai Sub Kegiatan terlebih dahulu.";
      }
      return;
    }
    if(currentSubKegiatanKode){
      var sk = MASTER.subKegiatan ? MASTER.subKegiatan.find(function(s){ return s.kode===currentSubKegiatanKode; }) : null;
      if (btn) btn.disabled = false;
      if (hint) {
        hint.className = "context-hint ok";
        hint.textContent = "Konteks siap. Sub Kegiatan aktif: " + currentSubKegiatanKode + " - " + (sk?sk.nama:"");
      }
      if (toolbar) toolbar.textContent = "Sub Kegiatan aktif: " + currentSubKegiatanKode + " - " + (sk?sk.nama:"");
    } else {
      if (btn) btn.disabled = true;
      if (hint) {
        hint.className = "context-hint";
        hint.textContent = "Lengkapi pilihan Sub Unit \u2192 Bidang Urusan \u2192 Program \u2192 Kegiatan \u2192 Sub Kegiatan di atas sebelum mengisi rincian belanja.";
      }
      if (toolbar) toolbar.textContent = "Lengkapi pilihan Sub Unit sampai Sub Kegiatan terlebih dahulu.";
    }
  }

  /* ---------------- Dynamic Cascading Loaders via AJAX ---------------- */
  function loadCascadeBidangUrusan(suObj, presetBidang, presetProg, presetKeg, presetSubKeg) {
    if (!el("ctxBidangUrusan")) return;
    el("ctxBidangUrusan").innerHTML = '<option value="">Memuat bidang urusan...</option>';
    if (el("ctxProgram")) el("ctxProgram").innerHTML = '<option value="">Pilih program</option>';
    if (el("ctxKegiatan")) el("ctxKegiatan").innerHTML = '<option value="">Pilih kegiatan</option>';
    if (el("ctxSubKegiatan")) el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>';

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
        if (el("ctxBidangUrusan")) el("ctxBidangUrusan").innerHTML = optionsHTML(list, labelFor, "Pilih bidang urusan");

        if (list.length > 0) {
          var targetVal = presetBidang && list.some(function(x){ return x.kode === presetBidang; }) ? presetBidang : list[0].kode;
          if (el("ctxBidangUrusan")) el("ctxBidangUrusan").value = targetVal;
          loadCascadeProgram(targetVal, presetProg, presetKeg, presetSubKeg);
        } else {
          render();
        }
      },
      error: function() {
        if (el("ctxBidangUrusan")) el("ctxBidangUrusan").innerHTML = '<option value="">Gagal memuat</option>';
        render();
      }
    });
  }

  function loadCascadeProgram(bidangKode, presetProg, presetKeg, presetSubKeg) {
    if (!el("ctxProgram")) return;
    el("ctxProgram").innerHTML = '<option value="">Memuat program...</option>';
    if (el("ctxKegiatan")) el("ctxKegiatan").innerHTML = '<option value="">Pilih kegiatan</option>';
    if (el("ctxSubKegiatan")) el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    if (!bidangKode) {
      el("ctxProgram").innerHTML = '<option value="">Pilih program</option>';
      return;
    }

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>';

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
        if (el("ctxProgram")) el("ctxProgram").innerHTML = optionsHTML(list, labelFor, "Pilih program");

        if (list.length > 0) {
          var targetVal = presetProg && list.some(function(x){ return x.kode === presetProg; }) ? presetProg : list[0].kode;
          if (el("ctxProgram")) el("ctxProgram").value = targetVal;
          loadCascadeKegiatan(targetVal, presetKeg, presetSubKeg);
        } else {
          render();
        }
      },
      error: function() {
        if (el("ctxProgram")) el("ctxProgram").innerHTML = '<option value="">Gagal memuat</option>';
        render();
      }
    });
  }

  function loadCascadeKegiatan(progKode, presetKeg, presetSubKeg) {
    if (!el("ctxKegiatan")) return;
    el("ctxKegiatan").innerHTML = '<option value="">Memuat kegiatan...</option>';
    if (el("ctxSubKegiatan")) el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
    currentSubKegiatanKode = null;
    updateTambahState();

    if (!progKode) {
      el("ctxKegiatan").innerHTML = '<option value="">Pilih kegiatan</option>';
      return;
    }

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>';

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
        if (el("ctxKegiatan")) el("ctxKegiatan").innerHTML = optionsHTML(list, labelFor, "Pilih kegiatan");

        if (list.length > 0) {
          var targetVal = presetKeg && list.some(function(x){ return x.kode === presetKeg; }) ? presetKeg : list[0].kode;
          if (el("ctxKegiatan")) el("ctxKegiatan").value = targetVal;
          loadCascadeSubKegiatan(targetVal, presetSubKeg);
        } else {
          render();
        }
      },
      error: function() {
        if (el("ctxKegiatan")) el("ctxKegiatan").innerHTML = '<option value="">Gagal memuat</option>';
        render();
      }
    });
  }

  function loadCascadeSubKegiatan(kegKode, presetVal) {
    if (!el("ctxSubKegiatan")) return;
    el("ctxSubKegiatan").innerHTML = '<option value="">Memuat sub kegiatan...</option>';
    currentSubKegiatanKode = null;
    cachedPaguTahapan = null;
    renderPaguCards();
    updateTambahState();

    if (!kegKode) {
      el("ctxSubKegiatan").innerHTML = '<option value="">Pilih sub kegiatan</option>';
      return;
    }

    var instId = activeInstansiId || (currentInstansi ? currentInstansi.id : 0);
    var thnVal = el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>';

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
          var targetVal = null;
          if (presetVal && list.some(function(x){ return x.kode === presetVal; })) {
            targetVal = presetVal;
          } else {
            var itemWithRincian = list.find(function(x){ return items.some(function(it){ return it.subKegiatanKode === x.kode; }); });
            targetVal = itemWithRincian ? itemWithRincian.kode : list[0].kode;
          }
          el("ctxSubKegiatan").value = targetVal;
          currentSubKegiatanKode = targetVal;
          fetchPaguTahapan(currentSubKegiatanKode);
        } else {
          currentSubKegiatanKode = null;
          cachedPaguTahapan = null;
          renderPaguCards();
        }
        updateTambahState();
        render();
      },
      error: function() {
        if (el("ctxSubKegiatan")) el("ctxSubKegiatan").innerHTML = '<option value="">Gagal memuat</option>';
        currentSubKegiatanKode = null;
        cachedPaguTahapan = null;
        renderPaguCards();
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
      if (el("ctxSubUnit")) el("ctxSubUnit").value = firstSU;
      updatePerangkatDaerah(firstSU);

      var firstHeader = (rawBelanjaHeaders && rawBelanjaHeaders.length > 0) ? rawBelanjaHeaders[0] : null;
      var presetBidang = firstHeader ? (firstHeader.kode_bidang_urusan || '') : '';
      var presetProg = firstHeader ? (firstHeader.kode_program || '') : '';
      var presetKeg = firstHeader ? (firstHeader.kode_kegiatan || '') : '';
      var presetSubKeg = firstHeader ? (firstHeader.kode_sub_kegiatan || '') : '';

      loadCascadeBidangUrusan(MASTER.subUnit[0], presetBidang, presetProg, presetKeg, presetSubKeg);
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

          var firstHeader = (rawBelanjaHeaders && rawBelanjaHeaders.length > 0) ? rawBelanjaHeaders[0] : null;
          var presetBidang = firstHeader ? (firstHeader.kode_bidang_urusan || '') : '';
          var presetProg = firstHeader ? (firstHeader.kode_program || '') : '';
          var presetKeg = firstHeader ? (firstHeader.kode_kegiatan || '') : '';
          var presetSubKeg = firstHeader ? (firstHeader.kode_sub_kegiatan || '') : '';

          var curSU = MASTER.subUnit.find(function(s){ return s.kode === (el("ctxSubUnit") ? el("ctxSubUnit").value : ''); });
          loadCascadeBidangUrusan(curSU || MASTER.subUnit[0], presetBidang, presetProg, presetKeg, presetSubKeg);
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
        url: ControllerURL + "GetUraianPengelompokanRekomendasi",
        type: "POST",
        data: { instansi_id: newInstId },
        dataType: "json",
        success: function(uRes) {
          if (uRes.status === 'success' && Array.isArray(uRes.data)) {
            instansiUraianList = uRes.data;
            refreshDatalists();
          }
        }
      });

      $.ajax({
        url: ControllerURL + "GetSubUnitsByInstansi",
        type: "POST",
        data: { instansi_id: newInstId },
        dataType: "json",
        success: function(res) {
          if (res.status === 'success') {
            currentInstansi = res.instansi || { id: newInstId, nama: selectedText };
            initialSubUnits = res.data || [];

            var thnVal = el("ctxTahun") ? el("ctxTahun").value : '<?= $TahunAktif ?>';
            $.ajax({
              url: ControllerURL + "GetBelanjaData",
              type: "POST",
              data: { tahun: thnVal, instansi: newInstId },
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

  if (el("ctxTahun")) {
    el("ctxTahun").addEventListener("change", function() {
      loadBelanjaByTahun(this.value);
    });
  }

  if (el("ctxSubUnit")) {
    el("ctxSubUnit").addEventListener("change", function(){
      var suVal = this.value;
      var suObj = MASTER.subUnit.find(function(x){ return x.kode === suVal; });
      updatePerangkatDaerah(suVal);
      loadCascadeBidangUrusan(suObj);
    });
  }

  if (el("ctxBidangUrusan")) {
    el("ctxBidangUrusan").addEventListener("change", function(){
      loadCascadeProgram(this.value);
    });
  }

  if (el("ctxProgram")) {
    el("ctxProgram").addEventListener("change", function(){
      loadCascadeKegiatan(this.value);
    });
  }

  if (el("ctxKegiatan")) {
    el("ctxKegiatan").addEventListener("change", function(){
      loadCascadeSubKegiatan(this.value);
    });
  }

  if (el("ctxSubKegiatan")) {
    el("ctxSubKegiatan").addEventListener("change", function(){
      currentSubKegiatanKode = this.value || null;
      updateTambahState();
      fetchPaguTahapan(currentSubKegiatanKode);
      render();
    });
  }

  /* ---------------- Standar Harga Picker ---------------- */
  var pickerOverlay = document.getElementById("pickerOverlay");

  function getPickerTypeFromJsh(val) {
    if (!val) return '';
    if (val.indexOf('SSH') > -1 || (val.indexOf('Satuan Harga') > -1 && val.indexOf('Regional') === -1)) return 'ssh';
    if (val.indexOf('HSPK') > -1 || val.indexOf('Pokok') > -1) return 'hspk';
    if (val.indexOf('ASB') > -1 || val.indexOf('Analisis') > -1) return 'asb';
    if (val.indexOf('Regional') > -1 || val.indexOf('SBU') > -1) return 'sbu';
    return '';
  }

  function getJshLabel(type) {
    var jshMap = {
      'ssh': 'Standar Satuan Harga (SSH)',
      'hspk': 'Harga Satuan Pokok Kegiatan (HSPK)',
      'asb': 'Analisis Standar Belanja (ASB)',
      'sbu': 'Standar Harga Satuan Regional (SBU)'
    };
    return jshMap[type] || 'Standar Satuan Harga (SSH)';
  }

  function openPickerModalForCurrentJsh() {
    var selJsh = f.jsh ? f.jsh.value : '';
    var pType = getPickerTypeFromJsh(selJsh);
    if (!pType) {
      alert("Silakan pilih Jenis Standar Harga terlebih dahulu.");
      if (f.jsh) f.jsh.focus();
      return;
    }

    currentPickerType = pType;
    var typeLabel = getJshLabel(pType);

    var titleEl = document.getElementById("pickerModalTitle");
    if (titleEl) titleEl.textContent = "Pilih Komponen: " + typeLabel;
    var descEl = document.getElementById("pickerModalDesc");
    if (descEl) descEl.textContent = "Menampilkan daftar komponen khusus untuk " + typeLabel;
    var lblEl = document.getElementById("lblActivePickerType");
    if (lblEl) lblEl.textContent = typeLabel;

    pickerOverlay.classList.remove("hidden");
    document.getElementById("inputSearchStandar").value = "";
    loadStandarHargaItems(currentPickerType, "");
  }

  $('#fJenisStandarHarga').on('change', function() {
    var val = $(this).val();
    if (val) {
      currentPickerType = getPickerTypeFromJsh(val);
    }
  });

  document.getElementById("btnOpenStandarPicker").addEventListener("click", function() {
    openPickerModalForCurrentJsh();
  });

  document.getElementById("btnClosePicker").addEventListener("click", function() {
    pickerOverlay.classList.add("hidden");
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
          $tbody.html('<tr><td colspan="6" class="center" style="padding:24px; color:var(--ui-text-muted);">Tidak ada data komponen ' + esc(getJshLabel(type)) + ' yang sesuai.</td></tr>');
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
    var sVal = item.satuan || "Unit";
    f.satuan.value = sVal;
    if (sVal && !$('#fSatuan option[value="' + sVal + '"]').length) {
      var newOpt = new Option(sVal, sVal, true, true);
      $('#fSatuan').append(newOpt).trigger('change');
    } else {
      $('#fSatuan').val(sVal).trigger('change');
    }
    f.harga.value = item.harga_satuan || 0;
    f.koefisien.value = 1;
    f.volume.value = 1;
    f.koefKet.value = "1 " + (item.satuan || "Unit");
    var jshMap = {
      'ssh': 'Standar Satuan Harga (SSH)',
      'hspk': 'Harga Satuan Pokok Kegiatan (HSPK)',
      'asb': 'Analisis Standar Belanja (ASB)',
      'sbu': 'Standar Harga Satuan Regional (SBU)'
    };
    f.jsh.value = jshMap[currentPickerType] || "Standar Satuan Harga (SSH)";
    
    if (item.kode_rekening) {
      var kRek = item.kode_rekening.split(',')[0].trim();
      var found = REKENING_OPTIONS.some(function(r){ return r.kode === kRek; });
      if (!found) {
        REKENING_OPTIONS.unshift({ kode: kRek, nama: item.uraian_kelompok_barang || "Belanja Rekening" });
      }
      var pParts = kRek.split('.');
      var pObj = pParts.slice(0, 3).join('.');
      if (pObj && OBJEK_MAP[pObj]) {
        f.objek.value = pObj;
        populateRekeningSelect(kRek, pObj);
      } else {
        populateRekeningSelect(kRek);
      }
      f.rekening.value = kRek;
      var uKb = item.uraian_kelompok_barang || "";
      setUraianValue(uKb);
    }

    updateTotalPreview();
    pickerOverlay.classList.add("hidden");
  });

  /* ---------------- Event wiring ---------------- */
  var btnTambahEl = document.getElementById("btnTambah");
  if (btnTambahEl) {
    btnTambahEl.addEventListener("click", function(){
      if(!currentSubKegiatanKode){
        alert("Pilih Sub Unit, Bidang Urusan, Program, Kegiatan, dan Sub Kegiatan terlebih dahulu.");
        return;
      }
      openModal(null);
    });
  }
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
    if(!canCrud) return;
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
            var targetInst = activeInstansiId || (currentInstansi ? currentInstansi.id : '');
            if (targetInst) {
              $.ajax({
                url: ControllerURL + "GetUraianPengelompokanRekomendasi",
                type: "POST",
                data: { instansi_id: targetInst },
                dataType: "json",
                success: function(uRes) {
                  if (uRes.status === 'success' && Array.isArray(uRes.data)) {
                    instansiUraianList = uRes.data;
                    populateUraianSelect();
                  }
                }
              });
            }
            render();
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: res.message,
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              alert(res.message);
            }
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
  initRenjaStageEvents();
})();
</script>
</body>
</html>