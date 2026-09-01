<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

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
    
    --ui-blue: #0284c7;
    --ui-blue-light: #f0f9ff;
    --ui-blue-border: #bae6fd;
    --ui-orange: #f59e0b;
    --ui-orange-light: #fef3c7;
    --ui-red: #ef4444;
    --ui-red-light: #fee2e2;
    --ui-green: #10b981;
    --ui-green-dark: #059669;
    --ui-green-light: #d1fae5;
    --ui-slate: #64748b;
    
    --ui-text-black: #0f172a;
    --ui-text-main: #1e293b;
    --ui-text-secondary: #475569;
    --ui-text-muted: #64748b;
    
    --ui-bg: #f8fafc;
    --ui-card-bg: #ffffff;
    --ui-border: #e2e8f0;
    --ui-border-light: #f1f5f9;
    
    --th-bg: #00c292;
    --th-sub-bg: #00a87e;
    --th-color: #ffffff;
    
    --radius-sm: 6px;
    --radius-md: 8px;
    --radius-lg: 12px;
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
  }

  * { box-sizing: border-box; }
  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: var(--ui-bg);
    color: var(--ui-text-main);
    margin: 0;
    padding: 0;
    font-size: 13.5px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
  }

  .main-content {
    margin-left: var(--sidebar-width, 280px);
    padding: 20px 24px 80px;
    min-height: 100vh;
    transition: all var(--transition-speed, 0.3s) ease;
  }

  .sidebar-mini .main-content {
    margin-left: var(--sidebar-mini-width, 70px);
  }

  .app-container {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
  }

  /* ===== Filter Card ===== */
  .filter-card {
    background: var(--ui-card-bg);
    border-radius: var(--radius-lg);
    border: 1px solid var(--ui-border);
    box-shadow: var(--shadow-sm);
    padding: 16px 20px;
    margin-bottom: 18px;
  }

  .filter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--ui-border-light);
  }

  .filter-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--ui-text-black);
    display: flex;
    align-items: center;
    gap: 8px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .filter-title i {
    color: var(--ui-primary);
    font-size: 16px;
  }

  .filter-grid {
    display: grid;
    grid-template-columns: 160px 1.5fr 1fr auto;
    gap: 14px;
    align-items: flex-end;
  }

  @media (max-width: 992px) {
    .filter-grid {
      grid-template-columns: 1fr;
    }
  }

  .filter-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .filter-group label {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--ui-text-black) !important;
    letter-spacing: 0.1px;
    margin-bottom: 0;
  }

  .form-control-custom {
    height: 38px;
    padding: 0 12px;
    font-size: 13px;
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    background: #ffffff;
    color: var(--ui-text-black);
    font-weight: 500;
    outline: none;
    transition: all 0.2s;
    width: 100%;
  }

  .form-control-custom:focus {
    border-color: var(--ui-primary);
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
  }

  .search-box {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
  }

  .search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 13px;
    pointer-events: none;
    z-index: 2;
  }

  .search-box input {
    width: 100%;
    height: 38px;
    padding: 0 12px 0 34px !important;
    font-size: 13px;
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    background: #ffffff;
    color: var(--ui-text-black);
    font-weight: 500;
    outline: none;
    transition: all 0.2s;
  }

  .search-box input:focus {
    border-color: var(--ui-primary);
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
  }

  /* ===== Page Header & Summary Card ===== */
  .page-header-card {
    background: var(--ui-card-bg);
    border-radius: var(--radius-lg);
    border: 1px solid var(--ui-border);
    box-shadow: var(--shadow-sm);
    padding: 16px 20px;
    margin-bottom: 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }

  .page-header-info h1 {
    font-size: 19px;
    font-weight: 800;
    color: var(--ui-text-black);
    margin: 0 0 4px;
    letter-spacing: -0.2px;
  }

  .page-header-info p {
    margin: 0;
    font-size: 13px;
    color: var(--ui-text-secondary);
  }

  .grand-stats-grid {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .stat-badge-box {
    background: var(--ui-primary-light);
    border: 1px solid var(--ui-primary-border);
    border-radius: var(--radius-md);
    padding: 8px 16px;
    text-align: right;
    min-width: 180px;
  }

  .stat-badge-box .lbl {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    color: var(--ui-primary-text);
    margin-bottom: 2px;
  }

  .stat-badge-box .val {
    font-size: 18px;
    font-weight: 800;
    color: var(--ui-primary-text);
    font-family: 'Roboto Mono', monospace;
  }

  /* ===== Toolbar ===== */
  .toolbar-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    gap: 12px;
    flex-wrap: wrap;
  }

  .search-box {
    position: relative;
    min-width: 280px;
    max-width: 400px;
    flex: 1;
  }

  .search-box input {
    width: 100%;
    height: 38px;
    padding: 0 12px 0 36px;
    font-size: 13px;
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    background: #ffffff;
    outline: none;
    transition: all 0.2s;
  }

  .search-box input:focus {
    border-color: var(--ui-primary);
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
  }

  .search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ui-text-muted);
    font-size: 14px;
  }

  .btn {
    height: 38px;
    padding: 0 16px;
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    border: 1px solid transparent;
    transition: all 0.15s ease-in-out;
    text-decoration: none;
    white-space: nowrap;
  }
  .btn:active { transform: translateY(1px); }

  .btn-primary {
    background: var(--ui-primary);
    color: #ffffff !important;
    border-color: var(--ui-primary);
  }
  .btn-primary:hover {
    background: var(--ui-primary-hover);
    border-color: var(--ui-primary-hover);
    color: #ffffff !important;
  }

  .btn-outline {
    background: #ffffff;
    color: var(--ui-text-black);
    border: 1px solid var(--ui-border);
  }
  .btn-outline:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
  }

  .btn-sync {
    background: #ecfdf5;
    color: var(--ui-primary-text);
    border: 1px solid var(--ui-primary-border);
  }
  .btn-sync:hover {
    background: #d1fae5;
  }

  .legend-bar {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: center;
    background: #ffffff;
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    padding: 10px 16px;
    margin-bottom: 14px;
    font-size: 12.5px;
    color: var(--ui-text-secondary);
  }

  .legend-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 3px;
    display: inline-block;
  }
  .dot-tujuan { background: #1e293b; }
  .dot-ss { background: #2563eb; }
  .dot-sp { background: #6366f1; }
  .dot-sk { background: #0d9488; }
  .dot-sub { background: #00c292; }

  /* ===== Main Table Card ===== */
  .table-card {
    background: var(--ui-card-bg);
    border-radius: var(--radius-lg);
    border: 1px solid var(--ui-border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }

  .table-scroll {
    overflow: auto;
    max-height: 75vh;
    width: 100%;
  }

  table.main-table {
    border-collapse: collapse;
    width: 100%;
    min-width: 1800px;
    font-size: 12.8px;
    background: #ffffff;
  }

  table.main-table th,
  table.main-table td {
    border: 1px solid var(--ui-border);
    padding: 8px 10px;
    vertical-align: middle;
    text-align: left;
  }

  table.main-table thead th {
    background: #f1f5f9;
    color: #334155;
    font-weight: 700;
    font-size: 12px;
    text-align: center;
    vertical-align: middle;
    position: sticky;
    top: 0;
    z-index: 2;
  }
  table.main-table thead tr:nth-child(1) th { top: 0; }
  table.main-table thead tr:nth-child(2) th { top: 34px; }
  table.main-table thead tr:nth-child(3) th { top: 64px; }

  .sub-note { color: var(--ui-text-muted); font-weight: 400; font-size: 10.5px; }
  .text-center { text-align: center; }
  .text-right { text-align: right; }
  .dash { color: #cbd5e1; }

  /* Hierarchy Row & Cell Styling */
  td.cell-name { min-width: 260px; font-size: 12.5px; }
  td.cell-name-tujuan { border-left: 5px solid #1e293b !important; }
  td.cell-name-ss { border-left: 5px solid #2563eb !important; }
  td.cell-name-sp { border-left: 5px solid #6366f1 !important; }
  td.cell-name-sk { border-left: 5px solid #0d9488 !important; }
  td.cell-name-sub { border-left: 5px solid #00c292 !important; }

  .lvl-prefix { font-weight: 800; color: #0f172a; }
  .lvl-name-blue { font-weight: 700; color: #0f766e; }
  .lvl-note { font-style: normal; font-weight: 600; color: #475569; font-size: 11.5px; margin-top: 3px; }

  td.cell-anggaran {
    font-weight: 700;
    color: #047857;
    white-space: nowrap;
    text-align: right;
    font-family: 'Roboto Mono', monospace;
    font-size: 12.5px;
  }

  td.cell-uraian-empty { text-align: center; }

  .badge-valid {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 9999px;
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
    font-size: 11px;
    font-weight: 700;
  }
  .badge-invalid {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 9999px;
    background: #fef2f2;
    color: #991b1b;
    border: 1px solid #fecaca;
    font-size: 11px;
    font-weight: 700;
  }

  td.cell-opsi { text-align: center; }
  .opsi-btn-group { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; }
  
  .btn-icon-edit {
    border: none;
    border-radius: 6px;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: var(--ui-primary-light);
    color: var(--ui-primary-text);
    border: 1px solid var(--ui-primary-border);
    transition: all 0.15s;
  }
  .btn-icon-edit:hover {
    background: #cbf0e6;
    transform: scale(1.05);
  }

  .btn-icon-danger {
    border: none;
    border-radius: 6px;
    width: 28px;
    height: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: #fef2f2;
    color: var(--ui-red);
    border: 1px solid #fee2e2;
  }
  .btn-icon-danger:hover {
    background: #fee2e2;
  }

  .row-tujuan { background: #ffffff; }
  .row-ss { background: #fafcff; }
  .row-sp { background: #ffffff; }
  .row-sk { background: #fafcff; }
  .row-sub { background: #ffffff; }
  .row-sub:hover { background: #f0fdf9; }

  .empty-state {
    padding: 50px !important;
    text-align: center;
    color: var(--ui-text-muted);
    font-size: 14px;
  }

  /* ===== Modal Styling (Centering & No-Header-Overlay) ===== */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 85px 16px 40px;
    overflow-y: auto;
    z-index: 999999 !important;
  }
  .modal-overlay.hidden { display: none !important; }

  #modalContent {
    width: 100%;
    max-width: 980px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
    position: relative;
    z-index: 200001;
  }

  .modal-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    width: 100%;
    max-width: 980px;
    max-height: calc(100vh - 48px);
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.4);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    margin: auto;
    position: relative;
    z-index: 200001;
    animation: modalPop 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .modal-card.wide { max-width: 1200px; }
  #modalContent:has(.modal-card.wide) { max-width: 1200px; }

  @keyframes modalPop {
    from { opacity: 0; transform: scale(0.96) translateY(-12px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
  }

  .modal-header {
    flex: 0 0 auto;
    display: flex;
    gap: 14px;
    align-items: center;
    padding: 18px 24px;
    border-bottom: 1px solid var(--ui-border);
    background: #ffffff;
  }

  .modal-icon {
    flex: none;
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: var(--ui-primary-light);
    color: var(--ui-primary);
    border: 1px solid var(--ui-primary-border);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-header h2 {
    margin: 0 0 4px 0;
    font-size: 17px;
    font-weight: 800;
    color: var(--ui-text-black);
    letter-spacing: 0.2px;
  }
  .modal-subtitle {
    margin: 0;
    color: var(--ui-text-secondary);
    font-size: 12.5px;
  }

  .modal-body {
    flex: 1 1 auto;
    padding: 20px 24px;
    max-height: calc(100vh - 190px);
    overflow-y: auto;
    background: #f8fafc;
  }

  .modal-footer {
    flex: 0 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding: 14px 24px;
    border-top: 1px solid var(--ui-border);
    background: #ffffff;
  }
  .footer-right { display: flex; gap: 10px; }

  /* Info Box inside modal */
  .info-box {
    background: #ffffff;
    border: 1px solid var(--ui-border);
    border-radius: var(--radius-md);
    padding: 14px 16px;
    margin-bottom: 16px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
  }

  .box-label {
    font-weight: 700;
    color: #0f766e;
    font-size: 13.5px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .box-desc {
    margin: 0 0 10px 0;
    color: var(--ui-text-muted);
    font-size: 12.5px;
  }

  .keterangan-box {
    margin-top: 12px;
    background: var(--ui-primary-light);
    border: 1px solid var(--ui-primary-border);
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 12px;
    color: var(--ui-primary-text);
  }

  /* Tables inside modal */
  table.info-table, table.tw-table, table.pagu-table, table.tahap-table, table.ind-edit-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    font-size: 12.5px;
  }
  table.info-table th, table.info-table td,
  table.tw-table th, table.tw-table td,
  table.pagu-table th, table.pagu-table td,
  table.tahap-table th, table.tahap-table td,
  table.ind-edit-table th, table.ind-edit-table td {
    border: 1px solid var(--ui-border);
    padding: 7px 8px;
    vertical-align: middle;
  }

  table.info-table th, table.tw-table th, table.pagu-table th, table.tahap-table th, table.ind-edit-table th {
    background: #f1f5f9;
    font-weight: 700;
    color: #334155;
    font-size: 11.8px;
    text-align: center;
  }

  .info-name-cell { font-weight: 600; min-width: 180px; }

  /* Input fields */
  input[type="text"], input[type="number"], select {
    width: 100%;
    padding: 6px 8px;
    border: 1px solid var(--ui-border);
    border-radius: 6px;
    font-size: 12.5px;
    color: var(--ui-text-black);
    font-family: inherit;
    background: #ffffff;
    outline: none;
    transition: border 0.15s;
  }
  input:focus, select:focus {
    border-color: var(--ui-primary);
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2);
  }

  .pagu-input { text-align: right; font-family: 'Roboto Mono', monospace; font-size: 12px; }

  .input-rupiah-box {
    display: inline-flex;
    align-items: center;
    border: 1px solid var(--ui-border);
    border-radius: 6px;
    background: #ffffff;
    padding: 0 4px 0 6px;
    height: 30px;
    width: 100%;
    min-width: 105px;
    transition: all 0.2s;
  }
  .input-rupiah-box:focus-within {
    border-color: var(--ui-primary);
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2);
  }
  .input-rupiah-box .prefix {
    font-size: 11px;
    font-weight: 700;
    color: var(--ui-text-muted);
    user-select: none;
    margin-right: 3px;
  }
  .input-rupiah-box input {
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
    width: 100% !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    text-align: right !important;
    outline: none !important;
    font-family: 'Roboto Mono', monospace !important;
    color: var(--ui-text-black) !important;
    padding: 0 !important;
  }

  .btn-add-row {
    background: #ecfdf5;
    color: var(--ui-primary-text);
    border: 1px solid var(--ui-primary-border);
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    margin-bottom: 8px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.15s;
  }
  .btn-add-row:hover { background: #d1fae5; }

  .pagu-total { font-weight: 800; color: #047857; text-align: right; font-family: 'Roboto Mono', monospace; }
  .bobot-total { font-weight: 800; color: #0f766e; text-align: center; }

  /* Toast Notification */
  .toast-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 2000;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .toast-box {
    padding: 12px 18px;
    border-radius: var(--radius-md);
    background: #1e293b;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    gap: 10px;
    animation: toastIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .toast-box.success { background: #047857; }
  .toast-box.error { background: #b91c1c; }
  @keyframes toastIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="main-content">
  <div class="app-container">

    <!-- FILTER PROVINSI & KAB/KOTA & INSTANSI (SAAT BELUM LOGIN & LOGIN DAERAH) -->
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
        <div class="filter-grid" style="display:flex; flex-wrap:wrap; align-items:flex-end; gap:12px;">
          <?php if (empty($IsLoggedIn)): ?>
            <div class="filter-group" style="flex:1; min-width:180px;">
              <label>Provinsi</label>
              <select class="form-control-custom" id="selProvinsiTop">
                <option value="">Pilih Provinsi</option>
                <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                  <option value="<?= html_escape($prov['Kode']) ?>"
                    <?= (!empty($provKodeCurrent) && $provKodeCurrent==$prov['Kode']) ? 'selected' : '' ?>>
                    <?= html_escape($prov['Nama']) ?>
                  </option>
                <?php } } ?>
              </select>
            </div>

            <div class="filter-group" style="flex:1; min-width:180px;">
              <label>Kabupaten / Kota</label>
              <select class="form-control-custom" id="selKabKotaTop">
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

          <div class="filter-group" id="grpInstansiTop" style="flex:1.2; min-width:220px; <?= (!empty($IsLoggedIn) || !empty($KodeWilayah)) ? '' : 'display:none;' ?>">
            <label>Perangkat Daerah / Instansi</label>
            <select class="form-control-custom" id="selInstansiTop">
              <option value="">-- Semua Perangkat Daerah --</option>
              <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
                <option value="<?= $ins['id'] ?>" <?= (!empty($FilterInstansi) && $FilterInstansi == $ins['id']) ? 'selected' : '' ?>>
                  <?= html_escape($ins['nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div style="margin-top:auto;">
            <button type="button" class="btn btn-primary" id="btnFilterWilayahTop" style="height:42px;">
              <i class="fa fa-search"></i> <?= empty($IsLoggedIn) ? 'Terapkan Wilayah' : 'Terapkan Filter' ?>
            </button>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- Filter Card -->
    <div class="filter-card">
      <div class="filter-header">
        <div class="filter-title">
          <i class="fa fa-sliders"></i> Parameter & Filter Target Renaksi
        </div>
      </div>
      <form method="GET" action="<?=base_url('Instansi/TargetRenaksi')?>">
        <div class="filter-grid">
          <div class="filter-group">
            <label>Tahun Anggaran</label>
            <select name="tahun" class="form-control-custom" onchange="this.form.submit()">
              <?php foreach($ListTahun as $th): ?>
                <option value="<?=$th?>" <?=(isset($TahunAktif) && $TahunAktif == $th)?'selected':''?>><?=$th?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <input type="hidden" name="instansi_id" value="<?=$FilterInstansi?>">

          <div class="filter-group">
            <label>Pencarian Cepat</label>
            <div class="search-box" style="min-width: 100%;">
              <i class="fa fa-search"></i>
              <input type="text" id="searchInput" placeholder="Cari program, kegiatan, sub kegiatan..." onkeyup="filterTableLive()">
            </div>
          </div>

          <div style="display:flex; gap:8px;">
            <?php if (!empty($IsRole4)): ?>
              <button type="button" class="btn btn-sync" onclick="syncDpaAnggaran()" title="Salin RAK dari DPA ke Anggaran Bulanan">
                <i class="fa fa-refresh"></i> Tarik RAK DPA
              </button>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-filter"></i> Terapkan
            </button>
          </div>
        </div>
      </form>
    </div>

    <?php
    $currentInstansiName = '';
    if (!empty($FilterInstansi) && !empty($ListInstansi)) {
        foreach ($ListInstansi as $ins) {
            if ((int)$ins['id'] === (int)$FilterInstansi) {
                $currentInstansiName = $ins['nama'];
                break;
            }
        }
    }
    ?>

    <!-- Page Header & Summary -->
    <div class="page-header-card">
      <div class="page-header-info">
        <h1>Tabel Hierarki Target Rencana Aksi (Renaksi)</h1>
        <p>Tujuan &rarr; Sasaran Strategis &rarr; Sasaran Program &rarr; Sasaran Kegiatan &rarr; Sasaran Sub Kegiatan. Anggaran terakumulasi otomatis dari Sub Kegiatan.</p>
      </div>
      <div class="grand-stats-grid">
        <div class="stat-badge-box">
          <div class="lbl">Tahun Aktif</div>
          <div class="val" id="statTahun"><?=$TahunAktif?></div>
        </div>
        <?php if (!empty($currentInstansiName)): ?>
          <div class="stat-badge-box">
            <div class="lbl">Perangkat Daerah</div>
            <div class="val" style="font-size: 13px; font-weight:700; color: var(--ui-primary-dark);"><?=htmlspecialchars($currentInstansiName)?></div>
          </div>
        <?php endif; ?>
        <div class="stat-badge-box">
          <div class="lbl">Total Anggaran Sub Kegiatan</div>
          <div class="val" id="statTotalAnggaran">Rp 0</div>
        </div>
      </div>
    </div>

    <!-- Legend -->
    <div class="legend-bar">
      <span class="legend-item"><span class="legend-dot dot-tujuan"></span> <b>Tujuan</b></span>
      <span class="legend-item"><span class="legend-dot dot-ss"></span> <b>Sasaran Strategis</b></span>
      <span class="legend-item"><span class="legend-dot dot-sp"></span> <b>Sasaran Program</b></span>
      <span class="legend-item"><span class="legend-dot dot-sk"></span> <b>Sasaran Kegiatan</b></span>
      <span class="legend-item"><span class="legend-dot dot-sub"></span> <b>Sasaran Sub Kegiatan</b></span>
      <span style="margin-left:auto; color:var(--ui-text-muted); font-size:12px;">
        <i class="fa fa-pencil text-primary"></i> Klik tombol <b>Edit</b> untuk mengisi target triwulan, pagu anggaran bulanan, & rencana aksi.
      </span>
    </div>

    <!-- Main Hierarchy Table Card -->
    <div class="table-card">
      <div class="table-scroll">
        <table class="main-table" id="mainHierTable">
          <thead>
            <tr>
              <th rowspan="3" style="min-width:280px;">Tujuan/ Sasaran Strategis/<br>Sasaran Program/ Sasaran<br>Kegiatan/ Sasaran Sub Kegiatan</th>
              <th rowspan="3" style="min-width:220px;">Indikator Kinerja</th>
              <th rowspan="3" style="width:80px;">Satuan</th>
              <th rowspan="3" style="width:90px;">Target<br>Tahunan</th>
              <th colspan="4">Target dan Realisasi Per Triwulan</th>
              <th rowspan="3" style="width:140px;">Anggaran (Rp)</th>
              <th colspan="5">Rencana Aksi Sub Kegiatan</th>
              <?php if (!empty($IsRole4)): ?>
                <th rowspan="3" style="width:70px;">Opsi Aksi</th>
              <?php endif; ?>
            </tr>
            <tr>
              <th rowspan="2" style="width:75px;">Triwulan I</th>
              <th rowspan="2" style="width:75px;">Triwulan II</th>
              <th rowspan="2" style="width:75px;">Triwulan III</th>
              <th rowspan="2" style="width:75px;">Triwulan IV</th>
              <th rowspan="2" style="min-width:200px;">Uraian</th>
              <th colspan="2">Target Output</th>
              <th rowspan="2" style="width:105px;">Bobot Kinerja<br>Proses (%) Per<br>Output</th>
              <th rowspan="2" style="width:105px;">Rencana<br>Pelaksanaan<br>(Bulan)</th>
            </tr>
            <tr>
              <th style="width:65px;">Nilai</th>
              <th style="width:75px;">Satuan</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <!-- Rendered by JS -->
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Modal Container -->
<div id="modalOverlay" class="modal-overlay hidden">
  <div id="modalContent"></div>
</div>

<!-- Toast Container -->
<div id="toastContainer" class="toast-container"></div>

<script>
/* =========================================================
   INITIAL DATA FROM CONTROLLER
   ========================================================= */
var initialRenaksiTree = <?=json_encode(isset($RenaksiTree) ? $RenaksiTree : ['tujuanList' => []])?>;
var isRole4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;
var currentTahun = "<?=isset($TahunAktif) ? $TahunAktif : date('Y')?>";
var currentInstansiId = "<?=isset($FilterInstansi) ? $FilterInstansi : (isset($InstansiId) ? $InstansiId : '')?>";
var currentKodeWilayah = "<?=isset($KodeWilayah) ? $KodeWilayah : '35.73'?>";
var baseUrl = "<?=base_url()?>";

var state = initialRenaksiTree;

/* =========================================================
   ICONS & CONSTANTS
   ========================================================= */
var editIconSVG = '<i class="fa fa-pencil" style="font-size:13px;"></i>';
var plusIconSVG = '<i class="fa fa-plus" style="font-size:11px;"></i>';
var trashIconSVG = '<i class="fa fa-trash" style="font-size:12px;"></i>';
var targetIconSVG = '<i class="fa fa-bullseye" style="font-size:20px;"></i>';

var MONTHS = [
  ['jan','Januari'],['feb','Februari'],['mar','Maret'],['apr','April'],
  ['mei','Mei'],['jun','Juni'],['jul','Juli'],['agu','Agustus'],
  ['sep','September'],['okt','Oktober'],['nov','November'],['des','Desember']
];
var MONTH_NAMES = MONTHS.map(function(m){ return m[1]; });

function emptyPagu(){
  var p = {};
  MONTHS.forEach(function(m){ p[m[0]] = 0; });
  return p;
}

function escapeHtml(str){
  if(str===null || str===undefined) return '';
  return String(str).replace(/[&<>"']/g, function(ch){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[ch];
  });
}
function escapeAttr(str){ return escapeHtml(str); }

function formatRupiah(n){
  n = Number(n) || 0;
  return 'Rp ' + n.toLocaleString('id-ID');
}
function fmtNum(n){
  if(n===null || n===undefined || n==='') return '';
  var num = typeof n === 'string' ? Number(n.replace(',', '.')) : Number(n);
  if(isNaN(num)) return String(n);
  return num.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
}

/* =========================================================
   FINDER HELPERS
   ========================================================= */
function findTujuan(tId){ return (state.tujuanList || []).find(function(t){ return t.id===tId; }); }
function findSS(tId,ssId){ var t=findTujuan(tId); return t && (t.sasaranStrategisList||[]).find(function(s){ return s.id===ssId; }); }
function findSP(tId,ssId,spId){ var ss=findSS(tId,ssId); return ss && (ss.sasaranProgramList||[]).find(function(p){ return p.id===spId; }); }
function findSK(tId,ssId,spId,skId){ var sp=findSP(tId,ssId,spId); return sp && (sp.sasaranKegiatanList||[]).find(function(k){ return k.id===skId; }); }
function findSUB(tId,ssId,spId,skId,subId){ var sk=findSK(tId,ssId,spId,skId); return sk && (sk.sasaranSubKegiatanList||[]).find(function(s){ return String(s.id)===String(subId) || String(s.headerId)===String(subId); }); }

/* =========================================================
   AGREGASI ANGGARAN
   ========================================================= */
function computeSubAnggaran(sub){
  if(sub.anggaran !== undefined && sub.anggaran !== null && Number(sub.anggaran) > 0) {
    return Number(sub.anggaran);
  }
  var total = 0;
  if(sub.paguBulanan){
    MONTHS.forEach(function(m){ total += Number(sub.paguBulanan[m[0]]) || 0; });
  }
  if(total > 0) return total;
  return Number(sub.anggaran) || 0;
}
function computeSKAnggaran(sk){
  return (sk.sasaranSubKegiatanList||[]).reduce(function(s,sub){ return s + computeSubAnggaran(sub); }, 0);
}
function computeSPAnggaran(sp){
  return (sp.sasaranKegiatanList||[]).reduce(function(s,sk){ return s + computeSKAnggaran(sk); }, 0);
}
function computeSSAnggaran(ss){
  return (ss.sasaranProgramList||[]).reduce(function(s,sp){ return s + computeSPAnggaran(sp); }, 0);
}
function computeTujuanAnggaran(t){
  return (t.sasaranStrategisList||[]).reduce(function(s,ss){ return s + computeSSAnggaran(ss); }, 0);
}
function sumBobot(list){
  return (list||[]).reduce(function(s,tp){ return s + (Number(tp.bobot)||0); }, 0);
}

/* =========================================================
   RENDER TABEL UTAMA HIERARKI
   ========================================================= */
function renderTable(){
  var rows = '';
  var grandTotalAnggaran = 0;

  var isLoggedIn = <?= !empty($IsLoggedIn) ? 'true' : 'false' ?>;
  var hasKodeWilayah = <?= !empty($KodeWilayah) ? 'true' : 'false' ?>;

  if(!state.tujuanList || state.tujuanList.length===0){
    var emptyColspan = isRole4 ? 15 : 14;
    var emptyMsg = (!isLoggedIn && !hasKodeWilayah) ? 
      'Silakan pilih Filter Wilayah & Perangkat Daerah di atas terlebih dahulu untuk menampilkan data.' : 
      'Belum ada data Target Renaksi untuk parameter yang dipilih.';
    rows = '<tr><td colspan="' + emptyColspan + '" class="empty-state"><i class="fa fa-folder-open-o" style="font-size:32px; display:block; margin-bottom:8px; opacity:0.6;"></i>' + emptyMsg + '</td></tr>';
  } else {
    state.tujuanList.forEach(function(t){
      rows += renderLevelBlock(t, 'tujuan', [t.id]);
      (t.sasaranStrategisList || []).forEach(function(ss){
        rows += renderLevelBlock(ss, 'ss', [t.id, ss.id]);
        (ss.sasaranProgramList || []).forEach(function(sp){
          rows += renderLevelBlock(sp, 'sp', [t.id, ss.id, sp.id]);
          (sp.sasaranKegiatanList || []).forEach(function(sk){
            rows += renderLevelBlock(sk, 'sk', [t.id, ss.id, sp.id, sk.id]);
            (sk.sasaranSubKegiatanList || []).forEach(function(sub){
              rows += renderLevelBlock(sub, 'sub', [t.id, ss.id, sp.id, sk.id, sub.id]);
              grandTotalAnggaran += computeSubAnggaran(sub);
            });
          });
        });
      });
    });
  }

  document.getElementById('tableBody').innerHTML = rows;
  document.getElementById('statTotalAnggaran').textContent = formatRupiah(grandTotalAnggaran);
}

function renderLevelBlock(entity, level, chain){
  var isSub = (level==='sub');
  var indCount = (entity.indikators && entity.indikators.length) ? entity.indikators.length : 0;
  var tahapCount = (isSub && entity.tahapanProses) ? entity.tahapanProses.length : 0;
  var rowCount = Math.max(indCount, isSub ? tahapCount : 0, 1);

  var anggaranVal = null;
  if(level==='sp') anggaranVal = computeSPAnggaran(entity);
  if(level==='sk') anggaranVal = computeSKAnggaran(entity);
  if(level==='sub') anggaranVal = computeSubAnggaran(entity);

  var out = '';
  for(var r=0; r<rowCount; r++){
    out += '<tr class="row-'+level+' search-row" data-search="'+escapeAttr((entity.nama||'')+' '+(entity.nomenklatur||'')+' '+(entity.kode||''))+'">';

    if(r===0){ out += renderNameCell(entity, level, rowCount); }

    // kolom indikator kinerja (nama, satuan, target tahunan, TW I-IV)
    if(indCount<=1){
      if(r===0){
        out += renderIndikatorCells(entity.indikators ? entity.indikators[0] : null, rowCount);
      }
    } else {
      if(r<indCount){
        out += renderIndikatorCells(entity.indikators[r], 1);
      } else {
        out += emptyIndikatorCells();
      }
    }

    // kolom anggaran
    if(r===0){
      var anggaranHtml = (anggaranVal===null) ? '<span class="dash">-</span>' : formatRupiah(anggaranVal);
      out += '<td class="cell-anggaran" rowspan="'+rowCount+'">'+anggaranHtml+'</td>';
    }

    // kolom rencana aksi sub kegiatan (uraian, nilai, satuan, bobot, bulan)
    if(isSub){
      if(r<tahapCount){
        out += renderTahapCells(entity.tahapanProses[r]);
      } else {
        out += emptyTahapCells();
      }
    } else {
      if(r===0){
        out += '<td class="cell-uraian-empty" colspan="5" rowspan="'+rowCount+'"><span class="dash">-</span></td>';
      }
    }

    // kolom opsi aksi
    if(r===0){
      out += renderOpsiAksiCell(level, chain, rowCount);
    }

    out += '</tr>';
  }
  return out;
}

function renderNameCell(entity, level, rowspan){
  var inner = '';
  if(level==='tujuan'){
    inner = '<div style="font-weight:700; color:#334155; margin-bottom:2px;"><i class="fa fa-flag text-slate"></i> Tujuan:</div>' +
            '<div style="font-size:13px; font-weight:600; color:#0f172a;">'+escapeHtml(entity.nama)+'</div>';
  } else if(level==='ss'){
    inner = '<div style="font-weight:700; color:#1d4ed8; margin-bottom:2px;"><i class="fa fa-compass"></i> Sasaran:</div>' +
            '<div style="font-size:13px; font-weight:600; color:#1e293b;">'+escapeHtml(entity.nama)+'</div>';
  } else if(level==='sp'){
    var pNomen = entity.nomenklatur || entity.nama || '';
    inner = '<div style="margin-bottom:3px;">' +
              (entity.kode ? '<span class="font-mono font-bold" style="background:#eff6ff; color:#1d4ed8; padding:2px 6px; border-radius:4px; border:1px solid #bfdbfe; margin-right:6px; font-size:12px;">'+escapeHtml(entity.kode)+'</span>' : '') +
              '<strong style="color:#1e3a8a; font-size:13px;">'+escapeHtml(pNomen)+'</strong>' +
            '</div>';
    if(entity.perihal && entity.perihal !== pNomen){
      inner += '<div style="font-size:11.5px; color:#475569; margin-top:2px;"><strong>Perihal Program:</strong> '+escapeHtml(entity.perihal)+'</div>';
    }
  } else if(level==='sk'){
    var kNomen = entity.nomenklatur || entity.nama || '';
    var kPerihal = entity.perihal || entity.nama || '';
    inner = '<div style="margin-bottom:3px;">' +
              (entity.kode ? '<span class="font-mono font-bold" style="background:#ecfeff; color:#0e7490; padding:2px 6px; border-radius:4px; border:1px solid #a5f3fc; margin-right:6px; font-size:12px;">'+escapeHtml(entity.kode)+'</span>' : '') +
              '<strong style="color:#155e75; font-size:13px;">'+escapeHtml(kNomen)+'</strong>' +
            '</div>' ;
  } else if(level==='sub'){
    var subNomen = entity.nomenklatur || entity.nama || '';
    var subPerihal = entity.perihal || entity.nama || '';
    inner = '<div style="margin-bottom:3px;">' +
              (entity.kode ? '<span class="font-mono font-bold" style="background:#ecfdf5; color:#047857; padding:2px 6px; border-radius:4px; border:1px solid #a7f3d0; margin-right:6px; font-size:12px;">'+escapeHtml(entity.kode)+'</span>' : '') +
              '<strong style="color:#065f46; font-size:13px;">'+escapeHtml(subNomen)+'</strong>' +
            '</div>' ;
  }
  return '<td class="cell-name cell-name-'+level+'" rowspan="'+rowspan+'">'+inner+'</td>';
}

function renderIndikatorCells(ind, rowspan){
  var rs = ' rowspan="'+rowspan+'"';
  if(!ind){
    return '<td'+rs+'><span class="dash">-</span></td><td'+rs+' class="text-center"><span class="dash">-</span></td><td'+rs+' class="text-center"><span class="dash">-</span></td><td'+rs+'></td><td'+rs+'></td><td'+rs+'></td><td'+rs+'></td>';
  }
  var twCells = ['tw1','tw2','tw3','tw4'].map(function(k){
    var v = ind[k];
    var display = (v!==null && v!==undefined && v!=='') ? fmtNum(v) : '';
    return '<td'+rs+' class="text-center font-mono">'+display+'</td>';
  }).join('');

  return '<td'+rs+'>'+escapeHtml(ind.nama)+'</td>'+
    '<td'+rs+' class="text-center">'+escapeHtml(ind.satuan)+'</td>'+
    '<td'+rs+' class="text-center font-mono" style="font-weight:600;">'+fmtNum(ind.targetTahunan)+'</td>'+
    twCells;
}
function emptyIndikatorCells(){
  return '<td></td><td class="text-center"></td><td class="text-center"></td><td></td><td></td><td></td><td></td>';
}

function renderTahapCells(tp){
  return '<td>'+escapeHtml(tp.uraian)+'</td>'+
    '<td class="text-center font-mono">'+fmtNum(tp.nilai)+'</td>'+
    '<td class="text-center">'+escapeHtml(tp.satuan)+'</td>'+
    '<td class="text-center font-mono" style="font-weight:700; color:#0f766e;">'+fmtNum(tp.bobot)+'%</td>'+
    '<td class="text-center">'+escapeHtml(tp.bulan)+'</td>';
}
function emptyTahapCells(){
  return '<td></td><td class="text-center"></td><td class="text-center"></td><td class="text-center"></td><td class="text-center"></td>';
}

function renderOpsiAksiCell(level, chain, rowspan){
  if(!isRole4){
    return '';
  }
  var tId=chain[0], ssId=chain[1], spId=chain[2], skId=chain[3], subId=chain[4];
  var editCall = '', editTitle = '';

  if(level==='tujuan'){
    editCall = "openEditTujuan('"+tId+"')";
    editTitle = 'Isi target realisasi triwulan Tujuan';
  } else if(level==='ss'){
    editCall = "openEditSasaranStrategis('"+tId+"','"+ssId+"')";
    editTitle = 'Isi target realisasi triwulan Sasaran Strategis';
  } else if(level==='sp'){
    editCall = "openEditSasaranProgram('"+tId+"','"+ssId+"','"+spId+"')";
    editTitle = 'Isi target realisasi triwulan Sasaran Program';
  } else if(level==='sk'){
    editCall = "openEditSasaranKegiatan('"+tId+"','"+ssId+"','"+spId+"','"+skId+"')";
    editTitle = 'Isi target realisasi triwulan Sasaran Kegiatan';
  } else if(level==='sub'){
    editCall = "openEditSasaranSubKegiatan('"+tId+"','"+ssId+"','"+spId+"','"+skId+"','"+subId+"')";
    editTitle = 'Isi target realisasi triwulan, anggaran bulanan, & tahapan proses Sub Kegiatan';
  }

  var html = '<td class="cell-opsi" rowspan="'+rowspan+'"><div class="opsi-btn-group">';
  html += '<button type="button" class="btn-icon-edit" title="'+editTitle+'" onclick="'+editCall+'">'+editIconSVG+'</button>';
  html += '</div></td>';
  return html;
}

/* =========================================================
   MODAL INFRASTRUCTURE
   ========================================================= */
function openModal(html){
  document.getElementById('modalContent').innerHTML = html;
  document.getElementById('modalOverlay').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
  renumberTahapRows();
  renumberIndRows();
  recalcValiditasBadges();
}
function closeModal(){
  document.getElementById('modalOverlay').classList.add('hidden');
  document.getElementById('modalContent').innerHTML = '';
  document.body.style.overflow = '';
}
document.getElementById('modalOverlay').addEventListener('click', function(e){
  if(e.target === this) closeModal();
});
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape') closeModal();
});

function modalShell(title, subtitle, bodyHtml, footerHtml, wide){
  return '<div class="modal-card'+(wide?' wide':'')+'">'+
    '<div class="modal-header">'+
      '<div class="modal-icon">'+targetIconSVG+'</div>'+
      '<div><h2>'+escapeHtml(title)+'</h2><p class="modal-subtitle">'+escapeHtml(subtitle)+'</p></div>'+
    '</div>'+
    '<div class="modal-body">'+bodyHtml+'</div>'+
    '<div class="modal-footer">'+footerHtml+'</div>'+
  '</div>';
}
function editFooterButtons(resetExpr, saveExpr){
  return '<button type="button" class="btn btn-outline" onclick="closeModal()"><i class="fa fa-arrow-left"></i> Kembali</button>'+
    '<div class="footer-right">'+
      '<button type="button" class="btn btn-outline" onclick="'+resetExpr+'"><i class="fa fa-refresh"></i> Reset</button>'+
      '<button type="button" class="btn btn-primary" onclick="'+saveExpr+'"><i class="fa fa-save"></i> Simpan Target</button>'+
    '</div>';
}

/* =========================================================
   TOAST NOTIFICATION
   ========================================================= */
function showToast(msg, type){
  type = type || 'success';
  var icon = (type==='success') ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-exclamation-triangle"></i>';
  var div = document.createElement('div');
  div.className = 'toast-box ' + type;
  div.innerHTML = icon + ' <span>' + escapeHtml(msg) + '</span>';
  document.getElementById('toastContainer').appendChild(div);
  setTimeout(function(){
    div.style.opacity = '0';
    div.style.transform = 'translateY(10px)';
    div.style.transition = 'all 0.3s';
    setTimeout(function(){ div.remove(); }, 300);
  }, 3500);
}

/* =========================================================
   MODAL BUILDERS: TUJUAN, SASARAN STRATEGIS, PROGRAM, KEGIATAN
   ========================================================= */
function buildTWInputTableHTML(entity){
  var bodyRows = (entity.indikators || []).map(function(ind, i){
    return '<tr>'+
      '<td class="text-center font-mono">'+(i+1)+'</td>'+
      '<td><strong>'+escapeHtml(ind.nama)+'</strong></td>'+
      '<td class="text-center">'+escapeHtml(ind.satuan)+'</td>'+
      '<td><input type="number" step="any" class="tw-input" data-ind-id="'+ind.id+'" data-tw="1" value="'+(ind.tw1!==null&&ind.tw1!==undefined?ind.tw1:'')+'"></td>'+
      '<td><input type="number" step="any" class="tw-input" data-ind-id="'+ind.id+'" data-tw="2" value="'+(ind.tw2!==null&&ind.tw2!==undefined?ind.tw2:'')+'"></td>'+
      '<td><input type="number" step="any" class="tw-input" data-ind-id="'+ind.id+'" data-tw="3" value="'+(ind.tw3!==null&&ind.tw3!==undefined?ind.tw3:'')+'"></td>'+
      '<td><input type="number" step="any" class="tw-input" data-ind-id="'+ind.id+'" data-tw="4" value="'+(ind.tw4!==null&&ind.tw4!==undefined?ind.tw4:'')+'"></td>'+
    '</tr>';
  }).join('');
  if(!entity.indikators || entity.indikators.length===0){
    bodyRows = '<tr><td colspan="7" class="text-center"><span class="dash">Belum ada indikator untuk diisi targetnya.</span></td></tr>';
  }
  return '<table class="tw-table">'+
    '<thead>'+
      '<tr><th style="width:40px;">No</th><th>Indikator Kinerja</th><th style="width:80px;">Satuan</th><th colspan="4">Target Per Triwulan (Kumulatif)</th></tr>'+
      '<tr><th></th><th></th><th></th>'+
        '<th style="width:110px;">Triwulan I<br><span class="sub-note">(Jan - Mar)</span></th>'+
        '<th style="width:110px;">Triwulan II<br><span class="sub-note">(Apr - Jun)</span></th>'+
        '<th style="width:110px;">Triwulan III<br><span class="sub-note">(Jul - Sep)</span></th>'+
        '<th style="width:110px;">Triwulan IV<br><span class="sub-note">(Okt - Des)</span></th>'+
      '</tr>'+
    '</thead>'+
    '<tbody id="twTbody">'+bodyRows+'</tbody>'+
  '</table>';
}

function buildInfoTableHTML(entity, levelHeaderLabel, nameDisplayHtml){
  var inds = entity.indikators || [];
  var n = inds.length;
  var bodyRows = '';
  if(n===0){
    bodyRows = '<tr><td class="info-name-cell">'+nameDisplayHtml+'</td><td colspan="3"><span class="dash">Belum ada indikator</span></td></tr>';
  } else {
    inds.forEach(function(ind, i){
      bodyRows += '<tr>';
      if(i===0){
        bodyRows += '<td rowspan="'+n+'" class="info-name-cell">'+nameDisplayHtml+'</td>';
      }
      bodyRows += '<td>'+escapeHtml(ind.nama)+'</td>'+
        '<td class="text-center">'+escapeHtml(ind.satuan)+'</td>'+
        '<td class="text-center font-mono" style="font-weight:700;">'+fmtNum(ind.targetTahunan)+'</td>';
      bodyRows += '</tr>';
    });
  }
  return '<table class="info-table"><thead><tr>'+
    '<th>'+escapeHtml(levelHeaderLabel)+'</th><th>Indikator Kinerja</th><th style="width:90px;">Satuan</th><th style="width:110px;">Target Tahunan</th>'+
    '</tr></thead><tbody>'+bodyRows+'</tbody></table>';
}

function saveHierarchyTarget(levelType, entityCode, entityName, nomenklatur, entity){
  var payloadIndikators = [];
  document.querySelectorAll('#twTbody .tw-input').forEach(function(inp){
    var indId = inp.dataset.indId;
    var twNum = inp.dataset.tw;
    var ind = (entity.indikators||[]).find(function(i){ return String(i.id)===String(indId); });
    if(!ind) return;

    var existingObj = payloadIndikators.find(function(p){ return String(p.id)===String(indId); });
    if(!existingObj){
      existingObj = {
        id: ind.id,
        nama: ind.nama,
        satuan: ind.satuan,
        targetTahunan: ind.targetTahunan,
        tw1: ind.tw1, tw2: ind.tw2, tw3: ind.tw3, tw4: ind.tw4
      };
      payloadIndikators.push(existingObj);
    }
    existingObj['tw' + twNum] = inp.value === '' ? null : Number(inp.value);
    ind['tw' + twNum] = existingObj['tw' + twNum];
  });

  $.ajax({
    url: baseUrl + 'Instansi/SaveTargetRenaksiHierarchy',
    type: 'POST',
    data: {
      level_type: levelType,
      entity_code: entityCode,
      entity_name: entityName,
      nomenklatur: nomenklatur,
      tahun: currentTahun,
      kode_wilayah: currentKodeWilayah,
      id_instansi: currentInstansiId,
      indikators: payloadIndikators
    },
    dataType: 'json',
    success: function(res){
      if(res.status==='success'){
        showToast(res.message, 'success');
        closeModal();
        renderTable();
      } else {
        showToast(res.message || 'Gagal menyimpan target', 'error');
      }
    },
    error: function(){
      showToast('Terjadi kesalahan komunikasi dengan server.', 'error');
    }
  });
}

// Modal EDIT TUJUAN
function openEditTujuan(tId){
  var t = findTujuan(tId);
  if(!t) return;
  var info = buildInfoTableHTML(t, 'Tujuan', '<strong>Tujuan :</strong> '+escapeHtml(t.nama));
  var tw = buildTWInputTableHTML(t);
  var body =
    '<div class="info-box"><div class="box-label"><i class="fa fa-info-circle"></i> Informasi Tujuan dan Target Tahunan</div>'+info+'</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-calendar-check-o"></i> Target Realisasi Per Triwulan</div>'+
      '<p class="box-desc">Input target kinerja untuk setiap indikator per triwulan secara kumulatif.</p>'+tw+
      '<div class="keterangan-box"><i class="fa fa-info-circle"></i> <strong>Keterangan:</strong> Target per triwulan diisi secara kumulatif hingga akhir tahun anggaran.</div>'+
    '</div>';
  var footer = editFooterButtons("openEditTujuan('"+tId+"')", "saveHierarchyTarget('tujuan', '"+(t.kode||t.id)+"', '"+escapeAttr(t.nama)+"', '', findTujuan('"+tId+"'))");
  openModal(modalShell('TARGET KINERJA TUJUAN PERANGKAT DAERAH','Input target tahunan serta target per triwulan untuk indikator tujuan perangkat daerah.', body, footer));
}

// Modal EDIT SASARAN STRATEGIS
function openEditSasaranStrategis(tId, ssId){
  var ss = findSS(tId, ssId);
  if(!ss) return;
  var info = buildInfoTableHTML(ss, 'Sasaran Strategis', '<strong>Sasaran Strategis:</strong> '+escapeHtml(ss.nama));
  var tw = buildTWInputTableHTML(ss);
  var body =
    '<div class="info-box"><div class="box-label"><i class="fa fa-info-circle"></i> Informasi Sasaran Strategis dan Target Tahunan</div>'+info+'</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-calendar-check-o"></i> Target Realisasi Per Triwulan</div>'+
      '<p class="box-desc">Input target kinerja untuk setiap indikator per triwulan secara kumulatif.</p>'+tw+
      '<div class="keterangan-box"><i class="fa fa-info-circle"></i> <strong>Keterangan:</strong> Target per triwulan diisi secara kumulatif hingga akhir tahun anggaran.</div>'+
    '</div>';
  var footer = editFooterButtons("openEditSasaranStrategis('"+tId+"','"+ssId+"')", "saveHierarchyTarget('sasaran_strategis', '"+(ss.kode||ss.id)+"', '"+escapeAttr(ss.nama)+"', '', findSS('"+tId+"','"+ssId+"'))");
  openModal(modalShell('TARGET KINERJA SASARAN STRATEGIS','Input target tahunan serta target per triwulan untuk indikator sasaran strategis.', body, footer));
}

// Modal EDIT SASARAN PROGRAM
function openEditSasaranProgram(tId, ssId, spId){
  var sp = findSP(tId, ssId, spId);
  if(!sp) return;
  var info = buildInfoTableHTML(sp, 'Sasaran Program', '<strong>Sasaran Program:</strong> '+escapeHtml(sp.nama)+'<br><small class="text-muted">'+escapeHtml(sp.nomenklatur||'')+'</small>');
  var tw = buildTWInputTableHTML(sp);
  var body =
    '<div class="info-box"><div class="box-label"><i class="fa fa-info-circle"></i> Informasi Sasaran Program dan Target Tahunan</div>'+info+'</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-calendar-check-o"></i> Target Realisasi Per Triwulan</div>'+
      '<p class="box-desc">Input target kinerja untuk setiap indikator sasaran program.</p>'+tw+
      '<div class="keterangan-box"><i class="fa fa-info-circle"></i> <strong>Keterangan:</strong> Target per triwulan diisi secara kumulatif hingga akhir tahun.</div>'+
    '</div>';
  var footer = editFooterButtons("openEditSasaranProgram('"+tId+"','"+ssId+"','"+spId+"')", "saveHierarchyTarget('program', '"+(sp.kode||sp.id)+"', '"+escapeAttr(sp.nama)+"', '"+escapeAttr(sp.nomenklatur||'')+"', findSP('"+tId+"','"+ssId+"','"+spId+"'))");
  openModal(modalShell('TARGET KINERJA SASARAN PROGRAM','Input target tahunan serta target per triwulan untuk indikator sasaran program.', body, footer));
}

// Modal EDIT SASARAN KEGIATAN
function openEditSasaranKegiatan(tId, ssId, spId, skId){
  var sk = findSK(tId, ssId, spId, skId);
  if(!sk) return;
  var info = buildInfoTableHTML(sk, 'Sasaran Kegiatan', '<strong>Sasaran Kegiatan:</strong> '+escapeHtml(sk.nama)+'<br><small class="text-muted">'+escapeHtml(sk.nomenklatur||'')+'</small>');
  var tw = buildTWInputTableHTML(sk);
  var body =
    '<div class="info-box"><div class="box-label"><i class="fa fa-info-circle"></i> Informasi Sasaran Kegiatan dan Target Tahunan</div>'+info+'</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-calendar-check-o"></i> Target Realisasi Per Triwulan</div>'+
      '<p class="box-desc">Input target kinerja untuk setiap indikator sasaran kegiatan.</p>'+tw+
      '<div class="keterangan-box"><i class="fa fa-info-circle"></i> <strong>Keterangan:</strong> Target per triwulan diisi secara kumulatif hingga akhir tahun.</div>'+
    '</div>';
  var footer = editFooterButtons("openEditSasaranKegiatan('"+tId+"','"+ssId+"','"+spId+"','"+skId+"')", "saveHierarchyTarget('kegiatan', '"+(sk.kode||sk.id)+"', '"+escapeAttr(sk.nama)+"', '"+escapeAttr(sk.nomenklatur||'')+"', findSK('"+tId+"','"+ssId+"','"+spId+"','"+skId+"'))");
  openModal(modalShell('TARGET KINERJA SASARAN KEGIATAN','Input target tahunan serta target per triwulan untuk indikator sasaran kegiatan.', body, footer));
}

/* =========================================================
   MODAL EDIT: SASARAN SUB KEGIATAN (Spreadsheet & DPA Complete)
   ========================================================= */

// 1. Table Input Indikator & Target TW (Editable List)
function indRowHTML(ind){
  ind = ind || { id:'', nama:'', satuan:'Dokumen', targetTahunan:1, tw1:null, tw2:null, tw3:null, tw4:null, validitas:'Valid' };
  return '<tr class="ind-row" data-id="'+escapeAttr(ind.id)+'">'+
    '<td class="ind-no text-center font-mono">-</td>'+
    '<td><input type="text" class="ind-uraian" placeholder="Uraian Indikator Kinerja Output" value="'+escapeAttr(ind.nama)+'"></td>'+
    '<td><input type="text" class="ind-satuan text-center" style="width:90px;" placeholder="Satuan" value="'+escapeAttr(ind.satuan)+'"></td>'+
    '<td><input type="number" step="any" class="ind-target text-center font-mono" style="width:85px; font-weight:700;" value="'+(ind.targetTahunan!==null&&ind.targetTahunan!==undefined?ind.targetTahunan:'')+'" oninput="recalcValiditasBadges()"></td>'+
    '<td><input type="number" step="any" class="ind-tw1 text-center font-mono" style="width:75px;" value="'+(ind.tw1!==null&&ind.tw1!==undefined?ind.tw1:'')+'" oninput="recalcValiditasBadges()"></td>'+
    '<td><input type="number" step="any" class="ind-tw2 text-center font-mono" style="width:75px;" value="'+(ind.tw2!==null&&ind.tw2!==undefined?ind.tw2:'')+'" oninput="recalcValiditasBadges()"></td>'+
    '<td><input type="number" step="any" class="ind-tw3 text-center font-mono" style="width:75px;" value="'+(ind.tw3!==null&&ind.tw3!==undefined?ind.tw3:'')+'" oninput="recalcValiditasBadges()"></td>'+
    '<td><input type="number" step="any" class="ind-tw4 text-center font-mono" style="width:75px;" value="'+(ind.tw4!==null&&ind.tw4!==undefined?ind.tw4:'')+'" oninput="recalcValiditasBadges()"></td>'+
    '<td class="ind-valid text-center"><span class="badge-valid">Valid</span></td>'+
    '<td class="text-center"><button type="button" class="btn-icon-danger" title="Hapus Indikator" onclick="removeIndRow(this)"><i class="fa fa-trash"></i></button></td>'+
  '</tr>';
}

function buildSubIndikatorTableHTML(sub){
  var rows = (sub.indikators || []).map(function(ind){ return indRowHTML(ind); }).join('');
  return '<button type="button" class="btn-add-row" onclick="addIndRow()"><i class="fa fa-plus"></i> Tambah Indikator Output</button>'+
  '<div class="table-scroll" style="max-height:260px;"><table class="ind-edit-table">'+
    '<thead>'+
      '<tr>'+
        '<th rowspan="2" style="width:36px;">No</th>'+
        '<th rowspan="2">Uraian Indikator Output</th>'+
        '<th rowspan="2" style="width:90px;">Satuan</th>'+
        '<th rowspan="2" style="width:85px;">Target<br>Tahunan</th>'+
        '<th colspan="4">Target Realisasi Per Triwulan</th>'+
        '<th rowspan="2" style="width:80px;">Validitas</th>'+
        '<th rowspan="2" style="width:40px;">Aksi</th>'+
      '</tr>'+
      '<tr>'+
        '<th style="width:75px;">Triwulan I</th>'+
        '<th style="width:75px;">Triwulan II</th>'+
        '<th style="width:75px;">Triwulan III</th>'+
        '<th style="width:75px;">Triwulan IV</th>'+
      '</tr>'+
    '</thead>'+
    '<tbody id="indTbody">'+rows+'</tbody>'+
  '</table></div>';
}

function addIndRow(){
  document.getElementById('indTbody').insertAdjacentHTML('beforeend', indRowHTML(null));
  renumberIndRows();
  recalcValiditasBadges();
  recalcBobotTotal();
}
function removeIndRow(btn){
  var tbody = document.getElementById('indTbody');
  if(tbody.querySelectorAll('.ind-row').length <= 1){
    showToast('Minimal harus ada 1 indikator output!', 'error');
    return;
  }
  btn.closest('tr').remove();
  renumberIndRows();
  recalcValiditasBadges();
  recalcBobotTotal();
}
function renumberIndRows(){
  document.querySelectorAll('#indTbody .ind-row').forEach(function(tr, i){
    var c = tr.querySelector('.ind-no');
    if(c) c.textContent = (i+1);
  });
}

function recalcValiditasBadges(){
  document.querySelectorAll('#indTbody .ind-row').forEach(function(tr){
    var target = Number(tr.querySelector('.ind-target').value) || 0;
    var tw1 = Number(tr.querySelector('.ind-tw1').value) || 0;
    var tw2 = Number(tr.querySelector('.ind-tw2').value) || 0;
    var tw3 = Number(tr.querySelector('.ind-tw3').value) || 0;
    var tw4 = Number(tr.querySelector('.ind-tw4').value) || 0;
    var sumTw = tw1 + tw2 + tw3 + tw4;
    var validCell = tr.querySelector('.ind-valid');
    if(Math.abs(sumTw - target) < 0.0001 && target > 0){
      validCell.innerHTML = '<span class="badge-valid"><i class="fa fa-check"></i> Valid</span>';
    } else {
      validCell.innerHTML = '<span class="badge-invalid"><i class="fa fa-times"></i> Invalid</span>';
    }
  });
}

// 2. Table Target Realisasi Anggaran Bulanan
function buildPaguTableHTML(sub){
  var inputCells = MONTHS.map(function(m){
    var val = (sub.paguBulanan && sub.paguBulanan[m[0]] !== undefined) ? Number(sub.paguBulanan[m[0]]) : 0;
    var formattedVal = val ? val.toLocaleString('id-ID') : '';
    return '<td style="padding:4px 3px;"><div class="input-rupiah-box"><span class="prefix">Rp</span><input type="text" inputmode="numeric" class="pagu-input" data-month="'+m[0]+'" value="'+formattedVal+'" placeholder="0" oninput="formatPaguInput(this)"></div></td>';
  }).join('');

  return '<div class="table-scroll"><table class="pagu-table">'+
    '<thead>'+
      '<tr>'+
        '<th rowspan="3" style="min-width:130px; vertical-align:middle; text-align:left; padding-left:12px;">Uraian</th>'+
        '<th colspan="6" style="text-align:center; background-color:#00a87e; border-bottom:1px solid rgba(255,255,255,0.25);">Semester 1</th>'+
        '<th colspan="6" style="text-align:center; background-color:#00a87e; border-bottom:1px solid rgba(255,255,255,0.25);">Semester 2</th>'+
        '<th rowspan="3" style="min-width:130px; vertical-align:middle; text-align:right; padding-right:12px;">Total Pagu (Rp)</th>'+
      '</tr>'+
      '<tr>'+
        '<th colspan="3" style="text-align:center; background-color:#00966f; border-bottom:1px solid rgba(255,255,255,0.25);">Triwulan 1</th>'+
        '<th colspan="3" style="text-align:center; background-color:#00966f; border-bottom:1px solid rgba(255,255,255,0.25);">Triwulan 2</th>'+
        '<th colspan="3" style="text-align:center; background-color:#00966f; border-bottom:1px solid rgba(255,255,255,0.25);">Triwulan 3</th>'+
        '<th colspan="3" style="text-align:center; background-color:#00966f; border-bottom:1px solid rgba(255,255,255,0.25);">Triwulan 4</th>'+
      '</tr>'+
      '<tr>'+
        '<th style="min-width:110px; text-align:center;">Januari</th>'+
        '<th style="min-width:110px; text-align:center;">Februari</th>'+
        '<th style="min-width:110px; text-align:center;">Maret</th>'+
        '<th style="min-width:110px; text-align:center;">April</th>'+
        '<th style="min-width:110px; text-align:center;">Mei</th>'+
        '<th style="min-width:110px; text-align:center;">Juni</th>'+
        '<th style="min-width:110px; text-align:center;">Juli</th>'+
        '<th style="min-width:110px; text-align:center;">Agustus</th>'+
        '<th style="min-width:110px; text-align:center;">September</th>'+
        '<th style="min-width:110px; text-align:center;">Oktober</th>'+
        '<th style="min-width:110px; text-align:center;">November</th>'+
        '<th style="min-width:110px; text-align:center;">Desember</th>'+
      '</tr>'+
    '</thead>'+
    '<tbody>'+
      '<tr>'+
        '<td style="text-align:left; font-weight:700; padding-left:12px;">Pagu Anggaran (Rp)</td>'+
        inputCells+
        '<td id="paguTotalCell" class="pagu-total font-mono" style="font-weight:800; color:#007a5a; text-align:right; padding-right:12px;">'+formatRupiah(computeSubAnggaran(sub))+'</td>'+
      '</tr>'+
    '</tbody>'+
  '</table></div>';
}

function formatPaguInput(inp){
  var digits = inp.value.replace(/[^0-9]/g, "");
  digits = digits.replace(/^0+(?=\d)/, "");
  var val = digits ? parseInt(digits, 10) : 0;
  inp.value = digits ? val.toLocaleString('id-ID') : "";
  recalcPaguTotal();
}

function recalcPaguTotal(){
  var total = 0;
  document.querySelectorAll('.pagu-input').forEach(function(inp){
    var digits = inp.value.replace(/[^0-9]/g, "");
    total += digits ? parseInt(digits, 10) : 0;
  });
  var cell = document.getElementById('paguTotalCell');
  if(cell) cell.textContent = formatRupiah(total);
}

// 3. Table Tahapan Proses / Rencana Aksi Sub Kegiatan
function tahapRowHTML(tp){
  tp = tp || { uraian:'', nilai:1, satuan:'berkas', bobot:'', bulan:'Januari', bobotSubKeg:'', keterangan:'' };
  var optsHtml = '<option value="">Pilih bulan</option>' + MONTH_NAMES.map(function(m){
    return '<option value="'+m+'"'+(tp.bulan===m?' selected':'')+'>'+m+'</option>';
  }).join('');
  return '<tr class="tahap-row">'+
    '<td class="tahap-no text-center font-mono">-</td>'+
    '<td><input type="text" class="tahap-uraian" placeholder="Masukkan uraian tahapan proses" value="'+escapeAttr(tp.uraian)+'"></td>'+
    '<td><input type="number" step="any" class="tahap-nilai text-center font-mono" style="width:65px;" placeholder="Nilai" value="'+(tp.nilai!==''&&tp.nilai!=null?tp.nilai:1)+'"></td>'+
    '<td><input type="text" class="tahap-satuan text-center" style="width:80px;" placeholder="Satuan" value="'+escapeAttr(tp.satuan||'berkas')+'"></td>'+
    '<td><input type="number" step="any" min="0" max="100" class="bobot-input text-center font-mono" style="width:85px; font-weight:700; color:#0f766e;" placeholder="%" value="'+(tp.bobot!==''&&tp.bobot!=null?tp.bobot:'')+'" oninput="recalcBobotTotal()"></td>'+
    '<td><select class="tahap-bulan" style="min-width:110px;">'+optsHtml+'</select></td>'+
    '<td class="tahap-subkeg-cell text-center font-mono" style="font-weight:700; color:#047857;">'+(tp.bobotSubKeg!==''&&tp.bobotSubKeg!=null?Number(tp.bobotSubKeg).toFixed(2)+'%':'-')+'</td>'+
    '<td><input type="text" class="tahap-ket" placeholder="Keterangan (opsional)" value="'+escapeAttr(tp.keterangan||'')+'"></td>'+
    '<td class="text-center"><button type="button" class="btn-icon-danger" title="Hapus tahapan" onclick="this.closest(\'tr\').remove(); recalcBobotTotal(); renumberTahapRows();"><i class="fa fa-trash"></i></button></td>'+
  '</tr>';
}

function buildTahapanTableHTML(sub){
  var rows = (sub.tahapanProses || []).map(function(tp){ return tahapRowHTML(tp); }).join('');
  return '<button type="button" class="btn-add-row" onclick="addTahapRow()"><i class="fa fa-plus"></i> Tambah Tahap Proses</button>'+
  '<div class="table-scroll" style="max-height:360px;"><table class="tahap-table">'+
    '<thead>'+
      '<tr>'+
        '<th rowspan="2" style="width:36px;">No</th>'+
        '<th rowspan="2">Uraian Tahapan Proses</th>'+
        '<th colspan="2">Target Output</th>'+
        '<th rowspan="2" style="width:110px;">Bobot Kinerja<br>Proses (%) Per<br>Output</th>'+
        '<th rowspan="2" style="width:120px;">Rencana Pelaksanaan<br>(Bulan)</th>'+
        '<th rowspan="2" style="width:110px;">Bobot Kinerja<br>Proses (%) Per<br>Sub Kegiatan</th>'+
        '<th rowspan="2" style="width:140px;">Keterangan</th>'+
        '<th rowspan="2" style="width:40px;">Aksi</th>'+
      '</tr>'+
      '<tr>'+
        '<th style="width:65px;">Nilai</th>'+
        '<th style="width:80px;">Satuan</th>'+
      '</tr>'+
    '</thead>'+
    '<tbody id="tahapanTbody">'+rows+'</tbody>'+
    '<tfoot>'+
      '<tr>'+
        '<td colspan="4" class="text-right"><strong>Total Bobot Kinerja Proses</strong></td>'+
        '<td id="bobotOutputTotalCell" class="bobot-total">'+sumBobot(sub.tahapanProses).toFixed(2)+'%</td>'+
        '<td></td>'+
        '<td id="bobotSubKegTotalCell" class="bobot-total" style="color:#047857;">-</td>'+
        '<td colspan="2"></td>'+
      '</tr>'+
    '</tfoot>'+
  '</table></div>';
}

function addTahapRow(){
  document.getElementById('tahapanTbody').insertAdjacentHTML('beforeend', tahapRowHTML(null));
  renumberTahapRows();
  recalcBobotTotal();
}
function renumberTahapRows(){
  document.querySelectorAll('#tahapanTbody .tahap-row').forEach(function(tr, i){
    var c = tr.querySelector('.tahap-no');
    if(c) c.textContent = (i+1);
  });
}

function recalcBobotTotal(){
  var indCount = document.querySelectorAll('#indTbody .ind-row').length;
  indCount = Math.max(indCount, 1);

  var totalBobotOutput = 0;
  var totalBobotSub = 0;

  document.querySelectorAll('#tahapanTbody .tahap-row').forEach(function(tr){
    var val = Number(tr.querySelector('.bobot-input').value) || 0;
    totalBobotOutput += val;
    var subVal = val / indCount;
    totalBobotSub += subVal;

    var cellSub = tr.querySelector('.tahap-subkeg-cell');
    if(cellSub) cellSub.textContent = subVal.toFixed(2) + '%';
  });

  var outCell = document.getElementById('bobotOutputTotalCell');
  if(outCell) {
    outCell.textContent = totalBobotOutput.toFixed(2) + '%';
    if(Math.abs(totalBobotOutput - 100) < 0.01){
      outCell.style.color = '#047857';
    } else {
      outCell.style.color = '#b91c1c';
    }
  }

  var subCell = document.getElementById('bobotSubKegTotalCell');
  if(subCell) subCell.textContent = totalBobotSub.toFixed(2) + '%';
}

// 4. Modal Open Function for Sub Kegiatan
function openEditSasaranSubKegiatan(tId, ssId, spId, skId, subId){
  var sub = findSUB(tId, ssId, spId, skId, subId);
  if(!sub) return;

  var headerInfo = 
    '<div class="info-stat-grid" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:10px; font-size:12.5px; margin-bottom:12px;">'+
      '<div><strong>Tahun:</strong> <span class="badge badge-info font-mono" style="background:#e0f2fe; color:#0369a1; padding:2px 8px; border-radius:4px;">'+escapeHtml(currentTahun)+'</span></div>'+
      '<div><strong>Perangkat Daerah:</strong> '+escapeHtml(sub.perangkatDaerah||'-')+'</div>'+
      '<div><strong>Sub Unit:</strong> '+escapeHtml(sub.subUnit||sub.perangkatDaerah||'-')+'</div>'+
      '<div><strong>Bidang Urusan:</strong> '+escapeHtml(sub.bidangUrusan||'-')+'</div>'+
      '<div><strong>Program:</strong> '+escapeHtml(sub.programNama||'-')+'</div>'+
      '<div><strong>Kegiatan:</strong> '+escapeHtml(sub.kegiatanNama||'-')+'</div>'+
      '<div style="grid-column:1/-1;"><strong>Sub Kegiatan:</strong> <span style="font-weight:700; color:#007a5a;">'+escapeHtml(sub.kode||'')+' - '+escapeHtml(sub.nama||'')+'</span></div>'+
    '</div>';

  var indTable = buildSubIndikatorTableHTML(sub);
  var pagu = buildPaguTableHTML(sub);
  var tahap = buildTahapanTableHTML(sub);

  var body =
    '<div class="info-box"><div class="box-label"><i class="fa fa-info-circle"></i> Informasi Hierarki Sub Kegiatan</div>'+headerInfo+'</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-bullseye"></i> Target Realisasi Kinerja Output Sub Kegiatan</div>'+
      '<p class="box-desc">Kelola uraian indikator output sub kegiatan, target tahunan, serta target kumulatif per triwulan.</p>'+indTable+
    '</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-money"></i> Target Realisasi Anggaran Bulanan Sub Kegiatan</div>'+
      '<p class="box-desc">Input rencana alokasi anggaran kas bulanan (Januari - Desember). Total akan terakumulasi otomatis ke Kegiatan & Program.</p>'+pagu+
    '</div>'+
    '<div class="info-box"><div class="box-label"><i class="fa fa-list-ol"></i> Target Tahapan Proses (Output) / Rencana Aksi Sub Kegiatan</div>'+
      '<p class="box-desc">Tahapan proses untuk mencapai target output. Rumus: <code>Bobot Sub Kegiatan = Bobot Output / Jumlah Indikator</code>. Total Bobot Output ditargetkan 100%.</p>'+tahap+
    '</div>'+
    '<div class="keterangan-box"><i class="fa fa-info-circle"></i> <strong>Keterangan:</strong> Pastikan target realisasi per triwulan valid (jumlah TW I s.d. IV sesuai Target Tahunan) dan total bobot kinerja proses output mencapai 100%.</div>';

  var footer = editFooterButtons(
    "openEditSasaranSubKegiatan('"+tId+"','"+ssId+"','"+spId+"','"+skId+"','"+subId+"')",
    "saveSubKegiatanTarget('"+tId+"','"+ssId+"','"+spId+"','"+skId+"','"+subId+"')"
  );

  openModal(modalShell('TARGET KINERJA SASARAN SUB KEGIATAN', 'Input target realisasi per triwulan, pagu anggaran bulanan, serta tahapan rencana aksi output.', body, footer, true));
  recalcBobotTotal();
}

// 5. Save Function for Sub Kegiatan
function saveSubKegiatanTarget(tId, ssId, spId, skId, subId){
  var sub = findSUB(tId, ssId, spId, skId, subId);
  if(!sub) return;

  // 1. Gather Indikators
  var newIndikators = [];
  document.querySelectorAll('#indTbody .ind-row').forEach(function(tr){
    var id = tr.dataset.id || '';
    var uraian = tr.querySelector('.ind-uraian').value.trim();
    var satuan = tr.querySelector('.ind-satuan').value.trim();
    var target = tr.querySelector('.ind-target').value;
    var tw1 = tr.querySelector('.ind-tw1').value;
    var tw2 = tr.querySelector('.ind-tw2').value;
    var tw3 = tr.querySelector('.ind-tw3').value;
    var tw4 = tr.querySelector('.ind-tw4').value;

    if(uraian){
      newIndikators.push({
        id: id,
        nama: uraian,
        uraian: uraian,
        satuan: satuan || 'Dokumen',
        targetTahunan: target === '' ? 1 : Number(target),
        tw1: tw1 === '' ? null : Number(tw1),
        tw2: tw2 === '' ? null : Number(tw2),
        tw3: tw3 === '' ? null : Number(tw3),
        tw4: tw4 === '' ? null : Number(tw4)
      });
    }
  });

  if(newIndikators.length === 0){
    showToast('Minimal masukkan 1 indikator output sub kegiatan!', 'error');
    return;
  }

  // 2. Gather Anggaran Bulanan
  var newPagu = {};
  var totalAnggaran = 0;
  document.querySelectorAll('.pagu-input').forEach(function(inp){
    var m = inp.dataset.month;
    var digits = inp.value.replace(/[^0-9]/g, "");
    var val = digits ? parseInt(digits, 10) : 0;
    newPagu[m] = val;
    totalAnggaran += val;
  });

  // 3. Gather Tahapan Proses
  var newTahapan = [];
  var indCount = newIndikators.length;
  document.querySelectorAll('#tahapanTbody .tahap-row').forEach(function(tr){
    var uraian = tr.querySelector('.tahap-uraian').value.trim();
    var nilai = tr.querySelector('.tahap-nilai').value;
    var satuan = tr.querySelector('.tahap-satuan').value.trim();
    var bobot = tr.querySelector('.bobot-input').value;
    var bulan = tr.querySelector('.tahap-bulan').value;
    var ket = tr.querySelector('.tahap-ket').value.trim();

    if(uraian || nilai!=='' || satuan || bobot!=='' || bulan){
      var bNum = bobot === '' ? 0 : Number(bobot);
      newTahapan.push({
        uraian: uraian,
        nilai: nilai === '' ? 1 : Number(nilai),
        satuan: satuan || 'berkas',
        bobot: bNum,
        bobot_output: bNum,
        bulan: bulan || 'Januari',
        bobotSubKeg: (bNum / indCount).toFixed(2),
        keterangan: ket
      });
    }
  });

  // AJAX Submit
  $.ajax({
    url: baseUrl + 'Instansi/SaveTargetRenaksiSubKegiatan',
    type: 'POST',
    data: {
      header_id: sub.headerId || sub.id,
      kode_sub_kegiatan: sub.kode,
      tahun: currentTahun,
      kode_wilayah: currentKodeWilayah,
      id_instansi: currentInstansiId,
      indikators: newIndikators,
      anggaran_bulanan: newPagu,
      tahapan_proses: newTahapan
    },
    dataType: 'json',
    success: function(res){
      if(res.status === 'success'){
        showToast(res.message, 'success');
        // Update state lokal
        sub.indikators = newIndikators;
        sub.paguBulanan = newPagu;
        sub.anggaran = totalAnggaran;
        sub.tahapanProses = newTahapan;
        closeModal();
        renderTable();
      } else {
        showToast(res.message || 'Gagal menyimpan data.', 'error');
      }
    },
    error: function(){
      showToast('Terjadi kesalahan jaringan saat menyimpan.', 'error');
    }
  });
}

/* =========================================================
   SINKRONISASI RAK DPA KE TARGET RENAKSI
   ========================================================= */
function syncDpaAnggaran(){
  if(!confirm('Apakah Anda yakin ingin menarik data RAK dari DPA dan mereset Target Renaksi kembali ke data awal Rankhir Renja?')) return;
  
  showToast('Sedang memproses sinkronisasi data dari DPA...', 'info');
  $.ajax({
    url: baseUrl + 'Instansi/SyncDPAAnggaran',
    type: 'POST',
    data: {
      tahun: currentTahun,
      instansi_id: currentInstansiId,
      kode_wilayah: currentKodeWilayah
    },
    dataType: 'json',
    success: function(res){
      if(res.status === 'success'){
        showToast(res.message, 'success');
        if(res.data){
          state = res.data;
          renderTable();
        } else {
          reloadHierarchyData();
        }
      } else {
        showToast(res.message || 'Gagal menarik RAK DPA.', 'error');
      }
    },
    error: function(){
      showToast('Gagal terhubung dengan server.', 'error');
    }
  });
}

function reloadHierarchyData(){
  $.ajax({
    url: baseUrl + 'Instansi/GetTargetRenaksiData',
    type: 'POST',
    data: {
      tahun: currentTahun,
      instansi: currentInstansiId,
      kode_wilayah: currentKodeWilayah
    },
    dataType: 'json',
    success: function(res){
      if(res.status === 'success' && res.data){
        state = res.data;
        renderTable();
      }
    }
  });
}

/* =========================================================
   LIVE SEARCH FILTER
   ========================================================= */
function filterTableLive(){
  var query = document.getElementById('searchInput').value.toLowerCase().trim();
  var rows = document.querySelectorAll('#tableBody tr.search-row');
  
  if(!query){
    rows.forEach(function(r){ r.style.display = ''; });
    return;
  }

  rows.forEach(function(r){
    var text = (r.getAttribute('data-search') || '').toLowerCase();
    if(text.indexOf(query) !== -1){
      r.style.display = '';
    } else {
      r.style.display = 'none';
    }
  });
}

/* ---------------- Top Wilayah Filter (Before Login) ---------------- */
$(function() {
  var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var BaseURL = '<?= base_url() ?>';
  var cKodeWilayah = '<?= !empty($KodeWilayah) ? $KodeWilayah : "" ?>';
  var cInstansiId = '<?= !empty($FilterInstansi) ? $FilterInstansi : (!empty($InstansiId) ? $InstansiId : "") ?>';

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

  $('#selProvinsiTop').change(function() {
    var prov = $(this).val();
    loadKabKotaTop(prov, '');
  });

  $('#selKabKotaTop').change(function() {
    var kab = $(this).val();
    loadInstansiTop(kab, '');
  });

  if (cKodeWilayah) {
    var provKode = cKodeWilayah.substring(0, 2);
    loadKabKotaTop(provKode, cKodeWilayah, function() {
      loadInstansiTop(cKodeWilayah, cInstansiId);
    });
  }

  $('#btnFilterWilayahTop').click(function() {
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

/* =========================================================
   INIT
   ========================================================= */
renderTable();
</script>
