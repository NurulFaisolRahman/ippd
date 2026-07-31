<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <!-- Filter untuk pengguna yang belum login -->
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
                                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <div class="alert alert-info" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= html_escape($NamaWilayah) ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <!-- Tombol Tambah Tema -->
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTema">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Tema</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr style="background-color: #f0f0f0; color: #333; text-align: center;">
                                        <th style="width: 3%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">No</th>
                                        <th style="width: 18%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            <span style="font-size: 14px; font-weight: bold;">TEMA PEMBANGUNAN NASIONAL</span>
                                            <div style="font-size: 10px; font-weight: normal; color: #666; margin-top: 3px;">
                                            </div>
                                        </th>
                                        <th style="width: 18%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            <span style="font-size: 14px; font-weight: bold;">TEMA PEMBANGUNAN PROVINSI</span>
                                            <div style="font-size: 10px; font-weight: normal; color: #666; margin-top: 3px;">
                                            </div>
                                        </th>
                                        <th style="width: 18%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            <span style="font-size: 14px; font-weight: bold;">TEMA PEMBANGUNAN DAERAH</span>
                                            <div style="font-size: 10px; font-weight: normal; color: #666; margin-top: 3px;">
                                            </div>
                                        </th>
                                        <th style="width: 7%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">Tahun</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width: 11%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">Aksi Tema</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($TemaPembangunan)) { ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted" style="padding: 30px 0;">
                                            <i class="fa fa-info-circle"></i> Belum ada data Tema Pembangunan
                                        </td>
                                    </tr>
                                    <?php } else { ?>
                                    <?php $No = 1; foreach ($TemaPembangunan as $tema) { 
                                        $totalPrioritas = count($tema['prioritas_nasional']) + count($tema['prioritas_provinsi']) + count($tema['prioritas_daerah']);
                                        $rowspan = max(1, $totalPrioritas);
                                    ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <strong><?= $No++ ?></strong>
                                        </td>
                                        
                                        <!-- KOLOM NASIONAL -->
                                        <td style="vertical-align: top; padding: 8px; border: 1px solid #ddd; background-color: #fff;">
                                            <div style="font-weight: bold; font-size: 14px; color: #333; border-bottom: 2px solid #ccc; padding-bottom: 6px; margin-bottom: 8px;">
                                                <?= html_escape($tema['tema_nasional']) ?>
                                            </div>
                                            <?php if (!empty($tema['tema_rkp_text'])) { ?>
                                            <div style="font-size: 10px; color: #17a2b8; margin-bottom: 8px; background: #e7f5ff; padding: 2px 8px; border-radius: 3px;">
                                                <i class="fa fa-bookmark"></i> Tema RKP: <?= html_escape($tema['tema_rkp_text']) ?>
                                            </div>
                                            <?php } ?>
                                            <div style="font-size: 11px; color: #555; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #999; padding-left: 6px;">
                                                <span class="badge-pn">PN</span> PRIORITAS NASIONAL
                                            </div>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <button class="btn btn-xs btn-primary tambah-prioritas-kolom" 
                                                    data-tema_id="<?= $tema['id'] ?>"
                                                    data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                    data-jenis="nasional"
                                                    data-label="PN"
                                                    style="margin-bottom: 5px; padding: 2px 8px; font-size: 10px;">
                                                <i class="notika-icon notika-plus"></i> Tambah PN
                                            </button>
                                            <?php } ?>
                                            <div class="prioritas-list">
                                                <?php if (!empty($tema['prioritas_nasional'])) { ?>
                                                    <?php foreach ($tema['prioritas_nasional'] as $idx => $p) { ?>
                                                        <div class="prioritas-item" style="display: flex; align-items: center; gap: 4px; padding: 2px 0; border-bottom: 1px dashed #eee;">
                                                            <span style="font-size: 11px; color: #777; min-width: 20px;"><?= ($idx + 1) ?>.</span>
                                                            <span style="font-size: 12px; color: #333; flex: 1;"><?= html_escape($p['prioritas']) ?></span>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                <button class="btn btn-xs btn-primary EditPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        data-tema_id="<?= $tema['id'] ?>"
                                                                        data-prioritas="<?= html_escape($p['prioritas']) ?>"
                                                                        data-jenis="nasional"
                                                                        data-label="PN"
                                                                        style="padding: 1px 4px; font-size: 9px;">
                                                                    <i class="notika-icon notika-edit" style="font-size: 9px;"></i>
                                                                </button>
                                                                <button class="btn btn-xs btn-danger HapusPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        style="padding: 1px 4px; font-size: 9px;">
                                                                    <i class="notika-icon notika-close" style="font-size: 9px;"></i>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="text-muted" style="font-size: 11px; font-style: italic; padding: 3px 0;">Belum ada prioritas</div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        
                                        <!-- KOLOM PROVINSI -->
                                        <td style="vertical-align: top; padding: 8px; border: 1px solid #ddd; background-color: #fff;">
                                            <div style="font-weight: bold; font-size: 14px; color: #333; border-bottom: 2px solid #ccc; padding-bottom: 6px; margin-bottom: 8px;">
                                                <?= html_escape($tema['tema_provinsi']) ?>
                                            </div>
                                            <div style="font-size: 11px; color: #555; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #999; padding-left: 6px;">
                                                <span class="badge-pp">PP</span> PRIORITAS PROVINSI
                                            </div>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <button class="btn btn-xs btn-primary tambah-prioritas-kolom" 
                                                    data-tema_id="<?= $tema['id'] ?>"
                                                    data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                    data-jenis="provinsi"
                                                    data-label="PP"
                                                    style="margin-bottom: 5px; padding: 2px 8px; font-size: 10px;">
                                                <i class="notika-icon notika-plus"></i> Tambah PP
                                            </button>
                                            <?php } ?>
                                            <div class="prioritas-list">
                                                <?php if (!empty($tema['prioritas_provinsi'])) { ?>
                                                    <?php foreach ($tema['prioritas_provinsi'] as $idx => $p) { ?>
                                                        <div class="prioritas-item" style="display: flex; align-items: center; gap: 4px; padding: 2px 0; border-bottom: 1px dashed #eee;">
                                                            <span style="font-size: 11px; color: #777; min-width: 20px;"><?= ($idx + 1) ?>.</span>
                                                            <span style="font-size: 12px; color: #333; flex: 1;"><?= html_escape($p['prioritas']) ?></span>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                <button class="btn btn-xs btn-primary EditPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        data-tema_id="<?= $tema['id'] ?>"
                                                                        data-prioritas="<?= html_escape($p['prioritas']) ?>"
                                                                        data-jenis="provinsi"
                                                                        data-label="PP"
                                                                        style="padding: 1px 4px; font-size: 9px;">
                                                                    <i class="notika-icon notika-edit" style="font-size: 9px;"></i>
                                                                </button>
                                                                <button class="btn btn-xs btn-danger HapusPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        style="padding: 1px 4px; font-size: 9px;">
                                                                    <i class="notika-icon notika-close" style="font-size: 9px;"></i>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="text-muted" style="font-size: 11px; font-style: italic; padding: 3px 0;">Belum ada prioritas</div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        
                                        <!-- KOLOM DAERAH -->
                                        <td style="vertical-align: top; padding: 8px; border: 1px solid #ddd; background-color: #fff;" >
                                            <div style="font-weight: bold; font-size: 14px; color: #333; border-bottom: 2px solid #ccc; padding-bottom: 6px; margin-bottom: 8px;">
                                                <?= html_escape($tema['tema_daerah']) ?>
                                            </div>
                                            <div style="font-size: 11px; color: #555; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px; border-left: 3px solid #999; padding-left: 6px;">
                                                <span class="badge-pd">PD</span> PRIORITAS DAERAH
                                            </div>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <button class="btn btn-xs btn-primary tambah-prioritas-kolom" 
                                                    data-tema_id="<?= $tema['id'] ?>"
                                                    data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                    data-jenis="daerah"
                                                    data-label="PD"
                                                    style="margin-bottom: 5px; padding: 2px 8px; font-size: 10px;">
                                                <i class="notika-icon notika-plus"></i> Tambah PD
                                            </button>
                                            <?php } ?>
                                            <div class="prioritas-list">
                                                <?php if (!empty($tema['prioritas_daerah'])) { ?>
                                                    <?php foreach ($tema['prioritas_daerah'] as $idx => $p) { ?>
                                                        <div class="prioritas-item" style="display: flex; align-items: center; gap: 4px; padding: 2px 0; border-bottom: 1px dashed #eee;">
                                                            <span style="font-size: 11px; color: #777; min-width: 20px;"><?= ($idx + 1) ?>.</span>
                                                            <span style="font-size: 12px; color: #333; flex: 1;"><?= html_escape($p['prioritas']) ?></span>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                <button class="btn btn-xs btn-primary EditPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        data-tema_id="<?= $tema['id'] ?>"
                                                                        data-prioritas="<?= html_escape($p['prioritas']) ?>"
                                                                        data-jenis="daerah"
                                                                        data-label="PD"
                                                                        style="padding: 1px 4px; font-size: 9px;">
                                                                    <i class="notika-icon notika-edit" style="font-size: 9px;"></i>
                                                                </button>
                                                                <button class="btn btn-xs btn-danger HapusPrioritas" 
                                                                        data-id="<?= $p['id'] ?>"
                                                                        style="padding: 1px 4px; font-size: 9px;">
                                                                    <i class="notika-icon notika-close" style="font-size: 9px;"></i>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div class="text-muted" style="font-size: 11px; font-style: italic; padding: 3px 0;">Belum ada prioritas</div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <strong><?= html_escape($tema['tahun']) ?></strong>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;" >
                                            <div class="btn-group" style="display: inline-flex; gap: 3px; flex-direction: row; flex-wrap: wrap; justify-content: center;">
                                                <!-- Di dalam tabel, pada tombol Edit -->
                                                    <button class="btn btn-sm btn-warning EditTema" 
                                                        data-id="<?= $tema['id'] ?>"
                                                        data-tahun="<?= html_escape($tema['tahun']) ?>"
                                                        data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                        data-tema_provinsi="<?= html_escape($tema['tema_provinsi']) ?>"
                                                        data-tema_daerah="<?= html_escape($tema['tema_daerah']) ?>"
                                                        data-tema_rkp_id="<?= $tema['tema_rkp_id'] ?? '' ?>"
                                                        title="Edit Tema"
                                                        style="padding: 2px 8px; font-size: 11px; background-color: #f0ad4e; border-color: #eea236; color: #fff; border-radius: 3px;">
                                                        <i class="notika-icon notika-settings"></i> Edit
                                                    </button>
                                                <button class="btn btn-sm btn-danger HapusTema" 
                                                        data-id="<?= $tema['id'] ?>"
                                                        title="Hapus Tema"
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

<!-- ============================================================
MODAL INPUT TEMA - TAHUN INPUT MANUAL, TEMA NASIONAL AUTO REFRESH
============================================================ -->
<div class="modal fade" id="ModalInputTema" role="dialog">
    <div class="modal-dialog modal-lg" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Tema Pembangunan</b></h4>
                <p><small class="text-muted">Tahun diisi manual, Tema Nasional otomatis refresh saat pilih tahun Tema RKP</small></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <!-- TAHUN - INPUT MANUAL -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="number" class="form-control" id="Tahun" placeholder="Contoh: 2026" min="2000" max="2100" style="color: #000;" value="<?= date('Y') ?>">
                                                <small class="text-muted" style="display: block; margin-top: 4px;">
                                                    <i class="fa fa-info-circle"></i> Tahun untuk tema pembangunan (bebas diisi manual)
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================== -->
                            <!-- DROPDOWN TEMA NASIONAL DENGAN AUTO REFRESH -->
                            <!-- ========================================== -->
                            <div class="dropdown-group">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Tema Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">Tema RKP</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <!-- Pilih Tahun Tema RKP - Auto Refresh -->
                                                    <div style="margin-bottom: 8px;">
                                                        <select class="form-control" id="TahunTemaRKP" style="color: #000;">
                                                            <option value="">-- Pilih Tahun Tema RKP --</option>
                                                            <?php foreach ($TahunTemaRKP as $t) { ?>
                                                                <option value="<?= $t['Tahun'] ?>"><?= $t['Tahun'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="text-muted" style="display: block; margin-top: 4px;">
                                                            <i class="fa fa-info-circle"></i> Tema RKP akan otomatis dimuat saat memilih tahun
                                                        </small>
                                                    </div>
                                                    <!-- Dropdown Tema RKP -->
                                                    <select class="form-control" id="TemaNasionalId" style="color: #000;">
                                                        <option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>
                                                    </select>
                                                    <span class="tema-rkp-loading" id="tema-rkp-loading">
                                                        <span class="spinner-border-sm"></span> Memuat...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TEMA PROVINSI -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema Provinsi</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="TemaProvinsi" rows="2" placeholder="Tema Pembangunan Provinsi" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TEMA DAERAH -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema Daerah</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="TemaDaerah" rows="2" placeholder="Tema Pembangunan Daerah" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="InputTema"><b>SIMPAN</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT TEMA - TAHUN INPUT MANUAL, TEMA NASIONAL AUTO REFRESH
============================================================ -->
<div class="modal fade" id="ModalEditTema" role="dialog">
    <div class="modal-dialog modal-lg" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Tema Pembangunan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="EditId">
                            
                            <!-- TAHUN - INPUT MANUAL -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="number" class="form-control" id="EditTahun" min="2000" max="2100" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN TEMA NASIONAL DENGAN AUTO REFRESH -->
                            <div class="dropdown-group">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Tema Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">Tema RKP</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <div style="margin-bottom: 8px;">
                                                        <select class="form-control" id="EditTahunTemaRKP" style="color: #000;">
                                                            <option value="">-- Pilih Tahun Tema RKP --</option>
                                                            <?php foreach ($TahunTemaRKP as $t) { ?>
                                                                <option value="<?= $t['Tahun'] ?>"><?= $t['Tahun'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <select class="form-control" id="EditTemaNasionalId" style="color: #000;">
                                                        <option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>
                                                    </select>
                                                    <span class="tema-rkp-loading" id="edit-tema-rkp-loading">
                                                        <span class="spinner-border-sm"></span> Memuat...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TEMA PROVINSI -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema Provinsi</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="EditTemaProvinsi" rows="2" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TEMA DAERAH -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema Daerah</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="EditTemaDaerah" rows="2" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="UpdateTema"><b>UPDATE</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL TAMBAH PRIORITAS - PN DARI DROPDOWN RPJMN
============================================================ -->
<div class="modal fade" id="ModalInputPrioritasKolom" role="dialog">
    <div class="modal-dialog" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Prioritas</b></h4>
                <p><small>Untuk tema: <span id="LabelTemaPrioritasKolom" style="font-weight: bold;"></span></small></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="InputPrioritasTemaIdKolom">
                            <input type="hidden" id="InputPrioritasJenisKolom">
                            <input type="hidden" id="InputPrioritasLabelKolom">
                            
                            <!-- TEMA INFO -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="TemaInfoKolom" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- JENIS PRIORITAS -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Jenis</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="JenisInfoKolom" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN PRIORITAS NASIONAL RPJMN - KHUSUS PN -->
                            <div class="dropdown-group" id="DropdownRPJMNContainer" style="display: none;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Prioritas Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">RPJMN</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="InputPrioritasRPJMNId" style="color: #000;">
                                                        <option value="">-- Pilih Prioritas Nasional RPJMN --</option>
                                                        <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                                                            <option value="<?= $p['Id'] ?>"><?= html_escape($p['PrioritasNasional']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT MANUAL UNTUK PP DAN PD -->
                            <div class="form-example-int form-horizental" id="InputManualContainer">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Prioritas</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="InputPrioritasKolom" rows="3" placeholder="Masukkan prioritas..." style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-primary notika-btn-primary" id="SimpanPrioritasKolom"><b>SIMPAN</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT PRIORITAS - SAMA DENGAN INPUT
============================================================ -->
<div class="modal fade" id="ModalEditPrioritas" role="dialog">
    <div class="modal-dialog" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Prioritas</b></h4>
                <p><small>Edit prioritas untuk tema terkait</small></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="EditPrioritasId">
                            <input type="hidden" id="EditPrioritasTemaId">
                            <input type="hidden" id="EditPrioritasJenisHidden">
                            <input type="hidden" id="EditPrioritasLabelHidden">
                            
                            <!-- TEMA INFO -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="EditTemaInfo" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- JENIS PRIORITAS -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Jenis</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="EditJenisInfo" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN PRIORITAS NASIONAL RPJMN - UNTUK EDIT PN -->
                            <div class="dropdown-group" id="EditDropdownRPJMNContainer" style="display: none;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Prioritas Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">RPJMN</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPrioritasRPJMNId" style="color: #000;">
                                                        <option value="">-- Pilih Prioritas Nasional RPJMN --</option>
                                                        <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                                                            <option value="<?= $p['Id'] ?>"><?= html_escape($p['PrioritasNasional']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT MANUAL UNTUK PP DAN PD (EDIT) -->
                            <div class="form-example-int form-horizental" id="EditInputManualContainer">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Prioritas</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="EditPrioritasText" rows="3" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="UpdatePrioritas"><b>UPDATE</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control, .form-control option {
        color: #000 !important;
    }
    .modal-content {
        color: #000;
    }
    
    .badge-pn {
        background-color: #007bff;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        display: inline-block;
        margin-right: 3px;
        font-weight: bold;
        min-width: 28px;
        text-align: center;
    }
    .badge-pp {
        background-color: #28a745;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        display: inline-block;
        margin-right: 3px;
        font-weight: bold;
        min-width: 28px;
        text-align: center;
    }
    .badge-pd {
        background-color: #fd7e14;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        display: inline-block;
        margin-right: 3px;
        font-weight: bold;
        min-width: 28px;
        text-align: center;
    }
    
    .dropdown-group {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #dee2e6;
        margin-bottom: 15px;
    }
    .dropdown-group label {
        font-weight: 600;
        color: #495057;
    }
    .dropdown-group .badge-reference {
        background-color: #17a2b8;
        color: #fff;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 10px;
        margin-left: 5px;
    }
    .tema-rkp-loading {
        display: none;
        color: #6c757d;
        font-size: 12px;
        margin-left: 10px;
    }
    .tema-rkp-loading.active {
        display: inline-block;
    }
    
    .text-danger {
        color: #dc3545 !important;
    }
    
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
        .filter-row {
            flex-direction: column;
            gap: 15px;
        }
        .filter-select {
            width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
        }
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
    
    .table-bordered td, .table-bordered th {
        border: 1px solid #ddd !important;
    }
    
    .text-muted {
        color: #999 !important;
        font-size: 12px;
    }
    
    .prioritas-item {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 2px 0;
        border-bottom: 1px dashed #eee;
    }
    .prioritas-item:last-child {
        border-bottom: none;
    }
    
    .btn-xs {
        padding: 1px 4px;
        font-size: 9px;
        line-height: 1.2;
        border-radius: 3px;
    }
    .btn-xs .notika-icon {
        font-size: 9px;
    }
    
    .btn-default {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        color: #333;
    }
    .btn-default:hover {
        background-color: #e8e8e8;
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
    
    .form-control-static {
        padding: 6px 12px;
        margin-bottom: 0;
        font-weight: bold;
        color: #333;
    }
</style>

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

jQuery(document).ready(function($) {

    // ============================================================
    // FILTER WILAYAH
    // ============================================================
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
                            window.location.href = BaseURL + "Daerah/TemaPembangunan";
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

        <?php if (!empty($KodeWilayah)) { ?>
            var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
            var kodeKab = "<?= $KodeWilayah ?>";
            $("#Provinsi").val(kodeProv);
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: kodeProv, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
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
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                }
            });
        <?php } ?>
    <?php } ?>

    // ============================================================
    // FUNGSI UNTUK MEMUAT TEMA RKP BERDASARKAN TAHUN
    // ============================================================
    function loadTemaRKP(tahun, targetId, selectedId = null) {
        if (!tahun || tahun === '' || tahun.length !== 4) {
            $('#' + targetId).html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
            return;
        }
        
        var loadingId = (targetId === 'TemaNasionalId') ? '#tema-rkp-loading' : '#edit-tema-rkp-loading';
        $(loadingId).addClass('active');
        
        $.ajax({
            url: BaseURL + "Daerah/GetTemaRKPByTahun",
            type: "POST",
            data: { 
                tahun: tahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            success: function(Respon) {
                try {
                    var Data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    var options = '<option value="">-- Pilih Tema Nasional --</option>';
                    
                    if (Data.length > 0) {
                        for (var i = 0; i < Data.length; i++) {
                            var selected = (selectedId && parseInt(Data[i].Id) === parseInt(selectedId)) ? 'selected' : '';
                            options += '<option value="' + Data[i].Id + '" ' + selected + '>' + Data[i].TemaRKP + '</option>';
                        }
                    } else {
                        options = '<option value="">Tidak ada data Tema RKP untuk tahun ' + tahun + '</option>';
                    }
                    
                    $('#' + targetId).html(options);
                } catch(e) {
                    console.error('Error parsing Tema RKP:', e);
                    $('#' + targetId).html('<option value="">Error memuat data</option>');
                }
                $(loadingId).removeClass('active');
            },
            error: function(xhr) {
                console.error('Error loading Tema RKP:', xhr);
                $('#' + targetId).html('<option value="">Error memuat data</option>');
                $(loadingId).removeClass('active');
            }
        });
    }

    // ============================================================
    // EVENT LISTENER - AUTO REFRESH SAAT PILIH TAHUN TEMA RKP
    // ============================================================
    $('#TahunTemaRKP').on('change', function() {
        var tahun = $(this).val();
        if (tahun && tahun.length === 4) {
            // Reset dropdown Tema Nasional
            $('#TemaNasionalId').html('<option value="">Memuat data...</option>');
            loadTemaRKP(tahun, 'TemaNasionalId');
        } else {
            $('#TemaNasionalId').html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        }
    });

   // ============================================================
// AUTO REFRESH SAAT PILIH TAHUN TEMA RKP
// ============================================================
$('#EditTahunTemaRKP').on('change', function() {
    var tahun = $(this).val();
    if (tahun && tahun.length === 4) {
        // Ambil selected ID yang tersimpan
        var selectedId = $('#EditTemaNasionalId').data('selected') || null;
        $('#EditTemaNasionalId').html('<option value="">Memuat data...</option>');
        loadTemaRKP(tahun, 'EditTemaNasionalId', selectedId);
    } else {
        $('#EditTemaNasionalId').html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
    }
});

    // ============================================================
    // INPUT TEMA
    // ============================================================
    $("#InputTema").click(function() {
    var tahun = $("#Tahun").val().trim();
    
    if (tahun === "" || tahun.length !== 4 || isNaN(tahun)) {
        alert('Tahun harus diisi dengan 4 digit angka (contoh: 2026)!');
        return;
    }
    
    if ($("#TemaNasionalId").val() === "" || $("#TemaNasionalId").val() === null) {
        alert('Tema Nasional harus dipilih!');
        return;
    }
    
    var temaNasionalText = $("#TemaNasionalId option:selected").text();
    var temaRKPId = $("#TemaNasionalId").val();
    
    var Data = {
        Tahun: tahun,
        TemaRKPId: temaRKPId,
        TemaNasionalText: temaNasionalText,
        TemaProvinsi: $("#TemaProvinsi").val().trim(),
        TemaDaerah: $("#TemaDaerah").val().trim(),
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/InputTemaPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#InputTema").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
        }
    });
});

    // ============================================================
// EDIT TEMA - Tampilkan data yang sudah tersimpan
// ============================================================
$(document).on("click", ".EditTema", function() {
    var id = $(this).data('id');
    var tahun = $(this).data('tahun');
    var temaRKPId = $(this).data('tema_rkp_id') || '';
    var temaNasional = $(this).data('tema_nasional');
    var temaProvinsi = $(this).data('tema_provinsi');
    var temaDaerah = $(this).data('tema_daerah');
    
    // Isi field
    $("#EditId").val(id);
    $("#EditTahun").val(tahun);
    $("#EditTemaProvinsi").val(temaProvinsi);
    $("#EditTemaDaerah").val(temaDaerah);
    
    // =============================================
    // SET DROPDOWN TEMA NASIONAL
    // =============================================
    if (temaRKPId) {
        // 1. Cari tahun dari tema_rkp_id
        $.ajax({
            url: BaseURL + "Daerah/GetTemaRKPById",
            type: "POST",
            data: { 
                id: temaRKPId,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.Tahun) {
                    // Set dropdown tahun
                    $('#EditTahunTemaRKP').val(response.Tahun);
                    
                    // Load data Tema RKP berdasarkan tahun
                    loadTemaRKP(response.Tahun, 'EditTemaNasionalId', temaRKPId);
                } else {
                    // Fallback: coba load semua tema
                    $('#EditTemaNasionalId').html('<option value="">-- Pilih Tema Nasional --</option>');
                }
            },
            error: function() {
                // Jika gagal, tampilkan teks tema sebagai info
                $('#EditTemaNasionalId').html('<option value="">-- Error memuat data --</option>');
                alert('Gagal memuat data Tema Nasional. Silakan pilih manual.');
            }
        });
    } else {
        // Tidak ada tema_rkp_id, reset dropdown
        $('#EditTahunTemaRKP').val('');
        $('#EditTemaNasionalId').html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
    }
    
    $('#ModalEditTema').modal("show");
});

// ============================================================
// FUNGSI LOAD TEMA RKP
// ============================================================
function loadTemaRKP(tahun, targetId, selectedId = null) {
    if (!tahun || tahun === '' || tahun.length !== 4) {
        $('#' + targetId).html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        return;
    }
    
    var loadingId = (targetId === 'TemaNasionalId') ? '#tema-rkp-loading' : '#edit-tema-rkp-loading';
    $(loadingId).addClass('active');
    
    $.ajax({
        url: BaseURL + "Daerah/GetTemaRKPByTahun",
        type: "POST",
        data: { 
            tahun: tahun,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
        },
        dataType: 'json',
        success: function(Data) {
            var options = '<option value="">-- Pilih Tema Nasional --</option>';
            
            if (Data && Data.length > 0) {
                for (var i = 0; i < Data.length; i++) {
                    var selected = (selectedId && parseInt(Data[i].Id) === parseInt(selectedId)) ? 'selected' : '';
                    options += '<option value="' + Data[i].Id + '" ' + selected + '>' + Data[i].TemaRKP + '</option>';
                }
            } else {
                options = '<option value="">Tidak ada data Tema RKP untuk tahun ' + tahun + '</option>';
            }
            
            $('#' + targetId).html(options);
            $(loadingId).removeClass('active');
        },
        error: function(xhr) {
            console.error('Error loading Tema RKP:', xhr);
            $('#' + targetId).html('<option value="">Error memuat data</option>');
            $(loadingId).removeClass('active');
        }
    });
}

// ============================================================
// UPDATE TEMA - Pastikan mengirim TemaRKPId
// ============================================================
$("#UpdateTema").click(function() {
    var tahun = $("#EditTahun").val().trim();
    
    if (tahun === "" || tahun.length !== 4 || isNaN(tahun)) {
        alert('Tahun harus diisi dengan 4 digit angka (contoh: 2026)!');
        return;
    }
    
    var temaRKPId = $("#EditTemaNasionalId").val();
    if (!temaRKPId || temaRKPId === "") {
        alert('Tema Nasional harus dipilih!');
        return;
    }
    
    var temaNasionalText = $("#EditTemaNasionalId option:selected").text();
    
    var Data = {
        Id: $("#EditId").val(),
        Tahun: tahun,
        TemaRKPId: temaRKPId,
        TemaNasionalText: temaNasionalText,
        TemaProvinsi: $("#EditTemaProvinsi").val().trim(),
        TemaDaerah: $("#EditTemaDaerah").val().trim(),
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/UpdateTemaPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#UpdateTema").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
        }
    });
});

    // ============================================================
    // GET TEMA RKP BY ID (untuk edit)
    // ============================================================
    $.ajax({
        url: BaseURL + "Daerah/GetTemaRKPById",
        type: "POST",
        data: { 
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
        },
        // Method ini akan dipanggil dari fungsi di atas
    });

    // ============================================================
    // TAMBAH PRIORITAS DARI KOLOM
    // ============================================================
    $(document).on("click", ".tambah-prioritas-kolom", function(e) {
        e.preventDefault();
        var temaId = $(this).data('tema_id');
        var temaNasional = $(this).data('tema_nasional');
        var jenis = $(this).data('jenis');
        var label = $(this).data('label');
        
        var labelJenis = '';
        if (jenis === 'nasional') labelJenis = 'PN - Prioritas Nasional';
        else if (jenis === 'provinsi') labelJenis = 'PP - Prioritas Provinsi';
        else if (jenis === 'daerah') labelJenis = 'PD - Prioritas Daerah';
        
        $("#InputPrioritasTemaIdKolom").val(temaId);
        $("#InputPrioritasJenisKolom").val(jenis);
        $("#InputPrioritasLabelKolom").val(label);
        $("#LabelTemaPrioritasKolom").text(temaNasional);
        $("#TemaInfoKolom").text(temaNasional);
        $("#JenisInfoKolom").text(labelJenis);
        $("#InputPrioritasKolom").val('');
        $("#InputPrioritasRPJMNId").val('');
        
        if (jenis === 'nasional') {
            $('#DropdownRPJMNContainer').show();
            $('#InputManualContainer').hide();
        } else {
            $('#DropdownRPJMNContainer').hide();
            $('#InputManualContainer').show();
        }
        
        $('#ModalInputPrioritasKolom').modal("show");
    });

    // ============================================================
    // SIMPAN PRIORITAS DARI KOLOM
    // ============================================================
    $("#SimpanPrioritasKolom").click(function() {
    var temaId = $("#InputPrioritasTemaIdKolom").val();
    var jenis = $("#InputPrioritasJenisKolom").val();
    var prioritas = '';
    var rpjmnId = '';
    var rpjmnText = '';
    
    if (jenis === 'nasional') {
        rpjmnId = $("#InputPrioritasRPJMNId").val();
        if (!rpjmnId || rpjmnId === "") {
            alert('Pilih Prioritas Nasional RPJMN!');
            return;
        }
        prioritas = $("#InputPrioritasRPJMNId option:selected").text();
        rpjmnText = prioritas;
    } else {
        prioritas = $("#InputPrioritasKolom").val().trim();
        if (prioritas === "") {
            alert('Prioritas harus diisi!');
            return;
        }
    }
    
    if (!temaId || temaId === "") {
        alert('Data tidak valid!');
        return;
    }
    if (!jenis || jenis === "") {
        alert('Jenis prioritas tidak valid!');
        return;
    }
    
    var Data = {
        TemaId: temaId,
        Jenis: jenis,
        Prioritas: prioritas,
        PrioritasNasionalId: rpjmnId || '',
        PrioritasNasionalText: rpjmnText || '',
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/InputPrioritasPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#SimpanPrioritasKolom").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputPrioritasKolom').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputPrioritasKolom').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
        }
    });
});

    // ============================================================
    // EDIT PRIORITAS
    // ============================================================
    $(document).on("click", ".EditPrioritas", function(e) {
        e.stopPropagation();
        var id = $(this).data('id');
        var temaId = $(this).data('tema_id');
        var prioritas = $(this).data('prioritas');
        var jenis = $(this).data('jenis');
        var label = $(this).data('label') || '';
        
        var labelJenis = '';
        if (jenis === 'nasional') labelJenis = 'PN - Prioritas Nasional';
        else if (jenis === 'provinsi') labelJenis = 'PP - Prioritas Provinsi';
        else if (jenis === 'daerah') labelJenis = 'PD - Prioritas Daerah';
        
        var temaNasional = '';
        <?php foreach ($TemaPembangunan as $tema) { ?>
            if (temaId == <?= $tema['id'] ?>) {
                temaNasional = '<?= html_escape($tema['tema_nasional']) ?>';
            }
        <?php } ?>
        
        $("#EditPrioritasId").val(id);
        $("#EditPrioritasTemaId").val(temaId);
        $("#EditPrioritasJenisHidden").val(jenis);
        $("#EditPrioritasLabelHidden").val(label);
        $("#EditPrioritasText").val(prioritas);
        $("#EditTemaInfo").text(temaNasional);
        $("#EditJenisInfo").text(labelJenis);
        
        if (jenis === 'nasional') {
            $('#EditDropdownRPJMNContainer').show();
            $('#EditInputManualContainer').hide();
            var foundId = '';
            <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                if ('<?= html_escape($p['PrioritasNasional']) ?>' === prioritas) {
                    foundId = '<?= $p['Id'] ?>';
                }
            <?php } ?>
            $('#EditPrioritasRPJMNId').val(foundId);
        } else {
            $('#EditDropdownRPJMNContainer').hide();
            $('#EditInputManualContainer').show();
        }
        
        $('#ModalEditPrioritas').modal("show");
    });

    $("#UpdatePrioritas").click(function() {
    var id = $("#EditPrioritasId").val();
    var jenis = $("#EditPrioritasJenisHidden").val();
    var prioritas = '';
    var rpjmnId = '';
    var rpjmnText = '';
    
    if (jenis === 'nasional') {
        rpjmnId = $("#EditPrioritasRPJMNId").val();
        if (!rpjmnId || rpjmnId === "") {
            alert('Pilih Prioritas Nasional RPJMN!');
            return;
        }
        prioritas = $("#EditPrioritasRPJMNId option:selected").text();
        rpjmnText = prioritas;
    } else {
        prioritas = $("#EditPrioritasText").val().trim();
        if (prioritas === "") {
            alert('Prioritas harus diisi!');
            return;
        }
    }
    
    if (!id || id === "") {
        alert('Data tidak valid!');
        return;
    }
    if (!jenis || jenis === "") {
        alert('Jenis prioritas tidak valid!');
        return;
    }
    
    var Data = {
        Id: id,
        Jenis: jenis,
        Prioritas: prioritas,
        PrioritasNasionalId: rpjmnId || '',
        PrioritasNasionalText: rpjmnText || '',
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/UpdatePrioritasPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#UpdatePrioritas").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditPrioritas').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditPrioritas').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
        }
    });
});

    // ============================================================
    // HAPUS PRIORITAS
    // ============================================================
    $(document).on("click", ".HapusPrioritas", function(e) {
    e.stopPropagation();
    if (confirm("Apakah Anda yakin ingin menghapus prioritas ini?")) {
        var id = $(this).data('id');
        var btn = $(this);
        
        $.ajax({
            url: BaseURL + "Daerah/DeletePrioritasPembangunan",
            type: "POST",
            data: { 
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            beforeSend: function() {
                btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-close"></i>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-close"></i>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                btn.prop('disabled', false).html('<i class="notika-icon notika-close"></i>');
            }
        });
    }
});


    // ============================================================
    // HAPUS TEMA
    // ============================================================
    $(document).on("click", ".HapusTema", function() {
    if (confirm("Apakah Anda yakin ingin menghapus tema ini beserta semua prioritasnya?")) {
        var id = $(this).data('id');
        var btn = $(this);
        
        $.ajax({
            url: BaseURL + "Daerah/DeleteTemaPembangunan",
            type: "POST",
            data: { 
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            beforeSend: function() {
                btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        // LANGSUNG REFRESH - TANPA ALERT
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

    // ============================================================
    // RESET FORM SAAT MODAL DITUTUP
    // ============================================================
    $('#ModalInputTema').on('hidden.bs.modal', function() {
        $("#Tahun").val('');
        $("#TahunTemaRKP").val('');
        $("#TemaNasionalId").html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        $("#TemaProvinsi").val('');
        $("#TemaDaerah").val('');
        $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
        $('#tema-rkp-loading').removeClass('active');
    });

    $('#ModalEditTema').on('hidden.bs.modal', function() {
        $("#EditId").val('');
        $("#EditTahun").val('');
        $("#EditTahunTemaRKP").val('');
        $("#EditTemaNasionalId").html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        $("#EditTemaNasionalId").data('selected', '');
        $("#EditTemaProvinsi").val('');
        $("#EditTemaDaerah").val('');
        $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
        $('#edit-tema-rkp-loading').removeClass('active');
    });

    $('#ModalInputPrioritasKolom').on('hidden.bs.modal', function() {
        $("#InputPrioritasTemaIdKolom").val('');
        $("#InputPrioritasJenisKolom").val('');
        $("#InputPrioritasLabelKolom").val('');
        $("#InputPrioritasKolom").val('');
        $("#InputPrioritasRPJMNId").val('');
        $("#LabelTemaPrioritasKolom").text('');
        $("#TemaInfoKolom").text('');
        $("#JenisInfoKolom").text('');
        $('#DropdownRPJMNContainer').hide();
        $('#InputManualContainer').show();
        $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
    });

    $('#ModalEditPrioritas').on('hidden.bs.modal', function() {
        $("#EditPrioritasId").val('');
        $("#EditPrioritasTemaId").val('');
        $("#EditPrioritasJenisHidden").val('');
        $("#EditPrioritasLabelHidden").val('');
        $("#EditPrioritasText").val('');
        $("#EditPrioritasRPJMNId").val('');
        $("#EditTemaInfo").text('');
        $("#EditJenisInfo").text('');
        $('#EditDropdownRPJMNContainer').hide();
        $('#EditInputManualContainer').show();
        $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
    });

    // ============================================================
    // CLEAN MODAL BACKDROP
    // ============================================================
    $(document).on("hidden.bs.modal", ".modal", function() {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

});
</script>