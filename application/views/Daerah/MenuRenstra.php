<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    .table-renstra th, .table-renstra td { 
        vertical-align: middle; 
        text-align: center; 
        border: 1px solid #dee2e6; 
        padding: 8px; 
    }
    .uraian { 
        text-align: left !important; 
        padding-left: 15px !important; 
        white-space: pre-wrap; 
        word-break: break-word; 
    }
    .rp { white-space: nowrap; font-weight: 500; }
    .btn-aksi { padding: 5px 8px; font-size: 0.9rem; margin: 0 2px; }
    .filter-row .form-control { height: 38px; }
    
    .btn-group-aksi {
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    
    .nomenklatur-container {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background: #f9f9f9;
    }
    
    .nomenklatur-container .panel-heading {
        background: #e7f3ff;
        padding: 10px;
        margin: -15px -15px 15px -15px;
        border-radius: 8px 8px 0 0;
        border-bottom: 1px solid #d1e7ff;
    }
    
    .nav-tabs {
        margin-bottom: 20px;
    }
    
    .nav-tabs > li > a {
        font-weight: 500;
    }
    
    .info-nomenklatur {
        background: #d1ecf1;
        color: #0c5460;
        padding: 8px 12px;
        border-radius: 4px;
        margin-top: 10px;
        font-size: 12px;
    }
    
    .dropdown-level {
        margin-bottom: 15px;
    }
    
    .dropdown-level label {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .preview-panel {
        background: #e8f5e9;
        border: 1px solid #c8e6c9;
        border-radius: 8px;
    }
    
    .preview-panel .panel-heading {
        background: #c8e6c9;
        border-bottom: 1px solid #a5d6a7;
        border-radius: 8px 8px 0 0;
    }
    
    .preview-panel .form-control[readonly] {
        background-color: #f1f8e9;
    }
    
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 5px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .selected-option {
        background-color: #d4edda !important;
        font-weight: bold;
    }
    
    .alert-data-existing {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 10px;
        border-radius: 4px;
        margin-top: 10px;
    }
    
    .cascading-select {
        margin-bottom: 15px;
    }
    
    .cascading-select label {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .breadcrumb-nomenklatur {
        background: #e9ecef;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    
    .breadcrumb-nomenklatur .badge {
        background: #007bff;
        margin-right: 5px;
    }
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
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
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- FILTER INSTANSI SEBELUM LOGIN -->
                                            <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: none;">
                                                <div class="filter-group">
                                                    <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
                                                        <option value="">-- Semua Instansi --</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php 
                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                    if (!empty($filter_instansi_id)) { 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                    ?>
                                        <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- END FILTER WILAYAH -->

                        <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="filter-group">
                                                    <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansi">
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
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                                                        <b>Tampilkan</b>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                                                        <b>Reset</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- END FILTER INSTANSI -->

                        <!-- TAMPILKAN NAMA INSTANSI YANG SEDANG LOGIN (UNTUK ROLE 4) -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                                <br><small>Anda hanya dapat melihat dan mengelola data milik instansi Anda sendiri.</small>
                            </div>
                        <?php } ?>


                        <!-- TOMBOL TAMBAH (HANYA UNTUK ROLE 4) -->
                        <?php if ($IsRole4) { ?>
                            <div class="basic-tb-hd">
                                <div class="button-icon-btn sm-res-mg-t-30">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#ModalInput">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Data</b>
                                    </button>
                                </div>
                            </div>
                            <br>
                        <?php } ?>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-renstra">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">NO</th>
                                        <th>Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan Perangkat Daerah</th>
                                        <th>Indikator Kinerja</th>
                                        <th>Satuan</th>
                                        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                                            <th colspan="2" class="text-center"><?= $thn ?></th>
                                        <?php endfor; ?>
                                        <?php if ($IsRole4) { ?>
                                            <th class="text-center" style="width:120px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                                            <th class="text-center">Target</th>
                                            <th class="text-center">Rp</th>
                                        <?php endfor; ?>
                                        <?php if ($IsRole4) { ?>
                                            <th></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($anggaran)) { ?>
                                        <?php 
                                        $no = 1;
                                        foreach ($anggaran as $row) { ?>
                                            <tr>
                                                <td class="text-center"><?= html_escape($row['NoManual'] ?: $no) ?></td>
                                                <td class="uraian"><?= nl2br(html_escape($row['Uraian'])) ?></td>
                                                <td class="uraian"><?= nl2br(html_escape($row['IndikatorKinerja'] ?? '-')) ?></td>
                                                <td class="text-center"><?= html_escape($row['Satuan'] ?: '-') ?></td>

                                                <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                                                    <td class="text-right">
                                                        <?= $row["Target$thn"] ? number_format($row["Target$thn"], 2, ',', '.') : '-' ?>
                                                    </td>
                                                    <td class="text-right rp">
                                                        <?= $row["Rp$thn"] ? 'Rp ' . number_format($row["Rp$thn"], 0, ',', '.') : '-' ?>
                                                    </td>
                                                <?php endfor; ?>

                                                <?php if ($IsRole4) { ?>
                                                    <td class="text-center">
                                                        <?php if ($InstansiId == ($row['id_instansi'] ?? null)) { ?>
                                                            <div class="btn-group-aksi">
                                                                <button class="btn btn-warning btn-sm BtnEdit"
                                                                    data-id="<?= (int)$row['Id'] ?>"
                                                                    data-nomanual="<?= html_escape($row['NoManual'] ?? '') ?>"
                                                                    data-uraian="<?= html_escape($row['Uraian']) ?>"
                                                                    data-indikator="<?= html_escape($row['IndikatorKinerja'] ?? '') ?>"
                                                                    data-satuan="<?= html_escape($row['Satuan'] ?? '') ?>"
                                                                    data-target2025="<?= $row['Target2025'] ?? '' ?>"
                                                                    data-rp2025="<?= $row['Rp2025'] ?? '' ?>"
                                                                    data-target2026="<?= $row['Target2026'] ?? '' ?>"
                                                                    data-rp2026="<?= $row['Rp2026'] ?? '' ?>"
                                                                    data-target2027="<?= $row['Target2027'] ?? '' ?>"
                                                                    data-rp2027="<?= $row['Rp2027'] ?? '' ?>"
                                                                    data-target2028="<?= $row['Target2028'] ?? '' ?>"
                                                                    data-rp2028="<?= $row['Rp2028'] ?? '' ?>"
                                                                    data-target2029="<?= $row['Target2029'] ?? '' ?>"
                                                                    data-rp2029="<?= $row['Rp2029'] ?? '' ?>"
                                                                    data-target2030="<?= $row['Target2030'] ?? '' ?>"
                                                                    data-rp2030="<?= $row['Rp2030'] ?? '' ?>"
                                                                    data-keterangan="<?= html_escape($row['Keterangan'] ?? '') ?>"
                                                                    title="Edit">
                                                                    <i class="notika-icon notika-edit"></i> 
                                                                </button>
                                                                <button class="btn btn-danger btn-sm BtnHapus"
                                                                    data-id="<?= (int)$row['Id'] ?>"
                                                                    title="Hapus">
                                                                    <i class="notika-icon notika-trash"></i> 
                                                                </button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php 
                                        $no++;
                                        } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= $IsRole4 ? '17' : '16' ?>" class="text-center">
                                                <i>Belum ada data</i>
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

<!-- MODAL INPUT -->
<div class="modal fade" id="ModalInput" role="dialog">
    <div class="modal-dialog modal-lg" style="top:5%; width:90%; max-width:1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b>Tambah Menu Renstra PD</b></h4>
            </div>
            <div class="modal-body">
                <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                    <div class="alert alert-info">
                        <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                    </div>
                <?php } ?>
                
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_nomenklatur_input" data-toggle="tab">📋 Pilih dari Nomenklatur (Berjenjang)</a></li>
                    <li><a href="#tab_manual_input" data-toggle="tab">✏️ Isi Manual</a></li>
                </ul>
                
                <div class="tab-content" style="margin-top: 20px;">
                    
                    <!-- TAB NOMENKLATUR BERJENJANG -->
                    <div class="tab-pane fade in active" id="tab_nomenklatur_input">
                        <div class="nomenklatur-container">
                            <div class="panel-heading">
                                <b>📋 Pilih dari Nomenklatur (Berjenjang)</b>
                                <small class="text-muted">(Pilih urusan, bidang urusan, program, kegiatan, sub kegiatan)</small>
                            </div>
                            <div class="panel-body">
                                
                                <div class="breadcrumb-nomenklatur" id="breadcrumb_nomenklatur">
                                    <span class="badge">📁 Jalur Pilihan</span>
                                    <span id="path_display">Belum ada yang dipilih</span>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 cascading-select">
                                        <label><b>1. Urusan</b></label>
                                        <select class="form-control" id="select_urusan">
                                            <option value="">-- Pilih Urusan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 cascading-select">
                                        <label><b>2. Bidang Urusan</b></label>
                                        <select class="form-control" id="select_bidang_urusan" disabled>
                                            <option value="">-- Pilih Bidang Urusan --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 cascading-select">
                                        <label><b>3. Program</b></label>
                                        <select class="form-control" id="select_program" disabled>
                                            <option value="">-- Pilih Program --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 cascading-select">
                                        <label><b>4. Kegiatan</b></label>
                                        <select class="form-control" id="select_kegiatan" disabled>
                                            <option value="">-- Pilih Kegiatan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 cascading-select">
                                        <label><b>5. Sub Kegiatan</b></label>
                                        <select class="form-control" id="select_sub_kegiatan" disabled>
                                            <option value="">-- Pilih Sub Kegiatan --</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="info-nomenklatur" id="info_nomenklatur_input" style="display:none;">
                                    <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_text_input"></span>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="panel panel-default preview-panel">
                            <div class="panel-heading">
                                <b>📝 Preview Hasil Pilihan</b>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>Kode</b></label>
                                    <input type="text" class="form-control" id="preview_no_input" readonly style="background:#f1f8e9; font-family: monospace;">
                                </div>
                                <div class="form-group">
                                    <label><b>Uraian</b></label>
                                    <textarea class="form-control" id="preview_uraian_input" rows="3" readonly style="background:#f1f8e9;"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> <strong>Petunjuk:</strong> Pilih urusan, lalu bidang urusan, program, kegiatan, dan sub kegiatan secara berurutan.
                        </div>
                    </div>
                    
                    <!-- TAB MANUAL INPUT -->
                    <div class="tab-pane fade" id="tab_manual_input">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>✏️ Isi Manual</b>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>NO (diisi manual)</b></label>
                                    <input type="text" class="form-control" id="NoManual" placeholder="contoh: 1. atau A atau 1.1">
                                </div>
                                <div class="form-group">
                                    <label><b>Uraian</b></label>
                                    <textarea class="form-control" id="Uraian" rows="3" placeholder="Isi uraian secara manual..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Indikator Kinerja</b></label>
                            <textarea class="form-control" id="IndikatorKinerja" rows="2" placeholder="Indikator kinerja..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Satuan</b></label>
                            <input type="text" class="form-control" id="Satuan" placeholder="contoh: %, Orang, Dokumen">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Target <?= $thn ?></b></label>
                                <input type="number" step="0.01" class="form-control" id="Target<?= $thn ?>" placeholder="Target">
                            </div>
                            <div class="form-group">
                                <label><b>Rp <?= $thn ?></b></label>
                                <input type="number" step="0.01" class="form-control" id="Rp<?= $thn ?>" placeholder="Anggaran">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                
                <div class="form-group">
                    <label><b>Keterangan (Opsional)</b></label>
                    <textarea id="Keterangan" class="form-control" rows="2"></textarea>
                </div>
                
                <hr>
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEdit" role="dialog">
    <div class="modal-dialog modal-lg" style="top:5%; width:90%; max-width:1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b>Edit Menu Renstra PD</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditId">
                
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_nomenklatur_edit" data-toggle="tab">📋 Pilih dari Nomenklatur (Berjenjang)</a></li>
                    <li><a href="#tab_manual_edit" data-toggle="tab">✏️ Isi Manual</a></li>
                </ul>
                
                <div class="tab-content" style="margin-top: 20px;">
                    
                    <div class="tab-pane fade in active" id="tab_nomenklatur_edit">
                        <div class="nomenklatur-container">
                            <div class="panel-heading">
                                <b>📋 Pilih dari Nomenklatur (Berjenjang)</b>
                                <small class="text-muted">(Data yang tersimpan akan otomatis terpilih)</small>
                            </div>
                            <div class="panel-body">
                                
                                <div class="breadcrumb-nomenklatur" id="breadcrumb_nomenklatur_edit">
                                    <span class="badge">📁 Jalur Pilihan</span>
                                    <span id="path_display_edit">Belum ada yang dipilih</span>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 cascading-select">
                                        <label><b>1. Urusan</b></label>
                                        <select class="form-control" id="edit_select_urusan">
                                            <option value="">-- Pilih Urusan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 cascading-select">
                                        <label><b>2. Bidang Urusan</b></label>
                                        <select class="form-control" id="edit_select_bidang_urusan" disabled>
                                            <option value="">-- Pilih Bidang Urusan --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 cascading-select">
                                        <label><b>3. Program</b></label>
                                        <select class="form-control" id="edit_select_program" disabled>
                                            <option value="">-- Pilih Program --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 cascading-select">
                                        <label><b>4. Kegiatan</b></label>
                                        <select class="form-control" id="edit_select_kegiatan" disabled>
                                            <option value="">-- Pilih Kegiatan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 cascading-select">
                                        <label><b>5. Sub Kegiatan</b></label>
                                        <select class="form-control" id="edit_select_sub_kegiatan" disabled>
                                            <option value="">-- Pilih Sub Kegiatan --</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="info-nomenklatur" id="info_nomenklatur_edit" style="display:none;">
                                    <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_text_edit"></span>
                                </div>
                                
                                <div class="alert-data-existing" id="alert_data_existing" style="display:none;">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Data tersimpan:</strong> Kode <span id="existing_kode"></span> - 
                                    <span id="existing_nomenklatur"></span>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="panel panel-default preview-panel">
                            <div class="panel-heading">
                                <b>📝 Preview Hasil Pilihan</b>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>Kode</b></label>
                                    <input type="text" class="form-control" id="preview_no_edit" readonly style="background:#f1f8e9; font-family: monospace;">
                                </div>
                                <div class="form-group">
                                    <label><b>Uraian</b></label>
                                    <textarea class="form-control" id="preview_uraian_edit" rows="3" readonly style="background:#f1f8e9;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="tab_manual_edit">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>✏️ Edit Manual</b>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>NO (diisi manual)</b></label>
                                    <input type="text" class="form-control" id="EditNoManual">
                                </div>
                                <div class="form-group">
                                    <label><b>Uraian</b></label>
                                    <textarea class="form-control" id="EditUraian" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Indikator Kinerja</b></label>
                            <textarea class="form-control" id="EditIndikatorKinerja" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Satuan</b></label>
                            <input type="text" class="form-control" id="EditSatuan">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b>Target <?= $thn ?></b></label>
                                <input type="number" step="0.01" class="form-control" id="EditTarget<?= $thn ?>">
                            </div>
                            <div class="form-group">
                                <label><b>Rp <?= $thn ?></b></label>
                                <input type="number" step="0.01" class="form-control" id="EditRp<?= $thn ?>">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                
                <div class="form-group">
                    <label><b>Keterangan (Opsional)</b></label>
                    <textarea id="EditKeterangan" class="form-control" rows="2"></textarea>
                </div>
                
                <hr>
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnUpdate"><b>SIMPAN PERUBAHAN</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js') ?>"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

var existingKode = '';
var existingNomenklatur = '';

// Cache data nomenklatur
var nomenklaturCache = {
    level1: null,
    level2: null,
    level3: null,
    level4: null,
    level5: null
};

function countDots(str) {
    return (str.match(/\./g) || []).length;
}

$(document).ready(function() {
    
    // Inisialisasi DataTable
    if ($('#data-table-basic').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-basic')) {
                $('#data-table-basic').DataTable().destroy();
            }
            $('#data-table-basic').DataTable({
                "pageLength": 10,
                "ordering": false,
                "language": {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "drawCallback": function(settings) {
                    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                    pagination.find('a').css('margin', '0 5px');
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }

    setTimeout(function() {
        $('.dataTables_paginate a').css('margin', '0 5px');
        $('.dataTables_paginate span a').css('margin', '0 5px');
        $('.dataTables_paginate').css('margin-top', '10px');
        $('.dataTables_info').css('margin', '10px 0');
    }, 100);

    /* ================= FILTER WILAYAH SEBELUM LOGIN ================= */
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
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
            },
            error: function() { alert("Gagal memuat data Kab/Kota"); }
        });
    });

    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiGroupBefore").hide();
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
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
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                        options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
                    }
                }
                $("#FilterInstansiBeforeLogin").html(options);
                $("#FilterInstansiGroupBefore").show();
            },
            error: function() { alert("Gagal memuat data Instansi"); }
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
                    var redirectUrl = BaseURL + "Instansi/MenuRenstra";
                    if (instansiId && instansiId != '') {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab).trigger('change');
            <?php if (!empty($FilterInstansiId)) { ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
                    }
                }, 800);
            <?php } ?>
        }, 500);
    <?php } ?>

    <?php } ?>

    /* ================= FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) ================= */
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        $("#FilterInstansiBtn").click(function() {
            var instansiId = $("#FilterInstansi").val();
            var url = BaseURL + "Instansi/MenuRenstra";
            if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
            window.location.href = url;
        });
        $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/MenuRenstra"; });
    <?php } ?>
    
    /* ================= FUNGSI NOMENKLATUR INPUT ================= */
    
    function getNomenklatur(level, callback) {
        if (nomenklaturCache['level' + level]) {
            callback(nomenklaturCache['level' + level]);
            return;
        }
        
        $.ajax({
            url: BaseURL + "Instansi/getNomenklaturByLevel",
            type: "POST",
            data: { level: level, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            success: function(res) {
                nomenklaturCache['level' + level] = res;
                callback(res);
            },
            error: function() {
                console.log('Gagal memuat level ' + level);
                callback([]);
            }
        });
    }
    
    function loadUrusan() {
        getNomenklatur(1, function(res) {
            var options = '<option value="">-- Pilih Urusan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (countDots(res[i].Kode) === 0) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#select_urusan').html(options).prop('disabled', false);
        });
    }
    
    function loadBidangUrusan(kodeUrusan) {
        if (!kodeUrusan) {
            $('#select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(2, function(res) {
            var options = '<option value="">-- Pilih Bidang Urusan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeUrusan + '.') === 0 && countDots(res[i].Kode) === 1) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#select_bidang_urusan').html(options).prop('disabled', options === '<option value="">-- Pilih Bidang Urusan --</option>');
        });
    }
    
    function loadProgram(kodeBidang) {
        if (!kodeBidang) {
            $('#select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(3, function(res) {
            var options = '<option value="">-- Pilih Program --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeBidang + '.') === 0 && countDots(res[i].Kode) === 2) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#select_program').html(options).prop('disabled', options === '<option value="">-- Pilih Program --</option>');
        });
    }
    
    function loadKegiatan(kodeProgram) {
        if (!kodeProgram) {
            $('#select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(4, function(res) {
            var options = '<option value="">-- Pilih Kegiatan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeProgram + '.') === 0 && countDots(res[i].Kode) === 4) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#select_kegiatan').html(options).prop('disabled', options === '<option value="">-- Pilih Kegiatan --</option>');
        });
    }
    
    function loadSubKegiatan(kodeKegiatan) {
        if (!kodeKegiatan) {
            $('#select_sub_kegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(5, function(res) {
            var options = '<option value="">-- Pilih Sub Kegiatan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeKegiatan + '.') === 0 && countDots(res[i].Kode) === 5) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#select_sub_kegiatan').html(options).prop('disabled', options === '<option value="">-- Pilih Sub Kegiatan --</option>');
            updatePreview();
        });
    }
    
    function updatePreview() {
        var kode = $('#select_sub_kegiatan').val();
        var text = $('#select_sub_kegiatan option:selected').text();
        
        if (!kode || kode === "") {
            kode = $('#select_kegiatan').val();
            text = $('#select_kegiatan option:selected').text();
        }
        if (!kode || kode === "") {
            kode = $('#select_program').val();
            text = $('#select_program option:selected').text();
        }
        if (!kode || kode === "") {
            kode = $('#select_bidang_urusan').val();
            text = $('#select_bidang_urusan option:selected').text();
        }
        if (!kode || kode === "") {
            kode = $('#select_urusan').val();
            text = $('#select_urusan option:selected').text();
        }
        
        if (kode && text) {
            var parts = text.split(' - ');
            var nomenklatur = parts.slice(1).join(' - ');
            $('#preview_no_input').val(kode);
            $('#preview_uraian_input').val(nomenklatur);
            
            var path = '';
            if ($('#select_urusan').val()) {
                var urusanText = $('#select_urusan option:selected').text().split(' - ')[1];
                path += 'Urusan: ' + urusanText;
            }
            if ($('#select_bidang_urusan').val()) {
                var bidangText = $('#select_bidang_urusan option:selected').text().split(' - ')[1];
                path += ' → Bidang: ' + bidangText;
            }
            if ($('#select_program').val()) {
                var programText = $('#select_program option:selected').text().split(' - ')[1];
                path += ' → Program: ' + programText;
            }
            if ($('#select_kegiatan').val()) {
                var kegiatanText = $('#select_kegiatan option:selected').text().split(' - ')[1];
                path += ' → Kegiatan: ' + kegiatanText;
            }
            if ($('#select_sub_kegiatan').val()) {
                var subText = $('#select_sub_kegiatan option:selected').text().split(' - ')[1];
                path += ' → Sub Kegiatan: ' + subText;
            }
            
            $('#path_display').html(path || 'Belum ada yang dipilih');
            $('#info_nomenklatur_input').show();
            $('#selected_nomenklatur_text_input').html('<strong>Kode:</strong> ' + kode + '<br><strong>Uraian:</strong> ' + nomenklatur);
        } else {
            $('#preview_no_input, #preview_uraian_input').val('');
            $('#info_nomenklatur_input').hide();
            $('#path_display').html('Belum ada yang dipilih');
        }
    }
    
    function resetLowerLevels(startLevel) {
        if (startLevel <= 2) {
            $('#select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        }
        if (startLevel <= 3) {
            $('#select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
        if (startLevel <= 4) {
            $('#select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        }
        if (startLevel <= 5) {
            $('#select_sub_kegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        }
        updatePreview();
    }
    
    // Event handlers untuk input
    $('#select_urusan').change(function() {
        var kode = $(this).val();
        resetLowerLevels(2);
        if (kode) loadBidangUrusan(kode);
    });
    
    $('#select_bidang_urusan').change(function() {
        var kode = $(this).val();
        resetLowerLevels(3);
        if (kode) loadProgram(kode);
    });
    
    $('#select_program').change(function() {
        var kode = $(this).val();
        resetLowerLevels(4);
        if (kode) loadKegiatan(kode);
    });
    
    $('#select_kegiatan').change(function() {
        var kode = $(this).val();
        resetLowerLevels(5);
        if (kode) loadSubKegiatan(kode);
    });
    
    $('#select_sub_kegiatan').change(function() {
        updatePreview();
    });
    
    /* ================= FUNGSI EDIT (CASCADING) ================= */
    
    function loadEditUrusan(selectedKode) {
        getNomenklatur(1, function(res) {
            var options = '<option value="">-- Pilih Urusan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (countDots(res[i].Kode) === 0) {
                    var selected = (selectedKode && res[i].Kode == selectedKode) ? ' selected' : '';
                    options += '<option value="' + res[i].Kode + '"' + selected + '>' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#edit_select_urusan').html(options).prop('disabled', false);
            
            if (selectedKode) {
                $('#edit_select_urusan').trigger('change');
            }
        });
    }
    
    function loadEditBidangUrusan(kodeUrusan, selectedKode) {
        if (!kodeUrusan) {
            $('#edit_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(2, function(res) {
            var options = '<option value="">-- Pilih Bidang Urusan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeUrusan + '.') === 0 && countDots(res[i].Kode) === 1) {
                    var selected = (selectedKode && res[i].Kode == selectedKode) ? ' selected' : '';
                    options += '<option value="' + res[i].Kode + '"' + selected + '>' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#edit_select_bidang_urusan').html(options).prop('disabled', options === '<option value="">-- Pilih Bidang Urusan --</option>');
            
            if (selectedKode) {
                $('#edit_select_bidang_urusan').trigger('change');
            }
        });
    }
    
    function loadEditProgram(kodeBidang, selectedKode) {
        if (!kodeBidang) {
            $('#edit_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(3, function(res) {
            var options = '<option value="">-- Pilih Program --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeBidang + '.') === 0 && countDots(res[i].Kode) === 2) {
                    var selected = (selectedKode && res[i].Kode == selectedKode) ? ' selected' : '';
                    options += '<option value="' + res[i].Kode + '"' + selected + '>' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#edit_select_program').html(options).prop('disabled', options === '<option value="">-- Pilih Program --</option>');
            
            if (selectedKode) {
                $('#edit_select_program').trigger('change');
            }
        });
    }
    
    function loadEditKegiatan(kodeProgram, selectedKode) {
        if (!kodeProgram) {
            $('#edit_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(4, function(res) {
            var options = '<option value="">-- Pilih Kegiatan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeProgram + '.') === 0 && countDots(res[i].Kode) === 4) {
                    var selected = (selectedKode && res[i].Kode == selectedKode) ? ' selected' : '';
                    options += '<option value="' + res[i].Kode + '"' + selected + '>' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#edit_select_kegiatan').html(options).prop('disabled', options === '<option value="">-- Pilih Kegiatan --</option>');
            
            if (selectedKode) {
                $('#edit_select_kegiatan').trigger('change');
            }
        });
    }
    
    function loadEditSubKegiatan(kodeKegiatan, selectedKode) {
        if (!kodeKegiatan) {
            $('#edit_select_sub_kegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklatur(5, function(res) {
            var options = '<option value="">-- Pilih Sub Kegiatan --</option>';
            for (var i = 0; i < res.length; i++) {
                if (res[i].Kode.indexOf(kodeKegiatan + '.') === 0 && countDots(res[i].Kode) === 5) {
                    var selected = (selectedKode && res[i].Kode == selectedKode) ? ' selected' : '';
                    options += '<option value="' + res[i].Kode + '"' + selected + '>' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#edit_select_sub_kegiatan').html(options).prop('disabled', options === '<option value="">-- Pilih Sub Kegiatan --</option>');
            updateEditPreview();
        });
    }
    
    function updateEditPreview() {
        var kode = $('#edit_select_sub_kegiatan').val();
        var text = $('#edit_select_sub_kegiatan option:selected').text();
        
        if (!kode || kode === "") {
            kode = $('#edit_select_kegiatan').val();
            text = $('#edit_select_kegiatan option:selected').text();
        }
        if (!kode || kode === "") {
            kode = $('#edit_select_program').val();
            text = $('#edit_select_program option:selected').text();
        }
        if (!kode || kode === "") {
            kode = $('#edit_select_bidang_urusan').val();
            text = $('#edit_select_bidang_urusan option:selected').text();
        }
        if (!kode || kode === "") {
            kode = $('#edit_select_urusan').val();
            text = $('#edit_select_urusan option:selected').text();
        }
        
        if (kode && text) {
            var parts = text.split(' - ');
            var nomenklatur = parts.slice(1).join(' - ');
            $('#preview_no_edit').val(kode);
            $('#preview_uraian_edit').val(nomenklatur);
            $('#EditNoManual').val(kode);
            $('#EditUraian').val(nomenklatur);
            
            var path = '';
            if ($('#edit_select_urusan').val()) {
                var urusanText = $('#edit_select_urusan option:selected').text().split(' - ')[1];
                path += 'Urusan: ' + urusanText;
            }
            if ($('#edit_select_bidang_urusan').val()) {
                var bidangText = $('#edit_select_bidang_urusan option:selected').text().split(' - ')[1];
                path += ' → Bidang: ' + bidangText;
            }
            if ($('#edit_select_program').val()) {
                var programText = $('#edit_select_program option:selected').text().split(' - ')[1];
                path += ' → Program: ' + programText;
            }
            if ($('#edit_select_kegiatan').val()) {
                var kegiatanText = $('#edit_select_kegiatan option:selected').text().split(' - ')[1];
                path += ' → Kegiatan: ' + kegiatanText;
            }
            if ($('#edit_select_sub_kegiatan').val()) {
                var subText = $('#edit_select_sub_kegiatan option:selected').text().split(' - ')[1];
                path += ' → Sub Kegiatan: ' + subText;
            }
            
            $('#path_display_edit').html(path || 'Belum ada yang dipilih');
            $('#info_nomenklatur_edit').show();
            $('#selected_nomenklatur_text_edit').html('<strong>Kode:</strong> ' + kode + '<br><strong>Uraian:</strong> ' + nomenklatur);
            $('#existing_kode').text(kode);
            $('#existing_nomenklatur').text(nomenklatur);
            $('#alert_data_existing').show();
        } else {
            $('#preview_no_edit, #preview_uraian_edit').val('');
            $('#info_nomenklatur_edit').hide();
            $('#path_display_edit').html('Belum ada yang dipilih');
        }
    }
    
    function resetEditLowerLevels(startLevel) {
        if (startLevel <= 2) {
            $('#edit_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        }
        if (startLevel <= 3) {
            $('#edit_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
        if (startLevel <= 4) {
            $('#edit_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        }
        if (startLevel <= 5) {
            $('#edit_select_sub_kegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        }
        updateEditPreview();
    }
    
    // Event handlers untuk edit
    $('#edit_select_urusan').change(function() {
        var kode = $(this).val();
        resetEditLowerLevels(2);
        if (kode) loadEditBidangUrusan(kode, null);
    });
    
    $('#edit_select_bidang_urusan').change(function() {
        var kode = $(this).val();
        resetEditLowerLevels(3);
        if (kode) loadEditProgram(kode, null);
    });
    
    $('#edit_select_program').change(function() {
        var kode = $(this).val();
        resetEditLowerLevels(4);
        if (kode) loadEditKegiatan(kode, null);
    });
    
    $('#edit_select_kegiatan').change(function() {
        var kode = $(this).val();
        resetEditLowerLevels(5);
        if (kode) loadEditSubKegiatan(kode, null);
    });
    
    $('#edit_select_sub_kegiatan').change(function() {
        updateEditPreview();
    });
    
    /* ================= SIMPAN ================= */
    $("#BtnSimpan").click(function(){
        var data = {};
        data[CSRF_NAME] = CSRF_TOKEN;
        
        if ($('#tab_nomenklatur_input').hasClass('active')) {
            var kode = $('#select_sub_kegiatan').val();
            var uraian = $('#select_sub_kegiatan option:selected').text();
            
            if (!kode || kode === "") {
                kode = $('#select_kegiatan').val();
                uraian = $('#select_kegiatan option:selected').text();
            }
            if (!kode || kode === "") {
                kode = $('#select_program').val();
                uraian = $('#select_program option:selected').text();
            }
            if (!kode || kode === "") {
                kode = $('#select_bidang_urusan').val();
                uraian = $('#select_bidang_urusan option:selected').text();
            }
            if (!kode || kode === "") {
                kode = $('#select_urusan').val();
                uraian = $('#select_urusan option:selected').text();
            }
            
            data.NoManual = kode;
            var parts = uraian.split(' - ');
            data.Uraian = parts.slice(1).join(' - ');
            
            if (!data.NoManual || !data.Uraian) {
                alert("Silakan pilih data dari nomenklatur terlebih dahulu!");
                return;
            }
        } else {
            data.NoManual = $("#NoManual").val();
            data.Uraian = $("#Uraian").val();
            
            if (!data.Uraian) {
                alert("Uraian harus diisi!");
                return;
            }
        }
        
        data.IndikatorKinerja = $("#IndikatorKinerja").val();
        data.Satuan = $("#Satuan").val();
        data.Keterangan = $("#Keterangan").val();
        
        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            data["Target<?= $thn ?>"] = $("#Target<?= $thn ?>").val() || null;
            data["Rp<?= $thn ?>"] = $("#Rp<?= $thn ?>").val() || null;
        <?php endfor; ?>
        
        $.ajax({
            url: BaseURL + "Instansi/simpanMenuRenstra",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res){
                if(res.status === "success") {
                    alert("Data berhasil disimpan");
                    location.reload();
                } else {
                    alert(res.message || "Gagal menyimpan");
                }
            },
            error: function() {
                alert("Terjadi kesalahan saat menyimpan data");
            }
        });
    });
    
    /* ================= OPEN EDIT ================= */
    $(document).on("click", ".BtnEdit", function(){
        var btn = $(this);
        
        $("#EditId").val(btn.data("id"));
        
        // Pastikan data diambil sebagai string
        var noManual = String(btn.data("nomanual") || "");
        var uraian = String(btn.data("uraian") || "");
        
        // Set nilai ke form manual
        $("#EditNoManual").val(noManual);
        $("#EditUraian").val(uraian);
        $("#EditIndikatorKinerja").val(String(btn.data("indikator") || ""));
        $("#EditSatuan").val(String(btn.data("satuan") || ""));
        $("#EditKeterangan").val(String(btn.data("keterangan") || ""));
        
        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            $("#EditTarget<?= $thn ?>").val(String(btn.data("target<?= $thn ?>") || ""));
            $("#EditRp<?= $thn ?>").val(String(btn.data("rp<?= $thn ?>") || ""));
        <?php endfor; ?>
        
        existingKode = String(noManual);
        existingNomenklatur = String(uraian);
        
        console.log('Edit data - Kode:', existingKode, 'Uraian:', existingNomenklatur);
        
        // Reset edit form
        $('#edit_select_urusan, #edit_select_bidang_urusan, #edit_select_program, #edit_select_kegiatan, #edit_select_sub_kegiatan')
            .html('<option value="">-- Pilih --</option>').prop('disabled', true);
        $('#preview_no_edit, #preview_uraian_edit').val('');
        $('#alert_data_existing, #info_nomenklatur_edit').hide();
        $('#path_display_edit').html('Belum ada yang dipilih');
        
        // Load data untuk edit berdasarkan kode yang ada
        if (existingKode && existingKode !== "" && existingKode !== "null" && existingKode !== "undefined") {
            var kodeStr = String(existingKode);
            var parts = kodeStr.split('.');
            var dotCount = countDots(kodeStr);
            
            console.log('Parts:', parts, 'DotCount:', dotCount);
            
            if (dotCount === 0) {
                loadEditUrusan(kodeStr);
            } else if (dotCount === 1) {
                loadEditUrusan(parts[0]);
                setTimeout(function() {
                    loadEditBidangUrusan(parts[0], kodeStr);
                }, 300);
            } else if (dotCount === 2) {
                var kodeBidang = parts[0] + '.' + parts[1];
                loadEditUrusan(parts[0]);
                setTimeout(function() {
                    loadEditBidangUrusan(parts[0], kodeBidang);
                    setTimeout(function() {
                        loadEditProgram(kodeBidang, kodeStr);
                    }, 300);
                }, 300);
            } else if (dotCount === 4) {
                var kodeBidang = parts[0] + '.' + parts[1];
                var kodeProgram = parts[0] + '.' + parts[1] + '.' + parts[2];
                loadEditUrusan(parts[0]);
                setTimeout(function() {
                    loadEditBidangUrusan(parts[0], kodeBidang);
                    setTimeout(function() {
                        loadEditProgram(kodeBidang, kodeProgram);
                        setTimeout(function() {
                            loadEditKegiatan(kodeProgram, kodeStr);
                        }, 300);
                    }, 300);
                }, 300);
            } else if (dotCount === 5) {
                var kodeBidang = parts[0] + '.' + parts[1];
                var kodeProgram = parts[0] + '.' + parts[1] + '.' + parts[2];
                var kodeKegiatan = parts.slice(0, 5).join('.');
                loadEditUrusan(parts[0]);
                setTimeout(function() {
                    loadEditBidangUrusan(parts[0], kodeBidang);
                    setTimeout(function() {
                        loadEditProgram(kodeBidang, kodeProgram);
                        setTimeout(function() {
                            loadEditKegiatan(kodeProgram, kodeKegiatan);
                            setTimeout(function() {
                                loadEditSubKegiatan(kodeKegiatan, kodeStr);
                            }, 300);
                        }, 300);
                    }, 300);
                }, 300);
            }
        }
        
        $("#ModalEdit").modal("show");
    });
    
    /* ================= UPDATE ================= */
    $("#BtnUpdate").click(function(){
        var data = {
            Id: $("#EditId").val(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        if ($('#tab_nomenklatur_edit').hasClass('active')) {
            var kode = $('#edit_select_sub_kegiatan').val();
            var uraian = $('#edit_select_sub_kegiatan option:selected').text();
            
            if (!kode || kode === "") {
                kode = $('#edit_select_kegiatan').val();
                uraian = $('#edit_select_kegiatan option:selected').text();
            }
            if (!kode || kode === "") {
                kode = $('#edit_select_program').val();
                uraian = $('#edit_select_program option:selected').text();
            }
            if (!kode || kode === "") {
                kode = $('#edit_select_bidang_urusan').val();
                uraian = $('#edit_select_bidang_urusan option:selected').text();
            }
            if (!kode || kode === "") {
                kode = $('#edit_select_urusan').val();
                uraian = $('#edit_select_urusan option:selected').text();
            }
            
            data.NoManual = kode;
            var parts = uraian.split(' - ');
            data.Uraian = parts.slice(1).join(' - ');
            
            if (!data.NoManual || !data.Uraian) {
                alert("Silakan pilih data dari nomenklatur terlebih dahulu!");
                return;
            }
        } else {
            data.NoManual = $("#EditNoManual").val();
            data.Uraian = $("#EditUraian").val();
            
            if (!data.Uraian) {
                alert("Uraian harus diisi!");
                return;
            }
        }
        
        data.IndikatorKinerja = $("#EditIndikatorKinerja").val();
        data.Satuan = $("#EditSatuan").val();
        data.Keterangan = $("#EditKeterangan").val();
        
        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            data["Target<?= $thn ?>"] = $("#EditTarget<?= $thn ?>").val() || null;
            data["Rp<?= $thn ?>"] = $("#EditRp<?= $thn ?>").val() || null;
        <?php endfor; ?>
        
        $.ajax({
            url: BaseURL + "Instansi/simpanMenuRenstra",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res){
                if(res.status === "success") {
                    alert("Data berhasil diupdate");
                    location.reload();
                } else {
                    alert(res.message || "Gagal update");
                }
            },
            error: function() {
                alert("Terjadi kesalahan saat update data");
            }
        });
    });
    
    /* ================= HAPUS ================= */
    $(document).on("click", ".BtnHapus", function(){
        if(!confirm("Yakin hapus data ini?")) return;
        
        $.ajax({
            url: BaseURL + "Instansi/hapusMenuRenstra",
            type: "POST",
            data: {
                Id: $(this).data("id"),
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res){
                if(res.status === "success") {
                    alert("Data berhasil dihapus");
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus!");
                }
            },
            error: function() {
                alert("Terjadi kesalahan saat menghapus data");
            }
        });
    });
    
    /* ================= RESET FORM ================= */
    $('#ModalInput').on('hidden.bs.modal', function() {
        $('#NoManual, #Uraian, #IndikatorKinerja, #Satuan, #Keterangan').val('');
        $('#preview_no_input, #preview_uraian_input').val('');
        $('#select_urusan, #select_bidang_urusan, #select_program, #select_kegiatan, #select_sub_kegiatan')
            .html('<option value="">-- Pilih --</option>').prop('disabled', true);
        $('#path_display').html('Belum ada yang dipilih');
        $('#info_nomenklatur_input').hide();
        
        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            $('#Target<?= $thn ?>').val('');
            $('#Rp<?= $thn ?>').val('');
        <?php endfor; ?>
        
        $('a[href="#tab_manual_input"]').tab('show');
        loadUrusan();
    });
    
    $('#ModalEdit').on('hidden.bs.modal', function() {
        $('#EditNoManual, #EditUraian, #EditIndikatorKinerja, #EditSatuan, #EditKeterangan').val('');
        $('#preview_no_edit, #preview_uraian_edit').val('');
        $('#edit_select_urusan, #edit_select_bidang_urusan, #edit_select_program, #edit_select_kegiatan, #edit_select_sub_kegiatan')
            .html('<option value="">-- Pilih --</option>').prop('disabled', true);
        $('#path_display_edit').html('Belum ada yang dipilih');
        $('#info_nomenklatur_edit, #alert_data_existing').hide();
        
        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            $('#EditTarget<?= $thn ?>').val('');
            $('#EditRp<?= $thn ?>').val('');
        <?php endfor; ?>
        
        existingKode = '';
        existingNomenklatur = '';
    });
    
    // Inisialisasi
    loadUrusan();
    
});
</script>

</body>
</html>