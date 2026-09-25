<?php
$userLevel = $_SESSION['Level'] ?? ($this->session->userdata('Level') ?? null);
$isLoggedIn = !empty($_SESSION['isLoggedIn']) || !empty($this->session->userdata('isLoggedIn'));
$canEdit = $isLoggedIn && ($userLevel !== null && $userLevel !== '' && (string)$userLevel === '0');
?>
<style>
    /* CSS untuk membuat Modal persis di tengah (Vertical Center) */
    .modal {
        text-align: center;
        padding: 0!important;
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
        width: 600px; 
        max-width: 95%; 
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement */
    #hierarki-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #hierarki-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    /* Efek hover baris tabel hierarki */
    #hierarki-table > tbody > tr {
        transition: filter 0.2s ease;
    }
    #hierarki-table > tbody > tr:hover {
        filter: brightness(0.96);
    }

    /* CSS Button & Badge Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0;
        transition: all 0.3s ease;
        padding: 5px 10px;
        font-weight: 600;
        white-space: nowrap;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .badge-periode {
        background-color: #00c292;
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 194, 146, 0.3);
    }
    .badge-baseline {
        background-color: #f0f4f8;
        color: #334155;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-block;
        border: 1px solid #cbd5e1;
        font-size: 12px;
    }
    .badge-target {
        background-color: #ecfdf5;
        color: #065f46;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-block;
        border: 1px solid #a7f3d0;
        font-size: 12px;
    }
    .btn-action-group {
        display: inline-flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        flex-wrap: nowrap;
    }
    .td-aksi {
        white-space: nowrap !important;
        vertical-align: middle !important;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Visi Pembangunan RPJPN</h3>
                        <?php if ($canEdit) { ?>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Visi -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputVisi" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Visi RPJPN</b>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 4%;" class="text-center">No</th>
                                    <th style="width: 42%;">Uraian (Visi / Sasaran / Indikator)</th>
                                    <th style="width: 10%;" class="text-center">Periode</th>
                                    <th style="width: 12%;" class="text-center">2025 (Baseline)</th>
                                    <th style="width: 12%;" class="text-center">2045 (Target)</th>
                                    <?php if ($canEdit) { ?>
                                    <th style="width: 20%; white-space: nowrap;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                /* LOGIKA FOREACH DENGAN LEVEL: VISI -> SASARAN -> INDIKATOR */
                                if(isset($DataVisi) && count($DataVisi) > 0) {
                                    $noVisi = 1;
                                    foreach ($DataVisi as $visi) { 
                                ?>
                                    <!-- LEVEL 1: VISI -->
                                    <tr data-id="visi-<?= $visi['Id'] ?>" data-parent="" data-expanded="false" style="background-color: #f1f8e9;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $noVisi ?></b></td>
                                        <td style="cursor: pointer; font-size: 14px; border-left: 3px solid #8bc34a;" onclick="toggleLevel('visi-<?= $visi['Id'] ?>', this)">
                                            <b>VISI:</b> <?= $visi['Visi'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $visi['Periode'] ?></span>
                                        </td>
                                        <td class="text-center"><span class="text-muted">-</span></td>
                                        <td class="text-center"><span class="text-muted">-</span></td>
                                        <?php if ($canEdit) { ?>
                                        <td class="text-center td-aksi">
                                            <div class="btn-action-group">
                                                <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $visi['Id'] ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                <button class="btn btn-sm btn-info EditVisi btn-action" data-id="<?= $visi['Id'] ?>" data-visi="<?= htmlspecialchars($visi['Visi'], ENT_QUOTES) ?>" data-awal="<?= $visi['TahunMulai'] ?>" data-akhir="<?= $visi['TahunAkhir'] ?>" title="Edit Visi"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger HapusVisi btn-action" data-id="<?= $visi['Id'] ?>" title="Hapus Visi"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <?php 
                                    // Pengecekan Sasaran berdasarkan Visi ini
                                    if(isset($visi['Sasaran'])) {
                                        $noSasaran = 1;
                                        foreach ($visi['Sasaran'] as $sasaran) { 
                                    ?>
                                        <!-- LEVEL 2: SASARAN -->
                                        <tr data-id="sasaran-<?= $sasaran['Id'] ?>" data-parent="visi-<?= $visi['Id'] ?>" data-expanded="false" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td style="padding-left: 30px; cursor: pointer; border-left: 3px solid #00bcd4;" onclick="toggleLevel('sasaran-<?= $sasaran['Id'] ?>', this)">
                                                <b style="color: #00838f;">SASARAN <?= $noSasaran ?>:</b> <?= $sasaran['Sasaran'] ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-periode" style="background-color: #00bcd4; box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);"><?= $sasaran['Periode'] ?></span>
                                            </td>
                                            <td class="text-center"><span class="text-muted">-</span></td>
                                            <td class="text-center"><span class="text-muted">-</span></td>
                                            <?php if ($canEdit) { ?>
                                            <td class="text-center td-aksi">
                                                <div class="btn-action-group">
                                                    <button class="btn btn-sm btn-success TambahIndikator btn-action" data-id="<?= $sasaran['Id'] ?>" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                    <button class="btn btn-sm btn-info EditSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" data-idvisi="<?= $visi['Id'] ?>" data-sasaran="<?= htmlspecialchars($sasaran['Sasaran'], ENT_QUOTES) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php 
                                        // Pengecekan Indikator berdasarkan Sasaran ini
                                        if(isset($sasaran['Indikator'])) {
                                            $noIndikator = 1;
                                            foreach ($sasaran['Indikator'] as $ind) { 
                                        ?>
                                            <!-- LEVEL 3: INDIKATOR -->
                                            <tr data-id="indikator-<?= $ind['Id'] ?>" data-parent="sasaran-<?= $sasaran['Id'] ?>" data-expanded="false" style="display: none; background-color: #ffffff;">
                                                <td></td>
                                                <td style="padding-left: 60px; border-left: 3px solid #ff9800;">
                                                    <b style="color: #ef6c00;">INDIKATOR <?= $noSasaran . '.' . $noIndikator ?>:</b> <?= $ind['Indikator'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode" style="background-color: #ff9800; box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);"><?= $ind['Periode'] ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-baseline"><?= (!empty($ind['Baseline']) ? $ind['Baseline'] : '-') ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-target"><?= (!empty($ind['Target']) ? $ind['Target'] : '-') ?></span>
                                                </td>
                                                <?php if ($canEdit) { ?>
                                                <td class="text-center td-aksi">
                                                    <div class="btn-action-group">
                                                        <button class="btn btn-sm btn-info EditIndikator btn-action" data-id="<?= $ind['Id'] ?>" data-idsasaran="<?= $sasaran['Id'] ?>" data-indikator="<?= htmlspecialchars($ind['Indikator'], ENT_QUOTES) ?>" data-baseline="<?= htmlspecialchars($ind['Baseline'], ENT_QUOTES) ?>" data-target="<?= htmlspecialchars($ind['Target'], ENT_QUOTES) ?>" title="Edit Indikator"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger HapusIndikator btn-action" data-id="<?= $ind['Id'] ?>" title="Hapus Indikator"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php 
                                                $noIndikator++;
                                            } // End Indikator
                                        } 
                                        ?>

                                    <?php 
                                            $noSasaran++;
                                        } // End Sasaran
                                    } 
                                    ?>
                                <?php 
                                        $noVisi++;
                                    } // End Visi
                                } else { ?>
                                    <tr>
                                        <td colspan="<?= $canEdit ? '6' : '5' ?>" class="text-center" style="padding: 30px; color: #999;">Belum ada data Visi RPJPN.</td>
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

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT VISI -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputVisi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Visi RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="number" class="form-control" id="TahunMulai" placeholder="Tahun Mulai (YYYY)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="number" class="form-control" id="TahunAkhir" placeholder="Tahun Akhir (YYYY)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanVisi"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditVisi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Visi RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdVisiForm">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="number" class="form-control" id="_TahunMulai" placeholder="Tahun Mulai (YYYY)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="number" class="form-control" id="_TahunAkhir" placeholder="Tahun Akhir (YYYY)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnVisi"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT SASARAN -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSasaran" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Sasaran RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdVisiSasaran">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanSasaran"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditSasaran" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Sasaran RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdSasaranForm">
                <input type="hidden" id="_IdVisi">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnSasaran"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT INDIKATOR -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputIndikator" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Indikator Sasaran RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdSasaranIndikator">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Indikator" rows="3" style="resize: vertical;" placeholder="Uraian Indikator Sasaran RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Baseline" placeholder="2025 (Baseline)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-flag"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Target" placeholder="2045 (Target)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanIndikator"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditIndikator" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Indikator Sasaran RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdIndikatorForm">
                <input type="hidden" id="_IdSasaran">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Indikator" rows="3" style="resize: vertical;" placeholder="Uraian Indikator Sasaran RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Baseline" placeholder="2025 (Baseline)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-flag"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Target" placeholder="2045 (Target)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnIndikator"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery-price-slider.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.scrollUp.min.js"></script>
<script src="../js/meanmenu/jquery.meanmenu.js"></script>
<script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>
<script>
    // JS Logic untuk Toggle Hierarki Tabel dengan klik text
    function toggleLevel(parentId, element) {
        var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        var parentTr = element.closest('tr');
        
        var isExpanded = parentTr.getAttribute('data-expanded') === 'true';

        if (isExpanded) {
            // Tutup (Collapse)
            parentTr.setAttribute('data-expanded', 'false');
            hideAllChildren(parentId);
        } else {
            // Buka (Expand)
            parentTr.setAttribute('data-expanded', 'true');
            trs.forEach(function(tr) {
                tr.style.display = 'table-row';
            });
        }
        
        saveExpandedState();
    }

    // Fungsi untuk menyembunyikan semua turunan di bawahnya secara rekursif
    function hideAllChildren(parentId) {
        var children = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        
        children.forEach(function(child) {
            child.style.display = 'none';
            child.setAttribute('data-expanded', 'false');
            var childId = child.getAttribute('data-id');
            hideAllChildren(childId);
        });
    }

    // Simpan state dengan memindai atribut data-expanded
    function saveExpandedState() {
        var expanded = [];
        document.querySelectorAll('tr[data-expanded="true"]').forEach(function(tr) {
            expanded.push(tr.getAttribute('data-id'));
        });
        sessionStorage.setItem('expandedRowsRPJPN', JSON.stringify(expanded));
    }

    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>';

        // Restore State dari Session
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRowsRPJPN')) || [];
        
        document.querySelectorAll('#hierarki-table tbody tr').forEach(function(tr) {
            var id = tr.getAttribute('data-id');
            if (expandedRows.includes(id)) {
                tr.setAttribute('data-expanded', 'true');
                var trs = document.querySelectorAll('tr[data-parent="' + id + '"]');
                trs.forEach(function(childTr) {
                    childTr.style.display = 'table-row';
                });
            }
        });
        saveExpandedState();

        // Trigger Modal Tambah Sasaran
        $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
            var parentRow = $(this).closest('tr')[0];
            
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            var idVisi = $(this).data('id');
            $('#IdVisiSasaran').val(idVisi);
            $('#Sasaran').val('');
            $('#ModalInputSasaran').modal('show');
        });

        // Trigger Modal Tambah Indikator
        $('#hierarki-table tbody').on('click', '.TambahIndikator', function() {
            var parentRow = $(this).closest('tr')[0];
            
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            var idSasaran = $(this).data('id');
            $('#IdSasaranIndikator').val(idSasaran);
            $('#Indikator').val('');
            $('#Baseline').val('');
            $('#Target').val('');
            $('#ModalInputIndikator').modal('show');
        });

        // ==============================================
        // SCRIPT VISI
        // ==============================================
        $("#SimpanVisi").click(function() {
            if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() == "" || $("#TahunMulai").val().length != 4) {
                alert('Input Tahun Mulai Belum Benar!');
            } else if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() == "" || $("#TahunAkhir").val().length != 4) {
                alert('Input Tahun Akhir Belum Benar!');
            } else if ($("#Visi").val() == "") {
                alert('Input Visi Belum Benar!');
            } else {
                var Visi = { 
                    Visi       : $("#Visi").val(),
                    TahunMulai : $("#TahunMulai").val(),
                    TahunAkhir : $("#TahunAkhir").val() 
                };
                $.post(BaseURL+"Nasional/InputVisiRPJPN", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditVisi', function () {
            $("#IdVisiForm").val($(this).data('id'));
            $("#_Visi").val($(this).data('visi'));
            $("#_TahunMulai").val($(this).data('awal'));
            $("#_TahunAkhir").val($(this).data('akhir'));
            $('#ModalEditVisi').modal("show");
        });

        $("#EditBtnVisi").click(function() {
            if (isNaN($("#_TahunMulai").val()) || $("#_TahunMulai").val() == "" || $("#_TahunMulai").val().length != 4) {
                alert('Input Tahun Mulai Belum Benar!');
            } else if (isNaN($("#_TahunAkhir").val()) || $("#_TahunAkhir").val() == "" || $("#_TahunAkhir").val().length != 4) {
                alert('Input Tahun Akhir Belum Benar!');
            } else if ($("#_Visi").val() == "") {
                alert('Input Visi Belum Benar!');
            } else {
                var Visi = { 
                    Id         : $("#IdVisiForm").val(),
                    Visi       : $("#_Visi").val(),
                    TahunMulai : $("#_TahunMulai").val(),
                    TahunAkhir : $("#_TahunAkhir").val() 
                };
                $.post(BaseURL+"Nasional/EditVisiRPJPN", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusVisi', function () {
            if(confirm("Yakin ingin menghapus Visi ini? Seluruh Sasaran dan Indikator dibawahnya akan ikut terhapus.")) {
                var Visi = { Id: $(this).data('id') };
                $.post(BaseURL+"Nasional/HapusVisiRPJPN", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });
            }
        });

        // ==============================================
        // SCRIPT SASARAN
        // ==============================================
        $("#SimpanSasaran").click(function() {
            if ($("#Sasaran").val().trim() == "") {
                alert('Input Sasaran Belum Benar!');
            } else {
                var Sasaran = { 
                    _Id      : $("#IdVisiSasaran").val(),
                    Sasaran  : $("#Sasaran").val() 
                };
                $.post(BaseURL+"Nasional/InputSasaranRPJPN", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditSasaran', function () {
            $("#IdSasaranForm").val($(this).data('id'));
            $("#_IdVisi").val($(this).data('idvisi'));
            $("#_Sasaran").val($(this).data('sasaran'));
            $('#ModalEditSasaran').modal("show");
        });

        $("#EditBtnSasaran").click(function() {
            if ($("#_Sasaran").val().trim() == "") {
                alert('Input Sasaran Belum Benar!');
            } else {
                var Sasaran = { 
                    Id       : $("#IdSasaranForm").val(),
                    _Id      : $("#_IdVisi").val(),
                    Sasaran  : $("#_Sasaran").val() 
                };
                $.post(BaseURL+"Nasional/EditSasaranRPJPN", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusSasaran', function () {
            if(confirm("Yakin ingin menghapus Sasaran ini? Seluruh Indikator dibawahnya akan ikut terhapus.")) {
                var Sasaran = { Id: $(this).data('id') };
                $.post(BaseURL+"Nasional/HapusSasaranRPJPN", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });
            }
        });

        // ==============================================
        // SCRIPT INDIKATOR
        // ==============================================
        $("#SimpanIndikator").click(function() {
            if ($("#Indikator").val().trim() == "") {
                alert('Input Indikator Belum Benar!');
            } else {
                var IndikatorData = { 
                    _Id       : $("#IdSasaranIndikator").val(),
                    Indikator : $("#Indikator").val(),
                    Baseline  : $("#Baseline").val(),
                    Target    : $("#Target").val()
                };
                $.post(BaseURL+"Nasional/InputIndikatorRPJPN", IndikatorData).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditIndikator', function () {
            $("#IdIndikatorForm").val($(this).data('id'));
            $("#_IdSasaran").val($(this).data('idsasaran'));
            $("#_Indikator").val($(this).data('indikator'));
            $("#_Baseline").val($(this).data('baseline'));
            $("#_Target").val($(this).data('target'));
            $('#ModalEditIndikator').modal("show");
        });

        $("#EditBtnIndikator").click(function() {
            if ($("#_Indikator").val().trim() == "") {
                alert('Input Indikator Belum Benar!');
            } else {
                var IndikatorData = { 
                    Id        : $("#IdIndikatorForm").val(),
                    _Id       : $("#_IdSasaran").val(),
                    Indikator : $("#_Indikator").val(),
                    Baseline  : $("#_Baseline").val(),
                    Target    : $("#_Target").val()
                };
                $.post(BaseURL+"Nasional/EditIndikatorRPJPN", IndikatorData).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusIndikator', function () {
            if(confirm("Yakin ingin menghapus Indikator ini?")) {
                var IndikatorData = { Id: $(this).data('id') };
                $.post(BaseURL+"Nasional/HapusIndikatorRPJPN", IndikatorData).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });
            }
        });
    });
</script>