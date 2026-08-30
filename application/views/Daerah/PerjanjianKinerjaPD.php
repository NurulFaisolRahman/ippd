<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
  :root {
    --brand-green: #20c997;
    --brand-dark: #169b74;
    --brand-deep: #0f6e52;
    --brand-light: #7ee3c5;
    --brand-soft: #ebfaf5;
    --brand-border: #b7eedc;
    
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

    --amber-600: #d97706;
    --amber-500: #b45309;
    --amber-50: #fefce8;
    --amber-border: #fde68a;

    --violet-600: #7c3aed;
    --violet-50: #f5f3ff;
    --blue-link: #2563eb;

    --red-600: #dc2626;
    --red-50: #fef2f2;
    --white: #ffffff;
    --radius: 10px;
    --shadow-md: 0 4px 14px rgba(32,201,151,.12);
    --shadow-lg: 0 24px 60px rgba(15,110,82,.22);
  }

  * { box-sizing: border-box; }

  .renja-wrapper {
    background: var(--slate-50);
    color: var(--slate-900);
    font-family: "Segoe UI", Inter, -apple-system, BlinkMacSystemFont, Roboto, Arial, sans-serif;
    font-size: 13.5px;
    line-height: 1.45;
    min-height: calc(100vh - 70px);
    display: flex;
    flex-direction: column;
  }

  /* ---------- Topbar (Sama persis seperti Renja) ---------- */
  .topbar {
    flex: none;
    background: #20c997;
    color: #fff;
    margin: 14px 14px 0;
    padding: 15px 22px;
    border-radius: var(--radius);
    box-shadow: 0 4px 14px rgba(32,201,151,.22);
    z-index: 30;
  }
  .topbar-row {
    display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;
  }
  .app-title {
    display: flex; flex-direction: column; gap: 2px;
  }
  .app-title h1 {
    margin: 0; font-size: 17px; font-weight: 700; letter-spacing: .2px; color: #fff;
  }
  .app-title span {
    font-size: 12px; color: rgba(255,255,255,.92); font-weight: 500;
  }
  .topbar-controls {
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
  }
  .rpjmd-select, .instansi-select {
    appearance: none;
    background: rgba(255,255,255,.22);
    color: #fff;
    border: 1px solid rgba(255,255,255,.45);
    border-radius: 8px;
    padding: 8px 30px 8px 12px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6"><path d="M0 0l5 6 5-6z" fill="white"/></svg>');
    background-repeat: no-repeat;
    background-position: right 12px center;
  }
  .rpjmd-select option, .instansi-select option { color: #0f172a; }

  .year-tabs {
    display: flex; gap: 6px; background: rgba(0,0,0,.12); padding: 4px; border-radius: 9px;
  }
  .year-tab {
    border: none; background: transparent; color: rgba(255,255,255,.9);
    padding: 7px 13px; border-radius: 6px; font-size: 12.5px; font-weight: 600; cursor: pointer;
    transition: background .15s, color .15s;
    text-decoration: none;
    display: inline-block;
  }
  .year-tab:hover { background: rgba(255,255,255,.2); color: #fff; }
  .year-tab.active { background: #ffffff; color: var(--brand-dark); font-weight: 800; box-shadow: 0 2px 8px rgba(0,0,0,.15); }

  .btn-sync {
    display: inline-flex; align-items: center; gap: 7px;
    background: #ffffff; color: #0f6e52; border: none;
    padding: 7px 14px; border-radius: 8px; font-weight: 700;
    font-size: 12.5px; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,.08);
    transition: all .15s ease-in-out;
  }
  .btn-sync:hover {
    background: #ebfaf5; color: #047857; transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,.12);
  }
  .btn-sync i { font-size: 13px; }

  /* ---------- Summary Cards (Mirip Renja) ---------- */
  .pagu-summary {
    flex: none;
    margin: 14px 14px 0;
    background: var(--white);
    border: 1px solid var(--slate-200);
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
    padding: 14px 8px;
    display: flex;
    align-items: stretch;
    flex-wrap: wrap;
  }
  .pagu-item {
    flex: 1;
    min-width: 210px;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 2px 22px;
  }
  .pagu-item + .pagu-item { border-left: 1px solid var(--slate-200); }
  .pagu-icon {
    flex: none;
    width: 38px; height: 38px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
  }
  .pagu-icon svg, .pagu-icon i { width: 19px; height: 19px; font-size: 17px; }
  .pagu-icon.icon-pagu { background: var(--brand-green); color: #fff; }
  .pagu-icon.icon-input { background: var(--brand-soft); color: var(--brand-dark); }
  .pagu-icon.icon-selisih { background: var(--slate-100); color: var(--slate-600); }
  .pagu-text { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
  .pagu-label {
    font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .4px;
    color: var(--slate-500);
  }
  .pagu-value {
    font-size: 16.5px; font-weight: 700; color: var(--slate-900);
    white-space: nowrap;
  }
  .pagu-sub { font-size: 11px; color: var(--slate-500); }

  /* ---------- Table Area ---------- */
  .table-wrap {
    flex: 1;
    overflow: auto;
    background: var(--white);
    margin: 14px;
    border-radius: var(--radius);
    border: 1px solid var(--slate-200);
    box-shadow: var(--shadow-md);
  }
  .table-renja-main {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 0;
  }
  .table-renja-main thead th {
    position: sticky; top: 0;
    background: var(--slate-100);
    color: var(--slate-700);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .3px;
    padding: 10px 12px;
    border-bottom: 1px solid var(--slate-300);
    border-right: 1px solid var(--slate-200);
    text-align: left;
    vertical-align: middle;
    z-index: 5;
    white-space: nowrap;
  }
  .table-renja-main thead th.center, .table-renja-main tbody td.center { text-align: center; }
  .table-renja-main tbody td {
    padding: 11px 12px;
    border-bottom: 1px solid var(--slate-200);
    border-right: 1px solid var(--slate-100);
    vertical-align: top;
    font-size: 12.8px;
    color: var(--slate-800);
  }
  .table-renja-main tbody tr:hover td { background: #f8fafc; }

  .nama-cell .nama { font-weight: 700; color: var(--brand-deep); font-size: 13.5px; }
  .nama-cell .nip { color: var(--slate-500); font-size: 12px; margin-top: 2px; }
  .nama-cell .jabatan { color: var(--slate-400); font-size: 12px; font-style: italic; margin-top: 2px; }

  /* Doc badges */
  .doc-badge {
    display: inline-block;
    border: 1px solid var(--brand-dark);
    color: var(--brand-dark);
    background: var(--brand-soft);
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 9px;
    border-radius: 6px;
    white-space: nowrap;
    cursor: pointer;
    transition: all .15s ease;
  }
  .doc-badge:hover { background: var(--brand-green); color: #fff; transform: translateY(-1px); box-shadow: 0 2px 6px rgba(32,201,151,.25); }
  .doc-badge-perubahan { border-color: var(--amber-500); color: var(--amber-600); background: var(--amber-50); }
  .doc-badge-perubahan:hover { background: var(--amber-600); color: #fff; }
  .doc-badge-plt { border-color: var(--blue-link); color: var(--blue-link); background: #eff6ff; }
  .doc-badge-plt:hover { background: var(--blue-link); color: #fff; }
  .dash { color: var(--slate-400); }

  /* Status Pills & Select */
  .status-pill {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 6px;
    color: #fff;
    border: none;
    white-space: nowrap;
  }
  .status-approved { background: #16a34a; }
  .status-pending { background: #ea580c; }
  .status-ditolak { background: #dc2626; }

  .select-status-level3 {
    appearance: none;
    -webkit-appearance: none;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 18px 4px 8px;
    color: #fff;
    cursor: pointer;
    border: none;
  }
  .select-status-level3.status-disetujui { background: #16a34a; }
  .select-status-level3.status-menunggu { background: #ea580c; }
  .select-status-level3.status-ditolak { background: #dc2626; }

  /* Buttons */
  .btn-aksi-pk {
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 6px; font-weight: 600; cursor: pointer; transition: all .15s ease;
    border: 1px solid transparent;
  }
  .btn-pk-outline {
    background: #fff; color: var(--brand-deep); border-color: var(--brand-border);
    padding: 4px 9px; font-size: 11.5px;
  }
  .btn-pk-outline:hover { background: var(--brand-soft); border-color: var(--brand-green); }

  /* Modal Custom Theme */
  .pk-modal-backdrop {
    position: fixed; inset: 0; background: rgba(15,110,82,.55);
    display: flex; align-items: flex-start; justify-content: center;
    padding: 4vh 16px; overflow: auto;
    z-index: 9999999;
  }
  .pk-modal-backdrop.hidden { display: none !important; }
  .pk-modal-custom {
    background: #fff; width: 100%; max-width: 820px; border-radius: 14px;
    box-shadow: var(--shadow-lg); overflow: hidden;
    animation: pkFadeDown .18s ease;
    margin: auto 0;
  }
  @keyframes pkFadeDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

  .pk-modal-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px 14px; border-bottom: 1px solid var(--slate-200);
    background: var(--brand-green); border-radius: 14px 14px 0 0;
  }
  .pk-modal-head h2 {
    margin: 0; font-size: 16px; letter-spacing: .3px; color: #fff; font-weight: 800;
  }
  .pk-modal-close-btn {
    border: none; background: rgba(255,255,255,.2); cursor: pointer; color: #fff;
    width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-size: 20px; line-height: 1;
  }
  .pk-modal-close-btn:hover { background: rgba(255,255,255,.35); }

  .pk-modal-body { padding: 22px 26px; max-height: 68vh; overflow-y: auto; }
  .pk-modal-foot {
    display: flex; justify-content: flex-end; gap: 10px;
    padding: 16px 26px 20px; border-top: 1px solid var(--slate-200); background: #fafbfc;
  }

  .pk-section-title {
    font-size: 12px; font-weight: 700; letter-spacing: .06em; color: var(--brand-deep);
    text-transform: uppercase; margin: 20px 0 10px; padding-bottom: 4px;
    border-bottom: 2px solid var(--brand-soft);
  }
  .pk-section-title:first-child { margin-top: 0; }
  .field { margin-bottom: 14px; }
  .field label {
    display: block; font-size: 12.5px; font-weight: 700; color: var(--slate-700); margin-bottom: 5px;
  }
  .field label .req { color: var(--red-600); margin-left: 2px; }
  .field input[type=text], .field input[type=search], .field select {
    width: 100%; padding: 9px 12px; border: 1px solid var(--slate-300); border-radius: 8px;
    font-size: 13px; font-family: inherit; color: var(--slate-900); background: #fff;
  }
  .field input:read-only { background: var(--slate-100); color: var(--slate-600); }
  .field input:focus, .field select:focus {
    outline: none; border-color: var(--brand-green); box-shadow: 0 0 0 3px rgba(32,201,151,.25);
  }

  .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  .row-4a { display: grid; grid-template-columns: 1.2fr 1.2fr 0.8fr auto; gap: 14px; align-items: end; }
  .divider { border: none; border-top: 1px solid var(--slate-200); margin: 18px 0; }

  /* Combo Employee */
  .combo-wrap { position: relative; }
  .combo-list {
    position: absolute; left: 0; right: 0; top: calc(100% + 4px);
    background: #fff; border: 1px solid var(--slate-200); border-radius: 8px;
    box-shadow: 0 10px 30px rgba(15,23,42,.15);
    max-height: 220px; overflow-y: auto; z-index: 9999;
  }
  .combo-list.hidden { display: none; }
  .combo-item { padding: 9px 12px; cursor: pointer; border-bottom: 1px solid var(--slate-100); }
  .combo-item:last-child { border-bottom: none; }
  .combo-item:hover, .combo-item.active { background: var(--brand-soft); }
  .combo-item .ci-nama { font-weight: 700; font-size: 13px; color: var(--brand-deep); }
  .combo-item .ci-meta { font-size: 11.5px; color: var(--slate-500); margin-top: 1px; }
  .combo-empty { padding: 14px; text-align: center; color: var(--slate-400); font-size: 12.5px; }

  .locked-banner {
    display: flex; align-items: center; gap: 10px;
    background: var(--brand-soft); border: 1px solid var(--brand-border);
    border-radius: 8px; padding: 11px 14px; margin-bottom: 16px;
  }
  .locked-banner .lb-nama { font-weight: 700; color: var(--brand-deep); font-size: 13.5px; }
  .locked-banner .lb-jab { font-size: 12px; color: var(--slate-600); }

  /* Sasaran Picker */
  .sasaran-table-wrap {
    border: 1px solid var(--slate-200); border-radius: 8px; overflow: hidden;
  }
  .sasaran-table { width: 100%; border-collapse: collapse; font-size: 12.5px; margin-bottom: 0; }
  .sasaran-table thead th {
    background: var(--slate-100); color: var(--slate-600);
    font-size: 11px; font-weight: 700; text-transform: uppercase;
    padding: 8px 12px; text-align: left; border-bottom: 1px solid var(--slate-200);
  }
  .sasaran-table tbody td { padding: 9px 12px; border-bottom: 1px solid #eef1f5; vertical-align: top; }
  .sasaran-table tbody tr:last-child td { border-bottom: none; }
  .grp-row td { background: var(--brand-soft); font-weight: 700; color: var(--brand-deep); font-size: 12px; padding: 8px 12px; }
  .grp-row.grp-l2 td { background: #fcfdfe; color: var(--slate-600); font-weight: 600; padding-left: 24px; font-size: 11.5px; }
  .sasaran-check-col { width: 34px; text-align: center; }
  .sasaran-subunit-col { width: 180px; color: var(--slate-500); font-size: 12px; }
  .sasaran-item-name { font-weight: 600; color: var(--slate-800); font-size: 12.5px; }
  .sasaran-item-label { font-size: 10.5px; color: var(--slate-400); text-transform: uppercase; letter-spacing: .04em; margin-top: 3px; }
  .sasaran-item-text { color: var(--brand-deep); font-size: 12.5px; margin-top: 1px; line-height: 1.4; font-weight: 500; }
  .detail-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 8px; padding: 2px 0 8px; }
  .detail-grid label { font-size: 10px; font-weight: 600; color: var(--slate-400); text-transform: uppercase; display: block; margin-bottom: 3px; }
  .detail-grid input, .detail-grid select { width: 100%; padding: 6px 8px; font-size: 12px; border: 1px solid var(--slate-300); border-radius: 6px; }

  /* Doc Viewer Modal */
  .docmodal { max-width: 760px; }
  .doc-tabs { display: flex; gap: 2px; border-bottom: 1px solid var(--slate-200); padding: 0 24px; background: #fbfcfe; }
  .doc-tab {
    padding: 12px 16px; font-size: 13px; font-weight: 600; color: var(--slate-500);
    border: none; background: transparent; border-bottom: 2px solid transparent; margin-bottom: -1px; cursor: pointer;
  }
  .doc-tab.active { color: var(--brand-deep); border-bottom-color: var(--brand-green); font-weight: 700; }
  .doc-paper { padding: 32px 36px; background: #fff; color: #1e293b; font-family: 'Times New Roman', Times, serif; }
  .doc-alert {
    background: #fde2e2; border: 1px solid #f3b4b4; color: #9f1c1c;
    font-size: 12px; font-weight: 600; text-align: center;
    padding: 10px 14px; border-radius: 7px; margin-bottom: 20px;
    display: flex; align-items: center; justify-content: center; gap: 12px; flex-wrap: wrap;
  }
  .doc-alert button {
    font-size: 11px; padding: 4px 10px; border-radius: 5px;
    border: 1px solid #9f1c1c; background: #fff; color: #9f1c1c; font-weight: 700; cursor: pointer;
  }
  .doc-logo { display: flex; justify-content: center; margin-bottom: 12px; }
  .doc-title { text-align: center; margin-bottom: 20px; }
  .doc-title h3 { font-size: 15px; margin: 3px 0; color: #000; letter-spacing: .01em; font-weight: 700; text-transform: uppercase; }
  .doc-body-text { font-size: 13.5px; line-height: 1.8; color: #000; margin: 14px 0; text-align: justify; }
  .doc-party { border-collapse: collapse; font-size: 13.5px; margin: 8px 0; width: 100%; }
  .doc-party td { padding: 2px 8px 2px 0; vertical-align: top; }
  .doc-signoff { display: flex; justify-content: space-between; margin-top: 36px; font-size: 13px; text-align: center; }
  .doc-sign-col { width: 46%; }
  .doc-sign-space { height: 60px; }
  .doc-sign-name { font-weight: 700; text-decoration: underline; margin-top: 2px; }
  .doc-sign-nip { font-size: 12px; color: #334155; }
  .doc-date { text-align: right; font-size: 13px; margin: 0 0 6px; }
  .doc-lampiran-table { width: 100%; border-collapse: collapse; font-size: 12px; margin: 14px 0 22px; }
  .doc-lampiran-table th { background: #f8fafc; padding: 8px 10px; border: 1px solid #cbd5e1; text-align: left; font-size: 11px; text-transform: uppercase; font-weight: 700; color: #1e293b; }
  .doc-lampiran-table td { padding: 8px 10px; border: 1px solid #cbd5e1; vertical-align: top; color: #000; }
  .doc-lampiran-table td.num { text-align: center; width: 34px; }

  /* Toast */
  .toast-custom {
    position: fixed; left: 50%; bottom: 26px; transform: translateX(-50%) translateY(10px);
    background: var(--slate-900); color: #fff;
    padding: 12px 22px; border-radius: 8px; font-size: 13px; font-weight: 600;
    box-shadow: 0 10px 30px rgba(15,23,42,.35);
    opacity: 0; transition: opacity .18s ease, transform .18s ease;
    z-index: 99999999; pointer-events: none;
  }
  .toast-custom.show { opacity: 1; transform: translateX(-50%) translateY(0); }
  .toast-custom.toast-error { background: var(--red-600); }

  @media print {
    body > *:not(#docViewerOverlay) { display: none !important; }
    #docViewerOverlay { position: static !important; background: none !important; padding: 0 !important; display: block !important; }
    #docViewerOverlay .pk-modal-custom { box-shadow: none !important; max-width: 100% !important; border: none !important; }
    #docViewerOverlay .pk-modal-head, #docViewerOverlay .doc-tabs, #docViewerOverlay .pk-modal-foot { display: none !important; }
    #docViewerOverlay .pk-modal-body { max-height: none !important; overflow: visible !important; padding: 0 !important; }
    #docPaneUtama, #docPaneLampiran { display: block !important; }
    #docPaneLampiran { page-break-before: always; }
    .doc-alert { display: none !important; }
  }
</style>

<div class="main-content">
  <div class="renja-wrapper">

    <!-- ===== FILTER WILAYAH SEBELUM LOGIN (JIKA ADA) ===== -->
    <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
      <div class="filter-card-custom" style="background:#fff; border-radius:12px; padding:16px 24px; margin:14px 14px 0; box-shadow:var(--shadow-md); border:1px solid var(--slate-200);">
        <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
          <div class="col-filter" style="flex:1; min-width:200px;">
            <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">Provinsi</label>
            <select class="form-control" id="Provinsi" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
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
            <select class="form-control" id="KabKota" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
              <option value="">Pilih Kab/Kota</option>
            </select>
          </div>

          <div class="col-filter" id="FilterInstansiGroup" style="flex:1.2; min-width:220px; <?= empty($KodeWilayah) ? 'display:none;' : '' ?>">
            <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">Perangkat Daerah / Instansi</label>
            <select class="form-control" id="FilterInstansiBeforeLogin" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
              <option value="">-- Pilih Instansi --</option>
              <?php if (!empty($ListInstansi)) { foreach ($ListInstansi as $ins) { ?>
                <option value="<?= $ins['id'] ?>" <?= ($ActiveInstansiId == $ins['id']) ? 'selected' : '' ?>>
                  <?= html_escape($ins['nama']) ?>
                </option>
              <?php }} ?>
            </select>
          </div>

          <div class="col-filter" style="width:auto;">
            <button type="button" class="btn btn-primary" id="Filter" style="height:38px; padding:0 22px; font-size:13px; background:var(--brand-green); border-color:var(--brand-green);">
              <i class="fa fa-search"></i> Filter
            </button>
          </div>
        </div>

        <?php if (!empty($KodeWilayah)) { ?>
          <div style="margin-top:14px; padding:10px 14px; background:var(--brand-soft); border-left:4px solid var(--brand-green); border-radius:6px; font-size:12.5px; color:var(--slate-700);">
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
    <?php } ?>

    <!-- ===== FILTER INSTANSI SETELAH LOGIN (NON ROLE 4) ===== -->
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
      <div class="filter-card-custom" style="background:#fff; border-radius:12px; padding:16px 24px; margin:14px 14px 0; box-shadow:var(--shadow-md); border:1px solid var(--slate-200);">
        <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
          <div class="col-filter" style="flex:1; min-width:260px;">
            <label style="font-size:12px; font-weight:600; color:var(--slate-600); margin-bottom:5px; display:block;">
              <i class="fa fa-building" style="color:var(--brand-green); margin-right:4px;"></i> Pilih Perangkat Daerah / Instansi
            </label>
            <select class="form-control" id="FilterInstansi" style="width:100%; height:38px; border-radius:8px; border:1px solid var(--slate-200); font-size:13px; padding:6px 10px;">
              <option value="">-- Semua Instansi di <?= htmlspecialchars($NamaWilayah ?: 'Daerah') ?> --</option>
              <?php foreach ($ListInstansi as $ins) { ?>
                <option value="<?= $ins['id'] ?>" <?= ($ActiveInstansiId == $ins['id']) ? 'selected' : '' ?>>
                  <?= html_escape($ins['nama']) ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-filter" style="width:auto;">
            <button type="button" class="btn btn-primary" id="FilterInstansiBtn" style="height:38px; padding:0 20px; font-size:13px; background:var(--brand-green); border-color:var(--brand-green);">
              <i class="fa fa-filter"></i> Terapkan
            </button>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- ============ TOPBAR (IDENTIK DENGAN RENJA) ============ -->
    <div class="topbar">
      <div class="topbar-row">
        <div class="app-title">
          <h1>Perjanjian Kinerja (PK) Perangkat Daerah</h1>
          <span>Daftar Perjanjian Kinerja &mdash; <b><?= html_escape($NamaInstansi ?: 'Perangkat Daerah') ?></b> &bull; <?= html_escape($NamaWilayah ?: 'Pemerintah Daerah') ?> &mdash; menampilkan Tahun <b id="activeYearLabel"><?= html_escape($TahunAktif) ?></b></span>
        </div>
        <div class="topbar-controls">
          <select id="rpjmdSelect" class="rpjmd-select">
            <option>RPJMD 2025-2029</option>
          </select>
          <div class="year-tabs" id="yearTabs">
            <?php 
            $tList = !empty($TahunList) ? $TahunList : [2025, 2026, 2027, 2028, 2029, 2030];
            foreach ($tList as $ty) {
              $active = ($ty == $TahunAktif) ? ' active' : '';
            ?>
              <a href="?tahun=<?= $ty ?><?= !empty($ActiveInstansiId) ? '&instansi_id='.$ActiveInstansiId : '' ?>" class="year-tab<?= $active ?>" data-year="<?= $ty ?>">Tahun <?= $ty ?></a>
            <?php } ?>
          </div>
          <?php if ($IsRole4) { ?>
          <button type="button" id="btnNewPk" class="btn-sync">
            <i class="fa fa-plus"></i> Buat Perjanjian Kinerja
          </button>
          <?php } ?>
        </div>
      </div>
    </div>



    <!-- ============ TABEL DAFTAR PERJANJIAN KINERJA ============ -->
    <div class="table-wrap">
      <table class="table-renja-main" id="mainPkTable">
        <thead>
          <tr>
            <th class="center" style="width:40px;">No</th>
            <?php if (!$IsRole4) { ?>
            <th>Perangkat Daerah</th>
            <?php } ?>
            <th>Nama / NIP / Jabatan</th>
            <th class="center">Eselon</th>
            <th class="center">Awal</th>
            <th class="center">Akhir</th>
            <th class="center">Definitif</th>
            <th class="center">PK Perubahan</th>
            <th class="center">PK PLT</th>
            <th class="center">Status</th>
            <th class="center" style="width:130px;">Opsi</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <?php 
          if (!empty($PerjanjianKinerja)) {
              $no = 1;
              foreach ($PerjanjianKinerja as $idx => $pk) {
                  $definitifDoc = $pk['definitif_doc_id'] ?: '';
                  $perubahanDoc = $pk['pk_perubahan_doc_id'] ?: '';
                  $pltDoc = $pk['pk_plt_doc_id'] ?: '';
                  $st = strtolower($pk['status'] ?: 'menunggu');
          ?>
          <tr data-id="<?= $pk['id'] ?>">
              <td class="center"><?= $no++ ?></td>
              <?php if (!$IsRole4) { ?>
              <td><span class="badge" style="background:#f1f5f9; color:#334155; border:1px solid #cbd5e1; font-weight:600; padding:4px 8px;"><?= htmlspecialchars($pk['nama_instansi'] ?? '-') ?></span></td>
              <?php } ?>
              <td class="nama-cell">
                  <div class="nama"><?= htmlspecialchars($pk['pengampu_nama'] ?? '') ?></div>
                  <div class="nip">NIP: <?= htmlspecialchars($pk['pengampu_nip'] ?? '-') ?></div>
                  <div class="jabatan"><?= htmlspecialchars($pk['pengampu_jabatan'] ?? '-') ?></div>
              </td>
              <td class="center"><?= htmlspecialchars($pk['eselon'] ?: '-') ?></td>
              <td class="center"><?= (int)$pk['periode_awal'] ?></td>
              <td class="center"><?= (int)$pk['periode_akhir'] ?></td>
              
              <!-- Definitif Badge -->
              <td class="center">
                  <?php if (!empty($definitifDoc)) { ?>
                      <span class="doc-badge" data-id="<?= $pk['id'] ?>" data-doctype="definitif" title="Klik untuk membuka dokumen definitif">DOC ID: <?= htmlspecialchars($definitifDoc) ?></span>
                  <?php } else { ?>
                      <span class="dash">-</span>
                  <?php } ?>
              </td>

              <!-- PK Perubahan Badge -->
              <td class="center">
                  <?php if (!empty($perubahanDoc)) { ?>
                      <span class="doc-badge doc-badge-perubahan" data-id="<?= $pk['id'] ?>" data-doctype="perubahan" title="Klik untuk membuka dokumen perubahan">DOC ID: <?= htmlspecialchars($perubahanDoc) ?></span>
                  <?php } else { ?>
                      <span class="dash">-</span>
                  <?php } ?>
              </td>

              <!-- PK PLT Badge -->
              <td class="center">
                  <?php if (!empty($pltDoc)) { ?>
                      <span class="doc-badge doc-badge-plt" data-id="<?= $pk['id'] ?>" data-doctype="plt" title="Klik untuk membuka dokumen PLT">DOC ID: <?= htmlspecialchars($pltDoc) ?></span>
                  <?php } else { ?>
                      <span class="dash">-</span>
                  <?php } ?>
              </td>

              <!-- Status -->
              <td class="center">
                  <?php if ($IsRole3) { ?>
                      <select class="select-status-level3 status-<?= $st ?>" data-id="<?= $pk['id'] ?>" data-doctype="definitif" data-prev="<?= $st ?>">
                          <option value="menunggu" <?= ($st == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                          <option value="disetujui" <?= ($st == 'disetujui') ? 'selected' : '' ?>>Disetujui</option>
                          <option value="ditolak" <?= ($st == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                      </select>
                  <?php } else { ?>
                      <span class="status-pill status-<?= ($st == 'disetujui') ? 'approved' : (($st == 'ditolak') ? 'ditolak' : 'pending') ?>">
                          <?= ucfirst($st) ?>
                      </span>
                  <?php } ?>
              </td>

              <!-- Opsi -->
              <td class="center" style="white-space:nowrap;">
                  <?php if ($IsRole4) { ?>
                  <button class="btn btn-xs btn-pk-outline btn-tambah-pk-row" data-id="<?= $pk['id'] ?>" title="Tambah PK Perubahan atau PLT">+ PK</button>
                  <button class="btn btn-xs btn-primary btn-edit-pk-row" data-id="<?= $pk['id'] ?>" title="Edit Data" style="padding:4px 7px; border-radius:5px; background:var(--brand-dark); border-color:var(--brand-dark);"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-xs btn-danger btn-hapus-pk-row" data-id="<?= $pk['id'] ?>" title="Hapus Data" style="padding:4px 7px; border-radius:5px;"><i class="fa fa-trash"></i></button>
                  <?php } ?>
              </td>
          </tr>
          <?php }
          } else { ?>
          <tr><td colspan="<?= $IsRole4 ? '10' : '11' ?>" style="text-align:center; padding:40px 20px; color:var(--slate-400);">Belum ada perjanjian kinerja pada Tahun <?= html_escape($TahunAktif) ?>. Klik "+ Buat Perjanjian Kinerja" untuk menambahkan.</td></tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div> <!-- /.renja-wrapper -->
</div>

<!-- ================================================================ -->
<!-- MODAL FORM INPUT PERJANJIAN KINERJA (TANPA UPLOAD FILE)          -->
<!-- ================================================================ -->
<div class="pk-modal-backdrop hidden" id="modalOverlay">
  <div class="pk-modal-custom">
    <div class="pk-modal-head">
      <h2 id="modalTitle">DRAFT PERJANJIAN KINERJA (PK)</h2>
      <button type="button" class="pk-modal-close-btn" id="btnCloseModal">&times;</button>
    </div>

    <div class="pk-modal-body">
      <input type="hidden" id="formPkId" value="">
      <input type="hidden" id="formEmployeeId" value="">
      <input type="hidden" id="formAtasanId" value="">

      <!-- STEP 1: Pegawai Pengampu -->
      <div id="pegawaiPicker">
        <div class="pk-section-title">1. Pegawai Pengampu</div>
        <div class="field">
          <label>Pilih Pegawai Pengampu <span class="req">*</span></label>
          <div class="combo-wrap">
            <input type="text" id="pegawaiInput" placeholder="Pilih atau ketik nama pegawai pengampu" autocomplete="off">
            <div class="combo-list hidden" id="pegawaiList"></div>
          </div>
        </div>
      </div>

      <div id="pegawaiLocked" class="locked-banner" style="display:none;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 15a3 3 0 100-6 3 3 0 000 6z" stroke="#169b74" stroke-width="1.8"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="#169b74" stroke-width="1.2"/></svg>
        <div>
          <div class="lb-nama" id="lockedNama">-</div>
          <div class="lb-jab" id="lockedJabatan">-</div>
        </div>
      </div>

      <div class="field">
        <div style="display:flex; gap:8px;">
          <div style="flex:1;">
            <label>NIP Pengampu</label>
            <input type="text" id="nipPengampu" placeholder="Masukkan NIP pengampu">
          </div>
          <button type="button" class="btn btn-primary" id="btnCekNip" style="align-self:flex-end; height:38px; background:var(--brand-green); border-color:var(--brand-green); font-weight:700;">Cek</button>
        </div>
      </div>

      <div class="row-2">
        <div class="field">
          <label>Nama Pengampu</label>
          <input type="text" id="namaPengampu" readonly placeholder="Nama pengampu">
        </div>
        <div class="field">
          <label>Jabatan Pengampu</label>
          <input type="text" id="jabatanPengampu" readonly placeholder="Jabatan pengampu">
        </div>
      </div>
      <div class="field">
        <label>Satuan Unit Kerja</label>
        <input type="text" id="satuanUnitKerja" readonly placeholder="Satuan unit kerja">
      </div>

      <hr class="divider">

      <div class="row-2">
        <div class="field">
          <label>Atasan Langsung</label>
          <input type="text" id="atasanLangsung" readonly placeholder="Atasan langsung">
        </div>
        <div class="field">
          <label>NIP Atasan Langsung</label>
          <input type="text" id="nipAtasan" readonly placeholder="NIP atasan langsung">
        </div>
      </div>
      <div class="row-2">
        <div class="field">
          <label>Jabatan Atasan Langsung</label>
          <input type="text" id="jabatanAtasan" readonly placeholder="Jabatan atasan langsung">
        </div>
        <div class="field">
          <label>Satuan Unit Kerja Atasan</label>
          <input type="text" id="satuanUnitKerjaAtasan" readonly placeholder="Satuan unit kerja atasan">
        </div>
      </div>

      <!-- STEP 2: Ketentuan Perjanjian -->
      <div class="pk-section-title">2. Ketentuan Perjanjian</div>
      <div class="row-4a">
        <div class="field" style="margin-bottom:0;">
          <label>Jenis Perjanjian <span class="req">*</span></label>
          <select id="jenisPerjanjian">
            <option value="">Pilih jenis perjanjian</option>
            <option value="PK MURNI">PK MURNI</option>
            <option value="PK PERUBAHAN">PK PERUBAHAN</option>
            <option value="PK PLT">PK PLT</option>
          </select>
        </div>
        <div class="field" style="margin-bottom:0;">
          <label>Sasaran Perjanjian <span class="req">*</span></label>
          <select id="sasaranPerjanjian">
            <option value="">Pilih sasaran perjanjian</option>
            <option value="program">Program</option>
            <option value="kegiatan">Kegiatan</option>
            <option value="subkegiatan">Sub Kegiatan</option>
          </select>
        </div>
        <div></div>
        <div class="field" style="margin-bottom:8px; display:flex; align-items:center; gap:8px;">
          <input type="checkbox" id="anggaranCheck" checked style="width:17px; height:17px; cursor:pointer;">
          <label style="margin:0; cursor:pointer;" for="anggaranCheck">Anggaran</label>
        </div>
      </div>
      
      <div class="row-2" style="margin-top:14px;">
        <div class="field">
          <label>Periode Awal <span class="req">*</span></label>
          <select id="periodeAwal">
            <option value="">Pilih periode awal</option>
          </select>
        </div>
        <div class="field">
          <label>Periode Akhir <span class="req">*</span></label>
          <select id="periodeAkhir">
            <option value="">Pilih periode akhir</option>
          </select>
        </div>
      </div>

      <!-- STEP 3: Sasaran yang Diperjanjikan -->
      <div class="pk-section-title">3. Sasaran Program / Kegiatan / Sub Kegiatan yang Diperjanjikan</div>
      <div id="sasaranSection">
        <div style="margin-bottom:10px;">
          <input type="search" id="sasaranSearch" placeholder="Cari sasaran, program, kegiatan, atau sub kegiatan...">
        </div>
        <div class="sasaran-table-wrap">
          <table class="sasaran-table">
            <thead>
              <tr>
                <th class="sasaran-check-col"></th>
                <th>Sasaran Program / Kegiatan / Sub Kegiatan (Yang Diperjanjikan)</th>
                <th class="sasaran-subunit-col">Sub Unit</th>
              </tr>
            </thead>
            <tbody id="sasaranBody">
              <tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-400);">Pilih "Sasaran Perjanjian" (Program / Kegiatan / Sub Kegiatan) terlebih dahulu untuk memuat data.</td></tr>
            </tbody>
          </table>
        </div>
        <p id="selectedCount" style="font-size:12px; color:var(--slate-500); margin-top:8px;">Belum ada sasaran dipilih.</p>

        <!-- Rincian Anggaran -->
        <div id="anggaranSection" style="display:none;">
          <div style="margin:16px 0 8px; font-weight:700; font-size:12.5px; color:var(--slate-700);">Rincian Anggaran yang Diperjanjikan</div>
          <div class="sasaran-table-wrap">
            <table class="sasaran-table">
              <thead>
                <tr>
                  <th>Program / Kegiatan / Sub Kegiatan</th>
                  <th style="width:180px;">Anggaran (Rp)</th>
                  <th style="width:140px;">Sumber Dana</th>
                </tr>
              </thead>
              <tbody id="anggaranBody"></tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

    <div class="pk-modal-foot">
      <button type="button" class="btn btn-default" id="btnBatal" style="font-weight:600;">Batal</button>
      <button type="button" class="btn btn-primary" id="btnSimpan" style="background:var(--brand-green); border-color:var(--brand-green); font-weight:700;">
        <i class="fa fa-save"></i> Simpan Perjanjian
      </button>
    </div>
  </div>
</div>

<!-- ================================================================ -->
<!-- MODAL POPUP DOKUMEN PK VIEWER RESMI & PRINT (2 SLIDE/TABS)        -->
<!-- ================================================================ -->
<div class="pk-modal-backdrop hidden" id="docViewerOverlay">
  <div class="pk-modal-custom docmodal">
    <div class="pk-modal-head">
      <h2><i class="fa fa-file-text-o" style="color:#fff; margin-right:6px;"></i> Dokumen Perjanjian Kinerja</h2>
      <button type="button" class="pk-modal-close-btn" id="btnCloseDocViewer">&times;</button>
    </div>
    <div class="doc-tabs">
      <button type="button" class="doc-tab active" id="tabUtama">Halaman Utama</button>
      <button type="button" class="doc-tab" id="tabLampiran">Lampiran</button>
    </div>
    <div class="pk-modal-body" style="padding:0; max-height:66vh; background:#f8fafc;">
      <div id="docPrintArea">
        <div class="doc-paper" id="docPaneUtama"></div>
        <div class="doc-paper" id="docPaneLampiran" style="display:none;"></div>
      </div>
    </div>
    <div class="pk-modal-foot" style="justify-content:space-between;">
      <div>
        <?php if ($IsRole4) { ?>
        <button type="button" class="btn btn-danger" style="font-size:12.5px; font-weight:600;" id="btnHapusDokumen">
          <i class="fa fa-trash"></i> Hapus Dokumen
        </button>
        <?php } ?>
      </div>
      <div style="display:flex; gap:10px;">
        <button type="button" class="btn btn-default" id="btnCloseDocViewerFooter" style="font-weight:600;">Tutup</button>
        <button type="button" class="btn btn-success" id="btnPrintDokumen" style="font-weight:700;">
          <i class="fa fa-print"></i> Print Dokumen
        </button>
      </div>
    </div>
  </div>
</div>

<div class="toast-custom" id="pkToast"></div>

<!-- ================================================================ -->
<!-- JAVASCRIPT LOGIC DOKUMEN & FORM PERJANJIAN KINERJA               -->
<!-- ================================================================ -->
<script>
(function(){
  "use strict";

  var BaseURL   = "<?= base_url() ?>";
  var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
  var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
  var CURRENT_TAHUN = "<?= !empty($TahunAktif) ? html_escape($TahunAktif) : date('Y') ?>";
  var CURRENT_ORG_NAME = "<?= !empty($NamaInstansi) ? addslashes(strtoupper($NamaInstansi)) : 'DINAS PERANGKAT DAERAH' ?>";
  var CURRENT_ORG_CITY = "<?= !empty($NamaWilayah) ? addslashes(strtoupper($NamaWilayah)) : 'PEMERINTAH DAERAH' ?>";
  var CURRENT_ORG_CITY_LABEL = "<?= !empty($NamaWilayah) ? addslashes($NamaWilayah) : 'Daerah' ?>";

  var MONTHS = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

  var LOGO_IMG_URL = "<?= base_url('assets/img/logo_kab_cirebon.png') ?>";
  var LOGO_IMG_FALLBACK = "https://upload.wikimedia.org/wikipedia/commons/c/c3/Lambang_Kabupaten_Cirebon.gif";
  var LOGO_HTML = '<img src="' + LOGO_IMG_URL + '" onerror="this.onerror=null; this.src=\'' + LOGO_IMG_FALLBACK + '\';" alt="Logo Kabupaten Cirebon" style="max-height:80px; width:auto; object-fit:contain; display:block; margin:0 auto;">';

  /* ============ DAFTAR PEGAWAI DARI DATABASE ============ */
  var employees = <?= json_encode(array_map(function($p) {
      return [
          'id' => (int)$p['id'],
          'nip' => $p['nip'] ?? '',
          'nama' => $p['nama'] ?? '',
          'jabatan' => $p['jabatan'] ?? '',
          'eselon' => $p['eselon'] ?? '-',
          'satuanUnitKerja' => $p['satuan_unit_kerja'] ?? ''
      ];
  }, $PegawaiList ?? [])) ?>;

  function findByNip(nip){
    nip = (nip || "").trim();
    for (var i=0; i<employees.length; i++){
      if (employees[i].nip === nip) return employees[i];
    }
    return null;
  }

  function findById(id){
    for (var i=0; i<employees.length; i++){
      if (employees[i].id === id) return employees[i];
    }
    return null;
  }

  function defaultAtasanOf(emp){
    if (!emp) return null;
    for (var i=0; i<employees.length; i++){
      if (employees[i].id !== emp.id && (employees[i].eselon.indexOf('II') > -1 || employees[i].eselon.indexOf('III') > -1 || employees[i].jabatan.toLowerCase().indexOf('kepala') > -1)) {
        return employees[i];
      }
    }
    for (var j=0; j<employees.length; j++){
      if (employees[j].id !== emp.id) return employees[j];
    }
    return null;
  }

  function escapeHtml(s){
    return String(s == null ? "" : s).replace(/[&<>"']/g, function(c){
      return { "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;", "'":"&#39;" }[c];
    });
  }
  function monthLabel(n){ return n ? MONTHS[n-1] : "-"; }
  function showToast(msg, isError){
    var t = document.getElementById("pkToast");
    t.textContent = msg;
    t.className = "toast-custom show" + (isError ? " toast-error" : "");
    clearTimeout(showToast._tm);
    showToast._tm = setTimeout(function(){ t.className = "toast-custom"; }, 3000);
  }

  /* ============ MODAL STATE ============ */
  var modalOverlay = document.getElementById("modalOverlay");
  var modalTitle = document.getElementById("modalTitle");
  var pegawaiPicker = document.getElementById("pegawaiPicker");
  var pegawaiLocked = document.getElementById("pegawaiLocked");
  var pegawaiInput = document.getElementById("pegawaiInput");
  var pegawaiList = document.getElementById("pegawaiList");
  var nipPengampu = document.getElementById("nipPengampu");
  var namaPengampu = document.getElementById("namaPengampu");
  var jabatanPengampu = document.getElementById("jabatanPengampu");
  var satuanUnitKerja = document.getElementById("satuanUnitKerja");
  var atasanLangsung = document.getElementById("atasanLangsung");
  var nipAtasan = document.getElementById("nipAtasan");
  var jabatanAtasan = document.getElementById("jabatanAtasan");
  var satuanUnitKerjaAtasan = document.getElementById("satuanUnitKerjaAtasan");
  var jenisPerjanjianSel = document.getElementById("jenisPerjanjian");
  var sasaranPerjanjianSel = document.getElementById("sasaranPerjanjian");
  var periodeAwalSel = document.getElementById("periodeAwal");
  var periodeAkhirSel = document.getElementById("periodeAkhir");
  var anggaranCheck = document.getElementById("anggaranCheck");
  var sasaranBody = document.getElementById("sasaranBody");
  var sasaranSearch = document.getElementById("sasaranSearch");
  var selectedCountEl = document.getElementById("selectedCount");
  var anggaranSection = document.getElementById("anggaranSection");
  var anggaranBody = document.getElementById("anggaranBody");
  var formPkId = document.getElementById("formPkId");
  var formEmployeeId = document.getElementById("formEmployeeId");
  var formAtasanId = document.getElementById("formAtasanId");

  var modalState = {
    mode: "new",       // 'new' | 'addpk' | 'edit'
    pkId: null,
    selectedEmployee: null,
    selectedAtasan: null,
    checkedSasaran: {},   // key -> {name, text, subUnit, indikator, satuan, target}
    anggaranByProgram: {}, // progId -> {anggaran, sumberDana}
    loadedData: []
  };

  MONTHS.forEach(function(m, i){
    var v = i + 1;
    periodeAwalSel.insertAdjacentHTML("beforeend", '<option value="' + v + '"' + (v===1?' selected':'') + '>' + m + "</option>");
    periodeAkhirSel.insertAdjacentHTML("beforeend", '<option value="' + v + '"' + (v===12?' selected':'') + '>' + m + "</option>");
  });

  function resetModalFields(){
    formPkId.value = "";
    formEmployeeId.value = "";
    formAtasanId.value = "";
    pegawaiInput.value = "";
    nipPengampu.value = "";
    namaPengampu.value = "";
    jabatanPengampu.value = "";
    satuanUnitKerja.value = "";
    atasanLangsung.value = "";
    nipAtasan.value = "";
    jabatanAtasan.value = "";
    satuanUnitKerjaAtasan.value = "";
    [namaPengampu, jabatanPengampu, satuanUnitKerja].forEach(function(el){ el.removeAttribute("readonly"); el.setAttribute("readonly","true"); });
    jenisPerjanjianSel.innerHTML = '<option value="">Pilih jenis perjanjian</option><option value="PK MURNI" selected>PK MURNI</option><option value="PK PERUBAHAN">PK PERUBAHAN</option><option value="PK PLT">PK PLT</option>';
    jenisPerjanjianSel.value = "PK MURNI";
    sasaranPerjanjianSel.value = "";
    periodeAwalSel.value = "1";
    periodeAkhirSel.value = "12";
    anggaranCheck.checked = true;
    sasaranSearch.value = "";
    modalState.selectedEmployee = null;
    modalState.selectedAtasan = null;
    modalState.checkedSasaran = {};
    modalState.anggaranByProgram = {};
    modalState.loadedData = [];
    sasaranBody.innerHTML = '<tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-400);">Pilih "Sasaran Perjanjian" (Program / Kegiatan / Sub Kegiatan) terlebih dahulu untuk memuat data.</td></tr>';
    updateSelectedCount();
    renderAnggaranSection();
    pegawaiList.classList.add("hidden");
  }

  function applyEmployee(emp){
    if (!emp) return;
    modalState.selectedEmployee = emp;
    formEmployeeId.value = emp.id;
    nipPengampu.value = emp.nip;
    namaPengampu.value = emp.nama;
    jabatanPengampu.value = emp.jabatan;
    satuanUnitKerja.value = emp.satuanUnitKerja;
    pegawaiInput.value = emp.nama;

    var atasan = defaultAtasanOf(emp);
    if (atasan){
      modalState.selectedAtasan = atasan;
      formAtasanId.value = atasan.id;
      atasanLangsung.value = atasan.nama;
      nipAtasan.value = atasan.nip;
      jabatanAtasan.value = atasan.jabatan;
      satuanUnitKerjaAtasan.value = atasan.satuanUnitKerja;
    } else {
      modalState.selectedAtasan = null;
      formAtasanId.value = "";
      atasanLangsung.value = "Bupati / Wali Kota";
      nipAtasan.value = "-";
      jabatanAtasan.value = "Kepala Daerah";
      satuanUnitKerjaAtasan.value = CURRENT_ORG_CITY_LABEL;
    }
    pegawaiList.classList.add("hidden");
  }

  function openModal(mode, pkId){
    modalState.mode = mode;
    modalState.pkId = pkId || null;
    resetModalFields();

    if (mode === "new"){
      modalTitle.textContent = "DRAFT PERJANJIAN KINERJA (PK)";
      pegawaiPicker.style.display = "block";
      pegawaiLocked.style.display = "none";
      nipPengampu.removeAttribute("readonly");
      modalOverlay.classList.remove("hidden");
      document.body.style.overflow = "hidden";
    } else if (mode === "addpk"){
      modalTitle.textContent = "TAMBAH PK PERUBAHAN / PLT";
      pegawaiPicker.style.display = "none";
      pegawaiLocked.style.display = "flex";
      nipPengampu.setAttribute("readonly","true");
      jenisPerjanjianSel.innerHTML = '<option value="">Pilih jenis perjanjian</option><option value="PK PERUBAHAN" selected>PK PERUBAHAN</option><option value="PK PLT">PK PLT</option>';
      jenisPerjanjianSel.value = "PK PERUBAHAN";
      formPkId.value = pkId;

      $.ajax({
        url: BaseURL + "Instansi/getPerjanjianKinerja",
        type: "POST",
        data: { id: pkId, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res){
          if (res.status === 'success'){
            var d = res.data;
            var emp = findById(parseInt(d.pegawai_pengampu_id, 10)) || {
              id: d.pegawai_pengampu_id, nip: d.pengampu_nip, nama: d.pengampu_nama, jabatan: d.pengampu_jabatan, eselon: d.pengampu_eselon, satuanUnitKerja: d.pengampu_satuan
            };
            document.getElementById("lockedNama").textContent = emp.nama;
            document.getElementById("lockedJabatan").textContent = emp.jabatan + (d.pengampu_eselon ? ' · Eselon ' + d.pengampu_eselon : '');
            applyEmployee(emp);
            if (d.atasan_langsung_id) {
              formAtasanId.value = d.atasan_langsung_id;
              atasanLangsung.value = d.atasan_nama;
              nipAtasan.value = d.atasan_nip;
              jabatanAtasan.value = d.atasan_jabatan;
              satuanUnitKerjaAtasan.value = d.atasan_satuan;
            }
            modalOverlay.classList.remove("hidden");
            document.body.style.overflow = "hidden";
          } else {
            showToast("Gagal memuat data perjanjian", true);
          }
        },
        error: function(){ showToast("Terjadi kesalahan koneksi", true); }
      });
    } else if (mode === "edit"){
      modalTitle.textContent = "EDIT PERJANJIAN KINERJA";
      pegawaiPicker.style.display = "block";
      pegawaiLocked.style.display = "none";
      formPkId.value = pkId;

      $.ajax({
        url: BaseURL + "Instansi/getPerjanjianKinerja",
        type: "POST",
        data: { id: pkId, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res){
          if (res.status === 'success'){
            var d = res.data;
            var emp = findById(parseInt(d.pegawai_pengampu_id, 10)) || {
              id: d.pegawai_pengampu_id, nip: d.pengampu_nip, nama: d.pengampu_nama, jabatan: d.pengampu_jabatan, eselon: d.pengampu_eselon, satuanUnitKerja: d.pengampu_satuan
            };
            applyEmployee(emp);
            if (d.jenis_perjanjian) {
              var jp = d.jenis_perjanjian.toUpperCase();
              jenisPerjanjianSel.value = jp;
            }
            if (d.periode_awal) periodeAwalSel.value = d.periode_awal;
            if (d.periode_akhir) periodeAkhirSel.value = d.periode_akhir;
            anggaranCheck.checked = (d.anggaran == 1);
            if (d.sasaran_level) {
              sasaranPerjanjianSel.value = d.sasaran_level;
              loadSasaranList(d.sasaran_level, function(){
                var parsedData = null;
                try {
                  var raw = d.sasaran_data || d.pk_perubahan_data || d.pk_plt_data;
                  if (raw) parsedData = JSON.parse(raw);
                } catch(e){}
                if (parsedData && parsedData.sasaranList) {
                  parsedData.sasaranList.forEach(function(s, idx){
                    modalState.checkedSasaran["s_" + idx] = {
                      text: s.sasaran,
                      indikator: s.indikator,
                      satuan: s.satuan,
                      target: s.target,
                      subUnit: s.subUnit || ''
                    };
                  });
                  if (parsedData.anggaranList) {
                    parsedData.anggaranList.forEach(function(a, idx){
                      modalState.anggaranByProgram["p_" + idx] = { anggaran: a.anggaran, sumberDana: a.sumberDana };
                    });
                  }
                  renderSasaranBody();
                  renderAnggaranSection();
                }
              });
            }
            modalOverlay.classList.remove("hidden");
            document.body.style.overflow = "hidden";
          }
        }
      });
    }
  }

  function closeModal(){
    modalOverlay.classList.add("hidden");
    document.body.style.overflow = "";
  }

  var btnNewPkEl = document.getElementById("btnNewPk");
  if (btnNewPkEl) btnNewPkEl.addEventListener("click", function(){ openModal("new"); });
  document.getElementById("btnCloseModal").addEventListener("click", closeModal);
  document.getElementById("btnBatal").addEventListener("click", closeModal);
  modalOverlay.addEventListener("click", function(ev){ if (ev.target === modalOverlay) closeModal(); });

  /* ---------- Combobox Pegawai ---------- */
  function renderPegawaiList(query){
    var q = (query || "").trim().toLowerCase();
    var matches = employees.filter(function(emp){
      if (!q) return true;
      return emp.nama.toLowerCase().indexOf(q) > -1 ||
             emp.jabatan.toLowerCase().indexOf(q) > -1 ||
             emp.nip.indexOf(q) > -1;
    });
    if (matches.length === 0){
      pegawaiList.innerHTML = '<div class="combo-empty">Pegawai tidak ditemukan</div>';
    } else {
      pegawaiList.innerHTML = matches.map(function(emp){
        return '<div class="combo-item" data-nip="' + escapeHtml(emp.nip) + '">' +
          '<div class="ci-nama">' + escapeHtml(emp.nama) + '</div>' +
          '<div class="ci-meta">' + escapeHtml(emp.jabatan) + ' · Eselon ' + escapeHtml(emp.eselon) + '</div>' +
        '</div>';
      }).join("");
    }
    pegawaiList.classList.remove("hidden");
  }

  pegawaiInput.addEventListener("focus", function(){ renderPegawaiList(pegawaiInput.value); });
  pegawaiInput.addEventListener("input", function(){ renderPegawaiList(pegawaiInput.value); });
  pegawaiList.addEventListener("click", function(ev){
    var item = ev.target.closest(".combo-item");
    if (!item) return;
    var emp = findByNip(item.getAttribute("data-nip"));
    if (emp) applyEmployee(emp);
  });
  document.addEventListener("click", function(ev){
    if (!ev.target.closest(".combo-wrap")) pegawaiList.classList.add("hidden");
  });

  document.getElementById("btnCekNip").addEventListener("click", function(){
    var nip = nipPengampu.value.trim();
    if (!nip){ showToast("Masukkan NIP terlebih dahulu.", true); return; }
    var emp = findByNip(nip);
    if (!emp){ showToast("NIP tidak ditemukan pada daftar kepegawaian.", true); return; }
    applyEmployee(emp);
    showToast("Data pegawai ditemukan dan berhasil dimuat.");
  });

  /* ---------- Sasaran Picker & AJAX Loader ---------- */
  function sasaranLabelFor(level){
    if (level === "program") return "Sasaran Program";
    if (level === "kegiatan") return "Sasaran Kegiatan";
    return "Sasaran Sub Kegiatan";
  }

  function satuanOptions(selected){
    var opts = ["%","Dokumen","Unit","Orang","Kali","Nilai","Rp","Laporan","Paket"];
    var sel = selected || "%";
    return opts.map(function(o){ return '<option value="' + o + '"' + (o === sel ? " selected" : "") + '>' + o + '</option>'; }).join("");
  }

  function checkboxRow(key, nameLine, sasaranText, subUnit, level, defaultInd, defaultSat, defaultTgt, progId, progName){
    var existing = modalState.checkedSasaran[key];
    var checked = existing ? "checked" : "";
    var d = existing || {
      name: nameLine,
      text: sasaranText,
      subUnit: subUnit,
      indikator: defaultInd || "",
      satuan: defaultSat || "%",
      target: defaultTgt || "",
      progId: progId || "",
      progName: progName || ""
    };

    var mainRow = '<tr data-key="' + key + '">' +
      '<td class="sasaran-check-col"><input type="checkbox" data-key="' + key + '" data-name="' + escapeHtml(nameLine) + '" data-text="' + escapeHtml(sasaranText) + '" data-subunit="' + escapeHtml(subUnit) + '" data-progid="' + escapeHtml(progId) + '" data-progname="' + escapeHtml(progName) + '" ' + checked + '></td>' +
      '<td>' +
        (nameLine ? '<div class="sasaran-item-name">' + escapeHtml(nameLine) + '</div>' : '') +
        '<div class="sasaran-item-label">' + sasaranLabelFor(level) + ' :</div>' +
        '<div class="sasaran-item-text">' + escapeHtml(sasaranText) + '</div>' +
      '</td>' +
      '<td class="sasaran-subunit-col">' + escapeHtml(subUnit || '-') + '</td>' +
    '</tr>';

    var detailRow = '<tr class="sasaran-detail-row" data-detail-for="' + key + '" style="display:' + (existing ? "table-row" : "none") + ';">' +
      '<td></td>' +
      '<td colspan="2">' +
        '<div class="detail-grid">' +
          '<div><label>Indikator Kinerja</label><input type="text" class="detail-input" data-key="' + key + '" data-field="indikator" value="' + escapeHtml(d.indikator || "") + '" placeholder="mis. Persentase ..."></div>' +
          '<div><label>Satuan</label><select class="detail-input" data-key="' + key + '" data-field="satuan">' + satuanOptions(d.satuan) + '</select></div>' +
          '<div><label>Target</label><input type="text" class="detail-input" data-key="' + key + '" data-field="target" value="' + escapeHtml(d.target || "") + '" placeholder="mis. 100"></div>' +
        '</div>' +
      '</td>' +
    '</tr>';

    return mainRow + detailRow;
  }

  function captureSasaranDetailInputs(){
    sasaranBody.querySelectorAll(".detail-input").forEach(function(el){
      var key = el.getAttribute("data-key"), field = el.getAttribute("data-field");
      if (modalState.checkedSasaran[key]) modalState.checkedSasaran[key][field] = el.value;
    });
  }

  function loadSasaranList(level, callback){
    if (!level){
      sasaranBody.innerHTML = '<tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-400);">Pilih "Sasaran Perjanjian" (Program / Kegiatan / Sub Kegiatan) terlebih dahulu.</td></tr>';
      updateSelectedCount();
      return;
    }

    var tahun = CURRENT_TAHUN || "<?= date('Y') ?>";
    sasaranBody.innerHTML = '<tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-500);"><i class="fa fa-spinner fa-spin"></i> Memuat data sasaran ' + escapeHtml(level) + '...</td></tr>';

    $.ajax({
      url: BaseURL + "Instansi/getSasaranByLevel",
      type: "POST",
      data: { level: level, tahun: tahun, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res){
        if (res.status === 'success'){
          modalState.loadedData = res.data || [];
          renderSasaranBody();
          if (callback) callback();
        } else {
          sasaranBody.innerHTML = '<tr><td colspan="3" class="text-danger" style="text-align:center; padding:26px;">' + escapeHtml(res.message || 'Gagal memuat data') + '</td></tr>';
        }
      },
      error: function(){
        sasaranBody.innerHTML = '<tr><td colspan="3" class="text-danger" style="text-align:center; padding:26px;">Terjadi kesalahan saat memuat sasaran.</td></tr>';
      }
    });
  }

  function renderSasaranBody(){
    captureSasaranDetailInputs();
    var level = sasaranPerjanjianSel.value;
    var q = (sasaranSearch.value || "").trim().toLowerCase();
    var data = modalState.loadedData || [];

    if (!level){
      sasaranBody.innerHTML = '<tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-400);">Pilih "Sasaran Perjanjian" (Program / Kegiatan / Sub Kegiatan) terlebih dahulu.</td></tr>';
      updateSelectedCount();
      return;
    }

    function matchesQuery(){
      if (!q) return true;
      var haystack = Array.prototype.slice.call(arguments).join(" ").toLowerCase();
      return haystack.indexOf(q) > -1;
    }

    var rows = [];

    if (level === "program"){
      data.forEach(function(prog){
        var progTitle = (prog.kode ? prog.kode + ' — ' : '') + prog.nama;
        var sList = prog.sasaranProgram || [];
        var progRows = sList
          .map(function(s, i){
            var text = (typeof s === 'object') ? s.text : s;
            var ind = (typeof s === 'object') ? s.indikator : '';
            var sat = (typeof s === 'object') ? s.satuan : '%';
            var tgt = (typeof s === 'object') ? s.target : '';
            return { text: text, ind: ind, sat: sat, tgt: tgt, key: "prog|" + prog.id + "|" + i };
          })
          .filter(function(item){ return matchesQuery(prog.nama, prog.kode, item.text); });

        if (progRows.length === 0 && !matchesQuery(prog.nama, prog.kode)) return;

        rows.push('<tr class="grp-row"><td></td><td colspan="2">' + escapeHtml(progTitle) + '</td></tr>');
        if (progRows.length === 0) {
          rows.push(checkboxRow("prog|" + prog.id + "|0", "", "Meningkatnya kinerja pelaksanaan " + prog.nama, prog.sub_unit, "program", "Persentase Capaian Target", "%", "100", "p_" + prog.id, progTitle));
        } else {
          progRows.forEach(function(item){
            rows.push(checkboxRow(item.key, "", item.text, prog.sub_unit, "program", item.ind, item.sat, item.tgt, "p_" + prog.id, progTitle));
          });
        }
      });
    } else if (level === "kegiatan"){
      var groupedProg = {};
      data.forEach(function(k){
        var pid = k.program_id || '0';
        if (!groupedProg[pid]) {
          groupedProg[pid] = {
            id: pid,
            kode: k.program_kode || '',
            nama: k.program_nama || 'PROGRAM',
            kegiatans: []
          };
        }
        groupedProg[pid].kegiatans.push(k);
      });

      Object.keys(groupedProg).forEach(function(pid){
        var p = groupedProg[pid];
        var progTitle = (p.kode ? p.kode + ' — ' : '') + p.nama;
        var kegBlocks = [];

        p.kegiatans.forEach(function(k){
          var sItems = k.sasaranItems || [];
          var matchesK = matchesQuery(p.nama, k.nama, k.kode, k.sasaran);
          if (!matchesK) return;

          var key = "keg|" + k.id;
          var sasText = (sItems.length > 0 && sItems[0].text) ? sItems[0].text : (k.sasaran || ('Terlaksananya ' + k.nama));
          var defInd = (sItems.length > 0) ? sItems[0].indikator : (k.ind_fallback || 'Persentase Ketercapaian Kegiatan');
          var defSat = (sItems.length > 0) ? sItems[0].satuan : (k.satuan_fallback || '%');
          var defTgt = (sItems.length > 0) ? sItems[0].target : (k.target_fallback || '100');

          kegBlocks.push(checkboxRow(key, (k.kode ? k.kode + ' ' : '') + k.nama, sasText, k.sub_unit, "kegiatan", defInd, defSat, defTgt, "p_" + pid, progTitle));
        });

        if (kegBlocks.length > 0){
          rows.push('<tr class="grp-row"><td></td><td colspan="2">' + escapeHtml(progTitle) + '</td></tr>');
          rows = rows.concat(kegBlocks);
        }
      });
    } else if (level === "subkegiatan" || level === "sub_kegiatan"){
      var grouped = {};
      data.forEach(function(sk){
        var pid = sk.program_id || '0';
        var kid = sk.kegiatan_id || '0';
        if (!grouped[pid]) {
          grouped[pid] = { kode: sk.program_kode || '', nama: sk.program_nama || 'PROGRAM', kegs: {} };
        }
        if (!grouped[pid].kegs[kid]) {
          grouped[pid].kegs[kid] = { kode: sk.kegiatan_kode || '', nama: sk.kegiatan_nama || 'KEGIATAN', subs: [] };
        }
        grouped[pid].kegs[kid].subs.push(sk);
      });

      Object.keys(grouped).forEach(function(pid){
        var prog = grouped[pid];
        var progTitle = (prog.kode ? prog.kode + ' — ' : '') + prog.nama;
        var anyKeg = false;
        var pRows = [];

        Object.keys(prog.kegs).forEach(function(kid){
          var keg = prog.kegs[kid];
          var subBlocks = [];

          keg.subs.forEach(function(sk, sIdx){
            var matchesSK = matchesQuery(prog.nama, keg.nama, sk.nama, sk.kode, sk.sasaran);
            if (!matchesSK) return;

            var key = "sub|" + sk.id;
            var sItems = sk.sasaranItems || [];
            var sasText = (sItems.length > 0 && sItems[0].text) ? sItems[0].text : (sk.sasaran || ('Tersedianya ' + sk.nama));
            var defInd = (sItems.length > 0) ? sItems[0].indikator : (sk.ind_fallback || 'Jumlah Dokumen / Output');
            var defSat = (sItems.length > 0) ? sItems[0].satuan : (sk.satuan_fallback || 'Dokumen');
            var defTgt = (sItems.length > 0) ? sItems[0].target : (sk.target_fallback || '1');

            var nameLine = (sIdx + 1) + '. ' + (sk.kode ? sk.kode + ' ' : '') + sk.nama;
            subBlocks.push(checkboxRow(key, nameLine, sasText, sk.sub_unit, "subkegiatan", defInd, defSat, defTgt, "p_" + pid, progTitle));
          });

          if (subBlocks.length > 0){
            anyKeg = true;
            pRows.push('<tr class="grp-row grp-l2"><td></td><td colspan="2">' + escapeHtml((keg.kode ? keg.kode + ' ' : '') + keg.nama) + '</td></tr>');
            pRows = pRows.concat(subBlocks);
          }
        });

        if (anyKeg){
          rows.push('<tr class="grp-row"><td></td><td colspan="2">' + escapeHtml(progTitle) + '</td></tr>');
          rows = rows.concat(pRows);
        }
      });
    }

    sasaranBody.innerHTML = rows.length ? rows.join("") : '<tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-400);">Tidak ada data sasaran yang cocok dengan pencarian.</td></tr>';
    updateSelectedCount();
  }

  function updateSelectedCount(){
    var n = Object.keys(modalState.checkedSasaran).length;
    selectedCountEl.innerHTML = n === 0
      ? "Belum ada sasaran dipilih."
      : '<b style="color:var(--brand-deep);">' + n + '</b> sasaran dipilih.';
  }

  /* ---------- Anggaran Section ---------- */
  function captureAnggaranInputs(){
    anggaranBody.querySelectorAll(".anggaran-input").forEach(function(el){
      var pid = el.getAttribute("data-pid"), field = el.getAttribute("data-field");
      modalState.anggaranByProgram[pid] = modalState.anggaranByProgram[pid] || {};
      modalState.anggaranByProgram[pid][field] = el.value;
    });
  }

  function renderAnggaranSection(){
    captureAnggaranInputs();
    if (!anggaranCheck.checked){
      anggaranSection.style.display = "none";
      return;
    }
    anggaranSection.style.display = "block";

    var seen = {};
    var nodes = [];
    Object.keys(modalState.checkedSasaran).forEach(function(key){
      var d = modalState.checkedSasaran[key];
      var pid = d.progId || d.name || key;
      var label = d.progName || d.name || d.text;
      if (!seen[pid]){
        seen[pid] = true;
        nodes.push({ id: pid, label: label });
      }
    });

    if (nodes.length === 0){
      anggaranBody.innerHTML = '<tr><td colspan="3" style="text-align:center; padding:26px; color:var(--slate-400);">Pilih sasaran terlebih dahulu untuk menampilkan rincian anggaran.</td></tr>';
      return;
    }

    anggaranBody.innerHTML = nodes.map(function(n){
      var existing = modalState.anggaranByProgram[n.id] || {};
      var sumber = existing.sumberDana || "APBD";
      return '<tr>' +
        '<td><div class="sasaran-item-name">' + escapeHtml(n.label) + '</div></td>' +
        '<td><input type="text" class="anggaran-input" data-pid="' + escapeHtml(n.id) + '" data-field="anggaran" value="' + escapeHtml(existing.anggaran || "") + '" placeholder="mis. 250.000.000" style="width:100%; padding:6px 8px; border:1px solid var(--slate-300); border-radius:6px;"></td>' +
        '<td><select class="anggaran-input" data-pid="' + escapeHtml(n.id) + '" data-field="sumberDana" style="width:100%; padding:6px 8px; border:1px solid var(--slate-300); border-radius:6px;">' +
          ["APBD","APBN","Lainnya"].map(function(s){ return '<option value="' + s + '"' + (sumber === s ? " selected" : "") + '>' + s + '</option>'; }).join("") +
        '</select></td>' +
      '</tr>';
    }).join("");
  }

  sasaranBody.addEventListener("change", function(ev){
    var cb = ev.target.closest('input[type=checkbox]');
    if (!cb) return;
    var key = cb.getAttribute("data-key");
    var detailTr = sasaranBody.querySelector('tr.sasaran-detail-row[data-detail-for="' + key + '"]');
    if (cb.checked){
      modalState.checkedSasaran[key] = modalState.checkedSasaran[key] || {
        name: cb.getAttribute("data-name"),
        text: cb.getAttribute("data-text"),
        subUnit: cb.getAttribute("data-subunit"),
        progId: cb.getAttribute("data-progid"),
        progName: cb.getAttribute("data-progname"),
        indikator: "", satuan: "%", target: ""
      };
      if (detailTr) detailTr.style.display = "table-row";
    } else {
      delete modalState.checkedSasaran[key];
      if (detailTr) detailTr.style.display = "none";
    }
    updateSelectedCount();
    renderAnggaranSection();
  });

  sasaranPerjanjianSel.addEventListener("change", function(){
    modalState.checkedSasaran = {};
    loadSasaranList(this.value);
    renderAnggaranSection();
  });
  sasaranSearch.addEventListener("input", function(){ renderSasaranBody(); });
  anggaranCheck.addEventListener("change", renderAnggaranSection);

  /* ---------- Simpan Perjanjian Kinerja (AJAX) ---------- */
  document.getElementById("btnSimpan").addEventListener("click", function(){
    if (!modalState.selectedEmployee && !formEmployeeId.value){
      showToast("Pilih pegawai pengampu terlebih dahulu.", true); return;
    }
    if (!jenisPerjanjianSel.value){ showToast("Pilih jenis perjanjian.", true); return; }
    if (!sasaranPerjanjianSel.value){ showToast("Pilih sasaran perjanjian.", true); return; }
    if (!periodeAwalSel.value || !periodeAkhirSel.value){ showToast("Lengkapi periode awal dan akhir.", true); return; }
    if (parseInt(periodeAkhirSel.value,10) < parseInt(periodeAwalSel.value,10)){ showToast("Periode akhir tidak boleh sebelum periode awal.", true); return; }
    if (Object.keys(modalState.checkedSasaran).length === 0){ showToast("Pilih minimal satu sasaran yang diperjanjikan.", true); return; }

    captureSasaranDetailInputs();
    captureAnggaranInputs();

    var sasaranList = Object.keys(modalState.checkedSasaran).map(function(key){
      var d = modalState.checkedSasaran[key];
      return {
        sasaran: d.text,
        indikator: (d.indikator || "").trim(),
        satuan: d.satuan || "",
        target: (d.target || "").trim(),
        subUnit: d.subUnit || ""
      };
    });

    var anggaranList = [];
    if (anggaranCheck.checked){
      var seenNode = {};
      Object.keys(modalState.checkedSasaran).forEach(function(key){
        var d = modalState.checkedSasaran[key];
        var pid = d.progId || d.name || key;
        var label = d.progName || d.name || d.text;
        if (!seenNode[pid]){
          seenNode[pid] = true;
          var av = modalState.anggaranByProgram[pid] || {};
          anggaranList.push({
            nama: label,
            anggaran: (av.anggaran || "").trim(),
            sumberDana: av.sumberDana || "APBD"
          });
        }
      });
    }

    var payload = {
      tahun: CURRENT_TAHUN,
      anggaranEnabled: anggaranCheck.checked,
      sasaranList: sasaranList,
      anggaranList: anggaranList,
      sub_unit: satuanUnitKerja.value || ''
    };

    var btn = document.getElementById("btnSimpan");
    btn.disabled = true;
    btn.textContent = "Menyimpan...";

    $.ajax({
      url: BaseURL + "Instansi/simpanPerjanjianKinerja",
      type: "POST",
      data: {
        id: formPkId.value || '',
        mode: modalState.mode,
        pegawai_pengampu_id: formEmployeeId.value,
        atasan_langsung_id: formAtasanId.value,
        jenis_perjanjian: jenisPerjanjianSel.value,
        periode_awal: periodeAwalSel.value,
        periode_akhir: periodeAkhirSel.value,
        anggaran: anggaranCheck.checked ? 1 : 0,
        sasaran_level: sasaranPerjanjianSel.value,
        sasaran_data: JSON.stringify(payload),
        sub_unit: satuanUnitKerja.value || '',
        [CSRF_NAME]: CSRF_TOKEN
      },
      dataType: "json",
      success: function(res){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Perjanjian';
        if (res.status === 'success'){
          showToast(res.message);
          closeModal();
          setTimeout(function(){ location.reload(); }, 500);
        } else {
          showToast(res.message || "Gagal menyimpan data", true);
        }
      },
      error: function(){
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-save"></i> Simpan Perjanjian';
        showToast("Terjadi kesalahan saat menyimpan", true);
      }
    });
  });

  /* ============ DOKUMEN PK VIEWER POPUP ============ */
  var docViewerOverlay = document.getElementById("docViewerOverlay");
  var docViewerState = { pkId: null, docType: null, data: null };

  function buildDocDate(awal, tahun){
    var bulan = MONTHS[(awal || 1) - 1] || "Januari";
    return "1 " + bulan + " " + tahun;
  }

  function renderHalamanUtama(d, docType){
    var tahun = CURRENT_TAHUN || "<?= date('Y') ?>";
    var titleLine = "PERJANJIAN KINERJA TAHUN " + tahun;
    if (docType === "perubahan") titleLine = "PERJANJIAN KINERJA PERUBAHAN TAHUN " + tahun;
    if (docType === "plt") titleLine = "PERJANJIAN KINERJA PLT TAHUN " + tahun;

    var status = (docType === "perubahan") ? (d.status_perubahan || "menunggu") : ((docType === "plt") ? (d.status_plt || "menunggu") : (d.status || "menunggu"));
    var dateStr = buildDocDate(d.periode_awal, tahun);

    var alertHtml = (status !== "disetujui")
      ? '<div class="doc-alert">Dokumen belum disetujui oleh verifikator kinerja Daerah' +
          '<?php if ($IsRole3) { ?><button type="button" data-action="verify-doc" data-id="' + d.id + '" data-doctype="' + docType + '">Tandai Terverifikasi</button><?php } ?>' +
        '</div>'
      : "";

    var atasanNama = d.atasan_nama || "Bupati / Wali Kota";
    var atasanJabatan = d.atasan_jabatan || "Kepala Daerah";
    var atasanNip = d.atasan_nip || "-";

    return alertHtml +
      '<div class="doc-logo">' + LOGO_HTML + '</div>' +
      '<div class="doc-title">' +
        '<h3>' + escapeHtml(titleLine) + '</h3>' +
        '<h3>' + escapeHtml(CURRENT_ORG_NAME) + '</h3>' +
        '<h3>' + escapeHtml(CURRENT_ORG_CITY) + '</h3>' +
      '</div>' +
      '<p class="doc-body-text">Dalam rangka mewujudkan manajemen pemerintahan yang efektif, transparan, dan akuntabel serta berorientasi pada hasil, kami yang bertanda tangan di bawah ini:</p>' +
      '<table class="doc-party"><tr><td style="width:110px;">Nama</td><td>: <b>' + escapeHtml(d.pengampu_nama) + '</b></td></tr><tr><td>Jabatan</td><td>: ' + escapeHtml(d.pengampu_jabatan) + '</td></tr></table>' +
      '<p style="font-size:13px; margin:8px 0 16px;">Selanjutnya disebut <b>PIHAK PERTAMA</b></p>' +
      '<table class="doc-party"><tr><td style="width:110px;">Nama</td><td>: <b>' + escapeHtml(atasanNama) + '</b></td></tr><tr><td>Jabatan</td><td>: ' + escapeHtml(atasanJabatan) + '</td></tr></table>' +
      '<p style="font-size:13px; margin:8px 0 16px;">selaku atasan pihak pertama, selanjutnya disebut sebagai <b>PIHAK KEDUA</b></p>' +
      '<p class="doc-body-text">Pihak pertama berjanji akan mewujudkan target kinerja yang seharusnya sesuai lampiran perjanjian ini, dalam rangka mencapai target kinerja jangka menengah seperti yang telah ditetapkan dalam dokumen perencanaan. Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami.</p>' +
      '<p class="doc-body-text">Pihak kedua akan melakukan supervisi yang diperlukan serta akan melakukan evaluasi terhadap capaian kinerja dari perjanjian ini dan mengambil tindakan yang diperlukan dalam rangka pemberian penghargaan dan sanksi.</p>' +
      '<p class="doc-date">' + escapeHtml(CURRENT_ORG_CITY_LABEL) + ', ' + dateStr + '</p>' +
      '<div class="doc-signoff">' +
        '<div class="doc-sign-col"><div>PIHAK KEDUA,</div><div class="doc-sign-space"></div><div class="doc-sign-name">' + escapeHtml(atasanNama) + '</div><div class="doc-sign-nip">' + (atasanNip !== '-' ? 'NIP. ' + escapeHtml(atasanNip) : '') + '</div></div>' +
        '<div class="doc-sign-col"><div>PIHAK PERTAMA,</div><div class="doc-sign-space"></div><div class="doc-sign-name">' + escapeHtml(d.pengampu_nama) + '</div><div class="doc-sign-nip">' + (d.pengampu_nip ? 'NIP. ' + escapeHtml(d.pengampu_nip) : '') + '</div></div>' +
      '</div>';
  }

  function renderLampiran(d, docType){
    var tahun = CURRENT_TAHUN || "<?= date('Y') ?>";
    var titleLine = "PERJANJIAN KINERJA TAHUN " + tahun;
    if (docType === "perubahan") titleLine = "PERJANJIAN KINERJA PERUBAHAN TAHUN " + tahun;
    if (docType === "plt") titleLine = "PERJANJIAN KINERJA PLT TAHUN " + tahun;

    var dateStr = buildDocDate(d.periode_awal, tahun);
    var atasanNama = d.atasan_nama || "Bupati / Wali Kota";
    var atasanNip = d.atasan_nip || "-";

    var rawData = (docType === "perubahan") ? d.pk_perubahan_data : ((docType === "plt") ? d.pk_plt_data : d.sasaran_data);
    var lamp = null;
    try { if (rawData) lamp = JSON.parse(rawData); } catch(e){}

    var sasaranRows = (lamp && lamp.sasaranList && lamp.sasaranList.length)
      ? lamp.sasaranList.map(function(s, i){
          return '<tr><td class="num">' + (i+1) + '</td><td>' + escapeHtml(s.sasaran) + '</td><td>' + escapeHtml(s.indikator || "-") + '</td><td style="text-align:center;">' + escapeHtml(s.satuan || "-") + '</td><td style="text-align:center; font-weight:bold;">' + escapeHtml(s.target || "-") + '</td></tr>';
        }).join("")
      : '<tr><td colspan="5" style="text-align:center; padding:24px; color:var(--slate-400);">Belum ada sasaran yang diperjanjikan.</td></tr>';

    var anggaranRows = (lamp && lamp.anggaranEnabled && lamp.anggaranList && lamp.anggaranList.length)
      ? lamp.anggaranList.map(function(a, i){
          return '<tr><td class="num">' + (i+1) + '</td><td>' + escapeHtml(a.nama) + '</td><td style="font-weight:bold;">Rp ' + escapeHtml(a.anggaran || "0") + '</td><td style="text-align:center;">' + escapeHtml(a.sumberDana || "APBD") + '</td></tr>';
        }).join("")
      : '';

    var anggaranSectionHtml = (anggaranRows && anggaranRows.length)
      ? '<div style="margin-top:18px; font-weight:bold; font-size:12.5px; text-transform:uppercase;">Rincian Anggaran:</div>' +
        '<table class="doc-lampiran-table"><thead><tr><th>No</th><th>Program / Kegiatan / Sub</th><th>Anggaran</th><th style="text-align:center;">Sumber Dana</th></tr></thead><tbody>' + anggaranRows + '</tbody></table>'
      : '';

    return '<div class="doc-title">' +
        '<h3>' + escapeHtml(titleLine) + '</h3>' +
        '<h3>' + escapeHtml((d.pengampu_jabatan || "").toUpperCase()) + '</h3>' +
        '<h3>' + escapeHtml(CURRENT_ORG_NAME) + '</h3>' +
        '<h3>' + escapeHtml(CURRENT_ORG_CITY) + '</h3>' +
      '</div>' +
      '<table class="doc-lampiran-table"><thead><tr><th>No</th><th>Sasaran Yang Diperjanjikan</th><th>Indikator Kinerja</th><th style="text-align:center;">Satuan</th><th style="text-align:center;">Target</th></tr></thead><tbody>' + sasaranRows + '</tbody></table>' +
      anggaranSectionHtml +
      '<p class="doc-date" style="margin-top:20px;">' + escapeHtml(CURRENT_ORG_CITY_LABEL) + ', ' + dateStr + '</p>' +
      '<div class="doc-signoff">' +
        '<div class="doc-sign-col"><div>PIHAK KEDUA,</div><div class="doc-sign-space"></div><div class="doc-sign-name">' + escapeHtml(atasanNama) + '</div><div class="doc-sign-nip">' + (atasanNip !== '-' ? 'NIP. ' + escapeHtml(atasanNip) : '') + '</div></div>' +
        '<div class="doc-sign-col"><div>PIHAK PERTAMA,</div><div class="doc-sign-space"></div><div class="doc-sign-name">' + escapeHtml(d.pengampu_nama) + '</div><div class="doc-sign-nip">' + (d.pengampu_nip ? 'NIP. ' + escapeHtml(d.pengampu_nip) : '') + '</div></div>' +
      '</div>';
  }

  function switchDocTab(tab){
    document.getElementById("tabUtama").classList.toggle("active", tab === "utama");
    document.getElementById("tabLampiran").classList.toggle("active", tab === "lampiran");
    document.getElementById("docPaneUtama").style.display = (tab === "utama") ? "block" : "none";
    document.getElementById("docPaneLampiran").style.display = (tab === "lampiran") ? "block" : "none";
  }

  function openDocViewer(pkId, docType){
    docViewerState.pkId = pkId;
    docViewerState.docType = docType || 'definitif';

    document.getElementById("docPaneUtama").innerHTML = '<p style="text-align:center; padding:40px;"><i class="fa fa-spinner fa-spin"></i> Memuat dokumen...</p>';
    document.getElementById("docPaneLampiran").innerHTML = '';
    switchDocTab("utama");
    docViewerOverlay.classList.remove("hidden");
    document.body.style.overflow = "hidden";

    $.ajax({
      url: BaseURL + "Instansi/getPerjanjianKinerja",
      type: "POST",
      data: { id: pkId, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res){
        if (res.status === 'success'){
          docViewerState.data = res.data;
          document.getElementById("docPaneUtama").innerHTML = renderHalamanUtama(res.data, docViewerState.docType);
          document.getElementById("docPaneLampiran").innerHTML = renderLampiran(res.data, docViewerState.docType);
        } else {
          document.getElementById("docPaneUtama").innerHTML = '<p class="text-danger" style="text-align:center; padding:40px;">Gagal memuat data dokumen.</p>';
        }
      },
      error: function(){
        document.getElementById("docPaneUtama").innerHTML = '<p class="text-danger" style="text-align:center; padding:40px;">Terjadi kesalahan saat memuat dokumen.</p>';
      }
    });
  }

  function closeDocViewer(){
    docViewerOverlay.classList.add("hidden");
    document.body.style.overflow = "";
  }

  document.getElementById("tabUtama").addEventListener("click", function(){ switchDocTab("utama"); });
  document.getElementById("tabLampiran").addEventListener("click", function(){ switchDocTab("lampiran"); });
  document.getElementById("btnCloseDocViewer").addEventListener("click", closeDocViewer);
  document.getElementById("btnCloseDocViewerFooter").addEventListener("click", closeDocViewer);
  docViewerOverlay.addEventListener("click", function(ev){ if (ev.target === docViewerOverlay) closeDocViewer(); });

  document.getElementById("btnPrintDokumen").addEventListener("click", function(){
    window.print();
  });

  var btnHapusDocEl = document.getElementById("btnHapusDokumen");
  if (btnHapusDocEl){
    btnHapusDocEl.addEventListener("click", function(){
      if (!confirm("Hapus dokumen " + docViewerState.docType.toUpperCase() + " ini? Tindakan ini tidak dapat dibatalkan.")) return;
      $.ajax({
        url: BaseURL + "Instansi/hapusDokumenPerjanjianKinerja",
        type: "POST",
        data: { id: docViewerState.pkId, doctype: docViewerState.docType, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res){
          if (res.status === 'success'){
            showToast(res.message);
            closeDocViewer();
            setTimeout(function(){ location.reload(); }, 500);
          } else {
            showToast(res.message || "Gagal menghapus dokumen", true);
          }
        }
      });
    });
  }

  document.getElementById("docPaneUtama").addEventListener("click", function(ev){
    var btn = ev.target.closest('[data-action="verify-doc"]');
    if (!btn) return;
    var pkId = btn.getAttribute("data-id");
    var docType = btn.getAttribute("data-doctype");
    $.ajax({
      url: BaseURL + "Instansi/updateStatusPerjanjianKinerja",
      type: "POST",
      data: { id: pkId, status: 'disetujui', doctype: docType, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res){
        if (res.status === 'success'){
          showToast(res.message);
          openDocViewer(pkId, docType);
        } else {
          showToast(res.message || "Gagal mengubah status", true);
        }
      }
    });
  });

  /* ============ EVENT HANDLER TABEL UTAMA ============ */
  $(document).on("click", ".doc-badge", function(){
    var pkId = $(this).data("id");
    var docType = $(this).data("doctype") || "definitif";
    openDocViewer(pkId, docType);
  });

  $(document).on("click", ".btn-tambah-pk-row", function(){
    var pkId = $(this).data("id");
    openModal("addpk", pkId);
  });

  $(document).on("click", ".btn-edit-pk-row", function(){
    var pkId = $(this).data("id");
    openModal("edit", pkId);
  });

  $(document).on("click", ".btn-hapus-pk-row", function(){
    var pkId = $(this).data("id");
    if (!confirm("Yakin ingin menghapus data Perjanjian Kinerja ini?")) return;
    $.ajax({
      url: BaseURL + "Instansi/hapusPerjanjianKinerja",
      type: "POST",
      data: { id: pkId, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res){
        if (res.status === 'success'){
          showToast(res.message);
          setTimeout(function(){ location.reload(); }, 500);
        } else {
          showToast(res.message || "Gagal menghapus data", true);
        }
      }
    });
  });

  $(document).on("change", ".select-status-level3", function(){
    var $sel = $(this);
    var pkId = $sel.data("id");
    var prev = $sel.data("prev");
    var newSt = $sel.val();
    var docType = $sel.data("doctype") || "definitif";

    if (!confirm("Ubah status verifikasi menjadi " + newSt.toUpperCase() + "?")){
      $sel.val(prev);
      return;
    }

    $sel.prop("disabled", true);
    $.ajax({
      url: BaseURL + "Instansi/updateStatusPerjanjianKinerja",
      type: "POST",
      data: { id: pkId, status: newSt, doctype: docType, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res){
        $sel.prop("disabled", false);
        if (res.status === 'success'){
          showToast(res.message);
          $sel.data("prev", newSt);
          $sel.removeClass("status-disetujui status-menunggu status-ditolak").addClass("status-" + newSt);
        } else {
          showToast(res.message || "Gagal mengubah status", true);
          $sel.val(prev);
        }
      },
      error: function(){
        $sel.prop("disabled", false);
        $sel.val(prev);
        showToast("Terjadi kesalahan koneksi", true);
      }
    });
  });

  // Filter Instansi (Role Daerah Non-Role 4)
  <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function(){
      var id = $("#FilterInstansi").val();
      var url = BaseURL + "Instansi/PerjanjianKinerjaPD?tahun=" + encodeURIComponent(CURRENT_TAHUN);
      if (id) url += "&instansi_id=" + encodeURIComponent(id);
      window.location.href = url;
    });
  <?php } ?>

  // Filter Wilayah Sebelum Login
  <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
    $("#Provinsi").change(function(){
      var prov = $(this).val();
      if (!prov){ $("#KabKota").html('<option value="">Pilih Kab/Kota</option>'); return; }
      $.ajax({
        url: BaseURL + "Instansi/GetListKabKota",
        type: "POST",
        data: { Kode: prov, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(data){
          var opts = '<option value="">Pilih Kab/Kota</option>';
          if (data && data.length){
            data.forEach(function(k){ opts += '<option value="' + k.Kode + '">' + k.Nama + '</option>'; });
          }
          $("#KabKota").html(opts);
        }
      });
    });

    $("#KabKota").change(function(){
      var kab = $(this).val();
      if (!kab){ $("#FilterInstansiGroup").hide(); return; }
      $.ajax({
        url: BaseURL + "Instansi/GetListInstansiLevel4",
        type: "POST",
        data: { kode_wilayah: kab, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(data){
          var opts = '<option value="">-- Semua Instansi --</option>';
          if (data && data.length){
            data.forEach(function(i){ opts += '<option value="' + i.id + '">' + i.nama + '</option>'; });
          }
          $("#FilterInstansiBeforeLogin").html(opts);
          $("#FilterInstansiGroup").show();
        }
      });
    });

    $("#Filter").click(function(){
      var kab = $("#KabKota").val();
      var ins = $("#FilterInstansiBeforeLogin").val();
      if (!$("#Provinsi").val() || !kab){ alert("Mohon pilih Provinsi dan Kab/Kota"); return; }
      $.ajax({
        url: BaseURL + "Instansi/SetTempKodeWilayah",
        type: "POST",
        data: { KodeWilayah: kab, InstansiId: ins, [CSRF_NAME]: CSRF_TOKEN },
        success: function(res){
          if (res === '1'){
            var url = BaseURL + "Instansi/PerjanjianKinerjaPD?tahun=" + encodeURIComponent(CURRENT_TAHUN);
            if (ins) url += "&instansi_id=" + encodeURIComponent(ins);
            window.location.href = url;
          } else {
            alert(res || "Gagal filter");
          }
        }
      });
    });
  <?php } ?>

})();
</script>
</body>
</html>