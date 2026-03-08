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
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 5px 10px;
        font-weight: 600;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    /* CSS Base untuk Badge Periode */
    .badge-periode {
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
    
    /* Variasi Warna Badge Periode Sesuai Level Hierarki */
    .badge-prov {
        background-color: #8bc34a; /* Hijau selaras border Provinsi */
        box-shadow: 0 2px 5px rgba(139, 195, 74, 0.4);
    }
    .badge-kaw {
        background-color: #00bcd4; /* Biru/Cyan selaras border Kawasan */
        box-shadow: 0 2px 5px rgba(0, 188, 212, 0.4);
    }
    .badge-sub {
        background-color: #ff9800; /* Oranye selaras border Sub Kawasan */
        box-shadow: 0 2px 5px rgba(255, 152, 0, 0.4);
    }

    .badge-kabkota {
        background-color: #f39c12;
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        margin: 2px;
        display: inline-block;
    }
    
    /* Penyesuaian UI Select2 agar menyatu dengan Bootstrap Notika */
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        min-height: 35px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 2px 0;
    }
    
    /* PERBAIKAN WARNA KAB/KOTA YANG DIPILIH (PADA MULTIPLE SELECT2) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #ffffff !important; /* Latar belakang hitam pekat */
        border: 1px solid #111111 !important;
        color: #333333 !important; /* Teks warna putih */
        border-radius: 3px;
        padding: 4px 8px;
        margin-top: 4px;
        font-weight: 600; /* Agar teks lebih tebal dan jelas */
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #333333 !important; /* Tanda (x) warna putih */
        margin-right: 5px;
        font-weight: bold;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #ff3333 !important; /* Tanda (x) menjadi merah saat dihover */
        background-color: transparent !important;
    }
</style>

<!-- Load Library Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Hierarki Pembangunan Kewilayahan RPJMN</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Induk Level 1 -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputProvinsi" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Pembangunan Kewilayahan</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 55%;">Uraian (Provinsi / Kawasan / Sub Kawasan & Kab/Kota)</th>
                                    <th style="width: 15%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 25%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                /* Asumsi Variabel Controller:
                                 * $PembangunanKewilayahan (Array data hierarki)
                                 * $Provinsi (Array data Provinsi dr kodewilayah length = 2)
                                 * $KabKota (Array data Kab/Kota dr kodewilayah length > 2)
                                 * $Visi (Array Visi untuk ambil Periode)
                                 */
                                if(isset($PembangunanKewilayahan) && count($PembangunanKewilayahan) > 0) {
                                    $noProv = 1;
                                    foreach ($PembangunanKewilayahan as $provinsi) { 
                                ?>
                                    <!-- LEVEL 1: PROVINSI -->
                                    <tr data-id="prov-<?= $provinsi['Id'] ?>" data-parent="" data-expanded="false" style="background-color: #f1f8e9;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $noProv ?></b></td>
                                        <td style="cursor: pointer; font-size: 14px; border-left: 3px solid #8bc34a;" onclick="toggleLevel('prov-<?= $provinsi['Id'] ?>', this)">
                                            <b>PROVINSI:</b> <?= $provinsi['NamaProvinsi'] ?> 
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-periode badge-prov"><?= $provinsi['TahunMulai'].'-'.$provinsi['TahunAkhir'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success TambahKawasan btn-action" data-id="<?= $provinsi['Id'] ?>" title="Tambah Kawasan"><i class="fa fa-plus"></i> Kawasan</button>
                                            <button class="btn btn-sm btn-info EditProvinsi btn-action" data-id="<?= $provinsi['Id'] ?>" data-kode="<?= $provinsi['KodeProvinsi'] ?>" data-idvisi="<?= isset($provinsi['IdVisi']) ? $provinsi['IdVisi'] : '' ?>" data-periode="<?= $provinsi['TahunMulai'].'-'.$provinsi['TahunAkhir'] ?>" title="Edit Provinsi"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger HapusProvinsi btn-action" data-id="<?= $provinsi['Id'] ?>" title="Hapus Provinsi"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <?php 
                                    // LEVEL 2: KAWASAN
                                    if(isset($provinsi['Kawasan'])) {
                                        $noKaw = 1;
                                        foreach ($provinsi['Kawasan'] as $kawasan) { 
                                    ?>
                                        <tr data-id="kaw-<?= $kawasan['Id'] ?>" data-parent="prov-<?= $provinsi['Id'] ?>" data-expanded="false" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td style="padding-left: 30px; cursor: pointer; border-left: 3px solid #00bcd4;" onclick="toggleLevel('kaw-<?= $kawasan['Id'] ?>', this)">
                                                <b style="color: #00838f;">KAWASAN <?= $noKaw ?>:</b> <?= $kawasan['NamaKawasan'] ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-periode badge-kaw"><?= $provinsi['TahunMulai'].'-'.$provinsi['TahunAkhir'] ?></span>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                            <td class="text-center">
                                                <!-- Bawa data-kodeprovinsi agar saat buka modal Sub Kawasan bisa filter box KabKota -->
                                                <button class="btn btn-sm btn-success TambahSubKawasan btn-action" data-id="<?= $kawasan['Id'] ?>" data-kodeprovinsi="<?= $provinsi['KodeProvinsi'] ?>" title="Tambah Sub Kawasan"><i class="fa fa-plus"></i> Sub Kawasan</button>
                                                <button class="btn btn-sm btn-info EditKawasan btn-action" data-id="<?= $kawasan['Id'] ?>" data-idprov="<?= $provinsi['Id'] ?>" data-namakawasan="<?= $kawasan['NamaKawasan'] ?>" title="Edit Kawasan"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-sm btn-danger HapusKawasan btn-action" data-id="<?= $kawasan['Id'] ?>" title="Hapus Kawasan"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php 
                                        // LEVEL 3: SUB KAWASAN & KAB KOTA
                                        if(isset($kawasan['SubKawasan'])) {
                                            $noSub = 1;
                                            foreach ($kawasan['SubKawasan'] as $sub) { 
                                                // Convert JSON string or comma-separated to array for badges
                                                $kabKotaArr = json_decode($sub['KabKota'], true);
                                                if(!is_array($kabKotaArr)) {
                                                    $kabKotaArr = explode(',', $sub['KabKota']);
                                                }
                                        ?>
                                            <tr data-id="sub-<?= $sub['Id'] ?>" data-parent="kaw-<?= $kawasan['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff3e0;">
                                                <td></td>
                                                <td style="padding-left: 60px; border-left: 3px solid #ff9800;">
                                                    <b style="color: #ef6c00;">SUB KAWASAN <?= $noKaw . '.' . $noSub ?>:</b> <?= $sub['NamaSubKawasan'] ?>
                                                    <div style="margin-top: 8px;">
                                                        <?php 
                                                            if(is_array($kabKotaArr)){
                                                                foreach($kabKotaArr as $kdKab) {
                                                                    $kode = trim($kdKab);
                                                                    // Cek apakah kode tersebut ada di dalam array MapKabKota
                                                                    $namaKabKota = isset($MapKabKota[$kode]) ? $MapKabKota[$kode] : $kode;
                                                                    echo "<span class='badge-kabkota'><i class='fa fa-map-marker'></i> ".$namaKabKota."</span> ";
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode badge-sub"><?= $provinsi['TahunMulai'].'-'.$provinsi['TahunAkhir'] ?></span>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                <td class="text-center">
                                                    <!-- Passing data-kodeprovinsi & kabkota yang sudah ada -->
                                                    <button class="btn btn-sm btn-info EditSubKawasan btn-action" data-id="<?= $sub['Id'] ?>" data-idkawasan="<?= $kawasan['Id'] ?>" data-kodeprovinsi="<?= $provinsi['KodeProvinsi'] ?>" data-namasub="<?= $sub['NamaSubKawasan'] ?>" data-kabkota='<?= json_encode($kabKotaArr) ?>' title="Edit Sub Kawasan"><i class="fa fa-edit"></i> Edit</button>
                                                    <button class="btn btn-sm btn-danger HapusSubKawasan btn-action" data-id="<?= $sub['Id'] ?>" title="Hapus Sub Kawasan"><i class="fa fa-trash"></i> Hapus</button>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php 
                                                $noSub++;
                                            } // End Sub Kawasan
                                        } 
                                        ?>
                                    <?php 
                                            $noKaw++;
                                        } // End Kawasan
                                    } 
                                    ?>
                                <?php 
                                        $noProv++;
                                    } // End Provinsi
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Pembangunan Kewilayahan RPJMN.</td>
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
<!-- MODAL INPUT & EDIT PROVINSI (LEVEL 1)          -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputProvinsi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Provinsi Pembangunan RPJMN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-flag"></i>
                            </div>
                            <div class="nk-int-st" style="width: 100%;">
                                <select class="select2 form-control" id="IdVisi" data-placeholder="Pilih Periode RPJMN">
                                    <option value=""></option>
                                    <?php 
                                    if(isset($Visi)) {
                                        foreach ($Visi as $cv) {
                                            echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>";
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
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-map"></i>
                            </div>
                            <div class="nk-int-st" style="width: 100%;">
                                <select class="select2 form-control" id="KodeProvinsi" data-placeholder="Pilih Provinsi">
                                    <option value=""></option>
                                    <?php 
                                    if(isset($Provinsi)) {
                                        foreach ($Provinsi as $cp) {
                                            echo "<option value='".$cp['Kode']."'>".$cp['Nama']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanProvinsi"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditProvinsi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Provinsi Pembangunan RPJMN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdProvinsiForm">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-map"></i>
                            </div>
                            <div class="nk-int-st" style="width: 100%;">
                                <select class="select2 form-control" id="_KodeProvinsi" data-placeholder="Pilih Provinsi">
                                    <option value=""></option>
                                    <?php 
                                    if(isset($Provinsi)) {
                                        foreach ($Provinsi as $cp) {
                                            echo "<option value='".$cp['Kode']."'>".$cp['Nama']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;display: none;" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="hidden" id="_IdVisi">
                                <input type="text" class="form-control" id="_PeriodeVisi" readonly placeholder="Periode Visi RPJMN">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnProvinsi"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT KAWASAN (LEVEL 2)           -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputKawasan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Kawasan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdProvinsiParent">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="NamaKawasan" placeholder="Nama Kawasan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanKawasan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditKawasan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Kawasan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdKawasanForm">
                <input type="hidden" id="_IdProvinsiParent">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_NamaKawasan" placeholder="Nama Kawasan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnKawasan"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT SUB KAWASAN (LEVEL 3)       -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSubKawasan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Sub Kawasan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdKawasanParent">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="NamaSubKawasan" placeholder="Nama Sub Kawasan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-map"></i>
                            </div>
                            <div class="nk-int-st" style="width: 100%;">
                                <!-- Ganti ke Select2, Opsi akan dirender via JavaScript -->
                                <select class="select2 form-control" multiple="multiple" id="KabKota" data-placeholder="Pilih Kabupaten / Kota Terkait">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanSubKawasan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditSubKawasan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Sub Kawasan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdSubKawasanForm">
                <input type="hidden" id="_IdKawasanParent">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_NamaSubKawasan" placeholder="Nama Sub Kawasan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-map"></i>
                            </div>
                            <div class="nk-int-st" style="width: 100%;">
                                <!-- Ganti ke Select2, Opsi akan dirender via JavaScript -->
                                <select class="select2 form-control" multiple="multiple" id="_KabKota" data-placeholder="Pilih Kabupaten / Kota Terkait">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnSubKawasan"><i class="fa fa-save"></i> Update</button>
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
<!-- Load Library Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // JS Logic Toggle Hierarki Tabel 
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
        sessionStorage.setItem('expandedRowsKewilayahan', JSON.stringify(expanded)); 
    }

    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>'; 
        
        // -------------------------------------------------------------
        // VARIABEL GLOBAL UNTUK PENYIMPANAN DATA KAB/KOTA (PENTING)
        // -------------------------------------------------------------
        var allKabKota = [];
        <?php 
        // Mengkonversi array PHP KabKota menjadi array JavaScript agar bisa di-filter dinamis
        $listKab = isset($KabKota) ? $KabKota : (isset($ComboKabKota) ? $ComboKabKota : []);
        foreach($listKab as $ck): ?>
            allKabKota.push({
                id: '<?= $ck["Kode"] ?>',
                text: '<?= $ck["Kode"] . " - " . addslashes($ck["Nama"]) ?>'
            });
        <?php endforeach; ?>
        // -------------------------------------------------------------

        // Inisialisasi Select2 pada form select ber-class select2
        $('.select2').select2({
            width: '100%'
        });

        // --- Restore & Reset Bug State dari Session ---
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRowsKewilayahan')) || [];
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
        // SCRIPT PROVINSI (LEVEL 1)
        // ==============================================
        $("#SimpanProvinsi").click(function() {
            if ($("#IdVisi").val() == "") {
                alert('Pilih Periode RPJMN Terlebih Dahulu!')
            } else if ($("#KodeProvinsi").val() == "") {
                alert('Pilih Provinsi Terlebih Dahulu!')
            } else {
                var Data = { KodeProvinsi : $("#KodeProvinsi").val(),
                             _IdVisi      : $("#IdVisi").val() }
                $.post(BaseURL+"Nasional/InputPembangunanKewilayahanProvinsiRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                        
            }
        });

        $('#hierarki-table tbody').on('click', '.EditProvinsi', function () {
            $("#IdProvinsiForm").val($(this).data('id'));
            $('#_KodeProvinsi').val(String($(this).data('kode'))).trigger('change');
            $("#_IdVisi").val($(this).data('idvisi'));
            $("#_PeriodeVisi").val($(this).data('periode'));
            $('#ModalEditProvinsi').modal("show");
        });

        $("#EditBtnProvinsi").click(function() {
            if ($("#_KodeProvinsi").val() == "") {
                alert('Pilih Provinsi Terlebih Dahulu!')
            } else {
                var Data = { Id           : $("#IdProvinsiForm").val(),
                             KodeProvinsi : $("#_KodeProvinsi").val(),
                             _IdVisi      : $("#_IdVisi").val() }
                $.post(BaseURL+"Nasional/EditPembangunanKewilayahanProvinsiRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                        
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusProvinsi', function () {
            if(confirm("Yakin ingin menghapus Provinsi ini? Seluruh data Kawasan terkait akan ikut terhapus.")) {
                var Data = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusPembangunanKewilayahanProvinsiRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT KAWASAN (LEVEL 2)
        // ==============================================
        $('#hierarki-table tbody').on('click', '.TambahKawasan', function() {
            var parentRow = $(this).closest('tr')[0];
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }
            $('#IdProvinsiParent').val($(this).data('id'));
            $('#ModalInputKawasan').modal('show');
        });

        $("#SimpanKawasan").click(function() {
            if ($("#NamaKawasan").val() == "") {
                alert('Input Nama Kawasan Belum Benar!')
            } else {
                var Data = { _IdProvinsi : $("#IdProvinsiParent").val(),
                             NamaKawasan : $("#NamaKawasan").val() }
                $.post(BaseURL+"Nasional/InputPembangunanKewilayahanKawasanRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                        
            }
        });

        $('#hierarki-table tbody').on('click', '.EditKawasan', function () {
            $("#IdKawasanForm").val($(this).data('id'));
            $("#_IdProvinsiParent").val($(this).data('idprov'));
            $("#_NamaKawasan").val($(this).data('namakawasan'));
            $('#ModalEditKawasan').modal("show");
        });

        $("#EditBtnKawasan").click(function() {
            if ($("#_NamaKawasan").val() == "") {
                alert('Input Nama Kawasan Belum Benar!')
            } else {
                var Data = { Id          : $("#IdKawasanForm").val(),
                             _IdProvinsi : $("#_IdProvinsiParent").val(),
                             NamaKawasan : $("#_NamaKawasan").val() }
                $.post(BaseURL+"Nasional/EditPembangunanKewilayahanKawasanRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                        
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusKawasan', function () {
            if(confirm("Yakin ingin menghapus Kawasan ini?")) {
                var Data = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusPembangunanKewilayahanKawasanRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT SUB KAWASAN (LEVEL 3) - FILTER KABKOTA
        // ==============================================
        $('#hierarki-table tbody').on('click', '.TambahSubKawasan', function() {
            var parentRow = $(this).closest('tr')[0];
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            var idKawasan = $(this).data('id');
            var kodeProv = String($(this).data('kodeprovinsi'));
            
            $('#IdKawasanParent').val(idKawasan);
            
            // FILTER JS: Hanya ambil Kab/Kota yang kode 2 digit pertamanya sama dengan kodeProv
            var filteredKabKota = allKabKota.filter(function(item) {
                return item.id.substring(0, 2) === kodeProv;
            });
            
            // Render ulang Select2 hanya dengan data yang lolos filter
            $('#KabKota').empty().select2({
                data: filteredKabKota,
                width: '100%',
                placeholder: 'Pilih Kabupaten / Kota Terkait'
            });

            $('#ModalInputSubKawasan').modal('show');
        });

        $("#SimpanSubKawasan").click(function() {
            if ($("#NamaSubKawasan").val() == "") {
                alert('Input Nama Sub Kawasan Belum Benar!')
            } else if ($("#KabKota").val() == null || $("#KabKota").val().length === 0) {
                alert('Pilih minimal satu Kabupaten/Kota!')
            } else {
                // Konversi Array dari multi-select ke string JSON
                var kabKotaData = JSON.stringify($("#KabKota").val()); 
                var Data = { _IdKawasan     : $("#IdKawasanParent").val(),
                             NamaSubKawasan : $("#NamaSubKawasan").val(),
                             KabKota        : kabKotaData }
                $.post(BaseURL+"Nasional/InputPembangunanKewilayahanSubKawasanRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                        
            }
        });

        $('#hierarki-table tbody').on('click', '.EditSubKawasan', function () {
            var kodeProv = String($(this).data('kodeprovinsi'));
            var kabKotaSelected = $(this).data('kabkota'); // sudah berbentuk array JSON

            $("#IdSubKawasanForm").val($(this).data('id'));
            $("#_IdKawasanParent").val($(this).data('idkawasan'));
            $("#_NamaSubKawasan").val($(this).data('namasub'));

            // FILTER JS: Hanya ambil Kab/Kota yang kode 2 digit pertamanya sama dengan kodeProv
            var filteredKabKota = allKabKota.filter(function(item) {
                return item.id.substring(0, 2) === kodeProv;
            });

            // Kosongkan dan buat ulang Select2 dengan data yang sudah difilter
            $('#_KabKota').empty().select2({
                data: filteredKabKota,
                width: '100%',
                placeholder: 'Pilih Kabupaten / Kota Terkait'
            });

            // Atur agar Select2 langsung memilih opsi yang sudah tersimpan sebelumnya
            $('#_KabKota').val(kabKotaSelected).trigger('change');

            $('#ModalEditSubKawasan').modal("show");
        });

        $("#EditBtnSubKawasan").click(function() {
            if ($("#_NamaSubKawasan").val() == "") {
                alert('Input Nama Sub Kawasan Belum Benar!')
            } else if ($("#_KabKota").val() == null || $("#_KabKota").val().length === 0) {
                alert('Pilih minimal satu Kabupaten/Kota!')
            } else {
                var kabKotaData = JSON.stringify($("#_KabKota").val()); 
                var Data = { Id             : $("#IdSubKawasanForm").val(),
                             _IdKawasan     : $("#_IdKawasanParent").val(),
                             NamaSubKawasan : $("#_NamaSubKawasan").val(),
                             KabKota        : kabKotaData }
                $.post(BaseURL+"Nasional/EditPembangunanKewilayahanSubKawasanRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                        
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusSubKawasan', function () {
            if(confirm("Yakin ingin menghapus Sub Kawasan ini?")) {
                var Data = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusPembangunanKewilayahanSubKawasanRPJMN", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });
    });
</script>