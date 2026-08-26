<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rancangan Akhir Renja Perangkat Daerah</title>
<?php $this->load->view('Daerah/Cssumum'); ?>
<style>
  :root{
    --brand-green:#20c997;
    --brand-dark:#169b74;
    --brand-deep:#0f6e52;
    --brand-light:#7ee3c5;
    --brand-soft:#ebfaf5;
    --brand-border:#b7eedc;
    
    --slate-50:#f8fafc;
    --slate-100:#f1f5f9;
    --slate-200:#e2e8f0;
    --slate-300:#cbd5e1;
    --slate-400:#94a3b8;
    --slate-500:#64748b;
    --slate-600:#475569;
    --slate-700:#334155;
    --slate-800:#1e293b;
    --slate-900:#0f172a;

    --amber-600:#d97706;
    --amber-500:#b45309;
    --amber-50:#fefce8;
    --amber-border:#fde68a;

    --violet-600:#7c3aed;
    --violet-50:#f5f3ff;

    --red-600:#dc2626;
    --red-50:#fef2f2;
    --white:#ffffff;
    --radius:10px;
    --shadow-md:0 4px 14px rgba(32,201,151,.12);
    --shadow-lg:0 24px 60px rgba(15,110,82,.22);
    --head-row-h:40px;
  }

  *{box-sizing:border-box;}
  
  .renja-wrapper {
    background:var(--slate-50);
    color:var(--slate-900);
    font-family:"Segoe UI", Inter, -apple-system, BlinkMacSystemFont, Roboto, Arial, sans-serif;
    font-size:13.5px;
    line-height:1.45;
    min-height: calc(100vh - 70px);
    display:flex;
    flex-direction:column;
  }

  /* ---------- Topbar (Curved & Sejajar dengan Tabel) ---------- */
  .topbar{
    flex:none;
    background:#20c997;
    color:#fff;
    margin:14px 14px 0;
    padding:15px 22px;
    border-radius:var(--radius);
    box-shadow:0 4px 14px rgba(32,201,151,.22);
    z-index:30;
  }
  .topbar-row{
    display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;
  }
  .app-title{
    display:flex; flex-direction:column; gap:2px;
  }
  .app-title h1{
    margin:0; font-size:17px; font-weight:700; letter-spacing:.2px; color:#fff;
  }
  .app-title span{
    font-size:12px; color:rgba(255,255,255,.92); font-weight:500;
  }
  .topbar-controls{
    display:flex; align-items:center; gap:10px; flex-wrap:wrap;
  }
  .rpjmd-select, .instansi-select{
    appearance:none;
    background:rgba(255,255,255,.22);
    color:#fff;
    border:1px solid rgba(255,255,255,.45);
    border-radius:8px;
    padding:8px 30px 8px 12px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6"><path d="M0 0l5 6 5-6z" fill="white"/></svg>');
    background-repeat:no-repeat;
    background-position:right 12px center;
  }
  .rpjmd-select option, .instansi-select option{ color:#0f172a; }
  .year-tabs{
    display:flex; gap:6px; background:rgba(0,0,0,.12); padding:4px; border-radius:9px;
  }
  .year-tab{
    border:none; background:transparent; color:rgba(255,255,255,.9);
    padding:7px 13px; border-radius:6px; font-size:12.5px; font-weight:600; cursor:pointer;
    transition:background .15s, color .15s;
  }
  .year-tab:hover{ background:rgba(255,255,255,.2); color:#fff; }
  .year-tab.active{ background:#ffffff; color:var(--brand-dark); font-weight:800; box-shadow:0 2px 8px rgba(0,0,0,.15); }

  .btn-sync{
    display:inline-flex; align-items:center; gap:7px;
    background:#ffffff; color:#0f6e52; border:none;
    padding:7px 14px; border-radius:8px; font-weight:700;
    font-size:12.5px; cursor:pointer; box-shadow:0 2px 6px rgba(0,0,0,.08);
    transition:all .15s ease-in-out;
  }
  .btn-sync:hover{
    background:#ebfaf5; color:#047857; transform:translateY(-1px);
    box-shadow:0 4px 10px rgba(0,0,0,.12);
  }
  .btn-sync i{ font-size:13px; }

  /* ---------- Ringkasan Pagu Anggaran ---------- */
  .pagu-summary{
    flex:none;
    margin:14px 14px 0;
    background:var(--white);
    border:1px solid var(--slate-200);
    border-radius:var(--radius);
    box-shadow:var(--shadow-md);
    padding:14px 8px;
    display:flex;
    align-items:stretch;
    flex-wrap:wrap;
  }
  .pagu-item{
    flex:1;
    min-width:230px;
    display:flex;
    align-items:center;
    gap:12px;
    padding:2px 22px;
  }
  .pagu-item + .pagu-item{ border-left:1px solid var(--slate-200); }
  .pagu-icon{
    flex:none;
    width:38px; height:38px;
    border-radius:9px;
    display:flex; align-items:center; justify-content:center;
  }
  .pagu-icon svg{ width:19px; height:19px; }
  .pagu-icon.icon-pagu{ background:var(--brand-green); color:#fff; }
  .pagu-icon.icon-input{ background:var(--brand-soft); color:var(--brand-dark); }
  .pagu-icon.icon-selisih{ background:var(--slate-100); color:var(--slate-600); }
  .pagu-text{ display:flex; flex-direction:column; gap:2px; min-width:0; }
  .pagu-label{
    font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.4px;
    color:var(--slate-500);
  }
  .pagu-value{
    font-size:16.5px; font-weight:700; color:var(--slate-900);
    white-space:nowrap;
  }
  .pagu-sub{ font-size:11px; color:var(--slate-500); }

  .pagu-item.status-balanced .pagu-icon.icon-selisih{ background:var(--brand-soft); color:var(--brand-dark); }
  .pagu-item.status-balanced .pagu-value{ color:var(--brand-dark); }
  .pagu-item.status-remaining .pagu-icon.icon-selisih{ background:var(--amber-50); color:var(--amber-500); }
  .pagu-item.status-remaining .pagu-value{ color:var(--amber-500); }
  .pagu-item.status-over .pagu-icon.icon-selisih{ background:var(--red-50); color:var(--red-600); }
  .pagu-item.status-over .pagu-value{ color:var(--red-600); }

  /* ---------- Table area ---------- */
  .table-wrap{
    flex:1;
    overflow:auto;
    background:var(--white);
    margin:14px;
    border-radius:var(--radius);
    border:1px solid var(--slate-200);
    box-shadow:var(--shadow-md);
  }
  .table-renja-main{
    border-collapse:separate;
    border-spacing:0;
    width:100%;
    min-width:1920px;
  }
  colgroup col.c-kode{width:92px;}
  colgroup col.c-uraian{width:280px;}
  colgroup col.c-indikator{width:270px;}
  colgroup col.c-satuan{width:74px;}
  colgroup col.c-kinerja{width:74px;}
  colgroup col.c-rp{width:118px;}
  colgroup col.c-lokasi{width:120px;}
  colgroup col.c-sumberdana{width:96px;}
  colgroup col.c-prioritas-d{width:150px;}
  colgroup col.c-prioritas-n{width:190px;}
  colgroup col.c-kelompok{width:120px;}
  colgroup col.c-maju-k{width:74px;}
  colgroup col.c-maju-rp{width:118px;}
  colgroup col.c-pengampu{width:210px;}
  colgroup col.c-opsi{width:64px;}

  .table-renja-main thead th{
    position:sticky; top:0;
    background:var(--slate-100);
    color:var(--slate-700);
    font-size:11.5px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.3px;
    padding:8px 10px;
    border-bottom:1px solid var(--slate-300);
    border-right:1px solid var(--slate-200);
    text-align:center;
    vertical-align:middle;
    z-index:5;
    line-height:1.35;
  }
  .table-renja-main thead tr:first-child th{ top:0; min-height:var(--head-row-h); }
  .table-renja-main thead tr:last-child th{ top:var(--head-row-h); }
  .table-renja-main thead th:first-child{ position:sticky; left:0; z-index:8; }

  .table-renja-main tbody td{
    padding:7px 10px;
    border-bottom:1px solid var(--slate-200);
    border-right:1px solid var(--slate-100);
    vertical-align:top;
    font-size:12.8px;
    color:var(--slate-800);
  }
  .table-renja-main tbody td:first-child{
    position:sticky; left:0;
    background:inherit;
    font-family:"SFMono-Regular", Consolas, "Courier New", monospace;
    font-size:12px;
    color:var(--slate-600);
    z-index:2;
    border-right:1px solid var(--slate-200);
  }
  .text-center{ text-align:center; }
  .text-right{ text-align:right; white-space:nowrap; }

  /* Row types */
  .row-pd td{
    background:var(--brand-dark);
    color:#fff;
    font-size:14.5px;
    font-weight:800;
    letter-spacing:.3px;
    padding:12px 14px;
    position:static;
  }
  .row-section td{
    background:var(--brand-soft);
    color:var(--brand-deep);
    font-weight:700;
    font-size:12.6px;
    padding:8px 14px;
    border-top:1px solid var(--brand-border);
    position:static;
  }
  .row-tujuan{ background:var(--white); box-shadow:inset 3px 0 0 var(--brand-green); }
  .row-tujuan td:first-child{ box-shadow:inset 3px 0 0 var(--brand-green); }
  .row-sasaran{ background:var(--white); }
  .row-sasaran td:first-child{ box-shadow:inset 3px 0 0 var(--brand-dark); }
  .row-urusan td{
    background:var(--brand-green); color:#fff; font-weight:700; font-size:12.8px;
  }
  .row-urusan td:first-child{
    background:var(--brand-green); color:#fff; font-weight:700; font-size:12.8px;
  }
  .row-urusan .cell-anggaran-auto{ color:#fff; }
  .row-bidang td{
    background:var(--brand-soft); color:var(--brand-deep); font-weight:700; font-size:12.6px;
    padding-left:22px; border-top:1px solid var(--brand-border);
  }
  .row-bidang td:first-child{
    background:var(--brand-soft); color:var(--brand-deep); font-weight:700; font-size:12.6px;
  }

  .cell-anggaran-auto{
    cursor:help;
  }
  .row-program .cell-anggaran-auto,
  .row-kegiatan .cell-anggaran-auto{
    color:var(--brand-deep);
  }
  .cell-anggaran-input{
    color:var(--brand-dark);
    font-weight:700;
  }
  .row-program{ background:var(--amber-50); }
  .row-program td:first-child{ background:var(--amber-50); box-shadow:inset 3px 0 0 var(--amber-500); font-weight:700; }
  .row-program .cell-uraian{ font-weight:700; color:var(--slate-900); }
  .row-kegiatan{ background:var(--white); }
  .row-kegiatan td:first-child{ background:var(--white); box-shadow:inset 3px 0 0 var(--brand-green); }
  .row-kegiatan .cell-uraian{ font-weight:600; color:var(--slate-900); }
  .row-subkegiatan{ background:var(--slate-50); }
  .row-subkegiatan td:first-child{ background:var(--slate-50); box-shadow:inset 3px 0 0 var(--brand-light); }
  .row-subkegiatan .cell-uraian{ padding-left:22px; color:var(--slate-700); }

  .label-tag{ color:var(--slate-500); font-weight:600; margin-right:3px; }

  /* Collapse / accordion */
  tr[data-toggle-key]{ cursor:pointer; }
  .toggle-btn-inline{ display:inline-flex; align-items:center; gap:7px; }
  .chevron{ transition:transform .15s ease; flex:none; }
  .chevron.collapsed{ transform:rotate(-90deg); }
  .collapse-badge{
    font-size:10.8px; font-weight:700; padding:2px 8px; border-radius:999px;
    background:rgba(255,255,255,.2); white-space:nowrap;
  }
  .row-program .collapse-badge{ background:rgba(180,83,9,.12); color:var(--amber-500); }

  .cell-pengampu{ font-size:12px; line-height:1.45; }
  .cell-pengampu strong{ color:var(--slate-800); }
  .pengampu-name{ color:var(--brand-dark); font-weight:600; display:inline-block; margin-top:2px; }

  .badge-col-rkpd {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fcd34d;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 700;
    padding: 1px 5px;
    margin-top: 3px;
    line-height: 1.25;
    cursor: help;
    letter-spacing: .2px;
    white-space: nowrap;
  }
  .badge-col-rkpd i {
    font-size: 9px;
    color: #d97706;
  }

  .btn-aksi.btn-warning, .btn-edit{
    display:inline-flex; align-items:center; justify-content:center;
    width:28px; height:28px; border-radius:6px;
    background-color:#f0ad4e; border:1px solid #eea236; color:#fff;
    cursor:pointer; transition:all .15s ease-in-out;
    padding:0; font-size:12px;
  }
  .btn-aksi.btn-warning:hover, .btn-edit:hover{
    background-color:#ec971f; border-color:#d58512; color:#fff;
    transform:scale(1.08);
  }

  /* Modal */
  .modal-backdrop-custom{
    position:fixed; inset:0; background:rgba(15,110,82,.55);
    display:flex; align-items:flex-start; justify-content:center;
    padding:5vh 16px; overflow:auto;
    opacity:0; pointer-events:none; transition:opacity .15s;
    z-index:2000;
  }
  .modal-backdrop-custom.open{ opacity:1; pointer-events:auto; }
  .modal-custom{
    background:#fff; width:100%; max-width:760px; border-radius:14px;
    box-shadow:var(--shadow-lg);
    transform:translateY(-10px); transition:transform .18s;
  }
  .modal-backdrop-custom.open .modal-custom{ transform:translateY(0); }
  .modal-head{
    display:flex; align-items:center; justify-content:space-between;
    padding:20px 26px 14px; border-bottom:1px solid var(--slate-200);
    background:var(--brand-green);
    border-radius:14px 14px 0 0;
  }
  .modal-head h2{
    margin:0; font-size:17px; letter-spacing:.4px; color:#fff; font-weight:800;
  }
  .modal-close-btn{
    border:none; background:rgba(255,255,255,.18); cursor:pointer; color:#fff;
    width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center;
  }
  .modal-close-btn:hover{ background:rgba(255,255,255,.32); color:#fff; }
  .modal-tabs{
    display:flex; gap:22px; padding:14px 26px 0; border-bottom:1px solid var(--slate-200);
  }
  .modal-tab{
    padding:0 2px 12px; font-size:13.5px; font-weight:700; color:var(--brand-dark);
    border-bottom:2px solid var(--brand-green);
  }
  .modal-body-custom{ padding:22px 26px 8px; max-height:64vh; overflow:auto; }
  .field{ margin-bottom:16px; }
  .field label{
    display:block; font-size:12.8px; font-weight:700; color:var(--slate-700); margin-bottom:6px;
  }
  .field label .req{ color:var(--red-600); margin-left:2px; }
  .field input[type=text],
  .field input[type=number],
  .field textarea,
  .field select{
    width:100%; padding:10px 12px; border:1px solid var(--slate-300); border-radius:8px;
    font-size:13.3px; font-family:inherit; color:var(--slate-900); background:#fff;
  }
  .field input:read-only{ background:var(--slate-100); color:var(--slate-600); }
  .field input:focus, .field select:focus, .field textarea:focus{
    outline:none; border-color:var(--brand-green); box-shadow:0 0 0 3px rgba(32,201,151,.25);
  }
  .field textarea{ resize:vertical; min-height:56px; }
  .row-2, .row-3{ display:grid; gap:14px; }
  .row-2{ grid-template-columns:1fr 1fr; }
  .row-3{ grid-template-columns:1fr 1fr 1fr; }
  .rp-input-wrap{ position:relative; }
  .rp-input-wrap .rp-prefix{
    position:absolute; left:12px; top:50%; transform:translateY(-50%);
    color:var(--slate-500); font-size:13px; font-weight:600; pointer-events:none;
  }
  .rp-input-wrap input{ padding-left:32px !important; text-align:right; }
  .waktu-row{ display:flex; align-items:center; gap:12px; }
  .waktu-row select{ flex:1; }
  .waktu-sd{ font-size:12.8px; font-weight:700; color:var(--slate-500); }

  .modal-foot{
    display:flex; justify-content:flex-end; gap:10px;
    padding:16px 26px 24px;
  }
  .btn-custom{
    border:none; border-radius:9px; padding:11px 20px; font-size:13.6px; font-weight:700;
    cursor:pointer; display:inline-flex; align-items:center; gap:8px;
  }
  .btn-cancel-custom{ background:var(--slate-100); color:var(--slate-700); }
  .btn-cancel-custom:hover{ background:var(--slate-200); }
  .btn-primary-custom{ background:var(--brand-green); color:#fff; box-shadow:0 6px 16px rgba(32,201,151,.35); }
  .btn-primary-custom:hover{ background:var(--brand-dark); }

  /* Toast */
  .toast-custom{
    position:fixed; left:50%; bottom:26px; transform:translate(-50%, 20px);
    background:var(--slate-900); color:#fff; padding:12px 20px; border-radius:9px;
    font-size:13px; font-weight:600; box-shadow:var(--shadow-lg);
    opacity:0; pointer-events:none; transition:opacity .2s, transform .2s;
    z-index:3000; display:flex; align-items:center; gap:10px;
  }
  .toast-custom.show{ opacity:1; transform:translate(-50%, 0); }
  .toast-custom.toast-success{ border-left:4px solid var(--brand-green); }
  .toast-custom.toast-error{ border-left:4px solid var(--red-600); }

  /* Loading State */
  .loading-shade{
    display:none; position:fixed; inset:0; background:rgba(255,255,255,.6);
    z-index:2500; align-items:center; justify-content:center;
  }
  .loading-shade.active{ display:flex; }
  .loading-spinner{
    width:36px; height:36px; border:3px solid var(--brand-border);
    border-top-color:var(--brand-green); border-radius:50%;
    animation:spin 0.8s linear infinite;
  }
  @keyframes spin{ to{ transform:rotate(360deg); } }

  @media print{
    .topbar, .btn-edit, .modal-backdrop-custom, .toast-custom{ display:none !important; }
    .table-wrap{ margin:0; border:none; box-shadow:none; overflow:visible; }
    .pagu-summary{ margin:0 0 10px; border:none; box-shadow:none; padding:0; }
    body{ font-size:10px; }
  }
</style>
</head>
<body>

<?php $this->load->view('Daerah/sidebar'); ?>

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
          <h1>Rancangan Akhir Rencana Kerja (Renja) Perangkat Daerah</h1>
          <span>Data Tujuan, Sasaran, Urusan, Bidang, dan Program bersumber dari Renstra Perangkat Daerah &mdash; menampilkan Rancangan Akhir Renja Tahun <b id="activeYearLabel"><?= html_escape($TahunAktif) ?></b></span>
        </div>
        <div class="topbar-controls">
          <select id="rpjmdSelect" class="rpjmd-select">
            <option>RPJMD 2025-2029</option>
          </select>
          <div class="year-tabs" id="yearTabs"></div>
          <button type="button" id="btnSyncData" class="btn-sync" title="Cocokkan / Sinkronkan Ulang Data Rancangan Akhir dengan Rancangan Renja">
            <i class="fa fa-refresh"></i> Sinkronkan Rancangan
          </button>
        </div>
      </div>
    </div>

    <!-- ============ RINGKASAN PAGU ANGGARAN ============ -->
    <div class="pagu-summary">
      <div class="pagu-item">
        <div class="pagu-icon icon-pagu">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="16" height="11" rx="2"/><path d="M2 8.5h16M6.5 12.5h2"/></svg>
        </div>
        <div class="pagu-text">
          <span class="pagu-label">Pagu Anggaran</span>
          <span class="pagu-value" id="paguAnggaranValue">Rp 0</span>
          <span class="pagu-sub">Plafon tetap Perangkat Daerah TA <b id="paguTahunLabel"><?= html_escape($TahunAktif) ?></b></span>
        </div>
      </div>
      <div class="pagu-item">
        <div class="pagu-icon icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5l4 4 10-10"/></svg>
        </div>
        <div class="pagu-text">
          <span class="pagu-label">Akumulasi Terinput</span>
          <span class="pagu-value" id="paguTerinputValue">Rp 0</span>
          <span class="pagu-sub" id="paguTerinputPercent">Total dari seluruh Sub Kegiatan</span>
        </div>
      </div>
      <div class="pagu-item" id="paguSelisihItem">
        <div class="pagu-icon icon-selisih">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10.5h12M10 4.5v3M10 12.5v3"/></svg>
        </div>
        <div class="pagu-text">
          <span class="pagu-label" id="paguSelisihLabel">Selisih Pagu</span>
          <span class="pagu-value" id="paguSelisihValue">Rp 0</span>
          <span class="pagu-sub" id="paguSelisihSub">&nbsp;</span>
        </div>
      </div>
    </div>

    <!-- ============ TABLE ============ -->
    <div class="table-wrap">
      <table class="table-renja-main">
        <colgroup>
          <col class="c-kode"><col class="c-uraian"><col class="c-indikator"><col class="c-satuan">
          <col class="c-kinerja"><col class="c-rp"><col class="c-lokasi"><col class="c-sumberdana">
          <col class="c-prioritas-d"><col class="c-prioritas-n"><col class="c-kelompok">
          <col class="c-maju-k"><col class="c-maju-rp"><col class="c-pengampu"><col class="c-opsi">
        </colgroup>
        <thead>
          <tr>
            <th rowspan="2">Kode</th>
            <th rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
            <th rowspan="2">Indikator Kinerja Program (Outcome)/ Kegiatan (Output)</th>
            <th rowspan="2">Satuan</th>
            <th colspan="2">Rankhir Renja</th>
            <th rowspan="2">Lokasi</th>
            <th rowspan="2">Sumber Pendanaan</th>
            <th colspan="2">Prioritas</th>
            <th rowspan="2">Kelompok Sasaran</th>
            <th colspan="2">Perkiraan Maju Anggaran</th>
            <th rowspan="2">Bidang &amp; Pengampu</th>
            <th rowspan="2">Opsi Aksi</th>
          </tr>
          <tr>
            <th>Kinerja</th><th>Rp</th>
            <th>Daerah</th><th>Nasional</th>
            <th>Kinerja</th><th>Rp</th>
          </tr>
        </thead>
        <tbody id="renjaBody"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- ============ MODAL: KEGIATAN ============ -->
<div class="modal-backdrop-custom" id="modalKegiatan">
  <div class="modal-custom">
    <div class="modal-head">
      <h2>KEGIATAN RENJA PD</h2>
      <button class="modal-close-btn" data-close="modalKegiatan" aria-label="Tutup">
        <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4l12 12M16 4L4 16"/></svg>
      </button>
    </div>
    <div class="modal-tabs"><div class="modal-tab">Info Detail</div></div>
    <div class="modal-body-custom">
      <div class="field">
        <label>Kegiatan <span class="req">*</span></label>
        <input type="text" id="kegModalLabel" readonly>
      </div>
      <div class="row-2">
        <div class="field" style="grid-column:1 / span 2;">
          <label>Indikator Kegiatan <span class="req">*</span></label>
          <textarea id="kegIndikator" placeholder="Contoh: Jumlah dokumen ..."></textarea>
        </div>
      </div>
      <div class="row-2">
        <div class="field">
          <label>Target <span class="req">*</span></label>
          <input type="text" id="kegTarget" placeholder="0">
        </div>
        <div class="field">
          <label>Satuan <span class="req">*</span></label>
          <input type="text" id="kegSatuan" placeholder="Dokumen / Laporan / Unit">
        </div>
      </div>
      <div class="field">
        <label>Kelompok Sasaran</label>
        <input type="text" id="kegKelompokSasaran" placeholder="Contoh: D/Sekperind">
      </div>
      <div class="field">
        <label>Prioritas Nasional <span class="req">*</span></label>
        <select id="kegPrioritasNasional"></select>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn-custom btn-cancel-custom" data-close="modalKegiatan">Batal</button>
      <button class="btn-custom btn-primary-custom" id="btnSaveKegiatan">
        <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg>
        Simpan Perubahan
      </button>
    </div>
  </div>
</div>

<!-- ============ MODAL: SUB KEGIATAN ============ -->
<div class="modal-backdrop-custom" id="modalSubKegiatan">
  <div class="modal-custom">
    <div class="modal-head">
      <h2>SUB KEGIATAN RENJA PD</h2>
      <button class="modal-close-btn" data-close="modalSubKegiatan" aria-label="Tutup">
        <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4l12 12M16 4L4 16"/></svg>
      </button>
    </div>
    <div class="modal-body-custom">
      <div class="field">
        <label>Sub Kegiatan <span class="req">*</span></label>
        <input type="text" id="subModalLabel" readonly>
      </div>
      <div class="row-2">
        <div class="field">
          <label>Prioritas Pembangunan Provinsi</label>
          <select id="subPrioritasProvinsi"></select>
        </div>
        <div class="field">
          <label>Prioritas Pembangunan Kota/Kabupaten</label>
          <select id="subPrioritasKabKota"></select>
        </div>
      </div>
      <div class="row-2">
        <div class="field">
          <label>Sumber Dana</label>
          <select id="subSumberDana"></select>
        </div>
        <div class="field">
          <label>Lokasi Pelaksanaan Kegiatan</label>
          <select id="subLokasiPelaksanaan"></select>
        </div>
      </div>
      <div class="field">
        <label>Rincian Lokasi</label>
        <div class="row-3">
          <input type="text" id="subKabKota" class="form-control" readonly style="background:#f1f5f9; cursor:not-allowed; font-weight:500;" placeholder="Kabupaten/Kota">
          <select id="subKecamatan"><option value="">Pilih Kecamatan</option></select>
          <select id="subDesa"><option value="">Pilih Desa/Kelurahan</option></select>
        </div>
      </div>
      <div class="field">
        <label>Waktu Pelaksanaan</label>
        <div class="waktu-row">
          <select id="subBulanMulai"></select>
          <span class="waktu-sd">S/D</span>
          <select id="subBulanSelesai"></select>
        </div>
      </div>
      <div class="field">
        <label>Anggaran Sub Kegiatan</label>
        <div class="rp-input-wrap"><span class="rp-prefix">Rp</span><input type="text" id="subAnggaran" placeholder="Masukkan anggaran sub kegiatan"></div>
      </div>
      <div class="row-2">
        <div class="field">
          <label>Anggaran N+1 Sub Kegiatan</label>
          <div class="rp-input-wrap"><span class="rp-prefix">Rp</span><input type="text" id="subAnggaranN1" placeholder="Masukkan anggaran N+1"></div>
        </div>
        <div class="field">
          <label>Anggaran N+2 Sub Kegiatan</label>
          <div class="rp-input-wrap"><span class="rp-prefix">Rp</span><input type="text" id="subAnggaranN2" placeholder="Masukkan anggaran N+2"></div>
        </div>
      </div>
      <div class="field">
        <label>Indikator Keluaran Sub Kegiatan</label>
        <div class="row-3">
          <input type="text" id="subIndikatorUraian" placeholder="Uraian indikator" style="grid-column:1 / span 1;">
          <input type="text" id="subIndikatorTarget" placeholder="Target">
          <input type="text" id="subIndikatorSatuan" placeholder="Satuan">
        </div>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn-custom btn-cancel-custom" data-close="modalSubKegiatan">Batal</button>
      <button class="btn-custom btn-primary-custom" id="btnSaveSubKegiatan">
        <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg>
        Simpan
      </button>
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
    "Cikarang Utara": ["Karangasih","Sertajaya","Simpangan"],
    "Cikarang Pusat": ["Pasirtanjung","Hegarmukti","Jayamukti"]
  }
};

/* =========================================================================
   DATA RENJA PERANGKAT DAERAH (DARI RENSTRA PD)
   ========================================================================= */
let renjaData = <?= $RenjaJson ?: '{}' ?>;

/* =========================================================================
   HELPER UMUM
   ========================================================================= */
function esc(str){
  if(str === undefined || str === null) return '';
  return String(str).replace(/[&<>"']/g, function(s){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[s];
  });
}
function fmtRp(val){
  if(val === undefined || val === null || val === "" || val === "-") return "-";
  const num = String(val).replace(/[^\d]/g,"");
  if(num === "") return "-";
  return "Rp " + Number(num).toLocaleString("id-ID");
}
function formatRibuan(val){
  const num = String(val || "").replace(/[^\d]/g,'');
  if(!num) return '';
  return Number(num).toLocaleString('id-ID');
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
function sumProgramRp(p){
  return (p.kegiatan || []).reduce(function(total, k){
    return total + sumKegiatanRp(k);
  }, 0);
}
function sumBidangRp(b){
  return (b.program || []).reduce(function(total, p){
    return total + sumProgramRp(p);
  }, 0);
}
function sumUrusanRp(u){
  return (u.bidang || []).reduce(function(total, b){
    return total + sumBidangRp(b);
  }, 0);
}
function sumTotalRp(){
  return (renjaData.urusan || []).reduce(function(total, u){
    return total + sumUrusanRp(u);
  }, 0);
}

/* Perkiraan Maju Anggaran (N+1) */
function sumKegiatanMajuRp(k){
  return (k.subKegiatan || []).reduce(function(total, sk){
    return total + toNumber(sk.anggaranN1);
  }, 0);
}
function sumProgramMajuRp(p){
  return (p.kegiatan || []).reduce(function(total, k){
    return total + sumKegiatanMajuRp(k);
  }, 0);
}
function sumBidangMajuRp(b){
  return (b.program || []).reduce(function(total, p){
    return total + sumProgramMajuRp(p);
  }, 0);
}
function sumUrusanMajuRp(u){
  return (u.bidang || []).reduce(function(total, b){
    return total + sumBidangMajuRp(b);
  }, 0);
}

/* =========================================================================
   LOKASI & SUMBER PENDANAAN BERJENJANG
   ========================================================================= */
function uniqueValues(list){
  const out = [];
  list.forEach(function(v){
    if(v && v !== '-' && out.indexOf(v) === -1) out.push(v);
  });
  return out;
}
function stripKodeWilayah(str){
  if(!str) return '';
  return str.replace(/^[\d\.]+\s*-\s*/, '').replace(/\s*\([\d\.]+\)$/, '').trim();
}
function subKegiatanLokasiText(sk){
  const desa = stripKodeWilayah(sk.desa);
  const kec = stripKodeWilayah(sk.kecamatan);
  const kab = stripKodeWilayah(sk.kabKota);
  if(desa && kec && kab) return kab + ', Kec. ' + kec + ', ' + desa;
  if(kec && kab) return kab + ', Kec. ' + kec;
  if(kab) return kab;
  if(sk.lokasi) return stripKodeWilayah(sk.lokasi);
  return '';
}
function kegiatanLokasi(k){
  const list = (k.subKegiatan || []).map(subKegiatanLokasiText);
  const unik = uniqueValues(list);
  return unik.length ? unik.join(' / ') : '-';
}
function kegiatanSumberDana(k){
  const list = (k.subKegiatan || []).map(function(sk){ return sk.sumberDana; });
  const unik = uniqueValues(list);
  return unik.length ? unik.join(', ') : '-';
}
function programLokasi(p){
  const list = (p.kegiatan || []).map(kegiatanLokasi).filter(function(v){ return v !== '-'; });
  const unik = uniqueValues(list);
  return unik.length ? unik.join(' / ') : '-';
}
function programSumberDana(p){
  const list = (p.kegiatan || []).map(kegiatanSumberDana).filter(function(v){ return v !== '-'; });
  const unik = uniqueValues(list);
  return unik.length ? unik.join(', ') : '-';
}

const PENCIL_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M13.5 2.5l4 4L7 17H3v-4L13.5 2.5z"/></svg>';

/* =========================================================================
   PENCARIAN DATA
   ========================================================================= */
function findKegiatan(id){
  if(!renjaData.urusan) return null;
  for(const u of renjaData.urusan){
    for(const b of (u.bidang || [])){
      for(const p of (b.program || [])){
        const k = (p.kegiatan || []).find(function(x){ return x.id === id || x.db_id == id; });
        if(k) return { kegiatan:k, program:p, bidang:b, urusan:u };
      }
    }
  }
  return null;
}
function findSubKegiatan(id, parentId){
  const found = findKegiatan(parentId);
  if(!found) return null;
  const sk = (found.kegiatan.subKegiatan || []).find(function(x){ return x.id === id || x.db_id == id; });
  return sk ? { subKegiatan:sk, kegiatan:found.kegiatan } : null;
}

/* =========================================================================
   SINKRONISASI TINGGI HEADER TABEL
   ========================================================================= */
function syncHeadRowHeight(){
  const wrap = document.querySelector('.table-wrap');
  const firstHeadRow = document.querySelector('.table-renja-main thead tr:first-child');
  if(!wrap || !firstHeadRow) return;
  const h = firstHeadRow.getBoundingClientRect().height;
  if(h > 0){
    wrap.style.setProperty('--head-row-h', h + 'px');
  }
}
window.addEventListener('load', syncHeadRowHeight);
window.addEventListener('resize', syncHeadRowHeight);

/* =========================================================================
   COLLAPSE / ACCORDION
   ========================================================================= */
const collapsedKeys = new Set();
const AUTO_COLLAPSE_THRESHOLD = 40;

function chevronIcon(collapsed){
  return '<svg class="chevron' + (collapsed ? ' collapsed' : '') + '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8l4 4 4-4"/></svg>';
}
function countUrusanRows(u){
  let program = 0, kegiatan = 0, sub = 0;
  (u.bidang || []).forEach(function(b){
    (b.program || []).forEach(function(p){
      program++;
      (p.kegiatan || []).forEach(function(k){
        kegiatan++;
        sub += (k.subKegiatan || []).length;
      });
    });
  });
  return { program:program, kegiatan:kegiatan, sub:sub };
}
function countProgramRows(p){
  let kegiatan = 0, sub = 0;
  (p.kegiatan || []).forEach(function(k){
    kegiatan++;
    sub += (k.subKegiatan || []).length;
  });
  return { kegiatan:kegiatan, sub:sub };
}
function totalDataRowCount(){
  let total = 0;
  (renjaData.urusan || []).forEach(function(u){
    (u.bidang || []).forEach(function(b){
      (b.program || []).forEach(function(p){
        total++;
        (p.kegiatan || []).forEach(function(k){
          total++;
          total += (k.subKegiatan || []).length;
        });
      });
    });
  });
  return total;
}
function applyAutoCollapseIfNeeded(){
  if(totalDataRowCount() <= AUTO_COLLAPSE_THRESHOLD) return;
  (renjaData.urusan || []).forEach(function(u){
    (u.bidang || []).forEach(function(b){
      (b.program || []).forEach(function(p){
        collapsedKeys.add('p:' + p.kode);
      });
    });
  });
}
function toggleCollapse(key){
  if(collapsedKeys.has(key)) collapsedKeys.delete(key);
  else collapsedKeys.add(key);
  renderTable();
}
function expandAll(){
  collapsedKeys.clear();
  renderTable();
}
function collapseAll(){
  (renjaData.urusan || []).forEach(function(u){ collapsedKeys.add('u:' + u.kode); });
  renderTable();
}

/* =========================================================================
   UPDATE PARSIAL BARIS
   ========================================================================= */
function replaceRow(selector, html){
  const el = document.querySelector(selector);
  if(!el) return false;
  el.outerHTML = html;
  return true;
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
    labelEl.textContent = 'Selisih Pagu';
    valueEl.textContent = 'Rp 0';
    subEl.textContent = 'Anggaran terinput sudah sesuai/pas dengan pagu';
  } else if(selisih > 0){
    item.classList.add('status-remaining');
    labelEl.textContent = 'Sisa Pagu Belum Terinput';
    valueEl.textContent = fmtRp(selisih);
    subEl.textContent = 'Belum dialokasikan ke Sub Kegiatan';
  } else {
    item.classList.add('status-over');
    labelEl.textContent = 'Kelebihan dari Pagu';
    valueEl.textContent = '-' + fmtRp(Math.abs(selisih));
    subEl.textContent = 'Anggaran terinput melebihi pagu, mohon disesuaikan';
  }
}

/* =========================================================================
   RENDER TABEL
   ========================================================================= */
function renderTable(){
  const rows = [];

  rows.push('<tr class="row-pd"><td colspan="15">' + esc(renjaData.perangkatDaerah || 'PERANGKAT DAERAH') + '</td></tr>');

  rows.push(sectionRow('Tujuan Perangkat Daerah'));
  if (renjaData.tujuan && renjaData.tujuan.length > 0) {
    renjaData.tujuan.forEach(function(t){
      (t.indikator || []).forEach(function(ind, idx){
        rows.push(uraianRow('tujuan', idx === 0 ? t.uraian : null, idx === 0 ? t.indikator.length : 0, ind));
      });
    });
  } else {
    rows.push('<tr><td></td><td colspan="14" class="text-muted" style="font-style:italic; padding:10px 14px;">Belum ada data Tujuan pada Renstra Perangkat Daerah ini.</td></tr>');
  }

  rows.push(sectionRow('Sasaran Perangkat Daerah'));
  if (renjaData.sasaran && renjaData.sasaran.length > 0) {
    renjaData.sasaran.forEach(function(s){
      (s.indikator || []).forEach(function(ind, idx){
        rows.push(uraianRow('sasaran', idx === 0 ? s.uraian : null, idx === 0 ? s.indikator.length : 0, ind));
      });
    });
  } else {
    rows.push('<tr><td></td><td colspan="14" class="text-muted" style="font-style:italic; padding:10px 14px;">Belum ada data Sasaran pada Renstra Perangkat Daerah ini.</td></tr>');
  }

  if (renjaData.urusan && renjaData.urusan.length > 0) {
    renjaData.urusan.forEach(function(u){
      rows.push(urusanRow(u));
      if(collapsedKeys.has('u:' + u.kode)) return;
      (u.bidang || []).forEach(function(b){
        rows.push(bidangRow(b));
        (b.program || []).forEach(function(p){
          rows.push(programRow(p));
          if(collapsedKeys.has('p:' + p.kode)) return;
          (p.kegiatan || []).forEach(function(k){
            rows.push(kegiatanRow(k));
            (k.subKegiatan || []).forEach(function(sk){
              rows.push(subKegiatanRow(sk, k));
            });
          });
        });
      });
    });
  } else {
    rows.push('<tr><td></td><td colspan="14" class="text-muted" style="font-style:italic; padding:10px 14px;">Belum ada data Urusan / Program / Kegiatan pada Renstra Perangkat Daerah ini.</td></tr>');
  }

  document.getElementById('renjaBody').innerHTML = rows.join('');
  renderPaguSummary();
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

function renderColBadge(diffObj, fieldName){
  if (!diffObj || !diffObj.fields || !diffObj.fields[fieldName]) return '';
  const f = diffObj.fields[fieldName];
  const oldVal = f.old !== undefined ? f.old : '';
  const title = 'Diubah di Rankhir RKPD' + (oldVal ? ('\nNilai semula di Renja: ' + oldVal) : '');
  return '<br><span class="badge-col-rkpd" title="' + esc(title) + '"><i class="fa fa-info-circle"></i> Diubah di RKPD</span>';
}

function kegiatanRow(k){
  const total = sumKegiatanRp(k);
  const totalMaju = sumKegiatanMajuRp(k);
  const pengampuNama = k.namaPengampu ? ('<br><span class="pengampu-name">@ ' + esc(k.namaPengampu) + '</span>') : '';
  const pengampuLabel = k.pengampu && k.pengampu !== '-' ? ('<strong>' + esc(k.pengampu) + '</strong>') : '-';

  return '<tr class="row-kegiatan" data-row-key="keg:' + esc(k.id) + '">' +
    '<td>' + esc(k.kode) + '</td>' +
    '<td class="cell-uraian"><span class="label-tag">Kegiatan:</span>' + esc(k.nama) + '</td>' +
    '<td>' + esc(k.indikator) + renderColBadge(k.rkpdDiff, 'indikator') + '</td>' +
    '<td class="text-center">' + esc(k.satuan) + renderColBadge(k.rkpdDiff, 'satuan') + '</td>' +
    '<td class="text-center">' + esc(k.target) + renderColBadge(k.rkpdDiff, 'target') + '</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Sub Kegiatan di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td class="cell-anggaran-auto" title="Digabung otomatis dari Lokasi seluruh Sub Kegiatan di bawahnya">' + esc(kegiatanLokasi(k)) + '</td>' +
    '<td class="text-center cell-anggaran-auto" title="Digabung otomatis dari Sumber Pendanaan seluruh Sub Kegiatan di bawahnya">' + esc(kegiatanSumberDana(k)) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasDaerah) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasNasional) + renderColBadge(k.rkpdDiff, 'prioritasNasional') + '</td>' +
    '<td>' + esc(k.kelompokSasaran) + renderColBadge(k.rkpdDiff, 'kelompokSasaran') + '</td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Sub Kegiatan di bawahnya (Anggaran N+1)">' + esc(fmtRpMaju(totalMaju)) + '</td>' +
    '<td class="cell-pengampu">' + pengampuLabel + pengampuNama + '</td>' +
    '<td class="text-center"><button class="btn btn-sm btn-warning btn-aksi" data-action="edit-kegiatan" data-id="' + k.id + '" title="Edit Kegiatan"><i class="fa fa-edit"></i></button></td>' +
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
    '<td>' + esc(sk.indikator) + renderColBadge(sk.rkpdDiff, 'indikator') + '</td>' +
    '<td class="text-center">' + esc(sk.satuan) + renderColBadge(sk.rkpdDiff, 'satuan') + '</td>' +
    '<td class="text-center">' + esc(sk.target) + renderColBadge(sk.rkpdDiff, 'target') + '</td>' +
    '<td class="text-right cell-anggaran-input" title="Anggaran diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(fmtRp(sk.rp)) + renderColBadge(sk.rkpdDiff, 'rp') + '</td>' +
    '<td class="cell-anggaran-input" title="Lokasi diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(lokasiText) + renderColBadge(sk.rkpdDiff, 'lokasi') + '</td>' +
    '<td class="text-center cell-anggaran-input" title="Sumber Pendanaan diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(sk.sumberDana || '-') + renderColBadge(sk.rkpdDiff, 'sumberDana') + '</td>' +
    '<td>' + esc(prioritasDaerahText) + renderColBadge(sk.rkpdDiff, 'prioritasDaerah') + '</td>' +
    '<td class="text-center">' + esc(k.prioritasNasional || '-') + renderColBadge(k.rkpdDiff, 'prioritasNasional') + '</td>' +
    '<td>' + esc(k.kelompokSasaran || '-') + renderColBadge(k.rkpdDiff, 'kelompokSasaran') + '</td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-input" title="Anggaran N+1 diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(fmtRpMaju(sk.anggaranN1)) + renderColBadge(sk.rkpdDiff, 'anggaranN1') + '</td>' +
    '<td class="cell-pengampu">' + pengampuLabel + pengampuNama + '</td>' +
    '<td class="text-center"><button class="btn btn-sm btn-warning btn-aksi" data-action="edit-subkegiatan" data-id="' + sk.id + '" data-parent="' + k.id + '" title="Edit Sub Kegiatan"><i class="fa fa-edit"></i></button></td>' +
    '</tr>';
}

/* =========================================================================
   MODAL: KEGIATAN
   ========================================================================= */
let currentKegiatanId = null;

function openKegiatanModal(id){
  const found = findKegiatan(id);
  if(!found) return;
  currentKegiatanId = id;
  const k = found.kegiatan;
  document.getElementById('kegModalLabel').value = k.kode + '  ' + k.nama;
  document.getElementById('kegIndikator').value = (k.indikator && k.indikator !== '-') ? k.indikator : '';
  document.getElementById('kegTarget').value = (k.target && k.target !== '-') ? k.target : '';
  document.getElementById('kegSatuan').value = (k.satuan && k.satuan !== '-') ? k.satuan : '';
  document.getElementById('kegKelompokSasaran').value = (k.kelompokSasaran && k.kelompokSasaran !== '-') ? k.kelompokSasaran : '';
  const selPN = document.getElementById('kegPrioritasNasional');
  const targetPN = (k.prioritasNasional && k.prioritasNasional !== '-') ? k.prioritasNasional : '';
  if (targetPN && !Array.from(selPN.options).some(function(o){ return o.value === targetPN; })) {
    selPN.add(new Option(targetPN, targetPN));
  }
  selPN.value = targetPN;

  showModal('modalKegiatan');
}

function saveKegiatan(){
  const found = findKegiatan(currentKegiatanId);
  if(!found) return;
  const indikator = document.getElementById('kegIndikator').value.trim();
  const target = document.getElementById('kegTarget').value.trim();
  const satuan = document.getElementById('kegSatuan').value.trim();
  const prioritasNasional = document.getElementById('kegPrioritasNasional').value;
  const kelompokSasaran = document.getElementById('kegKelompokSasaran').value.trim();

  if(!indikator || !target || !satuan || !prioritasNasional){
    showToast('Mohon lengkapi seluruh field bertanda (*) sebelum menyimpan.', 'error');
    return;
  }

  const k = found.kegiatan;
  k.indikator = indikator;
  k.target = target;
  k.satuan = satuan;
  k.kelompokSasaran = kelompokSasaran || '-';
  k.prioritasNasional = prioritasNasional;
  k.rkpdDiff = { is_modified: false, fields: {} };

  // AJAX POST ke Server
  const dbId = k.db_id || k.id.replace('keg-', '');
  showLoading(true);

  const fd = new FormData();
  fd.append('kegiatan_id', dbId);
  fd.append('tahun', renjaData.tahunAktif || 2026);
  fd.append('indikator', indikator);
  fd.append('target', target);
  fd.append('satuan', satuan);
  fd.append('prioritas_nasional', prioritasNasional);
  fd.append('kelompok_sasaran', kelompokSasaran);
  fd.append('instansi_id', activeInstansiId);

  fetch(BASE_URL + 'Instansi/simpanRancanganAkhirRenjaKegiatan', {
    method: 'POST',
    body: fd,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    showLoading(false);
    if(data.status === 'success'){
      hideModal('modalKegiatan');
      showToast(data.message || 'Data Kegiatan berhasil disimpan.');
      setTimeout(function(){
        window.location.reload();
      }, 500);
    } else {
      showToast(data.message || 'Gagal menyimpan data Kegiatan.', 'error');
    }
  })
  .catch(function(err){
    showLoading(false);
    console.error(err);
    hideModal('modalKegiatan');
    showToast('Data Kegiatan disimpan di tampilan lokal.');
    setTimeout(function(){
      window.location.reload();
    }, 500);
  });
}

/* =========================================================================
   MODAL: SUB KEGIATAN
   ========================================================================= */
let currentSubId = null;
let currentSubParentId = null;

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

function openSubKegiatanModal(id, parentId){
  const found = findSubKegiatan(id, parentId);
  if(!found) return;
  currentSubId = id;
  currentSubParentId = parentId;
  const sk = found.subKegiatan;

  document.getElementById('subModalLabel').value = sk.kode + '  ' + sk.nama;

  populateKabKota();
  populateKecamatan(CURRENT_KODE_WILAYAH, sk.kecamatan || '', function(){
    const selKec = document.getElementById('subKecamatan');
    const valKec = selKec.value;
    if(valKec){
      populateDesa(valKec, sk.desa || '');
    }
  });

  const selPP = document.getElementById('subPrioritasProvinsi');
  const targetPP = (sk.prioritasProvinsi && sk.prioritasProvinsi !== '-') ? sk.prioritasProvinsi : '';
  if (targetPP && !Array.from(selPP.options).some(function(o){ return o.value === targetPP; })) {
    selPP.add(new Option(targetPP, targetPP));
  }
  selPP.value = targetPP;

  const selPK = document.getElementById('subPrioritasKabKota');
  const targetPK = (sk.prioritasKabKota && sk.prioritasKabKota !== '-') ? sk.prioritasKabKota : '';
  if (targetPK && !Array.from(selPK.options).some(function(o){ return o.value === targetPK; })) {
    selPK.add(new Option(targetPK, targetPK));
  }
  selPK.value = targetPK;

  document.getElementById('subSumberDana').value = sk.sumberDana || '';
  document.getElementById('subLokasiPelaksanaan').value = sk.lokasiPelaksanaan || '';

  document.getElementById('subBulanMulai').value = sk.bulanMulai || '';
  document.getElementById('subBulanSelesai').value = sk.bulanSelesai || '';

  document.getElementById('subAnggaran').value = (sk.rp && sk.rp !== '-' && sk.rp !== '0') ? formatRibuan(sk.rp) : '';
  document.getElementById('subAnggaranN1').value = (sk.anggaranN1 && sk.anggaranN1 !== '-' && sk.anggaranN1 !== '0') ? formatRibuan(sk.anggaranN1) : '';
  document.getElementById('subAnggaranN2').value = (sk.anggaranN2 && sk.anggaranN2 !== '-' && sk.anggaranN2 !== '0') ? formatRibuan(sk.anggaranN2) : '';

  document.getElementById('subIndikatorUraian').value = (sk.indikator && sk.indikator !== '-') ? sk.indikator : '';
  document.getElementById('subIndikatorTarget').value = (sk.target && sk.target !== '-') ? sk.target : '';
  document.getElementById('subIndikatorSatuan').value = (sk.satuan && sk.satuan !== '-') ? sk.satuan : '';

  showModal('modalSubKegiatan');
}

function saveSubKegiatan(){
  const found = findSubKegiatan(currentSubId, currentSubParentId);
  if(!found) return;
  const sk = found.subKegiatan;
  const k = found.kegiatan;

  sk.prioritasProvinsi = document.getElementById('subPrioritasProvinsi').value;
  sk.prioritasKabKota = document.getElementById('subPrioritasKabKota').value;
  sk.sumberDana = document.getElementById('subSumberDana').value;
  sk.lokasiPelaksanaan = document.getElementById('subLokasiPelaksanaan').value;
  sk.kabKota = document.getElementById('subKabKota').value;
  sk.kecamatan = document.getElementById('subKecamatan').value;
  sk.desa = document.getElementById('subDesa').value;
  sk.bulanMulai = document.getElementById('subBulanMulai').value;
  sk.bulanSelesai = document.getElementById('subBulanSelesai').value;
  sk.rp = document.getElementById('subAnggaran').value.replace(/\./g, '');
  sk.anggaranN1 = document.getElementById('subAnggaranN1').value.replace(/\./g, '');
  sk.anggaranN2 = document.getElementById('subAnggaranN2').value.replace(/\./g, '');

  sk.indikator = document.getElementById('subIndikatorUraian').value.trim() || '-';
  sk.target = document.getElementById('subIndikatorTarget').value.trim() || '0';
  sk.satuan = document.getElementById('subIndikatorSatuan').value.trim() || 'Laporan';
  sk.kinerja = sk.target;
  sk.rkpdDiff = { is_modified: false, fields: {} };

  // AJAX POST ke Server
  const dbId = sk.db_id || sk.id.replace('sub-', '');
  showLoading(true);

  const fd = new FormData();
  fd.append('sub_kegiatan_id', dbId);
  fd.append('tahun', renjaData.tahunAktif || 2026);
  fd.append('prioritas_provinsi', sk.prioritasProvinsi);
  fd.append('prioritas_kabkota', sk.prioritasKabKota);
  fd.append('sumber_dana', sk.sumberDana);
  fd.append('lokasi_pelaksanaan', sk.lokasiPelaksanaan);
  fd.append('kab_kota', sk.kabKota);
  fd.append('kecamatan', sk.kecamatan);
  fd.append('desa', sk.desa);
  fd.append('bulan_mulai', sk.bulanMulai);
  fd.append('bulan_selesai', sk.bulanSelesai);
  fd.append('anggaran', sk.rp);
  fd.append('anggaran_n1', sk.anggaranN1);
  fd.append('anggaran_n2', sk.anggaranN2);
  fd.append('indikator', sk.indikator);
  fd.append('target', sk.target);
  fd.append('satuan', sk.satuan);
  fd.append('instansi_id', activeInstansiId);

  fetch(BASE_URL + 'Instansi/simpanRancanganAkhirRenjaSubKegiatan', {
    method: 'POST',
    body: fd,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(data){
    showLoading(false);
    if(data.status === 'success'){
      hideModal('modalSubKegiatan');
      showToast(data.message || 'Data Sub Kegiatan berhasil disimpan.');
      setTimeout(function(){
        window.location.reload();
      }, 500);
    } else {
      showToast(data.message || 'Gagal menyimpan data Sub Kegiatan.', 'error');
    }
  })
  .catch(function(err){
    showLoading(false);
    console.error(err);
    hideModal('modalSubKegiatan');
    showToast('Data Sub Kegiatan disimpan di tampilan lokal.');
    setTimeout(function(){
      window.location.reload();
    }, 500);
  });
}

/* =========================================================================
   SERVER DATA LOADER
   ========================================================================= */
function loadRenjaDataServer(tahun, instansiId){
  showLoading(true);
  let url = BASE_URL + 'Instansi/getRancanganAkhirRenjaPDJson?tahun=' + encodeURIComponent(tahun);
  if(instansiId) url += '&instansi_id=' + encodeURIComponent(instansiId);
  
  fetch(url, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(function(res){ return res.json(); })
  .then(function(json){
    showLoading(false);
    if(json.status === 'success' && json.data){
      renjaData = json.data;
      populateStaticOptions();
      renderTable();
      showToast('Data Rancangan Akhir Renja TA ' + tahun + ' berhasil dimuat.');
    }
  })
  .catch(function(err){
    showLoading(false);
    console.error(err);
    renderTable();
  });
}

/* =========================================================================
   MODAL UTIL
   ========================================================================= */
function showModal(id){
  document.getElementById(id).classList.add('open');
  document.body.style.overflow = 'hidden';
}
function hideModal(id){
  document.getElementById(id).classList.remove('open');
  document.body.style.overflow = '';
}

/* =========================================================================
   TOAST & LOADING
   ========================================================================= */
let toastTimer = null;
function showToast(msg, type){
  const el = document.getElementById('toast');
  el.textContent = msg;
  el.className = 'toast-custom show ' + (type === 'error' ? 'toast-error' : 'toast-success');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(function(){ el.classList.remove('show'); }, 3200);
}
function showLoading(show){
  const el = document.getElementById('loadingShade');
  if(show) el.classList.add('active');
  else el.classList.remove('active');
}

/* =========================================================================
   DROPDOWN STATIS & DARI TEMA PEMBANGUNAN
   ========================================================================= */
function populateStaticOptions(){
  const pnList = (renjaData && renjaData.prioritasNasionalList && renjaData.prioritasNasionalList.length > 0)
    ? renjaData.prioritasNasionalList
    : PRIORITAS_NASIONAL;

  const ppList = (renjaData && renjaData.prioritasProvinsiList && renjaData.prioritasProvinsiList.length > 0)
    ? renjaData.prioritasProvinsiList
    : PRIORITAS_PROVINSI;

  const pkList = (renjaData && renjaData.prioritasKabKotaList && renjaData.prioritasKabKotaList.length > 0)
    ? renjaData.prioritasKabKotaList
    : PRIORITAS_KABKOTA;

  document.getElementById('kegPrioritasNasional').innerHTML =
    '<option value="">Pilih Prioritas Nasional</option>' +
    pnList.map(function(p){ return '<option value="' + esc(p) + '">' + esc(p) + '</option>'; }).join('');

  document.getElementById('subPrioritasProvinsi').innerHTML =
    '<option value="">Pilih Prioritas Pembangunan Provinsi</option>' +
    ppList.map(function(p){ return '<option value="' + esc(p) + '">' + esc(p) + '</option>'; }).join('');

  document.getElementById('subPrioritasKabKota').innerHTML =
    '<option value="">Pilih Prioritas Pembangunan Kota/Kabupaten</option>' +
    pkList.map(function(p){ return '<option value="' + esc(p) + '">' + esc(p) + '</option>'; }).join('');

  document.getElementById('subSumberDana').innerHTML =
    '<option value="">Pilih Sumber Dana</option>' +
    SUMBER_DANA.map(function(s){ return '<option value="' + esc(s) + '">' + esc(s) + '</option>'; }).join('');

  document.getElementById('subLokasiPelaksanaan').innerHTML =
    '<option value="">Pilih Lokasi Pelaksanaan Kegiatan</option>' +
    LOKASI_PELAKSANAAN.map(function(s){ return '<option value="' + esc(s) + '">' + esc(s) + '</option>'; }).join('');

  document.getElementById('subBulanMulai').innerHTML =
    '<option value="">Pilih Bulan Mulai</option>' +
    BULAN.map(function(b){ return '<option value="' + esc(b) + '">' + esc(b) + '</option>'; }).join('');

  document.getElementById('subBulanSelesai').innerHTML =
    '<option value="">Pilih Bulan Selesai</option>' +
    BULAN.map(function(b){ return '<option value="' + esc(b) + '">' + esc(b) + '</option>'; }).join('');
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
  renderTable();
  syncHeadRowHeight();

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
  ['subAnggaran','subAnggaranN1','subAnggaranN2'].forEach(function(id){
    document.getElementById(id).addEventListener('input', function(e){
      e.target.value = formatRibuan(e.target.value);
    });
  });

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

  // Sinkronisasi Ulang Data Rancangan Akhir dengan Rancangan Renja
  const btnSync = document.getElementById('btnSyncData');
  if(btnSync){
    btnSync.addEventListener('click', function(){
      const y = renjaData.tahunAktif || 2026;
      if(!confirm('Apakah Anda yakin ingin menyinkronkan ulang data Rancangan Akhir Renja Tahun ' + y + ' dengan data Rancangan Renja?\n\nData Rancangan Akhir tahun ' + y + ' akan dicocokkan kembali mengambil data terbaru dari Rancangan Renja.')){
        return;
      }
      showLoading(true);
      const fd = new FormData();
      fd.append('tahun', y);
      fd.append('instansi_id', activeInstansiId);
      
      fetch(BASE_URL + 'Instansi/resetRancanganAkhirRenjaDataFromRancangan', {
        method: 'POST',
        body: fd,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(function(res){ return res.json(); })
      .then(function(data){
        showLoading(false);
        if(data.status === 'success'){
          showToast(data.message || 'Sinkronisasi berhasil.');
          setTimeout(function(){
            window.location.reload();
          }, 500);
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
            let redirectUrl = BASE_URL + 'Instansi/RancanganAkhirRenjaPD';
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
        let redirectUrl = BASE_URL + 'Instansi/RancanganAkhirRenjaPD?tahun=' + encodeURIComponent(tahun);
        if (val) redirectUrl += '&instansi_id=' + encodeURIComponent(val);
        window.location.href = redirectUrl;
      });
    }
  <?php } ?>
});
</script>
</body>
</html>