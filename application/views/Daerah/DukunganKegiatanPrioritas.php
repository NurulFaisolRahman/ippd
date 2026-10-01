<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
<?php 
// Hanya pengguna yang login sebagai Daerah (Level 3) yang dapat melakukan aksi CRUD
$isDaerah = isset($IsDaerah) ? $IsDaerah : (isset($_SESSION['Level']) && $_SESSION['Level'] == 3); 
?>

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
    /* Styling khusus Dukungan Kegiatan Prioritas Utama */
    .kpu-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 25px 25px 35px 25px;
        margin-bottom: 30px;
    }
    .kpu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 2px solid #f0f2f5;
        padding-bottom: 18px;
        margin-bottom: 22px;
        gap: 15px;
    }
    .kpu-title-box h3 {
        margin: 0 0 5px 0;
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
    }
    .kpu-title-box p {
        margin: 0;
        font-size: 13px;
        color: #7f8c8d;
    }
    .badge-code {
        display: inline-block;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 4px;
        background: #e8f4fd;
        color: #0d6efd;
        border: 1px solid #c2e0fa;
        margin-right: 6px;
        white-space: nowrap;
    }
    .badge-kegiatan {
        display: inline-block;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 4px;
        background: #eafaf1;
        color: #198754;
        border: 1px solid #b7ebd0;
        margin-right: 6px;
        white-space: nowrap;
    }
    .badge-program {
        display: inline-block;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 4px;
        background: #fdf6e7;
        color: #d97706;
        border: 1px solid #fbe2b5;
        margin-right: 6px;
        white-space: nowrap;
    }
    .table-dukungan thead th {
        background-color: #f8fafc;
        color: #334155;
        font-weight: 700;
        font-size: 13px;
        border-bottom: 2px solid #e2e8f0 !important;
        vertical-align: middle !important;
    }
    .table-dukungan tbody td {
        vertical-align: middle !important;
        font-size: 13px;
        line-height: 1.5;
    }
    .table-dukungan tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Modal Form Styles */
    .form-group-kpu {
        margin-bottom: 18px;
    }
    .form-group-kpu label {
        font-weight: 600;
        font-size: 13px;
        color: #334155;
        margin-bottom: 6px;
        display: block;
    }
    .form-group-kpu .field-desc {
        font-size: 11px;
        color: #64748b;
        margin-top: 4px;
    }

    /* Select2 custom styling in modal */
    .select2-container {
        width: 100% !important;
    }
    .select2-container .select2-selection--single {
        height: 38px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
        padding-left: 12px !important;
        font-size: 13px !important;
        color: #1e293b !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .select2-container .select2-selection--multiple {
        min-height: 38px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        padding: 3px 6px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #fdf6e7 !important;
        border: 1px solid #fbe2b5 !important;
        color: #d97706 !important;
        font-weight: 600 !important;
        font-size: 11.5px !important;
        border-radius: 4px !important;
        padding: 2px 6px !important;
        margin-top: 3px !important;
        margin-right: 5px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #b45309 !important;
        margin-right: 4px !important;
        font-weight: bold !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #ef4444 !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #20c997 !important;
    }
    .select2-dropdown {
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        font-size: 13px !important;
        z-index: 999999 !important;
    }
    .select2-results__option {
        padding: 8px 12px !important;
    }
    .select2-results__option--highlighted[aria-selected] {
        background-color: #20c997 !important;
        color: #fff !important;
    }

    .btn-action-group {
        display: inline-flex;
        gap: 6px;
    }

    /* Tombol Aksi Kuning (Edit) */
    .btn-edit, .btn-kuning, .btn-amber {
        background-color: #ffc107 !important;
        border-color: #e0a800 !important;
        color: #212529 !important;
    }
    .btn-edit:hover, .btn-kuning:hover, .btn-amber:hover,
    .btn-edit:focus, .btn-kuning:focus, .btn-amber:focus {
        background-color: #e0a800 !important;
        border-color: #d39e00 !important;
        color: #212529 !important;
    }
</style>

<!-- Main Content Area -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <!-- Filter Wilayah (Khusus jika belum login / belum memilih wilayah) -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="form-example-wrap" style="margin-bottom: 20px; background: #fff; padding: 15px 20px; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                            <div class="form-example-int form-horizental">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <div class="row filter-row">
                                        <div class="col-lg-3 col-md-5">
                                            <div class="filter-group">
                                                <label for="FilterProvinsi"><b>Provinsi</b></label>
                                                <select class="form-control filter-select" id="FilterProvinsi">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($Provinsi as $prov) { ?>
                                                        <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                            <?= html_escape($prov['Nama']) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-5">
                                            <div class="filter-group">
                                                <label for="FilterKabKota"><b>Kab/Kota</b></label>
                                                <select class="form-control filter-select" id="FilterKabKota">
                                                    <option value="">Pilih Kab/Kota</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <div class="filter-group" style="margin-top: 25px;">
                                                <button class="btn btn-primary notika-btn-primary btn-block" id="BtnFilter">
                                                    <i class="fa fa-filter"></i> <b>Filter</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 20px; border-radius: 6px;">
                                <i class="fa fa-map-marker"></i> <strong>Wilayah Terpilih:</strong> <?= !empty($NamaWilayah) ? html_escape($NamaWilayah) : html_escape($KodeWilayah) ?>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <!-- Card Utama Data Table -->
                    <div class="kpu-card">
                        <div class="kpu-header">
                            <div class="kpu-title-box">
                                <h3><i class="fa fa-cubes" style="color: #20c997; margin-right: 8px;"></i> Dukungan Kegiatan Prioritas Utama</h3>
                                <p>Pemetaan Kegiatan Prioritas Utama (RPJMN) terhadap Dukungan Program pada RPJMD Daerah</p>
                            </div>
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                                <div style="position: relative;">
                                    <input type="text" id="FilterTableInput" class="form-control" placeholder="Cari dalam tabel..." style="height: 35px; width: 220px; font-size: 13px; padding-left: 32px; border-radius: 4px; border: 1px solid #cbd5e1;">
                                    <i class="fa fa-search" style="position: absolute; left: 11px; top: 11px; color: #94a3b8; font-size: 13px;"></i>
                                </div>
                                <?php if ($isDaerah) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputDukungan">
                                        <i class="fa fa-plus"></i> <b>Tambah Dukungan</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Tabel Responsif -->
                        <div class="table-responsive">
                            <table id="table-dukungan-kpu" class="table table-bordered table-dukungan">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <th style="width: 25%;">Prioritas Nasional</th>
                                        <th style="width: 32%;">Kegiatan Prioritas Utama</th>
                                        <th style="width: <?= $isDaerah ? '28%' : '38%' ?>;">Dukungan Program pada RPJMD</th>
                                        <?php if ($isDaerah) { ?>
                                            <th style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="table-dukungan-tbody">
                                    <?php 
                                    // Kelompokkan data per Prioritas Nasional agar PN hanya tampil 1 kali
                                    $groupedDukungan = [];
                                    if (!empty($DukunganList)) {
                                        foreach ($DukunganList as $item) {
                                            $pId = !empty($item['PrioritasId']) ? $item['PrioritasId'] : '0';
                                            $groupedDukungan[$pId][] = $item;
                                        }
                                    }

                                    if (!empty($groupedDukungan)) { 
                                        $no = 1;
                                        foreach ($groupedDukungan as $pId => $items) { 
                                            $pRowspan = count($items);
                                            $first = true;
                                            foreach ($items as $row) {
                                    ?>
                                        <tr class="dukungan-row">
                                            <?php if ($first) { ?>
                                                <td rowspan="<?= $pRowspan ?>" class="text-center font-bold" style="vertical-align: middle; font-weight: 600; background: #ffffff;">
                                                    <?= $no++ ?>
                                                </td>
                                                <td rowspan="<?= $pRowspan ?>" style="vertical-align: middle; background: #ffffff;">
                                                    <?php if (!empty($row['KodePrioritas'])) { ?>
                                                        <span class="badge-code"><?= html_escape($row['KodePrioritas']) ?></span>
                                                    <?php } ?>
                                                    <span style="font-weight: 600; color: #1e293b;">
                                                        <?= html_escape($row['PrioritasPembangunan'] ?: '-') ?>
                                                    </span>
                                                </td>
                                            <?php } ?>
                                            <td style="vertical-align: middle;">
                                                <?php if (!empty($row['KodeKegiatan'])) { ?>
                                                    <span class="badge-kegiatan"><?= html_escape($row['KodeKegiatan']) ?></span>
                                                <?php } ?>
                                                <span style="color: #334155;">
                                                    <?= html_escape($row['KegiatanPrioritas'] ?: '-') ?>
                                                </span>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                $listKodeProg = [];
                                                $listNamaProg = [];

                                                if (!empty($row['KodeProgram'])) {
                                                    if (strpos($row['KodeProgram'], '|||') !== false) {
                                                        $listKodeProg = array_values(array_filter(array_map('trim', explode('|||', $row['KodeProgram']))));
                                                    } elseif (strpos($row['KodeProgram'], ',') !== false) {
                                                        $listKodeProg = array_values(array_filter(array_map('trim', explode(',', $row['KodeProgram']))));
                                                    } else {
                                                        $listKodeProg = [trim($row['KodeProgram'])];
                                                    }
                                                }

                                                if (!empty($row['NamaProgram'])) {
                                                    if (strpos($row['NamaProgram'], '|||') !== false) {
                                                        $listNamaProg = array_values(array_filter(array_map('trim', explode('|||', $row['NamaProgram']))));
                                                    } elseif (strpos($row['NamaProgram'], "\n") !== false) {
                                                        $listNamaProg = array_values(array_filter(array_map('trim', explode("\n", $row['NamaProgram']))));
                                                    } else {
                                                        $listNamaProg = [trim($row['NamaProgram'])];
                                                    }
                                                }
                                                ?>
                                                <?php if (!empty($listKodeProg)) { ?>
                                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                                        <?php foreach ($listKodeProg as $idx => $kProg) { 
                                                            $nProg = $listNamaProg[$idx] ?? ($listNamaProg[0] ?? '-');
                                                        ?>
                                                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px 10px;">
                                                                <span class="badge-program"><?= html_escape($kProg) ?></span>
                                                                <div style="font-weight: 500; color: #0f172a; margin-top: 3px; font-size: 12.5px;">
                                                                    <?= html_escape($nProg) ?>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <span class="text-muted">-</span>
                                                <?php } ?>
                                            </td>
                                            <?php if ($isDaerah) { ?>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <div class="btn-action-group">
                                                        <button type="button" class="btn btn-xs btn-warning btn-edit" 
                                                                data-id="<?= $row['Id'] ?>" 
                                                                title="Edit Data" style="background-color: #ffc107 !important; border-color: #e0a800 !important; color: #212529 !important; padding: 4px 8px; border-radius: 4px;">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-xs btn-danger btn-hapus" 
                                                                data-id="<?= $row['Id'] ?>" 
                                                                title="Hapus Data" style="padding: 4px 8px; border-radius: 4px;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php 
                                                $first = false;
                                            } 
                                        } 
                                    } else { ?>
                                        <tr>
                                            <td colspan="<?= $isDaerah ? '5' : '4' ?>" class="text-center" style="padding: 30px; color: #64748b;">
                                                <i class="fa fa-info-circle" style="font-size: 16px; margin-right: 5px;"></i> Belum ada data Dukungan Kegiatan Prioritas Utama
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

    <?php if ($isDaerah) { ?>
    <!-- ============================================================ -->
    <!-- MODAL TAMBAH DUKUNGAN KEGIATAN PRIORITAS -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalInputDukungan" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" style="margin-top: 70px;">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="modal-header" style="background: #20c997; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 15px 20px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9;">&times;</button>
                    <h4 class="modal-title" style="font-weight: 700; color: #fff; text-align: left;">
                        <i class="fa fa-plus-circle"></i> Tambah Dukungan Kegiatan Prioritas Utama
                    </h4>
                </div>
                <div class="modal-body" style="padding: 25px; text-align: left;">
                    <div id="AlertInput" class="alert alert-warning" style="display:none; padding: 10px 14px; margin-bottom: 15px; border-radius: 4px; font-size: 13px;"></div>
                    <form id="FormInputDukungan">
                        <!-- 1. Prioritas Nasional -->
                        <div class="form-group-kpu">
                            <label for="Input_PrioritasId">
                                1. Prioritas Nasional <span class="text-danger">*</span>
                            </label>
                            <select id="Input_PrioritasId" class="form-control select2-modal" style="width: 100%;">
                                <option value="">-- Pilih Prioritas Nasional --</option>
                                <?php foreach ($PrioritasNasional as $p) { ?>
                                    <option value="<?= $p['Id'] ?>">
                                        <?= !empty($p['Kode']) ? '[' . html_escape($p['Kode']) . '] ' : '' ?><?= html_escape($p['PrioritasPembangunan']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="field-desc">Data diambil dari Kegiatan Prioritas Utama pada Prioritas Pembangunan (RPJMN).</div>
                        </div>

                        <!-- 2. Kegiatan Prioritas Utama -->
                        <div class="form-group-kpu">
                            <label for="Input_KegiatanId">
                                2. Kegiatan Prioritas Utama <span class="text-danger">*</span>
                            </label>
                            <select id="Input_KegiatanId" class="form-control select2-modal" style="width: 100%;" disabled>
                                <option value="">-- Pilih Prioritas Nasional Terlebih Dahulu --</option>
                            </select>
                            <div class="field-desc">Pilihan kegiatan akan muncul otomatis berdasarkan Prioritas Nasional yang dipilih.</div>
                        </div>

                        <!-- 3. Dukungan Program pada RPJMD -->
                        <div class="form-group-kpu">
                            <label>
                                3. Dukungan Program pada RPJMD <span class="text-danger">*</span>
                            </label>
                            <div id="wrapper-program-input" class="program-repeater-container">
                                <!-- Baris dropdown dinamis akan digenerate di sini -->
                            </div>
                            <div style="margin-top: 10px;">
                                <button type="button" class="btn btn-sm btn-success" id="BtnTambahRowProgramInput" style="border-radius: 4px; font-weight: 600; padding: 6px 14px;">
                                    <i class="fa fa-plus-circle"></i> Tambah Program Dukungan
                                </button>
                            </div>
                            <div class="field-desc">Gunakan tombol <b>Tambah Program Dukungan</b> untuk menambahkan lebih dari satu program RPJMD.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="padding: 15px 25px; background: #f8fafc; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>Batal</b></button>
                    <button type="button" class="btn btn-success" id="BtnSimpanDukungan">
                        <i class="fa fa-save"></i> <b>Simpan</b>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MODAL EDIT DUKUNGAN KEGIATAN PRIORITAS -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalEditDukungan" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" style="margin-top: 70px;">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="modal-header" style="background: #f59e0b; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 15px 20px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9;">&times;</button>
                    <h4 class="modal-title" style="font-weight: 700; color: #fff; text-align: left;">
                        <i class="fa fa-edit"></i> Edit Dukungan Kegiatan Prioritas Utama
                    </h4>
                </div>
                <div class="modal-body" style="padding: 25px; text-align: left;">
                    <div id="AlertEdit" class="alert alert-warning" style="display:none; padding: 10px 14px; margin-bottom: 15px; border-radius: 4px; font-size: 13px;"></div>
                    <form id="FormEditDukungan">
                        <input type="hidden" id="Edit_Id">

                        <!-- 1. Prioritas Nasional -->
                        <div class="form-group-kpu">
                            <label for="Edit_PrioritasId">
                                1. Prioritas Nasional <span class="text-danger">*</span>
                            </label>
                            <select id="Edit_PrioritasId" class="form-control select2-modal-edit" style="width: 100%;">
                                <option value="">-- Pilih Prioritas Nasional --</option>
                                <?php foreach ($PrioritasNasional as $p) { ?>
                                    <option value="<?= $p['Id'] ?>">
                                        <?= !empty($p['Kode']) ? '[' . html_escape($p['Kode']) . '] ' : '' ?><?= html_escape($p['PrioritasPembangunan']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- 2. Kegiatan Prioritas Utama -->
                        <div class="form-group-kpu">
                            <label for="Edit_KegiatanId">
                                2. Kegiatan Prioritas Utama <span class="text-danger">*</span>
                            </label>
                            <select id="Edit_KegiatanId" class="form-control select2-modal-edit" style="width: 100%;">
                                <option value="">-- Pilih Kegiatan Prioritas Utama --</option>
                            </select>
                        </div>

                        <!-- 3. Dukungan Program pada RPJMD -->
                        <div class="form-group-kpu">
                            <label>
                                3. Dukungan Program pada RPJMD <span class="text-danger">*</span>
                            </label>
                            <div id="wrapper-program-edit" class="program-repeater-container">
                                <!-- Baris dropdown dinamis akan digenerate di sini -->
                            </div>
                            <div style="margin-top: 10px;">
                                <button type="button" class="btn btn-sm btn-success" id="BtnTambahRowProgramEdit" style="border-radius: 4px; font-weight: 600; padding: 6px 14px;">
                                    <i class="fa fa-plus-circle"></i> Tambah Program Dukungan
                                </button>
                            </div>
                            <div class="field-desc">Gunakan tombol <b>Tambah Program Dukungan</b> untuk menambahkan lebih dari satu program RPJMD.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="padding: 15px 25px; background: #f8fafc; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>Batal</b></button>
                    <button type="button" class="btn btn-warning" id="BtnUpdateDukungan" style="color: #fff;">
                        <i class="fa fa-check"></i> <b>Update</b>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MODAL KONFIRMASI HAPUS DUKUNGAN -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalHapusDukungan" role="dialog">
        <div class="modal-dialog modal-sm" style="margin-top: 150px;">
            <div class="modal-content" style="border-radius: 8px; overflow: hidden;">
                <div class="modal-header" style="background: #ef4444; color: #fff; padding: 12px 16px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9;">&times;</button>
                    <h5 class="modal-title" style="color: #fff; font-weight: 700; margin: 0; text-align: left;">
                        <i class="fa fa-trash"></i> Konfirmasi Hapus
                    </h5>
                </div>
                <div class="modal-body" style="padding: 20px; text-align: center;">
                    <input type="hidden" id="Hapus_Id">
                    <p style="margin: 0; font-size: 14px; color: #334155; line-height: 1.5;">
                        Apakah Anda yakin ingin menghapus data dukungan kegiatan prioritas ini?
                    </p>
                </div>
                <div class="modal-footer" style="padding: 10px 15px; background: #f8fafc; display: flex; justify-content: flex-end; gap: 8px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>Batal</b></button>
                    <button type="button" class="btn btn-danger" id="BtnKonfirmasiHapus"><b>Ya, Hapus</b></button>
                </div>
            </div>
        </div>
    </div>

    <!-- TEMPLATE REPEATER BARIS PROGRAM RPJMD -->
    <div id="tmplProgramRow" style="display: none;">
        <div class="program-row-item" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
            <div style="flex: 1;">
                <select class="form-control program-select-row" style="width: 100%;">
                    <option value="">-- Pilih Program RPJMD --</option>
                    <?php foreach ($ProgramRPJMD as $prg) { ?>
                        <option value="<?= html_escape($prg['Kode']) ?>">
                            [<?= html_escape($prg['Kode']) ?>] <?= html_escape($prg['Nomenklatur']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="button" class="btn btn-danger btn-remove-program-row" title="Hapus Baris" style="height: 38px; width: 38px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 4px; flex-shrink: 0;">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
    <?php } ?>

</div>

<!-- SCRIPT LIBRARIES -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

    jQuery(document).ready(function($) {

        // Live Filter Tabel
        $('#FilterTableInput').on('keyup', function() {
            var val = $.trim($(this).val()).toLowerCase();
            if (!val) {
                $('#table-dukungan-tbody tr.dukungan-row').show();
                return;
            }
            $('#table-dukungan-tbody tr.dukungan-row').each(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(val) > -1);
            });
        });

        <?php if ($isDaerah) { ?>
        // Inisialisasi Select2 pada Modal Tambah
        $('#Input_PrioritasId').select2({
            dropdownParent: $('#ModalInputDukungan'),
            placeholder: "-- Pilih Prioritas Nasional --",
            allowClear: true
        });

        $('#Input_KegiatanId').select2({
            dropdownParent: $('#ModalInputDukungan'),
            placeholder: "-- Pilih Kegiatan Prioritas Utama --",
            allowClear: true
        });

        // Fungsi Tambah Baris Dropdown Program
        function addProgramRow(containerSelector, modalSelector, selectedVal) {
            var $newRow = $('#tmplProgramRow .program-row-item').clone();
            $(containerSelector).append($newRow);

            var $select = $newRow.find('select');
            $select.select2({
                dropdownParent: $(modalSelector),
                placeholder: "-- Pilih Program RPJMD --",
                allowClear: true,
                width: '100%'
            });

            if (selectedVal) {
                $select.val(selectedVal).trigger('change');
            }
        }

        // Hapus baris dropdown program
        $(document).on('click', '.btn-remove-program-row', function(e) {
            e.preventDefault();
            var $container = $(this).closest('.program-repeater-container');
            var rowCount = $container.find('.program-row-item').length;
            if (rowCount > 1) {
                $(this).closest('.program-row-item').remove();
            } else {
                $(this).closest('.program-row-item').find('select').val('').trigger('change');
            }
        });

        // Tombol Tambah Baris pada Modal Input
        $('#BtnTambahRowProgramInput').on('click', function(e) {
            e.preventDefault();
            addProgramRow('#wrapper-program-input', '#ModalInputDukungan', '');
        });

        // Tombol Tambah Baris pada Modal Edit
        $('#BtnTambahRowProgramEdit').on('click', function(e) {
            e.preventDefault();
            addProgramRow('#wrapper-program-edit', '#ModalEditDukungan', '');
        });

        // Inisialisasi Select2 pada Modal Edit
        $('#Edit_PrioritasId').select2({
            dropdownParent: $('#ModalEditDukungan'),
            placeholder: "-- Pilih Prioritas Nasional --"
        });

        $('#Edit_KegiatanId').select2({
            dropdownParent: $('#ModalEditDukungan'),
            placeholder: "-- Pilih Kegiatan Prioritas Utama --"
        });

        // Inisialisasi awal 1 baris dropdown pada modal input
        addProgramRow('#wrapper-program-input', '#ModalInputDukungan', '');

        // ============================================================
        // CHAINED DROPDOWN: Prioritas Nasional -> Kegiatan Prioritas
        // ============================================================
        $('#Input_PrioritasId').on('change', function() {
            var prioritasId = $(this).val();
            var $kegiatanSelect = $('#Input_KegiatanId');

            $kegiatanSelect.empty().append('<option value="">-- Memuat Kegiatan... --</option>').prop('disabled', true);

            if (!prioritasId) {
                $kegiatanSelect.empty().append('<option value="">-- Pilih Prioritas Nasional Terlebih Dahulu --</option>').prop('disabled', true);
                $kegiatanSelect.trigger('change');
                return;
            }

            $.ajax({
                url: BaseURL + 'Daerah/GetKegiatanKpuByPrioritas',
                type: 'POST',
                data: {
                    PrioritasId: prioritasId,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(response) {
                    $kegiatanSelect.empty().append('<option value="">-- Pilih Kegiatan Prioritas Utama --</option>');
                    if (response && response.length > 0) {
                        $.each(response, function(index, item) {
                            var kodeText = item.Kode ? '[' + item.Kode + '] ' : '';
                            $kegiatanSelect.append('<option value="' + item.Id + '">' + kodeText + item.KegiatanPrioritas + '</option>');
                        });
                        $kegiatanSelect.prop('disabled', false);
                    } else {
                        $kegiatanSelect.append('<option value="" disabled>Tidak ada kegiatan pada prioritas ini</option>');
                    }
                    $kegiatanSelect.trigger('change');
                },
                error: function() {
                    $kegiatanSelect.empty().append('<option value="">Gagal memuat kegiatan</option>');
                    $kegiatanSelect.trigger('change');
                }
            });
        });

        // ============================================================
        // CHAINED DROPDOWN PADA MODAL EDIT
        // ============================================================
        $('#Edit_PrioritasId').on('change', function(e, selectedKegiatanId) {
            var prioritasId = $(this).val();
            var $kegiatanSelect = $('#Edit_KegiatanId');

            $kegiatanSelect.empty().append('<option value="">-- Memuat Kegiatan... --</option>').prop('disabled', true);

            if (!prioritasId) {
                $kegiatanSelect.empty().append('<option value="">-- Pilih Prioritas Terlebih Dahulu --</option>');
                $kegiatanSelect.trigger('change');
                return;
            }

            $.ajax({
                url: BaseURL + 'Daerah/GetKegiatanKpuByPrioritas',
                type: 'POST',
                data: {
                    PrioritasId: prioritasId,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(response) {
                    $kegiatanSelect.empty().append('<option value="">-- Pilih Kegiatan Prioritas Utama --</option>');
                    if (response && response.length > 0) {
                        $.each(response, function(index, item) {
                            var kodeText = item.Kode ? '[' + item.Kode + '] ' : '';
                            var isSelected = (selectedKegiatanId && selectedKegiatanId == item.Id) ? 'selected' : '';
                            $kegiatanSelect.append('<option value="' + item.Id + '" ' + isSelected + '>' + kodeText + item.KegiatanPrioritas + '</option>');
                        });
                        $kegiatanSelect.prop('disabled', false);
                    } else {
                        $kegiatanSelect.append('<option value="" disabled>Tidak ada kegiatan pada prioritas ini</option>');
                    }
                    $kegiatanSelect.trigger('change');
                },
                error: function() {
                    $kegiatanSelect.empty().append('<option value="">Gagal memuat kegiatan</option>');
                    $kegiatanSelect.trigger('change');
                }
            });
        });

        // ============================================================
        // SIMPAN DUKUNGAN (TAMBAH) - TANPA ALERT BROWSER
        // ============================================================
        $('#BtnSimpanDukungan').on('click', function() {
            var prioritasId = $('#Input_PrioritasId').val();
            var kegiatanId  = $('#Input_KegiatanId').val();
            var $alertBox   = $('#AlertInput');

            $alertBox.hide().empty();

            if (!prioritasId) {
                $alertBox.text('Silakan pilih Prioritas Nasional!').slideDown();
                $('#Input_PrioritasId').select2('open');
                return;
            }
            if (!kegiatanId) {
                $alertBox.text('Silakan pilih Kegiatan Prioritas Utama!').slideDown();
                $('#Input_KegiatanId').select2('open');
                return;
            }
            var kodePrograms = [];
            $('#wrapper-program-input select.program-select-row').each(function() {
                var val = $(this).val();
                if (val && val !== '') {
                    kodePrograms.push(val);
                }
            });

            if (kodePrograms.length === 0) {
                $alertBox.text('Silakan pilih minimal 1 Dukungan Program pada RPJMD!').slideDown();
                return;
            }

            // Deduplikasi pilihan jika user memilih program yang sama pada baris berbeda
            kodePrograms = kodePrograms.filter(function(item, pos) {
                return kodePrograms.indexOf(item) === pos;
            });

            var $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/InputDukunganKegiatanPrioritas',
                type: 'POST',
                data: {
                    PrioritasId: prioritasId,
                    KegiatanId: kegiatanId,
                    KodeProgram: kodePrograms,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(res) {
                    $('#ModalInputDukungan').modal('hide');
                    window.location.reload();
                },
                error: function() {
                    // Fallback jika respon non-json atau tetap berhasil
                    $('#ModalInputDukungan').modal('hide');
                    window.location.reload();
                }
            });
        });

        // ============================================================
        // KLIK TOMBOL EDIT (BUKA MODAL & ISI FORM)
        // ============================================================
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var $btn = $(this);
            $btn.prop('disabled', true);
            $('#AlertEdit').hide().empty();

            $.ajax({
                url: BaseURL + 'Daerah/GetDukunganKegiatanPrioritasById',
                type: 'POST',
                data: {
                    Id: id,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(data) {
                    $btn.prop('disabled', false);
                    if (data && data.Id) {
                        $('#Edit_Id').val(data.Id);
                        
                        var kodes = [];
                        if (data.KodeProgram) {
                            if (data.KodeProgram.indexOf('|||') !== -1) {
                                kodes = data.KodeProgram.split('|||').map(function(s) { return $.trim(s); }).filter(function(s) { return s.length > 0; });
                            } else if (data.KodeProgram.indexOf(',') !== -1) {
                                kodes = data.KodeProgram.split(',').map(function(s) { return $.trim(s); }).filter(function(s) { return s.length > 0; });
                            } else {
                                kodes = [$.trim(data.KodeProgram)];
                            }
                        }
                        // Isi repeater program pada modal edit
                        $('#wrapper-program-edit').empty();
                        if (kodes.length > 0) {
                            for (var i = 0; i < kodes.length; i++) {
                                addProgramRow('#wrapper-program-edit', '#ModalEditDukungan', kodes[i]);
                            }
                        } else {
                            addProgramRow('#wrapper-program-edit', '#ModalEditDukungan', '');
                        }
                        $('#Edit_PrioritasId').val(data.PrioritasId).trigger('change', [data.KegiatanId]);
                        $('#ModalEditDukungan').modal('show');
                    }
                },
                error: function() {
                    $btn.prop('disabled', false);
                }
            });
        });

        // ============================================================
        // UPDATE DUKUNGAN (EDIT) - TANPA ALERT BROWSER
        // ============================================================
        $('#BtnUpdateDukungan').on('click', function() {
            var id          = $('#Edit_Id').val();
            var prioritasId = $('#Edit_PrioritasId').val();
            var kegiatanId  = $('#Edit_KegiatanId').val();
            var $alertBox   = $('#AlertEdit');
            var kodePrograms = [];
            $('#wrapper-program-edit select.program-select-row').each(function() {
                var val = $(this).val();
                if (val && val !== '') {
                    kodePrograms.push(val);
                }
            });

            if (!id || !prioritasId || !kegiatanId || kodePrograms.length === 0) {
                $alertBox.text('Harap lengkapi semua field dan pilih minimal 1 Dukungan Program!').slideDown();
                return;
            }

            kodePrograms = kodePrograms.filter(function(item, pos) {
                return kodePrograms.indexOf(item) === pos;
            });

            var $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengupdate...');

            $.ajax({
                url: BaseURL + 'Daerah/EditDukunganKegiatanPrioritas',
                type: 'POST',
                data: {
                    Id: id,
                    PrioritasId: prioritasId,
                    KegiatanId: kegiatanId,
                    KodeProgram: kodePrograms,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(res) {
                    $('#ModalEditDukungan').modal('hide');
                    window.location.reload();
                },
                error: function() {
                    $('#ModalEditDukungan').modal('hide');
                    window.location.reload();
                }
            });
        });

        // ============================================================
        // HAPUS DUKUNGAN - MENGGUNAKAN MODAL CUSTOM (TANPA CONFIRM BROWSER)
        // ============================================================
        $(document).on('click', '.btn-hapus', function() {
            var id = $(this).data('id');
            $('#Hapus_Id').val(id);
            $('#ModalHapusDukungan').modal('show');
        });

        $('#BtnKonfirmasiHapus').on('click', function() {
            var id = $('#Hapus_Id').val();
            var $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menghapus...');

            $.ajax({
                url: BaseURL + 'Daerah/HapusDukunganKegiatanPrioritas',
                type: 'POST',
                data: {
                    Id: id,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(res) {
                    $('#ModalHapusDukungan').modal('hide');
                    window.location.reload();
                },
                error: function() {
                    $('#ModalHapusDukungan').modal('hide');
                    window.location.reload();
                }
            });
        });

        // ============================================================
        // RESET MODAL SAAT DITUTUP
        // ============================================================
        $('#ModalInputDukungan').on('hidden.bs.modal', function() {
            $('#AlertInput').hide().empty();
            $('#Input_PrioritasId').val('').trigger('change');
            $('#Input_KegiatanId').empty().append('<option value="">-- Pilih Prioritas Nasional Terlebih Dahulu --</option>').prop('disabled', true).trigger('change');
            // Reset repeater ke 1 baris kosong
            $('#wrapper-program-input').empty();
            addProgramRow('#wrapper-program-input', '#ModalInputDukungan', '');
        });

        $('#ModalEditDukungan').on('hidden.bs.modal', function() {
            $('#AlertEdit').hide().empty();
        });
        <?php } ?>

        // ============================================================
        // FILTER WILAYAH (Jika belum login)
        // ============================================================
        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
            $("#FilterProvinsi").change(function() {
                var provKode = $(this).val();
                if (!provKode) {
                    $("#FilterKabKota").html('<option value="">Pilih Kab/Kota</option>');
                    return;
                }
                $.ajax({
                    url: BaseURL + "Daerah/GetListKabKota",
                    type: "POST",
                    data: { 
                        Kode: provKode, 
                        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                    },
                    beforeSend: function() { 
                        $("#FilterKabKota").prop('disabled', true); 
                    },
                    success: function(data) {
                        $("#FilterKabKota").html(data).prop('disabled', false);
                    },
                    error: function() {
                        $("#FilterKabKota").prop('disabled', false);
                    }
                });
            });

            $("#BtnFilter").click(function() {
                var kodeWilayah = $("#FilterKabKota").val() || $("#FilterProvinsi").val();
                if (!kodeWilayah) {
                    alert("Pilih Provinsi dan/atau Kab/Kota terlebih dahulu!");
                    return;
                }
                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: { 
                        KodeWilayah: kodeWilayah, 
                        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                    },
                    success: function(resp) {
                        window.location.href = BaseURL + "Daerah/DukunganKegiatanPrioritas?KodeWilayah=" + kodeWilayah;
                    }
                });
            });
        <?php } ?>

    });
</script>
</body>
</html>
