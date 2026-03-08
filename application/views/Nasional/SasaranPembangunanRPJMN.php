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
    #data-table-basic > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #data-table-basic > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    /* Efek hover baris tabel hierarki */
    #data-table-basic > tbody > tr {
        transition: filter 0.2s ease;
    }
    #data-table-basic > tbody > tr:hover {
        filter: brightness(0.96); /* Menggelapkan sedikit baris saat di-hover */
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
    
    /* Custom Badges untuk Indikator */
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
    .badge-satuan {
        background-color: #03a9f4;
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-target {
        background-color: #ff9800;
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-baseline {
        background-color: #607d8b;
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Hierarki Sasaran & Indikator Pembangunan RPJMN</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Induk Level 1 -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputSasaranPembangunan" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Sasaran Pembangunan</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 30%;">Sasaran Pembangunan / Indikator</th>
                                    <th style="width: 15%;" class="text-center">Pengampu</th>
                                    <th style="width: 5%;" class="text-center">Satuan</th>
                                    <th style="width: 5%;" class="text-center">Baseline</th>
                                    <th style="width: 8%;" class="text-center">Target Awal</th>
                                    <th style="width: 8%;" class="text-center">Target Akhir</th>
                                    <th style="width: 10%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 30%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($SasaranPembangunan) && count($SasaranPembangunan) > 0) {
                                    $no = 1;
                                    foreach ($SasaranPembangunan as $data) { 
                                ?>
                                    <!-- LEVEL 1: SASARAN PEMBANGUNAN -->
                                    <tr style="background-color: #f1f8e9;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $no++ ?></b></td>
                                        <td style="cursor: pointer; font-size: 14px; border-left: 3px solid #8bc34a;" onclick="toggleRows('sub-row-<?= $data['Id'] ?>')">
                                            <b style="color: #558b2f;"></b> <?= $data['SasaranPembangunan'] ?>
                                        </td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $data['TahunMulai'].'-'.$data['TahunAkhir'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success Tambah btn-action" Id="<?= $data['Id'] ?>" title="Tambah Indikator"><i class="fa fa-plus"></i> </button>
                                            <button class="btn btn-sm btn-info Edit btn-action" Id="<?= $data['Id'] ?>" SasaranPembangunan="<?= $data['SasaranPembangunan'] ?>" TahunMulai="<?= $data['TahunMulai'] ?>" TahunAkhir="<?= $data['TahunAkhir'] ?>" title="Edit Sasaran"><i class="fa fa-edit"></i> </button>
                                            <button class="btn btn-sm btn-danger Hapus btn-action" Hapus="<?= $data['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i> </button>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <?php 
                                    // LEVEL 2: INDIKATOR PEMBANGUNAN
                                    if(isset($IndikatorPembangunan)) {
                                        $noInd = 1;
                                        foreach ($IndikatorPembangunan as $indikator) {
                                            if($indikator['_Id'] == $data['Id']) { 
                                    ?>
                                        <tr class="sub-row-<?= $data['Id'] ?>" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td style="padding-left: 30px; border-left: 3px solid #00bcd4;">
                                                <b style="color: #00838f;"><?= $indikator['IndikatorPembangunan'] ?></b>
                                            </td>
                                            <td class="text-center"><?= $indikator['NamaKementerian'] ?></td>
                                            <td class="text-center"><span class="badge-satuan"><?= $indikator['Satuan'] ?></span></td>
                                            <td class="text-center"><span class="badge-baseline"><?= $indikator['Baseline'] ?></span></td>
                                            <td class="text-center"><span class="badge-target"><?= $indikator['TargetAwal'] ?></span></td>
                                            <td class="text-center"><span class="badge-target"><?= $indikator['TargetAkhir'] ?></span></td>
                                            <td class="text-center">
                                                <span class="badge-periode" style="background-color: #00bcd4; box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);"><?= $data['TahunMulai'].'-'.$data['TahunAkhir'] ?></span>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info _Edit btn-action" Id="<?= $indikator['Id'] ?>" _Id="<?= $data['Id'] ?>" IndikatorPembangunan="<?= $indikator['IndikatorPembangunan'] ?>" Satuan="<?= $indikator['Satuan'] ?>" Baseline="<?= $indikator['Baseline'] ?>" TargetAwal="<?= $indikator['TargetAwal'] ?>" TargetAkhir="<?= $indikator['TargetAkhir'] ?>" IdKementerian="<?= isset($indikator['Id_']) ? $indikator['Id_'] : '' ?>" title="Edit Indikator"><i class="fa fa-edit"></i> </button>
                                                <button class="btn btn-sm btn-danger _Hapus btn-action" _Hapus="<?= $indikator['Id'] ?>" title="Hapus Indikator"><i class="fa fa-trash"></i> </button>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php 
                                                $noInd++;
                                            }
                                        }
                                    } 
                                    ?>

                                <?php 
                                    } 
                                } else { ?>
                                    <tr>
                                        <td colspan="9" class="text-center" style="padding: 30px; color: #999;">Belum ada data Sasaran Pembangunan RPJMN.</td>
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
<!-- MODAL INPUT & EDIT SASARAN PEMBANGUNAN         -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSasaranPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Sasaran Pembangunan RPJMN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-flag"></i>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker form-control" data-live-search="true" id="IdVisi">
                                    <option value="">Pilih Periode RPJMN</option>
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
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="SasaranPembangunan" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanSasaranPembangunan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditSasaranPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Sasaran Pembangunan RPJMN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="Id">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_SasaranPembangunan" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="Edit"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT INDIKATOR PEMBANGUNAN       -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputIndikatorPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Indikator Pembangunan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdSasaran">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="nk-int-st">
                                <select class="form-control" id="IdKementerian">
                                    <option value="" disabled selected>Pilih Kementerian</option>
                                    <?php if(isset($Kementerian)){ foreach ($Kementerian as $k) { ?>
                                        <option value="<?=$k['Id']?>"><?=$k['NamaKementerian']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="IndikatorPembangunan" rows="3" style="resize: vertical;" placeholder="Uraian Indikator Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-form"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Satuan" placeholder="Satuan (mis: % , Jumlah)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-bar-chart"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Baseline" placeholder="Nilai Baseline">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-up-arrow"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="TargetAwal" placeholder="Target Awal">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-up-arrow"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="TargetAkhir" placeholder="Target Akhir">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanIndikatorPembangunan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditIndikatorPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Indikator Pembangunan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="_Id">
                <input type="hidden" id="_IdSasaran">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="nk-int-st">
                                <select class="form-control" id="_IdKementerian">
                                    <option value="" disabled selected>Pilih Kementerian</option>
                                    <?php if(isset($Kementerian)){ foreach ($Kementerian as $k) { ?>
                                        <option value="<?=$k['Id']?>"><?=$k['NamaKementerian']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_IndikatorPembangunan" rows="3" style="resize: vertical;" placeholder="Uraian Indikator Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-form"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Satuan" placeholder="Satuan (mis: % , Jumlah)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-bar-chart"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Baseline" placeholder="Nilai Baseline">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-up-arrow"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_TargetAwal" placeholder="Target Awal">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-up-arrow"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_TargetAkhir" placeholder="Target Akhir">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="_Edit"><i class="fa fa-save"></i> Update</button>
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
    function toggleRows(className) {
        // Mencari semua elemen yang memiliki class yang sama
        var rows = document.querySelectorAll('.' + className);
        var isOpen = false;
        
        rows.forEach(function(row) {
            if (row.style.display === "none" || row.style.display === "") {
                row.style.display = "table-row";
                isOpen = true;
            } else {
                row.style.display = "none";
            }
        });

        // Simpan status toggle ke sessionStorage
        var openRows = JSON.parse(sessionStorage.getItem('openRowsRPJMN')) || [];
        var classIndex = openRows.indexOf(className);
        if (isOpen) {
            if (classIndex === -1) {
                openRows.push(className);
            }
        } else {
            if (classIndex !== -1) {
                openRows.splice(classIndex, 1);
            }
        }
        sessionStorage.setItem('openRowsRPJMN', JSON.stringify(openRows));
    }

    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>';

        // --- RESTORE TOGGLE STATE ---
        var openRows = JSON.parse(sessionStorage.getItem('openRowsRPJMN')) || [];
        openRows.forEach(function(className) {
            var rows = document.querySelectorAll('.' + className);
            rows.forEach(function(row) {
                row.style.display = "table-row";
            });
        });
        // -----------------------------

        // ==============================================
        // SCRIPT SASARAN PEMBANGUNAN
        // ==============================================
        $("#SimpanSasaranPembangunan").click(function() {
            if ($("#IdVisi").val() == "") {
                alert("Mohon Pilih Periode RPJMN")
            } else if ($("#SasaranPembangunan").val() == "") {
                alert('Input Sasaran Pembangunan Belum Benar!')
            } else {
                var SasaranPembangunan = { SasaranPembangunan : $("#SasaranPembangunan").val(),
                                           _Id : $("#IdVisi").val() }
                $.post(BaseURL+"Nasional/InputSasaranPembangunanRPJMN", SasaranPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        });

        $('#data-table-basic tbody').on('click', '.Edit', function () {
            $("#Id").val($(this).attr('Id'));
            $("#_SasaranPembangunan").val($(this).attr('SasaranPembangunan'));
            $('#ModalEditSasaranPembangunan').modal("show");
        });

        $("#Edit").click(function() {
            if ($("#_SasaranPembangunan").val() == "") {
                alert('Input Sasaran Pembangunan Belum Benar!')
            } else {
                var SasaranPembangunan = { Id : $("#Id").val(),
                                           SasaranPembangunan : $("#_SasaranPembangunan").val() }
                $.post(BaseURL+"Nasional/EditSasaranPembangunanRPJMN", SasaranPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        });

        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Yakin ingin menghapus Sasaran Pembangunan ini?")) {
                var SasaranPembangunan = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusSasaranPembangunanRPJMN", SasaranPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })
            }                        
        });

        // ==============================================
        // SCRIPT INDIKATOR PEMBANGUNAN
        // ==============================================
        $('#data-table-basic tbody').on('click', '.Tambah', function () {
            var parentRow = $(this).closest('tr')[0];
            
            // Buka otomatis induknya jika saat diklik kondisinya masih tertutup
            var isHidden = document.querySelector('.sub-row-' + $(this).attr('Id'))?.style.display === 'none';
            if (isHidden) {
                toggleRows('sub-row-' + $(this).attr('Id'));
            }

            $("#IdSasaran").val($(this).attr('Id'));
            // Reset dropdown kementerian
            $("#IdKementerian").prop('selectedIndex', 0);
            $("#IndikatorPembangunan").val('');
            $("#Satuan").val('');
            $("#Baseline").val('');
            $("#TargetAwal").val('');
            $("#TargetAkhir").val('');
            $('#ModalInputIndikatorPembangunan').modal("show");
        });

        $("#SimpanIndikatorPembangunan").click(function() {
            if ($("#IdKementerian").val() == null || $("#IdKementerian").val() == "") {
                alert('Pilih Kementerian Terlebih Dahulu!');
            } else if ($("#IndikatorPembangunan").val() == "") {
                alert('Input Indikator Pembangunan Belum Benar!');
            } else if ($("#Satuan").val() == "") {
                alert('Input Satuan Belum Benar!');
            } else if ($("#Baseline").val() == "") {
                alert('Input Baseline Belum Benar!');
            } else if ($("#TargetAwal").val() == "") {
                alert('Input Target Awal Belum Benar!');
            } else if ($("#TargetAkhir").val() == "") {
                alert('Input Target Akhir Belum Benar!');
            } else {
                var IndikatorPembangunan = { _Id : $("#IdSasaran").val(),
                                             Id_ : $("#IdKementerian").val(), // Menyimpan Id Kementerian
                                             IndikatorPembangunan : $("#IndikatorPembangunan").val(),
                                             Satuan : $("#Satuan").val(),
                                             Baseline : $("#Baseline").val(),
                                             TargetAwal : $("#TargetAwal").val(),
                                             TargetAkhir : $("#TargetAkhir").val() }
                $.post(BaseURL+"Nasional/InputIndikatorSasaranPembangunanRPJMN", IndikatorPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        // --- SIMPAN STATE AGAR TERBUKA SETELAH RELOAD ---
                        var className = 'sub-row-' + $("#IdSasaran").val();
                        var openRows = JSON.parse(sessionStorage.getItem('openRowsRPJMN')) || [];
                        if (openRows.indexOf(className) === -1) {
                            openRows.push(className);
                            sessionStorage.setItem('openRowsRPJMN', JSON.stringify(openRows));
                        }
                        // ------------------------------------------------
                        
                        window.location = BaseURL+"Nasional/SasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        });

        $('#data-table-basic tbody').on('click', '._Edit', function () {
            $("#_Id").val($(this).attr('Id'));
            $("#_IdSasaran").val($(this).attr('_Id'));
            $("#_IdKementerian").val($(this).attr('IdKementerian')); // Set data Kementerian dropdown
            $("#_IndikatorPembangunan").val($(this).attr('IndikatorPembangunan'));
            $("#_Satuan").val($(this).attr('Satuan'));
            $("#_Baseline").val($(this).attr('Baseline'));
            $("#_TargetAwal").val($(this).attr('TargetAwal'));
            $("#_TargetAkhir").val($(this).attr('TargetAkhir'));
            $('#ModalEditIndikatorPembangunan').modal("show");
        });

        $("#_Edit").click(function() {
            if ($("#_IdKementerian").val() == null || $("#_IdKementerian").val() == "") {
                alert('Pilih Kementerian Terlebih Dahulu!');
            } else if ($("#_IndikatorPembangunan").val() == "") {
                alert('Input Indikator Pembangunan Belum Benar!');
            } else if ($("#_Satuan").val() == "") {
                alert('Input Satuan Belum Benar!');
            } else if ($("#_Baseline").val() == "") {
                alert('Input Baseline Belum Benar!');
            } else if ($("#_TargetAwal").val() == "") {
                alert('Input Target Awal Belum Benar!');
            } else if ($("#_TargetAkhir").val() == "") {
                alert('Input Target Akhir Belum Benar!');
            } else {
                var IndikatorPembangunan = { Id : $("#_Id").val(),
                                             _Id : $("#_IdSasaran").val(),
                                             Id_ : $("#_IdKementerian").val(), // Menyimpan Update Id Kementerian
                                             IndikatorPembangunan : $("#_IndikatorPembangunan").val(),
                                             Satuan : $("#_Satuan").val(),
                                             Baseline : $("#_Baseline").val(),
                                             TargetAwal : $("#_TargetAwal").val(),
                                             TargetAkhir : $("#_TargetAkhir").val() }
                $.post(BaseURL+"Nasional/EditIndikatorSasaranPembangunanRPJMN", IndikatorPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        // --- SIMPAN STATE AGAR TERBUKA SETELAH RELOAD ---
                        var className = 'sub-row-' + $("#_IdSasaran").val();
                        var openRows = JSON.parse(sessionStorage.getItem('openRowsRPJMN')) || [];
                        if (openRows.indexOf(className) === -1) {
                            openRows.push(className);
                            sessionStorage.setItem('openRowsRPJMN', JSON.stringify(openRows));
                        }
                        // ------------------------------------------------
                        
                        window.location = BaseURL+"Nasional/SasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        });

        $('#data-table-basic tbody').on('click', '._Hapus', function () {
            if(confirm("Yakin ingin menghapus Indikator ini?")) {
                var trClasses = $(this).closest('tr').attr('class');
                var className = null;
                if (trClasses) {
                    var classArray = trClasses.split(' ');
                    for (var i = 0; i < classArray.length; i++) {
                        if (classArray[i].indexOf('sub-row-') === 0) {
                            className = classArray[i];
                            break;
                        }
                    }
                }
                
                var IndikatorPembangunan = { Id: $(this).attr('_Hapus') }
                $.post(BaseURL+"Nasional/HapusIndikatorSasaranPembangunanRPJMN", IndikatorPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        // --- SIMPAN STATE AGAR TETAP TERBUKA JIKA ADA SISA DATA ---
                        if (className) {
                            var openRows = JSON.parse(sessionStorage.getItem('openRowsRPJMN')) || [];
                            if (openRows.indexOf(className) === -1) {
                                openRows.push(className);
                                sessionStorage.setItem('openRowsRPJMN', JSON.stringify(openRows));
                            }
                        }
                        // ----------------------------------------------------------
                        
                        window.location = BaseURL+"Nasional/SasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })
            }                        
        });
    });
</script>
</body>
</html>