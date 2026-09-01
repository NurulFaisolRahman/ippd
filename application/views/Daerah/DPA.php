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
    
    --ui-blue: #007bff;
    --ui-blue-light: #e7f1ff;
    --ui-orange: #f59e0b;
    --ui-orange-light: #fef3c7;
    --ui-red: #ef4444;
    --ui-red-light: #fee2e2;
    --ui-green: #10b981;
    --ui-green-light: #d1fae5;
    --ui-slate: #64748b;
    
    --ui-text-black: #000000;
    --ui-text-main: #0f172a;
    --ui-text-secondary: #334155;
    --ui-text-muted: #64748b;
    
    --ui-bg: #f8fafc;
    --ui-card-bg: #ffffff;
    --ui-border: #e2e8f0;
    --ui-border-light: #f1f5f9;
    
    --th-bg: #00c292;
    --th-sub-bg: #00a87e;
    --th-color: #ffffff;
    
    --radius-sm: 4px;
    --radius-md: 6px;
    --radius-lg: 8px;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
  }

  * { box-sizing: border-box; }
  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: var(--ui-bg);
    color: var(--ui-text-main);
    margin: 0;
    padding: 0;
    font-size: 14px;
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

  .app {
    width: 100%;
    max-width: 100%;
    margin: 0;
    padding: 0;
  }

    /* ===== Top Parameter & Filter Card ===== */
    .filter-card {
      background: var(--ui-card-bg);
      border-radius: var(--radius-lg);
      border: 1px solid var(--ui-border);
      box-shadow: var(--shadow-sm);
      padding: 16px 20px;
      margin-bottom: 20px;
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
      font-size: 15px;
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
      gap: 16px;
      align-items: flex-end;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .filter-group label {
      font-size: 13.5px;
      font-weight: 700;
      color: var(--ui-text-black) !important;
      letter-spacing: 0.1px;
    }

    .form-control-custom {
      height: 38px;
      padding: 0 12px;
      font-size: 13.5px;
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

    /* ===== Page Header & Summary Card ===== */
    .page-header-card {
      background: var(--ui-card-bg);
      border-radius: var(--radius-lg);
      border: 1px solid var(--ui-border);
      box-shadow: var(--shadow-sm);
      padding: 16px 20px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .page-header-info h1 {
      font-size: 20px;
      font-weight: 800;
      color: var(--ui-text-black);
      margin: 0 0 4px;
      letter-spacing: -0.3px;
    }

    .page-header-info p {
      margin: 0;
      font-size: 13.5px;
      color: var(--ui-text-secondary);
      font-weight: 500;
    }

    .grand-total-box {
      background: var(--ui-primary-light);
      border: 1px solid var(--ui-primary-border);
      border-radius: var(--radius-md);
      padding: 10px 18px;
      min-width: 260px;
      text-align: right;
    }

    .grand-total-box .lbl {
      font-size: 11.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--ui-primary-text);
      margin-bottom: 2px;
    }

    .grand-total-box .val {
      font-size: 21px;
      font-weight: 800;
      color: #007a5a;
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
      min-width: 300px;
      max-width: 420px;
      flex: 1;
    }

    .search-box input {
      width: 100%;
      height: 38px;
      padding: 0 12px 0 36px;
      font-size: 13.5px;
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

    .btn-group-actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .btn {
      height: 38px;
      padding: 0 16px;
      border-radius: var(--radius-md);
      font-size: 13.5px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      border: 1px solid transparent;
      transition: all 0.15s ease-in-out;
      text-decoration: none;
    }

    .btn-primary {
      background: var(--ui-primary);
      color: #ffffff;
      border-color: var(--ui-primary);
    }
    .btn-primary:hover {
      background: var(--ui-primary-hover);
      border-color: var(--ui-primary-hover);
      color: #ffffff;
    }

    .btn-outline {
      background: #ffffff;
      color: var(--ui-text-black);
      border-color: var(--ui-border);
    }
    .btn-outline:hover {
      background: #f1f5f9;
      border-color: #cbd5e1;
    }

    .legend-box {
      display: flex;
      gap: 16px;
      align-items: center;
      font-size: 12.5px;
      color: var(--ui-text-secondary);
      font-weight: 500;
    }

    .legend-dot {
      width: 9px;
      height: 9px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 5px;
    }

    /* ===== Main Table Card ===== */
    .table-card {
      background: var(--ui-card-bg);
      border-radius: var(--radius-lg);
      border: 1px solid var(--ui-border);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
    }

    .table-scroll {
      overflow-x: auto;
      width: 100%;
    }

    table.dpa-table {
      width: 100%;
      min-width: 1400px;
      border-collapse: collapse;
      font-size: 13.5px;
      background: #ffffff;
    }

    table.dpa-table thead th {
      background: var(--th-bg);
      color: var(--th-color);
      font-weight: 700;
      font-size: 12.5px;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      padding: 12px 14px;
      border: 1px solid #00b084;
      text-align: left;
      white-space: nowrap;
      position: sticky;
      top: 0;
      z-index: 2;
    }

    table.dpa-table thead th.center { text-align: center; }
    table.dpa-table thead th.num { text-align: right; }

    table.dpa-table tbody td {
      padding: 10px 14px;
      border: 1px solid var(--ui-border-light);
      color: var(--ui-text-black);
      vertical-align: middle;
      font-size: 13.5px;
    }

    /* Tree row styling */
    tr.row-urusan td {
      background: #f8fafc;
      font-weight: 800;
      color: #000000;
      border-left: 4px solid var(--ui-primary);
    }

    tr.row-bidang td {
      background: #ffffff;
      font-weight: 700;
      color: #0f172a;
      border-left: 4px solid var(--ui-primary-hover);
    }

    tr.row-program td {
      background: #ffffff;
      font-weight: 700;
      color: #1e293b;
      border-left: 4px solid #64748b;
    }

    tr.row-kegiatan td {
      background: #ffffff;
      font-weight: 600;
      color: #334155;
      border-left: 4px solid #94a3b8;
    }

    tr.row-subkegiatan td {
      background: #ffffff;
      font-weight: 500;
      color: var(--ui-text-black);
      border-left: 4px solid #cbd5e1;
    }

    tr.row-subkegiatan:hover td {
      background: var(--ui-primary-light);
    }

    .font-mono {
      font-family: 'Roboto Mono', monospace;
      font-size: 13px;
    }

    /* Money cell alignment */
    .money-cell {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      font-family: 'Roboto Mono', monospace;
      font-size: 13px;
      font-weight: 600;
      color: var(--ui-text-black);
    }

    .money-cell .cur {
      font-weight: 600;
      color: #64748b;
      margin-right: 6px;
      font-size: 12px;
      user-select: none;
    }

    .money-cell .val {
      text-align: right;
      flex: 1;
      font-variant-numeric: tabular-nums;
    }

    /* Uraian with toggle button */
    .uraian-flex {
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }

    .toggle-btn {
      background: transparent;
      border: none;
      cursor: pointer;
      padding: 2px 4px;
      color: var(--ui-primary);
      font-size: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.15s;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .toggle-btn.collapsed i {
      transform: rotate(-90deg);
    }

    .status-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 6px;
      flex-shrink: 0;
      margin-top: 6px;
    }
    .status-dot.none { background: #94a3b8; }
    .status-dot.partial { background: var(--ui-orange); }
    .status-dot.full { background: var(--ui-green); }

    .btn-edit-rak {
      background: var(--ui-primary-light);
      border: 1px solid var(--ui-primary-border);
      color: var(--ui-primary-text);
      width: 32px;
      height: 32px;
      border-radius: var(--radius-sm);
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.15s;
    }

    .btn-edit-rak:hover {
      background: var(--ui-primary);
      color: #ffffff;
      border-color: var(--ui-primary);
    }

    /* Footer total */
    table.dpa-table tfoot td {
      background: #ffffff;
      padding: 12px 14px;
      border-top: 2px solid #cbd5e1;
      border-bottom: 2px solid #cbd5e1;
      font-weight: 700;
      font-size: 13.5px;
      color: var(--ui-text-black);
    }

    table.dpa-table tfoot td.label {
      text-align: center;
      font-weight: 800;
      letter-spacing: 0.5px;
      font-size: 14px;
    }

    /* ===== Modal Edit RAK ===== */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(3px);
      display: none;
      align-items: flex-start;
      justify-content: center;
      padding: 85px 16px 40px;
      z-index: 999999 !important;
      overflow-y: auto;
    }

    .modal-overlay.open {
      display: flex;
    }

    .modal-container {
      background: #ffffff;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
      width: 100%;
      max-width: 1250px;
      animation: modalSlide 0.2s ease-out;
      margin: auto;
      border: 1px solid var(--ui-border);
      overflow: hidden;
    }

    @keyframes modalSlide {
      from { opacity: 0; transform: translateY(-12px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .modal-head {
      background: var(--ui-primary);
      color: #ffffff;
      padding: 16px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-head-title {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .modal-head-title i {
      font-size: 20px;
      background: rgba(255, 255, 255, 0.2);
      width: 36px;
      height: 36px;
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-head-title h2 {
      margin: 0;
      font-size: 17px;
      font-weight: 800;
      letter-spacing: 0.2px;
    }

    .modal-head-title p {
      margin: 2px 0 0;
      font-size: 12.5px;
      opacity: 0.9;
    }

    .btn-close-modal {
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #ffffff;
      padding: 6px 14px;
      border-radius: var(--radius-md);
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: background 0.15s;
    }

    .btn-close-modal:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .modal-content-body {
      padding: 20px 24px;
    }

    /* Info card inside modal */
    .info-summary-card {
      background: #f8fafc;
      border: 1px solid var(--ui-border);
      border-radius: var(--radius-md);
      padding: 16px 18px;
      margin-bottom: 20px;
    }

    .info-subkeg-title {
      font-size: 14px;
      font-weight: 700;
      color: var(--ui-text-black);
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .info-stat-grid {
      display: grid;
      grid-template-columns: 1.4fr repeat(4, 1fr);
      gap: 14px;
    }

    .stat-card-item {
      background: #ffffff;
      border: 1px solid var(--ui-border);
      border-radius: var(--radius-sm);
      padding: 10px 14px;
    }

    .stat-card-item .st-label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      color: var(--ui-text-muted);
      letter-spacing: 0.3px;
      margin-bottom: 3px;
    }

    .stat-card-item .st-value {
      font-size: 16px;
      font-weight: 800;
      font-family: 'Roboto Mono', monospace;
      color: var(--ui-text-black);
    }

    .stat-card-item.alokasi .st-value { color: var(--ui-blue); }
    .stat-card-item.rak .st-value { color: var(--ui-green); }
    .stat-card-item.selisih .st-value { color: var(--ui-red); }
    .stat-card-item.count-selisih .st-value { color: var(--ui-orange); }

    /* Rincian RAK editable table */
    .rincian-scroll-box {
      overflow-x: auto;
      border: 1px solid var(--ui-border);
      border-radius: var(--radius-md);
      max-height: 480px;
    }

    table.rincian-rak-table {
      width: 100%;
      min-width: 1560px;
      border-collapse: collapse;
      font-size: 12.5px;
    }

    table.rincian-rak-table thead th {
      position: sticky;
      top: 0;
      background: #f1f5f9;
      color: var(--ui-text-black);
      border: 1px solid #cbd5e1;
      text-align: center;
      padding: 6px 8px;
      font-weight: 700;
      font-size: 11px;
      text-transform: uppercase;
      z-index: 1;
    }

    table.rincian-rak-table thead th.group-tw {
      background: #e2e8f0;
    }

    table.rincian-rak-table tbody td {
      padding: 6px 8px;
      border: 1px solid var(--ui-border-light);
      vertical-align: middle;
      font-size: 12.5px;
    }

    .input-rupiah-box {
      display: flex;
      align-items: center;
      border: 1px solid #cbd5e1;
      border-radius: 4px;
      padding: 0 4px;
      background: #ffffff;
      width: 108px;
      height: 30px;
      transition: all 0.15s;
    }

    .input-rupiah-box:focus-within {
      border-color: var(--ui-primary);
      box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2);
    }

    .input-rupiah-box .prefix {
      font-size: 10.5px;
      font-weight: 600;
      color: #94a3b8;
      user-select: none;
    }

    .input-rupiah-box input {
      width: 100%;
      border: none;
      outline: none;
      text-align: right;
      font-family: 'Roboto Mono', monospace;
      font-size: 12px;
      font-weight: 600;
      color: var(--ui-text-black);
      background: transparent;
      padding: 0 2px;
    }

    .tip-box {
      background: #f8fafc;
      border: 1px solid var(--ui-border);
      border-radius: var(--radius-md);
      padding: 10px 14px;
      font-size: 12.5px;
      color: var(--ui-text-secondary);
      margin-top: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .modal-foot {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      padding: 16px 24px;
      border-top: 1px solid var(--ui-border);
      background: #ffffff;
    }

    @media (max-width: 992px) {
      .filter-grid { grid-template-columns: 1fr 1fr; }
      .info-stat-grid { grid-template-columns: 1fr 1fr; }
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
    <div class="filter-card" style="margin-bottom: 20px;">
      <div class="filter-header">
        <div class="filter-title">
          <i class="fa fa-filter"></i> <?= empty($IsLoggedIn) ? 'Filter Wilayah &amp; Perangkat Daerah' : 'Filter Perangkat Daerah' ?>
        </div>
      </div>
      <div class="filter-grid" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end;">
        <?php if (empty($IsLoggedIn)): ?>
          <div class="filter-group" style="flex: 1; min-width: 180px;">
            <label>Provinsi</label>
            <select id="selProvinsiTop" class="form-control-custom">
              <option value="">Pilih Provinsi</option>
              <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($provKodeCurrent) && $provKodeCurrent==$prov['Kode']) ? 'selected' : '' ?>>
                  <?= html_escape($prov['Nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div class="filter-group" style="flex: 1; min-width: 180px;">
            <label>Kabupaten / Kota</label>
            <select id="selKabKotaTop" class="form-control-custom">
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

        <div class="filter-group" id="grpInstansiTop" style="flex: 1.2; min-width: 220px; <?= (!empty($IsLoggedIn) || !empty($KodeWilayah)) ? '' : 'display:none;' ?>">
          <label>Perangkat Daerah / Instansi</label>
          <select id="selInstansiTop" class="form-control-custom">
            <option value="">-- Semua Perangkat Daerah --</option>
            <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
              <option value="<?= $ins['id'] ?>" <?= ($FilterInstansi == $ins['id']) ? 'selected' : '' ?>>
                <?= html_escape($ins['nama']) ?>
              </option>
            <?php }} ?>
          </select>
        </div>

        <div style="width: auto;">
          <button type="button" id="btnFilterWilayahTop" class="btn btn-primary" style="height: 42px;">
            <i class="fa fa-search"></i> <?= empty($IsLoggedIn) ? 'Terapkan Wilayah' : 'Terapkan Filter' ?>
          </button>
        </div>
      </div>
    </div>
  <?php } ?>

  <!-- Parameter & Filter Card -->
  <div class="filter-card">
    <div class="filter-header">
      <div class="filter-title">
        <i class="fa fa-filter"></i> Parameter & Filter DPA
      </div>
      <div class="legend-box">
        <span><span class="legend-dot" style="background:#94a3b8;"></span>Belum direncanakan</span>
        <span><span class="legend-dot" style="background:var(--ui-orange);"></span>Sebagian RAK</span>
        <span><span class="legend-dot" style="background:var(--ui-green);"></span>RAK penuh</span>
      </div>
    </div>
    
    <div class="filter-grid">
      <div class="filter-group">
        <label for="ctxTahun">Tahun Anggaran</label>
        <select id="ctxTahun" class="form-control-custom">
          <?php foreach ($ListTahun as $thn): ?>
            <option value="<?= $thn ?>" <?= ($thn == $TahunAktif) ? 'selected' : '' ?>><?= $thn ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <input type="hidden" id="ctxInstansi" value="<?= $FilterInstansi ?: $InstansiId ?>">

      <div class="filter-group">
        <label for="searchInput">Pencarian Cepat</label>
        <div class="search-box" style="min-width: 100%;">
          <i class="fa fa-search"></i>
          <input type="text" id="searchInput" placeholder="Cari kode rekening atau uraian...">
        </div>
      </div>

      <div class="btn-group-actions">
        <button class="btn btn-outline" id="expandAllBtn" title="Buka Semua Hierarki">
          <i class="fa fa-expand"></i> Perluas Semua
        </button>
        <button class="btn btn-outline" id="collapseAllBtn" title="Tutup Semua Hierarki">
          <i class="fa fa-compress"></i> Ciutkan Semua
        </button>
      </div>
    </div>
  </div>

  <!-- Page Header & Summary -->
  <div class="page-header-card">
    <div class="page-header-info">
      <h1>DPA — Dokumen Pelaksanaan Anggaran Belanja Daerah</h1>
      <p>Hierarki: Urusan &rarr; Bidang Urusan &rarr; Program &rarr; Kegiatan &rarr; Sub Kegiatan &rarr; Rencana Anggaran Kas (RAK)</p>
    </div>
    <div class="grand-total-box">
      <div class="lbl">Total Keseluruhan Anggaran</div>
      <div class="val" id="grandTotalText">Rp0,00</div>
    </div>
  </div>

  <!-- Main Hierarchical Table Card -->
  <div class="table-card">
    <div class="table-scroll">
      <table class="dpa-table">
        <thead>
          <tr>
            <th style="width: 170px;">Kode Rekening</th>
            <th style="min-width: 320px;">Uraian</th>
            <th style="width: 160px;">Sumber Dana</th>
            <th style="width: 180px;">Lokasi</th>
            <th class="num" style="width: 140px;">Belanja Operasi</th>
            <th class="num" style="width: 140px;">Belanja Modal</th>
            <th class="num" style="width: 150px;">Belanja Tdk Terduga</th>
            <th class="num" style="width: 140px;">Belanja Transfer</th>
            <th class="num" style="width: 150px;">Jumlah</th>
            <?php if (!empty($IsRole4)): ?>
              <th class="center" style="width: 90px;">Opsi Aksi</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody id="tableBody">
          <tr>
            <td colspan="<?= !empty($IsRole4) ? 10 : 9 ?>" style="text-align: center; padding: 36px; color: var(--ui-text-muted);">
              <i class="fa fa-spinner fa-spin"></i> Memuat data DPA...
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="label">JUMLAH TOTAL</td>
            <td class="num"><span class="money-cell" id="footOperasi"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <td class="num"><span class="money-cell" id="footModal"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <td class="num"><span class="money-cell" id="footTidakTerduga"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <td class="num"><span class="money-cell" id="footTransfer"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <td class="num"><span class="money-cell" id="footJumlah"><span class="cur">Rp</span><span class="val">0,00</span></span></td>
            <?php if (!empty($IsRole4)): ?>
              <td></td>
            <?php endif; ?>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

</div>

<!-- Modal Edit RAK Sub Kegiatan -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-container">
    <div class="modal-head">
      <div class="modal-head-title">
        <i class="fa fa-calculator"></i>
        <div>
          <h2>EDIT ANGGARAN KAS (RAK) SUB KEGIATAN</h2>
          <p>Alokasi Rencana Anggaran Kas per bulan (Januari s.d. Desember) dan per semester</p>
        </div>
      </div>
      <button class="btn-close-modal" id="btnCloseModal">
        <i class="fa fa-arrow-left"></i> Kembali ke Daftar
      </button>
    </div>

    <div class="modal-content-body">
      <!-- Info Sub Kegiatan & Stats -->
      <div class="info-summary-card">
        <div class="info-subkeg-title">
          <i class="fa fa-info-circle" style="color: var(--ui-primary);"></i>
          <span>Sub Kegiatan: <strong id="infoSubKegKode">-</strong> &mdash; <span id="infoSubKegNama">-</span></span>
        </div>
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px; flex-wrap:wrap;">
          <span style="font-size:12.5px; color:var(--ui-text-secondary);">
            <i class="fa fa-building" style="color:var(--ui-primary); margin-right:4px;"></i>
            Perangkat Daerah: <strong id="infoPerangkatDaerah" style="color:var(--ui-text-black);">-</strong>
          </span>
          <a href="#" id="linkBelanjaSubKegiatan" target="_blank" style="font-size:12px; color:var(--ui-primary); font-weight:600; text-decoration:none; border:1px solid var(--ui-primary-border); border-radius:4px; padding:3px 10px; display:inline-flex; align-items:center; gap:4px;">
            <i class="fa fa-external-link"></i> Lihat di Belanja Sub Kegiatan
          </a>
        </div>

        <div class="info-stat-grid">
          <div class="stat-card-item">
            <div class="st-label">Sumber Dana & Lokasi</div>
            <div style="font-size:12.5px; font-weight:600; color:var(--ui-text-black); margin-top:2px;" id="infoSumberDana">-</div>
          </div>
          <div class="stat-card-item alokasi">
            <div class="st-label">Alokasi Anggaran</div>
            <div class="st-value" id="statAlokasi">Rp0,00</div>
          </div>
          <div class="stat-card-item rak">
            <div class="st-label">Total RAK</div>
            <div class="st-value" id="statRak">Rp0,00</div>
          </div>
          <div class="stat-card-item selisih">
            <div class="st-label">Selisih</div>
            <div class="st-value" id="statSelisih">Rp0,00</div>
          </div>
          <div class="stat-card-item count-selisih">
            <div class="st-label">Rincian Belum Sesuai</div>
            <div class="st-value" id="statCountSelisih">0</div>
          </div>
        </div>
      </div>

      <!-- Editable RAK Grid -->
      <div class="rincian-scroll-box">
        <table class="rincian-rak-table">
          <thead>
            <tr>
              <th rowspan="3" style="min-width: 260px; text-align: left;">Uraian Rincian Belanja</th>
              <th rowspan="3" style="width: 125px;">Alokasi Anggaran</th>
              <th rowspan="3" style="width: 120px;">Total RAK</th>
              <th rowspan="3" style="width: 120px;">Selisih</th>
              <th colspan="6">Semester 1</th>
              <th colspan="6">Semester 2</th>
            </tr>
            <tr>
              <th colspan="3" class="group-tw">Triwulan 1</th>
              <th colspan="3">Triwulan 2</th>
              <th colspan="3" class="group-tw">Triwulan 3</th>
              <th colspan="3">Triwulan 4</th>
            </tr>
            <tr>
              <th class="group-tw">Januari</th><th class="group-tw">Februari</th><th class="group-tw">Maret</th>
              <th>April</th><th>Mei</th><th>Juni</th>
              <th class="group-tw">Juli</th><th class="group-tw">Agustus</th><th class="group-tw">September</th>
              <th>Oktober</th><th>November</th><th>Desember</th>
            </tr>
          </thead>
          <tbody id="rincianModalBody">
            <!-- Rendered via JS -->
          </tbody>
        </table>
      </div>

      <div class="tip-box">
        <i class="fa fa-lightbulb-o" style="color: var(--ui-orange); font-size: 16px;"></i>
        <span>Masukkan alokasi kas pada masing-masing bulan (dalam ribuan/rupiah). Total RAK dan selisih akan otomatis dihitung secara real-time.</span>
      </div>
    </div>

    <div class="modal-foot">
      <button class="btn btn-outline" id="btnResetModal">
        <i class="fa fa-undo"></i> Reset
      </button>
      <button class="btn btn-primary" id="btnSaveModal">
        <i class="fa fa-check"></i> Simpan Anggaran Kas (RAK)
      </button>
    </div>
  </div>
</div>
</div> <!-- .app -->
</div> <!-- .main-content -->

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
(function(){
  "use strict";

  var BaseURL = '<?= base_url() ?>';
  var controllerName = '<?= isset($ControllerName) ? $ControllerName : $this->router->fetch_class() ?>';
  var ControllerURL = BaseURL + controllerName + '/';
  var isRole4 = <?= !empty($IsRole4) ? 'true' : 'false' ?>;

  // Initial data from Controller
  var rawData = <?= json_encode(!empty($DPAData) ? $DPAData : []) ?>;

  /* ============================================================
     HELPERS & FORMATTERS
  ============================================================ */
  function esc(s){
    if(!s) return "";
    return String(s).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
  }

  function zeros(){ return new Array(12).fill(0); }
  function deepClone(o){ return JSON.parse(JSON.stringify(o)); }

  function formatMoney(n){
    if(n === undefined || n === null || isNaN(n)) n = 0;
    var formatted = Number(n).toLocaleString("id-ID", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    return '<span class="money-cell"><span class="cur">Rp</span><span class="val">' + formatted + '</span></span>';
  }

  function formatRupiahPlain(n){
    if(n === undefined || n === null || isNaN(n)) n = 0;
    return "Rp" + Number(n).toLocaleString("id-ID", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  function formatThousand(n){
    if(n === undefined || n === null || isNaN(n)) n = 0;
    return Number(n).toLocaleString("id-ID", { maximumFractionDigits: 0 });
  }

  function sum(arr){
    return arr.reduce(function(a, b){ return a + b; }, 0);
  }

  /* ============================================================
     TRANSFORM HIERARCHY & COMPUTE AGGREGATES
  ============================================================ */
  var CHILD_KEY_BY_TYPE = { urusan: "bidang", bidang: "program", program: "kegiatan", kegiatan: "subKegiatan" };
  var NEXT_TYPE = { urusan: "bidang", bidang: "program", program: "kegiatan", kegiatan: "subkegiatan" };

  function sanitizeId(kode, type){
    return type + "-" + String(kode).replace(/[^a-zA-Z0-9]/g, "");
  }

  function transform(raw, type, level){
    var nodeId;
    if(type === "subkegiatan" && raw.headerId){
      nodeId = type + "-" + raw.headerId + "-" + String(raw.kode).replace(/[^a-zA-Z0-9]/g, "");
    } else {
      nodeId = sanitizeId(raw.kode || Math.random().toString(), type);
    }
    var node = {
      id: nodeId,
      type: type,
      level: level,
      kode: raw.kode || "",
      uraian: raw.uraian || "",
      flagged: !!raw.flagged,
      sumberDana: raw.sumberDana || "",
      lokasi: raw.lokasi || "",
      children: [],
      rincian: null,
      headerId: raw.headerId || null,
      idInstansi: raw.idInstansi || null,
      perangkatDaerah: raw.perangkatDaerah || "",
      totalBelanja: raw.totalBelanja || 0
    };

    if(type === "subkegiatan"){
      node.rincian = deepClone(raw.rincian || []);
    } else {
      var rawChildKey = CHILD_KEY_BY_TYPE[type];
      var childType = NEXT_TYPE[type];
      (raw[rawChildKey] || []).forEach(function(childRaw){
        node.children.push(transform(childRaw, childType, level + 1));
      });
    }
    return node;
  }

  var roots = [];
  function buildRoots(){
    roots = (rawData || []).map(function(u){ return transform(u, "urusan", 0); });
    recomputeAll();
  }

  var CATEGORIES = ["operasi", "modal", "tidakTerduga", "transfer"];

  function computeAgg(node){
    var agg = { operasi: 0, modal: 0, tidakTerduga: 0, transfer: 0, jumlah: 0 };
    if(node.type === "subkegiatan"){
      (node.rincian || []).forEach(function(r){
        var j = r.jenis || "operasi";
        agg[j] = (agg[j] || 0) + (parseFloat(r.alokasi) || 0);
      });
    } else {
      node.children.forEach(function(child){
        var childAgg = computeAgg(child);
        CATEGORIES.forEach(function(c){ agg[c] += childAgg[c]; });
      });
    }
    agg.jumlah = CATEGORIES.reduce(function(s, c){ return s + agg[c]; }, 0);
    node.agg = agg;
    return agg;
  }

  function recomputeAll(){
    roots.forEach(computeAgg);
  }

  function planningStatus(node){
    var totalAlokasi = node.agg ? node.agg.jumlah : 0;
    var totalRak = sum((node.rincian || []).map(function(r){ return sum(r.monthly || []); }));
    if(totalRak <= 0) return "none";
    if(totalRak >= totalAlokasi) return "full";
    return "partial";
  }

  /* ============================================================
     RENDER MAIN HIERARCHICAL TABLE
  ============================================================ */
  var expandedState = {};
  var tableBody = document.getElementById("tableBody");

  function rowHtml(node, parentId){
    var indent = 14 + node.level * 18;
    var hasChildren = node.type !== "subkegiatan" && node.children.length > 0;
    var expanded = expandedState[node.id] !== false;
    var toggle = hasChildren
      ? '<button type="button" class="toggle-btn' + (expanded ? '' : ' collapsed') + '" data-id="' + node.id + '"><i class="fa fa-chevron-down"></i></button>'
      : '<span style="width:16px; display:inline-block;"></span>';

    var out = "";
    if(node.type === "subkegiatan"){
      var status = planningStatus(node);
      out += '<tr class="row-subkegiatan" id="row-' + node.id + '" data-parent="' + (parentId || "") + '">';
      out += '<td class="font-mono" style="padding-left:' + indent + 'px; color:var(--ui-primary-text); font-weight:700;">' +
               '<span class="status-dot ' + status + '"></span>' + esc(node.kode) + '</td>';
      out += '<td><div class="uraian-flex"><span style="width:0"></span><span style="font-weight:600;">' + esc(node.uraian) + '</span></div></td>';
      out += '<td style="font-size:12.5px; color:var(--ui-text-secondary);">' + esc(node.sumberDana) + '</td>';
      out += '<td style="font-size:12.5px; color:var(--ui-text-secondary);">' + esc(node.lokasi) + '</td>';
      out += '<td>' + formatMoney(node.agg.operasi) + '</td>';
      out += '<td>' + formatMoney(node.agg.modal) + '</td>';
      out += '<td>' + formatMoney(node.agg.tidakTerduga) + '</td>';
      out += '<td>' + formatMoney(node.agg.transfer) + '</td>';
      out += '<td>' + formatMoney(node.agg.jumlah) + '</td>';
      if (isRole4) {
        out += '<td class="center"><button type="button" class="btn-edit-rak" data-id="' + node.id + '" title="Edit Rencana Anggaran Kas (RAK)"><i class="fa fa-pencil"></i></button></td>';
      }
      out += '</tr>';
    } else {
      out += '<tr class="row-' + node.type + '" id="row-' + node.id + '" data-parent="' + (parentId || "") + '">';
      out += '<td class="font-mono" style="padding-left:' + indent + 'px;">' + esc(node.kode) + '</td>';
      out += '<td><div class="uraian-flex">' + toggle + '<span>' + esc(node.uraian) + '</span></div></td>';
      out += '<td style="color:#94a3b8; text-align:center;">-</td>';
      out += '<td style="color:#94a3b8; text-align:center;">-</td>';
      out += '<td>' + formatMoney(node.agg.operasi) + '</td>';
      out += '<td>' + formatMoney(node.agg.modal) + '</td>';
      out += '<td>' + formatMoney(node.agg.tidakTerduga) + '</td>';
      out += '<td>' + formatMoney(node.agg.transfer) + '</td>';
      out += '<td>' + formatMoney(node.agg.jumlah) + '</td>';
      if (isRole4) {
        out += '<td class="center"></td>';
      }
      out += '</tr>';
      node.children.forEach(function(child){ out += rowHtml(child, node.id); });
    }
    return out;
  }

  var isLoggedIn = <?= !empty($IsLoggedIn) ? 'true' : 'false' ?>;
  var hasKodeWilayah = <?= !empty($KodeWilayah) ? 'true' : 'false' ?>;

  function renderTable(){
    if(!roots || roots.length === 0){
      var emptyColspan = isRole4 ? 10 : 9;
      var emptyMsg = (!isLoggedIn && !hasKodeWilayah) ? 
        'Silakan pilih Filter Wilayah & Perangkat Daerah di atas terlebih dahulu untuk menampilkan data.' : 
        'Tidak ada data anggaran DPA untuk parameter yang dipilih.';
      tableBody.innerHTML = '<tr><td colspan="' + emptyColspan + '" style="text-align:center; padding:36px; color:var(--ui-text-muted);">' + emptyMsg + '</td></tr>';
      updateGrandTotal();
      return;
    }
    var html = "";
    roots.forEach(function(n){ html += rowHtml(n, null); });
    tableBody.innerHTML = html;
    updateVisibility();
    updateGrandTotal();
  }

  function updateGrandTotal(){
    var totOperasi = 0, totModal = 0, totTidakTerduga = 0, totTransfer = 0, totJumlah = 0;
    roots.forEach(function(r){
      totOperasi += r.agg.operasi;
      totModal += r.agg.modal;
      totTidakTerduga += r.agg.tidakTerduga;
      totTransfer += r.agg.transfer;
      totJumlah += r.agg.jumlah;
    });

    document.getElementById("grandTotalText").textContent = formatRupiahPlain(totJumlah);

    function updateFootCell(id, val){
      var el = document.getElementById(id);
      if(!el) return;
      var formatted = Number(val).toLocaleString("id-ID", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      el.innerHTML = '<span class="cur">Rp</span><span class="val">' + formatted + '</span>';
    }
    updateFootCell("footOperasi", totOperasi);
    updateFootCell("footModal", totModal);
    updateFootCell("footTidakTerduga", totTidakTerduga);
    updateFootCell("footTransfer", totTransfer);
    updateFootCell("footJumlah", totJumlah);
  }

  function updateVisibility(){
    function walk(node, visible){
      var row = document.getElementById("row-" + node.id);
      if(row) row.style.display = visible ? "" : "none";
      var expanded = expandedState[node.id] !== false;
      var childVisible = visible && expanded;
      (node.children || []).forEach(function(c){ walk(c, childVisible); });
    }
    roots.forEach(function(n){ walk(n, true); });
  }

  /* ============================================================
     NODE LOOKUP & EVENT HANDLING
  ============================================================ */
  function findNode(id, list){
    list = list || roots;
    for(var i = 0; i < list.length; i++){
      if(list[i].id === id) return list[i];
      if(list[i].children && list[i].children.length){
        var found = findNode(id, list[i].children);
        if(found) return found;
      }
    }
    return null;
  }

  tableBody.addEventListener("click", function(e){
    var toggleBtn = e.target.closest(".toggle-btn");
    if(toggleBtn){
      var id = toggleBtn.dataset.id;
      expandedState[id] = !(expandedState[id] !== false);
      toggleBtn.classList.toggle("collapsed");
      updateVisibility();
      return;
    }
    var editBtn = e.target.closest(".btn-edit-rak");
    if(editBtn){
      openEditModal(editBtn.dataset.id);
    }
  });

  document.getElementById("expandAllBtn").addEventListener("click", function(){ setAllExpanded(true); });
  document.getElementById("collapseAllBtn").addEventListener("click", function(){ setAllExpanded(false); });

  function setAllExpanded(val){
    function walk(node){
      if(node.children && node.children.length){
        expandedState[node.id] = val;
        node.children.forEach(walk);
      }
    }
    roots.forEach(walk);
    renderTable();
  }

  /* Search Filter */
  document.getElementById("searchInput").addEventListener("input", function(e){
    var q = e.target.value.trim().toLowerCase();
    if(!q){ updateVisibility(); return; }

    var visibleIds = {};
    function matches(node){
      return (node.kode || "").toLowerCase().indexOf(q) !== -1 ||
             (node.uraian || "").toLowerCase().indexOf(q) !== -1 ||
             (node.sumberDana || "").toLowerCase().indexOf(q) !== -1 ||
             (node.lokasi || "").toLowerCase().indexOf(q) !== -1;
    }
    function walk(node, ancestors){
      var chain = ancestors.concat([node.id]);
      var selfMatch = matches(node);
      var childMatch = false;
      (node.children || []).forEach(function(c){
        if(walk(c, chain)) childMatch = true;
      });
      if(selfMatch || childMatch){
        chain.forEach(function(id){ visibleIds[id] = true; });
        return true;
      }
      return false;
    }
    roots.forEach(function(r){ walk(r, []); });

    function apply(node){
      var row = document.getElementById("row-" + node.id);
      if(row) row.style.display = visibleIds[node.id] ? "" : "none";
      (node.children || []).forEach(apply);
    }
    roots.forEach(apply);
  });

  /* AJAX Load by Tahun / Instansi */
  document.getElementById("ctxTahun").addEventListener("change", loadDPAData);
  var elCtxIns = document.getElementById("ctxInstansi");
  if (elCtxIns && elCtxIns.tagName === "SELECT") {
    elCtxIns.addEventListener("change", loadDPAData);
  }

  function loadDPAData(){
    var thn = document.getElementById("ctxTahun").value;
    var inst = document.getElementById("ctxInstansi").value;

    tableBody.innerHTML = '<tr><td colspan="10" style="text-align:center; padding:36px; color:var(--ui-text-muted);"><i class="fa fa-spinner fa-spin"></i> Memuat data DPA...</td></tr>';

    $.ajax({
      url: ControllerURL + "GetDPAData",
      type: "POST",
      data: { tahun: thn, instansi: inst },
      dataType: "json",
      success: function(res){
        if(res.status === 'success'){
          rawData = res.data || [];
          buildRoots();
          renderTable();
        }
      },
      error: function(){
        tableBody.innerHTML = '<tr><td colspan="10" style="text-align:center; padding:36px; color:var(--ui-red);">Gagal memuat data DPA dari server.</td></tr>';
      }
    });
  }

  /* ============================================================
     MODAL EDIT RAK SUB KEGIATAN
  ============================================================ */
  var modalOverlay = document.getElementById("modalOverlay");
  var rincianModalBody = document.getElementById("rincianModalBody");
  var currentNode = null;
  var currentRincian = null;

  function openEditModal(id){
    var node = findNode(id);
    if(!node || node.type !== "subkegiatan") return;
    currentNode = node;
    currentRincian = deepClone(node.rincian || []);

    document.getElementById("infoSubKegKode").textContent = node.kode;
    document.getElementById("infoSubKegNama").textContent = node.uraian;
    document.getElementById("infoSumberDana").textContent = (node.sumberDana || "-") + " | " + (node.lokasi || "-");
    document.getElementById("infoPerangkatDaerah").textContent = node.perangkatDaerah || "-";

    // Link ke halaman Belanja Sub Kegiatan
    var linkEl = document.getElementById("linkBelanjaSubKegiatan");
    var thn = document.getElementById("ctxTahun").value;
    var instVal = document.getElementById("ctxInstansi") ? document.getElementById("ctxInstansi").value : "";
    var url = BaseURL + controllerName + "/BelanjaSubKegiatan?tahun=" + thn;
    if (instVal) {
      url += "&instansi_id=" + encodeURIComponent(instVal);
    }
    linkEl.href = url;

    renderRincianModalTable();
    recalcModal();

    modalOverlay.classList.add("open");
    document.body.style.overflow = "hidden";
  }

  function closeModal(){
    modalOverlay.classList.remove("open");
    document.body.style.overflow = "";
    currentNode = null;
    currentRincian = null;
  }

  document.getElementById("btnCloseModal").addEventListener("click", closeModal);
  modalOverlay.addEventListener("click", function(e){ if(e.target === modalOverlay) closeModal(); });
  document.addEventListener("keydown", function(e){
    if(e.key === "Escape" && modalOverlay.classList.contains("open")) closeModal();
  });

  function renderRincianModalTable(){
    var html = "";
    if(!currentRincian || currentRincian.length === 0){
      html = '<tr><td colspan="16" style="text-align:center; padding:24px; color:var(--ui-text-muted);">Belum ada rincian belanja pada Sub Kegiatan ini.</td></tr>';
      rincianModalBody.innerHTML = html;
      return;
    }

    currentRincian.forEach(function(item, idx){
      var mArr = item.monthly || zeros();
      html += '<tr data-row="' + idx + '">';
      html += '<td><div style="font-weight:600; color:var(--ui-text-black);">' + esc(item.uraian) + '</div><div class="font-mono" style="font-size:11px; color:#64748b;">' + esc(item.kode) + '</div></td>';
      html += '<td data-cell="alokasi" class="font-mono" style="font-weight:700; text-align:right; color:var(--ui-blue);">' + formatRupiahPlain(item.alokasi) + '</td>';
      html += '<td data-cell="rak" class="font-mono" style="font-weight:700; text-align:right; color:var(--ui-green);">' + formatRupiahPlain(0) + '</td>';
      html += '<td data-cell="selisih" class="font-mono" style="font-weight:700; text-align:right; color:var(--ui-red);">' + formatRupiahPlain(item.alokasi) + '</td>';

      for(var m = 0; m < 12; m++){
        var val = mArr[m] || 0;
        html += '<td><div class="input-rupiah-box">' +
                  '<span class="prefix">Rp</span>' +
                  '<input type="text" inputmode="numeric" class="month-input" data-row="' + idx + '" data-month="' + m + '" value="' + formatThousand(val) + '">' +
                '</div></td>';
      }
      html += '</tr>';
    });
    rincianModalBody.innerHTML = html;
  }

  rincianModalBody.addEventListener("input", function(e){
    var input = e.target.closest(".month-input");
    if(!input) return;
    var row = parseInt(input.dataset.row, 10);
    var month = parseInt(input.dataset.month, 10);

    var digits = input.value.replace(/[^0-9]/g, "");
    digits = digits.replace(/^0+(?=\d)/, "");
    var val = digits ? parseInt(digits, 10) : 0;
    input.value = digits ? formatThousand(val) : "";

    if(!currentRincian[row].monthly) currentRincian[row].monthly = zeros();
    currentRincian[row].monthly[month] = val;
    recalcModal();
  });

  rincianModalBody.addEventListener("focus", function(e){
    var input = e.target.closest(".month-input");
    if(input) input.select();
  }, true);

  function recalcModal(){
    var totalAlokasi = 0, totalRak = 0, countSelisih = 0;
    (currentRincian || []).forEach(function(item, idx){
      var mArr = item.monthly || zeros();
      var rRak = sum(mArr);
      var alokasi = parseFloat(item.alokasi) || 0;
      var rSelisih = alokasi - rRak;

      totalAlokasi += alokasi;
      totalRak += rRak;
      if(rSelisih !== 0) countSelisih++;

      var tr = rincianModalBody.querySelector('tr[data-row="' + idx + '"]');
      if(tr){
        tr.querySelector('[data-cell="rak"]').textContent = formatRupiahPlain(rRak);
        var selCell = tr.querySelector('[data-cell="selisih"]');
        selCell.textContent = formatRupiahPlain(rSelisih);
        if(rSelisih === 0){
          selCell.style.color = "var(--ui-text-muted)";
        } else {
          selCell.style.color = "var(--ui-red)";
        }
      }
    });

    var totalSelisih = totalAlokasi - totalRak;
    document.getElementById("statAlokasi").textContent = formatRupiahPlain(totalAlokasi);
    document.getElementById("statRak").textContent = formatRupiahPlain(totalRak);
    document.getElementById("statSelisih").textContent = formatRupiahPlain(totalSelisih);
    document.getElementById("statCountSelisih").textContent = countSelisih;
  }

  document.getElementById("btnResetModal").addEventListener("click", function(){
    if(!currentNode) return;
    currentRincian = deepClone(currentNode.rincian || []);
    renderRincianModalTable();
    recalcModal();
  });

  document.getElementById("btnSaveModal").addEventListener("click", function(){
    if(!currentNode) return;
    var thn = document.getElementById("ctxTahun").value;

    $.ajax({
      url: ControllerURL + "SaveDPARak",
      type: "POST",
      data: {
        tahun: thn,
        header_id: currentNode.headerId || '',
        kode_sub_kegiatan: currentNode.kode,
        rincian: currentRincian
      },
      dataType: "json",
      success: function(res){
        if(res.status === 'success'){
          currentNode.rincian = deepClone(currentRincian);
          recomputeAll();
          renderTable();
          closeModal();

          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: res.message || 'Anggaran Kas (RAK) berhasil disimpan!',
            showConfirmButton: false,
            timer: 1800
          });
        } else {
          alert(res.message || "Gagal menyimpan RAK.");
        }
      },
      error: function(){
        alert("Terjadi kesalahan pada server saat menyimpan RAK.");
      }
    });
  });

  /* ---------------- Top Wilayah Filter (Before Login) ---------------- */
  $(function() {
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var BaseURL = '<?= base_url() ?>';
    var currentKodeWilayah = '<?= !empty($KodeWilayah) ? $KodeWilayah : "" ?>';
    var currentInstansiId = '<?= !empty($FilterInstansi) ? $FilterInstansi : (!empty($InstansiId) ? $InstansiId : "") ?>';

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

    if (currentKodeWilayah) {
      var provKode = currentKodeWilayah.substring(0, 2);
      loadKabKotaTop(provKode, currentKodeWilayah, function() {
        loadInstansiTop(currentKodeWilayah, currentInstansiId);
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

  /* ============================================================
     INITIALIZATION
  ============================================================ */
  buildRoots();
  renderTable();

})();
</script>
