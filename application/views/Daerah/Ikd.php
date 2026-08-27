<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
  :root{
    --navy:#173A5E;
    --navy-dark:#0F2740;
    --teal:#0E7C7B;
    --gold:#B8891F;
    --plum:#7A3B69;
    --bg:#F3F5F8;
    --surface:#FFFFFF;
    --border:#DFE3E9;
    --text:#1F2733;
    --text-muted:#667085;
    --danger:#B3261E;
    --danger-bg:#FBEAE9;
    --success:#1F7A54;
    --font-display: Georgia, 'Times New Roman', serif;
    --font-body: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
    --radius: 10px;
  }

  .ikd-page-wrapper {
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-body);
    font-size: 14px;
    line-height: 1.5;
    padding: 24px 28px 80px;
  }

  /* ---------- Header ---------- */
  .page-header-ikd{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:16px;
    margin-bottom:22px;
    border-bottom:3px solid var(--navy);
    padding-bottom:16px;
  }
  .page-header-ikd h1{
    font-family:var(--font-display);
    font-size:28px;
    margin:0;
    color:var(--navy-dark);
    font-weight:700;
  }
  .page-header-ikd .sub{
    color:var(--text-muted);
    font-size:13px;
    margin-top:4px;
    margin-bottom:0;
  }
  .header-actions{
    display:flex;
    gap:10px;
    align-items:center;
  }
  .search-box-ikd{
    position:relative;
  }
  .search-box-ikd input{
    width:260px;
    padding:9px 12px 9px 36px;
    border:1px solid var(--border);
    border-radius:8px;
    font-size:13px;
    font-family:var(--font-body);
    background:var(--surface) url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="%23667085" stroke-width="2"><circle cx="6.5" cy="6.5" r="5"/><line x1="10.5" y1="10.5" x2="15" y2="15"/></svg>') no-repeat 10px center;
  }
  .search-box-ikd input:focus{outline:2px solid var(--teal); outline-offset:1px;}

  /* ---------- Filter Wilayah ---------- */
  .filter-card-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 20px;
    margin-bottom: 22px;
  }
  .filter-row-ikd {
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
    gap: 15px;
  }
  .filter-group-ikd {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .filter-group-ikd label {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .04em;
    margin-bottom: 5px;
  }
  .filter-select-ikd {
    width: 240px;
    font-size: 13.5px;
    padding: 8px 10px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surface);
  }
  .btn-filter-ikd {
    padding: 8px 20px;
    border-radius: 7px;
    font-size: 13.5px;
    font-weight: 600;
    background: var(--navy);
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background .15s ease;
  }
  .btn-filter-ikd:hover { background: var(--navy-dark); }

  /* ---------- Summary strip ---------- */
  .summary-strip{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:26px;
  }
  .summary-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-left:5px solid var(--cat-color, var(--navy));
    border-radius:var(--radius);
    padding:14px 16px;
  }
  .summary-card .num{
    font-family:var(--font-display);
    font-size:26px;
    font-weight:700;
    color:var(--navy-dark);
  }
  .summary-card .lbl{
    font-size:11.5px;
    color:var(--text-muted);
    margin-top:2px;
    text-transform:uppercase;
    letter-spacing:.04em;
  }

  /* ---------- Sections ---------- */
  .aspek-section{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius);
    margin-bottom:20px;
    overflow:hidden;
  }
  .aspek-band{
    display:flex;
    align-items:center;
    gap:12px;
    padding:13px 18px;
    background:linear-gradient(90deg, var(--cat-color) 0%, var(--cat-color) 100%);
    color:#fff;
  }
  .aspek-badge{
    width:30px;height:30px;
    border-radius:50%;
    background:rgba(255,255,255,.18);
    border:1.5px solid rgba(255,255,255,.55);
    display:flex;align-items:center;justify-content:center;
    font-family:var(--font-display);
    font-weight:700;
    font-size:14px;
    flex-shrink:0;
  }
  .aspek-band h2{
    font-size:14px;
    margin:0;
    letter-spacing:.03em;
    font-weight:700;
    flex:1;
    color:#fff;
  }
  .aspek-band .count-pill{
    font-size:11px;
    background:rgba(255,255,255,.18);
    padding:3px 9px;
    border-radius:999px;
    font-weight:600;
  }
  .btn-add{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:rgba(255,255,255,.16);
    border:1.5px solid rgba(255,255,255,.65);
    color:#fff;
    padding:7px 13px;
    border-radius:7px;
    font-size:12.5px;
    font-weight:600;
    cursor:pointer;
    font-family:var(--font-body);
    transition:background .15s ease;
  }
  .btn-add:hover{background:rgba(255,255,255,.28);}
  .btn-add:focus-visible{outline:2px solid #fff; outline-offset:2px;}
  .btn-add svg{width:14px;height:14px;}

  /* ---------- Table Toolbar (Entries per page & info) ---------- */
  .table-toolbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:9px 16px;
    background:#FAFBFC;
    border-bottom:1px solid var(--border);
    flex-wrap:wrap;
    gap:10px;
    font-size:12.5px;
    color:var(--text-muted);
  }
  .table-length-selector label{
    margin:0;
    font-weight:500;
    display:flex;
    align-items:center;
    gap:6px;
    color:var(--text-muted);
  }
  .entries-select{
    padding:4px 8px;
    border:1px solid var(--border);
    border-radius:6px;
    background:var(--surface);
    font-size:12.5px;
    font-family:var(--font-body);
    color:var(--text);
    cursor:pointer;
  }
  .entries-select:focus{
    outline:2px solid var(--teal);
    outline-offset:1px;
  }
  .table-info-text{
    font-size:12.5px;
    color:var(--text-muted);
    font-weight:500;
  }

  .table-wrap{overflow-x:auto;}
  table.ikd-table{
    width:100%;
    border-collapse:collapse;
    min-width:980px;
  }
  table.ikd-table thead th{
    background:#F7F8FA;
    color:var(--text-muted);
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:.04em;
    font-weight:700;
    padding:10px 12px;
    border-bottom:1px solid var(--border);
    text-align:left;
    white-space:nowrap;
  }
  table.ikd-table thead th.num-col{text-align:right;}
  table.ikd-table thead th.center-col{text-align:center;}
  table.ikd-table tbody td{
    padding:11px 12px;
    border-bottom:1px solid var(--border);
    vertical-align:middle;
    font-size:13px;
  }
  table.ikd-table tbody tr:last-child td{border-bottom:none;}
  table.ikd-table tbody tr:hover{background:#FAFBFD;}
  table.ikd-table td.num-col{text-align:right; font-variant-numeric:tabular-nums; white-space:nowrap;}
  td.no-col{color:var(--text-muted); width:36px; text-align:center;}
  td.opd-col{color:var(--text-muted); max-width:200px;}
  td.opd-col.filled{color:var(--text); font-weight:500;}
  .indikator-name{font-weight:600; color:var(--navy-dark);}
  .satuan-tag{
    display:inline-block;
    font-size:11.5px;
    background:#EEF2F6;
    color:var(--text-muted);
    padding:2px 8px;
    border-radius:999px;
  }
  .row-actions{display:flex; gap:6px; white-space:nowrap; justify-content:center;}
  .icon-btn{
    width:30px;height:30px;
    border-radius:6px;
    border:1px solid var(--border);
    background:var(--surface);
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;
    color:var(--text-muted);
    transition:background .15s ease, color .15s ease, border-color .15s ease;
  }
  .icon-btn:hover{background:#F0F2F5; color:var(--navy-dark);}
  .icon-btn.danger:hover{background:var(--danger-bg); color:var(--danger); border-color:#F0C6C3;}
  .icon-btn svg{width:14px;height:14px;}
  .icon-btn:focus-visible{outline:2px solid var(--teal); outline-offset:1px;}

  .empty-row td{
    text-align:center;
    padding:26px 12px;
    color:var(--text-muted);
    font-size:13px;
  }

  /* ---------- Pagination Bottom Bar ---------- */
  .table-pagination-wrap{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 16px;
    background:#FAFBFC;
    border-top:1px solid var(--border);
    flex-wrap:wrap;
    gap:10px;
    font-size:12.5px;
  }
  .pagination-info{
    color:var(--text-muted);
    font-size:12.5px;
  }
  .pagination-controls{
    display:flex;
    gap:4px;
    align-items:center;
  }
  .page-btn{
    min-width:30px;
    height:30px;
    padding:0 8px;
    border-radius:6px;
    border:1px solid var(--border);
    background:var(--surface);
    color:var(--text);
    font-size:12.5px;
    font-weight:600;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    transition:all .15s ease;
  }
  .page-btn:hover:not(:disabled){
    background:#F0F2F5;
    border-color:#CBD2DB;
  }
  .page-btn.active{
    background:var(--navy);
    color:#fff;
    border-color:var(--navy);
  }
  .page-btn:disabled{
    opacity:0.4;
    cursor:not-allowed;
  }

  /* ---------- Modal ---------- */
  .overlay{
    position:fixed; inset:0;
    background:rgba(15,39,64,.55);
    display:none;
    align-items:flex-start;
    justify-content:center;
    padding:40px 16px;
    overflow-y:auto;
    z-index:9999;
  }
  .overlay.open{display:flex;}
  .modal-ikd{
    background:var(--surface);
    border-radius:12px;
    width:100%;
    max-width:760px;
    box-shadow:0 20px 50px rgba(15,39,64,.35);
    animation:modalIn .16s ease;
    margin:auto;
  }
  @keyframes modalIn{from{opacity:0; transform:translateY(8px);} to{opacity:1; transform:translateY(0);}}
  .modal-header-ikd{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:18px 22px;
    border-bottom:1px solid var(--border);
  }
  .modal-header-ikd h3{
    margin:0;
    font-family:var(--font-display);
    font-size:19px;
    color:var(--navy-dark);
    font-weight:700;
  }
  .modal-close-ikd{
    background:none;border:none;cursor:pointer;
    color:var(--text-muted);
    width:30px;height:30px;
    border-radius:6px;
    display:flex;align-items:center;justify-content:center;
  }
  .modal-close-ikd:hover{background:#F0F2F5;}
  .modal-close-ikd svg{width:16px;height:16px;}

  .aspek-info{
    margin:18px 22px 0;
    padding:11px 14px;
    border-radius:8px;
    display:flex;
    align-items:center;
    gap:10px;
    font-size:12.5px;
    font-weight:600;
    color:#fff;
    background:var(--cat-color, var(--navy));
  }
  .aspek-info .aspek-badge{width:24px;height:24px;font-size:12px;}

  .modal-body-ikd{padding:18px 22px 4px;}
  .field-row{margin-bottom:16px;}
  .field-row label{
    display:block;
    font-size:12px;
    font-weight:700;
    color:var(--text-muted);
    text-transform:uppercase;
    letter-spacing:.03em;
    margin-bottom:6px;
  }
  .field-row input[type=text],
  .field-row select{
    width:100%;
    padding:9px 11px;
    border:1px solid var(--border);
    border-radius:7px;
    font-size:13.5px;
    font-family:var(--font-body);
    background:var(--surface);
    color:var(--text);
  }
  .field-row input:focus, .field-row select:focus{
    outline:2px solid var(--teal);
    outline-offset:1px;
    border-color:var(--teal);
  }
  .two-col{display:grid; grid-template-columns:2fr 1fr; gap:14px;}

  .target-table{
    width:100%;
    border-collapse:collapse;
    border:1px solid var(--border);
    border-radius:7px;
    overflow:hidden;
  }
  .target-table th{
    background:#F7F8FA;
    font-size:11px;
    text-transform:uppercase;
    color:var(--text-muted);
    padding:8px 4px;
    text-align:center;
    border-bottom:1px solid var(--border);
    border-left:1px solid var(--border);
  }
  .target-table th:first-child{border-left:none;}
  .target-table td{
    padding:6px;
    border-left:1px solid var(--border);
  }
  .target-table td:first-child{border-left:none;}
  .target-table input{
    width:100%;
    border:none;
    text-align:center;
    padding:6px 2px;
    font-size:13px;
    font-family:var(--font-body);
    background:transparent;
    color:var(--text);
  }
  .target-table input:focus{outline:2px solid var(--teal); outline-offset:-2px; border-radius:4px;}
  .target-caption{font-size:11.5px; color:var(--text-muted); margin-top:6px;}

  .modal-footer-ikd{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    padding:16px 22px 22px;
  }
  .btn-ikd{
    padding:10px 18px;
    border-radius:7px;
    font-size:13.5px;
    font-weight:600;
    cursor:pointer;
    font-family:var(--font-body);
    border:1px solid transparent;
    transition: all .15s ease;
  }
  .btn-ikd-primary{background:var(--navy); color:#fff;}
  .btn-ikd-primary:hover{background:var(--navy-dark);}
  .btn-ikd-secondary{background:var(--surface); color:var(--text); border-color:var(--border);}
  .btn-ikd-secondary:hover{background:#F0F2F5;}
  .btn-ikd-danger{background:var(--danger); color:#fff;}
  .btn-ikd-danger:hover{background:#8F1F19;}
  .btn-ikd:focus-visible{outline:2px solid var(--teal); outline-offset:2px;}

  .confirm-modal{max-width:400px;}
  .confirm-modal .modal-body-ikd{padding:6px 22px 18px; color:var(--text-muted); font-size:13.5px;}

  .field-error{
    color:var(--danger);
    font-size:11.5px;
    margin-top:5px;
    display:none;
  }
  .field-row.invalid input, .field-row.invalid select{border-color:var(--danger);}
  .field-row.invalid .field-error{display:block;}

  /* ---------- Toast ---------- */
  .toast-ikd{
    position:fixed;
    bottom:24px;
    right:24px;
    background:var(--navy-dark);
    color:#fff;
    padding:12px 18px;
    border-radius:8px;
    font-size:13px;
    display:flex;
    align-items:center;
    gap:8px;
    box-shadow:0 10px 24px rgba(0,0,0,.25);
    transform:translateY(12px);
    opacity:0;
    pointer-events:none;
    transition:transform .2s ease, opacity .2s ease;
    z-index:10000;
  }
  .toast-ikd.show{transform:translateY(0); opacity:1;}
  .toast-ikd.error{background:var(--danger);}
  .toast-ikd svg{width:15px;height:15px; flex-shrink:0;}

  @media (max-width: 768px){
    .ikd-page-wrapper{padding:18px 14px 70px;}
    .summary-strip{grid-template-columns:repeat(2,1fr);}
    .two-col{grid-template-columns:1fr;}
    .search-box-ikd input{width:100%;}
    .filter-select-ikd{width:100%;}
    .table-toolbar{flex-direction:column; align-items:flex-start;}
    .table-pagination-wrap{flex-direction:column; align-items:flex-start;}
  }
</style>

<!-- Main Content -->
<div class="main-content">
  <div class="ikd-page-wrapper">

    <!-- Header -->
    <div class="page-header-ikd">
      <div>
        <h1>Indikator Kinerja Daerah (IKD)</h1>
        <p class="sub">Kelola indikator kinerja per aspek pembangunan beserta target tahunan dan perangkat daerah pengampu.</p>
      </div>
      <div class="header-actions">
        <div class="search-box-ikd">
          <input type="text" id="searchInput" placeholder="Cari indikator...">
        </div>
      </div>
    </div>

    <!-- FILTER UNTUK PENGGUNA YANG BELUM LOGIN -->
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
      <div class="filter-card-wrap">
        <div class="filter-row-ikd">
          <div class="filter-group-ikd">
            <label for="Provinsi">Provinsi</label>
            <select class="filter-select-ikd" id="Provinsi">
              <option value="">Pilih Provinsi</option>
              <?php foreach ($Provinsi as $prov) { ?>
                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                  <?= html_escape($prov['Nama']) ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="filter-group-ikd">
            <label for="KabKota">Kab/Kota</label>
            <select class="filter-select-ikd" id="KabKota">
              <option value="">Pilih Kab/Kota</option>
            </select>
          </div>
          <div class="filter-group-ikd">
            <button class="btn-filter-ikd" id="Filter">
              Filter
            </button>
          </div>
        </div>
      </div>

      <!-- Menampilkan Wilayah dan Pesan Status setelah filter -->
      <?php if (!empty($KodeWilayah)) { ?>
        <?php 
          $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
          $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
        ?>
        <div class="alert <?= empty($Ikd) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px; border-radius: 8px;">
          <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
          <?php if (empty($Ikd)) { ?>
            <strong>Peringatan:</strong> Belum ada data IKD untuk wilayah ini. Silakan klik tombol <strong>Tambah Indikator</strong> pada aspek yang diinginkan.
          <?php } ?>
        </div>
      <?php } ?>
    <?php } ?>

    <!-- Summary Strip -->
    <div class="summary-strip" id="summaryStrip"></div>

    <!-- Sections Container -->
    <div id="sectionsContainer"></div>

  </div>
</div>

<!-- Modal: Tambah / Edit Indikator -->
<div class="overlay" id="formOverlay">
  <div class="modal-ikd">
    <div class="modal-header-ikd">
      <h3 id="formTitle">Tambah Indikator Kinerja</h3>
      <button class="modal-close-ikd" id="closeFormBtn" aria-label="Tutup">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="4" x2="16" y2="16"/><line x1="16" y1="4" x2="4" y2="16"/></svg>
      </button>
    </div>

    <div class="aspek-info" id="aspekInfo">
      <span class="aspek-badge" id="aspekInfoBadge">I</span>
      <span id="aspekInfoName">ASPEK GEOGRAFI DAN DEMOGRAFI</span>
    </div>

    <form id="indikatorForm">
      <div class="modal-body-ikd">
        <input type="hidden" id="fId" value="">

        <div class="field-row" id="row-nama">
          <label for="fNama">Indikator Kinerja <span class="text-danger">*</span></label>
          <input type="text" id="fNama" placeholder="Contoh: Prevalensi Ketidakcukupan Konsumsi Pangan" required>
          <div class="field-error">Nama indikator wajib diisi.</div>
        </div>

        <div class="two-col">
          <div class="field-row" id="row-opd">
            <label for="fOpd">Perangkat Daerah Pengampu <span class="text-danger">*</span></label>
            <select id="fOpd" required>
              <option value="">Pilih perangkat daerah&hellip;</option>
              <?php if (!empty($Instansi)) { foreach ($Instansi as $ins) { ?>
                <option value="<?= html_escape($ins['nama']) ?>"><?= html_escape($ins['nama']) ?></option>
              <?php } } ?>
            </select>
            <div class="field-error">Perangkat daerah pengampu wajib dipilih.</div>
          </div>
          <div class="field-row" id="row-satuan">
            <label for="fSatuan">Satuan <span class="text-danger">*</span></label>
            <input type="text" id="fSatuan" list="satuanList" placeholder="Persen / Angka / Indeks" required>
            <datalist id="satuanList">
              <option value="Persen">
              <option value="Angka">
              <option value="Indeks">
              <option value="Rasio">
              <option value="Poin">
              <option value="Skor">
              <option value="Orang">
              <option value="Rupiah">
            </datalist>
            <div class="field-error">Satuan wajib diisi.</div>
          </div>
        </div>

        <div class="field-row">
          <label>Target Tahun</label>
          <table class="target-table" id="targetTable">
            <thead>
              <tr id="targetHeadRow">
                <th>2025</th>
                <th>2026</th>
                <th>2027</th>
                <th>2028</th>
                <th>2029</th>
                <th>2030</th>
              </tr>
            </thead>
            <tbody>
              <tr id="targetInputRow">
                <td><input type="text" inputmode="decimal" placeholder="0,00" id="target_2025"></td>
                <td><input type="text" inputmode="decimal" placeholder="0,00" id="target_2026"></td>
                <td><input type="text" inputmode="decimal" placeholder="0,00" id="target_2027"></td>
                <td><input type="text" inputmode="decimal" placeholder="0,00" id="target_2028"></td>
                <td><input type="text" inputmode="decimal" placeholder="0,00" id="target_2029"></td>
                <td><input type="text" inputmode="decimal" placeholder="0,00" id="target_2030"></td>
              </tr>
            </tbody>
          </table>
          <p class="target-caption">Gunakan koma atau titik untuk desimal, misal 5,61. Kolom boleh dikosongkan jika belum ada target.</p>
        </div>

      </div>
      <div class="modal-footer-ikd">
        <button type="button" class="btn-ikd btn-ikd-secondary" id="cancelFormBtn">Batal</button>
        <button type="submit" class="btn-ikd btn-ikd-primary" id="btnSubmitForm">Simpan Indikator</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Konfirmasi Hapus -->
<div class="overlay" id="deleteOverlay">
  <div class="modal-ikd confirm-modal">
    <div class="modal-header-ikd">
      <h3>Hapus Indikator?</h3>
      <button class="modal-close-ikd" id="closeDeleteBtn" aria-label="Tutup">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="4" x2="16" y2="16"/><line x1="16" y1="4" x2="4" y2="16"/></svg>
      </button>
    </div>
    <div class="modal-body-ikd">
      Indikator <strong id="deleteTargetName"></strong> akan dihapus permanen dari daftar. Tindakan ini tidak dapat dibatalkan.
    </div>
    <div class="modal-footer-ikd">
      <button type="button" class="btn-ikd btn-ikd-secondary" id="cancelDeleteBtn">Batal</button>
      <button type="button" class="btn-ikd btn-ikd-danger" id="confirmDeleteBtn">Hapus</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-ikd" id="toast"></div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
  var BaseURL = '<?= base_url() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

  var YEARS = [2025, 2026, 2027, 2028, 2029, 2030];

  var CATEGORIES = [
    { key:'geografi',      code:'I',   name:'ASPEK GEOGRAFI DAN DEMOGRAFI',      color:'#0E7C7B' },
    { key:'kesejahteraan', code:'II',  name:'ASPEK KESEJAHTERAAN MASYARAKAT',    color:'#B8891F' },
    { key:'dayasaing',     code:'III', name:'ASPEK DAYA SAING',                  color:'#173A5E' },
    { key:'pelayanan',     code:'IV',  name:'ASPEK PELAYANAN UMUM',              color:'#7A3B69' }
  ];

  var DEFAULT_OPD = [
    "Sekretariat Daerah",
    "Sekretariat DPRD",
    "Inspektorat Daerah",
    "Badan Perencanaan Pembangunan Daerah (Bappeda)",
    "Badan Pendapatan Daerah (Bapenda)",
    "Badan Pengelolaan Keuangan dan Aset Daerah (BPKAD)",
    "Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM)",
    "Badan Kesatuan Bangsa dan Politik (Kesbangpol)",
    "Badan Penanggulangan Bencana Daerah (BPBD)",
    "Dinas Pendidikan dan Kebudayaan",
    "Dinas Kesehatan",
    "Rumah Sakit Umum Daerah (RSUD)",
    "Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)",
    "Dinas Perumahan Rakyat dan Kawasan Permukiman",
    "Dinas Sosial",
    "Dinas Tenaga Kerja",
    "Dinas Pemberdayaan Perempuan, Perlindungan Anak, dan Keluarga Berencana",
    "Dinas Ketahanan Pangan",
    "Dinas Lingkungan Hidup",
    "Dinas Kependudukan dan Pencatatan Sipil",
    "Dinas Pemberdayaan Masyarakat dan Desa",
    "Dinas Perhubungan",
    "Dinas Komunikasi dan Informatika",
    "Dinas Koperasi, Usaha Kecil, dan Menengah",
    "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP)",
    "Dinas Pemuda dan Olahraga",
    "Dinas Perpustakaan dan Kearsipan",
    "Dinas Pertanian",
    "Dinas Perikanan",
    "Dinas Pariwisata dan Kebudayaan",
    "Dinas Perindustrian dan Perdagangan",
    "Satuan Polisi Pamong Praja (Satpol PP)"
  ];

  // Data IKD dari Database
  var DB_INDICATORS = <?= json_encode($Ikd ?? []) ?>;

  var state = {
    indicators: [],
    editingId: null,
    deletingId: null,
    searchTerm: '',
    pagination: {
      geografi: { page: 1, limit: 5 },
      kesejahteraan: { page: 1, limit: 5 },
      dayasaing: { page: 1, limit: 5 },
      pelayanan: { page: 1, limit: 5 }
    }
  };

  function escapeHtml(str){
    return String(str == null ? '' : str)
      .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
      .replace(/"/g,'&quot;').replace(/'/g,'&#39;');
  }

  function catByKey(key){
    for (var i=0; i<CATEGORIES.length; i++){ if (CATEGORIES[i].key===key) return CATEGORIES[i]; }
    return CATEGORIES[0];
  }

  function formatTargetsFromDB(row) {
    function cleanVal(v) {
      if (v == null || v === '') return '';
      return String(v).replace(',', '.');
    }
    return {
      2025: cleanVal(row.target_1),
      2026: cleanVal(row.target_2),
      2027: cleanVal(row.target_3),
      2028: cleanVal(row.target_4),
      2029: cleanVal(row.target_5),
      2030: cleanVal(row.target_6)
    };
  }

  function transformDBData() {
    state.indicators = DB_INDICATORS.map(function(item) {
      return {
        id: item.id,
        aspek: item.aspek || 'geografi',
        nama: item.indikator_sasaran || '',
        satuan: item.satuan || '',
        opd: item.pd_penanggung_jawab || '',
        targets: formatTargetsFromDB(item)
      };
    });
  }

  // ---------- Rendering ----------
  function renderSummary(){
    var html = '';
    CATEGORIES.forEach(function(cat){
      var count = state.indicators.filter(function(i){ return (i.aspek || 'geografi') === cat.key; }).length;
      html += '<div class="summary-card" style="--cat-color:'+cat.color+'">' +
                '<div class="num">'+count+'</div>' +
                '<div class="lbl">'+escapeHtml(cat.name)+'</div>' +
              '</div>';
    });
    document.getElementById('summaryStrip').innerHTML = html;
  }

  function renderSections(){
    var container = document.getElementById('sectionsContainer');
    var term = state.searchTerm.trim().toLowerCase();
    var html = '';

    CATEGORIES.forEach(function(cat){
      var allItems = state.indicators
        .filter(function(row){ return (row.aspek || 'geografi') === cat.key; });

      if (term){
        allItems = allItems.filter(function(row){
          return row.nama.toLowerCase().indexOf(term) !== -1 ||
                 (row.opd||'').toLowerCase().indexOf(term) !== -1 ||
                 (row.satuan||'').toLowerCase().indexOf(term) !== -1;
        });
      }

      var totalItems = allItems.length;
      var pag = state.pagination[cat.key] || { page: 1, limit: 5 };
      var limit = parseInt(pag.limit, 10);
      var totalPages = limit === -1 ? 1 : Math.max(1, Math.ceil(totalItems / limit));
      
      // Auto-correct current page if out of bounds
      if (pag.page > totalPages) {
        pag.page = totalPages;
      }
      if (pag.page < 1) {
        pag.page = 1;
      }

      var startIndex = limit === -1 ? 0 : (pag.page - 1) * limit;
      var endIndex = limit === -1 ? totalItems : Math.min(startIndex + limit, totalItems);
      var displayedItems = limit === -1 ? allItems : allItems.slice(startIndex, endIndex);

      html += '<section class="aspek-section" style="--cat-color:'+cat.color+'">';
      
      // Section Header Banner
      html += '<div class="aspek-band">' +
                '<span class="aspek-badge">'+cat.code+'</span>' +
                '<h2>'+escapeHtml(cat.name)+'</h2>' +
                '<span class="count-pill">'+totalItems+' indikator</span>' +
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                '<button type="button" class="btn-add" data-aspek="'+cat.key+'">' +
                  '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><line x1="10" y1="4" x2="10" y2="16"/><line x1="4" y1="10" x2="16" y2="10"/></svg>' +
                  'Tambah Indikator' +
                '</button>' +
                <?php } ?>
              '</div>';

      // Table Toolbar (Entries per page & Range Info)
      html += '<div class="table-toolbar">' +
                '<div class="table-length-selector">' +
                  '<label>Tampilkan ' +
                    '<select class="entries-select" data-aspek="'+cat.key+'">' +
                      '<option value="5" '+(limit===5?'selected':'')+'>5</option>' +
                      '<option value="10" '+(limit===10?'selected':'')+'>10</option>' +
                      '<option value="25" '+(limit===25?'selected':'')+'>25</option>' +
                      '<option value="50" '+(limit===50?'selected':'')+'>50</option>' +
                      '<option value="-1" '+(limit===-1?'selected':'')+'>Semua</option>' +
                    '</select> entri per halaman' +
                  '</label>' +
                '</div>' +
                '<div class="table-info-text">';
      if (totalItems > 0) {
        html += 'Menampilkan <b>' + (startIndex + 1) + '</b> - <b>' + endIndex + '</b> dari <b>' + totalItems + '</b> indikator';
      } else {
        html += 'Menampilkan 0 dari 0 indikator';
      }
      html +=   '</div>' +
              '</div>';

      // Table
      html += '<div class="table-wrap"><table class="ikd-table"><thead><tr>' +
                '<th style="width:36px;" class="center-col">No</th>' +
                '<th style="width:25%;">Indikator</th>' +
                '<th style="width:10%;">Satuan</th>';
      YEARS.forEach(function(y){ html += '<th class="num-col" style="width:7%;">'+y+'</th>'; });
      html += '<th style="width:22%;">Perangkat Daerah Pengampu</th>' +
              <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              '<th class="center-col" style="width:80px;">Aksi</th>' +
              <?php } ?>
              '</tr></thead><tbody>';

      if (displayedItems.length === 0){
        html += '<tr class="empty-row"><td colspan="'+(<?php echo (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? (4+6) : (3+6); ?>)+'">Belum ada indikator pada aspek ini. Klik <strong>Tambah Indikator</strong> untuk menambahkan.</td></tr>';
      } else {
        displayedItems.forEach(function(it, i){
          var rowNum = startIndex + i + 1;
          html += '<tr data-id="'+it.id+'">' +
                    '<td class="no-col">'+rowNum+'</td>' +
                    '<td class="indikator-name">'+escapeHtml(it.nama)+'</td>' +
                    '<td><span class="satuan-tag">'+escapeHtml(it.satuan || '-')+'</span></td>';
          YEARS.forEach(function(y){
            var v = it.targets && it.targets[y] ? it.targets[y] : '';
            html += '<td class="num-col">'+(v ? escapeHtml(v) : '<span style="color:#B7BEC9;">-</span>')+'</td>';
          });
          html += '<td class="opd-col'+(it.opd?' filled':'')+'">'+(it.opd ? escapeHtml(it.opd) : 'Belum ditentukan')+'</td>';
          <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
          html += '<td class="center-col"><div class="row-actions">' +
                    '<button type="button" class="icon-btn" data-action="edit" data-id="'+it.id+'" title="Edit indikator">' +
                      '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M13.5 3.5l3 3L6 17H3v-3L13.5 3.5z"/></svg>' +
                    '</button>' +
                    '<button type="button" class="icon-btn danger" data-action="delete" data-id="'+it.id+'" title="Hapus indikator">' +
                      '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 6h12M8 6V4h4v2M6 6l1 10h6l1-10"/></svg>' +
                    '</button>' +
                  '</div></td>';
          <?php } ?>
          html += '</tr>';
        });
      }

      html += '</tbody></table></div>';

      // Pagination Bottom Bar (Only if more than 0 items)
      if (totalItems > 0 && limit !== -1) {
        html += '<div class="table-pagination-wrap">' +
                  '<div class="pagination-info">Halaman <b>' + pag.page + '</b> dari <b>' + totalPages + '</b></div>' +
                  '<div class="pagination-controls">' +
                    '<button type="button" class="page-btn prev-btn" data-aspek="'+cat.key+'" data-page="'+(pag.page - 1)+'" '+(pag.page <= 1 ? 'disabled' : '')+'>&lsaquo; Prev</button>';

        // Render page number buttons
        var startP = Math.max(1, pag.page - 2);
        var endP = Math.min(totalPages, startP + 4);
        if (endP - startP < 4) {
          startP = Math.max(1, endP - 4);
        }

        if (startP > 1) {
          html += '<button type="button" class="page-btn num-btn" data-aspek="'+cat.key+'" data-page="1">1</button>';
          if (startP > 2) {
            html += '<span style="padding: 0 4px; color: var(--text-muted);">&hellip;</span>';
          }
        }

        for (var p = startP; p <= endP; p++) {
          html += '<button type="button" class="page-btn num-btn '+(p === pag.page ? 'active' : '')+'" data-aspek="'+cat.key+'" data-page="'+p+'">'+p+'</button>';
        }

        if (endP < totalPages) {
          if (endP < totalPages - 1) {
            html += '<span style="padding: 0 4px; color: var(--text-muted);">&hellip;</span>';
          }
          html += '<button type="button" class="page-btn num-btn" data-aspek="'+cat.key+'" data-page="'+totalPages+'">'+totalPages+'</button>';
        }

        html +=     '<button type="button" class="page-btn next-btn" data-aspek="'+cat.key+'" data-page="'+(pag.page + 1)+'" '+(pag.page >= totalPages ? 'disabled' : '')+'>Next &rsaquo;</button>' +
                  '</div>' +
                '</div>';
      }

      html += '</section>';
    });

    container.innerHTML = html;
  }

  function renderAll(){
    renderSummary();
    renderSections();
  }

  // ---------- Form Modal ----------
  function populateOpdSelect(selectedOpd){
    var sel = document.getElementById('fOpd');
    var existingValues = [];
    for (var i = 0; i < sel.options.length; i++) {
      if (sel.options[i].value) existingValues.push(sel.options[i].value);
    }
    DEFAULT_OPD.forEach(function(opdName){
      if (existingValues.indexOf(opdName) === -1) {
        var opt = document.createElement('option');
        opt.value = opdName;
        opt.textContent = opdName;
        sel.appendChild(opt);
      }
    });
    if (selectedOpd) {
      sel.value = selectedOpd;
    }
  }

  function clearFieldErrors(){
    ['row-nama','row-opd','row-satuan'].forEach(function(id){
      var el = document.getElementById(id);
      if (el) el.classList.remove('invalid');
    });
  }

  function openFormModal(aspekKey, editId){
    var cat = catByKey(aspekKey);
    state.editingId = editId || null;
    clearFieldErrors();

    document.getElementById('formTitle').textContent = editId ? 'Edit Indikator Kinerja' : 'Tambah Indikator Kinerja';
    var infoEl = document.getElementById('aspekInfo');
    infoEl.style.setProperty('--cat-color', cat.color);
    document.getElementById('aspekInfoBadge').textContent = cat.code;
    document.getElementById('aspekInfoName').textContent = cat.name;

    if (editId){
      var item = state.indicators.find(function(i){ return String(i.id) === String(editId); });
      if (item){
        document.getElementById('fId').value = item.id;
        document.getElementById('fNama').value = item.nama || '';
        document.getElementById('fSatuan').value = item.satuan || '';
        populateOpdSelect(item.opd);
        YEARS.forEach(function(y){
          document.getElementById('target_'+y).value = (item.targets && item.targets[y]) || '';
        });
      }
    } else {
      document.getElementById('fId').value = '';
      document.getElementById('fNama').value = '';
      document.getElementById('fSatuan').value = '';
      populateOpdSelect('');
      YEARS.forEach(function(y){
        document.getElementById('target_'+y).value = '';
      });
    }

    document.getElementById('indikatorForm').dataset.aspek = aspekKey;
    document.getElementById('formOverlay').classList.add('open');
    document.getElementById('fNama').focus();
  }

  function closeFormModal(){
    document.getElementById('formOverlay').classList.remove('open');
    state.editingId = null;
  }

  function handleFormSubmit(e){
    e.preventDefault();
    clearFieldErrors();

    var nama = document.getElementById('fNama').value.trim();
    var satuan = document.getElementById('fSatuan').value.trim();
    var opd = document.getElementById('fOpd').value;
    var aspekKey = document.getElementById('indikatorForm').dataset.aspek;
    var editId = document.getElementById('fId').value;

    var valid = true;
    if (!nama){ document.getElementById('row-nama').classList.add('invalid'); valid = false; }
    if (!satuan){ document.getElementById('row-satuan').classList.add('invalid'); valid = false; }
    if (!opd){ document.getElementById('row-opd').classList.add('invalid'); valid = false; }
    if (!valid) return;

    var postData = {
      aspek: aspekKey,
      nama: nama,
      satuan: satuan,
      opd: opd,
      target_2025: document.getElementById('target_2025').value.trim(),
      target_2026: document.getElementById('target_2026').value.trim(),
      target_2027: document.getElementById('target_2027').value.trim(),
      target_2028: document.getElementById('target_2028').value.trim(),
      target_2029: document.getElementById('target_2029').value.trim(),
      target_2030: document.getElementById('target_2030').value.trim(),
      [CSRF_NAME]: CSRF_TOKEN
    };

    var url = BaseURL + "Daerah/TambahIkd";
    if (editId) {
      url = BaseURL + "Daerah/EditIkd";
      postData.id = editId;
    }

    var submitBtn = document.getElementById('btnSubmitForm');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Menyimpan...';

    $.ajax({
      url: url,
      type: "POST",
      data: postData,
      dataType: "json",
      success: function(res) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Simpan Indikator';
        if (res.status === 'success') {
          showToast(res.message);
          closeFormModal();
          location.reload();
        } else {
          showToast(res.message || "Gagal menyimpan data!", "error");
        }
      },
      error: function(xhr, status, error) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Simpan Indikator';
        showToast("Terjadi kesalahan pada server: " + error, "error");
      }
    });
  }

  // ---------- Delete Modal ----------
  function openDeleteModal(id){
    var item = state.indicators.find(function(i){ return String(i.id) === String(id); });
    if (!item) return;
    state.deletingId = id;
    document.getElementById('deleteTargetName').textContent = item.nama;
    document.getElementById('deleteOverlay').classList.add('open');
  }

  function closeDeleteModal(){
    document.getElementById('deleteOverlay').classList.remove('open');
    state.deletingId = null;
  }

  function confirmDelete(){
    if (!state.deletingId) return;

    var btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;
    btn.textContent = 'Menghapus...';

    $.ajax({
      url: BaseURL + "Daerah/HapusIkd",
      type: "POST",
      data: {
        id: state.deletingId,
        [CSRF_NAME]: CSRF_TOKEN
      },
      dataType: "json",
      success: function(res) {
        btn.disabled = false;
        btn.textContent = 'Hapus';
        if (res.status === 'success') {
          showToast(res.message);
          closeDeleteModal();
          location.reload();
        } else {
          showToast(res.message || "Gagal menghapus data!", "error");
        }
      },
      error: function(xhr, status, error) {
        btn.disabled = false;
        btn.textContent = 'Hapus';
        showToast("Terjadi kesalahan pada server: " + error, "error");
      }
    });
  }

  // ---------- Toast Notification ----------
  var toastTimer = null;
  function showToast(msg, type){
    var el = document.getElementById('toast');
    el.className = 'toast-ikd' + (type==='error' ? ' error' : '');
    var icon = type==='error'
      ? '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><line x1="10" y1="6" x2="10" y2="11"/><circle cx="10" cy="14" r=".5" fill="currentColor"/></svg>'
      : '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M6 10l3 3 5-6"/></svg>';
    el.innerHTML = icon + '<span>' + escapeHtml(msg) + '</span>';
    requestAnimationFrame(function(){ el.classList.add('show'); });
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function(){ el.classList.remove('show'); }, 2800);
  }

  // ---------- Event Listeners ----------
  $(document).ready(function() {
    transformDBData();
    renderAll();
    populateOpdSelect('');

    // Wilayah Filter Logic
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
      $("#Provinsi").change(function() {
        if ($(this).val() === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          return;
        }
        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#KabKota").prop('disabled', true); },
          success: function(Respon) {
            try {
              var Data = JSON.parse(Respon);
              var KabKota = '<option value="">Pilih Kab/Kota</option>';
              if (Data.length > 0) {
                for (let i = 0; i < Data.length; i++) {
                  KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                }
              } else {
                alert("Belum Ada Data Kab/Kota");
              }
              $("#KabKota").html(KabKota).prop('disabled', false);
            } catch (e) {
              alert("Gagal memuat data Kab/Kota");
              $("#KabKota").prop('disabled', false);
            }
          },
          error: function() {
            alert("Gagal memuat data Kab/Kota");
            $("#KabKota").prop('disabled', false);
          }
        });
      });

      $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") {
          alert("Mohon Pilih Provinsi");
          return;
        }
        if ($("#KabKota").val() === "") {
          alert("Mohon Pilih Kab/Kota");
          return;
        }
        var kodeWilayah = $("#KabKota").val();
        $.ajax({
          url: BaseURL + "Daerah/SetTempKodeWilayah",
          type: "POST",
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
          success: function(Respon) {
            try {
              if (Respon === '1') {
                window.location.href = BaseURL + "Daerah/IKD";
              } else {
                var error = JSON.parse(Respon);
                alert(error.message || "Gagal menyimpan filter wilayah!");
                $("#Filter").prop('disabled', false).text('Filter');
              }
            } catch (e) {
              alert("Gagal memproses respons server!");
              $("#Filter").prop('disabled', false).text('Filter');
            }
          },
          error: function() {
            alert("Gagal menghubungi server!");
            $("#Filter").prop('disabled', false).text('Filter');
          }
        });
      });

      <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv);
        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
          success: function(Respon) {
            try {
              var Data = JSON.parse(Respon);
              var KabKota = '<option value="">Pilih Kab/Kota</option>';
              if (Data.length > 0) {
                for (let i = 0; i < Data.length; i++) {
                  var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                  KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                }
              }
              $("#KabKota").html(KabKota);
            } catch (e) {
              alert("Gagal memuat data Kab/Kota");
            }
          }
        });
      <?php } ?>
    <?php } ?>

    // Section Action Handlers (Add, Edit, Delete, Pagination, Entries per page)
    document.getElementById('sectionsContainer').addEventListener('click', function(e){
      // Add button
      var addBtn = e.target.closest('.btn-add');
      if (addBtn){
        openFormModal(addBtn.dataset.aspek, null);
        return;
      }

      // Action buttons (Edit / Delete)
      var actionBtn = e.target.closest('[data-action]');
      if (actionBtn){
        var id = actionBtn.dataset.id;
        if (actionBtn.dataset.action === 'edit'){
          var item = state.indicators.find(function(i){ return String(i.id) === String(id); });
          if (item) openFormModal(item.aspek, id);
        } else if (actionBtn.dataset.action === 'delete'){
          openDeleteModal(id);
        }
        return;
      }

      // Pagination button
      var pageBtn = e.target.closest('.page-btn');
      if (pageBtn && !pageBtn.disabled && pageBtn.dataset.page){
        var aspek = pageBtn.dataset.aspek;
        var targetPage = parseInt(pageBtn.dataset.page, 10);
        if (state.pagination[aspek] && targetPage > 0) {
          state.pagination[aspek].page = targetPage;
          renderSections();
        }
      }
    });

    // Entries per page change handler
    document.getElementById('sectionsContainer').addEventListener('change', function(e){
      var select = e.target.closest('.entries-select');
      if (select){
        var aspek = select.dataset.aspek;
        var limit = parseInt(select.value, 10);
        if (state.pagination[aspek]) {
          state.pagination[aspek].limit = limit;
          state.pagination[aspek].page = 1;
          renderSections();
        }
      }
    });

    document.getElementById('indikatorForm').addEventListener('submit', handleFormSubmit);
    document.getElementById('closeFormBtn').addEventListener('click', closeFormModal);
    document.getElementById('cancelFormBtn').addEventListener('click', closeFormModal);
    document.getElementById('formOverlay').addEventListener('click', function(e){
      if (e.target === document.getElementById('formOverlay')) closeFormModal();
    });

    document.getElementById('closeDeleteBtn').addEventListener('click', closeDeleteModal);
    document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);
    document.getElementById('confirmDeleteBtn').addEventListener('click', confirmDelete);
    document.getElementById('deleteOverlay').addEventListener('click', function(e){
      if (e.target === document.getElementById('deleteOverlay')) closeDeleteModal();
    });

    document.addEventListener('keydown', function(e){
      if (e.key === 'Escape'){
        closeFormModal();
        closeDeleteModal();
      }
    });

    // Live Search with Debounce
    var searchDebounce = null;
    document.getElementById('searchInput').addEventListener('input', function(e){
      clearTimeout(searchDebounce);
      var val = e.target.value;
      searchDebounce = setTimeout(function(){
        state.searchTerm = val;
        // Reset pages to 1 on search
        Object.keys(state.pagination).forEach(function(k){
          state.pagination[k].page = 1;
        });
        renderSections();
      }, 150);
    });
  });
</script>
</body>
</html>