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
        padding: 15px 10px;
        vertical-align: middle;
    }
    #hierarki-table > tbody > tr > td {
        vertical-align: middle;
        padding: 12px 10px;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    /* Efek hover baris tabel hierarki */
    #hierarki-table > tbody > tr {
        transition: filter 0.2s ease;
    }
    #hierarki-table > tbody > tr:hover {
        filter: brightness(0.96); /* Menggelapkan sedikit baris saat di-hover tanpa merusak warna latar bawaan */
    }

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
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Hierarki Visi Hingga Sasaran RPJMD</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Visi tetap di atas sebagai level tertinggi -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputVisi" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Visi RPJMD</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <!-- Menggunakan class table standar, tanpa datatable-basic default agar custom toggle berfungsi baik -->
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 55%;">Uraian (Visi / Misi / Tujuan / Sasaran)</th>
                                    <th style="width: 15%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                    <th style="width: 25%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                /* LOGIKA FOREACH BERSARANG DENGAN PENOMORAN OTOMATIS */
                                if(isset($DataVisi) && count($DataVisi) > 0) {
                                    $noVisi = 1;
                                    foreach ($DataVisi as $visi) { 
                                ?>
                                    <!-- LEVEL 1: VISI -->
                                    <tr data-id="visi-<?= $visi['Id'] ?>" data-parent="" data-expanded="false" style="background-color: #f1f8e9;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $noVisi ?></b></td>
                                        <!-- Teks dibuat bisa diklik tanpa icon + / - -->
                                        <td style="cursor: pointer; font-size: 14px; border-left: 3px solid #8bc34a;" onclick="toggleLevel('visi-<?= $visi['Id'] ?>', this)">
                                            <b>VISI:</b> <?= $visi['Visi'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $visi['Periode'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                        <td class="text-center">
                                            <!-- Tombol Aksi di baris Visi -->
                                            <button class="btn btn-sm btn-success TambahMisi btn-action" data-id="<?= $visi['Id'] ?>" title="Tambah Misi"><i class="fa fa-plus"></i> Misi</button>
                                            <button class="btn btn-sm btn-info EditVisi btn-action" data-id="<?= $visi['Id'] ?>" data-visi="<?= $visi['Visi'] ?>" data-awal="<?= $visi['TahunMulai'] ?>" data-akhir="<?= $visi['TahunAkhir'] ?>" title="Edit Visi"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger HapusVisi btn-action" data-id="<?= $visi['Id'] ?>" title="Hapus Visi"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <?php 
                                    // Pengecekan Misi berdasarkan Visi ini
                                    if(isset($visi['Misi'])) {
                                        $noMisi = 1;
                                        foreach ($visi['Misi'] as $misi) { 
                                    ?>
                                        <!-- LEVEL 2: MISI -->
                                        <tr data-id="misi-<?= $misi['Id'] ?>" data-parent="visi-<?= $visi['Id'] ?>" data-expanded="false" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td style="padding-left: 30px; cursor: pointer; border-left: 3px solid #00bcd4;" onclick="toggleLevel('misi-<?= $misi['Id'] ?>', this)">
                                                <b style="color: #00838f;">MISI <?= $noMisi ?>:</b> <?= $misi['Misi'] ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-periode" style="background-color: #00bcd4; box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);"><?= $misi['Periode'] ?></span>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                            <td class="text-center">
                                                <!-- Tombol Aksi di baris Misi -->
                                                <button class="btn btn-sm btn-success TambahTujuan btn-action" data-id="<?= $misi['Id'] ?>" title="Tambah Tujuan"><i class="fa fa-plus"></i> Tujuan</button>
                                                <button class="btn btn-sm btn-info EditMisi btn-action" data-id="<?= $misi['Id'] ?>" data-idvisi="<?= $visi['Id'] ?>" data-misi="<?= $misi['Misi'] ?>" title="Edit Misi"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-sm btn-danger HapusMisi btn-action" data-id="<?= $misi['Id'] ?>" title="Hapus Misi"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php 
                                        // Pengecekan Tujuan berdasarkan Misi ini
                                        if(isset($misi['Tujuan'])) {
                                            $noTujuan = 1;
                                            foreach ($misi['Tujuan'] as $tujuan) { 
                                        ?>
                                            <!-- LEVEL 3: TUJUAN -->
                                            <tr data-id="tujuan-<?= $tujuan['Id'] ?>" data-parent="misi-<?= $misi['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff3e0;">
                                                <td></td>
                                                <td style="padding-left: 60px; cursor: pointer; border-left: 3px solid #ff9800;" onclick="toggleLevel('tujuan-<?= $tujuan['Id'] ?>', this)">
                                                    <b style="color: #ef6c00;">TUJUAN <?= $noMisi . '.' . $noTujuan ?>:</b> <?= $tujuan['Tujuan'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode" style="background-color: #ff9800; box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);"><?= $tujuan['Periode'] ?></span>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                                <td class="text-center">
                                                    <!-- Tombol Aksi di baris Tujuan -->
                                                    <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $tujuan['Id'] ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                    <button class="btn btn-sm btn-info EditTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" data-idmisi="<?= $misi['Id'] ?>" data-tujuan="<?= $tujuan['Tujuan'] ?>" title="Edit Tujuan"><i class="fa fa-edit"></i> Edit</button>
                                                    <button class="btn btn-sm btn-danger HapusTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" title="Hapus Tujuan"><i class="fa fa-trash"></i> Hapus</button>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                            <?php 
                                            // Pengecekan Sasaran berdasarkan Tujuan ini
                                            if(isset($tujuan['Sasaran'])) {
                                                $noSasaran = 1;
                                                foreach ($tujuan['Sasaran'] as $sasaran) { 
                                            ?>
                                                <!-- LEVEL 4: SASARAN -->
                                                <tr data-id="sasaran-<?= $sasaran['Id'] ?>" data-parent="tujuan-<?= $tujuan['Id'] ?>" data-expanded="false" style="display: none; background-color: #ffffff;">
                                                    <td></td>
                                                    <td style="padding-left: 90px; border-left: 3px solid #9e9e9e;">
                                                        <b style="color: #616161;">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?>:</b> <?= $sasaran['Sasaran'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge-periode" style="background-color: #9e9e9e; box-shadow: 0 2px 5px rgba(158, 158, 158, 0.3);"><?= $sasaran['Periode'] ?></span>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                                    <td class="text-center">
                                                        <!-- Tombol Aksi di baris Sasaran -->
                                                        <button class="btn btn-sm btn-info EditSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" data-idtujuan="<?= $tujuan['Id'] ?>" data-sasaran="<?= $sasaran['Sasaran'] ?>" title="Edit Sasaran"><i class="fa fa-edit"></i> Edit</button>
                                                        <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i> Hapus</button>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php 
                                                    $noSasaran++;
                                                } // End Sasaran
                                            } 
                                            ?>

                                        <?php 
                                                $noTujuan++;
                                            } // End Tujuan
                                        } 
                                        ?>

                                    <?php 
                                            $noMisi++;
                                        } // End Misi
                                    } 
                                    ?>
                                <?php 
                                        $noVisi++;
                                    } // End Visi
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Visi RPJMD.</td>
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
                <h2>Tambah Visi RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJMD"></textarea>
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
                <h2>Edit Visi RPJMD</h2>
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
                                <textarea class="form-control" id="_Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJMD"></textarea>
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
                <h2>Tambah Misi RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker" data-live-search="true" id="IdVisi">
                                    <option value="">Pilih Periode Visi</option>
                                    <?php 
                                    if(isset($ComboVisi)) {
                                        foreach ($ComboVisi as $cv) {
                                            echo "<option value='".$cv['Id']."'>".$cv['Periode']." - ".$cv['Visi']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJMD"></textarea>
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
                <h2>Edit Misi RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdMisiForm">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="hidden" id="_IdVisi">
                                <input type="text" class="form-control" id="_PeriodeVisi" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJMD"></textarea>
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
                <h2>Tambah Tujuan RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker" data-live-search="true" id="IdMisi">
                                    <option value="">Pilih Periode Misi</option>
                                    <?php 
                                    if(isset($ComboMisi)) {
                                        foreach ($ComboMisi as $cm) {
                                            echo "<option value='".$cm['Id']."'>".$cm['Periode']." - ".$cm['Misi']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJMD"></textarea>
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
                <h2>Edit Tujuan RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdTujuanForm">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="hidden" id="_IdMisi">
                                <input type="text" class="form-control" id="_PeriodeMisi" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJMD"></textarea>
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
                <h2>Tambah Sasaran RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker" data-live-search="true" id="IdTujuan">
                                    <option value="">Pilih Periode Tujuan</option>
                                    <?php 
                                    if(isset($ComboTujuan)) {
                                        foreach ($ComboTujuan as $ct) {
                                            echo "<option value='".$ct['Id']."'>".$ct['Periode']." - ".$ct['Tujuan']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJMD"></textarea>
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
                <h2>Edit Sasaran RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdSasaranForm">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="hidden" id="_IdTujuan">
                                <input type="text" class="form-control" id="_PeriodeTujuan" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJMD"></textarea>
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
    // JS Logic untuk Toggle Hierarki Tabel dengan klik text (Tanpa Icon)
    function toggleLevel(parentId, element) {
        var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        var parentTr = element.closest('tr');
        
        // Membaca status berdasarkan atribut custom data-expanded
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

    // Fungsi Rekursif untuk menyembunyikan semua turunan di bawahnya
    function hideAllChildren(parentId) {
        var children = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        
        children.forEach(function(child) {
            child.style.display = 'none';
            child.setAttribute('data-expanded', 'false'); // Set turunan jadi tertutup
            var childId = child.getAttribute('data-id');
            
            hideAllChildren(childId); // Jalankan ke anak yang lebih dalam
        });
    }

    // Simpan state secara presisi dengan memindai atribut data-expanded
    function saveExpandedState() {
        var expanded = [];
        document.querySelectorAll('tr[data-expanded="true"]').forEach(function(tr) {
            expanded.push(tr.getAttribute('data-id'));
        });
        sessionStorage.setItem('expandedRows', JSON.stringify(expanded));
    }

    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>'; // Pastikan base_url terdefinisi

        // --- Restore & Reset Bug State dari Session ---
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRows')) || [];
        
        // Membaca dari atas ke bawah (DOM order) agar parent terbuka terlebih dahulu 
        // sehingga child yang seharusnya tampil tidak terblokir status display 'none'
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
        // ---------------------------------------------------------------

        // Trigger Auto-Select ComboBox saat tombol "Tambah di setiap baris" diklik
        $('#hierarki-table tbody').on('click', '.TambahMisi', function() {
            var parentRow = $(this).closest('tr')[0];
            
            // Buka otomatis induknya jika saat diklik kondisinya masih tertutup
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            var idVisi = $(this).data('id');
            $('#IdVisiForm').val(idVisi);
            $('#ModalInputMisi').modal('show');
        });

        $('#hierarki-table tbody').on('click', '.TambahTujuan', function() {
            var parentRow = $(this).closest('tr')[0];
            
            // Buka otomatis induknya jika saat diklik kondisinya masih tertutup
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            var idMisi = $(this).data('id');
            $('#IdMisiForm').val(idMisi);
            $('#ModalInputTujuan').modal('show');
        });

        $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
            var parentRow = $(this).closest('tr')[0];
            
            // Buka otomatis induknya jika saat diklik kondisinya masih tertutup
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            var idTujuan = $(this).data('id');
            $('#IdTujuanForm').val(idTujuan);
            $('#ModalInputSasaran').modal('show');
        });

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
                $.post(BaseURL+"Nasional/InputVisiRPJMD", Visi).done(function(Respon) {
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
                $.post(BaseURL+"Nasional/EditVisiRPJMD", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusVisi', function () {
            if(confirm("Yakin ingin menghapus Visi ini? Seluruh sub-data dibawahnya mungkin akan ikut terhapus.")) {
                var Visi = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusVisiRPJMD", Visi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT MISI
        // ==============================================
        $("#SimpanMisi").click(function() {
            if ($("#Misi").val() == "") {
                alert('Input Misi Belum Benar!')
            } else {
                var Misi = { _Id   : $("#IdVisiForm").val(),
                             Misi : $("#Misi").val() }
                $.post(BaseURL+"Nasional/InputMisiRPJMD", Misi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditMisi', function () {
            $("#IdMisiForm").val($(this).data('id'));
            $("#_IdVisi").val($(this).data('idvisi'));
            $("#_Misi").val($(this).data('misi'));
            $('#ModalEditMisi').modal("show");
        });

        $("#EditBtnMisi").click(function() {
            if ($("#_Misi").val() == "") {
                alert('Input Misi Belum Benar!')
            } else {
                var Misi = { Id   : $("#IdMisiForm").val(),
                             _Id  : $("#_IdVisi").val(),
                             Misi : $("#_Misi").val() }
                $.post(BaseURL+"Nasional/EditMisiRPJMD", Misi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusMisi', function () {
            if(confirm("Yakin ingin menghapus Misi ini?")) {
                var Misi = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusMisiRPJMD", Misi).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT TUJUAN
        // ==============================================
        $("#SimpanTujuan").click(function() {
            if ($("#Tujuan").val() == "") {
                alert('Input Tujuan Belum Benar!')
            } else {
                var Tujuan = { _Id     : $("#IdMisiForm").val(),
                               Tujuan : $("#Tujuan").val() }
                $.post(BaseURL+"Nasional/InputTujuanRPJMD", Tujuan).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditTujuan', function () {
            $("#IdTujuanForm").val($(this).data('id'));
            $("#_IdMisi").val($(this).data('idmisi'));
            $("#_Tujuan").val($(this).data('tujuan'));
            $('#ModalEditTujuan').modal("show");
        });

        $("#EditBtnTujuan").click(function() {
            if ($("#_Tujuan").val() == "") {
                alert('Input Tujuan Belum Benar!')
            } else {
                var Tujuan = { Id       : $("#IdTujuanForm").val(),
                               _Id      : $("#_IdMisi").val(),
                               Tujuan   : $("#_Tujuan").val() }
                $.post(BaseURL+"Nasional/EditTujuanRPJMD", Tujuan).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusTujuan', function () {
            if(confirm("Yakin ingin menghapus Tujuan ini?")) {
                var Tujuan = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusTujuanRPJMD", Tujuan).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT SASARAN
        // ==============================================
        $("#SimpanSasaran").click(function() {
            if ($("#Sasaran").val() == "") {
                alert('Input Sasaran Belum Benar!')
            } else {
                var Sasaran = { _Id      : $("#IdTujuanForm").val(),
                                Sasaran : $("#Sasaran").val() }
                $.post(BaseURL+"Nasional/InputSasaranRPJMD", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditSasaran', function () {
            $("#IdSasaranForm").val($(this).data('id'));
            $("#_IdTujuan").val($(this).data('idtujuan'));
            $("#_Sasaran").val($(this).data('sasaran'));
            $('#ModalEditSasaran').modal("show");
        });

        $("#EditBtnSasaran").click(function() {
            if ($("#_Sasaran").val() == "") {
                alert('Input Sasaran Belum Benar!')
            } else {
                var Sasaran = { Id      : $("#IdSasaranForm").val(),
                                _Id     : $("#_IdTujuan").val(),
                                Sasaran : $("#_Sasaran").val() }
                $.post(BaseURL+"Nasional/EditSasaranRPJMD", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusSasaran', function () {
            if(confirm("Yakin ingin menghapus Sasaran ini?")) {
                var Sasaran = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusSasaranRPJMD", Sasaran).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });
    });
</script>