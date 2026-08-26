<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$is_logged_in = isset($IsLoggedIn) ? $IsLoggedIn : (isset($_SESSION['Level']));
$is_role_4 = isset($IsRole4) ? $IsRole4 : (isset($_SESSION['Level']) && $_SESSION['Level'] == 4);
$ActiveInstansiId = isset($ActiveInstansiId) ? $ActiveInstansiId : (isset($FilterInstansiId) ? $FilterInstansiId : (isset($InstansiId) ? $InstansiId : null));
?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
  
  <style>
  :root {
    --brand-dark: #1e3d34;
    --brand-green: #2d6a4f;
    --brand-emerald: #40916c;
    --brand-mint: #74c69d;
    --brand-soft: #d8f3dc;
    --brand-surface: #f2fbf5;
    --brand-border: #b7e4c7;
    --brand-deep: #081c15;

    --slate-50: #f8fafc;
    --slate-100: #f1f5f9;
    --slate-200: #e2e8f0;
    --slate-300: #cbd5e1;
    --slate-400: #94a3b8;
    --slate-500: #64748b;
    --slate-600: #475569;
    --slate-700: #334155;
    --slate-800: #1e293b;
    --slate-900: #0f172a;

    --white: #ffffff;
    --amber-soft: #fef3c7;
    --amber-border: #fcd34d;
    --amber-text: #92400e;

    --shadow-xs: 0 1px 2px rgba(0,0,0,0.04);
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.08), 0 2px 4px -2px rgba(0,0,0,0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04);
    --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.06);
  }

  body {
    background: #f4f7f6;
    color: var(--slate-800);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  }

  .main-content {
    margin-left: var(--sidebar-width, 280px);
    padding: 24px;
    min-height: 100vh;
    transition: all var(--transition-speed, 0.3s) ease;
  }
  .sidebar-mini .main-content {
    margin-left: var(--sidebar-mini-width, 70px);
  }

  .renja-wrapper {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  /* ============ TOPBAR ============ */
  .topbar {
    background: var(--white);
    border: 1px solid var(--slate-200);
    border-radius: 12px;
    padding: 18px 24px;
    box-shadow: var(--shadow-sm);
  }
  .topbar-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
  }
  .app-title h1 {
    font-size: 20px;
    font-weight: 800;
    color: var(--brand-dark);
    margin: 0 0 4px 0;
    letter-spacing: -0.2px;
  }
  .app-title span {
    font-size: 13px;
    color: var(--slate-500);
  }
  .topbar-controls {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }
  .rpjmd-select {
    height: 38px;
    padding: 0 14px;
    border: 1px solid var(--slate-200);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--slate-700);
    background: var(--white);
    cursor: pointer;
  }
  .year-tabs {
    display: inline-flex;
    background: var(--slate-100);
    border-radius: 8px;
    padding: 3px;
    gap: 3px;
  }
  .year-tab {
    border: none;
    background: transparent;
    padding: 7px 14px;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--slate-600);
    cursor: pointer;
    transition: all .15s ease;
  }
  .year-tab:hover {
    color: var(--brand-dark);
  }
  .year-tab.active {
    background: var(--white);
    color: var(--brand-dark);
    box-shadow: var(--shadow-xs);
    font-weight: 700;
  }

  .btn-sync {
    height: 38px;
    padding: 0 14px;
    background: #0284c7;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: background .15s;
  }
  .btn-sync:hover {
    background: #0369a1;
  }

  /* ============ PAGU SUMMARY ============ */
  .pagu-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 14px;
  }
  .pagu-item {
    background: var(--white);
    border: 1px solid var(--slate-200);
    border-radius: 12px;
    padding: 16px 20px;
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: relative;
    overflow: hidden;
  }
  .pagu-item::before {
    content: '';
    position: absolute;
    top: 0; left: 0; bottom: 0;
    width: 4px;
    background: var(--slate-300);
  }
  .pagu-item.status-balanced::before { background: var(--brand-green); }
  .pagu-item.status-remaining::before { background: #0284c7; }
  .pagu-item.status-over::before { background: #dc2626; }

  .pagu-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--slate-500);
    text-transform: uppercase;
    letter-spacing: .5px;
  }
  .pagu-value {
    font-size: 22px;
    font-weight: 800;
    color: var(--slate-900);
    letter-spacing: -.3px;
  }
  .pagu-sub {
    font-size: 12px;
    color: var(--slate-500);
  }

  /* ============ CARD / TABLE CONTAINER ============ */
  .table-card {
    background: var(--white);
    border: 1px solid var(--slate-200);
    border-radius: 12px;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }
  .table-toolbar {
    padding: 14px 20px;
    border-bottom: 1px solid var(--slate-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
  }
  .table-toolbar-left {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .table-toolbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .btn-toolbar {
    height: 34px;
    padding: 0 12px;
    border: 1px solid var(--slate-200);
    background: var(--white);
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--slate-700);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all .15s;
  }
  .btn-toolbar:hover {
    background: var(--slate-50);
    border-color: var(--slate-300);
  }

  .table-container {
    overflow-x: auto;
    max-height: 72vh;
  }
  .renja-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 12.5px;
  }
  .renja-table th,
  .renja-table td {
    padding: 8px 10px;
    border-right: 1px solid var(--slate-200);
    border-bottom: 1px solid var(--slate-200);
    vertical-align: top;
  }
  .renja-table th:first-child,
  .renja-table td:first-child {
    border-left: none;
  }

  .renja-table thead th {
    background: #f8fafc;
    color: var(--slate-700);
    font-weight: 700;
    font-size: 11.5px;
    text-transform: uppercase;
    letter-spacing: .3px;
    position: sticky;
    top: 0;
    z-index: 10;
    text-align: center;
    vertical-align: middle;
  }
  .renja-table thead tr:nth-child(2) th {
    top: 36px;
    z-index: 10;
  }

  /* Sticky first column (Kode) */
  .renja-table th:first-child,
  .renja-table td:first-child {
    position: sticky;
    left: 0;
    z-index: 3;
    background: inherit;
    width: 110px;
    min-width: 110px;
    max-width: 110px;
    font-family: "SFMono-Regular", Consolas, "Courier New", monospace;
  }
  .renja-table thead th:first-child {
    z-index: 20;
    background: #f8fafc;
  }

  .renja-table td.cell-uraian {
    width: 320px;
    min-width: 320px;
  }

  /* Row Styling */
  .row-pd td{
    background: var(--brand-dark) !important;
    color: #fff !important;
    font-size: 14.5px;
    font-weight: 800;
    letter-spacing: .3px;
    padding: 12px 14px;
    position: static;
  }
  .row-section td{
    background: var(--brand-soft) !important;
    color: var(--brand-deep) !important;
    font-weight: 700;
    font-size: 12.6px;
    padding: 8px 14px;
    border-top: 1px solid var(--brand-border);
    position: static;
  }
  .row-tujuan{ background: var(--white); }
  .row-tujuan td:first-child{ box-shadow: inset 3px 0 0 var(--brand-green); }
  .row-sasaran{ background: var(--white); }
  .row-sasaran td:first-child{ box-shadow: inset 3px 0 0 var(--brand-dark); }

  .row-urusan td {
    background: var(--brand-green) !important;
    color: #ffffff !important;
    font-weight: 700;
    font-size: 12.8px;
  }
  .row-urusan td:first-child { 
    background: var(--brand-green) !important; 
    color: #ffffff !important;
  }
  .row-urusan .cell-anggaran-auto { color: #ffffff !important; }

  .row-bidang td {
    background: var(--brand-soft) !important;
    color: var(--brand-deep) !important;
    font-weight: 700;
    font-size: 12.6px;
    padding-left: 20px;
  }
  .row-bidang td:first-child { 
    background: var(--brand-soft) !important; 
    color: var(--brand-deep) !important;
  }

  .row-program td {
    background: #ffffff;
    font-weight: 600;
    color: var(--slate-900);
  }
  .row-program td:first-child { font-weight: 700; }
  .row-program .cell-uraian { padding-left: 20px; }

  .row-kegiatan td {
    background: #fafcfb;
    color: var(--slate-800);
  }
  .row-kegiatan .cell-uraian { padding-left: 36px; }

  .row-subkegiatan td {
    background: #ffffff;
    color: var(--slate-700);
  }
  .row-subkegiatan .cell-uraian { padding-left: 52px; font-size: 12px; }

  .row-subkegiatan:hover td,
  .row-kegiatan:hover td,
  .row-program:hover td {
    background: #f1f8f5;
  }

  .cell-uraian {
    line-height: 1.45;
  }
  .label-tag {
    font-size: 10px;
    font-weight: 700;
    color: var(--brand-green);
    text-transform: uppercase;
    margin-right: 4px;
    letter-spacing: .3px;
  }
  .sub .label-tag {
    color: #0284c7;
  }

  .cell-anggaran-auto {
    color: var(--brand-deep);
    font-weight: 700;
    text-align: right;
    cursor: help;
  }
  .cell-anggaran-input {
    color: var(--slate-900);
    font-weight: 700;
    text-align: right;
  }

  .text-center { text-align: center; }
  .text-right { text-align: right; }

  .toggle-btn-inline {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    user-select: none;
  }
  .toggle-chevron {
    width: 14px;
    height: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform .15s ease;
  }
  .toggle-chevron.collapsed {
    transform: rotate(-90deg);
  }
  .collapse-badge {
    display: inline-block;
    font-size: 10.5px;
    font-weight: 600;
    padding: 1px 7px;
    border-radius: 10px;
    background: rgba(0,0,0,0.06);
    color: inherit;
    margin-left: 6px;
  }
  .row-urusan .collapse-badge { background: rgba(255,255,255,0.25); color: #fff; }

  .cell-pengampu {
    font-size: 11.5px;
    color: var(--slate-700);
    line-height: 1.35;
  }
  .pengampu-name {
    font-size: 11px;
    color: var(--slate-500);
  }

  .btn-aksi {
    padding: 3px 8px;
    font-size: 11.5px;
    border-radius: 5px;
  }

  /* Badge Notif Perubahan di RKPD */
  .badge-rkpd-changed {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fde68a;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    margin-top: 5px;
    cursor: help;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    line-height: 1.3;
    max-width: 100%;
    word-break: break-word;
  }
  .badge-rkpd-changed i {
    color: #d97706;
    font-size: 12px;
  }

  /* ============ MODAL ============ */
  .modal-backdrop-custom {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(2px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    padding: 20px;
  }
  .modal-backdrop-custom.open {
    display: flex;
  }
  .modal-dialog-custom {
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-xl);
    width: 100%;
    max-width: 780px;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: modalIn .18s ease;
  }
  @keyframes modalIn {
    from { opacity: 0; transform: scale(.96) translateY(8px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
  }
  .modal-header-custom {
    padding: 16px 22px;
    border-bottom: 1px solid var(--slate-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--slate-50);
  }
  .modal-header-custom h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: var(--brand-dark);
  }
  .modal-close-btn {
    border: none;
    background: transparent;
    font-size: 20px;
    color: var(--slate-400);
    cursor: pointer;
    line-height: 1;
  }
  .modal-close-btn:hover { color: var(--slate-700); }
  .modal-body-custom {
    padding: 20px 24px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .modal-footer-custom {
    padding: 14px 22px;
    border-top: 1px solid var(--slate-200);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    background: var(--slate-50);
  }

  .form-group-custom {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
  .form-group-custom label {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--slate-700);
  }
  .form-control-custom {
    height: 38px;
    padding: 0 12px;
    border: 1px solid var(--slate-300);
    border-radius: 7px;
    font-size: 13px;
    color: var(--slate-800);
    background: var(--white);
    outline: none;
    transition: border-color .15s;
  }
  .form-control-custom:focus {
    border-color: var(--brand-green);
    box-shadow: 0 0 0 3px rgba(45,106,79,0.12);
  }
  textarea.form-control-custom {
    height: auto;
    padding: 8px 12px;
  }
  .form-row-custom {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
  }

  .btn-primary-custom {
    height: 38px;
    padding: 0 18px;
    background: var(--brand-green);
    color: #fff;
    border: none;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s;
  }
  .btn-primary-custom:hover { background: var(--brand-dark); }
  .btn-secondary-custom {
    height: 38px;
    padding: 0 16px;
    background: var(--slate-200);
    color: var(--slate-700);
    border: none;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
  }
  .btn-secondary-custom:hover { background: var(--slate-300); }

  .loading-shade {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(255,255,255,0.7);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999999;
  }
  .loading-shade.active { display: flex; }
  .loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid var(--slate-200);
    border-top-color: var(--brand-green);
    border-radius: 50%;
    animation: spin .7s linear infinite;
  }
  @keyframes spin { to { transform: rotate(360deg); } }

  .toast-custom {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: var(--slate-900);
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: var(--shadow-lg);
    display: none;
    z-index: 999999;
  }
  .toast-custom.show { display: block; animation: toastIn .2s ease; }
  @keyframes toastIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body>

<div class="main-content">
  <div class="renja-wrapper">

    <!-- ============ FILTER SECTION ============ -->
    <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
      <!-- Filter Wilayah (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
      <div class="filter-card-custom" style="background:#fff; border-radius:12px; padding:18px 24px; margin-bottom:18px; box-shadow:var(--shadow-sm); border:1px solid var(--slate-200);">
        <div class="filter-header-title" style="font-size:14px; font-weight:700; color:var(--slate-800); margin-bottom:14px; display:flex; align-items:center; gap:8px;">
          <i class="fa fa-filter" style="color:var(--brand-green);"></i> Filter Wilayah &amp; Instansi
        </div>
        <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
          <div class="col-filter" style="flex:1; min-width:200px;">
            <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">Provinsi</label>
            <select class="form-control filter-select-custom" id="Provinsi" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
              <option value="">Pilih Provinsi</option>
              <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                  <?= html_escape($prov['Nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div class="col-filter" style="flex:1; min-width:200px;">
            <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">Kabupaten / Kota</label>
            <select class="form-control filter-select-custom" id="KabKota" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
              <option value="">Pilih Kab/Kota</option>
            </select>
          </div>

          <div class="col-filter" id="FilterInstansiGroup" style="flex:1.2; min-width:220px; <?= empty($KodeWilayah) ? 'display:none;' : '' ?>">
            <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">Perangkat Daerah / Instansi</label>
            <select class="form-control filter-select-custom" id="FilterInstansiBeforeLogin" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
              <option value="">-- Pilih Instansi --</option>
              <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
                <option value="<?= $ins['id'] ?>" <?= ($ActiveInstansiId == $ins['id']) ? 'selected' : '' ?>>
                  <?= html_escape($ins['nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div class="col-filter" style="width:auto;">
            <button type="button" class="btn btn-primary-custom" id="Filter" style="height:38px; padding:0 22px; font-size:13px;">
              <i class="fa fa-search"></i> Filter
            </button>
          </div>
        </div>

        <?php if (!empty($KodeWilayah)) { ?>
          <div style="margin-top:14px; padding:10px 14px; background:var(--brand-surface); border-left:4px solid var(--brand-green); border-radius:6px; font-size:12.5px; color:var(--slate-700);">
            <strong>Wilayah Terpilih:</strong> <?= html_escape($NamaWilayah) ?>
            <?php 
            if (!empty($ActiveInstansiId)) { 
              $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', (int)$ActiveInstansiId)->get()->row_array();
              if ($instansi_terpilih) {
            ?>
              &nbsp;|&nbsp; <strong>Instansi:</strong> <?= html_escape($instansi_terpilih['nama']) ?>
            <?php }} ?>
          </div>
        <?php } ?>
      </div>
    <?php } else { ?>
      <!-- Filter Instansi Saja - SETELAH LOGIN SEBAGAI DAERAH -->
      <?php if (!$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        <div class="filter-card-custom" style="background:#fff; border-radius:12px; padding:16px 24px; margin-bottom:18px; box-shadow:var(--shadow-sm); border:1px solid var(--slate-200);">
          <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
            <div class="col-filter" style="flex:1; min-width:260px;">
              <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">
                <i class="fa fa-building" style="color:var(--brand-green); margin-right:4px;"></i> Pilih Perangkat Daerah / Instansi
              </label>
              <select class="form-control filter-select-custom" id="FilterInstansi" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
                <?php foreach ($ListInstansi as $ins) { ?>
                  <option value="<?= $ins['id'] ?>" <?= ($ActiveInstansiId == $ins['id']) ? 'selected' : '' ?>>
                    <?= html_escape($ins['nama']) ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-filter" style="width:auto;">
              <button type="button" class="btn btn-primary-custom" id="FilterInstansiBtn" style="height:38px; padding:0 20px; font-size:13px;">
                <i class="fa fa-filter"></i> Terapkan
              </button>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>

    <!-- ============ TOPBAR ============ -->
    <div class="topbar">
      <div class="topbar-row">
        <div class="app-title">
          <h1>Rancangan Awal Rencana Kerja Pemerintah Daerah (Ranwal RKPD)</h1>
          <span>Data Program, Kegiatan, dan Sub Kegiatan bersumber dari Ranwal Renja Perangkat Daerah &mdash; menampilkan Ranwal RKPD Tahun <b id="activeYearLabel"><?= html_escape($TahunAktif) ?></b></span>
        </div>
        <div class="topbar-controls">
          <select id="rpjmdSelect" class="rpjmd-select">
            <option>RPJMD 2025-2029</option>
          </select>
          <div class="year-tabs" id="yearTabs"></div>
          <button type="button" id="btnSyncData" class="btn-sync" title="Cocokkan / Sinkronkan Ulang Data RKPD dengan Renja">
            <i class="fa fa-refresh"></i> Sinkronkan Renja
          </button>
        </div>
      </div>
    </div>

    <!-- ============ RINGKASAN PAGU ANGGARAN ============ -->
    <div class="pagu-summary">
      <div class="pagu-item">
        <span class="pagu-label">Pagu Anggaran Tahun <span id="paguTahunLabel"><?= html_escape($TahunAktif) ?></span></span>
        <span class="pagu-value" id="paguAnggaranValue">Rp 0</span>
        <span class="pagu-sub">Total Pagu Ditetapkan di Pagu Urusan</span>
      </div>
      <div class="pagu-item">
        <span class="pagu-label">Total Anggaran Ranwal RKPD</span>
        <span class="pagu-value" id="paguTerinputValue">Rp 0</span>
        <span class="pagu-sub" id="paguTerinputPercent">0% dari Pagu Anggaran</span>
      </div>
      <div class="pagu-item" id="paguSelisihItem">
        <span class="pagu-label" id="paguSelisihLabel">Selisih Anggaran</span>
        <span class="pagu-value" id="paguSelisihValue">Rp 0</span>
        <span class="pagu-sub" id="paguSelisihSub">Perhitungan otomatis</span>
      </div>
    </div>

    <!-- ============ TABLE CARD ============ -->
    <div class="table-card">
      <div class="table-toolbar">
        <div class="table-toolbar-left">
          <button class="btn-toolbar" id="btnExpandAll"><i class="fa fa-expand"></i> Buka Semua</button>
          <button class="btn-toolbar" id="btnCollapseAll"><i class="fa fa-compress"></i> Tutup Semua</button>
        </div>
        <div class="table-toolbar-right">
          <span style="font-size:12.5px; color:var(--slate-500);">Perangkat Daerah: <b id="pdNameLabel" style="color:var(--brand-dark);"><?= html_escape($NamaInstansi) ?></b></span>
        </div>
      </div>

      <div class="table-container">
        <table class="renja-table" id="renjaTable">
          <thead>
            <tr>
              <th rowspan="2">Kode</th>
              <th rowspan="2">Urusan / Bidang Urusan / Program / Kegiatan / Sub Kegiatan</th>
              <th rowspan="2">Indikator Kinerja</th>
              <th colspan="2"> Ranwal Renja</th>
              <th rowspan="2">Pagu Anggaran (Rp)</th>
              <th rowspan="2">Lokasi</th>
              <th rowspan="2">Sumber Pendanaan</th>
              <th colspan="3">Prioritas &amp; Sasaran</th>
              <th colspan="2">Prakiraan Maju Anggaran</th>
              <th rowspan="2">Pengampu</th>
              <th rowspan="2" style="width:70px;">Opsi</th>
            </tr>
            <tr>
              <th>Satuan</th>
              <th>Target</th>
              <th>Daerah</th>
              <th>Nasional</th>
              <th>Kelompok Sasaran</th>
              <th>Target</th>
              <th>Pagu (Rp)</th>
            </tr>
          </thead>
          <tbody id="renjaBody">
            <tr>
              <td colspan="15" class="text-center" style="padding:40px; color:var(--slate-400);">Memuat data Ranwal RKPD...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- ============ MODAL EDIT KEGIATAN ============ -->
<div class="modal-backdrop-custom" id="modalKegiatan">
  <div class="modal-dialog-custom">
    <div class="modal-header-custom">
      <h3><i class="fa fa-pencil-square-o" style="color:var(--brand-green);"></i> Edit Kegiatan (Ranwal RKPD)</h3>
      <button type="button" class="modal-close-btn" data-close="modalKegiatan">&times;</button>
    </div>
    <div class="modal-body-custom">
      <div class="form-group-custom">
        <label>Kode &amp; Nomenklatur Kegiatan</label>
        <input type="text" class="form-control-custom" id="kegKodeNama" readonly style="background:#f1f5f9;">
      </div>

      <div class="form-group-custom">
        <label>Indikator Kinerja Kegiatan</label>
        <textarea class="form-control-custom" id="kegIndikator" rows="2"></textarea>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Target Kinerja</label>
          <input type="text" class="form-control-custom" id="kegTarget">
        </div>
        <div class="form-group-custom">
          <label>Satuan</label>
          <input type="text" class="form-control-custom" id="kegSatuan">
        </div>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Prioritas Nasional</label>
          <select class="form-control-custom" id="kegPrioritasNasional"></select>
        </div>
        <div class="form-group-custom">
          <label>Kelompok Sasaran</label>
          <input type="text" class="form-control-custom" id="kegKelompokSasaran">
        </div>
      </div>

      <div class="form-group-custom">
        <label>Pengampu (Bidang / Koordinator)</label>
        <input type="text" class="form-control-custom" id="kegPengampu" readonly style="background:#f1f5f9;">
      </div>
    </div>
    <div class="modal-footer-custom">
      <button type="button" class="btn-secondary-custom" data-close="modalKegiatan">Batal</button>
      <button type="button" class="btn-primary-custom" id="btnSaveKegiatan"><i class="fa fa-save"></i> Simpan Ranwal RKPD</button>
    </div>
  </div>
</div>

<!-- ============ MODAL EDIT SUB KEGIATAN ============ -->
<div class="modal-backdrop-custom" id="modalSubKegiatan">
  <div class="modal-dialog-custom">
    <div class="modal-header-custom">
      <h3><i class="fa fa-pencil-square-o" style="color:var(--brand-green);"></i> Edit Sub Kegiatan (Ranwal RKPD)</h3>
      <button type="button" class="modal-close-btn" data-close="modalSubKegiatan">&times;</button>
    </div>
    <div class="modal-body-custom">
      <div class="form-group-custom">
        <label>Kode &amp; Nomenklatur Sub Kegiatan</label>
        <input type="text" class="form-control-custom" id="subKodeNama" readonly style="background:#f1f5f9;">
      </div>

      <div class="form-group-custom">
        <label>Indikator Sub Kegiatan</label>
        <textarea class="form-control-custom" id="subIndikator" rows="2"></textarea>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Target Kinerja</label>
          <input type="text" class="form-control-custom" id="subTarget">
        </div>
        <div class="form-group-custom">
          <label>Satuan</label>
          <input type="text" class="form-control-custom" id="subSatuan">
        </div>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Pagu Anggaran Tahun Berjalan (Rp)</label>
          <input type="text" class="form-control-custom" id="subAnggaran" style="font-weight:700; color:var(--brand-dark);">
        </div>
        <div class="form-group-custom">
          <label>Prakiraan Maju N+1 (Rp)</label>
          <input type="text" class="form-control-custom" id="subAnggaranN1">
        </div>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Prioritas Provinsi</label>
          <select class="form-control-custom" id="subPrioritasProvinsi"></select>
        </div>
        <div class="form-group-custom">
          <label>Prioritas Kabupaten / Kota</label>
          <select class="form-control-custom" id="subPrioritasKabKota"></select>
        </div>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Sumber Pendanaan</label>
          <select class="form-control-custom" id="subSumberDana"></select>
        </div>
        <div class="form-group-custom">
          <label>Lokasi Pelaksanaan</label>
          <select class="form-control-custom" id="subLokasiPelaksanaan"></select>
        </div>
      </div>

      <div class="form-row-custom" id="detailLokasiRow">
        <div class="form-group-custom">
          <label>Kabupaten / Kota</label>
          <input type="text" class="form-control-custom" id="subKabKota" readonly style="background:#f1f5f9; cursor:not-allowed; font-weight:500;" placeholder="Kabupaten/Kota">
        </div>
        <div class="form-group-custom">
          <label>Kecamatan</label>
          <select class="form-control-custom" id="subKecamatan"></select>
        </div>
        <div class="form-group-custom">
          <label>Desa / Kelurahan</label>
          <select class="form-control-custom" id="subDesa"></select>
        </div>
      </div>

      <div class="form-row-custom">
        <div class="form-group-custom">
          <label>Waktu Mulai Pelaksanaan</label>
          <select class="form-control-custom" id="subBulanMulai"></select>
        </div>
        <div class="form-group-custom">
          <label>Waktu Selesai Pelaksanaan</label>
          <select class="form-control-custom" id="subBulanSelesai"></select>
        </div>
      </div>

      <div class="form-group-custom">
        <label>Pengampu (Bidang / Koordinator)</label>
        <input type="text" class="form-control-custom" id="subPengampu" readonly style="background:#f1f5f9;">
      </div>
    </div>
    <div class="modal-footer-custom">
      <button type="button" class="btn-secondary-custom" data-close="modalSubKegiatan">Batal</button>
      <button type="button" class="btn-primary-custom" id="btnSaveSubKegiatan"><i class="fa fa-save"></i> Simpan Ranwal RKPD</button>
    </div>
  </div>
</div>

<div class="loading-shade" id="loadingShade"><div class="loading-spinner"></div></div>
<div class="toast-custom" id="toast"></div>

<script>
const BASE_URL = "<?= base_url() ?>";
const CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
const CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
let activeInstansiId = <?= json_encode($ActiveInstansiId) ?>;
const CURRENT_KODE_WILAYAH = <?= json_encode($KodeWilayah) ?>;
const CURRENT_NAMA_WILAYAH = <?= json_encode($NamaWilayah ?? '') ?>;

/* =========================================================================
   KONFIGURASI DATA REFERENSI
   ========================================================================= */
const PRIORITAS_NASIONAL = [
  "Memperkokoh Ideologi Pancasila, Demokrasi, dan Hak Asasi Manusia (HAM)",
  "Memantapkan Sistem Pertahanan Keamanan Negara dan Mendorong Kemandirian Bangsa",
  "Meningkatkan Lapangan Kerja Berkualitas dan Melanjutkan Pengembangan Infrastruktur",
  "Memperkuat Pembangunan Sumber Daya Manusia (SDM), Sains, dan Teknologi",
  "Melanjutkan Hilirisasi dan Industrialisasi untuk Kemandirian Ekonomi Bangsa",
  "Membangun dari Desa dan dari Bawah untuk Pemerataan Ekonomi",
  "Memperkuat Reformasi Politik, Hukum, dan Birokrasi, serta Memperkuat Pencegahan dan Pemberantasan Korupsi, Narkoba, Judi, dan Penyelundupan",
  "Memperkuat Penyelarasan Kehidupan dengan Lingkungan, Alam, dan Budaya, serta Peningkatan Toleransi Antarumat Beragama"
];

const PRIORITAS_PROVINSI = [
  "Peningkatan Daya Saing Ekonomi Daerah",
  "Pengembangan Infrastruktur dan Konektivitas Wilayah",
  "Peningkatan Kualitas Sumber Daya Manusia",
  "Reformasi Birokrasi dan Tata Kelola Pemerintahan",
  "Pelestarian Lingkungan Hidup dan Ketahanan Bencana"
];

const PRIORITAS_KABKOTA = [
  "Penguatan UMKM dan Ekonomi Kerakyatan",
  "Peningkatan Pelayanan Publik Berbasis Digital",
  "Penataan Kawasan Perdagangan dan Jasa",
  "Peningkatan Investasi dan Kemudahan Berusaha",
  "Peningkatan Kualitas Lingkungan Perkotaan"
];

const SUMBER_DANA = ["PAD","DAU","DAK Fisik","DAK Non Fisik","DBH","DID","Lain-lain Pendapatan Daerah yang Sah","Pinjaman Daerah"];
const LOKASI_PELAKSANAAN = ["Dalam Kabupaten/Kota","Lintas Kecamatan","Lintas Kabupaten/Kota dalam Provinsi","Lintas Provinsi"];
const BULAN = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

const WILAYAH = {
  "Kabupaten Cirebon": {
    "Sumber": ["Sumber","Gegunung","Kemantren","Matangaji","Sidawangi"],
    "Kedawung": ["Kedawung","Kalikoa","Tuk","Sutawinangun"],
    "Palimanan": ["Palimanan Timur","Pegagan","Ciawi","Panembahan"]
  },
  "Kota Bekasi": {
    "Bekasi Timur": ["Duren Jaya","Aren Jaya","Margahayu"],
    "Bekasi Barat": ["Bintara","Bintara Jaya","Kranji"],
    "Medan Satria": ["Harapan Mulya","Medan Satria","Pejuang"]
  },
  "Kabupaten Bekasi": {
    "Cikarang Pusat": ["Sukamahi","Pasirranji","Hegarmukti"],
    "Cikarang Barat": ["Telaga Asih","Telagamurni","Kalijaya"]
  }
};

/* =========================================================================
   STATE DATA UTAMA
   ========================================================================= */
let renjaData = {
  perangkatDaerah: <?= json_encode($NamaInstansi) ?>,
  tahunAktif: <?= (int)$TahunAktif ?>,
  tahunList: [2026, 2027, 2028, 2029, 2030],
  paguAnggaran: 0,
  rincianPagu: [],
  prioritasNasionalList: [],
  prioritasProvinsiList: [],
  prioritasKabKotaList: [],
  urusan: []
};

let collapsedKeys = new Set();
let autoCollapsedApplied = false;

/* =========================================================================
   HELPER FORMATTING & NUMBER
   ========================================================================= */
function esc(str){
  if(str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g,'&amp;')
    .replace(/</g,'&lt;')
    .replace(/>/g,'&gt;')
    .replace(/"/g,'&quot;')
    .replace(/'/g,'&#039;');
}

function fmtRp(val){
  const num = Number(val) || 0;
  return 'Rp ' + num.toLocaleString('id-ID');
}

function formatRibuan(val){
  const num = String(val || "").replace(/[^\d]/g,'');
  return num ? Number(num).toLocaleString('id-ID') : '';
}
function parseRibuan(val){
  const num = String(val || "").replace(/[^\d]/g,'');
  return num || '0';
}
function toNumber(val){
  if(val === undefined || val === null) return 0;
  const num = String(val).replace(/[^\d]/g,'');
  return num ? Number(num) : 0;
}
function fmtRpMaju(val){
  return toNumber(val) === 0 ? '-' : fmtRp(val);
}

/* =========================================================================
   ANGGARAN BERJENJANG (CASCADING BUDGET)
   ========================================================================= */
function sumKegiatanRp(k){
  return (k.subKegiatan || []).reduce(function(total, sk){
    return total + toNumber(sk.rp);
  }, 0);
}
function sumKegiatanMajuRp(k){
  return (k.subKegiatan || []).reduce(function(total, sk){
    return total + toNumber(sk.anggaranN1);
  }, 0);
}

function sumProgramRp(p){
  return (p.kegiatan || []).reduce(function(total, k){
    return total + sumKegiatanRp(k);
  }, 0);
}
function sumProgramMajuRp(p){
  return (p.kegiatan || []).reduce(function(total, k){
    return total + sumKegiatanMajuRp(k);
  }, 0);
}

function sumBidangRp(b){
  return (b.program || []).reduce(function(total, p){
    return total + sumProgramRp(p);
  }, 0);
}
function sumBidangMajuRp(b){
  return (b.program || []).reduce(function(total, p){
    return total + sumProgramMajuRp(p);
  }, 0);
}

function sumUrusanRp(u){
  return (u.bidang || []).reduce(function(total, b){
    return total + sumBidangRp(b);
  }, 0);
}
function sumUrusanMajuRp(u){
  return (u.bidang || []).reduce(function(total, b){
    return total + sumBidangMajuRp(b);
  }, 0);
}

function sumTotalRp(){
  return (renjaData.urusan || []).reduce(function(total, u){
    return total + sumUrusanRp(u);
  }, 0);
}

/* =========================================================================
   LOKASI & SUMBER DANA AGGREGATOR
   ========================================================================= */
function stripKodeWilayah(str){
  if(!str) return '';
  return str.replace(/^[\d\.]+\s*-\s*/, '').replace(/\s*\([\d\.]+\)$/, '').trim();
}

function subKegiatanLokasiText(sk){
  const parts = [];
  const desa = stripKodeWilayah(sk.desa);
  const kec = stripKodeWilayah(sk.kecamatan);
  const kab = stripKodeWilayah(sk.kabKota);
  if(desa) parts.push(desa);
  if(kec) parts.push('Kec. ' + kec);
  if(kab) parts.push(kab);
  if(parts.length > 0) return parts.join(', ');
  if(sk.lokasiPelaksanaan) return stripKodeWilayah(sk.lokasiPelaksanaan);
  return stripKodeWilayah(sk.lokasi || '');
}

function kegiatanLokasi(k){
  const lokSet = new Set();
  (k.subKegiatan || []).forEach(function(sk){
    const l = subKegiatanLokasiText(sk);
    if(l && l !== '-') lokSet.add(l);
  });
  return Array.from(lokSet).join('; ') || '-';
}

function kegiatanSumberDana(k){
  const sdSet = new Set();
  (k.subKegiatan || []).forEach(function(sk){
    if(sk.sumberDana && sk.sumberDana !== '-') sdSet.add(sk.sumberDana);
  });
  return Array.from(sdSet).join('; ') || '-';
}

function programLokasi(p){
  const lokSet = new Set();
  (p.kegiatan || []).forEach(function(k){
    const l = kegiatanLokasi(k);
    if(l && l !== '-') lokSet.add(l);
  });
  return Array.from(lokSet).join('; ') || '-';
}

function programSumberDana(p){
  const sdSet = new Set();
  (p.kegiatan || []).forEach(function(k){
    const sd = kegiatanSumberDana(k);
    if(sd && sd !== '-') sdSet.add(sd);
  });
  return Array.from(sdSet).join('; ') || '-';
}

/* =========================================================================
   ROW COUNTER
   ========================================================================= */
function countProgramRows(p){
  let sub = 0;
  (p.kegiatan || []).forEach(function(k){
    sub += (k.subKegiatan || []).length;
  });
  return { kegiatan: (p.kegiatan || []).length, sub: sub };
}

function countUrusanRows(u){
  let prog = 0, keg = 0, sub = 0;
  (u.bidang || []).forEach(function(b){
    prog += (b.program || []).length;
    (b.program || []).forEach(function(p){
      keg += (p.kegiatan || []).length;
      (p.kegiatan || []).forEach(function(k){
        sub += (k.subKegiatan || []).length;
      });
    });
  });
  return { program: prog, kegiatan: keg, sub: sub };
}

/* =========================================================================
   FIND ENTITIES
   ========================================================================= */
function findKegiatan(kegiatanId){
  for(let u of (renjaData.urusan || [])){
    for(let b of (u.bidang || [])){
      for(let p of (b.program || [])){
        for(let k of (p.kegiatan || [])){
          if(k.id === kegiatanId || String(k.db_id) === String(kegiatanId)){
            return { urusan: u, bidang: b, program: p, kegiatan: k };
          }
        }
      }
    }
  }
  return null;
}

function findSubKegiatan(subId, kegiatanId){
  for(let u of (renjaData.urusan || [])){
    for(let b of (u.bidang || [])){
      for(let p of (b.program || [])){
        for(let k of (p.kegiatan || [])){
          if(!kegiatanId || k.id === kegiatanId || String(k.db_id) === String(kegiatanId)){
            for(let sk of (k.subKegiatan || [])){
              if(sk.id === subId || String(sk.db_id) === String(subId)){
                return { urusan: u, bidang: b, program: p, kegiatan: k, subKegiatan: sk };
              }
            }
          }
        }
      }
    }
  }
  return null;
}

/* =========================================================================
   DOM MANIPULATION (SURGICAL RE-RENDER)
   ========================================================================= */
function replaceRow(selector, htmlString){
  const oldRow = document.querySelector(selector);
  if(!oldRow) return;
  const temp = document.createElement('tbody');
  temp.innerHTML = htmlString.trim();
  const newRow = temp.firstElementChild;
  if(newRow){
    oldRow.parentNode.replaceChild(newRow, oldRow);
  }
}

function refreshSubKegiatanRow(subId, kegiatanId){
  const found = findSubKegiatan(subId, kegiatanId);
  if(!found) return;
  replaceRow('tr[data-row-key="sub:' + found.subKegiatan.id + '"]', subKegiatanRow(found.subKegiatan, found.kegiatan));
}

function refreshKegiatanRow(kegiatanId){
  const found = findKegiatan(kegiatanId);
  if(!found) return;
  replaceRow('tr[data-row-key="keg:' + found.kegiatan.id + '"]', kegiatanRow(found.kegiatan));
}

function refreshSubKegiatanChain(subId, kegiatanId){
  const foundSub = findSubKegiatan(subId, kegiatanId);
  if(!foundSub) return;
  replaceRow('tr[data-row-key="sub:' + foundSub.subKegiatan.id + '"]', subKegiatanRow(foundSub.subKegiatan, foundSub.kegiatan));

  const foundKeg = findKegiatan(kegiatanId);
  if(!foundKeg) return;
  replaceRow('tr[data-row-key="keg:' + foundKeg.kegiatan.id + '"]', kegiatanRow(foundKeg.kegiatan));
  replaceRow('tr[data-row-key="prog:' + foundKeg.program.kode + '"]', programRow(foundKeg.program));
  replaceRow('tr[data-row-key="bid:' + foundKeg.bidang.kode + '"]', bidangRow(foundKeg.bidang));
  replaceRow('tr[data-row-key="uru:' + foundKeg.urusan.kode + '"]', urusanRow(foundKeg.urusan));

  renderPaguSummary();
}

/* =========================================================================
   RINGKASAN PAGU ANGGARAN
   ========================================================================= */
function renderPaguSummary(){
  const pagu = toNumber(renjaData.paguAnggaran);
  const terinput = sumTotalRp();
  const selisih = pagu - terinput;
  const persen = pagu > 0 ? Math.round((terinput / pagu) * 1000) / 10 : 0;

  document.getElementById('paguAnggaranValue').textContent = fmtRp(pagu);
  document.getElementById('paguTerinputValue').textContent = fmtRp(terinput);
  document.getElementById('paguTerinputPercent').textContent = persen + '% dari Pagu Anggaran';

  const item = document.getElementById('paguSelisihItem');
  const labelEl = document.getElementById('paguSelisihLabel');
  const valueEl = document.getElementById('paguSelisihValue');
  const subEl = document.getElementById('paguSelisihSub');

  item.classList.remove('status-balanced', 'status-remaining', 'status-over');
  if(selisih === 0){
    item.classList.add('status-balanced');
    labelEl.textContent = 'Status Anggaran';
    valueEl.textContent = 'SEIMBANG';
    subEl.textContent = 'Total terinput pas dengan pagu anggaran';
  } else if(selisih > 0){
    item.classList.add('status-remaining');
    labelEl.textContent = 'Sisa Pagu Anggaran';
    valueEl.textContent = fmtRp(selisih);
    subEl.textContent = 'Belum dialokasikan ke Sub Kegiatan';
  } else {
    item.classList.add('status-over');
    labelEl.textContent = 'Kelebihan Anggaran';
    valueEl.textContent = fmtRp(Math.abs(selisih));
    subEl.textContent = 'Total melebihi pagu anggaran!';
  }
}

/* =========================================================================
   AUTO-COLLAPSE
   ========================================================================= */
function applyAutoCollapseIfNeeded(){
  if(autoCollapsedApplied) return;
  const urusanList = renjaData.urusan || [];
  if(urusanList.length > 2){
    urusanList.slice(1).forEach(function(u){
      collapsedKeys.add('u:' + u.kode);
    });
  }
  autoCollapsedApplied = true;
}

function chevronIcon(isCollapsed){
  const cls = isCollapsed ? 'toggle-chevron collapsed' : 'toggle-chevron';
  return '<span class="' + cls + '"><i class="fa fa-chevron-down"></i></span>';
}

/* =========================================================================
   HTML BUILDERS
   ========================================================================= */
function urusanRow(u){
  const total = sumUrusanRp(u);
  const totalMaju = sumUrusanMajuRp(u);
  const key = 'u:' + u.kode;
  const isCollapsed = collapsedKeys.has(key);
  const c = countUrusanRows(u);
  const badge = isCollapsed
    ? '<span class="collapse-badge">' + c.program + ' Program &middot; ' + c.kegiatan + ' Kegiatan &middot; ' + c.sub + ' Sub Kegiatan</span>'
    : '';
  return '<tr class="row-urusan" data-toggle-key="' + esc(key) + '" data-row-key="uru:' + esc(u.kode) + '">' +
    '<td>' + esc(u.kode) + '</td>' +
    '<td colspan="4"><span class="toggle-btn-inline">' + chevronIcon(isCollapsed) + esc(u.nama) + badge + '</span></td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Bidang Urusan di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td colspan="5"></td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Bidang Urusan di bawahnya (Anggaran N+1)">' + esc(fmtRpMaju(totalMaju)) + '</td>' +
    '<td colspan="2"></td>' +
    '</tr>';
}

function bidangRow(b){
  const total = sumBidangRp(b);
  const totalMaju = sumBidangMajuRp(b);
  return '<tr class="row-bidang" data-row-key="bid:' + esc(b.kode) + '">' +
    '<td>' + esc(b.kode) + '</td>' +
    '<td colspan="4">' + esc(b.nama) + '</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Program di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td colspan="5"></td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Program di bawahnya (Anggaran N+1)">' + esc(fmtRpMaju(totalMaju)) + '</td>' +
    '<td colspan="2"></td>' +
    '</tr>';
}

function programRow(p){
  const total = sumProgramRp(p);
  const totalMaju = sumProgramMajuRp(p);
  const key = 'p:' + p.kode;
  const isCollapsed = collapsedKeys.has(key);
  const c = countProgramRows(p);
  const badge = isCollapsed
    ? '<span class="collapse-badge">' + c.kegiatan + ' Kegiatan &middot; ' + c.sub + ' Sub Kegiatan</span>'
    : '';
  const pengampuNama = p.namaPengampu ? ('<br><span class="pengampu-name">@ ' + esc(p.namaPengampu) + '</span>') : '';
  const pengampuLabel = p.pengampu && p.pengampu !== '-' ? ('<strong>' + esc(p.pengampu) + '</strong>') : '-';

  return '<tr class="row-program" data-toggle-key="' + esc(key) + '" data-row-key="prog:' + esc(p.kode) + '">' +
    '<td>' + esc(p.kode) + '</td>' +
    '<td class="cell-uraian"><span class="toggle-btn-inline">' + chevronIcon(isCollapsed) + esc(p.nama) + badge + '</span></td>' +
    '<td>' + esc(p.indikator) + '</td>' +
    '<td class="text-center">' + esc(p.satuan) + '</td>' +
    '<td class="text-center">' + esc(p.kinerja) + '</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Kegiatan di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td class="cell-anggaran-auto" title="Digabung otomatis dari Lokasi seluruh Sub Kegiatan di bawahnya">' + esc(programLokasi(p)) + '</td>' +
    '<td class="text-center cell-anggaran-auto" title="Digabung otomatis dari Sumber Pendanaan seluruh Sub Kegiatan di bawahnya">' + esc(programSumberDana(p)) + '</td>' +
    '<td class="text-center">' + esc(p.prioritasDaerah) + '</td>' +
    '<td class="text-center">' + esc(p.prioritasNasional) + '</td>' +
    '<td>' + esc(p.kelompokSasaran) + '</td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Kegiatan di bawahnya (Anggaran N+1)">' + esc(fmtRpMaju(totalMaju)) + '</td>' +
    '<td class="cell-pengampu">' + pengampuLabel + pengampuNama + '</td>' +
    '<td class="text-center">&ndash;</td>' +
    '</tr>';
}

function kegiatanRow(k){
  const total = sumKegiatanRp(k);
  const totalMaju = sumKegiatanMajuRp(k);
  const pengampuNama = k.namaPengampu ? ('<br><span class="pengampu-name">@ ' + esc(k.namaPengampu) + '</span>') : '';
  const pengampuLabel = k.pengampu && k.pengampu !== '-' ? ('<strong>' + esc(k.pengampu) + '</strong>') : '-';

  return '<tr class="row-kegiatan" data-row-key="keg:' + esc(k.id) + '">' +
    '<td>' + esc(k.kode) + '</td>' +
    '<td class="cell-uraian"><span class="label-tag">Kegiatan:</span>' + esc(k.nama) + '</td>' +
    '<td>' + esc(k.indikator) + '</td>' +
    '<td class="text-center">' + esc(k.satuan) + '</td>' +
    '<td class="text-center">' + esc(k.target) + '</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Sub Kegiatan di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td class="cell-anggaran-auto" title="Digabung otomatis dari Lokasi seluruh Sub Kegiatan di bawahnya">' + esc(kegiatanLokasi(k)) + '</td>' +
    '<td class="text-center cell-anggaran-auto" title="Digabung otomatis dari Sumber Pendanaan seluruh Sub Kegiatan di bawahnya">' + esc(kegiatanSumberDana(k)) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasDaerah) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasNasional) + '</td>' +
    '<td>' + esc(k.kelompokSasaran) + '</td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Sub Kegiatan di bawahnya (Anggaran N+1)">' + esc(fmtRpMaju(totalMaju)) + '</td>' +
    '<td class="cell-pengampu">' + pengampuLabel + pengampuNama + '</td>' +
    '    <td class="text-center"><button class="btn btn-sm btn-warning btn-aksi" data-action="edit-kegiatan" data-id="' + k.id + '" title="Edit Kegiatan"><i class="fa fa-edit"></i></button></td>' +
    '</tr>';
}

function subKegiatanRow(sk, k){
  const lokasiText = subKegiatanLokasiText(sk) || '-';
  const prioritasDaerahText = [sk.prioritasProvinsi, sk.prioritasKabKota].filter(Boolean).join(' / ') || '-';
  const pengampuNama = sk.namaPengampu ? ('<br><span class="pengampu-name">@ ' + esc(sk.namaPengampu) + '</span>') : '';
  const pengampuLabel = sk.pengampu && sk.pengampu !== '-' ? ('<strong>' + esc(sk.pengampu) + '</strong>') : '-';

  return '<tr class="row-subkegiatan" data-row-key="sub:' + esc(sk.id) + '">' +
    '<td>' + esc(sk.kode) + '</td>' +
    '<td class="cell-uraian sub"><span class="label-tag">Sub Kegiatan:</span>' + esc(sk.nama) + '</td>' +
    '<td>' + esc(sk.indikator) + '</td>' +
    '<td class="text-center">' + esc(sk.satuan) + '</td>' +
    '<td class="text-center">' + esc(sk.target) + '</td>' +
    '<td class="text-right cell-anggaran-input" title="Anggaran diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(fmtRp(sk.rp)) + '</td>' +
    '<td class="cell-anggaran-input" title="Lokasi diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(lokasiText) + '</td>' +
    '<td class="text-center cell-anggaran-input" title="Sumber Pendanaan diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(sk.sumberDana || '-') + '</td>' +
    '<td>' + esc(prioritasDaerahText) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasNasional || '-') + '</td>' +
    '<td>' + esc(k.kelompokSasaran || '-') + '</td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-input" title="Anggaran N+1 diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(fmtRpMaju(sk.anggaranN1)) + '</td>' +
    '<td class="cell-pengampu">' + pengampuLabel + pengampuNama + '</td>' +
    '<td class="text-center"><button class="btn btn-sm btn-warning btn-aksi" data-action="edit-subkegiatan" data-id="' + sk.id + '" data-parent="' + k.id + '" title="Edit Sub Kegiatan"><i class="fa fa-edit"></i></button></td>' +
    '</tr>';
}

/* =========================================================================
   MODAL: KEGIATAN
   ========================================================================= */
let currentKegiatanId = null;

function openKegiatanModal(kegiatanId){
  const found = findKegiatan(kegiatanId);
  if(!found) return;
  const k = found.kegiatan;
  currentKegiatanId = k.id;

  document.getElementById('kegKodeNama').value = k.kode + ' - ' + k.nama;
  document.getElementById('kegIndikator').value = k.indikator || '';
  document.getElementById('kegTarget').value = k.target || '';
  document.getElementById('kegSatuan').value = k.satuan || '';
  document.getElementById('kegKelompokSasaran').value = k.kelompokSasaran && k.kelompokSasaran !== '-' ? k.kelompokSasaran : '';
  document.getElementById('kegPengampu').value = k.namaPengampu ? (k.pengampu + ' (@ ' + k.namaPengampu + ')') : (k.pengampu || '-');

  const pnSelect = document.getElementById('kegPrioritasNasional');
  const activePNList = (renjaData.prioritasNasionalList && renjaData.prioritasNasionalList.length > 0) ? renjaData.prioritasNasionalList : PRIORITAS_NASIONAL;
  populateSelect(pnSelect, activePNList, k.prioritasNasional);

  showModal('modalKegiatan');
}

function saveKegiatan(){
  if(!currentKegiatanId) return;
  const found = findKegiatan(currentKegiatanId);
  if(!found) return;

  const k = found.kegiatan;
  const newInd = document.getElementById('kegIndikator').value.trim();
  const newTarget = document.getElementById('kegTarget').value.trim();
  const newSatuan = document.getElementById('kegSatuan').value.trim();
  const newPN = document.getElementById('kegPrioritasNasional').value;
  const newKelompok = document.getElementById('kegKelompokSasaran').value.trim();

  k.indikator = newInd;
  k.target = newTarget;
  k.satuan = newSatuan;
  k.prioritasNasional = newPN || '-';
  k.kelompokSasaran = newKelompok || '-';

  // Kirim AJAX ke Server
  showLoading(true);
  const fd = new FormData();
  fd.append('kegiatan_id', k.db_id || k.id.replace('keg-',''));
  fd.append('tahun', renjaData.tahunAktif || 2026);
  fd.append('instansi_id', activeInstansiId);
  fd.append('indikator', newInd);
  fd.append('target', newTarget);
  fd.append('satuan', newSatuan);
  fd.append('prioritas_nasional', newPN);
  fd.append('kelompok_sasaran', newKelompok);
  fd.append(CSRF_NAME, CSRF_TOKEN);

  fetch(BASE_URL + 'Daerah/simpanRanwalRKPDKegiatan', {
    method: 'POST',
    body: fd,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    showLoading(false);
    hideModal('modalKegiatan');
    if(data.status === 'success'){
      showToast(data.message || 'Kegiatan Ranwal RKPD berhasil disimpan.');
      refreshKegiatanRow(currentKegiatanId);
    } else {
      showToast(data.message || 'Gagal menyimpan Kegiatan.', 'error');
    }
  })
  .catch(function(err){
    showLoading(false);
    console.error(err);
    showToast('Terjadi kesalahan koneksi server.', 'error');
  });
}

/* =========================================================================
   MODAL: SUB KEGIATAN
   ========================================================================= */
let currentSubKegiatanId = null;
let currentParentKegiatanId = null;

function openSubKegiatanModal(subId, parentKegiatanId){
  const found = findSubKegiatan(subId, parentKegiatanId);
  if(!found) return;

  const sk = found.subKegiatan;
  currentSubKegiatanId = sk.id;
  currentParentKegiatanId = parentKegiatanId;

  document.getElementById('subKodeNama').value = sk.kode + ' - ' + sk.nama;
  document.getElementById('subIndikator').value = sk.indikator || '';
  document.getElementById('subTarget').value = sk.target || '';
  document.getElementById('subSatuan').value = sk.satuan || '';
  document.getElementById('subAnggaran').value = formatRibuan(sk.rp);
  document.getElementById('subAnggaranN1').value = formatRibuan(sk.anggaranN1);
  document.getElementById('subPengampu').value = sk.namaPengampu ? (sk.pengampu + ' (@ ' + sk.namaPengampu + ')') : (sk.pengampu || '-');

  const ppSelect = document.getElementById('subPrioritasProvinsi');
  const activePPList = (renjaData.prioritasProvinsiList && renjaData.prioritasProvinsiList.length > 0) ? renjaData.prioritasProvinsiList : PRIORITAS_PROVINSI;
  populateSelect(ppSelect, activePPList, sk.prioritasProvinsi);

  const pkSelect = document.getElementById('subPrioritasKabKota');
  const activePKList = (renjaData.prioritasKabKotaList && renjaData.prioritasKabKotaList.length > 0) ? renjaData.prioritasKabKotaList : PRIORITAS_KABKOTA;
  populateSelect(pkSelect, activePKList, sk.prioritasKabKota);

  populateSelect(document.getElementById('subSumberDana'), SUMBER_DANA, sk.sumberDana);
  populateSelect(document.getElementById('subLokasiPelaksanaan'), LOKASI_PELAKSANAAN, sk.lokasiPelaksanaan);
  populateSelect(document.getElementById('subBulanMulai'), BULAN, sk.bulanMulai || 'Januari');
  populateSelect(document.getElementById('subBulanSelesai'), BULAN, sk.bulanSelesai || 'Desember');

  populateKabKota();
  populateKecamatan(CURRENT_KODE_WILAYAH, sk.kecamatan || '', function(){
    const selKec = document.getElementById('subKecamatan');
    const valKec = selKec ? selKec.value : '';
    if(valKec){
      populateDesa(valKec, sk.desa || '');
    }
  });

  showModal('modalSubKegiatan');
}

function saveSubKegiatan(){
  if(!currentSubKegiatanId || !currentParentKegiatanId) return;
  const found = findSubKegiatan(currentSubKegiatanId, currentParentKegiatanId);
  if(!found) return;

  const sk = found.subKegiatan;
  const newInd = document.getElementById('subIndikator').value.trim();
  const newTarget = document.getElementById('subTarget').value.trim();
  const newSatuan = document.getElementById('subSatuan').value.trim();
  const newAnggaran = parseRibuan(document.getElementById('subAnggaran').value);
  const newAnggaranN1 = parseRibuan(document.getElementById('subAnggaranN1').value);

  const newPP = document.getElementById('subPrioritasProvinsi').value;
  const newPK = document.getElementById('subPrioritasKabKota').value;
  const newSD = document.getElementById('subSumberDana').value;
  const newLP = document.getElementById('subLokasiPelaksanaan').value;
  const newKab = document.getElementById('subKabKota').value;
  const newKec = document.getElementById('subKecamatan').value;
  const newDes = document.getElementById('subDesa').value;
  const newBM = document.getElementById('subBulanMulai').value;
  const newBS = document.getElementById('subBulanSelesai').value;

  sk.indikator = newInd;
  sk.target = newTarget;
  sk.satuan = newSatuan;
  sk.rp = newAnggaran;
  sk.anggaranN1 = newAnggaranN1;
  sk.prioritasProvinsi = newPP;
  sk.prioritasKabKota = newPK;
  sk.sumberDana = newSD;
  sk.lokasiPelaksanaan = newLP;
  sk.kabKota = newKab;
  sk.kecamatan = newKec;
  sk.desa = newDes;
  sk.bulanMulai = newBM;
  sk.bulanSelesai = newBS;

  // Kirim AJAX ke Server
  showLoading(true);
  const fd = new FormData();
  fd.append('sub_kegiatan_id', sk.db_id || sk.id.replace('sub-',''));
  fd.append('tahun', renjaData.tahunAktif || 2026);
  fd.append('instansi_id', activeInstansiId);
  fd.append('anggaran', newAnggaran);
  fd.append('anggaran_n1', newAnggaranN1);
  fd.append('indikator', newInd);
  fd.append('target', newTarget);
  fd.append('satuan', newSatuan);
  fd.append('prioritas_provinsi', newPP);
  fd.append('prioritas_kabkota', newPK);
  fd.append('sumber_dana', newSD);
  fd.append('lokasi_pelaksanaan', newLP);
  fd.append('kab_kota', newKab);
  fd.append('kecamatan', newKec);
  fd.append('desa', newDes);
  fd.append('bulan_mulai', newBM);
  fd.append('bulan_selesai', newBS);
  fd.append(CSRF_NAME, CSRF_TOKEN);

  fetch(BASE_URL + 'Daerah/simpanRanwalRKPDSubKegiatan', {
    method: 'POST',
    body: fd,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    showLoading(false);
    hideModal('modalSubKegiatan');
    if(data.status === 'success'){
      showToast(data.message || 'Sub Kegiatan Ranwal RKPD berhasil disimpan.');
      refreshSubKegiatanChain(currentSubKegiatanId, currentParentKegiatanId);
    } else {
      showToast(data.message || 'Gagal menyimpan Sub Kegiatan.', 'error');
    }
  })
  .catch(function(err){
    showLoading(false);
    console.error(err);
    showToast('Terjadi kesalahan koneksi server.', 'error');
  });
}

/* =========================================================================
   DROPDOWN WILAYAH BERJENJANG
   ========================================================================= */
function populateSelect(el, list, selected){
  el.innerHTML = '<option value="">-- Pilih --</option>' + list.map(function(item){
    const sel = item === selected ? ' selected' : '';
    return '<option value="' + esc(item) + '"' + sel + '>' + esc(item) + '</option>';
  }).join('');
}

function populateKabKota(){
  const el = document.getElementById('subKabKota');
  if(el){
    el.value = CURRENT_NAMA_WILAYAH ? CURRENT_NAMA_WILAYAH : stripKodeWilayah(CURRENT_KODE_WILAYAH || '');
  }
}

function populateKecamatan(kabKode, selectedKec, callback){
  const sel = document.getElementById('subKecamatan');
  if(!sel) return;
  sel.innerHTML = '<option value="">Pilih Kecamatan</option>';
  const targetKode = kabKode || CURRENT_KODE_WILAYAH;
  if(!targetKode) return;
  
  const fd = new FormData();
  fd.append('kode', targetKode);
  
  fetch(BASE_URL + 'Daerah/getKecamatanWilayah', {
    method: 'POST',
    body: fd,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    let opts = '<option value="">Pilih Kecamatan</option>';
    if(data && data.length > 0){
      data.forEach(function(item){
        const cleanName = stripKodeWilayah(item.Nama);
        const cleanSel = stripKodeWilayah(selectedKec || '');
        const isSel = (cleanSel && (cleanSel.toLowerCase() === cleanName.toLowerCase() || selectedKec === item.Kode || selectedKec === item.Nama)) ? 'selected' : '';
        opts += '<option value="' + esc(cleanName) + '" data-kode="' + esc(item.Kode) + '" ' + isSel + '>' + esc(cleanName) + '</option>';
      });
    }
    sel.innerHTML = opts;
    if(callback) callback();
  })
  .catch(function(err){
    console.error('Gagal memuat kecamatan:', err);
  });
}

function populateDesa(kecVal, selectedDesa){
  const sel = document.getElementById('subDesa');
  if(!sel) return;
  sel.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
  if(!kecVal) return;
  
  let kecKode = kecVal;
  const selKec = document.getElementById('subKecamatan');
  const selOpt = selKec ? selKec.options[selKec.selectedIndex] : null;
  if(selOpt && selOpt.getAttribute('data-kode')){
    kecKode = selOpt.getAttribute('data-kode');
  } else if(kecVal.indexOf(' - ') !== -1){
    kecKode = kecVal.split(' - ')[0].trim();
  }
  
  const fd = new FormData();
  fd.append('kode', kecKode);
  
  fetch(BASE_URL + 'Daerah/getDesaWilayah', {
    method: 'POST',
    body: fd,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    let opts = '<option value="">Pilih Desa/Kelurahan</option>';
    if(data && data.length > 0){
      data.forEach(function(item){
        const cleanName = stripKodeWilayah(item.Nama);
        const cleanSel = stripKodeWilayah(selectedDesa || '');
        const isSel = (cleanSel && (cleanSel.toLowerCase() === cleanName.toLowerCase() || selectedDesa === item.Kode || selectedDesa === item.Nama)) ? 'selected' : '';
        opts += '<option value="' + esc(cleanName) + '" data-kode="' + esc(item.Kode) + '" ' + isSel + '>' + esc(cleanName) + '</option>';
      });
    }
    sel.innerHTML = opts;
  })
  .catch(function(err){
    console.error('Gagal memuat desa:', err);
  });
}

function populateStaticOptions(){
  populateKabKota();
}

/* =========================================================================
   COLLAPSE / ACCORDION ENGINE
   ========================================================================= */
function isRowVisible(u, p){
  if(u && collapsedKeys.has('u:' + u.kode)) return false;
  if(p && collapsedKeys.has('p:' + p.kode)) return false;
  return true;
}

function toggleCollapse(key){
  if(collapsedKeys.has(key)){
    collapsedKeys.delete(key);
  } else {
    collapsedKeys.add(key);
  }
  renderTable();
}

function expandAll(){
  collapsedKeys.clear();
  renderTable();
}

function collapseAll(){
  (renjaData.urusan || []).forEach(function(u){
    collapsedKeys.add('u:' + u.kode);
  });
  renderTable();
}

/* =========================================================================
   MODAL DISPLAY HELPERS
   ========================================================================= */
function showModal(id){
  document.getElementById(id).classList.add('open');
}
function hideModal(id){
  document.getElementById(id).classList.remove('open');
}
function showLoading(show){
  document.getElementById('loadingShade').classList.toggle('active', !!show);
}
function showToast(msg, type){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.style.background = type === 'error' ? '#dc2626' : 'var(--slate-900)';
  t.classList.add('show');
  setTimeout(function(){ t.classList.remove('show'); }, 3000);
}

function sectionRow(label){
  return '<tr class="row-section"><td colspan="15">' + esc(label) + '</td></tr>';
}

function uraianRow(kind, uraian, rowspan, ind){
  const uraianCell = uraian !== null
    ? '<td rowspan="' + rowspan + '" class="cell-uraian">' + esc(uraian) + '</td>'
    : '';
  return '<tr class="row-' + kind + '">' +
    '<td></td>' +
    uraianCell +
    '<td>' + esc(ind.uraian) + '</td>' +
    '<td class="text-center">' + esc(ind.satuan) + '</td>' +
    '<td class="text-center">' + esc(ind.kinerja) + '</td>' +
    '<td class="text-right">' + esc(ind.rp) + '</td>' +
    '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>' +
    '</tr>';
}

/* =========================================================================
   TABLE MAIN RENDER
   ========================================================================= */
function renderTable(){
  const tbody = document.getElementById('renjaBody');
  const urusanList = renjaData.urusan || [];

  if(!urusanList || urusanList.length === 0){
    tbody.innerHTML = '<tr><td colspan="15" class="text-center" style="padding:40px; color:var(--slate-400);">Belum ada data Urusan / Program / Kegiatan pada Renstra Perangkat Daerah ini.</td></tr>';
    renderPaguSummary();
    return;
  }

  let html = '';

  // 1. Urusan -> Bidang -> Program -> Kegiatan -> Sub Kegiatan
  urusanList.forEach(function(u){
    html += urusanRow(u);

    const isUrusanCollapsed = collapsedKeys.has('u:' + u.kode);
    if(isUrusanCollapsed) return;

    (u.bidang || []).forEach(function(b){
      html += bidangRow(b);

      (b.program || []).forEach(function(p){
        html += programRow(p);

        const isProgCollapsed = collapsedKeys.has('p:' + p.kode);
        if(isProgCollapsed) return;

        (p.kegiatan || []).forEach(function(k){
          html += kegiatanRow(k);

          (k.subKegiatan || []).forEach(function(sk){
            html += subKegiatanRow(sk, k);
          });
        });
      });
    });
  });

  tbody.innerHTML = html;
  renderPaguSummary();
}

function syncHeadRowHeight(){
  const thead = document.querySelector('.renja-table thead');
  if(!thead) return;
  const firstRow = thead.querySelector('tr:first-child');
  if(firstRow){
    const h = firstRow.offsetHeight;
    const secondRowHeaders = thead.querySelectorAll('tr:nth-child(2) th');
    secondRowHeaders.forEach(function(th){
      th.style.top = h + 'px';
    });
  }
}

/* =========================================================================
   AJAX DATA LOADER FROM SERVER
   ========================================================================= */
function loadRenjaDataServer(tahun, instansiId){
  showLoading(true);
  const y = tahun || renjaData.tahunAktif || 2026;
  const insId = instansiId || activeInstansiId || '';

  let url = BASE_URL + 'Daerah/getRanwalRKPDJson?tahun=' + encodeURIComponent(y);
  if(insId) url += '&instansi_id=' + encodeURIComponent(insId);

  fetch(url, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    showLoading(false);
    if(data.status === 'success' && data.data){
      renjaData = data.data;
      if(renjaData.perangkatDaerah){
        document.getElementById('pdNameLabel').textContent = renjaData.perangkatDaerah;
      }
      autoCollapsedApplied = false;
      applyAutoCollapseIfNeeded();
      renderTable();
      syncHeadRowHeight();
    } else {
      showToast('Gagal memuat data Ranwal RKPD.', 'error');
    }
  })
  .catch(function(err){
    showLoading(false);
    console.error(err);
    showToast('Terjadi kesalahan koneksi.', 'error');
  });
}

function buildYearTabs(){
  const wrap = document.getElementById('yearTabs');
  const years = (renjaData.tahunList && renjaData.tahunList.length > 0) ? renjaData.tahunList : [2026, 2027, 2028, 2029, 2030];
  const activeYear = renjaData.tahunAktif || 2026;
  
  wrap.innerHTML = years.map(function(y){
    const active = y === activeYear ? ' active' : '';
    return '<button class="year-tab' + active + '" data-year="' + y + '">Tahun ' + y + '</button>';
  }).join('');
}

/* =========================================================================
   EVENT BINDING
   ========================================================================= */
document.addEventListener('DOMContentLoaded', function(){
  populateStaticOptions();
  buildYearTabs();
  applyAutoCollapseIfNeeded();
  loadRenjaDataServer(renjaData.tahunAktif, activeInstansiId);

  // Edit buttons & accordion toggle
  document.getElementById('renjaBody').addEventListener('click', function(e){
    const btn = e.target.closest('button[data-action]');
    if(btn){
      const action = btn.getAttribute('data-action');
      if(action === 'edit-kegiatan'){
        openKegiatanModal(btn.getAttribute('data-id'));
      } else if(action === 'edit-subkegiatan'){
        openSubKegiatanModal(btn.getAttribute('data-id'), btn.getAttribute('data-parent'));
      }
      return;
    }
    const toggleRow = e.target.closest('tr[data-toggle-key]');
    if(toggleRow){
      toggleCollapse(toggleRow.getAttribute('data-toggle-key'));
    }
  });

  // Modal close
  document.querySelectorAll('[data-close]').forEach(function(el){
    el.addEventListener('click', function(){ hideModal(el.getAttribute('data-close')); });
  });
  document.querySelectorAll('.modal-backdrop-custom').forEach(function(bd){
    bd.addEventListener('click', function(e){
      if(e.target === bd) hideModal(bd.id);
    });
  });
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape'){
      document.querySelectorAll('.modal-backdrop-custom.open').forEach(function(bd){ hideModal(bd.id); });
    }
  });

  // Save buttons
  document.getElementById('btnSaveKegiatan').addEventListener('click', saveKegiatan);
  document.getElementById('btnSaveSubKegiatan').addEventListener('click', saveSubKegiatan);

  // Cascading dropdown wilayah
  const selKecEl = document.getElementById('subKecamatan');
  if(selKecEl){
    selKecEl.addEventListener('change', function(e){
      const opt = this.options[this.selectedIndex];
      const kecKode = (opt && opt.getAttribute('data-kode')) ? opt.getAttribute('data-kode') : (this.value ? this.value.split(' - ')[0].trim() : '');
      populateDesa(kecKode, '');
    });
  }

  // Format ribuan
  ['subAnggaran','subAnggaranN1'].forEach(function(id){
    document.getElementById(id).addEventListener('input', function(e){
      e.target.value = formatRibuan(e.target.value);
    });
  });

  // Toolbar buttons
  document.getElementById('btnExpandAll').addEventListener('click', expandAll);
  document.getElementById('btnCollapseAll').addEventListener('click', collapseAll);

  // Year tabs
  document.getElementById('yearTabs').addEventListener('click', function(e){
    const btn = e.target.closest('.year-tab');
    if(!btn) return;
    document.querySelectorAll('.year-tab').forEach(function(b){ b.classList.remove('active'); });
    btn.classList.add('active');
    const selectedYear = Number(btn.getAttribute('data-year'));
    renjaData.tahunAktif = selectedYear;
    document.getElementById('activeYearLabel').textContent = selectedYear;
    document.getElementById('paguTahunLabel').textContent = selectedYear;
    loadRenjaDataServer(selectedYear, activeInstansiId);
  });

  // Sinkronisasi Ulang Data RKPD dengan Renja
  const btnSync = document.getElementById('btnSyncData');
  if(btnSync){
    btnSync.addEventListener('click', function(){
      const y = renjaData.tahunAktif || 2026;
      if(!confirm('Apakah Anda yakin ingin menyinkronkan ulang data Ranwal RKPD Tahun ' + y + ' dengan data Ranwal Renja?\n\nPerubahan kustom pada Ranwal RKPD tahun ' + y + ' akan direset dan dicocokkan kembali ke data Ranwal Renja.')){
        return;
      }
      showLoading(true);
      const fd = new FormData();
      fd.append('tahun', y);
      fd.append('instansi_id', activeInstansiId);
      fd.append(CSRF_NAME, CSRF_TOKEN);
      
      fetch(BASE_URL + 'Daerah/resetRanwalRKPDDataFromRenja', {
        method: 'POST',
        body: fd,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(function(res){ return res.json(); })
      .then(function(data){
        showLoading(false);
        if(data.status === 'success'){
          showToast(data.message || 'Sinkronisasi berhasil.');
          loadRenjaDataServer(y, activeInstansiId);
        } else {
          showToast(data.message || 'Gagal menyinkronkan data.', 'error');
        }
      })
      .catch(function(err){
        showLoading(false);
        console.error(err);
        showToast('Terjadi kesalahan saat menyinkronkan data.', 'error');
      });
    });
  }

  // =========================================================================
  // FILTER WILAYAH SEBELUM LOGIN
  // =========================================================================
  <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
    const selProv = document.getElementById('Provinsi');
    const selKab = document.getElementById('KabKota');
    const grpInstansi = document.getElementById('FilterInstansiGroup');
    const selInstansiBefore = document.getElementById('FilterInstansiBeforeLogin');
    const btnFilter = document.getElementById('Filter');

    if (selProv) {
      selProv.addEventListener('change', function(){
        const provKode = this.value;
        if (!provKode) {
          selKab.innerHTML = '<option value="">Pilih Kab/Kota</option>';
          if (grpInstansi) grpInstansi.style.display = 'none';
          return;
        }

        const fd = new FormData();
        fd.append('Kode', provKode);
        fd.append(CSRF_NAME, CSRF_TOKEN);

        fetch(BASE_URL + 'Instansi/GetListKabKota', {
          method: 'POST',
          body: fd,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(res){ return res.json(); })
        .then(function(data){
          let opts = '<option value="">Pilih Kab/Kota</option>';
          if (data && data.length > 0) {
            data.forEach(function(item){
              opts += '<option value="' + esc(item.Kode) + '">' + esc(item.Nama) + '</option>';
            });
          }
          selKab.innerHTML = opts;
        })
        .catch(function(err){ console.error(err); });
      });
    }

    if (selKab) {
      selKab.addEventListener('change', function(){
        const kabKode = this.value;
        if (!kabKode) {
          if (grpInstansi) grpInstansi.style.display = 'none';
          return;
        }

        const fd = new FormData();
        fd.append('kode_wilayah', kabKode);
        fd.append(CSRF_NAME, CSRF_TOKEN);

        fetch(BASE_URL + 'Instansi/GetListInstansiLevel4', {
          method: 'POST',
          body: fd,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(res){ return res.json(); })
        .then(function(data){
          let opts = '<option value="">-- Pilih Instansi --</option>';
          if (data && data.length > 0) {
            data.forEach(function(item){
              const selected = (activeInstansiId == item.id) ? 'selected' : '';
              opts += '<option value="' + item.id + '" ' + selected + '>' + esc(item.nama) + '</option>';
            });
          }
          if (selInstansiBefore) selInstansiBefore.innerHTML = opts;
          if (grpInstansi) grpInstansi.style.display = 'block';
        })
        .catch(function(err){ console.error(err); });
      });
    }

    if (btnFilter) {
      btnFilter.addEventListener('click', function(){
        const provVal = selProv ? selProv.value : '';
        const kabVal = selKab ? selKab.value : '';
        if (!provVal) { alert('Mohon Pilih Provinsi'); return; }
        if (!kabVal) { alert('Mohon Pilih Kab/Kota'); return; }

        const instansiVal = selInstansiBefore ? selInstansiBefore.value : '';
        const fd = new FormData();
        fd.append('KodeWilayah', kabVal);
        if (instansiVal) fd.append('InstansiId', instansiVal);
        fd.append(CSRF_NAME, CSRF_TOKEN);

        btnFilter.disabled = true;
        btnFilter.textContent = 'Memuat...';

        fetch(BASE_URL + 'Instansi/SetTempKodeWilayah', {
          method: 'POST',
          body: fd,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(res){ return res.text(); })
        .then(function(res){
          if (res.trim() === '1') {
            let redirectUrl = BASE_URL + 'Daerah/RanwalRKPD';
            if (instansiVal) {
              redirectUrl += '?instansi_id=' + encodeURIComponent(instansiVal);
            }
            window.location.href = redirectUrl;
          } else {
            alert(res || 'Gagal menyimpan filter wilayah!');
            btnFilter.disabled = false;
            btnFilter.innerHTML = '<i class="fa fa-search"></i> Filter';
          }
        })
        .catch(function(err){
          console.error(err);
          alert('Gagal menghubungi server!');
          btnFilter.disabled = false;
          btnFilter.innerHTML = '<i class="fa fa-search"></i> Filter';
        });
      });
    }

    <?php if (!empty($KodeWilayah)) { ?>
      const currentKodeWilayah = "<?= $KodeWilayah ?>";
      const currentProv = currentKodeWilayah.substring(0, 2);
      if (selProv) {
        selProv.value = currentProv;
        const fd = new FormData();
        fd.append('Kode', currentProv);
        fd.append(CSRF_NAME, CSRF_TOKEN);
        fetch(BASE_URL + 'Instansi/GetListKabKota', {
          method: 'POST',
          body: fd,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(res){ return res.json(); })
        .then(data => {
          let opts = '<option value="">Pilih Kab/Kota</option>';
          if (data && data.length > 0) {
            data.forEach(function(item){
              const sel = (item.Kode === currentKodeWilayah) ? 'selected' : '';
              opts += '<option value="' + esc(item.Kode) + '" ' + sel + '>' + esc(item.Nama) + '</option>';
            });
          }
          if (selKab) {
            selKab.innerHTML = opts;
            if (grpInstansi) grpInstansi.style.display = 'block';
          }
        });
      }
    <?php } ?>
  <?php } ?>

  // =========================================================================
  // FILTER INSTANSI SETELAH LOGIN SEBAGAI DAERAH
  // =========================================================================
  <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    const selFilterInstansi = document.getElementById('FilterInstansi');
    const btnFilterInstansi = document.getElementById('FilterInstansiBtn');

    if (btnFilterInstansi) {
      btnFilterInstansi.addEventListener('click', function(){
        const val = selFilterInstansi ? selFilterInstansi.value : '';
        const tahun = renjaData.tahunAktif || 2026;
        let redirectUrl = BASE_URL + 'Daerah/RanwalRKPD?tahun=' + encodeURIComponent(tahun);
        if (val) redirectUrl += '&instansi_id=' + encodeURIComponent(val);
        window.location.href = redirectUrl;
      });
    }
  <?php } ?>
});
</script>
</body>
</html>