<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perubahan Renja Perangkat Daerah</title>
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

  /* ---------- Topbar ---------- */
  .topbar{
    flex:none;
    background:#20c997;
    color:#fff;
    margin:0 0 14px 0;
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
    margin:0 0 14px 0;
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
    margin:0 0 14px 0;
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
    padding:11px 12px;
    letter-spacing:.4px;
    border-bottom:2px solid var(--brand-deep);
  }
  .row-tujuan td{
    background:var(--slate-200);
    font-weight:700;
    color:var(--slate-900);
  }
  .row-sasaran td{
    background:var(--slate-100);
    font-weight:600;
    color:var(--slate-800);
  }
  .row-urusan td{
    background:#e0f2fe;
    font-weight:700;
    color:#0369a1;
  }
  .row-bidang td{
    background:#ecfeff;
    font-weight:600;
    color:#0e7490;
  }
  .row-program td{
    background:var(--brand-soft);
    font-weight:600;
    color:var(--brand-deep);
    border-top:1px solid var(--brand-border);
  }
  .row-kegiatan td{
    background:#ffffff;
    font-weight:600;
    color:var(--slate-800);
  }
  .row-subkegiatan td{
    background:#ffffff;
    font-weight:400;
    color:var(--slate-700);
  }
  .row-subkegiatan:hover td{ background:var(--slate-50); }

  .cell-uraian{
    word-break:break-word;
  }
  .cell-uraian.sub{ padding-left:26px; position:relative; }
  .cell-uraian.sub::before{
    content:""; position:absolute; left:12px; top:14px;
    width:7px; height:7px; border-left:1.6px solid var(--brand-green);
    border-bottom:1.6px solid var(--brand-green);
  }

  .label-tag{
    display:inline-block; font-size:10px; font-weight:700; text-transform:uppercase;
    letter-spacing:.4px; padding:1px 5px; border-radius:4px; margin-right:6px; vertical-align:middle;
  }
  .row-tujuan .label-tag{ background:var(--slate-300); color:var(--slate-800); }
  .row-sasaran .label-tag{ background:var(--slate-200); color:var(--slate-700); }
  .row-urusan .label-tag{ background:#bae6fd; color:#0369a1; }
  .row-bidang .label-tag{ background:#cffafe; color:#0e7490; }
  .row-program .label-tag{ background:var(--brand-border); color:var(--brand-deep); }
  .row-kegiatan .label-tag{ background:#fed7aa; color:#9a3412; }
  .row-subkegiatan .label-tag{ background:#e2e8f0; color:#334155; }

  .cell-pengampu{
    font-size:11.5px;
    color:var(--slate-600);
    line-height:1.3;
  }
  .cell-pengampu strong{ color:var(--slate-800); }
  .pengampu-name{
    display:inline-block;
    color:var(--brand-dark);
    font-weight:600;
    font-size:11px;
    margin-top:2px;
  }

  /* Expand / collapse chevron button */
  .toggle-btn-inline{
    display:inline-flex; align-items:center; gap:6px; cursor:pointer; user-select:none;
  }
  .toggle-btn-inline svg{
    width:13px; height:13px; transition:transform .15s ease;
  }
  .toggle-btn-inline.collapsed svg{ transform:rotate(-90deg); }
  .collapse-badge{
    font-size:11px; font-weight:600; background:rgba(0,0,0,.06);
    color:var(--slate-600); padding:1px 7px; border-radius:10px; margin-left:6px;
  }

  .cell-anggaran-auto{
    background:rgba(32,201,151,.04);
    font-weight:600;
    color:var(--brand-dark);
  }
  .cell-anggaran-input{
    font-weight:600;
    color:var(--slate-900);
  }

  /* Badge indicator for changes vs Rankhir Renja */
  .badge-col-diff{
    display:inline-flex; align-items:center; gap:4px;
    font-size:10px; font-weight:700; color:#b45309;
    background:#fef3c7; border:1px solid #fde68a;
    padding:1px 6px; border-radius:4px; margin-top:3px;
    letter-spacing:.2px;
  }

  /* Toolbar Filter & Export */
  .renja-toolbar{
    display:flex; align-items:center; justify-content:space-between; gap:12px;
    margin:0 0 14px 0; flex-wrap:wrap;
  }
  .toolbar-left, .toolbar-right{
    display:flex; align-items:center; gap:8px; flex-wrap:wrap;
  }
  .search-box{
    position:relative; min-width:240px;
  }
  .search-box input{
    width:100%; padding:7px 12px 7px 32px; font-size:12.5px;
    border:1px solid var(--slate-300); border-radius:7px; outline:none;
    transition:border-color .15s; background:#fff;
  }
  .search-box input:focus{ border-color:var(--brand-green); box-shadow:0 0 0 2px var(--brand-soft); }
  .search-box svg{
    position:absolute; left:10px; top:50%; transform:translateY(-50%);
    width:14px; height:14px; color:var(--slate-400); pointer-events:none;
  }
  .btn-tb{
    display:inline-flex; align-items:center; gap:6px; padding:7px 12px;
    font-size:12px; font-weight:600; border-radius:7px; border:1px solid var(--slate-300);
    background:#fff; color:var(--slate-700); cursor:pointer; transition:all .15s;
  }
  .btn-tb:hover{ background:var(--slate-100); border-color:var(--slate-400); color:var(--slate-900); }
  .btn-tb.btn-tb-primary{ background:var(--brand-green); color:#fff; border-color:var(--brand-dark); }
  .btn-tb.btn-tb-primary:hover{ background:var(--brand-dark); }

  /* Modals */
  .modal-backdrop-custom{
    position:fixed; inset:0; background:rgba(15,23,42,.55);
    display:none; align-items:center; justify-content:center;
    z-index:9999; padding:20px;
  }
  .modal-backdrop-custom.active{ display:flex; }
  .modal-custom{
    background:#fff; border-radius:12px; box-shadow:var(--shadow-lg);
    width:100%; max-width:820px; max-height:90vh; display:flex; flex-direction:column;
    overflow:hidden; animation:popIn .2s ease-out;
  }
  @keyframes popIn{
    from{ opacity:0; transform:scale(.95); }
    to{ opacity:1; transform:scale(1); }
  }
  .modal-head{
    background:#20c997; color:#fff; padding:14px 20px;
    display:flex; align-items:center; justify-content:space-between;
  }
  .modal-head h2{ margin:0; font-size:15.5px; font-weight:700; color:#fff; }
  .modal-close-btn{
    background:none; border:none; color:rgba(255,255,255,.8); cursor:pointer;
    padding:4px; border-radius:4px; display:flex; align-items:center; justify-content:center;
  }
  .modal-close-btn:hover{ color:#fff; background:rgba(255,255,255,.18); }
  .modal-tabs{
    display:flex; border-bottom:1px solid var(--slate-200); background:var(--slate-50);
  }
  .modal-tab{
    padding:10px 18px; font-size:12.5px; font-weight:600; color:var(--brand-dark);
    border-bottom:2px solid var(--brand-dark); background:#fff;
  }
  .modal-body-custom{
    padding:18px 20px; overflow-y:auto; display:flex; flex-direction:column; gap:12px;
  }
  .field{ display:flex; flex-direction:column; gap:4px; }
  .field label{ font-size:11.5px; font-weight:600; color:var(--slate-700); }
  .field label .req{ color:var(--red-600); }
  .field input, .field select, .field textarea{
    padding:8px 11px; font-size:12.5px; border:1px solid var(--slate-300);
    border-radius:6px; outline:none; background:#fff; font-family:inherit;
    transition:border-color .15s;
  }
  .field input:focus, .field select:focus, .field textarea:focus{
    border-color:var(--brand-green); box-shadow:0 0 0 2px var(--brand-soft);
  }
  .field textarea{ resize:vertical; min-height:60px; }
  .field input[readonly]{ background:var(--slate-100); color:var(--slate-600); cursor:not-allowed; }
  .row-2{ display:grid; grid-template-columns:1fr 1fr; gap:12px; }
  .row-3{ display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px; }
  .waktu-row{ display:flex; align-items:center; gap:8px; }
  .waktu-sd{ font-size:11px; font-weight:700; color:var(--slate-500); }
  .modal-foot{
    padding:12px 20px; border-top:1px solid var(--slate-200); background:var(--slate-50);
    display:flex; justify-content:flex-end; gap:10px;
  }
  .btn-custom{
    padding:8px 16px; font-size:12.5px; font-weight:600; border-radius:6px;
    border:none; cursor:pointer; display:inline-flex; align-items:center; gap:6px;
  }
  .btn-cancel-custom{ background:var(--slate-200); color:var(--slate-700); }
  .btn-cancel-custom:hover{ background:var(--slate-300); }
  .btn-primary-custom{ background:var(--brand-green); color:#fff; }
  .btn-primary-custom:hover{ background:var(--brand-dark); }
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
          <h1>Perubahan Rencana Kerja Perangkat Daerah (Perubahan Renja PD)</h1>
          <span>Data Tujuan, Sasaran, Urusan, Bidang, dan Program bersumber dari Rankhir Renja Perangkat Daerah &mdash; menampilkan Perubahan Renja Tahun <b id="activeYearLabel"><?= html_escape($TahunAktif) ?></b></span>
        </div>

        <div class="topbar-controls">
          <select class="rpjmd-select" id="rpjmdSelect" aria-label="Periode RPJMD">
            <option value="2026-2030" selected>RPJMD 2026-2030 (Teknoktratik)</option>
          </select>

          <?php if (!$IsRole4): ?>
            <select class="instansi-select" id="instansiSelect" aria-label="Pilih Perangkat Daerah">
              <?php foreach ($ListInstansi as $inst): ?>
                <option value="<?= $inst['id'] ?>" <?= ($ActiveInstansiId == $inst['id']) ? 'selected' : '' ?>>
                  <?= html_escape($inst['nama']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          <?php endif; ?>

          <div class="year-tabs" role="tablist" aria-label="Pilihan Tahun">
            <?php 
            $tahun_list = [2026, 2027, 2028, 2029, 2030];
            foreach ($tahun_list as $t): 
            ?>
              <button type="button" class="year-tab <?= ($t == $TahunAktif) ? 'active' : '' ?>" data-year="<?= $t ?>">
                <?= $t ?>
              </button>
            <?php endforeach; ?>
          </div>

          <button type="button" class="btn-sync" id="btnSyncRenja" title="Sinkronkan / Cocokkan Ulang data Perubahan Renja dengan Rankhir Renja">
            <i class="fa fa-refresh"></i> Sinkronkan dengan Rankhir Renja
          </button>
        </div>
      </div>
    </div>

    <!-- ============ TOOLBAR FILTER & AKSI ============ -->
    <div class="renja-toolbar">
      <div class="toolbar-left">
        <div class="search-box">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
          <input type="text" id="filterInput" placeholder="Cari Kode, Program, Kegiatan, Sub Kegiatan...">
        </div>
        <button type="button" class="btn-tb" id="btnExpandAll" title="Buka Semua Program">
          <i class="fa fa-plus-square-o"></i> Buka Semua
        </button>
        <button type="button" class="btn-tb" id="btnCollapseAll" title="Tutup Semua Program">
          <i class="fa fa-minus-square-o"></i> Tutup Semua
        </button>
      </div>
      <div class="toolbar-right">
        <button type="button" class="btn-tb btn-tb-primary" id="btnExportExcel" title="Unduh format Excel">
          <i class="fa fa-file-excel-o"></i> Export Excel
        </button>
        <button type="button" class="btn-tb" id="btnCetak" title="Cetak / Simpan PDF">
          <i class="fa fa-print"></i> Cetak PDF
        </button>
      </div>
    </div>

    <!-- ============ RINGKASAN PAGU ============ -->
    <div class="pagu-summary">
      <div class="pagu-item">
        <div class="pagu-icon icon-pagu">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
        </div>
        <div class="pagu-text">
          <span class="pagu-label">Pagu Anggaran (Ditetapkan)</span>
          <span class="pagu-value" id="paguAnggaranValue">Rp 0</span>
          <span class="pagu-sub" id="paguRincianSub">Pagu Indikatif Perangkat Daerah</span>
        </div>
      </div>
      <div class="pagu-item">
        <div class="pagu-icon icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>
        </div>
        <div class="pagu-text">
          <span class="pagu-label">Total Anggaran Perubahan Renja (Terinput)</span>
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
            <th colspan="2">Perubahan Renja</th>
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
      <h2>KEGIATAN PERUBAHAN RENJA PD</h2>
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
      <h2>SUB KEGIATAN PERUBAHAN RENJA PD</h2>
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
      <div class="row-2">
        <div class="field">
          <label>Target <span class="req">*</span></label>
          <input type="text" id="subTarget" placeholder="0">
        </div>
        <div class="field">
          <label>Satuan <span class="req">*</span></label>
          <input type="text" id="subSatuan" placeholder="Dokumen / Laporan">
        </div>
      </div>
      <div class="field">
        <label>Indikator Sub Kegiatan <span class="req">*</span></label>
        <textarea id="subIndikator" placeholder="Contoh: Jumlah dokumen hasil fasilitasi ..."></textarea>
      </div>
      <div class="field">
        <label>Anggaran (Rp) <span class="req">*</span></label>
        <input type="text" id="subAnggaran" placeholder="0">
      </div>
      <div class="row-2">
        <div class="field">
          <label>Prakiraan Maju N+1 (Rp)</label>
          <input type="text" id="subAnggaranN1" placeholder="0">
        </div>
        <div class="field">
          <label>Prakiraan Maju N+2 (Rp)</label>
          <input type="text" id="subAnggaranN2" placeholder="0">
        </div>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn-custom btn-cancel-custom" data-close="modalSubKegiatan">Batal</button>
      <button class="btn-custom btn-primary-custom" id="btnSaveSubKegiatan">
        <svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg>
        Simpan Perubahan
      </button>
    </div>
  </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';
let DATA_RENJA = <?= !empty($RenjaJson) ? $RenjaJson : '{}' ?>;
let CURRENT_TAHUN = <?= (int)$TahunAktif ?>;
let ACTIVE_INSTANSI_ID = <?= $ActiveInstansiId ? (int)$ActiveInstansiId : 'null' ?>;

const BULAN_LIST = [
  "Januari", "Februari", "Maret", "April", "Mei", "Juni",
  "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

const SUMBER_DANA_LIST = [
  "PENDAPATAN ASLI DAERAH (PAD)",
  "DANA ALOKASI UMUM (DAU)",
  "DANA ALOKASI KHUSUS (DAK) FISIK",
  "DANA ALOKASI KHUSUS (DAK) NON FISIK",
  "DANA BAGI HASIL (DBH)",
  "DANA DESA",
  "PINJAMAN DAERAH",
  "LAIN-LAIN PENDAPATAN DAERAH YANG SAH"
];

const LOKASI_PELAKSANAAN_LIST = [
  "Kabupaten/Kota",
  "Kecamatan",
  "Desa/Kelurahan",
  "Semua Wilayah",
  "Luar Daerah"
];

const collapsedKeys = new Set();
let cachedKecamatan = [];

/* =========================================================================
   INIT & UTILITIES
   ========================================================================= */
document.addEventListener('DOMContentLoaded', () => {
  renderTable();
  updatePaguSummary();
  bindEvents();
  initFilterWilayah();
});

function esc(str){
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function parseRp(v){
  if (typeof v === 'number') return v;
  if (!v) return 0;
  const cleaned = String(v).replace(/[^0-9,-]/g, '').replace(',', '.');
  const num = parseFloat(cleaned);
  return isNaN(num) ? 0 : num;
}

function fmtRp(v){
  const n = parseRp(v);
  return 'Rp ' + Math.round(n).toLocaleString('id-ID');
}

function fmtRpMaju(v){
  const n = parseRp(v);
  if (n === 0) return '-';
  return 'Rp ' + Math.round(n).toLocaleString('id-ID');
}

function chevronIcon(collapsed){
  return '<svg class="' + (collapsed ? 'collapsed' : '') + '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>';
}

/* =========================================================================
   SUMS & HIERARCHY CALCULATIONS
   ========================================================================= */
function sumProgramRp(p){
  let sum = 0;
  if (!p || !p.kegiatan) return 0;
  p.kegiatan.forEach(k => {
    sum += sumKegiatanRp(k);
  });
  return sum;
}

function sumProgramMajuRp(p){
  let sum = 0;
  if (!p || !p.kegiatan) return 0;
  p.kegiatan.forEach(k => {
    sum += sumKegiatanMajuRp(k);
  });
  return sum;
}

function sumKegiatanRp(k){
  let sum = 0;
  if (!k || !k.subKegiatan) return 0;
  k.subKegiatan.forEach(s => {
    sum += parseRp(s.rp);
  });
  return sum;
}

function sumKegiatanMajuRp(k){
  let sum = 0;
  if (!k || !k.subKegiatan) return 0;
  k.subKegiatan.forEach(s => {
    sum += parseRp(s.anggaranN1);
  });
  return sum;
}

function sumBidangRp(b){
  let sum = 0;
  if (!b || !b.program) return 0;
  b.program.forEach(p => {
    sum += sumProgramRp(p);
  });
  return sum;
}

function sumBidangMajuRp(b){
  let sum = 0;
  if (!b || !b.program) return 0;
  b.program.forEach(p => {
    sum += sumProgramMajuRp(p);
  });
  return sum;
}

function sumUrusanRp(u){
  let sum = 0;
  if (!u || !u.bidang) return 0;
  u.bidang.forEach(b => {
    sum += sumBidangRp(b);
  });
  return sum;
}

function sumUrusanMajuRp(u){
  let sum = 0;
  if (!u || !u.bidang) return 0;
  u.bidang.forEach(b => {
    sum += sumBidangMajuRp(b);
  });
  return sum;
}

function sumTotalTerinput(){
  let sum = 0;
  if (!DATA_RENJA || !DATA_RENJA.urusan) return 0;
  DATA_RENJA.urusan.forEach(u => {
    sum += sumUrusanRp(u);
  });
  return sum;
}

function subKegiatanLokasiText(sk){
  const parts = [];
  if (sk.lokasiPelaksanaan) parts.push(sk.lokasiPelaksanaan);
  if (sk.kabKota) parts.push(sk.kabKota);
  if (sk.kecamatan) parts.push('Kec. ' + sk.kecamatan);
  if (sk.desa) parts.push('Ds. ' + sk.desa);
  return parts.length ? parts.join(' &middot; ') : (sk.lokasi || '-');
}

function kegiatanLokasi(k){
  if (!k.subKegiatan || !k.subKegiatan.length) return '-';
  const set = new Set();
  k.subKegiatan.forEach(s => {
    const txt = subKegiatanLokasiText(s);
    if (txt && txt !== '-') set.add(txt);
  });
  return set.size ? Array.from(set).join(' ; ') : '-';
}

function programLokasi(p){
  if (!p.kegiatan || !p.kegiatan.length) return '-';
  const set = new Set();
  p.kegiatan.forEach(k => {
    const txt = kegiatanLokasi(k);
    if (txt && txt !== '-') set.add(txt);
  });
  return set.size ? Array.from(set).join(' ; ') : '-';
}

function kegiatanSumberDana(k){
  if (!k.subKegiatan || !k.subKegiatan.length) return '-';
  const set = new Set();
  k.subKegiatan.forEach(s => {
    if (s.sumberDana && s.sumberDana !== '-') set.add(s.sumberDana);
  });
  return set.size ? Array.from(set).join(', ') : '-';
}

function programSumberDana(p){
  if (!p.kegiatan || !p.kegiatan.length) return '-';
  const set = new Set();
  p.kegiatan.forEach(k => {
    const txt = kegiatanSumberDana(k);
    if (txt && txt !== '-') set.add(txt);
  });
  return set.size ? Array.from(set).join(', ') : '-';
}

function countProgramRows(p){
  let kCount = 0;
  let sCount = 0;
  if (p && p.kegiatan){
    kCount = p.kegiatan.length;
    p.kegiatan.forEach(k => {
      if (k.subKegiatan) sCount += k.subKegiatan.length;
    });
  }
  return { kegiatan: kCount, sub: sCount };
}

/* =========================================================================
   PAGU SUMMARY WIDGET
   ========================================================================= */
function updatePaguSummary(){
  const pagu = parseRp(DATA_RENJA.paguAnggaran || 0);
  const terinput = sumTotalTerinput();
  const selisih = pagu - terinput;

  document.getElementById('paguAnggaranValue').textContent = fmtRp(pagu);
  document.getElementById('paguTerinputValue').textContent = fmtRp(terinput);

  const selItem = document.getElementById('paguSelisihItem');
  const selVal = document.getElementById('paguSelisihValue');
  const selSub = document.getElementById('paguSelisihSub');
  const pctSub = document.getElementById('paguTerinputPercent');

  if (pagu > 0) {
    const pct = Math.round((terinput / pagu) * 100);
    pctSub.textContent = pct + '% dari total pagu anggaran';
  } else {
    pctSub.textContent = 'Total dari seluruh Sub Kegiatan';
  }

  selItem.classList.remove('status-balanced', 'status-remaining', 'status-over');

  if (selisih === 0) {
    selItem.classList.add('status-balanced');
    selVal.textContent = 'Rp 0';
    selSub.textContent = 'Anggaran pas & seimbang';
  } else if (selisih > 0) {
    selItem.classList.add('status-remaining');
    selVal.textContent = fmtRp(selisih);
    selSub.textContent = 'Sisa pagu belum teralokasi';
  } else {
    selItem.classList.add('status-over');
    selVal.textContent = fmtRp(Math.abs(selisih));
    selSub.textContent = 'Melebihi pagu anggaran!';
  }
}

/* =========================================================================
   TABLE RENDERING
   ========================================================================= */
function renderTable(){
  const tbody = document.getElementById('renjaBody');
  if (!DATA_RENJA || !DATA_RENJA.perangkatDaerah) {
    tbody.innerHTML = '<tr><td colspan="15" class="text-center" style="padding:40px; color:var(--slate-400);">Belum ada data Perubahan Renja untuk filter yang dipilih.</td></tr>';
    return;
  }

  let html = '';

  // 1. Baris Perangkat Daerah
  html += '<tr class="row-pd">' +
    '<td>PD</td>' +
    '<td colspan="14">' + esc(DATA_RENJA.perangkatDaerah) + '</td>' +
    '</tr>';

  // 2. Tujuan
  if (DATA_RENJA.tujuan && DATA_RENJA.tujuan.length){
    DATA_RENJA.tujuan.forEach(t => {
      const inds = t.indikator && t.indikator.length ? t.indikator : [{ uraian:'-', satuan:'-', kinerja:'-', rp:'-' }];
      inds.forEach((ind, idx) => {
        html += '<tr class="row-tujuan">' +
          '<td>' + (idx === 0 ? 'TUJUAN' : '') + '</td>' +
          '<td>' + (idx === 0 ? '<span class="label-tag">Tujuan:</span>' + esc(t.uraian) : '') + '</td>' +
          '<td>' + esc(ind.uraian) + '</td>' +
          '<td class="text-center">' + esc(ind.satuan) + '</td>' +
          '<td class="text-center">' + esc(ind.kinerja) + '</td>' +
          '<td class="text-center">' + esc(ind.rp) + '</td>' +
          '<td colspan="9"></td>' +
          '</tr>';
      });
    });
  }

  // 3. Sasaran
  if (DATA_RENJA.sasaran && DATA_RENJA.sasaran.length){
    DATA_RENJA.sasaran.forEach(s => {
      const inds = s.indikator && s.indikator.length ? s.indikator : [{ uraian:'-', satuan:'-', kinerja:'-', rp:'-' }];
      inds.forEach((ind, idx) => {
        html += '<tr class="row-sasaran">' +
          '<td>' + (idx === 0 ? 'SASARAN' : '') + '</td>' +
          '<td>' + (idx === 0 ? '<span class="label-tag">Sasaran:</span>' + esc(s.uraian) : '') + '</td>' +
          '<td>' + esc(ind.uraian) + '</td>' +
          '<td class="text-center">' + esc(ind.satuan) + '</td>' +
          '<td class="text-center">' + esc(ind.kinerja) + '</td>' +
          '<td class="text-center">' + esc(ind.rp) + '</td>' +
          '<td colspan="9"></td>' +
          '</tr>';
      });
    });
  }

  // 4. Urusan -> Bidang -> Program -> Kegiatan -> Sub Kegiatan
  if (DATA_RENJA.urusan && DATA_RENJA.urusan.length){
    DATA_RENJA.urusan.forEach(u => {
      html += urusanRow(u);
      if (u.bidang){
        u.bidang.forEach(b => {
          html += bidangRow(b);
          if (b.program){
            b.program.forEach(p => {
              html += programRow(p);
              const isCollapsed = collapsedKeys.has('p:' + p.kode);
              if (!isCollapsed && p.kegiatan){
                p.kegiatan.forEach(k => {
                  html += kegiatanRow(k);
                  if (k.subKegiatan){
                    k.subKegiatan.forEach(sk => {
                      html += subKegiatanRow(sk, k);
                    });
                  }
                });
              }
            });
          }
        });
      }
    });
  }

  tbody.innerHTML = html;
}

function urusanRow(u){
  const total = sumUrusanRp(u);
  const totalMaju = sumUrusanMajuRp(u);
  return '<tr class="row-urusan" data-row-key="u:' + esc(u.kode) + '">' +
    '<td>' + esc(u.kode) + '</td>' +
    '<td colspan="4"><span class="label-tag">Urusan:</span>' + esc(u.nama) + '</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Bidang di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td colspan="5"></td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Bidang di bawahnya (Anggaran N+1)">' + esc(fmtRpMaju(totalMaju)) + '</td>' +
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
  const title = 'Diubah di Perubahan Renja' + (oldVal ? ('\nNilai di Rankhir Renja: ' + oldVal) : '');
  return '<br><span class="badge-col-diff" title="' + esc(title) + '"><i class="fa fa-info-circle"></i> Berubah dari Rankhir</span>';
}

function kegiatanRow(k){
  const total = sumKegiatanRp(k);
  const totalMaju = sumKegiatanMajuRp(k);
  const pengampuNama = k.namaPengampu ? ('<br><span class="pengampu-name">@ ' + esc(k.namaPengampu) + '</span>') : '';
  const pengampuLabel = k.pengampu && k.pengampu !== '-' ? ('<strong>' + esc(k.pengampu) + '</strong>') : '-';

  return '<tr class="row-kegiatan" data-row-key="keg:' + esc(k.id) + '">' +
    '<td>' + esc(k.kode) + '</td>' +
    '<td class="cell-uraian"><span class="label-tag">Kegiatan:</span>' + esc(k.nama) + '</td>' +
    '<td>' + esc(k.indikator) + renderColBadge(k.rankhirDiff, 'indikator') + '</td>' +
    '<td class="text-center">' + esc(k.satuan) + renderColBadge(k.rankhirDiff, 'satuan') + '</td>' +
    '<td class="text-center">' + esc(k.target) + renderColBadge(k.rankhirDiff, 'target') + '</td>' +
    '<td class="text-right cell-anggaran-auto" title="Total otomatis dari seluruh Sub Kegiatan di bawahnya">' + esc(fmtRp(total)) + '</td>' +
    '<td class="cell-anggaran-auto" title="Digabung otomatis dari Lokasi seluruh Sub Kegiatan di bawahnya">' + esc(kegiatanLokasi(k)) + '</td>' +
    '<td class="text-center cell-anggaran-auto" title="Digabung otomatis dari Sumber Pendanaan seluruh Sub Kegiatan di bawahnya">' + esc(kegiatanSumberDana(k)) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasDaerah) + '</td>' +
    '<td class="text-center">' + esc(k.prioritasNasional) + renderColBadge(k.rankhirDiff, 'prioritasNasional') + '</td>' +
    '<td>' + esc(k.kelompokSasaran) + renderColBadge(k.rankhirDiff, 'kelompokSasaran') + '</td>' +
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
    '<td>' + esc(sk.indikator) + renderColBadge(sk.rankhirDiff, 'indikator') + '</td>' +
    '<td class="text-center">' + esc(sk.satuan) + renderColBadge(sk.rankhirDiff, 'satuan') + '</td>' +
    '<td class="text-center">' + esc(sk.target) + renderColBadge(sk.rankhirDiff, 'target') + '</td>' +
    '<td class="text-right cell-anggaran-input" title="Anggaran diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(fmtRp(sk.rp)) + renderColBadge(sk.rankhirDiff, 'rp') + '</td>' +
    '<td class="cell-anggaran-input" title="Lokasi diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(lokasiText) + renderColBadge(sk.rankhirDiff, 'lokasi') + '</td>' +
    '<td class="text-center cell-anggaran-input" title="Sumber Pendanaan diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(sk.sumberDana || '-') + renderColBadge(sk.rankhirDiff, 'sumberDana') + '</td>' +
    '<td>' + esc(prioritasDaerahText) + renderColBadge(sk.rankhirDiff, 'prioritasDaerah') + '</td>' +
    '<td class="text-center">' + esc(k.prioritasNasional || '-') + renderColBadge(k.rankhirDiff, 'prioritasNasional') + '</td>' +
    '<td>' + esc(k.kelompokSasaran || '-') + renderColBadge(k.rankhirDiff, 'kelompokSasaran') + '</td>' +
    '<td class="text-center">-</td>' +
    '<td class="text-right cell-anggaran-input" title="Anggaran N+1 diinput lewat form Sub Kegiatan (Opsi Aksi)">' + esc(fmtRpMaju(sk.anggaranN1)) + renderColBadge(sk.rankhirDiff, 'anggaranN1') + '</td>' +
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
  if (!found) return;
  currentKegiatanId = id;
  const k = found.kegiatan;

  document.getElementById('kegModalLabel').value = (k.kode ? k.kode + ' - ' : '') + k.nama;
  document.getElementById('kegIndikator').value = k.indikator && k.indikator !== '-' ? k.indikator : '';
  document.getElementById('kegTarget').value = k.target || k.kinerja || '0';
  document.getElementById('kegSatuan').value = k.satuan && k.satuan !== '-' ? k.satuan : '';
  document.getElementById('kegKelompokSasaran').value = k.kelompokSasaran && k.kelompokSasaran !== '-' ? k.kelompokSasaran : '';

  populateSelect('kegPrioritasNasional', DATA_RENJA.prioritasNasionalList || [], k.prioritasNasional);

  document.getElementById('modalKegiatan').classList.add('active');
}

function saveKegiatanModal(){
  const found = findKegiatan(currentKegiatanId);
  if (!found) return;
  const k = found.kegiatan;

  const postData = {
    kegiatan_id: k.db_id,
    instansi_id: ACTIVE_INSTANSI_ID,
    tahun: CURRENT_TAHUN,
    indikator: document.getElementById('kegIndikator').value.trim(),
    target: document.getElementById('kegTarget').value.trim(),
    satuan: document.getElementById('kegSatuan').value.trim(),
    kelompok_sasaran: document.getElementById('kegKelompokSasaran').value.trim(),
    prioritas_nasional: document.getElementById('kegPrioritasNasional').value
  };

  const btn = document.getElementById('btnSaveKegiatan');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(BASE_URL + 'Instansi/simpanPerubahanRenjaKegiatan', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: new URLSearchParams(postData)
  })
  .then(r => r.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg> Simpan Perubahan';
    if (data.status === 'success') {
      k.indikator = postData.indikator || '-';
      k.target = postData.target || '0';
      k.satuan = postData.satuan || '-';
      k.kelompokSasaran = postData.kelompok_sasaran || '-';
      k.prioritasNasional = postData.prioritas_nasional || '-';
      
      closeModals();
      renderTable();
      showToast(data.message || 'Kegiatan Perubahan Renja berhasil disimpan.');
    } else {
      alert(data.message || 'Gagal menyimpan perubahan.');
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg> Simpan Perubahan';
    alert('Terjadi kesalahan koneksi.');
  });
}

/* =========================================================================
   MODAL: SUB KEGIATAN
   ========================================================================= */
let currentSubKegiatanId = null;

function openSubKegiatanModal(id){
  const found = findSubKegiatan(id);
  if (!found) return;
  currentSubKegiatanId = id;
  const sk = found.subKegiatan;

  document.getElementById('subModalLabel').value = (sk.kode ? sk.kode + ' - ' : '') + sk.nama;
  document.getElementById('subTarget').value = sk.target || sk.kinerja || '0';
  document.getElementById('subSatuan').value = sk.satuan && sk.satuan !== '-' ? sk.satuan : '';
  document.getElementById('subIndikator').value = sk.indikator && sk.indikator !== '-' ? sk.indikator : '';
  document.getElementById('subAnggaran').value = Math.round(parseRp(sk.rp)).toLocaleString('id-ID');
  document.getElementById('subAnggaranN1').value = Math.round(parseRp(sk.anggaranN1)).toLocaleString('id-ID');
  document.getElementById('subAnggaranN2').value = Math.round(parseRp(sk.anggaranN2)).toLocaleString('id-ID');

  populateSelect('subPrioritasProvinsi', DATA_RENJA.prioritasProvinsiList || [], sk.prioritasProvinsi);
  populateSelect('subPrioritasKabKota', DATA_RENJA.prioritasKabKotaList || [], sk.prioritasKabKota);
  populateSelect('subSumberDana', SUMBER_DANA_LIST, sk.sumberDana);
  populateSelect('subLokasiPelaksanaan', LOKASI_PELAKSANAAN_LIST, sk.lokasiPelaksanaan);
  populateSelect('subBulanMulai', BULAN_LIST, sk.bulanMulai);
  populateSelect('subBulanSelesai', BULAN_LIST, sk.bulanSelesai);

  // Default Wilayah
  const kabVal = '<?= !empty($NamaWilayah) ? addslashes($NamaWilayah) : "Kabupaten" ?>';
  document.getElementById('subKabKota').value = sk.kabKota || kabVal;

  loadKecamatanOptions(sk.kecamatan, sk.desa);

  document.getElementById('modalSubKegiatan').classList.add('active');
}

function loadKecamatanOptions(selectedKec, selectedDesa){
  const kecSelect = document.getElementById('subKecamatan');
  const desaSelect = document.getElementById('subDesa');
  kecSelect.innerHTML = '<option value="">Memuat Kecamatan...</option>';
  desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

  if (cachedKecamatan.length > 0) {
    populateKecamatan(cachedKecamatan, selectedKec, selectedDesa);
    return;
  }

  fetch(BASE_URL + 'Instansi/getKecamatanJson')
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success' && res.data) {
        cachedKecamatan = res.data;
        populateKecamatan(cachedKecamatan, selectedKec, selectedDesa);
      } else {
        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
      }
    })
    .catch(() => {
      kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
    });
}

function populateKecamatan(data, selectedKec, selectedDesa){
  const kecSelect = document.getElementById('subKecamatan');
  let html = '<option value="">Pilih Kecamatan</option>';
  data.forEach(item => {
    const isSel = selectedKec && (item.nama === selectedKec || item.id == selectedKec) ? 'selected' : '';
    html += '<option value="' + esc(item.nama) + '" data-id="' + esc(item.id) + '" ' + isSel + '>' + esc(item.nama) + '</option>';
  });
  kecSelect.innerHTML = html;

  if (selectedKec) {
    const activeOpt = kecSelect.options[kecSelect.selectedIndex];
    const kecId = activeOpt ? activeOpt.getAttribute('data-id') : null;
    if (kecId) {
      loadDesaOptions(kecId, selectedDesa);
    }
  }
}

function loadDesaOptions(kecId, selectedDesa){
  const desaSelect = document.getElementById('subDesa');
  desaSelect.innerHTML = '<option value="">Memuat Desa...</option>';

  fetch(BASE_URL + 'Instansi/getDesaJson?kecamatan_id=' + encodeURIComponent(kecId))
    .then(r => r.json())
    .then(res => {
      if (res.status === 'success' && res.data) {
        let html = '<option value="">Pilih Desa/Kelurahan</option>';
        res.data.forEach(item => {
          const isSel = selectedDesa && (item.nama === selectedDesa || item.id == selectedDesa) ? 'selected' : '';
          html += '<option value="' + esc(item.nama) + '" ' + isSel + '>' + esc(item.nama) + '</option>';
        });
        desaSelect.innerHTML = html;
      } else {
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
      }
    })
    .catch(() => {
      desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
    });
}

function saveSubKegiatanModal(){
  const found = findSubKegiatan(currentSubKegiatanId);
  if (!found) return;
  const sk = found.subKegiatan;
  const k = found.kegiatan;

  const postData = {
    sub_kegiatan_id: sk.db_id,
    kegiatan_id: k.db_id,
    instansi_id: ACTIVE_INSTANSI_ID,
    tahun: CURRENT_TAHUN,
    prioritas_provinsi: document.getElementById('subPrioritasProvinsi').value,
    prioritas_kabkota: document.getElementById('subPrioritasKabKota').value,
    sumber_dana: document.getElementById('subSumberDana').value,
    lokasi_pelaksanaan: document.getElementById('subLokasiPelaksanaan').value,
    kab_kota: document.getElementById('subKabKota').value.trim(),
    kecamatan: document.getElementById('subKecamatan').value.trim(),
    desa: document.getElementById('subDesa').value.trim(),
    bulan_mulai: document.getElementById('subBulanMulai').value,
    bulan_selesai: document.getElementById('subBulanSelesai').value,
    anggaran: document.getElementById('subAnggaran').value.trim(),
    anggaran_n1: document.getElementById('subAnggaranN1').value.trim(),
    anggaran_n2: document.getElementById('subAnggaranN2').value.trim(),
    target: document.getElementById('subTarget').value.trim(),
    satuan: document.getElementById('subSatuan').value.trim(),
    indikator: document.getElementById('subIndikator').value.trim()
  };

  const btn = document.getElementById('btnSaveSubKegiatan');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

  fetch(BASE_URL + 'Instansi/simpanPerubahanRenjaSubKegiatan', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: new URLSearchParams(postData)
  })
  .then(r => r.json())
  .then(data => {
    btn.disabled = false;
    btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg> Simpan Perubahan';
    if (data.status === 'success') {
      sk.prioritasProvinsi = postData.prioritas_provinsi;
      sk.prioritasKabKota = postData.prioritas_kabkota;
      sk.sumberDana = postData.sumber_dana;
      sk.lokasiPelaksanaan = postData.lokasi_pelaksanaan;
      sk.kabKota = postData.kab_kota;
      sk.kecamatan = postData.kecamatan;
      sk.desa = postData.desa;
      sk.bulanMulai = postData.bulan_mulai;
      sk.bulanSelesai = postData.bulan_selesai;
      sk.rp = parseRp(postData.anggaran);
      sk.anggaranN1 = parseRp(postData.anggaran_n1);
      sk.anggaranN2 = parseRp(postData.anggaran_n2);
      sk.target = postData.target || '0';
      sk.satuan = postData.satuan || '-';
      sk.indikator = postData.indikator || '-';

      closeModals();
      renderTable();
      updatePaguSummary();
      showToast(data.message || 'Sub Kegiatan Perubahan Renja berhasil disimpan.');
    } else {
      alert(data.message || 'Gagal menyimpan perubahan.');
    }
  })
  .catch(err => {
    btn.disabled = false;
    btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3h10l3 3v11a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm1 2v4h8V5H5zm0 6v6h10v-6H5z"/></svg> Simpan Perubahan';
    alert('Terjadi kesalahan koneksi.');
  });
}

function populateSelect(elemId, items, selectedVal){
  const sel = document.getElementById(elemId);
  if (!sel) return;
  let html = '<option value="">-- Pilih --</option>';
  items.forEach(item => {
    const isObj = typeof item === 'object';
    const val = isObj ? (item.nama || item.uraian || item.text) : item;
    const isSel = selectedVal && selectedVal.toString().trim() === val.toString().trim() ? 'selected' : '';
    html += '<option value="' + esc(val) + '" ' + isSel + '>' + esc(val) + '</option>';
  });
  sel.innerHTML = html;
}

function closeModals(){
  document.querySelectorAll('.modal-backdrop-custom').forEach(m => m.classList.remove('active'));
}

/* =========================================================================
   DATA LOOKUP HELPERS
   ========================================================================= */
function findKegiatan(id){
  if (!DATA_RENJA.urusan) return null;
  for (const u of DATA_RENJA.urusan){
    if (!u.bidang) continue;
    for (const b of u.bidang){
      if (!b.program) continue;
      for (const p of b.program){
        if (!p.kegiatan) continue;
        for (const k of p.kegiatan){
          if (k.id === id || k.db_id == id) return { urusan:u, bidang:b, program:p, kegiatan:k };
        }
      }
    }
  }
  return null;
}

function findSubKegiatan(id){
  if (!DATA_RENJA.urusan) return null;
  for (const u of DATA_RENJA.urusan){
    if (!u.bidang) continue;
    for (const b of u.bidang){
      if (!b.program) continue;
      for (const p of b.program){
        if (!p.kegiatan) continue;
        for (const k of p.kegiatan){
          if (!k.subKegiatan) continue;
          for (const sk of k.subKegiatan){
            if (sk.id === id || sk.db_id == id) return { urusan:u, bidang:b, program:p, kegiatan:k, subKegiatan:sk };
          }
        }
      }
    }
  }
  return null;
}

/* =========================================================================
   EVENTS & AJAX
   ========================================================================= */
function bindEvents(){
  // Year selector
  document.querySelectorAll('.year-tab').forEach(btn => {
    btn.addEventListener('click', (e) => {
      document.querySelectorAll('.year-tab').forEach(b => b.classList.remove('active'));
      e.target.classList.add('active');
      CURRENT_TAHUN = parseInt(e.target.getAttribute('data-year'), 10);
      document.getElementById('activeYearLabel').textContent = CURRENT_TAHUN;
      loadDataAjax(CURRENT_TAHUN, ACTIVE_INSTANSI_ID);
    });
  });

  // Instansi selector
  const instSel = document.getElementById('instansiSelect');
  if (instSel){
    instSel.addEventListener('change', (e) => {
      ACTIVE_INSTANSI_ID = parseInt(e.target.value, 10);
      loadDataAjax(CURRENT_TAHUN, ACTIVE_INSTANSI_ID);
    });
  }

  // Click on table actions
  document.getElementById('renjaBody').addEventListener('click', (e) => {
    // Toggle Program collapse
    const progRow = e.target.closest('.row-program');
    if (progRow && (e.target.closest('.toggle-btn-inline') || !e.target.closest('.btn-aksi'))){
      const key = progRow.getAttribute('data-toggle-key');
      if (key){
        if (collapsedKeys.has(key)) collapsedKeys.delete(key);
        else collapsedKeys.add(key);
        renderTable();
        return;
      }
    }

    const btn = e.target.closest('.btn-aksi');
    if (!btn) return;
    const action = btn.getAttribute('data-action');
    const id = btn.getAttribute('data-id');

    if (action === 'edit-kegiatan') openKegiatanModal(id);
    else if (action === 'edit-subkegiatan') openSubKegiatanModal(id);
  });

  // Modal Save buttons
  document.getElementById('btnSaveKegiatan').addEventListener('click', saveKegiatanModal);
  document.getElementById('btnSaveSubKegiatan').addEventListener('click', saveSubKegiatanModal);

  // Modal Close buttons
  document.querySelectorAll('[data-close]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const modalId = btn.getAttribute('data-close');
      document.getElementById(modalId).classList.remove('active');
    });
  });

  // Format currency on typing in modals
  ['subAnggaran', 'subAnggaranN1', 'subAnggaranN2'].forEach(id => {
    const inp = document.getElementById(id);
    if (inp){
      inp.addEventListener('input', (e) => {
        const val = parseRp(e.target.value);
        if (e.target.value.trim() === '') return;
        const curPos = e.target.selectionStart;
        e.target.value = Math.round(val).toLocaleString('id-ID');
      });
    }
  });

  // Kecamatan change -> Load Desa
  const kecSel = document.getElementById('subKecamatan');
  if (kecSel){
    kecSel.addEventListener('change', (e) => {
      const activeOpt = kecSel.options[kecSel.selectedIndex];
      const kecId = activeOpt ? activeOpt.getAttribute('data-id') : null;
      if (kecId) loadDesaOptions(kecId, null);
      else document.getElementById('subDesa').innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
    });
  }

  // Live filter / search box
  const filterInput = document.getElementById('filterInput');
  filterInput.addEventListener('input', (e) => {
    const q = e.target.value.toLowerCase().trim();
    filterTable(q);
  });

  // Expand / Collapse all
  document.getElementById('btnExpandAll').addEventListener('click', () => {
    collapsedKeys.clear();
    renderTable();
  });
  document.getElementById('btnCollapseAll').addEventListener('click', () => {
    if (DATA_RENJA.urusan){
      DATA_RENJA.urusan.forEach(u => {
        if (u.bidang){
          u.bidang.forEach(b => {
            if (b.program){
              b.program.forEach(p => {
                collapsedKeys.add('p:' + p.kode);
              });
            }
          });
        }
      });
    }
    renderTable();
  });

  // Sinkronkan / Reset Data dari Rankhir Renja
  document.getElementById('btnSyncRenja').addEventListener('click', () => {
    const y = CURRENT_TAHUN;
    if(!confirm('Apakah Anda yakin ingin menyinkronkan ulang data Perubahan Renja Tahun ' + y + ' dengan data Rankhir Renja?\n\nPerubahan kustom pada Perubahan Renja tahun ' + y + ' akan direset dan dicocokkan kembali mengambil data terbaru dari Rankhir Renja.')){
      return;
    }

    const btn = document.getElementById('btnSyncRenja');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyinkronkan...';

    fetch(BASE_URL + 'Instansi/resetPerubahanRenjaDataFromRankhir', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: new URLSearchParams({
        tahun: y,
        instansi_id: ACTIVE_INSTANSI_ID
      })
    })
    .then(r => r.json())
    .then(res => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa fa-refresh"></i> Sinkronkan dengan Rankhir Renja';
      if (res.status === 'success'){
        showToast(res.message || 'Berhasil menyinkronkan data.');
        loadDataAjax(y, ACTIVE_INSTANSI_ID);
      } else {
        alert(res.message || 'Gagal menyinkronkan data.');
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa fa-refresh"></i> Sinkronkan dengan Rankhir Renja';
      alert('Terjadi kesalahan jaringan.');
    });
  });

  // Export Excel & PDF
  document.getElementById('btnExportExcel').addEventListener('click', exportExcel);
  document.getElementById('btnCetak').addEventListener('click', cetakPdf);
}

function loadDataAjax(tahun, instansiId){
  let url = BASE_URL + 'Instansi/getPerubahanRenjaPDJson?tahun=' + encodeURIComponent(tahun);
  if (instansiId) url += '&instansi_id=' + encodeURIComponent(instansiId);

  const tbody = document.getElementById('renjaBody');
  tbody.innerHTML = '<tr><td colspan="15" class="text-center" style="padding:40px; color:var(--slate-400);"><i class="fa fa-spinner fa-spin"></i> Memuat data Perubahan Renja...</td></tr>';

  fetch(url, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(res => {
    if (res.status === 'success' && res.data){
      DATA_RENJA = res.data;
      renderTable();
      updatePaguSummary();
    } else {
      showToast('Gagal memuat data Perubahan Renja.', 'error');
    }
  })
  .catch(() => {
    showToast('Terjadi kesalahan jaringan.', 'error');
  });
}

function filterTable(q){
  const rows = document.querySelectorAll('#renjaBody tr');
  if (!q){
    rows.forEach(r => r.style.display = '');
    return;
  }
  rows.forEach(r => {
    const text = r.textContent.toLowerCase();
    if (text.includes(q)) r.style.display = '';
    else r.style.display = 'none';
  });
}

function initFilterWilayah(){
  <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
    const selProv = document.getElementById('Provinsi');
    const selKab = document.getElementById('KabKota');
    const grpInstansi = document.getElementById('FilterInstansiGroup');
    const selInstansi = document.getElementById('FilterInstansiBeforeLogin');
    const btnFilter = document.getElementById('Filter');

    if (selProv) {
      selProv.addEventListener('change', function(){
        const provVal = this.value;
        if (!provVal) {
          selKab.innerHTML = '<option value="">Pilih Kab/Kota</option>';
          if (grpInstansi) grpInstansi.style.display = 'none';
          return;
        }
        selKab.innerHTML = '<option value="">Memuat Kab/Kota...</option>';
        fetch(BASE_URL + 'Instansi/GetListKabKota', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: 'Kode=' + encodeURIComponent(provVal)
        })
        .then(r => r.json())
        .then(data => {
          let opts = '<option value="">Pilih Kab/Kota</option>';
          if (data && data.length > 0) {
            data.forEach(item => {
              opts += '<option value="' + esc(item.Kode) + '">' + esc(item.Nama) + '</option>';
            });
          }
          selKab.innerHTML = opts;
          if (grpInstansi) grpInstansi.style.display = 'none';
        })
        .catch(() => {
          selKab.innerHTML = '<option value="">Pilih Kab/Kota</option>';
        });
      });
    }

    if (selKab) {
      selKab.addEventListener('change', function(){
        const kabVal = this.value;
        if (!kabVal) {
          if (grpInstansi) grpInstansi.style.display = 'none';
          return;
        }
        if (selInstansi) {
          selInstansi.innerHTML = '<option value="">Memuat Instansi...</option>';
          fetch(BASE_URL + 'Instansi/GetListInstansiByWilayah', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'KodeWilayah=' + encodeURIComponent(kabVal)
          })
          .then(r => r.json())
          .then(data => {
            let opts = '<option value="">-- Pilih Instansi --</option>';
            if (data && data.length > 0) {
              data.forEach(item => {
                opts += '<option value="' + esc(item.id) + '">' + esc(item.nama) + '</option>';
              });
            }
            selInstansi.innerHTML = opts;
            if (grpInstansi) grpInstansi.style.display = 'block';
          })
          .catch(() => {
            selInstansi.innerHTML = '<option value="">-- Pilih Instansi --</option>';
          });
        }
      });
    }

    if (btnFilter) {
      btnFilter.addEventListener('click', function(){
        const provVal = selProv ? selProv.value : '';
        const kabVal = selKab ? selKab.value : '';
        const instansiVal = selInstansi ? selInstansi.value : '';

        if (!provVal) {
          alert('Pilih Provinsi terlebih dahulu!');
          return;
        }
        if (!kabVal) {
          alert('Pilih Kabupaten/Kota terlebih dahulu!');
          return;
        }

        fetch(BASE_URL + 'Instansi/SetWilayahSession', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: 'KodeWilayah=' + encodeURIComponent(kabVal) + '&InstansiId=' + encodeURIComponent(instansiVal || '')
        })
        .then(r => r.text())
        .then(res => {
          let redirectUrl = BASE_URL + 'Instansi/PerubahanRenjaPD';
          if (instansiVal) redirectUrl += '?instansi_id=' + encodeURIComponent(instansiVal);
          window.location.href = redirectUrl;
        });
      });
    }
  <?php } ?>

  <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    const selFilterInstansi = document.getElementById('FilterInstansi');
    const btnFilterInstansi = document.getElementById('FilterInstansiBtn');

    if (btnFilterInstansi) {
      btnFilterInstansi.addEventListener('click', function(){
        const val = selFilterInstansi ? selFilterInstansi.value : '';
        const tahun = CURRENT_TAHUN || 2026;
        let redirectUrl = BASE_URL + 'Instansi/PerubahanRenjaPD?tahun=' + encodeURIComponent(tahun);
        if (val) redirectUrl += '&instansi_id=' + encodeURIComponent(val);
        window.location.href = redirectUrl;
      });
    }
  <?php } ?>
}

/* =========================================================================
   EXPORT EXCEL & CETAK
   ========================================================================= */
function exportExcel(){
  const tab = document.querySelector('.table-renja-main');
  if (!tab) return;
  const html = tab.outerHTML.replace(/ /g, '%20');
  const a = document.createElement('a');
  a.href = 'data:application/vnd.ms-excel,' + html;
  a.download = 'Perubahan_Renja_PD_' + CURRENT_TAHUN + '.xls';
  a.click();
}

function cetakPdf(){
  window.print();
}

function showToast(msg, type = 'success'){
  let toast = document.getElementById('renjaToast');
  if (!toast){
    toast = document.createElement('div');
    toast.id = 'renjaToast';
    toast.style.position = 'fixed';
    toast.style.bottom = '24px';
    toast.style.right = '24px';
    toast.style.padding = '12px 20px';
    toast.style.borderRadius = '8px';
    toast.style.fontSize = '13px';
    toast.style.fontWeight = '600';
    toast.style.zIndex = '99999';
    toast.style.boxShadow = '0 6px 20px rgba(0,0,0,0.15)';
    toast.style.transition = 'all 0.3s ease';
    document.body.appendChild(toast);
  }
  toast.style.background = type === 'error' ? '#dc2626' : '#059669';
  toast.style.color = '#ffffff';
  toast.textContent = msg;
  toast.style.opacity = '1';
  toast.style.transform = 'translateY(0)';
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(10px)';
  }, 3000);
}
</script>

</body>
</html>
