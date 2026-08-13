<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
*{ box-sizing:border-box; }
html,body{ margin:0; padding:0; }

/* ============================================================
   CASCADING DROPDOWN UNTUK PROGRAM
   ============================================================ */
.cascading-select-program {
    margin-bottom: 12px;
}
.cascading-select-program select {
    height: 38px;
    font-size: 13px;
}
.cascading-select-program label {
    font-weight: 600;
    font-size: 12px;
    color: #495057;
    margin-bottom: 3px;
    display: block;
}
.breadcrumb-nomenklatur-program {
    background: #f8f9fa;
    padding: 8px 15px;
    border-radius: 4px;
    margin-bottom: 15px;
    border: 1px solid #dee2e6;
    font-size: 13px;
}
.breadcrumb-nomenklatur-program .badge {
    background: #d97706;
    color: #fff;
    padding: 4px 10px;
    border-radius: 4px;
    margin-right: 8px;
}
.breadcrumb-nomenklatur-program .path-display {
    font-weight: 500;
    color: #2c3e50;
}
.info-nomenklatur-program {
    background: #e8f0fe;
    padding: 10px 15px;
    border-radius: 4px;
    margin-top: 10px;
    border-left: 3px solid #007bff;
    display: none;
}
.info-nomenklatur-program strong {
    color: #1a5276;
}

/* ============================================================
   INDIKATOR ROW
   ============================================================ */
.indikator-program-row {
    background: #f8f9fa;
    padding: 15px 15px 10px 15px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    margin-bottom: 12px;
    transition: all 0.3s ease;
    position: relative;
}
.indikator-program-row:hover {
    border-color: #d97706;
    box-shadow: 0 2px 8px rgba(217,119,6,0.15);
}
.indikator-program-row.auto-filled {
    border-left: 5px solid #28a745;
    background: #f0fff4;
    padding-top: 38px;
}
.indikator-program-row.auto-filled .auto-badge {
    position: absolute;
    top: 6px;
    left: 12px;
    font-size: 10px;
    font-weight: 600;
    color: #155724;
    background: #d4edda;
    padding: 3px 14px;
    border-radius: 12px;
    display: inline-block;
    border: 1px solid #b8daff;
    letter-spacing: 0.3px;
}
.indikator-program-row .btn-remove-indikator {
    position: absolute;
    top: 5px;
    right: 8px;
    padding: 3px 10px;
    font-size: 14px;
    border-radius: 4px;
    z-index: 5;
    background: transparent;
    border: none;
    color: #dc3545;
    transition: all 0.3s ease;
}
.indikator-program-row .btn-remove-indikator:hover {
    background: #dc3545;
    color: #fff;
}
.indikator-program-row .field-label {
    font-size: 11px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 3px;
    display: block;
}
.indikator-program-row .row-fields .form-control {
    font-size: 13px;
    height: 36px;
}
.indikator-program-row .row-fields .rupiah-input {
    text-align: right;
    font-family: 'Courier New', monospace;
}

/* ============================================================
   OUTCOME STYLE - DIUBAH MENJADI SASARAN
   ============================================================ */
.program-outcome {
    margin-left: 20px;
    margin-top: 5px;
    font-size: 11px;
    color: #1a5276;
    background: #e8f0fe;
    padding: 4px 12px;
    border-radius: 4px;
    display: inline-block;
    font-weight: 600;
}
.program-outcome .outcome-label {
    font-weight: 700;
    color: #0c3b5e;
}
.program-outcome.sasaran-style {
    background: #e8f5e9;
    border-left: 3px solid #4caf50;
}
.program-outcome.sasaran-style .outcome-label {
    color: #2e7d32;
}

/* ============================================================
   SASARAN STYLING
   ============================================================ */
.sasaran-text {
    margin-left: 20px;
    margin-top: 3px;
    font-size: 11px;
    color: #2e7d32;
    background: #e8f5e9;
    padding: 3px 12px;
    border-radius: 4px;
    display: inline-block;
    font-weight: 600;
    border-left: 3px solid #4caf50;
}
.sasaran-text .sasaran-label {
    font-weight: 700;
    color: #1b5e20;
}

/* ============================================================
   TABEL RENSTRA
   ============================================================ */
.table-card{
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:10px;
    box-shadow:0 1px 2px rgba(15,23,42,.06);
    overflow:hidden;
}
.table-scroll{ overflow-x:auto; }
table.renstra{ width:100%; border-collapse:collapse; min-width:2200px; }

table.renstra thead{ position:sticky; top:0; z-index:5; }
table.renstra thead tr.head-row-1{ background:#ffffff; color:#1e293b; border-bottom:2px solid #e2e8f0; }
table.renstra thead tr.head-row-2{ background:#f8fafc; color:#475569; }
table.renstra thead th{
    padding:12px 12px;
    text-align:left;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.06em;
    vertical-align:middle;
    border-bottom:1px solid #e2e8f0;
}
table.renstra thead tr.head-row-2 th{
    padding:8px 10px;
    text-align:center;
    font-weight:600;
    font-size:10.5px;
    letter-spacing:.05em;
    border-left:1px solid #e2e8f0;
    border-bottom:1px solid #e2e8f0;
}
table.renstra thead tr.head-row-1 th.th-year{
    text-align:center;
    border-left:1px solid #e2e8f0;
}
th.col-no{ width:52px; }
th.col-name{ min-width:280px; }
th.col-indikator{ min-width:200px; }
th.col-satuan{ width:80px; }
th.col-sasaran{ min-width:150px; } /* DIUBAH DARI col-outcome */
th.col-aksi{ width:104px; text-align:center; }

tr.row-band td{
    padding:8px 12px;
    font-size:12px;
    font-weight:700;
    border-bottom:1px solid #e2e8f0;
}
tr.row-band-tujuan td.band-label{ background:#eff6ff; color:#1e3a8a; }
tr.row-band-sasaran td.band-label{ background:#f1f5f9; color:#334155; }
tr.row-band-section td.band-label{
    background:#f8fafc;
    color:#64748b;
    font-size:10.5px;
    text-transform:uppercase;
    letter-spacing:.08em;
    font-weight:700;
}

tr.row-name{ background:#fff; border-bottom:1px solid #f1f5f9; }
tr.row-name:hover{ background:#f8fafc; }
tr.row-level-tujuan > td:first-child{ box-shadow:inset 4px 0 0 0 #2563eb; }
tr.row-level-sasaran > td:first-child{ box-shadow:inset 4px 0 0 0 #7c3aed; }
tr.row-level-program > td:first-child{ box-shadow:inset 4px 0 0 0 #d97706; }
tr.row-level-kegiatan > td:first-child{ box-shadow:inset 4px 0 0 0 #0d9488; }
tr.row-level-subkegiatan > td:first-child{ box-shadow:inset 4px 0 0 0 #db2777; }

td.cell-no{ padding:11px 12px; font-size:13px; color:#64748b; white-space:nowrap; vertical-align:top; }
td.cell-name{ padding:11px 12px; font-size:13px; vertical-align:top; }
.name-inner{ display:flex; align-items:flex-start; gap:6px; }
.chevron-spacer{ width:20px; flex:none; }
.name-text{ color:#1e293b; }
.name-text.is-bold{ font-weight:700; }
.name-text.is-upper{ text-transform:uppercase; letter-spacing:.01em; }

td.cell-indikator-nama{ padding:8px 12px; font-size:12px; color:#334155; vertical-align:top; }
td.cell-satuan{ padding:8px 12px; font-size:12px; color:#475569; text-align:center; vertical-align:top; }
td.cell-sasaran{ padding:8px 12px; font-size:12px; color:#1a5276; vertical-align:top; font-weight:600; } /* DIUBAH DARI cell-outcome */
td.cell-kinerja{ padding:8px 12px; font-size:12px; color:#334155; text-align:center; vertical-align:top; }
td.cell-rp{
    padding:8px 12px;
    font-size:12px;
    color:#cbd5e1;
    text-align:center;
    vertical-align:top;
    white-space:nowrap;
    font-family:'Courier New', monospace;
}
td.cell-rp.has-value{ color:#1e293b; font-weight:600; }
td.cell-actions{ padding:11px 8px; vertical-align:top; }

.actions-inner{ display:flex; align-items:center; justify-content:center; gap:6px; flex-wrap:wrap; }

/* Indikator row - child dari program */
tr.indikator-row {
    background: #fafcff;
}
tr.indikator-row td {
    padding: 6px 12px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
tr.indikator-row:hover {
    background: #f1f5f9;
}

/* Button */
.btn-icon{
    width:28px; height:28px; border-radius:999px; border:none;
    display:flex; align-items:center; justify-content:center; flex:none;
    background:#f1f5f9; color:#64748b; transition:background .12s, color .12s;
}
.btn-icon:hover{ background:#e2e8f0; }
.btn-icon.btn-icon-add{ background:#2563eb; color:#fff; }
.btn-icon.btn-icon-add:hover{ background:#1d4ed8; }
.btn-icon.btn-edit{ background:#f59e0b; color:#fff; }
.btn-icon.btn-edit:hover{ background:#d97706; }
.btn-icon.btn-hapus{ background:#ef4444; color:#fff; }
.btn-icon.btn-hapus:hover{ background:#dc2626; }

.icon-sm{ width:15px; height:15px; }

.filter-row .form-control { height: 38px; }
.text-muted { color: #6c757d; }
.text-danger { color: #dc3545; }
.alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 12px 20px; border-radius: 4px; margin-bottom: 20px; }

/* Modal */
.modal-lg-custom { max-width: 95%; width: 95%; }
.modal-header .close { color: #fff; opacity: 1; }

/* Notification Toast */
#notification-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 99999;
    background: #28a745;
    color: #fff;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    font-size: 14px;
    max-width: 450px;
    animation: slideInRight 0.5s ease;
    display: flex;
    align-items: center;
    gap: 10px;
}
#notification-toast .toast-close {
    background: none;
    border: none;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    margin-left: 10px;
}
@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom:20px;">
                                <div class="row filter-row">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="filter-group">
                                            <label for="Provinsi"><b>Provinsi</b></label>
                                            <select class="form-control" id="Provinsi">
                                                <option value="">Pilih Provinsi</option>
                                                <?php foreach ($Provinsi as $prov) { ?>
                                                    <option value="<?= html_escape($prov['Kode']) ?>"
                                                        <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                        <?= html_escape($prov['Nama']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="filter-group">
                                            <label for="KabKota"><b>Kab/Kota</b></label>
                                            <select class="form-control" id="KabKota">
                                                <option value="">Pilih Kab/Kota</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display:none;">
                                        <div class="filter-group">
                                            <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                                            <select class="form-control" id="FilterInstansiBeforeLogin">
                                                <option value="">-- Semua Instansi --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="filter-group" style="margin-top:28px;">
                                            <button class="btn btn-primary btn-block" id="Filter"><b>Filter</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- FILTER INSTANSI -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom:20px;">
                                <div class="row filter-row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="filter-group">
                                            <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                            <select class="form-control" id="FilterInstansi">
                                                <option value="">-- Semua Instansi --</option>
                                                <?php foreach ($ListInstansi as $ins) { ?>
                                                    <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                        <?= html_escape($ins['nama']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="filter-group" style="margin-top:28px;">
                                            <button class="btn btn-info btn-block" id="FilterInstansiBtn"><b>Tampilkan</b></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="filter-group" style="margin-top:28px;">
                                            <button class="btn btn-default btn-block" id="ResetFilterBtn"><b>Reset</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- INFO INSTANSI -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                                <br><small>Anda hanya dapat mengelola data milik instansi Anda sendiri.</small>
                            </div>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH -->
                        <?php if ($IsRole4) { ?>
                            <div style="margin-bottom:20px;">
                                <button class="btn btn-success" id="btnTambahTujuan">
                                    <i class="fa fa-plus"></i> <b>Tambah Tujuan PD</b>
                                </button>
                            </div>
                        <?php } ?>

                        <!-- TABLE RENSTRA -->
                        <div class="table-card">
                            <div class="table-scroll">
                                <table class="renstra">
                                    <thead>
                                        <tr class="head-row-1">
                                            <th class="col-no" rowspan="2">No</th>
                                            <th class="col-name" rowspan="2">Tujuan/ Sasaran/ Program/ Kegiatan/ Sub Kegiatan Perangkat Daerah</th>
                                            <th class="col-sasaran" rowspan="2">Sasaran</th> <!-- DIUBAH DARI col-outcome -->
                                            <th class="col-indikator" rowspan="2">Indikator Kinerja</th>
                                            <th class="col-satuan" rowspan="2">Satuan</th>
                                            <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                <th class="th-year" colspan="2"><?= $y ?></th>
                                            <?php } ?>
                                            <th class="col-aksi" rowspan="2">Opsi Aksi</th>
                                        </tr>
                                        <tr class="head-row-2">
                                            <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                <th>Target</th>
                                                <th>Rp</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        <?php if (!empty($RenstraData)) { 
                                            $no_tujuan = 1;
                                            foreach ($RenstraData as $tujuan) { 
                                                $tujuan_id = $tujuan['id'] ?? 0;
                                                $tujuan_uraian = $tujuan['uraian'] ?? '';
                                                $tujuan_indikator = $tujuan['indikator'] ?? '';
                                                $tujuan_satuan = $tujuan['satuan'] ?? '';
                                        ?>
                                            <tr class="row-band row-band-tujuan">
                                                <td class="band-label" colspan="<?= 7 + (5*2) ?>">
                                                    <strong>Tujuan Perangkat Daerah <?= $no_tujuan ?></strong>
                                                </td>
                                            </tr>

                                            <tr class="row-name row-level-tujuan">
                                                <td class="cell-no"><?= $no_tujuan ?></td>
                                                <td class="cell-name">
                                                    <div class="name-inner">
                                                        <span class="chevron-spacer"></span>
                                                        <span class="name-text is-bold"><?= htmlspecialchars($tujuan_uraian) ?></span>
                                                    </div>
                                                </td>
                                                <td class="cell-sasaran">-</td> <!-- DIUBAH DARI cell-outcome -->
                                                <td class="cell-indikator-nama"><?= htmlspecialchars($tujuan_indikator ?: '-') ?></td>
                                                <td class="cell-satuan"><?= htmlspecialchars($tujuan_satuan ?: '-') ?></td>
                                                <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                    <td class="cell-kinerja"><?= htmlspecialchars($tujuan["target_$y"] ?? '-') ?></td>
                                                    <td class="cell-rp <?= (!empty($tujuan["anggaran_$y"])) ? 'has-value' : '' ?>">
                                                        <?= !empty($tujuan["anggaran_$y"]) ? 'Rp ' . number_format((float)$tujuan["anggaran_$y"], 0, ',', '.') : '-' ?>
                                                    </td>
                                                <?php } ?>
                                                <td class="cell-actions">
                                                    <div class="actions-inner">
                                                        <?php if ($IsRole4) { ?>
                                                            <button class="btn-icon btn-icon-add btnTambahSasaran" data-tujuan-id="<?= $tujuan_id ?>" title="Tambah Sasaran">
                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                            </button>
                                                            <button class="btn-icon btn-edit btnEditTujuan" data-id="<?= $tujuan_id ?>" title="Edit Tujuan">
                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                            </button>
                                                            <button class="btn-icon btn-hapus btnHapusTujuan" data-id="<?= $tujuan_id ?>" title="Hapus Tujuan">
                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M3 6h18"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php 
                                            $sasaran_list = $tujuan['sasaran_list'] ?? [];
                                            if (!empty($sasaran_list)) {
                                                $no_sasaran = 1;
                                                foreach ($sasaran_list as $sasaran) {
                                                    $sasaran_id = $sasaran['id'] ?? 0;
                                                    $sasaran_uraian = $sasaran['uraian'] ?? '';
                                                    $sasaran_indikator = $sasaran['indikator'] ?? '';
                                                    $sasaran_satuan = $sasaran['satuan'] ?? '';
                                            ?>
                                                <tr class="row-band row-band-sasaran">
                                                    <td class="band-label" colspan="<?= 7 + (5*2) ?>">Sasaran <?= $no_sasaran ?></td>
                                                </tr>

                                                <tr class="row-name row-level-sasaran">
                                                    <td class="cell-no"><?= $no_tujuan . '.' . $no_sasaran ?></td>
                                                    <td class="cell-name">
                                                        <div class="name-inner" style="margin-left:20px;">
                                                            <span class="chevron-spacer"></span>
                                                            <span class="name-text"><?= htmlspecialchars($sasaran_uraian) ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="cell-sasaran">-</td> <!-- DIUBAH DARI cell-outcome -->
                                                    <td class="cell-indikator-nama"><?= htmlspecialchars($sasaran_indikator ?: '-') ?></td>
                                                    <td class="cell-satuan"><?= htmlspecialchars($sasaran_satuan ?: '-') ?></td>
                                                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                        <td class="cell-kinerja"><?= htmlspecialchars($sasaran["target_$y"] ?? '-') ?></td>
                                                        <td class="cell-rp <?= (!empty($sasaran["anggaran_$y"])) ? 'has-value' : '' ?>">
                                                            <?= !empty($sasaran["anggaran_$y"]) ? 'Rp ' . number_format((float)$sasaran["anggaran_$y"], 0, ',', '.') : '-' ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td class="cell-actions">
                                                        <div class="actions-inner">
                                                            <?php if ($IsRole4) { ?>
                                                                <button class="btn-icon btn-icon-add btnTambahProgram" data-sasaran-id="<?= $sasaran_id ?>" title="Tambah Program">
                                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                                </button>
                                                                <button class="btn-icon btn-edit btnEditSasaran" data-id="<?= $sasaran_id ?>" title="Edit Sasaran">
                                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                                </button>
                                                                <button class="btn-icon btn-hapus btnHapusSasaran" data-id="<?= $sasaran_id ?>" title="Hapus Sasaran">
                                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M3 6h18"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <?php 
                                                $program_list = $sasaran['program_list'] ?? [];
                                                if (!empty($program_list)) {
                                                    $no_program = 1;
                                                    foreach ($program_list as $program) {
                                                        $program_id = $program['id'] ?? 0;
                                                        $program_nama = $program['nama'] ?? '';
                                                        $program_outcome = $program['outcome'] ?? '';
                                                        $indikator_list = $program['indikator_list'] ?? [];
                                                        $first_indikator = !empty($indikator_list) ? $indikator_list[0] : null;
                                                ?>
                                                    <tr class="row-band row-band-section">
                                                        <td class="band-label" colspan="<?= 7 + (5*2) ?>">Program <?= $no_program ?></td>
                                                    </tr>

                                                    <!-- ROW PROGRAM UTAMA -->
                                                    <tr class="program-row row-level-program">
                                                        <td class="cell-no"><?= $no_tujuan . '.' . $no_sasaran . '.' . $no_program ?></td>
                                                        <td class="cell-name">
                                                            <div class="name-inner" style="margin-left:40px;">
                                                                <span class="chevron-spacer"></span>
                                                                <span class="name-text is-upper"><?= htmlspecialchars($program_nama) ?></span>
                                                            </div>
                                                            <?php if (!empty($program_outcome)) { ?>
                                                                <div class="program-outcome sasaran-style">
                                                                    <span class="outcome-label">Sasaran:</span> <?= htmlspecialchars($program_outcome) ?>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="cell-sasaran"></td> <!-- DIUBAH DARI cell-outcome -->
                                                        <td class="cell-indikator-nama">
                                                            <?php if ($first_indikator) { ?>
                                                                <?= htmlspecialchars($first_indikator['indikator'] ?? '-') ?>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                        <td class="cell-satuan">
                                                            <?php if ($first_indikator) { ?>
                                                                <?= htmlspecialchars($first_indikator['satuan'] ?? '-') ?>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
                                                        </td>
                                                        <?php if ($first_indikator) { ?>
                                                            <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                                <td class="cell-kinerja"><?= htmlspecialchars($first_indikator["target_$y"] ?? '-') ?></td>
                                                                <td class="cell-rp <?= (!empty($first_indikator["anggaran_$y"])) ? 'has-value' : '' ?>">
                                                                    <?= !empty($first_indikator["anggaran_$y"]) ? 'Rp ' . number_format((float)$first_indikator["anggaran_$y"], 0, ',', '.') : '-' ?>
                                                                </td>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                                <td class="cell-kinerja">-</td>
                                                                <td class="cell-rp">-</td>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <td class="cell-actions">
                                                            <div class="actions-inner">
                                                                <?php if ($IsRole4) { ?>
                                                                    <button class="btn-icon btn-icon-add btnTambahKegiatan" data-program-id="<?= $program_id ?>" title="Tambah Kegiatan">
                                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                                    </button>
                                                                    <button class="btn-icon btn-edit btnEditProgram" data-id="<?= $program_id ?>" title="Edit Program">
                                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                                    </button>
                                                                    <button class="btn-icon btn-hapus btnHapusProgram" data-id="<?= $program_id ?>" title="Hapus Program">
                                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M3 6h18"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                                    </button>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- INDIKATOR LAINNYA -->
                                                    <?php if (!empty($indikator_list) && count($indikator_list) > 1) { 
                                                        for ($i = 1; $i < count($indikator_list); $i++) { 
                                                            $ind = $indikator_list[$i];
                                                    ?>
                                                        <tr class="indikator-row">
                                                            <td class="cell-no"></td>
                                                            <td class="cell-name"></td>
                                                            <td class="cell-sasaran"></td> <!-- DIUBAH DARI cell-outcome -->
                                                            <td class="cell-indikator-nama"><?= htmlspecialchars($ind['indikator'] ?? '-') ?></td>
                                                            <td class="cell-satuan"><?= htmlspecialchars($ind['satuan'] ?? '-') ?></td>
                                                            <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                                <td class="cell-kinerja"><?= htmlspecialchars($ind["target_$y"] ?? '-') ?></td>
                                                                <td class="cell-rp <?= (!empty($ind["anggaran_$y"])) ? 'has-value' : '' ?>">
                                                                    <?= !empty($ind["anggaran_$y"]) ? 'Rp ' . number_format((float)$ind["anggaran_$y"], 0, ',', '.') : '-' ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td class="cell-actions"></td>
                                                        </tr>
                                                    <?php } 
                                                    } 
                                                    ?>

                                                    <!-- KEGIATAN -->
                                                    <?php 
                                                    $kegiatan_list = $program['kegiatan_list'] ?? [];
                                                    if (!empty($kegiatan_list)) {
                                                        $no_kegiatan = 1;
                                                        foreach ($kegiatan_list as $kegiatan) {
                                                            $kegiatan_id = $kegiatan['id'] ?? 0;
                                                            $kegiatan_nama = $kegiatan['nama'] ?? '';
                                                            $kegiatan_indikator = $kegiatan['indikator'] ?? '';
                                                            $kegiatan_satuan = $kegiatan['satuan'] ?? '';
                                                            $kegiatan_sasaran = $kegiatan['sasaran'] ?? '';
                                                    ?>
                                                        <tr class="row-band row-band-section">
                                                            <td class="band-label" colspan="<?= 7 + (5*2) ?>">Kegiatan <?= $no_kegiatan ?></td>
                                                        </tr>

                                                        <tr class="row-name row-level-kegiatan">
                                                            <td class="cell-no"></td>
                                                            <td class="cell-name">
                                                                <div class="name-inner" style="margin-left:60px;">
                                                                    <span class="chevron-spacer"></span>
                                                                    <span class="name-text"><?= htmlspecialchars($kegiatan_nama) ?></span>
                                                                </div>
                                                                <!-- TAMPILKAN SASARAN KEGIATAN -->
                                                                <?php if (!empty($kegiatan_sasaran)) { ?>
                                                                    <div class="sasaran-text">
                                                                        <span class="sasaran-label">Sasaran:</span> <?= htmlspecialchars($kegiatan_sasaran) ?>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="cell-sasaran">-</td> <!-- DIUBAH DARI cell-outcome -->
                                                            <td class="cell-indikator-nama"><?= htmlspecialchars($kegiatan_indikator ?: '-') ?></td>
                                                            <td class="cell-satuan"><?= htmlspecialchars($kegiatan_satuan ?: '-') ?></td>
                                                            <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                                <td class="cell-kinerja"><?= htmlspecialchars($kegiatan["target_$y"] ?? '-') ?></td>
                                                                <td class="cell-rp <?= (!empty($kegiatan["anggaran_$y"])) ? 'has-value' : '' ?>">
                                                                    <?= !empty($kegiatan["anggaran_$y"]) ? 'Rp ' . number_format((float)$kegiatan["anggaran_$y"], 0, ',', '.') : '-' ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td class="cell-actions">
                                                                <div class="actions-inner">
                                                                    <?php if ($IsRole4) { ?>
                                                                        <button class="btn-icon btn-icon-add btnTambahSubKegiatan" data-kegiatan-id="<?= $kegiatan_id ?>" title="Tambah Sub Kegiatan">
                                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                                        </button>
                                                                        <button class="btn-icon btn-edit btnEditKegiatan" data-id="<?= $kegiatan_id ?>" title="Edit Kegiatan">
                                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                                        </button>
                                                                        <button class="btn-icon btn-hapus btnHapusKegiatan" data-id="<?= $kegiatan_id ?>" title="Hapus Kegiatan">
                                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M3 6h18"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                                        </button>
                                                                    <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <?php 
                                                        $sub_kegiatan_list = $kegiatan['sub_kegiatan_list'] ?? [];
                                                        if (!empty($sub_kegiatan_list)) {
                                                            $no_sub = 1;
                                                            foreach ($sub_kegiatan_list as $sub) {
                                                                $sub_id = $sub['id'] ?? 0;
                                                                $sub_nama = $sub['nama'] ?? '';
                                                                $sub_indikator = $sub['indikator'] ?? '';
                                                                $sub_satuan = $sub['satuan'] ?? '';
                                                                $sub_sasaran = $sub['sasaran'] ?? '';
                                                        ?>
                                                            <tr class="row-band row-band-section">
                                                                <td class="band-label" colspan="<?= 7 + (5*2) ?>">Sub Kegiatan <?= $no_sub ?></td>
                                                            </tr>

                                                            <tr class="row-name row-level-subkegiatan">
                                                                <td class="cell-no"><?= $no_sub ?></td>
                                                                <td class="cell-name">
                                                                    <div class="name-inner" style="margin-left:80px;">
                                                                        <span class="chevron-spacer"></span>
                                                                        <span class="name-text"><?= htmlspecialchars($sub_nama) ?></span>
                                                                    </div>
                                                                    <!-- TAMPILKAN SASARAN SUB KEGIATAN -->
                                                                    <?php if (!empty($sub_sasaran)) { ?>
                                                                        <div class="sasaran-text">
                                                                            <span class="sasaran-label">Sasaran:</span> <?= htmlspecialchars($sub_sasaran) ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="cell-sasaran">-</td> <!-- DIUBAH DARI cell-outcome -->
                                                                <td class="cell-indikator-nama"><?= htmlspecialchars($sub_indikator ?: '-') ?></td>
                                                                <td class="cell-satuan"><?= htmlspecialchars($sub_satuan ?: '-') ?></td>
                                                                <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                                                                    <td class="cell-kinerja"><?= htmlspecialchars($sub["target_$y"] ?? '-') ?></td>
                                                                    <td class="cell-rp <?= (!empty($sub["anggaran_$y"])) ? 'has-value' : '' ?>">
                                                                        <?= !empty($sub["anggaran_$y"]) ? 'Rp ' . number_format((float)$sub["anggaran_$y"], 0, ',', '.') : '-' ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <td class="cell-actions">
                                                                    <div class="actions-inner">
                                                                        <?php if ($IsRole4) { ?>
                                                                            <button class="btn-icon btn-edit btnEditSubKegiatan" data-id="<?= $sub_id ?>" title="Edit Sub Kegiatan">
                                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                                            </button>
                                                                            <button class="btn-icon btn-hapus btnHapusSubKegiatan" data-id="<?= $sub_id ?>" title="Hapus Sub Kegiatan">
                                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-sm"><path d="M3 6h18"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                                            </button>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php 
                                                            $no_sub++;
                                                            }
                                                        } 
                                                        ?>
                                                    <?php 
                                                        $no_kegiatan++;
                                                        }
                                                    } 
                                                    ?>
                                                <?php 
                                                    $no_program++;
                                                    }
                                                } 
                                                ?>
                                            <?php 
                                                $no_sasaran++;
                                                }
                                            } 
                                            ?>
                                        <?php 
                                            $no_tujuan++;
                                            } 
                                        } else { ?>
                                            <tr>
                                                <td colspan="<?= 7 + (5*2) ?>" style="text-align:center;padding:30px 0;color:#999;">
                                                    <i>Belum ada data Renstra PD</i>
                                                    <?php if ($IsRole4) { ?>
                                                        <br><small>Klik tombol <b>Tambah Tujuan PD</b> untuk memulai.</small>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL TUJUAN (dengan Dropdown Bidang) -->
<!-- ============================================================ -->
<div class="modal fade" id="modalTujuan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#2563eb; color:#fff; border-radius:6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="modalTujuanTitle">Tambah Tujuan PD</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="tujuan_id">
                <input type="hidden" id="tujuan_sasaran_rpjmd_id_hidden">
                
                <div class="form-group">
                    <label><b>Sasaran RPJMD</b></label>
                    <select class="form-control" id="tujuan_sasaran_rpjmd_id">
                        <option value="">-- Pilih Sasaran RPJMD --</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label><b>Uraian Tujuan</b> <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="tujuan_uraian" rows="3"></textarea>
                </div>
                
                <hr>
                
                <!-- DROPDOWN BIDANG -->
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="tujuan_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label><b>Indikator</b></label>
                    <input type="text" class="form-control" id="tujuan_indikator">
                </div>
                
                <div class="form-group">
                    <label><b>Satuan</b></label>
                    <input type="text" class="form-control" id="tujuan_satuan">
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>Target dan Anggaran per Tahun</b></h5>
                    </div>
                </div>
                <div class="row">
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Tahun <?= $y ?></b></label>
                                <input type="text" class="form-control" id="tujuan_target_<?= $y ?>" placeholder="Target">
                                <input type="text" class="form-control rupiah-input" id="tujuan_anggaran_<?= $y ?>" placeholder="Rp" style="margin-top:5px;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanTujuan"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL SASARAN (dengan Dropdown Bidang) -->
<!-- ============================================================ -->
<div class="modal fade" id="modalSasaran" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#7c3aed; color:#fff; border-radius:6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="modalSasaranTitle">Tambah Sasaran PD</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sasaran_id">
                <input type="hidden" id="sasaran_tujuan_id">
                
                <div class="form-group">
                    <label><b>Uraian Sasaran</b> <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="sasaran_uraian" rows="3"></textarea>
                </div>
                
                <hr>
                
                <!-- DROPDOWN BIDANG -->
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="sasaran_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label><b>Indikator</b></label>
                    <input type="text" class="form-control" id="sasaran_indikator">
                </div>
                
                <div class="form-group">
                    <label><b>Satuan</b></label>
                    <input type="text" class="form-control" id="sasaran_satuan">
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>Target dan Anggaran per Tahun</b></h5>
                    </div>
                </div>
                <div class="row">
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Tahun <?= $y ?></b></label>
                                <input type="text" class="form-control" id="sasaran_target_<?= $y ?>" placeholder="Target">
                                <input type="text" class="form-control rupiah-input" id="sasaran_anggaran_<?= $y ?>" placeholder="Rp" style="margin-top:5px;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanSasaran"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL PROGRAM (dengan Dropdown Bidang) -->
<!-- ============================================================ -->
<div class="modal fade" id="modalProgram" role="dialog">
    <div class="modal-dialog modal-lg modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header" style="background:#d97706; color:#fff; border-radius:6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="modalProgramTitle">Tambah Program</b></h4>
                <span id="ProgramIndikatorCounterBadge" class="badge" style="background:#fff; color:#d97706; padding:5px 12px; border-radius:20px; font-size:12px; margin-left:10px;">0 Indikator</span>
            </div>
            <div class="modal-body">
                <input type="hidden" id="program_id">
                <input type="hidden" id="program_sasaran_id">
                <input type="hidden" id="program_kode_program" value="">

                <!-- DROPDOWN HIERARKI -->
                <div class="panel panel-primary" style="border-color:#d97706;">
                    <div class="panel-heading" style="background:#d97706; color:#fff;">
                        <h4 class="panel-title"><b>📂 Pilih Program dari Nomenklatur</b></h4>
                        <small style="color:#fff; display:block; font-size:11px; margin-top:3px;">
                            💡 Pilih Program untuk mengisi Nama Program, Sasaran, Indikator, Target, dan Pagu secara otomatis
                        </small>
                    </div>
                    <div class="panel-body">
                        <div class="breadcrumb-nomenklatur-program">
                            <span class="badge">📁 Jalur Pilihan</span>
                            <span class="path-display" id="path_display_program">Belum ada yang dipilih</span>
                        </div>

                        <div class="row">
                            <div class="col-md-4 cascading-select-program">
                                <label><b>1. Urusan</b></label>
                                <select class="form-control" id="program_select_urusan">
                                    <option value="">-- Pilih Urusan --</option>
                                </select>
                            </div>
                            <div class="col-md-4 cascading-select-program">
                                <label><b>2. Bidang Urusan</b></label>
                                <select class="form-control" id="program_select_bidang" disabled>
                                    <option value="">-- Pilih Bidang Urusan --</option>
                                </select>
                            </div>
                            <div class="col-md-4 cascading-select-program">
                                <label><b>3. Program</b></label>
                                <select class="form-control" id="program_select_program" disabled>
                                    <option value="">-- Pilih Program --</option>
                                </select>
                            </div>
                        </div>

                        <div class="info-nomenklatur-program" id="info_nomenklatur_program">
                            <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_program"></span>
                            <button type="button" class="btn btn-success btn-sm pull-right" id="BtnAmbilIndikatorProgram" style="display:none;">
                                <i class="fa fa-download"></i> Ambil Indikator
                            </button>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- NAMA PROGRAM -->
                <div class="form-group">
                    <label><b>Nama Program</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="program_nama" readonly style="background:#f8f9fa;">
                </div>

                <!-- SASARAN (sebelumnya OUTCOME) -->
                <div class="form-group">
                    <label><b>Sasaran</b></label>
                    <input type="text" class="form-control" id="program_outcome" placeholder="Sasaran akan terisi otomatis" readonly style="background:#f8f9fa; color:#1a5276; font-weight:600;">
                    <small class="text-muted">Sasaran akan terisi otomatis dari Program PD</small>
                </div>

                <!-- DROPDOWN BIDANG -->
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="program_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>

                <!-- INDIKATOR DYNAMIC ROWS -->
                <div class="form-group">
                    <label><b>Indikator, Target, dan Anggaran per Tahun</b></label>
                    <div id="programIndikatorContainer"></div>
                    <button type="button" class="btn btn-success btn-sm" id="BtnTambahProgramIndikator">
                        <i class="fa fa-plus"></i> Tambah Indikator
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanProgram"><b>Simpan Program</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL KEGIATAN (dengan Dropdown Bidang + SASARAN) -->
<!-- ============================================================ -->
<div class="modal fade" id="modalKegiatan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#0d9488; color:#fff; border-radius:6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="modalKegiatanTitle">Tambah Kegiatan</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="kegiatan_id">
                <input type="hidden" id="kegiatan_program_id">
                
                <div class="form-group">
                    <label><b>Nama Kegiatan</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="kegiatan_nama">
                </div>
                
                <hr>
                
                <!-- DROPDOWN BIDANG -->
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="kegiatan_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <!-- SASARAN KEGIATAN -->
                <div class="form-group">
                    <label><b>Sasaran Kegiatan</b></label>
                    <textarea class="form-control" id="kegiatan_sasaran" rows="2" placeholder="Masukkan sasaran kegiatan"></textarea>
                    <small class="text-muted">Sasaran akan ditampilkan di bawah nama kegiatan pada tabel</small>
                </div>
                
                <div class="form-group">
                    <label><b>Indikator</b></label>
                    <input type="text" class="form-control" id="kegiatan_indikator">
                </div>
                
                <div class="form-group">
                    <label><b>Satuan</b></label>
                    <input type="text" class="form-control" id="kegiatan_satuan">
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>Target dan Anggaran per Tahun</b></h5>
                    </div>
                </div>
                <div class="row">
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Tahun <?= $y ?></b></label>
                                <input type="text" class="form-control" id="kegiatan_target_<?= $y ?>" placeholder="Target">
                                <input type="text" class="form-control rupiah-input" id="kegiatan_anggaran_<?= $y ?>" placeholder="Rp" style="margin-top:5px;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanKegiatan"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL SUB KEGIATAN (dengan Dropdown Bidang + SASARAN) -->
<!-- ============================================================ -->
<div class="modal fade" id="modalSubKegiatan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#db2777; color:#fff; border-radius:6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="modalSubKegiatanTitle">Tambah Sub Kegiatan</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="subkegiatan_id">
                <input type="hidden" id="subkegiatan_kegiatan_id">
                
                <div class="form-group">
                    <label><b>Nama Sub Kegiatan</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="subkegiatan_nama">
                </div>
                
                <hr>
                
                <!-- DROPDOWN BIDANG -->
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="subkegiatan_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <!-- SASARAN SUB KEGIATAN -->
                <div class="form-group">
                    <label><b>Sasaran Sub Kegiatan</b></label>
                    <textarea class="form-control" id="subkegiatan_sasaran" rows="2" placeholder="Masukkan sasaran sub kegiatan"></textarea>
                    <small class="text-muted">Sasaran akan ditampilkan di bawah nama sub kegiatan pada tabel</small>
                </div>
                
                <div class="form-group">
                    <label><b>Indikator</b></label>
                    <input type="text" class="form-control" id="subkegiatan_indikator">
                </div>
                
                <div class="form-group">
                    <label><b>Satuan</b></label>
                    <input type="text" class="form-control" id="subkegiatan_satuan">
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>Target dan Anggaran per Tahun</b></h5>
                    </div>
                </div>
                <div class="row">
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Tahun <?= $y ?></b></label>
                                <input type="text" class="form-control" id="subkegiatan_target_<?= $y ?>" placeholder="Target">
                                <input type="text" class="form-control rupiah-input" id="subkegiatan_anggaran_<?= $y ?>" placeholder="Rp" style="margin-top:5px;">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanSubKegiatan"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var FILTER_INSTANSI_ID = '<?= $FilterInstansiId ?? '' ?>';

$(document).ready(function() {

    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() {
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").hide();
            },
            success: function(Data) {
                var options = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
                    for (var i = 0; i < Data.length; i++) {
                        options += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(options).prop('disabled', false);
            }
        });
    });

    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiGroupBefore").hide();
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/GetListInstansiLevel4",
            type: "POST",
            data: { kode_wilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() {
                $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").show();
            },
            success: function(Data) {
                var options = '<option value="">-- Semua Instansi --</option>';
                if (Data && Data.length > 0) {
                    for (var i = 0; i < Data.length; i++) {
                        var selected = (FILTER_INSTANSI_ID == Data[i].id) ? 'selected' : '';
                        options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
                    }
                }
                $("#FilterInstansiBeforeLogin").html(options);
                $("#FilterInstansiGroupBefore").show();
            }
        });
    });

    $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") { alert("Mohon Pilih Provinsi"); return; }
        if ($("#KabKota").val() === "") { alert("Mohon Pilih Kab/Kota"); return; }
        var kodeWilayah = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
            success: function(res) {
                if (res === '1') {
                    var url = BaseURL + "Instansi/MenuRenstraPD";
                    if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
                    window.location.href = url;
                } else {
                    alert(res || "Gagal menyimpan filter!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); }
        });
    });
    <?php } ?>

    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function() {
        var instansiId = $("#FilterInstansi").val();
        var url = BaseURL + "Instansi/MenuRenstraPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() {
        window.location.href = BaseURL + "Instansi/MenuRenstraPD";
    });
    <?php } ?>

    // ==============================================
    // FUNGSI BANTUAN
    // ==============================================
    function loadSasaranRPJMD(selectId, selectedValue) {
        $.ajax({
            url: BaseURL + "Instansi/getSasaranRPJMD",
            type: "POST",
            data: { [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            beforeSend: function() {
                $("#" + selectId).html('<option value="">Memuat...</option>').prop('disabled', true);
            },
            success: function(data) {
                var options = '<option value="">-- Pilih Sasaran RPJMD --</option>';
                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var selected = (selectedValue && data[i].Id == selectedValue) ? 'selected' : '';
                        options += '<option value="' + data[i].Id + '" ' + selected + '>' + data[i].Sasaran + '</option>';
                    }
                }
                $("#" + selectId).html(options).prop('disabled', false);
            },
            error: function() {
                $("#" + selectId).html('<option value="">Gagal memuat data</option>').prop('disabled', false);
            }
        });
    }

    function formatRupiahInput(value) {
        if (!value) return '';
        var num = value.toString().replace(/[^0-9]/g, '');
        if (num === '') return '';
        return 'Rp ' + parseInt(num).toLocaleString('id-ID');
    }

    function parseRupiahInput(value) {
        if (!value) return '';
        return value.replace(/[^0-9]/g, '');
    }

    // Format otomatis untuk input rupiah
    $(document).on('input', '.rupiah-input', function() {
        var raw = $(this).val().replace(/[^0-9]/g, '');
        if (raw) {
            $(this).val('Rp ' + parseInt(raw).toLocaleString('id-ID'));
        } else {
            $(this).val('');
        }
    });

    // ==============================================
    // FUNGSI LOAD BIDANG DARI AKUN_KARYAWAN
    // ==============================================
    function loadBidangList(selectId, selectedValue) {
        $.ajax({
            url: BaseURL + "Instansi/getBidangList",
            type: "POST",
            data: {
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            beforeSend: function() {
                $("#" + selectId).html('<option value="">Memuat...</option>').prop('disabled', true);
            },
            success: function(data) {
                var options = '<option value="">-- Pilih Bidang --</option>';
                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var selected = (selectedValue && data[i].id == selectedValue) ? 'selected' : '';
                        var label = data[i].nama + (data[i].jabatan ? ' - ' + data[i].jabatan : '');
                        options += '<option value="' + data[i].id + '" ' + selected + '>' + label + '</option>';
                    }
                }
                $("#" + selectId).html(options).prop('disabled', false);
            },
            error: function() {
                $("#" + selectId).html('<option value="">Gagal memuat data</option>').prop('disabled', false);
            }
        });
    }

    // ==============================================
    // FUNGSI INDIKATOR MULTI
    // ==============================================
    function addProgramIndikatorRow(data) {
        var id = data ? data.id : 0;
        var indikator = data ? data.indikator : '';
        var satuan = data ? data.satuan : '';
        var isAutoFilled = data ? data.auto_filled : false;
        
        var autoClass = isAutoFilled ? 'auto-filled' : '';
        var autoBadge = isAutoFilled ? '<span class="auto-badge">📥 Dari Program PD</span>' : '';
        
        var html = `
            <div class="indikator-program-row ${autoClass}">
                <input type="hidden" class="program-indikator-row-id" value="${id}">
                ${autoBadge}
                <button type="button" class="btn btn-danger btn-sm btn-remove-indikator" title="Hapus Indikator">
                    <i class="fa fa-trash"></i>
                </button>
                
                <div class="row row-fields" style="margin-top: ${isAutoFilled ? '5px' : '0'};">
                    <div class="col-md-12">
                        <span class="field-label">Indikator</span>
                        <input type="text" name="program_indikator[]" class="form-control" placeholder="Indikator" value="${escapeHtml(indikator)}">
                    </div>
                </div>
                
                <div class="row row-fields" style="margin-top:8px;">
                    <div class="col-md-12">
                        <span class="field-label">Satuan</span>
                        <input type="text" name="program_satuan[]" class="form-control" placeholder="Satuan" value="${escapeHtml(satuan)}">
                    </div>
                </div>
                
                <div class="row row-fields" style="margin-top:8px;">
                    <div class="col-md-12">
                        <span class="field-label"><b>Target dan Anggaran per Tahun</b></span>
                    </div>
                </div>
                
                <div class="row row-fields" style="margin-top:5px;">
                    ${[2026, 2027, 2028, 2029, 2030].map(y => `
                        <div class="col-md-2">
                            <span class="field-label">Tahun ${y}</span>
                            <input type="text" name="program_target_${y}[]" class="form-control" placeholder="Target" value="${escapeHtml(data ? data['target_' + y] : '')}">
                            <input type="text" name="program_anggaran_${y}[]" class="form-control rupiah-input" placeholder="Rp" value="${escapeHtml(data ? data['pagu_' + y + '_formatted'] : '')}" style="margin-top:4px;">
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
        
        $('#programIndikatorContainer').append(html);
        updateProgramIndikatorCounter();
    }

    function updateProgramIndikatorCounter() {
        var count = $('#programIndikatorContainer .indikator-program-row').length;
        $('#ProgramIndikatorCounterBadge').text(count + ' Indikator');
    }

    function clearProgramIndikatorRows() {
        $('#programIndikatorContainer').empty();
        updateProgramIndikatorCounter();
    }

    function escapeHtml(text) {
        if (text === null || text === undefined) return '';
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function showNotification(message, type) {
        $('#notification-toast').remove();
        
        var bgColor = '#28a745';
        var icon = '✅';
        if (type === 'error') {
            bgColor = '#dc3545';
            icon = '❌';
        } else if (type === 'info') {
            bgColor = '#17a2b8';
            icon = 'ℹ️';
        } else if (type === 'warning') {
            bgColor = '#ffc107';
            icon = '⚠️';
        }
        
        var html = `
            <div id="notification-toast">
                <span style="font-size:20px;">${icon}</span>
                <span>${message}</span>
                <button class="toast-close" onclick="$('#notification-toast').remove()">&times;</button>
            </div>
        `;
        
        $('#notification-toast').remove();
        $('body').append(html);
        
        setTimeout(function() {
            $('#notification-toast').fadeOut(500, function() { $(this).remove(); });
        }, 5000);
    }

    // ==============================================
    // NOMENKLATUR CASCADING
    // ==============================================
    var nomenklaturCacheProgram = {};

    function getNomenklaturProgramRenstra(level, parentKode, callback) {
        var cacheKey = 'level' + level + '_' + (parentKode || 'root');
        if (nomenklaturCacheProgram[cacheKey]) {
            if (callback) callback(nomenklaturCacheProgram[cacheKey]);
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getNomenklaturByLevelRenja",
            type: "POST",
            data: {
                level: level,
                parent_kode: parentKode || '',
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                nomenklaturCacheProgram[cacheKey] = res;
                if (callback) callback(res);
            },
            error: function() {
                if (callback) callback([]);
            }
        });
    }

    function loadProgramLevel(level, parentKode) {
        var selectId = level == 1 ? 'program_select_urusan' : 
                       (level == 2 ? 'program_select_bidang' : 'program_select_program');
        
        if (level == 1) {
            $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#path_display_program').text('Belum ada yang dipilih');
            $('#info_nomenklatur_program').hide();
            clearProgramIndikatorRows();
            $('#program_nama').val('');
            $('#program_outcome').val('');
        } else if (level == 2) {
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }

        if (!parentKode && level > 1) {
            $('#' + selectId).html('<option value="">-- Pilih --</option>').prop('disabled', true);
            return;
        }

        getNomenklaturProgramRenstra(level, parentKode, function(res) {
            var options = '<option value="">-- Pilih ' + 
                (level == 1 ? 'Urusan' : (level == 2 ? 'Bidang Urusan' : 'Program')) + 
                ' --</option>';
            if (res && res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + 
                               res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#' + selectId).html(options).prop('disabled', false);
        });
    }

    function updatePathDisplayProgram() {
        var urusanVal = $('#program_select_urusan').val() || '';
        var bidangVal = $('#program_select_bidang').val() || '';
        var programVal = $('#program_select_program').val() || '';
        var urusanText = $('#program_select_urusan option:selected').text() || '';
        var bidangText = $('#program_select_bidang option:selected').text() || '';
        var programText = $('#program_select_program option:selected').text() || '';
        var parts = [];
        if (urusanVal) parts.push(urusanText);
        if (bidangVal) parts.push(bidangText);
        if (programVal) parts.push(programText);
        $('#path_display_program').text(parts.length ? parts.join(' → ') : 'Belum ada yang dipilih');
        
        var kodeProgram = $('#program_kode_program').val();
        var isEditing = $('#program_id').val() !== '';
        
        if (programVal) {
            $('#info_nomenklatur_program').show();
            var displayText = programText || 'Program terpilih: ' + programVal;
            $('#selected_nomenklatur_program').text(displayText);
            $('#program_kode_program').val(programVal);
            $('#BtnAmbilIndikatorProgram').show();
            loadIndikatorProgramMulti(programVal);
        } else {
            $('#info_nomenklatur_program').hide();
            $('#program_kode_program').val('');
            $('#BtnAmbilIndikatorProgram').hide();
            
            if (!isEditing) {
                var existingKode = $('#program_kode_program').val();
                if (!existingKode) {
                    clearProgramIndikatorRows();
                    addProgramIndikatorRow(null);
                    $('#program_nama').val('');
                    $('#program_outcome').val('');
                    updateProgramIndikatorCounter();
                }
            }
        }
    }

    function loadProgramLevel(level, parentKode, callback) {
        var selectId = level == 1 ? 'program_select_urusan' : 
                       (level == 2 ? 'program_select_bidang' : 'program_select_program');
        
        if (level == 1) {
            if ($('#program_id').val() === '') {
                clearProgramIndikatorRows();
                addProgramIndikatorRow(null);
                $('#program_nama').val('');
                $('#program_outcome').val('');
                $('#program_kode_program').val('');
                $('#path_display_program').text('Belum ada yang dipilih');
                $('#info_nomenklatur_program').hide();
                updateProgramIndikatorCounter();
            }
            $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        } else if (level == 2) {
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }

        if (!parentKode && level > 1) {
            $('#' + selectId).html('<option value="">-- Pilih --</option>').prop('disabled', true);
            if (callback) callback([]);
            return;
        }

        getNomenklaturProgramRenstra(level, parentKode, function(res) {
            var options = '<option value="">-- Pilih ' + 
                (level == 1 ? 'Urusan' : (level == 2 ? 'Bidang Urusan' : 'Program')) + 
                ' --</option>';
            if (res && res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + 
                               res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#' + selectId).html(options).prop('disabled', false);
            if (callback) callback(res);
        });
    }

    // Event handler untuk cascading dropdown
    $(document).on('change', '#program_select_urusan', function() {
        var urusanKode = $(this).val();
        var isEditing = $('#program_id').val() !== '';
        
        if (!isEditing) {
            clearProgramIndikatorRows();
            addProgramIndikatorRow(null);
            $('#program_nama').val('');
            $('#program_outcome').val('');
            $('#program_kode_program').val('');
            $('#program_select_program').val('');
            $('#BtnAmbilIndikatorProgram').hide();
            $('#info_nomenklatur_program').hide();
            $('#path_display_program').text('Belum ada yang dipilih');
            updateProgramIndikatorCounter();
        }
        
        if (urusanKode) {
            loadProgramLevel(2, urusanKode);
        } else {
            $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
    });

    $(document).on('change', '#program_select_bidang', function() {
        var bidangKode = $(this).val();
        var isEditing = $('#program_id').val() !== '';
        
        if (!isEditing) {
            clearProgramIndikatorRows();
            addProgramIndikatorRow(null);
            $('#program_nama').val('');
            $('#program_outcome').val('');
            $('#program_kode_program').val('');
            $('#program_select_program').val('');
            $('#BtnAmbilIndikatorProgram').hide();
            $('#info_nomenklatur_program').hide();
            $('#path_display_program').text('Belum ada yang dipilih');
            updateProgramIndikatorCounter();
        }
        
        if (bidangKode) {
            loadProgramLevel(3, bidangKode);
        } else {
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
    });

    $(document).on('change', '#program_select_program', function() {
        var programVal = $(this).val();
        var isEditing = $('#program_id').val() !== '';
        
        if (!programVal && !isEditing) {
            clearProgramIndikatorRows();
            addProgramIndikatorRow(null);
            $('#program_nama').val('');
            $('#program_outcome').val('');
            $('#program_kode_program').val('');
            $('#BtnAmbilIndikatorProgram').hide();
            $('#info_nomenklatur_program').hide();
            updateProgramIndikatorCounter();
        }
        
        updatePathDisplayProgram();
    });

    // ==============================================
    // AMBIL INDIKATOR + OUTCOME DARI PROGRAM PD
    // ==============================================
    function loadIndikatorProgramMulti(programKode) {
        if (!programKode || programKode === '') {
            var isEditing = $('#program_id').val() !== '';
            if (!isEditing) {
                clearProgramIndikatorRows();
                addProgramIndikatorRow(null);
                $('#program_nama').val('');
                $('#program_outcome').val('');
            }
            return;
        }
        
        $('#programIndikatorContainer').html('<div class="text-center" style="padding:20px;"><i class="fa fa-spinner fa-spin"></i> Memuat indikator dari Program PD...</div>');
        
        // Ambil data program (termasuk outcome)
        $.ajax({
            url: BaseURL + "Instansi/getProgramDetailByKode",
            type: "POST",
            data: {
                kode_program: programKode,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    $('#program_nama').val(res.data.nama_program || '');
                    $('#program_outcome').val(res.data.outcome || '');
                } else {
                    var isEditing = $('#program_id').val() !== '';
                    if (!isEditing) {
                        $('#program_nama').val('');
                        $('#program_outcome').val('');
                    }
                }
            },
            error: function() {
                var isEditing = $('#program_id').val() !== '';
                if (!isEditing) {
                    $('#program_nama').val('');
                    $('#program_outcome').val('');
                }
            }
        });
        
        // Ambil indikator
        $.ajax({
            url: BaseURL + "Instansi/getIndikatorProgramPDRenstra",
            type: "POST",
            data: {
                kode_program: programKode,
                tahun: 2026,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    var program = res.data.program || {};
                    var indikatorList = res.data.indikator || [];
                    
                    if ($('#program_nama').val() === '') {
                        $('#program_nama').val(program.nama_program || '');
                    }
                    if ($('#program_outcome').val() === '') {
                        $('#program_outcome').val(program.outcome || '');
                    }
                    
                    $('#programIndikatorContainer').empty();
                    
                    if (indikatorList.length > 0) {
                        for (var i = 0; i < indikatorList.length; i++) {
                            var item = indikatorList[i];
                            var data = {
                                indikator: item.indikator || '',
                                satuan: item.satuan || '',
                                target_2026: item.target_2026 || '',
                                target_2027: item.target_2027 || '',
                                target_2028: item.target_2028 || '',
                                target_2029: item.target_2029 || '',
                                target_2030: item.target_2030 || '',
                                pagu_2026_formatted: item.pagu_2026_formatted || '',
                                pagu_2027_formatted: item.pagu_2027_formatted || '',
                                pagu_2028_formatted: item.pagu_2028_formatted || '',
                                pagu_2029_formatted: item.pagu_2029_formatted || '',
                                pagu_2030_formatted: item.pagu_2030_formatted || '',
                                auto_filled: true
                            };
                            addProgramIndikatorRow(data);
                        }
                        showNotification('✅ ' + indikatorList.length + ' indikator dan Sasaran terisi otomatis', 'success');
                    } else {
                        addProgramIndikatorRow(null);
                        showNotification('ℹ️ Tidak ada indikator untuk Program ini', 'info');
                    }
                } else {
                    $('#programIndikatorContainer').empty();
                    addProgramIndikatorRow(null);
                    showNotification(res.message || 'Gagal memuat indikator', 'error');
                }
                updateProgramIndikatorCounter();
            },
            error: function(xhr, status, error) {
                console.error('Error loadIndikatorProgramMulti:', xhr.responseText);
                $('#programIndikatorContainer').empty();
                addProgramIndikatorRow(null);
                updateProgramIndikatorCounter();
                showNotification('Terjadi kesalahan saat memuat indikator', 'error');
            }
        });
    }

    // ==============================================
    // CRUD TUJUAN
    // ==============================================
    $("#btnTambahTujuan").click(function() {
        $("#modalTujuanTitle").text("Tambah Tujuan PD");
        $("#tujuan_id").val('');
        $("#tujuan_sasaran_rpjmd_id_hidden").val('');
        $("#tujuan_uraian").val('');
        $("#tujuan_indikator").val('');
        $("#tujuan_satuan").val('');
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            $("#tujuan_target_<?= $y ?>").val('');
            $("#tujuan_anggaran_<?= $y ?>").val('');
        <?php } ?>
        loadSasaranRPJMD('tujuan_sasaran_rpjmd_id', null);
        loadBidangList('tujuan_bidang_id', null);
        $("#modalTujuan").modal('show');
    });

    $(document).on("click", ".btnEditTujuan", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getRenstraTujuanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalTujuanTitle").text("Edit Tujuan PD");
                    $("#tujuan_id").val(res.data.id);
                    $("#tujuan_sasaran_rpjmd_id_hidden").val(res.data.sasaran_rpjmd_id || '');
                    $("#tujuan_uraian").val(res.data.uraian || '');
                    $("#tujuan_indikator").val(res.data.indikator || '');
                    $("#tujuan_satuan").val(res.data.satuan || '');
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        $("#tujuan_target_<?= $y ?>").val(res.data["target_<?= $y ?>"] || '');
                        $("#tujuan_anggaran_<?= $y ?>").val(res.data["anggaran_<?= $y ?>"] ? formatRupiahInput(res.data["anggaran_<?= $y ?>"]) : '');
                    <?php } ?>
                    loadSasaranRPJMD('tujuan_sasaran_rpjmd_id', res.data.sasaran_rpjmd_id);
                    loadBidangList('tujuan_bidang_id', res.data.bidang_id || null);
                    $("#modalTujuan").modal('show');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusTujuan", function() {
        if (!confirm("Yakin hapus Tujuan ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraTujuanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanTujuan").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        var id = $("#tujuan_id").val();
        var data = {
            id: id,
            sasaran_rpjmd_id: $("#tujuan_sasaran_rpjmd_id").val(),
            uraian: $("#tujuan_uraian").val(),
            indikator: $("#tujuan_indikator").val(),
            satuan: $("#tujuan_satuan").val(),
            bidang_id: $("#tujuan_bidang_id").val(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            data["target_<?= $y ?>"] = $("#tujuan_target_<?= $y ?>").val();
            data["anggaran_<?= $y ?>"] = parseRupiahInput($("#tujuan_anggaran_<?= $y ?>").val());
        <?php } ?>
        var url = id ? BaseURL + "Instansi/editRenstraTujuanPD" : BaseURL + "Instansi/tambahRenstraTujuanPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    $("#modalTujuan").modal('hide');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanTujuan").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // CRUD SASARAN
    // ==============================================
    $(document).on("click", ".btnTambahSasaran", function() {
        var tujuanId = $(this).data('tujuan-id');
        $("#modalSasaranTitle").text("Tambah Sasaran PD");
        $("#sasaran_id").val('');
        $("#sasaran_tujuan_id").val(tujuanId);
        $("#sasaran_uraian").val('');
        $("#sasaran_indikator").val('');
        $("#sasaran_satuan").val('');
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            $("#sasaran_target_<?= $y ?>").val('');
            $("#sasaran_anggaran_<?= $y ?>").val('');
        <?php } ?>
        loadBidangList('sasaran_bidang_id', null);
        $("#modalSasaran").modal('show');
    });

    $(document).on("click", ".btnEditSasaran", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getRenstraSasaranPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalSasaranTitle").text("Edit Sasaran PD");
                    $("#sasaran_id").val(res.data.id);
                    $("#sasaran_tujuan_id").val(res.data.tujuan_id);
                    $("#sasaran_uraian").val(res.data.uraian || '');
                    $("#sasaran_indikator").val(res.data.indikator || '');
                    $("#sasaran_satuan").val(res.data.satuan || '');
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        $("#sasaran_target_<?= $y ?>").val(res.data["target_<?= $y ?>"] || '');
                        $("#sasaran_anggaran_<?= $y ?>").val(res.data["anggaran_<?= $y ?>"] ? formatRupiahInput(res.data["anggaran_<?= $y ?>"]) : '');
                    <?php } ?>
                    loadBidangList('sasaran_bidang_id', res.data.bidang_id || null);
                    $("#modalSasaran").modal('show');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusSasaran", function() {
        if (!confirm("Yakin hapus Sasaran ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraSasaranPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanSasaran").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        var id = $("#sasaran_id").val();
        var data = {
            id: id,
            tujuan_id: $("#sasaran_tujuan_id").val(),
            uraian: $("#sasaran_uraian").val(),
            indikator: $("#sasaran_indikator").val(),
            satuan: $("#sasaran_satuan").val(),
            bidang_id: $("#sasaran_bidang_id").val(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            data["target_<?= $y ?>"] = $("#sasaran_target_<?= $y ?>").val();
            data["anggaran_<?= $y ?>"] = parseRupiahInput($("#sasaran_anggaran_<?= $y ?>").val());
        <?php } ?>
        var url = id ? BaseURL + "Instansi/editRenstraSasaranPD" : BaseURL + "Instansi/tambahRenstraSasaranPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    $("#modalSasaran").modal('hide');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanSasaran").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // CRUD PROGRAM
    // ==============================================
    $(document).on("click", ".btnTambahProgram", function() {
        var sasaranId = $(this).data('sasaran-id');
        $("#modalProgramTitle").text("Tambah Program");
        $("#program_id").val('');
        $("#program_sasaran_id").val(sasaranId);
        $("#program_outcome").val('');
        $("#program_nama").val('');
        $("#program_kode_program").val('');
        
        nomenklaturCacheProgram = {};
        $('#program_select_urusan').html('<option value="">-- Pilih Urusan --</option>');
        $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        $('#path_display_program').text('Belum ada yang dipilih');
        $('#info_nomenklatur_program').hide();
        $('#program_kode_program').val('');
        $('#BtnAmbilIndikatorProgram').hide();
        
        loadProgramLevel(1, '');
        
        clearProgramIndikatorRows();
        addProgramIndikatorRow(null);
        updateProgramIndikatorCounter();
        
        loadBidangList('program_bidang_id', null);
        $("#modalProgram").modal('show');
    });

    $(document).on("click", ".btnEditProgram", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Instansi/getRenstraProgramPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalProgramTitle").text("Edit Program");
                    $("#program_id").val(res.data.id);
                    $("#program_sasaran_id").val(res.data.sasaran_id);
                    $("#program_nama").val(res.data.nama);
                    $("#program_outcome").val(res.data.outcome || '');
                    $("#program_kode_program").val(res.data.kode_program || '');
                    
                    loadBidangList('program_bidang_id', res.data.bidang_id || null);
                    
                    var kodeProgram = res.data.kode_program || '';
                    
                    if (kodeProgram) {
                        var parts = kodeProgram.split('.');
                        nomenklaturCacheProgram = {};
                        
                        loadProgramLevel(1, '', function(resUrusan) {
                            if (parts.length >= 1) {
                                $('#program_select_urusan').val(parts[0]);
                                $('#program_select_urusan').trigger('change');
                            }
                        });
                        
                        if (parts.length >= 2) {
                            setTimeout(function() {
                                if ($('#program_select_bidang option').length > 1) {
                                    $('#program_select_bidang').val(parts.slice(0, 2).join('.'));
                                    $('#program_select_bidang').trigger('change');
                                }
                            }, 800);
                        }
                        
                        if (parts.length >= 3) {
                            setTimeout(function() {
                                if ($('#program_select_program option').length > 1) {
                                    $('#program_select_program').val(kodeProgram);
                                    $('#program_select_program').trigger('change');
                                }
                            }, 1600);
                        }
                    }
                    
                    $('#programIndikatorContainer').empty();
                    var indikatorList = res.data.indikator_list || [];
                    if (indikatorList.length > 0) {
                        for (var i = 0; i < indikatorList.length; i++) {
                            var item = indikatorList[i];
                            var data = {
                                id: item.id,
                                indikator: item.indikator || '',
                                satuan: item.satuan || '',
                                target_2026: item.target_2026 || '',
                                target_2027: item.target_2027 || '',
                                target_2028: item.target_2028 || '',
                                target_2029: item.target_2029 || '',
                                target_2030: item.target_2030 || '',
                                pagu_2026_formatted: item.anggaran_2026_formatted || '',
                                pagu_2027_formatted: item.anggaran_2027_formatted || '',
                                pagu_2028_formatted: item.anggaran_2028_formatted || '',
                                pagu_2029_formatted: item.anggaran_2029_formatted || '',
                                pagu_2030_formatted: item.anggaran_2030_formatted || '',
                                auto_filled: false
                            };
                            addProgramIndikatorRow(data);
                        }
                    } else {
                        addProgramIndikatorRow(null);
                    }
                    updateProgramIndikatorCounter();
                    
                    $("#modalProgram").modal('show');
                    
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusProgram", function() {
        if (!confirm("Yakin hapus Program ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraProgramPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanProgram").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        
        var id = $("#program_id").val();
        var sasaran_id = $("#program_sasaran_id").val();
        var nama = $("#program_nama").val();
        var outcome = $("#program_outcome").val();
        var kode_program = $("#program_kode_program").val();
        var bidang_id = $("#program_bidang_id").val();
        
        if (!nama) {
            alert('Nama Program harus diisi!');
            $(this).prop('disabled', false).text('Simpan Program');
            return;
        }
        
        var indikatorList = [];
        $('#programIndikatorContainer .indikator-program-row').each(function() {
            var indikator = $(this).find('input[name="program_indikator[]"]').val();
            if (indikator && indikator.trim() !== '') {
                var rowData = {
                    indikator: indikator.trim(),
                    satuan: $(this).find('input[name="program_satuan[]"]').val() || '',
                    target_2026: $(this).find('input[name="program_target_2026[]"]').val() || '',
                    target_2027: $(this).find('input[name="program_target_2027[]"]').val() || '',
                    target_2028: $(this).find('input[name="program_target_2028[]"]').val() || '',
                    target_2029: $(this).find('input[name="program_target_2029[]"]').val() || '',
                    target_2030: $(this).find('input[name="program_target_2030[]"]').val() || '',
                    anggaran_2026: parseRupiahInput($(this).find('input[name="program_anggaran_2026[]"]').val()),
                    anggaran_2027: parseRupiahInput($(this).find('input[name="program_anggaran_2027[]"]').val()),
                    anggaran_2028: parseRupiahInput($(this).find('input[name="program_anggaran_2028[]"]').val()),
                    anggaran_2029: parseRupiahInput($(this).find('input[name="program_anggaran_2029[]"]').val()),
                    anggaran_2030: parseRupiahInput($(this).find('input[name="program_anggaran_2030[]"]').val())
                };
                indikatorList.push(rowData);
            }
        });
        
        if (indikatorList.length === 0) {
            alert('Minimal 1 Indikator harus diisi!');
            $(this).prop('disabled', false).text('Simpan Program');
            return;
        }
        
        var data = {
            id: id,
            sasaran_id: sasaran_id,
            nama: nama,
            outcome: outcome,
            kode_program: kode_program,
            bidang_id: bidang_id,
            indikator_list: JSON.stringify(indikatorList),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = id ? BaseURL + "Instansi/editRenstraProgramPD" : BaseURL + "Instansi/tambahRenstraProgramPD";
        
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    $("#modalProgram").modal('hide');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanProgram").prop('disabled', false).text('Simpan Program');
            }
        });
    });

    // ==============================================
    // CRUD KEGIATAN (dengan SASARAN)
    // ==============================================
    $(document).on("click", ".btnTambahKegiatan", function() {
        var programId = $(this).data('program-id');
        $("#modalKegiatanTitle").text("Tambah Kegiatan");
        $("#kegiatan_id").val('');
        $("#kegiatan_program_id").val(programId);
        $("#kegiatan_nama").val('');
        $("#kegiatan_sasaran").val('');
        $("#kegiatan_indikator").val('');
        $("#kegiatan_satuan").val('');
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            $("#kegiatan_target_<?= $y ?>").val('');
            $("#kegiatan_anggaran_<?= $y ?>").val('');
        <?php } ?>
        loadBidangList('kegiatan_bidang_id', null);
        $("#modalKegiatan").modal('show');
    });

    $(document).on("click", ".btnEditKegiatan", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getRenstraKegiatanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalKegiatanTitle").text("Edit Kegiatan");
                    $("#kegiatan_id").val(res.data.id);
                    $("#kegiatan_program_id").val(res.data.program_id);
                    $("#kegiatan_nama").val(res.data.nama);
                    $("#kegiatan_sasaran").val(res.data.sasaran || '');
                    $("#kegiatan_indikator").val(res.data.indikator || '');
                    $("#kegiatan_satuan").val(res.data.satuan || '');
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        $("#kegiatan_target_<?= $y ?>").val(res.data["target_<?= $y ?>"] || '');
                        $("#kegiatan_anggaran_<?= $y ?>").val(res.data["anggaran_<?= $y ?>"] ? formatRupiahInput(res.data["anggaran_<?= $y ?>"]) : '');
                    <?php } ?>
                    loadBidangList('kegiatan_bidang_id', res.data.bidang_id || null);
                    $("#modalKegiatan").modal('show');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusKegiatan", function() {
        if (!confirm("Yakin hapus Kegiatan ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraKegiatanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanKegiatan").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        var id = $("#kegiatan_id").val();
        var data = {
            id: id,
            program_id: $("#kegiatan_program_id").val(),
            nama: $("#kegiatan_nama").val(),
            sasaran: $("#kegiatan_sasaran").val(),
            indikator: $("#kegiatan_indikator").val(),
            satuan: $("#kegiatan_satuan").val(),
            bidang_id: $("#kegiatan_bidang_id").val(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            data["target_<?= $y ?>"] = $("#kegiatan_target_<?= $y ?>").val();
            data["anggaran_<?= $y ?>"] = parseRupiahInput($("#kegiatan_anggaran_<?= $y ?>").val());
        <?php } ?>
        var url = id ? BaseURL + "Instansi/editRenstraKegiatanPD" : BaseURL + "Instansi/tambahRenstraKegiatanPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    $("#modalKegiatan").modal('hide');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanKegiatan").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // CRUD SUB KEGIATAN (dengan SASARAN)
    // ==============================================
    $(document).on("click", ".btnTambahSubKegiatan", function() {
        var kegiatanId = $(this).data('kegiatan-id');
        $("#modalSubKegiatanTitle").text("Tambah Sub Kegiatan");
        $("#subkegiatan_id").val('');
        $("#subkegiatan_kegiatan_id").val(kegiatanId);
        $("#subkegiatan_nama").val('');
        $("#subkegiatan_sasaran").val('');
        $("#subkegiatan_indikator").val('');
        $("#subkegiatan_satuan").val('');
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            $("#subkegiatan_target_<?= $y ?>").val('');
            $("#subkegiatan_anggaran_<?= $y ?>").val('');
        <?php } ?>
        loadBidangList('subkegiatan_bidang_id', null);
        $("#modalSubKegiatan").modal('show');
    });

    $(document).on("click", ".btnEditSubKegiatan", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getRenstraSubKegiatanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalSubKegiatanTitle").text("Edit Sub Kegiatan");
                    $("#subkegiatan_id").val(res.data.id);
                    $("#subkegiatan_kegiatan_id").val(res.data.kegiatan_id);
                    $("#subkegiatan_nama").val(res.data.nama);
                    $("#subkegiatan_sasaran").val(res.data.sasaran || '');
                    $("#subkegiatan_indikator").val(res.data.indikator || '');
                    $("#subkegiatan_satuan").val(res.data.satuan || '');
                    <?php for ($y = 2026; $y <= 2030; $y++) { ?>
                        $("#subkegiatan_target_<?= $y ?>").val(res.data["target_<?= $y ?>"] || '');
                        $("#subkegiatan_anggaran_<?= $y ?>").val(res.data["anggaran_<?= $y ?>"] ? formatRupiahInput(res.data["anggaran_<?= $y ?>"]) : '');
                    <?php } ?>
                    loadBidangList('subkegiatan_bidang_id', res.data.bidang_id || null);
                    $("#modalSubKegiatan").modal('show');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusSubKegiatan", function() {
        if (!confirm("Yakin hapus Sub Kegiatan ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraSubKegiatanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanSubKegiatan").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        var id = $("#subkegiatan_id").val();
        var data = {
            id: id,
            kegiatan_id: $("#subkegiatan_kegiatan_id").val(),
            nama: $("#subkegiatan_nama").val(),
            sasaran: $("#subkegiatan_sasaran").val(),
            indikator: $("#subkegiatan_indikator").val(),
            satuan: $("#subkegiatan_satuan").val(),
            bidang_id: $("#subkegiatan_bidang_id").val(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        <?php for ($y = 2026; $y <= 2030; $y++) { ?>
            data["target_<?= $y ?>"] = $("#subkegiatan_target_<?= $y ?>").val();
            data["anggaran_<?= $y ?>"] = parseRupiahInput($("#subkegiatan_anggaran_<?= $y ?>").val());
        <?php } ?>
        var url = id ? BaseURL + "Instansi/editRenstraSubKegiatanPD" : BaseURL + "Instansi/tambahRenstraSubKegiatanPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    $("#modalSubKegiatan").modal('hide');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanSubKegiatan").prop('disabled', false).text('Simpan');
            }
        });
    });

});
</script>

</body>
</html>