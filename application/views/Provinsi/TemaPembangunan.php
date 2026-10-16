<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    /* Styling Badge & Tampilan */
    .badge-pn {
        background-color: #007bff;
        color: white;
        padding: 2px 6px;
        border-radius: 3px;
        font-weight: bold;
        font-size: 10px;
    }
    .badge-pp {
        background-color: #28a745;
        color: white;
        padding: 2px 6px;
        border-radius: 3px;
        font-weight: bold;
        font-size: 10px;
    }
    .badge-reference {
        background-color: #17a2b8;
        color: white;
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 9px;
        margin-left: 5px;
    }
    .tema-rkp-loading {
        display: none;
        color: #17a2b8;
        font-size: 12px;
        margin-top: 5px;
    }
    .tema-rkp-loading.active {
        display: block;
    }
    .dropdown-group {
        border-left: 3px solid #17a2b8;
        padding-left: 10px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 4px;
    }
    .btn-xs {
        padding: 1px 5px;
        font-size: 11px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .prioritas-item:hover {
        background-color: #f1f8ff;
    }
    /* Modal Centering */
    .modal {
        text-align: center;
        padding: 0 !important;
        z-index: 105000 !important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        margin: 30px auto;
    }
    .modal-backdrop {
        z-index: 104990 !important;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="background: #ffffff; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 25px;">
                        <div class="basic-tb-hd" style="margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 15px;">
                                <div>
                                    <h3 style="font-size: 20px; font-weight: bold; color: #2c3e50; margin: 0;">
                                        <i class="fa fa-map-o text-success" style="color: #20c997;"></i> Tema Pembangunan Provinsi
                                    </h3>
                                    <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 13px;">
                                        Kelola Tema Pembangunan dan Prioritas Pembangunan tingkat Provinsi
                                    </p>
                                </div>
                                <div class="button-icon-btn">
                                    <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTema" style="border-radius: 6px; font-weight: 600; padding: 8px 16px;">
                                        <i class="fa fa-plus"></i> Tambah Tema Provinsi
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Filter Wilayah untuk Non-Wilayah Session / Superadmin -->
                            <?php if (empty($_SESSION['KodeWilayah']) || $_SESSION['Level'] == 0) { ?>
                                <div class="card" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                                    <div class="row filter-row" style="display: flex; align-items: flex-end; gap: 10px; flex-wrap: wrap;">
                                        <div class="col-lg-4 col-md-6">
                                            <label for="ProvinsiSelect" style="font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #495057;">Pilih Provinsi</label>
                                            <select class="form-control" id="ProvinsiSelect" style="border-radius: 6px;">
                                                <option value="">-- Pilih Provinsi --</option>
                                                <?php foreach ($Provinsi as $prov) { ?>
                                                    <option value="<?= html_escape($prov['Kode']) ?>" <?= ($KodeWilayah == $prov['Kode']) ? 'selected' : '' ?>>
                                                        <?= html_escape($prov['Nama']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <button class="btn btn-primary" id="BtnFilterProvinsi" style="border-radius: 6px; font-weight: 600; width: 100%;">
                                                <i class="fa fa-filter"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (empty($KodeWilayah)) { ?>
                                <div class="alert alert-warning" style="border-radius: 6px; border-left: 4px solid #f59f00; background-color: #fff9db; color: #f08c00; margin-bottom: 20px;">
                                    <i class="fa fa-exclamation-triangle"></i> Silakan pilih Provinsi terlebih dahulu untuk menampilkan dan mengelola data.
                                </div>
                            <?php } ?>
                        </div>

                        <!-- TABEL TEMA PEMBANGUNAN PROVINSI -->
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-bordered table-striped" style="font-size: 13px; border-collapse: separate; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr style="background-color: #f1f3f5; color: #343a40; text-align: center;">
                                        <th style="width: 4%; vertical-align: middle; text-align: center; border: 1px solid #dee2e6;">No</th>
                                        <th style="width: 40%; vertical-align: middle; text-align: center; border: 1px solid #dee2e6;">
                                            <span style="font-size: 13px; font-weight: bold; color: #1c7ed6;">TEMA PEMBANGUNAN NASIONAL</span>
                                        </th>
                                        <th style="width: 40%; vertical-align: middle; text-align: center; border: 1px solid #dee2e6;">
                                            <span style="font-size: 13px; font-weight: bold; color: #2f9e44;">TEMA PEMBANGUNAN PROVINSI</span>
                                        </th>
                                        <th style="width: 8%; vertical-align: middle; text-align: center; border: 1px solid #dee2e6;">Tahun</th>
                                        <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                        <th style="width: 8%; vertical-align: middle; text-align: center; border: 1px solid #dee2e6;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($TemaPembangunan)) { ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted" style="padding: 40px 0; background: #fafbfc;">
                                            <i class="fa fa-folder-open-o fa-3x" style="color: #ced4da; display: block; margin-bottom: 10px;"></i>
                                            <span style="font-size: 14px;">Belum ada data Tema Pembangunan untuk Provinsi ini</span>
                                        </td>
                                    </tr>
                                    <?php } else { ?>
                                    <?php $No = 1; foreach ($TemaPembangunan as $tema) { ?>
                                    <tr>
                                        <!-- KOLOM NO -->
                                        <td class="text-center" style="vertical-align: middle; background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                            <strong><?= $No++ ?></strong>
                                        </td>
                                        
                                        <!-- KOLOM NASIONAL -->
                                        <td style="vertical-align: top; padding: 12px; border: 1px solid #dee2e6; background-color: #fff;">
                                            <div style="font-weight: bold; font-size: 14px; color: #212529; border-bottom: 2px solid #e9ecef; padding-bottom: 6px; margin-bottom: 8px;">
                                                <?= html_escape($tema['tema_nasional']) ?>
                                            </div>
                                            <div style="font-size: 11px; color: #495057; font-weight: bold; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #007bff; padding-left: 6px; display: flex; align-items: center; justify-content: space-between;">
                                                <span><span class="badge-pn">PN</span> PRIORITAS NASIONAL</span>
                                                <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                                <button class="btn btn-xs btn-primary tambah-prioritas-kolom" 
                                                        data-tema_id="<?= $tema['id'] ?>"
                                                        data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                        data-jenis="nasional"
                                                        data-label="PN"
                                                        style="padding: 2px 8px; font-size: 10px; border-radius: 4px;">
                                                    <i class="fa fa-plus"></i> Tambah PN
                                                </button>
                                                <?php } ?>
                                            </div>
                                            <div class="prioritas-list">
                                                <?php if (!empty($tema['prioritas_nasional'])) { ?>
                                                    <?php foreach ($tema['prioritas_nasional'] as $idx => $p) { ?>
                                                        <div class="prioritas-item" style="display: flex; align-items: center; gap: 6px; padding: 4px 6px; border-bottom: 1px dashed #e9ecef; border-radius: 3px;">
                                                            <span style="font-size: 11px; color: #6c757d; min-width: 20px;"><?= ($idx + 1) ?>.</span>
                                                            <span style="font-size: 12px; color: #333; flex: 1;"><?= html_escape($p['prioritas']) ?></span>
                                                            <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                                                <button class="btn btn-xs btn-outline-primary EditPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        data-tema_id="<?= $tema['id'] ?>"
                                                                        data-prioritas="<?= html_escape($p['prioritas']) ?>"
                                                                        data-jenis="nasional"
                                                                        data-label="PN"
                                                                        title="Edit Prioritas"
                                                                        style="padding: 1px 5px; font-size: 10px;">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-xs btn-outline-danger HapusPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        title="Hapus Prioritas"
                                                                        style="padding: 1px 5px; font-size: 10px;">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="text-muted" style="font-size: 11px; font-style: italic; padding: 4px 0; color: #adb5bd;">Belum ada prioritas nasional</div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        
                                        <!-- KOLOM PROVINSI -->
                                        <td style="vertical-align: top; padding: 12px; border: 1px solid #dee2e6; background-color: #fff;">
                                            <div style="font-weight: bold; font-size: 14px; color: #212529; border-bottom: 2px solid #e9ecef; padding-bottom: 6px; margin-bottom: 8px;">
                                                <?= html_escape($tema['tema_provinsi']) ?>
                                            </div>
                                            <div style="font-size: 11px; color: #495057; font-weight: bold; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #28a745; padding-left: 6px; display: flex; align-items: center; justify-content: space-between;">
                                                <span><span class="badge-pp">PP</span> PRIORITAS PROVINSI</span>
                                                <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                                <button class="btn btn-xs btn-success tambah-prioritas-kolom" 
                                                        data-tema_id="<?= $tema['id'] ?>"
                                                        data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                        data-jenis="provinsi"
                                                        data-label="PP"
                                                        style="padding: 2px 8px; font-size: 10px; border-radius: 4px;">
                                                    <i class="fa fa-plus"></i> Tambah PP
                                                </button>
                                                <?php } ?>
                                            </div>
                                            <div class="prioritas-list">
                                                <?php if (!empty($tema['prioritas_provinsi'])) { ?>
                                                    <?php foreach ($tema['prioritas_provinsi'] as $idx => $p) { ?>
                                                        <div class="prioritas-item" style="display: flex; align-items: center; gap: 6px; padding: 4px 6px; border-bottom: 1px dashed #e9ecef; border-radius: 3px;">
                                                            <span style="font-size: 11px; color: #6c757d; min-width: 20px;"><?= ($idx + 1) ?>.</span>
                                                            <span style="font-size: 12px; color: #333; flex: 1;"><?= html_escape($p['prioritas']) ?></span>
                                                            <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                                                <button class="btn btn-xs btn-outline-primary EditPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        data-tema_id="<?= $tema['id'] ?>"
                                                                        data-prioritas="<?= html_escape($p['prioritas']) ?>"
                                                                        data-jenis="provinsi"
                                                                        data-label="PP"
                                                                        title="Edit Prioritas"
                                                                        style="padding: 1px 5px; font-size: 10px;">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-xs btn-outline-danger HapusPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        title="Hapus Prioritas"
                                                                        style="padding: 1px 5px; font-size: 10px;">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="text-muted" style="font-size: 11px; font-style: italic; padding: 4px 0; color: #adb5bd;">Belum ada prioritas provinsi</div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        
                                        <!-- KOLOM TAHUN -->
                                        <td class="text-center" style="vertical-align: middle; background-color: #f8f9fa; border: 1px solid #dee2e6; font-size: 14px;">
                                            <span class="badge" style="background-color: #495057; font-size: 13px;"><?= html_escape($tema['tahun']) ?></span>
                                        </td>
                                        
                                        <!-- KOLOM AKSI TEMA -->
                                        <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 1, 2])) { ?>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                            <div class="btn-group" style="display: inline-flex; gap: 4px;">
                                                <button class="btn btn-sm btn-warning EditTema" 
                                                        data-id="<?= $tema['id'] ?>"
                                                        data-tahun="<?= html_escape($tema['tahun']) ?>"
                                                        data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                        data-tema_provinsi="<?= html_escape($tema['tema_provinsi']) ?>"
                                                        data-tema_rkp_id="<?= $tema['tema_rkp_id'] ?? '' ?>"
                                                        title="Edit Tema"
                                                        style="padding: 3px 8px; font-size: 11px; border-radius: 4px;">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger HapusTema" 
                                                        data-id="<?= $tema['id'] ?>"
                                                        title="Hapus Tema"
                                                        style="padding: 3px 8px; font-size: 11px; border-radius: 4px;">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                        <?php } ?>
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

<!-- ============================================================
MODAL INPUT TEMA PROVINSI
============================================================ -->
<div class="modal fade" id="ModalInputTema" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header" style="background: #f8f9fa; border-radius: 8px 8px 0 0; padding: 15px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: bold; color: #2c3e50;">
                    <i class="fa fa-plus-circle text-success" style="color: #20c997;"></i> Tambah Tema Pembangunan Provinsi
                </h4>
                <p style="margin: 3px 0 0 0; font-size: 12px; color: #6c757d;">
                    Isi tahun, pilih tema nasional dari RKP, dan isi tema pembangunan provinsi
                </p>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <!-- TAHUN -->
                <div class="form-group row" style="margin-bottom: 15px;">
                    <label class="col-sm-3 col-form-label" style="font-weight: 600;">Tahun <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="Tahun" placeholder="Contoh: 2026" min="2000" max="2100" value="<?= date('Y') ?>" style="border-radius: 6px;">
                        <small class="text-muted" style="display: block; margin-top: 4px;">
                            <i class="fa fa-info-circle"></i> Tahun perencanaan pembangunan provinsi
                        </small>
                    </div>
                </div>

                <!-- TEMA NASIONAL (RKP) -->
                <div class="dropdown-group">
                    <div class="form-group row" style="margin-bottom: 10px;">
                        <label class="col-sm-3 col-form-label" style="font-weight: 600;">
                            Tema Nasional <span class="text-danger">*</span>
                            <span class="badge-reference">Tema RKP</span>
                        </label>
                        <div class="col-sm-9">
                            <div style="margin-bottom: 8px;">
                                <select class="form-control" id="TahunTemaRKP" style="border-radius: 6px;">
                                    <option value="">-- Pilih Tahun Tema RKP --</option>
                                    <?php foreach ($TahunTemaRKP as $t) { ?>
                                        <option value="<?= $t['Tahun'] ?>"><?= $t['Tahun'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <select class="form-control" id="TemaNasionalId" style="border-radius: 6px;">
                                <option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>
                            </select>
                            <span class="tema-rkp-loading" id="tema-rkp-loading">
                                <i class="fa fa-spinner fa-spin"></i> Memuat data Tema RKP...
                            </span>
                        </div>
                    </div>
                </div>

                <!-- TEMA PROVINSI -->
                <div class="form-group row" style="margin-bottom: 15px;">
                    <label class="col-sm-3 col-form-label" style="font-weight: 600;">
                        Tema Provinsi <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="TemaProvinsi" rows="3" placeholder="Masukkan Tema Pembangunan Provinsi..." style="border-radius: 6px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 8px 8px; padding: 12px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                <button type="button" class="btn btn-success" id="InputTema" style="border-radius: 6px; font-weight: 600;">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT TEMA PROVINSI
============================================================ -->
<div class="modal fade" id="ModalEditTema" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header" style="background: #f8f9fa; border-radius: 8px 8px 0 0; padding: 15px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: bold; color: #2c3e50;">
                    <i class="fa fa-pencil-square-o text-warning"></i> Edit Tema Pembangunan Provinsi
                </h4>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <input type="hidden" id="EditId">
                
                <!-- TAHUN -->
                <div class="form-group row" style="margin-bottom: 15px;">
                    <label class="col-sm-3 col-form-label" style="font-weight: 600;">Tahun <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="EditTahun" min="2000" max="2100" style="border-radius: 6px;">
                    </div>
                </div>

                <!-- TEMA NASIONAL (RKP) -->
                <div class="dropdown-group">
                    <div class="form-group row" style="margin-bottom: 10px;">
                        <label class="col-sm-3 col-form-label" style="font-weight: 600;">
                            Tema Nasional <span class="text-danger">*</span>
                            <span class="badge-reference">Tema RKP</span>
                        </label>
                        <div class="col-sm-9">
                            <div style="margin-bottom: 8px;">
                                <select class="form-control" id="EditTahunTemaRKP" style="border-radius: 6px;">
                                    <option value="">-- Pilih Tahun Tema RKP --</option>
                                    <?php foreach ($TahunTemaRKP as $t) { ?>
                                        <option value="<?= $t['Tahun'] ?>"><?= $t['Tahun'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <select class="form-control" id="EditTemaNasionalId" style="border-radius: 6px;">
                                <option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>
                            </select>
                            <span class="tema-rkp-loading" id="edit-tema-rkp-loading">
                                <i class="fa fa-spinner fa-spin"></i> Memuat data Tema RKP...
                            </span>
                        </div>
                    </div>
                </div>

                <!-- TEMA PROVINSI -->
                <div class="form-group row" style="margin-bottom: 15px;">
                    <label class="col-sm-3 col-form-label" style="font-weight: 600;">
                        Tema Provinsi <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="EditTemaProvinsi" rows="3" style="border-radius: 6px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 8px 8px; padding: 12px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                <button type="button" class="btn btn-warning" id="UpdateTema" style="border-radius: 6px; font-weight: 600;">
                    <i class="fa fa-save"></i> Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL TAMBAH PRIORITAS
============================================================ -->
<div class="modal fade" id="ModalInputPrioritasKolom" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header" style="background: #f8f9fa; border-radius: 8px 8px 0 0; padding: 15px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: bold; color: #2c3e50;">
                    <i class="fa fa-plus-circle text-primary"></i> Tambah Prioritas
                </h4>
                <p style="margin: 3px 0 0 0; font-size: 12px; color: #6c757d;">
                    Untuk Tema: <strong id="LabelTemaPrioritasKolom"></strong>
                </p>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <input type="hidden" id="InputPrioritasTemaIdKolom">
                <input type="hidden" id="InputPrioritasJenisKolom">
                <input type="hidden" id="InputPrioritasLabelKolom">

                <div class="form-group row" style="margin-bottom: 12px;">
                    <label class="col-sm-3 col-form-label" style="font-weight: 600;">Jenis</label>
                    <div class="col-sm-9">
                        <span id="JenisInfoKolom" class="badge" style="font-size: 12px; padding: 5px 10px;"></span>
                    </div>
                </div>

                <!-- DROPDOWN RPJMN UNTUK PN -->
                <div class="dropdown-group" id="DropdownRPJMNContainer" style="display: none;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-weight: 600; margin-bottom: 6px;">
                            Prioritas Nasional RPJMN <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="InputPrioritasRPJMNId" style="border-radius: 6px;">
                            <option value="">-- Pilih Prioritas Nasional RPJMN --</option>
                            <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                                <option value="<?= $p['Id'] ?>"><?= html_escape($p['PrioritasNasional']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- INPUT MANUAL UNTUK PP -->
                <div class="form-group" id="InputManualContainer">
                    <label style="font-weight: 600; margin-bottom: 6px;">
                        Uraian Prioritas <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="InputPrioritasKolom" rows="3" placeholder="Masukkan uraian prioritas..." style="border-radius: 6px;"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 8px 8px; padding: 12px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                <button type="button" class="btn btn-primary" id="SimpanPrioritasKolom" style="border-radius: 6px; font-weight: 600;">
                    <i class="fa fa-save"></i> Simpan Prioritas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT PRIORITAS
============================================================ -->
<div class="modal fade" id="ModalEditPrioritas" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header" style="background: #f8f9fa; border-radius: 8px 8px 0 0; padding: 15px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: bold; color: #2c3e50;">
                    <i class="fa fa-edit text-primary"></i> Edit Prioritas
                </h4>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <input type="hidden" id="EditPrioritasId">
                <input type="hidden" id="EditPrioritasTemaId">
                <input type="hidden" id="EditPrioritasJenisHidden">

                <div class="form-group row" style="margin-bottom: 12px;">
                    <label class="col-sm-3 col-form-label" style="font-weight: 600;">Jenis</label>
                    <div class="col-sm-9">
                        <span id="EditJenisInfo" class="badge" style="font-size: 12px; padding: 5px 10px;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; margin-bottom: 6px;">
                        Uraian Prioritas <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="EditPrioritasText" rows="3" style="border-radius: 6px;"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 8px 8px; padding: 12px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                <button type="button" class="btn btn-primary" id="UpdatePrioritas" style="border-radius: 6px; font-weight: 600;">
                    <i class="fa fa-save"></i> Update Prioritas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';

jQuery(document).ready(function($) {

    // ============================================================
    // FILTER PROVINSI (Super Admin / Non-locked session)
    // ============================================================
    $("#BtnFilterProvinsi").click(function() {
        var kode = $("#ProvinsiSelect").val();
        if (kode) {
            window.location.href = BaseURL + "Provinsi/TemaPembangunan?KodeWilayah=" + encodeURIComponent(kode);
        } else {
            window.location.href = BaseURL + "Provinsi/TemaPembangunan";
        }
    });

    // ============================================================
    // DROPDOWN AUTO REFRESH TEMA RKP BERDASARKAN TAHUN
    // ============================================================
    $("#TahunTemaRKP").change(function() {
        var tahun = $(this).val();
        if (!tahun) {
            $("#TemaNasionalId").html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
            return;
        }

        $("#tema-rkp-loading").addClass('active');
        $.ajax({
            url: BaseURL + "Provinsi/GetTemaRKPByTahun",
            type: "POST",
            data: { tahun: tahun },
            dataType: "json",
            success: function(response) {
                var options = '<option value="">-- Pilih Tema RKP --</option>';
                if (response && response.length > 0) {
                    $.each(response, function(i, item) {
                        options += '<option value="' + item.Id + '">' + item.TemaRKP + '</option>';
                    });
                } else {
                    options = '<option value="">Tidak ada data Tema RKP untuk tahun ' + tahun + '</option>';
                }
                $("#TemaNasionalId").html(options);
            },
            error: function() {
                $("#TemaNasionalId").html('<option value="">Gagal memuat data Tema RKP</option>');
            },
            complete: function() {
                $("#tema-rkp-loading").removeClass('active');
            }
        });
    });

    // Edit dropdown RKP
    $("#EditTahunTemaRKP").change(function() {
        var tahun = $(this).val();
        if (!tahun) {
            $("#EditTemaNasionalId").html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
            return;
        }

        $("#edit-tema-rkp-loading").addClass('active');
        $.ajax({
            url: BaseURL + "Provinsi/GetTemaRKPByTahun",
            type: "POST",
            data: { tahun: tahun },
            dataType: "json",
            success: function(response) {
                var options = '<option value="">-- Pilih Tema RKP --</option>';
                if (response && response.length > 0) {
                    $.each(response, function(i, item) {
                        options += '<option value="' + item.Id + '">' + item.TemaRKP + '</option>';
                    });
                } else {
                    options = '<option value="">Tidak ada data Tema RKP untuk tahun ' + tahun + '</option>';
                }
                $("#EditTemaNasionalId").html(options);
            },
            error: function() {
                $("#EditTemaNasionalId").html('<option value="">Gagal memuat data Tema RKP</option>');
            },
            complete: function() {
                $("#edit-tema-rkp-loading").removeClass('active');
            }
        });
    });

    // ============================================================
    // SIMPAN TEMA
    // ============================================================
    $("#InputTema").click(function() {
        var tahun = $("#Tahun").val();
        var temaRKPId = $("#TemaNasionalId").val();
        var temaNasionalText = $("#TemaNasionalId option:selected").text();
        var temaProvinsi = $("#TemaProvinsi").val();

        if (!tahun) {
            alert('Tahun wajib diisi!');
            return;
        }
        if (!temaRKPId) {
            alert('Tema Nasional (RKP) wajib dipilih!');
            return;
        }
        if (!temaProvinsi.trim()) {
            alert('Tema Provinsi wajib diisi!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + "Provinsi/InputTemaPembangunan",
            type: "POST",
            data: {
                Tahun: tahun,
                TemaRKPId: temaRKPId,
                TemaNasionalText: temaNasionalText,
                TemaProvinsi: temaProvinsi
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan tema!');
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan tema!');
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });

    // ============================================================
    // EDIT TEMA MODAL
    // ============================================================
    $(document).on('click', '.EditTema', function() {
        var id = $(this).data('id');
        var tahun = $(this).data('tahun');
        var temaNasional = $(this).data('tema_nasional');
        var temaProvinsi = $(this).data('tema_provinsi');
        var temaRkpId = $(this).data('tema_rkp_id');

        $("#EditId").val(id);
        $("#EditTahun").val(tahun);
        $("#EditTemaProvinsi").val(temaProvinsi);

        // Reset dropdown RKP
        $("#EditTahunTemaRKP").val('');
        $("#EditTemaNasionalId").html('<option value="">-- Memuat Tema RKP --</option>');

        if (temaRkpId) {
            $.ajax({
                url: BaseURL + "Provinsi/GetTemaRKPById",
                type: "POST",
                data: { id: temaRkpId },
                dataType: "json",
                success: function(rkp) {
                    if (rkp && rkp.Tahun) {
                        $("#EditTahunTemaRKP").val(rkp.Tahun);
                        $.ajax({
                            url: BaseURL + "Provinsi/GetTemaRKPByTahun",
                            type: "POST",
                            data: { tahun: rkp.Tahun },
                            dataType: "json",
                            success: function(list) {
                                var options = '';
                                $.each(list, function(i, item) {
                                    var sel = (item.Id == temaRkpId) ? ' selected' : '';
                                    options += '<option value="' + item.Id + '"' + sel + '>' + item.TemaRKP + '</option>';
                                });
                                $("#EditTemaNasionalId").html(options);
                            }
                        });
                    } else {
                        $("#EditTemaNasionalId").html('<option value="' + temaRkpId + '" selected>' + temaNasional + '</option>');
                    }
                }
            });
        } else {
            $("#EditTemaNasionalId").html('<option value="" selected>' + temaNasional + '</option>');
        }

        $("#ModalEditTema").modal("show");
    });

    // ============================================================
    // UPDATE TEMA
    // ============================================================
    $("#UpdateTema").click(function() {
        var id = $("#EditId").val();
        var tahun = $("#EditTahun").val();
        var temaRKPId = $("#EditTemaNasionalId").val();
        var temaNasionalText = $("#EditTemaNasionalId option:selected").text();
        var temaProvinsi = $("#EditTemaProvinsi").val();

        if (!id || !tahun) {
            alert('Data tidak lengkap!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengupdate...');

        $.ajax({
            url: BaseURL + "Provinsi/UpdateTemaPembangunan",
            type: "POST",
            data: {
                Id: id,
                Tahun: tahun,
                TemaRKPId: temaRKPId,
                TemaNasionalText: temaNasionalText,
                TemaProvinsi: temaProvinsi
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal update tema!');
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengupdate tema!');
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            }
        });
    });

    // ============================================================
    // HAPUS TEMA
    // ============================================================
    $(document).on('click', '.HapusTema', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus Tema Pembangunan Provinsi ini beserta semua prioritasnya?')) {
            return;
        }

        $.ajax({
            url: BaseURL + "Provinsi/DeleteTemaPembangunan",
            type: "POST",
            data: { Id: id },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal menghapus tema!');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus tema!');
            }
        });
    });

    // ============================================================
    // TAMBAH PRIORITAS MODAL OPEN
    // ============================================================
    $(document).on('click', '.tambah-prioritas-kolom', function() {
        var temaId = $(this).data('tema_id');
        var temaNasional = $(this).data('tema_nasional');
        var jenis = $(this).data('jenis'); // 'nasional' or 'provinsi'
        var label = $(this).data('label');

        $("#InputPrioritasTemaIdKolom").val(temaId);
        $("#InputPrioritasJenisKolom").val(jenis);
        $("#InputPrioritasLabelKolom").val(label);
        $("#LabelTemaPrioritasKolom").text(temaNasional);

        if (jenis === 'nasional') {
            $("#JenisInfoKolom").removeClass('badge-pp').addClass('badge-pn').text('Prioritas Nasional (PN)');
            $("#DropdownRPJMNContainer").show();
            $("#InputManualContainer").hide();
            $("#InputPrioritasRPJMNId").val('');
        } else {
            $("#JenisInfoKolom").removeClass('badge-pn').addClass('badge-pp').text('Prioritas Provinsi (PP)');
            $("#DropdownRPJMNContainer").hide();
            $("#InputManualContainer").show();
            $("#InputPrioritasKolom").val('');
        }

        $("#ModalInputPrioritasKolom").modal("show");
    });

    // ============================================================
    // SIMPAN PRIORITAS
    // ============================================================
    $("#SimpanPrioritasKolom").click(function() {
        var temaId = $("#InputPrioritasTemaIdKolom").val();
        var jenis = $("#InputPrioritasJenisKolom").val();
        var prioritas = '';

        if (jenis === 'nasional') {
            prioritas = $("#InputPrioritasRPJMNId option:selected").text();
            if (!$("#InputPrioritasRPJMNId").val()) {
                alert('Pilih Prioritas Nasional RPJMN!');
                return;
            }
        } else {
            prioritas = $("#InputPrioritasKolom").val().trim();
            if (!prioritas) {
                alert('Prioritas Provinsi wajib diisi!');
                return;
            }
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + "Provinsi/InputPrioritasPembangunan",
            type: "POST",
            data: {
                TemaId: temaId,
                Jenis: jenis,
                Prioritas: prioritas
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan prioritas!');
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Prioritas');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan prioritas!');
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Prioritas');
            }
        });
    });

    // ============================================================
    // EDIT PRIORITAS
    // ============================================================
    $(document).on('click', '.EditPrioritas', function() {
        var id = $(this).data('id');
        var temaId = $(this).data('tema_id');
        var prioritas = $(this).data('prioritas');
        var jenis = $(this).data('jenis');

        $("#EditPrioritasId").val(id);
        $("#EditPrioritasTemaId").val(temaId);
        $("#EditPrioritasJenisHidden").val(jenis);
        $("#EditPrioritasText").val(prioritas);

        if (jenis === 'nasional') {
            $("#EditJenisInfo").removeClass('badge-pp').addClass('badge-pn').text('Prioritas Nasional (PN)');
        } else {
            $("#EditJenisInfo").removeClass('badge-pn').addClass('badge-pp').text('Prioritas Provinsi (PP)');
        }

        $("#ModalEditPrioritas").modal("show");
    });

    // UPDATE PRIORITAS
    $("#UpdatePrioritas").click(function() {
        var id = $("#EditPrioritasId").val();
        var prioritas = $("#EditPrioritasText").val().trim();

        if (!id || !prioritas) {
            alert('Uraian prioritas wajib diisi!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengupdate...');

        $.ajax({
            url: BaseURL + "Provinsi/UpdatePrioritasPembangunan",
            type: "POST",
            data: {
                Id: id,
                Prioritas: prioritas
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal update prioritas!');
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update Prioritas');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat mengupdate prioritas!');
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update Prioritas');
            }
        });
    });

    // ============================================================
    // HAPUS PRIORITAS
    // ============================================================
    $(document).on('click', '.HapusPrioritas', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus prioritas ini?')) {
            return;
        }

        $.ajax({
            url: BaseURL + "Provinsi/DeletePrioritasPembangunan",
            type: "POST",
            data: { Id: id },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal menghapus prioritas!');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus prioritas!');
            }
        });
    });

    // Clean modal backdrop on hide
    $(document).on("hidden.bs.modal", ".modal", function() {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

});
</script>
