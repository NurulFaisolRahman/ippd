<style>
    /* CSS untuk Modal Vertical Center */
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
        font-size: 11px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #hierarki-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
        font-size: 13px;
    }
    
    #hierarki-table > tbody > tr {
        transition: filter 0.2s ease;
    }
    #hierarki-table > tbody > tr:hover {
        filter: brightness(0.96); 
    }

    /* ============ CSS BUTTON DROPDOWN TITIK TIGA (SMOOTH) ============ */
    .btn-action-dropdown {
        position: relative;
        display: inline-block;
    }
    
    .btn-action-dropdown .dropdown-toggle-btn {
        background: transparent;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        cursor: pointer;
        color: #718096;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 18px;
        line-height: 1;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }
    .btn-action-dropdown .dropdown-toggle-btn:hover {
        background: #edf2f7;
        color: #2d3748;
        transform: scale(1.05);
    }
    .btn-action-dropdown .dropdown-toggle-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
    }
    
    .btn-action-dropdown .dropdown-menu-custom {
        position: absolute;
        right: 0;
        top: calc(100% + 4px);
        min-width: 190px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.04);
        padding: 6px 0;
        z-index: 1000;
        text-align: left;
        
        /* Smooth animation */
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px) scale(0.96);
        transform-origin: top right;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        will-change: transform, opacity;
    }
    
    .btn-action-dropdown .dropdown-menu-custom.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }
    
    .btn-action-dropdown .dropdown-item-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 9px 18px;
        color: #2d3748;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.15s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        position: relative;
        white-space: nowrap;
    }
    
    .btn-action-dropdown .dropdown-item-custom:hover {
        background: #f7fafc;
        color: #1a2332;
    }
    
    .btn-action-dropdown .dropdown-item-custom:active {
        transform: scale(0.98);
    }
    
    .btn-action-dropdown .dropdown-item-custom i {
        width: 20px;
        font-size: 14px;
        color: #718096;
        text-align: center;
        flex-shrink: 0;
    }
    
    .btn-action-dropdown .dropdown-item-custom .menu-label {
        flex: 1;
    }
    
    .btn-action-dropdown .dropdown-item-custom .shortcut-hint {
        font-size: 10px;
        color: #a0aec0;
        margin-left: 8px;
    }
    
    .btn-action-dropdown .dropdown-item-custom.text-danger {
        color: #dc3545;
    }
    .btn-action-dropdown .dropdown-item-custom.text-danger i {
        color: #dc3545;
    }
    .btn-action-dropdown .dropdown-item-custom.text-danger:hover {
        background: #fef2f2;
    }
    .btn-action-dropdown .dropdown-item-custom.text-success {
        color: #00a65a;
    }
    .btn-action-dropdown .dropdown-item-custom.text-success i {
        color: #00a65a;
    }
    .btn-action-dropdown .dropdown-item-custom.text-success:hover {
        background: #f0fdf4;
    }
    .btn-action-dropdown .dropdown-item-custom.text-info {
        color: #0284c7;
    }
    .btn-action-dropdown .dropdown-item-custom.text-info i {
        color: #0284c7;
    }
    .btn-action-dropdown .dropdown-item-custom.text-info:hover {
        background: #f0f9ff;
    }
    
    .btn-action-dropdown .dropdown-divider-custom {
        height: 1px;
        background: #edf2f7;
        margin: 4px 12px;
    }

    /* Overlay untuk menangkap klik di luar */
    .dropdown-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
        display: none;
    }
    .dropdown-backdrop.active {
        display: block;
    }
    /* ======================================================== */

    /* CSS Button & Badge Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 5px 10px;
        font-weight: 600;
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

    /* Warna penanda level hierarki */
    .border-visi { border-left: 4px solid #8bc34a !important; }
    .border-misi { border-left: 4px solid #00bcd4 !important; }
    .border-tujuan { border-left: 4px solid #ff9800 !important; }
    .border-sasaran { border-left: 4px solid #9e9e9e !important; }

    /* Responsive */
    @media (max-width: 768px) {
        .btn-action-dropdown .dropdown-menu-custom {
            right: -10px;
            min-width: 170px;
        }
        #hierarki-table > tbody > tr > td {
            padding: 8px 6px;
            font-size: 12px;
        }
        .btn-action-dropdown .dropdown-item-custom {
            padding: 8px 14px;
            font-size: 12px;
        }
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Hierarki Visi Hingga Sasaran RPJPN</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Visi tetap di atas sebagai level tertinggi -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputVisi" style="padding: 8px 15px; font-size: 13px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Visi RPJPN</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 55%;">Uraian (Visi / Misi / Tujuan / Sasaran)</th>
                                    <th style="width: 15%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 25%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($DataVisi) && count($DataVisi) > 0) {
                                    $noVisi = 1;
                                    foreach ($DataVisi as $visi) { 
                                ?>
                                    <!-- LEVEL 1: VISI -->
                                    <tr data-id="visi-<?= $visi['Id'] ?>" data-parent="" data-expanded="false" style="background-color: #f1f8e9;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $noVisi ?></b></td>
                                        <td style="cursor: pointer; font-size: 14px;" class="border-visi" onclick="toggleLevel('visi-<?= $visi['Id'] ?>', this)">
                                            <b>VISI:</b> <?= $visi['Visi'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $visi['Periode'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <div class="btn-action-dropdown">
                                                <button class="dropdown-toggle-btn" onclick="event.stopPropagation(); toggleDropdown(this);">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu-custom">
                                                    <button class="dropdown-item-custom text-success TambahMisi" data-id="<?= $visi['Id'] ?>">
                                                        <i class="fa fa-plus-circle"></i>
                                                        <span class="menu-label">Tambah Misi</span>
                                                    </button>
                                                    <div class="dropdown-divider-custom"></div>
                                                    <button class="dropdown-item-custom text-info EditVisi" data-id="<?= $visi['Id'] ?>" data-visi="<?= $visi['Visi'] ?>" data-awal="<?= $visi['TahunMulai'] ?>" data-akhir="<?= $visi['TahunAkhir'] ?>">
                                                        <i class="fa fa-pencil"></i>
                                                        <span class="menu-label">Edit Visi</span>
                                                    </button>
                                                    <button class="dropdown-item-custom text-danger HapusVisi" data-id="<?= $visi['Id'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                        <span class="menu-label">Hapus Visi</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <?php 
                                    if(isset($visi['Misi'])) {
                                        $noMisi = 1;
                                        foreach ($visi['Misi'] as $misi) { 
                                    ?>
                                        <!-- LEVEL 2: MISI -->
                                        <tr data-id="misi-<?= $misi['Id'] ?>" data-parent="visi-<?= $visi['Id'] ?>" data-expanded="false" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td style="padding-left: 30px; cursor: pointer;" class="border-misi" onclick="toggleLevel('misi-<?= $misi['Id'] ?>', this)">
                                                <b style="color: #00838f;">MISI <?= $noMisi ?>:</b> <?= $misi['Misi'] ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-periode" style="background-color: #00bcd4; box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);"><?= $misi['Periode'] ?></span>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                            <td class="text-center">
                                                <div class="btn-action-dropdown">
                                                    <button class="dropdown-toggle-btn" onclick="event.stopPropagation(); toggleDropdown(this);">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu-custom">
                                                        <button class="dropdown-item-custom text-success TambahTujuan" data-id="<?= $misi['Id'] ?>">
                                                            <i class="fa fa-plus-circle"></i>
                                                            <span class="menu-label">Tambah Tujuan</span>
                                                        </button>
                                                        <div class="dropdown-divider-custom"></div>
                                                        <button class="dropdown-item-custom text-info EditMisi" data-id="<?= $misi['Id'] ?>" data-idvisi="<?= $visi['Id'] ?>" data-misi="<?= $misi['Misi'] ?>">
                                                            <i class="fa fa-pencil"></i>
                                                            <span class="menu-label">Edit Misi</span>
                                                        </button>
                                                        <button class="dropdown-item-custom text-danger HapusMisi" data-id="<?= $misi['Id'] ?>">
                                                            <i class="fa fa-trash"></i>
                                                            <span class="menu-label">Hapus Misi</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php 
                                        if(isset($misi['Tujuan'])) {
                                            $noTujuan = 1;
                                            foreach ($misi['Tujuan'] as $tujuan) { 
                                        ?>
                                            <!-- LEVEL 3: TUJUAN -->
                                            <tr data-id="tujuan-<?= $tujuan['Id'] ?>" data-parent="misi-<?= $misi['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff3e0;">
                                                <td></td>
                                                <td style="padding-left: 60px; cursor: pointer;" class="border-tujuan" onclick="toggleLevel('tujuan-<?= $tujuan['Id'] ?>', this)">
                                                    <b style="color: #ef6c00;">TUJUAN <?= $noMisi . '.' . $noTujuan ?>:</b> <?= $tujuan['Tujuan'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode" style="background-color: #ff9800; box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);"><?= $tujuan['Periode'] ?></span>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                <td class="text-center">
                                                    <div class="btn-action-dropdown">
                                                        <button class="dropdown-toggle-btn" onclick="event.stopPropagation(); toggleDropdown(this);">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu-custom">
                                                            <button class="dropdown-item-custom text-success TambahSasaran" data-id="<?= $tujuan['Id'] ?>">
                                                                <i class="fa fa-plus-circle"></i>
                                                                <span class="menu-label">Tambah Sasaran</span>
                                                            </button>
                                                            <div class="dropdown-divider-custom"></div>
                                                            <button class="dropdown-item-custom text-info EditTujuan" data-id="<?= $tujuan['Id'] ?>" data-idmisi="<?= $misi['Id'] ?>" data-tujuan="<?= $tujuan['Tujuan'] ?>">
                                                                <i class="fa fa-pencil"></i>
                                                                <span class="menu-label">Edit Tujuan</span>
                                                            </button>
                                                            <button class="dropdown-item-custom text-danger HapusTujuan" data-id="<?= $tujuan['Id'] ?>">
                                                                <i class="fa fa-trash"></i>
                                                                <span class="menu-label">Hapus Tujuan</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                            <?php 
                                            if(isset($tujuan['Sasaran'])) {
                                                $noSasaran = 1;
                                                foreach ($tujuan['Sasaran'] as $sasaran) { 
                                            ?>
                                                <!-- LEVEL 4: SASARAN -->
                                                <tr data-id="sasaran-<?= $sasaran['Id'] ?>" data-parent="tujuan-<?= $tujuan['Id'] ?>" data-expanded="false" style="display: none; background-color: #ffffff;">
                                                    <td></td>
                                                    <td style="padding-left: 90px;" class="border-sasaran">
                                                        <b style="color: #616161;">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?>:</b> <?= $sasaran['Sasaran'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge-periode" style="background-color: #9e9e9e; box-shadow: 0 2px 5px rgba(158, 158, 158, 0.3);"><?= $sasaran['Periode'] ?></span>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                    <td class="text-center">
                                                        <div class="btn-action-dropdown">
                                                            <button class="dropdown-toggle-btn" onclick="event.stopPropagation(); toggleDropdown(this);">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu-custom">
                                                                <button class="dropdown-item-custom text-info EditSasaran" data-id="<?= $sasaran['Id'] ?>" data-idtujuan="<?= $tujuan['Id'] ?>" data-sasaran="<?= $sasaran['Sasaran'] ?>">
                                                                    <i class="fa fa-pencil"></i>
                                                                    <span class="menu-label">Edit Sasaran</span>
                                                                </button>
                                                                <button class="dropdown-item-custom text-danger HapusSasaran" data-id="<?= $sasaran['Id'] ?>">
                                                                    <i class="fa fa-trash"></i>
                                                                    <span class="menu-label">Hapus Sasaran</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php 
                                                    $noSasaran++;
                                                }
                                            } 
                                            ?>

                                        <?php 
                                                $noTujuan++;
                                            }
                                        } 
                                        ?>

                                    <?php 
                                            $noMisi++;
                                        }
                                    } 
                                    ?>
                                <?php 
                                        $noVisi++;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Visi RPJPN.</td>
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
<!-- MODAL INPUT & EDIT MISI -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputMisi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Misi RPJPN</h2>
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
                                <textarea class="form-control" id="Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanMisi"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditMisi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Misi RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdMisiForm">
                <input type="hidden" id="_IdVisi">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnMisi"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT TUJUAN -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputTujuan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Tujuan RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdMisiForm">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanTujuan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditTujuan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Tujuan RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdTujuanForm">
                <input type="hidden" id="_IdMisi">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnTujuan"><i class="fa fa-save"></i> Update</button>
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
                <input type="hidden" id="IdTujuanForm">
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
                <input type="hidden" id="_IdTujuan">
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
    // ==============================================
    // JS LOGIC TOGGLE HIERARKI
    // ==============================================
    function toggleLevel(parentId, element) {
        var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        var parentTr = element.closest('tr');
        var isExpanded = parentTr.getAttribute('data-expanded') === 'true';

        if (isExpanded) {
            parentTr.setAttribute('data-expanded', 'false');
            hideAllChildren(parentId);
        } else {
            parentTr.setAttribute('data-expanded', 'true');
            trs.forEach(function(tr) {
                tr.style.display = 'table-row';
            });
        }
        saveExpandedState();
    }

    function hideAllChildren(parentId) {
        var children = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        children.forEach(function(child) {
            child.style.display = 'none';
            child.setAttribute('data-expanded', 'false'); 
            var childId = child.getAttribute('data-id');
            hideAllChildren(childId); 
        });
    }

    function saveExpandedState() {
        var expanded = [];
        document.querySelectorAll('tr[data-expanded="true"]').forEach(function(tr) {
            expanded.push(tr.getAttribute('data-id'));
        });
        sessionStorage.setItem('expandedRows', JSON.stringify(expanded));
    }

    // ==============================================
    // JS LOGIC DROPDOWN - SMOOTH & GLITCH-FREE
    // ==============================================
    function toggleDropdown(button) {
        var dropdown = button.closest('.btn-action-dropdown');
        var menu = dropdown.querySelector('.dropdown-menu-custom');
        
        // Cek apakah dropdown sedang terbuka
        var isOpen = menu.classList.contains('show');
        
        // Tutup semua dropdown yang terbuka
        document.querySelectorAll('.dropdown-menu-custom.show').forEach(function(m) {
            if (m !== menu) {
                m.classList.remove('show');
            }
        });
        
        // Tutup backdrop
        var backdrop = document.querySelector('.dropdown-backdrop');
        if (backdrop) {
            backdrop.classList.remove('active');
        }
        
        // Toggle dropdown saat ini
        if (isOpen) {
            menu.classList.remove('show');
        } else {
            menu.classList.add('show');
            // Buat backdrop untuk menangkap klik di luar
            if (!backdrop) {
                backdrop = document.createElement('div');
                backdrop.className = 'dropdown-backdrop';
                document.body.appendChild(backdrop);
            }
            backdrop.classList.add('active');
        }
    }

    // Event handler untuk menutup dropdown saat klik di luar
    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu-custom.show').forEach(function(menu) {
            menu.classList.remove('show');
        });
        var backdrop = document.querySelector('.dropdown-backdrop');
        if (backdrop) {
            backdrop.classList.remove('active');
        }
    }

    // Klik backdrop untuk menutup dropdown
    $(document).on('click', '.dropdown-backdrop', function() {
        closeAllDropdowns();
    });

    // Tutup dropdown saat scroll
    $(document).on('scroll', function() {
        closeAllDropdowns();
    });

    // ==============================================
    // INITIALIZATION
    // ==============================================
    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>';

        // Restore State Hierarki
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRows')) || [];
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

        // ==============================================
        // SCRIPT VISI
        // ==============================================
        $("#SimpanVisi").click(function() {
            if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() == "" || $("#TahunMulai").val().length != 4) {
                alert('Input Tahun Mulai Belum Benar!')
            } else if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() == "" || $("#TahunAkhir").val().length != 4) {
                alert('Input Tahun Akhir Belum Benar!')
            } else if ($("#Visi").val() == "") {
                alert('Input Visi Belum Benar!')
            } else {
                var Visi = { Visi       : $("#Visi").val(),
                             TahunMulai : $("#TahunMulai").val(),
                             TahunAkhir : $("#TahunAkhir").val() }
                $.post(BaseURL+"Nasional/InputVisiRPJPN", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditVisi', function () {
            $("#IdVisiForm").val($(this).data('id'));
            $("#_Visi").val($(this).data('visi'));
            $("#_TahunMulai").val($(this).data('awal'));
            $("#_TahunAkhir").val($(this).data('akhir'));
            $('#ModalEditVisi').modal("show");
            closeAllDropdowns();
        });

        $("#EditBtnVisi").click(function() {
            if (isNaN($("#_TahunMulai").val()) || $("#_TahunMulai").val() == "" || $("#_TahunMulai").val().length != 4) {
                alert('Input Tahun Mulai Belum Benar!')
            } else if (isNaN($("#_TahunAkhir").val()) || $("#_TahunAkhir").val() == "" || $("#_TahunAkhir").val().length != 4) {
                alert('Input Tahun Akhir Belum Benar!')
            } else if ($("#_Visi").val() == "") {
                alert('Input Visi Belum Benar!')
            } else {
                var Visi = { Id         : $("#IdVisiForm").val(),
                             Visi       : $("#_Visi").val(),
                             TahunMulai : $("#_TahunMulai").val(),
                             TahunAkhir : $("#_TahunAkhir").val() }
                $.post(BaseURL+"Nasional/EditVisiRPJPN", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusVisi', function () {
            if(confirm("Yakin ingin menghapus Visi ini? Seluruh sub-data dibawahnya mungkin akan ikut terhapus.")) {
                var Visi = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusVisiRPJPN", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
            closeAllDropdowns();
        });

        // ==============================================
        // SCRIPT MISI
        // ==============================================
        $('#hierarki-table tbody').on('click', '.TambahMisi', function() {
            var parentRow = $(this).closest('tr')[0];
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }
            $('#IdVisiForm').val($(this).data('id'));
            $('#ModalInputMisi').modal('show');
            closeAllDropdowns();
        });

        $("#SimpanMisi").click(function() {
            if ($("#Misi").val() == "") {
                alert('Input Misi Belum Benar!')
            } else {
                var Misi = { _Id   : $("#IdVisiForm").val(),
                             Misi : $("#Misi").val() }
                $.post(BaseURL+"Nasional/InputMisiRPJPN", Misi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditMisi', function () {
            $("#IdMisiForm").val($(this).data('id'));
            $("#_IdVisi").val($(this).data('idvisi'));
            $("#_Misi").val($(this).data('misi'));
            $('#ModalEditMisi').modal("show");
            closeAllDropdowns();
        });

        $("#EditBtnMisi").click(function() {
            if ($("#_Misi").val() == "") {
                alert('Input Misi Belum Benar!')
            } else {
                var Misi = { Id   : $("#IdMisiForm").val(),
                             _Id  : $("#_IdVisi").val(),
                             Misi : $("#_Misi").val() }
                $.post(BaseURL+"Nasional/EditMisiRPJPN", Misi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusMisi', function () {
            if(confirm("Yakin ingin menghapus Misi ini?")) {
                var Misi = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusMisiRPJPN", Misi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
            closeAllDropdowns();
        });

        // ==============================================
        // SCRIPT TUJUAN
        // ==============================================
        $('#hierarki-table tbody').on('click', '.TambahTujuan', function() {
            var parentRow = $(this).closest('tr')[0];
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }
            $('#IdMisiForm').val($(this).data('id'));
            $('#ModalInputTujuan').modal('show');
            closeAllDropdowns();
        });

        $("#SimpanTujuan").click(function() {
            if ($("#Tujuan").val() == "") {
                alert('Input Tujuan Belum Benar!')
            } else {
                var Tujuan = { _Id     : $("#IdMisiForm").val(),
                               Tujuan : $("#Tujuan").val() }
                $.post(BaseURL+"Nasional/InputTujuanRPJPN", Tujuan).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditTujuan', function () {
            $("#IdTujuanForm").val($(this).data('id'));
            $("#_IdMisi").val($(this).data('idmisi'));
            $("#_Tujuan").val($(this).data('tujuan'));
            $('#ModalEditTujuan').modal("show");
            closeAllDropdowns();
        });

        $("#EditBtnTujuan").click(function() {
            if ($("#_Tujuan").val() == "") {
                alert('Input Tujuan Belum Benar!')
            } else {
                var Tujuan = { Id       : $("#IdTujuanForm").val(),
                               _Id      : $("#_IdMisi").val(),
                               Tujuan   : $("#_Tujuan").val() }
                $.post(BaseURL+"Nasional/EditTujuanRPJPN", Tujuan).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusTujuan', function () {
            if(confirm("Yakin ingin menghapus Tujuan ini?")) {
                var Tujuan = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusTujuanRPJPN", Tujuan).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
            closeAllDropdowns();
        });

        // ==============================================
        // SCRIPT SASARAN
        // ==============================================
        $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
            var parentRow = $(this).closest('tr')[0];
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }
            $('#IdTujuanForm').val($(this).data('id'));
            $('#ModalInputSasaran').modal('show');
            closeAllDropdowns();
        });

        $("#SimpanSasaran").click(function() {
            if ($("#Sasaran").val() == "") {
                alert('Input Sasaran Belum Benar!')
            } else {
                var Sasaran = { _Id      : $("#IdTujuanForm").val(),
                                Sasaran : $("#Sasaran").val() }
                $.post(BaseURL+"Nasional/InputSasaranRPJPN", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditSasaran', function () {
            $("#IdSasaranForm").val($(this).data('id'));
            $("#_IdTujuan").val($(this).data('idtujuan'));
            $("#_Sasaran").val($(this).data('sasaran'));
            $('#ModalEditSasaran').modal("show");
            closeAllDropdowns();
        });

        $("#EditBtnSasaran").click(function() {
            if ($("#_Sasaran").val() == "") {
                alert('Input Sasaran Belum Benar!')
            } else {
                var Sasaran = { Id      : $("#IdSasaranForm").val(),
                                _Id     : $("#_IdTujuan").val(),
                                Sasaran : $("#_Sasaran").val() }
                $.post(BaseURL+"Nasional/EditSasaranRPJPN", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusSasaran', function () {
            if(confirm("Yakin ingin menghapus Sasaran ini?")) {
                var Sasaran = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusSasaranRPJPN", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
            closeAllDropdowns();
        });

        // ==============================================
        // EVENT UNTUK MENUTUP DROPDOWN
        // ==============================================
        // Tutup dropdown saat tombol di klik
        $(document).on('click', '.dropdown-item-custom', function() {
            closeAllDropdowns();
        });

        // Tutup dropdown saat modal terbuka
        $(document).on('show.bs.modal', '.modal', function() {
            closeAllDropdowns();
        });

        // Tutup dropdown saat resize window
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                closeAllDropdowns();
            }, 150);
        });
    });
</script>