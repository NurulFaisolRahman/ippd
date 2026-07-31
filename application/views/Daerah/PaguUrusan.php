<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    .nomenklatur-container {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background: #f9f9f9;
    }
    .nomenklatur-container .panel-heading {
        background: #e7f3ff;
        padding: 10px;
        margin: -15px -15px 15px -15px;
        border-radius: 8px 8px 0 0;
        border-bottom: 1px solid #d1e7ff;
    }
    .breadcrumb-nomenklatur {
        background: #e9ecef;
        padding: 8px 12px;
        border-radius: 5px;
        margin-bottom: 12px;
        font-size: 13px;
    }
    .breadcrumb-nomenklatur .badge {
        background: #007bff;
        margin-right: 5px;
    }
    .cascading-select {
        margin-bottom: 12px;
    }
    .cascading-select label {
        font-weight: 600;
        margin-bottom: 3px;
        font-size: 13px;
    }
    .preview-panel {
        background: #e8f5e9;
        border: 1px solid #c8e6c9;
        border-radius: 8px;
        margin-top: 10px;
    }
    .preview-panel .panel-heading {
        background: #c8e6c9;
        padding: 8px 12px;
        border-bottom: 1px solid #a5d6a7;
        border-radius: 8px 8px 0 0;
        font-size: 13px;
    }
    .preview-panel .panel-body {
        padding: 12px;
    }
    .preview-panel .form-control[readonly] {
        background-color: #f1f8e9;
    }
    .info-nomenklatur {
        background: #d1ecf1;
        color: #0c5460;
        padding: 6px 10px;
        border-radius: 4px;
        margin-top: 8px;
        font-size: 12px;
    }
    .alert-data-existing {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 8px 12px;
        border-radius: 4px;
        margin-top: 8px;
        font-size: 13px;
    }
    .text-danger { color: #dc3545 !important; }
    .text-muted { color: #6c757d !important; }
    
    .form-control, .form-control option { color: #000 !important; }
    .modal-content { color: #000; }
    
    .filter-row {
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 10px;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .filter-group label {
        font-size: 14px;
        margin-bottom: 5px;
    }
    .filter-select {
        width: 260px;
        font-size: 14px;
        padding: 5px 8px;
    }
    @media (max-width: 768px) {
        .filter-row { flex-direction: column; gap: 15px; }
        .filter-select { width: 100%; }
        .table-responsive { overflow-x: auto; }
    }
    
    .table-bordered td, .table-bordered th {
        border: 1px solid #ddd !important;
    }
    
    .btn-warning {
        background-color: #f0ad4e;
        border-color: #eea236;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #d58512;
        color: #fff;
    }
    
    .spinner-border-sm {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
        vertical-align: middle;
        margin-right: 5px;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }

    .kode-urusan-kosong {
        color: #adb5bd;
        font-style: italic;
    }
    .pagu-kosong {
        color: #adb5bd;
        font-style: italic;
    }
    
    /* Tab styling */
    .nav-tabs {
        margin-bottom: 20px;
    }
    .nav-tabs > li > a {
        font-weight: 500;
    }
    .panel-manual {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background: #f9f9f9;
    }
    .panel-manual .panel-heading {
        background: #e7f3ff;
        padding: 10px;
        margin: -15px -15px 15px -15px;
        border-radius: 8px 8px 0 0;
        border-bottom: 1px solid #d1e7ff;
    }
    .alert-info-catatan {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
        padding: 10px 15px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    .alert-info-catatan i {
        margin-right: 5px;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            
                            <!-- Filter Wilayah -->
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
                                                            <option value="<?= html_escape($prov['Kode']) ?>">
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
                            <?php } ?>

                            <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <strong>Wilayah:</strong> <?= html_escape($NamaWilayah) ?>
                            </div>
                            <?php } ?>

                            <!-- Tombol Tambah - HANYA UNTUK LEVEL 3 -->
                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPaguUrusan">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Pagu Urusan</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Tabel -->
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr style="background-color: #f0f0f0; color: #333; text-align: center;">
                                        <th style="width: 10%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Kode Urusan
                                        </th>
                                        <th style="width: 55%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Urusan
                                        </th>
                                        <th style="width: 20%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Pagu Anggaran Indikatif
                                        </th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width: 15%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Aksi
                                        </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($PaguUrusan)) { ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted" style="padding: 30px 0;">
                                            <i class="fa fa-info-circle"></i> Belum ada data Pagu Urusan
                                        </td>
                                    </tr>
                                    <?php } else { ?>
                                    <?php foreach ($PaguUrusan as $row) { ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <?php if (!empty($row['kode_urusan'])) { ?>
                                                <span class="kode-urusan"><?= html_escape($row['kode_urusan']) ?></span>
                                            <?php } else { ?>
                                                <span class="kode-urusan-kosong">-</span>
                                            <?php } ?>
                                        </td>
                                        <td style="vertical-align: middle; padding: 8px; border: 1px solid #ddd;">
                                            <?= html_escape($row['urusan']); ?>
                                        </td>
                                        <td style="vertical-align: middle; padding: 8px; border: 1px solid #ddd; text-align: center;">
                                            <?php if (!empty($row['pagu'])) { ?>
                                                <strong>Rp <?= number_format($row['pagu'], 0, ',', '.') ?></strong>
                                            <?php } else { ?>
                                                <span class="pagu-kosong">-</span>
                                            <?php } ?>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <div class="btn-group" style="display: inline-flex; gap: 3px; flex-wrap: wrap; justify-content: center;">
                                                <button class="btn btn-sm btn-warning EditPaguUrusan" 
                                                        data-id="<?= $row['id'] ?>"
                                                        data-urusan="<?= html_escape($row['urusan']) ?>"
                                                        data-pagu="<?= html_escape($row['pagu']) ?>"
                                                        data-kode="<?= html_escape($row['kode_urusan'] ?? '') ?>"
                                                        title="Edit"
                                                        style="padding: 2px 8px; font-size: 11px; background-color: #f0ad4e; border-color: #eea236; color: #fff; border-radius: 3px;">
                                                    <i class="notika-icon notika-settings"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger HapusPaguUrusan" 
                                                        data-id="<?= $row['id'] ?>"
                                                        title="Hapus"
                                                        style="padding: 2px 8px; font-size: 11px; border-radius: 3px;">
                                                    <i class="notika-icon notika-trash"></i> Hapus
                                                </button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
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

<!-- ============================================================ -->
<!-- MODAL INPUT PAGU URUSAN - MODAL MELEBAR                      -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalInputPaguUrusan" role="dialog">
    <div class="modal-dialog" style="width: 95%; max-width: 1400px; margin: 80px auto;">
        <div class="modal-content" style="max-height: 100vh; overflow: hidden; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 3px solid #28a745; padding: 12px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 28px;">&times;</button>
                <h4 style="margin: 0;"><b><i class="notika-icon notika-plus" style="color: #28a745;"></i> Tambah Pagu Urusan</b></h4>
                <small class="text-muted" style="font-size: 12px;">Input pagu anggaran urusan untuk perencanaan</small>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 15px 20px; background: #fafafa;">
                
                <!-- Catatan -->
                <div class="alert alert-info" style="padding: 8px 12px; font-size: 12px; margin-bottom: 15px; border-radius: 4px;">
                    <i class="fa fa-info-circle"></i> 
                    <strong>Catatan:</strong> Field <b>Pagu Anggaran</b> dan <b>Kode Urusan (Manual)</b> bersifat opsional.
                    Hanya field <b>Urusan</b> yang wajib diisi.
                </div>
                
                <!-- TABS -->
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                    <li class="active"><a href="#tab_nomenklatur_input" data-toggle="tab">📋 Pilih dari Nomenklatur (Berjenjang)</a></li>
                    <li><a href="#tab_manual_input" data-toggle="tab">✏️ Isi Manual</a></li>
                </ul>
                
                <div class="tab-content" style="margin-top: 15px;">
                    
                    <!-- TAB NOMENKLATUR BERJENJANG -->
                    <div class="tab-pane fade in active" id="tab_nomenklatur_input">
                        <div class="nomenklatur-container" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px; background: #f9f9f9;">
                            <div class="panel-heading" style="background: #e7f3ff; padding: 8px 12px; margin: -12px -12px 12px -12px; border-radius: 8px 8px 0 0; border-bottom: 1px solid #d1e7ff;">
                                <b>📋 Pilih dari Nomenklatur (Berjenjang)</b>
                                <small class="text-muted">(Pilih urusan dan bidang urusan)</small>
                            </div>
                            <div class="panel-body" style="padding: 0;">
                                
                                <div class="breadcrumb-nomenklatur" id="breadcrumb_input" style="background: #e9ecef; padding: 6px 10px; border-radius: 4px; margin-bottom: 10px; font-size: 12px;">
                                    <span class="badge" style="background: #007bff; margin-right: 5px;">📁</span>
                                    <span id="path_display_input">Belum ada yang dipilih</span>
                                </div>
                                
                                <div class="row" style="margin: 0 -5px;">
                                    <div class="col-md-6 cascading-select" style="padding: 0 5px;">
                                        <label style="font-weight: 600; margin-bottom: 2px; font-size: 12px;"><b>1. Urusan</b> <span class="text-danger">*</span></label>
                                        <select class="form-control" id="select_urusan_input" style="height: 32px; font-size: 12px;">
                                            <option value="">-- Pilih Urusan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 cascading-select" style="padding: 0 5px;">
                                        <label style="font-weight: 600; margin-bottom: 2px; font-size: 12px;"><b>2. Bidang Urusan</b> <span class="text-muted">(opsional)</span></label>
                                        <select class="form-control" id="select_bidang_input" disabled style="height: 32px; font-size: 12px;">
                                            <option value="">-- Pilih Bidang Urusan --</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="info-nomenklatur" id="info_input" style="display:none; background: #d1ecf1; color: #0c5460; padding: 5px 10px; border-radius: 4px; margin-top: 8px; font-size: 12px;">
                                    <strong>📌 Terpilih:</strong> <span id="selected_text_input"></span>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- PREVIEW -->
                        <div class="preview-panel" style="background: #e8f5e9; border: 1px solid #c8e6c9; border-radius: 8px; margin-top: 10px;">
                            <div class="panel-heading" style="background: #c8e6c9; padding: 6px 12px; border-bottom: 1px solid #a5d6a7; border-radius: 8px 8px 0 0; font-size: 12px;">
                                <b>📝 Preview Hasil Pilihan</b>
                            </div>
                            <div class="panel-body" style="padding: 10px;">
                                <div class="row" style="margin: 0 -5px;">
                                    <div class="col-md-4" style="padding: 0 5px;">
                                        <label style="font-size: 11px; font-weight: 600; margin-bottom: 1px;"><b>Kode</b></label>
                                        <input type="text" class="form-control" id="preview_kode_input" readonly style="background:#f1f8e9; font-family: monospace; height: 30px; font-size: 12px;">
                                    </div>
                                    <div class="col-md-8" style="padding: 0 5px;">
                                        <label style="font-size: 11px; font-weight: 600; margin-bottom: 1px;"><b>Nama Urusan</b></label>
                                        <input type="text" class="form-control" id="preview_nama_input" readonly style="background:#f1f8e9; height: 30px; font-size: 12px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TAB MANUAL INPUT -->
                    <div class="tab-pane fade" id="tab_manual_input">
                        <div class="panel-manual" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px; background: #f9f9f9;">
                            <div class="panel-heading" style="background: #e7f3ff; padding: 8px 12px; margin: -12px -12px 12px -12px; border-radius: 8px 8px 0 0; border-bottom: 1px solid #d1e7ff;">
                                <b>✏️ Isi Manual</b>
                            </div>
                            <div class="panel-body" style="padding: 0;">
                                <div class="alert alert-info" style="padding: 6px 10px; font-size: 12px; margin-bottom: 10px; border-radius: 4px;">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Catatan:</strong> Field <b>Kode Urusan</b> bersifat opsional (boleh dikosongkan).
                                    Hanya <b>Nama Urusan</b> yang wajib diisi.
                                </div>
                                <div class="form-group" style="margin-bottom: 8px;">
                                    <label style="font-size: 12px; font-weight: 600; margin-bottom: 2px;"><b>Kode Urusan</b> <span class="text-muted">(opsional)</span></label>
                                    <input type="text" class="form-control" id="ManualKodeUrusan" 
                                           placeholder="Contoh: 1 atau 1.1 atau 2.3 (kosongkan jika tidak ada)" style="color: #000; height: 32px; font-size: 12px;">
                                    <small class="text-muted" style="font-size: 10px;">Tidak wajib diisi, kosongkan jika tidak ada kode</small>
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 12px; font-weight: 600; margin-bottom: 2px;"><b>Nama Urusan</b> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ManualNamaUrusan" 
                                           placeholder="Masukkan nama urusan secara manual..." style="color: #000; height: 32px; font-size: 12px;">
                                    <small class="text-danger" style="font-size: 10px;">Wajib diisi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <hr style="margin: 10px 0;">
                
                <!-- PAGU ANGGARAN - OPSIONAL -->
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-size: 12px; font-weight: 600; margin-bottom: 2px;"><b>Pagu Anggaran Indikatif</b> <span class="text-muted">(opsional)</span></label>
                    <input type="text" class="form-control" id="InputPagu" 
                           placeholder="Contoh: 1.000.000.000 (kosongkan jika tidak ada)" style="color: #000; height: 32px; font-size: 12px;">
                    <small class="text-muted" style="font-size: 10px; display: block; margin-top: 2px;">
                        <i class="fa fa-info-circle"></i> Tidak wajib diisi, kosongkan jika tidak ada anggaran
                    </small>
                </div>
                
                <input type="hidden" id="InputKodeUrusan" value="">
                <input type="hidden" id="InputNamaUrusan" value="">
                <input type="hidden" id="InputMode" value="nomenklatur">

            </div>
            <div class="modal-footer" style="flex-shrink: 0; border-top: 2px solid #e5e5e5; padding: 10px 20px; background: #f8f9fa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight: 600; padding: 6px 20px;"><b>BATAL</b></button>
                <button class="btn btn-success" id="SimpanPaguUrusan" style="font-weight: 600; padding: 6px 25px;"><b><i class="notika-icon notika-check"></i> SIMPAN</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT PAGU URUSAN - MODAL MELEBAR                       -->
<!-- ============================================================ -->
        <div class="modal fade" id="ModalEditPaguUrusan" role="dialog">
            <div class="modal-dialog" style="width: 95%; max-width: 1400px; margin: 90px auto;">
                <div class="modal-content" style="max-height: 100vh; overflow: hidden; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
                    <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 3px solid #f0ad4e; padding: 12px 20px;">
                        <button type="button" class="close" data-dismiss="modal" style="font-size: 28px;">&times;</button>
                        <h4 style="margin: 0;"><b><i class="notika-icon notika-settings" style="color: #f0ad4e;"></i> Edit Pagu Urusan</b></h4>
                        <small class="text-muted" style="font-size: 12px;">Edit pagu anggaran urusan</small>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 15px 20px; background: #fafafa;">
                        
                        <!-- Catatan -->
                        <div class="alert alert-info" style="padding: 8px 12px; font-size: 12px; margin-bottom: 15px; border-radius: 4px;">
                            <i class="fa fa-info-circle"></i> 
                            <strong>Catatan:</strong> Field <b>Pagu Anggaran</b> dan <b>Kode Urusan (Manual)</b> bersifat opsional.
                            Hanya field <b>Urusan</b> yang wajib diisi.
                        </div>
                        
                        <input type="hidden" id="EditId">
                        <input type="hidden" id="EditKodeUrusan" value="">
                        <input type="hidden" id="EditNamaUrusan" value="">
                        <input type="hidden" id="EditMode" value="nomenklatur">
                        
                        <!-- TABS -->
                        <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                            <li class="active"><a href="#tab_nomenklatur_edit" data-toggle="tab">📋 Pilih dari Nomenklatur (Berjenjang)</a></li>
                            <li><a href="#tab_manual_edit" data-toggle="tab">✏️ Edit Manual</a></li>
                        </ul>
                        
                        <div class="tab-content" style="margin-top: 15px;">
                            
                            <!-- TAB NOMENKLATUR EDIT -->
                            <div class="tab-pane fade in active" id="tab_nomenklatur_edit">
                                <div class="nomenklatur-container" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px; background: #f9f9f9;">
                                    <div class="panel-heading" style="background: #e7f3ff; padding: 8px 12px; margin: -12px -12px 12px -12px; border-radius: 8px 8px 0 0; border-bottom: 1px solid #d1e7ff;">
                                        <b>📋 Pilih dari Nomenklatur (Berjenjang)</b>
                                        <small class="text-muted">(Data tersimpan akan otomatis terpilih)</small>
                                    </div>
                                    <div class="panel-body" style="padding: 0;">
                                        
                                        <div class="breadcrumb-nomenklatur" id="breadcrumb_edit" style="background: #e9ecef; padding: 6px 10px; border-radius: 4px; margin-bottom: 10px; font-size: 12px;">
                                            <span class="badge" style="background: #007bff; margin-right: 5px;">📁</span>
                                            <span id="path_display_edit">Belum ada yang dipilih</span>
                                        </div>
                                        
                                        <div class="row" style="margin: 0 -5px;">
                                            <div class="col-md-6 cascading-select" style="padding: 0 5px;">
                                                <label style="font-weight: 600; margin-bottom: 2px; font-size: 12px;"><b>1. Urusan</b> <span class="text-danger">*</span></label>
                                                <select class="form-control" id="select_urusan_edit" style="height: 32px; font-size: 12px;">
                                                    <option value="">-- Pilih Urusan --</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 cascading-select" style="padding: 0 5px;">
                                                <label style="font-weight: 600; margin-bottom: 2px; font-size: 12px;"><b>2. Bidang Urusan</b> <span class="text-muted">(opsional)</span></label>
                                                <select class="form-control" id="select_bidang_edit" disabled style="height: 32px; font-size: 12px;">
                                                    <option value="">-- Pilih Bidang Urusan --</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="info-nomenklatur" id="info_edit" style="display:none; background: #d1ecf1; color: #0c5460; padding: 5px 10px; border-radius: 4px; margin-top: 8px; font-size: 12px;">
                                            <strong>📌 Terpilih:</strong> <span id="selected_text_edit"></span>
                                        </div>
                                        
                                        <div class="alert-data-existing" id="alert_existing" style="display:none; background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 5px 10px; border-radius: 4px; margin-top: 8px; font-size: 12px;">
                                            <i class="fa fa-info-circle"></i> 
                                            <strong>Data tersimpan:</strong> <span id="existing_text"></span>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- PREVIEW -->
                                <div class="preview-panel" style="background: #e8f5e9; border: 1px solid #c8e6c9; border-radius: 8px; margin-top: 10px;">
                                    <div class="panel-heading" style="background: #c8e6c9; padding: 6px 12px; border-bottom: 1px solid #a5d6a7; border-radius: 8px 8px 0 0; font-size: 12px;">
                                        <b>📝 Preview Hasil Pilihan</b>
                                    </div>
                                    <div class="panel-body" style="padding: 10px;">
                                        <div class="row" style="margin: 0 -5px;">
                                            <div class="col-md-4" style="padding: 0 5px;">
                                                <label style="font-size: 11px; font-weight: 600; margin-bottom: 1px;"><b>Kode</b></label>
                                                <input type="text" class="form-control" id="preview_kode_edit" readonly style="background:#f1f8e9; font-family: monospace; height: 30px; font-size: 12px;">
                                            </div>
                                            <div class="col-md-8" style="padding: 0 5px;">
                                                <label style="font-size: 11px; font-weight: 600; margin-bottom: 1px;"><b>Nama Urusan</b></label>
                                                <input type="text" class="form-control" id="preview_nama_edit" readonly style="background:#f1f8e9; height: 30px; font-size: 12px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- TAB MANUAL EDIT -->
                            <div class="tab-pane fade" id="tab_manual_edit">
                                <div class="panel-manual" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px; background: #f9f9f9;">
                                    <div class="panel-heading" style="background: #e7f3ff; padding: 8px 12px; margin: -12px -12px 12px -12px; border-radius: 8px 8px 0 0; border-bottom: 1px solid #d1e7ff;">
                                        <b>✏️ Edit Manual</b>
                                    </div>
                                    <div class="panel-body" style="padding: 0;">
                                        <div class="alert alert-info" style="padding: 6px 10px; font-size: 12px; margin-bottom: 10px; border-radius: 4px;">
                                            <i class="fa fa-info-circle"></i> 
                                            <strong>Catatan:</strong> Field <b>Kode Urusan</b> bersifat opsional (boleh dikosongkan).
                                            Hanya <b>Nama Urusan</b> yang wajib diisi.
                                        </div>
                                        <div class="form-group" style="margin-bottom: 8px;">
                                            <label style="font-size: 12px; font-weight: 600; margin-bottom: 2px;"><b>Kode Urusan</b> <span class="text-muted">(opsional)</span></label>
                                            <input type="text" class="form-control" id="EditManualKodeUrusan" 
                                                placeholder="Contoh: 1 atau 1.1 atau 2.3 (kosongkan jika tidak ada)" style="color: #000; height: 32px; font-size: 12px;">
                                            <small class="text-muted" style="font-size: 10px;">Tidak wajib diisi, kosongkan jika tidak ada kode</small>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label style="font-size: 12px; font-weight: 600; margin-bottom: 2px;"><b>Nama Urusan</b> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="EditManualNamaUrusan" 
                                                placeholder="Masukkan nama urusan secara manual..." style="color: #000; height: 32px; font-size: 12px;">
                                            <small class="text-danger" style="font-size: 10px;">Wajib diisi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <hr style="margin: 10px 0;">
                        
                        <!-- PAGU ANGGARAN - OPSIONAL -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-size: 12px; font-weight: 600; margin-bottom: 2px;"><b>Pagu Anggaran Indikatif</b> <span class="text-muted">(opsional)</span></label>
                            <input type="text" class="form-control" id="EditPagu" 
                                placeholder="Contoh: 1.000.000.000 (kosongkan jika tidak ada)" style="color: #000; height: 32px; font-size: 12px;">
                            <small class="text-muted" style="font-size: 10px; display: block; margin-top: 2px;">
                                <i class="fa fa-info-circle"></i> Tidak wajib diisi, kosongkan jika tidak ada anggaran
                            </small>
                        </div>

                    </div>
                    <div class="modal-footer" style="flex-shrink: 0; border-top: 2px solid #e5e5e5; padding: 10px 20px; background: #f8f9fa; border-radius: 0 0 8px 8px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight: 600; padding: 6px 20px;"><b>BATAL</b></button>
                        <button class="btn btn-success" id="UpdatePaguUrusan" style="font-weight: 600; padding: 6px 25px;"><b><i class="notika-icon notika-check"></i> UPDATE</b></button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

function countDots(str) {
    return (str.match(/\./g) || []).length;
}

jQuery(document).ready(function($) {

    /* ================= FILTER WILAYAH ================= */
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $("#Provinsi").change(function() {
            if ($(this).val() === "") {
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: $(this).val(), [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#KabKota").prop('disabled', true); },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
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
                data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    try {
                        if (Respon === 'success' || Respon.trim() === 'success') {
                            window.location.href = BaseURL + "Daerah/PaguUrusan";
                        } else {
                            alert(Respon || "Gagal menyimpan filter wilayah!");
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
    <?php } ?>

    /* ================= FUNGSI NOMENKLATUR ================= */
    
    function loadUrusan(selectId) {
        $.ajax({
            url: BaseURL + "Daerah/getUrusanPagu",
            type: "POST",
            data: { [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
            dataType: 'json',
            success: function(res) {
                var options = '<option value="">-- Pilih Urusan --</option>';
                if (res && res.length > 0) {
                    for (var i = 0; i < res.length; i++) {
                        options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                    }
                }
                $(selectId).html(options).prop('disabled', false);
            },
            error: function() {
                $(selectId).html('<option value="">-- Gagal memuat data --</option>').prop('disabled', true);
            }
        });
    }
    
    function loadBidang(kodeUrusan, selectBidangId, callback) {
        if (!kodeUrusan) {
            $(selectBidangId).html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            if (callback) callback();
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/getBidangUrusanPagu",
            type: "POST",
            data: { kode_urusan: kodeUrusan, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
            dataType: 'json',
            success: function(res) {
                var options = '<option value="">-- Pilih Bidang Urusan --</option>';
                if (res && res.length > 0) {
                    for (var i = 0; i < res.length; i++) {
                        options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                    }
                }
                $(selectBidangId).html(options);
                $(selectBidangId).prop('disabled', !(res && res.length > 0));
                if (callback) callback();
            },
            error: function() {
                $(selectBidangId).html('<option value="">-- Gagal memuat data --</option>').prop('disabled', true);
                if (callback) callback();
            }
        });
    }
    
    function updatePreview(selectUrusanId, selectBidangId, previewKodeId, previewNamaId, pathId, infoId, selectedTextId, hiddenKodeId, hiddenNamaId) {
        var kode = $(selectBidangId).val();
        var text = $(selectBidangId + ' option:selected').text();
        var level = 2;
        
        if (!kode || kode === "") {
            kode = $(selectUrusanId).val();
            text = $(selectUrusanId + ' option:selected').text();
            level = 1;
        }
        
        if (kode && text) {
            var parts = text.split(' - ');
            var nomenklatur = parts.slice(1).join(' - ');
            $(previewKodeId).val(kode);
            $(previewNamaId).val(nomenklatur);
            
            var path = (level == 1) ? 'Urusan: ' + nomenklatur : 'Urusan → Bidang: ' + nomenklatur;
            $(pathId).html(path);
            
            $(infoId).show();
            $(selectedTextId).html('<strong>Kode:</strong> ' + kode + '<br><strong>Nama:</strong> ' + nomenklatur);
            
            $(hiddenKodeId).val(kode);
            $(hiddenNamaId).val(nomenklatur);
        } else {
            $(previewKodeId).val('');
            $(previewNamaId).val('');
            $(pathId).html('Belum ada yang dipilih');
            $(infoId).hide();
            $(hiddenKodeId).val('');
            $(hiddenNamaId).val('');
        }
    }

    /* ================= HANDLE TAB CHANGE ================= */
    
    // Input - Saat pindah ke tab manual
    $('a[href="#tab_manual_input"]').on('shown.bs.tab', function(e) {
        $('#InputMode').val('manual');
        // Kosongkan preview
        $('#preview_kode_input, #preview_nama_input').val('');
        $('#path_display_input').html('Mode Manual - Isi langsung');
        $('#info_input').hide();
        $('#InputKodeUrusan').val('');
        $('#InputNamaUrusan').val('');
    });
    
    // Input - Saat pindah ke tab nomenklatur
    $('a[href="#tab_nomenklatur_input"]').on('shown.bs.tab', function(e) {
        $('#InputMode').val('nomenklatur');
        // Reset dan load urusan
        loadUrusan('#select_urusan_input');
        $('#select_bidang_input').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#preview_kode_input, #preview_nama_input').val('');
        $('#path_display_input').html('Belum ada yang dipilih');
        $('#info_input').hide();
        $('#InputKodeUrusan').val('');
        $('#InputNamaUrusan').val('');
    });
    
    // Edit - Saat pindah ke tab manual
    $('a[href="#tab_manual_edit"]').on('shown.bs.tab', function(e) {
        $('#EditMode').val('manual');
        // Isi dengan data existing jika ada
        var kode = $('#EditKodeUrusan').val();
        var nama = $('#EditNamaUrusan').val();
        $('#EditManualKodeUrusan').val(kode || '');
        $('#EditManualNamaUrusan').val(nama || '');
    });
    
    // Edit - Saat pindah ke tab nomenklatur
    $('a[href="#tab_nomenklatur_edit"]').on('shown.bs.tab', function(e) {
        $('#EditMode').val('nomenklatur');
        // Reload jika ada kode
        var kode = $('#EditKodeUrusan').val();
        if (kode) {
            loadUrusan('#select_urusan_edit');
            var parts = kode.split('.');
            var dotCount = countDots(kode);
            if (dotCount === 0) {
                setTimeout(function() {
                    $('#select_urusan_edit').val(kode).trigger('change');
                }, 500);
            } else if (dotCount === 1) {
                setTimeout(function() {
                    $('#select_urusan_edit').val(parts[0]).trigger('change');
                    setTimeout(function() {
                        loadBidang(parts[0], '#select_bidang_edit', function() {
                            $('#select_bidang_edit').val(kode).trigger('change');
                        });
                    }, 500);
                }, 500);
            }
        }
    });

    /* ================= INPUT ================= */
    
    $('#ModalInputPaguUrusan').on('shown.bs.modal', function() {
        // Reset ke tab nomenklatur
        $('a[href="#tab_nomenklatur_input"]').tab('show');
        loadUrusan('#select_urusan_input');
        // Reset manual fields
        $('#ManualKodeUrusan, #ManualNamaUrusan').val('');
        $('#InputMode').val('nomenklatur');
        $('#InputPagu').val('');
    });
    
    $('#ModalInputPaguUrusan').on('hidden.bs.modal', function() {
        $('#select_urusan_input, #select_bidang_input')
            .html('<option value="">-- Pilih --</option>').prop('disabled', true);
        $('#preview_kode_input, #preview_nama_input').val('');
        $('#path_display_input').html('Belum ada yang dipilih');
        $('#info_input').hide();
        $('#InputPagu').val('');
        $('#InputKodeUrusan').val('');
        $('#InputNamaUrusan').val('');
        $('#ManualKodeUrusan, #ManualNamaUrusan').val('');
        $('#InputMode').val('nomenklatur');
        $('#SimpanPaguUrusan').prop('disabled', false).html('<b>SIMPAN</b>');
    });
    
    // Event handlers untuk nomenklatur input
    $('#select_urusan_input').change(function() {
        var kode = $(this).val();
        if (kode) {
            loadBidang(kode, '#select_bidang_input', function() {
                updatePreview('#select_urusan_input', '#select_bidang_input', 
                              '#preview_kode_input', '#preview_nama_input',
                              '#path_display_input', '#info_input',
                              '#selected_text_input', '#InputKodeUrusan', '#InputNamaUrusan');
            });
        } else {
            $('#select_bidang_input').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            updatePreview('#select_urusan_input', '#select_bidang_input', 
                          '#preview_kode_input', '#preview_nama_input',
                          '#path_display_input', '#info_input',
                          '#selected_text_input', '#InputKodeUrusan', '#InputNamaUrusan');
        }
    });
    
    $('#select_bidang_input').change(function() {
        updatePreview('#select_urusan_input', '#select_bidang_input', 
                      '#preview_kode_input', '#preview_nama_input',
                      '#path_display_input', '#info_input',
                      '#selected_text_input', '#InputKodeUrusan', '#InputNamaUrusan');
    });
    
    // Manual input - update hidden fields saat mengetik
    $('#ManualKodeUrusan, #ManualNamaUrusan').on('input', function() {
        if ($('#InputMode').val() === 'manual') {
            var kode = $('#ManualKodeUrusan').val().trim();
            var nama = $('#ManualNamaUrusan').val().trim();
            $('#InputKodeUrusan').val(kode);
            $('#InputNamaUrusan').val(nama);
            // Update preview
            $('#preview_kode_input').val(kode);
            $('#preview_nama_input').val(nama);
            if (nama) {
                var display = nama;
                if (kode) display = kode + ' - ' + nama;
                $('#path_display_input').html('Manual: ' + display);
            } else {
                $('#path_display_input').html('Mode Manual - Isi nama urusan');
            }
        }
    });

    /* ================= EDIT ================= */
    
    $(document).on("click", ".EditPaguUrusan", function() {
        var id = $(this).data('id');
        var urusan = $(this).data('urusan');
        var pagu = $(this).data('pagu');
        var kode = $(this).data('kode') || '';
        
        $("#EditId").val(id);
        $("#EditPagu").val(formatNumber(String(pagu || '')));
        $("#EditKodeUrusan").val(kode);
        $("#EditNamaUrusan").val(urusan);
        
        // Reset form
        $('#select_urusan_edit, #select_bidang_edit')
            .html('<option value="">-- Pilih --</option>').prop('disabled', true);
        $('#preview_kode_edit, #preview_nama_edit').val('');
        $('#info_edit, #alert_existing').hide();
        $('#path_display_edit').html('Belum ada yang dipilih');
        $('#EditManualKodeUrusan, #EditManualNamaUrusan').val('');
        $('#EditMode').val('nomenklatur');
        
        // ✅ SET DATA KE TAB MANUAL
        $('#EditManualKodeUrusan').val(kode || '');
        $('#EditManualNamaUrusan').val(urusan || '');
        
        // Tampilkan data existing
        if (urusan) {
            var displayText = urusan;
            if (kode) {
                displayText = kode + ' - ' + urusan;
            }
            $('#existing_text').text(displayText);
            $('#alert_existing').show();
        }
        
        // ✅ Tentukan tab yang akan ditampilkan
        if (kode && kode !== "" && kode !== "null" && kode !== "undefined") {
            // Ada kode -> coba load di nomenklatur
            $('a[href="#tab_nomenklatur_edit"]').tab('show');
            loadUrusan('#select_urusan_edit');
            
            var kodeStr = String(kode);
            var parts = kodeStr.split('.');
            var dotCount = countDots(kodeStr);
            
            if (dotCount === 0) {
                setTimeout(function() {
                    $('#select_urusan_edit').val(kodeStr).trigger('change');
                }, 500);
            } else if (dotCount === 1) {
                setTimeout(function() {
                    $('#select_urusan_edit').val(parts[0]).trigger('change');
                    setTimeout(function() {
                        loadBidang(parts[0], '#select_bidang_edit', function() {
                            $('#select_bidang_edit').val(kodeStr).trigger('change');
                        });
                    }, 500);
                }, 500);
            }
        } else {
            // ✅ TIDAK ADA KODE -> Langsung ke tab manual
            $('a[href="#tab_manual_edit"]').tab('show');
            $('#EditMode').val('manual');
        }
        
        $('#ModalEditPaguUrusan').modal("show");
    });
    
    // Event handlers untuk nomenklatur edit
    $('#select_urusan_edit').change(function() {
        var kode = $(this).val();
        if (kode) {
            loadBidang(kode, '#select_bidang_edit', function() {
                updatePreview('#select_urusan_edit', '#select_bidang_edit', 
                              '#preview_kode_edit', '#preview_nama_edit',
                              '#path_display_edit', '#info_edit',
                              '#selected_text_edit', '#EditKodeUrusan', '#EditNamaUrusan');
            });
        } else {
            $('#select_bidang_edit').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            updatePreview('#select_urusan_edit', '#select_bidang_edit', 
                          '#preview_kode_edit', '#preview_nama_edit',
                          '#path_display_edit', '#info_edit',
                          '#selected_text_edit', '#EditKodeUrusan', '#EditNamaUrusan');
        }
    });
    
    $('#select_bidang_edit').change(function() {
        updatePreview('#select_urusan_edit', '#select_bidang_edit', 
                      '#preview_kode_edit', '#preview_nama_edit',
                      '#path_display_edit', '#info_edit',
                      '#selected_text_edit', '#EditKodeUrusan', '#EditNamaUrusan');
    });
    
    // Manual edit - update hidden fields saat mengetik
    $('#EditManualKodeUrusan, #EditManualNamaUrusan').on('input', function() {
        if ($('#EditMode').val() === 'manual') {
            var kode = $('#EditManualKodeUrusan').val().trim();
            var nama = $('#EditManualNamaUrusan').val().trim();
            $('#EditKodeUrusan').val(kode);
            $('#EditNamaUrusan').val(nama);
            $('#preview_kode_edit').val(kode);
            $('#preview_nama_edit').val(nama);
            if (nama) {
                var display = nama;
                if (kode) display = kode + ' - ' + nama;
                $('#path_display_edit').html('Manual: ' + display);
            } else {
                $('#path_display_edit').html('Mode Manual - Isi nama urusan');
            }
        }
    });
    
    $('#ModalEditPaguUrusan').on('hidden.bs.modal', function() {
        $('#select_urusan_edit, #select_bidang_edit')
            .html('<option value="">-- Pilih --</option>').prop('disabled', true);
        $('#preview_kode_edit, #preview_nama_edit').val('');
        $('#path_display_edit').html('Belum ada yang dipilih');
        $('#info_edit, #alert_existing').hide();
        $('#EditPagu').val('');
        $('#EditKodeUrusan').val('');
        $('#EditNamaUrusan').val('');
        $('#EditManualKodeUrusan, #EditManualNamaUrusan').val('');
        $('#EditMode').val('nomenklatur');
        $('#UpdatePaguUrusan').prop('disabled', false).html('<b>UPDATE</b>');
    });

    /* ================= FORMAT ANGKA ================= */
    function formatNumber(num) {
        if (!num || num === '' || num === 'null' || num === 'undefined') return '';
        var str = String(num).replace(/\./g, '');
        if (isNaN(str) || str === '') return '';
        return str.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#InputPagu, #EditPagu').on('input', function() {
        var value = $(this).val().replace(/\./g, '');
        if (!isNaN(value) && value.length > 0) {
            $(this).val(formatNumber(value));
        }
    });

    /* ================= SIMPAN ================= */
    $("#SimpanPaguUrusan").click(function() {
        // Cek tab mana yang aktif
        var mode = 'nomenklatur';
        if ($('#tab_manual_input').hasClass('active')) {
            mode = 'manual';
        }
        
        var kode = '';
        var urusan = '';
        
        if (mode === 'manual') {
            // ✅ MODE MANUAL - Kode opsional, Nama wajib
            kode = $("#ManualKodeUrusan").val().trim();
            urusan = $("#ManualNamaUrusan").val().trim();
            
            // ✅ NAMA WAJIB
            if (!urusan) {
                alert('Nama Urusan harus diisi!');
                $("#ManualNamaUrusan").focus();
                return;
            }
            // ✅ KODE TIDAK WAJIB - Boleh kosong
        } else {
            // ✅ MODE NOMENKLATUR - Kode dan Nama dari nomenklatur
            kode = $("#InputKodeUrusan").val().trim();
            urusan = $("#InputNamaUrusan").val().trim();
            
            if (!kode || kode === "") {
                alert('Silakan pilih Urusan dari nomenklatur terlebih dahulu!');
                return;
            }
            if (!urusan || urusan === "") {
                alert('Nama Urusan tidak valid!');
                return;
            }
        }
        
        // ✅ PAGU OPSIONAL
        var pagu = $("#InputPagu").val().trim();
        var paguClean = '';
        if (pagu !== "") {
            paguClean = pagu.replace(/\./g, '');
            if (isNaN(paguClean)) {
                alert('Pagu Anggaran harus berupa angka!');
                return;
            }
        }
        
        var Data = {
            kode_urusan: kode,  // Bisa kosong untuk mode manual
            urusan: urusan,
            pagu: paguClean,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
        };
        
        $.ajax({
            url: BaseURL + "Daerah/InputPaguUrusan",
            type: "POST",
            data: Data,
            beforeSend: function() {
                $("#SimpanPaguUrusan").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        $('#ModalInputPaguUrusan').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        $("#SimpanPaguUrusan").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        $('#ModalInputPaguUrusan').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        $("#SimpanPaguUrusan").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#SimpanPaguUrusan").prop('disabled', false).html('<b>SIMPAN</b>');
            }
        });
    });

    /* ================= UPDATE ================= */
    $("#UpdatePaguUrusan").click(function() {
        var id = $("#EditId").val();
        
        // Cek tab mana yang aktif
        var mode = 'nomenklatur';
        if ($('#tab_manual_edit').hasClass('active')) {
            mode = 'manual';
        }
        
        var kode = '';
        var urusan = '';
        
        if (mode === 'manual') {
            // ✅ MODE MANUAL
            kode = $("#EditManualKodeUrusan").val().trim();
            urusan = $("#EditManualNamaUrusan").val().trim();
            
            // ✅ NAMA WAJIB
            if (!urusan) {
                alert('Nama Urusan harus diisi!');
                $("#EditManualNamaUrusan").focus();
                return;
            }
            // ✅ KODE TIDAK WAJIB
        } else {
            // ✅ MODE NOMENKLATUR
            kode = $("#EditKodeUrusan").val().trim();
            urusan = $("#EditNamaUrusan").val().trim();
            
            if (!kode || kode === "") {
                alert('Silakan pilih Urusan dari nomenklatur terlebih dahulu!');
                return;
            }
            if (!urusan || urusan === "") {
                alert('Nama Urusan tidak valid!');
                return;
            }
        }
        
        var pagu = $("#EditPagu").val().trim();
        var paguClean = '';
        if (pagu !== "") {
            paguClean = pagu.replace(/\./g, '');
            if (isNaN(paguClean)) {
                alert('Pagu Anggaran harus berupa angka!');
                return;
            }
        }
        
        var Data = {
            id: id,
            kode_urusan: kode,  // Bisa kosong untuk mode manual
            urusan: urusan,
            pagu: paguClean,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
        };
        
        $.ajax({
            url: BaseURL + "Daerah/EditPaguUrusan",
            type: "POST",
            data: Data,
            beforeSend: function() {
                $("#UpdatePaguUrusan").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        $('#ModalEditPaguUrusan').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        $("#UpdatePaguUrusan").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        $('#ModalEditPaguUrusan').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        $("#UpdatePaguUrusan").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#UpdatePaguUrusan").prop('disabled', false).html('<b>UPDATE</b>');
            }
        });
    });

    /* ================= HAPUS ================= */
    $(document).on("click", ".HapusPaguUrusan", function() {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            var id = $(this).data('id');
            var btn = $(this);
            
            $.ajax({
                url: BaseURL + "Daerah/HapusPaguUrusan",
                type: "POST",
                data: { 
                    id: id,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                },
                beforeSend: function() {
                    btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
                },
                success: function(Respon) {
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') {
                            location.reload();
                        } else {
                            alert('✗ ' + result.message);
                            btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                        }
                    } catch(e) {
                        if (Respon === '1' || Respon.trim() === '1') {
                            location.reload();
                        } else {
                            alert('✗ ' + Respon);
                            btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                        }
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                    btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                }
            });
        }
    });

    /* ================= CLEAN MODAL BACKDROP ================= */
    $(document).on("hidden.bs.modal", ".modal", function() {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

});
</script>

</body>
</html>